<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src = "https://code.highcharts.com/highcharts.js"></script>
		
<!-- /theme JS files -->
<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    .highcharts-yaxis-labels{display: none!important;}
    #canvas2{height: 200px!important; padding: 0 25px !important;}
    .highcharts-grid, .highcharts-axis-line {   display: none;}
    #myfirstchart{background: url(images/graphbkg.png) left top repeat!important;}
</style>
</head>

<?php 
error_reporting(0);
$positiveGraph = $neutralGraph = $negativeGraph = 0;
$totalPositive = $totalNegative = $totalNeutral = 0;
$allContact = 0;
$months = array();
$emailMonth = array();

if(!empty($bbEmailSendMonth)) {

    foreach ($bbEmailSendMonth as $data) {
        
        $month = substr($data->created, 0, 7);
        $emailMonth[$month][] = $data;
    }
}

$monthlyEmailSend = array();
if(!empty($emailMonth)) {
    foreach ($emailMonth as $key => $value) {
        $monthlyEmailSend[$key] = count($value);
    }
}


if(!empty($aBrandbosts)) {

    foreach ($aBrandbosts as $data) {

        //pre($data);
        $reviewResponse = $this->mBrandboost->getReviewRequestResponse($data->id);
        $newPositive = $newNegative = $newNeutral = 0;
        
        foreach ($reviewResponse as $reviewData) {


            //$month = date('m', strtotime($reviewData->reviewdate));
            $date = $reviewData->reviewdate;


            $month = substr($date, 0, 7);
            $months[$month][] = $date;
            
            
            if ($reviewData->ratings != '') {
                if ($reviewData->ratings >= 4) {
                    if(strtotime($reviewData->reviewdate)>$recent){
                        $newPositive++;
                    }
                    $positiveRating++;
                } else if ($reviewData->ratings == 3) {
                    if(strtotime($reviewData->reviewdate)>$recent){
                        $newNeutral++;
                    }
                    $neturalRating++;
                } else {
                    if(strtotime($reviewData->reviewdate)>$recent){
                        $newNegative++;
                    }
                    $negativeRating++;
                }
            }
        }

        $totalPositive = $totalPositive + $newPositive;
        $totalNeutral = $totalNeutral + $newNeutral;
        $totalNegative = $totalNegative + $newNegative;

        $gTotal = $totalPositive+$totalNeutral+$totalNegative;
        
        if($gTotal > 0) {
            $positiveGraph = ceil($totalPositive * 100 / $gTotal);
            $neutralGraph = ceil($totalNeutral * 100 / $gTotal);
            $negativeGraph = ceil($totalNegative * 100 / $gTotal);
        }



        $allSubscribers = $this->rLists->getAllSubscribersList($data->id);
        if (!empty($allSubscribers)) {
            $newContacts = 0;
            foreach ($allSubscribers as $oSubs) {
                if(strtotime($oSubs->created)> $recent){
                    $newContacts++;
                }
            }
            $allContact = $allContact + $newContacts;
        }
        
    }

}

$monthlyReview = array();
foreach ($months as $key => $value) {
    $monthlyReview[$key] = count($value);
}
$monthlyReview = array_reverse($monthlyReview);


?>

