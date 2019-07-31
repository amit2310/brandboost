
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BrandBoost::Admin</title>
		<meta property="og:title" content=""/>
		<meta property="og:url" content="" />
		<meta property="og:image" content="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php //echo $oCampaign->logo_img; ?>" />
		<meta property="og:description" content="" />
		<meta property="og:site_name" content="Branboost" />
		<!-- Global stylesheets -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6448636/7750592/css/fonts.css" />
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/css/theme1.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			
			.review_ratings .ratings .fa.fa-star{margin-right: 1px; color: #ffc537!important; }
			.review_ratings .fa.fa-star.big {font-size: 25px;}
			.cmtformsubmit  .overlay{background:rgba(0, 0, 0, 0.04); position:absolute; top:0; left:0; width:100%; height:100%; text-align:center; line-height:100%; border-radius:5px; }
			.cmtformsubmit  .overlay img{margin-top:-30px; top:50%; position:absolute; left:50%; margin-left:-30px;}
			.comment_row{margin-bottom: 10px; border-bottom: 1px solid #e7e7f0; padding-bottom: 3px;}
			.comment_row p{margin: 0;}
			.que_new .media-left.media-middle{vertical-align: top;padding-top: 10px;}
			
		</style>
		<!-- /global stylesheets -->
		
		
		<!-- Core JS files -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/pace.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/blockui.min.js"></script>
		<!-- /core JS files -->
		
		<style type="text/css">
			.modal {display: none;position: fixed;z-index: 1;padding-top: 100px;left: 0;top: 0;width: 100%;height: 100%;overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4); }
			
			/* Modal Content */
			.modal .modal-content {background-color: #fefefe;margin: auto;padding: 14px;max-width: 880px;width: 100%; position: relative; border-radius: 5px;box-shadow: 0 2px 1px 0 rgba(0, 3, 49, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.1), 0 6px 6px 0 rgba(0, 0, 54, 0.03);}
			/* The Close Button */
			.modal .close {color: #aaaaaa;float: right;font-size: 28px;font-weight: normal; position: absolute; right: -16px; top: -18px; width: 42px; height: 42px;box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);text-align: center; line-height: 42px; border-radius: 100%; background: #fff; opacity: 1;}
			.modal .close:hover,.close:focus {color: #000;text-decoration: none;cursor: pointer;}
			.modal .box_inner{display: inline-block; width: 100%;}
			.modal .left_box{width: 50%;box-sizing: border-box; float: left; padding-right: 40px;}
			.modal .left_box img{width: 100%;}
			.modal .right_box{width: 50%;box-sizing: border-box; float: right; padding-right: 35px;}
			
			.modal .box_2 {width: 100%;float: left;padding: 5px 0px 18px 0px;/*border-bottom: 1px solid #e7edf8;*/box-sizing: border-box;}
			.modal .box_2 .top_div {padding: 17px 0;border-bottom: 1px solid #e7edf8;border-top: 1px solid #e7edf8;}
			.modal .box_2 .top_div .left {position: relative;width: 45px;float: left; margin-top: 10px;}
			.modal .box_2 .top_div .left .circle {position: absolute;width: 10px;height: 10px;background: #69d641;border-radius: 100%;right: 0;border: 2px solid #fff;top: 4px;right: 2px;}
			.modal .box_2 .top_div .right {display: inline-block; padding-right: 35px;}
			.modal .box_2 .bottom_div {padding: 10px 0;}
			.modal .heading_pop{ font-size: 18px;  font-weight: 500; color: #0c0c2c; margin-top: 40px;}
			.modal .heading_pop2{font-size: 12px;color: #525378; line-height: 1.67;font-weight: normal;}
			.modal .box_2 .top_div .right .client_review span {color: #526b9b;font-size: 12px;margin-left: 10px;}
			
			.modal .box_2 .top_div .right p {color: #364d79;font-size: 14px;font-weight: 500;margin: 0 0 8px 0;padding: 0;}
			.modal .box_2 .top_div .right .client_review span {color: #526b9b;font-size: 12px;margin-left: 10px;}
			.modal .footer_div2 .comment_div p {    color: #768fbf;    font-size: 12px !important;    font-weight: 500;}
			.modal .footer_div2 {padding: 0px;box-sizing: border-box;}
			.modal .footer_div2 .comment_div {display: inline-block;}
			.modal .footer_div2 .liked_icon {display: inline-block;position: relative;top: 3px;}
		    .modal .footer_div2 .comment_div p img {margin-right: 10px;float: left;margin-top: 2px;}
			.modal .footer_div2 .comment_div p span {margin-left: 14px;padding-left: 14px;border-left: 1px solid;margin-right: 14px;}
			.modal .footer_div2 .liked_icon img {background: #fff;padding: 4px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);border-radius: 5px;}
			.modal .box_2 .bottom_div p {color: #22375e;font-size: 14px;font-weight: 500;line-height: 1.69;margin-bottom: 10px;}
			.modal .arrow{top: 170px;}
			.modal .arrow .left_arrow{left: -30px;}
			.modal .arrow .right_arrow{right: -32px;}
			
			.brand_page_pr .brand_media .white_box{display: inline-block;width: 100%;}
			.brand_page_pr .brand_media .white_box a{padding: 0; margin: 0; }
			.brand_page_pr .white_box .walker_p a{ background-color:rgba(0, 97, 225, 0.1)!important; }
			
			.modal-backdrop{z-index: 0;}
			.b_review{float: left; width: 111px; margin-right: 20px; border-radius: 5px; height: 75px;}
			.rightBtnSection{margin-top: 10px; float: left;}
			.rightBtnSection a{border-radius: 5px; box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07); border: solid 1px #d5e0f2; padding: 10px 18px;  text-decoration: none; font-size: 14px; font-weight: 500; color: #102243; margin-left: 10px; background:#FFF;}
		</style>
		
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
            .review_chat41 .second_box {box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03);width: 100%;border-radius: 5px;float: left;height: auto;background: #fff;}
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
            .review_chat41 .middle .much_bx .review_headline {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 53px;letter-spacing: normal;color: #64658b;float: left;width: 27%; padding-left: 25px;}
            .review_chat41 .middle .much_bx .very_much {font-family: 'Inter UI';font-size: 13px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 53px;letter-spacing: normal;color: #9292b4;float: right;width: 67%;}
            .review_chat41 .middle .much_bx .divider {width: 100%;height: 1px;background-color: #f0f2f8;float: left;}
            .review_chat41 .middle .much_bx .tell_you {font-family: 'Inter UI';font-size: 12px;font-weight: 500;font-style: normal;font-stretch: normal;line-height: 1.33;letter-spacing: normal;color: #64658b;margin-left: 16px;margin-top: 25px;margin-right:25px;}
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
            .review_chat41 .middle .chck_box .container {display: block;position: relative;padding-left: 27px;margin-bottom: 20px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;font-family: 'Inter UI';font-size: 10px;  font-weight: 700;font-style: normal;font-stretch: normal;  line-height: 1.6;letter-spacing: 0.3px;  color: #2f3053;text-transform: uppercase;}
            .review_chat41 .middle .chck_box .container input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}
            .review_chat41 .middle .chck_box .checkmark {position: absolute;top: 0;left: 12px;height: 16px;width: 16px;background-color: #7f62df;border-radius:5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);}
			
			
            .review_chat41 .middle .chck_box .container:hover input ~ .checkmark {box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;border-radius:5px;}
            .review_chat41 .middle .chck_box .container input:checked ~ .checkmark {background-color: #7f62df;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);border-radius:5px;}
            .review_chat41 .middle .chck_box .checkmark:after {content: "";position: absolute;display: none;}
            .review_chat41 .middle .container input:checked ~ .checkmark:after {display: block;}
            .review_chat41 .middle .chck_box .container .checkmark:after {left: 6px;top: 4px;width: 4px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
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
            .review_chat41 .middle .right_chck_box .container .checkmark:after {left: 6px;top: 4px;width: 4px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
			.review_chat41 .middle .right_chck_box .container {
			width: 186px;
			padding: 0;
			padding-left: 0px;
			padding-left: 0px;
			padding-left: 15px;
			}
			
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
            .review_chat42 .middle .chck_box .container {display: block;position: relative;padding-left: 27px;margin-bottom: 15px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;font-family: 'Inter UI';font-size: 10px;  font-weight: 700;font-style: normal;font-stretch: normal;  line-height: 1.6;letter-spacing: 0.3px;  color: #2f3053;text-transform: uppercase;}
            .review_chat42 .middle .chck_box .container input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}
            .review_chat42 .middle .chck_box .checkmark {position: absolute;top: 0;left: 10px;height: 16px;width: 16px;background-color: #7f62df;border-radius:5px;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);}
			
			
            .review_chat42 .middle .chck_box .container:hover input ~ .checkmark {box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);background-color: #7f62df;border-radius:5px;}
            .review_chat42 .middle .chck_box .container input:checked ~ .checkmark {background-color: #7f62df;box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);border-radius:5px;}
            .review_chat42 .middle .chck_box .checkmark:after {content: "";position: absolute;display: none;}
            .review_chat42 .middle .container input:checked ~ .checkmark:after {display: block;}
            .review_chat42 .middle .chck_box .container .checkmark:after {left: 6px;top: 4px;width: 4px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
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
            .review_chat42 .middle .right_chck_box .container .checkmark:after {left: 6px;top: 4px;width: 4px;height: 7px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
            .review_chat42 .middle .term_condition {height: 130px; overflow-y: scroll; width: 100%; box-sizing: border-box; max-width: 488px;margin-bottom: 15px;}
            .review_chat42 .middle .term_condition p{color: #22375e;font-size: 12px !important;line-height: 1.30;}
			.review_chat41 .middle .term_condition {height: 130px; overflow-y: scroll; width: 100%; box-sizing: border-box; max-width: 488px;margin-bottom: 15px;}
            .review_chat41 .middle .term_condition p{color: #22375e;font-size: 12px !important;line-height: 1.30;}
			
			.white_box.p20.pl-10 {margin-top: 0 !important;}
			.review_ratings h1{font-size: 40px; font-weight: bold;}
			
			.review_chat42 .middle .right_chck_box .container{width: 186px; padding: 0;padding-left: 15px;}
			
            @media only screen and (max-width:480px){
			.review_chat42 .middle .much_bx .review_headline{width: 100%;}
			.review_chat42 .middle .much_bx .very_much{width: 100%;}
			.review_chat42 .middle .much_bx .very_much input{padding-left: 25px;}
			.review_chat42 .middle .much_bx .very_much{padding-right: 0;}
			.review_chat42 .middle .term_condition{padding-right: 25px;}
			.review_chat41 .middle .term_condition{padding-right: 25px;}
			.review_chat42 .middle h2{width: 100%;}
			.review_chat42 .middle .right_max{float: left}
			.review_chat42 .middle .much_bx .tell_you{padding: 0;}
			.review_chat42 .middle .much_bx .tell_you textarea{padding: 10px 25px;}
			
			
			
			
            }
			@media only screen and (max-width:440px){
			.review_chat42 .middle .right_chck_box{float: left;margin-left: 12px;}
			}
			
			
			.review_chat49{max-width: 520px; width: 100%;font-family: 'Inter UI';font-style: normal; position: relative;}
			.review_chat49 .second_box{box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03); width: 100%; border-radius: 5px; float: left;background: #fff; padding: 86px 90px;box-sizing: border-box; text-align: center;}
			.review_chat49 .head{box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.13);background-image: linear-gradient(95deg, #5c37f2, #aa7bff);border-radius: 5px 5px 0px 0px;width: 100%; float: left;}
			.review_chat49 .box_left {width: 110px; float: left;}
			.review_chat49 .box_left img{border-radius: 5px 0px 0px 5px;}
			.review_chat49 .box_right {float: left;width: 100%;}
			.review_chat49 .box_right .client_n p {margin: 0;margin-bottom: 0px;color: #fff;font-size: 16px;font-weight: 500;margin-bottom: 5px;}
			.review_chat49 .box_right .client_n p span {display: block;}
			.review_chat49 .box_right .client_n {padding: 14px 20px 10px;}
			.review_chat49 .box_right .client_review{/*background-color:rgba(7, 0, 44, 0.2);*/padding: 20px 35px; text-align: left;}
			.review_chat49 .box_right .client_review span {color: #fff;font-size: 16px;font-weight: 500;}
			.review_chat49 .box_right .re_client{ float: right;}
			
			
			.review_chat49 .star_div {position: relative;float: left;width: 100%;}
			.review_chat49 .star_bottom {position: absolute;right: -60px;top: 0px;height: 42px; width: 42px; border-radius: 0;text-align: center;line-height: 46px; background: #fff; border-radius: 100%;box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);}
			.review_chat49 .star_bottom  p{color: #fff; font-size: 14px; font-weight: 500; line-height: normal; float: left; margin-right: 10px;}
			.review_chat49 .star_bottom img{margin-top:0px;}
			
			
			.review_chat49 .box_right .client_review .fa.fa-angle-left {width: 16px;height: 16px;background-color: rgba(0, 0, 0, 0.2);border-radius: 100%;text-align: center;font-size: 14px;position: relative;    top: -2px;    margin-right: 8px;}
			.review_chat49 .middle .box_1 .reply_comment .right {display: inline-block;}
			.review_chat49 .middle .box_1 .reply_comment p {color: #22375e;font-size: 14px;font-weight: normal;line-height: 1.57;margin-bottom: 10px;}
			.review_chat49 .reply_comment .right {max-width: 410px;float: right;}
			.review_chat49 .reply_comment .client_n p{font-size: 12px !important; color: #080d2e !important; font-weight: 500; margin: 0;}
			.review_chat49 .reply_comment .client_review p{font-size: 14px !important; line-height: 1.57 !important; color: #353965 !important;font-weight: normal !important;}
			
			.review_chat49 .bottom_btn_sec .sav_con {    width: 149px;    height: 40px;    border-radius: 5px;    box-shadow: 0 2px 3px 0 rgba(118, 55, 251, 0.1), 0 1px 1px 0 rgba(109, 65, 242, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);    background-color: #7f62df;    font-family: 'Inter UI';    font-size: 14px;    font-weight: 500;
			font-style: normal;    font-stretch: normal;    line-height: 1.14;    letter-spacing: -0.2px;    text-align: center;    color: #fff;    border: 0;}
			.review_chat49 .main_comment h1{ font-size: 20px;font-weight: 500;font-style: normal;line-height: 1.05;text-align: center; color: #1e1e40; margin-top: 25px;}
			.review_chat49 .main_comment p{font-size: 14px;  font-weight: normal;  line-height: 1.71;  text-align: center; color: #525378;}
			.review_chat49 .bottom_btn_sec{text-align: center; width: 100%;margin-top: 30px;}
			
			@media only screen and (max-width:480px){
			.review_chat49 .second_box{padding: 40px 50px;}
			}
			
			
		</style>
		
		<style type="text/css">
			.selected{
			text-shadow: 0 1px 0 0 rgba(255, 160, 79, 0.15)!important;
			color: #ffcd5e!important;
			font-size: 18px; 
			margin-right: 3px;
			}
			.fav_gry{
			margin-right: 3px;
			}
			.icon_image_check {
			display: none;
			}
			.icon_image_active {
			display: none;
			}
			.icon_image {
			display: none;
			}
			.dropzone {
			border-radius: 5p
			x;
			box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);
			border: solid 1px #f3f4f7;
			background-color: #fff;
			text-align: center;
			padding-top: 30px;
			}
			.dropzone .GIF-JPG-PNG-ASF {
			font-family: 'Inter UI';
			font-size: 11px;
			font-weight: normal;
			font-style: normal;
			font-stretch: normal;
			line-height: 1.09;
			letter-spacing: normal;
			color: #9292b4;
			margin-top: 12px;
			}
			
			.dropzone .Drag-Drop-Your-Fil {
			font-family: 'Inter UI';
			font-size: 12px;
			font-weight: 500;
			font-style: normal;
			font-stretch: normal;
			line-height: 0.92;
			letter-spacing: normal;
			color: #2f3053;
			margin-top: 12px;
			}
			
			.bg-teal-400 {
			background-color: #26A69A;
			border-color: #26A69A;
			color: #fff;
			}
			.btn i {
			font-size: 12px!important;
			}
			
		</style>
		
		<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
		<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
		
	</head>
	<body>
		<?php 

			if (!empty($oCampaign)) {
				//permissions
				$bAllowComments = ($oCampaign->allow_comments == 1) ? true : false;
				$bAllowVideoComments = ($oCampaign->allow_video_reviews == 1) ? true : false;
				$bAllowHelpful = ($oCampaign->allow_helpful_feedback == 1) ? true : false;
				$bAllowLiveReading = ($oCampaign->allow_live_reading_review == 1) ? true : false;
				$bAllowRatings = ($oCampaign->allow_comment_ratings == 1) ? true : false;
				$bAllowCreatedTime = ($oCampaign->allow_review_timestamp == 1) ? true : false;
				$bAllowProsCons = ($oCampaign->allow_pros_cons == 1) ? true : false;
				$bAllowBranding = ($oCampaign->allow_branding == 1) ? true : false;
				$headerFixColor = ($oCampaign->header_color_fix == 1) ? true : false;
				$headerSolidColor = ($oCampaign->header_color_solid == 1) ? true : false;
				$headerCustomColor = ($oCampaign->header_color_custom == 1) ? true : false;
				
				$bgClassName = '';
				if($headerFixColor){
					$bgClassName = $oCampaign->header_color.'_preview_1';
				}
				
				//get other settings
				$bgColor = $oCampaign->bg_color;
				$txtColor = $oCampaign->text_color;	
			}
			
			//Total Reviews
			$reviewRating = 3;
			$oneRating = 0;
			$twoRating = 0;
			$threeRating = 0;
			$fourRating = 0;
			$fiveRating = 0;
			
			$totalReviews = (sizeof($aReviews) > 0) ? sizeof($aReviews) : 0;
			$totalRatings = 0;
			if (!empty($aReviews)) {
				foreach ($aReviews as $arr) {
					
					if($arr['ratings'] == '5') {
						$fiveRating += 1;
					}
					else if($arr['ratings'] == '4') {
						$fourRating += 1;
					}
					else if($arr['ratings'] == '3') {
						$threeRating += 1;
					}
					else if($arr['ratings'] == '2') {
						$twoRating += 1;
					}
					else if($arr['ratings'] == '1') {
						$oneRating += 1;
					}
					
					$totalRatingReview = $fiveRating+$fourRating+$threeRating+$twoRating+$oneRating;
					$totalRatings = $totalRatings + $arr['ratings'];
				}
			}
			$avgRatings = $totalRatings/$totalReviews; 
			
			//$oCampaign->logo_img = '';
			//pre($aReviews);
			//pre($brandData);
			$brandHeaderColorSolid = $brandData->header_color_solid;
			$brandHeaderColorCustom = $brandData->header_color_custom;
			$brandHeadercolorFix = $brandData->header_color_fix;
			$countryName = code_to_country($userDetail->country);
			$area_type = $brandData->area_type;
		?>
		
		<style><?php
			if($brandHeaderColorSolid){
				$solidColor = $brandData->header_solid_color;
				echo '.bbSolidColor{background: '.$solidColor.'!important;}';
				echo '.textSolidColor{color: '.$solidColor.'!important;}';
				$bgClassName = 'bbSolidColor';
				$textClassName = 'textSolidColor';
			}
			
			if($brandHeaderColorCustom){
				$gradientColor1 = $brandData->header_custom_color1;
				$gradientColor2 = $brandData->header_custom_color2;
				echo '.bbGradientColor{background-image: linear-gradient(45deg, '.$gradientColor1.' 1%, '.$gradientColor2.')!important;}';
				echo '.textSolidColor{color: '.$gradientColor2.'!important;}';
				$bgClassName = 'bbGradientColor';
				$textClassName = 'textSolidColor';
			}
			
			if($brandHeadercolorFix) {
				$header_color = $brandData->header_color; 
				$brandClassName = $brandData->header_color.'_preview_1';
			$brandTextSolidColor = $brandData->header_color.'_textSolidColor'; ?>
			.red_preview_1{background-image: linear-gradient(45deg, #e93474, #541069 98%)!important;}
			.yellow_preview_1{background-image: linear-gradient(42deg, #f9d84a, #f9814a)!important;}
			.orange_preview_1{background-image: linear-gradient(45deg, #ef9d39, #d92a3f)!important;}
			.green_preview_1{background-image: linear-gradient(43deg, #93cf48, #076768)!important;}
			.blue_preview_1{background-image: linear-gradient(43deg, #4194f7 3%, #1b1f97 99%)!important;}
			.purple_preview_1{background-image: linear-gradient(45deg, #4d4d7c 1%, #1e1e40)!important;}
			
			.red_textSolidColor{color: #541069!important;}
			.yellow_textSolidColor{color: #f9814a!important;}
			.orange_textSolidColor{color: #d92a3f!important;}
			.green_textSolidColor{color: #076768!important;}
			.blue_textSolidColor{color: #1b1f97!important;}
			.purple_textSolidColor{color: #1e1e40!important;}
			<?php 
				
				if($brandData->header_color == 'red') {
					echo '.textSolidColor{color: #541069!important;}';
				}
				else if($brandData->header_color == 'yellow') {
					echo '.textSolidColor{color: #f9814a!important;}';
				}
				else if($brandData->header_color == 'orange') {
					echo '.textSolidColor{color: #d92a3f!important;}';
				}
				else if($brandData->header_color == 'green') {
					echo '.textSolidColor{color: #076768!important;}';
				}
				else if($brandData->header_color == 'blue') {
					echo '.textSolidColor{color: #1b1f97!important;}';
				}
				else if($brandData->header_color == 'purple') {
					echo '.textSolidColor{color: #1e1e40!important;}';
				}
				
			} 
			
			
			if($brandHeadercolorFix > 0){
				$textClassReview = $brandTextSolidColor;
			}
			else if($brandHeaderColorCustom > 0) {
				$textClassReview = 'textSolidColor';
			}
			else if($brandHeaderColorSolid > 0) {
				$textClassReview = 'textSolidColor';
			} 
			
			if($brandHeadercolorFix > 0) {
				$gradientClassReview = $brandClassName;
			} 
			else if($brandHeaderColorCustom > 0) {
				$gradientClassReview = 'bbGradientColor';
			} 
			else if ($brandHeaderColorSolid > 0) {
				$gradientClassReview = 'bbSolidColor';
			}
		?>
		</style>
		
		<div class="brand_page_pr gr_1 <?php echo $area_type == '2'?$gradientClassReview:''; ?>">
			<div class="brand_page_gr <?php echo $area_type == '1'?$gradientClassReview:''; ?>">
				<div class="page_header">
					<div class="col-md-6 col-xs-6"><img src="<?php echo base_url(); ?>assets/images/bb_sm_logo.jpg" alt=""  class="br5"></div>
					<div class="col-md-6 col-xs-6 text-right"><a href="" class="txt_white">FAQ</a></div>
				</div>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="white_box inline_block top_sec">
							
							<?php 
								if($brandData->about_company_position == 'right') {
								?>
								
								<div class="col-md-7 pr">
									<div class="col-md-3 <?php echo $brandData->avatar > 0 ? '':'hidden'; ?>"><img class="w100 br100" src="<?php if (!empty($oCampaign->logo_img)): ?> https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $oCampaign->logo_img; ?><?php else: ?>https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $brandData->company_logo; ?><?php endif; ?>" onerror="this.src='http://brandboost.io/assets/images/default-logo.png'" alt=""></div>
									
									<div class="col-md-9">
										<div class="interactions p25 <?php echo $brandData->contact_info > 0 ? '':'hidden';?>">
											<ul>
												<li><small><i class="fa fa-map-marker mr10"></i>Country</small> <strong>
													<?php if($userDetail->country != ''){
														$countryFlag = strtolower($userDetail->country);
														?><img src="<?php echo base_url(); ?>assets/images/flags/<?php echo $countryFlag; ?>.png" alt=""><?php
													}
													else {
														?><img src="<?php echo base_url(); ?>assets/images/un_flag.png" alt=""><?php
													} ?> 
												<?php echo $countryName != ''? $countryName: 'N/A'; ?></strong></li>
												<li><small><i class="fa fa-building-o mr10"></i>City</small> <strong><span class="brig pr10 mr10"><?php echo $userDetail->city != ''? $userDetail->city: 'N/A'; ?></span>  <?php echo $userDetail->address != '' ? $userDetail->address : 'N/A'; ?></strong></li>
												<li><small><i class="fa fa-phone mr10"></i>Phone number</small> <strong><?php echo $userDetail->mobile != ''? $userDetail->mobile: 'N/A'; ?></strong></li>
												<li><small><i class="fa fa-globe mr10"></i>Website</small> <strong><?php echo $userDetail->company_website != ''? $userDetail->company_website: 'N/A'; ?></strong></li>
												<li><small><i class="fa fa-envelope-o mr10"></i>Email</small> <strong><?php echo $userDetail->email != ''? $userDetail->email: 'N/A'; ?></strong></li>
											</ul>
										</div>
										
										<div class="brand_social pl20 <?php echo $brandData->socials > 0 ? '':'hidden';?>">
											<?php $socialIcon = array('fa-facebook', 'fa-comment', 'fa-paper-plane', 'fa-youtube-play', 'fa-twitter', 'fa-instagram', 'fa-google');
												foreach ($socialIcon as $value) {
												?>
												<a style="cursor: pointer;"><i class="fa <?php echo $value; ?> <?php echo $textClassReview; ?>"></i></a>
												<?php
												} ?>
										</div>
										
									</div>
								</div>
								
								<div class="col-md-5 pl">
									
									<div class="col-md-12">
										<h4 class="fw500 txt_dgrey mb0"><?php echo $oCampaign->brand_title != '' ? $oCampaign->brand_title : $brandData->company_info_name; ?></h4>
										<p class="mb30 fsize13">
											<span class="<?php echo $brandData->rating == 'off'?'hidden':''; ?>">
												<?php for ($i = 1; $i <= 5; $i++): ?>
												<i class="fa fa-star  <?php
													if ($i <= ceil($avgRatings)) {
														echo 'txt_yellow';
														}else{
														echo 'txt_grey';
													}
												?>"></i> 
												<?php endfor; ?>
												
											</span> 
											
											<span class="ml10 fsize14 fw700 <?php echo $brandData->rating == 'off'?'hidden':''; ?>"><?php 
												if($avgRatings > 0) {
													echo number_format($avgRatings, 1);
												}
												else {
													echo '0.0';
												}
											?></span> <span class="ml10 <?php echo $brandData->rating == 'off'?'hidden':''; ?>"><?php echo count($aReviews) > 0?count($aReviews):'0'; ?> customer reviews</span> <span class="ml10 inline_block"><?php echo count($questionAndAnsData); ?> questions & answers</span></p>
											<p class="fsize12 mb20 txt_dgrey lh20 <?php echo $brandData->company_description > 0 ? '':'hidden'; ?>"><?php echo $oCampaign->brand_desc != ''? $oCampaign->brand_desc : $brandData->company_info_description; ?></p>
											<div class="walker_p <?php echo $brandData->services > 0 ? '':'hidden'; ?>">
												<?php $reviewTag = array('Design Agency', 'Design & Development', 'User Expirience Design', 'Logo'); 
													foreach ($reviewTag as $value) {
														?><a style="cursor: pointer;" class="<?php echo $textClassReview; ?>"><?php echo $value; ?></a> <?php
													}
												?>
											</div>
											<div class="rightBtnSection">
												<a class="textSolidColor addReview" href="javascript:void(0);">
													<img src="http://brandboost.io/assets/images/widget/smile-icon.png">&nbsp; Add review
												</a>
												<a class="textSolidColor addQuestion" href="javascript:void(0);">
													<img src="http://brandboost.io/assets/images/widget/ask-icon.png">&nbsp; Ask a Question
												</a> &nbsp; 
												<div style="padding: 0px" class="<?php echo $brandData->contact_button > 0 ? '':'hidden'; ?> contact_btn_box" style=""><button type="button" class="btn dark_btn siteContact" site="<?php echo $oCampaign->domain_name != ''? $oCampaign->domain_name: ''; ?>">Contact Us</button></div> 
											</div>
									</div>
								</div>
								
								
								<?php
								}
								else {
								?>
								<div class="col-md-6 col-xs-6 brand_head_sec pr">
									<div class="col-md-3 <?php echo $brandData->avatar > 0 ? '':'hidden'; ?>"><img class="w100 br100 mt10" src="<?php if (!empty($oCampaign->logo_img)): ?> https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $oCampaign->logo_img; ?><?php else: ?>https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $brandData->company_logo; ?><?php endif; ?>" onerror="this.src='http://brandboost.io/assets/images/default-logo.png'" alt=""></div>
									<div class="col-md-9">
										<h4 class="fw500 txt_dgrey mb0 mt0"><?php echo $oCampaign->brand_title != '' ? $oCampaign->brand_title : $brandData->company_info_name; ?></h4>
										<p class="mb30 fsize13">
											<span class="<?php echo $brandData->rating == 'off'?'hidden':''; ?>">
												<?php for ($i = 1; $i <= 5; $i++): ?>
												<i class="fa fa-star  <?php
													if ($i <= ceil($avgRatings)) {
														echo 'txt_yellow';
														}else{
														echo 'txt_grey';
													}
												?>"></i> 
												<?php endfor; ?>
												
											</span>  
											
											<span class="ml10 fsize14 fw700 <?php echo $brandData->rating == 'off'?'hidden':''; ?>"><?php 
												if($avgRatings > 0) {
													echo number_format($avgRatings, 1);
												}
												else {
													echo '0.0';
												}
											?> </span> <span class="ml10 <?php echo $brandData->rating == 'off'?'hidden':''; ?>"><?php echo count($aReviews) > 0?count($aReviews):'0'; ?> customer reviews</span> <span class="ml0 inline_block"><?php echo count($questionAndAnsData); ?> questions & answers</span></p>
											<p class="fsize12 mb20 txt_dgrey lh20 <?php echo $brandData->company_description > 0 ? '':'hidden'; ?>"><?php echo $oCampaign->brand_desc != ''? $oCampaign->brand_desc : $brandData->company_info_description; ?></p>
											<div class="walker_p <?php echo $brandData->services > 0 ? '':'hidden'; ?>">
												<?php $reviewTag = array('Design Agency', 'Design & Development', 'User Expirience Design', 'Logo'); 
													foreach ($reviewTag as $value) {
														?><a style="cursor: pointer;" class="<?php echo $textClassReview; ?>"><?php echo $value; ?></a> <?php
													}
												?>
											</div>
											<div class="rightBtnSection">
												<a class="textSolidColor addReview" href="javascript:void(0);">
													<img src="http://brandboost.io/assets/images/widget/smile-icon.png">&nbsp; Add review
												</a>
												<a class="textSolidColor addQuestion" href="javascript:void(0);">
													<img src="http://brandboost.io/assets/images/widget/ask-icon.png">&nbsp; Ask a Question
												</a> &nbsp; 
												<div style="padding: 0px" class="<?php echo $brandData->contact_button > 0 ? '':'hidden'; ?> contact_btn_box" style=""><button type="button" class="btn dark_btn siteContact" site="<?php echo $oCampaign->domain_name != ''? $oCampaign->domain_name: ''; ?>">Contact Us</button></div> 
											</div>
											
									</div>
								</div>
								
								<div class="col-md-6 col-xs-6 brand_head_sec pl">
									<div class="interactions p25 pt0 <?php echo $brandData->contact_info > 0 ? '':'hidden';?>">
										<ul>
											<li><small><i class="fa fa-map-marker mr10"></i>Country</small> <strong>
												<?php if($userDetail->country != ''){
													$countryFlag = strtolower($userDetail->country);
													?><img src="<?php echo base_url(); ?>assets/images/flags/<?php echo $countryFlag; ?>.png" alt=""><?php
												}
												else {
													?><img src="<?php echo base_url(); ?>assets/images/un_flag.png" alt=""><?php
												} ?>
												
												
											<?php echo $countryName != ''? $countryName: 'N/A'; ?></strong></li>
											<!-- <li><small><i class="fa fa-building-o mr10"></i>City</small> <strong><span class="brig pr10 mr10">San-Francisco</span>  Worlwide</strong></li> -->
											<li><small><i class="fa fa-building-o mr10"></i>City</small> <strong><span class="brig pr10 mr10"><?php echo $userDetail->city != ''? $userDetail->city: 'N/A'; ?></span>  <?php echo $userDetail->address != '' ? $userDetail->address : 'N/A'; ?></strong></li>
											<li><small><i class="fa fa-phone mr10"></i>Phone number</small> <strong><?php echo $userDetail->mobile != ''? $userDetail->mobile: 'N/A'; ?></strong></li>
											<li><small><i class="fa fa-globe mr10"></i>Website</small> <strong><?php echo $userDetail->company_website != ''? $userDetail->company_website: 'N/A'; ?></strong></li>
											<li><small><i class="fa fa-envelope-o mr10"></i>Email</small> <strong><?php echo $userDetail->email != ''? $userDetail->email: 'N/A'; ?></strong></li>
										</ul>
									</div>
									
									<div class="brand_social pl20 <?php echo $brandData->socials > 0 ? '':'hidden';?>">
										<?php $socialIcon = array('fa-facebook', 'fa-comment', 'fa-paper-plane', 'fa-youtube-play', 'fa-twitter', 'fa-instagram', 'fa-google');
											foreach ($socialIcon as $value) {
											?>
											<a style="cursor: pointer;"><i class="fa <?php echo $value; ?> <?php echo $textClassReview; ?>"></i></a>
											<?php
											} ?>
											
									</div>
									
								</div>
								<?php
								}
							?>
							
							
						</div>
					</div>
				</div><!--row-->
				
				
				<div class="row">
					<div class="brand_side mt-10">
						
						<?php 
							if($brandData->review_list_position == 'left') {
								$position = 'right';
							}
							else {
							 	$position = 'left';
							} 
						?>
						<div class="col-md-4"  style="float: <?php echo $position; ?>">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title pr10 pl10">About our company<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								</div>
								<div class="panel-body br0">
									<p class="fsize12 mb20 lh24 text-muted pr10 pl10">
										<?php echo $userDetail->company_description != '' ? $userDetail->company_description : 'N/A'; ?>
									</p>
									<a style="cursor: pointer;" class="<?php echo $textClassReview; ?> fw500 fsize12 pl10">Learn More</a>
								</div>
							</div>
							
							
							
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title pr10 pl10">Media<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								</div>
								<div class="panel-body br0 brand_media pt-30">
									
									<?php 
										if (!empty($aReviews)): 
										foreach ($aReviews as $aReview):
										
										
										$brandImgArray = unserialize($aReview['media_url']);
										
										if (count($brandImgArray) > 0):
										$j = 0;
										if($brandImgArray[0]['media_type'] == 'image') {
											
											$profileImg = $aReview['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$aReview['user_data']['avatar'];
											
										?>
										<div class="col-md-6">
											<div class="white_box mb20">
												<a style="cursor: pointer;" revId="<?php echo $aReview['id']; ?>" revAvatar="<?php echo $profileImg; ?>" class="mediaLargImage myBtn"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $brandImgArray[0]['media_url']; ?>" alt="" class="w100"></a>
											</div>
										</div>
										
										<?php 
											if($j>0 && $j%2) {
												?><div class="clearfix"></div><?php
											}
											$j++;
											
										}
										endif;
										endforeach;
										endif;
										
										
									?>	
									
								</div>
								<!-- <div class="panel-footer p20">
									<a href="#" class="fsize14 fw500 txt_green">View All Review <i class="icon-arrow-right13 pull-right txt_green fsize16 mt-5"></i></a>
								</div> -->
							</div>
							
							
						</div>
						<div class="col-md-8" >
							<?php //echo $textClassReview; ?>
							<div class="white_box p20 pl-10">
								<ul class="nav nav-tabs nav-tabs-bottom tab_brand_new brand_product_review">
									<li class="active"><a href="#right-icon-tab0" class="tabColor textSolidColor" data-toggle="tab">Product Reviews <span>(<?php echo count($aReviews) > 0 ? count($aReviews) : '0'; ?>)</span></a> </li>
									<li><a href="#right-icon-tab1" class="tabColor" data-toggle="tab">Site Reviews <span>(<?php echo count($aSiteReviews) > 0 ? count($aSiteReviews) : '0';?>)</span></a> </li>
									<li><a href="#right-icon-tab2" class="tabColor" data-toggle="tab">Service Reviews <span>(<?php echo count($servicesReviews) > 0 ? count($servicesReviews) : '0';?>)</span></a> </li>
									<!-- <li><a href="#right-icon-tab3" class="tabColor" data-toggle="tab">Questions <span>(<?php echo count($questionAndAnsData); ?>)</span></a> </li> -->
									<li><a href="#right-icon-tab3" class="tabColor" data-toggle="tab">Questions <span>(<?php if(!empty($questionAndAnsData)) { echo count($questionAndAnsData); } else { echo '0'; } ?>)</span></a> </li>
									<li><a href="#right-icon-tab4" class="tabColor" data-toggle="tab">FAQ <span>(<?php echo count(array_filter($faQData)); ?>)</span></a> </li>
								</ul>
							</div>
							
							<div class="tab-content"> 
								
								<div class="tab-pane active" id="right-icon-tab0">
									
									
									<div class="review_ratings">
										
										<?php if (!empty($aReviews)): ?>
										<?php
											foreach ($aReviews as $aReview):
											
											$profileImg = $aReview['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$aReview['user_data']['avatar'];
											
											$brandImgArray = unserialize($aReview['media_url']);
											
											
											if (count($brandImgArray) > 0){
												if($brandImgArray[0]['media_type'] == 'image') {
													$reviewImg = '<a style="cursor:pointer;" revId="'.$aReview['id'].'" revAvatar="'.$profileImg.'" class="mediaLargImage"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/'.$brandImgArray[0]['media_url'].'" alt="" class="b_review"></a>';
													$commentWL = '80';
												}
												else {
													$reviewImg = '';
												}
											}
											else {
												$reviewImg = '';
											}
											
											
											
											
											if (!empty($aReview['media_url'])) {
												if (strpos($aReview['media_url'], '.mp4') !== false) {
													$mediaType = 'video';
													} else {
													$mediaType = 'image';
												}
												} else {
												$mediaType = '';
											}
											//if($aReview['status'] == 1 || ($aReview['status'] == 2 && $aReview['user_id'] == $userID)){
											
											//pre($aReview);
										?>
										<input type="hidden" class="fullname<?php echo $aReview['id']?>" value="<?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?>">
										
										<input type="hidden" class="review<?php echo $aReview['id']?>" value="<?php echo $aReview['comment_text'] != ''?$aReview['comment_text']: ''; ?>">
										
										
										
										
										<div class="brand_review mb-20 br5">
											<div class="p20 bbot pl30">
												<div class="media-left media-middle"> <!-- <i class="fa fa-circle circle txt_green"></i> --> <a class="icons" style="cursor: pointer;"><img src="<?php echo $profileImg; ?>" class="img-circle img-xs" alt=""></a> </div>
												<div class="media-left">
													<div class="pt-5 fsize14 fw500"><span><?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?></span><span class="fw400 text-muted fsize14 ml-10">bought <?php echo $aReview['product_data']->product_name == '' ? $aReview['brand_title'] : $aReview['product_data']->product_name; ?></span></div>
													
													<div class="text-muted startRate<?php echo $aReview['id']; ?> text-size-small hidden">
														<p class="pull-left">
															<?php for ($i = 1; $i <= 5; $i++): ?>
															<i class="fa fa-star fsize13 <?php
																if ($i <= $aReview['ratings']) {
																	echo 'txt_yellow';
																	}else{
																	echo 'txt_grey';
																}
															?>"></i>                                                                      
															<?php endfor; ?>
														</p>
														<span class="ml10"><?php echo timeAgo($aReview['created']); ?></span>
													</div>
													<!-- <p class="hidden revComment<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/comment_icon.jpg"><?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : '0'; ?> Comments <span id="revRatingStars"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span></p> -->
													
													<div class="text-muted  text-size-small"><span>
														<?php for ($i = 1; $i <= 5; $i++): ?>
														<i class="fa fa-star fsize12 <?php
															if ($i <= $aReview['ratings']) {
																echo 'txt_yellow';
																}else{
																echo 'txt_grey';
															}
														?>"></i>                                                                      
														<?php endfor; ?>
													</span>
													<span class="ml10 fw500 text-muted"><?php echo timeAgo($aReview['created']); ?></span></div>
												</div>
											</div>
											<div class="p20 bbot pl30 pr30">
												
												<p><?php echo $reviewImg; ?><p class="fsize15 fw600" style="margin-top: -12px;"><?php echo $aReview['review_title']; ?></p><span class="smallComment"><?php echo $aReview['comment_text'] != ''?setStringLimit($aReview['comment_text'], 250, $textClassReview): ''; ?></span><span class="moreComment hidden"><?php echo $aReview['comment_text'] != ''? $aReview['comment_text'].'&nbsp;&nbsp;<a style="curser:pointer" class="readLess '. $textClassReview .'">Less...</a>' : ''; ?></span></p>
												<div class="clearfix"></div>
												<div class="pt20">
													<p class="mb0 fsize13">
														<span style="cursor: pointer;" class="pr10 brig fw500 text-muted commentReview"><i class="fa fa-comment-o fsize11 txt_grey"></i> &nbsp; <?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : '0'; ?> Comments</span>
														<span class="pr10 brig ml10 fw500 text-muted hidden-xs"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span>
														<span class="ml10 fw500 text-muted review_helpful_<?php echo $aReview['id']; ?> "><?php echo ($aReview['total_helpful']) ? $aReview['total_helpful'] : 0; ?> Found this helpful</span> 
														<span class="ml-10">
															<a style="cursor: pointer;" class="pw_helpful_action bb_show_like_value"  action-name="Yes" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-up fsize10 txt_green brand_thumbs br5 mr-5"></i></a> 
															<a style="cursor: pointer;" class="pw_helpful_action bb_show_dis_like_value"  action-name="No" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-down fsize10 txt_red brand_thumbs br5"></i></a>
															
														</span>
													</p>
												</div>
											</div>
											
											<!--*** comment section ***-->
											<div class="pw_comment_box p30" style="display: none;">
												
												<?php if (!empty($aReview['comment_block'])): ?>
												<?php
													foreach ($aReview['comment_block'] as $aComment):
													//pre($aComment);
													$getUserDetail = getUserDetail($aComment['user_id']);
												?>
												<div class="comment_row">
													<p style="font-weight: 500;"><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
													<p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
												</div>
												<?php endforeach; ?>
												
												<?php endif; ?>
												<div class="pw_success_message">
													<div class="alert-success popup-cmt-alert-success-msg hidden" id="success-<?php echo $aReview['id']; ?>">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
													<div class="alert-danger popup-cmt-alert-error-msg hidden" id="error-<?php echo $aReview['id']; ?>">OPPS! Error while posting your comment. Try again!</div>
												</div>
												<div class="comment_form">
													
													<form method="POST" class="cmtformsubmit" action="javascript:void(0)" revId="<?php echo $aReview['id']; ?>" style="position:relative;">
														<div class="form-group">
															<div class="">
																<input name="cmtname" placeholder="Your Name" class="form-control cmtname" required="" type="text">
															</div>
														</div>
														<div class="form-group">
															<div class="">
																<input name="cmtemail" placeholder="Your Email" class="form-control cmtemail" required="" type="text">
															</div>
														</div>
														<div class="form-group">
															<textarea class="form-control cmt" name="cmt" placeholder="Write Your Comments Here…" required></textarea>
														</div>
														<div class="s_comment">
															<input type="hidden" name="rid" class="review-id" value="<?php echo $aReview['id']; ?>" >
															<button type="submit" class="cmtsubmit btn dark_btn mt30" name="cmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
														</div>
														<div class="overlay hidden" id="overlay-<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>assets/images/widget_load.gif" width="60" height="60"></div>
													</form>
												</div>
												
											</div>
											<!--**** end comment section ****-->
										</div>
										
										
										<?php 
											
											//}
											endforeach;
										?> <div class="appendCampaignReview"></div>
										<img class="campaignReviewLoader hidden" style="height: 50px; width: 50px; position: relative; left: 50%; margin-left: -25px;" src="<?php echo base_url(); ?>/assets/images/widget_load.gif"> <?php
										else: ?>
										<div class="brand_review mb-20 br5">
											<div class="p20 bbot pl30">
												<i>No reviews given yet</i>
											</div>
										</div> 
										<?php endif; ?>
										
									</div>
								
								</div>
								
								<div class="tab-pane" id="right-icon-tab1">
									
									<div class="review_ratings">
										
										<?php if (!empty($aSiteReviews)): ?>
										<?php
											foreach ($aSiteReviews as $aReview):
											
											$profileImg = $aReview['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$aReview['user_data']['avatar'];
											
											$brandImgArray = unserialize($aReview['media_url']);
											
											
											if (count($brandImgArray) > 0){
												if($brandImgArray[0]['media_type'] == 'image') {
													$reviewImg = '<a style="cursor:pointer;" revId="'.$aReview['id'].'" revAvatar="'.$profileImg.'" class="mediaLargImage"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/'.$brandImgArray[0]['media_url'].'" alt="" class="b_review"></a>';
													$commentWL = '80';
												}
												else {
													$reviewImg = '';
												}
											}
											else {
												$reviewImg = '';
											}
											
											
											
											
											if (!empty($aReview['media_url'])) {
												if (strpos($aReview['media_url'], '.mp4') !== false) {
													$mediaType = 'video';
													} else {
													$mediaType = 'image';
												}
												} else {
												$mediaType = '';
											}
											//if($aReview['status'] == 1 || ($aReview['status'] == 2 && $aReview['user_id'] == $userID)){
											
											//pre($aReview);
										?>
										<input type="hidden" class="fullname<?php echo $aReview['id']?>" value="<?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?>">
										
										<input type="hidden" class="review<?php echo $aReview['id']?>" value="<?php echo $aReview['comment_text'] != ''?$aReview['comment_text']: ''; ?>">
										
										
										
										
										<div class="brand_review mb-20 br5">
											<div class="p20 bbot pl30">
												<div class="media-left media-middle"> <!-- <i class="fa fa-circle circle txt_green"></i> --> <a class="icons" style="cursor: pointer;"><img src="<?php echo $profileImg; ?>" class="img-circle img-xs" alt=""></a> </div>
												<div class="media-left">
													<div class="pt-5 fsize14 fw500"><span><?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?></span><span class="fw400 text-muted fsize14 ml-10">bought <?php echo $aReview['product_data']->product_name == '' ? $aReview['brand_title'] : $aReview['product_data']->product_name; ?></span></div>
													
													<div class="text-muted startRate<?php echo $aReview['id']; ?> text-size-small hidden">
														<p class="pull-left">
															<?php for ($i = 1; $i <= 5; $i++): ?>
															<i class="fa fa-star fsize13 <?php
																if ($i <= $aReview['ratings']) {
																	echo 'txt_yellow';
																	}else{
																	echo 'txt_grey';
																}
															?>"></i>                                                                      
															<?php endfor; ?>
														</p>
														<span class="ml10"><?php echo timeAgo($aReview['created']); ?></span>
													</div>
													<!-- <p class="hidden revComment<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/comment_icon.jpg"><?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : '0'; ?> Comments <span id="revRatingStars"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span></p> -->
													
													<div class="text-muted  text-size-small"><span>
														<?php for ($i = 1; $i <= 5; $i++): ?>
														<i class="fa fa-star fsize12 <?php
															if ($i <= $aReview['ratings']) {
																echo 'txt_yellow';
																}else{
																echo 'txt_grey';
															}
														?>"></i>                                                                      
														<?php endfor; ?>
													</span>
													<span class="ml10 fw500 text-muted"><?php echo timeAgo($aReview['created']); ?></span></div>
												</div>
											</div>
											<div class="p20 bbot pl30 pr30">
												
												<p><?php echo $reviewImg; ?><p class="fsize15 fw600" style="margin-top: -12px;"><?php echo $aReview['review_title']; ?></p><span class="smallComment"><?php echo $aReview['comment_text'] != ''?setStringLimit($aReview['comment_text'], 250, $textClassReview): ''; ?></span><span class="moreComment hidden"><?php echo $aReview['comment_text'] != ''? $aReview['comment_text'].'&nbsp;&nbsp;<a style="curser:pointer" class="readLess '. $textClassReview .'">Less...</a>' : ''; ?></span></p>
												<div class="clearfix"></div>
												<div class="pt20">
													<p class="mb0 fsize13">
														<span style="cursor: pointer;" class="pr10 brig fw500 text-muted commentReview"><i class="fa fa-comment-o fsize11 txt_grey"></i> &nbsp; <?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : '0'; ?> Comments</span>
														<span class="pr10 brig ml10 fw500 text-muted hidden-xs"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span>
														<span class="ml10 fw500 text-muted review_helpful_<?php echo $aReview['id']; ?> "><?php echo ($aReview['total_helpful']) ? $aReview['total_helpful'] : 0; ?> Found this helpful</span> 
														<span class="ml-10">
															<a style="cursor: pointer;" class="pw_helpful_action bb_show_like_value"  action-name="Yes" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-up fsize10 txt_green brand_thumbs br5 mr-5"></i></a> 
															<a style="cursor: pointer;" class="pw_helpful_action bb_show_dis_like_value"  action-name="No" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-down fsize10 txt_red brand_thumbs br5"></i></a>
															
														</span>
													</p>
												</div>
											</div>
											
											<!--*** comment section ***-->
											<div class="pw_comment_box p30" style="display: none;">
												
												<?php if (!empty($aReview['comment_block'])): ?>
												<?php
													foreach ($aReview['comment_block'] as $aComment):
													//pre($aComment);
													$getUserDetail = getUserDetail($aComment['user_id']);
												?>
												<div class="comment_row">
													<p style="font-weight: 500;"><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
													<p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
												</div>
												<?php endforeach; ?>
												
												<?php endif; ?>
												<div class="pw_success_message">
													<div class="alert-success popup-cmt-alert-success-msg hidden" id="success-<?php echo $aReview['id']; ?>">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
													<div class="alert-danger popup-cmt-alert-error-msg hidden" id="error-<?php echo $aReview['id']; ?>">OPPS! Error while posting your comment. Try again!</div>
												</div>
												<div class="comment_form">
													
													<form method="POST" class="cmtformsubmit" action="javascript:void(0)" revId="<?php echo $aReview['id']; ?>" style="position:relative;">
														<div class="form-group">
															<div class="">
																<input name="cmtname" placeholder="Your Name" class="form-control cmtname" required="" type="text">
															</div>
														</div>
														<div class="form-group">
															<div class="">
																<input name="cmtemail" placeholder="Your Email" class="form-control cmtemail" required="" type="text">
															</div>
														</div>
														<div class="form-group">
															<textarea class="form-control cmt" name="cmt" placeholder="Write Your Comments Here…" required></textarea>
														</div>
														<div class="s_comment">
															<input type="hidden" name="rid" class="review-id" value="<?php echo $aReview['id']; ?>" >
															<button type="submit" class="cmtsubmit btn dark_btn mt30" name="cmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
														</div>
														<div class="overlay hidden" id="overlay-<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>assets/images/widget_load.gif" width="60" height="60"></div>
													</form>
												</div>
												
											</div>
											<!--**** end comment section ****-->
										</div>
										
										
										<?php 
											
											//}
											endforeach;
										?> <div class="appendCampaignReview"></div>
										<img class="campaignReviewLoader hidden" style="height: 50px; width: 50px; position: relative; left: 50%; margin-left: -25px;" src="<?php echo base_url(); ?>/assets/images/widget_load.gif"> <?php
										else: ?>
										<div class="brand_review mb-20 br5">
											<div class="p20 bbot pl30">
												<i>No reviews given yet</i>
											</div>
										</div> 
										<?php endif; ?>
										
									</div>
								
								
								</div>
								
								<div class="tab-pane" id="right-icon-tab2">
									
									
									<div class="review_ratings">
										
										<?php if (!empty($servicesReviews)): ?>
										<?php
											foreach ($servicesReviews as $aReview):
											
											$profileImg = $aReview['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$aReview['user_data']['avatar'];
											
											$brandImgArray = unserialize($aReview['media_url']);
											
											
											if (count($brandImgArray) > 0){
												if($brandImgArray[0]['media_type'] == 'image') {
													$reviewImg = '<a style="cursor:pointer;" revId="'.$aReview['id'].'" revAvatar="'.$profileImg.'" class="mediaLargImage"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/'.$brandImgArray[0]['media_url'].'" alt="" class="b_review"></a>';
													$commentWL = '80';
												}
												else {
													$reviewImg = '';
												}
											}
											else {
												$reviewImg = '';
											}
											
											if (!empty($aReview['media_url'])) {
												if (strpos($aReview['media_url'], '.mp4') !== false) {
													$mediaType = 'video';
													} else {
													$mediaType = 'image';
												}
												} else {
												$mediaType = '';
											}
											//if($aReview['status'] == 1 || ($aReview['status'] == 2 && $aReview['user_id'] == $userID)){
											
											//pre($aReview);
										?>
										<input type="hidden" class="fullname<?php echo $aReview['id']?>" value="<?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?>">
										
										<input type="hidden" class="review<?php echo $aReview['id']?>" value="<?php echo $aReview['comment_text'] != ''?$aReview['comment_text']: ''; ?>">
										
										<div class="brand_review mb-20 br5">
											<div class="p20 bbot pl30">
												<div class="media-left media-middle"> <!-- <i class="fa fa-circle circle txt_green"></i> --> <a class="icons" style="cursor: pointer;"><img src="<?php echo $profileImg; ?>" class="img-circle img-xs" alt=""></a> </div>
												<div class="media-left">
													<div class="pt-5 fsize14 fw500"><span><?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?></span><span class="fw400 text-muted fsize14 ml-10">service <?php echo $aReview['product_data']->product_name; ?></span></div>
													
													<div class="text-muted startRate<?php echo $aReview['id']; ?> text-size-small hidden">
														<p class="pull-left">
															<?php for ($i = 1; $i <= 5; $i++): ?>
															<i class="fa fa-star fsize13 <?php
																if ($i <= $aReview['ratings']) {
																	echo 'txt_yellow';
																	}else{
																	echo 'txt_grey';
																}
															?>"></i>                                                                      
															<?php endfor; ?>
														</p>
														<span class="ml10"><?php echo timeAgo($aReview['created']); ?></span>
													</div>
													<!-- <p class="hidden revComment<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/comment_icon.jpg"><?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : '0'; ?> Comments <span id="revRatingStars"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span></p> -->
													
													<div class="text-muted  text-size-small"><span>
														<?php for ($i = 1; $i <= 5; $i++): ?>
														<i class="fa fa-star fsize12 <?php
															if ($i <= $aReview['ratings']) {
																echo 'txt_yellow';
																}else{
																echo 'txt_grey';
															}
														?>"></i>                                                                      
														<?php endfor; ?>
													</span>
													<span class="ml10 fw500 text-muted"><?php echo timeAgo($aReview['created']); ?></span></div>
												</div>
											</div>
											<div class="p20 bbot pl30 pr30">
												
												<p><?php echo $reviewImg; ?><p class="fsize15 fw600" style="margin-top: -12px;"><?php echo $aReview['review_title']; ?></p><span class="smallComment"><?php echo $aReview['comment_text'] != ''?setStringLimit($aReview['comment_text'], 250, $textClassReview): ''; ?></span><span class="moreComment hidden"><?php echo $aReview['comment_text'] != ''? $aReview['comment_text'].'&nbsp;&nbsp;<a style="curser:pointer" class="readLess '. $textClassReview .'">Less...</a>' : ''; ?></span></p>
												<div class="clearfix"></div>
												<div class="pt20">
													<p class="mb0 fsize13">
														<span style="cursor: pointer;" class="pr10 brig fw500 text-muted commentReview"><i class="fa fa-comment-o fsize11 txt_grey"></i> &nbsp; <?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : '0'; ?> Comments</span>
														<span class="pr10 brig ml10 fw500 text-muted hidden-xs"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span>
														<span class="ml10 fw500 text-muted review_helpful_<?php echo $aReview['id']; ?> "><?php echo ($aReview['total_helpful']) ? $aReview['total_helpful'] : 0; ?> Found this helpful</span> 
														<span class="ml-10">
															<a style="cursor: pointer;" class="pw_helpful_action bb_show_like_value"  action-name="Yes" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-up fsize10 txt_green brand_thumbs br5 mr-5"></i></a> 
															<a style="cursor: pointer;" class="pw_helpful_action bb_show_dis_like_value"  action-name="No" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-down fsize10 txt_red brand_thumbs br5"></i></a>
															
														</span>
													</p>
												</div>
											</div>
											
											<!--*** comment section ***-->
											<div class="pw_comment_box p30" style="display: none;">
												
												<?php if (!empty($aReview['comment_block'])): ?>
												<?php
													foreach ($aReview['comment_block'] as $aComment):
													//pre($aComment);
													$getUserDetail = getUserDetail($aComment['user_id']);
												?>
												<div class="comment_row">
													<p style="font-weight: 500;"><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
													<p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
												</div>
												<?php endforeach; ?>
												
												<?php endif; ?>
												<div class="pw_success_message">
													<div class="alert-success popup-cmt-alert-success-msg hidden" id="success-<?php echo $aReview['id']; ?>">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
													<div class="alert-danger popup-cmt-alert-error-msg hidden" id="error-<?php echo $aReview['id']; ?>">OPPS! Error while posting your comment. Try again!</div>
												</div>
												<div class="comment_form">
													
													<form method="POST" class="cmtformsubmit" action="javascript:void(0)" revId="<?php echo $aReview['id']; ?>" style="position:relative;">
														<div class="form-group">
															<div class="">
																<input name="cmtname" placeholder="Your Name" class="form-control cmtname" required="" type="text">
															</div>
														</div>
														<div class="form-group">
															<div class="">
																<input name="cmtemail" placeholder="Your Email" class="form-control cmtemail" required="" type="text">
															</div>
														</div>
														<div class="form-group">
															<textarea class="form-control cmt" name="cmt" placeholder="Write Your Comments Here…" required></textarea>
														</div>
														<div class="s_comment">
															<input type="hidden" name="rid" class="review-id" value="<?php echo $aReview['id']; ?>" >
															<button type="submit" class="cmtsubmit btn dark_btn mt30" name="cmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
														</div>
														<div class="overlay hidden" id="overlay-<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>assets/images/widget_load.gif" width="60" height="60"></div>
													</form>
												</div>
												
											</div>
											<!--**** end comment section ****-->
										</div>
										
										
										<?php 
											
											//}
											endforeach;
										?> <div class="appendCampaignReview"></div>
										<img class="campaignReviewLoader hidden" style="height: 50px; width: 50px; position: relative; left: 50%; margin-left: -25px;" src="<?php echo base_url(); ?>/assets/images/widget_load.gif"> <?php
										else: ?>
										<div class="brand_review mb-20 br5">
											<div class="p20 bbot pl30">
												<i>No reviews given yet</i>
											</div>
										</div> 
										<?php endif; ?>
										
									</div>
								</div>
								
								<div class="tab-pane" id="right-icon-tab3">
									<?php
										if (!empty($questionAndAnsData)) {
											foreach($questionAndAnsData as $questionAnsData){
											?>
											<div class="brand_review que_new mb-20 br5">
												<div class="p20 bbot pl30">
													<div class="media-left media-middle" style="vertical-align: top;padding-top: 10px;"><a class="icons" style="cursor: pointer;"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $questionAnsData['user_data']->avatar; ?>" class="img-circle img-xs" alt="" onerror="this.src='<?php echo base_url(); ?>assets/images/userp.png'"></a> </div>
													<div class="media-left">
														<div class="pt-5 fsize14 fw500 "><span><?php echo $questionAnsData['user_data']->firstname . ' ' . $questionAnsData['user_data']->lastname; ?></span> <span style="color:#999;" class="fsize11">( <?php echo timeAgo($questionAnsData['created']); ?> )</span></div>
														<div class="pt-5 fsize13 fw500"><span class="fsize14">Question: &nbsp; </span><?php echo $questionAnsData['question_title']; ?></div>
													</div>
												</div>
												<?php
													if (!empty($questionAnsData['answer'])) {
														foreach($questionAnsData['answer'] as $answer){
														?>
														<div class="p20 bbot pl30">
															<div class="media-left media-middle" style="vertical-align: top;padding-top: 10px;"><a class="icons" style="cursor: pointer;"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $answer['user_data']->avatar; ?>" class="img-circle img-xs" alt="" onerror="this.src='<?php echo base_url(); ?>assets/images/userp.png'"></a> </div>
															<div class="media-left">
																<div class="pt-5 fsize14 fw500"><span><?php echo $answer['user_data']->firstname . ' ' . $answer['user_data']->lastname; ?></span> <span style="color:#999;" class="fsize11">( <?php echo timeAgo($answer['created']); ?> )</span></div>
																<div class="pt-5 fsize13 fw500"><strong class="fsize14">Answer: &nbsp; </strong><span style="color:#666;"><?php echo base64_decode($answer['answer']); ?></span>
																	<div class="pt20">
																		<p class="mb0 fsize13">
																			<span class="fw500 text-muted answer_helpful_<?php echo $answer['id']; ?>"><?php echo count($answer['helpful']); ?> Found this helpful</span> 
																			<span class="ml-10">
																				<a style="cursor: pointer;" class="answer_helpful_action bb_show_like_value" action-name="Yes" answer-id="<?php echo $answer['id']; ?>"><i class="fa fa-thumbs-o-up fsize10 txt_green brand_thumbs br5 mr-5"></i></a> 
																				<a style="cursor: pointer;" class="answer_helpful_action bb_show_dis_like_value" action-name="No" answer-id="<?php echo $answer['id']; ?>"><i class="fa fa-thumbs-o-down fsize10 txt_red brand_thumbs br5"></i></a>
																			</span>
																		</p>
																	</div>	
																</div>
															</div>
														</div>
														<?php
														}
													}
												?>
											</div>
											<?php
											}
										}
									?>
								</div>
								
								<div class="tab-pane" id="right-icon-tab4">
									
									<div class="panel">
										<div class="panel-heading">
											<h6 class="panel-title">FAQ</h6>
										</div>
										<div class="panel-body p20 pt0 bkg_white">
											<div class="panel-group panel-group-control content-group-lg mb0">
												
												<!--  Faq loop Start  -->
												<?php  
													$incfaq = 1;
													if(count($faQDataRow)>0)
													{
													  foreach ($faQData as $faQDataRow) { 
                                                       
														?>
													<div class="panel panel-white">
														<div class="panel-heading pl0 sh_no">
															<h6 class="panel-title">
																<a data-toggle="collapse" data-parent="#accordion-control" href="#accordion-control-group<?php echo $incfaq; ?>" aria-expanded="true" class=""><?php echo $faQDataRow->question; ?></a>
															</h6>
														</div>
														<div id="accordion-control-group<?php echo $incfaq; ?>" class="panel-collapse collapse in" aria-expanded="true" style="">
															<div class="panel-body bkg_white brandfaqtab"><?php echo $faQDataRow->answer; ?></div>
														</div>
													</div>
													<?php
														$incfaq++; 
													}

													} else { ?> <i style="color:#000; padding-top: 15px; display: block">No Faq given yet</i> <?php   }?> 
													<!--  Faq loop Start  -->
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							<!--  Faq Section  -->
						</div>
						
						
						
					</div> 
					
				</div>
				
			</div>
			
		</div>
		
		
		<!-- The Modal -->
		<div id="myModal" class="modal fade in">
			<div class="modal-dialog modal-lg">
				<!-- Modal content -->
				<div class="modal-content">
					<span class="close">&times;</span>
					<!-- <div class="arrow"><a href="" class="left_arrow"><img src="<?php echo base_url(); ?>/assets/images/widget/arrow-left.png"></a> <a href="" class="right_arrow"><img src="<?php echo base_url(); ?>/assets/images/widget/arrow-right.png"></a></div> -->
					<div class="box_inner">
						
						<div class="left_box"><img id="mReviewImage" src="<?php echo base_url(); ?>/assets/images/widget/rolex_watch.jpg"></div><!--left_box--->
						<div class="right_box">
							<h1 class="heading_pop"><?php echo $oCampaign->brand_title != '' ? $oCampaign->brand_title : $brandData->company_info_name; ?></h1>
							<p class="heading_pop2"><?php echo $oCampaign->brand_desc != ''? $oCampaign->brand_desc : $brandData->company_info_description; ?></p>
							<div class="box_2">
								<div class="top_div">
									<div class="left"><!-- <i class="circle"></i> --><a class="icons" style="cursor: pointer;"><img id="mReviewAvatar" src="<?php echo base_url(); ?>/assets/images/widget/cust1.png" class="img-circle img-xs" alt=""></a></div>
									<div class="right">
										<div class="client_n"><p id="mFullName">Thomas Rogers</p></div>
										
										<div id="ratingsStar" class="client_review"></div>
									</div>
								</div>
								
								<div class="bottom_div">
									<p id="reviewDetail">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
								</div>
								<div class="footer_div2">
									<div class="comment_div"><p id="revComment"><img src="<?php echo base_url(); ?>/assets/images/widget/comment_icon.jpg">3 Comments <span>4.0 Our of 5 Stars</span></p></div>
									<div class="liked_icon"><img src="<?php echo base_url(); ?>/assets/images/widget/like_icon.jpg"> <img src="<?php echo base_url(); ?>/assets/images/widget/dislike_icon.jpg"></div>
								</div>
							</div>
						</div><!--left_box--->
					</div>
					
				</div>
			</div>
			
		</div>
		
	</div>
	
	<input type="hidden" id="campaignReviewOffset" value="10">
	<input type="hidden" id="siteReviewOffset" value="10">
	
	
	<div id="addQuestionModal" class="modal fade in">
		<div class="modal-dialog">
			<div class="">
				<form method="post" name="frmSiteReviewSubmit" id="frmQuestionSubmit" container_name="sitereview" action="#"  enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="review_sec">
						<div class="review_chat42" style="margin:0 auto;">
							<div class="head <?php echo $gradientClassReview; ?>">
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
											<img src="<?php echo base_url(); ?>/assets/images/review/drag_icon.png">
											<div class="Drag-Drop-Your-Fil">Drag &amp; Drop Your Files</div>
											<div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
										</span>
									</div>
									<div style="display: none;" id="uploadedQuestionFiles"></div>
									
									
									
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
											<span class="checkmark <?php echo $gradientClassReview; ?>"></span>
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
										<input type="hidden" name="campaign_id" value="<?php echo $oCampaign->id; ?>" />
										<input type="submit" class="sav_con <?php echo $gradientClassReview; ?>" value="Ask question" id="saveQuestionNow">
										
										<div class="right_chck_box">
											<label class="container" for="checkAgree">Agree to our Terms &amp; Conditions
												<input type="checkbox" checked="checked" id="checkAgree" name="two" required="required">
												<span class="checkmark <?php echo $gradientClassReview; ?>"></span>
											</label>
										</div>
									</div>
									
								</div>
								
								<div class="clearfix"></div>
								<div class="star_bottom closeQ"><img src="<?php echo base_url(); ?>assets/images/widget/cross-icon.png"></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="addReviewModal" class="modal fade in">
		<div class="modal-dialog">
			<div class="">
				<div class="review_chat41">
					<div class="head <?php echo $gradientClassReview; ?>">
						<div class="box_right">
							<div class="client_review"> <span class="text-left"><i class="fa fa-angle-left"></i> Add review</span> </div>
						</div>
					</div>
					<div class="second_box">
						<form method="post" name="frmProductReviewSubmit" id="frmProductReviewSubmit" container_name="productreview" action="#"  enctype="multipart/form-data"> 
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="middle">
								<?php
									if(count($productsData) > 0 ) {
										foreach($productsData as $key=>$productData){ ?>
										<div style="<?php echo $key == 0 ? '' : 'margin-top:30px; padding-top:10px; border-top:1px solid #ccc;'; ?>">
											<div class="mt20"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $productData->product_image; ?>" class="" style="width:100%;"></div>
											<div class="clearfix"></div>
											<h2>RATE OUR <?php echo $productData->product_type == 'service' ? 'service' : 'product'; ?></h2>
											<div class="clearfix"></div>
											<div class="rating_box">
												<div class="rating_txt">Rating</div>
												<div class="star_bx starRate">
													<?php 
														for($inc = 1; $inc <= 5; $inc++) {
														?>
														<i data-value='<?php echo $inc; ?>' containerclass="productRatingValue<?php echo $productData->id; ?>" class="fa fa-star fav_gry <?php echo $inc <= $reviewRating?'selected':''; ?>"></i>
														<?php 
														}
													?>
													<div class="rat_num"><?php echo $reviewRating; ?>/5</div>
												</div>
											</div>
											<div class="clearfix"></div>
											
											<h2>REVIEW <?php echo $productData->product_type == 'service' ? 'service' : 'product'; ?></h2>
											<div class="clearfix"></div>
											<div class="much_bx">
												<div class="review_headline">Review Headline</div>
												<div class="very_much"><input name="title[<?php echo $productData->id; ?>]" class="form-control" placeholder="I like it very much!" type="text" required></div>
												<div class="divider"></div>
												<div class="clearfix"></div>
												<div class="tell_you"><textarea name="description[<?php echo $productData->id; ?>]" class="form-control addnote" placeholder="Tell you what you thought of their service..." required></textarea></div>
												<input type="hidden" value="<?php echo $reviewRating; ?>" id="productRatingValue<?php echo $productData->id; ?>" name="ratingValue[<?php echo $productData->id; ?>]">
											</div>
											
											
											<h2>upload photo or video</h2>
											
											<div class="right_max">
												<a href="#">5 media max.</a>
												<a href="#">Video &amp; Images Rules</a>
											</div>
											<div class="clearfix"></div>
											<div class="drag_bx dropzone" id="myDropzone_<?php echo $productData->id; ?>">
												<span class="drop_rate2">
													<img src="<?php echo base_url(); ?>assets/images/review/drag_icon_2.png">
													<div class="Drag-Drop-Your-Fil">Drag &amp; Drop Your Files</div>
													<div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
												</span>
											</div>
											<div style="display: none;" id="uploadedReviewFiles<?php echo $productData->id; ?>"></div>
											
											<div class="<?php if($key > 0){ echo 'hidden'; } ?>">
												<h2>Contact Info</h2>
												<div class="clearfix"></div>
											
												<div class="much_bx name_bx">
													<div class="review_headline full_n_bx">Full name</div>
													<div class="very_much"><input name="fullname[<?php echo $productData->id; ?>]" class="form-control autoFillFN" <?php if($key < 1){ echo 'required="required"'; } ?> value="" type="text"  placeholder="Alen Sultanic"></div>
													<div class="divider"></div>
													<div class="clearfix"></div>
													<div class="review_headline full_n_bx">Email</div>
													<div class="very_much"><input name="emailid[<?php echo $productData->id; ?>]" class="form-control autoFillEmail" <?php if($key < 1){ echo 'required="required"'; } ?> value="" type="text"  placeholder="admin@brandboost.io"></div>
												</div>
												<div class="clearfix"></div>
												
												<div class="chck_box">
													<label class="container">Don't show my name
														<input type="checkbox" value="1" name="display_name[<?php echo $productData->id; ?>]">
														<input type="hidden" value="<?php echo $productData->id; ?>" name="productId[<?php echo $productData->id; ?>]">
														<input type="hidden" value="<?php echo $productData->product_type == 'service' ? 'service' : 'product'; ?>" name="reviewTypeNew[<?php echo $productData->id; ?>]">
														<span class="checkmark <?php echo $gradientClassReview; ?>"></span>
													</label>
												</div>
											</div>
										</div>
									<?php }}else{ ?>
									<h2>RATE OUR product</h2>
									<div class="clearfix"></div>
									<div class="rating_box">
										<div class="rating_txt">Rating</div>
										<div class="star_bx starRate">
											<?php 
												for($inc = 1; $inc <= 5; $inc++) {
												?>
												<i data-value='<?php echo $inc; ?>' containerclass="productRatingValue" class="fa fa-star fav_gry <?php echo $inc <= $reviewRating?'selected':''; ?>"></i>
												<?php 
												}
											?>
											<div class="rat_num"><?php echo $reviewRating; ?>/5</div>
										</div>
									</div>
									<div class="clearfix"></div>
									
									<h2>REVIEW product</h2>
									<div class="clearfix"></div>
									<div class="much_bx">
										<div class="review_headline">Review Headline</div>
										<div class="very_much"><input name="title" class="form-control" placeholder="I like it very much!" type="text" required></div>
										<div class="divider"></div>
										<div class="clearfix"></div>
										<div class="tell_you"><textarea name="description" class="form-control addnote" placeholder="Tell you what you thought of their service..." required></textarea></div>
										<input type="hidden" value="<?php echo $reviewRating; ?>" id="productRatingValue" name="ratingValue">
									</div>
									
									
									<h2>upload photo or video</h2>
									
									<div class="right_max">
										<a href="#">5 media max.</a>
										<a href="#">Video &amp; Images Rules</a>
									</div>
									<div class="clearfix"></div>
									<div class="drag_bx dropzone" id="myDropzone2">
										<span class="drop_rate2">
											<img src="<?php echo base_url(); ?>assets/images/review/drag_icon_2.png">
											<div class="Drag-Drop-Your-Fil">Drag &amp; Drop Your Files</div>
											<div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
										</span>
									</div>
									<div style="display:none;" id="uploadedReviewFiles"></div>
									
									<h2>Contact Info</h2>
									<div class="clearfix"></div>
									
									<div class="much_bx name_bx">
										<div class="review_headline full_n_bx">Full name</div>
										<div class="very_much"><input name="fullname" class="form-control" required="required" value="" type="text"  placeholder="Alen Sultanic"></div>
										<div class="divider"></div>
										<div class="clearfix"></div>
										<div class="review_headline full_n_bx">Email</div>
										<div class="very_much"><input name="emailid" class="form-control" required="required" value="" type="text"  placeholder="admin@brandboost.io"></div>
									</div>
									<div class="clearfix"></div>
									
									<div class="chck_box">
										<label class="container">Don't show my name
											<input type="checkbox" value="1" name="display_name">
											<span class="checkmark <?php echo $gradientClassReview; ?>"></span>
										</label>
									</div>
								<?php } ?>
								
								<div class="term_condition" id="term_condition_review">
									<p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									
									<p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									<p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									
									<p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									<p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									<p>Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
								</div>
								
								<div class="ful_divider"></div>
								<div class="bottom_btn_sec">
									<input type="hidden" name="campaign_id" value="<?php echo $oCampaign->id; ?>" />
									<input type="hidden" name="subID" value="0" />
									<input type="hidden" name="inviterID" value="0" />
									<input type="hidden" name="newReviewPage" value="brandPage" />
									<input type="hidden" value="product" id="reviewType" name="reviewType">
									<input type="hidden" value="0" id="recomendationValue" name="recomendationValue">
									
									<input type="submit" class="sav_con <?php echo $gradientClassReview; ?>" value="Add review">
									
									<div class="right_chck_box">
										<label class="container">Agree to our Terms &amp; Conditions
											<input type="checkbox" id="checkAgree1" checked="checked" name="reviewTCA" required="required">
											<span class="checkmark <?php echo $gradientClassReview; ?>"></span>
										</label>
									</div>
								</div>
								
							</div>
							
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="star_bottom closeR"><img src="<?php echo base_url(); ?>assets/images/widget/cross-icon.png"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="alertMessagePopup" style="z-index: 99999" class="modal fade in">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="message"></div>
				</div>
				<div class="modal-footer">
					<button data-bb-handler="confirm" type="button" class="btn btn-primary confirmOk">OK</button>
				</div>
			</div>
		</div>
	</div>
	
	<div id="thanksPopup" class="modal fade in">
		<div class="modal-dialog">
			<div class="">
				<div class="review_chat49">
					<div class="head <?php echo $gradientClassReview; ?>">
						<div class="box_right">
							<div class="client_review"> <span class="text-left"><i class="fa fa-angle-left"></i> Add review</span> </div>
						</div>
					</div>
					<div class="second_box">
						<div class="middle">
							<div class="main_comment">
								<div class="box_1">
									<img src="<?php echo base_url(); ?>assets/images/widget/heart.png">
									<h1>Thanks for your review!</h1>
									<p>Hi Alen.S! Thanks for purchasing from Brandboost.
										Can a Spare a minute of your time to tell us 
									what you thoought?</p>
									
									<div class="bottom_btn_sec">
										<input type="button" id="pageReload" class="sav_con" value="Back to homepage">
									</div>
								</div><!--box_1--->
							</div><!------>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="star_bottom closeTM"><img src="<?php echo base_url(); ?>assets/images/widget/cross-icon.png"></div>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		
		$(document).ready(function() {
			
			$(document).on('change', '.autoFillFN', function() {
				var name = $(this).val();
				$('.hidden .autoFillFN').each(function(){
					$(this).val(name);
				});
			});
			
			$(document).on('change', '.autoFillEmail', function() {
				var emailAddress = $(this).val();
				$('.hidden .autoFillEmail').each(function(){
					$(this).val(emailAddress);
				});
			});
			
			$('#pageReload').click(function() {
				location.reload();
			});
			
			$(document).on('click', '.commentReview', function() {
				$(this).parent().parent().parent().next().toggle('slow');
			});
			
			$(document).on('click', '.pw_helpful_action', function(e){
				e.preventDefault();
				var actionName = $(this).attr('action-name');
				var reviewId = $(this).attr('review-id');
				
				$.ajax({  
					url:"<?php echo base_url(); ?>company/saveHelpful",  
					method:"POST",  
					data: {action:actionName, review_id:reviewId},
					dataType: "json", 
					success:function(data)  
					{  
						if(data.status == 'ok') {
							$('.review_helpful_'+reviewId).html(data.yes+ ' Found this helpful');
						}
					}
				});
			});
			
			$(document).on('click', '.answer_helpful_action', function(e){
				e.preventDefault();
				var actionName = $(this).attr('action-name');
				var answerID = $(this).attr('answer-id');
				
				$.ajax({  
					url:"<?php echo base_url(); ?>admin/questions/saveHelpful",  
					method:"POST",  
					data: {ha:actionName, answer_id:answerID},
					dataType: "json", 
					success:function(data)  
					{  
						if(data.status == 'ok') {
							$('.answer_helpful_'+answerID).html(data.yes+ ' Found this helpful');
						}
					}
				});
			});
			
			$(document).on('click', '.pw_helpful_action_site', function(e){
				e.preventDefault();
				var actionName = $(this).attr('action-name');
				var reviewId = $(this).attr('review-id');
				$.ajax({  
					url:"<?php echo base_url(); ?>company/saveSiteHelpful",  
					method:"POST",  
					data: {action:actionName, review_id:reviewId},
					dataType: "json", 
					success:function(data)  
					{  
						if(data.status == 'ok') {
							$('.site_review_helpful_'+reviewId).html(data.yes+ ' Found this helpful');
						}
					}
				});
			});
			
			
			$('.cmtformsubmit').on('submit', function(e){  
				e.preventDefault(); 
				
				var revId = $(this).attr('revId');
				$('#overlay-'+revId).removeClass('hidden');
				$.ajax({  
					url:"<?php echo base_url(); ?>company/saveComment", 
					method:"POST",  
					data:new FormData(this),  
					contentType: false,  
					cache: false,  
					processData:false, 
					dataType: "json", 
					success:function(data)  
					{  
						$("input.cmtname, input.cmtemail, textarea.cmt").val("");
						if(data.status == "ok")
						{
							$('#overlay-'+revId).addClass('hidden');
							$('#success-'+data.rid).removeClass('hidden');
							setTimeout(function(){ 
								$('#success-'+data.rid).addClass('hidden'); 
							}, 5000);
						}
						if(data.status == "error")
						{
							$('#overlay-'+revId).addClass('hidden');
							$('#error-'+data.rid).removeClass('hidden');
							setTimeout(function(){ 
								$('#error-'+data.rid).addClass('hidden'); 
								
							}, 5000);
						}
						else{
							//alert("Something went wrong");
						}
					}  
				});  
				
				return false;
				
			});
			
			$(document).on('click', '.siteContact', function() {
				var site = $(this).attr('site');
				if(site != '') {
					window.open(site);
				}
			});
			
			$(document).on('click', '.mediaLargImage', function() {
				
				var revId = $(this).attr('revId');
				var fullname = $('.fullname'+revId).val();
				var revImage = $(this).children().attr('src');
				var revAvatar = $(this).attr('revAvatar');
				var revStar = $('.brand_page_pr').find('.startRate'+revId).html();
				var revComment = $('.brand_page_pr').find('.revComment'+revId).html();
				var review = $('.review'+revId).val();
				
				
				$('#mFullName').html(fullname);
				$('#mReviewImage').attr('src', revImage);
				$('#mReviewAvatar').attr('src', revAvatar);
				$('#ratingsStar').html(revStar);
				$('#reviewDetail').html(review);
				$('#revComment').html(revComment);
				$('#myModal').modal();
			});
			
			$(document).on('click', '.close', function() {
				$('#myModal').modal('hide');
			});
			
			$(document).on('click', '.closeQ', function() {
				$('#addQuestionModal').modal('hide');
			});
			
			$(document).on('click', '.closeR', function() {
				$('#addReviewModal').modal('hide');
			});
			
			$(document).on('click', '.closeTM', function() {
				$('#thanksPopup').modal('hide');
			});
			
			$(document).on('click', '.addQuestion', function() {
				$('#addQuestionModal').modal();
			});
			
			$(document).on('click', '.addReview', function() {
				$('#addReviewModal').modal();
			});
			
			$(document).on('click', '.readMore', function() {
				$(this).parent().addClass('hidden');
				$(this).parent().next().removeClass('hidden');
			});
			
			$(document).on('click', '.readLess', function() {
				$(this).parent().addClass('hidden');
				$(this).parent().prev().removeClass('hidden');
			});
			
			$(document).on('click', '.tabColor', function() {
				$('.tabColor').removeClass('textSolidColor');
				$(this).addClass('textSolidColor');
			});
			
			/*$(window).scroll(function() {
				
				if($(window).scrollTop() == $(document).height() - $(window).height()) {
				
				console.log('testing');
				var siteReviewOffset = $('#siteReviewOffset').val(); 
				var campaignReviewOffset = $('#campaignReviewOffset').val();
				$('.siteReviewLoader').removeClass('hidden');
				$('.campaignReviewLoader').removeClass('hidden');
				$.ajax({  
				url:"<?php echo base_url(); ?>campaign/loadSiteReview",  
				method:"POST",  
				data:{offsite:siteReviewOffset, limit:5, campaignId: <?php echo $campaignId; ?>},  
				dataType: "html", 
				success:function(data)  
				{  
				$('.siteReviewLoader').addClass('hidden');
				if(data != '') {
				$('.appendSiteReview').append(data);
				var newSiteReviewOffset = Number (siteReviewOffset) + 5;
				$('#siteReviewOffset').val(newSiteReviewOffset);
				}
				else {
				$('.siteReviewLoader').remove();
				}
				}  
				});  
				
				$.ajax({  
				url:"<?php echo base_url(); ?>campaign/loadCampaignReview",  
				method:"POST",  
				data:{offsite:campaignReviewOffset, limit:5, campaignId: <?php echo $campaignId; ?>},  
				dataType: "html", 
				success:function(data)  
				{  
				$('.campaignReviewLoader').addClass('hidden');
				if(data != '') {
				$('.appendCampaignReview').append(data);
				var newCampaignReviewOffset = Number (campaignReviewOffset) + 5;
				$('#campaignReviewOffset').val(newCampaignReviewOffset);
				}
				else {
				$('.campaignReviewLoader').remove();
				}
				}  
				});  
				
				return false;
				}
			});*/
			
		});
	</script>
	
	<script type="text/javascript">
		
		$(document).ready(function () {
			
			$("#checkAgree").click(function () {
				if ($(this).is(":checked")) {
					$("#term_condition").show();
					} else {
					$("#term_condition").hide();
				}
				
			});
			
			$("#checkAgree1").click(function () {
				if ($(this).is(":checked")) {
					$("#term_condition_review").show();
					} else {
					$("#term_condition_review").hide();
				}
				
			});
			
			
			setTimeout(function () {
				$('.dz-default').hide();
			}, 10);
			
			
			$("#frmQuestionSubmit").submit(function () {
				$("#saveQuestionNow").attr("disabled", "disabled");
				var formdata = new FormData(this);
				$.ajax({
					url: "<?php echo base_url('admin/questions/saveNewQuestion'); ?>",
					type: "POST",
					data: formdata,
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					success: function (response) {
						if (response.status == 'ok') {
							$('#addQuestionModal').modal('hide');
							alertMessageAndRedirect(response.msg, window.location.href);
							} else {
							$("#saveQuestionNow").removeAttr("disabled");
							alertMessage(response.msg);
						}
					},
					error: function (response) {
						alertMessage(response.msg);
					}
				});
				return false;
			});
			
			$("#frmProductReviewSubmit").submit(function () {
				var formdata = new FormData(this);
				$('.overlaynew').show();
				$.ajax({
					url: "<?php echo base_url('reviews/saveNewReview'); ?>",
					type: "POST",
					data: formdata,
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					success: function (response) {
						if (response.status == 'success') {
							
							$('#addReviewModal').modal('hide');
							$('#thanksPopup').modal();
							//alertMessage(response.msg);
							$('.overlaynew').hide();
							} else {
							$('.overlaynew').hide();
							//alertMessage(response.msg);
						}
					},
					error: function (response) {
						$('.overlaynew').hide();
						//alertMessage(response.msg);
					}
				});
				return false;
			});
			
		});
		
		var redirectURL = '';
		
		function alertMessage(message) {
			$("#alertMessagePopup").modal();
			$('.message').html(message);
		}
		
		function alertMessageAndRedirect(message, urlRedirect) {
			$("#alertMessagePopup").modal();
			$('.message').html(message);
			redirectURL = urlRedirect;
		}
		
		$(document).ready(function () {
			$(".confirmOk").click(function () {
				$("#alertMessagePopup").modal('hide');
				if (redirectURL != '') {
					setTimeout(function () {
						window.location.href;
					}, 1000);
				}
			});
			
			
			//Display Ratings etc
			var ratingValue = 0;
			$('.starRate i').on('mouseover', function () {
				var onStar = parseInt($(this).data('value'), 10);
				$(this).parent().children('i').each(function (e) {
					if (e < onStar) {
						$(this).removeClass('fav_gry');
						$(this).addClass('fav_yello');
						} else {
						$(this).addClass('fav_gry');
						$(this).removeClass('fav_yello');
					}
				});
				
				}).on('mouseout', function () {
				$(this).parent().children('i').each(function (e) {
					$(this).removeClass('fav_yello');
					$(this).addClass('fav_gry');
				});
			});
			
			
			$('.starRate i').on('click', function () {
				var valContainer = $(this).attr('containerclass');
				var onStar = parseInt($(this).data('value'), 10);
				$(this).parent().find('div.rat_num').html(onStar+'/5');
				var stars = $(this).parent().children('i');
				for (i = 0; i < stars.length; i++) {
					$(stars[i]).removeClass('selected');
				}
				
				for (i = 0; i < onStar; i++) {
					$(stars[i]).addClass('selected');
				}
				
				ratingValue = $(this).attr("data-value");
				$('#' + valContainer).val(ratingValue);
			});
			
			/*
			$('.drop_rate').click(function() {
				$('#myDropzone').trigger('click');
			});
			
			$('.drop_rate2').click(function() {
				$('#myDropzone2').trigger('click');
			});*/
		});
	</script>
</body>
</html>						