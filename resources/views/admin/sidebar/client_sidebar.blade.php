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
        <nav class="nav">
            <a href="#" class="mb-4" > <img src="assets/images/logo_small.svg"/> </a>
            <a href="#people" class="nav-link active"> <img src="assets/images/01.svg"/> </a>
            <a href="#BrandBoostCrypto" class="nav-link"> <img src="assets/images/02.svg"/> </a>
            <a href="#BrandBoostProject" class="nav-link" > <img src="assets/images/03.svg"/> </a>
            <a href="#BrandBoostEcommerce" class="nav-link" > <img src="assets/images/04.svg"/> </a>
            <a href="#BrandBoostCRM" class="nav-link" > <img src="assets/images/05.svg"/> </a>
            <a href="#BrandBoostOthers" class="nav-link" > <img src="assets/images/06.svg"/> </a>
            <a href="#BrandBoostPages" class="nav-link" > <img src="assets/images/08.svg"/> </a>
            <a href="#BrandBoostAuthentication" class="nav-link" > <img src="assets/images/10.svg"/> </a>
            <a href="#BrandBoostAuthentication1" class="nav-link" > <img src="assets/images/11.svg"/> </a>
            <a href="#BrandBoostAuthentication2" class="nav-link" > <img src="assets/images/12.svg"/> </a>
            <a href="#BrandBoostAuthentication3" class="nav-link" > <img src="assets/images/13.svg"/> </a>
        </nav>
        <!--end nav-->

    </div>
    <!--end main-icon-menu-->
    <div class="main-menu-inner">
        <div class="menu-body slimscroll">

            <span style="position: absolute; top: 20px; right: 20px; width: 48px; height: 36px;" class="button-menu-mobile"><img src="assets/images/menuslidebtn.svg"/></span>

            <span style="position: absolute; top: 17px; right: 20px; transform:rotate(180deg);" class="mobile-menu-control float-left"><img src="assets/images/close_menu_circle.svg"></span>


            <div id="people" class="main-icon-menu-pane active">
                <div class="title-box">
                    <h6 class="menu-title">PEOPLE</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('#/contacts/dashboard') }}"><i><img src="assets/images/home-con.svg"/></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/contacts/mycontacts') }}"><i><img src="assets/images/email_campaign-icon.svg"/></i>Contacts</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{ url('#/lists/') }}"><i><img src="assets/images/people.svg"/></i>Lists</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/broadcast/mysegments') }}"><i><img src="assets/images/email-temp-icon.svg"/></i>Segments</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('#/tags/') }}"><i><img src="assets/images/forms-icon.svg"/></i>Tags</a></li>
                    <li class="nav-item"><a class="nav-link" href="javascript:void(0);"><i><img src="assets/images/workflow-icon.svg"/></i>Deals</a></li>
                    <li class="nav-item"><a class="nav-link" href="javascript:void(0);"><i><img src="assets/images/analytics-icon.svg"/></i>Companies</a></li>
                    <li class="nav-item"><a class="nav-link" href="javascript:void(0);"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
                <hr>
                <div class="title-box-mid">
                    <h6 class="menu-title">CAMPAIGNS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_blue.svg"/></i><span>McDonald's</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_orange.svg"/></i><span>Mitsubishi</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_yellow.svg"/></i><span>Louis Vuitton</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/folder_green.svg"/></i><span>The Walt  Company </span></a></li>
                </ul>

                <hr>
                <div class="title-box-mid">
                    <h6 class="menu-title">CONTACTS</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/user1_20.png"/></i><span>Tanya Warren</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/user2_20.png"/></i><span>Colleen Jack Watson</span></a></li>
                </ul>


            </div>
            <!-- end Analytic -->
            <div id="BrandBoostCrypto" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Open Menu</h6>
                </div>





                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i>Forms</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end Crypto -->
            <div id="BrandBoostProject" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Projects</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/subs-icon.svg"/></i>Subscribers</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i>Email Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i>Forms</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end  Project-->
            <div id="BrandBoostEcommerce" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Ecommerce</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/home-con.svg"/></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email_campaign-icon.svg"/></i>Email Campaigns</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/subs-icon.svg"/></i>Subscribers</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i>Email Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i>Forms</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end Ecommerce -->
            <div id="BrandBoostCRM" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">CRM</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end CRM -->
            <div id="BrandBoostOthers" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Others</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/home-con.svg"/></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email_campaign-icon.svg"/></i>Email Campaigns</a></li>
                    <li class="nav-item"><a class="nav-link active" href="template.php"><i><img src="assets/images/subs-icon.svg"/></i>Subscribers</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i>Email Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i>Forms</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end Others -->
            <div id="BrandBoostPages" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Pages</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/home-con.svg"/></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email_campaign-icon.svg"/></i>Email Campaigns</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/subs-icon.svg"/></i>Subscribers</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i>Email Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i>Forms</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end Pages -->
            <div id="BrandBoostAuthentication" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Authentication</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end Pages -->
            <div id="BrandBoostAuthentication1" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Authentication 1</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/home-con.svg"/></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email_campaign-icon.svg"/></i>Email Campaigns</a></li>
                    <li class="nav-item"><a class="nav-link active" href="template.php"><i><img src="assets/images/subs-icon.svg"/></i>Subscribers</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i>Email Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i>Forms</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end Pages -->
            <div id="BrandBoostAuthentication2" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Authentication 2</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/home-con.svg"/></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email_campaign-icon.svg"/></i>Email Campaigns</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
            <!-- end Pages -->
            <div id="BrandBoostAuthentication3" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Authentication 3</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/email-temp-icon.svg"/></i>Email Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/forms-icon.svg"/></i>Forms</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/workflow-icon.svg"/></i>Workflows</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/analytics-icon.svg"/></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php"><i><img src="assets/images/config-icon.svg"/></i>Configuration</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



