<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class MembershipModel extends Model {

    /**
     * Used to get active membership related data
     * @return type
     */
    public static function getActiveMembership() {
        $oMembership = DB::table('tbl_cc_membership')
                ->where('status', 1)
                ->where('delete_status', 0)
                ->get();        
        return $oMembership;
    }
    
    /**
     * Get Level Upgrade related data
     * @param type $oPlans
     * @param type $pID
     * @return type
     */
    public static function getLevelUpgrade($oPlans, $pID) {
        $aUpgradeData = array();
        if (!empty($oPlans)) {
            $i = $j = 0;
            foreach ($oPlans as $oPlan) {
                $i++;
                $planID = $oPlan->plan_id;

                if ($j == 1 && empty($aUpgradeData['main'])) {
                    $aUpgradeData['main'] = $oPlan;
                }

                if ($planID == $pID) {
                    $j = 1;
                    $aUpgradeData['current'] = $oPlan;
                }
            }

            return $aUpgradeData;
        }
    }
    
    
    /**
     * Sorting Annual upgrade data
     * @param type $oPlans
     * @param type $pID
     * @return type
     */
    public static function getAnnualUpgrade($oPlans, $pID) {
        $oData = array();
        //echo "Plan ID is ". $pID;
        //$aUpgradeData = array();
        if (!empty($oPlans)) {
            foreach ($oPlans as $oPlan) {
                $planID = $oPlan->plan_id;
                if ($planID == $pID) {
                    $oCurrentPlan = $oPlan;
                }
            }

            if (!empty($oCurrentPlan)) {
                $basePlanID = $oCurrentPlan->base_plan_id;
                foreach ($oPlans as $oPlan) {
                    $planID = $oPlan->plan_id;
                    if (($oPlan->base_plan_id == $basePlanID) && in_array($oPlan->subs_cycle, array('yearly', 'bi-yearly')) && $oPlan->subs_cycle != $oCurrentPlan->subs_cycle) {
                        $oData[] = $oPlan;
                    }
                }
            }
            return $oData;
        }
    }
    
    /**
     * Get membership Data
     * @param type $membershipPlanID
     * @return type
     */
    public function getMembershipInfo($membershipPlanID) {
        $oData = DB::table('tbl_cc_membership')
                ->where('plan_id', $membershipPlanID)
                ->first();
        return $oData;
    }


    /**
     * Get membership
     * @param type $id
     * @return type
     */
    public function getMembership($id = '') {
        $oData = DB::table('tbl_cc_membership')
        ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('id', $id);
                })  
        ->where('delete_status', '0')
        ->orderBy('id', 'ASC')
        ->limit(1)
        ->get();

        return $oData;
    }

    public function saveMembership($aData) {
        $result = $this->db->insert("tbl_cc_membership", $aData);
        //echo $this->db->last_query();exit;
        if ($result)
            return true;
        else
            return false;
    }

    public function updateMembership($aData, $memId) {

        $this->db->where('id', $memId);
        $result = $this->db->update('tbl_cc_membership', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteMembership($aData, $memId) {

        if ($memId > 0) {
            $oPlan = $this->getMembership($memId);
            if (!empty($oPlan)) {
                $planID = $oPlan[0]->plan_id;
                $type = $oPlan[0]->type;
                //Delete from chargebee also
                if ($type == 'topup') {
                    $result = ChargeBee_Addon::delete($planID);
                    $oRes = $result->addon();
                } else {
                    $result = ChargeBee_Plan::delete($planID);
                    $oRes = $result->plan();
                }


                if (!empty($oRes)) {
                    $status = $oRes->status;
                    if ($status == 'deleted') {
                        $this->db->where('id', $memId);
                        $result = $this->db->update('tbl_cc_membership', $aData);
                    }
                }
            }
        }
        if ($result)
            return true;
        else
            return false;
    }

    public function getAllTopup() {

        $aData = array();
        $this->db->where('status', 1);
        $this->db->where('infusion_product_id >', 0);
        $query = $this->db->get('tbl_cc_membership');
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    

    public function getUpgradeUpsellSets($oPlans, $pID) {
        $aUpgradeData = array();
        if (!empty($oPlans)) {
            $i = $j = 0;
            foreach ($oPlans as $oPlan) {
                $i++;
                $planID = $oPlan->plan_id;
                if ($planID == $pID) {
                    $currentBasePlanID = $oPlan->base_plan_id;
                    $currentMemID = $oPlan->id;
                }

                if ($currentBasePlanID == $oPlan->base_plan_id && $currentMemID != $oPlan->id && empty($aUpgradeData['main'])) {
                    echo "Offererd Plan ID is " . $oPlan->plan_id;
                    //Base plan to offer
                    $primaryID = $oPlan->id;
                    $aUpgradeData['main'] = $oPlan;
                    $offeredBaseID = $oPlan->base_plan_id;
                }
            }

            foreach ($oPlans as $oPlan) {
                if (!empty($aUpgradeData['main'])) {
                    if ($oPlan->id > $primaryID && $oPlan->base_plan_id > $offeredBaseID && sizeof($aUpgradeData['upsell']) <= 1) {
                        $aUpgradeData['upsell'][] = $oPlan;
                    }
                }
            }
            return $aUpgradeData;
        }
    }

    

    

    public function createChargebeePlan($aData) {
        $planID = 0;
        $aResponse = ChargeBee_Plan::create($aData);
        $oRes = $aResponse->plan();
        //pre($oRes);
        if (!empty($oRes)) {
            $planID = $oRes->id;
        }
        return $planID;
    }

    public function createChargebeeAddonPlan($aData) {
        $planID = 0;
        $aResponse = ChargeBee_Addon::create($aData);
        $oRes = $aResponse->addon();
        //pre($oRes);
        if (!empty($oRes)) {
            $planID = $oRes->id;
        }
        return $planID;
    }

    public function updateChargebeePlan($planID, $aData) {
        $planIDNew = 0;
        if (!empty($planID)) {
            $aResponse = ChargeBee_Plan::update($planID, $aData);
            $oRes = $aResponse->plan();
            if (!empty($oRes)) {
                $planIDNew = $oRes->id;
            }
            return $planIDNew;
        }
    }

}
