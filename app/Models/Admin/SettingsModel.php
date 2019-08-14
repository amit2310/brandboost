<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class SettingsModel extends Model {

    /**
     * Get System Notification Templates
     * @param type $id
     * @return type
     */
    public static function getSystemNotificationTemplates($id = "") {
        $response = DB::table('tbl_notifications_sys_templates')
                ->when(($id > 0), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->orderBy('id', 'desc')
                ->get();
        return $response;
    }

    /**
    * Get file size limit
    * @param type $cName
    * @return type
    */
   public static function getFilesizeSettings($cName) {

       $oData = DB::table('tbl_filesize_settings')
               ->where('name', $cName)
               ->first();

       return $oData->value;
   }

   

    /**
     * This function used to get notification related data
     * @param type $userID
     * @return type
     */
    public static function getNotificationSettings($userID) {

        $oSettings = DB::table('tbl_users_notification_settings')
                ->where('user_id', $userID)
                ->first();
        return $oSettings;
    }

    /**
     * This function used to get slug information for notification purpose
     * @param type $userID
     * @return type
     */
    public static function getSlugdetails($slug) {
        $oData = DB::table('tbl_notifications_manager')
                ->where('tbl_notifications_manager.notification_slug', $slug)
                ->get();
        return $oData;
    }

    /**
     * Used to get current credit usage of a client
     * @param type $clientID
     * @return type
     */
    public static function getCurrentUsage($clientID) {
        $oData = DB::table('tbl_account_usage')
                ->where('user_id', $clientID)
                ->first();
        return $oData;
    }

    /**
     * Used to save client usage
     * @param type $clientID
     * @return type
     */
    public static function saveClientUsageTracking($aData) {
        $oData = DB::table('tbl_account_usage_tracking')
                ->insert($aData);
        return $oData;
    }

    /**
     * Used to save client usage
     * @param type $clientID
     * @return type
     */
    public static function runCustomQuery($sql) {
        $oData = DB::raw($sql);
        return $oData;
    }

    /**
     * This function is use for get allow notification
     * @return type object
     */
    public static function getallowNotification() {

        $oData = DB::table('tbl_notifications_manager')
                ->select('tbl_notifications_manager.*')
                ->where('tbl_notifications_manager.client', '1')
                ->get();
        return $oData;
    }

    public function updateContactStoreUsage($userID) {
        $oCurrentUsage = $this->getCurrentUsage($userID);
        if (!empty($oCurrentUsage)) {
            $mainContactLimit = $oCurrentUsage->contact_limit;
            $mainContactLimitTopup = $oCurrentUsage->contact_limit_topup;
            $sFieldName = '';
            if ($mainContactLimit > 0) {
                $sFieldName = '`contact_limit`';
            } else if ($mainContactLimitTopup > 0) {
                $sFieldName = '`contact_limit_topup`';
            }

            if (!empty($sFieldName)) {
                $sql = "UPDATE tbl_account_usage SET {$sFieldName} = ({$sFieldName} - 1) WHERE user_id='{$userID}'";
                $result = $this->db->query($sql);
                if ($result)
                    return true;
                else
                    return false;
            }
        }
    }

    // this function is user to get the remaining credit value 
    public function getremainingCredits($clientID) {
        $this->db->where("user_id", $clientID);
        $result = $this->db->get('tbl_account_usage');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    // this function is update the credit interval
    public function updateCreditInterval($aData, $clientID) {
        if ($clientID > 0) {
            $response = array();
            $this->db->where('id', $clientID);
            $result = $this->db->update('tbl_users', $aData);
            //echo $this->db->last_query();
        }
    }

    /**
     * This function will return client account credit values 
     * @param type $clientID
     * @return type
     */
    public static function getCreditValues($id = '') {
        $response = DB::table('tbl_credit_values')
                ->when(($id > 0), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->get();
        return $response;
    }

    /**
     * This function use for get import history
     * @param type $userID
     * @return type object
     */
    public static function getImportHistory($userID) {

        $oData = DB::table('tbl_history_import')
                ->where('user_id', $userID)
                ->orderBy('id', 'DESC')
                ->get();
        return $oData;
    }

    /**
     * This function use for get export history
     * @param type $userID
     * @return type object
     */
    public static function getExportHistory($userID) {

        $oData = DB::table('tbl_history_export')
                ->where('user_id', $userID)
                ->orderBy('id', 'DESC')
                ->get();
        return $oData;
    }


    /**
     * This function use for get setting data
     * @return type object
     */
    public static function getSettingsData() {

        $oData = DB::table('tbl_popup_settings')
                ->get();
        return $oData;
    }

    /**
     * This function use for update company profile
     * @return type boolean
     */
    public static function updateCompanyProfile($aData, $userID) {
        if ($userID > 0) {
            $oData = DB::table('tbl_users')
                ->where('id', $userID)
                ->update($aData);
            return true;
        }
    }


    /**
    * This function will return all credit values 
    * @param type $clientID
    * @return type
    */

    public function getCreditValuesHistory() {
        $aData =  DB::table('tbl_credit_values_history')->get();
        
        return $aData;
    }

    public function updateCreditValues($aData, $id) {
        if ($id > 0) {
            $aData =  DB::table('tbl_credit_values')
             ->where('id', $id)->update($aData);
             return true;
           
        }
        return false;
    }

    public function addCreditHistory($aData) {
        $result = DB::table('tbl_credit_values_history')->insert($aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function addTwiliodetails($aData) {
        $response = array();
        $this->db->where('sid', $aData['sid']);
        $result = $this->db->get("tbl_twilio_logs");
        if ($result->num_rows() <= 0) {
            $result = $this->db->insert('tbl_twilio_logs', $aData);
        }
    }

    public function addSettings($aData) {

        $result = $this->db->insert('tbl_popup_settings', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function getSettingsDataByField($fieldKey) {

        $response = array();
        $this->db->where('setting_key', $fieldKey);
        $this->db->from('tbl_popup_settings');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateSettingsData($aData, $fieldName) {

        $response = array();
        $this->db->set($aData);
        $this->db->where('setting_key', $fieldName);
        $result = $this->db->update('tbl_popup_settings');
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * This function is use to check the module permissons allow for notifications 
     * @param type $clientID
     * @return type
     */
    public static function updateNotificationSettings($aData, $userID) {
        if ($userID > 0) {
          
            DB::table('tbl_users_notification_settings')
                ->where('user_id', $userID)
                ->update($aData);

            return true;
        }
    }

    /**
     * This function is use to check the module permissons allow for notifications 
     * @param type $clientID
     * @return type
     */
    public static function checkPermissionentryDetails($userID, $slug) {

        $oData = DB::table('tbl_notifications_permission_entry')
                ->where('user_id', $userID)
                ->where('notification_slug', $slug)
                ->first();
        return $oData;
    }

    /**
     * This function is use for add notification settings
     * @param type $userID
     * @return type
     */
    public static function addNotificationSettings($userID) {
        $aData = array('user_id' => $userID);
        $oData = DB::table('tbl_users_notification_settings')
                ->insert($aData);
        return $oData;
    }

    /**
     * This function is use for update notification permission
     * @param type $aData
     * @param type $userID
     * @return type boolean
     */
    public static function updateNotificationPermissonData($aData, $userID) {

        $oData = DB::table('tbl_notifications_permission_entry')
                ->where('user_id', $userID)
                ->where('notification_slug', $aData['notification_slug'])
                ->get();
       
        if($oData->count() > 0) {
            $oData = DB::table('tbl_notifications_permission_entry')
                ->where('user_id', $userID)
                ->where('notification_slug', $aData['notification_slug'])
                ->delete();
        }
        else {
            $oData = DB::table('tbl_notifications_permission_entry')
                ->insert(array('user_id' => $userID, 'notification_slug' => $aData['notification_slug']));
        }
    
        return true;

    }

    /**
     * This function is use for log export history
     * @param type $aData
     * @return type boolean
     */
    public function logExportHistory($aData) {
        $oData = DB::table('tbl_history_export')
                ->insert($aData);
    }

    /**
     * This function is use for log import history
     * @param type $aData
     * @return type boolean
     */
    public function logImportHistory($aData) {
        $oData = DB::table('tbl_history_import')
                ->insert($aData);
    }

    /**
     * Get email notification content
     * @param type $id
     * @return type object 
     */
    public function getEmailNotificationContent($id = "") {

        $response = DB::table('tbl_notifications_manager')
                ->when(($id > 0), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->orderBy('id', 'desc')
                ->get();
        return $response;
    }

    public function getSystemNotifyPermissions($userID, $eventName) {
        $bSystemNotification = true;
        $bPermission = false;
        $oSettings = $this->getNotificationSettings($userID);
        if (!$oSettings->system_notify) {
            $bSystemNotification = false;
        }

        if ($bSystemNotification == true) {
            switch ($eventName) {
                case "sys_assign_chat":
                    $bPermission = ($oSettings->sys_assign_chat == '1') ? true : false;
                    break;
                case "sys_onsite_review_add":
                    $bPermission = ($oSettings->sys_onsite_review_add == '1') ? true : false;
                    break;
                case "sys_offsite_review_add":
                    $bPermission = ($oSettings->sys_offsite_review_add == '1') ? true : false;
                    break;
                case "sys_nps_score_add":
                    $bPermission = ($oSettings->sys_nps_score_add == '1') ? true : false;
                    break;
                case "sys_referral_add":
                    $bPermission = ($oSettings->sys_referral_add == '1') ? true : false;
                    break;
                case "sys_media_add":
                    $bPermission = ($oSettings->sys_media_add == '1') ? true : false;
                    break;
                case "sys_workflow_action":
                    $bPermission = ($oSettings->sys_workflow_action == '1') ? true : false;
                    break;
                default :
                    $bPermission = true;
            }
        }
        $aResult = array(
            'permission' => $bPermission,
            'notification_settings' => $oSettings
        );
        return $aResult;
    }

    public function getEmailNotifyPermissions($userID, $eventName) {
        $bEmailNotification = true;
        $bPermission = false;
        $oSettings = $this->getNotificationSettings($userID);
        if (!$oSettings->email_notify) {
            $bEmailNotification = false;
        }

        if ($bEmailNotification == true) {
            switch ($eventName) {
                case "email_assign_chat":
                    $bPermission = ($oSettings->email_assign_chat == '1') ? true : false;
                    break;
                case "email_onsite_review_add":
                    $bPermission = ($oSettings->email_onsite_review_add == '1') ? true : false;
                    break;
                case "email_offsite_review_add":
                    $bPermission = ($oSettings->email_offsite_review_add == '1') ? true : false;
                    break;
                case "email_nps_score_add":
                    $bPermission = ($oSettings->email_nps_score_add == '1') ? true : false;
                    break;
                case "email_referral_add":
                    $bPermission = ($oSettings->email_referral_add == '1') ? true : false;
                    break;
                case "email_media_add":
                    $bPermission = ($oSettings->email_media_add == '1') ? true : false;
                    break;
                case "email_workflow_action":
                    $bPermission = ($oSettings->email_workflow_action == '1') ? true : false;
                    break;
                default :
                    $bPermission = true;
            }
        }

        $aResult = array(
            'permission' => $bPermission,
            'notification_settings' => $oSettings
        );
        return $aResult;
    }

    public function addSystemNotificationTemplate($aData) {
        $result = $this->db->insert('tbl_notifications_sys_templates', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function updateSystemNotificationTemplate($aData, $id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $result = $this->db->update('tbl_notifications_sys_templates', $aData);
            if ($result)
                return true;
            else
                return false;
        }
        return false;
    }

    public function deleteSystemNotificationTemplate($id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $result = $this->db->delete('tbl_notifications_sys_templates');
            if ($result)
                return true;
            else
                return false;
        }
        return false;
    }

    public function updateEmailNotificationTemplate($aData, $id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $result = $this->db->update('tbl_notifications_email_templates', $aData);
            if ($result)
                return true;
            else
                return false;
        }
        return false;
    }

    

   /**
    * This function is used to update the amazon s3 settings 
    * @param type 
    * @return type
    */

    public function updateS3StorageDetails($aData, $id) {
        if ($id > 0) {
            $aData =  DB::table('tbl_users')->where('id', $id)->update($aData);
            return true;
            
        }
        return false;
    }


    /**
    * This function is used to update notification content
    * @param type $aData, $id
    * @return type
    */

    public function updateNotificationContent($aData, $id) {
        if ($id > 0) {

            $aData =  DB::table('tbl_notifications_manager')->where('id', $id)->update($aData);
            return true;
            
        }
        return false;
    }

    public function deleteEmailNotificationTemplate($id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $result = $this->db->delete('tbl_notifications_email_templates');
            if ($result)
                return true;
            else
                return false;
        }
        return false;
    }

    /**
     * Used to get notification templates
     * @param type $id
     * @return type
     */
    public static function getEmailNotificationTemplates($id = "") {
        $oData = DB::table('tbl_notifications_email_templates')
                ->when(($id>0), function($query) use ($loginid){
                    return $query->where('id', $id);
                })
                ->orderBy('id', 'desc')
                ->get();
        return $oData;        
    }


    public function addEmailNotificationTemplate($aData) {
        $result = $this->db->insert('tbl_notifications_email_templates', $aData);
        if ($result)
            return true;
        else
            return false;
    }

   /**
    * This function is used to get all notifications 
    * @param type $userId
    * @param type $type
    * @return type
    */
  
    public function listNotifications($userId, $type = '') {

        $oData = DB::table('tbl_notifications_manager')
                ->select('tbl_notifications_manager.*')
                ->where('tbl_notifications_manager.status', '1')
                ->get();

        return $oData;
    }


    /**
    * This function is used to update notification permissions 
    * @param type $aData
    * @return type boolean
    */

    public function updateNotificationPermissions($aData) {

        if ($aData['id'] > 0 && !empty($aData['permission']) && !empty($aData['userId']) && !empty($aData['user_type'])) {

            $query = "update tbl_notifications_manager set " . $aData['permission'] . " ='" . $aData['permission_value'] . "' where id='" . $aData['id'] . "' AND user_type='" . $aData['user_type'] . "' AND user_id='" . $aData['userId'] . "'  ";

            $oData = DB::select(DB::raw($query));
            return true;
        }
        return false;
    }

    public function twillo_account() {

        $aData = array();
        $this->db->select("tbl_twilio_accounts.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile");
        $this->db->where('tbl_twilio_accounts.contact_no IS NOT NULL', null, false);
        $this->db->where('tbl_twilio_accounts.user_id != ', '1');
        $this->db->join("tbl_users", "tbl_twilio_accounts.user_id = tbl_users.id", "LEFT");
        $query = $this->db->get('tbl_twilio_accounts');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }

        return $aData;
    }

    //*** model function is used to get the team members twilio accounts and response back to the controller 
    public function team_twillo_account($userid) {

        $aData = array();
        $this->db->select("tbl_users_team.*, tbl_users_team.firstname, tbl_users_team.lastname, tbl_users_team.email");
        $this->db->where('tbl_users_team.bb_number != ', ' ');
        $this->db->where('tbl_users_team.parent_user_id', $userid);
        $query = $this->db->get('tbl_users_team');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }

        return $aData;
    }

    //*** model function is used to get the Twilio number logs details and  response back to the controller 
    public function getNumberlogs($id) {

        $this->db->select("tbl_users_team.bb_number");
        $this->db->where('tbl_users_team.id', $id);
        $query = $this->db->get('tbl_users_team');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();

            $result = $this->db->query("SELECT * FROM `tbl_twilio_logs` WHERE ( `sent_from` = '" . $aData[0]->bb_number . "' or `sent_to` ='" . $aData[0]->bb_number . "' )");
            $response = $result->result();
        }

        return $response;
    }

//*** model function is used to get only client twilio number details and response back to the controller 
    public function getClientNumberlogs($id) {

        $this->db->select("tbl_twilio_accounts.contact_no");
        $this->db->where('tbl_twilio_accounts.user_id', $id);
        $query = $this->db->get('tbl_twilio_accounts');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();

            $result = $this->db->query("SELECT * FROM `tbl_twilio_logs` WHERE ( `sent_from` = '" . $aData[0]->contact_no . "' or `sent_to` ='" . $aData[0]->contact_no . "' )");
            $response = $result->result();
        }

        return $response;
    }

//*** function is used to get the Usage for single twilio number 
    public function getUsageSingleNumber($tNumber) {

        $aData = array();
        $totalPrice = array();


        $this->db->select("SUM(price) AS price");
        $this->db->where('tbl_twilio_logs.sent_from', $tNumber);
        $query = $this->db->get('tbl_twilio_logs');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
            if (!empty($aData[0]->price)) {
                $totalPrice[] = $aData[0]->price;
            }
        }


        $aData = array();


        $this->db->select("SUM(price) AS price");
        $this->db->where('tbl_twilio_logs.sent_to', $tNumber);
        $query = $this->db->get('tbl_twilio_logs');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
            if (!empty($aData[0]->price)) {
                $totalPrice[] = $aData[0]->price;
            }
        }


        return array_sum($totalPrice);
    }

    public function getUsage($teamMemArr) {

        $aData = array();
        $totalPrice = array();
        foreach ($teamMemArr as $memTeam) {

            $this->db->select("SUM(price) AS price");
            $this->db->where('tbl_twilio_logs.sent_from', $memTeam);
            $query = $this->db->get('tbl_twilio_logs');
            //echo $this->db->last_query();exit;
            if ($query->num_rows() > 0) {
                $aData = $query->result();
                if (!empty($aData[0]->price)) {
                    $totalPrice[] = $aData[0]->price;
                }
            }
        }

        $aData = array();
        foreach ($teamMemArr as $memTeam) {

            $this->db->select("SUM(price) AS price");
            $this->db->where('tbl_twilio_logs.sent_to', $memTeam);
            $query = $this->db->get('tbl_twilio_logs');
            //echo $this->db->last_query();exit;
            if ($query->num_rows() > 0) {
                $aData = $query->result();
                if (!empty($aData[0]->price)) {
                    $totalPrice[] = $aData[0]->price;
                }
            }
        }

        return array_sum($totalPrice);
    }

    public function getTeamMember($parentUserId) {

        $aData = array();
        $this->db->select("bb_number");
        $this->db->where('tbl_users_team.bb_number != ', ' ');
        $this->db->where('tbl_users_team.parent_user_id', $parentUserId);
        $query = $this->db->get('tbl_users_team');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }

        return $aData;
    }

}
