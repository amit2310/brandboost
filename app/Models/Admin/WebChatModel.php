<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class WebChatModel extends Model {

    /**
     * Get Team Assign
     * @param type $teamId
     * @return type number
     */
    public function getTeamAssign($teamId) {

        $oResult = DB::table('tbl_chat_supportuser')
                ->where('assign_team_member', $teamId)
                ->get();
        $rCount = $oResult->count();
        return $rCount;
    }


    /**
     * Get Team Assign Data
     * @param type $teamId
     * @return type object
     */
    public function getTeamAssignData($teamId, $isOrderBy=false) {

        $query = DB::table('tbl_chat_supportuser')
                ->where('assign_team_member', $teamId);
        if($isOrderBy == true){
            $query->orderBy('id', 'desc');
        }
        $oResult = $query->get();
        return $oResult;
    }

     /**
     * this function is used to get the webchat notes
     * @param type $userid
     * @return type object
     */

    public function getWebNotes($userid) {

        $oResult = DB::table('tbl_visitor_notes')
                ->where('user', $userid)
                ->get();
          return $oResult;
    }


     /**
    * This function used to get all the webchat messages
    * @return type
    */
    public function getwebchatMessages($token) {
        $oData = DB::table('tbl_chat_message')
        ->where('token', $token)
        ->where('status', 1)
        ->orderBy('id', 'asc')
        ->get();
        return $oData;
    }

     /**
    * This function is used to add the web notes
    * @return type
    */
    public function addWebNotes($data)
    {

       $oData = DB::table('tbl_visitor_notes')->insertGetId($data);
      return $oData;

    }


    /**
     * this function is used to update the read status
     * @param type $to_user
     * @param type $from_user
     * @param type $aData
     * @return type boolean
     */
    public function readChatMsg($to_user, $from_user, $aData) {

        $result = DB::table('tbl_chat_message')
            ->where('user_to', $from_user)
            ->where('user_form', $to_user)
            ->where('read_status', '0')
            ->update($aData);

        return true;

    }


    /**
     * this function is used update last login
     * @param type $userId
     * @param type $aData
     * @return type boolean
     */
    public function lastLoginDetail($userId, $aData) {

        $result = DB::table('tbl_users')
            ->where('id', $userId)
            ->update($aData);

        return true;
    }


    /**
     * this function is used for add chat message
     * @param type $aData
     * @return type last insert id
     */
    public function addChatMsg($aData){

        $insert_id = DB::table('tbl_chat_message')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * this function is used for update last chat time
     * @param type $token
     * @param type $isLoggedInTeam
     * @return type boolean
     */
    public function updateChat($token) {

        $aData = array('last_chat_time' => date('Y-m-d H:i:s'));
        $result = DB::table('tbl_chat_supportuser')
            ->where('room', $token)
            ->update($aData);

        return true;

    }

     /**
     * this function is used to check chat is already assign or not to the team member
     * @param type $token
     * @return type object
     */
    public function checkTeamAssign($token) {
        $oData = DB::table('tbl_chat_supportuser')
        ->select('*')
        ->where('room', $token)
        ->first();
        return $oData;
    }

    /**
     * this function is used to for assign a chat
     * @param type $token
     * @param type $isLoggedInTeam
     * @return type boolean
     */
    public function assignChat($token, $isLoggedInTeam) {

        $aData = array('assign_team_member' => $isLoggedInTeam, 'reply_time' => date('Y-m-d H:i:s'));
        $result = DB::table('tbl_chat_supportuser')
            ->where('room', $token)
            ->update($aData);

        return true;
    }

    /**
     * this function is used to for get assign a chat team
     * @param type $token
     * @return type object
     */
    public function getassignChat($token) {

        $oData = DB::table('tbl_chat_supportuser')
            ->select(DB::raw("CONCAT(tbl_users_team.firstname,' ',tbl_users_team.lastname) as teamName"), 'tbl_chat_supportuser.assign_team_member as teamId')
            ->join('tbl_users_team', 'tbl_chat_supportuser.assign_team_member', '=' , 'tbl_users_team.id')
            ->where('tbl_chat_supportuser.room', $token)
            ->first();

        return $oData;
    }

    /**
     * this function is used to for get assign a chat user
     * @param type $token
     * @return type object
     */

    public function getassignChatUser($token) {
        $oData = DB::table('tbl_chat_supportuser')
            ->join('tbl_users', 'tbl_chat_supportuser.assign_team_member', '=' , 'tbl_users.id')
            ->select(DB::raw('CONCAT(tbl_users.firstname," ",tbl_users.lastname) as teamName'), 'tbl_chat_supportuser.assign_team_member as teamId')
            ->where('tbl_chat_supportuser.room', $token)
            ->first();

        return $oData;

    }



    /**
     * this function is used to update the chat user contact information
     * @return type boolean
     */


    public function updateSupportuser($supportid, $aData) {

        $result = DB::table('tbl_chat_supportuser')
            ->where('user', $supportid)
            ->update($aData);

          return true;


    }


   /**
     * this function is used to update get the room details for webchat
     * @return type array
     */


    public function getChatRoomDetails($room,$assign_to) {

        $oData = DB::table('tbl_chat_supportuser')
        ->select('tbl_chat_supportuser.assign_team_member as preTeamId')
        ->where('room', $room)
        ->first();
           if(!empty($oData)) {
            $aData = array('assign_team_member' => $assign_to);
            $result = DB::table('tbl_chat_supportuser')
            ->where('room', $room)
            ->update($aData);

        }

        return $oData;


    }

    /**
     * this function is used to update the chat box status
     * @return type boolean
     */
    public function updateChatboxstatus($aData) {
        $responseRes = DB::select(DB::raw("select * from tbl_chat_status where
        user_id = '".$aData['user_id']."' AND subscriber_id='".$aData['subscriber_id']."' "));

        if(empty($responseRes))
        {
            $insert_id = DB::table('tbl_chat_status')->insertGetId($aData);
            return $insert_id;
        }
    }

    /**
     * this function is used to remove the chat box status
     * @return type boolean
     */
    public function removeActiveBoxStatus($aData)
    {
        $responseRes = DB::select(DB::raw("delete from tbl_chat_status where
        user_id = '".$aData['user_id']."' AND subscriber_id='".$aData['subscriber_id']."' "));
        return 1;
    }

    /**
     * this function is used to get widget setting
     * @return type object
     */
    public function getWidgetSettings($userToken) {
        $oData = DB::table('tbl_chat_main')
        ->select('*')
        ->where('hashcode', $userToken)
        ->first();
        return $oData;
    }

    /**
     * this function is used to get All message by token
     * @param type $token
     * @return type object
     */
    public function getAllMessages($token) {

        $oData = DB::table('tbl_chat_message')
        ->select('*')
        ->where('token', $token)
        ->orderBy('id', 'asc')
        ->get();
        return $oData;
    }


    /**
     * this function is used to get user message
     * @param type $token
     * @return type object
     */
    public function getUserMessages($token) {

        $oData = DB::table('tbl_chat_supportuser')
        ->select('*')
        ->where('room', $token)
        ->first();
        return $oData;
    }

    /**
     * this function is used to add support user
     * @param type $aData
     * @return type insert id
     */

    public function addSupportUser($aData){

        $oData = DB::table('tbl_chat_supportuser')->insertGetId($aData);
        return $oData;
    }


   /**
     * this function is used to add favourite webchatuser
     * @return type object
     */

   public function favouriteUser($userId, $aData) {

        $oData = DB::table('tbl_chat_supportuser')
            ->where('id', $userId)
            ->update($aData);
             return $oData;

        }


      /**
     * this function is used get the room details
     * @return type
     */

public static function getTeamByroomDetails($room)
{

        $oData = DB::select(DB::raw(" SELECT user as userval from tbl_chat_supportuser WHERE room = '".$room."'" ));
        return $oData;

}

/**
 * prepare list after search
 * @param type $userID
 * @param type $searchval
 * @return data object
 */

    public static function smallwfilterModel($userID,$searchval) {

        if($searchval!="")
        {
        $oData = DB::select(DB::raw(" SELECT
      tcm_subs.* FROM
      tbl_chat_message tc INNER JOIN
      (SELECT * FROM tbl_chat_message group by token, created ORDER BY created DESC) as tcm_subs ON tc.token = tcm_subs.token
      WHERE (tc.user_to = '" . $userID . "' or tc.user_form ='" . $userID . "') AND tc.message  LIKE '%".$searchval."%'
      GROUP BY tc.token ORDER BY tcm_subs.created DESC"));
      }
      else
      {
      $oData = DB::select(DB::raw(" SELECT
      tcm_subs.*
FROM
      tbl_chat_message tc INNER JOIN
      (SELECT * FROM tbl_chat_message group by token, created ORDER BY created DESC) as tcm_subs ON tc.token = tcm_subs.token
      WHERE (tc.user_to = '" . $userID . "' or tc.user_form ='" . $userID . "')
      GROUP BY tc.token ORDER BY tcm_subs.created DESC"));

      }


        return $oData;
    }

    /**
     * This function is used to get the list of favorite chat users
     * @param $userId
     * @return mixed
     */
    public function getFavouriteUsers($userId) {

        $oFavorite = DB::table('tbl_chat_favourite')
            ->where('curr_user_id', $userId)
            ->get();
        return $oFavorite;
    }

    /**
     * This method used to sort Web Chat Contact list
     * @param $userID
     * @param string $sortField
     * @param string $sortValue
     * @return mixed
     */
    public function sortWebChat($userID, $sortField='last_chat_time', $sortValue='desc') {
        $oData = DB::table('tbl_chat_supportuser')
            ->where('supp_user', $userID)
            ->orderBy($sortField, $sortValue)
            ->get();
        return $oData;
    }

    /**
     * This function used to get unread messages belonging to a conversation
     * @param $token
     * @param $user
     * @return mixed
     */
    public function getUnreadCount($token, $user){
        $oData = DB::table('tbl_chat_message')
            ->where('token', $token)
            ->where('read_status', 0)
            ->where('user_form', $user)
            ->count();
        return $oData;
    }

    /**
     * This function used to update read status of chat conversation
     * @param $token
     * @param $user
     * @return mixed
     */
    public function updateReadStatus($token, $user){
        $oData = DB::table('tbl_chat_message')
            ->where('token', $token)
            ->where('read_status', 0)
            ->where('user_form', $user)
            ->update(['read_status' => 1]);
        return $oData;
    }

    /**
     * Save Email Chat into the database
     * @param $aData
     * @return mixed
     */
    public function saveEmailChat($aData){
        $insert_id = DB::table('tbl_chat_email_thread')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Get Email thread Data
     * @param $from
     * @return mixed
     */
    public function getEmailThread($from, $to){
        return DB::table('tbl_chat_email_thread')->where('from', $from)->where('to', $to)->get();
    }




}
