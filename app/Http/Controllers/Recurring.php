<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecurringModel;

class Recurring extends Controller {

    /**
     * 
     */
    public function saverecurring() {
        $contactID = strip_tags(trim($_REQUEST['Id']));
        if ($contactID > 0) {
            $lastID = $this->mRecurring->getLastRecurringID($contactID);
            //echo "Last ID is ". $lastID;
            $lastID = ($lastID > 0) ? $lastID : 0;
            $aInvoices = Infusionsoft_DataService::query(new Infusionsoft_RecurringOrder(), array('ContactId' => $contactID, 'Status' => 'Active', 'Id' => '~>~' . $lastRecurringID));

            if (!empty($aInvoices)) {
                foreach ($aInvoices as $aInvoice) {
                    $contactID = $aInvoice->ContactId;

                    $aInvoiceData = array();
                    $aInvoiceData = array(
                        'infusion_user_id' => $aInvoice->ContactId,
                        'infusion_product_id' => $aInvoice->ProductId,
                        'subscription_plan_id' => $aInvoice->SubscriptionPlanId,
                        'subscription_start_date' => ($aInvoice->StartDate) ? date("Y-m-d H:i:s", strtotime($aInvoice->StartDate)) : '',
                        'subscription_end_date' => ($aInvoice->EndDate) ? date("Y-m-d H:i:s", strtotime($aInvoice->EndDate)) : '',
                        'last_bill_date' => ($aInvoice->LastBillDate) ? date("Y-m-d H:i:s", strtotime($aInvoice->LastBillDate)) : '',
                        'next_bill_date' => ($aInvoice->NextBillDate) ? date("Y-m-d H:i:s", strtotime($aInvoice->NextBillDate)) : '',
                        'billing_cycle' => $aInvoice->BillingCycle,
                        'frequency' => $aInvoice->Frequency,
                        'merchant_id' => $aInvoice->MerchantAccountId,
                        'invoice_total' => $aInvoice->BillingAmt,
                        'quantity' => $aInvoice->Qty,
                        'recurring_order_id' => $aInvoice->Id,
                        'dataset' => serialize($aInvoice),
                        'created' => date("Y-m-d H:i:s")
                    );
                    $bAdded = $this->mRecurring->saveRecurring($aInvoiceData);
                    if ($bAdded) {
                        //Show Notification
                    }
                }
                echo "Done";
            }
        }
    }

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
                                $result = ChargeBee_Subscription::retrieve($subscriptionID);
                                $oRes = $result->subscription();
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
