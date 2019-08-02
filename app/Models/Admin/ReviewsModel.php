<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ReviewsModel extends Model
{
     $this->db->select("tbl_brandboost.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.address as user_address, tbl_users.city as user_city, tbl_users.country as user_country");
        $this->db->join("tbl_users", "tbl_brandboost.user_id=tbl_users.id", "LEFT");
        if($hash == true){
            $this->db->where("tbl_brandboost.hashcode", $campaignID);
        }else{
            $this->db->where("tbl_brandboost.id", $campaignID);
        }
        $rResponse = $this->db->get("tbl_brandboost");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->row();
        }
        return $aData;
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
	

    /**
    * This function is used to get the product type
    * @return type
    */


	public function getReviewsByProductType($campaignID, $aSettings = array(), $productType='product') {
         $start = !empty($aSettings['start']) ? $aSettings['start'] : 0;

        $aData =  DB::table('tbl_reviews')
        ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_brandboost.brand_title')
        ->leftJoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
        ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id','=','tbl_brandboost.id')
         ->where("tbl_reviews.campaign_id", $campaignID)
        ->where("tbl_reviews.review_type", $productType)
        ->where("tbl_reviews.status", '1')
        ->when(!empty($aSettings['logged']) && !empty($aSettings['logged_id']), function($query){
           return $query->orWhere("tbl_reviews.status", '2');
        })
         ->when(!empty($aSettings) && !empty($aSettings['min_ratings']),function($query) use ($aSettings['min_ratings']) {
           return $query->orWhere('tbl_reviews.ratings >=', $aSettings['min_ratings']);
        })
          ->when(!empty($aSettings) && !empty($aSettings['review_limit'])),function($query) use ($start) {
           return $query->limit($aSettings['review_limit'], $start);
        })

        ->orderBy("tbl_reviews.id", "DESC")->get();
      
        return $aData;
    }

    public function getMultiReviews($multiCampaignID, $aSettings = array()) {

        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id=tbl_brandboost.id", "LEFT");
        $this->db->where_in("tbl_reviews.campaign_id", $multiCampaignID);
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

    public function getCampaignReviews($campaignID) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, tbl_users.country, tbl_subscribers.id as subscriberId, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_subscribers.user_id=tbl_users.id", "LEFT");
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
	
	public function getCampaignAllReviews($campaignID) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, tbl_users.country, tbl_subscribers.id as subscriberId, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_subscribers.user_id=tbl_users.id", "LEFT");
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
	
	public function getActiveCampaignReviewsByType($campaignID, $type='product') {
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
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, tbl_users.country, tbl_subscribers.id as subscriberId, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_subscribers.user_id=tbl_users.id", "LEFT");
        if (!empty($userId)) {
            $this->db->where("tbl_reviews.user_id", $userId);
        }
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
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

    public function getCampaignReviewsDetail($campaignID = '', $userID='') {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.email, tbl_users.mobile, tbl_users.country, tbl_brandboost.brand_title, tbl_brandboost.brand_desc, tbl_brandboost.brand_img");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        if (!empty($campaignID)) {
            $this->db->where("tbl_reviews.campaign_id", $campaignID);
        }
        
        if(!empty($userID)){
            $this->db->where("tbl_brandboost.user_id", $userID);
        }
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");

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
		
		if($filterValue != ''){
			$this->db->like("tbl_reviews.created", $filterValue);
			$this->db->or_like("tbl_reviews.review_title", $filterValue); 
			$this->db->or_like("tbl_users.email", $filterValue);
			$this->db->or_where("CONCAT(tbl_users.firstname, ' ', tbl_users.lastname) LIKE '%".$filterValue."%'");
		}

        if(!empty($reviewstatus)) {
            $this->db->where("tbl_reviews.status", $reviewstatus);
        }
		
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }
	
	public function getCampaignReviewsListFilter($userID, $filterValue='', $reviewstatus='', $columnName='', $columnSortOrder='', $start=1, $rowperpage=10){
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.email, tbl_users.mobile, tbl_users.country, tbl_brandboost.brand_title, tbl_brandboost.brand_desc, tbl_brandboost.brand_img");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");   
        $this->db->where("tbl_brandboost.user_id", $userID);
        $this->db->order_by("tbl_reviews.id", "DESC");
		
		if($filterValue != ''){
			$this->db->like("tbl_reviews.created", $filterValue);
			$this->db->or_like("tbl_reviews.review_title", $filterValue); 
			$this->db->or_like("tbl_users.email", $filterValue);
			$this->db->or_where("CONCAT(tbl_users.firstname, ' ', tbl_users.lastname) LIKE '%".$filterValue."%'");
		}

        if(!empty($reviewstatus)) {
            $this->db->where("tbl_reviews.status", $reviewstatus);
        }
		$this->db->limit($rowperpage, $start);
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
        return $aData;
    }
	
	public function getBBWidgetUserData($reviewID){
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
        $this->db->where("review_id", $reviewID);
        $rResponse = $this->db->get("tbl_reviews_helpful");
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
        $this->db->select("tbl_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile");
        $this->db->join("tbl_users", "tbl_reviews_comments.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_reviews_comments.review_id", $reviewID);
        $this->db->where("tbl_reviews_comments.status", "1");
        if (!empty($aSettings['logged']) && !empty($aSettings['logged_id'])) {
            $this->db->or_where("tbl_reviews_comments.status", "2");
        }
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        //$this->db->limit(3, 0);
        $rResponse = $this->db->get("tbl_reviews_comments");
        if ($rResponse->num_rows() > 0) {
            $aData = $rResponse->result();
        }
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
		if($reviewID != ''){
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

    public function getMyReviews($userID) {
        $this->db->select("tbl_reviews.id AS reviewid, tbl_reviews.review_type AS reviewtype, tbl_reviews.created AS review_created, tbl_reviews.status AS rstatus, tbl_reviews.*, tbl_brandboost.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_brandboost.user_id=tbl_users.id");
        //$this->db->group_by("tbl_reviews.campaign_id");
        $this->db->order_by("reviewid", "DESC");
        $this->db->where("tbl_reviews.user_id", $userID);
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        return $aData;
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
	
	public function getMyReviewsByFilter($userID, $filterValue='', $columnName='id', $columnSortOrder='DESC', $start='1', $limit='10') {
        $this->db->select("tbl_reviews.id AS reviewid, tbl_reviews.review_type AS reviewtype, tbl_reviews.created AS review_created, tbl_reviews.status AS rstatus, tbl_reviews.*, tbl_brandboost.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_brandboost.user_id=tbl_users.id");
		
		if($columnName != ''){
			$this->db->order_by("tbl_reviews.".$columnName, $columnSortOrder);
		}else{
			$this->db->order_by("tbl_reviews.id", 'DESC');
		}
        $this->db->where("tbl_reviews.user_id", $userID);
		
		if($filterValue != ''){
			$this->db->where("tbl_reviews.created", $filterValue);
			$this->db->where("tbl_brandboost.brand_title", $filterValue);
			$this->db->where("tbl_reviews.review_title", $filterValue);
			$this->db->where("tbl_reviews.rating", $filterValue);
		}
		
		$this->db->limit($limit, $start);
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
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

    public function getMyBranboostReviews($userID, $filterValue='', $reviewstatus='', $reviewcategory='') {
        $this->db->select("tbl_reviews.id AS reviewid, tbl_reviews.review_type AS reviewtype, tbl_reviews.created AS review_created, "
                . "tbl_reviews.status AS rstatus, tbl_reviews.*, tbl_brandboost.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, "
                . "tbl_users.mobile, tbl_users.avatar, tbl_users.country as userCountry");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id");
        //$this->db->group_by("tbl_reviews.campaign_id");
        $this->db->order_by("reviewid", "DESC");
        $this->db->where("tbl_brandboost.user_id", $userID);
        $this->db->where("tbl_brandboost.delete_status", 0);

        if($filterValue != ''){
            $this->db->like("tbl_reviews.created", $filterValue);
            $this->db->or_like("tbl_brandboost.brand_title", $filterValue);
            $this->db->or_like("tbl_reviews.review_title", $filterValue);
            $this->db->or_like("tbl_reviews.ratings", $filterValue); 
            //$this->db->or_like("tbl_users.firstname", $filterValue);
            //$this->db->or_like("tbl_users.lastname", $filterValue);
            $this->db->or_like("tbl_users.email", $filterValue);
            $this->db->or_where("CONCAT(tbl_users.firstname, ' ', tbl_users.lastname) LIKE '%".$filterValue."%'");
        }

        if(!empty($reviewstatus)) {
            $this->db->where("tbl_reviews.status", $reviewstatus);
        }

        if(!empty($reviewcategory)) {
            if($reviewcategory >= 4) {
                $this->db->where("tbl_reviews.ratings >=", $reviewcategory);
            }
            else if($reviewcategory == 3) {
                $this->db->where("tbl_reviews.ratings ", $reviewcategory);
            }
            else {
                $this->db->where("tbl_reviews.ratings <", $reviewcategory);
            }
        }

        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        return $aData;
    }
	
	
	public function getMyBranboostReviewsFilter($userID, $filterValue='', $reviewstatus='', $reviewcategory='', $columnName='', $columnSortOrder='DESC', $start=1, $limit=10) {
        $this->db->select("tbl_reviews.id AS reviewid, tbl_reviews.review_type AS reviewtype, tbl_reviews.created AS review_created, "
                . "tbl_reviews.status AS rstatus, tbl_reviews.*, tbl_brandboost.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, "
                . "tbl_users.mobile, tbl_users.avatar, tbl_users.country as userCountry");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id");
		
		/*if($columnName != ''){
			$this->db->order_by("tbl_reviews.".$columnName, $columnSortOrder);
		}else{
			$this->db->order_by("tbl_users.firstname", "DESC");
		}*/
		
        $this->db->where("tbl_brandboost.user_id", $userID);
        $this->db->where("tbl_brandboost.delete_status", 0);
		
		if($filterValue != ''){
			$this->db->like("tbl_reviews.created", $filterValue);
			$this->db->or_like("tbl_brandboost.brand_title", $filterValue);
			$this->db->or_like("tbl_reviews.review_title", $filterValue);
			$this->db->or_like("tbl_reviews.ratings", $filterValue); 
			$this->db->or_like("tbl_users.email", $filterValue);
			$this->db->or_where("CONCAT(tbl_users.firstname, ' ', tbl_users.lastname) LIKE '%".$filterValue."%'");
		}

        if(!empty($reviewstatus)) {
            $this->db->where("tbl_reviews.status", $reviewstatus);
        }

        if(!empty($reviewcategory)) {
            if($reviewcategory >= 4) {
                $this->db->where("tbl_reviews.ratings >=", $reviewcategory);
            }
            else if($reviewcategory == 3) {
                $this->db->where("tbl_reviews.ratings ", $reviewcategory);
            }
            else {
                $this->db->where("tbl_reviews.ratings <=", $reviewcategory);
            }
        }
		
		$this->db->limit($limit, $start);
		
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        return $aData;
    }
	
	
    public function getContactBranboostReviews($userID) {
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, tbl_users.country, tbl_subscribers.id as subscriberId, tbl_brandboost.brand_title");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_subscribers", "tbl_subscribers.user_id=tbl_users.id", "LEFT");
        //$this->db->group_by("tbl_reviews.campaign_id");
        $this->db->order_by("tbl_reviews.id", "DESC");
        $this->db->where("tbl_reviews.user_id", $userID);
        $this->db->where("tbl_brandboost.delete_status", 0);
        $oResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        return $aData;
    }

    public function deleteReviewByID($reviewID) {
        $this->db->where('id', $reviewID);
        $result = $this->db->delete('tbl_reviews');
        return true;
    }

    public function deleteReviewNoteByID($noteId) {
        $this->db->where('id', $noteId);
        $result = $this->db->delete('tbl_reviews_notes');
        return true;
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

    public function updateReview($aData, $reviewID) {

        $this->db->where('id', $reviewID);
        $result = $this->db->update('tbl_reviews', $aData);
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
            return false;
    }

    public function getCampReviews($campaignID) {
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

    public function listReviewNotes($id) {
        if (!empty($id)) {
            $this->db->select("tbl_reviews_notes.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email");
            $this->db->join("tbl_users", "tbl_reviews_notes.user_id=tbl_users.id", "LEFT");
            $this->db->where("tbl_reviews_notes.review_id", $id);
            $this->db->order_by("tbl_reviews_notes.id", "DESC");
            $result = $this->db->get("tbl_reviews_notes");
            //echo $this->db->last_query();
            //die;
            if ($result->num_rows() > 0) {
                $response = $result->result();
            }
            return $response;
        }
    }

    public function getReviewInfo($id) {
        $this->db->select("tbl_brandboost.brand_title, tbl_brandboost.id AS bbId, tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.created as user_joining_date, tbl_users.avatar");
        $this->db->join("tbl_users", "tbl_users.id=tbl_reviews.user_id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id=tbl_brandboost.id", "LEFT");
        $this->db->where("tbl_reviews.id", $id);
        $result = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();
        //die;
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function saveReviewNotes($aData) {
        $bSaved = $this->db->insert("tbl_reviews_notes", $aData);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($bSaved)
            return $insert_id;
        return false;
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

    public function getReviewAllComments($reviewId, $start = 0, $limit = 5) {
        $this->db->select("tbl_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.id as userId");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews_comments.user_id=tbl_users.id");
        $this->db->limit($limit, $start);
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.review_id", $reviewId);
        $oResponse = $this->db->get("tbl_reviews_comments");
        //echo $this->db->last_query();exit;

        if ($oResponse->num_rows() > 0) {
            $aComments = $oResponse->result();
        }

        return $aComments;
        exit;
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

    public function getReviewAllParentsComments($reviewId, $start = 0, $limit = 5) {
        $this->db->select("tbl_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.id as userId");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews_comments.user_id=tbl_users.id");
        $this->db->limit($limit, $start);
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.review_id", $reviewId);
        $this->db->where("tbl_reviews_comments.parent_comment_id", '0');
        $oResponse = $this->db->get("tbl_reviews_comments");
        //echo $this->db->last_query();exit;

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

    public function parentsCommentsCount($reviewId) {
        $this->db->select("tbl_reviews_comments.*, tbl_users.firstname, tbl_users.lastname, tbl_users.avatar, tbl_users.id as userId");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_users", "tbl_reviews_comments.user_id=tbl_users.id");
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.review_id", $reviewId);
        $this->db->where("tbl_reviews_comments.parent_comment_id", '0');
        $oResponse = $this->db->get("tbl_reviews_comments");

        return $oResponse->num_rows();
        exit;
    }
}
