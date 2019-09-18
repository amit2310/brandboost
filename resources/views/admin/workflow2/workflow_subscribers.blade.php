@php
    $iActiveCount = $iArchiveCount = 0;

    $showArchived = isset($showArchived) ? $showArchived : '';
    if (!empty($subscribersData)) {
        foreach ($subscribersData as $oCount) {
            if ($oCount->status == 2) {
                $iArchiveCount++;
            } else {
                $iActiveCount++;
            }
        }
    }
    if(empty($subscribersData)){
        $subscribersData = \App\Models\Admin\WorkflowModel::getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
    }


    if(!empty($subscribersData)) {
@endphp

<div class="tab-pane active" id="right-icon-tab0">
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                @include('admin.components.smart-popup.smart-contact-widget')
                <div class="panel-heading">
                    <span class="pull-left">
                        <h6 class="panel-title">{{ $iActiveCount }} Contacts</h6>
                    </span>
                    <div class="heading_links pull-left">
                        <button type="button" class="btn btn-xs btn_white_table ml20">All</button>
                        <a class="top_links txt_blue" href="#">Customers USA</a>
                        <a class="top_links" href="#">Added reviews</a>
                        <a class="top_links" href="#">Age 25-40</a>
                        <a class="top_links" href="#">Negative review</a>
                    </div>

                    <div class="heading-elements">

                        <div style="display: inline-block; margin: 0;"
                             class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" tableID="mySubsContact"
                                   placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class=""><img src="{{ base_url() }}assets/images/icon_search.png"/ width="14"></i>
                            </div>
                        </div>
                        <div class="table_action_tool">
                            <a href="javascript:void(0);"><i class=""><img
                                        src="{{ base_url() }}assets/images/icon_calender.png"/></i></a>
                            <a href="javascript:void(0);" class="editDataList"><i class=""><img
                                        src="{{ base_url() }}assets/images/icon_edit.png"/></i></a>
                            <a href="javascript:void(0);" id="deleteBulkModuleContacts" class="custom_action_box"
                               style="display:none;" data-modulename="{{ $moduleName }}"
                               data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-trash position-left"></i></a>
                            <button id="archiveBulkModuleContacts" class="btn btn-xs custom_action_box"
                                    data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}"><i
                                    class="icon-gear position-left"></i> Archive
                            </button>
                        </div>
                    </div>
                </div>

                <div class="panel-body p0">
                    <table class="table" id="mySubsContact">
                        <thead>

                        <tr>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th style="display: none;" class="nosort editAction" style="width:30px;"><label
                                    class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]"
                                                                             class="control-primary" id="checkAll"><span
                                        class="custmo_checkmark"></span></label></th>

                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Phone</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Source</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Social</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_id.png"></i>Tags</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_status.png"></i>Status</th>
                            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            if (count($subscribersData) > 0) {
                                foreach ($subscribersData as $oContact) {
                                    $subscriberID = $oContact->subscriber_id;

                                    $oTags = \App\Models\Admin\TagsModel::getSubscriberTags($subscriberID);
                                    $iTagCount = count($oTags);
                                    $userData = '';
                                    $profileImage = '';
                                    if ($oContact->status != '2') {

                                        if ($oContact->user_id > 0) {
                                            $userData = \App\Models\Admin\UsersModel::getUserInfo($oContact->user_id);

                                            $profileImage = '<a class="icons s32" href="' . base_url() . 'admin/contacts/profile/' . $oContact->subscriber_id . '"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($userData->avatar) . '" onerror="this.src=\'/assets/images/userp.png\'" class="img-circle img-xs" alt=""></a>';
                                        }

                                        if (empty($profileImage)) {
                                            $profileImage = '<a class="icons fl_letters s32" href="' . base_url() . 'admin/contacts/profile/' . $oContact->subscriber_id . '">' . ucfirst(substr($oContact->firstname, 0, 1)) . '' . ucfirst(substr($oContact->lastname, 0, 1)) . '</a>';

                                        }
                        @endphp
                        <tr id="append-{{ $oContact->subscriber_id }}" class="selectedClass">
                            <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                            <td style="display: none;">{{ $oContact->subscriber_id }}</td>
                            <td style="display: none;" class="editAction"><label
                                    class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]"
                                                                             class="checkRows"
                                                                             value="{{ $oContact->subscriber_id }}"><span
                                        class="custmo_checkmark"></span></label></td>


                            <td class="viewContactSmartPopup" data-modulesubscriberid="{{ $oContact->id }}"
                                data-modulename="{{ $moduleName }}">
                                <div
                                    class="media-left media-middle"> {!! showUserAvtar($userData->avatar, $oContact->firstname, $oContact->lastname) !!} </div>
                                <div class="media-left">
                                    <div class="pt-5"><a href="javascript:void(0);"
                                                         class="text-default text-semibold bbot">{{ $oContact->firstname }} {{ $oContact->lastname }}</a>
                                        <img class="flags"
                                             src="{{ base_url() }}assets/images/flags/{{ @strtolower($oContact->country_code) }}.png"
                                             onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                                    <div class="text-muted text-size-small">{{ $oContact->email }}</div>
                                </div>
                            </td>

                            <td class="viewContactSmartPopup" data-modulesubscriberid="{{ $oContact->id }}"
                                data-modulename="{{ $moduleName }}">
                                <div class="media-left">
                                    <div class="pt-5"><span
                                            class="text-default text-semibold dark">{!! $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($oContact->phone) !!}</span>
                                    </div>

                                    {!! ($oContact->phone == '') ? '' : '<div class="text-muted text-size-small">Chat</div>' !!}

                                </div>
                            </td>
                            <td class="viewContactSmartPopup" data-modulesubscriberid="{{ $oContact->id }}"
                                data-modulename="{{ $moduleName }}">
                                <div class="media-left">
                                    <div class="pt-5"><span
                                            class="text-default text-semibold dark">{{ date('F dS Y', strtotime($oContact->created)) }}</span>
                                    </div>
                                    <div
                                        class="text-muted text-size-small">{{ date('h:i A', strtotime($oContact->created)) }}</div>
                                </div>
                            </td>

                            <td class="viewContactSmartPopup" data-modulesubscriberid="{{ $oContact->id }}"
                                data-modulename="{{ $moduleName }}">
                                <div class="media-left text-right">
                                    <div class="pt-5"><span class="text-default text-semibold dark">Email</span></div>
                                    <div class="text-muted text-size-small">Form #183</div>
                                </div>
                                <div class="media-left media-middle brig pr10"><span class="icons s28"><img
                                            src="{{ base_url() }}assets/images/icon_round_email.png"
                                            class="img-circle img-xs" alt=""></span></div>
                            </td>
                            <td>
                                <a class="icons social"
                                   @if (!empty($oContact->twitter_profile))
                                   href="{{ $oContact->twitter_profile }}" target="_blank" title="View twitter profile"
                                   @else
                                   href="javascript:void(0);" title="This profile not found"
                                    @endif
                                ><img src="{{ base_url() }}assets/images/icons/twitter.svg"/></a>
                                <a class="icons social"
                                   @if (!empty($oContact->facebook_profile))
                                   href="{{ $oContact->facebook_profile }}"
                                   target="_blank" title="View facebook profile"
                                   @else
                                   href="javascript:void(0);"
                                   title="This profile not found"
                                    @endif
                                ><img
                                        src="{{ base_url() }}assets/images/icons/facebook.svg"/></a>
                                <a class="icons social" href="{{ @($oContact->socialProfile) }}"><img
                                        src="{{ base_url() }}assets/images/icons/google.svg"/></a>
                                <a class="icons social" href="mailto:{{ $oContact->email }}"><img
                                        src="{{ base_url() }}assets/images/icons/mail.svg"/></a>
                            </td>

                            <td id="tag_container_{{ $oContact->subscriber_id }}">
                                <div class="media-left pl30 blef">
                                    <div class=""><a href="javascript:void(0);"
                                                     class="text-default text-semibold bbot">{{ count($oTags) }}Tags</a>
                                    </div>
                                </div>
                                <div class="media-left pr30 brig">
                                    <div class="tdropdown">
                                        <button class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown"
                                                aria-expanded="false"><i class="icon-plus3"></i></button>
                                        <ul style="right: 0px!important;"
                                            class="dropdown-menu dropdown-menu-right tagss">
                                            @if (count($oTags) > 0)
                                                @foreach ($oTags as $oTag)
                                                    <button
                                                        class="btn btn-xs btn_white_table pr10"> {{ $oTag->tag_name }} </button>
                                                @endforeach
                                            @endif
                                            <button class="btn btn-xs plus_icon ml10 applyInsightTags"
                                                    data-subscriber-id="{{ $oContact->subscriber_id }}"><i
                                                    class="icon-plus3"></i></button>
                                        </ul>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="tdropdown">
                                    {!! ($oContact->status == 1 && $oContact->globalStatus == 1) ? '<i class="icon-primitive-dot txt_green fsize16"></i>' : '<i class="icon-primitive-dot txt_red fsize16"></i>' !!}
                                    <a class="text-default text-semibold bbot dropdown-toggle"
                                       data-toggle="dropdown">{{ ($oContact->status == 1 && $oContact->globalStatus == 1) ? ' Active' : ' Inactive' }}</a>
                                    <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                        @if ($oContact->status == 1 && $oContact->globalStatus == 1)
                                            <li><a class='changeModuleContactStatus'
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}" data_status='0'
                                                   csrf_token="{{ csrf_token() }}"><i
                                                        class="icon-primitive-dot txt_grey"></i> Inactive</a></li>
                                        @else
                                            <li>
                                                <a class="
                                            @if ($oContact->globalStatus == 1)
                                                    changeModuleContactStatus
                                            @else
                                                    changeModuleContactStatusDisabled
                                            @endif
                                                    "
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}" data_status='1'
                                                   csrf_token="{{ csrf_token() }}"><i
                                                        class="icon-primitive-dot txt_green"></i> Active</a></li>
                                        @endif
                                        <li><a class="moveToArchiveModuleContact" href="javascript:void(0);"
                                               data-modulesubscriberid="{{ $oContact->id }}"
                                               data-modulename="{{ $moduleName }}"
                                               data-moduleaccountid="{{ $moduleUnitID }}"
                                               csrf_token="{{ csrf_token() }}"><i
                                                    class="icon-primitive-dot txt_red"></i> Archive</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="tdropdown ml10"><a class="table_more dropdown-toggle"
                                                               data-toggle="dropdown"><img
                                            src="{{ base_url() }}assets/images/more.svg"></a>
                                    <ul style="right: 0; width:150px;" class="dropdown-menu dropdown-menu-right status">
                                        @if($showArchived == true)
                                            <li><a class="moveToArchiveModuleContact" href="javascript:void(0);"
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}"
                                                   csrf_token="{{ csrf_token() }}"><i class="icon-trash"></i> Move To
                                                    Archive</a></li>
                                        @endif
                                        @if ($oContact->status == 1 && $oContact->globalStatus == 1)
                                            <li><a class='changeModuleContactStatus'
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}" data_status='0'
                                                   csrf_token="{{ csrf_token() }}"><i class='icon-file-locked'></i>
                                                    Inactive</a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="
                                                @if ($oContact->globalStatus == 1)
                                                    changeModuleContactStatus
                                                @else
                                                    changeModuleContactStatusDisabled
                                                @endif
                                                    "
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}" data_status='1'
                                                   csrf_token="{{ csrf_token() }}"><i class='icon-file-locked'></i>
                                                    Active</a></li>
                                        @endif
                                        <li>
                                            <a href="{{ base_url() }}admin/contacts/profile/{{ $oContact->subscriber_id }}"><i
                                                    class="icon-eye"></i> View Details</a></li>
                                        @if($showArchived == true)
                                            <li><a href="javascript:void(0);" class="editModuleSubscriber"
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}"
                                                   data-redirect="admin/lists/getListContacts?list_id={{ (!empty($list_id)) ? $list_id : '' }}"><i
                                                        class="icon-pencil"></i> Edit</a></li>
                                        @endif
                                        <li><a class="deleteModuleSubscriber"
                                               data-modulesubscriberid="{{ $oContact->id }}"
                                               data-modulename="{{ $moduleName }}"
                                               data-moduleaccountid="{{ $moduleUnitID }}"
                                               csrf_token="{{ csrf_token() }}" href="javascript:void(0);"><i
                                                    class="icon-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @php
                            }
                        }
                    }
                        @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    }
   else {

@endphp
<div class="tab-pane active" id="right-icon-tab0">
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                @include('admin.components.smart-popup.smart-contact-widget')
                <div class="panel-heading">
                    <span class="pull-left">
                        <h6 class="panel-title">{{ $iActiveCount }} Contacts</h6>
                    </span>
                    <div class="heading_links pull-left">
                        <button type="button" class="btn btn-xs btn_white_table ml20">All</button>
                        <a class="top_links txt_blue" href="#">Customers USA</a>
                        <a class="top_links" href="#">Added reviews</a>
                        <a class="top_links" href="#">Age 25-40</a>
                        <a class="top_links" href="#">Negative review</a>
                    </div>

                    <div class="heading-elements">

                        <div style="display: inline-block; margin: 0;"
                             class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" tableID="mySubsContact"
                                   placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class=""><img src="{{ base_url() }}assets/images/icon_search.png"/ width="14"></i>
                            </div>
                        </div>
                        <div class="table_action_tool">
                            <a href="javascript:void(0);"><i class=""><img
                                        src="{{ base_url() }}assets/images/icon_calender.png"/></i></a>
                            <a href="javascript:void(0);" class="editDataList"><i class=""><img
                                        src="{{ base_url() }}assets/images/icon_edit.png"/></i></a>
                            <a href="javascript:void(0);" id="deleteBulkModuleContacts" class="custom_action_box"
                               style="display:none;" data-modulename="{{ $moduleName }}"
                               data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-trash position-left"></i></a>
                            <button id="archiveBulkModuleContacts" class="btn btn-xs custom_action_box"
                                    data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}"><i
                                    class="icon-gear position-left"></i> Archive
                            </button>
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
                                    class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]"
                                                                             class="control-primary" id="checkAll"><span
                                        class="custmo_checkmark"></span></label></th>

                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Phone</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Source</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Social</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_id.png"></i>Tags</th>
                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_status.png"></i>Status</th>
                            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td colspan="10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin: 20px 0px 0;" class="text-center">
                                            <h5 class="mb-20 mt40">
                                                Looks Like You Don’t Have Any Contact Yet <img
                                                    src="{{ site_url('assets/images/smiley.png') }}"> <br>
                                                Lets Create Your First Contact.
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    }
@endphp


