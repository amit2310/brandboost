<?php
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
?>
	<div  id="active_chat_box" class="activityShow <?php echo $count; ?> media chatbox_new bkg_white <?php if ($count == 1) {
            echo 'bbot';
        } ?> sms_twr_<?php echo $phoneNumber; ?>" style="<?php if ($count > 7) {
            echo "display:block";
        }
        if ($count == 1) {
            echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px';
        }
        if ($count == 2) {
            echo 'border-radius:5px 5px 5px 5px';
        } ?>"> 
		<a formatedNumber="<?php echo mobileNoFormat($phoneNumber); ?>" href="javascript:void(0);" class="media-link bbot <?php if ($count != 1) {
            echo 'bbot';
        } ?> getChatDetails <?php echo $count == 0 ? 'activechat' : ''; ?>" subscriberId="<?php echo $usersdata->id; ?>" rewId="<?php echo $value->from; ?>" phone_no="<?php echo $usersdata->phone; ?>" <?php if ($showRed) { ?>wait="yes" token="<?php echo $value->token; ?>"<?php
        } ?>>
			
			<div class="media-left">
				<?php if ($usersdata->id == '') { ?>
					<img src="/assets/images/default_avt.jpeg" class="img-circle" alt="" width="28" height="28">
				<?php
        } else {
            if ($usersdata->firstname == 'NA') {
                $usersdata->firstname = "";
            }
            if ($usersdata->lastname == 'NA') {
                $usersdata->lastname = "";
            }
?>
				<?php echo showUserAvtar($avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 12); ?>
				<?php
        } ?>
		<span class="addSmsFavUser" subscriberId="<?php echo $usersdata->phone; ?>"><i class="fa fa-star star_icon <?php echo $favUser > 0 ? 'yellow' : ''; ?>"></i></span>
			</div>

			<div class="media-body"> 
				<span class="fsize12 txt_dark"><?php echo phoneNoFormat($phoneNumber); ?></span> 
				<span class=""><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<?php echo phoneNoFormat($phoneNumber); ?></span></span>
				<span class="slider-phone contacts txt_dark" style="margin:0px; font-weight:bold; font-size:12px!important"><?php echo $userMessage; ?></span> 
				<span class="contacts text-size-small txt_blue" style="margin:0px ; display:none"><?php echo $usersdata->phone; ?></span> 
			</div>

			

			<div class="media-right" style="width: 100px"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_<?php echo $phoneNumber; ?>" datetime="<?php echo usaDate($value->created); ?>"></time></span>
				<?php if ($showRed) { ?>
				<i id="gr_<?php echo $value->token; ?>" class="fa fa-circle txt_red fsize9"></i>
				<?php
        } ?>
			
			</div>

		</a> 
	</div>
	<?php
        $count++;
    }
}
?>