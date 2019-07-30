<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ReviewsModel extends Model {

    /**
     * Get All the reviews related to a brandboost campaign
     * @param type $campaignID
     * @param type $userID
     * @return type
     */
    public static function getCampaignReviewsDetail($campaignID = '', $userID = '') {
        $oData = DB::table('tbl_reviews')
                ->leftJoin('tbl_users', 'tbl_reviews.user_id', '=', 'tbl_users.id')
                ->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_reviews.campaign_id')
                ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.country', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc', 'tbl_brandboost.brand_img')
                ->when(!empty($campaignID), function ($query) use ($campaignID) {
                    return $query->where('tbl_reviews.campaign_id', $campaignID);
                })
                ->when(!empty($userID), function ($query) use ($userID) {
                    return $query->where('tbl_brandboost.user_id', $userID);
                })
                ->orderBy('tbl_reviews.id', 'desc')
                ->get();

        return $oData;
    }

    /**
     * This method returns all the reviews belonging to a member
     * @param type $userID
     * @return type
     */
    public function getMyReviews($userID) {
        $oData = DB::table('tbl_reviews')
                ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
                ->leftJoin('tbl_users', 'tbl_brandboost.user_id', '=', 'tbl_users.id')
                ->select('tbl_reviews.id AS reviewid', 'tbl_reviews.review_type AS reviewtype', 'tbl_reviews.created AS review_created', 'tbl_reviews.status AS rstatus', 'tbl_reviews.*', 'tbl_brandboost.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
                ->where('tbl_reviews.user_id', $userID)
                ->orderBy('tbl_reviews.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Returns filtered reviews of a member
     * @param type $userID
     * @param type $filterValue
     * @param type $columnName
     * @param type $columnSortOrder
     * @param type $start
     * @param type $limit
     * @return type
     */
    public function getMyReviewsByFilter($userID, $filterValue = '', $columnName = 'id', $columnSortOrder = 'desc', $start = '1', $limit = '10') {
        $oData = DB::table('tbl_reviews')
                ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
                ->leftJoin('tbl_users', 'tbl_brandboost.user_id', '=', 'tbl_users.id')
                ->select('tbl_reviews.id AS reviewid', 'tbl_reviews.review_type AS reviewtype', 'tbl_reviews.created AS review_created', 'tbl_reviews.status AS rstatus', 'tbl_reviews.*', 'tbl_brandboost.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
                ->where('tbl_reviews.user_id', $userID)
                ->when(($filterValue != ''), function ($query) use ($filterValue) {
                    return $query
                            ->where('tbl_reviews.created', $filterValue)
                            ->where('tbl_brandboost.brand_title', $filterValue)
                            ->where('tbl_reviews.review_title', $filterValue)
                            ->where('tbl_reviews.rating', $filterValue);
                })
                ->when(($columnName != ''), function($query) use($columnName, $columnSortOrder) {
                    return $query->orderBy('tbl_reviews.' . $columnName, $columnSortOrder);
                }, function($query) {
                    $query->orderBy('tbl_reviews.id', 'desc');
                })
                ->offset($start)
                ->limit($limit)
                ->get();
        return $oData;
    }
	
	/**
     * Returns filtered reviews of a campaign
     * @param type $campaignID
     * @return campaign all reviews 
     */
	public static function getCampaignReviews($campaignID) {
		$oData = DB::table('tbl_reviews')
                ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
                ->leftJoin('tbl_users', 'tbl_reviews.user_id', '=', 'tbl_users.id')
                ->leftJoin('tbl_subscribers', 'tbl_subscribers.user_id', '=', 'tbl_users.id')
                ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country', 'tbl_subscribers.id AS subscriberId', 'tbl_brandboost.brand_title')
                ->where('tbl_reviews.status', 1)
				->when(!empty($campaignID), function ($query) use ($campaignID) {
                    return $query->where('tbl_reviews.campaign_id', $campaignID);
                })
                ->orderBy('tbl_reviews.id', 'desc')
                ->get();				
        return $oData;
    }
	
	/**
     * Returns get campaign reviews data
     * @param type $campaignID
     * @return campaign all reviews 
     */
	public static function getCampReviews($campaignID) {
        $aData = array();
		$oData = DB::table('tbl_reviews')
                ->where('tbl_reviews.campaign_id', $campaignID)
                ->orderBy('tbl_reviews.id', 'desc')
                ->get();
        return $oData;
    }
	
	/**
     * Used to get campaign reviews list
     * @param type $campaignID
     * @return campaign all reviews 
     */
	public function getCampaignAllReviews($campaignID) {
		$oData = DB::table('tbl_reviews')
			->leftJoin('tbl_users', 'tbl_reviews.user_id', '=', 'tbl_users.id')
			->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
			->leftJoin('tbl_subscribers', 'tbl_subscribers.user_id', '=', 'tbl_users.id')
			->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country', 'tbl_subscribers.id as subscriberId', 'tbl_brandboost.brand_title')
			->where('tbl_reviews.status', 1)
			->when(!empty($campaignID), function ($query) use ($campaignID) {
				return $query->where('tbl_reviews.campaign_id', $campaignID);
			})
			->orderBy('tbl_reviews.id', 'desc')
			->get();				
        return $oData;
    }
	
	/**
     * Used to get user campaign reviews list
     * @param type $campaignID
     * @return campaign all reviews 
     */
	public function getMyBranboostReviewsFilter($userID) {
		$oData = DB::table('tbl_reviews')
			->leftJoin('tbl_users', 'tbl_reviews.user_id', '=', 'tbl_users.id')
			->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
			->select('tbl_reviews.id AS reviewid', 'tbl_reviews.review_type AS reviewtype', 'tbl_reviews.created AS review_created', 'tbl_reviews.status AS rstatus', 'tbl_reviews.*', 'tbl_brandboost.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country as userCountry')
			->where('tbl_brandboost.user_id', $userID)
			->where('tbl_brandboost.delete_status', 0)
			->orderBy('tbl_reviews.id', 'desc')
			->get();				
        return $oData;
    }
	
	/**
     * Used to get user campaign reviews list by user id
     * @param type $campaignID
     * @return campaign all reviews 
     */
	public function getMyBranboostReviews($userID) {
        $oData = DB::table('tbl_reviews')
			->leftJoin('tbl_users', 'tbl_reviews.user_id', '=', 'tbl_users.id')
			->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
			->select('tbl_reviews.id AS reviewid', 'tbl_reviews.review_type AS reviewtype', 'tbl_reviews.created AS review_created', 'tbl_reviews.status AS rstatus', 'tbl_reviews.*', 'tbl_brandboost.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country as userCountry')
			->where('tbl_brandboost.user_id', $userID)
			->where('tbl_brandboost.delete_status', 0)
			->orderBy('tbl_reviews.id', 'desc')
			->get();				
        return $oData;
    }
	
	/**
     * Used to get user campaign reviews list by user id
     * @param type $campaignID
     * @return campaign all reviews 
     */
	public static function getReviewAllComments($reviewId, $start = 0, $limit = 5) {
        $oData = DB::table('tbl_reviews_comments')
			->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=', 'tbl_reviews.id')
			->leftJoin('tbl_users', 'tbl_reviews_comments.user_id', '=', 'tbl_users.id')
			->select('tbl_reviews_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.id as userId')
			->where('tbl_reviews_comments.review_id', $reviewId)
			->orderBy('tbl_reviews_comments.id', 'desc')
			->offset($start)
            ->limit($limit)
			->get();				
        return $oData;
    }
	
	/**
     * Used to get brandboost campaign reviews list by campaign id
     * @param type $campaignID
     * @return campaign all reviews 
     */
	public function getBrandBoostCampaign($campaignID, $hash = false) {
		$oData = DB::table('tbl_brandboost')
			->leftJoin('tbl_users', 'tbl_brandboost.user_id', '=', 'tbl_users.id')
			->select('tbl_brandboost.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.address as user_address', 'tbl_users.city as user_city', 'tbl_users.country as user_country')
			->when(($hash == true), function($query) use($campaignID) {
				return $query->where('tbl_brandboost.hashcode', $campaignID);
			}, function($query) use($campaignID) {
				$query->where('tbl_brandboost.id', $campaignID);
			})
			->first();				
        return $oData;
    }
	
	/**
     * Used to update review by reviewID
     * @param type $reviewID
     */
	public static function updateReview($aData, $reviewID) {
		$result = DB::table('tbl_reviews')
           ->where('id', $reviewID)
           ->update($aData);
		   
        if ($result)
            return true;
        else
            return false;
    }
	
	/**
     * Used to delete review by reviewID
     * @param type $reviewID
     */
	public static function deleteReviewByID($reviewID) {
		$result = DB::table('tbl_reviews')
           ->where('id', $reviewID)
           ->delete();
        return true;
    }
	
	/**
     * Used to get reviews note by id
     * @param type $id
     * @return type 
     */
	public static function listReviewNotes($id) {
        if (!empty($id)) {
			$oData = DB::table('tbl_reviews_notes')
				->leftJoin('tbl_users', 'tbl_reviews_notes.user_id', '=', 'tbl_users.id')
				->select('tbl_reviews_notes.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email')
				->where('tbl_reviews_notes.review_id', $id)
				->orderBy('tbl_reviews_notes.id', 'desc')
				->get();				
			return $oData;
        }
    }

	/**
     * Used to get all parent comments by reviews id
     * @param type $reviewId
     * @param type $start
     * @param type $limit
     * @return type 
     */
	public static function getReviewAllParentsComments($reviewId, $start = 0, $limit = 5) {
		$oData = DB::table('tbl_reviews_comments')
			->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=', 'tbl_reviews.id')
			->leftJoin('tbl_users', 'tbl_reviews_comments.user_id', '=', 'tbl_users.id')
			->select('tbl_reviews_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.id as userId')
			->where('tbl_reviews_comments.review_id', $reviewId)
			->where('tbl_reviews_comments.parent_comment_id', 0)
			->orderBy('tbl_reviews_comments.id', 'desc')
			->offset($start)
            ->limit($limit)
			->get();				
        return $oData;
    }
	
	/**
     * Used to get review info by review id
     * @param type $id
     * @return type 
     */
	public static function getReviewInfo($id) {
		$oData = DB::table('tbl_reviews')
			->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
			->leftJoin('tbl_users', 'tbl_users.id', '=', 'tbl_reviews.user_id')
			->select('tbl_brandboost.brand_title', 'tbl_brandboost.id AS bbId', 'tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.created as user_joining_date', 'tbl_users.avatar')
			->where('tbl_reviews.id', $id)
			->first();				
        return $oData;	
    }
	
	/**
     * Used to count parent comments by review id
     * @param type $id
     * @return type 
     */
	public static function parentsCommentsCount($reviewId) {
		$oData = DB::table('tbl_reviews_comments')
			->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=', 'tbl_reviews.id')
			->leftJoin('tbl_users', 'tbl_reviews_comments.user_id', '=', 'tbl_users.id')
			->select('tbl_reviews_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.id as userId')
			->where('tbl_reviews_comments.review_id', $reviewId)
			->where('tbl_reviews_comments.parent_comment_id', 0)
			->orderBy('tbl_reviews_comments.id', 'desc')
			->count();				
        return $oData;
    }


    /**
     * Used to save review notes
     * @param type $id
     * @return type 
     */
	public static function saveReviewNotes($aData) {
		$insert_id = DB::table('tbl_reviews_notes')->insertGetId($aData);
		return $insert_id;

        if ($insert_id)
            return $insert_id;
        return false;
    }
	
	/**
     * Used to delete review note by note id
     * @param type $id
     * @return type 
     */
	public static function deleteReviewNoteByID($noteId) {
		$result = DB::table('tbl_reviews_notes')
           ->where('id', $noteId)
           ->delete();
        return true;
    }
	
	public function getCampReviewsWithFiveRatings($brandboostID) {

        $this->db->select("tbl_brandboost.*, ut.firstname, ut.lastname, ut.email, tu.firstname as bb_u_firstname, tu.lastname as bb_u_lastname, tu.email as bb_u_email, tbl_reviews.comment_text, tbl_reviews.ratings, tbl_reviews.id as reviewId");
        $this->db->join("tbl_reviews", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_users as ut", "tbl_reviews.user_id=ut.id", "LEFT");
        $this->db->join("tbl_users as tu", "tbl_brandboost.user_id=tu.id", "LEFT");
        $this->db->where("tbl_brandboost.id", $brandboostID);
        $this->db->where("tbl_reviews.ratings", 5);
        $this->db->where("tbl_reviews.status", 1);
        $this->db->where("tbl_reviews.review_type", 'text');
        $this->db->order_by("tbl_reviews.id", "DESC");
        $this->db->limit(5);
        $rResponse = $this->db->get("tbl_brandboost");
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getCampReviewsWithFourRatings($brandboostID) {

        $this->db->select("tbl_brandboost.*, ut.firstname, ut.lastname, ut.email, tu.firstname as bb_u_firstname, tu.lastname as bb_u_lastname, tu.email as bb_u_email, tbl_reviews.comment_text, tbl_reviews.ratings, tbl_reviews.id as reviewId");
        $this->db->join("tbl_reviews", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_users as ut", "tbl_reviews.user_id=ut.id", "LEFT");
        $this->db->join("tbl_users as tu", "tbl_brandboost.user_id=tu.id", "LEFT");
        $this->db->where("tbl_brandboost.id", $brandboostID);
        $this->db->where("tbl_reviews.ratings", 5);
        $this->db->where("tbl_reviews.status", 1);
        $this->db->where("tbl_reviews.review_type", 'text');
        $this->db->order_by("tbl_reviews.id", "DESC");
        $this->db->limit(5);
        $rResponse = $this->db->get("tbl_brandboost");
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getCampReviewsWithTopRatings($brandboostID) {

        $this->db->select("tbl_brandboost.*, ut.firstname, ut.lastname, ut.email, tu.firstname as bb_u_firstname, tu.lastname as bb_u_lastname, tu.email as bb_u_email, tbl_reviews.comment_text, tbl_reviews.ratings, tbl_reviews.id as reviewId");
        $this->db->join("tbl_reviews", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_users as ut", "tbl_reviews.user_id=ut.id", "LEFT");
        $this->db->join("tbl_users as tu", "tbl_brandboost.user_id=tu.id", "LEFT");
        $this->db->where("tbl_brandboost.id", $brandboostID);
        $this->db->where("tbl_reviews.status", 1);
        $this->db->where("tbl_reviews.review_type", 'text');
        $this->db->order_by("tbl_reviews.ratings", "DESC");
        $this->db->limit(5);
        $rResponse = $this->db->get("tbl_brandboost");
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getReviews($campaignID, $aSettings = array()) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id=tbl_brandboost.id", "LEFT");
        $this->db->where("tbl_reviews.campaign_id", $campaignID);
        $this->db->where("tbl_reviews.status", '1');
        if (!empty($aSettings['logged']) && !empty($aSettings['logged_id'])) {
            $this->db->or_where("tbl_reviews.status", '2');
        }
        if (!empty($aSettings) && !empty($aSettings['min_ratings'])) {
            $this->db->where("tbl_reviews.ratings >=", $aSettings['min_ratings']);
        }

        $start = !empty($aSettings['start']) ? $aSettings['start'] : 0;

        if (!empty($aSettings) && !empty($aSettings['review_limit'])) {
            $this->db->limit($aSettings['review_limit'], $start);
        }
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getAllActiveReviews($campaignID, $aSettings = array()) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id=tbl_brandboost.id", "LEFT");
        $this->db->where("tbl_reviews.campaign_id", $campaignID);
        $this->db->where("tbl_reviews.status", '1');

        if (!empty($aSettings) && !empty($aSettings['min_ratings'])) {
            $this->db->where("tbl_reviews.ratings >=", $aSettings['min_ratings']);
        }

        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getReviewsByProductType($campaignID, $aSettings = array(), $productType = 'product') {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id=tbl_brandboost.id", "LEFT");
        $this->db->where("tbl_reviews.campaign_id", $campaignID);
        $this->db->where("tbl_reviews.review_type", $productType);
        $this->db->where("tbl_reviews.status", '1');
        if (!empty($aSettings['logged']) && !empty($aSettings['logged_id'])) {
            $this->db->or_where("tbl_reviews.status", '2');
        }
        if (!empty($aSettings) && !empty($aSettings['min_ratings'])) {
            $this->db->where("tbl_reviews.ratings >=", $aSettings['min_ratings']);
        }

        $start = !empty($aSettings['start']) ? $aSettings['start'] : 0;

        if (!empty($aSettings) && !empty($aSettings['review_limit'])) {
            $this->db->limit($aSettings['review_limit'], $start);
        }
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }


      /**
     * Used to get the multireviews for campaign id
     * @param type $companyName
     * @return username
     */

    public function getMultiReviews($multiCampaignID, $aSettings = array()) {

        $start = !empty($aSettings['start']) ? $aSettings['start'] : 0;
        $aData =  DB::table('tbl_reviews')
        ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_brandboost.brand_title')
        ->leftjoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
        ->join('tbl_brandboost', 'tbl_reviews.campaign_id','=','tbl_brandboost.id')
        ->whereIn('tbl_reviews.campaign_id', $multiCampaignID)
        ->where('tbl_reviews.status', '1')
        ->when((!empty($aSettings['logged']) && !empty($aSettings['logged_id'])), function($query){
         return $query->orWhere("tbl_reviews.status", '2');
        })
         ->when((!empty($aSettings) && !empty($aSettings['min_ratings'])), function($query) use ($aSettings){
         return $query->orWhere('tbl_reviews.ratings','>=',$aSettings['min_ratings']);
        })
         ->when((!empty($aSettings) && !empty($aSettings['review_limit'])), function($query) use ($aSettings,$start){
         return $query->limit($aSettings['review_limit'], $start);
        })
 
        ->orderBy("tbl_reviews.id", "DESC")->get();
        
        return $aData;
    }

    public function getSiteReviews($campaignID, $aSettings = array()) {
        $this->db->select("tbl_reviews_site.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile");
        $this->db->join("tbl_users", "tbl_reviews_site.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_reviews_site.campaign_id", $campaignID);
        $this->db->where("tbl_reviews_site.status", '1');
        if (!empty($aSettings['logged']) && !empty($aSettings['logged_id'])) {
            $this->db->or_where("tbl_reviews.status", '2');
        }
        if (!empty($aSettings) && !empty($aSettings['min_ratings'])) {
            $this->db->where("tbl_reviews_site.ratings >=", $aSettings['min_ratings']);
        }

        $start = !empty($aSettings['start']) ? $aSettings['start'] : 0;

        if (!empty($aSettings) && !empty($aSettings['review_limit'])) {
            $this->db->limit($aSettings['review_limit'], $start);
        }
        $this->db->order_by("tbl_reviews_site.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews_site");
        //echo $this->db->last_query();exit;
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getAllReviewsByUserId($userId) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, tbl_users.country, tbl_subscribers.id as subscriberId, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_subscribers.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_reviews.status", 1);
        $this->db->where("tbl_brandboost.user_id", $userId);
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getActiveCampaignReviewsByType($campaignID, $type = 'product') {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, tbl_users.country, tbl_subscribers.id as subscriberId, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_subscribers.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_reviews.review_type", $type);
        $this->db->where("tbl_reviews.status", 1);
        if (!empty($campaignID)) {
            $this->db->where("tbl_reviews.campaign_id", $campaignID);
        }
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getCampaignReviewsByUserId($userId) {
       $aData =  DB::table('tbl_reviews')
        ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country', 'tbl_subscribers.id as subscriberId', 'tbl_brandboost.brand_title')
           ->leftJoin('tbl_users', 'tbl_reviews.user_id' ,'=', 'tbl_users.id')
            ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_reviews.campaign_id')
           ->leftjoin('tbl_subscribers', 'tbl_subscribers.user_id','=','tbl_users.id')
            ->when(!empty($userId), function($query) use ($userId){
               return $query->where('tbl_reviews.user_id',$userId);
           })
           ->orderBy('tbl_reviews.id', 'DESC')->get();

        return $aData;
    }

    public function getReviewsUserList($userID = 1, $userRole) {

        $this->db->select("tbl_users.*");
        $this->db->distinct('tbl_users.id');
        $this->db->join("tbl_reviews", "tbl_brandboost.id=tbl_reviews.campaign_id", "INNER");

        $this->db->join("tbl_users", "tbl_reviews.user_id = tbl_users.id", "INNER");

        if ($userRole != '1') {
            $this->db->where("tbl_brandboost.user_id", $userID);
        }
        $rResponse = $this->db->get("tbl_brandboost");
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getCampaignReviewsList($userID, $searchValue, $reviewstatus) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.email, tbl_users.mobile, tbl_users.country, tbl_brandboost.brand_title, tbl_brandboost.brand_desc, tbl_brandboost.brand_img");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->where("tbl_brandboost.user_id", $userID);
        $this->db->order_by("tbl_reviews.id", "DESC");

        if ($filterValue != '') {
            $this->db->like("tbl_reviews.created", $filterValue);
            $this->db->or_like("tbl_reviews.review_title", $filterValue);
            $this->db->or_like("tbl_users.email", $filterValue);
            $this->db->or_where("CONCAT(tbl_users.firstname, ' ', tbl_users.lastname) LIKE '%" . $filterValue . "%'");
        }

        if (!empty($reviewstatus)) {
            $this->db->where("tbl_reviews.status", $reviewstatus);
        }

        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getCampaignReviewsListFilter($userID, $filterValue = '', $reviewstatus = '', $columnName = '', $columnSortOrder = '', $start = 1, $rowperpage = 10) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.email, tbl_users.mobile, tbl_users.country, tbl_brandboost.brand_title, tbl_brandboost.brand_desc, tbl_brandboost.brand_img");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->where("tbl_brandboost.user_id", $userID);
        $this->db->order_by("tbl_reviews.id", "DESC");

        if ($filterValue != '') {
            $this->db->like("tbl_reviews.created", $filterValue);
            $this->db->or_like("tbl_reviews.review_title", $filterValue);
            $this->db->or_like("tbl_users.email", $filterValue);
            $this->db->or_where("CONCAT(tbl_users.firstname, ' ', tbl_users.lastname) LIKE '%" . $filterValue . "%'");
        }

        if (!empty($reviewstatus)) {
            $this->db->where("tbl_reviews.status", $reviewstatus);
        }
        $this->db->limit($rowperpage, $start);
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function getBBWidgetUserData($reviewID) {
        $this->db->select("tbl_reviews.campaign_id, tbl_brandboost.user_id, tbl_brandboost_widgets.id as widget_id, tbl_brandboost_widgets.widget_type");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id=tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_brandboost_widgets", "tbl_brandboost.id=tbl_brandboost_widgets.brandboost_id", "LEFT");
        $this->db->where("tbl_reviews.id", $reviewID);
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function countHelpful($reviewID) {
        $result = array();
        $rResponse = DB::table('tbl_reviews_helpful')
        ->where("review_id", $reviewID)->get();
        $yes = 0;
        $no = 0;
        //echo $this->db->last_query();
        if ($rResponse->count() > 0) {
            //$oResult = $rResponse->result();
            foreach ($rResponse as $row) {
                if ($row->helpful_yes == 1) {
                    $yes++;
                } else if ($row->helpful_no == 1) {
                    $no++;
                }
            }
        }
        $result = array('yes' => $yes, 'no' => $no);
        return $result;
    }

    public function countSiteReviewHelpful($reviewID) {
        $result = array();
        $this->db->where("review_id", $reviewID);
        $rResponse = $this->db->get("tbl_site_reviews_helpful");
        $yes = 0;
        $no = 0;
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $oResult = $rResponse->result();
            foreach ($oResult as $row) {
                if ($row->helpful_yes == 1) {
                    $yes++;
                } else if ($row->helpful_no == 1) {
                    $no++;
                }
            }
        }
        $result = array('yes' => $yes, 'no' => $no);
        return $result;
    }

    public function countCommentLike($commentID) {
        $result = array();
        $this->db->where("comment_id", $commentID);
        $rResponse = $this->db->get("tbl_comment_likes");
        $like = 0;
        $dislike = 0;
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $oResult = $rResponse->result();
            foreach ($oResult as $row) {
                if ($row->status == 1) {
                    $like++;
                } else if ($row->status == 0) {
                    $dislike++;
                }
            }
        }
        $result = array('like' => $like, 'dislike' => $dislike);
        return $result;
    }

    public function checkIfVoted($reviewID, $ip) {
        $this->db->where('review_id', $reviewID);
        $this->db->where('ip', $ip);
        $this->db->limit(1);
        $rResponse = $this->db->get("tbl_reviews_helpful");
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $oResult = $rResponse->row();
            if ($oResult->helpful_yes == 1) {
                $action = 'h_yes';
            } else if ($oResult->helpful_no == 1) {
                $action = 'h_no';
            } else {
                $action = 'h_null';
            }
            return array('action' => $action, 'vote_id' => $oResult->id);
        }
        return false;
    }

    public function checkIfSiteVoted($reviewID, $ip) {
        $this->db->where('review_id', $reviewID);
        $this->db->where('ip', $ip);
        $this->db->limit(1);
        $rResponse = $this->db->get("tbl_site_reviews_helpful");
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $oResult = $rResponse->row();
            if ($oResult->helpful_yes == 1) {
                $action = 'h_yes';
            } else if ($oResult->helpful_no == 1) {
                $action = 'h_no';
            } else {
                $action = 'h_null';
            }
            return array('action' => $action, 'vote_id' => $oResult->id);
        }
        return false;
    }

    public function checkIfCommentVoted($commentID, $ip) {
        $this->db->where('comment_id', $commentID);
        $this->db->where('ip', $ip);
        $this->db->limit(1);
        $rResponse = $this->db->get("tbl_comment_likes");
        //echo $this->db->last_query();
        if ($rResponse->num_rows() > 0) {
            $oResult = $rResponse->row();
            if ($oResult->status == 1) {
                $action = 'h_like';
            } else if ($oResult->status == 0) {
                $action = 'h_dislike';
            } else {
                $action = 'h_null';
            }
            return array('action' => $action, 'vote_id' => $oResult->id);
        }
        return false;
    }

    public function getComments($reviewID, $aSettings = array()) {
       $aData =  DB::table('tbl_reviews_comments')
        ->select('tbl_reviews_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile')
        ->leftjoin('tbl_users', 'tbl_reviews_comments.user_id','=','tbl_users.id')
        ->where('tbl_reviews_comments.review_id', $reviewID)
         ->where("tbl_reviews_comments.status", "1")
            ->when((!empty($aSettings['logged']) && !empty($aSettings['logged_id'])), function($query){
            return $query->orWhere("tbl_reviews_comments.status", "2");
            })

        ->orderBy("tbl_reviews_comments.id", "DESC")->get();
       
        return $aData;
    }

    public function getSiteReviewComments($reviewID, $aSettings = array()) {
        $this->db->select("tbl_site_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile");
        $this->db->join("tbl_users", "tbl_site_reviews_comments.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_site_reviews_comments.review_id", $reviewID);
        $this->db->where("tbl_site_reviews_comments.status", "1");
        if (!empty($aSettings['logged']) && !empty($aSettings['logged_id'])) {
            $this->db->or_where("tbl_site_reviews_comments.status", "2");
        }
        $this->db->order_by("tbl_site_reviews_comments.id", "DESC");
        //$this->db->limit(3, 0);
        $rResponse = $this->db->get("tbl_site_reviews_comments");
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    /* public function getComments($reviewID){
      $sql = "SELECT id,
      review_id,
      user_id,
      parent_comment_id
      FROM   (SELECT * FROM   tbl_reviews_comments WHERE  review_id = {$reviewID} ORDER  BY parent_comment_id, id) comments_sorted,
      (SELECT @pv := '0') initialisation
      WHERE  Find_in_set(parent_comment_id, @pv)
      AND Length(@pv := Concat(@pv, ',', id))";
      $rResponse = $this->db->query($sql);
      if ($rResponse->num_rows() > 0) {
      $aData = $rResponse->result();
      }
      return $aData;

      } */

    function displayComments($aComments, $level = 0) {
        foreach ($aComments as $info) {
            echo str_repeat('-', $level + 1) . ' comment ' . $info['id'] . "\n";
            if (!empty($info['childs'])) {
                $this->displayComments($info['childs'], $level + 1);
            }
        }
    }

    public function saveReview($aData) {
        $bSaved = $this->db->insert("tbl_reviews", $aData);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($bSaved)
            return $insert_id;
        return false;
    }

    public function saveSiteReview($aData) {
        $bSaved = $this->db->insert("tbl_reviews_site", $aData);
        if ($bSaved)
            return true;
        return false;
    }

    public function addWidgetData($aData) {
        $bSaved = $this->db->insert("tbl_widget_data", $aData);
        //echo $this->db->last_query();
        if ($bSaved)
            return true;
        return false;
    }

    public function getWidgetData($campaignID) {
        $this->db->where('campaign_id', $campaignID);
        $this->db->from('tbl_widget_data');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addWidgetTrackData($aData) {
        $bSaved = $this->db->insert("tbl_brandboost_widget_tracking_log", $aData);
        //echo $this->db->last_query();
        if ($bSaved)
            return true;
        return false;
    }

    public function getWidgetTrackData($widgetID, $ipAddress, $trackType, $reviewID) {
        $this->db->where('widget_id', $widgetID);
        $this->db->where('ip_address', $ipAddress);
        $this->db->where('track_type', $trackType);
        if ($reviewID != '') {
            $this->db->where('review_id', $reviewID);
        }
        $this->db->from('tbl_brandboost_widget_tracking_log');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    /**
     * Get Number of people currently reading the widget
     * @param type $campaignID
     * @return type
     */
    public function getWidgetCRU($campaignID) {
        $this->db->where('campaign_id', $campaignID);
        $this->db->where('often_user', 1);
        $this->db->where("(created_date > DATE_SUB(NOW(), INTERVAL 1 HOUR))");
        $this->db->from('tbl_widget_data');
        $this->db->group_by("tbl_widget_data.campaign_id");
        $this->db->group_by("tbl_widget_data.user_ip");
        $result = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function saveComment($aData) {
        $bSaved = $this->db->insert("tbl_reviews_comments", $aData);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($bSaved)
            return $insert_id;
        return false;
    }

    public function saveHelpful($aData) {
        $bSaved = $this->db->insert("tbl_reviews_helpful", $aData);
        if ($bSaved)
            return true;
        return false;
    }

    public function saveSiteReviewHelpful($aData) {
        $bSaved = $this->db->insert("tbl_site_reviews_helpful", $aData);
        if ($bSaved)
            return true;
        return false;
    }

    public function saveCommentLike($aData) {
        $bSaved = $this->db->insert("tbl_comment_likes", $aData);
        if ($bSaved)
            return true;
        return false;
    }

    public function updateCommentLike($aData, $id) {
        $this->db->where("id", $id);
        $bUpdated = $this->db->update("tbl_comment_likes", $aData);
        //echo $this->db->last_query();
        if ($bUpdated)
            return true;
        else
            return false;
    }

    public function updateHelpful($aData, $id) {
        $this->db->where("id", $id);
        $bUpdated = $this->db->update("tbl_reviews_helpful", $aData);
        //echo $this->db->last_query();
        if ($bUpdated)
            return true;
        else
            return false;
    }

    public function updateSiteReviewHelpful($aData, $id) {
        $this->db->where("id", $id);
        $bUpdated = $this->db->update("tbl_site_reviews_helpful", $aData);
        //echo $this->db->last_query();
        if ($bUpdated)
            return true;
        else
            return false;
    }

    public function updateSubscriber($aData, $id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            $bUpdated = $this->db->update("tbl_brandboost_users", $aData);
            if ($bUpdated)
                return true;
            else
                return false;
        }
        return false;
    }

    public function getOnsiteReviewDetailsByUID($uniqueId) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, tbl_brandboost_products.product_name, tbl_brandboost_products.product_image, tbl_brandboost_products.created as product_created");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id");
        $this->db->join("tbl_brandboost_products", "tbl_reviews.product_id=tbl_brandboost_products.id");
        $this->db->where("tbl_reviews.unique_review_key", $uniqueId);
        $this->db->order_by("tbl_reviews.id", "ASC");
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        return $aData;
    }

    public function getOnsiteSiteReviewDetailsByUID($uniqueId) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id");
        $this->db->where("tbl_reviews.review_type", 'site');
        $this->db->where("tbl_reviews.unique_review_key", $uniqueId);
        $this->db->order_by("tbl_reviews.id", "ASC");
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        return $aData;
    }

    public function getUserReviews($userID) {
        $this->db->select("tbl_reviews.*, tbl_brandboost.brand_title, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_brandboost.user_id=tbl_users.id");
        //$this->db->group_by("tbl_reviews.campaign_id");
        $this->db->order_by("tbl_reviews.id", "DESC");
        $this->db->where("tbl_reviews.user_id", $userID);
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        return $aData;
    }

    

    public function getContactBranboostReviews($userID) {
       $aData =  DB::table('tbl_reviews')
        ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country', 'tbl_subscribers.id as subscriberId', 'tbl_brandboost.brand_title')
        ->leftjoin('tbl_brandboost', 'tbl_reviews.campaign_id' ,'=', 'tbl_brandboost.id')
        ->join('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
        ->join('tbl_subscribers', 'tbl_subscribers.user_id','=','tbl_users.id')
        ->orderBy('tbl_reviews.id', 'DESC')
        ->where('tbl_reviews.user_id', $userID)
        ->where('tbl_brandboost.delete_status', 0)
        ->get();
       
        return $aData;
    }

    

    public function getReviewNoteByID($noteId) {

        $this->db->where('id', $noteId);
        $this->db->from('tbl_reviews_notes');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateReviewNote($aData, $noteId) {

        $this->db->where('id', $noteId);
        $result = $this->db->update('tbl_reviews_notes', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function getReviewByReviewID($reviewid) {

        $this->db->where('id', $reviewid);
        $this->db->from('tbl_reviews');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReviewDetailsByReviewID($reviewid) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_brandboost.brand_title, tbl_brandboost.brand_desc");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_users.id = tbl_reviews.user_id", "LEFT");
        $this->db->where('tbl_reviews.id', $reviewid);
        $this->db->from('tbl_reviews');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getSiteReviewByReviewID($reviewid) {

        $this->db->where('id', $reviewid);
        $this->db->from('tbl_reviews_site');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getCampReviewsRA($campaignID) {
        $aData = array();
        $this->db->select("tbl_reviews.*");
        $this->db->where("tbl_reviews.campaign_id", $campaignID);
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }

    public function latestReviews($userID = '') {
        $aData = array();
        $this->db->order_by("tbl_reviews.id", "desc");
        $this->db->where('tbl_brandboost.review_type', 'onsite');
        if ($userID != '') {
            $this->db->where('tbl_brandboost.user_id', $userID);
        }
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_users.id = tbl_reviews.user_id", "LEFT");
        $this->db->limit(10);
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        if ($aData)
            return $aData;
        else
            return false;
    }

    public function getCampReviewsCount($campaignID) {
        $aData = array();
        $this->db->select("tbl_reviews.*");
        $this->db->where("tbl_reviews.campaign_id", $campaignID);
        $this->db->order_by("tbl_reviews.id", "DESC");
        //$this->db->group_by('tbl_reviews.user_id');
        $rResponse = $this->db->get("tbl_reviews");
        return $rResponse->num_rows();
        /* if ($rResponse->num_rows() > 0) {
          $aData = $rResponse->result();
          }
          return $aData; */
    }

    public function getCampReviewsResponse($campaignID, $type) {
        $aData = array();
        $this->db->select("tbl_reviews.*, tbl_campaigns.campaign_type");
        $this->db->where("tbl_reviews.campaign_id", $campaignID);
        $this->db->where("tbl_campaigns.campaign_type", $type);
        $this->db->order_by("tbl_reviews.id", "DESC");
        //$this->db->join("tbl_brandboost_events", "tbl_reviews.inviter_id = tbl_brandboost_events.brandboost_id", "LEFT");   
        $this->db->join("tbl_campaigns", "tbl_campaigns.event_id = tbl_reviews.inviter_id", "LEFT");

        $this->db->group_by('tbl_reviews.id');
        $rResponse = $this->db->get("tbl_reviews");
        //return $this->db->last_query();
        return $rResponse->num_rows();
        /* if ($rResponse->num_rows() > 0) {
          $aData = $rResponse->result();
          }
          return $aData; */
    }

    

    public function saveCommentLikeStatus($aData) {
        $bSaved = $this->db->insert("tbl_comment_likes", $aData);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($bSaved)
            return $insert_id;
        return false;
    }

    public function updateCommentLS($aData, $userID, $commentID) {
        $this->db->where('user_id', $userID);
        $this->db->where('comment_id', $commentID);
        $bSaved = $this->db->update("tbl_comment_likes", $aData);
        if ($bSaved)
            return true;
        return false;
    }

    public function getCommentLSByUserIDAndCommentID($userID, $commentID) {
        $this->db->where('user_id', $userID);
        $this->db->where('comment_id', $commentID);
        $this->db->from('tbl_comment_likes');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getCommentLSByCommentID($commentID, $status) {
        $this->db->where('status', $status);
        $this->db->where('comment_id', $commentID);
        $this->db->from('tbl_comment_likes');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    

    public function getAllMainComments($reviewId) {
        $this->db->select("tbl_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.id as userId");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews_comments.user_id=tbl_users.id");
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.review_id", $reviewId);
        $this->db->where("tbl_reviews_comments.parent_comment_id", '0');
        $this->db->where("tbl_reviews_comments.status", '1');
        $oResponse = $this->db->get("tbl_reviews_comments");
        if ($oResponse->num_rows() > 0) {
            $aComments = $oResponse->result();
        }

        return $aComments;
        exit;
    }

    public function getAllChildComments($parentId) {
        $this->db->select("tbl_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.id as userId");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews_comments.user_id=tbl_users.id");
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.status", 1);
        $this->db->where("tbl_reviews_comments.parent_comment_id", $parentId);
        $oResponse = $this->db->get("tbl_reviews_comments");

        if ($oResponse->num_rows() > 0) {
            $aComments = $oResponse->result();
        }

        return $aComments;
        exit;
    }

    public function getReviewAllChildComments($reviewId, $parentId) {
        $this->db->select("tbl_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.id as userId");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews_comments.user_id=tbl_users.id");
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.review_id", $reviewId);
        $this->db->where("tbl_reviews_comments.parent_comment_id", $parentId);
        $oResponse = $this->db->get("tbl_reviews_comments");
        //echo $this->db->last_query();exit;

        if ($oResponse->num_rows() > 0) {
            $aComments = $oResponse->result();
        }

        return $aComments;
        exit;
    }

}
