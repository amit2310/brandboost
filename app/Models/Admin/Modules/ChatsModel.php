<?php

namespace App\Models\Admin\Modules;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ChatsModel extends Model {

    /**
     * Used to get member chat list
     */
    public static function getChatLists($userID, $userRole) {
        $oData = DB::table('tbl_chat_main')
            ->leftJoin('tbl_users', 'tbl_chat_main.user_id', '=' , 'tbl_users.id')
            ->select('tbl_chat_main.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile')
            ->when(($userRole != 1), function ($query) use ($userID) {
                    return $query->where('tbl_chat_main.user_id', $userID);
                })
            ->orderBy('id', 'desc')
            //->get();
            ->paginate(10);

        return $oData;
    }

	/**
     * Used to add chat widget data
	 * @param type $recordId
     * @return type
     */
	public static function addChat($aData) {
		$insert_id = DB::table('tbl_chat_main')->insertGetId($aData);
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }

	/**
     * Used to get chat widget data by user id
	 * @param type $userID
     * @return type
     */
	public static function getChat($userID, $id = '') {
		$oData = DB::table('tbl_chat_main')
			->select('tbl_chat_main.*')
			->when(($id > 0), function ($query) use ($id) {
				return $query->where('tbl_chat_main.id', $id);
			})
			->where('tbl_chat_main.user_id', $userID)
			->first();
        return $oData;
    }

	/**
     * Used to update chat widget data by chat id
	 * @param type $userID
	 * @param type $id
     * @return type
     */
	public static function updateChat($aData, $userID, $id) {
//	    print_r($aData);
//	    exit;
		$result = DB::table('tbl_chat_main')
           ->where('id', $id)
           ->where('user_id', $userID)
           ->update($aData);

        if ($result > -1) {
            return $id;
        } else {
            return false;
        }
    }

	/**
     * Used to delete chat widget
	 * @param type $userID
	 * @param type $id
     * @return type
     */
    public static function deleteChat($userID, $id) {
		$result = DB::table('tbl_chat_main')
		   ->where('id', $id)
		   ->where('user_id', $userID)
		   ->delete();
		if ($result) {
			return true;
		} else {
			return false;
		}
    }











