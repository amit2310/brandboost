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
<body id="PeopleSection">

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
   	<div class="col-md-6 col-6">
   	<span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">My Perfect Campaign</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right d-none">
   		<button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
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
    
    <div class="table_head_action bbot pb30">
    <div class="row">
    	<div class="col-md-12">
    		<ul class="import_list">
    			<li><a class="active" href="#">Basic campaign info</a></li>
    			<li><a class="" href="#">Content & Design</a></li>
    			<li><a class="" href="#">Recipients</a></li>
    			<li><a href="#">Review & confirm</a></li>
    		</ul>
    	</div>
    </div>
    </div>
    
    
      <div class="row mt30">
    	<div class="col-md-9">
    		<div class="card p40 min_h_240">
    		
    		<div class="row">
    		<div class="col-md-12">
     		<h3 class="htxt_bold_16 dark_700 mb10">Subject</h3>
     		</div>
     		
     		<div class="col-md-8">
     		<div class="form-group">
                <label for="fname" class="fsize12 fw300">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</label>
                <input type="text" class="form-control h50" id="fname" placeholder="Default subject" name="fname">
              </div>
              </div>
              <div class="col-md-4">
     		<div class="form-group">
                <label for="fname" class="fsize12 fw300">&nbsp;</label>
                
                <select class="form-control h50">
                	<option>Personalize</option>
                	<option>Personalize</option>
                	<option>Personalize</option>
                	<option>Personalize</option>
                </select>
              </div>
              </div>
              
              <div class="col-md-12 mb10"><hr></div>
             </div> 
             
             
             
             <div class="row">
    		<div class="col-md-6">
     		<h3 class="htxt_bold_16 dark_700 mb10">Sender info</h3>
     		</div>
     		<div class="col-md-6 text-right">
     		<h3 class="dark_400 mb0 fsize14 fw300">Default info &nbsp; <label class="custom-form-switch">
										<input class="field" type="checkbox">
										<span class="toggle blue"></span>
									  </label></h3>
     		</div>
     		<div class="col-md-6">
     		<div class="form-group">
                <label for="fname" class="fsize12 fw300">This will be displayed in the ‘From’ field.</label>
                <input type="text" class="form-control form-control-dark h50" id="fname" placeholder="Max Iver" name="fname">
              </div>
              </div>
              <div class="col-md-6">
     		<div class="form-group">
                <label for="fname" class="fsize12 fw300">&nbsp;</label>
                <input type="text" class="form-control form-control-dark h50" id="fname" placeholder="max@brandboost.io" name="fname">
              </div>
              </div>
              <div class="col-md-12 mb10"><hr></div>
             </div>
             
             
             <div class="row">
    		<div class="col-md-6">
     		<h3 class="htxt_bold_16 dark_700 mb10">Reply Management</h3>
     		<p class="fsize12 fw300 dark_500 mb20">Capture & foreward reply from your customers.</p>
     		</div>
     		<div class="col-md-6 text-right">
     		<h3 class="dark_400 mb0 fsize14 fw300">Reply tracking &nbsp; <label class="custom-form-switch">
										<input class="field" type="checkbox" checked>
										<span class="toggle blue"></span>
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
    	<div class="col-md-3">
    	<img src="assets/images/information-line.svg"/>
    		<h3 class="fsize14 fw600 dark_700 mb10 mt10">Default info</h3>
    		<p class="fsize12 fw300 dark_300">Each subscriber should be on a new line. You can include any extra details such as name and age, and we'll match them up with your custom fields in the next step. Before you import your list, make sure it meets our permission policies.</p>
    	</div>
    	
    </div>
    
    
  
    
    
    <div class="row mt40">
    	<div class="col-md-12"><hr class="mb25"></div>
    	<div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button></div>
    	<div class="col-6"><button class="btn btn-sm bkg_blue_200 light_000 float-right">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
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
 <?php include("people_contact_create_smart_popup.php"); ?>
 
    
 
 
 
 
 
 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jQuery.tagify.js"></script>
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
$('[name=tags]').tagify();
</script>

</body>
</html>