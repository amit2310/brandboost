
			<div id="allchatdiv" style="display:block">

		<?php
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
		?>

		<div class="sidebar-user-box all_user_chat" id="sidebar-user-box-<?php echo $userID; ?>" user_id="<?php echo $userID; ?>" from_no="<?php echo $aTwilioAcData->contact_no; ?>" to_no="<?php echo $mobile; ?>">
		<div class="avatarImage"><?php echo showUserAvtar($avatar, $firstname, $lastname, 24, 24, 11); ?></div>
		<span style="display:none" id="fav_star_<?php echo $userID; ?>">
		<?php if (!in_array($userID, $newFav)) { ?>
		<a style="cursor: pointer;" class="favourite" status="1" user_id="<?php echo $userID; ?>"><i class="icon-star-full2 text-muted sidechatstar"></i></a>
		<?php
		} else { ?>
		<i class="icon-star-full2 txt_blue sidechatstarshow"></i>
		<?php
		} ?>
		</span>
		<span class="slider-username contacts"><?php echo $firstname . ' ' . $lastname; ?> </span> 
		<span class="slider-phone contacts text-size-small txt_blue"><?php echo $email; ?></span>
		<span style="display: none;" class="slider-email contacts"><?php echo $email; ?> </span>
		<span style="display: none;" class="slider-mobile contacts"><?php echo $mobile; ?> </span>
		<span style="display: none;" class="slider-image contacts">
			<?php 
			if(empty($aUser->avatar)) {
			?>
				<img src="<?php echo base_url(); ?>assets/images/default_avt.jpeg" />
			<?php } 
			else {
				?><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $aUser->avatar; ?>" /><?php
			} ?></span>

		<span style="display:none" class="slider-phone contacts text-muted text-size-small"><i class="fa fa-circle txt_blue"></i> 
		<?php echo $chatType == 'sms' ? 'SMS | ' . $mobile : 'Web Chat'; ?></span>
		<?php
		if (!empty($getUnreadMsg)) {
		$readStatus = count($getUnreadMsg);
		} else {
		$readStatus = '0';
		}
		?>

		<!--box hover chat details -->   
		<div class="user_details p0">
		<div class="row">
		<div class="col-md-12">
		<div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $firstname . ' ' . $lastname; ?></div>
		<div class="sidebar_info p20 text-center">
		<?php echo showUserAvtar($avatar, $firstname, $lastname, 60, 60, 21); ?>
		<h3 class="mb0"><?php echo $firstname . ' ' . $lastname; ?></h3>

		<h6><strong>San Francisco, CA</strong></h6>
		<h6><strong><?php echo $address . ' ' . $city . ' ' . $state . ', ' . $country; ?></strong></h6>
		</div>
		<div class="p20 pt0 pb10">
		<div class="interactions p0 pt10 pb10 btop">
		<ul>
		<li><i class="fa fa-envelope"></i><strong><?php echo $email; ?></strong></li>
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
		}
		///######################## ALL SUBSCRIBER LIST ##########################
			
			
		///######################## ALL OWNER LIST ##########################
		foreach ($owners as $key => $pair) {
			
			$valueData  = getAllUser($pair->owner_id);
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
		?>

		<div class="sidebar-user-box all_user_chat" id="sidebar-user-box-<?php echo $userID; ?>" user_id="<?php echo $userID; ?>" from_no="<?php echo $aTwilioAcData->contact_no; ?>" to_no="<?php echo $mobile; ?>">
		<div class="avatarImage"><?php echo showUserAvtar($avatar, $firstname, $lastname, 24, 24, 11); ?></div>
		<span style="display:none" id="fav_star_<?php echo $userID; ?>">
		<?php if (!in_array($userID, $newFav)) { ?>
		<a style="cursor: pointer;" class="favourite" status="1" user_id="<?php echo $userID; ?>"><i class="icon-star-full2 text-muted sidechatstar"></i></a>
		<?php
		} else { ?>
		<i class="icon-star-full2 txt_blue sidechatstarshow"></i>
		<?php
		} ?>
		</span>
		<span class="slider-username contacts"><?php echo $firstname . ' ' . $lastname; ?> </span> 
		<span class="slider-phone contacts text-size-small txt_blue"><?php echo $email; ?></span>
		<span style="display: none;" class="slider-email contacts"><?php echo $email; ?> </span>
		<span style="display: none;" class="slider-mobile contacts"><?php echo $mobile; ?> </span>
		<span style="display: none;" class="slider-image contacts">
		<?php 
			if(empty($aUser->avatar)) {
			?>
				<img src="<?php echo base_url(); ?>assets/images/default_avt.jpeg" />
			<?php } 
			else {
				?><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $aUser->avatar; ?>" /><?php
			} ?> </span>

		<span style="display:none" class="slider-phone contacts text-muted text-size-small"><i class="fa fa-circle txt_blue"></i> 
		<?php echo $chatType == 'sms' ? 'SMS | ' . $mobile : 'Web Chat'; ?></span>
		<?php
		if (!empty($getUnreadMsg)) {
		$readStatus = count($getUnreadMsg);
		} else {
		$readStatus = '0';
		}
		?>

		<!--box hover chat details -->   
		<div class="user_details p0">
		<div class="row">
		<div class="col-md-12">
		<div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $firstname . ' ' . $lastname; ?></div>
		<div class="sidebar_info p20 text-center">
		<?php echo showUserAvtar($avatar, $firstname, $lastname, 60, 60, 21); ?>
		<h3 class="mb0"><?php echo $firstname . ' ' . $lastname; ?></h3>

		<h6><strong>San Francisco, CA</strong></h6>
		<h6><strong><?php echo $address . ' ' . $city . ' ' . $state . ', ' . $country; ?></strong></h6>
		</div>
		<div class="p20 pt0 pb10">
		<div class="interactions p0 pt10 pb10 btop">
		<ul>
		<li><i class="fa fa-envelope"></i><strong><?php echo $email; ?></strong></li>
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
		}
		///######################## ALL OWNER LIST ##########################

		?>
		</div>