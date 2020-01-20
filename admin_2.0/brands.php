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
	
.review_source_new{max-width: 210px; width: 100%; margin-bottom: 10px;}
.review_source_new label{width: 100%;}
.review_source_new .inner{text-align: center;  border-radius: 5px;  box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);  background-color: #ffffff;  /*border: solid 1px #e3e9f3;*/ min-height: 248px; position: relative; padding: 15px; border: 1px solid #eeeeee!important}
.review_source_new .inner figure{border-radius:0; margin-bottom: 15px;}
.review_source_new .inner img{border-radius: 5px 5px 0 0; width: 100%;}
.review_source_new .inner .text_sec{padding: 15px 10px 0; border-top: 1px solid #f4f6fa;}
.review_source_new .inner .text_sec p{margin-bottom: 5px;}
.review_source_new .inner .text_sec p strong{ font-size: 13px; font-weight: 400; color: #09204f;}
.review_source_new .inner .text_sec h5{ font-size: 12px; font-weight: 300!important; color: #5e729d; line-height: 1.33; margin: 0;}
.review_source_new .inner.active{border: 1px solid #9986e4!important }
.review_source_new .inner:hover{border: 1px solid #9986e4!important}
.review_source_new .inner .checkbox{position: absolute; right: -10px; top: -15px; z-index: 99}
.review_source_new .inner .checkbox label{padding-left: 20px!important;}
.review_source_new .inner .checker span{background: #9c88e6!important}
.review_source_new .inner .custmo_radiobox input:checked ~ .custmo_radiomark {	background-color: #9986e4!important;}
.review_source_new .inner .custmo_checkmark{border-radius: 50px; border: 1px solid #fff;}
.review_source_new .inner:after{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; content: ''; border-radius: 5px; display: none;}
.review_source_new :hover .inner:after{display: block; cursor: pointer; }
.review_source_new .custmo_checkbox.checkboxs{position: absolute; width: 17px; right: 5px!important; top: 11px; z-index: 9; display: inline-block;}
.review_source_new .custmo_checkbox.checkboxs input:checked .inner:after{display: block; cursor: pointer;}
	
	
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
					 <button class="btn br6 border p15 w-100 shadow-none slidebox fw400">Horizontal Popup</button>
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
        		<!--<img src="http://brandboost.io/new_pages/assets/images/brand_page2.jpg"/>-->
        		
        		<div class="brand_page_main">
 	<div class="brand_page_gr brand_page_pr">
   	<div class="page_header">
   	<div class="row">
		<div class="col-md-6"><img src="http://brandboost.io/new_pages/assets/images/walker_logo.jpg" alt="" class="br5" width="100px"></div>
		<div class="col-md-6 text-right"><a href="" class="light_000">FAQ</a></div>
   	</div>
   </div>
   </div>
   
   
   
   <div class="container">
   	<div class="row">
   		<div class="col-md-12">
   			<div class="card brand_top_sec">
   				<div class="row">
   					<div class="col-md-2 text-center">
   						<img class="mt-1" width="100" src="assets/images/avatar/02.png"/>
   					</div>
   					<div class="col-md-5">
   						<p class="fsize17 dark_600 mb-1">Company</p>
   						<p class="mb-1">
							<a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
							<a href="#"><i class="fa fa-star dark_400 fsize14"></i></a>
							<a href="#" class="fsize14 fw500">4.2</a>
						</p>
 						<p class="fsize13 dark_200 mb-3">139 customer reviews<br>   742 questions & answers</p>
 						<p class="fsize13 dark_200" style="max-width: 280px;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
 						
 							<div class="brand_btn_sec">
									<a href="#" class="customColor" style="color:#AB256F!important">Design Agency</a> 
									<a href="#" class="customColor" style="color:#AB256F!important">Design &amp; Development</a> 
									<a href="#" class="customColor" style="color:#AB256F!important">User Expirience Design</a> 
									<a href="#" class="customColor" style="color:#AB256F!important">Logo</a>
								</div>
								<div class="clearfix"></div>
								
								<button class="btn btn-md bkg_sms_400 light_000 mt10 br6"> Contact Us</button>
  						
   						
   					</div>
   					<div class="col-md-5">
							<div class="interactions mb30">
								<ul>
									<li><small><i class="icon-location3 mr10"></i>Country</small> <strong><img src="http://brandboost.io/assets/images/un_flag.png" alt=""> United States</strong></li>
									<li><small><i class="icon-city mr10"></i>City</small> <strong><span class="brig pr10 mr10">San-Francisco</span>  Worlwide</strong></li>
									<li><small><i class="icon-phone2 mr10"></i>Phone number</small> <strong>+3 8063 612 53 69</strong></li>
									<li><small><i class="fa fa-globe mr10"></i>Website</small> <strong>www.wakers.co</strong></li>
									<li><small><i class="icon-mail5 mr10"></i>Email</small> <strong>info@wakers.co</strong></li>
								</ul>
							</div>
							
							<div class="brand_social">
								<a href="#" class="customColor" style="color:#AB256F!important"><i class="fa fa-facebook" style="color:#AB256F!important"></i></a> 
								<a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-bubble" style="color:#AB256F!important"></i></a> 
								<a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-paperplane" style="color:#AB256F!important"></i></a> 
								<a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-youtube" style="color:#AB256F!important"></i></a> 
								<a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-twitter" style="color:#AB256F!important"></i></a> 
								<a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-instagram" style="color:#AB256F!important"></i></a> 
								<a href="#" class="customColor" style="color:#AB256F!important"><i class="fa fa-google" style="color:#AB256F!important"></i></a>
							</div>
						</div>
   				</div>
   			</div>
   		</div>
   	</div>
   	
   	<div class="row">
   		<div class="col-md-4">
   			<div class="card p-0">
   				<div class="p20 bbot">
   					<p class="m-0 fsize14 fw500 dark_500">Customer Experiance <span class="sms_400">(4.5)</span></p>
   				</div>
   				<div class="p20">
   					<div class="p0">
    		
    		<p class="fsize24 fw500 dark_800 mb-1">4.2</p>
    		<p class="mb-1">
    			<a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
    			<a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
    			<a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
    			<a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
    			<a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
    		</p>
    		<p class="fsize13 fw400 dark_200 mb-3 bbot pb-3">137 reviews - Based On 2,382 Review over the past year.</p>
    		
    		
    		
    					<div class="pb-3 pl-3 ratings bbot">
								<div class="row inner">
									<div class="col-1 pr-0 pl-0">
									<p>5 <i><img src="assets/images/star-fill-12.png"> </i></p>
									</div>
									<div class="col-10">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
									</div>
									</div>
									<div class="col-1 pr-0 pl-0"><p>37</p></div>
								</div>
								
								<div class="row inner">
									<div class="col-1 pr-0 pl-0">
									<p>4 <i><img src="assets/images/star-fill-12.png"> </i></p>
									</div>
									<div class="col-10">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:70%"></div>
									</div>
									</div>
									<div class="col-1 pr-0 pl-0"><p>57</p></div>
								</div>
								
								<div class="row inner">
									<div class="col-1 pr-0 pl-0">
									<p>3 <i><img src="assets/images/star-fill-12.png"> </i></p>
									</div>
									<div class="col-10">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20" style="width:20%"></div>
									</div>
									</div>
									<div class="col-1 pr-0 pl-0"><p>5</p></div>
								</div>
								
								<div class="row inner">
									<div class="col-1 pr-0 pl-0">
									<p>2 <i><img src="assets/images/star-fill-12.png"> </i></p>
									</div>
									<div class="col-10">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width:80%"></div>
									</div>
									</div>
									<div class="col-1 pr-0 pl-0"><p>7</p></div>
								</div>
								
								<div class="row inner">
									<div class="col-1 pr-0 pl-0">
									<p>1 <i><img src="assets/images/star-fill-12.png"> </i></p>
									</div>
									<div class="col-10">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20" style="width:20%"></div>
									</div>
									</div>
									<div class="col-1 pr-0 pl-0"><p>125</p></div>
								</div>
								
								
								
								
								
								
								
							
								
								
								</div>
								
								
								
				<p class="fsize14 dark_600 mt-3 mb-0"><i><img src="assets/images/chat-1-fill.svg"></i> &nbsp;  Powered by BrandBoost  </p>
    		
    		
    		
    	</div>
   				</div>
   			</div>
   			
   			
   			
   			<div class="p-0 brand_reviews">
   				<div class="card p-0 mb-1">
   					<div class="p15 bbot">
   						<figure class="float-left mr-3 mb-0">
   						<img width="38" src="assets/images/avatar/02.png"/>	
   						</figure>
   						
   						<p class="fsize12 fw500 dark_400 m-0">Dora Weber &nbsp;  <span class="fw400 dark_200">bought iPhone 8 Plus</span></p>
   						<p class="mb-0">
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star dark_400 fsize12"></i></a>
							<a href="#" class="fsize12 fw400 ml-2 dark_200">27 Mar. 2018</a>
						</p>
   					</div>
   					<div class="p15">
   						<p class="fsize13 dark_400 m-0">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
   					</div>
   					
   					<div class="p15 btop">
   						<p class="m-0 fsize12 dark_200">
   							<a class="mr-2" href="#"><i class="icon-comment fsize11"></i> 3 Comments</a> 
   							<a class="mr-2" href="#">4.0 Our of 5 Stars</a>
   							<a class="mr-2" href="#"><i class="icon-thumbs-up3 fsize10 green_400"></i></a>
   							<a href="#"><i class="icon-thumbs-down3 fsize10 red_400"></i></a>
   							
   						</p>
   					</div>
   				</div>
   				<div class="card p-0 mb-1">
   					<div class="p15 bbot">
   						<figure class="float-left mr-3 mb-0">
   						<img width="38" src="assets/images/avatar/06.png"/>	
   						</figure>
   						
   						<p class="fsize12 fw500 dark_400 m-0">Dora Weber &nbsp;  <span class="fw400 dark_200">bought iPhone 8 Plus</span></p>
   						<p class="mb-0">
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star dark_400 fsize12"></i></a>
							<a href="#" class="fsize12 fw400 ml-2 dark_200">27 Mar. 2018</a>
						</p>
   					</div>
   					<div class="p15">
   						<p class="fsize13 dark_400 m-0">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
   					</div>
   					
   					<div class="p15 btop">
   						<p class="m-0 fsize12 dark_200">
   							<a class="mr-2" href="#"><i class="icon-comment fsize11"></i> 3 Comments</a> 
   							<a class="mr-2" href="#">4.0 Our of 5 Stars</a>
   							<a class="mr-2" href="#"><i class="icon-thumbs-up3 fsize10 green_400"></i></a>
   							<a href="#"><i class="icon-thumbs-down3 fsize10 red_400"></i></a>
   							
   						</p>
   					</div>
   				</div>
   				<div class="card p-0 mb-1">
   					<div class="p15 bbot">
   						<figure class="float-left mr-3 mb-0">
   						<img width="38" src="assets/images/avatar/04.png"/>	
   						</figure>
   						
   						<p class="fsize12 fw500 dark_400 m-0">Dora Weber &nbsp;  <span class="fw400 dark_200">bought iPhone 8 Plus</span></p>
   						<p class="mb-0">
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
							<a href="#"><i class="fa fa-star dark_400 fsize12"></i></a>
							<a href="#" class="fsize12 fw400 ml-2 dark_200">27 Mar. 2018</a>
						</p>
   					</div>
   					<div class="p15">
   						<p class="fsize13 dark_400 m-0">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
   					</div>
   					
   					<div class="p15 btop">
   						<p class="m-0 fsize12 dark_200">
   							<a class="mr-2" href="#"><i class="icon-comment fsize11"></i> 3 Comments</a> 
   							<a class="mr-2" href="#">4.0 Our of 5 Stars</a>
   							<a class="mr-2" href="#"><i class="icon-thumbs-up3 fsize10 green_400"></i></a>
   							<a href="#"><i class="icon-thumbs-down3 fsize10 red_400"></i></a>
   							
   						</p>
   					</div>
   				</div>
   			</div>
   			
   			
   		</div>
   		<div class="col-md-8">
   			<div class="card p-0">
   				<div class="p20 bbot">
   					<p class="m-0 fsize14 fw500 dark_500">About our company</p>
   				</div>
   				<div class="p20">
   					<p class="fsize13 fw400 dark_400 lh_22">
   						Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forward), it was my cheerful duty to attend upon him while taking that hard-scrabble scramble upon the dead whale's back. You have seen Italian organ-boys holding a dancing-ape by a long cord. Just so, from the ship's steep side, did I hold Queequeg down there in the sea, by what is technically called in the fishery a monkey-rope, attached to a strong strip of canvas belted round his waist.
   					</p>
   					<a class="sms_400" href="#">Learn More</a>
   				</div>
   			</div>
   			
   			<div class="card p-0">
   				<div class="p20 bbot">
   					<p class="m-0 fsize14 fw500 dark_500">Media</p>
   				</div>
   				<div class="p20">
   					<div class="row">
   						<div class="col-md-6">
   							<div class="bkg_light_000 border br5 p-2 mb15">
   								<img class="w-100" src="http://brandboost.io/assets/images/brand_img11.jpg" />
   							</div>
   						</div>
   						<div class="col-md-6">
   							<div class="bkg_light_000 border br5 p-2 mb15">
   								<img class="w-100" src="http://brandboost.io/assets/images/brand_img10.jpg" />
   							</div>
   						</div>
   						<div class="col-md-6">
   							<div class="bkg_light_000 border br5 p-2 mb15">
   								<img class="w-100" src="http://brandboost.io/assets/images/brand_img9.jpg" />
   							</div>
   						</div>
   						<div class="col-md-6">
   							<div class="bkg_light_000 border br5 p-2 mb15">
   								<img class="w-100" src="http://brandboost.io/assets/images/brand_img8.jpg" />
   							</div>
   						</div>
   						<div class="col-md-6">
   							<div class="bkg_light_000 border br5 p-2 mb15">
   								<img class="w-100" src="http://brandboost.io/assets/images/brand_img7.jpg" />
   							</div>
   						</div>
   						<div class="col-md-6">
   							<div class="bkg_light_000 border br5 p-2 mb15">
   								<img class="w-100" src="http://brandboost.io/assets/images/brand_img12.jpg" />
   							</div>
   						</div>
   					</div>
   				</div>
   				
   				<div class="p20 btop">
   					<a class="sms_400 float-left" href="#">View all Review</a>
   					<a class="sms_400 float-right" href="#">></a>
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
 <?php include("choose_template_smart_popup.php"); ?>
 
    
 
 
 
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

<script>
$(document).ready(function(){
	$(".slidebox").click(function(){
		$(".box").animate({
			width: "toggle"
		});
	});
});
</script>

</body>
</html>