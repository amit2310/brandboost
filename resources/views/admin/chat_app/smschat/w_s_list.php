<?php
$count=0;
$showRed=0;

    
foreach( $w_s_list as $key=>$value)
{
$phoneNumber="";
if( $value->to!='' && $value->from!='' )
{
	$value->to = phone_display_custom_helper($value->to);
    $value->from  = phone_display_custom_helper($value->from);

	if(trim($value->to) == trim($mobile))
	{
		$usersdata = getUserbyPhone($value->from);
		$phoneNumber = $value->from;
		$usersdata = $usersdata[0];
		if($value->read_status == 0)
		{
			 $showRed=1;
		}
		
		
	}
	if($value->from == $mobile)
	{ 
		$usersdata = getUserbyPhone($value->to);
		$phoneNumber = $value->to;
		$usersdata = $usersdata[0];

		
	}

        $userDataDetail = getUserDetail($usersdata->user_id);
		if($usersdata->user_id!="")
		{
		$incid = getincIdByuserId($userDataDetail->id);
		$incid = $incid[0]->id;
		}
		else
		{
		$incid = $usersdata->id;
		}
		//$favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id, $usersdata->id);
	
				
$fileext = end(explode('.', $value->msg));
if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
$userMessage = "File Attachment";
}
else if (strpos($value->msg, '/Media/') !== false) {
$userMessage="File Attachment";
}
else if (strpos($value->msg, 'amazonaws') !== false) {
$userMessage="File Attachment";
}

else {
$userMessage = setStringLimit($value->msg, 40);
}


if($usersdata->firstname == 'NA')
{
$usersdata->firstname="";
}
if($usersdata->lastname == 'NA')
{
$usersdata->lastname="";
}
	
	?>
<div  phone_no_format="<?php echo phoneNoFormat($phoneNumber); ?>" id="sidebar_Sms_box_<?php echo $usersdata->phone; ?>" class="sms_user sms_twr_<?php echo $usersdata->phone; ?>" incSmsWid="<?php echo $incid; ?>" rewId="<?php echo $smsvalue->from; ?>" phone_no="<?php echo trim($usersdata->phone); ?>" <?php if($showRed){ ?>wait="yes" token="<?php echo $value->token; ?>"<?php } ?> user_id="<?php echo $usersdata->id; ?>" >
		<div class="avatarImage"><?php echo showUserAvtar($userDataDetail->avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 11); ?></div>
		<span style="display:none" id="fav_star_<?php echo $userID; ?>">
		<?php if (!in_array($userID, $newFav)) { ?>
		<a style="cursor: pointer;" class="favourite" status="1" user_id="<?php echo $userID; ?>"><i class="icon-star-full2 text-muted sidechatstar"></i></a>
		<?php
        } else { ?>
		<i class="icon-star-full2 txt_blue sidechatstarshow"></i>
		<?php
        } ?>
		</span>
		<span class="slider-username contacts"><?php echo phoneNoFormat($phoneNumber); ?> </span> 

		<span class="slider-phone contacts"><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<!--+1(359) 569-6585--><?php echo phoneNoFormat($phoneNumber); ?></span></span>
            
		<span class="slider-phone contacts txt_dark" style="margin:0px; font-weight:bold;padding-left:40px; font-size:12px!important"><?php echo $userMessage; ?></span>
            
		<span style="display: none;" class="slider-email contacts"><?php echo $usersdata->email; ?> </span>
            
		<span style="display: none;" class="slider-mobile contacts"><?php echo $usersdata->mobile; ?> </span>
		<span style="display: none;" class="slider-image img">
			<?php
        if (empty($loginUserData->avatar)) {
            echo $currentUserImg = '/assets/images/default_avt.jpeg';
        } else {
            echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
        } ?></span>

		<span class="user_status"><time class="autoTimeUpdate" id="autoTime_<?php echo  $userid; ?>" datetime="<?php echo usaDate($value->created); ?>" title="<?php echo usaDate($value->created); ?>"><?php //echo chatTimeAgo($value->created); ?></time></span>
		<!--box hover chat details -->   
		<div class="user_details p0">
		<div class="row">
		<div class="col-md-12">
		<div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $usersdata->firstname . ' ' . $usersdata->lastname; ?></div>
		<div class="sidebar_info p20 text-center">
		<?php echo showUserAvtar($usersdata->avatar, $usersdata->firstname, $usersdata->lastname, 60, 60, 21); ?>
		<h3 class="mb0"><?php echo $usersdata->firstname . ' ' . $usersdata->lastname; ?></h3>

		<h6><strong>San Francisco, CA</strong></h6>
		<h6><strong><?php echo $usersdata->address . ' ' . $usersdata->city . ' ' . $usersdata->state . ', ' . $usersdata->country; ?></strong></h6>
		</div>
		<div class="p20 pt0 pb10">
		<div class="interactions p0 pt10 pb10 btop">
		<ul>
		<li><i class="fa fa-envelope"></i><strong><?php echo $usersdata->email; ?></strong></li>
		<?php if (!empty($mobile)) { ?>
		<li><i class="fa fa-phone"></i><strong><?php echo $usersdata->mobile != '' ? $usersdata->mobile : '&nbsp;'; ?></strong></li>
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