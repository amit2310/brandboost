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
    public static function getCampaignReviewsDetail($campaignID = '', $userID = '', $pagination=false) {
        if($pagination == false){
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
                ->where('tbl_reviews.media_url', '!=', 'a:0:{}')
                ->orderBy('tbl_reviews.id', 'desc')
                ->get();
        }else{
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
                ->where('tbl_reviews.media_url', '!=', 'a:0:{}')
                ->orderBy('tbl_reviews.id', 'desc')
                ->paginate(10);

        }
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
                //->get();
                ->paginate(10);
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
	public function getCampaignAllReviews($campaignID, $displayAll=false) {
		if($displayAll == false){
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
                ->groupBy('tbl_reviews.id')
                ->paginate(10);
            //->get();
        }else{
            $oData = DB::table('tbl_reviews')
                ->leftJoin('tbl_users', 'tbl_reviews.user_id', '=', 'tbl_users.id')
                ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
                ->leftJoin('tbl_subscribers', 'tbl_subscribers.user_id', '=', 'tbl_users.id')
                ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country', 'tbl_subscribers.id as subscriberId', 'tbl_brandboost.brand_title')
                ->where('tbl_reviews.status', 1)
                ->when(!empty($campaignID), function ($query) use ($campaignID) {
                    return $query->where('tbl_reviews.campaign_id', $campaignID);
                })
                ->groupBy('tbl_reviews.id')
                ->orderBy('tbl_reviews.id', 'desc')
            ->get();
        }

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
			//->get();
            ->paginate(10);
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
	public static function getBrandBoostCampaign($campaignID, $hash = false) {
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

        return true;
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
			->select('tbl_brandboost.brand_title', 'tbl_brandboost.id AS bbId', 'tbl_brandboost.logo_img', 'tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.created as user_joining_date', 'tbl_users.avatar')
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

    /**
     * Get campaign's review five star ratings
     * @param type $brandboostID
     * @return type
     */
    public static function getCampReviewsWithFiveRatings($brandboostID) {
            $oData = DB::table('tbl_brandboost')
                ->leftJoin('tbl_reviews', 'tbl_brandboost.id', '=', 'tbl_reviews.campaign_id')
                ->leftJoin('tbl_users as ut', 'tbl_reviews.user_id', '=', 'ut.id')
                ->leftJoin('tbl_users as tu', 'tbl_brandboost.user_id', '=', 'tu.id')
                ->select('tbl_brandboost.*', 'ut.firstname', 'ut.lastname', 'ut.email', 'tu.firstname as bb_u_firstname', 'tu.lastname as bb_u_lastname', 'tu.email as bb_u_email', 'tbl_reviews.comment_text', 'tbl_reviews.ratings', 'tbl_reviews.id as reviewId')
                ->where('tbl_brandboost.id', $brandboostID)
                ->where('tbl_reviews.ratings', 5)
                ->where('tbl_reviews.status', 1)
                ->where('tbl_reviews.review_type', 'text')
                ->orderBy('tbl_reviews.id', 'desc')
                ->get();
            return $oData;
    }

    /**
     * Get campaigns review four star ratings
     * @param type $brandboostID
     * @return type
     */
    public static function getCampReviewsWithFourRatings($brandboostID) {
        $oData = DB::table('tbl_brandboost')
                ->leftJoin('tbl_reviews', 'tbl_brandboost.id', '=', 'tbl_reviews.campaign_id')
                ->leftJoin('tbl_users as ut', 'tbl_reviews.user_id', '=', 'ut.id')
                ->leftJoin('tbl_users as tu', 'tbl_brandboost.user_id', '=', 'tu.id')
                ->select('tbl_brandboost.*', 'ut.firstname', 'ut.lastname', 'ut.email', 'tu.firstname as bb_u_firstname', 'tu.lastname as bb_u_lastname', 'tu.email as bb_u_email', 'tbl_reviews.comment_text', 'tbl_reviews.ratings', 'tbl_reviews.id as reviewId')
                ->where('tbl_brandboost.id', $brandboostID)
                ->where('tbl_reviews.ratings', 4)
                ->where('tbl_reviews.status', 1)
                ->where('tbl_reviews.review_type', 'text')
                ->orderBy('tbl_reviews.id', 'desc')
                ->get();
            return $oData;
    }

    /**
     * Get Top star review ratings
     * @param type $brandboostID
     * @return type
     */
    public static function getCampReviewsWithTopRatings($brandboostID) {
        $oData = DB::table('tbl_brandboost')
                ->leftJoin('tbl_reviews', 'tbl_brandboost.id', '=', 'tbl_reviews.campaign_id')
                ->leftJoin('tbl_users as ut', 'tbl_reviews.user_id', '=', 'ut.id')
                ->leftJoin('tbl_users as tu', 'tbl_brandboost.user_id', '=', 'tu.id')
                ->select('tbl_brandboost.*', 'ut.firstname', 'ut.lastname', 'ut.email', 'tu.firstname as bb_u_firstname', 'tu.lastname as bb_u_lastname', 'tu.email as bb_u_email', 'tbl_reviews.comment_text', 'tbl_reviews.ratings', 'tbl_reviews.id as reviewId')
                ->where('tbl_brandboost.id', $brandboostID)
                ->where('tbl_reviews.status', 1)
                ->where('tbl_reviews.review_type', 'text')
                ->orderBy('tbl_reviews.ratings', 'desc')
                ->limit(5)
                ->get();
            return $oData;

    }

    /**
     * Get user reviews
     * @param type $userID
     * @return type object
     */
    public function getUserReviews($userID) {

        $oData = DB::table('tbl_reviews')
                ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
                ->join('tbl_users', 'tbl_brandboost.user_id', '=', 'tbl_users.id')
                ->select('tbl_reviews.*', 'tbl_brandboost.brand_title', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
                ->where('tbl_reviews.user_id', $userID)

                ->orderBy('tbl_reviews.id', 'desc')
                ->get();
            return $oData;
    }

	/**
     * Used to get brandboost reviews contacts by user id
     * @param type $userID
     * @return type
     */
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

	/**
     * Used to get reviews by review id
     * @param type $reviewid
     * @return type
     */
	public static function getReviewByReviewID($reviewid) {
        $aData =  DB::table('tbl_reviews')
            ->where('id', $reviewid)->get();
        return $aData;
    }

	/**
     * Used to get reviews details by review id
     * @param type $reviewid
     * @return type
     */
    public static function getReviewDetailsByReviewID($reviewid) {
		$aData =  DB::table('tbl_reviews')
			->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc')
			->leftjoin('tbl_brandboost', 'tbl_reviews.campaign_id' ,'=', 'tbl_brandboost.id')
			->leftjoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
			->where('tbl_reviews.id', $reviewid)
			->get();
        return $aData;

    }


	/**
     * Used to get comment by comment id
     * @param type $commentID, $status
     * @return type object
     */
	 public static function getCommentLSByCommentID($commentID, $status) {

        $oData = DB::table('tbl_comment_likes')
            ->where('status', $status)
            ->where('comment_id', $commentID)
            ->get();

        return $oData;
    }

    /**
     * Used to get review all child comments
     * @param type $reviewId, $parentId
     * @return type object
     */
    public static function getReviewAllChildComments($reviewId, $parentId) {

        $oData = DB::table('tbl_reviews_comments')
            ->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=' , 'tbl_reviews.id')
            ->Join('tbl_users', 'tbl_reviews_comments.user_id', '=' , 'tbl_users.id')
            ->select('tbl_reviews_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.id as userId')
            ->where("tbl_reviews_comments.review_id", $reviewId)
            ->where("tbl_reviews_comments.parent_comment_id", $parentId)
            ->orderBy("tbl_reviews_comments.id", "DESC")
            ->get();
        return $oData;
    }


    /**
     * Used to update comment
     * @param type $aData, $userID, $commentID
     * @return type object
     */
    public function updateCommentLS($aData, $userID, $commentID) {

        $oData = DB::table('tbl_comment_likes')
                ->where('user_id', $userID)
                ->where('comment_id', $commentID)
                ->update($aData);
        return true;
    }


    /**
     * Used to save comment like status
     * @param type $aData
     * @return type insert id
     */
    public function saveCommentLikeStatus($aData) {

        $insert_id = DB::table('tbl_comment_likes')->insertGetId($aData);
        return $insert_id;
    }


	public function getWidgetTrackData($widgetID, $ipAddress, $trackType, $reviewID) {
		$oData = DB::table('tbl_brandboost_widget_tracking_log')
			->when(($reviewID > 0), function($query) use($reviewID) {
				return $query->where('review_id', $reviewID);
			})
			->where('widget_id', $widgetID)
			->where('ip_address', $ipAddress)
			->where('track_type', $trackType)
			->get();
        return $oData;
    }


	public function addWidgetTrackData($aData) {
		$bSaved = DB::table('tbl_brandboost_widget_tracking_log')->insertGetId($aData);
        if ($bSaved)
            return true;
        return false;
    }


	public function getAllActiveReviews($campaignID, $aSettings = array()) {
		$oData = DB::table('tbl_reviews')
			->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_brandboost.brand_title')
			->when(!empty($aSettings), function($query) use($aSettings) {
				return $query->where('tbl_reviews.ratings', '>=', $aSettings['min_ratings']);
			})
			->leftJoin('tbl_users', 'tbl_reviews.user_id', '=' , 'tbl_users.id')
			->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=' , 'tbl_brandboost.id')
            ->orderBy("tbl_reviews.id", "DESC")
			->where('tbl_reviews.campaign_id', $campaignID)
			->where('tbl_reviews.status', 1)
			->get();
        return $oData;
    }


    public function getReviews($campaignID, $aSettings = array()) {
		$start = !empty($aSettings['start']) ? $aSettings['start'] : 0;
		$aData =  DB::table('tbl_reviews')
			->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_brandboost.brand_title')
			->leftjoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
			->leftjoin('tbl_brandboost', 'tbl_reviews.campaign_id','=','tbl_brandboost.id')
			->where('tbl_reviews.campaign_id', $campaignID)
			->where('tbl_reviews.status', '1')
			->when((!empty($aSettings['logged']) && !empty($aSettings['logged_id'])), function($query){
				return $query->orWhere("tbl_reviews.status", '2');
			})
			->when((!empty($aSettings) && !empty($aSettings['min_ratings'])), function($query) use ($aSettings){
				return $query->orWhere('tbl_reviews.ratings','>=',$aSettings['min_ratings']);
			})
			->when((!empty($aSettings) && !empty($aSettings['review_limit'])), function($query) use ($aSettings, $start){
				return $query->limit($aSettings['review_limit'], $start);
			})
			->orderBy("tbl_reviews.id", "DESC")
			->get();

        return $aData;
    }


    /**
     * This function is used to get the Reviews by the product type
     * @param $campaignID
     * @param array $aSettings
     * @param string $productType
     * @return type
     */
    public function getReviewsByProductType($campaignID, $aSettings = array(), $productType='product') {
        $start = !empty($aSettings['start']) ? $aSettings['start'] : 0;

        $aData =  DB::table('tbl_reviews')
			->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_brandboost.brand_title')
			->leftjoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
			->leftjoin('tbl_brandboost', 'tbl_reviews.campaign_id','=','tbl_brandboost.id')
			->where("tbl_reviews.campaign_id", $campaignID)
			->where("tbl_reviews.review_type", $productType)
			->where("tbl_reviews.status", '1')
			->when(!empty($aSettings['logged']) && !empty($aSettings['logged_id']), function($query){
			   return $query->orWhere("tbl_reviews.status", '2');
			})
			 ->when(!empty($aSettings) && !empty($aSettings['min_ratings']),function($query) use ($aSettings) {
			   return $query->orWhere('tbl_reviews.ratings','>=',$aSettings['min_ratings']);
			})
			  ->when(!empty($aSettings) && isset($aSettings['review_limit']),function($query) use ($aSettings, $start) {
			   return $query->limit($aSettings['review_limit'], $start);
			})

			->orderBy("tbl_reviews.id", "DESC")->get();

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
        ->leftjoin('tbl_brandboost', 'tbl_reviews.campaign_id','=','tbl_brandboost.id')
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

    /**
    * Used to check if voted
    * @param type $reviewID
    * @param type $ip
    * @return type object
    */
    public function checkIfVoted($reviewID, $ip) {

        $oResult = DB::table('tbl_reviews_helpful')
            ->where('review_id', $reviewID)
            ->where('ip', $ip)
            ->first();
        if(!empty($oResult)) {
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


	/**
	* Used to get the multireviews for campaign id
	* @param type $companyName
	* @return username
	*/
	public static function getAllReviewsByUserId($userId) {
		$aData =  DB::table('tbl_reviews')
			->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country', 'tbl_subscribers.id as subscriberId', 'tbl_brandboost.brand_title')
			->leftjoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
			->leftjoin('tbl_brandboost', 'tbl_reviews.campaign_id','=','tbl_brandboost.id')
			->leftjoin('tbl_subscribers', 'tbl_subscribers.user_id','=','tbl_users.id')
			->where('tbl_reviews.status', '1')
			->where('tbl_brandboost.user_id', $userId)
			->orderBy("tbl_reviews.id", "DESC")
			->get();

        return $aData;
    }


	public function countCommentLike($commentID) {
		$rResponse =  DB::table('tbl_comment_likes')
			->where('comment_id', $commentID)
			->get();

        $like = 0;
        $dislike = 0;
        if ($rResponse->count() > 0) {
            foreach ($rResponse as $row) {
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


	public function getSiteReviews($campaignID, $aSettings = array()) {
		$start = !empty($aSettings['start']) ? $aSettings['start'] : 0;
        $aData =  DB::table('tbl_reviews_site')
        ->select('tbl_reviews_site.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile')
        ->leftjoin('tbl_users', 'tbl_reviews_site.user_id','=','tbl_users.id')
        ->where('tbl_reviews_site.campaign_id', $campaignID)
        ->where('tbl_reviews_site.status', '1')
        ->when((!empty($aSettings['logged']) && !empty($aSettings['logged_id'])), function($query){
         return $query->orWhere("tbl_reviews.status", '2');
        })
         ->when((!empty($aSettings) && !empty($aSettings['min_ratings'])), function($query) use ($aSettings){
         return $query->orWhere('tbl_reviews.ratings','>=',$aSettings['min_ratings']);
        })
         ->when((!empty($aSettings) && !empty($aSettings['review_limit'])), function($query) use ($aSettings,$start){
         return $query->limit($aSettings['review_limit'], $start);
        })
        ->orderBy("tbl_reviews_site.id", "DESC")
		->get();

        return $aData;
    }



    public function getActiveCampaignReviewsByType($campaignID, $type = 'product') {
		$aData =  DB::table('tbl_reviews')
			->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users.country', 'tbl_subscribers.id as subscriberId', 'tbl_brandboost.brand_title')
			->leftjoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
			->leftjoin('tbl_brandboost', 'tbl_reviews.campaign_id','=','tbl_brandboost.id')
			->leftjoin('tbl_subscribers', 'tbl_subscribers.user_id','=','tbl_users.id')
			->where('tbl_reviews.status', '1')
			->where('tbl_brandboost.review_type', $type)
			->when(!empty($campaignID), function($query) use ($campaignID){
				return $query->where('tbl_reviews.campaign_id',$campaignID);
			})
			->orderBy("tbl_reviews.id", "DESC")
			->get();

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


	public function getWidgetData($campaignID) {
		$aData =  DB::table('tbl_widget_data')
			->where('campaign_id', $campaignID)
			->get();

        return $aData;
    }


	public function addWidgetData($aData) {
		$bSaved = DB::table('tbl_widget_data')->insertGetId($aData);
        if ($bSaved)
            return true;
        return false;
    }


	/**
     * Get Number of people currently reading the widget
     * @param type $campaignID
     * @return type
     */
    public function getWidgetCRU($campaignID) {
		$aData =  DB::table('tbl_widget_data')
			->where('campaign_id', $campaignID)
			->where('often_user', 1)
			->where("created_date",  ">",  DB::raw("DATE_SUB(NOW(), INTERVAL 1 HOUR)"))
			->groupBy('tbl_widget_data.campaign_id')
			->groupBy('tbl_widget_data.user_ip')
			->get();

        return $aData;
    }


    public function saveComment($aData) {
        $aData =  DB::table('tbl_reviews_comments')->insertGetId($aData);
        return $aData;

    }


    public function saveSiteReviewHelpful($aData) {
        $aData =  DB::table('tbl_site_reviews_helpful')->insertGetId($aData);
        return $aData;
    }

    public function saveCommentLike($aData) {
        $aData =  DB::table('tbl_comment_likes')->insertGetId($aData);
        return $aData;
    }

    public function updateCommentLike($aData, $id) {
        $aData =  DB::table('tbl_comment_likes')->update($aData)
           ->where("id", $id);
           return true;
    }


    public function updateSiteReviewHelpful($aData, $id) {
         $aData =  DB::table('tbl_site_reviews_helpful')->update($aData)
           ->where("id", $id);
           return true;
    }

    public function updateSubscriber($aData, $id) {
        if ($id > 0) {
            $aData =  DB::table('tbl_brandboost_users')->update($aData)
           ->where("id", $id);
           return true;
        }
        return false;
    }


	public function getAllChildComments($parentId) {
		$oData = DB::table('tbl_reviews_comments')
            ->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=', 'tbl_reviews.id')
            ->leftJoin('tbl_users', 'tbl_reviews_comments.user_id', '=', 'tbl_users.id')
            ->select('tbl_reviews_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.id as userId')
            ->where('tbl_reviews_comments.status', 1)
            ->where('tbl_reviews_comments.parent_comment_id', $parentId)
            ->orderBy('tbl_reviews_comments.id', 'desc')
            ->get();
        return $oData;
    }


	public static function countHelpful($reviewID) {
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


	/**
    * This function is used to save the reviews
    * @param type $clientID
    * @return type
    */
    public function saveReview($aData) {
        $oData = DB::table('tbl_reviews')
        ->insertGetId($aData);
        if (!empty($oData))
            return $oData;
        return false;
    }

    /**
    * This function is used to save the save helpful
    * @param type $clientID
    * @return type
    */
    public function saveHelpful($aData) {
        $oData = DB::table('tbl_reviews_helpful')
        ->insertGetId($aData);
        if (!empty($oData))
            return $oData;
        return false;
    }

    /**
    * This function is used to update
    * @param type $clientID
    * @return type
    */
    public function updateHelpful($aData, $id) {
        $res = DB::table('tbl_reviews_helpful')
                ->where("id", $id)
                ->update($aData);

        return true;
    }


    /**
    * Cet comment by user id and commnet id
    * @param type $clientID
    * @return type
    */
    public function getCommentLSByUserIDAndCommentID($userID, $commentID) {
        $res = DB::table('tbl_comment_likes')
                ->where('user_id', $userID)
                ->where('comment_id', $commentID)
                ->get();
        return $res;
    }


	/**
     *
     * @param type $campaignID
     * @return type
     */
    public static function getCampReviewsRA($campaignID) {
        $oData = DB::table('tbl_reviews')
            ->where('campaign_id', $campaignID)
            ->orderBy('id', 'desc')
            ->get();
        return $oData;
    }

	/**
    * This function is used to get the review notes by the notes id
    * @param type $noteId
    * @return type
    */
    public function getReviewNoteByID($noteId) {
       $oData = DB::table('tbl_reviews_notes')
        ->where('id', $noteId)->get();
        return $oData;

    }


    public function updateReviewNote($aData, $noteId) {
        $oData = DB::table('tbl_reviews_notes')
        ->where('id', $noteId)->update($aData);
        return true;
    }


    /**
     * Get Reviews count
     * @param type $campaignID
     * @return type
     */
    public static function getCampReviewsCount($campaignID) {
        $oData = DB::table('tbl_reviews')
        ->where('campaign_id', $campaignID)
        ->count();
        return $oData;
    }


    /**
     * Get campaign review response
     * @param type $campaignID
     * @param type $type
     * @return type
     */
    public static function getCampReviewsResponse($campaignID, $type) {
        $oData = DB::table('tbl_reviews')
            ->leftJoin('tbl_campaigns', 'tbl_campaigns.event_id', '=', 'tbl_reviews.inviter_id')
            ->select('tbl_reviews.*', 'tbl_campaigns.campaign_type')
            ->where('tbl_reviews.campaign_id', $campaignID)
            ->where('tbl_campaigns.campaign_type', $type)
            ->orderBy('tbl_reviews.id', 'desc')
            ->groupBy('tbl_reviews.id')
            ->count();
        return $oData;
    }


    public function getAllMainComments($reviewId) {
		$oData = DB::table('tbl_reviews_comments')
            ->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=', 'tbl_reviews.id')
            ->leftJoin('tbl_users', 'tbl_reviews_comments.user_id', '=', 'tbl_users.id')
            ->select('tbl_reviews_comments.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar', 'tbl_users.id as userId')
            ->where('tbl_reviews_comments.review_id', $reviewId)
            ->where('tbl_reviews_comments.status', 1)
            ->where('tbl_reviews_comments.parent_comment_id', 0)
            ->orderBy('tbl_reviews_comments.id', 'desc')
            ->get();
        return $oData;
    }


	public function getBBWidgetUserData($reviewID) {
		$oData = DB::table('tbl_reviews')
            ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
            ->leftJoin('tbl_brandboost_widgets', 'tbl_brandboost.id', '=', 'tbl_brandboost_widgets.brandboost_id')
            ->select('tbl_reviews.campaign_id', 'tbl_brandboost.id', 'tbl_brandboost_widgets.id as widget_id', 'tbl_brandboost_widgets.widget_type')
            ->where('tbl_reviews.id', $reviewID)
            ->get();
        return $oData;

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



    public function countSiteReviewHelpful($reviewID) {
        $result = array();
        $this->db->where("review_id", $reviewID);
        $rResponse = $this->db->get("tbl_site_reviews_helpful");
        $yes = 0;
        $no = 0;
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


    public function checkIfSiteVoted($reviewID, $ip) {
        $this->db->where('review_id', $reviewID);
        $this->db->where('ip', $ip);
        $this->db->limit(1);
        $rResponse = $this->db->get("tbl_site_reviews_helpful");
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


	function displayComments($aComments, $level = 0) {
        foreach ($aComments as $info) {
            echo str_repeat('-', $level + 1) . ' comment ' . $info['id'] . "\n";
            if (!empty($info['childs'])) {
                $this->displayComments($info['childs'], $level + 1);
            }
        }
    }


    public function saveSiteReview($aData) {
        $bSaved = $this->db->insert("tbl_reviews_site", $aData);
        if ($bSaved)
            return true;
        return false;
    }


    /**
    * This function is used to get onsite review details by id
    * @param type $uniqueId
    * @return type object
    */
    public function getOnsiteReviewDetailsByUID($uniqueId) {
        $oData = DB::table('tbl_reviews')
            ->Join('tbl_users', 'tbl_reviews.user_id', '=' , 'tbl_users.id')
            ->Join('tbl_brandboost_products', 'tbl_reviews.product_id', '=' , 'tbl_brandboost_products.id')
            ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_brandboost_products.product_name', 'tbl_brandboost_products.product_image', 'tbl_brandboost_products.created as product_created')
            ->where('tbl_reviews.unique_review_key', $uniqueId)
            ->orderBy("tbl_reviews.id", "ASC")
            ->get();
        return $oData;
    }


    /**
    * This function is used to get onsite review details by user id
    * @param type $uniqueId
    * @return type object
    */
    public function getOnsiteSiteReviewDetailsByUID($uniqueId) {

        $oData = DB::table('tbl_reviews')
            ->Join('tbl_users', 'tbl_reviews.user_id', '=' , 'tbl_users.id')
            ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
            ->where('tbl_reviews.review_type', 'site')
            ->where('tbl_reviews.unique_review_key', $uniqueId)
            ->orderBy("tbl_reviews.id", "ASC")
            ->get();
        return $oData;
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
}
