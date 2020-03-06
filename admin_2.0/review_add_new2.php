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
<body id="ReviewSection" class="">

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
   	<h3 class="htxt_medium_24 dark_700">Add Review</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<!--<button class="circle-icon-40 mr15"><img src="assets/images/settings-2-line-reviews.svg"></button>-->
   		<button class="btn btn-md bkg_light_000 reviews_400 fw500 pl20 mr-2 shadow3" >Save</button>
   		<button class="btn btn-md bkg_reviews_400 fw500 light_000 pl20 pr20" >Save & Publish <span><img width="16" src="assets/images/arrow-right-circle-fill.svg"></span></button>
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
    	<div class="col-md-8">
    		<div class="card p25">
			  <h3 class="htxt_medium_12 dark_200 text-uppercase ls_4">BASIC</h3>
    		  <hr>
				<div class="form-group review_forms">
					<label class="fw500 fsize11 dark_600 ls_4">REVIEW TYPE</label>
					<select class="form-control form-control-custom h48 dark_600"><option>Product review</option><option>Select review type</option></select>
				</div>
  		   <div class="form-group m-0 review_forms">
					<label class="fw500 fsize11 dark_600 ls_4">PRODUCT</label>
					<a class="fw500 fsize11 reviews_400 ls_4 float-right" href="#">CREATE NEW <i class="ri-add-circle-fill"></i></a>
					<select class="form-control form-control-custom h48 dark_600"><option>Pro Email Marketing Cource</option><option>Select review type</option></select>
				</div>
   		   </div>
   		   
   		   <div class="card p25">
			  <h3 class="htxt_medium_12 dark_200 text-uppercase ls_4">FROM</h3>
    		  <hr>
				<div class="form-group m-0 review_forms">
					<label class="fw500 fsize11 dark_600 ls_4">REVIEW AUTHOR</label>
					<a class="fw500 fsize11 reviews_400 ls_4 float-right" href="#">CREATE NEW <i class="ri-add-circle-fill"></i></a>
					<select class="form-control form-control-custom h48 dark_600"><option>Gloria Williamson</option><option>Select review's author contact</option></select>
				</div>
   		   </div>
   		   
   		   <div class="card p25">
			  <h3 class="htxt_medium_12 dark_200 text-uppercase ls_4">REVIEW</h3>
    		  <hr>
				<div class="form-group review_forms">
					<label class="fw500 fsize11 dark_600 ls_4">RATING</label>
					
					<div class="p10 border br4 pl20">
						<div class="row">
							<div class="col-8"><i class="ri-star-fill fsize17 green_400 mr-2"></i><i class="ri-star-fill fsize17 green_400 mr-2"></i><i class="ri-star-fill fsize17 green_400 mr-2"></i><i class="ri-star-fill fsize17 green_400 mr-2"></i><i class="ri-star-fill fsize17 green_400 mr-2"></i></div>
							<div class="col-4 blef"><select class="form-control-custom2 border-0 fsize14 dark_200 p-1 pl0 pr20 w-100 dark_600"><option>5.0</option><option>4.0</option><option>3.0</option><option>2.0</option><option>1.0</option><option>Select rating</option></select></div>
						</div>
					</div>
				</div>
  		   
  		   		<div class="form-group review_forms">
					<label class="fw500 fsize11 dark_600 ls_4">REVIEW TITLE</label>
					<input type="text" class="form-control h48 dark_600" placeholder="Enter review title" value="Great customer service!" />
				</div>
 		   
 		   			<div class="form-group review_forms m-0">
					<label class="fw500 fsize11 dark_600 ls_4">CONTENT</label>
					<textarea class="form-control fsize14 dark_200 p-3 min-h-280 dark_600">Robert was most helpfull and understanding when I made an error in my checkout. He took very good care of making sure the problem would be resolved. He gets 5* for being my hero!! Kayla helped me today to order my book, live chat is so helpful and very quick to sort my problem. Kayla was kind, helpful and made me at ease that we could do this no problem and quickly. thank you Kayla.
					
I had a problem with my order, and despite repeated attempts, I could not get Printerpix to sort it out. I contacted them via Paypal, and Kayla took up my case. She understood the problem, and fixed it. Thanks Kayla.</textarea>
					</div>
 		   
 		   
  		   
  		   
   		   </div>
   		
   		
   		
    	</div>
    	
    	<div class="col-md-4">
    		
    		<div class="card p25">
    		<h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">STATUS</h3>
    		<hr>
    		<ul class="info_list">
    			<li><span>Status</span><strong>Published &nbsp; <i class="ri-checkbox-blank-circle-fill green_400 fsize8"></i> </strong> </li>
    			<li><span>Visibility</span><strong>Public &nbsp; <i class="ri-checkbox-blank-circle-fill green_400 fsize8"></i> </strong></li>
    			<li><span>Publish date</span><strong>Dec 16, 3:18 PM &nbsp; <i class="ri-checkbox-blank-circle-fill green_400 fsize8"></i> </strong></li>
    			
    		</ul>
    		</div>
    		
    		
    	
    	<div class="card p25">
			  <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">CAMPAIGN</h3>
    		  <hr>
				<div class="form-group m-0 review_forms">
					
					<select class="form-control form-control-custom h48 dark_600"><option><i class="ri-checkbox-blank-circle-fill green_400 fsize8"></i> Request campaign 2</option><option>Select review campaign</option></select>
					
				</div>
   		   </div>
   		   
   		   
   		   
    	
   		<div class="card p25">
		   <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4 mb-3">Media</h3>
    			<img class="br5 w-100" src="assets/images/media5.svg"/>
    		       <!--<label class="m0 w-100" for="upload">
					<div class="img_vid_upload_media">
					  <input class="d-none" type="file" name="" value="" id="upload">
					</div>
					</label>-->
   		</div>
   		
   		
   		
   		<div class="card p25">
    		<h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Tags</h3>
    		<hr>
    		<div>
    			<button class="tags_btn mb-3">customer</button>
    			<button class="tags_btn mb-3">email</button>
    			<button class="tags_btn mb-3">4 star</button>
    			<button class="tags_btn mb-3">website about</button>
    			<button class="tags_btn mb-3">positive</button>
    			<button class="tags_btn mb-3">4 star</button>
    			<button class="tags_btn mb-3">male</button>
    			<button class="tags_btn mb-3">user</button>
    			<button class="tags_btn mb-3">+</button>
    		</div>
    		</div>
    		
    		
    		
    		<div class="card p25">
    		<h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Details</h3>
    		<hr>
    		<ul class="info_list">
    			<li><span>ID</span><strong>12391231</strong></li>
    			<li><span>Order ID</span><strong class="">32492</strong></li>
    			<li><span>Product ID</span><strong class="">1018</strong></li>
    			<li><span>Source</span><strong class="">Imported</strong></li>
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