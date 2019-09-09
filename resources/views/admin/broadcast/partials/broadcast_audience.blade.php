@php
    $recordSource = !(empty($recordSource)) ? $recordSource : '';
    $moduleName = !(empty($moduleName)) ? $moduleName : 'broadcast';
    $aSelectedContacts = !(empty($aSelectedContacts)) ? $aSelectedContacts : array();

    if ($recordSource == 'contact-selection') {
        $tableID = 'broadcastAudience';
        $prefix = 'cl';
    } else if ($recordSource == 'review-audience') {
        $tableID = 'editBroadcastAudience';
        $prefix = 'ml';
    } else {
        $tableID = 'broadcastAudience2';
        $prefix = '';
    }
@endphp
@if (count($oBroadcastSubscriber) > 0)
    <table class="table" id="{{ $tableID }}">
        <thead>
        <tr>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th class="nosort">
                <div class="brig pr10 editActionContact" style="display:none;">
                    <label class="custmo_checkbox pull-left">
                        <input type="checkbox" name="checkAll[]"
                               broadcast_id="{{ !empty($oBroadcast) ? $oBroadcast->broadcast_id : '' }}"
                               class="control-primary" id="checkAllContact">
                        <span class="custmo_checkmark"></span>
                    </label>
                </div> &nbsp;&nbsp;<i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name
            </th>
            <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_email_small.png"></i>Email
            </th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Phone</th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Social</th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_id.png"></i>Tags</th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
        </tr>
        </thead>
        <tbody>
        @php
            foreach ($oBroadcastSubscriber as $oContact) {
                $subscriberID = $oContact->subscriber_id;
                $oTags = $mTags->getSubscriberTags($subscriberID);
                $iTagCount = count($oTags);
                $userData = '';
                if ($oContact->status != '2') {

                    if ($oContact->user_id > 0) {
                        $userData = \App\Models\Admin\UsersModel::getUserInfo($oContact->user_id);
                    }

                    if (empty($userData->avatar)) {
                        $profileImage = '<a class="icons fl_letters s32" href="' . base_url() . 'admin/contacts/profile/' . $oContact->subscriber_id . '">' . ucfirst(substr($oContact->firstname, 0, 1)) . '' . ucfirst(substr($oContact->lastname, 0, 1)) . '</a>';
                    } else {
                        $profileImage = '<a class="icons s32" href="' . base_url() . 'admin/contacts/profile/' . $oContact->subscriber_id . '"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $userData->avatar . '" onerror="this.src=\'/assets/images/userp.png\'" class="img-circle img-xs" alt=""></a>';
                    }
        @endphp
        <tr id="append-con-{{ $prefix }}-{{ $oContact->subscriber_id }}" class="selectedClass">
            <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
            <td style="display: none;">{{ $oContact->subscriber_id }}</td>
            <td>
                <div class="media-left brig pr10 editActionContact" style="display:none;">
                    <label class="custmo_checkbox ">
                        <input type="checkbox" name="checkRows[]" class="addToBroadcast"
                               value="{{ $oContact->subscriber_id }}"
                               @if (in_array($oContact->subscriber_id, $aSelectedContacts))
                               checked="checked"
                               @endif
                               tblid="{{ $tableID }}">
                        <span class="custmo_checkmark sblue"></span>
                    </label>
                </div>
                <div class="media-left media-middle" class="viewContactSmartPopup"
                     data-modulesubscriberid="{{ $oContact->id }}"
                     data-modulename="{{ $moduleName }}"> {{ @showUserAvtar($userData->avatar, $oContact->firstname, $oContact->lastname) }} </div>
                <div class="media-left" class="viewContactSmartPopup" data-modulesubscriberid="{{ $oContact->id }}"
                     data-modulename="{{ $moduleName }}">
                    <div class="pt-5"><a href="javascript:void(0);"
                                         class="text-default text-semibold bbot">{{ $oContact->firstname }} {{ $oContact->lastname }}</a>
                        <img class="flags"
                             src="{{ base_url() }}assets/images/flags/{{ strtolower($oContact->country_code) }}.png"
                             onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                </div>
            </td>

            <td class="viewContactSmartPopup" data-modulesubscriberid="{{ $oContact->id }}"
                data-modulename="{{ $moduleName }}">
                <div class="media-left pull-right pr0"><a href="javascript:void(0);"
                                                          class="text-default text-semibold">{{ $oContact->email }}</a>
                </div>

            </td>

            <td class="viewContactSmartPopup" data-modulesubscriberid="{{ $oContact->id }}"
                data-modulename="{{ $moduleName }}">
                <div class="media-left">
                    <div class="pt-5"><span
                            class="text-default text-semibold dark">{{ $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($oContact->phone) }}</span>
                    </div>

                </div>
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
                   href="{{ $oContact->facebook_profile }}" target="_blank" title="View facebook profile"
                   @else
                   href="javascript:void(0);" title="This profile not found"
                    @endif
                ><img src="{{ base_url() }}assets/images/icons/facebook.svg"/></a>
                <a class="icons social" href="{{ $oContact->socialProfile }}"><img
                        src="{{ base_url() }}assets/images/icons/google.svg"/></a>
                <a class="icons social" href="mailto:{{ $oContact->email }}"><img
                        src="{{ base_url() }}assets/images/icons/mail.svg"/></a>

            </td>
            <td>
                <div class="media-left pr30 brig">
                    <div class="tdropdown tag_container_{{ $oContact->subscriber_id }}">
                        <button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle"
                                data-toggle="dropdown"> {{ count($oTags) }} Tags <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right tagss">
                            @if (count($oTags) > 0)
                                @foreach ($oTags as $oTag)
                                    <button class="btn btn-xs btn_white_table pr10"> {{ $oTag->tag_name }} </button>
                                @endforeach
                            @endif
                            <button class="btn btn-xs plus_icon ml10 applyInsightTags"
                                    data-subscriber-id="{{ $oContact->subscriber_id }}"><i class="icon-plus3"></i>
                            </button>
                        </ul>
                        <button class="btn btn-xs plus_icon ml10 applyInsightTags"
                                data-subscriber-id="{{ $oContact->subscriber_id }}"><i class="icon-plus3"></i></button>
                    </div>
                </div>
            </td>
            <td>
                <div class="media-left pull-right">
                    <div class="tdropdown ml10"><a class="table_more dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><img
                                src="{{ base_url() }}assets/images/more.svg"></a>
                        <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">

                            <li><a href="javascript:void(0);" class="deleteAudience"
                                   broadcast_id="{{ !empty($oBroadcast) ? $oBroadcast->broadcast_id : '' }}"
                                   subscriber_id="{{ $oContact->subscriber_id }}"><i
                                        class="icon-primitive-dot txt_red"></i> Delete</a></li>

                        </ul>
                    </div>
                </div>
                <div class="media-left pull-right">
                    <div class=""><a href="#"
                                     class="text-default text-semibold">{{ date('d M', strtotime($oContact->created)) }}</a>
                    </div>
                </div>
            </td>
        </tr>
        @php
            }
        }
        @endphp
        </tbody>
    </table>
