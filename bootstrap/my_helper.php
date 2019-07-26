<?php

/* require 'aws/aws-autoloader.php';
  use Aws\S3\S3Client;
  use Aws\Exception\AwsException; */
require_once 'vendor/autoload.php'; // Loads the library

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

/**
 * Used to check where or not user logged in and if yes then return complete user information
 * @param type $redirect
 * @return type
 */
function getLoggedUser($redirect = true) {

    $oUser = array();

    if (Session::get('admin_user_id') > 0) {
        $userID = Session::get('admin_user_id');
    } else if (Session::get('customer_user_id') > 0) {
        $userID = Session::get('customer_user_id');
    } else if (Session::get('user_user_id') > 0) {
        $userID = Session::get('user_user_id');
    } else {
        $userID = 0;
    }


    if ($userID > 0) {
        $oUser = \App\Models\Admin\UsersModel::getUserInfo($userID);
    } else {

        Session::put('admin_redirect_url', \Request::fullUrl());
        if ($redirect == true) {
            // return redirect('/admin/login');
            die(redirect('admin/login'));
        }
    }
    return $oUser;
}

/**
 * Get logged user notifications
 */
if (!function_exists('get_notifications')) {

    function get_notifications() {
        $allNotifications = array();

        $isLoggedInAdmin = Session::get('admin_user_id');

        $isLoggedInCustomer = Session::get('customer_user_id');

        $isLoggedInUser = Session::get('user_user_id');

        if (!empty($isLoggedInAdmin)) {

            $userId = $isLoggedInAdmin;
        } else if (!empty($isLoggedInCustomer)) {

            $userId = $isLoggedInCustomer;
        } else if (!empty($isLoggedInUser)) {

            $userId = $isLoggedInUser;
        } else {
            
        }

        $allNotifications = \App\Models\Admin\NotificationModel::getNotifications($userId);

        return $allNotifications;
    }

}

/**
 * Get Notification Tags
 */
if (!function_exists('get_notification_tags')) {

    function get_notification_tags() {
        $aTags = array();
        $oTemplates = \App\Models\Admin\SettingsModel::getSystemNotificationTemplates();
        if (!empty($oTemplates)) {
            foreach ($oTemplates as $oTemplate) {
                $aTags[$oTemplate->template_tag] = $oTemplate;
            }
        }
        return $aTags;
    }

}

/**
 * Redirect to the User section if user role belongs to user(Not Admin, client or team member)
 */
if (!function_exists('userRoleAdmin')) {

    function userRoleAdmin($userRole) {
        if ($userRole == 2) {
            redirect('user/profile');
        }
    }

}

/**
 * Function is used to remove any prefix in the numbers
 */
if (!function_exists('numberForamt')) {

    function numberForamt($num) {
        $num = preg_replace('/[^0-9]/', '', $num);
        $len = strlen($num);
        if ($len == 11 && substr($num, 0, 1) == '1') {
            return substr($num, 1, 10);
        }
        return $num;
    }

}


/**
 * Authorized if client account
 */
if (!function_exists('admin_account')) {

    function admin_account() {
        $isLoggedInAdmin = Session::get('admin_user_id');
        $isLoggedInCustomer = Session::get('customer_user_id');
        $isLoggedInUser = Session::get('user_user_id');
        if ($isLoggedInAdmin) {
            return true;
        } else if ($isLoggedInCustomer) {
            return true;
        } else if ($isLoggedInUser) {
            return true;
        } else {
            Session::flash('error_message', 'You are not authenticated user');
            redirect('admin/login');
        }
    }

}

/**
 * Get Base URL
 * @return type
 */
if (!function_exists('base_url')) {

    function base_url($path = '') {
        return URL::to('/') . '/' . $path;
    }

}

/**
 * Used to display pre formatted data
 */
