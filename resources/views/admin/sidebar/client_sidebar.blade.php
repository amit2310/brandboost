@php

	$avatar = $aUInfo->avatar;
	$firstname = $aUInfo->firstname;
	$lastname = $aUInfo->lastname;
	$userRole = $aUInfo->user_role;
	$address = $aUInfo->address;



	$username = $firstname . ' ' . $lastname;
	if (!empty($avatar)) {
		$srcUserImg = '/profile_images/' . $avatar;
	} else {
		$srcUserImg = '/profile_images/avatar_image.png';
	}
	$onBBCount = getBBCount($aUInfo->id, 'onsite');
	$onBrandBoostCount = $onBBCount > 0 ? $onBrandBoostCount  : '';


	$offBBCount = getBBCount($aUInfo->id, 'offsite');
	$offBrandBoostCount = $offBBCount > 0 ? $offBrandBoostCount : '';

	$chatCount = getChatCount($aUInfo->id, $userRole);

	$widgetCount = getWidgetCount($aUInfo->id);

	$npsWidgetCount = getNPSWidgetCount($aUInfo->id); //getNPSWidgetCount

	$referralWidgetCount = referralNPSWidgetCount($aUInfo->id); //getNPSWidgetCount

	$MediaCount = getMediaCount($aUInfo->id);

	$pageName = \Request::segment(2);
	$pageSeName = \Request::segment(3);
	$pageThName = \Request::segment(4);

	//Initialize variables
	$oBroadcast = !(empty($oBroadcast)) ? $oBroadcast : '';

	if(empty($oBroadcast)){
		$oBroadcast = new stdClass();
		$oBroadcast->campaign_type = '';
	}
 $pageName = ($pageName) ? $pageName : '';
 $pageSeName = ($pageSeName) ? $pageSeName : '';
 $pageThName = ($pageThName) ? $pageThName : '';
 $templateType = ($templateType) ? $templateType : '';
@endphp

