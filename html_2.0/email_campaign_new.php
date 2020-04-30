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
	.apexcharts-legend, .apexcharts-data-labels{display: none!important}
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
    
    
    
    <div class="row">
    	<div class="col-md-4 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col min-h-280">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">Email OPENS</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_regular_28 dark_700 mb-2 mt-4">1,468</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 0px 0 0;" class="img_box">
   					<!--<div id="email_open_chart" class=""></div>-->
   					<div id="bar"></div>
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
				
   				<h3 class="htxt_regular_28 dark_700 mb-2 mt-4">75,3%</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 25px 0 0;" class="img_box">
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
				
   				<h3 class="htxt_regular_28 dark_700 mb-2 mt-4">56,4%</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 30px 0 0;" class="img_box">
   					<div id="spark3"></div>
   				</div>
    		</div>
    	</div>
    	
    	
    	
    	
    	
    </div>
    
    
    
     <div class="table_head_action mt-3">
    <div class="row">
    	<div class="col-md-6">
    		<h3 class="htxt_medium_16 dark_400">Emails</h3>
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
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-mail-open-fill.svg"/></span></td>
					  <td class="text-left"><p>Slides 5 is Here! Create projects, edit...</p>
						<p class="small">Create, edit and keep static pages online. Export as a finished...</p></td>
					  <td class="text-right"><p>1,302</p>
						<p class="small">Total recipients</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_grey_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-mail-open-fill.svg"/></span></td>
					  <td class="text-left"><p>Slides 5 is Here! Create projects, edit...</p>
						<p class="small">Create, edit and keep static pages online. Export as a finished...</p></td>
					  <td class="text-right"><p>1,302</p>
						<p class="small">Total recipients</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-mail-open-fill.svg"/></span></td>
					  <td class="text-left"><p>Slides 5 is Here! Create projects, edit...</p>
						<p class="small">Create, edit and keep static pages online. Export as a finished...</p></td>
					  <td class="text-right"><p>1,302</p>
						<p class="small">Total recipients</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_grey_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-mail-open-fill.svg"/></span></td>
					  <td class="text-left"><p>Slides 5 is Here! Create projects, edit...</p>
						<p class="small">Create, edit and keep static pages online. Export as a finished...</p></td>
					  <td class="text-right"><p>1,302</p>
						<p class="small">Total recipients</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_grey_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-mail-open-fill.svg"/></span></td>
					  <td class="text-left"><p>Slides 5 is Here! Create projects, edit...</p>
						<p class="small">Create, edit and keep static pages online. Export as a finished...</p></td>
					  <td class="text-right"><p>1,302</p>
						<p class="small">Total recipients</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_green_icon_24.svg"></span></span></td>
					  <td><div class="float-right">
						  <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical-24.svg"></span> </button>
						  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
						</div></td>
					</tr>
					
					<tr>
					  <td width="48"><span class="circle-icon-48 bkg_email_000"><img src="assets/images/email-mail-open-fill.svg"/></span></td>
					  <td class="text-left"><p>Slides 5 is Here! Create projects, edit...</p>
						<p class="small">Create, edit and keep static pages online. Export as a finished...</p></td>
					  <td class="text-right"><p>1,302</p>
						<p class="small">Total recipients</p></td>
					  <td class="text-right"><p>73%</p>
						<p class="small">Open rate</p></td>
					  <td class="text-right"><p>45%</p>
						<p class="small">(CPA) Clicked</p></td>
					  <td class="text-center"><span class="table-img"><span class=""><img src="assets/images/live_grey_icon_24.svg"></span></span></td>
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


<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

    <script>
       var options7 = {
      chart: {
        type: 'bar',
        width: 240,
        height: 55,
        sparkline: {
          enabled: true
        }
      },
		colors: ['#67bae4'],
		   
		   
  

      plotOptions: {
        bar: {
          columnWidth: '70%',
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
                width: 140,
                type: 'pie',
            },
			colors:['#d1eaf7', '#67bae4', '#9C27B0'],
			legend: {
				show: false
			  },
            labels: ['A', 'B'],
            series: [75, 25],
			
			
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

       

		
		
		var randomizeArray = function (arg) {
      var array = arg.slice();
      var currentIndex = array.length,
        temporaryValue, randomIndex;

      while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }

      return array;
    }
		
	 var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];	
		
		var spark3 = {
      chart: {
        type: 'area',
		  width: 240,
        height: 70,
        sparkline: {
          enabled: true
        },
      },
			
	  colors:['#2EB4DD', '#67bae4', '#9C27B0'],
      stroke: {
        curve: 'straight',
		  width: 1
      },
			
			
			
      fill: {
        opacity: 0.1
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
      xaxis: {
        crosshairs: {
          width: 1
        },
      },
      yaxis: {
        min: 0
      }
    }


    var spark3 = new ApexCharts(document.querySelector("#spark3"), spark3);
    spark3.render();
		
		
		
		
		
		
var optionsBar = {
  chart: {
    type: 'bar',
    height: 120,
    width: '100%',
    stacked: true,
    foreColor: '#999',
	  toolbar: {
          show: false,
        }
	  
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: false
      },
      columnWidth: '70%',
      endingShape: 'rounded'
    }
  },
  colors: ["#67bae4", '#F3F2FC'],
  series: [{
    name: "Sessions",
    data: [20, 16, 24, 28, 26, 22, 15, 5, 14, 16, 22, 29, 24, 19, 15, 10, 11, 15, 19],
  }, {
    name: "Views",
    data: [20, 16, 24, 28, 26, 22, 15, 5, 14, 16, 22, 29, 24, 19, 15, 10, 11, 15, 19],
  }],
  labels: [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 1, 2, 3],
  xaxis: {
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false
    },
    crosshairs: {
      show: false
    },
    labels: {
      show: false,
      style: {
        fontSize: '14px'
      }
    },
  },
  grid: {
    xaxis: {
      lines: {
        show: false
      },
    },
    yaxis: {
      lines: {
        show: false
      },
    }
  },
  yaxis: {
    axisBorder: {
      show: false
    },
    labels: {
      show: false
    },
  },
  legend: {
    floating: true,
    position: 'top',
    horizontalAlign: 'right',
    offsetY: -36
  },
 
  tooltip: {
    shared: true
  }

}

var chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
chartBar.render();
       

    </script>
</body>
</html>