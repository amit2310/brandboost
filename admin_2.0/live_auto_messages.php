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

</head>



<body id="LiveChatSection">
<!--<body id="PeopleSection" class="enlarge-menu">-->

<div class="page-wrapper ">
 <!--******************
 SIDEBAR NAVIGATION
 **********************-->
  <?php include("sidebar.php"); ?>
 

  <div class="page-content">
  
  

  
  
  <div class="h-100">
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
   	<h3 class="htxt_medium_24 dark_700">Auto Messages </h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img style="width: 14px!important" src="assets/images/settings-3-fill.svg"/></button>
   		<button class="btn btn-md bkg_blue_300 light_000" data-toggle="modal" data-target="#CREATEFORM">CREATE NEW MESSAGE<span><img src="assets/images/blue-plus.svg"/></span></button>
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
   
    
    
	<div class="table_head_action">
		<div class="row">
			<div class="col-md-6">
				<ul class="table_filter">
					<li><a class="active" href="#">ALL</a></li>
					<li><a href="#">LIVE</a></li>
					<li><a href="#">DRAFTS</a></li>
					<li><a href="#">PAUSED</a></li>
					<li><a href="#">SCHEDULED</a></li>
					<li><a href="#"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>
				</ul>
			</div>
			<div class="col-md-6">
				<ul class="table_filter text-right">
					<li><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
					<li><a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
					<li><a href="#"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
   
   
   
   
   <div class="row">
    	<div class="col-md-12">
    		<div class="table-responsive">
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
					<td><span class="fsize10 fw500">NAME </span></td>
					<td><span class="fsize10 fw500">SENDER</span></td>
					<td><span class="fsize10 fw500">ACTION</span></td>
					<td><span class="fsize10 fw500">TRIGER</span></td>
					<td><span class="fsize10 fw500">AUDIENCE</span></td>
					<td><span class="fsize10 fw500">viewed <img src="assets/images/arrow-down-line-14.svg"> </span></td>
					<td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>
				  </tr>
				  
				  
				  
				  <tr>
				   <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img width="12" src="assets/images/chat-2-fill-white.svg"></span></span> Welcome message</td>
					<td><span class="table-img mr10"><img class="" width="20" src="assets/images/avatar/02.png"></span> Courtney</td>
					<td>Go to a URL</td>
					<td>On the first visit</td>
					<td>All</td>
					<td>2 min ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
				  </tr>
				  
				  <tr>
				   <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_light_800"><img width="12" src="assets/images/chat-2-fill-white.svg"></span></span> Website feature announcement</td>
					<td><span class="table-img mr10"><img class="" width="20" src="assets/images/avatar/03.png"></span> Calvin</td>
					<td>Go to a URL</td>
					<td>Custom</td>
					<td>Segment</td>
					<td>17 min ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
				  </tr>
				  
				  <tr>
				   <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img width="12" src="assets/images/chat-2-fill-white.svg"></span></span> New Review Request</td>
					<td><span class="table-img mr10"><img class="" width="20" src="assets/images/avatar/04.png"></span> Courtney</td>
					<td>Review</td>
					<td>On the first visit</td>
					<td>Tag</td>
					<td>1 hr ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
				  </tr>
				  
				  <tr>
				   <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img width="12" src="assets/images/chat-2-fill-white.svg"></span></span> Marketing Call to Action</td>
					<td><span class="table-img mr10"><img class="" width="20" src="assets/images/avatar/05.png"></span> Brandon</td>
					<td>Go to a URL</td>
					<td>Timer</td>
					<td>Segment</td>
					<td>12 hr ago</td>
					<td class="text-right"><span class="float-right"><span class="status_icon bkg_yellow_300"></span></span></td>
				  </tr>
				  
				  
				  <tr>
				   <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img width="12" src="assets/images/chat-2-fill-white.svg"></span></span> Book meeting</td>
					<td><span class="table-img mr10"><img class="" width="20" src="assets/images/avatar/06.png"></span> Theresa</td>
					<td>Booking</td>
					<td>On the first visit</td>
					<td>All</td>
					<td>3 month ago</td>
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
    	
    	<div class="col-md-12 text-center mt-3">
    		<a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
    	</div>
    </div>
    
    
   
    
    
     
     
      </div>
   </div>
      
<!--******************
  Content Area End
 **********************-->
 
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
	$(".nav-link.livechat").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.livechat").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>


</body>
</html>