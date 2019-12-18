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



<body id="login_page">
 

 
 

 <div class="login_area account_setup">
 	<div class="login_section setup_sec m-auto">
 		<div class="stepcount">
 			<div class="row">
 				<div class="col-md-12 text-center">
 					<img src="assets/images/Signup_logo_blue.svg"/>
 				</div>
 				<div class="col-md-12">
 					<p class="light_800">step 1 of 5</p>
 				</div>
 			</div>
 		</div>
 	
 	
 		<div class="toparea bbot">
 			<div class="row">
 				<div class="col-md-12 text-center">
 					<h3 class="htxt_medium_20 dark_900 mb10">Set up your profile</h3>
 					<p class="fsize14 dark_300 mb30">Share some info to kickstart your free 14 day trial </p>
 				</div>
 				
 				<div class="col-md-12 text-center">
 					<div class="p0 mb30">
					  <label class="m0 float-none" for="companylogo">
					  <div class="img_vid_upload_circle">
						<input class="d-none" type="file" name="" value="" id="companylogo">
					  </div>
					  </label>
					</div>
 				</div>
 				
 				
 				
 			</div>
 			
 			
 			
 			<div class="row">
 				<div class="col-md-6">
 					<div class="form-group">
                <label for="fname">FIRST NAME</label>
                <input type="text" class="form-control h56" id="fname" placeholder="First name" name="fname">
              </div>
 				</div>
 			
 				<div class="col-md-6">
 					<div class="form-group mb25">
					<label for="lname" class="float-left">LAST NAME</label>
					<input type="text" class="form-control h56" id="lname" placeholder="Last name" name="lname">
				  </div>
 				</div>
 				
 				<div class="col-md-6">
 					<div class="form-group mb0">
					<label for="phonenumber" class="float-left">PhONE</label>
					<input type="phonenumber" class="form-control h56" id="phonenumber" placeholder="Phone number" name="phonenumber">
				  </div>
 				</div>
 				
 			</div>
 				
              
              
              
              
             
 		</div>
 		
 		<div class="p20 pl50 pr50">
 			<div class="row">
 				<div class="col-md-12 text-right">
 					<button class="setup_nextstep">Next Step</button>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 

 


 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("loginerrorclose").addEventListener("click", function(e){
  e.preventDefault();
  document.getElementById("login_error").style.display = "none";
}); 	
</script>



</body>
</html>