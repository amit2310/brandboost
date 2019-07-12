<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class SubscriberModel extends Model {

    /**
     * Get subscribers data
     * @param type $userID
     * @return type
     */
    public static function getGlobalSubscribers($userID) {
        $oData = DB::table('tbl_subscribers')
                ->select('tbl_subscribers.*', 'tbl_subscribers.id AS global_user_id', 'tbl_subscribers.status AS globalStatus')
                ->where('owner_id', $userID)
                ->where('firstname', '!=', 'NA')
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * This function will return Twilio related account details based on the client/user id
     * @param type $clientID
     * @return type
     */
    public static function getTwilioAccountById($clientID) {
        $oTwilio = DB::table('tbl_twilio_accounts')
                ->where('user_id', $clientID)
                ->where('status', 1)
                ->first();
        return $oTwilio;
    }

    /**
     * Get the list of logged members all chat
     * @param type $userID
     * @param type $userRole
     * @return type
     */
    public static function getGlobalSubscribersChat($userID, $userRole) {

        $aData = DB::table('tbl_subscribers')
                ->join('tbl_users', 'tbl_subscribers.user_id', '=', 'tbl_users.id')
                ->select('tbl_users.*')
                ->when(($userRole > 1), function ($query) use ($userID) {
                    return $query->where('tbl_subscribers.owner_id', $userID);
                })
                ->orderBy('tbl_subscribers.id', 'desc')
                ->get();

        return $aData;
    }

    /**
     * Get Old Chat data 
     * @param type $userID
     * @return type
     */
    public static function activeOnlywebOldchatlistDetails($userID) {

        $oData = DB::table('tbl_chat_supportuser')
                ->where('supp_user', $userID)
                ->orderBy('tbl_chat_supportuser.last_chat_time', 'asc')
                ->get();

        return $oData;
    }

    /**
     * Get list of waiting chat list
     * @param type $userID
     * @return type
     */
    public static function WaitingChatlistDetails($userID) {
        $oData = DB::table('tbl_chat_message')
                ->where('user_to', $userID)
                ->where('read_status', 0)
                ->groupBy('token')
                ->orderBy('created', 'asc')
                ->get();
        return $oData;
    }

    /**
     * Used to get only active support users
     * @param type $userID
     */
    public static function activeOnlywebDetails($userID) {

        $oData = DB::table('tbl_chat_supportuser')
                ->where('supp_user', $userID)
                ->orderBy('last_chat_time', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Get Team member assigned chat
     * @param type $teamId
     * @return type\
     */
    public static function getTeamAssignData($teamId) {
        $oData = DB::table('tbl_chat_supportuser')
                ->where('assign_team_member', $teamId)
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Get Favorite Chat list
     * @param type $userID
     * @return type
     */
    public static function getFavlistDetails($userID) {
        $oData = DB::table('tbl_chat_supportuser')
                ->where('supp_user', $userID)
                ->where('favourite', 1)
                ->get();
        return $oData;
    }

    /**
     * Get active sms thread details
     * @param type $Number
     * @return type
     */
    public static function activeOnlysmsDetails($Number) {

        $oData = DB::select(DB::raw("SELECT tcm_subs1.* 
                                        FROM   tbl_chat_sms_thread tc1 
                                               INNER JOIN (SELECT * 
                                                           FROM   tbl_chat_sms_thread 
                                                           GROUP  BY token, 
                                                                     created 
                                                           ORDER  BY created DESC) AS tcm_subs1 
                                                       ON tc1.token = tcm_subs1.token 
                                        WHERE  ( tc1.to = '" . $Number . "' 
                                                  OR tc1.from = '" . $Number . "' ) 
                                          AND tc1.token!=''
                                           AND tc1.module_name='chat'

                                        GROUP  BY tc1.token 
                                        ORDER  BY tcm_subs1.created DESC "));
        return $oData;
    }

    /**
     * Get Oldest SMS thread
     * @param type $Number
     * @return type
     */
    public static function SmsOldest_list($Number) {

        $oData = DB::select(DB::raw("SELECT tcm_subs1.* 
                                        FROM   tbl_chat_sms_thread tc1 
                                               INNER JOIN (SELECT * 
                                                           FROM   tbl_chat_sms_thread 
                                                           GROUP  BY token, 
                                                                     created 
                                                           ORDER  BY created ASC) AS tcm_subs1 
                                                       ON tc1.token = tcm_subs1.token 
                                        WHERE  ( tc1.to = '" . $Number . "' 
                                                  OR tc1.from = '" . $Number . "' ) 
                                        GROUP  BY tc1.token 
                                        ORDER  BY tcm_subs1.created ASC "));

        return $oData;
    }

    /**
     * Get sms waiting longest list
     * @param type $Number
     * @return type
     */
    public static function SmsWaitlinglonest_list($Number) {
        $oData = DB::table('tbl_chat_sms_thread')
                ->where('to', $Number)
                ->where('read_status', 0)
                ->groupBy('token')
                ->get();
        return $oData;
    }

    /**
     * 
     * @param type $userID
     * @return type
     */
    public static function getactiveChatboxSeries($userID) {
        $oData = DB::table('tbl_chat_status')
                ->where('user_id', $userID)
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Get Chat last message
     * @param type $room
     * @return type
     */
    public static function getLastMessageDetails($room) {
        $oData = DB::table('tbl_chat_message')
                ->where('token', $room)
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();

        return $oData;
    }

    /**
     * Get support user details
     * @param type $userID
     * @return type
     */
    public static function getSupportUserDetail($userID) {
        $oData = DB::table('tbl_chat_supportuser')
                ->where('user', $userID)
                ->get();

        return $oData;
    }

    /**
     * Get Assigned Member
     * @param type $room
     * @return type
     */
    public static function getassignto($room) {

        $oData = DB::select(DB::raw(" SELECT CONCAT(tbl_users_team.firstname, ' ', tbl_users_team.lastname) as teamName
FROM `tbl_chat_supportuser`
INNER JOIN `tbl_users_team` ON `tbl_chat_supportuser`.`assign_team_member`=`tbl_users_team`.`id`
WHERE tbl_chat_supportuser.room = '" . $room . "'"));
        
        return $oData;
    }
    
    /**
     * Get Assigned chat to user
     * @param type $room
     * @return type
     */
    public static function getassigntoUser($room) {

        $oData = DB::select(DB::raw(" SELECT CONCAT(tbl_users.firstname, ' ', tbl_users.lastname) as teamName
FROM `tbl_chat_supportuser`
INNER JOIN `tbl_users` ON `tbl_chat_supportuser`.`assign_team_member`=`tbl_users`.`id`
WHERE tbl_chat_supportuser.room = '" . $room . "'"));
        
        return $oData;
    }

    public function updateContactStoreUsage($userID) {
        $oCurrentUsage = $this->getCurrentUsage($userID);
        if (!empty($oCurrentUsage)) {
            $mainContactLimit = $oCurrentUsage->contact_limit;
            $mainContactLimitTopup = $oCurrentUsage->contact_limit_topup;
            $sFieldName = '';
            if ($mainContactLimit > 0) {
                $sFieldName = '`contact_limit`';
            } else if ($mainContactLimitTopup > 0) {
                $sFieldName = '`contact_limit_topup`';
            }

            if (!empty($sFieldName)) {
                $sql = "UPDATE tbl_account_usage SET {$sFieldName} = ({$sFieldName} - 1) WHERE user_id='{$userID}'";
                $result = $this->db->query($sql);
                if ($result)
                    return true;
                else
                    return false;
            }
        }
    }

    public function getCurrentUsage($clientID) {
        $this->db->where("user_id", $clientID);
        $result = $this->db->get('tbl_account_usage');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function addGlobalSubscriber($aData) {
        $result = $this->db->insert("tbl_subscribers", $aData);
        //echo $this->db->last_query();
        $inset_id = $this->db->insert_id();
        if ($inset_id > 0 && !empty($aData['owner_id'])) {
            //update contact storage usaged
            $this->updateContactStoreUsage($aData['owner_id']);
        }

        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function checkIfGlobalSubscriberExists($ownerID, $fieldName, $fieldValue) {
        $this->db->where("owner_id", $ownerID);
        $this->db->where("{$fieldName}", $fieldValue);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function checkIfMySubscriber($ownerID, $iSubscriberID) {
        $this->db->where("owner_id", $ownerID);
        $this->db->where("id", $iSubscriberID);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return false;
    }

    public function getPeopleSubscriberInfo($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getGlobalSubscriberInfo($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }

        return $response;
    }

    public function getGlobalSubscriberInfoByUsrid($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getCustomGlobalSubscriberInfoDetails($id) {
        $this->db->where("user_id", $id);
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getSubscriberDetailsBydb($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function updateGlobalSubscriber($aData, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("tbl_subscribers", $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getArchiveGlobalSubscribers($userID) {
        $this->db->where("owner_id", $userID);
        $this->db->where("status", 2);
        $this->db->order_by("id", "DESC");

        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    /**
     * This function will return chatShortcuts used in the chat module
     * @param type $userId
     * @return type
     */

    public static function getchatshortcutlisting($userID) {
        $oData = DB::table('tbl_chat_shortcuts')
                ->where('user_id', $userID)
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();

        return $oData;
        
    }


  /**
 * This function will return Subscribers Information
 * @param type $userID
 * @return type
 */

    public static function getSubscribersInfoDetails($userID) {
      $oData = DB::select(DB::raw(" SELECT * from tbl_subscribers where id = '" . $userID . "'"));
        return $oData;

    }

    public function SubscribersInfoByPhone($phoneNumber) {
        $this->db->select("tbl_subscribers.*, tbl_subscribers.id as subscriber_id, tbl_subscribers.status AS globalStatus, tbl_subscribers.id AS global_user_id");
        $this->db->where("phone", $phoneNumber);
        $this->db->order_by("id", "DESC");
        //$this->db->where("status !=", 2);
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getTagSubscribers($tagID) {
        $this->db->select("tbl_subscribers.*, tbl_subscribers.id as subscriber_id, tbl_subscribers.status AS globalStatus, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_subscriber_tags.subscriber_id = tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_subscriber_tags.tag_id", $tagID);
        $this->db->order_by("tbl_subscriber_tags.id", "DESC");
        //$this->db->where("status !=", 2);
        $result = $this->db->get("tbl_subscriber_tags");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function webchatUsersDetails($userID) {

        $result = $this->db->query("select * from tbl_chat_message where  user_to = '" . $userID . "' AND status=1 order by id desc ");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }

    public function getLastSmsDetails($room) {

        $result = $this->db->query("SELECT * FROM `tbl_chat_sms_thread` WHERE `token` ='" . $room . "' order by id desc limit 1 ");
        $response = $result->result();
        return $response;
    }

    

    public function getTeamByroomDetails($room) {

        $result = $this->db->query(" SELECT user as userval from tbl_chat_supportuser WHERE room = '" . $room . "'");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }

    public function getTeamMemberById($TeamId) {

        $result = $this->db->query(" SELECT firstname,lastname,parent_user_id from tbl_users_team WHERE id = '" . $TeamId . "'");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }


    /**
     * This function will return Twilio related account details based on the Phone number
     * @param type $contactNo
     * @return type
     */

    public function getTwilioAccount($contactNo) {

        if (strpos($contactNo, '+') !== false) {
            $phone = $contactNo;
        } else {
            $phone = '+1' . $contactNo;
        }
        $result = $this->db->query("SELECT * FROM tbl_twilio_accounts WHERE contact_no='{$contactNo}' OR contact_no='{$phone}' LIMIT 1");
        $response = $result->row();

        if (empty($response)) {
            $result = $this->db->query("SELECT tbl_users_team.*, tbl_users_team.parent_user_id AS user_id FROM tbl_users_team WHERE bb_number='{$contactNo}' OR bb_number='{$phone}' LIMIT 1");
            $response = $result->row();
        }
        return $response;
    }
 

    /**
     * This function will return Client Twilio account details
     * @param type $contactNo
     * @return type
     */

   public static function getClientTwilioAccountDetails($currentUserid)
   {

        $oData = DB::table('tbl_twilio_accounts')
                ->where('user_id', $currentUserid)
                ->first();

          return $oData;


   }


    /**
     * This function will return Team member Twilio account details
     * @param type $contactNo
     * @return type
     */

   public function getTeamTwilioAccountDetails($currentUserid)
   {

        $oData = DB::table('tbl_users_team')
                ->where('id', $currentUserid)
                ->first();

          return $oData;


   }




    public function getteam_member_name($usrid) {

        $result = $this->db->query(" SELECT CONCAT(tbl_users_team.firstname, ' ', tbl_users_team.lastname) as teamName FROM `tbl_chat_supportuser` where tbl_chat_supportuser.user = '" . $usrid . "'");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }


  /**
  * This function will return Team Member name by the Phone number
  * @param type $usrid
  * @return type
  */

    public function get_sms_team_member_name($usrid) {

      $oData = DB::select(DB::raw("  SELECT CONCAT(tbl_users_team.firstname, ' ', tbl_users_team.lastname) as teamName FROM `tbl_users_team` where tbl_users_team.id = '" . $usrid . "' "));

          return $oData;

    }

    public function getlastChatMessageDetail($token) {

        $result = $this->db->query("SELECT * FROM `tbl_chat_message` WHERE `token` ='" . $token . "' order by id desc limit 1");
        $response = $result->result();
        //echo $this->db->last_query();die;
        return $response;
    }

    public function activeOnlywebDetailsByinput($userID, $searchval) {

        if ($searchval != "") {
            $result = $this->db->query(" SELECT 
      tcm_subs.*
FROM 
      tbl_chat_message tc INNER JOIN 
      (SELECT * FROM tbl_chat_message group by token, created ORDER BY created DESC) as tcm_subs ON tc.token = tcm_subs.token 
      WHERE (tc.user_to = '" . $userID . "' or tc.user_form ='" . $userID . "') AND tc.message  LIKE '%" . $searchval . "%'
      GROUP BY tc.token ORDER BY tcm_subs.created DESC");
        } else {
            $result = $this->db->query(" SELECT 
      tcm_subs.*
FROM 
      tbl_chat_message tc INNER JOIN 
      (SELECT * FROM tbl_chat_message group by token, created ORDER BY created DESC) as tcm_subs ON tc.token = tcm_subs.token 
      WHERE (tc.user_to = '" . $userID . "' or tc.user_form ='" . $userID . "') 
      GROUP BY tc.token ORDER BY tcm_subs.created DESC");
        }

        $response = $result->result();

        // echo $this->db->last_query();
        return $response;
    }

    public function searchSmsByinputDetails($Number, $searchval) {

        if ($searchval != "") {
            $result = $this->db->query("SELECT 
      tcm_subs1.*
FROM 
      tbl_chat_sms_thread tc1 INNER JOIN 
      (SELECT * FROM tbl_chat_sms_thread group by token, created ORDER BY created DESC) as tcm_subs1 ON tc1.token = tcm_subs1.token 
      WHERE (tc1.to = '" . $Number . "' or tc1.from ='" . $Number . "') AND tc1.msg  LIKE '%" . $searchval . "%'
      GROUP BY tc1.token ORDER BY tcm_subs1.created DESC ");
        } else {
            $result = $this->db->query("SELECT 
      tcm_subs1.*
FROM 
      tbl_chat_sms_thread tc1 INNER JOIN 
      (SELECT * FROM tbl_chat_sms_thread group by token, created ORDER BY created DESC) as tcm_subs1 ON tc1.token = tcm_subs1.token 
      WHERE (tc1.to = '" . $Number . "' or tc1.from ='" . $Number . "') AND tc1.msg  LIKE '%" . $searchval . "%'
      GROUP BY tc1.token ORDER BY tcm_subs1.created DESC ");
        }

        $response = $result->result();

        // echo $this->db->last_query();
        return $response;
    }

 /**
 * This function will return Client/User details by the Phone number
 * @param type $Number
 * @return type
 */

    public static function getUserbyPhoneDetails($Number) {
        $oData = DB::table('tbl_subscribers')
                ->where('phone', $Number)
                ->get();

        return $oData;
    }

    public function smschatUsersDetails($number) {

        $result = $this->db->query("select * from tbl_chat_sms_thread where  `to` = '" . $number . "' order by id desc");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }

    public function getincIdByuserIdval($userID) {

        $result = $this->db->query("select id from tbl_subscribers where  `user_id` = '" . $userID . "'");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }

      /**
     * This function will only Client/User id by the phone number
     * @param type $number
     * @return type
     */

    public static function getincIdByPhoneval($number) {
            $oData = DB::table('tbl_subscribers')
                ->select('id')
                ->where('phone', $number)
                ->get();

        return $oData;
    }

    public function getuserImageDetails($userID) {
        $this->db->select("tbl_users.avatar as avatarImage");
        $this->db->where("id", $userID);
        $result = $this->db->get("tbl_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getSearchsubsList($contact_no, $searchvalue) {

        $result = $this->db->query('SELECT * FROM `tbl_chat_sms_thread` WHERE  ( (`from` LIKE "%' . $contact_no . '%" ) OR (`to` LIKE "%' . $contact_no . '%" )  ) and  ( `msg` LIKE "%' . $searchvalue . '%" ) AND `to`!="" GROUP BY `from`,`to` ');
        $response = $result->result();
        //echo $this->db->last_query();die;
        return $response;
    }

    public function getLatestChatView($userID) {
        $result = $this->db->query("select
        ts.*, tcm_subs.created as chatMsgCreated,
        (SELECT avatar FROM tbl_users tus WHERE tus.id=ts.user_id) as avatar
        FROM
        tbl_subscribers ts
        INNER JOIN tbl_users tu ON(ts.owner_id = tu.id)
        LEFT JOIN
        (SELECT * FROM tbl_chat_message  group by user_to, date(created) desc ORDER BY created DESC) as tcm_subs
        ON ts.user_id = tcm_subs.user_to
        WHERE
        ts.user_id is NOT NULL AND
        tu.id = '" . $userID . "'
        GROUP BY ts.user_id
        ORDER BY tcm_subs.created DESC ");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }

    public function getOldestChatView($userID) {
        $result = $this->db->query("select
        ts.*, tcm_subs.created as chatMsgCreated
        FROM
        tbl_subscribers ts
        INNER JOIN tbl_users tu ON(ts.owner_id = tu.id)
        LEFT JOIN
        (SELECT * FROM tbl_chat_message  group by user_to, date(created) asc ORDER BY created asc) as tcm_subs
        ON ts.user_id = tcm_subs.user_to
        WHERE
        ts.user_id is NOT NULL AND
        tcm_subs.message is NOT NULL AND
        tu.id = '" . $userID . "'
        GROUP BY ts.user_id
        ORDER BY tcm_subs.created asc ");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }

    public function getWaitingChatView($userID) {
        $result = $this->db->query("SELECT * FROM `tbl_chat_message` WHERE `user_to` ='" . $userID . "' and `read_status` = 0 group by user_form ORDER by `created` desc");
        $response = $result->result();

        //echo $this->db->last_query();die;
        return $response;
    }

    public function getownersDetails($userID) {
        $this->db->select("tbl_subscribers.*");
        $this->db->where("tbl_subscribers.user_id", $userID);
        $this->db->where("tbl_subscribers.owner_id is NOT NULL");
        $this->db->where('tbl_subscribers.owner_id !=', $userID);
        $this->db->order_by("tbl_subscribers.id", "DESC");
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();die;
        return $response;
    }

    public function getGlobalSubscribersAdminChat($userRole) {

        $this->db->select("tbl_users.*");
        $this->db->where("tbl_users.user_role", $userRole);
        $result = $this->db->get("tbl_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function archiveGlobalSubscriber($userID, $id, $aData) {
        $this->db->where("id", $id);
        $this->db->where("owner_id", $userID);
        $result = $this->db->update("tbl_subscribers", $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteGlobalSubscriber($userID, $id) {
        $this->db->where("id", $id);
        $this->db->where("owner_id", $userID);
        $result = $this->db->delete('tbl_subscribers');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

  
     /**
     * This function will return subscriber by the charName
     * @param type $userID
     * @param type $char
     * @return type
     */

    public static function getGlobalSubscribersByChar($userID, $char) {
        
        $oData = DB::table('tbl_subscribers')
                ->where('owner_id', $userID)
                ->where('firstname', 'like', $char.'%')
                ->where('status', 1)
                ->get();

        return $oData;
    }

    public function getGlobalSubscribersByCharDetails($userID, $char) {

        $response = array();
        $this->db->where("owner_id", $userID);
        $this->db->like('firstname', $char, 'after');
        $this->db->where('status', 1);
        $this->db->from('tbl_subscribers');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function addModuleSubscriber($aData, $moduleName, $tableName) {
        $bAddNewEntry = false;
        $subscriberID = $aData['subscriber_id'];
        if ($moduleName == 'list') {
            $listID = $aData['list_id'];
            if (!empty($subscriberID) && !empty($listID)) {
                $bAlreadyExists = $this->checkIfExistingModuleSubscriber($listID, $subscriberID, $moduleName, $tableName);
                if ($bAlreadyExists == false) {
                    $bAddNewEntry = true;
                } else {
                    return true;
                }
            } else {
                $bAddNewEntry = true;
            }
        } else if ($moduleName == 'brandboost') {
            $brandboostID = $aData['brandboost_id'];
            if (!empty($subscriberID) && !empty($brandboostID)) {
                $bAlreadyExists = $this->checkIfExistingModuleSubscriber($brandboostID, $subscriberID, $moduleName, $tableName);
                if ($bAlreadyExists == false) {
                    $bAddNewEntry = true;
                } else {
                    return true;
                }
            } else {
                $bAddNewEntry = true;
            }
        } else if ($moduleName == 'referral' || $moduleName == 'nps') {
            $accountID = $aData['account_id'];
            if (!empty($subscriberID) && !empty($accountID)) {
                $bAlreadyExists = $this->checkIfExistingModuleSubscriber($accountID, $subscriberID, $moduleName, $tableName);
                if ($bAlreadyExists == false) {
                    $bAddNewEntry = true;
                } else {
                    return true;
                }
            } else {
                $bAddNewEntry = true;
            }
        }

        if ($bAddNewEntry == true) {
            $result = $this->db->insert($tableName, $aData);
            $inset_id = $this->db->insert_id();
            if ($result)
                return $inset_id;
        }
        return false;
    }

    public function checkIfExistingModuleSubscriber($moduleAccountID, $subscriberID, $moduleName, $tableName) {

        if ($moduleName == 'list') {
            $this->db->where("list_id", $moduleAccountID);
        } else if ($moduleName == 'brandboost') {
            $this->db->where("brandboost_id", $moduleAccountID);
        } else if ($moduleName == 'referral' || $moduleName == 'nps') {
            $this->db->where("account_id", $moduleAccountID);
        }
        $this->db->where("subscriber_id", $subscriberID);
        $result = $this->db->get("{$tableName}");
        //echo $this->db->last_query();
        //die;
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function getModuleSubscribers($userID, $moduleName, $moduleAccountID) {

        if ($moduleName == 'list') {
            $oSubscribers = $this->getlistModuleContacts($userID, $moduleAccountID);
        } else if ($moduleName == 'brandboost') {
            $oSubscribers = $this->getBrandboostModuleContacts($userID, $moduleAccountID);
        } else if ($moduleName == 'referral') {
            $oSubscribers = $this->getReferralModuleContacts($userID, $moduleAccountID);
        } else if ($moduleName == 'nps') {
            $oSubscribers = $this->getNpsModuleContacts($userID, $moduleAccountID);
        } else if ($moduleName == 'people') {
            $oSubscribers = $this->getGlobalSubscribers($userID);
        }

        return $oSubscribers;
    }

    public function getlistModuleContacts($userID = '', $listID = '') {
        $this->db->select("tbl_subscribers.*, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_common_lists", "tbl_common_lists.id=tbl_automation_users.list_id", "INNER");
        $this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");

        if ($listID > 0) {
            $this->db->where("tbl_automation_users.list_id", $listID);
        }
        if ($userID > 0) {
            $this->db->where("tbl_common_lists.user_id", $userID);
        }
        $result = $this->db->get("tbl_automation_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getBrandboostModuleContacts($userID = '', $brandboostID) {
        $response = array();
        $this->db->select("tbl_subscribers.*, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id= tbl_subscribers.id", "LEFT");
        if ($brandboostID > 0) {
            $this->db->where('tbl_brandboost_users.brandboost_id', $brandboostID);
        }

//        if ($userID > 0) {
//            $this->db->where("tbl_brandboost_users.user_id", $userID);
//        }
        $this->db->order_by('tbl_brandboost_users.id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReferralModuleContacts($userID = '', $accountID) {
        $this->db->select("tbl_subscribers.*, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id=tbl_subscribers.id", "LEFT");
        if ($accountID > 0) {
            $this->db->where("tbl_referral_users.account_id", $accountID);
        }

        $this->db->order_by('tbl_referral_users.id', 'DESC');
        $result = $this->db->get("tbl_referral_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getNpsModuleContacts($userID = '', $accountID) {
        $this->db->select("tbl_subscribers.*, tbl_subscribers.id AS global_user_id");
        $this->db->join("tbl_subscribers", "tbl_nps_users.subscriber_id=tbl_subscribers.id", "LEFT");

        if (!empty($accountID)) {
            $this->db->where("tbl_nps_users.account_id", $accountID);
        }
        $this->db->order_by('tbl_nps_users.id', 'DESC');
        $result = $this->db->get("tbl_nps_users");
        //echo $this->db->last_query();
        //die;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getModuleSubscriberInfo($moduleName, $moduleSubsID) {
        if ($moduleName == 'list') {
            $oDetails = $this->getListContactInfo($moduleSubsID);
        } else if ($moduleName == 'brandboost') {
            $oDetails = $this->getBrandboostContactInfo($moduleSubsID);
        } else if ($moduleName == 'referral') {
            $oDetails = $this->getReferralContactInfo($moduleSubsID);
        } else if ($moduleName == 'nps') {
            $oDetails = $this->getNpsContactInfo($moduleSubsID);
        } else if ($moduleName == 'people') {
            $oDetails = $this->getPeopleSubscriberInfo($moduleSubsID);
        } else if ($moduleName == 'review') {
            $oDetails = $this->getPeopleSubscriberInfo($moduleSubsID);
        } else {
            $oDetails = $this->getGlobalSubscriberInfo($moduleSubsID);
        }
        return $oDetails;
    }

    public function getListContactInfo($id = '') {
        $this->db->select("tbl_automation_users.id AS subsID, tbl_automation_users.status AS subs_status,tbl_automation_users.created AS subs_created, tbl_subscribers.*");
        $this->db->join("tbl_subscribers", "tbl_automation_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_automation_users.id", $id);
        $result = $this->db->get("tbl_automation_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getBrandboostContactInfo($id = '') {
        $response = array();
        $this->db->select('tbl_brandboost_users.id AS subsID, tbl_brandboost_users.status AS subs_status,tbl_brandboost_users.created AS subs_created, tbl_subscribers.*');
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id= tbl_subscribers.id", "LEFT");
        $this->db->where('tbl_brandboost_users.id', $id);
        $this->db->order_by('tbl_brandboost_users.id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReferralContactInfo($id = '') {
        $this->db->select("tbl_referral_users.id AS subsID, tbl_referral_users.status AS subs_status,tbl_referral_users.created AS subs_created, tbl_subscribers.*");
        $this->db->join("tbl_subscribers", "tbl_referral_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_referral_users.id", $id);
        $result = $this->db->get("tbl_referral_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getNpsContactInfo($id = '') {
        $this->db->select("tbl_nps_users.id AS subsID, tbl_nps_users.status AS subs_status,tbl_nps_users.created AS subs_created, tbl_subscribers.*");
        $this->db->join("tbl_subscribers", "tbl_nps_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where("tbl_nps_users.id", $id);
        $result = $this->db->get("tbl_nps_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateModuleSubscriber($moduleName = '', $aData, $id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            if ($moduleName == 'list') {
                $bUpdated = $this->db->update("tbl_automation_users", $aData);
            } else if ($moduleName == 'brandboost') {
                $bUpdated = $this->db->update("tbl_brandboost_users", $aData);
            } else if ($moduleName == 'referral') {
                $bUpdated = $this->db->update("tbl_referral_users", $aData);
            } else if ($moduleName == 'nps') {
                $bUpdated = $this->db->update("tbl_nps_users", $aData);
            } else if ($moduleName == 'people') {
                $bUpdated = $this->db->update("tbl_subscribers", $aData);
            } else {
                //Do nothing
            }
        }
//echo $this->db->last_query();die;
        return $bUpdated;
    }

    public function updateModuleSubscriberByid($aData, $id) {

        if ($id > 0) {
            $this->db->where("id", $id);

            $bUpdated = $this->db->update("tbl_subscribers", $aData);
        }

        return $bUpdated;
    }

    public function addBrandboostUserAccount($aData, $iRole = 2, $sendNotification = false) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/chargebee-php/lib/ChargeBee.php';
        $cbSite = $this->config->item('cb_site_name');
        $cbSiteToken = $this->config->item('cb_access_token');
        ChargeBee_Environment::configure($cbSite, $cbSiteToken);
        $this->load->model("CBee_model", "mChargebeeModel");

        $firstName = $aData['firstname'];
        $lastName = $aData['lastname'];
        $email = $aData['email'];
        $mobile = $aData['mobile'];
        $country = $aData['country'];
        $city = $aData['city'];
        $ext_country_code = $aData['ext_country_code'];
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 7; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        $password = strip_tags($randstring);

        $userID = $this->checkIfBrandboostUserExists(array('email' => $email));
        if ($userID == false) {
            $aChargebeeData = array(
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email
            );
            $chargebeeUserID = $this->mChargebeeModel->createContact($aChargebeeData);

            $password_hash = $this->config->item('password_hash');
            $siteSalt = $this->config->item('siteSalt');
            $pwd = base64_encode($password . $password_hash . $siteSalt);
            $aUserData = array(
                'cb_contact_id' => $chargebeeUserID,
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'mobile' => $mobile,
                'country' => $country,
                'city' => $city,
                'ext_country_code' => $ext_country_code,
                'user_role' => $iRole,
                'status' => 1,
                'password' => $pwd,
                'created' => date("Y-m-d H:i:s")
            );

            $result = $this->db->insert('tbl_users', $aUserData);
            if ($result) {
                $userID = $this->db->insert_id();
                //Add entry in notification table
                //$this->db->insert("tbl_users_notification_settings", array('user_id'=> $userID, 'notify_email'=>$email));
                $aNotifySetting = array(
                    'user_id' => $userID,
                    'notify_email' => $email,
                    'created' => date("Y-m-d H:i:s")
                );

                $this->addUserNotificationSettingsEntry($aNotifySetting);
            }

            if (!empty($userID) && ($sendNotification == true)) {
                //Send Email Notification about registration on brandboost
                sendEmailTemplate('welcome', $userID);
                //Send Notification
                $aNotifyData = array(
                    'user_id' => $userID,
                    'event_type' => 'user_registration',
                    'message' => 'Welcome to the brandboost',
                    'link' => base_url() . 'admin/profile',
                    'created' => date("Y-m-d H:i:s")
                );
                $eventName = 'user_registration';
                add_notifications($aNotifyData, $eventName, $userID, $notifyAdmin = true);
            }
        }
        if (!empty($userID))
            return $userID;
        else
            return false;
    }

    public function getActualUser($aParam) {
        if (!empty($aParam)) {
            $key = array_keys($aParam);
            $val = array_values($aParam);
            $this->db->where($key[0], $val[0]);
            $this->db->limit(1);
            $result = $this->db->get("tbl_users");
            //echo $this->db->last_query();
            if ($result->num_rows() > 0) {
                return $result->row()->id;
            }
        }
        return false;
    }

    public function registerUserAlongWithSubscriber($aData) {
        $firstName = $aData['firstname'];
        $lastName = $aData['lastname'];
        $email = $aData['email'];
        $phone = $aData['phone'];
        $countryCode = $aData['country_code'];
        $cityName = $aData['cityName'];
        $clientID = $aData['clientID'];
        if (empty($email) || empty($clientID)) {
            return false;
            exit;
        }

        $bRegistredSubscriber = false;
        $aSubscriberData = array(
            'owner_id' => $clientID,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'created' => date("Y-m-d H:i:s")
        );

        if (!empty($countryCode)) {
            $aSubscriberData['country_code'] = $countryCode;
        }

        if (!empty($cityName)) {
            $aSubscriberData['cityName'] = $cityName;
        }


        $userID = $this->getActualUser(array('email' => $email));
        if (empty($userID)) {
            //Start registration process
            //Check if exists in global subscriber table
            $oGlobalUser = $this->checkIfGlobalSubscriberExists($clientID, 'email', $email);
            if (!empty($oGlobalUser)) {
                //Subscriber exists already
                $subscriberID = $oGlobalUser->id;
                $bRegistredSubscriber = true;
            } else {
                //Register Subscriber
                $subscriberID = $this->addGlobalSubscriber($aSubscriberData);
                $bRegistredSubscriber = true;
            }

            if ($bRegistredSubscriber == true) {
                //Register user now
                $aRegistrationData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'mobile' => $phone
                );
                $userID = $this->addBrandboostUserAccount($aRegistrationData, 2, true);
            }

            if ($bRegistredSubscriber == true && $userID > 0) {
                $aUpdateGlobalSubsData = array(
                    'user_id' => $userID,
                    'updated' => date("Y-m-d H:i:s")
                );

                $bUpdated = $this->updateGlobalSubscriber($aUpdateGlobalSubsData, $subscriberID);

                //End
            }
        } else {
            //User already exists
            //check whether or not subscriber exists for the same users
            $oGlobalUser = $this->checkIfGlobalSubscriberExists($clientID, 'email', $email);
            if (empty($oGlobalUser)) {
                //subscriber doesn't exists
                $aSubscriberData['user_id'] = $userID;
                $subscriberID = $this->addGlobalSubscriber($aSubscriberData);
            } else {
                //subscriber exists
                $subscriberID = $oGlobalUser->id;
                //if user_id is not attached to subscriber then attach it
                if (empty($oGlobalUser->user_id) && $subscriberID > 0) {
                    $aUpdateGlobalSubsData = array(
                        'user_id' => $userID,
                        'updated' => date("Y-m-d H:i:s")
                    );

                    $bUpdated = $this->updateGlobalSubscriber($aUpdateGlobalSubsData, $subscriberID);
                }
            }
        }

        return $userID;
    }

    public function addUserNotificationSettingsEntry($aData) {
        $this->db->insert("tbl_users_notification_settings", $aData);
    }

    public function checkIfBrandboostUserExists($aParam) {
        if (!empty($aParam)) {
            $key = array_keys($aParam);
            $val = array_values($aParam);
            $this->db->where($key[0], $val[0]);
            $this->db->limit(1);
            $result = $this->db->get("tbl_users");
            //echo $this->db->last_query();
            if ($result->num_rows() > 0) {
                return $result->row()->id;
            }
        }
        return false;
    }

    public function deleteModuleSubscriber($subscriberID, $moduleName, $moduleUnitID) {

        if ($subscriberID > 0 && !empty($moduleName)) {


            if ($moduleName == 'automation' || $moduleName == 'broadcast' || $moduleName == 'list') {
                $this->db->where("id", $subscriberID);
                $bUpdated = $this->db->delete("tbl_automation_users");
            } else if ($moduleName == 'brandboost') {
                $this->db->where("subscriber_id", $subscriberID);
                $this->db->where("brandboost_id", $moduleUnitID);
                $bUpdated = $this->db->delete("tbl_brandboost_users");
                if ($bUpdated) {
                    $this->deleteModuleCampaignSubscriber($subscriberID, $moduleName, $moduleUnitID);
                }
            } else if ($moduleName == 'referral') {
                //$this->db->where("account_id", $moduleUnitID);
                $this->db->where("id", $subscriberID);
                $bUpdated = $this->db->delete("tbl_referral_users");
            } else if ($moduleName == 'nps') {
                //$this->db->where("account_id", $moduleUnitID);
                $this->db->where("subscriber_id", $subscriberID);
                $this->db->where("account_id", $moduleUnitID);
                $bUpdated = $this->db->delete("tbl_nps_users");
                if ($bUpdated) {
                    $this->deleteModuleCampaignSubscriber($subscriberID, $moduleName, $moduleUnitID);
                }
            } else if ($moduleName == 'people') {
                //$this->db->where("account_id", $moduleUnitID);
                $this->db->where("id", $subscriberID);
                $bUpdated = $this->db->delete("tbl_subscribers");
            } else {
                //Do nothing
            }
            //echo $this->db->last_query(); exit;
        }

        if ($bUpdated) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteModuleCampaignSubscriber($subscriberID, $moduleName, $moduleUnitID) {

        if ($subscriberID > 0 && !empty($moduleName)) {

            $this->db->where("subscriber_id", $subscriberID);
            if ($moduleName == 'brandboost') {
                $this->db->where("brandboost_id", $moduleUnitID);
                $bUpdated = $this->db->delete("tbl_brandboost_campaign_users");
            } else if ($moduleName == 'referral') {
                //$this->db->where("account_id", $moduleUnitID);
                $bUpdated = $this->db->delete("tbl_referral_users");
            } else if ($moduleName == 'nps') {
                //$this->db->where("account_id", $moduleUnitID);
                $this->db->where("nps_id", $moduleUnitID);
                $bUpdated = $this->db->delete("tbl_nps_campaign_users");
            } else {
                //Do nothing
            }
            //echo $this->db->last_query(); exit;
        }

        if ($bUpdated) {
            return true;
        } else {
            return false;
        }
    }

    public function removeContactFromList($subscriberID, $listID) {
        $this->db->where("subscriber_id", $subscriberID);
        $this->db->where("list_id", $listID);
        $bUpdated = $this->db->delete("tbl_automation_users");
        if ($bUpdated) {
            return true;
        } else {
            return false;
        }
    }

    public function getSuppressionList() {
        $aEmails = array();
        $result = $this->db->get("tbl_suppression_list");
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $oRec) {
                $aEmails[] = strtolower($oRec->email);
            }
        }
        return $aEmails;
    }

    public function addContactNotes($aData) {
        $result = $this->db->insert("tbl_subscriber_notes", $aData);

        if ($result)
            return true;
        else
            return false;
    }

    public function getSubscribersById($subID) {
        $this->db->select("tbl_subscribers.*");
        $this->db->where("id", $subID);
        $result = $this->db->get("tbl_subscribers");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getUserById($userID) {
        $this->db->select("tbl_users.*");
        $this->db->where("id", $userID);
        $result = $this->db->get("tbl_users");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getUserActivities($userID) {

        $this->db->select("tbl_user_activities.*");
        $this->db->where("user_id", $userID);
        $this->db->order_by("id", "DESC");
        $this->db->limit(15, 0);
        $result = $this->db->get("tbl_user_activities");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getSubscriberEmailSms($subsId, $type = 'email') {

        $this->db->select("tbl_brandboost_users.*, tbl_brandboost.brand_title, tbl_brandboost.id as brand_id, tbl_brandboost.review_type as brand_type, tbl_tracking_log_email_sms.created as trackdate");
        $this->db->where("tbl_brandboost_users.subscriber_id", $subsId);
        $this->db->where("tbl_tracking_log_email_sms.type", $type);
        $this->db->join("tbl_tracking_log_email_sms", "tbl_brandboost_users.id=tbl_tracking_log_email_sms.subscriber_id", "INNER");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_brandboost_users.brandboost_id", "INNER");
        $this->db->order_by("tbl_tracking_log_email_sms.created", "DESC");
        $result = $this->db->get("tbl_brandboost_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getReferalSubscriberEmailSms($subsId, $type = 'email') {

        $this->db->select("tbl_referral_users.*, tbl_referral_rewards.title, tbl_referral_rewards.id as referral_id, tbl_referral_automations_tracking_logs.created_at as trackdate");
        $this->db->where("tbl_referral_users.subscriber_id", $subsId);
        $this->db->where("tbl_referral_automations_tracking_logs.campaign_type", $type);
        $this->db->join("tbl_referral_automations_tracking_logs", "tbl_referral_users.id=tbl_referral_automations_tracking_logs.subscriber_id", "INNER");
        $this->db->join("tbl_referral_rewards", "tbl_referral_rewards.hashcode=tbl_referral_users.account_id", "INNER");
        $this->db->order_by("tbl_referral_automations_tracking_logs.created_at", "DESC");
        $result = $this->db->get("tbl_referral_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getNpsSubscriberEmailSms($subsId, $type = 'email') {

        $this->db->select("tbl_nps_users.*, tbl_nps_main.title, tbl_nps_main.id as npm_id , tbl_nps_automations_tracking_logs.created_at as trackdate");
        $this->db->where("tbl_nps_users.subscriber_id", $subsId);
        $this->db->where("tbl_nps_automations_tracking_logs.campaign_type", $type);
        $this->db->join("tbl_nps_automations_tracking_logs", "tbl_nps_users.id=tbl_nps_automations_tracking_logs.subscriber_id", "INNER");
        $this->db->join("tbl_nps_main", "tbl_nps_main.hashcode=tbl_nps_users.account_id", "INNER");
        $this->db->order_by("tbl_nps_automations_tracking_logs.created_at", "DESC");
        $result = $this->db->get("tbl_nps_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAutomationSubsEmailSms($subsId, $type = 'email') {

        $this->db->select("tbl_automation_users.*, tbl_automations_emails.title, tbl_automations_emails.id as automation_id, tbl_automations_emails_tracking_logs.created_at as trackdate");
        $this->db->where("tbl_automation_users.subscriber_id", $subsId);
        $this->db->where("tbl_automations_emails_tracking_logs.campaign_type", $type);
        $this->db->join("tbl_automations_emails_tracking_logs", "tbl_automation_users.id=tbl_automations_emails_tracking_logs.subscriber_id", "INNER");
        $this->db->join("tbl_automations_emails_lists", "tbl_automations_emails_lists.list_id=tbl_automation_users.list_id", "INNER");
        $this->db->join("tbl_automations_emails", "tbl_automations_emails_lists.automation_id = tbl_automations_emails.id", "INNER");
        $this->db->order_by("tbl_automations_emails_tracking_logs.created_at", "DESC");
        $result = $this->db->get("tbl_automation_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getContactNotes($subsId) {
        $loginUserData = getLoggedUser($redirect = false);
        if (empty($loginUserData)) {
            return;
            exit();
        }
        if (strlen($subsId) > 10) {
            $result = $this->db->query("SELECT `tbl_subscriber_notes`.*, `tbl_chat_supportuser`.`user_name` FROM `tbl_subscriber_notes` INNER JOIN `tbl_chat_supportuser` ON `tbl_subscriber_notes`.`subscriber_id` = `tbl_chat_supportuser`.`user` WHERE `tbl_subscriber_notes`.`user_id` = '" . $loginUserData->id . "' AND `tbl_subscriber_notes`.`subscriber_id` = '" . $subsId . "' ORDER BY `tbl_subscriber_notes`.`created` ASC");
        } else {
            $this->db->select("tbl_subscriber_notes.*, tbl_users.firstname, tbl_users.lastname");
            $this->db->where("tbl_subscriber_notes.subscriber_id", $subsId);
            $this->db->order_by("tbl_subscriber_notes.created", "ASC");
            $this->db->join("tbl_users", "tbl_subscriber_notes.user_id = tbl_users.id", "INNER");
            $result = $this->db->get("tbl_subscriber_notes");
        }


        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }


     /**
    * This function will return notes
    * @param type $usrid
    * @return type
    */

    public function visitornotes($usrid) {

      $oData = DB::table('tbl_visitor_notes')
      ->where('user', $usrid)
      ->get();

      return $oData;

    }

    public function getSubscriberBBCampaigns($subscriberID) {
        $this->db->select("tbl_brandboost_users.*, tbl_brandboost.brand_title, tbl_brandboost.review_type ");
        $this->db->join("tbl_brandboost", "tbl_brandboost_users.brandboost_id=tbl_brandboost.id", "LEFT");
        $this->db->where("tbl_brandboost_users.subscriber_id", $subscriberID);
        //$this->db->group_by("tbl_brandboost.id");
        $result = $this->db->get("tbl_brandboost_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getSubscriberNPSCampaigns($subscriberID) {
        $this->db->select("tbl_nps_users.*, tbl_nps_main.title");
        $this->db->join("tbl_nps_main", "tbl_nps_users.account_id=tbl_nps_main.hashcode", "LEFT");
        $this->db->where("tbl_nps_users.subscriber_id", $subscriberID);
        $result = $this->db->get("tbl_nps_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getSubscriberReferralCampaigns($subscriberID) {
        $this->db->select("tbl_referral_users.*, tbl_referral_rewards.title");
        $this->db->join("tbl_referral_rewards", "tbl_referral_users.account_id=tbl_referral_rewards.hashcode", "LEFT");
        $this->db->where("tbl_referral_users.subscriber_id", $subscriberID);
        $result = $this->db->get("tbl_referral_users");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getSubsByBrandboostId($brandID, $subID) {
        $this->db->select("tbl_brandboost_users.*");
        $this->db->where("brandboost_id", $brandID);
        $this->db->where("subscriber_id", $subID);
        $result = $this->db->get("tbl_brandboost_users");
        /* if ($result->num_rows() > 0) {
          $response = $result->row();userId
          } */
        return $result->num_rows();
    }

    public function updateSubsByBrandboostId($brandID, $subID, $userId) {
        $this->db->where("brandboost_id", $brandID);
        $this->db->where("subscriber_id", $subID);
        $result = $this->db->update("tbl_brandboost_users", array('user_id' => $userId));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertSubsByBrandboostId($brandID, $subID, $userId) {

        $aData = array(
            'brandboost_id' => $brandID,
            'user_id' => $userId,
            'subscriber_id' => $subID,
            'created' => date("Y-m-d H:i:s")
        );
        $result = $this->db->insert("tbl_brandboost_users", $aData);
        $inset_id = $this->db->insert_id();
        if ($result)
            return $inset_id;
    }

    public function smsDetailSubs($userId) {

        $response = array();
        $this->db->select("tbl_subscribers.id as subsId, tbl_broadcast_emails_tracking_twillio.*");
        $this->db->join("tbl_broadcast_emails_tracking_twillio", "tbl_subscribers.id=tbl_broadcast_emails_tracking_twillio.subscriber_id", "INNER");
        $this->db->where("tbl_subscribers.owner_id", $userId);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function smsDetailAutomation($userId) {

        $response = array();
        $this->db->select("tbl_subscribers.id as subsId, tbl_automations_emails_tracking_twillio.*");
        $this->db->join("tbl_automations_emails_tracking_twillio", "tbl_subscribers.id=tbl_automations_emails_tracking_twillio.subscriber_id", "INNER");
        $this->db->where("tbl_subscribers.owner_id", $userId);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function smsDetailReferral($userId) {

        $response = array();
        $this->db->select("tbl_subscribers.id as subsId, tbl_referral_automations_tracking_twillio.*");
        $this->db->join("tbl_referral_automations_tracking_twillio", "tbl_subscribers.id=tbl_referral_automations_tracking_twillio.subscriber_id", "INNER");
        $this->db->where("tbl_subscribers.owner_id", $userId);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function smsDetailNPS($userId) {

        $response = array();
        $this->db->select("tbl_subscribers.id as subsId, tbl_nps_automations_tracking_twillio.*");
        $this->db->join("tbl_nps_automations_tracking_twillio", "tbl_subscribers.id=tbl_nps_automations_tracking_twillio.subscriber_id", "INNER");
        $this->db->where("tbl_subscribers.owner_id", $userId);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function smsDetailOnsite($userId) {

        $response = array();
        $this->db->select("tbl_subscribers.id as subsId, tbl_track_twillio.*");
        $this->db->join("tbl_track_twillio", "tbl_subscribers.id=tbl_track_twillio.subscriber_id", "INNER");
        $this->db->where("tbl_subscribers.owner_id", $userId);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function smsDetailChat($mobileNum) {

        $response = array();
        $this->db->select("*");
        $this->db->where("from", $mobileNum);
        $result = $this->db->get("tbl_chat_sms_thread");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

}
