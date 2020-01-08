<template>

    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-5">
                    <h3><img style="width: 16px;" src="/assets/images/live_icon2.png"> Live</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#Overview" data-toggle="tab">Overview</a></li>
                        <li><a href="#Statistic" data-toggle="tab">Statistic</a></li>
                        <li><a href="#Configuration" data-toggle="tab">Configuration</a></li>
                    </ul>
                </div>

                <!--=============Button Area Right Side==============-->
                <div class="col-md-7 text-right btn_area">

                </div>

            </div>
        </div>

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="Overview">
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Live</h6>
                            </div>
                            <div class="panel-body p0 bkg_white min_h310">
                                <div class="p20 bbot">
                                    <p class="txt_grey fw300 m0"><i class="fa fa-square txt_red"></i> &nbsp; Live users
                                        &nbsp; &nbsp; <strong class="txt_dark">160</strong></p>
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
                                    <div id="bluecircle" class="c100 p23 medium"> <span><strong>1415</strong> <br>
						ACTION <br>
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

                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Sources</h6>
                            </div>
                            <div class="panel-body bkg_white">
                                <div class="row">
                                    <div class="col-md-5 pr40 pl20 brig">
                                        <ul class="onsite_list">
                                            <li class="bnone"><span class="txt_dark"><img width="12"
                                                                                          src="/assets/images/all_icon.png"> All</span><strong>162</strong>
                                            </li>
                                            <li><span><img width="12" src="/assets/images/google_12.png"> Google</span><strong>139</strong>
                                            </li>
                                            <li><span><img width="12"
                                                           src="/assets/images/facebook_12.png"> Facebook</span><strong>23</strong>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-7 pl30">
                                        <div id="linechart_a" style="min-width: 300px; height: 170px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Average time<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                        <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                                    </div>
                                    <div class="panel-body p20 db_stats bkg_white">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="media-left pr-15">
                                                    <img class="pull-left"
                                                         src="/assets/images/clock_44_red.png">
                                                </div>
                                                <div class="media-left">
                                                    <h1>1h 4m</h1>
                                                    <p><strong class="txt_green"><i class=""><img
                                                        src="/assets/images/green_arrow.png"/></i>&nbsp;
                                                        33,87%</strong> &nbsp; <span
                                                        class="txt_dgrey">last week</span></p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-xs-12"><img style="width: 100%; height: 68px;"
                                                                        class="img-responsive mt30"
                                                                        src="/assets/images/graph_live1.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Modules<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                        <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                                    </div>
                                    <div class="panel-body p20 db_stats bkg_white">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="media-left pr-15">
                                                    <img class="pull-left"
                                                         src="/assets/images/message_red_44.png">
                                                </div>
                                                <div class="media-left">
                                                    <h1>23m</h1>
                                                    <p><strong class="txt_orange"><i class=""><img
                                                        src="/assets/images/red_down_arrow.png"></i>&nbsp;
                                                        33,87%</strong> &nbsp; <span
                                                        class="txt_dgrey">last week</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12"><img style="width: 100%; height: 66px;"
                                                                        class="img-responsive mt30"
                                                                        src="/assets/images/graph_live2.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Live Activity</h6>
                            </div>
                            <div class="panel-body p20 bkg_white min_h310"
                                 style="padding-bottom: 5px!important; min-height: 470px;">
                                <div
                                    class="p20 text-center"><!--<img style="height: 250px; margin: 0 auto;" class="img-responsive" src="/assets/images/map.png"/>-->

                                    <div style="height: 235px;" class="mapcontainer">
                                        <div class="map">
                                            <span>Alternative content for the map</span>
                                        </div>
                                        <div class="plotLegend">
                                            <span>Alternative content for the legend</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="pl10 pr20">
                                    <ul class="onsite_list">
                                        <li><span><img src="/assets/images/flags/us.png" width="16"> United States</span><strong
                                            class="txt_dark">117</strong></li>
                                        <li><span><img src="/assets/images/flags/ca.png" width="16"> Canada</span><strong
                                            class="txt_dark">32</strong></li>
                                        <li><span><img src="/assets/images/flags/gb.png" width="16"> Great Britain</span><strong
                                            class="txt_dark">19</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===========TAB 2===========-->
            <div class="tab-pane" id="Statistic">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">

                            <div class="panel-heading">
                                <h6 class="panel-title">Live Visitors</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableID="liveVisitors"
                                               placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class=""><img src="/assets/images/icon_search.png"
                                                             width="14"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img
                                            src="/assets/images/icon_refresh.png"/></i></a>
                                        <a href="#"><i class=""><img
                                            src="/assets/images/icon_calender.png"/></i></a>
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
            <div class="tab-pane" id="Configuration">
                Configuration
            </div>
        </div>
    </div>

