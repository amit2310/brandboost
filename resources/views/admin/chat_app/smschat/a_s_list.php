<?php
$count = 0;
foreach ($a_s_list as $key => $value) {
    $showRed = 0;
    $phoneNumber = "";
    if ($value->to != '' && $value->from != '') {
        $value->to = numberForamt($value->to);
        $value->from = numberForamt($value->from);
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
        $usersdatails = getUserDetail($usersdata->user_id);
       
        $fileext = explode('.', $value->msg);
        $fileext = end($fileext);
        if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
            $userMessage = "File Attachment";
        } else if ($value->media_type == 'video' || $value->media_type == 'image') {
            $userMessage = "File Attachment";
        } else if (strpos($value->msg, 'amazonaws') !== false) {
            $userMessage = "File Attachment";
        } else {
            $userMessage = setStringLimit($value->msg, 40);
        }
        if ($usersdata->firstname == 'NA') {
            $usersdata->firstname = "";
        }
        if ($usersdata->lastname == 'NA') {
            $usersdata->lastname = "";
        }
        //$favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id, $usersdata->id);
        $favUser = getFavSmsUser($loginUserData->id, $phoneNumber);
        
        $avatar = !empty($usersdata->avatar) ? $usersdata->avatar : '';
        $address = !empty($usersdata->address) ? $usersdata->address : '';
        $city = !empty($usersdata->city) ? $usersdata->city : '';
        $state = !empty($usersdata->state) ? $usersdata->state : '';
        $country = !empty($usersdata->country) ? $usersdata->country : '';

?>
		<div  phone_no_format="<?php echo phoneNoFormat($phoneNumber); ?>" id="sidebar_Sms_box_<?php echo $phoneNumber; ?>" class="sms_user sms_twr_<?php echo $phoneNumber; ?>" phone_no="<?php echo trim($phoneNumber); ?>" <?php if ($showRed) { ?>wait="yes" token="<?php echo $value->token; ?>"<?php
        } ?> user_id="<?php echo $usersdata->id; ?>" >
		<div class="avatarImage"><?php echo showUserAvtar($avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 11); ?></div>
		
		<span class="slider-username contacts"><?php echo phoneNoFormat($phoneNumber); ?>  &nbsp; <span class="SmallchatfavouriteSMSUser" subscriberId="<?php echo $phoneNumber; ?>"><i class="fa fa-star star_icon <?php echo $favUser > 0 ? 'yellow' : ''; ?>"></i></span> </span> 
		
		
		
		<span class="" style="line-height: 18px; display: block; margin-left: 38px; float: none; font-size: 12px; font-weight: 400!important; color: #09204f!important;"><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<!--+1(359) 569-6585--><?php echo phoneNoFormat($phoneNumber); ?></span></span>
            
            
            
		<span class="slider-phone contacts txt_dark" style="margin:0px;color: #09204f !important; font-weight:300;padding-left:40px; font-size:12px!important"><?php echo $userMessage; ?></span>
            
		<span style="display: none;" class="slider-email contacts"><?php echo $usersdata->email; ?> </span>
            
		<span style="display: none;" class="slider-mobile contacts"><?php echo $mobile; ?> </span>
		<span style="display: none;" class="slider-image img">
			<?php
        if (empty($avatar)) {
            echo $currentUserImg = '/assets/images/default_avt.jpeg';
        } else {
            echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $avatar;
        } ?></span>

		<span class="user_status date_time"><time class="autoTimeUpdate autoTime_<?php echo $phoneNumber; ?>" datetime="<?php echo usaDate($value->created); ?>"></time></span>
		<!--box hover chat details -->   
		<div class="user_details p0">
		<div class="row">
		<div class="col-md-12">
		<div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $usersdata->firstname . ' ' . $usersdata->lastname; ?></div>
		<div class="sidebar_info p20 text-center">
		<?php echo showUserAvtar($avatar, $usersdata->firstname, $usersdata->lastname, 60, 60, 21); ?>
		<h3 class="mb0"><?php echo $usersdata->firstname . ' ' . $usersdata->lastname; ?></h3>

		<h6><strong>San Francisco, CA</strong></h6>
		<h6><strong><?php echo $address . ' ' . $city . ' ' . $state . ', ' . $country; ?></strong></h6>
		</div>
		<div class="p20 pt0 pb10">
		<div class="interactions p0 pt10 pb10 btop">
		<ul>
		<li><i class="fa fa-envelope"></i><strong><?php echo $usersdata->email; ?></strong></li>
		<?php if (!empty($mobile)) { ?>
		<li><i class="fa fa-phone"></i><strong><?php echo $mobile != '' ? $mobile : '&nbsp;'; ?></strong></li>
		<?php
        } ?>

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
	<?php
        $count++;
    }
}
?>