    public function saveNPSEvents($eData, $npsID) {
        if ($npsID != '') {
            //Invite Email
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'invite-email',
                'data' => $eData['invite-email'],
                'previous_event_id' => 0,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_nps_automations_events", $aData);
            $inviteEmailInsertID = $this->db->insert_id();

            //Invite SMS
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'invite-sms',
                'data' => $eData['invite-sms'],
                'previous_event_id' => $inviteEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_nps_automations_events", $aData);
            $inviteSMSInsertID = $this->db->insert_id();

            //Reminder Email
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'reminder-email',
                'data' => $eData['reminder-email'],
                'previous_event_id' => $inviteSMSInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_nps_automations_events", $aData);
            $reminderEmailInsertID = $this->db->insert_id();

            //Reminder SMS
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'reminder-sms',
                'data' => $eData['reminder-sms'],
                'previous_event_id' => $reminderEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_nps_automations_events", $aData);
            $reminderSMSInsertID = $this->db->insert_id();

            $oTemplates = $this->getDefaultNPSTemplates();
            if (!empty($oTemplates)) {
                foreach ($oTemplates as $oTemplate) {

                    $templateName = $oTemplate->template_name;
                    $templateType = $oTemplate->template_type;
                    $subject = $oTemplate->template_subject;
                    $content = $oTemplate->template_content;

                    if ($templateName == 'Email Invite') {
                        $eventID = $inviteEmailInsertID;
                    } else if ($templateName == 'SMS Invite') {
                        $eventID = $inviteSMSInsertID;
                    } else if ($templateName == 'Email Reminder') {
                        $eventID = $reminderEmailInsertID;
                    } else if ($templateName == 'SMS Reminder') {
                        $eventID = $reminderSMSInsertID;
                    }

                    $tempData = array(
                        'event_id' => $eventID,
                        'content_type' => ($templateType == 'email') ? 'Regular Html' : 'Plain Text',
                        'campaign_type' => ($templateType == 'email') ? 'Email' : 'Sms',
                        'name' => $templateName,
                        'subject' => $subject,
                        'html' => $content,
                        'status' => 'draft',
                        'created' => date("Y-m-d H:i:s")
                    );

                    $this->insertNPSCampaigns($tempData);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function getNPSCampaign($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_nps_automations_campaigns");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function getNPSEvents($npsID) {
        $this->db->where("nps_id", $npsID);
        $this->db->order_by("id", "ASC");
        $result = $this->db->get("tbl_nps_automations_events");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    public function getNPSEventsByNPSIdEventType($npsID, $eventType) {
        $this->db->where("nps_id", $npsID);
        $this->db->where("event_type", $eventType);
        $result = $this->db->get("tbl_nps_automations_events");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    public function getCampaignsByEventID($eventID) {
        $this->db->where("event_id", $eventID);
        $this->db->where("delete_status", 0);
        $result = $this->db->get("tbl_nps_automations_campaigns");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    public function getDefaultNPSTemplates() {
        $this->db->where("status", "active");
        $this->db->where("user_id", "0");
        $result = $this->db->get("tbl_nps_automations_templates");
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    public function insertNPSCampaigns($tempData) {
        $this->db->insert("tbl_nps_automations_campaigns", $tempData);
        $campaignID = $this->db->insert_id();
        if ($campaignID) {
            return $campaignID;
        } else {
            return false;
        }
    }

    public function updateUserCampaign($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_nps_automations_campaigns", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCampaignByEventId($aData, $eventId) {
        $this->db->where("event_id", $eventId);
        $result = $this->db->update("tbl_nps_automations_campaigns", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEvent($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_nps_automations_events", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getSurveyInfoByRef($refKey) {
        $this->db->where("hashcode", $refKey);
        $result = $this->db->get("tbl_nps_main");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function updateSurveyFeedback($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_nps_score", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function saveSurveyFeedback($aData) {
        $refKey = $aData['refkey'];
        $ip = $aData['ip_address'];
        $subscriberID = $aData['subscriber_id'];
        $oSurvery = $this->checkIfRecordedSurvey($refKey, $ip, $subscriberID);
        if (!empty($oSurvery)) {
            $responseID = $oSurvery->id;
            if ($responseID > 0) {
                //Update
                $result = $this->updateSurveyFeedback($aData, $responseID);
            }
        } else {
            //Insert
            $result = $this->db->insert("tbl_nps_score", $aData);
            $responseID = $this->db->insert_id();
        }
        return $responseID;
    }

    public function checkIfRecordedSurvey($refkey, $ip, $subscriberID = '') {
        if (!empty($subscriberID)) {
            $this->db->where("subscriber_id", $subscriberID);
        }
        $this->db->where("refkey", $refkey);
        $this->db->where("ip_address", $ip);
        $result = $this->db->get("tbl_nps_score");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getNPSProgramInfo($accountID) {
        $this->db->where("hashcode", $accountID);
        $result = $this->db->get("tbl_nps_main");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getNPSScore($hashKey) {
        $response = "";
        $this->db->select("tbl_nps_score.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone");
        $this->db->join("tbl_nps_users", "tbl_nps_users.id=tbl_nps_score.subscriber_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_nps_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_nps_score.refkey", $hashKey);
        $result = $this->db->get("tbl_nps_score");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getNPSScoreSummery($refKey) {

        $response = "";
        $positive = $nuetral = $negative = 0;
        $pScore = $nScore = $negScore = 0;

        $this->db->where("tbl_nps_score.refkey", $refKey);
        $result = $this->db->get("tbl_nps_score");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
            if (!empty($response)) {
                foreach ($response as $oRec) {

                    if ($oRec->score > 8) {
                        $positive++;
                        $pScore += $oRec->score;
                    } else if ($oRec->score > 6 && $oRec->score < 9) {
                        //echo "yes , I am here";
                        $nuetral++;
                        $nScore += $oRec->score;
                    } else if ($oRec->score < 7) {
                        $negative++;
                        $negScore += $oRec->score;
                    }
                }
            }
        }

        $positiveScore = ($positive) ? $positive : 0;
        $nuetralScore = ($nuetral) ? $nuetral : 0;
        $negativeScore = ($negative) ? $negative : 0;
        $NPSScore = '';
        $positiveGrand = ($pScore > 0) ? ($pScore / $positive) : 0;
        $negativeGrand = ($negScore > 0) ? ($negScore / $negative) : 0;

        $aData = array(
            'Promoters' => $positiveScore,
            'Passive' => $nuetralScore,
            'Detractors' => $negativeScore,
            'NPSScore' => (($positiveGrand - $negativeGrand) * 10)
        );

        return $aData;
    }

    public function getScoreDetails($scoreID) {
        $this->db->select("tbl_nps_score.*, tbl_nps_main.title AS npstitle, "
                . "tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone");
        $this->db->join("tbl_nps_main", "tbl_nps_main.hashcode=tbl_nps_score.refkey", "LEFT");
        $this->db->join("tbl_nps_users", "tbl_nps_users.id=tbl_nps_score.subscriber_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_nps_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_nps_score.id", $scoreID);
        $result = $this->db->get("tbl_nps_score");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getNPSSubscribers($accountID) {
        $this->db->select('tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone');
        $this->db->join("tbl_subscribers", "tbl_nps_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_nps_users.account_id", $accountID);
        $this->db->order_by('tbl_nps_users.id', 'DESC');
        $result = $this->db->get("tbl_nps_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result_array();
        }
        return $response;
    }

    public function getNPSNotes($id) {
        if (!empty($id)) {
            $this->db->select("tbl_nps_notes.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email");
            $this->db->join("tbl_users", "tbl_nps_notes.user_id=tbl_users.id", "LEFT");
            $this->db->where("tbl_nps_notes.score_id", $id);
            $this->db->order_by("tbl_nps_notes.id", "DESC");
            $result = $this->db->get("tbl_nps_notes");
            //echo $this->db->last_query();
            //die;
            if ($result->num_rows() > 0) {
                $response = $result->result();
            }
            return $response;
        }
    }

    public function getTagsByScoreID($scoreID) {

        $this->db->select("tbl_tag_groups_entity.*, tbl_nps_tags.tag_id, tbl_nps_tags.score_id");
        $this->db->join("tbl_tag_groups_entity", "tbl_tag_groups_entity.id=tbl_nps_tags.tag_id", "LEFT");
        $this->db->where("tbl_nps_tags.score_id", $scoreID);
        $result = $this->db->get("tbl_nps_tags");
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function saveNPSNotes($aData) {
        $bSaved = $this->db->insert("tbl_nps_notes", $aData);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($bSaved)
            return $insert_id;
        return false;
    }

    public function addNPSTag($aData) {
        $aTagIDs = $aData['aTagIDs'];
        if (!empty($aTagIDs)) {
            foreach ($aTagIDs as $iTagID) {
                $aInput = array(
                    'tag_id' => $iTagID,
                    'score_id' => $aData['score_id'],
                    'applied_tag_created' => date("Y-m-d H:i:s")
                );

                $tagData = $this->getTagByScoreIDTagID($iTagID, $aData['score_id']);
                if ($tagData->id == '') {
                    $result = $this->db->insert('tbl_nps_tags', $aInput);
                }

                $oTags = $this->getTagsByScoreID($aData['score_id']);
                foreach ($oTags as $oTag) {
                    if (in_array($oTag->tag_id, $aTagIDs)) {
                        $result = true;
                    } else {
                        $result = $this->deleteNPSTagByID($oTag->tag_id, $aData['score_id']);
                    }
                }
            }
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNPSTagByID($id, $scoreID) {
        $this->db->where('tag_id', $id);
        $this->db->where('score_id', $scoreID);
        $result = $this->db->delete('tbl_nps_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getTagByScoreIDTagID($aTagID, $scoreID) {
        $this->db->where('tag_id', $aTagID);
        $this->db->where('score_id', $scoreID);
        $result = $this->db->get('tbl_nps_tags');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function removeNPSTag($tagID, $scoreID) {
        $this->db->where("score_id", $scoreID);
        $this->db->where("tag_id", $tagID);
        $result = $this->db->delete('tbl_nps_tags');
        //echo $this->db->last_query(); exit;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getNPSNoteByID($noteId) {

        $this->db->where('id', $noteId);
        $this->db->from('tbl_nps_notes');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function deleteNPSNoteByID($noteId) {
        $this->db->where('id', $noteId);
        $result = $this->db->delete('tbl_nps_notes');
        return true;
    }

    public function updateNPSNote($aData, $noteId) {

        $this->db->where('id', $noteId);
        $result = $this->db->update('tbl_nps_notes', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function getClientTags($userID = 0) {

        $this->db->select("tbl_tag_groups.*, tbl_tag_groups_entity.id AS tagid, tbl_tag_groups_entity.tag_name, tbl_tag_groups_entity.tag_created ");
        $this->db->join("tbl_tag_groups_entity", "tbl_tag_groups.id=tbl_tag_groups_entity.group_id", "LEFT");
        if ($userID > 0) {
            $this->db->where("tbl_tag_groups.user_id", $userID);
        }
        $this->db->order_by("tbl_tag_groups.id", "DESC");
        $result = $this->db->get('tbl_tag_groups');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function checkIfExistingUser($subscriberID, $accountID = '') {
        $this->db->select("tbl_nps_users.*");
        $this->db->where("tbl_nps_users.subscriber_id", $subscriberID);
        if (!empty($accountID)) {
            $this->db->where("tbl_nps_users.account_id", $accountID);
        }
        $result = $this->db->get("tbl_nps_users");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function addNPSUser($aData) {

        $result = $this->db->insert('tbl_nps_users', $aData);
        $insertID = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($result)
            return $insertID;
        else
            return false;
    }

    public function getMyUsers($accountID) {
        $this->db->select("tbl_nps_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone");
        $this->db->join("tbl_subscribers", "tbl_nps_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_nps_users.account_id", $accountID);
        $result = $this->db->get("tbl_nps_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getNpsUserById($userID) {
        $this->db->select("tbl_nps_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone");
        $this->db->join("tbl_subscribers", "tbl_nps_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_nps_users.id", $userID);
        $result = $this->db->get("tbl_nps_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateNpsUser($aData, $userID) {

        $this->db->where('id', $userID);
        $result = $this->db->update('tbl_nps_users', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteNpsUser($userID) {

        $this->db->where('id', $userID);
        $result = $this->db->delete('tbl_nps_users');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function unsubscribeUser($accountID, $subscriberID) {
        $response = array();
        $this->db->set(array('status' => 0));
        $this->db->where('id', $subscriberID);
        $this->db->where('account_id', $accountID);
        $result = $this->db->update('tbl_nps_users');
        //echo $this->db->last_query();;
        if ($result)
            return true;
        else
            return false;
    }

    public function getNPSSendgridStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_nps_automations_tracking_sendgrid.* FROM tbl_nps_automations_tracking_sendgrid "
                . "LEFT JOIN tbl_nps_main ON tbl_nps_automations_tracking_sendgrid.nps_id = tbl_nps_main.id "
                . "LEFT JOIN tbl_nps_automations_events ON tbl_nps_automations_tracking_sendgrid.event_id = tbl_nps_automations_events.id "
                . "LEFT JOIN tbl_nps_automations_campaigns ON tbl_nps_automations_tracking_sendgrid.campaign_id= tbl_nps_automations_campaigns.id "
                . "LEFT JOIN tbl_nps_users ON tbl_nps_automations_tracking_sendgrid.subscriber_id = tbl_nps_users.id ";

        if ($param == 'nps') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.nps_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='deferred' ";
        }

        $sql .= "ORDER BY tbl_nps_automations_tracking_sendgrid.id DESC";

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getEmailSendgridCategorizedStatsData($oData) {

        if (!empty($oData)) {
            $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
            $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'open') {
                    $openTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $openUniqueCount) == true) {
                        $openDuplicateCount[] = $oRow;
                    } else {
                        $openUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'click') {
                    $clickTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $clickUniqueCount) == true) {
                        $clickDuplicateCount[] = $oRow;
                    } else {
                        $clickUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'processed') {
                    $processedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $processedUniqueCount) == true) {
                        $processedDuplicateCount[] = $oRow;
                    } else {
                        $processedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'bounce') {
                    $bounceTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $bounceUniqueCount) == true) {
                        $bounceDuplicateCount[] = $oRow;
                    } else {
                        $bounceUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'unsubscribe') {
                    $unsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $unsubscribeUniqueCount) == true) {
                        $unsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $unsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'dropped') {
                    $droppedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $droppedUniqueCount) == true) {
                        $droppedDuplicateCount[] = $oRow;
                    } else {
                        $droppedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'spam_report') {
                    $spamTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $spamUniqueCount) == true) {
                        $spamDuplicateCount[] = $oRow;
                    } else {
                        $spamUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_resubscribe') {
                    $groupResubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $groupResubscribeUniqueCount) == true) {
                        $groupResubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupResubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_unsubscribe') {
                    $groupUnsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $groupUnsubscribeUniqueCount) == true) {
                        $groupUnsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupUnsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'deferred') {
                    $deferredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deferredUniqueCount) == true) {
                        $deferredDuplicateCount[] = $oRow;
                    } else {
                        $deferredUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
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

    public function checkIfDuplicateExistsInSendgridStat($aSearch, $tableData) {
        if (!empty($tableData)) {
            foreach ($tableData as $oData) {
                if ($oData->subscriber_id == $aSearch->subscriber_id && $oData->campaign_id == $aSearch->campaign_id) {
                    return true;
                }
            }
            return false;
        }
    }

    public function getEmailTwilioStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_nps_automations_tracking_twillio.* FROM tbl_nps_automations_tracking_twillio "
                . "LEFT JOIN tbl_nps_main ON tbl_nps_automations_tracking_twillio.nps_id = tbl_nps_main.id "
                . "LEFT JOIN tbl_nps_automations_events ON tbl_nps_automations_tracking_twillio.event_id = tbl_nps_automations_events.id "
                . "LEFT JOIN tbl_nps_automations_campaigns ON tbl_nps_automations_tracking_twillio.campaign_id= tbl_nps_automations_campaigns.id "
                . "LEFT JOIN tbl_nps_users ON tbl_nps_automations_tracking_twillio.subscriber_id = tbl_nps_users.id ";


        if ($param == 'campaign') {
            $sql .= "WHERE tbl_nps_automations_tracking_twillio.campaign_id='{$id}' ";
        } else if ($param == 'event') {
            $sql .= "WHERE tbl_nps_automations_tracking_twillio.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_nps_automations_tracking_twillio.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='sending' ";
        }

        $sql .= "ORDER BY tbl_nps_automations_tracking_twillio.id DESC";

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getEmailTwilioCategorizedStatsData($oData) {
        if (!empty($oData)) {

            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'accepted') {
                    $acceptedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $acceptedUniqueCount) == true) {
                        $acceptedDuplicateCount[] = $oRow;
                    } else {
                        $acceptedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sent') {
                    $sentTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $sentUniqueCount) == true) {
                        $sentDuplicateCount[] = $oRow;
                    } else {
                        $sentUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'undelivered') {
                    $undeliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $undeliveredUniqueCount) == true) {
                        $undeliveredDuplicateCount[] = $oRow;
                    } else {
                        $undeliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'failed') {
                    $failedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $failedUniqueCount) == true) {
                        $failedDuplicateCount[] = $oRow;
                    } else {
                        $failedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'receiving') {
                    $receivingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $receivingUniqueCount) == true) {
                        $receivingDuplicateCount[] = $oRow;
                    } else {
                        $receivingUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'received') {
                    $receivedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $receivedUniqueCount) == true) {
                        $receivedDuplicateCount[] = $oRow;
                    } else {
                        $receivedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'queued') {
                    $queuedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $queuedUniqueCount) == true) {
                        $queuedDuplicateCount[] = $oRow;
                    } else {
                        $queuedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sending') {
                    $sendingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $sendingUniqueCount) == true) {
                        $sendingDuplicateCount[] = $oRow;
                    } else {
                        $sendingUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
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

    public function getNPSCampaignTemplates($npsId) {
        $this->db->select("tbl_nps_automations_campaigns.*");
        $this->db->join("tbl_nps_automations_events", "tbl_nps_automations_events.id=tbl_nps_automations_campaigns.event_id", "INNER");
        $this->db->where("tbl_nps_automations_events.nps_id", $npsId);
        $result = $this->db->get("tbl_nps_automations_campaigns");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function updataCampaignByEventID($cData, $eventID) {
        $this->db->where("event_id", $eventID);
        $result = $this->db->update("tbl_nps_automations_campaigns", $cData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAutoEvent($aData, $id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            $result = $this->db->update("tbl_nps_automations_events", $aData);
            //echo $this->db->last_query();
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

}
