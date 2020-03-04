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



<body id="login_page">
 

 
  <div class="login_text_area">
 	<div class="inner_txt">
 		<img src="assets/images/login_logo.svg"/>
 		<h3 class="htxt_medium_20 mb20 mt25">All-in-one business toolkit</h3>
 		<p class="htxt_regular_14 lh_20 m-0">Run your successful business online with all apps you need to make your life easier, grow faster and make your clients happy.</p>
 	</div>
 </div>

 <div class="login_area">
 	<div class="login_section m-auto">
 		<div class="toparea bbot">
 		
 			<div class="row">
 				<div class="col">
 					<h3 class="htxt_medium_20 dark_900 mb20">Forgot your password</h3>
 					<p class="dark_200 fsize15 mb-5 lh_22">We will send a recovery link to your inbox<br>
 so that you can reset your password <br>

and access your account.</p>
 				</div>
 			</div>
 			
 			
 			
 			<div class="row">
 				<div class="col">
 					<div class="form-group">
                <label for="email">EMAIL</label>
                <input type="text" class="form-control h56 email" id="email" placeholder="Enter your email here" name="email">
              </div>
 				</div>
 			</div>
 			<div class="clearfix"></div>
 			
 			
 				
              
              
              
              
              <div class="row">
              	<div class="col-md-8">
              		<button class="login_btn">Reset my password</button>
              	</div>
              	
              </div>
 		</div>
 		
 		
 		<div class="p30 pl50 pr50">
 			<div class="row">
 				<div class="col-md-6 brig">
 					<a class="dontac" href="account_login.php"><img src="assets/images/arrow-left-line.svg"/> &nbsp; Return to login</a>
 				</div>
 				<div class="col-md-6">
 					<a href="account_login.php" class="signinsec ml10"><img src="assets/images/customer-service-2-fill.svg"/> &nbsp; Contact Support </a>
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