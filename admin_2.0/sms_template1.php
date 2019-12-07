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





</head>
<body id="SMSSection">

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
   	<h3 class="htxt_medium_24 dark_700">Templates</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="mr15 btn btn-md bkg_light_000 sms_400">Filters &nbsp; &nbsp; <img src="assets/images/sms_filter.svg"/></button>
   		<button class="btn btn-md light_000 bkg_sms_400 slidebox" >New template &nbsp; &nbsp; <span><img src="assets/images/sms_add.svg"/></span></button>
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
     		<div class="col-md-6 text-left">
     			<a class="lh_32 sms_400 htxt_bold_14" href="#">
     				<span class="circle-icon-32 float-left bkg_sms_000 mr10"><img src="assets/images/sms-download-fill.svg"></span>
     				Import template
     			</a>
     		</div>
     		<div class="col-md-6 text-right">
     			<a class="lh_32 htxt_regular_14 dark_200" href="#">
     				<span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
     				Learn how to use contacts
     			</a>
     		</div>
     		</div>
     		
    		
     		<div class="row mb65">
     		<div class="col-md-12 text-center">
     			<img class="mt40" style="max-width: 250px; " src="assets/images/sms_templates.svg">
     			<h3 class="htxt_bold_18 dark_700 mt30">No templates so far. But you can change it!</h3>
     			<h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import templates!</h3>
     			<button class="btn btn-sm bkg_sms_000 pr20 sms_400 slidebox">Add template</button>
     		</div>
     		</div>
     		
     			
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
 <?php //include("sms_template_create_smart_popup.php"); ?>
 
 
 
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
	$(".nav-link.sms").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.sms").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>




</body>
</html>