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
	
</head>



<body id="LiveChatSection">
<!--<body id="PeopleSection" class="enlarge-menu">-->

<div class="page-wrapper ">
 <!--******************
 SIDEBAR NAVIGATION
 **********************-->
  <?php include("sidebar.php"); ?>
 

  <div class="page-content">
  
  

  
  
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
   	<div class="col-md-6">
   	<h3 class="htxt_medium_24 dark_700">Live Visitors </h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40"><img src="assets/images/settings-3-fill-blue.svg"/></button>
   		<!--<button class="btn btn-md bkg_blue_300 light_000" data-toggle="modal" data-target="#CREATEFORM">START NEW CHAT<span><img src="assets/images/blue-plus.svg"/></span></button>-->
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
    		<div class="card card_shadow min-h-280">
    		
    		
    		
     		<div class="row mb65">
     		<div class="col-md-12 text-center">
     			<img class="mt40" style="max-width: 250px; " src="assets/images/livi_visitors_image.svg">
     			<h3 class="htxt_bold_18 dark_700 mt30 lh_160">Looks like you don’t have <br>

any live visitors</h3>
     			<!--<h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to start a new conversation!</h3>
     			<button class="btn btn-sm bkg_blue_000 pr20 blue_300 slidebox">Start chat</button>-->
     		</div>
     		</div>
     		
     		
     		
     		
     		
     			
     		</div>
    	</div>
    	
    	<div class="col-md-12 text-center mt-2">
    		<a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
    	</div>
    	
    	
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
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/app.js"></script>


<script>
	//side nav active script
	$(".nav-link.livechat").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.livechat").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>


</body>
</html>