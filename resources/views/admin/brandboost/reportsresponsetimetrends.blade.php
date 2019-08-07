<?php error_reporting(0); ?>
   @extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

    <script src = "https://code.highcharts.com/highcharts.js"></script>
    
    <!-- /theme JS files -->

    <?php 
        
        $getNegativeTime = getNegativeTime(); 
        
        if(!empty($getNegativeTime)){
            $negativeTime = $getNegativeTime[0];
            $positiveTime = end($getNegativeTime);
            

            if($negativeTime->ratings == '1' || $negativeTime->ratings == '2') {
                $negTime = date('h A',strtotime($negativeTime->created));
            }
            else {
                $negTime = 'No Data';
            }

            if($positiveTime->ratings == '5' || $positiveTime->ratings == '5') {
                $posTime = date('h A',strtotime($positiveTime->created));
            }
            else {
                $posTime = 'No Data';
            }
        }
        else {

            $negTime = 'No Data';
            $posTime = 'No Data';
        }

        $getBusyTime = getBusyTime();
        if(!empty($getBusyTime)) {

            $busyTime = $getBusyTime[0];
            $busyTime = date('h A',strtotime($busyTime->created));
        }
        else{
            $busyTime = 'No Data';
        }
    ?>
    <style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    </style>

  <div class="content">
  
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
      <div class="row">
      <!--=============Headings & Tabs menu==============-->
        <div class="col-md-7">
          <h3><img style="width: 16px;" src="<?php echo base_url(); ?>assets/images/analysis_icon.png"> Response Time Trends</h3>
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
  <!--------------LEFT----------->
  <div class="col-md-3">
    <div class="panel panel-flat review_ratings">
      <div class="panel-heading">
        <h6 class="panel-title">Most Negative Time of the Day</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      <div class="panel-body p0 bkg_white">
        <div class="p20 topchart_value">
            <div class="row">
                <div class="col-xs-12">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/smiley_red.png"/>
                <h1 class="m0"><?php echo $negTime; ?></h1>
                <p class="txt_red">19.8%</p>
                </div>
            </div>
          </div>
                              
                              
        <div id="linechart_a" style="min-width: 300px; height: 200px;"></div>
      </div>
    </div>
  </div>
  <!------------CENTER------------->
  <div class="col-md-3">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title">Quietest Time of the Day</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      <div class="panel-body p0 bkg_white"> 
      <div class="p20 topchart_value">
            <div class="row">
                <div class="col-xs-12">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/timer_icon.png"/>
                <h1 class="m0"><?php echo $posTime; ?></h1>
                <p class="txt_teal">11.8%</p>
                </div>
            </div>
          </div>
     <div id="linechart_b" style="min-width: 300px; height: 200px;"></div>
      </div>
    </div>
  </div>
  <!------------RIGHT------------->
  <div class="col-md-3">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title">Busiest Time of the Day</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      <div class="panel-body p0 bkg_white"> 
      <div class="p20 topchart_value">
            <div class="row">
                <div class="col-xs-12">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/timer_icon.png"/>
                <h1 class="m0"><?php echo $busyTime; ?></h1>
                <p class="txt_teal">69.8%</p>
                </div>
            </div>
          </div>
     <div id="linechart_c" style="min-width: 300px; height: 200px;"></div>
      </div>
    </div>
  </div>
  <!------------RIGHT------------->
  <div class="col-md-3">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title">Most Negative Time of the Day</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      
      <div class="panel-body p0 bkg_white"> 
      <div class="p20 topchart_value">
            <div class="row">
                <div class="col-xs-12">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/smiley_green.png"/>
                <h1 class="m0"><?php echo $posTime; ?></h1>
                <p class="txt_green">19.8%</p>
                </div>
            </div>
          </div>
     <div id="linechart_d" style="min-width: 300px; height: 200px;"></div>
      </div>
      
      
    </div>
  </div>
</div>
          
              
                  
