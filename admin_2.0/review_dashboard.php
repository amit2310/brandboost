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
	.ratingbox{background: #fff9ea;  max-width: 200px; margin: auto;  height: 45px; line-height: 41px; border-radius: 50px;}
	.ratingbox ul{margin: 0; padding: 0}
	.ratingbox ul li{margin: 0 3px;; padding: 0; display: inline-block; list-style: none}
	
	
	#OffSiteReviews .apexcharts-graphical {	transform:translate(0, 0)!important;}
	</style>

</head>
<body id="ReviewSection">

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
   	<h3 class="htxt_medium_24 dark_700">Reviews</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/filter_review.svg"/></button>
   		<button class="btn btn-md light_000 bkg_reviews_300 slidebox" >Create Request <span><img src="assets/images/review_plus.svg"/></span></button>
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
    		<div class="card p30 pl40 pr50 user_profile">
    		<div class="row">
    		<div class="col-md-6 brig">
    		<div class="media_left">
    			<div class="profile_icon bkg_green_300 mr15">
    				<img src="assets/images/review_smiley.svg">
    			</div>
    		</div>
    			
    			
    			<div class="media_left">
    			<div class="">
    			<h3 class="htxt_medium_32 dark_700 mb-2 mt-0">79,3%</h3>
    			<p class="fsize12 dark_200 text-uppercase mb0 fw500">YOUR ONLINE REPUTATION IS GOOD &nbsp;<span class="green_400">+5%</span></p>
    			</div>
    		</div>
    			
    			</div>
    			
    			<div class="col-md-6">
    			<div class="media_left mt-1 ml-5">
    				<img src="assets/images/lightbulb-fill-24.svg"/>
    			</div>
    			<div class="media_left">
    				<p class="fsize14 dark_400 mb-0">
    				Your recent emails have low avg. 9% bounce<br>
					 rate. We suggest you to send new email <br>
					in next 3 days.
    			</p>
    			</div>
    			
    			</div>
    			
    			
    			
    			</div>
    		</div>
    	</div>
    </div>
     
     
     <div class="row">
    	<div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col">
				<div class="p15 pt15 bbot text-center">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">OVERALL RATING</a></li>
					</ul>
				</div>
				<div class="p30 text-center mt-1">
					<h3 class="htxt_regular_28 dark_700 mb-1">4.5</h3>
					<p class="mb-4"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
					
					<div class="ratingbox">
					<ul>
						<li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
						<li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
						<li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
						<li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
						<li><a href="#"><img src="assets/images/star-half-fill-24.svg"/></a></li>
					</ul>
						
					</div>
				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col">
				<div class="p15 pt15 bbot text-center">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">Review requests</a></li>
					</ul>
				</div>
				<div class="p30 text-center">
					<h3 class="htxt_regular_28 dark_700 mt-0 mb-1">128</h3>
					<p class="m-0 mb-3"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"/></i>33,87%</span>last week</p>
					<div style="min-height: 40px; margin: 40px 0 0;" class="img_box">
   					<div id="Reviewrequests" class=""></div>
   				</div>
				</div>
    		</div>
    	</div>
    	
    	<div class="col-md-4 d-flex">
    		<div class="card p0 animate_top col">
				<div class="p15 pt15 bbot text-center">
					<ul class="workflow_list">
						<li><a class="text-uppercase fw500 dark_600" href="#">MONTHLY GOAL</a></li>
					</ul>
				</div>
				<div class="p30 text-center mt-1">
					<div class="circle-icon-56 m-auto"><img src="assets/images/review_goal.svg"></div>
					<h3 class="htxt_regular_28 dark_700 mt-4 mb-1">32 <span class="dark_200">/ 50</span></h3>
					<p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
				</div>
    		</div>
    	</div>
    </div>
     
    
    
    
     
     
     <div class="row">
     	<div class="col-md-6 d-flex">
     		<div class="card p0 col">
     		<div class="p15 pl30 bbot">
     			<a class="fsize12 dark_200 fw500" href="#">REVIEWS</a>
     		</div>
     		<div class="p30 pl40 pb0">
     			<h3 class="htxt_regular_28 dark_700 mb10">31</h3>
     			<p class="fsize14 mb-0"><span class="green_400">33,87%</span> &nbsp;  <span class="dark_400"> / week</span></p>
     			<div id="basiclinechart" style="margin-left: -25px">
    				<apexchart type=line height=160 :options="chartOptions2" :series="series" />
  				</div>
    		
     		</div>
     		</div>
     	</div>
     	<div class="col-md-6 d-flex">
     		<div class="card p0 col">
     		<div class="p15 pl30 bbot">
     			<a class="fsize12 dark_200 fw500" href="#">OFF SITE REVIEWS</a>
     		</div>
     		<div class="p30 pl40 pb0">
     			<h3 class="htxt_regular_28 dark_700 mb10">19</h3>
     			<p class="fsize14"><span class="green_400">33,87%</span> &nbsp;  <span class="dark_400">  last month</span></p>
     			
     			<div class="clearfix"></div>
     			<img style="max-width: 100%" src="assets/images/social_graph.png"/>
     			<!--<div id="OffSiteReviews">
				<apexchart type=bar height=160 :options="chartOptions" :series="series" />
			  </div>-->
   		
   		
    		
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
	$(".nav-link.review").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.review").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
</script>




  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>

  <script>
    var colors = ['#73ABFF'];
    var colors2 = ['#73ABFF'];
    
    
	
	

    new Vue({
      el: '#basiclinechart',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
            name: "Desktops",
            data: [4, 3, 4, 6, 3, 4, 7, 2, 3, 5, 3, 7, 8, 4, 4, 3, 5, 7, 3, 5, 3, 7, 8, 4 ]
        }],
        chartOptions2: {
          chart: {
                height: 250,
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
				borderColor: '#ddd',
			    strokeDashArray: 2
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
				labels: {
				  style: {
					colors: colors2,
					fontSize: '14px',
					fill: '#cccccc'
				  },
				  show: true
            }
            },
			
			
			yaxis: {
				
			labels: {
              style: {
                colors: '#cccccc',
                fontSize: '13px',
				fill: '#cccccc' 
              },
				show: true
            }
            },
			
			
			
			
        }
      },
      
    })
  </script>
  
  
  <script>
	
	
	
	
		/***************
		COLUMN BAR CHARTS
		************/
		
       var options7 = {
      chart: {
        type: 'bar',
        width: 300,
        height: 55,
        sparkline: {
          enabled: true
        }
      },
		colors: ['#9AA1F9'],
		   
		   
  

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

    new ApexCharts(document.querySelector("#Reviewrequests"), options7).render();
   
  </script>
  
  
  
  
   <script>
	   
	   var colors22 = ['#73ABFF', '#333333'];
	   
	   
    new Vue({
      el: '#OffSiteReviews',
      components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          data: [690, 1100, 1200, 1380]
        }],
        chartOptions: {
          plotOptions: {
				bar: {
					endingShape: 'rounded',
					horizontal: true,
					columnWidth: '10%'
				}
      			},
			
			colors: colors22,
			
			
          dataLabels: {
            enabled: false
          },
			
			grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.1
                },
				borderColor: '#ddd',
			    strokeDashArray: 2
            },
			
			
          xaxis: {
            categories: ['G', 'F', 'Y', 'T'
            ],
          }
        }
      }
    })
  </script>

</body>
</html>