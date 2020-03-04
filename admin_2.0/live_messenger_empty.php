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
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.3.0/fonts/remixicon.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/css/styleguide.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

<style>
	
	
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
	 <?php include("user_profile_smart_popup_empty.php"); ?>

	<!--******************
	 PAGE SIDEBAR
	**********************-->
	<div class="page_sidebar bkg_light_000 absl">
	 	<div class="inner2 pb0">
			<div class="title-box">
			  <h6 class="menu-title" style="line-height: 36px;">LIVE MESSENGER</h6>
			</div>
			<h3 class="htxt_medium_20 dark_800" >Contacts </h3>
			
			<div class="bbot btop contact_sort pt15 pb15 mt-3">
				<div class="row">
					<div class="col">
						<div class="tdropdown ml0">
										<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="true">All (39)</a>
										<ul style="right: 0px!important; margin-top: 18px; left: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown">
										  <li><strong><a class="active" href="#"><img class="small" src="assets/images/cd_icon1.png"> All (39) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon2.png">Open (13) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon3.png">Resolved (172) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon4.png">Favorite (5) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon5.png">Snoozed (28)</a></strong></li>
										</ul>
									  </div>
					</div>
					<div class="col">
						<div class="tdropdown ml0 pull-right">
										<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="true">Waiting longest</a>
										<ul style="margin-top: 18px; right: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
											<li><strong><a class="active" href="#">Newest </a></strong></li>
											<li><strong><a href="#">Waiting longest </a></strong></li>
											<li><strong><a href="#">Oldest </a></strong></li>
										</ul>
									  </div>
					</div>
				</div>
			</div>
			
			<div class="sidebar_search_big mt10">
        	<input type="text" name="" value="" placeholder="Search">
        	<button class="sidebar_search_submit"><img src="assets/images/filter-3-line.svg"></button>
            </div>
        </div> 
        
        
        
        	<div class="p20 pt0">
        	<ul class="nav nav-pills chat_contact_tab" role="tablist">
				<li class="mr10"><a class="htxt_bold_13 active" data-toggle="pill" href="#All">All (40)</a></li>
				<li class="mr10"><a class="htxt_bold_13" data-toggle="pill" href="#Unassigned">Unassigned (15)</a></li>
				<li class=""><a class="htxt_bold_13" data-toggle="pill" href="#You">You (12)</a></li>
			  </ul>	
        	</div>
        	
       
       
       
        
		<div class="tab-content">
			<!--======Tab 1====-->
			<div id="All" class="tab-pane active">
				<div class="p20 pt0 pb0 bkg_light_050">
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
			</div>
			
			<!--======Tab 2=====-->
				<div id="Unassigned" class="tab-pane fade">
				<div class="p20 pt0 pb0 bkg_light_050">
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
        	
        	
        	
        	
        	
        	
        </ul>
       
        <div class="clearfix"></div>
        </div>
			</div>
			<!--======Tab 3=====-->
				<div id="You" class="tab-pane fade">
				<div class="p20 pt0 pb0 bkg_light_050">
        	<ul class="list_with_icons">
        	
        	
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
			</div>
		</div>
        
        
        
        
       

    
    <div class="clearfix"></div>   
</div>
 
 
 
 
 
 
 <div class="p25 pl30 pr30 bbot">
     	<div class="row">
     		<div class="col-md-3">
     			<h3 class="fsize18 dark_200 fw500">Conversation</h3>
     		</div>
     		
     	</div>
     </div>
     
     
     
     
     <div class="row" style="margin-top: 150px;">
     		<div class="col-md-12 text-center">
     			<img class="mt40" style="max-width: 225px; " src="assets/images/illustration2.png">
     			<h3 class="htxt_bold_24 dark_700 mt30">Please select a conversation<br> to start messaging </h3>
     			<h3 class="htxt_regular_14 dark_200 mt20 mb25">Or start a new email, sms or chat conversation</h3>
     			<button class="btn btn-sm bkg_blue_000 pr20 blue_300 slidebox">New Conversation</button>
     		</div>
     		</div>
     		
     		
     		
  
	
  
   </div>
      
<!--******************
  Content Area End
 **********************-->
 
 </div>
 
 
 

 
  </div>
  </div>
  
  
 
 
 <!--******************
  Create Saved Reply Sliding Smart Popup
 **********************-->
 <?php include("saved_reply_create_smart_popup.php"); ?>
 
    

 
 
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
	
$(document).ready(function(){
  $(".show_emoji").click(function(){
    $(".chat_emoji_box").toggle();
  });
});
	
$(document).ready(function(){
  $(".show_saved_chat").click(function(){
    $(".chat_saved_temp").toggle();
  });
});
	
	
	

	//side nav active script
	$(".nav-link.livechat").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.livechat").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>

</body>
</html>