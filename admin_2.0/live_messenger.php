<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Brand Boost 2.0</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">


 <!--******************
 CSS
 **********************-->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/css/styleguide.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<style>
		.navbar-custom{background: #ffffff!important; padding-left: 320px}
		.top-bar-top-section{padding-left: 310px}
		.content-area.chat_messanger_area{padding:0 0 0 280px;}
		
		.chat_messanger_area .chat_user_list {max-width: 225px; border-right: 2px solid #d5dfef; padding-right: 15px; float: right}
		.chat_messanger_area .chat_user_list ul{margin: 0; padding: 0;}
		.chat_messanger_area .chat_user_list ul li{display: inline-block;  margin: 0 2px; padding: 0; line-height: 28px;}
		.chat_messanger_area .chat_user_list ul li img{width: 28px; height: 28px;}
		
		
		.chat_messanger_area .action_list {max-width: 207px; float: right; margin-left: 10px}
		.chat_messanger_area .action_list ul{margin: 0; padding: 0;}
		.chat_messanger_area .action_list ul li{display: inline-block;  margin: 0 6px; padding: 0; line-height: 28px;}
		.chat_messanger_area .action_list ul li img{}
		
		.chat_messanger_area .messanger_tab {margin: 8px 0px 0 0}
		.chat_messanger_area .messanger_tab li{margin: 0 30px 0 0}
		.chat_messanger_area .nav.nav-pills.messanger_tab a{color: #687693; font-size: 14px;}
		.chat_messanger_area .nav.nav-pills.messanger_tab a.active{color: #4F8AF4; border-top: 2px solid #4F8AF4; padding-top: 39px;}

		
		

.media-body {position: relative;}
.chat-list{padding: 30px 0 30px 30px; margin: 0}
.chat-list .media.reversed .media-content:not([class*="bg-"]) {border-radius: 6px!important; border: none!important; background-color: #edf5ff!important; float:right;}
.chat-list .media.reversed .media-content {text-align: left;	color: ##242B3D!important; font-size:14px; font-weight:400; clear: both;}
.chat-list .media.reversed .media-content:before {display: none;}
.chat-list .media-content:not([class*="bg-"]) {	background-color: #eff3fc;	border:none; border-radius: 6px!important;}
.chat-list .media-content:before {display: none; }
.chat-list .media-content{padding: 18px 25px!important; font-size: 14px; font-weight: 400!important; max-width: 500px; color:##242B3D!important; display:table!important; margin-bottom: 8px !important;position: relative; width: auto; clear: both}
.chat-list .media{ margin-left:50px;}
.chat-list .media.reversed{ margin-right:50px;}
.chat-list .media .media-annotation.user_icon{ position:absolute; left:-50px; width: 36px;height: 36px;right: auto; top: 0;}
.chat-list .media.reversed .media-annotation.user_icon{  right:-50px;left: auto;}
.circle_green_status.status-mark{ border:2px solid #ffffff; background:#00CC00; position:absolute; bottom:0; width:9px; height:9px; right:-3px; display: none}	
a.icons.fl_letters.s24 {width: 36px;height: 36px;box-shadow: none !important;background: #fff;text-align: center;text-transform: uppercase;line-height: 36px;color: #fff;border-radius: 100px;
font-size: 9px;	font-weight: 500;background: #333;display: block}
.mainchatsvroll2  {height: 500px; overflow-x: hidden; overflow-y: auto; padding-right: 30px}
.chat_mis_sec{min-height: 500px;}

@media (max-width:1440px) {
	.mainchatsvroll2{height: 350px;}
	.chat_mis_sec{min-height: 350px; max-height: 350px!important}
}
		
		

		.profile_image_bkg{width: 108px; height: 108px; text-align: center; line-height: 108px; background: url(assets/images/profile_bkg.png)center center no-repeat; margin: auto}
		.profile_social_icon {padding: 0; margin: 0}
		.profile_social_icon li{list-style: none; display: inline-block; margin: 0 5px;}
		
		.user_details_list{margin: 0; padding: 0}
		.user_details_list li{list-style: none; color: #242B3D; font-size: 14px; line-height: 30px; margin: 0; padding: 0}
		.user_profile_show{position: absolute; right: 0; top: 30px;}
		
		.box::after{display: none}
	</style>
</head>



<body id="LiveChatSection">
<!--<body id="PeopleSection" class="enlarge-menu">-->

<div class="page-wrapper ">
 <!--******************
 SIDEBAR NAVIGATION
 **********************-->
  <?php include("sidebar.php"); ?>
 
 
  <div class="page-content bkg_light_000">

  

  
  
  <div class="h-100">
 <!--******************
  TOPBAR
 **********************-->
  <?php include("topbar.php"); ?>
  
  
 <!--******************
  Top Heading area
 **********************-->
  <div class="top-bar-top-section bbot">
  <div class="container-fluid">
   <div class="row">
   	<div class="col-md-3">
   	<span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">Messenger</h3>
   	</div>
   
   	<div class="col-md-9 col-9 text-right">
   		<button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
   	</div>
   </div>
   </div>
    <div class="clearfix"></div>
</div>
	 
	  
	  
	  
 <!--******************
  Content Area
 **********************-->
   <div class="content-area chat_messanger_area">
   
   
    <!--******************
  Create Contact Sliding Smart Popup
 **********************-->
 <?php include("user_profile_smart_popup.php"); ?>
   
   
    
     <div class="p25 pl30 pr30 bbot">
     	<div class="row">
     		<div class="col-md-3">
     			<h3 class="fsize18 dark_800 fw500"><img src="assets/images/atrate_28.svg" /> &nbsp; Norma Alexander</h3>
     		</div>
     		<div class="col-md-9">
     		
     			<div class="action_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/bookmark-line.svg"/></a></li>
     					<li><a href="#"><img src="assets/images/price-tag-line.svg"/></a></li>
     					<li><a href="#"><img src="assets/images/time-line.svg"/></a></li>
     					<li><a href="#"><img src="assets/images/checklineGroup.svg"/></a></li>
     				</ul>
     			</div>
     			<div class="chat_user_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/avatar/01.png"/></a></li>
     					<li><a href="#"><img src="assets/images/avatar/02.png"/></a></li>
     					<li><a href="#"><img src="assets/images/avatar/03.png"/></a></li>
     					<li><a href="#"><img src="assets/images/avatar/04.png"/></a></li>
     					<li><a href="#"><img src="assets/images/Plus_grey_circle.svg"/></a></li>
     				</ul>
     			</div>
     			
     		</div>
     	</div>
     </div>
     
     <div class="p0 bbot position-relative chat_mis_sec">
     <a class="slidebox user_profile_show" href="#"><img src="assets/images/user_profile_show.svg"/></a>
     
<div class="tab-content">
<!--======Tab 1====-->
<div id="MessageView" class="tab-pane active">
<div class="mainchatsvroll2">
<ul class="media-list chat-list">
  
  <li class="media">
    <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/02.png" class="img-circle img-xxs" alt=""></span>
      <div class="media-content">Hey y’all! <br><br>
      We own Hidden Lake Forest which is in a private lake community. We wanted to see how others handle a waiver of liability to use of Kayaks, boats.</div>
      <div class="media-content">thanks you for work list</div>
    </div>
  </li>
  <li class="media reversed">
    <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/01.png" class="img-circle img-xxs" alt=""> 
     <!--<a href="#" class="icons fl_letters m0 s24">as</a>--></span>
      <div class="media-content">Hey y’all! <br><br>
      We own Hidden Lake Forest which is in a private lake community. We wanted to see how others handle a waiver of liability to use of Kayaks, boats.</div>
      <div class="media-content">thanks you for work list</div>
    </div>
  </li>
  <li class="media">
    <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/02.png" class="img-circle img-xxs" alt=""></span>
      <div class="media-content">Hey y’all! <br><br>
      We own Hidden Lake Forest which is in a private lake community. We wanted to see how others handle a waiver of liability to use of Kayaks, boats.</div>
      <div class="media-content">thanks you for work list</div>
    </div>
  </li>
  <li class="media reversed">
    <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/01.png" class="img-circle img-xxs" alt=""> 
     <!--<a href="#" class="icons fl_letters m0 s24">as</a>--></span>
      <div class="media-content">Hey y’all! <br><br>
      We own Hidden Lake Forest which is in a private lake community. We wanted to see how others handle a waiver of liability to use of Kayaks, boats.</div>
      <div class="media-content">thanks you for work list</div>
    </div>
  </li>
  <li class="media">
    <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/02.png" class="img-circle img-xxs" alt=""></span>
      <div class="media-content">Hey y’all! <br><br>
      We own Hidden Lake Forest which is in a private lake community. We wanted to see how others handle a waiver of liability to use of Kayaks, boats.</div>
      <div class="media-content">thanks you for work list</div>
    </div>
  </li>
  <li class="media reversed">
    <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/01.png" class="img-circle img-xxs" alt=""> 
     <!--<a href="#" class="icons fl_letters m0 s24">as</a>--></span>
      <div class="media-content">Hey y’all! <br><br>
      We own Hidden Lake Forest which is in a private lake community. We wanted to see how others handle a waiver of liability to use of Kayaks, boats.</div>
      <div class="media-content">thanks you for work list</div>
    </div>
  </li>
  <li class="media">
    <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><img src="assets/images/avatar/02.png" class="img-circle img-xxs" alt=""></span>
      <div class="media-content">Hey y’all! <br><br>
      We own Hidden Lake Forest which is in a private lake community. We wanted to see how others handle a waiver of liability to use of Kayaks, boats.</div>
      <div class="media-content">thanks you for work list</div>
    </div>
  </li>
</ul>
								</div>
			</div>
			<!--======Tab 2=====-->
			<div id="NoteView" class="tab-pane fade">
				<div class="p20">
					Note Section
				</div>
			</div>
			<!--======Tab 3=====-->
			<div id="EmailView" class="tab-pane fade">
				<div class="p20">
					Email Section
				</div>
			</div>
			<!--======Tab 4=====-->
			<div id="TextMessageView" class="tab-pane fade">
				
				<div class="p20">
					Text Message View
				</div>
			</div>
		  </div>
     </div>
     
     
     
     <div class="p30 pb0 bbot" style="min-height: 120px;">
     	<textarea class="p0 w-100 border-0 fsize16 dark_200" style="height: 85px; resize: none;">Shift + Enter to add a new line
Start with ‘/’ to select a  Saved Message
     	</textarea>
     </div>
     
     <div class="p30 bbot">
     	<div class="row">
     		<div class="col-md-7">
     			<ul class="nav nav-pills messanger_tab" role="tablist">
					<li><a class="active" data-toggle="pill" href="#MessageView"><img src="assets/images/message-2-line.svg" /> &nbsp; Message</a></li>
					<li><a data-toggle="pill" href="#NoteView"><img src="assets/images/file-3-line-grey.svg" /> &nbsp; Note</a></li>
					<li><a data-toggle="pill" href="#EmailView"><img src="assets/images/mail-open-line.svg" /> &nbsp; Email</a></li>
					<li><a data-toggle="pill" href="#TextMessageView"><img src="assets/images/message-3-line-grey.svg" /> &nbsp; Text Message</a></li>
			    </ul>
     		</div>
     		<div class="col-md-5">
     			<div class="action_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/emoticon.svg"></a></li>
     					<li><a href="#"><img src="assets/images/image_12.svg"></a></li>
     					<li><a href="#"><img src="assets/images/attachment.svg"></a></li>
     					<li><a href="#"><img src="assets/images/pluscircle_12.svg"></a></li>
     					<li><a href="#"><img src="assets/images/submit_btn_icon.svg"></a></li>
     				</ul>
     			</div>
     		</div>
     	</div>
     </div>
  
  
	<!--******************
	 PAGE SIDEBAR
	**********************-->
	<div class="page_sidebar bkg_light_000 absl">
	 	<div class="inner2 pb0">
			<div class="title-box">
			  <h6 class="menu-title" style="line-height: 36px;"><span class="button-menu-mobile_sidebar"><img src="assets/images/close_menu_circle.svg"></span> &nbsp; Open Menu</h6>
			</div>
			<h3 class="htxt_medium_20 dark_800" >Chats </h3>
			<hr />
			
			<div class="sidebar_search_big">
        	<input type="text" name="" value="" placeholder="Search">
        	<button class="sidebar_search_submit"><img src="assets/images/submit_grey.svg"></button>
        </div>
        </div> 
        
      
        
        
        <div class="p20 pt0 pb0">
        
        	<ul class="list_with_icons">
        	<li class="d-flex">
        	<div class="media_left">
        		<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/02.png"/></span>
        	</div>
        	<div class="media_left">
        		<p class="htxt_bold_14 dark_600 mb-2">Bruce Robertson</p>
        		<p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
        	</div>
        	<div class="time_badge">
        		<span class="time fsize10 light_800">5m</span>
        		<!--<span class="badge badge-grey chatlist">28</span>-->
        	</div>
        	</li>
        	
        	
        	
        	<li class="d-flex active">
        	<div class="media_left">
        		<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/07.png"/></span>
        	</div>
        	<div class="media_left">
        		<p class="htxt_bold_14 dark_600 mb-2">Eduardo Williamson</p>
        		<p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
        	</div>
        	<div class="time_badge">
        		<span class="time fsize10 light_800">2m</span>
        		<span class="badge badge-grey chatlist">8</span>
        	</div>
        	</li>
        	
        	
        	
        	
        	
        	<li class="d-flex">
        	<div class="media_left">
        		<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/03.png"/></span>
        	</div>
        	<div class="media_left">
        		<p class="htxt_bold_14 dark_600 mb-2">Lily Pena</p>
        		<p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
        	</div>
        	<div class="time_badge">
        		<span class="time fsize10 light_800">1h</span>
        		<span class="badge badge-grey chatlist">5</span>
        	</div>
        	</li>
        	
        	<li class="d-flex">
        	<div class="media_left">
        		<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/04.png"/></span>
        	</div>
        	<div class="media_left">
        		<p class="htxt_bold_14 dark_600 mb-2">Theresa Fox</p>
        		<p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
        	</div>
        	<div class="time_badge">
        		<span class="time fsize10 light_800">3m</span>
        		<span class="badge badge-grey chatlist">2</span>
        	</div>
        	</li>
        	
        	<li class="d-flex">
        	<div class="media_left">
        		<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/05.png"/></span>
        	</div>
        	<div class="media_left">
        		<p class="htxt_bold_14 dark_600 mb-2">Brooklyn Nguyen</p>
        		<p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
        	</div>
        	<div class="time_badge">
        		<span class="time fsize10 light_800">4m</span>
        		<!--<span class="badge badge-grey chatlist">7</span>-->
        	</div>
        	</li>
        	
        	<li class="d-flex">
        	<div class="media_left">
        		<span class="fl_name bkg_green_light green_300">fg</span>
        	</div>
        	<div class="media_left">
        		<p class="htxt_bold_14 dark_600 mb-2">Bruce Robertson</p>
        		<p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
        	</div>
        	<div class="time_badge">
        		<span class="time fsize10 light_800">10s</span>
        		<span class="badge badge-grey chatlist">3</span>
        	</div>
        	</li>
        	
        	<li class="d-flex">
        	<div class="media_left">
        		<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/06.png"/></span>
        	</div>
        	<div class="media_left">
        		<p class="htxt_bold_14 dark_600 mb-2">Nathan Simmmons</p>
        		<p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
        	</div>
        	<div class="time_badge">
        		<span class="time fsize10 light_800">1m</span>
        		<!--<span class="badge badge-grey chatlist">8</span>-->
        	</div>
        	</li>
        	
        	
        	
        	
        </ul>
       
        <div class="clearfix"></div>
        </div>
        
       

    
    <div class="clearfix"></div>   
</div>
  
	<!--******************
	 END PAGE SIDEBAR
	**********************-->
  
  
   </div>
      
<!--******************
  Content Area End
 **********************-->
 
 </div>
 
 
 

 
  </div>
  </div>
  
  
 
 
 

 
 
 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/app.js"></script>

<script>
$(document).ready(function(){
	$(".slidebox").click(function(){
		$(".box").animate({
			width: "toggle"
		});
	});
	

	
	
	
});
	
	
	
	
	
</script>

<script>
	//side nav active script
	$(".nav-link.livechat").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.livechat").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>

</body>
</html>