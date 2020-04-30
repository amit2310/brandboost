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
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/css/styleguide.css" rel="stylesheet" type="text/css">




</head>
<body id="ReviewSection">

<div class="page-wrapper">
 <!--******************
 SIDEBAR
 **********************-->
  <?php include("sidebar.php"); ?>
 

  <div class="page-content">
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
   	<div class="col-md-6">
   	<span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">Review Requests</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="circle-icon-40 mr15"><img width="16" src="assets/images/setting_3line_grey.svg"></button>
   		<button class="btn btn-md bkg_reviews_400 light_000 slidebox">Send new request <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
   	</div>
   </div>
   </div>
    <div class="clearfix"></div>
</div>
	 
	  
	  
	  
 <!--******************
  Content Area
 **********************-->
   <div class="content-area">
    <div class="container-fluid">
    
    <div class="table_head_action">
    <div class="row">
    	<div class="col-md-9">
    		<ul class="table_filter">
    			<li><a class="active" href="#">All</a></li>
    			<li><a href="#">Active</a></li>
    			<li><a href="#">Draft</a></li>
    			<li><a href="#">Archive</a></li>
    			
    		</ul>
    	</div>
    	<div class="col-md-3">
    		<ul class="table_filter text-right">
    			<li><a href="#"><i><img src="assets/images/filter_line_18.svg"></i></a></li>
    			<li><a class="search_tables_open_close" href="#"><i><img width="16" src="assets/images/search_line_18.svg"></i></a></li>
    			<li><a href="#"><i><img src="assets/images/sort_line_18.svg"></i></a></li>
    			<li><a href="#"><i><img src="assets/images/cards_line_18.svg"></i></a></li>
    		</ul>
    	</div>
    </div>
    
    <div class="card p20 datasearcharea br6 shadow3">
    	<div class="form-group m-0 position-relative">
    		<input id="InputToFocus" type="search" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
    		<a class="search_tables_open_close searchcloseicon" href="#"><img src="assets/images/close-icon-13.svg"/></a>
    	</div>
    </div>
    
    
    </div>
    
    <div class="row">
    <div class="col-md-3 d-flex">
        <div class="card p0 pt30 text-center animate_top col">
         <span class="status_icon bkg_green_400"></span>
         <span class="check_icon green_400 fsize18"><i class="ri-check-double-line"></i></span>
         
          <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
          </div>
          <a href="#" class="circle-icon-48 bkg_reviews_300 m0auto"><span class="fsize16 fw500 light_000 text-uppercase">CS</span> </a>
          <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">Francisco Miles</h3>
          <p class="fsize14 dark_400 mb-1">francisco.m@example.com</p>
          <p class="fsize14 dark_400 mb20"><img src="assets/images/dot_blue_6.svg"/></i> New Customers</p>
          <div class="p20 btop">
           <div class="row">
           <div class="col-7 text-left"><p class="fsize14 dark_400 m-0">11 min ago</p></div>
           <div class="col-5 text-right"><p class="fsize14 dark_400 m-0"><i class="ri-star-fill sms_400"></i> 4.5</p></div>
           </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-3 d-flex">
        <div class="card p0 pt30 text-center animate_top col">
         <span class="status_icon bkg_green_400"></span>
         <span class="check_icon yellow_500 fsize18"><i class="ri-check-line"></i></span>
         
              <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
              </div>
          <a href="#" class="circle-icon-48 bkg_red_100 m0auto"><span class="fsize16 fw500 light_000 text-uppercase">MB</span> </a>
          <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">Bessie Miles</h3>
          <p class="fsize14 dark_400 mb-1">lillie.daniels@example.com	</p>
          <p class="fsize14 dark_400 mb20"><i class=""><img src="assets/images/dot_blue_6.svg"/></i> New Customers</p>
          <div class="p20 btop">
           <div class="row">
           <div class="col-7 text-left"><p class="fsize14 dark_400 m-0">8 hr ago</p></div>
           <div class="col-5 text-right"><p class="fsize14 dark_400 m-0"><i class="ri-star-fill light_600"></i></p></div>
           </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-3 d-flex">
        <div class="card p0 pt30 text-center animate_top col">
         <span class="status_icon bkg_light_800"></span>
         <!--<span class="check_icon yellow_500 fsize18"><i class="ri-check-line"></i></span>-->
         
              <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
              </div>
          <a href="#" class="circle-icon-48 bkg_blue_300 m0auto"><span class="fsize16 fw500 light_000 text-uppercase">sw</span> </a>
          <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">Stella Webb</h3>
          <p class="fsize14 dark_400 mb-1">fernandez@example.com</p>
          <p class="fsize14 dark_400 mb20"><i class=""><img src="assets/images/dot_blue_6.svg"/></i> New Customers</p>
          <div class="p20 btop">
           <div class="row">
           <div class="col-7 text-left"><p class="fsize14 dark_400 m-0">13 hr ago</p></div>
           <div class="col-5 text-right"><p class="fsize14 dark_400 m-0"><i class="ri-star-fill light_600"></i></p></div>
           </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-3 d-flex">
        <div class="card p0 pt30 text-center animate_top col">
         <span class="status_icon bkg_green_400"></span>
         <span class="check_icon yellow_500 fsize18"><i class="ri-check-line"></i></span>
         
              <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
              </div>
          <a href="#" class="circle-icon-48 bkg_reviews_300 m0auto"><span class="fsize16 fw500 light_000 text-uppercase">mm</span> </a>
          <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">Morris Mccoy</h3>
          <p class="fsize14 dark_400 mb-1">nevaeh@example.com</p>
          <p class="fsize14 dark_400 mb20"><i class=""><img src="assets/images/dot_blue_6.svg"/></i> New Customers</p>
          <div class="p20 btop">
           <div class="row">
           <div class="col-7 text-left"><p class="fsize14 dark_400 m-0">2 days ago</p></div>
           <div class="col-5 text-right"><p class="fsize14 dark_400 m-0"><i class="ri-star-fill light_600"></i></p></div>
           </div>
          </div>
        </div>
      </div>
      
      
      <div class="col-md-3 d-flex">
        <div class="card p0 pt30 text-center animate_top col">
         <span class="status_icon bkg_green_400"></span>
         <span class="check_icon green_400 fsize18"><i class="ri-check-double-line"></i></span>
         
          <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
          </div>
          <a href="#" class="circle-icon-48 bkg_sms_400 m0auto"><span class="fsize16 fw500 light_000 text-uppercase">bm</span> </a>
          <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">Bessie Murphy</h3>
          <p class="fsize14 dark_400 mb-1">chad.stephens@example..</p>
          <p class="fsize14 dark_400 mb20"><img src="assets/images/dot_blue_6.svg"/></i> New Customers</p>
          <div class="p20 btop">
           <div class="row">
           <div class="col-7 text-left"><p class="fsize14 dark_400 m-0">5 days ago</p></div>
           <div class="col-5 text-right"><p class="fsize14 dark_400 m-0"><i class="ri-star-fill sms_400"></i> 4.5</p></div>
           </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-3 d-flex">
        <div class="card p0 pt30 text-center animate_top col">
         <span class="status_icon bkg_green_400"></span>
         <!--<span class="check_icon yellow_500 fsize18"><i class="ri-check-line"></i></span>-->
         
              <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
              </div>
          <a href="#" class="circle-icon-48 bkg_brand_300 m0auto"><span class="fsize16 fw500 light_000 text-uppercase">cf</span> </a>
          <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">Courtney Flores</h3>
          <p class="fsize14 dark_400 mb-1">kelly.howard@example.com</p>
          <p class="fsize14 dark_400 mb20"><i class=""><img src="assets/images/dot_blue_6.svg"/></i> New Customers</p>
          <div class="p20 btop">
           <div class="row">
           <div class="col-7 text-left"><p class="fsize14 dark_400 m-0">5 days ago</p></div>
           <div class="col-5 text-right"><p class="fsize14 dark_400 m-0"><i class="ri-star-fill light_600"></i></p></div>
           </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-3 d-flex">
        <div class="card p0 pt30 text-center animate_top col">
         <span class="status_icon bkg_green_400"></span>
         <span class="check_icon green_400 fsize18"><i class="ri-check-double-line"></i></span>
         
          <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
          </div>
          <a href="#" class="circle-icon-48 bkg_reviews_300 m0auto"><span class="fsize16 fw500 light_000 text-uppercase">dw</span> </a>
          <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">Diane Watson</h3>
          <p class="fsize14 dark_400 mb-1">donald.p@example.com</p>
          <p class="fsize14 dark_400 mb20"><img src="assets/images/dot_blue_6.svg"/></i> New Customers</p>
          <div class="p20 btop">
           <div class="row">
           <div class="col-7 text-left"><p class="fsize14 dark_400 m-0">6 days ago</p></div>
           <div class="col-5 text-right"><p class="fsize14 dark_400 m-0"><i class="ri-star-fill sms_400"></i> 4.5</p></div>
           </div>
          </div>
        </div>
      </div>
    </div>
    
    
    
    
    	<div class="custom_pagination others mt-5">
			    	<div class="row">
			    		<div class="col-md-6">
			    			<span class="mr-4">Items per page:<select><option>10</option><option>10</option><option>15</option><option>20</option></select></span>
			    			<span>1-10 out of 137</span>
			    		</div>
			    		<div class="col-md-6">
			    			<ul class="page_list float-right">
			    				<li><a href="#"><img src="assets/images/arrow-right-s-line.svg"></a></li>
			    				<li><a class="active" href="#">1</a></li>
			    				<li><a href="#">2</a></li>
			    				<li><a href="#">3</a></li>
			    				<li><a href="#">...</a></li>
			    				<li><a href="#">9</a></li>
			    				<li><a href="#"><img src="assets/images/arrow-left-s-line.svg"></a></li>
			    			</ul>
			    		</div>
			    	</div>
			    </div>
    
    
    
    
   
    
    
    
    
    
     
      </div>
      
      </div>
      
<!--******************
  Content Area End
 **********************-->
  </div>
  </div>
  
  
 
 
 <!--******************
  Create Contact Sliding Smart Popup
 **********************-->
 <?php include("email_campaign_create_smart_popup.php"); ?>
 
 
 
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
	$(".nav-link.review").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.review").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>


</body>
</html>