@extends('layouts.main_template') 

@section('title')
<?php //echo $title;
 ?>
@endsection

@section('contents')
<?php
$contactCount = '';
$aUInfo = getLoggedUser();
$isLoggedInTeam = Session::get("team_user_id");
if ($isLoggedInTeam) {
    $aTeamInfo = App\Models\Admin\TeamModel::getTeamMember($isLoggedInTeam, $aUInfo->id);
    $teamMemberName = $aTeamInfo->firstname . ' ' . $aTeamInfo->lastname;
    $teamMemberId = $aTeamInfo->id;
    $loginMember = $teamMemberId;
} else {
    $teamMemberName = '';
    $teamMemberId = '';
    $loginMember = $aUInfo->id;
}
if (empty($aUInfo->avatar))
$avatar = "";
else 
$avatar = $aUInfo->avatar;

if (empty($avatar)) {
    $currentUserImg = '/assets/images/default_avt.jpeg';
} else {
    $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $avatar;
}
$firstUserData = '';
$favouriteUserDataCount = count((array)$favouriteUserData);

// loop for latest chat by the user id 
$activeOnlyweb = activeOnlyweb($loginMember); // login user id 

// loop for old chats by the user id 
$oldchat_list = activeOnlywebOldchatlist($loginMember);
// loop for users who are waiting by the user id 
$WaitingChatlist = WaitingChatlist($loginMember);
// get shortcuts  the user id 
$shortcuts = getchatshortcut($loginMember);
// get sFavlist by the user id 
$Favorites_list = getFavlist($loginMember);
// get unassign chat 
$unassignChat = getTeamUnAssignDataHelper();
// get assign chat 
$assignChat = getTeamAssignDataHelper($loginMember);

// loop to get the first user in the loop 
$Counterflag = 0;

foreach ($activeOnlyweb as $key => $value) {
    $token = "";
    $userid = "";
    $token = $value->room;
    $userid = $value->user;
    if ($Counterflag == 0) {
        $popupId = $userid;
        $popupToken = $token;
        $Counterflag = 1;
    }
    $Counterflag++;
}

// first user in the loop 
$popupId = !empty($popupId) ? $popupId : '';
$popupToken = !empty($popupToken) ? $popupToken : '';