if (!function_exists('pre')) {

    function pre($data) {

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

}

/**
 * Authorizes page access
 */
if (!function_exists('page_auth')) {

    function page_auth() {

        $uriSegment = \Request::segment(2);

        $isLoggedInAdmin = Session::get('admin_user_id');
        $isLoggedInCustomer = Session::get('customer_user_id');
        $isLoggedInUser = Session::get('user_user_id');

        /* $admin_pages = array('profile', 'users', 'membership', 'offsite', 'invoice', 'subscriptions', 'order', 'dashboard', 'upgrades', 'email_template', 'allusertopup', 'qualifiedusertopup', 'notifications', 'brandboost', 'reviews', 'change_password', 'lists', 'automations', 'comments', 'offsitebrandboost', 'questions', 'rewards', 'feedback', 'twiliodetail', 'invoices', 'emailtemplate', 'autoresponder', 'settings', 'popupsettings', 'tracking', 'r', 'questions'); */

        /* $customer_pages = array('profile', 'users', 'dashboard', 'allusertopup', 'qualifiedusertopup', 'order', 'invoice', 'invoices', 'upgrades', 'notifications', 'brandboost', 'reviews', 'change_password', 'lists', 'automations', 'comments', 'rewards', 'feedback', 'twiliodetail', 'autoresponder', 'settings', 'r', 'questions');

          $reviewer_pages = array('profile', 'dashboard', 'reviews', 'change_password', 'notifications', 'comments', 'r'); */

        /* if (!empty($isLoggedInAdmin)) {
          if (in_array($uriSegment, $admin_pages)) {

          }
          } */
        /* if (!empty($isLoggedInCustomer)) {
          if (in_array($uriSegment, $customer_pages)) {

          } else if (in_array($uriSegment, $admin_pages)) {
          echo "Sorry, You are not authenticate for this page.";
          exit;
          } else {

          }
          }
          if (!empty($isLoggedInUser)) {
          if (in_array($uriSegment, $reviewer_pages)) {

          } else if (in_array($uriSegment, $admin_pages)) {
          echo "Sorry, You are not authenticate for this page.";
          exit;
          } else {

          }
          } */
    }

}


/**
 * Get active membership data
 */
if (!function_exists('getAllActiveMembership')) {

    function getAllActiveMembership() {
        $oMembership = \App\Models\Admin\MembershipModel::getActiveMembership();
        return $oMembership;
    }

}


/**
 * Get list of all membership levels
 */
if (!function_exists('getMembershipLevelUpgrades')) {

    function getMembershipLevelUpgrades($oData, $planID) {
        $oUpsells = \App\Models\Admin\MembershipModel::getLevelUpgrade($oData, $planID);
        return $oUpsells;
    }

}

/**
 * Get list of all annual membership levels
 */
if (!function_exists('getMembershipAnnualUpgrades')) {

    function getMembershipAnnualUpgrades($oData, $planID) {
        $oUpsells = \App\Models\Admin\MembershipModel::getAnnualUpgrade($oData, $planID);
        return $oUpsells;
    }

}

/**
 * Get global Subscriber data
 */
if (!function_exists('getAllGlobalSubscribers')) {

    function getAllGlobalSubscribers($userID) {
        $subscribersData = \App\Models\Admin\SubscriberModel::getGlobalSubscribers($userID);
        return $subscribersData;
    }

}


/**
 * Used to get Notification setting data
 */
if (!function_exists('userSetting')) {

    function userSetting($userId) {
        $oSettings = \App\Models\Admin\SettingsModel::getNotificationSettings($userId);
        return $oSettings;
    }

}


/**
 * Check member chat permissions
 */
if (!function_exists('getMemberchatpermission')) {

    function getMemberchatpermission($MemberID) {
        $teamData = \App\Models\Admin\TeamModel::Chatpermission($MemberID);
        return $teamData;
    }

}

/**
 * Get Country list
 */
if (!function_exists('getCountriesList')) {

    function getCountriesList() {
        $oCountryData = \App\Models\Admin\CountryModel::getCountriesList();
        return $oCountryData;
    }

}

/**
 * Get Twilio related account details based on the user id
 */
if (!function_exists('getTwilioAccountCustom')) {

    function getTwilioAccountCustom($userID) {
        $oTwilio = \App\Models\Admin\SubscriberModel::getTwilioAccountById($userID);
        return $oTwilio;
    }

}

/**
 * Get All member chats
 */
if (!function_exists('getMyContact')) {

    function getMyContact($userId = '', $userRole = '') {
        $oChat = \App\Models\Admin\SubscriberModel::getGlobalSubscribersChat($userId, $userRole);
        return $oChat;
    }

}

/**
 * get favorite chat list
 */
if (!function_exists('getsms_subscriber')) {

    function getsms_subscriber($userid) {
        $msgDetails = \App\Models\Admin\SmsChatModel::getSMSFavouriteByUserId($userid);
        return $msgDetails;
    }

}

/**
 * get Old chat data 
 */
if (!function_exists('activeOnlywebOldchatlist')) {

    function activeOnlywebOldchatlist($userID) {
        $oData = \App\Models\Admin\SubscriberModel::activeOnlywebOldchatlistDetails($userID);
        return $oData;
    }

}

/**
 * Get the list of waiting chat list
 */
if (!function_exists('WaitingChatlist')) {

    function WaitingChatlist($userID) {
        $oData = \App\Models\Admin\SubscriberModel::WaitingChatlistDetails($userID);
        return $oData;
    }

}

/**
 * Used to get only active support users
 */
if (!function_exists('activeOnlyweb')) {

    function activeOnlyweb($userID) {
        $oData = \App\Models\Admin\SubscriberModel::activeOnlywebDetails($userID);
        return $oData;
    }

}


/**
 * Get Team member assigned chat
 */
if (!function_exists('getTeamAssignDataHelper')) {

    function getTeamAssignDataHelper($teamId) {
        $oData = \App\Models\Admin\SubscriberModel::getTeamAssignData($teamId);
        return $oData;
    }

}

/**
 * Get Team member unassigned chat
 */
if (!function_exists('getTeamUnAssignDataHelper')) {

    function getTeamUnAssignDataHelper() {
        $oData = \App\Models\Admin\SubscriberModel::getTeamAssignData(0);
        return $oData;
    }

}


/**
 * Get Favorite Chat list
 */
if (!function_exists('getFavlist')) {

    function getFavlist($userID) {
        $oData = \App\Models\Admin\SubscriberModel::getFavlistDetails($userID);
        return $oData;
    }

}

/*
 * Get SMS actvie threads
 */
if (!function_exists('activeOnlysms')) {

    function activeOnlysms($userID) {
        $oData = \App\Models\Admin\SubscriberModel::activeOnlysmsDetails($userID);
        return $oData;
    }

}

/**
 * Get Oldest SmS thread
 */
if (!function_exists('SmsOldest')) {

    function SmsOldest($number) {
        $oData = \App\Models\Admin\SubscriberModel::SmsOldest_list($number);
        return $oData;
    }

}

/**
 * Get SMS waiting longest list
 */
if (!function_exists('SmsWaitlinglonest')) {

    function SmsWaitlinglonest($number) {
        $oData = \App\Models\Admin\SubscriberModel::SmsWaitlinglonest_list($number);
        return $oData;
    }

}

/**
 * Get Active chat popup
 */
if (!function_exists('getactiveChatbox')) {

    function getactiveChatbox($userId) {
        $oData = \App\Models\Admin\SubscriberModel::getactiveChatboxSeries($userId);
        return $oData;
    }

}

/**
 * Get one or multiple users based on user id
 */
if (!function_exists('getAllUser')) {

    function getAllUser($userId) {
        $oData = \App\Models\Admin\UsersModel::getAllUsers($userId);
        return $oData;
    }

}

/**
 * Used to get Avatar of a member
 * @param type $userImg
 * @param type $firstName
 * @param type $lastName
 * @param type $width
 * @param type $height
 * @param type $fontSize
 * @return string
 */
function showUserAvtar($userImg = '', $firstName = '', $lastName = '', $width = '', $height = '', $fontSize = '') {

    $params = '';
    if (!empty($width)) {
        $params .= ' width="' . $width . '"';
    }

    if (!empty($height)) {
        $params .= ' height="' . $height . '"';
    }

    $inlineStyle = '';

    if (!empty($params)) {
        $inlineStyle = ' style="width:' . $width . 'px!important;height:' . $height . 'px!important;line-height:' . $width . 'px;font-size:' . $fontSize . 'px;"';
        $imgClass = 'img-circle';
    } else {
        $imgClass = 'img-circle img-xs';
    }
    if ($userImg == '') {
        if (empty($firstName) && empty($lastName)) {
            $profileImage = '<span class="icons fl_letters_gray s32" ' . $inlineStyle . '>NA</span>';
        } else {
            $profileImage = '<span class="icons fl_letters s32" ' . $inlineStyle . '>' . ucfirst(substr(trim($firstName), 0, 1)) . '' . ucfirst(substr(trim($lastName), 0, 1)) . '</span>';
        }
    } else {

        $profileImage = '<span class="icons s32"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $userImg . '" onerror="this.src=\'/assets/images/default_avt.jpeg\'" class="' . $imgClass . '" alt="" ' . $params . '></span>';
    }
    return $profileImage;
}

/**
 * Get Last Chat message
 */
if (!function_exists('getLastMessage')) {

    function getLastMessage($room) {
        $oData = \App\Models\Admin\SubscriberModel::getLastMessageDetails($room);
        return $oData[0];
    }

}

/**
 * Get Support user details
 */
if (!function_exists('getSupportUser')) {

    function getSupportUser($userID) {
        $oData = \App\Models\Admin\SubscriberModel::getSupportUserDetail($userID);
        return $oData;
    }

}

/**
 * 
 */
if (!function_exists('assignto')) {

    function assignto($room) {
        $oData = \App\Models\Admin\SubscriberModel::getassignto($room);
        if (empty($oData)) {
            $oData = \App\Models\Admin\SubscriberModel::getassigntoUser($room);
        }
        if (!empty($oData)) {
            return $oData[0]->teamName;
        }
        return false;
    }

}

/**
 * Used to get User sendgrid account details
 */
if (!function_exists(('getSendgridAccount'))) {

    function getSendgridAccount($userID) {
        $oData = \App\Models\Admin\UsersModel::getSendgridAccount($userID);
        return $oData;
    }

}

if (!function_exists('getLastSms')) {

    function getLastSms($room) {
        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $subsDetails = $CI->mSubscriber->getLastSmsDetails($room);
        return $subsDetails;
    }

}

if (!function_exists('getGSubscriberInfo')) {

    function getGSubscriberInfo($id) {
        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $msgDetails = $CI->mSubscriber->getGlobalSubscriberInfo($id);
        return $msgDetails;
    }

}



if (!function_exists('make_links_clickable')) {

    /* function make_links_clickable($text){
      return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $text);
      } */

    function make_links_clickable($text) {
        $text = html_entity_decode($text);
        $text = " " . $text;
        $text = preg_replace("/(^|[\n ])([\w]*?)([\w]*?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);
        $text = preg_replace("/(^|[\n ])([\w]*?)((www|wap)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);
        $text = preg_replace("/(^|[\n ])([\w]*?)((ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"$4://$3\" >$3</a>", $text);
        $text = preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
        $text = preg_replace("/(^|[\n ])(mailto:[a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"$2@$3\">$2@$3</a>", $text);
        $text = preg_replace("/(^|[\n ])(skype:[^ \,\"\t\n\r<]*)/i", "$1<a href=\"$2\">$2</a>", $text);
        return $text;
    }

}

if (!function_exists('refillPlanBenefits')) {

    function refillPlanBenefits($userID, $planID, $qty = 0, $actiontype = '') {
        $CI = & get_instance();
        $CI->load->model("admin/Transactions_model", "mTrans");
        $bResponse = $CI->mTrans->autoRefillAccount($userID, $planID, $qty);
        return $bResponse;
    }

}


if (!function_exists('chatTimeAgo')) {

    function chatTimeAgo($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'h', 'i' => 'm', 's' => 's',);
        foreach ($string as $k => & $v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : 'just Now';
    }

}



/**
 * This function is used to update the credit usage for client account (sms/email)
 * @param type $clientID
 * @return type
 */
if (!function_exists('updateCreditUsage')) {

    function updateCreditUsage($aData = array()) {


        if (!empty($aData['client_id'])) {
            $direction = !empty($aData['direction']) ? $aData['direction'] : '';
            $oCreditVal = \App\Models\Admin\SettingsModel::getCreditValues();
            if (!empty($oCreditVal)) {
                $iEmailCredits = $iSMSOutbound = $iSMSInbound = $iMMSOutbound = $iMMSInbound = 0;
                foreach ($oCreditVal as $oCr) {

                    if ($oCr->feature_key == 'email') {
                        $iEmailCredits = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'outbound_sms') {
                        $iSMSOutbound = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'inbound_sms') {
                        $iSMSInbound = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'outbound_mms') {
                        $iMMSOutbound = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'inbound_mms') {
                        $iMMSInbound = $oCr->credit_value;
                    }
                }
            }

            $oCurrentUsage = \App\Models\Admin\SettingsModel::getCurrentUsage($aData['client_id']);
            if (!empty($oCurrentUsage)) {

                $mainCredits = $oCurrentUsage->credits;
                $topupCredits = $oCurrentUsage->credits_topup;

                $totalCredits = $mainCredits + $topupCredits;

                if ($totalCredits < 1) {
                    return false;
                }


                $totalDeduction = 0;
                $bDone = false;
                if ($totalCredits > 0) {

                    if ($aData['usage_type'] == 'email') {
                        if ($totalCredits < $iEmailCredits) {
                            return false;
                        }

                        if ($mainCredits > $iEmailCredits) {
                            $sFieldName = '`credits`';
                        } else {
                            $sFieldName = '`credits_topup`';
                        }
                        $totalDeduction = $iEmailCredits;
                        $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iEmailCredits} WHERE user_id='" . $aData['client_id'] . "'";
                    } else if ($aData['usage_type'] == 'sms') {

                        $iSMSCost = ($direction == 'inbound') ? $iSMSInbound : $iSMSOutbound;
                        if ($totalCredits < $iSMSCost) {
                            return false;
                        }

                        if ($mainCredits > $iSMSCost) {
                            $sFieldName = '`credits`';
                        } else {
                            $sFieldName = '`credits_topup`';
                        }
                        $totalDeduction = $iSMSCost;
                        $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iSMSCost} WHERE user_id='" . $aData['client_id'] . "'";
                    } else if ($aData['usage_type'] == 'mms') {
                        $iMMSCost = ($direction == 'inbound') ? $iMMSInbound : $iMMSOutbound;
                        if ($totalCredits < $iMMSCost) {
                            return false;
                        }

                        if ($mainCredits > $iMMSCost) {
                            $sFieldName = '`credits`';
                        } else {
                            $sFieldName = '`credits_topup`';
                        }
                        $totalDeduction = $iMMSCost;
                        $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iMMSCost} WHERE user_id='" . $aData['client_id'] . "'";
                    } else if ($aData['usage_type'] == 'membership upgrade') {
                        $sql = "";
                        $totalDeduction = 0;
                        $bDone = true;
                    }

                    if (!empty($sql)) {
                        $result = \App\Models\Admin\SettingsModel::runCustomQuery($sql);
                        if ($result) {
                            $bDone = true;
                        }
                    }

                    $closingBalance = ($totalCredits - $totalDeduction);

                    $aTrackingData = array(
                        'user_id' => $aData['client_id'],
                        'usage_type' => $aData['usage_type'],
                        'direction' => !empty($aData['direction']) ? $aData['direction'] : '',
                        'segment' => !empty($aData['segment']) ? $aData['segment'] : '',
                        'spend_to' => !empty($aData['spend_to']) ? $aData['spend_to'] : '',
                        'spend_from' => !empty($aData['spend_from']) ? $aData['spend_from'] : '',
                        'module_name' => !empty($aData['module_name']) ? $aData['module_name'] : '', 
                        'module_unit_id' => !empty($aData['module_unit_id']) ? $aData['module_unit_id'] : '',
                        'content' => base64_encode($aData['content']),
                        'opening_balance' => $totalCredits,
                        'balance_deducted' => $totalDeduction,
                        'closing_balance' => $closingBalance,
                        'created' => date("Y-m-d H:i:s")
                    );
                    if ($bDone == true) {
                        \App\Models\Admin\SettingsModel::saveClientUsageTracking($aTrackingData);
                    }
                    if ($result) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
            return false;
        }
        return false;
    }

}


if (!function_exists('updateCreditUsageOLD')) {

    function updateCreditUsageOLD($aData = array()) {

        $CI = & get_instance();
        $CI->load->model("admin/Settings_model", "mmSetting");
        if (!empty($aData['client_id'])) {
            $direction = $aData['direction'];
            $oCreditVal = $CI->mmSetting->getCreditValues();
            if (!empty($oCreditVal)) {
                $iEmailCredits = $iSMSOutbound = $iSMSInbound = $iMMSOutbound = $iMMSInbound = 0;
                foreach ($oCreditVal as $oCr) {

                    if ($oCr->feature_key == 'email') {
                        $iEmailCredits = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'outbound_sms') {
                        $iSMSOutbound = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'inbound_sms') {
                        $iSMSInbound = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'outbound_mms') {
                        $iMMSOutbound = $oCr->credit_value;
                    }

                    if ($oCr->feature_key == 'inbound_mms') {
                        $iMMSInbound = $oCr->credit_value;
                    }
                }
            }
            $aCurrentUsage = $CI->mmSetting->getCurrentUsage($aData['client_id']);
            if (!empty($aCurrentUsage)) {
                $aEmailBalance = $aCurrentUsage->email_balance;
                $aEmailTopupBalance = $aCurrentUsage->email_balance_topup;

                $aSmsBalanace = $aCurrentUsage->sms_balance;
                $aSmsTopupBalance = $aCurrentUsage->sms_balance_topup;

                $aMmsBalanace = $aCurrentUsage->mms_balance;
                $aMmsTopupBalance = $aCurrentUsage->mms_balance_topup;

                if ($aData['usage_type'] == 'email') {
                    if ($aEmailBalance < 1 && $aEmailTopupBalance < 1) {
                        return false;
                    }

                    if ($aEmailBalance > 0) {
                        $sFieldName = '`email_balance`';
                    } else if ($aEmailTopupBalance > 0) {
                        $sFieldName = '`email_balance_topup`';
                    }

                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iEmailCredits} WHERE user_id='" . $aData['client_id'] . "'";
                } else if ($aData['usage_type'] == 'sms') {
                    if ($aSmsBalanace < 1 && $aSmsTopupBalance < 1) {
                        return false;
                    }
                    $iSMSCost = ($direction == 'inbound') ? $iSMSInbound : $iSMSOutbound;
                    if ($aSmsBalanace > 0) {
                        $sFieldName = '`sms_balance`';
                    } else if ($aSmsTopupBalance > 0) {
                        $sFieldName = '`sms_balance_topup`';
                    }
                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iSMSCost} WHERE user_id='" . $aData['client_id'] . "'";
                } else if ($aData['usage_type'] == 'mms') {
                    if ($aMmsBalanace < 1 && $aMmsTopupBalance < 1) {
                        return false;
                    }
                    $iMMSCost = ($direction == 'inbound') ? $iMMSInbound : $iMMSOutbound;
                    if ($aMmsBalanace > 0) {
                        $sFieldName = '`mms_balance`';
                    } else if ($aMmsTopupBalance > 0) {
                        $sFieldName = '`mms_balance_topup`';
                    }
                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iMMSCost} WHERE user_id='" . $aData['client_id'] . "'";
                }
                $result = $CI->db->query($sql);
                if ($result)
                    return true;
                else
                    return false;
            }
            return false;
        }
        return false;
    }

}





