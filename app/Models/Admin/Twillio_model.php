<?php 

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

        class Twillio_model extends Model {

		/**
		* 
		* get Twilio related data for user
		* @param type $userId
		* @return type
		*/

		public function getTwillioByUser($userId = ''){

			$oData = DB::table('tbl_twilio_accounts')
	         ->where('user_id', $userId)
	         ->where('status', '1')->get();
	         return $oData;
			

		}
	}

?>