<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class DashboardModel extends Model {

    /**
     * Get Account Usage data
     * @param type $id
     * @return type
     */
    public function getUserData($id) {
        $oData = DB::table('tbl_account_usage')
                ->where('user_id', $id)
                ->get();
        return $oData;
    }
    
    /**
     * This method updates footer content
     * @param type $aData
     * @param type $userID
     * @return boolean
     */
    public function updateFooterData($aData, $userID) {
        $bResult = DB::table('tbl_email_footer')
                ->where('user_id', $userID)
                ->update($aData);
        if ($bResult)
            return true;
        else
            return false;
    }

    /**
     * This method returns email footer data
     * @param type $userID
     * @return type
     */
    public function getEmailFooterData($userID) {
        
        $oData = DB::table('tbl_email_footer')
                ->where('user_id', $userID)
                ->get();
        return $oData;        
    }

}
