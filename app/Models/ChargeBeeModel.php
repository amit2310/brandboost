<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;
//require_once $_SERVER['DOCUMENT_ROOT'] . '/app/chargebee/lib/ChargeBee.php';
//use App\ChargeBee\Lib;

class ChargeBeeModel extends Model {

    public function createContact($aData = array()) {
        //ChargeBee_Environment::configure("https://brandboost.chargebee.com","live_AAWPsatYm8HgEGQflS02Wbcu2cSMAY6uI");
        $firstName = ($aData['firstname']) ? $aData['firstname'] : '';
        $lastName = ($aData['lastname']) ? $aData['lastname'] : '';
        $email = ($aData['email']) ? $aData['email'] : '';
        $phone = ($aData['phone']) ? $aData['phone'] : '';
        $zip = ($aData['zip']) ? $aData['zip'] : '';
        $country = ($aData['country']) ? $aData['country'] : '';
        $address = ($aData['address']) ? $aData['address'] : '';
        $city = ($aData['city']) ? $aData['city'] : '';
        $state = ($aData['state']) ? $aData['state'] : '';
        $password = ($aData['password']) ? $aData['password'] : '';
        $yesshipping = (!empty($aData['is_shipping_same'])) ? $aData['is_shipping_same'] : 1;
        $aInputBilling = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'line1' => $address,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'country' => $country
        );

