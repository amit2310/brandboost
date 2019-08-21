<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ReviewlistsModel extends Model {
	
	/**
	* Used to update subscriber by subscriber Id
	* @param type $subscriberId
	* @return type
	*/
	public static function updateSubscriber($aData, $subscriberId) {
		$result = DB::table('tbl_brandboost_users')
           ->where('id', $subscriberId)
           ->update($aData);
		   
        if ($result > -1)
            return true;
        else
            return false;
    }


    public function getAllSubscribers($userID, $brandboostID) {
        $response = array();
        $this->db->select('tbl_brandboost_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_subscribers.facebook_profile, tbl_subscribers.twitter_profile, tbl_subscribers.linkedin_profile,tbl_subscribers.instagram_profile, tbl_subscribers.socialProfile, tbl_subscribers.id AS global_user_id');
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id= tbl_subscribers.id", "LEFT");
        $this->db->where('tbl_brandboost_users.user_id', $userID);
        $this->db->where('tbl_brandboost_users.brandboost_id', $brandboostID);
        $this->db->order_by('tbl_brandboost_users.id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAllSubscribersList($brandboostID) {
        $response = array();
        $this->db->select('tbl_brandboost_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_subscribers.created as s_created, tbl_subscribers.status AS globalStatus, tbl_subscribers.facebook_profile, tbl_subscribers.twitter_profile, tbl_subscribers.linkedin_profile,tbl_subscribers.instagram_profile, tbl_subscribers.socialProfile, tbl_subscribers.id AS global_user_id');
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id= tbl_subscribers.id", "LEFT");
        $this->db->where('tbl_brandboost_users.brandboost_id', $brandboostID);
        $this->db->order_by('tbl_brandboost_users.id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        //echo $this->db->last_query();exit;
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }


     /**
    * This function will return the subscriber list by user id
    * @param type $userID
    * @return type
    */

    public function getSubscribersListUser($userID) {
        $oData = DB::table('tbl_brandboost_users')
        ->select('tbl_brandboost_users.*', 'tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone')
        ->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id','=','tbl_subscribers.id')
        ->where('tbl_brandboost_users.id', $userID)
        ->orderBy('tbl_brandboost_users.id', 'DESC')->get();
        
        return $oData;
    }


    /**
    * This function will return the subscribers
    * @param type $userID
    * @return type
    */

    public function getSubscribers($userID, $brandboostID) {
        $aData =  DB::table('tbl_brandboost_users')
        ->select('tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone')
        ->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id','=','tbl_subscribers.id')
        ->where('tbl_brandboost_users.brandboost_id', $brandboostID)
        ->orderBy('tbl_brandboost_users.id', 'DESC')->get();
        return $aData;
    }

    public function addSubscriber($aData) {
        $brandboostID = $aData['brandboost_id'];
        $subscriberID = $aData['subscriber_id'];
        $bAddNewEntry = false;

        if (!empty($subscriberID) && !empty($brandboostID)) {
            $bAlreadyExists = $this->checkIfExistingSubscriberInBrandboostUsers($brandboostID, $subscriberID);
            if ($bAlreadyExists == false) {
                $bAddNewEntry = true;
            } else {
                return true;
            }
        } else {
            $bAddNewEntry = true;
        }

        if ($bAddNewEntry == true) {
            $result = $this->db->insert('tbl_brandboost_users', $aData);
            $inset_id = $this->db->insert_id();
            if ($result)
                return $inset_id;
        }
         return false;
    }

    public function checkIfExistingSubscriberInBrandboostUsers($brandboostID, $subscriberID) {
        $this->db->where("brandboost_id", $brandboostID);
        $this->db->where("subscriber_id", $subscriberID);
        $result = $this->db->get("tbl_brandboost_users");
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }


    /**
    * This function will return the subscriber details
    * @param type $userID
    * @return type
    */


    public function getSubscriber($id = '') {

            $aData =  DB::table('tbl_brandboost_users')
            ->select('tbl_brandboost_users.*', 'tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname'
                , 'tbl_subscribers.phone')
            ->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id','=','tbl_subscribers.id')
            ->when($id > 0, function($query) use ($id){
            return $query->where('tbl_brandboost_users.id', $id);
            })->get();
           
        return $aData ;
    }

    
    public function deleteSubscriber($subscriberId) {
        $this->db->where('id', $subscriberId);
        $result = $this->db->delete('tbl_brandboost_users');
        return true;
    }

}
