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

</head>
<body id="EmailSection">

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
   	<h3 class="htxt_medium_24 dark_700">Email Contacts </h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"> Save as draft </button>
   		<button class="btn btn-md bkg_email_300 light_000 slidebox"> Next <span style="opacity: 1"><img src="assets/images/arrow-right-line-white.svg"/></span></button>
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
    	<div class="col-md-12">
    		<ul class="email_config_list">
    			<li><a class="done" href="#"><span class="num_circle"><span class="num">1</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Basic campaign info</a></li>
    			<li><a class="done" href="#"><span class="num_circle"><span class="num">2</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Content & Design</a></li>
    			<li><a class="done" href="#"><span class="num_circle"><span class="num">3</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Recipients</a></li>
    			<li><a class="done" href="#"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Review & confirm</a></li>
    		</ul>
    	</div>
    </div>
    </div>
    
    
    <div class="row">
    	<div class="col-md-12 text-center">
    		<h3 class="htxt_bold_20 dark_700 mb20 mt40">Are you ready to send this email to 1,389 subscribers?</h3>
    		<p class="htxt_normal_14 dark_200 mb40 mt20">It’s very easy to create or import!</p>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-6 text-center animate_top">
    	<label for="opt1" class="d-block mylablel">
    		<div class="card br8 p0 m-0">
    		
    								<label class="custmo_checkbox email_config">
									<input id="opt1" type="checkbox">
									<span class="custmo_checkmark"></span>
									
									</label>
									
									
    			<div class="p40 pb20">
    				<img class="mt20" src="assets/images/send-right-now.svg"/>
    				<h3 class="htxt_medium_16 dark_700 mb30 mt30">Send right now</h3>
    			</div>
    			<div class="p20 btop">
    				<a class="fsize14 fw500 email_500" href="#">Send email immediately</a>
    			</div>
    		</div>
    		</label>
    	</div>
    	<div class="col-md-6 text-center animate_top">
    	<label for="opt2" class="d-block mylablel active">
    		<div class="card br8 p0 m-0">
    								<label class="custmo_checkbox email_config">
									<input id="opt2" type="checkbox" checked>
									<span class="custmo_checkmark"></span>
									</label>
    			<div class="p40 pb20">
    				<img class="mt20" src="assets/images/schedule.svg"/>
    				<h3 class="htxt_medium_16 dark_700 mb30 mt30">Send specific time</h3>
    			</div>
    			<div class="p20 btop">
    				<a class="fsize14 fw500 email_500" href="#">Schedule email on time or date</a>
    			</div>
    		</div>
    		</label>
    		
    		
    	</div>
    	
    </div>
    
    
    
   
    
    
    
    
    <div class="row mt40">
    	<div class="col-md-12"><hr class="mb25"></div>
    	<div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button></div>
    	<div class="col-6"><button class="btn btn-sm bkg_email_300 light_000 float-right">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
    </div>
    
    
    
    
    

    
    
    
    
     
   
      </div>
      </div>
      
<!--******************
  Content Area End
 **********************-->
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
	$(".nav-link.email").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.email").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
	
	
	
	
	
</script>



</body>
</html>