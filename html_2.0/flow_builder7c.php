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

<style>



</style>
</head>
<body id="ReviewSection">

<div class="page-wrapper">
 <!--******************
 SIDEBAR
 **********************-->
  <?php include("sidebar.php"); ?>
 

  <div class="page-content reviews_workflows canvas_view">
 <!--******************
  TOPBAR
 **********************-->
  <?php include("topbar.php"); ?>
  
  
 <!--******************
  Top Heading area
 **********************-->
  <div id="wf_top_bar" class="top-bar-top-section bbot shadow4">
  <div class="container-fluid">
   <div class="row">
   <div class="col-md-4 wf_nodes_top_icon">
   		<ul class="wf_nodes">
         <li><img id="drag1" draggable="true" ondragstart="drag(event)" src="assets/images/wf_drag_icon1.svg"/> </li>
         <li><img src="assets/images/wf_drag_icon2.svg"/></li>
         <li><img src="assets/images/wf_drag_icon3.svg"/></li>
         <li><img src="assets/images/wf_drag_icon4.svg"/></li>
         <li><img src="assets/images/wf_drag_icon5.svg"/></li>
         <li><img src="assets/images/wf_drag_icon6.svg"/></li>
        </ul>
   </div>
   	<div class="col-md-5">
       <div class="table_head_action mb0 mt-1">
       <ul class="table_filter">
    			<li><a class="active" href="#">Actions</a></li>
    			<li><a href="#">Settings</a></li>
    			<li><a href="#">Analytics</a></li>
    			<li><a href="#">History</a></li>
       </ul>
       </div>
   	</div>
   	<div class="col-md-3 col-3 text-right">
   		<!--<button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"></button>-->
        <button class="btn btn-md bkg_reviews_400 light_000 float-right">Save</button>
        <div class="float-right mr-3">
        <p class="fsize14 dark_600 m-0 float-left mr-3" style="line-height:33px;">Active </p>
    	<label class="custom-form-switch mt-2">
			<input class="field" type="checkbox" checked="">
			<span class="toggle green3"></span>		</label>
        </div>
   	</div>
   </div>
   </div>
    <div class="clearfix"></div>
</div>
	 
	  
	  
	  
 <!--******************
  Content Area
 **********************-->
   <div class="content-area pt20">
    <div class="container-fluid">
    
    <!--******************
	 PAGE LEFT SIDEBAR
	**********************-->
	<a class="close_sidebar" href="#">&nbsp; <img src="assets/images/menu-2-line.svg"></a>
	<div class="page_sidebar bkg_light_000 fixed">
 	<div style="width: 279px;">
	 	<div class="p20 bbot top_headings bkg_light_000">
	 		<div class="row">
	 			<div class="col"><p>WORKFLOW</p></div>
	 		</div>
	 	</div>
        
        <div class="p20 bkg_light_000 shadow4 min_h_65">
        	<div class="row">
	 			<div class="col"><p class="fsize12 fw500 dark_200 text-uppercase m-0">Nodes</p></div>
                <div class="col text-right"><p class="fsize14 fw400 dark_300 m-0"><img width="16" src="assets/images/list_check2.svg"/> &nbsp; Flow View</p></div>
	 		</div>
        </div>
        
        <div class="p30 workflow_list_box">
        <ul class="workflow_list_new">
        <li><a href="#"><span class="circle-icon-20 bkg_dark_100 rotate_45 "><span class="rotate_45_minus d-block"><i class="ri-play-fill"></i></span></span> Entry Trigger: Form</a></li>
        <li><a href="#"><span class="circle-icon-20 bkg_blue_300 br35"><i class="ri-time-fill"></i></span> Delay: 3 days </a></li>
        <li><a href="#"><span class="circle-icon-20 bkg_email_300 rotate_45 "><span class="rotate_45_minus d-block"><i><img class="align-top mt-1" width="12" src="assets/images/split-white.svg"/></i></span></span> Split Test</a></li>
        
       
        
        <hr>
        
        
        <li><a href="#"><span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">a</span> </a></li>
        <li><a href="#"><span class="circle-icon-20 bkg_blue_300"><i class="ri-folder-fill"></i></span> Action: Subscribe on List</a></li>
       
        
        <hr>
        
       
        <li><a href="#"><span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">b</span> </a></li>
        <li><a href="#"><span class="circle-icon-20 bkg_blue_300"><i class="ri-folder-fill"></i></span> Action: Subscribe on List</a></li>
       
        
        <hr>
        
        
        
        <li><a href="#"><span class="circle-icon-20 bkg_dark_100 rotate_45"><span class="rotate_45_minus d-block"><i class="ri-check-line"></i></span></span> Goal: Empty</a></li>
        </ul>
        </div>
      

        
       

    
    <div class="clearfix"></div> 
    </div>  
	</div>
    <!--******************
	 PAGE LEFT SIDEBAR END
	**********************-->
    <div id="wf_top_btn_area" class="">
    <div class="row mb20">
    <div class="col"><button class="circle-icon-32 bkg_reviews_400 mr15 shadow4 float-left"><img src="assets/images/plus_white_10.svg"></button>
    <div class="workflow_switch_div float-left">
    	<a class="workflow_switch" href="#"><i class="ri-arrow-left-line"></i></a>
        <a class="workflow_switch" href="#"><i class="ri-arrow-right-line"></i></a>    </div>
    </div>
    <div class="col">
    <div class="workflow_switch_div float-right">
    	<a class="workflow_switch" href="#"><i class="ri-list-check-2"></i> List view</a>
        <a class="workflow_switch active" href="#"><i class="ri-drag-move-line"></i> Canvas</a>    </div>
    </div>
    </div>
    </div>
    
    
   <!--<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>-->
    
    
    
    
