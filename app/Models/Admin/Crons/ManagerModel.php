<?php

namespace App\Models\Admin\Crons;

use Illuminate\Database\Eloquent\Model;
use DB;

class ManagerModel extends Model {

    /**
     * 
     * @param type $cronName
     * @return type
     * Check current status of cron
     */
    public function checkCronStatus($cronName) {
        $oData = DB::table('tbl_cron_lock')
                ->where('cron_name', $cronName)
                ->first();
        return $oData;        
    }

    /**
     * Lock cron everytime you process current request
     * @param type $cronName
     * @return boolean
     * 
     */
    public function lockCron($cronName) {
        $oData = DB::table('tbl_cron_lock')
                ->where('cron_name', $cronName)
                ->update(['locked' => '1', 'last_run_at' => date("Y-m-d H:i:s")]);
        if($oData>-1){
            return true;
        }else{
            return false;
        }        
    }

    /**
     * release cron everytime you complete current request
     * @param type $cronName
     * @return boolean
     */
    public function releaseCron($cronName) {
        $oData = DB::table('tbl_cron_lock')
                ->where('cron_name', $cronName)
                ->update(['locked' => '0']);
        if($oData>-1){
            return true;
        }else{
            return false;
        }
    }

}
