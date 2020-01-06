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
<div class="topbar">
    <nav class="navbar-custom">
        <div class="">

            <span class="mobile-menu-control float-left"><img src="{{ URL::asset('assets/images/close_menu_circle.svg') }}"></span>

            <ul class="list-unstyled topbar-nav float-right mb-0" >
                <li class="hide-phone app-search">
                    <form role="search" class="">
                        <input type="text" placeholder="Search..." class="form-control">
                    </form>
                </li>


                <li class="dropdown icons"><a class="nav-link dropdown-toggle waves-effect waves-light nav-user top-icons-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img class="hide_993" src="{{ URL::asset('assets/images/book-next-page.svg') }}" alt="profile-user"> <img class="visible_993" src="assets/images/book-next-page-white.svg" alt="profile-user"> </a>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                </li>


                <li class="dropdown icons"><a class="nav-link dropdown-toggle waves-effect waves-light nav-user top-icons-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img class="hide_993" src="{{ URL::asset('assets/images/messages-bubble-typing-1.svg') }}" alt="profile-user"> <img class="visible_993" src="assets/images/messages-bubble-typing-1-white.svg" alt="profile-user"> </a>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                </li>

                <li class="dropdown icons">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user top-icons-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img class="hide_993 float-left" src="{{ URL::asset('assets/images/alarm-bell.svg') }}" alt="notifications"> <img class="visible_993 float-left" src="{{ URL::asset('assets/images/alarm-bell-white.svg') }}" alt="Notifications">
                        <span class="badge badge-grey top-bar">{{ $unreadNotificationCount }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
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

                <li class="dropdown ml-2">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ $srcUserImg }}" alt="profile-user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ url('/admin/profile/') }}"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                        <a class="dropdown-item" href="{{ url('/admin/accounts/usage') }}"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a>
                        <a class="dropdown-item" href="{{ url('/admin/invoices/view/'.$aUInfo->id.'') }}"><i class="dripicons-wallet text-muted mr-2"></i> Invoices</a>
                        <a class="dropdown-item" href="{{ url('/admin/settings/') }}"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/admin/login/logout/') }}"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                    </div>
                </li>


            </ul>
            <!--end topbar-nav-->
            <div id="breadcrumb">
                <ul class="list-unstyled topbar-nav top-breadcrumb float-left mt8 mb-0">
                    <li>
                        <a href="#"><img src="{{ URL::asset('assets/images/mail-open-line.svg') }}"/> &nbsp;Home</a>
                    </li>

                    <li class="ml10 mr10">
                        <img src="{{ URL::asset('assets/images/chevron-left.svg') }}"/>
                    </li>

                    <li>
                        <a href="#"><img src="{{ URL::asset('assets/images/mail-open-line.svg') }}"/> &nbsp;People</a>
                    </li>

                    <li class="ml10 mr10">
                        <img src="{{ URL::asset('assets/images/chevron-left.svg') }}"/>
                    </li>

                    <li>
                        Dashboard
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>


    </nav>
</div>