<div class="row">                     
<div class="col-md-12">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title">Bounce</h6>
        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
      </div>
      
      <div class="panel-body p0 bkg_white"> 
      <div class="p20 topchart_value" style="max-width: 1400px;">
            <div class="row">
                <div class="col-xs-2">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/smiley_green.png"/>
                <h1 class="m0">136</h1>
                <p class="txt_green">61.8%</p>
                </div>
                
                <div class="col-xs-2">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/smiley_green.png"/>
                <h1 class="m0">121</h1>
                <p class="txt_green">28.8%</p>
                </div>
                <div class="col-xs-2">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/smiley_grey2.png"/>
                <h1 class="m0">74</h1>
                <p class="txt_grey">69.8%</p>
                </div>
                <div class="col-xs-2">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/smiley_red.png"/>
                <h1 class="m0">39</h1>
                <p class="txt_red">56.8%</p>
                </div>
                <div class="col-xs-2">
                <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/smiley_red.png"/>
                <h1 class="m0">5</h1>
                <p class="txt_red">5.8%</p>
                </div>
            </div>
          </div>
     <!--<div id="linechart_d" style="min-width: 300px; height: 250px;"></div>-->
     
     <div class="p20" id="linechart_bot"></div>
     
     
     
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
        type: 'column'
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
    
    colors: ['#fd6c81', '#fbcfd7', '#8bbc21', '#910000'],
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
    
    
    
    
    Highcharts.chart('linechart_b', {
    chart: {
        type: 'column'
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
    
    colors: ['#2694b8', '#badbe7', '#8bbc21', '#910000'],
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
    
    
    
    
    Highcharts.chart('linechart_c', {
    chart: {
        type: 'column'
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
    
    colors: ['#066172', '#badbe7', '#8bbc21', '#910000'],
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
    
    
    
    
    Highcharts.chart('linechart_d', {
    chart: {
        type: 'column'
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
    
    colors: ['#5ad491', '#cbf0dd', '#8bbc21', '#910000'],
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
        
        colors: ['#acba14', '#fd6c81', '#9292b4', '#4ebc86', '#2694b8'],

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
        data: [100, 150, 200, 150, 300, 350, 200, 450]
    }, {
        name: 'Manufacturing',
        data: [105, 200, 250, 200, 350, 400, 300, 500]
    }, {
        name: 'Sales & Distribution',
        data: [110, 250, 300, 250, 400, 450, 400, 550]
    }, {
        name: 'Project Development',
        data: [115, 300, 350, 300, 450, 500, 500, 600]
    }, {
        name: 'Other',
        data: [120, 350, 400, 350, 500, 550, 600, 650]
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/visualization/echarts/echarts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/visualization/d3/d3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	
<!-- /theme JS files -->
	
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


	
.panel.boxshadow {	box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); border: 1px solid #eee; min-height: 250px; transition: transform .15s ease;}
.panel.boxshadow:hover {transform: scale(1.02) translateY(-3px); box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); cursor: pointer}

.panel.shadow {	box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); border: 1px solid #eee; min-height: 250px; transition: transform .15s ease;}
.panel.shadow:hover{transform: scale(1.01) translateY(-1px);}

	

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
</style>	
				

<!-- Content area -->
<div class="content reports_sec">
<div class="panel panel-flat">
<div class="panel-heading">
        <h6 class="panel-title">Response Time Trends</h6>
        <div class="heading-elements"> <span class="label bg-success lgraybtn heading-text"> Brand Boost Campaign Report</span>
         
        </div>
      </div>
<div class="panel-body">
	<?php 
		
		$getNegativeTime = getNegativeTime(); 
		
		if(!empty($getNegativeTime)){
			$negativeTime = $getNegativeTime[0];
			$positiveTime = end($getNegativeTime);
			

			if($negativeTime->ratings == '1' || $negativeTime->ratings == '2') {
				$negTime = date('h A',strtotime($negativeTime->created));
			}
			else {
				$negTime = 'No Data';
			}

			if($positiveTime->ratings == '5' || $positiveTime->ratings == '5') {
				$posTime = date('h A',strtotime($positiveTime->created));
			}
			else {
				$posTime = 'No Data';
			}
		}
		else {

			$negTime = 'No Data';
			$posTime = 'No Data';
		}

		$getBusyTime = getBusyTime();
		if(!empty($getBusyTime)) {

			$busyTime = $getBusyTime[0];
			$busyTime = date('h A',strtotime($busyTime->created));
		}
		else{
			$busyTime = 'No Data';
		}
	?>
       
<!--#################################Top 3 Boxes###########################-->
	<div class="row">
      <div class="col-sm-6 col-md-3 result_box">
		<div class="panel panel-body boxshadow bkg4">
		  <div class="media no-margin">
			<div class="media-body text-left results">
		      <h5 class="mb0"><i class="icon-alarm"></i> &nbsp;  <span><?php echo $negTime; ?></span></h5>
			  <h5 class="mb30">Most Negative Time of the Day</h5>
			 <div class="svg-center" id="arc_multi"></div>
			 </div>
		  </div>
		</div>
	  </div>
	  <div class="col-sm-6 col-md-3 result_box">
		<div class="panel panel-body boxshadow bkg7">
		  <div class="media text-left ">
			<div class="media-body results">
		  	  <h5 class="mb0"><i class="icon-alarm"></i> &nbsp;  <span><?php echo $posTime; ?></span></h5>
			  <h5 class="mb30">Quetest Time of the Day</h5>
			  <div class="svg-center" id="arc_single2"></div>
			  </div>
		  </div>
		</div>
	  </div>
	  
	  <div class="col-sm-6 col-md-3 result_box">
		<div class="panel panel-body boxshadow bkg2">
		  <div class="media no-margin">
			<div class="media-body text-left results">
		  <h5 class="mb0"><i class="icon-alarm"></i> &nbsp; <span><?php echo $busyTime; ?></span></h5>
			  <h5>Busiest Time of the Day</h5>
			 <div class="svg-center" id="pie_progress_bar"></div>
			  </div>
		  </div>
		</div>
	  </div>
	  <div class="col-sm-6 col-md-3 result_box">
		<div class="panel panel-body boxshadow bkg6">
		  <div class="media no-margin">
			<div class="media-body text-left results">
		  <h5 class="mb0"><i class="icon-alarm"></i> &nbsp; <span><?php echo $posTime; ?></span></h5>
			  <h5>Most Positive Time of the Day</h5>
			 <div class="svg-center" id="pie_progress_bar2"></div>
			  </div>
		  </div>
		</div>
	  </div>
	  
	  
	  
	  
	</div>
	<!--#################################Map###########################-->
	<div class="row mb-20">
	  <div class="col-md-12">
		<!-- Stacked area chart -->
			<div class="panel panel-flat shadow boxshadowbig ">
				<div class="panel-heading">
					<h5 class="panel-title">Rating Breakdown Over Time</h5>
				</div>
				<div class="panel-body">
					<div class="chart-container">
						<div class="chart has-fixed-height" id="stacked_lines"></div>
					</div>
				</div>
			</div>
			<!-- /stacked area chart -->
	  </div>
	</div>
        
</div>	
</div>		

					
				
</div>
<!-- /page content -->

<script type="text/javascript">
	

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

            var stacked_lines = ec.init(document.getElementById('stacked_lines'), limitless);
            



            // Charts setup
            // ------------------------------

          


           //
            // Stacked lines options
            //

            stacked_lines_options = {

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
                    data: ['5 Star', '4 Star', '3 Star', '2 Star', '1 Star']
                },

                // Enable drag recalculate
                calculable: true,

                // Hirozontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [
                        '2AM', '6AM', '11AM', '2PM', '5Pm', '8PM', '11PM'
                    ]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: '5 Star',
                        type: 'line',
                        stack: 'Total',
                        data: [120, 132, 101, 134, 90, 230, 210]
                    },
                    {
                        name: '4 Star',
                        type: 'line',
                        stack: 'Total',
                        data: [220, 182, 191, 234, 290, 330, 310]
                    },
                    {
                        name: '3 Star',
                        type: 'line',
                        stack: 'Total',
                        data: [150, 232, 201, 154, 190, 330, 410]
                    },
                    {
                        name: '2 Star',
                        type: 'line',
                        stack: 'Total',
                        data: [320, 332, 301, 334, 390, 330, 320]
                    },
                    {
                        name: '1 Star',
                        type: 'line',
                        stack: 'Total',
                        data: [820, 932, 901, 934, 1290, 1330, 1320]
                    }
                ]
            };


         


          


       
			

           


            // Apply options
            // ------------------------------

          
            stacked_lines.setOption(stacked_lines_options);
			
           



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function () {
                    stacked_lines.resize();
					
                }, 200);
            }
        }
    );
});