/**
* Get uploaded file size
*/
if (!function_exists('getFileSize')) {

   function getFileSize($oName) {
       $oData = \App\Models\Admin\SettingsModel::getFilesizeSettings($oName);
       return $oData;
   }

}

/**
* this function is used to conver the file to bytes
*/


if (!function_exists('FileSizeConvertToBytes')) {

   function FileSizeConvertToBytes($Megabytes) {
       return $Megabytes * 1048576;
   }

}



if (!function_exists('FileSizeConvert')) {

    function FileSizeConvert($bytes) {
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach ($arBytes as $arItem) {
            if ($bytes >= $arItem["VALUE"]) {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
                break;
            }
        }
        return $result;
    }

}


/**
 * This function will return subscriber by the charName
 * @param type $userID
 * @param type $char
 * @return type
 */
if (!function_exists('bycharuser')) {

    function bycharuser($loginid, $value) {
        $oData = \App\Models\Admin\SubscriberModel::getGlobalSubscribersByChar($loginid, $value);
        return $oData;
    }

}

if (!function_exists('getMySubscribers')) {

    function getMySubscribers($userId) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $result = $CI->mSubscriber->getGlobalSubscribers($userId);
        return $result;
    }

}

/**
 * This function will return chatShortcuts used in the chat module
 * @param type $userId
 * @return type
 */
if (!function_exists('getchatshortcut')) {

    function getchatshortcut($userId) {
        $oData = \App\Models\Admin\SubscriberModel::getchatshortcutlisting($userId);
        return $oData;
    }

}




if (!function_exists('getLatestChat')) {

    function getLatestChat($userId) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $result = $CI->mSubscriber->getLatestChatView($userId);
        return $result;
    }

}
if (!function_exists('getOldestChat')) {

    function getOldestChat($userId) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $result = $CI->mSubscriber->getOldestChatView($userId);
        return $result;
    }

}

if (!function_exists('getWaitingChat')) {

    function getWaitingChat($userId) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $result = $CI->mSubscriber->getWaitingChatView($userId);
        return $result;
    }

}

if (!function_exists('getowners')) {

    function getowners($userId) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $result = $CI->mSubscriber->getownersDetails($userId);
        return $result;
    }

}


/**
 * This function will return chatUser details 
 * @param type $userId
 * @return type
 */
if (!function_exists('getSubscriberDetails')) {

    function getSubscriberDetails($userId) {
        $oData = \App\Models\Admin\SubscriberModel::getchatUser($userId);
        return $oData;
    }

}




if (!function_exists('getuserImage')) {

    function getuserImage($userId) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $result = $CI->mSubscriber->getuserImageDetails($userId);
        return $result;
    }

}


if (!function_exists('getMyChatSubscribers')) {

    function getMyChatSubscribers($currentUserID, $userMobileNo) {
        if (!empty($userMobileNo)) {
            $CI = & get_instance();  //get instance, access the CI superobject
            $CI->load->model("admin/SmsChat_model", "mSmsChat");
            $CI->load->model("admin/crons/Referral_inviter_model", "mInviterModel");
            $aTwilioAc = $CI->mInviterModel->getTwilioAccount($currentUserID);
            $result = $CI->mSmsChat->getSMSThreadsNo($aTwilioAc->contact_no, $userMobileNo);
            return $result;
        }
    }

}

if (!function_exists('random_strings')) {

    function random_strings($length_of_string) {

// String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

// Shufle the $str_result and returns substring 
// of specified length 
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

}

if (!function_exists('getAdminContact')) {

    function getAdminContact($userRole) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $result = $CI->mSubscriber->getGlobalSubscribersAdminChat($userRole);
        return $result;
    }

}




if (!function_exists('getChatRoom')) {

    function getChatRoom($room, $assign_to) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Chat_model", "mChat");
        $result = $CI->mChat->getChatRoomDetails($room, $assign_to);
        return $result;
    }

}


if (!function_exists('freeChatRoom')) {

    function freeChatRoom($room, $user_id) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Chat_model", "mChat");
        $result = $CI->mChat->freeChatRoomInit($room, $user_id);
        return $result;
    }

}



/**
 * Get All team data
 * @param type $userID
 * @return type
 */
if (!function_exists('getAllteam')) {

    function getAllteam($userID) {
        /* $CI = & get_instance();  //get instance, access the CI superobject
          $CI->load->model("admin/Team_model", "mTeam");
          $result = $CI->mTeam->getAllteamMembers($userID);
          return $result; */
        $oData = \App\Models\Admin\TeamModel::getAllteamMembers($userID);
        return $oData;
    }

}





if (!function_exists('getFavouriteUser')) {

    function getFavouriteUser($loginUserid, $incid) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/SmsChat_model", "smsChat");
        $result = $CI->smsChat->getSMSFavouriteUser($loginUserid, $incid);
        return $result;
    }

}

/**
 * This function will return fav sms user
 * @param type $loginUserid
 * @param type $number
 * @return type
 */
if (!function_exists('getFavSmsUser')) {

    function getFavSmsUser($loginUserid, $number) {
        $oData = \App\Models\Admin\SmsChatModel::getFavSmsUser($loginUserid, $number);
        return $oData;
    }

}


if (!function_exists('currentUserTwilioData')) {

    function currentUserTwilioData($currentUser) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/crons/Referral_inviter_model", "mInviter");
        $result = $CI->mInviter->getTwilioAccount($currentUser);
        return $result;
    }

}

if (!function_exists('getUnreadMsg')) {

    function getUnreadMsg($msgTo, $msgFrom, $status) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Chat_model", "hChat");
        $result = $CI->hChat->getUnreadMsg($msgTo, $msgFrom, $status);
        foreach ($result as $key => $value) {
            if (empty($value)) {
                unset($result[$key]);
            }
        }
        if (empty($playerlist)) {
            return '0';
        } else {
            return count($result);
        }
    }

}


if (!function_exists('getAllActiveMembership')) {

    function getAllActiveMembership() {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Membership_model", "hMembership");
        $aMembership = $CI->hMembership->getActiveMembership();
        return $aMembership;
    }

}

if (!function_exists('getMembershipUpsell')) {

    function getMembershipUpsell($oData, $planID) {
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("admin/Membership_model", "hMembership");
        $oUpsells = $CI->hMembership->getUpgradeUpsellSets($oData, $planID);
        return $oUpsells;
    }

}

/**
    * Get user detail by user id
    * @param type $userId
    * @return type object
    */

