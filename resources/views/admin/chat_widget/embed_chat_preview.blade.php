<style>

    .msg_box_new {
        /*position:absolute;*/
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
        /*bottom: 100px;*/
        width: 340px;
        right: 30px;
        z-index: 0;
        font-size: 14px;
        box-sizing: border-box;
        min-height: 560px;
        font-family: 'Inter UI';
        font-weight: 400;

    }
    .hidden {
        display: none !important;
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

    .previewWidgetBox .white_preview_1{background-image: linear-gradient(45deg, #ffffff, #ffffff 98%)!important;}
    .previewWidgetBox .red_preview_1{background-image: linear-gradient(45deg, #e93474, #541069 98%)!important;}
    .previewWidgetBox .yellow_preview_1{background-image: linear-gradient(45deg, #f9d84a, #f9814a)!important;}
    .previewWidgetBox .orange_preview_1{background-image: linear-gradient(45deg, #ef9d39, #d92a3f)!important;}
    .previewWidgetBox .green_preview_1{background-image: linear-gradient(45deg, #93cf48, #076768)!important;}
    .previewWidgetBox .blue_preview_1{background-image: linear-gradient(45deg, #4194f7 3%, #1b1f97 99%)!important;}
    .previewWidgetBox .purple_preview_1{background-image: linear-gradient(45deg, #4d4d7c 1%, #1e1e40)!important;}

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
    }
    .w100 {
         width: 100%!important;
        height: 100%;
    }
    img {
        max-width: 100%;
    }
</style>
@php
     //print_r($widgetSettings);

@endphp
<div class="panel-body p20">
    <div class="widget_sec toBottom" id="bbColorOrientationSection">
        <!--=========================================Chat Widget 1=============================================-->

        <div class="msg_box_new hidden previewWidgetBox" id="bbchatpopup">
            <div class="bb_msg_head_new green_preview_1" style=" ">

                @if($widgetSettings->logo_show  == 1)
                <div class="bb_img_icon_new">
                    <img width="32" src="/assets/images/face3.jpg">
                </div>
                @endif;
                <div class="bb_drop_icon_new"><a href="#"><i class="fa fa-chevron-down"></i></a></div>
                <p>Garrett Glover</p>
                <p><span>Typically replies in 15 min</span></p>
            </div>
            <div id="bb_msg_wrap">
                <div class="msg_body_new">
                    <div class="bb_msg_push">
                        <div class="bb_msg"><div class="msg-left">Hi! I need help with pricing.</div></div>
                        <div class="bb_msg"><div class="msg-right green_preview_1" style=" ">Hey Max! It looks like you've been chatting with a member of our team, that's awesome</div></div>
                        <div class="bb_msg"><div class="msg-right green_preview_1" style=" ">Have you checked our price page?</div></div>
                        <div class="bb_msg"><div class="msg-left">Hey Max! It looks like you've been chatting with a member of our team, that's awesome</div></div>
                        <div class="bb_msg"><div class="msg-right green_preview_1" style=" ">Thanks!</div></div>

                    </div>
                </div>
                <div class="msg_footer_new">
                    <div id="bb_smiley_box2" class="bb_smg_smiley_new hidden green_preview_1" style=" ">
                        <a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-is-pleased-red-cheeks-whatsapp-emoji-1F60A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/angry-smiley-whatsapp-1F620.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/shedding-tears-emoji-whatsapp-1F602.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smile-with-squint-eyes-whatsapp-emoticon-263A.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-drooping-eyebrows-1F622.png"></a>
                        <a style="cursor: pointer;"><img src="/assets/emojis/smiley-face-is-flushed-whatsapp-emoji-1F633.png"></a>

                    </div>
                    <div class="msg_att">
                        <a onclick="smileyShowHide()" style="cursor: pointer;" class="smilieShow "><i class="fa fa-smile-o"></i></a>
                        <a style="cursor: pointer;" class="attachmentShow "><i class="fa fa-paperclip"></i></a>
                    </div>
                    <input type="text" class="bb_chat_msg_input msg_input_new" id="bb_chat_msg_input2" placeholder="Type a message...">
                </div>
            </div>

            <div class="bb_chat_action_icon_white green_preview_1" style=" ">
                <div class="bb_iconbox"><a href="#"><img class="bb_iconbox_img" style="width: 20px;" src="/assets/images/chat_design_icon3.png"></a></div>
            </div>

        </div>

        <!--=========================================Chat Widget 1=============================================-->
        <div class="msg_box_new2 previewWidgetBox " id="bbchatpopup2">
            @if($widgetSettings->allow_gift_message  == 1)
                <div class="woGiftChatBox hidden">
             @else
                 <div class="woGiftChatBox">
            @endif

                <div class="bb_msg_head_new big green_preview_1" style="">
                    @if($widgetSettings->logo_show  == 1)
                    <div class="bb_img_icon_new big ">
                        <img width="53" class="rounded company_avatar" src="/assets/images/wakerslogo.png">
                    </div>
                    @endif
                    @if($widgetSettings->title_show  == 1)
                        <p style="margin-bottom: 10px;" class="company_name ">Hi, we’re Wakers Inc.</p>
                    @endif
                    @if($widgetSettings->subtitle_show  == 1)
                        <p><span class="company_description ">We help startups and business<br> grow by powerful design &amp; <br> marketign</span></p>
                    @endif
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
                <div id="bb_msg_wrap2">
                    <div style="height: 220px;" class="msg_body_new">
                        &nbsp;
                    </div>
                    <div class="msg_footer_new">
                        <input type="text" class="bb_chat_msg_input msg_input_new" id="bb_chat_msg_input2" placeholder="Type a message...">
                    </div>
                </div>
            </div>

            @if($widgetSettings->allow_gift_message  == 1)
                <div class="giftChatBox">
             @else
                <div class="giftChatBox hidden">
             @endif
                <div class="chat_widget_bot_right bb_chatbox">
                    <div class="bb_white_box bb_white_box_main_box green_preview_1" style="">
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

            <div class="bb_chat_action_icon_white green_preview_1 " style="">
                <div class="bb_iconbox ">
                    <span class="chat_badge  ">2</span>
                    <a style="cursor: pointer;"><img class="bb_iconbox_img" style="width: 20px;" src="/assets/images/chat_design_icon3.png"></a>
                </div>
            </div>
        </div>

        <img class="w100" src="/assets/images/config_bkg.png">

    </div>
</div>
