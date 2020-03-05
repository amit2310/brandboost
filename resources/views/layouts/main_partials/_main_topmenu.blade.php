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
                {{--<li class="hide-phone app-search">
                    <form role="search" class="">
                        <input type="text" placeholder="Search..." class="form-control">
                    </form>
                </li>--}}

                <li class="dropdown icons"><a class="nav-link dropdown-toggle waves-effect waves-light nav-user top-icons-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img class="hide_993" src="assets/images/add-circle-line-grey.svg" alt="profile-user"> <img class="visible_993" src="assets/images/add-circle-line-grey.svg" alt="profile-user"> </a>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                </li>

                <li class="dropdown icons"><a class="nav-link dropdown-toggle waves-effect waves-light nav-user top-icons-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img class="hide_993" src="assets/images/search-2-line.svg" alt="profile-user"> <img class="visible_993" src="assets/images/search-2-line.svg" alt="profile-user"> </a>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
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
                        <a class="dropdown-item" href="{{ url('#/profile/') }}"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
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

<!--===================
 RIGHT SIDE CHAT AREA
====================-->
<div class="mini_chat">
    <div class="nav_dot chatboxopen">
        <i class="ri-more-fill"></i>
    </div>
    <ul class="chat_user">
        <li class="chatboxopen"><a href="#"><span class="chat_notification">2</span><img src="assets/images/avatar/01.png"/></a></li>
        <li class="chatboxopen"><a href="#"><span class="chat_notification">5</span><img src="assets/images/avatar/02.png"/></a></li>
        <li class="chatboxopen"><a href="#"><img src="assets/images/avatar/03.png"/></a></li>
        <li class="chatboxopen"><a class="active" href="#"><img src="assets/images/avatar/04.png"/></a></li>
        <li class="chatboxopen"><a href="#"><img src="assets/images/avatar/05.png"/></a></li>
        <li class="chatboxopen"><a href="#"><img src="assets/images/avatar/06.png"/></a></li>
        <li class="chatboxopen"><a href="#"><img src="assets/images/avatar/07.png"/></a></li>
        <li class="chatboxopen"><a href="#"><img src="assets/images/avatar/08.png"/></a></li>
        <li class="chatboxopen"><a href="#"><img src="assets/images/avatar/09.png"/></a></li>
        <li class="chatboxopen"><a href="#"><span class="chat_notification">3</span><img src="assets/images/avatar/10.png"/></a></li>
        <li class="chatboxopen"><a href="#"><img src="assets/images/sidebar_chat_add_circle_32.svg"/></a></li>
    </ul>
</div>

