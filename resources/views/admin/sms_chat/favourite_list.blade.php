@php

    foreach ($favouriteUserData as $key => $value) {
    $userDataDetail = getUserbyPhone($value->fav_user_id);
    $phoneNumber = $value->fav_user_id;
    $userDataDetail = $userDataDetail[0];
    $userInfo = getUserDetail($userDataDetail->user_id);
    $favUser = 1;
    $count = 0;
@endphp
<div id="active_chat_box" class="{{ $count }} media chatbox_new bkg_white
	@if ($count == 1)
{{'mb10'}}
@endif
    " style="
        @if ($count > 7)
{{"display:block"}}
@endif
@if ($count == 1)
{{ 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px' }}
@endif
@if ($count == 2)
{{ 'border-radius:5px 5px 5px 5px' }}
@endif
    ">
    <a formatedNumber="{{ phoneNoFormat($phoneNumber) }}" href="javascript:void(0);" class="media-link bbot
		@if ($count != 1)
    {{'bbot'}}
    @endif
        getChatDetails {{ $count == 0 ? '' : '' }}" subscriberId="{{ $userDataDetail->id }}"
       phone_no="{{ $phoneNumber }}">

        <div class="media-left">
            @if ($userDataDetail->id == '')
                <img src="/assets/images/default_avt.jpeg" class="img-circle" alt="" width="28" height="28">
            @else
                @php
                    if ($userDataDetail->firstname == 'NA') {
                    $userDataDetail->firstname = "";
                }
                if ($userDataDetail->lastname == 'NA') {
                    $userDataDetail->lastname = "";
                }
                @endphp
                {!! showUserAvtar($userInfo->avatar, $userDataDetail->firstname, $userDataDetail->lastname, 28, 28, 12) !!}
            @endif
            <span class="favouriteSMSUser" subscriberId="{{ $userDataDetail->id }}"><i
                    class="fa fa-star star_icon {{ $favUser > 0 ? 'yellow' : '' }}"></i></span>
        </div>

        <div class="media-body">

            <span class="fsize12 txt_dark">{{ phoneNoFormat($phoneNumber) }}</span>

            <span class=""><span
                    style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<!--+1(359) 569-6585-->{{ phoneNoFormat($phoneNumber) }}</span></span>

            <span class="slider-phone contacts txt_dark"
                  style="margin:0px; font-weight:bold; font-size:12px!important">{{ $userDataDetail->email }}
            </span>
            <span class="contacts text-size-small txt_blue"
                  style="margin:0px;display:none">{{ $usersdata->phone }}</span>
            <span class="fsize12 txt_dark"></span>
        </div>


    </a>
</div>
@php
    }
@endphp
