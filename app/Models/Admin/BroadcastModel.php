<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class BroadcastModel extends Model {

    /**
     * 
     * @param type $userID
     * @param type $id
     * @return type
     */
    public function getMyBroadcasts($userID, $id = 0) {
        $aData = array();
        $this->db->select("tbl_automations_emails_campaigns.*, tbl_automations_emails.id as broadcast_id, tbl_automations_emails.user_id, tbl_automations_emails.title, tbl_automations_emails.description, tbl_automations_emails.email_type, tbl_automations_emails.status as bc_status, tbl_automations_emails.current_state,tbl_automations_emails.audience_type, tbl_automations_emails.sending_method, tbl_automations_emails.created, tbl_automations_emails_events.event_type, tbl_automations_emails_events.data, tbl_automations_emails_events.id as evtid");
        if ($userID > 0) {
            $this->db->where('tbl_automations_emails.user_id', $userID);
        }
        $this->db->order_by('tbl_automations_emails.id', 'ASC');
        if ($id > 0) {
            $this->db->where('tbl_automations_emails.id', $id);
        }
        $this->db->where('tbl_automations_emails.deleted', '0');
        $this->db->where('tbl_automations_emails.email_type', 'broadcast');
        $this->db->join("tbl_automations_emails_events", "tbl_automations_emails_events.automation_id=tbl_automations_emails.id", "LEFT");
        $this->db->join("tbl_automations_emails_campaigns", "tbl_automations_emails_campaigns.event_id=tbl_automations_emails_events.id", "LEFT");

        $query = $this->db->get('tbl_automations_emails');
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    /**
     * 
     * @param type $broadcastID
     * @return type
     */
    public function getBroadcastVariations($broadcastID) {
        $this->db->select("tbl_broadcast_split_campaigns.*, tbl_broadcast_split_testing.test_name, tbl_broadcast_split_testing.id as splitID");
        $this->db->join("tbl_broadcast_split_testing", "tbl_broadcast_split_campaigns.split_test_id = tbl_broadcast_split_testing.id", "LEFT");
        $this->db->where("tbl_broadcast_split_campaigns.broadcast_id", $broadcastID);
        $this->db->where("tbl_broadcast_split_campaigns.status", "active");
        $this->db->order_by("tbl_broadcast_split_campaigns.id", "ASC");
        $query = $this->db->get('tbl_broadcast_split_campaigns');

        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    /**
     * 
     * @param type $broadcastID
     * @return type
     */
    public function getBroadcastVariationCampaigns($broadcastID) {
        $this->db->where("tbl_broadcast_split_campaigns.broadcast_id", $broadcastID);
        $this->db->order_by("tbl_broadcast_split_campaigns.id", "ASC");
        $query = $this->db->get('tbl_broadcast_split_campaigns');

        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    
    /**
     * 
     * @param type $aData
     * @param type $sendingMethod
     * @return boolean
     */
    public function addBroadcastCampaign($aData, $sendingMethod = 'normal') {
        if ($sendingMethod == 'split') {
            $result = $this->db->insert("tbl_broadcast_split_campaigns", $aData);
        } else {
            $result = $this->db->insert("tbl_automations_emails_campaigns", $aData);
        }
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addBroadcastVariation($aData) {
        $result = $this->db->insert("tbl_broadcast_split_campaigns", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function deleteVariation($id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            $result = $this->db->delete("tbl_broadcast_split_campaigns");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function updateVariation($aData, $id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $result = $this->db->update('tbl_broadcast_split_campaigns', $aData);
            if ($result)
                return true;
        }
        return false;
    }

    public function updateSplitTest($aData, $id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $result = $this->db->update('tbl_broadcast_split_testing', $aData);
            if ($result)
                return true;
        }
        return false;
    }

    public function getMyBroadcastsByTypes($userID, $campaign_type = '', $id = 0) {
        $aData = array();
        $this->db->select("tbl_automations_emails_campaigns.*, tbl_automations_emails.id as broadcast_id, tbl_automations_emails.user_id, tbl_automations_emails.title, tbl_automations_emails.description, tbl_automations_emails.email_type, tbl_automations_emails.status as bc_status, tbl_automations_emails.created, tbl_automations_emails.sending_method, tbl_automations_emails_events.event_type, tbl_automations_emails_events.data");
        if ($userID > 0) {
            $this->db->where('tbl_automations_emails.user_id', $userID);
        }
        $this->db->order_by('tbl_automations_emails.id', 'ASC');
        if ($id > 0) {
            $this->db->where('tbl_automations_emails.id', $id);
        }
        if (!empty($campaign_type)) {
            $this->db->where('tbl_automations_emails_campaigns.campaign_type', $campaign_type);
        }
        $this->db->where('tbl_automations_emails.deleted', '0');
        $this->db->where('tbl_automations_emails.email_type', 'broadcast');
        $this->db->join("tbl_automations_emails_events", "tbl_automations_emails_events.automation_id=tbl_automations_emails.id", "LEFT");
        $this->db->join("tbl_automations_emails_campaigns", "tbl_automations_emails_campaigns.event_id=tbl_automations_emails_events.id", "LEFT");

        $query = $this->db->get('tbl_automations_emails');
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    public function createBroadcast($aData) {
        $result = $this->db->insert("tbl_automations_emails", $aData);
        //echo $this->db->last_query(); exit;
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function createSplitTest($aData) {
        $result = $this->db->insert("tbl_broadcast_split_testing", $aData);
        //echo $this->db->last_query(); exit;
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function createSegment($aData) {
        $result = $this->db->insert("tbl_segments", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function isDuplicateSegment($segmentName, $userID = 0) {
        $this->db->where('segment_name', $segmentName);

        $this->db->where('user_id', $userID);

        $result = $this->db->get('tbl_segments');
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function isDuplicateBroadcastAudience($broadcastID, $subscriberID) {
        $this->db->where('broadcast_id', $broadcastID);

        $this->db->where('subscriber_id', $subscriberID);

        $result = $this->db->get('tbl_broadcast_users');
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

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

                $result = $this->db->query($sql);
                if ($result) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    public function getSegmentCoreSubscribers($seqmentID) {
        $this->db->where("segment_id", $seqmentID);
        $result = $this->db->get("tbl_segments_users");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getBroadcastInfo($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_automations_emails");
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function getBroadcastSubscribers($broadcastID) {
        $this->db->select("tbl_broadcast_users.id as local_user_id, tbl_subscribers.*, tbl_subscribers.id as subscriber_id, tbl_subscribers.status AS globalStatus, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_broadcast_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_broadcast_users.broadcast_id", $broadcastID);
        $this->db->order_by("tbl_broadcast_users.id", "DESC");
        $result = $this->db->get("tbl_broadcast_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function deleteAudienceToBraodcast($broadcastId, $subscriberID) {
        if ($broadcastId > 0) {
            $this->db->where("broadcast_id", $broadcastId);
            $this->db->where("subscriber_id", $subscriberID);
            $result = $this->db->delete("tbl_broadcast_users");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function deleteBraodcastContacts($broadcastId, $subscriberID) {
        if ($broadcastId > 0) {
            $this->db->where("automation_id", $broadcastId);
            $this->db->where("subscriber_id", $subscriberID);
            $result = $this->db->delete("tbl_automation_users");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function deleteAudienceById($id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            $result = $this->db->delete("tbl_broadcast_users");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function addBroadcastAudience($aData) {
        $this->db->insert("tbl_broadcast_users", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function getSegments($userID, $id = '') {
        $this->db->select("tbl_segments.*, tbl_automations_emails.title as campaign_title");
        $this->db->join("tbl_automations_emails", "tbl_segments.source_campaign_id = tbl_automations_emails.id", "LEFT");


        if (!empty($userID)) {
            $this->db->where('tbl_segments.user_id', $userID);
        }

        if (!empty($id)) {
            $this->db->where("tbl_segments.id", $id);
        }
        $result = $this->db->get("tbl_segments");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getSegmentSubscribers($segmentID, $userID) {
        $this->db->select("tbl_segments_users.*, tbl_subscribers.id as globalSubscriberId,tbl_subscribers.user_id as subUserId, tbl_subscribers.firstname,tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_subscribers.status");
        $this->db->join("tbl_subscribers", "tbl_segments_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->order_by("tbl_subscribers.id", "DESC");
        $this->db->where("tbl_segments_users.segment_id", $segmentID);
        $this->db->where("tbl_segments_users.user_id", $userID);

        $result = $this->db->get("tbl_segments_users");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getSegmentById($userID, $segmentId) {
        $this->db->select("tbl_segments.*, tbl_automations_emails.title as campaign_title");
        $this->db->join("tbl_automations_emails", "tbl_segments.source_campaign_id = tbl_automations_emails.id", "LEFT");


        if (!empty($userID)) {
            $this->db->where('tbl_segments.user_id', $userID);
        }
        if (!empty($segmentId)) {
            $this->db->where('tbl_segments.id', $segmentId);
        }
        $result = $this->db->get("tbl_segments");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function deleteSegmentByID($segmentID) {
        $this->db->where('id', $segmentID);
        $result = $this->db->delete('tbl_segments');
        return true;
    }

    public function deleteSegmentUser($userID) {
        $this->db->where('id', $userID);
        $result = $this->db->delete('tbl_segments_users');
        return true;
    }

    public function updateSegment($aData, $segmentId, $userID) {
        $response = array();
        $this->db->set($aData);
        $this->db->where('id', $segmentId);
        if (!empty($userID)) {
            $this->db->where('user_id', $userID);
        }
        $result = $this->db->update('tbl_segments');
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
            return false;
    }

    public function updateBroadcast($aData, $autoId) {
        $response = array();
        $this->db->set($aData);
        $this->db->where('id', $autoId);
        $result = $this->db->update('tbl_automations_emails');
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
            return false;
    }

    public function createBroadcastEvent($aData) {
        $result = $this->db->insert("tbl_automations_emails_events", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function createBroadcastCampaign($aData) {
        $result = $this->db->insert("tbl_automations_emails_campaigns", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function createBroadcastDefaultVariationCampaign($aData) {
        $result = $this->db->insert("tbl_broadcast_split_campaigns", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function updateAutomationScheduleDate($aData, $broadcastId) {
        $response = array();
        $this->db->set($aData);
        $this->db->where('automation_id', $broadcastId);
        $result = $this->db->update('tbl_automations_emails_events');
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
            return false;
    }

    public function updateBroadcastCampaignTemplate($aData, $campaignId) {
        $response = array();
        $this->db->set($aData);
        $this->db->where('id', $campaignId);
        $result = $this->db->update('tbl_automations_emails_campaigns');
        //echo $this->db->last_query(); exit;
        if ($result)
            return true;
        else
            return false;
    }

    public function updateBroadcastCampaign($aData, $eventId) {
        $response = array();
        $this->db->set($aData);
        $this->db->where('event_id', $eventId);
        $result = $this->db->update('tbl_automations_emails_campaigns');
        //echo $this->db->last_query(); exit;
        if ($result)
            return true;
        else
            return false;
    }

    public function updateBroadcastSettings($aData, $campaignId) {
        $response = array();
        $this->db->set($aData);
        $this->db->where('campaign_id', $campaignId);
        $result = $this->db->update('tbl_automations_emails_campaigns_settings');
        if ($result)
            return true;
        else
            return false;
    }

    public function getBroadcastSettings($campaignId) {
        $response = array();
        $this->db->where('campaign_id', $campaignId);
        $this->db->from('tbl_automations_emails_campaigns_settings');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getTwillioData($userID) {
        $response = array();
        $this->db->where('user_id', $userID);
        $this->db->from('tbl_twilio_accounts');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function checkBroadcastTitle($broadcastTitle, $userID) {
        $response = array();
        $this->db->where('user_id', $userID);
        $this->db->where('title', $broadcastTitle);
        $this->db->from('tbl_automations_emails');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = true;
        } else {
            $response = false;
        }
        return $response;
    }

    public function addBroadcastSettings($aData) {
        $result = $this->db->insert("tbl_automations_emails_campaigns_settings", $aData);
        //echo $this->db->last_query();

        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function getMyCampaignTemplate($userID = 0) {
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
            $this->db->or_where("user_id", 0);
        }
        $this->db->where("status", 1);
        $result = $this->db->get("tbl_automations_emails_campaigns_templates");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getMyLists($userID = '') {
        $this->db->select("tbl_common_lists.*, tbl_automation_users.list_id as l_list_id, tbl_automation_users.user_id as l_user_id, "
                . "tbl_subscribers.firstname as l_firstname, tbl_subscribers.lastname as l_lastname, "
                . "tbl_subscribers.email as l_email, tbl_subscribers.phone as l_phone,tbl_subscribers.created as l_created, tbl_automation_users.status as l_status, "
                . "CONCAT(tbl_users.firstname,' ', tbl_users.lastname) as lCreateUsername, tbl_users.email as cEmail, tbl_users.mobile as cMobile");

        if ($userID > 0) {
            $this->db->where("tbl_common_lists.user_id", $userID);
        }
        $this->db->join("tbl_automation_users", "tbl_automation_users.list_id=tbl_common_lists.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->join("tbl_users", "tbl_users.id=tbl_common_lists.user_id", "INNER");
        //$this->db->where("tbl_automation_users.status", 1);
        $this->db->where("tbl_common_lists.delete_status", 0);
        $this->db->where("tbl_common_lists.status", 'active');
        $this->db->order_by("tbl_common_lists.id", "DESC");
        $result = $this->db->get("tbl_common_lists");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

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
        //write your own query
        $sql = "SELECT tbl_automation_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.email as subscriber_email, tbl_subscribers.phone FROM tbl_automation_users "
                . "LEFT JOIN tbl_subscribers ON tbl_automation_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_automation_users.list_id IN (" . implode(",", $aListsIDs) . ") "
                //. "AND tbl_automation_users.status = '1' "
                . "AND tbl_subscribers.status = '1' ";

        $sql = "SELECT `tbl_automation_users`.*, `tbl_subscribers`.`email`,  `tbl_subscribers`.`email` as subscriber_email, `tbl_subscribers`.`firstname`, `tbl_subscribers`.`lastname`, `tbl_subscribers`.`phone`, `tbl_subscribers`.`status` AS `globalStatus` "
                . "FROM `tbl_automation_users` LEFT JOIN "
                . "`tbl_subscribers` ON `tbl_automation_users`.`subscriber_id`= `tbl_subscribers`.`id` "
                . "WHERE `tbl_automation_users`.`list_id` IN(" . implode(",", $aListsIDs) . ") "
                . "ORDER BY `tbl_automation_users`.`id` DESC";
        $result = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

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
        $sql = "SELECT tbl_automation_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.email as subscriber_email, tbl_subscribers.phone FROM tbl_automation_users "
                . "LEFT JOIN tbl_subscribers ON tbl_automation_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_automation_users.list_id IN (" . implode(",", $aListsIDs) . ") "
                //. "AND tbl_automation_users.status = '1' "
                . "AND tbl_subscribers.status = '1' ";

        $sql = "SELECT `tbl_automation_users`.*, `tbl_subscribers`.`email`,  `tbl_subscribers`.`email` as subscriber_email, `tbl_subscribers`.`firstname`, `tbl_subscribers`.`lastname`, `tbl_subscribers`.`phone`, `tbl_subscribers`.`status` AS `globalStatus` "
                . "FROM `tbl_automation_users` LEFT JOIN "
                . "`tbl_subscribers` ON `tbl_automation_users`.`subscriber_id`= `tbl_subscribers`.`id` "
                . "WHERE `tbl_automation_users`.`list_id` IN(" . implode(",", $aListsIDs) . ") "
                . "ORDER BY `tbl_automation_users`.`id` DESC";
        $result = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAutomationLists($automationID) {
        $this->db->where("automation_id", $automationID);
        $result = $this->db->get('tbl_automations_emails_lists');
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAutomationExcludedLists($automationID) {
        $this->db->where("automation_id", $automationID);
        $result = $this->db->get('tbl_automations_emails_lists_excluded');
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getBroadcastContacts($automationID) {
        $this->db->where('automation_id', $automationID);
        $result = $this->db->get("tbl_automation_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getBroadcastExcludedContacts($automationID) {
        $this->db->where('automation_id', $automationID);
        $result = $this->db->get("tbl_automation_users_excluded");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addContactToCampaign($aData) {
        $this->db->insert("tbl_automation_users", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addContactToExcludeCampaign($aData) {
        $this->db->insert("tbl_automation_users_excluded", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function deleteContactToCampaign($automationID, $subscriberID) {
        if ($automationID > 0) {
            $this->db->where("automation_id", $automationID);
            $this->db->where("subscriber_id", $subscriberID);
            $result = $this->db->delete("tbl_automation_users");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function deleteContactToExcludeCampaign($automationID, $subscriberID) {
        if ($automationID > 0) {
            $this->db->where("automation_id", $automationID);
            $this->db->where("subscriber_id", $subscriberID);
            $result = $this->db->delete("tbl_automation_users_excluded");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function getBroadcastTags($automationID) {
        $this->db->where('automation_id', $automationID);
        $result = $this->db->get("tbl_automations_emails_campaigns_tags");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getBroadcastExcludedTags($automationID) {
        $this->db->where('automation_id', $automationID);
        $result = $this->db->get("tbl_automations_emails_campaigns_tags_excluded");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getBroadcastSegments($automationID) {
        $this->db->select("tbl_automations_emails_campaigns_segments_new.*, tbl_segments.segment_name");
        $this->db->join("tbl_segments", "tbl_automations_emails_campaigns_segments_new.segment_id=tbl_segments.id", "LEFT");
        $this->db->where('tbl_automations_emails_campaigns_segments_new.automation_id', $automationID);
        $result = $this->db->get("tbl_automations_emails_campaigns_segments_new");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getBroadcastExcludedSegments($automationID) {
        $this->db->select("tbl_automations_emails_campaigns_segments_excluded.*, tbl_segments.segment_name");
        $this->db->join("tbl_segments", "tbl_automations_emails_campaigns_segments_excluded.segment_id=tbl_segments.id", "LEFT");
        $this->db->where('tbl_automations_emails_campaigns_segments_excluded.automation_id', $automationID);
        $result = $this->db->get("tbl_automations_emails_campaigns_segments_excluded");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addTagToCampaign($aData) {
        $this->db->insert("tbl_automations_emails_campaigns_tags", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addExcludedTagToCampaign($aData) {
        $this->db->insert("tbl_automations_emails_campaigns_tags_excluded", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addSegmentToCampaign($aData) {
        $this->db->insert("tbl_automations_emails_campaigns_segments_new", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addExcludedSegmentToCampaign($aData) {
        $this->db->insert("tbl_automations_emails_campaigns_segments_excluded", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function deleteSegmentToCampaign($automationID, $segmentID) {
        if ($automationID > 0) {
            $this->db->where("automation_id", $automationID);
            $this->db->where("segment_id", $segmentID);
            $result = $this->db->delete("tbl_automations_emails_campaigns_segments_new");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function deleteExcludedSegmentToCampaign($automationID, $segmentID) {
        if ($automationID > 0) {
            $this->db->where("automation_id", $automationID);
            $this->db->where("segment_id", $segmentID);
            $result = $this->db->delete("tbl_automations_emails_campaigns_segments_excluded");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function deleteTagToCampaign($automationID, $tagID) {
        if ($automationID > 0) {
            $this->db->where("automation_id", $automationID);
            $this->db->where("tag_id", $tagID);
            $result = $this->db->delete("tbl_automations_emails_campaigns_tags");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function deleteExcludedTagToCampaign($automationID, $tagID) {
        if ($automationID > 0) {
            $this->db->where("automation_id", $automationID);
            $this->db->where("tag_id", $tagID);
            $result = $this->db->delete("tbl_automations_emails_campaigns_tags_excluded");
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function getMyBroadcastSubscribers($eventId, $eventType) {
        $this->db->select("tbl_broadcast_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone,tbl_broadcast_emails_tracking_sendgrid.id as tracking_id,  tbl_broadcast_emails_tracking_sendgrid.event_name, tbl_broadcast_emails_tracking_sendgrid.email as e_email, tbl_broadcast_emails_tracking_sendgrid.created as e_created ");

        $this->db->join("tbl_broadcast_users", "tbl_broadcast_users.id=tbl_broadcast_emails_tracking_sendgrid.subscriber_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_broadcast_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_broadcast_emails_tracking_sendgrid.event_id", $eventId);
        $this->db->where("tbl_broadcast_emails_tracking_sendgrid.event_name", $eventType);
        $this->db->group_by("tbl_broadcast_emails_tracking_sendgrid.subscriber_id");
        $result = $this->db->get("tbl_broadcast_emails_tracking_sendgrid");
        //echo $this->db->last_query(); exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getMyBroadcastSubscribersSMS($eventId, $eventType) {
        $this->db->select("tbl_broadcast_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_broadcast_emails_tracking_twillio.event_name, tbl_broadcast_emails_tracking_twillio.to_number as e_number, tbl_broadcast_emails_tracking_twillio.created as e_created ");

        $this->db->join("tbl_broadcast_users", "tbl_broadcast_users.id=tbl_broadcast_emails_tracking_twillio.subscriber_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_broadcast_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_broadcast_emails_tracking_twillio.event_id", $eventId);
        $this->db->where("tbl_broadcast_emails_tracking_twillio.event_name", $eventType);
        $this->db->group_by("tbl_broadcast_emails_tracking_twillio.subscriber_id");
        $result = $this->db->get("tbl_broadcast_emails_tracking_twillio");
        //echo $this->db->last_query(); exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getMyBroadcastSubscribers_old($eventId, $eventType) {
        $this->db->select("tbl_automation_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone,tbl_automations_emails_tracking_sendgrid.id as tracking_id,  tbl_automations_emails_tracking_sendgrid.event_name, tbl_automations_emails_tracking_sendgrid.email as e_email, tbl_automations_emails_tracking_sendgrid.created as e_created ");

        $this->db->join("tbl_automation_users", "tbl_automation_users.id=tbl_automations_emails_tracking_sendgrid.subscriber_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_automations_emails_tracking_sendgrid.event_id", $eventId);
        $this->db->where("tbl_automations_emails_tracking_sendgrid.event_name", $eventType);
        $this->db->group_by("tbl_automations_emails_tracking_sendgrid.subscriber_id");
        $result = $this->db->get("tbl_automations_emails_tracking_sendgrid");
        //echo $this->db->last_query(); exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getMyBroadcastSubscribersSMS_old($eventId, $eventType) {
        $this->db->select("tbl_automation_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_automations_emails_tracking_twillio.event_name, tbl_automations_emails_tracking_twillio.to_number as e_number, tbl_automations_emails_tracking_twillio.created as e_created ");

        $this->db->join("tbl_automation_users", "tbl_automation_users.id=tbl_automations_emails_tracking_twillio.subscriber_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_automations_emails_tracking_twillio.event_id", $eventId);
        $this->db->where("tbl_automations_emails_tracking_twillio.event_name", $eventType);
        $this->db->group_by("tbl_automations_emails_tracking_twillio.subscriber_id");
        $result = $this->db->get("tbl_automations_emails_tracking_twillio");
        //echo $this->db->last_query(); exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function deleteEmailRecordByID($recordID) {
        $this->db->where('id', $recordID);
        $result = $this->db->delete('tbl_automations_emails_tracking_sendgrid');
        //echo $this->db->last_query(); exit;
        return true;
    }

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

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

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

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getBroadcastTwilioCategorizedStatsData($oData) {
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

    public function getBroadcastSendgridCategorizedStatsData($oData) {

        if (!empty($oData)) {
            $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
            $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
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
