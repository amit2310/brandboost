<?php

namespace App\Models\Admin\Modules;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ReferralModel extends Model {

    /**
     * Get Member's list of all widgets
     * @param type $userID
     * @param type $id
     * @return type
     */
    public static function getReferralWidgets($userID, $id = '') {
        $oWidgets = DB::table('tbl_referral_widgets')
                ->where('user_id', $userID)
                ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->get();
        
        return $oWidgets;
    }

    /**
     * Get Referral data by userId
     * @param type $userID
     * @return type object
     */
    public function getReferralDataBySId($userId) {

        $oData = DB::table('tbl_referral_users')
            ->select('tbl_referral_users.*', 'tbl_referral_rewards.title', 'tbl_referral_rewards.source_type', 'tbl_subscribers.user_id', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email')  
            ->Join('tbl_referral_rewards', 'tbl_referral_users.account_id', '=' , 'tbl_referral_rewards.hashcode') 
            ->leftJoin('tbl_referral_reflinks', 'tbl_referral_reflinks.advocate_id', '=' , 'tbl_referral_users.id')    
            ->leftJoin('tbl_subscribers', 'tbl_subscribers.id', '=' , 'tbl_referral_users.subscriber_id')
            ->where("tbl_subscribers.user_id", $userId)
            ->get();

        return $oData;

    }

	/**
     * Used to get referral all data by user id
     * @param type $userID
     * @return type
     */
    public static function getReferralLists($userID) {
        $aData =  DB::table('tbl_referral_rewards')
			->select('tbl_referral_rewards.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile')
			->leftjoin('tbl_users', 'tbl_referral_rewards.user_id','=','tbl_users.id')
			->where('tbl_referral_rewards.user_id', $userID)
			->get();
        
        return $aData;
    }
	
	/**
     * Used to get referral total sale by user id
     * @param type $userID
     * @return type
     */
	public static function referredTotalSalesByUserId($userId) {
		$aData =  DB::table('tbl_referral_sales')
			->select('tbl_referral_sales.*')
			->leftjoin('tbl_referral_users', 'tbl_referral_sales.affiliateid','=','tbl_referral_users.id')
			->where('tbl_referral_users.user_id', $userId)
			->where('tbl_referral_sales.affiliateid', '!=', NULL)
			->orderBy('tbl_referral_sales.id', 'desc')
			->get();
        
        return $aData;
    }
	
	/**
     * Used to get referral total visits by user id
     * @param type $userId
     * @return type
     */
	public static function referredTotalVisitsByUserId($userId) {
		$aData =  DB::table('tbl_referral_reflinks_visit_logs')
			->select('tbl_referral_reflinks_visit_logs.*')
			->leftjoin('tbl_referral_reflinks', 'tbl_referral_reflinks.refkey','=','tbl_referral_reflinks_visit_logs.refkey')
			->leftjoin('tbl_referral_rewards', 'tbl_referral_rewards.id','=','tbl_referral_reflinks.referral_id')
			->where('tbl_referral_rewards.user_id', $userId)
			->get();
        
        return $aData;
    }
	
	/**
     * Used to get total sent email by user id
     * @param type $userId
     * @return type
     */
	public static function getStatsTotalSentByUserId($userId) {
        $sql = "SELECT COUNT(tbl_referral_automations_tracking_logs.id) AS totalCount, tbl_referral_automations_tracking_logs.`campaign_type` "
                . "FROM tbl_referral_automations_tracking_logs "
                . "WHERE tbl_referral_automations_tracking_logs.campaign_id "
                . "IN(SELECT tbl_referral_automations_campaigns.id FROM tbl_referral_automations_campaigns "
                . "INNER JOIN tbl_referral_automations_events ON tbl_referral_automations_events.id=tbl_referral_automations_campaigns.event_id "
                . "LEFT JOIN tbl_referral_rewards ON tbl_referral_rewards.id = tbl_referral_automations_events.referral_id "
                . "WHERE tbl_referral_rewards.user_id='$userId') "
                . "GROUP BY tbl_referral_automations_tracking_logs.campaign_type";
		
		$oData = DB::select(DB::raw($sql));
        return $oData;
    }
	
	/**
     * Used to get total click by user id
     * @param type $userId
     * @return type
     */
	public static function getStatsTotalClickByUserId($userId) {
        $sql = "SELECT COUNT(tbl_referral_automations_tracking_logs_click.id) AS totalCount "
                . "FROM tbl_referral_automations_tracking_logs_click "
                . "WHERE tbl_referral_automations_tracking_logs_click.referral_id "
                . "IN(SELECT tbl_referral_automations_campaigns.id FROM tbl_referral_automations_campaigns "
                . "INNER JOIN tbl_referral_automations_events ON tbl_referral_automations_events.id=tbl_referral_automations_campaigns.event_id "
                . "LEFT JOIN tbl_referral_rewards ON tbl_referral_rewards.id = tbl_referral_automations_events.referral_id "
                . "WHERE tbl_referral_rewards.user_id='$userId') ";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }
	
	/**
     * Used to get advocate data by user id
     * @param type $userId
     * @return type
     */
	public static function getMyAdvocates($accountID = '') {
		$aData =  DB::table('tbl_referral_users')
			->select('tbl_referral_users.*', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_subscribers.status AS globalStatus', 'tbl_subscribers.facebook_profile', 'tbl_subscribers.twitter_profile', 'tbl_subscribers.linkedin_profile', 'tbl_subscribers.instagram_profile', 'tbl_subscribers.socialProfile', 'tbl_subscribers.id AS global_user_id')
			->leftjoin('tbl_subscribers', 'tbl_referral_users.subscriber_id','=','tbl_subscribers.id')
			->when((!empty($accountID)), function ($query) use ($accountID) {
				return $query->where('tbl_referral_users.account_id', $accountID);
			})
			->where('tbl_referral_users.subscriber_id', '!=', NULL)
			->get();
        
        return $aData;
    }
	
	/**
     * Used to get total sent by referralID id
     * @param type $referralID
     * @return type
     */
	public static function getStatsTotalSent($referralID) {
        $sql = "SELECT COUNT(tbl_referral_automations_tracking_logs.id) AS totalCount, tbl_referral_automations_tracking_logs.`campaign_type` "
                . "FROM tbl_referral_automations_tracking_logs "
                . "WHERE tbl_referral_automations_tracking_logs.campaign_id "
                . "IN(SELECT tbl_referral_automations_campaigns.id FROM tbl_referral_automations_campaigns "
                . "INNER JOIN tbl_referral_automations_events ON tbl_referral_automations_events.id=tbl_referral_automations_campaigns.event_id "
                . "WHERE tbl_referral_automations_events.referral_id='$referralID') "
                . "GROUP BY tbl_referral_automations_tracking_logs.campaign_type";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }
	
	/**
     * Used to get total twillio by referral id
     * @param type $referralID
     * @return type
     */
	public static function getStatsTotalTwillio($referralID) {
        $sql = "SELECT COUNT(tbl_referral_automations_tracking_sendgrid.id) AS totalCount, tbl_referral_automations_tracking_sendgrid.`event_name` "
                . "FROM tbl_referral_automations_tracking_sendgrid "
                . "LEFT JOIN tbl_referral_rewards ON tbl_referral_rewards.id=tbl_referral_automations_tracking_sendgrid.referral_id "
                . "WHERE tbl_referral_rewards.id='$referralID'"
                . "GROUP BY tbl_referral_automations_tracking_sendgrid.event_name";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }
	
	/**
     * Used to get total twillio by referral id
     * @param type $referralID
     * @return type
     */
	public static function getSendgridStats($referralID) {
        $sql = "SELECT COUNT(DISTINCT tbl_referral_automations_tracking_sendgrid.ip) AS totalCount, tbl_referral_automations_tracking_sendgrid.`event_name` "
                . "FROM tbl_referral_automations_tracking_sendgrid "
                . "LEFT JOIN tbl_referral_rewards ON tbl_referral_rewards.id=tbl_referral_automations_tracking_sendgrid.referral_id "
                . "WHERE tbl_referral_rewards.id='$referralID'"
                . "GROUP BY tbl_referral_automations_tracking_sendgrid.event_name, tbl_referral_automations_tracking_sendgrid.campaign_id";
		$oData = DB::select(DB::raw($sql));
        return $oData;
    }
	
	/**
     * Used to delete referral by id and user id
     * @param type $id
     * @param type $userID
     * @return type
     */
	public static function deleteReferral($userID, $id) {
		$result = DB::table('tbl_referral_rewards')
               ->where('user_id', $userID)
               ->where('id', $id)
               ->delete();
			 
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

	/**
     * Used to update referral by id and user id
     * @param type $id
     * @param type $userID
     * @return type
     */
    public static function updateReferral($aData, $userID, $id) {
		$result = DB::table('tbl_referral_rewards')
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
     * Used to update store settings by referral id
     * @param type $referralID
     * @return type
     */
	public function updateStoreSettings($aData, $referralID) {
        if ($referralID > 0) {
            $oSettings = $this->getAccountSettings($referralID);
            if (empty($oSettings)) {
				$result = DB::table('tbl_referral_settings')->insert($aData);
            } else {
				$result = DB::table('tbl_referral_settings')
				   ->where('referral_id', $referralID)
				   ->update($aData);
            }
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
	
	/**
     * Used to update store settings by referral id
     * @param type $referralID
     * @return type
     */
	public function getAccountSettings($referralID) {
		$aData =  DB::table('tbl_referral_settings')
			->select('tbl_referral_settings.*')
			->where('referral_id', $referralID)
			->first();
        
        return $aData;
    }
	
	
	
	

    

    public function updateReferralWidget($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_referral_widgets", $aData);
        if ($result) {
            return $id;
        } else {
            return false;
        }
    }

    public function getReferral($userID, $id = '') {
        $response = "";
        $this->db->select("tbl_referral_rewards.*");
        $this->db->where("tbl_referral_rewards.user_id", $userID);
        if (!empty($id)) {
            $this->db->where("tbl_referral_rewards.id", $id);
        }
        $result = $this->db->get("tbl_referral_rewards");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getReferralByAccountId($accountID) {
        $response = "";
        $this->db->where("tbl_referral_rewards.hashcode", $accountID);

        $result = $this->db->get("tbl_referral_rewards");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function createReferralWidget($aData) {
        $result = $this->db->insert("tbl_referral_widgets", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addReferral($aData) {
        $result = $this->db->insert("tbl_referral_rewards", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    

    public function getAdvocateCouponInfo($referralID) {
        $this->db->select("tbl_referral_rewards_adv_coupons.*");
        $this->db->where("tbl_referral_rewards_adv_coupons.reward_id", $referralID);
        $result = $this->db->get("tbl_referral_rewards_adv_coupons");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getFriendCouponInfo($referralID) {
        $this->db->select("tbl_referral_rewards_ref_coupons.*");
        $this->db->where("tbl_referral_rewards_ref_coupons.reward_id", $referralID);
        $result = $this->db->get("tbl_referral_rewards_ref_coupons");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getReferralTemplates($referralID) {
        $this->db->select("tbl_referral_automations_campaigns.*");
        $this->db->join("tbl_referral_automations_events", "tbl_referral_automations_events.id=tbl_referral_automations_campaigns.event_id", "INNER");
        $this->db->where("tbl_referral_automations_events.referral_id", $referralID);
        //$this->db->where("tbl_referral_automations_campaigns.delete_status", 0);
        $result = $this->db->get("tbl_referral_automations_campaigns");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function checkIfExistingAdvocate($subscriberID, $accountID) {
        $this->db->select("tbl_referral_users.*, tbl_referral_reflinks.refkey");
        $this->db->join("tbl_referral_reflinks", "tbl_referral_reflinks.subscriber_id=tbl_referral_users.subscriber_id", "LEFT");
        $this->db->where("tbl_referral_users.subscriber_id", $subscriberID);
        $this->db->where("tbl_referral_users.account_id", $accountID);

        $result = $this->db->get("tbl_referral_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function checkIfExistingAdvocate_old3($subscriberID, $accountID) {
        $this->db->select("tbl_referral_users.*, tbl_referral_reflinks.refkey");
        $this->db->join("tbl_referral_reflinks", "tbl_referral_reflinks.advocate_id=tbl_referral_users.id", "LEFT");
        $this->db->where("tbl_referral_users.subscriber_id", $subscriberID);
        $this->db->where("tbl_referral_users.account_id", $accountID);

        $result = $this->db->get("tbl_referral_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function checkIfExistingAdvocate_old2($email, $accountID) {
        $this->db->select("tbl_referral_users.*, tbl_referral_reflinks.refkey");
        $this->db->join("tbl_referral_reflinks", "tbl_referral_reflinks.advocate_id=tbl_referral_users.id", "LEFT");
        $this->db->where("tbl_referral_users.email", $email);
        $this->db->where("tbl_referral_users.account_id", $accountID);

        $result = $this->db->get("tbl_referral_users");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getReferralEvents($referralID) {
        $this->db->where("referral_id", $referralID);
        $result = $this->db->get("tbl_referral_automations_events");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function getEventDataByEventID($eventID) {
        $this->db->where("id", $eventID);
        $result = $this->db->get("tbl_referral_automations_events");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function getReferralUsers($accountId) {
        $this->db->select('tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone');
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_referral_users.account_id", $accountId);
        $this->db->order_by('tbl_referral_users.id', 'DESC');
        $result = $this->db->get("tbl_referral_users");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result_array();
        }
        return false;
    }

    public function updataCampaignByEventID($cData, $eventID) {
        $this->db->where("event_id", $eventID);
        $result = $this->db->update("tbl_referral_automations_campaigns", $cData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEventByPreId($aData, $previousEventId, $eventId, $referralId) {
        $this->db->where("previous_event_id", $previousEventId);
        $this->db->where("referral_id", $referralId);
        $this->db->where("id !=", $eventId);
        $result = $this->db->update("tbl_referral_automations_events", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEventByPEId($cData, $preEventId) {
        $this->db->where("previous_event_id", $preEventId);
        $result = $this->db->update("tbl_referral_automations_events", $cData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    

    public function getReferralSettings($id, $hash = false) {

        $this->db->select("tbl_referral_rewards.*, tbl_referral_rewards.id AS rewardID, tbl_referral_rewards.created AS rewardCreated,"
                . "tbl_referral_rewards_adv_coupons.*, tbl_referral_rewards_adv_coupons.id AS advCouponID, tbl_referral_rewards_adv_coupons.created AS advCouponCreated,"
                . "tbl_referral_rewards_ref_coupons.*, tbl_referral_rewards_ref_coupons.id AS refCouponID, tbl_referral_rewards_ref_coupons.created AS refCouponCreated,"
                . "tbl_referral_rewards_cash.*, tbl_referral_rewards_cash.id AS cashID, tbl_referral_rewards_cash.created AS cashCreated,"
                . "tbl_referral_rewards_custom.*, tbl_referral_rewards_custom.id AS customID, tbl_referral_rewards_custom.created AS customCreated,"
                . "tbl_referral_rewards_promo_links.*, tbl_referral_rewards_promo_links.id AS promoID, tbl_referral_rewards_promo_links.created AS promoCreated");
        $this->db->join("tbl_referral_rewards_adv_coupons", "tbl_referral_rewards_adv_coupons.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_ref_coupons", "tbl_referral_rewards_ref_coupons.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_cash", "tbl_referral_rewards_cash.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_custom", "tbl_referral_rewards_custom.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_promo_links", "tbl_referral_rewards_promo_links.reward_id = tbl_referral_rewards.id", "LEFT");
        if ($hash == true) {
            $this->db->where("tbl_referral_rewards.hashcode", $id);
        } else {
            $this->db->where("tbl_referral_rewards.id", $id);
        }


        $result = $this->db->get("tbl_referral_rewards");

        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getReferralSettings_old($userID, $hash = false) {

        $this->db->select("tbl_referral_rewards.*, tbl_referral_rewards.id AS rewardID, tbl_referral_rewards.created AS rewardCreated,"
                . "tbl_referral_rewards_adv_coupons.*, tbl_referral_rewards_adv_coupons.id AS advCouponID, tbl_referral_rewards_adv_coupons.created AS advCouponCreated,"
                . "tbl_referral_rewards_ref_coupons.*, tbl_referral_rewards_ref_coupons.id AS refCouponID, tbl_referral_rewards_ref_coupons.created AS refCouponCreated,"
                . "tbl_referral_rewards_cash.*, tbl_referral_rewards_cash.id AS cashID, tbl_referral_rewards_cash.created AS cashCreated,"
                . "tbl_referral_rewards_custom.*, tbl_referral_rewards_custom.id AS customID, tbl_referral_rewards_custom.created AS customCreated,"
                . "tbl_referral_rewards_promo_links.*, tbl_referral_rewards_promo_links.id AS promoID, tbl_referral_rewards_promo_links.created AS promoCreated");
        $this->db->join("tbl_referral_rewards_adv_coupons", "tbl_referral_rewards_adv_coupons.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_ref_coupons", "tbl_referral_rewards_ref_coupons.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_cash", "tbl_referral_rewards_cash.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_custom", "tbl_referral_rewards_custom.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_promo_links", "tbl_referral_rewards_promo_links.reward_id = tbl_referral_rewards.id", "LEFT");
        if ($hash == true) {
            $this->db->where("tbl_referral_rewards.hashcode", $userID);
        } else {
            $this->db->where("tbl_referral_rewards.user_id", $userID);
        }


        $result = $this->db->get("tbl_referral_rewards");

        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getAccountSettings_old($userID) {

        $this->db->select("tbl_referral_settings.*");
        $this->db->where("tbl_referral_settings.user_id", $userID);
        $result = $this->db->get("tbl_referral_settings");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function updateStoreSettings_old($aData, $userID) {
        if ($userID > 0) {

            $oSettings = $this->getAccountSettings($userID);
            if (empty($oSettings)) {
                //Settings do not exists
                $result = $this->db->insert("tbl_referral_settings", $aData);
            } else {
                $this->db->where("user_id", $userID);
                $result = $this->db->update("tbl_referral_settings", $aData);
            }
            //echo $this->db->last_query();
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function saveReferralEvents($eData, $referralID) {
        if ($referralID != '') {
            //Invite Email
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'main',
                'data' => $eData['invite-email'],
                'previous_event_id' => 0,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $eventID = $this->db->insert_id();


            $oTemplates = $this->getDefaultReferralTemplates();
            if (!empty($oTemplates)) {
                foreach ($oTemplates as $oTemplate) {

                    $templateName = $oTemplate->template_name;
                    $templateType = $oTemplate->template_type;
                    $subject = $oTemplate->template_subject;
                    $content = $oTemplate->template_content;

                    if ($templateName == 'Invite Email') {
                        $templateCode = $this->load->view("admin/modules/referral/referral-templates/email/templates", array('template_name' => $templateName), true);
                        $content = base64_encode($templateCode);
                        $tempData = array(
                            'event_id' => $eventID,
                            'content_type' => ($templateType == 'Email') ? 'Regular Html' : 'Plain Text',
                            'campaign_type' => ($templateType == 'Email') ? 'Email' : 'Sms',
                            'name' => $templateName,
                            'subject' => $subject,
                            'greeting' => $oTemplate->greeting,
                            'introduction' => $oTemplate->introduction,
                            'html' => $content,
                            'stripo_compiled_html' => $content,
                            'status' => 'draft',
                            'created' => date("Y-m-d H:i:s")
                        );

                        $this->insertReferralCampaigns($tempData);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function saveReferralEvents_old($eData, $referralID) {
        if ($referralID != '') {
            //Invite Email
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'invite-email',
                'data' => $eData['invite-email'],
                'previous_event_id' => 0,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $inviteEmailInsertID = $this->db->insert_id();

            //Invite SMS
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'invite-sms',
                'data' => $eData['invite-sms'],
                'previous_event_id' => $inviteEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $inviteSMSInsertID = $this->db->insert_id();

            //Reminder Email
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'invite-email-reminder',
                'data' => $eData['invite-email-reminder'],
                'previous_event_id' => $inviteSMSInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $reminderEmailInsertID = $this->db->insert_id();

            //Reminder SMS
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'invite-sms-reminder',
                'data' => $eData['invite-sms-reminder'],
                'previous_event_id' => $reminderEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $reminderSMSInsertID = $this->db->insert_id();

            //Sale Email
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'sale-email',
                'data' => $eData['sale-email'],
                'previous_event_id' => 0,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $saleEmailInsertID = $this->db->insert_id();

            //Sale SMS
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'sale-sms',
                'data' => $eData['sale-sms'],
                'previous_event_id' => $saleEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $saleSMSInsertID = $this->db->insert_id();

            //Sale Reminder Email
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'sale-email-reminder',
                'data' => $eData['sale-email-reminder'],
                'previous_event_id' => $saleSMSInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $saleReminderEmailInsertID = $this->db->insert_id();

            //Sale Reminder SMS
            $aData = array(
                'referral_id' => $referralID,
                'event_type' => 'sale-sms-reminder',
                'data' => $eData['sale-sms-reminder'],
                'previous_event_id' => $saleReminderEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );
            $this->db->insert("tbl_referral_automations_events", $aData);
            $saleReminderSMSInsertID = $this->db->insert_id();

            $oTemplates = $this->getDefaultReferralTemplates();
            if (!empty($oTemplates)) {
                foreach ($oTemplates as $oTemplate) {

                    $templateName = $oTemplate->template_name;
                    $templateType = $oTemplate->template_type;
                    $subject = $oTemplate->template_subject;
                    $content = $oTemplate->template_content;

                    if ($templateName == 'Invite Email') {
                        $eventID = $inviteEmailInsertID;
                    } else if ($templateName == 'Invite SMS') {
                        $eventID = $inviteSMSInsertID;
                    } else if ($templateName == 'Invite Email Reminder') {
                        $eventID = $reminderEmailInsertID;
                    } else if ($templateName == 'Invite SMS Reminder') {
                        $eventID = $reminderSMSInsertID;
                    } else if ($templateName == 'Sale Email') {
                        $eventID = $saleEmailInsertID;
                    } else if ($templateName == 'Sale SMS') {
                        $eventID = $saleSMSInsertID;
                    } else if ($templateName == 'Sale Email Reminder') {
                        $eventID = $saleReminderEmailInsertID;
                    } else if ($templateName == 'Sale SMS Reminder') {
                        $eventID = $saleReminderSMSInsertID;
                    }

                    $tempData = array(
                        'event_id' => $eventID,
                        'content_type' => ($templateType == 'Email') ? 'Regular Html' : 'Plain Text',
                        'campaign_type' => ($templateType == 'Email') ? 'Email' : 'Sms',
                        'name' => $templateName,
                        'subject' => $subject,
                        'html' => $content,
                        'status' => 'draft',
                        'created' => date("Y-m-d H:i:s")
                    );

                    $this->insertReferralCampaigns($tempData);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function saveAutoEvents($aData, $source, $userID) {
        //get Settings
        $oSettings = $this->getAccountSettings($userID);

        if (!empty($oSettings)) {
            $invite = json_encode(array('delay_type' => 'after', 'delay_value' => $oSettings->invite_delay, 'delay_unit' => 'hour'));
            $sale = json_encode(array('delay_type' => 'after', 'delay_value' => $oSettings->sale_delay, 'delay_unit' => 'day'));
            $reminder = json_encode(array('delay_type' => 'after', 'delay_value' => $oSettings->reminder_delay, 'delay_unit' => 'week'));
            $reminderInvite = json_encode(array('delay_type' => 'after', 'delay_value' => $oSettings->reminder_delay_invite, 'delay_unit' => 'week'));

            $settingID = $oSettings->id;
            $oEvents = $this->getAutoEvents($settingID);
            if (!empty($oEvents)) {
                //Update 
                $aData = array();
                foreach ($oEvents as $oEvent) {
                    if ($oEvent->event_type == 'invite') {
                        $aData['data'] = $invite;
                    } else if ($oEvent->event_type == 'sale') {
                        $aData['data'] = $sale;
                    } else if ($oEvent->event_type == 'reminder') {
                        $aData['data'] = $reminder;
                    } else if ($oEvent->event_type == 'reminder_invite') {
                        $aData['data'] = $reminderInvite;
                    }

                    if (!empty($aData)) {
                        $bSaved = $this->updateAutoEvent($aData, $oEvent->id);
                        if ($bSaved) {
                            //Update Campaigns
                            if ($source == 'both') {
                                $this->updataCampaignStatus($oEvent->id, '', 'active');
                            } else if ($source == 'email') {
                                $this->updataCampaignStatus($oEvent->id, 'Email', 'active');
                                $this->updataCampaignStatus($oEvent->id, 'Sms', 'draft');
                            } else if ($source == 'sms') {
                                $this->updataCampaignStatus($oEvent->id, 'Email', 'draft');
                                $this->updataCampaignStatus($oEvent->id, 'Sms', 'active');
                            }
                        }
                    }
                }
            } else {
                //Insert
                //Invite
                $aData = array(
                    'settings_id' => $settingID,
                    'event_type' => 'invite',
                    'data' => $invite,
                    'created' => date("Y-m-d H:i:s ")
                );
                $this->db->insert("tbl_referral_automations_events", $aData);
                $inviteInsertID = $this->db->insert_id();

                //Sale
                $aData = array(
                    'settings_id' => $settingID,
                    'event_type' => 'sale',
                    'data' => $sale,
                    'created' => date("Y-m-d H:i:s ")
                );
                $this->db->insert("tbl_referral_automations_events", $aData);
                $saleInsertID = $this->db->insert_id();

                //Reminder
                $aData = array(
                    'settings_id' => $settingID,
                    'event_type' => 'reminder',
                    'data' => $reminder,
                    'previous_event_id' => $saleInsertID,
                    'created' => date("Y-m-d H:i:s ")
                );
                $this->db->insert("tbl_referral_automations_events", $aData);
                $reminderInsertID = $this->db->insert_id();

                //Reminder Invite
                $aData = array(
                    'settings_id' => $settingID,
                    'event_type' => 'reminder_invite',
                    'data' => $reminder,
                    'previous_event_id' => $inviteInsertID,
                    'created' => date("Y-m-d H:i:s ")
                );
                $this->db->insert("tbl_referral_automations_events", $aData);
                $reminderInviteInsertID = $this->db->insert_id();

                //Insert Default Referral Campaigns
                //get Default templates
                $oTemplates = $this->getDefaultReferralTemplates();
                if (!empty($oTemplates)) {
                    foreach ($oTemplates as $oTemplate) {

                        $templateName = $oTemplate->template_name;
                        $templateType = $oTemplate->template_type;
                        $subject = $oTemplate->template_subject;
                        $content = $oTemplate->template_content;

                        if ($source == 'both') {
                            $status = 'active';
                        } else if ($source == 'email') {
                            $status = ($templateType == 'Email') ? 'active' : 'draft';
                        } else if ($source == 'sms') {
                            $status = ($templateType == 'Sms') ? 'active' : 'draft';
                        }

                        if ($templateName == 'Join') {
                            $eventID = $inviteInsertID;
                        } else if ($templateName == 'Post Purchase') {
                            $eventID = $saleInsertID;
                        } else if ($templateName == 'Reminder') {
                            $eventID = $reminderInsertID;
                        } else if ($templateName == 'Reminder Invite') {
                            $eventID = $reminderInviteInsertID;
                        }

                        $tempData = array(
                            'event_id' => $eventID,
                            'content_type' => ($templateType == 'Email') ? 'Regular Html' : 'Plain Text',
                            'campaign_type' => ($templateType == 'Email') ? 'Email' : 'Sms',
                            'name' => $templateName,
                            'subject' => $subject,
                            'html' => $content,
                            'status' => $status,
                            'created' => date("Y-m-d H:i:s")
                        );

                        $this->insertReferralCampaigns($tempData);
                    }
                }
            }
            return true;
        }
        return false;
    }

    public function insertReferralCampaigns($aData) {
        $result = $this->db->insert("tbl_referral_automations_campaigns", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function updateEvent($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_referral_automations_events", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getReferralCampaignTemplates($settingsID) {
        $this->db->select("tbl_referral_automations_campaigns.*");
        $this->db->join("tbl_referral_automations_events", "tbl_referral_automations_events.id=tbl_referral_automations_campaigns.event_id", "INNER");
        $this->db->where("tbl_referral_automations_events.settings_id", $settingsID);
        $this->db->where("tbl_referral_automations_campaigns.delete_status", 1);
        $result = $this->db->get("tbl_referral_automations_campaigns");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function getUserReferralTemplates($settingsID) {
        $this->db->select("tbl_referral_automations_campaigns.*");
        $this->db->join("tbl_referral_automations_events", "tbl_referral_automations_events.id=tbl_referral_automations_campaigns.event_id", "INNER");
        $this->db->where("tbl_referral_automations_events.settings_id", $settingsID);
        $result = $this->db->get("tbl_referral_automations_campaigns");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function getUserReferralEvents($settingsId) {
        $this->db->where("settings_id", $settingsId);
        $result = $this->db->get("tbl_referral_automations_events");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function getReferralCampaign($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_referral_automations_campaigns");
        if ($result->num_rows() > 0) {
            //echo $this->db->last_query();
            return $result->result();
        }
        return false;
    }

    public function getCampaignsByEventID($eventID) {
        $this->db->where("event_id", $eventID);
        $this->db->where("delete_status", 0);
        $result = $this->db->get("tbl_referral_automations_campaigns");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    public function getDefaultReferralTemplates() {
        $this->db->where("status", "active");
        $result = $this->db->get("tbl_referral_rewards_templates");
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    public function updateUserCampaign($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_referral_automations_campaigns", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updataCampaignStatus($eventID, $type = '', $status) {
        $this->db->where("event_id", $eventID);
        if (!empty($type)) {
            $this->db->where("campaign_type", $type);
        }
        $result = $this->db->update("tbl_referral_automations_campaigns", array('status' => $status));
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getAutoEvents($referralID) {
        $this->db->select("tbl_referral_automations_events.*, tbl_referral_automations_campaigns.name as campaign_name");
        $this->db->join("tbl_referral_automations_campaigns", "tbl_referral_automations_events.id = tbl_referral_automations_campaigns.event_id", "LEFT");
        $this->db->where("tbl_referral_automations_events.referral_id", $referralID);
        $this->db->order_by("tbl_referral_automations_events.id", "ASC");
        $result = $this->db->get("tbl_referral_automations_events");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }

    public function updateAutoEvent($aData, $id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            $result = $this->db->update("tbl_referral_automations_events", $aData);
            //echo $this->db->last_query();
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function createReferralLink($aData) {
        $result = $this->db->insert("tbl_referral_reflinks", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function updateReferralSettings($aData, $id) {
        if (!empty($id)) {
            $this->db->where("id", $id);
            $result = $this->db->update("tbl_referral_rewards", $aData);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public function setupDefaultReferral($aData) {
        $result = $this->db->insert("tbl_referral_rewards", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addAdvocateCoupon($aData) {
        $couponID = $aData['coupon_id'];
        $usageType = $aData['usage_type'];
        $sCoupons = $aData['coupon_code'];
        if ($usageType == 'single') {

            $aCoupons = explode(",", $sCoupons);
            $oCoupons = $this->getAdvocateCoupons($couponID, $usageType);
            if (!empty($oCoupons)) {
                $aExistingCouponsId = $oCoupons[0]->id;
                foreach ($oCoupons as $oCoupon) {
                    $aExistingCoupons[] = $oCoupon->coupon_code;
                    if (!in_array($oCoupon->coupon_code, $aCoupons)) {
                        $this->deleteAdvocateCoupon($oCoupon->id);
                    }
                }
            }

            //Insert record
            foreach ($aCoupons as $strCoupon) {
                if (!in_array($strCoupon, $aExistingCoupons)) {
                    $aData['coupon_code'] = $strCoupon;
                    $result = $this->db->insert("tbl_referral_rewards_adv_coupons_codes", $aData);
                    $inset_id = $this->db->insert_id();
                } else {

                    if ($aExistingCouponsId > 0) {
                        $result = $aExistingCouponsId;
                        $inset_id = $aExistingCouponsId;
                    }
                }
            }
        } else if ($usageType == 'multiple') {
            $oExsits = $this->existsAdvocateCoupon($sCoupons, $couponID);
            if ($oExsits->id > 0) {
                unset($aData['created']);
                $aData['updated'] = date("Y-m-d H:i:s");
                $this->db->where("id", $oExsits->id);
                $this->db->update("tbl_referral_rewards_adv_coupons_codes", $aData);
                $result = $oExsits->id;
                $inset_id = $oExsits->id;
            } else {
                $result = $this->db->insert("tbl_referral_rewards_adv_coupons_codes", $aData);
                $inset_id = $this->db->insert_id();
            }
        }

        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function existsAdvocateCoupon($couponCode, $couponID) {
        $this->db->where("coupon_id", $couponID);
        $this->db->where("coupon_code", $couponCode);
        $this->db->limit(1);
        $result = $this->db->get("tbl_referral_rewards_adv_coupons_codes");
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return false;
    }

    public function deleteAdvocateCoupon($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete("tbl_referral_rewards_adv_coupons_codes");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdvocateCouponCode($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_referral_rewards_adv_coupons", $aData);
        if ($result) {
            return true;
        }
        return false;
    }

    public function getAdvocateCoupons($couponID, $usageType) {
        $this->db->where("coupon_id", $couponID);
        $this->db->where("usage_type", $usageType);
        $result = $this->db->get("tbl_referral_rewards_adv_coupons_codes");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addReferredCoupon($aData) {
        $couponID = $aData['coupon_id'];
        $usageType = $aData['usage_type'];
        $sCoupons = $aData['coupon_code'];
        if ($usageType == 'single') {

            $aCoupons = explode(",", $sCoupons);
            $oCoupons = $this->getReferredCoupons($couponID, $usageType);
            if (!empty($oCoupons)) {
                $aExistingCouponsId = $oCoupons[0]->id;
                foreach ($oCoupons as $oCoupon) {
                    $aExistingCoupons[] = $oCoupon->coupon_code;
                    if (!in_array($oCoupon->coupon_code, $aCoupons)) {
                        $this->deleteReferredCoupon($oCoupon->id);
                    }
                }
            }

            //Insert record
            foreach ($aCoupons as $strCoupon) {
                if (!in_array($strCoupon, $aExistingCoupons)) {
                    $aData['coupon_code'] = $strCoupon;
                    $result = $this->db->insert("tbl_referral_rewards_ref_coupons_codes", $aData);
                    $inset_id = $this->db->insert_id();
                } else {

                    if ($aExistingCouponsId > 0) {
                        $result = $aExistingCouponsId;
                        $inset_id = $aExistingCouponsId;
                    }
                }
            }
        } else if ($usageType == 'multiple') {
            $oExsits = $this->existsReferredCoupon($sCoupons, $couponID);
            if ($oExsits->id > 0) {
                unset($aData['created']);
                $aData['updated'] = date("Y-m-d H:i:s");
                $this->db->where("id", $oExsits->id);
                $this->db->update("tbl_referral_rewards_ref_coupons_codes", $aData);
                $result = $oExsits->id;
                $inset_id = $oExsits->id;
            } else {
                $result = $this->db->insert("tbl_referral_rewards_ref_coupons_codes", $aData);
                $inset_id = $this->db->insert_id();
            }
        }

        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function existsReferredCoupon($couponCode, $couponID) {
        $this->db->where("coupon_id", $couponID);
        $this->db->where("coupon_code", $couponCode);
        $this->db->limit(1);
        $result = $this->db->get("tbl_referral_rewards_ref_coupons_codes");
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return false;
    }

    public function deleteReferredCoupon($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete("tbl_referral_rewards_ref_coupons_codes");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateReferredCouponCode($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_referral_rewards_ref_coupons", $aData);
        if ($result) {
            return true;
        }
        return false;
    }

    public function getReferredCoupons($couponID, $usageType) {
        $this->db->where("coupon_id", $couponID);
        $this->db->where("usage_type", $usageType);
        $result = $this->db->get("tbl_referral_rewards_ref_coupons_codes");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addReferralCoupon($aData) {
        $result = $this->db->insert("tbl_referral_rewards_ref_coupons_codes", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function getAdvocateCouponCodes($couponID) {
        $this->db->where("coupon_id", $couponID);
        $result = $this->db->get("tbl_referral_rewards_adv_coupons_codes");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReferralCouponCodes($couponID) {
        $this->db->where("coupon_id", $couponID);
        $result = $this->db->get("tbl_referral_rewards_ref_coupons_codes");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function saveAdvCouponDiscount($aData) {
        $rewardID = $aData['reward_id'];
        if ($rewardID > 0) {
            $oRec = $this->checkIfAdvCouponExists($rewardID);
            if ($oRec->id > 0) {
                //Update
                $this->db->where("reward_id", $rewardID);
                $result = $this->db->update("tbl_referral_rewards_adv_coupons", $aData);
                $primaryID = $oRec->id;
            } else {
                //Insert
                $aData['created'] = date("Y-m-d H:i:s");
                $result = $this->db->insert("tbl_referral_rewards_adv_coupons", $aData);
                $primaryID = $this->db->insert_id();
            }
            if ($result) {
                return $primaryID;
            }
        }
        return false;
    }

    public function checkIfAdvCouponExists($rewardID) {
        $this->db->where("reward_id", $rewardID);
        $result = $this->db->get("tbl_referral_rewards_adv_coupons");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function saveRefCouponDiscount($aData) {
        $rewardID = $aData['reward_id'];
        if ($rewardID > 0) {
            $oRec = $this->checkIfRefCouponExists($rewardID);
            if ($oRec->id > 0) {
                //Update
                $this->db->where("reward_id", $rewardID);
                $result = $this->db->update("tbl_referral_rewards_ref_coupons", $aData);
                $primaryID = $oRec->id;
            } else {
                //Insert
                $aData['created'] = date("Y-m-d H:i:s");
                $result = $this->db->insert("tbl_referral_rewards_ref_coupons", $aData);
                $primaryID = $this->db->insert_id();
            }
            if ($result) {
                return $primaryID;
            }
        }
        return false;
    }

    public function checkIfRefCouponExists($rewardID) {
        $this->db->where("reward_id", $rewardID);
        $result = $this->db->get("tbl_referral_rewards_ref_coupons");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function saveCashReward($aData) {
        $rewardID = $aData['reward_id'];
        if ($rewardID > 0) {
            $oRec = $this->checkIfCashRewardExists($rewardID);
            if ($oRec->id > 0) {
                //Update
                $this->db->where("reward_id", $rewardID);
                $result = $this->db->update("tbl_referral_rewards_cash", $aData);
                $primaryID = $oRec->id;
            } else {
                //Insert
                $aData['created'] = date("Y-m-d H:i:s");
                $result = $this->db->insert("tbl_referral_rewards_cash", $aData);
                $primaryID = $this->db->insert_id();
            }
            if ($result) {
                return $primaryID;
            }
        }
        return false;
    }

    public function checkIfCashRewardExists($rewardID) {
        $this->db->where("reward_id", $rewardID);
        $result = $this->db->get("tbl_referral_rewards_cash");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function saveCustomReward($aData) {
        $rewardID = $aData['reward_id'];
        if ($rewardID > 0) {
            $oRec = $this->checkIfCustomRewardExists($rewardID);
            if ($oRec->id > 0) {
                //Update
                $this->db->where("reward_id", $rewardID);
                $result = $this->db->update("tbl_referral_rewards_custom", $aData);
                $primaryID = $oRec->id;
            } else {
                //Insert
                $aData['created'] = date("Y-m-d H:i:s");
                $result = $this->db->insert("tbl_referral_rewards_custom", $aData);
                $primaryID = $this->db->insert_id();
            }
            if ($result) {
                return $primaryID;
            }
        }
        return false;
    }

    public function checkIfCustomRewardExists($rewardID) {
        $this->db->where("reward_id", $rewardID);
        $result = $this->db->get("tbl_referral_rewards_custom");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function savePromoLink($aData) {
        $rewardID = $aData['reward_id'];
        if ($rewardID > 0) {
            $oRec = $this->checkIfPromoLinkExists($rewardID);
            if ($oRec->id > 0) {
                //Update
                $this->db->where("reward_id", $rewardID);
                $result = $this->db->update("tbl_referral_rewards_promo_links", $aData);
                $primaryID = $oRec->id;
            } else {
                //Insert
                $aData['created'] = date("Y-m-d H:i:s");
                $result = $this->db->insert("tbl_referral_rewards_promo_links", $aData);
                $primaryID = $this->db->insert_id();
            }
            if ($result) {
                return $primaryID;
            }
        }
        return false;
    }

    public function checkIfPromoLinkExists($rewardID) {
        $this->db->where("reward_id", $rewardID);
        $result = $this->db->get("tbl_referral_rewards_promo_links");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function addReferredUser($aData) {

        $result = $this->db->insert('tbl_referral_users', $aData);
        $insertID = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($result)
            return $insertID;
        else
            return false;
    }

    public function getAllAdvocates($accountID = '') {
        $this->db->select("tbl_referral_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_subscribers.status AS globalStatus, tbl_subscribers.facebook_profile, tbl_subscribers.twitter_profile, tbl_subscribers.linkedin_profile,tbl_subscribers.instagram_profile, tbl_subscribers.socialProfile, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id=tbl_subscribers.id", "LEFT");
        if ($accountID != '') {
            $this->db->where("tbl_referral_users.account_id", $accountID);
        }
        $this->db->join("tbl_referral_rewards", "tbl_referral_users.account_id = tbl_referral_rewards.hashcode", "INNER");
        $this->db->where("tbl_referral_users.subscriber_id !=", NULL);
        $result = $this->db->get("tbl_referral_users");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAdvocateById($id, $accountID) {
        $this->db->select("tbl_referral_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_subscribers.status AS globalStatus, tbl_subscribers.facebook_profile, tbl_subscribers.twitter_profile, tbl_subscribers.linkedin_profile,tbl_subscribers.instagram_profile, tbl_subscribers.socialProfile, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->join("tbl_referral_rewards", "tbl_referral_users.account_id = tbl_referral_rewards.hashcode", "INNER");
        $this->db->where("tbl_referral_users.subscriber_id", $id);
        $this->db->where("tbl_referral_users.account_id", $accountID);
        $this->db->where("tbl_referral_users.subscriber_id !=", NULL);
        $result = $this->db->get("tbl_referral_users");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getReferralUserById($userID) {
        $this->db->select("tbl_referral_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_subscribers.facebook_profile, tbl_subscribers.twitter_profile, tbl_subscribers.linkedin_profile,tbl_subscribers.instagram_profile, tbl_subscribers.socialProfile, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_referral_users.id", $userID);
        $result = $this->db->get("tbl_referral_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateReferralUser($aData, $userID) {

        $this->db->where('id', $userID);
        $result = $this->db->update('tbl_referral_users', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteReferralUser($userID) {

        $this->db->where('id', $userID);
        $result = $this->db->delete('tbl_referral_users');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfExistingAdvocate_old($email) {
        $this->db->select("tbl_referral_users.*, tbl_referral_reflinks.refkey");
        $this->db->join("tbl_referral_reflinks", "tbl_referral_reflinks.advocate_id=tbl_referral_users.id", "LEFT");
        $this->db->where("tbl_referral_users.email", $email);
        $result = $this->db->get("tbl_referral_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getRefLinkInfo($refCode) {
        $this->db->select("tbl_referral_settings.*, tbl_referral_reflinks.*");
        $this->db->join("tbl_referral_settings", "tbl_referral_settings.referral_id=tbl_referral_reflinks.referral_id", "LEFT");
        $this->db->where("tbl_referral_reflinks.refkey", $refCode);
        $result = $this->db->get("tbl_referral_reflinks");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function trackReferralVisit($aData) {
        $refKey = $aData['refkey'];
        $ip = $aData['ip_address'];
        $bRecorded = $this->checkIfRecordedReferralVisit($refKey, $ip);
        if ($bRecorded == false) {
            $result = $this->db->insert("tbl_referral_reflinks_visit_logs", $aData);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function trackLiveRefLink($aData) {
        $result = $this->db->insert("tbl_referral_reflinks_live_track", $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getLiveReferralLinkTrackData($ip) {
        if (!empty($ip)) {
            $this->db->where("ip_address", $ip);
            $this->db->order_by("id", "DESC");
            $result = $this->db->get("tbl_referral_reflinks_live_track");
            if ($result->num_rows() > 0) {
                $response = $result->row();
            }
        }
        return $response;
    }

    public function deleteLiveReferralLinkTrackData($ip) {
        $this->db->where("ip_address", $ip);
        $result = $this->db->delete("tbl_referral_reflinks_live_track");
        return true;
    }

    public function checkIfRecordedReferralVisit($refkey, $ip) {
        $this->db->where("refkey", $refkey);
        $this->db->where("ip_address", $ip);
        $result = $this->db->get("tbl_referral_reflinks_visit_logs");
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function saveReferralSale($aData) {
        $result = $this->db->insert("tbl_referral_sales", $aData);
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
            return false;
    }

    public function getReferralInvoices($accountID) {
        $this->db->select("SUM(tbl_referral_sales.amount) AS total_sale, COUNT(tbl_referral_sales.id) AS sale_count, tbl_referral_sales.*");
        $this->db->where("tbl_referral_sales.account_id", $accountID);
        $this->db->group_by("tbl_referral_sales.email");
        $this->db->order_by("tbl_referral_sales.id", "DESC");
        $result = $this->db->get("tbl_referral_sales");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function referredSales($accountID) {
        $this->db->select("tbl_referral_sales.*, tbl_subscribers.firstname AS aff_firstname, tbl_subscribers.lastname AS aff_lastname, tbl_subscribers.email AS aff_email, tbl_subscribers.phone AS aff_phone");
        //$this->db->join("tbl_referral_users", "tbl_referral_sales.affiliateid = tbl_referral_users.subscriber_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_referral_sales.affiliateid = tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_referral_sales.account_id", $accountID);
        $this->db->where("tbl_referral_sales.affiliateid !=", NULL);
        $this->db->order_by("tbl_referral_sales.id", "DESC");
        $result = $this->db->get("tbl_referral_sales");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReferralLinkVisits($accountID) {
        $this->db->select("tbl_referral_reflinks_visit_logs.*");
        $this->db->join("tbl_referral_reflinks", "tbl_referral_reflinks.refkey = tbl_referral_reflinks_visit_logs.refkey", "LEFT");
        //$this->db->join("tbl_referral_settings", "tbl_referral_settings.id=tbl_referral_reflinks.settings_id", "LEFT");
        $this->db->join("tbl_referral_rewards", "tbl_referral_rewards.id=tbl_referral_reflinks.referral_id", "LEFT");
        $this->db->where("tbl_referral_rewards.hashcode", $accountID);
        $result = $this->db->get("tbl_referral_reflinks_visit_logs");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReferralLinkVisitsByAdvocateId($advocateId, $referralID) {
        $this->db->select("tbl_referral_reflinks_visit_logs.*");
        $this->db->join("tbl_referral_reflinks", "tbl_referral_reflinks.refkey = tbl_referral_reflinks_visit_logs.refkey", "LEFT");
        $this->db->where("tbl_referral_reflinks.subscriber_id", $advocateId);
        $this->db->where("tbl_referral_reflinks.referral_id", $referralID);
        $result = $this->db->get("tbl_referral_reflinks_visit_logs");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    

    public function referredSalesByAdvocateId($advocateId, $accountID) {
        $this->db->select("tbl_referral_sales.*, tbl_subscribers.firstname AS aff_firstname, tbl_subscribers.lastname AS aff_lastname, tbl_subscribers.email AS aff_email, tbl_subscribers.phone AS aff_phone");
        $this->db->join("tbl_subscribers", "tbl_referral_sales.affiliateid = tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_referral_sales.affiliateid", $advocateId);
        $this->db->where("tbl_referral_sales.account_id", $accountID);
        $this->db->where("tbl_referral_sales.affiliateid !=", NULL);
        $this->db->order_by("tbl_referral_sales.id", "DESC");
        $result = $this->db->get("tbl_referral_sales");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function referredSalesByAdvocateId_old($advocateId, $accountID) {
        $this->db->select("tbl_referral_sales.*, tbl_subscribers.firstname AS aff_firstname, tbl_subscribers.lastname AS aff_lastname, tbl_subscribers.email AS aff_email, tbl_subscribers.phone AS aff_phone");
        $this->db->join("tbl_referral_users", "tbl_referral_sales.affiliateid = tbl_referral_users.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id = tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_referral_users.subscriber_id", $advocateId);
        $this->db->where("tbl_referral_users.account_id", $accountID);
        $this->db->where("tbl_referral_sales.affiliateid !=", NULL);
        $this->db->order_by("tbl_referral_sales.id", "DESC");
        $result = $this->db->get("tbl_referral_sales");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function untrackedSales($accountID) {
        $this->db->select("tbl_referral_sales.*");
        $this->db->where("tbl_referral_sales.account_id", $accountID);
        $this->db->where("tbl_referral_sales.affiliateid", NULL);
        $this->db->order_by("tbl_referral_sales.id", "DESC");
        $result = $this->db->get("tbl_referral_sales");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReferralSendgridStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_referral_automations_tracking_sendgrid.* FROM tbl_referral_automations_tracking_sendgrid "
                . "LEFT JOIN tbl_referral_rewards ON tbl_referral_automations_tracking_sendgrid.referral_id = tbl_referral_rewards.id "
                . "LEFT JOIN tbl_referral_automations_events ON tbl_referral_automations_tracking_sendgrid.event_id = tbl_referral_automations_events.id "
                . "LEFT JOIN tbl_referral_automations_campaigns ON tbl_referral_automations_tracking_sendgrid.campaign_id= tbl_referral_automations_campaigns.id "
                . "LEFT JOIN tbl_referral_users ON tbl_referral_automations_tracking_sendgrid.subscriber_id = tbl_referral_users.id ";

        if ($param == 'setting') {
            $sql .= "WHERE tbl_referral_automations_tracking_sendgrid.referral_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_referral_automations_tracking_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event') {
            $sql .= "WHERE tbl_referral_automations_tracking_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_referral_automations_tracking_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='deferred' ";
        }

        $sql .= "ORDER BY tbl_referral_automations_tracking_sendgrid.id DESC";

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
        $sql = "SELECT tbl_referral_automations_tracking_twillio.* FROM tbl_referral_automations_tracking_twillio "
                . "LEFT JOIN tbl_referral_rewards ON tbl_referral_automations_tracking_twillio.referral_id = tbl_referral_rewards.id "
                . "LEFT JOIN tbl_referral_automations_events ON tbl_referral_automations_tracking_twillio.event_id = tbl_referral_automations_events.id "
                . "LEFT JOIN tbl_referral_automations_campaigns ON tbl_referral_automations_tracking_twillio.campaign_id= tbl_referral_automations_campaigns.id "
                . "LEFT JOIN tbl_referral_users ON tbl_referral_automations_tracking_twillio.subscriber_id = tbl_referral_users.id ";

        //$sql .= "WHERE tbl_referral_automations_tracking_twillio.settings_id='{$settingId}' ";

        if ($param == 'campaign') {
            $sql .= "WHERE tbl_referral_automations_tracking_twillio.campaign_id='{$id}' ";
        } else if ($param == 'event') {
            $sql .= "WHERE tbl_referral_automations_tracking_twillio.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_referral_automations_tracking_twillio.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND tbl_referral_automations_tracking_twillio.event_name='sending' ";
        }

        $sql .= "ORDER BY tbl_referral_automations_tracking_twillio.id DESC";

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

    

    

    

    

    

    public function getEmailReferralSendgridStats($param, $referralID, $id, $eventType = '') {

        $sql = "SELECT tbl_referral_automations_tracking_sendgrid.* FROM tbl_referral_automations_tracking_sendgrid "
                . "LEFT JOIN tbl_referral_automations_events ON tbl_referral_automations_tracking_sendgrid.event_id = tbl_referral_automations_events.id "
                . "LEFT JOIN tbl_referral_automations_campaigns ON tbl_referral_automations_tracking_sendgrid.campaign_id= tbl_referral_automations_campaigns.id "
                . "LEFT JOIN tbl_referral_users ON tbl_referral_automations_tracking_sendgrid.subscriber_id = tbl_referral_users.id ";


        $sql .= "WHERE tbl_referral_automations_tracking_sendgrid.referral_id='{$referralID}' ";

        if ($param == 'campaign') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "AND 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_referral_automations_tracking_sendgrid.event_name='deferred' ";
        }

        $sql .= "ORDER BY tbl_referral_automations_tracking_sendgrid.id DESC";
        //echo $sql;
        //die;
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }

        return $response;
    }

    public function getReferralNotes($id) {
        if (!empty($id)) {
            $this->db->select("tbl_referral_notes.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email");
            $this->db->join("tbl_users", "tbl_referral_notes.user_id=tbl_users.id", "LEFT");
            $this->db->where("tbl_referral_notes.referral_response_id", $id);
            $this->db->order_by("tbl_referral_notes.id", "DESC");
            $result = $this->db->get("tbl_referral_notes");
            //echo $this->db->last_query();
            //die;
            if ($result->num_rows() > 0) {
                $response = $result->result();
            }
            return $response;
        }
    }

    public function getTagsBySaleID($id) {

        $this->db->select("tbl_tag_groups_entity.*, tbl_referral_tags.tag_id, tbl_referral_tags.referral_response_id");
        $this->db->join("tbl_tag_groups_entity", "tbl_tag_groups_entity.id=tbl_referral_tags.tag_id", "LEFT");
        $this->db->where("tbl_referral_tags.referral_response_id", $id);
        $result = $this->db->get("tbl_referral_tags");
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function getResponseDetails($id) {
        $this->db->select("tbl_referral_sales.*, tbl_referral_sales.id AS saleID, tbl_referral_rewards.*, "
                . "tbl_subscribers.firstname AS aff_firstname, tbl_subscribers.lastname AS aff_lastname, "
                . "tbl_subscribers.email AS aff_email, tbl_subscribers.phone AS aff_phone, "
                . "tbl_referral_settings.store_name, tbl_referral_settings.store_url, tbl_referral_settings.store_email");
        $this->db->join("tbl_referral_users", "tbl_referral_sales.affiliateid = tbl_referral_users.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->join("tbl_referral_rewards", "tbl_referral_sales.account_id = tbl_referral_rewards.hashcode", "LEFT");
        $this->db->join("tbl_referral_settings", "tbl_referral_rewards.id=tbl_referral_settings.referral_id", "LEFT");
        $this->db->where("tbl_referral_sales.id", $id);
        $result = $this->db->get("tbl_referral_sales");
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getReferralProgramInfo($accountID) {
        $response = "";
        $this->db->select("tbl_referral_rewards.*");
        $this->db->where("tbl_referral_rewards.hashcode", $accountID);
        $result = $this->db->get("tbl_referral_rewards");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
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

    public function addReferralTag($aData) {
        $aTagIDs = $aData['aTagIDs'];
        if (!empty($aTagIDs)) {
            foreach ($aTagIDs as $iTagID) {
                $aInput = array(
                    'tag_id' => $iTagID,
                    'referral_response_id' => $aData['referral_response_id'],
                    'applied_tag_created' => date("Y-m-d H:i:s")
                );

                $tagData = $this->getTagBySaleIDTagID($iTagID, $aData['referral_response_id']);
                if ($tagData->id == '') {
                    $result = $this->db->insert('tbl_referral_tags', $aInput);
                }

                $oTags = $this->getTagsBySaleID($aData['referral_response_id']);
                foreach ($oTags as $oTag) {
                    if (in_array($oTag->tag_id, $aTagIDs)) {
                        $result = true;
                    } else {
                        $result = $this->deleteReferralTagByID($oTag->tag_id, $aData['referral_response_id']);
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

    public function getTagBySaleIDTagID($aTagID, $saleID) {
        $this->db->where('tag_id', $aTagID);
        $this->db->where('referral_response_id', $saleID);
        $result = $this->db->get('tbl_referral_tags');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function deleteReferralTagByID($id, $responseID) {
        $this->db->where('tag_id', $id);
        $this->db->where('referral_response_id', $responseID);
        $result = $this->db->delete('tbl_referral_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function removeReferralTag($tagID, $responseID) {
        $this->db->where("referral_response_id", $responseID);
        $this->db->where("tag_id", $tagID);
        $result = $this->db->delete('tbl_referral_tags');
        //echo $this->db->last_query(); exit;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getReferralNoteByID($noteId) {

        $this->db->where('id', $noteId);
        $this->db->from('tbl_referral_notes');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateReferralNote($aData, $noteId) {

        $this->db->where('id', $noteId);
        $result = $this->db->update('tbl_referral_notes', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function saveReferralNotes($aData) {
        $bSaved = $this->db->insert("tbl_referral_notes", $aData);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($bSaved)
            return $insert_id;
        return false;
    }

    public function deleteReferralNoteByID($noteId) {
        $this->db->where('id', $noteId);
        $result = $this->db->delete('tbl_referral_notes');
        return true;
    }

    public function getReferralLinkDetails($subscriberID, $referralID) {
        $this->db->where("subscriber_id", $subscriberID);
        $this->db->where("referral_id", $referralID);
        $result = $this->db->get("tbl_referral_reflinks");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getAdvocateSendgridStats($subscriberID, $referralID) {
        $sql = "SELECT COUNT(DISTINCT tbl_referral_automations_tracking_sendgrid.ip) AS totalCount, tbl_referral_automations_tracking_sendgrid.`event_name` "
                . "FROM tbl_referral_automations_tracking_sendgrid "
                . "LEFT JOIN tbl_referral_rewards ON tbl_referral_rewards.id=tbl_referral_automations_tracking_sendgrid.referral_id "
                . "WHERE tbl_referral_rewards.id='$referralID' AND "
                . "tbl_referral_automations_tracking_sendgrid.subscriber_id = '$subscriberID' "
                . "GROUP BY tbl_referral_automations_tracking_sendgrid.event_name, tbl_referral_automations_tracking_sendgrid.campaign_id";
        $result = $this->db->query($sql);
        //echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    /**
     * This function used to get the list of all referred friends belongs to an advocate
     * @param type $subscriberID
     * @param type $referralID
     * @return type
     */
    public function getReferredFriends($subscriberID, $referralID) {
        $this->db->where("affiliate_id", $subscriberID);
        $this->db->where("affiliate_referral_id", $referralID);
        $result = $this->db->get("tbl_referral_affiliates");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    /**
     * This function used to add affiliate into the advocate account
     * @param type $aData
     * @return boolean
     */
    public function addAdvoateAffiliate($aData) {
        //Apply duplicate check
        $bAlreadyAdded = $this->checkIfAffilatedExists($aData);
        if ($bAlreadyAdded == false) {
            $result = $this->db->insert("tbl_referral_affiliates", $aData);
        }
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * To be used for checking duplicate affiliates into the advocate account
     * @param type $aData
     * @return boolean
     */
    public function checkIfAffilatedExists($aData) {
        $this->db->where("advocate_id", $aData['advocate_id']);
        $this->db->where("advocate_referral_id", $aData['advocate_referral_id']);
        $this->db->where("affiliate_id", $aData['affiliate_id']);
        $this->db->where("affiliate_referral_id", $aData['affiliate_referral_id']);
        $result = $this->db->get("tbl_referral_affiliates");
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

}
