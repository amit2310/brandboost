<?php
 
$count = 0;
$flag = 0;
$loginUserData = getLoggedUser();

foreach ($WaitingChatlist as $key => $value) {
    $is_pending = 0;
    $favUser = "";
	$supportmsg="";
	$token="";
	$supportmsg = $value->message;
	$token = $value->token;
    if ($value->user_to != 0 && $value->user_form != 0) {
        if (trim($value->user_to) == trim($loginUserData->id)) {
            
            if(strlen($value->user_form)>10)
            {
                 $usersdata =  getSupportUser($value->user_form);
                 $user_name_ex = explode(" ",$usersdata[0]->user_name);
               
                 {
                     $value->firstname = $user_name_ex[0];
                     $value->lastname = $user_name_ex[1];
                     $value->id = $value->user;
					 $value->message = $supportmsg;
					  $value->token = $token;
                 }
                $usersdata = $usersdata[0];
               
            }
            else
            {
                $usersdata = getUserDetail($value->user_form);
                
            }
			
			if ($value->read_status == 0) {
                    $is_pending = 1;
                }
            
        }
        if ($value->user_form == $loginUserData->id) {
            
            if(strlen($value->user_to)>10)
            {
                 $usersdata =  getSupportUser($value->user_to);
                 $user_name_ex = explode(" ",$usersdata[0]->user_name);
                 foreach( $usersdata as $key=>$value)
                 {
                     $value->firstname = $user_name_ex[0];
                     $value->lastname = $user_name_ex[1];
                     $value->id = $value->user;
					 $value->message = $supportmsg;
					  $value->token = $token;
                 }
                 $usersdata = $usersdata[0];
               
            }
            else
            {
             $usersdata = getUserDetail($value->user_to);
			
            }
            
        }
        $incid = getincIdByuserId($usersdata->id);
		$sbscriberTableDetails = getSubscriberDetails($incid[0]->id);
		$first_name  = ($sbscriberTableDetails->firstname!="") ? $sbscriberTableDetails->firstname : $first_name;
		$last_name = ($sbscriberTableDetails->lastname!="") ? $sbscriberTableDetails->lastname : $last_name;

        
       $fileext = end(explode('.', $value->message));
if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
$userMessage = "File Attachment";
}
else if (strpos($value->message, '/Media/') !== false) {
$userMessage="File Attachment";
}
else if (strpos($value->message, 'amazonaws') !== false) {
$userMessage="File Attachment";
}

else {
$userMessage = setStringLimit($value->message, 40);
}
	
        
        // $favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id,$incid[0]->id);
        
?>
		<div RwebId="<?php echo $value->token; ?>" <?php if ($is_pending) { ?>wait="yes" <?php } ?> token="<?php echo $value->token; ?>" class="sidebar-user-box all_user_chat tk_<?php echo $value->token; ?>" incWid="<?php echo $incid[0]->id; ?>" id="sidebar-user-box-<?php echo $usersdata->id; ?>" user_id="<?php echo $usersdata->id; ?>" >
		<div class="avatarImage"><?php echo showUserAvtar($usersdata->avatar, $value->firstname, $value->lastname, 28, 28, 11); ?></div>
		<span style="display:none" id="fav_star_<?php echo $userID; ?>">
		<?php if (!in_array($userID, $newFav)) { ?>
		<a style="cursor: pointer;" class="favourite" status="1" user_id="<?php echo $userID; ?>"><i class="icon-star-full2 text-muted sidechatstar"></i></a>
		<?php
        } else { ?>
		<i class="icon-star-full2 txt_blue sidechatstarshow"></i>
		<?php
        } ?>
            
		</span>
		<span class="slider-username contacts"><?php echo $first_name . ' ' . $last_name; ?> </span> 
		<span class="slider-phone contacts txt_dark" style="margin:0px;color: #6a7995!important; font-weight:bold;padding-left:40px; font-size:12px!important"><?php echo $userMessage; ?></span> 
            
		<span style="display: none;" class="slider-email contacts"><?php echo $usersdata->email; ?> </span>
            
		<span style="display: none;" class="slider-mobile contacts"><?php echo $usersdata->mobile; ?> </span>
		<span style="display: none;" class="slider-image img">
			<?php
        if (empty($loginUserData->avatar)) {
            echo $currentUserImg = '/assets/images/default_avt.jpeg';
        } else {
            echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
        } ?></span>

		<span class="user_status"><?php echo str_replace('1 day','Yesterday',chatTimeAgo($value->created)); ?></span>
		<?php if ($is_pending) { ?>
			<i style="float:right" class="pr_<?php echo $value->token; ?> fa fa-circle txt_red fsize9"></i>
			<?php
        } ?>
		
		<!--box hover chat details -->   
		<div class="user_details p0">
		<div class="row">
		<div class="col-md-12">
		<div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $first_name . ' ' . $last_name; ?></div>
		<div class="sidebar_info p20 text-center">
		<?php echo showUserAvtar($usersdata->avatar, $first_name, $last_name, 60, 60, 21); ?>
		<h3 class="mb0"><?php echo $first_name . ' ' . $last_name; ?></h3>

		<h6><strong><?php echo $sbscriberTableDetails->cityName; ?>, <?php echo $sbscriberTableDetails->country_code; ?></strong></h6>
		<h6><strong><?php echo $usersdata->address . ' ' . $usersdata->city . ' ' . $usersdata->state . ', ' . $usersdata->country; ?></strong></h6>
		</div>
		<div class="p20 pt0 pb10">
		<div class="interactions p0 pt10 pb10 btop">
		<ul>
		<li><i class="fa fa-envelope"></i><strong><?php echo $sbscriberTableDetails->email; ?></strong></li>
		<?php if (!empty($mobile)) { ?>
		<li><i class="fa fa-phone"></i><strong><?php echo $usersdata->mobile != '' ? $usersdata->mobile : '&nbsp;'; ?></strong></li>
		<?php
        } ?>

		<li><i class="fa fa-user"></i><strong><?php echo $sbscriberTableDetails->gender; ?></strong></li>
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
}
?>


