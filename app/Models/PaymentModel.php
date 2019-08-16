<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class PaymentModel extends Model {

    public function checkEmailAlreadyExist($email) {
        $this->db->where('email', $email);
        $result = $this->db->get('tbl_users');
        if ($result->num_rows() > 0) {
            $response = $result->row();
            return true;
        } else {
            return false;
        }
    }

    public function saveInvoice($aData) {
        $this->db->insert("tbl_invoices", $aData);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        }
    }

    public function saveFailedInvoice($dataSaveInvoice) {
        $this->db->insert("tbl_failed_orders", $dataSaveInvoice);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        }
    }

    public function saveInvoiceDetails($data) {
        $this->db->insert("tbl_invoices_details", $data);
        //echo $this->db->last_query();
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        }
    }

    public function saveJob($dataSaveJob) {
        $this->db->insert("tbl_invoices_jobs", $dataSaveJob);
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        }
    }

    public function getCountryById($country) {
        $this->db->where('id', $country);
        $result = $this->db->get('tbl_countries');
        if ($result->num_rows() > 0) {
            $response = $result->row()->name;
        }
        return $response;
    }

    public function getStateById($state) {
        $this->db->where('id', $state);
        $result = $this->db->get('tbl_states');
        if ($result->num_rows() > 0) {
            $response = $result->row()->name;
        }
        return $response;
    }

    public function getCityById($city) {
        $this->db->where('id', $city);
        $result = $this->db->get('tbl_cities');
        if ($result->num_rows() > 0) {
            $response = $result->row()->name;
        }
        return $response;
    }

    public function getJobId($id) {
        $response = false;
        $this->db->where('id', $id);
        $result = $this->db->get('tbl_invoices');
        if ($result->num_rows() > 0) {
            $response = $result->row()->infusion_job_id;
        }
        return $response;
    }

    /**
     * Used to refill client credits
     * @param type $userID
     * @param type $aData
     * @return boolean
     */
    public function refillAccount($userID, $aData = array()) {

        if (empty($userID) || !($userID))
            return false;

        $bHaveAccount = $this->checkRefillAccount($userID);


        if ($bHaveAccount) {
            $result = DB::table('tbl_account_usage')
                    ->where('user_id', $userID)
                    ->update($aData);
            return true;
        } else {
            $aData['created'] = date("Y-m-d H:i:s");
            $result = DB::table('tbl_account_usage')
                    ->insert($aData);
            return true;
        }
        return false;
    }

    /**
     * Check for refill Account
     * @param type $userID
     * @return type
     */
    public function checkRefillAccount($userID) {
        $result = DB::table('tbl_account_usage')
                    ->where('user_id', $userID)
                    ->exists();
        return $result;
    }

    
    /**
     * Get Current User subscription
     * @param type $userID
     * @param type $subscriptionID
     * @return type
     */
    public function getCurrentUserSubscription($userID, $subscriptionID = 0) {

        $sql = "SELECT `tbl_cc_subscriptions`.* FROM `tbl_cc_subscriptions` 
            LEFT JOIN  `tbl_users` ON `tbl_cc_subscriptions`.`customer_id` = `tbl_users`.`cb_contact_id`
            WHERE `tbl_users`.`id` = '{$userID}' AND `tbl_cc_subscriptions`.`subscription_id` = '{$subscriptionID}' 
            AND (`tbl_cc_subscriptions`.`subscription_status` = 'active' OR `tbl_cc_subscriptions`.`subscription_status` = 'in_trial')
            ORDER BY `tbl_cc_subscriptions`.`id` DESC ";

        $oData = DB::select(DB::raw($sql));

        return $oData;
    }

    public function getCurrentUserSubscription_OLD($userID, $subscriptionID = 0) {
        $this->db->select("tbl_cc_subscriptions.*");
        $this->db->join("tbl_users", "tbl_cc_subscriptions.customer_id=tbl_users.cb_contact_id", "LEFT");
        $this->db->where("tbl_users.id", $userID);
        $this->db->where("tbl_users.subscription_id", $subscriptionID);
        $this->db->where("tbl_cc_subscriptions.subscription_status", "active");
        $this->db->or_where("tbl_cc_subscriptions.subscription_status", "in_trial");
        $this->db->order_by("tbl_cc_subscriptions.id", "DESC");
        $this->db->limit("1");
        $result = $this->db->get('tbl_cc_subscriptions');
        echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getCurrentUserTopupSubscription($userID, $subscriptionID) {
        $this->db->select("tbl_cc_subscriptions.*");
        $this->db->join("tbl_users", "tbl_cc_subscriptions.customer_id=tbl_users.cb_contact_id", "LEFT");
        $this->db->where("tbl_users.id", $userID);
        $this->db->where("tbl_users.topup_subscription_id", $subscriptionID);
        $this->db->where("tbl_cc_subscriptions.subscription_status", "active");
        $this->db->or_where("tbl_cc_subscriptions.subscription_status", "in_trial");
        $this->db->order_by("tbl_cc_subscriptions.id", "DESC");
        $this->db->limit("1");
        $result = $this->db->get('tbl_cc_subscriptions');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    /**
     * Log Refill History
     * @param type $aData
     * @return boolean
     */
    public function logRefillHistory($aData) {
        $result = DB::table('tbl_account_refill_history')->insert($aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function sendEmail($emailData) {

        $mailFrom = 'sandgrid';
        $sitefromemail = 'Real CRM';
        $siteemail = 'alen@nextmarketmedia.com';

        $sandgriduser = 'clickdrop';
        $sandgridpass = 'b5iJSsFiQv';
        $sandgridHost = 'smtp.sendgrid.net';
        $sandgridPort = 2525;
        $sandgridType = 'html';
        $emailContent = $emailData['content'];
        $subject = $emailData['subject'];

        if ($mailFrom == 'sandgrid') {

            $url = 'https://api.sendgrid.com/';
            $user = $sandgriduser;
            $pass = $sandgridpass;
            $json_string = array(
                'to' => array($emailData['adminemail'])
            );
            $plainText = convertHtmlToPlain($emailContent);
            $params = array(
                'api_user' => $user,
                'api_key' => $pass,
                'x-smtpapi' => json_encode($json_string),
                'to' => $emailData['email'],
                'subject' => ($subject) ? $subject : $this->config->item('blank_subject'),
                'html' => $emailContent,
                'text' => $plainText,
                'from' => $siteemail,
            );
            $request = $url . 'api/mail.send.json';

            $session = curl_init($request);
            curl_setopt($session, CURLOPT_POST, true);
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($session);
            curl_close($session);
        } else {

            $to = $emailData['adminemail'];
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-updateUserSession8" . "\r\n";
            $headers .= "From:$siteemail";
            mail($to, $subject, $emailContent, $headers);
        }
    }

}
