<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ListsModel extends Model {

    /**
     * 
     * get active subscriber list data
     * @param type $listId
     * @return subscriber list
     */
	 
    public static function getAllSubscribersList($listId) {
		$oData = DB::table('tbl_brandboost_users')
                ->where('brandboost_id', $listId)
                ->orderBy('id', 'desc')        
                ->get();                
                
        return $oData;
    }
}
