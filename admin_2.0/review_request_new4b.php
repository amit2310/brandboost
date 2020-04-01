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
   	<h3 class="htxt_medium_24 dark_700">Review Campaign</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="btn btn-md bkg_light_800 light_000" data-toggle="modal" data-target="#RequestAddTags" >Send Request <span><img src="assets/images/arrow-right-circle-fill-white.svg"></span></button>
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
    
        <!--******************
	 PAGE LEFT SIDEBAR
	**********************-->
	<a class="close_sidebar" href="#">&nbsp; <img src="assets/images/menu-2-line.svg"></a>
	<div class="page_sidebar bkg_light_000 fixed">
 	<div style="width: 279px;">
	 	<div class="p20 bbot top_headings">
	 		<div class="row">
	 			<div class="col"><p>REVIEW request</p></div>
	 		</div>
	 	</div>
      
      <div class="p30 pb10 text-center">
      	<img src="assets/images/rev-req-80.svg"/>      </div>
       
      					<div class="p30 pb15">
     						<div class="row">
     							<div class="col-9">
     								<p class="htxt_medium_12 dark_200 ls_4 m-0 ml20">EMAIL REQUESTS</p>
     							</div>
     							<!--<div class="col-3">
     								<label class="custom-form-switch mt-0 float-right">
										<input class="field" type="checkbox" checked="">
										<span class="toggle reviews"></span>									</label>
     							</div>-->
     						</div>
      						<ul class="list_review mt-3">
     							<li><a class="active" href="#">Recipients</a></li>
                                <li><a class="done" href="#">From</a></li>
                                <li><a class="done" href="#">Email Subject</a></li>
                                <li><a class="done" href="#">Content</a></li>
                                <li><a class="done" href="#">Settings & Tracking</a></li>
     							
     						</ul>
      					</div>
      					
      				
      					
      					
      					<div class="reviw_howtouse">
      						<a href="#" class="close_x_icon2"><img src="assets/images/close_grey_line.svg"/></a>
      						<p class="fsize12 fw300 light_000">Learn how to use <br><strong>Requests</strong> in 60 seconds</p>
							<img src="assets/images/review_play.svg"/>      					</div>
        
       

    
    <div class="clearfix"></div> 
    </div>  
