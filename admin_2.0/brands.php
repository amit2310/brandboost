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
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/css/styleguide.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

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
   	<h3 class="htxt_medium_24 dark_700">Brand Page</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
   	</div>
   </div>
   </div>
    <div class="clearfix"></div>
</div>
	 
	  
	  
	  
 <!--******************
  Content Area
 **********************-->
   <div class="content-area">
   
   
  <!--============Seeting sidebar===================-->
  <div class="email_review_config p20 d-none">
    <div class="bbot pb10 mb15">
      <p class="fsize11 text-uppercase dark_200 m-0">Component</p>
    </div>
    <div class="p0">
      <h3 class="dark_400 mb0 fsize13 fw300">Logo &nbsp;
        <label class="custom-form-switch float-right">
        <input class="field" type="checkbox" checked="">
        <span class="toggle email"></span> </label>
      </h3>
      <h3 class="dark_400 mb0 fsize13 fw300">Question &nbsp;
        <label class="custom-form-switch float-right">
        <input class="field" type="checkbox" checked="">
        <span class="toggle email"></span> </label>
      </h3>
      <h3 class="dark_400 mb0 fsize13 fw300">Introduction &nbsp;
        <label class="custom-form-switch float-right">
        <input class="field" type="checkbox" checked="">
        <span class="toggle email"></span> </label>
      </h3>
    </div>
    <div class="bbot btop pb10 pt10 mb15 mt15">
      <p class="fsize11 text-uppercase dark_200 m-0">Popup Details</p>
    </div>
    <div class="p0">
      <div class="form-group">
        <label class="fsize12" for="fname">Brand / Product Name:</label>
        <input type="text" class="form-control h40" id="fname" placeholder="Enter name" name="fname">
      </div>
      <div class="form-group">
        <label class="fsize12" for="Questions">Questions:</label>
        <textarea class="form-control" id="Questions"></textarea>
      </div>
      <div class="form-group">
        <label class="fsize12" for="Introduction">Introduction:</label>
        <textarea class="form-control" id="Introduction"></textarea>
      </div>
      <div class="form-group">
        <label class="fsize12">Introduction:</label>
        <label class="m0 w-100" for="upload">
        <div class="img_vid_upload_medium">
          <input class="d-none" type="file" name="" value="" id="upload">
        </div>
        </label>
      </div>
    </div>
    <div class="bbot btop pb10 pt10 mb15 mt15">
      <p class="fsize11 text-uppercase dark_200 m-0">Settings</p>
    </div>
    <div class="p0 pb30">
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Question Text Color :</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic1" value="#20BF7E">
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Introduction Text Color:</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic2" value="#000000">
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Button Text Color :</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic3" value="#ffffff">
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Button Background Color :</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic4" value="#333333">
        </div>
      </div>
    </div>
  </div>
  <!--============Seeting sidebar END===================-->
  
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-3 col-lg-4">
        <div class="card p-0 brand_sidebar">
        	<div class="p20 bbot">
        		<ul class="nav nav-pills profile_tab" role="tablist">
				<li class="mr20"><a class="htxt_bold_14 active" data-toggle="pill" href="#Configurations">Configurations</a></li>
				<li class="mr20"><a class="htxt_bold_14" data-toggle="pill" href="#Design">Design</a></li>
				<li class="mr20"><a class="htxt_bold_14" data-toggle="pill" href="#Campaign">Campaign</a></li>
			  </ul>
        	</div>
        	<div class="p0">
        		<div class="tab-content">
			   <!--======Tab 1====-->
				<div id="Configurations" class="tab-pane active">
					<div class="p20 bbot pt10 pb10">
					 <p class="text-uppercase m-0 fw400 dark_200">Template <a class="float-right" href="#"><i class="icon-arrow-down12 fsize15"></i></a></p>	
					</div>
					<div class="p20">
					 <button class="btn br6 border p15 w-100 shadow-none">Horizontal Popup</button>
					</div>
					
					<div class="p20 bbot btop pt10 pb10">
					 <p class="text-uppercase m-0 fw400 dark_200">Company info  <a class="float-right" href="#"><i class="icon-arrow-down12 fsize15"></i></a></p>	
					</div>
					<div class="p20">
						<h3 class="dark_500 mb0 fsize14 fw400">Avatar
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox" checked>
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Company description
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Services
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox" checked>
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Contact Us Button
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox" checked>
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Contact Info
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox" checked>
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 
						 <h3 class="dark_500 mb0 fsize14 fw400">Socials
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Customer Experiance
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
					</div>
					
					<div class="p20 bbot btop pt10 pb10">
					 <p class="text-uppercase m-0 fw400 dark_200">Position on page  <a class="float-right" href="#"><i class="icon-arrow-down12 fsize15"></i></a></p>	
					</div>
					<div class="p20">
						<div class="p0 m-0">
                                                <div class="form-group select_box">
                                                    <label class="mb0 float-left">About company / Media </label>
                                                    <select name="about_company_position" id="about_company_position" class="selectbox_cls form-control changeAction" action-type="about_company">
                                                        <option value="left" selected="">Left</option>
                                                        <option value="right">Right</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="form-group select_box">
                                                    <label class="float-left mb0">Reviews list </label>
                                                    <select name="reviews_list_position" id="reviews_list_position" class="selectbox_cls form-control changeAction" action-type="review_list">
                                                        <option value="left">Left</option>
                                                        <option value="right" selected="">Right</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="form-group select_box">
                                                    <label class="float-left mb0">Rating (Reviews Summary) </label>
                                                    <select name="show_rating" id="show_rating" class="selectbox_cls form-control changeAction" action-type="rating">
                                                        <option value="">Show Rating</option>
                                                        <option value="on" selected="">On</option>
                                                        <option value="off">Off</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="clearfix"></div>
                                            </div>
					</div>
					
					<div class="p20 bbot btop pt10 pb10">
					 <p class="text-uppercase m-0 fw400 dark_200">Company info  <a class="float-right" href="#"><i class="icon-arrow-down12 fsize15"></i></a></p>	
					</div>
					<div class="p20">
						<h3 class="dark_500 mb0 fsize14 fw400">Show chat widget
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox" checked>
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Show email & referral widgets
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
					</div>
					<div class="p20 btop">
						<button class="btn btn-md bkg_blue_200 light_000 w-100">Save </button>
					</div>
					
					
					
					
					
					
					
				</div>
				<!--======Tab 2=====-->
				<div id="Design" class="tab-pane fade">
					<div class="p20 bbot pt10 pb10">
					 <p class="text-uppercase m-0 fw400 dark_200">Page appearance <a class="float-right" href="#"><i class="icon-arrow-down12 fsize15"></i></a></p>	
					</div>
					<div class="p20 bbot">
						<img class="circle-icon-64" width="65" src="assets/images/avatar/01.png"/>
						<img class="circle-icon-64" width="65" src="assets/images/avatar/02.png"/>
					</div>
					<div class="p20">
					 <div class="form-group">
					<label class="fsize12">Company Avatar:</label>
					<label class="m0 w-100" for="upload">
					<div class="img_vid_upload_medium">
					  <input class="d-none" type="file" name="" value="" id="upload">
					</div>
					</label>
				  </div>
				  
				  	<div class="form-group">
					<label class="fsize12">Header Avatar:</label>
					<label class="m0 w-100" for="upload">
					<div class="img_vid_upload_medium">
					  <input class="d-none" type="file" name="" value="" id="upload">
					</div>
					</label>
				  </div>
				  
				  <div class="form-group">
					<label class="fsize12">Company info:</label>
					<div class="card border p-0">
					<div class="p-2 bbot">
						<input style="border: none;" type="text" class="form-control fsize14" placeholder="" value="Company" />
					</div>	
					<div class="p-2">
						<textarea class="form-control fsize13 dark_600" style="border: none; min-height: 120px; ">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</textarea>
					</div>
					</div>
				  </div>
				  
				  <div class="form-group">
                                           
                                        <select class="form-control h56 fsize14" name="brand_themes" id="brand_themes">
                                        <option value="">Choose Brand Theme</option>
                                                                                         <option value="42">Default 1</option>
                                                                                         <option value="43">Default 2</option>
                                                                                         <option value="44">Default 3</option>
                                                                                         <option value="45">My Theme</option>
                                                                                         <option value="46">mytheme5</option>
                                                                                         <option value="47">Mytheme9</option>
                                                                                         <option value="48">TestThme1</option>
                                                                                         <option value="49">Theme2</option>
                                                                                         <option value="50">Theme3</option>
                                                                                         <option value="51">Theme5</option>
                                                                                         <option value="52">theme7</option>
                                                                                         <option value="53">theme9</option>
                                                                                      </select>
                                        </div>
                                        
                                        
                                        
                                        
				  
				  
				  
				  
				  		
					</div>
					
					
								<!---------------Dual Pane Design----------------->
									<div class="p20 bbot btop pt10 pb10 bkg_light_050">
									  <h3 class="text-uppercase m-0 fw400 dark_200 fsize13">Dual Pane Design
									  <label class="custom-form-switch float-right">
										<input class="field" type="checkbox" checked="">
										<span class="toggle email"></span>
									  </label>
									 </h3>
									</div>
									<div class="p20">
										 <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Single Color picker <small class="text-lowercase dark_200">Solid color</small>
										  <label class="custom-form-switch float-right">
											<input class="field" type="checkbox" checked="">
											<span class="toggle email"></span>
										  </label>
										 </h3>
										 <div class="form-group">
										 <input type="text" class="form-control" value="#ffffff" />	
										 </div>
										 
										
										 <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">MAIN Gradient color <small class="text-lowercase dark_200">Gradient</small>
										  <label class="custom-form-switch float-right">
											<input class="field" type="checkbox" checked="">
											<span class="toggle email"></span>
										  </label>
										 </h3>
                                    	<div class="form-group">
                                    		<div class="color_box">
												<div class="color_cube dred"></div>
												<div class="color_cube yellow"></div>
												<div class="color_cube red"></div>
												<div class="color_cube green active"></div>
												<div class="color_cube blue"></div>
												<div class="color_cube black"></div>
												<div class="clearfix"></div>
											</div>
                                    	</div>
                                    	<h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
                                    	<div class="form-group">
                                    		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                    	</div>
                                    
                                     
                                       <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Gradient Color picker <small class="text-lowercase dark_200">Custom Gradient color</small>
										  <label class="custom-form-switch float-right">
											<input class="field" type="checkbox" checked="">
											<span class="toggle email"></span>
										  </label>
										 </h3>
                                       <div class="form-group">
                                       	<div class="row">
                                       		<div class="col-md-6">
											  <input type="text" class="form-control colorpicker-basic1" value="#20BF7E">
											</div>
                                      	<div class="col-md-6">
											  <input type="text" class="form-control colorpicker-basic2" value="#000000">
											</div>
                                       	</div>
                                       </div>
                                       <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
                                    	<div class="form-group">
                                    		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                    	</div>
                                        </div>
                                        
                                        
                                        
                                     <!---------------Single Pane Design----------------->   
                                    <div class="p20 bbot btop pt10 pb10 bkg_light_050">
									  <h3 class="text-uppercase m-0 fw400 dark_200 fsize13">Single Pane Design
									  <label class="custom-form-switch float-right">
										<input class="field" type="checkbox" checked="">
										<span class="toggle email"></span>
									  </label>
									 </h3>
									</div>
									
									<div class="p20">
										 <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Single Color picker <small class="text-lowercase dark_200">Solid color</small>
										  <label class="custom-form-switch float-right">
											<input class="field" type="checkbox" checked="">
											<span class="toggle email"></span>
										  </label>
										 </h3>
										 <div class="form-group">
										 <input type="text" class="form-control" value="#ffffff" />	
										 </div>
										 
										
										 <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">MAIN Gradient color <small class="text-lowercase dark_200">Gradient</small>
										  <label class="custom-form-switch float-right">
											<input class="field" type="checkbox" checked="">
											<span class="toggle email"></span>
										  </label>
										 </h3>
                                    	<div class="form-group">
                                    		<div class="color_box">
												<div class="color_cube dred"></div>
												<div class="color_cube yellow"></div>
												<div class="color_cube red"></div>
												<div class="color_cube green active"></div>
												<div class="color_cube blue"></div>
												<div class="color_cube black"></div>
												<div class="clearfix"></div>
											</div>
                                    	</div>
                                    	<h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
                                    	<div class="form-group">
                                    		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                    	</div>
                                    
                                     
                                       <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Gradient Color picker <small class="text-lowercase dark_200">Custom Gradient color</small>
										  <label class="custom-form-switch float-right">
											<input class="field" type="checkbox" checked="">
											<span class="toggle email"></span>
										  </label>
										 </h3>
                                       <div class="form-group">
                                       	<div class="row">
                                       		<div class="col-md-6">
											  <input type="text" class="form-control colorpicker-basic1" value="#20BF7E">
											</div>
                                      	<div class="col-md-6">
											  <input type="text" class="form-control colorpicker-basic2" value="#000000">
											</div>
                                       	</div>
                                       </div>
                                       <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
                                    	<div class="form-group">
                                    		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                    	</div>
                                        </div>
									
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div class="p20 bbot btop pt10 pb10">
										 <p class="text-uppercase m-0 fw400 dark_200">Save Brand Theme Settings <a class="float-right" href="#"><i class="icon-arrow-down12 fsize15"></i></a></p>	
										</div>
										<div class="p20">
										<div class="form-group">
											<input type="text" class="form-control h40" id="fname" placeholder="Create Brand Theme" name="fname">
										  </div>
										<button class="btn btn-md bkg_blue_200 light_000 w-100">Save Brand Theme </button>
                                        </div>
                                        
                                        
                                        
				</div>
				<!--======Tab 3=====-->
				<div id="Campaign" class="tab-pane fade">
					<div class="p20 bbot pt10 pb10">
					 <p class="text-uppercase m-0 fw400 dark_200">Select Campaign  <a class="float-right" href="#"><i class="icon-arrow-down12 fsize15"></i></a></p>	
					</div>
					<div class="p20">
						<h3 class="dark_500 mb0 fsize14 fw400">Select All
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox" checked>
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
						 <h3 class="dark_500 mb0 fsize14 fw400">Test
						  <label class="custom-form-switch float-right">
							<input class="field" type="checkbox">
							<span class="toggle email"></span>
						  </label>
						 </h3>
					</div>
					<div class="p20 btop">
						<button class="btn btn-md bkg_blue_200 light_000 w-100">Save </button>
					</div>
				</div>
				
			  </div>
        	</div>
        </div>
        
        
        
        <div class="card p0 animate_top">
        <div class="p20 bbot">
        	<span class="fsize14 fw400 dark_600">Help</span>
        </div>
        <div class="p30 text-center">
        	<div class="max_w_225 m-auto">
    			<img class="mb-3" src="assets/images/smiley_optimization.svg">	
				<h3 class="htxt_medium_16 dark_700 mb-3">Company info</h3>
   				<p class="htxt_regular_14 dark_400 lh_20">Your can change your company
				description, services and contact info
				on Brand Settings page</p>	
   				<a class="htxt_medium_12 email_500" href="#">Change company info</a>
    			</div>
        </div>
    		</div>
    		
    		
    		
    		
      </div>
      
      <div class="col-xl-9 col-lg-8">
        <div class="card p-0">
        	<div class="p20 bbot">
        	<span class="fsize14 fw400 dark_600">Statistic</span>
        	</div>
        	<div class="p20">
        		<img src="http://brandboost.io/new_pages/assets/images/browser_top.png"/>
        		<img src="http://brandboost.io/new_pages/assets/images/brand_page2.jpg"/>
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
<script src="assets/js/spectrum.js"></script>
<script src="assets/js/app.js"></script>

<script>
$(".colorpicker-basic1").spectrum();
$(".colorpicker-basic2").spectrum();
$(".colorpicker-basic3").spectrum();
$(".colorpicker-basic4").spectrum();
</script>


</body>
</html>