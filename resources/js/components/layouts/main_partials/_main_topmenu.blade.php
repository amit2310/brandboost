<div id="header-sroll" class="navbar navbar-default header-highlight">
    <div class="navbar-header"> <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ URL::asset('assets/images/brand_boost_logo_new.png') }}" alt=""></a>
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a> </li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-three-bars"></i></a> </li>
        </ul>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">

        <ul class="nav navbar-nav hidden-xs">
            <li><a class="sidebar-control sidebar-main-toggle left hidden-xs"><i class="icon-arrow-left22"></i></a> </li>
        </ul>

         @if(isset($pagename))
			{!! $pagename !!}
         @endif
        <ul class="nav navbar-nav navbar-right">

            <!--===========SEARCH============-->
            <li class="header_search hidden-xs">
                <div class="input-group">
                    <input onfocus="this.placeholder = ''"  type="text" class="form-control input-lg txtShowDiv" id="myInput">
                </div>

                <div class="sampleDiv">
                    <ul>
                        <li><a href="#"><i class="icon-cog5"></i> <span class="txt_purple">Mail Product Boost</span> Campaign</a></li>
                        <li><a href="#"><i class="icon-cog5"></i> <span class="txt_purple">Mail Product Boost</span> New Campaign</a></li>
                        <li><a href="#"><i class="icon-cog5"></i> <span class="txt_purple">Mail Product Boost</span> Review</a></li>
                        <li><a href="#"><span class="grey"><i class="icon-cog5"></i> Press enter to see all results</span></a></li>
                    </ul>
                </div>
            </li>


            <!--===========COMPANY  PROFILE============-->
            <li class="dropdown dropdown-user left hidden-xs company_profile">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ URL::asset('assets/images/wakerslogo.png') }}" alt="">
                    <span>Wakers Inc.</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right width_170 company_profile">
                    <li><a class="active big " href="#"><span class="pull-left"><img src="{{ URL::asset('assets/images/company_profile.png') }}" alt=""> &nbsp; &nbsp;  Wakers Inc. </span> <i class="icon-primitive-dot m0 pull-right"></i> </a>  </li>
                    <li><a class="big" href="#"><span class="pull-left"><img src="{{ URL::asset('assets/images/google_company.png') }}" alt=""> &nbsp; &nbsp;  Google </span> <i class="icon-primitive-dot m0 pull-right"></i></a> </li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-plus-circle2 fsize16"></i> Add new account  </a> </li>
                </ul>
            </li>

            <!--===========Upgrade Account============-->

            <li class="dropdown hidden-xs">
                <a class="dropdown-toggle pl20">
                    <i class="icon-coins"></i> {{ (!empty($aUInfo->credits->total_credits)) ? number_format($aUInfo->credits->total_credits) . ' Credits' : 0 . ' Credits' }}
                </a>

            </li>

            @if (!empty($oCurrentPlanData))
                <li class="hbr">
                    <a id="showupgradePopup" class="btn bl_cust_btn btn-default upgrade_btn" data-toggle="modal" data-target="#upgrade_popup2"><img width="18" src="{{ URL::asset('assets/images/upgrade_account_icon.png') }}"/>&nbsp; Upgrade <span class="hidetab">Account</span></a>
                </li>
            @endif

            <!--===========Documentation BOOK ICON============-->
            <li class="dropdown hidden-xs documentation">
                <a style="padding: 17px!important;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ URL::asset('assets/images/book.png') }}" alt="" width="17">
                </a>
                <ul style="left: 50%; margin-left: -90px;" class="dropdown-menu dropdown-menu-right width_170">
                    <li><a class="active" data-toggle="modal" data-target="#tutorialspopup1"><i class="icon-user-plus"></i> Documentation</a> </li>
                    <li><a href="#"><i class="icon-coins"></i> FAQ</a> </li>
                    <li><a href="#"><i class="icon-switch2"></i> Support</a> </li>
                </ul>
            </li>
            <!--===========NOTIFICATIONS BELL============-->
            @php
            $oSysNotifications = get_notifications();
            if (!empty($oSysNotifications)) {
                $unreadNotificationCount = 0;
                foreach ($oSysNotifications as $oNotify) {
                    if ($oNotify->status == 0) {
                        $unreadNotificationCount++;
                    }
                }
            }
            @endphp
            <!--===========NOTIFICATIONS BELL============-->
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle top_notify_icon notification-smart-popup" data-toggle="dropdown"> <i class="icon-bell2"></i>  <span class="badge bg-warning-400 notify">{{ $unreadNotificationCount }}</span> </a>
                <div style="left: 50%; margin-left: -137px;" class="dropdown-menu dropdown-content width_275 p0 hidden">
                    <div class="dropdown-content-heading"> Notifications <span class="badge bkg_purple ml10">{{ $unreadNotificationCount }}</span>
                        <ul class="icons-list">
                            <li><a href="javascript:void(0);" class="readAllNotification"><i class="icon-checkmark3"></i></a> </li>
                            <li><a href="{{base_url() }}admin/settings/?t=notify"><i class="icon-cog2"></i></a> </li>
                        </ul>
                    </div>
                    <ul class="media-list dropdown-content-body">

                        @if(empty($oSysNotifications))
                            <li class="media text-center">
                                <i>No Notification(s) Found</i>
                            </li>
                        @else
                            @php
                            $aSysNotifyTags = get_notification_tags();
                            if (!empty($oSysNotifications)) {
                                $initFlag = 0;
                                foreach ($oSysNotifications as $oSysNotify) {
                                    $initFlag++;
                                    if ($initFlag <= 5) {
                                        if(isset($aSysNotifyTags[$oSysNotify->event_type])){
                                            $oNotification = $aSysNotifyTags[$oSysNotify->event_type];
                                        }else{
                                            $oNotification = '';
                                        }


                                        if (!empty($oNotification)) {
                                            $messageTitle = $oNotification->title;
                                            $msgNotify = ($userRole == '1') ? $oNotification->tag_language_admin : $oNotification->tag_language;
                                            $iconNotify = ($oNotification->icon) ? $oNotification->icon : 'icon-stack-text txt_purple';
                                            $link = $oSysNotify->link;
                                            $readStatus = $oSysNotify->status;
                                            $notifyDate = date('h:iA d M Y', strtotime($oSysNotify->created));

                                            if ($oNotification->template_tag == 'added_offsite_brandboost') {
                                                $iconNotify = 'icon-enter2 txt_dblue';
                                            } else if ($oNotification->template_tag == 'added_onsite_questions') {
                                                $iconNotify = 'icon-envelop txt_blue';
                                            } else {
                                                $iconNotify = "icon-stack-text txt_purple";
                                            }
                                        } else {

                                            $messageTitle = $oSysNotify->message;
                                            $msgNotify = $oSysNotify->message;
                                            $iconNotify = 'icon-stack-text txt_purple';
                                            $link = $oSysNotify->link;
                                            $readStatus = $oSysNotify->status;
                                            $notifyDate = date('h:iA d M Y', strtotime($oSysNotify->created));
                                        }
                                        @endphp
                                        <li class="media">
                                            <div class="media-left pr15">  <a class="icons" href="javascript:void(0);"><i class="{{ $iconNotify }} "></i></a> </div>
                                            <div class="media-body">
                                                <a target="_blank" href="javascript:void(0);" data-redirect="{{ $oSysNotify->link }}" data-notifyid="{{ $oSysNotify->id }}" class="media-heading {{ ($readStatus == '0') ? 'fw700' : '' }} readNotification ">
                                                    <p>{{ $messageTitle }}</p>
                                                    <p class="fsize10 text-muted">{{ setStringLimit($msgNotify, 25) }}</p>
                                                    <p class="fsize10 text-muted"> {{ $notifyDate }}</p>
                                                </a>
                                            </div>
                                        </li>
                                        @php
                                    }
                                }
                            }
                            @endphp
                        @endif
                    </ul>
                    @if (!empty($oSysNotifications))
                        <div class="dropdown-content-footer"> <a href="javascript:void(0);" class="viewAllNotification" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a> </div>
                    @endif
                </div>
            </li>

            <!--===========USER PROFILE============-->
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ $srcUserImg }}" alt="">
                    <span>{{ ($userFirstname != '') ? $userFirstname : '' }}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right width_170">
                    @if (!empty($aTeamInfo))
                        <li><a>(<strong>Logged In As : </strong> {{ $aTeamInfo->firstname . ' ' . $aTeamInfo->lastname }} )</a>
                        </li>
                    @endif
                    <li><a href="{{ url('/admin/profile/') }}"><i class="icon-user-plus"></i> My profile</a>
                    <li><a href="{{ url('/admin/settings/') }}"><i class="fa fa-cog"></i> Account Settings</a></li>
                    <li><a href="{{ url('/admin/accounts/usage') }}"><i class="fa fa-cog"></i> Account Usage</a></li>
                    <li><a href="{{ url('/admin/invoices/view/'.$aUInfo->id.'') }}"><i class="icon-coins"></i> Invoice</a></li>
                    <li><a href="{{ url('admin/settings/?t=prefer') }}"><i class="icon-coins"></i> Preferences</a></li>
                    <li><a href="{{ url('admin/settings/?t=subs') }}"><i class="icon-coins"></i> Subscription</a></li>
                    <li><a href="{{ url('admin/settings/?t=billing') }}"><i class="icon-coins"></i> Billing</a></li>
                    <li><a href="{{ url('admin/settings/?t=notify') }}"><i class="icon-bell3"></i> Notifications</a></li>
                    @if ($userRole == 1)
                        <li><a href="{{ url('/admin/autoresponder/') }}"><i class="icon-comment-discussion"></i> Auto Responder</a>
                        </li>
                    @endif
                    @if ($userRole == 1)
                        <li><a href="{{ url('/admin/popupsettings/') }}"><i class="icon-cog5"></i> Popup settings</a>
                        </li>
                        <li><a href="{{ url('/admin/filesize/') }}"><i class="icon-cog5"></i> Filesize settings</a>
                        </li>
                    @endif
                        <li><a href="{{ url('/admin/login/logout/') }}" class="logoutUser"><i class="icon-switch2"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
