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
 .chat_user_list {max-width: 100%; margin-top:15px; }
 .chat_user_list ul{margin: 0; padding: 0;}
 .chat_user_list ul li{display: inline-block;  margin: 0 -2px; padding: 0; line-height: 36px;}
 .chat_user_list ul li img{width: 36px; height: 36px;}
</style>
</head>
<body id="EmailSection">

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
   	<h3 class="htxt_medium_24 dark_700">Charts</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/emailfilter.svg"/></button>
   		<button class="btn btn-md bkg_email_300 light_000 slidebox"> Save <span style="opacity: 0.3"><img src="assets/images/blue-plus.svg"/></span></button>
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
    <div class="col-md-3 d-flex">
     		<div class="card p0 text-center col">
     		<div class="p20 mb10">
     			<div id="credit_chart" style="max-height: 135px;">
					<apexchart type=radialBar height=200 :options="chartOptions3" :series="series" />
				  </div>
     			<p class="fsize14 mb0 mt10" style="color: #5a6f80;">You used 408/450 montly credits</p>
     		</div>
     			<div class="p15 btop">
     				<a class="fsize15 fw500 email_400 mt20" href="#">Purchase more credits</a>     			</div>
     		</div>
     	</div>
        <div class="col-md-4 d-flex">
     		<div class="card p0 text-center col">
     		<div class="p20 mb10">
     			<div id="credit_chart2" style="max-height: 135px;">
					<apexchart type=radialBar height=200 :options="chartOptions3" :series="series" />
				  </div>
     			<p class="fsize14 mb0 mt10" style="color: #5a6f80;">You used 408/450 montly credits</p>
     		</div>
     			<div class="p15 btop">
     				<a class="fsize15 fw500 email_400 mt20" href="#">Purchase more credits</a>     			</div>
     		</div>
     	</div>
        <div class="col-md-5 d-flex">
     		<div class="card p0 text-center col">
     		<div class="p20 mb10">
     			<div id="credit_chart3" style="max-height: 135px;">
					<apexchart type=radialBar height=200 :options="chartOptions3" :series="series" />
				  </div>
     			<p class="fsize14 mb0 mt10" style="color: #5a6f80;">You used 408/450 montly credits</p>
     		</div>
     			<div class="p15 btop">
     				<a class="fsize15 fw500 email_400 mt20" href="#">Purchase more credits</a>     			</div>
     		</div>
     	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col text-center">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
					</ul>
				</div>
				<div class="p30">
				<div class="row">
					<div class="col-md-12">
					<h3 class="htxt_regular_28 dark_700 mt-0 mb-1">1,468</h3>
					<p class="mb-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
                    <div class="col-md-12">
                    <div class="chat_user_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/avatar/01.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/02.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/03.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/04.png"></a></li>
     					<li><a href="#"><img src="assets/images/Plus_grey_circle.svg"></a></li>
     				</ul>
     			</div>
                    </div>
					
				</div>
				</div>
    		</div>
    	</div>
        <div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col text-center">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
					</ul>
				</div>
				<div class="p30">
				<div class="row">
					<div class="col-md-12">
					<h3 class="htxt_regular_28 dark_700 mt-0 mb-1">1,468</h3>
					<p class="mb-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
                    <div class="col-md-12">
                    <div class="chat_user_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/avatar/01.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/02.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/03.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/04.png"></a></li>
     					<li><a href="#"><img src="assets/images/Plus_grey_circle.svg"></a></li>
     				</ul>
     			</div>
                    </div>
					
				</div>
				</div>
    		</div>
    	</div>
        <div class="col-md-5 d-flex">
    		<div class="card p0 animate_top col text-center">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
					</ul>
				</div>
				<div class="p30">
				<div class="row">
					<div class="col-md-12">
					<h3 class="htxt_regular_28 dark_700 mt-0 mb-1">1,468</h3>
					<p class="mb-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
                    <div class="col-md-12">
                    <div class="chat_user_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/avatar/01.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/02.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/03.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/04.png"></a></li>
     					<li><a href="#"><img src="assets/images/Plus_grey_circle.svg"></a></li>
     				</ul>
     			</div>
                    </div>
					
				</div>
				</div>
    		</div>
    	</div>
    
    </div>
    
    <div class="row">
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">Email Activity</a></li>
					</ul>
				</div>
				<div class="p30">
				<div class="row">
					<div class="col-md-6">
						<h3 class="htxt_regular_28 dark_700 mt-0 mb-1">1,468</h3>
					<p class="m-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
					<div class="col-md-6"><div class="circle-icon-52 bkg_email2_light float-right"><img src="assets/images/emaildesign.svg"></div></div>
				</div>
				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">Email Activity</a></li>
					</ul>
				</div>
				<div class="p30">
					<div class="row">
					<div class="col-md-6">
						<h3 class="htxt_regular_28 dark_700 mt-0 mb-1">1,468</h3>
					<p class="m-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
					<div class="col-md-6"><div class="circle-icon-52 bkg_email2_light float-right"><img src="assets/images/emaildesign.svg"></div></div>
				</div>
				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-5 d-flex">
    		<div class="card p0 animate_top col">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">Email Activity</a></li>
					</ul>
				</div>
				<div class="p30 ">
					<div class="row">
					<div class="col-md-6">
						<h3 class="htxt_regular_28 dark_700 mt-0 mb-1">1,468</h3>
					<p class="m-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
					<div class="col-md-6"><div class="circle-icon-52 bkg_email2_light float-right"><img src="assets/images/emaildesign.svg"></div></div>
				</div>
				</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
     	<div class="col-md-3 d-flex">
     		<div class="card min-h-280 p0 col">
     		<div class="p15 pl40 bbot">
     			<a class="fsize12 dark_200" href="#">EMAILS SENT</a>     		</div>
     		<div class="p30 pl40 pb0">
     			<h3 class="htxt_medium_24 dark_700 mb10">51,913</h3>
     			<p class="fsize14"><span class="green_400">33,87%</span> &nbsp;  <span class="dark_400">last month</span></p>
     			<!--<img  src="assets/images/email_graph2.png"/>-->
     			
     			<div id="basiclinechart" style="margin-left: -20px">
    				<apexchart type=line height=200 :options="chartOptions2" :series="series" />
  				</div>
     		</div>
     		</div>
     	</div>
        <div class="col-md-4 d-flex">
     		<div class="card min-h-280 p0 col">
     		<div class="p15 pl40 bbot">
     			<a class="fsize12 dark_200" href="#">EMAILS SENT</a>     		</div>
     		<div class="p30 pl40 pb0">
     			<h3 class="htxt_medium_24 dark_700 mb10">51,913</h3>
     			<p class="fsize14"><span class="green_400">33,87%</span> &nbsp;  <span class="dark_400">last month</span></p>
     			<!--<img  src="assets/images/email_graph2.png"/>-->
     			
     			<div id="basiclinechart2" style="margin-left: -20px">
    				<apexchart type=line height=200 :options="chartOptions2" :series="series" />
  				</div>
     		</div>
     		</div>
     	</div>
        <div class="col-md-5 d-flex">
     		<div class="card min-h-280 p0 col">
     		<div class="p15 pl40 bbot">
     			<a class="fsize12 dark_200" href="#">EMAILS SENT</a>     		</div>
     		<div class="p30 pl40 pb0">
     			<h3 class="htxt_medium_24 dark_700 mb10">51,913</h3>
     			<p class="fsize14"><span class="green_400">33,87%</span> &nbsp;  <span class="dark_400">last month</span></p>
     			<!--<img  src="assets/images/email_graph2.png"/>-->
     			
     			<div id="basiclinechart3" style="margin-left: -20px">
    				<apexchart type=line height=200 :options="chartOptions2" :series="series" />
  				</div>
     		</div>
     		</div>
     	</div>
        </div>
        
    <div class="row">
     	<div class="col-md-3 d-flex">
     		<div class="card col pb0">
     			<h3 class="htxt_medium_32 dark_700">139</h3>
     			<p class="grey-sub-headings">Subscriptions</p>
     			 <div id="chartSubscriptions" style="margin-left: -20px">
					<apexchart type=bar height=200 :options="chartOptions" :series="series" />
				  </div>
     		</div>
     	</div>
        <div class="col-md-4 d-flex">
     		<div class="card col pb0">
     			<h3 class="htxt_medium_32 dark_700">139</h3>
     			<p class="grey-sub-headings">Subscriptions</p>
     			 <div id="chartSubscriptions2" style="margin-left: -20px">
					<apexchart type=bar height=200 :options="chartOptions" :series="series" />
				  </div>
     		</div>
     	</div>
        <div class="col-md-5 d-flex">
     		<div class="card col pb0">
     			<h3 class="htxt_medium_32 dark_700">139</h3>
     			<p class="grey-sub-headings">Subscriptions</p>
     			 <div id="chartSubscriptions3" style="margin-left: -20px">
					<apexchart type=bar height=200 :options="chartOptions" :series="series" />
				  </div>
     		</div>
     	</div>
     </div>
    
    <div class="row">
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col text-center">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
					</ul>
				</div>
				<div class="p30">
				<div class="row">
                    <div class="col-md-12"><div class="circle-icon-52 bkg_email2_light m-auto"><img src="assets/images/emaildesign.svg"></div></div>
					<div class="col-md-12">
					<h3 class="htxt_regular_28 dark_700 mt-3 mb-1">1,468</h3>
					<p class="mb-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
                    <div class="col-md-12">
                    <div class="chat_user_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/avatar/01.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/02.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/03.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/04.png"></a></li>
     					<li><a href="#"><img src="assets/images/Plus_grey_circle.svg"></a></li>
     				</ul>
     			</div>
                    </div>
					
				</div>
				</div>
    		</div>
    	</div>
    	<div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col text-center">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
					</ul>
				</div>
				<div class="p30">
				<div class="row">
                    <div class="col-md-12"><div class="circle-icon-52 bkg_email2_light m-auto"><img src="assets/images/emaildesign.svg"></div></div>
					<div class="col-md-12">
					<h3 class="htxt_regular_28 dark_700 mt-3 mb-1">1,468</h3>
					<p class="mb-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
                    <div class="col-md-12">
                    <div class="chat_user_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/avatar/01.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/02.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/03.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/04.png"></a></li>
     					<li><a href="#"><img src="assets/images/Plus_grey_circle.svg"></a></li>
     				</ul>
     			</div>
                    </div>
					
				</div>
				</div>
    		</div>
    	</div>
        <div class="col-md-5 d-flex">
    		<div class="card p0 animate_top col text-center">
				<div class="p15 pt15 bbot">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
					</ul>
				</div>
				<div class="p30">
				<div class="row">
                    <div class="col-md-12"><div class="circle-icon-52 bkg_email2_light m-auto"><img src="assets/images/emaildesign.svg"></div></div>
					<div class="col-md-12">
					<h3 class="htxt_regular_28 dark_700 mt-3 mb-1">1,468</h3>
					<p class="mb-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					</div>
                    <div class="col-md-12">
                    <div class="chat_user_list">
     				<ul>
     					<li><a href="#"><img src="assets/images/avatar/01.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/02.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/03.png"></a></li>
     					<li><a href="#"><img src="assets/images/avatar/04.png"></a></li>
     					<li><a href="#"><img src="assets/images/Plus_grey_circle.svg"></a></li>
     				</ul>
     			</div>
                    </div>
					
				</div>
				</div>
    		</div>
    	</div>
    </div>
    
    
    <div class="row">
    <div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col text-center">
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
    	</div>
        <div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col text-center">
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
    	</div>
        <div class="col-md-5 d-flex">
    		<div class="card p0 animate_top col text-center">
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
    	</div>
    
    </div>
    
    
    <div class="row">
    	<div class="col-md-6">
    		<div class="table-responsive">
    			<table class="table table-borderless">
				<tbody>
			  
			     <tr>
					<td><span class="fsize12 fw300">Visitor name </span></td>
					<td><span class="fsize12 fw300">Preview data</span></td>
					<td><span class="fsize12 fw300">List fields</span></td>
                    <td><span class="fsize12 fw300">&nbsp;</span></td>
				  </tr>
				  
				  
				  
				  <tr>
					<td><span class="table-img mr15"><!--<img src="assets/images/table_user.png"/>--><span class="fl_name">am</span></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
					<td class="text-right">nina.hernandez@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user2.png"></span> <span class="htxt_medium_14 dark_900">Savannah Webb</span></td>
					<td class="text-right">ivan.carter@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user3.png"></span> <span class="htxt_medium_14 dark_900">Bessie Flores</span></td>
					<td class="text-right">tim.jennings@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user4.png"></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
					<td class="text-right">logan.hopkins@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user2.png"></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
					<td class="text-right">logan.hopkins@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
    		</div>
    	</div>
        <div class="col-md-6">
    		<div class="table-responsive">
    			<table class="table table-borderless">
				<tbody>
			  
			     <tr>
					<td><span class="fsize12 fw300">Visitor name </span></td>
					<td><span class="fsize12 fw300">Preview data</span></td>
					<td><span class="fsize12 fw300">List fields</span></td>
                    <td><span class="fsize12 fw300">&nbsp;</span></td>
				  </tr>
				  
				  
				  
				  <tr>
					<td><span class="table-img mr15"><!--<img src="assets/images/table_user.png"/>--><span class="fl_name">am</span></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
					<td class="text-right">nina.hernandez@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user2.png"></span> <span class="htxt_medium_14 dark_900">Savannah Webb</span></td>
					<td class="text-right">ivan.carter@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user3.png"></span> <span class="htxt_medium_14 dark_900">Bessie Flores</span></td>
					<td class="text-right">tim.jennings@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user4.png"></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
					<td class="text-right">logan.hopkins@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
					<td><span class="table-img mr15"><img src="assets/images/table_user2.png"></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
					<td class="text-right">logan.hopkins@example.com</td>
					
					<td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"></span> <span class="icons"><img src="assets/images/star-line.svg"></span> 
					</td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
							  <span><img src="assets/images/more-vertical.svg"></span>
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
    		</div>
    	</div>
    </div>
    
    
    <div class="row">
    	<div class="col-md-6">
    		<div class="card p40 pt0 pb20">
     		<div class="row">
     							<div class="col-md-7">
     								<p class="fsize12 fw500 dark_200 mt30 mb30"><i><img src="assets/images/lightbulb-fill.svg"></i> &nbsp; TIPS</p>
     								<h3 class="htxt_bold_18 dark_800">Set up your live chat widget</h3>
     								<p class="htxt_regular_14 dark_400 mt15 mb25 lh_20">Visitors tab you can see the list of all users currently visiting your website. Here you check their location, which browser they are using, and the URL of the page 
