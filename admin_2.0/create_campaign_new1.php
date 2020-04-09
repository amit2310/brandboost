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
   	<h3 class="htxt_medium_24 dark_700">Campaigns</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"></button>
   		<button class="btn btn-md bkg_reviews_400 light_000" data-toggle="modal" data-target="#CREATEFORM">CREATE CAMPAIGN <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
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
    		<div class="card card_shadow min-h-280 pt-5 pb-5">
    		
    		
    		
     		<div class="row mb65">
     		<div class="col-md-12 text-center">
     			<img class="mt40" style="max-width: 250px; " src="assets/images/review_Illustration.svg">
     			<h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any campaigns</h3>
     			<h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import campaign!</h3>
     			<button class="btn btn-sm bkg_reviews_000 pr20 reviews_400" data-toggle="modal" data-target="#CREATEFORM">Create review campaign</button>
     		</div>
     		</div>
     		</div>
    	</div>
    	
    	
    	<div class="col-md-12 text-center mt-3">
    		<a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT CAMPAIGN</a>    	</div>
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
      <div class="modal-content review">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
      	<div class="row">
      		<div class="col-12">
      			<h3 class="htxt_medium_24 dark_800 mb-3">Review Campaign</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Select a type of campaign you would like to create and give it a title.</p>
      			<hr/>
      		</div>
      		
      		<div class="col-12">
      			<div class="form-group">
                <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN NAME</label>
                <!--<input type="text" class="form-control h48 fsize14 dark_200 br4" id="fname" placeholder="Enter new campaign name" name="fname">-->
                
                <div class="campaign_name_sec border br4 p10 pl20 pr20 fsize14 dark_200">
                	<div class="row">
                		<div class="col-10"><input type="text" class="textfield fsize14 dark_200" id="fname" placeholder="Enter new campaign name" name="fname"></div>
                		<div class="col-2">
                	<div class="dropdown campaign_forms">
					  <button class="btn dropdown-toggle bkg_light_000 w-100 p-1 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="inner_color_dot_selected bkg_light_800"></span>					  </button>
					  <div style="width:200px!important; top:18px; left:22px;"  class="dropdown-menu campaign_color_dropdown dropdown-menu-right p10 pt15 pb5" aria-labelledby="dropdownMenuButton2" >
						<p class="dark_200 fsize14 fw400 mb-3">Campaign color</p>
                        
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_300"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_200"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_100"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_green_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_green_200 active"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_yellow_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_red_300"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_red_500"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_brand_300"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_light_800"></span></a>					  </div>
					</div>
                		</div>
                	</div>
                </div>
                
                
                
                <!--<div class="campaign_name_sec active border br4 p10 pl20 pr20 fsize14 dark_200 mt-2">
                	<div class="row">
                		<div class="col-10"><input type="text" class="textfield fsize14 dark_200" id="fname" placeholder="Enter new campaign name" name="fname"></div>
                		<div class="col-2">
                	<div class="dropdown campaign_forms">
					  <button class="btn dropdown-toggle bkg_light_000 w-100 p-1 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="inner_color_dot_selected bkg_blue_400"></span>					  </button>
					  <div style="width:200px!important; top:18px; left:22px;"  class="dropdown-menu campaign_color_dropdown dropdown-menu-right p10 pt15 pb5" aria-labelledby="dropdownMenuButton2" >
						<p class="dark_200 fsize14 fw400 mb-3">Campaign color</p>
                        
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_300"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_200"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_100"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_green_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_green_200 active"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_yellow_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_red_300"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_red_500"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_brand_300"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_blue_400"></span></a>
                        <a class="campaign_color_dot" href="#"><span class="inner_color_dot bkg_light_800"></span></a>					  </div>
					</div>
                		</div>
                	</div>
                </div>-->
              </div>
      		</div>
      		
      		<div class="col">
      			<div class="form-group m-0">
                <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN TYPE</label>
                <div class="card border text-center shadow-none m-0 reviews">
                	<img class="mb-3" src="assets/images/review_icon1.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Manual Campaign</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Send review requests emails <br>& sms instantly to all or part <br>of your customers</p>
                </div>
              </div>
      		</div>
      		<div class="col">
      			<div class="form-group m-0">
                <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                <div class="card border text-center shadow-none m-0">
                	<img class="mb-3" src="assets/images/review_icon2.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Automated Campaign</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Automaticaly send email or sms<br> every time a new purchase or<br> contact is added</p>
                </div>
              </div>
      		</div>
      		
      		<div class="col-12">
      			<hr/>
      		</div>
      		
      		<div class="col-6">
            <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase">CONTINUE</button>
            <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="#">Close</a>            </div>
            
            <div class="col-6 text-right mt-2">
           	<a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">
     				<span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
     				LEARN MORE ABOUT CAMPAIGNS     			</a>            </div>
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
<script src="assets/js/app.js"></script>




<script>
	//side nav active script
	$(".nav-link.review").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.review").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>

<script>

    $(document).ready(function(){
        $("#CREATEFORM").modal('show');
    });

</script>
</body>
</html>