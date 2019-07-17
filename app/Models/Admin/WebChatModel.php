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
    public function getTeamAssignData($teamId) {

        $oResult = DB::table('tbl_chat_supportuser')
                ->where('assign_team_member', $teamId)
                ->get();
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
        ->orderBy('id', 'desc')
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



}
