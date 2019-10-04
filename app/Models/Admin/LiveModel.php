<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class LiveModel extends Model {

    /**
     * This method used to get live data recording
     * @param $clientId
     * @return mixed
     */
    public static function getLiveData($clientId){
		$oData = DB::table('tbl_visitor_logs')
            ->leftJoin('tbl_users', 'tbl_visitor_logs.source_client_id', '=', 'tbl_users.id')
            ->select('tbl_visitor_logs.*', 'tbl_users.id AS uid', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
			->where('tbl_visitor_logs.source_client_id', $clientId)
			->orderBy('tbl_visitor_logs.id', 'desc')
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
