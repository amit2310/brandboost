<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BrandBoost::Admin</title>
	<link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">

	<!-- Global stylesheets -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/profile_css/profile.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	
	
	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<!-- /core JS files -->
	
	
	
	
</head>
<body>



<div class="profile_signup">

<div class="container signin_signup_container">
	<div class="row">
		<div class="col-md-6">
			<div class="white_box">
				<div class="p40 bbot text-center">
					<h3 class="txt1">Sign In</h3>
					<p class="txt1">Log in to read, write and manage reviews</p>
					<a class="social_btn" href="#"><img src="<?php echo base_url(); ?>assets/profile_images/google_button.png"/></a><a class="social_btn" href="#"><img src="<?php echo base_url(); ?>assets/profile_images/facebook_button.png"/></a>
				</div>
				<div class="p50 pl50 pr50">

					<form action="{{ url('user/login') }}" method="post">
						{{ csrf_field() }}
							
						<div class="form_box">
							<div class="inner bbot">
							<div class="row">
								<div class="col-xs-12"><input class="form-control email" type="text" name="email" id="email" placeholder="Email" required /></div>
							</div>
							</div>
							<div class="inner">
							<div class="row">
								<div class="col-xs-12"><input class="form-control password" type="password" name="password" id="password" value="" placeholder="Password" required />
								<a class="password_visible" href="#"><img src="<?php echo base_url(); ?>assets/profile_images/eye_icon.png"/></a>
								</div>
							</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6"><button type="submit" class="signup_btn">Sign In</button></div>
							<div class="col-md-6 pl0"><!--<button class="create_accout_btn">Create Account</button>--> <a class="create_accout_btn" href="profile_signup.php">Create Account</a></div>
						</div>
					</form>
					
					
				</div>
			</div>
			<div class="footer_txt text-center">
			<div class="p25 bbot">
				By signing in or creating an account, you agree with our<br><a href="#"> Terms &amp; Conditions</a> and <a href="#">Privacy Statement</a>
				</div>
				<div class="p25">
				Business owner ? <a href="#">Set up your business account for free</a>
				</div>
			</div>
			
			
		</div>
		<div class="col-md-6 text-center">
			<div class="signup_image">
			<div class="signup_logo"><img src="<?php echo base_url(); ?>assets/profile_images/brandboost_logo_icon.png"/></div>
			<h3 class="txt2">BrandBoost connect great customers with a great businesses</h3>
			<p class="txt2">Search for services in our trusted network of nearly 100,000 BrandBoost businesses with ratings and reviews from real customers.</p>
			<img src="<?php echo base_url(); ?>assets/profile_images/signup_img.png"/>
			</div>
		</div>
	</div>
</div>
	
</div>





</body>
</html>