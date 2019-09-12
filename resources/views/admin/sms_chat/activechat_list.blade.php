@php
    $count = 0;
    foreach ($activechatlist as $key => $value) {
        $showRed = 0;
        $phoneNumber = "";
        $userMessage = "";
        $usersdata->phone="";
        $favUser=0;
        $value->to = numberForamt($value->to);
        $value->from = numberForamt($value->from);

        if ($value->to != '' && $value->from != '') {
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
            $favUser = getFavSmsUser($loginUserData->id, $usersdata->phone);
            if(!empty($favUser))
            {
                $favUser=1;
            }

            if (empty($userDataDetail->avatar)) {
                $avatar = "";
            } else {
                $avatar = $userDataDetail->avatar;
            }
            if (!empty($value->msg)) {
                $fileext = explode('.', $value->msg);
                if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                    $userMessage = "File Attachment";
                } else if ($value->media_type == 'video' || $value->media_type == 'image') {
                    $userMessage = "File Attachment";
                } else {
                    $userMessage = setStringLimit($value->msg, 40);
                }
            }
@endphp
<div id="active_chat_box" class="activityShow {{ $count }} media chatbox_new bkg_white
	@if ($count == 1)
{{'bbot'}}
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
       rewId="{{ $value->from }}" phone_no="{{ $usersdata->phone }}"
       @if ($showRed)
       wait="yes"
       token="{{ $value->token }}"
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
                {!! showUserAvtar($avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 12) !!}
            @endif
            <span class="addSmsFavUser" subscriberId="{{ $usersdata->phone }}"><i
                    class="fa fa-star star_icon {{ $favUser > 0 ? 'yellow' : '' }}"></i></span>
        </div>

        <div class="media-body">
            <span class="fsize12 txt_dark">{{ phoneNoFormat($phoneNumber) }}</span>
            <span class=""><span
                    style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;{{ phoneNoFormat($phoneNumber) }}</span></span>
            <span class="slider-phone contacts txt_dark"
                  style="margin:0px; font-weight:bold; font-size:12px!important">{!! $userMessage !!}</span>
            <span class="contacts text-size-small txt_blue"
                  style="margin:0px ; display:none">{{ $usersdata->phone }}</span>
        </div>


        <div class="media-right" style="width: 100px"><span class="date_time txt_grey fsize11"><time
                    class="autoTimeUpdate autoTime_{{ $phoneNumber }}" datetime="{{ usaDate($value->created) }}"></time></span>
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
