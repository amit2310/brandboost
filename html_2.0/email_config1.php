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
    			<li><a class="active" href="#"><span class="num_circle"><span class="num">1</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Basic campaign info</a></li>
    			<li><a class="" href="#"><span class="num_circle"><span class="num">2</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Content & Design</a></li>
    			<li><a href="#"><span class="num_circle"><span class="num">3</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Recipients</a></li>
    			<li><a href="#"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Review & confirm</a></li>
    		</ul>
    	</div>
    </div>
    </div>
    
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="card p40 min_h_240">
    		
    		<div class="row">
    		<div class="col-md-12">
     		<h3 class="htxt_bold_16 dark_700 mb10">Subject</h3>
     		<p class="fsize12 fw300 dark_300 mb20">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</p>
     		</div>
     		
     		<div class="col-md-8">
     		<div class="form-group">
                <label for="fname" class="fsize12 fw300">EMAIL SUBJECT</label>
                <input type="text" class="form-control emoji h50" id="fname" placeholder="Default subject" name="fname">
              </div>
              </div>
              <div class="col-md-4">
     		<div class="form-group">
                <label for="PERSONALIZATION" class="fsize12 fw300">PERSONALIZATION</label>
                
                <select class="form-control h50" id="PERSONALIZATION">
                	<option>Personalize</option>
                	<option>Personalize</option>
                	<option>Personalize</option>
                	<option>Personalize</option>
                </select>
              </div>
              </div>
              
              
             </div> 
             
             
                   
              
              
              
     		</div>
     		
     		
     		
     		
     		
     		<div class="card p40 min_h_240">
    		
    		 
             
             
             
             <div class="row">
    		<div class="col-md-6">
     		<h3 class="htxt_bold_16 dark_700 mb10">Sender info</h3>
     		<p class="fsize12 fw300 dark_300 mb20">This will be displayed in the ‘From’ field.</p>
     		</div>
     		<div class="col-md-6 text-right">
     		<h3 class="dark_400 mb0 fsize14 fw300">Use default sender info &nbsp; <label class="custom-form-switch">
										<input class="field" type="checkbox">
										<span class="toggle email"></span>
									  </label></h3>
     		</div>
     		<div class="col-md-6">
     		<div class="form-group">
                <label for="Sendername" class="fsize12 fw300">Sender name</label>
                <input type="text" class="form-control form-control-dark h50" id="Sendername" placeholder="Max Iver" name="fname">
              </div>
              </div>
              <div class="col-md-6">
     		<div class="form-group">
                <label for="Senderemail" class="fsize12 fw300">Sender email</label>
                <input type="text" class="form-control form-control-dark h50" id="Senderemail" placeholder="max@brandboost.io" name="fname">
              </div>
              </div>
              
             </div>
             
         
             
              
              
              
              
     		</div>
     		
     		
     		
     		
     		
     		<div class="card p40 min_h_240">
    		
    		 
             
             
             
             
             
             
             <div class="row">
    		<div class="col-md-6">
     		<h3 class="htxt_bold_16 dark_700 mb10">Reply Management</h3>
     		<p class="fsize12 fw300 dark_300 mb20">Capture &amp; foreward reply from your customers.</p>
     		</div>
     		<div class="col-md-6 text-right">
     		<h3 class="dark_400 mb0 fsize14 fw300">Reply tracking &nbsp; <label class="custom-form-switch">
										<input class="field" type="checkbox" checked="">
										<span class="toggle email"></span>
									  </label></h3>
     		</div>
     		
     		<div class="col-md-6">
     		<div class="form-group mb0">
                <label for="fname" class="fsize12 fw300">Forward-to address</label>
                <input type="text" class="form-control form-control-dark h50" id="fname" placeholder="max@brandboost.io" name="fname">
              </div>
              </div>
              <div class="col-md-6">
     		<div class="form-group mb0">
                <label for="fname" class="fsize12 fw300">Personalize “To-adress”</label>
                <input type="text" class="form-control form-control-dark h50" id="fname" placeholder="Include recepient’s name in “To”" name="fname">
              </div>
              </div>
              
             
              
              
             </div>
             
              
              
              
              
     		</div>
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