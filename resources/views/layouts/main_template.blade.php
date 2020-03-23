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
    <style>
        .loading_svg svg path,
        .loading_svg svg rect{
            fill: #FF6700;
        }
    </style>

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
            <router-view>
                <div style="width:100%;text-align:center;margin-top:30px;"  class="loading_svg">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px"
                         width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;display:block;margin:0 auto;" xml:space="preserve">
    <rect x="0" y="0" width="4" height="10" fill="#333">
        <animateTransform attributeType="xml"
                          attributeName="transform" type="translate"
                          values="0 0; 0 20; 0 0"
                          begin="0" dur="0.6s" repeatCount="indefinite"/>
    </rect>
                        <rect x="10" y="0" width="4" height="10" fill="#333">
                            <animateTransform attributeType="xml"
                                              attributeName="transform" type="translate"
                                              values="0 0; 0 20; 0 0"
                                              begin="0.2s" dur="0.6s" repeatCount="indefinite"/>
                        </rect>
                        <rect x="20" y="0" width="4" height="10" fill="#333">
                            <animateTransform attributeType="xml"
                                              attributeName="transform" type="translate"
                                              values="0 0; 0 20; 0 0"
                                              begin="0.4s" dur="0.6s" repeatCount="indefinite"/>
                        </rect>
  </svg>
                </div>
            </router-view>
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
<script src="{{ base_url() }}assets/js/touchspin.min.js"></script>
<script src="{{ base_url() }}assets/dropzone-master/dist/dropzone.js"></script>
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

    var clicked = false, clickY;
    $(document).on({
        'mousemove': function(e) {
            clicked && updateScrollPos(e);
        },
        'mousedown': function(e) {
            clicked = true;
            clickY = e.pageY;
        },
        'mouseup': function() {
            clicked = false;

        }
    });

    var updateScrollPos = function(e) {
        $(window).scrollTop($(window).scrollTop() + (clickY - e.pageY));
    }

    function loadWorkflowDraggerScript(){
        var Draggable = function (id) {
            var el = document.getElementById(id),
                isDragReady = false,
                dragoffset = {
                    x: 0,
                    y: 0
                };
            this.init = function () {
                //only for this demo
                this.initPosition();
                this.events();
            };
            //only for this demo
            this.initPosition = function () {
                el.style.position = "absolute";
                el.style.top = "0";
                el.style.left = "36%";
            };
            //events for the element
            this.events = function () {
                var self = this;
                _on(el, 'mousedown', function (e) {
                    isDragReady = true;
                    //corssbrowser mouse pointer values
                    e.pageX = e.pageX || e.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
                    e.pageY = e.pageY || e.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
                    dragoffset.x = e.pageX - el.offsetLeft;
                    dragoffset.y = e.pageY - el.offsetTop;
                });
                _on(document, 'mouseup', function () {
                    isDragReady = false;
                });
                _on(document, 'mousemove', function (e) {
                    if (isDragReady) {
                        e.pageX = e.pageX || e.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
                        e.pageY = e.pageY || e.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
                        // left/right constraint
                        if (e.pageX - dragoffset.x < 0) {
                            offsetX = 0;
                        } else if (e.pageX - dragoffset.x + 102 > document.body.clientWidth) {
                            offsetX = document.body.clientWidth - 102;
                        } else {
                            offsetX = e.pageX - dragoffset.x;
                        }

                        // top/bottom constraint
                        if (e.pageY - dragoffset.y < 0) {
                            offsetY = 0;
                        } else if (e.pageY - dragoffset.y + 102 > document.body.clientHeight) {
                            offsetY = document.body.clientHeight - 102;
                        } else {
                            offsetY = e.pageY - dragoffset.y;
                        }

                        el.style.top = offsetY + "px";
                        el.style.left = offsetX + "px";
                    }
                });
            };
            //cross browser event Helper function
            var _on = function (el, event, fn) {
                document.attachEvent ? el.attachEvent('on' + event, fn) : el.addEventListener(event, fn, !0);
            };
            this.init();
        }

        new Draggable('workflow_box9');
    }


function helloTest(){
    alert('Hola Amigo');
    }

</script>
<script>
    $(document).ready(function(){
        $("#loadSMSTheme").click(function(){
            document.querySelector("body").id="SMSSection";
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        });
        $("#loadEmailTheme").click(function(){
            document.querySelector("body").id="EmailSection";
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        });
        $("#loadContactTheme").click(function(){
            document.querySelector("body").id="PeopleSection";
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        });
        $(".loadChatTheme").click(function(){
            document.querySelector("body").id="LiveChatSection";
            document.querySelector("body").classList.add("pagewithleftsidebar");
            document.querySelector(".page-content").classList.add("bkg_light_000");
        });
        $(".loadReviewsTheme").click(function(){
            document.querySelector("body").id="ReviewSection";
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        });
        $("#loadDasboard").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadContactTheme").click(function(){
            window.location.href='#/contacts/dashboard';
        });
        $("#loadChatTheme").click(function(){
            window.location.href='#/chat/dashbaord';
        });
        $("#loadEmailInbox").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadBrandPage").click(function(){
            window.location.href='#/brand/settings';
        });
        $("#loadReviewsTheme").click(function(){
            window.location.href='#/reviews/dashboard';
        });
        $("#loadMediaGallery").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadEmailTheme").click(function(){
            window.location.href='#/modules/emails/dashboard';
        });
        $("#loadSMSTheme").click(function(){
            window.location.href='#/modules/sms/dashboard';
        });
        $("#loadReferral").click(function(){
            window.location.href='#/modules/referral/overview';
        });
        $("#loadNps").click(function(){
            window.location.href='#/modules/nps/overview';
        });
        $("#loadWidgets").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadFeedback").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadHelpDesk").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadKnowledgeBase").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadAppointments").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadAnalytics").click(function(){
            //window.location.href='#/reviews/dashboard';
        });
        $("#loadSettings").click(function(){
            //window.location.href='#/reviews/dashboard';
        });



    });

    function setMenuItemsActive(){
        $(".main-icon-menu-pane").removeClass("active");
        $(".nav-link").removeClass("active");
        var uriPath = window.location.hash;
        if(uriPath.indexOf('modules/sms') != -1){
            $("#SMSMarketing").addClass("active");
            $("#loadSMSTheme").addClass("active");
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        }else if(uriPath.indexOf('modules/emails') != -1){
            $("#EmailMarketing").addClass("active");
            $("#loadEmailTheme").addClass("active");
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        }
        else if(uriPath.indexOf('/reviews/') != -1){
            $("#ReviewSystem").addClass("active");
            $("#loadReviewsTheme").addClass("active");
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        }
        else if(uriPath.indexOf('/contacts/') != -1){
            $("#people").addClass("active");
            $("#loadContactTheme").addClass("active");
            document.querySelector(".page-content").classList.remove("bkg_light_000");
        }
        else if(uriPath.indexOf('/chat/') != -1){
            $("#live_messanger").addClass("active");
            $("#loadChatTheme").addClass("active");
            document.querySelector("body").id="LiveChatSection";
            document.querySelector("body").classList.add("pagewithleftsidebar");
            /*document.querySelector(".page-content").classList.add("bkg_light_000");*/
        }

    }
    setMenuItemsActive();
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        var widgetScript = String($(element).text());
        $temp.val(widgetScript).select();
        if(document.execCommand("copy")){
            alert('code copied to clipboard successfully')
        }else{
            alert('something went wrong, try again');
        }
        $temp.remove();
    }
</script>



</body>
</html>

