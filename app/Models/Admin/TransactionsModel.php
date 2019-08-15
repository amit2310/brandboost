<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentModel;
use App\Models\ProductsModel;
use App\Models\Admin\UsersModel;
use DB;

class TransactionsModel extends Model {

    public function autoRefillAccount($userID, $planID, $quantity = 0) {
        
        $mAutoPayment = new PaymentModel();
        if (!empty($userID) && !empty($planID)) {          
            

            //Check if member purchased the product
            $bDone = false;
            $aUser = UsersModel::getCurrentAccountUsage($userID);


            if (!empty($aUser)) {
                //Available Credits
                $credits = $aUser->credits;
                $contactLimit = $aUser->contact_limit;
                $emailLimit = $aUser->email_balance;
                $smsLimit = $aUser->sms_balance;
                $mmsLimit = $aUser->mms_balance;
                $reviewLimit = $aUser->text_review_balance;
                $videoLimit = $aUser->video_review_balance;
                $creditsTopup = $aUser->credits_topup;
                $contactLimitTopup = $aUser->contact_limit_topup;
                $emailTopupLimit = $aUser->topup_email_limit;
                $smsTopupLimit = $aUser->sms_balance_topup;
                $mmsTopupLimit = $aUser->mms_balance_topup;
                $subscriptionPlanID = $aUser->subscription_plan_id;
            }
            //pre($aUser);
            //Get Account Usage for Refill
            $aUsage = $this->getPlanBenefits($planID);
            //pre($aUsage);
            //die;
            if (!empty($aUsage)) {
                $qty = ($quantity > 0) ? $quantity : 1;
                $productType = $aUsage['product_type'];
                $rCredits = ($productType == 'membership') ? $aUsage['credits'] : $credits;
                $rContactLimit = ($productType == 'membership') ? $aUsage['contact_limit'] : $contactLimit;
                $rEmailLimit = $aUsage['email_limit'];
                $rSMSlLimit = $aUsage['sms_limit'];
                $rMMSLimit = $aUsage['mms_limit'];
                $rTextReviewLimit = $aUsage['text_review_limit'];
                $rVideoReviewLimit = $aUsage['video_review_limit'];
                $rCreditsTopup = ($productType == 'membership') ? $creditsTopup : ($creditsTopup + $aUsage['credits'] * $qty);
                $rContactLimitTopup = ($productType == 'membership') ? $contactLimitTopup : ($contactLimitTopup + $aUsage['contact_limit']);
                $rTopEmailLimit = $aUsage['topup_email_limit'];
                $rTopupSmsLimit = $aUsage['topup_sms_limit'];
                $rTopupMMSLimit = $aUsage['topup_mms_limit'];

                $aHistory = array(
                    'user_id' => $userID,
                    'refill_type' => $productType,
                    'credits' => ($productType == 'membership') ? $aUsage['credits'] : 0,
                    'contact_limit' => ($productType == 'membership') ? $aUsage['contact_limit'] : 0,
                    'email_limit' => $rEmailLimit,
                    'sms_limit' => $rSMSlLimit,
                    'mms_limit' => $rMMSLimit,
                    'text_review_limit' => $rTextReviewLimit,
                    'video_review_limit' => $rVideoReviewLimit,
                    'credits_topup' => ($productType == 'membership') ? 0 : $aUsage['credits'] * $qty,
                    'contact_limit_topup' => ($productType == 'membership') ? 0 : $aUsage['contact_limit'],
                    'email_topup' => $rTopEmailLimit,
                    'sms_topup' => $rTopupSmsLimit,
                    'mms_topup' => $rTopupMMSLimit,
                    'last_unused_credits' => ($credits) ? $credits : 0,
                    'last_unused_contact' => $contactLimit ? $contactLimit : 0,
                    'last_unused_email' => ($emailLimit) ? $emailLimit : 0,
                    'last_unused_sms' => ($smsLimit) ? $smsLimit : 0,
                    'last_unused_mms' => ($mmsLimit) ? $mmsLimit : 0,
                    'last_unused_text_review' => ($reviewLimit) ? $reviewLimit : 0,
                    'last_unused_video_review' => ($videoLimit) ? $videoLimit : 0,
                    'last_unused_credits_topup' => ($creditsTopup) ? $creditsTopup : 0,
                    'last_unused_contact_limit_topup' => ($contactLimitTopup) ? $contactLimitTopup : 0,
                    'last_unused_email_topup' => ($emailTopupLimit) ? $emailTopupLimit : 0,
                    'last_unused_sms_topup' => ($smsTopupLimit) ? $smsTopupLimit : 0,
                    'last_unused_mms_topup' => ($mmsTopupLimit) ? $mmsTopupLimit : 0,
                    'plan_id' => $planID,
                    'created' => date("Y-m-d H:i:s")
                );
                //echo "Product Type is ". $productType;
                //die;

                if ($productType == 'membership') {
                    $aRefill = array(
                        'user_id' => $userID,
                        'credits' => $rCredits,
                        'contact_limit' => $rContactLimit,
                        'email_balance' => $rEmailLimit,
                        'sms_balance' => $rSMSlLimit,
                        'text_review_balance' => $rTextReviewLimit,
                        'video_review_balance' => $rVideoReviewLimit,
                        'subscription_plan_id' => ($planID) ? $planID : $subscriptionPlanID,
                        'last_updated' => date("Y-m-d H:i:s")
                    );
                } else if ($productType == 'topup' || $productType == 'topup-membership') {
                    $qty = ($quantity > 0) ? $quantity : 1;
                    $aRefill = array(
                        'user_id' => $userID,
                        'credits_topup' => $rCreditsTopup,
                        'contact_limit_topup' => $rContactLimitTopup,
                        'email_balance_topup' => ($rTopEmailLimit + $emailTopupLimit),
                        'sms_balance_topup' => ($rTopupSmsLimit + $smsTopupLimit),
                        'last_updated' => date("Y-m-d H:i:s")
                    );
                }

                if (!empty($aRefill)) {
                    //Refill Now
                    $bRefillResult = $mAutoPayment->refillAccount($userID, $aRefill);
                    //Log History
                    if ($bRefillResult) {
                        $totalCredits = $aRefill['credits'];
                        $aUsage = array(
                            'client_id' => $userID,
                            'usage_type' => 'membership upgrade',
                            'content' => 'Renewal Credits',
                            'spend_to' => '',
                            'spend_from' => '',
                            'module_name' => 'Renewal Credits',
                            'module_unit_id' => ''
                        );

                        //$this->mInviter->updateUsage($aUsage);
                        updateCreditUsage($aUsage);
                        $bDone = true;
                        $bLogResult = $mAutoPayment->logRefillHistory($aHistory);
                    }
                }
            }

            return $bDone;
        }
    }

