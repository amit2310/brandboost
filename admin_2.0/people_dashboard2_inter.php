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
<link href="assets/css/style_inter.css" rel="stylesheet" type="text/css">
<link href="assets/css/styleguide.css" rel="stylesheet" type="text/css">


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
   	<h3 class="htxt_medium_24 dark_700">People</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000">Create new <span><img src="assets/images/blue-plus.svg"/></span></button>
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
    </div>
    
    
    
    
    
    
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
    		<a class="fsize15 blue_300" href="#"><img src="assets/images/editpen.svg"/>&nbsp; Create new email</a>
     		</div>
     		<div class="col-md-6 text-center">
     			<img class="mt40" style="max-width: 225px; " src="assets/images/dashboard_image_01.png"/>
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
     				<a class="fsize15 fw500 blue_300 mt20" href="#">Purchase more credits</a>	
     			</div>
     			
     		</div>
     	</div>
     </div>
     
     <div class="row">
     	<div class="col-md-6 d-flex">
     		<div class="card col pb0">
     			<h3 class="htxt_medium_32 dark_700">51,913</h3>
     			<p class="grey-sub-headings mb0">Emails</p>
     			<!--<img style="max-height: 130px;" src="assets/images/dashboard_graph2.png"/>-->
     			
     			<div id="chart_realtime" style="margin-left: -20px">
					<apexchart ref="realtimeChart" type=line height=220 :options="chartOptions2" :series="series" />
				  </div>
    		
    		
     		</div>
     	</div>
     	<div class="col-md-6 d-flex">
     		<div class="card col pb0 ">
     			<h3 class="htxt_medium_32 dark_700">139</h3>
     			<p class="grey-sub-headings mb0">Subscriptions</p>
     			<!--<img style="max-height: 130px;" src="assets/images/dashboard_graph1.png"/>-->
     			
     			<div id="chartSubscriptions" style="margin-left: -20px">
					<apexchart type=bar height=220 :options="chartOptions" :series="series" />
				  </div>
				  
				  
     		</div>
     	</div>
     </div>
     
     
     
   <!--  <div class="row">
     	<div class="col-md-6">
     		<div class="card pb0">
     			<h3 class="htxt_medium_32 dark_700">51,913</h3>
     			<p class="grey-sub-headings mb0">Emails</p>
     			<div id="chart_column" style="margin-left: -20px">
					<apexchart type=bar height=350 :options="chartOptions" :series="series" />
				  </div>
     		</div>
     	</div>
     	
     </div>
     -->
     		
     		

    
    
    
     
     
      </div>
      
      </div>
      
<!--******************
  Content Area End
 **********************-->
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






  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>

  <script>
    var colors = ['#ebeef6'];
    
    
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
			  borderColor: '#eee',
			  strokeDashArray: 5,
			},
			
          colors: colors,
          plotOptions: {
            bar: {
              columnWidth: '60%',
              distributed: true,
				endingShape: 'rounded'
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
	
	

  </script>





<script>
	var colors2 = ['#72abff'];
    var lastDate = 0;
    var data = []

    function getDayWiseTimeSeries(baseval, count, yrange) {
      var i = 0;
      while (i < count) {
        var x = baseval;
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        data.push({
          x,
          y
        });
        lastDate = baseval
        baseval += 86400000;
        i++;
      }
    }

    getDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 10, {
      min: 10,
      max: 90
    })

    function getNewSeries(baseval, yrange) {
      var newDate = baseval + 86400000;
      lastDate = newDate
      data.push({
        x: newDate,
        y: Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
      })
    }

    function resetData() {
      data = data.slice(data.length - 10, data.length);
    }

    new Vue({
      el: '#chart_realtime',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          data: data.slice()
        }],
        chartOptions2: {
          chart: {
            animations: {
              enabled: true,
              easing: 'linear',
              dynamicAnimation: {
                speed: 1000
              }
            },
            toolbar: {
              show: false
            },
            zoom: {
              enabled: false
            },
			  
          },
          dataLabels: {
            enabled: false
          },
			
			colors: colors2,
			
			grid: {
			  borderColor: '#eee',
			  strokeDashArray: 9,
			},
          
			
			stroke: {
                curve: 'smooth',
				 width: 3.5
            },

         
          markers: {
            size: 0
          },
          xaxis: {
            type: 'datetime',
            range: 777600000,
			  labels: {
				 show: false
            }
          },
          yaxis: {
            max: 100,
			  labels: {
				 show: false
            }
          },
          legend: {
            show: false
          }
        }
      },
      mounted: function () {
        this.intervals()
      },
	  
      methods: {
        intervals: function () {
          var me = this
          window.setInterval(function () {
            getNewSeries(lastDate, {
              min: 10,
              max: 90
            })
            
            me.$refs.realtimeChart.updateSeries([{
              data: data
            }])
          }, 1000)

          // every 60 seconds, we reset the data to prevent memory leaks
          window.setInterval(function () {
            resetData()
            me.$refs.realtimeChart.updateSeries([{
              data
            }], false, true)
          }, 60000)
        }
      }
    })
  </script>
  
  
  
  
  <script>
	  
//	  var colors3 = ['#4f8af4'];
//    new Vue({
//      el: '#chart_column',
//      components: {
//        apexchart: VueApexCharts,
//      },
//      data: {
//        series: [{
//          name: 'Inflation',
//          data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
//        }],
//        chartOptions: {
//          chart: {
//            height: 350,
//            type: 'bar',
//          },
//          plotOptions: {
//            bar: {
//              dataLabels: {
//                position: 'top', // top, center, bottom
//              },
//            }
//          },
//          dataLabels: {
//            enabled: true,
//            formatter: function (val) {
//              return val + "%";
//            },
//            offsetY: -20,
//            style: {
//              fontSize: '12px',
//              colors: ["#304758"]
//            }
//          },
//			
//			grid: {
//			  borderColor: '#eee',
//			  strokeDashArray: 5,
//			},
//			
//			colors: colors3,
//
//          xaxis: {
//            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
//            position: 'top',
//            labels: {
//              offsetY: -18,
//
//            },
//            axisBorder: {
//              show: false
//            },
//            axisTicks: {
//              show: false
//            },
//            crosshairs: {
//              fill: {
//                type: 'gradient',
//                gradient: {
//                  colorFrom: '#D8E3F0',
//                  colorTo: '#BED1E6',
//                  stops: [0, 100],
//                  opacityFrom: 0.4,
//                  opacityTo: 0.5,
//                }
//              }
//            },
//            tooltip: {
//              enabled: true,
//              offsetY: -35,
//
//            }
//          },
//			
//          fill: {
//            gradient: {
//              shade: 'light',
//              type: "horizontal",
//              shadeIntensity: 0.25,
//              gradientToColors: undefined,
//              inverseColors: true,
//              opacityFrom: 1,
//              opacityTo: 1,
//              stops: [50, 0, 100, 100]
//            },
//          },
//          yaxis: {
//            axisBorder: {
//              show: false
//            },
//            axisTicks: {
//              show: false,
//            },
//            labels: {
//              show: false,
//              formatter: function (val) {
//                return val + "%";
//              }
//            }
//
//          }
//        }
//      }
//    })
  </script>
  
  
  <script>
	  var colors4 = ['#9cc2ff'];
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