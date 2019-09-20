<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\NotificationModel;
use Illuminate\Support\Facades\Input;
use Session;

class Notification extends Controller {


    /**
    * This is a index function
    * @param type
    * @return type
    */
    public function Index() {

        $allNotifications = array();
        $aUser = getLoggedUser();
        $Notifications = new NotificationModel();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;

        if ($userID != '') {
            $allNotifications = NotificationModel::getNotifications($userID);
            $allNotificationsToday = $Notifications->getNotificationsToday($userID);
            $allNotificationsYesterday = $Notifications->getNotificationsYesterday($userID);
            $allNotificationsLastweek = $Notifications->getNotificationsLastweek($userID);


            $aSysNotifyTags = get_notification_tags();
            if (!empty($allNotifications)) {
                //$this->Notifications->markReadNotification($userID);
            }
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="All Notifications" class="sidebar-control active hidden-xs ">All Notifications </a></li>
                    </ul>';

        $aData = array(
            'notifications_data' => $allNotifications,
            'notifications_data_today' => $allNotificationsToday,
            'notifications_data_yesterday' => $allNotificationsYesterday,
            'notifications_data_lastweek' => $allNotificationsLastweek,
            'title' => 'All Notifications',
            'pagename' => $breadcrumb,
            'aSysNotifyTags' => $aSysNotifyTags
        );

        return view('admin.notification', $aData);
    }


    /**
    * This function is use to get notification smart popup
    * @param type
    * @return type
    */
    public function getNotificationSmartPopup() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $Notifications = new NotificationModel();
        if ($userID != '') {
            $allNotifications = NotificationModel::getNotifications($userID);
            $allNotificationsToday = $Notifications->getNotificationsToday($userID);
            $allNotificationsYesterday = $Notifications->getNotificationsYesterday($userID);
            $allNotificationsLastweek = $Notifications->getNotificationsLastweek($userID);

            $aSysNotifyTags = get_notification_tags();

            if (!empty($allNotifications)) {
                //$this->Notifications->markReadNotification($userID);
            }

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="All Notifications" class="sidebar-control active hidden-xs ">All Notifications </a></li>
                    </ul>';

            $aData = array(
                'notifications_data' => $allNotifications,
                'notifications_data_today' => $allNotificationsToday,
                'notifications_data_yesterday' => $allNotificationsYesterday,
                'notifications_data_lastweek' => $allNotificationsLastweek,
                'title' => 'All Notifications',
                'pagename' => $breadcrumb,
                'aSysNotifyTags' => $aSysNotifyTags
            );

            $popupContent = view('admin.components.smart-popup.notifications', $aData)->render();
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        }
    }

    public function addnotification() {

        $data = array(
            'event_type' => $eventType,
            'event_id' => $eventID,
            'message' => $this->notificationMessages($eventType),
            'user_id' => 2,
            'status' => 1,
            'created' => date("Y-m-d H:i:s")
        );
        $addNotification = $this->Notifications->addNotification($data);
    }

    public function notificationMessages($eventType) {
        $message = '';
        switch ($eventType) {
            case 'user_registration' :
                $message = 'Your account has been created successfully.';
                break;

            case 'change_password' :
                $message = 'Your account password has been changed successfully.';
                break;

            case 'create_order' :
                $message = 'Your order has been created successfully.';
                break;
        }
        return $message;
    }


    /**
    * This function is use to mark read
    * @param type
    * @return type
    */
    public function markRead(Request $request) {
        $response = array();
        $mNotification = new NotificationModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $userRole = $aUser->user_role;
        if (empty($request->param)) {
            $response['status'] = 'error';
            echo json_encode($response);
            exit;
        }

        $param = strip_tags($request->param);
        $notificationID = strip_tags($request->notificationid);

        if ($param == 'readall') {
            $mNotification->markReadNotification($userID, $notificationID);
            $oNotifications = NotificationModel::getNotifications($userID, 'unread');
            $response['status'] = 'success';
            $response['unreadCount'] = $oNotifications->count();
        }

        echo json_encode($response);
        exit;
    }


    /**
    * This function is use to delete multipal notification
    * @param type
    * @return type
    */
    public function delete_multipal_notification(Request $request) {

        $response = array();

        $mNotification = new NotificationModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($request->multi_notification_id) {
            $multi_notification_id = $request->multi_notification_id;

            foreach ($multi_notification_id as $notificationId) {

                $result = $mNotification->deleteNotification($userID, $notificationId);
                $response['status'] = 'success';
            }
        }
        echo json_encode($response);
        exit;
    }

    public function getNotificationFilterDate(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $Notifications = new NotificationModel();
        $userID = $aUser->id;
        if ($request->start) {
            $start = $request->start;
            $end = $request->end;
            $readStatus = $request->readStatus;
            $event_type = $request->event_type;
            $allNotifications = $Notifications->getNotificationsFilter($userID, $readStatus, $start, $end, $event_type);
            $aData = array(
                'notifications_data' => $allNotifications,
                /*'notifications_data_today' => $allNotificationsToday,
                'notifications_data_yesterday' => $allNotificationsYesterday,
                'notifications_data_lastweek' => $allNotificationsLastweek,
                'title' => 'All Notifications',
                'pagename' => $breadcrumb,
                'aSysNotifyTags' => $aSysNotifyTags*/
            );

            $popupContent = view('admin.notification_filter', $aData)->render();
            $response['result'] = $popupContent;
        }

        $response['status'] = 'success';
        echo json_encode($response);
        exit;
    }


    /**
    * This function is use to get notification
    * @param type
    * @return type
    */
    public function getNotificationData(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $Notifications = new NotificationModel();
        if ($request->start) {
            $start = $request->start;
            $end = $request->end;
            //$allNotifications = $this->Notifications->getNotificationsFilter($userID, $start, $end);
            $allNotifications = NotificationModel::getNotifications($userID, $type = '', $start, $end);
            $allNotificationsToday = $Notifications->getNotificationsToday($userID);
            $allNotificationsYesterday = $Notifications->getNotificationsYesterday($userID);
            $allNotificationsLastweek = $Notifications->getNotificationsLastweek($userID);

            $aSysNotifyTags = get_notification_tags();
            if (!empty($allNotifications)) {
                //$this->Notifications->markReadNotification($userID);
            }
            $aData = array(
                'notifications_data' => $allNotifications,
                'notifications_data_today' => $allNotificationsToday,
                'notifications_data_yesterday' => $allNotificationsYesterday,
                'notifications_data_lastweek' => $allNotificationsLastweek,
                'title' => 'All Notifications',
                'aSysNotifyTags' => $aSysNotifyTags
            );

            $popupContent = view('admin.notification_filter', $aData)->render();
            $response['result'] = $popupContent;
        }

        $response['status'] = 'success';
        echo json_encode($response);
        exit;
    }

}
