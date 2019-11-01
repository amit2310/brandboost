<?php

namespace App\Models\Admin\Modules;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class EmailsModel extends Model {

    /**
     * Get complete automation details
     * @param type $userID
     * @param type $id
     * @param type $automationType
     * @return type
    */
    public function getEmailAutomations($userID = '', $id = '', $automationType = '') {
        $oData = DB::table('tbl_automations_emails')
			->join('tbl_users', 'tbl_automations_emails.user_id', '=', 'tbl_users.id')
			->select('tbl_automations_emails.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
			->where('tbl_automations_emails.email_type', 'automation')
			->where('tbl_automations_emails.deleted', 0)
			->when(($id > 0), function ($query) use ($id) {
				return $query->where('tbl_automations_emails.id', $id);
			})
			->when(($userID > 0), function ($query) use ($userID) {
				return $query->where('tbl_automations_emails.user_id', $userID);
			})
			->when(!empty($automationType), function ($query) use ($automationType) {
				return $query->where('tbl_automations_emails.automation_type', $automationType);
			})
            ->orderBy('tbl_automations_emails.id', 'desc')
            ->paginate(10);
			//->get();

        return $oData;
    }

    /**
     * Return all email events associated with the workflow tree
     * @return type
    */
    public function getAllAutomationEvents($userID = '', $automationID = '') {
        $oData = DB::table('tbl_automations_emails_events')
                ->leftJoin('tbl_automations_emails', 'tbl_automations_emails.id', '=', 'tbl_automations_emails_events.automation_id')
                ->leftJoin('tbl_automations_emails_campaigns', 'tbl_automations_emails_campaigns.event_id', '=', 'tbl_automations_emails_events.id')
                ->select('tbl_automations_emails_events.*', 'tbl_automations_emails_events.id AS automation_event_id', 'tbl_automations_emails_events.created AS eventCreatedTime', 'tbl_automations_emails.title', 'tbl_automations_emails.status AS automationStatus', 'tbl_automations_emails_campaigns.*', 'tbl_automations_emails_campaigns.id AS campaign_id', 'tbl_automations_emails_events.status AS event_status')
                ->when(!empty($userID), function ($query) use ($userID) {
                    return $query->where('tbl_automations_emails.user_id', $userID);
                })
                ->when(!empty($automationID), function ($query) use ($automationID) {
                    return $query->where('tbl_automations_emails.automation_id', $automationID);
                })
                ->orderBy('tbl_automations_emails_events.previous_event_id', 'asc')
                ->get();

        return $oData;
    }

    /**
     * Returns Sendgrid Stats based on custom parameters
     * @param type $param
     * @param type $id
     * @param type $eventType
     * @return type
    */
    public static function getEmailSendgridStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_automations_emails_tracking_sendgrid.* FROM tbl_automations_emails_tracking_sendgrid "
                . "LEFT JOIN tbl_automations_emails ON tbl_automations_emails_tracking_sendgrid.automation_id = tbl_automations_emails.id "
                . "LEFT JOIN tbl_automations_emails_events ON tbl_automations_emails_tracking_sendgrid.event_id = tbl_automations_emails_events.id "
                . "LEFT JOIN tbl_automations_emails_campaigns ON tbl_automations_emails_tracking_sendgrid.campaign_id= tbl_automations_emails_campaigns.id "
                . "LEFT JOIN tbl_automation_users ON tbl_automations_emails_tracking_sendgrid.subscriber_id = tbl_automation_users.id ";

        if ($param == 'automation') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.automation_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='deferred' ";
        }

        $sql .= "ORDER BY tbl_automations_emails_tracking_sendgrid.id DESC";

        $oData = DB::select(DB::raw($sql));

