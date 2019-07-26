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
        $result = $this->db->insert("tbl_brand_themes", $aThemeData);
        $inset_id = $this->db->insert_id();
        $aData['theme_id'] =  $inset_id;

        }
		$result = $this->db->insert("tbl_brand_configurations", $aData);
		//echo $this->db->last_query();
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
	}
    
      public function addFaqData($aData){

		$result = $this->db->insert(" tbl_brandboost_faqs", $aData);
		//echo $this->db->last_query(); exit;
        $inset_id = $this->db->insert_id();
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
		$this->db->where('user_id', $userID);
        $this->db->where('id', $FaqId);
        $result = $this->db->update('tbl_brandboost_faqs', $aData);
        if ($result)
            return true;
        else
            return false;
    }
    
      public function UpdateFaqData($aData, $FaqId) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
		$result = '';
		$this->db->where('user_id', $userID);
        $this->db->where('id', $FaqId);
        $result = $this->db->update('tbl_brandboost_faqs', $aData);
          
        if ($result)
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
		$this->db->where('user_id', $userID);
        $this->db->where('id', $faQListid);
		$this->db->from('tbl_brandboost_faqs');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;      
        
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
        $this->db->select('*')
        ->from('tbl_brand_configurations')
        ->join('tbl_brand_themes', 'tbl_brand_configurations.user_id = tbl_brand_themes.user_id');
        $this->db->where('tbl_brand_themes.id', $BrandthemeId);
        $this->db->where('tbl_brand_themes.user_id', $userID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        $result = $query->result();
     
        }
        
         
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

        $result = '';
        $this->db->where('user_id', $userID);
        $this->db->from('tbl_brandboost_faqs');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result; 
    }
}
