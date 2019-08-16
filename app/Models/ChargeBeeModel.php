<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

//require_once $_SERVER['DOCUMENT_ROOT'] . '/app/chargebee/lib/ChargeBee.php';
//use App\ChargeBee\Lib;

class ChargeBeeModel extends Model {

    /**
     * Used to create contact at chargebee
     * @param type $aData
     * @return boolean
     */
    public function createContact($aData = array()) {
        //ChargeBee_Environment::configure("https://brandboost.chargebee.com","live_AAWPsatYm8HgEGQflS02Wbcu2cSMAY6uI");
        $firstName = isset($aData['firstname']) ? $aData['firstname'] : '';
        $lastName = isset($aData['lastname']) ? $aData['lastname'] : '';
        $email = isset($aData['email']) ? $aData['email'] : '';
        $phone = isset($aData['phone']) ? $aData['phone'] : '';
        $zip = isset($aData['zip']) ? $aData['zip'] : '';
        $country = isset($aData['country']) ? $aData['country'] : '';
        $address = isset($aData['address']) ? $aData['address'] : '';
        $city = isset($aData['city']) ? $aData['city'] : '';
        $state = isset($aData['state']) ? $aData['state'] : '';
        $password = isset($aData['password']) ? $aData['password'] : '';
        $yesshipping = @(!empty($aData['is_shipping_same'])) ? $aData['is_shipping_same'] : 1;
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

        $oRes = cbHelperCreateContact($aInput);

        if (!empty($oRes)) {
            $contactID = $oRes->id;
            return $contactID;
        } else {
            return false;
        }
    }

    /**
     * Used to add CC related info
     * @param type $contactID
     * @param type $aInput
     * @return type
     */
    public function AddCreditCart($contactID, $aInput) {
        $aRes = array();
        $oRes = cbHelperAddCC($contactID, $aInput);
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

    /**
     * Create chargebee subscription
     * @param type $contactID
     * @param type $aInput
     * @param type $productType
     * @return type
     */
    public function ccCreateSubscription($contactID, $aInput, $productType) {
        $subscriptionID = 0;
        $oRes = cbHelperCreateSubscription($contactID, $aInput);
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

    /**
     * Used to end subscription locally
     * @param type $subscriptionID
     * @param type $updatedTime
     * @return boolean
     */
    public function endSubscription($subscriptionID, $updatedTime) {
        if (!empty($subscriptionID)) {
            $aData = array(
                'subscription_status' => 'ended_on_upgrade',
                'subscription_id' => $subscriptionID . '__OLD',
                'updated_at' => $updatedTime
            );

            DB::table('tbl_cc_subscriptions')
                    ->where('subscription_id', $subscriptionID)
                    ->update($aData);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to update subscription locally
     * @param type $subscriptionID
     * @param type $status
     * @param type $updateTime
     * @return boolean
     */
    public function updateSubscription($subscriptionID, $status, $updateTime) {
        if (!empty($subscriptionID)) {
            $aData = array(
                "subscription_status" => $status,
                'updated_at' => $updateTime
            );
            DB::table('tbl_cc_subscriptions')
                    ->where('subscription_id', $subscriptionID)
                    ->update($aData);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to charge invoice 
     * @param type $aInput
     * @return type
     */
    public function ccChargeInvoice($aInput) {
        $transactionStatus = '';
        $oRes = cbHelperCreateInvoice($aInput);
        //Call savelog function here
        if (!empty($oRes)) {
            $bSavedInvoices = $this->logInvoiceData($oRes);
            $aTransactionData = $oRes->linkedPayments;
            $transactionID = (is_array($aTransactionData)) ? $aTransactionData[0]->txnId : '';
            $transactionStatus = (is_array($aTransactionData)) ? $aTransactionData[0]->txnStatus : $oRes->status;
        }

        return $transactionStatus;
    }

    /**
     * Save Chagebee subscription related data
     * @param type $oRes
     * @param type $productType
     * @return type
     */
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
            if (!empty($bLocalSubscriptionID)) {
                $this->updateClientMembership($aData['customer_id'], $aData['subscription_id'], $productType);
            }
            return $bLocalSubscriptionID;
        }
    }

    /**
     * Used to save invoice data locally
     * @param type $oRes
     * @return boolean
     */
    public function logInvoiceData($oRes) {
        if (!empty($oRes)) {
            //pre($oRes);
            //Collect Invoice related data and save into our database
            $aTransactionData = $oRes->linkedPayments;
            //pre($aTransactionData);
            $aBillingData = $oRes->billingAddress;
            $transactionID = (is_array($aTransactionData)) ? $aTransactionData[0]->txnId : '';
            $transactionStatus = (is_array($aTransactionData)) ? $aTransactionData[0]->txnStatus : $oRes->status;
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

    /**
     * Used to save CB invoice data locally
     * @param type $aData
     * @return type
     */
    public function saveCBInvoice($aData) {
        $insert_id = DB::table('tbl_cc_invoices')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to save Invoice Items locally
     * @param type $id
     * @param type $aData
     */
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
                DB::table('tbl_cc_invoices_items')->insert($aItemData);
            }
        }
    }

    /**
     * Used to save Subscription
     * @param type $aData
     * @return type
     */
    public function saveSubscription($aData) {
        $insert_id = DB::table('tbl_cc_subscriptions')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to update client membership locally
     * @param type $customerID
     * @param type $subscriptionID
     * @param type $productType
     * @return boolean
     */
    public function updateClientMembership($customerID, $subscriptionID, $productType) {
        if (!empty($customerID)) {

            if ($productType == 'membership') {
                $fieldName = 'subscription_id';
            }

            if ($productType == 'topup-membership') {
                $fieldName = 'topup_subscription_id';
            }
            
            $aData = array(
                $fieldName => $subscriptionID
            );

            DB::table('tbl_users')
                    ->where('cb_contact_id', $customerID)
                    ->update($aData);
            
            return true;
        }
    }

}