function getUserDetailsByUserID($userId) {
   $aUser = '';
   if ($userId > 0) {
       $aUser = $oData = \App\Models\Admin\UsersModel::getUserInfo($userId);
   }
   return $aUser;
}

if (!function_exists('user_account')) {

    function user_account() {
        $CI = & get_instance();  //get instance, access the CI superobject
        $isLoggedIn = $CI->session->userdata('user_user_id');
        if ($isLoggedIn) {
            return TRUE;
        } else {

            $CI->session->set_flashdata('authenticate', 'You are not authenticate.');
            redirect('login');
        }
    }

}

if (!function_exists('emailTemplate')) {

    function emailTemplate($subject, $body, $userDetail) {

        /** send email start * */
        $CI = & get_instance();
        $mailFrom = $CI->config->item('mailFrom');
        $siteemail = $CI->config->item('siteemail');
        $sandgriduser = $CI->config->item('sandgriduser');
        $sandgridpass = $CI->config->item('sandgridpass');
        $url = $CI->config->item('api_url');

        if ($mailFrom == 'sandgrid') {
            $user = $sandgriduser;
            $pass = $sandgridpass;
            $json_string = array(
                'to' => array($userDetail->email)
            );
            $plainText = convertHtmlToPlain($body);
            $params = array(
                'api_user' => $user,
                'api_key' => $pass,
                'x-smtpapi' => json_encode($json_string),
                'to' => $userDetail->email,
                'subject' => ($subject) ? $subject : $CI->config->item('blank_subject'),
                'html' => $body,
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
        }
    }

}


if (!function_exists('sendEmailTemplate')) {

    function sendEmailTemplate($slug, $userId, $subscriber = 0) {

        $CI = & get_instance();
        $CI->load->model("admin/Users_model", 'mmUser');
        $CI->load->model("admin/Template_model", "mmTemp");

        $aTemp = $CI->mmTemp->getTemplateBySlug($slug);
        if ($subscriber == 1) {
            $aUser = $CI->mmUser->getSubscriberInfo($userId);
        } else {
            $aUser = $CI->mmUser->getUserInfo($userId);
        }
        $aTemp = $aTemp[0];

        $template = base64_decode($aTemp->template);
        $website_name = $CI->config->item('website_name');

        $tag = ["{FIRST_NAME}", "{LAST_NAME}", "{EMAIL}", "{WEBSITE}", "{PASSWORD}"];

        $password = base64_decode($aUser->password);
        $password_hash = $CI->config->item('password_hash');
        $newPassword = explode($password_hash, $password);
        $newPass = $newPassword[0];

        $changeTo = [$aUser->firstname, $aUser->lastname, $aUser->email, $website_name, $newPass];

        $newTemp = str_replace($tag, $changeTo, $template);
        $emailDetail = array(
            'template' => $newTemp,
            'subject' => $aTemp->subject,
            'title' => $aTemp->title
        );

        /** send email start * */
        $website_name = $CI->config->item('website_name');
        $mailFrom = $CI->config->item('mailFrom');
        $siteemail = $CI->config->item('siteemail');
        $sandgriduser = $CI->config->item('sandgriduser');
        $sandgridpass = $CI->config->item('sandgridpass');
        $url = $CI->config->item('api_url');

        if ($mailFrom == 'sandgrid') {
            $user = $sandgriduser;
            $pass = $sandgridpass;
            $json_string = array(
                'to' => array($aUser->email)
            );
            $plainText = convertHtmlToPlain($newTemp);
            $params = array(
                'api_user' => $user,
                'api_key' => $pass,
                'x-smtpapi' => json_encode($json_string),
                'to' => $aUser->email,
                'subject' => ($aTemp->subject) ? $aTemp->subject : $CI->config->item('blank_subject'),
                'html' => $newTemp,
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
        }
    }

}



/**
 * Used to get notification tags
 */
if (!function_exists('get_email_notification_tags')) {

    function get_email_notification_tags() {
        $aTags = array();
        $oTemplates = \App\Models\Admin\SettingsModel::getEmailNotificationTemplates();
        if ($oTemplates->isNotEmpty()) {
            foreach ($oTemplates as $oTemplate) {
                $aTags[$oTemplate->template_tag] = $oTemplate;
            }
        }
        return $aTags;
    }

}


/**
 * Used to check permission entry
 */
if (!function_exists('checkPermissionentry')) {

    function checkPermissionentry($slug) {

        $aUser = getLoggedUser();
        $checkEntry = \App\Models\Admin\SettingsModel::checkPermissionentryDetails($aUser->id, $slug);
        if (!empty($checkEntry->id)) {
            return true;
        } else {
            return false;
        }
    }

}




/**
 * Used to add notification
 */
if (!function_exists('add_notifications')) {

    function add_notifications($aData, $eventName = '', $ownerID = '', $notifyAdminAlso = false) {

        $bSysPermission = true;
        $bEmailPermission = true;
        $bSaved = false;
        $isLoggedInTeam = '';

        if (!empty($ownerID) && !empty($eventName)) {

            
            if ($isLoggedInTeam) {
                $aTeamInfo = \App\Models\Admin\TeamModel::getTeamMember($isLoggedInTeam, $ownerID);
                $teamMemberName = $aTeamInfo->firstname . ' ' . $aTeamInfo->lastname;
            }

            $oUser = \App\Models\Admin\UsersModel::getUserInfo($ownerID);
            $AdminUser = \App\Models\Admin\UsersModel::getUserInfo('1');
            $userRole = $oUser->user_role;
            $slugData = \App\Models\Admin\SettingsModel::getSlugdetails($eventName);
            $checkEntry = \App\Models\Admin\SettingsModel::checkPermissionentryDetails($ownerID, $eventName);
            $slugDetails = $slugData[0];
            $slugDetails->client = 1;
            if ($userRole != '1') {
                $aSysPermissionData = \App\Models\Admin\SettingsModel::getNotificationSettings($ownerID);
                $Phone = (!empty($aSysPermissionData->notify_phone)) ? $aSysPermissionData->notify_phone : $oUser->mobile;
            }




//+++++++++++++ CLIENT AREA +++++++++++++++

            if ($eventName == 's3_storage_alert') {
                $bSaved = \App\Models\Admin\NotificationModel::addNotification($aData);
                $bSaved = \App\Models\Admin\NotificationModel::addClientEmailNotification($aData, $aSysPermissionData->notify_email, $oUser, $eventName, $teamMemberName);
            } else {
                if ($slugDetails->client == 1 && $slugDetails->system == 1 && $aSysPermissionData->system_notify == 1) {
                    $bSaved = \App\Models\Admin\NotificationModel::addNotification($aData);
                }

                if ($slugDetails->client == 1 && $slugDetails->email == 1 && $aSysPermissionData->email_notify == 1 && !empty($checkEntry->id)) {
                    $bSaved = \App\Models\Admin\NotificationModel::addClientEmailNotification($aData, $aSysPermissionData->notify_email, $oUser, $eventName, $teamMemberName);
                }
            }


            if ($slugDetails->client == 1 && $slugDetails->sms == 1 && $aSysPermissionData->sms_notify == 1 && !empty($checkEntry->id) && !empty($slugDetails->client_sms_content)) {
                //sendClientSMS($Phone, $slugDetails->client_sms_content, $oUser);
                $aUsage = array(
                    'client_id' => $ownerID,
                    'usage_type' => 'sms',
                    'direction' => 'outbound',
                    'content' => $slugDetails->client_sms_content,
                    'spend_to' => $Phone,
                    'spend_from' => '4695027654',
                    'module_name' => 'sms notification',
                    'module_unit_id' => ''
                );
                //updateCreditUsage($aUsage);
            }

//+++++++++++++ CLIENT AREA +++++++++++++++
//+++++++++++++ ADMIN AREA +++++++++++++++

            if ($slugDetails->admin == 1 && $slugDetails->system == 1) {
//$bSaved = $CI->mNotifications->addNotification($aData);
            }

            if ($slugDetails->admin == 1 && $slugDetails->email == 1) {

                $bSaved = \App\Models\Admin\NotificationModel::addAdminEmailNotification($aData, $AdminUser->email, $eventName);
            }

            if ($slugDetails->admin == 1 && $slugDetails->sms == 1 && !empty($slugDetails->admin_sms_content)) {

                //sendAdminSMS($AdminUser->mobile, $slugDetails->admin_sms_content);
            }

//+++++++++++++ ADMIN AREA +++++++++++++++
        }


        return true;
    }

}


/**
 * Used to send template preview Email
 */
if (!function_exists('sendEmailPreview')) {

    function sendEmailPreview($emailAddress, $messageBody, $messageSubject, $aParam = array()) {

        $userID = Session::get('current_user_id');
        $aUser = \App\Models\Admin\UsersModel::getUserInfo($userID);
        $website_name = config('bbconfig.website_name');

        $tag = ["{FIRST_NAME}", "{LAST_NAME}", "{EMAIL}", "{WEBSITE}", "{PASSWORD}"];

        $password = base64_decode($aUser->password);
        $password_hash = config('bbconfig.password_hash');
        $newPassword = explode($password_hash, $password);
        $newPass = $newPassword[0];

        $changeTo = [$aUser->firstname, $aUser->lastname, $aUser->email, $website_name, $newPass];

        $newTemp = str_replace($tag, $changeTo, $messageBody);


        //$aFooterTags = array('{{MODULENAME}}', '{{MODULEUNITID}}', '{{SUBSCRIBERID}}', '{{GLOBALSUBSCRIBERID}}');
        //$aFooterTagValues = array($moduleName, $moduleUnitID, $subscriberID, $globalSubscriberID);
        $footerSrc = getDefaultEmailFooter();
        //$emailFooter = str_replace($aFooterTags, $aFooterTagValues, $footerSrc);
        $emailFooter = $footerSrc;
        if (!empty($aParam)) {
            $fromEmail = $aParam['fromEmail'];
            $fromName = $aParam['fromName'];
            $replyEmail = $aParam['replyEmail'];
        } else {
            $fromEmail = config('bbconfig.siteemail');
            $fromName = $aParam['fromName'];
            $replyEmail = $fromEmail;
        }

        $mailFrom = config('bbconfig.mailFrom');

        $sandgriduser = config('bbconfig.sandgriduser');
        $sandgridpass = config('bbconfig.sandgridpass');
        $url = config('bbconfig.api_url');
        
        //echo "Sendgrid User ={$sandgriduser} And Sendgrid password = {$sandgridpass} and URL = {$url}";

        $fromEmail = config('bbconfig.previewFromEmailAddress') == '' ? $fromEmail : Session::get('previewFromEmailAddress');

        if ($mailFrom == 'sandgrid') {
            $user = $sandgriduser;
            $pass = $sandgridpass;
            $json_string = array(
                'to' => array($emailAddress)
            );
            $plainText = convertHtmlToPlain($newTemp . $emailFooter);
            $params = array(
                'api_user' => $user,
                'api_key' => $pass,
                'x-smtpapi' => json_encode($json_string),
                'to' => $emailAddress,
                'subject' => ($messageSubject) ? $messageSubject : config('bbconfig.blank_subject'),
                'html' => $newTemp . $emailFooter,
                'text' => $plainText,
                'from' => $fromEmail,
            );
            if (!empty($fromName)) {
                $params['fromname'] = $fromName;
            }

            if (!empty($replyEmail)) {
                $params['replyto'] = $replyEmail;
            }
            $request = $url . 'api/mail.send.json';

            $session = curl_init($request);
            curl_setopt($session, CURLOPT_POST, true);
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($session);

            curl_close($session);
        }
    }

}

/**
 * Converts Html to Plain text
 * @param type $html
 * @return type
 */
function convertHtmlToPlain($html) {
//Step-1 Remove All Images
    $plainText = preg_replace("/<img[^>]+\>/i", "\r\n", $html);
//Step-2 Remove All anchor tags
    $plainText = preg_replace("~<a[^>]*>(.*?)</a>~", "\r\n", $plainText);
//Step-3 Remove all style 
    $plainText = preg_replace("/<style\\b[^>]*>(.*?)<\\/style>/s", "\r\n", $plainText);
//Step-4 Now remove all html tags
    $plainText = htmlspecialchars(trim(strip_tags($plainText)));

    return $plainText;
}

/**
 * Used to send emails
 */
if (!function_exists('sendEmail')) {

    function sendEmail($emailAddress, $messageBody, $messageSubject) {

        $website_name = config('bbconfig.website_name');
        $mailFrom = config('bbconfig.mailFrom');
        $siteemail = config('bbconfig.siteemail');
        $sandgriduser = config('bbconfig.sandgriduser');
        $sandgridpass = config('bbconfig.sandgridpass');
        $url = config('bbconfig.api_url');
//Generate Text Version of email
        $str = 'PHPZAG PHP <a href="https://www.phpzag.com/" title="PHP">TUTORIALS</a> AND ARTICLES.';
//Remove Image
        $plainText = convertHtmlToPlain($messageBody);


        if ($mailFrom == 'sandgrid') {
            $user = $sandgriduser;
            $pass = $sandgridpass;
            $json_string = array(
                'to' => array($emailAddress)
            );
            $params = array(
                'api_user' => $user,
                'api_key' => $pass,
                'x-smtpapi' => json_encode($json_string),
                'to' => $emailAddress,
                'subject' => ($messageSubject) ? $messageSubject : config('bbconfig.blank_subject'),
                'html' => $messageBody,
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
        }
    }

}

/**
 * this function is used send message through twilio
 * @return type
 */
if (!function_exists('sendSMS')) {

    function sendSMS($to, $message) {

        $CI = & get_instance();
        $sid = $CI->config->item('sid');
        $token = $CI->config->item('token');
        $client = new Client($sid, $token);

        $res = $client->messages->create(
                $to, array(
            'from' => '4695027654',
            'body' => $message,
                )
        );
//pre($res);
    }

}


/**
 * this function is used send message through twilio
 * @return type
 */
if (!function_exists('sendClientSMS')) {

    function sendClientSMS($to, $message, $oUser) {
        $s3_allow_size = "";
        $s3_used_size = "";
        $s3_allow_size = $oUser->s3_allow_size;
        $s3_used_size = $oUser->s3_used_size;

        $remanning_limit = "";
        $remanning_limit = ($s3_allow_size - $s3_used_size);
        $remanning_credit = "";
        $remanning_credit = $oUser->remaining_credit;


        $aUserTags = array('{limit}', '{credit}');
        $aUserTagsVal = array($remanning_limit, $remanning_credit);
        $message = str_replace($aUserTags, $aUserTagsVal, $message);
        $CI = & get_instance();
        $sid = $CI->config->item('sid');
        $token = $CI->config->item('token');
        $client = new Client($sid, $token);

        $res = $client->messages->create(
                $to, array(
            'from' => '4695027654',
            'body' => $message,
                )
        );
//pre($res);
    }

}

if (!function_exists('sendAdminSMS')) {

    function sendAdminSMS($to, $message) {

        $CI = & get_instance();
        $sid = $CI->config->item('sid');
        $token = $CI->config->item('token');
        $client = new Client($sid, $token);

        $res = $client->messages->create(
                $to, array(
            'from' => '4695027654',
            'body' => $message,
                )
        );
//pre($res);
    }

}

if (!function_exists('sendClinetMMS')) {

    function sendClinetMMS($aData = array()) {
        try {
            if (!empty($aData)) {
                $sid = $aData['sid'];
                $token = $aData['token'];
                $toNum = $aData['to'];
                $fromNum = $aData['from'];
                $msg = $aData['msg'];
                $client = new Client($sid, $token);
                $aRequest = array('from' => $fromNum, 'mediaUrl' => $msg);
                
                if ($toNum != '' && $msg != '') {
//echo 'testing data';
                    $res = $client->messages->create($toNum, $aRequest);
//pre($res);
                    return 1;
                } else {
                    return false;
                }
            }
        } catch (Exception $ex) {
//echo 'Message: ' .$ex->getMessage();
            return false;
        }

        return false;
    }

}




/**
 * This function will send sms through twilio API
 * @return type
 */
if (!function_exists('sendClinetSMS')) {

    function sendClinetSMS($aData = array()) {
        try {
            if (!empty($aData)) {
                $sid = $aData['sid'];
                $token = $aData['token'];
                $toNum = $aData['to'];
                $fromNum = $aData['from'];
                $msg = $aData['msg'];
                $charCount = strlen($msg);
                $client = new Client($sid, $token);
                $aRequest = array('from' => $fromNum, 'body' => $msg);

                if ($toNum != '' && $msg != '') {

                    if ($charCount > 500) {
                        $chunks = explode("||||", wordwrap($msg, 500, "||||", false));

                        $total = count($chunks);

                        foreach ($chunks as $page => $chunk) {
                            $res = $client->messages->create(
                                    $toNum, array(
                                'from' => $fromNum,
                                'body' => $chunk
                                    )
                            );
                        }
                    } else {

                        $res = $client->messages->create($toNum, $aRequest);
                        //$res->sid;
                    }

                    return 1;
                } else {
                    return 0;
                }
            }
        } catch (Exception $ex) {
            return 0;
        }

        return 0;
    }

}

if (!function_exists('createTwilioSA')) {

    function createTwilioSA($userID, $name) {
        $CI = & get_instance();
        $sid = $CI->config->item('sid');
        $token = $CI->config->item('token');
        $client = new Client($sid, $token);

        $account = $client->api->accounts->create(array(
            'FriendlyName' => $name
        ));

        $returnData = array('sid' => $account->sid, 'authToken' => $account->authToken);

        return json_encode($returnData);
        exit;
    }

}

if (!function_exists('getTwilioPNByAreaCodeTeam')) {


    function getTwilioPNByAreaCodeTeam($contryName = '', $areacode) {
        $aUser = getLoggedUser();
        $TwilioData = currentUserTwilioData($aUser->id);

        $contryName = $contryName == '' ? 'US' : strtoupper($contryName);
//$areacode = $areacode == '' ? 510 : $areacode;
        if (!empty($areacode)) {

            $sid = $TwilioData->account_sid;
            $token = $TwilioData->account_token;
            $client = new Client($sid, $token);

            $numbers = $client->availablePhoneNumbers($contryName)->local->read(
                    array("areaCode" => $areacode)
            );

            $returnData = array();
            if (count($numbers) > 0) {
                $returnData['status'] = 'success';
                $options = '';
                $cnt = 0;
                foreach ($numbers as $key => $numberData) {
                    if ($key < 10) {
//$options .= '<div class="radio"><label><div class="choice"><span class=""><input id="twilioMobileNo" name="twilioMobileNo" type="radio" class="styled" value="'.$numberData->phoneNumber.'"></span></div>' . $numberData->phoneNumber.'</label></div>';
                        $options .= '<div class="radio"><input id="twilioMobileNo" name="twilioMobileNo" type="radio" value="' . $numberData->phoneNumber . '"><label>' . $numberData->phoneNumber . '</label></div>';
                        $cnt++;
                    }
                }


                echo $options;
            } else {
                echo 'Numbers not found';
            }
        } else {

            echo 'Please enter area code';
        }


        exit;
    }

}


if (!function_exists('getTwilioPNByAreaCode')) {

    function getTwilioPNByAreaCode($contryName = '', $areacode = '') {
        $contryName = $contryName == '' ? 'US' : strtoupper($contryName);
        $areacode = $areacode == '' ? 510 : $areacode;
        $sid = $this->config->item('sid');
        $token = $this->config->item('token');
        $client = new Client($sid, $token);

        $numbers = $client->availablePhoneNumbers($contryName)->local->read(
                array("areaCode" => $areacode)
        );

        $returnData = array();
        if (count($numbers) > 0) {
            $returnData['status'] = 'success';
            $options = '';
            foreach ($numbers as $key => $numberData) {
                if ($key < 10) {
//$options .= '<div class="radio"><label><div class="choice"><span class=""><input id="twilioMobileNo" name="twilioMobileNo" type="radio" class="styled" value="'.$numberData->phoneNumber.'"></span></div>' . $numberData->phoneNumber.'</label></div>';
                    $options .= '<div class="radio"><input id="twilioMobileNo" name="twilioMobileNo" type="radio" value="' . $numberData->phoneNumber . '"><label>' . $numberData->phoneNumber . '</label></div>';
                }
            }
            $returnData['optionData'] = $options;
        }

        return json_encode($returnData);
        exit;
    }

}


if (!function_exists('createTwilioCNTeam')) {

    function createTwilioCNTeam($phoneNumber) {
        $aUser = getLoggedUser();
        $TwilioData = currentUserTwilioData($aUser->id);

        $sid = $TwilioData->account_sid;
        $token = $TwilioData->account_token;

        $client = new Client($sid, $token);

// Purchase the first number on the list.
        $number = $client->incomingPhoneNumbers->create(
                array(
                    "phoneNumber" => $phoneNumber,
                    "smsUrl" => "http://brandboost.io/trck/trkTwillio.php"
                )
        );

        $response = array();
        if ($number->sid != '') {
            $response = array('status' => 'success', 'contact_sid' => $number->sid);
        }
        return $response;
        exit;
    }

}



if (!function_exists('createTwilioCN')) {

    function createTwilioCN($phoneNumber, $accountSid, $accountToken) {


        $client = new Client($accountSid, $accountToken);

// Purchase the first number on the list.
        $number = $client->incomingPhoneNumbers->create(
                array(
                    "phoneNumber" => $phoneNumber
                )
        );

        $response = array();
        if ($number->sid != '') {
            $response = array('status' => 'success', 'contact_sid' => $number->sid);
        }
        return json_encode($response);
        exit;
    }

}

if (!function_exists('updateTwilioStatus')) {

    function updateTwilioStatus($accountSid, $status) {

        $sid = $this->config->item('sid');
        $token = $this->config->item('token');
        $client = new Client($sid, $token);

        $account = $client->api->accounts($accountSid)->update(
                array('status' => $status)
        );

        $response = array();

        if ($account->sid != '') {
            $response = array('status' => 'success');
        }

        return json_encode($response);
        exit;
    }

}

if (!function_exists('updateSMSUrl')) {

    function updateSMSUrl($sid, $token, $contactSid) {

        $client = new Client($sid, $token);

        $responseTwilio = $client->incomingPhoneNumbers($contactSid)->update(
                array(
                    "smsUrl" => "http://brandboost.io/sms"
                )
        );

        $response = array('status' => 'success');

        return json_encode($response);
        exit;
    }

}

if (!function_exists('createSendGridSubAccount')) {

    function createSendGridSubAccount($username, $email, $password, $ip) {

        $params = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'ips' => array($ip)
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/subusers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer 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",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

}

if (!function_exists('updateSendgridNotificationSettings')) {

    function updateSendgridNotificationSettings($username) {
        $params = array(
            'enabled' => true,
            'url' => base_url() . 'trck/trkSendgrid.php',
            'group_resubscribe' => true,
            'delivered' => true,
            'group_unsubscribe' => true,
            'spam_report' => true,
            'bounce' => true,
            'deferred' => true,
            'unsubscribe' => true,
            'processed' => true,
            'open' => true,
            'click' => true,
            'dropped' => true
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/user/webhooks/event/settings",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer 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",
                "on-behalf-of: $username",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}



if (!function_exists('createWhitelabelLink')) {

    function createWhitelabelLink() {

        $params = array(
            'domain' => 'brandboost.io',
            'subdomain' => 'smpt',
            'default' => true
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/whitelabel/links",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer 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",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        pre($response);
        curl_close($curl);

//return $response;
    }

}

if (!function_exists('getSendGridUserData')) {

    function getSendGridUserData() {
        $CI = & get_instance();

        $sandgriduser = $CI->config->item('sandgriduser');
        $sandgridpass = $CI->config->item('sandgridpass');
        $url = $CI->config->item('api_url');

        $user = $sandgriduser;
        $pass = $sandgridpass;

        $params = array(
            'api_user' => $user,
            'api_key' => $pass,
            'task' => 'get'
        );

        $request = $url . 'apiv2/customer.profile.json';

        $session = curl_init($request);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($session);
        pre($response);
        curl_close($session);
    }

}

/**
 * Used to send Email through Sendgrid
 */
if (!function_exists('sendClientEmail')) {

    function sendClientEmail($aData = array()) {
        if (!empty($aData)) {
            $username = $aData['username'];
            $password = $aData['password'];
            $emailAddress = $aData['email'];
            $messageBody = $aData['message'];
            $messageSubject = $aData['subject'];
            $from = (!empty($aData['from_email'])) ? $aData['from_email'] : '';
            $fromName = (!empty($aData['from_name'])) ? $aData['from_name'] : ''; 

            $siteemail = config('bbconfig.siteemail');

            $siteemail = (empty($from)) ? $siteemail : $from;
            $url = config('bbconfig.api_url');

            $json_string = array(
                'to' => array($emailAddress)
            );
            //$plainText = convertHtmlToPlain($messageBody);
            $plainText = '';
            $params = array(
                'api_user' => $username,
                'api_key' => $password,
                'x-smtpapi' => json_encode($json_string),
                'to' => $emailAddress,
                'subject' => ($messageSubject) ? $messageSubject : config('bbconfig.blank_subject'),
                'html' => $messageBody,
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

//pre($response);
            return $response;
        }
    }

}


if (!function_exists('getCampaignReviews')) {

    function getCampaignReviews($userID = '') {
        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Brandboost_model", "hMBrandboost");
        $aData = $CI->hMBrandboost->getBrandboostByUserId($userID, 'onsite');
        return $aData;
    }

}



if (!function_exists('latestReview')) {

    function latestReview($userID = '') {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("Reviews_model", "rReviews");
        $aData = $CI->rReviews->latestReviews($userID);
        return $aData;
    }

}


if (!function_exists('getUserAllDataValue')) {

    function getUserAllDataValue($currentUserID) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "rUser");
        $userDataArray = $CI->rUser->getUserAllData($currentUserID);
        return $userDataArray;
    }

}

/**
 * Used to set the limit for string 
 * @param type $string
 * @param type $cLimit
 * @return type
 */
if (!function_exists('setStringLimit')) {

    function setStringLimit($string, $cLimit = '') {
        $cLimit = $cLimit == '' ? 35 : $cLimit;

        $post = substr($string, 0, $cLimit);
        $dotVal = '';
        if (strlen($string) >= $cLimit) {
            $dotVal = '...';
        }
        return $post . $dotVal;
    }

}

if (!function_exists('notifictionCaregory')) {

    function notifictionCaregory($categry) {
        $returnCategory = '';
        switch ($categry) {

            case 'added_text_comment':
                $returnCategory = 'Comment Added';
                break;

            case 'added_text_review':
                $returnCategory = 'Text Review Added';
                break;

            case 'added_video_review':
                $returnCategory = 'Video Review Added';
                break;

            case 'change_password':
                $returnCategory = 'Password Change';
                break;

            case 'create_order':
                $returnCategory = 'Order Created';
                break;

            case 'post_payment_account_setup_errors':
                $returnCategory = 'Payment Error';
                break;

            case 'upgrade-membership':
                $returnCategory = 'Membership Upgrade';
                break;

            case 'user_registration':
                $returnCategory = 'New User Registered';
                break;
        }

        return $returnCategory;
    }

}

function timeAgo($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function timeAgoNotification($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'y',
        'm' => 'm',
        'w' => 'w',
        'd' => 'd',
        'h' => 'h',
        'i' => 'm',
        's' => 's',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . '' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

/**
 * Used to Formatting the Mobile number
 * @param type $mobileNo
 * @return type
 */
function phoneNoFormat($mobileNo) {
    if ($mobileNo != '') {
        if (strlen($mobileNo) == 13) {
            $mobileNo = sprintf("(%s)-%s-%s", substr($mobileNo, 3, 3), substr($mobileNo, 6, 3), substr($mobileNo, 9));
        } else if (strlen($mobileNo) == 12) {
            $mobileNo = sprintf("(%s)-%s-%s", substr($mobileNo, 2, 3), substr($mobileNo, 5, 3), substr($mobileNo, 8));
        } else {
            $mobileNo = sprintf("(%s)-%s-%s", substr($mobileNo, 0, 3), substr($mobileNo, 3, 3), substr($mobileNo, 6));
        }
    }
    return $mobileNo;
}

function checkSiteCategory($dataArray, $categoryName) {
    foreach ($dataArray as $data) {
        $categoriesData = unserialize($data->site_categories);
        if (in_array($categoryName, $categoriesData)) {
            return 'yes';
        } else {
            return 'no';
        }
    }
}

if (!function_exists('getCharUserList')) {

    function getCharUserList($char, $value) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "rUser");
        $userDataArray = $CI->rUser->getCharUserList($char, $value);
        return $userDataArray;
    }

}








if (!function_exists('webchatUsers')) {

    function webchatUsers($userID) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $subscribersData = $CI->mSubscriber->webchatUsersDetails($userID);
        return $subscribersData;
    }

}



/**
 * This function will return Twilio related account details based on the Phone number
 * @param type $contactNo
 * @return type
 */
if (!function_exists('getTwilioAccount')) {

    function getTwilioAccount($contactNo) {
        $oData = \App\Models\Admin\SubscriberModel::getTwilioAccount($contactNo);
        return $oData;
    }

}


/**
 * This function will return Client Twilio account details
 * @param type $currentUserid
 * @return type
 */
if (!function_exists('getClientTwilioAccount')) {

    function getClientTwilioAccount($currentUserid) {
        $oData = \App\Models\Admin\SubscriberModel::getClientTwilioAccountDetails($currentUserid);
        return $oData->contact_no;
    }

}


/**
 * This function will return Team member Twilio account details
 * @param type $currentUserid
 * @return type
 */
if (!function_exists('getTeamTwilioAccount')) {

    function getTeamTwilioAccount($currentUserid) {
        $oData = \App\Models\Admin\SubscriberModel::getTeamTwilioAccountDetails($currentUserid);
        return $oData;
    }

}



     /**
     * this function is used get the room details
     * @return type
     */

if (!function_exists('getTeamByroom')) {

    function getTeamByroom($room) {
        
        $oData = \App\Models\Admin\WebChatModel::getTeamByroomDetails($room);
        if(!empty($oData))
        {
            $userval = $oData[0]->userval;
        }
        else
        {
          $userval = "";
        }
        return $userval;
    }

}

if (!function_exists('getTeamMemberById')) {

    function getTeamMemberById($TeamId) {
        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $subscribersData = $CI->mSubscriber->getTeamMemberById($TeamId);
        return $subscribersData[0];
    }

}


if (!function_exists('getteam_member')) {

    function getteam_member($usrid) {
        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $subscribersData = $CI->mSubscriber->getteam_member_name($usrid);
        return $subscribersData[0]->teamName;
    }

}


/**
 * This function will return Team Member name by the Phone number
 * @param type $usrid
 * @return type
 */
if (!function_exists('smsteam_member_name')) {

    function smsteam_member_name($usrid) {
        $oData = \App\Models\Admin\SubscriberModel::get_sms_team_member_name($userID);
        if(!empty($oData)) {
            return $oData[0]->teamName;
        }
        else {
            return '';
        }
        
    }

}

/**
 * Get last chat message
 * @param type $token
 * @return type
 */
if (!function_exists('getlastChatMessage')) {

    function getlastChatMessage($token) {

        $oData = \App\Models\Admin\SubscriberModel::getlastChatMessageDetail($token);
        return $oData;
    }

}



/**
 * prepare list after search
 * @param type $userID
 * @param type $inputval
 * @return type
 */

if (!function_exists('smallwfilterInput')) {

    function smallwfilterInput($userID, $inputval) {
      
        $oData = \App\Models\Admin\WebChatModel::smallwfilterModel($userID, $inputval);
        return $oData;
        
    }

}



/**
 * this function is used to filter the sms list based on the input provided in sms chat
 * @param type $Number
 * @param type $inputval
 * @return type
 */
if (!function_exists('searchSmsByinput')) {

    function searchSmsByinput($Number, $inputval) {

        $oData = \App\Models\Admin\SubscriberModel::searchSmsByinputDetails($Number, $inputval);
        return $oData;
    }

}




/**
 * Get subscriber by user id
 * @param type $userID
 * @return type object
 */
if (!function_exists('getincIdByuserId')) {

    function getincIdByuserId($userID) {
        $oData = \App\Models\Admin\SubscriberModel::getincIdByuserIdval($userID);
        return $oData;
    }

}

/**
 * This function will only Client/User id by the phone number
 * @param type $number
 * @return type
 */
if (!function_exists('getincIdByPhone')) {

    function getincIdByPhone($number) {
        $oData = \App\Models\Admin\SubscriberModel::getincIdByPhoneval($number);
        return $oData;
    }

}

function phone_display_custom_helper($num) {
    $num = preg_replace('/[^0-9]/', '', $num);

    $len = strlen($num);
    if ($len == 11 && substr($num, 0, 1) == '1') {
        return substr($num, 1, 10);
    }
    return $num;
}

/**
 * This function will return Client/User details by the Phone number
 * @param type $Number
 * @return type
 */
if (!function_exists('getUserbyPhone')) {

    function getUserbyPhone($Number) {
        $oData = \App\Models\Admin\SubscriberModel::getUserbyPhoneDetails($Number);
        return $oData;
    }

}

if (!function_exists('smschatUsers')) {

    function smschatUsers($number) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $subscribersData = $CI->mSubscriber->smschatUsersDetails($number);
        return $subscribersData;
    }

}


/**
 * This function will return Subscribers Information
 * @param type $userID
 * @return type
 */
if (!function_exists('getSubscribersInfo')) {

    function getSubscribersInfo($userID) {

        $oData = \App\Models\Admin\SubscriberModel::getSubscribersInfoDetails($userID);
        return $oData;
    }

}


if (!function_exists('getSubscribersInfoByPhone')) {

    function getSubscribersInfoByPhone($phoneNumber) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Subscriber_model", "mSubscriber");
        $subscribersData = $CI->mSubscriber->SubscribersInfoByPhone($phoneNumber);
        return $subscribersData;
    }

}

if (!function_exists('getVisitorUser')) {

    function getVisitorUser($userId) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Chat_model", "rChat");
        $visDataArray = $CI->rChat->getVisitorUser($userId);
        return $visDataArray;
    }

}

function db_in($string) {
    return addslashes(html_entity_decode(trim($string), ENT_QUOTES));
}

function db_out($string) {
    return stripslashes(htmlentities(trim($string), ENT_QUOTES));
}

if (!function_exists('getIP')) {

    function getIP() {

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

}


if (!function_exists('getBrowserN')) {

    function getBrowserN() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

//First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

// Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

// finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
// we have no matching number just continue
        }

// see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
//we will have two since we are not using 'other' argument yet
//see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

// check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );
    }

}


if (!function_exists('ratingView')) {

    function ratingView($rating) {

        if ($rating >= 4) {
            $smilyImage = '<div class="media-left media-middle"> <img src="' . base_url('assets/images/smiley_green.png') . '" class="img-circle" width="26" alt=""> </div><div class="media-left"><div class=""><span class="text-default text-semibold">' . number_format($rating, 1) . '</span> </div><div class="text-muted text-size-small">Positive</div></div>';
        } else if ($rating == 3) {
            $smilyImage = '<div class="media-left media-middle"> <img src="' . base_url('assets/images/smiley_grey2.png') . '" class="img-circle" width="26" alt=""> </div><div class="media-left"><div class=""><span class="text-default text-semibold">' . number_format($rating, 1) . '</span> </div><div class="text-muted text-size-small">Neutral</div></div>';
        } else if ($rating < 1) {
//$smilyImage = '<div class="media-middle" style="padding-left:18px;"><span class="text-muted text-size-small">'.displayNoData().'</span></div>';
            $smilyImage = displayNoData(true);
        } else {
            $smilyImage = '<div class="media-left media-middle"> <img src="' . base_url('assets/images/smiley_red.png') . '" class="img-circle" width="26" alt=""> </div><div class="media-left"><div class=""><span class="text-default text-semibold">' . number_format($rating, 1) . '</span> </div><div class="text-muted text-size-small">Negative</div></div>';
        }

        return $smilyImage;
    }

}

if (!function_exists('smilyRating')) {

    function smilyRating($rating) {

        if ($rating >= 4) {
            $smilyImage = base_url('assets/images/smiley_green.png');
        } else if ($rating == 3) {
            $smilyImage = base_url('assets/images/smiley_grey2.png');
        } else {
            $smilyImage = base_url('assets/images/smiley_red.png');
        }

        return $smilyImage;
    }

}

function base64_url_encode($input) {
    $salt = 'flyingmonkeys@';
    $string = $input . $salt;
    return strtr(base64_encode($string), '+/=', '-_ ');
}

function base64_url_decode($input) {
    $salt = 'flyingmonkeys@';
    $string = base64_decode(strtr($input, '-_ ', '+/='));
    $outputString = str_replace($salt, "", $string);
    return $outputString;
}

function getDefaultEmailFooter() {
//$src = '<hr><br<br><div style="width:100%;">This email is sent from <a href="'.base_url().'">Brandboost Community</a>. You can also change email settings or <a href="'.base_url().'/preferences/unsubscribe?m={{MODULENAME}}&mid={{MODULEUNITID}}&sid={{SUBSCRIBERID}}&gid={{GLOBALSUBSCRIBERID}}">Click here</a> to unsubscribe</div>';
    $src = '<hr><br<br><div style="width:100%;">This email is sent from <a href="' . base_url() . '">Brandboost Community</a>. You can also change email settings or <a href="' . base_url() . 'preferences/unsubscribe?gid={{GLOBALSUBSCRIBERID}}">Click here</a> to unsubscribe</div>';
    return $src;
}

function mobileNoFormat($mobileNo) {
    if (!isset($mobileNo{3})) {
        return '';
    }
// note: strip out everything but numbers 
    $mobileNo = preg_replace("/[^0-9]/", "", $mobileNo);
    $length = strlen($mobileNo);
    switch ($length) {
        case 7:
            return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $mobileNo);
            break;
        case 10:
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $mobileNo);
            break;
        case 11:
            return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "($2) $3-$4", $mobileNo);
            break;
        case 12:
            return preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})/", "($2) $3-$4", $mobileNo);
            break;
        default:
            return $mobileNo;
            break;
    }
}

