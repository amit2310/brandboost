<style>
	<?php
		if($widgetSettings->header_color_solid){
			$solidColor = $widgetSettings->header_solid_color;
			echo '.bbSolidColor{background: '.$solidColor.'!important;}';
			echo '.textSolidColor{color: '.$solidColor.'!important;}';
			$bgClassName = 'bbSolidColor';
			$textClassName = 'textSolidColor';
		}
		
		if($widgetSettings->header_color_custom){
			$gradientColor1 = $widgetSettings->header_custom_color1;
			$gradientColor2 = $widgetSettings->header_custom_color2;
			echo '.bbGradientColor{background-image: linear-gradient(45deg, '.$gradientColor1.' 1%, '.$gradientColor2.')!important;}';
			echo '.textSolidColor{color: '.$gradientColor2.'!important;}';
			$bgClassName = 'bbGradientColor';
			$textClassName = 'textSolidColor';
		}
	?>
</style>
<?php 
	$greatingMSG = $widgetSettings->messages; 
	$greatingMT = $widgetSettings->time; 
	$greatingMSGArray = unserialize($greatingMSG);
	$greatingMTArray = unserialize($greatingMT);
	
?>
<style>
	
	.bb-form-group.new{ padding: 25px 30px;}
	.bb-form-group  p{margin: 0 20px 15px; text-align: center; font-size: 14px!important; color: #09204f!important;line-height: 1.5;}
	.bb-form-group .form-control {
	width: 100%;
	padding: 6px 6px 6px 45px;
	margin: 0px 0 10px;
	box-sizing: border-box;
	border-radius: 5px;
	height: 52px;
	box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08);
	border: none; background: #fff;
	font-size: 14px; color: #5e729d!important;
	font-family: 'Inter UI'!important; font-weight: 300!important;
	}
	.bb-form-group .form-control.user{background: url(assets/images/icon_user.png) 20px 21px no-repeat #fff;}
	.bb-form-group .form-control.email{background: url(assets/images/icon_envalope_small.png) 20px 21px no-repeat #fff;}
	
	.bb-form-group textarea.form-control {
	font-family: 'Inter UI'!important;
	padding: 20px!important;
	height: 165px;
	resize: none;
	}
	.bb-form-group input[type=button] {
	width: 124px;
	height: 52px;
	box-shadow: 0 1px 1px 0 rgba(27, 147, 255, 0.2), 0 2px 4px 0 rgba(27, 147, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 0.1);
	background-color: #1b93ff;
	color: #fff!important;
	padding: 0;
	margin: 0!important;
	}

	span.icons.fl_letters {
	    display: inline-block!important;
	}
	.company_profile_sec .img_sec img {
	    vertical-align: bottom!important;
	    margin: 0 0!important;
	}

	span.icons.fl_letters {
	    width: 32px;
	    height: 32px;
	    box-shadow: none!important;
	    background: <?php echo $widgetSettings->header_solid_color.'!important'; ?>;
	    text-align: center;
	    text-transform: uppercase;
	    line-height: 32px;
	    color: #fff;
	    border-radius: 100px;
	    font-size: 12px;
	    font-weight: 500;
	    display: block;
	}
	.bbcw_main_box .media_file {width: 150px;}
	
	
</style>
<div class="msg_box" style="display:none;" id="bbchatpopup">
	<div style="display:none;">
		<span id="greattingMessageArray"><?php echo implode('||', $greatingMSGArray); ?></span>
		<span id="greattingMsgTimeArray"><?php echo implode('||', $greatingMTArray); ?></span>
		<span id="bbClientAvtarImg">https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $userDataDetail->avatar; ?></span>
		<input type="hidden" value="<?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>" id="bbcp_bg_color">
	</div>
	
	<div id="bb_msg_wrap" class="bbcw_main_box" style="display: none;">
		<div id="bb_msg_head" class="bb_msg_head <?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>">
			<div class="bb_img_icon">
				<img width="32" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $userDataDetail->avatar; ?>" onerror="this.src='<?php echo base_url('assets/images/userp.png'); ?>'"/>
			</div>
			<div class="bb_drop_icon">
				<a href="javascript:void(0);" class="bb_chat_close_btn"><i class="fa fa-chevron-down"></i></a></div>
				<span class="client_box">
				<p><?php echo $userDataDetail->firstname; ?> <?php echo $userDataDetail->lastname; ?></p>
				<p> <span>Typically replies in 15 min</span></p>
				</span>
				<span class="team_box" style="display: none;">
					<!-- Team member name -->
				</span>
				<p> <a style="cursor: pointer;" class="bb_chat_end">Start New Conversation</a></p>
		</div>
		
		<div class="msg_body" id="bb_msg_body">
			<div class="bb_msg_push"></div> 
		</div>
		
		<div class="msg_footer">
			<div id="bb_smiley_box" class="bb_smg_smiley <?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>" style="display:none;">
				<a href="javascript:void(0);" smiley-data=":)" class="bb_smiley_icon_value" id="bb_smiley_icon_value1"><img src="http://brandboost.io/assets/img-smile/1.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":(" class="bb_smiley_icon_value" id="bb_smiley_icon_value2"><img src="http://brandboost.io/assets/img-smile/2.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=";)" class="bb_smiley_icon_value" id="bb_smiley_icon_value3"><img src="http://brandboost.io/assets/img-smile/3.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":d" class="bb_smiley_icon_value" id="bb_smiley_icon_value4"><img src="http://brandboost.io/assets/img-smile/4.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=";;)" class="bb_smiley_icon_value" id="bb_smiley_icon_value5"><img src="http://brandboost.io/assets/img-smile/5.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":/" class="bb_smiley_icon_value" id="bb_smiley_icon_value6"><img src="http://brandboost.io/assets/img-smile/7.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":x" class="bb_smiley_icon_value" id="bb_smiley_icon_value7"><img src="http://brandboost.io/assets/img-smile/8.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":p" class="bb_smiley_icon_value" id="bb_smiley_icon_value8"><img src="http://brandboost.io/assets/img-smile/10.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":*" class="bb_smiley_icon_value" id="bb_smiley_icon_value9"><img src="http://brandboost.io/assets/img-smile/11.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":o" class="bb_smiley_icon_value" id="bb_smiley_icon_value10"><img src="http://brandboost.io/assets/img-smile/13.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":>" class="bb_smiley_icon_value" id="bb_smiley_icon_value11"><img src="http://brandboost.io/assets/img-smile/15.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":s" class="bb_smiley_icon_value" id="bb_smiley_icon_value12"><img src="http://brandboost.io/assets/img-smile/17.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":((" class="bb_smiley_icon_value" id="bb_smiley_icon_value13"><img src="http://brandboost.io/assets/img-smile/20.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":))" class="bb_smiley_icon_value" id="bb_smiley_icon_value14"><img src="http://brandboost.io/assets/img-smile/21.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":|" class="bb_smiley_icon_value" id="bb_smiley_icon_value15"><img src="http://brandboost.io/assets/img-smile/22.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":b" class="bb_smiley_icon_value" id="bb_smiley_icon_value16"><img src="http://brandboost.io/assets/img-smile/26.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":&" class="bb_smiley_icon_value" id="bb_smiley_icon_value17"><img src="http://brandboost.io/assets/img-smile/31.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":$" class="bb_smiley_icon_value" id="bb_smiley_icon_value18"><img src="http://brandboost.io/assets/img-smile/32.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":?" class="bb_smiley_icon_value" id="bb_smiley_icon_value19"><img src="http://brandboost.io/assets/img-smile/39.gif"/></a>	
				<a href="javascript:void(0);" smiley-data="#o" class="bb_smiley_icon_value" id="bb_smiley_icon_value20"><img src="http://brandboost.io/assets/img-smile/40.gif"/></a>	
				<a href="javascript:void(0);" smiley-data=":ss" class="bb_smiley_icon_value" id="bb_smiley_icon_value21"><img src="http://brandboost.io/assets/img-smile/42.gif"/></a>	
				<a href="javascript:void(0);" smiley-data="@)" class="bb_smiley_icon_value" id="bb_smiley_icon_value22"><img src="http://brandboost.io/assets/img-smile/43.gif"/></a>
				<a href="javascript:void(0);" smiley-data=":w" class="bb_smiley_icon_value" id="bb_smiley_icon_value23"><img src="http://brandboost.io/assets/img-smile/45.gif"/></a>
				<a href="javascript:void(0);" smiley-data=":c" class="bb_smiley_icon_value" id="bb_smiley_icon_value24"><img src="http://brandboost.io/assets/img-smile/101.gif"/></a>
				<a href="javascript:void(0);" smiley-data=":h" class="bb_smiley_icon_value" id="bb_smiley_icon_value25"><img src="http://brandboost.io/assets/img-smile/103.gif"/></a>
				<a href="javascript:void(0);" smiley-data=":t" class="bb_smiley_icon_value" id="bb_smiley_icon_value26"><img src="http://brandboost.io/assets/img-smile/104.gif"/></a>
				<a href="javascript:void(0);" smiley-data=":q" class="bb_smiley_icon_value" id="bb_smiley_icon_value27"><img src="http://brandboost.io/assets/img-smile/112.gif"/></a>	
			</div>
			<div id="bb_chat_loading" class="bb_chat_loading" style="display:none;" >
				<svg width="81px"  height="81px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-double-ring" style="background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%;"><circle cx="50" cy="50" ng-attr-r="" ng-attr-stroke-width="" ng-attr-stroke="" ng-attr-stroke-dasharray="" fill="none" stroke-linecap="round" r="35" stroke-width="8" stroke="#4460c4" stroke-dasharray="54.97787143782138 54.97787143782138"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle><circle cx="50" cy="50" ng-attr-r="" ng-attr-stroke-width="" ng-attr-stroke="" ng-attr-stroke-dasharray="" ng-attr-stroke-dashoffset="" fill="none" stroke-linecap="round" r="26" stroke-width="8" stroke="#b4c0f5" stroke-dasharray="40.840704496667314 40.840704496667314" stroke-dashoffset="40.840704496667314"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;-360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg>
			</div>
			<input style="display:none;" id="bb_attechment_file" class="bb_attechment_file" type="file">
			<input id="bb_user_id" value="<?php echo $userDataDetail->id; ?>" type="hidden">
			<input id="bb_client_id" value="<?php echo $widgetSettings->user_id; ?>" type="hidden">
			<input id="bb_contact_details_config" value="<?php echo $widgetSettings->contact_details_config; ?>" type="hidden">
			<input type="hidden" id="bb_client_name" name="bb_client_name" value="<?php echo $userDataDetail->firstname; ?> <?php echo $userDataDetail->lastname; ?>">
			<div class="msg_att">
				<?php if($widgetSettings->smilie_show == 1){ ?><a hrer="javascript:void(0);" class="bb_smiley_btn"><i class="fa fa-smile-o"></i></a><?php } ?>
				<?php if($widgetSettings->atttachment_show == 1){ ?><a hrer="javascript:void(0);" class="bb_attechment_btn"><i class="fa fa-paperclip"></i></a><?php } ?>
			</div>
			<input type="text" class="bb_chat_msg_input msg_input" id="bb_chat_msg_input" placeholder="Type a message..." />
		</div> 
	</div> 
	
	<div class="msg_box" id="bb_msg_wrap2" style="background-color: #f4f6fa; display: none;">
		<div class="bb_msg_head <?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>">
			<div class="bb_img_icon">
				<img width="32" src="<?php echo base_url('assets/images/userp.png'); ?>"/>
			</div>
			<div class="bb_drop_icon"><a href="#"><i class="fa fa-chevron-down"></i></a></div>
			<p><?php echo $userDataDetail->firstname; ?> <?php echo $userDataDetail->lastname; ?></p>
			<p><span>Typically replies in 15 min</span></p>
		</div>
		
		<!---- start chat with user name section ---->
		<div id="bb_msg_wrap_new" style="padding-top:10px;"> 
			<div class="bb-form-group new">
				<p>Please enter your details to start chat.</p>
				<div class="">
					<input name="bb_chat_username" id="bb_chat_username" class="form-control user" style="text-align:left;" value="" type="text" placeholder="Enter your name">
				</div>
				<div class="">
					<input name="bb_chat_email" id="bb_chat_email" class="form-control email" style="text-align:left;" value="" type="text" placeholder="Enter your email adress">
				</div>
				<div class="">
					<textarea class="form-control" name="bb_chat_message" id="bb_chat_message" placeholder="Your message"></textarea>
				</div>
				<div class="">
					<button style="width: auto;padding: 0 15px;color: #fff !important;" name="bb_un_submit_btn" id="bb_user_info_submit_btn" class="form-control bb_un_submit_btn <?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>">Start Chat </button>
				</div>
			</div>
		</div>
	</div>
	
	<!---- start chat with user name section ---->
	<div id="bb_msg_wrap1">
		<div class="chat_widget_bot_right bb_chatbox" style="display:<?php echo ($widgetSettings->allow_gift_message == 1 && $widgetSettings->gift_message != '') ? 'block' : 'none'; ?>">
			<div class="bb_white_box <?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>">
				<div class="image_icon">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $userDataDetail->avatar; ?>" onerror="this.src='<?php echo base_url('assets/images/userp.png'); ?>'" width="32">
				</div>
				<p style="color: #fff;"><?php echo $userDataDetail->firstname; ?> from Brandboost</p>
				<p style="color: #fff;">
				<span style="color: #fff; font-size: 13px;"><?php echo $widgetSettings->trigger_message; ?></span></p>
			</div>
			
			<div class="bb_white_box">
				<p><?php echo $userDataDetail->firstname; ?> from Brandboost</p>
				<p><span>💥 <?php echo $widgetSettings->gift_message; ?></span></p>
			</div>
			<div class="bb_white_box">
				<p><?php echo $userDataDetail->firstname; ?> <?php echo $userDataDetail->lastname; ?></p>
				<p><span>Hey Max! It looks like you've been chatting with a member of our team, that's awesome</span></p>
			</div>
			<div class="bb_msg_push"></div>
			<div class="bb_white_box_input">
				<input type="text" class="bb_chat_msg_input3 msg_input form-control" id="bb_chat_msg_input3" placeholder="Type a message..." />
			</div>
		</div>
		
		<!--  ********* main box ********* -->
		<div class="bbcw_main_box" style="display:<?php echo ($widgetSettings->allow_gift_message == 1 && $widgetSettings->gift_message != '') ? 'none' : 'block'; ?>"> 
			<div class="bb_msg_head big <?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>" id="bb_msg_head_big">
				<div class="bb_img_icon big" style="<?php echo $widgetSettings->logo_show < 1 ? 'display:none;' : ''; ?>">
					<img width="53" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $widgetSettings->chat_logo; ?>"/>
				</div>
				<p style="<?php echo $widgetSettings->title_show < 1 ? 'display:none;' : ''; ?> margin-bottom: 10px;"><?php echo $widgetSettings->company_title; ?></p>
				<p style="padding: 0px 40px; <?php echo $widgetSettings->subtitle_show < 1 ? 'display:none;' : ''; ?>"><span><?php echo $widgetSettings->company_description; ?></span></p>
				
				<div class="company_profile_sec">
					<div class="img_sec ">
						<?php foreach($teamsData as $teamData){
							//print_r($teamData);
							echo showUserAvtar($teamData->avatar, $teamData->firstname, $teamData->lastname, '40', '40', '16');
						 } ?>
					</div>
					<p style="margin-bottom: 10px;<?php echo $widgetSettings->title_show < 1 ? ' display:none;' : ''; ?>">Hi there! 👋<?php //echo $widgetSettings->title; ?></p>
					<p style="<?php echo $widgetSettings->subtitle_show < 1 ? 'display:none;' : ''; ?>"><span><?php echo $widgetSettings->trigger_message; ?></span></p>
				</div>
			</div>
			<div> 
				<div style="height: 220px; padding-top: 125px;" class="msg_body" id="bb_msg_body2">
					<!-- <div class="bb_msg_push"></div> -->
				</div>
				<div class="msg_footer">
					<input type="text" class="bb_chat_msg_input2 msg_input" id="bb_chat_msg_input2" placeholder="Type a message..." />
				</div> 
			</div>
			
			<!-- <div class="bb-form-group">
				<label class="control-label">Your Name</label>
				<div class="">
				<input name="bb_chat_username" id="bb_chat_username" class="form-control bb_chat_username" value="" type="text" required>
				</div>
				<div class="">
				<input name="bb_un_submit_btn" id="bb_un_submit_btn" class="form-control bb_un_submit_btn" value="Start Chat" type="button">
				</div>
			</div> -->
		</div> 
	</div> 
	
</div>


<audio id="bbcp_audio" src="<?php echo base_url(); ?>assets/images/button-09.mp3" autostart="false" ></audio>


<div class="bb_chat_action_icon_white  <?php if($widgetSettings->header_color_fix == 1){ echo $widgetSettings->header_color.'_bbcpw_header'; }?> <?php if($widgetSettings->header_color_custom == 1){ echo $bgClassName; }?> <?php if($widgetSettings->header_color_solid == 1){ echo $bgClassName; }?>">
	<div class="bb_iconbox bbshowchatpopup">
		<a href="javascript:void(0);" class="bb_close_btn" id="bbclosebtn" style="display:none; color:#FFF; font-size:18px;">X</a>
		<a href="javascript:void(0);" class="bb_open_btn" id="bbopenbtn"><img style="width:20px; margin-top: <?php echo $widgetSettings->chat_icon < 3 ? '23px' : '17px'; ?>;" src="<?php echo base_url(); ?>assets/images/chat_design_icon<?php echo $widgetSettings->chat_icon == '' ? '1' : $widgetSettings->chat_icon; ?>.png"></a>	
		<div class="badge chat badge-danger" id="bb_chat_unread_counter" style="display:none;">0</div>
	</div>
</div>	


<!-- The Modal -->
<div id="bb_chat_modal" class="bb_chat_modal" style="display:none;">
	<!-- Modal content -->
	<div class="bb_chat_modal-content">
		<span class="bb_chat_close">&times;</span>
		<div id="bb_preview_image"></div>
	</div>	
</div>