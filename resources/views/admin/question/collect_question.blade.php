<!DOCTYPE html>
<html lang="en">
	
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BrandBoost::Admin</title>
		
        <!-- Global stylesheets -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		
        <link href="<?php echo base_url(); ?>assets/css/theme1.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
		
        <!-- Core JS files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/blockui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
        <!-- /core JS files -->
        <style>
            body {background:#d5e0f2;font-size: 13px!important;	font-family: 'Inter UI';font-style: normal;	font-weight: 400;letter-spacing: 0;}
            .clearfix {}
            .clearfix::after {content: "";clear: both;display: table;}
            .review_sec {width: 100%; position: relative; top: 0}
            .review_chat40{max-width: 520px; width: 100%;font-family: 'Inter UI';font-style: normal; position: relative;}
            .review_chat40 .second_box{box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03); width: 100%; border-radius: 5px; float: left;height: 1005px;background: #fff;}
            .review_chat40 .head{box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.13);background-image: linear-gradient(95deg, #5c37f2, #aa7bff);border-radius: 5px 5px 0px 0px;width: 100%; float: left;}
            .review_chat40 .box_left {width: 110px; float: left;}
            .review_chat40 .box_left img{border-radius: 5px 0px 0px 5px;}
            .review_chat40 .box_right {float: left;width: 100%;}
            .review_chat40 .box_right .client_n p {margin: 0;margin-bottom: 0px;color: #fff;font-size: 16px;font-weight: 500;margin-bottom: 5px;}
            .review_chat40 .box_right .client_n p span {display: block;}
            .review_chat40 .box_right .client_n {padding: 14px 20px 10px;}
            .review_chat40 .box_right .client_review{/*background-color:rgba(7, 0, 44, 0.2);*/padding: 20px 35px; text-align: left;}
            .review_chat40 .box_right .client_review span {color: #fff;font-size: 16px;font-weight: 500;}
            .review_chat40 .box_right .re_client{ float: right;}
			
            .review_chat40 .middle {width: 100%;background: #fff;display: inline-block;float: left;border-radius:5px;}
            .review_chat40 .middle .box_1 {width: 100%;float: left;padding: 20px 0px 25px 0px; border-bottom: 1px solid #f3f3fa}
            .review_chat40 .middle .box_1 .top_div {padding: 0 35px 20px 35px;    border-bottom: 1px solid #f3f3fa;}
            .review_chat40 .middle  .box_1 .top_div .left {    position: relative;    width: 45px;    display: inline-block;    margin-right: 12px;}
            .review_chat40 .middle .box_1 .top_div .left .circle {position: absolute;width: 10px;height: 10px;background: #69d641;border-radius: 100%;right: 0;border: 3px solid #fff;bottom: 4px;right: 2px; text-align: center;}
            .review_chat40 .middle .box_1 .top_div .right {    display: inline-block;}
            .review_chat40 .middle .box_1 .top_div .right p{color: #364d79;font-size: 14px;font-weight: 500; margin: 0 0 8px 0; padding: 0}
            .review_chat40 .middle .box_1 .top_div .right .client_review span {color: #526b9b;font-size: 12px;margin-left: 10px;}
            .review_chat40 .middle .box_1 .top_div .right p span{font-size: 12px; color: #5e5e89; font-weight: normal; margin-left: 10px;}
            .review_chat40 .middle .box_1 .top_div .right p span em {padding-right: 10px; color: #dfdfef;position: relative;top: -3px;}
            .review_chat40 .middle .box_1 .top_div .right .client_review .date em{padding: 0 10px;color: #dfdfef;position: relative;top: -3px;}
			
            .review_chat40 .middle .box_1 .top_div .right .fa.fa-star{color: #ffc065;}
            .review_chat40 .middle .box_1 .top_div .right .fa.fa-star.grey{color: #e6e6f3}
            .review_chat40 .middle .box_1 .top_div .left .circle .fa.fa-check{font-size: 6px;color: #fff;position: relative;top: -6px;}
			
            .review_chat40 .middle .box_1 .bottom_div {padding: 0 35px;}
            .review_chat40 .middle .box_1 .bottom_div img{float: left; margin-right: 15px;}
            .review_chat40 .middle .box_1 .bottom_div p {color: #22375e;font-size: 14px;font-weight: normal;line-height: 1.57; margin-bottom: 10px;}
            .review_chat40 .middle .box_1 .bottom_div p img{float: left; margin-right: 15px;}
            .review_chat40 .middle .box_1 .bottom_div a {    color: #216cd0;    font-size: 14px;    text-decoration: none;}
            .review_chat40 .middle .box_1:last-child{border-bottom: 0;}
            .review_chat40 .middle .footer_div .comment_div {display: inline-block;}
            .review_chat40 .middle .footer_div .comment_div p {color: #5e5e89;font-size: 12px !important;font-weight: normal; margin: 0;}
			
            .review_chat40 .middle .footer_div .comment_div p img {margin-right: 8px;float: left;margin-top: 2px;}
            .review_chat40 .middle .footer_div .comment_div p span {margin-left: 0px;padding-left: 14px;margin-right: 8px;}
            .review_chat40 .middle .footer_div .liked_icon {    display: inline-block;position: relative; top: 0px;}
            .review_chat40 .middle .footer_div .liked_icon img {background: #fff;padding: 4px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);border-radius: 5px;}
            .review_chat40 .middle .footer_div {padding: 0px 35px 0;}
			
            .review_chat40 .bottom_sec {background: #f5f8fc;padding: 25px 0;float: left;width: 100%;border-radius:0 0px 5px 0px; }
            .review_chat40 .bottom_sec span{color: #768fbf; font-size: 14px; padding-left: 20px;}
            .review_chat40 .bottom_sec img{float: right; padding-right: 20px; margin-top: 3px;}
			
            .review_chat40 .star_div {position: relative;float: left;width: 100%;}
            .review_chat40 .star_bottom {position: absolute;right: -60px;top: 0px;height: 42px; width: 42px; border-radius: 0;text-align: center;line-height: 46px; background: #fff; border-radius: 100%;box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);}
            .review_chat40 .star_bottom  p{color: #fff; font-size: 14px; font-weight: 500; line-height: normal; float: left; margin-right: 10px;}
            .review_chat40 .star_bottom img{margin-top:0px;}
			
            .review_chat40 .top_header {border-bottom: 1px solid #f3f3fa;padding: 0 35px;position: relative; background: #fff;}
            .review_chat40 .top_header .rating {padding: 27px 0;width: 100%;display: inline-block;}
            .review_chat40 .top_header .rating .left {float: left;    width: 50%; border-right: 1px solid #f3f3fa;}
            .review_chat4 .top_header .rating .left img {/*float: left;    margin-right: 5px;*/}
            .review_chat40 .top_header .rating p span {font-size: 20px;color: #080d2e;font-weight: bold;margin-right: 3px;}
            .review_chat40 .top_header .rating .left p{color: #72739c; font-size: 14px; margin-bottom: 5px;}
            .review_chat40 .top_header .rating p {margin: 0;    padding: 0;}
            .review_chat40 .top_header .rating p a {color: #080d2e;text-decoration: none;font-size: 14px;font-weight: 500; border-bottom: 1px solid #e6e6f3}
            .review_chat40 .top_header .rating .right {float: left;margin-top: 23px; width: 100%;}
            .review_chat40 .top_header .rating .right a {border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border: solid 1px #d5e0f2;padding: 14px 18px;text-decoration: none;font-size: 14px;font-weight: 500;color: #102243;margin-right: 2%; width: 40%; float: left; text-align: center;}
            .review_chat40 .top_header .rating .right img {margin-right: 8px;}
            .review_chat40 .review_all{background: #fff; padding:18px 35px;border-bottom: 1px solid #f3f3fa;}
            .review_chat40 .review_all a{color: #5e5e7c; text-decoration: none;margin-right: 20px; font-weight: 500; font-size: 13px;}
            .review_chat40 .review_all a:last-child{margin-right: 0;}
            .review_chat40 .review_all a.active{color: #6145d4;}
            .review_chat40 .based_25{margin-top: 5px !important;}
            .review_chat40 .top_header .rating .left_right {float: left; margin-top: 0px; width: 49%; padding-left: 24px; box-sizing: border-box;}
            .review_chat40 .mr{margin-right:  0 !important}
			
            .review_chat40 .progress {height: 6px;box-shadow: none;background: #d9e0ee;border-radius: 1.5px;max-width: 100%;margin:0 0 12px 0;cursor: pointer; margin-left: 23px;}
			
            .review_chat40 .progress-bar-violet {background-color: #7f62df !important;border-radius: 1.5px;height: 6px;}
            .review_chat40 .progress-bar-green {background-color: #29c178 !important;border-radius: 1.5px;height: 6px;}
            .review_chat40 .progress-bar-green2 {background-color: #5ad491 !important;border-radius: 1.5px;height: 6px;}
            .review_chat40 .progress-bar-grey {background-color: #9b9dc0 !important;border-radius: 1.5px;height: 6px;}
            .review_chat40 .progress-bar-red {background-color: #e44f64 !important;border-radius: 1.5px;height: 6px;}
            .smile_1 img{float: left; margin-right: 10px; margin-top:-3px;}
            .date{margin-left: 0px !important;}
            .fa.fa-thumbs-up {font-size: 10px;padding: 7px;background: #effbf4;border-radius: 5px;color: #29c178;margin-right: 6px;}
            .fa.fa-thumbs-down{font-size: 10px;padding: 7px;background: #fff1f3;border-radius: 5px;color: #e44f64;}
            .share_icon {float: right; color: #5e5e89; font-size: 12px;margin-top: -7px;}
            .share_icon .fa.fa-share{color: #c4c7e4; font-size: 12px; margin-top: 15px;}
            .review_chat40 .middle .footer_div .comment_div p span em {margin-right: 10px;position: relative;top: -3px; color: #dfdfef;}
			
			
			
			
            .review_chat41{max-width: 520px; width: 100%;font-family: 'Inter UI';font-style: normal; position: relative;}
            .review_chat41 .head {box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.13);background-image: linear-gradient(95deg, #5c37f2, #aa7bff);border-radius: 5px 5px 0px 0px;width: 100%;float: left;}
            .review_chat41 .box_right {float: left;width: 100%;}
            .review_chat41 .box_right .client_review {padding: 20px 35px;text-align: left;}
            .review_chat41 .box_right .client_review span {color: #fff;font-size: 16px;font-weight: 500;}
            .review_chat41 .star_bottom {position: absolute;right: -60px;top: 0px;height: 42px;width: 42px;text-align: center;line-height: 46px;background: #fff;border-radius: 100%;    box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);}
			
            .review_chat41 .box_right .client_review .fa.fa-angle-left{width: 16px;height: 16px;background-color: rgba(0, 0, 0, 0.2);border-radius: 100%;text-align: center;font-size: 14px;position: relative; top: -2px;margin-right: 8px;}
			
            .review_chat41 .star_bottom img {margin-top: 0px;}
            .review_chat41 .second_box {box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03);width: 100%;border-radius: 5px;float: left;height: 1005px;background: #fff;}
            .review_chat41 .middle {padding: 27px 35px 7px;position: relative;background: #f9fafc;box-shadow: 0 3px 2px 0 rgba(0, 3, 49, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.1), 0 10px 10px 0 rgba(0, 0, 54, 0.03);border-radius: 0 0 5px 5px; box-sizing: border-box; float: left; width: 100%;}
            .review_chat41 .middle .product_two_bx {margin-bottom: 10px;float: left;width: 100%;}
            .review_chat41 .middle .product_two_bx .auto_message {font-family: 'Inter UI';font-size: 11px;font-weight: bold;font-style: normal;font-stretch: normal;line-height: 1.45;letter-spacing: 0.3px;
			color: #494968;text-transform: uppercase;float: left;}
            .review_chat41 .middle  .product_two_bx img {    float: right;}
			
            .review_chat41 .middle .ful_divider {height: 1px;background-color: #f0f2f8;width: 100%;float: left;position: absolute;left: 0;}
            .review_chat41 .middle  h2 {font-family: 'Inter UI';font-size: 10px;font-weight: 700;font-style: normal;font-stretch: normal;line-height: 1.6;letter-spacing: 0.3px;color: #2f3053;text-transform: uppercase;float: left;}
            .review_chat41 .middle .rating_box {min-height: 52px;border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);border: solid 1px #f3f4f7;background-color: #fff; margin-bottom: 10px;}
			
            .review_chat41 .middle .rating_box .rating_txt {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 0.92;letter-spacing: normal;color: #64658b;line-height: 52px;padding-left: 25px;float: left;}
            .review_chat41 .middle .rating_box .star_bx {float: left;margin-left: 80px;margin-top: 10px;margin-top: 20px;}
            .review_chat41 .middle  .rating_box .star_bx .fav_yello {color: #ffcd5e;font-size: 18px;margin-right: 3px;}
            .review_chat41 .middle .much_bx {min-height: 160px;border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);border: solid 1px #f3f4f7;background-color: #ffffff; margin-bottom: 10px; padding-bottom: 10px;}
            .review_chat41 .middle .rating_box .star_bx .fav_gry {color: #d9d9e9;font-size: 18px;}
            .review_chat41 .middle .rating_box .star_bx .rat_num {font-family: 'Inter UI';font-size: 13px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 0.92;letter-spacing: normal;    color: #9292b4;float: right;margin-left: 17px;margin-top: 2px;}
            .review_chat41 .middle .right_max {float: right;margin-top: 8px;}
            .review_chat41 .middle .much_bx .review_headline {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 53px;letter-spacing: normal;color: #64658b;float: left;width: 27%;}
            .review_chat41 .middle .much_bx .very_much {font-family: 'Inter UI';font-size: 13px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 53px;letter-spacing: normal;color: #9292b4;float: right;width: 67%;}
            .review_chat41 .middle .much_bx .divider {width: 100%;height: 1px;background-color: #f0f2f8;float: left;}
            .review_chat41 .middle .much_bx .tell_you {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.33;letter-spacing: normal;color: #64658b;margin-left: 25px;margin-top: 25px;margin-right:25px;}
            .review_chat41 .middle  .much_bx .tell_you textarea {resize: none;height: 70px;font-family: 'Inter UI';padding:10px; box-sizing: border-box; color: #000;}
            .tab_accord .panel-body .right_max {float: right;margin-top: 15px;}
            .review_chat41 .middle  .right_max a {font-family: 'Inter UI';font-size: 11px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.09;letter-spacing: normal;color: #64658b;text-decoration: none;}
            .review_chat41 .middle  .drag_bx {min-height: 154px;border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);
			border: solid 1px #f3f4f7;background-color: #fff;text-align: center;padding-top: 30px; margin-top: 13px;margin-bottom: 15px;}
            .review_chat41 .middle  .drag_bx .Drag-Drop-Your-Fil {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 0.92;letter-spacing: normal;color: #2f3053;margin-top: 12px;}
            .review_chat41 .middle .drag_bx .GIF-JPG-PNG-ASF {font-family: 'Inter UI';font-size: 11px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.09;letter-spacing: normal;color: #9292b4;margin-top: 12px; }
            .review_chat41 .middle  .name_bx {min-height: 106px; margin-top: 5px;}
            .review_chat41 .middle  .name_bx .full_n_bx {width: 20%;}
            .review_chat41 .middle .much_bx .very_much {font-family: 'Inter UI';font-size: 13px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 53px;letter-spacing: normal;color: #9292b4;float: right;width: 67%;}
            .review_chat41 .middle  .much_bx .very_much input {width: 100%;border: 0;border-radius: 0;margin-top: 5px;padding: 0 10px; box-sizing: border-box;}
            .review_chat41 .middle .form-control {border-radius: 5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;appearance: none;-webkit-appearance: none;-moz-appearance: none;position: relative;height: 40px;}
            .review_chat41 .middle .form-control.addnote {background: none;border: none;width: 100%;box-shadow: none;color: #8b9ab9;font-size: 13px;padding: 0;}
			
            .review_chat41 .middle .bottom_btn_sec {margin-top: 30px;float: left;width: 100%;}
			
            .review_chat41 .middle .chck_box{margin-top: 20px}
            .review_chat41 .middle .chck_box .container {display: block;position: relative;padding-left: 27px;margin-bottom: 140px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;font-family: 'Inter UI';font-size: 10px;  font-weight: 700;font-style: normal;font-stretch: normal;  line-height: 1.6;letter-spacing: 0.3px;  color: #2f3053;text-transform: uppercase;}
            .review_chat41 .middle .chck_box .container input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}
            .review_chat41 .middle .chck_box .checkmark {position: absolute;top: 0;left: 0;height: 16px;width: 16px;background-color: #7f62df;border-radius:5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);}
			
			
            .review_chat41 .middle .chck_box .container:hover input ~ .checkmark {box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;border-radius:5px;}
            .review_chat41 .middle .chck_box .container input:checked ~ .checkmark {background-color: #7f62df;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);border-radius:5px;}
            .review_chat41 .middle .chck_box .checkmark:after {content: "";position: absolute;display: none;}
            .review_chat41 .middle .container input:checked ~ .checkmark:after {display: block;}
            .review_chat41 .middle .chck_box .container .checkmark:after {left: 6px;top: 3px;width: 3px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
            .review_chat41 .middle .bottom_btn_sec .sav_con {width: 149px;height: 40px;border-radius: 5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;font-family: 'Inter UI';font-size: 14px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.14;letter-spacing: -0.2px;text-align: center;color: #fff;border: 0;float: left;}
            .review_chat41 .middle .bottom_btn_sec a.skip {font-family: 'Inter UI';font-size: 14px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.07;letter-spacing: normal;color: #3aa2ff;float: left;margin-top: 10px;margin-left: 20px;text-decoration-color: #ebebf4;text-decoration-line: underline;}
            .review_chat41 .middle .right_chck_box {float: right;margin-top: 11px;}
            .review_chat41 .middle .right_chck_box .container {display: block;position: relative;padding-left: 27px;margin-bottom: 35px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;font-family: 'Inter UI';font-size: 11px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.36;letter-spacing: normal;color: #414165;}
			
            .review_chat41 .middle .right_chck_box .container a {font-family: 'Inter UI';font-size: 11px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.36;letter-spacing: normal;color: #414165;text-decoration-color: #ebebf4;text-decoration-line: underline;}
            .review_chat41 .middle .right_chck_box .container input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}
            .review_chat41 .middle .right_chck_box .checkmark {position: absolute;top: 0;left: 0;height: 16px;width: 16px;background-color: #7f62df;border-radius:5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);}
            .review_chat41 .middle .right_chck_box .container:hover input ~ .checkmark {box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;border-radius:5px;}
            .review_chat41 .middle .right_chck_box .container input:checked ~ .checkmark {background-color: #7f62df;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);border-radius:5px;}
            .review_chat41 .middle .right_chck_box .checkmark:after {content: "";position: absolute;display: none;}
            .review_chat41 .middle .right_chck_box .container input:checked ~ .checkmark:after {display: block;}
            .review_chat41 .middle .right_chck_box .container .checkmark:after {left: 6px;top: 3px;width: 3px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
			
			
			
			
			
			
            .review_chat42{max-width: 520px; width: 100%;font-family: 'Inter UI';font-style: normal; position: relative;}
            .review_chat42 .head {box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.13);background-image: linear-gradient(95deg, #5c37f2, #aa7bff);border-radius: 5px 5px 0px 0px;width: 100%;float: left;}
            .review_chat42 .box_right {float: left;width: 100%;}
            .review_chat42 .box_right .client_review {padding: 20px 35px;text-align: left;}
            .review_chat42 .box_right .client_review span {color: #fff;font-size: 16px;font-weight: 500;}
            .review_chat42 .star_bottom {position: absolute;right: -60px;top: 0px;height: 42px;width: 42px;text-align: center;line-height: 46px;background: #fff;border-radius: 100%;    box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);}
			
            .review_chat42 .box_right .client_review .fa.fa-angle-left{width: 16px;height: 16px;background-color: rgba(0, 0, 0, 0.2);border-radius: 100%;text-align: center;font-size: 14px;position: relative; top: -2px;margin-right: 8px;}
			
            .review_chat42 .star_bottom img {margin-top: 0px;}
            .review_chat42 .second_box {box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03);width: 100%;border-radius: 5px;float: left;}
            .review_chat42 .middle {padding: 27px 35px 7px;position: relative;background: #f9fafc;box-shadow: 0 3px 2px 0 rgba(0, 3, 49, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.1), 0 10px 10px 0 rgba(0, 0, 54, 0.03);border-radius: 0 0 5px 5px; box-sizing: border-box; float: left; width: 100%;}
            .review_chat42 .middle .product_two_bx {margin-bottom: 10px;float: left;width: 100%;}
            .review_chat42 .middle .product_two_bx .auto_message {font-family: 'Inter UI';font-size: 11px;font-weight: bold;font-style: normal;font-stretch: normal;line-height: 1.45;letter-spacing: 0.3px;
			color: #494968;text-transform: uppercase;float: left;}
            .review_chat42 .middle  .product_two_bx img {    float: right;}
			
            .review_chat42 .middle .ful_divider {height: 1px;background-color: #f0f2f8;width: 100%;float: left;position: absolute;left: 0;}
            .review_chat42 .middle  h2 {font-family: 'Inter UI';font-size: 10px;font-weight: 700;font-style: normal;font-stretch: normal;line-height: 1.6;letter-spacing: 0.3px;color: #2f3053;text-transform: uppercase;float: left;}
            .review_chat42 .middle .rating_box {min-height: 52px;border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);border: solid 1px #f3f4f7;background-color: #fff; margin-bottom: 10px;}
			
            .review_chat42 .middle .rating_box .rating_txt {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 0.92;letter-spacing: normal;color: #64658b;line-height: 52px;padding-left: 25px;float: left;}
            .review_chat42 .middle .rating_box .star_bx {float: left;margin-left: 80px;margin-top: 10px;margin-top: 20px;}
            .review_chat42 .middle  .rating_box .star_bx .fav_yello {color: #ffcd5e;font-size: 18px;margin-right: 3px;}
            .review_chat42 .middle .much_bx {min-height: 160px;border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);border: solid 1px #f3f4f7;background-color: #ffffff; margin-bottom: 10px; padding-bottom: 10px; padding:0px}
            .review_chat42 .middle .rating_box .star_bx .fav_gry {color: #d9d9e9;font-size: 18px;}
            .review_chat42 .middle .rating_box .star_bx .rat_num {font-family: 'Inter UI';font-size: 13px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 0.92;letter-spacing: normal;    color: #9292b4;float: right;margin-left: 17px;margin-top: 2px;}
            .review_chat42 .middle .right_max {float: right;margin-top: 8px;}
            .review_chat42 .middle .much_bx .review_headline {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 53px;letter-spacing: normal;color: #64658b;float: left;width: 27%; padding-left: 25px;}
            .review_chat42 .middle .much_bx .very_much {font-family: 'Inter UI';font-size: 13px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 53px;letter-spacing: normal;color: #9292b4;float: right;width: 61%; padding-right: 25px;}
            .review_chat42 .middle .much_bx .divider {width: 100%;height: 1px;background-color: #f0f2f8;float: left;}
            .review_chat42 .middle .much_bx .tell_you {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.33;letter-spacing: normal;color: #64658b;margin-top: 25px;  box-sizing: border-box; padding-left: 25px; padding-right: 25px;}
            .review_chat42 .middle  .much_bx .tell_you textarea {resize: none;height: 70px;font-family: 'Inter UI'; padding:10px;box-sizing: border-box; color: #000;}
            .review_chat42 .middle .right_max {float: right;margin-top: 15px;}
            .review_chat42 .middle  .right_max a {font-family: 'Inter UI';font-size: 11px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.09;letter-spacing: normal;color: #64658b;text-decoration: none;}
            .review_chat42 .middle  .drag_bx {min-height: 154px;border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);
			border: solid 1px #f3f4f7;background-color: #fff;text-align: center;padding-top: 30px; margin-top: 13px;margin-bottom: 15px;}
            .review_chat42 .middle  .drag_bx .Drag-Drop-Your-Fil {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 0.92;letter-spacing: normal;color: #2f3053;margin-top: 12px;}
            .review_chat42 .middle .drag_bx .GIF-JPG-PNG-ASF {font-family: 'Inter UI';font-size: 11px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.09;letter-spacing: normal;color: #9292b4;margin-top: 12px; }
            .review_chat42 .middle  .name_bx {min-height: 161px; margin-top: 5px;}
            .review_chat42 .middle  .name_bx .full_n_bx {width: 20%;}
			
            .review_chat42 .middle  .much_bx .very_much input {width: 100%;border: 0;border-radius: 0;margin-top: 5px; padding:10px; box-sizing: border-box}
            .review_chat42 .middle .form-control {border-radius: 5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;appearance: none;-webkit-appearance: none;-moz-appearance: none;position: relative;height: 40px;}
            .review_chat42 .middle .form-control.addnote {background: none;border: none;width: 100%;box-shadow: none;color: #8b9ab9;font-size: 13px;padding: 0;}
			
            .review_chat42 .middle .bottom_btn_sec {margin-top: 30px;float: left;width: 100%;}
			
            .review_chat42 .middle .chck_box{margin-top: 20px}
            .review_chat42 .middle .chck_box .container {display: block;position: relative;padding-left: 27px;margin-bottom: 149px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;font-family: 'Inter UI';font-size: 10px;  font-weight: 700;font-style: normal;font-stretch: normal;  line-height: 1.6;letter-spacing: 0.3px;  color: #2f3053;text-transform: uppercase;}
            .review_chat42 .middle .chck_box .container input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}
            .review_chat42 .middle .chck_box .checkmark {position: absolute;top: 0;left: 0;height: 16px;width: 16px;background-color: #7f62df;border-radius:5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);}
			
			
            .review_chat42 .middle .chck_box .container:hover input ~ .checkmark {box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;border-radius:5px;}
            .review_chat42 .middle .chck_box .container input:checked ~ .checkmark {background-color: #7f62df;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);border-radius:5px;}
            .review_chat42 .middle .chck_box .checkmark:after {content: "";position: absolute;display: none;}
            .review_chat42 .middle .container input:checked ~ .checkmark:after {display: block;}
            .review_chat42 .middle .chck_box .container .checkmark:after {left: 6px;top: 3px;width: 3px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
            .review_chat42 .middle .bottom_btn_sec .sav_con {width: 149px;height: 40px;border-radius: 5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;font-family: 'Inter UI';font-size: 14px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.14;letter-spacing: -0.2px;text-align: center;color: #fff;border: 0;float: left;}
            .review_chat42 .middle .bottom_btn_sec a.skip {font-family: 'Inter UI';font-size: 14px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.07;letter-spacing: normal;color: #3aa2ff;float: left;margin-top: 10px;margin-left: 20px;text-decoration-color: #ebebf4;text-decoration-line: underline;}
            .review_chat42 .middle .right_chck_box {float: right;margin-top: 11px;}
            .review_chat42 .middle .right_chck_box .container {display: block;position: relative;padding-left: 27px;margin-bottom: 35px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;font-family: 'Inter UI';font-size: 11px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.36;letter-spacing: normal;color: #414165;}
			
            .review_chat42 .middle .right_chck_box .container a {font-family: 'Inter UI';font-size: 11px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.36;letter-spacing: normal;color: #414165;text-decoration-color: #ebebf4;text-decoration-line: underline;}
            .review_chat42 .middle .right_chck_box .container input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}
            .review_chat42 .middle .right_chck_box .checkmark {position: absolute;top: 0;left: 0;height: 16px;width: 16px;background-color: #7f62df;border-radius:5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);}
            .review_chat42 .middle .right_chck_box .container:hover input ~ .checkmark {box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;border-radius:5px;}
            .review_chat42 .middle .right_chck_box .container input:checked ~ .checkmark {background-color: #7f62df;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);border-radius:5px;}
            .review_chat42 .middle .right_chck_box .checkmark:after {content: "";position: absolute;display: none;}
            .review_chat42 .middle .right_chck_box .container input:checked ~ .checkmark:after {display: block;}
            .review_chat42 .middle .right_chck_box .container .checkmark:after {left: 6px;top: 3px;width: 3px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
            .review_chat42 .middle .term_condition {position: absolute;bottom: 100px;padding: 0 35px;padding-right: 35px;left: 0;height: 129px;overflow-y: scroll;width: 100%;box-sizing: border-box;    max-width: 488px;    padding-right: 0;}
            .review_chat42 .middle .term_condition p{color: #22375e;font-size: 12px !important;line-height: 1.30;}
			
			
            @media only screen and (max-width:480px){
			.review_chat42 .middle .much_bx .review_headline{width: 100%;}
			.review_chat42 .middle .much_bx .very_much{width: 100%;}
			.review_chat42 .middle .much_bx .very_much input{padding-left: 25px;}
			.review_chat42 .middle .much_bx .very_much{padding-right: 0;}
			.review_chat42 .middle .term_condition{padding-right: 25px;}
			.review_chat42 .middle h2{width: 100%;}
			.review_chat42 .middle .right_max{float: left}
			.review_chat42 .middle .much_bx .tell_you{padding: 0;}
			.review_chat42 .middle .much_bx .tell_you textarea{padding: 10px 25px;}
			
            }
			
			
		</style>
		
		
        <!-- /theme JS files -->
	</head>
	
    <body>
		
        <form method="post" name="frmSiteReviewSubmit" id="frmQuestionSubmit" container_name="sitereview" action="#"  enctype="multipart/form-data">
            <div class="review_sec">
                <div class="review_chat42" style="margin:0 auto;">
                    <div class="head">
                        <div class="box_right">
                            <div class="client_review"> <span class="text-left"><i class="fa fa-angle-left"></i> Ask a Question</span> </div>
						</div>
					</div>
                    <div class="second_box">
                        <div class="middle">
                            <div class="clearfix"></div>
							
                            <h2>ASK YOUR QUEStiON</h2>
                            <div class="clearfix"></div>
                            <div class="much_bx">
                                <div class="review_headline">Question Headline</div>
                                <div class="very_much"><input name="title" id="site-title" class="form-control" placeholder="I like it very much!" type="text" required></div>
                                <div class="divider"></div>
                                <div class="clearfix"></div>
                                <div class="tell_you"><textarea class="form-control addnote" name="description" id="site-description" placeholder="Describe your question briefly ..." required></textarea></div>
							</div>
							
							
                            <h2>upload photo or video</h2>
							
                            <div class="right_max">
                                <a href="#">5 media max.</a>
                                <a href="#">Video &amp; Images Rules</a>
							</div>
                            <div class="clearfix"></div>
                            <div class="dropzone drag_bx" id="myDropzone">
                                <span class="drop_rate">
                                    <img src="<?php echo base_url(); ?>assets/images/review/drag_icon.png">
                                    <div class="Drag-Drop-Your-Fil">Drag &amp; Drop Your Files</div>
                                    <div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
								</span>
							</div>
                            <div id="uploadedQuestionFiles"></div>
							
							
							
                            <h2>Contact Info</h2>
                            <div class="clearfix"></div>
                            <div class="much_bx name_bx">
                                <div class="review_headline full_n_bx">Full name</div>
                                <div class="very_much"><input name="fullname" class="form-control" value="" type="text" required="required" placeholder="Alen Sultanic"></div>
                                <div class="divider"></div>
                                <div class="clearfix"></div>
                                <div class="review_headline full_n_bx">Phone</div>
                                <div class="very_much"><input name="phone" class="form-control" value="<?php echo $uSubscribers->phone; ?>" type="text"></div>
                                <div class="divider"></div>
                                <div class="clearfix"></div>
                                <div class="review_headline full_n_bx">Email</div>
                                <div class="very_much"><input name="emailid" class="form-control" value="<?php echo $uSubscribers->email; ?>" type="text" required="required" placeholder="admin@brandboost.io"></div>
							</div>
                            <div class="clearfix"></div>
							
                            <div class="chck_box">
                                <label class="container">Don't show my name
                                    <input name="display_name" value="1" type="checkbox">
                                    <span class="checkmark"></span>
								</label>
							</div>
                            <div class="term_condition" id="term_condition">
                                <p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
								
                                <p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
                                <p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
								
                                <p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
                                <p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
                                <p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
							</div>
							
                            <div class="ful_divider"></div>
                            <div class="bottom_btn_sec">
                                <input type="hidden" name="campaign_id" value="<?php echo $brandboostID; ?>" />
                                <input type="submit" class="sav_con" value="Ask question" id="saveQuestionNow">
								
                                <div class="right_chck_box">
                                    <label class="container" for="checkAgree">Agree to our Terms &amp; Conditions
                                        <input type="checkbox" checked="checked" id="checkAgree" name="two" required="required">
                                        <span class="checkmark"></span>
									</label>
								</div>
							</div>
							
						</div>
						
						
						
						
                        <div class="clearfix"></div>

                        <!--<div class="bottom_sec"><span>Add your own review</span> <img src="assets/images/widget/arrow.png">		</div>-->
                    </div>



                </div>
            </div>
        </form>    



        <script type="text/javascript">

            $(document).ready(function () {

                $("#checkAgree").click(function () {
                    if ($(this).is(":checked")) {
                        $("#term_condition").show();
                    } else {
                        $("#term_condition").hide();
                    }

                });

                Dropzone.options.myDropzone = {
                    url: '<?php echo site_url("/dropzone/uploadQuestionFiles"); ?>',
                    uploadMultiple: false,
                    maxFiles: 10,
                    maxFilesize: 600,
                    acceptedFiles: 'image/*,video/mp4',
                    addRemoveLinks: false,
                    success: function (response) {
                        $('#uploadedQuestionFiles').append(response.xhr.responseText);
                    }

                }

                setTimeout(function () {
                    $('.dz-default').hide();
                }, 10);


                $("#frmQuestionSubmit").submit(function () {
                    $("#saveQuestionNow").attr("disabled", "disabled");
                    var formdata = new FormData(this);
                    $.ajax({
                        url: "<?php echo base_url('/admin/questions/saveNewQuestion'); ?>",
                        type: "POST",
                        data: formdata,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 'success') {

                                alert(response.msg);
                            } else {
                                $("#saveQuestionNow").removeAttr("disabled");
                                alert(response.msg);
                            }
                        },
                        error: function (response) {
                            alert(response.msg);
                        }
                    });
                    return false;
                });


                $('.drop_rate').click(function() {
                    $('#myDropzone').trigger('click');
                });

            });



        </script>



    </body>
</html>