    /**
     * Used to get membership plan benefits
     * @param type $planID
     * @return type
     */
    public function getPlanBenefits($planID) {
        
        //Instantiate Products Model class to get its properties and methods
        $mAutoProduct = new ProductsModel();
        
        $aProduct = $mAutoProduct->getCBPlanInfo($planID);
        if (!empty($aProduct)) {
            $productName = $aProduct['product_name'];
            $productType = $aProduct['data']->type;
            $duration = $aProduct['data']->subs_cycle;
            $aUsage = array(
                'credits' => ($aProduct['data']->credits) ? $aProduct['data']->credits : 0,
                'contact_limit' => ($aProduct['data']->contact_limit) ? $aProduct['data']->contact_limit : 0,
                'email_limit' => ($aProduct['data']->email_limit) ? $aProduct['data']->email_limit : 0,
                'sms_limit' => ($aProduct['data']->sms_limit) ? $aProduct['data']->sms_limit : 0,
                'mms_limit' => ($aProduct['data']->mms_limit) ? $aProduct['data']->mms_limit : 0,
                'text_review_limit' => ($aProduct['data']->text_review_limit) ? $aProduct['data']->text_review_limit : 0,
                'video_review_limit' => ($aProduct['data']->video_review_limit) ? $aProduct['data']->video_review_limit : 0,
                'topup_email_limit' => ($aProduct['data']->topup_email_limit) ? $aProduct['data']->topup_email_limit : 0,
                'topup_sms_limit' => ($aProduct['data']->topup_sms_limit) ? $aProduct['data']->topup_sms_limit : 0,
                'subscription_plan_id' => $planID,
                'product_type' => $productType,
                'billing_cycle' => $duration
            );

            return $aUsage;
        }
    }

}
