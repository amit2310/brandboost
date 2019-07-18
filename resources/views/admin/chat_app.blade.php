<style>
	
	
	html, body {
	height: 100%;
	}
	.addSubscriberNotes {
    background-image: linear-gradient(to bottom, rgba(255, 203, 101, 0.12), rgba(255, 255, 255, 0))!important;
    border-top: 1px solid #fcdcb2!important;
	}
	.msg_push { background:none!important}
	.modal-backdrop.in {
    opacity: 0.5;
    filter: alpha(opacity=50);
	}
	.chat-list .media-content .previewImage  img {width: 150px!important; height: auto!important; margin: 0px!important;}
	.chat-list .mrdia-file .previewImage img {width: 150px!important; height: auto!important; margin: 0px!important;}
	
	.msg_box {
	position: fixed;
	bottom: 30px;
	width: 310px;
	background: white;
	z-index: 999;
	border-radius: 5px;
	background-image: linear-gradient(217deg, #f7f8fb, #ffffff);
	/*box-shadow: 0 3px 2px 0 rgba(0, 50, 179, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.08), 0 12px 12px 0 rgba(1, 0, 27, 0.03);*/
	box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.20);
	
	}
	.msg_head {
	color: #172e5c;
	padding: 12px 13px;
	border-radius: 5px;
	position: relative;
	background:#fff;
	font-size: 14px;
	font-weight: 400!important;
	line-height: 18px!important;
	height: /*auto*/ 62px;
	border-bottom: 1px solid #f4f6fa;
	}
	img.headimgsmall {
	position: absolute;
	top: 22px;
	left: 25px;
	width: 26px;
	height: 26px;
	border-radius: 50%;
	}
	span.phonenumber {
	font-size: 10px;
	color: rgba(255, 255, 255, 0.8)!important
	}
	.msg_body {
	height: 372px;
	padding: 0px;
	overflow: hidden;
	overflow-x: hidden;
	width: 100%;
	background: #fff;
	}
	.msg_footer {
	padding: 10px 20px;
	box-sizing: border-box;
	position: relative;
	border-top: 1px solid #f4f6fa;
	border-radius: 0 0 5px 5px;
	height: 48px;
	background: #fff;
	}
	.msg_footer a{font-size: 12px; padding: 0 5px 0 0px; color: #5e729d; display: inline-block;}
	.msg_footer a.blue{color: #3680dc; position: relative}
	.msg_footer a.blue:after{position: absolute; top: -14px; width: 50px; height: 2px; background: #3680dc; left: 0; content: '';}
	
	.msg_footer a.yellow{color: #ffb758 ; position: relative}
	.msg_footer a.yellow:after{position: absolute; top: -14px; width: 30px; height: 2px; background: #ffb758 ; left: 0; content: '';}
	
	.msg_footer a.green{color: #3680dc}
	.msg_att {
	position: absolute;
	top: 10px;
	right: 20px;
	width: 50px;
	height: 30px;
	}
	.msg_att a {
	display: inline-block;
	color: #a7bbdf;
	font-size: 14px;
	margin: 5px 7px 0 0;
	}
	.msg_att a i.icon-attachment {
	font-size: 12px!important;
	}
	.msg_att a:hover {
	color: #42a5f5
	}
	.msg_input,.sms_msg_input,.msg_input_notes {
	width: 100%;
	height: 92px;
	border: none;
	box-sizing: border-box;
	border-radius: 0px;
	padding: 20px;
	font-size: 12px;
	background: none;
	font-size: 12px;
	font-weight: 300!important;
	resize: none;
	background: #fff;
	color: #7a8dae;
	}
	
	.sms_msg_input_notes {
	width: 100%;
	height: 92px;
	border: none;
	box-sizing: border-box;
	border-radius: 0px;
	padding: 20px;
	font-size: 12px;
	background: none;
	font-size: 12px;
	font-weight: 300!important;
	resize: none;
	color: #7a8dae;
	}
	.msg_input_add_notes {
	width: 100%;
	height: 92px;
	border: none;
	box-sizing: border-box;
	border-radius: 0px;
	padding: 20px;
	font-size: 12px;
	background: none;
	font-size: 12px;
	font-weight: 300!important;
	resize: none;
	color: #7a8dae;
	}
	.close {
	float: right;
	cursor: pointer;
	}
	.minimize {
	float: right;
	cursor: pointer;
	padding-right: 5px;
	}
	.msg-left {
	position: relative;
	background: #e2e2e2;
	padding: 5px;
	min-height: 10px;
	margin-bottom: 5px;
	margin-right: 10px;
	border-radius: 5px;
	word-break: break-all;
	}
	.msg-right {
	background: #ebeff6;
	padding: 9px 15px;
	min-height: 15px;
	margin-bottom: 5px;
	position: relative;
	margin-left: 25%;
	border-radius:6px;
	word-break: break-all;
	font-size: 12px;
	color: #253b6a!important;
	float: right;
	}
	.msg_push {
	background: #edf5ff;
	padding: 9px 15px;
	margin-bottom: 5px;
	margin-right: 25%;
	border-radius: 6px;
	font-size: 12px;
	border:none;
	color: #253b6a;
	float: left;
	}
	/**** Slider Layout Popup *********/
	
	#chat-sidebar {
	width: 288px;
	position:fixed;
	padding: 0px;
	background: #fff;
	z-index: 999!important;
	border-radius: 5px!important;
	box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.20);
	padding-bottom: 0px;
	max-height: 600px!important;
	margin-bottom: 0px;
	bottom: 30px;
	right: 30px;
	}
	.chat_sidebar_close {
	bottom: 30px!important;
	padding-bottom: 0px!important
	}
	#overlay_chat {
	position: fixed;
	width: 100%;
	height: 100%;
	background: rgba(0,0,0,0.2);
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	content: '';
	display: none;
	z-index: 99999
	}
	.sidebar_head {
	color: #172e5c;
	padding: 12px 25px;
	font-weight: 400;
	cursor: pointer;
	border-radius: 0;
	border-bottom: 1px solid #f4f6fa!important;
	background: #fff!important;
	border-radius: 5px!important;
	font-size: 14px;
	height: 53px;
	line-height: 27px;
	
	}
	.sidebar_head small {
	font-weight: 200!important;
	opacity: 0.8
	}
	#theImg img { width:18px!important; height:18px!important}
	.sidebar-user-box,.sms_user{
	padding: 17px 20px;
	margin-bottom: 0px;
	cursor: pointer;
	box-sizing: border-box;
	position: relative;
	border-bottom: 1px solid #f0f2f8!important;
	background: #fff;
	/*border-left: 2px solid #fff;*/
	}
	/*.sidebar-user-box:hover {
	border-left: 2px solid #5a99f6;
	}
	.sidebar-user-box.active {
	border-left: 2px solid #5a99f6;
	}
	.sidebar-user-box.sms_user:hover {
	border-left: 2px solid #4ebc86;
	}
	.sidebar-user-box.sms_user.active {
	border-left: 2px solid #4ebc86;
	}*/
	
	.sidebar-user-box.alphabet,.sms_user.alphabet,.sidebar-user-box-none.alphabet {
	background: #ecf2f6;
	padding: 7px 20px;
	}
	.sidebar-user-box:hover,.sms_user:hover,.sidebar-user-box-none:hover {
	background-color: #f8f8fb;
	}
	.sidebar-user-box:after,.sms_user:after,.sidebar-user-box-none:after {
	content: ".";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
	}
	.sidebar-user-box img,.sms_user img,.sidebar-user-box-none img {
	width: 28px;
	height: 28px;
	border-radius: 50%;
	float: left;
	margin-top: 0px;
	}
	.slider-username {
	float: left;
	line-height: 34px;
	margin-left: 2px;
	font-size: 12px;
	font-weight: 300;
	}
	.slider-phone {
	float: left;
	line-height: 34px;
	margin-left: 2px;
	font-size: 12px;
	font-weight: 300;
	}
	.sidebar_body {
	padding: 0;
	max-height: 100%;
	position: relative;
	}
	.user_status {
	float: right;
	color: #98adcf;
	font-size: 12px;
	line-height: 15px;
	font-weight: 400;
	margin-right: 5px;
	position: absolute;
	right: 17px;
	top: 17px;
	}
	.user_status .badge.bg-success {
	width: 19px;
	height: 15px;
	border-radius: 4px;
	background: #5a99f6;
	color: #fff;
	text-align: center;
	font-size: 10px;
	font-weight: 200!important;
	border: none!important;
	line-height: 14px;
	margin-top: 0px;
	}
	.user_status_chat {
	float: right;
	color: #fff;
	font-size: 10px;
	line-height: 15px;
	font-weight: 300!important;
	position: absolute;
	right: 20px;
	top: 34px;
	}
	.user_status .fa {
	color: #4ca93d;
	font-size: 5px;
	}
	.sidebar_footer {
	height: auto;
	padding: 10px;
	background: #fff;
	box-sizing: border-box;
	border-bottom: 1px solid #f5f4f5;
	margin-bottom: 10px;
	}
	
	.user_details {
	position: fixed;
	right: 340px;
	z-index: 99999;
	height: 596px;
	padding: 15px;
	width: 310px;
	box-shadow: /*0 3px 2px 0 rgba(0, 50, 179, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.08), 0 12px 12px 0 rgba(1, 0, 27, 0.03)*/ 0 2px 4px 0 rgba(1, 21, 64, 0.20);
	background:#ffffff;
	border-radius: 5px;
	bottom: 30px;
	display: none;
		
		
	}
	.user_details .header_sec{height: 53px; border-bottom: 1px solid #f4f6fa; padding: 12px 20px; line-height: 27px; font-size: 14px; color: #172e5c; background:#ffffff; border-radius: 5px 5px 0 0}
	.user_details .header_sec i{font-size: 12px; margin-right: 8px;}
	
	.user_details .interactions ul li {
	list-style: none;
	margin: 0;
	padding: 0;
	line-height: 29px;
	font-size: 12px!important;
	}
	.user_details .interactions ul li strong{font-size: 12px!important;}
	
	
	.user_details p {
	color: #313b50;
	font-size: 12px;
	font-weight: 300!important;
	margin: 0;
	line-height: 25px;
	}
	.user_details p strong {
	width: 60px;
	float: left;
	font-size: 12px;
	font-weight: 200!important;
	color: #6a7995;
	}
	.user_details .btn.btn_white_table {
	margin-right: 10px;
	}
	.footer_txt {
	padding-top: 15px;
	text-align: center;
	}
	.footer_txt a {
	color: #317edf;
	font-size: 12px;
	}
	.usdb {
	z-index: 99999;
	height: auto;
	padding: 15px;
	position: absolute;
	top: 53px;
	left: 0px;
	width: 310px!important;
	color: #fff!important;
	/*background-image: linear-gradient(215deg, #f7f8fb, #ffffff);*/
		background: #ffffff;
		border-top: 1px solid #eee!important;
	
	border-radius: 0px;
	display: none;
	box-shadow: 0 3px 2px 0 rgba(0, 50, 179, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.08), 0 12px 12px 0 rgba(1, 0, 27, 0.03);
	min-height: 512px;
	border-radius: 0 0 5px 5px;
		bottom: 0;
	}
	.usdb p {
	color: #313b50;
	font-size: 12px;
	font-weight: 300!important;
	margin: 0;
	line-height: 25px;
		float: left;
		width: 100%;
	}
	.usdb p strong {
	width: 60px;
	float: left;
	font-size: 12px;
	font-weight: 200!important;
	color: #6a7995;
	}
	.usdb .btn.btn_white_table {
	margin-right: 10px;
		margin-bottom: 7px;
	}
	.footer_txt {
	padding-top: 15px;
	text-align: center;
	}
	.footer_txt a {
	color: #317edf;
	font-size: 12px;
	}
	.userinfoopen {
	width: 18px;
	height: 15px;
	position: absolute;
	right: 85px;
	top: 11px;
	cursor: pointer;
	z-index: 99999;
	}
	.userinfoopen a {
	color: #b4c4dc;
	display: inline-block;
	margin: 0 3px;
	}
	.userinfoopen a i {
	font-size: 12px;
	opacity:1;
	}
	.userinfoopen a:hover i {
	opacity: 1;
	}
	.userinfoicon2 {
	position: absolute;
	right: 10px;
	color: #4288e4;
	z-index: 9999;
	}
	.user_details .sidebar_info {
	margin-bottom: 0px;
	}
	.user_details .sidebar_info.p20{padding: 15px!important}
	.user_details .sidebar_info img {
	width: 68px;
	height: 68px;
	float: none;
    box-shadow: 0 0.9px 0.9px 0 rgba(1, 21, 64, 0.08); background: #fff; border-radius: 100px; padding: 2px; margin-bottom: 5px;
	}
	.user_details .sidebar_info h3 {
	margin: 0!important;
	font-size: 16px;
	color: #001046;
	}
	.user_details .sidebar_info h6, .user_details .sidebar_info h6 strong {
	margin: 0px!important;
	font-size: 12px;
	color: #6d788f;
	font-weight: 200!important
	}
	
	.sidebar-user-box:hover .user_details {
	display: block;
	}
	
	.user_details:before {
	position: absolute;
	width: 8px;
	height: 8px;
	content: '\f0da';
	top: 10px;
	font-size: 19px;
	right: -8px;
	font-family: 'FontAwesome';
	color: #ccc;
	display: none!important
	}
	.green_check{position: absolute; right: 60px; top: 11px; height: 20px; width: 20px;}
	.grey_dots{position: absolute; right: 55px; top: 11px;  height: 20px; width: 20px;}
	
	
	.chat_add{position: absolute; right: 10px; top: 0px!important; padding-bottom:0px!important; }
	.chat_add .sms_user:hover { background:#fff!important}
	.chat_add .sms_user { border:none!important}
	
	.msg_head .close {
	float: right;
	cursor: pointer;
	color: #98adcf;
	opacity: 1;
	position: absolute;
	left: -40px;
	top: 10px;
	font-size: 16px;
	width: 32px;
	height: 32px;
	box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
	background: #fff; border-radius: 100px;
	text-align: center; line-height: 31px;
	}
	.closechatmain {
	float: right;
	cursor: pointer;
	color: #98adcf;
	opacity: 1;
	position: absolute;
	left: -40px;
	top: 10px;
	font-size: 16px;
	width: 32px;
	height: 32px;
	box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
	background: #fff; border-radius: 100px;
	text-align: center; line-height: 31px;
	}
	.addchatuser{
	cursor: pointer;
	color: #98adcf;
	opacity: 1;
	font-size: 16px;
	width: 28px;
    height: 28px;
	background: #fff; border-radius: 100px;
	text-align: center; line-height: 25px; display: inline-block; border: 1px solid #ddd; }
	
	
	
	.msg_wrap{position: relative}
	.msg_wrap .minimize {
	float: right;
	cursor: pointer;
	color: #98adcf;
	opacity: 1;
	position: absolute;
	left: -40px;
	top: 0px;
	font-size: 16px;
	width: 32px;
	height: 32px;
	box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
	background: #fff; border-radius: 100px;
	text-align: center; line-height: 31px;
	padding: 0;
	}
	
	.msg_head .minimise {
	float: right;
	cursor: pointer;
	color: #fff;
	opacity: 1;
	position: absolute;
	right: 30px;
	top: 0px;
	font-size: 24px;
	margin: 0;
	}
	.sidebar_body .nav-tabs {
	background: #f8f9fb!important;
	border-bottom: 1px solid #eee!important
	}
	.sidebar_body .nav> li {
	margin: 0 0 0 25px!important
	}
	.sidebar_body .nav> li> a {
	font-size: 12px;
	padding: 14px 0px 10px;
	color: #6a7995!important;
	border-bottom: 2px solid #f8f9fb!important
	}
	.sidebar_body .nav> li> a i {
	font-size: 10px;
	margin-right: 3px;
	margin-left: 0px;
	color: #9b9bb9!important
	}
	.sidebar_body .nav> li.active a {
	border-bottom: 2px solid #2f7ad6!important;
	color: #404b66;
	}
	.sidebar_body .nav> li.active a i {
	color: #2f7ad6!important
	}
	.sidechatstar {
	float: right;
	margin: 15px 0px 0;
	right: 60px;	/*display: none;*/
	font-size: 10px;
	}
	
	.contact_lists.contact .sidechatstar {
	right: 5px!important;
	}
	.text-muted.sidechatstar {
	color: #dce4f1!important
	}
	.text-muted.sidechatstar:hover {
	color: #5a99f6!important
	}
	.slider-username.contacts {
	line-height: 18px;
	display: block;
	margin-left: 38px;
	float: none;
	font-size: 12px;
	font-weight: 400!important;
	color: #09204f !important;
	}
	.slider-phone.contacts {
	line-height: 18px;
	display: block;
	margin-left: 38px;
	float: none;
	font-size: 12px!important;
	font-weight: 400!important;
	color: #6d788e;
	margin-top: 2px;
	}
	.slider-phone.contacts .fa {
	font-size: 5px!important;
	float: left;
	margin: 8px 4px 0 0
	}
	.slider-username.contacts.text-muted {
	color: #999!important;
	}
	.slider-phone.contacts.text-muted {
	color: #999!important;
	}
	.contact_lists_outer .slimScrollDiv {
	height: 365px!important;
	}
	.contact_lists {
	height: 365px!important;
	}
	.user_details hr {
	border-color: #f5f4f5 !important;
	margin: 5px 0 15px;
	}
	.chat_search {
	padding: 5px 20px;
	border-bottom: 1px solid #f0f2f8;
	}
	.chat_search .form-control {
	border: none;
	padding: 0px 0px;
	box-shadow: none!important;
	font-size: 12px;
	color: #9292b4!important
	}
	.chat_search .btn-icon {
	border: none!important;
	background: none;
	}
	.btn i.icon-search4 {
	font-size: 10px!important;
	color: #c4c4e1!important
	}
	
	.textaraebox{height: 92px; border-top: 1px solid #f4f6fa; background: #fff;}
	
	.minimize_chat{position: fixed; right: 30px; bottom: 30px; width: 285px; box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06); border-radius: 5px; background: #fff; padding: 15px 25px; font-size: 14px; cursor: pointer; color: #172e5c; z-index: 99999999999999;}
	
	.usertags_headings{border-top: 1px solid #f4f6fa; border-bottom: 1px solid #f4f6fa; padding: 8px 0; margin-bottom: 10px!important;}
	.user_tags .btn.btn-xs.btn_white_table{background: #f4f6fa!important; border: none!important; margin: 5px 10px 5px 0!important}
	.user_img_sec{padding: 15px 20px!important;}
	.user_img_sec figure{width: 28px; height: 28px; border-radius: 100px; display: inline-block; margin-right: 10px; position: relative; vertical-align: top;}
	.user_img_sec figure img{width: 28px; height: 28px; border-radius: 100px; vertical-align: top}
	.user_img_sec span.greendot {	width: 9px;	height: 9px;	border-radius: 10px;	background: #36c388;	position: absolute;	bottom: 0;	right: 0;	border: 2px solid #fff;}
	
	
	
	
	
	.chat-list .reversed .media-content:not([class*="bg-"]) {border-radius: 6px!important; border: none!important; background-color: #edf5ff!important; float:right;}
	.chat-list .reversed .media-content {text-align: left;	color: #253b6a!important; font-size:12px; font-weight:400;}
	.chat-list .reversed .media-content:before {display: none;}
	.chat-list .media-content:not([class*="bg-"]) {	background-color: #ebeff6;	border:none; border-radius: 6px!important;}
	.chat-list .media-content:before {display: none; }
	.chat-list .media-content{padding: 8px 8px!important; font-size: 12px; font-weight: 400!important; max-width: 500px; color:#253b6a!important; display:table!important}
	.chat-list .mrdia-file{ margin-top:5px; float:left;}
	.chat-list .mrdia-file img{ margin:0 15px 0 0; width:56px; height:56px; border-radius:5px; border:1px solid #f0f2f8 ;}
	.chat-list .reversed .mrdia-file{ float:right;}
	.chat-list .media{ margin-left:30px;}
	.chat-list .media.reversed{ margin-right:30px;}
	.chat-list .media .media-annotation.user_icon{ position:absolute; bottom:4px; left:-30px;}
	.chat-list .media.reversed .media-annotation.user_icon{ position:absolute; bottom:4px; right:-30px;}	
	.chat-list .text-muted{ color:#0c0c2c!important;}
	.chat-list .media-annotation{ color:#64658b!important;}
	.chat-list .media-content{ margin-bottom:4px!important}
	
	
	.chat-list.new {max-height: 352px !important;height: 352px !important;	margin: 0 !important; overflow: hidden; padding: 15px!important; }
	.chat-list.new:hover{overflow-y: auto;}
	.mainchatsvroll22 .slimScrollDiv{height: 372px!important;}
	
	
	.small_chat_box{width: 88px; box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);  background-color: #fff; border-radius: 6px; position:fixed; z-index: 99; bottom: 30px; right: 30px; box-sizing: border-box; }
	.small_chat_box .user_img_sec_small{padding: 20px 20px 10px 20px!important; box-sizing: border-box;}
	.small_chat_box .user_img_sec_small figure{width: 48px; height: 48px; border-radius: 100px; display: inline-block; margin-bottom:11px; position: relative; vertical-align: top;}
	.small_chat_box .user_img_sec_small figure img{width: 48px; height: 48px; border-radius: 100px; vertical-align: top}
	.small_chat_box .user_img_sec_small .user_FL{width: 48px; height: 48px; border-radius: 100px; margin-bottom: 11px; display: block; background: #9b83ff; color: #fff; text-align: center; line-height: 45px; font-size: 14px; text-transform: uppercase;}
	.small_chat_box .user_img_sec_small .user_FL.blue{background: #1b93ff;}	
	.small_chat_box .addchatuser.big{	cursor: pointer;	color: #98adcf;	opacity: 1;	font-size: 13px;	width: 48px;    height: 48px;	background: #fff; border-radius: 100px;	text-align: center; line-height: 45px; display: inline-block; border: 1px solid #b9c7de; margin-bottom: 11px;}
	
	
	.chat_search_icon {	position: relative;	height: 21px;	width: 100%;	border: none;}
	.chat_search_icon input[type="text"]{width: 222px; border: none; border:none; height: 20px; font-size: 11px; float: left; margin: 0px 0 0 0; padding: 0px;}
	.chat_search_icon button[type="submit"]{width: 20px;height: 20px; border: none; background: none; padding: 0px;}
	.chat_search_icon button[type="submit"] img{vertical-align: top!important}
	
	.chatSliderPrevBtn {
	position: absolute;
	color: red;
	z-index: 9999999999;
	bottom: 22px;
	right: 333px;
	}
	
	.prv_min {
	position: absolute;
	color: red;
	z-index: 9999999999;
	bottom: 8px!important;
	right: 287px;
	}
	
	.chatSliderNextBtn {
	position: absolute;
	color: red;
	z-index: 9999999999;
	bottom: 389px;
	right: 331px;
	}
	
	#prev_chat {
	background: #2f9eee;
	border-radius: 50%;
	display: block;
	width: 25px;
	height: 25px;
	text-align: center;
	line-height: 25px;
	color: #fff;
	}
	@media only screen and (max-width:767px) {
	.contact_lists_outer .slimScrollDiv {
	height: 400px!important;
	}
	.sidebar_body .nav-tabs > li {
	display: inline-block;
	font-size: 13px;
	}
	}
	.avatarImage .fl_letters { float:left;display:inline-block}
	.user_details .fl_letters { display:inline-block!important}
	.user_details .fl_letters_gray { display:inline-block!important}
	.chat-list span.icons.fl_letters { display:inline-block!important}
	
	.chat-list .media.reversed span.icons.s32 img.img-circle {
	width: 24px !important;
	height: 24px !important;
	}
	.avatarImage{float: left; margin-top: 6px;}
	.addSubscriberNotesUnique .createMessage.active:before{position: absolute; content: ''; width: 52px; height: 1px; background: #2f9eee; top: -11px; left: 10px;}
	.newsmsClass .createSmsMessage.active:before{position: absolute; content: ''; width: 52px; height: 1px; background: #2f9eee; top: -11px; left: 10px;}
	
	.addSubscriberNotes .createNotes.active:before, .createSmsNotes.active:before {position: absolute; content: ''; width: 30px; height: 1px; background: #efc288; top: -11px; left: 70px;}
	#livesearchSmall{width: 250px; background: #fff; z-index: 99;  margin-top: 5px; border-radius: 5px; position: relative; padding: 0px; }
	#livesearchSmall ul{margin: 0; padding:10px;box-shadow: 0 3px 5px 0 rgba(1, 21, 64, 0.6);border-radius: 5px; position: relative;border:none!important; }
    .msg_push { background:none!important}
	#livesearchSmall ul li{list-style: none; margin:5px 0; padding: 0; font-size: 13px;}
	
	.slider-phone.contacts span{font-weight: 300!important;}
	
	.fa.star_icon{color: #b4c4dc!important;font-size: 11px!important;}
	.fa.star_icon.yellow{color: #ffb94f !important}
	
	.smallchatnotes.chat-list .media.reversed{margin: 0px 0 40px!important}
	
	.webchat .media_file {width: 150px;}
	.Smschat .media_file {width: 150px;}
	
</style>
<!-- ********* Chat application start *********** -->

<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/js/dist-emoji/emojionearea.min.css') }}" media="screen">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/loading-bar.css') }}" media="screen">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifIt.css') }}" media="screen">
<script src="{{ URL::asset('node_modules/socket.io-client/dist/socket.io.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/dist-emoji/emojionearea.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/notifIt.js') }}"></script>
<audio id="audio" src="https://www.soundjay.com/button/sounds/button-09.mp3" autostart="false" ></audio>
<audio id="widget_audio" src="{{ URL::asset('assets/sound/chat_request.mp3') }}" autostart="false" ></audio>

<script type="text/javascript" src="{{ URL::asset('assets/js/loading-bar.js') }}"></script>
<script type='text/javascript' src="{{ URL::asset('assets/js/highlight.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/js/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/js/slick-theme.css') }}">
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.timeago.js') }}"></script>
<style type="text/css">
	.user_img_sec.slider{padding: 0!important}
	.user_img_sec.slider figure{float: left; display: inline-block; width: 28px!important; }
	.slider { width:200px!important; margin: 0px auto; }
	.slick-slide img { width: 100%;  }
	.slick-prev:before,.slick-next:before { color: black; }
	.regular img { width:28px; height:28px; border-radius:100px;}
	.slick-slide {display: none;float: left;height: 100%;min-height: 1px;}
	.slick-track{float: left!important; display: inline-block;}
</style>
<script src="{{ URL::asset('assets/js/slick.min_v1.js') }}" type="text/javascript" charset="utf-8"></script>

<style type="text/css">
	
	.highlight {
	
    margin:0 -4px;
	}
</style>

<style type='text/css'>
	.highlight { background-color:yellow; }
	.emptyBlock1000 { height:auto; }
	.emptyBlock2000 { height:auto; }
	/*.selectedChatMsg { background-color: #957F68 !important; color: #ffffff; }*/
	.msg_body {scroll-behavior: smooth; }
</style>

<style>
	.ldBar {
	position: absolute !important;
	z-index: 1;
	bottom:75px;
	left:35%;
	}
</style>
<?php $loginUserData = getLoggedUser(); ?>
<?php
if (empty($loginUserData->avatar)) {
    $currentUserImg = '/assets/images/default_avt.jpeg';
} else {
    $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
} ?>

<?php
$aUInfo = getLoggedUser();
$isLoggedInTeam = Session::get("team_user_id");
if ($isLoggedInTeam) {
    $aTeamInfo = \App\Models\Admin\TeamModel::getTeamMember($isLoggedInTeam, $aUInfo->id);
    $teamMemberName = $aTeamInfo->firstname . ' ' . $aTeamInfo->lastname;
    $teamMemberId = $aTeamInfo->id;
    $teamLogin_id = $aTeamInfo->id;
} else {
    $teamMemberName = '';
    $teamMemberId = '';
    $teamLogin_id = $loginUserData->id;
}
if (!empty($isLoggedInTeam)) {
    $hasweb_access = getMemberchatpermission($isLoggedInTeam);
}
$aTwilioAc = getTwilioAccountCustom($loginUserData->id);
if (!empty($hasweb_access)) {
    if ($hasweb_access > 0 && $hasweb_access->sms_chat == 1) {
        if ($hasweb_access->bb_number != "") {
            $loginUserData->mobile = numberForamt($hasweb_access->bb_number);
        } else {
            $loginUserData->mobile = numberForamt($aTwilioAc->contact_no);
        }
    }
} else {
    $loginUserData->mobile = numberForamt($aTwilioAc->contact_no);
}
?>
<script>
	
	function updateReadvalue(RwebId)
	{
		
		$.ajax({
			url: "{{ url('admin/Chat/setWebReadstatus') }}",
			type: "POST",
			data: {'RwebId' : RwebId},
			dataType: "html",
			success: function (data) {
				
				$('.pr_'+RwebId).hide();
				},error: function(){
			}
		});
		
	}
	
	function playSound() {
		var sound = document.getElementById("audio");
		sound.play();
	}

	function WidgetplaySound() {
		var sound = document.getElementById("widget_audio");
		sound.play();
	}
	
	(function($) {
		
		$.fn.easyNotify = function(options) {
			
			var settings = $.extend({
				title: "Notification",
				options: {
			        body: "",
			        icon: "",
			        lang: 'pt-BR',
			        onClose: "",
			        onClick: "",
			        onError: "",
			        time: 1000
				}
			}, options);
			
			this.init = function() {
				var notify = this;
				if (!("Notification" in window)) {
			        alert("This browser does not support desktop notification");
					} else if (Notification.permission === "granted") {
					
			        var notification = new Notification(settings.title, settings.options);
			        
					
					} else if (Notification.permission !== 'denied') {
			        Notification.requestPermission(function(permission) {
						if (permission === "granted") {
							notify.init();
						}
						
					});
				}
				
			};
			
			this.init();
			return this;
		};
		
	}(jQuery));
	
	var smiliesMap = {
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
	
	$(document).on("click",".smilie", function() {
		var smiliesId = $(this).attr('userId');
		renderSmilies(smiliesId);
	});
	
	$(document).on("click",".smilieSms", function() {
		var smiliesId = $(this).attr('userId');
		renderSmiliesSms(smiliesId);
	});
	
	function isAnchor(str){
		return /^\<a.*\>.*\<\/a\>/i.test(str);
	}
	
	function renderSmilies(smiliesId) {
		
		var $smileyGrid = $(".smiley-grid_"+smiliesId);
		
		// render smilies if required
		if($smileyGrid.children().length == 0) {
			var smileisPerRow = 6,
			$smileySet = $(),
			$smileyRow = $();
			
			for(var i in smiliesMap) {
				var kids = $smileyRow.children().length;
				if(kids%smileisPerRow == 0) {
					$smileyRow = $("<div>").addClass("row gap-bottom text-center");
					$smileySet = $smileySet.add($smileyRow);
				}
				
				var smileyCol = $("<div>").addClass("col-md-2"),
				smileyImg = $("<img>").attr({
					"src": "/assets/img-smile/"+smiliesMap[i]+".gif",
					"title": i.toString(),
					"smiley":i.toString(),
					"data-toggle": "tooltip",
					"data-placement": "top"
				}).addClass("smiley-hint_"+smiliesId);
				smileyCol.append(smileyImg);
				$smileyRow.append(smileyCol);
			}
			$smileyGrid.append($smileySet);
			$(".smiley-hint_"+smiliesId).on("click", function() {
				var inputText = $('#msg_input_web_'+smiliesId).val();
				$('#msg_input_web_'+smiliesId).val(inputText.concat($(this).attr('smiley')));
				$(".supported-smilies_"+smiliesId).toggleClass("hide");
				$('#msg_input_web_'+smiliesId).focus();
				
				/*var inputText = $('#msg_input_'+smiliesId).val();
	                $('#msg_input_'+smiliesId).val(inputText.concat($(this).attr('smiley')));
	                $(".supported-smilies_"+smiliesId).toggleClass("hide");
				$('#msg_input_'+smiliesId).focus();*/
				
			}).tooltip();
		}
		
		// toggle smiley container hide
		$(".supported-smilies_"+smiliesId).toggleClass("hide");
	}
	
	function renderSmiliesSms(smiliesId) {
		
		var $smileyGrid = $(".smiley-grid_"+smiliesId);
		
		// render smilies if required
		if($smileyGrid.children().length == 0) {
			var smileisPerRow = 6,
			$smileySet = $(),
			$smileyRow = $();
			
			for(var i in smiliesMap) {
				var kids = $smileyRow.children().length;
				if(kids%smileisPerRow == 0) {
					$smileyRow = $("<div>").addClass("row gap-bottom text-center");
					$smileySet = $smileySet.add($smileyRow);
				}
				
				var smileyCol = $("<div>").addClass("col-md-2"),
				smileyImg = $("<img>").attr({
					"src": "/assets/img-smile/"+smiliesMap[i]+".gif",
					"title": i.toString(),
					"smiley":i.toString(),
					"data-toggle": "tooltip",
					"data-placement": "top"
				}).addClass("smiley-hint_"+smiliesId);
				smileyCol.append(smileyImg);
				$smileyRow.append(smileyCol);
			}
			$smileyGrid.append($smileySet);
			$(".smiley-hint_"+smiliesId).on("click", function() {
				var inputText = $('#msg_input_sms_'+smiliesId).val();
				$('#msg_input_sms_'+smiliesId).val(inputText.concat($(this).attr('smiley')));
				$(".supported-smilies_"+smiliesId).toggleClass("hide");
				$('#msg_input_sms_'+smiliesId).focus();
				
				/*var inputText = $('#msg_input_'+smiliesId).val();
	                $('#msg_input_'+smiliesId).val(inputText.concat($(this).attr('smiley')));
	                $(".supported-smilies_"+smiliesId).toggleClass("hide");
				$('#msg_input_'+smiliesId).focus();*/
				
			}).tooltip();
		}
		
		// toggle smiley container hide
		$(".supported-smilies_"+smiliesId).toggleClass("hide");
	}
	
	function getTime() {
		var date = new Date();
		var hours = date.getHours();
		var minutes = date.getMinutes();
		var ampm = hours >= 12 ? 'PM' : 'AM';
		hours = hours % 12;
		hours = hours ? hours : 12; // the hour '0' should be '12'
		minutes = minutes < 10 ? '0'+minutes : minutes;
		var strTime = hours + ':' + minutes + ' ' + ampm;
		return strTime;
	}
	
	
	
	function getTimeShow(newDate) {
		var date = new Date(newDate);
		var hours = date.getHours();
		var minutes = date.getMinutes();
		var ampm = hours >= 12 ? 'PM' : 'AM';
		hours = hours % 12;
		hours = hours ? hours : 12; // the hour '0' should be '12'
		minutes = minutes < 10 ? '0'+minutes : minutes;
		var strTime = hours + ':' + minutes + ' ' + ampm;
		return strTime;
	}
	function CalculateDiff(aFromDate) {
		
		var From_date = new Date(aFromDate);
		var To_date = new Date();
		var diff_date =  To_date - From_date;
		
		var years = Math.floor(diff_date/31536000000);
		var months = Math.floor((diff_date % 31536000000)/2628000000);
		var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
		//return years+" year(s) "+months+" month(s) "+days+" and day(s)";
		var timingDiff = '';
		if(years > 0) {
			timingDiff = years+' year ago';
		}
		else if(months > 0) {
			timingDiff = months+' month ago';
		}
		else if(days > 0) {
			timingDiff = days+' day ago';
		}
		else {
			timingDiff = 'Today';
		}
		return timingDiff;
	}
	function nl2br (str, is_xhtml) {
		if (typeof str === 'undefined' || str === null) {
			return '';
		}
		var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	}
	$(function () {
		var site_url = "{{ URL::to('/') }}";
		site_url = site_url.replace(/\/$/, '');
		var socket = io(site_url+':3000');
		var currentUser = "<?php echo $loginUserData->id; ?>";
		var currentUserName = "<?php echo $loginUserData->firstname . ' ' . $loginUserData->lastname; ?>";
		var avatar = "<?php echo $aUInfo->avatar; ?>";
		if(avatar != ' '){
			avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aUInfo->avatar; ?>";
		}
		else {
			avatar = "{{ URL::asset('admin_new/images/userp.png') }}";
		}
		var arr = [];
		var where = 'in';
		
		
		socket.emit('loginStatus',{currentUser:currentUser, currentUserName:currentUserName, avatar:avatar});
		
		
		$( ".all_user_chat" ).each(function( index ) {
			
			var userID = $( this ).attr( "user_id" );
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
		
		chatUserID = '';
		userFromNo = '';
		userToNo = '';
		
		/*setInterval(function(){
			if(chatUserID != ''){
			showSmsThreadsForPopup(chatUserID, userFromNo, userToNo, 0);
			}
		}, 5000); */
		
		// this function is used to load the sms chat or notes listing 
		$( document ).on( 'click', '.sms_user', function () {
			
			//$(".user_details").hide();
			
			var userID =  $(this).attr('phone_no');
			var SubscriberPhone = $(this).attr('phone_no');
			var NotesTo = $(this).attr('phone_no');
				if(NotesTo == "" || typeof NotesTo == 'undefined')
				{
                  
				setTimeout(function(){  
				  //$('.SmscreateNotes').css('display','none');
                  $('.userinfoicon').css('display','none');
				  }, 50);
				}

			SmsNoteslisting(SubscriberPhone);
			$('#sms_msg_box_'+userID).remove();
			if($.isNumeric( userID ))
			{
				// ajax to manage the chat popup stats // 
				$.ajax({
                    //url: "<?php echo base_url('admin/webchat/setChatboxstatus'); ?>",
                    type: "POST",
                    data: {userID:userID, currentUser:currentUser,type:'smschat', _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'ok') {
							
							$('#CurrentSMSUserListing').html(' <figure><img style="width:16px!important; height:11px!important" id="theImg" src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" /> </figure>');
							
							$('#CurrentSMSUserListing').removeClass("slick-initialized slick-slider");
							// ajax to list // 
							$.ajax({
								url: "{{ url('admin/Chat/getCurrentActivechat/smschat') }}",
								type: "POST",
								data: {userID:userID, currentUser:currentUser},
								dataType: "html",
								success: function (data) {
									/*
									setTimeout(function () {
										$('#CurrentSMSUserListing').html(data);
										var options = {
											dots: false,
											infinite: false,
											slidesToShow: 5,
											slidesToScroll: 3,
										}
										$('#CurrentSMSUserListing').slick(options);
									}, 100);
									*/
									},error: function(){
									alertMessage('Error: Some thing wrong!');
								}
							});
							// ajax to list// 
							
							
							
							
						}
					}
				});
				
			}
			// ajax to manage the chat popup stats // 
			var chatType = $( this ).attr( "chat_type" );
			var chatClass = $( this ).attr( "chat_class" );
			var fromNo = $( this ).attr( "from_no" );
			var toNo = $( this ).attr( "to_no" );
			chatUserID = userID;
			userFromNo = fromNo;
			userToNo = toNo;
			
			var userType = '';
			
			if($('#msg_box_'+userID).css('display') == 'none') {
				$('#msg_box_'+userID).remove();
			}
			else if($('#msg_box_'+userID).css('display') == 'block') {
				$('#msg_box_'+userID).remove();
			}
			
			//showSmsThreadsForPopup(userID, fromNo, toNo, 0);
			if(SubscriberPhone!="" || SubscriberPhone != 'undefined')
			{
			   SMSChatData(userID,SubscriberPhone,'');
			}
               username = $(this).attr('phone_no_format');
		  
		     var nextSearchBut = '';
		    if(typeof username == 'undefined')
			{
				nextSearchBut =  '<div style="z-index:9; width:282px;" class="chat_search_icon NextSearch"><input style="width:260px;" maxlength="10" id="searchChatMsg_New" onkeypress="return IsNumeric(event);" onkeyup="showResultSmall(this.value)"  class="searchChatMsg" type="text" name="searchChatMsg" value="" placeholder="Search Phone Number"><button type="submit"><img src="/assets/images/chat_search_icon.png"></button><div id="livesearchSmall"></div></div>';
				username='SMS';
			}
			else {
				nextSearchBut = `<div style="z-index:9; width:282px;" class="chat_search_icon PreSearch">
						<input style="width:260px;" id="searchChatMsg_${SubscriberPhone}" data-chatboxid="${SubscriberPhone}" class="searchSmsChatMsg" type="text" name="searchChatMsg" value="" placeholder="Search">
							<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
						</div>`;
			}
			  /*setTimeout(function(){
			if(username != undefined)
			{
			
			 
				$('.NextSearch').hide();
			  $('.PreSearch').show();
			
			}
			else
			{
			  // $('.Phoneuername').html('SMS');
			  $('.NextSearch').show();
			  $('.PreSearch').hide();
			}
			 }, 200);*/
			var useremail = $("#sidebar_Sms_box_"+userID).find( '.slider-email' ).text();
			
			
			var userImage = '<?php echo $currentUserImg; ?>';
			
			var usermobile = toNo;
			var userstatus = $( this ).find( '.user_status' ).text();
			var userstatus = userstatus.trim();
			if( userstatus.length > 0)
			{
				var newUserStatus = userstatus;
			}
			else {
				var newUserStatus = 'Just now';
			}
			
			
			if ( $.inArray( userID, arr ) != -1 ) {
				arr.splice( $.inArray( userID, arr ), 1 );
			}
			
				arr = arr.filter(function( element ) {
   return element !== undefined;
});
			console.log(arr,'shorabh');
			arr.unshift( userID );
			
			
			if($.trim(username) == "")
			{
				username =  usermobile;
			}
			
			
			smsChatPopup =`<div id="sms_msg_box_${SubscriberPhone}" class="msg_box Smschat" style="right:350px;" rel="${SubscriberPhone}">
			<div class="userinfoopen">
			<a title="User Info" class="userinfoicon" href="#">
		<i class="icon-info22"></i></a>
</div>
<div class="usdb">
	<a class="userinfoicon2" href="#">
	<span class="close"><img src="/assets/images/cross_chat.png"></span></a>
	<div class="row">
		<div class="col-md-12 bbot pb10"><p><strong>Email</strong> <span>${useremail}</span></p><p>
			<strong>Phone </strong> <span>${SubscriberPhone}</span></p><p><strong>Location </strong> 
			<span>New-York, USA (GMT-4)</span></p><p><strong>Gender </strong> <span>Male</span></p><p>
		<strong>Seen </strong> <span><i class="icon-primitive-dot txt_green fsize9"></i>${newUserStatus}</span></p>
		</div>
		<div class="col-md-12 pt10 pb10 bbot">
			<p class="mb-5">Lists</p>
			<button class="btn btn-xs btn_white_table">Reviews</button>
			<button class="btn btn-xs btn_white_table">SMS</button>
			<button class="btn btn-xs btn_white_table">Email List</button>
		<button class="btn btn-xs btn_white_table">+</button></div>
		<div class="col-md-12 pt10 pb10 bbot"><p class="mb-5">Tags</p>
			<button class="btn btn-xs btn_white_table">Reviews</button>
			<button class="btn btn-xs btn_white_table">SMS</button>
			<button class="btn btn-xs btn_white_table">Email List</button>
			<button class="btn btn-xs btn_white_table">+</button>
		</div>
		<div class="col-md-12 footer_txt"><a href="#">Open Profile > </a>
		</div>
	</div>
</div>
<div class="msg_head" data-div="${SubscriberPhone}">
	<div id="next_chat_${SubscriberPhone}"></div>
	<img style="vertical-align:top; margin-top:3px;" src="/assets/images/phone_green.png" alt="" width="" height="">&nbsp;<b class="Phoneuername" >${username}</b>
	<div><span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;">Assigned to:&nbsp; ${username}</span></div>
	<span style="display:none" class="close"><img src="/assets/images/cross_chat.png"/></span>
	<span user_id="${SubscriberPhone}" style="color:red;cursor:pointer;position: absolute;right: 9px;font-size:16px; top:11px;" box-close-type="smschat" class="green_check_close">
	<img id="close_img_${SubscriberPhone}" src="/assets/images/close_red_20.png"/></span>
	<span style="cursor:pointer;position: absolute;right: 34px; top:10px; font-size: 25px;" class="green_check_minus"><img id="minus_img_${SubscriberPhone}" src="/assets/images/grey_minus.png"/></span>
	<span class="green_check"><img src="/assets/images/green_check_20.png"/></span>
</div>
<div class="msg_wrap">
	<div style="padding: 10px 15px!important;" class="bbot bkg_white">
		
		
		${nextSearchBut}
		
	</div>
	
	
	<span style="display:none" class="minimize"><img src="/assets/images/minus_chat.png"/></span> 
	
	<div class="tab-content"> 

	  <!-- CHAT SHORTCUTS -->
			   <div style="display: none;" class="chat_shortcuts" id="shortcutSmsBox_${SubscriberPhone}">
                                	<div class="p10 pl20 pr20 bbot">
                                				<div class="short_search_icon pull-left"><input subs_phone="${SubscriberPhone}" class="Search_shortcut_sms"  id="Search_shortcut_sms" type="text" name="" value="" placeholder="Search shortcut">
												 <button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
												</div>
                              	
                              				<div class="pull-right"><a style="cursor: pointer"   class="txt_blue fsize13 tsms" subs_phone="${SubscriberPhone}" tweb_attr="chtshortcut_${SubscriberPhone}">Create &nbsp; <img width="14" height="14" src="assets/images/chat_plus_icon.png"></a>&nbsp;
                              				<a href="#" class="short_icon"><img width="14" height="14" src="assets/images/close_red_20.png"></a>
                              				</div>
                               	
                               		<div class="clearfix"></div>
                                	</div>
                                	<div class="p10 pl20" style="height: 200px;float: left;overflow: auto;">
                                		<ul id="shortcutSmsBoxUl_${SubscriberPhone}"></ul>
                                	</div>
                                </div>
              <!-- CHAT SHORTCUTS -->


		<div class="tab-pane active" id="sms_tab_small_${NotesTo}">	
			
			
			<div class="p0"> 
				<ul  tWR="${SubscriberPhone}" id="sms_box_show_${SubscriberPhone}" class="msg_body media-list chat-list new">
					<div class="msg_push" style="display:none;"></div> 
				</ul> 
				
			</div> 
			<div class="textaraebox">
				
				<textarea id="msg_input_sms_${SubscriberPhone}" SubscriberPhone="${SubscriberPhone}" class="msg_input_sms msg_input"  user_id="${userID}" userImage="${userImage}" 
				placeholder="Shift + Enter to add a new line Start with ‘/’ to select a  Saved Message"></textarea>
			</div>
			
			<div class="panel panel-default smilie_emoji supported-smilies_${SubscriberPhone} hide" style="position:absolute;top:220px; right:0px;">
				<div class="panel-heading">
					<span>
						<strong>Supported Smilies</strong>
					</span>
				</div>
				<div class="panel-body smiley-grid_${SubscriberPhone}"></div>
			</div>
			<div class="msg_footer">
				<input style="display:none;" id="mmsFileSms_${SubscriberPhone}" class="mmsFile1Sms" type="file" user_id="${SubscriberPhone}">
				
				<input class="userSmsPhoneNo" type="hidden" value="${SubscriberPhone}">
				<div class="row"><div class="col-xs-6">
					
					<a user_id="${SubscriberPhone}"  class="blue createMessage" data-toggle="tab" href="sms_tab_small_${SubscriberPhone}">Message</a>
					<a class="SmscreateNotes" SubscriberPhone="${SubscriberPhone}" user_id="${NotesTo}" data-toggle="tab" href="#noteSms_tab_small_${NotesTo}">Note</a>
					
					
				</div>
				<div class="col-xs-6 text-right">
				              <a id="short_icon_${SubscriberPhone}" class="mr-15 short_icon" user_id="${SubscriberPhone}"  href="javascript:void();"><img src="/assets/images/chat_list_icon.png"/> </a>
					<a style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="" class="smilieSms" data-original-title="Smilies" userId="${userID}">
						<i class="fa fa-smile-o"></i>
					</a>
					
					<a style="cursor: pointer;" class="preview_image_button_cl_sms" user_id="${SubscriberPhone}">
						<i class="icon-attachment"></i>
					</a> 
					
					
					<a href="javascript:void(0)">
					<img src="/assets/images/chat_calendar.png"/></a>
					<div id="webChatanchor_${userID}" style="float:right">
						<a id="trigger_smschat_message_${userID}" rel="${userID}" SubscriberPhone="${SubscriberPhone}" userImage="${userImage}" class="p0" href="javascript:void(0)"><img src="/assets/images/chat_send_blue.png" width="15"/></a>
					</div>
					
				</div>
				</div>
				
			</div>
			
		</div>
		
		<div class="tab-pane" id="noteSms_tab_small_${NotesTo}">
			<div class="p0"> 
				<ul id="Smsnotes_box_listing_${SubscriberPhone}" class="msg_body media-list chat-list new">
					<div class="msg_push" style="display:none;"></div> 
				</ul> 
				
			</div> 
			<div class="textaraebox addSubscriberNotes">
				<textarea  SubscriberPhone="${SubscriberPhone}" class="sms_msg_input_notes addSubscriberNotes"  user_id="${NotesTo}" userImage="${userImage}" 
				placeholder="Shift + Enter to add a new line Start with ‘/’ to select a  Saved Message"></textarea>
				
			</div>
			
			<div class="panel panel-default smilie_emoji supported-smilies_${NotesTo} hide" style="position:absolute;top:220px; right:0px;">
				<div class="panel-heading">
					<span>
						<strong>Supported Smilies</strong>
					</span>
				</div>
				<div class="panel-body smiley-grid_${NotesTo}"></div>
			</div>
			<div class="msg_footer addSubscriberNotes">
				<input style="display:none;" id="mmsFile_${NotesTo}" class="mmsFile1" type="file" user_id="${NotesTo}">
				
				<input class="userSmsPhoneNo" type="hidden" value="${usermobile}">
				<div class="row">
					<div class="col-xs-6">
						
						<a user_id="${NotesTo}"  class="createMessage" data-toggle="tab" href="#sms_tab_small_${NotesTo}">Message</a>
						<a class="createNotes SmscreateNotes yellow" SubscriberPhone="${SubscriberPhone}" user_id="${NotesTo}" data-toggle="tab" href="#noteSms_tab_small_${NotesTo}">Note</a>
						
					</div>
					<div class="col-xs-6 text-right">
						
						
						<a style="cursor: pointer; " class="preview_image_button_cl_sms_notes" user_id="${NotesTo}">
							<i class="icon-attachment"></i>
						</a> 
						
						<a href="javascript:void(0)">
						<img src="/assets/images/chat_calendar.png"/></a>
						<div id="webChatanchor_${NotesTo}" style="float:right">
							<a id="trigger_webchat_message_${NotesTo}" rel="${NotesTo}" userImage="${userImage}" class="p0 webChatTrigger" href="javascript:void(0)"><img src="/assets/images/chat_send_blue.png" width="15"/></a>
						</div>
						
					</div>
				</div>
				
				
				
				
			</div>
		</div>
		


		
	</div>

	
</div>
</div>`;



$( "body" ).append( smsChatPopup );
displayChatBox();
});


function SMSChatData(userId="",SubscriberPhone,clickvalue="" )
{

$.ajax({
url: '<?php echo base_url('admin/smschat/showSmsThreads'); ?>',
type: "POST",
data: {'userId':userId,'SubscriberPhone':SubscriberPhone, _token: '{{csrf_token()}}'},
dataType: "html",
success: function (data) {
$('#sms_box_show_'+userId).html(data+'<div class="msg_push"></div>');
setTimeout(function(){ var msgHeight = document.getElementById("sms_box_show_"+userId).scrollHeight;
$( "#sms_box_show_"+userId ).scrollTop(msgHeight); }, 500);
},error: function(){
alertMessage('Error: Some thing wrong!');
}
});	
}




$('body').on('keyup', '.Smschat .msg_input_sms', function(e){
userPhoneNo = $(this).attr('subscriberphone');
var userid =  userPhoneNo;


	if(e.keyCode == 191)
	{
	$.ajax({
	url: "<?php echo base_url('admin/smschat/small_shortcutListing_sms'); ?>",
	data:{'boxid':userid, _token: '{{csrf_token()}}'},
	type: "POST",
	dataType: "html",
	success: function (data) {
	$('#shortcutSmsBoxUl_'+userid).html(data);
	$('#shortcutSmsBox_'+userid).toggle();
	$('#shortcutSmsBox_'+userid+' #Search_shortcut_sms').focus();
	}
	});
	}
	else if(e.keyCode == 8)
	{
	$('#shortcutSmsBox_'+userid).hide();
	}
  

if (e.which == 13) {
	$('#shortcutSmsBox_'+userid).hide();
var userPhoneNo = $(this).attr('subscriberphone'); 
var newsms = $(this).attr('newsms'); 
var currentUserImg = $(this).attr('userImage');
var Smsusrid = $(this).attr('user_id'); 
var messageContent = $(this).val();
messageContent  = messageContent.replace('/','');
var messageContentDynamic = $(this).val();
messageContentDynamic = messageContentDynamic.replace('/','');
$(this).val('');
if(userPhoneNo == '' || userPhoneNo == 'undefined' ){
userPhoneNo = newsms;
 
	}
if(userPhoneNo == '' || userPhoneNo == 'undefined' ){
displayMessagePopup('error', '', 'User phone number is not avilable'); //javascript notification msg
}else if($.trim(messageContent) == ''){
$('#msg_input_sms_'+Smsusrid).addClass('borderClass');	

}else{

setTimeout(function(){ $('#msg_input_sms_'+Smsusrid).removeClass('borderClass'); }, 50);	
var messageText ='<li class="media reversed"> <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><span class="icons s32"><img src='+currentUserImg+' class="img-circle" alt="" width="28" height="28"></span></span><div class="media-content">'+messageContent+'</div></div></li>';

var messageSmilies = messageText.match(smileyReg) || [];
for(var i=0; i<messageSmilies.length; i++) {
var messageSmiley = messageSmilies[i],
messageSmileyLower = messageSmiley.toLowerCase();
if(smiliesMap[messageSmileyLower]) {
messageText = messageText.replace(messageSmiley,"<img style='width:auto; height:auto;' src='/assets/img-smile/"+smiliesMap[messageSmileyLower]+".gif'  alt='smiley' />");
}
}

if(messageContent.indexOf('<img') != -1){
  var messageContent = 'File Attachment';
}


$('.sms_twr_'+userPhoneNo).find('.slider-phone').html(messageContent.substring(0, 20));
$(this).val('');
					
		


var aToken = Number(userPhoneNo) + Number('<?php echo $loginUserData->mobile; ?>');

if(Number(userPhoneNo) > Number('<?php echo $loginUserData->mobile; ?>')){
var sToken = Number(userPhoneNo) - Number('<?php echo $loginUserData->mobile; ?>');
}
else {
var sToken = Number('<?php echo $loginUserData->mobile; ?>') - Number(userPhoneNo);
}
var newToken = aToken+'n'+sToken;



//shorabhtest
	var flag = 0;
	$('.activityShow').each(function(i) {

	    if ($(this).find('.getChatDetails').attr('phone_no') == userPhoneNo) {
	        flag++;
	    }


	});
	
	$('.sms_user').each(function(i) {

	    if ($(this).attr('phone_no') == userPhoneNo) {
	        flag++;
	    }


	});
	

	if (flag == 0)
	{
	    if (document.getElementById("em_small_new_number").value == '1') {

	        $('.activeChat').prepend('<div class="activityShow sms_twr_' + userPhoneNo + ' media chatbox_new bkg_white mb10 ' + userPhoneNo + '" style="box-shadow:0 2px 4px 0 rgba(1, 21, 64,0.06)!important; border-radius:0 0 5px 5px"><a href="javascript:void(0);" class="media-link bbot  getChatDetails " subscriberId="" phone_no=' + userPhoneNo + '><div class="media-left"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:12px;">NA</span><span class="favouriteSMSUser" style="display:none" subscriberId="" phone_no=' + userPhoneNo + '><i class="fa fa-star star_icon "></i></span></div><div class="media-body"> <span class="fsize12 txt_dark">' + userPhoneNo + '</span> <span id=unMsg_' + userPhoneNo + ' class="slider-phone contacts text-size-small" style="margin:0px">' + messageContentDynamic.substring(0, 20) + '...</span><span class="fsize12 txt_dark"></span> </div><div class="media-right"><span class="date_time txt_grey fsize12">just now</span></div></a> </div>');
	        $('.SmallSmschat .a_list').prepend('<div phone_no_format=' + userPhoneNo + ' id="sidebar_Sms_box_' + userPhoneNo + '" class="sms_user sms_twr_' + userPhoneNo + '" incsmswid="" rewid="" phone_no=' + userPhoneNo + ' user_id="146"><span style="display: none;" class="slider-image img"><?php echo $currentUserImg; ?></span><div class="avatarImage"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:11px;">NA</span></div><span style="display:none" id="fav_star_"><a style="cursor: pointer;" class="favourite" status="1" user_id=""><i class="icon-star-full2 text-muted sidechatstar"></i></a></span><span class="slider-username contacts">' + userPhoneNo + '</span> <span class="slider-phone contacts txt_dark" style="margin:0px;color:#6a7995!important; font-weight:bold;padding-left:40px; font-size:12px!important">' +messageContentDynamic.substring(0, 20) + '...</span><span class="user_status">Just Now</span></div>');
	        $.ajax({
	           url: "{{ url('admin/subscriber/add_contact') }}",
	            type: "POST",
	            data: {
	                'firstname': 'NA',
	                'lastname': 'NA',
	                'phone': userPhoneNo
	            },
	            dataType: "json", 
	            success: function(data) {
				
	                if (data.status == 'success') {
					
					   setTimeout(function(){ $("#sidebar_Sms_box_"+userPhoneNo).attr('incsmswid',data.iSubscriberID); }, 400);
					} else {
	                    alertMessage('Error: Some thing wrong!');
	                    $('.overlaynew').hide();
	                }
	            }
	        });
			
			

	    } else {


	        $('.activeChat').prepend('<div class="activityShow sms_twr_' + userPhoneNo + ' media chatbox_new bkg_white mb10 ' + newToken + '" style="box-shadow:0 2px 4px 0 rgba(1, 21, 64,0.06)!important; border-radius:0 0 5px 5px"><a href="javascript:void(0);" class="media-link bbot  getChatDetails " subscriberId=' + userid + ' phone_no=' + userPhoneNo + '><div class="media-left"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:12px;">NA</span><span class="favouriteSMSUser" style="display:none" subscriberId="" phone_no=' + userPhoneNo + '><i class="fa fa-star star_icon "></i></span></div><div class="media-body"> <span class="fsize12 txt_dark">' + userPhoneNo + '</span> <span id=unMsg_' + userPhoneNo + ' class="slider-phone contacts text-size-small" style="margin:0px">' + messageContentDynamic.substring(0, 20) + '...</span><span class="fsize12 txt_dark"></span> </div><div class="media-right"><span class="date_time txt_grey fsize12">just now</span></div></a> </div>');
	        $('.SmallSmschat .a_list').prepend('<div phone_no_format=' + userPhoneNo + ' id="sidebar_Sms_box_' + userPhoneNo + '" class="sms_user sms_twr_' + userPhoneNo + '" incsmswid="" rewid="" phone_no=' + userPhoneNo + ' user_id="146"><span style="display: none;" class="slider-image img"><?php echo $currentUserImg; ?></span><div class="avatarImage"><span class="icons fl_letters_gray s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:11px;">NA</span></div><span style="display:none" id="fav_star_"><a style="cursor: pointer;" class="favourite" status="1" user_id=""><i class="icon-star-full2 text-muted sidechatstar"></i></a></span><span class="slider-username contacts">' + userPhoneNo + '</span> <span class="slider-phone contacts txt_dark" style="margin:0px;color:#6a7995!important; font-weight:bold;padding-left:40px; font-size:12px!important">' +messageContentDynamic.substring(0, 20) + '...</span><span class="user_status">Just Now</span></div>');

	    }
		
		
		$("#sms_msg_box_undefined").remove();
		$("#sms_msg_box_").remove();
		$('#sidebar_Sms_box_'+newsms).trigger('click');
		setTimeout(function(){ 
		
		$('[tWR="' + userPhoneNo + '"] .msg_push').before(messageText);
		
		
}, 1000);
	}
	else
	{

     $('[tWR="' + userPhoneNo + '"] .msg_push').before(messageText);

	}

$('#msg_input_sms_'+userPhoneNo).attr('userimage','<?php echo $currentUserImg; ?>');
		

$.ajax({
url: "{{ url('admin/smschat/sendMsg') }}",
type: "POST",
data: {'phoneNo' : userPhoneNo, 'messageContent' : messageContent, 'smstoken': newToken, 'moduleName' : 'chat', 'media_type': '', 'videoUrl': ''},
dataType: "html",
success: function (data) {
	
	
},error: function(){
}
});

		         var msgHeight = document.getElementById("sms_box_show_"+userPhoneNo).scrollHeight;
			   $( "#sms_box_show_"+userPhoneNo).scrollTop(msgHeight);
			   
			   if($('#smsSearcharea').length){
			   var msgHeight_main = document.getElementById("smsSearcharea").scrollHeight;
			   $( "#smsSearcharea").scrollTop(msgHeight_main);
			   }


}
}
});


// please use only token to get or add messages in the webchat ignore all other variables 

$( document ).on( 'click', '.sidebar-user-box', function () {
var userID = $( this ).attr( "user_id" );
var assing_to = $( this ).attr( "assign_to" );
var token = $( this ).attr( "token" );

if(userID.length>10)
{

setTimeout(function(){  

	if(assing_to!='' && typeof assing_to!='undefined')
	{
		
	$('#next_chat_'+userID).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;">Assigned to:&nbsp '+assing_to +'</span>');
	}


 }, 150);
}
var NotesTo  =  $( this ).attr( "user_id" );
webNoteslisting(NotesTo);
// ajax to manage the chat popup stats // 
$.ajax({
url: "<?php echo base_url('admin/webchat/setChatboxstatus'); ?>",
type: "POST",
data: {userID:userID, currentUser:currentUser,type:'webchat', _token: '{{csrf_token()}}'},
dataType: "json",
success: function (data) {
if (data.status == 'ok') {

$('#CurrentUserListing').html(' <figure style="margin:15px 0;"><img style="width:16px!important; height:11px!important" id="theImg" src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" /> </figure>');
$('#CurrentUserListing').removeClass("slick-initialized slick-slider");

// ajax to list // 
$.ajax({
url: "{{ url('admin/Chat/getCurrentActivechat/webchat') }}",
type: "POST",
data: {userID:userID, currentUser:currentUser},
dataType: "html",
success: function (data) {

setTimeout(function () {

$('#CurrentUserListing').html(data);

var options = {
dots: false,
infinite: false,
slidesToShow: 5,
slidesToScroll: 3,
}


$('.regular').slick(options);
}, 100);

},error: function(){
alertMessage('Error: Some thing wrong!');
}
});
// ajax to list// 



}
}
});

// ajax to manage the chat popup stats // 



var userType = ''; 
if(userID == 1) {
userType = '( Admin )';
}
if($('#msg_box_'+userID).css('display') == 'none') {
$('#msg_box_'+userID).remove();
}
else if($('#msg_box_'+userID).css('display') == 'block') {
$('#msg_box_'+userID).remove();
}
else {

}


//console.log(newToken, 'get new token');
var strTime = getTime();
$.ajax({
url: '<?php echo base_url('admin/webchat/getMessages'); ?>',
type: "POST",
data: {room:token, offset:'0',_token: '{{csrf_token()}}'},
dataType: "json",
success: function (data) {
//console.log(data)
// webchatfromhere;
if (data.status == 'ok') {
var result = data.res;
//console.log(result);
for(var inc = 0; inc < result.length; inc++) {
var row = result[inc];
var newUserTo = row.user_to;
var newUserFrom = row.user_form;
var newMessage = row.message;
var created = row.created;
var avatarImg = row.avatarImage;
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
//console.log(newUserTo,'to user');
$('<li class="media reversed"><div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>'+avatarImg+'</span><div class="media-content">' + nl2br(newMessage) + '</div></div></li>' ).insertAfter( '[rel="' + newUserTo + '"] .msg_push' );
}
else {
//console.log(newUserFrom,'from user');
$('<li class="media team_user_'+newUserFrom+'"><div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>'+avatarImg+'</span><div class="media-content">' + nl2br(newMessage) + '</div></div></li>' ).insertAfter( '[rel="' + newUserFrom + '"] .msg_push' );
}

}


if(currentUser == newUserTo)
{
var mUser = newUserFrom;
}
else {
var mUser = newUserTo;
}
var msgHeight = document.getElementById("msg_box_show_"+mUser).scrollHeight;
$( '#msg_box_show_'+mUser ).scrollTop(msgHeight);
}
}
});

$.ajax({
url: "<?php echo base_url('admin/webchat/readMessages'); ?>",
type: "POST",
data: {userID:userID, currentUser:currentUser, _token: '{{csrf_token()}}'},
dataType: "json",
success: function (data) {
if (data.status == 'ok') {
$('#read_status_'+userID).attr('readStatus','0');
$('#read_status_fav_'+userID).attr('readStatus','0');
$('#read_status_con_'+userID).attr('readStatus','0');
$('#read_status_'+userID).html(' ');
$('#read_status_fav_'+userID).html(' ');
$('#read_status_con_'+userID).html(' ');
}
}
});



var username = $("#sidebar-user-box-"+userID).find( '.slider-username' ).text();
var useremail = $("#sidebar-user-box-"+userID).find( '.slider-email' ).text();
var userImage = $( "#sidebar-user-box-"+userID ).find( '.slider-image' ).text();
var usermobile = $( this ).find( '.slider-mobile' ).text();


var userstatus = $( this ).find( '.user_status' ).text();
var userstatus = userstatus.trim();
if( userstatus.length > 0)
{
var newUserStatus = userstatus;
}
else {
var newUserStatus = 'Just now';
}

if ( $.inArray( userID, arr ) != -1 ) {
arr.splice( $.inArray( userID, arr ), 1 );
}

arr.unshift( userID );

$('.chatSliderPrevBtn').remove();
if(arr.length > 3){
$('#next_chat_'+arr[1]).html('<div class="chatSliderPrevBtn"><a id="prev_chat"><i class="icon-arrow-left32 fsize11"></i></a></div>');
}

var RwebId = 	$(this).attr('RwebId');
if($(this).attr('wait') == 'yes')
{ 
updateReadvalue(RwebId); 	
}
chatPopup = `<div id="msg_box_${userID}" class="msg_box webchat" style="right:350px;" rel="${userID}">
	<div class="userinfoopen">
		<a title="User Info" class="userinfoicon" href="#">
		<i class="icon-info22"></i></a>
	</div>
	<div class="usdb">
		<a class="userinfoicon2" href="#">
		<span class="close"><img src="/assets/images/cross_chat.png"></span></a>
		<div class="row">
			<div class="col-md-12 bbot pb10"><p><strong>Email</strong> <span>${useremail}</span></p><p>
				<strong>Phone </strong> <span>${usermobile}</span></p><p><strong>Location </strong> 
				<span>New-York, USA (GMT-4)</span></p><p><strong>Gender </strong> <span>Male</span></p><p>
			<strong>Seen </strong> <span><i class="icon-primitive-dot txt_green fsize9"></i>${newUserStatus}</span></p>
			</div>
			<div class="col-md-12 pt10 pb10 bbot">
				<p class="mb-5">Lists</p>
				<button class="btn btn-xs btn_white_table">Reviews</button>
				<button class="btn btn-xs btn_white_table">SMS</button>
				<button class="btn btn-xs btn_white_table">Email List</button>
			<button class="btn btn-xs btn_white_table">+</button></div>
			<div class="col-md-12 pt10 pb10 bbot"><p class="mb-5">Tags</p>
				<button class="btn btn-xs btn_white_table">Reviews</button>
				<button class="btn btn-xs btn_white_table">SMS</button>
				<button class="btn btn-xs btn_white_table">Email List</button>
				<button class="btn btn-xs btn_white_table">+</button>
			</div>
			<div class="col-md-12 footer_txt"><a href="#">Open Profile > </a>
			</div>
		</div>
	</div>
	<div class="msg_head" data-div="${userID}">
		
		<img src="/assets/images/desktop.png" class="" alt="" width="" height="">&nbsp;${username} <div id="next_chat_${userID}"></div>
		<span style="display:none" class="close"><img src="/assets/images/cross_chat.png"/></span>
		<span user_id="${userID}" style="color:red;cursor:pointer;position: absolute;right: 9px;font-size:16px; top:11px;" box-close-type="webchat" class="green_check_close">
		<img id="close_img_${userID}" src="/assets/images/close_red_20.png"/></span>
		<span style="cursor:pointer;position: absolute;right: 34px; top:10px; font-size: 25px;" class="green_check_minus"><img id="minus_img_${userID}" src="/assets/images/grey_minus.png"/></span>
		<span class="green_check"><img src="/assets/images/green_check_20.png"/></span>
	</div>
	<div class="msg_wrap">
		<div style="padding: 10px 15px!important;" class="bbot bkg_white">
			<div style="z-index:9; width:282px;" class="chat_search_icon"><input style="width:260px;" id="searchChatMsg_${userID}" data-chatboxid="${userID}" class="searchChatMsg" type="text" name="searchChatMsg" value="" placeholder="Search">
				<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
			</div>
		</div>
		
		
		<span style="display:none" class="minimize"><img src="/assets/images/minus_chat.png"/></span> 
		
		<div class="tab-content"> 

		  <!-- CHAT SHORTCUTS -->
			   <div style="display: none;" class="chat_shortcuts" id="chtshortcut_${userID}">
                                	<div class="p10 pl20 pr20 bbot">
                                				<div class="short_search_icon pull-left"><input user_id="${userID}" class="Search_shortcut_web"  id="Search_shortcut_web" type="text" name="" value="" placeholder="Search shortcut">
												 <button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
												</div>
                              	
                              				<div class="pull-right"><a style="cursor: pointer"   class="txt_blue  fsize13 tweb"  user_id="${userID}" tweb_attr="chtshortcut_${userID}">Create &nbsp; <img width="14" height="14" src="assets/images/chat_plus_icon.png"></a>&nbsp;
                              				<a href="#" class="short_icon"><img width="14" height="14" src="assets/images/close_red_20.png"></a>
                              				</div>
                               	
                               		<div class="clearfix"></div>
                                	</div>
                                	<div class="p10 pl20" style="height: 200px;float: left;overflow: auto;">
                                		<ul id="shortcutBox_${userID}"></ul>
                                	</div>
                                </div>
              <!-- CHAT SHORTCUTS -->


              <!-- web tab -->
            <div class="tab-pane active" id="web_tab_small_${userID}">	
				
				<div class="p0"> 
					<ul id="msg_box_show_${userID}" class="msg_body media-list chat-list new">
						<div class="msg_push" style="display:none;"></div> 
					</ul> 
					
				</div> 
				<div class="textaraebox">
					
					<textarea id="msg_input_web_${userID}" class="msg_input_web msg_input"  user_id="${userID}" userImage="${userImage}" 
					placeholder="Shift + Enter to add a new line Start with ‘/’ to select a  Saved Message"></textarea>
				</div>
				
				<div class="panel panel-default smilie_emoji supported-smilies_${userID} hide" style="position:absolute;top:220px; right:0px;">
					<div class="panel-heading">
						<span>
							<strong>Supported Smilies</strong>
						</span>
					</div>
					<div class="panel-body smiley-grid_${userID}"></div>
				</div>
				<div class="msg_footer">
					<input style="display:none;" id="mmsFile_${userID}" class="mmsFile1" type="file" user_id="${userID}">
					
					<input class="userSmsPhoneNo" type="hidden" value="${usermobile}">
					<div class="row"><div class="col-xs-6">
						
						<a user_id="${userID}"  class="blue createMessage" data-toggle="tab" href="web_tab_small_${userID}">Message</a>
						<a class="createNotes WebcreateNotes" user_id="${userID}" data-toggle="tab" href="#not_tab_small_${userID}">Note</a>
						
						
					</div>
					<div class="col-xs-6 text-right">
					<a id="short_icon_${userID}" class="mr-15 short_icon" user_id="${userID}"  href="javascript:void();"><img src="/assets/images/chat_list_icon.png"/> </a>
						<a style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="" class="smilie" data-original-title="Smilies" userId="${userID}">
							<i class="fa fa-smile-o"></i>
						</a>
						
						<a style="cursor: pointer;" class="preview_image_button_cl_web" user_id="${userID}">
							<i class="icon-attachment"></i>
						</a> 
						
						
						
						<a href="javascript:void(0)">
						<img src="/assets/images/chat_calendar.png"/></a>
						<div id="webChatanchor_${userID}" style="float:right">
							<a id="trigger_webchat_message_${userID}" user_id="${userID}" rel="${userID}" userImage="${userImage}" class="p0 webChatTrigger" href="javascript:void(0)"><img src="/assets/images/chat_send_blue.png" width="15"/></a>
						</div>
						
					</div>
					</div>
					
					
					
				</div>
				
			</div>
			  <!-- web tab -->


			  <!-- notes tab -->
			<div class="tab-pane" id="not_tab_small_${userID}">
				<div class="p0"> 
					<ul id="notes_box_listing_${userID}" class="msg_body media-list chat-list new smallchatnotes">
						<div class="msg_push_notes" style="display:none;"></div> 
					</ul> 
					
				</div> 
				<div class="textaraebox addSubscriberNotes">

					<textarea   class="msg_input_notes addSubscriberNotes" newToken="${token}"  currentUser="${currentUser}" user_id="${userID}" userImage="${userImage}" 
					placeholder="Shift + Enter to add a new line Start with ‘/’ to select a  Saved Message"></textarea>
					
				</div>
				
				<div class="panel panel-default smilie_emoji supported-smilies_${userID} hide" style="position:absolute;top:220px; right:0px;">

					<div class="panel-heading">
						<span>
							<strong>Supported Smilies</strong>
						</span>
					</div>
					<div class="panel-body smiley-grid_${userID}"></div>
				</div>
				<div class="msg_footer addSubscriberNotes">
					<input style="display:none;" id="mmsFile_${userID}" class="mmsFile1" type="file" user_id="${userID}">
					
					<input class="userSmsPhoneNo" type="hidden" value="${usermobile}">
					<div class="row">
						<div class="col-xs-6">
							
							<a user_id="${userID}"  class=" createMessage" data-toggle="tab" href="#web_tab_small_${userID}">Message</a>
							<a class="createNotes yellow" user_id="${userID}" data-toggle="tab" href="#not_tab_small_${userID}">Note</a>
							
						</div>
						<div class="col-xs-6 text-right">
							<a id="" class="mr-15 short_icon" href="javascript:void();"><img src="/assets/images/chat_list_icon.png"/> </a>
							<a style="cursor: pointer;" class="preview_image_button_cl_notes" newToken="${token}" user_id="${userID}">
								<i class="icon-attachment"></i>
							</a> 
							
							<a href="javascript:void(0)">
							<img src="/assets/images/chat_calendar.png"/></a>
							<div id="webChatanchor_${userID}" style="float:right">
								<a id="trigger_webchat_message_${userID}" rel="${userID}" userImage="${userImage}" class="p0 webChatTrigger" href="javascript:void(0)"><img src="/assets/images/chat_send_blue.png" width="15"/></a>
							</div>
							
						</div>
					</div>
					
					<!-- notes tab -->

					
				</div>
			</div>
			
			
		</div>
		
	</div>
</div>`;



$( "body" ).append( chatPopup );
displayChatBox();
});


$(document).on('click', '.previewImage', function(e) {
e.preventDefault();
var imageUrl = $(this).attr('href');
$('#showImage').attr('src', imageUrl);
$('#previewImagePopup').modal();
});
$( document ).on( 'click', '.msg_head', function () {
var chatbox = $( this ).parents().attr( "rel" );
//console.log(chatbox, 'slideToggle');
if($(this).next().next().css('display') !== 'none')
{

$(this).prev().prev().hide();
$(this).find('.max_chat').hide();
$(this).find('.min_chat').show();
$(this).addClass('cht_min');
$(this).find('.chatSliderPrevBtn').addClass('prv_min');
//console.log($(this).find('.min_chat'));
//$(this).hide();
//$(this).next().show();
}
else {

$(this).prev().prev().show();
$(this).find('.min_chat').hide();
$(this).find('.max_chat').show();
$(this).removeClass('cht_min');
$(this).find('.chatSliderPrevBtn').removeClass('prv_min');
}

$( '[rel="' + chatbox + '"] .msg_wrap' ).slideToggle( "slow",function() { 

if ($(this).is(':visible'))
{ 
$('#minus_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/grey_minus.png'); ?>");
$('#close_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/close_red_20.png'); ?>");
}
else
{
$('#minus_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/icon_maximize.png'); ?>");
$('#close_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/close_red_20.png'); ?>");

}

} );



if($( '#read_status_poopup_'+chatbox ).text() > 0)
{
var aToken = Number(chatbox) + Number(currentUser);
if(Number(chatbox) > Number(currentUser)){
var sToken = Number(chatbox) - Number(currentUser);
}
else {
var sToken = Number(currentUser) - Number(chatbox);
}

var newToken = aToken+'n'+sToken;
var strTime = getTime();
$.ajax({
url: "{{ url('admin/Chat/getUnreadMessages') }}",
type: "POST",
data: {room:newToken, offset:'0'},
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
if(newUserFrom == currentUser){
$('#msg_box_show_'+newUserTo).append('<div class="msg-right"><div class="msg_time">'+ created +'</div> ' + newMessage + '</div>');
}
else {
$('#msg_box_show_'+newUserFrom).append('<div class="msg-left"><div class="msg_time">'+ created +'</div> ' + newMessage + '</div>');
}
}

if(currentUser == newUserTo)
{
var mUser = newUserFrom;
}
else {
var mUser = newUserTo;
}
var msgHeight = document.getElementById("msg_box_show_"+mUser).scrollHeight;
$( '#msg_box_show_'+mUser ).scrollTop(msgHeight);
}
}
});

$.ajax({
url: "<?php echo base_url('admin/webchat/readMessages'); ?>",
type: "POST",
data: {userID:chatbox, currentUser:currentUser, _token: '{{csrf_token()}}'},
dataType: "json",
success: function (data) {
if (data.status == 'ok') {
$('#read_status_'+chatbox).attr('readStatus','0');
$('#read_status_fav_'+chatbox).attr('readStatus','0');
$('#read_status_con_'+chatbox).attr('readStatus','0');
$('#read_status_'+chatbox).html(' ');
$('#read_status_fav_'+chatbox).html(' ');
$('#read_status_con_'+chatbox).html(' ');
$('#read_status_poopup_'+chatbox).html(' ');
}
}
});

}
else {
//console.log('Not having value '+chatbox);
}


return false;
} );



$( document ).on( 'click', '.close', function () {

var chatbox = $( this ).parents().parents().attr( "rel" );

$( '[rel="' + chatbox + '"]' ).remove();
arr.splice( $.inArray( chatbox, arr ), 1 );
displayChatBox();
return false;
} );

$( document ).on( 'click', '.green_check_close', function () {
var userID = $( this ).attr( "user_id" );
var chatBoxType = $( this ).attr( "box-close-type" );

// ajax to manage the chat popup stats // 
$.ajax({
url: "<?php echo base_url('admin/webchat/removeBoxStatus'); ?>",
type: "POST",
data: {userID:userID, currentUser:currentUser, _token: '{{csrf_token()}}'},
dataType: "json",
success: function (data) {

if (data.status == 'ok') 
{
	if(chatBoxType == 'webchat'){
		$('#CurrentUserListing').html(' <figure style="margin:15px 0;"><img style="width:16px!important; height:11px!important" id="theImg" src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" /> </figure>');
		$('#CurrentUserListing').removeClass("slick-initialized slick-slider");
		// ajax to list // 
		/*$.ajax({
			url: "{{ url('admin/Chat/getCurrentActivechat/webchat') }}",
			type: "POST",
			data: {userID:userID, currentUser:currentUser},
			dataType: "html",
			success: function (data) {
			setTimeout(function () {
			$('#CurrentUserListing').html(data);
			var options = {
			dots: false,
			infinite: false,
			slidesToShow: 5,
			slidesToScroll: 3,
			}


			$('#CurrentUserListing').slick(options);
			}, 100);

			},error: function(){
			alertMessage('Error: Some thing wrong!');
			}
		});*/
	}else{
		/*
		$('#CurrentSMSUserListing').removeClass("slick-initialized slick-slider");
		// ajax to list // 
		$.ajax({
			url: "{{ url('admin/Chat/getCurrentActivechat/smschat') }}",
			type: "POST",
			data: {userID:userID, currentUser:currentUser},
			dataType: "html",
			success: function (data) {
			setTimeout(function () {
			$('#CurrentSMSUserListing').html(data);
			var options = {
			dots: false,
			infinite: false,
			slidesToShow: 5,
			slidesToScroll: 3,
			}


			$('#CurrentSMSUserListing').slick(options);
			}, 100);

			},error: function(){
			alertMessage('Error: Some thing wrong!');
			}
		});*/
	}
// ajax to list// 




}
}
});
// ajax to manage the chat popup stats // 
var chatbox = $( this ).parents().parents().attr( "rel" );

$( '[rel="' + chatbox + '"]' ).remove();
arr.splice( $.inArray( chatbox, arr ), 1 );
displayChatBox();
return false;
} );



$( ".sidebar_head" ).click( function () {

if($('.sidebar_body').css('display') == 'none')
{
$( "#overlay_chat" ).css("display", "block");
$( "#chat-sidebar" ).addClass('chat_sidebar_close');

}
else{
$( "#overlay_chat" ).css("display", "none");
$( "#chat-sidebar" ).removeClass('chat_sidebar_close');

}

$( ".sidebar_body" ).slideToggle( 'slow' );

});


$('body').on('click',".userinfoicon",function(){
//$(this).parent().next().toggle(500);
$(this).parent().next().animate({width: 'toggle'});
});


$('body').on('click',".userinfoicon2",function(){
$(".usdb").toggle(500);
});



$('body').on('mouseleave', function () {
where = 'out';
});

$('body').on('mouseenter', function () {
where = 'in';
});

$(document).on('click', '#prev_chat', function(e) {

var firElement = arr[0];
arr.shift();
arr.push(firElement);
displayChatBox();
e.stopPropagation();

});

$(document).on('click', '#next_chat', function() {

var lastElement = arr[arr.length - 1];
arr.pop();
arr.unshift(lastElement);
displayChatBox();
});

function displayChatBox() {
i = 340; // start position
j = 340; //next position
var window_witdh = $( window ).width();
var minSlider = 3;

if(window_witdh <= 1400)
{
var minSlider = 3;
}

if(window_witdh > 1600)
	{
	var minSlider = 4;
	}
	
	if(window_witdh > 1900)
	{
	var minSlider = 4;
	}
	if(window_witdh > 2600)
	{
	var minSlider = 5;
	}
	if(window_witdh > 3000)
	{
	var minSlider = 6;
	}
	if(window_witdh > 4000)
	{
	var minSlider = 7;
	}
	
	//console.log($( window ).width() ,'',minSlider,'',arr.length);
	$('.chatSliderPrevBtn').remove();
	//alert(arr.length);
	if(arr.length > minSlider){
	
	$('#next_chat_'+arr[minSlider - 1]).html('<div class="chatSliderPrevBtn"><a id="prev_chat"><i class="icon-arrow-left32 fsize11"></i></a></div>');
	
	if($('#next_chat_'+arr[minSlider - 1]).parent('.cht_min').length > 0) {
	
	$('#next_chat_'+arr[minSlider - 1]).children('.chatSliderPrevBtn').addClass('prv_min');
	}
	else {
	$('#next_chat_'+arr[minSlider - 1]).children('.chatSliderPrevBtn').removeClass('prv_min');
	}
	}
	
	//console.log(arr,'myslider');

	$.each( arr, function ( index, value ) {
	if ( index < minSlider ) {
	$( '[rel="' + value + '"]' ).css( "right", i );
	$( '[rel="' + value + '"]' ).show();
	i = i + j;
	} else {
	$( '[rel="' + value + '"]' ).hide();
	}
	} );
	}
	
	$(document).on('click', '.preview_image_button_cl_sms', function() {
		//alert('test1')
		$('#preview_image_sms').attr('user_id',$(this).attr('user_id'));
		setTimeout(function(){ $('#preview_image_sms').trigger('click');}, 100);
	});
	
	
	$(document).on('change', '#preview_image_sms', function(e) {
	$('.overlaynew').show();
	var userPhoneNo  = $('#preview_image_sms').attr('user_id');
	
	var aToken = Number(userPhoneNo) + Number('<?php echo $loginUserData->mobile; ?>');
	
	if(Number(userPhoneNo) > Number('<?php echo $loginUserData->mobile; ?>')){
		var sToken = Number(userPhoneNo) - Number('<?php echo $loginUserData->mobile; ?>');
		}
		else {
		var sToken = Number('<?php echo $loginUserData->mobile; ?>') - Number(userPhoneNo);
		}
		var newToken = aToken+'n'+sToken;
		
		var avatar = "<?php echo $loginUserData->avatar; ?>";
		if(avatar != ' '){
		avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $loginUserData->avatar; ?>";
		}
		else {
		avatar = "<?php echo base_url('admin_new/images/userp.png'); ?>";
		}
		
		var currentUserName = '<?php echo $loginUserData->firstname . " " . $loginUserData->lastname; ?>';
		const files = document.querySelector('[id=preview_image_sms').files;
		
		const formData = new FormData();
		
		for (let i = 0; i < files.length; i++) {
		let file = files[i];
		formData.append('files[]', file);
		}
		
		fetch('<?php echo base_url("/dropzone/upload_s3_attachment/" . $loginUserData->id . "/smschat"); ?>', { 
		method: 'POST',
		body: formData // This is your file object
		}).then(
		response => response.json() // if the response is a JSON object
			).then(
			success => {
			//console.log(success);                                                                                                                                             
			if(success.error == '') {
			
			var filename = success.result;
			var fileext = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
			var msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+filename;
			
			setTimeout(function(){
			
				if(fileext[0] == 'mp4' || fileext[0] == 'webm' || fileext[0] == 'ogg') {
					$.ajax({
					
					url: "{{ url('admin/smschat/sendMsg') }}",
					
					type: "POST",
					data: {'phoneNo' : userPhoneNo, 'messageContent' : msg,'smstoken': newToken, 'moduleName' : 'chat', 'media_type': 'video', 'videoUrl': 'send'},
					dataType: "html",
					success: function (data) {
					SMSChatData(userPhoneNo,userPhoneNo,'');
					$('.sms_twr_'+userPhoneNo).find('.slider-phone').html('File Attachment');
		            //$(this).val('');
					
					},error: function(){
					alertMessage('Error: Some thing wrong!');
					}
					});
				}
				else {
					$.ajax({
					
					url: "{{ url('admin/smschat/sendMMS') }}",
					
					type: "POST",
					data: {'phoneNo' : userPhoneNo, 'messageContent' : msg,'smstoken': newToken, 'moduleName' : 'chat', 'media_type': 'image', 'videoUrl':''},
					dataType: "html",
					success: function (data) {
					SMSChatData(userPhoneNo,userPhoneNo,'');
					$('.sms_twr_'+userPhoneNo).find('.slider-phone').html('File Attachment');
		            //$(this).val('');
					
					},error: function(){
					alertMessage('Error: Some thing wrong!');
					}
					});
				}
			
			}, 3000);
			
			
			}
			else {
			/// alert show box
			}
			
			
			} // Handle the success response object
			).catch(
			error => console.log(error) // Handle the error response object
			);
			
			setTimeout(function(){
			$('.overlaynew').hide();
			}, 4000);

			$('#preview_image_sms').remove();
			$('.file_sms_web').append('<input style="display:none;" id="preview_image_sms" user_id="" type="file">');
			

			});
			
			
			
			$(document).on('click', '.preview_image_button_cl_web', function() {
			$('#preview_image_web').attr('user_id',$(this).attr('user_id'));
			setTimeout(function(){ $('#preview_image_web').trigger('click');}, 100);
			});
			
			
			$(document).on('change', '#preview_image_web', function(e) {
			$('.overlaynew').show();
			var chatTo  = $('#preview_image_web').attr('user_id');
			
			var aToken = Number(chatTo) + Number(currentUser);
			if(Number(chatTo) > Number(currentUser)){
			var sToken = Number(chatTo) - Number(currentUser);
			}
			else {
			var sToken = Number(currentUser) - Number(chatTo);
			}
			
			var newToken = aToken+'n'+sToken;
			
			var avatar = "<?php echo $loginUserData->avatar; ?>";
			if(avatar != ' '){
			avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $loginUserData->avatar; ?>";
			}
			else {
			avatar = "<?php echo base_url('admin_new/images/userp.png'); ?>";
			}
			
			var currentUserName = '<?php echo $loginUserData->firstname . " " . $loginUserData->lastname; ?>';
			const files = document.querySelector('[id=preview_image_web').files;
			
			const formData = new FormData();
			
			for (let i = 0; i < files.length; i++) {
			let file = files[i];
			formData.append('files[]', file);
			}
			
			fetch('<?php echo base_url("/dropzone/upload_s3_attachment/" . $loginUserData->id . "/webchat"); ?>', { 
			method: 'POST',
			body: formData // This is your file object
			}).then(
			response => response.json() // if the response is a JSON object
				).then(
				success => {
				console.log(success);                                                                                                                                            
				if(success.error == '') {
				
				var filename = success.result;
				var fileext = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
				var msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+filename;
				setTimeout(function(){
				
				if(typeof fileext != 'undefined' && fileext !== null){
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
				}
				socket.emit('subscribe',newToken);
				socket.emit('chat_message', {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, currentUserName:currentUserName, avatar:avatar });
				
				
				msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+filename;
				$.ajax({
				url: "<?php echo base_url('admin/webchat/addChatMsg'); ?>",
				type: "POST",
				data: {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
				if (data.status == 'ok') {

				// $('#ldBar_'+chatTo).hide();
				}
				}
				});
				
				
				}, 3000);
				
				
				}
				else {
				/// alert show box
				}
				
				
				} // Handle the success response object
				).catch(
				error => console.log(error) // Handle the error response object
				);
				
				setTimeout(function(){
				$('.overlaynew').hide();
				}, 4000);

				$('#preview_image_web').remove();
				$('.file_sms_web').append('<input style="display:none;" id="preview_image_web" user_id="" type="file">');
			    
				});
				
				
				socket.on('messageTresponse', function(data) {
				var newMessage = data.msg;
				var fileext = (/[.]/.exec(newMessage)) ? /[^.]+$/.exec(newMessage) : undefined;
				if(typeof fileext != 'undefined' && fileext !== null){
				if(fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') 
				{
				newMessage = "<a href='"+newMessage+"' class='previewImage' target='_blank'><img src='"+newMessage+"' height='58px' width='58px' /></a>";
				$('.sms_twr_'+data.from).find('.slider-phone').html('File Attachment');
				}
				else if(fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
				newMessage = "<a href='"+newMessage+"' target='_blank'>Download '"+fileext[0].toUpperCase()+"' File</a>";
				$('.sms_twr_'+data.from).find('.slider-phone').html('File Attachment');
				}
				else if(fileext[0] == 'mp4' || newMessage.indexOf('/Media/') != -1) {
					newMessage = "<video width='100' height='100' controls><source src='"+newMessage+"' type='video/"+fileext[0]+"'></video>";
					$('.sms_twr_'+data.from).find('.slider-phone').html('File Attachment');
				}
				}

				if(data.showVideo != '')
				{
					$('<li class="media"><div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>'+data.avatar+'</span>' + nl2br(newMessage) + '</div></li>' ).insertBefore( '[tWR="' + data.from + '"] .msg_push' );
				}
				else {
					$('<li class="media"><div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>'+data.avatar+'</span><div class="media-content">' + nl2br(newMessage) + '</div></div></li>' ).insertBefore( '[tWR="' + data.from + '"] .msg_push' );
				}
				
				
				

                 setTimeout(function(){
				var msgHeight = document.getElementById("smsSearcharea").scrollHeight;
				$( '#smsSearcharea' ).scrollTop(msgHeight);
				
				var msgHeight = document.getElementById("sms_box_show_"+data.from).scrollHeight;
				$( "#sms_box_show_"+data.from ).scrollTop(msgHeight);
                    } , 500);

				
				});
				
				socket.on('chat_message_status_show', function(data){
				
				if(currentUser == data.chatTo){
				if(data.msg != '' && data.status == 'show'){
				$('#msg_status_show_'+data.currentUser).html(data.currentUserName+' is typing...');
				}
				else {
				$('#msg_status_show_'+data.currentUser).html('&nbsp;');
				}
				}
				
				});

				socket.on('unassign_chat_show', function(data) {
					
					//console.log(data);
					$('.unassigned_show').html(data.unAssCount);
					$('.unassigned_chat').val(data.countUnassign);
					$('.un_list div.tk_'+data.room).remove();
					$('.un_list_small div.tk_'+data.room).remove();
				});
				
				
				socket.on('userLoginStatus', function(data) {
				
				$('#user_status_'+data.userId).html('<i class="fa fa-circle login"></i>');
				$('#user_status_fav_'+data.userId).html('<i class="fa fa-circle login"></i>');
				$('#user_status_con_'+data.userId).html('<i class="fa fa-circle login"></i>');
				
				var options = {
				title: data.currentUserName,
				options: {
				body: 'Login',
				icon: data.avatar,
				lang: 'en-US'
				}
				};
				
				if(data.userId != currentUser) {
				//$("#easyNotify").easyNotify(options);
				/*notif({
				type: "success",
				msg: data.currentUserName+" is login",
				position: "right",
				time: 500
				});*/ 
				}
				else {
				$.ajax({
				url: "{{ url('admin/webchat/changeLoginStatus') }}",
				type: "POST",
				data: {userId:data.userId, status: '1', _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
				if (data.status == 'ok') {
				
				}
				}
				});
				}
				
				});
				
				socket.on('userLogoutStatus', function(data) {
				
				//console.log(data);
				$('#user_status_'+data.userId).html('<i class="fa fa-circle logout"></i>');
				$('#user_status_fav_'+data.userId).html('<i class="fa fa-circle logout"></i>');
				$('#user_status_con_'+data.userId).html('<i class="fa fa-circle logout"></i>');
				
				var options = {
				title: data.user_name,
				options: {
				body: 'Logout',
				icon: data.user_avatar,
				lang: 'en-US'
				}
				};
				
				if(data.userId != currentUser) {
				//$("#easyNotify").easyNotify(options);
				/*notif({
				type: "warning",
				msg: data.user_name+" is logout",
				position: "right",
				time: 500
				});*/
				}
				
				$.ajax({
				url: "{{ url('admin/webchat/changeLoginStatus') }}",
				type: "POST",
				data: {userId:data.userId, status: '0', _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
				if (data.status == 'ok') {
				
				}
				}
                });
				
				});
				
				/* support user */  
				
				socket.on('support_user_created', function(data) {
				
			    WidgetplaySound();

				var SupportUsername  = data.support_name;
				var dataname = SupportUsername.split(" ");
				var fname = 'A';
				var lname = '';
				
				if(dataname[0] != '' && dataname[0] !== undefined){
				fname = dataname[0].charAt(0);
				}
				//console.log(dataname[1], 'last name');
				if(dataname[1] != '' && dataname[1] !== undefined){
				lname = dataname[1].charAt(0);
				}
				
				var userID = data.support_id;
				
			    var aToken = Number(userID) + Number(currentUser);
				
				if(Number(userID) > Number(currentUser)){
				var sToken = Number(userID) - Number(currentUser);
				}
				else {
				var sToken = Number(currentUser) - Number(userID);
				}
				
				var newToken = aToken+'n'+sToken;
				
				socket.emit('subscribe',newToken);
				
				
				var supportDetail = `<div class="sidebar-user-box" id="sidebar-user-box-${data.support_id}" user_id="${data.support_id}">
					<div class="avatarImage"><span class="icons fl_letters s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:11px;">${fname +''+ lname} </span></div>
					
					<span class="slider-username contacts">${data.support_name}</span>
					 

					<span id="Small_assign_message_${data.support_id}" class="slider-phone contacts text-size-small txt_gray msg_${newToken}">${data.msg.substring(0,20)}</span>
					<span id="Small_assign_${data.support_id}" class="slider-phone contacts text-size-small"></span>
					
					<span style="display: none;" class="slider-email contacts">${data.email}</span>
					
					<span style="display: none;" class="slider-image img">
					</span>
					
					<span class="user_status"><time class="autoTimeUpdate autoTime_${data.support_id}" datetime="${data.currentTime}">1 second ago</time></span>

					<!--box hover chat details -->   
					<div class="user_details p0">
						<div class="row">
							<div class="col-md-12">
								<div class="header_sec"> <i class="icon-info22 txt_blue"></i>${data.support_name}</div>
								<div class="sidebar_info p20 text-center">
									<span class="icons fl_letters s32" style="width:60px!important;height:60px!important;line-height:28px;font-size:21px;">${fname +''+ lname}</span>
									<h3 class="mb0">${data.support_name}</h3>
									
									
								</div>
								<div class="p20 pt0 pb10">
									<div class="interactions p0 pt10 pb10 btop">
										<ul>
											<li><i class="fa fa-envelope"></i><strong>${data.email}</strong></li>
											
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
				</div>`;
				
				var supportDetailBigChat=`<div class="activityShow 0 media chatbox_new bkg_white " style="">
		    <a href="javascript:void(0);" incid="" class="media-link bbot tk_${newToken} getChatDetails WebBoxList activechat" userid="${data.support_id}" assign_to="" rwebid="${newToken}">
		        <div class="media-left"><span class="icons fl_letters s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:12px;">${fname +''+ lname}</span><span class="favouriteSMSUser" incid="" userid="${data.support_id}"><i class="fa fa-star star_icon "></i></span>
		        </div>

		        <div class="media-body">
		            <span class="fsize12 txt_dark">${data.support_name}</span>

		            <span id="Big_assign_${data.support_id}" class="contacts text-size-small" style="color:#6a7995!important;"></span>

		            <span id="Big_assign_message_${data.support_id}" class="slider-phone contacts txt_dark" style="margin:0px;color: #6a7995!important; font-weight:bold; font-size:12px!important">${data.msg.substring(0,20)}</span>

		            <span class="fsize12 txt_dark"></span>

		        </div>
		        <div class="media-right" style="width:90px;"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_${data.support_id}" id="autoTime_${data.support_id}" datetime="${data.currentTime}">1 second ago</time></span></div>

		    </a>
		</div>`;

				//console.log(data.msg.substring(0,20));
				/*$('#Big_assign_message_'+data.support_id).html(data.msg.substring(0,20));
				$('#Small_assign_message_'+data.support_id).html(data.msg.substring(0,20));
				$('#Big_assign_message_'+data.UserID).html(data.msg.substring(0,20));
				$('#Small_assign_message_'+data.UserID).html(data.msg.substring(0,20));*/
				
				var unassigned_chat = $('.unassigned_chat').val();
				var unAssCount = Number(unassigned_chat) + 1;
				$('.unassigned_chat').val(unAssCount);
				$('.unassigned_show').html("Unassigned ("+ unAssCount +")");

				var allChat = $('.allChatC').val();
				var allChatCount = Number(allChat) + 1;
				$('.allChatC').val(allChatCount);
				$('.allChatShow').html("All ("+ allChatCount +")");

				if(data.UserID == currentUser){
					$('.activeChatList').prepend(supportDetail);
					$('.activeChatListBigchat').prepend(supportDetailBigChat);
	                setTimeout(function(){ 
						$(".autoTimeUpdate").timeago();
	                	$('#sidebar-user-box-'+userID).trigger('click'); 
	                	$('.tk_'+newToken).trigger('click');
	                }, 1000);
				}

				$('.you_list_small #sidebar-user-box-'+userID).remove();
				
				
				});

           

         socket.on('team_data_show', function(data){
              //console.log(data);

              if(data.msg.indexOf('<img') != -1){
			      var dmessage = 'File Attachment';
				}
				else
				{
					var dmessage = data.msg.substring(0,20);
					var big_message = data.msg.substring(0,80);
				}
			
			var currentDayNew = new Date();
			var currentDateNew = currentDayNew.getFullYear()+'-'+((currentDayNew.getMonth() + 1) < 10 ? '0' : '') + (currentDayNew.getMonth() + 1)+'-'+(currentDayNew.getDate() < 10 ? '0' : '') + currentDayNew.getDate();
			var currentTimeNew = (currentDayNew.getHours() < 10 ? '0' : '') + currentDayNew.getHours() + ":" + (currentDayNew.getMinutes() < 10 ? '0' : '') + currentDayNew.getMinutes() + ":" + (currentDayNew.getSeconds() < 10 ? '0' : '') + currentDayNew.getSeconds();
			
			var dateTimeNew = currentDateNew+' '+currentTimeNew;

            $('#next_chat_'+data.chatTo).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;float:left">Assigned to:&nbsp </span><span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;">'+data.teamName+'</span>');

            $('#Big_assign_'+data.chatTo).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;float:left;color:#6a7995!important;">Assigned to:&nbsp </span>'+data.teamName);
            $('#Big_assign_message_'+data.chatTo).html(big_message); 
			
            $('#b_assign_'+data.chatTo).html(big_message);
             $('#Small_assign_'+data.chatTo).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;float:left">Assigned to:&nbsp </span>'+data.teamName);
			 
             $('#Small_assign_message_'+data.chatTo).html(dmessage);
             $('#Small_You_assign_message_'+data.chatTo).html(dmessage);
			 
			 $('.getChatDetails[userid="'+data.chatTo+'"] .media-right .date_time time').remove();
			 $('.getChatDetails[userid="'+data.chatTo+'"] .media-right .date_time').prepend('<time class="autoTimeUpdate autoTime_'+data.chatTo+'" datetime="'+dateTimeNew+'">1 second ago</time>');
			 
			 $('#sidebar-user-box-'+data.chatTo+' .user_status time').remove();
			 $('#sidebar-user-box-'+data.chatTo+' .user_status').prepend('<time class="autoTimeUpdate autoTime_'+data.chatTo+'" datetime="'+dateTimeNew+'">1 second ago</time>');
			 
			 //$('.autoTime_'+data.chatTo).html('1 second ago');
			//$('.autoTime_'+data.chatTo).attr('datetime', dateTimeNew);
			//$('.autoTime_'+data.chatTo).attr('title', dateTimeNew);
			
			
			
			$('.autoTime_'+data.chatTo).timeago();
			
             $('#bigwebassign_'+data.chatTo).html('<span style=" font-weight:300!important; color:#6a7995!important; font-size:11px!important;">Assigned to:&nbsp </span>'+data.teamName);
             $('#sidebar-user-box-'+data.chatTo).attr('assign_to',data.teamName);
             $('.tk_'+data.room).attr('assign_to',data.teamName);

             $('#bigwebassignInit_'+data.chatTo).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;"></span>'+data.teamName);


          });



         socket.on('reassign_post_data_show', function(data){

              $('#Big_assign_'+data.user_id).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;float:left;color:#6a7995!important;">Assigned to:&nbsp </span>'+data.assign_to_name);
       
             $('#Small_assign_'+data.user_id).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;float:left">Assigned to:&nbsp </span>'+data.assign_to_name);

              $('#bigwebassign_'+data.user_id).html('<span style="color: #6a7995!important; font-size: 12px!important; font-weight: 300!important">Assigned to:&nbsp </span>'+data.assign_to_name);

              $('#bigwebassignInit_'+data.user_id).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;"></span>'+data.assign_to_name);

              $('#next_chat_'+data.user_id).html('<span style="font-weight:300!important; color:#6a7995!important; font-size:11px!important;">Assigned to:&nbsp '+data.assign_to_name +'</span>');
              $('.you_list div.tk_'+data.room).remove();
              $('.default').removeClass('active');
              $('.forceunassign a').removeClass('active');
               $(".team_active_"+data.assign_to).addClass('active');

               if(data.assign_from == '0' || data.assign_from=="")
               {
               var unassigned_chat = $('.unassigned_chat').val();
				var unAssCount = Number(unassigned_chat) - 1;
				$('.unassigned_chat').val(unAssCount);
				$('.unassigned_show').html("Unassigned ("+ unAssCount +")");
			    }


             

             var assign_to_you_count = $('#assigned_chat_'+data.assign_to).val();
            // console.log('prev'+assign_to_you_count,data.assign_to);
             var assign_from_you_count = $('#assigned_chat_'+data.assign_from).val();
              assign_to_you_count = Number(assign_to_you_count) +1;
              assign_from_you_count = Number(assign_from_you_count) -1;

              $('.assigned_show_'+data.assign_to).html("You ("+ assign_to_you_count +")");
              $('.assigned_show_'+data.assign_from).html("You ("+ assign_from_you_count +")");
              $('#assigned_chat_'+data.assign_to).val(assign_to_you_count);
              $('#assigned_chat_'+data.assign_from).val(assign_from_you_count);



          });


	socket.on('forceunassign_post_data_show', function(data){
		//console.log(data);

	$('#Big_assign_'+data.user_id).html('');

	$('#Small_assign_'+data.user_id).html('');
    $('#bigwebassign_'+data.user_id).html('');

	$('#bigwebassignInit_'+data.user_id).html('');
	$('.initUnassigned').html('Unassigned');
	$('.default').removeClass('active');
	$('.forceunassign a').addClass('active');

	$('#next_chat_'+data.user_id).html('');
	$('.you_list div.tk_'+data.room).remove();
	//$('.activityShow .tk_'+data.room).remove();
	//$('.un_list div.tk_'+data.room).remove();

    if(data.preTeamId == data.user_id)
    {
		var assign_to_you_count = $('#assigned_chat_'+data.user_id).val();
		assign_to_you_count = Number(assign_to_you_count) -1;
		$('.assigned_show_'+data.user_id).html("You ("+ assign_to_you_count +")");
		$('#assigned_chat_'+data.user_id).val(assign_to_you_count);
    }

	// console.log('prev'+assign_to_you_count,data.user_id);


	var unassigned_count = $('.unassigned_chat').val();
	unassigned_count = Number(unassigned_count)+1;
	$('.unassigned_show').html('Unassigned ('+ unassigned_count +')');
	$('.unassigned_chat').val(unassigned_count);

	



	});

				


		socket.on('wait_new_message', function(data) {



		 	if($('#msg_box_show_'+data.currentUser).hasClass('typing_messsage')) {

		 	} 
		 	else {

				setTimeout(function() {
					$('.loading_message_li_'+data.currentUser).remove();
					$('#msg_box_show_'+data.currentUser).removeClass('typing_messsage');
				}, data.wait);
		 		
		 		$('#msg_box_show_'+data.currentUser).append( `<li class="media loading_message_li_${data.currentUser}" style="height: 43px;padding-top: 10px;"><img src="{{ URL::asset('assets/images/messageloading.gif') }}" style="height: 25px;"></li>`);
			 	if(currentUser == data.chatTo)
				{
					var mUser = data.currentUser;
				}
				else {
					var mUser = data.chatTo;
				}
				setTimeout(function() {
					var msgHeightMain = document.getElementById("msg_box_show_"+mUser).scrollHeight;
					$( '#msg_box_show_'+mUser ).scrollTop(msgHeightMain);
				}, 200);
		 	}

		 	if($('#WebChatTextarea_'+data.currentUser).hasClass('typing_messsage')) {

		 	} 
		 	else {

		 		setTimeout(function() {
					$('.loading_message_big_li_'+data.currentUser).remove();
					$('#WebChatTextarea_'+data.currentUser).removeClass('typing_messsage');
				}, data.wait);

		 		$('#WebChatTextarea_'+data.currentUser).append( `<li class="media loading_message_big_li_${data.currentUser}" style="height: 43px;padding-top: 10px;"><img src="{{ URL::asset('assets/images/messageloading.gif') }}" style="height: 25px;"></li>`);
			 	if(currentUser == data.chatTo)
				{
					var mUser = data.currentUser;
				}
				else {
					var mUser = data.chatTo;
				}
				setTimeout(function() {
					var msgHeightMain = document.getElementById("WebChatTextarea_"+mUser).scrollHeight;
					$( '#WebChatTextarea_'+mUser ).scrollTop(msgHeightMain);
				}, 200);
		 	}

		 	$('#WebChatTextarea_'+data.currentUser).addClass('typing_messsage');
		 	$('#msg_box_show_'+data.currentUser).addClass('typing_messsage');
		 	
						 
		 });
				
				/* support user end */
				
			socket.on('chat message', function(data){
				var chat_user_id = '';
				/*------ remove the loading message -----*/ 
				if(data.chatTo.length > 10) {
					$('.loading_message_li_'+data.chatTo).remove();
					chat_user_id = data.chatTo;
				} 
				else {
					$('.loading_message_li_'+data.currentUser).remove();
					chat_user_id = data.currentUser;
				}
				
				if(currentUser != data.currentUser) {
					$('#msg_box_show_'+data.currentUser).removeClass('typing_messsage');
				}
				/*---- end remove the loading message ---*/
					
			    var msg = data.msg;
			    var msg_noti = data.msg;
			    var teamId = data.teamId;
			    var teamName = data.teamName;
			    var dmessage;

				if(data.msg.indexOf('<img') != -1){
			      	dmessage = 'File Attachment';
				}
				else if(data.msg.indexOf('<video') != -1){
					console.log('file attachment');
			     	dmessage = 'File Attachment';
				}
				else
				{
					dmessage = msg.substring(0,20);
				}
				
				var currentDayNew = new Date();
				var currentDateNew = currentDayNew.getFullYear()+'-'+((currentDayNew.getMonth() + 1) < 10 ? '0' : '') + (currentDayNew.getMonth() + 1)+'-'+(currentDayNew.getDate() < 10 ? '0' : '') + currentDayNew.getDate();
				var currentTimeNew = (currentDayNew.getHours() < 10 ? '0' : '') + currentDayNew.getHours() + ":" + (currentDayNew.getMinutes() < 10 ? '0' : '') + currentDayNew.getMinutes() + ":" + (currentDayNew.getSeconds() < 10 ? '0' : '') + currentDayNew.getSeconds();
				
				var dateTimeNew = currentDateNew+' '+currentTimeNew;

                $('#Big_assign_message_'+chat_user_id).html(dmessage);
				$('#Small_assign_message_'+chat_user_id).html(dmessage);
				$('#Small_You_assign_message_'+chat_user_id).html(dmessage);
				
				$('.getChatDetails[userid="'+chat_user_id+'"] .media-right .date_time time').remove();
				$('.getChatDetails[userid="'+chat_user_id+'"] .media-right .date_time').prepend('<time class="autoTimeUpdate autoTime_'+chat_user_id+'" datetime="'+dateTimeNew+'">1 second ago</time>');
				
				$('#sidebar-user-box-'+chat_user_id+' .user_status time').remove();
				$('#sidebar-user-box-'+chat_user_id+' .user_status').prepend('<time class="autoTimeUpdate autoTime_'+chat_user_id+'" datetime="'+dateTimeNew+'">1 second ago</time>');
			
				$('.autoTime_'+chat_user_id).timeago();
			 
                //$('.autoTime_'+chat_user_id).html('1 second ago');
                //$('.autoTime_'+chat_user_id).attr('datetime', dateTimeNew);
				
				//$('.autoTimeUpdate').timeago();
				
				$('#sidebar-user-box-'+chat_user_id+' .slider-phone.txt_dark').html(dmessage);
				$('#sidebar-user-box-'+chat_user_id+' .slider-phone.txt_gray').html(dmessage);
				$('#sidebar-user-box-main-'+chat_user_id+' .slider-phone').html(dmessage);
				//console.log(data, 'chat data');
				
				var profileImg = '';
				if(data.avatar == '' || data.avatar === undefined){
				var fname = 'A';
				var lname = '';
				
				var SupportUsername  = data.currentUserName;
				
				
				var dataname = SupportUsername.split(" ");
				if(dataname[0] != '' && dataname[0] !== undefined){
				fname = dataname[0].charAt(0);
				}
				
				if(dataname[1] != '' && dataname[1] !== undefined){
				lname = dataname[1].charAt(0);
				}
				
				profileImg = `<span class="icons fl_letters s32" style="width:28px!important;height:28px!important;line-height:28px;font-size:11px;">${fname}${lname}</span>`;
				}else{
				profileImg = `<span class="icons s32"><img src="${data.avatar}" onerror="this.src="{{ URL::asset('assets/images/default_avt.jpeg') }}" class="img-circle" alt="" width="24" height="24"></span>`;
				}
				
				var userID = data.support_id;
				
				
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
					
					$( '#msg_box_show_'+chatbox ).append( `<li class="media reversed">
						<div class="media-body"> <span class="media-annotation user_icon">${profileImg}</span><div class="media-content">${nl2br(msg)}</div></div>
					</li>`);

					if($('#msg_box_show_'+chatbox).hasClass('typing_messsage')) {
						
				 		$('#msg_box_show_'+chatbox).append( `<li class="media loading_message_li_${chatbox}" style="height: 43px;padding-top: 10px;"><img src="{{ URL::asset('assets/images/messageloading.gif') }}" style="height: 25px;"></li>`);
				 	}
					
					var msgHeight = document.getElementById("msg_box_show_"+mUser).scrollHeight;
					$( '#msg_box_show_'+mUser ).scrollTop(msgHeight);
				
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
					var msgBox = $('#msg_box_'+chatbox).attr( "rel" );
					if($('#msg_box_'+chatbox).css('display') == 'none' || $('#msg_box_'+chatbox).find('.msg_wrap').css('display') == 'none')
					{
						var readStatus = $('#read_status_'+chatbox).attr('readStatus');
						readStatus = Number(readStatus) + 1;
						$('#read_status_'+chatbox).attr('readStatus',readStatus);
						$('#read_status_'+chatbox).html('<span class="badge bg-success">'+readStatus+'</span>');
						
						$('#read_status_poopup_'+chatbox).html('<span class="readStatusCount">'+readStatus+'</span>');
						
						var readStatusFav = $('#read_status_fav_'+chatbox).attr('readStatus');
						readStatusFav = Number(readStatusFav) + 1;
						$('#read_status_fav_'+chatbox).attr('readStatus',readStatusFav);
						$('#read_status_fav_'+chatbox).html('<span class="badge bg-success">'+readStatusFav+'</span>');
						
						var readStatusCon = $('#read_status_con_'+chatbox).attr('readStatus');
						readStatusCon = Number(readStatusCon) + 1;
						$('#read_status_con_'+chatbox).attr('readStatus',readStatusCon);
						$('#read_status_con_'+chatbox).html('<span class="badge bg-success">'+readStatusCon+'</span>');
						
						playSound();
						$("#easyNotify").easyNotify(options);
						var msgHeight = document.getElementById("msg_box_show_"+mUser).scrollHeight;
						$( '#msg_box_show_'+mUser ).scrollTop(msgHeight);
						
					}
					else {
					
						if (typeof msgBox === "undefined") {
						setTimeout(function(){ 
						$('#sidebar-user-box-'+chatbox).trigger('click');
						playSound();
						$("#easyNotify").easyNotify(options);
						var msgHeight = document.getElementById("msg_box_show_"+mUser).scrollHeight;
						$( '#msg_box_show_'+mUser ).scrollTop(msgHeight);
						}, 1000);
						
						}
						else if(where == 'out') {
						
						$('#msg_box_show_'+chatbox).append(`<li class="media team_user_${chatbox}">
							<div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span> 
							${profileImg}</span>
							<div class="media-content">${nl2br(msg)}</div>							
							</div>
						</li>`);
						
						playSound();
						$("#easyNotify").easyNotify(options);
						var msgHeight = document.getElementById("msg_box_show_"+mUser).scrollHeight;
						$( '#msg_box_show_'+mUser ).scrollTop(msgHeight);
						
						
						}
						else {
						
						
						$('#msg_box_show_'+chatbox).append(`<li class="media team_user_${chatbox}">
							<div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span> 
							${profileImg}</span>
							<div class="media-content">${nl2br(msg)}</div>							
							</div>
						</li>`);
						
						
						//playSound();
						var msgHeight = document.getElementById("msg_box_show_"+mUser).scrollHeight;
						$( '#msg_box_show_'+mUser ).scrollTop(msgHeight);
						
						
						}
						
						setTimeout(function(){ 
						
						$.ajax({
						url: "<?php echo base_url('admin/Chat/readChatMsg'); ?>",
						type: "POST",
						data: {chatTo:data.chatTo, chatFrom:data.currentUser},
						dataType: "json",
						success: function (data) {
						if (data.status == 'ok') {
							
						}
						}
						});
						
						}, 500);

					}	
				}
				}
				});
				
				
				$( document ).on( 'keyup', '.webchat .msg_input', function ( e ) {
				
				var currentUserName = "<?php echo $loginUserData->firstname; ?>  <?php echo $loginUserData->lastname; ?>";
				var avatar = "<?php echo $loginUserData->avatar; ?>";
				if(avatar != ' '){
				avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $loginUserData->avatar; ?>";
				}
				else {
				avatar = "";
				}

				var chatTo =  $(this).attr("user_id");
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
					if(e.keyCode == 191)
					{
						
					$.ajax({
					url: "<?php echo base_url('admin/smschat/small_shortcutListing'); ?>",
					data:{'boxid':chatTo, _token: '{{csrf_token()}}'},
					type: "POST",
					dataType: "html",
					success: function (data) {
					$('#shortcutBox_'+chatTo).html(data);
					$('#chtshortcut_'+chatTo).toggle();
					$('#chtshortcut_'+chatTo+' #Search_shortcut_web').focus();
					}
					});
					}
					else if(e.keyCode == 8)
					{
					$('#chtshortcut_'+chatTo).hide();
					}

				
				else if (e.keyCode == 13 && e.shiftKey) {
				var content = this.value;
				var caret = getCaret(this);
				this.value = content.substring(0,caret)+"\n"+content.substring(carent,content.length-1);
				event.stopPropagation();
				
				}
				else if ( e.keyCode == 13 ) {
				$('#chtshortcut_'+chatTo).hide();

				var msg = $( this ).val();
				 msg = msg.replace('/','');
				var teamId = '<?php echo $teamMemberId; ?>';
				var teamName = '<?php echo $teamMemberName; ?>';
				//var userImage = $('#Webonly #em_image').val();
				
				
				
				var msg = msg.trim();
				$('.webchat .msg_input').val('');	
				if(msg.length > 0 ){
				socket.emit('subscribe',newToken);
				socket.emit('chat_message', {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, currentUserName:currentUserName, avatar:avatar, teamId:teamId, teamName:teamName });
				$(this).val('');
				$.ajax({
				url: "<?php echo base_url('admin/webchat/addChatMsg'); ?>",
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

						socket.emit('unassign_chat_count', {room:newToken, unAssCount:"Unassigned ("+ unAssCount +")", teamName:teamName, chatTo:chatTo, countUnassign:unAssCount });
					}
					
				
					socket.emit('team_post_data', {room:newToken, chatTo:chatTo, currentUser:currentUser,teamName:data.isLoggedInTeam,msg:msg });
				}
				
				setTimeout(function(){ 
				var msgHeight = document.getElementById("msg_box_show_"+chatTo).scrollHeight;
				$( "#msg_box_show_"+chatTo).scrollTop(msgHeight);
				}, 500);
				
				}
				});
				}
				return false;
				}
				});
				
				
				
				
				$( document ).on( 'click', '.webChatTrigger', function ( e ) {
				var currentUserName = "<?php echo $loginUserData->firstname; ?>  <?php echo $loginUserData->lastname; ?>";
				var avatar = "<?php echo $loginUserData->avatar; ?>";
				if(avatar != ' '){
				avatar = "<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $loginUserData->avatar; ?>";
				}
				else {
				avatar = "";
				}
				

				
				
				var chatTo =  $(this).attr("user_id");
				var msg = $( '#msg_input_web_'+chatTo ).val();
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
				$('.webchat .msg_input').val('');	
				if(msg.length > 0 ){
				socket.emit('subscribe',newToken);
				socket.emit('chat_message', {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, currentUserName:currentUserName, avatar:avatar });
				$(this).val('');
				$.ajax({
				url: "<?php echo base_url('admin/webchat/addChatMsg'); ?>",
				type: "POST",
				data: {room:newToken, msg:msg, chatTo:chatTo, currentUser:currentUser, _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
				if (data.status == 'ok') {
				
				}
				
				setTimeout(function(){ 
				var msgHeight = document.getElementById("msg_box_show_"+chatTo).scrollHeight;
				$( "#msg_box_show_"+chatTo).scrollTop(msgHeight);
				}, 500);
				
				}
				});
				}
				return false;
				});
				
				
				
				
				});
				
				
				
				$(document).ready(function() {
				
				$('.searchInput').on("keyup", function() {
				var textInput = $( this ).val().toLowerCase();
				$( '.searchInput' ).val(textInput);
				
				$("#testDiv6 .all_user_chat").filter(function() {
				$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
				});
				
				$("#allContactList .all_user_chat").filter(function() {
				$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
				});
				
				
				$("#combineList .all_user_chat").filter(function() {
				$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
				});
				
				
				$("#oldestChatlistChat .all_user_chat").filter(function() {
				$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
				});
				
				
				$("#waitingchatlist .all_user_chat").filter(function() {
				$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
				});
				
				
				
				$("#testDiv7 .sidebar-user-box-heading").filter(function() {
				//if(textInput.length > 1) {
				$(this).toggle($(this).text().toLowerCase().indexOf(textInput.charAt(0))  > -1);
				//}
				});
				$("#testDiv7 .all_user_chat").filter(function() {
				$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
				});
				$("#testDiv8 .all_user_chat").filter(function() {
				$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
				});
				
				});
				
				
				
				});
				
				
				
			</script>
			<?php
function phoneDisplay($num) {
    $num = preg_replace('/[^0-9]/', '', $num);
    $len = strlen($num);
    if ($len == 11 && substr($num, 0, 1) == '1') {
        return substr($num, 1, 10);
    }
    return $num;
}
function mobileNoFormatChat($mobileNo) {
    if (!isset($mobileNo{3})) {
        return '';
    }
    // note: strip out everything but numbers
    $mobileNo = preg_replace("/[^0-9]/", "", $mobileNo);
    $length = strlen($mobileNo);
    switch ($length) {
        case 7:
            return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $mobileNo);
        break;
        case 10:
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $mobileNo);
        break;
        case 11:
            return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "($2) $3-$4", $mobileNo);
        break;
        case 12:
            return preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})/", "($2) $3-$4", $mobileNo);
        break;
        default:
            return $mobileNo;
        break;
    }
}
$totalSubscriber_schat = getMyContact();
//$fUser = getsms_subscriber($loginUserData->id);
//pre($fUser);
$fUser = getsms_subscriber($loginUserData->id);
$oldchat_list = activeOnlywebOldchatlist($loginUserData->id);
$WaitingChatlist = WaitingChatlist($loginUserData->id);
$fUserCount = count((array)$fUser);
$activeOnlyweb = activeOnlyweb($loginUserData->id);
$activeChatCount = count((array)$activeOnlyweb);
$asginChatlist = getTeamAssignDataHelper($teamLogin_id);
$unassignChatlist = getTeamUnAssignDataHelper();
$Favorites_list = getFavlist($loginUserData->id);
/* sms */
$a_s_list = activeOnlysms($loginUserData->mobile); // here we place client twilio number
$o_s_list = SmsOldest($loginUserData->mobile);
$w_s_list = SmsWaitlinglonest($loginUserData->mobile);
$activeChatSmsCount = count((array)$a_s_list);
//$favouriteUserDataCount = count((array)$favouriteUserData);
$getactiveChatboxlisting = getactiveChatbox($loginUserData->id);
if ($isLoggedInTeam) {
    $hasweb_access = getMemberchatpermission($isLoggedInTeam);
    $has_web = $hasweb_access->web_chat;
    $has_sms = $hasweb_access->sms_chat;
    if ($has_web) {
        $activeWebClass = 'active';
    } else if ($has_sms) {
        $activeSmsClass = 'active';
    }
} else {
    $has_web = 1;
    $has_sms = 1;
    $activeWebClass = 'active';
    $activeSmsClass = '';
}
?>
			
			<div class="file_sms_web">
				<input style="display:none;" id="preview_image_sms" user_id="" type="file">
				<input style="display:none;" id="preview_image_web" user_id="" type="file">
				<input style="display:none;" id="preview_image_notes" user_id="" newToken=""  type="file">
				<input style="display:none;" id="preview_image_sms_notes" user_id=""  type="file">
				<input style="display:none;" id="em_small_new_number" value=""  type="text">
			</div>
			
			
			<div class="modal fade" id="previewImagePopup" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					
					<div class="modal-body" style="padding: 2px !important;">
						<img id="showImage" src="" width="100%">
					</div>
					
				</div>
			</div>
			
			<div id="chat-sidebar" style="display: block;">
			<div class="chat_add"><img style="padding:14px 10px 10px 10px" class="sms_user" src="/assets/images/chat_plus_icon.png"></div>
			
				<div class="sidebar_head closemainchat">All Contacts&nbsp; (<?php echo count($totalSubscriber_schat); ?>)
					
					
					<div id="closemainchatbox" style="display:none" class="closechatmain"><img src="/assets/images/chat_left_arrow.png"></div>
				</div>
				
				<div class="sidebar_body" style="display:none">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<?php if ($has_web) { ?>	
						<li class="<?php echo $activeWebClass; ?>"><a href="#webchattab" data-toggle="tab">Web Chat</a></li>
						<?php
} ?>
						<?php if ($has_sms) { ?>	
						<li class="<?php echo $activeSmsClass; ?>"><a href="#smschattab" data-toggle="tab">SMS Chat</a></li>
						<?php
} ?>
					</ul>
					
					
					<div class="tab-content"> 
					<?php if ($has_web) { ?>	
						<!--++++++++++++ Web Chat +++++++++++++++-->			  
						<div class="tab-pane <?php echo $activeWebClass; ?> SmallWebchat" id="webchattab">	
                      
                       <!--++++++++WEB SEARCH BOX++++++-->
						<div class="p20 btop bbot pt10 pb10">
							<div style=" width:100%;" class="chat_search_icon">
								<input style="width: calc(100% - 22px);" id="small_web_MainsearchChatMsg" class="small_web_MainsearchChatMsg" onkeyup="small_web_showSearchsubscriber(this.value)" type="text" name="small_web_adSearch" value="" placeholder="Search">
								
								<input style="width: calc(100% - 22px); display:none" id="small_web_MainContactsearch" class="small_web_MainContactsearch" type="text" name="small_MainContactsearch" value="" placeholder="Search">
								
								<input style="display:none;width: calc(100% - 22px)" type="text" name="small_web_webContactBox" placeholder="Search" id="small_web_webContactBox" value="">
								
								<input type="hidden" name="small_web_afterTrigger" id="small_web_afterTrigger" value="">
								<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
							</div>
						</div>
						<!--++++++++WEB SEARCH BOX++++++-->



							<div class="user_img_sec regular slider" id="CurrentUserListing" style="display: none;">
								<?php
    if (count($getactiveChatboxlisting) > 0) {
        foreach ($getactiveChatboxlisting as $key => $value) {
            $valueData = getAllUser($value->subscriber_id);
            if (count($valueData) <= 0) {
                $valueData = getSubscribersInfo($value->subscriber_id);
            }
            if (!empty($valueData[0])) {
                $valueData = $valueData[0];
                if ($value->type == 'webchat') {
?>
						<figure style="margin:15px 0;">
							<a class="<?php echo $value->type; ?>" user_id="<?php echo $value->subscriber_id; ?>" href="javascript:void(0)"><?php echo showUserAvtar($valueData->avatar, $valueData->firstname, $valueData->lastname, 28, 28, 11); ?></a>
							<span class="greendot"></span>
						</figure>
						
						<?php
                }
            }
        }
    } ?>
								
							</div> 
							<div class="clearfix"></div>
							
							@include('admin.chat_app.common.web_header', array('Favorites_list' => $Favorites_list, 'activeChatCount' => $activeChatCount, 'fUserCount' => $fUserCount, 'totalSubscriber_schat' => $totalSubscriber_schat, 'assignedChat' => $asginChatlist, 'unassignedChat' => $unassignChatlist, 'loggedYou' => $teamLogin_id))
							
							<div class="clearfix"></div>
							
							<div class="contact_lists_outer" style="height: 410px; padding: 0px; overflow:auto; margin-bottom: 3px!important">
								
								
								


								<div id="small_web_AjaxSearchWeb" style="height:670px; display:none;background-color:#fff!important"></div>


								<div id="small_web_InitalWeb">
								<div class="activeChatList firstinit all_user_chat"></div>
								<div class="panel-body p0 br5 mb10 a_list">
									@include('admin.chat_app.webchat.activechat_list', array('activechatlist' => $activeOnlyweb))
								</div>
								
								
								<!--++++++++++++ oldest chat list +++++++++++++++-->
								<div class="o_list" style="background-image:none; display:none">
									@include('admin/chat_app/webchat/oldchat_list', array('oldchat_list' => $oldchat_list))
								</div>
								<!--++++++++++++ oldest chat list +++++++++++++++-->
								
								
								<!--++++++++++++ Unassign chat list +++++++++++++++-->
								<div class="un_list_small" style="background-image:none; display:none">
								</div>
								<!--++++++++++++ Unassign chat list +++++++++++++++-->


								<!--++++++++++++ You chat list +++++++++++++++-->
								<div class="you_list_small" style="background-image:none; display:none">
								</div>
								<!--++++++++++++ You chat list +++++++++++++++-->


								<!--++++++++++++ Fav chat list +++++++++++++++-->
								<div class="fav_list_web_small" style="background-image:none; display:none">
								
								@include('admin.chat_app.webchat.favchat_list', array('favChatlist' => $Favorites_list))
								</div>
								<!--++++++++++++ Fav chat list +++++++++++++++-->




								</div>
	
							</div>
							
						</div>
						<!--++++++++++++ Web Chat +++++++++++++++-->		
						<?php
} ?>
						

						<?php if ($has_sms) { ?>
						<!--++++++++++++ Sms Chat +++++++++++++++-->		
						<div class="tab-pane <?php echo $activeSmsClass; ?> SmallSmschat" id="smschattab">

						
						 <!--++++++++SMS SEARCH BOX++++++-->
						<div class="p20 btop bbot pt10 pb10">
							<div style=" width:100%;" class="chat_search_icon">
								<input style="width: calc(100% - 22px);" id="small_sms_MainsearchChatMsg" class="small_sms_MainsearchChatMsg" onkeyup="small_sms_showSearchsubscriber(this.value)" type="text" name="small_sms_adSearch" value="" placeholder="Search">
								
								<input style="width: calc(100% - 22px); display:none" id="small_sms_MainContactsearch" class="small_sms_MainContactsearch" type="text" name="small_MainContactsearch" value="" placeholder="Search">
								
								<input style="display:none;width: calc(100% - 22px)" type="text" name="small_sms_webContactBox" placeholder="Search" id="small_sms_webContactBox" value="">
								
								<input type="hidden" name="small_sms_afterTrigger" id="small_sms_afterTrigger" value="">
								<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
							</div>
						</div>
						<!--++++++++SMS SEARCH BOX++++++-->

						
						
							<div class="bbot user_img_sec regular slider hidden" id="CurrentSMSUserListing"  style="margin:15px auto;">
								<?php if (count($getactiveChatboxlisting) > 0) {
        foreach ($getactiveChatboxlisting as $key => $value) {
            $valueData = getAllUser($value->subscriber_id);
            if (count($valueData) <= 0) {
                $valueData = getSubscribersInfo($value->subscriber_id);
            }
            if (!empty($valueData[0])) {
                $valueData = $valueData[0];
                if ($value->type == 'smschat') {
?>
										<figure>
											<a class="<?php echo $value->type; ?>" user_id="<?php echo $value->subscriber_id; ?>" href="javascript:void(0)"><?php echo showUserAvtar($valueData->avatar, $valueData->firstname, $valueData->lastname, 28, 28, 11); ?></a>
											<span class="greendot"></span>
										</figure>
										
										<?php
                }
            }
        }
    } ?>
							</div> 
							
							@include('admin.chat_app.common.sms_header', array('activeChatSmsCount' => $activeChatSmsCount, 'fUserCount' => $fUserCount, 'totalSubscriber_schat' => $totalSubscriber_schat))
							
							<div class="contact_lists_outer" style="height: 410px; padding: 0px; overflow:auto; margin-bottom: 3px!important;">
								

								<div id="small_sms_AjaxSearchWeb" style="height:670px; display:none;background-color:#fff!important"></div>
							
							   <div id="small_sms_InitalWeb">
								<div class="a_list">
									@include('admin.chat_app.smschat.a_s_list', array('mobile' => $loginUserData->mobile, 'a_s_list' => $a_s_list))
								</div>
								
								<!--++++++++++++ favourite chat list +++++++++++++++-->
								<div class="f_list" style="background-image:none; display:none">
									@include('admin.chat_app.smschat.favourite_list', array('fUser' => $fUser))
								</div>
								<!--++++++++++++ favourite chat list +++++++++++++++-->
								
								<!--++++++++++++ oldest chat list +++++++++++++++-->
								<div class="o_list" style="background-image:none; display:none">
									@include('admin.chat_app.smschat.o_s_list', array('mobile' => $loginUserData->mobile, 'o_s_list' => $o_s_list))
								</div>
								<!--++++++++++++ oldest chat list +++++++++++++++-->
								
								<!--++++++++++++ wait chat list +++++++++++++++-->
								<div class="w_list" style="background-image:none; display:none">
									
								</div>
								<!--++++++++++++ wait chat list +++++++++++++++-->
								</div>


								<!-- Contact list -->
								<div class="c_list" style="background-image:none; display:none ">
									<?php
    $initNumber = "";
    $autocmpSearch = array();
    $contactCount = 0;
    $flag = 0;
    $character = array('A' => 'a', 'B' => 'b', 'C' => 'c', 'D' => 'd', 'E' => 'e', 'F' => 'f', 'G' => 'g', 'H' => 'h', 'I' => 'i', 'J' => 'j', 'K' => 'k', 'L' => 'l', 'M' => 'm', 'N' => 'n', 'O' => 'o', 'P' => 'p', 'Q' => 'q', 'R' => 'r', 'S' => 's', 'T' => 't', 'U' => 'u', 'V' => 'v', 'W' => 'w', 'X' => 'x', 'Y' => 'y', 'Z' => 'z');
    foreach ($character as $key => $value) {
        $getCharUserList = bycharuser($loginUserData->id, $value);
        if (!empty($getCharUserList)) {
            foreach ($getCharUserList as $userData) {
                $userDataDetail = getUserDetail($userData->user_id);
                $favUser = '';
                //$favUser = getFavSmsUser($loginUserData->id, $userData->phone);
                //if(!empty($userDataDetail)) {
                //$favUser = $this->smsChat->getSMSFavouriteBySubsId($userData->id);
                if ($flag == 0) {
                    $userId = $userData->user_id;
                    $incId = $userData->id;
                    $flag = 1;
                }
                $avatar = !empty($userDataDetail->avatar) ? $userDataDetail->avatar : '';
?>
													<div  id="sidebar_Sms_box_<?php echo phoneDisplay($userData->phone); ?>" phone_no_format="<?php echo mobileNoFormatChat($userData->phone); ?>" subscriberphone="<?php echo phoneDisplay($userData->phone); ?>" phone_no="<?php echo phoneDisplay($userData->phone); ?>" class="sms_user"  user_id="" >
														<div class="avatarImage"><?php echo showUserAvtar($avatar, $userData->firstname, $userData->lastname, 28, 28, 11); ?></div>
														<span style="display:none" id="fav_star_">
															<?php if (1) { ?>
																<a style="cursor: pointer;" class="favourite" status="1" user_id=""><i class="icon-star-full2 text-muted sidechatstar"></i></a>
																<?php
                } else { ?>
																<i class="icon-star-full2 txt_blue sidechatstarshow"></i>
																<?php
                } ?>
														</span>
														<span class="slider-username contacts"><?php echo phoneNoFormat($userData->phone); ?> &nbsp; <span class="SmallchatfavouriteSMSUser" subscriberId="<?php echo $userData->phone; ?>"><i class="fa fa-star star_icon <?php echo $favUser > 0 ? 'yellow' : ''; ?>"></i></span> </span>
														<span class="" style="float: left; margin-left: 12px;"><span style="font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
                                                            Assigned to:&nbsp;<!--+1(359) 569-6585--><?php echo phoneNoFormat($userData->phone); ?></span></span> 
														
														<span style="margin-left: 38px; font-size: 12px;" class="slider-email contacts"><?php echo $userData->email; ?> </span>
														
														<span style="display: none;" class="slider-mobile contacts"><?php echo mobileNoFormatChat($userData->phone); ?> </span>
														<span style="display: none;" class="slider-image img">
															<?php
                if (empty($loginUserData->avatar)) {
                    echo $currentUserImg = '/assets/images/default_avt.jpeg';
                } else {
                    echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
                } ?></span>
																
																<span class="user_status"><?php //echo chatTimeAgo1($value->created);
                
?></span>
																
													</div>
												<?php $contactCount++;
            }
        }
    }
?>
								</div>
								<!-- Contact list -->
								
							</div>
							
							
							
							
							
							
							
							
						</div>
						<!--++++++++++++ Sms Chat +++++++++++++++-->	
						<?php
} ?>			
					</div>
				</div>        
				
			</div>
			
			
			
			<script>


			$(document).ready(function() {
	$('.SmallWebchat .c_link').html('Contacts(<?php echo $contactCount; ?>)');
	$('.SmallSmschat .c_link').html('Contacts(<?php echo $contactCount; ?>)');
	$('.closemainchat').html('All Contacts (<?php echo $contactCount; ?>)');
	

	   $('#small_web_webContactBox').on("keyup", function() {
		var textInput = $( this ).val().toLowerCase();
		$( '#Webonly .searchInput' ).val(textInput);
		
		$(".SmallWebchat .all_user_chat").filter(function() {
			$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
		});
		
		
	});

	     $('#small_sms_webContactBox').on("keyup", function() {
		var textInput = $( this ).val().toLowerCase();
		$( '#Webonly .searchInput' ).val(textInput);
		
		$(".SmallSmschat .sms_user").filter(function() {
			$(this).toggle($(this).find('.slider-username').text().toLowerCase().indexOf(textInput) > -1)
		});
		
		
	});


	});


				function small_sms_showSearchsubscriber(str) {
 document.getElementById("small_sms_InitalWeb").style.display='none';
 document.getElementById("small_sms_AjaxSearchWeb").style.display='block';
  if (window.XMLHttpRequest) {
   
    xmlhttp=new XMLHttpRequest();
  } else {  
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
		document.getElementById("a_list_sms").innerHTML=this.responseText;
		document.getElementById("small_sms_AjaxSearchWeb").innerHTML=this.responseText;
		document.getElementById("small_sms_InitalWeb").style.display='none';
		
    }
  }
  xmlhttp.open("GET","/admin/smschat/getSearchSmsListByinputSmallsms?q="+str ,true);
  xmlhttp.send();

}

$(document).ready(function(){
$(document).on("keyup",".small_web_MainsearchChatMsg", function() {
$.ajax({
url: "{{ url('admin/smschat/getSearchsubscriberByinputSmallWeb') }}",
type: "POST",
data: {searchVal:$('#small_web_MainsearchChatMsg').val()},
success: function (data) {
$('#small_web_InitalWeb').hide();
$('#small_web_AjaxSearchWeb').show();
$('#small_web_AjaxSearchWeb').html(data); 

}
});

});
});

			
			function showSmallSMSChatData(userId="",SubscriberPhone,clickvalue="" )
			{
			
				$('#sms_msg_box_undefined').remove();
				$('#sms_msg_box_').remove();

				$('#sidebar_Sms_box_'+SubscriberPhone).trigger('click');
			}

					function showResultSmall(str) {
	$('#livesearchSmall').show();
	str = str.replace(/\D/g,"");
	$('.Phoneuername').show();
	//$('.Phoneuername').html(str);
	
	if(str.length>10)
	{
	   displayMessagePopup('error', '', 'Please enter 10 digit phone number'); //javascript notification msg
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

			document.getElementById("livesearchSmall").innerHTML="";
					var dyid = "sms_msg_box_"+str;
					var dyidBox = "sms_box_show_"+str;
					var dyidBoxText = "msg_input_sms_"+str;
					var dyidBoxTextFileid = "mmsFileSms_"+str;
					$("#sms_msg_box_"+str+" .mmsFile1Sms").attr('id',dyidBoxTextFileid);
					$("#sms_msg_box_"+str+" .mmsFile1Sms").attr('user_id',str);

					$('.Smschat .chat-list').attr("id",dyidBox);
					$('.Smschat').attr("id",dyid);
					$("#sms_msg_box_"+str+" .msg_input_sms").attr('id',dyidBoxText);
					$("#sms_box_show_"+str).attr('tWR',str);
					$("#sms_msg_box_"+str+" .msg_input_sms").attr('newSms',str);
					
			setTimeout(function(){ 
					//$("#sms_box_show_"+str).html('<div class="msg_push"></div>');
					$("#msg_input_sms_"+str).attr('subscriberphone',str);
					$("#msg_input_sms_"+str).attr('user_id',str);
					$("#msg_input_sms_"+str).attr('userimage','<?php echo $currentUserImg; ?>');
					document.getElementById("em_small_new_number").value = '1';
			 }, 500);
			 
			 ///new 
			var tabPanid_sms = "sms_tab_small_"+str;
			var tabPanid_notes = "noteSms_tab_small"+str;

			$("#sms_msg_box_"+str+" .tab-pane .active").attr('id',tabPanid_sms);
			$("#sms_msg_box_"+str+" .tab-pane").attr('id',tabPanid_notes);
			$("#sms_msg_box_"+str).has('.smilie_emoji').addClass('supported-smilies_'+str);
			$("#sms_msg_box_"+str+" .smilieSms").attr('user_id',str);
			$("#sms_msg_box_"+str+" .preview_image_button_cl_sms").attr('user_id',str);

			$("#sms_msg_box_"+str+" .createMessage").attr('href','#sms_tab_small_'+str);
			$("#sms_msg_box_"+str+" .SmscreateNotes").attr('href','#noteSms_tab_small_'+str);

		}
		else
		{
		document.getElementById("livesearchSmall").innerHTML=this.responseText;
		//document.getElementById("livesearchSmall").style.border="1px solid #A5ACB2";
		}
		
    }
  }
  xmlhttp.open("GET","/admin/smschat/livesearchSmallchat?q="+str,true);
  xmlhttp.send();
}
				
				//  ######### switch top menu  ############ //
				
				$(document).on('click', '.SmallWebchat .smallbr', function() {

					   $('#small_web_AjaxSearchWeb').hide();
			          $('#small_web_InitalWeb').show();


					$('.SmallWebchat .o_list').hide();
					$('.SmallWebchat .a_list').show();
					$('#small_web_webContactBox').hide();
					$('.SmallWebchat .un_list_small').hide();
     		         $('.SmallWebchat .you_list_small').hide();
					$('#small_web_MainsearchChatMsg').show();
					$('.SmallWebchat .fav_list_web_small').hide();

					$('.SmallWebchat .t_web_main').html('All (<?php echo $activeChatCount; ?>)');
					
				});
				
				$(document).on('click', '.SmallWebchat .f_new', function() {
					   $('#small_web_AjaxSearchWeb').hide();
			           $('#small_web_InitalWeb').show();

					$('.SmallWebchat .o_list').hide();
					$('.SmallWebchat .a_list').show();
						$('.SmallWebchat .un_list_small').hide();
     		         $('.SmallWebchat .you_list_small').hide();
     		         $('.SmallWebchat .fav_list_web_small').hide();
					$('.SmallWebchat .t_web_small').html('All (<?php echo $activeChatCount; ?>)');
					$('.SmallWebchat .f_web_small').html('Newest'); 
					
				});
					$(document).on('click', '.SmallWebchat .f_old', function() {
					$('#small_web_AjaxSearchWeb').hide();
					$('#small_web_InitalWeb').show();
					$('.SmallWebchat .o_list').show();
					$('.SmallWebchat .a_list').hide();
					$('.SmallWebchat .fav_list_web_small').hide();
					$('.SmallWebchat .un_list_small').hide();
					$('.SmallWebchat .you_list_small').hide();
					$('.SmallWebchat .f_web_small').html('Oldest'); 

					});

					$(document).on('click', '.SmallWebchat .Smallwebfavtab', function() {
					$('#small_web_AjaxSearchWeb').hide();
					$('#small_web_InitalWeb').show();
					$('.SmallWebchat .o_list').hide();
					$('.SmallWebchat .a_list').hide();
					$('.SmallWebchat .fav_list_web_small').show();
					$('.SmallWebchat .un_list_small').hide();
					$('.SmallWebchat .you_list_small').hide();
					$('.SmallWebchat .t_web_main').html('Favorites');
					//$('.SmallWebchat .f_web_small').html('Oldest'); 

					});



				$(document).on('click', '.SmallWebchat .unTab', function() {

					$.ajax({
				url: "{{ url('admin/smschat/showUntabAjaxSmallbox') }}",
				type: "POST",
				success: function (data) {
					$('.un_list_small').html(data); 
				}
			});

					 $('#small_web_AjaxSearchWeb').hide();
			          $('#small_web_InitalWeb').show();
                        $('.firstinit').hide();
					$('.SmallWebchat .o_list').hide();
					$('.SmallWebchat .a_list').hide();
						$('.SmallWebchat .un_list_small').show();
     		         $('.SmallWebchat .you_list_small').hide();
     		         $('.SmallWebchat .fav_list_web_small').hide();
					$('.SmallWebchat .t_web_main').html('Unassigned (<?php echo $unassignChatlist; ?>)');
					
				});


				$(document).on('click', '.SmallWebchat .YouTab', function() {

					$.ajax({
				url: '<?php echo base_url('admin/webchat/showYoutabAjaxSmallbox'); ?>',
				type: "POST",
				data: { _token: '{{csrf_token()}}'},
				success: function (data) {
					//$('.you_list_small').html(data); 
				}
			});

					 $('#small_web_AjaxSearchWeb').hide();
			          $('#small_web_InitalWeb').show();

					$('.SmallWebchat .o_list').hide();
					$('.SmallWebchat .a_list').hide();
					$('.SmallWebchat .fav_list_web_small').hide();
				    $('.SmallWebchat .un_list_small').hide();
     		         $('.SmallWebchat .you_list_small').show();
					$('.SmallWebchat .t_web_main').html('You (<?php echo $asginChatlist; ?>)');
					
				});
				
				


				/*.msg_head:hover .user_details.bottom{ display: block;}*/
				
				
				
				//  ######### switch top menu  ############ //
				$(document).on('click', '.SmallSmschat .c_link', function() {
					$('#small_sms_AjaxSearchWeb').hide();
                    $('#small_sms_InitalWeb').show();

					$('.SmallSmschat .a_list').hide();
					$('.SmallSmschat .f_list').hide();
					$('.SmallSmschat .o_list').hide();
					$('.SmallSmschat .w_list').hide();
					$('.SmallSmschat .c_list').show();
					 
					 $('#small_sms_webContactBox').show();
                     $('#small_sms_MainsearchChatMsg').hide();

					$('.SmallSmschat .t_sms_small').html('Contacts(<?php echo $contactCount; ?>)');
					
				});
				
				
				$(document).on('click', '.SmallSmschat .f_link', function() {

                $('#small_sms_AjaxSearchWeb').hide();
                $('#small_sms_InitalWeb').show();

					$('.SmallSmschat .a_list').hide();
					$('.SmallSmschat .c_list').hide();
					$('.SmallSmschat .o_list').hide();
					$('.SmallSmschat .w_list').hide();
					$('.SmallSmschat .f_list').show();
					$('.SmallSmschat .t_sms_small').html('Favorite(5)');
					
				});
				
				
				$(document).on('click', '.SmallSmschat .smallbr', function() {

					 $('#small_sms_AjaxSearchWeb').hide();
                       $('#small_sms_InitalWeb').show();

					$('.SmallSmschat .o_list').hide();
					$('.SmallSmschat .w_list').hide();
					$('.SmallSmschat .f_list').hide();
					$('.SmallSmschat .c_list').hide();
					$('.SmallSmschat .a_list').show();
					$('#small_sms_webContactBox').hide();
                    $('#small_sms_MainsearchChatMsg').show();

					$('.SmallSmschat .t_sms_small').html('All (<?php echo $activeChatCount; ?>)');
					
				});
				
				$(document).on('click', '.SmallSmschat .f_new', function() {

					$('#small_sms_AjaxSearchWeb').hide();
                 $('#small_sms_InitalWeb').show();

					$('.SmallSmschat .o_list').hide();
					$('.SmallSmschat .w_list').hide();
					$('.SmallSmschat .f_list').hide();
					$('.SmallSmschat .c_list').hide();
					$('.SmallSmschat .a_list').show();
					$('#small_sms_webContactBox').hide();
                    $('#small_sms_MainsearchChatMsg').show();

					$('.SmallSmschat .t_sms_small').html('All (<?php echo $activeChatCount; ?>)');
					$('.SmallSmschat .f_sms_small').html('Newest'); 
					
				});
				$(document).on('click', '.SmallSmschat .f_old', function() {
					 $('#small_sms_AjaxSearchWeb').hide();
                     $('#small_sms_InitalWeb').show();

					$('.SmallSmschat .o_list').show();
					$('.SmallSmschat .w_list').hide();
					$('.SmallSmschat .f_list').hide();
					$('.SmallSmschat .c_list').hide();
					$('.SmallSmschat .a_list').hide();
					$('#small_sms_webContactBox').hide();
                    $('#small_sms_MainsearchChatMsg').show();

					$('.SmallSmschat .f_sms_small').html('Oldest'); 
					
				});
				$(document).on('click', '.SmallSmschat .f_wait', function() {

					$('#small_sms_AjaxSearchWeb').hide();
                    $('#small_sms_InitalWeb').show();

					$('.SmallSmschat .w_list').show();
					$('.SmallSmschat .o_list').hide();
					$('.SmallSmschat .f_list').hide();
					$('.SmallSmschat .c_list').hide();
					$('.SmallSmschat .a_list').hide();
					$('#small_sms_webContactBox').hide();
                     $('#small_sms_MainsearchChatMsg').show();

					$('.SmallSmschat .f_sms_small').html('Waiting longest'); 
					
				});
				
				/*.msg_head:hover .user_details.bottom{ display: block;}*/
				
				
				$( document ).ready( function () {
					
					
					
					
					var arr = []; // List of users	
					
					
					
					$( document ).on( 'click', '.minimize', function () {
						
						var chatbox = $( this ).parent().parent().attr( "rel" );
						$( '[rel="' + chatbox + '"] .msg_wrap' ).slideToggle( 'slow' );
						return false;
					} );
					
					$( document ).on( 'click', '.green_check_minus', function () {
						
						var chatbox = $( this ).parent().parent().attr( "rel" );
						
						
						if ($( '[rel="' + chatbox + '"] .msg_wrap' ).is(':visible'))
						{ 
							
							
							
							$('#minus_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/icon_maximize.png'); ?>");
							$('#close_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/close_red_20.png'); ?>");
							
							
						}
						else
						{
							$('#minus_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/grey_minus.png'); ?>");
							$('#close_img_'+chatbox).attr('src',"<?php echo base_url('assets/images/close_red_20.png'); ?>");
							
						}
						
						$( '[rel="' + chatbox + '"] .msg_wrap' ).slideToggle();
						
						return false;
					} );
					
					
					
				} );
				
				
				
				$( document ).ready( function () {
				
					$("#closemainchatbox").click(function(){
						$("#chat-sidebar").hide();
						$("#smallchatbox").show();
					});
					
					$("#smallchatbox").click(function(){
						$("#chat-sidebar").show();
						$("#smallchatbox").hide();
					});
					
				});
				
				
			</script>
			<script>
				
				$( document ).ready( function () {
					<?php if (count($getactiveChatboxlisting) > 0) { ?>
						$('.sidebar_head').trigger('click');
					<?php
} ?>
				});
			</script>
			
			<script>
				$( document ).ready( function () {
					<?php foreach ($getactiveChatboxlisting as $key => $value) {
    if ($value->type == 'smschat') { ?>
						$('#SmsIcon_<?php echo $value->subscriber_id; ?>').trigger('click');
						<?php
    } else { ?>
						$('#webIcon_<?php echo $value->subscriber_id; ?>').trigger('click');
						<?php
    }
} ?>
					
					
					$( document ).on( 'click', '.webchat', function () {
						var userid = $(this).attr( "user_id" );
						$('#webIcon_'+userid).trigger('click');
					});
					
					
					$( document ).on( 'click', '.smschat', function () {
						var userid = $(this).attr( "user_id" );
						$('#SmsIcon_'+userid).trigger('click');
					});
					
				});
			</script>
			
			
			
			
			
			
			<script type="text/javascript" src="{{ URL::asset('assets/js/highlight.js') }}"></script>
			<script type="text/javascript">
				$( document ).ready( function () {
					$('.text-search').bind('keyup change', function(ev) {
						// pull in the new value
						var user_id = $(this).attr( "user_id" );
						var searchTerm = $(this).val();
						
						// remove any old highlighted terms
						$('#msg_box_show_'+user_id).removeHighlight();
						
						// disable highlighting if empty
						if ( searchTerm ) {
							// highlight the new term
							$('#msg_box_show_'+user_id).highlight( searchTerm );
						}
					});
					
					
					
					
				});
			</script>
			
			<script type='text/javascript'>
				var totalSearchLength = null;
				var cntr = -1;
				var searchType = '';
				var oldBoxId = '';
				var oldSearchLength = '';
				var newLoadDataSearchVal = 0;
				
				$(document).ready(function() {
					//////////////////////////////////////////
					
					 

					
					$(document).on('keyup', '.MainsearchSmsChatMsg', function(e) {
						var searchVal = $(".MainsearchSmsChatMsg").val();
						
						
						if (e.keyCode == 13) {
							if(searchType == ''){
								//$('#afterTrigger').val($('.MainsearchSmsChatMsg').val());
								totalSearchLength = null;
								cntr = -1;
								$("#SmsContainer").removeHighlight();
								$("#SmsContainer").highlight(searchVal);
								searchType = 'next';
								var totalSearch = $("#SmsContainer").find('span.highlight');
								cntr = totalSearch.length;
								oldSearchLength = totalSearch.length;
								searchSmsPrevMsgTrigger('', searchVal)	;
								}else if(searchType == 'next'){
								searchSmsPrevMsgTrigger('', searchVal)	;
							}
							}else{
							totalSearchLength = null;
							cntr = -1;
							searchType = '';
							oldBoxId = '';
							oldSearchLength = '';
							newLoadDataSearchVal = 0;
						}
					}); 
					
					
					
					function searchSmsPrevMsgTrigger(callValue='', searchVal){
						if (totalSearchLength === null) {
							totalSearchLength = $("#SmsContainer").find('span.highlight');
							oldSearchLength = totalSearchLength.length;
							if (!totalSearchLength || totalSearchLength.length === 0) {
								totalSearchLength = null;
								return;
							}
						}
						
						if(callValue == 'after'){
							$("#SmsContainer").removeHighlight();
							$("#SmsContainer").highlight(searchVal);
							totalSearchLength = $("#SmsContainer").find('span.highlight');
							cntr = oldSearchLength + newLoadDataSearchVal;
							//console.log(totalSearchLength, 'after');
							newLoadDataSearchVal = totalSearchLength.length;
						}
						
						if (cntr > 0) {
							
							cntr--;
							
							if (cntr < totalSearchLength.length) {
								$(totalSearchLength[cntr + 1]).removeClass('selectedChatMsg');
							}
							
							var elm = totalSearchLength[cntr];
							$(elm).addClass('selectedChatMsg');
							
							setTimeout(function(){
								document.getElementById("SmsContainer").getElementsByClassName("selectedChatMsg")[0].scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
							}, 500);
							
							} else{
							//loadChatMsgData(searchBoxId, searchVal);
							alertMessage('No more search record found.');
						}
					}
					
					
					
					
					$(document).on('keyup', '.MainsearchChatMsg', function(e) {
						var searchVal = $(".MainsearchChatMsg").val();
						
						
						if (e.keyCode == 13) {
							if(searchType == ''){
								//$('#afterTrigger').val($('.MainsearchChatMsg').val());
								totalSearchLength = null;
								cntr = -1;
								$("#webparentsearch").removeHighlight();
								$("#webparentsearch").highlight(searchVal);
								searchType = 'next';
								var totalSearch = $("#webparentsearch").find('span.highlight');
								cntr = totalSearch.length;
								oldSearchLength = totalSearch.length;
								searchPrevMsgTrigger('', searchVal)	;
								}else if(searchType == 'next'){
								searchPrevMsgTrigger('', searchVal)	;
							}
							}else{
							totalSearchLength = null;
							cntr = -1;
							searchType = '';
							oldBoxId = '';
							oldSearchLength = '';
							newLoadDataSearchVal = 0;
						}
					}); 
					
					
					
					
					
					
					function searchPrevMsgTrigger(callValue='', searchVal){
						if (totalSearchLength === null) {
							totalSearchLength = $("#webparentsearch").find('span.highlight');
							oldSearchLength = totalSearchLength.length;
							if (!totalSearchLength || totalSearchLength.length === 0) {
								totalSearchLength = null;
								return;
							}
						}
						
						if(callValue == 'after'){
							$("#webparentsearch").removeHighlight();
							$("#webparentsearch").highlight(searchVal);
							totalSearchLength = $("#webparentsearch").find('span.highlight');
							cntr = oldSearchLength + newLoadDataSearchVal;
							//console.log(totalSearchLength, 'after');
							newLoadDataSearchVal = totalSearchLength.length;
						}
						
						if (cntr > 0) {
							
							cntr--;
							
							if (cntr < totalSearchLength.length) {
								$(totalSearchLength[cntr + 1]).removeClass('selectedChatMsg');
							}
							
							var elm = totalSearchLength[cntr];
							$(elm).addClass('selectedChatMsg');
							
							setTimeout(function(){
								document.getElementById("webparentsearch").getElementsByClassName("selectedChatMsg")[0].scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
							}, 500);
							
							} else{
							//loadChatMsgData(searchBoxId, searchVal);
							alertMessage('No more search record found.');
						}
					}
					
					
					
					function searchPrevMsgTriggerWeb(callValue='', searchVal){
						if (totalSearchLength === null) {
							totalSearchLength = $("#msg_box_show_main_"+$(".webLoadDataChat").attr('userid')).find('span.highlight');
							oldSearchLength = totalSearchLength.length;
							if (!totalSearchLength || totalSearchLength.length === 0) {
								totalSearchLength = null;
								return;
							}
						}
						
						if(callValue == 'after'){
							$("#msg_box_show_main_"+$(".webLoadDataChat").attr('userid')).removeHighlight();
							$("#msg_box_show_main_"+$(".webLoadDataChat").attr('userid')).highlight(searchVal);
							totalSearchLength = $("#msg_box_show_main_"+$(".webLoadDataChat").attr('userid')).find('span.highlight');
							cntr = oldSearchLength + newLoadDataSearchVal;
							//console.log(totalSearchLength, 'after');
							newLoadDataSearchVal = totalSearchLength.length;
						}
						
						if (cntr > 0) {
							
							cntr--;
							
							if (cntr < totalSearchLength.length) {
								$(totalSearchLength[cntr + 1]).removeClass('selectedChatMsg');
							}
							
							var elm = totalSearchLength[cntr];
							$(elm).addClass('selectedChatMsg');
							
							setTimeout(function(){
								document.getElementById("msg_box_show_main_"+$(".webLoadDataChat").attr('userid')).getElementsByClassName("selectedChatMsg")[0].scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
							}, 500);
							
							} else{
							//loadChatMsgData(searchBoxId, searchVal);
							alertMessage('No more search record found.');
						}
					}
					
					/////////////////////////////////////////////
					$(document).on('keyup', '.searchChatMsg', function(e) {
						var searchVal = $(this).val();
						var boxId = $(this).attr('data-chatboxid');
						
						if (e.keyCode == 13) {
							if(searchType == '' || oldBoxId != boxId){
								totalSearchLength = null;
								cntr = -1;
								$("#msg_box_show_"+boxId).removeHighlight();
								$("#msg_box_show_"+boxId).highlight(searchVal);
								searchType = 'next';
								var totalSearch = $("#msg_box_show_"+boxId).find('span.highlight');
								cntr = totalSearch.length;
								oldSearchLength = totalSearch.length;
								oldBoxId = boxId;
								searchPrevMsg(boxId, '', searchVal)	;
								}else if(searchType == 'next'){
								searchPrevMsg(boxId, '', searchVal)	;
							}
							}else{
							totalSearchLength = null;
							cntr = -1;
							searchType = '';
							oldBoxId = '';
							oldSearchLength = '';
							newLoadDataSearchVal = 0;
						}
					}); 
					
					
					
					$(document).on('keyup', '.searchSmsChatMsg', function(e) {
						var searchVal = $(this).val();
						
						var boxId = $(this).attr('data-chatboxid');
						
						if (e.keyCode == 13) {
						
							if(searchType == '' || oldBoxId != boxId){
								totalSearchLength = null;
								cntr = -1;
								$("#sms_box_show_"+boxId).removeHighlight();
								$("#sms_box_show_"+boxId).highlight(searchVal);
								searchType = 'next';
								var totalSearch = $("#sms_box_show_"+boxId).find('span.highlight');
								cntr = totalSearch.length;
								oldSearchLength = totalSearch.length;
								oldBoxId = boxId;
								searchSmsPrevMsg(boxId, '', searchVal)	;
								}else if(searchType == 'next'){
								searchSmsPrevMsg(boxId, '', searchVal)	;
							}
							}else{
							totalSearchLength = null;
							cntr = -1;
							searchType = '';
							oldBoxId = '';
							oldSearchLength = '';
							newLoadDataSearchVal = 0;
						}
					}); 
					
					
					
					
					
					
					
				});
				
				function searchPrevMsg(searchBoxId, callValue='', searchVal){
					if (totalSearchLength === null) {
						totalSearchLength = $("#msg_box_show_"+searchBoxId).find('span.highlight');
						oldSearchLength = totalSearchLength.length;
						if (!totalSearchLength || totalSearchLength.length === 0) {
							totalSearchLength = null;
							return;
						}
					}
					
					if(callValue == 'after'){
						$("#msg_box_show_"+searchBoxId).removeHighlight();
						$("#msg_box_show_"+searchBoxId).highlight(searchVal);
						totalSearchLength = $("#msg_box_show_"+searchBoxId).find('span.highlight');
						cntr = oldSearchLength + newLoadDataSearchVal;
						//console.log(totalSearchLength, 'after');
						newLoadDataSearchVal = totalSearchLength.length;
					}
					
					if (cntr > 0) {
						
						cntr--;
						
						if (cntr < totalSearchLength.length) {
							$(totalSearchLength[cntr + 1]).removeClass('selectedChatMsg');
						}
						
						var elm = totalSearchLength[cntr];
						$(elm).addClass('selectedChatMsg');
						//console.log(typeof elm);
						
						if(typeof elm !='undefined') {
							setTimeout(function(){
								document.getElementById("msg_box_show_"+searchBoxId).getElementsByClassName("selectedChatMsg")[0].scrollIntoView();
							}, 100);
						}
						} else{
						//loadChatMsgData(searchBoxId, searchVal);
						alertMessage('No more search record found.');
					}
				}
				
				
				
				function searchSmsPrevMsg(searchBoxId, callValue='', searchVal){
					if (totalSearchLength === null) {
						totalSearchLength = $("#sms_box_show_"+searchBoxId).find('span.highlight');
						oldSearchLength = totalSearchLength.length;
						if (!totalSearchLength || totalSearchLength.length === 0) {
							totalSearchLength = null;
							return;
						}
					}
					
					if(callValue == 'after'){
						$("#sms_box_show_"+searchBoxId).removeHighlight();
						$("#sms_box_show_"+searchBoxId).highlight(searchVal);
						totalSearchLength = $("#sms_box_show_"+searchBoxId).find('span.highlight');
						cntr = oldSearchLength + newLoadDataSearchVal;
						//console.log(totalSearchLength, 'after');
						newLoadDataSearchVal = totalSearchLength.length;
					}
					
					if (cntr > 0) {
						
						cntr--;
						
						if (cntr < totalSearchLength.length) {
							$(totalSearchLength[cntr + 1]).removeClass('selectedChatMsg');
						}
						
						var elm = totalSearchLength[cntr];
						$(elm).addClass('selectedChatMsg');
						//console.log(typeof elm);
						
						if(typeof elm !='undefined') {
							setTimeout(function(){
								document.getElementById("sms_box_show_"+searchBoxId).getElementsByClassName("selectedChatMsg")[0].scrollIntoView();
							}, 100);
						}
						} else{
						//loadChatMsgData(searchBoxId, searchVal);
						alertMessage('No more search record found.');
					}
				}
				
				
				///////////////////////////////////////////////////////////////
				function searchCustom(callValue='', searchVal){
					
					//$("input[name='adSearch']").focus();
					totalSearchLength = $("#webparentsearch").find('span.highlight');
					cntr = totalSearchLength.length;
					
					if (cntr > 0) { 
						
						cntr--;
						
						if (cntr < totalSearchLength.length) {
							$(totalSearchLength[cntr + 1]).removeClass('selectedChatMsg');
						}
						
						var elm = totalSearchLength[cntr];
						
						$(elm).addClass('selectedChatMsg');
						//console.log(typeof elm);
						
						setTimeout(function(){
							document.getElementById("webparentsearch").getElementsByClassName("selectedChatMsg")[0].scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
							//$("#MainsearchChatMsg").removeClass("MainsearchChatMsg");
							//$("#MainsearchChatMsg").addClass("MainsearchChatMsgTrigger");
							$("#afterTrigger").val(searchVal);
							
							
						}, 400);
						} else{
						//loadChatMsgData(searchBoxId, searchVal);
						alertMessage('No more search record found.');
					}
				}
				
				
				function searchMainSmsPrevMsg(callValue='', searchVal){
					
					var totalSearchLength;
					if(searchVal!="")
					{
						$("#webparentsearch").removeHighlight();
						$("#webparentsearch").highlight(searchVal);
						var totalSearch = $("#webparentsearch").find('span.highlight');
						cntr = totalSearch.length;
						totalSearchLength = $("#webparentsearch").find('span.highlight');
						if (!totalSearchLength || totalSearchLength.length === 0) {
							totalSearchLength = null;
							return;
						}
						searchCustom('after', searchVal);
						/*setTimeout(function(){
							var elm = totalSearchLength[cntr];
							$(elm).addClass('selectedChatMsg');
							
							document.getElementById("CustomDiv2").getElementsByClassName("selectedChatMsg")[0].scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
						}, 100);*/
						
					}
					
					
				}
				///////////////////////////////////	
				
				
			</script>
			
			
			
			<script type="text/javascript">
				
				$(document).on('ready', function() {
					
					/*$("#CurrentSMSUserListing").slick({
						dots: false,
						infinite: false,
						slidesToShow: 5,
						slidesToScroll: 3
					});*/
					
					
					$("#CurrentUserListing").slick({
						dots: false,
						infinite: false,
						slidesToShow: 5,
						slidesToScroll: 3
					});
					
				});
				
				
			</script>
			<script>
				$( document ).ready( function () {

				$(document).on("keyup",'.Search_shortcut_sms', function() {
				var subs_phone = $(this).attr('subs_phone');
				var textInput = $( this ).val().toLowerCase();
				$("#shortcutSmsBoxUl_"+subs_phone+" .shortcutlisting").filter(function() {
					$(this).toggle($(this).find('.shortcut_name').text().toLowerCase().indexOf(textInput) > -1)
				});


				});

                $(document).on("keyup",'.Search_shortcut_web', function() {
				var user_id = $(this).attr('user_id');
				var textInput = $( this ).val().toLowerCase();
				$("#shortcutBox_"+user_id+" .shortcutlisting").filter(function() {
					$(this).toggle($(this).find('.shortcut_name').text().toLowerCase().indexOf(textInput) > -1)
				});


				});

				$('.sidebar_body').hide();
					<?php foreach ($getactiveChatboxlisting as $key => $value) {
    if ($value->type == 'smschat') { ?>
						$('#sidebar_Sms_box_<?php echo $value->subscriber_id; ?>').trigger('click');
						<?php
    } else { ?>
						$('#sidebar-user-box-<?php echo $value->subscriber_id; ?>').trigger('click');
						<?php
    }
} ?>
					
					$( document ).on( 'click', '.webchat', function () {
						var userid = $(this).attr( "user_id" );
						$('#sidebar-user-box-'+userid).trigger('click');
					});

					
				});


		function set_small_shortcut(content,boxid)
		{ 
         var prev_web_val = $('#msg_input_web_'+boxid).val();
         var new_web_val = prev_web_val.concat(" ").concat(content);
		$('#msg_input_web_'+boxid).val(new_web_val);
		$('#chtshortcut_'+boxid).hide();
		$('#msg_input_web_'+boxid).focus();

		}

function set_small_shortcut_sms(content,boxid)
		{ 

       var prev_sms_val = $('#msg_input_sms_'+boxid).val();
         var new_sms_val = prev_sms_val.concat(" ").concat(content);
		$('#msg_input_sms_'+boxid).val(new_sms_val);
		$('#shortcutSmsBox_'+boxid).hide();
		$('#msg_input_sms_'+boxid).focus();
		}

$(document).ready(function() {

$(document).on('click', '.webchat .short_icon', function(){
	var user_id = $(this).attr('user_id');

		$.ajax({
		url: "<?php echo base_url('admin/smschat/small_shortcutListing'); ?>",
		data:{'boxid':user_id, _token: '{{csrf_token()}}'},
		type: "POST",
		dataType: "html",
		success: function (data) {
			$('#shortcutBox_'+user_id).html(data);
			$('#chtshortcut_'+user_id).toggle();
		}
	});
				
})



$(document).on('click', '.Smschat .short_icon', function(){
	var user_id = $(this).attr('user_id');
		$.ajax({
		url: "<?php echo base_url('admin/smschat/small_shortcutListing_sms'); ?>",
		data:{'boxid':user_id, _token: '{{csrf_token()}}'},
		type: "POST",
		dataType: "html",
		success: function (data) {
			$('#shortcutSmsBoxUl_'+user_id).html(data);
			$('#shortcutSmsBox_'+user_id).toggle();
		}
	});
				
})



$(document).on('click', '.webchat .tweb', function(){
	var user_id = $(this).attr('user_id');
		$('#addChatShortcutList').modal();
		$('#dvalue').val('short_icon_'+user_id);
		$('#dvalue_shortcut').val('chtshortcut_'+user_id);

})

	$(document).on('click', '.Smschat .tsms', function(){
	var subs_phone = $(this).attr('subs_phone');
		$('#addChatShortcutList').modal();
		$('#dvalue').val('short_icon_'+subs_phone);
		$('#dvalue_shortcut').val('shortcutSmsBox_'+subs_phone);

})






	});

 //  ######### fav click ############ //  
			$('body').on('click','.SmallchatfavouriteSMSUser',function(){
				var thisObj = $(this);
			var currentUser = "<?php echo $loginUserData->id; ?>";
			$.ajax({
				url: "{{ url('admin/smschat/addSMSFavourite') }}",
				type: "POST",
				data: {user_id:$(this).attr('subscriberId'), currentUser:currentUser},
				dataType: "json",
				success: function (data) {
					if (data.status == 'ok') {
						if(thisObj.children().hasClass('yellow') === true){
							thisObj.children().removeClass('yellow');
							thisObj.children().removeClass('fa-star');
							thisObj.children().addClass('fa-star-o');
							//ShowfavouritAjax();
							}else{
							thisObj.children().addClass('yellow');
							thisObj.children().addClass('fa-star');
							thisObj.children().removeClass('fa-star-o');
							//ShowfavouritAjax();
						}
						
					}
				}
			});
			return false;
		});
	 //  ######### fav click ############ //  

			</script>
