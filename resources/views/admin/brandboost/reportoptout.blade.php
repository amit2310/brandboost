   @extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
    
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/visualization/echarts/echarts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/charts/echarts/pies_donuts_analytics2.js"></script>
    
    <!-- /theme JS files -->

    
    <style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    </style>

    <?php
        $status = 0; 
        $getUnSub = getListSubscriber($status);
        $statusA = 1;
        $getSub = getListSubscriber($statusA);
    ?>
  
<div class="content">

<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
<div class="page_header">
  <div class="row">
  <!--=============Headings & Tabs menu==============-->
    <div class="col-md-7">
      <h3><img style="width: 16px;" src="/assets/images/analysis_icon.png"> Opt Out Report</h3>
      <ul class="nav nav-tabs nav-tabs-bottom">
        <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Today</a></li>
        <li><a href="#right-icon-tab1" data-toggle="tab">Yesterday</a></li>
        <li><a href="#right-icon-tab2" data-toggle="tab">Week</a></li>
        <li><a href="#right-icon-tab3" data-toggle="tab">Month</a></li>
        <li><a href="#right-icon-tab4" data-toggle="tab">3 Month</a></li>
      </ul>
      
    </div>
    <!--=============Button Area Right Side==============-->
    <div class="col-md-5 text-right btn_area">
     <div class="btn-group">
                <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reports &nbsp; &nbsp; <span class="caret"></span>
                </button>
                <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                  <div class="dropdown-content-heading"> Filter
                    <ul class="icons-list">
                      <li><a href="#"><i class="icon-more"></i></a> </li>
                    </ul>
                  </div>
                  <div class="">
                    <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                      <div class="panel panel-white">
                        <div class="panel-heading sidebarheadings active">
                          <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                        </div>
                        <div id="accordion-control-right-group1" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12"> 
                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                     </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-white">
                        <div class="panel-heading sidebarheadings">
                          <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                        </div>
                        <div id="accordion-control-right-group2" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12"> Conetent Goes here... </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-white">
                        <div class="panel-heading sidebarheadings">
                          <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                        </div>
                        <div id="accordion-control-right-group73" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12"> Conetent Goes here... </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-white">
                        <div class="panel-heading sidebarheadings">
                          <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                        </div>
                        <div id="accordion-control-right-group74" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12"> Conetent Goes here... </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-white">
                        <div class="panel-heading sidebarheadings">
                          <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                        </div>
                        <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <div class="row mb20">
                              <div class="col-xs-6">
                              <div class="checkbox">
                              <label>
                                <input type="checkbox"  class="control-primary" checked="checked">
                                Total Reviews
                                </label>
                                </div>
                              </div>
                              <div class="col-xs-6">
                              <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                              </div>

                            </div>
                            <div class="row mb20">
                              <div class="col-xs-6">
                              <div class="checkbox">
                              <label>
                                <input type="checkbox"  class="control-primary" checked="checked">
                                Positive
                                </label>
                                </div>
                              </div>
                              <div class="col-xs-6">
                              <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                              </div>

                            </div>
                            <div class="row mb20">
                              <div class="col-xs-6">
                              <div class="checkbox">
                              <label>
                                <input type="checkbox"  class="control-primary">
                                Neutral
                                </label>
                                </div>
                              </div>
                              <div class="col-xs-6">
                              <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-xs-6">
                              <div class="checkbox">
                              <label>
                                <input type="checkbox"  class="control-primary" checked="checked">
                                Negative
                                </label>
                                </div>
                              </div>
                              <div class="col-xs-6">
                              <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown-content-footer">
                    <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                    &nbsp; &nbsp;
                    <a style="display: inline-block;" href="#">Clear All</a>
                  </div>
                </div>
            </div>
     </div>
  </div>
</div>
<!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


<!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
 <div class="tab-content"> 
  <!--===========TAB 1===========-->
  <div class="tab-pane active" id="right-icon-tab0">
  
  
                      
