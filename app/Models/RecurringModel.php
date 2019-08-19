<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RecurringModel extends Model {

    /**
     * Used to get Last Recurring ID
     * @param type $contactID
     * @return type
     */
    public function getLastRecurringID($contactID) {
        $oData = DB::table('tbl_invoices_recurring')
                ->select('recurring_order_id')
                ->where('infusion_user_id', $contactID)
                ->orderBy('id', 'DESC')
                ->first();
        if (!empty($oData)) {
            $lastID = $oData->id;
        }
        return $lastID;
    }

    /**
     * Used to save Recurring related data locally
     * @param type $aData
     * @return boolean
     */
    public function saveRecurring($aData = array()) {
        $result = DB::table('tbl_invoices_recurring')->insert($aData);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Used to save chargebee invoice locally
     * @param type $aData
     * @return type
     */
    public function saveCBInvoice($aData) {
        $invoiceID = DB::table('tbl_cc_invoices')->insertGetId($aData);
        return $invoiceID;
    }

    /**
     * Used to save invoice items locally
     * @param type $id
     * @param type $aData
     * @return boolean
     */
    public function saveCBInvoiceItems($id, $aData) {
        if (!empty($aData)) {
            foreach ($aData as $aRow) {
                $aItemData = array(
                    'local_invoice_id' => $id,
                    'cc_item_id' => $aRow['id'],
                    'amount' => $aRow['amount'],
                    'description' => $aRow['description'],
                    'entity_type' => $aRow['entity_type'],
                    'entity_id' => $aRow['entity_id'],
                    'unit_amount' => ($aRow['unit_amount'] / 100),
                    'quantity' => $aRow['quantity'],
                    'date_from' => $aRow['date_from'],
                    'date_to' => $aRow['date_to']
                );
                DB::table('tbl_cc_invoices_items')->insert($aItemData);
            }
        }
        return true;
    }

    /**
     * Used to check if chargebee invoice saved already
     * @param type $cbInvoiceID
     * @param type $trasID
     * @return boolean
     */
    public function checkIfAlreadyCBInvoiceSaved($cbInvoiceID = 0, $trasID = 0) {
        $oData = DB::table('tbl_cc_invoices')
                ->where('cc_invoice_id', $cbInvoiceID)
                ->where('txn_id', $trasID)
                ->exists();
        return $oData;
    }

    /**
     * Used to update subscription related data locally
     * @param type $subscriptionID
     * @param type $aData
     * @return boolean
     */
    public function updateSubscription($subscriptionID, $aData) {
        if (!empty($subscriptionID)) {
            $oData = DB::table('tbl_cc_subscriptions')
                    ->where('subscription_id', $subscriptionID)
                    ->update($aData);
            if ($oData > -1)
                return true;
            else
                return false;
        }else {
            return false;
        }
    }

    /**
     * Used to get subscription related datails
     * @param type $subscriptionID
     * @return type
     */
    public function getSubsDetails($subscriptionID) {
        $oData = DB::table('tbl_cc_subscriptions')
                ->join('tbl_users', 'tbl_cc_subscriptions.customer_id', '=', 'tbl_users.cb_contact_id')
                ->select('tbl_cc_subscriptions.*', 'tbl_users.id AS user_id')
                ->where('tbl_cc_subscriptions.subscription_id', $subscriptionID)
                ->first();
        return $oData;        
    }

}
