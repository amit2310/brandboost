<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class FeedbackModel extends Model
{
	/**
	* Used to get campaign feedback response data
	* @param type $campaignID
	* @return type
	*/
	public static function getFeedbackResponse($campaignID) {
		$oData = DB::table('tbl_feedback_response')
			->where('brandboost_id', $campaignID)    
			->orderBy('id', 'asc')
			->first();
		return $oData;
    }
	
	/**
	* Used to get campaign feedback data by brandboost id
	* @param type $brandboostID
	* @return type
	*/
	public static function getCampFeedback($brandboostID) {
		$oData = DB::table('tbl_brandboost_feedback')
			->where('brandboost_id', $brandboostID)    
			->orderBy('id', 'desc')
			->get();
		return $oData;
    }
	
	/**
	* Used to get campaign feedback data by brandboost id
	* @param type $brandboostID
	* @return type
	*/
	public static function getCampFeedbackData($brandboostID) {
		$oData = DB::table('tbl_brandboost_feedback')
			->where('brandboost_id', $brandboostID)    
			->where('type', 'offsite')
			->first();
		return $oData;
    }
	
	/**
	* Used to get subscriber info by subscriber id
	* @param type $id
	* @return type
	*/
	public static function getSubscriberInfo($id) {
		$oData = DB::table('tbl_brandboost_users')
			->select('tbl_subscribers.*')
			->where('tbl_brandboost_users.id', $id)
			->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id', '=' , 'tbl_subscribers.id')
			->first();
		return $oData;
    }
	
	/**
	* Used to get feedback  by user id
	* @param type $id
	* @return type
	*/
	public static function getFeedback($userID, $user_role='') {
       
		$oData = DB::table('tbl_brandboost_feedback')
			->select('tbl_brandboost_feedback.*', 'tbl_users.avatar', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc', 'tbl_brandboost.brand_img', 'tbl_brandboost_users.subscriber_id as subscriber_id')
			->when(($user_role > 1), function($query) use ($userID) {
				return $query->where('tbl_brandboost_feedback.client_id', $userID);
			})
			->leftJoin('tbl_brandboost_users', 'tbl_brandboost_users.id', '=' , 'tbl_brandboost_feedback.subscriber_id')
			->leftJoin('tbl_users', 'tbl_users.id', '=' , 'tbl_brandboost_users.user_id')
			->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id', '=' , 'tbl_subscribers.id')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=' , 'tbl_brandboost_feedback.brandboost_id')
			->get();
		return $oData;
    }
	
	/**
	* Used to get feedback by brandboost id
	* @param type $brandboostID
	* @return type
	*/
	public static function getFeedbackByBrandboostID($brandboostID) {
        $oData = DB::table('tbl_brandboost_feedback')
			->select('tbl_brandboost_feedback.*', 'tbl_users.avatar', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_img')
			->where('tbl_brandboost_feedback.brandboost_id', 'offsite')
			->leftJoin('tbl_brandboost_users', 'tbl_brandboost_users.id', '=' , 'tbl_brandboost_feedback.subscriber_id')
			->leftJoin('tbl_users', 'tbl_users.id', '=' , 'tbl_brandboost_users.user_id')
			->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id', '=' , 'tbl_subscribers.id')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=' , 'tbl_brandboost_feedback.brandboost_id')
			->where('tbl_brandboost_feedback.brandboost_id', $brandboostID)
			->get();
		return $oData;
		
    }
	
	/**
	* Used to get feedback details by feedback id
	* @param type $id
	* @return type
	*/
	public static function getFeedbackInfo($id) {
		$oData = DB::table('tbl_brandboost_feedback')
			->select('tbl_brandboost.brand_title', 'tbl_brandboost.user_id AS ownerID', 'tbl_brandboost_feedback.*', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone')
			->where('tbl_brandboost_feedback.id', $id)
			->leftJoin('tbl_brandboost_users', 'tbl_brandboost_users.id', '=' , 'tbl_brandboost_feedback.subscriber_id')
			->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id', '=' , 'tbl_subscribers.id')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=' , 'tbl_brandboost_feedback.brandboost_id')
			->first();
		return $oData;
		
    }
	
	/**
	* Used to get feedback notes data by feedback id
	* @param type $id
	* @return type
	*/
	public static function listFeedbackNotes($id) {
		$oData = DB::table('tbl_brandboost_feedback_notes')
			->select('tbl_brandboost_feedback_notes.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email')
			->where('tbl_brandboost_feedback_notes.feedback_id', $id)
			->leftJoin('tbl_users', 'tbl_users.id', '=' , 'tbl_brandboost_feedback_notes.client_id')
			->orderBy('tbl_brandboost_feedback_notes.id', 'desc')
			->get();
		return $oData;
    }

	/**
	* Used to get feedback all parent comments by feedback Id
	* @param type $feedbackID
	* @return type
	*/
	public static function getFeedbackParentsComments($feedbackID) {
		$oData = DB::table('tbl_brandboost_feedback_comments')
			->select('tbl_brandboost_feedback_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.id as userId')
			->where('tbl_brandboost_feedback_comments.feedback_id', $feedbackID)
			->where('tbl_brandboost_feedback_comments.parent_comment_id', 0)
			->leftJoin('tbl_brandboost_feedback', 'tbl_brandboost_feedback_comments.feedback_id', '=' , 'tbl_brandboost_feedback.id')
			->leftJoin('tbl_users', 'tbl_users.id', '=' , 'tbl_brandboost_feedback_comments.user_id')
			->orderBy('tbl_brandboost_feedback_comments.id', 'desc')
			->get();
		return $oData;
    }

	/**
	* Used to get feedback all parent comments by feedback Id
	* @param type $feedbackID
	* @return type
	*/
	public static function updateFeedbackStatus($aData, $id) {
		$result = DB::table('tbl_brandboost_feedback')
           ->where('id', $id)
           ->update($aData);
        if ($result > -1)
            return true;
        else
            return false;
    }











   public function add($aData) {
        $result = $this->db->insert('tbl_brandboost_feedback', $aData);
        $inset_id = $this->db->insert_id();
        //$last_query = $this->db->last_query();
        //pre($last_query);
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }
    
    
    public function getMyFeedback($userID) {
        $response = array();
        $this->db->select('tbl_brandboost_feedback.*, tbl_users.avatar, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile AS phone, '
                . 'tbl_brandboost.brand_title, tbl_brandboost.brand_img, tbl_brandboost_users.subscriber_id as subscriber_id');
        $this->db->from('tbl_brandboost_feedback');
        $this->db->where("tbl_users.id", $userID);
        $this->db->where("tbl_brandboost.brand_title !=", "");
        $this->db->join('tbl_brandboost_users', 'tbl_brandboost_users.id = tbl_brandboost_feedback.subscriber_id', 'LEFT');
        $this->db->join('tbl_users', 'tbl_users.id = tbl_brandboost_users.user_id', 'LEFT');
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->join('tbl_brandboost', 'tbl_brandboost.id = tbl_brandboost_feedback.brandboost_id', 'LEFT');
        $this->db->order_by('tbl_brandboost_feedback.id', 'DESC');
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }
   

    public function saveFeedbackLog($aData) {
        if (!empty($aData)) {
            $this->db->insert("tbl_feedback_response_log", $aData);
        }
    }

    public function getUserInfoBySubscriberID($subsID) {

        $this->db->select("tbl_subscribers.firstname AS fname, tbl_subscribers.lastname AS lname, tbl_subscribers.email AS semail, tbl_subscribers.phone AS sphone, tbl_users.*");

        $this->db->join("tbl_users", "tbl_brandboost_users.user_id = tbl_users.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_brandboost_users.id", $subsID);
        $result = $this->db->get("tbl_brandboost_users");
        //echo $this->db->last_query();
        //die;
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getThread($clientID, $subsID = 0, $brandboostID = 0) {
        $this->db->select("COUNT(tbl_brandboost_feedback.id) as total_messages, tbl_brandboost_feedback.*, tbl_subscribers.firstname AS fname, tbl_subscribers.lastname AS lname, tbl_subscribers.email AS semail, tbl_subscribers.phone AS sphone");

        $this->db->join("tbl_brandboost_users", "tbl_brandboost_feedback.subscriber_id=tbl_brandboost_users.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id=tbl_subscribers.id", "LEFT");

        $this->db->where("tbl_brandboost_feedback.client_id", $clientID);
        if ($subsID > 0) {
            $this->db->where("tbl_brandboost_feedback.subscriber_id", $subsID);
        }
        if ($brandboostID > 0) {
            $this->db->where("tbl_brandboost_feedback.brandboost_id", $brandboostID);
        }
        $this->db->where("tbl_brandboost_feedback.status", 1);
        $this->db->group_by("tbl_brandboost_feedback.brandboost_id, tbl_brandboost_feedback.client_id, tbl_brandboost_feedback.subscriber_id");
        $this->db->order_by("tbl_brandboost_feedback.id", "DESC");
        $result = $this->db->get("tbl_brandboost_feedback");
        //echo $this->db->last_query();
        //die;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getThreadDetails($clientID, $subsID, $brandboostID) {
        $this->db->select("tbl_users.firstname AS client_fname, tbl_users.lastname AS client_lname, tbl_users.email AS client_email, tbl_brandboost_feedback.*, tbl_subscribers.firstname AS fname, tbl_subscribers.lastname AS lname, tbl_subscribers.email AS semail, tbl_subscribers.phone AS sphone");

        $this->db->join("tbl_brandboost_users", "tbl_brandboost_feedback.subscriber_id=tbl_brandboost_users.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->join("tbl_users", "tbl_brandboost_feedback.client_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_brandboost_feedback.client_id", $clientID);
        $this->db->where("tbl_brandboost_feedback.subscriber_id", $subsID);
        $this->db->where("tbl_brandboost_feedback.brandboost_id", $brandboostID);
        $this->db->order_by("tbl_brandboost_feedback.id", "DESC");
        $result = $this->db->get("tbl_brandboost_feedback");
        //echo $this->db->last_query();
        //die;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function saveThreadReply($aData) {
        $bInserted = $this->db->insert("tbl_brandboost_feedback", $aData);
        if ($bInserted)
            return true;
        else
            return false;
    }

    public function deleteFeedbackRecord($id) {
        if(!empty($id)) {
            $this->db->where('id', $id);
            $result = $this->db->delete('tbl_brandboost_feedback');
            //echo $this->db->last_query();
            if ($result)
                return true;
            else
                return false;
        }
    }

    public function deleteFeedbackData($aData, $id) {
        $this->db->set($aData);
        $this->db->where('id', $id);
        $result = $this->db->update('tbl_brandboost_feedback');
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
            return false;
    }

    
    
    /**
    * This function will return feedback notes details
    * @param type $noteId
    * @return type
    */

    public function getFeedbackNoteInfo($noteId) {

       $oData = DB::table('tbl_brandboost_feedback_notes')
        ->where('id', $noteId)->get();
        return $oData;
       
    }
    
    /**
    * This function is used to update the notes
    * @param type
    * @return type
    */

    public function updateFeedbackNote($aData, $noteId) {

        $result = DB::table('tbl_brandboost_feedback_notes')
         ->where('id', $noteId)
          ->update($aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function saveFeedbackNotes($aData) {
        $bInserted = DB::table('tbl_brandboost_feedback_notes')->insertGetId($aData);
        if ($bInserted)
            return true;
        else
            return false;
    }
    

    public function getBrandboostInfo($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_brandboost");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }
    

     /**
    * This function is used to delete the feedback notes 
    * @param $noteid
    * @return type
    */

    public function deleteFeedbackNote($noteId) {

        $result = DB::table('tbl_brandboost_feedback_notes')
         ->where('id', $noteId)->delete();
         return $result;
        
    }
    
    
    public function addFeedbackComment($aData) {

        $result = $this->db->insert('tbl_brandboost_feedback_comments', $aData);
		//echo $this->db->last_query();exit;
        if ($result)
            return true;
        else
            return false;
    }
    
    
    
    
    public function deleteFeedbackComment($commentID) {
        $this->db->where('id', $commentID);
        $result = $this->db->delete('tbl_brandboost_feedback_comments');
        return true;
    }
    
    public function getBrandboostFeedback($brandboostID){
        $this->db->select("tbl_brandboost_feedback.*, tbl_subscribers.id AS subscriberId");
        $this->db->join("tbl_brandboost_users", "tbl_brandboost_feedback.subscriber_id=tbl_brandboost_users.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_brandboost_feedback.brandboost_id", $brandboostID);
        $this->db->where("tbl_brandboost_feedback.type", 'offsite');
        //$this->db->group_by("tbl_brandboost_feedback.subscriber_id", "DESC");
        $this->db->order_by("tbl_brandboost_feedback.id", "DESC");
        $result = $this->db->get("tbl_brandboost_feedback");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }
}
