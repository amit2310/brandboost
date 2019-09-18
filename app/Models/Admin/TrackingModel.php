<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class TrackingModel extends Model
{

    /**
     * This method is used to get all tracking related data associated with the brandboost module
     * @return array
     */
    public function getAllTrackings(){
        $oData = DB::table('tbl_click_logs')
            ->leftJoin('tbl_tracking_log_email_sms', 'tbl_tracking_log_email_sms.message_id', '=', 'tbl_click_logs.message_id')
            ->leftJoin('tbl_brandboost_users', 'tbl_brandboost_users.id', '=', 'tbl_tracking_log_email_sms.subscriber_id')
            ->select('tbl_click_logs.*', 'tbl_brandboost_users.email', 'tbl_brandboost_users.firstname', 'tbl_brandboost_users.lastname', 'tbl_tracking_log_email_sms.type')
            ->orderBy('tbl_click_logs.id', 'asc')
            ->get();
        return $oData;
    }

    /**
     * This method is used to get complete information of brandboost campaign by id
     * @param $brandboostID
     * @return array
     */
    public function getShortURLByBBID($brandboostID){
        $oData = DB::table('tbl_brandboost')
            ->where('id', $brandboostID)
            ->get();
        return $oData;
    }

    /**
     * This method is used to get SMS short url details
     * @param $id
     * @return array
     */
    public function getShortURLDataByID($id){
        $oData = DB::table('tbl_sms_short_url')
            ->where('id', $id)
            ->get();
        return $oData;
    }
}
