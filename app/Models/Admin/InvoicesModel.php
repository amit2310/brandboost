<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class InvoicesModel extends Model {

    public static function getInvoices($clientID) {

        $oData = DB::table('tbl_cc_invoices')
            ->join('tbl_users', 'tbl_cc_invoices.customer_id', '=' , 'tbl_users.cb_contact_id')
            ->select('tbl_cc_invoices.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email')
            ->where('tbl_users.id', $clientID)
            ->orderBy("tbl_cc_invoices.id", "DESC")
            ->get();

        return $oData;
    }

    public static function getInvoiceDetails($invoiceID) {

        $oData = DB::table('tbl_cc_invoices')
            ->leftJoin('tbl_cc_invoices_items', 'tbl_cc_invoices.id', '=' , 'tbl_cc_invoices_items.local_invoice_id')
            ->leftJoin('tbl_users', 'tbl_cc_invoices.customer_id', '=' , 'tbl_users.cb_contact_id')
            ->leftJoin('tbl_cc_subscriptions', 'tbl_cc_subscriptions.subscription_id', '=' , 'tbl_cc_invoices_items.local_invoice_id')
            ->select('tbl_cc_invoices.*', 'tbl_cc_invoices.id AS invoice_id', 'tbl_cc_invoices.created AS invoice_date', 'tbl_cc_invoices_items.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_cc_subscriptions.next_billing_at')
            ->where('tbl_cc_invoices.id', $invoiceID)
            ->get();

        return $oData;
        
    }

    

}
