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
   	<div class="col-md-6 col-6">
   	<span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">People Contact Profile</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
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
    	<div class="col-md-12">
    		<div class="card p30 pl40 pr50 user_profile">
    		<div class="row">
    		<div class="col-md-1">
    			<div class="profile_icon">
    				<img src="assets/images/profile-icon-36.svg" />
    			</div>
    			</div>
    			<div class="col-md-5">
    			<div class="profile_details">
    			<h3 class="htxt_medium_20 dark_700 mb-2 mt15">Diane Flores</h3>
    			<p class="fsize12 dark_200 text-uppercase mb0">#139 . johnny.m.widers@gmail.com</p>
    			</div>
    			</div>
    			
    			<div class="col-md-4 text-center">
    			<img style="max-width: 250px;" class="mt15" src="assets/images/profile_graph.svg"/>
    			</div>
    			<div class="col-md-2 text-center">
    			<img style="max-width: 86px;" src="assets/images/lead_source.png"/ >
    			</div>
    			
    			
    			</div>
    		</div>
    	</div>
    </div>
    
    
    <div class="row">
    	<div class="col-md-8">
    		<div class="card p20 pl30 pr30 min_h_240">
    			
    			<ul class="nav nav-pills profile_tab mt-0 mb20 bbot pb20" role="tablist">
				<li class="mr30">
				  <a class="htxt_bold_14 active" data-toggle="pill" href="#AddNote"><img src="assets/images/file-3-line.svg" /> &nbsp; Add Note</a>
				</li>
				<li class="mr30">
				  <a class="htxt_bold_14" data-toggle="pill" href="#Chat"><img src="assets/images/message-2-line.svg" /> &nbsp; Chat</a>
				</li>
				<li class="mr30">
				  <a class="htxt_bold_14" data-toggle="pill" href="#Email"><img src="assets/images/mail-open-line.svg" /> &nbsp; Email</a>
				</li>
				<li class="mr30">
				  <a class="htxt_bold_14" data-toggle="pill" href="#TextMessage"><img src="assets/images/message-3-line-16.svg" /> &nbsp; Text Message</a>
				</li>
				<li class="">
				  <a class="htxt_bold_14" data-toggle="pill" href="#Review"><img src="assets/images/star-line.svg" /> &nbsp; Review</a>
				</li>
			  </ul>
   			
   			<div class="tab-content">
			   <!--======Tab 1====-->
				<div id="AddNote" class="tab-pane active">
					<div class="p-0 mb20">
						<textarea class="border-0 w-100 fsize15 dark_200" style="resize: none" placeholder="Leave your note here..." ></textarea>
					</div>
					<div class="p-0 text-right">
						<button class="border-0 bkg_none p-0" type="submit" ><img src="assets/images/blue_48_send_circle.svg"/></button>
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
    	</div>
    	<div class="col-md-4">
    		<div class="card p20 min_h_240 profile_form">
    		<h3 class="htxt_medium_16 dark_800">Sales pipeline</h3>
    		<hr/>
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
    
    <div class="row">
    	<div class="col-md-8">
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
    		<div class="card p20 min_h_240 ">
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
 <?php include("people_contact_create_smart_popup.php"); ?>
 
    
 
 
 
 
 
 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jQuery.tagify.js"></script>
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
$('[name=tags]').tagify();
</script>

</body>
</html>