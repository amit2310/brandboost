<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ListsModel extends Model {

	/**
     * Get Lists
     * @param type $userID
     * @param type $listID
     * @param type $status
     * @return type object
     */
	public function getLists($userID = '', $listID = '', $status = 'all') {


		$oData = DB::table('tbl_common_lists')
            ->select('tbl_common_lists.*', 
            	'tbl_automation_users.list_id as l_list_id', 
            	'tbl_automation_users.user_id as l_user_id', 
            	'tbl_subscribers.firstname as l_firstname', 
            	'tbl_subscribers.lastname as l_lastname', 
            	'tbl_subscribers.email as l_email', 
            	'tbl_subscribers.phone as l_phone', 
            	'tbl_subscribers.created as l_created', 
            	'tbl_automation_users.status as l_status', 
            	'tbl_users.email as cEmail', 
            	'tbl_users.mobile as cMobile',
            	 DB::raw("CONCAT(tbl_users.firstname,' ',tbl_users.lastname) AS lCreateUsername")
            )
            ->when(($listID > 0), function ($query) use ($listID) {
                    return $query->where('tbl_common_lists.id', $listID);
                })  
            ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_common_lists.user_id', $userID);
                }) 
            ->when(($status != 'all'), function ($query) use ($status) {
                    return $query->where('tbl_common_lists.status', $status);
                })   
            ->leftJoin('tbl_automation_users', 'tbl_automation_users.list_id', '=' , 'tbl_common_lists.id')
            ->leftJoin('tbl_subscribers', 'tbl_automation_users.subscriber_id', '=' , 'tbl_subscribers.id')
            ->Join('tbl_users', 'tbl_users.id', '=' , 'tbl_common_lists.user_id')
            ->orderBy('tbl_common_lists.id', 'desc')
            ->where('tbl_common_lists.delete_status', 0)
            ->get();

        return $oData;
     
    }

	public function checkIfListExists($listName, $userID, $listID) {
        $this->db->where("user_id", $userID);
        $this->db->where("list_name", $listName);
        if ($listID != '') {
            $this->db->where_not_in("id", $listID);
        }
        $this->db->where("delete_status", 0);
        $result = $this->db->get('tbl_common_lists');
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function getAutomationLists($automationID) {
        $this->db->select("tbl_automations_emails_lists.*, tbl_common_lists.list_name");
        $this->db->join("tbl_common_lists", "tbl_common_lists.id=tbl_automations_emails_lists.list_id", "LEFT");
        $this->db->where("tbl_automations_emails_lists.automation_id", $automationID);
        $this->db->where("tbl_common_lists.delete_status", 0);
        $result = $this->db->get("tbl_automations_emails_lists");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }
    
    public function getAutomationExcludedLists($automationID) {
        $this->db->select("tbl_automations_emails_lists_excluded.*, tbl_common_lists.list_name");
        $this->db->join("tbl_common_lists", "tbl_common_lists.id=tbl_automations_emails_lists_excluded.list_id", "LEFT");
        $this->db->where("tbl_automations_emails_lists_excluded.automation_id", $automationID);
        $this->db->where("tbl_common_lists.delete_status", 0);
        $result = $this->db->get("tbl_automations_emails_lists_excluded");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addLists($aData) {
        $result = $this->db->insert("tbl_common_lists", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function updateLists($aData, $id, $userID = '') {
        $this->db->where("id", $id);
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
        }
        $result = $this->db->update("tbl_common_lists", $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteLists($id, $userID = '') {
        $this->db->where("id", $id);
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
        }
        $result = $this->db->update("tbl_common_lists", array('delete_status' => '1'));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function archiveLists($id, $userID = '') {
        $this->db->where("id", $id);
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
        }
        $result = $this->db->update("tbl_common_lists", array('status' => 'archive'));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateListStatus($id, $userID = '', $status) {
        $this->db->where("id", $id);
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
        }
        $result = $this->db->update("tbl_common_lists", array('status' => $status));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function addListSubscriber($aData) {
        $listID = $aData['list_id'];
        $subscriberID = $aData['subscriber_id'];
        $bAddNewEntry = false;

        if (!empty($subscriberID) && !empty($listID)) {
            $bAlreadyExists = $this->checkIfExistingSubscriberInList($listID, $subscriberID);
            if ($bAlreadyExists == false) {
                $bAddNewEntry = true;
            }else{
                return true;
            }
        } else {
            $bAddNewEntry = true;
        }

        if ($bAddNewEntry == true) {
            $result = $this->db->insert('tbl_automation_users', $aData);
            $inset_id = $this->db->insert_id();
            if ($result)
                return $inset_id;
        }
       return false;
    }

    public function checkIfExistingSubscriberInList($listID, $subscriberID) {
        $this->db->where("list_id", $listID);
        $this->db->where("subscriber_id", $subscriberID);
        $result = $this->db->get("tbl_automation_users");
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function updateListSubscriber($subscriberId, $status) {
        $this->db->where("id", $subscriberId);
        $result = $this->db->update("tbl_automation_users", array('status' => $status));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteListSubscriber($subscriberId) {
        $this->db->where("id", $subscriberId);
        $result = $this->db->delete("tbl_automation_users");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getContactDetail($subscriberID = '') {
        $this->db->select("tbl_automation_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone");
        $this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_automation_users.id", $subscriberID);
        $result = $this->db->get("tbl_automation_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateListSubscriberDetail($aData, $subscriberId) {

        $this->db->where('id', $subscriberId);
        $result = $this->db->update('tbl_automation_users', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function getListContacts($userID, $listID = '') {
        $this->db->select("tbl_automation_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, "
                . "tbl_common_lists.user_id AS clientID, tbl_common_lists.list_name");
        $this->db->join("tbl_common_lists", "tbl_common_lists.id=tbl_automation_users.list_id", "INNER");
        $this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");

        if ($listID > 0) {
            $this->db->where("tbl_automation_users.list_id", $listID);
        }
        if ($userID > 0) {
            $this->db->where("tbl_common_lists.user_id", $userID);
        }
        $result = $this->db->get("tbl_automation_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAllSubscribers($userID, $listId) {
        $response = array();
        $this->db->where('user_id', $userID);
        $this->db->where('brandboost_id', $listId);
        $this->db->order_by('id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAllSubscribersList($listId) {
        $response = array();
        $this->db->where('brandboost_id', $listId);
        $this->db->order_by('id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        //echo $this->db->last_query();exit;
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getSubscribers($userID, $listId) {
        $response = array();
        $this->db->select('email,firstname,lastname,phone');
        //$this->db->where('user_id', $userID);
        $this->db->where('brandboost_id', $listId);
        $this->db->order_by('id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result_array();
        }
        return $response;
    }

    public function addSubscriber($aData) {
        $result = $this->db->insert('tbl_brandboost_users', $aData);
        $inset_id = $this->db->insert_id();
        if ($result)
            return $inset_id;
        else
            return false;
    }

    public function getSubscriber($id = '') {

        $response = array();
        if ($id > 0) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id', 'DESC');
        }
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateSubscriber($aData, $subscriberId) {

        $this->db->where('id', $subscriberId);
        $result = $this->db->update('tbl_brandboost_users', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteSubscriber($subscriberId) {
        $this->db->where('id', $subscriberId);
        $result = $this->db->delete('tbl_brandboost_users');
        return true;
    }

    public function getSubscriberList($subscriberID) {
        $this->db->select("tbl_common_lists.list_name, tbl_common_lists.id");
        $this->db->join("tbl_common_lists", "tbl_common_lists.id=tbl_automation_users.list_id", "INNER");
        //$this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");

        if ($subscriberID > 0) {
            $this->db->where("tbl_automation_users.subscriber_id", $subscriberID);
        }
       
        $result = $this->db->get("tbl_automation_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

}