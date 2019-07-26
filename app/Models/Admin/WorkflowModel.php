<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class WorkflowModel extends Model {

    /**
     * Returns the list of all workflow events
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public static function getWorkflowEvents($id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_events';
                $filterField = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_events';
                $filterField = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_events';
                $filterField = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_events';
                $filterField = 'nps_id';
                break;
            default :
                $tableName = '';
                $filterField = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($filterField, $id)
                ->orderBy('previous_event_id', 'asc')
                ->get();

        return $oData;
    }

    /**
     * Used to load tags from config file
     * @param type $moduleName
     * @return type
     */
    public static function getWorkflowCampaignTags($moduleName) {
        $aTags = config('bbconfig.email_tags');
        return $aTags;
    }

    /**
     * This function returns the stats of a sendgrid email
     * @param type $unitID
     * @param type $moduleName
     * @return boolean
     */
    public static function getModuleUnitSendgridStats($unitID, $moduleName) {
        if (empty($unitID) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_track_sendgrid';
                $filterField = 'brandboost_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_tracking_sendgrid';
                $filterField = 'automation_id';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_emails_tracking_sendgrid';
                $filterField = 'broadcast_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_tracking_sendgrid';
                $filterField = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_tracking_sendgrid';
                $filterField = 'nps_id';
                break;
            default :
                $tableName = '';
                $filterField = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($filterField, $unitID)
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $eventID
     * @param type $moduleName
     * @return boolean
     */
    public static function getEventCampaign($eventID, $moduleName) {
        if (empty($eventID) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_campaigns';
                $filterField = 'event_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns';
                $filterField = 'event_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_campaigns';
                $filterField = 'event_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_campaigns';
                $filterField = 'event_id';
                break;
            default :
                $tableName = '';
                $filterField = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($filterField, $eventID)
                ->orderBy('id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * Gets Twilio stats of a campaign
     * @param type $campaignID
     * @param type $moduleName
     * @return boolean
     */
    public static function getEventTwilioStats($campaignID, $moduleName) {
        if (empty($campaignID) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_track_twillio';
                $filterField = 'campaign_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_tracking_twillio';
                $filterField = 'campaign_id';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_emails_tracking_twillio';
                $filterField = 'campaign_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_tracking_twillio';
                $filterField = 'campaign_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_tracking_twillio';
                $filterField = 'campaign_id';
                break;
            default :
                $tableName = '';
                $filterField = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($filterField, $campaignID)
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Gets sendgrid stats for a campaign
     * @param type $campaignID
     * @param type $moduleName
     * @return boolean
     */
    public static function getEventSendgridStats($campaignID, $moduleName) {
        if (empty($campaignID) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_track_sendgrid';
                $filterField = 'campaign_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_tracking_sendgrid';
                $filterField = 'campaign_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_tracking_sendgrid';
                $filterField = 'campaign_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_tracking_sendgrid';
                $filterField = 'campaign_id';
                break;
            default :
                $tableName = '';
                $filterField = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($filterField, $campaignID)
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Get Twilio SMS/MMS stats
     * @param type $oData
     * @return array
     */
    public static function getEventTwilioCategorizedStats($oData) {
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
                    if (self::checkIfDuplicateExistsInStats($oRow, $acceptedUniqueCount) == true) {
                        $acceptedDuplicateCount[] = $oRow;
                    } else {
                        $acceptedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sent') {
                    $sentTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $sentUniqueCount) == true) {
                        $sentDuplicateCount[] = $oRow;
                    } else {
                        $sentUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'undelivered') {
                    $undeliveredTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $undeliveredUniqueCount) == true) {
                        $undeliveredDuplicateCount[] = $oRow;
                    } else {
                        $undeliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'failed') {
                    $failedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $failedUniqueCount) == true) {
                        $failedDuplicateCount[] = $oRow;
                    } else {
                        $failedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'receiving') {
                    $receivingTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $receivingUniqueCount) == true) {
                        $receivingDuplicateCount[] = $oRow;
                    } else {
                        $receivingUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'received') {
                    $receivedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $receivedUniqueCount) == true) {
                        $receivedDuplicateCount[] = $oRow;
                    } else {
                        $receivedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'queued') {
                    $queuedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $queuedUniqueCount) == true) {
                        $queuedDuplicateCount[] = $oRow;
                    } else {
                        $queuedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sending') {
                    $sendingTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $sendingUniqueCount) == true) {
                        $sendingDuplicateCount[] = $oRow;
                    } else {
                        $sendingUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInStats($oRow, $otherUniqueCount) == true) {
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
     * Get categorized stats of a stat dataset
     * @param type $oData
     * @param type $oneDayOldData
     * @return array
     */
    public static function getEventSendgridCategorizedStats($oData, $oneDayOldData = false) {
        $recent = strtotime('-24 hours');
        if (!empty($oData)) {
            $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
            $openUniqueCount = $deliveredUniqueCount = $processedUniqueCount = $clickTotalCount = $clickUniqueCount = $bounceTotalCount = $bounceUniqueCount = $unsubscribeTotalCount = $unsubscribeUniqueCount = $droppedTotalCount = $droppedUniqueCount = $spamTotalCount = $spamUniqueCount = $groupResubscribeTotalCount = $groupResubscribeUniqueCount = $groupUnsubscribeTotalCount = $groupUnsubscribeUniqueCount = $deferredTotalCount = $deferredUniqueCount = $otherTotalCount = $otherUniqueCount = $otherDuplicateCount = $openTotalCount = $processedTotalCount = $deliveredTotalCount = array();
            $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
            foreach ($oData as $oRow) {
                $bIterate = true;
                if ($oneDayOldData == true) {
                    $bIterate = false;
                    if (strtotime($oRow->created) > $recent) {
                        $bIterate = true;
                    }
                }

                if ($bIterate == true) {

                    if ($oRow->event_name == 'open') {
                        $openTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $openUniqueCount) == true) {
                            $openDuplicateCount[] = $oRow;
                        } else {
                            $openUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'click') {
                        $clickTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $clickUniqueCount) == true) {
                            $clickDuplicateCount[] = $oRow;
                        } else {
                            $clickUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'processed') {
                        $processedTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $processedUniqueCount) == true) {
                            $processedDuplicateCount[] = $oRow;
                        } else {
                            $processedUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'delivered') {
                        $deliveredTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $deliveredUniqueCount) == true) {
                            $deliveredDuplicateCount[] = $oRow;
                        } else {
                            $deliveredUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'bounce') {
                        $bounceTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $bounceUniqueCount) == true) {
                            $bounceDuplicateCount[] = $oRow;
                        } else {
                            $bounceUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'unsubscribe') {
                        $unsubscribeTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $unsubscribeUniqueCount) == true) {
                            $unsubscribeDuplicateCount[] = $oRow;
                        } else {
                            $unsubscribeUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'dropped') {
                        $droppedTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $droppedUniqueCount) == true) {
                            $droppedDuplicateCount[] = $oRow;
                        } else {
                            $droppedUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'spam_report') {
                        $spamTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $spamUniqueCount) == true) {
                            $spamDuplicateCount[] = $oRow;
                        } else {
                            $spamUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'group_resubscribe') {
                        $groupResubscribeTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $groupResubscribeUniqueCount) == true) {
                            $groupResubscribeDuplicateCount[] = $oRow;
                        } else {
                            $groupResubscribeUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'group_unsubscribe') {
                        $groupUnsubscribeTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $groupUnsubscribeUniqueCount) == true) {
                            $groupUnsubscribeDuplicateCount[] = $oRow;
                        } else {
                            $groupUnsubscribeUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'deferred') {
                        $deferredTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $deferredUniqueCount) == true) {
                            $deferredDuplicateCount[] = $oRow;
                        } else {
                            $deferredUniqueCount[] = $oRow;
                        }
                    } else {
                        $otherTotalCount[] = $oRow;
                        if (self::checkIfDuplicateExistsInStats($oRow, $otherUniqueCount) == true) {
                            $otherDuplicateCount[] = $oRow;
                        } else {
                            $otherUniqueCount[] = $oRow;
                        }
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
     * Checks if duplicates found in the given stats
     * @param type $aSearch
     * @param type $tableData
     * @return boolean
     */
    public static function checkIfDuplicateExistsInStats($aSearch, $tableData) {
        if (!empty($tableData)) {
            foreach ($tableData as $oData) {
                if ($oData->subscriber_id == $aSearch->subscriber_id && $oData->campaign_id == $aSearch->campaign_id) {
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * Get list of all subscribers from different module
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public function getWorkflowSubscribers($id = '', $moduleName = '') {
        /* if (empty($id) || empty($moduleName)) {
          return false;
          } */

        if ($moduleName == 'referral' || $moduleName == 'nps') {
            $oModuleInfo = $this->getModuleUnitInfo($moduleName, $id);
            if (!empty($oModuleInfo)) {
                $hashCode = $oModuleInfo->hashcode;
            }
        }

        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_brandboost_users';
                $filterField = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
            case "list":
                $tableName = 'tbl_automation_users';
                $filterField = 'list_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_users';
                $filterField = 'account_id';
                $id = $hashCode;
                break;
            case "nps":
                $tableName = 'tbl_nps_users';
                $filterField = 'account_id';
                $id = $hashCode;
                break;
            case "review":
                $tableName = 'tbl_users';
                $filterField = 'id';
                $id = $hashCode;
                break;
            default :
                $tableName = '';
                $filterField = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }



        if ($moduleName == 'automation' || $moduleName == 'broadcast') {
            $oSubscribers = $this->getWorkflowAutomationSubscribers($id);
        } else {
            $this->db->select("{$tableName}.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_subscribers.status AS globalStatus");
            $this->db->join("tbl_subscribers", "{$tableName}.subscriber_id= tbl_subscribers.id", "LEFT");
            $this->db->where("{$tableName}.{$filterField}", $id);
            $this->db->order_by("{$tableName}.id", 'DESC');
            $this->db->from($tableName);
            $result = $this->db->get();
            //echo $this->db->last_query();die;
            if ($result->num_rows() > 0) {
                $oSubscribers = $result->result();
            }
        }
        return $oSubscribers;
    }

    /**
     * Used to get Product related information associated with the brandboost campaign
     * @param type $brandboostID
     * @return type
     */
    public function getProductDataByBBID($brandboostID) {
        $oData = DB::table('tbl_brandboost_products')
                ->where('brandboost_id', $brandboostID)
                ->orderBy('product_order.id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * This method used to get Module Unit info
     * @param type $moduleName
     * @param type $id
     * @return boolean
     */
    public function getModuleUnitInfo($moduleName, $id) {

        if ($moduleName == 'brandboost' || $moduleName == 'onsite' || $moduleName == 'offsite') {
            $tableName = 'tbl_brandboost';
        } else if ($moduleName == 'referral') {
            $tableName = 'tbl_referral_rewards';
        } else if ($moduleName == 'nps') {
            $tableName = 'tbl_nps_main';
        } else if ($moduleName == 'automation' || $moduleName == 'broadcast') {
            $tableName = 'tbl_automations_emails';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('id', $id)
                ->first();

        return $oData;
    }

    /**
     * Used to get the list of automation subscribers
     * @param type $automationID
     * @return type
     */
    public function getWorkflowAutomationSubscribers($automationID) {
        $oLists = $this->getModuleAutomationLists($automationID);
        if (!empty($oLists)) {
            foreach ($oLists as $oList) {
                $aListsIDs[] = $oList->list_id;
            }
        }

        $aLists = empty($aListsIDs) ? array(0) : $aListsIDs;
        //write your own query
        $sql = "SELECT tbl_automation_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_subscribers.status AS globalStatus FROM tbl_automation_users "
                . "LEFT JOIN tbl_subscribers ON tbl_automation_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_automation_users.list_id IN (" . implode(",", $aLists) . ") AND tbl_automation_users.status = '1' AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) GROUP BY tbl_subscribers.email";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to get Automation Lists
     * @param type $automationID
     * @return type
     */
    public function getModuleAutomationLists($automationID) {
        $oData = DB::table('tbl_automations_emails_lists')
                ->where('automation_id', $automationID)
                ->get();
        return $oData;
    }

    /**
     * This function used to update workflow event
     * @param type $aData
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public function updateWorkflowEvent($aData, $id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_events';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_events';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_events';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_events';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('id', $id)
                ->update($aData);

        if ($oData) {
            return $id;
        } else {
            return false;
        }
    }

    /**
     * Get Common template info
     * @param type $templateID
     * @return boolean
     */
    public static function getCommonTemplateInfo($templateID) {
        $oData = DB::table('tbl_common_templates')
                ->leftJoin('tbl_common_templates_categories', 'tbl_common_templates.category_id', '=', 'tbl_common_templates_categories.id')
                ->select('tbl_common_templates.*', 'tbl_common_templates_categories.category_name', 'tbl_common_templates_categories.status AS category_status', 'tbl_common_templates_categories.module_name')
                ->when(($templateID > 0), function ($query) use ($templateID) {
                    return $query->where('tbl_common_templates.id', $templateID);
                })
                ->first();
        return $oData;
    }

    /**
     * Used to get Common template By template name
     * @param type $templateName
     * @param type $userID
     * @return type
     */
    public function getCommonTemplateByName($templateName, $userID) {
        $oData = DB::table('tbl_common_templates')
                ->where('user_id', $userID)
                ->where('template_name', $templateName)
                ->first();
        return $oData;
    }

    public function getAllTemplates($moduleName, $moduleCatName = '', $id = '', $categoryID = '') {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates';
                break;
            default :
                $tableName = '';
        }

        $tableName = 'tbl_common_templates';

        if (empty($tableName)) {
            return false;
        }

        $this->db->where("user_id", "0");

        if (!empty($moduleCatName)) {
            $this->db->where("template_type", $moduleCatName);
        }

        if ($id > 0) {
            $this->db->where("id", $id);
        }

        if ($categoryID > 0) {
            $this->db->where('category_id', $categoryID);
        }
        $result = $this->db->get($tableName);
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    /**
     * Used to get default templates
     * @param type $moduleName
     * @param type $moduleCatName
     * @param type $id
     * @param type $categoryID
     * @return boolean
     */
    public static function getWorkflowDefaultTemplates($moduleName, $moduleCatName = '', $id = '', $categoryID = '') {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('user_id', 0)
                ->when(($moduleName == "brandboost" && !empty($moduleCatName)), function($query) use($moduleCatName) {
                    return $query->where('brandboost_type', $moduleCatName);
                })
                ->when(($moduleName == "broadcast" && !empty($moduleCatName)), function($query) use($moduleCatName) {
                    return $query->where('template_type', $moduleCatName);
                })
                ->when(($id > 0), function($query) use($id) {
                    return $query->where('id', $id);
                })
                ->when(($categoryID > 0), function($query) use($categoryID) {
                    return $query->where('category_id', $categoryID);
                })
                ->get();

        return $oData;
    }

    public function isDuplicateWorkflowDraft($templateName, $moduleName, $userID = 0) {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if (!(empty($templateName))) {
            $this->db->where('template_name', $templateName);
        }

        if (!(empty($userID))) {
            $this->db->where('user_id', $userID);
        }



        $result = $this->db->get($tableName);
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function getWorkflowDraftInfo($id, $moduleName) {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if (!(empty($id))) {
            $this->db->where('id', $id);
        }

        $result = $this->db->get($tableName);

        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return false;
    }

    /**
     * Used to get draft templates
     * @param type $moduleName
     * @param type $id
     * @param type $userID
     * @param type $campaignType
     * @return boolean
     */
    public function getDraftTemplates($moduleName, $id, $userID = '', $campaignType = '') {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        $tableName = 'tbl_common_templates_drafts';

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('user_id', $userID)
                ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->when(!empty($campaignType), function ($query) use ($campaignType) {
                    return $query->where('template_type', $campaignType);
                })
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Used to get workflow draft templates
     * @param type $moduleName
     * @param type $id
     * @param type $userID
     * @param type $campaignType
     * @return boolean
     */
    public function getWorkflowDraftTemplates($moduleName, $id, $userID = '', $campaignType = '') {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('user_id', $userID)
                ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->when(!empty($campaignType), function ($query) use ($campaignType) {
                    return $query->where('template_type', $campaignType);
                })
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    public function getWorkflowDraftByName($moduleName, $templateName, $userID = '') {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }


        if (!empty($templateName)) {
            $this->db->where('template_name', $templateName);
        }

        if (!empty($userID)) {
            $this->db->where("user_id", $userID);
        }

        $result = $this->db->get($tableName);
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return false;
    }

    /**
     * Used to get workflow categorized templates
     * @param type $moduleName
     * @return boolean
     */
    public function getWorkflowTemplateCategories($moduleName) {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_categories';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_templates_categories';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_categories';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_categories';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->get();
        return $oData;
    }

    /**
     * Used to create a new node in the workflow tree
     * @param type $id
     * @param type $type
     * @param type $previousEventID
     * @param type $triggerParams
     * @param type $moduleName
     * @return boolean
     */
    public function createWorkflowEvent($id, $type, $previousEventID = '', $triggerParams = '', $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_events';
                $filterField = 'brandboost_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_events';
                $filterField = 'automation_id';
                break;
            case "broadcast":
                $tableName = 'tbl_automations_emails_events';
                $filterField = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_events';
                $filterField = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_events';
                $filterField = 'nps_id';
                break;
            default :
                $tableName = '';
                $filterField = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }

        if (empty($triggerParams)) {
            $triggerParams = array('delay_type' => "after", 'delay_value' => 10, 'delay_unit' => "minute");
        }

        $aEventData = array(
            $filterField => $id,
            'event_type' => $type,
            'data' => json_encode($triggerParams),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s")
        );

        if ($previousEventID > 0) {
            $aEventData['previous_event_id'] = $previousEventID;
        }
        //echo "table name is ". $tableName;

        $insert_id = DB::table($tableName)->insertGetId($aEventData);

        if ($insert_id)
            return $insert_id;
        else
            return false;
    }

    public function addEndCampaign($eventID, $templateID, $accountID, $moduleName, $isDraft = false) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($eventID) || empty($templateID) || empty($accountID) || empty($moduleName)) {
            return false;
        }

        $oAccountData = $this->getModuleUnitInfo($moduleName, $accountID);

        /* if ($isDraft == true) {
          $oTemplate = $this->getDraftTemplates($moduleName, $templateID, $userID);
          } else {
          $oTemplate = $this->getAllTemplates($moduleName, '', $templateID);
          } */

        $oTemplate = $this->getCommonTemplateInfo($templateID);

        $templateSourceID = ($isDraft == true) ? $oTemplate->template_source : $templateID;


        if (!empty($oTemplate)) {
            $resultData = $oTemplate;
            $defaultGreeting = $resultData->greeting;
            $defaultIntroduction = (!empty($oAccountData->description)) ? $oAccountData->description : $resultData->introduction;
            $categoryStatus = $oTemplate->category_status;


            if ($categoryStatus == 2) {
                if ($moduleName == 'nps') {
                    if (strtolower($resultData->template_type) == 'email') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/modules/nps/nps-templates/email/templates", array('oNPS' => $oAccountData, 'template_slug' => $resultData->template_slug), true);
                        //$compiledTemplatePriviewCode = $this->parseModuleStatictemplate($moduleName, $sEmailPreview, 'email', $oAccountData);
                    } else if (strtolower($resultData->template_type) == 'sms') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/modules/nps/nps-templates/sms/templates", array('oNPS' => $oAccountData, 'template_slug' => $resultData->template_slug), true);
                        //$compiledTemplatePriviewCode = $this->parseModuleStatictemplate($moduleName, $sSMSPreview, 'sms', $oAccountData);
                    }
                } else if ($moduleName == 'referral') {
                    if (strtolower($resultData->template_type) == 'email') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/modules/referral/referral-templates/email/templates", array('template_slug' => $resultData->template_slug), true);
                    } else if (strtolower($resultData->template_type) == 'sms') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/modules/referral/referral-templates/sms/templates", array('template_slug' => $resultData->template_slug), true);
                    }
                } else if ($moduleName == 'onsite' || $moduleName == 'offsite' || $moduleName == 'brandboost') {
                    $brandboostType = $oAccountData->review_type;

                    if ($brandboostType == 'onsite') {
                        if (strtolower($resultData->template_type) == 'email') {
                            $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/onsite/email/templates", array('template_slug' => $resultData->template_slug), true);
                        } else if (strtolower($resultData->template_type) == 'sms') {
                            $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/onsite/sms/templates", array('template_slug' => $resultData->template_slug), true);
                        }
                    }

                    if ($brandboostType == 'offsite') {
                        if (strtolower($resultData->template_type) == 'email') {
                            $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/offsite/email/templates", array('template_slug' => $resultData->template_slug), true);
                        } else if (strtolower($resultData->template_type) == 'sms') {
                            $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/offsite/sms/templates", array('template_slug' => $resultData->template_slug), true);
                        }
                    }
                }
            }
            $compiledContent = !(empty($compiledTemplatePriviewCode)) ? base64_encode($compiledTemplatePriviewCode) : $resultData->stripo_compiled_html;
            $aCampaignData = array(
                'event_id' => $eventID,
                'content_type' => (strtolower($resultData->template_type) == 'sms' ) ? 'Plain' : 'Regular',
                'campaign_type' => ucfirst($resultData->template_type),
                'name' => $resultData->template_name,
                'subject' => $resultData->template_subject,
                'greeting' => $defaultGreeting,
                'introduction' => $defaultIntroduction,
                'html' => $compiledContent,
                'stripo_html' => $resultData->stripo_html,
                'stripo_css' => $resultData->stripo_css,
                'stripo_compiled_html' => $compiledContent,
                'template_source' => $templateSourceID,
                'status' => 1,
                'from_email' => $aUser->email,
                'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
                'reply_to' => $aUser->email,
                'created' => date("Y-m-d H:i:s")
            );

            switch ($moduleName) {
                case "brandboost":
                    $tableName = 'tbl_campaigns';
                    break;
                case "automation":
                case "broadcast":
                    $tableName = 'tbl_automations_emails_campaigns';
                    break;
                case "referral":
                    $tableName = 'tbl_referral_automations_campaigns';
                    break;
                case "nps":
                    $tableName = 'tbl_nps_automations_campaigns';
                    break;
                default :
                    $tableName = '';
            }
        }


        if (empty($tableName)) {
            return false;
        }

        $insert_id = DB::table($tableName)->insertGetId($aCampaignData);
        if ($insert_id)
            return array('id' => $insert_id, 'subject' => $resultData->template_subject, 'content' => base64_decode($resultData->template_content));
        else
            return false;
    }

    public function addWorkflowCampaign($eventID, $templateID, $accountID, $moduleName, $isDraft = false) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($eventID) || empty($templateID) || empty($accountID) || empty($moduleName)) {
            return false;
        }

        $oAccountData = $this->getModuleUnitInfo($moduleName, $accountID);

        if ($isDraft == true) {
            $oTemplate = $this->getWorkflowDraftTemplates($moduleName, $templateID, $userID);
        } else {
            $oTemplate = $this->getWorkflowDefaultTemplates($moduleName, '', $templateID);
        }

        $templateSourceID = ($isDraft == true) ? $oTemplate[0]->template_source : $templateID;


        if (!empty($oTemplate)) {
            $resultData = $oTemplate[0];
            $defaultGreeting = $resultData->greeting;
            $defaultIntroduction = $resultData->introduction;


            if ($moduleName == 'nps') {
                if ($resultData->template_name == 'NPS Email') {
                    $sEmailPreview = $this->load->view("admin/modules/nps/nps-templates/email/templates", array('template_name' => $resultData->template_name), true);
                    $compiledTemplatePriviewCode = $this->parseModuleStatictemplate($moduleName, $sEmailPreview, 'email', $oAccountData);
                } else if ($resultData->template_name == 'NPS SMS') {
                    $sSMSPreview = $this->load->view("admin/modules/nps/nps-templates/sms/templates", array('template_name' => $resultData->template_name), true);
                    $compiledTemplatePriviewCode = $this->parseModuleStatictemplate($moduleName, $sSMSPreview, 'sms', $oAccountData);
                } else if ($resultData->template_name == 'NPS Email Link') {
                    $sEmailPreview = $this->load->view("admin/modules/nps/nps-templates/email/link_templates", array('template_name' => $resultData->template_name), true);
                    $compiledTemplatePriviewCode = $this->parseModuleStatictemplate($moduleName, $sEmailPreview, 'email', $oAccountData);
                } else if ($resultData->template_name == 'NPS SMS Link') {
                    $sSMSPreview = $this->load->view("admin/modules/nps/nps-templates/sms/link_templates", array('template_name' => $resultData->template_name), true);
                    $compiledTemplatePriviewCode = $this->parseModuleStatictemplate($moduleName, $sSMSPreview, 'sms', $oAccountData);
                }
            } else if ($moduleName == 'referral') {
                if (strtolower($resultData->template_type) == 'email') {
                    $compiledTemplatePriviewCode = $this->load->view("admin/modules/referral/referral-templates/email/templates", array('template_name' => $resultData->template_name), true);
                } else if (strtolower($resultData->template_type) == 'sms') {
                    $compiledTemplatePriviewCode = $this->load->view("admin/modules/referral/referral-templates/sms/templates", array('template_name' => $resultData->template_name), true);
                }
            } else if ($moduleName == 'onsite' || $moduleName == 'offsite' || $moduleName == 'brandboost') {
                $brandboostType = $oAccountData->review_type;

                if ($brandboostType == 'onsite') {
                    if (strtolower($resultData->template_type) == 'email') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/onsite/email/templates", array('template_name' => $resultData->template_name), true);
                    } else if (strtolower($resultData->template_type) == 'sms') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/onsite/sms/templates", array('template_name' => $resultData->template_name), true);
                    }
                }

                if ($brandboostType == 'offsite') {
                    if (strtolower($resultData->template_type) == 'email') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/offsite/email/templates", array('template_name' => $resultData->template_name), true);
                    } else if (strtolower($resultData->template_type) == 'sms') {
                        $compiledTemplatePriviewCode = $this->load->view("admin/brandboost/brand-templates/offsite/sms/templates", array('template_name' => $resultData->template_name), true);
                    }
                }
            }
            $compiledContent = !(empty($compiledTemplatePriviewCode)) ? base64_encode($compiledTemplatePriviewCode) : $resultData->stripo_compiled_html;
            $aCampaignData = array(
                'event_id' => $eventID,
                'content_type' => (strtolower($resultData->template_type) == 'sms' ) ? 'Plain' : 'Regular',
                'campaign_type' => ucfirst($resultData->template_type),
                'name' => $resultData->template_name,
                'subject' => $resultData->template_subject,
                'greeting' => $defaultGreeting,
                'introduction' => $defaultIntroduction,
                'html' => $compiledContent,
                'stripo_html' => $resultData->stripo_html,
                'stripo_css' => $resultData->stripo_css,
                'stripo_compiled_html' => $compiledContent,
                'template_source' => $templateSourceID,
                'status' => 1,
                'from_email' => $aUser->email,
                'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
                'reply_to' => $aUser->email,
                'created' => date("Y-m-d H:i:s")
            );

            switch ($moduleName) {
                case "brandboost":
                    $tableName = 'tbl_campaigns';
                    break;
                case "automation":
                case "broadcast":
                    $tableName = 'tbl_automations_emails_campaigns';
                    break;
                case "referral":
                    $tableName = 'tbl_referral_automations_campaigns';
                    break;
                case "nps":
                    $tableName = 'tbl_nps_automations_campaigns';
                    break;
                default :
                    $tableName = '';
            }
        }


        if (empty($tableName)) {
            return false;
        }

        $result = $this->db->insert($tableName, $aCampaignData);
        $inset_id = $this->db->insert_id();
        if ($result)
            return array('id' => $inset_id, 'subject' => $resultData->template_subject, 'content' => base64_decode($resultData->template_content));
        else
            return false;
    }

    /**
     * Used to get a node info from the workflow tree
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public function getNodeInfo($id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_events';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_events';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_events';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_events';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('id', $id)
                ->first();
        return $oData;
    }

    /**
     * Used to get Next Node info in the workflow tree sequence
     * @param type $previousEventID
     * @param type $moduleName
     * @return boolean
     */
    public function getNextNodeInfo($previousEventID, $moduleName) {
        if (empty($previousEventID) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_events';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_events';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_events';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_events';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('previous_event_id', $previousEventID)
                ->first();
        return $oData;
    }

    /**
     * Used to update workflow end campaign
     * @param type $aData
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public function updateWorkflowCampaign($aData, $id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaigns';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_campaigns';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_campaigns';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('id', $id)
                ->update($aData);

        if ($oData > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get Workflow Split Variations
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return type
     */
    public function getWorkflowSplitVariations($moduleName, $moduleUnitID) {
        $oData = DB::table('tbl_broadcast_split_campaigns')
                ->leftJoin('tbl_broadcast_split_testing', 'tbl_broadcast_split_campaigns.split_test_id', '=', 'tbl_broadcast_split_testing.id')
                ->select('tbl_broadcast_split_campaigns.*', 'tbl_broadcast_split_testing.test_name', 'tbl_broadcast_split_testing.id as splitID')
                ->where('tbl_broadcast_split_campaigns.broadcast_id', $moduleUnitID)
                ->where('tbl_broadcast_split_campaigns.status', 'active')
                ->orderBy('tbl_broadcast_split_campaigns.id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * This function used to update split workflow campaigns
     * @param type $aData
     * @param type $id
     * @param type $moduleName
     * @param type $broadcastID
     * @return boolean
     */
    public function updateWorkflowSplitCampaign($aData, $id, $moduleName, $broadcastID = '') {
        //For now split table created for broadcast module only
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_split_campaigns';
                break;
            case "automation":
                $tableName = 'tbl_automation_split_campaigns';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_split_campaigns';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_split_campaigns';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_split_campaigns';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        //DB::enableQuerylog();
        $result = DB::table($tableName)
                ->when(($broadcastID > 0), function($query) use($broadcastID) {
                    return $query->where('broadcast_id', $broadcastID);
                }, function($query) use($id) {
                    return $query->where('id', $id);
                })
                ->update($aData);

        //print_r(DB::getQuerylog());        

        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

    public function addWorkflowTemplate($aData, $moduleName) {
        if (empty($aData) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $result = $this->db->insert($tableName, $aData);
        $inset_id = $this->db->insert_id();

        if ($result)
            return $inset_id;
        else
            return false;
    }

    public function updateWorkflowTemplate($aData, $id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $this->db->where('id', $id);
        $result = $this->db->update($tableName, $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWorkflowTemplate($moduleName, $id) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $this->db->where('id', $id);
        $result = $this->db->delete($tableName);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWorkflowDraft($moduleName, $id) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $this->db->where('id', $id);
        $result = $this->db->delete($tableName);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to add template into user's collection
     * @param type $aData
     * @return type
     */
    public function addWorkflowMyTemplate($aData) {
        $inset_id = DB::table('tbl_common_templates')
                ->insertGetId($aData);
        return $inset_id;
    }

    /**
     * Used to update template info into existing table in the user's collection
     * @param type $aData
     * @param type $templateID
     * @param type $userID
     * @return boolean
     */
    public function updateWorkflowMyTemplate($aData, $templateID, $userID) {
        if ($templateID > 0) {
            $result = DB::table('tbl_common_templates')
                    ->where('id', $templateID)
                    ->where('user_id', $userID)
                    ->update($aData);
            if ($result)
                return true;
        }
        return false;
    }

    public function addWorkflowDraft($aData, $moduleName) {
        if (empty($aData) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $result = $this->db->insert($tableName, $aData);
        //echo $this->db->last_query();
        $inset_id = $this->db->insert_id();

        if ($result)
            return $inset_id;
        else
            return false;
    }

    public function updateWorkflowDraft($aData, $id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaign_templates_drafts';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaigns_templates_drafts';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_templates_drafts';
                break;
            case "referral":
                $tableName = 'tbl_referral_rewards_templates_drafts';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_templates_drafts';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $this->db->where('id', $id);
        $result = $this->db->update($tableName, $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get workflow end email/sms campaign details
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public function getWorkflowCampaign($id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
            case "onsite":
            case "offsite":
                $tableName = 'tbl_campaigns';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_campaigns';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_campaigns';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('id', $id)
                ->first();
        return $oData;
    }

    /**
     * Used to delete a node from the workflow tree
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public function deleteNode($id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_events';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_events';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_events';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_events';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('id', $id)
                ->delete();
        if ($oData) {
            $bCampaignDeleted = $this->deleteWorflowCampaign($id, $moduleName);
            return true;
        }
        return false;
    }

    /**
     * Used to delete end campaign belonging to a workflow node
     * @param type $eventID
     * @param type $moduleName
     * @return boolean
     */
    public function deleteWorflowCampaign($eventID, $moduleName) {
        if ($eventID > 0) {
            if (empty($eventID) || empty($moduleName)) {
                return false;
            }
            switch ($moduleName) {
                case "brandboost":
                    $tableName = 'tbl_campaigns';
                    break;
                case "automation":
                case "broadcast":
                    $tableName = 'tbl_automations_emails_campaigns';
                    break;
                case "referral":
                    $tableName = 'tbl_referral_automations_campaigns';
                    break;
                case "nps":
                    $tableName = 'tbl_nps_automations_campaigns';
                    break;
                default :
                    $tableName = '';
            }

            if (empty($tableName)) {
                return false;
            }

            $oData = DB::table($tableName)
                    ->where('event_id', $eventID)
                    ->delete();

            if ($oData) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Used to update a workflow tree node
     * @param type $aData
     * @param type $id
     * @param type $moduleName
     * @return boolean
     */
    public function updateNode($aData, $id, $moduleName) {
        if (empty($id) || empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_events';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_events';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_events';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_events';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where('id', $id)
                ->update($aData);

        if ($oData) {
            return true;
        } else {
            return false;
        }
    }

    public function parseModuleStatictemplate($moduleName, $sCode, $type, $oUnitData) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($oUnitData)) {
            $hashCode = $oUnitData->hashcode;
            $ownerID = $oUnitData->user_id;
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
            $ownerID = $userID;
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
        if ($type == 'email') {
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

        if ($type == 'sms') {

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

        $compiledCode = str_replace($aTemplateTags, $aSource, $sCode);
        return $compiledCode;
    }

    public function getReferralLink($advocateID) {
        $this->db->where("advocate_id", $advocateID);
        $result = $this->db->get("tbl_referral_reflinks");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getReferralSettingsInfo($referralID) {

        $this->db->select("tbl_referral_settings.*");
        $this->db->where("tbl_referral_settings.referral_id", $referralID);
        $result = $this->db->get("tbl_referral_settings");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    /**
     * This function returns all user lists
     * @param type $userID
     * @return type
     */
    public function getWorkflowMyLists($userID) {
        $oData = DB::table('tbl_common_lists')
                ->leftJoin('tbl_automation_users', 'tbl_automation_users.list_id', '=', 'tbl_common_lists.id')
                ->leftJoin('tbl_subscribers', 'tbl_automation_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->join('tbl_users', 'tbl_users.id', '=', 'tbl_common_lists.user_id')
                ->select("tbl_common_lists.*", "tbl_automation_users.list_id as l_list_id", "tbl_automation_users.user_id as l_user_id", "tbl_subscribers.firstname as l_firstname", "tbl_subscribers.lastname as l_lastname", "tbl_subscribers.email as l_email", "tbl_subscribers.phone as l_phone", "tbl_subscribers.created as l_created", "tbl_automation_users.status as l_status", DB::raw("CONCAT(tbl_users.firstname,' ', tbl_users.lastname) as lCreateUsername"), "tbl_users.email as cEmail", "tbl_users.mobile as cMobile")
                ->where('tbl_common_lists.delete_status', 0)
                ->where("tbl_common_lists.status", 'active')
                ->when(($userID > 0), function($query) use($userID) {
                    return $query->where('tbl_common_lists.user_id', $userID);
                })
                ->orderBy('tbl_common_lists.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * This function return the list of all user created segments
     * @param type $userID
     * @param type $id
     * @return type
     */
    public function getWorkflowSegments($userID, $id = '') {
        $oData = DB::table('tbl_segments')
                ->when(!empty($userID), function ($query) use ($userID) {
                    return $query->where('user_id', $userID);
                })
                ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->get();
        return $oData;
    }

    /**
     * This function used to get the list of subscribers inside a segment
     * @param type $segmentID
     * @param type $userID
     * @return type
     */
    public static function getWorkflowSegmentSubscribers($segmentID, $userID) {
        $oData = DB::table('tbl_segments_users')
                ->leftJoin('tbl_subscribers', 'tbl_segments_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_segments_users.*', 'tbl_subscribers.id as globalSubscriberId', 'tbl_subscribers.user_id as subUserId', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_subscribers.status')
                ->where('tbl_segments_users.segment_id', $segmentID)
                ->where('tbl_segments_users.user_id', $userID)
                ->get();
        return $oData;
    }

    /**
     * This function used to get the list of subscribers inside a tag
     * @param type $tagID
     * @return type
     */
    public static function getWorkflowTagSubscribers($tagID) {
        $oData = DB::table('tbl_subscriber_tags')
                ->leftJoin('tbl_subscribers', 'tbl_subscriber_tags.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_subscribers.*', 'tbl_subscribers.id as subscriber_id', 'tbl_subscribers.status AS globalStatus', 'tbl_subscribers.id AS global_user_id')
                ->where('tbl_subscriber_tags.tag_id', $tagID)
                ->orderBy('tbl_subscriber_tags.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * This function used to get imported lists to a campaign
     * @param type $moduleName
     * @param type $moduleUnitID
     */
    public function getWorkflowImportListsIds($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($fieldName, $moduleUnitID)
                ->get();

        return $oData;
    }

    public function getWorkflowExcludeListsIds($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists_excluded';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists_excluded';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists_excluded';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($fieldName, $moduleUnitID)
                ->get();
        return $oData;
    }

    /**
     * This function used to get the list of detailed information
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function getWorkflowImportLists($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->leftJoin("tbl_common_lists", "tbl_common_lists.id", '=', "$tableName.list_id")
                ->select("$tableName.*", "tbl_common_lists.list_name")
                ->where("$tableName.$fieldName", $moduleUnitID)
                ->where("tbl_common_lists.delete_status", 0)
                ->get();
        return $oData;
    }

    /**
     * Used to get all those lists which are excluded
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function getWorkflowExcludeLists($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists_excluded';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists_excluded';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists_excluded';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->leftJoin("tbl_common_lists", "tbl_common_lists.id", '=', "$tableName.list_id")
                ->select("$tableName.*", "tbl_common_lists.list_name")
                ->where("$tableName.$fieldName", $moduleUnitID)
                ->where("tbl_common_lists.delete_status", 0)
                ->get();

        return $oData;
    }

    /**
     * This function used to get the list of all imported subscribers from the lists
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return type
     */
    public function getWorkflowImportListSubscribers($moduleName, $moduleUnitID) {
        $oLists = $this->getWorkflowImportListsIds($moduleName, $moduleUnitID);
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
     * Get the list of all the subscribers from excluded lists
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return type
     */
    public function getWorkflowExcludeListSubscribers($moduleName, $moduleUnitID) {
        $oLists = $this->getWorkflowExcludeListsIds($moduleName, $moduleUnitID);
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
     * This method used to get list of contacts 
     * @param type $automationID
     * @return type
     */
    public function getWorkflowImportContacts($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automation_users';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $moduleUnitID = $accountID;
                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_users';
                $fieldName = 'account_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($fieldName, $moduleUnitID)
                ->get();

        return $oData;
    }

    /**
     * Get list of excluded contacts
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function getWorkflowExcludeContacts($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_users_excluded';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automation_users_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_users_excluded';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_users_excluded';
                $fieldName = 'account_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($fieldName, $moduleUnitID)
                ->get();

        return $oData;
    }

    /**
     * This function is used to get the list of imported tags
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function getWorkflowImportTags($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_tags';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_tags';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_tags';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_tags';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($fieldName, $moduleUnitID)
                ->get();
        return $oData;
    }

    /**
     * Used to get the list of excluded tags in a campaign
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function getWorkflowExcludeTags($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_tags_exclude';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_tags_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_tags_exclude';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_tags_exclude';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->where($fieldName, $moduleUnitID)
                ->get();

        return $oData;
    }

    /**
     * Get list of Imported Segments in a campaign
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function getWorkflowImportSegments($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_segments';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_segments_new';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_segments';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_segments';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->leftJoin("tbl_segments", "$tableName.segment_id", '=', "tbl_segments.id")
                ->select("$tableName.*", "tbl_segments.segment_name")
                ->where("$tableName.$fieldName", $moduleUnitID)
                ->get();
        return $oData;
    }

    /**
     * Get the list of excluded segments in a campaign
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function getWorkflowExcludeSegments($moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_segments_exclude';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_segments_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_segments_exclude';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_segments_exclude';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->leftJoin("tbl_segments", "$tableName.segment_id", '=', "tbl_segments.id")
                ->select("$tableName.*", "tbl_segments.segment_name")
                ->where("$tableName.$fieldName", $moduleUnitID)
                ->get();

        return $oData;
    }

    /**
     * This functions is used to get final campaign subscribers on which cron works
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public static function getWorkflowCampaignSubscribers($moduleName, $moduleUnitID) {

        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaign_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaign_users';
                $fieldName = 'automation_id';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_users';
                $fieldName = 'broadcast_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $moduleUnitID = $accountID;
                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaign_users';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $oData = DB::table($tableName)
                ->leftJoin('tbl_subscribers', "$tableName.subscriber_id", '=', "tbl_subscribers.id")
                ->select("$tableName.id as local_user_id", "tbl_subscribers.*", "tbl_subscribers.id as subscriber_id", "tbl_subscribers.status AS globalStatus", "tbl_subscribers.id AS global_user_id")
                ->where("$tableName.$fieldName", $moduleUnitID)
                ->orderBy("$tableName.id", "desc")
                ->get();
        return $oData;
    }

    /**
     * This function will return all the data required to display entire contact selection interface
     * @param string $moduleName
     * @param type $moduleUnitID
     */
    public static function getWorkflowContactSelectionInterfaceData($moduleName, $moduleUnitID) {
        if (!empty($moduleName) && $moduleUnitID > 0) {

            $aUser = getLoggedUser();
            $userID = $aUser->id;
            //Get Common information which will display in both Import and Exclude interface
            $oLists = (new self)->getWorkflowMyLists($userID);

            $oSegments = (new self)->getWorkflowSegments($userID);

            $subscribersData = \App\Models\Admin\SubscriberModel::getGlobalSubscribers($userID);


            $aTags = \App\Models\Admin\TagsModel::getClientTags($userID);

            $oCampaignSubscribers = self::getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);


            //Import Specific Data
            $oTotalImportedSubscribers = (new self)->getWorkflowImportListSubscribers($moduleName, $moduleUnitID);

            $oImportLists = (new self)->getWorkflowImportLists($moduleName, $moduleUnitID);

            $oCampaignImportContacts = (new self)->getWorkflowImportContacts($moduleName, $moduleUnitID);


            $oCampaignImportTags = (new self)->getWorkflowImportTags($moduleName, $moduleUnitID);

            $oCampaignImportSegments = (new self)->getWorkflowImportSegments($moduleName, $moduleUnitID);


            //Exclude Specific Data
            $oTotalExcludeSubscribers = (new self)->getWorkflowExcludeListSubscribers($moduleName, $moduleUnitID);

            $oExcludeLists = (new self)->getWorkflowExcludeLists($moduleName, $moduleUnitID);

            $oCampaignExcludeContacts = (new self)->getWorkflowExcludeContacts($moduleName, $moduleUnitID);

            $oCampaignExcludeTags = (new self)->getWorkflowExcludeTags($moduleName, $moduleUnitID);

            $oCampaignExcludeSegments = (new self)->getWorkflowExcludeSegments($moduleName, $moduleUnitID);


            //Get Import/exclude buttons

            $aDataImportButtons = array(
                'moduleUnitID' => $moduleUnitID,
                'oCampaignLists' => $oImportLists,
                'oCampaignContacts' => $oCampaignImportContacts,
                'aTags' => $aTags,
                'oCampaignTags' => $oCampaignImportTags,
                'oCampaignSegments' => $oCampaignImportSegments
            );

            $importViewHtml = view("admin.workflow2.partials.importButtonTags", $aDataImportButtons);
            $sImportButtons = $importViewHtml->render();


            //loaded broadcast properties tags
            $aDataExportButtons = array(
                'moduleUnitID' => $moduleUnitID,
                'oCampaignLists' => $oExcludeLists,
                'oCampaignContacts' => $oCampaignExcludeContacts,
                'aTags' => $aTags,
                'oCampaignTags' => $oCampaignExcludeTags,
                'oCampaignSegments' => $oCampaignExcludeSegments
            );

            $excludeViewHtml = view("admin.workflow2.partials.excludeButtonTags", $aDataExportButtons);
            $sExcludButtons = $excludeViewHtml->render();

            $aData = array(
                'oLists' => $oLists,
                'oSegments' => $oSegments,
                'subscribersData' => $subscribersData,
                'aTags' => $aTags,
                'oCampaignSubscribers' => $oCampaignSubscribers,
                'oTotalImportedSubscribers' => $oTotalImportedSubscribers,
                'oImportLists' => $oImportLists,
                'oCampaignImportContacts' => $oCampaignImportContacts,
                'oCampaignImportTags' => $oCampaignImportTags,
                'oCampaignImportSegments' => $oCampaignImportSegments,
                'oTotalExcludeSubscribers' => $oTotalExcludeSubscribers,
                'oExcludeLists' => $oExcludeLists,
                'oCampaignExcludeContacts' => $oCampaignExcludeContacts,
                'oCampaignExcludeTags' => $oCampaignExcludeTags,
                'oCampaignExcludeSegments' => $oCampaignExcludeSegments,
                'moduleUnitID' => $moduleUnitID,
                'moduleName' => $moduleName,
                'userData' => $aUser,
                'sImportButtons' => $sImportButtons,
                'sExcludButtons' => $sExcludButtons
            );

            return $aData;
        }
    }

    /**
     * This function is used to add contact into the workflow campaign contact list
     * @param array $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function addContactToWorkflowCampaign($aData, $moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automation_users';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $referralID = $oRefInfo->id;
                $moduleUnitID = $accountID;

                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_users';
                $fieldName = 'account_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $aData[$fieldName] = $moduleUnitID;

        $oData = DB::table($tableName)
                ->insert($aData);

        if ($moduleName == 'referral') {
            $aRefLinkData = array(
                'referral_id' => $referralID,
                'subscriber_id' => $aData['subscriber_id'],
                'account_id' => $moduleUnitID,
            );
            $this->createReferralLink($aRefLinkData);
        }

        //echo $this->db->last_query();
        if ($oData) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete contact from the workflow campaign
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $subscriberID
     * @return boolean
     */
    public function deleteContactFromWorkflowCampaign($moduleName, $moduleUnitID, $subscriberID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automation_users';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $moduleUnitID = $accountID;
                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_users';
                $fieldName = 'account_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if (!empty($moduleUnitID)) {
            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('subscriber_id', $subscriberID)
                    ->delete();

            if ($oResponse) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used to add contact into the workflow campaign(From which table campaign runs)
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $subscriberID
     * @return boolean
     */
    public function deleteAudienceFromWorkflowCampaign($moduleName, $moduleUnitID, $subscriberID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaign_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaign_users';
                $fieldName = 'automation_id';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_users';
                $fieldName = 'broadcast_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $moduleUnitID = $accountID;
                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaign_users';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        if (!empty($moduleUnitID)) {
            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('subscriber_id', $subscriberID)
                    ->delete();
            if ($oResponse) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used to add contact into the workflow campaign(From which table campaign runs)
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $subscriberID
     * @return boolean
     */
    public function deleteSuspeciousWorkflowCampaignSubscribers($moduleName, $moduleUnitID, $aSubscribers) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaign_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaign_users';
                $fieldName = 'automation_id';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_users';
                $fieldName = 'broadcast_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $moduleUnitID = $accountID;
                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaign_users';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        if (!empty($moduleUnitID)) {

            if (!empty($aSubscribers)) {
                $sql = "DELETE FROM `$tableName` WHERE `$fieldName`='$moduleUnitID' AND `subscriber_id` IN(" . implode(",", array_filter($aSubscribers)) . ")";
                $result = DB::raw($sql);
            }
            if ($result) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check for the duplicate audience in the workflow subscribers
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $subscriberID
     * @return boolean
     */
    public function isDuplicateWorkflowAudience($moduleName, $moduleUnitID, $subscriberID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaign_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaign_users';
                $fieldName = 'automation_id';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_users';
                $fieldName = 'broadcast_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $moduleUnitID = $accountID;
                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaign_users';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if (!empty($moduleUnitID)) {
            $bExists = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('subscriber_id', $subscriberID)
                    ->exists();

            if ($bExists) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * This functions add audience to the campaign subscribers
     * @param array $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function addAudienceToWorkflowCampaign($aData, $moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaign_users';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_campaign_users';
                $fieldName = 'automation_id';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_users';
                $fieldName = 'broadcast_id';
                break;
            case "referral":
                $oRefInfo = $this->getReferralModuleInfo($moduleUnitID);
                $accountID = $oRefInfo->hashcode;
                $referralID = $oRefInfo->id;
                $moduleUnitID = $accountID;
                $tableName = 'tbl_referral_users';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaign_users';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $aData[$fieldName] = $moduleUnitID;
        $oData = DB::table($tableName)
                ->insert($aData);
        if ($moduleName == 'referral') {
            $aRefLinkData = array(
                'referral_id' => $referralID,
                'subscriber_id' => $aData['subscriber_id'],
                'account_id' => $moduleUnitID,
            );
            $this->createReferralLink($aRefLinkData);
        }
        if ($oData) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function used to update list id modules lists
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $iListID
     * @return boolean
     */
    public function updateWorkflowList($moduleName, $moduleUnitID, $iListID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if ($moduleUnitID > 0 && $iListID > 0) {

            $result = DB::table($tableName)
                    ->insert([$fieldName => $moduleUnitID, 'list_id' => $iListID, 'created' => date("Y-m-d H:i:s")]);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Used to delete list id from the module list
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $listId
     * @return boolean
     */
    public function deleteWorkflowList($moduleName, $moduleUnitID, $listId) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        if ($moduleUnitID > 0) {
            $result = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('list_id', $listId)
                    ->delete();
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Used to get the list of contacts from the common lists which is used in all modules
     * @param type $userID
     * @param type $listID
     * @return type
     */
    public function getWorkflowCommonListContacts($userID, $listID = '') {
        $oData = DB::table('tbl_automation_users')
                ->leftJoin('tbl_common_lists', 'tbl_common_lists.id', '=', 'tbl_automation_users.list_id')
                ->leftJoin('tbl_subscribers', 'tbl_automation_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_automation_users.*', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_common_lists.user_id AS clientID', 'tbl_common_lists.list_name')
                ->when(($listID > 0), function ($query) use ($listID) {
                    return $query->where('tbl_automation_users.list_id', $listID);
                })
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_common_lists.user_id', $userID);
                })
                ->get();
        return $oData;
    }

    /**
     * Used to add segment id into module segments
     * @param array $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function addSegmentToWorkflowCampaign($aData, $moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_segments';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_segments_new';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_segments';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_segments';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        $aData[$fieldName] = $moduleUnitID;
        $oResponse = DB::table($tableName)
                ->insert($aData);

        if ($oResponse) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete segment id from the campaign segments
     * @param type $automationID
     * @param type $segmentID
     * @return boolean
     */
    public function deleteSegmentFromWorkflowCampaign($moduleName, $moduleUnitID, $segmentID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_segments';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_segments_new';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_segments';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_segments';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if ($moduleUnitID > 0) {
            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('segment_id', $segmentID)
                    ->delete();

            if ($oResponse) {
                return true;
            }
        }
        return false;
    }

    /**
     * used to add tagid into workflow tags 
     * @param array $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function addTagToWorkflowCampaign($aData, $moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_tags';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_tags';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_tags';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_tags';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        $aData[$fieldName] = $moduleUnitID;

        $oResponse = DB::table($tableName)
                ->insert($aData);


        if ($oResponse) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete tagid from the module tags
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $tagID
     * @return boolean
     */
    public function deleteTagFromWorkflowCampaign($moduleName, $moduleUnitID, $tagID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_tags';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_tags';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_tags';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_tags';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if ($moduleUnitID > 0) {
            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('tag_id', $tagID)
                    ->delete();

            if ($oResponse) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used to remove contact from the list of excluded module contacts
     * @param array $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function addContactToExcludeCampaign($aData, $moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_users_excluded';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automation_users_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_users_excluded';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_users_excluded';
                $fieldName = 'account_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        $aData[$fieldName] = $moduleUnitID;

        $oResponse = DB::table($tableName)
                ->insert($aData);

        if ($oResponse) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete contact from module exclude contacts
     * @param type $automationID
     * @param type $subscriberID
     * @return boolean
     */
    public function deleteContactToExcludeCampaign($moduleName, $moduleUnitID, $subscriberID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_users_excluded';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automation_users_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_users_excluded';
                $fieldName = 'account_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_users_excluded';
                $fieldName = 'account_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        if ($moduleUnitID > 0) {

            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('subscriber_id', $subscriberID)
                    ->delete();

            if ($oResponse) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used to update list id in the workflow exclude lists
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $iListID
     * @return boolean
     */
    public function updateWorkflowExcludedList($moduleName, $moduleUnitID, $iListID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists_excluded';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists_excluded';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists_excluded';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if ($moduleUnitID > 0 && $iListID > 0) {

            $oData = DB::table($tableName)
                    ->insert([$fieldName => $moduleUnitID, 'list_id' => $iListID, 'created' => date("Y-m-d H:i:s")]);

            if ($oData) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Used to delete list id from the workflow exclude lists
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $listId
     * @return boolean
     */
    public function deleteWorkflowExcludedLists($moduleName, $moduleUnitID, $listId) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_lists_excluded';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_lists_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_lists_excluded';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_lists_excluded';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }
        if ($moduleUnitID > 0) {

            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('list_id', $listId)
                    ->delete();

            if ($oResponse) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Used to add segment id in the workflow excluded segments
     * @param array $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function addExcludedSegmentToWorkflowCampaign($aData, $moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_segments_exclude';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_segments_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_segments_exclude';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_segments_exclude';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $aData[$fieldName] = $moduleUnitID;

        $oData = DB::table($tableName)
                ->insert($aData);

        if ($oData) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete segment id from the workflow excluded segments
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $segmentID
     * @return boolean
     */
    public function deleteExcludedSegmentToWorkflowCampaign($moduleName, $moduleUnitID, $segmentID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_segments_exclude';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_segments_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_segments_exclude';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_segments_exclude';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if ($moduleUnitID > 0) {

            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('segment_id', $segmentID)
                    ->delete();

            if ($oResponse) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used to add tagid in workflow exclude tags
     * @param array $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     * @return boolean
     */
    public function addExcludedTagToWorkflowCampaign($aData, $moduleName, $moduleUnitID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_tags_exclude';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_tags_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_tags_exclude';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_tags_exclude';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        $aData[$fieldName] = $moduleUnitID;

        $oData = DB::table($tableName)
                ->insert($aData);

        if ($oData) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete tagid from the workflow excluded tags
     * @param type $moduleName
     * @param type $moduleUnitID
     * @param type $tagID
     * @return boolean
     */
    public function deleteExcludedTagToWorkflowCampaign($moduleName, $moduleUnitID, $tagID) {
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_brandboost_campaigns_tags_exclude';
                $fieldName = 'brandboost_id';
                break;
            case "automation":
            case "broadcast":
                $tableName = 'tbl_automations_emails_campaigns_tags_excluded';
                $fieldName = 'automation_id';
                break;
            case "referral":
                $tableName = 'tbl_referral_campaigns_tags_exclude';
                $fieldName = 'referral_id';
                break;
            case "nps":
                $tableName = 'tbl_nps_campaigns_tags_exclude';
                $fieldName = 'nps_id';
                break;
            default :
                $tableName = '';
        }

        if (empty($tableName)) {
            return false;
        }

        if ($moduleUnitID > 0) {
            $oResponse = DB::table($tableName)
                    ->where($fieldName, $moduleUnitID)
                    ->where('tag_id', $tagID)
                    ->delete();

            if ($oResponse) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used to get global workflow campaign
     * @param type $userID
     * @return boolean
     */
    public function getWorkflowCampaignGlobal($userID) {
        if ($userID > 0) {
            $oData = DB::table('tbl_automations_emails')
                    ->where('user_id', $userID)
                    ->where('email_type', 'automation')
                    ->get();
            return $oData;
        }
        return false;
    }

    /**
     * Used to sync workflow audience
     * @param type $modName
     * @param type $campID
     * @param type $userID
     * @return boolean
     */
    public function syncWorkflowAudienceAuto($modName, $campID, $userID) {

        $moduleName = $modName;
        $moduleUnitID = $campID;

        if (!empty($moduleName) && !empty($moduleUnitID)) {
            //Fliter subscibers to be used after excluding filters at the end of the function
            $oPreSyncCampaignSubscribers = self::getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);

            //pre($oPreSyncCampaignSubscribers);
            if (!empty($oPreSyncCampaignSubscribers)) {
                foreach ($oPreSyncCampaignSubscribers as $row) {
                    $preSyncSubscribers[] = $row->subscriber_id;
                }
            }
            //Imported Properites
            //Lists
            $aWorkflowSubscribers = array();
            $oImportLists = $this->getWorkflowImportLists($moduleName, $moduleUnitID);
            if (!empty($oImportLists)) {

                foreach ($oImportLists as $oList) {
                    $aListIDs[] = $oList->list_id;
                }


                //Get Unique Subscribers from each lists
                if (!empty($aListIDs)) {
                    foreach ($aListIDs as $iListID) {
                        $oListSubscribers = $this->getWorkflowCommonListContacts($userID, $iListID);
                        if (!empty($oListSubscribers)) {
                            foreach ($oListSubscribers as $oSubscriber) {
                                if (!in_array($oSubscriber->subscriber_id, $aWorkflowSubscribers)) {
                                    $aWorkflowSubscribers[] = $oSubscriber->subscriber_id;
                                }
                            }
                        }
                    }
                }
            }

            //Imported Contacts
            $oCampaignImportContacts = $this->getWorkflowImportContacts($moduleName, $moduleUnitID);
            if (!empty($oCampaignImportContacts)) {
                foreach ($oCampaignImportContacts as $oRec) {
                    if (!in_array($oRec->subscriber_id, $aWorkflowSubscribers)) {
                        $aWorkflowSubscribers[] = $oRec->subscriber_id;
                    }
                }
            }

            //Imported Tags
            $oCampaignImportTags = $this->getWorkflowImportTags($moduleName, $moduleUnitID);
            if (!empty($oCampaignImportTags)) {
                foreach ($oCampaignImportTags as $oRec) {
                    $tagId = $oRec->tag_id;
                    $oTagSubscribers = self::getWorkflowTagSubscribers($tagId);
                    if (!empty($oTagSubscribers)) {
                        foreach ($oTagSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->id, $aWorkflowSubscribers)) {
                                $aWorkflowSubscribers[] = $oSubscriber->id;
                            }
                        }
                    }
                }
            }

            //Imported Segments
            $oCampaignImportSegments = $this->getWorkflowImportSegments($moduleName, $moduleUnitID);
            if (!empty($oCampaignImportSegments)) {
                foreach ($oCampaignImportSegments as $oRec) {
                    $segmentId = $oRec->segment_id;
                    $oSubscribers = self::getWorkflowSegmentSubscribers($segmentId, $userID);
                    if (!empty($oSubscribers)) {
                        foreach ($oSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->subscriber_id, $aWorkflowSubscribers)) {
                                $aWorkflowSubscribers[] = $oSubscriber->subscriber_id;
                            }
                        }
                    }
                }
            }

            //Excluded Properites
            $aWorkflowExcludedSubscribers = array();
            //Excluded Lists
            $oExcludeLists = $this->getWorkflowExcludeLists($moduleName, $moduleUnitID);
            if (!empty($oExcludeLists)) {
                $aListIDs = array();
                foreach ($oExcludeLists as $oList) {
                    $aListIDs[] = $oList->list_id;
                }


                //Get Unique Subscribers from each lists
                if (!empty($aListIDs)) {
                    foreach ($aListIDs as $iListID) {
                        $oListSubscribers = $this->getWorkflowCommonListContacts($userID, $iListID);
                        if (!empty($oListSubscribers)) {
                            foreach ($oListSubscribers as $oSubscriber) {
                                if (!in_array($oSubscriber->subscriber_id, $aWorkflowExcludedSubscribers)) {
                                    $aWorkflowExcludedSubscribers[] = $oSubscriber->subscriber_id;
                                }
                            }
                        }
                    }
                }
            }

            //Excluded Contacts
            $oCampaignExcludeContacts = $this->getWorkflowExcludeContacts($moduleName, $moduleUnitID);
            if (!empty($oCampaignExcludeContacts)) {
                foreach ($oCampaignExcludeContacts as $oRec) {
                    if (!in_array($oRec->subscriber_id, $aWorkflowExcludedSubscribers)) {
                        $aWorkflowExcludedSubscribers[] = $oRec->subscriber_id;
                    }
                }
            }



            //Excluded Tags
            $oCampaignExcludeTags = $this->getWorkflowExcludeTags($moduleName, $moduleUnitID);
            if (!empty($oCampaignExcludeTags)) {
                foreach ($oCampaignExcludeTags as $oRec) {
                    $tagId = $oRec->tag_id;
                    $oTagSubscribers = self::getWorkflowTagSubscribers($tagId);
                    if (!empty($oTagSubscribers)) {
                        foreach ($oTagSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->id, $aWorkflowExcludedSubscribers)) {
                                $aWorkflowExcludedSubscribers[] = $oSubscriber->id;
                            }
                        }
                    }
                }
            }

            //Excluded Segments
            $oCampaignExcludeSegments = $this->getWorkflowExcludeSegments($moduleName, $moduleUnitID);
            if (!empty($oCampaignExcludeSegments)) {
                foreach ($oCampaignExcludeSegments as $oRec) {
                    $segmentId = $oRec->segment_id;
                    $oSubscribers = self::getWorkflowSegmentSubscribers($segmentId, $userID);
                    if (!empty($oSubscribers)) {
                        foreach ($oSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->subscriber_id, $aWorkflowExcludedSubscribers)) {
                                $aWorkflowExcludedSubscribers[] = $oSubscriber->subscriber_id;
                            }
                        }
                    }
                }
            }

            //For Extra cleanup
            if (!empty($aWorkflowSubscribers)) {
                foreach ($aWorkflowSubscribers as $subscriberID) {
                    if (!in_array($subscriberID, $aWorkflowExcludedSubscribers)) {
                        $aEligibleSubscribers[] = $subscriberID;
                    }
                }
            }
            //pre($aEligibleSubscribers);
            //Step-1: Delete all workflow subscribers from excluded  subscriber
            //Step-2: Add workflow Subscribers only those which are not in excluded subscribers
            //Step-1 Excecution

            if (!empty($aWorkflowExcludedSubscribers)) {
                foreach ($aWorkflowExcludedSubscribers as $subscriberID) {
                    $this->deleteAudienceFromWorkflowCampaign($moduleName, $moduleUnitID, $subscriberID);
                }
            }

            //Step-2 Execution
            if (!empty($aWorkflowSubscribers)) {
                foreach ($aWorkflowSubscribers as $subscriberID) {
                    if (!in_array($subscriberID, $aWorkflowExcludedSubscribers)) {
                        $aData = array(
                            'user_id' => $userID,
                            'subscriber_id' => $subscriberID,
                            'created' => date("Y-m-d H:i:s")
                        );
                        $this->addAudienceToWorkflowCampaignModel($aData, $moduleName, $moduleUnitID);
                    }
                }
            }


            //Get supecious subscribers
            if (!empty($preSyncSubscribers)) {
                foreach ($preSyncSubscribers as $subscriberID) {
                    if (!in_array($subscriberID, $aEligibleSubscribers)) {
                        $suspciousSubscribers[] = $subscriberID;
                    }
                }
            }


            //pre($suspciousSubscribers);

            if (!empty($suspciousSubscribers)) {
                $this->deleteSuspeciousWorkflowCampaignSubscribers($moduleName, $moduleUnitID, $suspciousSubscribers);
            }
        }


        return true;
    }

    public function addAudienceToWorkflowCampaignModel($aData, $moduleName, $moduleUnitID) {
        $subscriberID = $aData['subscriber_id'];
        //Do some necessary check if any
        //Check-1 -Duplicate Entry
        $bDuplicate = $this->isDuplicateWorkflowAudience($moduleName, $moduleUnitID, $subscriberID);
        if ($bDuplicate == false) {
            $this->addAudienceToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
        }
    }

    /**
     * Used to sync worflow global audience 
     */
    public function syncWorkflowAudienceGlobalModel() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($userID > 0) {
            //for now we are syncing only automation module
            $oCampaigns = $this->getWorkflowCampaignGlobal($userID);
            foreach ($oCampaigns as $oCampaign) {
                $campaignID = $oCampaign->id;
                $moduleName = 'automation';
                $userID = $oCampaign->user_id;
                if ($userID > 0) {
                    $this->syncWorkflowAudienceAuto($moduleName, $campaignID, $userID);
                }
            }
        }
    }

    public function getReferralModuleInfo($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_referral_rewards");
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return false;
    }

    public function createReferralLink($aData) {
        if (!empty($aData)) {
            $referralID = $aData['referral_id'];
            $subscriberID = $aData['subscriber_id'];
            $accountID = $aData['account_id'];
            if (!empty($subscriberID)) {
                $bExistReferralLink = $this->checkIfReferralLinkExists($subscriberID, $referralID);
                if ($bExistReferralLink == false) {
                    $timeNow = time();
                    $refKey = $subscriberID . '-' . $timeNow;
                    $aRefData = array(
                        'referral_id' => $referralID,
                        'subscriber_id' => $subscriberID,
                        'refkey' => $refKey,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $bAdded = $this->createAdvocateReferralLink($aRefData);
                    if ($bAdded) {
                        $refLink = site_url() . 'ref/t/' . $refKey;
                    }
                }
            }

            if (!empty($refLink)) {
                return $refLink;
            }
        }
        return false;
    }

    public function createAdvocateReferralLink($aData) {
        $result = $this->db->insert("tbl_referral_reflinks", $aData);
        $inset_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function checkIfReferralLinkExists($subscriberID, $referralID) {

        $this->db->where("subscriber_id", $subscriberID);
        $this->db->where("referral_id", $referralID);
        $result = $this->db->get("tbl_referral_reflinks");
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

}
