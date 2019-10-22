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
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<style>
		.navbar-custom{background: #ffffff!important}
	</style>
</head>



<body id="PeopleSection" class="enlarge-menu">

<div class="page-wrapper ">
 <!--******************
 SIDEBAR NAVIGATION
 **********************-->
  <?php include("sidebar.php"); ?>
 

  <div class="page-content bkg_light_000">
  
  

  
  
  <div class="main_page_area left_area_360 bkg_light_100 h-100">
 <!--******************
  TOPBAR
 **********************-->
  <?php include("topbar.php"); ?>
  
  
 <!--******************
  Top Heading area
 **********************-->
  <div class="top-bar-top-section shadow2 bkg_light_000">
  <div class="container-fluid">
   <div class="row">
   	<div class="col-md-6 col-6">
   	<span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">Editor</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="assets/images/settings-3-fill.svg"/></button>
   		<button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="assets/images/play-fill.svg"/></button>
   		<button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="assets/images/checkbox-circle-fill.svg"/></button>
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
    
    <div class="row">
    	<div class="col-md-12 mb-3">
            main editor
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12 mb-3">
            <img class="w-100" src="assets/images/desktop.png"/>
    	</div>
    </div>
    
    
    
    
     </div>
   </div>
      
<!--******************
  Content Area End
 **********************-->
 
 </div>
 
 
 
<!--******************
 PAGE SIDEBAR
 **********************-->
<div class="page_sidebar width_360 bkg_light_000">
	 	<div class="inner2 shadow2">
			<div class="title-box">
			  <h6 class="menu-title" style="line-height: 36px;"><span class="button-menu-mobile_sidebar"><img src="assets/images/close_menu_circle.svg"></span> &nbsp; Open Menu</h6>
			</div>
			<!--<h3 class="htxt_medium_20 dark_800" >Appearance &nbsp; <span class="dark_200">Content</span></h3>-->
			<ul class="nav nav-pills sidebar" role="tablist">
				<li class="mr20">
				  <a class="htxt_medium_20 active" data-toggle="pill" href="#Appearance">Appearance</a>
				</li>
				<li class="">
				  <a class="htxt_medium_20" data-toggle="pill" href="#Content">Content</a>
				</li>
			  </ul>
        </div> 
        
        <!-- Tab panes -->
  <div class="tab-content">
    <div id="Appearance" class="tab-pane active">
      <div class="inner2 editor_option mt20">
          	<h4 class="htxt_regular_14 dark_300 mb10">Position</h4>
          	<div class="editor_position">
          		<div class="temp_box active"><div class="left_bot">&nbsp;</div></div>
          		<div class="temp_box"><div class="center">&nbsp;</div></div>
          		<div class="temp_box"><div class="right_bot">&nbsp;</div></div>
          		<div class="temp_box"><div class="bottom">&nbsp;</div></div>
          		<div class="temp_box last"><div class="top">&nbsp;</div></div>
          		<div class="clearfix"></div>
          	</div>
          	<hr />
          	
          	<h4 class="htxt_regular_14 dark_300 mb10">Image</h4>
          	<div class="form-group mb20">
          	<label class="display-block m0 w-100" for="companylogo" >
			  <div class="img_vid_upload_small">
			   <input class="d-none" type="file" name="" value="" id="companylogo"> 
			  </div>
			  </label>
          	</div>
          	
          	<h4 class="htxt_regular_14 dark_300 mb10">Content</h4>
          	<div class="card border p0 mb30 shadow_none">
          	<div class="p12 bbot">
          		<ul class="editor_icons">
          		<li><a href="#"><img src="assets/images/bold.svg"/></a></li>
          		<li><a href="#"><img src="assets/images/font-color.svg"/></a></li>
          		<li><a href="#"><img src="assets/images/font-size-2.svg"/></a></li>
          		<li><a href="#"><img src="assets/images/link.svg"/></a></li>
          		<li><a href="#"><img src="assets/images/list-unordered.svg"/></a></li>
          		</ul>
          	</div>
          	<textarea style="border: none; box-shadow: none; resize: none; min-height: 170px;" class="form-control p20" placeholder="Placeholder"></textarea>
			  </div>
         	<hr/>
         	
         	<h4 class="htxt_regular_14 dark_300 mb10 mt20">Widget color</h4>
          	<div class="form-group mb20">
          	
          	
          		<div class="phonenumber h50">
               <div class="colorbox">
               	 <div class="colorpickerplus-dropdown" id="color_picker">
					<button style="margin-top: 7px;" type="button" class="dropdown-toggle pickerbutton" data-toggle="dropdown">
					<span class="color-fill-icon dropdown-color-fill-icon"></span> &nbsp; #4F8AF4  &nbsp; <b class="caret"></b></button>
					<ul class="dropdown-menu">
					  <li class="disabled"><div class="colorpickerplus-container"></div></li>
					</ul>
				  </div>
               </div>
                </div>
                
                		
          	</div>
          	
          	<h4 class="htxt_regular_14 dark_300 mb10">Email title</h4>
          	<div class="form-group mb20">
          	<select class="form-control h50">
          		<option>Placeholder</option>
          		<option>Placeholder</option>
          		<option>Placeholder</option>
          		<option>Placeholder</option>
          		<option>Placeholder</option>
          	</select>
          	</div>
          	
          	
          </div>
    </div>
    <div id="Content" class="tab-pane fade">
		<div class="inner2 editor_option mt20">
			Content Goes here...
		</div>
    </div>
  </div>
    
    <div class="clearfix"></div>   
</div>
  
<!--******************
 END PAGE SIDEBAR
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
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker-plus.js"></script> 
<script src="assets/js/app.js"></script>




<script>	
	$(document.body).addClass('enlarge-menu');
	$(".button-menu-mobile_sidebar").click(function(){
	  $("body").toggleClass("enlarge-menu");
	  //$(".menu-title").text("Hello world!");
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