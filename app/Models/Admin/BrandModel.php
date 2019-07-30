<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class BrandModel extends Model
{
        public function addBrandConfiguration($aData,$aThemeData='',$theme_title=''){
        
        if(!empty($theme_title))
        {
           $aData['theme_id'] =   DB::table('tbl_brand_themes')
            ->insertGetId($aThemeData);

        }

        $inset_id = DB::table('tbl_brand_configurations')
	    ->insertGetId("tbl_brand_configurations", $aData);
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
	}
    
      public function addFaqData($aData){
     
		$inset_id = DB::table('tbl_brandboost_faqs')->insertGetId($aData);
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
	}
    
      public function updateFaQStatus($aData, $FaqId) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
		$result = '';
        DB::table('tbl_brandboost_faqs')
		->where('user_id', $userID)
        ->where('id', $FaqId)
        ->update($aData);
        if ($result>-1)
            return true;
        else
            return false;
    }
    
      public function UpdateFaqData($aData, $FaqId) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
		$result = '';
        $result = DB::table('tbl_brandboost_faqs')
		->where('user_id', $userID)
        ->where('id', $FaqId)
         ->update($aData);
          
        if ($result>-1)
            return true;
        else
            return false;
    }
    
         public function DeleteFaQ($FaqId) {
            $oUser = getLoggedUser();
            $userID = $oUser->id;
            $result = '';
            $this->db->where('user_id', $userID);
            $this->db->where('id', $FaqId);
            $result = $this->db->delete('tbl_brandboost_faqs');
              
            if ($result)
                return true;
            else
                return false;
        }
    
    
    	public function getFAQSingleDetails($faQListid) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
		$result = '';
        $oData = DB::table('tbl_brandboost_faqs')
		->where('user_id', $userID)
        ->where('id', $faQListid)->get();
		
        return $oData;      
        
	}
    

    /**
    * This function is used to update brand configuration page settings
    * @param type $clientID
    * @return type
    */

    public function updateBrandConfiguration($userID, $aData="") {

            $result = DB::table('tbl_brand_configurations')
            ->where('user_id', $userID)
            ->update($aData);

            if ($result >-1) {
            return true;
            } else {
            return false;
            }

    }


     /**
    * This function is used to save the all brand page settings as a new theme
    * @param type $clientID
    * @return type
    */

      public function saveTheme($userID, $aData="",$aThemeData="",$theme_title="") {

        if(!empty($theme_title))
        {
            $insert_id = DB::table('tbl_brand_themes')->insertGetId($aThemeData);
            $aData['theme_id'] =  $insert_id;
            
        }
      
         $result = DB::table('tbl_brand_configurations')
            ->where('user_id', $userID)
            ->update($aData);
             
        if ($result>-1) {
            return true;
        } else {
            return false;
        }

    }




	/**
	* This function is used to retrive the brand configuration data
	* @param type $userId
	* @return array
	*/


    public function getBrandConfigurationData($userId) {

			$oData = DB::table('tbl_brand_configurations')
			->where('user_id', $userId)
			->get(); 
			return $oData;
        
    }
    

    /**
	* This function is used to retrive the brand themes data
	* @param type $userId
	* @return array
	*/

       public function getBrandThemesData($userId) {

         $oData = DB::table('tbl_brand_themes')
		->where('user_id', $userId)
		->get(); 
		return  $oData;

		  
        
    }
    
       public function getBrandThemeConfigData($BrandthemeId) {

        $result = '';
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $result = DB::table('tbl_brand_configurations')
        ->join('tbl_brand_themes', 'tbl_brand_configurations.user_id','=','tbl_brand_themes.user_id')
         ->where('tbl_brand_themes.id', $BrandthemeId)
         ->where('tbl_brand_themes.user_id', $userID)->get();
       
         return $result;        
        
    }
    

	/**
	* This function will return Faq related data
	* @param type $clientID
	* @return type
	*/

    public function getFaqData() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $oData = DB::table('tbl_brandboost_faqs')
		->where('user_id', $userID)
		->orderBy('id', 'desc')
		->get(); 
         return $oData;
		  
        
	}

    public function getFaqDataByUserId($userID) {
     
        $oData = DB::table('tbl_brandboost_faqs')
         ->where('user_id', $userID)
        ->orderBy("id", "desc");
       
        return $oData; 
    }
}
