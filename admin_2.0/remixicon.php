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
   	<!--<h3 class="htxt_medium_24 dark_700">Reviews Overview</h3>-->
   	<h3 class="htxt_medium_24 dark_700">remix icon</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="circle-icon-40"><img src="assets/images/settings-2-line-reviews.svg"></button>
   		<!--<button class="btn btn-md bkg_reviews_400 light_000 slidebox">ADD New Contact <span><img src="assets/images/reviews_plus_icon.svg"></span></button>-->
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
    
			<div class="row">
				<div class="col-md-12">
				https://github.com/Remix-Design/RemixIcon<br>
https://remixicon.com/<br>
<br>

			
		
		
		<i class="ri-star-half-line fsize12 reviews_400"></i>
		<i class="ri-star-half-line fsize14 red_400"></i>
		<i class="ri-star-half-line fsize16 green_400"></i>
		<i class="ri-star-half-line fsize18 referrals_400"></i>
		<i class="ri-star-half-line fsize20 blue_400"></i>
		<i class="ri-star-half-line fsize22 yellow_400"></i>
		<i class="ri-star-half-line fsize24 reviews_400"></i>
		<i class="ri-star-half-line fsize26 reviews_400"></i>
		<i class="ri-star-half-line fsize28 reviews_400"></i><br>
<br>

		
		
		<i class="ri-star-half-line fsize12 reviews_400"></i>
		<i class="ri-star-half-line fsize14 reviews_400"></i>
		<i class="ri-star-half-line fsize16 reviews_400"></i>
		<i class="ri-star-half-line fsize18 reviews_400"></i>
		<i class="ri-star-half-line fsize20 reviews_400"></i>
		<i class="ri-star-half-line fsize22 reviews_400"></i>
		<i class="ri-star-half-line fsize24 reviews_400"></i>
		<i class="ri-star-half-line fsize26 reviews_400"></i>
		<i class="ri-star-half-line fsize28 reviews_400"></i><br>
<br>
		
		<i class="ri-star-half-line fsize12 red_400"></i>
		<i class="ri-star-half-line fsize14 red_400"></i>
		<i class="ri-star-half-line fsize16 red_400"></i>
		<i class="ri-star-half-line fsize18 red_400"></i>
		<i class="ri-star-half-line fsize20 red_400"></i>
		<i class="ri-star-half-line fsize22 red_400"></i>
		<i class="ri-star-half-line fsize24 red_400"></i>
		<i class="ri-star-half-line fsize26 red_400"></i>
		<i class="ri-star-half-line fsize28 red_400"></i><br>
<br>

		<i class="ri-star-half-line fsize12 green_400"></i>
		<i class="ri-star-half-line fsize14 green_400"></i>
		<i class="ri-star-half-line fsize16 green_400"></i>
		<i class="ri-star-half-line fsize18 green_400"></i>
		<i class="ri-star-half-line fsize20 green_400"></i>
		<i class="ri-star-half-line fsize22 green_400"></i>
		<i class="ri-star-half-line fsize24 green_400"></i>
		<i class="ri-star-half-line fsize26 green_400"></i>
		<i class="ri-star-half-line fsize28 green_400"></i>


		
		
		
		
			
			
			
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