<!--$$$$$$$$$$$$$$$$$$$$
WORKFLOW START
$$$$$$$$$$$$$$$$$$$$$$$-->
<div class="row">
  <div class="col-md-12">
    <div class="workflow_box">
      <div class="row">
        <!--=====TRIGGER card=============-->
        <div class="col-md-12">
          <div class="workflow_card">
            <div class="wf_icons br12 bkg_dark_100 rotate_45 border"><img class="rotate_45_minus small" src="assets/images/play_white_small.svg"></div>
            <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">TRIGGER </p>
            <p class="dark_200 fsize13 fw500 mb15">Submitted a form</p>
            <div class="p0 pt12 btop">
              <ul class="workflow_list">
                <li style="border:none;"><a class="dark_200 fsize12" href="#"><span class="d-inline-block"><i class="ri-file-list-2-fill blue_300 fsize15"></i></span> Lead Form Home</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!--=====ADD nodes single circle plus icon=============-->
        <!--<div class="col-12 text-center derppable_grid droppable_highlight">-->
        <div class="col-12 text-center">
         <a class="workflowadds slidebox" href="#"><i class="ri-add-fill"></i></a> 
         </div>
        <!--=====Decision Card=============-->
        <div class="col-md-12">
          <div class="workflow_card decision_border2">
                <div class="wf_icons br12 bkg_decision_300 rotate_45 border"><img class="rotate_45_minus" width="18" src="assets/images/arrow_right_line.svg"></div>
                <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">DECISION </p>
                <p class="dark_200 fsize13 fw500 mb15 ls4">Empty Decision </p>
                <div class="p0 pt12 btop">
                  <ul class="workflow_list">
                    <li style="border:none;"><a class=" decision_300 fw500 fsize11" href="#"><span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> SET UP DECISION</a></li>
                  </ul>
                </div>
              </div>
        </div>
        <!--=====ADD nodes single circle plus icon=============-->
        <div class="col-12 text-center"> <a class="workflowadds slidebox" href="#"><i class="ri-add-fill"></i></a> </div>
       
       <!--=====Action Card=============-->
        <div class="col-md-12">
          <div class="workflow_card ">
                <div class="wf_icons br12 bkg_blue_300 border"><img width="18" src="assets/images/flashlight-fill-white.svg"></div>
                <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">ACTION </p>
                <p class="dark_200 fsize13 fw500 mb15 ls4">Conversion Goal </p>
                <div class="p0 pt12 btop">
                  <ul class="workflow_list">
                    <li style="border:none;"><a class="blue_300 fw500 fsize11" href="#"><span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> ADD ACTION</a></li>
                  </ul>
                </div>
              </div>
        </div>
        
        
        <!--=====ADD nodes single circle plus icon=============-->
        <div class="col-12 text-center"> <a class="workflowadds slidebox" href="#"><i class="ri-add-fill"></i></a> </div>
        <!--=====Goal End=============-->
        <div class="col-md-12 mb-3">
          <div class="workflow_box">
            <div class="row">
              <div class="col-md-12">
                <div class="workflow_card">
                  <div class="wf_icons br12 bkg_dark_100 rotate_45 border"><img class="rotate_45_minus small" src="assets/images/play_white_small.svg"></div>
                  <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">GOAL </p>
                  <p class="dark_200 fsize13 fw500 mb15 ls4">Conversion Goal </p>
                  <div class="p0 pt12 btop">
                    <ul class="workflow_list">
                      <li style="border:none;"><a class="blue_300 fw500 fsize11" href="#"><span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> ADD GOAL</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--$$$$$$$$$$$$$$$$$$$$
WORKFLOW END
$$$$$$$$$$$$$$$$$$$$$$$-->


    
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
 <?php include("wf_decision_smart_popup3.php"); ?>
 
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
	
	
	  // wf  top navigation fixed on scroll 
		$( window ).scroll( function () {
			var sc = $( window ).scrollTop();
			if ( sc > 100 ) {
				$( "#wf_top_bar" ).addClass( "wf_top_area_fixed" );
			} else {
				$( "#wf_top_bar" ).removeClass( "wf_top_area_fixed" );
			}
		} );
		
		
		// wf  top navigation fixed on scroll 
		$( window ).scroll( function () {
			var sc = $( window ).scrollTop();
			if ( sc > 100 ) {
				$( "#wf_top_btn_area" ).addClass( "wf_button_fixed" );
			} else {
				$( "#wf_top_btn_area" ).removeClass( "wf_button_fixed" );
			}
		} );
		
		
</script>





</body>
</html>