<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class SubscriptionsModel extends Model {


    /**
    * This function will return subscription
    * @param type $clientID
    * @return type
    */

    public function getSubscriptions($id = '') {
        $sql = "SELECT tbl_cc_subscriptions.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_cc_membership.level_name AS plan_title, tbl_cc_membership.type, tbl_cc_membership.price FROM tbl_cc_subscriptions "
                . "LEFT JOIN tbl_users ON tbl_cc_subscriptions.customer_id=tbl_users.cb_contact_id "
                . "LEFT JOIN tbl_cc_membership ON tbl_cc_subscriptions.plan_id=tbl_cc_membership.plan_id WHERE 1 ";

        if ($id > 0) {
            $sql .= " AND tbl_cc_subscriptions.id = '{$id}'";
        }
        
        $sql .= " AND tbl_cc_subscriptions.subscription_status != 'ended_on_upgrade'";

        $sql .= " ORDER BY tbl_cc_subscriptions.id DESC";
       $aData = DB::select(DB::raw($sql));
       return $aData;

    }


    /**
    * This function will return Basic plan stats
    * @param type $clientID
    * @return type
    */

    public function getPlanBasicStats($planID) {
        $sql = "SELECT subscription_status,COUNT(id) AS total_count FROM tbl_cc_subscriptions WHERE plan_id='{$planID}' GROUP BY subscription_status";
        $aData = DB::select(DB::raw($sql));
        return $aData;
    }

}

?>