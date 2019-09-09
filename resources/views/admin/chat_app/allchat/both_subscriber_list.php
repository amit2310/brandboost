<div id="allchatdiv" style="display:block">

    @php
    $aUser = getLoggedUser();

    ///######################## ALL SUBSCRIBER LIST ##########################
    foreach ($allSubscribers as $key => $value) {
    $userID = $value->user_id;
    $firstname = $value->firstname;
    $lastname = $value->lastname;
    $email = $value->email;
    $avatar = $value->avatar;
    $mobile = $value->mobile;
    $address = $value->address;
    $city = $value->city;
    $state = $value->state;
    $country = $value->country;
    $zip_code = $value->zip_code;
    $login_status = $value->login_status;
    $last_login = $value->last_login;
    $chatType = $value->chat_type;
    $user_created = $value->created;
    if (strtotime($last_login) > 0) {
    $lastLogin = chatTimeAgo($last_login);
    } else {
    $lastLogin = chatTimeAgo($user_created);
    }
    $getUnreadMsg = getUnreadMsg($currentUser, $userID, '0');
    $aTwilioAcData = currentUserTwilioData($currentUser);
    @endphp

    <div class="sidebar-user-box all_user_chat" id="sidebar-user-box-{{ $userID }}" user_id="{{ $userID }}"
         from_no="{{ $aTwilioAcData->contact_no }}" to_no="{{ $mobile }}">
        <div class="avatarImage">{!! showUserAvtar($avatar, $firstname, $lastname, 24, 24, 11) !!}</div>
        <span style="display:none" id="fav_star_{{ $userID }}">
		@if (!in_array($userID, $newFav))
		<a style="cursor: pointer;" class="favourite" status="1" user_id="{{ $userID }}"><i
                class="icon-star-full2 text-muted sidechatstar"></i></a>
		@else
		<i class="icon-star-full2 txt_blue sidechatstarshow"></i>
		@endif
		</span>
        <span class="slider-username contacts">{{ $firstname . ' ' . $lastname }} </span>
        <span class="slider-phone contacts text-size-small txt_blue">{{ $email }}</span>
        <span style="display: none;" class="slider-email contacts">{{ $email }} </span>
        <span style="display: none;" class="slider-mobile contacts">{{ $mobile }} </span>
        <span style="display: none;" class="slider-image contacts">
			@if(empty($aUser->avatar))
				<img src="{{ base_url() }}assets/images/default_avt.jpeg"/>
			@else
            <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $aUser->avatar }}"/>
        @endif
        </span>

        <span style="display:none" class="slider-phone contacts text-muted text-size-small"><i
                class="fa fa-circle txt_blue"></i>
		{{ $chatType == 'sms' ? 'SMS | ' . $mobile : 'Web Chat' }}</span>
        @php
        if (!empty($getUnreadMsg)) {
        $readStatus = count($getUnreadMsg);
        } else {
        $readStatus = '0';
        }
        @endphp

        <!--box hover chat details -->
        <div class="user_details p0">
            <div class="row">
                <div class="col-md-12">
                    <div class="header_sec"><i class="icon-info22 txt_blue"></i>{{ $firstname . ' ' . $lastname }}</div>
                    <div class="sidebar_info p20 text-center">
                        {!! showUserAvtar($avatar, $firstname, $lastname, 60, 60, 21) !!}
                        <h3 class="mb0">{{ $firstname . ' ' . $lastname }}</h3>

                        <h6><strong>San Francisco, CA</strong></h6>
                        <h6><strong>{{ $address . ' ' . $city . ' ' . $state . ', ' . $country }}</strong></h6>
                    </div>
                    <div class="p20 pt0 pb10">
                        <div class="interactions p0 pt10 pb10 btop">
                            <ul>
                                <li><i class="fa fa-envelope"></i><strong>{{ $email }}</strong></li>
                                @if (!empty($mobile))
                                <li><i class="fa fa-phone"></i><strong>{{ $mobile != '' ? $mobile : '&nbsp;' }}</strong>
                                </li>
                                @endif

                                <li><i class="fa fa-user"></i><strong>Male</strong></li>
                                <li><i class="fa fa-clock-o"></i><strong>6AM, US/Estern</strong></li>
                                <li><i class="fa fa-align-left"></i><strong>Opt-Out of All</strong></li>
                            </ul>
                        </div>
                        <div class="p0 user_tags">
                            <p class="usertags_headings">Tags</p>
                            <button class="btn btn-xs btn_white_table">added review</button>
                            <button class="btn btn-xs btn_white_table">male 25+</button>
                            <button class="btn btn-xs btn_white_table">Referral</button>
                            <button class="btn btn-xs btn_white_table">Media</button>
                            <button class="btn btn-xs btn_white_table">+</button>
                        </div>
                    </div>
                    <div class="p20 footer_txt btop"><a href="#">Open Profile &gt; </a></div>
                </div>
            </div>
        </div>
    </div>
    @php
    }
    ///######################## ALL SUBSCRIBER LIST ##########################


    ///######################## ALL OWNER LIST ##########################
    foreach ($owners as $key => $pair) {

    $valueData = getAllUser($pair->owner_id);
    $value = $valueData[0];
    $userID = $value->id;
    $firstname = $value->firstname;
    $lastname = $value->lastname;
    $email = $value->email;
    $avatar = $value->avatar;
    $mobile = $value->mobile;
    $address = $value->address;
    $city = $value->city;
    $state = $value->state;
    $country = $value->country;
    $zip_code = $value->zip_code;
    $login_status = $value->login_status;
    $last_login = $value->last_login;
    $chatType = $value->chat_type;
    $user_created = $value->created;
    if (strtotime($last_login) > 0) {
    $lastLogin = chatTimeAgo($last_login);
    } else {
    $lastLogin = chatTimeAgo($user_created);
    }
    $getUnreadMsg = getUnreadMsg($currentUser, $userID, '0');
    $aTwilioAcData = currentUserTwilioData($currentUser);
    @endphp

    <div class="sidebar-user-box all_user_chat" id="sidebar-user-box-{{ $userID }}" user_id="{{ $userID }}"
         from_no="{{ $aTwilioAcData->contact_no }}" to_no="{{ $mobile }}">
        <div class="avatarImage">{!! showUserAvtar($avatar, $firstname, $lastname, 24, 24, 11) !!}</div>
        <span style="display:none" id="fav_star_{{ $userID }}">
		@if (!in_array($userID, $newFav))
		<a style="cursor: pointer;" class="favourite" status="1" user_id="{{ $userID }}"><i
                class="icon-star-full2 text-muted sidechatstar"></i></a>
		@else
		<i class="icon-star-full2 txt_blue sidechatstarshow"></i>
		@endif
		</span>
        <span class="slider-username contacts">{{ $firstname . ' ' . $lastname }} </span>
        <span class="slider-phone contacts text-size-small txt_blue">{{ $email }}</span>
        <span style="display: none;" class="slider-email contacts">{{ $email }} </span>
        <span style="display: none;" class="slider-mobile contacts">{{ $mobile }} </span>
        <span style="display: none;" class="slider-image contacts">
		@if(empty($aUser->avatar))
            <img src="{{ base_url() }}assets/images/default_avt.jpeg"/>
			@else
            <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $aUser->avatar }}"/>
            @endif </span>

        <span style="display:none" class="slider-phone contacts text-muted text-size-small"><i
                class="fa fa-circle txt_blue"></i>
		{{ $chatType == 'sms' ? 'SMS | ' . $mobile : 'Web Chat' }}</span>
        @php
        if (!empty($getUnreadMsg)) {
        $readStatus = count($getUnreadMsg);
        } else {
        $readStatus = '0';
        }
        @endphp

        <!--box hover chat details -->
        <div class="user_details p0">
            <div class="row">
                <div class="col-md-12">
                    <div class="header_sec"><i class="icon-info22 txt_blue"></i>{{ $firstname . ' ' . $lastname }}</div>
                    <div class="sidebar_info p20 text-center">
                        {!! showUserAvtar($avatar, $firstname, $lastname, 60, 60, 21) !!}
                        <h3 class="mb0">{{ $firstname . ' ' . $lastname }}</h3>

                        <h6><strong>San Francisco, CA</strong></h6>
                        <h6><strong>{{ $address . ' ' . $city . ' ' . $state . ', ' . $country }}</strong></h6>
                    </div>
                    <div class="p20 pt0 pb10">
                        <div class="interactions p0 pt10 pb10 btop">
                            <ul>
                                <li><i class="fa fa-envelope"></i><strong>{{ $email }}</strong></li>
                                @if (!empty($mobile))
                                <li><i class="fa fa-phone"></i><strong>{{ $mobile != '' ? $mobile : '&nbsp;' }}</strong>
                                </li>
                                @endif

                                <li><i class="fa fa-user"></i><strong>Male</strong></li>
                                <li><i class="fa fa-clock-o"></i><strong>6AM, US/Estern</strong></li>
                                <li><i class="fa fa-align-left"></i><strong>Opt-Out of All</strong></li>
                            </ul>
                        </div>
                        <div class="p0 user_tags">
                            <p class="usertags_headings">Tags</p>
                            <button class="btn btn-xs btn_white_table">added review</button>
                            <button class="btn btn-xs btn_white_table">male 25+</button>
                            <button class="btn btn-xs btn_white_table">Referral</button>
                            <button class="btn btn-xs btn_white_table">Media</button>
                            <button class="btn btn-xs btn_white_table">+</button>
                        </div>
                    </div>
                    <div class="p20 footer_txt btop"><a href="#">Open Profile &gt; </a></div>
                </div>
            </div>
        </div>
    </div>
    @php
    }
    ///######################## ALL OWNER LIST ##########################

    @endphp
</div>
