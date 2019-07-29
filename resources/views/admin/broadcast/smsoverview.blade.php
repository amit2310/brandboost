@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<link href="<?php echo base_url(); ?>assets/css/percircle.css" rel="stylesheet" type="text/css">
<script src = "<?php echo base_url(); ?>assets/js/percircle.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script type="text/javascript" src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
<script type="text/javascript" src="http://www.chartjs.org/samples/latest/utils.js"></script>
<style>
    #canvas{max-height: 290px;}

</style>

<script src = "https://code.highcharts.com/highcharts.js"></script>



<style>
    .outer_circle{padding: 14px; background: #fff; border: 1.5px solid #eee; margin: 0 auto!important; border-radius: 100%; width: 200px; height: 200px;}
    #bluecircle{margin: 0 auto!important; float: none!important; cursor: pointer; }
    path[stroke-width="0.5"]{   stroke: #eeeeee!important;  opacity: 0; }
    #myfirstchart{background: url(<?php echo base_url('assets/'); ?>images/graphbkg.png) left top repeat!important;}
    .min_h310{min-height: 300px;}



    .pie, .c100 .bar, .c100.p51 .fill, .c100.p52 .fill, .c100.p53 .fill, .c100.p54 .fill, .c100.p55 .fill, .c100.p56 .fill, .c100.p57 .fill, .c100.p58 .fill, .c100.p59 .fill, .c100.p60 .fill, .c100.p61 .fill, .c100.p62 .fill, .c100.p63 .fill, .c100.p64 .fill, .c100.p65 .fill, .c100.p66 .fill, .c100.p67 .fill, .c100.p68 .fill, .c100.p69 .fill, .c100.p70 .fill, .c100.p71 .fill, .c100.p72 .fill, .c100.p73 .fill, .c100.p74 .fill, .c100.p75 .fill, .c100.p76 .fill, .c100.p77 .fill, .c100.p78 .fill, .c100.p79 .fill, .c100.p80 .fill, .c100.p81 .fill, .c100.p82 .fill, .c100.p83 .fill, .c100.p84 .fill, .c100.p85 .fill, .c100.p86 .fill, .c100.p87 .fill, .c100.p88 .fill, .c100.p89 .fill, .c100.p90 .fill, .c100.p91 .fill, .c100.p92 .fill, .c100.p93 .fill, .c100.p94 .fill, .c100.p95 .fill, .c100.p96 .fill, .c100.p97 .fill, .c100.p98 .fill, .c100.p99 .fill, .c100.p100 .fill {border: 0.08em solid #4ebc86;}
    .c100:hover > span {color: #4ebc86;}

    #circle2 {width: 165px; height: 165px;margin: 0 auto;}
    .loader2 {width: calc(100% - 0px);height: calc(100% - 0px); border: 9px solid #ebeff6;  border-top: 9px solid #ebeff6;  border-radius: 50%; animation: rotate 20s linear infinite;  padding: 14px;
              cursor: pointer; position: relative;}
    .loader2.yellow{border-top: 9px solid #4ebc86}
    .loader2.red{border-top: 9px solid #127f84}
    @keyframes rotate {
        100% {transform: rotate(360deg);}
    } 

    .highcharts-tick{stroke:none!important}
    .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    .highcharts-yaxis-labels{display: none!important;}
    #canvas2{height: 200px!important; padding: 0 25px !important;}
    .highcharts-grid, .highcharts-axis-line {   display: none;}


</style>

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><img style="width: 15px;" src="<?php echo base_url(); ?>assets/images/sms_icon.png"> SMS Overview</h3>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
                <button type="button" class="btn dark_btn mr20" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3 txt_green"></i><span> &nbsp;  SMS Broadcast</span> </button>
                <button type="button" class="btn dark_btn" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3 txt_green"></i><span> &nbsp;  SMS Campaign</span> </button>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <?php
    $currMonDate = array();
    $newSmsO = array();

    $smsArr = array();
    if ($smsDetailNPS->isNotEmpty()) {
        $smsArr = $smsDetailNPS;
    }

    if ($smsDetailAutomation->isNotEmpty()) {
        $smsArr = $smsArr->merge($smsDetailAutomation);
    }

    if ($smsDetailSubs->isNotEmpty()) {
        $smsArr = $smsArr->merge($smsDetailSubs);
    }

    if ($smsDetailReferral->isNotEmpty()) {
        $smsArr = $smsArr->merge($smsDetailReferral);
    }

    if ($smsDetailChat->isNotEmpty()) {
        $smsArr = $smsArr->merge($smsDetailChat);
    }


    $delivered = 0;
    $undelivered = 0;
    $sent = 0;

    foreach ($smsArr as $key => $value) {

        if (!empty($value->event_name)) {
            if ($value->event_name == 'delivered') {
                $delivered++;
            } else if ($value->event_name == 'undelivered') {
                $undelivered++;
            } else if ($value->event_name == 'sent') {
                $sent++;
            } else {
                $delivered++;
            }
        } else {
            $delivered++;
        }


        $getMon = @date('m', strtotime($value->created));
        $getDate = @date('j M Y', strtotime($value->created));
        $getDate = strtotime($getDate);

        if (array_key_exists($getDate, $newSmsO)) {
            $newSmsO[$getDate] = $newSmsO[$getDate] + 1;
        } else {
            $newSmsO[$getDate] = 1;
        }
    }

    ksort($newSmsO);
    $dSmsOri = array();
    $mainarr = array();
    foreach ($newSmsO as $key => $value) {
        $shArr = array();
        $shArr['y'] = date('j M Y', $key);
        $shArr['a'] = $value;
        $mainarr[] = (object) $shArr;
    }
    $mainArrShow = json_encode($mainarr);
    ?>

    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">


            <div class="row">
                <div class="col-md-8 ">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">SMS</h6>
                        </div>
                        <div class="panel-body p0 bkg_white min_h310">
                            <div class="p20 bbot">
                                <p class="txt_grey fw300 m0"><i class="fa fa-square txt_green"></i> &nbsp; SMS sent &nbsp; &nbsp; <strong class="txt_dark"></strong></p>
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
                            <h6 class="panel-title">Credits</h6>
                        </div>
                        <div class="panel-body p20 pt50 pb40 bkg_white text-center min_h310">
                            <div class="outer_circle">
                                <div id="bluecircle" class="c100 p83 medium"> <span><strong>51,913</strong> <br>
                                        EMAIL <br>CREDITS</span>
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
                            <h6 class="panel-title">SMS Report</h6>
                        </div>
                        <div class="panel-body p20 bkg_white min_h225">
                            <div class="row">
                                <div class="col-md-5 p10">
                                    <div data-toggle="tooltip" title="" data-placement="top" data-original-title="Marketing Activity" id="circle2">
                                        <div title="8.5%" class="loader2">
                                            <div title="65%" class="loader2 yellow">
                                                <div title="23%" class="loader2 red">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-7">
                                    <ul class="onsite_list mt30">
                                        <li class="bor_n"><span><img src="<?php echo base_url(); ?>assets/images/green_circle1.png" width="10"> Delivered</span><strong class="txt_dark"><?php echo $delivered; ?></strong></li>
                                        <!--<li><span><img src="assets/images/circle_blue2.png" width="10"> Open</span><strong class="txt_dark">58,6%</strong></li>-->
                                        <li><span><img src="<?php echo base_url(); ?>assets/images/green_circle2.png" width="10"> Undelivered</span><strong class="txt_dark"><?php echo $undelivered; ?></strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">SMS Subscribe Widget</h6>
                        </div>
                        <div class="panel-body p0 bkg_white min_h225">
                            <div class="p20 bbot">
                                <p class="txt_grey fw300 m0"><i class="fa fa-square txt_green"></i> &nbsp; Subsrcibe &nbsp; &nbsp; <strong class="txt_dark">51,913</strong></p>
                            </div>
                            <div class="p0 text-center">
                              <!--<img style="max-width: 80%; display: inline-block;" class="img-responsive" src="assets/images/sms_chart.png">-->
                                <div id="linechart_a" style="min-width: 300px; height: 155px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            @include('admin.modules.emails.email-table')

        </div>

    </div>



</div>

<script>

    Morris.Area({
        element: 'myfirstchart',
        parseTime: false,

        /*data: sendSms,*/
        data: <?php echo $mainArrShow; ?>,

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
        lineColors: ['#4ebc86', '#0c265a'],

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
                borderRadius: 5,
                states: {
                    hover: {
                        color: '#4ebc86'
                    }
                }
            }
        },

        colors: ['#dfe5f0', '#000000'],
        tooltip: {
            pointFormat: '<b>{point.y:.1f}</b>'
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
                    ['16', 18.7],
                    ['17', 14.2],
                    ['18', 3.8],
                    ['19', 2.9],
                    ['20', 16.7],
                    ['21', 9.1],
                    ['22', 18.7],
                    ['23', 15.4],
                    ['24', 14.2],
                    ['25', 3.8],
                    ['26', 2.9],
                    ['27', 16.7],
                    ['28', 9.1],
                    ['29', 18.7],
                    ['30', 18.7]
                ],

            }]
    });



    var config = {
        type: 'line',
        data: {
            labels: ['1M', 'J', 'Q3', 'D7', 'KJ', 'PY', 'RD'],
            datasets: [{
                    label: 'Value',
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor()
                    ],
                    fill: false,
                }, {
                    label: 'Years',
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor()
                    ],
                }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                //stext: 'Chart.js Line Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,

                        }
                    }],
                yAxes: [{
                        display: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
            }
        }
    };

    window.onload = function () {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };





    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["R", "B", "Y", "G", "P", "O", "G", "P", "O", "R", "B", "Y"],
            datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3, 5, 2, 3, 19, 3, 5],
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,

                        }
                    }],
                yAxes: [{
                        display: false,
                        scaleLabel: {
                            display: false,

                        }
                    }]
            }
        }
    });




</script>

@endsection