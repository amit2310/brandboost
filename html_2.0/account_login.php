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



<body id="login_page">
 
 <div id="login_error">
 	<div class="container" style="max-width: 970px">
 		<div class="row">
 			<div class="col-md-10"><i><img src="assets/images/error-warning-line.svg"/></i> &nbsp; There isn't an BrandBoost account associated with iver.mdx@gmail.com.
 			<a href="#" class="signinsec ml20 blef pl20"><img src="assets/images/account-circle-fill-16.svg"> &nbsp; Sign up in seconds</a>
 			</div>
 			<div class="col-md-2 text-right">
 				<a href="#" id="loginerrorclose"><img src="assets/images/loginerror_close.svg"/></a>
 			</div>
 		</div>
 	</div>
 </div>
 
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
 					<h3 class="htxt_medium_20 dark_900 mb20">Log in</h3>
 			<button class="loginwith google mb10">Log in with Google</button>
 			<button class="loginwith facebook">Log in with Facebook</button>
 			<img class="mt25 mb25" src="assets/images/login_or.svg"/>
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
 			
 			<div class="row">
 				<div class="col">
 					<div class="form-group mb25">
                <label for="password">PASSWORD</label>
                <input type="password" class="form-control h56 password" id="password" placeholder="Enter your password here" name="password">
              </div>
 				</div>
 			</div>
 				
              
              
              
              
              <div class="row">
              	<div class="col">
              		<button class="login_btn">Log in</button>
              	</div>
              	<div class="col">
              		<a class="fgpswd" href="#">Forgot passoword?</a>
              	</div>
              </div>
 		</div>
 		
 		
 		<div class="p30 pl50 pr50">
 			<div class="row">
 				<div class="col brig">
 					<a class="dontac" href="#">Don’t have an account?</a>
 				</div>
 				<div class="col">
 					<a href="account_signup.php" class="signinsec ml10"><img src="assets/images/account-circle-fill-16.svg"/> &nbsp; Sign up in seconds</a>
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