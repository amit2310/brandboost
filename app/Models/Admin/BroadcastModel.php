<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class BroadcastModel extends Model {

    /**
     * Used to get Broadcast campaigns by type e.i broadcast or automation
     * @param type $userID
     * @param type $campaign_type
     * @param type $id
     * @return type
     */
    public function getMyBroadcastsByTypes($userID, $campaign_type = '', $id = 0) {

        $oData = DB::table('tbl_automations_emails')
                ->leftJoin('tbl_automations_emails_events', 'tbl_automations_emails_events.automation_id', '=', 'tbl_automations_emails.id')
                ->leftJoin('tbl_automations_emails_campaigns', 'tbl_automations_emails_campaigns.event_id', '=', 'tbl_automations_emails_events.id')
                ->select('tbl_automations_emails_campaigns.*', 'tbl_automations_emails.id as broadcast_id', 'tbl_automations_emails.user_id', 'tbl_automations_emails.title', 'tbl_automations_emails.description', 'tbl_automations_emails.email_type', 'tbl_automations_emails.status as bc_status', 'tbl_automations_emails.created', 'tbl_automations_emails.sending_method', 'tbl_automations_emails_events.event_type', 'tbl_automations_emails_events.data')
                ->where('tbl_automations_emails.deleted', 0)
                ->where('tbl_automations_emails.email_type', 'broadcast')
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_automations_emails.user_id', $userID);
                })
                ->when(($id > 0), function ($query) use ($id) {
                    return $query->where('tbl_automations_emails.id', $id);
                })
                ->when(!empty($campaign_type), function ($query) use ($campaign_type) {
                    return $query->where('tbl_automations_emails_campaigns.campaign_type', $campaign_type);
                })
                ->orderBy('tbl_automations_emails.id', 'asc')
                ->get();

        return $oData;
    }

    /**
     * Used to get all templates
     * @param type $userID
     * @return type
     */
    public function getMyCampaignTemplate($userID = 0) {
        $oData = DB::table('tbl_automations_emails_campaigns_templates')
                ->where('status', 1)
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query
                            ->where('user_id', $userID)
                            ->orWhere('user_id', 0);
                })
                ->get();
        return $oData;
    }

    /**
     * Used to get broadcast email sendgrid stats
     * @param type $param
     * @param type $id
     * @param type $eventType
     * @param type $sendingMethod
     * @return type
     */
    public function getBroadcastSendgridStats($param, $id, $eventType = '', $sendingMethod = 'normal') {

        $campaignTable = ($sendingMethod == 'split') ? 'tbl_broadcast_split_campaigns' : 'tbl_automations_emails_campaigns';

        $sql = "SELECT tbl_broadcast_emails_tracking_sendgrid.*, tbl_broadcast_users.subscriber_id as global_subscriber_id FROM tbl_broadcast_emails_tracking_sendgrid "
                . "LEFT JOIN tbl_automations_emails ON tbl_broadcast_emails_tracking_sendgrid.broadcast_id = tbl_automations_emails.id "
                . "LEFT JOIN tbl_automations_emails_events ON tbl_broadcast_emails_tracking_sendgrid.event_id = tbl_automations_emails_events.id "
                . "LEFT JOIN {$campaignTable} ON tbl_broadcast_emails_tracking_sendgrid.campaign_id= {$campaignTable}.id "
                . "LEFT JOIN tbl_broadcast_users ON tbl_broadcast_emails_tracking_sendgrid.subscriber_id = tbl_broadcast_users.id ";

        if ($param == 'broadcast') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_sendgrid.broadcast_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.event_name='deferred' ";
        }

        if ($sendingMethod == 'normal') {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.sending_method = 'normal' ";
        } else {
            $sql .= "AND tbl_broadcast_emails_tracking_sendgrid.sending_method = 'split' ";
        }

        $sql .= "ORDER BY tbl_broadcast_emails_tracking_sendgrid.id DESC";

        $oData = DB::select(DB::raw($sql));

        return $oData;
    }

    /**
     * Returns categorized stats
     * @param type $oData
     * @return array
     */
    public function getBroadcastSendgridCategorizedStatsData($oData) {
        $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
        $openUniqueCount = $deliveredUniqueCount = $processedUniqueCount = $clickTotalCount = $clickUniqueCount = $bounceTotalCount = $bounceUniqueCount = $unsubscribeTotalCount = $unsubscribeUniqueCount = $droppedTotalCount = $droppedUniqueCount = $spamTotalCount = $spamUniqueCount = $groupResubscribeTotalCount = $groupResubscribeUniqueCount = $groupUnsubscribeTotalCount = $groupUnsubscribeUniqueCount = $deferredTotalCount = $deferredUniqueCount = $otherTotalCount = $otherUniqueCount = $otherDuplicateCount = $openTotalCount = $processedTotalCount = $deliveredTotalCount = array();
        $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
        if (!empty($oData)) {
            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'open') {
                    $openTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $openUniqueCount) == true) {
                        $openDuplicateCount[] = $oRow;
                    } else {
                        $openUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'click') {
                    $clickTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $clickUniqueCount) == true) {
                        $clickDuplicateCount[] = $oRow;
                    } else {
                        $clickUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'processed') {
                    $processedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $processedUniqueCount) == true) {
                        $processedDuplicateCount[] = $oRow;
                    } else {
                        $processedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'bounce') {
                    $bounceTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $bounceUniqueCount) == true) {
                        $bounceDuplicateCount[] = $oRow;
                    } else {
                        $bounceUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'unsubscribe') {
                    $unsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $unsubscribeUniqueCount) == true) {
                        $unsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $unsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'dropped') {
                    $droppedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $droppedUniqueCount) == true) {
                        $droppedDuplicateCount[] = $oRow;
                    } else {
                        $droppedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'spam_report') {
                    $spamTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $spamUniqueCount) == true) {
                        $spamDuplicateCount[] = $oRow;
                    } else {
                        $spamUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_resubscribe') {
                    $groupResubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $groupResubscribeUniqueCount) == true) {
                        $groupResubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupResubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_unsubscribe') {
                    $groupUnsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $groupUnsubscribeUniqueCount) == true) {
                        $groupUnsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupUnsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'deferred') {
                    $deferredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $deferredUniqueCount) == true) {
                        $deferredDuplicateCount[] = $oRow;
                    } else {
                        $deferredUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $otherUniqueCount) == true) {
                        $otherDuplicateCount[] = $oRow;
                    } else {
                        $otherUniqueCount[] = $oRow;
                    }
                }
            }
        }
        //Okay Now print result
        $aCatogerizedData = array(
            'open' => array(
                'TotalCount' => count($openTotalCount),
                'UniqueCount' => count($openUniqueCount),
                'DuplicateCount' => count($openDuplicateCount),
                'totalData' => $openTotalCount,
                'UniqueData' => $openUniqueCount,
                'DuplicateData' => $openDuplicateCount
            ),
            'click' => array(
                'TotalCount' => count($clickTotalCount),
                'UniqueCount' => count($clickUniqueCount),
                'DuplicateCount' => count($clickDuplicateCount),
                'totalData' => $clickTotalCount,
                'UniqueData' => $clickUniqueCount,
                'DuplicateData' => $clickDuplicateCount
            ),
            'processed' => array(
                'TotalCount' => count($processedTotalCount),
                'UniqueCount' => count($processedUniqueCount),
                'DuplicateCount' => count($processedDuplicateCount),
                'totalData' => $processedTotalCount,
                'UniqueData' => $processedUniqueCount,
                'DuplicateData' => $processedDuplicateCount
            ),
            'delivered' => array(
                'TotalCount' => count($deliveredTotalCount),
                'UniqueCount' => count($deliveredUniqueCount),
                'DuplicateCount' => count($deliveredDuplicateCount),
                'totalData' => $deliveredTotalCount,
                'UniqueData' => $deliveredUniqueCount,
                'DuplicateData' => $deliveredDuplicateCount
            ),
            'bounce' => array(
                'TotalCount' => count($bounceTotalCount),
                'UniqueCount' => count($bounceUniqueCount),
                'DuplicateCount' => count($bounceDuplicateCount),
                'totalData' => $bounceTotalCount,
                'UniqueData' => $bounceUniqueCount,
                'DuplicateData' => $bounceDuplicateCount
            ),
            'unsubscribe' => array(
                'TotalCount' => count($unsubscribeTotalCount),
                'UniqueCount' => count($unsubscribeUniqueCount),
                'DuplicateCount' => count($unsubscribeDuplicateCount),
                'totalData' => $unsubscribeTotalCount,
                'UniqueData' => $unsubscribeUniqueCount,
                'DuplicateData' => $unsubscribeDuplicateCount
            ),
            'dropped' => array(
                'TotalCount' => count($droppedTotalCount),
                'UniqueCount' => count($droppedUniqueCount),
                'DuplicateCount' => count($droppedDuplicateCount),
                'totalData' => $droppedTotalCount,
                'UniqueData' => $droppedUniqueCount,
                'DuplicateData' => $droppedDuplicateCount
            ),
            'spam_report' => array(
                'TotalCount' => count($spamTotalCount),
                'UniqueCount' => count($spamUniqueCount),
                'DuplicateCount' => count($spamDuplicateCount),
                'totalData' => $spamTotalCount,
                'UniqueData' => $spamUniqueCount,
                'DuplicateData' => $spamDuplicateCount
            ),
            'group_resubscribe' => array(
                'TotalCount' => count($groupResubscribeTotalCount),
                'UniqueCount' => count($groupResubscribeUniqueCount),
                'DuplicateCount' => count($groupResubscribeDuplicateCount),
                'totalData' => $groupResubscribeTotalCount,
                'UniqueData' => $groupResubscribeUniqueCount,
                'DuplicateData' => $groupResubscribeDuplicateCount
            ),
            'group_unsubscribe' => array(
                'TotalCount' => count($groupUnsubscribeTotalCount),
                'UniqueCount' => count($groupUnsubscribeUniqueCount),
                'DuplicateCount' => count($groupUnsubscribeDuplicateCount),
                'totalData' => $groupUnsubscribeTotalCount,
                'UniqueData' => $groupUnsubscribeUniqueCount,
                'DuplicateData' => $groupUnsubscribeDuplicateCount
            ),
            'deferred' => array(
                'TotalCount' => count($deferredTotalCount),
                'UniqueCount' => count($deferredUniqueCount),
                'DuplicateCount' => count($deferredDuplicateCount),
                'totalData' => $deferredTotalCount,
                'UniqueData' => $deferredUniqueCount,
                'DuplicateData' => $deferredDuplicateCount
            ),
            'other' => array(
                'TotalCount' => count($otherTotalCount),
                'UniqueCount' => count($otherUniqueCount),
                'DuplicateCount' => count($otherDuplicateCount),
                'totalData' => $otherTotalCount,
                'UniqueData' => $otherUniqueCount,
                'DuplicateData' => $otherDuplicateCount
            )
        );

        return $aCatogerizedData;
    }

    /**
     * Used to get Broadcast Variations
     * @param type $broadcastID
     * @return type
     */
    public function getBroadcastVariations($broadcastID) {
        $oData = DB::table('tbl_broadcast_split_campaigns')
                ->leftJoin('tbl_broadcast_split_testing', 'tbl_broadcast_split_campaigns.split_test_id', '=', 'tbl_broadcast_split_testing.id')
                ->select('tbl_broadcast_split_campaigns.*', 'tbl_broadcast_split_testing.test_name', 'tbl_broadcast_split_testing.id as splitID')
                ->where('tbl_broadcast_split_campaigns.broadcast_id', $broadcastID)
                ->where('tbl_broadcast_split_campaigns.status', 'active')
                ->orderBy('tbl_broadcast_split_campaigns.id', 'asc')
                ->get();

        return $oData;
    }

    /**
     * 
     * @param type $userID
     * @return typeUsed to get lists associated with the logged user
     */
    public function getMyLists($userID = '') {

        $oData = DB::table('tbl_common_lists')
                ->leftJoin('tbl_automation_users', 'tbl_automation_users.list_id', '=', 'tbl_common_lists.id')
                ->leftJoin('tbl_subscribers', 'tbl_automation_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->join('tbl_users', 'tbl_users.id', '=', 'tbl_common_lists.user_id')
                ->select('tbl_common_lists.*', 'tbl_automation_users.list_id as l_list_id', 'tbl_automation_users.user_id as l_user_id', 'tbl_subscribers.firstname as l_firstname', 'tbl_subscribers.lastname as l_lastname', 'tbl_subscribers.email as l_email', 'tbl_subscribers.phone as l_phone', 'tbl_subscribers.created as l_created', 'tbl_automation_users.status as l_status', DB::raw("CONCAT(tbl_users.firstname,' ', tbl_users.lastname) as lCreateUsername"), 'tbl_users.email as cEmail', 'tbl_users.mobile as cMobile')
                ->where('tbl_common_lists.delete_status', 0)
                ->where('tbl_common_lists.status', 'active')
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_common_lists.user_id', $userID);
                })
                ->orderBy('tbl_common_lists.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $userID
     * @return typeUsed to get Twillio related account details
     */
    public function getTwillioData($userID) {
        $oData = DB::table('tbl_twilio_accounts')
                ->where('user_id', $userID)
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $userID
     * @param type $id
     * @return typeUsed to get logged user's broadcast campaign
     */
    public function getMyBroadcasts($userID, $id = 0) {

        $oData = DB::table('tbl_automations_emails')
                ->leftJoin('tbl_automations_emails_events', 'tbl_automations_emails_events.automation_id', '=', 'tbl_automations_emails.id')
                ->leftJoin('tbl_automations_emails_campaigns', 'tbl_automations_emails_campaigns.event_id', '=', 'tbl_automations_emails_events.id')
                ->select('tbl_automations_emails_campaigns.*', 'tbl_automations_emails.id as broadcast_id', 'tbl_automations_emails.user_id', 'tbl_automations_emails.title', 'tbl_automations_emails.description', 'tbl_automations_emails.email_type', 'tbl_automations_emails.status as bc_status', 'tbl_automations_emails.current_state', 'tbl_automations_emails.audience_type', 'tbl_automations_emails.sending_method', 'tbl_automations_emails.created', 'tbl_automations_emails_events.event_type', 'tbl_automations_emails_events.data', 'tbl_automations_emails_events.id as evtid')
                ->where('tbl_automations_emails.deleted', 0)
                ->where('tbl_automations_emails.email_type', 'broadcast')
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_automations_emails.user_id', $userID);
                })
                ->when(($id > 0), function ($query) use ($id) {
                    return $query->where('tbl_automations_emails.id', $id);
                })
                ->orderBy('tbl_automations_emails.id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $automationID
     * @return typeUsed to get Automation lists
     */
    public function getAutomationLists($automationID) {
        $oData = DB::table('tbl_automations_emails_lists')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $automationID
     * @return typeUsed to get broadcast users list
     */
    public function getBroadcastContacts($automationID) {
        $oData = DB::table('tbl_automation_users')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * Used to get Excluded lists users
     */
    public function getAutomationExcludedLists($automationID) {
        $oData = DB::table('tbl_automations_emails_lists_excluded')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $automationID
     * @return typeUsed to get the list of excluded users
     */
    public function getBroadcastExcludedContacts($automationID) {
        $oData = DB::table('tbl_automation_users_excluded')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * Used to add users into the broadcast campaign
     * @param type $aData
     * @return boolean
     */
    public function addContactToCampaign($aData) {
        $insert_id = DB::table('tbl_automation_users')
                ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to add users into the excluded list of contacts of a broadcast campaign
     * @param type $aData
     * @return type
     */
    public function addContactToExcludeCampaign($aData) {
        $insert_id = DB::table('tbl_automation_users_excluded')
                ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to delete contact from the broadcast campaign 
     */
    public function deleteContactToCampaign($automationID, $subscriberID) {
        if ($automationID > 0) {
            $oData = DB::table('tbl_automation_users')
                    ->where('automation_id', $automationID)
                    ->where('subscriber_id', $subscriberID)
                    ->delete();
            return $oData;
        }
        return false;
    }

    /**
     * 
     * @param type $automationID
     * @param type $subscriberID
     * @return booleanUsed to delete contact from excluded list of contacts
     */
    public function deleteContactToExcludeCampaign($automationID, $subscriberID) {
        if ($automationID > 0) {
            $oData = DB::table('tbl_automation_users_excluded')
                    ->where('automation_id', $automationID)
                    ->where('subscriber_id', $subscriberID)
                    ->delete();
            return $oData;
        }
        return false;
    }

    /**
     * Used to get broadcast tags
     */
    public function getBroadcastTags($automationID) {
        $oData = DB::table('tbl_automations_emails_campaigns_tags')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * Used to get the list of excluded tags inside the broadcast campaign
     * @param type $automationID
     * @return type
     */
    public function getBroadcastExcludedTags($automationID) {

        $oData = DB::table('tbl_automations_emails_campaigns_tags_excluded')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $broadcastID
     * @return type
     */
    public function getBroadcastVariationCampaigns($broadcastID) {
        $oData = DB::table('tbl_broadcast_split_campaigns')
                ->where('tbl_broadcast_split_campaigns.broadcast_id', $broadcastID)
                ->orderBy('tbl_broadcast_split_campaigns.id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $aData
     * @param type $sendingMethod
     * @return typeUsed to add new broadcast campaign
     */
    public function addBroadcastCampaign($aData, $sendingMethod = 'normal') {

        if ($sendingMethod == 'split') {
            $insert_id = DB::table('tbl_broadcast_split_campaigns')
                    ->insertGetId($aData);
        } else {
            $insert_id = DB::table('tbl_automations_emails_campaigns')
                    ->insertGetId($aData);
        }
        return $insert_id;
    }

    /**
     * Used to add broadcast variations
     */
    public function addBroadcastVariation($aData) {
        $insert_id = DB::table('tbl_broadcast_split_campaigns')
                ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * 
     * @param type $id
     * @return booleanUsed to delete variation from the broadcast campaign
     */
    public function deleteVariation($id) {
        if ($id > 0) {
            $oData = DB::table('tbl_broadcast_split_campaigns')
                    ->where('id', $id)
                    ->delete();
        }
        return false;
    }

    /**
     * 
     * @param type $aData
     * @param type $id
     * @return booleanUsed to update broadcast variation
     */
    public function updateVariation($aData, $id) {
        if ($id > 0) {
            $oData = DB::table('tbl_broadcast_split_campaigns')
                    ->where('id', $id)
                    ->update($aData);
            return $oData;
        }
        return false;
    }

    /**
     * 
     * @param type $aData
     * @param type $id
     * @return booleanUsed to update split test 
     */
    public function updateSplitTest($aData, $id) {
        if ($id > 0) {
            $oData = DB::table('tbl_broadcast_split_testing')
                    ->where('id', $id)
                    ->update($aData);
            return $oData;
        }
        return false;
    }

    /**
     * Used to create new broadcast campaign
     * @param type $aData
     * @return boolean
     */
    public function createBroadcast($aData) {
        $insert_id = DB::table('tbl_automations_emails')
                ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to create split test
     * @param type $aData
     * @return type
     */
    public function createSplitTest($aData) {
        $insert_id = DB::table('tbl_broadcast_split_testing')
                ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to add new segment 
     */
    public function createSegment($aData) {
        $insert_id = DB::table('tbl_segments')
                ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to check if duplicate segment
     * @param type $segmentName
     * @param type $userID
     * @return boolean
     */
    public function isDuplicateSegment($segmentName, $userID = 0) {
        $oData = DB::table('tbl_segments')
                ->where('user_id', $userID)
                ->where('segment_name', $segmentName)
                ->exists();
        return $oData;
    }

    /**
     * Used to check if duplicate audience exists
     * @param type $broadcastID
     * @param type $subscriberID
     * @return boolean
     */
    public function isDuplicateBroadcastAudience($broadcastID, $subscriberID) {
        $oData = DB::table('tbl_broadcast_users')
                ->where('broadcast_id', $broadcastID)
                ->where('subscriber_id', $subscriberID)
                ->exists();
        return $oData;
    }

    /**
     * 
     * @param type $segmentID
     * @param type $campaignID
     * @param type $segmentType
     * @param type $campaignType
     * @param type $moduleName
     * @param type $sendingMethod
     * @return boolean
     */
    public function addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType, $moduleName = '', $sendingMethod = 'normal') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $oExistingSubscribers = array();
        $oExistingSubscribers = $this->getSegmentCoreSubscribers($segmentID);
        if (!empty($oExistingSubscribers)) {
            foreach ($oExistingSubscribers as $oSubs) {
                $aExistingSubsID[] = $oSubs->subscriber_id;
            }
        }

        if ($campaignType == 'email') {
            if ($segmentType == 'total-sent') {
                $param = 'delivered';
            } else if ($segmentType == 'total-open') {
                $param = 'open';
            } else if ($segmentType == 'total-click') {
                $param = 'click';
            }

            $oStats = $this->getBroadcastSendgridStats('broadcast', $campaignID, $param, $sendingMethod);
            $aCategorizedStats = $this->getBroadcastSendgridCategorizedStatsData($oStats);

            $oData = $aCategorizedStats[$param]['UniqueData'];
        } else if ($campaignType == 'sms') {
            if ($segmentType == 'total-sent') {
                $param = 'sent';
            } else if ($segmentType == 'total-delivered') {
                $param = 'delivered';
            } else if ($segmentType == 'total-queued') {
                $param = 'queued';
            } else if ($segmentType == 'total-undelivered') {
                $param = 'undelivered';
            } else if ($segmentType == 'total-click') {
                $param = 'click';
            }

            $oStats = $this->getBroadcasstTwilioStats('broadcast', $campaignID, $sendingMethod);
            $aCategorizedStats = $this->getBroadcastTwilioCategorizedStatsData($oStats);

            $oData = $aCategorizedStats[$param]['UniqueData'];
        }
        if (!empty($oData)) {

            //get Existing subscirbers in the segement if any
            foreach ($oData as $oStat) {
                $str = '';
                $subscriberID = $oStat->global_subscriber_id;
                if (!in_array($subscriberID, $aExistingSubsID)) {
                    $str = "(" . $userID . "," . $segmentID . "," . $subscriberID . "," . "'" . date("Y-m-d H:i:s") . "')";
                    $aSqlParam[] = $str;
                }
            }

            if (!empty($aSqlParam)) {
                $sql = "INSERT INTO `tbl_segments_users` (`user_id`, `segment_id`, `subscriber_id`, `created`) VALUES " . implode(",", $aSqlParam);

                $result = DB::statement($sql);
                if ($result) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Used to get segment subscribers
     */
    public function getSegmentCoreSubscribers($seqmentID) {
        $oData = DB::table('tbl_segments_users')
                ->where('segment_id', $seqmentID)
                ->get();
        return $oData;
    }

    /**
     * Used to get broadcast campaign info
     * @param type $id
     * @return type
     */
    public function getBroadcastInfo($id) {
        $oData = DB::table('tbl_automations_emails')
                ->where('id', $id)
                ->first();
        return $oData;
    }

    /**
     * Used to get the list of broadcast subscribers
     * @param type $broadcastID
     * @return type
     */
    public function getBroadcastSubscribers($broadcastID) {
        $oData = DB::table('tbl_broadcast_users')
                ->leftJoin('tbl_subscribers', 'tbl_broadcast_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_broadcast_users.id as local_user_id', 'tbl_subscribers.*', 'tbl_subscribers.id as subscriber_id', 'tbl_subscribers.status AS globalStatus', 'tbl_subscribers.id AS global_user_id')
                ->where('tbl_broadcast_users.broadcast_id', $broadcastID)
                ->orderBy('tbl_broadcast_users.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Used to delete subscriber from broadcast campaign
     */
    public function deleteAudienceToBraodcast($broadcastId, $subscriberID) {
        if ($broadcastId > 0) {
            $oData = DB::table('tbl_broadcast_users')
                    ->where('broadcast_id', $broadcastId)
                    ->where('subscriber_id', $subscriberID)
                    ->delete();
            return $oData;
        }
        return false;
    }

    /**
     * Used to delete broadcast audience
     * @param type $broadcastId
     * @param type $subscriberID
     * @return boolean
     */
    public function deleteBraodcastContacts($broadcastId, $subscriberID) {
        if ($broadcastId > 0) {
            $oData = DB::table('tbl_automation_users')
                    ->where('automation_id', $broadcastId)
                    ->where('subscriber_id', $subscriberID)
                    ->delete();
            return $oData;
        }
        return false;
    }

    /**
     * Used to delete subscriber by increment id
     * @param type $id
     * @return boolean
     */
    public function deleteAudienceById($id) {
        if ($id > 0) {
            $oData = DB::table('tbl_broadcast_users')
                    ->where('id', $id)
                    ->delete();
            return $oData;
        }
        return false;
    }

    /**
     * Used to add subscriber into the broadcast
     * @param type $aData
     * @return type
     */
    public function addBroadcastAudience($aData) {
        $insert_id = DB::table('tbl_broadcast_users')
                ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to get broadcast segments
     * @param type $userID
     * @param type $id
     * @return type 
     */
    public function getSegments($userID, $id = '') {
        $oData = DB::table('tbl_segments')
                ->leftJoin('tbl_automations_emails', 'tbl_segments.source_campaign_id', '=', 'tbl_automations_emails.id')
                ->select('tbl_segments.*', 'tbl_automations_emails.title as campaign_title')
                ->when(!empty($userID), function ($query) use ($userID) {
                    return $query->where('tbl_segments.user_id', $userID);
                })
                ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('tbl_segments.id', $id);
                })
                ->get();

        return $oData;
    }

    /**
     * Used to get segment subscribers
     * @param type $segmentID
     * @param type $userID
     * @return type
     */
    public function getSegmentSubscribers($segmentID, $userID) {
        $oData = DB::table('tbl_segments_users')
                ->leftJoin('tbl_subscribers', 'tbl_segments_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_segments_users.*', 'tbl_subscribers.id as globalSubscriberId', 'tbl_subscribers.user_id as subUserId', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_subscribers.status')
                ->where('tbl_segments_users.segment_id', $segmentID)
                ->where('tbl_segments_users.user_id', $userID)
                ->orderBy('tbl_subscribers.id', 'desc')
                ->get();

        return $oData;
    }

    /**
     * Used to get segment by segment id
     * @param type $userID
     * @param type $segmentId
     * @return type
     * 
     */
    public function getSegmentById($userID, $segmentId) {
        $oData = DB::table('tbl_segments')
                ->leftJoin('tbl_automations_emails', 'tbl_segments.source_campaign_id', '=', 'tbl_automations_emails.id')
                ->select('tbl_segments.*', 'tbl_automations_emails.title as campaign_title')
                ->when(!empty($userID), function ($query) use ($userID) {
                    return $query->where('tbl_segments.user_id', $userID);
                })
                ->when(!empty($segmentId), function ($query) use ($segmentId) {
                    return $query->where('tbl_segments.id', $segmentId);
                })
                ->get();

        return $oData;
    }

    /**
     * 
     * @param type $segmentID
     * @return typeUsed to delete segment by id
     */
    public function deleteSegmentByID($segmentID) {
        $result = DB::table('tbl_segments')
                ->where('id', $segmentID)
                ->delete();
        return $result;
    }

    /**
     * Used to delete segment user
     * @param type $userID
     * @return type
     */
    public function deleteSegmentUser($userID) {
        $result = DB::table('tbl_segments_users')
                ->where('id', $userID)
                ->delete();
        return $result;
    }

    /**
     * Used to update segment
     * @param type $aData
     * @param type $segmentId
     * @param type $userID
     * @return type
     */
    public function updateSegment($aData, $segmentId, $userID) {
        $result = DB::table('tbl_segments')
                ->where('id', $segmentId)
                ->when((!empty($userID)), function($query) use ($userID) {
                    return $query->orderBy('user_id', $userID);
                })
                ->update($aData);
        return $result;
    }

    /**
     * Used to update broadcast campaign
     * @param type $aData
     * @param type $autoId
     * @return type
     */
    public function updateBroadcast($aData, $autoId) {
        $result = DB::table('tbl_automations_emails')
                ->where('id', $autoId)
                ->update($aData);
        return $result;
    }

    /**
     * This function used to create broadcast event
     * @param type $aData
     * @return type
     */
    public function createBroadcastEvent($aData) {
        $insert_id = DB::table('tbl_automations_emails_events')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to create broadcast end campaign
     * @param type $aData
     * @return boolean
     */
    public function createBroadcastCampaign($aData) {
        $insert_id = DB::table('tbl_automations_emails_campaigns')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to create broadcast default variation campaign
     * @param type $aData
     * @return type
     */
    public function createBroadcastDefaultVariationCampaign($aData) {
        $insert_id = DB::table('tbl_broadcast_split_campaigns')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to update broadcast schedule date and time
     * @param type $aData
     * @param type $broadcastId
     * @return type
     */
    public function updateAutomationScheduleDate($aData, $broadcastId) {
        $result = DB::table('tbl_automations_emails_events')
                ->where('automation_id', $broadcastId)
                ->update($aData);
        return $result;
    }

    /**
     * Used to update broadcast end campaign
     * @param type $aData
     * @param type $campaignId
     * @return type
     */
    public function updateBroadcastCampaignTemplate($aData, $campaignId) {
        $result = DB::table('tbl_automations_emails_campaigns')
                ->where('id', $campaignId)
                ->update($aData);
        return $result;
    }

    /**
     * Used to update broadcast campaign by event id
     */
    public function updateBroadcastCampaign($aData, $eventId) {
        $result = DB::table('tbl_automations_emails_campaigns')
                ->where('event_id', $eventId)
                ->update($aData);
        return $result;
    }

    /**
     * Used to update broadcast settings
     * @param type $aData
     * @param type $campaignId
     * @return type 
     */
    public function updateBroadcastSettings($aData, $campaignId) {
        $result = DB::table('tbl_automations_emails_campaigns_settings')
                ->where('campaign_id', $campaignId)
                ->update($aData);
        return $result;
    }

    /**
     * 
     * @param type $campaignId
     * @return typeUsed to get broadcast settings
     */
    public function getBroadcastSettings($campaignId) {
        $oData = DB::table('tbl_automations_emails_campaigns_settings')
                ->where('campaign_id', $campaignId)
                ->get();
        return $oData;
    }

    /**
     * Used to check whether broadcast title exists or not
     * @param type $broadcastTitle
     * @param type $userID
     * @return type
     */
    public function checkBroadcastTitle($broadcastTitle, $userID) {
        $oData = DB::table('tbl_automations_emails')
                ->where('user_id', $userID)
                ->where('title', $broadcastTitle)
                ->exists();
        return $oData;
    }

    /**
     * 
     * @param type $aData
     * @return typeUsed to add broadcast settings
     */
    public function addBroadcastSettings($aData) {
        $insert_id = DB::table('tbl_automations_emails_campaigns_settings')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to broadcast subscribers from excluded subscribers list
     * @param type $automationID
     * @return type
     */
    public function getBroadcastExcludedListSubscribers($automationID) {
        $oLists = $this->getAutomationExcludedLists($automationID);
        if (!empty($oLists)) {
            foreach ($oLists as $oList) {
                $aListsIDs[] = $oList->list_id;
            }
        }
        if (empty($aListsIDs)) {
            $aListsIDs = array('-1');
        }
        $sql = "SELECT `tbl_automation_users`.*, `tbl_subscribers`.`email`,  `tbl_subscribers`.`email` as subscriber_email, `tbl_subscribers`.`firstname`, `tbl_subscribers`.`lastname`, `tbl_subscribers`.`phone`, `tbl_subscribers`.`status` AS `globalStatus` "
                . "FROM `tbl_automation_users` LEFT JOIN "
                . "`tbl_subscribers` ON `tbl_automation_users`.`subscriber_id`= `tbl_subscribers`.`id` "
                . "WHERE `tbl_automation_users`.`list_id` IN(" . implode(",", $aListsIDs) . ") "
                . "ORDER BY `tbl_automation_users`.`id` DESC";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to get broadcast subscribers from the lists
     * @param type $automationID
     * @return type
     */
    public function getBroadcastListSubscribers($automationID) {
        $oLists = $this->getAutomationLists($automationID);
        if (!empty($oLists)) {
            foreach ($oLists as $oList) {
                $aListsIDs[] = $oList->list_id;
            }
        }
        if (empty($aListsIDs)) {
            $aListsIDs = array('-1');
        }
        //write your own query
        $sql = "SELECT `tbl_automation_users`.*, `tbl_subscribers`.`email`,  `tbl_subscribers`.`email` as subscriber_email, `tbl_subscribers`.`firstname`, `tbl_subscribers`.`lastname`, `tbl_subscribers`.`phone`, `tbl_subscribers`.`status` AS `globalStatus` "
                . "FROM `tbl_automation_users` LEFT JOIN "
                . "`tbl_subscribers` ON `tbl_automation_users`.`subscriber_id`= `tbl_subscribers`.`id` "
                . "WHERE `tbl_automation_users`.`list_id` IN(" . implode(",", $aListsIDs) . ") "
                . "ORDER BY `tbl_automation_users`.`id` DESC";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to get broadcast segments from the new table
     * @param type $automationID
     * @return type
     */
    public function getBroadcastSegments($automationID) {
        $oData = DB::table('tbl_automations_emails_campaigns_segments_new')
                ->leftJoin('tbl_segments', 'tbl_automations_emails_campaigns_segments_new.segment_id', '=', 'tbl_segments.id')
                ->select('tbl_automations_emails_campaigns_segments_new.*', 'tbl_segments.segment_name')
                ->where('tbl_automations_emails_campaigns_segments_new.automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * Used to get broadcast segments from excluded segment lists
     * @param type $automationID
     * @return type
     */
    public function getBroadcastExcludedSegments($automationID) {
        $oData = DB::table('tbl_automations_emails_campaigns_segments_excluded')
                ->leftJoin('tbl_segments', 'tbl_automations_emails_campaigns_segments_excluded.segment_id', '=', 'tbl_segments.id')
                ->select('tbl_automations_emails_campaigns_segments_excluded.*', 'tbl_segments.segment_name')
                ->where('tbl_automations_emails_campaigns_segments_excluded.automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * Used to add tags into the broadcast campaign subscribers
     * @param type $aData
     * @return type
     */
    public function addTagToCampaign($aData) {
        $insert_id = DB::table('tbl_automations_emails_campaigns_tags')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to add tags into the broadcast campaign excluded list of subscribers
     * @param type $aData
     * @return type
     */
    public function addExcludedTagToCampaign($aData) {
        $insert_id = DB::table('tbl_automations_emails_campaigns_tags_excluded')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to add segment into the campaign
     * @param type $aData
     * @return type
     */
    public function addSegmentToCampaign($aData) {
        $insert_id = DB::table('tbl_automations_emails_campaigns_segments_new')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to add segment into the exlcuded list of segments
     * @param type $aData
     * @return type
     */
    public function addExcludedSegmentToCampaign($aData) {
        $insert_id = DB::table('tbl_automations_emails_campaigns_segments_excluded')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to delete segments from the campaign segments
     * @param type $automationID
     * @param type $segmentID
     * @return boolean
     */
    public function deleteSegmentToCampaign($automationID, $segmentID) {
        if ($automationID > 0) {
            $result = DB::table('tbl_automations_emails_campaigns_segments_new')
                    ->where('automation_id', $automationID)
                    ->where('segment_id', $segmentID)
                    ->delete();
            return $result;
        }
        return false;
    }

    /**
     * Used to delete excluded segment from the campaign
     * @param type $automationID
     * @param type $segmentID
     * @return boolean
     */
    public function deleteExcludedSegmentToCampaign($automationID, $segmentID) {
        if ($automationID > 0) {
            $result = DB::table('tbl_automations_emails_campaigns_segments_excluded')
                    ->where('automation_id', $automationID)
                    ->where('segment_id', $segmentID)
                    ->delete();
            return $result;
        }
        return false;
    }

    /**
     * Used to delete tags from the campaign
     * @param type $automationID
     * @param type $tagID
     * @return boolean
     */
    public function deleteTagToCampaign($automationID, $tagID) {
        if ($automationID > 0) {
            $result = DB::table('tbl_automations_emails_campaigns_tags')
                    ->where('automation_id', $automationID)
                    ->where('tag_id', $tagID)
                    ->delete();
            return $result;
        }
        return false;
    }

    /**
     * Used to delete tags from the excluded tags list
     * @param type $automationID
     * @param type $tagID
     * @return boolean
     */
    public function deleteExcludedTagToCampaign($automationID, $tagID) {
        if ($automationID > 0) {
            $result = DB::table('tbl_automations_emails_campaigns_tags_excluded')
                    ->where('automation_id', $automationID)
                    ->where('tag_id', $tagID)
                    ->delete();
            return $result;
        }
        return false;
    }
    
    /**
     * Used to get conditional broadcast subscribers
     * @param type $eventId
     * @param type $eventType
     * @return type
     */
    public function getMyBroadcastSubscribers($eventId, $eventType) {
        $oData = DB::table('tbl_broadcast_emails_tracking_sendgrid')
                ->leftJoin('tbl_broadcast_users', 'tbl_broadcast_users.id', '=', 'tbl_broadcast_emails_tracking_sendgrid.subscriber_id')
                ->leftJoin('tbl_subscribers', 'tbl_broadcast_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_broadcast_users.*', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone','tbl_broadcast_emails_tracking_sendgrid.id as tracking_id',  'tbl_broadcast_emails_tracking_sendgrid.event_name', 'tbl_broadcast_emails_tracking_sendgrid.email as e_email', 'tbl_broadcast_emails_tracking_sendgrid.created as e_created')
                ->where('tbl_broadcast_emails_tracking_sendgrid.event_id', $eventId)
                ->where('tbl_broadcast_emails_tracking_sendgrid.event_name', $eventType)
                ->groupBy('tbl_broadcast_emails_tracking_sendgrid.subscriber_id')
                ->get();
        return $oData;        
    }

    /**
     * Used to get conditional broadcast subscribers
     */
    public function getMyBroadcastSubscribersSMS($eventId, $eventType) {
        $oData = DB::table('tbl_broadcast_emails_tracking_twillio')
                ->leftJoin('tbl_broadcast_users', 'tbl_broadcast_users.id', '=', 'tbl_broadcast_emails_tracking_twillio.subscriber_id')
                ->leftJoin('tbl_subscribers', 'tbl_broadcast_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_broadcast_users.*', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone','tbl_broadcast_emails_tracking_sendgrid.id as tracking_id',  'tbl_broadcast_emails_tracking_sendgrid.event_name', 'tbl_broadcast_emails_tracking_sendgrid.email as e_email', 'tbl_broadcast_emails_tracking_sendgrid.created as e_created')
                ->where('tbl_broadcast_emails_tracking_twillio.event_id', $eventId)
                ->where('tbl_broadcast_emails_tracking_twillio.event_name', $eventType)
                ->groupBy('tbl_broadcast_emails_tracking_twillio.subscriber_id')
                ->get();
        return $oData; 
        
    }

    /**
     * Used to delete email record from the stats
     * @param type $recordID
     * @return type
     */
    public function deleteEmailRecordByID($recordID) {
        $result = DB::table('tbl_automations_emails_tracking_sendgrid')
        ->where('id', $recordID)
        ->delete();
        return $result;
    }

    
    /**
     * Used to get broadcast campaign twilio stats
     * @param type $param
     * @param type $id
     * @param type $eventType
     * @param type $sendingMethod
     * @return type
     */
    public function getBroadcasstTwilioStats($param, $id, $eventType = '', $sendingMethod = 'normal') {
        $campaignTable = ($sendingMethod == 'split') ? 'tbl_broadcast_split_campaigns' : 'tbl_automations_emails_campaigns';

        $sql = "SELECT tbl_broadcast_emails_tracking_twillio.*, tbl_broadcast_users.subscriber_id as global_subscriber_id FROM tbl_broadcast_emails_tracking_twillio "
                . "LEFT JOIN tbl_automations_emails ON tbl_broadcast_emails_tracking_twillio.broadcast_id = tbl_automations_emails.id "
                . "LEFT JOIN tbl_automations_emails_events ON tbl_broadcast_emails_tracking_twillio.event_id = tbl_automations_emails_events.id "
                . "LEFT JOIN {$campaignTable} ON tbl_broadcast_emails_tracking_twillio.campaign_id= {$campaignTable}.id "
                . "LEFT JOIN tbl_broadcast_users ON tbl_broadcast_emails_tracking_twillio.subscriber_id = tbl_broadcast_users.id ";

        if ($param == 'broadcast') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_twillio.broadcast_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_twillio.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_twillio.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_broadcast_emails_tracking_twillio.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.event_name='sending' ";
        }

        if ($sendingMethod == 'normal') {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.sending_method = 'normal' ";
        } else {
            $sql .= "AND tbl_broadcast_emails_tracking_twillio.sending_method = 'split' ";
        }

        $sql .= "ORDER BY tbl_broadcast_emails_tracking_twillio.id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    
    /**
     * Used to get categorized stats from an stats object
     * @param type $oData
     * @return array
     */
    public function getBroadcastTwilioCategorizedStatsData($oData) {
        $acceptedTotalCount = $acceptedUniqueCount = $acceptedDuplicateCount = array();
        $sentTotalCount = $sentUniqueCount = $sentDuplicateCount = array();
        $deliveredTotalCount = $deliveredUniqueCount = $deliveredDuplicateCount = array();
        $undeliveredTotalCount = $undeliveredUniqueCount = $undeliveredDuplicateCount = array();
        $failedTotalCount = $failedUniqueCount = $failedDuplicateCount = array();
        $receivingTotalCount = $receivingUniqueCount = $receivingDuplicateCount = array();
        $receivedTotalCount = $receivedUniqueCount = $receivedDuplicateCount = array();
        $queuedTotalCount = $queuedUniqueCount = $queuedDuplicateCount = array();
        $sendingTotalCount = $sendingUniqueCount = $sendingDuplicateCount = array();
        $otherTotalCount = $otherUniqueCount = $otherDuplicateCount = array();
        if (!empty($oData)) {

            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'accepted') {
                    $acceptedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $acceptedUniqueCount) == true) {
                        $acceptedDuplicateCount[] = $oRow;
                    } else {
                        $acceptedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sent') {
                    $sentTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $sentUniqueCount) == true) {
                        $sentDuplicateCount[] = $oRow;
                    } else {
                        $sentUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'undelivered') {
                    $undeliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $undeliveredUniqueCount) == true) {
                        $undeliveredDuplicateCount[] = $oRow;
                    } else {
                        $undeliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'failed') {
                    $failedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $failedUniqueCount) == true) {
                        $failedDuplicateCount[] = $oRow;
                    } else {
                        $failedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'receiving') {
                    $receivingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $receivingUniqueCount) == true) {
                        $receivingDuplicateCount[] = $oRow;
                    } else {
                        $receivingUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'received') {
                    $receivedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $receivedUniqueCount) == true) {
                        $receivedDuplicateCount[] = $oRow;
                    } else {
                        $receivedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'queued') {
                    $queuedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $queuedUniqueCount) == true) {
                        $queuedDuplicateCount[] = $oRow;
                    } else {
                        $queuedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sending') {
                    $sendingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $sendingUniqueCount) == true) {
                        $sendingDuplicateCount[] = $oRow;
                    } else {
                        $sendingUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInBroadcastStat($oRow, $otherUniqueCount) == true) {
                        $otherDuplicateCount[] = $oRow;
                    } else {
                        $otherUniqueCount[] = $oRow;
                    }
                }
            }
        }
        //Okay Now print result
        $aCatogerizedData = array(
            'accepted' => array(
                'TotalCount' => count($acceptedTotalCount),
                'UniqueCount' => count($acceptedUniqueCount),
                'DuplicateCount' => count($acceptedDuplicateCount),
                'totalData' => $acceptedTotalCount,
                'UniqueData' => $acceptedUniqueCount,
                'DuplicateData' => $acceptedDuplicateCount
            ),
            'sent' => array(
                'TotalCount' => count($sentTotalCount),
                'UniqueCount' => count($sentUniqueCount),
                'DuplicateCount' => count($sentDuplicateCount),
                'totalData' => $sentTotalCount,
                'UniqueData' => $sentUniqueCount,
                'DuplicateData' => $sentDuplicateCount
            ),
            'delivered' => array(
                'TotalCount' => count($deliveredTotalCount),
                'UniqueCount' => count($deliveredUniqueCount),
                'DuplicateCount' => count($deliveredDuplicateCount),
                'totalData' => $deliveredTotalCount,
                'UniqueData' => $deliveredUniqueCount,
                'DuplicateData' => $deliveredDuplicateCount
            ),
            'undelivered' => array(
                'TotalCount' => count($undeliveredTotalCount),
                'UniqueCount' => count($undeliveredUniqueCount),
                'DuplicateCount' => count($undeliveredDuplicateCount),
                'totalData' => $undeliveredTotalCount,
                'UniqueData' => $undeliveredUniqueCount,
                'DuplicateData' => $undeliveredDuplicateCount
            ),
            'failed' => array(
                'TotalCount' => count($failedTotalCount),
                'UniqueCount' => count($failedUniqueCount),
                'DuplicateCount' => count($failedDuplicateCount),
                'totalData' => $failedTotalCount,
                'UniqueData' => $failedUniqueCount,
                'DuplicateData' => $failedDuplicateCount
            ),
            'receiving' => array(
                'TotalCount' => count($receivingTotalCount),
                'UniqueCount' => count($receivingUniqueCount),
                'DuplicateCount' => count($receivingDuplicateCount),
                'totalData' => $receivingTotalCount,
                'UniqueData' => $receivingUniqueCount,
                'DuplicateData' => $receivingDuplicateCount
            ),
            'received' => array(
                'TotalCount' => count($receivedTotalCount),
                'UniqueCount' => count($receivedUniqueCount),
                'DuplicateCount' => count($receivedDuplicateCount),
                'totalData' => $receivedTotalCount,
                'UniqueData' => $receivedUniqueCount,
                'DuplicateData' => $receivedDuplicateCount
            ),
            'queued' => array(
                'TotalCount' => count($queuedTotalCount),
                'UniqueCount' => count($queuedUniqueCount),
                'DuplicateCount' => count($queuedDuplicateCount),
                'totalData' => $queuedTotalCount,
                'UniqueData' => $queuedUniqueCount,
                'DuplicateData' => $queuedDuplicateCount
            ),
            'sending' => array(
                'TotalCount' => count($sendingTotalCount),
                'UniqueCount' => count($sendingUniqueCount),
                'DuplicateCount' => count($sendingDuplicateCount),
                'totalData' => $sendingTotalCount,
                'UniqueData' => $sendingUniqueCount,
                'DuplicateData' => $sendingDuplicateCount
            ),
            'other' => array(
                'TotalCount' => count($otherTotalCount),
                'UniqueCount' => count($otherUniqueCount),
                'DuplicateCount' => count($otherDuplicateCount),
                'totalData' => $otherTotalCount,
                'UniqueData' => $otherUniqueCount,
                'DuplicateData' => $otherDuplicateCount
            )
        );

        return $aCatogerizedData;
    }

    /**
     * Check for the duplicate record in the stats
     * @param type $aSearch
     * @param type $tableData
     * @return boolean
     */
    public function checkIfDuplicateExistsInBroadcastStat($aSearch, $tableData) {
        if (!empty($tableData)) {
            foreach ($tableData as $oData) {
                if ($oData->subscriber_id == $aSearch->subscriber_id && $oData->campaign_id == $aSearch->campaign_id) {
                    return true;
                }
            }
            return false;
        }
    }

}