</template>
<script>

    export default {
        props : ['pageColor'],
        data() {
            return {
                reviews: {}
            }
        },

        mounted() {
            this.$parent.pageColor = this.pageColor;
            //calling graphs
            setTimeout(function () {
                loadLiveGraphs();
            }, 50);
        }

    };
    function loadLiveGraphs() {

        Morris.Area({
            element: 'myfirstchart',
            parseTime: false,

            data: [
                {y: '01', a: 1},
                {y: '02', a: 8},
                {y: '03', a: 5},
                {y: '04', a: 12},
                {y: '05', a: 10},
                {y: '06', a: 18},
                {y: '07', a: 17},
                {y: '08', a: 12},
                {y: '09', a: 21},
                {y: '10', a: 23},
                {y: '11', a: 20},
                {y: '12', a: 25},
                {y: '13', a: 22},
                {y: '14', a: 23},
                {y: '15', a: 24},
                {y: '16', a: 25},
                {y: '17', a: 27},
                {y: '18', a: 23},
                {y: '19', a: 27},
                {y: '20', a: 29},
                {y: '21', a: 31},
                {y: '22', a: 35},
                {y: '23', a: 30},
                {y: '24', a: 35},
                {y: '25', a: 36},
                {y: '26', a: 38},
                {y: '27', a: 39},
                {y: '28', a: 42},
                {y: '29', a: 48},
                {y: '30', a: 55},
                {y: '31', a: 60}
            ],


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
            lineColors: ['#eb4f76 ', '#0c265a'],


        });

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
                plots: {
                    'paris': {
                        latitude: 48.86,
                        longitude: 2.3444,
                        value: 500000000,
                        tooltip: {content: "Paris<br/>Chats: 500000000"}
                    },
                    'newyork': {
                        latitude: 40.667,
                        longitude: -73.833,
                        value: 200000001,
                        tooltip: {content: "New york<br/>Chats: 200001"}
                    },
                    'sydney': {
                        latitude: -33.917,
                        longitude: 151.167,
                        value: 600000,
                        tooltip: {content: "Sydney<br/>Chats : 600000"}
                    },
                    'brasilia': {
                        latitude: -15.781682,
                        longitude: -47.924195,
                        value: 600000,
                        tooltip: {content: "Brasilia<br/>Chats: 200000001"}
                    },
                    'tokyo': {
                        latitude: 35.687418,
                        longitude: 139.692306,
                        value: 200001,
                        tooltip: {content: "Tokyo<br/>Chats: 200001"}
                    },
                    'delhi': {
                        latitude: 28.644800,
                        longitude: 77.216721,
                        value: 200000001,
                        tooltip: {content: "Delhi<br/>Chats: 200001"}
                    },
                    'sudan': {
                        latitude: 6.8770,
                        longitude: 31.3070,
                        value: 200001,
                        tooltip: {content: "Sudan<br/>Chats: 200001"}
                    },

                    'moscow': {
                        latitude: 55.7558,
                        longitude: 37.6173,
                        value: 600000,
                        tooltip: {content: "Moscow <br/>Chats: 200001"}
                    },

                    'indonesia': {
                        latitude: 8.3405,
                        longitude: 115.0920,
                        value: 2000000001,
                        tooltip: {content: "Indonesia<br/>Chats: 200001"}
                    },

                    'honkong': {
                        latitude: 22.286394,
                        longitude: 114.149139,
                        value: 600000,
                        tooltip: {content: "Honkong<br/>Chats: 200001"}
                    }
                },


            });
        });


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
                    ['16', 18.7]
                ],

            }]
        });
    }
</script>

<style>
    .outer_circle {
        padding: 14px;
        background: #fff;
        border: 1.5px solid #eee;
        margin: 0 auto !important;
        border-radius: 100%;
        width: 200px;
        height: 200px;
    }

    #bluecircle {
        margin: 0 auto !important;
        float: none !important;
        cursor: pointer;
    }

    path[stroke-width="0.5"] {
        stroke: #eeeeee !important;
        opacity: 0;
    }

    #myfirstchart { /*background: url(images/graphbkg.png) left top repeat!important;*/
    }

    .min_h310 {
        min-height: 300px;
    }

    .highcharts-tick {
        stroke: none !important
    }

    .highcharts-credits {
        display: none !important;
    }

    .highcharts-container, .highcharts-container svg {
        width: 100% !important;
    }

    .highcharts-yaxis-labels {
        display: none !important;
    }

    #canvas2 {
        height: 200px !important;
        padding: 0 25px !important;
    }

    .highcharts-grid, .highcharts-axis-line {
        display: none;
    }


    .mapael .mapTooltip {
        position: absolute;
        background-color: #1e70d8;
        opacity: 0.70;
        border-radius: 5px;
        padding: 10px;
        z-index: 1000;
        max-width: 200px;
        display: none;
        color: #fff;
        top: 20px !important;
    }

    .mapael .map {
        margin-top: 0px;
        height: 230px !important
    }

    .plotLegend {
        position: absolute;
        top: -50px;
        right: 10px;
        padding: 0 10px;
    }

    circle {
        opacity: 0.8
    }


    .pie, .c100 .bar, .c100.p51 .fill, .c100.p52 .fill, .c100.p53 .fill, .c100.p54 .fill, .c100.p55 .fill, .c100.p56 .fill, .c100.p57 .fill, .c100.p58 .fill, .c100.p59 .fill, .c100.p60 .fill, .c100.p61 .fill, .c100.p62 .fill, .c100.p63 .fill, .c100.p64 .fill, .c100.p65 .fill, .c100.p66 .fill, .c100.p67 .fill, .c100.p68 .fill, .c100.p69 .fill, .c100.p70 .fill, .c100.p71 .fill, .c100.p72 .fill, .c100.p73 .fill, .c100.p74 .fill, .c100.p75 .fill, .c100.p76 .fill, .c100.p77 .fill, .c100.p78 .fill, .c100.p79 .fill, .c100.p80 .fill, .c100.p81 .fill, .c100.p82 .fill, .c100.p83 .fill, .c100.p84 .fill, .c100.p85 .fill, .c100.p86 .fill, .c100.p87 .fill, .c100.p88 .fill, .c100.p89 .fill, .c100.p90 .fill, .c100.p91 .fill, .c100.p92 .fill, .c100.p93 .fill, .c100.p94 .fill, .c100.p95 .fill, .c100.p96 .fill, .c100.p97 .fill, .c100.p98 .fill, .c100.p99 .fill, .c100.p100 .fill {
        border: 0.08em solid #eb4f76;
    }

    .c100:hover > span {
        color: #eb4f76;
    }
</style>

