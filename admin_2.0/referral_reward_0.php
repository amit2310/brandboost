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
<style>
	.form-group label {
	letter-spacing: 0.04em;
	text-transform: uppercase;
	color: #687693!important;
	font-size: 10px!important
	
}
	.email_config_list li{width: 19.5%}
	.card{width: 100%}

	
	
	</style>
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
   	<h3 class="htxt_medium_24 dark_700">New Referral Campaign </h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"> Save as draft </button>
   		<button class="btn btn-md bkg_email_300 light_000 slidebox"> Publish <span style="opacity: 1"><img src="assets/images/arrow-right-line-white.svg"/></span></button>
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
    			<li><a class="active" href="#"><span class="num_circle"><span class="num">1</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Select Source</a></li>
    			<li><a class="" href="#"><span class="num_circle"><span class="num">2</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Rewards</a></li>
    			<li><a href="#"><span class="num_circle"><span class="num">3</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Email Workflow</a></li>
    			<li><a href="#"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Configuration</a></li>
    			<li><a href="#"><span class="num_circle"><span class="num">5</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Summary</a></li>
    		</ul>
    	</div>
    </div>
    </div>
    
    
    <div class="row mb30">
    	<div class="col-md-12 text-center mt30">
    		<h3 class="fsize16 fw400 dark_500">How do you want to create a referral campaign?</h3>
    		<p class="fsize13 dark_200">Email Template</p>
    	</div>
    	
    </div>
    
    
    <div class="row">
                                <div class="col-md-4 text-center">
                                    <label for="temp1" class="m0 w-100">
                                        <div class="broadcast_select_contact">
                                            <label class="custmo_checkbox">
                                                <input class="check" type="checkbox" id="temp1" checked="">
                                                <span class="custmo_checkmark green_tr"></span>
                                            </label>
                                           
                                            
                                            <div class="img_box img_inactive" style="display: none;">
                                                <img src="http://brandboost.io/assets/images/ref_email.png">
                                            </div>
                                            
                                             <div class="img_box img_active " style="display: block;">
                                                <img src="http://brandboost.io/assets/images/ref_email_act.png">
                                            </div>
                                            
                                            
                                            
                                            <p class="fsize14 txt_dark fw500">Emails &amp; Page</p>
                                            <p class="fsize12 txt_grey fw300">Select one or more of the pre-prepared contact lists. You can create a new list of contacts in the “People” module.</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label for="temp2" class="m0 w-100">
                                        <div class="broadcast_select_contact">
                                            <label class="custmo_checkbox">
                                                <input class="check" type="checkbox" id="temp2" >
                                                <span class="custmo_checkmark green_tr"></span>
                                            </label>
                                            <div class="img_box img_inactive" style="display: block;">
                                                <img src="http://brandboost.io/assets/images/ref_social.png">
                                            </div>
                                            
                                           
                                            
                                             <div class="img_box img_active " style="display: none;">
                                                <img src="http://brandboost.io/assets/images/ref_social_act.png">
                                            </div>
                                            
                                            
                                            <p class="fsize14 txt_dark fw500">Social Media</p>
                                            <p class="fsize12 txt_grey fw300">Select all contacts that match a specific tag or group of tags.</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label for="temp3" class="m0 w-100">
                                        <div class="broadcast_select_contact">
                                            <label class="custmo_checkbox">
                                                <input class="check" type="checkbox" id="temp3">
                                                <span class="custmo_checkmark green_tr"></span>
                                            </label>
                                            <div class="img_box img_inactive" style="display: block;">
                                                <img src="http://brandboost.io/assets/images/ref_widget.png">
                                            </div>
                                            
                                             <div class="img_box img_active " style="display: none;">
                                                <img src="http://brandboost.io/assets/images/ref_widget_act.png">
                                            </div>
                                            
                                            
                                            <p class="fsize14 txt_dark fw500">Widgets</p>
                                            <p class="fsize12 txt_grey fw300">Choose from all available contacts. The list of contacts will be created automatically based on this broadcast.</p>
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
	
	
	
	$('.check').change(function(){
	if($(this).prop("checked")){
		$(this).parent().parent().find(".img_inactive").hide();
		$(this).parent().parent().find(".img_active").show();
	}else{
		$(this).parent().parent().find(".img_inactive").show();
		$(this).parent().parent().find(".img_active").hide();
	}
	
}) 
</script>
</body>
</html>