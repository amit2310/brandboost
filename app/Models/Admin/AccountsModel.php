<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AccountsModel extends Model {

     /**
     * Used to get Usage
     * @param type $id
     * @param type $userID
     * @return type object
     */
    public function getUsage($userID) {

        $oData = DB::table('tbl_account_usage_tracking')
                ->where('user_id', $userID)
                ->orderBy('id', "DESC")
                ->get();
        return $oData;
    }
    
    /**
     * Used to get Usage details
     * @param type $id
     * @param type $userID
     * @return type object
     */
    public function getUsageDetails($id, $userID){

        $oData = DB::table('tbl_account_usage_tracking')
                ->where('user_id', $userID)
                ->where('id', $id)
                ->first();
        return $oData;
    }
    

    /**
     * Used to get all team members
     * @param type $userID
     * @return type object
     */
    public function getAllTeamMembers($userID) {

        $oData = DB::table('tbl_users_team')
                ->where('parent_user_id', $userID)
                ->get();
        return $oData;
    }

}

?>