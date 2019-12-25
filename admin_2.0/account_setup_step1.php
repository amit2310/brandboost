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

<style>
.Modal {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: transparent;
  visibility: hidden;
}

.Modal .content {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 50%;
  padding: 30px;
  border-radius: 3px;
  transform: translate(-50%, -50%) scale(0);
	width: 500px; height: 400px;
	background: #fff;
	box-sizing: border-box;
}
.content .toshow{
  background-repeat:no-repeat;
  width:100%;
  height:100%;
  background-position:center;
  background-size:contain;
}

.Modal .close_uploadimg {
  position: absolute;
  top: 0px;
  right: -60px;
  display: block;
  width: 30px;
  height: 30px;
  padding: 5px;
  line-height: 29px;
  border-radius: 50%;
  text-align: center;
  cursor: pointer;
  
  color: #7B89A6;
  background: #FFFFFF;
  box-shadow: 0px 2px 2px rgba(0, 39, 115, 0.05);
}

.Modal .close_uploadimg:before { content: '\2715'; }

.Modal.is-visible {
  visibility: visible;
  background: rgba(0, 0, 0, 0.5);
  -webkit-transition: background .35s;
  -moz-transition: background .35s;
  transition: background .35s;
  -webkit-transition-delay: .1s;
  -moz-transition-delay: .1s;
  transition-delay: .1s;
}

.Modal.is-visible .content {
  -webkit-transform: translate(-50%, -50%) scale(1);
  -moz-transform: translate(-50%, -50%) scale(1);
  transform: translate(-50%, -50%) scale(1);
 -webkit-transform: transition: transform .35s;
 -moz-transform: transition: transform .35s;
  transition: transform .35s;
}
	</style>
</head>



<body id="login_page">
<div class="account_setup_prgress w20"></div> 

 
 

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
					  <label class="m0 float-none" for="upload">
					  <div class="img_vid_upload_circle">
						<input class="d-none" type="file" name="" value="" id="upload">
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
					<label for="phonenumber" class="float-none">PhONE</label>
					<!--<input type="phonenumber" class="form-control h56" id="phonenumber" placeholder="Phone number" name="phonenumber">-->
					
					<div class="border br4 add_collaborators">
                	<div class="row">
                		<div class="col-md-7">
                			<input class="form_input" type="text" name="" value="" placeholder="Phone number" />
                		</div>
                		<div class="col-md-5 blef">
                			<select class="form_input p0" >
                				<option>US</option>
                				<option>CAN</option>
                				<option>IN</option>
                			</select>
                		</div>
                	</div>
                </div>
                
                
                
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
 

 
 
 
 
 <div id="Popup" class="Modal">
  <div class="content">
	<div class="toshow"></div>
	<!--<a href="#" class="cancel">Cancel</a>--> <span class="close_uploadimg"></span></div>
</div>


 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
	$.fn.expose = function(options) {
  
  var $modal = $(this),
      $trigger = $("a[href=" + this.selector + "]");
  
  $modal.on("expose:open", function() {
    
    $modal.addClass("is-visible");
    $modal.trigger("expose:opened");
  });
  
  $modal.on("expose:close", function() {
    
    $modal.removeClass("is-visible");
    $modal.trigger("expose:closed");
  });
  
  $trigger.on("click", function(e) {
    
    e.preventDefault();
    $modal.trigger("expose:open");
  });
  
  $modal.add( $modal.find(".close_uploadimg") ).on("click", function(e) {
    
    e.preventDefault();
    
    // if it isn't the background or close button, bail
    if( e.target !== this )
      return;
    
    $modal.trigger("expose:close");
  });
  
  return;
}

$("#Popup").expose();

// Example Cancel Button

$(".cancel").on("click", function(e) {
  
  e.preventDefault();
  $(this).trigger("expose:close");
});

$("input[type='file']").on("change", function(event1) {
  src1 = URL.createObjectURL(event1.target.files[0]);
    $(".toshow").css('background-image','none');
  $(".toshow").css('background-image','url(' + src1 + ')');
    $(".Modal").trigger("expose:open");

});
	</script>

</body>
</html>