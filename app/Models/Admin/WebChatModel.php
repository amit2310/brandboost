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

}
