<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
//$CI = & get_instance();
//$CI->load->model("admin/Team_model", "mmT");
$aUInfo = getLoggedUser();
userRoleAdmin($aUInfo->user_role);
if ($aUInfo->id == '') {
    Session::put('admin_redirect_url', \Request::fullUrl());
}

$isLoggedInTeam = Session::get("team_user_id");

if ($isLoggedInTeam) {
    $aTeamInfo = \App\Models\Admin\TeamModel::getTeamMember($isLoggedInTeam, $aUInfo->id);
}

admin_account();
page_auth();
$objMembership = getAllActiveMembership();
$loggedPlanID = $aUInfo->plan_id;
$aLevelUpgrades = getMembershipLevelUpgrades($objMembership, $loggedPlanID);

if (!empty($aLevelUpgrades)) {
    $oCurrentPlanData = $aLevelUpgrades['current'];
    $oUpgradePlanData = $aLevelUpgrades['main'];

    $currentSubsCycle = $oCurrentPlanData->subs_cycle;

    $currentPrice = $oCurrentPlanData->price;
    $upgradePrice = $oUpgradePlanData->price;

    $additionalPriceToPay = ( $upgradePrice - $currentPrice );
    $billedCycle = ($oUpgradePlanData->subs_cycle == 'yearly') ? 'year' : 'month';

    if ($oCurrentPlanData->subs_cycle == 'yearly' && $oUpgradePlanData->subs_cycle == 'yearly') {
        $additionalPriceToPay = number_format(( $additionalPriceToPay / 12), 2);
        $billedCycle = 'month';
    }

    if ($oCurrentPlanData->subs_cycle == 'bi-yearly' && $oUpgradePlanData->subs_cycle == 'bi-yearly') {
        $additionalPriceToPay = number_format(( $additionalPriceToPay / 24), 2);
    }

    $aAnnualUpgradeData = getMembershipAnnualUpgrades($objMembership, $oCurrentPlanData->plan_id);
    //pre($aAnnualUpgradeData);
    //die;
}


$userRole = $aUInfo->user_role;
$userFirstname = $aUInfo->firstname;
$avatar = $aUInfo->avatar;
$getAllGlobalSubscribers = getAllGlobalSubscribers($aUInfo->id);
$oSettings = userSetting($aUInfo->id);
if (!empty($oSettings->inactivity_length)) {
    $inactivity_length = $oSettings->inactivity_length;
} else {
    $inactivity_length = 100;
}


if (!empty($avatar)) {
    $srcUserImg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $avatar;
} else {
    $srcUserImg = '/profile_images/avatar_image.png';
}

$uriSegment = \Request::segment(3);

$offsite_active = '';
$onsite_active = '';
if ($uriSegment == 'offsite') {
    $offsite_active = 'active';
} else if ($uriSegment == 'onsite') {
    $onsite_active = 'active';
} else {
    
}