@if ($showArchived == true)
    <div class="tab-pane" id="right-icon-tab1">
        <div class="row">
            <div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <span class="pull-left">
                            <h6 class="panel-title">{{ $iArchiveCount }} Contacts</h6>
                        </span>

                        <div class="heading_links pull-left">
                            <button type="button" class="btn btn-xs btn_white_table ml20">All</button>
                            <a class="top_links txt_blue" href="#">Customers USA</a>
                            <a class="top_links" href="#">Added reviews</a>
                            <a class="top_links" href="#">Age 25-40</a>
                            <a class="top_links" href="#">Negative review</a>
                        </div>

                        <div class="heading-elements">

                            <div style="display: inline-block; margin: 0;"
                                 class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm cus_search" placeholder="Search by name"
                                       type="text">
                                <div class="form-control-feedback">
                                    <i class=""><img src="{{ base_url() }}assets/images/icon_search.png"/
                                        width="14"></i>
                                </div>
                            </div>
                            <div class="table_action_tool">
                                <a href="javascript:void(0);"><i class=""><img
                                            src="{{ base_url() }}assets/images/icon_calender.png"/></i></a>
                                <a href="javascript:void(0);" class="editArchiveDataList"><i class=""><img
                                            src="{{ base_url() }}assets/images/icon_edit.png"/></i></a>
                                <a href="javascript:void(0);" id="deleteBulkArchiveModuleContacts"
                                   class="custom_archive_action_box" style="display:none;"
                                   data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}"><i
                                        class="icon-trash position-left"></i></a>
                                <button id="activeBulkModuleContacts" class="btn btn-xs custom_archive_action_box"
                                        data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}"
                                        style="display:none;"><i class="icon-gear position-left"></i> Make Active
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="panel-body p0">
                        <table class="table datatable-basic">
                            <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="display: none;" class="nosort editArchiveAction" style="width:30px;"><label
                                        class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                 name="checkArchiveAll[]"
                                                                                 class="control-primary"
                                                                                 id="checkArchiveAll"><span
                                            class="custmo_checkmark"></span></label></th>
                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name</th>
                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Phone</th>
                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Source</th>
                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Social</th>
                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_id.png"></i>Tags</th>
                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_status.png"></i>Status</th>
                                <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php

                                if (count($subscribersData) > 0) {
                                foreach ($subscribersData as $oContact) {
                                $subscriberID = $oContact->subscriber_id;
                                $oTags = \App\Models\Admin\TagsModel::getSubscriberTags($subscriberID);
                                $iTagCount = count($oTags);

                                if ($oContact->status == '2') {
                                if ($oContact->user_id > 0) {
                                $userData = \App\Models\Admin\UsersModel::getUserInfo($oContact->user_id);
                                }

                                if ($userData->avatar == '') {
                                $profileImage = '<a class="icons fl_letters s32" href="' . base_url() . 'admin/contacts/profile/' . $oContact->subscriber_id . '">' . ucfirst(substr($oContact->firstname, 0, 1)) . '' . ucfirst(substr($oContact->lastname, 0, 1)) . '</a>';
                                } else {
                                $profileImage = '<a class="icons s32" href="' . base_url() . 'admin/contacts/profile/' . $oContact->subscriber_id . '"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($userData->avatar) . '" onerror="this.src=\'/assets/images/userp.png\'" class="img-circle img-xs" alt=""></a>';
                                }
                            @endphp
                            <tr id="append-{{ $oContact->subscriber_id }}" class="selectedClass">
                                <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                                <td style="display: none;">{{ $oContact->id }}</td>
                                <td style="display: none;" class="editArchiveAction"><label
                                        class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]"
                                                                                 class="checkArchiveRows"
                                                                                 value="{{ $oContact->id }}"><span
                                            class="custmo_checkmark"></span></label></td>

                                <td>
                                    <div class="media-left media-middle"> {!! $profileImage !!} </div>
                                    <div class="media-left">
                                        <div class="pt-5"><a
                                                href="{{ base_url() }}admin/contacts/profile/{{ $oContact->subscriber_id }}"
                                                class="text-default text-semibold bbot">{{ $oContact->firstname }} {{ $oContact->lastname }}</a>
                                            <img class="flags"
                                                 src="{{ base_url() }}assets/images/flags/{{ strtolower($oContact->country_code) }}.png"
                                                 onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/>
                                        </div>
                                        <div class="text-muted text-size-small">{{ $oContact->email }}</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="media-left">
                                        <div class="pt-5"><span
                                                class="text-default text-semibold dark">{{ $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oContact->phone }}</span>
                                        </div>
                                        {!! $oContact->phone == '' ? '' : '<div class="text-muted text-size-small">Chat</div>' !!}
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left">
                                        <div class="pt-5"><span
                                                class="text-default text-semibold dark">{{ date('F dS Y', strtotime($oContact->created)) }}</span>
                                        </div>
                                        <div
                                            class="text-muted text-size-small">{{ date('h:i A', strtotime($oContact->created)) }}</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="media-left text-right">
                                        <div class="pt-5"><span class="text-default text-semibold dark">Email</span>
                                        </div>
                                        <div class="text-muted text-size-small">Form #183</div>
                                    </div>
                                    <div class="media-left media-middle brig pr10"><span class="icons s28"><img
                                                src="{{ base_url() }}assets/images/icon_round_email.png"
                                                class="img-circle img-xs" alt=""></span></div>
                                </td>

                                <td>
                                    <a class="icons social"
                                       @if (!empty($oContact->twitter_profile))
                                       href="{{ $oContact->twitter_profile }}"
                                       target="_blank" title="View twitter profile"
                                       @else
                                       href="javascript:void(0);" title="This profile not found"
                                        @endif
                                    ><img
                                            src="{{ base_url() }}assets/images/icons/twitter.svg"/></a>
                                    <a class="icons social"
                                       @if (!empty($oContact->facebook_profile))
                                       href="{{ $oContact->facebook_profile }}"
                                       target="_blank" title="View facebook profile"
                                       @else
                                       href="javascript:void(0);"
                                       title="This profile not found"
                                        @endif
                                    ><img
                                            src="{{ base_url() }}assets/images/icons/facebook.svg"/></a>
                                    <a class="icons social" href="{{ $oContact->socialProfile }}"><img
                                            src="{{ base_url() }}assets/images/icons/google.svg"/></a>
                                    <a class="icons social" href="mailto:{{ $oContact->email }}"><img
                                            src="{{ base_url() }}assets/images/icons/mail.svg"/></a>
                                </td>

                                <td id="tag_container_{{ $oContact->subscriber_id }}">
                                    <div class="media-left pl30 blef">
                                        <div class=""><a href="javascript:void(0);"
                                                         class="text-default text-semibold bbot">{{ count($oTags) }}
                                                Tags</a>
                                        </div>
                                    </div>
                                    <div class="media-left pr30 brig">
                                        <div class="tdropdown">
                                            <button class="btn btn-xs plus_icon dropdown-toggle ml10"
                                                    data-toggle="dropdown"
                                                    aria-expanded="false"><i class="icon-plus3"></i></button>
                                            <ul style="right: 0px!important;"
                                                class="dropdown-menu dropdown-menu-right tagss">
                                                @if (count($oTags) > 0)
                                                    @foreach ($oTags as $oTag)
                                                        <button
                                                            class="btn btn-xs btn_white_table pr10"> {{ $oTag->tag_name }} </button>
                                                    @endforeach
                                                @endif
                                                <button class="btn btn-xs plus_icon ml10 applyInsightTags"
                                                        data-subscriber-id="{{ $oContact->subscriber_id }}"><i
                                                        class="icon-plus3"></i></button>
                                            </ul>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="tdropdown">
                                        {!! ($oContact->status == 1 && $oContact->globalStatus == 1) == 1 ? '<i class="icon-primitive-dot txt_green fsize16"></i>' : '<i class="icon-primitive-dot txt_red fsize16"></i>' !!}
                                        <a class="text-default text-semibold bbot dropdown-toggle"
                                           data-toggle="dropdown">{{ ($oContact->status == 1 && $oContact->globalStatus == 1) ? ' Active' : ' Archive' }}</a>
                                        <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                            <li><a class='changeModuleContactStatus'
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}" data_status='0'
                                                   csrf_token="{{ csrf_token() }}"><i
                                                        class="icon-primitive-dot txt_grey"></i> Inactive</a></li>

                                            <li><a class='changeModuleContactStatus'
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}" data_status='1'
                                                   csrf_token="{{ csrf_token() }}"><i
                                                        class="icon-primitive-dot txt_green"></i> Active</a></li>
                                        </ul>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="tdropdown ml10"><a class="table_more dropdown-toggle"
                                                                   data-toggle="dropdown"><img
                                                src="{{ base_url() }}assets/images/more.svg"></a>
                                        <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                            <li><a class="moveToActiveModuleContact"
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}"><i
                                                        class='icon-file-locked'></i> Make Active</a></li>

                                            <li><a href="javascript:void(0);" class="editModuleSubscriber"
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}"
                                                   data-redirect="admin/lists/getListContacts?list_id={{ $list_id }}"><i
                                                        class="icon-pencil"></i> Edit</a></li>

                                            <li><a class="deleteModuleSubscriber"
                                                   data-modulesubscriberid="{{ $oContact->id }}"
                                                   data-modulename="{{ $moduleName }}"
                                                   data-moduleaccountid="{{ $moduleUnitID }}"
                                                   csrf_token="{{ csrf_token() }}" href="javascript:void(0);"><i
                                                        class="icon-trash"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @php
                                }
                                }
                                }
                            @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div id="subscriberTagListsModal" class="modal fade" style="z-index:9999999999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmSubscriberApplyTag" id="frmSubscriberApplyTag" action="javascript:void();">
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


<!-- /content area -->
<script src="{{ base_url() }}assets/js/modules/people/subscribers.js" type="text/javascript"></script>

<script type="text/javascript">

    var tableId = 'mySubsContact';
    var tableBase = custom_data_table(tableId);

    $(document).ready(function () {
        $(document).on('click', '#addContactForm', function () {
            $('.addModuleContact').trigger('click');
        });
    });
</script>
