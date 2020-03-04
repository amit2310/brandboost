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
   	<h3 class="htxt_medium_24 dark_700">People Configuration</h3>
   	</div>
   	<div class="col-md-6 text-right d-none">
   		<button class="circle-icon-40 mr15"><img src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox">New  Companies<span><img src="assets/images/blue-plus.svg"/></span></button>
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
    <div class="col-md-3">
    
    <ul class="people_config_list">
    	<li><a href="#"><i><img src="assets/images/config_icon1.svg"/></i> Channels</a></li>
    	<li><a class="active" href="#"><i><img src="assets/images/config_icon2.svg"/></i> Website Widget </a></li>
    	<li><a href="#"><i><img src="assets/images/config_icon3.svg"/></i> Visitors</a></li>
    	<li><a href="#"><i><img src="assets/images/config_icon4.svg"/></i> Live Chat</a></li>
    	<li><a href="#"><i><img src="assets/images/config_icon5.svg"/></i> Auto Messages</a></li>
    	<li><a href="#"><i><img src="assets/images/config_icon6.svg"/></i> Chat Bots</a></li>
    	<li><a href="#"><i><img src="assets/images/config_icon7.svg"/></i> Configuration</a></li>
    	
    </ul>
    
		</div>
    	<div class="col-md-9">
    	
    	
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading active" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i><img src="assets/images/hello1.svg"/></i>SAY HELLO
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div class="row mb20">
        	<div class="col-md-6"><p class="htxt_medium_14 dark_700 mb-2">Auto Message</p>
        	<p class="htxt_regular_14 dark_400 mb-0">Use one of auto message to say hello</p>
        	</div>
        	
        	<div class="col-md-6" style="visibility: hidden">
        		<div class="form-group mb-0">
        			<label class="fsize12 dark_300 fw300">Language</label>
        			<input type="text" class="form-control h36" placeholder="English" />
        		</div>
        	</div>
        	
        </div>
        
        
        <div class="row mb20">
        	<div class="col-md-6"><p class="htxt_medium_14 dark_700 mb-2">Language</p>
        	<p class="htxt_regular_14 dark_400 mb-0">Set your default language</p>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group mb-0">
        			<label class="fsize12 dark_300 fw300">Language</label>
        			<input type="text" class="form-control h36" placeholder="English" />
        		</div>
        	</div>
        </div>
        
        
        <div class="row mb20">
        	<div class="col-md-6"><p class="htxt_medium_14 dark_700 mb-2">Greeting</p>
        	<p class="htxt_regular_14 dark_400 mb-0">Say hi to your site visitors</p>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group mb-0">
        			<label class="fsize12 dark_300 fw300">English</label>
        			<input type="text" class="form-control h36" placeholder="Hi, We’re BrandBoost!" />
        		</div>
        	</div>
        </div>
        
        
        <div class="row mb20">
        	<div class="col-md-6"><p class="htxt_medium_14 dark_700 mb-2">Team intro</p>
        	<p class="htxt_regular_14 dark_400 mb-0">Introduce yourself or your team</p>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group mb-0">
        			<label class="fsize12 dark_300 fw300">Language</label>
        			
        			<textarea class="form-control h-75 p20">We help business grow and connect you with your happy customers.</textarea>
        		</div>
        	</div>
        </div>
        
        
        <div class="row">
        	<div class="col-md-12 mb20">
        		<hr/>
        	</div>
        	<div class="col-md-12">
            <button class="btn btn-sm bkg_blue_300 light_000 pr20 min_w_160 fsize14 fw600">Save and continue</button>
            <a class="fsize14 fw400 ml20 dark_400" href="#">Cancel</a> </div>
        </div>
        
        
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i><img src="assets/images/time-fill-grey.svg"/></i>SET YOUR AVAILABILITY
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <i><img src="assets/images/apps-2-fill.svg"/></i>ADD LIVE CHAT HOME APPS
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <i><img src="assets/images/palette-fill.svg"/></i>STYLE LIVE CHAT WIDGET
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <i><img src="assets/images/settings-2-fill.svg"/></i>CONFIGURATIONS
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  
  
  
</div>
   		
   		
   		
   		
    		
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
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/app.js"></script>

<script>
	$('.panel-collapse').on('show.bs.collapse', function () {
    $(this).siblings('.panel-heading').addClass('active');
  });

  $('.panel-collapse').on('hide.bs.collapse', function () {
    $(this).siblings('.panel-heading').removeClass('active');
  });
	
	</script>
</body>
</html>