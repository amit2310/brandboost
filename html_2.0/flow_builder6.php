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
#div1 {
  width: 350px;
  height: 70px;
  padding: 10px;
  border: 1px solid #aaaaaa;
}



.droppable_highlight{border:none !important; height: 57px !important; background: none !important; border-style: none !important;}
.droppable_highlight:before{ height:36px!important; border-radius:100px!important; width:36px!important;position:absolute; content:''; left:50%; top:12px; background: #73ABFF;opacity: 0.1; margin-left:-18px; }
.droppable_highlight  .workflowadds{ background:#73ABFF!important}


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
   
   		<!--<ul class="wf_nodes">
         <li><a class="circle-icon-28 bkg_blue_300" href="#" id="drag1" draggable="true" ondragstart="drag(event)"><img src="assets/images/flashlight-fill-white.svg"> </a></li>
         <li><a class="circle-icon-28 bkg_brand_300" href="#"><img src="assets/images/time-fill-14.svg"> </a></li>
         <li><a class="circle-icon-28 bkg_sms_400" href="#"><img src="assets/images/checkbox-circle-fill-white.svg"> </a></li>
         <li><a class="circle-icon-28 bkg_yellow_500" href="#"><img src="assets/images/mail-open-fill-white.svg"> </a></li>
         <li><a class="circle-icon-28 bkg_email_300" href="#"><img src="assets/images/split-white.svg"> </a></li>
         <li><a class="circle-icon-28 bkg_dark_100" href="#"><img src="assets/images/flag-2-fill.svg"> </a></li>
        </ul>-->
        
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
    
    
   <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    
    
    
    
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
        <div class="col-12 text-center derppable_grid droppable_highlight">
         <a class="workflowadds slidebox" href="#"><i class="ri-add-fill"></i></a> 
         </div>
        <!--=====DELAY Card=============-->
        <div class="col-md-12">
          <div class="workflow_card ">
            <div class="wf_icons br100 bkg_blue_300 border"><img width="18" src="assets/images/time-fill-14.svg"></div>
            <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">DELAY </p>
            <p class="dark_200 fsize13 fw500 mb15 ls4">Empty Delay </p>
            <div class="p0 pt12 btop">
              <ul class="workflow_list">
                <li style="border:none;"><a class="blue_300 fw500 fsize11" href="#"><span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> ADD DELAY</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!--=====ADD nodes single circle plus icon=============-->
        <div class="col-12 text-center"> <a class="workflowadds slidebox" href="#"><i class="ri-add-fill"></i></a> </div>
        <!--=====ADD SPLIT TEST=============-->
        <div class="col-md-12">
          <div class="workflow_switch_div_small canvas mb0 mt0 text-center" style="width:142px;"> <a class="workflow_switch email_300" href="#"><i class="ri-percent-line email_300"></i> ADD SPLIT TEST</a> </div>
        </div>
        <!--=====Split Image top=============-->
        <div class="col-md-12 text-center">
        <div class="split_icons_ab">
         <span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">a</span>
         <span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">b</span>
        </div>
        <img src="assets/images/wfline.png"></div>
        <!--=====ADD nodes 2 circle icon ========-->
        <div class="col-md-12">
          <div class="row">
            <div class="col-6 text-center"> <a class="workflowadds slidebox mt-2" href="#"><i class="ri-add-fill"></i></a> </div>
            <div class="col-6 text-center"> <a class="workflowadds slidebox mt-2" href="#"><i class="ri-add-fill"></i></a> </div>
          </div>
        </div>
        <!--=====Splited two cards ========-->
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
              <div class="workflow_card top_line_20">
              
              <img class="mb-2" src="assets/images/plus_circle_36.svg"/><br>

              <a class="blue_300 fw500 fsize11" href="#"> ADD NODE</a>
                <!--<div class="edit_delete"> <a href="#"><i class="icon-gear fsize12 dark_100"></i></a> <a href="#"><i class="icon-bin2 fsize10 dark_100"></i></a> </div>
                <div class="wf_icons br12 bkg_sms_400"><img src="assets/images/sms-white-16.svg"></div>
                <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">SMS </p>
                <p class="dark_600 htxt_medium_14 mb15">Sale Campaign #1 </p>
                <div class="p0 pt12 btop">
                  <ul class="workflow_list">
                    <li><a href="#"><span><img src="assets/images/send-plane-2-fill.svg"></span> 28%</a></li>
                    <li><a href="#"><span><img src="assets/images/cursor_fill_16.svg"></span> 12%</a></li>
                  </ul>
                </div>-->
              </div>
            </div>
          </div>
        </div>
        <!--=====ADD nodes 2 circle plus icon ========-->
        <div class="col-md-12">
          <div class="row">
            <div class="col-6 text-center"> <a class="workflowadds slidebox mt-4 mb-2" href="#"><i class="ri-add-fill"></i></a> </div>
            <div class="col-6 text-center"> <a class="workflowadds slidebox mt-4 mb-2" href="#"><i class="ri-add-fill"></i></a> </div>
          </div>
        </div>
        <!--=====Split Image bot=============-->
        <div class="col-md-12"><img src="assets/images/wfline_reverse.png"></div>
        <!--=====ADD nodes single circle plus icon=============-->
        <div class="col-12 text-center"> <a class="workflowadds slidebox mt-0" href="#"><i class="ri-add-fill"></i></a> </div>
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
 <?php //include("wf_trigger_smart_popup_2.php"); ?>
 
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


<script>
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}
</script>


</body>
</html>