function dataFormat($dataValue = '') {
    $timeStamp = (!empty($dataValue)) ? strtotime($dataValue) : time();
//$gmt_date = strtotime(gmdate('Y-m-d H:i:s', $timeStamp));
    $estTime = date("F dS Y", ($timeStamp - 14400));
    return $estTime;
}

function usaDate($dataValue = '') {
    $timeStamp = (!empty($dataValue)) ? strtotime($dataValue) : time();
//$gmt_date = strtotime(gmdate('Y-m-d H:i:s', $timeStamp));

    $estTime = date("Y-m-d H:i:s", ($timeStamp - 14400));

    $istTime = date("Y-m-d H:i:s", ($timeStamp + 19800));

    if ($_SERVER["REMOTE_ADDR"] == "14.141.174.122" || $_SERVER["REMOTE_ADDR"] == '36.255.132.146' || $_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
        $timeString = $istTime;
    } else {
        $timeString = $estTime;
    }

    return $timeString;
}

function dataFormatHours($dataValue = '') {
    $timeStamp = (!empty($dataValue)) ? strtotime($dataValue) : time();
//$gmt_date = strtotime(gmdate('Y-m-d H:i:s', $timeStamp));
    $estTime = date("h:i A", ($timeStamp - 14400));
    return $estTime;
}

