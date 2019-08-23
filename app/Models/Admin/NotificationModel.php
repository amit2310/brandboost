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
        $status = '';
        if (!empty($type)) {
            $status = ($type == 'unread') ? 0 : 1;
        }
        $aData = DB::table('tbl_notifications')
                ->leftJoin('tbl_users', 'tbl_notifications.user_id', '=', 'tbl_users.id')
                ->select('tbl_notifications.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.avatar')
                ->where('tbl_notifications.user_id', $userId)
                ->where(DB::raw("DATE(tbl_notifications.created)"), '<', "$lastWeekDate")
                ->where(DB::raw("DATE(tbl_notifications.created)"), '>=', "$dateStartFilter")
                ->when(!empty($type), function ($query) use ($status) {
                    return $query->where('tbl_notifications.status', $status);
                })
                ->orderBy('tbl_notifications.id', 'desc')
                ->get();

        return $aData;
    }


    /**
     * Used to add Notification
     * @param type $data
     * @return boolean
     */
    public static function addNotification($aData) {
        $insert_id = DB::table('tbl_notifications')->insertGetId($aData);
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }


    /**
     * Used to add cleint email notification
     * @param type $aData
     * @param type $notifyEmail
     * @param type $oUser
     * @param type $eventName
     * @param type $teamMemberName
     */
    public static function addClientEmailNotification($aData, $notifyEmail, $oUser, $eventName, $teamMemberName = "") {

        $slugData = \App\Models\Admin\SettingsModel::getSlugdetails($eventName);
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

    /**
     * Used to add admin email notification
     * @param type $aData
     * @param type $notifyEmail
     * @param type $eventName
     */
    public static function addAdminEmailNotification($aData, $notifyEmail, $eventName) {

        $slugData = \App\Models\Admin\SettingsModel::getSlugdetails($eventName);
        $oUser = \App\Models\Admin\UsersModel::getUserInfo('1');
        if ($slugData->isNotEmpty()) {
            $slugDetails = $slugData[0];
        }
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

    /**
     * Used to add email notification- This method has now been deprecated
     * @param type $aData
     * @param type $notifyEmail
     * @param type $oUser
     */
    public function addEmailNotification_old($aData, $notifyEmail, $oUser) {

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

    /**
     * Used to get the list of today notifications 
     * @param type $userId
     * @param type $type
     * @return type
     */
    public function getNotificationsToday($userId, $type = '') {

        $currentDate = date('Y-n-d');

        $oData = DB::table('tbl_notifications')
                ->leftJoin('tbl_users', 'tbl_notifications.user_id', '=', 'tbl_users.id')
                ->select('tbl_notifications.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.avatar')
                ->where('tbl_notifications.user_id', $userId)
                ->where(DB::raw("DATE(tbl_notifications.created)"), $currentDate)
                ->when(!empty($type), function ($query) use ($type) {
                    $status = ($type == 'unread') ? 0 : 1;
                    return $query->where('tbl_notifications.status', $status);
                })
                ->orderBy('tbl_notifications.id', 'desc')
                ->get();

        return $oData;
    }


    /**
     * Used to get the notification template
     * @param type $slug
     * @return type object
     */
    public function getNotificationTemplate($slug, $notyType) {

        if($notyType == 'admin') {
            $selectType = 'admin_system_content as sysMessage';
        }
        else if($notyType == 'client') {
            $selectType = 'client_system_content as sysMessage';
        }
        else if ($notyType == 'user') {
            $selectType = 'user_system_content as sysMessage';
        }

        $oData = DB::table('tbl_notifications_manager')
        ->select($selectType)
        ->where('notification_slug', $slug)
        ->first();

        return $oData;
    }



    /**
     * Used to get the list of yesterday notifications 
     * @param type $userId
     * @param type $type
     * @return type
     */
    public function getNotificationsYesterday($userId, $type = '') {

        $yesterdayDate = date('Y-n-d', strtotime('-1 days'));

        $oData = DB::table('tbl_notifications')
                ->leftJoin('tbl_users', 'tbl_notifications.user_id', '=', 'tbl_users.id')
                ->select('tbl_notifications.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.avatar')
                ->where('tbl_notifications.user_id', $userId)
                ->where(DB::raw("DATE(tbl_notifications.created)"), $yesterdayDate)
                ->when(!empty($type), function ($query) use ($type) {
                    $status = ($type == 'unread') ? 0 : 1;
                    return $query->where('tbl_notifications.status', $status);
                })
                ->orderBy('tbl_notifications.id', 'desc')
                ->get();

        return $oData;
    }

    /**
     * Used to get the list of last week notifications 
     * @param type $userId
     * @param type $type
     * @return type
     */
    public function getNotificationsLastweek($userId, $type = '') {

        $lastWeekDate = date('Y-n-d', strtotime('-7 days'));

        $oData = DB::table('tbl_notifications')
                ->leftJoin('tbl_users', 'tbl_notifications.user_id', '=', 'tbl_users.id')
                ->select('tbl_notifications.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.avatar')
                ->where('tbl_notifications.user_id', $userId)
                ->where(DB::raw("DATE(tbl_notifications.created)"), '>=', $lastWeekDate)
                ->when(!empty($type), function ($query) use ($type) {
                    $status = ($type == 'unread') ? 0 : 1;
                    return $query->where('tbl_notifications.status', $status);
                })
                ->orderBy('tbl_notifications.id', 'desc')
                ->get();

        return $oData;
    }

    /**
     * Used to mark notification as read
     * @param type $userID
     * @param type $id
     */
    public function markReadNotification($userID, $id = '') {
        if ($userID > 0) {

            $oData = DB::table('tbl_notifications')
                    ->where('user_id', $userID)
                    ->when(($id > 0), function ($query) use ($id) {
                        return $query->where('id', $id);
                    })
                    ->update(['status' => 1]);

            return $oData;
        }
    }

    /**
     * Used to delete notification
     * @param type $userID
     * @param type $notificationId
     * @return boolean
     */
    public function deleteNotification($userID, $notificationId) {
        $result = DB::table('tbl_notifications')
                ->where('user_id', $userID)
                ->where('id', $notificationId)
                ->delete();

        return true;
    }

    /**
     * Used to get filter based notifications
     * @param type $userId
     * @param type $type
     * @param type $start
     * @param type $end
     * @param type $event_type
     * @return type
     */
    public function getNotificationsFilter($userId, $type = '', $start, $end, $event_type) {

        $aData = array();

        $dateStartFilter = date('Y-n-d', strtotime($start));
        $dateEndFilter = date('Y-n-d', strtotime($end));

        $oData = DB::table('tbl_notifications')
                ->leftJoin('tbl_users', 'tbl_notifications.user_id', '=', 'tbl_users.id')
                ->select('tbl_notifications.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.avatar')
                ->where('tbl_notifications.user_id', $userId)
                ->where(DB::raw("DATE(tbl_notifications.created)"), '>=', $dateStartFilter)
                ->where(DB::raw("DATE(tbl_notifications.created)"), '<=', $dateEndFilter)
                ->when(!empty($type), function ($query) use ($type) {
                    $status = ($type == 'unread') ? 0 : 1;
                    return $query->where('tbl_notifications.status', $status);
                })
                ->orderBy('tbl_notifications.id', 'desc')
                ->get();

        return $oData;
    }

    /**
     * Used to get notification language
     * @param type $eventType
     * @return type
     */
    public function getNotificationLang($eventType) {

        $oData = DB::table('tbl_notifications_sys_templates')
                ->where('tbl_notifications_sys_templates.template_tag', $eventType)
                ->first();
        return $oData;
    }

}