?>
<!DOCTYPE html>
<html>

    <head>

        <title>@yield('title') - Brand Boost</title>

        @include('layouts.main_partials._main_favicon')

        @include('layouts.main_partials._main_head')

        @include('layouts.main_partials._main_css')

        @include('layouts.main_partials._main_js')

    </head>
    
    <?php
    $automation_type  = isset($automation_type) ? $automation_type : '';

    if (\Request::segment(2) == 'modules' && \Request::segment(3) == 'nps') {
        $pageColor = 'nps_sec';
    } else if (\Request::segment(2) == 'brandboost' && \Request::segment(3) == 'widget_overview' && \Request::segment(4) == '') {
        $pageColor = 'widget_sec';
    } else if (\Request::segment(2) == 'live' && \Request::segment(3) == 'overview' && \Request::segment(4) == '') {
        $pageColor = 'live_sec';
    } else if (\Request::segment(2) == 'chat' && \Request::segment(3) == 'overview' && \Request::segment(4) == '') {
        $pageColor = 'chat_sec';
    } else if (\Request::segment(2) == 'broadcast' && (\Request::segment(3) == 'report')) {
        if (strtolower($oBroadcast->campaign_type) == 'sms') {
            $pageColor = 'sms_sec';
        } else {
            $pageColor = 'email_sec';
        }
    } else if (\Request::segment(2) == 'broadcast' && \Request::segment(3) == 'records' && \Request::segment(4) == 'sms') {
        $pageColor = 'sms_sec';
    } else if (\Request::segment(2) == 'modules' && \Request::segment(3) == 'emails' && \Request::segment(4) == 'sms') {
        $pageColor = 'sms_sec';
    } else if (\Request::segment(2) == 'modules' && \Request::segment(3) == 'emails' && $automation_type == 'sms') {
        $pageColor = 'sms_sec';
    } else if (\Request::segment(2) == 'modules' && \Request::segment(3) == 'emails' && $automation_type == 'email') {

        $pageColor = 'email_sec';
    } else if (\Request::segment(2) == 'templates' && (\Request::segment(3) == 'email' || (\Request::segment(3) == 'edit') && $templateType == 'email')) {

        $pageColor = 'email_sec';
    } else if (\Request::segment(2) == 'templates' && (\Request::segment(3) == 'sms' || (\Request::segment(3) == 'edit') && $templateType == 'sms')) {

        $pageColor = 'sms_sec';
    } else if (\Request::segment(2) == 'webchat' && \Request::segment(3) == '') {
        $pageColor = 'chat_sec';
    } else if (\Request::segment(2) == 'modules' && \Request::segment(3) == 'chat') {
        $pageColor = 'chat_sec';
    } else if (\Request::segment(2) == 'modules' && \Request::segment(3) == 'referral') {
        $pageColor = 'refferal_sec';
    } else if (\Request::segment(2) == 'brandboost' && \Request::segment(3) == 'onsite') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'brandboost' && \Request::segment(3) == '') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'brandboost' && \Request::segment(3) == 'reviewdetails') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'brandboost' && \Request::segment(3) == 'reviewdetailsnew') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'questions' && \Request::segment(3) == '') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'questions' && \Request::segment(3) == 'view') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'questions' && \Request::segment(3) == 'details') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'feedback' && \Request::segment(3) == 'details') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'contacts' && \Request::segment(3) == 'profile') {
        $pageColor = 'people_sec';
    } else if (\Request::segment(2) == 'brandboost' && \Request::segment(3) == 'addreview') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'questions' && \Request::segment(3) == 'add') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'notifications' && \Request::segment(3) == '') {
        $pageColor = 'notifications_sec';
    } else if (\Request::segment(2) == 'brandboost' && \Request::segment(3) == 'campaign_specific') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(2) == 'user_setting' || \Request::segment(2) == 'settings' || \Request::segment(2) == 'accounts' || \Request::segment(2) == 'profile') {
        $pageColor = 'user_brand_sec';
    } else if (\Request::segment(3) == 'brand_configuration') {
        $pageColor = 'brand_sec';
    } else if (\Request::segment(3) == 'media' || \Request::segment(3) == 'nps' || \Request::segment(2) == 'mediagallery') {
        $pageColor = 'media_sec';
    } else if (\Request::segment(3) == 'offsite_setup' || \Request::segment(3) == 'offsite' || \Request::segment(3) == 'offsite_overview') {
        $pageColor = 'offsite_sec';
    } else if (\Request::segment(3) == 'onsite_setup' || \Request::segment(3) == 'onsite_widget_setup' || \Request::segment(3) == 'onsite' || \Request::segment(3) == 'widgets' || \Request::segment(3) == 'tagsfeedback' || \Request::segment(3) == 'review_request' || \Request::segment(3) == 'onsite_overview') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(3) == 'reviews' || \Request::segment(3) == 'emails' || \Request::segment(3) == 'automationStats' || \Request::segment(3) == 'tagsreview' || \Request::segment(2) == 'dashboard') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(3) == 'statistics' || \Request::segment(3) == 'subscribers') {
        $pageColor = 'email_sec';
    } else if (\Request::segment(3) == 'stats' || \Request::segment(4) == 'onsite' || \Request::segment(3) == 'mycontacts') {
        $pageColor = 'people_sec';
    } else if (\Request::segment(2) == 'tags' && \Request::segment(3) == 'review') {
        $pageColor = 'onsite_sec';
    } else if (\Request::segment(3) == 'referral' || \Request::segment(3) == 'listall' || \Request::segment(2) == 'live') {
        $pageColor = 'live_sec';
    } else if (\Request::segment(2) == 'chat' && \Request::segment(3) == '') {
        $pageColor = 'chat_sec';
    } else if (\Request::segment(2) == 'smschat' && \Request::segment(3) == '') {
        $pageColor = 'chat_sec';
    } else if (\Request::segment(2) == 'chatshortcut' && \Request::segment(3) == '') {
        $pageColor = 'chat_sec';
    } else if (\Request::segment(2) == 'report' || \Request::segment(3) == 'brandboost') {
        $pageColor = 'analytic_sec';
    } else if (\Request::segment(2) == 'brandboost' || \Request::segment(3) == 'report') {
        $pageColor = 'analytic_sec';
    } else if (\Request::segment(2) == 'broadcast' && (\Request::segment(3) == 'edit')) {
        if (strtolower($oBroadcast->campaign_type) == 'sms') {
            $pageColor = 'sms_sec';
        } else {
            $pageColor = 'email_sec';
        }
    } else if (\Request::segment(2) == 'broadcast' && (\Request::segment(3) == 'smsoverview' || \Request::segment(3) == 'sms')) {
        $pageColor = 'sms_sec';
    } else if (\Request::segment(2) == 'broadcast') {
        $pageColor = 'email_sec';
    } else if (\Request::segment(2) == 'lists' && $listtype=='email' || \Request::segment(3) == 'getListContacts') {
        $pageColor = 'email_sec';
    } else if (\Request::segment(2) == 'lists' && $listtype=='sms' || \Request::segment(3) == 'smslists' || \Request::segment(3) == 'getSMSListContacts') {
        $pageColor = 'sms_sec';
    } else {
        $pageColor = '';
    }
    ?>

    
    <body class="<?php echo $pageColor; ?>_body">
        <span class="userStillLogged">
            <div class="overlaynew" style="position: fixed;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.4); z-index: 99999;text-align: center; display:none;">
                <div style="top: 47%;position:relative;">
                    <a class="bg-teal-400" id="spinner-dark-6">
                        <div class="ball-scale-multiple">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div><br> PROCESSING</a>
                </div>
            </div>


            <!--===================TOP SECTION START================-->
            @include('layouts.main_partials._main_topmenu')
            <!--===================TOP SECTION END================-->

            <!-- Page container -->
            <div class="page-container">

                <!-- Page content -->
                <div class="page-content">
                    <!-- Main content -->

                    <?php
                    
                    if ($isLoggedInTeam) {
                        $hasweb_access = getMemberchatpermission($isLoggedInTeam);
                        if ($hasweb_access->web_chat == 1 || $hasweb_access->sms_chat == 1) {
                            ?>
                           {{-- @include('admin.chat_app', array('getAllGlobalSubscribers' => $getAllGlobalSubscribers, 'isLoggedInTeam' => $isLoggedInTeam)) --}}
                            <?php
                        }
                        ?>
                         @include('admin.sidebar.team_sidebar')
                         <?php
                    } else if ($userRole == '1') {
                        ?>
                        {{-- @include('admin.chat_app', array('getAllGlobalSubscribers' => $getAllGlobalSubscribers)) --}}
                        @include('admin.sidebar.admin_sidebar')
                        <?php
                    } else if ($userRole == '2') {
                        ?>
                        {{-- @include('admin.chat_app', array('getAllGlobalSubscribers' => $getAllGlobalSubscribers)) --}}
                        @include('admin.sidebar.user_sidebar')
                        <?php 
                    } else if ($userRole == '3') {
                        ?>
                        @include('admin.chat_app', array('getAllGlobalSubscribers' => $getAllGlobalSubscribers))
                        @include('admin.sidebar.client_sidebar')
                       <?php 
                    } 
                    ?>

                    <div class="content-wrapper <?php echo $pageColor; ?>">
                        @yield('contents')
                    </div>
                    <!-- /main content -->
                </div>
                <!-- /page content -->
            </div>
            <!-- /page container -->


            @include('layouts.main_partials._main_modals')
        </span>
        

         @include('admin.components.smart-popup.smart-notification-widget') 

        @include('admin.modals.upgrade.upgrade_membership', array('oMemberships' => $objMembership, 'oSuggestedPlan' => $oUpgradePlanData, 'additionalPriceToPay' => $additionalPriceToPay, 'oCurrentPlanData' => $oCurrentPlanData, 'oUser' => $aUInfo))
        
        @include('layouts.main_partials._main_footer_js')
        
    </body>



</html> 

