<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class SmsChatModel extends Model {

    /**
     * Get Favorite chats
     * @param type $userId
     * @return type
     */
    public static function getSMSFavouriteByUserId($userId) {

        $oFavorite = DB::table('tbl_chat_favourite')
                ->where('curr_user_id', $userId)
                ->get();
        return $oFavorite;
    }

    /**
     * Get Favorite user Details by the user id
     * @param type $userId
     * @return type
     */

    public static function getSMSFavouriteBySubsId($userId) {

            $oData = DB::table('tbl_chat_favourite')
                 ->select('fav_user_id','subscriber')
                ->where('fav_user_id', $userId)
                 ->get();

        return $oData;
    }

     /**
     * This function is used to delete the fav sms chat user
     * @param type $currentUserId
     * @param type $subId
     * @return type
     */


    public function deleteSMSFavourite($currentUserId, $subId) {

            $oData = DB::table('tbl_sms_user_favourite')
            ->where('fav_user_id', $subId)
            ->where('curr_user_id', $currentUserId)
            ->delete();

            return $oData;

    }

    
    /**
     * This function will return fav sms user
     * @param type $currentUserId
     * @param type $number
     * @return type
     */

    public static function getFavSmsUser($currentUserId, $number) {

               $oData = DB::table('tbl_sms_user_favourite')
                ->select('fav_user_id')
                 ->where('curr_user_id', $currentUserId)
                ->where('fav_user_id', $number)
                ->first();
                return $oData;   
       
    }

    


    public function addSMSFavouriteUser($data) {

         $oData = DB::table('tbl_sms_user_favourite')->insertGetId($data);

        if ($oData)
            return true;
        else
            return false;
    }

    public function addSmsMedia($data) {
        $result = $this->db->insert('tbl_sms_video_links', $data);
        $insert_id = $this->db->insert_id();
        if ($result)
            return $insert_id;
        else
            return false;
    }


     /**
    * This function is used to add the sms notes 
    * @return type
    */

    public function addSmsNotes($data)
    {

       $oData = DB::table('tbl_subscriber_notes')->insertGetId($data);
       return $oData;

    }

     /**
    * This function will return Sms notes
    * @param type $usrid
    * @return type
    */

    public function getSmsNotes($number) {

      $oData = DB::table('tbl_subscriber_notes')
      ->where('subscriber_id', $number)
      ->get();

      return $oData;

    }



    public function getSMSMedia($rand_id) {

        $result = '';
        $this->db->select('*');
        $this->db->where('rand_string', $rand_id);
        $this->db->from('tbl_sms_video_links');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
        }

        return $result;
    }


     /**
     * this function is used to add Sms Data in the database
     * @return type
     */

    public function addSmsChatData($data) {
      $oData = DB::table('tbl_chat_sms_thread')->insert($data);
      return $oData;

    }


    /**
     * this function is used to return the sms threads For Phone numbers 
     * @param type $fromNo
     * @param type $toNo
     * @param type $offsetVal
     * @return type
     */

    public static function getSMSThreadsByPhoneNo($fromNo, $toNo, $offsetVal) {
      $oData = DB::select(DB::raw(" select * from tbl_chat_sms_thread where ((`from` LIKE '%" . $fromNo . "%' AND `to` LIKE '%" . $toNo . "%') OR (`to` LIKE '%" . $fromNo . "%' AND `from` LIKE '%" . $toNo . "%')) "));

         return $oData;

    }


     /**
     * this function is used to return subscriber list based on the input provided 
     * @param type $loginId
     * @param type $inVar
     * @return type
     */


    public function getlivesearchData($loginId, $inVar) {
         $oData = DB::select(DB::raw(" select * from tbl_subscribers where (( `phone` LIKE '" . $inVar . "%')) 
            AND owner_id='".$loginId."'  "));

         return $oData;

    }

    public function getSMSThreadsByPhoneNoByFilter($fromNo, $toNo, $offsetVal, $dateStartFilter, $dateEndFilter) {
        $result = array();
        if ($fromNo != '' && $toNo != '') {
            $where = "((`from` LIKE '%" . $fromNo . "%' AND `to` LIKE '%" . $toNo . "%') 
				OR (`to` LIKE '%" . $fromNo . "%' AND `from` LIKE '%" . $toNo . "%'))
				AND DATE(tbl_chat_sms_thread.created) >='$dateStartFilter' AND DATE(tbl_chat_sms_thread.created) <= '$dateEndFilter'";
            $this->db->where($where);
            //$this->db->limit(30, $offsetVal);
            //$this->db->order_by("id", "DESC");
            $this->db->from('tbl_chat_sms_thread');
            $query = $this->db->get();
            //echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                $result = $query->result();
            }
        }
        return $result;
    }

    public function getuserAvatarImage($userID) {
        $this->db->select("tbl_users.avatar as avatarImage");
        $this->db->where("id", $userID);
        $result = $this->db->get("tbl_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getSMSThreadsNo($fromNo, $toNo) {
        $where = "((`from` = '" . $fromNo . "' AND `to` = '" . $toNo . "') OR (`to` = '" . $fromNo . "' AND `from` = '" . $toNo . "'))";
        $this->db->where($where);
        $this->db->from('tbl_chat_sms_thread');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }

    public function getChatThread($userID) {
        $this->db->select("id");
        $this->db->where("user_to", $userID);
        $this->db->from('tbl_chat_message');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }


   /**
    * This function is used to get wechat thread details
    * @param type
    * @return type
    */

    public function getWebChatThread($userID) {
        $oData = DB::table('tbl_chat_message')
        ->select(DB::raw('COUNT(created) as createdTotal'))
        ->where('user_to',$userID)
        ->orWhere('user_form',$userID)
        ->groupBy(DB::raw('DATE(created)'))->get();
        return $oData;
        
    }

    
    /**
    * This function is used for support chat
    * @param type $userID
    * @return type
    */

    public function supportChat($userID) {
     $aData =  DB::table('tbl_chat_supportuser')
      ->where('supp_user', $userID)->get();
      return $aData;
        
    }


    /**
    * This function will return all completed chats
    * @param type $clientID
    * @return type
    */

    public function supportChatCompleted($userID) {
        $aData =  DB::table('tbl_chat_supportuser')
         ->where('supp_user', $userID)
        ->where('completed', '1')->get();
        return $aData;
    }

    
    /**
    * This function will return chat summary date wise
    * @param type $userID
    * @param type $createdDate
    * @return type
    */

    public function supportChatByDate($userID, $createdDate) {
        $oData = DB::table('tbl_chat_supportuser')
        ->where('supp_user', $userID)
        ->where(DB::raw('DATE(created)'), $createdDate)->get();
        return  $oData ;
    }


    /**
    * This function is used to get the supportchat date wise
    * @param type $userID
    * @return type
    */


    public function supportChatGroupByDate($userID) {
        $oData = DB::table('tbl_chat_supportuser')
        ->select('tbl_chat_supportuser.*',DB::raw('COUNT(created) as createdTotal'))
        ->where('supp_user', $userID)
        ->groupBy(DB::raw('DATE(created)'))->get();
        return $oData;
        
    }

 
    /**
    * This function is used to get support chat by countrywise
    * @param type $clientID
    * @return type
    */

    public function supportChatGroupByCountry($userID) {
       $oData = DB::table('tbl_chat_supportuser')
        ->select('tbl_chat_supportuser.*', DB::raw('COUNT(country) as countryTotal'))
        ->where('supp_user', $userID)
        ->orderBy('countryTotal', 'desc')
         ->groupBy('country')->get();
         return $oData;
        
    }

   
    /**
    * This function is used to current support chat
    * @param type $userID
    * @return type
    */

    public function supportChatCurrent($userID) {
        $aData =  DB::table('tbl_chat_supportuser')
        ->where('supp_user', $userID)
        ->where(DB::raw('DATE(created)'), date('Y-m-d'))->get();
        return $aData;
       
    }

  
    /**
    * This function will return current web thread 
    * @param type $userID
    * @return type
    */


    public function getWebChatCurrentThread($userID) {
        $aData =  DB::table('tbl_chat_message')
        ->select('tbl_chat_message.*')
         ->where('user_to',$userID)
        ->orWhere('user_form',$userID)
        ->where(DB::raw('DATE(created)'),date('Y-m-d'))->get();
          return $aData;
    }






}
