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


<style>

</style>

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
   	<h3 class="htxt_medium_24 dark_700">Forms </h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/settings-3-line.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000" data-toggle="modal" data-target="#CREATEFORM">CREATE FORM<span><img src="assets/images/blue-plus.svg"/></span></button>
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
     		<div class="col-md-6 text-left">
     			<a class="lh_32 blue_400 htxt_bold_14" href="#">
     				<span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
     				Import forms
     			</a>
     		</div>
     		<div class="col-md-6 text-right">
     			<a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">
     				<span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
     				LEARN HOW TO USE FORMS
     			</a>
     		</div>
     		</div>
     		
    		
     		<div class="row mb65">
     		<div class="col-md-12 text-center">
     			<img class="mt40" style="max-width: 225px; " src="assets/images/people_forms_icon_153.svg">
     			<h3 class="htxt_bold_18 dark_700 mt30">No sign up forms yet. Create a new one!</h3>
     			<h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import forms!</h3>
     			<button class="btn btn-sm bkg_blue_000 pr20 blue_300 slidebox" data-toggle="modal" data-target="#CREATEFORM">Create form</button>
     		</div>
     		</div>
     		
     		
     		
     		
     		
     			
     		</div>
    	</div>
    	
    	<div class="col-md-12 text-center mt-2">
    		<a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT CAMPAIGN</a>
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
  CREATEFORM  Popup
 **********************-->
 
 <!-- The Modal -->
  <div class="modal fade" id="CREATEFORM">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
      	<div class="row">
      		<div class="col-12">
      			<h3 class="htxt_medium_24 dark_800 mb-3">Contact Form</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Select a type of form you would like to create and give it a title.</p>
      			<hr/>
      		</div>
      		
      		<div class="col-12">
      			<div class="form-group">
                <label for="fname" class="fsize11 fw500 dark_600">FORM NAME</label>
                <input type="text" class="form-control h56 fsize12 dark_200 br4" id="fname" placeholder="Enter new form name" name="fname">
              </div>
      		</div>
      		
      		<div class="col-6">
      			<div class="form-group m-0">
                <label for="fname" class="fsize11 fw500 dark_600">FORM NAME</label>
                <div class="card border text-center shadow-none m-0 active2">
                	<img class="mb-3" src="assets/images/popup_form_icon.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Popup Form</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Design and customize a popup <br>form that can be triggered <br>on any page</p>
                </div>
              </div>
      		</div>
      		<div class="col-6">
      			<div class="form-group m-0">
                <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                <div class="card border text-center shadow-none m-0">
                	<img class="mb-3" src="assets/images/embed_form_icon.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Embedded Form</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Design and customize a form that<br> can be embeded on your site <br>and convert leads.</p>
                </div>
              </div>
      		</div>
      		
      		<div class="col-12">
      			<hr/>
      		</div>
      		
      		<div class="col-6">
            <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase">CONTINUE</button>
            <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="#">Close</a> 
            </div>
            
            <div class="col-6 text-right mt-2">
           	<a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">
     				<span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
     				LEARN HOW TO USE FORMS
     			</a>
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
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>


<!--<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker-plus.js"></script> -->
<script src="assets/js/app.js"></script>
<script>
//$(document).ready(function(){
//	$(".slidebox").click(function(){
//		$(".box").animate({
//			width: "toggle"
//		});
//	});
//});
</script>
<script>
//var color_picker = $('.colorpickerplus-dropdown .colorpickerplus-container');
//        color_picker.colorpickerembed();
//        color_picker.on('changeColor', function(e,color){
//			var el = $('.color-fill-icon', $('#color_picker'));
//			if(color==null) {
//			  //when select transparent color
//			  el.addClass('colorpicker-color');
//			} else {
//			  el.removeClass('colorpicker-color');
//        	  el.css('background-color', color);
//			}
//        });
</script>



</body>
</html>