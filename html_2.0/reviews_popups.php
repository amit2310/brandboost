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
   	<h3 class="htxt_medium_24 dark_700">Review Popups</h3>
   	</div>
   	<!--<div class="col-md-6 col-6 text-right">
   		<button class="btn btn-md bkg_light_800 light_000" data-toggle="modal" data-target="#RequestAddContacts1" >Send Request <span><img src="assets/images/arrow-right-circle-fill-white.svg"></span></button>
   	</div>-->
   </div>
   </div>
    <div class="clearfix"></div>
</div>
	 
	  
	  
	  
 <!--******************
  Content Area
 **********************-->
   <div class="content-area">
    <div class="container-fluid">
    
 	<div class="card p35 br6 mb10">
    <div class="row">
    <div class="col text-left">
    <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_blue_400  mr20 mb20" data-toggle="modal" data-target="#CopyContacts1">Copy Contacts 1</button>
    <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_blue_400  mr20 mb20" data-toggle="modal" data-target="#CopyContacts2">Copy Contacts 2</button>
    <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_blue_400  mr20 mb20" data-toggle="modal" data-target="#ImportContacts1">Import Contacts 1</button>
    <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_blue_400  mr20 mb20" data-toggle="modal" data-target="#ImportContacts2">Import Contacts 2</button>
    <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_blue_400  mr20 mb20" data-toggle="modal" data-target="#Matchthecolumns">Match the columns</button>
    
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
  Request - Import Contacts - 1
 **********************-->
  <div class="modal fade" id="ImportContacts1">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
      <div class="modal-content review">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
        <a class="cross_icon back" data-dismiss="modal"><i class=""><img src="assets/images/modal_back.svg"></i></a>
      	<div class="row">
      		<div class="col-12 mb-3">
      			<h3 class="htxt_medium_24 dark_800 mb-2">Import Contacts</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Choose how do you want to import contacts</p>
      			<hr/>
      		</div>
      		
            
            
            <div class="col-4 d-flex">
                <div class="card border text-center shadow-none p20 col m0">
                	<img class="mb-3" src="assets/images/file_blue_44.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Import contact <br>from a file</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Upload .csv or .txt files<br> from your computer</p>
                </div>
                </div>
                
                <div class="col-4 d-flex">
            	<div class="card border text-center shadow-none p20 col m0">
                	<img class="mb-3" src="assets/images/copy2_blue_44.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Copy & paste <br>contacts</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Just copy and past your<br> contact list from file to<br> BrandBoost</p>
                </div>
                </div>
                
                <div class="col-4 d-flex">
            	<div class="card border text-center shadow-none p20 col m0">
                	<img class="mb-3" src="assets/images/people_blue_44.svg"/>
                	<p class="htxt_medium_14 dark_600 mb-3">Add individual <br>contacts</p>
                	<p class="htxt_regular_12 dark_300 m-0 lh_17">Fill in all the details of<br> contacts and add them<br> one by one</p>
                </div>
                </div>
                
                
               <div class="col-12 text-center mt-3">
               <hr/>
               <div class="mb-3">
               <a href="#"> <img src="assets/images/Google_Contacts_icon1.svg"/> </a>
               <a href="#" class="ml10 mr10"> <img src="assets/images/maillchamp.svg"/> </a>
               <a href="#"> <img src="assets/images/hubspot-1.svg"/> </a>
               </div>
               
      			<p class="htxt_medium_14 dark_600 mb-2">Import from another service</p>
      			<p class="htxt_regular_12 dark_300 m-0">Import contact from Google, Mailchimp or another service</p>
      			
      		</div> 
      	
      	
      		
      		
      	</div>
      </div>
    </div>
  </div>
  
 <!--******************
  Request - Import Contacts - 2
 **********************-->
  <div class="modal fade" id="ImportContacts2">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
      <div class="modal-content review">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
        <a class="cross_icon back" data-dismiss="modal"><i class=""><img src="assets/images/modal_back.svg"></i></a>
      	<div class="row">
      		<div class="col-12 mb-1">
      			<h3 class="htxt_medium_24 dark_800 mb-2">Import Contacts</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Choose how do you want to import contacts</p>
      			<hr/>
      		</div>
      		
            
            <div class="col-12 mb-4">
                   <label class="m0 w-100" for="upload">
					<div class="img_vid_upload_medium2">
					  <input class="d-none" type="file" name="" value="" id="upload">
					</div>
					</label>
            </div>
            
                
                
               <div class="col-12 text-center mt-3">
      			<p class="htxt_regular_14 dark_400 mb-3"><img width="16" src="assets/images/information-line16.svg"/> Import Disclaimer</p>
      			<p class="htxt_regular_12 dark_200 m-0 lh_140 pl50 pr50 mb-2">Each subscriber should be on a new line. You can include any extra details such as name and age, and we'll match them up with your custom fields in the next step. Before you import your list, make sure it meets our permission policies.</p>
      			
      		</div> 
      	
      	
      		
      		
      	</div>
      </div>
    </div>
  </div>
 
 
 <!--******************
  Request - Match the columns
 **********************-->
  <div class="modal fade" id="Matchthecolumns">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
      <div class="modal-content review">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
        <a class="cross_icon back" data-dismiss="modal"><i class=""><img src="assets/images/modal_back.svg"></i></a>
      	<div class="row">
      		<div class="col-12 mb-1">
      			<h3 class="htxt_medium_24 dark_800 mb-2">Match the columns</h3>
      			<p class="htxt_regular_14 dark_200 m-0">For each column , select field that it corresponds to</p>
      			<hr class="mb-0"/>
      		</div>
      		
         
         
         
         <div class="col-12">
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
					<td><span class="fsize10 fw500">Column from file </span></td>
					<td><span class="fsize10 fw500"><span class="mr-1"><img src="assets/images/refresh-fill.svg"></span> Preview data</span></td>
					<td><span class="fsize10 fw500">MATCH</span></td>
					<td class="text-right"><!--<span class="mr-1"><img src="assets/images/settings-2-line.svg"></span>--></td>
				  </tr>
				  
				  
				  
				  <tr>
				   <td class="pl-0" width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td class="dark_600 fw500">Email</td>
					<td>dan.romero@example.com</td>
					<td><i class="ri-mail-open-line"></i> &nbsp;  Email</td>
					<td class="text-right"><i class="ri-arrow-down-s-line light_800 fsize24"></i></td>
				  </tr>
                  
                  <tr>
				   <td class="pl-0" width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" checked>
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td class="dark_600 fw500">First name</td>
					<td>Philip </td>
					<td><i class="ri-user-line"></i> &nbsp; First name</td>
					<td class="text-right"><i class="ri-arrow-down-s-line light_800 fsize24"></i></td>
				  </tr>
                  
                  <tr>
				   <td class="pl-0" width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td class="dark_600 fw500">Last name</td>
					<td>Mckinney </td>
					<td ><span class="light_800"><i class="ri-list-unordered"></i> &nbsp; Select field</span></td>
					<td class="text-right"><i class="ri-arrow-down-s-line light_800 fsize24"></i></td>
				  </tr>
                  
                    <tr>
				   <td class="pl-0" width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" checked>
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td class="dark_600 fw500">Phone number</td>
					<td>(203) 555-0106 </td>
					<td class=""><i class="ri-phone-line"></i> &nbsp; Phone number</td>
					<td class="text-right"><i class="ri-arrow-down-s-line light_800 fsize24"></i></td>
				  </tr>
                  
                  <tr>
				   <td class="pl-0" width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" >
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
					</td>
					<td class="dark_600 fw500">Subscriber ID</td>
					<td>3856 </td>
					<td ><span class="light_800"><i class="ri-list-unordered"></i> &nbsp; Select field</span></td>
					<td class="text-right"><i class="ri-arrow-down-s-line light_800 fsize24"></i></td>
				  </tr>
                  
                 
				  
				
				  
				 
				  
				  
				  
				  
				  
				</tbody>
			    </table>
			    
			    
			    
    		</div>
         
         
         
            <div class="col-12">
      			<hr class="mt-0">
      		</div>
            
            <div class="col-6">
             <button class="btn btn-md bkg_blue_300 light_000 pr20 min_w_160 fsize13 fw500">Import Contacts</button>
            </div>
      	
      	
      		
      		
      	</div>
      </div>
    </div>
  </div>
 
 
  <!--******************
  Request - Copy Contacts 1
 **********************-->
  <div class="modal fade" id="CopyContacts1">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
      <div class="modal-content review">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
        <a class="cross_icon back" data-dismiss="modal"><i class=""><img src="assets/images/modal_back.svg"></i></a>
      	<div class="row">
      		<div class="col-12 mb-1">
      			<h3 class="htxt_medium_24 dark_800 mb-2">Copy Contacts</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Copy all contacts from another campaign.</p>
      			<hr/>
      		</div>
      		
         
         
         
        <div class="col-12 mb-5">
      			<div class="form-group">
                <label for="fname" class="fsize11 fw500 dark_600">SELECT CAMPAIGN</label>
                <select class="form-control form-control-custom h48">
                	<option>Select review campaign</option>
                    <option>Marketing reviews campaign</option>
                    <option>Request Campaign</option>
                    <option>Marketing reviews campaign</option>
                </select>
              </div>
      		</div>
         
         
         
            <div class="col-12">
      			<hr class="mt-0">
      		</div>
            
            <div class="col-6">
             <button class="btn btn-md bkg_dark_100 light_000 pr20 min_w_160 fsize13 fw500">Import Contacts</button>
            </div>
      		<div class="col-6 text-right mt-2">
           	       <a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">LEARN MORE ABOUT FORMS &nbsp; <img src="assets/images/information-line16.svg" width="18"></a>
                    </div>
      	
      		
      		
      	</div>
      </div>
    </div>
  </div>
 
 
   <!--******************
  Request - Copy Contacts 2
 **********************-->
  <div class="modal fade" id="CopyContacts2">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
      <div class="modal-content review">
      	<a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
        <a class="cross_icon back" data-dismiss="modal"><i class=""><img src="assets/images/modal_back.svg"></i></a>
      	<div class="row">
      		<div class="col-12 mb-1">
      			<h3 class="htxt_medium_24 dark_800 mb-2">Copy Contacts</h3>
      			<p class="htxt_regular_14 dark_200 m-0">Copy all contacts from another campaign.</p>
      			<hr/>
      		</div>
      		
         
         
         
        <div class="col-12 mb-5">
      			<div class="form-group">
                <label for="fname" class="fsize11 fw500 dark_600">SELECT CAMPAIGN</label>
                <select class="form-control form-control-custom h48">
                    <option>Marketing reviews campaign</option>
                    <option>Request Campaign</option>
                    <option>Marketing reviews campaign</option>
                </select>
              </div>
              
              
              <div class="card border p30">
              <div class="row">
              <div class="col-7"><span class="circle_icon_24 bkg_blue_200 mr-2"><i class="ri-star-fill light_000"></i></span> <p class="fsize14 dark_600 m-0">Request Campaign</p></div>
              <div class="col"><p class="fsize14 dark_600 m-0">356 contacts</p></div>
              <div class="col text-right"><p class="fsize14 dark_600 m-0"><i class="ri-star-fill green_400"></i> &nbsp; 4.5</p></div>
              </div>
              </div>
      		</div>
         
         
         
            <div class="col-12">
      			<hr class="mt-0">
      		</div>
            
            <div class="col-6">
             <button class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500">Import Contacts</button>
            </div>
      		<div class="col-6 text-right mt-2">
           	       <a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">LEARN MORE ABOUT FORMS &nbsp; <img src="assets/images/information-line16.svg" width="18"></a>
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


</body>
</html>