</script>
		
<script>			

 // Initialize chart
    progressArcMulti("#arc_multi", 78, 700);

    // Chart setup
    function progressArcMulti(element, size, goal) {

        // Main variables
        var d3Container = d3.select(element),
            radius = size,
            thickness = 20,
            startColor = '#66BB6A',
            midColor = '#FFA726',
            endColor = '#EF5350';

        // Colors
        var color = d3.scale.linear()
            .domain([0, 70, 100])
            .range([startColor, midColor, endColor]);


        // Create chart
        // ------------------------------

        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
            .attr('width', radius * 2)
            .attr('height', radius + 20);


        // Construct chart layout
        // ------------------------------

        // Pie
        var arc = d3.svg.arc()
            .innerRadius(radius - thickness)
            .outerRadius(radius)
            .startAngle(-Math.PI / 2);


        // Append chart elements
        // ------------------------------

        //
        // Group arc elements
        //

        // Group
        var chart = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + radius + ')');

        // Background
        var background = chart.append('path')
            .datum({
                endAngle: Math.PI / 2
            })
            .attr({
                'd': arc,
                'fill': '#eee'
            });

        // Foreground
        var foreground = chart.append('path')
            .datum({
                endAngle: -Math.PI / 2
            })
            .style('fill', startColor)
            .attr('d', arc);

        // Counter value
        var value = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius * 0.9) + ')')
            .append('text')
            .text(0 + '%')
            .attr({
                'text-anchor': 'middle',
                'fill': '#555'
            })
            .style({
                'font-size': 19,
                'font-weight': 400
            });


        //
        // Min and max text
        //

        // Group
        var scale = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius + 15) + ')')
            .style({
                'font-size': 12,
                'fill': '#999'
            });

        // Max
        scale.append('text')
            .text(100)
            .attr({
                'text-anchor': 'middle',
                'x': (radius - thickness / 2)
            });

        // Min
        scale.append('text')
            .text(0)
            .attr({
                'text-anchor': 'middle',
                'x': -(radius - thickness / 2)
            });


        //
        // Animation
        //

        // Interval
        setInterval(function() {
            update(Math.random() * 100);
        }, 1500);

        // Update
        function update(v) {
            v = d3.format('.0f')(v);
            foreground.transition()
                .duration(750)
                .style('fill', function() {
                    return color(v);
                })
                .call(arcTween, v);

            value.transition()
                .duration(750)
                .call(textTween, v);
        }

        // Arc
        function arcTween(transition, v) {
            var newAngle = v / 100 * Math.PI - Math.PI / 2;
            transition.attrTween('d', function(d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);
                };
            });
        }

        // Text
        function textTween(transition, v) {
            transition.tween('text', function() {
                var interpolate = d3.interpolate(this.innerHTML, v),
                    split = (v + '').split('.'),
                    round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
                return function(t) {
                    this.innerHTML = d3.format('.0f')(Math.round(interpolate(t) * round) / round) + '<tspan>%</tspan>';
                };
            });
        }
    }
	

	
	
	  // Progress arc - single color
    // ------------------------------

    // Initialize chart
	progressArcSingle("#arc_single2", 78);

    // Chart setup
    function progressArcSingle(element, size) {

        // Main variables
        var d3Container = d3.select(element),
            radius = size,
            thickness = 20,
            color = '#29B6F6';


        // Create chart
        // ------------------------------

        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
            .attr('width', radius * 2)
            .attr('height', radius + 20)
            .attr('class', 'gauge');


        // Construct chart layout
        // ------------------------------

        // Pie
        var arc = d3.svg.arc()
            .innerRadius(radius - thickness)
            .outerRadius(radius)
            .startAngle(-Math.PI / 2);


        // Append chart elements
        // ------------------------------

        //
        // Group arc elements
        //

        // Group
        var chart = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + radius + ')');

        // Background
        var background = chart.append('path')
            .datum({
                endAngle: Math.PI / 2
            })
            .attr({
                'd': arc,
                'fill': '#eee'
            });

        // Foreground
        var foreground = chart.append('path')
            .datum({
                endAngle: -Math.PI / 2
            })
            .style('fill', color)
            .attr('d', arc);

        // Counter value
        var value = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius * 0.9) + ')')
            .append('text')
            .text(0 + '%')
            .attr({
                'text-anchor': 'middle',
                'fill': '#555'
            })
            .style({
                'font-size': 19,
                'font-weight': 400
            });


        //
        // Min and max text
        //

        // Group
        var scale = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius + 15) + ')')
            .style({
                'font-size': 12,
                'fill': '#999'
            });

        // Max
        scale.append('text')
            .text(100)
            .attr({
                'text-anchor': 'middle',
                'x': (radius - thickness / 2)
            });

        // Min
        scale.append('text')
            .text(0)
            .attr({
                'text-anchor': 'middle',
                'x': -(radius - thickness / 2)
            });


        //
        // Animation
        //

        // Interval
        setInterval(function() {
            update(Math.random() * 100);
        }, 1500);

        // Update
        function update(v) {
            v = d3.format('.0f')(v);
            foreground.transition()
                .duration(750)
                .call(arcTween, v);

            value.transition()
                .duration(750)
                .call(textTween, v);
        }

        // Arc
        function arcTween(transition, v) {
            var newAngle = v / 100 * Math.PI - Math.PI / 2;
            transition.attrTween('d', function(d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);
                };
            });
        }

        // Text
        function textTween(transition, v) {
            transition.tween('text', function() {
                var interpolate = d3.interpolate(this.innerHTML, v),
                    split = (v + '').split('.'),
                    round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
                return function(t) {
                    this.innerHTML = d3.format('.0f')(Math.round(interpolate(t) * round) / round) + '<tspan>%</tspan>';
                };
            });
        }
    }

  
	 // Pie with progress bar
    // ------------------------------

    // Initialize chart
    pieWithProgress("#pie_progress_bar", 100);
	pieWithProgress("#pie_progress_bar2", 100);

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