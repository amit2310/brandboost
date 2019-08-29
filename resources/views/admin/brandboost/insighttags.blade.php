@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

<script src = "https://code.highcharts.com/highcharts.js"></script>
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
                <h3><img style="width: 16px;" src="/assets/images/analysis_icon.png"> Insight Tags</h3>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Services</h6>
                                    <div class="heading-elements"><a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a></div>
                                </div>
                                <div class="panel-body p0 pb10 min_h270" >
                                    <div class="semi_circle_smiley"><img src="{{ base_url() }}assets/images/service_icon.png"/></div>
                                    <div id = "semi_circle_chart" class="br5" style = "width: 100%; height: 240px; "></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">


                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Resolution</h6>
                                    <div class="heading-elements"><a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a></div>
                                </div>
                                <div class="panel-body p0 pb10 min_h270" >
                                    <div class="semi_circle_smiley"><img src="{{ base_url() }}assets/images/resolution_icon.png"/></div>
                                    <div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 240px;"></div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Queries</h6>
                                    <div class="heading-elements"><a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a></div>
                                </div>
                                <div class="panel-body p0 pl20 pr20 min_h270 bkg_white">
                                    <div class="p20 pl0 topchart_value">
                                        <div class="row">
                                            <div class="col-xs-4 brig">
                                                <h1 class="m0">1.320</h1>
                                                <p>Services <span style="border: none;" class="label ">5.9%</span></p>
                                            </div>
                                            <div class="col-xs-4">
                                                <h1 class="m0">967</h1>
                                                <p>Queries <span style="border: none;" class="label bkg_green">5.9%</span></p>
                                            </div>

                                        </div>
                                    </div>


                                    <div id="column_graph" style="height: 185px;"></div>
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
                            <h6 class="panel-title">Insight Tag Acticity</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>
                                <div class="table_action_tool">
                                    <a href="#"><i class="icon-calendar52"></i></a>
                                    <a href="#"><i class="icon-arrow-down16"></i></a>
                                    <a href="#"><i class="icon-arrow-up16"></i></a>
                                    <a href="#"><i class="icon-pencil"></i></a>
                                </div>

                            </div>
                        </div>
                        <div class="panel-body p0">
                            @php
                            $getUserTag = getUserTag();
                            @endphp
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th>Name</th>
                                        <th>Tag</th>
                                        <th>Total Feedback</th>
                                        <th>Tagged Percentage</th>
                                        <th>Created</th>
                                       <!--  <th>Mentions</th>
                                        <th>Coverage %</th>
                                        <th>Average Rating</th>
                                        <th>Sentiment %</th>
                                        <th>Snippets</th> -->


                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    if (!empty($getUserTag)) {
                                        $totalTagCount = count(getTags());
                                        //pre($getUserTag);
                                        foreach ($getUserTag as $value) {
                                            if (!empty($value->tag_name)) {

                                                $numberOfTagInGroup = numberOfTagInGroup($value->id);
                                                $totalTagInGroup = count($numberOfTagInGroup);
                                                $getTagFeedback = getTagFeedback($value->tagid);
                                                //pre($numberOfTagInGroup);
                                                if (!empty($getTagFeedback)) {

                                                    $tagCount = count($getTagFeedback);
                                                } else {

                                                    $tagCount = '<span style="color:#999999">No Data</span>';
                                                }

                                                if ($tagCount > 0 && $totalTagCount > 0) {

                                                    $getPercentage = round(($tagCount / $totalTagInGroup) * 100) . '%';
                                                } else {

                                                    $getPercentage = '<span style="color:#999999">No Data</span>';
                                                }
                                                
                                            }
                                        }
                                    }
                                    @endphp
                                    <!--================================================-->
                                    @php
                                    if (!empty($getUserTag)) {
                                        $totalTagCount = count(getTags());
                                        //pre($getUserTag);
                                        foreach ($getUserTag as $value) {
                                            if (!empty($value->tag_name)) {

                                                $numberOfTagInGroup = numberOfTagInGroup($value->id);
                                                $totalTagInGroup = count($numberOfTagInGroup);
                                                $getTagFeedback = getTagFeedback($value->tagid);
                                                //pre($numberOfTagInGroup);
                                                if (!empty($getTagFeedback)) {

                                                    $tagCount = count($getTagFeedback);
                                                } else {

                                                    $tagCount = '<span style="color:#999999">No Data</span>';
                                                }

                                                if ($tagCount > 0 && $totalTagCount > 0) {

                                                    $getPercentage = round(($tagCount / $totalTagInGroup) * 100) . '%';
                                                } else {

                                                    $getPercentage = '<span style="color:#999999">No Data</span>';
                                                }
                                                @endphp
                                                <tr>
                                                    <td style="display: none;"></td>
                                                    <td style="display: none;">{{ date('m/d/Y', strtotime($value->tag_created)) }}</td>
                                                    <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">{{ $value->group_name }}</a> </div>
                                                        </div></td>
                                                    <td><span class="txt_dgrey">{{ $value->tag_name }}</span></td>
                                                    <td><span class="txt_dgrey">{{ $tagCount }}</span></td>
                                                    <td><span class="txt_dgrey">{{ $getPercentage }}</span></td>
                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date(' d M, Y', strtotime($value->tag_created)) }}</a></div>
                                                            <div class="text-muted text-size-small">{{ date('h:i A', strtotime($value->tag_created)) . ' (' . timeAgo($value->tag_created) . ')' }}</div>
                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                                @php
                                            }
                                        }
                                    }
                                    @endphp
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


    $(document).ready(function () {
        var chart = {
            plotBackgroundColor: false,
            plotBorderWidth: 0,
            plotShadow: false
        };
        var title = {
            text: '83% <br> <span style="border: none;" class="label bkg_green ml0 ">15.9%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        };

        var title2 = {
            text: '52% <br> <span style="border: none;" class="label bkg_green ml0 ">22.9%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        };


        var tooltip = {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        };
        var plotOptions = {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -5550,

                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        };
        var series = [{
                type: 'pie',
                name: 'NPS',
                colors: ['#28adc5', '#bae2ea', '#8bbc21', '#910000'],
                innerSize: '85%',
                data: [
                    ['A', 52],
                    ['B', 48],

                    {
                        name: 'Others',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }];


        var series2 = [{
                type: 'pie',
                name: 'NPS',
                colors: ['#28adc5', '#bae2ea', '#8bbc21', '#910000'],
                innerSize: '85%',
                data: [
                    ['A', 19],
                    ['B', 81],

                    {
                        name: 'Others',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }];



        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.series = series;
        json.plotOptions = plotOptions;
        $('#semi_circle_chart').highcharts(json);


        var json2 = {};
        json2.chart = chart;
        json2.title = title2;
        json2.tooltip = tooltip;
        json2.series = series2;
        json2.plotOptions = plotOptions;
        $('#semi_circle_chart2').highcharts(json2);





    });
</script>



<script>
    Highcharts.chart('column_graph', {
        chart: {
            type: 'column'
        },
        title: {
            text: null
        },
        subtitle: {
            text: null
        },

        colors: ['#238398', '#36b5a4', '#8bbc21', '#910000'],

        credits: {
            enabled: false
        },

        backgroundColor: null,

        xAxis: {
            categories: [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                '11',
                '12'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            uniqueNames: false,
            title: {
                text: null
            }
        },

        plotOptions: {
            column: {
                pointPadding: 0.25,
                borderWidth: 0,
                borderRadius: 5
            }
        },

        series: [{
                showInLegend: false,
                name: 'A',
                data: [39.9, 31.5, 26.4, 19.2, 24.0, 36.0, 35.6, 38.5, 16.4, 14.1, 35.6, 24.4]

            }, {
                showInLegend: false,
                name: 'B',
                data: [33.6, 38.8, 38.5, 23.4, 26.0, 34.5, 35.0, 14.3, 21.2, 33.5, 36.6, 12.3]

            }]
    });



</script>
@endsection