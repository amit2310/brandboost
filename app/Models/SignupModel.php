<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SignupModel extends Model {

    /**
     * Create user locally
     * @param type $aData
     * @return type
     */
    public function addUser($aData) {
        $insert_id = DB::table('tbl_users')->insertGetId($aData);
        return $insert_id;        
    }

}
