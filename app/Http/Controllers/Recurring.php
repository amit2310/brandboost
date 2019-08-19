<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecurringModel;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


class Recurring extends Controller {

    /**
     * 
     * @return boolean
     */
    public function saveCBRecurring(Request $request) {
        $mRecurring = new RecurringModel();
        
        $contactID = strip_tags(trim($request->Id));
        $aData = array();
        if ($aData = json_decode(file_get_contents("php://input"), true)) {

            $eventType = @$aData['event_type'];
            echo "Event Type is " . $eventType;
            pre($aData);

            if ($eventType == 'invoice_generated') {
                $aContent = @$aData['content'];
                $aInvoice = @$aContent['invoice'];
                $aItems = @$aInvoice['line_items'];
                $aTransactionData = @$aInvoice['linked_payments'];
                $aBilling = @$aInvoice['billing_address'];
                $transactionID = (is_array(@$aTransactionData)) ? @$aTransactionData[0]->txnId : '';
                $transactionStatus = (is_array(@$aTransactionData)) ? @$aTransactionData[0]->txnStatus : @$oRes->status;

                $bAlreadyAdded = $mRecurring->checkIfAlreadyCBInvoiceSaved($aInvoice['id'], $transactionID);
                if ($bAlreadyAdded == false) {
                    $aInvoiceData = array(
                        'customer_id' => $aInvoice['customer_id'],
                        'cc_invoice_id' => $aInvoice['id'],
                        'invoice_status' => $aInvoice['status'],
                        'is_recurring' => $aInvoice['recurring'],
                        'subscription_id' => $aInvoice['subscription_id'],
                        'total' => $aInvoice['total'],
                        'amount_paid' => ($aInvoice['amount_paid']),
                        'amount_due' => ($aInvoice['amount_due']),
                        'currency' => $aInvoice['currency_code'],
                        'paid_at' => $aInvoice['paid_at'],
                        'txn_id' => $transactionID,
                        'txn_status' => $transactionStatus,
                        'bill_firstname' => $aBilling['first_name'],
                        'bill_lastname' => $aBilling['last_name'],
                        'bill_zip' => $aBilling['zip']
                    );
                    $localinvoiceID = $mRecurring->saveCBInvoice($aInvoiceData);
                    $subscriptionID = $aInvoiceData['subscription_id'];
                    if ($localinvoiceID > 0 && !empty($aItems)) {
                        $bSaved = $mRecurring->saveCBInvoiceItems($localinvoiceID, $aItems);
                        if ($bSaved) {
                            if (!empty($subscriptionID)) {
                                //Fetch Subscription related information from chargebee
                                $oRes = cbHelperRetrieveSubscription($subscriptionID);
                                if (!empty($oRes)) {
                                    $updatedAt = $oRes->updatedAt;
                                    $nextBillingAt = $oRes->nextBillingAt;
                                    $mRecurring->updateSubscription($subscriptionID, array('next_billing_at' => $nextBillingAt, 'updated_at' => $updatedAt));
                                    //Recharge credits as per the plan
                                    $oSubscription = $mRecurring->getSubsDetails($subscriptionID);
                                    if (!emppty($oSubscription)) {
                                        $planID = $oSubscription->plan_id;
                                        $userID = $oSubscription->user_id;
                                        refillPlanBenefits($userID, $planID);
                                    }
                                }
                            }
                            return true;
                        }
                    }
                } else {
                    echo "Already Exists";
                }
            }
        }
        if ($request->auth_user == 'alen' && $request->auth_passwd == 'monkey') {
            //Authorized
            echo "Yes Authorized";
        } else {
            //Not Authorized
            echo "Not Authorized";
        }
    }

}
