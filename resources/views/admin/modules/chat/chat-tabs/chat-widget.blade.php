<?php $colorOrientation = $oChat->color_orientation == '' ? '45deg' : $oChat->color_orientation; ?>

<?php 
	$mainWigetClassName = "toBottom";
	if($colorOrientation == 'to right top'){
		$mainWigetClassName = "toRightTop";
	}else if($colorOrientation == 'to right'){
		$mainWigetClassName = "toRight";
	}else if($colorOrientation == 'to right bottom'){
		$mainWigetClassName = "toRightBottom";
	}else if($colorOrientation == 'to left bottom'){
		$mainWigetClassName = "toLeftBottom";
	}else if($colorOrientation == 'to left'){
		$mainWigetClassName = "toLeft";
	}else if($colorOrientation == 'to left top'){
		$mainWigetClassName = "toLeftTop";
	}else if($colorOrientation == 'to top'){
		$mainWigetClassName = "toTop";
	}else if($colorOrientation == 'circle'){
		$mainWigetClassName = "orientationCircle";
	}
?>

<style>
    
	.msg_box_new {
    position:absolute;
    bottom: 100px;
    width: 340px;
    right: 30px;
    background: white;
    z-index: 0;
    border-radius: 10px;
    font-size: 14px;
    box-sizing: border-box;
    min-height: 560px;
    font-family: 'Inter UI';
    font-weight: 400;
    box-shadow: 0 3px 2px 0 rgba(0, 3, 49, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.03), 0 10px 20px 0 rgba(0, 0, 54, 0.03);
    border: 1px solid #ddd;
	}
	.msg_box_new2 {
    position:absolute;
    bottom: 100px;
    width: 340px;
    right: 30px;
    z-index: 0;
    font-size: 14px;
    box-sizing: border-box;
    min-height: 560px;
    font-family: 'Inter UI';
    font-weight: 400;
	}
	.woGiftChatBox{box-shadow: 0 3px 2px 0 rgba(0, 3, 49, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.03), 0 10px 20px 0 rgba(0, 0, 54, 0.03);
    border: 1px solid #ddd;
	background: white;
	border-radius: 10px;
	}
	.bb_msg_head_new {
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
	.bb_msg_head_new.big {
    height: 280px;
    text-align: center;
    padding: 45px 28px
	}
	.bb_msg_head_new p {
    font-weight: 500;
    font-size: 16px;
    line-height: 20px;
    margin: 0;
	}
	.bb_msg_head_new p span {
    font-size: 13px;
    font-weight: 400;
	}
	.bb_drop_icon_new {
    position: absolute;
    top: 30px;
    right: 23px;
    width: 15px;
    height: 15px;
	}
	.bb_drop_icon_new a {
    color: #fff;
    opacity: 0.5
	}
	.bb_img_icon_new {
    position: absolute;
    top: 20px;
    left: 23px;
    width: 38px;
    height: 38px;
	}
	.bb_img_icon_new img {
    border-radius: 100px;
    width: 36px;
    height: 36px;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.17);
    border: 2px solid #fff;
	}
	.bb_img_icon_new.big {
    width: 53px;
    height: 53px;
    top: -26px;
    left: 50%;
    margin-left: -26px;
	}
	.bb_img_icon_new.big img {
    border-radius: 100px;
    width: 53px;
    height: 53px;
    box-shadow: 0 5px 4px 0 rgba(0, 5, 76, 0.04), 0 5px 10px 0 rgba(12, 12, 44, 0.02);
    border: 0px solid #fff;
	}
	/*img.headimgsmall {
    position: absolute;
    top: 9px;
    left: 15px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
	}*/
	/*span.phonenumber {
    font-size: 10px;
    color: rgba(255, 255, 255, 0.8)!important
	}*/
	.msg_body_new {
    width: 100%;
    box-sizing: border-box;
    height: 420px;
    padding: 28px;
    overflow-y: hidden;
    overflow-x: hidden;
    background-color: #f3f3fa;
	}
	.msg_body_new:hover {
    overflow-y: auto
	}
	.msg_footer_new {
    padding: 5px 10px;
    box-sizing: border-box;
    position: relative;
    border-radius: 0 0 10px 10px;
    height: 60px;
    box-shadow: 0 -1px 4px 0 rgba(12, 12, 44, 0.03);
	}
	.bb_smg_smiley_new {
    position: absolute;
    color: #fff;
    width: 90%;
    padding: 15px;
    bottom: 55px;
    left: 5%;
    box-sizing: border-box;
    background-image: linear-gradient(103deg, #5c37f2, #aa7bff);
    border-radius: 10px;
    /*display: none;*/
	}
	.bb_smg_smiley_new a {
    display: inline-block;
    width: 24px;
    height: 28px;
	}
	.bb_smg_smiley_new a img {
    width: 20px;
    height: 20px;
	}
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
	.msg_input_new {
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
	/*.close {
    float: right;
    cursor: pointer;
    margin-top: -25px;
	}*/
	.minimize {
    float: right;
    cursor: pointer;
    padding-right: 5px;
	}
	.bb_msg_push, .bb_msg {
    float: left;
    width: 100%;
	}
	/*.msg-left {
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
	}*/
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
    position: absolute;
    box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03);
    border-radius: 100px 0px 100px 100px;
    background: #8158f8;
    text-align: center;
    line-height: 52px;
    bottom: -80px;
    right: 0px;
    font-family: 'Inter UI';
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
	.company_profile_sec {
    width: 100%;
    min-height: 208px;
    border-radius: 5px;
    box-shadow: 0 5px 4px 0 rgba(0, 5, 76, 0.02), 0 5px 10px 0 rgba(12, 12, 44, 0.03);
    background-color: #fff;
    margin-top: 40px;
    padding: 30px;
    color: #202040;
    box-sizing: border-box
	}
	.company_profile_sec p span {
    font-size: 14px;
	}
	.company_profile_sec .img_sec {
    margin-bottom: 15px;
	}
	.company_profile_sec .img_sec img {
    border-radius: 100px;
    width: 36px;
    height: 36px;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.17);
    border: 2px solid #fff;
    margin: 0 -5px;
	}
	
	.chat_badge{ position:absolute; background:#fff; left:0px; line-height:15px; font-weight:bold; z-index:111; width: 15.2px;  height: 15.2px;border-radius:50px; font-size:9px; color:#eb586e;  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.05);}
	.noti_left{ left: 40px;}
	
	
	.chat_widget_bot_right{width: 100%; max-width: 340px; font-family: 'Inter UI'; bottom: 1px; right:0px;}	
	.bb_white_box{width: 100%;  padding: 20px;  border-radius: 5px;  background-color: #ffffff;    box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.05), 0 0 1px 0 rgba(0, 0, 0, 0.03); position: relative; margin-bottom: 10px; box-sizing: border-box;}
	.bb_white_box p{font-size: 15px; color: #102243; font-weight: 600; margin: 5px 0; }
	.bb_white_box p span{font-size: 14px; color: #22375e; font-weight: 400; }
	.bb_chatbox .form-control{border-radius: 5px;  background-color: #ffffff;    box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.05), 0 0 1px 0 rgba(0, 0, 0, 0.03); border: none!important; font-weight: 200!important; height: 48px; padding-left: 20px; width: 100%; box-sizing: border-box; font-size: 14px;	resize: none;	font-family: 'Inter UI'; }
	
	
	.image_icon{position: absolute; top: -16px; left: 25px; width: 32px; height: 32px; background: #fff; border-radius: 100px; box-shadow:  0 8px 8px 0 rgba(0, 27, 96, 0.13), 0 0 1px 0 rgba(0, 0, 0, 0.03);}
	.image_icon img{width: 32px; height: 32px; border-radius: 100px;}
</style>

<style type="text/css">
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:40px;}
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .product_icon img{ width: 50px; height: 50px; border-radius: 100px;}
    .dropzone .dz-default.dz-message:before {font-size: 80px; top: 48px; width: 0px; height: 0px; margin-left: -32px;}
    .dropzone .dz-preview.dz-image-preview { display:none !important;}
	
    .position_left { left:30px!important; }
	
    .red_preview_1{background-image: linear-gradient(45deg, #e93474, #541069 98%);}
    .yellow_preview_1{background-image: linear-gradient(42deg, #f9d84a, #f9814a);}
    .orange_preview_1{background-image: linear-gradient(45deg, #ef9d39, #d92a3f);}
    .green_preview_1{background-image: linear-gradient(43deg, #93cf48, #076768);}
    .blue_preview_1{background-image: linear-gradient(43deg, #4194f7 3%, #1b1f97 99%);}
    .purple_preview_1{background-image: linear-gradient(45deg, #4d4d7c 1%, #1e1e40);}
	
    .bb_iconbox .fa { color: #fff; }
	
    .iconLeft { left: 0; border-radius: 0 100px 100px 100px; }
	
	.choose_orientation li a.active {
		border: 1px solid #ddd;
	}
	
	.previewWidgetBox .white_preview_1{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #ffffff, #ffffff 98%)!important;}
    .previewWidgetBox .red_preview_1{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #e93474, #541069 98%)!important;}
    .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #f9d84a, #f9814a)!important;}
    .previewWidgetBox .orange_preview_1{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #ef9d39, #d92a3f)!important;}
    .previewWidgetBox .green_preview_1{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #93cf48, #076768)!important;}
    .previewWidgetBox .blue_preview_1{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #4194f7 3%, #1b1f97 99%)!important;}
    .previewWidgetBox .purple_preview_1{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #4d4d7c 1%, #1e1e40)!important;}
	
	.toRightTop .previewWidgetBox .white_preview_1{background-image: linear-gradient(to right top, #ffffff, #ffffff 98%)!important;}
    .toRightTop .previewWidgetBox .red_preview_1{background-image: linear-gradient(to right top, #e93474, #541069 98%)!important;}
    .toRightTop .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to right top, #f9d84a, #f9814a)!important;}
    .toRightTop .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to right top, #ef9d39, #d92a3f)!important;}
    .toRightTop .previewWidgetBox .green_preview_1{background-image: linear-gradient(to right top, #93cf48, #076768)!important;}
    .toRightTop .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to right top, #4194f7 3%, #1b1f97 99%)!important;}
    .toRightTop .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to right top, #4d4d7c 1%, #1e1e40)!important;}
	
	.toRight .previewWidgetBox .white_preview_1{background-image: linear-gradient(to right, #ffffff, #ffffff 98%)!important;}
    .toRight .previewWidgetBox .red_preview_1{background-image: linear-gradient(to right, #e93474, #541069 98%)!important;}
    .toRight .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to right, #f9d84a, #f9814a)!important;}
    .toRight .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to right, #ef9d39, #d92a3f)!important;}
    .toRight .previewWidgetBox .green_preview_1{background-image: linear-gradient(to right, #93cf48, #076768)!important;}
    .toRight .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to right, #4194f7 3%, #1b1f97 99%)!important;}
    .toRight .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to right, #4d4d7c 1%, #1e1e40)!important;}
	
	.toRightBottom .previewWidgetBox .white_preview_1{background-image: linear-gradient(to right bottom, #ffffff, #ffffff 98%)!important;}
    .toRightBottom .previewWidgetBox .red_preview_1{background-image: linear-gradient(to right bottom, #e93474, #541069 98%)!important;}
    .toRightBottom .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to right bottom, #f9d84a, #f9814a)!important;}
    .toRightBottom .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to right bottom, #ef9d39, #d92a3f)!important;}
    .toRightBottom .previewWidgetBox .green_preview_1{background-image: linear-gradient(to right bottom, #93cf48, #076768)!important;}
    .toRightBottom .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to right bottom, #4194f7 3%, #1b1f97 99%)!important;}
    .toRightBottom .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to right bottom, #4d4d7c 1%, #1e1e40)!important;}
	
	.toBottom .previewWidgetBox .white_preview_1{background-image: linear-gradient(to bottom, #ffffff, #ffffff 98%)!important;}
    .toBottom .previewWidgetBox .red_preview_1{background-image: linear-gradient(to bottom, #e93474, #541069 98%)!important;}
    .toBottom .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to bottom, #f9d84a, #f9814a)!important;}
    .toBottom .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to bottom, #ef9d39, #d92a3f)!important;}
    .toBottom .previewWidgetBox .green_preview_1{background-image: linear-gradient(to bottom, #93cf48, #076768)!important;}
    .toBottom .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to bottom, #4194f7 3%, #1b1f97 99%)!important;}
    .toBottom .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to bottom, #4d4d7c 1%, #1e1e40)!important;}
	
	.toLeftBottom .previewWidgetBox .white_preview_1{background-image: linear-gradient(to left bottom, #ffffff, #ffffff 98%)!important;}
    .toLeftBottom .previewWidgetBox .red_preview_1{background-image: linear-gradient(to left bottom, #e93474, #541069 98%)!important;}
    .toLeftBottom .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to left bottom, #f9d84a, #f9814a)!important;}
    .toLeftBottom .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to left bottom, #ef9d39, #d92a3f)!important;}
    .toLeftBottom .previewWidgetBox .green_preview_1{background-image: linear-gradient(to left bottom, #93cf48, #076768)!important;}
    .toLeftBottom .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to left bottom, #4194f7 3%, #1b1f97 99%)!important;}
    .toLeftBottom .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to left bottom, #4d4d7c 1%, #1e1e40)!important;}
	
	.toLeft .previewWidgetBox .white_preview_1{background-image: linear-gradient(to left, #ffffff, #ffffff 98%)!important;}
    .toLeft .previewWidgetBox .red_preview_1{background-image: linear-gradient(to left, #e93474, #541069 98%)!important;}
    .toLeft .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to left, #f9d84a, #f9814a)!important;}
    .toLeft .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to left, #ef9d39, #d92a3f)!important;}
    .toLeft .previewWidgetBox .green_preview_1{background-image: linear-gradient(to left, #93cf48, #076768)!important;}
    .toLeft .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to left, #4194f7 3%, #1b1f97 99%)!important;}
    .toLeft .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to left, #4d4d7c 1%, #1e1e40)!important;}
	
	.toLeftTop .previewWidgetBox .white_preview_1{background-image: linear-gradient(to left top, #ffffff, #ffffff 98%)!important;}
    .toLeftTop .previewWidgetBox .red_preview_1{background-image: linear-gradient(to left top, #e93474, #541069 98%)!important;}
    .toLeftTop .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to left top, #f9d84a, #f9814a)!important;}
    .toLeftTop .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to left top, #ef9d39, #d92a3f)!important;}
    .toLeftTop .previewWidgetBox .green_preview_1{background-image: linear-gradient(to left top, #93cf48, #076768)!important;}
    .toLeftTop .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to left top, #4194f7 3%, #1b1f97 99%)!important;}
    .toLeftTop .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to left top, #4d4d7c 1%, #1e1e40)!important;}
	
	.toTop .previewWidgetBox .white_preview_1{background-image: linear-gradient(to top, #ffffff, #ffffff 98%)!important;}
    .toTop .previewWidgetBox .red_preview_1{background-image: linear-gradient(to top, #e93474, #541069 98%)!important;}
    .toTop .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(to top, #f9d84a, #f9814a)!important;}
    .toTop .previewWidgetBox .orange_preview_1{background-image: linear-gradient(to top, #ef9d39, #d92a3f)!important;}
    .toTop .previewWidgetBox .green_preview_1{background-image: linear-gradient(to top, #93cf48, #076768)!important;}
    .toTop .previewWidgetBox .blue_preview_1{background-image: linear-gradient(to top, #4194f7 3%, #1b1f97 99%)!important;}
    .toTop .previewWidgetBox .purple_preview_1{background-image: linear-gradient(to top, #4d4d7c 1%, #1e1e40)!important;}
	
	.orientationCircle .previewWidgetBox .white_preview_1{background-image: radial-gradient(circle, #ffffff, #ffffff 98%)!important;}
    .orientationCircle .previewWidgetBox .red_preview_1{background-image: radial-gradient(circle, #e93474, #541069 98%)!important;}
    .orientationCircle .previewWidgetBox .yellow_preview_1{background-image: radial-gradient(circle, #f9d84a, #f9814a)!important;}
    .orientationCircle .previewWidgetBox .orange_preview_1{background-image: radial-gradient(circle, #ef9d39, #d92a3f)!important;}
    .orientationCircle .previewWidgetBox .green_preview_1{background-image: radial-gradient(circle, #93cf48, #076768)!important;}
    .orientationCircle .previewWidgetBox .blue_preview_1{background-image: radial-gradient(circle, #4194f7 3%, #1b1f97 99%)!important;}
	.orientationCircle .previewWidgetBox .purple_preview_1{background-image: radial-gradient(circle, #4d4d7c 1%, #1e1e40)!important;}
	
	.bb_msg_head_new, .bb_chat_action_icon_white, .bb_white_box_main_box{
		<?php 
		if($colorOrientation != 'circle'){
			echo $oChat->header_color_custom == '1' ? 'background-image:linear-gradient(' . $colorOrientation . ', ' . $oChat->header_custom_color1 . ' 1%, ' . $oChat->header_custom_color2 . ');' : ''; 
		}else{
			echo $oChat->header_color_custom == '1' ? 'background-image:radial-gradient(' . $colorOrientation . ', ' . $oChat->header_custom_color1 . ' 1%, ' . $oChat->header_custom_color2 . ');' : ''; 
		}
		?>
		<?php echo $oChat->header_color_solid == '1' ? 'background:' . $oChat->header_solid_color.';' : ''; ?>
	}
</style>


<div class="row">
	<div class="col-md-3">
		<!--=======Design & configuration=====-->
		<div class="panel panel-flat bx_shadow1">
			<div class="panel-heading">
				<ul class="nav nav-tabs nav-tabs-bottom">
					<li class="active"><a href="#Configurations" data-toggle="tab" aria-expanded="false">Configurations</a></li>
					<li class=""><a href="#Design" data-toggle="tab" aria-expanded="false">Design</a></li>
				</ul>
			</div>
			<div class="panel-body p0">
				<div class="tab-content"> 
					
					
					<div class="tab-pane active" id="Configurations">
						<form method="post" name="frmSubmit" id="frmSubmit" action="javascript:void(0);"  enctype="multipart/form-data">
							<div class="profile_headings fsize12 fw500">Components <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
							<div class="p20">
								<div class="row">
									<div class="col-md-12"> 
										
										<div class="form-group mb10">
											<p class="pull-left mb0">Logo / company avatar</p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="logo_show" id="logo_show" <?php echo $oChat->logo_show == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
										<div class="form-group mb10">
											<p class="pull-left mb0">Title</p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="title_show" id="title_show" <?php echo $oChat->title_show == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
										<div class="form-group mb10">
											<p class="pull-left mb0">Sub Title</p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="subtitle_show" id="subtitle_show" <?php echo $oChat->subtitle_show == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
										<div class="form-group mb10">
											<p class="pull-left mb0">Attachment</p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="atttachment_show" id="attachment_show" <?php echo $oChat->atttachment_show == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
										<div class="form-group mb0">
											<p class="pull-left mb0">Smily</p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="smilie_show" id="smilie_show" <?php echo $oChat->smilie_show == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="profile_headings fsize12 fw500">Auto message <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
							
							<div class="p25">
								<div class="row">
									<div class="col-md-12" style="display:none;">
										<div class="form-group">
											<label class="control-label">Triger</label>
											<div class="">
												<select class="form-control" name="trigger_time">
													<option value="10" <?php echo $oChat->trigger_time == 10? 'selected':''; ?>>After 10 seconds</option>
													<option value="20" <?php echo $oChat->trigger_time == 20? 'selected':''; ?>>After 20 seconds</option>
													<option value="30" <?php echo $oChat->trigger_time == 30? 'selected':''; ?>>After 30 seconds</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb0">
											<label class="control-label">Message</label>
											
											<div class="import_box p0">
												<div class="p20 bbot"><p class="mb0">From <strong>Max Ive</strong></p></div>
												<div class="p0">
													<textarea style="border: none;" name="trigger_message" class="form-control p25" rows="6" placeholder="Hi! How can I help you?" required><?php echo $oChat->trigger_message ? $oChat->trigger_message : ''; ?></textarea>
												</div>
												
											</div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="form-group mt20">
											<label class="control-label">Gift Message</label>
											
											<label class="custom-form-switch pull-right mb10">
												<input class="field" type="checkbox" id="allow_gift_message" name="allow_gift_message" <?php echo $oChat->allow_gift_message == 1 ? 'checked' : ''; ?>>
												<span class="toggle blue"></span>
											</label>
											<div class="import_box p0 giftMessageBox <?php echo $oChat->allow_gift_message == 1 ? '' : 'hidden'; ?>">
												<div class="p20 bbot"><p class="mb0">From <strong>Max Ive</strong></p></div>
												<div class="p0">
													<textarea style="border: none;" name="gift_message" class="form-control p25" rows="6" placeholder="We give you 3 month free trial!"><?php echo $oChat->gift_message ? $oChat->gift_message : ''; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="profile_headings fsize12 fw500">Other <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
							<div class="p25">
								<div class="row">
									<div class="col-md-12"> 
										<div class="form-group mb10">
											<p class="pull-left mb0">Show on desktop </p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="desktop_visiable" <?php echo $oChat->desktop_visiable == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
										<div class="form-group mb10">
											<p class="pull-left mb0">Show on mobile</p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="mobile_visiable" <?php echo $oChat->mobile_visiable == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
									</div>
								</div>
							</div>
							<input type="hidden" name="chat_id" value="<?php echo $oChat->id; ?>" />
							<div class="p25 btop">
								<button style="height:52px!important;" type="submit" class="btn dark_btn bkg_blue h52 w100" >Save</button>
							</div>
						</form>
					</div>
					
					
					<div class="tab-pane" id="Design">
						<div class="profile_headings fsize12 fw500">Chat appearance <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
						<form method="post" name="frmSubmitDesign" id="frmSubmitDesign" action="javascript:void(0);"  enctype="multipart/form-data">
							<div class="p20">
								<div class="barand_avatar mb20">
									<?php if(!empty($oChat->chat_logo)) {?>
										<img width="64" class="rounded company_avatar" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oChat->chat_logo; ?>" />
										<?php } else {
										?> <img width="64" class="rounded company_avatar" src="/assets/images/wakerslogo.png"/>
										<?php }
										
										if(!empty($userData->avatar)) {
											?><img width="64" class="rounded" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $userData->avatar; ?>"/> <?php
										} 
										else {
											?><img width="64" class="rounded" src="/assets/images/face2.jpg"/> <?php
										}
									?>
									
								</div>
								
								<div class="form-group">
									<label class="control-label txt_upper fsize11 fw500 text-muted">Company Avatar</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-upload7"></i></span>
										<!-- <input name="domain" id="domain" class="form-control" required="" placeholder="or drag and drop file" type="text"> -->
										<div class="dropzone" id="myDropzone_logo_img"></div>
										<input style="display: none;"  type="text" name="chat_logo" id="chat_logo" value="<?php echo (!empty($oChat->chat_logo)) ? $oChat->chat_logo : ''; ?>" >
									</div>
								</div>	
								
								<div class="mb20">
									<label class="control-label txt_upper fsize11 fw500 text-muted">Company info</label>
									<div class="form-group pull-right mb0">
										<p class="pull-left mb0 fsize11 fw500 text-muted mr-5">USE DEFAULT</p>
										<label class="custom-form-switch pull-right">
											<input class="field" type="checkbox" <?php echo ($oChat->company_info > 0 || empty($oChat)) ? 'checked' : ''; ?> name="company_info_switch" id="company_info_switch">
										<span class="toggle dred"></span> </label>
										<div class="clearfix"></div>
									</div>
									
									<div id="default_company_info_box" <?php echo ($oChat->company_info > 0 || empty($oChat)) ? 'style="display:block;"' : 'style="display:none;"'; ?> class="import_box p0">
										<div class="p20 bbot">
											<p class="mb0"><strong><?php echo $oChat->company_title != ''?$oChat->company_title:'Wakers Inc.'; ?></strong></p>
										</div>
										<div class="p20">
											<?php echo $oChat->company_description != ''?nl2br($oChat->company_description):'So strongly and metaphysically did I conceive of my situation then, that while earnestly watching his motions our company.'; ?>
										</div>
									</div>
									<div id="custom_company_info_box" <?php echo ($oChat->company_info > 0 || empty($oChat)) ? 'style="display:none;"' : 'style="display:block;"'; ?>>
										<div class="p10 bbot">
											<p class="mb0">
												<strong>
													<input name="company_title" id="custom_company_name" class="form-control" placeholder="Company Name" type="text" style="border:none; background:#FBFBFD; padding-left:10px;" value="<?php //echo $brandData->company_info_name == '' ? $oChat->company_title : $brandData->company_info_name;?>">
												</strong>
											</p>
										</div>
										<div class="p10">
											<textarea name="company_description" style="border:none; background:#FBFBFD; padding-left:10px; padding-top:10px;" id="custom_company_description" class="form-control"><?php //echo $brandData->company_info_description == '' ? $oChat->company_description : $brandData->company_info_description;?></textarea>
										</div>
									</div>
									
								</div>
								
								<div class="form-group mb0">
									<label class="control-label">Position on page</label>
									<div class="">
										<select class="form-control change_position" name="position">
											<option value="right" <?php echo ($oChat->position == 'right') ? 'selected' : ''; ?>>Right</option>
											<option value="left" <?php echo ($oChat->position == 'left') ? 'selected' : ''; ?>>Left</option>
										</select>
									</div>
								</div>
								
							</div>
							
							<!--  <div class="profile_headings fsize12 fw500">Branding <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
								<div class="p20">
								<div class="mb20">
								<label class="control-label txt_upper fsize11 fw500 text-muted">MAIN color</label>
								<div class="form-group pull-right mb0">
								<p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Gradient</p>
								<label class="custom-form-switch pull-right">
								<input class="field" type="checkbox" checked="">
								<span class="toggle blue"></span> </label>
								<div class="clearfix"></div>
								</div>
								<div class="color_box">
								<div class="color_cube dred"></div>
								<div class="color_cube yellow"></div>
								<div class="color_cube red"></div>
								<div class="color_cube green active"></div>
								<div class="color_cube blue"></div>
								<div class="color_cube black"></div>
								<div class="clearfix"></div>
								</div>
								</div>
								
								
								<div class="form-group mb0">
								<label class="control-label txt_upper fsize11 fw500 text-muted">Color picker</label>
								<div class="form-group pull-right mb0">
								<p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Custom color</p>
								<label class="custom-form-switch pull-right">
								<input class="field" type="checkbox" checked="">
								<span class="toggle blue"></span> </label>
								<div class="clearfix"></div>
								</div>
								<div class="position-relative mt-5">
								<input name="domain" class="form-control" placeholder="#1C6FDF" type="text">
								<a style="position: absolute; top: 10px; right: 10px;" class="colorpicker-show-input" href="#"><i class="fa fa-circle txt_blue fsize18" ></i></a>
								</div>
								
								<div class="position-relative mt-15 mb-15">
								<input name="domain" class="form-control" placeholder="#1C6FDF" type="text">
								<a style="position: absolute; top: 10px; right: 10px;" class="colorpicker-show-input" href="#"><i class="fa fa-circle txt_blue fsize18" ></i></a>
								</div>
								
								<div class="row">
								<div class="col-xs-4"><input type="text" class="form-control colorpicker-show-input" data-preferred-format="name" value="#f75d1c"></div>
								<div class="col-xs-4"><input type="text" class="form-control colorpicker-show-input" data-preferred-format="name" value="#333333"></div>
								</div>
								
								
								</div>
								
								
								
							</div> -->
							
							<div class="profile_headings txt_upper p20 fsize11 fw600">Branding <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
							<div class="p20">
								<div class="mb20">
									<label class="control-label txt_upper fsize11 fw500 text-muted">Single Color picker</label>
									<div class="form-group pull-right mb0">
										<p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Solid color</p>
										<label class="custom-form-switch pull-right">
											<input class="field" type="checkbox" <?php echo $oChat->header_color_solid < 1 ? '' : 'checked'; ?> name="solid_color_switch" id="solid_color_switch">
										<span class="toggle dred"></span> </label>
										<div class="clearfix"></div>
									</div>
									
									<div class="row">
										<div class="position-relative mt-5 col-md-12">
											<input name="solid_color" class="form-control" id="solid_color" placeholder="#FF0000" type="text" value="<?php echo $oChat->header_solid_color == '' ? '#FF0000' : $oChat->header_solid_color; ?>" <?php echo $oChat->header_color_solid < 1 ? 'readonly' : ''; ?>>
											<a style="position: absolute; top: 10px; right: 20px;" class="solidcolorpicker colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $oChat->header_solid_color == '' ? 'style="color:#FF0000"' : 'style="color:'.$oChat->header_solid_color.'"'; ?>></i></a>
										</div>
										
									</div>
								</div>
								<div class="form-group">
									<label class="control-label txt_upper fsize11 fw500 text-muted">MAIN Gradient color</label>
									<div class="form-group pull-right mb0">
										<p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Gradient</p>
										<label class="custom-form-switch pull-right">
											<input class="field" type="checkbox" <?php echo ($oChat->header_color_fix > 0 || empty($oChat)) ? 'checked' : ''; ?> name="main_color_switch" id="main_color_switch">
										<span class="toggle dred"></span> </label>
										<div class="clearfix"></div>
									</div>
									<div class="color_box">
										<input type="hidden" name="main_colors" id="main_colors" value="<?php echo $oChat->header_color == '' ? 'green' : $oChat->header_color; ?>">
										<div class="color_cube dred selectMainColor <?php echo $oChat->header_color == 'red' ? 'active' : ''; ?>" color-data='red' color-class="red_preview_1"></div>
										<div class="color_cube yellow selectMainColor <?php echo $oChat->header_color == 'yellow' ? 'active' : ''; ?>" color-data='yellow' color-class="yellow_preview_1"></div>
										<div class="color_cube red selectMainColor <?php echo $oChat->header_color == 'orange' ? 'active' : ''; ?>" color-data='orange' color-class="orange_preview_1"></div>
										<div class="color_cube green selectMainColor <?php echo ($oChat->header_color == '' || $oChat->header_color == 'green') ? 'active' : ''; ?>" color-data='green' color-class="green_preview_1"></div>
										<div class="color_cube blue selectMainColor <?php echo $oChat->header_color == 'blue' ? 'active' : ''; ?>" color-data='blue' color-class="blue_preview_1"></div>
										<div class="color_cube black selectMainColor <?php echo $oChat->header_color == 'purple' ? 'active' : ''; ?>" color-data='purple' color-class="purple_preview_1"></div>
										<div class="clearfix"></div>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label txt_upper fsize11 fw500 text-muted">Gradient Color picker</label>
									<div class="form-group pull-right mb0">
										<p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Custom Gradient color</p>
										<label class="custom-form-switch pull-right">
											<input class="field" type="checkbox" <?php echo $oChat->header_color_custom < 1 ? '' : 'checked'; ?> name="custom_color_switch" id="custom_color_switch">
										<span class="toggle dred"></span> </label>
										<div class="clearfix"></div>
									</div>
									<div class="row">
										<div class="position-relative mt-5 col-md-6">
											<input name="custom_colors1" class="form-control" id="custom_colors1" placeholder="#000000" type="text" value="<?php echo $oChat->header_custom_color1 == '' ? '#000000' : $oChat->header_custom_color1; ?>" <?php echo $oChat->header_color_custom < 1 ? 'readonly' : ''; ?>>
											<a style="position: absolute; top: 10px; right: 20px;" class="colorpicker1 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $oChat->header_custom_color1 == '' ? 'style="color:#000000"' : 'style="color:'.$oChat->header_custom_color1.'"'; ?>></i></a>
										</div>
										
										<div class="position-relative mt-5 col-md-6">
											<input name="custom_colors2" class="form-control" id="custom_colors2" placeholder="#FF0000" type="text" value="<?php echo $oChat->header_custom_color2 == '' ? '#FF0000' : $oChat->header_custom_color2; ?>" <?php echo $oChat->header_color_custom < 1 ? 'readonly' : ''; ?>>
											<a style="position: absolute; top: 10px; right: 20px;" class="colorpicker2 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $oChat->header_custom_color2 == '' ? 'style="color:#FF0000"' : 'style="color:'.$oChat->header_custom_color2.'"'; ?>></i></a>
										</div>
									</div>
								</div>
								<div class="row orientation_top" style="<?php echo $oChat->header_color_solid == 1 ? 'display:none;' : 'display:block'; ?>">
									<div class="col-md-12">
										<div style="margin: 25px 0 15px!important;" class="profile_headings txt_upper fsize11 fw600">Choose orientation</div>
									</div>
									<div class="col-md-12">
										<input type="hidden" value="<?php echo $colorOrientation; ?>" id="color_orientation" name="color_orientation">
										<ul class="choose_orientation">
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to right top' ? 'active' : ''; ?>" color-orientation="to right top" main-orientation-class="toRightTop" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to right' ? 'active' : ''; ?>" color-orientation="to right" main-orientation-class="toRight" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to right bottom' ? 'active' : ''; ?>" color-orientation="to right bottom" main-orientation-class="toRightBottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to bottom' ? 'active' : ''; ?>" color-orientation="to bottom" main-orientation-class="toBottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to left bottom' ? 'active' : ''; ?>" color-orientation="to left bottom" main-orientation-class="toLeftBottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to left' ? 'active' : ''; ?>" color-orientation="to left" main-orientation-class="toLeft" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to left top' ? 'active' : ''; ?>" color-orientation="to left top" main-orientation-class="toLeftTop" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'to top' ? 'active' : ''; ?>" color-orientation="to top" main-orientation-class="toTop" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
											<li><a class="gradientOrientation <?php echo $colorOrientation == 'circle' ? 'active' : ''; ?>" color-orientation="circle" main-orientation-class="orientationCircle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="profile_headings fsize12 fw500">Chat button <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
							<div class="p25">
								<div class="form-group hidden">
									<label class="control-label">Shape</label>
									<div class="">
										<select class="form-control">
											<option>Chat bubble</option>
											<option>Chat bubble</option>
										</select>
									</div>
								</div>
								
								<div class="form-group mb0">
									<label class="control-label">Chat icon</label>
									<div class="chat_icon_box">
										<input type="hidden" name="chat_icon" id="changeChatIcon" value=" <?php echo $oChat->chat_icon != ''?$oChat->chat_icon:'3'; ?>">
										
										<a class="chat_icon <?php echo $oChat->chat_icon == '1'?'active':''; ?> <?php echo ($oChat->position == 'left') ? 'leftalign' : ''; ?>" attr="1" style="cursor: pointer;"><img width="16" src="/assets/images/chat_design_icon1.png"/></a>
										
										<a class="chat_icon <?php echo $oChat->chat_icon == '2'?'active':''; ?> <?php echo ($oChat->position == 'left') ? 'leftalign' : ''; ?>" attr="2" style="cursor: pointer;"><img width="19" src="/assets/images/chat_design_icon2.png"/></a>
										
										<a class="chat_icon <?php echo $oChat->chat_icon == '3'?'active':''; ?> <?php echo ($oChat->position == 'left') ? 'leftalign' : ''; ?>" attr="3" style="cursor: pointer;"><img width="25" src="/assets/images/chat_design_icon3.png"/></a>
										
										<a class="chat_icon <?php echo $oChat->chat_icon == '4'?'active':''; ?> <?php echo ($oChat->position == 'left') ? 'leftalign' : ''; ?>" attr="4" style="cursor: pointer;"><img width="25" src="/assets/images/chat_design_icon4.png"/></a>
										
										<a class="chat_icon <?php echo $oChat->chat_icon == '5'?'active':''; ?> <?php echo ($oChat->position == 'left') ? 'leftalign' : ''; ?>" attr="5" style="cursor: pointer;"><img width="25" src="/assets/images/chat_design_icon5.png"/></a>  
									</div>
								</div>
								
							</div>
							
							
							<div class="profile_headings fsize12 fw500">Other <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
							<div class="p25">
								<div class="row">
									<div class="col-md-12"> 
										
										<div class="form-group mb10 hidden">
											<p class="pull-left mb0">Notification </p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="notification" id="notification_chat" <?php echo $oChat->notification == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
										<div class="form-group mb10">
											<p class="pull-left mb0">Hide Brand Boost branding</p>
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" name="branding" <?php echo $oChat->branding == 1? 'checked':''; ?>>
											<span class="toggle blue"></span> </label>
											<div class="clearfix"></div>
										</div>
										
									</div>
								</div>
							</div>
							
							<input type="hidden" name="chat_id" value="<?php echo $oChat->id; ?>" />
							<div class="p25 btop">
								<button style="height:52px!important;" type="submit" class="btn dark_btn bkg_blue h52 w100" >Save</button>
							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div style="margin: 0;" class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title pull-left display-inline-block">Preview</h6> &nbsp; &nbsp; 
				<!--<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-rotate-ccw3"></i>&nbsp; Undo</a></h6> &nbsp; &nbsp; 
				<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-rotate-cw3"></i>&nbsp; Redo</a></h6>-->
				
				<!--<div class="heading-elements">
					<h6 class="panel-title display-inline-block"><a class="active" href="#"><i class="icon-display"></i>&nbsp; Desktop </a></h6>
					<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-ipad"></i>&nbsp; Tablet</a></h6>
					<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-iphone"></i>&nbsp; Mobile</a></h6>
				</div>-->
				
			</div>
			<div class="panel-body p20">
				<div class="widget_sec <?php echo $mainWigetClassName; ?>"  id="bbColorOrientationSection">
					<!--=========================================Chat Widget 1=============================================-->
					
					<div class="msg_box_new hidden previewWidgetBox" id="bbchatpopup">
						<div class="bb_msg_head_new <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="<?php echo $oChat->header_color_solid == '1' ? 'background:'.$oChat->header_solid_color : ''; ?> <?php echo $oChat->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, '.$oChat->header_custom_color1.' 1%, '.$oChat->header_custom_color2.')' : ''; ?>">
							<div class="bb_img_icon_new">
								<img width="32" src="/assets/images/face3.jpg"/>
							</div>
							<div class="bb_drop_icon_new"><a href="#"><i class="fa fa-chevron-down"></i></a></div>
							<p>Garrett Glover</p>
							<p><span>Typically replies in 15 min</span></p>
						</div>
						<div id="bb_msg_wrap" > 
							<div class="msg_body_new">
								<div class="bb_msg_push">									
									<div class="bb_msg"><div class="msg-left">Hi! I need help with pricing.</div></div>
									<div class="bb_msg"><div class="msg-right <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="<?php echo $oChat->header_color_solid == '1' ? 'background:'.$oChat->header_solid_color : ''; ?> <?php echo $oChat->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, '.$oChat->header_custom_color1.' 1%, '.$oChat->header_custom_color2.')' : ''; ?>">Hey Max! It looks like you've been chatting with a member of our team, that's awesome</div></div>
									<div class="bb_msg"><div class="msg-right <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="<?php echo $oChat->header_color_solid == '1' ? 'background:'.$oChat->header_solid_color : ''; ?> <?php echo $oChat->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, '.$oChat->header_custom_color1.' 1%, '.$oChat->header_custom_color2.')' : ''; ?>">Have you checked our price page?</div></div>
									<div class="bb_msg"><div class="msg-left">Hey Max! It looks like you've been chatting with a member of our team, that's awesome</div></div>
									<div class="bb_msg"><div class="msg-right <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="<?php echo $oChat->header_color_solid == '1' ? 'background:'.$oChat->header_solid_color : ''; ?> <?php echo $oChat->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, '.$oChat->header_custom_color1.' 1%, '.$oChat->header_custom_color2.')' : ''; ?>">Thanks!</div></div>
									
								</div> 
							</div>
							<div class="msg_footer_new">
								<div id="bb_smiley_box2" class="bb_smg_smiley_new hidden <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="<?php echo $oChat->header_color_solid == '1' ? 'background:'.$oChat->header_solid_color : ''; ?> <?php echo $oChat->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, '.$oChat->header_custom_color1.' 1%, '.$oChat->header_custom_color2.')' : ''; ?>">
									<a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"/></a>
									<a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"/></a>
									
								</div>
								<div class="msg_att">
									<a onclick="smileyShowHide()" style="cursor: pointer;" class="smilieShow <?php echo $oChat->smilie_show == 1? '':'hidden'; ?>"><i class="fa fa-smile-o"></i></a>
									<a style="cursor: pointer;" class="attachmentShow <?php echo $oChat->atttachment_show == 1? '':'hidden'; ?>"><i class="fa fa-paperclip"></i></a>
								</div>
								<input type="text" class="bb_chat_msg_input msg_input_new" id="bb_chat_msg_input2" placeholder="Type a message..." />
							</div>  
						</div> 
												
						<div class="bb_chat_action_icon_white <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="<?php echo $oChat->header_color_solid == '1' ? 'background:'.$oChat->header_solid_color : ''; ?> <?php echo $oChat->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, '.$oChat->header_custom_color1.' 1%, '.$oChat->header_custom_color2.')' : ''; ?>">
							<div class="bb_iconbox"><a href="#"><img class="bb_iconbox_img" style="width: 20px;" src="/assets/images/chat_design_icon<?php echo $oChat->chat_icon; ?>.png" /></a></div>
						</div>
						
					</div>
					
					<!--=========================================Chat Widget 1=============================================-->
					<div class="msg_box_new2 previewWidgetBox <?php if($oChat->position == 'left') { echo 'position_left'; }?>" id="bbchatpopup2">
						<div class="woGiftChatBox <?php echo $oChat->allow_gift_message == 1 ? 'hidden' : ''; ?>">
							<div class="bb_msg_head_new big <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="">
								<div class="bb_img_icon_new big <?php echo $oChat->logo_show == 1? '':'hidden'; ?>">
									<?php if(!empty($oChat->chat_logo)) {?>
										<img width="53" class="rounded company_avatar" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oChat->chat_logo; ?>" />
										<?php } else {
										?> <img width="53" class="rounded company_avatar" src="/assets/images/wakerslogo.png"/>
									<?php } ?>
								</div>
								<p style="margin-bottom: 10px;" class="company_name <?php echo $oChat->title_show == 1? '':'hidden'; ?>"><?php echo $oChat->company_title != ''?$oChat->company_title:'Hi, we’re Wakers Inc.'; ?></p>
								<p><span class="company_description <?php echo $oChat->subtitle_show == 1? '':'hidden'; ?>"><?php echo $oChat->company_description != ''?nl2br($oChat->company_description):'We help startups and business<br> grow by powerful design & <br> marketign'; ?></span></p>
								
								<div class="company_profile_sec">
									<div class="img_sec">
										<img src="/assets/images/face1.jpg" width="32">
										<img src="/assets/images/face2.jpg" width="32">
										<img src="/assets/images/face3.jpg" width="32">
									</div>
									<p style="margin-bottom: 10px;">Hi there!</p>
									<p><span>Glad to see you! Let us know how we can help, by strating a new conversiation below.</span></p>
								</div>
							</div>
							<div id="bb_msg_wrap2" > 
								<div style="height: 220px;" class="msg_body_new">
									&nbsp;
								</div>
								<div class="msg_footer_new">
									<input type="text" class="bb_chat_msg_input msg_input_new" id="bb_chat_msg_input2" placeholder="Type a message..." />
								</div> 
							</div> 
						</div>
						
						<div class="giftChatBox <?php echo $oChat->allow_gift_message == 1 ? '' : 'hidden'; ?>">
							<div class="chat_widget_bot_right bb_chatbox">
								<div class="bb_white_box bb_white_box_main_box <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?>" style="">
									<p style="color: #fff;">Trevor from Grin</p>
									<p style="color: #fff;"><span style="color: #fff; font-size: 13px;">Hi! Do you know about our new offer for startups &amp; small business? </span></p>
									<div class="image_icon">
										<img src="/assets/images/face1.jpg">
									</div>
								</div>
								
								<div class="bb_white_box">
									<p>Trevor from Grin</p>
									<p><span>We give you 3 month free trial!</span></p>
								</div>
								<div class="bb_white_box">
									<p>Amit Kumar</p>
									<p><span>Hey Max! It looks like you've been chatting with a member of our team, that's awesome</span></p>
								</div>
								
								<div class="bb_white_box_input">
									<input type="text" name="" class="form-control" placeholder="Type a message here...">
								</div>
							</div>	
						</div>
						
						<div class="bb_chat_action_icon_white <?php echo $oChat->header_color_fix == '1'?$oChat->header_color.'_preview_1':''; ?> <?php echo ($oChat->position == 'left') ? 'iconLeft' : ''; ?>" style="">
							<div class="bb_iconbox ">
								<span class="chat_badge <?php echo $oChat->notification == 1? '':'hidden'; ?> <?php echo ($oChat->position == 'right') ? '' : 'noti_left'; ?>">2</span>
								<a style="cursor: pointer;"><img class="bb_iconbox_img" style="width: 20px;" src="/assets/images/chat_design_icon<?php echo $oChat->chat_icon; ?>.png" /></a>
							</div>
						</div>
					</div>
					
					<img class="w100" src="/assets/images/config_bkg.png"/>
					
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$(document).on('click', '.gradientOrientation', function(){													
			$('#bbColorOrientationSection').removeClass('toRightTop');
			$('#bbColorOrientationSection').removeClass('toRight');
			$('#bbColorOrientationSection').removeClass('toRightBottom');
			$('#bbColorOrientationSection').removeClass('toBottom');
			$('#bbColorOrientationSection').removeClass('toLeftBottom');
			$('#bbColorOrientationSection').removeClass('toLeft');
			$('#bbColorOrientationSection').removeClass('toLeftTop');
			$('#bbColorOrientationSection').removeClass('toTop');
			$('#bbColorOrientationSection').removeClass('orientationCircle');
			
			$('#bbColorOrientationSection').addClass($(this).attr('main-orientation-class'));
			
			$('.gradientOrientation').removeClass('active');
			var orientationVal = $(this).attr('color-orientation');
			$(this).addClass('active');
			$('#color_orientation').val(orientationVal);
			
            if(orientationVal == 'circle'){
				$('.bb_msg_head_new, .bb_chat_action_icon_white').css('background-image', 'radial-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
			}else{
				$('.bb_msg_head_new, .bb_chat_action_icon_white').css('background-image', 'linear-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
			}
			//$('.bb_msg_head_new, .bb_chat_action_icon_white').css('background-image', '');
		});
	});
	
	function smileyShowHide() {
		$('#bb_smiley_box2').toggleClass('hidden');
	}
	
</script>   