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
   	<div class="col-md-6">
   	<span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">People Contact</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox">ADD New Contact<span><img src="assets/images/blue-plus.svg"/></span></button>
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
    	<div class="col-md-12">
    		<div class="card card_shadow min-h-280">
    		
    		<div class="row mb65">
     		<div class="col-md-12 text-left">
     			<a class="lh_32 blue_400 htxt_bold_14" href="#">
     				<span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
     				Import contacts
     			</a>
     		</div>
     		<!--<div class="col-md-6 text-right">
     			<a class="lh_32 htxt_regular_14 dark_200" href="#">
     				<span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
     				Learn how to use Tag
     			</a>
     		</div>-->
     		</div>
     		
    		
     		<div class="row mb65">
     		<div class="col-md-12 text-center">
     			<img class="mt40" style="max-width: 250px; " src="assets/images/people_contact_image.svg">
     			<h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any contacts</h3>
     			<h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import contacts!</h3>
     			<button class="btn btn-sm bkg_blue_000 pr20 blue_300 slidebox">Add contact</button>
     		</div>
     		</div>
     		
     		</div>
    	</div>
    	
    	<div class="col-md-12 text-center mt-2">
    		<a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
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
 <?php include("people_contact_create_smart_popup.php"); ?>
 
    
 
 
 
 

 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>


<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker-plus.js"></script> 
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
var color_picker = $('.colorpickerplus-dropdown .colorpickerplus-container');
        color_picker.colorpickerembed();
        color_picker.on('changeColor', function(e,color){
			var el = $('.color-fill-icon', $('#color_picker'));
			if(color==null) {
			  //when select transparent color
			  el.addClass('colorpicker-color');
			} else {
			  el.removeClass('colorpicker-color');
        	  el.css('background-color', color);
			}
        });
</script>



</body>
</html>