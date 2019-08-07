<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\FeedbackModel;
use App\Models\ReviewsModel;
use App\Models\Admin\Modules\NpsModel;
use DB;
use Cookie;
use Session;

class ReportModel extends Model {

    public static function getEmailSend($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_sendgrid.* FROM tbl_track_sendgrid "
                . "LEFT JOIN tbl_brandboost ON tbl_track_sendgrid.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";

       
        $sql .= "WHERE DATE(tbl_track_sendgrid.created)='{$dateFilter}' ";

        if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }

        //$sql .= "AND ( tbl_track_sendgrid.event_name='open' OR tbl_track_sendgrid.event_name='click' OR tbl_track_sendgrid.event_name='delivered' ) ";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    public static function getEmailFailed($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_sendgrid.* FROM tbl_track_sendgrid "
                . "LEFT JOIN tbl_brandboost ON tbl_track_sendgrid.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";

       
        $sql .= "WHERE DATE(tbl_track_sendgrid.created)='{$dateFilter}' ";

        if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }

        $sql .= "AND ( tbl_track_sendgrid.event_name='bounce' OR tbl_track_sendgrid.event_name='dropped' OR tbl_track_sendgrid.event_name='spam_report' || tbl_track_sendgrid.event_name='deferred' ) ";

       $oData = DB::select(DB::raw($sql));
       return $oData;
    }

    public static function getEmailOpen($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_sendgrid.* FROM tbl_track_sendgrid "
                . "LEFT JOIN tbl_brandboost ON tbl_track_sendgrid.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";

       
        $sql .= "WHERE DATE(tbl_track_sendgrid.created)='{$dateFilter}' ";

        if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }

        $sql .= "AND ( tbl_track_sendgrid.event_name='open' ) ";
       $oData = DB::select(DB::raw($sql));
       return $oData;
        

    }


    public static function getFormOpen($date) {

        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_reviews')

        ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_brandboost.brand_title')
        ->leftJoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
        ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_reviews.campaign_id')
         ->where(DB::raw('DATE(tbl_reviews.created)'), $dateFilter)
         ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })


        ->orderBy('tbl_reviews.id', 'DESC')->get();
        return $oData;
    }

    public static function getFeedbackReview($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_brandboost_feedback')
        ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')
          ->where(DB::raw('DATE(tbl_brandboost_feedback.created)'), $dateFilter)
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();
       return $oData;

    }

    public static function getAllFeedbackReview() {

        $response = array();
        $userID = $this->session->userdata("current_user_id");

         $oData = DB::table('tbl_brandboost_feedback')
        ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })
          ->where('tbl_brandboost_feedback.category','!=','')->get();

       return $oData;

    }

    public static function getFiveRating($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

           $oData = DB::table('tbl_brandboost_feedback')
             ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')
             ->where(DB::raw('DATE(tbl_brandboost_feedback.created)'), $dateFilter)
            ->where('tbl_brandboost_feedback.category', 'Positive')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();

        return $oData;
    }

    public static function getAllFiveRating() {

        $response = array();
        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_brandboost_feedback')
        ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')

        ->where('tbl_brandboost_feedback.category', 'Positive')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();

       return $oData;
    }

    public static function getThreeRating($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $oData = DB::table('tbl_brandboost_feedback')
        ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')
         ->where(DB::raw('DATE(tbl_brandboost_feedback.created)'), $dateFilter)
        ->where('tbl_brandboost_feedback.category', 'Neutral')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();
        return $oData;

        
    }

    public static function getAllThreeRating() {

        $response = array();
        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_brandboost_feedback')
        ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')
         ->where('tbl_brandboost_feedback.category', 'Neutral')
       ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();

        return  $oData;
    }

    public static function getOneRating($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $oData = DB::table('tbl_brandboost_feedback')
         ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')
          ->where(DB::raw('DATE(tbl_brandboost_feedback.created)'), $dateFilter)
           ->where('tbl_brandboost_feedback.category', 'Negative')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();
        return $oData;
    }

    public static function getAllOneRating() {

        $response = array();
        $userID = Session::get('current_user_id');

        $oData = DB::table('tbl_brandboost_feedback')
        ->leftJoin('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_feedback.brandboost_id')
         ->where('tbl_brandboost_feedback.category', 'Negative')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();

       return $oData;
    }

    public static function getAllEmailSend() {

        $response = array();
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_sendgrid.* FROM tbl_track_sendgrid "
                . "LEFT JOIN tbl_brandboost ON tbl_track_sendgrid.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";

       
        //$sql .= "WHERE DATE(tbl_track_sendgrid.created)='{$dateFilter}' ";

        //$sql .= "WHERE tbl_track_sendgrid.event_name='open' OR tbl_track_sendgrid.event_name='click' OR tbl_track_sendgrid.event_name='delivered' ";

        if(!empty($userID) && $userID > 1) {
            $sql .= " WHERE 1 AND tbl_brandboost.user_id = '{$userID}'";
        }

        $oData = DB::select(DB::raw($sql));
        return $oData;

        //$sql .= " GROUP BY tbl_track_sendgrid.created";

            //$sql .= "ORDER BY tbl_track_sendgrid.id DESC";

        
    }

    public static function getSmsRecordSend($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_twillio.* FROM tbl_track_twillio "
                . "LEFT JOIN tbl_brandboost ON tbl_track_twillio.brandboost_id = tbl_brandboost.id ";
               /* . "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";*/

                
        $sql .= "WHERE DATE(tbl_track_twillio.created) = '{$dateFilter}'";
        if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }
        $sql .= " AND (tbl_track_twillio.event_name='accepted' 
         OR tbl_track_twillio.event_name='sent' 
         OR tbl_track_twillio.event_name='delivered' 
         OR tbl_track_twillio.event_name='undelivered' 
         OR tbl_track_twillio.event_name='bounce' 
         OR tbl_track_twillio.event_name='unsubscribe' 
         OR tbl_track_twillio.event_name='failed' 
         OR tbl_track_twillio.event_name='receiving' 
         OR tbl_track_twillio.event_name='received' 
         OR tbl_track_twillio.event_name='queued' 
         OR tbl_track_twillio.event_name='sending'
         OR tbl_track_twillio.event_name='click' )";


        $sql .= " ORDER BY tbl_track_twillio.id DESC";
        $oData = DB::select(DB::raw($sql));
        return $oData;

    }

    public static function getAllSmsRecordSend() {

        $response = array();
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_twillio.* FROM tbl_track_twillio "
                . "LEFT JOIN tbl_brandboost ON tbl_track_twillio.brandboost_id = tbl_brandboost.id ";
                /*. "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id WHERE 1";*/

        $sql .= " WHERE 1 AND (tbl_track_twillio.event_name='accepted' 
         OR tbl_track_twillio.event_name='sent' 
         OR tbl_track_twillio.event_name='delivered' 
         OR tbl_track_twillio.event_name='undelivered' 
         OR tbl_track_twillio.event_name='bounce' 
         OR tbl_track_twillio.event_name='unsubscribe' 
         OR tbl_track_twillio.event_name='failed' 
         OR tbl_track_twillio.event_name='receiving' 
         OR tbl_track_twillio.event_name='received' 
         OR tbl_track_twillio.event_name='queued' 
         OR tbl_track_twillio.event_name='sending'
         OR tbl_track_twillio.event_name='click' )";

         if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }


        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    public static function getSmsRecordOpen($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_twillio.* FROM tbl_track_twillio "
                . "LEFT JOIN tbl_brandboost ON tbl_track_twillio.brandboost_id = tbl_brandboost.id ";
                /*. "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";*/

        

        $sql .= "WHERE DATE(tbl_track_twillio.created) = '{$dateFilter}'";
        if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }
        $sql .= " AND (tbl_track_twillio.event_name='delivered' )";


        $sql .= " ORDER BY tbl_track_twillio.id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;

    }

    public static function getSmsRecordClick($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_twillio.* FROM tbl_track_twillio "
                . "LEFT JOIN tbl_brandboost ON tbl_track_twillio.brandboost_id = tbl_brandboost.id ";
                /*. "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";*/

        

        $sql .= "WHERE DATE(tbl_track_twillio.created) = '{$dateFilter}'";
        if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }
        $sql .= " AND (tbl_track_twillio.event_name='click' )";


        $sql .= " ORDER BY tbl_track_twillio.id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;

    }


    public static function getSmsRecordFailed($date) {

        $response = array();
        $dateFilter = date("Y-m-d",strtotime($date));
        $userID = Session::get('current_user_id');

        $sql = "SELECT tbl_track_twillio.* FROM tbl_track_twillio "
                . "LEFT JOIN tbl_brandboost ON tbl_track_twillio.brandboost_id = tbl_brandboost.id ";
                /*. "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";*/

        

        $sql .= "WHERE DATE(tbl_track_twillio.created) = '{$dateFilter}'";
        if(!empty($userID) && $userID > 1) {
            $sql .= " AND tbl_brandboost.user_id = '{$userID}'";
        }
        $sql .= " AND (tbl_track_twillio.event_name='bounce' OR tbl_track_twillio.event_name='unsubscribe' OR tbl_track_twillio.event_name='failed'  )";


        $sql .= " ORDER BY tbl_track_twillio.id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;

    }

    public static function getClientTags() {

        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_tag_groups')
         ->select('tbl_tag_groups.*', 'tbl_tag_groups_entity.id AS tagid', 'tbl_tag_groups_entity.tag_name', 'tbl_tag_groups_entity.tag_created')
         ->leftJoin('tbl_tag_groups_entity', 'tbl_tag_groups.id','=','tbl_tag_groups_entity.group_id')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_tag_groups.user_id", $userID);
        })

        ->orderBy('tbl_tag_groups.id', 'DESC')->get();
        return $oData;
       
    }

    public static function getTags($tagId = 0) {

        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_tag_groups_entity')
        ->select('tbl_tag_groups.*', 'tbl_tag_groups_entity.id AS tagid', 'tbl_tag_groups_entity.tag_name', 'tbl_tag_groups_entity.tag_created')
        ->join('tbl_tag_groups', 'tbl_tag_groups.id','=','tbl_tag_groups_entity.group_id')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_tag_groups.user_id", $userID);
        })
        ->when($tagId > 0, function($query) use ($tagId){
        return $query->where("tbl_tag_groups_entity.id", $tagId);
        })->get();
        return $oData;
       
    }


    public static function numberOfTagInGroup($tagGroupId = 0) {

        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_tag_groups_entity')
        ->select('tbl_tag_groups.*', 'tbl_tag_groups_entity.id AS tagid', 'tbl_tag_groups_entity.tag_name', 'tbl_tag_groups_entity.tag_created')
         ->join('tbl_tag_groups', 'tbl_tag_groups.id','=','tbl_tag_groups_entity.group_id')
        ->join('tbl_feedback_tags', 'tbl_tag_groups_entity.id','=','tbl_feedback_tags.tag_id')
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_tag_groups.user_id", $userID);
        })
        ->when($tagGroupId > 0, function($query) use ($tagGroupId){
        return $query->where("tbl_tag_groups_entity.group_id", $tagGroupId);
        })->get();
             
       return $oData;

    }


    public static function getTagFeedback($tagId = 0) {

        $oData = DB::table('tbl_feedback_tags')
         ->when($tagId > 0, function($query) use ($tagId){
        return $query->where("tbl_feedback_tags.tag_id", $tagId);
        })->get();
         return $oData;

       
    }

    public static function getTopThreeTagGroup() {

        $userID = Session::get('current_user_id');
        $oData = DB::table('tbl_feedback_tags')
         ->select('tbl_tag_groups.*', 'tbl_tag_groups_entity.id AS tagid', 'tbl_tag_groups_entity.tag_name', 'tbl_tag_groups_entity.tag_created', 'COUNT(tbl_tag_groups.ID) AS total_group')

        ->leftJoin('tbl_tag_groups_entity', 'tbl_tag_groups.id','=','tbl_tag_groups_entity.group_id')


        ->groupby('tbl_tag_groups.ID') 
         ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_tag_groups.user_id", $userID);
        })->get();

       
        return $oData;
    }

    public static function getListSubscriber($status = 1) {

        $response = array();
        $userID = Session::get('current_user_id');
          $oData = DB::table('tbl_brandboost_users')
            ->select('tbl_users.firstname as firstname', 'tbl_users.lastname as lastname', 'tbl_users.email as email', 'tbl_brandboost.brand_title AS brandTitle', 'tbl_brandboost.user_id AS brandUser', 'tbl_brandboost_users.created')
            ->join('tbl_brandboost', 'tbl_brandboost.id','=','tbl_brandboost_users.brandboost_id')

            ->join('tbl_users', 'tbl_brandboost_users.user_id','=','tbl_users.id')
        
            ->where('tbl_brandboost_users.status', $status)
             ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })->get();
       

        return $oData;
    }

    public static function getNegativeTime() {

        $response = array();
        $userID =Session::get('current_user_id');
        $dateTime = date('Y-m-d');
        $oData = DB::table('tbl_reviews')

        ->join('tbl_brandboost', 'tbl_brandboost.id','=','tbl_reviews.campaign_id')
         ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })

        ->where(DB::raw('DATE(tbl_reviews.created)'), $dateTime)
        
         ->orderBy('tbl_reviews.ratings', 'ASC')
        ->orderBy('tbl_reviews.created', 'ASC')->get();
       return $oData;
       
    }

    public static function getBusyTime() {

        $response = array();
        $userID = Session::get('current_user_id');
        $dateTime = date('Y-m-d');
         $oData = DB::table('tbl_reviews')
         ->select('tbl_reviews.*', DB::raw('count(tbl_reviews.created) as newdate'))
         ->join('tbl_brandboost', 'tbl_brandboost.id','=','tbl_reviews.campaign_id')
       
        ->when(!empty($userID) && $userID > 1, function($query) use ($userID){
        return $query->where("tbl_brandboost.user_id", $userID);
        })
        ->where(DB::raw('DATE(tbl_reviews.created)'), $dateTime)
       
        ->groupby(DB::raw('HOUR(tbl_reviews.created)'))

        ->orderBy('newdate', 'DESC')->get();
       

        return $oData;
    }



}