?>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.timeago.js"></script>
	<style>
		.chat_user_list{/*height:730px;*/  height: 635px;  overflow:auto;}
		.mainContainer .minh_880 { height:1200px!important}
		.mainContainer .chat_user_list { height:1130px!important; overflow:hidden;}
		.mainContainer .chat_user_list:hover { overflow:auto;}
		.mainContainer .slimScrollDiv, .mainContainer .messageThreadsBox { max-height: 910px!important; height: 910px!important;}
		.mrdia-file img {width: 150px!important; height: auto!important; margin: 0px!important;}
		#CustomDiv2 .media-content .previewImage img {   width: 150px!important; height: auto!important; margin: 0px!important; }
		.chat_user_list {    background: #fff!important;
		background-color: #fff!important;}
		.favouriteSMSUser { display: none!important; }
		.uAddText {height: 25px; background: #fff; border: 1px solid #eee; border-radius: 4px; padding:0 10px; margin-left: 7px; }
		.assign_to span{font-weight: 300!important}
		.chat_user_list span.icons.fl_letters{margin-top: 5px!important}
		
		.conversation_list {margin: 0; padding: 0;}
		.conversation_list li{ list-style: none; display: inline-block; }
		.conversation_list li a{color: #7a8dae ; font-weight: 400; padding: 0 20px 0 0; font-size: 13px;}
		.conversation_list li a.active{color: #09204f; font-weight: 500;}
		#webparentsearch .media_file {width: 250px;}
		.webchat .media_file {width: 150px;}
	</style>
	<div class="content" id="Webonly">
		
		<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
		<div class="page_header">
			<div class="row">
				<!--=============Headings & Tabs menu==============-->
				<div class="col-md-7">
					<h3 class="mt20"><img style="width:17px;"  src="/assets/images/chat_icon2.png"/> Chat</h3>
				</div>
			</div>
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
								<a  style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span style="" class="t_web_main allChatShow" id="toogleDivName">All</span><i class="icon-arrow-down22"></i></a>
								<ul style="right: 0px!important; margin-top: 25px; left: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown">
									<li><strong><a  class="active" href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon1.png"/> <b class="smallbr allChatShow">All (<?php echo $activeOnlyweb->count(); ?>)</b> </a></strong></li>
									<li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/><b class="unTab unassigned_show">Unassigned (<?php echo $unassignChat->count(); ?>) </b></a></strong></li>
									<li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/><b class="YouTab assigned_show_<?php echo $loggedYou; ?>">You (<?php echo $assignChat->count(); ?>) </b></a></strong></li>

									<li style="display: block;"><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/><b class="FavTab <?php echo $loggedYou; ?>">Favorites (<?php echo $Favorites_list->count(); ?>) </b></a></strong></li>

									
									
								</ul>
							</div>
							
							
							<div class="tdropdown ml0 pull-right">
								<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span class="f_web_main" id="filterTitle">Newest</span> <i class="icon-arrow-down22"></i></a>
								<ul style="margin-top: 25px; right: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
									<li class="f_new chatAction"><strong><a class="active" href="javascript:void(0)">Newest </a></strong></li>
									<li class="f_old chatAction"><strong><a href="javascript:void(0)">Oldest </a></strong></li>
									<!-- <li class="f_unassigned chatAction"><strong><a href="javascript:void(0)">Unassigned </a></strong></li> -->
								</ul>
								
								
								
							</div>
					
							<div class="clearfix"></div>
						</div>
						
						<!--++++++++SEARCH BOX++++++-->
						<div class="p20 btop bbot pt-15 pb-15">
							<div style=" width:100%;" class="chat_search_icon">
								<input style="width: calc(100% - 22px);"  
								id="MainsearchChatMsg" class="MainsearchChatMsg"  type="text"  name="adSearch" value="" placeholder="Search">
							
								
								<input type="hidden" name="afterTrigger" id="afterTrigger" value="">
								<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
							</div>


							

						</div>
						
						
						
						
						<div class="p20 bbot pt-15 pb-15">
						<!-- <p><span class="unassigned_show">Unassigned (<?php echo $unassignedChat; ?>) </span> &nbsp;&nbsp;&nbsp;&nbsp;
							<span class="assigned_show_<?php echo $loggedYou; ?>">You (<?php echo $assignedChat; ?>)</span></p> -->

                            
							
							<ul class="conversation_list">
								<li><a href="javascript:void(0)" class="showList smallbr allChatShow active">All (<?php echo $activeOnlyweb->count(); ?>)</a></li>
								<li><a href="javascript:void(0)" class="showList unTab unassigned_show">Unassigned (<?php echo $unassignChat->count(); ?>) </a></li>
								<li><a href="javascript:void(0)" class="showList YouTab assigned_show_<?php echo $loggedYou; ?>"> You (<?php echo $assignChat->count(); ?>) </a></li>
							</ul>
							
							
							
							
							<input type="hidden" name="allChatC" class="allChatC" value="<?php echo $activeOnlyweb->count(); ?>" />
							<input type="hidden" name="unassigned" class="unassigned_chat" value="<?php echo $unassignChat->count(); ?>">
							<input type="hidden" name="assigned" class="assigned_chat" id="assigned_chat_<?php echo $loggedYou; ?>" value="<?php echo $assignChat->count(); ?>">
							<?php //echo $loggedYou;
 ?>
							
								</div>
							
							
						<!--++++++++SEARCH BOX++++++-->

						
						
					</div>
				</div>
		
			<!--++++++++++++ Active chat list +++++++++++++++-->
			
			<div id="AjaxSearchWeb" style="height:635px; overflow: auto; display:none;background-color:#fff!important">
			</div>
			
			 <div id="InitalWeb">
				<div id="activeSearchlisting" class="panel-body p0 br5 mb10 chat_user_list activeChatlisting a_list" style="background-image:none;">
					 <div class="activeChatListBigchat"></div>
					 @include('admin/web_chat/activechat_list', array('activechatlist' => $activeOnlyweb))
				</div>
		        <!--++++++++++++ Active chat list +++++++++++++++-->
				
				
				<!--++++++++++++ oldest chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list o_list" style="background-image:none; display:none">
					@include('admin/web_chat/oldchat_list', array('oldchat_list' => $oldchat_list))
				</div>
			    <!--++++++++++++ oldest chat list +++++++++++++++-->
				
				<!--++++++++++++ wait chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list w_list" style="background-image:none; display:none">
					{{-- @include('admin/web_chat/wait_list', array('WaitingChatlist' => $WaitingChatlist)) --}}
				</div>
			    <!--++++++++++++ wait chat list +++++++++++++++-->

			    	<!--++++++++++++ unassigned chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list un_list" style="background-image:none; display:none">
					@include('admin/web_chat/unassign_list', array('unassignedchatlist' => $unassignedChatData))
				</div>
			    <!--++++++++++++ unassigned chat list +++++++++++++++-->

                    <!--++++++++++++ You chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list you_list" style="background-image:none; display:none">
					<?php //$this->load->view('admin/webchat/Youchat_list', array('Youchatlist' => $assignedChatData)); ?>
				</div>
			    <!--++++++++++++ You chat list +++++++++++++++-->
			    

			    <!--++++++++++++ favourite chat list +++++++++++++++-->
				<div class="panel-body p0 br5 mb10 chat_user_list f_list" style="background-image:none; display:none">
					@include('admin/web_chat/favourite_list', array('favchatlist' => $Favorites_list))
				</div>
			    <!--++++++++++++ favourite chat list +++++++++++++++-->

				<a href="javascript:void(0)" class="loadMoreActivity loadMoreRecordActivity blue_plus_increase" style="bottom:-6px; display: none;"><i class="icon-plus3 fsize11 txt_white"></i></a>
				<!-- chat list -->
				
				</div>
		
			</div>
			
			
			<div class="userChatData webContainer">
				
				@include('admin/web_chat/userchatdata', array('c_id'=>$isLoggedInTeam,'loginMember'=>$loginMember, 'shortcuts'=>$shortcuts))
			</div>
			
			
		</div>
		<!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
		
		
	</div>

<script>

$(document).ready(function() {
	$('#Webonly .c_link').html('Contacts(<?php echo $contactCount; ?>)');
	$('#Webonly #webContactBox').on("keyup", function() {
		var textInput = $( this ).val().toLowerCase();
		$( '#Webonly .searchInput' ).val(textInput);
		
		$("#Webonly .chatbox_new").filter(function() {
			$(this).toggle($(this).find('.txt_dark').text().toLowerCase().indexOf(textInput) > -1)
		});
		
		
	});

});
	
	$( document ).ready(function() {

		var site_url = "<?php echo base_url(); ?>";
		site_url = site_url.replace(/\/$/, '');
		var socket = io(site_url+':3000');
		var userId;
		var currentUser = "<?php echo $loginUserData->id; ?>";
		
		   $( ".WebBoxList" ).each(function( index ) {
			    
			    var userID = $( this ).attr( "userId" );
			    var aToken = Number(userID) + Number(currentUser);

				if(Number(userID) > Number(currentUser)){
					var sToken = Number(userID) - Number(currentUser);
				}
				else {
					var sToken = Number(currentUser) - Number(userID);
				}

				var newToken = aToken+'n'+sToken;

				socket.emit('subscribe',newToken);
			});


		
		
         socket.on('chat message main', function(data){
			
			var msg = data.msg;
			var msg_noti = data.msg;

			/*------ remove the loading message -----*/ 
			if(data.chatTo.length > 10) {
				$('.loading_message_big_li_'+data.chatTo).remove();
			} 
			else {
				$('.loading_message_big_li_'+data.currentUser).remove();
			}
			if(currentUser != data.currentUser) {
				$('#WebChatTextarea_'+data.currentUser).removeClass('typing_messsage');
			}
			/*---- end remove the loading message ---*/

			    var profileImg = '';
				if(data.avatar == '' || data.avatar === undefined){
				var fname = 'A';
				var lname = '';
				
				var SupportUsername  = data.currentUserName;
				
				var dataname = SupportUsername.split(" ");
				if(dataname[0] != '' && dataname[0] !== undefined){
				fname = dataname[0].charAt(0);
				}
				//console.log(dataname[1], 'last name');
				if(dataname[1] != '' && dataname[1] !== undefined){
				lname = dataname[1].charAt(0);
				}
				
				profileImg = `<span class="icons fl_letters s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:11px;">${fname}${lname}</span>`;
				}else{
				profileImg = `<span class="icons s32"><img src="${data.avatar}" onerror="this.src='<?php echo base_url(); ?>assets/images/default_avt.jpeg'" class="img-circle" alt="" width="24" height="24"></span>`;
				}
			
			if(isAnchor(msg_noti))
			{
				msg_noti = "Attachment";
			}
			
			var messageSmilies = msg.match(smileyReg) || [];
			
			for(var i=0; i<messageSmilies.length; i++) {
				var messageSmiley = messageSmilies[i],
				messageSmileyLower = messageSmiley.toLowerCase();
				if(smiliesMap[messageSmileyLower]) {
					msg = msg.replace(messageSmiley, "<img src='/assets/img-smile/"+smiliesMap[messageSmileyLower]+".gif' alt='smiley' />");
				}
			}
			
			var strTime = getTime();
			if(currentUser == data.chatTo)
			{
				var mUser = data.currentUser;
			}
			else {
				var mUser = data.chatTo;
			}
			
			if ( msg.trim().length != 0 ) {
				
				if(currentUser == data.currentUser) {
					var chatbox = data.chatTo;
					

					$( '#WebChatTextarea_'+chatbox ).append( `<li class="media reversed">
						<div class="media-body"> <span class="media-annotation user_icon">${profileImg}</span>
						<div class="media-content">${nl2br(msg)}</div>							
						</div>
					</li>`);

				if($('#WebChatTextarea_'+chatbox).hasClass('typing_messsage')) {

			 		$('#WebChatTextarea_'+chatbox).append( `<li class="media loading_message_big_li_${chatbox}" style="height: 43px;padding-top: 10px;"><img  src="<?php echo base_url(); ?>assets/images/messageloading.gif" style="height: 25px;"></li>`);
				 	
			 	}

					
				if(currentUser == data.chatTo)
				{
				var mUser = data.currentUser;
				}
				else {
				var mUser = data.chatTo;
				}

			setTimeout(function(){ 
				var msgHeightMain = document.getElementById("WebChatTextarea_"+mUser).scrollHeight;
				$( '#WebChatTextarea_'+mUser ).scrollTop(msgHeightMain);
			}, 1000);
					
					
	//console.log(msgHeightMain);
	}
	else {
	
	var options = {
	title: data.currentUserName,
	options: {
	body: msg_noti,
	icon: data.avatar,
	lang: 'en-US'
	}
	};
	
	var chatbox = data.currentUser;
	
	
	$('#WebChatTextarea_'+chatbox).append(`<li class="media team_user_${chatbox}"">
		<div class="media-body"> <span class="media-annotation user_icon">${profileImg}</span>
		<div class="media-content">${nl2br(msg)}</div>							
		</div>
	</li>`);

		if(currentUser == data.chatTo)
		{
		var mUser = data.currentUser;
		}
		else {
		var mUser = data.chatTo;
		}
		
		setTimeout(function(){ var msgHeightMain = document.getElementById("WebChatTextarea_"+mUser).scrollHeight;
		$( '#WebChatTextarea_'+mUser ).scrollTop(msgHeightMain);
		}, 3000);
	
	
	playSound();
	//$("#easyNotify").easyNotify(options);
	
	//var msgHeightMain = document.getElementById("msg_box_show_main_"+mUser).scrollHeight;
	//$( '#msg_box_show_main_'+mUser ).scrollTop(msgHeightMain);
	
	
	
	
	}
	}
	});
		
	 
		$(document).on('click', '.getChatDetails', function (event) {

			/*------ activityShow ------*/
			$('.getChatDetails').each(function(index){
				$(this).removeClass('activechat');
			});

			$(this).addClass('activechat');
		
			$('.msg_tab_sec').trigger('click');
		     var popupId = $(this).attr('userId');
			var popupToken = $(this).attr('RwebId');
			
			//showNoteslisting(userId);
			$('.hIdelater').show();
			$('#livesearchVal').val('');
			$('#livesearch').html('');
			$('.addtionalSearchDiv').hide();
		    loadMessageChat(popupId,popupToken);
			$('.bigwebassign').html('Assigned to: '+$(this).attr('assign_to'));
			setTimeout(function(){ searchMainSmsPrevMsg('',$('.MainsearchChatMsg').val()); }, 2000);
			
			
			if($(this).attr('wait') == 'yes')
			{
		        updatReadStatus(RwebId); 	
			}
			
		});

		$(document).on('click', '.chatAction', function() {
			$('.chatAction').each(function(i){
				$(this).children().children().removeClass('active');
			});
			$(this).children().children().addClass('active');
		});

		$(document).on('click', '.showList', function() {
			$('.conversation_list li').each(function(index) {
				$( this ).children().removeClass('active');
			});
			$(this).addClass('active');
		});
	
	
	 function updatReadStatus(RwebId)
  	{
                $.ajax({
					url: '<?php echo base_url('admin/Chat/setWebReadstatus'); ?>',
					type: "POST",
					data: {'RwebId' : RwebId},
					dataType: "html",
					success: function (data) {
				    $('.pr_'+RwebId).hide();
						},error: function(){
					}
				});
	  	
	}

	// this functions called on pageload 
	loadMessageChat('<?php echo $popupId; ?>','<?php echo $popupToken ; ?>');
	showNoteslisting('<?php echo $popupId; ?>','<?php echo $popupToken ; ?>');
	
	//  ######### Load Chat message ############ //
function loadMessageChat(userId,token,clickvalue=null)
	 {
		  $('#livesearchVal').val(clickvalue);
			 $('#livesearch').html('');
			 $('#livesearch').removeAttr("style");
		      $('.editModuleSubscriber_main_web').attr('data-modulesubscriberid','');
			$('.editModuleSubscriber_main_web').attr('moduleaccountid','');
		
			if(1)
			{
				
				$('.editModuleSubscriber_main_web').hide();
				
			}
			else
			{
				$('.editModuleSubscriber_main_web').show();
			}
		 
		 $('.WebChatTextarea').html('<div class="msg_push_web"></div>');
		   var currentUser = "<?php echo $loginMember; ?>";
		
			var userID = userId;
			var currentUserName = "<?php echo $aUInfo->firstname . ' ' . $aUInfo->lastname; ?>";
			
			var newToken = token;
		    socket.emit('subscribe',newToken);
			
			socket.emit('subscribe',newToken);
			$.ajax({
				url: '<?php echo base_url('admin/webchat/getUserinfo'); ?>',
				type: "POST",
				data: {'chatUserid':userID,'token':newToken,_token: '{{csrf_token()}}'},
				success: function (data) {
					//console.log(data);
					var obj = data;
					$('.forceunassign a').removeClass('active');
					$('.default').removeClass('active');
					//console.log(obj);
					var DynamicId = "bigweb_chat_"+obj[5].chatUserid;
					var DynamicId_shortcut = "bigweb_chat_shortcut_"+obj[5].chatUserid;
					$('#Webonly .bigweb_chat').attr('id',DynamicId);
					$('.bigweb_chat_shortcut').attr('id',DynamicId_shortcut);

					$('#Webonly .ajaxUserinfo .picprofile').html(obj[3].avatar);
					$('#Webonly .ajaxUserinfo .subs_name').html(obj[1].name);
					$('#Webonly .ajaxUserinfo .em').html(obj[0].email);
					$('#Webonly .ajaxUserinfo .ep').html(obj[2].phone);

					$(".support_name").val(obj[1].name);
					$(".support_email").val(obj[0].email);
					$(".support_phone").val(obj[2].phone);

					$('#Webonly #em_id').val(userID);
					$('#Webonly #em_token').val(newToken);
					$('#Webonly #em_current_user').val(currentUser);
					$('#Webonly #em_inc_id').val(obj[5].chatUserid);
					$('#Webonly #em_image').val(obj[4].avatar_url);
					$('#Webonly #userId_encode').val(obj[10].userId_encode);
					$('.WebChatTextarea').attr('id', 'WebChatTextarea_'+userID);
					$('.bigwebassign').attr('id', 'bigwebassign_'+userID);
					$('.initUnassigned').attr('id', 'bigwebassignInit_'+userID);

					$('#bigwebassign_'+userID).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;">Assigned to:&nbsp </span>'+obj[12].assign_to);
					if(obj[12].assign_to == null)
					{
                      $('#bigwebassignInit_'+userID).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;"></span>Unassigned');
                      $('.forceunassign a').addClass('active');
					}
					else
					{
					$('#bigwebassignInit_'+userID).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;"></span>'+obj[12].assign_to);
					 $(".team_active_"+obj[13].assign_team_member).addClass('active');
				     }


					var taglist = obj[11].taglist;
					//console.log(typeof taglist);
					if(jQuery.isEmptyObject(taglist)) {
						$('.count_tags').html('0 Tags');
						$('#tagBox').html('');
					}
					else
					{
					var taglistitem="";
					  for(var i=0;i<taglist.length;i++)
					  {
                             taglistitem += '<button id="Tag_but_'+taglist[i].tag_id+'"  class="btn btn-xs btn_white_table pr10">'+taglist[i].tag_name+' <span GrpId='+taglist[i].group_id+' tag_id='+taglist[i].tag_id+' review_id='+taglist[i].review_id+' class="rmtag">x</span></button>';

					  }
					  $('.count_tags').html(taglist.length+'Tags');
					  $('#tagBox').html(taglistitem);
					}
                      
					//$('.webContainer .city').html(obj[6].city);
					$('.webContainer .city').html('San-Franciso');
					//$('.webContainer .code').html('obj[7].code');
					$('.webContainer .code').html('USA');
					$('.webContainer .gender').html(obj[7].gender);
					
					
					if(obj[9].avfinder == null)
					{
					    $('#avatarFinder_main_web').val('1');
					}
					else
					{
					$('#avatarFinder_main_web').val('0');
					}
					
					
					
			     $.ajax({
				url: '<?php echo base_url('admin/webchat/getMessages'); ?>',
				type: "POST",
				data: {room:newToken, offset:'0',_token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
					
					if (data.status == 'ok') {
					var result = data.res;
						for(var inc = 0; inc < result.length; inc++) {
							var row = result[inc];
							var newUserTo = row.user_to;
							var newUserFrom = row.user_form;
							var newMessage = row.message;
							var created = row.created;
							var avatarImg = row.avatarImage;
							var notes_val = row.notes;
							//console.log(newMessage);
							var messageSmilies = newMessage.match(smileyReg) || [];
							//console.log(messageSmilies);
							for(var i=0; i<messageSmilies.length; i++) {
								var messageSmiley = messageSmilies[i],
								messageSmileyLower = messageSmiley.toLowerCase();
								if(smiliesMap[messageSmileyLower]) {
									newMessage = newMessage.replace(messageSmiley, "<img src='/assets/img-smile/"+smiliesMap[messageSmileyLower]+".gif' alt='smiley' />");
								}
							}
							
							
							var fileext = (/[.]/.exec(newMessage)) ? /[^.]+$/.exec(newMessage) : undefined;
							
							if(typeof fileext != 'undefined' && fileext !== null){
								
								if(fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') {
									newMessage = "<a href='"+newMessage+"' class='previewImage' target='_blank'><img src='"+newMessage+"' height='auto' width='100%' /></a>";
								}
								else if(fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
									newMessage = "<a href='"+newMessage+"' target='_blank'>Download '"+fileext[0].toUpperCase()+"' File</a>";
								}
								else if(fileext[0] == 'mp4') {
									newMessage = "<video class='media_file' controls><source src='"+newMessage+"' type='video/"+fileext[0]+"'></video>";
								}
							}
							
							
							if(newUserFrom == currentUser){
							$('<li class="media reversed"><div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>'+avatarImg+'</span><div class="media-content">' + nl2br(newMessage) + '</div></div></li>' ).insertAfter( '.msg_push_web' );

							}
							else {
							$('<li class="media team_user_'+newUserFrom+'"><div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>'+avatarImg+'</span><div class="media-content">' + nl2br(newMessage) + '</div></div></li>' ).insertAfter( '.msg_push_web' );
							}

							}
						
						//var msgHeight = document.getElementById("msg_box_show_main_"+userID).scrollHeight;
					//	$( "#msg_box_show_main_"+userID).scrollTop(msgHeight);
						
					}
				}
			});


			$.ajax({
				url: '<?php echo base_url('admin/webchat/readMessages'); ?>',
				type: "POST",
				data: {userID:userID, currentUser:currentUser, _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
					if (data.status == 'ok') {
						$('.read_status_'+userID).html('<i class="fa fa-circle txt_green fsize7"></i>');
						/*$('#read_status_'+userID).attr('readStatus','0');
						$('#read_status_fav_'+userID).attr('readStatus','0');
						$('#read_status_con_'+userID).attr('readStatus','0');
						$('#read_status_'+userID).html(' ');
						$('#read_status_fav_'+userID).html(' ');
						$('#read_status_con_'+userID).html(' ');*/
					}
				}
			});
		 
	 }
		
		
	});
	

		setTimeout(function(){ 
		var msgHeight = document.getElementById("WebChatTextarea_"+userID).scrollHeight;
		$( "#WebChatTextarea_"+userID).scrollTop(msgHeight);
		}, 1500);
					
		 
		 
}
	
//  ######### Load Chat message ############ //
	
	
	/*$('body').on('keyup', '#Webonly .messageContent', function(e){
			if (e.which == 13) {
				$("#Webonly .sendMsg").click();
			}
		});*/

	$(document).on('click', '#webChatButton', function() {
		var currentUser = "<?php echo $loginUserData->id; ?>";
		var currentUserName = "";
		var avatar = "<?php echo $loginUserData->avatar; ?>";
		if(avatar != ' '){
		avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $loginUserData->avatar; ?>";
		}
		else {
		avatar = "<?php echo base_url('admin_new/images/userp.png'); ?>";
		}

		var msg = $( '#messageContentBox' ).val();

		var teamId = '<?php echo $teamMemberId; ?>';
		var teamName = '<?php echo $teamMemberName; ?>';
		//var userImage = $('#Webonly #em_image').val();
		var chatTo = $('#Webonly #em_id').val();
		var currentUser = "<?php echo $loginUserData->id; ?>";
		var aToken = Number(chatTo) + Number(currentUser);
		if(Number(chatTo) > Number(currentUser)){
		var sToken = Number(chatTo) - Number(currentUser);
		}
		else {
		var sToken = Number(currentUser) - Number(chatTo);
		}
		
		var newToken = aToken+'n'+sToken;

		var msg = msg.trim();
		$('.messageContent').val('');	
		if(msg.length > 0 ){
		socket.emit('chat_message', {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, currentUserName:currentUserName, avatar:avatar });
		$(this).val('');
		$.ajax({
		url: '<?php echo base_url('admin/webchat/addChatMsg'); ?>',
		type: "POST",
		data: {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, _token: '{{csrf_token()}}'},
		dataType: "json",
		success: function (data) {
			if (data.status == 'ok') {

				if(data.hasAssign > 0) {
					var assignChat = $("#assigned_chat_"+data.teamId).val();
					var assCount = Number(assignChat) + 1;
					$("#assigned_chat_"+data.teamId).val(assCount);
					$(".assigned_show_"+data.teamId).html("You ("+ assCount +")");

					var unassigned_chat = $('.unassigned_chat').val();
					var unAssCount = Number(unassigned_chat) - 1;
					$('.unassigned_chat').val(unAssCount);
					//$('.unassigned_show').html("Unassigned ("+ unAssCount +")");

					socket.emit('unassign_chat_count', {room:newToken, unAssCount:"Unassigned ("+ unAssCount +")", countUnassign:unAssCount });
				}
				
			
				socket.emit('team_post_data', {room:newToken, chatTo:chatTo, currentUser:currentUser,teamName:data.isLoggedInTeam,msg:msg });

			
			}
			
			setTimeout(function(){ 
			var msgHeight = document.getElementById("WebChatTextarea_"+chatTo).scrollHeight;
			$( "#WebChatTextarea_"+chatTo).scrollTop(msgHeight);
			}, 500);
			
		}
		});
		}
		return false;
	});
	

	//  ######### send Chat message ############ //
	$( document ).on( 'keyup', '#Webonly .messageContent', function ( e ) {

		if(e.keyCode == 191)
		{
		  $.ajax({
			url: '<?php echo base_url('admin/smschat/shortcutListing'); ?>',
			type: "POST",
			data: { _token: '{{csrf_token()}}'},
			dataType: "html",
			success: function (data) {
				$('#shortcutBox').html(data);
				$('.chat_shortcuts').toggle();
				$('#Search_shortcut').focus();

			}
		});
	    }
	    else if(e.keyCode == 8)
	    {
           $('.chat_shortcuts').hide();
	    }
	    
		
		var currentUser = "<?php echo $loginUserData->id; ?>";
		var currentUserName = "";
		var avatar = "<?php echo $loginUserData->avatar; ?>";
		if(avatar != ' '){
		avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $loginUserData->avatar; ?>";
		}
		else {
		avatar = "<?php echo base_url('admin_new/images/userp.png'); ?>";
		}

		var chatTo = $('#Webonly #em_id').val();
		var currentUser = "<?php echo $loginUserData->id; ?>";
		var aToken = Number(chatTo) + Number(currentUser);
		if(Number(chatTo) > Number(currentUser)){
		var sToken = Number(chatTo) - Number(currentUser);
		}
		else {
		var sToken = Number(currentUser) - Number(chatTo);
		}
		
		var newToken = aToken+'n'+sToken;

		/* -------- loading message ----------- */
		var wait = '5000';

		socket.emit('wait_message_widget', {room:newToken,chatTo:chatTo, currentUser:currentUser, wait:wait});
		/*----------- end loading message -------------------*/

		if (e.keyCode == 13 && e.shiftKey) {
			var content = this.value;
			var caret = getCaret(this);
			this.value = content.substring(0,caret)+"\n"+content.substring(carent,content.length-1);
			e.stopPropagation();
		}
		else if ( e.keyCode == 13 ) {
	    $('.chat_shortcuts').hide();

		var msg = $( this ).val();
		 msg = msg.replace('/','');
		var teamId = '<?php echo $teamMemberId; ?>';
		var teamName = '<?php echo $teamMemberName; ?>';
		//var userImage = $('#Webonly #em_image').val();
		
		var msg = msg.trim();
		$('.messageContent').val('');	
		if(msg.length > 0 ){
		socket.emit('chat_message', {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, currentUserName:currentUserName, avatar:avatar });
		$(this).val('');
		$.ajax({
		url: '<?php echo base_url('admin/webchat/addChatMsg'); ?>',
		type: "POST",
		data: {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, _token: '{{csrf_token()}}'},
		dataType: "json",
		success: function (data) {
		if (data.status == 'ok') {

			if(data.hasAssign > 0) {
							var assignChat = $("#assigned_chat_"+data.teamId).val();
							var assCount = Number(assignChat) + 1;
							$("#assigned_chat_"+data.teamId).val(assCount);
							$(".assigned_show_"+data.teamId).html("You ("+ assCount +")");

							var unassigned_chat = $('.unassigned_chat').val();
							var unAssCount = Number(unassigned_chat) - 1;
							$('.unassigned_chat').val(unAssCount);
							//$('.unassigned_show').html("Unassigned ("+ unAssCount +")");

							socket.emit('unassign_chat_count', {room:newToken, unAssCount:"Unassigned ("+ unAssCount +")", countUnassign:unAssCount });
						}
						
					
						socket.emit('team_post_data', {room:newToken, chatTo:chatTo, currentUser:currentUser,teamName:data.isLoggedInTeam,msg:msg });

			
		}
			
			setTimeout(function(){ 
			var msgHeight = document.getElementById("WebChatTextarea_"+chatTo).scrollHeight;
			$( "#WebChatTextarea_"+chatTo).scrollTop(msgHeight);
			}, 500);
			
		}
		});
		}
		return false;
		}
	});
	

	
	
	//  ######### send sms ############ //
	
	$(document).on('click', '.favouriteUser', function(e) {
		e.stopPropagation();
		var userId = $(this).attr('userId');
		var status = 0;
		if($(this).hasClass('yellow')) {
			status = 0;
			$(this).removeClass('fa-star');
			$(this).addClass('fa-star-o');
			$(this).removeClass('yellow');
		}
		else {
			status = 1;
			$(this).removeClass('fa-star-o');
			$(this).addClass('fa-star');
			$(this).addClass('yellow');
		}
		$.ajax({
		url: '<?php echo base_url('admin/Chat/favouriteUser'); ?>',
		type: "POST",
		data: {userId:userId, status:status},
		dataType: "json",
			success: function (data) {
				if (data.status == 'ok') {

				}
			}
		});
	});


	$(document).on('change blur', '.uAddText', function(e) {
		//if(e.keyCode == 13){
			var em_id = $('#em_id').val();
			var em_token = $("#em_token").val();
			var getValue = e.target.value;
			var getName = e.target.name;
			$(this).hide();
			$(this).prev().show();



			var chatTo = em_id;
			var currentUser = "<?php echo $loginUserData->id; ?>";
			var aToken = Number(chatTo) + Number(currentUser);
			if(Number(chatTo) > Number(currentUser)){
			var sToken = Number(chatTo) - Number(currentUser);
			}
			else {
			var sToken = Number(currentUser) - Number(chatTo);
			}
			
			var newToken = aToken+'n'+sToken;

			socket.emit('change_support_name', {room:newToken, supportname:getValue });


			$.ajax({
				url: '<?php echo base_url('admin/webchat/updateSupportuser'); ?>',
				type: "POST",
				data: {getName:getName, getValue:getValue, em_id:em_id,_token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {

					if(data.status == 'ok'){

						if(getName == 'support_name') {
							$('#Webonly .ajaxUserinfo .subs_name').html(getValue);
							$('#Big_assign_message_'+em_id).prev().prev().html(getValue);
							var res = getValue.split(" ");
							var firstName = typeof res[0] != 'undefined' ?res[0].charAt(0):'';
							var lastname = typeof res[1] != 'undefined' ?res[1].charAt(0):'';
							var shortName = firstName+''+lastname;
							shortName = shortName.toUpperCase();
							$('.tk_'+em_token).find('.fl_letters').html(shortName);
							$('.profile_pic span.fl_letters').html(shortName);
							$('.team_user_'+em_id).find('.fl_letters').html(shortName);
							$('.tk_'+em_token).find('.slider-username').html(getValue);
							$('.tk_'+em_token).find('.slider-teamname').html(getValue);
						
						}
						else if(getName == 'support_email') {
							$('#Webonly .ajaxUserinfo .em').html(getValue);
						}
						else if(getName == 'support_phone') {
							$('#Webonly .ajaxUserinfo .ep').html(getValue);
						}
					}
				}

			});
		//}
		
	});

		
		$(document).on('click', '.rmtag', function() {
			 var grpid = $(this).attr('grpid');
			 var tag_id = $(this).attr('tag_id');
			 var review_id = $(this).attr('review_id');

			 $.ajax({
				url: '<?php echo base_url('admin/webchat/deleteTagFromWeb'); ?>',
				type: "POST",
				data: {grpid:grpid, tag_id:tag_id,review_id:review_id,_token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('#Tag_but_'+tag_id).hide();
						
					}
				}
			});


		});


	
	
	//  ######### media  file upload ############ //
	$(document).on('click', '#Webonly .smsFileAttechment', function() {
			$('#Webonly #mmsFile').attr('chatTo', $('#Webonly #em_id').val());
			$('#Webonly #mmsFile').trigger('click');
		});
	//  ######### media  file upload ############ //
	
		$(document).on('change', '#Webonly #mmsFile', function(e) {
			
			$('.overlaynew').show();
			const files = document.querySelector('[id=mmsFile]').files;
			var chatTo = $('#Webonly #em_id').val();
			var avatar = "<?php echo $loginUserData->avatar; ?>";
			if(avatar != ' '){
			avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $loginUserData->avatar; ?>";
			}
			else {
			avatar = "<?php echo base_url('admin_new/images/userp.png'); ?>";
			}
			var currentUser = '<?php echo $loginUserData->id; ?>';
			var currentUserName='';
			const formData = new FormData();
			
			var aToken = Number(chatTo) + Number(currentUser);
			if(Number(chatTo) > Number(currentUser)){
			var sToken = Number(chatTo) - Number(currentUser);
			}
			else {
			var sToken = Number(currentUser) - Number(chatTo);
			}

			var newToken = aToken+'n'+sToken;
			
			for (let i = 0; i < files.length; i++) {
				let file = files[i];
				formData.append('files[]', file);
			}

			formData.append('_token', '{{csrf_token()}}');
			
			fetch('<?php echo base_url("/dropzone/upload_s3_attachment/" . $loginUserData->id . "/webchat"); ?>', { 
				method: 'POST',
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
						
						if(fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') 
						{
							msg = "<a href='"+msg+"' class='previewImage' target='_blank'><img src='"+msg+"' height='58px' width='58px' /></a>";
						}
						else if(fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
							msg = "<a href='"+msg+"' target='_blank'>Download '"+fileext[0].toUpperCase()+"' File</a>";
						}
						else if(fileext[0] == 'mp4' || fileext[0] == 'webm' || fileext[0] == 'ogg') {
							msg = "<video class='media_file' controls><source src='"+msg+"' type='video/"+fileext[0]+"'></video>";
						}
						
						
						socket.emit('chat_message', {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, currentUserName:currentUserName, avatar:avatar });
						
						
						msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+filename;
						$.ajax({
							url: '<?php echo base_url('admin/webchat/addChatMsg'); ?>',
							type: "POST",
							data: {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, _token: '{{csrf_token()}}'},
							dataType: "json",
							success: function (data) {
								if (data.status == 'ok') {
									$('#ldBar_'+chatTo).hide();
								}
							}
						});
				
						
						$('.overlaynew').hide();
					}, 100);
					
							setTimeout(function(){ 
						var msgHeight = document.getElementById("WebChatTextarea_"+chatTo).scrollHeight;
					    $( "#WebChatTextarea_"+chatTo).scrollTop(msgHeight);
								}, 1000);
					
				}
				else {
					$('#ldBar_'+chatTo).hide();
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
			$('#Webonly').append('<input style="display:none;" id="mmsFile" type="file">');
			
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
	
	$(document).on("click", "#Webonly .smilieSmsIconMessage", function() {
		renderSmiliesChat();
	});
	
	
	function renderSmiliesChat() {
        
		var $smileyGrid = $("#Webonly .smiley_grid_smschat");
		
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
			$("#Webonly .smiley_hint_smschat").on("click", function() {
				
				var inputText = $('#Webonly .messageContent').val();
				$('#Webonly .messageContent').val(inputText.concat($(this).attr('smiley')));
				$("#Webonly .supported_smilies_smschat").toggleClass("hide");
				$('#Webonly .messageContent').focus();
				
			}).tooltip();
		}
		
		// toggle smiley container hide
		$("#Webonly .supported_smilies_smschat").toggleClass("hide");
	}
	
	 //  ######### smily code ############ //  
	
	 //  ######### Live Search ############ //  
	
		$( document ).on( 'click', '.ConversationsIcon', function () {
		$('.hIdelater').hide();
		$('#livesearchVal').val('');
	    $('#livesearch').html('');
		$('.addtionalSearchDiv').show();
		
	});
	
	
	function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
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
			document.getElementById("em_phone").value=str;
			$('.smsContainer #smsSearcharea').html('');
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
  xmlhttp.open("GET","<?php echo base_url('admin/smschat/livesearchWeb'); ?>?q="+str,true);
  xmlhttp.send();
}
	 //  ######### Live Search ############ //  
	


 //  ######### switch top menu  ############ //
		$(document).on('click', '#Webonly .c_link', function() {
		   $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
			
			$('#Webonly .a_list').hide();
			$('#Webonly .o_list').hide();
			$('#Webonly .w_list').hide();
			$('#Webonly .un_list').hide();
     		$('#Webonly .you_list').hide();
     		$('#Webonly .f_list').hide();
		    $('#Webonly .t_web_main').html('Contacts');
			
		});
	
	
	
	$(document).on('click', '#Webonly .smallbr', function() {
	      $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
			$('#Webonly .o_list').hide();
		    $('#Webonly .w_list').hide();
     		$('#Webonly .a_list').show();
     		$('#Webonly .un_list').hide();
     		$('#Webonly .you_list').hide();
     		$('#Webonly .f_list').hide();
     		$('.conversation_list li a').removeClass('active');
     		$('.conversation_list .allChatShow').addClass('active');
		$('#Webonly .t_web_main').html('All <?php echo $activeOnlyweb->count(); ?>');
			
		});
	
	   $(document).on('click', '#Webonly .f_new', function() {
	       $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
			$('#Webonly .o_list').hide();
		    $('#Webonly .w_list').hide();
     		$('#Webonly .a_list').show();
     		$('#Webonly .un_list').hide();
     		$('#Webonly .you_list').hide();
     		$('#Webonly .f_list').hide();
		    $('#Webonly .t_web_main').html('All');
		    $('.conversation_list li a').removeClass('active');
		    $('#Webonly .f_web_main').html('Newest');
	   
		   
			
		});
	     $(document).on('click', '#Webonly .f_old', function() {
		  $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
			$('#Webonly .o_list').show();
			$('#Webonly .w_list').hide();
     		$('#Webonly .a_list').hide();
     		$('#Webonly .un_list').hide();
     		$('#Webonly .you_list').hide();
     		$('#Webonly .f_list').hide();
     		$('.conversation_list li a').removeClass('active');
			$('#Webonly .f_web_main').html('Oldest'); 
			
			
		});
	    $(document).on('click', '#Webonly .f_wait', function() {
		 $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
		    $('#Webonly .w_list').show();
			$('#Webonly .o_list').hide();
     		$('#Webonly .a_list').hide();
     		$('#Webonly .un_list').hide();
     		$('#Webonly .you_list').hide();
     		$('#Webonly .f_list').hide();
			$('#Webonly .f_web_main').html('Waiting longest'); 
		
			
		});


		$(document).on('click', '#Webonly .FavTab', function() {
		 $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
		    $('#Webonly .w_list').hide();
			$('#Webonly .o_list').hide();
     		$('#Webonly .a_list').hide();
     		$('#Webonly .un_list').hide();
     		$('#Webonly .you_list').hide();
     		$('#Webonly .f_list').show();
			$('#Webonly .t_web_main').html('Favorites <?php echo $Favorites_list->count(); ?>');
		
			
		});



		$(document).on('click', '#Webonly .unTab', function() {

			$.ajax({
				url: '<?php echo base_url('admin/webchat/showUntabAjax'); ?>',
				data: {_token: '{{csrf_token()}}'},
				type: "POST",
				success: function (data) {
					$('.un_list').html(data); 
				}
			});

		    $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
		    $('#Webonly .w_list').hide();
			$('#Webonly .o_list').hide();
     		$('#Webonly .a_list').hide();
     		$('#Webonly .un_list').show();
     		$('#Webonly .you_list').hide();
     		$('#Webonly .f_list').hide();
     		$('.conversation_list li a').removeClass('active');
     		$('.conversation_list .unassigned_show').addClass('active');
			$('#Webonly .t_web_main').html('Unassigned (<?php echo $unassignChat->count(); ?>)');
		
			
		});

          $(document).on('click', '#Webonly .YouTab', function() {
          	$.ajax({
				url: '<?php echo base_url('admin/webchat/showYoutabAjax'); ?>',
				data: {_token: '{{csrf_token()}}'},
				type: "POST",
				success: function (data) {
					$('.you_list').html(data); 
				}
			});
            
		    $('#AjaxSearchWeb').hide();
			$('#InitalWeb').show();
		    $('#Webonly .w_list').hide();
			$('#Webonly .o_list').hide();
     		$('#Webonly .a_list').hide();
     		$('#Webonly .un_list').hide();
     		$('#Webonly .you_list').show();
     		$('#Webonly .f_list').hide();
     		$('.conversation_list li a').removeClass('active');
     		$('.conversation_list .YouTab').addClass('active');
			$('#Webonly .t_web_main').html('You (<?php echo $assignChat->count(); ?>)');
		
			
		});

	
	 //  ######### fav click ############ //  
			$('body').on('click','#Webonly .favouriteSMSUser',function(){
				var thisObj = $(this);
			var currentUser = "<?php echo $loginUserData->id; ?>";
			$.ajax({
				url: '<?php echo base_url('admin/smschat/addSMSFavourite'); ?>',
				type: "POST",
				data: {user_id:'', currentUser:currentUser},
				dataType: "json",
				success: function (data) {
					if (data.status == 'ok') {
						if(thisObj.children().hasClass('yellow') === true){
							thisObj.children().removeClass('yellow');
							ShowfavouritAjax();
							}else{
							thisObj.children().addClass('yellow');
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
	
	

});
	$(document).ready(function(){
	$(document).on("keyup",".MainsearchChatMsg", function() {
	$.ajax({
	url: '<?php echo base_url('admin/smschat/getSearchsubscriberByinput'); ?>',
	type: "POST",
	data: {searchVal:$('#MainsearchChatMsg').val()},
	success: function (data) {
	$('#InitalWeb').hide();
	$('#AjaxSearchWeb').show();
	$('#AjaxSearchWeb').html(data); 
	}
	});

	});
	});	
</script>

<script>
$(document).ready(function() {
  $(".autoTimeUpdate").timeago();
});
</script>


@endsection
