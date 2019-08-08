<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class CommentModel extends Model
{
	/**
     * Used to get all reviews comments by user id
     * @param type $userID
     * @return type 
     */
    public function getMyComment($userID) {
		$oData = DB::table('tbl_reviews_comments')
			->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=', 'tbl_reviews.id')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_reviews.campaign_id')
			->leftJoin('tbl_users', 'tbl_brandboost.user_id', '=', 'tbl_users.id')
			->select('tbl_reviews_comments.*', 'tbl_brandboost.brand_title as brand_title', 'tbl_brandboost.brand_img as brand_img')
			->where('tbl_reviews_comments.user_id', $userID)
			->orderBy('tbl_reviews_comments.id', 'desc')
            ->get();

        return $oData;
		
    }
	
	/**
     * Used to get comment details by comment id
     * @param type $commentid
     * @return type 
     */
    public function getComment($commentid) {
		$oData = DB::table('tbl_reviews_comments')
			->where('id', $commentid)
			->orderBy('id', 'desc')
            ->get();

        return $oData;
    }

    /**
     * Used to add comment
     * @param type $aData
     * @return type boolean
     */
    public function addComment($aData) {

        $result = DB::table('tbl_reviews_comments')->insert($aData);
        return true;
    }
	

    /**
     * Used to update comment
     * @param type $aData, $commentID
     * @return type boolean
     */
	public function updateComment($aData, $commentID) {

        $oData = DB::table('tbl_reviews_comments')
            ->where('id', $commentID)
            ->update($aData);

        return true;
    }

    public function deleteComment($commentID) {
        $this->db->where('id', $commentID);
        $result = $this->db->delete('tbl_reviews_comments');
        return true;
    }

	/**
     * Used to get all comments by review id
     * @param type $reviewId
     * @return type 
     */
    public static function getCampReviewComment($reviewId) {
		$oData = DB::table('tbl_reviews_comments')
			->leftJoin('tbl_reviews', 'tbl_reviews_comments.review_id', '=', 'tbl_reviews.id')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_reviews.campaign_id')
			->leftJoin('tbl_users', 'tbl_brandboost.user_id', '=', 'tbl_users.id')
			->select('tbl_reviews_comments.*', 'tbl_brandboost.brand_title as brand_title', 'tbl_brandboost.id as bb_id', 'tbl_brandboost.brand_img as brand_img')
			->where('tbl_reviews_comments.review_id', $reviewId)
			->orderBy('tbl_reviews_comments.id', 'desc')
            ->get();

        return $oData;
    }
    
	/**
     * Used to get comments details by review id
     * @param type $id
     * @return type 
     */
    public function getCommentReviewInfo($id){
        $oData = DB::table('tbl_reviews')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_reviews.campaign_id')
			->select('tbl_reviews.*', 'tbl_brandboost.user_id AS ownerID')
			->where('tbl_reviews.id', $id)
            ->first();

        return $oData;
    }
}
