@php

    $count = 0;
    $flag = 0;
    $loginUserData = getLoggedUser();

    foreach ($activechatlist as $key => $value) {


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

            $fileext = @end(explode('.', $chatMessage));
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
            $userMessage = setStringLimit($chatMessage, 30);
            }
                $Usrvalue  = getSupportUser($userid);
                $Usrvalue = $Usrvalue[0];

            // $favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id,$incid[0]->id);
            $token = !empty($token) ? $token : '';
            $avatar = !empty($usersdata->avatar) ? $usersdata->avatar : '';
@endphp
<div RwebId="{{ $token }}" token="{{ $token }}" class="sidebar-user-box all_user_chat tk_{{ $token }}"
     assign_to="{{ assignto($token) }}" incWid="" id="sidebar-user-box-{{ $userid }}" user_id="{{ $userid }}">
    <div class="avatarImage">{!! showUserAvtar($avatar, $first_name, $last_name, 28, 28, 11) !!}


    </div>
    <span style="display:none" id="fav_star_{{ $userid }}"></span>
    <span class="slider-username contacts">{{ $first_name . ' ' . $last_name }} &nbsp; <i
            class="fa  star_icon {{ $value->favourite == 1?'fa-star yellow':'fa-star-o' }} favouriteUser"
            userId="{{ $value->id }}"></i></span>


    <span id="Small_assign_{{ $userid }}" class="slider-phone contacts"><span
            style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            @if(assignto($token)!="")
                Assigned to:&nbsp
                {{ assignto($token)}}
            @endif
                </span></span>

    <span id="Small_assign_message_{{ $userid }}" class="slider-phone contacts txt_dark"
          style="margin:0px;color: #09204f !important; font-weight:300;padding-left:38px; font-size:12px!important">{{ $userMessage }}</span>


    <span style="display: none;" class="slider-email contacts"></span>

    <span style="display: none;" class="slider-mobile contacts"></span>
    <span style="display: none;" class="slider-image img">
			</span>

    <span class="user_status"><time class="autoTimeUpdate autoTime_{{  $userid }}"
                                    datetime="{{ usaDate($created) }}" title="{{ usaDate($created) }}"></time></span>


    <!--box hover chat details -->
    <div class="user_details p0">
        <div class="row">
            <div class="col-md-12">
                <div class="header_sec"><i class="icon-info22 txt_blue"></i>{{ $first_name . ' ' . $last_name }}</div>
                <div class="sidebar_info p20 text-center">
                    {!!  showUserAvtar($avatar, $first_name, $last_name, 60, 60, 21) !!}
                    <h3 class="mb0">{{ $first_name. ' ' .$last_name }}</h3>

                </div>

                <div class="p20 pt0 pb10">
                    <div class="interactions p0 pt10 pb10 btop">
                        <ul>

                            <li><span style="width: 62px; float: left;"><i
                                        class="fa fa-envelope"></i> Email: </span><span class="">
		<strong class="em">{{ $Usrvalue->email != "" ? $Usrvalue->email: "N/A" }}</strong></span> <input type="text"
                                                                                                         class="uAddText support_email"
                                                                                                         style="display:none;"
                                                                                                         name="support_email">
                            </li>
                            <li><span style="width: 62px; float: left;"><i class="fa fa-phone"></i> Phone: </span><span
                                    class="">
		<strong class="em">{{ $Usrvalue->phone != "" ? $Usrvalue->phone: "N/A" }}</strong></span> <input type="text"
                                                                                                         class="uAddText support_email"
                                                                                                         style="display:none;"
                                                                                                         name="support_email">
                            </li>

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

@endphp
<script>
    $(document).ready(function () {
        $(".autoTimeUpdate").timeago();
    });
</script>