<!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->	
	    <div class="row">
		  <div class="col-md-8 ">
			<div class="panel panel-flat">
                <div class="panel-heading">
                <h6 class="panel-title">Reviews</h6>
              </div>
              <div class="panel-body p0 bkg_white">
               <div class="p20 bbot">
                <p class="txt_grey fw300 m0"><i class="fa fa-square txt_purple"></i>  &nbsp; Reviews  &nbsp; &nbsp; <strong class="txt_dark">
                <?php 
                if(!empty($monthlyReview)) {
                    echo number_format(array_sum($monthlyReview));
                }
                else {
                    echo '0';
                } ?></strong></p>
               </div>
                <div class="p20" style="background: #fcfdfe!important; border-radius: 0 0 6px 6px">
                      <div id="myfirstchart" style="height: 190px;"></div>
                    </div>
              </div>
			</div>
			
            <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Month Activity</h6>
              </div>
              <div class="panel-body bkg_white">
              <div class="row">
                <div class="col-md-4 pr50 pl30 brig">
                     <ul class="onsite_list">
                        <li class="bnone"><span class="txt_dark"><img width="12" src="<?php echo base_url(); ?>assets/images/purple_user.png"> Requests Sent</span><strong><?php echo number_format($bbEmailSend+$bbSmsSend); ?></strong></li>
                        <li><span><img width="14" src="<?php echo base_url(); ?>assets/images/purple_env.png"> Email Sent</span><strong><?php echo number_format($bbEmailSend); ?></strong></li>
                        <li><span><img width="14" src="<?php echo base_url(); ?>assets/images/purple_phone.png"> SMS Sent</span><strong><?php echo number_format($bbSmsSend); ?></strong></li>
                      </ul>
                </div>
                <div class="col-md-8 pl30"><div id="linechart_a" style="min-width: 300px; height: 170px;"></div></div>
              </div>
               
              </div>
            </div>
		  </div>
		  
		  <div class="col-md-4">
		  

          <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Campaigns</h6>
              </div>
              <div class="panel-body p20 bkg_white pb-5" style="padding-bottom: 5px!important;">
              <div class="p10">
                <div id="donut_chartbb" style="max-width: 100%; height: 200px; margin: 0 auto; "></div>
            </div>
            <div class="clearfix"></div>
          
          <ul class="onsite_list">
            <li><span class="txt_dark"><img width="12" src="<?php echo base_url(); ?>assets/images/smiley_icon_green.png"> Positive</span><strong><?php echo number_format($totalPositive); ?></strong></li>
            <li><span><img width="12" src="<?php echo base_url(); ?>assets/images/smiley_icon_yellow.png"> Neutral</span><strong><?php echo number_format($totalNeutral); ?></strong></li>
            <li><span><img width="12" src="<?php echo base_url(); ?>assets/images/smiley_icon_red.png"> Negative</span><strong><?php echo number_format($totalNegative); ?></strong></li>
          </ul>
              
               </div>
          </div>
		  
		  
		  <div class="panel panel-flat">
			  <div class="panel-heading">
				<h6 class="panel-title">Contacts</h6>
			  </div>
			  <div class="panel-body p20 db_stats bkg_white">
				<div class="row">
					<div class="col-xs-2"><img class="pull-left" src="/assets/images/onsite_user_icon.png"></div>
					<div class="col-xs-6"><h1><?php echo number_format($allContact); ?></h1><p><strong class="txt_green"><i class=""><img src="/assets/images/green_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
					<div class="col-xs-4 text-right"><img src="/assets/images/onsite_graph_small.png"></div>
				</div>
			  </div>
			</div>
			
		  </div>
	  </div>

    <script>
    // top navigation fixed on scroll and side bar collasped
        $( window ).scroll( function () {
            var sc = $( window ).scrollTop();
            if ( sc > 100 ) {
                $( "#header-sroll" ).addClass( "small-header" );
            } else {
                $( "#header-sroll" ).removeClass( "small-header" );
            }
        } );

        function smallMenu() {
            if ( $( window ).width() < 1600 ) {
                $( 'body' ).addClass( 'sidebar-xs' );
            } else {
                $( 'body' ).removeClass( 'sidebar-xs' );
            }
        }

        function formatDate(date) {
            var monthNames = [
                "Jan", "Feb", "Mar",
                "Apr", "May", "Jun", "Jul",
                "Aug", "Sep", "Oct",
                "Nov", "Dec"
              ];

            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();

            return monthNames[monthIndex] + ' ' + year;
        }

        $( document ).ready( function () {
            smallMenu();

            window.onresize = function () {
                smallMenu();
            };
        } );

        
        var reviewList = <?php echo json_encode($monthlyReview) ?>;// don't use quotes
        var reviewArr = new Array();
        $.each(reviewList, function(key, value) {
           var rev = {};
           rev.y = formatDate(new Date(key));
           rev.a = value;
           reviewArr.push(rev);
        });

        var emailsendList = <?php echo json_encode($monthlyEmailSend) ?>;// don't use quotes
        var emailSendArr = new Array();
        $.each(emailsendList, function(key, value) {
           var rev = [];
           rev.push(formatDate(new Date(key)));
           rev.push(value);
           emailSendArr.unshift(rev);
        });

   
        
