<!--===========LAST WEEK============-->
<div class="col-md-12">
    @php 
		$inc = 0;
	@endphp
    
	@if(!empty($notifications_data))
		<div style="border-top: none!important;" class="profile_headings">ALL @if($inc == 0)<a class="pull-right txt_blue2 viewAllNotification" style="text-transform: none; cursor: pointer;"><i class=""><img src="{{ base_url() }}assets/images/icon_check_blue_double.png" width="16"></i>&nbsp;Mark all read</a>@php $inc++; @endphp @endif</div>
	@endif

    @if(!empty($notifications_data))
        <div class="p20 pb0">
        @php 
        $inc = 1;
        foreach($notifications_data as $notification) { 
        	$icon = showUserIcon($notification->event_type);
        	@endphp
			<div class="media bbot smart_notification">
				<div class="media-left pr10"><img class="notif_icon" width="36" src="{{ base_url() }}assets/images/{{ $icon }}" /></div>
				<div class="media-left p0"><a href="{{ $notification->link }}"><p class="txt_dark">{{ $notification->message }}</p></a>
				<p class="txt_grey">{{ $notification->firstname }}, {{ timeAgoNotification($notification->created) }}</p>
				<a class="txt_blue2 fsize12" href="{{ $notification->link }}">Learn more <i class="icon-arrow-right13 txt_blue2"></i></a>
				</div>
			</div>
		@php 
			if($inc == 6) {
				break;
			}
			$inc++;
			} 
		@endphp
        </div>
	@endif
</div>