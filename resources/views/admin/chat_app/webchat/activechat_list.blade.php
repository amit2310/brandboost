<?php
 
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
?>
		<div RwebId="<?php echo $token; ?>" token="<?php echo $token; ?>" class="sidebar-user-box all_user_chat tk_<?php echo $token; ?>" assign_to="<?php echo assignto($token); ?>" incWid="" id="sidebar-user-box-<?php echo $userid; ?>" user_id="<?php echo $userid; ?>" >
		<div class="avatarImage"><?php echo showUserAvtar($avatar, $first_name, $last_name, 28, 28, 11); ?>
			
			
		</div>
		<span style="display:none" id="fav_star_<?php echo $userid; ?>"></span>
		<span class="slider-username contacts"><?php echo $first_name . ' ' . $last_name; ?> &nbsp; <i class="fa  star_icon <?php echo $value->favourite == 1?'fa-star yellow':'fa-star-o'; ?> favouriteUser" userId="<?php echo $value->id; ?>"></i></span>
		 
		
           
           
            <span id="Small_assign_<?php echo $userid; ?>" class="slider-phone contacts"><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            <?php if(assignto($token)!=""){ ?>Assigned to:&nbsp <?php echo assignto($token); } ?> </span></span>
            
            <span id="Small_assign_message_<?php echo $userid; ?>" class="slider-phone contacts txt_dark" style="margin:0px;color: #09204f !important; font-weight:300;padding-left:38px; font-size:12px!important"><?php echo $userMessage; ?></span> 
           

		<span style="display: none;" class="slider-email contacts"></span>
            
		<span style="display: none;" class="slider-mobile contacts"></span>
		<span style="display: none;" class="slider-image img">
			<?php
        if (empty($loginUserData->avatar)) {
            echo $currentUserImg = '/assets/images/default_avt.jpeg';
        } else {
            echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
        } ?></span>

		<span class="user_status"><time class="autoTimeUpdate autoTime_<?php echo  $userid; ?>" 
        datetime="<?php echo usaDate($created); ?>" title="<?php echo usaDate($created); ?>"><?php //echo chatTimeAgo($value->created); ?></time></span>
		
		
		<!--box hover chat details -->   
		<div class="user_details p0">
		<div class="row">
		<div class="col-md-12">
		<div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $first_name . ' ' . $last_name; ?></div>
		<div class="sidebar_info p20 text-center">
		<?php echo showUserAvtar($avatar, $first_name, $last_name, 60, 60, 21); ?>
		<h3 class="mb0"><?php echo $first_name. ' ' .$last_name; ?></h3>

		</div>

		<div class="p20 pt0 pb10">
		<div class="interactions p0 pt10 pb10 btop">
		<ul>

		<li><span style="width: 62px; float: left;"><i class="fa fa-envelope"></i> Email: </span><span class="">
		<strong class="em"><?php echo $Usrvalue->email != "" ? $Usrvalue->email: "N/A"; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>
		<li><span style="width: 62px; float: left;"><i class="fa fa-phone"></i> Phone: </span><span class="">
		<strong class="em"><?php echo $Usrvalue->phone != "" ? $Usrvalue->phone: "N/A"; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>

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

?>
		<script>
$(document).ready(function() {
  $(".autoTimeUpdate").timeago();
});
</script>


