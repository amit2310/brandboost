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
	  .apexcharts-legend, .apexcharts-pie-label{display: none!important}
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
   	<h3 class="htxt_medium_24 dark_700">Email Campaigns</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/emailfilter.svg"/></button>
   		<button class="btn btn-md bkg_email_300 light_000 slidebox"> New campaign <span style="opacity: 0.3"><img src="assets/images/blue-plus.svg"/></span></button>
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
    		<h3 class="htxt_medium_16 dark_400">Email Campaigns</h3>
    	</div>
    	<div class="col-md-6">
    	<div class="table_action">
			<div class="float-right">
			<button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
			  <span><img src="assets/images/date_created.svg"></span>&nbsp; Date Created
			</button>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="#">Link 1</a>
			  <a class="dropdown-item" href="#">Link 2</a>
			  <a class="dropdown-item" href="#">Link 3</a>
			</div>
		  </div>
			<div class="float-right ml10 mr10">
			<button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
			  <span><img src="assets/images/list_view.svg"></span>&nbsp; Cards
			</button>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="#">Link 1</a>
			  <a class="dropdown-item" href="#">Link 2</a>
			  <a class="dropdown-item" href="#">Link 3</a>
			</div>
		  </div>
		  <div class="float-right">
			<input class="table_search" type="text" placeholder="Serch">
		  </div>
    	</div>
    	</div>
    </div>
    </div>
    
    
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="table-responsive">
    			<table class="table table-borderless big">
				  <tbody>
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-send-plane-fill.svg"/></span></td>
					  <td class="text-left"><p>Summer Email Campaign</p>
						<p class="small">Scheduled Broadcast  •  August 01, 2018  • 11:30 AM</p></td>
					  <td class="text-right"><p>283</p>
						<p class="small">Email sent</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td width="100" class="text-center">
					  <!--<span class="table-img"><span class=""><img src="assets/images/email_table_graph.svg"></span></span>-->
					  	<div style="height: 48px!important; margin-top: -15px" id="chart">
							<apexchart type=donut width=102 :options="chartOptions" :series="series" />
						  </div>
					  </td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-send-plane-fill.svg"/></span></td>
					  <td class="text-left"><p>1st Campaign</p>
						<p class="small">Scheduled Broadcast  •  August 01, 2018  • 11:30 AM</p></td>
					  <td class="text-right"><p>283</p>
						<p class="small">Email sent</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/email_table_graph.svg"></span></span></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-send-plane-fill.svg"/></span></td>
					  <td class="text-left"><p>Promotional Offer Sequence</p>
						<p class="small">Scheduled Broadcast  •  August 01, 2018  • 11:30 AM</p></td>
					  <td class="text-right"><p>283</p>
						<p class="small">Email sent</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/email_table_graph.svg"></span></span></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-send-plane-fill.svg"/></span></td>
					  <td class="text-left"><p>2st Campaign</p>
						<p class="small">Scheduled Broadcast  •  August 01, 2018  • 11:30 AM</p></td>
					  <td class="text-right"><p>283</p>
						<p class="small">Email sent</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/email_table_graph.svg"></span></span></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-send-plane-fill.svg"/></span></td>
					  <td class="text-left"><p>Summer Email Campaign</p>
						<p class="small">Scheduled Broadcast  •  August 01, 2018  • 11:30 AM</p></td>
					  <td class="text-right"><p>283</p>
						<p class="small">Email sent</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/email_table_graph.svg"></span></span></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-send-plane-fill.svg"/></span></td>
					  <td class="text-left"><p>Promotional Offer Sequence Test</p>
						<p class="small">Scheduled Broadcast  •  August 01, 2018  • 11:30 AM</p></td>
					  <td class="text-right"><p>283</p>
						<p class="small">Email sent</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/email_table_graph.svg"></span></span></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
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
    new Vue({
      el: '#chart',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [85, 15],
		  
        chartOptions: {
		  colors:['#67bae4', '#d5dfef'],
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 110
              },
              legend: {
                position: 'bottom'
              }
            }
          }]
        }
      },

    })
  </script>
  
  
  
</body>
</html>