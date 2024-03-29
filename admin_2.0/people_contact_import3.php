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
   	<div class="col-md-6 col-6">
   	<span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">People Contact Import</h3>
   	</div>
   	<div class="col-md-6 col-6 text-right d-none">
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
    
    <div class="table_head_action bbot pb30">
    <div class="row">
    	<div class="col-md-12">
    		<ul class="import_list">
    			<li><a class="done" href="#">Select import type</a></li>
    			<li><a class="done" href="#">Upload contacts</a></li>
    			<li><a class="active" href="#">Match fields</a></li>
    			<li><a href="#">Confirm Import</a></li>
    		</ul>
    	</div>
    </div>
    </div>
    
    
    <div class="row">
    		<div class="col-md-12 text-center">
     			<h3 class="htxt_bold_20 dark_700 mt30 mb10">Match the file columns with your list fields</h3>
     			<p class="fsize14 dark_200 fw300 mb50">For each column of your data, select field that it corresponds to or create new field.</p>
     		</div>
     		
     		<div class="col-md-12">
     			<div class="table-responsive">
    			<table class="table table-borderless">
				<tbody>
			  
			     <tr>
					<td><span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span></td>
					<td><span class="fsize12 fw300">Column label from file</span></td>
					<td><span class="fsize12 fw300">Preview data</span></td>
					<td><span class="fsize12 fw300">List fields</span></td>
					<td><span class="fsize12 fw300">&nbsp;</span></td>
				  </tr>
				  
				  <tr>
				    <td>
				    	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox" checked>
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
				    </td>
					<td><span class="htxt_medium_14 dark_900">Email</span></td>
					<td><span class="htxt_medium_14 dark_900">dan.romero@example.com</span></td>
					<td><span class="htxt_medium_14 dark_900"><i><img src="assets/images/mail-open-line-16.svg"/> </i> &nbsp; Email</span></td>
					<td class="text-right"><span class=""><img src="assets/images/chevronbottom.svg" /> </span></td>
				  </tr>
				  
				  <tr>
				    <td>
				    	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox" checked>
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
				    </td>
					<td><span class="htxt_medium_14 dark_900">First name</span></td>
					<td><span class="htxt_medium_14 dark_900">Philip </span></td>
					<td><span class="htxt_medium_14 dark_900"><i><img src="assets/images/user-line.svg"/> </i> &nbsp; First name</span></td>
					<td class="text-right"><span class=""><img src="assets/images/chevronbottom.svg" /> </span></td>
				  </tr>
				  
				  <tr>
				    <td>
				    	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
				    </td>
					<td><span class="htxt_medium_14 dark_900">Last name</span></td>
					<td><span class="htxt_medium_14 dark_900">Mckinney</span></td>
					<td><span class="htxt_medium_14 dark_400 fw300"><i><img src="assets/images/question-line.svg"/> </i> &nbsp; Select field</span></td>
					<td class="text-right"><span class=""><img src="assets/images/chevronbottom.svg" /> </span></td>
				  </tr>
				  
				  <tr>
				    <td>
				    	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox" checked>
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
				    </td>
					<td><span class="htxt_medium_14 dark_900">Phone number</span></td>
					<td><span class="htxt_medium_14 dark_900">(203) 555-0106</span></td>
					<td><span class="htxt_medium_14 dark_900"><i><img src="assets/images/phone-line.svg"/> </i> &nbsp; Phone number</span></td>
					<td class="text-right"><span class=""><img src="assets/images/chevronbottom.svg" /> </span></td>
				  </tr>
				  
				  <tr>
				    <td>
				    	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
				    </td>
					<td><span class="htxt_medium_14 dark_900">Subscriber ID</span></td>
					<td><span class="htxt_medium_14 dark_900">3856</span></td>
					<td><span class="htxt_medium_14 dark_400 fw300"><i><img src="assets/images/question-line.svg"/> </i> &nbsp; Select field</span></td>
					<td class="text-right"><span class=""><img src="assets/images/chevronbottom.svg" /> </span></td>
				  </tr>
				  
				  
				  
				  
				</tbody>
			  </table>
    		</div>
     		</div>
    </div>
    
    
  
    
    
    <div class="row mt40">
    	<div class="col-md-12"><hr class="mb25"></div>
    	<div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button></div>
    	<div class="col-6"><button class="btn btn-sm bkg_blue_200 light_000 float-right">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
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