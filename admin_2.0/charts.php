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
    		<div class="card p0 animate_top col max_h_300">
						<div class="p15 pt15 bbot text-center">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_600" href="#">Email OPENS</a></li>
							</ul>
						</div>
						
						<div class="pt20 pb0 text-center">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"/></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20 pt0 pb0">
   					<div style="margin-left: -20px" id="chart_01">
						<apexchart type=bar height=170 :options="chartOptions" :series="series" />
					  </div>
   				</div>
   				
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col max_h_300">
						<div class="p15 pt15 bbot text-center">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_600" href="#">OPEN RATE</a></li>
							</ul>
						</div>
						<div class="pt20 pb0 text-center">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"/></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20 pb0 pt0">
   					<div style="margin-left: -20px" id="chart_02">
						<apexchart type=line height=180 :options="chartOptions" :series="series" />
					  </div>
   				</div>
   				
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col max_h_300">
						<div class="p15 pt15 bbot text-center">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_600" href="#">CLICK RATE</a></li>
							</ul>
						</div>
						<div class="pt20 pb0 text-center">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"/></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20 pt0 pb0">
   					<div style="margin-left: -20px" id="chart_03">
						<apexchart type=line height=180 :options="chartOptions" :series="series" />
					  </div>
   				</div>
   				
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col max_h_300">
						<div class="p15 pt15 bbot text-center">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_600" href="#">Email Activity</a></li>
							</ul>
						</div>
						
						<div class="pt20 pb0 text-center">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"/></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20 pt0 pb0">
   					<div style="margin-left: -20px;" id="chart_04">
						<apexchart type=line height=200 :options="chartOptions" :series="series" />
					  </div>
   				</div>
   				
    		</div>
    	</div>
    	
    	
    	
    	
    </div>
    <div class="row">
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col max_h_330">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">Email OPENS</a></li>
							</ul>
						</div>
						<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"/></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20">
   					  <div id="chart_05">
						<apexchart type=donut width=300 :options="chartOptions" :series="series" />
					  </div>
   				</div>
   				
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col max_h_330">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">OPEN RATE</a></li>
							</ul>
						</div>
						<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"/></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20">
   					<div id="chart_06">
						<apexchart type=pie width=300 :options="chartOptions" :series="series" />
					  </div>
   				</div>
   				
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col max_h_330">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">CLICK RATE</a></li>
							</ul>
						</div>
						<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"/></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20">
   					<div id="chart_07">
    <apexchart type=radialBar height=220 :options="chartOptions" :series="series" />
  </div>
   				</div>
   				
    		</div>
    	</div>
    	<div class="col-md-3 d-flex">
    		<div class="card p0 animate_top col max_h_330">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">CLICK RATE</a></li>
							</ul>
						</div>
						
						<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"/></i>33,87%</span>last week</p>
						</div>
						
						
						<div class="p20">
							<div id="chart_08">
    <apexchart type=radialBar height=220 :options="chartOptions" :series="series" />
  </div>
						</div>
   				
   				
    		</div>
    	</div>
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    </div>
    
    
  

  
  
  <div class="row">
    	
    	<div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">CLICK RATE</a></li>
							</ul>
						</div>
						<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"/></i>33,87%</span>last week</p>
						</div>
						<div class="p20">
							<div id="chart_09">
							<apexchart type=radialBar height=250 :options="chartOptions" :series="series" />
						  </div>
						</div>
   				
   				
    		</div>
    	</div>
    	
     	<div class="col-md-4 d-flex">
     		<div class="card min-h-280 p0 animate_top col">
     		
     		<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">EMAILS SENT</a></li>
							</ul>
						</div>
						
						
     		<div class="p0">
     			<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
						</div>
     			
     			<div class="p30 pb0">
     				<div id="basiclinechart" style="margin-left: -20px">
    				<apexchart type=line height=200 :options="chartOptions2" :series="series" />
  				</div>
     			</div>
     			
    		
    		
    		
     		</div>
     		</div>
     	</div>
     	<div class="col-md-4 d-flex">
     		<div class="card col pb0 animate_top">
     			<h3 class="htxt_medium_32 dark_700">139</h3>
     			<p class="grey-sub-headings">Subscriptions</p>
     			<!--<img class="mt-5" src="assets/images/email_graph.png"/>-->
     			
     			
     			 <div id="chartSubscriptions" style="margin-left: -20px">
					<apexchart type=bar height=240 :options="chartOptions" :series="series" />
				  </div>
     			
     		</div>
     	</div>
     </div>
   
    
    
    <div class="row">
    	<div class="col-md-6 d-flex">
    		<div class="card p0 animate_top col ">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">Email OPENS</a></li>
							</ul>
						</div>
						
						<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"></i>33,87%</span>last week</p>
						</div>
						
						
				
   				<div class="p20 pb0 pt0">
					  <div id="chart_10">
						<apexchart type=scatter height=300 :options="chartOptions" :series="series" />
					  </div>
   				</div>
   				
    		</div>
    	</div>
    	
    	<div class="col-md-6 d-flex">
    		<div class="card p0 animate_top col ">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">Email OPENS</a></li>
							</ul>
						</div>
						<div class="pt20 pb0 pl20 text-left">
							<h3 class="htxt_regular_28 dark_700">1,468</h3>
							<p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
						</div>
				
   				<div class="p20 pb0 pt0">
					  <!--<div id="chart_10">
						<apexchart type=scatter height=300 :options="chartOptions" :series="series" />
					  </div>-->
					  <div id="chart112">
    						<apexchart type=heatmap height=275 :options="chartOptions" :series="series" />
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
	  
	  var colors = ['#50A98F', '#4F8AF4', '#67BAE4'];
	  
	  
    new Vue({
      el: '#chart_01',
      components: {
        apexchart: VueApexCharts,
      },
		
      data: {
        series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
		
		  
        chartOptions: {
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '80%',
             
            },
          },
			
			colors: colors,
			
			chart:{
			toolbar: {
                show: false
              }			
				
			},
			
			
			grid: {
			  borderColor: '#eee',
			  strokeDashArray: 5,
			},
			
			
			 
			
          dataLabels: {
            enabled: false
          },
          stroke: {
            show: true,
            width: 1,
            colors: ['transparent']
          },

          xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
			  labels:{
				  show:false
			  }
          },
          yaxis: {
			  labels:{
				  show:false
			  }
          },
          fill: {
            opacity: 1

          }
        }
      }
    })
  </script>
  
  
  
  
  <script>
    new Vue({
      el: '#chart_02',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
        chartOptions: {
          chart: {
                height: 350,
                zoom: {
                    enabled: false
                },
			  toolbar: {
                show: false
              }		
            },
			
			
			
			
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
				width: 2
            },
            
			yaxis: {
			  labels:{
				  show:false
			  }
          },
			
			
			grid: {
			  borderColor: '#eee',
			  strokeDashArray: 5,
			},
			
			
			
            
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        }
      },
      
    })
  </script>
  
  
  <script>
    new Vue({
      el: '#chart_03',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: "Session Duration",
            data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
          },
          {
            name: "Page Views",
            data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
          },
          {
            name: 'Total Visits',
            data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
          }
        ],
        chartOptions: {
          chart: {
            zoom: {
              enabled: false
            },
			  toolbar: {
                show: false
              }	
          },
			
			
			
			
			grid: {
			  borderColor: '#eee',
			  strokeDashArray: 5,
			},
			
			
			
          dataLabels: {
            enabled: false
          },
          stroke: {
            width: [2, 2, 2],
            curve: 'straight',
            dashArray: [0, 8, 5]
          },

          markers: {
            size: 0,
            hover: {
              sizeOffset: 6
            }
          },
          xaxis: {
            categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
              '10 Jan', '11 Jan', '12 Jan'
            ],
			  labels:{
				  show:false
			  }
          },
			
			yaxis:{
			labels:{
				  show:false
			  }	
			},
          tooltip: {
            y: [{
              title: {
                formatter: function (val) {
                  return val + " (mins)"
                }
              }
            }, {
              title: {
                formatter: function (val) {
                  return val + " per session"
                }
              }
            }, {
              title: {
                formatter: function (val) {
                  return val;
                }
              }
            }]
          },
          grid: {
            borderColor: '#f1f1f1',
          }
        }
      },

    })
  </script>
  
  
  
  <script>
    new Vue({
      el: '#chart_04',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          name: 'TEAM A',
          type: 'column',
          data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
        }, {
          name: 'TEAM B',
          type: 'area',
          data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
        }, {
          name: 'TEAM C',
          type: 'line',
          data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
        }],
        chartOptions: {
          chart: {
            stacked: false,
			  toolbar: {
                show: false
              }	
          },
          stroke: {
            width: [0, 2, 2],
            curve: 'smooth'
          },
          plotOptions: {
            bar: {
              columnWidth: '50%'
            }
          },

          fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
              inverseColors: false,
              shade: 'light',
              type: "vertical",
              opacityFrom: 0.85,
              opacityTo: 0.55,
              stops: [0, 100, 100, 100]
            }
          },
          labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
            '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
          ],
          markers: {
            size: 0
          },
          xaxis: {
            type: 'datetime'
          },
          yaxis: {
            min: 0,
			  labels:{
				  show:false
			  }
          },
          tooltip: {
            shared: true,
            intersect: false,
            y: {
              formatter: function (y) {
                if (typeof y !== "undefined") {
                  return y.toFixed(0) + " points";
                }
                return y;

              }
            }
          }
        }
      },

    })
  </script>


 <script>
    new Vue({
      el: '#chart_05',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [44, 55, 41, 17, 15],
        chartOptions: {
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
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
  
    <script>
    new Vue({
      el: '#chart_06',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [44, 55, 13, 43, 22],
        chartOptions: {
          labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
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
    <script>
    new Vue({
      el: '#chart_07',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [70],
        chartOptions: {
          plotOptions: {
            radialBar: {
              hollow: {
                size: '70%',
              }
            },
          },
          labels: ['Campaign']
        }
      },

    })
  </script>
  
  
  <script>
    new Vue({
      el: '#chart_08',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [44, 55, 67, 83],
        chartOptions: {
          plotOptions: {
            radialBar: {
              dataLabels: {
                name: {
                  fontSize: '22px',
                },
                value: {
                  fontSize: '16px',
                },
                total: {
                  show: true,
                  label: 'Total',
                  formatter: function (w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return 249
                  }
                }
              }
            }
          },
          labels: ['Campaign', 'Email', 'SMS', 'Phone'],
        }
      },

    })
  </script>
  
  
  
  
  <script>
    new Vue({
      el: '#chart_09',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [76],
        chartOptions: {
          plotOptions: {
            radialBar: {
              startAngle: -90,
              endAngle: 90,
              track: {
                background: "#e7e7e7",
                strokeWidth: '97%',
                margin: 5, // margin is in pixels
                shadow: {
                  enabled: true,
                  top: 2,
                  left: 0,
                  color: '#999',
                  opacity: 1,
                  blur: 2
                }
              },
              dataLabels: {
                name: {
                  show: false
                },
                value: {
                  offsetY: -5,
                  fontSize: '22px'
                }
              }
            }
          },
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'light',
              shadeIntensity: 0.4,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 53, 91]
            },
          },
          labels: ['Average Results'],
        }
      },

    })
  </script>
  
  
  
  
  <script>
    function generateDayWiseTimeSeries(baseval, count, yrange) {
      var i = 0;
      var series = [];
      while (i < count) {
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push([baseval, y]);
        baseval += 86400000;
        i++;
      }
      return series;
    }

    new Vue({
      el: '#chart_10',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: 'TEAM 1',
            data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
              min: 10,
              max: 60
            })
          },
          {
            name: 'TEAM 2',
            data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
              min: 10,
              max: 60
            })
          },
          {
            name: 'TEAM 3',
            data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 30, {
              min: 10,
              max: 60
            })
          },
          {
            name: 'TEAM 4',
            data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 10, {
              min: 10,
              max: 60
            })
          },
          {
            name: 'TEAM 5',
            data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 30, {
              min: 10,
              max: 60
            })
          },
        ],
        chartOptions: {
          chart: {

            zoom: {
              type: 'xy'
            },
			  
			  toolbar: {
                show: false
              }
			  
          },
			
			
			grid: {
			  borderColor: '#eee',
			  strokeDashArray: 5,
			},
			
			

          dataLabels: {
            enabled: false
          },
          
          xaxis: {
            type: 'datetime',

          },
          yaxis: {
            max: 70,
			  show:false
          }
        }
      },

    })
  </script>
  
  
  
  
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
  </script>

  <script>
    function generateData(count, yrange) {
      var i = 0;
      var series = [];
      while (i < count) {
        var x = 'w' + (i + 1).toString();
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push({
          x: x,
          y: y
        });
        i++;
      }
      return series;
    }

    new Vue({
      el: '#chart112',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: 'SUN',
            data: generateData(18, {
              min: 0,
              max: 90
            })
          },
          {
            name: 'MON',
            data: generateData(18, {
              min: 0,
              max: 90
            })
          },
          {
            name: 'TUE',
            data: generateData(18, {
              min: 0,
              max: 90
            })
          },
          {
            name: 'WED',
            data: generateData(18, {
              min: 0,
              max: 90
            })
          },
          {
            name: 'THU',
            data: generateData(18, {
              min: 0,
              max: 90
            })
          },
          {
            name: 'FRI',
            data: generateData(18, {
              min: 0,
              max: 90
            })
          },
          {
            name: 'SAT',
            data: generateData(18, {
              min: 0,
              max: 90
            })
          }
        ],
        chartOptions: {
          dataLabels: {
            enabled: false
          },
          colors: ["#008FFB"],

         
        }
      },

    })
  </script>
  
</body>
</html>