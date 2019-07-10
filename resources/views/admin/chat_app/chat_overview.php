
	<link href="<?php echo base_url(); ?>assets/css/percircle.css" rel="stylesheet" type="text/css">
	<script src = "<?php echo base_url(); ?>assets/js/percircle.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src = "https://code.highcharts.com/highcharts.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.mapael.js" charset="utf-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/world_countries.js" charset="utf-8"></script>
    
	<style>
		.outer_circle{padding: 14px; background: #fff; border: 1.5px solid #eee; margin: 0 auto!important; border-radius: 100%; width: 200px; height: 200px;}
		#bluecircle{margin: 0 auto!important; float: none!important; cursor: pointer; }
		path[stroke-width="0.5"]{   stroke: #eeeeee!important;  opacity: 0; }
		#myfirstchart{background: url(images/graphbkg.png) left top repeat!important;}
		.min_h310{min-height: 300px;}
		
		.highcharts-tick{stroke:none!important}
		.highcharts-credits{display: none!important;}
		.highcharts-container, .highcharts-container svg {width: 100% !important;}
		.highcharts-yaxis-labels{display: none!important;}
		#canvas2{height: 200px!important; padding: 0 25px !important;}
		.highcharts-grid {display: none;}
		
		
		.mapael .mapTooltip{position: absolute;background-color: #1e70d8;opacity: 0.70;border-radius: 5px;padding: 10px;z-index: 1000;max-width: 200px;display: none;color: #fff;top: 20px!important;}
		.mapael .map{margin-top:0px;}
		.plotLegend {	position: absolute;	top: -50px;	right: 10px;	padding: 0 10px;}
		circle{opacity: 0.8}
		
		
		.pie, .c100 .bar, .c100.p51 .fill, .c100.p52 .fill, .c100.p53 .fill, .c100.p54 .fill, .c100.p55 .fill, .c100.p56 .fill, .c100.p57 .fill, .c100.p58 .fill, .c100.p59 .fill, .c100.p60 .fill, .c100.p61 .fill, .c100.p62 .fill, .c100.p63 .fill, .c100.p64 .fill, .c100.p65 .fill, .c100.p66 .fill, .c100.p67 .fill, .c100.p68 .fill, .c100.p69 .fill, .c100.p70 .fill, .c100.p71 .fill, .c100.p72 .fill, .c100.p73 .fill, .c100.p74 .fill, .c100.p75 .fill, .c100.p76 .fill, .c100.p77 .fill, .c100.p78 .fill, .c100.p79 .fill, .c100.p80 .fill, .c100.p81 .fill, .c100.p82 .fill, .c100.p83 .fill, .c100.p84 .fill, .c100.p85 .fill, .c100.p86 .fill, .c100.p87 .fill, .c100.p88 .fill, .c100.p89 .fill, .c100.p90 .fill, .c100.p91 .fill, .c100.p92 .fill, .c100.p93 .fill, .c100.p94 .fill, .c100.p95 .fill, .c100.p96 .fill, .c100.p97 .fill, .c100.p98 .fill, .c100.p99 .fill, .c100.p100 .fill {border: 0.08em solid #5a99f6;}
		.c100:hover > span {color: #5a99f6;}
	</style>
	
	
		<?php 
		
		//pre($supportChat);
		//pre($supportChatGroupByDate);
		//pre($supportChat);

		/*------- daily status report -------*/

		$showData = json_encode($lastfifteendayschat);
		
		
		/*------ chat completed time --------*/
		$inc = 0;
		$timeDiffTotal = 0;
		$averageTimeDiff = 0;
		$showCompleteTime = 'N/A';
		foreach ($supportChatCompleted as $key => $value) {
			$created = $value->created;
			$completed_time = $value->completed_time;
			if(strtotime($completed_time) > 0) {
				$inc++;
				$datetime1 = date_create($created);
				$datetime2 = date_create($completed_time);
				$interval = date_diff($datetime1, $datetime2);
				$hours = $min = $sec = 0;
				if($interval->h > 0) {
					$hours = $interval->h*60*60;
				}
				if($interval->i > 0) {
					$min = $interval->i*60;
				}
				if($interval->s > 0) {
					$sec = $interval->s;
				}
				$totalDiff = $hours+$min+$sec;
				$timeDiffTotal = $timeDiffTotal+$totalDiff;
			}
		}

		if($inc > 0) {
			$averageTimeDiff = $timeDiffTotal/$inc;
			if($averageTimeDiff > 3600) {
				$showCompleteTime = gmdate("h", $averageTimeDiff).'h '. gmdate("i", $averageTimeDiff).'m';
			}
			else if($averageTimeDiff > 60) {
				$showCompleteTime = gmdate("i", $averageTimeDiff).'m '. gmdate("s", $averageTimeDiff).'s';
			}
			else {
				$showCompleteTime = gmdate("s", $averageTimeDiff).'s';
			}
		}


		/*--------- Response time -----------*/
		$inc = 0;
		$timeDiffTotal = 0;
		$averageTimeDiff = 0;
		$showtime = 'N/A';
		foreach ($supportChat as $key => $value) {
	
			$created = $value->created;
			$reply_time = $value->reply_time;

			if(strtotime($reply_time) > 0) {
				$inc++;
				$datetime1 = date_create($created);
				$datetime2 = date_create($reply_time);
				$interval = date_diff($datetime1, $datetime2);
				$hours = $min = $sec = 0;
				if($interval->h > 0) {
					$hours = $interval->h*60*60;
				}
				if($interval->i > 0) {
					$min = $interval->i*60;
				}
				if($interval->s > 0) {
					$sec = $interval->s;
				}
				$totalDiff = $hours+$min+$sec;
				$timeDiffTotal = $timeDiffTotal+$totalDiff;
			}
		}

		if($inc > 0) {
			$averageTimeDiff = $timeDiffTotal/$inc;
			if($averageTimeDiff > 60) {
				$showtime = gmdate("i", $averageTimeDiff).'m '. gmdate("s", $averageTimeDiff).'s';
			}
			else {
				$showtime = gmdate("s", $averageTimeDiff).'s';
			}
		}


		$plots = array();
		foreach ($supportChat as $key => $value) {
			
			$region = $value->region;
			$longitude = $value->longitude;
			$latitude = $value->latitude;
			$city = $value->city;
			if(!empty($region)) {
				$plots[$region] = array('latitude'=>$latitude, 
									'longitude'=>$longitude,
									'value'=>45,
									'tooltip'=> array('content'=>$region));
			}
			
		}

		if(count($supportChatCurrent) > 0) {
			$todayChat = count($supportChatCurrent);
		}
		else {
			$todayChat = '[No data]';
		}

		$currMonDate = array();
		$newArr = array();

		foreach ($supportChatGroupByDate as $key => $value) {
			//pre($value->createdTotal);
			$getMon = date('m', strtotime($value->created));
	    	$getDate = date('j M', strtotime($value->created));
	     	$currMonDate[$getDate] = $value->createdTotal;
	     	$x = (object) array('y'=>$getDate, 'a'=>$value->createdTotal);
	     	$newArr[] = $x;
		}

		$newArrPlase = json_encode($newArr);
		?>

				
				<!-- <div id="testwrep" class="content-wrapper chat_sec"> -->
				  <div class="content">
				  
				  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
					<div class="page_header">
					  <div class="row">
					  <!--=============Headings & Tabs menu==============-->
						<div class="col-md-5">
						  <h3><img style="width:17px;" src="<?php echo base_url(); ?>assets/images/menu_icons/Chat_Light.svg"> Chat Overview</h3>
						  <ul class="nav nav-tabs nav-tabs-bottom">
							<li class="active"><a href="#right-icon-tab0" data-toggle="tab">Overview</a></li>
							<li><a href="#right-icon-tab1" data-toggle="tab">Chat Contacts</a></li>
							<li><a href="#right-icon-tab2" data-toggle="tab">Preferances</a></li>
							<li><a href="#right-icon-tab3" data-toggle="tab">Widgets</a></li>
							<li><a href="#right-icon-tab4" data-toggle="tab">Report</a></li>
						  </ul>
						</div>
						<!--=============Button Area Right Side==============-->
						<div class="col-md-7 text-right btn_area">
							<button type="button" class="btn light_btn ml10"><i class="icon-download4"></i><span> &nbsp;  Import Contacts</span> </button>
						 	<button type="button" class="btn dark_btn ml10">Add Contacts</button>
						 	<button type="button" class="btn dark_btn ml10"><i class="icon-plus3"></i></button>
						</div>
					  </div>
					</div>
					<!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
					
					
					<!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
					<div class="tab-content"> 
					  <!--===========TAB 1===========-->
					  <div class="tab-pane active" id="right-icon-tab0">
							<div class="row">
							  <div class="col-md-8 ">
								<div class="panel panel-flat">
								  <div class="panel-heading">
									<h6 class="panel-title">Chats</h6>
								  </div>
								  <div class="panel-body p0 bkg_white min_h310">
									<div class="p20 bbot">
									  <p class="txt_grey fw300 m0"><i class="fa fa-square txt_blue"></i> &nbsp; New chats this month &nbsp; &nbsp; <strong class="txt_dark"></strong></p>
									</div>
									<div class="p20" style="background: #fcfdfe!important; border-radius: 0 0 6px 6px">
									  <div id="myfirstchart" style="height: 200px;"></div>
									</div>
								  </div>
								</div>
							  </div>
							  <div class="col-md-4">
								<div class="panel panel-flat">
								  <div class="panel-heading">
									<h6 class="panel-title">Today</h6>
								  </div>
								  <div class="panel-body p20 pt50 pb40 bkg_white text-center min_h310">
									<div class="outer_circle">
									  <div id="bluecircle" class="c100 p23 medium"> <span><strong><?php echo $todayChat; ?></strong> <br>
										CHATS <br>
										TODAY</span>
										<div class="slice">
										  <div class="bar"></div>
										  <div class="fill"></div>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
							<div class="row">
								<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-flat">
								  <div class="panel-heading">
									<h6 class="panel-title">All Activity</h6>
								  </div>
								 
								  
								  <div class="panel-body bkg_white pt0 pb0">
							  <div class="row">
							  	<div class="col-md-5 pr40 pl20 mt20 brig">
							  		 <ul class="onsite_list">
										<li class="bnone"><span class="txt_dark"><img width="12" src="<?php echo base_url(); ?>assets/images/chat_list_icon.png"> All Chats</span><strong class="txt_dark"><?php echo count($supportChat); ?></strong></li>
										<li><span><img width="14" src="<?php echo base_url(); ?>assets/images/chat_desktop_icon.png"> Website Chats</span><strong><?php echo count($supportChat); ?></strong></li>
										<li><span><img width="14" src="<?php echo base_url(); ?>assets/images/chat_mobile_icon.png"> SMS Chats</span><strong>N/A</strong></li>
									  </ul>
							  	</div>
							  	<div class="col-md-7 pl20"><div id="linechart_a" style="min-width: 300px; height: 220px;"></div></div>
							  </div>
							   
							  </div>
							  
							  
								</div>
									</div>
									
									<div class="col-md-6">
										<div class="panel panel-flat">
							  <div class="panel-heading">
								<h6 class="panel-title">Response Time<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
							  </div>
							  <div class="panel-body p20 db_stats bkg_white">
								<div class="row">
									<div class="col-xs-2"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/clock_44.png"></div>
									<div class="col-xs-10"><h1><?php echo $showtime; ?></h1><p><strong class="txt_green"><i class=""><img src="<?php echo base_url(); ?>assets/images/green_arrow.png"></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
								</div>
								<div class="row">
									<div class="col-xs-12"><img class="img-responsive mt30" src="<?php echo base_url(); ?>assets/images/chat_graph_blue.png"></div>
								</div>
							  </div>
							</div>
									</div>
									<div class="col-md-6">
										<div class="panel panel-flat">
							  <div class="panel-heading">
								<h6 class="panel-title">Time to close<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
							  </div>
							  <div class="panel-body p20 db_stats bkg_white">
								<div class="row">
									<div class="col-xs-2"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon_check_44.png"></div>
									<div class="col-xs-10"><h1><?php echo $showCompleteTime; ?></h1><p><strong class="txt_green"><i class=""><img src="<?php echo base_url(); ?>assets/images/green_arrow.png"></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
								</div>
								<div class="row">
									<div class="col-xs-12"><img class="img-responsive mt30" src="<?php echo base_url(); ?>assets/images/chat_graph_green.png"></div>
								</div>
							  </div>
							</div>
									</div>
								</div>
							  </div>
							  <div class="col-md-6 ">
								<div class="panel panel-flat">
								  <div class="panel-heading">
									<h6 class="panel-title">Chat Activity</h6>
								  </div>
								  <div class="panel-body p20 bkg_white min_h310" style="padding-bottom: 5px!important">
								  <div class="p20 text-center"><!--<img style="height: 250px; margin: 0 auto;" class="img-responsive" src="assets/images/map.png"/>-->
								  
								  <div style="height: 250px;" class="mapcontainer">
        <div class="map">
            <span>Alternative content for the map</span>
        </div>
        <div class="plotLegend">
            <span>Alternative content for the legend</span>
        </div>
    </div>
								  
								  </div> 
									 <ul class="onsite_list">
									 	<?php 
									 	$flag = 0;
									 	if(!empty($supportChatGroupByCountry)) {
									 		foreach($supportChatGroupByCountry as $countryCount) {
										 		if($flag > 2) {
										 			break;
										 		}
										 		?><li><span><img src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($countryCount->countryCode); ?>.png" width="16"> <?php echo $countryCount->country; ?></span><strong class="txt_dark"><?php echo $countryCount->countryTotal; ?></strong></li><?php
										 		$flag++;
										 	}
									 	}
									 	?>
									  </ul>
								  </div>
								</div>
							  </div>
							</div>
					  </div>
					  <!--===========TAB 2===========-->
					  <div class="tab-pane" id="right-icon-tab1">
						<div class="row">
						  <div class="col-md-12">
							<div style="margin: 0;" class="panel panel-flat">
					     	
						  
							  <div class="panel-heading"> 
							  	  <span class="pull-left">
								  <h6 class="panel-title">135 Contacts</h6>
								  </span>
								  <div class="heading_links pull-left">
									<button type="button" class="btn btn-xs btn_white_table ml20">All</button>
									<a class="top_links txt_blue" href="#">Customers USA</a> 
									<a class="top_links" href="#">Added reviews</a> 
									<a class="top_links" href="#">Age 25-40</a> 
									<a class="top_links" href="#">Negative review</a>
									<button type="button" class="btn btn-xs plus_icon ml20"><i class="icon-plus3"></i></button>
								  </div>
								  <div class="heading-elements">
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
														<input class="form-control input-sm" placeholder="Search by name" type="text">
														<div class="form-control-feedback">
															<i class=""><img src="assets/images/icon_search.png"/ width="14"></i>
														</div>
													</div>
													<div class="table_action_tool">
														<a href="#"><i class=""><img src="assets/images/icon_calender.png"/></i></a>
														<a href="#"><i class=""><img src="assets/images/icon_download.png"/></i></a>
														<a href="#"><i class=""><img src="assets/images/icon_upload.png"/></i></a>
														<a href="#"><i class=""><img src="assets/images/icon_edit.png"/></i></a>
													</div>
													
								</div>
								</div>
							  <div class="panel-body p0">
								
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					  <!--===========TAB 3===========-->
					  <div class="tab-pane" id="right-icon-tab2">
						tab 3
					  </div>
					  <!--===========TAB 4===========-->
					  <div class="tab-pane" id="right-icon-tab3">
						tab 4
					  </div>
					  <!--===========TAB 5===========-->
					  <div class="tab-pane" id="right-icon-tab4">
						tab 5
					  </div>
					  
					  
					  
					</div>
					<!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->

					
					
					
					
					
					
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

$( document ).ready( function () {
	smallMenu();

	window.onresize = function () {
		smallMenu();
	};
} );
</script>
<script>

	
	
	Morris.Area({
    element: 'myfirstchart',
		parseTime : false,
    
		data: <?php echo $newArrPlase; ?>,
		
		
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
	  lineColors: ['#5a99f6', '#0c265a'],
		
		

		
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
	
	colors: ['#5a99f6', '#cae4d1'],
    tooltip: {
        pointFormat: '<b>{point.y} Chat</b>'
    },
    series: [{
	showInLegend: false,  
        name: 'Time',
        data: <?php echo $showData; ?>,
       
    }]
});	
	
	</script>
<script>
        $(function () {
            $(".mapcontainer").mapael({
                map: {
                    name: "world_countries",
                    defaultArea: {
                        attrs: {
                            stroke: "#fff",
                            "stroke-width": 1
                        }
                    }
                },
                legend: {
                   
                    plot: {
                        mode: "horizontal",
                        title: null,
                        labelAttrs: {
                            "font-size": 12
                        },
                        marginLeft: 5,
                        marginLeftLabel: 5,
                        slices: [
                            {
                                max: 500000,
                                attrs: {
                                    fill: "#f27474"
                                },
                                attrsHover: {
                                    transform: "s1.5",
                                    "stroke-width": 1
                                },
                                label: "< 500 000",
                                size: 20
                            },
                            {
                                min: 500000,
                                max: 1000000,
                                attrs: {
                                    fill: "#38b1db"
                                },
                                attrsHover: {
                                    transform: "s1.5",
                                    "stroke-width": 1
                                },
                                label: "> 500 000 and 1 million",
                                size: 25
                            },
                            {
                                min: 1000000,
                                attrs: {
                                    fill: "#5a99f6"
                                },
                                attrsHover: {
                                    transform: "s1.5",
                                    "stroke-width": 1
                                },
                                label: "> 1 million",
                                size: 35
                            }
                        ]
                    }
                },
                plots: <?php echo json_encode($plots); ?>,
		
				
                
            });
        });
    </script>