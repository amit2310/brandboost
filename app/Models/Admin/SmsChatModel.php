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

    public function deleteSMSFavourite($currentUserId, $subId) {
        $this->db->where('fav_user_id', $subId);
        $this->db->where('curr_user_id', $currentUserId);
        $result = $this->db->delete('tbl_chat_favourite');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getSMSFavouriteUser($currentUserId, $subsid) {

        $result = '';
        $this->db->select('fav_user_id');
        $this->db->where('curr_user_id', $currentUserId);
        $this->db->where('fav_user_id', $subsid);
        $this->db->from('tbl_chat_favourite');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }

        return $result;
    }


    /**
     * This function will return fav sms user
     * @param type $currentUserId
     * @param type $number
     * @return type
     */

    public static function getFavSmsUser($currentUserId, $number) {

               $oData = DB::table('tbl_chat_favourite')
                ->select('fav_user_id')
                 ->where('curr_user_id', $currentUserId)
                ->where('fav_user_id', $number)
                ->first();
                if(!empty($oData->fav_user_id))
                    return true;
                else 
                return false;    
       
    }

    public function getSMSFavouriteUserSingle($currentUserId, $fav_user_id) {

        $result = '';
        $this->db->select('fav_user_id');
        $this->db->where('curr_user_id', $currentUserId);
        $this->db->where('fav_user_id', $fav_user_id);
        $this->db->from('tbl_chat_favourite');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->num_rows();
        }
        ///echo $this->db->last_query(); die;

        return $result;
    }

    public function addSMSFavourite($data) {
        $result = $this->db->insert('tbl_chat_favourite', $data);
        ///echo $this->db->last_query(); die;

        if ($result)
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

    public function getWebChatThread($userID) {
        $this->db->select("*, COUNT(created) as createdTotal");
        $where = '(user_to="' . $userID . '" or user_form = "' . $userID . '")';
        $this->db->where($where);
        $this->db->group_by('DATE(created)');
        $this->db->from('tbl_chat_message');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }

    public function supportChat($userID) {
        $response = array();
        $this->db->where('supp_user', $userID);
        $this->db->from('tbl_chat_supportuser');
        $result = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function supportChatCompleted($userID) {
        $response = array();
        $this->db->where('supp_user', $userID);
        $this->db->where('completed', '1');
        $this->db->from('tbl_chat_supportuser');
        $result = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function supportChatByDate($userID, $createdDate) {
        $response = array();
        $this->db->where('supp_user', $userID);
        $this->db->where('DATE(created)', $createdDate);
        $this->db->from('tbl_chat_supportuser');
        $result = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $result->num_rows();
    }

    public function supportChatGroupByDate($userID) {
        $response = array();
        $this->db->select("*, COUNT(created) as createdTotal");
        $this->db->where('supp_user', $userID);
        $this->db->group_by('DATE(created)');
        $this->db->from('tbl_chat_supportuser');
        $result = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function supportChatGroupByCountry($userID) {
        $response = array();
        $this->db->select("*, COUNT(country) as countryTotal");
        $this->db->where('supp_user', $userID);
        $this->db->order_by('countryTotal', 'desc');
        $this->db->group_by('country');
        $this->db->from('tbl_chat_supportuser');
        $result = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function supportChatCurrent($userID) {
        $response = array();
        $this->db->where('supp_user', $userID);
        $this->db->where("DATE(created) = ", date('Y-m-d'));
        $this->db->from('tbl_chat_supportuser');
        $result = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getWebChatCurrentThread($userID) {
        $this->db->select("*");
        //$this->db->where("user_to", $userID);
        //$this->db->or_where("user_from", $userID);
        $where = '(user_to="' . $userID . '" or user_form = "' . $userID . '")';
        $this->db->where($where);
        $this->db->where("DATE(created) = ", date('Y-m-d'));
        $this->db->from('tbl_chat_message');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $query->num_rows();
    }

}
