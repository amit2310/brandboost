<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurringModel extends Model {

    public function getLastRecurringID($contactID) {
        $this->db->select('recurring_order_id');
        $this->db->where('infusion_user_id', $contactID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('tbl_invoices_recurring');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $lastID = $query->row()->id;
        }
        return $lastID;
    }

    public function saveRecurring($aData = array()) {
        $result = $this->db->insert('tbl_invoices_recurring', $aData);
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
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
                $this->db->insert('tbl_cc_invoices_items', $aItemData);
                //echo $this->db->last_query();
            }
        }
        return true;
    }

    public function checkIfAlreadyCBInvoiceSaved($cbInvoiceID = 0, $trasID = 0) {
        $this->db->where("cc_invoice_id", $cbInvoiceID);
        $this->db->where("txn_id", $trasID);
        $result = $this->db->get("tbl_cc_invoices");
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function updateSubscription($subscriptionID, $aData) {
        if (!empty($subscriptionID)) {
            $this->db->where("subscription_id", $subscriptionID);
            $result = $this->db->update("tbl_cc_subscriptions", $aData);
            if ($result)
                return true;
            else
                return false;
        }else {
            return false;
        }
    }

    public function getSubsDetails($subscriptionID) {
        $this->db->select("tbl_cc_subscriptions.*, tbl_users.id AS user_id");
        $this->db->join("tbl_cc_subscriptions.customer_id = tbl_users.cb_contact_id", "INNER");
        $this->db->where("tbl_cc_subscriptions.subscription_id", $subscriptionID);
        $result = $this->db->get("tbl_cc_subscriptions");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

}
