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

<div class="left-sidenav">
    <div class="main-icon-menu">
        <div class="slimscroll">
            <nav class="nav">
                <a href="javascript:void(0);" class="brandboost_logo"><span class="site_status_icon"></span> <img class="bb_logo_img" src="assets/images/logo_small.svg"/> </a>
                <a href="#dashboard" id="loadDasboard" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Dashboard" > <i class="ri-dashboard-fill"></i> </a>
                <a href="#people" id="loadContactTheme" class="nav-link people active" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="People"> <i class="ri-account-circle-fill"></i></a>
                <a href="#live_messanger" id="loadChatTheme" class="nav-link livechat" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Live Messenger" > <i class="ri-chat-1-fill"></i> </a>
                <a href="#Email_inbox" id="loadEmailInbox" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Email"> <i class="ri-mail-fill"></i> </a>
                <span class="menu-icon-divider"><img src="assets/images/menu-icon-divider.svg"/></span>
                <a href="#BrandPage" id="loadBrandPage" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Brand"> <i class="ri-window-2-fill"></i></a>
                <a href="#ReviewSystem" id="loadReviewsTheme" class="nav-link review" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Review"> <i class="ri-star-fill"></i> </a>
                <a href="#MediaGalleries" id="loadMediaGallery" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Media"> <i class="ri-image-fill"></i> </a>
                <span class="menu-icon-divider"><img src="assets/images/menu-icon-divider.svg"/></span>
                <a href="#EmailMarketing" id="loadEmailTheme" class="nav-link email" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Email Marketing"> <i class="ri-send-plane-2-fill"></i> </a>
                <a href="#SMSMarketing" id="loadSMSTheme" class="nav-link sms" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="SMS Marketing"> <i class="ri-message-2-fill"></i> </a>
                <a href="#Referrals" id="loadReferral" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Referrals"> <i class="ri-share-fill"></i> </a>
                <a href="#Nps" id="loadNps" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="NPS"> <i class="ri-share-fill"></i> </a>
                <a href="#SiteWidgets" id="loadWidgets" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Widgets"> <i class="ri-rocket-2-fill"></i> </a>
                <span class="menu-icon-divider"><img src="assets/images/menu-icon-divider.svg"/></span>
                <a href="#Feedback" id="loadFeedback" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Feedback"> <i class="ri-chat-smile-3-fill"></i> </a>
                <a href="#HelpDesk" id="loadHelpDesk" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Help Desk"> <i class="ri-customer-service-fill"></i> </a>
                <a href="#KnowledgeBase" id="loadKnowledgeBase" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Knowledge Base"> <i class="ri-book-open-fill"></i></a>
                <a href="#Appointments" id="loadAppointments" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Appointments"> <i class="ri-calendar-event-fill"></i> </a>
                <span class="menu-icon-divider"><img src="assets/images/menu-icon-divider.svg"/></span>
                <a href="#Analytics" id="loadAnalytics" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Analytics"> <i class="ri-bar-chart-box-fill"></i> </a>
                <a href="#Settings" id="loadSettings" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Settings"> <i class="ri-settings-3-fill"></i> </a>
            </nav>
        </div>
    </div>
    <!--end main-icon-menu-->
    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            <span style="" class="button-menu-mobile"><img src="assets/images/arrow_right_36.svg"/></span>
            <span style="position: absolute; top: 17px; right: 20px; transform:rotate(180deg);" class="mobile-menu-control float-left"><img src="assets/images/close_menu_circle.svg"></span>

            <!--************
              DASHBOARD
            *************-->
            <div id="dashboard" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">DASHBOARD</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link active" href="people_dashboard.php"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Tags</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Deals</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Companies</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
                <hr>
                <div class="title-box-mid">
                    <h6 class="menu-title">CAMPAIGNS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_blue.svg"/></i><span class="menu-item-text">McDonald's</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_orange.svg"/></i><span class="menu-item-text">Mitsubishi</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_yellow.svg"/></i><span class="menu-item-text">Louis Vuitton</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_green.svg"/></i><span class="menu-item-text">The Walt  Company </span></a></li>
                </ul>
            </div>

            <!--************
             PEOPLE
           *************-->
            <div id="people" class="main-icon-menu-pane people active">
                <div class="title-box">
                    <h6 class="menu-title">PEOPLE</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('#/contacts/dashboard') }}"><i><img src="assets/images/people_dashboard.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/mycontacts') }}"><i><img src="assets/images/people_contact.svg"/></i><span class="menu-item-text">Contacts</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/lists/') }}"><i><img src="assets/images/people_list.svg"/></i><span class="menu-item-text">Lists</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/segments') }}"><i><img src="assets/images/people_segment.svg"/></i><span class="menu-item-text">Segments</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/tags/') }}"><i><img src="assets/images/people_tags.svg"/></i><span class="menu-item-text">Tags</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/deals') }}"><i><img src="assets/images/people_deals.svg"/></i><span class="menu-item-text">Deals</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/companies') }}"><i><img src="assets/images/people_companies.svg"/></i><span class="menu-item-text">Companies</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/configuration') }}"><i><img src="assets/images/people_configuration.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
                <hr>
                <div class="title-box-mid">
                    <h6 class="menu-title">CAMPAIGNS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_blue.svg"/></i><span class="menu-item-text">McDonald's</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_orange.svg"/></i><span class="menu-item-text">Mitsubishi</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_yellow.svg"/></i><span class="menu-item-text">Louis Vuitton</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_green.svg"/></i><span class="menu-item-text">The Walt  Company </span></a></li>
                </ul>

                <hr>
                <div class="title-box-mid">
                    <h6 class="menu-title">CONTACTS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/user1_20.png"/></i><span class="menu-item-text">Tanya Warren</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/user2_20.png"/></i><span class="menu-item-text">Colleen Jack Watson</span></a></li>
                </ul>
            </div>

            <!--************
             LIVE MESSANGER
           *************-->
            <div id="live_messanger" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Live Messanger</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link loadChatTheme" href="{{ url('#/chat/dashbaord') }}"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link loadChatTheme" href="{{ url('#/chat/web') }}"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Web Chat</span></a></li>
                    <li class="nav-item"><a class="nav-link loadChatTheme" href="{{ url('#/chat/sms') }}"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">SMS Chat</span></a></li>
                    <li class="nav-item"><a class="nav-link loadChatTheme" href="{{ url('#/chat/shortcuts') }}"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Chat Shortcut</span></a></li>
                </ul>
            </div>

            <!--************
             EMAIL INBOX
           *************-->
            <div id="Email_inbox" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Email Inbox</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/subs-icon.svg"/></i><span class="menu-item-text">Subscribers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>

            <!--************
             BRAND PAGE
           *************-->
            <div id="BrandPage" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Brand Page</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/brand/settings') }}"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Brand Settings</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/brand/configuration') }}"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Universal Brand Page</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/brand/configuration/single') }}"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Universal Brand Page</span></a></li>
                </ul>
            </div>

            <!--************
             REVIEW
           *************-->
            <div id="ReviewSystem" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">REVIEWS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link active loadReviewsTheme" href="{{ url('#/reviews/dashboard') }}"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/reviews/onsite') }}"><i><img src="assets/images/campaign_home.svg"/></i><span class="menu-item-text">Onsite Campaigns</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/brandboost/reviews/onsite/requests') }}"><i><img src="assets/images/add-box-line.svg"/></i><span class="menu-item-text">Onsite Review Requests</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/brandboost/reviews') }}"><i><img src="assets/images/add-box-line.svg"/></i><span class="menu-item-text">Onsite Review Feeds</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/reviews/onsite/widgets') }}"><i class="ri-arrow-left-up-line"></i><span class="menu-item-text">Widgets</span></a></li>
                    {{--<li class="nav-item"><a class="nav-link" href="{{ url('#/brandboost/review_feedback') }}"><i><img src="assets/images/star-line-dark.svg"/></i><span class="menu-item-text">Reviews Feed</span></a></li>--}}
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/reviews/offsite') }}"><i><img src="assets/images/campaign_home.svg"/></i><span class="menu-item-text">Offsite Campaigns</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/brandboost/review_request/offsite') }}"><i><img src="assets/images/add-box-line.svg"/></i><span class="menu-item-text">Offsite Review Requests</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/brandboost/offsite/feedbacks/') }}"><i><img src="assets/images/add-box-line.svg"/></i><span class="menu-item-text">Offsite Feedbacks</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/reviews/onsite/media') }}"><i><img src="assets/images/file-4-line.svg"/></i><span class="menu-item-text">Media</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="{{ url('#/reviews/onsite/workflow') }}"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="javascript:void(0)"><i><img src="assets/images/pie-chart-line.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link loadReviewsTheme" href="javascript:void(0)"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
                <div class="title-box-mid">
                    <h6 class="menu-title">CAMPAIGNS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i><img src="assets/images/Ellipse_blue.svg"/></i><span class="menu-item-text">Top Campaign</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i><img src="assets/images/Ellipse_orange.svg"/></i><span class="menu-item-text">Email New Broadcast</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i><img src="assets/images/Ellipse_green.svg"/></i><span class="menu-item-text">Automated Email Ou...</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i><img src="assets/images/Ellipse_blue2.svg"/></i><span class="menu-item-text">Weekly Newslatter  </span></a></li>
                </ul>
            </div>

            <!--************
             MEDIA GALLERY
           *************-->
            <div id="MediaGalleries" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Media Galleries</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email_campaign-icon.svg"/></i><span class="menu-item-text">Email Campaigns</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="template.php"><i><img src="assets/images/subs-icon.svg"/></i><span class="menu-item-text">Subscribers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>

            <!--************
             Email Marketing
           *************-->
            <div id="EmailMarketing" class="main-icon-menu-pane email">
                <div class="title-box">
                    <h6 class="menu-title">Email Marketing</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('#/modules/emails/dashboard') }}"><i><img src="assets/images/Email_home08.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/emails/broadcast') }}"><i><img src="assets/images/email_campaign-icon.svg"/></i><span class="menu-item-text">Email Campaigns</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/emails/subscribers') }}"><i><img src="assets/images/account-circle-line.svg"/></i><span class="menu-item-text">Subscribers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/emails/templates') }}"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="jasvascript:void(0);"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/emails/workflow') }}"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="jasvascript:void(0);"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="jasvascript:void(0);"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
                <hr>
                <div class="title-box-mid">
                    <h6 class="menu-title">CAMPAIGNS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_blue.svg"/></i><span class="menu-item-text">Top Campaign</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_orange.svg"/></i><span class="menu-item-text">Email New Broadcast</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_green.svg"/></i><span class="menu-item-text">Automated Email Ou...</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_blue2.svg"/></i><span class="menu-item-text">Weekly Newslatter  </span></a></li>
                </ul>
            </div>

            <!--************
             SMS Marketing
           *************-->
            <div id="SMSMarketing" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">SMS Marketing</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('#/modules/sms/dashboard') }}"><i><img src="assets/images/Email_home08.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/sms/broadcast') }}"><i><img src="assets/images/email_campaign-icon.svg"/></i><span class="menu-item-text">SMS Campaigns</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/sms/templates') }}"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">SMS Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/sms/subscribers') }}"><i><img src="assets/images/account-circle-line.svg"/></i><span class="menu-item-text">Subscribers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/sms/workflow') }}"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="jasvascript:void(0);"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="jasvascript:void(0);"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
                <hr>
                <div class="title-box-mid">
                    <h6 class="menu-title">CAMPAIGNS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_blue.svg"/></i><span class="menu-item-text">Top Campaign</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_orange.svg"/></i><span class="menu-item-text">Email New Broadcast</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_green.svg"/></i><span class="menu-item-text">Automated Email Ou...</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/Ellipse_blue2.svg"/></i><span class="menu-item-text">Weekly Newslatter  </span></a></li>
                </ul>

            </div>

            <!--************
             Referrals
           *************-->
            <div id="Referrals" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Referrals</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/referral/overview') }}"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/referral/') }}"><i><img src="assets/images/email_campaign-icon.svg"/></i><span class="menu-item-text">Referral Programs</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ url('#/modules/referral/') }}"><i><img src="assets/images/subs-icon.svg"/></i><span class="menu-item-text">Advocates</span></a></li>
                </ul>
            </div>

            <!--************
             Nps
           *************-->
            <div id="Nps" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Nps</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/nps/overview') }}"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/nps/') }}"><i><img src="assets/images/email_campaign-icon.svg"/></i><span class="menu-item-text">Campaigns</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ url('#/modules/nps/') }}"><i><img src="assets/images/subs-icon.svg"/></i><span class="menu-item-text">Score/Feedbacks</span></a></li>
                </ul>
            </div>

            <!--************
             Site Widgets
           *************-->
            <div id="SiteWidgets" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Site Widgets</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/widgets/onsite') }}"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Onsite Widgets</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/chat') }}"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Chat Widgets</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/nps/widgets') }}"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">NPS Widgets</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/referral/widgets') }}"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Referral Widgets</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/modules/mediagallery') }}"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Mediagallery Widgets</span></a></li>
{{--                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/home-con.svg"/></i><span class="menu-item-text">Dashboard</span></a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email_campaign-icon.svg"/></i><span class="menu-item-text">Email Campaigns</span></a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>--}}
                </ul>
            </div>

            <!--************
             Feed back
           *************-->
            <div id="Feedback" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Feed back</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>

            <!--************
             Help Desk
           *************-->
            <div id="HelpDesk" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Help Desk</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>

            <!--************
             Knowledge Base
           *************-->
            <div id="KnowledgeBase" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Knowledge Base</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>

            <!--************
            Appointments
          *************-->
            <div id="Appointments" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Appointments</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>


            <!--************
             Analytics
           *************-->
            <div id="Analytics" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Analytics</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>


            <!--************
             Settings
           *************-->
            <div id="Settings" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Settings</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i><span class="menu-item-text">Email Templates</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i><span class="menu-item-text">Forms</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i><span class="menu-item-text">Workflows</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i><span class="menu-item-text">Analytics</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i><span class="menu-item-text">Configuration</span></a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
