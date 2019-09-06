@if ($notifications_data_today->count() > 0) 
    <div class="col-md-12">
        <p class="txt_grey txt_upper mt-15 mb-15 fsize10">Today</p>
    </div>
@endif

<div class="col-md-12">
    @php
    $aUInfo = getLoggedUser();
    $userRole = $aUInfo->user_role;
    if ($notifications_data_today->count() > 0) {
        foreach ($notifications_data_today as $notification) {

            $getNotiLang = getNotificationLang($notification->event_type, $userRole);

            $icon = showUserIcon($notification->event_type);
            $backgroundColor = notificationBackgroundColor($notification->status);
            @endphp
            <div class="notificatins_box" style="background-color: {{ $backgroundColor }}!important">
                <div class="row">
                    <div class="col-md-7">
                        <div class="media-left"><img class="notif_icon" width="36" src="{{ base_url() }}assets/images/message_36.png" /></div>
                        <div class="media-left"><p class="txt_dark fw500">{{ $notification->message }}</p></div>
                        <div class="media-left"><p class="txt_grey3 fw300">{!! setStringLimit($getNotiLang, 60) !!}</p></div>
                        
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="media-right"><p class="txt_grey fw300">{{ $notification->firstname }} {{ $notification->lastname }}, {{ timeAgoNotification($notification->created) }}</p></div>
                        <div class="media-right">  <img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $notification->avatar }}" onerror="this.src='{{ base_url() }}assets/images/userp.png'" class="user_icon" ></div>
                        <div class="media-right">
                            <label class="custmo_checkbox">
                                <input type="checkbox" class="checkRows" name="notification[]" value="{{ $notification->id }}">
                                <span class="custmo_checkmark green"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @php
        }
    }
    @endphp
</div>




@if ($notifications_data_yesterday->count() > 0)
    <div class="col-md-12">
        <p class="txt_grey txt_upper mt-15 mb-15 fsize10">Yesterday</p>
    </div>
@endif

<div class="col-md-12">
    @php
    if ($notifications_data_yesterday->count() > 0) {
        foreach ($notifications_data_yesterday as $notification) {

            $getNotiLang = getNotificationLang($notification->event_type, $userRole);

            $icon = showUserIcon($notification->event_type);
            $backgroundColor = notificationBackgroundColor($notification->status);
            @endphp
            <div class="notificatins_box" style="background-color: {{ $backgroundColor }}!important">
                <div class="row">
                    <div class="col-md-7">
                        <div class="media-left"><img class="notif_icon" width="36" src="{{ base_url() }}assets/images/message_36.png" /></div>
                        <div class="media-left"><p class="txt_dark fw500">{!! $notification->message !!}</p></div>
                        <div class="media-left"><p class="txt_grey3 fw300">{!! setStringLimit($getNotiLang, 60) !!}</p></div>                        
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="media-right"><p class="txt_grey fw300">{{ $notification->firstname }} {{ $notification->lastname }}, {{ timeAgoNotification($notification->created) }}</p></div>
                        <div class="media-right">  <img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $notification->avatar }}" onerror="this.src='{{ base_url() }}assets/images/userp.png'" class="user_icon" >  </div>
                        <div class="media-right">
                            <label class="custmo_checkbox">
                                <input type="checkbox" class="checkRows" name="notification[]" value="{{ $notification->id }}">
                                <span class="custmo_checkmark green"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @php
        }
    }
    @endphp
</div>



@if ($notifications_data_lastweek->count() > 0) 
    <div class="col-md-12">
        <p class="txt_grey txt_upper mt-15 mb-15 fsize10">Last week</p>
    </div>
@endif

<div class="col-md-12">
    @php
    if ($notifications_data_lastweek->count() > 0) {
        foreach ($notifications_data_lastweek as $notification) {

            $getNotiLang = getNotificationLang($notification->event_type, $userRole);

            $icon = showUserIcon($notification->event_type);
            $backgroundColor = notificationBackgroundColor($notification->status);
            @endphp
            <div class="notificatins_box" style="background-color: {{ $backgroundColor }}!important">
                <div class="row">
                    <div class="col-md-7">
                        <div class="media-left"><img class="notif_icon" width="36" src="{{ base_url() }}assets/images/message_36.png" /></div>
                        <div class="media-left"><p class="txt_dark fw500">{!! $notification->message !!}</p></div>
                        <div class="media-left"><p class="txt_grey3 fw300">{!! setStringLimit($getNotiLang, 60) !!}</p></div>                        
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="media-right"><p class="txt_grey fw300">{{ $notification->firstname }} {{ $notification->lastname }}, {{ timeAgoNotification($notification->created) }}</p></div>
                        <div class="media-right">  <img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $notification->avatar }}" onerror="this.src='{{ base_url() }}assets/images/userp.png'" class="user_icon" >  </div>
                        <div class="media-right">
                            <label class="custmo_checkbox">
                                <input type="checkbox" class="checkRows" name="notification[]" value="{{ $notification->id }}">
                                <span class="custmo_checkmark green"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @php
        }
    }
    @endphp
</div>




<div class="col-md-12">
    <p class="txt_grey txt_upper mt-15 mb-15 fsize10">All</p>
</div>

<div class="col-md-12">
    @php
    if ($notifications_data->count() > 0) {
        foreach ($notifications_data as $notification) {

            $getNotiLang = getNotificationLang($notification->event_type, $userRole);

            $icon = showUserIcon($notification->event_type);
            $backgroundColor = notificationBackgroundColor($notification->status);
            //pre($notification);
            @endphp
            <div class="notificatins_box" style="background-color: {{ $backgroundColor }}!important">
                <div class="row">
                    <div class="col-md-7">
                        <div class="media-left"><img class="notif_icon" width="36" src="{{ base_url() }}assets/images/message_36.png" /></div>
                        <div class="media-left"><p class="txt_dark fw500">{!! $notification->message !!}</p></div>
                        <div class="media-left"><p class="txt_grey3 fw300">{!! setStringLimit($getNotiLang, 60) !!}</p></div>

                        
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="media-right"><p class="txt_grey fw300">{{ $notification->firstname }} {{ $notification->lastname }}, {{ timeAgoNotification($notification->created) }}</p></div>
                        <div class="media-right">  <img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $notification->avatar }}" onerror="this.src='{{ base_url() }}assets/images/userp.png'" class="user_icon" ></div>
                        <div class="media-right">
                            <label class="custmo_checkbox">
                                <input type="checkbox" class="checkRows" name="notification[]" value="{{ $notification->id }}">
                                <span class="custmo_checkmark green"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @php
        }
    } else {
        @endphp
        <div class="notificatins_box">
            <div class="row">
                <div class="col-md-7">
                    <div class="media-left"><p class="txt_dark">No Notification Found.</p></div>
                </div>
                <div class="col-md-5 text-right"></div>
            </div>
        </div>
            @php
    }
    @endphp
</div>