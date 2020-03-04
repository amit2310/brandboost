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
   	<h3 class="htxt_medium_24 dark_700">Contacts</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox">ADD New Contact<span><img src="assets/images/blue-plus.svg"/></span></button>
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
    		<div class="table-responsive btop2_yellow mb-4">
    			<table class="table table-borderless mb-0">
				<tbody>
			     <tr class="headings">
					<td colspan="6"><span class="fsize10 fw500 dark_500"><img src="assets/images/fav-tab-icon.svg"/>&nbsp; FAVORITES</span></td>
					<td class="text-right"><span class="fsize10 fw500 dark_500">SORT &nbsp; <img src="assets/images/select_bkg.svg"/></span></td>
				  </tr>
				  
				  <tr class="headings active">
		           <td width="20">
				  	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
				    </td>
					<td><span class="fsize10 fw500">name </span></td>
					<td><span class="fsize10 fw500">Email</span></td>
					<td><span class="fsize10 fw500">Phone</span></td>
					<td><span class="fsize10 fw500">Tags  </span></td>
					<td><span class="fsize10 fw500">Update <img src="assets/images/arrow-down-line-14.svg"></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span></span> Courtney Black</td>
					<td>bill.sanders@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">2 days ago </span></td>
					<td><span class="float-right"><span class="status_icon bkg_yellow_400"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span></span> Savannah Webb</td>
					<td>max.terry@example.com</td>
					<td>-</td>
					<td> <button class="tags_btn blue">blue</button><button class="tags_btn review">review</button> <button class="tags_btn email">email</button> <button class="tags_btn">+2</button></td>
					<td><span class="green_400">online </span></td>
					<td><span class="float-right"><span class="status_icon bkg_yellow_400"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/06.png"></span></span> Kristin Fisher</td>
					<td>deanna.curtis@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">8 days ago </span></td>
					<td><span class="float-right"><span class="status_icon bkg_yellow_400"></span></span></td>
				  </tr>
				  
				 
				  
				  
				  
				 
				  
				  
				  
				  
				  
				</tbody>
			    </table>
			    
			   
			    
    		</div>
    		
    		<div class="table-responsive btop2_blue mb-4">
    			<table class="table table-borderless mb-0">
				<tbody>
			     
			     <tr class="headings">
					<td colspan="6"><span class="fsize10 fw500 dark_500"><img src="assets/images/leads-tab-icon.svg"/>&nbsp; LEADS</span></td>
					<td class="text-right"><span class="fsize10 fw500 dark_500">SORT &nbsp; <img src="assets/images/select_bkg.svg"/></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span></span> Courtney Black</td>
					<td>bill.sanders@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">2 days ago </span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span></span> Savannah Webb</td>
					<td>max.terry@example.com</td>
					<td>-</td>
					<td> <button class="tags_btn blue">blue</button><button class="tags_btn review">review</button> <button class="tags_btn email">email</button> <button class="tags_btn">+2</button></td>
					<td><span class="green_400">online </span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/06.png"></span></span> Kristin Fisher</td>
					<td>deanna.curtis@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">8 days ago </span></td>
					<td><span class="float-right"><span class="status_icon bkg_blue_300"></span></span></td>
				  </tr>
				  
				 
				  
				  
				  
				 
				  
				  
				  
				  
				  
				</tbody>
			    </table>
			    
			   
			    
    		</div>
    		
    		<div class="table-responsive btop2_review mb-4">
    			<table class="table table-borderless mb-0">
				<tbody>
			     <tr class="headings">
					<td colspan="6"><span class="fsize10 fw500 dark_500"><img src="assets/images/review_table_icon.svg"/>&nbsp; CUSTOMER</span></td>
					<td class="text-right"><span class="fsize10 fw500 dark_500">SORT &nbsp; <img src="assets/images/select_bkg.svg"/></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span></span> Courtney Black</td>
					<td>bill.sanders@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">2 days ago </span></td>
					<td><span class="float-right"><span class="status_icon bkg_reviews_400"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span></span> Savannah Webb</td>
					<td>max.terry@example.com</td>
					<td>-</td>
					<td> <button class="tags_btn blue">blue</button><button class="tags_btn review">review</button> <button class="tags_btn email">email</button> <button class="tags_btn">+2</button></td>
					<td><span class="green_400">online </span></td>
					<td><span class="float-right"><span class="status_icon bkg_reviews_400"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/06.png"></span></span> Kristin Fisher</td>
					<td>deanna.curtis@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">8 days ago </span></td>
					<td><span class="float-right"><span class="status_icon bkg_reviews_400"></span></span></td>
				  </tr>
				  
				  
				</tbody>
			    </table>
    		</div>
    		
    		<div class="table-responsive btop2_grey mb-4">
    			<table class="table table-borderless mb-0">
				<tbody>
			     <tr class="headings">
					<td colspan="6"><span class="fsize10 fw500 dark_500"><img src="assets/images/no-status-fill.svg"/>&nbsp; NO STATUS</span></td>
					<td class="text-right"><span class="fsize10 fw500 dark_500">SORT &nbsp; <img src="assets/images/select_bkg.svg"/></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span></span> Courtney Black</td>
					<td>bill.sanders@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">2 days ago </span></td>
					<td><span class="float-right"><span class="status_icon bkg_dark_100"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span></span> Savannah Webb</td>
					<td>max.terry@example.com</td>
					<td>-</td>
					<td> <button class="tags_btn blue">blue</button><button class="tags_btn review">review</button> <button class="tags_btn email">email</button> <button class="tags_btn">+2</button></td>
					<td><span class="green_400">online </span></td>
					<td><span class="float-right"><span class="status_icon bkg_dark_100"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/06.png"></span></span> Kristin Fisher</td>
					<td>deanna.curtis@example.com</td>
					<td>(252) 555-0126</td>
					<td><button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">8 days ago </span></td>
					<td><span class="float-right"><span class="status_icon bkg_dark_100"></span></span></td>
				  </tr>
				  
				  
				</tbody>
			    </table>
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