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
   	<h3 class="htxt_medium_24 dark_700">Import Data </h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<!--<button class="circle-icon-40 mr15"><img src="assets/images/settings-3-line.svg"/></button>-->
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox" data-toggle="modal" data-target="#CREATEFORM">IMPORT<span><img width="14" src="assets/images/download-line-white.svg"/></span></button>
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
    			<li><a class="dark_600" href="#">CONTACTS</a></li>
    			<li><a href="#">LISTS</a></li>
    			<li><a href="#">SEGMENTS</a></li>
    			<li><a href="#">TAGS</a></li>
    			<li><a href="#">COMPANIES</a></li>
    			<!--<li><a href="#"><i><img src="assets/images/filter-3-fill.svg"/></i> &nbsp; FILTER</a></li>-->
    		</ul>
    	</div>
    	<!--<div class="col-md-6">
    		<ul class="table_filter text-right">
    			<li><a href="#"><i><img src="assets/images/search-2-line_grey.svg"/></i></a></li>
    			<li><a href="#"><i><img src="assets/images/sort_16_grey.svg"/></i></a></li>
    			<li><a href="#"><i><img src="assets/images/cards_16_grey.svg"/></i></a></li>
    		</ul>
    	</div>-->
    </div>
    </div>
    
    <div class="row">
    	<div class="col-md-4 d-flex">
    		<div class="card p40 animate_top col text-center">
    			<div class="max_w_250 m-auto">
    			<img class="mb-3" src="assets/images/download_blue_60.svg">	
				<h3 class="htxt_medium_16 dark_700 mb-3 lh_20">Download a sample <br>spreadsheet</h3>
   				<p class="htxt_regular_14 dark_200 lh_20">Download this small sample file and test the import process so there are no surprise.</p>	
   				<a class="htxt_medium_12 blue_300 ls_4" href="#">DOWNLOAD SPREADSHEET</a>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-4 d-flex">
    		<div class="card p40 animate_top col text-center">
    			<div class="max_w_250 m-auto">
    			<img class="mb-3" src="assets/images/book_blue_60.svg">	
				<h3 class="htxt_medium_16 dark_700 mb-3 lh_20">How to prepare your<br>data for import</h3>
   				<p class="htxt_regular_14 dark_200 lh_20">The guide below will walk you trough how to prepare your files for a successful import.</p>	
   				<a class="htxt_medium_12 blue_300 ls_4" href="#">VIEW IMPORT GUIDE</a>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-4 d-flex">
    		<div class="card p40 animate_top col text-center">
    			<div class="max_w_250 m-auto">
    			<img class="mb-3" src="assets/images/book_blue_60.svg">	
				<h3 class="htxt_medium_16 dark_700 mb-3 lh_20">Set up integration <br>for auto sync contacts</h3>
   				<p class="htxt_regular_14 dark_200 lh_20">Import contacts from an integrates service such as Google Contacts, Zoho, CRM and more.</p>	
   				<a class="htxt_medium_12 blue_300 ls_4" href="#">VIEW INTEGRATIONS</a>
    			</div>
    		</div>
    	</div>
    	
    	
    </div>
    
   
    
    
    <div class="table_head_action">
    <div class="row">
    	<div class="col-md-6">
    		<ul class="table_filter">
    			<li><a class="dark_600" href="#">IMPORT HISTORY</a></li>
    			
    		</ul>
    	</div>
    	<div class="col-md-6">
    		<ul class="table_filter text-right">
    			<li><a href="#"><i><img src="assets/images/sort_16_grey.svg"/></i></a></li>
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
					<td><span class="fsize10 fw500">IMPORT NAME </span></td>
					<td><span class="fsize10 fw500">CONTACTS</span></td>
					<td><span class="fsize10 fw500">USER</span></td>
					<td><span class="fsize10 fw500">SOURCE</span></td>
					<td><span class="fsize10 fw500">UPDATE <img src="assets/images/arrow-down-line-14.svg"/> </span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/file-use.svg"/></span></span> Pariatur deserunt exercitation nulla </td>
					<td>321</td>
					<td>Max</td>
					<td><span class="mr-3"><span class=""><img src="assets/images/file-3-line-grey.svg"/></span></span>export_contacts_23.csv</td>
					<td>Nov 11, 2014</td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/file-use.svg"/></span></span> Minim esse minim proident </td>
					<td>194</td>
					<td>Arlene</td>
					<td><span class="mr-3"><span class=""><img src="assets/images/file-3-line-grey.svg"/></span></span>non_aliqua.csv</td>
					<td>Dec 8, 2020</td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/file-use.svg"/></span></span> Minim amet ut laboris </td>
					<td>125</td>
					<td>Max</td>
					<td><span class="mr-3"><span class=""><img src="assets/images/file-3-line-grey.svg"/></span></span>culpa_laboris_laboris.csv</td>
					<td>Nov 11, 2014</td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/file-use.svg"/></span></span> In do elit import.</td>
					<td>952</td>
					<td>Brandie</td>
					<td><span class="mr-3"><span class=""><img src="assets/images/file-3-line-grey.svg"/></span></span>quis_nulla_autead.csv</td>
					<td>Dec 8, 2020</td>
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
    	
    	<div class="col-md-12 text-center mt-3">
    		<a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"/> &nbsp; LEARN MORE ABOUT PEOPLE</a>
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
  CREATEFORM  Popup
 **********************-->
 
 <!-- The Modal -->
  <div class="modal fade" id="CREATEFORM">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
      	<div class="row">
      		<div class="col-12">
      			<h3 class="htxt_medium_24 dark_800 mb-3">Contact Form</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Select a type of form you would like to create and give it a title.</p>
      			<hr/>
      		</div>
      		
      		<div class="col-12">
      			<div class="form-group">
                <label for="fname" class="fsize11 fw500 dark_600">FORM NAME</label>
                <input type="text" class="form-control h56 fsize12 dark_200 br4" id="fname" placeholder="Enter new form name" name="fname">
              </div>
      		</div>
      		
      		<div class="col-6">
      			<div class="form-group m-0">
                <label for="fname" class="fsize11 fw500 dark_600">FORM NAME</label>
                <div class="card border text-center shadow-none m-0 active2">
                	<img class="mb-3" src="assets/images/popup_form_icon.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Popup Form</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Design and customize a popup <br>form that can be triggered <br>on any page</p>
                </div>
              </div>
      		</div>
      		<div class="col-6">
      			<div class="form-group m-0">
                <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                <div class="card border text-center shadow-none m-0">
                	<img class="mb-3" src="assets/images/embed_form_icon.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Embedded Form</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Design and customize a form that<br> can be embeded on your site <br>and convert leads.</p>
                </div>
              </div>
      		</div>
      		
      		<div class="col-12">
      			<hr/>
      		</div>
      		
      		<div class="col-6">
            <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase">CONTINUE</button>
            <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="#">Close</a> 
            </div>
            
            <div class="col-6 text-right mt-2">
           	<a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">
     				<span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
     				LEARN HOW TO USE FORMS
     			</a>
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


</body>
</html>