function dataFormat_old($dataValue = '') {
    if ($dataValue == '') {
        return date('F dS Y');
    } else {
        return date('F dS Y', strtotime($dataValue));
    }
}

function getPlatformImg($platformName) {
    $platformImg = '';
    if ($platformName == 'linux') {
//$platformImg = '<img src="'.base_url().'assets/images/linux.png" alt="Linux" title="Linux" width="40">';
        $platformImg = '<i class="fa fa-linux txt_dark"></i>';
    } else if ($platformName == 'windows') {
//$platformImg = '<img src="'.base_url().'assets/images/window.png" alt="Window" title="Window" width="40">';
        $platformImg = '<i class="icon-windows txt_blue_sky2"></i>';
    } else if ($platformName == 'mac') {
//$platformImg = '<img src="'.base_url().'assets/images/mac.png" alt="Mac" title="Mac" width="40">';
        $platformImg = '<i class="icon-apple2"></i>';
    } else {
        $platformImg = $platformName;
    }
    return $platformImg;
}

function getBrowserImg($browserName) {
    $browserImg = '';
    if ($browserName == 'Mozilla Firefox') {
//$browserImg = '<img src="'.base_url().'assets/images/ff.png" alt="Mozilla Firefox" title="Mozilla Firefox" width="30">';
        $browserImg = '<i class="icon-firefox txt_orange"></i>';
    } else if ($browserName == 'Google Chrome') {
//$browserImg = '<img src="'.base_url().'assets/images/chrome.png" alt="Google Chrome" title="Google Chrome" width="30">';
        $browserImg = '<i class="icon-chrome txt_red"></i>';
    } else if ($browserName == 'Safari' || $browserName == 'Apple Safari') {
//$browserImg = '<img src="'.base_url().'assets/images/safari.png" alt="Safari" title="Safari" width="30">';
        $browserImg = '<i class="icon-safari txt_dark"></i>';
    } else if ($browserName == 'Opera') {
        $browserImg = '<img src="' . base_url() . 'assets/images/opera.png" alt="Opera" title="Opera" width="30">';
    } else if ($browserName == 'IE') {
//$browserImg = '<img src="'.base_url().'assets/images/ie.png" alt="IE" title="Internet Explorer" width="30">';
        $browserImg = '<i class="fa fa-internet-explorer txt_blue_sky2"></i>';
    } else {
        $browserImg = $browserName;
    }
    return $browserImg;
}

