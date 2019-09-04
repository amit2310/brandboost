@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

<script src = "https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript" src="{{ base_url() }}assets/js/vega.js"></script>


<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}

    #amit { margin: 0 auto; height: 250px;}


</style>

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 16px;" src="/assets/images/analysis_icon.png"> Response Report</h3>
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
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email Open Rate</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h270 bkg_white" >
                            <div class="semi_circle_smiley"><img src="/assets/images/smiley_red.png"/></div>
                            <div id = "semi_circle_chart" class="br5" style = "width: 100%; height: 240px; "></div>
                        </div>
                    </div>


                </div>




                <div class="col-md-3">


                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email Clicks</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h270 bkg_white" >
                            <div class="semi_circle_smiley"><img src="/assets/images/smiley_green.png"/></div>
                            <div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 240px;"></div>
                        </div>
                    </div>
                </div>





                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Reviews Requests</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <!--<div class="panel-body p20 pb0 bkg_white">
                        <div id="column_graph" style="height: 375px;"></div>
                        </div>-->
                        <div class="panel-body p0 min_h270 bkg_white">
                            <div class="p20 pb0 topchart_value">
                                <div class="row">
                                    <div class="col-xs-4 brig">
                                        <h1 class="m0">1.320</h1>
                                        <p>Sent <span class="label ">5.9%</span></p>
                                    </div>
                                    <div class="col-xs-4 brig">
                                        <h1 class="m0">967</h1>
                                        <p>Opened <span class="label ">5.9%</span></p>
                                    </div>
                                    <div class="col-xs-4">
                                        <h1 class="m0">372</h1>
                                        <p>Clicked <span class="label ">5.9%</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p20 pt0" id="stacked-area-chart"></div>
                        </div>
                    </div>
                </div>

            </div>



            <!--====Table====-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Montly Reviews Report</h6>
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
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-calendar"></i>Date</th>


                                        <th><i class="fa fa-smile-o"></i>Sent</th>
                                        <th><i class="fa fa-smile-o"></i>Failed</th>
                                        <th><i class="fa fa-smile-o"></i>Opens</th>
                                        <th><i class="fa fa-smile-o"></i>Clicks</th>
                                        <th><i class="fa fa-smile-o"></i>Feedback</th>




                                        <th><i class="fa fa-smile-o"></i>5</th>
                                        <th><i class="fa fa-smile-o"></i>4</th>
                                        <th><i class="fa fa-smile-o"></i>3</th>
                                        <th><i class="fa fa-smile-o"></i>2</th>
                                        <th><i class="fa fa-smile-o"></i>1</th>


                                        <th>Avarage</th>
                                        <th>Negative</th>
                                        <th>Positive</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <!--================================================-->

                                    @php
                                    for ($inc = 0; $inc < 300; $inc++) {
                                        $getDate = date('M d,Y', strtotime(' -' . $inc . ' day'));
                                        $emailSend = emailSend($getDate);
                                        $emailFailed = emailFailed($getDate);
                                        $emailOpen = emailOpen($getDate);
                                        $formOpen = formOpen($getDate);
                                        $feedbackReview = feedbackReview($getDate);
                                        $fiveRating = fiveRating($getDate);
                                        $threeRating = threeRating($getDate);
                                        $oneRating = oneRating($getDate);
                                        $ratingArray = array();

                                        if (!empty($emailSend)) {
                                            $emailSendCount = count($emailSend);
                                        } else {
                                            $emailSendCount = '<span style="color:#999999">No Data</span>';
                                        }

                                        if (!empty($emailFailed)) {
                                            $emailFailedCount = count($emailFailed);
                                        } else {
                                            $emailFailedCount = '<span style="color:#999999">No Data</span>';
                                        }

                                        if (!empty($emailOpen)) {
                                            $emailOpenCount = count($emailOpen);
                                        } else {
                                            $emailOpenCount = '<span style="color:#999999">No Data</span>';
                                        }

                                        if (!empty($formOpen)) {
                                            $formOpenCount = count($formOpen);
                                        } else {
                                            $formOpenCount = '<span style="color:#999999">No Data</span>';
                                        }

                                        if (!empty($feedbackReview)) {
                                            $feedbackReviewCount = count($feedbackReview);
                                        } else {
                                            $feedbackReviewCount = '<span style="color:#999999">No Data</span>';
                                        }

                                        if (!empty($fiveRating)) {
                                            $fiveRatingCount = count($fiveRating);
                                            $ratingArray['5'] = $fiveRatingCount;
                                        } else {
                                            //$fiveRatingCount = '<span style="color:#999999">No Data</span>';
                                            $fiveRatingCount = 0;
                                        }

                                        $fourRatingCount = 0;

                                        if (!empty($threeRating)) {
                                            $threeRatingCount = count($threeRating);
                                            $ratingArray['3'] = $threeRatingCount;
                                        } else {
                                            $threeRatingCount = 0;
                                        }

                                        $twoRatingCount = 0;

                                        if (!empty($oneRating)) {
                                            $oneRatingCount = count($oneRating);
                                            $ratingArray['1'] = $oneRatingCount;
                                        } else {
                                            $oneRatingCount = 0;
                                        }

                                        $averageRating = 0;

                                        $totalValCount = count($ratingArray);
                                        $totalAll = 0;
                                        $totalValAll = 0;
                                        foreach ($ratingArray as $key => $value) {
                                            $total = $key * $value;
                                            $totalAll += $total;
                                            $totalValAll += $value;
                                        }

                                        if ($totalAll > 0 && $totalValAll > 0) {
                                            $averageRating = ceil($totalAll / $totalValAll);
                                        }
                                        @endphp
                                        <tr>
                                            <td style="display: none;">{{ $inc }}</td>
                                            <td style="display: none;">{{ strtotime($getDate) }}</td>
                                            <td>
                                                <div class="media-left media-middle"> 
                                                    <a class="icons br5" href="#"><i class="icon-envelop br5 txt_teal"></i></a>
                                                </div>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">{{ $getDate }}</a> </div>
                                                </div>
                                            </td>
                                            <td><span class="txt_dgrey">{{ $emailSendCount }}</span></td>
                                            <td><span class="txt_dgrey">{{ $emailFailedCount }}</span> <!-- <span class="text-muted">% 96</span> --></td>
                                            <td><span class="txt_dgrey">{{ $emailOpenCount }}</span> <!-- <span class="text-muted">% 80</span> --></td>
                                            <td><span class="txt_dgrey">{{ $formOpenCount }}</span> <!-- <span class="text-muted">% 58</span> --></td>
                                            <td><span class="txt_dgrey">{{ $feedbackReviewCount }}</span> <!-- <span class="text-muted">% 65</span> --></td>


                                            <td><span class="txt_green">{{ $fiveRatingCount }}</span></td>
                                            <td><span class="txt_green">{{ $fourRatingCount }}</span></td>
                                            <td><span class="txt_dgrey">{{ $threeRatingCount }}</span></td>
                                            <td><span class="txt_red">{{ $twoRatingCount }}</span></td>
                                            <td><span class="txt_red">{{ $oneRatingCount }}</span></td>

                                            <td><span class="txt_dgrey">{{ $averageRating }}</span></td>
                                            <td><span class="txt_dgrey">{{ $oneRatingCount }}</span></td>
                                            <td><span class="txt_dgrey">{{ $fiveRatingCount }}</span></td>
                                        </tr>

                                        @php
                                    }
                                    @endphp

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

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
            text: '83 <br> <span style="border: none;" class="label bkg_green ml0 ">15.9%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        };

        var title2 = {
            text: '52 <br> <span style="border: none;" class="label bkg_green ml0 ">22.9%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
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
                colors: ['#fd6c81', '#facfd7', '#8bbc21', '#910000'],
                innerSize: '85%',
                data: [
                    ['A', 83],
                    ['B', 17],

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
                colors: ['#5ad491', '#c8eedb', '#8bbc21', '#910000'],
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
//Area Graph start vega.js

    var spec = {
        "width": 700,
        "height": 140,
        "padding": 0,

        "data": [
            {
                "name": "table",
                "values": [
                    {"x": 0, "y": 05, "c": 0},
                    {"x": 0, "y": 10, "c": 1},
                    {"x": 0, "y": 20, "c": 2},
                    {"x": 1, "y": 20, "c": 0},
                    {"x": 1, "y": 25, "c": 1},
                    {"x": 1, "y": 45, "c": 2},
                    {"x": 2, "y": 30, "c": 0},
                    {"x": 2, "y": 35, "c": 1},
                    {"x": 2, "y": 52, "c": 2},
                    {"x": 3, "y": 40, "c": 0},
                    {"x": 3, "y": 45, "c": 1},
                    {"x": 3, "y": 59, "c": 2},
                    {"x": 4, "y": 70, "c": 0},
                    {"x": 4, "y": 85, "c": 1},
                    {"x": 4, "y": 76, "c": 2},
                    {"x": 5, "y": 60, "c": 0},
                    {"x": 5, "y": 65, "c": 1},
                    {"x": 5, "y": 85, "c": 2},
                    {"x": 6, "y": 70, "c": 0},
                    {"x": 6, "y": 75, "c": 1},
                    {"x": 6, "y": 95, "c": 2},
                    {"x": 7, "y": 80, "c": 0},
                    {"x": 7, "y": 85, "c": 1},
                    {"x": 7, "y": 185, "c": 2},
                    {"x": 8, "y": 90, "c": 0},
                    {"x": 8, "y": 95, "c": 1},
                    {"x": 8, "y": 55, "c": 2},
                    {"x": 9, "y": 100, "c": 0},
                    {"x": 9, "y": 115, "c": 1},
                    {"x": 9, "y": 155, "c": 2},
                            /*{"x": 10, "y": 155, "c":0}, 
                             {"x": 10, "y": 155, "c":1},
                             {"x": 10, "y": 165, "c":2},
                             {"x": 11, "y": 20, "c":0}, 
                             {"x": 11, "y": 25, "c":1},
                             {"x": 11, "y": 45, "c":2},
                             {"x": 12, "y": 30, "c":0}, 
                             {"x": 12, "y": 35, "c":1},
                             {"x": 12, "y": 52, "c":2},
                             {"x": 13, "y": 40, "c":0}, 
                             {"x": 13, "y": 45, "c":1},
                             {"x": 13, "y": 59, "c":2},
                             {"x": 14, "y": 70, "c":0}, 
                             {"x": 14, "y": 85, "c":1},
                             {"x": 14, "y": 76, "c":2},
                             {"x": 15, "y": 60, "c":0}, 
                             {"x": 15, "y": 65, "c":1},
                             {"x": 15, "y": 85, "c":2},
                             {"x": 16, "y": 70, "c":0}, 
                             {"x": 16, "y": 75, "c":1},
                             {"x": 16, "y": 95, "c":2},
                             {"x": 17, "y": 80, "c":0}, 
                             {"x": 17, "y": 85, "c":1},
                             {"x": 17, "y": 185, "c":2},
                             {"x": 18, "y": 90, "c":0}, 
                             {"x": 18, "y": 95, "c":1},
                             {"x": 18, "y": 55, "c":2},
                             {"x": 19, "y": 100, "c":0}, 
                             {"x": 19, "y": 115, "c":1},
                             {"x": 19, "y": 155, "c":2}*/



                ],
                "transform": [
                    {
                        "type": "stack",
                        "groupby": ["x"],
                        "sort": {"field": "c"},
                        "field": "y"
                    }
                ]
            }
        ],

        "scales": [
            {
                "name": "x",
                "type": "point",
                "range": "width",
                "domain": {"data": "table", "field": "x"}
            },
            {
                "name": "y",
                "type": "linear",
                "range": "height",
                "nice": true, "zero": true,
                "domain": {"data": "table", "field": "y1"}
            },
            {
                "name": "color",
                "type": "ordinal",
                "range": "category",
                "domain": {"data": "table", "field": "c"}
            }
        ],

        "axes": [
            {"orient": "bottom", "scale": "x", "zindex": 1}//,
//{//"orient": "left", "scale": "y", "zindex": 1}
        ],

        "marks": [
            {
                "type": "group",
                "from": {
                    "facet": {
                        "name": "series",
                        "data": "table",
                        "groupby": "c"
                    }
                },
                "marks": [
                    {
                        "type": "area",
                        "from": {"data": "series"},
                        "encode": {
                            "enter": {
                                "interpolate": {"value": "monotone"},
                                "x": {"scale": "x", "field": "x"},
                                "y": {"scale": "y", "field": "y0"},
                                "y2": {"scale": "y", "field": "y1"},
                                "fill": {"scale": "color", "field": "c"}
                            },
                            "update": {
                                "fillOpacity": {"value": 1}
                            },
                            "hover": {
                                "fillOpacity": {"value": 0.5}
                            }
                        }
                    }
                ]
            }
        ]
    }
    ;


    var view = new vega.View(vega.parse(spec), {
        renderer: 'canvas'
    }).initialize('#stacked-area-chart').hover().run();

//Area Graph end vega.js



</script>



<script>

    var chart = Highcharts.chart('amit', {

        title: {
            text: null
        },

        credits: {
            enabled: false
        },

        colors: ['#9b83ff', '#ded6fd', '#8bbc21', '#910000'],

        subtitle: {
            text: null
        },

        plotOptions: {
            column: {
                borderRadius: 5
            }
        },

        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },

        yAxis: {
            min: 0,
            uniqueNames: false,
            /*labels: {
             enabled: false
             },
             */
            title: {
                text: null
            }
        },

        series: [{
                type: 'column',
                colorByPoint: true,
                data: [329.9, 171.5, 306.4, 129.2, 444.0, 176.0, 135.6, 148.5, 516.4, 194.1, 95.6, 654.4],
                showInLegend: false
            }]

    });


    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: null
            }
        });
    });



</script>

@endsection