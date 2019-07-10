<?php

 foreach($fUser as $key=>$value)
 {
	  $userDataDetail = getUserbyPhone($value->fav_user_id);
	  $phoneNumber = $value->fav_user_id;
	  $userDataDetail = $userDataDetail[0];
	  $userInfo = getUserDetail($userDataDetail->user_id);
	  $favUser=1;
?>
	<div  phone_no_format="<?php echo phoneNoFormat($phoneNumber); ?>" id="sidebar_Sms_box_<?php echo $usersdata->phone; ?>" class="sms_user sms_twr_<?php echo $usersdata->phone; ?>" incSmsWid="<?php echo $incid; ?>" rewId="<?php echo $smsvalue->from; ?>" phone_no="<?php echo trim($phoneNumber); ?>" <?php if($showRed){ ?>wait="yes" token="<?php echo $value->token; ?>"<?php } ?> user_id="<?php echo $usersdata->id; ?>" >
			
			<div class="media-left">
				<?php if($userDataDetail->id == ''){ ?>
					<img src="/assets/images/default_avt.jpeg" class="img-circle" alt="" width="28" height="28">
				<?php } else {
				
				if($userDataDetail->firstname == 'NA')
				{
				 $userDataDetail->firstname="";
				}
				if($userDataDetail->lastname == 'NA')
				{
				 $userDataDetail->lastname="";
				}
				?>
				<?php echo  showUserAvtar($userInfo->avatar, $userDataDetail->firstname, $userDataDetail->lastname,28,28,12); ?>
				<?php } ?>
				<span class="favouriteSMSUser" subscriberId = "<?php echo $userDataDetail->id; ?>"></span>
			</div>

			<div class="media-body"> 

				
				<span class="fsize12 txt_dark"><?php echo phoneNoFormat($userDataDetail->phone); ?>  &nbsp; <i class="fa fa-star star_icon <?php echo $favUser > 0 ? 'yellow' : ''; ?>"></i> </span> 

				<span class=""><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<!--+1(359) 569-6585--><?php echo phoneNoFormat($userDataDetail->phone); ?></span></span>

				<span class="slider-phone contacts txt_dark" style="margin:0px; font-weight:bold; font-size:12px!important">
				<?php echo $userDataDetail->email; ?></span> 
				<span class="contacts text-size-small txt_blue" style="margin:0px;display:none"><?php echo $usersdata->phone; ?></span>

				<!-- <span class="fsize12 txt_dark"><?php echo $usersdata->firstname; ?> <?php echo $usersdata->lastname; ?></span>  -->
				<!-- <span class="slider-phone contacts text-size-small txt_blue" style="margin:0px"><?php echo $usersdata->email; ?></span>
				<span class="slider-phone contacts text-size-small txt_blue" style="margin:0px"><?php echo $usersdata->phone; ?></span> -->

				<span class="fsize12 txt_dark"><?php echo $fileView; ?></span> 
			</div>
			

		</a> 
	</div>
<?php
 }
  
  ?>