<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); ?>
<?php $colorOrientation = $widgetData->color_orientation == '' ? '45deg' : $widgetData->color_orientation; ?>

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




<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/color/spectrum.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/picker_color.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/touchspin.min.js"></script>

<style type="text/css">
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:83px!important; height:83px!important; opacity: 0!important;}
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
	
</style>

<style>
	.highcharts-tick{stroke:none!important}
	.highcharts-legend, .highcharts-credits{display: none!important;}
	.highcharts-container, .highcharts-container svg {width: 100% !important;}
	#canvas, #canvas2{height: 250px!important;}
	.panel-heading .nav-tabs > li.active > a, .panel-heading .nav-tabs > li.active > a:hover, .panel-heading .nav-tabs > li.active > a:focus {color: #7f62df;}
	
	.form-control::placeholder {color: #09204f;	opacity: 1; font-weight: 500; font-size: 14px}
	.widgsetting{width: 100%;  height: 52px;  border-radius: 5px;  box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.04);  background-color: #fff; border: 1px solid #dfe5f0; line-height: 48px; color: #09204f;	opacity: 1; font-weight: 500; font-size: 14px}
	.widgsetting .form-control{border: none!important; box-shadow: none!important; height: 35px; margin-top: 10px; padding: 7px 0!important;}
	.configurations .form-control{color: #09204f;	opacity: 1; font-weight: 500; font-size: 14px}
	
	.bootstrap-touchspin .input-group-btn-vertical > .btn {height: 20px !important;	width: 28px; margin: 0; padding: 0px!important; border: none!important; background: none!important;}
	.bootstrap-touchspin .input-group-btn-vertical i {font-size: 20px !important; margin-left: -10px!important; margin-top: -10px!important; color: #98adcf!important;}
	
	.mt8{margin-top:8px;}
	
</style>

<style type="text/css">
    .bbpw_comment_box { width: auto; }
    .bbpw_comment_box {
	padding: 10px 20px 20px;
	float: left;
	box-sizing: border-box;
	color: #999;
	border-radius: 5px;
	margin: 17px 0 10px;
	box-shadow: 0px 0px 2px 0px rgba(0, 0, 0, 0.2);
	
    }
    .bbpw_comment_box .bb_comment_row {
	border-bottom: dotted #ccc 1px;
	padding: 5px;
    }
    .bbpw_comment_box .comment_form .form-control {
	width: 100%;
	box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);
	font-size: 12px;
	padding: 5px;
	border-radius: 2px;
	border: solid 1px #e3e9f3;
	color: #768fbf;
	
	height: auto;
    }
    .bbpw_comment_box .comment_form .form-group{
	margin-bottom: 0px !important;
    }
    .bbpw_comment_box .comment_form .form-control.addnote {
	width: 100%;
	height: 60px;
	resize: none;
	box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);
	font-size: 12px;    font-family: 'BwNista Geo';
    }
    .bbpw_comment_box a {
	color: #2160c5;
    }
    .bbpw_comment_box .comment_form {
	float: left;
	width: 100%;
	margin-top: 7px;
	box-sizing: border-box;
	box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);
	border: solid 1px #e3e9f3;
	padding: 8px 2px;
	border-radius: 5px;
    }
    .bbpw_comment_box .comment_form .form-group {
	float: left;
	width: 50%;
	padding: 0 5px;
	box-sizing: border-box;
    }
    .bbpw_comment_box .comment_form .panel-body.br0 {
	float: left;
	width: 100%;
	padding: 0 6px;
	box-sizing: border-box;
	margin-top: 5px;
    }
    .bbpw_comment_box .s_comment {
	padding: 7px 5px 0;
	float: right;
    }
    .bbpw_comment_box .comment_form .panel-body.br0 {
	float: left;
	width: 100%;
	padding: 0 6px;
	box-sizing: border-box;
	margin-top: 5px;
    }
    .bbpw_comment_box .s_comment button {
	float: right;
	background: linear-gradient(40deg, #1c9ffc, #2160c5);
	padding: 8px 10px;
	border-radius: 5px;
	color: #fff;
	text-decoration: none;
	font-size: 11px;
	border: none;
    }
    .review_widget a.link_small{font-size:12px!important;}
    .wid_review_btn{width: 120.6px;right: -73px;}
    .topbar .headerBlue{font-weight: 500; font-size:14px;}
    .wid_review_btn{padding: 0; text-align: center;}
    .wid_review_btn  .icon-star-full2 {margin-left: 10px;color: #fff; font-size: 12px;}
	
	.tablet_box{width: 680px;    border-radius: 14.4px;  box-shadow: 0 2.2px 4.4px 0 rgba(1, 21, 64, 0.04);  border: solid 1.1px #ebeff6;  background-color: #fff; padding: 14px; position: relative; margin: 0 auto; transform: scale(0.9);} 	
	.tablet_box .tablet_box_bkg{  border-radius: 4.4px; height: 856px;   border: solid 1.1px #f4f6fa;   background-image: linear-gradient(150deg, #ffffff, #eff2f7);}
	.tablet_box .tablet_box_bkg .bb_rw01{ transform: scale(0.8); bottom: -25px;right: 0;}
			
	.mobile_box{width: 425px;    border-radius: 45px;  box-shadow: 0 2.2px 4.4px 0 rgba(1, 21, 64, 0.04);  border: solid 1.1px #ebeff6;  background-color: #fff; padding: 14px; position: relative; margin: 0 auto; transform: scale(0.8);} 	
	.mobile_box .mobile_box_bkg{  border-radius: 34px; height: 870px;   border: solid 1.1px #f4f6fa;   background-image: linear-gradient(150deg, #ffffff, #eff2f7);}
	
	/*################## WIDGET 05 #################*/	
	.bb_fleft{float: left;}
	.bb_fright{float: right;}
	.bb_clear{clear: both;}	
	.bb_pad5{padding: 5px!important;}
	.bb_pad10{padding: 10px!important;}
	.bb_pad15{padding: 15px!important;}
	.bb_pad20{padding: 20px!important;}
	.bb_pad25{padding: 25px!important;}
	.bb_pad30{padding: 30px!important;}
	.bb_txt_yellow{color: #ffcb65}
	.bb_txt_grey{color: #c1cfe3!important}
	.bb_txt_green{color: #29c178!important}
	.bb_txt_red{color: #e44f64!important}
	.bb_txt_blue{color: #127bfb!important}
	.bb_btop{border-top: 1px solid #f4f6fa;}
	.bb_bbot{border-bottom: 1px solid #f4f6fa;}
	.bb_br5{border-radius: 5px;}
	.bb_hr{display: block;  border-color: #fbfcfd; height: 0px; margin: 5px 0!important; background: none!important; opacity: 0.2}
	.bb_dot{margin: 0 8px; color: #dfdfef;  }
	.bb_dot .fa{font-size: 3px!important; margin: 0!important}
	.bb_para{line-height: 1.64!important; margin: 0 0 3px!important;}
	.bb_para strong{font-weight: 500!important}
	.bb_para.heading_txt {	font-weight: 500 !important;font-size: 14px;margin-bottom: 12px !important;}
	
	.bb_thingrey{font-size: 12px; font-weight: 400!important; color: #5e729d}
	.bb_text_right{text-align: right;}
	.bb_check_green {	position: absolute;	color: #29c178;	bottom: 0;	right: -8px;	background: #fff;	padding: 2px;	border-radius: 50px;}
	.bb_white_box{box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06); box-sizing: border-box; border-radius: 6px; margin-bottom: 4px!important; background: #fff; position: relative;}
	.bb_submit_button_white{ background: #fff; border-radius: 100px 0 100px 100px!important; width: 60px;  height: 60px;  box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06); text-align: center; line-height: 60px; display: block; margin-top: 8px!important;}
	.bb_submit_button_blue{ background-image: linear-gradient(to top, #117bfb, #34aaff); border-radius: 100px 0 100px 100px; width: 60px;  height: 60px;  box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06); text-align: center; line-height: 60px; margin-top: 8px!important;}
	.bb_border{border: 1px solid #eee;}
	.bb_pagination{padding: 15px; text-align: center; }
	.bb_pagination ul.bbpagination_list {margin: 0; padding: 0;}
	.bb_pagination ul.bbpagination_list li{list-style: none; margin: 0; padding: 0; display: inline-block}
	.bb_pagination ul.bbpagination_list li a{margin: 0; display: inline-block; font-size: 12px; color: #425784; font-weight: 500; text-decoration: none; padding:8px 12px; border: 1px solid #fff; border-radius: 4px;}
	.bb_pagination ul.bbpagination_list li a.bbactive{border: 1px solid #eee; color: #127bfb}
	.bbDarkButton.bb_submit_button_blue{ background-image: linear-gradient(to top, #117bfb, #34aaff)!important; }
	
	a.bb_txt_blue{text-decoration: none; /*border-bottom: 1px solid #eee!important;*/ padding-bottom: 2px; display: inline-block;}
	
	span.icons.fl_letters {
	width: 32px;
	height: 32px;
	box-shadow: none !important;
	background: #6190fa;
	text-align: center;
	text-transform: uppercase;
	line-height: 32px;
	color: #fff;
	border-radius: 100px;
	font-size: 12px;
	font-weight: 500;
	display: inline-block;
	background-image: linear-gradient(79deg, #5869eb, #6190fa) !important;
	}
	
	.bb_rw01 .bb_button_widget_rb{height:328px!important; overflow-y:hidden;}
	.bb_rw01 .review_main_box{height:320px; overflow-y:hidden;}
	.bb_rw05 .bb_feed_widget_rb{height:750px; overflow-y:hidden;}
	.bb_rw02 .review_main_box{height:520px; overflow-y:hidden;}
	.review_main_box:hover, .bb_feed_widget_rb:hover, .bb_button_widget_rb:hover{overflow-y:auto;}
	
	
	
	.bb_top_button_powered {width: 216px;  height: 48px;  box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.04);  background-color: #fff; border: 1px solid #f4f6fa; text-align: center; border-radius: 5px; display: inline-block; line-height: 49px; float: left; margin:0 0 10px 5px;}
	.bb_top_button_powered a {text-decoration: none !important; font-size: 13px; color: #09204f; float: left; display: block; width: 100%; text-align: left; font-weight: 400; line-height: 43px!important;}
	.bb_top_button_powered a img{float: left; width: 11px; height: 16px; margin: 15px 10px 0 13px !important}
	
	
	.bb_rw05 { width: 100%; position:absolute; bottom: 20px; border-radius: 0px; font-family: 'BwNista Geo'; font-size: 13px; color: #09204f; box-sizing: border-box; padding: 20px; background:#fff;}
	.bb_rw05 .bb_white_box{box-shadow: none!important; border-top: 1px solid #f4f6fa; margin-top: 30px; padding:20px;}
	.bb_rw05 .bbtop_sec{padding: 40px 0;}
	.bb_rw05 .bb_feed_widget_rb{margin-top: 5px;}
	.bb_rw05 .bb_rating_sec{float: left; width: 170px; border-right: 1px solid #f4f6fa; padding-right: 0px; box-sizing: border-box; height: 80px; margin-right: 30px;}
	.bb_rw05 .bb_rating_sec h3{font-size: 20px; color: #080d2e; margin: 0 0 7px; font-weight: 600}
	.bb_rw05 .bb_rating_sec h3 span{font-size: 13px; color: #72739c; margin: 0; font-weight: 400!important}
	.bb_rw05 .bb_rating_sec .fa{font-size: 18px; margin-right: 7px;}
	.bb_rw05 .bb_rating_sec h4{font-size: 13px; color: #080d2e; margin: 5px 0 0px; padding-bottom: 3px; font-weight: 500; /*border-bottom: 1px solid #f4f6fa;*/ float: left;}
	.bb_rw05 .bb_progress_bar_sec{width: 224px; float: left;}
	.bb_rw05 .bb_small_smile{width: 25px; float: left;}
	.bb_rw05 .bb_progress{width: 177px; float: left; margin-top: 4.2px;}
	.bb_rw05 .bb_progress_grey{width: 177px;  height: 6px;  border-radius: 2px;  background-color: #ebeff6;}
	.bb_rw05 .bb_progress_status.green{background: #61ce9a; height: 6px; border-radius: 2px;}
	.bb_rw05 .bb_progress_status.grey{background: #9b9dc0; height: 6px; border-radius: 2px;}
	.bb_rw05 .bb_progress_status.red{background: #e68495; height: 6px; border-radius: 2px;}
	.bb_rw05 .width85{width: 85%;}
	.bb_rw05 .width55{width: 55%;}
	.bb_rw05 .width35{width: 35%;}
	.bb_rw05 .width15{width: 15%;}
	.bb_rw05 .width5{width: 5%;}
	.bb_rw05 .bb_button_area{ padding: 0px; width: 450px; float: right;}
	.bb_rw05 .bb_button_area .bb_btn{width: 220px;  height: 44px;  border-radius: 5px;  box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08);  background-color: #fff; font-size: 13px; color: #09204f; font-weight: 500; display: inline-block; text-align: center; line-height: 28px; background: #fff; border: 1px solid #f4f6fa; padding: 7px; box-sizing: border-box; font-family: 'BwNista Geo'; cursor: pointer}
	.bb_rw05 .bb_tab_box{padding: 20px 0px; /*background: #ffffff;*/ border-top: 1px solid #f4f6fa ; border-bottom: 1px solid #f4f6fa ;   }
	.bb_rw05 .bb_tab_box ul{margin: 0; padding: 0;}
	.bb_rw05 .bb_tab_box ul li{margin: 0; padding: 0; display: inline-block; list-style: none;}
	.bb_rw05 .bb_tab_box ul li a{margin: 0; padding: 0 10px 0px 0; text-decoration: none;display: inline-block; font-size: 13px; color: #5e729d}
	.bb_rw05 .bb_tab_box ul li a.active{font-weight: 500; color: #127bfb}
	.bb_rw05 .text_section{padding: 15px 0 10px!important; max-width: 675px;}
	.bb_rw05 .bb_comment_image{margin: 15px 0;}
	.bb_rw05 .bb_img_enlagre {	width: 118px;	height: 76px;	border-radius: 5px; margin-right: 20px; margin-top: 5px; border: 1px solid #eee; }
	
	.bb_image_pagination{margin: 5px 0 0 0; padding: 0;}
	.bb_image_pagination li{margin: 0; padding: 0; list-style: none; display: inline-block;}
	.bb_image_pagination li a{margin: 0; padding: 0; display: inline-block;}
	.bb_image_pagination li a img{width: 37px!important; height: 29px!important; border-radius: 3px; opacity: 0.7}
	.bb_image_pagination li a.bb_active img{opacity: 1}
	
	
	.bb_rw05 .box_1{padding: 30px 0; border-bottom: 1px solid #f4f6fa; }
	.bb_rw05 .bb_comment_header {padding: 0 0 15px 0; border-bottom: 1px solid #f4f6fa; max-width: 100%;}
	.bb_rw05 .bb_comment_header .bb_avatar01{float: left; position: relative; width: 36px; height: 36px; margin-right: 15px; }
	.bb_rw05 .bb_comment_header .bb_avatar01 img{width: 36px; height: 36px; border-radius: 100px;}
	.bb_rw05 .bb_comment_header p{line-height: 20px!important;}
	.bb_rw05 .bb_comment_header .fa{margin: 0 5px 0 0; font-size: 13px;}
	.bb_rw05 .bb_comment_area{padding: 0px 0px 0px; color: #5e729d; font-size: 12px;}
	.bb_rw05 .bb_comment_area a{color: #5e729d; font-size: 12px; text-decoration: none; display: inline-block; margin-right: 15px;}
	.bb_rw05 .bb_comment_area a.bbactive{color: #127bfb; font-weight: 500;}
	/*.bb_rw05 .bb_comment_area a.bb_like_dislike{border: 1px solid #eee; width: 22px; height: 22px; border-radius: 3px; text-align: center; line-height: 22px; vertical-align: middle; }*/
	.bb_rw05 .bb_comment_area a.bb_like_dislike {	border: 1px solid #eee;	/* width: 22px; */	/* height: 22px; */	border-radius: 3px;	text-align: center;	/* line-height: 22px; */	vertical-align: middle;
	padding: 4px 5px;	box-sizing: border-box;}
	.bb_rw05 .bb_comment_area a.bb_share_btn{margin: 5px 0 0 0!important}
	.bb_rw05 .bb_comment_area a i img{float: left; margin-top: 2px;}
	.bb_rw05 .bb_comment_reply_sec{padding:0px; min-height: 150px; margin-top: 20px; }
	.bb_rw05 .bb_comment_reply_sec .bb_inner_reply{border-top: 1px solid #f4f6fa ; padding: 20px 0}
	.bb_rw05 .bb_comment_header_small {padding: 0 0 0px 0; line-height: 28px;}
	.bb_rw05 .bb_comment_header_small .bb_avatar_small{float: left; position: relative; width: 28px; height: 28px; margin-right: 15px; }
	.bb_rw05 .bb_comment_header_small .bb_avatar_small img{width: 28px; height: 28px; border-radius: 100px; box-shadow: inset 0 1px 2px 0 rgba(0, 0, 0, 0.2);}
	.bb_rw05 .bb_comment_header_small p.bb_para{font-size: 12px; margin-top: 5px;}
	.bb_rw05 .text_section_reply {padding: 5px 0 10px 45px!important; max-width: 675px;  box-sizing: border-box;}
	.bb_rw05 .text_section_reply p.bb_para{font-size: 13px; color: #353965;}
	.bb_rw05 .bb_comment_area_reply{padding: 10px 0px 0px 45px; color: #b0b0cd; font-size: 12px;}
	.bb_rw05 .bb_comment_area_reply a{color: #b0b0cd; font-size: 12px; text-decoration: none; display: inline-block; margin-right: 15px;}
	.bb_rw05 .bb_close {position: absolute;	cursor: pointer;width: 40px;height: 40px;border-radius: 6px; background-color: #fff;	top: 0;	right: -55px;color: #b4c4dc;font-size: 18px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); font-weight: 600!important; border: 1px solid #f4f6fa;}
	.bb_rw05 .bb_top_button_powered {width: 216px;  height: 44px;  box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.04);  background-color: #fff; border: 1px solid #f4f6fa; text-align: center; border-radius: 5px; display: inline-block; line-height: 41px; float: right;}
	
	
	/*################## WIDGET 01 #################*/		
	.bb_rw01 {width: 360px;  position: absolute; bottom: 30px; right: 30px; border-radius: 6px; font-family: 'BwNista Geo'; font-size: 13px; color: #09204f; box-sizing: border-box;}
	.bb_rw01 .bb_pr_header01 img{width: 75px; height: 75px; margin-right: 15px; vertical-align: top;}
	.bb_rw01 .bb_pr_header01 h3{margin: 0 0 10px 0; font-size: 14px; font-weight: 500;  line-height: 1.35;}
	.bb_rw01 .bb_pr_header01 p{margin: 8px 0 0 0; font-size: 13px; font-weight: 500;  line-height: 1.14;}
	.bb_rw01 .bb_pr_header01 .fa{margin: 0 5px 0 0; font-size: 15px;}
	.bb_rw01 .bb_comment_header {padding: 15px; border-bottom: 1px solid #f4f6fa;}
	.bb_rw01 .bb_comment_header .bb_avatar01{float: left; position: relative; width: 36px; height: 36px; margin-right: 15px; }
	.bb_rw01 .bb_comment_header .bb_avatar01 img{width: 36px; height: 36px; border-radius: 100px;}
	.bb_rw01 .bb_comment_header p{line-height: 20px!important;}
	.bb_rw01 .bb_comment_header .fa{margin: 0 5px 0 0; font-size: 13px;}
	.bb_rw01 .bb_comment_area{padding: 0px 20px 20px; color: #5e729d; font-size: 12px;}
	.bb_rw01 .bb_comment_area a{color: #5e729d; font-size: 12px; text-decoration: none; display: inline-block; margin-right: 10px;}
	.bb_rw01 .bb_comment_area a i img{float: left; margin-top: 2px;}
	.bb_rw01 .bb_comment_area a.bb_like_dislike{border: 1px solid #eee; width: 22px; height: 22px; border-radius: 3px; text-align: center; line-height: 22px;}
	.bb_rw01 .bb_submit{padding: 10px 25px; margin-top: 8px!important}
	.bb_rw01 .bb_submit input[type=text]{height: 30px; width: 280px; background: #fff; border: none!important; font-size: 13px; color: #5e729d; font-family: 'BwNista Geo'; font-weight: 400;}
	.bb_rw01 .bb_submit input[type=button]{width: 21px; height: 12px; border: none; background:url(../../assets/images/widget/submit_arrow.png) center center no-repeat; margin-top: 9px;}
	.bb_rw01 .bb_small_image_sec{ float: left; margin-right: 15px;}
	.bb_rw01 .bb_small_image_sec img{border-radius: 5px; margin-top: 5px; width: 90px; height: 60px;}
	.bb_rw01 .bb_submit_button_blue{display:block;}
	.bb_rw01 .bb_close {
	position: absolute;
	cursor: pointer;
	width: 40px;
	height: 40px;
	border-radius: 6px;
	border: none;
	background-color: #fff;
	top: 0;
	right: -55px;
	color: #b4c4dc;
	font-size: 18px;
	box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08);
	font-weight: 600 !important;
	}
	
	/*################## WIDGET 02 #################*/		
	.bb_rw02 {width: 520px; min-height:770px; position: absolute; top: 50%; left: 50%; margin-left: -260px; margin-top: -400px; border-radius: 6px; font-family: 'BwNista Geo'; font-size: 13px; color: #09204f; box-sizing: border-box;}
	.bb_rw02 .bb_rating_sec{float: left; width: 50%; border-right: 1px solid #f4f6fa; padding-right: 30px; box-sizing: border-box; height: 80px; margin-bottom: 30px;}
	.bb_rw02 .bb_rating_sec h3{font-size: 20px; color: #080d2e; margin: 0 0 7px; font-weight: 600}
	.bb_rw02 .bb_rating_sec h3 span{font-size: 13px; color: #72739c; margin: 0; font-weight: 400!important}
	.bb_rw02 .bb_rating_sec .fa{font-size: 18px; margin-right: 7px;}
	.bb_rw02 .bb_rating_sec h4{font-size: 13px; color: #080d2e; margin: 5px 0 0px; padding-bottom: 3px; font-weight: 500; /*border-bottom: 1px solid #f4f6fa; */ float: left;}
	.bb_rw02 .bb_progress_bar_sec{width: 45%; float: right;}
	.bb_rw02 .bb_small_smile{width: 25px; float: left;}
	.bb_rw02 .bb_progress{width: 177px; float: left; margin-top: 4.2px;}
	.bb_rw02 .bb_progress_grey{width: 177px;  height: 6px;  border-radius: 2px;  background-color: #ebeff6;}
	.bb_rw02 .bb_progress_status.green{background: #61ce9a; height: 6px; border-radius: 2px;}
	.bb_rw02 .bb_progress_status.grey{background: #9b9dc0; height: 6px; border-radius: 2px;}
	.bb_rw02 .bb_progress_status.red{background: #e68495; height: 6px; border-radius: 2px;}
	.bb_rw02 .width85{width: 85%;}
	.bb_rw02 .width55{width: 55%;}
	.bb_rw02 .width35{width: 35%;}
	.bb_rw02 .width15{width: 15%;}
	.bb_rw02 .width5{width: 5%;}
	.bb_rw02 .bb_button_area{ padding: 0px; }
	.bb_rw02 .bb_button_area .bb_btn{width: 220px;  height: 44px;  border-radius: 5px;  box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08);  background-color: #fff; font-size: 13px; color: #09204f; font-weight: 500; display: inline-block; text-align: center; line-height: 28px; background: #fff; border: 1px solid #f4f6fa; padding: 7px; box-sizing: border-box; font-family: 'BwNista Geo'; cursor: pointer}
	.bb_rw02 .bb_tab_box{padding: 15px 30px; /*background: #fdfefe;*/ border-top: 1px solid #f4f6fa ; border-bottom: 1px solid #f4f6fa ;   }
	.bb_rw02 .bb_tab_box ul{margin: 0; padding: 0;}
	.bb_rw02 .bb_tab_box ul li{margin: 0; padding: 0; display: inline-block; list-style: none;}
	.bb_rw02 .bb_tab_box ul li a{margin: 0; padding: 0 10px 0px 0; text-decoration: none;display: inline-block; font-size: 13px; color: #5e729d}
	.bb_rw02 .bb_tab_box ul li a.active{font-weight: 500; color: #127bfb}
	.bb_rw02 .bb_comment_header {padding: 0 0 15px 0; border-bottom: 1px solid #f4f6fa;}
	.bb_rw02 .bb_comment_header .bb_avatar01{float: left; position: relative; width: 36px; height: 36px; margin-right: 15px; }
	.bb_rw02 .bb_comment_header .bb_avatar01 img{width: 36px; height: 36px; border-radius: 100px;}
	.bb_rw02 .bb_comment_header p{line-height: 20px!important;}
	.bb_rw02 .bb_comment_header .fa{margin: 0 5px 0 0; font-size: 13px;}
	.bb_rw02 .bb_comment_area{padding: 0px 0px 0px; color: #5e729d; font-size: 12px;}
	.bb_rw02 .bb_comment_area a{color: #5e729d; font-size: 12px; text-decoration: none; display: inline-block; margin-right: 15px;}
	.bb_rw02 .bb_comment_area a.bb_like_dislike{border: 1px solid #eee; width: 22px; height: 22px; border-radius: 3px; text-align: center; line-height: 22px;}
	.bb_rw02 .bb_comment_area a.bb_share_btn{margin: 5px 0 0 0!important}
	.bb_rw02 .bb_comment_area a i img{float: left; margin-top: 2px;}
	.bb_rw02 .text_section{padding: 15px 0 10px!important;}
	.bb_rw02 .bb_close {position: absolute;	cursor: pointer;width: 40px;height: 40px;border-radius: 6px;border:none;	background-color: #fff;	top: 0;	right: -55px;color: #b4c4dc;font-size: 18px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); font-weight: 600!important;}
	.bb_rw02 .bb_small_image_sec{ float: left; margin-right: 15px;}
	.bb_rw02 .bb_small_image_sec img{border-radius: 5px; margin-top: 5px; width: 90px; height: 60px;}
	
	
	/*################## WIDGET 03 #################*/		
	.bb_rw03 {width: 100%;  position: absolute; bottom: 0; left: 0;  border-radius: 6px; font-family: 'BwNista Geo'; font-size: 13px; color: #09204f; box-sizing: border-box;}
	.bb_rw03 .bb_top_header_sec{ margin: 0; padding: 25px 25px 15px; border-bottom: 1px solid #f4f6fa; min-height: 72px; box-sizing: border-box;}
	.bb_rw03 .bb_rating_sec{float: left;  box-sizing: border-box; }
	.bb_rw03 .bb_rating_sec h3{font-size: 16px; color: #080d2e; margin: 0 0 0px; font-weight: 600; display: inline-block; margin-right: 10px;}
	.bb_rw03 .bb_rating_sec h3 span{font-size: 13px; color: #72739c; margin: 0; font-weight: 400!important}
	.bb_rw03 .bb_rating_sec p.bb_para{display: inline-block; margin-right: 10px;}
	.bb_rw03 .bb_rating_sec .fa{font-size: 18px; margin-right: 7px;}
	.bb_rw03 .bb_rating_sec h4{font-size: 13px; color: #080d2e; margin:0px; font-weight: 500; /*border-bottom: 1px solid #f4f6fa;*/ display: inline-block; margin-right: 10px;}
	.bb_rw03 .bb_button_area{ padding: 0px; }
	.bb_rw03 .bb_button_area .bb_btn{width:auto;  box-shadow: none;  background-color: #fff; font-size: 13px; color: #09204f; font-weight: 500; display: inline-block; text-align: center; line-height: 28px; background: #fff; border:none; padding:2px 20px!important; border-radius:5px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); box-sizing: border-box; font-family: 'BwNista Geo'; cursor: pointer; border: 1px solid #f4f6fa; margin: 0 0 0 20px;}
	.bb_rw03 .bb_small_comment_box{width: 33.33%; float: left; /*background: #fff;*/ border-right: 1px solid #f4f6fa; padding: 25px; box-sizing: border-box; min-height: 290px; position: relative; }
	.bb_rw03 .bb_comment_header {padding: 0 0 15px 0; border-bottom: 1px solid #f4f6fa;}
	.bb_rw03 .bb_comment_header .bb_avatar01{float: left; position: relative; width: 36px; height: 36px; margin-right: 15px; }
	.bb_rw03 .bb_comment_header .bb_avatar01 img{width: 36px; height: 36px; border-radius: 100px;}
	.bb_rw03 .bb_comment_header p{line-height: 20px!important;}
	.bb_rw03 .bb_comment_header .fa{margin: 0 5px 0 0; font-size: 13px;}
	/*.bb_rw03 .bb_comment_area{padding: 0px 0px 0px; color: #5e729d; font-size: 12px;}*/
	.bb_rw03 .bb_comment_area {	padding: 0px 0px 0px;	color: #5e729d;	font-size: 12px;	position: absolute;	bottom: 22px;	width: auto;	box-sizing: border-box;}
	.bb_rw03 .bb_comment_area a{color: #5e729d; font-size: 12px; text-decoration: none; display: inline-block; margin-right: 10px;}
	.bb_rw03 .bb_comment_area a.bb_like_dislike{border: 1px solid #eee; width: 22px; height: 22px; border-radius: 3px; text-align: center; line-height: 22px;}
	.bb_rw03 .bb_comment_area a.bb_share_btn{margin: 5px 0 0 0!important}
	.bb_rw03 .bb_comment_area a i img{float: left; margin-top: 2px;}
	.bb_rw03 .text_section{padding: 15px 0 10px!important; min-height: 120px;}
	.bb_rw03 .bb_close {position: absolute;	cursor: pointer;width: 40px;height: 40px;border-radius: 6px;border:none;	background-color: #fff;	top: 10px;	right: 20px;color: #b4c4dc;font-size: 18px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); font-weight: 600!important;}
	.bb_rw03 .bb_sldebutton{position: absolute; top: 40px; height: 40px; width: 110px; left: 50%; margin-left: -50px; text-align: center; }
	.bb_rw03 .bb_sldebutton .bb_slide_btn {cursor: pointer;width: 40px;height: 40px;border-radius: 100%;border:none;	background-color: #fff;	color: #b4c4dc;font-size: 18px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); font-weight: 600!important; display: inline-block; margin: 0 5px; line-height: 40px; }
	
	
	/*################## WIDGET 04 #################*/		
	.bb_rw04 {width: 360px; height:100%; position: absolute; top:70px; /*left: 0%;*/ margin-left: 0px; margin-top: 0px; border-radius: 0px; font-family: 'BwNista Geo'; font-size: 13px; color: #09204f; box-sizing: border-box; left: 20px;}
	.bb_rw04 .bb_comments_area{ height: calc(100% - 180px); overflow-y: hidden; overflow-x: hidden;}
	.bb_rw04 .bb_comments_area:hover{ overflow-y: auto; overflow-x: hidden;}
	.bb_rw04 .bb_white_box{border-radius: 0px; height: 100%}
	.bb_rw04 .bb_rating_sec{float: left;  padding-right: 0px; box-sizing: border-box; height: 80px; margin-bottom: 0px;}
	.bb_rw04 .bb_rating_sec h3{font-size: 20px; color: #080d2e; margin: 0 0 7px; font-weight: 600}
	.bb_rw04 .bb_rating_sec h3 span{font-size: 13px; color: #72739c; margin: 0; font-weight: 400!important}
	.bb_rw04 .bb_rating_sec .fa{font-size: 18px; margin-right: 7px;}
	.bb_rw04 .bb_rating_sec h4{font-size: 13px; color: #080d2e; margin: 5px 0 0px; padding-bottom: 3px; font-weight: 500; /*border-bottom: 1px solid #f4f6fa;*/ float: left;}
	.bb_rw04 .bb_inner_comment{padding: 20px; border-top: 1px solid #eee ;}
	.bb_rw04 .bb_comment_header {padding: 0 0 15px 0; border-bottom: 1px solid #f4f6fa;}
	.bb_rw04 .bb_comment_header .bb_avatar01{float: left; position: relative; width: 36px; height: 36px; margin-right: 15px; }
	.bb_rw04 .bb_comment_header .bb_avatar01 img{width: 36px; height: 36px; border-radius: 100px;}
	.bb_rw04 .bb_comment_header p{line-height: 20px!important;}
	.bb_rw04 .bb_comment_header .fa{margin: 0 5px 0 0; font-size: 13px;}
	.bb_rw04 .bb_comment_area{padding: 0px 0px 0px; color: #5e729d; font-size: 12px;}
	.bb_rw04 .bb_comment_area a{color: #5e729d; font-size: 12px; text-decoration: none; display: inline-block; margin-right: 8px;}
	.bb_rw04 .bb_comment_area a.bb_like_dislike{border: 1px solid #eee; width: 22px; height: 22px; border-radius: 3px; text-align: center; line-height: 22px;}
	.bb_rw04 .bb_comment_area a.bb_share_btn{margin: 5px 0 0 0!important}
	.bb_rw04 .bb_comment_area a i img{float: left; margin-top: 2px;}
	.bb_rw04 .text_section{padding: 15px 0 15px!important;}
	.bb_rw04 .bb_close {position: absolute;	cursor: pointer;width: 40px;height: 40px;border-radius: 6px;border:none;	background-color: #fff;	top: 13px;	right: -55px;color: #b4c4dc;font-size: 18px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); font-weight: 600!important;}
	.bb_rw04 .bb_submit {padding: 10px 20px; background: #fff; z-index: 999; 	border-top: 1px solid #eee;	position: absolute;	bottom: 0;	width: 100%;	box-sizing: border-box;}
	.bb_rw04 .bb_submit input[type=text]{height: 30px; width: 280px; background: #fff; border: none!important; font-size: 13px; color: #5e729d; font-family: 'BwNista Geo'; font-weight: 400;}
	.bb_rw04 .bb_submit input[type=button]{width: 21px; height: 12px; border: none; background:url(../../assets/images/widget/submit_arrow.png) center center no-repeat; margin-top: 9px;}
	.bb_rw04 .bb_submit_button_white{ background: #fff; border-radius: 0px 100px 100px 100px; width: 60px;  height: 60px;  box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06); text-align: center; line-height: 55px; display: block; position: absolute;right: -80px;bottom: 60px;}
	#bbColorOrientationSection .previewWidgetBox .bb_submit_button_white.bbDarkButton{ background-image: linear-gradient(to top, #117bfb, #34aaff)!important;}
	.bb_rw04.bbAlternetWidget .bb_submit_button_white{border-radius: 0px 100px 100px 100px!important;}
	.bb_rw04 .bb_small_image_sec{ float: left; margin-right: 15px;}
	.bb_rw04 .bb_small_image_sec img{border-radius: 5px; margin-top: 5px; width: 90px; height: 62px;}
	.bb_rw04 .bb_widget_main_container {position: absolute;bottom: 20px;height: 100%;}
	/*################## WIDGET 03_1 #################*/		
	.bb_rw03_1 {width: 100%;  position: absolute; bottom: 0; left: 0; padding: 0 20px 20px 20px;  border-radius: 6px; font-family: 'BwNista Geo'; font-size: 13px; color: #09204f; box-sizing: border-box;}
	.bb_rw03_1 .bb_white_box{background:none!important; box-shadow: none!important}
	.bb_rw03_1 .bb_top_header_sec{ margin: 0; padding: 25px 25px 15px; border-bottom: 1px solid #f4f6fa; min-height: 72px; box-sizing: border-box;}
	.bb_rw03_1 .bb_rating_sec{float: left;  box-sizing: border-box; }
	.bb_rw03_1 .bb_rating_sec h3{font-size: 16px; color: #080d2e; margin: 0 0 0px; font-weight: 600; display: inline-block; margin-right: 10px;}
	.bb_rw03_1 .bb_rating_sec h3 span{font-size: 13px; color: #72739c; margin: 0; font-weight: 400!important}
	.bb_rw03_1 .bb_rating_sec p.bb_para{display: inline-block; margin-right: 10px;}
	.bb_rw03_1 .bb_rating_sec .fa{font-size: 18px; margin-right: 7px;}
	.bb_rw03_1 .bb_rating_sec h4{font-size: 13px; color: #080d2e; margin:0px; font-weight: 500; border-bottom: 1px solid #f4f6fa; display: inline-block; margin-right: 10px;}
	.bb_rw03_1 .bb_button_area{ padding: 0px; }
	.bb_rw03_1 .bb_button_area .bb_btn{width:auto;  box-shadow: none;  background-color: #fff; font-size: 13px; color: #09204f; font-weight: 500; display: inline-block; text-align: center; line-height: 28px; background: #fff; border:none; padding: 0px!important; box-sizing: border-box; font-family: 'BwNista Geo'; cursor: pointer; border-bottom: 1px solid #f4f6fa; margin: 0 0 0 20px;}
	.bb_rw03_1 .bb_small_comment_box{width: 32.8%; margin: 0.2%; float: left; background: #fff; /*border-right: 1px solid #f4f6fa;*/ padding: 25px; box-sizing: border-box; min-height: 290px; position: relative; border-radius: 6px; box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06); }
	.bb_rw03_1 .bb_comment_header {padding: 0 0 15px 0; border-bottom: 1px solid #f4f6fa;}
	.bb_rw03_1 .bb_comment_header .bb_avatar01{float: left; position: relative; width: 36px; height: 36px; margin-right: 15px; }
	.bb_rw03_1 .bb_comment_header .bb_avatar01 img{width: 36px; height: 36px; border-radius: 100px;}
	.bb_rw03_1 .bb_comment_header p{line-height: 20px!important;}
	.bb_rw03_1 .bb_comment_header .fa{margin: 0 5px 0 0; font-size: 13px;}
	/*.bb_rw03_1 .bb_comment_area{padding: 0px 0px 0px; color: #5e729d; font-size: 12px;}*/
	.bb_rw03_1 .bb_comment_area {	padding: 0px 0px 0px;	color: #5e729d;	font-size: 12px;	position: absolute;	bottom: 18px;	width: auto;	box-sizing: border-box;}
	
	.bb_rw03_1 .bb_comment_area a{color: #5e729d; font-size: 12px; text-decoration: none; display: inline-block; margin-right: 10px;}
	.bb_rw03_1 .bb_comment_area a.bb_like_dislike{border: 1px solid #eee; width: 22px; height: 22px; border-radius: 3px; text-align: center; line-height: 22px;}
	.bb_rw03_1 .bb_comment_area a.bb_share_btn{margin: 5px 0 0 0!important; }
	.bb_rw03_1 .bb_comment_area a i img{float: left; margin-top: 2px;}
	.bb_rw03_1 .text_section{padding: 15px 0 10px!important; min-height: 95px;}
	.bb_rw03_1 .bb_close {position: absolute;	cursor: pointer;width: 40px;height: 40px;border-radius: 6px;border:none;	background-color: #fff;	top: 5px;	right: 30px;color: #b4c4dc;font-size: 18px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); font-weight: 600!important;}
	.bb_rw03_1 .bb_sldebutton{position: absolute; top: -50px; height: 40px; width: 110px; left: 50%; margin-left: -58px; text-align: center; }
	.bb_rw03_1 .bb_sldebutton .bb_slide_btn {cursor: pointer;width: 40px;height: 40px;border-radius: 100%;border:none;	background-color: #fff;	color: #b4c4dc;font-size: 18px; box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08); font-weight: 600!important; display: inline-block; margin: 0 5px; line-height: 40px; }
	.bb_rw03_1 .bb_top_button_powered {width: 216px;  height: 50px;  box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.04);  background-color: #fff; border: 1px solid #f4f6fa; text-align: center; border-radius: 5px; display: inline-block; line-height: 45px; float: left; margin:0 0 10px 5px;}
	
	
	
	.bb_custom_txt_color{color:<?php echo $widgetData->widget_font_color; ?>!important;}
	.colorpicker-show-input .fa-square{border:1px solid #ccc!important; line-height: 15px !important; height: 18px !important; border-radius: 4px !important;}
	
	.bb_right_position{left:inherit!important; right:0%;}
	.bb_right_position .bb_close{right:inherit!important; left:-55px;}
	.bb_right_position .bb_submit_button_white{right:inherit!important; left:-80px; border-radius:100px 0px 100px 100px!important;}
	
	.bb_left_position_bw{right:inherit!important; /*left:0%;*/ left: 20px;}
	.bb_left_position_bw .bb_submit_button_white{float:left!important;}
	.bb_left_position_bw .bb_close{left:380px!important; right:inherit!important;}
	
	.bb_rw02 .bb_tab_box {
	padding: 19px 0px!important;
	position: relative;
	top: 30px;
	background:#transparent!important;
	}
	.bbAlternetWidget .bb_custom_bg{
	box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
	box-sizing: border-box;
	border-radius: 6px;
	margin-bottom: 4px !important;
	}
	.bbAlternetWidget .bb_tab_box { border-bottom:none;}
	
	<?php if($widgetData->alternative_design != 1){ ?>
		.bb_widget_main_container{
		<?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ');' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ');' : ''; } ?>
		<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color.';' : ''; ?>
		}
		<?php }else{ ?>
		.bbAlternetWidget .bb_custom_bg{
		<?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ');' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ');' : ''; } ?>
		<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color.';' : ''; ?>

		}
		.bbAlternetWidget .bb_widget_main_container{
		background-image:none;
		background:none;
		}
	<?php } ?>
	.rev_star_comment .fa-star{color:<?php echo $widgetData->rating_solid_color; ?>}
	
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
	
	
	
	
	
	.previewWidgetBox .red_bb_star_color{color: #541069!important;}
    .previewWidgetBox .yellow_bb_star_color{color:#f9814a!important;}
    .previewWidgetBox .orange_bb_star_color{color:#d92a3f!important;}
    .previewWidgetBox .green_bb_star_color{color:#076768!important;}
    .previewWidgetBox .blue_bb_star_color{color:#1b1f97!important;}
    .previewWidgetBox .purple_bb_star_color{color:#1e1e40!important;}
	
	.previewWidgetBox .bb_tab_box, .previewWidgetBox .bb_comment_header, .previewWidgetBox .bb_rating_sec, .previewWidgetBox .bb_comment_area a.bb_like_dislike, .previewWidgetBox .bb_top_header_sec, .previewWidgetBox .bb_small_comment_box, .previewWidgetBox .bb_bbot, .previewWidgetBox .box_1, .previewWidgetBox .bb_comment_reply_sec .bb_inner_reply{border-color:<?php echo $widgetData->widget_border_color; ?>}
	/*.previewWidgetBox{box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important;}*/
	
	.bfwAlternat .bb_close.bb_custom_bg{position:absolute!important;}
	
	.bb_rw02 .bb_comments_area .addCustomBGClass.bb_bbot{border:none;}
	
	.bb_top_button_powered.bb_custom_bg, .bbTopScrollCPA.bb_custom_bg, .bbBottomScrollCPA.bb_custom_bg, .bb_sldebutton .bb_slide_btn.bb_custom_bg, .bwwAlternat .bb_custom_bg, .bfwMain .bb_custom_bg, .bfwAlternat .bb_custom_bg{
		<?php 
		if($colorOrientation != 'circle'){
			echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient(' . $colorOrientation . ', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ');' : ''; 
		}else{
			echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient(' . $colorOrientation . ', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ');' : ''; 
		}
		?>
		<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color.';' : ''; ?>
	}
	.bb_rw04.bb_right_position .bb_submit_button_white{border-radius: 100px 0px 100px 100px !important;}
	.previewWidgetBox .bbLightButton.bb_submit_button_white{background:#ffffff!important;}
	
	.choose_orientation li a.active {
		border: 1px solid #ddd;
	}
	
	
	.mobile_box .bb_rw03_1{transform: scale(0.8); padding-bottom: 0px;}
	.mobile_box .bb_rw03_1 .bb_small_comment_box{width: 100%; }
	.mobile_box .bb_rw01 .bb_close{display: none;}
	.mobile_box .bb_rw03_1 .bb_sldebutton{display: none;}
	.mobile_box .bb_rw02{transform: scale(0.8); width: 100%; margin-left: -230px;}
	
	.widget_view_change_menu{position: absolute; right: 0; top: 15px; }
	
	.tablet_box .bb_rw03_1{font-size: 12px; }
	.tablet_box .bb_para.heading_txt{font-size: 12px;}
	.tablet_box .bb_rw03_1 .bb_small_comment_box{padding: 15px;}
	.tablet_box .bb_rw03_1 .bb_comment_area{position: relative; margin-top: 10px;}
	.tablet_box .bb_rw03_1 .bb_comment_area a.bb_share_btn{float: left!important}
	
	
	
	
	.mobile_box .bb_rw04{transform: scale(0.8); }
	#Desktopver .bb_rw04{left: 30px; transform: scale(0.9);}
	.tablet_box .bb_rw04{left: 30px; transform: scale(0.9);}
	
	.tablet_box .bb_rw05{transform: scale(0.9); }
	.tablet_box .bb_rw05 .bb_button_area {	padding: 0px;	width: 100%;	float: left;	margin: 15px 0 0 0;}
	.tablet_box .bb_rw05 .bb_button_area .bb_btn{width: 48%}
	.tablet_box .bb_rw05 .bb_rating_sec{width: 48%; margin: 0; border: none;}
	.tablet_box .bb_rw05 .bb_progress_bar_sec{width: 48%; margin: 0}
	
	.mobile_box .bb_rw05{transform: scale(0.9); }
	.mobile_box .bb_rw05 .bb_button_area {	padding: 0px;	width: 100%;	float: left;	margin: 15px 0 0 0;}
	.mobile_box .bb_rw05 .bb_button_area .bb_btn{width: 48%}
	.mobile_box .bb_rw05 .bb_rating_sec{width: 48%; margin: 0; border: none;}
	.mobile_box .bb_rw05 .bb_progress_bar_sec{width: 48%; margin: 0}
	
	
	
	
	
	
	#Desktopver .bb_rw03_1 .bb_comment_area a.bb_share_btn{float: left!important}
	#Desktopver img.w100{min-height: 950px;}
	@media only screen and (max-width:768px){
		.widgsetting{font-size: 12px}	
		#right-icon-tab2 .panel.panel-flat{margin-bottom: 30px!important}
		#right-icon-tab2 .panel-heading{height: auto!important; padding: 0!important }
		.widget_sec img.w100{min-height: 550px!important}
		.col-md-2.review_source_new{float: left;}
		.widget_view_change_menu {	position: relative;	right: inherit;	top: inherit;}
		#Desktopver .bb_rw03_1{width: 1500px}
	}
	@media only screen and (max-width:480px){
		.col-md-2.review_source_new{max-width: 230px!important; margin: 20px auto!important; float: none;}
		.bb_rw01{width: 300px;}
		.bb_left_position_bw .bb_close{display: none;}
		.mobile_box{width: 100%; transform: scale(1.0)}
	}
	
	

	
	
</style>

<?php 
	$brand_title = $widgetData->brand_title;
	$brand_desc = $widgetData->brand_desc;
	$logo_img = $widgetData->logo_img;
	$hashcodeBB = $widgetData->hashcode;
		
	$rating = $widgetData->min_ratings_display;
	
	$allow_comments = $widgetData->allow_comments;
	$allow_video_reviews = $widgetData->allow_video_reviews;
	$allow_helpful_feedback = $widgetData->allow_helpful_feedback;
	$allow_live_reading_review = $widgetData->allow_live_reading_review;
	$allow_comment_ratings = $widgetData->allow_comment_ratings;
	$allow_review_timestamp = $widgetData->allow_review_timestamp;
	$allow_pros_cons = $widgetData->allow_pros_cons;
	$alternative_design = $widgetData->alternative_design;
	$allow_campaign_name = $widgetData->allow_campaign_name;
	$bbDisplay = $widgetData->often_bb_display;
	
	$bg_color = $widgetData->bg_color;
	$text_color = $widgetData->text_color;
	$widget_type = $widgetData->widget_type;
	$widget_type = explode('|', $widget_type);
	$num_of_review = $widgetData->num_of_review;
	$domain_name = $widgetData->domain_name;
	$allow_branding = $widgetData->allow_branding;
	$notification = $widgetData->notification;
	
	$pro_cons = $widgetData->pro_cons;
?>

<div class="tab-pane <?php echo $camp; ?>" id="right-icon-tab2">
    <div class="row">
        <div class="col-md-3">
            <div style="margin: 0;" class="panel panel-flat">
				
                <div class="panel-heading">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#Configurations" data-toggle="tab" aria-expanded="false">Configurations</a></li>
                        <li class=""><a href="#Design" data-toggle="tab" aria-expanded="false">Design</a></li>
						<li class=""><a href="#Campaign" data-toggle="tab" aria-expanded="false">Campaigns</a></li>
					</ul>
				</div>
                <div class="panel-body p0">
                    <div class="tab-content"> 
                        <div class="tab-pane active" id="Configurations">
                            <div class="profile_sec">
                                <form method="post" name="frmWidgetConfSubmit" id="frmWidgetConfSubmit" action="javascript:void(0);" enctype="multipart/form-data">
									
                                    {{csrf_field()}}
                                    <input type="hidden" name="edit_logo_img" id="edit_logo_img" value="<?php echo $logo_img; ?>" />
                                    <input type="hidden" name="edit_widgetId" id="edit_widgetId" value=<?php echo $widgetID; ?> />
									<div class="configurations p20">
										<div class="form-group">
											<div class="">
												<label class="control-label">Template</label>
												<button id="newcampaign" class="btn h52 form-control w100" style="text-align: left; padding: 7px 23px!important;"><span>Vertical Popup</span> <i class="pull-right txt_grey"><img src="<?php echo base_url(); ?>assets/images/icon_grid.png"></i></button>
											</div>
										</div>
									</div>
                                    <div class="profile_headings">Components <a class="pull-right plus_icon" href="javascript:void(0);"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
                                    <div class="interactions configurations p25">
                                        <ul>
                                            <li><small class="wauto">Comments</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="allow_comment" id="allow_comment"  value="<?php echo $allow_comments != '0' ? $allow_comments : '0'; ?>" <?php echo $allow_comments != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig" preview_fname="preview_allow_comments">
                                                    <span class="toggle"></span>
												</label>
											</li>
                                            <li><small class="wauto">Video Reviews</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="allow_video_reviews" id="allow_video_reviews"  value="<?php echo $allow_video_reviews != '0' ? $allow_video_reviews : '0'; ?>" <?php echo $allow_video_reviews != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig" preview_fname="previewallow_video_reviews">
                                                    <span class="toggle"></span>
												</label>
											</li>
                                            <li><small class="wauto">Helpful Feedback</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="allow_helpful" id="allow_helpful"  value="<?php echo $allow_helpful_feedback != '0' ? $allow_helpful_feedback : '0'; ?>" <?php echo $allow_helpful_feedback != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig"  preview_fname="preview_allow_helpful_feedback">
                                                    <span class="toggle"></span>
												</label>
											</li>
                                            <li><small class="wauto">People Currently Reading</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="allow_live_reading" id="allow_live_reading"  value="<?php echo $allow_live_reading_review != '0' ? $allow_live_reading_review : '0'; ?>" <?php echo $allow_live_reading_review != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig" >
                                                    <span class="toggle"></span>
												</label>
											</li>
                                            <li><small class="wauto">Comment Rating</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="allow_ratings" id="allow_ratings"  value="<?php echo $allow_comment_ratings != '0' ? $allow_comment_ratings : '0'; ?>" <?php echo $allow_comment_ratings != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig" preview_fname="preview_allow_comment_ratings">
                                                    <span class="toggle"></span>
												</label>
											</li>
                                            <li><small class="wauto">Review Date Stamps</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="allow_timestamp" id="allow_timestamp" value="<?php echo $allow_review_timestamp != '0' ? $allow_review_timestamp : '0'; ?>" <?php echo $allow_review_timestamp != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig" preview_fname="preview_allow_review_timestamp">
                                                    <span class="toggle"></span>
												</label>
											</li>
											<li><small class="wauto">Alternative Design</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="alternative_design" id="alternative_design" value="<?php echo $alternative_design != '0' ? $alternative_design : '0'; ?>" <?php echo $alternative_design != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig">
                                                    <span class="toggle"></span>
												</label>
											</li>
											<li><small class="wauto">Display Campaign Name</small> 
                                                <label class="custom-form-switch pull-right">
                                                    <input type="checkbox" name="allow_campaign_name" id="allow_campaign_name" value="<?php echo $allow_campaign_name != '0' ? $allow_campaign_name : '0'; ?>" <?php echo $allow_campaign_name != '0' ? 'checked' : ''; ?> class="field checkedBoxValue autoSaveConfig">
                                                    <span class="toggle"></span>
												</label>
											</li>
											
                                            <div class="clearfix"></div>
										</ul>
									</div>
									
									
                                    <div class="profile_headings">Brand Boost Details <a class="pull-right plus_icon" href="javascript:void(0);"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
									
                                    <div class="configurations p25">
                                        
                                        
                                        <div class="form-group">
                                            <label class="control-label">Domain</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input  name="domain_name" id="domain_name" value="<?php echo $domain_name != '' ? $domain_name : ''; ?>" class="form-control h52 autoSaveConfig" placeholder="www.google.com" type="text">
											</div>
										</div>
										
                                        <div class="form-group">
                                            <label class="control-label">Brand Boost Name</label>
                                            <div class="">
                                                <input  name="title" id="brand_title" value="<?php echo $brand_title != '' ? $brand_title : ''; ?>" placeholder="New Product on Site Boost" class="form-control h52 autoSaveConfig" type="text">
											</div>
										</div>
                                        
										<div class="form-group hidden">
                                            <label class="control-label">Brand Boost Description</label>
                                            <div class="">
                                                <textarea class="form-control" id="brand_desc" placeholder="Brand Boost Description" name="desc"><?php echo $brand_desc != '' ? trim($brand_desc) : ''; ?></textarea>
											</div>
										</div>
                                        
										<div class="form-group">
											<label class="control-label">Widget logo</label>
											<label class="display-block">
												<input type="hidden" name="logo_img" id="logo_img" class="autoSaveConfig" value="">
												<div class="img_vid_upload_small">
													<div class="dropzone" id="myDropzone_logo_img"></div>
												</div>
											</label>
										</div>
										<div class="form-group hidden">
											<label class="control-label">Product image</label>
											<label class="display-block">
												<input type="hidden" name="product_img" id="product_img" class="autoSaveConfig" value="">
												<div class="img_vid_upload_small">
													<div class="dropzone" id="myDropzone_brand_img"></div>
												</div>
											</label>
										</div>
										
									</div>
									
                                    <div class="profile_headings">Review Settings <a class="pull-right plus_icon" href="javascript:void(0);"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
									
                                    <div class="p25 review_setting">
										<div class="form-group">
											<label class="control-label">Reviews Order</label>
											<select class="form-control h52 autoSaveConfig" name="reviews_order" id="reviews_order">
												<option value="all" <?php echo $widgetData->reviews_order == 'all' ? 'selected' : ''; ?>>All Reviews</option>
												<option value="top_rating" <?php echo $widgetData->reviews_order == 'top_rating' ? 'selected' : ''; ?>>Top Rated Reviews</option>
												<option value="lowest_rating" <?php echo $widgetData->reviews_order == 'lowest_rating' ? 'selected' : ''; ?>>Lowest Rated Reviews</option>
											</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">Reviews Order By</label>
											<select class="form-control h52 autoSaveConfig" name="reviews_order_by" id="reviews_order_by">
												<option value="all" <?php echo $widgetData->reviews_order_by == 'all' ? 'selected' : ''; ?>>All Reviews</option>
												<option value="newest" <?php echo $widgetData->reviews_order_by == 'newest' ? 'selected' : ''; ?>>Newest Reviews</option>
												<option value="oldest" <?php echo $widgetData->reviews_order_by == 'oldest' ? 'selected' : ''; ?>>Oldest Reviews</option>
											</select>
										</div>
										
										<div class="mb20">
											<div class="widgsetting">
												<div class="col-xs-8">
													<span>Reviews display</span>
												</div>
												<div class="col-xs-4">
													<input type="text" name="numofrev" id="numofrev" class="touchspin-vertical form-control fsize14 autoSaveConfig" value="<?php echo $num_of_review == '' ? 4 : $num_of_review; ?>">
												</div>
											</div>
										</div>
										<div class="mb20">
											<div class="widgsetting">
												<div class="col-xs-8">
													<span>How often to show widget</span>
												</div>
												<div class="col-xs-4 ">
													<input type="text" id="bbDisplay" name="bbDisplay" class="touchspin-vertical form-control fsize14 autoSaveConfig" value="<?php echo $bbDisplay == '' ? 1 : $bbDisplay; ?>">
												</div>
											</div>
										</div>
										<div class="mb20">
											<div class="widgsetting">
												<div class="col-xs-8">
													<span>Minimum rating to display</span>
												</div>
												<div class="col-xs-4 ">
													<input type="text" id="ratingValue" name="ratingValue" class="touchspin-vertical form-control fsize14 autoSaveConfig" value="<?php echo $rating == '' ? 4 : $rating; ?>">
												</div>
											</div>
										</div>
                                        
									</div>
									
                                    <div class="p25 text-center btop hidden">
                                        <?php if ($canWrite): ?>
										<button <?php if ($bActiveSubsription == false) { ?> class="saveWidgetConfig btn dark_btn h52 w100 bkg_purple pDisplayNoActiveSubscription" type="button" title="No Active Subscription" <?php } else { ?> class="saveWidgetConfig btn dark_btn h52 w100 bkg_purple" type="submit" <?php } ?>> Save </button>
                                        <?php endif; ?>
									</div>
									
									
								</form></div>
						</div>
                        
						<div class="tab-pane" id="Design">
                            <div class="profile_headings fsize12 fw500">Widget appearance <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                            <form method="post" name="frmSubmitWidgetDesign" id="frmSubmitWidgetDesign" action="javascript:void(0);"  enctype="multipart/form-data">
								@csrf
                                <input type="hidden" name="edit_widgetId" id="edit_widgetId" value=<?php echo $widgetID; ?> />
								
                                <div class="p20">							
									<div class="form-group">
										<label class="control-label">Widget Position</label>
										<select class="form-control h52 autoSaveDesign widgetPosition" name="widget_position" id="widget_position">
											<option value="bottom-left" <?php echo $widgetData->widget_position == 'bottom-left' ? 'selected' : ''; ?>>Left</option>
											<option value="bottom-right" <?php echo $widgetData->widget_position == 'bottom-right' ? 'selected' : ''; ?>>Right</option>
										</select>
										<input class="form-control h52" value="Center" id="widgetPositionVal" style="display:none;" readonly disabled>
									</div>
									
									<div class="form-group">
										<label class="control-label">Widget Theme</label>
										<select class="form-control h52" name="widget_themes" id="widget_themes">
											<option value="">Choose Widget Theme</option>
											<?php foreach($widgetThemeData as $themeData){ ?>
												<option value="<?php echo $themeData->id; ?>" <?php echo $themeData->id == $widgetData->widget_themes ? 'selected' : ''; ?>><?php echo $themeData->widget_theme_title; ?></option>
											<?php } ?>
										</select>
									</div>
									
                                    <div class="mb0 hidden">
                                        <label class="control-label txt_upper fsize11 fw500 text-muted">Company info</label>
                                        <div class="form-group pull-right mb0">
                                            <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">USE DEFAULT</p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field" type="checkbox" <?php echo ($widgetData->company_info > 0 || empty($widgetData)) ? 'checked' : ''; ?> name="company_info_switch" id="company_info_switch">
											<span class="toggle dred"></span> </label>
                                            <div class="clearfix"></div>
										</div>
                                        <div class="import_box p0">
                                            <div id="default_company_info_box" <?php echo ($widgetData->company_info > 0 || empty($widgetData)) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                <div class="p20 bbot">
                                                    <p class="mb0"><strong><?php echo $widgetData->brand_title; ?></strong></p>
												</div>
                                                <div class="p20">
                                                    <?php echo $widgetData->brand_desc; ?>
												</div>
											</div>
                                            <div id="custom_company_info_box" <?php echo ($widgetData->company_info > 0 || empty($widgetData)) ? 'style="display:none;"' : 'style="display:block;"'; ?>>
                                                <div class="p10 bbot">
                                                    <p class="mb0">
                                                        <strong>
                                                            <input name="custom_company_name" id="custom_company_name" class="form-control h52" placeholder="Company Name" type="text" style="border:none; background:#FBFBFD; padding-left:10px;" value="<?php echo $widgetData->company_info_name == '' ? $widgetData->brand_title : $widgetData->company_info_name; ?>">
														</strong>
													</p>
												</div>
                                                <div class="p10">
                                                    <textarea name="custom_company_description" style="border:none; background:#FBFBFD; padding-left:10px; padding-top:10px; height:190px;" id="custom_company_description" class="form-control"><?php echo $widgetData->company_info_description == '' ? $widgetData->brand_desc : $widgetData->company_info_description; ?></textarea>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								
                                <div class="profile_headings">WIDGET STYLE <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                <div class="p20">
                                    
                                    <div class="form-group">
                                        <label class="control-label txt_upper fsize11 fw500 text-muted">Widget color</label>
                                        <div class="form-group pull-right mb0">
                                            <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Gradient</p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field autoSaveDesign" type="checkbox" <?php echo $widgetData->header_color_solid == 0 ? 'checked' : ''; ?> name="main_color_switch" id="main_color_switch">
											<span class="toggle dred"></span> </label>
                                            <div class="clearfix"></div>
										</div>
									</div>
									
									<div class="widgetMultiColorBox" <?php echo $widgetData->header_color_solid == 0 ? '' : 'style="display:none;"'; ?>>
										<div class="form-group">
											<div class="color_box">
												<input type="hidden" name="main_colors" id="main_colors" value="<?php echo $widgetData->header_color == '' ? 'white' : $widgetData->header_color; ?>">
												<div class="color_cube white selectMainColor <?php echo $widgetData->header_color == 'white' ? 'active' : ''; ?>" color-data='white' color-class="white_preview_1"></div>
												<div class="color_cube dred selectMainColor <?php echo $widgetData->header_color == 'red' ? 'active' : ''; ?>" color-data='red' color-class="red_preview_1"></div>
												<div class="color_cube yellow selectMainColor <?php echo $widgetData->header_color == 'yellow' ? 'active' : ''; ?>" color-data='yellow' color-class="yellow_preview_1"></div>
												<div class="color_cube red selectMainColor <?php echo $widgetData->header_color == 'orange' ? 'active' : ''; ?>" color-data='orange' color-class="orange_preview_1"></div>
												<div class="color_cube green selectMainColor <?php echo ($widgetData->header_color == '' || $widgetData->header_color == 'green') ? 'active' : ''; ?>" color-data='green' color-class="green_preview_1"></div>
												<div class="color_cube blue selectMainColor <?php echo $widgetData->header_color == 'blue' ? 'active' : ''; ?>" color-data='blue' color-class="blue_preview_1"></div>
												<div class="color_cube black selectMainColor <?php echo $widgetData->header_color == 'purple' ? 'active' : ''; ?>" color-data='purple' color-class="purple_preview_1"></div>
												<div class="clearfix"></div>
											</div>
										</div>
										
										
										<div class="form-group">
											
											<div class="row">
												<div class="position-relative mt-5 col-md-6">
													<input name="custom_colors1" class="form-control h52 autoSaveDesign" id="custom_colors1" placeholder="#000000" type="text" value="<?php echo $widgetData->header_custom_color1 == '' ? '#000000' : $widgetData->header_custom_color1; ?>" <?php echo $widgetData->header_color_custom < 1 ? 'readonly' : ''; ?>>
													<a style="position: absolute; top: 17px; right: 25px;" class="colorpicker1 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php echo $widgetData->header_custom_color1 == '' ? 'style="color:#000000"' : 'style="color:' . $widgetData->header_custom_color1 . '"'; ?>></i></a>
												</div>
												
												<div class="position-relative mt-5 col-md-6">
													<input name="custom_colors2" class="form-control h52 autoSaveDesign" id="custom_colors2" placeholder="#FF0000" type="text" value="<?php echo $widgetData->header_custom_color2 == '' ? '#FF0000' : $widgetData->header_custom_color2; ?>" <?php echo $widgetData->header_color_custom < 1 ? 'readonly' : ''; ?>>
													<a style="position: absolute; top: 17px; right: 25px;" class="colorpicker2 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php echo $widgetData->header_custom_color2 == '' ? 'style="color:#FF0000"' : 'style="color:' . $widgetData->header_custom_color2 . '"'; ?>></i></a>
												</div>
											</div>
										</div>
										
										<div class="row orientation_top" style="display:block">
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
									
									
									<div class="mb20 widgetSingleColorBox" <?php echo $widgetData->header_color_solid == 0 ? 'style="display:none;"' : ''; ?>>
                                        
										
                                        <div class="row">
                                            <div class="position-relative mt-5 col-md-12">
                                                <input name="solid_color" class="form-control h52 autoSaveDesign" id="solid_color" placeholder="#FF0000" type="text" value="<?php echo $widgetData->header_solid_color == '' ? '#FF0000' : $widgetData->header_solid_color; ?>" <?php echo $widgetData->header_color_solid < 1 ? 'readonly' : ''; ?>>
                                                <a style="position: absolute; top: 17px; right: 25px;" class="solidcolorpicker colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php echo $widgetData->header_solid_color == '' ? 'style="color:#FF0000"' : 'style="color:' . $widgetData->header_solid_color . '"'; ?>></i></a>
											</div>
											
										</div>
									</div>
								</div>
								
								<div class="profile_headings">FONT COLOR <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                <div class="p20">
									<div class="mb20">
                                        <div class="row">
                                            <div class="position-relative mt-5 col-md-12">
                                                <input name="widget_font_color" id="widget_font_color" class="form-control h52 autoSaveDesign" placeholder="#1d2129" type="text" value="<?php echo $widgetData->widget_font_color == '' ? '#1d2129' : $widgetData->widget_font_color; ?>">
                                                <a style="position: absolute; top: 17px; right: 25px;" class="fontcolorpicker colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php echo $widgetData->widget_font_color == '' ? 'style="color:#1d2129"' : 'style="color:' . $widgetData->widget_font_color . '"'; ?>></i></a>
											</div>
										</div>
									</div>
								</div>
								
								<div class="profile_headings">BORDER LINE COLOR <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                <div class="p20">
									<div class="mb20">
                                        <div class="row">
                                            <div class="position-relative mt-5 col-md-12">
                                                <input name="widget_border_color" id="widget_border_color" class="form-control h52 autoSaveDesign" placeholder="#f4f6fa" type="text" value="<?php echo $widgetData->widget_border_color == '' ? '#f4f6fa' : $widgetData->widget_border_color; ?>">
                                                <a style="position: absolute; top: 17px; right: 25px;" class="bordercolorpicker colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php echo $widgetData->widget_border_color == '' ? 'style="color:#f4f6fa"' : 'style="color:' . $widgetData->widget_border_color . '"'; ?>></i></a>
											</div>
										</div>
									</div>
								</div>								
								
								<div class="profile_headings">RATING STYLE <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                <div class="p20">
                                    <div class="form-group hidden">
                                        <label class="control-label txt_upper fsize11 fw500 text-muted">Rating color</label>
                                        <div class="form-group pull-right mb0">
                                            <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Gradient</p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field autoSaveDesign" type="checkbox" name="main_color_switch_rating" id="main_color_switch_rating">
											<span class="toggle dred"></span> </label>
                                            <div class="clearfix"></div>
										</div>
									</div>
									
									<div class="widgetMultiColorBoxRating hidden">
										<div class="form-group">
											<div class="color_box">
												<input type="hidden" name="main_colors_rating" id="main_colors_rating" value="<?php echo $widgetData->rating_color == '' ? 'yellow' : $widgetData->rating_color; ?>">
												<div class="color_cube dred selectMainColorRating <?php echo $widgetData->rating_color == 'red' ? 'active' : ''; ?>" color-data='red' color-class="red_bb_star_color"></div>
												<div class="color_cube yellow selectMainColorRating <?php echo $widgetData->rating_color == 'yellow' ? 'active' : ''; ?>" color-data='yellow' color-class="yellow_bb_star_color"></div>
												<div class="color_cube red selectMainColorRating <?php echo $widgetData->rating_color == 'orange' ? 'active' : ''; ?>" color-data='orange' color-class="orange_bb_star_color"></div>
												<div class="color_cube green selectMainColorRating <?php echo ($widgetData->rating_color == '' || $widgetData->rating_color == 'green') ? 'active' : ''; ?>" color-data='green' color-class="green_bb_star_color"></div>
												<div class="color_cube blue selectMainColorRating <?php echo $widgetData->rating_color == 'blue' ? 'active' : ''; ?>" color-data='blue' color-class="blue_bb_star_color"></div>
												<div class="color_cube black selectMainColorRating <?php echo $widgetData->rating_color == 'purple' ? 'active' : ''; ?>" color-data='purple' color-class="purple_bb_star_color"></div>
												<div class="clearfix"></div>
											</div>
										</div>
										
										
										<div class="form-group">
											<div class="row">
												<div class="position-relative mt-5 col-md-6">
													<input name="custom_colors_rating1" class="form-control h52 autoSaveDesign" id="custom_colors_rating1" placeholder="#ffcb65" type="text" value="<?php //echo $widgetData->rating_custom_color1 == '' ? '#ffcb65' : $widgetData->rating_custom_color1; ?>" <?php //echo $widgetData->rating_color_custom < 1 ? 'readonly' : ''; ?>>
													<a style="position: absolute; top: 17px; right: 25px;" class="colorpickerRating1 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php //echo $widgetData->rating_custom_color1 == '' ? 'style="color:#ffcb65"' : 'style="color:' . $widgetData->rating_custom_color1 . '"'; ?>></i></a>
												</div>
												
												<div class="position-relative mt-5 col-md-6">
													<input name="custom_colors_rating2" class="form-control h52 autoSaveDesign" id="custom_colors_rating2" placeholder="#ffcb65" type="text" value="<?php //echo $widgetData->rating_custom_color2 == '' ? '#ffcb65' : $widgetData->rating_custom_color2; ?>" <?php //echo $widgetData->rating_color_custom < 1 ? 'readonly' : ''; ?>>
													<a style="position: absolute; top: 17px; right: 25px;" class="colorpickerRating2 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php //echo $widgetData->rating_custom_color2 == '' ? 'style="color:#ffcb65"' : 'style="color:' . $widgetData->rating_custom_color2 . '"'; ?>></i></a>
												</div>
											</div>
										</div>
									</div>
									
									<div class="mb20 widgetSingleColorBoxRating" <?php //echo ($widgetData->rating_color_fix > 0 || empty($widgetData)) ? 'style="display:none;"' : ''; ?>>
                                        <div class="row">
                                            <div class="position-relative mt-5 col-md-12">
                                                <input name="solid_color_rating" class="form-control h52 autoSaveDesign" id="solid_color_rating" placeholder="#ffcb65" type="text" value="<?php //echo $widgetData->rating_solid_color == '' ? '#ffcb65' : $widgetData->rating_solid_color; ?>" <?php //echo $widgetData->rating_color_solid < 1 ? 'readonly' : ''; ?>>
                                                <a style="position: absolute; top: 17px; right: 25px;" class="solidcolorpickerRating colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-square fsize18" <?php //echo $widgetData->rating_solid_color == '' ? 'style="color:#ffcb65"' : 'style="color:' . $widgetData->rating_solid_color . '"'; ?>></i></a>
											</div>
										</div>
									</div>
								</div>
								
								<div class="profile_headings fsize12 fw500 widgetIcon">Widget Icon <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                <div class="p25 widgetIcon">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group">
												<label class="control-label">Choose Icon</label>
												<select class="form-control h52 autoSaveDesign" name="icon_type" id="icon_type">
													<option value="default" <?php echo $widgetData->icon_type == 'default' ? 'selected' : ''; ?>>Default</option>
													<option value="dark" <?php echo $widgetData->icon_type == 'dark' ? 'selected' : ''; ?>>Dark Icon</option>
													<option value="light" <?php echo $widgetData->icon_type == 'light' ? 'selected' : ''; ?>>Light Icon</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								
                                <div class="profile_headings fsize12 fw500">BRANDING <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                <div class="p25">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group mb10 hidden">
												
                                                <p class="pull-left mb0">Notification </p>
                                                <label class="custom-form-switch pull-right">
                                                    <input class="field" type="checkbox" name="notification" <?php echo $notification > 0 ? 'checked' : ''; ?>>
												<span class="toggle purple"></span> </label>
                                                <div class="clearfix"></div>
											</div>
											
                                            <div class="form-group mb10">
                                                <p class="pull-left mb0">Hide Brand Boost branding</p>
                                                <label class="custom-form-switch pull-right">
                                                    <input class="field autoSaveDesign" type="checkbox" name="allow_branding" <?php echo $allow_branding > 0 ? 'checked' : ''; ?>>
												<span class="toggle purple"></span> </label>
                                                <div class="clearfix"></div>
											</div>
											
										</div>
									</div>
								</div>
								
                                <div class="p25 text-center btop hidden">
									<input type="hidden" name="widget_bgcolor_switch" id="widget_bgcolor_switch" value="<?php echo $widgetData->header_color_fix == 0 ? '' : 1; ?><?php echo $widgetData->header_color_custom == 0 ? '' : 2; ?><?php echo $widgetData->header_color_solid == 0 ? '' : 3; ?>">
                                    <?php if ($canWrite): ?>
									<button <?php if ($bActiveSubsription == false) { ?> class="saveWidgetDesign btn dark_btn h52 w100 bkg_purple pDisplayNoActiveSubscription" type="button" title="No Active Subscription" <?php } else { ?> class="saveWidgetDesign btn dark_btn h52 w100 bkg_purple" type="submit" <?php } ?>> Save </button>
                                    <?php endif; ?>
								</div>
							</form>
							<form name="frmsaveCustomWidgetTheme" id="frmsaveCustomWidgetTheme" method="post" action="">
								<div class="profile_headings fsize12 fw500">Save Widget Theme Settings <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
								<div class="p25">
									<div class="form-group">
										<div class="">
											<input  name="widget_theme_title" id="widget_theme_title" value="" placeholder="Create Widget Theme" class="form-control h52" required="" type="text">
											
											<input type="hidden" name="theme_main_colors" id="theme_main_colors" value="<?php echo $widgetData->header_color; ?>">
											
											<input type="hidden" name="theme_custom_colors1" id="theme_custom_colors1" value="<?php echo $widgetData->header_custom_color1; ?>">
											
											<input type="hidden" name="theme_custom_colors2" id="theme_custom_colors2" value="<?php echo $widgetData->header_custom_color2; ?>">
											
											<input type="hidden" name="theme_solid_color" id="theme_solid_color" value="<?php //echo $widgetData->solid_color; ?>">
											
											<input type="hidden" name="theme_bg_color_switch" id="theme_bg_color_switch" value="<?php echo $widgetData->header_color_fix == 0 ? '' : $widgetData->header_color_fix; ?><?php echo $widgetData->header_color_custom == 0 ? '' : $widgetData->header_color_custom; ?><?php echo $widgetData->header_color_solid == 0 ? '' : $widgetData->header_color_solid; ?>">
											
											<input type="hidden" name="theme_main_colors_rating" id="theme_main_colors_rating" value="<?php echo $widgetData->rating_color; ?>">
											
											<input type="hidden" name="theme_rating_custom_color1" id="theme_rating_custom_color1" value="<?php echo $widgetData->rating_custom_color1; ?>">
											
											<input type="hidden" name="theme_rating_custom_colors2" id="theme_rating_custom_colors2" value="<?php echo $widgetData->rating_custom_color2; ?>">
											
											<input type="hidden" name="theme_rating_solid_color" id="theme_rating_solid_color" value="<?php echo $widgetData->rating_solid_color; ?>">
											
											<input type="hidden" name="theme_fix_rating_color" id="theme_fix_rating_color" value="<?php echo $widgetData->rating_color_fix; ?>">
											
											<input type="hidden" name="theme_widget_font_color" id="theme_widget_font_color" value="<?php echo $widgetData->widget_font_color; ?>">
											
											<input type="hidden" name="theme_widget_border_color" id="theme_widget_border_color" value="<?php echo $widgetData->widget_border_color; ?>">
											
											<input type="hidden" name="theme_widget_position" id="theme_widget_position" value="<?php echo $widgetData->widget_position; ?>">
											
											<input type="hidden" name="theme_color_orientation" id="theme_color_orientation" value="<?php echo $widgetData->color_orientation; ?>">
											
											<input type="hidden" name="theme_widget_id" id="theme_widget_id" value="<?php echo $widgetData->id; ?>">
										</div>
									</div>
									<button <?php if ($bActiveSubsription == false) { ?> class="saveCustomWidgetTheme btn dark_btn h52 w100 bkg_purple pDisplayNoActiveSubscription" type="button" title="No Active Subscription" <?php } else { ?> class="saveCustomWidgetTheme btn dark_btn h52 w100 bkg_purple" type="submit" <?php } ?>> Save Widget Theme </button>
								</div>
							</form>
						</div>
						
						<div class="tab-pane" id="Campaign">
							<div class="profile_headings txt_upper p20 fsize11 fw600">Select Campaign <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
							<form method="post" name="frmSubmitCampaign" id="frmSubmitCampaign" action="javascript:void(0);">
								@csrf
								<div class="p20">
									<div class="row">
										<div class="col-md-12">
											<?php foreach ($oBrandboostList as $data) { ?>
												<div class="form-group mb10">
													<p class="pull-left mb0"><a href="<?php echo base_url('admin/brandboost/onsite_setup/'.$data->id); ?>" target="_blank"><?php echo $data->brand_title; ?></a></p>
													<label class="custom-form-switch pull-right">
														<input class="field autoSaveCampaign" type="checkbox" id="widget_campaign_<?php echo $data->id; ?>" name="campaign_id" value="<?php echo $data->id; ?>" 
														<?php echo $data->id == $widgetData->brandboost_id ? 'checked' : ''; ?>>
														<span class="toggle dred"></span> 
													</label>
													<div class="clearfix"></div>
												</div>
											<?php } ?>
										</div>
										<input type="hidden" name="campaign_widget_id" id="campaign_widget_id" value="<?php echo $widgetData->id; ?>">
										<button <?php if ($bActiveSubsription == false) { ?> class="hidden saveCampaign btn dark_btn h52 w100 bkg_purple pDisplayNoActiveSubscription" type="button" title="No Active Subscription" <?php } else { ?> class="hidden  saveCampaign btn dark_btn h52 w100 bkg_purple" type="submit" <?php } ?>> Save Campaign </button>
									</div>
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
                    <h6 class="panel-title">Statistic</h6>
					<div class="widget_view_change_menu">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li><a href="#Tabletver" data-toggle="tab"><i class="icon-tablet"></i> Tablet</a></li>
						<li><a href="#Phonever" data-toggle="tab"><i class="icon-mobile2"></i> Mobile</a></li>
						<li class="active"><a href="#Desktopver" data-toggle="tab"><i class="icon-display"></i> Desktop</a></li>
					  </ul>	
					</div>
				</div>
                <div class="panel-body p20">
					<div class="tab-content">
					<div class="tab-pane" id="Tabletver">
						<div class="widget_sec <?php echo $mainWigetClassName; ?>" id="bbColorOrientationSection">
							<!--========review_widget================-->
							<div class="tablet_box">
									<div class="tablet_box_bkg">
							<div class="bb_rw04 previewWidgetBox vpw <?php echo $alternative_design == 1 ? 'bbAlternetWidget' : ''; ?> <?php echo $widgetData->widget_position == 'bottom-right' ? 'bb_right_position' : ''; ?> <?php echo $widgetData->widget_type == 'vpw' ? '' : 'hidden'; ?>">
															
								<div class="bb_widget_main_container <?php echo ($widgetData->header_color_fix == '1' && $alternative_design != 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<button type="button" class="bb_close bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">×</button>
									
									<a class="bb_submit_button_white bb_widget_open_btn bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?> <?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
									
									<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
									<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
									<!--========RATING & BUTTONS========-->
									<div class="bb_pad20 bb_bbot rev_star_comment addCustomBGClass bb_custom_bg <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?> <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_rating_sec">
											<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
											<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
											<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_clear"></div>
									</div>
									
									
									<!--========COMMENT SEC========-->
									
									<div class="bb_comments_area review_main_box" style="">
										<div class="bb_inner_comment addCustomBGClass reviewSectionBox bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<div class="bb_review_details">
													<?php if($allow_video_reviews == 1){ ?>
														<video controls width="100%"><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/review_1beef4fc25c3eb6c9b4d3606f38aebbf2add535f.mp4" type="video/mp4"></video>
														<?php }else{ ?>
														<div class="bb_fleft bb_small_image_sec ">
															<img class="bb_img_enlagre showImgPopup" src="<?php echo base_url(); ?>assets/images/media_img4.jpg">
														</div>
														<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site</p>
													<?php } ?>
												</div>
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
											</div>
										</div>
										
										<div class="bb_inner_comment addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love...</p>
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 4 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
											</div>
										</div>
										
										<div class="bb_inner_comment addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page...</p>
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="bb_rw03 previewWidgetBox bfw bfwMain <?php echo ($widgetData->widget_type == 'bfw' && $alternative_design != 1) ? '' : 'hidden'; ?>">
								<button type="button" class="bb_close bb_custom_txt_color bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">×</button>
								
								<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
								</div>
								
								<div class="bb_clear"></div>
								<div class="bb_widget_main_container bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin: 0; border-radius: 0px;">
									
									<div class="bb_sldebutton">
										<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-left bb_custom_txt_color"></i></a>
										<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-right bb_custom_txt_color"></i></a>
									</div>
									
									
									<!--========RATING & BUTTONS========-->
									<div class="bb_top_header_sec">
										<div class="bb_rating_sec bb_fleft rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
											<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
											<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
											<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
											<div class="bb_clear"></div>
										</div>
										<!-- <div class="bb_button_area bb_fright">
											<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
											<button class="bb_btn bb_fright"><span class="bb_txt_grey">?</span> &nbsp;  Ask a Question</button>
										</div> -->
										<div class="bb_clear"></div>
									</div>
									
									
									<!--========COMMENT SEC========-->
									<div class="bb_comments_area">
										<div class="bb_small_comment_box">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<div style="margin-right: 15px; margin-bottom: 40px;" class="bb_fleft">
													<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
												</div>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a> </p>
												
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
										
										<div class="bb_small_comment_box">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
												
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
										
										<div class="bb_small_comment_box" style="border-right:none;">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<div style="margin-right: 15px; margin-bottom: 40px;" class="bb_fleft">
													<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
												</div>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
												
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
										
										<div class="bb_clear"></div>
									</div>
								</div>
							</div>						
							
							<div class="bb_rw03_1 previewWidgetBox bfw bfwAlternat <?php echo ($widgetData->widget_type == 'bfw' && $alternative_design == 1) ? '' : 'hidden'; ?>">
								
								<button type="button" class="bb_close bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">×</button>
								
								<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
								</div>
								
								<div class="bb_clear"></div>
								<div class="bb_white_box" style="margin: 0; border-radius: 0px;">
									
									<div class="bb_sldebutton">
										<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-left"></i></a>
										<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-right"></i></a>
									</div>
									
									<!--========COMMENT SEC========-->
									<div class="bb_comments_area">
										<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
												
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
										
										<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
												
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
										
										<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
												
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
										<div class="bb_clear"></div>
									</div>
								</div>
							</div>
							
							<div class="bb_rw02 previewWidgetBox cpw <?php echo $alternative_design == 1 ? 'bbAlternetWidget' : ''; ?> <?php echo $widgetData->widget_type == 'cpw' ? '' : 'hidden'; ?>">
								<button type="button" class="bb_close bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">×</button>							
								<div class="bb_widget_main_container bb_custom_txt_color <?php echo ($widgetData->header_color_fix == '1' && $alternative_design != 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<!--========RATING & BUTTONS========-->
									<div class="bb_pad30 addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_rating_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
											<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
											<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
											<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
											<div class="bb_clear"></div>
										</div>
										
										<div class="bb_progress_bar_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status green width85"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status green width55"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status grey width35"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status red width15"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status red width5"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_clear"></div>
										
										<!-- <div class="bb_button_area">
											<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
											<button class="bb_btn bb_fright">? &nbsp;  Ask a Question</button>
										</div> -->
										
										<!--========TAB MENU========-->
										<div class="bb_tab_box">
											<ul>
												<li><a class="active bb_custom_txt_color" href="javascript:void(0);">Product Reviews (275)</a></li>
												<li><a class="bb_custom_txt_color" href="javascript:void(0);">Site Reviews (24)</a></li>
												<li><a class="bb_custom_txt_color" href="javascript:void(0);">Service Reviews (24)</a></li>
											</ul>
										</div>
										
									</div>
									
									
									<!--========COMMENT SEC========-->
									<button style="border-radius: 100px; top:300px; position:absolute;" type="button" class="bb_close bbTopScrollCPA  bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" click-data="0"><i class="fa fa-angle-up bb_custom_txt_color"></i></button>
									<button style="border-radius: 100px; margin-top: 50px; top:300px; position:absolute;" type="button" class="bb_close bbBottomScrollCPA bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"  click-data="0"><i class="fa fa-angle-down bb_custom_txt_color"></i></button>
									<div class="bb_comments_area review_main_box">
										
										<div class="bb_pad30 addCustomBGClass bb_bbot reviewSectionBox bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">	
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>	
												<div class="bb_review_details">
													<?php if($allow_video_reviews == 1){ ?>
														<video controls width="100%"><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/review_1beef4fc25c3eb6c9b4d3606f38aebbf2add535f.mp4" type="video/mp4"></video>
														<?php }else{ ?>
														<div class="bb_fleft bb_small_image_sec ">
															<img class="bb_img_enlagre showImgPopup" src="<?php echo base_url(); ?>assets/images/media_img4.jpg">
														</div>
														<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful.</p>
													<?php } ?>
												</div>
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
										
										<div class="bb_pad30 addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											
											<div class="text_section">
												<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
												<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful</p>
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
											</div>
										</div>
									</div>
								</div>
								<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin-top:5px; margin-left:0px;">
									<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
								</div>
							</div>
							
							
							<div class="bb_rw05 previewWidgetBox rfw <?php echo $widgetData->widget_type == 'rfw' ? '' : 'hidden'; ?>">
								<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
								</div>
								<div class="bb_clear"></div>
								
								<div class="bb_feed_widget_rb bb_white_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
									<!--========RATING & BUTTONS========-->
									<div class="bbtop_sec">
										<div class="bb_rating_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
											<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
											<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
											<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status green width85"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status green width55"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status grey width35"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status red width15"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_progress_bar_inner">
												<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
												<div class="bb_progress">
													<div class="bb_progress_grey">
														<div class="bb_progress_status red width5"> </div>
													</div>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_button_area">
											<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
											<button class="bb_btn bb_fright">? &nbsp;  Ask a Question</button>
										</div>
										<div class="bb_clear"></div>
									</div>
									
									<!--========TAB MENU========-->
									<div class="bb_tab_box">
										<ul>
											<li><a class="active bb_custom_txt_color" href="javascript:void(0);">Product Reviews (275)</a></li>
											<li><a class="bb_custom_txt_color" href="javascript:void(0);">Site Reviews (24)</a></li>
											<li><a class="bb_custom_txt_color" href="javascript:void(0);">Service Reviews (24)</a></li>
										</ul>
									</div>
									<!--========COMMENT SEC========-->
									
									<div class="bb_comments_area review_main_box">
										<!-----------Comment 1 --------->
										<div class="box_1 reviewSectionBox">
											<div class="bb_comment_header">
												<div class="bb_avatar01">
													<i class="fa bb_check_green fa-check-circle"></i>
													<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png"/>
												</div>
												<div class="bb_fleft">
													<p class="bb_para bb_custom_txt_color"><strong>Amit Kumar</strong> </p>
													<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
												</div>
												<div class="bb_fleft">
													<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
													<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
												</div>
												<div class="bb_clear"></div>
											</div>
											<div class="text_section">
												<p class="bb_para bb_custom_txt_color">Showcase your customer&apos;s photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
												<div class="bb_comment_image">
													<a href="javascript:void(0)">
														<img class="bb_img_enlagre" src="<?php echo base_url(); ?>assets/images/media_img4.jpg" width="120">
													</a>
													<a href="javascript:void(0)">
														<img class="bb_img_enlagre" src="<?php echo base_url(); ?>assets/images/media_img5.jpg" width="120">
													</a>
												</div>
												
												<div class="bb_clear"></div> 
											</div>
											<div class="bb_comment_area">
												<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share bb_custom_txt_color"></i> &nbsp;  Share</a>
											</div>
											
											
											<!--===========================COMMENTS REPLY SECTION=========================-->	
											<div class="bb_comment_reply_sec rev_comment <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>">
												<div class="bb_inner_reply">
													<div class="bb_comment_header_small">
														<div class="bb_avatar_small">
															<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png"/>
														</div>
														<div class="bb_fleft">
															<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
														</div>
														<div class="bb_fleft">
															<p class="bb_para bb_custom_txt_color"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">3 month ago</span></p>
														</div>
														<div class="bb_clear"></div>
													</div>
													<div class="text_section_reply">
														<p class="bb_para bb_custom_txt_color">Being the savage&apos;s bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forward), it wa.</p>
													</div>
													<div class="bb_comment_area_reply">
														<a href="javascript:void(0);" class="bb_custom_txt_color">87</a>
														<a href="javascript:void(0);"><i class="fa fa-thumbs-up bb_custom_txt_color"></i></a>
														<a href="javascript:void(0);"><i class="fa fa-thumbs-down bb_custom_txt_color"></i></a>
														<a href="javascript:void(0);" class="bb_custom_txt_color">Reply</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="bb_rw01 previewWidgetBox bww bwwMain <?php echo ($widgetData->widget_type == 'bww' && $alternative_design != 1) ? '' : 'hidden'; ?> <?php echo $widgetData->widget_position == 'bottom-left' ? 'bb_left_position_bw' : ''; ?>">
								<div class="bb_white_box bb_pr_header01 bb_pad15 bb_widget_main_container_bw <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
									<div class="bb_fleft">
										<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
									</div>
									<div class="bb_custom_txt_color">
										<h3>Amazon Echo Dot<br>
										Smart Speaker</h3>
										<hr class="bb_hr">
										<p class="rev_star_comment bb_custom_txt_color <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> 4.76</p>
									</div>
									<div class="bb_clear"></div>
								</div>
								
								<div class="bb_white_box review_main_box bb_widget_main_container_bw <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
									<div class="reviewSectionBox">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												<i class="fa bb_check_green fa-check-circle"></i>
											</div>
											
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_pad25">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
										</div>
									</div>
								</div>
								
								<!-- <div class="bb_white_box bb_submit">
									<div class="bb_fleft">
									<input type="text" name="" placeholder="Add your review">
									</div>
									<div class="bb_fright">
									<input type="button" name="" value="">
									</div>
									
									<div class="bb_clear"></div>
								</div> -->
								
								<a class="bb_submit_button_blue bb_fright bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?> <?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
								<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
								<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
							</div>
							
							<div class="bb_rw01 previewWidgetBox bww bwwAlternat <?php echo ($widgetData->widget_type == 'bww' && $alternative_design == 1) ? '' : 'hidden'; ?> <?php echo $widgetData->widget_position == 'bottom-left' ? 'bb_left_position_bw' : ''; ?>">
								<div class="bb_pr_header01 bb_pad15 bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin-bottom:6px; border-radius: 5px;">
									<div class="bb_fleft">
										<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
									</div>
									<div class="bb_custom_txt_color">
										<h3>Amazon Echo Dot<br>
										Smart Speaker</h3>
										<hr class="bb_hr">
										<p class="rev_star_comment bb_custom_txt_color <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> 4.76</p>
									</div>
									<div class="bb_clear"></div>
								</div>
								<div class="bb_button_widget_rb review_main_box">
									<button style="border-radius: 100px; top:200px; left:-60px;" type="button" class="bb_close bbTopScrollCPA  bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" click-data="0"><i class="fa fa-angle-up bb_custom_txt_color"></i></button>
									<button style="border-radius: 100px; margin-top: 50px; top:200px; left:-60px;" type="button" class="bb_close bbBottomScrollCPA bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"  click-data="0"><i class="fa fa-angle-down bb_custom_txt_color"></i></button>
									<div class="bb_white_box bb_custom_bg reviewSectionBox <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												<i class="fa bb_check_green fa-check-circle"></i>
											</div>
											
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_pad25">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
										</div>
									</div>
									<div class="bb_white_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
												<i class="fa bb_check_green fa-check-circle"></i>
											</div>
											
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_pad25">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
										</div>
									</div>
								</div>							
								<a class="bb_submit_button_white bb_fright bb_custom_bg bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" href="javascript:void(0);" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"/></a>
								<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
								<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
							</div>
							
							
							<!-- <img class="w100" src="<?php echo base_url(); ?>assets/images/config_bkg_bk2_overlay.png"/> -->
						</div>
						</div>
						</div>
					
					</div>
					
					
					
					<div class="tab-pane" id="Phonever">
                    <div class="widget_sec <?php echo $mainWigetClassName; ?>" id="bbColorOrientationSection">
						<!--========review_widget================-->
						<div class="mobile_box">
									<div class="mobile_box_bkg">
						<div class="bb_rw04 previewWidgetBox vpw <?php echo $alternative_design == 1 ? 'bbAlternetWidget' : ''; ?> <?php echo $widgetData->widget_position == 'bottom-right' ? 'bb_right_position' : ''; ?> <?php echo $widgetData->widget_type == 'vpw' ? '' : 'hidden'; ?>">
														
							<div class="bb_widget_main_container <?php echo ($widgetData->header_color_fix == '1' && $alternative_design != 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<button type="button" class="bb_close bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">×</button>
								
								<a class="bb_submit_button_white bb_widget_open_btn bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?> <?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
								
								<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
								<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
								<!--========RATING & BUTTONS========-->
								<div class="bb_pad20 bb_bbot rev_star_comment addCustomBGClass bb_custom_bg <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?> <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_rating_sec">
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_clear"></div>
								</div>
								
								
								<!--========COMMENT SEC========-->
								
								<div class="bb_comments_area review_main_box" style="">
									<div class="bb_inner_comment addCustomBGClass reviewSectionBox bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<div class="bb_review_details">
												<?php if($allow_video_reviews == 1){ ?>
													<video controls width="100%"><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/review_1beef4fc25c3eb6c9b4d3606f38aebbf2add535f.mp4" type="video/mp4"></video>
													<?php }else{ ?>
													<div class="bb_fleft bb_small_image_sec ">
														<img class="bb_img_enlagre showImgPopup" src="<?php echo base_url(); ?>assets/images/media_img4.jpg">
													</div>
													<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site</p>
												<?php } ?>
											</div>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
										</div>
									</div>
									
									<div class="bb_inner_comment addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love...</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 4 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
										</div>
									</div>
									
									<div class="bb_inner_comment addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page...</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="bb_rw03 previewWidgetBox bfw bfwMain <?php echo ($widgetData->widget_type == 'bfw' && $alternative_design != 1) ? '' : 'hidden'; ?>">
							<button type="button" class="bb_close bb_custom_txt_color bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">×</button>
							
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
							
							<div class="bb_clear"></div>
							<div class="bb_widget_main_container bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin: 0; border-radius: 0px;">
								
								<div class="bb_sldebutton">
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-left bb_custom_txt_color"></i></a>
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-right bb_custom_txt_color"></i></a>
								</div>
								
								
								<!--========RATING & BUTTONS========-->
								<div class="bb_top_header_sec">
									<div class="bb_rating_sec bb_fleft rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									<!-- <div class="bb_button_area bb_fright">
										<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
										<button class="bb_btn bb_fright"><span class="bb_txt_grey">?</span> &nbsp;  Ask a Question</button>
									</div> -->
									<div class="bb_clear"></div>
								</div>
								
								
								<!--========COMMENT SEC========-->
								<div class="bb_comments_area">
									<div class="bb_small_comment_box">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<div style="margin-right: 15px; margin-bottom: 40px;" class="bb_fleft">
												<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
											</div>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a> </p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box" style="border-right:none;">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<div style="margin-right: 15px; margin-bottom: 40px;" class="bb_fleft">
												<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
											</div>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_clear"></div>
								</div>
							</div>
						</div>						
						
						<div class="bb_rw03_1 previewWidgetBox bfw bfwAlternat <?php echo ($widgetData->widget_type == 'bfw' && $alternative_design == 1) ? '' : 'hidden'; ?>">
							
							<button type="button" class="bb_close bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">×</button>
							
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
							
							<div class="bb_clear"></div>
							<div class="bb_white_box" style="margin: 0; border-radius: 0px;">
								
								<div class="bb_sldebutton">
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-left"></i></a>
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-right"></i></a>
								</div>
								
								<!--========COMMENT SEC========-->
								<div class="bb_comments_area">
									<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									<div class="bb_clear"></div>
								</div>
							</div>
						</div>
						
						<div class="bb_rw02 previewWidgetBox cpw <?php echo $alternative_design == 1 ? 'bbAlternetWidget' : ''; ?> <?php echo $widgetData->widget_type == 'cpw' ? '' : 'hidden'; ?>">
							<button type="button" class="bb_close bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">×</button>							
							<div class="bb_widget_main_container bb_custom_txt_color <?php echo ($widgetData->header_color_fix == '1' && $alternative_design != 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<!--========RATING & BUTTONS========-->
								<div class="bb_pad30 addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_rating_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									
									<div class="bb_progress_bar_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width85"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width55"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status grey width35"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width15"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width5"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_clear"></div>
									
									<!-- <div class="bb_button_area">
										<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
										<button class="bb_btn bb_fright">? &nbsp;  Ask a Question</button>
									</div> -->
									
									<!--========TAB MENU========-->
									<div class="bb_tab_box">
										<ul>
											<li><a class="active bb_custom_txt_color" href="javascript:void(0);">Product Reviews (275)</a></li>
											<li><a class="bb_custom_txt_color" href="javascript:void(0);">Site Reviews (24)</a></li>
											<li><a class="bb_custom_txt_color" href="javascript:void(0);">Service Reviews (24)</a></li>
										</ul>
									</div>
									
								</div>
								
								
								<!--========COMMENT SEC========-->
								<button style="border-radius: 100px; top:300px; position:absolute;" type="button" class="bb_close bbTopScrollCPA  bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" click-data="0"><i class="fa fa-angle-up bb_custom_txt_color"></i></button>
								<button style="border-radius: 100px; margin-top: 50px; top:300px; position:absolute;" type="button" class="bb_close bbBottomScrollCPA bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"  click-data="0"><i class="fa fa-angle-down bb_custom_txt_color"></i></button>
								<div class="bb_comments_area review_main_box">
									
									<div class="bb_pad30 addCustomBGClass bb_bbot reviewSectionBox bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">	
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>	
											<div class="bb_review_details">
												<?php if($allow_video_reviews == 1){ ?>
													<video controls width="100%"><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/review_1beef4fc25c3eb6c9b4d3606f38aebbf2add535f.mp4" type="video/mp4"></video>
													<?php }else{ ?>
													<div class="bb_fleft bb_small_image_sec ">
														<img class="bb_img_enlagre showImgPopup" src="<?php echo base_url(); ?>assets/images/media_img4.jpg">
													</div>
													<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful.</p>
												<?php } ?>
											</div>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_pad30 addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
								</div>
							</div>
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin-top:5px; margin-left:0px;">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
						</div>
						
						
						<div class="bb_rw05 previewWidgetBox rfw <?php echo $widgetData->widget_type == 'rfw' ? '' : 'hidden'; ?>">
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
							<div class="bb_clear"></div>
							
							<div class="bb_feed_widget_rb bb_white_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
								<!--========RATING & BUTTONS========-->
								<div class="bbtop_sec">
									<div class="bb_rating_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_progress_bar_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width85"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width55"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status grey width35"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width15"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width5"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_button_area">
										<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
										<button class="bb_btn bb_fright">? &nbsp;  Ask a Question</button>
									</div>
									<div class="bb_clear"></div>
								</div>
								
								<!--========TAB MENU========-->
								<div class="bb_tab_box">
									<ul>
										<li><a class="active bb_custom_txt_color" href="javascript:void(0);">Product Reviews (275)</a></li>
										<li><a class="bb_custom_txt_color" href="javascript:void(0);">Site Reviews (24)</a></li>
										<li><a class="bb_custom_txt_color" href="javascript:void(0);">Service Reviews (24)</a></li>
									</ul>
								</div>
								<!--========COMMENT SEC========-->
								
								<div class="bb_comments_area review_main_box">
									<!-----------Comment 1 --------->
									<div class="box_1 reviewSectionBox">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png"/>
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Amit Kumar</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="text_section">
											<p class="bb_para bb_custom_txt_color">Showcase your customer&apos;s photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
											<div class="bb_comment_image">
												<a href="javascript:void(0)">
													<img class="bb_img_enlagre" src="<?php echo base_url(); ?>assets/images/media_img4.jpg" width="120">
												</a>
												<a href="javascript:void(0)">
													<img class="bb_img_enlagre" src="<?php echo base_url(); ?>assets/images/media_img5.jpg" width="120">
												</a>
											</div>
											
											<div class="bb_clear"></div> 
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share bb_custom_txt_color"></i> &nbsp;  Share</a>
										</div>
										
										
										<!--===========================COMMENTS REPLY SECTION=========================-->	
										<div class="bb_comment_reply_sec rev_comment <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>">
											<div class="bb_inner_reply">
												<div class="bb_comment_header_small">
													<div class="bb_avatar_small">
														<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png"/>
													</div>
													<div class="bb_fleft">
														<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													</div>
													<div class="bb_fleft">
														<p class="bb_para bb_custom_txt_color"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">3 month ago</span></p>
													</div>
													<div class="bb_clear"></div>
												</div>
												<div class="text_section_reply">
													<p class="bb_para bb_custom_txt_color">Being the savage&apos;s bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forward), it wa.</p>
												</div>
												<div class="bb_comment_area_reply">
													<a href="javascript:void(0);" class="bb_custom_txt_color">87</a>
													<a href="javascript:void(0);"><i class="fa fa-thumbs-up bb_custom_txt_color"></i></a>
													<a href="javascript:void(0);"><i class="fa fa-thumbs-down bb_custom_txt_color"></i></a>
													<a href="javascript:void(0);" class="bb_custom_txt_color">Reply</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="bb_rw01 previewWidgetBox bww bwwMain <?php echo ($widgetData->widget_type == 'bww' && $alternative_design != 1) ? '' : 'hidden'; ?> <?php echo $widgetData->widget_position == 'bottom-left' ? 'bb_left_position_bw' : ''; ?>">
							<div class="bb_white_box bb_pr_header01 bb_pad15 bb_widget_main_container_bw <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
								<div class="bb_fleft">
									<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
								</div>
								<div class="bb_custom_txt_color">
									<h3>Amazon Echo Dot<br>
									Smart Speaker</h3>
									<hr class="bb_hr">
									<p class="rev_star_comment bb_custom_txt_color <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> 4.76</p>
								</div>
								<div class="bb_clear"></div>
							</div>
							
							<div class="bb_white_box review_main_box bb_widget_main_container_bw <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
								<div class="reviewSectionBox">
									<div class="bb_comment_header">
										<div class="bb_avatar01">
											<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											<i class="fa bb_check_green fa-check-circle"></i>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
											<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
											<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_pad25">
										<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
										<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									</div>
									<div class="bb_comment_area">
										<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
									</div>
								</div>
							</div>
							
							<!-- <div class="bb_white_box bb_submit">
								<div class="bb_fleft">
								<input type="text" name="" placeholder="Add your review">
								</div>
								<div class="bb_fright">
								<input type="button" name="" value="">
								</div>
								
								<div class="bb_clear"></div>
							</div> -->
							
							<a class="bb_submit_button_blue bb_fright bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?> <?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
							<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
							<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
						</div>
						
						<div class="bb_rw01 previewWidgetBox bww bwwAlternat <?php echo ($widgetData->widget_type == 'bww' && $alternative_design == 1) ? '' : 'hidden'; ?> <?php echo $widgetData->widget_position == 'bottom-left' ? 'bb_left_position_bw' : ''; ?>">
							<div class="bb_pr_header01 bb_pad15 bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin-bottom:6px; border-radius: 5px;">
								<div class="bb_fleft">
									<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
								</div>
								<div class="bb_custom_txt_color">
									<h3>Amazon Echo Dot<br>
									Smart Speaker</h3>
									<hr class="bb_hr">
									<p class="rev_star_comment bb_custom_txt_color <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> 4.76</p>
								</div>
								<div class="bb_clear"></div>
							</div>
							<div class="bb_button_widget_rb review_main_box">
								<button style="border-radius: 100px; top:200px; left:-60px;" type="button" class="bb_close bbTopScrollCPA  bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" click-data="0"><i class="fa fa-angle-up bb_custom_txt_color"></i></button>
								<button style="border-radius: 100px; margin-top: 50px; top:200px; left:-60px;" type="button" class="bb_close bbBottomScrollCPA bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"  click-data="0"><i class="fa fa-angle-down bb_custom_txt_color"></i></button>
								<div class="bb_white_box bb_custom_bg reviewSectionBox <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_comment_header">
										<div class="bb_avatar01">
											<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											<i class="fa bb_check_green fa-check-circle"></i>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
											<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
											<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_pad25">
										<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
										<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									</div>
									<div class="bb_comment_area">
										<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
									</div>
								</div>
								<div class="bb_white_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_comment_header">
										<div class="bb_avatar01">
											<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											<i class="fa bb_check_green fa-check-circle"></i>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
											<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
											<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_pad25">
										<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
										<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									</div>
									<div class="bb_comment_area">
										<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
									</div>
								</div>
							</div>							
							<a class="bb_submit_button_white bb_fright bb_custom_bg bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" href="javascript:void(0);" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"/></a>
							<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
							<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
						</div>
						
						
						<!-- <img class="w100" src="<?php echo base_url(); ?>assets/images/config_bkg_bk2_overlay.png"/> -->
					</div>
						</div>
						</div>
					</div>
					
					<div class="tab-pane active" id="Desktopver">
                    <div class="widget_sec <?php echo $mainWigetClassName; ?>" id="bbColorOrientationSection">
						<!--========review_widget================-->
						
						<div class="bb_rw04 previewWidgetBox vpw <?php echo $alternative_design == 1 ? 'bbAlternetWidget' : ''; ?> <?php echo $widgetData->widget_position == 'bottom-right' ? 'bb_right_position' : ''; ?> <?php echo $widgetData->widget_type == 'vpw' ? '' : 'hidden'; ?>">
														
							<div class="bb_widget_main_container <?php echo ($widgetData->header_color_fix == '1' && $alternative_design != 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<button type="button" class="bb_close bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">×</button>
								
								<a class="bb_submit_button_white bb_widget_open_btn bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?> <?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
								
								<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
								<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
								<!--========RATING & BUTTONS========-->
								<div class="bb_pad20 bb_bbot rev_star_comment addCustomBGClass bb_custom_bg <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?> <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_rating_sec">
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_clear"></div>
								</div>
								
								
								<!--========COMMENT SEC========-->
								
								<div class="bb_comments_area review_main_box" style="">
									<div class="bb_inner_comment addCustomBGClass reviewSectionBox bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<div class="bb_review_details">
												<?php if($allow_video_reviews == 1){ ?>
													<video controls width="100%"><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/review_1beef4fc25c3eb6c9b4d3606f38aebbf2add535f.mp4" type="video/mp4"></video>
													<?php }else{ ?>
													<div class="bb_fleft bb_small_image_sec ">
														<img class="bb_img_enlagre showImgPopup" src="<?php echo base_url(); ?>assets/images/media_img4.jpg">
													</div>
													<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site</p>
												<?php } ?>
											</div>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
										</div>
									</div>
									
									<div class="bb_inner_comment addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love...</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 4 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
										</div>
									</div>
									
									<div class="bb_inner_comment addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page...</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>"><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="bb_rw03 previewWidgetBox bfw bfwMain <?php echo ($widgetData->widget_type == 'bfw' && $alternative_design != 1) ? '' : 'hidden'; ?>">
							<button type="button" class="bb_close bb_custom_txt_color bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">×</button>
							
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
							
							<div class="bb_clear"></div>
							<div class="bb_widget_main_container bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin: 0; border-radius: 0px;">
								
								<div class="bb_sldebutton">
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-left bb_custom_txt_color"></i></a>
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-right bb_custom_txt_color"></i></a>
								</div>
								
								
								<!--========RATING & BUTTONS========-->
								<div class="bb_top_header_sec">
									<div class="bb_rating_sec bb_fleft rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									<!-- <div class="bb_button_area bb_fright">
										<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
										<button class="bb_btn bb_fright"><span class="bb_txt_grey">?</span> &nbsp;  Ask a Question</button>
									</div> -->
									<div class="bb_clear"></div>
								</div>
								
								
								<!--========COMMENT SEC========-->
								<div class="bb_comments_area">
									<div class="bb_small_comment_box">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<div style="margin-right: 15px; margin-bottom: 40px;" class="bb_fleft">
												<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
											</div>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a> </p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box" style="border-right:none;">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<div style="margin-right: 15px; margin-bottom: 40px;" class="bb_fleft">
												<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
											</div>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_clear"></div>
								</div>
							</div>
						</div>						
						
						<div class="bb_rw03_1 previewWidgetBox bfw bfwAlternat <?php echo ($widgetData->widget_type == 'bfw' && $alternative_design == 1) ? '' : 'hidden'; ?>">
							
							<button type="button" class="bb_close bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">×</button>
							
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
							
							<div class="bb_clear"></div>
							<div class="bb_white_box" style="margin: 0; border-radius: 0px;">
								
								<div class="bb_sldebutton">
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-left"></i></a>
									<a href="javascript:void(0);" class="bb_slide_btn bb_custom_bg bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"><i class="fa fa-angle-right"></i></a>
								</div>
								
								<!--========COMMENT SEC========-->
								<div class="bb_comments_area">
									<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_small_comment_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal  <a class="bb_txt_blue" href="javascript:void(0);">Read more...</a></p>
											
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span>  <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									<div class="bb_clear"></div>
								</div>
							</div>
						</div>
						
						<div class="bb_rw02 previewWidgetBox cpw <?php echo $alternative_design == 1 ? 'bbAlternetWidget' : ''; ?> <?php echo $widgetData->widget_type == 'cpw' ? '' : 'hidden'; ?>">
							<button type="button" class="bb_close bb_custom_txt_color <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">×</button>							
							<div class="bb_widget_main_container bb_custom_txt_color <?php echo ($widgetData->header_color_fix == '1' && $alternative_design != 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<!--========RATING & BUTTONS========-->
								<div class="bb_pad30 addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_rating_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<p class="bb_para"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									
									<div class="bb_progress_bar_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width85"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width55"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status grey width35"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width15"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width5"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_clear"></div>
									
									<!-- <div class="bb_button_area">
										<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
										<button class="bb_btn bb_fright">? &nbsp;  Ask a Question</button>
									</div> -->
									
									<!--========TAB MENU========-->
									<div class="bb_tab_box">
										<ul>
											<li><a class="active bb_custom_txt_color" href="javascript:void(0);">Product Reviews (275)</a></li>
											<li><a class="bb_custom_txt_color" href="javascript:void(0);">Site Reviews (24)</a></li>
											<li><a class="bb_custom_txt_color" href="javascript:void(0);">Service Reviews (24)</a></li>
										</ul>
									</div>
									
								</div>
								
								
								<!--========COMMENT SEC========-->
								<button style="border-radius: 100px; top:300px; position:absolute;" type="button" class="bb_close bbTopScrollCPA  bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" click-data="0"><i class="fa fa-angle-up bb_custom_txt_color"></i></button>
								<button style="border-radius: 100px; margin-top: 50px; top:300px; position:absolute;" type="button" class="bb_close bbBottomScrollCPA bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"  click-data="0"><i class="fa fa-angle-down bb_custom_txt_color"></i></button>
								<div class="bb_comments_area review_main_box">
									
									<div class="bb_pad30 addCustomBGClass bb_bbot reviewSectionBox bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">	
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>	
											<div class="bb_review_details">
												<?php if($allow_video_reviews == 1){ ?>
													<video controls width="100%"><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/review_1beef4fc25c3eb6c9b4d3606f38aebbf2add535f.mp4" type="video/mp4"></video>
													<?php }else{ ?>
													<div class="bb_fleft bb_small_image_sec ">
														<img class="bb_img_enlagre showImgPopup" src="<?php echo base_url(); ?>assets/images/media_img4.jpg">
													</div>
													<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful.</p>
												<?php } ?>
											</div>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
									
									<div class="bb_pad30 addCustomBGClass bb_custom_bg <?php echo ($widgetData->header_color_fix == '1' && $alternative_design == 1) ? $widgetData->header_color . '_preview_1' : ''; ?>">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png">
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Carlos Alvarado</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">3.5/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										
										<div class="text_section">
											<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
											<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful</p>
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share"></i> &nbsp;  Share</a>
										</div>
									</div>
								</div>
							</div>
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin-top:5px; margin-left:0px;">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
						</div>
						
						
						<div class="bb_rw05 previewWidgetBox rfw <?php echo $widgetData->widget_type == 'rfw' ? '' : 'hidden'; ?>">
							<div class="bb_top_button_powered bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
								<a class="" href="#"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt bb_custom_txt_color">Powered by BrandBoost.io</span></a>
							</div>
							<div class="bb_clear"></div>
							
							<div class="bb_feed_widget_rb bb_white_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
								<!--========RATING & BUTTONS========-->
								<div class="bbtop_sec">
									<div class="bb_rating_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<h3 class="bb_custom_txt_color">4.76<span class="bb_custom_txt_color">/5</span></h3>
										<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> </p>
										<h4 class="bb_custom_txt_color">Based on 275 reviews</h4>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_progress_bar_sec rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>">
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width85"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status green width55"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status grey width35"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width15"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_progress_bar_inner">
											<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
											<div class="bb_progress">
												<div class="bb_progress_grey">
													<div class="bb_progress_status red width5"> </div>
												</div>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_button_area">
										<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
										<button class="bb_btn bb_fright">? &nbsp;  Ask a Question</button>
									</div>
									<div class="bb_clear"></div>
								</div>
								
								<!--========TAB MENU========-->
								<div class="bb_tab_box">
									<ul>
										<li><a class="active bb_custom_txt_color" href="javascript:void(0);">Product Reviews (275)</a></li>
										<li><a class="bb_custom_txt_color" href="javascript:void(0);">Site Reviews (24)</a></li>
										<li><a class="bb_custom_txt_color" href="javascript:void(0);">Service Reviews (24)</a></li>
									</ul>
								</div>
								<!--========COMMENT SEC========-->
								
								<div class="bb_comments_area review_main_box">
									<!-----------Comment 1 --------->
									<div class="box_1 reviewSectionBox">
										<div class="bb_comment_header">
											<div class="bb_avatar01">
												<i class="fa bb_check_green fa-check-circle"></i>
												<img src="<?php echo base_url(); ?>assets/images/widget/cust1.png"/>
											</div>
											<div class="bb_fleft">
												<p class="bb_para bb_custom_txt_color"><strong>Amit Kumar</strong> </p>
												<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
											</div>
											<div class="bb_fleft">
												<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
												<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
											</div>
											<div class="bb_clear"></div>
										</div>
										<div class="text_section">
											<p class="bb_para bb_custom_txt_color">Showcase your customer&apos;s photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
											<div class="bb_comment_image">
												<a href="javascript:void(0)">
													<img class="bb_img_enlagre" src="<?php echo base_url(); ?>assets/images/media_img4.jpg" width="120">
												</a>
												<a href="javascript:void(0)">
													<img class="bb_img_enlagre" src="<?php echo base_url(); ?>assets/images/media_img5.jpg" width="120">
												</a>
											</div>
											
											<div class="bb_clear"></div> 
										</div>
										<div class="bb_comment_area">
											<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <span class="rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>"><a href="javascript:void(0);" class="bb_custom_txt_color">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a></span> <a class="bb_fright bb_share_btn bb_custom_txt_color" href="javascript:void(0);"><i class="fa fa-share bb_custom_txt_color"></i> &nbsp;  Share</a>
										</div>
										
										
										<!--===========================COMMENTS REPLY SECTION=========================-->	
										<div class="bb_comment_reply_sec rev_comment <?php echo $allow_comments == '1' ? '' : 'hidden'; ?>">
											<div class="bb_inner_reply">
												<div class="bb_comment_header_small">
													<div class="bb_avatar_small">
														<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png"/>
													</div>
													<div class="bb_fleft">
														<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
													</div>
													<div class="bb_fleft">
														<p class="bb_para bb_custom_txt_color"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">3 month ago</span></p>
													</div>
													<div class="bb_clear"></div>
												</div>
												<div class="text_section_reply">
													<p class="bb_para bb_custom_txt_color">Being the savage&apos;s bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forward), it wa.</p>
												</div>
												<div class="bb_comment_area_reply">
													<a href="javascript:void(0);" class="bb_custom_txt_color">87</a>
													<a href="javascript:void(0);"><i class="fa fa-thumbs-up bb_custom_txt_color"></i></a>
													<a href="javascript:void(0);"><i class="fa fa-thumbs-down bb_custom_txt_color"></i></a>
													<a href="javascript:void(0);" class="bb_custom_txt_color">Reply</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="bb_rw01 previewWidgetBox bww bwwMain <?php echo ($widgetData->widget_type == 'bww' && $alternative_design != 1) ? '' : 'hidden'; ?> <?php echo $widgetData->widget_position == 'bottom-left' ? 'bb_left_position_bw' : ''; ?>">
							<div class="bb_white_box bb_pr_header01 bb_pad15 bb_widget_main_container_bw <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
								<div class="bb_fleft">
									<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
								</div>
								<div class="bb_custom_txt_color">
									<h3>Amazon Echo Dot<br>
									Smart Speaker</h3>
									<hr class="bb_hr">
									<p class="rev_star_comment bb_custom_txt_color <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> 4.76</p>
								</div>
								<div class="bb_clear"></div>
							</div>
							
							<div class="bb_white_box review_main_box bb_widget_main_container_bw <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>">
								<div class="reviewSectionBox">
									<div class="bb_comment_header">
										<div class="bb_avatar01">
											<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											<i class="fa bb_check_green fa-check-circle"></i>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
											<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
											<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_pad25">
										<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
										<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									</div>
									<div class="bb_comment_area">
										<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
									</div>
								</div>
							</div>
							
							<!-- <div class="bb_white_box bb_submit">
								<div class="bb_fleft">
								<input type="text" name="" placeholder="Add your review">
								</div>
								<div class="bb_fright">
								<input type="button" name="" value="">
								</div>
								
								<div class="bb_clear"></div>
							</div> -->
							
							<a class="bb_submit_button_blue bb_fright bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?> <?php echo $widgetData->header_color_solid == '1' ? 'background:' . $widgetData->header_solid_color : ''; ?> <?php if($colorOrientation == 'circle'){ echo $widgetData->header_color_custom == '1' ? 'background-image:radial-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; }else{ echo $widgetData->header_color_custom == '1' ? 'background-image:linear-gradient('.$colorOrientation.', ' . $widgetData->header_custom_color1 . ' 1%, ' . $widgetData->header_custom_color2 . ')' : ''; } ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
							<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
							<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
						</div>
						
						<div class="bb_rw01 previewWidgetBox bww bwwAlternat <?php echo ($widgetData->widget_type == 'bww' && $alternative_design == 1) ? '' : 'hidden'; ?> <?php echo $widgetData->widget_position == 'bottom-left' ? 'bb_left_position_bw' : ''; ?>">
							<div class="bb_pr_header01 bb_pad15 bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" style="margin-bottom:6px; border-radius: 5px;">
								<div class="bb_fleft">
									<img class="bb_br5" src="<?php echo base_url(); ?>assets/images/widget/shoes_img.jpg" width="75">
								</div>
								<div class="bb_custom_txt_color">
									<h3>Amazon Echo Dot<br>
									Smart Speaker</h3>
									<hr class="bb_hr">
									<p class="rev_star_comment bb_custom_txt_color <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> 4.76</p>
								</div>
								<div class="bb_clear"></div>
							</div>
							<div class="bb_button_widget_rb review_main_box">
								<button style="border-radius: 100px; top:200px; left:-60px;" type="button" class="bb_close bbTopScrollCPA  bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" click-data="0"><i class="fa fa-angle-up bb_custom_txt_color"></i></button>
								<button style="border-radius: 100px; margin-top: 50px; top:200px; left:-60px;" type="button" class="bb_close bbBottomScrollCPA bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>"  click-data="0"><i class="fa fa-angle-down bb_custom_txt_color"></i></button>
								<div class="bb_white_box bb_custom_bg reviewSectionBox <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_comment_header">
										<div class="bb_avatar01">
											<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											<i class="fa bb_check_green fa-check-circle"></i>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
											<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
											<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_pad25">
										<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
										<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									</div>
									<div class="bb_comment_area">
										<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
									</div>
								</div>
								<div class="bb_white_box bb_custom_bg <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>">
									<div class="bb_comment_header">
										<div class="bb_avatar01">
											<img src="<?php echo base_url(); ?>assets/images/widget/cust2.png">
											<i class="fa bb_check_green fa-check-circle"></i>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para bb_custom_txt_color"><strong>Jack Richardson</strong> </p>
											<p class="bb_para rev_star_comment <?php echo $allow_comment_ratings != '0' ? '' : 'hidden'; ?>"><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i><i class="fa fa-star bb_txt_yellow"></i> <span class="bb_thingrey bb_custom_txt_color">4.1/5</span> </p>
										</div>
										
										<div class="bb_fleft">
											<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">Verified</span></p>
											<p class="bb_para rev_comment_date <?php echo $allow_review_timestamp != '0' ? '' : 'hidden'; ?>"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_txt_color">27 March 2018</span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="bb_pad25">
										<p class="bb_para heading_txt bb_custom_txt_color">Widget heading text...</p>
										<p class="bb_para bb_custom_txt_color">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
									</div>
									<div class="bb_comment_area">
										<a href="javascript:void(0);" class="rev_comment bb_custom_txt_color "><i class="icon-bubble txt_grey bb_custom_txt_color"></i>&nbsp; 3 comments</a> <a href="javascript:void(0);" class="rev_feedback bb_custom_txt_color <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>">32 found this helpful</a> <a class="bb_like_dislike bb_txt_green rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a> <a class="bb_like_dislike bb_txt_red rev_feedback <?php echo $allow_helpful_feedback != '0' ? '' : 'hidden'; ?>" href="javascript:void(0);"><i class="fa fa-thumbs-down"></i></a>
									</div>
								</div>
							</div>							
							<a class="bb_submit_button_white bb_fright bb_custom_bg bbDefaultButton <?php echo $widgetData->header_color_fix == '1' ? $widgetData->header_color . '_preview_1' : ''; ?>" href="javascript:void(0);" style="<?php echo ($widgetData->icon_type  == 'default' || $widgetData->icon_type  == '') ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"/></a>
							<a class="bb_submit_button_white bb_fright bbDarkButton" style="<?php echo $widgetData->icon_type  == 'dark' ? '' : 'display:none;'; ?>" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icon_transparent.png"></a>
							<a class="bb_submit_button_white bb_fright bbLightButton" href="javascript:void(0);" style="<?php echo $widgetData->icon_type  == 'light' ? '' : 'display:none;'; ?>"><img src="<?php echo base_url(); ?>assets/images/widget/bb_icons_2.png"></a>
						</div>
						
						
						<img class="w100" src="<?php echo base_url(); ?>assets/images/config_bkg_bk2_overlay.png"/>
					</div>
					
					</div>
					
					</div>
				</div>
			</div>
		</div>
		<!-- 
			<div class="col-md-12 text-right">
			<button type="submit" class="btn dark_btn mt20" onclick='changeTab("Integration");'> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
			</div>
		-->
	</div>
</div>

<div id="campaignPreview" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Campaign Preview</h5>
			</div>
			
            <div class="modal-body" id="previewDiv">
                <iframe src="" id="previewIframe" style="border:none; height:550px;"></iframe>
			</div>
			
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div id="campaignPWPreview"></div>

<div id="reviewImagePopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">		
            <div class="modal-body" id="reviewImgPopup" style="text-align:center;">
                
			</div>
			
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {
		var scrollVal = 280;
		if(bbwpReviewType == 'bww'){ scrollVal = 352; }
		var clickData = 0;
		var newScrollVal = 0;
		$(document).on('click', '.bbTopScrollCPA', function(){
			clickData = $(this).attr('click-data');
			if(clickData == -1){ clickData = 0; }
			if(clickData >= 0){
				++clickData;
				newScrollVal = clickData * scrollVal;
				if(bbwpReviewType != 'bww'){
					$('.cpw .bb_comments_area').animate({
						scrollTop: newScrollVal
					}, 1000);
					}else{
					$('.bww .bb_button_widget_rb').animate({
						scrollTop: newScrollVal
					}, 1000);
				}
				
				$('.bbTopScrollCPA').attr('click-data', clickData);
				$('.bbBottomScrollCPA').attr('click-data', clickData);
			}
		});
		
		$(document).on('click', '.bbBottomScrollCPA', function(){
			clickData = $(this).attr('click-data');
			if(clickData >= 0){
				--clickData;
				newScrollVal = clickData * scrollVal;
				
				if(bbwpReviewType != 'bww'){
					$('.cpw .bb_comments_area').animate({
						scrollTop: newScrollVal
					}, 1000);
					}else{
					$('.bww .bb_button_widget_rb').animate({
						scrollTop: newScrollVal
					}, 1000);
				}
				
				$('.bbTopScrollCPA').attr('click-data', clickData);
				$('.bbBottomScrollCPA').attr('click-data', clickData);
			}
		});
		
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
			
            if ($('#alternative_design').prop("checked") == false) {
				if($('#widget_bgcolor_switch').val() == 2){	
					if(orientationVal == 'circle'){
						$('.previewWidgetBox .bb_widget_main_container, .bb_close, .bb_feed_widget_rb').css('background-image', 'radial-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}else{
						$('.previewWidgetBox .bb_widget_main_container, .bb_close, .bb_feed_widget_rb').css('background-image', 'linear-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}
					$('.previewWidgetBox .addCustomBGClass').css('background-image', '');
				}
			} else {
				if($('#widget_bgcolor_switch').val() == 2){
					$('.previewWidgetBox .bb_widget_main_container, .bb_close, .bb_feed_widget_rb').css('background-image', '');
					if(orientationVal == 'circle'){
						$('.previewWidgetBox .addCustomBGClass, .bb_feed_widget_rb').css('background-image', 'radial-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}else{
						$('.previewWidgetBox .addCustomBGClass, .bb_feed_widget_rb').css('background-image', 'linear-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}
				}
			}
			$('.saveWidgetDesign').trigger('click');
		});
		
		$("#newcampaign").click(function(){
            $(".box").animate({
                width: "toggle"
            });
			
			$('.smart-widget-type-box .review_source_new .inner').removeClass('active');
			$('.smart-widget-type-box .'+bbwpReviewType+'CWBox .inner').addClass('active');
			$('.smart-widget-type-box .'+bbwpReviewType+'CWBox .inner input.selectwidget1').prop('checked', 'checked');
        });
		
		if(bbwpReviewType == 'bww'){ 
			$("#newcampaign span").text('Small Popup'); 
			$(".widgetPosition, .widgetIcon").show();
			$("#widgetPositionVal").hide();
		}
		if(bbwpReviewType == 'bfw'){ 
			$("#newcampaign span").text('Horizontal Popup'); 
			$(".widgetPosition, .widgetIcon").hide();
			$("#widgetPositionVal").show().val('Bottom');
		}
		if(bbwpReviewType == 'cpw'){ 
			$("#newcampaign span").text('Center Popup'); 
			$(".widgetPosition, .widgetIcon").hide();
			$("#widgetPositionVal").show().val('Center');
		}
		if(bbwpReviewType == 'vpw'){ 
			$("#newcampaign span").text('Vertical Popup'); 
			$(".widgetPosition, .widgetIcon").show();
			$("#widgetPositionVal").hide();
		}
		if(bbwpReviewType == 'rfw'){ 
			$("#newcampaign span").text('Embeded Reviews'); 
			$(".widgetPosition, .widgetIcon").hide();
			$("#widgetPositionVal").show();
		}
		
		
		$(document).on('click', '.showImgPopup, .text_section img', function() {
			if(bbwpReviewType != 'rfw'){
				var imgURL = $(this).attr('src');
				$('#reviewImgPopup').html('<img src="'+imgURL+'" style="width:100%; height:auto;">');
				$('#reviewImagePopup').modal('show');
				}else{
				if($(this).hasClass('enlarged')){
					$(this).removeClass('enlarged');
					$(this).stop().animate({width: 120, height: 78}, 200 );
					}else{
					$(this).addClass('enlarged')
					$(this).stop().animate({width: 333, height: 225}, 200 );
				}
			}
		});
		
		$('#frmsaveCustomWidgetTheme').on('submit', function (e) {
            e.preventDefault();
			
            //$('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/createBrandBoostWidgetTheme",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
						var currentWidgetId = data.current_widget_id;
						displayMessagePopup();
						$('#widget_themes').append('<option value="' + currentWidgetId + '" selected>' + $('#widget_theme_title').val() + '</option>');
						$('#widget_theme_title').val('');
						} else {
						displayMessagePopup('error');
					}
				}
			});
		});
		
		$(document).on('change', '#widget_themes', function(){
			var themeID = $(this).val();
			if(themeID != ''){
				$.ajax({
					url: "<?php echo base_url(); ?>/admin/brandboost/getWidgetThemeData/"+themeID,
					method: "POST",
					data: {_token: '{{csrf_token()}}'},
					dataType: "json",
					success: function (data)
					{
						if (data.status == "ok")
						{
							var themeData = data.themeData;
							var fixColorAllow = themeData.header_color_fix;
							var solidColorAllow = themeData.header_color_solid;
							var customColorAllow = themeData.header_color_custom;
							var themeMainColor = themeData.header_color;
							var themeCustomColor1 = themeData.header_custom_color1;
							var colorOrientation = themeData.color_orientation;
							var themeCustomColor2 = themeData.header_custom_color2;
							var themeSolidColor = themeData.header_solid_color;
							var themeRatingColor = themeData.rating_color;	
							var themeRatingCustomColor1 = themeData.rating_custom_color1;
							var themeRatingCustomColor2 = themeData.rating_custom_color2;
							var themeRatingSolidColor = themeData.rating_solid_color;
							var themeRatingColorAllow = themeData.rating_color_fix;
							var themeFontColor = themeData.widget_font_color;
							var themeBorderColor = themeData.widget_border_color;
							var widgetPosition = themeData.widget_position;
							var orientationVal= themeData.color_orientation;
							
														
							if(themeFontColor != ''){
								$('.bb_custom_txt_color').attr('style', 'color:' + themeFontColor + '!important');
								$('.fontcolorpicker i').attr('style', 'color:' + themeFontColor + '!important');
								$('#widget_font_color').val(themeFontColor);
								$('#theme_widget_font_color').val(themeFontColor);
							}
							
							if(themeBorderColor != ''){
								$('.bb_tab_box, .bb_comment_header, .bb_rating_sec, .bb_like_dislike, .bb_top_header_sec, .bb_small_comment_box, .bb_inner_reply, .bb_bbot, .box_1').css('border-color', themeBorderColor);
								$('.bordercolorpicker i').attr('style', 'color:' + themeBorderColor + '!important');
								$('#widget_border_color').val(themeBorderColor);
								$('#theme_widget_border_color').val(themeBorderColor);
							}
							
							if(themeRatingSolidColor != ''){
								$('.rev_star_comment .fa-star').css('color', themeRatingSolidColor);
								$('.solidcolorpickerRating i').attr('style', 'color:' + themeRatingSolidColor + '!important');
								$('#solid_color_rating').val(themeRatingSolidColor);
								$('#theme_solid_color_rating').val(themeRatingSolidColor);
							}
							
							if(fixColorAllow == 1){
								$('#bbColorOrientationSection').removeClass('toRightTop');
								$('#bbColorOrientationSection').removeClass('toRight');
								$('#bbColorOrientationSection').removeClass('toRightBottom');
								$('#bbColorOrientationSection').removeClass('toBottom');
								$('#bbColorOrientationSection').removeClass('toLeftBottom');
								$('#bbColorOrientationSection').removeClass('toLeft');
								$('#bbColorOrientationSection').removeClass('toLeftTop');
								$('#bbColorOrientationSection').removeClass('toTop');
								$('#bbColorOrientationSection').removeClass('orientationCircle');
								
								var mainWigetClassName = "toBottom";
								if(orientationVal == 'to right top'){
									mainWigetClassName = "toRightTop";
								}else if(orientationVal == 'to right'){
									mainWigetClassName = "toRight";
								}else if(orientationVal == 'to right bottom'){
									mainWigetClassName = "toRightBottom";
								}else if(orientationVal == 'to left bottom'){
									mainWigetClassName = "toLeftBottom";
								}else if(orientationVal == 'to left'){
									mainWigetClassName = "toLeft";
								}else if(orientationVal == 'to left top'){
									mainWigetClassName = "toLeftTop";
								}else if(orientationVal == 'to top'){
									mainWigetClassName = "toTop";
								}else if(orientationVal == 'circle'){
									mainWigetClassName = "orientationCircle";
								}
								
								$('#bbColorOrientationSection').addClass(mainWigetClassName);
								$('#color_orientation').val(orientationVal);
								
								$('#widget_bgcolor_switch, #theme_bg_color_switch').val(1);
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('white_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('red_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('yellow_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('orange_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('green_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('blue_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('purple_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', '');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background', '');
								$('#main_color_switch').prop("checked", true);
								$('.widgetSingleColorBox').hide();
								$('.widgetMultiColorBox').show();
								$('.selectMainColor[color-data="'+themeMainColor+'"]').click();
							}
							
							if(customColorAllow ==  1){
								$('#widget_bgcolor_switch, #theme_bg_color_switch').val(2);
								$('#main_color_switch').prop("checked", true);
								$('.widgetSingleColorBox').hide();
								$('.widgetMultiColorBox').show();
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('white_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('red_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('yellow_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('orange_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('green_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('blue_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('purple_preview_1');
								
								if(colorOrientation == 'circle'){
									$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', 'radial-gradient('+colorOrientation+', ' + themeCustomColor1 + ' 1%, ' + themeCustomColor2 + ')');
								}else{
									$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', 'linear-gradient('+colorOrientation+', ' + themeCustomColor1 + ' 1%, ' + themeCustomColor2 + ')');
								}
							}
							
							if(solidColorAllow ==  1){
								$('#widget_bgcolor_switch, #theme_bg_color_switch').val(3);
								$('#main_color_switch').prop("checked", false);
								$('.widgetSingleColorBox').show();
								$('.widgetMultiColorBox').hide();
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('white_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('red_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('yellow_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('orange_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('green_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('blue_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('purple_preview_1');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', '');
								$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background', themeSolidColor);
								$('#solid_color').val(themeSolidColor);
								$('.solidcolorpicker i').css('color', themeSolidColor);
							}
							
							
							setTimeout(function(){
								if ($('#alternative_design').prop("checked") === false) {
									$('.previewWidgetBox .bb_widget_main_container').addClass('bb_custom_bg');
									$('.previewWidgetBox .bb_widget_main_container, .previewWidgetBox .bb_widget_main_container_bw').addClass(bgColor);
								} else {
									$('.previewWidgetBox .bb_widget_main_container').removeClass('bb_custom_bg');
									$('.previewWidgetBox .bb_widget_main_container, .previewWidgetBox .bb_widget_main_container_bw').removeClass(bgColor);
								}
							}, 400);
							
							if ($('#alternative_design').prop("checked") == false) {
								if($('#widget_bgcolor_switch').val() == 2){
									if(orientationVal == 'circle'){
										$('.previewWidgetBox .bb_widget_main_container, .bb_close').css('background-image', 'radial-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
									}else{
										$('.previewWidgetBox .bb_widget_main_container, .bb_close').css('background-image', 'linear-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
									}
									$('.previewWidgetBox .addCustomBGClass').css('background-image', '');
								}
							} else {
								if($('#widget_bgcolor_switch').val() == 2){
									$('.previewWidgetBox .bb_widget_main_container, .bb_close').css('background-image', '');
									if(orientationVal == 'circle'){
										$('.previewWidgetBox .addCustomBGClass').css('background-image', 'radial-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
									}else{
										$('.previewWidgetBox .addCustomBGClass').css('background-image', 'linear-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
									}
								}
							}
							
							
							$('.saveWidgetDesign').trigger('click');
						} else {
							displayMessagePopup('error');
						}
					}
				});
			}		
		});
		
		$(document).on('change', '#widget_position', function(){
			if($(this).val() == 'bottom-right'){
				$('.bb_rw04').addClass('bb_right_position');
				$('.bb_rw01').removeClass('bb_left_position_bw');
				}else{
				$('.bb_rw04').removeClass('bb_right_position');
				$('.bb_rw01').addClass('bb_left_position_bw');
			}
		});
		
		$(document).on('change', '#icon_type', function(){
			if($(this).val() == 'dark'){
				$('.bbDarkButton').show();
				$('.bbLightButton').hide();
				$('.bbDefaultButton').hide();
			}else if($(this).val() == 'light'){
				$('.bbDarkButton').hide();
				$('.bbLightButton').show();
				$('.bbDefaultButton').hide();
			}else{
				$('.bbDarkButton').hide();
				$('.bbLightButton').hide();
				$('.bbDefaultButton').show();
			}			
		});
		
        var bg_color = $('#bg_color').val();
        var text_color = $('#text_color').val();
		
		$("#ratingValue").TouchSpin({
			verticalbuttons: true,
			verticalupclass: 'icon-arrow-up5',
			verticaldownclass: 'icon-arrow-down5',
			min: 0, 
			max: 5
		});
		
		$("#numofrev").TouchSpin({
			verticalbuttons: true,
			verticalupclass: 'icon-arrow-up5',
			verticaldownclass: 'icon-arrow-down5',
			min: 1, 
			max: 10
		});
		
		$(".touchspin-vertical").TouchSpin({
			verticalbuttons: true,
			verticalupclass: 'icon-arrow-up5',
			verticaldownclass: 'icon-arrow-down5',
			min: 0, 
			max: 10
		});
		
		
        $(document).on('click', '.checkedBoxValue', function () {
            var previewFname = $(this).attr('preview_fname');
            if ($(this).prop('checked'))
            {
                $(this).val('1');
                $('.' + previewFname).show();
                savePreviewData(previewFname, 1);
				} else {
                $(this).val('0');
                $('.' + previewFname).hide();
                savePreviewData(previewFname, 0);
			}
		});
		
        $('.widgetType').change(function () {
            var widgetType = $(this).val();
            if ($(this).prop('checked'))
            {
                $('.showPreview_' + widgetType).show();
				} else {
                $('.showPreview_' + widgetType).hide();
			}
		});
		
        var showPW = '';
        $(document).on('click', '.removePW', function (e) {
            showPW = 1;
            $(".bb.main-widget").hide();
            $(this).removeClass('removePW');
            $(this).addClass('showPreview');
		});
		
        $(document).on('click', '.showPreview', function (e) {
            var widgetType = $(this).attr('widget_type');
            var thisVal = $(this);
            var bgColor = $('#bg_color').val();
            var textColor = $('#text_color').val();
            if (widgetType == 'pw') {
                $.ajax({
                    url: "<?php echo base_url(); ?>/admin/brandboost/showPWPreview",
                    method: "POST",
                    data: {'hashcode': '<?php echo $hashcodeBB; ?>', 'widget_type': widgetType, _token: '{{csrf_token()}}'},
                    dataType: "html",
                    success: function (data)
                    {
                        if (showPW == '') {
                            $("#campaignPWPreview").html(data);
							} else {
                            $(".bb.main-widget").show();
						}
						
                        thisVal.addClass('removePW');
                        thisVal.removeClass('showPreview');
					}
				});
				} else {
                $('#previewIframe').attr('src', '<?php echo base_url('/preview/'); ?>' + widgetType + '/<?php echo $hashcodeBB; ?>');
                $("#campaignPreview").modal('show');
			}
		});
		
        $(document).on('click', '.showComments', function () {
            $(this).parent().next().toggleClass('hidden');
		});
		
        $(document).on('click', '.showCommentsCentre', function () {
            console.log($(this).parent().parent().parent().parent().next().toggleClass('hidden'));
		});
		
		
        var myDropzoneLogoImg = new Dropzone(
		'#myDropzone_logo_img', //id of drop zone element 1
		{
			url: '<?php echo base_url("/dropzone/upload_image"); ?>',
			uploadMultiple: false,
			maxFiles: 1,
			maxFilesize: 600,
			acceptedFiles: 'image/*',
			addRemoveLinks: false,
			success: function (response) {
				//$('.dz-preview').remove();
				$('#logo_img').val(response.xhr.responseText);
			}
		});
		
        Dropzone.autoDiscover = false;
		
		
        var myDropzoneBrandImg = new Dropzone(
		'#myDropzone_brand_img', //id of drop zone element 1
		{
			url: '<?php echo base_url("/dropzone/upload_campaign_files"); ?>',
			uploadMultiple: false,
			maxFiles: 1,
			maxFilesize: 600,
			acceptedFiles: 'image/*',
			addRemoveLinks: false,
			success: function (response) {
				$('#product_img').val(response.xhr.responseText);
			}
		});
		
		
        $('#frmWidgetConfSubmit').on('submit', function (e) {
            e.preventDefault();
            var logo_img = $('#logo_img').val();
            var edit_logo_img = $('#edit_logo_img').val();
			
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/addBrandBoostWidgetData",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
						displayMessagePopup();
						} else {
                        //alertMessage("Something went wrong");
						displayMessagePopup('error');
					}
				}
			});
		});
		
		
		$('#frmSubmitCampaign').on('submit', function (e) {
            e.preventDefault();
			
            //$('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/addBrandBoostWidgetCampaign",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
						displayMessagePopup();
						} else {
						displayMessagePopup('error');
					}
				}
			});
		});
		
		
        $('#frmSubmitWidgetDesign').on('submit', function (e) {
            e.preventDefault();
			
            //$('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/addBrandBoostWidgetDesign",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
						displayMessagePopup();
						} else {
                        //alertMessage("Something went wrong");
						displayMessagePopup('error');
					}
				}
			});
		});
		
        var conRev = 1;
		
        $('#numofrev').change(function () {
            var countVal = $(this).val();
            var reviewContents = $('.<?php echo $widgetData->widget_type; ?> .reviewSectionBox').html();
            var i;
			var className = $('.<?php echo $widgetData->widget_type; ?> .reviewSectionBox').attr('class');
            $('.review_main_box').html('');
            for (i = 1; i <= countVal; i++) {
                $('.review_main_box').append('<div class="'+className+'">' + reviewContents + '</div>');
			}
            //conRev = countVal;
		});
		
		
		<?php if ($num_of_review > 0) { ?>
            var conRev1 = 2;
			var reviewContent = '<div class="bb_fleft bb_small_image_sec "><img class="bb_img_enlagre" src="<?php echo base_url(); ?>assets/images/media_img4.jpg"></div><p class="bb_para bb_custom_txt_color">Showcase your customer\'s photos directly on the product page and throughout your site. Social proof is the most powerful.</p>';
			
			var reviewVideoContent = '<video controls="" width="100%"><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/review_1beef4fc25c3eb6c9b4d3606f38aebbf2add535f.mp4" type="video/mp4"></video>';
			<?php
				if ($widgetData->widget_type == 'cpw') {
				?>
				if (conRev1 <= 1) {
					conRev1 = 2;
				}
				<?php
				}
				if ($widgetData->widget_type == 'bfw') {
				?>
				if (conRev1 <= 1) {
					conRev1 = 5;
				}
				<?php
				}
				if ($widgetData->widget_type == 'vpw') {
				?>
				if (conRev1 <= 1) {
					conRev1 = 3;
				}
				<?php
				}
			?>
            var countVal = <?php echo $num_of_review; ?>;
			$('.previewWidgetBox').each(function(){
				var reviewContents = $(this).find('.reviewSectionBox').html();
				if(reviewContents != ''){ reviewContent = reviewContents; }
				var className = $(this).find('.reviewSectionBox').attr('class');
				
				var i;
				for (i = conRev1; i < countVal; i++) {
					$(this).find('.review_main_box').append('<div class="'+className+'">' + reviewContents + '</div>');
				}
			});
		<?php } ?>
		
		$('#alternative_design').change(function () {
			var bgColor = $('.selectMainColor.active').attr('color-class');
            if ($(this).prop("checked") == false) {
				$('.'+bbwpReviewType+'.bwwMain, .'+bbwpReviewType+'.bfwMain').removeClass('hidden');
				$('.'+bbwpReviewType+'.bwwAlternat, .'+bbwpReviewType+'.bfwAlternat').addClass('hidden');
				
                $('.previewWidgetBox').removeClass('bbAlternetWidget');
				
                $('.previewWidgetBox .addCustomBGClass').removeClass('bb_custom_bg');
				$('.previewWidgetBox .bb_widget_main_container').addClass('bb_custom_bg');
				
				if($('#widget_bgcolor_switch').val() == 1){
					$('.previewWidgetBox .bb_widget_main_container').addClass(bgColor);
					$('.previewWidgetBox .addCustomBGClass').removeClass(bgColor);
				}
				else if($('#widget_bgcolor_switch').val() == 2){
					if($('#color_orientation').val() == 'circle'){
						$('.previewWidgetBox .bb_widget_main_container').css('background-image', 'radial-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}else{
						$('.previewWidgetBox .bb_widget_main_container').css('background-image', 'linear-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}
					$('.previewWidgetBox .addCustomBGClass').css('background-image', '');
					}else{
                    $('.previewWidgetBox .bb_widget_main_container').css('background', $('#solid_color').val());
					
                    $('.previewWidgetBox .addCustomBGClass').css('background', '');
				}
				} else {
				$('.'+bbwpReviewType+'.bwwMain, .'+bbwpReviewType+'.bfwMain').addClass('hidden');
				$('.'+bbwpReviewType+'.bwwAlternat, .'+bbwpReviewType+'.bfwAlternat').removeClass('hidden');
				
				$('.previewWidgetBox').addClass('bbAlternetWidget');
				
				$('.previewWidgetBox .addCustomBGClass').addClass('bb_custom_bg');
				$('.previewWidgetBox .bb_widget_main_container').removeClass('bb_custom_bg');
				
				if($('#widget_bgcolor_switch').val() == 1){
					$('.previewWidgetBox .bb_widget_main_container').removeClass(bgColor);
					$('.previewWidgetBox .addCustomBGClass').addClass(bgColor);
				}
				else if($('#widget_bgcolor_switch').val() == 2){
					$('.previewWidgetBox .bb_widget_main_container').css('background-image', '');
					if($('#color_orientation').val() == 'circle'){
						$('.previewWidgetBox .addCustomBGClass').css('background-image', 'radial-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}else{
						$('.previewWidgetBox .addCustomBGClass').css('background-image', 'linear-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}
					
					}else{
                    $('.previewWidgetBox .bb_widget_main_container').css('background', '');
					
                    $('.previewWidgetBox .addCustomBGClass').css('background', $('#solid_color').val());
				}
				
			}
		});
		
		$('.autoSaveCampaign').change(function () {
			var widgetCampaignId = $(this).val();
			$('.autoSaveCampaign').each(function(){
				if($(this).val() != widgetCampaignId){
					$(this).attr('checked', false);
				}
			});
			
			setTimeout(function(){
				$('.saveCampaign').trigger('click');
			}, 200);
		});
		
        $('#allow_comment').change(function () {
            if ($(this).prop("checked") == false) {
                $('.rev_comment, .pipelineCH').addClass('hidden');
				} else {
                $('.rev_comment').removeClass('hidden');
                if ($('#allow_helpful').prop("checked") == true) {
                    $('.pipelineCH').removeClass('hidden');
				}
			}
		});
		
        $('#allow_video_reviews').change(function () {
            if ($(this).prop("checked") == false) {
				$('.bb_review_details').html(reviewContent);
				} else {
				$('.bb_review_details').html(reviewVideoContent);
			}
		});
		
        $('#allow_helpful').change(function () {
            if ($(this).prop("checked") == false) {
                $('.rev_feedback, .pipelineCH').addClass('hidden');
				} else {
                $('.rev_feedback').removeClass('hidden');
                if ($('#allow_comment').prop("checked") == true) {
                    $('.pipelineCH').removeClass('hidden');
				}
			}
		});
		
        $('#allow_live_reading').change(function () {
            if ($(this).prop("checked") == false) {
                //console.log('false');
                $('.people_cr_box').addClass('hidden');
				} else {
                //console.log('true');
                $('.people_cr_box').removeClass('hidden');
			}
		});
		
        $('#allow_ratings').change(function () {
            if ($(this).prop("checked") == false) {
                $('.rev_star_comment').addClass('hidden');
				} else {
                $('.rev_star_comment').removeClass('hidden');
			}
		});
		
        $('#allow_timestamp').change(function () {
            if ($(this).prop("checked") == false) {
                $('.rev_comment_date').addClass('hidden');
				} else {
                $('.rev_comment_date').removeClass('hidden');
			}
		});
		
        $('#allow_pros_cons').change(function () {
            if ($(this).prop("checked") == false) {
                console.log('false');
				} else {
                console.log('true');
			}
		});
		
        /* --------------- color start ----------------- */
		
        $('#main_color_switch').change(function () {
            if ($(this).prop("checked") == false) {
				$('#widget_bgcolor_switch, #theme_bg_color_switch').val(1);
				$('.widgetSingleColorBox').show();
				$('.widgetMultiColorBox').hide();
				$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('white_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('red_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('yellow_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('orange_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('green_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('blue_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('purple_preview_1');
				
				if($('#color_orientation').val() == 'circle'){
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', 'radial-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
				}else{
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', 'linear-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
				}
			} else {
				$('#widget_bgcolor_switch, #theme_bg_color_switch').val(3);
				$('.widgetSingleColorBox').hide();
				$('.widgetMultiColorBox').show();
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').addClass(gColor);
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', '');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background', '');
			}
		});
		
        $('.selectMainColor').click(function () {
			$('#widget_bgcolor_switch, #theme_bg_color_switch').val(1);
            $('#main_colors').val($(this).attr('color-data'));
            $('.selectMainColor').removeClass('active');
            $(this).addClass('active');
			$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('white_preview_1');
            $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('red_preview_1');
            $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('yellow_preview_1');
            $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('orange_preview_1');
            $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('green_preview_1');
            $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('blue_preview_1');
            $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('purple_preview_1');
            $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', '');
			$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background', '');
            $('#main_color_switch').prop('checked', true);
			$('.widgetSingleColorBox').hide();
			
			if ($('#alternative_design').prop("checked") == true) {
				$('.bb_slide_btn, .bb_brand_logo_name, .bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').addClass($(this).attr('color-class'));
			}else{
				$('.bb_slide_btn, .bb_brand_logo_name, .bb_close, .bb_widget_open_btn, .bb_widget_main_container, .bb_widget_main_container_bw, .bb_submit_button_blue, .bb_submit_button_white, .bb_feed_widget_rb, .bb_top_button_powered').addClass($(this).attr('color-class'));
			}
			
			$('.bbAlternetWidget .bb_widget_main_container').removeClass($(this).attr('color-class'));
			
			$('.saveWidgetDesign').trigger('click');
		});
		
        
		var greadentColor1 = $('#custom_colors1').val();
        $(".colorpicker1").spectrum({
            change: function (color) {
                greadentColor1 = color.toHexString();
                $('#custom_colors1').val(color.toHexString());
                $('.colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
                if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
					$('#widget_bgcolor_switch, #theme_bg_color_switch').val(2);
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('white_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('red_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('yellow_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('orange_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('green_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('blue_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('purple_preview_1');
					
					if($('#color_orientation').val() == 'circle'){
						$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').css('background-image', 'radial-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}else{
						$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').css('background-image', 'linear-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}
					
					console.log('call function');
					setTimeout(function(){
						$('.selectMainColor').removeClass('active');
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                greadentColor1 = color.toHexString();
                $('#custom_colors1').val(color.toHexString());
                $('.colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
				$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('white_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('red_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('yellow_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('orange_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('green_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('blue_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('purple_preview_1');
				
				if($('#color_orientation').val() == 'circle'){
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', 'radial-gradient(' + $('#color_orientation').val() + ', ' + color.toHexString() + ' 1%, ' + $('#custom_colors2').val() + ')');
				}else{
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', 'linear-gradient(' + $('#color_orientation').val() + ', ' + color.toHexString() + ' 1%, ' + $('#custom_colors2').val() + ')');
				}
			}
		});
		
        $(".colorpicker2").spectrum({
            change: function (color) {
                $('#custom_colors2').val(color.toHexString());
                $('.colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
                if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
					$('#widget_bgcolor_switch, #theme_bg_color_switch').val(2);
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('white_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('red_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('yellow_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('orange_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('green_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('blue_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('purple_preview_1');
					
					if($('#color_orientation').val() == 'circle'){
						$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').css('background-image', 'radial-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}else{
						$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').css('background-image', 'linear-gradient(' + $('#color_orientation').val() + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
					}
					
					setTimeout(function(){
						$('.selectMainColor').removeClass('active');
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                $('#custom_colors2').val(color.toHexString());
                $('.colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
				$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('white_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('red_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('yellow_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('orange_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('green_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('blue_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').removeClass('purple_preview_1');
				
				if($('#color_orientation').val() == 'circle'){
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').css('background-image', 'radial-gradient(' + $('#color_orientation').val() + ', ' + greadentColor1 + ' 1%, ' + color.toHexString() + ')');
				}else{
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw,  .bb_widget_main_container').css('background-image', 'linear-gradient(' + $('#color_orientation').val() + ', ' + greadentColor1 + ' 1%, ' + color.toHexString() + ')');
				}
			}
		});
		
        $(".solidcolorpicker").spectrum({
            change: function (color) {
                $('#solid_color').val(color.toHexString());
                $('.solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
                if ($('#solid_color').val() != '') {
					$('#widget_bgcolor_switch, #theme_bg_color_switch').val(3);
					$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('white_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('red_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('yellow_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('orange_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('green_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('blue_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('purple_preview_1');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', '');
                    $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background', $('#solid_color').val());
					setTimeout(function(){
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                $('#solid_color').val(color.toHexString());
                $('.solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
				$('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('white_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('red_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('yellow_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('orange_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('green_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('blue_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').removeClass('purple_preview_1');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background-image', '');
                $('.bb_close, .bb_widget_open_btn, .bb_custom_bg, .bb_submit_button_blue, .bb_submit_button_white, .bb_widget_main_container_bw, .bb_widget_main_container').css('background', color.toHexString());
			}
		});
		
		
		$(".fontcolorpicker").spectrum({
            change: function (color) {
                $('#widget_font_color').val(color.toHexString());
                $('#theme_widget_font_color').val(color.toHexString());
                if ($('#widget_font_color').val() != '') {
                    $('.bb_custom_txt_color').attr('style', 'color:' + color.toHexString() + '!important');
					$('.fontcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
					
					setTimeout(function(){
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                $('.bb_custom_txt_color').attr('style', 'color:' + color.toHexString() + '!important');
				$('.fontcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
			}
		});
		
		$(".bordercolorpicker").spectrum({
            change: function (color) {
                $('#widget_border_color').val(color.toHexString());
                $('#theme_widget_border_color').val(color.toHexString());
                if ($('#widget_border_color').val() != '') {
                    $('.bb_tab_box, .bb_comment_header, .bb_rating_sec, .bb_like_dislike, .bb_top_header_sec, .bb_small_comment_box, .bb_inner_reply, .bb_bbot, .box_1').css('border-color', color.toHexString());
					$('.bordercolorpicker i').css('color', color.toHexString());
					
					setTimeout(function(){
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                $('.bb_tab_box, .bb_comment_header, .bb_rating_sec, .bb_like_dislike, .bb_top_header_sec, .bb_small_comment_box, .bb_inner_reply, .bb_bbot, .box_1').css('border-color', color.toHexString());
				$('.bordercolorpicker i').css('color', color.toHexString());
			}
		});
		
		////////////////////// Star rating color settings ///////////////////////
		
		$('#main_color_switch_rating').change(function () {
            if ($(this).prop("checked") == false) {
				$('.widgetSingleColorBoxRating').show();
				$('.widgetMultiColorBoxRating').hide();
                $('.rev_star_comment i').removeClass('red_bb_star_color');
                $('.rev_star_comment i').removeClass('yellow_bb_star_color');
                $('.rev_star_comment i').removeClass('orange_bb_star_color');
                $('.rev_star_comment i').removeClass('green_bb_star_color');
                $('.rev_star_comment i').removeClass('blue_bb_star_color');
                $('.rev_star_comment i').removeClass('purple_bb_star_color');
                $('.rev_star_comment i').css('color', $('#custom_colors_rating2').val());
				} else {
				$('.widgetSingleColorBoxRating').hide();
				$('.widgetMultiColorBoxRating').show();
                var gColor = $('.selectMainColorRating.active').attr('color-class');
                var colorName = $('.selectMainColorRating.active').attr('color-data');
                $('.rev_star_comment i').addClass(gColor);
                $('.rev_star_comment i').css('color', '');
			}
		});
		
        $('.selectMainColorRating').click(function () {
            $('#main_colors_rating').val($(this).attr('color-data'));
            $('.selectMainColorRating').removeClass('active');
            $(this).addClass('active');
            $('.rev_star_comment i').removeClass('red_bb_star_color');
            $('.rev_star_comment i').removeClass('yellow_bb_star_color');
            $('.rev_star_comment i').removeClass('orange_bb_star_color');
            $('.rev_star_comment i').removeClass('green_bb_star_color');
            $('.rev_star_comment i').removeClass('blue_bb_star_color');
            $('.rev_star_comment i').removeClass('purple_bb_star_color');
            $('.rev_star_comment i').css('color', '');
            $('#main_color_switch_rating').prop('checked', true);
			$('.widgetSingleColorBoxRating').hide();
            $('.rev_star_comment i').addClass($(this).attr('color-class'));
			$('.saveWidgetDesign').trigger('click');
		});
		
        var greadentColorRating1 = $('#custom_colors_rating1').val();
        $(".colorpickerRating1").spectrum({
            change: function (color) {
                greadentColor1 = color.toHexString();
                $('#custom_colors_rating1').val(color.toHexString());
                $('.colorpickerRating1 i').attr('style', 'color:' + color.toHexString() + '!important');
                if ($('#custom_colors_rating1').val() != '' && $('#custom_colors_rating2').val() != '') {
                    $('.rev_star_comment i').removeClass('red_bb_star_color');
                    $('.rev_star_comment i').removeClass('yellow_bb_star_color');
                    $('.rev_star_comment i').removeClass('orange_bb_star_color');
                    $('.rev_star_comment i').removeClass('green_bb_star_color');
                    $('.rev_star_comment i').removeClass('blue_bb_star_color');
                    $('.rev_star_comment i').removeClass('purple_bb_star_color');
                    $('.rev_star_comment i').css('color', $('#custom_colors_rating2').val());
					setTimeout(function(){
						$('.selectMainColorRating').removeClass('active');
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                greadentColor1 = color.toHexString();
                $('#custom_colors_rating1').val(color.toHexString());
                $('.colorpickerRating1 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.rev_star_comment i').removeClass('red_bb_star_color');
                $('.rev_star_comment i').removeClass('yellow_bb_star_color');
                $('.rev_star_comment i').removeClass('orange_bb_star_color');
                $('.rev_star_comment i').removeClass('green_bb_star_color');
                $('.rev_star_comment i').removeClass('blue_bb_star_color');
                $('.rev_star_comment i').removeClass('purple_bb_star_color');
                $('.rev_star_comment i').css('color', color.toHexString());
			}
		});
		
        $(".colorpickerRating2").spectrum({
            change: function (color) {
                $('#custom_colors_rating2').val(color.toHexString());
                $('.colorpickerRating2 i').attr('style', 'color:' + color.toHexString() + '!important');
                if ($('#custom_colors_rating1').val() != '' && $('#custom_colors_rating2').val() != '') {
                    $('.rev_star_comment i').removeClass('red_bb_star_color');
                    $('.rev_star_comment i').removeClass('yellow_bb_star_color');
                    $('.rev_star_comment i').removeClass('orange_bb_star_color');
                    $('.rev_star_comment i').removeClass('green_bb_star_color');
                    $('.rev_star_comment i').removeClass('blue_bb_star_color');
                    $('.rev_star_comment i').removeClass('purple_bb_star_color');
                    $('.rev_star_comment i').css('color', $('#custom_colors_rating2').val());
					setTimeout(function(){
						$('.selectMainColorRating').removeClass('active');
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                $('#custom_colors_rating2').val(color.toHexString());
                $('.colorpickerRating2 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.rev_star_comment i').removeClass('red_bb_star_color');
                $('.rev_star_comment i').removeClass('yellow_bb_star_color');
                $('.rev_star_comment i').removeClass('orange_bb_star_color');
                $('.rev_star_comment i').removeClass('green_bb_star_color');
                $('.rev_star_comment i').removeClass('blue_bb_star_color');
                $('.rev_star_comment i').removeClass('purple_bb_star_color');
                $('.rev_star_comment i').css('color', color.toHexString());
			}
		});
		
        $(".solidcolorpickerRating").spectrum({
            change: function (color) {
                $('#solid_color_rating').val(color.toHexString());
                $('.solidcolorpickerRating i').attr('style', 'color:' + color.toHexString() + '!important');
				
                if ($('#solid_color_rating').val() != '') {
                    $('.rev_star_comment i').removeClass('red_bb_star_color');
                    $('.rev_star_comment i').removeClass('yellow_bb_star_color');
                    $('.rev_star_comment i').removeClass('orange_bb_star_color');
                    $('.rev_star_comment i').removeClass('green_bb_star_color');
                    $('.rev_star_comment i').removeClass('blue_bb_star_color');
                    $('.rev_star_comment i').removeClass('purple_bb_star_color');
                    $('.rev_star_comment i').css('color', $('#solid_color_rating').val());
					setTimeout(function(){
						$('.saveWidgetDesign').trigger('click');
					}, 1000);
				}
			},
            move: function (color) {
                $('#solid_color_rating').val(color.toHexString());
                $('.solidcolorpickerRating i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.rev_star_comment i').removeClass('red_bb_star_color');
                $('.rev_star_comment i').removeClass('yellow_bb_star_color');
                $('.rev_star_comment i').removeClass('orange_bb_star_color');
                $('.rev_star_comment i').removeClass('green_bb_star_color');
                $('.rev_star_comment i').removeClass('blue_bb_star_color');
                $('.rev_star_comment i').removeClass('purple_bb_star_color');
                $('.rev_star_comment i').css('color', color.toHexString());
			}
		});

	});
	
    function savePreviewData(fieldName, fieldData) {
        $.ajax({
            url: "<?php echo base_url(); ?>/admin/brandboost/savePreviewData",
            method: "POST",
            data: {'field_name': fieldName, 'field_value': fieldData, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {}
		});
	}
</script>				