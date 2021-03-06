@extends('layouts.main_template')

@section('title')

@endsection

@section('contents')

    <style>
        @media only screen and (min-width: 993px) and (max-width: 1024px) {
            .panel-body.min_h270.p0 .table {
                max-width: 1000px !important
            }

            @media only screen and (min-width: 768px) and (max-width: 992px) {
                .panel-body.min_h270.p0 .table {
                    max-width: 800px !important;
                }
            }
            @media only screen and (max-width: 767px) {
                .panel-body.min_h270.p0 .table {
                    max-width: 800px !important;
                }
            }
    </style>

    @php
        if (!empty($getMyLists)) {
            foreach ($getMyLists as $key => $value) {
                $aSelectedLists[] = $value->id;
            }
        }
        $aUInfo = $userData;

        //$cb_contact_id = $aUInfo->cb_contact_id;
        $userId = $aUInfo->id;

        if(!empty($aUInfo->avatar)) {
            $avatar = $aUInfo->avatar;
        }
        else {
            $avatar = '';
        }
        if(!empty($aUInfo->user_role)) {
            $userRole = $aUInfo->user_role;
        }
        else {
            $userRole = '';
        }

        if(!empty($aUInfo->address)) {
            $address = $aUInfo->address;
        }
        else {
            $address = '';
        }

        $firstname = $aUInfo->firstname;
        $lastname = $aUInfo->lastname;


        if ($userRole == '1') {

            $roleName = 'Administrator';
        } else if ($userRole == '2') {

            $roleName = 'User';
        } else if ($userRole == '3') {

            $roleName = 'Customer';
        } else {

            $roleName = '';
        }
        $username = $firstname . ' ' . $lastname;
        if (!empty($avatar) && $avatar != 'avatar_image.png') {
            $srcUserImg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $avatar;
        } else {
            $srcUserImg = '/profile_images/avatar_image.png';
        }


        $city = $aUInfo->cityName;
        $state = $aUInfo->stateName;
        $country = $aUInfo->country_code;
        if (empty($country)) {
            $country = 'us';
        }
        $email = $aUInfo->email;
        $mobile = $aUInfo->phone;
        $gender = $aUInfo->gender;

    //pre($aUInfo);

        if (!empty($aUInfo->user_id)) {
            $getNotification = App\Models\Admin\SettingsModel::getNotificationSettings($aUInfo->user_id);
            $getUser = App\Models\Admin\UsersModel::getAllUsers($aUInfo->user_id);
            $getUser = $getUser[0];
        } else {
            $getNotification = '';
            $getUser = '';
        }

        /* if(empty($getClientTags)) {
          $oTags = $this->mTags->getSubscriberTags($aUInfo->id);
          }
          else {
          $oTags = $getClientTags;
          } */

        $oTags = App\Models\Admin\TagsModel::getSubscriberTags($aUInfo->id);

    //pre($oTags);
    //pre($subscribersData);
    //pre($userData);
    //pre($userActivities);
    //echo '-------------------------------';
    @endphp
    <link href="{{ base_url() }}assets/flags/flags.css" rel=stylesheet type="text/css">
    <!-- <div class="content-wrapper people_sec"> -->
    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-5">
                    <h3><i class="icon-envelop5"></i> &nbsp; {{ $username }}</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Profile</a></li>
                        <li><a href="#right-icon-tab1" data-toggle="tab">On Site Reviews</a></li>
                        <li><a href="#right-icon-tab2" data-toggle="tab">Referral Program</a></li>
                        <li><a href="#right-icon-tab3" data-toggle="tab">NPS</a></li>
                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-7 text-right btn_area">
                    @if(!empty($oUser))
                        @if ($oUser->user_role == '1')
                            <button type="button" class="btn light_btn ml20 addManualCredit"
                                    id="{{ base64_url_encode($aUInfo->id) }}"><i
                                    class="icon-star-full2 txt_black"></i><span> &nbsp;  Add Credits</span></button>
                        @endif
                    @endif
                    @if (!empty($email))
                        <a href="mailto:{{ $email }}" class="btn light_btn ml20 pt10"><i
                                class="icon-envelop2"></i><span> &nbsp;   Send email</span> </a>
                    @endif

                    @if (!empty($mobile))
                        <button type="button" class="btn light_btn ml20" id="openNewSMSConversation"
                                subscriber_id="{{ $contactId }}"><i
                                class="icon-bubble2"></i><span> &nbsp;  Send sms</span></button>
                    @endif

                    <button type="button" class="btn light_btn ml20" data-toggle="modal" data-target="#chooselistModal">
                        <i class="icon-list"></i><span> &nbsp;  Add to list</span></button>

                    <button type="button" class="btn dark_btn ml20" data-toggle="modal" data-target="#addReviewRequest">
                        <i class="icon-plus3"></i><span> &nbsp; Add to campaign</span></button>


                </div>
            </div>
        </div>


        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <!------------------------->
                    <div class="col-md-3">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Profile</h6>
                                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                            </div>
                            <div class="panel-body min_h270 p0">
                                <div class="profile_sec">
                                    <div class="p40 text-center">
                                        <div class="profile_pic">
                                        <!--                                            <img width="84" height="84" class="img-circle" src="{{ $srcUserImg }}"/>-->
                                            {!! showUserAvtar($avatar, $firstname, $lastname, 84, 84, 24) !!}
                                            <div class="profile_flags"><img style="height:18px!important;" class="flags"
                                                                            src="{{ base_url() }}assets/images/flags/{{ strtolower($country) }}.png"
                                                                            onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/>
                                            </div>
                                        </div>


                                        <h3>{{ $username }}</h3>
                                        <p class="text-size-small text-muted mb0">{!! $state != '' ? ucfirst($state) . ' ,' : displayNoData().' ,' !!} {{ strtoupper($country) }}</p>
                                    </div>


                                    <div class="profile_headings">Info <a href="#" class="pull-right"><i
                                                class="fa fsize15 txt_grey fa-angle-down"></i></a></div>


                                    <div class="interactions p25">
                                        <ul>
                                            <li>
                                                <i class="fa fa-envelope"></i><strong>{!! $email != '' ? $email : displayNoData() !!}</strong>
                                            </li>
                                            <li>
                                                <i class="fa fa-phone"></i><strong>{!! $mobile != '' ? mobileNoFormat($mobile) : displayNoData() !!}</strong>
                                            </li>
                                            <li><i class="fa fa-user"></i>
                                                <strong>
                                                    @if ($gender == 'male')
                                                        {{ 'Male' }}
                                                    @elseif ($gender == 'female')
                                                        {{ 'Female' }}
                                                    @else
                                                        {!! displayNoData() !!}
                                                    @endif
                                                </strong></li>
                                            <li><i class="fa fa-clock-o"></i><strong>{{ date("hA") }}
                                                    , {{ date_default_timezone_get() }}</strong></li>
                                            <li><i class="fa fa-align-left"></i><strong>Opt-Out of All</strong></li>

                                        </ul>
                                    </div>


                                    <div class="profile_headings">Lists <a class="pull-right plus_icon"
                                                                           href="{{ base_url('admin/lists/') }}"><i
                                                class="icon-plus3"></i></a></div>

                                    <div class="p25">
                                        @if (!empty($getMyLists))
                                            @foreach ($getMyLists as $key => $value)
                                                <button
                                                    class="btn btn-xs btn_white_table">{{ $value->list_name }}</button>
                                            @endforeach
                                            <button style="margin: 0 10px 15px 0!important;"
                                                    class="btn btn-xs plus_icon mt0" data-toggle="modal"
                                                    data-target="#chooselistModal"><i class="icon-plus3"></i></button>
                                        @else
                                            {!! displayNoData() !!}
                                        @endif
                                    </div>


                                    <div class="profile_headings">Segments: (Not completed) <a
                                            class="pull-right plus_icon" style="cursor: text;"><i
                                                class="icon-plus3"></i></a></div>

                                    <div class="p25">

                                        {!! displayNoData() !!}
                                    </div>

                                    <div class="profile_headings">Tags <a class="pull-right plus_icon"
                                                                          href="{{ base_url('admin/tags') }}"><i
                                                class="icon-plus3"></i></a></div>

                                    <div class="p25" id="tag_container_{{ $contactId }}">
                                        @if (!empty($oTags))
                                            @foreach ($oTags as $value)

                                                @if (!empty($value->tag_name))
                                                    <button
                                                        class="btn btn-xs btn_white_table">{{ $value->tag_name }}</button>
                                                @endif
                                            @endforeach
                                            <button style="margin: 0 10px 15px 0!important;"
                                                    class="btn btn-xs plus_icon mt0 applyInsightTags"
                                                    data-subscriber-id="{{ $contactId }}"><i class="icon-plus3"></i>
                                            </button>
                                        @else
                                            {!! displayNoData() !!}
                                        @endif
                                    </div>

                                    <div class="profile_headings">Involved Campaigns <a class="pull-right plus_icon"
                                                                                        href="{{ base_url('admin/tags') }}"><i
                                                class="icon-plus3"></i></a></div>

                                    <div class="p25">
                                        @php
                                            //pre($oTags);
                                                                                    if (!empty($oInvolvedBrandboost)) {
                                                                                        foreach ($oInvolvedBrandboost as $oBoost) {
                                                                                            if ($oBoost->review_type == 'onsite') {
                                                                                                $oOnsite[] = $oBoost;
                                                                                            }

                                                                                            if ($oBoost->review_type == 'offsite') {
                                                                                                $oOffsite[] = $oBoost;
                                                                                            }
                                                                                        }

                                                                                        if (!empty($oOnsite)) {
                                                                                            echo "<strong>Onsite Reviews Campaigns<br><br></strong><div class='clearfix'></div>";
                                                                                            foreach ($oOnsite as $oRec) {
                                                                                                if (!empty($oRec->brand_title)) {
                                        @endphp
                                        <button class="btn btn-xs btn_white_table">{{ $oRec->brand_title }}</button>
                                        @php
                                            }
                                        }
                                    }

                                    if (!empty($oOffsite)) {
                                        echo "<div class='clearfix'></div><strong>Offsite Reviews Campaigns<br><br></strong><div class='clearfix'></div>";
                                        foreach ($oOffsite as $oRec) {
                                            if (!empty($oRec->brand_title)) {
                                        @endphp
                                        <button class="btn btn-xs btn_white_table">{{ $oRec->brand_title }}</button>
                                        @php
                                            }
                                        }
                                    }

                                    if (!empty($oInvolvedNPS)) {
                                        echo "<div class='clearfix'></div><strong>NPS Campaigns<br><br></strong><div class='clearfix'></div>";
                                        foreach ($oInvolvedNPS as $oRec) {
                                            if (!empty($oRec->title)) {
                                        @endphp
                                        <button class="btn btn-xs btn_white_table">{{ $oRec->title }}</button>
                                        @php
                                            }
                                        }
                                    }

                                    if (!empty($oInvolvedReferral)) {
                                        echo "<div class='clearfix'></div><strong>Referral Campaigns<br><br></strong><div class='clearfix'></div>";
                                        foreach ($oInvolvedReferral as $oRec) {
                                            if (!empty($oRec->title)) {
                                        @endphp
                                        <button class="btn btn-xs btn_white_table">{{ $oRec->title }}</button>
                                        @php
                                            }
                                        }
                                    }
                                } else {
                                @endphp
                                    {!! displayNoData() !!}
                                @php
                                }
                                        @endphp
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------------->
                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <!--<h6 class="panel-title">New Note</h6>-->
                                <ul class="nav nav-tabs nav-tabs-bottom">
                                    <li class="active"><a href="javascript:void(0);">New Note</a></li>
                                </ul>
                                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                            </div>
                            <!-- <form method="POST" action="#"> -->
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <input type="hidden" name="subscriberid" id="subscriberid"
                                               value="{{ $contactId }}">
                                        <textarea class="form-control addnote" id="notes"
                                                  placeholder="Start typing to leave a note..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer p20">
                                <button class="btn dark_btn bkg_blue mr20 addNoteButton">Add Note</button>
                                <a href="#"><i class="icon-hash text-muted"></i></a> &nbsp; &nbsp; <a href="#"><i
                                        class="icon-reset text-muted"></i></a>
                            </div>
                            <!-- </form> -->
                        </div>

                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <!--<h6 class="panel-title">New Note</h6>-->
                                <ul class="nav nav-tabs nav-tabs-bottom">
                                    <li class="active"><a href="#ActivityLog" data-toggle="tab">Activity Log</a></li>
                                    <li><a href="#NewNote" class="contactNewNote" data-toggle="tab">Notes</a></li>
                                    <li><a href="#Email" data-toggle="tab">Email</a></li>
                                    <li><a href="#SMS" data-toggle="tab">SMS</a></li>
                                    <li><a href="#ChatPanel" data-toggle="tab">Chat</a></li>

                                </ul>
                                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                            </div>
                            <!-- <form method="POST" action="#"> -->
                            <div class="panel-body p0">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="ActivityLog">
                                        <div class="panel panel-flat mb0">
                                            <div class="panel-body min_h270 p0">
                                                <table class="table">
                                                    <tbody>
                                                    @php
                                                        if (!empty($userActivities)) {
                                                            $activityInc = 1;
                                                            foreach ($userActivities as $key => $value) {
                                                                //pre($value->event_type);

                                                                if ($activityInc > 10) {
                                                                    $display = 'display:none;';
                                                                } else {
                                                                    $display = '';
                                                                }

                                                                if ($value->event_type == 'add_subscriber') {
                                                                    $icon = '<img src="' . base_url("assets/css/menu_icons/People_Color.svg") . '" class="img-circle img-xs" />';
                                                                } else if ($value->event_type == 'module_email' || $value->event_type == 'manage_email_automation') {
                                                                    $icon = '<img src="' . base_url("assets/images/icon_round_email.png") . '" class="img-circle img-xs" />';
                                                                } else if ($value->event_type == 'brandboost_onsite_offsite' || $value->event_type == 'manual_review_request') {
                                                                    $icon = '<img src="' . base_url("assets/css/menu_icons/OffSiteBoost_Color.svg") . '" class="img-circle img-xs" />';
                                                                } else if ($value->event_type == 'brandboost_offsite') {
                                                                    $icon = '<img src="' . base_url("assets/css/menu_icons/OnSiteBoost_Color.svg") . '" class="img-circle img-xs" />';
                                                                } else if ($value->event_type == 'brandboost_onsite') {
                                                                    $icon = '<img src="' . base_url("assets/css/menu_icons/OffSiteBoost_Color.svg") . '" class="img-circle img-xs" />';
                                                                } else if ($value->event_type == 'import_subscribers') {
                                                                    $icon = '<i class="icon-arrow-up16"></i>';
                                                                } else if ($value->event_type == 'export_subscribers') {
                                                                    $icon = '<i class="icon-arrow-down16"></i>';
                                                                } else if ($value->event_type == 'manage_automation_lists' || $value->event_type == 'manage_lists') {
                                                                    $icon = '<i class="icon-indent-increase2"></i>';
                                                                } else if ($value->event_type == 'upgraded_membership' || $value->event_type == 'upgraded_topup_membership' || $value->event_type == 'buy-addons-credit-pack' || $value->event_type == 'profile_update') {
                                                                    $icon = '<img src="' . base_url("assets/images/icon_round_forward.png") . '" class="img-circle img-xs" />';
                                                                } else if ($value->event_type == 'brandboost_onsite_widget') {
                                                                    $icon = '<img src="' . base_url("assets/css/menu_icons/Website_Color.svg") . '" class="img-circle img-xs" />';
                                                                } else {
                                                                    $icon = '<i class="icon-star-full2 txt_purple"></i>';
                                                                }
                                                    @endphp
                                                    <tr class="activityShow" style="{{ $display }}">
                                                        <td>
                                                            <div class="media-left media-middle"><a class="icons"
                                                                                                    style="cursor: pointer;">{{ $icon }}</a>
                                                            </div>
                                                            <div class="media-left">
                                                                <div class="pt-5"><a href="#"
                                                                                     class="text-default text-semibold">
                                                                        <!-- Email <span class="text-muted">sent in </span> New Product Campaign -->{{ $value->activity_message }}</a>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td class="text-right"><span class="text-muted text-size-small">{{ date('d M Y ', strtotime($value->activity_created)) }} &nbsp; {{ date('h:i A ', strtotime($value->activity_created)) }}</span>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $activityInc++;
                                                    }
                                                } else {
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center" style="height:250px;">
                                                            {!! displayNoData() !!}
                                                        </td>
                                                    </tr>
                                                    @php }
                                                    @endphp
                                                    </tbody>
                                                </table>

                                                @if(!empty($userActivities)) {
                                                @if (count($userActivities) > 10)
                                                    <div class="loadMoreRecord loadMoreRecordActivity"><a
                                                            style="cursor: pointer;" class="loadMoreActivity">Load
                                                            more</a><img class="loaderImage hidden"
                                                                         src="{{ base_url() }}assets/images/widget_load.gif"
                                                                         width="20px" height="20px"></div>
                                                @endif
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="NewNote">
                                        <div class="panel panel-flat mb0">
                                            <div class="panel-body p0" id="contact-notes-container">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="Email">

                                        <div class="panel panel-flat mb0">
                                            <!--                                    <div class="panel-heading">
                                                                                    <h6 class="panel-title">Email</h6>
                                                                                    <div class="heading-elements"><a style="cursor: pointer;"><i class="icon-more2"></i></a></div>
                                                                                </div>-->
                                            <div class="panel-body min_h270 p0">
                                                <table class="table">
                                                    <tbody>
                                                    @php

                                                        $emailCount = 0;
                                                        if (!empty($result)) {
                                                            $emailInc = 1;
                                                            foreach ($result as $key => $value) {
                                                                //pre($value);
                                                                if ($value['type'] == 'Email') {
                                                                    $icon = '<img src="' . base_url("assets/images/icon_round_email.png") . '" class="img-circle img-xs" />';

                                                                    if ($emailInc > 10) {
                                                                        $display = 'display:none;';
                                                                    } else {
                                                                        $display = '';
                                                                    }
                                                    @endphp
                                                    <tr class="emailsShow" style="{{ $display }}">
                                                        <td>
                                                            <div class="media-left media-middle"><a class="icons"
                                                                                                    style="cursor: pointer;">{{ $icon }}</a>
                                                            </div>
                                                            <div class="media-left">
                                                                <div class="pt-5"><a href="{{ $value['url'] }}"
                                                                                     target="_blank"
                                                                                     class="text-default text-semibold">{{ $value['title'] . ' - ' . $value['name'] . '' }}</a>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td class="text-right"><span class="text-muted text-size-small">{{ date('d M Y ', strtotime($value['created'])) }} &nbsp; {{ date('h:i A ', strtotime($value['created'])) }}</span>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $emailInc++;
                                                        $emailCount++;
                                                    }
                                                }
                                            } else {

                                            }
                                            if (empty($emailCount)) {
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center" style="height:250px;">
                                                            [No Data]
                                                        </td>
                                                    </tr>
                                                    @php }
                                                    @endphp
                                                    </tbody>
                                                </table>

                                                @if(!empty($emailInc))
                                                    @if ($emailInc > 10)
                                                        <div class="loadMoreRecord loadMoreRecordEmail"><a
                                                                style="cursor: pointer;" class="loadMoreEmail">Load
                                                                more</a><img class="loaderImage hidden"
                                                                             src="{{ base_url() }}assets/images/widget_load.gif"
                                                                             width="20px" height="20px"></div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="SMS">

                                        <div class="panel panel-flat mb0">
                                            <!--                                    <div class="panel-heading">
                                                                                    <h6 class="panel-title">SMS</h6>
                                                                                    <div class="heading-elements"><a style="cursor: pointer;"><i class="icon-more2"></i></a></div>
                                                                                </div>-->
                                            <div class="panel-body min_h270 p0">
                                                <table class="table">
                                                    <tbody>
                                                    @php
                                                        $smsCount = 0;
                                                        if (!empty($result)) {
                                                            $smsInc = 1;
                                                            foreach ($result as $key => $value) {

                                                                if ($value['type'] == 'SMS') {

                                                                    if ($smsInc > 10) {
                                                                        $display = 'display:none;';
                                                                    } else {
                                                                        $display = '';
                                                                    }

                                                                    $icon = '<img src="' . base_url("assets/css/menu_icons/Sms_Color.svg") . '" class="img-circle img-xs" />';
                                                    @endphp
                                                    <tr class="smsShow" style="{{ $display }}">
                                                        <td>
                                                            <div class="media-left media-middle"><a class="icons"
                                                                                                    style="cursor: pointer;">{{ $icon }}</a>
                                                            </div>
                                                            <div class="media-left">
                                                                <div class="pt-5"><a href="{{ $value['url'] }}"
                                                                                     target="_blank"
                                                                                     class="text-default text-semibold">{{ $value['title'] . ' - ' . $value['name'] . '' }}</a>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td class="text-right"><span class="text-muted text-size-small">{{ date('d M Y ', strtotime($value['created'])) }} &nbsp; {{ date('h:i A ', strtotime($value['created'])) }}</span>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $smsInc++;
                                                        $smsCount++;
                                                    }
                                                }
                                            } else {

                                            }

                                            if (empty($smsCount)) {
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center" style="height:250px;">
                                                            [No Data]
                                                        </td>
                                                    </tr>
                                                    @php }
                                                    @endphp
                                                    </tbody>
                                                </table>

                                                @if(!empty($smsInc))

                                                    @if ($smsInc > 10)
                                                        <div class="loadMoreRecord loadMoreRecordSms"><a
                                                                style="cursor: pointer;" class="loadMoreSms">Load
                                                                more</a><img class="loaderImage hidden"
                                                                             src="{{ base_url() }}assets/images/widget_load.gif"
                                                                             width="20px" height="20px"></div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="ChatPanel">

                                        <div class="panel panel-flat mb0">
                                            <!--                                    <div class="panel-heading">
                                                                                    <h6 class="panel-title">Chat</h6>
                                                                                    <div class="heading-elements"><a style="cursor: pointer;"><i class="icon-more2"></i></a></div>
                                                                                </div>-->
                                            <div class="panel-body min_h270 p0">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-center" style="height:250px;">
                                                            [No Data]
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>

                    <!------------------------->
                    <div class="col-md-3">
                        @php
                            $aUser = getLoggedUser();
                            if ($aUser->user_role == 1) {
                        @endphp
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Brandboost Credits</h6>
                                <div class="heading-elements"><a style="cursor: pointer;"><i class="icon-more2"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <h1 class="m0">{{ (!empty($aUInfo->credits->total_credits)) ? number_format($aUInfo->credits->total_credits) : 0 }}</h1>
                                <p class="text-muted">Total Credits</p>

                            </div>
                        </div>
                        @php } @endphp
                        @if (!empty($result))
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Statistic </h6>
                                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                                </div>
                                <div class="panel-body">
                                    <h1 class="m0">{!! !empty($result) ? count($result) : displayNoData() !!}</h1>
                                    <p class="text-muted">Interactions</p>
                                    <figure class="text-center"><img style="width: 100%;" class="img-responsive"
                                                                     src="{{ base_url() }}assets/images/graph9.png"/>
                                    </figure>
                                </div>
                            </div>
                        @endif

                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Feedback</h6>
                                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                            </div>
                            <div class="panel-body">

                                @php
                                    if (!empty($getFeedback)) {

                                        $smileyImage = 'smiley_green';
                                        //pre($getFeedback);
                                        if ($getFeedback[0]->category == 'Positive') {
                                            $rating = '5.0';
                                            $smileyImage = 'smiley_green';
                                        } else if ($getFeedback[0]->category == 'Negative') {
                                            $rating = '1.0';
                                            $smileyImage = 'smiley_red';
                                        } else if ($getFeedback[0]->category == 'Neutral') {
                                            $rating = '3.0';
                                            $smileyImage = 'smiley_grey';
                                        }
                                @endphp
                                <div class="media-left media-middle"><a style="cursor: text;">
                                        <img src="{{ base_url() }}assets/images/{{ $smileyImage }}.png"
                                             class="img-circle img-xs" alt=""></a></div>
                                <div class="media-left">
                                    <div class=""><a style="cursor: text;" class="text-default text-semibold"></a>
                                    </div>
                                    <div class="text-muted text-size-small">{{ $getFeedback[0]->category }}</div>
                                </div>
                                <div class="media-left pl40">
                                    <div class=""><a style="cursor: text;"
                                                     class="text-default text-semibold">{{ date('d M Y', strtotime($getFeedback[0]->created)) }}</a>
                                    </div>
                                    <div
                                        class="text-muted text-size-small">{{ date('h:iA', strtotime($getFeedback[0]->created)) }}</div>
                                </div>
                                @php
                                    } else {
                                        echo displayNoData();
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Interactions </h6>
                                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                            </div>
                            <div class="panel-body">
                                <div class="interactions">
                                    @php
                                        if(!empty($getUser->last_login)) {
                                            $last_login = $getUser->last_login;
                                        }
                                        else {
                                            $last_login = 0;
                                        }
                                        if(!empty($getNotification->system_notify)) {
                                            $system_notify = $getNotification->system_notify;
                                        }
                                        else {
                                            $system_notify = 0;
                                        }

                                        if(!empty($getNotification->user_id)) {
                                            $user_id = $getNotification->user_id;
                                        }
                                        else {
                                            $user_id = 0;
                                        }

                                        if(!empty($getNotification->email_notify))
                                        {
                                            $email_notify = $getNotification->email_notify;
                                        }
                                        else {
                                            $email_notify = '';
                                        }
                                    @endphp
                                    <ul>
                                        <li><small>Source</small> <strong>Email</strong></li>
                                        <li><small>First Seen</small>
                                            <strong>{!! (!empty($getUser->created)) ? date('d M Y', strtotime($getUser->created)) : displayNoData() !!}</strong>
                                        </li>
                                        <li><small>Last Seen</small>
                                            <strong>{!! strtotime($last_login) > 0 ? date('d M Y', strtotime($last_login)) : displayNoData() !!}</strong>
                                        </li>
                                        <li><small>Page views</small> <strong>[No Data]</strong></li>
                                        <li><small>Reviews</small> <strong>
                                                @if (!empty($aReviews))
                                                    {{ count($aReviews) }}
                                                @else
                                                    {!! displayNoData() !!}
                                                @endif
                                            </strong></li>
                                        <li><small>Notification</small>
                                            <strong>{{ ($system_notify) ? 'On' : 'Off' }}</strong></li>
                                        <li><small>Id</small>
                                            <strong>{!! $user_id > 0 ? $user_id : displayNoData() !!}</strong></li>
                                        <li><small>SMS</small> <strong>{{ ($email_notify) ? 'On' : 'Off' }}</strong>
                                        </li>
                                        <li><small>Emails</small> <strong>{{ ($email_notify) ? 'On' : 'Off' }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===========TAB 2===========-->
            <div class="tab-pane" id="right-icon-tab1">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">

                            <div class="panel-heading"> <span class="pull-left">
                                    <h6 class="panel-title">
                                        @if (!empty($aReviews))
                                            {{ count($aReviews) }}
                                        @endif
                                            Reviews</h6>
                                </span>
                                <div class="heading_links pull-left">
                                    <a class="top_links top_links_clk btn btn-xs ml20 btn-default" startRate=""
                                       style="cursor: pointer;">All</a>
                                    <a class="top_links top_links_clk" startRate="positive" style="cursor: pointer;">Positive</a>
                                    <a class="top_links top_links_clk" startRate="neutral" style="cursor: pointer;">Neutral</a>
                                    <a class="top_links top_links_clk" startRate="negative" style="cursor: pointer;">Negative</a>
                                    <a class="top_links top_links_clk link" startRate="commentLink"
                                       style="cursor: pointer;">With comments only</a>
                                    <button type="button" class="btn btn-xs ml20 btn-default"><i class="icon-plus3"></i>
                                    </button>
                                </div>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback"><i class="icon-search4"></i></div>
                                    </div>
                                    &nbsp; &nbsp;

                                    <button type="button" class="btn btn-xs btn-default editDataReview"><i
                                            class="icon-pencil position-left"></i> Edit
                                    </button>

                                    <button id="deleteButtonReviewList" class="btn btn-xs custom_action_box"><i
                                            class="icon-trash position-left"></i></button>

                                </div>
                            </div>

                            <div class="panel-body p0">

[No Data]
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===========TAB 3===========-->
            <div class="tab-pane" id="right-icon-tab2">

                @php
                    $iActiveCount = $iArchiveCount = 0;

                    if (!empty($oProgramsRef)) {
                        foreach ($oProgramsRef as $oCount) {
                            if ($oCount->status == 'archive') {
                                $iArchiveCount++;
                            } else {
                                $iActiveCount++;
                            }
                        }
                    }
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ $iActiveCount }} Referral Programs</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="#"><i class="icon-calendar52"></i></a>
                                        <a href="#"><i class="icon-arrow-down16"></i></a>
                                        <a href="#"><i class="icon-arrow-up16"></i></a>
                                        <a style="cursor: pointer;" class="editDataList"><i class="icon-pencil"></i></a>
                                        <a style="cursor: pointer; display: none;" id="deleteBulkReferral"
                                           class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a style="cursor: pointer; display: none;" id="archiveBulkReferral"
                                           class="custom_action_box"><i class="icon-gear position-left"></i> </a>
                                    </div>

                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction" style="width:30px;"><label
                                                class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                         name="checkAll[]"
                                                                                         class="control-primary"
                                                                                         id="checkAll"><span
                                                    class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-user"></i>Programs</th>
                                        <th><i class="icon-calendar"></i>Advocates</th>
                                        <th><i class="icon-user"></i>Clicks</th>
                                        <th><i class="icon-envelop"></i>Visits</th>
                                        <th><i class="icon-iphone"></i>Actions</th>
                                        <th><i class="icon-warning2"></i>Top Advocate</th>
                                        <th><i class="icon-warning2"></i>Created</th>
                                        <th><i class="icon-warning2"></i>Stats</th>
                                        <th><i class="fa fa-dot-circle-o"></i> Status</th>
                                        <!-- <th></th> -->
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <!--================================================-->
                                    @if(!empty($oProgramsRef))
                                        @foreach ($oProgramsRef as $oProgram)
                                            @if ($oProgram->status != 'archive')
                                                <tr id="append-{{ $oProgram->id }}" class="selectedClass">
                                                    <td style="display: none;">{{ date('m/d/Y', strtotime($oProgram->created)) }}</td>
                                                    <td style="display: none;">{{ $oProgram->id }}</td>
                                                    <td style="display: none;" class="editAction"><label
                                                            class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                                     name="checkRows[]"
                                                                                                     id="chk{{ $oProgram->id }}"
                                                                                                     class="checkRows"
                                                                                                     value="{{ $oProgram->id }}"><span
                                                                class="custmo_checkmark"></span></label></td>
                                                    <td>
                                                        <div class="media-left media-middle"><a class="icons br5"
                                                                                                href="#"><i
                                                                    class="icon-tree5 txt_sblue"></i></a></div>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a
                                                                    href="{{ base_url() }}admin/modules/referral/setup/{{ $oProgram->id }}"
                                                                    class="text-default text-semibold">{{ $oProgram->title }}</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><a href="#" target="_blank"
                                                           class="text-default text-semibold"><img class="progress_icon"
                                                                                                   src="/assets/images/progress_blue.png"/>
                                                            &nbsp; 98</a></td>
                                                    <td><a href="#" target="_blank"
                                                           class="text-default text-semibold"><img class="progress_icon"
                                                                                                   src="/assets/images/progress_blue.png"/>
                                                            &nbsp; 98</a></td>
                                                    <td><a href="#" target="_blank"
                                                           class="text-default text-semibold"><img class="progress_icon"
                                                                                                   src="/assets/images/progress_green.png"/>
                                                            &nbsp; 87</a></td>
                                                    <td><a href="#" target="_blank"
                                                           class="text-default text-semibold"><img class="progress_icon"
                                                                                                   src="/assets/images/progress_red.png"/>
                                                            &nbsp; 56</a></td>
                                                    <td>
                                                        <div class="media-left media-middle"><a class="icons"
                                                                                                href="{{ base_url() }}admin/subscriber/activities/{{ $oProgram->id }}"><img
                                                                    src="/assets/images/userp.png"
                                                                    class="img-circle img-xs" alt=""></a></div>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a
                                                                    href="{{ base_url() }}admin/subscriber/activities/{{ $oProgram->id }}"
                                                                    class="text-default text-semibold"><span>{{ $oProgram->firstname }} {{ $oProgram->lastname }}</span>
                                                                    <img class="flags"
                                                                         src="/assets/images/flags/ao.png"></a></div>
                                                            <div
                                                                class="text-muted text-size-small">{{ $oProgram->email }}</div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a style="cursor: pointer;"
                                                                                 class="text-default text-semibold">{{ date('d M Y', strtotime($oProgram->created)) }}</a>
                                                            </div>
                                                            <div
                                                                class="text-muted text-size-small">{{ date('h:i A', strtotime($oProgram->created)) }}</div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a href="{{ base_url('admin/modules/referral/stats/' . $oProgram->id) }}"
                                                           target="_blank"><img
                                                                src="/assets/images/table_graph_teal.png" class=""
                                                                alt="Stats Graph"></a></td>
                                                    <td><label class="custom-form-switch">
                                                            <input class="field chgStatus" ref_id="{{ $oProgram->id }}"
                                                                   change_status='{{ $oProgram->status == 'active' ? 'draft' : 'active' }}'
                                                                   type="checkbox" {{ $oProgram->status == 'active' ? 'checked' : '' }}>
                                                            <span class="toggle teal"></span> </label></td>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a target="_blank"
                                                               href="{{ base_url('admin/modules/referral/reports/' . $oProgram->id) }}"><i
                                                                    class="icon-file-stats"></i> Reports</a></li>
                                                        @if ($oProgram->status == 'active')
                                                            <li><a ref_id="{{ $oProgram->id }}" change_status='draft'
                                                                   class='chg_status'><i class='icon-gear'></i>Inactive</a>
                                                            </li>
                                                        @else
                                                            <li><a ref_id="{{ $oProgram->id }}" change_status='active'
                                                                   class='chg_status'><i
                                                                        class='icon-gear'></i>Active</a></li>
                                                        @endif
                                                        <li><a href="javascript:void(0);" ref_id="{{ $oProgram->id }}"
                                                               class="editReferral"><i class="icon-pencil"></i> Edit</a>
                                                        </li>
                                                        <li><a href="javascript:void(0);" ref_id="{{ $oProgram->id }}"
                                                               class="moveToArchiveReferral"><i
                                                                    class="icon-file-stats"></i> Move To Archive</a>
                                                        </li>
                                                        <li><a href="javascript:void(0);" ref_id="{{ $oProgram->id }}"
                                                               class="deleteReferral"><i class="icon-trash"></i> Delete</a>
                                                        </li>
                                                    </ul>
                                                    </li>
                                                    </ul>

                                                    </td> -->
                                                </tr>
                                            @endif
                                        @endforeach

                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--===========TAB 4===========-->
            <div class="tab-pane" id="right-icon-tab3">
                @php
                    $iActiveCount = $iArchiveCount = 0;

                    if (!empty($oPrograms)) {
                        foreach ($oPrograms as $oCount) {
                            if ($oCount->status == 'archive') {
                                $iArchiveCount++;
                            } else {
                                $iActiveCount++;
                            }
                        }
                    }
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ $iActiveCount }} NPS Surveys</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                    <button type="button" class="btn btn-xs btn-default editDataList"><i
                                            class="icon-pencil position-left"></i> Edit
                                    </button>
                                    <button id="deleteBulkNPS" class="btn btn-xs custom_action_box"><i
                                            class="icon-trash position-left"></i> Delete
                                    </button>
                                    <button id="archiveBulkNPS" class="btn btn-xs custom_action_box"><i
                                            class="icon-gear position-left"></i> Archive
                                    </button>
                                </div>
                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction"><label
                                                class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                         name="checkAll[]"
                                                                                         class="control-primary"
                                                                                         id="checkAll"><span
                                                    class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-stack-star"></i> Name</th>
                                        <th class="text-center"><i class="icon-star-full2"></i> NPS Score</th>
                                        <th><i class="icon-calendar"></i> Created</th>
                                        <th><i class="icon-user"></i></th>
                                        <th><i class="icon-graph"></i> Total</th>
                                        <th><i class="fa fa-smile-o fsize12"></i></th>
                                        <th><i class="fa fa-smile-o fsize12"></i></th>
                                        <th><i class="fa fa-smile-o fsize12"></i></th>
                                        <th><i class="icon-alarm-check"></i>Last review</th>
                                        <th class="nosort"><i class="icon-statistics"></i> Statistic</th>
                                        <th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i> Status</th>
                                        <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php
                                        if(!empty($oPrograms)) {
                                        foreach ($oPrograms as $oProgram):

                                            $positive = 0;
                                            $nutral = 0;
                                            $negetive = 0;
                                            $totalFeedbackNum = 0;
                                            $hashcode = $oProgram->hashcode;
                                            //$oContactsT = $this->mNPS->getMyUsers($hashcode);
                                            $totalFeedback = $oProgram->NPS;
                                            //pre($totalFeedback);
                                            foreach ($totalFeedback as $value) {
                                                $scoreVal = $value->score;
                                                if ($scoreVal >= 8) {
                                                    $positive = $positive + 1;
                                                } else if ($scoreVal > 4) {
                                                    $nutral = $nutral + 1;
                                                } else {
                                                    $negetive = $negetive + 1;
                                                }
                                            }

                                            $totalFeedbackNum = $positive + $nutral + $negetive;



                                            if(!empty($oProgram->NPS[0])) {
                                                $score = ($oProgram->NPS[0]->score) ? '<a target="_blank" href="'.base_url('admin/modules/nps/score/' . $oProgram->hashcode).'">'.$oProgram->NPS[0]->score * 10 .'</a>' : displayNoData();
                                            }
                                            else {
                                                $score = '';
                                            }

                                            $aScoreSummery = App\Models\Admin\Modules\NpsModel::getNPSScoreSummery($oProgram->hashcode);

                                            if($aScoreSummery['NPSScore'] > 0) {
                                                $score = number_format($aScoreSummery['NPSScore'], 1);
                                            }
                                            else {
                                                $score = 0;
                                            }


                                            //pre($oProgram);
                                            if ($oProgram->status != 'archive') {
                                    @endphp
                                    <tr id="append-{{ $oProgram->id }}" class="selectedClass">
                                        <td style="display: none;">{{ date('m/d/Y', strtotime($oProgram->created)) }}</td>
                                        <td style="display: none;">{{ $oProgram->id }}</td>
                                        <td style="display: none;" class="editAction"><label
                                                class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                         name="checkRows[]"
                                                                                         class="checkRows"
                                                                                         value="{{ $oProgram->id }}"
                                                                                         id="chk{{ $oProgram->id }}"><span
                                                    class="custmo_checkmark"></span></label></td>
                                        <td>
                                            <div class="media-left media-middle"><a class="icons square"
                                                                                    href="javascript:void(0);"><i
                                                        class="icon-checkmark3 txt_blue"></i></a></div>
                                            <div class="media-left">
                                                <div class="pt-5"><a class="text-default text-semibold"
                                                                     href="{{ base_url() }}admin/modules/nps/setup/{{ $oProgram->id }}">{{ $oProgram->title }}</a>
                                                </div>
                                                <div
                                                    class="text-muted text-size-small">{{ (ucfirst($oProgram->platform)) ? ucfirst($oProgram->platform) : 'NA' }}</div>
                                            </div>

                                        </td>
                                        <td class="text-center">

                                            @php
                                                if ($score > 0) {
                                                    $scoreType = '';
                                            @endphp
                                            <div class="media-left media-middle">
                                                <a target="_blank"
                                                   href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}">
                                                    @php
                                                        if ($score > 80) {
                                                            echo '<img src="' . base_url() . 'assets/images/smiley_green.png" class="img-circle img-xs" alt="">';
                                                            $scoreType = 'Positive';
                                                        }

                                                        if ($score > 60 && $score < 90) {
                                                            echo '<img src="' . base_url() . 'assets/images/smiley_grey2.png" class="img-circle img-xs" alt="">';
                                                            $scoreType = 'Netural';
                                                        }

                                                        if ($score < 70) {
                                                            echo '<img src="' . base_url() . 'assets/images/smiley_red.png" class="img-circle img-xs" alt="">';
                                                            $scoreType = 'Negtive';
                                                        }
                                                    @endphp
                                                </a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a target="_blank"
                                                                 href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}"
                                                                 class="text-default text-semibold">{{ $score }}</a>
                                                </div>
                                                <div class="text-muted text-size-small"><a target="_blank"
                                                                                           href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}"
                                                                                           class="text-default text-semibold">{{ $scoreType }}</a>
                                                </div>
                                            </div>
                                            @php } else {
                                            @endphp
                                            <a target="_blank"
                                               href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}"
                                               style="color: #333333;">
                                                @php
                                                    echo displayNoData();
                                                @endphp
                                            </a>
                                            @php }
                                            @endphp


                                        </td>
                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#"
                                                                     class="text-default text-semibold">{{ date('d M Y', strtotime($oProgram->created)) }}</a>
                                                </div>
                                                <div
                                                    class="text-muted text-size-small">{{ date('h:i A', strtotime($oProgram->created)) }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                if (!empty($oContactsT)) {
                                                    $totPerson = count($oContactsT);
                                                    $totWidth = 100;
                                                } else {
                                                    $totPerson = '0';
                                                    $totWidth = 0;
                                                }
                                                echo $totPerson;
                                            @endphp
                                            <div data-toggle="tooltip" title="" data-placement="top" class="progress"
                                                 data-original-title="Total People {{ $totPerson }}">
                                                <div class="progress-bar progress-bar-grey" role="progressbar"
                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"
                                                     style="width:{{ $totWidth }}%"></div>
                                            </div>

                                        </td>
                                        <td>
                                            @php
                                                if ($totalFeedbackNum > 0) {
                                                    $totFeedCount = $totalFeedbackNum;
                                                    $totWidth = 100;
                                                } else {
                                                    $totFeedCount = 0;
                                                    $totWidth = 0;
                                                }
                                                echo $totFeedCount;
                                            @endphp
                                            <div data-toggle="tooltip" title="" data-placement="top" class="progress"
                                                 data-original-title="Total Feedback {{ $totFeedCount }}">
                                                <div class="progress-bar progress-bar-violet" role="progressbar"
                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"
                                                     style="width:{{ $totWidth }}%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                echo $positive;
                                                if ($totFeedCount > 0) {
                                                    $divPosFeed = ($positive / $totFeedCount) * 100;
                                                } else {
                                                    $divPosFeed = 0;
                                                }
                                            @endphp
                                            <div data-toggle="tooltip" title="" data-placement="top" class="progress"
                                                 data-original-title="Total Positive {{ $positive }}">
                                                <div class="progress-bar progress-bar-green2" role="progressbar"
                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"
                                                     style="width:{{ $divPosFeed }}%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                echo $nutral;
                                                if ($totFeedCount > 0) {
                                                    $divNutFeed = ($nutral / $totFeedCount) * 100;
                                                } else {
                                                    $divNutFeed = 0;
                                                }
                                            @endphp
                                            <div data-toggle="tooltip" title="" data-placement="top" class="progress"
                                                 data-original-title="Total Nutral {{ $nutral }}">
                                                <div class="progress-bar progress-bar-black" role="progressbar"
                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"
                                                     style="width:{{ $divNutFeed }}%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                echo $negetive;
                                                if ($totFeedCount > 0) {
                                                    $divNegFeed = ($negetive / $totFeedCount) * 100;
                                                } else {
                                                    $divNegFeed = 0;
                                                }
                                            @endphp
                                            <div data-toggle="tooltip" title="" data-placement="top" class="progress"
                                                 data-original-title="Total Negative {{ $negetive }}">
                                                <div class="progress-bar progress-bar-red" role="progressbar"
                                                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"
                                                     style="width:{{ $divNegFeed }}%"></div>
                                            </div>
                                        </td>

                                        <td>
                                            @php
                                                $totalFeedback = end($totalFeedback);
                                                if (!empty($totalFeedback->score)) {
                                                    if ($totalFeedback->score >= 8) {
                                                        $ratingValue = '5.0';
                                                        $icon = ' <i class="fa fa-smile-o"></i></a>';
                                                        $imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
                                                    } else if ($totalFeedback->score > 4) {
                                                        $ratingValue = '3.0';
                                                        $icon = ' <i class="fa fa-smile-o"></i></a>';
                                                        $imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
                                                    } else {
                                                        $ratingValue = '1.0';
                                                        $icon = ' <i class="fa fa-smile-o"></i></a>';
                                                        $imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
                                                    }
                                                } else {
                                                    $ratingValue = displayNoData();
                                                    $icon = '';
                                                    $imageIcon = '';
                                                }
                                            @endphp
                                            <div class="media-left media-middle">{{ $imageIcon }}</div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">
                                                    @php
                                                        echo $ratingValue;
                                                        echo $icon;
                                                    @endphp
                                                </div>
                                                <div class="text-muted text-size-small">
                                                    @php if(!empty($totalFeedback)) {
                                                                if(!empty($totalFeedback->firstname)) {
                                                                    echo $totalFeedback->firstname;
                                                                }
                                                                if(!empty($totalFeedback->lastname)) {
                                                                    echo $totalFeedback->lastname;
                                                                }
                                                    @endphp
                                                    @php } @endphp
                                                </div>
                                            </div>
                                        </td>


                                        <td><a target="_blank"
                                               href="{{ base_url('admin/modules/nps/stats/' . $oProgram->id) }}"><img
                                                    src="{{ base_url() }}assets/images/table_graph.png" class="" alt=""></a>
                                        </td>


                                        <td class="text-center">
                                            <button class="btn btn-xs btn_white_table pr10">

                                                @if ($oProgram->status == 'active')
                                                    <i class="icon-primitive-dot txt_green"></i> Publish
                                                @else
                                                    <i class="icon-primitive-dot txt_red"></i> Inactive
                                                @endif
                                            </button>
                                        </td>


                                        <td class="text-center">

                                            <ul class="icons-list">
                                                <li class="dropup">
                                                    <button type="button"
                                                            class="btn btn-xs btn_white_table ml20 dropdown-toggle"
                                                            data-toggle="dropdown"><i class="icon-more2 txt_blue"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        @if ($oProgram->status == 'active')
                                                            <li><a nps_id="{{ $oProgram->id }}" change_status='draft'
                                                                   class='chg_status'><i class='icon-gear'></i>Inactive</a>
                                                            </li>
                                                        @else
                                                            <li><a nps_id="{{ $oProgram->id }}" change_status='active'
                                                                   class='chg_status'><i
                                                                        class='icon-gear'></i>Active</a></li>
                                                        @endif
                                                        <li><a href="javascript:void(0);" nps_id="{{ $oProgram->id }}"
                                                               class="editSurvey"><i class="icon-file-stats"></i>
                                                                Edit</a></li>
                                                        <li><a href="javascript:void(0);" nps_id="{{ $oProgram->id }}"
                                                               class="moveToArchiveNPS"><i class="icon-file-stats"></i>
                                                                Move To Archive</a></li>
                                                        <li><a href="javascript:void(0);" nps_id="{{ $oProgram->id }}"
                                                               class="deleteNPS"><i class="icon-file-text2"></i> Delete</a>
                                                        </li>

                                                        <li><a target="_blank"
                                                               href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}"
                                                               class="text-default text-semibold"><i
                                                                    class='icon-gear'></i>View Score</a></li>

                                                    </ul>
                                                </li>
                                            </ul>

                                        </td>


                                    </tr>
                                    @php } endforeach;

                                            } @endphp
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->


    </div>
    <!-- </div> -->
    @if(!empty($oUser)) {
    @if ($oUser->user_role == '1')
        @include("admin.modals.credits.add_credits");
    @endif
    @endif

    <script>

        // top navigation fixed on scroll and side bar collasped

        $(window).scroll(function () {
            var sc = $(window).scrollTop();
            if (sc > 100) {
                $("#header-sroll").addClass("small-header");
            } else {
                $("#header-sroll").removeClass("small-header");
            }
        });

        function smallMenu() {
            if ($(window).width() < 1600) {
                $('body').addClass('sidebar-xs');
            } else {
                $('body').removeClass('sidebar-xs');
            }
        }

        $(document).ready(function () {
            smallMenu();

            window.onresize = function () {
                smallMenu();
            };
        });


        $(document).ready(function () {
            $(document).on("click", ".addNoteButton", function () {
                $('.overlaynew').show();
                var subscriberid = $("#subscriberid").val();
                var notes = $("#notes").val();
                if (notes == '') {
                    $('.overlaynew').hide();
                    alertMessage('Please enter notes.');
                } else {
                    $.ajax({
                        url: "{{ base_url('/admin/contacts/add_contact_notes') }}",
                        type: "POST",
                        data: {notes: notes, subscriberid: subscriberid, _token: '{{csrf_token()}}'},
                        dataType: "json",
                        success: function (response) {
                            if (response.status == "success") {
                                //alertMessage('Your notes has been added successfully.');
                                $('.overlaynew').hide();
                                $("#notes").val('');
                                $("#contact-notes-container").html(response.notes);
//                                $('.notes-table').DataTable({
//                                    "order": []
//                                });

                                $(".contactNewNote").tab('show');
                                //window.location.href = '';
                            }
                        },
                        error: function (response) {
                            $('.overlaynew').hide();
                            alertMessage(response.message);
                        }
                    });
                }
            });
        });


        $(function () {

            // Checkboxes/radios (Uniform)
            // ------------------------------

            // Default initialization
            $(".styled, .multiselect-container input").uniform({
                radioClass: 'choice'
            });

            // File input
            $(".file-styled").uniform({
                wrapperClass: 'bg-blue',
                fileButtonHtml: '<i class="icon-file-plus"></i>'
            });


            //
            // Contextual colors
            //

            // Primary
            $(".control-primary").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-primary-600 text-primary-800'
            });

            // Danger
            $(".control-danger").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-danger-600 text-danger-800'
            });

            // Success
            $(".control-success").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-success-600 text-success-800'
            });

            // Warning
            $(".control-warning").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-warning-600 text-warning-800'
            });

            // Info
            $(".control-info").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-info-600 text-info-800'
            });

            // Custom color
            $(".control-custom").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-indigo-600 text-indigo-800'
            });


            // Bootstrap switch
            // ------------------------------

            //$(".switch").bootstrapSwitch();

        });

        if (document.getElementById("People") != null) {
            document.getElementById("People").classList.add("active");
        }

        if (document.getElementById("Peoplelist") != null) {
            document.getElementById("Peoplelist").classList.add("dblock");
        }


    </script>

    <!--=====================================Create new campaign================================-->
    <div id="addPeopleList" class="modal fade">
        <div style="max-width: 440px;ss" class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Create new campaign</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Campaign name</label>
                                    <div class="">
                                        <input placeholder="Enter campaign name" name="firstname" id="firstname"
                                               class="form-control" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb0">
                                    <label class="control-label">Campaign description</label>
                                    <div class="">
                                        <textarea placeholder="Enter campaign description" class="form-control" value=""
                                                  type="text" required> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p40">
                        <input type="hidden" name="listId" id="list_id" value="">
                        <button class="btn btn-link text-muted" data-dismiss="modal">Cancel</button>
                        <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--=====================================Add List Modal Popup End================================-->

    <!-- =======================edit users popup========================= -->


    <div id="editReview" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal" id="updateReview" action="javascript:void();">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label class="control-label col-lg-3">Title</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="edit_review_title" id="edit_review_title"
                                       placeholder="Title" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Comment</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" placeholder="Leave Review" name="edit_content"
                                          id="edit_content" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Rating</label>
                            <div class="col-lg-9">
                                <div class="step_star_new" style="padding: 5px 0;">

                                    <ul id='stars'>

                                        <li class='star' title='Poor' data-value='1'>

                                            <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                        </li>

                                        <li class='star' title='Fair' data-value='2'>

                                            <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                        </li>

                                        <li class='star' title='Good' data-value='3'>

                                            <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                        </li>

                                        <li class='star' title='Excellent' data-value='4'>

                                            <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                        </li>

                                        <li class='star' title='WOW!!!' data-value='5'>

                                            <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="0" id="ratingValue" name="ratingValue">
                        <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
                        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- =======================edit video popup========================= -->

    <div id="editVideoReview" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal" id="updateVideoReview" action="javascript:void();">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label class="control-label col-lg-3">Title</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="edit_review_title"
                                       id="edit_video_review_title" placeholder="Title" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Rating</label>
                            <div class="col-lg-9">
                                <div class="step_star_new" style="padding: 5px 0;">
                                    <ul id='stars_video'>

                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="0" id="ratingValueVideo" name="ratingValueVideo">
                        <input type="hidden" name="edit_video_reviewid" id="edit_video_reviewid" value="">
                        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="showVideoPopup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Video</h5>
                </div>
                <div class="modal-body">

                    <div id="divVideo" class="form-group">
                        <video width="100%" height="auto" controls>
                            <source src="" type="video/mp4">
                        </video>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <a id="downloadVideo" class="btn btn-primary" href="" download><i class="icon-download"></i>&nbsp;&nbsp;
                        Download Video</a>
                </div>

            </div>
        </div>
    </div>


    <div id="reviewPopup" class="modal fade">
        <div class="modal-dialog">
            <div class="">
                <div class="col-md-12">
                    <div class="panel">
                        <div style="border-top: none; border-bottom: 1px solid #eee!important;"
                             class="panel-footer panel-footer-condensed">
                            <div class="heading-elements not-collapsible">
                                <span class="heading-text text-semibold">
                                    <i class="icon-history position-left"></i>
                                    <span class="reviewTime"></span>
                                </span>
                                <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                        <div class="panel-body" id="reviewContent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="previewReviewReply" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body" id="previewReviewReplyContent"></div>
                        <div class="panel-footer panel-footer-condensed">
                            <div class="heading-elements not-collapsible">
                                <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="showNotesPopup" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal" id="addCentralSubscriberData">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title">Notes</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 showNoteText" id="showNoteText">

                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div id="subscriberTagListsModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" name="frmSubscriberApplyTagList" id="frmSubscriberApplyTagList"
                      action="javascript:void();">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Apply Tags</h5>
                    </div>
                    <div class="modal-body" id="tagEntireList"></div>
                    <div class="modal-footer modalFooterBtn">
                        <input type="hidden" name="tag_subscriber_id" id="tag_subscriber_id"/>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="addReviewRequest" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form method="post" name="frmReviewRequest" id="frmReviewRequest" action="javascript:void();">
            @csrf
            <!------------module_sec_list------------->
                <div class="modal-content module_sec_list" style="width:25% !important;">
                    <div class="modal-header small_header">
                        <div class="heading-elements"><a href="#"><img
                                    src="{{ base_url("assets/images/more.svg") }}"></a></div>
                        <h5 class="modal-title">Modules</h5>
                    </div>
                    <div class="modal-body p10 pl20 pr20">
                        <ul class="module_sec_list_item">
                        <!--                        <li><a href="#"><img src="{{ base_url("assets/css/menu_icons/Chat_Color.svg") }}"/> Chat</a></li>
                        <li><a href="javascript:void(0);" module_name="automation" class="chooseModule"><img src="{{ base_url("assets/css/menu_icons/Email_Color.svg") }}"/> Email</a></li>-->
                            <li><a href="javascript:void(0);" module_name="onsite" class="chooseModule"><img
                                        src="{{ base_url("assets/css/menu_icons/OnSiteBoost_Color.svg") }}"/>On Site
                                    Boost</a></li>
                            <li><a href="javascript:void(0);" module_name="offsite" class="chooseModule"><img
                                        src="{{ base_url("assets/css/menu_icons/OffSiteBoost_Color.svg") }}"/> Off Site
                                    Boost</a></li>
                            <li><a href="javascript:void(0);" module_name="nps" class="chooseModule"><img
                                        src="{{ base_url("assets/css/menu_icons/NPS_Color.svg") }}"/> NPS</a></li>
                            <li><a href="javascript:void(0);" module_name="referral" class="chooseModule"><img
                                        src="{{ base_url("assets/css/menu_icons/Referral_Color.svg") }}"/> Referral</a>
                            </li>


                        </ul>
                    </div>
                </div>


                <!------------campaign_sec_list------------->
                <div class="modal-content campaign_sec_list addcontactlistpopup" id="rrCampaignlist"
                     style="width:75% !important;">
                    <div class="modal-header small_header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="heading-elements"><a href="#"><img
                                    src="{{ base_url("assets/images/more.svg") }}"></a></div>
                        <h5 class="modal-title">Campaigns</h5>
                    </div>
                    <div class="modal-body pl10 pr10 pt0 pb0" style="height:400px;overflow:auto;">
                        <table class="table activity new bkg_white contactaddlist" id="onsite_campaign_container"
                               style="display:none;">

                        </table>

                        <table class="table activity new bkg_white contactaddlist" id="offsite_campaign_container"
                               style="display:none;">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="media-left">
                                        <label class="custmo_checkbox">
                                            <input type="checkbox" checked>
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </div>
                                    <div class="media-left">
                                        <img class="br5" width="24" src="assets/images/media_img1.jpg"/>
                                    </div>
                                    <div class="media-left">
                                        <a href="#" class="text-default text-semibold bbot">Email Attack Hits Lorr</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left pl10 pr10 brig blef"><span
                                            class="pt-1 pull-left mr10">4.1</span><img width="20"
                                                                                       src="assets/images/smiley_green_26.png"/>
                                    </div>
                                </td>
                                <td class="text-right">24 Sep 2018</td>
                            </tr>

                            </tbody>
                        </table>

                        <table class="table activity new bkg_white contactaddlist" id="broadcast_campaign_container"
                               style="display:none;">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="media-left">
                                        <label class="custmo_checkbox">
                                            <input type="checkbox" checked>
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </div>
                                    <div class="media-left">
                                        <img class="br5" width="24" src="assets/images/media_img1.jpg"/>
                                    </div>
                                    <div class="media-left">
                                        <a href="#" class="text-default text-semibold bbot">Email Attack Hits Lorr</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left pl10 pr10 brig blef"><span
                                            class="pt-1 pull-left mr10">4.1</span><img width="20"
                                                                                       src="assets/images/smiley_green_26.png"/>
                                    </div>
                                </td>
                                <td class="text-right">24 Sep 2018</td>
                            </tr>

                            </tbody>
                        </table>

                        <table class="table activity new bkg_white contactaddlist" id="automation_campaign_container"
                               style="display:none;">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="media-left">
                                        <label class="custmo_checkbox">
                                            <input type="checkbox" checked>
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </div>
                                    <div class="media-left">
                                        <img class="br5" width="24" src="assets/images/media_img1.jpg"/>
                                    </div>
                                    <div class="media-left">
                                        <a href="#" class="text-default text-semibold bbot">Email Attack Hits Lorr</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left pl10 pr10 brig blef"><span
                                            class="pt-1 pull-left mr10">4.1</span><img width="20"
                                                                                       src="assets/images/smiley_green_26.png"/>
                                    </div>
                                </td>
                                <td class="text-right">24 Sep 2018</td>
                            </tr>

                            </tbody>
                        </table>

                        <table class="table activity new bkg_white contactaddlist" id="nps_campaign_container"
                               style="display:none;">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="media-left">
                                        <label class="custmo_checkbox">
                                            <input type="checkbox" checked>
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </div>
                                    <div class="media-left">
                                        <img class="br5" width="24" src="assets/images/media_img1.jpg"/>
                                    </div>
                                    <div class="media-left">
                                        <a href="#" class="text-default text-semibold bbot">Email Attack Hits Lorr</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left pl10 pr10 brig blef"><span
                                            class="pt-1 pull-left mr10">4.1</span><img width="20"
                                                                                       src="assets/images/smiley_green_26.png"/>
                                    </div>
                                </td>
                                <td class="text-right">24 Sep 2018</td>
                            </tr>

                            </tbody>
                        </table>

                        <table class="table activity new bkg_white contactaddlist" id="referral_campaign_container"
                               style="display:none;">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="media-left">
                                        <label class="custmo_checkbox">
                                            <input type="checkbox" checked>
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </div>
                                    <div class="media-left">
                                        <img class="br5" width="24" src="assets/images/media_img1.jpg"/>
                                    </div>
                                    <div class="media-left">
                                        <a href="#" class="text-default text-semibold bbot">Email Attack Hits Lorr</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left pl10 pr10 brig blef"><span
                                            class="pt-1 pull-left mr10">4.1</span><img width="20"
                                                                                       src="assets/images/smiley_green_26.png"/>
                                    </div>
                                </td>
                                <td class="text-right">24 Sep 2018</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer botfooter bkg_white p30">
                        <input type="hidden" name="subscriber_id" value="{{ $contactId }}"/>
                        <button class="btn btn-link txt_blue fsize14" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn dark_btn bkg_blue">Add</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>


    <div id="chooselistModal" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Lists</h5>
                </div>
                <form method="post" name="frmAddCotactToLists" id="frmAddCotactToLists" action="javascript:void();">
                    @csrf
                    <div class="modal-body p0" style="height:500px;overflow:auto;padding-bottom:17px !important; ">
                        <ul class="contactaddlist contact">
                            @php
                                if (!empty($oLists)):
                                    $newolists = array();

                                    foreach ($oLists as $key => $value) {
                                        $newolists[$value->id][] = $value;
                                    }

                                    foreach ($newolists as $oList):
                                        $totalElement = count($oList);
                                        $oList = $oList[0];
                                        if (!empty($oList->l_list_id)) {
                                            $totAll = $totalElement;
                                        } else {
                                            $totAll = 0;
                                        }
                            @endphp
                            <li>
                                <label>
                                    <div class="media-left">
                                        <div class="checkbox">
                                            <label class="custmo_checkbox pull-left mt-5 ">
                                                <input type="hidden" name="allList[]" value="{{ $oList->id }}"/>
                                                <input type="checkbox" name="listid[]"
                                                       @if(!empty($aSelectedLists))
                                                       @if (in_array($oList->id, $aSelectedLists))
                                                       checked="checked"
                                                       @endif
                                                       @endif
                                                       value="{{ $oList->id }}">
                                                <span class="custmo_checkmark"></span>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="media-left media-middle"><a class="icons" href="#"><img
                                                src="{{ base_url("assets/css/menu_icons/OffSiteBoost_Color.svg") }}"
                                                class="img-circle img-xs" alt=""></a></div>
                                    <div class="media-left"><a href="#"
                                                               class="text-default"><span>{{ $oList->list_name }}</span>
                                        </a></div>
                                </label>
                            </li>

                            @php endforeach @endphp
                            @php endif @endphp


                        </ul>
                    </div>
                    <div class="modal-footer botfooter">
                        <input type="hidden" name="subscriber_id" value="{{ $contactId }}"/>
                        <button class="btn btn-link text-muted" data-dismiss="modal">Skip</button>
                        <button type="submit" class="btn dark_btn bkg_blue">Sendff</button>
                    </div>
                </form>
            </div>


        </div>
    </div>



    <!-- newreviewpopup -->
    <div id="newreviewpopup" class="modal fade newreviewpopup2">
        <div class="modal-dialog">
            <div class="modal-content" id="reviewPopupBox">

            </div>
        </div>
    </div>
    <!-- /newreviewpopup -->

    <div id="commentpopup" class="modal fade">
    </div>



    <style type="text/css">
        .loadMoreRecord {
            text-align: center;
            padding: 20px 0 20px 0;
            margin: 20px 0px 0;
            border-top: 1px solid #eee;
        }
    </style>

    <script src="{{ base_url() }}assets/js/modules/people/subscribers.js" type="text/javascript"></script>
    <script>


        $(document).ready(function () {
            $("#openNewSMSConversation").click(function () {
                var subsID = $(this).attr("subscriber_id");
                $("#sidebar-user-box-sms-" + subsID).trigger("click");
            });

            $("#frmAddCotactToLists").submit(function () {
                $('.overlaynew').show();
                var formdata = $("#frmAddCotactToLists").serialize();
                $.ajax({
                    url: "{{ base_url('admin/utility/addContactToList') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            //alertMessage("Contact added to selected lists");
                            $("#chooselistModal").modal('hide');
                            window.location.href = '';
                        }
                    }
                });
                return false;

            });
            $("#frmReviewRequest").submit(function () {
                $('.overlaynew').show();
                var formdata = $("#frmReviewRequest").serialize();
                $.ajax({
                    url: "{{ base_url('admin/utility/sendReviewRequest') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            window.location.href = '';
                            $("#addReviewRequest").modal('hide');
                        }
                    }
                });
                return false;
            });


            $(".chooseModule").click(function () {
                $(".chooseModule").each(function () {
                    $(this).removeClass('active');
                });

                $(".contactaddlist").each(function () {
                    $(this).empty();
                });

                $(this).addClass('active');
                var moduleName = $(this).attr('module_name');

                $("#rrModuleList").addClass("addcontactlistpopup");
                $("#rrCampaignlist").show();
                $("#" + moduleName + "_campaign_container").show();
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('admin/utility/loadModuleCampaigns') }}",
                    type: "POST",
                    data: {module_name: moduleName, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $("#" + moduleName + "_campaign_container").html(data.result);
                        }
                    }
                });

            });
        });


        // top navigation fixed on scroll and side bar collasped

        $(window).scroll(function () {
            var sc = $(window).scrollTop();
            if (sc > 100) {
                $("#header-sroll").addClass("small-header");
            } else {
                $("#header-sroll").removeClass("small-header");
            }
        });

        function smallMenu() {
            if ($(window).width() < 1600) {
                $('body').addClass('sidebar-xs');
            } else {
                $('body').removeClass('sidebar-xs');
            }
        }

        $(document).ready(function () {
            smallMenu();

            window.onresize = function () {
                smallMenu();
            };
        });


        function showCommentsPopup(reviewID) {
            $.ajax({
                url: "{{ base_url('admin/reviews/getCommentsPopup') }}",
                type: "POST",
                data: {review_id: reviewID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.popupData;
                        $("#commentpopup").html(dataString);
                        $("#commentpopup").modal("show");
                    }
                }
            });
        }


        $(document).ready(function () {


            $('#checkAll').change(function () {

                if (false == $(this).prop("checked")) {

                    $(".checkRows").prop('checked', false);
                    $(".selectedClass").removeClass('success');
                    $('.custom_action_box').hide();
                } else {

                    $(".checkRows").prop('checked', true);
                    $(".selectedClass").addClass('success');
                    $('.custom_action_box').show();
                }

            });

            $(document).on('click', '.checkRows', function () {
                var inc = 0;


                var rowId = $(this).val();

                if (false == $(this).prop("checked")) {
                    $('#append-' + rowId).removeClass('success');
                } else {
                    $('#append-' + rowId).addClass('success');
                }

                $('.checkRows:checkbox:checked').each(function (i) {
                    inc++;
                });
                if (inc == 0) {

                    $('.custom_action_box').hide();
                } else {
                    $('.custom_action_box').show();
                }

                var numberOfChecked = $('.checkRows:checkbox:checked').length;
                var totalCheckboxes = $('.checkRows:checkbox').length;
                if (totalCheckboxes > numberOfChecked) {
                    $('#checkAll').prop('checked', false);
                }

            });

            $(document).on('click', '#deleteButtonReviewList', function () {

                var val = [];
                $('.checkRows:checkbox:checked').each(function (i) {
                    val[i] = $(this).val();
                });
                if (val.length === 0) {
                    alert('Please select a row.')
                } else {

                    var elem = $(this);
                    swal({
                            title: "Are you sure? You want to delete this record!",
                            text: "You will not be able to recover this record!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#EF5350",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel pls!",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: "{{ base_url('admin/reviews/deleteMultipalReview') }}",
                                    type: "POST",
                                    data: {multiReviewid: val, _token: '{{csrf_token()}}'},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            window.location.href = '';
                                        } else {
                                            alertMessage('Error: Some thing wrong!');
                                            $('.overlaynew').hide();
                                        }
                                    }
                                });
                            }
                        });
                }

            });


            $("#frmReviewTagListModal").submit(function () {
                var formdata = $("#frmReviewTagListModal").serialize();
                $.ajax({
                    url: "{{ base_url('admin/tags/applyReviewTag') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $("#ReviewTagListModal").modal("hide");
                            window.location.href = '';
                        }
                    }
                });
                return false;
            });

            $(document).on("click", ".displayReview", function () {
                var elem = $(this);
                var reviewid = $(this).attr("reviewid");
                var tabtype = $(this).attr('tab_type');
                var reviewTime = $(this).attr('review_time');
                displayReviewPopup(reviewid, tabtype, reviewTime);

            });

            $(document).on("click", ".showReviewPopup", function () {
                var reviewid = $(this).attr("reviewid");
                getReviewPopupData(reviewid, '');
            });

            function getReviewPopupData(reviewId, tabtype) {
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/getReviewPopupData') }}",
                    type: "POST",
                    data: {rid: reviewId, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            $('.overlaynew').hide();
                            $("#newreviewpopup").modal("show");
                            $("#reviewPopupBox").html(response.popupData);
                            if (tabtype == 'note') {
                                $('.tabbable a[href="#note-tab"]').trigger('click');
                            } else {
                                $('.tabbable a[href="#review-tab"]').trigger('click');
                            }
                        }
                    },
                    error: function (response) {
                        alertMessage(response.message);
                    }
                });
            }

            function displayReviewPopup(reviewid, tabtype, reviewTime) {
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/displayreview') }}",
                    type: "POST",
                    data: {rid: reviewid, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            $('.overlaynew').hide();
                            $("#reviewContent").html(response.popup_data);
                            $(".reviewTime").html(reviewTime);
                            $("#reviewPopup").modal("show");
                            if (tabtype == 'note') {
                                $('.tabbable a[href="#note-tab"]').trigger('click');
                            } else {
                                $('.tabbable a[href="#review-tab"]').trigger('click');
                            }
                        }
                    },
                    error: function (response) {
                        alertMessage(response.message);
                    }
                });
            }

            $(document).on("click", "#saveReviewNotes", function () {
                var formdata = $("#frmSaveNote").serialize();
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/saveReviewNotes') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            var reviewid = $("input[name='reviewid']").val();
                            var tabtype = 'note';
                            var reviewtime = $("input[name='reviewtime']").val();
                            displayReviewPopup(reviewid, tabtype, reviewtime);
                        }
                    },
                    error: function (response) {
                        alertMessage(response.message);
                    }
                });
            });

            $(document).on("click", "#saveReviewNotesPopup", function () {
                var formdata = $("#frmSaveNote").serialize();
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/saveReviewNotes') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            var reviewid = $("input[name='reviewid']").val();
                            var tabtype = 'note';
                            getReviewPopupData(reviewid, tabtype);
                        }
                    },
                    error: function (response) {
                        alertMessage(response.message);
                    }
                });
            });

        });

        $(document).ready(function () {

            $(document).on('click', '.showVideo', function () {

                var videoUrl = $(this).attr('videoUrl');
                $("#showVideoPopup").modal();
                $('#divVideo video source').attr('src', videoUrl);
                $("#divVideo video")[0].load();
                $('#downloadVideo').attr('href', videoUrl);
            });

            $(document).on('click', '.deleteReview', function () {

                var reviewID = $(this).attr('reviewid');
                swal({
                        title: "Are you sure? You want to delete this record!",
                        text: "You will not be able to recover this record!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {

                            $.ajax({
                                url: "{{ base_url('admin/reviews/deleteReview') }}",
                                type: "POST",
                                data: {reviewid: reviewID, _token: '{{csrf_token()}}'},
                                dataType: "json",
                                success: function (data) {

                                    if (data.status == 'success') {
                                        window.location.href = '';
                                    } else {
                                        alertMessage('Error: Some thing wrong!');
                                        $('.overlaynew').hide();
                                    }
                                }
                            });
                        }
                    });

            });

            $(document).on('click', '.editReview', function () {
                var reviewID = $(this).attr('reviewid');
                $.ajax({
                    url: "{{ base_url('admin/reviews/getReviewById') }}",
                    type: "POST",
                    data: {reviewid: reviewID, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {
                            var reviewData = data.result[0];

                            $('#edit_content').val(reviewData.comment_text);
                            $('#edit_review_title').val(reviewData.review_title);
                            $('#edit_reviewid').val(reviewData.id);
                            $('#stars li').each(function (index, value) {
                                $('#ratingValue').val(reviewData.ratings);
                                if (reviewData.ratings > index) {
                                    $(this).addClass('selected');
                                } else {
                                    $(this).removeClass('selected');
                                }
                            });
                            $("#editReview").modal();

                        } else {

                        }
                    }
                });
            });

            $(document).on('click', '.editVideoReview', function () {
                var reviewID = $(this).attr('reviewid');
                $.ajax({
                    url: "{{ base_url('admin/reviews/getReviewById') }}",
                    type: "POST",
                    data: {reviewid: reviewID, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {
                            var reviewData = data.result[0];
                            $('#edit_video_content').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + reviewData.comment_video);
                            $('#edit_video_reviewid').val(reviewData.id);
                            $('#edit_video_review_title').val(reviewData.review_title);
                            var start = '';
                            var startName = ['', 'Poor', 'Fair', 'Good', 'Excellent', 'WOW!!!'];
                            for (var inc = 1; inc <= 5; inc++) {
                                if (inc < reviewData.ratings || inc == reviewData.ratings) {

                                    start += "<li class='star txt_yellow' style='display:inline;' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star fa-fw' style='margin: 0;'></i></li>";
                                } else {
                                    start += "<li class='star txt_grey' style='display:inline;' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star-o fa-fw' style='margin: 0;'></i></li>";
                                }
                            }
                            $('#stars_video').html(start);
                            $('#ratingValueVideo').val(reviewData.ratings);
                            $('#stars_video li').each(function (index, value) {

                                if (reviewData.ratings > index) {
                                    $(this).addClass('selected');
                                } else {
                                    $(this).removeClass('selected');
                                }
                            });
                            $("#editVideoReview").modal();

                        } else {

                        }
                    }
                });
            });

            $("#updateReview").submit(function () {

                $('.overlaynew').show();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "{{ base_url('admin/reviews/update_review') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {
                            window.location.href = '';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            });


            $("#updateVideoReview").submit(function () {

                $('.overlaynew').show();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "{{ base_url('admin/reviews/update_video_review') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            window.location.href = '';
                        } else {

                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            });


            $(document).on('click', '.chg_status', function () {

                $('.overlaynew').show();
                var status = $(this).attr('change_status');
                var review_id = $(this).attr('review_id');
                $.ajax({
                    url: "{{ base_url('admin/reviews/update_review_status') }}",
                    type: "POST",
                    data: {status: status, review_id: review_id, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            window.location.href = '';

                        } else {

                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            });

            var ratingValueVideo = 0;

            $(document).on('click', '#stars_video li', function () {
                var onStar = parseInt($(this).data('value'), 10);
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                    $(stars[i]).children('i').removeClass('fa-star');
                    $(stars[i]).children('i').addClass('fa-star-o');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                    $(stars[i]).children('i').removeClass('fa-star-o');
                    $(stars[i]).children('i').addClass('fa-star');
                }

                ratingValueVideo = parseInt($('#stars_video li.selected').last().data('value'), 10);
                $('#ratingValueVideo').val(ratingValueVideo);

            });


            $(document).on('click', '.editDataReview', function () {
                $('.editAction').toggle();
            });

            /*-----------------------------------------------------------------------*/

            var noteStart = 10;
            var noteEnd = 20;
            var noteDiff = noteEnd - noteStart;

            $(document).on('click', '.loadMoreNotes', function () {
                $('.notesShow').slice(noteStart, noteEnd).slideDown();
                noteStart = Number(noteStart) + Number(noteDiff);
                noteEnd = Number(noteEnd) + Number(noteDiff);
                if ($(".notesShow:hidden").length == 0) {
                    $('.loadMoreRecordNotes').remove();
                }
            });

            /*-----------------------------------------------------------------------*/

            var emailStart = 10;
            var emailEnd = 20;
            var emailDiff = emailEnd - emailStart;

            $(document).on('click', '.loadMoreEmail', function () {
                $('.emailsShow').slice(emailStart, emailEnd).slideDown();
                emailStart = Number(emailStart) + Number(emailDiff);
                emailEnd = Number(emailEnd) + Number(emailDiff);
                if ($(".emailsShow:hidden").length == 0) {
                    $('.loadMoreRecordEmail').remove();
                }
            });

            /*-----------------------------------------------------------------------*/

            var smsStart = 10;
            var smsEnd = 20;
            var smsDiff = smsEnd - smsStart;

            $(document).on('click', '.loadMoreSms', function () {
                $('.smsShow').slice(smsStart, smsEnd).slideDown();
                smsStart = Number(smsStart) + Number(smsDiff);
                smsEnd = Number(smsEnd) + Number(smsDiff);
                if ($(".smsShow:hidden").length == 0) {
                    $('.loadMoreRecordSms').remove();
                }
            });

            /*-----------------------------------------------------------------------*/

            var activityStart = 10;
            var activityEnd = 20;
            var activityDiff = activityEnd - activityStart;

            $(document).on('click', '.loadMoreActivity', function () {
                $('.activityShow').slice(activityStart, activityEnd).slideDown();
                activityStart = Number(activityStart) + Number(activityDiff);
                activityEnd = Number(activityEnd) + Number(activityDiff);
                if ($(".activityShow:hidden").length == 0) {
                    $('.loadMoreRecordActivity').remove();
                }
            });

            /*-----------------------------------------------------------------------*/

            $(document).on('click', '.showNotes', function () {
                var notesId = $(this).attr('notesId');
                var noteText = $('#notes_' + notesId).text();
                convert(noteText);
                //$('.showNoteText').html(noteText);
                $('#showNotesPopup').modal();
            });


        });

        function convert(text) {
            //var text=document.getElementById("url").value;
            var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
            var text1 = text.replace(exp, "<a href='$1'>$1</a>");
            var exp2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
            document.getElementById("showNoteText").innerHTML = text1.replace(exp2, '$1<a target="_blank" href="http://$2">$2</a>');
        }


    </script>

@endsection
