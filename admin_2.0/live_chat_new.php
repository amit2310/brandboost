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
   	<h3 class="htxt_medium_24 dark_700">Chats </h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"/></button>
   		<button class="btn btn-md bkg_blue_300 light_000" data-toggle="modal" data-target="#CREATEFORM">START NEW CHAT<span><img src="assets/images/blue-plus.svg"/></span></button>
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
					<li><a href="#">PENDING</a></li>
					<li><a href="#">RESOLVED</a></li>
					<li><a href="#">SPAM</a></li>
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
					<td><span class="fsize10 fw500">CHAT </span></td>
					<td><span class="fsize10 fw500">EMAIL / phone</span></td>
					<td><span class="fsize10 fw500">OPERATOR</span></td>
					<td><span class="fsize10 fw500">NPS</span></td>
					<td><span class="fsize10 fw500">Tags  </span></td>
					<td><span class="fsize10 fw500">LAST SEEN <img src="assets/images/arrow-down-line-14.svg"></span></td>
					<td><span class="fsize10 fw500">ACTION  </span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">R</span></span> Robert</td>
					<td>bill.sanders@example.com</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/03.png"></span></span></td>
					<td><span class="mr-2"><img src="assets/images/emojie-face-smile.svg"></span>4.5</td>
					<td><button class="tags_btn blue">C</button> <button class="tags_btn green">U</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">1 min</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_red_100">K</span></span> Kyle</td>
					<td>(252) 555-0126</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/01.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span></span></td>
					<td>-</td>
					<td><button class="tags_btn blue">C</button> </td>
					<td><span class="green_300">Online</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
					<td><span class="float-right"><span class="status_icon bkg_red_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_reviews_100">D</span></span> Dianne</td>
					<td>kenzi.lawson@example.com</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/11.png"></span></span></td>
					<td>-</td>
					<td><button class="tags_btn blue">P</button>  <button class="tags_btn">+2 </button> </td>
					<td><span class="">3 hr</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">R</span></span> Robert</td>
					<td>bill.sanders@example.com</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/03.png"></span></span></td>
					<td><span class="mr-2"><img src="assets/images/emojie-face-smile.svg"></span>4.5</td>
					<td><button class="tags_btn blue">C</button> <button class="tags_btn">U</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">1 min</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
					<td><span class="float-right"><span class="status_icon bkg_red_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_red_100">K</span></span> Kyle</td>
					<td>(252) 555-0126</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/01.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span></span></td>
					<td>-</td>
					<td><button class="tags_btn blue">C</button> </td>
					<td><span class="green_300">Online</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
					<td><span class="float-right"><span class="status_icon bkg_review_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_reviews_100">D</span></span> Dianne</td>
					<td>kenzi.lawson@example.com</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/11.png"></span></span></td>
					<td>-</td>
					<td><button class="tags_btn blue">P</button>  <button class="tags_btn">+2 </button> </td>
					<td><span class="">3 hr</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
					<td><span class="float-right"><span class="status_icon bkg_yellow_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">R</span></span> Robert</td>
					<td>bill.sanders@example.com</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/03.png"></span></span></td>
					<td><span class="mr-2"><img src="assets/images/emojie-face-smile.svg"></span>4.5</td>
					<td><button class="tags_btn blue">C</button> <button class="tags_btn yellow">U</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">1 min</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_red_100">K</span></span> Kyle</td>
					<td>(252) 555-0126</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/01.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span></span></td>
					<td>-</td>
					<td><button class="tags_btn blue">C</button> </td>
					<td><span class="green_300">Online</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
					<td><span class="float-right"><span class="status_icon bkg_green_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_reviews_100">D</span></span> Dianne</td>
					<td>kenzi.lawson@example.com</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/11.png"></span></span></td>
					<td>-</td>
					<td><button class="tags_btn green">P</button>  <button class="tags_btn">+2 </button> </td>
					<td><span class="">3 hr</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
					<td><span class="float-right"><span class="status_icon bkg_red_300"></span></span></td>
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
					<td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">R</span></span> Robert</td>
					<td>(208) 555-0112</td>
					<td><span class="table-img"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/04.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/02.png"></span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/03.png"></span></span></td>
					<td><span class="mr-2"><img src="assets/images/emojie-eye-face-l.svg"></span>5.0</td>
					<td><button class="tags_btn blue">C</button> <button class="tags_btn green">U</button> <button class="tags_btn">+2 </button> </td>
					<td><span class="">1 min</span></td>
					<td><span class="mr-2"><img src="assets/images/chat_grey_icon.svg"/></span>Chat</td>
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