        $aInput = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'billingAddress' => $aInputBilling
        );
        pre(get_declared_classes());
        die;
        $aResponse = ChargeBee_Customer::create($aInput);

        $oRes = $aResponse->customer();

        if (!empty($oRes)) {
            $contactID = $oRes->id;
            return $contactID;
        } else {
            return false;
        }
    }

    public function AddCreditCart($contactID, $aInput) {
        $aRes = array();
        $aResponse = ChargeBee_Card::updateCardForCustomer($contactID, $aInput);
        $oRes = $aResponse->card();
        if (!empty($oRes)) {
            $status = $oRes->status;
            $paymentSourceID = $oRes->paymentSourceId;
            $lastFour = $oRes->last4;
            $aRes = array(
                'status' => $status,
                'payment_source_id' => $paymentSourceID,
                'last4' => $lastFour
            );
            return $aRes;
        }
        return $aRes;
    }

    public function ccCreateSubscription($contactID, $aInput, $productType) {
        $subscriptionID = 0;
        $aResponse = ChargeBee_Subscription::createForCustomer($contactID, $aInput);
        $oRes = $aResponse->subscription();
        if (!empty($oRes)) {
            $bSaveSubscription = $this->saveCBSubscription($oRes, $productType);
            $subscriptionID = $oRes->id;
            //return $subscriptionID;
        }
        return $subscriptionID;
        die();
        //We are dealing this with CB webhoook, so we don't need this for now
        if (!empty($oInvoice)) {
            $this->logInvoiceData($oInvoice);
        }
    }

    public function endSubscription($subscriptionID, $updatedTime) {
        if (!empty($subscriptionID)) {
            $data = array('subscription_status'=> 'ended_on_upgrade', 'subscription_id' => $subscriptionID.'__OLD', 'updated_at'=> $updatedTime);
            $this->db->where("subscription_id", $subscriptionID);
            $this->db->update("tbl_cc_subscriptions", $data);
            return true;
        } else {
            return false;
        }
    }
    
    public function updateSubsription($subscriptionID, $status, $updateTime){
        if(!empty($subscriptionID)){
            $data = array("subscription_status" => $status, 'updated_at'=> $updateTime);
            $this->db->where("subscription_id", $subscriptionID);
            $result = $this->db->update("tbl_cc_subscriptions", $data);
            //echo $this->db->last_query();
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }

    public function ccChargeInvoice($aInput) {
        $transactionStatus = '';
        $aResponse = ChargeBee_Invoice::create($aInput);
        $oRes = $aResponse->invoice();
        //Call savelog function here
        if (!empty($oRes)) {
            $bSavedInvoices = $this->logInvoiceData($oRes);
            $aTransactionData = $oRes->linkedPayments;
            $transactionID = (is_array($aTransactionData)) ? $aTransactionData[0]->txnId : '';
            $transactionStatus = (is_array($aTransactionData)) ?  $aTransactionData[0]->txnStatus : $oRes->status;
        }

        return $transactionStatus;
    }

    public function saveCBSubscription($oRes, $productType) {
        if (!empty($oRes)) {
            $aData = array(
                'subscription_id' => $oRes->id,
                'customer_id' => $oRes->customerId,
                'plan_id' => $oRes->planId,
                'billing_period' => $oRes->billingPeriod,
                'billing_period_unit' => $oRes->billingPeriodUnit,
                'subscription_status' => $oRes->status,
                'trial_start' => $oRes->trialStart,
                'trial_end' => $oRes->trialEnd,
                'next_billing_at' => $oRes->nextBillingAt,
                'created_at' => $oRes->createdAt,
                'started_at' => $oRes->startedAt
            );

            $bLocalSubscriptionID = $this->saveSubscription($aData);
            if(!empty($bLocalSubscriptionID)){
                $this->updateClientMembership($aData['customer_id'], $aData['subscription_id'], $productType);
            }
            return $bLocalSubscriptionID;
        }
    }

    public function logInvoiceData($oRes) {
        if (!empty($oRes)) {
            //pre($oRes);
            //Collect Invoice related data and save into our database
            $aTransactionData = $oRes->linkedPayments;
            //pre($aTransactionData);
            $aBillingData = $oRes->billingAddress;
            $transactionID = (is_array($aTransactionData)) ? $aTransactionData[0]->txnId : '';
            $transactionStatus = (is_array($aTransactionData)) ? $aTransactionData[0]->txnStatus : $oRes->status ;
            $aInvoiceItems = $oRes->lineItems;
            $billingFN = $oRes->billingAddress->firstName;
            $billingLN = $oRes->billingAddress->lastName;
            $billingZip = $oRes->billingAddress->zip;
            $aInvoiceData = array(
                'customer_id' => $oRes->customerId,
                'cc_invoice_id' => $oRes->id,
                'invoice_status' => $oRes->status,
                'is_recurring' => $oRes->recurring,
                'subscription_id' => $oRes->subscriptionId,
                'total' => $oRes->total,
                'amount_paid' => $oRes->amountPaid,
                'amount_due' => $oRes->amountDue,
                'currency' => $oRes->currencyCode,
                'paid_at' => $oRes->paidAt,
                'txn_id' => $transactionID,
                'txn_status' => $transactionStatus,
                'bill_firstname' => $billingFN,
                'bill_lastname' => $billingLN,
                'bill_zip' => $billingZip
            );

            $localinvoiceID = $this->saveCBInvoice($aInvoiceData);
            if ($localinvoiceID > 0 && !empty($aInvoiceItems)) {
                $bSaved = $this->saveCBInvoiceItems($localinvoiceID, $aInvoiceItems);
                if ($bSaved)
                    return true;
            }

            if ($localinvoiceID > 0) {
                return true;
            }
        }
        return false;
    }

    public function saveCBInvoice($aData) {
        $invoiceID = 0;
        $result = $this->db->insert('tbl_cc_invoices', $aData);
        //echo $this->db->last_query();
        if ($result) {
            $invoiceID = $this->db->insert_id();
        }
        return $invoiceID;
    }

    public function saveCBInvoiceItems($id, $aData) {
        if (!empty($aData)) {
            foreach ($aData as $aRowData) {
                $aItemData = array(
                    'local_invoice_id' => $id,
                    'cc_item_id' => $aRowData->id,
                    'amount' => $aRowData->amount,
                    'description' => $aRowData->description,
                    'entity_type' => $aRowData->entityType,
                    'entity_id' => $aRowData->entityId,
                    'unit_amount' => $aRowData->unitAmount,
                    'quantity' => $aRowData->quantity,
                    'date_from' => $aRowData->dateFrom,
                    'date_to' => $aRowData->dateTo
                );
                $this->db->insert('tbl_cc_invoices_items', $aItemData);
                //echo $this->db->last_query();
            }
        }
    }

    public function saveSubscription($aData) {
        $result = $this->db->insert('tbl_cc_subscriptions', $aData);
        //echo $this->db->last_query();
        if ($result) {
            $localSubscriptionID = $this->db->insert_id();
        }
        return $localSubscriptionID;
    }
    
    public function updateClientMembership($customerID, $subscriptionID, $productType){
        if(!empty($customerID)){
            $this->db->where("cb_contact_id", $customerID);
            if($productType == 'membership'){
                $result = $this->db->update("tbl_users", array('subscription_id'=>$subscriptionID));
            }
            
            if($productType == 'topup-membership'){
                $result = $this->db->update("tbl_users", array('topup_subscription_id'=>$subscriptionID));
            }
            
            if($result){
                return true;
            }else{
                return false;
            }
        }
        
    }
    
    

}
