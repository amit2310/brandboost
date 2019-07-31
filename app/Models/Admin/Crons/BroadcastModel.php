<?php

namespace App\Models\Admin\Crons;

use Illuminate\Database\Eloquent\Model;

class BroadcastModel extends Model {

    /**
     * Used to get all events involving in the broadcast module
     * @return type
     */
    public function getInviterEvents() {
        $oData = DB::table('tbl_automations_emails_events')
                ->join('tbl_automations_emails', 'tbl_automations_emails.id', '=', 'tbl_automations_emails_events.automation_id')
                ->leftJoin('tbl_users', 'tbl_automations_emails.user_id', '=', 'tbl_users.id')
                ->select('tbl_automations_emails_events.*', 'tbl_automations_emails.user_id AS client_id', 'tbl_users.firstname AS client_first_name', 'tbl_users.lastname AS client_last_name', 'tbl_users.email AS client_email', 'tbl_users.mobile AS client_phone')
                ->where('tbl_automations_emails.email_type', 'broadcast')
                ->where('tbl_automations_emails.status', 'active')
                ->where('tbl_automations_emails_events.status', 'active')
                ->where('tbl_automations_emails.deleted', '!=', '1')
                ->orderBy('tbl_automations_emails_events.id', 'desc')
                ->get();
        return $oData;        
    }

    /**
     * Used to get the list of subscribers of a broadcast campaign
     * @param type $broadcastID
     * @return type
     */
    public function getInviterEligibleSubscribers($broadcastID) {
        $sql = "SELECT tbl_broadcast_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone FROM tbl_broadcast_users "
                . "LEFT JOIN tbl_subscribers ON tbl_broadcast_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_broadcast_users.broadcast_id='$broadcastID' "
                . "AND tbl_broadcast_users.status = '1' "
                . "AND tbl_subscribers.status = '1' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) "
                . "GROUP BY tbl_subscribers.email ORDER BY tbl_broadcast_users.id ASC";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * 
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
     * Used to get list of end campaigns by inviter id
     * @param type $inviterID
     * @return type
     */
    public function getBroadcastCampaign($inviterID) {
        $sql = "SELECT * FROM tbl_automations_emails_campaigns WHERE event_id='$inviterID' AND (status ='active' OR status='1')";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to get split campaigns
     * @param type $inviterID
     * @return type
     */
    public function getBroadcastSplitCampaign($inviterID) {
        $oData = DB::table('tbl_broadcast_split_campaigns')
                ->where('event_id', $inviterID)
                ->where('status', 'active')
                ->orderBy('id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * Used to get broadcast info 
     * @param type $id
     * @return type
     */
    public function getBroadcast($id) {
        $oData = DB::table('tbl_automations_emails')
                ->where('id', $id)
                ->first();
        return $oData;        
    }

    /**
     * Used to replace email tags used in the broadcast email
     * @param type $broadcastID
     * @param type $sHtml
     * @param type $campaignType
     * @param type $subscriberInfo
     * @return type
     */
    public function emailTagReplace($broadcastID, $sHtml, $campaignType = 'email', $subscriberInfo) {
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

    /**
     * Used to save email lists in the queue if enabled
     * @param type $aData
     * @return type
     */
    public function saveInviterQueue($aData) {
        $insertID = DB::table('tbl_broadcast_emails_inviter_queue')->insertGetId($aData);
        return $insertID;        
    }

    
    /**
     * 
     * @param type $campaignID
     * @param type $subscriberID
     * @param type $fieldName
     * @param type $fieldValue
     * @return boolean
     */
    public function checkIfCampaignSent($campaignID, $subscriberID, $fieldName = '', $fieldValue = '') {
        $oData = DB::table('tbl_broadcast_emails_tracking_logs')
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
     * Used to save trigger data of a broadcast campaign
     * @param type $aData
     * @return type
     */
    public function saveTriggerData($aData) {
        $insertID = DB::table('tbl_automations_emails_triggers')->insertGetId($aData);
        return $insertID;        
    }

    
    /**
     * Used to save sending logs
     * @param type $aData
     * @return type
     */
    public function saveSendingLog($aData) {
        $insertID = DB::table('tbl_broadcast_emails_tracking_logs')->insertGetId($aData);
        return $insertID;        
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

}