<div class="row"> 
 
 <div class="col-md-6">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title">Opted Out Over Time Period</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      
      <div class="panel-body p0"> 
    <div class="p20 pl20 topchart_value">
        <div class="row">
            <div class="col-xs-4 brig">
            <h1 class="m0">1.320</h1>
            <p>Opt <span style="border: none;" class="label ">15.9%</span></p>
            </div>
            <div class="col-xs-4">
            <h1 class="m0">967</h1>
            <p>Out <span style="border: none;" class="label bkg_green">5.9%</span></p>
            </div>
            
        </div>
      </div>
     
     <div style="height: 250px;" class="p20" id="linechart_bot"></div>
     
     
     
      </div>
      
      
    </div>
  </div>
  <!--------------LEFT----------->
  <div class="col-md-3">
    <div class="panel panel-flat review_ratings">
      <div class="panel-heading">
        <h6 class="panel-title">Number of Active Contacts</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      <div class="panel-body p0">
        <div class="p20 topchart_value">
            <div class="row">
                <div class="col-xs-12">
                <img class="pull-left mr20" src="/assets/images/icon_envalope.png"/>
                <h1 class="m0">21.5%</h1>
                <p class="txt_red"><span style="border: none;" class="label ml0">15.9%</span></p>
                </div>
            </div>
          </div>
                              
                              
        <div id="linechart_a" style="min-width: 300px; height: 250px;"></div>
      </div>
    </div>
  </div>
  <!------------CENTER------------->
  <div class="col-md-3">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title">Number of Opt Out</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      <div class="panel-body p0 "> 
      <div class="p20">
        <div class="" id="multiple_donuts2" style="height: 205px;"></div>
      </div>
      
      
      
      
      <div class="p20 text-center graph_score btop ">
        <div class="row">
            <div class="col-xs-4">
            <i class="icon-primitive-dot txt_blue"></i>
            <p><strong>39</strong></p>
            </div>
            <div class="col-xs-4">
            <i style="opacity: 0.7;" class="icon-primitive-dot txt_blue"></i>
            <p><strong>21</strong></p>
            </div>
            <div class="col-xs-4">
            <i style="opacity: 0.3;" class="icon-primitive-dot txt_blue"></i>
            <p><strong>13</strong></p>
            </div>
        </div>
    </div>                      
                                
      </div>
    </div>
  </div>

</div>
      
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Opted Out Customers</h6>
                <div class="heading-elements">
                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                    <div class="form-control-feedback">
                        <i class="icon-search4 txt_blue"></i>
                    </div>
                </div>&nbsp; &nbsp;
                                    
                    <button type="button" class="btn btn-xs btn-default"><i class="icon-pencil txt_blue position-left"></i> Edit</button>
                </div>
              </div>
              <div class="panel-body p0">
                <table class="table datatable-basic">
                  <thead>
                    <tr>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th>Date</th>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Product</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--================================================-->
                    <?php foreach($getUnSub as $data) { ?>
                    <tr>
                      <td style="display: none;"></td>
                      <td style="display: none;"><?php echo strtotime($data->created); ?></td>
                      <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-envelop br5 txt_teal"></i></a> </div>
                        <div class="media-left">
                          <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?></a> </div>
                        </div></td>
                      <td><span class="txt_dgrey"><?php echo $data->email; ?></span></td>
                      <td><span class="txt_dgrey"><?php echo $data->firstname.' '.$data->lastname; ?></span></td>
                      <td><span class="txt_dgrey"><?php echo $data->brandTitle; ?></span></td>
                    </tr>
                    <?php } ?>
                    <!--================================================-->
                   
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--===========TAB 2===========-->
      <div class="tab-pane" id="right-icon-tab1"> </div>
      <!--===========TAB 3====Preferences=======-->
      <div class="tab-pane" id="right-icon-tab2"> </div>
      <!--===========TAB 4====Chat Widget=======-->
      <div class="tab-pane" id="right-icon-tab3"> </div>
      <!--===========TAB 5===========-->
      <div class="tab-pane" id="right-icon-tab4"> </div>
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
//Semi Circle chart js -- Highcharts js plugins
    
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
                fontSize: '11px',
                fontFamily: 'Verdana, sans-serif'
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
    
    colors: ['#2eb4dd', '#000000'],
    tooltip: {
        pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Time',
        data: [
            ['1', 4.2],
            ['2', 3.8],
            ['3', 2.9],
            ['4', 6.7],
            ['5', 9.1],
            ['6', 18.7],
            ['7', 15.4],
            ['8', 12.2],
            ['9', 10.0],
            ['10', 8.7],
            ['11', 4.5],
            ['12', 2.2]
        ],
       
    }]
}); 
    
