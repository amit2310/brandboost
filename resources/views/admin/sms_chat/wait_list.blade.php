@php
    $count = 0;
    $showRed = 0;
    foreach ($wait_list as $key => $value) {
        $phoneNumber = "";
        if ($value->to != '' && $value->from != '') {
            $value->to = phone_display_custom_helper($value->to);
            $value->from = phone_display_custom_helper($value->from);
            if (trim($value->to) == trim($mobile)) {
                $usersdata = getUserbyPhone($value->from);
                $phoneNumber = $value->from;
                $usersdata = $usersdata[0];
                if ($value->read_status == 0) {
                    $showRed = 1;
                }
            }
            if ($value->from == $mobile) {
                $usersdata = getUserbyPhone($value->to);
                $phoneNumber = $value->to;
                $usersdata = $usersdata[0];
            }
            $userDataDetail = getUserDetail($usersdata->user_id);
            $favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id, $usersdata->id);
            $fileext = end(explode('.', $value->msg));
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $userMessage = "Attachment: 1 Image";
            } else if ($value->media_type == 'video' || $value->media_type == 'image') {
                $userMessage = "File Attachment";
            } else if (strpos($value->msg, 'amazonaws') !== false) {
                $userMessage = "Attachment: 1 Image";
            } else {
                $userMessage = setStringLimit($value->msg, 40);
            }
@endphp
<div id="active_chat_box" class="activityShow {{ $count }} media chatbox_new bkg_white
	@if ($count == 1)
{{ 'mb10' }}
@endif
    sms_twr_{{ $phoneNumber }}" style="
        @if ($count > 7)
{{"display:block"}}
@endif
@if ($count == 1)
{{'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px'}}
@endif
@if ($count == 2)
{{'border-radius:5px 5px 5px 5px'}}
@endif
    ">
    <a formatedNumber="{{ mobileNoFormat($phoneNumber) }}" href="javascript:void(0);" class="media-link bbot
		@if ($count != 1)
    {{'bbot'}}
    @endif
        getChatDetails {{ $count == 0 ? 'activechat' : '' }}" subscriberId="{{ $usersdata->id }}"
       phone_no="{{ $usersdata->phone }}" rewId="{{ $value->from }}"
       @if ($showRed)
       wait="yes" token="{{ $value->token }}"
        @endif
    >

        <div class="media-left">
            @if ($usersdata->id == '')
                <img src="/assets/images/default_avt.jpeg" class="img-circle" alt="" width="28" height="28">
            @else
                @php
                    if ($usersdata->firstname == 'NA') {
                    $usersdata->firstname = "";
                }
                if ($usersdata->lastname == 'NA') {
                    $usersdata->lastname = "";
                }
                @endphp
                {!! showUserAvtar($userDataDetail->avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 12) !!}
            @endif
            <span class="favouriteSMSUser" subscriberId="{{ $usersdata->id }}"><i
                    class="fa fa-star star_icon {{ $favUser > 0 ? 'yellow' : '' }}"></i></span>
        </div>

        <div class="media-body">
            <span class="fsize12 txt_dark">{{ phoneNoFormat($phoneNumber) }}</span>

            <span class=""><span
                    style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<!--+1(359) 569-6585-->{{ phoneNoFormat($phoneNumber) }}</span></span>

            <span class="slider-phone contacts txt_dark"
                  style="margin:0px; font-weight:bold; font-size:12px!important">{{ $userMessage }}</span>
            <span class="contacts text-size-small txt_blue"
                  style="margin:0px;display:none">{{ $usersdata->phone }}</span>
        </div>
        <div class="media-right"><span
                class="date_time txt_grey fsize12">{{ str_replace('1 day', 'Yesterday', chatTimeAgo($value->created)) }}</span>&nbsp
            @if ($showRed)
                <i id="gr_{{ $value->token }}" class="fa fa-circle txt_red fsize9"></i>
            @endif

        </div>

    </a>
</div>
@php
    $count++;
    }
    }
@endphp