        return $oData;
    }

    /**
     * Use to categorize sendgrid stats data
     * @param type $oData
     * @return array
     */
    public static function getEmailSendgridCategorizedStatsData($oData) {
        $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
        $openUniqueCount = $deliveredUniqueCount = $processedUniqueCount = $clickTotalCount = $clickUniqueCount = $bounceTotalCount = $bounceUniqueCount = $unsubscribeTotalCount = $unsubscribeUniqueCount = $droppedTotalCount = $droppedUniqueCount = $spamTotalCount = $spamUniqueCount = $groupResubscribeTotalCount = $groupResubscribeUniqueCount = $groupUnsubscribeTotalCount = $groupUnsubscribeUniqueCount = $deferredTotalCount = $deferredUniqueCount = $otherTotalCount = $otherUniqueCount = $otherDuplicateCount = $openTotalCount = $processedTotalCount = $deliveredTotalCount = array();
        $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
        if (!empty($oData)) {

            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'open') {
                    $openTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $openUniqueCount) == true) {
                        $openDuplicateCount[] = $oRow;
                    } else {
                        $openUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'click') {
                    $clickTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $clickUniqueCount) == true) {
                        $clickDuplicateCount[] = $oRow;
                    } else {
                        $clickUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'processed') {
                    $processedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $processedUniqueCount) == true) {
                        $processedDuplicateCount[] = $oRow;
                    } else {
                        $processedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'bounce') {
                    $bounceTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $bounceUniqueCount) == true) {
                        $bounceDuplicateCount[] = $oRow;
                    } else {
                        $bounceUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'unsubscribe') {
                    $unsubscribeTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $unsubscribeUniqueCount) == true) {
                        $unsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $unsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'dropped') {
                    $droppedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $droppedUniqueCount) == true) {
                        $droppedDuplicateCount[] = $oRow;
                    } else {
                        $droppedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'spam_report') {
                    $spamTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $spamUniqueCount) == true) {
                        $spamDuplicateCount[] = $oRow;
                    } else {
                        $spamUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_resubscribe') {
                    $groupResubscribeTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $groupResubscribeUniqueCount) == true) {
                        $groupResubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupResubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_unsubscribe') {
                    $groupUnsubscribeTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $groupUnsubscribeUniqueCount) == true) {
                        $groupUnsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupUnsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'deferred') {
                    $deferredTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $deferredUniqueCount) == true) {
                        $deferredDuplicateCount[] = $oRow;
                    } else {
                        $deferredUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
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
     * Check for duplicate record in the stats
     * @param type $aSearch
     * @param type $tableData
     * @return boolean
     */
    public static function checkIfDuplicateExistsInSendgridStat($aSearch, $tableData) {
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
     * Get All member's automation campaigns
     * @param type $automationID
     * @return type
     */
    public static function getAutomationEvents($automationID) {
        $oData = DB::table('tbl_automations_emails_events')
                ->leftJoin('tbl_automations_emails', 'tbl_automations_emails.id', '=', 'tbl_automations_emails_events.automation_id')
                ->leftJoin('tbl_automations_emails_campaigns', 'tbl_automations_emails_campaigns.event_id', '=', 'tbl_automations_emails_events.id')
                ->select('tbl_automations_emails_events.*', 'tbl_automations_emails_events.id AS automation_event_id', 'tbl_automations_emails_events.created AS eventCreatedTime', 'tbl_automations_emails.title', 'tbl_automations_emails.status AS automationStatus', 'tbl_automations_emails_campaigns.*', 'tbl_automations_emails_campaigns.id AS campaign_id', 'tbl_automations_emails_events.status AS event_status')
                ->where('tbl_automations_emails_events.automation_id', $automationID)
                ->get();

        return $oData;
    }

    /**
     * Used to publish/unpublish Automation campaigns
     * @param type $aData
     * @param type $automationID
     * @param type $userID
     * @return boolean
     */
    public function publishAutomationEvent($aData, $automationID, $userID) {
		$oResponse2 = '';
        if ($automationID > 0) {
            $oResponse = DB::table('tbl_automations_emails_events')
                    ->where('automation_id', $automationID)
                    ->update($aData);

            if ($oResponse > -1) {
                $oResponse2 = DB::table('tbl_automations_emails')
                        ->where('id', $automationID)
                        ->update($aData);
            }
            if (($oResponse > -1) || ($oResponse2 > -1)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Checks if Automation campaign exists
     * @param type $automationName
     * @param type $userID
     * @return boolean
     */
    public function checkIfEmailAutomationExists($automationName, $userID, $automationID='') {
        $oData = DB::table('tbl_automations_emails')
                ->where('user_id', $userID)
                ->where('title', $automationName)
                ->where('id', '!=', $automationID)
                ->where('deleted', 0)
                ->exists();
        return $oData;
    }

    /**
     * Used to add Email automation
     * @param type $aData
     * @return boolean
     */
    public function addEmailAutomation($aData) {
        $insert_id = DB::table('tbl_automations_emails')->insertGetId($aData);
        return $insert_id;
    }

    /**
     *
     * @param type $aData
     * @param type $id
     * @param type $userID
     * @return boolean
     */
    public function updateEmailAutomation($aData, $id, $userID = '') {
        $oData = DB::table('tbl_automations_emails')
        ->where('id', $id)
        ->when(($userID > 0), function($query) use ($userID) {
            return $query->where('user_id', $userID);
        })
        ->update($aData);
        if($oData>-1){
            return true;
        }else{
            return false;
        }
    }


    /**
     *
     * @param type $id
     * @param type $userID
     * @return boolean
     */
    public function deleteEmailAutomation($id, $userID = '') {
        $aData = array(
           'deleted' => '1'
        );
        $oData = DB::table('tbl_automations_emails')
        ->where('id', $id)
        ->when(($userID > 0), function($query) use ($userID) {
            return $query->where('user_id', $userID);
        })
        ->delete();
        return true;

    }

    /**
     * Used to add/update automation list
     * @param type $automationID
     * @param type $iListID
     * @return boolean
     */
    public function updateAutomationList($automationID, $iListID) {
        if ($automationID > 0 && $iListID > 0) {
            $result = DB::table('tbl_automations_emails_lists')->insert(['automation_id' => $automationID, 'list_id' => $iListID, 'created' => date("Y-m-d H:i:s")]);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Update automation excluded list
     * @param type $automationID
     * @param type $iListID
     * @return boolean
     */
    public function updateAutomationExcludedList($automationID, $iListID) {
        if ($automationID > 0 && $iListID > 0) {
            $result = DB::table('tbl_automations_emails_lists_excluded')->insert(['automation_id' => $automationID, 'list_id' => $iListID, 'created' => date("Y-m-d H:i:s")]);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function getEmailCampaignInfo($eventID) {
        $this->db->where('event_id', $eventID);
        $result = $this->db->get("tbl_automations_emails_campaigns");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
            return $response;
        }
        return false;
    }

    public function getEmailAutomationCampaign($id) {
        $this->db->where('id', $id);
        $result = $this->db->get("tbl_automations_emails_campaigns");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
            return $response;
        }
        return false;
    }

    public function addEmailAutomationCampaign($aData) {
        $result = $this->db->insert("tbl_automations_emails_campaigns", $aData);
        //echo $this->db->last_query();
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addEmailAutomationSegment($aData) {
        $result = $this->db->insert("tbl_automations_emails_campaigns_segment", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function getEmailAutomationEventByPreviousID($previousID) {
        $this->db->where("previous_event_id", $previousID);
        $result = $this->db->get("tbl_automations_emails_events");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getEmailAutomationEvent($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_automations_emails_events");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function addEmailAutomationEvent($aData) {
        $result = $this->db->insert("tbl_automations_emails_events", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function updateEmailAutomationEvent($aData, $eventID) {
        $this->db->where("id", $eventID);
        $result = $this->db->update("tbl_automations_emails_events", $aData);
        //echo $this->db->last_query();exit;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function manageEmailAutomationEventOrder($aData, $previousID, $id) {
        $this->db->where("previous_event_id", $previousID);
        $this->db->where("id !=", $id);
        $result = $this->db->update("tbl_automations_emails_events", $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete automation list
     * @param type $automationID
     * @param type $listId
     * @return boolean
     */
    public function deleteAutomationLists($automationID, $listId) {
        if ($automationID > 0) {
            $result = DB::table('tbl_automations_emails_lists')
                    ->where('automation_id', $automationID)
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
     * Used to delete automation excluded list
     * @param type $automationID
     * @param type $listId
     * @return boolean
     */
    public function deleteAutomationExcludedLists($automationID, $listId) {
        if ($automationID > 0) {
            $result = DB::table('tbl_automations_emails_lists_excluded')
                    ->where('automation_id', $automationID)
                    ->where('list_id', $listId)
                    ->delete();
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteAllAutomationLists($automationID) {
        if ($automationID > 0) {
            $this->db->where('automation_id', $automationID);
            $result = $this->db->delete("tbl_automations_emails_lists");
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteEmailAutomationEvent($id) {
        if ($id > 0) {
            $bCheckIfMainEvent = $this->isMainEvent($id);
            if ($bCheckIfMainEvent == true) {
                //Delete only campaign not the event
                $result = $this->deleteEmailAutomationCampaign($id);
            } else {
                //delete both event + campaign
                $this->db->where('id', $id);
                $response = $this->db->delete("tbl_automations_emails_events");
                if ($response) {
                    $result = $this->deleteEmailAutomationCampaign($id);
                }
            }
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function isMainEvent($id) {
        $this->db->where("event_type !=", 'followup');
        $this->db->where("previous_event_id", 0);
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_automations_emails_events");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEmailAutomationCampaign($eventID) {
        if ($eventID > 0) {
            $this->db->where('event_id', $eventID);
            $result = $this->db->delete("tbl_automations_emails_campaigns");
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Used to get Email module template
     * @param type $userID
     * @param type $type
     * @return type
     */
    public function getEmailMoudleTemplates($userID = 0, $type = 'email') {
        $oData = DB::table('tbl_automations_emails_campaigns_templates')
                ->where('template_type', $type)
                ->when(($userID > 0), function ($query) use ($type) {
                    return $query->where('user_id', $type);
                }, function ($query){
                    return $query->where('user_id', 0);
                })
                ->get();
        return $oData;
    }

    public function getEmailMoudleTemplateInfo($id) {
        $this->db->where('id', $id);
        $result = $this->db->get("tbl_automations_emails_campaigns_templates");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function updateEmailAutomationCampaign($aData, $id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            $result = $this->db->update("tbl_automations_emails_campaigns", $aData);
            //echo $this->db->last_query(); die();
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function getEmailTwilioStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_automations_emails_tracking_twillio.* FROM tbl_automations_emails_tracking_twillio "
                . "LEFT JOIN tbl_automations_emails ON tbl_automations_emails_tracking_twillio.automation_id = tbl_automations_emails.id "
                . "LEFT JOIN tbl_automations_emails_events ON tbl_automations_emails_tracking_twillio.event_id = tbl_automations_emails_events.id "
                . "LEFT JOIN tbl_automations_emails_campaigns ON tbl_automations_emails_tracking_twillio.campaign_id= tbl_automations_emails_campaigns.id "
                . "LEFT JOIN tbl_automation_users ON tbl_automations_emails_tracking_twillio.subscriber_id = tbl_automation_users.id ";

        if ($param == 'automation') {
            $sql .= "WHERE tbl_automations_emails_tracking_twillio.automation_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_automations_emails_tracking_twillio.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_automations_emails_tracking_twillio.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_automations_emails_tracking_twillio.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND tbl_automations_emails_tracking_twillio.event_name='sending' ";
        }

        $sql .= "ORDER BY tbl_automations_emails_tracking_twillio.id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    public function getEmailTwilioCategorizedStatsData($oData) {
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
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $acceptedUniqueCount) == true) {
                        $acceptedDuplicateCount[] = $oRow;
                    } else {
                        $acceptedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sent') {
                    $sentTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $sentUniqueCount) == true) {
                        $sentDuplicateCount[] = $oRow;
                    } else {
                        $sentUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'undelivered') {
                    $undeliveredTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $undeliveredUniqueCount) == true) {
                        $undeliveredDuplicateCount[] = $oRow;
                    } else {
                        $undeliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'failed') {
                    $failedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $failedUniqueCount) == true) {
                        $failedDuplicateCount[] = $oRow;
                    } else {
                        $failedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'receiving') {
                    $receivingTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $receivingUniqueCount) == true) {
                        $receivingDuplicateCount[] = $oRow;
                    } else {
                        $receivingUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'received') {
                    $receivedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $receivedUniqueCount) == true) {
                        $receivedDuplicateCount[] = $oRow;
                    } else {
                        $receivedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'queued') {
                    $queuedTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $queuedUniqueCount) == true) {
                        $queuedDuplicateCount[] = $oRow;
                    } else {
                        $queuedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sending') {
                    $sendingTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $sendingUniqueCount) == true) {
                        $sendingDuplicateCount[] = $oRow;
                    } else {
                        $sendingUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if (self::checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
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

    public function getEmailSendgridStatsByDate($param, $id, $eventType = '') {
        $sql = "SELECT tbl_automations_emails_tracking_sendgrid.*, COUNT(tbl_automations_emails_tracking_sendgrid.created) as totalCount FROM tbl_automations_emails_tracking_sendgrid "
                . "LEFT JOIN tbl_automations_emails ON tbl_automations_emails_tracking_sendgrid.automation_id = tbl_automations_emails.id "
                . "LEFT JOIN tbl_automations_emails_events ON tbl_automations_emails_tracking_sendgrid.event_id = tbl_automations_emails_events.id "
                . "LEFT JOIN tbl_automations_emails_campaigns ON tbl_automations_emails_tracking_sendgrid.campaign_id= tbl_automations_emails_campaigns.id "
                . "LEFT JOIN tbl_automation_users ON tbl_automations_emails_tracking_sendgrid.subscriber_id = tbl_automation_users.id ";

        if ($param == 'automation') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.automation_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_automations_emails_tracking_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_automations_emails_tracking_sendgrid.event_name='deferred' ";
        }

        $sql .= "GROUP BY DATE(tbl_automations_emails_tracking_sendgrid.created) ORDER BY tbl_automations_emails_tracking_sendgrid.id DESC";

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

}