function getRemoteFileSize($file_url) {
    $head = array_change_key_case(get_headers($file_url, 1));
// content-length of download (in bytes), read from Content-Length: field

    $clen = isset($head['content-length']) ? $head['content-length'] : 0;

// cannot retrieve file size, return "-1"
    if (!$clen) {
        return -1;
    }

    $size = $clen;
    switch ($clen) {
        case $clen < 1024:
            $size = $clen . ' B';
            break;
        case $clen < 1048576:
            $size = round($clen / 1024, 2) . ' KB';
            break;
        case $clen < 1073741824:
            $size = round($clen / 1048576, 2) . ' MB';
            break;
        case $clen < 1099511627776:
            $size = round($clen / 1073741824, 2) . ' GB';
            break;
    }

    return $size;
// return formatted size
}

function displayNoData($avatar = false) {
    if ($avatar == true) {
        $html = '<div class="media-left media-middle"> ' . showUserAvtar() . ' </div><div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
    } else {
        $html = '<span class="text-muted text-size-small">[No Data]</span>';
    }
    return $html;
}

function code_to_country($code) {

    $code = strtoupper($code);

    $countryList = array(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas the',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island (Bouvetoya)',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
        'VG' => 'British Virgin Islands',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros the',
        'CD' => 'Congo',
        'CG' => 'Congo the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote d\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FO' => 'Faroe Islands',
        'FK' => 'Falkland Islands (Malvinas)',
        'FJ' => 'Fiji the Fiji Islands',
        'FI' => 'Finland',
        'FR' => 'France, French Republic',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia the',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyz Republic',
        'LA' => 'Lao',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'AN' => 'Netherlands Antilles',
        'NL' => 'Netherlands the',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn Islands',
        'PL' => 'Poland',
        'PT' => 'Portugal, Portuguese Republic',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia (Slovak Republic)',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia, Somali Republic',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard & Jan Mayen Islands',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland, Swiss Confederation',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States of America',
        'UM' => 'United States Minor Outlying Islands',
        'VI' => 'United States Virgin Islands',
        'UY' => 'Uruguay, Eastern Republic of',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    );

    if (!$countryList[$code])
        return $code;
    else
        return $countryList[$code];
}

