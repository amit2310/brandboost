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

<style>
	.apexcharts-xaxis, .apexcharts-yaxis {
	pointer-events: none;
	display: none;
}
	.apexcharts-xaxis-tick{display: none}
	
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
   	<h3 class="htxt_medium_24 dark_700">My Perfect Campaign</h3>
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
    	<div class="col-md-4 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">Email OPENS</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">1,468</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 30px 0 0;" class="img_box">
   					<div id="email_open_chart" class=""></div>
   				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-4 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">OPEN RATE</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">75,3%</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 20px 0 10px;" class="img_box">
   					<div id="openrate"></div>
   				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-4 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">CLICK RATE</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">56,4%</h3>
   				<p class="fsize14 fw400 dark_200 mb0"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 5px 0 0; padding-right: 10px;" class="img_box">
   					<div id="spark3"></div>
   				</div>
    		</div>
    	</div>
    	
    	
    </div>
    
    
    
    <div class="table_head_action mt-5">
    <div class="row">
    	<div class="col-md-6">
    		<h3 class="htxt_medium_16 dark_400">Email</h3>
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
			  <span><img src="assets/images/list_view.svg"></span>&nbsp; List View
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
    			<table class="table table-borderless">
				<tbody>
			  
			    
				  
				  
				  
				  <tr>
					<td><span class="table-img mr15"><img src="assets/images/table_user.png"/></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
					<td class="text-right">nina.hernandez@example.com</td>
					<td># lead, subscriber</td>
					<td><span class="badge badge-dark">+4</span></td>
					<td>Customer</td>
					<td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
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
					<td><span class="table-img mr15"><!--<img src="assets/images/table_user.png"/>--><span class="fl_name">am</span></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
					<td class="text-right">nina.hernandez@example.com</td>
					<td># lead, subscriber</td>
					<td><span class="badge badge-dark">+4</span></td>
					<td>Customer</td>
					<td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
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
					<td># lead, subscriber</td>
					<td><span class="badge badge-dark">+4</span></td>
					<td>Ticket</td>
					<td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
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
					<td># lead, subscriber</td>
					<td><span class="badge badge-dark">+4</span></td>
					<td>Customer</td>
					<td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
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
					<td># lead, subscriber</td>
					<td><span class="badge badge-dark">+4</span></td>
					<td>Ticket</td>
					<td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
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
					<td># lead, subscriber</td>
					<td><span class="badge badge-dark">+4</span></td>
					<td>Ticket</td>
					<td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
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


<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

    <script>
       var options7 = {
      chart: {
        type: 'bar',
        width: 300,
        height: 105,
        sparkline: {
          enabled: true
        }
      },
		colors: ['#dbe4f3'],
		   
		   
  

      plotOptions: {
        bar: {
          columnWidth: '60%',
			endingShape: 'rounded'	
        }
      },
      series: [{
        data: [47, 45, 74, 94, 56, 74, 24, 21, 77, 39, 82, 56, 74, 34, 91]
      }],
      labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
      xaxis: {
        crosshairs: {
          width: 1
        },
      },
      tooltip: {
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function (seriesName) {
              return ''
            }
          }
        },
        marker: {
          show: false
        }
      }
	  
	  
	  
    }

    

   
    new ApexCharts(document.querySelector("#email_open_chart"), options7).render();
		
		
	

        var options2 = {
            chart: {
                width: 180,
                type: 'pie',
            },
			colors:['#62C08E', '#67bae4', '#dbe4f3'],
			legend: {
				show: false
			  },
            labels: ['A', 'B', 'C'],
            series: [39, 59, 45],
			
			
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    }
                }
            }]
        }

        var chart = new ApexCharts(document.querySelector("#openrate"), options2).render();

       

		
		
		var options3 = {
            chart: {
                height: 160	,
                type: 'area',
				toolbar: {
          			show: false
					}
				
            },
			
			
			
			
			colors:['#67bae4', '#67bae4', '#dbe4f3'],
			
            dataLabels: {
                enabled: false
            },
            plotOptions: {
              area: {
                isRange: true
              }
            },
            stroke: {
                curve: 'straight'
            },
            series: [{
                name: 'range',
                data: [
                {
                  x: new Date(1538780400000),
                  y: [6632.01, 6643.59]
                },
                {
                  x: new Date(1538782200000),
                  y: [6630.71, 6648.95]
                },
                {
                  x: new Date(1538784000000),
                  y: [6635.65, 6651]
                },
                {
                  x: new Date(1538785800000),
                  y: [6638.24, 6640]
                },
                {
                  x: new Date(1538787600000),
                  y: [6624.53, 6636.03]
                },
                {
                  x: new Date(1538789400000),
                  y: [6624.61, 6632.2]
                },
                {
                  x: new Date(1538791200000),
                  y: [6617, 6627.62]
                },
                {
                  x: new Date(1538793000000),
                  y: [6605, 6608.03]
                },
                {
                  x: new Date(1538794800000),
                  y: [6604.5, 6614.4]
                },
                {
                  x: new Date(1538796600000),
                  y: [6608.02, 6610.68]
                },
                {
                  x: new Date(1538798400000),
                  y: [6608.91, 6618.99]
                },
                {
                  x: new Date(1538800200000),
                  y: [6612, 6615.13]
                },
                {
                  x: new Date(1538802000000),
                  y: [6612, 6624.12]
                },
                {
                  x: new Date(1538803800000),
                  y: [6603.91, 6623.91]
                },
                {
                  x: new Date(1538805600000),
                  y: [6611.69, 6618.74]
                },
                {
                  x: new Date(1538807400000),
                  y: [6611, 6622.78]
                },
                {
                  x: new Date(1538809200000),
                  y: [6614.9, 6626.2]
                }
                ]
            }],
            
            xaxis: {
                type: 'datetime',
				labels: {
					show: false
					}
			},
			
			yaxis: {
                
				labels: {
					show: false
					}
			}
            
        }

        var chart = new ApexCharts(
            document.querySelector("#spark3"),
            options3
        );

        chart.render();
		
       

    </script>
</body>
</html>