Highcharts.chart('linechart_a', {
    chart: {
        type: 'column',
        backgroundColor:'rgba(0, 0, 0, 0)',
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
    xAxis: {
        type: 'category',
        labels: {
           
            style: {
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif',
                
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: null
        }
    },
    legend: {
        enabled: false
    },
    
    plotOptions: {
        column: {
            pointPadding: 0.20,
            borderWidth: 0,
            borderRadius: 5
        }
    },
    
    colors: ['#9b83ff', '#cae4d1'],
    tooltip: {
        pointFormat: '<b>{point.y}</b>'
    },
    series: [{
    showInLegend: false,  
        name: 'Time',
        data: emailSendArr,
       
    }]
}); 
    

    
    
    
    
    
    
    
    

Highcharts.chart('donut_chartbb', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: null
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    
    colors: ['#74d4a6', '#ffd074', '#df6783'],
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Positive',
            y: <?php echo $positiveGraph; ?>,
           
           
        }, {
            name: 'Neutral',
            y: <?php echo $neutralGraph; ?>
        }, {
            name: 'Negative',
            y: <?php echo $negativeGraph; ?>
        }]
    }]
});
    

    
    
    Morris.Area({
    element: 'myfirstchart',
        parseTime : false,
    
        data: reviewArr,
        
        
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Total'],
      pointSize: 0,
      lineWidth: 2,
      padding: 0,
      fillOpacity: 0.3,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors: ['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors: ['#7f62df ', '#0c265a'],
        
        

        
  });

    
</script>



<!-- <script>
	

Highcharts.chart('linechart_a', {
    chart: {
        type: 'column',
		backgroundColor:'rgba(0, 0, 0, 0)',
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
    xAxis: {
        type: 'category',
        labels: {
           
            style: {
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif',
				
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: null
        }
    },
    legend: {
        enabled: false
    },
	
	plotOptions: {
        column: {
            pointPadding: 0.20,
            borderWidth: 0,
			borderRadius: 5
        }
    },
	
	colors: ['#9b83ff', '#cae4d1'],
    tooltip: {
        pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
	showInLegend: false,  
        name: 'Time',
        data: [
            ['1', 14.2],
            ['2', 3.8],
            ['3', 2.9],
            ['4', 16.7],
            ['5', 9.1],
            ['6', 18.7],
            ['7', 15.4],
			['8', 14.2],
            ['12', 3.8],
            ['13', 2.9],
            ['14', 16.7],
            ['15', 9.1],
            ['11', 18.7],
            ['17', 15.4],
			['18', 14.2],
            ['19', 3.8],
            ['20', 2.9],
            ['21', 16.7],
            ['22', 9.1],
            ['23', 18.7],
            ['24', 15.4],
			['24', 14.2],
            ['26', 3.8],
            ['27', 2.9],
            ['28', 16.7],
            ['29', 9.1],
            ['30', 18.7],
            ['31', 15.4]
        ],
       
    }]
});	
	

	
	
	
	
	Highcharts.chart('linehighchart', {
    chart: {
        type: 'area'
    },
    title: {
        text:null
    },
    subtitle: {
        text: null
    },
    xAxis: {
        categories:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'july', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        allowDecimals: false,
        /*labels: {
            formatter: function () {
                return this.value +' Month'; // clean, unformatted number for year
            }
        },*/
        title: {
            text:'Number Of Month'
        }
    },
    yAxis: {
        title: {
            text:null
        },
        labels: {
            formatter: function () {
                return this.value ;
            }
        },
        title: {
            text:'Number Of Reviews'
        }
    },
    tooltip: {
        pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
    },
    plotOptions: {
        area: {
            pointStart: 1,
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
	colors: ['#9b83ff', '#cae4d1'],
    series: [{
	showInLegend: false,  
        name: 'USA',
        data: [<?php echo implode(',', $monthlyReview); ?>]
    }]
});
	
	
	
	
	
	

Highcharts.chart('donut_chartbb', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: null
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
	
	colors: ['#74d4a6', '#ffd074', '#df6783'],
    series: [{
        name: 'Reviews',
        colorByPoint: true,
        data: [{
            name: 'Positive',
            y: <?php echo $positiveGraph; ?>,
           
           
        }, {
            name: 'Neutral',
            y: <?php echo $neutralGraph; ?>
        }, {
            name: 'Negative',
            y: <?php echo $negativeGraph; ?>
        }]
    }]
});
	
	

	
</script> -->