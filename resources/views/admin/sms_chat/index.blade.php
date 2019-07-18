@extends('layouts.main_template') 

@section('title')
<?php //echo $title;
 ?>
@endsection

@section('contents')


<?php
$loginUserData = getLoggedUser();
function phone_display_custom($num) {
    $num = preg_replace('/[^0-9]/', '', $num);
    $len = strlen($num);
    if ($len == 11 && substr($num, 0, 1) == '1') {
        return substr($num, 1, 10);
    }
    return $num;
}
if (empty($loginUserData->avatar)) {
    $currentUserImg = '/assets/images/default_avt.jpeg';
} else {
    $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
}
$firstUserData = '';
$aTwilioAc = getTwilioAccountCustom($loginUserData->id);
$isLoggedInTeam = Session::get("team_user_id");
if (!empty($isLoggedInTeam)) {
    $hasweb_access = getMemberchatpermission($isLoggedInTeam);
    if ($hasweb_access > 0 && $hasweb_access->sms_chat == 1) {
        if ($hasweb_access->bb_number != "") {
            $loginUserData->mobile = $hasweb_access->bb_number;
        } else {
            $loginUserData->mobile = $aTwilioAc->contact_no;
        }
    }
} else {
    $loginUserData->mobile = $aTwilioAc->contact_no;
}
$totalSubscriber = "";
$loginUserData->mobile = numberForamt($loginUserData->mobile);
$activeOnlysmsUsers = activeOnlysms($loginUserData->mobile); // here we place client twilio number
$activeChatCount = count((array)$activeOnlysmsUsers);
$favouriteUserDataCount = count((array)$favouriteUserData);
$favouriteUserDataCount = "";
$SmsOldest_list = SmsOldest($loginUserData->mobile);
$SmsWaitlinglonest = SmsWaitlinglonest($loginUserData->mobile);
$shortcuts = getchatshortcut($loginUserData->id);
$Counterflag = 0;
foreach ($activeOnlysmsUsers as $key => $value) {
    if ($value->to != '' && $value->from != '') {
        if (trim(numberForamt($value->to)) == trim($loginUserData->mobile)) {
            $usersdata = getUserbyPhone(numberForamt($value->from));
            $usersdata = $usersdata[0];
        }
        if (numberForamt($value->from) == $loginUserData->mobile) {
            $usersdata = getUserbyPhone(numberForamt($value->to));
            $usersdata = $usersdata[0];
        }
        if ($Counterflag == 0) {
            $defaultNumber = numberForamt($usersdata->phone);
            $userData = getincIdByPhone($defaultNumber);
            $DefaultsubscriberId = $userData[0]->id;
            $Counterflag = 1;
        }
        $Counterflag++;
    }
}
?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.timeago.js"></script>
	<style>
		.chat_user_list{/*height:730px;*/  height: 689px;  overflow:auto;}
		.mainContainer .minh_880 { height:1200px!important}
		.mainContainer .chat_user_list { height:1130px!important; overflow:hidden;}
		.mainContainer .chat_user_list:hover { overflow:auto;}
		.mainContainer .slimScrollDiv, .mainContainer .messageThreadsBox { max-height: 910px!important; height: 910px!important;}
		.mrdia-file img {width: 150px!important; height: auto!important; margin: 0px!important;}
		#CustomDiv2 .media-content .previewImage img {   width: 150px!important; height: auto!important; margin: 0px!important; }
		.chat_user_list {    background: #fff!important;
		background-color: #fff!important;}
		.borderClass { border: solid 1px red!important; padding: 10px!important;}
		.media.chatbox_new .media-right { width:100px!important}
		
	.chat_search_icon {	position: relative;	height: 21px;	width: 100%;	border: none;}
	.chat_search_icon input[type="text"]{width: 222px; border: none; border:none; height: 20px; font-size: 11px; float: left; margin: 0px 0 0 0; padding: 0px;}
	.chat_search_icon button[type="submit"]{width: 20px;height: 20px; border: none; background: none; padding: 0px;}
	.chat_search_icon button[type="submit"] img{vertical-align: top!important}
		
		.conversation_list {margin: 0; padding: 0;}
		.conversation_list li{ list-style: none; display: inline-block; }
		.conversation_list li a{color: #7a8dae ; font-weight: 400; padding: 0 20px 0 0; font-size: 13px;}
		.conversation_list li a.active{color: #09204f; font-weight: 500;}
		.smsContainer .media_file {width: 250px;}
		.chatbox_new .img-circle{margin-top: 5px;}
		.chat_user_list span.icons.fl_letters_gray { margin-top: 5px !important;}
	</style>
	<div class="content" id="SMSonly">
		<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
		<div class="page_header">
			<div class="row">
				<!--=============Headings & Tabs menu==============-->
				<div class="col-md-7">
					<h3 class="mt20"><img style="width:17px;"  src="/assets/images/chat_icon2.png"/> Chat</h3>


				</div>

			</div>

			<button style="float: right; margin-bottom: -10px" id="addBrandboost" class="btn bl_cust_btn btn-default dark_btn ml20 ConversationsIcon2" type="button"><i class="icon-plus3"></i> New Conversation</button>
		</div>
		<!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
		
		<!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
		<div class="row" id="mainContainer">
			<div class="col-md-3 pr6 firstDiv">
				<div class="panel panel-flat mb10">
					<div class="panel-heading">
						<h6 class="panel-title">Conversations<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
						<div class="heading-elements">
							<a style="background: #e4eefd;" href="javascript:void(0)"  class="icons s20 ConversationsIcon"><i style="color: #9fc3f8!important" class="icon-plus3"></i></a>
						</div>
					</div>
					<div class="panel-body p0 bkg_white">
						<div class="p20 pt-15 pb-15">
							<!--<span class="fsize12 txt_grey pull-left">All <span class="txt_grey">(39)</span> &nbsp;  <i class="icon-arrow-down5 txt_grey"></i></span>-->
							
							<div class="tdropdown ml0">
								<a  style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span class="t_sms_main" id="toogleDivName">All</span><i class="icon-arrow-down22"></i></a>
								<ul style="right: 0px!important; margin-top: 25px; left: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown">
									<li><strong><a  class="active" href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon1.png"/> <b class="smallbr">All (<?php echo $activeChatCount; ?>)</b> </a></strong></li>
									<!-- <li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/>Open (13) </a></strong></li>
									<li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon3.png"/>Resolved (172) </a></strong></li> -->
									<li><strong><a  href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon4.png"/><span class="f_link">Favorite (<?php echo $favouriteUserDataCount; ?>)</span> </a></strong></li>
									<li><strong><a  href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon5.png"/><span class="c_link">Contacts(<?php echo $totalSubscriber; ?>)</span></a></strong></li>
									
									<!-- <li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon5.png"/>Snoozed (28)</a></strong></li> -->
								</ul>
							</div>
							
							
							<div class="tdropdown ml0 pull-right">
								<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span class="f_sms_main" id="filterTitle">Newest</span> <i class="icon-arrow-down22"></i></a>
								<ul style="margin-top: 25px; right: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
									<li class="f_new"><strong><a class="active" href="javascript:void(0)">Newest </a></strong></li>
									<li style="display: none" class="f_wait"><strong><a href="javascript:void(0)">Waiting longest </a></strong></li>
									<li class="f_old"><strong><a href="javascript:void(0)">Oldest </a></strong></li>
								</ul>
								
								
								
							</div>
							
					
							<div class="clearfix"></div>
						</div>
						
						<!--++++++++SEARCH BOX++++++-->
						<div class="p20 btop pt-15 pb-15">
							<div style=" width:100%;" class="chat_search_icon">
								<input style="width: calc(100% - 22px);"   
								id="MainsearchSmsChatMsg" class="MainsearchSmsChatMsg" type="text"  name="adSearch" value="" placeholder="Search">
								
								<input style="width: calc(100% - 22px); display:none" 
								id="MainContactsearch"  class="MainContactsearch" type="text"  name="MainContactsearch" value="" placeholder="Search">
								
								<input style="display:none;width: calc(100% - 22px)" type="text" name="SmsContactBox" placeholder="Search" id="SmsContactBox" value="">
								
								<input type="hidden" name="afterTrigger" id="afterTrigger" value="">
								<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
							</div>
						</div>
						<!--++++++++SEARCH BOX++++++-->
						
						
					</div>
				</div>
				
				<div id="AjaxSearchSms" style="height:670px; display:none;background-color:#fff!important">
			</div>
			
			 <div id="InitalSms">
		
				<!--++++++++++++ Active chat list +++++++++++++++-->
					<div id="a_list_sms" class="panel-body p0 br5 mb10 chat_user_list activeChat a_list" style="background-image:none; <?php if (!empty($defaultNumber)) { ?>display:block;<?php
} else { ?>display:none;<?php
} ?>">
					 @include('admin.sms_chat.activechat_list', array('mobile'=>$loginUserData->mobile,'activechatlist' => $activeOnlysmsUsers))
				</div>
				<!--++++++++++++ Active chat list +++++++++++++++-->
				
				
				<!--++++++++++++ favourite chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list favouriteChatlist f_list" style="background-image:none; display:none">
					@include('admin.sms_chat.favourite_list')
				</div>
			    <!--++++++++++++ favourite chat list +++++++++++++++-->
				
				
				<!--++++++++++++ oldest chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list o_list" style="background-image:none; display:none">
					@include('admin.sms_chat.oldsmschat_list', array('mobile'=>$loginUserData->mobile,'oldsmschat_list' => $SmsOldest_list))
				</div>
			    <!--++++++++++++ oldest chat list +++++++++++++++-->
				
					<!--++++++++++++ wait chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list w_list" style="background-image:none; display:none">
					{{-- @include('admin.sms_chat/wait_list', array('mobile'=>$loginUserData->mobile,'wait_list' => $SmsWaitlinglonest)) --}}
				</div>
			    <!--++++++++++++ wait chat list +++++++++++++++-->
		
				</div>
				
				<!--<a href="javascript:void(0)" class="loadMoreActivity loadMoreRecordActivity blue_plus_increase" style="bottom:-6px;"><i class="icon-plus3 fsize11 txt_white"></i></a>-->
				
				
				<!-- Contact list -->
				<div class="panel-body p0 br5 mb10 chat_user_list subs_list c_list" style="background-image:none; <?php if (!empty($defaultNumber)) { ?>display:none;<?php
} else { ?>display:block;<?php
} ?>">
					<?php
$initNumber = "";
//$owners = getowners($loginUserData->id);
$autocmpSearch = array();
$contactCount = 0;
$flag = 0;
$character = array('A' => 'a', 'B' => 'b', 'C' => 'c', 'D' => 'd', 'E' => 'e', 'F' => 'f', 'G' => 'g', 'H' => 'h', 'I' => 'i', 'J' => 'j', 'K' => 'k', 'L' => 'l', 'M' => 'm', 'N' => 'n', 'O' => 'o', 'P' => 'p', 'Q' => 'q', 'R' => 'r', 'S' => 's', 'T' => 't', 'U' => 'u', 'V' => 'v', 'W' => 'w', 'X' => 'x', 'Y' => 'y', 'Z' => 'z');
foreach ($character as $key => $value) {
    $getCharUserList = \App\Models\Admin\SubscriberModel::getGlobalSubscribersByChar($loginUserData->id, $value);
    foreach ($getCharUserList as $userData) {
        $count = 0;
        $userDataDetail = getUserDetail($userData->user_id);
        if (!empty($userDataDetail->avatar)) {
            $avatar = $userDataDetail->avatar;
        } else {
            $avatar = "";
        }
        $favUser = \App\Models\Admin\SmsChatModel::getSMSFavouriteBySubsId($userData->user_id);
        $autocmpSearch[] = $userData->firstname . '' . $userData->lastname . '(' . $userData->phone . ')';
        if ($flag == 0) {
            $phone_no = $userData->phone;
            $defaultUserNumber = $phone_no;
            $subscriberId = $userData->id;
            $flag = 1;
        }
        $favUser = getFavSmsUser($loginUserData->id, $userData->phone);
?>
								<div id="chatBx_<?php echo $userData->phone; ?>" class="media chatbox_new bkg_white <?php if ($count == 1) {
            echo 'mb10';
        } ?>" style="<?php if ($count == 1) {
            echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px';
        } ?>"> 
									<input type="hidden" id="userImg_<?php echo $userData->phone; ?>" value="">
									<a href="javascript:void(0);" class="media-link bbot getChatDetails" subscriberId = "<?php echo $userData->id; ?>"  phone_no="<?php echo $userData->phone; ?>">
										<div class="media-left"><?php echo showUserAvtar($avatar, $userData->firstname, $userData->lastname, 28, 28, 12); ?>
										<span class="favouriteSMSUser" subscriberId = "<?php echo $userData->phone; ?>"><i class="fa fa-star star_icon <?php echo $favUser > 0 ? 'yellow' : ''; ?>"></i></span></div>
										
										<div class="media-body"> 

											<span class="fsize12 txt_dark"><?php echo phoneNoFormat($userData->phone); ?></span> 

				<span class=""><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            Assigned to:&nbsp;<!--+1(359) 569-6585--><?php echo phoneNoFormat($userData->phone); ?></span></span>

				<span class="slider-phone contacts txt_dark" style="margin:0px; font-weight:bold; font-size:12px!important"><?php echo $userData->email; ?></span> 
				<span class="contacts text-size-small txt_blue" style="margin:0px;display:none"><?php echo $userData->phone; ?></span>
				
											<!-- <span id="chatBxName_<?php echo $userData->phone; ?>" class="fsize12 txt_dark"><?php echo $userData->firstname ?> <?php echo $userData->lastname ?></span> 
											<span id="chatEmName_<?php echo $userData->phone; ?>" class="slider-phone contacts text-size-small txt_blue" style="margin:0px"><?php echo $userData->phone; ?></span>  -->
										</div>
										
									</a> 
								</div>
							<?php $contactCount++;
    }
}
?>
				</div>
				
				
				<!-- Contact list -->
				
				
				
			</div>
			
			
			<div class="userChatData smsContainer">
				
				@include('admin.sms_chat.userchatdata', array('defaultNumber'=>$defaultNumber,'shortcuts'=>$shortcuts))
			</div>
			
			
		</div>
		<!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
		
		<?php
