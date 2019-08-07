<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class LiveModel extends Model {
	
	public static function getLiveData($clientId){
		$oData = DB::table('tbl_visitor_logs')
			->where('source_client_id', $clientId)
			->orderBy('id', 'desc')
			->get();
		return $oData;
	}

	public static function getCurrentLiveData($clientId) {
		$oData = DB::table('tbl_visitor_logs')
			->where('source_client_id', $clientId)
			->where('created', date('Y-m-d')) //DATE(created)
			->orderBy('id', 'desc')
			->count();
		return $oData;
	}
	
	public function addVisitorInfo($aData){

        $insert_id = DB::table('tbl_visitor_logs')->insertGetId($aData);
        return $insert_id;
	}
	
	/**
     * Get live data by Id
     * @param id
     * @return type object
     */
	public function getLiveDataById($id){
		$oData = DB::table('tbl_visitor_logs')
			->where('id', $id)
			->first();
		return $oData;
	}
	

	/**
     * Get live data details
     * @param clientId, userId, ipAddress
     * @return type object
     */
	public function getLiveDataDetails($clientId, $userId, $ipAddress){
		$oData = DB::table('tbl_visitor_logs')
			->where('source_client_id', $clientId)
			->where('ip_address', $ipAddress)
			->when(!empty($userId), function ($query) use ($userId) {
				return $query->where('user_id', $userId);
			})
			->orderBy('id', 'desc')
			->get();
		return $oData;
	}

	public static function chatWidget($userID) {
		$oData = DB::table('tbl_chat_supportuser')
			->where('supp_user', $userID)
			->count();
		return $oData;
	}

	public static function brandboostWidget($userID, $type) {
		$oData = DB::table('tbl_brandboost')
			->where('review_type', $type)
			->where('user_id', $type)
			->count();
		return $oData;
	}
}
