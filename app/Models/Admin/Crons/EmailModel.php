<?php

namespace App\Models\Admin\Crons;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmailModel extends Model {

    /**
     * Used to get all events involving in the email automation module
     * @return type
     */
    public function getInviterEvents() {
        $oData = DB::table('tbl_automations_emails_events')
                ->join('tbl_automations_emails', 'tbl_automations_emails.id', '=', 'tbl_automations_emails_events.automation_id')
                ->leftJoin('tbl_users', 'tbl_automations_emails.user_id', '=', 'tbl_users.id')
                ->select('tbl_automations_emails_events.*', 'tbl_automations_emails.user_id AS client_id', 'tbl_users.firstname AS client_first_name', 'tbl_users.lastname AS client_last_name', 'tbl_users.email AS client_email', 'tbl_users.mobile AS client_phone')
                ->where('tbl_automations_emails.email_type', 'automation')
                ->where('tbl_automations_emails.status', 'active')
                ->where('tbl_automations_emails_events.status', 'active')
                ->where('tbl_automations_emails.deleted', '!=', '1')
                ->orderBy('tbl_automations_emails_events.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Used to get eligible subscribers for selected campaign
     * @param type $automationID
     * @return type
     */
    public function getInviterEligibleSubscribers($automationID) {
        $sql = "SELECT tbl_automations_emails_campaign_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone FROM tbl_automations_emails_campaign_users "
                . "LEFT JOIN tbl_subscribers ON tbl_automations_emails_campaign_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_automations_emails_campaign_users.automation_id='$automationID' "
                . "AND tbl_automations_emails_campaign_users.status = '1' "
                . "AND tbl_subscribers.status = '1' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) "
                . "GROUP BY tbl_subscribers.email ORDER BY tbl_automations_emails_campaign_users.id ASC";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to check if review is submitted by subscriber
     * @param type $inviterID
     * @param type $userID
     * @return type
     */
    public function checkIfSubmittedReview($inviterID, $userID) {
        $oData = DB::table('tbl_reviews')
                ->where('user_id', $userID)
                ->where('inviter_campaign_id', $inviterID)
                ->exists();
        return $oData;
    }

    /**
     * Get eligible list of subscribers for selected followup campaign
     * @param type $currentInviterID
     * @param type $previousID
     * @return type
     */
    public function getInviterFollowupSubscribers($currentInviterID, $previousID) {
        $sql = "SELECT tbl_automations_emails_campaign_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, "
                . "tbl_automations_emails_triggers.auto_event_id, tbl_automations_emails_triggers.subscriber_id, tbl_automations_emails_triggers.preceded_by, tbl_automations_emails_triggers.start_at "
                . "FROM tbl_automations_emails_events "
                . "LEFT JOIN tbl_automations_emails_triggers ON tbl_automations_emails_events.id = tbl_automations_emails_triggers.auto_event_id "
                . "LEFT JOIN tbl_automations_emails_campaign_users ON tbl_automations_emails_triggers.subscriber_id=tbl_automations_emails_campaign_users.id "
                . "LEFT JOIN tbl_subscribers ON tbl_automations_emails_campaign_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_automations_emails_triggers.auto_event_id='{$previousID}' AND tbl_automations_emails_campaign_users.status = '1' AND tbl_subscribers.status = '1' "
                . "AND tbl_automations_emails_triggers.subscriber_id NOT IN(SELECT subscriber_id FROM tbl_automations_emails_triggers "
                . "WHERE auto_event_id='{$currentInviterID}')";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to get list of inviter subscribers
     * @param type $bbID
     * @return type
     */
    public function getInviteSubscribers($bbID) {
        $oData = DB::table('tbl_brandboost_users')
                ->where('brandboost_id', $bbID)
                ->where('status', 1)
                ->get();
        return $oData;
    }

    /**
     * Used to get automation list
     * @param type $automationID
     * @return type
     */
    public function getAutomationLists($automationID) {
        $oData = DB::table('tbl_automations_emails_lists')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * Get the list of all triggered subscribers
     * @param type $inviterID
     * @return type
     */
    public function getTriggeredSubscribers($inviterID) {
        $oData = DB::table('tbl_automations_emails_triggers')
                ->select('subscriber_id')
                ->where('auto_event_id', $inviterID)
                ->get();
        $response = array();
        if ($oData->isNotEmpty()) {
            foreach ($oData as $oSubs) {
                $response[] = $oSubs->subscriber_id;
            }
        }
        return $response;
    }

    /**
     * Get eligible list of reminder campaign subscribers for selected campaign
     * @param type $bbID
     * @param type $inviterID
     * @param type $previousInviterID
     * @return type
     */
    public function getReminderEligibleSubscribers($bbID, $inviterID, $previousInviterID) {
        $sql = "SELECT tbl_brandboost_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, "
                . "tbl_brandboost_trigger.inviter_id, tbl_brandboost_trigger.start_at, tbl_brandboost_trigger.created_at "
                . "FROM tbl_brandboost_trigger "
                . "LEFT JOIN tbl_brandboost_events ON tbl_brandboost_trigger.inviter_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_brandboost_users.id = tbl_brandboost_trigger.subscriber_id "
                . "LEFT JOIN tbl_subscribers ON tbl_automation_users.subscriber_id=tbl_subscribers.id "
                . "WHERE  tbl_brandboost_events.brandboost_id = '{$bbID}' "
                . "AND tbl_brandboost_trigger.inviter_id = '{$previousInviterID}' "
                . "AND tbl_brandboost_users.status='1' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list)";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get eligible subscribers for thank you email/sms
     * @param type $bbID
     * @param type $inviterID
     * @return type
     */
    public function getThankYouEligibleSubscribers($bbID, $inviterID) {
        /* $sql = "SELECT tbl_brandboost_users.*, tbl_reviews.created AS review_date "
          . "FROM tbl_reviews "
          . "LEFT JOIN tbl_brandboost_users ON tbl_reviews.user_id = tbl_brandboost_users.user_id "
          . "LEFT JOIN tbl_brandboost_trigger ON tbl_brandboost_users.id = tbl_brandboost_trigger.subscriber_id "
          . "WHERE tbl_reviews.campaign_id='{$bbID}' "
          . "AND tbl_brandboost_trigger.inviter_id != '{$inviterID}' "
          . "GROUP BY tbl_reviews.user_id"; */

        $sql = "SELECT tbl_brandboost_users.*, tbl_reviews.created AS review_date "
                . "FROM tbl_reviews "
                . "INNER JOIN tbl_brandboost_users ON tbl_reviews.user_id = tbl_brandboost_users.user_id "
                . "WHERE  tbl_reviews.campaign_id = '{$bbID}'";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to check if a review is given by a subscriber for a specific campaign
     * @param type $bbID
     * @param type $userID
     * @return type
     */
    public function checkIfReviewGiven($bbID, $userID) {
        $oData = DB::table('tbl_reviews')
                ->where('campaign_id', $bbID)
                ->where('user_id', $userID)
                ->exists();
        return $oData;
    }

    /**
     * used to check if a feedback is given or not by a subscriber for a specific campaign
     * @param type $bbID
     * @param type $subsID
     * @return type
     */
    public function checkIfFeedbackGiven($bbID, $subsID) {
        $oData = DB::table('tbl_brandboost_feedback')
                ->where('brandboost_id', $bbID)
                ->where('subscriber_id', $subsID)
                ->exists();
        return $oData;
    }

    /**
     * Checks if email/sms sent to a subscriber
     * @param type $inviterID
     * @param type $subscriberID
     * @return type
     */
    function checkIfSent($inviterID, $subscriberID) {
        $oData = DB::table('tbl_brandboost_trigger')
                ->where('inviter_id', $inviterID)
                ->where('subscriber_id', $subscriberID)
                ->exists();
        return $oData;
    }

    /**
     * Used to get end campaigns for selected inviter event
     * @param type $inviterID
     * @return type
     */
    public function getAutomationCampaign($inviterID) {
        $sql = "SELECT * FROM tbl_automations_emails_campaigns WHERE event_id='$inviterID' AND (status ='active' OR status='1')";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to save email lists in the queue if enabled
     * @param type $aData
     * @return type
     */
    public function saveInviterQueue($aData) {
        $insertID = DB::table('tbl_automations_emails_inviter_queue')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Saves Trigger Data
     * @param type $aData
     * @return type
     */
    public function saveTriggerData($aData) {
        $insertID = DB::table('tbl_automations_emails_triggers')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Saves Sending Logs
     * @param type $aData
     * @return type
     */
    public function saveSendingLog($aData) {
        $insertID = DB::table('tbl_automations_emails_tracking_logs')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Saves Sms Tracking Log
     * @param type $aData
     * @return type
     */
    public function saveSMSTrackLog($aData) {
        $insertID = DB::table('tbl_track_twillio')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Saves Short Url
     * @param type $aData
     * @return type
     */
    public function saveShortURL($aData) {
        $insertID = DB::table('tbl_sms_short_url')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Not being used now since we are calling this fuction from the helper file
     * @param type $aData
     * @return boolean
     */
    public function updateUsage($aData = array()) {
        if (!empty($aData['client_id'])) {
            $aCurrentUsage = $this->getCurrentUsage($aData['client_id']);
            if (!empty($aCurrentUsage)) {
                $aEmailBalance = $aCurrentUsage->email_balance;
                $aEmailTopupBalance = $aCurrentUsage->email_balance_topup;

                $aSmsBalanace = $aCurrentUsage->sms_balance;
                $aSmsTopupBalance = $aCurrentUsage->sms_balance_topup;

                if ($aData['usage_type'] == 'email') {
                    if ($aEmailBalance < 1 && $aEmailTopupBalance < 1) {
                        return false;
                    }

                    if ($aEmailBalance > 0) {
                        $sFieldName = '`email_balance`';
                    } else if ($aEmailTopupBalance > 0) {
                        $sFieldName = '`email_balance_topup`';
                    }

                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} -1 WHERE user_id='" . $aData['client_id'] . "'";
                } else if ($aData['usage_type'] == 'sms') {
                    if ($aSmsBalanace < 1 && $aSmsTopupBalance < 1) {
                        return false;
                    }

                    if ($aSmsBalanace > 0) {
                        $sFieldName = '`sms_balance`';
                    } else if ($aSmsTopupBalance > 0) {
                        $sFieldName = '`sms_balance_topup`';
                    }
                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} -1 WHERE user_id='" . $aData['client_id'] . "'";
                }
                $result = $this->db->query($sql);
                if ($result)
                    return true;
                else
                    return false;
            }
            return false;
        }
        return false;
    }

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
     * Used to get Twilio Account related information
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
     * Used to get sendgrid account related information of a client
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
     * Used to get Automation related information
     * @param type $automationID
     * @return type
     */
    public function getAutomationInfo($automationID) {
        $oData = DB::table('tbl_automations_emails')
                ->where('id', $automationID)
                ->first();
        return $oData;
    }

    /**
     * Used to get offiste website
     * @param type $id
     * @return type
     */
    public function getOffsiteWebsite($id) {
        $oData = DB::table('tbl_offsite_websites')
                ->where('id', $id)
                ->first();
        return $oData;
    }

    /**
     * Checks if a campaign sent
     * @param type $campaignID
     * @param type $subscriberID
     * @param type $fieldName
     * @param type $fieldValue
     * @return type
     */
    public function checkIfCampaignSent($campaignID, $subscriberID, $fieldName = '', $fieldValue = '') {
        $oData = DB::table('tbl_automations_emails_tracking_logs')
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
     * Replaces email templates tags
     * @param type $automationID
     * @param type $sHtml
     * @param type $campaignType
     * @param type $subscriberInfo
     * @return type
     */
    public function emailTagReplace($automationID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        $aTags = config('bbconfig.email_tags');
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

                    case '{WEBSITE}':
                        $htmlData = base_url();
                        break;

                    case '{PHONE}':
                        $htmlData = ($subscriberInfo->phone) ? $subscriberInfo->phone : $subscriberInfo->mobile;
                        break;
                }
                $sHtml = str_replace($sTag, $htmlData, $sHtml);
            }
        }
        return $sHtml;
    }

}
