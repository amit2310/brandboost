<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductsModel extends Model
{
    
    
    /**
     * Used to get Chargebee plan info
     * @param type $planID
     * @return type
     */
    public function getCBPlanInfo($planID) {
        $aResponse = array();
        $oData = DB::table('tbl_cc_membership')
        ->where('plan_id', $planID)
        ->first();
        if(!empty($oData)){
            $aResponse = array(
                'product_type' => $oData->type,
                'product_name' => $oData->level_name,
                'subs_cycle' => $oData->subs_cycle,
                'product_price' => $oData->price,
                'free_trial_days' => isset($oData->free_trial_days) ? $oData->free_trial_days : '',
                'plan_id' => $planID,
            );
            $aResponse['data'] = $oData;
        }
        return $aResponse;        
    }

    
    /**
     * Used to get chargebee plan details
     * @param type $planID
     * @return type
     */
    public function getPlanDetails($planID) {
        return $this->getCBPlanInfo($planID);
    }
}
