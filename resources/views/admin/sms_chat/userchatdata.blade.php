<style>
    #CustomDiv2 {
	scroll-behavior: smooth;
	}
	.daterangepicker.dropdown-menu {
    padding: 0px !important;
    border: none !important;
	z-index:0!important;
	} 
	.ranges {
    background: none;
    position: relative;
    border: none;
    border-radius: 3px;
    width: 200px;
    margin-top: 7px;
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin: 0 !important;
	}
	.ranges ul li.active {
    color: #fff!important;
    background-color: #5a99f6!important;
	}
	.addSubscriberNotes{background-image: linear-gradient(to bottom, rgba(255, 203, 101, 0.12), rgba(255, 255, 255, 0))!important; border-top: 1px solid #fcdcb2!important;}
	.addSubscriberNotes a#Addnotes{color: #f39c4c!important}
	.addSubscriberNotes button#notes_but{background: #f9b550!important; color: #fff!important; border-color: #f9b550!important}
	.mainchatsvroll2{min-height: 485px!important}
	#livesearch{width: 250px; background: #fff; z-index: 99;  margin-top: 5px; border-radius: 5px; position: relative; padding: 0px; }
	#livesearch ul{margin: 0; padding:10px;box-shadow: 0 3px 5px 0 rgba(1, 21, 64, 0.6);border-radius: 5px; position: relative;border: 1px solid #f4f6fa!important; }
    .msg_push { background:none!important}
	#livesearch ul li{list-style: none; margin:5px 0; padding: 0; font-size: 13px;}
	
	.userAdd {
		color: blue;
		padding: 5px 5px;
		margin-left: 0px;

	}
	.userAdd:hover {
		background-color: yellow;
		border: 1px solid;
		border-radius: 5px;
		padding: 5px 5px;
		margin-left: 10px;
	}
	

	
	
	.chat-list .media {	margin-left: 42px; margin-top: 5px!important}
	.chat-list .media .media-annotation.user_icon {	left: -42px;}
	.chat-list .media.reversed {margin-right: 42px; margin-top: 5px!important}
	.chat-list .media.reversed .media-annotation.user_icon {right: -38px;}
	.chat-list .media-content{padding: 9px 15px!important; font-size: 14px!important; font-weight: 300!important}
</style>
<div class="col-md-6 pl6 pr6">
	<div class="panel panel-flat mb0">
		<div class="panel-heading">
			
			<!--New Search-->
			<div style="width: 250px;float: left;margin: 5px 20px 0 0;display:none" class="chat_search_icon addtionalSearchDiv">
				<input style="width: calc(100% - 22px);"
				id="livesearchVal" onkeyup="showResult(this.value)" type="text" name="livesearchVal" value="" placeholder="Search">
				<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
                <div id="livesearch"></div>
			</div>
			<!--New Search-->
			
			
			<h6 class="panel-title hIdelater pull-left mr20"><a class="heading-elements-toggle"><i class="icon-more"></i></a> &nbsp; &nbsp;  <a style="cursor:pointer;"><img src="/assets/images/phone_green.png" class="" alt="" style="margin-top: 5px;" width="" height=""> SMS:</a> &nbsp; <span class="Dnumber"><?php echo mobileNoFormat($defaultNumber); ?> </span>  </h6>
			
		
			<div class="heading-elements" class="hIdelater">
				
                <div class="tdropdown">
					<a style="margin:0!important;" class="dropdown-toggle fsize13" data-toggle="dropdown" aria-expanded="false"><img width="16" src="/assets/images/user_img_blank.png"/> Unassigned <i class="icon-arrow-down22"></i></a>
					<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right chat_dropdown">
						<div class="form-group mb10 mr0 bbot">
							<div class="input-group review_source_search w100">
								<input type="text" class="form-control h40 pl0" placeholder="Search review sites...">
								<span class="input-group-addon pr0"><i class="fa fa-search txt_grey"></i></span>
							</div>
						</div>
						
						<li><strong><a class="active" href="#"><img src="/assets/images/user_img_blank.png"/> Unassigned</a></strong> </li>
						<li><strong><a href="#"><img src="/assets/images/user-06-a.png"/> Me</a></strong> </li>
						<li><strong><a href="#"><img src="/assets/images/user-05-a.png"/> Nia Gutkowski</a></strong> </li>
						<li><strong><a href="#"><img src="/assets/images/user-06-a.png"/> Jade Mohr</a></strong> </li>
						<li><strong><a href="#"><img src="/assets/images/v_user.jpg"/> Alexanne Stanton</a></strong> </li>
						<li><strong><a href="#"><img src="/assets/images/user-05-a.png"/> Chet Weimann</a></strong> </li>
						<li><strong><a href="#"><img src="/assets/images/user-05-a.png"/> Betsy Feeney</a></strong> </li>
						<li><strong><a href="#"><img src="/assets/images/v_user.jpg"/> Rosamond Mueller</a></strong> </li>
						
					</ul>
				</div>
				<!--bottom div-->
				
				
				<!--<div class="tdropdown ml10 mr10">
					
					<a style="margin:0!important;" class="dropdown-toggle fsize13 daterangeChat" data-toggle="dropdown" aria-expanded="false"><img width="14" src="/assets/images/icon_clock_dark.png"/> <i class="icon-arrow-down22"></i></a>
					
				</div>-->
				
				<div class="tdropdown ml10 mr10 open">
										<a style="margin:0!important;" class="dropdown-toggle fsize13" data-toggle="dropdown" aria-expanded="true"><img src="/assets/images/icon_clock_dark.png" width="14"> <i class="icon-arrow-down22"></i></a>
										<ul style="right: 0px!important; display: none;" class="dropdown-menu dropdown-menu-right chat_dropdown">
										  <li><strong>Later today</strong> <span class="text-right pull-right">in 3 hours</span></li>
										  <li><strong>Tomorrow</strong> <span class="text-right pull-right">Sat 8am</span></li>
										  <li><strong>Monday</strong> <span class="text-right pull-right">Mon 8am</span></li>
										  <li><strong>One week</strong> <span class="text-right pull-right">Fri 2pm</span></li>
										  <li><strong>One month</strong> <span class="text-right pull-right">Apr 8</span></li>
										  <li><strong>Custom</strong> <span class="text-right pull-right">in 3 hours</span></li>
										</ul>
									  </div>
				
				<a href="javascript:void(0)" class="icons s20" style="background: #e6f7ef"><i class="fa fa-check txt_green"></i></a>
			</div>
			
			
		</div>
      
      
       
       <!--&&&&&&&&&&&& TABBED START &&&&&&&&&&-->
		<div class="tab-content"> 	
		<!--===========TAB 1 WEB===========-->			  
			<div class="tab-pane active" id="massage_tab">			  
  			
			     <!-- SMS CHAT BOX -->
					<div class="panel-body p0 bkg_white minh_880 SecondDiv">
		
			
			<div class="p20 pr0 pt0 mainchatsvroll2" id="SmsContainer">
				
				
				<ul tWR="" class="media-list chat-list content-group messageThreadsBox smsChatTextarea " id="smsSearcharea"  style="display:block; padding-top:10px; height: 620px!important; max-height: 620px!important;">
                    <div class="msg_push"></div>
					
				</ul>

			</div>
			
			<!-- <div class="p20 pt0">
				<p class="fsize10 txt_grey txt_upper">Suggested:</p>
				<button class="btn suggested">How to import a teammate</button>
				<button class="btn suggested">Inviting a teammate</button>
				<button class="btn suggested">How can I add a teammate?</button>
			</div> -->
			
			<!-- SMS CHAT FOOTER BOX -->
			<div class="panel-footer p0 bkg_white no_shadow smschat_footer" >

			 <!-- CHAT SHORTCUTS -->
			   <div style="display: none;" class="chat_shortcuts bigsms_chat_shortcut">
                                	<div class="p10 pl20 pr20 bbot">
                                				<div class="short_search_icon pull-left"><input class="Search_shortcut"  id="Search_shortcut" type="text" name="" value="" placeholder="Search shortcut">
												 <button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
												</div>
                              	
                              				<div class="pull-right"><a style="cursor: pointer"  class="txt_blue fsize13 bigsms_chat_create">Create &nbsp; <img width="14" height="14" src="/assets/images/chat_plus_icon.png"></a>&nbsp;
                              				<a href="javascript:void(0)" class="short_icon"><img width="14" height="14" src="/assets/images/close_red_20.png"></a>
                              				</div>
                               	
                               		<div class="clearfix"></div>
                                	</div>
                                	<div class="p10 pl20 pr20" style="overflow: auto; height: 200px">
                                		<ul id="shortcutBox">
                                		
                                		</ul>
                                	</div>
                                </div>
              <!-- CHAT SHORTCUTS -->



				<div class="p20">
                    <input type="hidden" id="em_phone" value="">
                     <input type="hidden" id="em_id" value="">
                    <input type="hidden" id="em_sub_id" value="">
                    <input type="hidden" id="em_new_number" value="0">
					<textarea id="messageContentBox" class="form-control addnote mb0 messageContent" placeholder="Shift + Enter to add a new line ,  Start with ‘/’ to select a  Saved Message"></textarea>
			
					
				</div>
				
				<div class="p20 btop " style="padding: 12px 20px!important">
					<div class="pull-left ">
						
						<a class="mr20 txt_grey msg active common_msg"  href="#massage_tab" data-toggle="tab">Message</a>
						<a class="common_note" href="#Notes_tabs" data-toggle="tab">Note</a>
						
					</div>
					<div class="pull-right">
					 <a id="" class="mr-15 short_icon bigsms_chat" href="javascript:void();"><img src="/assets/images/chat_list_icon.png"/> </a>
						<input style="display:none;" id="mmsFile" type="file">
			
						<div class="panel panel-default smilie_emoji supported_smilies_smschat hide" style="position:absolute; top:-194px; left:2px; background:#F0F0F0;"><div class="panel-heading"><span><strong>Supported Smilies</strong></span></div><div class="panel-body smiley_grid_smschat"></div></div>
						
						<a class="mr-15 smilieSmsIconMessage" href="javascript:void(0)"><img src="/assets/images/chat_grey_smiley.png"/> </a>
						<a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_grey_image.png"/> </a>
						<a class="mr-15 smsFileAttechment" href="javascript:void(0)"><img src="/assets/images/chat_grey_attach.png"/> </a>
						<a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_gray_calendar.png"/> </a>
						
						<button id="sms_but" class="btn dark_btn btn-xs send_btn sendMsg">Send <img class="ml10" src="/assets/images/icon_send_arrow.png"></button>
						
					</div>
					<div class="clearfix"></div>
				</div>
				
			</div>
			<!-- SMS CHAT FOOTER BOX -->

			
		</div>
      			<!-- SMS CHAT BOX -->
        
                 
                 </div>
            
          <!--===========TAB 2 Notes===========-->	
             <div class="tab-pane" id="Notes_tabs">
            
					
					 <!-- Note BOX -->
					 @include('admin.sms_chat.notes_listing')
      			     <!-- Note BOX -->
        
			
			 </div>
           </div>
            <!--===========TAB 2 Notes===========-->	
       
        
	</div>
</div>
<div class="col-md-3 pl6 ajaxUserinfo">
	<div class="panel panel-flat" style="overflow:inherit">
		<div class="panel-heading">
			<h6 class="panel-title">Profile</h6>
			<div class="heading-elements">
				<a class="table_more" href="#"><img src="/assets/images/more.svg"></a>
			</div>
		</div>
		<div class="panel-body p0 bkg_white minh_880" >
			<div class="profile_sec pb10" style="min-height:785px;">
				
				<div class="p40 text-center">
					<div class="profile_pic">
					<span class="picprofile"></span>
						<?php //echo  showUserAvtar($userDataDetail->avatar, $userData->firstname, $userData->lastname,84,84,24); ?>
						<div class="profile_flags"><img src="/assets/images/flags/us.png"></div>
					</div>
					<h3 class="subs_name"><?php echo $userData->firstname; ?> <?php echo $userData->lastname; ?></h3>
					<p class="text-size-small text-muted mb0"><span class="city">San-Franciso</span>, <span class="code">USA</span></p>
				</div>
				
				
				
				<div class="profile_headings">Info <!--<a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a>--> <a href="javascript:void(0);" class="editModuleSubscriber_sms pull-right" data-modulesubscriberid="241" data-modulename="people" data-moduleaccountid="241" data-redirect="admin/lists/getListContacts?list_id="><i class="icon-pencil fsize10 txt_grey "></i></a></div>
				
				
				<!--<div class="profile_headings"> <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>-->
				
				
				
				<div class="interactions xss p20">
					<ul>
						<li><i class="fa fa-envelope"></i><strong class="em usremail"><?php echo $userData->email; ?></strong></li>
						<li><i class="fa fa-phone"></i><strong class="ep"><?php echo $userData->phone; ?></strong></li>
						<li><i class="fa fa-user"></i><strong class="gender">Male</strong></li>
						<li><i class="fa fa-clock-o"></i><strong>6AM, US/Estern</strong></li>
						<li><i class="fa fa-align-left"></i><strong>Opt-Out of All</strong></li>
					</ul>
				</div>
				
				
				<div class="profile_headings">Lists <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
				<div class="p20 pt15 pb0">
					
					
					<div class="tdropdown">
						<button style="margin:0 10px 15px 0!important;" class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown" aria-expanded="true"><i class="icon-plus3"></i></button>
						<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss shadow p10">
							<?php
								/*$newolists = array();
								
								foreach ($getMyLists as $key => $value) {
									$newolists[$value->id][] = $value;
								}
								*/

							?>
							<?php
								/*if (!empty($newolists)) {
									foreach ($newolists as $value) {
										?><button class="btn btn-xs btn_white_table"><?php echo $value[0]->list_name; ?></button><?php
									}
								}
								*/
								
							?>
							
							
						</ul>
					</div>
				</div>
				
				<div class="profile_headings">Segments <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
				<div class="p20 pt15 pb0">
					<button class="btn btn-xs btn_white_table">added review</button>
					<button class="btn btn-xs btn_white_table">Male 25+</button>
					<button class="btn btn-xs btn_white_table">Referral</button>
					<button class="btn btn-xs btn_white_table">Media</button>
					<div class="tdropdown">
						<button style="margin:0 10px 15px 0!important;" class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown" aria-expanded="true"><i class="icon-plus3"></i></button>
						<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss shadow p10">
							<button class="btn btn-xs btn_white_table pr10"> email</button>
							<button class="btn btn-xs btn_white_table pr10"> review</button>
							<button class="btn btn-xs btn_white_table pr10"> positive</button>
							<button class="btn btn-xs btn_white_table pr10"> negative</button>
							<button class="btn btn-xs btn_white_table pr10"> email</button>
							<button class="btn btn-xs btn_white_table pr10"> email</button>
							<button class="btn btn-xs btn_white_table pr10"> review</button>
							<button class="btn btn-xs btn_white_table pr10"> positive</button>
							
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<script>

	
	
	function set_shortcut(content)
    { 
         var prev_val = $('#SMSonly #messageContentBox').val();
         prev_val = prev_val.replace('/','');
          var new_val = prev_val.concat(" ").concat(content);
    	 $('#SMSonly #messageContentBox').val(new_val);
    	 $('#SMSonly .chat_shortcuts').hide();
    	 $('#SMSonly #messageContentBox').focus();

    }



$(document).ready(function() {

	$(document).on('click', '#SMSonly .short_icon', function(){
		$.ajax({
		url: '<?php echo base_url('admin/smschat/shortcutListing'); ?>',
		type: "POST",
		dataType: "html",
		success: function (data) {
			$('#shortcutBox').html(data);
			$('#SMSonly .chat_shortcuts').toggle();
		}
	});
				
})

$(document).on('click', '.bigsms_chat_create', function(){
		$('#addChatShortcutList').modal();
		var DynamicId = "bigsms_chat_"+$('#em_phone').val();
		var DynamicId_shortcut = "bigsms_chat_shortcut_"+$('#em_phone').val();

		$('#dvalue').val(DynamicId);
		$('#dvalue_shortcut').val(DynamicId_shortcut);

})
	
	$('#SMSonly #Search_shortcut').on("keyup", function() {
		var textInput = $( this ).val().toLowerCase();
		
		$("#SMSonly .shortcutlisting").filter(function() {
			$(this).toggle($(this).find('.shortcut_name').text().toLowerCase().indexOf(textInput) > -1)
		});
		
		
	});
	});


	
	// -------------------------
	
	
	
    
</script>