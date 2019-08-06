<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class MediaModel extends Model {
	
	/**
     * Used to get all media gallery data by user id
     * @param type $userId
     * @return type
     */
	public static function getAllGallerys($userId){
		$oData = DB::table('tbl_gallery')
                ->where('user_id', $userId)
                ->where('deleted', 0)
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
	}
	
	/**
     * Used to get all media gallery data by user id
     * @param type $userId
     * @return type
     */
	public static function getGalleryData($galleryId){
		$oData = DB::table('tbl_gallery')
                ->where('id', $galleryId)
                ->first();
        return $oData;
	}
	
	/**
     * Used to get all media gallery data by user id
     * @param type $userId
     * @return type
     */
	public function getGalleryDataByKey($keyCode){
		$oData = DB::table('tbl_gallery')
                ->where('hashcode', $keyCode)
                ->where('status', 1)
                ->where('deleted', 0)
                ->first();
        return $oData;
	}
	
	/**
     * Used to add media gallery data
     * @return type
     */
	public function addGallery($aData) {
		$insert_id = DB::table('tbl_gallery')->insertGetId($aData);
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }
	
	/**
     * Used to update media gallery data
     * @param type $galleryId
     * @return type
     */
	public static function updateGallery($galleryId, $aData) {
        
		$result = DB::table('tbl_gallery')
           ->where('id', $galleryId)
           ->update($aData);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

	/**
     * Used to update media gallery review data by review $reviewId
     * @param type $reviewId
     * @return type
     */
	public function updateGalleryReview($reviewId, $aData) {
		$result = DB::table('tbl_reviews')
           ->where('id', $reviewId)
           ->update($aData);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }
	
}
