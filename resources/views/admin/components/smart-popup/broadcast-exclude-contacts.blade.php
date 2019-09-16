@php
    $aSelectedContacts = array();
    $list_id = !(empty($list_id)) ? $list_id : '';
    if (!empty($oCampaignContacts)) {
        foreach ($oCampaignContacts as $oRec) {
            $aSelectedContacts[] = $oRec->subscriber_id;
        }
    }

    $iActiveCount = $iArchiveCount = 0;
    if (!empty($subscribersData)) {
        foreach ($subscribersData as $oCount) {
            if ($oCount->status == 2) {
                $iArchiveCount++;
            } else {
                $iActiveCount++;
            }
        }
    }
@endphp
<style>
    .box .table > tbody > tr > td {
        padding: 15px 15px 15px 15px !important;
    }

    .dataTables_paginate {
        margin-bottom: 0px !important
    }
</style>
<div class="col-md-12"><a style="left: 30px; top: 15px;"
                          class="reviews smart-broadcast-export-back slide-toggle bkg_grey_light"><i class=""><img
                src="{{ base_url() }}assets/images/icon_arrow_right.png"/></i></a>
    <h5 style="padding-left: 60px;" class="panel-title">Exclude from Contacts <span
            id="totalContactCount">{{ count($aSelectedContacts) }}</span></h5>
    <div style="margin-top: -13px;" class="heading-elements">
        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
            <input class="form-control input-sm cus_search" tableID="listSmartContacts" placeholder="Search by name"
                   type="text">
            <div class="form-control-feedback"><i class=""><img src="{{ base_url() }}assets/images/icon_search.png"
                                                                width="14"></i></div>
        </div>
        <div class="table_action_tool"><a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i
                    class=""><img src="{{ base_url() }}assets/images/icon_refresh.png"></i></a> <a
                href="javascript:void(0);"><i class=""><img
                        src="{{ base_url() }}assets/images/icon_calender.png"></i></a> <a href="javascript:void(0);"><i
                    class=""><img src="{{ base_url() }}assets/images/icon_download.png"></i></a> <a
                href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_upload.png"></i></a>
            <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_edit.png"></i></a>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-flat">
        <div class="p0 bkg_white bbot">
            <table class="table" id="listSmartContacts">
                <thead>
                <tr>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name</th>
                    <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Phone
                    </th>
                    <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_created.png"></i>Created
                    </th>
                    <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_action.png"></i>Action
                    </th>
                </tr>
                </thead>
                <tbody>

                @php
                    if (count($subscribersData) > 0) {
                        foreach ($subscribersData as $oContact) {
                            $userData = '';
                            if ($oContact->status != '2') {

                                if ($oContact->user_id > 0) {
                                    $userData = App\Models\Admin\UsersModel::getUserInfo($oContact->user_id);
                                }
                @endphp
                <tr>
                    <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                    <td style="display: none;">{{ $oContact->id }}</td>
                    <td>
                        <div class="media-left brig pr10">
                            <label class="custmo_checkbox ">
                                <input type="checkbox" name="checkRows[]" class="addToExcludeCampaign"
                                       value="{{ $oContact->subscriber_id }}"
                                       @if (in_array($oContact->subscriber_id, $aSelectedContacts))
                                       checked="checked"
                                    @endif
                                >
                                <span class="custmo_checkmark sblue"></span>
                            </label>
                        </div>
                        <div
                            class="media-left media-middle"> {!! @showUserAvtar($userData->avatar, $oContact->firstname, $oContact->lastname) !!} </div>
                        <div class="media-left">
                            <div class="pt-5"><a href="javascript:void(0);"
                                                 class="text-default text-semibold bbot">{{ $oContact->firstname }} {{ $oContact->lastname }}</a>
                                <img class="flags"
                                     src="{{ base_url() }}assets/images/flags/{{ strtolower($oContact->country_code) }}.png"
                                     onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                            <div class="text-muted text-size-small">{{ $oContact->email }}</div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="media-left text-right pull-right">
                            <div class=""><a href="#"
                                             class="txt_grey">{{ $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($oContact->phone) }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="media-left text-right pull-right">
                            <div class=""><a href="#" class="txt_grey">{{ dataFormat($oContact->created) }} <span
                                        class="txt_grey">{{ date('h:i A', strtotime($oContact->created)) }}</span></a>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="media-left pull-right">
                            <div class="tdropdown ml10"><a class="table_more dropdown-toggle" data-toggle="dropdown"
                                                           aria-expanded="true"><img
                                        src="{{ base_url() }}assets/images/more.svg"></a>
                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                    <a href="#" class="dropdown_close">X</a>

                                    <li><a class="moveToArchiveModuleContact" href="javascript:void(0);"
                                           data-modulesubscriberid="{{ $oContact->id }}"
                                           data-modulename="{{ $moduleName }}"
                                           data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-trash"></i> Move To
                                            Archive</a></li>

                                    @if ($oContact->status == 1 && $oContact->globalStatus == 1)
                                        <li><a class='changeModuleContactStatus'
                                               data-modulesubscriberid="{{ $oContact->id }}"
                                               data-modulename="{{ $moduleName }}"
                                               data-moduleaccountid="{{ $moduleUnitID }}" data_status='0'><i
                                                    class='icon-file-locked'></i> Inactive</a></li>
                                    @else
                                        <li><a class='
                                                        @if ($oContact->globalStatus == 1)
                                                changeModuleContactStatus
@else
                                                changeModuleContactStatusDisabled
@endif
                                                ' data-modulesubscriberid="{{ $oContact->id }}"
                                               data-modulename="{{ $moduleName }}"
                                               data-moduleaccountid="{{ $moduleUnitID }}" data_status='1'><i
                                                    class='icon-file-locked'></i> Active</a></li>
                                    @endif
                                    <li><a href="{{ base_url() }}admin/contacts/profile/{{ $oContact->subscriber_id }}"><i
                                                class="icon-eye"></i> View Details</a></li>
                                    <li><a href="javascript:void(0);" class="editModuleSubscriber"
                                           data-modulesubscriberid="{{ $oContact->id }}"
                                           data-modulename="{{ $moduleName }}"
                                           data-moduleaccountid="{{ $moduleUnitID }}"
                                           data-redirect="admin/lists/getListContacts?list_id={{ $list_id }}"><i
                                                class="icon-pencil"></i> Edit</a></li>

                                    <li><a class="deleteModuleSubscriber" data-modulesubscriberid="{{ $oContact->id }}"
                                           data-modulename="{{ $moduleName }}"
                                           data-moduleaccountid="{{ $moduleUnitID }}" csrf_token="{{ csrf_token() }}"
                                           href="javascript:void(0);"><i class="icon-trash"></i> Delete</a></li>
                                </ul>
                            </div>
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

