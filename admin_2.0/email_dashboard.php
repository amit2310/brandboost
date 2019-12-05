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
	
	.apexcharts-xaxis {	pointer-events: none;display: none;}
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
   	<h3 class="htxt_medium_24 dark_700">Email Dashboard</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/emailfilter.svg"/></button>
   		<button class="btn btn-md light_000 bkg_email_300 slidebox" >Create new <span style="opacity: 0.3"><img src="assets/images/blue-plus.svg"/></span></button>
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
    <!--<div class="row">
    	<div class="col-md-12">
    		<div class="card pr50 pl50 pt25 pb25">
     		<div class="row">
     			<div class="col-md-6">
     				<p class="htxt_medium_14 mb-0 dark_500"><i class=""><img src="assets/images/68_percent_circle.svg"></i>&nbsp; &nbsp; 68% SET UP</p>
     			</div>
     			<div class="col-md-6 text-right">
     			    <a class="float-right htxt_bold_14 blue_300" href="#">Continue setup <i><img src="assets/images/chevron-right.svg"/></i></a>
     			</div>
     		</div>
     		</div>
    	</div>
    </div>-->
    
    
    
    
    <div class="row">
     	<div class="col-md-8 d-flex">
     		<div class="card col">
     		<div class="row">
     		<div class="col-md-6">
     			<h3 class="htxt_medium_32 dark_700">79,3%</h3>
     			<p class="grey-sub-headings">YOUR EMAIL MARKETING IS GOOD</p>
     			<hr>
     			<p class="fsize14 mb30" style="color: #5a6f80;">Your recent emails have low avg. 9% bounce rate. We suggest you to send new email 
in next 3 days.</p>
    		<a class="fsize15 email_400" href="#"><img src="assets/images/emailedit.svg"/>&nbsp; Create new email</a>
     		</div>
     		<div class="col-md-6 text-center">
     			<img class="" style="max-height: 210px; " src="assets/images/email_dashboard_illustration.png"/>
     		</div>
     			
     		</div>
     			
     		</div>
     	</div>
     	<div class="col-md-4 d-flex">
     		<div class="card p0 text-center col">
     		<div class="p20 mb10">
     			<div id="credit_chart" style="max-height: 135px;">
					<apexchart type=radialBar height=200 :options="chartOptions3" :series="series" />
				  </div>
     			<p class="fsize14 mb0 mt10" style="color: #5a6f80;">You used 408/450 montly credits</p>
     		</div>
     			<div class="p15 btop">
     				<a class="fsize15 fw500 email_400 mt20" href="#">Purchase more credits</a>	
     			</div>
     			
     		</div>
     	</div>
     </div>
     
     
     
    
    
    
     
     
     <div class="row">
     	<div class="col-md-6 d-flex">
     		<div class="card min-h-280 p0 col">
     		<div class="p15 pl40 bbot">
     			<a class="fsize12 dark_200" href="#">EMAILS SENT</a>
     		</div>
     		<div class="p30 pl40 pb0">
     			<h3 class="htxt_medium_24 dark_700 mb10">51,913</h3>
     			<p class="fsize14"><span class="green_400">33,87%</span> &nbsp;  <span class="dark_400">last month</span></p>
     			<!--<img  src="assets/images/email_graph2.png"/>-->
     			
     			<div id="basiclinechart" style="margin-left: -20px">
    				<apexchart type=line height=240 :options="chartOptions2" :series="series" />
  				</div>
    		
    		
    		
     		</div>
     		</div>
     	</div>
     	<div class="col-md-6 d-flex">
     		<div class="card col pb0">
     			<h3 class="htxt_medium_32 dark_700">139</h3>
     			<p class="grey-sub-headings">Subscriptions</p>
     			<!--<img class="mt-5" src="assets/images/email_graph.png"/>-->
     			
     			
     			 <div id="chartSubscriptions" style="margin-left: -20px; margin-top: 50px;">
					<apexchart type=bar height=220 :options="chartOptions" :series="series" />
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
    var colors = ['#a3d6ee'];
    var colors2 = ['#59b3e1'];
    
    new Vue({
      el: '#chartSubscriptions',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30, 21, 22, 10, 28, 16, 21, 13, 30, 16, 21, 13, 30, 21]
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
			  borderColor: '#eee',
			  strokeDashArray: 2,
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
				 width: 2
            },
			
           
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.1
                },
				borderColor: '#eee',
			    strokeDashArray: 3
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

</body>
</html>