function showUserIcon($eventType) {

    if ($eventType == 'added_any_comment') {
        $icon = 'img_36.png';
    } else if ($eventType == 'added_onsite_questions') {
        $icon = 'message_36.png';
    } else if ($eventType == 'added_offsite_brandboost') {
        $icon = 'message_36.png';
    } else if ($eventType == 'added__review') {
        $icon = 'img_36.png';
    } else if ($eventType == 'offsite_happy_feedback') {
        $icon = 'clock_36.png';
    } else if ($eventType == 'offsite_resolution_feedback') {
        $icon = 'clock_36.png';
    } else if ($eventType == 'added_onsite_answers_subscriber') {
        $icon = 'message_36.png';
    } else if ($eventType == 'added_any_review') {
        $icon = 'img_36.png';
    } else if ($eventType == 'added_text_review') {
        $icon = 'message2_36.png';
    } else if ($eventType == 'upgrade-membership') {
        $icon = 'clock_36.png';
    } else if ($eventType == 'negative_review') {
        $icon = 'img_36.png';
    } else if ($eventType == 'added_text_comment') {
        $icon = 'img_36.png';
    } else if ($eventType == 'resolution_feedback') {
        $icon = 'message_36.png';
    } else if ($eventType == 'add_onsite_brandboost') {
        $icon = 'message_36.png';
    } else if ($eventType == 'add_chat') {
        $icon = 'img_36.png';
    } else if ($eventType == 'new_sale') {
        $icon = 'clock_36.png';
    } else if ($eventType == 'buy-addons-credit-pack') {
        $icon = 'clock_36.png';
    } else if ($eventType == 'added_onsite_questions_subscriber') {
        $icon = 'message_36.png';
    } else if ($eventType == 'upgrade-topup-membership') {
        $icon = 'clock_36.png';
    } else if ($eventType == 'add_offsite_brandboost') {
        $icon = 'message_36.png';
    } else if ($eventType == 'add_nps') {
        $icon = 'message_36.png';
    } else if ($eventType == 'add_referral') {
        $icon = 'img_36.png';
    } else if ($eventType == 'add_email_automation') {
        $icon = 'img_36.png';
    } else if ($eventType == 'add_broadcast') {
        $icon = 'message2_36.png';
    } else if ($eventType == 'add_list') {
        $icon = 'message2_36.png';
    } else if ($eventType == 'add_list') {
        $icon = 'message2_36.png';
    } else if ($eventType == 'negative_feedback') {
        $icon = 'img_36.png';
    } else if ($eventType == 'added_video_comment') {
        $icon = 'message_36.png';
    } else if ($eventType == 'added_nps_score') {
        $icon = 'clock_36.png';
    } else if ($eventType == 'new_referral_registration') {
        $icon = 'message2_36.png';
    } else {
        $icon = 'user_36.png';
    }

    return $icon;
}

function notificationBackgroundColor($notificatioStatus) {

    if ($notificatioStatus == 0) {
        $background_color = '#e8dce0';
    } else {
        $background_color = '#ffffff';
    }
    return $background_color;
}

if (!function_exists('getNotificationLang')) {

    function getNotificationLang($eventType, $userRole) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Notifications_model", "mNotifications");
        $oNotificationLang = $CI->mNotifications->getNotificationLang($eventType);
        if ($userRole == 1) {
// Admin
            $getNotiLang = $oNotificationLang->tag_language_admin;
        } else if ($userRole == 3) {
// Client
            $getNotiLang = $oNotificationLang->tag_language;
        } else {
// User
            $getNotiLang = $oNotificationLang->tag_language_user;
        }
        $getNotiLang = base64_decode($getNotiLang);
        return $getNotiLang;
    }

    /**
     * Used to save User activity
     */
    if (!function_exists('logUserActivity')) {

        function logUserActivity($aData) {
            $tableName = 'tbl_user_activities';
            $userID = Session::get("team_user_id");
            if ($userID > 0) {
                $aData['user_id'] = $userID;
                $tableName = 'tbl_team_activities';
            }
            $bResult = \App\Models\Admin\TeamModel::saveActivityLog($tableName, $aData);
        }

    }


    /**
     * Get's app pages permission 
     */
    if (!function_exists('fetchPermissions')) {

        function fetchPermissions($moduleName) {

            $canRead = $canWrite = true;
            $aPermissions = Session::get('permission');
            if (!empty($aPermissions)) {
                foreach ($aPermissions as $aPermission) {
                    if ($aPermission->title == $moduleName) {
                        $canRead = ($aPermission->permission == 1) ? true : false;
                        $canWrite = ($aPermission->permission == 2) ? true : false;
                    }
                }
            }
            return array($canRead, $canWrite);
        }

    }


    /**
     * Get's location data
     */
    function getLocationData() {
        global $platform_device;
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        $aBrowserInfo = getBrowserN(); // Return userAgent, browsername, version, platform, pattern
        $aLocationInfo = getLocationInfoByIp();
        $aData = array_merge($aBrowserInfo, $aLocationInfo);
        $aData['ip_address'] = $ipaddress;
        $aData['platform_device'] = $platform_device;

        return $aData;
    }

     /**
     * Get's location data by ipaddress
     */
    function getLocationInfoByIp() {

        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = @$_SERVER['REMOTE_ADDR'];
        $result = array('country' => '', 'countryCode' => '', 'city' => '', 'region' => '', 'longitude' => '', 'latitude' => '');
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        //103.254.97.14
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if ($ip_data && $ip_data->geoplugin_countryName != null) {
            $result['country'] = $ip_data->geoplugin_countryName;
            $result['countryCode'] = $ip_data->geoplugin_countryCode;
            $result['city'] = $ip_data->geoplugin_city;
            $result['region'] = $ip_data->geoplugin_region;
            $result['longitude'] = $ip_data->geoplugin_longitude;
            $result['latitude'] = $ip_data->geoplugin_latitude;
        }
        return $result;
    }

}
?>