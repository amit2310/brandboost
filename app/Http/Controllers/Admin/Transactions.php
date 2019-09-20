<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentModel;
use App\Models\Admin\UsersModel;
use Illuminate\Support\Facades\Input;
use Cookie;
use Session;
use DB;

class Transactions extends Controller {


    /**
    * index call
    * @param type
    * @return type
    */

    public function index() {

    }

    public function addManualCredits(Request $request) {
        $oUser = getLoggedUser();
        $mUser  = new UsersModel();
        $mPayment = new PaymentModel();


        $response = array();
        $userRole = $oUser->user_role;
        if ($userRole != '1') {
            $response['status'] = 'error';
            $response['msg'] = 'Not Authorise to access this page';
            echo json_encode($response);
            exit;
        }

        if (!empty($request)) {
            $creditorUID = base64_url_decode($request->creditor_user_id);
            $credits = $request->credits;
            $contactLimit = $request->contact_limit;
            $emailCredits = $request->email_credits;
            $smsCredits = $request->sms_credits;
            $mmsCredits = $request->mms_credits;
            $creditNotes = $request->credit_notes;
            $secretKey = $request->secret_key;
            $transactionSecretKey = '12345';
            if ($secretKey == $transactionSecretKey) {
                $oCreditor = $mUser->getCurrentAccountUsage($creditorUID);

                if (!empty($oCreditor)) {
                    //Available Credits
                    $oldCredits = $oCreditor->credits;
                    $oldContactLimit = $oCreditor->contact_limit;
                    $oldCreditsTopup = $oCreditor->credits_topup;
                    $oldContactLimitTopup = $oCreditor->contact_limit_topup;
                    $emailLimit = $oCreditor->email_balance;
                    $smsLimit = $oCreditor->sms_balance;
                    $mmsLimit = $oCreditor->mms_balance;
                    $emailTopupLimit = $oCreditor->email_balance_topup;
                    $smsTopupLimit = $oCreditor->sms_balance_topup;
                    $mmsTopupLimit = $oCreditor->mms_balance_topup;
                }

                $aHistory = array(
                    'user_id' => $creditorUID,
                    'refill_type' => 'manual_credits',
                    'credits' => 0,
                    'contact_limit' => 0,
                    'credits_topup' => $credits,
                    'contact_limit_topup' => $contactLimit,
                    'email_topup' => $emailCredits,
                    'sms_topup' => $smsCredits,
                    'mms_topup' => $mmsCredits,
                    'last_unused_credits' => $oldCredits,
                    'last_unused_contact' => $oldContactLimit,
                    'last_unused_credits_topup' => $oldCreditsTopup,
                    'last_unused_contact_limit_topup' => $oldContactLimitTopup,
                    'last_unused_email' => $emailLimit,
                    'last_unused_sms' => $smsLimit,
                    'last_unused_mms' => $mmsLimit,
                    'last_unused_email_topup' => ($emailTopupLimit) ? $emailTopupLimit : 0,
                    'last_unused_sms_topup' => ($smsTopupLimit) ? $smsTopupLimit : 0,
                    'last_unused_mms_topup' => ($mmsTopupLimit) ? $mmsTopupLimit : 0,
                    'notes' => $creditNotes,
                    'created' => date("Y-m-d H:i:s")
                );

                //Recharge Now
                $aRefill = array(
                    'user_id' => $creditorUID,
                    'credits_topup' => $oldCreditsTopup + $credits,
                    'contact_limit_topup' => $oldContactLimit + $contactLimit,
                    'email_balance_topup' => ($emailCredits + $emailTopupLimit),
                    'sms_balance_topup' => ($smsCredits + $smsTopupLimit),
                    'mms_balance_topup' => ($mmsCredits + $mmsTopupLimit),
                    'last_updated' => date("Y-m-d H:i:s")
                );

                $bRefillResult = $mPayment->refillAccount($creditorUID, $aRefill);
                //Log History
                if ($bRefillResult) {
                    $bLogResult = $mPayment->logRefillHistory($aHistory);
                    $response['status'] = 'success';
                    $response['msg'] = 'Credits added into user account successfully';
                } else {
                    $response['status'] = 'error';
                    $response['msg'] = 'Unknown error';
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['status'] = 'error';
                $response['msg'] = 'Invalid security code';
                echo json_encode($response);
                exit;
            }
        }
        echo json_encode($response);
        exit;
    }

}