<div class="rightchatarea">
    <div class="p25">
        <div class="heading_area bbot">
            <div class="userinfosec float-left">
                <h3 class="htxt_medium_18 dark_800 mb-1">Norma Alexander</h3>
                <p class="htxt_medium_12 dark_200 ls_4">(702) 555-0122</p>
            </div>
            <div class="action_area float-right">
                <a class="mr-1" href="#"><img src="assets/images/chat_circle_more.svg"/></a>
                <a class="chatboxopen" href="#"><img src="assets/images/chat_close_circle.svg"/></a>
            </div>
            <div class="clearfix"></div>
        </div>


    </div>

    <div class="p0 h-100">
        <div class="users_chat_area">

            <div class="mainchatsvroll2">
                <ul class="media-list chat-list">

                    <li class="media">
                        <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/02.png" class="img-circle img-xxs" alt=""></span>
                            <div class="media-content">👋  hi!</div>
                            <div class="media-content">thanks you for work list</div>
                            <div class="media-content date_time">10:59 AM <i class="ri-check-line green_400"></i></div>
                        </div>
                    </li>
                    <li class="media reversed">
                        <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><!--<img src="assets/images/avatar/01.png" class="img-circle img-xxs" alt=""> -->
     <a href="#" class="icons fl_letters m0 s24">a</a></span>
                            <div class="media-content"> 🎉️ hi!</div>
                            <div class="media-content">thanks you for work list</div>
                            <div class="media-content date_time">10:59 AM <i class="ri-check-double-line green_400"></i></div>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/02.png" class="img-circle img-xxs" alt=""></span>
                            <div class="media-content">thanks you for work list </div>
                            <div class="media-content">Officia pariatur magna adipisici</div>
                            <div class="media-content">Cillum quis tempor </div>
                            <div class="media-content">Duis dolor officia cillum esse </div>
                            <div class="media-content date_time">10:59 AM <i class="ri-check-line green_400"></i></div>
                        </div>
                    </li>
                    <li class="media reversed">
                        <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><!--<img src="assets/images/avatar/01.png" class="img-circle img-xxs" alt="">-->
     <a href="#" class="icons fl_letters m0 s24">a</a></span>
                            <div class="media-content">Cillum nulla irure.</div>
                            <div class="media-content">Adson. </div>
                            <div class="media-content date_time">10:59 AM <i class="ri-check-double-line green_400"></i></div>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/02.png" class="img-circle img-xxs" alt=""></span>
                            <div class="media-content">thanks you for work list</div>
                            <div class="media-content date_time">10:59 AM <i class="ri-check-double-line green_400"></i></div>
                        </div>
                    </li>
                    <li class="media reversed">
                        <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><!--<img src="assets/images/avatar/01.png" class="img-circle img-xxs" alt="">-->
     <a href="#" class="icons fl_letters m0 s24">a</a></span>
                            <div class="media-content"> Cillum nulla irure.</div>
                            <div class="media-content date_time">10:59 AM</div>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </div>


    <div class="p25 pt0 btop chat_reply_area">
        <div class="bbot">
            <textarea class="pt25 w-100 border-0 fsize14 dark_200" style="height: 65px; resize: none;">Shift + Enter to add a new line</textarea>
        </div>
        <div class="pt15">
            <div class="row">
                <div class="col-md-2">
                    <div class="action_list">
                        <ul>
                            <li><a class="active" href="#"><img src="assets/images/message-2-line-blue.svg"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="action_list">
                        <!--*****EMOJI*****-->
                        <div class="chat_emoji_box_small">
                            <div class="form-group">
                                <input type="text" class="form-control search fsize13 h48" placeholder="Search template" />
                            </div>
                            <div class="emoji_box mb20">
                                <p class="htxt_medium_15 dark_800 mb-1 fw500">Recent</p>
                                <ul class="emojisec">
                                    <li><a href="#"><img src="assets/images/emojie-eye-face-joke-tongue-wink-emoji-stuckout-37676.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-hand-medium-skin-tone-v-victory-37773.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-angry-face-mad-pouting-rage-red-emoji-37653.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-biceps-comic-flex-medium-skin-tone-muscle-37748.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-face-mouth-open-sympathy-emoji-37685.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-bright-cool-eye-eyewear-face-glasses-smile-sun-sunglasses-emoji-37654.svg"/></a></li>
                                </ul>
                            </div>
                            <div class="emoji_box mb20">
                                <p class="htxt_medium_15 dark_800 mb-1 fw500">Smiles & People</p>
                                <ul class="emojisec">
                                    <li><a href="#"><img src="assets/images/emojie-eye-face-joke-tongue-wink-emoji-stuckout-37676.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-expressionless-face-inexpressive-unexpressive-emoji-37678.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-face-unamused-unhappy-angry-emoji-37702.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-face-sleep-emoji-tired-37692.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-face-sleep-zzz-tired-bore-emoji-37691.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-face-tongue-stuck-out-emoji-37695.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-face-kiss-flirt-emoji-37697.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-grinning-face-with-smiling-eyes-happy-emoji-37710.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-delicious-face-savouring-smile-um-yum-eye-emoji-37671.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-dizzy-face-error-emoji-37670.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-confounded-face-sad-cry-unhappy-emoji-37707.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-cold-face-open-smile-sweat-happy-emoji-37709.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-disappointed-face-sad-emoji-37669.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-expressionless-face-inexpressive-unexpressive-emoji-37678.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-eye-face-love-smile-heart-emoji-37674.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-angry-face-mad-emoji-37652.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-angry-face-mad-pouting-rage-red-emoji-37653.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-hand-medium-skin-tone-wave-waving-37774.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-clenched-fist-hand-medium-light-skin-tone-punch-37735.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-backhand-down-finger-hand-index-medium-light-skin-tone-point-37723.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-biceps-comic-flex-medium-skin-tone-muscle-37748.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-backhand-finger-hand-index-medium-light-skin-tone-point-up-37722.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-clap-hand-medium-skin-tone-37733.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-hand-medium-light-skin-tone-thumb-up-37775.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-cat-face-mouth-open-smile-emoji-37664.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-cat-face-joy-tear-happy-emoji-37666.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-cat-face-mouth-open-smile-emoji-37664.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/emojie-cat-face-ironic-smile-wry-emoji-37662.svg"/></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--*****SAVED MESSAGE*****-->
                        <div class="chat_saved_temp_small">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control search fsize13 h48" placeholder="Search template" />
                                    </div>
                                    <div class="col-md-2 pl-0">
                                        <button class="btn_plus_icon slidebox"><img src="assets/images/add-fill.svg"/></button>
                                    </div>
                                </div>
                            </div>
                            <div class="savedchat mb-2">
                                <p class="htxt_medium_16 dark_800 mb-2">Review invite</p>
                                <p class="htxt_regular_14 dark_200">Hi, :contact:! Thank you for choosing :location:. Could you take a 30 seconds to leave us a review...</p>
                            </div>
                            <div class="savedchat mb-2">
                                <p class="htxt_medium_16 dark_800 mb-2">Say friendly thanks</p>
                                <p class="htxt_regular_14 dark_200">Thanks so much for the review :contact:! Feel free to text this number anytime and we’ll be happy to...</p>
                            </div>
                            <div class="savedchat">
                                <p class="htxt_medium_16 dark_800 mb-2">Feedback invite</p>
                                <p class="htxt_regular_14 dark_200">Hi, :contact:! On scale from 1-10, how satisfied were you with your product or service?</p>
                            </div>
                        </div>
                        <ul>
                            <li><a class="show_emoji_small" href="#"><img src="assets/images/user-smile-line.svg"></a></li>
                            <li><a class="show_saved_chat_small" href="#"><img src="assets/images/clipboard-line.svg"></a></li>
                            <li><a href="#"><img src="assets/images/Image_18.svg"></a></li>
                            <li><a href="#"><img src="assets/images/attachment-line.svg"></a></li>
                            <li><a href="#"><img src="assets/images/add-circle-line.svg"></a></li>
                            <li><a href="#"><img src="assets/images/submit_btn_icon.svg"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