</div>
   <!--******************
	 PAGE LEFT SIDEBAR END
	**********************-->
   
   
   
   
    
    <div class="table_head_action pb0 mb15">
    <div class="row">
    	<div class="col">
    		<h3 class="htxt_medium_14 dark_600">Email request</h3>
    	</div>
    	<!--<div class="col text-right">
    	<p class="fsize14 dark_600 m-0">On &nbsp; &nbsp;
    	<label class="custom-form-switch mt-0">
			<input class="field" type="checkbox" checked="">
			<span class="toggle green3"></span>		</label>
   		</p>
    	</div>-->
    </div>
    </div>
    
    
    <div class="row">
    	<div class="col-12">
    		<div class="card p35 br6 mb10">
    			<div class="row">
    				<div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span></div>
    				<div class="col">
    					<h3 class="htxt_medium_16 dark_700 mb-2">Recipients</h3>
    					<p class="htxt_regular_14 dark_400 m-0 ls4">Who are you sending your request to?</p>
    				</div>
    				<div class="col text-right">
    					<!--<button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add sender</button>-->
    					<button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Cancel</button>
    					<button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20">Save</button>
    				</div>
    			</div>
                
                <div class="btop mt30 pt30">
    				<div class="row">
    					<div class="col-12">
    						<div class="form-group">
    							<label class="dark_600 fsize11 fw500 ls4"><img src="assets/images/addcirclegreen.svg"/> &nbsp; RECIPIENTS</label>
    							
    							<input type="text" class="form-control h48" placeholder="Enter sender name">
    						</div>
    					</div>
    					<div class="col-12">
    						<div class="form-group mb-0">
    							<label class="dark_600 fsize11 fw500 ls4"><img src="assets/images/minus_red.svg"/> &nbsp; EXCLUDE</label>
    							
    							<select class="form-control h48 form-control-custom">
    								<option>Select sender email address</option>
    								<option>iver.mdx@brandboost.com</option>
    								<option>iver.mdx@brandboost.com</option>
    								<option>iver.mdx@brandboost.com</option>
    								<option>iver.mdx@brandboost.com</option>
    							</select>
    							
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		
    		<div class="card p35 br6 mb10">
    			<div class="row">
    				<div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span></div>
    				<div class="col-9">
    					<h3 class="htxt_medium_16 dark_700 mb-2">Default From</h3>
    					<ul class="review_camapaign_list">
    						<li><span>From name</span><strong>Max Iver</strong></li>
    						<li><span>From email address</span><strong>iver.mdx@brandboost.com</strong></li>
    					</ul>
    				</div>
    				<div class="col text-right">
    					<button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
    				</div>
    			</div>
    		</div>
            
            
            <div class="card p35 br6 mb10">
    			<div class="row">
    				<div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span></div>
    				<div class="col-9">
    					<h3 class="htxt_medium_16 dark_700 mb-2">Default Subject</h3>
    					<ul class="review_camapaign_list">
    						<li><span>Subject line</span><strong>Hello <strong class="reviews_400">[Fist name]</strong>, It was a pleasure doing business with you...</strong></li>
    						<li><span>Email preview text</span><strong>Thank you for giving us a try 🙏</strong></li>
    					</ul>
    				</div>
    				<div class="col text-right">
    					<button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
    				</div>
    			</div>
    		</div>
            
            
            <div class="card p35 br6 mb10">
    			<div class="row">
    				<div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span></div>
    				<div class="col-9">
    					<h3 class="htxt_medium_16 dark_700 mb-2">Default Content</h3>
    					<ul class="review_camapaign_list">
    						<li><span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span><strong><a href="#">Preview Template “Review Request Email”</a> <br>
    						<a href="#">Preview plain text version</a><br>
							<a href="#">Send test email</a>
    						</strong></li>
    					</ul>
    				</div>
    				<div class="col text-right">
    					<button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
    				</div>
    			</div>
    		</div>
            
            <div class="card p35 br6 mb10">
    			<div class="row">
    				<div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span></div>
    				<div class="col-9">
    					<h3 class="htxt_medium_16 dark_700 mb-2">Default Settings & Tracking</h3>
    					<p class="htxt_regular_14 dark_400 m-0 ls4">Customize your default campaign’s settings</p>
    				</div>
    				<div class="col text-right">
    					<button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
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
  Request - Add Tags - 1
 **********************-->
  <div class="modal fade" id="RequestAddTags">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
      <div class="modal-content review">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
      	<div class="row">
      		<div class="col-12">
                <img class="float-left mr-3 mt-1" src="assets/images/tags_blue_44.svg"/>
      			<h3 class="htxt_medium_24 dark_800 mb-2">Select Tags</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Choose tags do you want to the campaign</p>
      		</div>
      		
            
            <div class="col-12">         
            <div class="table_head_action bbot btop pb20 pt20 mb-0 mt20">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="table_filter">
                            <li><a class="active" href="#">All</a></li>
                            <li><a href="#">Active</a></li>
                            <li><a href="#">Draft</a></li>
                            <li><a href="#">Archive</a></li>
                            <!--<li><a href="#"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>-->
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="table_filter text-right">
                            <li><a href="#"><i><img src="assets/images/filter-line.svg"></i></a></li>
                            <li><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                            <li><a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                            <li><a href="#"><i><img src="assets/images/list.svg"></i></a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
      	</div>
        
        
        
        <div class="row">
    	<div class="col-md-12">
    		<div class="">
    			<table class="table table-borderless mb-0">
				<tbody>
			     <tr class="headings">
		           <td width="20">
				  	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
				    </td>
					<td><span class="fsize10 fw500">LIST </span></td>
					<td><span class="fsize10 fw500">CONTACTS</span></td>
					<td><span class="fsize10 fw500">UPDATED <img src="assets/images/arrow-down-line-14.svg"> </span></td>
					<td class="text-right"><span class="mr-1"><img src="assets/images/settings-2-line.svg"></span></td>
				  </tr>
				  
				  
				  
				  <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_light_800"><img src="assets/images/price-tag-12-white.svg"></span></span> meet</td>
					<td>1,492</td>
					<td>13 min ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
				  </tr>
                  
                  <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" checked>
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/price-tag-12-white.svg"></span></span> store </td>
					<td>1,492</td>
					<td>8 hr ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
				  </tr>
                  
                   <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/price-tag-12-white.svg"></span></span>material </td>
					<td>1,492</td>
					<td>3 days ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
				  </tr>
                  
                  <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" checked>
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/price-tag-12-white.svg"></span></span> strange </td>
					<td>1,492</td>
					<td>1 week ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
				  </tr>
                  
                   <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_light_800"><img src="assets/images/price-tag-12-white.svg"></span></span> region </td>
					<td>1,492</td>
					<td>3 days ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
				  </tr>
                  
                  <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" checked>
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/price-tag-12-white.svg"></span></span> art </td>
					<td>1,492</td>
					<td>1 month ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
				  </tr>
				  
                   <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_light_800"><img src="assets/images/price-tag-12-white.svg"></span></span> probable </td>
					<td>1,492</td>
					<td>2 month ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
				  </tr>
                  
                  <tr>
				   <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" checked>
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/price-tag-12-white.svg"></span></span> bright </td>
					<td>1,492</td>
					<td>3 days ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
				  </tr>
				
				  
				 
				  
				  
				  
				  
				  
				</tbody>
			    </table>
			    
			    <div class="custom_pagination">
			    	<div class="row">
			    		<div class="col-md-6">
			    			<span class="mr-4">ITEMS PER PAGE:<select><option>5</option><option>10</option><option>15</option><option>20</option></select></span>
			    			<span>1-10 out of 137</span>
			    		</div>
			    		<div class="col-md-6">
			    			<ul class="page_list float-right">
			    				<li><a href="#"><img src="assets/images/arrow-right-s-line.svg"></a></li>
			    				<li><a class="active" href="#">1</a></li>
			    				<li><a href="#">2</a></li>
			    				<li><a href="#">3</a></li>
			    				<li><a href="#">...</a></li>
			    				<li><a href="#">9</a></li>
			    				<li><a href="#"><img src="assets/images/arrow-left-s-line.svg"></a></li>
			    			</ul>
			    		</div>
			    	</div>
			    </div>
			    
    		</div>
    	</div>
    	
    	
    </div>
	
    
    
    		<div class="row">
    			<div class="col-12">
      				<hr class="mt-2">
      			</div>
            <div class="col-12">
                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize13 fw500">Add Tags</button>
                <button class="btn btn-lg bkg_light_000 dark_200 pr20 min_w_160 fsize13 fw500 ml20 shadow-none border">Back</button>
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
        $("#RequestAddTags").modal('show');
    });
</script>

</body>
</html>