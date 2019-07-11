<style>
	@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	@import url('http://brandboost.io/new_pages/assets/css/fonts/inter-ui.css');
	
	html,  body {
	height: 100%;
	background: #d5e0f2;
	margin: 0;
	padding: 0;
	}
	.msg_box {
	position: fixed;
	bottom: 100px;
	width: 340px;
	right: 40px;
	background: white;
	z-index: 999999;
	border-radius: 10px;
	font-size: 14px;
	box-sizing: border-box;
	min-height: 560px;
	font-family: 'Inter UI';
	font-weight: 400;
	box-shadow: 0 3px 2px 0 rgba(0, 3, 49, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.03), 0 10px 20px 0 rgba(0, 0, 54, 0.03);
	
	}
	.bb_msg_head {
	color: #fff;
	padding: 19px 19px 19px 80px;
	border-radius: 10px 10px 0px 0px;
	position: relative;
	font-size: 13px;
	width: 100%;
	box-sizing: border-box;
	box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.13);
	background-image: linear-gradient(103deg, #5c37f2, #aa7bff);
	height: 80px;
	}
	.bb_msg_head.big{ height: 280px; text-align: center; padding:45px 28px}
	.bb_msg_head p {
	font-weight: 500;
	font-size: 16px;
	line-height: 20px;
	margin: 0;
	}
	.bb_msg_head p span {
	font-size: 13px;
	font-weight: 400;
	}
	.bb_drop_icon {
	position: absolute;
	top: 30px;
	right: 23px;
	width: 15px;
	height: 15px;
	}
	.bb_drop_icon a{color: #fff; opacity: 0.5}
	
	.bb_img_icon {
	position: absolute;
	top: 20px;
	left: 23px;
	width: 38px;
	height: 38px;
	}
	
	
	
	.bb_img_icon img {
	border-radius: 100px;
	width: 36px;
	height: 36px;
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.17);
	border: 2px solid #fff;
	}
	.bb_img_icon.big{ width: 53px; height: 53px; top: -26px; left: 50%; margin-left: -26px;}
	.bb_img_icon.big img {
	border-radius: 100px;
	width: 53px;
	height: 53px;
	box-shadow: 0 5px 4px 0 rgba(0, 5, 76, 0.04), 0 5px 10px 0 rgba(12, 12, 44, 0.02);
	border: 0px solid #fff;
	}
	
	
	img.headimgsmall {
	position: absolute;
	top: 9px;
	left: 15px;
	width: 26px;
	height: 26px;
	border-radius: 50%;
	}
	span.phonenumber {
	font-size: 10px;
	color: rgba(255, 255, 255, 0.8)!important
	}
	.msg_body {
	width: 100%;
	box-sizing: border-box;
	height: 420px;
	padding: 28px;
	overflow-y: hidden;
	overflow-x: hidden;
	background-color: #f3f3fa;
	}
	.msg_body:hover {
	overflow-y: auto
	}
	.msg_footer {
	padding: 5px 10px;
	box-sizing: border-box;
	position: relative;
	border-radius: 0 0 10px 10px;
	height: 60px;
	box-shadow: 0 -1px 4px 0 rgba(12, 12, 44, 0.03);
	}
	
	.bb_smg_smiley{position: absolute; color: #fff;  width: 90%; padding: 15px; bottom: 55px; left: 5%; box-sizing: border-box; background-image: linear-gradient(103deg, #5c37f2, #aa7bff);  border-radius: 10px; display: none;}
	.bb_smg_smiley a{display: inline-block; width: 24px; height: 28px;}
	.bb_smg_smiley a img{width: 20px; height: 20px;}
	
	
	
	
	.msg_att {
	position: absolute;
	top: 17px;
	right: 8px;
	width: 50px;
	height: 30px;
	}
	.msg_att a {
	display: inline-block;
	color: #d2d2e8;
	font-size: 15px;
	margin: 5px 7px 0 0;
	}
	.msg_att a i.icon-attachment {
	font-size: 14px!important;
	}
	.msg_att a:hover {
	color: #42a5f5
	}
	.msg_input {
	width: 100%;
	height: 46px;
	border: none;
	box-sizing: border-box;
	border-radius: 0px;
	padding: 6px 50px 6px 10px;
	font-size: 12px;
	background: none;
	font-size: 14px;
	resize: none;
	font-family: 'Inter UI';
	}
	.close {
	float: right;
	cursor: pointer;
	margin-top: -25px;
	}
	.minimize {
	float: right;
	cursor: pointer;
	padding-right: 5px;
	}
	.bb_msg_push, .bb_msg {
	float: left;
	width: 100%;
	}
	.msg-left {
	position: relative;
	background: #ffffff;
	padding: 10px 15px;
	min-height: 10px;
	margin-bottom: 5px;
	margin-right: 0px;
	margin-bottom: 15px;
	border-radius: 10px 0px 10px 10px;
	word-break: break-all;
	margin-left: 0px;
	font-size: 14px;
	float: right;
	line-height: 17px;
	color: #22375e;
	line-height: 21px;
	box-shadow: 0 2px 1px 0 rgba(0, 5, 76, 0.03);
	max-width: 75%;
	}
	.msg-right {
	padding: 10px 15px;
	min-height: 15px;
	margin-bottom: 15px;
	position: relative;
	margin-right: 0px;
	border-radius: 0 10px 10px 10px;
	word-break: break-all;
	font-size: 12px;
	color: #fff!important;
	box-shadow: 0 1px 0 0 rgba(94, 57, 242, 0.13);
    background-image: linear-gradient(68deg, #5c37f2, #734bf6);
	font-size: 14px;
	float: left;
	line-height: 21px;
	max-width: 75%;
	}
	.msg_time {
	display: none;
	}
	.msg_push {
	background: #fff;
	padding: 10px;
	margin-bottom: 15px;
	margin-right: 15px;
	border-radius: 10px 0 10px 10px;
	font-size: 12px;
	border: solid 1px #eaedf3;
	color: #22375e;
	}
	.bb-form-group {
	padding: 30px;
	}
	.bb-form-group input {
	width: 100%;
	padding: 6px;
	margin: 10px 0;
	border: 1px solid #e7edf8;
	box-sizing: border-box;
	border-radius: 5px;
	height: 40px;
	text-align: center;
	}
	.bb-form-group input[type=button] {
	background-image: linear-gradient(61deg, #6a88f2, #3d59bc 99%)!important;
	border: 1px solid #5370d6;
	color: #fff;
	padding: 0;
	}
	.bb_chat_action_icon_white {
	width: 52px;
	height: 52px;
	position:absolute;
	box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03);
	border-radius: 100px;
	background: #8158f8;
	text-align: center;
	line-height: 52px;
	bottom: -80px;
	right: 0px;
	font-family: 'Inter UI';
	
	}
	.bb_chat_action_icon_white:before {
	position: absolute;
	content: '';
	width: 26px;
	height: 26px;
	top: 0;
	right: 0;
	background: #8158f8;
	z-index: 0;
	}
	.bb_iconbox {
	z-index: 1;
	position: relative;
	}
	.bb_iconbox a {
	color: #768fbf;
	font-size: 15px;
	text-decoration: none;
	font-weight: bold;
	}
	.bb_chat_action_icon_white .badge.chat {
	position: absolute;
	top: -1px;
	left: -3px;
	width: 15px;
	height: 15px;
	line-height: 14px;
	font-weight: 200!important;
	font-size: 10px;
	background-color: rgba(237, 72, 96, 0.9);
	color: #fff;
	border-radius: 100px;
	}
	.bb_cboth {
	clear: both;
	}
	
	
	.company_profile_sec{
	width: 100%;
	min-height: 208px;
	border-radius: 5px;
	box-shadow: 0 5px 4px 0 rgba(0, 5, 76, 0.02), 0 5px 10px 0 rgba(12, 12, 44, 0.03);
	background-color: #fff; margin-top: 40px; padding: 30px; color: #202040; box-sizing: border-box}
	.company_profile_sec p span{font-size: 14px;}
	.company_profile_sec .img_sec{margin-bottom: 15px;}
	.company_profile_sec .img_sec img {
	border-radius: 100px;
	width: 36px;
	height: 36px;
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.17);
	border: 2px solid #fff; margin: 0 -5px;
	}
</style>

<body>
	<!--=========================================Caht Widget 1=============================================-->
	<div class="msg_box"  id="bbchatpopup">
		<div class="bb_msg_head">
			<div class="bb_img_icon">
				<img width="32" src="http://brandboost.io/new_pages/assets/images/face3.jpg"/>
			</div>
			<div class="bb_drop_icon"><a href="#"><i class="fa fa-chevron-down"></i></a></div>
			<p>Garrett Glover</p>
			<p><span>Typically replies in 15 min</span></p>
		</div>
		<div id="bb_msg_wrap"> 
			<div class="msg_body" id="bb_msg_body">
				<div class="bb_msg_push"></div> 
			</div>
			<div class="msg_footer">
				<div id="bb_smiley_box" class="bb_smg_smiley" style="display:none;">
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
					<svg width="81px"  height="81px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-double-ring" style="background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%;"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke-width="{{config.width}}" ng-attr-stroke="{{config.c1}}" ng-attr-stroke-dasharray="{{config.dasharray}}" fill="none" stroke-linecap="round" r="35" stroke-width="8" stroke="#4460c4" stroke-dasharray="54.97787143782138 54.97787143782138"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius2}}" ng-attr-stroke-width="{{config.width}}" ng-attr-stroke="{{config.c2}}" ng-attr-stroke-dasharray="{{config.dasharray2}}" ng-attr-stroke-dashoffset="{{config.dashoffset2}}" fill="none" stroke-linecap="round" r="26" stroke-width="8" stroke="#b4c0f5" stroke-dasharray="40.840704496667314 40.840704496667314" stroke-dashoffset="40.840704496667314"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;-360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg>
				</div>
				
				<input style="display:none;" id="bb_attechment_file" class="bb_attechment_file" type="file">
				<div class="msg_att">
					<?php if($widgetSettings->smilie_show == 1){ ?><a hrer="javascript:void(0);" class="bb_smiley_btn"><i class="fa fa-smile-o"></i></a><?php } ?>
					<?php if($widgetSettings->atttachment_show == 1){ ?><a hrer="javascript:void(0);" class="bb_attechment_btn"><i class="fa fa-paperclip"></i></a><?php } ?>
				</div>
				<input type="text" class="bb_chat_msg_input msg_input" id="bb_chat_msg_input" placeholder="Type a message..." />
			</div> 
		</div> 
		
		<!---- start chat with user name section ---->
		<div id="bb_msg_wrap1" style="display: none;"> 
			<div class="bb-form-group">
				<label class="control-label">Your Name</label>
				<div class="">
					<input name="bb_chat_username" id="bb_chat_username" class="form-control" value="" type="text" required>
				</div>
				<div class="">
					<input name="bb_un_submit_btn" id="bb_un_submit_btn" class="form-control bb_un_submit_btn" value="Start Chat" type="button">
				</div>
			</div>
		</div> 	
		
		<audio id="audio" src="https://www.soundjay.com/button/sounds/button-09.mp3" autostart="false" ></audio>
		<div class="bb_chat_action_icon_white">
			<div class="bb_iconbox bbshowchatpopup">
				<a href="javascript:void(0);" class="bb_close_btn" id="bbclosebtn" style="display:none;">X</a>
				<a href="javascript:void(0);" class="bb_open_btn" id="bbopenbtn"><img src="http://brandboost.io/new_pages/assets/images/widget_smiley_purple.png" style="margin-top:20px;"></a>
			</div>
			<div class="badge chat badge-danger" id="bb_chat_unread_counter" style="display:none;">0</div>
		</div>
	</div>	
			
</body>