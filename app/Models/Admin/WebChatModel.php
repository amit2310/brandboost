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

        $oResult = DB::table('tbl_chat_supportuser')
                ->where('assign_team_member', $teamId)
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



}
