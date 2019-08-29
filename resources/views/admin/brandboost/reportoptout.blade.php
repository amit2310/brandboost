@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

<script src = "https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/visualization/echarts/echarts.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/charts/echarts/pies_donuts_analytics2.js"></script>

<!-- /theme JS files -->


<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
</style>

@php
$status = 0;
$getUnSub = getListSubscriber($status);
$statusA = 1;
$getSub = getListSubscriber($statusA);
@endphp

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
                                    @foreach ($getUnSub as $data)
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td style="display: none;">{{ strtotime($data->created) }}</td>
                                            <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-envelop br5 txt_teal"></i></a> </div>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">{{ date('M d, Y', strtotime($data->created)) }}</a> </div>
                                                </div></td>
                                            <td><span class="txt_dgrey">{{ $data->email }}</span></td>
                                            <td><span class="txt_dgrey">{{ $data->firstname . ' ' . $data->lastname }}</span></td>
                                            <td><span class="txt_dgrey">{{ $data->brandTitle }}</span></td>
                                        </tr>
                                    @endforeach
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

    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });

    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    });



</script>








<script>
//Semi Circle chart js -- Highcharts js plugins

    Highcharts.chart('linechart_a', {
        chart: {
            type: 'column',
            backgroundColor: 'rgba(0, 0, 0, 0)',
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

            backgroundColor: 'rgba(0, 0, 0, 0)',
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
	
@endsection