they are currently viewing.</p>
     								
     							</div>
     							<div class="col-md-5 text-center mt-5">
     								<img class="mt0" style="max-width: 288px;" src="assets/images/tips_smiley_graphics.png">
     							</div>
     						</div>
     		</div>
    	</div>
        <div class="col-md-6">
    		<div class="card p40 pt0 pb20">
     		<div class="row">
     							<div class="col-md-7">
     								<p class="fsize12 fw500 dark_200 mt30 mb30"><i><img src="assets/images/lightbulb-fill.svg"></i> &nbsp; TIPS</p>
     								<h3 class="htxt_bold_18 dark_800">Set up your live chat widget</h3>
     								<p class="htxt_regular_14 dark_400 mt15 mb25 lh_20">Visitors tab you can see the list of all users currently visiting your website. Here you check their location, which browser they are using, and the URL of the page 
they are currently viewing.</p>
     								
     							</div>
     							<div class="col-md-5 text-center mt-5">
     								<img class="mt0" style="max-width: 288px;" src="assets/images/tips_smiley_graphics.png">
     							</div>
     						</div>
     		</div>
    	</div>
    </div>
    
    
    <div class="row">
    	<div class="col-md-6">
    		<div class="table-responsive">
    			<table class="table table-borderless">
				<tbody>
			  
			     <tr>
			     	
					<td><span class="fsize12 fw300">Message </span></td>
					
					<td><span class="fsize12 fw300">From</span></td>
					<td><span class="fsize12 fw300">Status</span></td>
					<td><span class="fsize12 fw300">&nbsp;</span></td>
				  </tr>
				  
				  
				  
				
				  
				   <tr>
					<td><span class="table-img mr15"><img src="assets/images/star-fill-grey.svg"></span> <span class="htxt_medium_14 dark_700">Review Request</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/03.png"></span></span> <span class="dark_500">Jorge Williamson</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/live_green_icon.png"></span></span> <span class=" dark_500">Live</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				  
				  <tr>
					<td><span class="table-img mr15"><img src="assets/images/hello1.svg"></span> <span class="htxt_medium_14 dark_700">Hello Message</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/04.png"></span></span> <span class="dark_500">Tanya Howard</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/off_grey_icon.png"></span></span> <span class=" dark_500">Off</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				  <tr>
					<td><span class="table-img mr15"><img src="assets/images/star-fill-grey.svg"></span> <span class="htxt_medium_14 dark_700">Recommend</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/05.png"></span></span> <span class="dark_500">Arlene Simmmons</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/off_grey_icon.png"></span></span> <span class=" dark_500">Off</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				  <tr>
					<td><span class="table-img mr15"><img src="assets/images/hello1.svg"></span> <span class="htxt_medium_14 dark_700">Website Onboarding</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/05.png"></span></span> <span class="dark_500">Tanya Howard</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/live_green_icon.png"></span></span> <span class=" dark_500">Live</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				  
				  
				  
				  
				  
				</tbody>
			  </table>
    		</div>
    	</div>
        <div class="col-md-6">
    		<div class="table-responsive">
    			<table class="table table-borderless">
				<tbody>
			  
			     <tr>
			     	
					<td><span class="fsize12 fw300">Message </span></td>
					
					<td><span class="fsize12 fw300">From</span></td>
					<td><span class="fsize12 fw300">Status</span></td>
					<td><span class="fsize12 fw300">&nbsp;</span></td>
				  </tr>
				  
				  
				  
				  <tr>
					<td><span class="table-img mr15"><img src="assets/images/fire-fill.svg"></span> <span class="htxt_medium_14 dark_700">Best Price Promo</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/01.png"></span></span> <span class="dark_500">Tanya Howard</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/live_green_icon.png"></span></span> <span class=" dark_500">Live</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				  
				  <tr>
					<td><span class="table-img mr15"><img src="assets/images/hello1.svg"></span> <span class="htxt_medium_14 dark_700">1st Message</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/02.png"></span></span> <span class="dark_500">Floyd Russell</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/off_grey_icon.png"></span></span> <span class=" dark_500">Off</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				   <tr>
					<td><span class="table-img mr15"><img src="assets/images/star-fill-grey.svg"></span> <span class="htxt_medium_14 dark_700">Review Request</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/03.png"></span></span> <span class="dark_500">Jorge Williamson</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/live_green_icon.png"></span></span> <span class=" dark_500">Live</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				  
				  <tr>
					<td><span class="table-img mr15"><img src="assets/images/hello1.svg"></span> <span class="htxt_medium_14 dark_700">Hello Message</span></td>
					
					<td><span class="table-img mr15"><span class="fl_name"><img src="assets/images/avatar/04.png"></span></span> <span class="dark_500">Tanya Howard</span></td>
					<td><span class="table-img mr15"><span class=""><img src="assets/images/off_grey_icon.png"></span></span> <span class=" dark_500">Off</span></td>
					<td>
						<div class="float-right">
							<button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
							  <span><img src="assets/images/more-vertical.svg"></span>
							</button>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
							  <a class="dropdown-item" href="#">Link 1</a>
							  <a class="dropdown-item" href="#">Link 2</a>
							  <a class="dropdown-item" href="#">Link 3</a>
							</div>
						  </div>
					</td>
				  </tr>
				  
				
				  
				  
				  
				  
				  
				</tbody>
			  </table>
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
	$(".nav-link.email").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.email").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>
  

  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>
   
  <script>
    var colors = ['#a3d6ee'];
    var colors2 = ['#59b3e1'];
    
    new Vue({
      el: '#chartSubscriptions',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30, 21, 22, 10, 28, 16, /*21, 13, 30, 16, 21, 13, 30, 21*/]
        }],
        chartOptions: {
          chart: {
            height: 100,
            type: 'bar',
            events: {
              click: function (chart, w, e) {
                console.log(chart, w, e)
              }
            },
			  
			  toolbar: {
                show: false
              }
			  
			  
          },
			
			grid: {
			  borderColor: '#ddd',
			  strokeDashArray: 5,
			},
			
          colors: colors,
          plotOptions: {
            bar: {
              columnWidth: '60%',
              distributed: true,
				//endingShape: 'rounded'
            }
          },
          dataLabels: {
            enabled: false,
          },

          xaxis: {
            categories: ['Amit', 'Alen', 'Umair', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Andrew'],
            labels: {
              style: {
                colors: colors,
                fontSize: '14px'
              },
				 show: false
            }
          },
			
			yaxis: {
            labels: {
				 show: false
            }
          }
			
			
			
			
        }
      }
    })
	
	 new Vue({
      el: '#chartSubscriptions2',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30, 21, 22, 10, 28, 16, /*21, 13, 30, 16, 21, 13, 30, 21*/]
        }],
        chartOptions: {
          chart: {
            height: 100,
            type: 'bar',
            events: {
              click: function (chart, w, e) {
                console.log(chart, w, e)
              }
            },
			  
			  toolbar: {
                show: false
              }
			  
			  
          },
			
			grid: {
			  borderColor: '#ddd',
			  strokeDashArray: 5,
			},
			
          colors: colors,
          plotOptions: {
            bar: {
              columnWidth: '60%',
              distributed: true,
				//endingShape: 'rounded'
            }
          },
          dataLabels: {
            enabled: false,
          },

          xaxis: {
            categories: ['Amit', 'Alen', 'Umair', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Andrew'],
            labels: {
              style: {
                colors: colors,
                fontSize: '14px'
              },
				 show: false
            }
          },
			
			yaxis: {
            labels: {
				 show: false
            }
          }
			
			
			
			
        }
      }
    })
	 new Vue({
      el: '#chartSubscriptions3',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30, 21, 22, 10, 28, 16, /*21, 13, 30, 16, 21, 13, 30, 21*/]
        }],
        chartOptions: {
          chart: {
            height: 100,
            type: 'bar',
            events: {
              click: function (chart, w, e) {
                console.log(chart, w, e)
              }
            },
			  
			  toolbar: {
                show: false
              }
			  
			  
          },
			
			grid: {
			  borderColor: '#ddd',
			  strokeDashArray: 5,
			},
			
          colors: colors,
          plotOptions: {
            bar: {
              columnWidth: '60%',
              distributed: true,
				//endingShape: 'rounded'
            }
          },
          dataLabels: {
            enabled: false,
          },

          xaxis: {
            categories: ['Amit', 'Alen', 'Umair', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Max', 'Andrew', 'Amit', 'Alen', 'Umair', 'Max', 'Andrew'],
            labels: {
              style: {
                colors: colors,
                fontSize: '14px'
              },
				 show: false
            }
          },
			
			yaxis: {
            labels: {
				 show: false
            }
          }
			
			
			
			
        }
      }
    })
	

    new Vue({
      el: '#basiclinechart',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: "Desktops",
            data: [4, 3, 4, 6, 3, 4, 7, 2, 3, 5, 3, 7, 8, 4, 4, /*3, 5, 7, 3, 5, 3, 7, 8, 4*/ ]
        }],
        chartOptions2: {
          chart: {
                height: 350,
                zoom: {
                    enabled: false
                },
			  
			  toolbar: {
                show: false
              }
            },
			colors: colors2,
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
				 width: 4
            },
			
           
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.1
                },
				borderColor: '#ddd',
			    strokeDashArray: 5
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
				labels: {
              style: {
                colors: colors2,
                fontSize: '14px',
				  fill: '#cccccc'
              },
				 show: false
            }
            },
			
			
			yaxis: {
			labels: {
              style: {
                colors: colors,
                fontSize: '16px'
              }
            }
            },
			
			
			
			
        }
      },
      
    })
	
	new Vue({
      el: '#basiclinechart2',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: "Desktops",
            data: [4, 3, 4, 6, 3, 4, 7, 2, 3, 5, 3, 7, 8, 4, 4, /*3, 5, 7, 3, 5, 3, 7, 8, 4*/ ]
        }],
        chartOptions2: {
          chart: {
                height: 350,
                zoom: {
                    enabled: false
                },
			  
			  toolbar: {
                show: false
              }
            },
			colors: colors2,
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
				 width: 4
            },
			
           
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.1
                },
				borderColor: '#ddd',
			    strokeDashArray: 5
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
				labels: {
              style: {
                colors: colors2,
                fontSize: '14px',
				  fill: '#cccccc'
              },
				 show: false
            }
            },
			
			
			yaxis: {
			labels: {
              style: {
                colors: colors,
                fontSize: '16px'
              }
            }
            },
			
			
			
			
        }
      },
      
    })
	
	new Vue({
      el: '#basiclinechart3',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: "Desktops",
            data: [4, 3, 4, 6, 3, 4, 7, 2, 3, 5, 3, 7, 8, 4, 4, /*3, 5, 7, 3, 5, 3, 7, 8, 4*/ ]
        }],
        chartOptions2: {
          chart: {
                height: 350,
                zoom: {
                    enabled: false
                },
			  
			  toolbar: {
                show: false
              }
            },
			colors: colors2,
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
				 width: 4
            },
			
           
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.1
                },
				borderColor: '#ddd',
			    strokeDashArray: 5
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
				labels: {
              style: {
                colors: colors2,
                fontSize: '14px',
				  fill: '#cccccc'
              },
				 show: false
            }
            },
			
			
			yaxis: {
			labels: {
              style: {
                colors: colors,
                fontSize: '16px'
              }
            }
            },
			
			
			
			
        }
      },
      
    })
  </script>
  
  
  <script>
	  var colors4 = ['#a3d6ee'];
    new Vue({
      el: '#credit_chart',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [67],
        chartOptions3: {
          plotOptions: {
            radialBar: {
              startAngle: -105,
              endAngle: 105,
              dataLabels: {
                name: {
                  fontSize: '12px',
                  color: '#a0adbb',
                  offsetY: 45
                },
                value: {
                  offsetY: -15,
                  fontSize: '22px',
                  color: undefined,
                  formatter: function (val) {
                    return val + "";
                  }
                }
              }
            }
          },
			colors: colors4,
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'dark',
              shadeIntensity: 0.15,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91]
            },
          },
          stroke: {
            dashArray: 2.5
          },
          labels: ['CREDITS BALANCE']
        }
      },

    })
	
	new Vue({
      el: '#credit_chart2',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [67],
        chartOptions3: {
          plotOptions: {
            radialBar: {
              startAngle: -105,
              endAngle: 105,
              dataLabels: {
                name: {
                  fontSize: '12px',
                  color: '#a0adbb',
                  offsetY: 45
                },
                value: {
                  offsetY: -15,
                  fontSize: '22px',
                  color: undefined,
                  formatter: function (val) {
                    return val + "";
                  }
                }
              }
            }
          },
			colors: colors4,
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'dark',
              shadeIntensity: 0.15,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91]
            },
          },
          stroke: {
            dashArray: 2.5
          },
          labels: ['CREDITS BALANCE']
        }
      },

    })
	
	new Vue({
      el: '#credit_chart3',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [67],
        chartOptions3: {
          plotOptions: {
            radialBar: {
              startAngle: -105,
              endAngle: 105,
              dataLabels: {
                name: {
                  fontSize: '12px',
                  color: '#a0adbb',
                  offsetY: 45
                },
                value: {
                  offsetY: -15,
                  fontSize: '22px',
                  color: undefined,
                  formatter: function (val) {
                    return val + "";
                  }
                }
              }
            }
          },
			colors: colors4,
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'dark',
              shadeIntensity: 0.15,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91]
            },
          },
          stroke: {
            dashArray: 2.5
          },
          labels: ['CREDITS BALANCE']
        }
      },

    })
  </script>
  
</body>
</html>