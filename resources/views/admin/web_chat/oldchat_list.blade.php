@php
    $count = 0;
    $flag = 0;
    $userMessage = "";
    foreach ($oldchat_list as $key => $value) {
        $token = "";
        $userid="";
        $chatMessage = "";
        $created = "";
        $first_name = "";
        $last_name = "";
        $nameDetails = explode(" ", $value->user_name);
        $first_name = $nameDetails[0];
        $last_name = $nameDetails[1];

        $token = $value->room;
        $userid = $value->user;
        $chatMessageRes = getLastMessage($token);
        $chatMessage = $chatMessageRes->message;
        $created = $chatMessageRes->created;

            $fileext = explode('.', $chatMessage);
            $fileext = end($fileext);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
            $userMessage = "File Attachment";
            }
            else if (strpos($chatMessage, '/Media/') !== false) {
            $userMessage="File Attachment";
            }
            else if (strpos($chatMessage, 'amazonaws') !== false) {
            $userMessage="File Attachment";
            }

            else {
            $userMessage = setStringLimit($chatMessage, 80);
            }

@endphp
<div class="activityShow {{ $count }} media chatbox_new bkg_white
        @if ($count == 1)
{{ 'mb10' }}
@endif
    " style="
        @if ($count > 7)
{{ "display:block" }}
    @endif
@if ($count == 1)
{{ 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px' }}
@endif
@if ($count == 2)
{{ 'border-radius:5px 5px 5px 5px' }}
@endif
    ">
    <a href="javascript:void(0);" class="media-link
        @if ($count != 1)
    {{ 'bbot' }}
    @endif
        tk_{{ $token }} getChatDetails WebBoxList {{ $count == 0 ? 'activechat' : '' }}" userId="{{  $userid }}"
       assign_to="{{ assignto($token) }}" RwebId="{{ $token }}">
        <div class="media-left">{!! showUserAvtar($usersdata->avatar, $first_name, $last_name, 28, 28, 12) !!}

        </div>

        <div class="media-body">
            <span class="fsize12 txt_dark">{{ $first_name }} {{ $last_name }}</span>

            <span id="Big_assign_message_{{  $userid }}" class="slider-phone contacts txt_dark"
                  style="margin:0px;color: #6a7995!important; font-weight:bold; font-size:12px!important">{{ $userMessage }}</span>

            <span id="Big_assign_{{  $userid }}" class="fsize12 txt_dark assign_to"><span
                    style="float: left; font-weight:bold; ">
            @if(assignto($token)!="")
                        Assigned to:&nbsp </span>{{ assignto($token) }}
            @endif
            </span>


        </div>
        <div class="media-right" style="width: 100px"><span class="date_time txt_grey fsize11"><time
                    class="autoTimeUpdate autoTime_{{  $userid }}"
                    datetime="{{ usaDate($created) }}" title="{{ usaDate($created) }}"></time>

            </span></div>

    </a>
</div>
@php
    $count++;
}
@endphp
