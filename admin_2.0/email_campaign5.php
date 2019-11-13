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
	.card{overflow: hidden}
	#chart3 .apexcharts-legend {visibility:visible;	display: block;	top: 60px!important;}
	.apexcharts-xaxis, .apexcharts-xaxis-tick{display: none;}
	.apexcharts-gridlines-horizontal, .apexcharts-gridRow{display: none;}
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
    	<div class="col-md-3 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">Email OPENS</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">1,468</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 30px 0 0;" class="img_box">
   					<div id="chart1" class=""></div>
   				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">OPEN RATE</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">75,3%</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 20px 0 10px;" class="img_box">
   					<div id="chart2"></div>
   				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">CLICK RATE</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">56,4%</h3>
   				<p class="fsize14 fw400 dark_200 mb0"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 50px 0 0; " class="img_box">
   					<div id="chart3"></div>
   				</div>
    		</div>
    	</div>
    	
    	
    </div>
    <div class="row">
    	<div class="col-md-3 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">Email OPENS</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">1,468</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 0px 0 0;" class="img_box">
   					<div id="spark1" class=""></div>
   				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">OPEN RATE</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">75,3%</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 0px 0 0px;" class="img_box">
   					<div id="spark2"></div>
   				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-3 d-flex">
    		<div class="card p0 pt0 pb0 text-center animate_top col">
						<div class="p15 pt15 bbot">
							<ul class="workflow_list">
								<li><a class="text-uppercase fw500 dark_200" href="#">CLICK RATE</a></li>
							</ul>
						</div>
				
   				<h3 class="htxt_bold_24 dark_700 mb-2 mt-4">56,4%</h3>
   				<p class="fsize14 fw400 dark_200"><span class="green_400"><img src="assets/images/green_arrow_up.svg"/> 33,87%</span> &nbsp; last week</p>
   				<div style="min-height: 40px; margin: 0px 0 0; " class="img_box">
   					<div id="spark3"></div>
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


<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
<script>
        var options1 = {
            chart: {
                height: 250,
				width: 440,
                type: 'area',
				toolbar: {
          			show: false
					}
            },
			
			colors:['#67bae4', '#62C08E', '#dbe4f3'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'Email',
                data: [31, 40, 28, 51, 42, 109, 100]
            }, {
                name: 'SMS',
                data: [11, 32, 45, 32, 34, 52, 41]
            }],

            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"], 
				labels: {
					show: false
					}
            },
			
						
			yaxis: {
				labels: {
					show: false
					}
			},
			
			
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart1"),
            options1
        );

        chart.render();
	
	
	
	
	
	var options2 = {
      chart: {
        height: 250,
        type: 'line',
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
        curve: 'straight'
      },
      series: [{
        name: "Campaign",
        data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
      }],
//      title: {
//        text: 'Product Trends by Month',
//        align: 'left'
//      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
		  labels: {
					show: false
					}
      },
		yaxis: {
				labels: {
					show: false
					}
			},
    }

    var chart = new ApexCharts(
      document.querySelector("#chart2"),
      options2
    );

    chart.render();
	
	
	
	
	 var options3 = {
            chart: {
                type: 'donut',
				width: 350
            },
            series: [44, 55, 41, 17, 15],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom',
						
                    }
                }
            }]
        }

       var chart = new ApexCharts(
            document.querySelector("#chart3"),
            options3
        );
        
        chart.render();
	
	
	
	
	
	
	
	
	 window.Apex = {
      stroke: {
        width: 3
      },
      markers: {
        size: 0
      },
      tooltip: {
        fixed: {
          enabled: true,
        }
      }
    };
    
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

    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

    var spark1 = {
      chart: {
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'straight'
      },
      fill: {
        opacity: 0.3,
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
      yaxis: {
        min: 0
      }
    }

    var spark2 = {
      chart: {
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'straight'
      },
      fill: {
        opacity: 0.3,
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
      yaxis: {
        min: 0
      },
      colors: ['#62C08E']
    }

    var spark3 = {
      chart: {
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
		colors: ['#f63434'],
      stroke: {
        curve: 'straight'
      },
      fill: {
        opacity: 0.3
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

    var spark1 = new ApexCharts(document.querySelector("#spark1"), spark1);
    spark1.render();
    var spark2 = new ApexCharts(document.querySelector("#spark2"), spark2);
    spark2.render();
    var spark3 = new ApexCharts(document.querySelector("#spark3"), spark3);
    spark3.render();
    </script>
</body>
</html>