<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user hidden">
            <div class="category-content">
                <div class="media"> <a href="#" class="media-left"><img src="{{ base_url('assets/images/placeholder.jpg') }}" class="img-circle img-sm" alt=""></a>
                    <div class="media-body"> <span class="media-heading text-semibold">Sailec Inc.</span>
                        <div class="text-size-mini">Business</div>
                    </div>
                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li> <a href="#"><i class="icon-arrow-down22"></i></a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">

                <ul class="navigation navigation-main navigation-accordion">
                    <li class="@php
                    if ($pageName == 'dashboard' || $pageName == '') {
                        echo 'active';
                    }
                    @endphp"><a href="{{ url('#/dashboard') }}"><strong class="nav_icon icon_dashboard"></strong> <span>Dashboard</span></a></li>
                    <li class="@php
                    if ($pageName == 'live') {
                        echo 'active';
                    }
                    @endphp"><a href="{{ url('#/live') }}"><strong class="nav_icon icon_live"></strong> <span>Live</span></a></li>
                    <li class="@php
                    if ($pageName == 'contacts') {
                        echo 'active';
                    }
                    @endphp"> <a href="{{ url('#/contacts/mycontacts') }}"><strong class="nav_icon icon_people"></strong> <span>Contacts</span></a>

                    </li>
                    <li id="menu-templates"><a href="#"><strong class="nav_icon icon_brand"></strong> <span>Templates</span></a>
                        <ul id="menu-templates-submenu" class="hidden-ul">
                            <li class="@php
                            if ($pageName == 'templates' && ($pageSeName == 'email' || ($pageSeName == 'edit' && $templateType=='email'))) {
                                $activeParentClass = 'menu-templates';
                                $activeChildClass = 'menu-templates-submenu';

                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/templates/email') }}"><i class="icon-menu6"></i> Emails</a></li>
                            <li class="@php
                            if ($pageName == 'templates' && ($pageSeName == 'sms' || ($pageSeName == 'edit' && $templateType=='sms'))) {
                                $activeParentClass = 'menu-templates';
                                $activeChildClass = 'menu-templates-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/templates/sms') }}"><i class="fa fa-circle"></i> SMS</a></li>

                        </ul>
                    </li>
                    <li id="menu-analytics"><a href="#"><strong class="nav_icon icon_analytics"></strong> <span>Analytics</span></a>
                        <ul id="menu-analytics-submenu" class="hidden-ul">
                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'reports') {
                                $activeParentClass = 'menu-analytics';
                                $activeChildClass = 'menu-analytics-submenu';

                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/reports') }}"><i class="icon-menu6"></i> Reports</a></li>
                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'feedbackreports') {
                                $activeParentClass = 'menu-analytics';
                                $activeChildClass = 'menu-analytics-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/admin/brandboost/feedbackreports') }}"><i class="fa fa-circle"></i> Feedback Report</a></li>
                            <li class="@php
                            if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'responseperformance') {
                                $activeParentClass = 'menu-analytics';
                                $activeChildClass = 'menu-analytics-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/responseperformance') }}"><i class="fa fa-circle"></i> Response Report</a></li>
                            <li class="@php
                            if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'repResTimeTrends') {
                                $activeParentClass = 'menu-analytics';
                                $activeChildClass = 'menu-analytics-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('admin/brandboost/repResTimeTrends') }}"><i class="fa fa-circle"></i> Response Trends</a></li>
                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'servicereports') {
                                $activeParentClass = 'menu-analytics';
                                $activeChildClass = 'menu-analytics-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/servicereports') }}"><i class="fa fa-circle"></i> Service Profile</a></li>
                            <li class="@php
                            if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'reportsOptOut') {
                                $activeParentClass = 'menu-analytics';
                                $activeChildClass = 'menu-analytics-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/reportsOptOut') }}"><i class="fa fa-circle"></i>Opt Out</a></li>
                            <li class="@php
                            if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'insightTags') {
                                $activeParentClass = 'menu-analytics';
                                $activeChildClass = 'menu-analytics-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/insightTags') }}"><i class="fa fa-circle"></i> Insight Tags Report</a></li>

                        </ul>
                    </li>

                    <li class="navigation-header servises-1"><span class="">Communication</span> <i class="icon-menu" title="" data-original-title="Appearance"></i></li>



                     <li id="chat-onsite" class="listt0"><a href="javascript:void(0)"><strong class="nav_icon icon_chat"></strong> <span>Chat</span></a>
                        <ul id="chat-websms" class="hidden-ul">
                            <li class="@php
                            if ($pageName == 'smschat' && $pageSeName == '' && $pageThName == '') {
                                $activeParentClass = 'chat-onsite';
                                $activeChildClass = 'chat-websms';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/smschat') }}"><i class="fa fa-circle"></i>Sms Chat</a></li>
                            <li class="@php
                            if ($pageName == 'webchat' && $pageSeName == '' && $pageThName == '') {
                                $activeParentClass = 'chat-onsite';
                                $activeChildClass = 'chat-websms';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/webchat') }}"><i class="fa fa-circle"></i>Web Chat</a></li>
                            <li class="@php
                            if ($pageName == 'chat' && $pageSeName == 'overview' && $pageThName == '') {
                                $activeParentClass = 'chat-onsite';
                                $activeChildClass = 'chat-websms';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/chat/overview') }}"><i class="fa fa-circle"></i>Web Chat Overview</a></li>
                            <li class="@php
                            if ($pageName == 'chatshortcut' && $pageSeName == '' && $pageThName == '') {
                                $activeParentClass = 'chat-onsite';
                                $activeChildClass = 'chat-websms';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/chatshortcut') }}"><i class="fa fa-circle"></i>Chat Shortcut</a></li>

                        </ul>
                    </li>

                    <li class="listt0"><a href="#"><strong class="nav_icon icon_email_inbox"></strong> <span>*Email Inbox</span></a>
                        <ul id="Chat" class="hidden-ul">
                            <li><a href="#"><i class="fa fa-circle"></i> Overview</a></li>
                            <li><a href="#"><i class="fa fa-circle"></i> Contacts</a></li>
                            <li><a href="#"><i class="fa fa-circle"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-circle"></i> Lists 1</a></li>
                            <li><a href="#"><i class="fa fa-circle"></i> Lists 2</a></li>
                            <li><a href="#"><i class="fa fa-circle"></i> Segments</a></li>
                            <li><a href="#"><i class="fa fa-circle"></i> Tags</a></li>
                        </ul>
                    </li>

                    <li class="navigation-header servises"><span class="">Marketing</span> <i class="icon-menu" title="" data-original-title="Appearance"></i></li>

                    <li id="menu-site-boost" class="listt"><a href="#"><strong class="nav_icon icon_offsite"></strong> <span>On Site Reviews</span> @if(!empty($onBrandBoostCount))<span class="label bg-blue-400 menubadge">{{ $onBrandBoostCount }}</span>@endif</a>
                        <ul id="menu-site-boost-submenu" class="hidden-ul">
                         <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'onsite_overview') {
                                $activeParentClass = 'menu-site-boost';
                                $activeChildClass = 'menu-site-boost-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/onsite_overview') }}"><i class="fa fa-circle"></i> Overview</a></li>

                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'onsite') {
                                $activeParentClass = 'menu-site-boost';
                                $activeChildClass = 'menu-site-boost-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/onsite') }}"><i class="fa fa-circle"></i> Campaigns</a></li>
                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'reviews') {
                                $activeParentClass = 'menu-site-boost';
                                $activeChildClass = 'menu-site-boost-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/reviews/') }}"><i class="fa fa-circle"></i> Reviews</a></li>

                            <li class="@php
                            if ($pageName == 'questions') {
                                $activeParentClass = 'menu-site-boost';
                                $activeChildClass = 'menu-site-boost-submenu';
                                echo 'active';
                            }
                            @endphp">
                                <a href="{{ url('#/questions') }}"><i class="fa fa-circle"></i> Questions</a>


                            </li>

                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'review_request' && $pageThName == 'onsite') {
                                $activeParentClass = 'menu-site-boost';
                                $activeChildClass = 'menu-site-boost-submenu';
                                echo 'active';
                            }
                            @endphp">
                                <a href="{{ url('#/brandboost/review_request/onsite') }}"><i class="fa fa-circle"></i> Review Requests</a>
                            </li>

                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'media') {
                                $activeParentClass = 'menu-site-boost';
                                $activeChildClass = 'menu-site-boost-submenu';
                                echo 'active';
                            }
                            @endphp">
                                <a href="{{ url('#/brandboost/media') }}"><i class="fa fa-circle"></i> Media</a>
                            </li>

                        </ul>
                    </li>
                    <li id="menu-offsite-boost" class="listt"><a href="#"><strong class="nav_icon icon_onsite"></strong> <span>Off Site Reviews</span> @if(!empty($offBrandBoostCount))<span class="label bg-blue-400 menubadge">{{ $offBrandBoostCount }}</span>@endif </a>
                        <ul id="menu-offsite-boost-submenu" class="hidden-ul">

                         <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'offsite_overview') {
                                $activeParentClass = 'menu-offsite-boost';
                                $activeChildClass = 'menu-offsite-boost-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/offsite_overview') }}"><i class="fa fa-circle"></i> Overview</a></li>

                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'offsite') {
                                $activeParentClass = 'menu-offsite-boost';
                                $activeChildClass = 'menu-offsite-boost-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/offsite') }}"><i class="fa fa-circle"></i> Campaigns</a></li>


                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'review_request' && $pageThName == 'offsite') {
                                $activeParentClass = 'menu-offsite-boost';
                                $activeChildClass = 'menu-offsite-boost-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/review_request/offsite') }}"><i class="fa fa-circle"></i> Review Requests</a></li>

                            <li class="@php
                            if ($pageName == 'feedback' && $pageSeName == 'listall') {
                                $activeParentClass = 'menu-offsite-boost';
                                $activeChildClass = 'menu-offsite-boost-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/feedback/listall/') }}"><i class="fa fa-circle"></i>Negative Feedback</a>
                            </li>

                        </ul>
                    </li>

                    <li id="menu-email" class="listt"><a href="#"><strong class="nav_icon icon_email"></strong> <span>Email</span> </a>
                        <ul id="menu-email-submenu" class="hidden-ul">
                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'emails' && $pageThName== 'overview') {
                                $activeParentClass = 'menu-email';
                                $activeChildClass = 'menu-email-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/emails/overview') }}"><i class="fa fa-circle"></i> Overview</a>
                            </li>
                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'emails' && $pageThName != 'overview' && $pageThName != 'sms' && $automation_type == 'email') {
                                $activeParentClass = 'menu-email';
                                $activeChildClass = 'menu-email-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/emails') }}"><i class="fa fa-circle"></i> Automation</a></li>
                            <li class="@php
                            if ($pageName == 'broadcast' && ($pageSeName == 'email' || (($pageSeName == 'edit' || $pageSeName == 'report') && strtolower($oBroadcast->campaign_type) =='email'))) {
                                $activeParentClass = 'menu-email';
                                $activeChildClass = 'menu-email-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/broadcast/email') }}"><i class="fa fa-circle"></i> Broadcast</a></li>
                            <li class="@php
                            if ($pageName == 'lists' && $pageSeName != 'smslists' && $pageSeName != 'getSMSListContacts') {
                                $activeParentClass = 'menu-email';
                                $activeChildClass = 'menu-email-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/lists/') }}"><i class="fa fa-circle"></i> Lists</a></li>

                        </ul>
                    </li>
                    <li id="menu-sms" class="listt"><a href="#"><strong class="nav_icon icon_sms"></strong> <span>SMS</span> <span class="label bg-blue-400 menubadge"></span></a>
                        <ul id="menu-sms-submenu" class="hidden-ul">

                            <li class="@php
                            if ($pageName == 'broadcast' && $pageSeName == 'smsoverview') {
                                $activeParentClass = 'menu-sms';
                                $activeChildClass = 'menu-sms-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/broadcast/smsoverview') }}"><i class="fa fa-circle"></i> Overview</a>
                            </li>

                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'emails' && ($pageThName == 'sms' || $automation_type == 'sms')) {
                                $activeParentClass = 'menu-sms';
                                $activeChildClass = 'menu-sms-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/emails/sms') }}"><i class="fa fa-circle"></i> Automation</a></li>


                            <li class="@php
                            if ($pageName == 'broadcast' && $pageSeName == 'sms' || (($pageSeName == 'edit' || $pageSeName == 'report') && strtolower($oBroadcast->campaign_type) =='sms')) {
                                $activeParentClass = 'menu-sms';
                                $activeChildClass = 'menu-sms-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/broadcast/sms') }}"><i class="fa fa-circle"></i> Broadcast</a></li>

                            <li class="@php
                            if ($pageName == 'lists' && $pageSeName == 'smslists' || $pageSeName == 'getSMSListContacts') {
                                $activeParentClass = 'menu-sms';
                                $activeChildClass = 'menu-sms-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/lists/smslists') }}"><i class="fa fa-circle"></i> Lists</a></li>

                        </ul>
                    </li>

                    <li class="@if ($pageSeName == 'mysegments') active @endif"> <a href="{{ url('#/broadcast/mysegments') }}"><strong class="nav_icon icon_segment"></strong> <span>Segments</span></a>

                    </li>

                    <li id="menu-brand" class="listt"><a href="#"><strong class="nav_icon icon_brand"></strong> <span>Brand Page</span> <span class="label bg-blue-400 menubadge"></span></a>
                        <ul id="menu-brand-submenu" class="hidden-ul">

                            <li class="@php
                            if ($pageName == 'settings') {
                                $activeParentClass = 'menu-brand';
                                $activeChildClass = 'menu-brand-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/settings') }}"><i class="fa fa-circle"></i> Brand Setting</a></li>
                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'brand_configuration') {
                                $activeParentClass = 'menu-brand';
                                $activeChildClass = 'menu-brand-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/brand_configuration') }}"><i class="fa fa-circle"></i> Universal Brand Page</a></li>

                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'campaign_specific') {
                                $activeParentClass = 'menu-brand';
                                $activeChildClass = 'menu-brand-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/campaign_specific') }}"><i class="fa fa-circle"></i> Campaign Specific</a></li>

                        </ul>
                    </li>

                    <li id="menu-widgets" class="listt"><a href="#"><strong class="nav_icon icon_widget"></strong> <span>Widgets</span> </a>
                        <ul id="menu-widgets-submenu" class="hidden-ul">
                            <li class="@php
                            if ($pageName == 'brandboost' && $pageSeName == 'widget_overview') {
                                $activeParentClass = 'menu-widgets';
                                $activeChildClass = 'menu-widgets-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/widget_overview') }}"><i class="fa fa-circle"></i> <span>Overview</span> </a></li>

                            <li class="@php
                            if ($pageName == 'brandboost' && ($pageSeName == 'widgets' || $pageSeName == 'onsite_widget_setup')) {
                                $activeParentClass = 'menu-widgets';
                                $activeChildClass = 'menu-widgets-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/brandboost/widgets') }}"><i class="fa fa-circle"></i> <span>Onsite Widgets</span> @if(!empty($widgetCount))<span class="label bg-blue-400 menubadge">{{ $widgetCount }}</span>@endif</a></li>

                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'chat' || ($pageName == 'modules' && $pageSeName == 'chat' && $pageThName=='setup')) {
                                $activeParentClass = 'menu-widgets';
                                $activeChildClass = 'menu-widgets-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/chat/') }}"><i class="fa fa-circle"></i> <span>Chat Widgets </span> @if(!empty($chatCount))<span class="label bg-blue-400 menubadge">{{ $chatCount }}</span>@endif</a></li>

							<li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'nps' && ($pageThName == 'widgets' || $pageThName == 'nps_widget_setup')) {
                                $activeParentClass = 'menu-widgets';
                                $activeChildClass = 'menu-widgets-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/nps/widgets') }}"><i class="fa fa-circle"></i> <span>NPS Widgets </span> @if(!empty($npsWidgetCount))<span class="label bg-blue-400 menubadge">{{ $npsWidgetCount }}</span>@endif</a></li>

							<li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'referral' && $pageThName == 'widgets') {
                                $activeParentClass = 'menu-widgets';
                                $activeChildClass = 'menu-widgets-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/referral/widgets') }}"><i class="fa fa-circle"></i> <span>Referral Widgets </span> @if(!empty($referralWidgetCount))<span class="label bg-blue-400 menubadge">{{ $referralWidgetCount }}</span>@endif</a></li>

							<li class="@php
                            if ($pageName == 'mediagallery') {
                                $activeParentClass = 'menu-widgets';
                                $activeChildClass = 'menu-widgets-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/mediagallery') }}"><i class="fa fa-circle"></i> <span>Media Widgets </span><span class="label bg-blue-400 menubadge">1</span></a></li>
                        </ul>
                    </li>

                    <li id="menu-referral" class="listt"><a href="#"><strong class="nav_icon icon_referral"></strong> <span>Referral</span> </a>
                        <ul id="menu-referral-submenu" class="hidden-ul">

                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'referral' && $pageThName == 'overview') {
                                $activeParentClass = 'menu-referral';
                                $activeChildClass = 'menu-referral-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/referral/overview') }}"><i class="fa fa-circle"></i> <span>Overview</span> </a></li>

                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'referral' && in_array($pageThName, array('', 'setup', 'reward', 'workflow', 'configurations', 'integrations', 'reports', 'stats'))) {
                                $activeParentClass = 'menu-referral';
                                $activeChildClass = 'menu-referral-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/referral/') }}"><i class="fa fa-circle"></i> <span>Referral App</span> </a></li>

                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'referral' && $pageThName == 'advocates') {
                                $activeParentClass = 'menu-referral';
                                $activeChildClass = 'menu-referral-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/referral/advocates/') }}"><i class="fa fa-circle"></i> <span>Advocates</span> </a></li>


                        </ul>
                    </li>

                    <li class="navigation-header servises1"><span class="">Service</span> <i class="icon-menu" title="" data-original-title="Appearance"></i></li>
                    <li id="menu-nps" class="listt1"><a href="javascript:void(0);"><strong class="nav_icon icon_nps"></strong> <span>NPS Survey</span></a>
                        <ul id="menu-nps-submenu" class="hidden-ul">
                         <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'nps' && $pageThName == 'overview') {
                                $activeParentClass = 'menu-nps';
                                $activeChildClass = 'menu-nps-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/nps/overview') }}"><i class="fa fa-circle"></i> Overview</a></li>

                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'nps' && in_array($pageThName,array('', 'setup'))) {
                                $activeParentClass = 'menu-nps';
                                $activeChildClass = 'menu-nps-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/nps') }}"><i class="fa fa-circle"></i> Campaigns</a></li>
                            <li class="@php
                            if ($pageName == 'modules' && $pageSeName == 'nps' && $pageThName == 'score') {
                                $activeParentClass = 'menu-nps';
                                $activeChildClass = 'menu-nps-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/modules/nps/score') }}"><i class="fa fa-circle"></i> Scores / Feedbacks</a></li>
                        </ul>
                    </li>


                    <li class="navigation-header servises2"><span class="">Account</span> <i class="icon-menu" title="" data-original-title="Appearance"></i></li>
                    <li class="listt2"><a href="#"><strong class="nav_icon icon_integration"></strong> <span>*Integration</span></a></li>
                    <li id="menu-team" class="listt2"><a href="#"><strong class="nav_icon icon_people"></strong> <span>Team</span></a>
                        <ul id="menu-team-submenu" class="hidden-ul">
                            <li class="@php
                            if ($pageName == 'team' && $pageSeName == 'dashboard') {
                                $activeParentClass = 'menu-team';
                                $activeChildClass = 'menu-team-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/team/dashboard') }}"><i class="fa fa-circle"></i>Dashboard</a>
                            </li>
                            <li class="@php
                            if ($pageName == 'team' && $pageSeName == 'rolelist') {
                                $activeParentClass = 'menu-team';
                                $activeChildClass = 'menu-team-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/team/rolelist') }}"><i class="fa fa-circle"></i>Roles</a>
                            </li>
                            <li class="@php
                            if ($pageName == 'team' && $pageSeName == 'memberlist') {
                                $activeParentClass = 'menu-team';
                                $activeChildClass = 'menu-team-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/team/memberlist') }}"><i class="fa fa-circle"></i> Team Members</a></li>
                            <li class="@php
                            if ($pageName == 'team' && $pageSeName == 'activitylist') {
                                $activeParentClass = 'menu-team';
                                $activeChildClass = 'menu-team-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/team/activitylist') }}"><i class="fa fa-circle"></i> Member Activities</a>
                            </li>
                        </ul>
                    </li>

                    <li id="menu-tags" class="listt2"><a href="#"><strong class="nav_icon icon_tags"></strong> <span>Insight Tags</span></a>
                        <ul id="menu-tags-submenu" class="hidden-ul">
                            <li class="@php
                            if ($pageName == 'tags' && $pageSeName == '') {
                                $activeParentClass = 'menu-tags';
                                $activeChildClass = 'menu-tags-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/tags/') }}"><i class="fa fa-circle"></i> Tag Management</a>
                            </li>
                            <li class="@php
                            if ($pageName == 'tags' && $pageSeName == 'tagsreview') {
                                $activeParentClass = 'menu-tags';
                                $activeChildClass = 'menu-tags-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('#/tags/tagsreview') }}"><i class="fa fa-circle"></i> Tag Reviews</a>
                            </li>
                            <li class="@php
                            if ($pageName == 'tags' && $pageSeName == 'tagsfeedback') {
                                $activeParentClass = 'menu-tags';
                                $activeChildClass = 'menu-tags-submenu';
                                echo 'active';
                            }
                            @endphp"><a href="{{ url('admin/tags/tagsfeedback') }}"><i class="fa fa-circle"></i> Tag Feedbacks</a>
                            </li>
                        </ul>
                    </li>
                    <li class="listt2"><a href="#"><strong class="nav_icon icon_helpdesk"></strong> <span>*Help</span></a></li>
                    <li class="listt2 @if ($pageName == 'settings') active @endif"><a href="{{ url('#/settings') }}"><strong class="nav_icon icon_settings"></strong> <span>Settings</span></a></li>


                    <li class="active mt40 hidemenu"><a class="sidebar-control sidebar-main-toggle hidden-xs"><strong class="nav_icon icon_hide"></strong> <span>Hide Menu</span></a></li>


                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>



