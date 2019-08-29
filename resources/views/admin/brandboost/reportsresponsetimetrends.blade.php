@php error_reporting(0); @endphp
   @extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

    <script src = "https://code.highcharts.com/highcharts.js"></script>
    
    <!-- /theme JS files -->

    @php 
        
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
    @endphp
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
          <h3><img style="width: 16px;" src="{{ base_url() }}assets/images/analysis_icon.png"> Response Time Trends</h3>
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
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/smiley_red.png"/>
                <h1 class="m0">{{ $negTime }}</h1>
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
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/timer_icon.png"/>
                <h1 class="m0">{{ $posTime }}</h1>
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
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/timer_icon.png"/>
                <h1 class="m0">{{ $busyTime }}</h1>
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
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/smiley_green.png"/>
                <h1 class="m0">{{ $posTime }}</h1>
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
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/smiley_green.png"/>
                <h1 class="m0">136</h1>
                <p class="txt_green">61.8%</p>
                </div>
                
                <div class="col-xs-2">
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/smiley_green.png"/>
                <h1 class="m0">121</h1>
                <p class="txt_green">28.8%</p>
                </div>
                <div class="col-xs-2">
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/smiley_grey2.png"/>
                <h1 class="m0">74</h1>
                <p class="txt_grey">69.8%</p>
                </div>
                <div class="col-xs-2">
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/smiley_red.png"/>
                <h1 class="m0">39</h1>
                <p class="txt_red">56.8%</p>
                </div>
                <div class="col-xs-2">
                <img class="pull-left mr20" src="{{ base_url() }}assets/images/smiley_red.png"/>
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
@endsection