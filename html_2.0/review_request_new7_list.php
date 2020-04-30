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
   	<h3 class="htxt_medium_24 dark_700">Review Requests</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="circle-icon-40 mr15"><img width="16" src="assets/images/setting_3line_grey.svg"></button>
   		<button class="btn btn-md bkg_reviews_400 light_000 slidebox">Send new request <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
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
    	<div class="col-md-9">
    		<ul class="table_filter">
    			<li><a class="active" href="#">All</a></li>
    			<li><a href="#">Sent</a></li>
    			<li><a href="#">Draft</a></li>
    			<li><a href="#">Submited</a></li>
    			<li><a href="#">Archive</a></li>
    			
    		</ul>
    	</div>
    	<div class="col-md-3">
    		<ul class="table_filter text-right">
    			<li><a class="search_tables_open_close" href="#"><i><img src="assets/images/filter_line_18.svg"></i></a></li>
    			<li><a href="#"><i><img width="16" src="assets/images/search_line_18.svg"></i></a></li>
    			<li><a href="#"><i><img src="assets/images/sort_line_18.svg"></i></a></li>
    			<li><a href="#"><i><img src="assets/images/cards_line_18.svg"></i></a></li>
    		</ul>
    	</div>
    </div>
    
    <div class="card p20 datasearcharea br6 shadow3">
    	<div class="form-group m-0 position-relative">
    		<input id="InputToFocus" type="search" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
    		<a class="search_tables_open_close searchcloseicon" href="#"><img src="assets/images/close-icon-13.svg"/></a>
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
					<td><span class="fsize10 fw500">name </span></td>
					<td><span class="fsize10 fw500">EMAIL / phone</span></td>
					<td><span class="fsize10 fw500">CAMPAIGN</span></td>
					<td><span class="fsize10 fw500">SENT <img src="assets/images/arrow-down-line-14.svg"></span></td>
					<td><span class="fsize10 fw500">REVIEW  </span></td>
					<td><span class="fsize10 fw500"><img src="assets/images/eyeline.svg"></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Floyd Howard</td>
					<td><img src="assets/images/atline.svg"/> &nbsp; scott.gilbert@example.com</td>
					<td>New Customers Campaign</td>
					<td><span class="">Jun 20, 2020</span></td>
					<td><img src="assets/images/star-line.svg"/> <span class="light_400">-</span></td>
					<td>&nbsp;</td>
					<td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">g</span></span> Gregory Henry</td>
					<td><img src="assets/images/chatline.svg"/> &nbsp; (201) 555-0124</td>
					<td>Smart SMS Campaign</td>
					<td><span class="">Jul 16, 2020</span></td>
					<td><img src="assets/images/star-line.svg"/> <span class="light_400">-</span></td>
					<td><img src="assets/images/checklineblack.svg"/></td>
					<td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/03.png"></span></span> Arlene Bell</td>
					<td><img src="assets/images/atline.svg"/> &nbsp; henry.frazier@example.com</td>
					<td>New Customers Campaign</td>
					<td><span class="">Apr 26, 2020</span></td>
					<td><img src="assets/images/star-line.svg"/> <span class="light_400">-</span></td>
					<td>&nbsp;</td>
					<td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">g</span></span> Gloria Fisher</td>
					<td><img src="assets/images/chatline.svg"/> &nbsp; (225) 555-0118</td>
					<td>Email Requests </td>
					<td><span class="">Nov 30, 2020</span></td>
					<td><img width="14" src="assets/images/star-fill_yellow_16.svg"/> &nbsp; <span class="dark_400">4.5</span></td>
					<td><img src="assets/images/check_double_green.svg"/></td>
					<td><span class="float-right"><span class="status_icon bkg_blue_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/05.png"></span></span> Evan Robertson</td>
					<td><img src="assets/images/atline.svg"/> &nbsp; benjamin.ray@example.com</td>
					<td>Default</td>
					<td><span class="">Nov 2, 2020</span></td>
					<td><img src="assets/images/star-line.svg"/> <span class="light_400">-</span></td>
					<td>&nbsp;</td>
					<td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/06.png"></span></span> Gloria Fisher</td>
					<td><img src="assets/images/atline.svg"/> &nbsp; tiffany.dean@example.com</td>
					<td>Customers Campaign </td>
					<td><span class="">Jul 27, 2020</span></td>
					<td><img width="14" src="assets/images/star-fill_yellow_16.svg"/> &nbsp; <span class="dark_400">4.5</span></td>
					<td><img src="assets/images/check_double_green.svg"/></td>
					<td><span class="float-right"><span class="status_icon bkg_blue_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/07.png"></span></span> Gloria Fisher</td>
					<td><img src="assets/images/chatline.svg"/> &nbsp; (307) 555-0133</td>
					<td>Customers Campaign </td>
					<td><span class="">Jul 27, 2020</span></td>
					<td><img width="14" src="assets/images/star-fill_yellow_16.svg"/> &nbsp; <span class="dark_400">4.5</span></td>
					<td><img src="assets/images/check_double_green.svg"/></td>
					<td><span class="float-right"><span class="status_icon bkg_blue_300"></span></span></td>
				  </tr>
				  
				  
				  
				  
				  
				 
				  
				  
				  
				  
				  
				</tbody>
			    </table>
			    
			    <div class="custom_pagination">
			    	<div class="row">
			    		<div class="col-md-6">
			    			<span class="mr-4">ITEMS PER PAGE:<select><option>10</option><option>10</option><option>15</option><option>20</option></select></span>
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
    		<a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT review requests</a>
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