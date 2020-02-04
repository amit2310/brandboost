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
   	<span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">People Subscribers List</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox">ADD New Contact <span><img src="assets/images/blue-plus.svg"/></span></button>
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
    			<li><a href="#">ACTIVE</a></li>
    			<li><a href="#">DRAFT</a></li>
    			<li><a href="#">ARCHIVE</a></li>
    			<li><a href="#"><i><img src="assets/images/filter-3-fill.svg"/></i> &nbsp; FILTER</a></li>
    		</ul>
    	</div>
    	<div class="col-md-6">
    		<ul class="table_filter text-right">
    			<li><a href="#"><i><img src="assets/images/search-2-line_grey.svg"/></i></a></li>
    			<li><a href="#"><i><img src="assets/images/sort_16_grey.svg"/></i></a></li>
    			<li><a href="#"><i><img src="assets/images/cards_16_grey.svg"/></i></a></li>
    		</ul>
    	</div>
    </div>
    </div>
    
   <!-- <div class="table_head_action">
    <div class="row">
    	<div class="col-md-6">
    		<h3 class="htxt_medium_16 dark_400">Contact Lists</h3>
    	</div>
    	<div class="col-md-6">
    	<div class="table_action">
			<div class="float-right">
			<button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
			  <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
			</button>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="#">Link 1</a>
			  <a class="dropdown-item" href="#">Link 2</a>
			  <a class="dropdown-item" href="#">Link 3</a>
			</div>
		  </div>
			<div class="float-right ml10 mr10">
			<button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
			  <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
			</button>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="#">Link 1</a>
			  <a class="dropdown-item" href="#">Link 2</a>
			  <a class="dropdown-item" href="#">Link 3</a>
			</div>
		  </div>
		  <div class="float-right">
			<input class="table_search" type="text" placeholder="Serch" />
		  </div>
    	</div>
    	</div>
    </div>
    </div>-->
    
    
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
					<td><span class="fsize10 fw500">LIST </span></td>
					<td><span class="fsize10 fw500">CONTACTS</span></td>
					<td><span class="fsize10 fw500">SOURCE</span></td>
					<td><span class="fsize10 fw500">UPDATE <img src="assets/images/arrow-down-line-14.svg"/> </span></td>
					<td><span class="fsize10 fw500">STATUS</span></td>
					<td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"/></span></td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> Pizza Hut</td>
					<td>1,492</td>
					<td><span class="mr-3"><img src="assets/images/people_active.svg"/></span>People CRM</td>
					<td>Nov 11, 2014</td>
					<td><span class="mr-3"><img src="assets/images/active_green_icon_12.svg"/></span>Active</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> Bank of America</td>
					<td>412</td>
					<td><span class="mr-3"><img src="assets/images/people_active.svg"/></span>People CRM</td>
					<td>Mar 7, 2019</td>
					<td><span class="mr-3"><img src="assets/images/active_green_icon_12.svg"/></span>Active</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> Johnson & Johnson</td>
					<td>302</td>
					<td><span class="mr-3"><img src="assets/images/reviews_icon_12.svg"/></span>Reviews</td>
					<td>May 11, 2017</td>
					<td><span class="mr-3"><img src="assets/images/active_green_icon_12.svg"/></span>Active</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> Gillette</td>
					<td>412</td>
					<td><span class="mr-3"><img src="assets/images/people_active.svg"/></span>People CRM</td>
					<td>Feb 25, 2017</td>
					<td><span class="mr-3"><img src="assets/images/disable_grey_12.svg"/></span>Disable</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> Pizza Hut</td>
					<td>1,492</td>
					<td><span class="mr-3"><img src="assets/images/people_active.svg"/></span>People CRM</td>
					<td>Aug 9, 2019</td>
					<td><span class="mr-3"><img src="assets/images/active_green_icon_12.svg"/></span>Active</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> eBay</td>
					<td>35</td>
					<td><span class="mr-3"><img src="assets/images/email_icon_12.svg"/></span>Email Marketing</td>
					<td>Feb 19, 2019</td>
					<td><span class="mr-3"><img src="assets/images/active_green_icon_12.svg"/></span>Active</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> Johnson & Johnson</td>
					<td>54</td>
					<td><span class="mr-3"><img src="assets/images/reviews_icon_12.svg"/></span>Reviews</td>
					<td>Dec 9, 2016</td>
					<td><span class="mr-3"><img src="assets/images/active_green_icon_12.svg"/></span>Active</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
					<td><span class="table-img mr15"><img src="assets/images/folder_blue_24.svg"/></span> McDonald's</td>
					<td>752</td>
					<td><span class="mr-3"><img src="assets/images/email_icon_12.svg"/></span>Email Marketing</td>
					<td>Nov 11, 2014</td>
					<td><span class="mr-3"><img src="assets/images/disable_grey_12.svg"/></span>Disable</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-2-fill.svg"/></span>
							</button>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
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
			    				<li><a href="#"><img src="assets/images/arrow-right-s-line.svg"/></a></li>
			    				<li><a class="active" href="#">1</a></li>
			    				<li><a href="#">2</a></li>
			    				<li><a href="#">3</a></li>
			    				<li><a href="#">...</a></li>
			    				<li><a href="#">9</a></li>
			    				<li><a href="#"><img src="assets/images/arrow-left-s-line.svg"/></a></li>
			    			</ul>
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
 <?php include("people_contact_create_smart_popup.php"); ?>
 
    
 
 
 
 
 
 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker-plus.js"></script> 
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
var color_picker = $('.colorpickerplus-dropdown .colorpickerplus-container');
        color_picker.colorpickerembed();
        color_picker.on('changeColor', function(e,color){
			var el = $('.color-fill-icon', $('#color_picker'));
			if(color==null) {
			  //when select transparent color
			  el.addClass('colorpicker-color');
			} else {
			  el.removeClass('colorpicker-color');
        	  el.css('background-color', color);
			}
        });
</script>

</body>
</html>