</script>
      
      
   <script>
    
    Highcharts.chart('linechart_bot', {
        
         chart: {
    
        backgroundColor:'rgba(0, 0, 0, 0)',
    },
        
        
    title: {
        text: null
    },

    subtitle: {
        text: null
    },

    yAxis: {
        title: {
            text: null
        }
    },
    legend: {
        enabled: false
    },
        
        colors: ['#4ebc86', '#2b97dd'],

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 1
        }
    },
        
        

    series: [{
        name: 'Installation',
        data: [200, 250, 300, 250, 320, 380, 300, 250]
    }, {
        name: 'Other',
        data: [130, 180, 230, 180, 250, 310, 230, 180]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
    
    </script>   
      


<?php /* ?>
<!-- Theme JS files -->
	
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/plugins/visualization/d3/d3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
 
<!-- /theme JS files -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/plugins/visualization/echarts/echarts.js"></script>

 	

		
<style>
.reports_sec h4 {margin: 0 0 10px;font-size: 17px;font-weight: 500;}
.reports_sec h5{font-size: 14px; font-weight: 600; color: #000; margin: 0 0 10px; padding-left: 0px;}
.reports_sec h5 span{ color: #4caf50!important; font-weight: 500; font-size: 24px;}
.reports_sec h5:first-child{padding-left: 0px}
	
.panel.no-boxshadow {	box-shadow: none !important; border: 1px solid #eee;}
.table-responsive{border-bottom: 1px solid #eee;}
.media-body.results hr{margin: 10px 0; border-color: #f5f4f5 ;}
.media-body.results h3{color: #4caf50!important}
.media-body.results i{color: #4caf50!important; float: left; margin: 7px 4px 0 0; font-size: 24px;}	
	
.media-body.results i.fa{float: none; margin-right: 0px; color: #ffd301!important; font-size: 20px!important;}
.btn.filter{display: block; width: 100%;}


	
.panel.boxshadow {	box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); border: 1px solid #eee; min-height: 240px; transition: transform .15s ease;}
.panel.boxshadow:hover {transform: scale(1.02) translateY(-3px); box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); cursor: pointer}

.panel.shadow {	box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); border: 1px solid #eee; min-height: 250px; transition: transform .15s ease;}
.panel.shadow:hover{transform: scale(1.01) translateY(-1px);}

	
.result_box{ }
.bkg1{background: #fef6f2!important}
.bkg2{background: #f3fbf3!important}
.bkg3{background: #fbf1f1!important}
.bkg4{background: #eff2f5!important}
.bkg5{background: #f1f7fd!important}
.bkg6{background: #edf6ff!important}
.bkg7{background: #faf3ff!important;}
	.rating_progress {	margin-bottom: 5px;}
	.rating_progress p{font-size: 11px; margin: 0;}
	.progress-bar-warning{background: #ffd301;}
	.progress{height: 6px; margin-top: 0spx;}
	
	.chart-widget-legend li {margin: 5px 5px 0!important;padding: 0!important;}
	.pl0{padding-left: 0px!important;}
	.pr0{padding-right: 0px!important;}
	.text-left.starts{width: 57px;}
	table.table td{padding: 0 20px!important}
</style>	


<!-- Content area -->
<div class="content reports_sec">
<div class="panel panel-flat">
<div class="panel-heading">
        <h6 class="panel-title"> Home - Brand Boost Reports</h6>
        <div class="heading-elements"> <span class="label bg-success lgraybtn heading-text"> Brand Boost Report</span>
          <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold"> <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b> </button>
        </div>
      </div>
<div class="panel-body">
		<?php
				$status = 0; 
				$getUnSub = getListSubscriber($status);
				$statusA = 1;
				$getSub = getListSubscriber($statusA);
		?>
<!--#################################Map###########################-->
<div class="row mb-20">
			  <div class="col-md-9">
				
					<div class="panel panel-flat shadow boxshadowbig ">
						<div class="panel-heading">
							<h5 class="panel-title">Opted Out Over Time Period</h5>
						</div>
						<div class="panel-body">
							<div class="chart-container">
								<div class="chart has-fixed-height" id="stacked_area"></div>
							</div>
						</div>
					</div>
					
			  </div>
			   <div class="col-md-3">
			  <div class="row">
			  <div class="col-sm-12 result_box">
				<div class="panel panel-body boxshadow bkg6">
				  <div class="media no-margin">
					<div class="media-body text-left results">
				  	  <h5 class="mb0"><i class="icon-star-full2"></i> &nbsp; <span><?php echo number_format(count($getSub)); ?></span></h5>
					  <h5>Number of Active Contacts</h5>
					  
					 
				  	
				  		
					  
					  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-sm-12 result_box">
				<div class="panel panel-body boxshadow bkg2">
				  <div class="media no-margin">
					<div class="media-body text-left results">
				  <h5 class="mb0"><i class="icon-upload"></i> &nbsp; <span><?php echo number_format(count($getUnSub)); ?></span></h5>
					  <h5>Number of Opt Out</h5>
					 <div class="svg-center" id="pie_progress_bar"></div>
					  </div>
				  </div>
				</div>
			  </div>
			  
			</div>
			  
				</div>



			</div> 
<!--#################################Table###########################-->
<div class="row">
			  <div class="col-md-12">
				<div style="border: none; margin: 0 -20px;" class="panel panel-flat no-boxshadow">
				  <div class="panel-heading">
					<h6 class="panel-title">Opted Out Customers</h6>
				  </div>
				  <div style="padding: 0px!important;" class="panel-body reports_sec">
					<div class="row">
					  <div class="col-md-12">
			
			  <div class="table-responsive">
			    <input name="min" id="min" type="hidden">
                <input name="max" id="max" type="hidden">
				<table class="table datatable-sorting text-nowrap">
				  <thead>
					<tr>
					  <th>Date</th>
					  <th>Email</th>
					  <th>Name</th>
					  <th>Product</th>
					  <th style="display: none;"></th>
					  <th style="display: none;"></th>
					  <th style="display: none;"></th>
					  <th style="display: none;"></th>
					</tr>
				  </thead>
				  <tbody>
				    <?php foreach($getUnSub as $data) {?>
					<tr>
					  <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
					  <td><?php echo $data->created; ?></td>
					  <td><?php echo $data->firstname.' '.$data->lastname; ?></td>
					  <td><?php echo $data->brandTitle; ?></td>
					  <td style="display: none;"></td>
					  <td style="display: none;"></td>
					  <td style="display: none;"></td>
					  <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
					</tr>
					<?php } ?>
					
				  </tbody>
				</table>
			  </div>

					<div class="clearfix"></div>


					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>	
        
</div>	
</div>		
					

					
					
				
</div>
			<!-- /page content -->
			
			
		
<script>
	

$(function() {


    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: '<?php echo base_url(); ?>assets/js/plugins/visualization/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------

            var stacked_area = ec.init(document.getElementById('stacked_area'), limitless);
           



            // Charts setup
            // ------------------------------



            //
            // Stacked area options
            //

            stacked_area_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 20,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Sales', 'Emails', 'SMS', 'Reviews']
                },

                // Enable drag recalculate
                calculable: true,

                // Add horizontal axis 
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                }],

                // Add vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Sales',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [120, 132, 101, 134, 490, 230, 210]
                    },
                    {
                        name: 'Emails',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [150, 1232, 901, 154, 190, 330, 810]
                    },
                    {
                        name: 'SMS',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [320, 1332, 1801, 1334, 590, 830, 1220]
                    },
                    {
                        name: 'Reviews',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [820, 1632, 1901, 2234, 1290, 1330, 1320]
                    }
                ]
            };

			
			

			

           


            // Apply options
            // ------------------------------

          
            stacked_area.setOption(stacked_area_options);
			
           



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function () {
                    stacked_area.resize();
					
                }, 200);
            }
        }
    );
});

				

	
  
	 // Pie with progress bar
    // ------------------------------

    // Initialize chart
    pieWithProgress("#pie_progress_bar", 100);

    // Chart setup
    function pieWithProgress(element, size) {

        // Demo dataset
        var dataset = [
                { name: 'New', count: 639 },
                { name: 'Pending', count: 255 },
                { name: 'Shipped', count: 215 }
            ];

        // Main variables
        var d3Container = d3.select(element),
            total = 0,
            width = size,
            height = size,
            progressSpacing = 6,
            progressSize = (progressSpacing + 2),
            arcSize = 20,
            outerRadius = (width / 2),
            innerRadius = (outerRadius - arcSize);

        // Colors
        var color = d3.scale.ordinal()
            .range(['#EF5350', '#29b6f6', '#66BB6A']);


        // Create chart
        // ------------------------------

        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
            .attr("width", width)
            .attr("height", height)
            .append("g")
                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");


        // Construct chart layout
        // ------------------------------

        // Add dataset
        dataset.forEach(function(d){
            total+= d.count;
        });

        // Pie layout
        var pie = d3.layout.pie()
            .value(function(d){ return d.count; })
            .sort(null);

        // Inner arc
        var arc = d3.svg.arc()
            .innerRadius(innerRadius)
            .outerRadius(outerRadius);

        // Line arc
        var arcLine = d3.svg.arc()
            .innerRadius(innerRadius - progressSize)
            .outerRadius(innerRadius - progressSpacing)
            .startAngle(0);


        // Append chart elements
        // ------------------------------

        //
        // Animations
        //
        var arcTween = function(transition, newAngle) {
            transition.attrTween("d", function (d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                var interpolateCount = d3.interpolate(0, dataset[0].count);
                return function (t) {
                    d.endAngle = interpolate(t);
                    middleCount.text(d3.format(",d")(Math.floor(interpolateCount(t))));
                    return arcLine(d);
                };
            });
        };


        //
        // Donut paths
        //

        // Donut
        var path = svg.selectAll('path')
            .data(pie(dataset))
            .enter()
            .append('path')
            .attr('d', arc)
            .attr('fill', function(d, i) {
                return color(d.data.name);
            })
            .style({
                'stroke': '#fff',
                'stroke-width': 2,
                'cursor': 'pointer'
            });

        // Animate donut
        path
            .transition()
            .delay(function(d, i) { return i; })
            .duration(600)
            .attrTween("d", function(d) {
                var interpolate = d3.interpolate(d.startAngle, d.endAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);  
                }; 
            });


        //
        // Line path 
        //

        // Line
        var pathLine = svg.append('path')
            .datum({endAngle: 0})
            .attr('d', arcLine)
            .style({
                fill: color('New')
            });

        // Line animation
        pathLine.transition()
            .duration(600)
            .delay(300)
            .call(arcTween, (2 * Math.PI) * (dataset[0].count / total));


        //
        // Add count text
        //

        var middleCount = svg.append('text')
            .datum(0)
            .attr('dy', 6)
            .style({
                'font-size': '14px',
                'font-weight': 500,
                'text-anchor': 'middle'
            })
            .text(function(d){
                return d;
            });            


        //
        // Add interactions
        //

        // Mouse
        path
            .on('mouseover', function(d, i) {
                $(element + ' [data-slice]').css({
                    'opacity': 0.3,
                    'transition': 'all ease-in-out 0.15s'
                });
                $(element + ' [data-slice=' + i + ']').css({'opacity': 1});
            })
            .on('mouseout', function(d, i) {
                $(element + ' [data-slice]').css('opacity', 1);
            });


        //
        // Add legend
        //

        // Append list
        var legend = d3.select(element)
            .append('ul')
            .attr('class', 'chart-widget-legend')
            .selectAll('li')
            .data(pie(dataset))
            .enter()
            .append('li')
            .attr('data-slice', function(d, i) {
                return i;
            })
            .attr('style', function(d, i) {
                return 'border-bottom: solid 2px ' + color(d.data.name);
            })
            .text(function(d, i) {
                return d.data.name + ': ';
            });

        // Append legend text
        legend.append('span')
            .text(function(d, i) {
                return d.data.count;
            });
    }
	


</script>		
<?php */ ?>	
@endsection