@else
    <table class="table datatable-basic">
        <thead>
        <tr>
            <th class="nosort">
                <div class="brig pr10 editActionContact" style="display:none;">
                    <label class="custmo_checkbox pull-left">
                        <input type="checkbox" name="checkAll[]" broadcast_id="{{ $oBroadcast->broadcast_id }}"
                               class="control-primary" id="checkAllContact">
                        <span class="custmo_checkmark"></span>
                    </label>
                </div> &nbsp;&nbsp;<i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name
            </th>
            <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_email_small.png"></i>Email
            </th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Phone</th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Social</th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_id.png"></i>Tags</th>
            <th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
        </tr>
        </thead>

        <tbody>
        <td style="display: none"></td>
        <td style="display: none"></td>
        <td colspan="10">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 20px 0px 0;" class="text-center">
                        <h5 class="mb-20 mt40">
                            Looks Like You Don’t Have Any Contact Yet <img
                                src="{{ base_url('assets/images/smiley.png') }}"> <br>
                            Lets Create Your First Contact.
                        </h5>
                    </div>
                </div>
            </div>
        </td>
        <td style="display: none"></td>
        <td style="display: none"></td>
        <td style="display: none"></td>
        </tbody>
    </table>
@endif

@if ($recordSource == 'contact-selection')
    <script type="text/javascript">
        $(document).ready(function () {
            var tableId = 'broadcastAudience';
            var tableBase = custom_data_table(tableId);
        });
    </script>
@elseif ($recordSource == 'review-audience')
    <script type="text/javascript">
        $(document).ready(function () {
            var tableId = 'editBroadcastAudience';
            var tableBase = custom_data_table(tableId);
        });
    </script>
@endif