if (empty($loginUserData->avatar)) {
    $currentUserImg = '/assets/images/default_avt.jpeg';
} else {
    $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
} ?>
	</div>

<script>
$(document).ready(function() {
	$('#SMSonly .c_link').html('Contacts(<?php echo $contactCount; ?>)');
	$('#SmsContactBox').on("keyup", function() {
		var textInput = $( this ).val().toLowerCase();
		$( '#SMSonly .searchInput' ).val(textInput);
		
		$("#SMSonly .chatbox_new").filter(function() {
			$(this).toggle($(this).find('.txt_dark').text().toLowerCase().indexOf(textInput) > -1)
		});
		
		
	});
	});
	
	$( document ).ready(function() {
		var SubscriberPhone; 
		var subscriberId;
		
		
		
		$(document).on('click', '.getChatDetails', function (event) {
		    SubscriberPhone = $(this).attr('phone_no');
		    subscriberId = $(this).attr('subscriberId');

		    $('.getChatDetails').each(function(index) {
		    	 $(this).removeClass('activechat');
		    });

		    $(this).addClass('activechat');
		  
			var rewId = $(this).attr('rewId');
		    var token = 	$(this).attr('token');
			 showNoteslisting(SubscriberPhone);
			$('.hIdelater').show();
			$('#livesearchVal').val('');
			$('#livesearch').html('');
			$('.common_msg').trigger('click');
			$('.addtionalSearchDiv').hide();
			$('.editModuleSubscriber_sms').attr('data-modulesubscriberid',subscriberId);
			$('.editModuleSubscriber_sms').attr('moduleaccountid',subscriberId);
			
		     showSMSChatData(subscriberId,SubscriberPhone);
			if($(this).attr('wait') == 'yes')
			{
		        updatReadStatus(rewId,token); 	
			}
			
			$('.Dnumber').html($(this).attr('formatedNumber'));
		});
	});
	
	 function updatReadStatus(SubscriberPhone,token)
  	{
                $.ajax({
					url: '<?php echo base_url('admin/Chat/setSmsReadstatus'); ?>',
					type: "POST",
					data: {'phoneNo' : SubscriberPhone,'token' : token},
					dataType: "html",
					success: function (data) {
				     $('#gr_'+token).hide();
						},error: function(){
					}
				});
	  	
	}
	
		function showSMSChatData(userId,SubscriberPhone,clickvalue=null )
		{
		
		    $('.editModuleSubscriber_sms').attr('data-modulesubscriberid',userId);
			$('.editModuleSubscriber_sms').attr('moduleaccountid',userId);
			
			 $('#livesearchVal').val(clickvalue);
			 $('#livesearch').html('');
			 $('#livesearch').removeAttr("style");
			$.ajax({
				url: '<?php echo base_url('admin/smschat/getSubsinfo'); ?>',
				type: "GET",
				data: {'userId':userId,'SubscriberPhone':SubscriberPhone},
				success: function (data) {
               var obj =  $.parseJSON(data);
				var dynamicid = 'bigsms_chat_'+obj[2].phone;
				var dynamicid_shortcut = 'bigsms_chat_shortcut_'+obj[2].phone;
				$('.bigsms_chat').attr('id',dynamicid);
				$('.bigsms_chat_shortcut').attr('id',dynamicid_shortcut);
				$('.ajaxUserinfo .profile_pic').html(obj[3].avatar);
				$('.ajaxUserinfo .em').html(obj[0].email);
				$('.ajaxUserinfo .ep').html(obj[2].phone);
				$('.smsContainer #em_phone').val(obj[2].phone);
				$('.smsContainer #em_sub_id').val(obj[5].em_sub_id);
				$('.smsContainer .subs_name').html(obj[1].name);
				$('.smsContainer #em_id').val(userId);
				$('#SMSonly #smsSearcharea').attr('tWR',obj[2].phone);
				$('.smsContainer .city').html(obj[6].city);
				$('.smsContainer .code').html(obj[7].code);
				$('.smsContainer .gender').html(obj[7].gender);
				if(obj[9].avfinder == null)
				{
				$('#avatarFinder').val('1');
				}
				else
				{
				$('#avatarFinder').val('0');
				}

					
					//avatarFinder
					$.ajax({
						url: '<?php echo base_url('admin/smschat/showSmsThreads'); ?>',
						type: "POST",
						data: {'userId':userId,'SubscriberPhone':SubscriberPhone, _token: '{{csrf_token()}}'},
						dataType: "html",
						success: function (data) {
						$('#smsSearcharea').html(data+'<div class="msg_push"></div>');
					    setTimeout(function(){ var msgHeight = document.getElementById("smsSearcharea").scrollHeight;
						$( '#smsSearcharea' ).scrollTop(msgHeight); }, 500);
						
						},error: function(){
						  alertMessage('Error: Some thing wrong!');
						}
					});	
			}
			});
		}
	
	
	$('body').on('keyup', '.smsContainer .messageContent', function(e){

	if(e.keyCode == 191)
	{
	$.ajax({
	url: '<?php echo base_url('admin/smschat/shortcutListing'); ?>',
	type: "POST",
	data: { _token: '{{csrf_token()}}'},
	dataType: "html",
	success: function (data) {
	$('#shortcutBox').html(data);
	$('#SMSonly .chat_shortcuts').toggle();
	 $('#Search_shortcut').focus();
	}
	});
	}
	else if(e.keyCode == 8)
	{
	$('.chat_shortcuts').hide();
	}


	else if (e.which == 13) {
	$(".smsContainer .sendMsg").click();
	}


	});
	
	function geneRateToken(length) {
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			
			for (var i = 0; i < length; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));
			
			return text;
		}
	
	//  ######### send sms ############ //
	$('body').on('click', '.smsContainer .sendMsg', function(){
			var userPhoneNo="";
		    var userid = "";
		     userPhoneNo = $('.smsContainer #em_phone').val();
		     userid =  userPhoneNo;
			var messageContent = $('.smsContainer .messageContent').val();
			$('.smsContainer .messageContent').val('');
			if(userPhoneNo == '' ){
				//alertMessage('User phone number is not avilable.');
				 displayMessagePopup('error', '', 'User phone number is not avilable'); //javascript notification msg
				}else if($.trim(messageContent) == ''){
				 $('#SMSonly .messageContent').addClass('borderClass');	
				
				}else{
					
					setTimeout(function(){ $('#SMSonly .messageContent').removeClass('borderClass'); }, 50);	
				var messageText ='<li class="media reversed"> <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><span class="icons s32"><img src="<?php echo $currentUserImg; ?>" class="img-circle" alt="" width="28" height="28"></span></span><div class="media-content">'+messageContent+'</div></div></li>';
				
				var messageSmilies = messageText.match(smileyReg) || [];
				for(var i=0; i<messageSmilies.length; i++) {
					var messageSmiley = messageSmilies[i],
					messageSmileyLower = messageSmiley.toLowerCase();
					if(smiliesMapSMSChat[messageSmileyLower]) {
						messageText = messageText.replace(messageSmiley, "<img style='width:auto; height:auto;' src='<?php echo base_url(); ?>assets/img-smile/"+smiliesMapSMSChat[messageSmileyLower]+".gif' alt='smiley' />");
					}
				}
				
				//$('.smsContainer .messageThreadsBox .msg_push').before(messageText);
				$('[tWR="' + userPhoneNo + '"] .msg_push').before(messageText);
				$('.sms_twr_'+userPhoneNo).find('.slider-phone').html(messageContent.substring(0, 20));
				

			var currentDayNew = new Date();
			var currentDateNew = currentDayNew.getFullYear()+'-'+((currentDayNew.getMonth() + 1) < 10 ? '0' : '') + (currentDayNew.getMonth() + 1)+'-'+(currentDayNew.getDate() < 10 ? '0' : '') + currentDayNew.getDate();
			var currentTimeNew = (currentDayNew.getHours() < 10 ? '0' : '') + currentDayNew.getHours() + ":" + (currentDayNew.getMinutes() < 10 ? '0' : '') + currentDayNew.getMinutes() + ":" + (currentDayNew.getSeconds() < 10 ? '0' : '') + currentDayNew.getSeconds();

			var dateTimeNew = currentDateNew+' '+currentTimeNew;
			$('.sms_twr_'+userPhoneNo+' .date_time time').remove();
			$('.sms_twr_'+userPhoneNo+' .media-right .date_time').html('<time class="autoTimeUpdate autoTime_'+userPhoneNo+'" datetime="'+dateTimeNew+'">1 second ago</time>');

			$('.sms_twr_'+userPhoneNo+' .date_time time').remove();
			$('.sms_twr_'+userPhoneNo+' .date_time').html('<time class="autoTimeUpdate autoTime_'+userPhoneNo+'" datetime="'+dateTimeNew+'">1 second ago</time>');



			$('.autoTime_'+userPhoneNo).timeago();


				$('.smsContainer .messageContent').val('');
				
				var msgHeight = document.getElementById("smsSearcharea").scrollHeight;
				$( '#smsSearcharea').scrollTop(msgHeight);
				
				var aToken = Number(userPhoneNo) + Number('<?php echo $loginUserData->mobile; ?>');

				if(Number(userPhoneNo) > Number('<?php echo $loginUserData->mobile; ?>')){
				var sToken = Number(userPhoneNo) - Number('<?php echo $loginUserData->mobile; ?>');
				}
				else {
				var sToken = Number('<?php echo $loginUserData->mobile; ?>') - Number(userPhoneNo);
				}
				var newToken = aToken+'n'+sToken;
					
							//$('.activeChat').show();
							$('.subs_list').hide();
							var flag = 0;		 
							$('.activityShow').each(function(i) 
							{

								if($(this).find('.getChatDetails').attr('phone_no') == userPhoneNo )
								{
								  flag++;
								}


							});
					                if(flag == 0)
									{
									if(document.getElementById("em_new_number").value == '1')
									{
                                      
									$('.activeChat').prepend('<div class="activityShow sms_twr_'+userPhoneNo+' media chatbox_new bkg_white mb10 '+userPhoneNo+'" style="box-shadow:0 2px 4px 0 rgba(1, 21, 64,0.06)!important; border-radius:0 0 5px 5px"><a href="javascript:void(0);" class="media-link bbot  getChatDetails " subscriberId="" phone_no='+userPhoneNo+'><div class="media-left"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:12px;">NA</span><span class="favouriteSMSUser" style="display:none" subscriberId="" phone_no='+userPhoneNo+'><i class="fa fa-star star_icon "></i></span></div><div class="media-body"> <span class="fsize12 txt_dark">'+userPhoneNo+'</span> <span id=unMsg_'+userPhoneNo+' class="slider-phone contacts text-size-small" style="margin:0px">'+$('#smsSearcharea .media-content').text().substring(0, 20)+'...</span><span class="fsize12 txt_dark"></span> </div><div class="media-right"><span class="date_time txt_grey fsize12">just now</span></div></a> </div>');
									$('.SmallSmschat .a_list').prepend('<div phone_no_format='+userPhoneNo+' id="sidebar_Sms_box_'+userPhoneNo+'" class="sms_user sms_twr_'+userPhoneNo+'" incsmswid="" rewid="" phone_no='+userPhoneNo+' user_id="146"><span style="display: none;" class="slider-image img"><?php echo $currentUserImg; ?></span><div class="avatarImage"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:11px;">NA</span></div><span style="display:none" id="fav_star_"><a style="cursor: pointer;" class="favourite" status="1" user_id=""><i class="icon-star-full2 text-muted sidechatstar"></i></a></span><span class="slider-username contacts">'+userPhoneNo+'</span> <span class="slider-phone contacts txt_dark" style="margin:0px;color:#6a7995!important; font-weight:bold;padding-left:40px; font-size:12px!important">'+$('#smsSearcharea .media-content').text().substring(0, 20)+'...</span><span class="user_status">Just Now</span></div>');
									$.ajax({
									url: '<?php echo base_url('admin/subscriber/add_contact'); ?>',
									type: "POST",
									data: {'firstname' : 'NA', 'lastname' : 'NA', 'phone' : userPhoneNo},
									dataType: "json",
									success: function (data) {
									if (data.status == 'success') {
									$('.sms_twr_'+userPhoneNo+' .getChatDetails ').attr('subscriberid',data.iSubscriberID);
									$('.editModuleSubscriber_sms').attr('data-modulesubscriberid',data.iSubscriberID);
									$('.editModuleSubscriber_sms').attr('data-moduleaccountid',data.iSubscriberID);
									} else {
									alertMessage('Error: Some thing wrong!');
									$('.overlaynew').hide();
									}
									}
									});

									}
									else
									{

                              
									$('.activeChat').prepend('<div class="activityShow sms_twr_'+userPhoneNo+' media chatbox_new bkg_white mb10 '+newToken+'" style="box-shadow:0 2px 4px 0 rgba(1, 21, 64,0.06)!important; border-radius:0 0 5px 5px"><a href="javascript:void(0);" class="media-link bbot  getChatDetails " subscriberId='+userid+' phone_no='+userPhoneNo+'><div class="media-left"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:12px;">NA</span><span class="favouriteSMSUser" style="display:none" subscriberId="" phone_no='+userPhoneNo+'><i class="fa fa-star star_icon "></i></span></div><div class="media-body"> <span class="fsize12 txt_dark">'+userPhoneNo+'</span> <span id=unMsg_'+userPhoneNo+' class="slider-phone contacts text-size-small" style="margin:0px">'+$('#smsSearcharea .media-content').text().substring(0, 20)+'...</span><span class="fsize12 txt_dark"></span> </div><div class="media-right"><span class="date_time txt_grey fsize12">just now</span></div></a> </div>'); 
									$('.SmallSmschat .a_list').prepend('<div phone_no_format='+userPhoneNo+' id="sidebar_Sms_box_'+userPhoneNo+'" class="sms_user sms_twr_'+userPhoneNo+'" incsmswid="" rewid="" phone_no='+userPhoneNo+' user_id="146"><span style="display: none;" class="slider-image img"><?php echo $currentUserImg; ?></span><div class="avatarImage"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:11px;">NA</span></div><span style="display:none" id="fav_star_"><a style="cursor: pointer;" class="favourite" status="1" user_id=""><i class="icon-star-full2 text-muted sidechatstar"></i></a></span><span class="slider-username contacts">'+userPhoneNo+'</span> <span class="slider-phone contacts txt_dark" style="margin:0px;color:#6a7995!important; font-weight:bold;padding-left:40px; font-size:12px!important">'+$('#smsSearcharea .media-content').text().substring(0, 20)+'...</span><span class="user_status">Just Now</span></div>');

									}
										
									}

					 
			
				$.ajax({
					url: '<?php echo base_url('admin/smschat/sendMsg'); ?>',
					type: "POST",
					data: {'phoneNo' : userPhoneNo, 'messageContent' : messageContent, 'smstoken': newToken, 'moduleName' : 'chat', 'media_type': '', 'videoUrl': '',_token: '{{csrf_token()}}'},
					success: function (data) {
						if(data == 'ERROR!')
						{
						  alert('Number is not valid');
					}
					else
					{
						var msgHeight = document.getElementById("smsSearcharea").scrollHeight;
						$( '#smsSearcharea' ).scrollTop(msgHeight);
					}
					
						},error: function(){
					}
				});
				
				$('.sms_twr_'+userPhoneNo+' .getChatDetails').trigger('click');
			}
		});
	
	//  ######### send sms ############ //
	
	
	
	//  ######### media  file upload ############ //
	$(document).on('click', '.smsContainer .smsFileAttechment', function() {
			$('.smsContainer #mmsFile').attr('chatTo', $('.smsContainer #em_phone').val());
			$('.smsContainer #mmsFile').trigger('click');
		});
	//  ######### media  file upload ############ //
	
		$(document).on('change', '.smsContainer #mmsFile', function(e) {
			$('.overlaynew').show();
			const files = document.querySelector('[id=mmsFile]').files;
			var chatTo = $('.smsContainer #mmsFile').attr('chatTo');
			var currentUser = '<?php echo $loginUserData->id; ?>';
			
	
	var aToken = Number(chatTo) + Number('<?php echo $loginUserData->mobile; ?>');
	
	if(Number(chatTo) > Number('<?php echo $loginUserData->mobile; ?>')){
		var sToken = Number(chatTo) - Number('<?php echo $loginUserData->mobile; ?>');
		}
		else {
		var sToken = Number('<?php echo $loginUserData->mobile; ?>') - Number(chatTo);
		}
		var newToken = aToken+'n'+sToken;

			const formData = new FormData();
			
			for (let i = 0; i < files.length; i++) {
				let file = files[i];
				formData.append('files[]', file);
			}
			
			fetch('<?php echo base_url("/dropzone/upload_s3_attachment/" . $loginUserData->id . "/smschat"); ?>', { 
				method: 'GET',
				body: formData // This is your file object
			}).then(
			response => response.json() // if the response is a JSON object
			).then(
			success => {
				if(success.error == '') {


					var filename = success.result;
					var fileext = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
					var msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+filename;
					
					setTimeout(function(){
					
						if(fileext[0] == 'mp4' || fileext[0] == 'webm' || fileext[0] == 'ogg') {
							$.ajax({
							
							url: '<?php echo base_url('admin/smschat/sendMsg'); ?>',
							
							type: "POST",
							data: {'phoneNo' : chatTo, 'messageContent' : msg,'smstoken': newToken, 'moduleName' : 'chat', 'media_type': 'video', 'videoUrl': 'send'},
							dataType: "html",
							success: function (data) {
							SMSChatBigData(chatTo,chatTo,'');
							$('.sms_twr_'+chatTo).find('.slider-phone').html('File Attachment');
				            //$(this).val('');
							
							},error: function(){
							alertMessage('Error: Some thing wrong!');
							}
							});
						}
						else {
							$.ajax({
							
							url: '<?php echo base_url('admin/smschat/sendMMS'); ?>',
							
							type: "POST",
							data: {'phoneNo' : chatTo, 'messageContent' : msg,'smstoken': newToken, 'moduleName' : 'chat', 'media_type': 'image', 'videoUrl':''},
							dataType: "html",
							success: function (data) {
							SMSChatBigData(chatTo,chatTo,'');
							$('.sms_twr_'+chatTo).find('.slider-phone').html('File Attachment');
				            //$(this).val('');
							
							},error: function(){
							alertMessage('Error: Some thing wrong!');
							}
							});
						}

						$('.overlaynew').hide();
					
					}, 3000);

					
				}
				else {
					$('#msg_status_show_'+chatTo).html('<spam id="errormsg_'+chatTo+'" style="color:red">'+success.error+'</spam>');
					setTimeout(function() {
						$('#errormsg_'+chatTo).html('&nbsp;');
					}, 3000);
				}
			} // Handle the success response object
			).catch(
			error => console.log(error) // Handle the error response object
			);

			$('#mmsFile').remove();
			$('.smsContainer').append('<input style="display:none;" id="mmsFile" type="file">');
			
		});
	
	
	  //  ######### smily code ############ //  
	var smiliesMapSMSChat = {
		":)" : "1",
		":(" : "2",
		";)" : "3",
		":d" : "4",
		";;)": "5",
		":/" : "7",
		":x" : "8",
		":p" : "10",
		":*" : "11",
		":o" : "13",
		":>" : "15",
		":s" : "17",
		":((": "20",
		":))": "21",
		":|": "22",
		":b": "26",
		":&": "31",
		":$": "32",
		":?" : "39",
		"#o": "40",
		":ss": "42",
		"@)": "43",
		":w": "45",
		":c": "101",
		":h": "103",
		":t": "104",
		":q": "112"
	},
	smileyReg = /[:;#@]{1,2}[\)\/\(\&\$\>\|xXbBcCdDpPoOhHsStTqQwW*?]{1,2}/g;
	
	$(document).on("click", ".smsContainer .smilieSmsIconMessage", function() {
		renderSmiliesChat();
	});
	
	
	function renderSmiliesChat() {
        
		var $smileyGrid = $(".smsContainer .smiley_grid_smschat");
		
		// render smilies if required
		if($smileyGrid.children().length == 0) {
			var smileisPerRow = 6,
			$smileySet = $(),
			$smileyRow = $();
			
			for(var i in smiliesMapSMSChat) {
				var kids = $smileyRow.children().length;
				if(kids%smileisPerRow == 0) {
					$smileyRow = $("<div>").addClass("row gap-bottom text-center");
					$smileySet = $smileySet.add($smileyRow);
				}
				
				var smileyCol = $("<div>").addClass("col-md-2"),
				smileyImg = $("<img>").attr({
					"src": "<?php echo base_url(); ?>assets/img-smile/"+smiliesMapSMSChat[i]+".gif",
					"title": i.toString(),
					"smiley":i.toString(),
					"data-toggle": "tooltip",
					"data-placement": "top"
				}).addClass("smiley_hint_smschat");
				smileyCol.append(smileyImg);
				$smileyRow.append(smileyCol);
			}
			$smileyGrid.append($smileySet);
			$(".smsContainer .smiley_hint_smschat").on("click", function() {
				
				var inputText = $('.smsContainer .messageContent').val();
				$('.smsContainer .messageContent').val(inputText.concat($(this).attr('smiley')));
				$(".smsContainer .supported_smilies_smschat").toggleClass("hide");
				$('.smsContainer .messageContent').focus();
				
			}).tooltip();
		}
		
		// toggle smiley container hide
		$(".smsContainer .supported_smilies_smschat").toggleClass("hide");
	}
	
	 //  ######### smily code ############ //  
	
	 //  ######### Live Search ############ //  
	
		$( document ).on( 'click', '.ConversationsIcon, .ConversationsIcon2', function () {
		$('.hIdelater').hide();
		$('#livesearchVal').val('');
	    $('#livesearch').html('');
		$('.addtionalSearchDiv').show();
	    $('.common_msg').trigger('click');
		$('.smsChatTextarea').html('<div class="msg_push"></div>');
		
		
	});
	
	
	function showResult(str) {
	
	str = str.replace(/\D/g,"");
	if(str.length>10)
	{
	   displayMessagePopup('error', '', 'Please enter 10 digit phone number'); //javascript notification msg
	   document.getElementById("livesearchVal").value='';
	}
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    //document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
   
    xmlhttp=new XMLHttpRequest();
  } else {  
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
		if(this.responseText == '400')
		{
			document.getElementById("em_new_number").value='1';
			$('.smsChatTextarea').attr('twr',str);
			document.getElementById("em_phone").value=str;
			$('.smsContainer #smsSearcharea').html('<div class="msg_push"></div>');
			$(".smsContainer .profile_pic img").attr("src","/assets/images/default_avt.jpeg");
			$('.smsContainer .ajaxUserinfo .em').html('NA');
			$('.smsContainer .ajaxUserinfo .ep').html('NA');
			document.getElementById("livesearch").innerHTML='';
	 
		}
		else
		{
		document.getElementById("livesearch").innerHTML=this.responseText;
		document.getElementById("livesearch").style.border="1px solid #A5ACB2";
		}
		
    }
  }
  xmlhttp.open("GET","<?php echo base_url('admin/smschat/livesearch'); ?>?q="+str,true);
  xmlhttp.send();
}
	
	 //  ######### switch top menu  ############ //
		$(document).on('click', '#SMSonly .c_link', function() {
		     $('#AjaxSearchSms').hide();
			$('#InitalSms').show();
			$('#SMSonly .a_list').hide();
			$('#SMSonly .f_list').hide();
			$('#SMSonly .o_list').hide();
			$('#SMSonly .w_list').hide();
			$('#SMSonly .c_list').show();
			
			$('#SmsContactBox').show();
			$('#MainsearchSmsChatMsg').hide();
			$('#SMSonly .t_sms_main').html('Contacts(<?php echo $contactCount; ?>)');
			
		});
	
	$(document).on('click', '#SMSonly .f_link', function() {
	$('#AjaxSearchSms').hide();
			$('#InitalSms').show();
			$('#SMSonly .a_list').hide();
			$('#SMSonly .c_list').hide();
	     	$('#SMSonly .o_list').hide();
		     $('#SMSonly .w_list').hide();
			$('#SMSonly .f_list').show();
			$('#SMSonly .t_sms_main').html('Favorite(<?php echo $favouriteUserDataCount; ?>)');
			
		});
	
	
	$(document).on('click', '#SMSonly .smallbr', function() {
	$('#AjaxSearchSms').hide();
			$('#InitalSms').show();
			$('#SMSonly .o_list').hide();
		    $('#SMSonly .w_list').hide();
			$('#SMSonly .f_list').hide();
			$('#SMSonly .c_list').hide();
     		$('#SMSonly .a_list').show();
		$('#SMSonly .t_sms_main').html('All (<?php echo $activeChatCount; ?>)');
			$('#SmsContactBox').hide();
			$('#MainsearchSmsChatMsg').show();
			
		});
	
	   $(document).on('click', '#SMSonly .f_new', function() {
	   $('#AjaxSearchSms').hide();
			$('#InitalSms').show();
			$('#SMSonly .o_list').hide();
		    $('#SMSonly .w_list').hide();
			$('#SMSonly .f_list').hide();
			$('#SMSonly .c_list').hide();
     		$('#SMSonly .a_list').show();
		$('#SMSonly .t_sms_main').html('All (<?php echo $activeChatCount; ?>)');
		   $('#SMSonly .f_sms_main').html('Newest'); 
		   $('#SmsContactBox').hide();
			$('#MainsearchSmsChatMsg').show();
			
		});
	     $(document).on('click', '#SMSonly .f_old', function() {
		 $('#AjaxSearchSms').hide();
			$('#InitalSms').show();
			$('#SMSonly .o_list').show();
			$('#SMSonly .w_list').hide();
			$('#SMSonly .f_list').hide();
			$('#SMSonly .c_list').hide();
     		$('#SMSonly .a_list').hide();
			$('#SMSonly .f_sms_main').html('Oldest'); 
			$('#SmsContactBox').hide();
			$('#MainsearchSmsChatMsg').show();
			
		});
	    $(document).on('click', '#SMSonly .f_wait', function() {
		$('#AjaxSearchSms').hide();
			$('#InitalSms').show();
			$('#SMSonly .w_list').show();
			$('#SMSonly .o_list').hide();
			$('#SMSonly .f_list').hide();
			$('#SMSonly .c_list').hide();
     		$('#SMSonly .a_list').hide();
			$('#SMSonly .f_sms_main').html('Waiting longest'); 
			$('#SmsContactBox').hide();
			$('#MainsearchSmsChatMsg').show();
			
		});
	
	
	 //  ######### fav click ############ //  
			$('body').on('click','.favouriteSMSUser',function(){
				var thisObj = $(this);
			var currentUser = "<?php echo $loginUserData->id; ?>";
			$.ajax({
				url: '<?php echo base_url('admin/smschat/addSMSFavourite'); ?>',
				type: "POST",
				data: {user_id:$(this).attr('subscriberId'), currentUser:currentUser},
				dataType: "json",
				success: function (data) {
					if (data.status == 'ok') {
						if(thisObj.children().hasClass('yellow') === true){
							thisObj.children().removeClass('yellow');
							thisObj.children().removeClass('fa-star');
							thisObj.children().addClass('fa-star-o');
							ShowfavouritAjax();
							}else{
							thisObj.children().addClass('yellow');
							thisObj.children().addClass('fa-star');
							thisObj.children().removeClass('fa-star-o');
							ShowfavouritAjax();
						}
						
					}
				}
			});
			return false;
		});
	 //  ######### fav click ############ //  
	
	
	function ShowfavouritAjax() 
		{
			$.ajax({
				url: '<?php echo base_url('admin/smschat/showfavouriteAjax'); ?>',
				type: "POST",
				success: function (data) {
					$('.f_list').html(data); 
				}
			});
			
			
		}
		
