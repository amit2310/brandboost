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
		$bSaved = $this->db->insert("tbl_visitor_logs", $aData);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
		}
        return false;
	}
	
	public function getLiveDataById($id){
		$oData = DB::table('tbl_visitor_logs')
			->where('id', $id)
			->get();
		return $oData;
	}
	
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
