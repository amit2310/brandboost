<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class NotificationModel extends Model {
    
    /**
     * Used to get all system notification assoicated with the logged user
     * @param type $userId
     * @param type $type
     * @param type $start
     * @param type $end
     * @return type
     */
    public static function getNotifications($userId, $type = '', $start = '', $end = '') {
        $aData = array();
        $lastWeekDate = date('Y-n-d', strtotime('-7 days'));
        $dateStartFilter = date('Y-n-d', strtotime($start));
        $dateEndFilter = date('Y-n-d', strtotime($end));
        if (!empty($type)) {
            $status = ($type == 'unread') ? 0 : 1;
        }
        $aData = DB::table('tbl_notifications')
            ->leftJoin('tbl_users', 'tbl_notifications.user_id', '=' , 'tbl_users.id')
            ->select('tbl_notifications.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.avatar')
            ->where('tbl_notifications.user_id', $userId)
            ->where(DB::raw("DATE(tbl_notifications.created)"), '<', "$lastWeekDate") 
            ->where(DB::raw("DATE(tbl_notifications.created)"), '>=', "$dateStartFilter")
            ->when(!empty($type), function ($query, $status) {
                    return $query->where('tbl_notifications.status', $status);
                })    
            ->orderBy('tbl_notifications.id', 'desc')    
            ->get();
                
        return $aData;
    }

    public function addNotification($data) {
        $result = $this->db->insert("tbl_notifications", $data);
        $inset_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addClientEmailNotification($aData, $notifyEmail, $oUser, $eventName, $teamMemberName = "") {

        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "mmmUser");
        $CI->load->model("admin/Settings_model", "mSetting");
        $slugData = $CI->mSetting->getSlugdetails($eventName);
        $slugDetails = $slugData[0];
        $email = (!empty($notifyEmail)) ? $notifyEmail : $oUser->email;

        $aEmailTags = get_email_notification_tags();
        $s3_allow_size = "";
        $s3_used_size = "";
        $s3_allow_size = $oUser->s3_allow_size;
        $s3_used_size = $oUser->s3_used_size;

        $remanning_limit = "";
        $remanning_limit = ($s3_allow_size - $s3_used_size);
        $remanning_credit = "";
        $remanning_credit = $oUser->remaining_credit;




        //$aUserTags = array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}', '{LINK}');
        $aUserTags = array('{FIRST_NAME}', '{LAST_NAME}', '{limit}', '{credit}');
        $createLink = '<a href="' . $aData['link'] . '" target="_blank">Click</a>';
        $aUserTagsVal = array($oUser->firstname, $oUser->lastname, $remanning_limit, $remanning_credit);
        //$aUserTagsVal = array($oUser->firstname, $oUser->lastname, $oUser->email, $createLink);

        if (!empty($aData)) {
            $eventName = $aData['event_type'];

            if (!empty($slugDetails)) {

                if (!empty($teamMemberName)) {
                    $subject = $slugDetails->email_subject_client . ' ( Added By ) ' . $teamMemberName;
                } else {
                    $subject = $slugDetails->email_subject_client;
                }
                $content = base64_decode($slugDetails->email_content_client);
            } else {
                $subject = ucfirst(str_replace('-', ' ' . $aData['event_type']));
                $content = $aData->message;
            }


            if (!empty($content)) {
                $EmailContent = str_replace($aUserTags, $aUserTagsVal, $content);
                //Send out email now
                sendEmail($email, $EmailContent, $subject);
            }
        }
    }

    public function addAdminEmailNotification($aData, $notifyEmail, $eventName) {

        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "mmmUser");
        $CI->load->model("admin/Settings_model", "mSetting");
        $slugData = $CI->mSetting->getSlugdetails($eventName);
        $oUser = $CI->mmmUser->getUserInfo('1');
        $slugDetails = $slugData[0];
        $email = (!empty($notifyEmail)) ? $notifyEmail : $oUser->email;

        $aEmailTags = get_email_notification_tags();

        //$aUserTags = array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}', '{LINK}');
        $aUserTags = array('{FIRST_NAME}', '{LAST_NAME}');
        $createLink = '<a href="' . $aData['link'] . '" target="_blank">Click</a>';
        $aUserTagsVal = array($oUser->firstname, $oUser->lastname);
        //$aUserTagsVal = array($oUser->firstname, $oUser->lastname, $oUser->email, $createLink);

        if (!empty($aData)) {
            $eventName = $aData['event_type'];

            if (!empty($slugDetails)) {
                $subject = $slugDetails->email_subject_admin;
                $content = base64_decode($slugDetails->email_content_admin);
            } else {
                $subject = ucfirst(str_replace('-', ' ' . $aData['event_type']));
                $content = $aData->message;
            }



            if (!empty($content)) {
                $EmailContent = str_replace($aUserTags, $aUserTagsVal, $content);
                //Send out email now
                sendEmail($email, $EmailContent, $subject);
            }
        }
    }

    public function addEmailNotification_old($aData, $notifyEmail, $oUser) {

        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "mmmUser");

        $email = (!empty($notifyEmail)) ? $notifyEmail : $oUser->email;
        $phone = $oUser->mobile;

        $aEmailTags = get_email_notification_tags();

        $aUserTags = array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}', '{LINK}');
        $createLink = '<a href="' . $aData['link'] . '" target="_blank">Click</a>';
        $aUserTagsVal = array($oUser->firstname, $oUser->lastname, $oUser->email, $createLink);
        if (!empty($aData)) {
            $eventName = $aData['event_type'];
            $oNotification = $aEmailTags[$eventName];

            if (!empty($oNotification)) {

                if ($oUser->user_role == 1) {
                    $subject = $oNotification->admin_subject;
                    $content = ($oNotification->content_type == 'plain') ? base64_decode($oNotification->plain_text_admin) : base64_decode($oNotification->plain_text_admin);
                } else {
                    $subject = $oNotification->subject;
                    $content = ($oNotification->content_type == 'plain') ? base64_decode($oNotification->plain_text) : base64_decode($oNotification->plain_text);
                }
            } else {
                $subject = ucfirst(str_replace('-', ' ' . $aData['event_type']));
                $content = $aData->message;
            }

            if (!empty($content)) {
                $EmailContent = str_replace($aUserTags, $aUserTagsVal, $content);
                //Send out email now
                sendEmail($email, $EmailContent, $subject);

                if (!empty($phone) && $sendSMS == true) {
                    //Send out sms now
                    $smsContent = str_replace($aUserTags, $aUserTagsVal, base64_decode($oNotification->plain_text));
                    //sendSMS($phone, $smsContent);
                }
            }
        }
    }

    public function getNotificationsToday($userId, $type = '') {

        $currentDate = date('Y-n-d');
        $aData = array();

        $this->db->select("tbl_notifications.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.avatar");
        $this->db->where('tbl_notifications.user_id', $userId);
        if (!empty($type)) {
            if ($type == 'unread') {
                $status = 0;
            } else {
                $status = 1;
            }
            $this->db->where('tbl_notifications.status', $status);
        }

        $this->db->where('DATE(tbl_notifications.created) = ', $currentDate);
        $this->db->order_by('tbl_notifications.id', 'DESC');
        $this->db->join("tbl_users", "tbl_notifications.user_id=tbl_users.id", "LEFT");
        $query = $this->db->get('tbl_notifications');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    public function getNotificationsYesterday($userId, $type = '') {

        $yesterdayDate = date('Y-n-d', strtotime('-1 days'));

        $aData = array();

        $this->db->select("tbl_notifications.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.avatar");
        $this->db->where('tbl_notifications.user_id', $userId);
        if (!empty($type)) {
            if ($type == 'unread') {
                $status = 0;
            } else {
                $status = 1;
            }
            $this->db->where('tbl_notifications.status', $status);
        }

        $this->db->where('DATE(tbl_notifications.created) = ', $yesterdayDate);

        $this->db->order_by('tbl_notifications.id', 'DESC');
        $this->db->join("tbl_users", "tbl_notifications.user_id=tbl_users.id", "LEFT");
        $query = $this->db->get('tbl_notifications');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    public function getNotificationsLastweek($userId, $type = '') {

        $lastWeekDate = date('Y-n-d', strtotime('-7 days'));
        $aData = array();

        $this->db->select("tbl_notifications.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.avatar");
        $this->db->where('tbl_notifications.user_id', $userId);
        if (!empty($type)) {
            if ($type == 'unread') {
                $status = 0;
            } else {
                $status = 1;
            }
            $this->db->where('tbl_notifications.status', $status);
        }

        $this->db->where('DATE(tbl_notifications.created) >= ', $lastWeekDate);

        $this->db->order_by('tbl_notifications.id', 'DESC');
        $this->db->join("tbl_users", "tbl_notifications.user_id=tbl_users.id", "LEFT");
        $query = $this->db->get('tbl_notifications');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    public function markReadNotification($userID, $id = '') {
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
            if ($id > 0) {
                $this->db->where('id', $id);
            }
            $this->db->update("tbl_notifications", array('status' => 1));
        }
    }

    public function deleteNotification($userID, $notificationId) {
        $this->db->where('user_id', $userID);
        $this->db->where('id', $notificationId);
        $this->db->delete('tbl_notifications');
        return true;
    }

    public function getNotificationsFilter($userId, $type = '', $start, $end, $event_type) {

        $aData = array();

        $dateStartFilter = date('Y-n-d', strtotime($start));
        $dateEndFilter = date('Y-n-d', strtotime($end));

        $this->db->select("tbl_notifications.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.avatar");
        $this->db->where('tbl_notifications.user_id', $userId);
        if (!empty($type)) {
            if ($type == 'unread') {
                $status = 0;
            } else {
                $status = 1;
            }
            $this->db->where('tbl_notifications.status', $status);
        }

        if (!empty($event_type)) {
            $this->db->where('tbl_notifications.event_type', $event_type);
        }

        $this->db->where('DATE(tbl_notifications.created) >= ', $dateStartFilter);
        $this->db->where('DATE(tbl_notifications.created) <= ', $dateEndFilter);

        $this->db->order_by('tbl_notifications.id', 'DESC');
        $this->db->join("tbl_users", "tbl_notifications.user_id=tbl_users.id", "LEFT");
        $query = $this->db->get('tbl_notifications');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->result();
        }
        return $aData;
    }

    public function getNotificationLang($eventType) {

        $aData = array();
        $this->db->select("tbl_notifications_sys_templates.*");
        $this->db->where('tbl_notifications_sys_templates.template_tag', $eventType);
        $query = $this->db->get('tbl_notifications_sys_templates');
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $aData = $query->row();
        }
        return $aData;
    }

}