$(document).ready(function(){
$(document).on("keyup",".MainsearchSmsChatMsg", function() {
$.ajax({
url: '<?php echo base_url('admin/smschat/getSearchSmsListByinput'); ?>',
type: "POST",
data: {searchVal:$('#MainsearchSmsChatMsg').val(),_token: '{{csrf_token()}}'},
success: function (data) {
$('#InitalSms').hide();
$('#AjaxSearchSms').show();
$('#a_list_sms').html(data); 
$('#AjaxSearchSms').html(data); 

}
});

});
});
	
	 //  ######### Live Search ############ //  
	<?php if ($defaultNumber != "") { ?>
           showNoteslisting(<?php echo $DefaultsubscriberId; ?>);
		  showSMSChatData('<?php echo $DefaultsubscriberId; ?>','<?php echo $defaultNumber; ?>');
		<?php
} else { ?>
		showSMSChatData('<?php echo $subscriberId; ?>','<?php echo $defaultUserNumber; ?>');
	    showNoteslisting(<?php echo $subscriberId; ?>);
		<?php
} ?>
</script>
<script>
$(document).ready(function() {
  $(".autoTimeUpdate").timeago();
});

function SMSChatBigData(userId="",SubscriberPhone,clickvalue="" )
{

$.ajax({
url: '<?php echo base_url('admin/smschat/showSmsThreads'); ?>',
type: "POST",
data: {'userId':userId,'SubscriberPhone':SubscriberPhone},
dataType: "html",
success: function (data) {
$('#smsSearcharea').html(data+'<div class="msg_push"></div>');
setTimeout(function(){ var msgHeight = document.getElementById("smsSearcharea").scrollHeight;
$( "#smsSearcharea").scrollTop(msgHeight); }, 500);
},error: function(){
alertMessage('Error: Some thing wrong!');
}
});	
}
</script>

@endsection

