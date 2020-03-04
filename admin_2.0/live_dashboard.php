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
   	<div class="col-md-3">
   	<span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">Live Messenger</h3>
   	</div>
   	
   	<div class="col-md-9 col-9 text-right">
   		<button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
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
    		<div class="card p0">
     		<div class="p20 bbot">
     			<p class="htxt_medium_12 mb-0 dark_200">FINISH SETTING UP</p>
     		</div>
     		
     		<div class="p0">
     			<div class="row">
     				<div class="col-md-4 brig">
     					<div class="p25 mt20">
     						<ul class="list1">
     							<li><a class="done" href="#">Install Live Chat Widget</a></li>
     							<li><a class="done" href="#">Set Offline Hours</a></li>
     							<li><a class="active" href="#">Invite Operators</a></li>
     							<li><a href="#">Set Up Auto Message</a></li>
     							<li><a href="#">Connect Channels </a></li>
     						</ul>
     					</div>
     				</div>
     				<div class="col-md-8">
     					<div class="p25 pb0">
     						<div class="row">
     							<div class="col-md-6">
     								<h3 class="htxt_bold_18 dark_800 mt30">Invite Teammates</h3>
     								<p class="htxt_regular_14 dark_400 mt25 mb25 lh_20">Eu minim velit cupidatat voluptate mollit sunt consectetur occaecat. Sunt ad ullamco nostrud occaecat.</p>
     								<button class="btn btn-sm bkg_chat_400 light_000 pr20">Invite</button>
     								<a class="blue_300 fsize14 fw400 ml20" href="#">or skip for now</a>
     							</div>
     							<div class="col-md-6 text-center">
     								<img style="max-width: 272px;" src="assets/images/messanger_image.svg">
     							</div>
     						</div>
     					</div>
     				</div>
     			</div>
     		</div>
     		</div>
    	</div>
    </div>
    
    
    
    <div class="row">
     	<div class="col-md-6 d-flex">
     		<div class="card col pb0">
     			<h3 class="htxt_medium_32 dark_700">51,913</h3>
     			<p class="grey-sub-headings mb0">Emails</p>
     			
     			
     			<div id="chart_realtime" style="margin-left: -20px">
					<apexchart ref="realtimeChart" type=line height=220 :options="chartOptions2" :series="series" />
				  </div>
    		
    		
     		</div>
     	</div>
     	<div class="col-md-6 d-flex">
     		<div class="card col pb0 ">
     			<h3 class="htxt_medium_32 dark_700">139</h3>
     			<p class="grey-sub-headings mb0">Subscriptions</p>
     			
     			
     			<div id="chartSubscriptions" style="margin-left: -20px">
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




<script>	
//	$(document.body).addClass('enlarge-menu');
//	$(".button-menu-mobile_sidebar").click(function(){
//	  $("body").toggleClass("enlarge-menu");
//	  //$(".menu-title").text("Hello world!");
//	});
</script>




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
  
  
  
  
  


</body>
</html>