<?php

foreach ($favouriteUserData as $key => $value) {
    $userDataDetail = getUserbyPhone($value->fav_user_id);
    $phoneNumber = $value->fav_user_id;
    $userDataDetail = $userDataDetail[0];
    $userInfo = getUserDetail($userDataDetail->user_id);
    $favUser = 1;
    $count=0;
?>
	<div id="active_chat_box" class="<?php echo $count; ?> media chatbox_new bkg_white <?php if ($count == 1) {
        echo 'mb10';
    } ?>" style="<?php if ($count > 7) {
        echo "display:block";
    }
    if ($count == 1) {
        echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px';
    }
    if ($count == 2) {
        echo 'border-radius:5px 5px 5px 5px';
    } ?>"> 
		<a formatedNumber="<?php echo phoneNoFormat($phoneNumber); ?>" href="javascript:void(0);" class="media-link bbot <?php if ($count != 1) {
        echo 'bbot';
    } ?> getChatDetails <?php echo $count == 0 ? '' : ''; ?>" subscriberId="<?php echo $userDataDetail->id; ?>" phone_no="<?php echo $phoneNumber; ?>">
			
			<div class="media-left">
				<?php if ($userDataDetail->id == '') { ?>
					<img src="/assets/images/default_avt.jpeg" class="img-circle" alt="" width="28" height="28">
				<?php
    } else {
        if ($userDataDetail->firstname == 'NA') {
            $userDataDetail->firstname = "";
        }
        if ($userDataDetail->lastname == 'NA') {
            $userDataDetail->lastname = "";
        }
?>
				<?php echo showUserAvtar($userInfo->avatar, $userDataDetail->firstname, $userDataDetail->lastname, 28, 28, 12); ?>
				<?php
    } ?>
				<span class="favouriteSMSUser" subscriberId = "<?php echo $userDataDetail->id; ?>"><i class="fa fa-star star_icon <?php echo $favUser > 0 ? 'yellow' : ''; ?>"></i></span>
			</div>

			<div class="media-body"> 

				<span class="fsize12 txt_dark"><?php echo phoneNoFormat($phoneNumber); ?></span> 

				<span class=""><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<!--+1(359) 569-6585--><?php echo phoneNoFormat($phoneNumber); ?></span></span>

				<span class="slider-phone contacts txt_dark" 
				style="margin:0px; font-weight:bold; font-size:12px!important"><?php echo $userDataDetail->email; ?><?php //echo $userMessage;
    
?></span> 
				<span class="contacts text-size-small txt_blue" style="margin:0px;display:none"><?php echo $usersdata->phone; ?></span>

				<!-- <span class="fsize12 txt_dark"><?php echo $usersdata->firstname; ?> <?php echo $usersdata->lastname; ?></span>  -->
				<!-- <span class="slider-phone contacts text-size-small txt_blue" style="margin:0px"><?php echo $usersdata->email; ?></span>
				<span class="slider-phone contacts text-size-small txt_blue" style="margin:0px"><?php echo $usersdata->phone; ?></span> -->

				<span class="fsize12 txt_dark"><?php //echo $fileView; ?></span> 
			</div>
			

		</a> 
	</div>
<?php
}
?>