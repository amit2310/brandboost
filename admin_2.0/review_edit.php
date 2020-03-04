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
	
.ratings .icon-star-full2{font-size: 12px; margin-right: 1px; color: #9faecb;} 
.ratings p{margin: 0; color: #8b9ab9;}
.ratings .inner{margin-bottom:13px;}
.ratings .progress{height: 6px!important; margin-top: 8px;}
.progress-bar-info {	background-color: #B4C0D4;	border-radius: 1.5px;}
	
	
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
   	<h3 class="htxt_medium_24 dark_700">Review Page</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="mr15 btn btn-md bkg_light_000 reviews_400">Filters &nbsp; &nbsp; <img src="assets/images/filter_review.svg"></button>
   		<button class="btn btn-md bkg_reviews_300 light_000 slidebox"> Edit review &nbsp; &nbsp; <span><img src="assets/images/review_add.svg"></span></button>
   		
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
    		<div class="card p0">
						<div class="p30 bbot pt20 pb20">
							<div class="bbot mb30">
								<div class="row">
									<div class="col-md-8">
								<p class="fsize16 fw500 dark_700 float-left mr-3"><img width="32" src="assets/images/avatar/14.png"> &nbsp; Gladys Russell</p>
								<p class="mt-1 review_rating_start"><i class=""><img src="assets/images/star-fill_yellow_18.svg"></i><i class=""><img src="assets/images/star-fill_yellow_18.svg"></i><i class=""><img src="assets/images/star-fill_yellow_18.svg"></i><i class=""><img src="assets/images/star-fill_yellow_18.svg"></i><i class=""><img src="assets/images/star-fill_grey_18.svg"></i></p>
									</div>
									<div class="col-md-4">
									
									
									
									
									
									<div class="float-right mt-1 ml-2">
										<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
										  <span><img src="assets/images/more-vertical.svg"></span>
										</button>
										<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(1585px, 43px, 0px);">
										  <a class="dropdown-item" href="#">Link 1</a>
										  <a class="dropdown-item" href="#">Link 2</a>
										  <a class="dropdown-item" href="#">Link 3</a>
										</div>
									  </div>
						  			<p class="float-right fsize14 dark_200 mt-1 mb-0 ml-5">Dec 9, 2019</p>
						  			<button class="btn btn-sm-24 bkg_blue_000 pr10 pl10 blue_300 fsize12 fw500 mt-1 float-right">Published</button>
									</div>
								</div>
							
								
								
								
							</div>
							<p class="fsize14 fw500 dark_800 lh_22 mb-2">Forex Trading by incorporating a list of the top brokers in the world!</p>
							<p class="fsize14 fw400 dark_600 lh_22">
								The Top Forex Brokers Review is a great website that provided me with insightful information about Forex Trading by incorporating a list of the top brokers in the world, it gave me an idea of where i should make trades. The use of Forex Education is fantastic as it helped me gain a better understanding of various aspects related to the Forex Trading, which allowed me to make my decision of which broker to trade with. I highly recommend using this website.
							</p>
						</div>
						
						
					</div>
    	</div>
    </div>
    
    
    
    
     <div class="row">
    	<div class="col-md-8">
    		<div class="card p20 pl30 pr30 min_h_240">
    			
    			<ul class="nav nav-pills review_sec_tab mt-0 mb20 bbot pb20" role="tablist">
				<li class="mr30">
				  <a class="htxt_bold_14 active" data-toggle="pill" href="#AddNote"><img src="assets/images/reply-fill.svg" /> &nbsp; Add a reply</a>
				</li>
				<li class="mr30">
				  <a class="htxt_bold_14" data-toggle="pill" href="#Chat"><img src="assets/images/edit-box-line.svg" /> &nbsp; New note</a>
				</li>
				<li class="mr30">
				  <a class="htxt_bold_14" data-toggle="pill" href="#Email"><img src="assets/images/mail-open-line.svg" /> &nbsp; Email</a>
				</li>
				<li class="mr30">
				  <a class="htxt_bold_14" data-toggle="pill" href="#TextMessage"><img src="assets/images/message-3-line-16.svg" /> &nbsp; SMS</a>
				</li>
				<li class="">
				  <a class="htxt_bold_14" data-toggle="pill" href="#Review"><img src="assets/images/add-line.svg" /> &nbsp; Log activity</a>
				</li>
			  </ul>
   			
   			<div class="tab-content">
			   <!--======Tab 1====-->
				<div id="AddNote" class="tab-pane active">
					<div class="p-0 mb20">
						<textarea class="border-0 w-100 fsize15 dark_200" style="resize: none" placeholder="Leave your note here..." ></textarea>
					</div>
					<div class="p-0 text-right">
						<button class="border-0 bkg_none p-0" type="submit" ><img src="assets/images/review_48_send_circle.svg"/></button>
 					</div>
				</div>
				<!--======Tab 2=====-->
				<div id="Chat" class="tab-pane fade">
					Chat
				</div>
				<!--======Tab 3=====-->
				<div id="Email" class="tab-pane fade">
					Email
				</div>
				<!--======Tab 4=====-->
				<div id="TextMessage" class="tab-pane fade">
					Text Message
				</div>
				<!--======Tab 5=====-->
				<div id="Review" class="tab-pane fade">
					Review
				</div>
			  </div>
   			
   			
   			
    			
    		</div>
    		
		<div class="table_head_action mt-1 mb25">
    <div class="row">
    	<div class="col-md-6">
    		<h3 class="htxt_bold_20 dark_700">Activity</h3>
    	</div>
    	<div class="col-md-6">
    	<div class="table_action">
			<div class="float-right">
			<button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
			  Last week
			</button>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="#">Link 1</a>
			  <a class="dropdown-item" href="#">Link 2</a>
			  <a class="dropdown-item" href="#">Link 3</a>
			</div>
		  </div>
			<div class="float-right ml10 mr10">
			<button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
			  All types 
			</button>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="#">Link 1</a>
			  <a class="dropdown-item" href="#">Link 2</a>
			  <a class="dropdown-item" href="#">Link 3</a>
			</div>
		  </div>
		  
    	</div>
    	</div>
    </div>
    </div>
    
    
    
    <div class="row">
			<div class="col-md-12">
				
				<div class="activity_date_small">
					<div class="row">
						<div class="col-md-12">
							<div class="icons bkg_light_800 mb-0"><i><img src="assets/images/message-3-line.svg"></i></div>
							<p class="htxt_bold_16 dark_800 mb-2">Max added “USA” tag</p>
							<p class="htxt_regular_14 dark_400 mb0">Max added “USA” tag to Gladys’ review.</p>
							
						</div>
						<div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
					</div>
				</div>
				
				
				<div class="activity_date_small">
					<div class="row">
						<div class="col-md-12">
							<div class="icons bkg_blue_200"><i><img src="assets/images/message-3-line.svg"></i></div>
							<p class="htxt_bold_16 dark_800 mb-2">Received SMS</p>
							<p class="htxt_regular_14 dark_400 mb0">Hey Alex, do you have few minutes for a quick call at 11:30 AM?</p>
							<button class="activity_button"><i><img src="assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
						</div>
						<div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
					</div>
				</div>
				
				
				
				
				<div class="activity_date_small">
					<div class="row">
						<div class="col-md-12">
							<div class="icons bkg_yellow_400"><i><img src="assets/images/message-3-line.svg"></i></div>
							<p class="htxt_bold_16 dark_800 mb-2">Received SMS</p>
							<p class="htxt_regular_14 dark_400 mb0">Hey Alex, do you have few minutes for a quick call at 11:30 AM?</p>
							<button class="activity_button"><i><img src="assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
						</div>
						<div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
					</div>
				</div>
				
				
				<div class="activity_date_small">
					<div class="row">
						<div class="col-md-12">
							<div class="icons bkg_green_400"><i><img src="assets/images/message-3-line.svg"></i></div>
							<p class="htxt_bold_16 dark_800 mb-2">Received SMS</p>
							<p class="htxt_regular_14 dark_400 mb0">Hey Alex, do you have few minutes for a quick call at 11:30 AM?</p>
							<button class="activity_button"><i><img src="assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
						</div>
						<div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
					</div>
				</div>
				
				
			</div>
		</div>
   	
   	
   	
    	</div>
    	<div class="col-md-4">
    	
    	<div class="card p25 animate_top">
    		<img class="float-left mb-3" width="70" src="assets/images/plane_work.svg"/>
    		<p class="fsize16 fw500 dark_800 mb-1">Email Marketing Cource</p>
    		<p class="fsize14 fw400 dark_500 mb-3 bbot pb-3">137 reviews</p>
    		
    		
    		
    					<div class="pb-3 pl-3 ratings bbot">
								<div class="row inner">
									<div class="col-1 pr-0 pl-0">
									<p>5 <i><img src="assets/images/star-fill-12.png"/> </i></p>
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
									<p>4 <i><img src="assets/images/star-fill-12.png"/> </i></p>
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
									<p>3 <i><img src="assets/images/star-fill-12.png"/> </i></p>
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
									<p>2 <i><img src="assets/images/star-fill-12.png"/> </i></p>
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
									<p>1 <i><img src="assets/images/star-fill-12.png"/> </i></p>
									</div>
									<div class="col-10">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20" style="width:20%"></div>
									</div>
									</div>
									<div class="col-1 pr-0 pl-0"><p>125</p></div>
								</div>
								
								
								
								
								
								
								
							
								
								
								</div>
								
								
								
				<p class="fsize14 dark_600 mt-3 mb-0"><i><img src="assets/images/chat-1-fill.svg"/></i> &nbsp; 13 questions / 10 answers </p>
    		
    		
    		
    	</div>
    	
    	<div class="card p0 animate_top col text-center d-none">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
					</ul>
				</div>
				<div class="p30">
				<ul class="templates_list">
      		<li><a class="active" href="#"><strong><img src="assets/images/menu-2-line.svg"> All</strong> <span>345</span></a></li>
      		<li><a href="#"><strong><img src="assets/images/heart-line.svg"> My Templates</strong> <span>128</span></a></li>
      		
      		<li><a href="#"><strong><img src="assets/images/folder-3-line.svg"> Non-profit</strong> <span>13</span></a></li>
      		<li><a href="#"><strong><img src="assets/images/folder-3-line.svg"> Photography</strong> <span>86</span></a></li>
      		<li><a href="#"><strong><img src="assets/images/folder-3-line.svg"> Product / Service</strong> <span>31</span></a></li>
      	</ul>
				</div>
    		</div>
    		
    		
    		
    		<div class="card p20 min_h_240 d-none ">
    		<h3 class="htxt_medium_16 dark_800">Info</h3>
    		<hr/>
    		<ul class="info_list">
    			<li><span>Source</span><strong>Email</strong></li>
    			<li><span>First Seen</span><strong>17 Jan 2018</strong></li>
    			<li><span>Lase Seen</span><strong>22 Apr 2018</strong></li>
    			<li><span>Page views</span><strong>139</strong></li>
    			<li><span>Reviews</span><strong>3</strong></li>
    			<li><span>Notification</span><strong>On</strong></li>
    			<li><span>Id</span><strong>310282</strong></li>
    			<li><span>SMS</span><strong>On</strong></li>
    		</ul>
    		</div>
    		
    		
    		<div class="card p20 min_h_240 profile_form">
    		<h3 class="htxt_medium_16 dark_800">Media</h3>
    		<hr>
    			<div class="form-group">
                <label class="fsize12 fw400 dark_100" for="Leadsource">Lead source</label>
                <select class="form-control h36">
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                </select>
              </div>
              
              <div class="form-group mb-0">
                <label class="fsize12 fw400 dark_100" for="Stage">Stage</label>
                <select class="form-control h36">
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                	<option>Email Campaign</option>
                </select>
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
 <?php include("email_campaign_create_smart_popup.php"); ?>
 
 
 
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
</script>



</body>
</html>