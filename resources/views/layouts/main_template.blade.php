@php
    $aUInfo = getLoggedUser();
    userRoleAdmin($aUInfo->user_role);
    $additionalPriceToPay="";
    $oUpgradePlanData = array();
    $aAnnualUpgradeData = array();
    $oCurrentPlanData = array();
    $billedCycle ="";
    if ($aUInfo->id == '') {
        Session::put('admin_redirect_url', \Request::fullUrl());
    }

    $isLoggedInTeam = Session::get("team_user_id");
    if ($isLoggedInTeam) {
        $aTeamInfo = App\Models\Admin\TeamModel::getTeamMember($isLoggedInTeam, $aUInfo->id);
        $teamMemberName = $aTeamInfo->firstname . ' ' . $aTeamInfo->lastname;
        $teamMemberId = $aTeamInfo->id;
        $loginMember = $teamMemberId;
    } else {
        $teamMemberName = '';
        $teamMemberId = '';
        $loginMember = $aUInfo->id;
    }

    if ($isLoggedInTeam) {
        $aTeamInfo = \App\Models\Admin\TeamModel::getTeamMember($isLoggedInTeam, $aUInfo->id);
    }

    admin_account();
    page_auth();
    $objMembership = getAllActiveMembership();
    if(isset($aUInfo->plan_id))
    {
    $loggedPlanID = $aUInfo->plan_id;
    }
    else
    {
        $loggedPlanID='';
    }
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
    }

@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - Brand Boost</title>
@include('layouts.main_partials._main_favicon')
@include('layouts.main_partials._main_meta')

<!--******************
    CSS
    **********************-->
    @include('layouts.main_partials._main_css')

</head>
<body id="PeopleSection">

<div class="page-wrapper">
    <!--******************
    SIDEBAR
    **********************-->
    @if ($isLoggedInTeam)

        @php
            $hasweb_access = getMemberchatpermission($loginMember);
            $web_chat="";
            $sms_chat="";
            if(!empty($hasweb_access))
            {
            $web_chat = $hasweb_access->web_chat;
            $sms_chat = $hasweb_access->sms_chat;
            }
        @endphp

        @if ($web_chat == 1 || $sms_chat == 1)
            @include('admin.chat_app', ['getAllGlobalSubscribers' => $getAllGlobalSubscribers, 'isLoggedInTeam' => $loginMember])
        @endif

        @include('admin.sidebar.team_sidebar')

    @elseif ($userRole == '1')

        {{-- @include('admin.chat_app', ['getAllGlobalSubscribers' => $getAllGlobalSubscribers]) --}}
        @include('admin.sidebar.admin_sidebar')

    @elseif ($userRole == '2')
        {{-- @include('admin.chat_app', ['getAllGlobalSubscribers' => $getAllGlobalSubscribers]) --}}
        @include('admin.sidebar.user_sidebar')

    @elseif ($userRole == '3')
        {{--@include('admin.chat_app', ['getAllGlobalSubscribers' => $getAllGlobalSubscribers])--}}
        @include('admin.sidebar.client_sidebar')
    @endif


    <div class="page-content">
        <!--******************
         TOPBAR
        **********************-->
        @include('layouts.main_partials._main_topmenu')

        <div id="masterContainer2">
            <router-view></router-view>
        </div>


    </div>


</div>

<!--******************
 jQuery
**********************-->
@include('layouts.main_partials._main_footer_js')

@include('layouts.main_partials._main_modals')

@include('admin.components.smart-popup.smart-notification-widget')

@include('admin.modals.upgrade.upgrade_membership', array('oMemberships' => $objMembership, 'oSuggestedPlan' => $oUpgradePlanData, 'additionalPriceToPay' => $additionalPriceToPay, 'oCurrentPlanData' => $oCurrentPlanData, 'oUser' => $aUInfo))


<script src="{{ base_url() }}assets/js/modules/people/subscribers.js" type="text/javascript"></script>
<script type="text/javascript" src="/public/js/app.js"></script>
<script>
    $(document).ready(function(){
        $(".nav-link").click(function(){
            $(".main-icon-menu-pane .nav-link").each(function(){
                $(this).removeClass('active');
            })
            $(this).addClass(('active'));
        });
    });

</script>

</body>
</html>

