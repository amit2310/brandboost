<?php

namespace App\Models\Admin\Crons;

use Illuminate\Database\Eloquent\Model;
use DB;

class NpsModel extends Model {

    /**
     * Used to get current usage of a client
     * @param type $clientID
     * @return type
     */
    public function getCurrentUsage($clientID) {
        $oData = DB::table('tbl_account_usage')
                ->where('user_id', $clientID)
                ->first();
        return $oData;
    }

    /**
     * Used to get all events involving in the nps module
     * @return type
     */
    public function getInviterEvents() {
        $oData = DB::table('tbl_nps_automations_events')
                ->leftJoin('tbl_nps_main', 'tbl_nps_main.id', '=', 'tbl_nps_automations_events.nps_id')
                ->leftJoin('tbl_users', 'tbl_nps_main.user_id', '=', 'tbl_users.id')
                ->select('tbl_nps_automations_events.*', 'tbl_nps_main.user_id AS client_id', 'tbl_nps_main.hashcode AS account_id', 'tbl_users.firstname AS client_first_name', 'tbl_users.lastname AS client_last_name', 'tbl_users.email AS client_email', 'tbl_users.mobile AS client_phone')
                ->where('tbl_nps_main.status', 'active')
                ->where('tbl_nps_automations_events.status', 'active')
                ->orderBy('tbl_nps_automations_events.id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * Used to get the list of subscribers of a nps campaign
     * @param type $broadcastID
     * @return type
     */
    public function getInviterEligibleSubscribers($inviterID, $npsID) {

        $sql = "SELECT tbl_nps_campaign_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone "
                . "FROM tbl_nps_campaign_users "
                . "LEFT JOIN tbl_subscribers ON tbl_nps_campaign_users.subscriber_id = tbl_subscribers.id "
                . "WHERE tbl_nps_campaign_users.status = '1' "
                . "AND tbl_subscribers.status = '1' "
                . "AND tbl_nps_campaign_users.nps_id='$npsID' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) "
                . " GROUP BY tbl_subscribers.email";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * 
     * @param type $currentInviterID
     * @param type $previousID
     * @return type
     */
    public function getNextInviterEligibleSubscribers($currentInviterID, $previousID) {

        $sql = "SELECT tbl_nps_campaign_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, "
                . "tbl_nps_automations_triggers.auto_event_id, tbl_nps_automations_triggers.subscriber_id, tbl_nps_automations_triggers.preceded_by, "
                . "tbl_nps_automations_triggers.start_at FROM tbl_nps_automations_events "
                . "LEFT JOIN tbl_nps_automations_triggers ON tbl_nps_automations_events.id = tbl_nps_automations_triggers.auto_event_id "
                . "LEFT JOIN tbl_nps_campaign_users ON tbl_nps_automations_triggers.subscriber_id=tbl_nps_campaign_users.id "
                . "LEFT JOIN tbl_subscribers ON tbl_nps_campaign_users.subscriber_id = tbl_subscribers.id "
                . "WHERE tbl_nps_automations_triggers.auto_event_id='{$previousID}' "
                . "AND tbl_nps_campaign_users.status = '1' AND tbl_subscribers.status = '1' "
                . "AND tbl_nps_automations_triggers.subscriber_id NOT IN(SELECT subscriber_id FROM tbl_nps_automations_triggers "
                . "WHERE auto_event_id='{$currentInviterID}')";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * 
     * @param type $inviterID
     * @return type
     */
    public function getAutomationCampaign($inviterID) {
        $sql = "SELECT * FROM tbl_nps_automations_campaigns WHERE event_id='$inviterID' AND (status ='active' OR status='1')";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to replace email tags used in the nps email
     * @param type $npsID
     * @param type $accountID
     * @param type $sHtml
     * @param type $campaignType
     * @param type $subscriberInfo
     * @return type
     */
    public function emailTagReplace($npsID, $accountID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        $aTags = config('bbconfig.email_tags');

        if (!empty($npsID)) {
            $oNPS = $this->getNpsInfo($npsID);
            $accountID = $accountID == '' ? $oNPS->hashcode : $accountID;
            $oUnitData = $oNPS;
        }

        if (!empty($oUnitData)) {
            $hashCode = $oUnitData->hashcode;
            $title = $oUnitData->title;
            $platform = $oUnitData->platform;
            $brandName = $oUnitData->brand_name;
            $brandLogoURL = $oUnitData->brand_logo;
            $btnColor = $oUnitData->web_button_color;
            $txtColor = $oUnitData->web_text_color;
            $btnShape = $oUnitData->web_button_shape;
            $desc = $oUnitData->description;
            $ques = $oUnitData->question;
            $btnTxtColor = $oUnitData->web_button_text_color;
            $introTxtColor = $oUnitData->web_int_text_color;
        } else {

            $title = 'Title goes here';
            $platform = 'Platform goes here';
            $brandName = 'Brand Name';
            $brandLogoURL = $oUnitData->brand_logo;
            $btnColor = '';
            $txtColor = '';
            $btnShape = '';
            $desc = 'Description goes here';
            $ques = 'Question goes here';
        }
        $greetings = 'Hi, ' . $aUser->firstname . ' ' . $aUser->lastname . '!';
        $description = (!empty($desc)) != '' ? $desc : '{{INTRODUCTION}}';
        $question = (!empty($ques)) ? $ques : 'How likely are you to recommend My Store to a friend?';

        if ($campaignType == 'email') {
            $aTemplateTags = array(
                '{{BRAND_LOGO}}',
                '{{INTRODUCTION}}',
                '{INTRODUCTION}',
                '{{TEXT_COLOR}}',
                '{{BUTTON_COLOR}}',
                '{{BUTTON_TEXT_COLOR}}',
                '{{BUTTON_SHAPE}}',
                '{{QUESTION}}',
                '{{RATE_LINK}}',
                '{{SURVEYURL}}',
                '{GREETING}',
                '{{INTRODUCTION_TEXT_COLOR}}'
            );

            $brandLogo = !(empty($brandLogoURL)) ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $brandLogoURL : base_url() . 'assets/images/face2.jpg';
            $textColor = !(empty($txtColor)) ? $txtColor : '#111111';
            $introTextColor = !(empty($introTxtColor)) ? $introTxtColor : '#000000';
            $buttonColor = (!empty($btnColor)) ? $btnColor : '#FFFFFF';
            $buttonShape = (!empty($oUnitData->web_button_shape)) ? $btnShape == 'circle' ? '50%' : '0px' : '5px';
            $buttonTextColor = !(empty($btnTxtColor)) ? $btnTxtColor : '#000000';
            $rateLink = base_url() . "nps/t/{$hashCode}";
            $surveyLink = base_url() . "survey/{$hashCode}?securityToken=" . date('Ymdhis');

            $aSource = array(
                $brandLogo,
                $description,
                $description,
                $textColor,
                $buttonColor,
                $buttonTextColor,
                $buttonShape,
                $question,
                $rateLink,
                $surveyLink,
                $greetings,
                $introTextColor
            );
        }

        if ($campaignType == 'sms') {

            $question = (!empty($ques)) ? $ques : 'How likely are you to recommend My Store to a friend?';
            $surveyLink = base_url() . "survey/{$hashCode}";
            $aTemplateTags = array(
                '{{INTRODUCTION}}',
                '{INTRODUCTION}',
                '{{QUESTION}}',
                '{GREETING}'
            );
            $aSource = array(
                $description,
                $description,
                $question,
                $greetings
            );
        }

        $sHtml = str_replace($aTemplateTags, $aSource, $sHtml);
        if (!empty($subscriberInfo)) {
            $subscriberID = $subscriberInfo->id;
        }
        if (!empty($aTags)) {
            foreach ($aTags AS $sTag) {
                $htmlData = '';
                switch ($sTag) {
                    case '{FIRST_NAME}':
                        $htmlData = $subscriberInfo->firstname;
                        break;

                    case '{LAST_NAME}':
                        $htmlData = $subscriberInfo->lastname;
                        break;

                    case '{EMAIL}':
                        $htmlData = $subscriberInfo->email;
                        break;

                    case '{PHONE}':
                        $htmlData = ($subscriberInfo->phone) ? $subscriberInfo->phone : $subscriberInfo->mobile;
                        break;
                    case '{BRANDNAME}':
                        $htmlData = $oNPS->brand_name;
                        break;

                    case '{INTRODUCTION}':
                        $htmlData = $oNPS->description;
                        break;

                    case '{QUESTION}':
                        $htmlData = $oNPS->question;
                        break;

                    case '{SITEURL}':
                        $htmlData = site_url();
                        break;

                    case '{ACCOUNTHASHCODE}':
                        $htmlData = $oNPS->hashcode;
                        break;
                    case '{UNSUBSCRIBE_LINK}':
                        $htmlData = "<a href='" . base_url() . "nps/unsubscribeUser/" . $accountID . "/" . $subscriberInfo->id . "'>Click Here</a> to unsubscribe.";

                        break;
                    case '{SURVEYURL}':
                        $htmlData = base_url() . "survey/" . $accountID . "?subid=" . base64_encode($subscriberInfo->id);
                        break;
                }
                $sHtml = str_replace($sTag, $htmlData, $sHtml);
            }
        }
        return $sHtml;
    }

    /**
     * Used to  get NPS campaign details
     * @param type $id
     * @return type
     */
    public function getNpsInfo($id) {
        $oData = DB::table('tbl_nps_main')
                ->where('id', $id)
                ->first();
        return $oData;
    }

    /**
     * 
     * @param type $aData
     * @return type
     */
    public function saveInviterQueue($aData) {
        $insertID = DB::table('tbl_nps_automations_inviter_queue')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to save trigger data
     * @param type $aData
     * @return type
     */
    public function saveTriggerData($aData) {
        $insertID = DB::table('tbl_nps_automations_triggers')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to save sending log
     * @param type $aData
     * @return type
     */
    public function saveSendingLog($aData) {
        $insertID = DB::table('tbl_nps_automations_tracking_logs')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Get Reminder subscribers
     * @param type $currentInviterID
     * @param type $previousID
     * @param type $frequence
     * @return type
     */
    public function getReminderSubscribers($currentInviterID, $previousID, $frequence = 1) {

        if ($frequence > 1) {
            $sql = "SELECT tbl_nps_campaign_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, "
                    . "tbl_nps_automations_triggers.auto_event_id, "
                    . "tbl_nps_automations_triggers.preceded_by, tbl_nps_automations_triggers.start_at "
                    . "FROM tbl_nps_automations_events "
                    . "LEFT JOIN tbl_nps_automations_triggers ON tbl_nps_automations_events.id = tbl_nps_automations_triggers.auto_event_id "
                    . "LEFT JOIN tbl_nps_campaign_users ON tbl_nps_automations_triggers.subscriber_id=tbl_nps_campaign_users.id "
                    . "LEFT JOIN tbl_subscribers ON tbl_nps_campaign_users.subscriber_id = tbl_subscribers.id "
                    . "WHERE tbl_nps_campaign_users.status = '1' AND tbl_subscribers.status = '1' AND tbl_nps_automations_triggers.auto_event_id='{$previousID}' OR tbl_nps_automations_triggers.auto_event_id='{$currentInviterID}' AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) ORDER BY tbl_nps_automations_triggers.id ASC";
        } else {
            $sql = "SELECT tbl_nps_campaign_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, "
                    . "tbl_nps_automations_triggers.auto_event_id, tbl_nps_automations_triggers.preceded_by, "
                    . "tbl_nps_automations_triggers.start_at "
                    . "FROM tbl_nps_automations_events "
                    . "LEFT JOIN tbl_nps_automations_triggers ON tbl_nps_automations_events.id = tbl_nps_automations_triggers.auto_event_id "
                    . "LEFT JOIN tbl_nps_campaign_users ON tbl_nps_automations_triggers.subscriber_id=tbl_nps_campaign_users.id "
                    . "LEFT JOIN tbl_subscribers ON tbl_nps_campaign_users.subscriber_id = tbl_subscribers.id "
                    . "WHERE tbl_nps_automations_triggers.auto_event_id='{$previousID}' AND tbl_nps_campaign_users.status = '1' AND tbl_subscribers.status = '1' "
                    . "AND tbl_nps_automations_triggers.subscriber_id NOT IN(SELECT subscriber_id FROM tbl_nps_automations_triggers "
                    . "WHERE auto_event_id='{$currentInviterID}') AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list)";
        }

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Checks if a campaign is already sent
     * @param type $campaignID
     * @param type $subscriberID
     * @param type $fieldName
     * @param type $fieldValue
     * @return boolean
     */
    public function checkIfCampaignSent($campaignID, $subscriberID, $fieldName = '', $fieldValue = '') {
        $oData = DB::table('tbl_nps_automations_tracking_logs')
                ->where('campaign_id', $campaignID)
                ->when((!empty($fieldName) && !empty($fieldValue)), function ($query) use ($fieldName, $fieldValue) {
                    return $query->where($fieldName, $fieldValue);
                }, function ($query) use ($subscriberID) {
                    return $query->where('subscriber_id', $subscriberID);
                })
                ->exists();
        return $oData;
    }

    /**
     * 
     * @param type $campaignID
     * @param type $subscriberID
     * @param type $campaignType
     * @return int
     */
    public function countCampaignSentFrequence($campaignID, $subscriberID, $campaignType) {
        $oData = DB::table('tbl_nps_automations_tracking_logs')
                ->where('campaign_id', $campaignID)
                ->where('subscriber_id', $subscriberID)
                ->where('campaign_type', $campaignType)
                ->count();
        return $oData;
    }

    /**
     * Used to save sms tracking log
     * @param type $aData
     * @return type
     */
    public function saveSMSTrackLog($aData) {
        $insertID = DB::table('tbl_track_twillio')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to save short sms url
     * @param type $aData
     * @return type
     */
    public function saveShortURL($aData) {
        $insertID = DB::table('tbl_sms_short_url')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to get Twilio account details
     * @param type $clientID
     * @return type
     */
    public function getTwilioAccount($clientID) {
        $oData = DB::table('tbl_twilio_accounts')
                ->where('user_id', $clientID)
                ->where('status', 1)
                ->first();
        return $oData;
    }

    /**
     * Used to get Sendgrid account details
     * @param type $clientID
     * @return type
     */
    public function getSendgridAccount($clientID) {
        $oData = DB::table('tbl_sendgrid_accounts')
                ->where('user_id', $clientID)
                ->where('status', 1)
                ->first();
        return $oData;
    }

    /**
     * Used to check if NPS score is given
     * @param type $accountID
     * @param type $subscriberID
     * @return boolean
     */
    public function checkIfNPSScoreGiven($accountID, $subscriberID) {
        $oData = DB::table('tbl_nps_score')
                ->where('refkey', $accountID)
                ->where('subscriber_id', $subscriberID)
                ->exists();
        return $oData;        
    }

}
