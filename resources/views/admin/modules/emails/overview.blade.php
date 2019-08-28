@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<script src = "https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
<script type="text/javascript" src="http://www.chartjs.org/samples/latest/utils.js"></script>

<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    #canvas, #canvas2{height: 203px!important;}
</style>
<?php
$iActiveCount = $iArchiveCount = 0;

if (!empty($oAutomations)) {
    foreach ($oAutomations as $oCount) {
        if ($oCount->status == 'archive') {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
?>
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><img src="<?php echo base_url(); ?>assets/images/email_icon_active.png"> Email Overview</h3>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">

                <button type="button" class="btn dark_btn mr20" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3 txt_sblue"></i><span> &nbsp;  Email Broadcast</span> </button>
                <button type="button" class="btn dark_btn" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3 txt_sblue"></i><span> &nbsp;  Email Campaign</span> </button>

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->



    <!-- Dashboard content -->

    <?php 
        $deleverArr = array();
        $bounceArr = array();
        foreach ($oEvents as $oEvent) {
            $isSMSAdded = $isEmailAdded = false;
            if (!empty($oEvent->campaign_type) && $oEvent->campaign_type == 'Email') {
                $aStats = \App\Models\Admin\Modules\EmailsModel::getEmailSendgridStats('campaign', $oEvent->id);
                if(!empty($aStats)) {
                    foreach ($aStats as $key => $value) {
                        //pre($value);
                        $value->created = date('M Y', strtotime($value->created));
                        if($value->event_name == "delivered") {
                            $deleverArr[] = $value->created;
                        }
                        else if($value->event_name == "bounce") {
                            $bounceArr[] = $value->created;
                        }
                    }
                }
            }
        }
        //pre($deleverArr); 
        //pre($bounceArr);
        $deliverCountArr = array();
        foreach ($deleverArr as $value) {
           
            $value = strtotime($value);
            if(array_key_exists($value, $deliverCountArr)) {
                $devInc = $deliverCountArr[$value] + 1;
            }
            else {
                $devInc = 1;
            }
            $deliverCountArr[$value] = $devInc;
        }
        
        ksort($deliverCountArr);
        $deliverMainArr = array();
        $totalValue = 0;
        foreach ($deliverCountArr as $key => $value) {
            $deliverMainArr[] = array(date('M Y', $key), $value);
            $totalValue = $totalValue + $value;
        }

        $deliverMainArrEn = json_encode($deliverMainArr);

        $bounceCountArr = array();
        foreach ($bounceArr as $value) {
            $value = strtotime($value);
            if(array_key_exists($value, $bounceCountArr)) {
                $devInc = $bounceCountArr[$value] + 1;
            }
            else {
                $devInc = 1;
            }
            $bounceCountArr[$value] = $devInc;
        }

        ksort($bounceCountArr);
        $bounceMainArr = array();
        $totalbounceValue = 0;
        $bounceDArrEn = $bounceDVArrEn = '';
        foreach ($bounceCountArr as $key => $value) {
            $bounceDArr[] = date('M Y', $key);
            $bounceDVArr[] = $value;
            //$bounceMainArr[] = array(date('M Y', $key), $value);
            $totalbounceValue = $totalbounceValue + $value;
        }

        if(!empty($bounceDArr)){
            $bounceDArrEn = json_encode($bounceDArr);
        }
        
        if(!empty($bounceDVArr)){
            $bounceDVArrEn = json_encode($bounceDVArr);
        }
        
        

    ?>
    <div class="tab-content"> 
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-md-6">


                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email Sent</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0">
                            <div class="p20 topchart_value">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img class="pull-left mr20" src="<?php echo base_url(); ?>assets/images/icon_envalope.png"/>
                                        <h1 class="m0"><?php echo $totalValue; ?></h1>
                                        <p class="txt_red"><span style="border: none;" class="label ml0">15.9%</span></p>
                                    </div>
                                </div>
                            </div>


                            <div id="linechart_a" style="min-width: 300px; height: 205px;"></div>
                        </div>
                    </div>



                </div>
                <div class="col-md-3">


                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Bounce</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0" >

                            <div class="p20 pb0 topchart_value">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <img class="" width="43" src="<?php echo base_url(); ?>assets/images/power_green.png"/>
                                    </div>
                                    <div class="col-xs-4">
                                        <h1 class="m0 lh25"><?php echo $totalbounceValue; ?></h1>
                                        <p><span style="border: none;" class="label bkg_dblue ml0 ">5.9%</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="p20 pt0">
                                <canvas id="canvas"></canvas>
                            </div>
                        </div>
                    </div>


                </div>


                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Credits</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>

                        <div class="panel-body p0 pb10 min_h290" >
                            <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/service_icon.png"/></div>
                            <div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 280px;"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    @include('admin.modules.emails.email-table', array('pageType' => 'overview'))
                </div>
            </div>
        </div>
    </div>

    <!-- /dashboard content -->

</div>
<!-- /content area -->

<script>
    $(document).ready(function () {

        $('#emailsmsautomation thead tr').clone(true).appendTo('#emailsmsautomation thead');

        $('#emailsmsautomation thead tr:eq(1) th').each(function (i) {


            if (i === 11) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
						.column(i)
						.search(this.value, $('#colStatus').prop('checked', true))
						.draw();
                    }
                });
            }

        });



        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();

        });


        var tableId = 'emailsmsautomation';
        var tableBase = custom_data_table(tableId);

        $('table thead tr:eq(1)').hide();

        $('#activeCampaign').trigger('click');


    });
    
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
                    text: '213 <br> <span style="border: none;" class="label bkg_green ml0 ">Email Credits</span>',
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
                        colors: ['#2eb4dd', '#9de6fc', '#8bbc21', '#910000'],
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
                        pointPadding: 0.30,
                        borderWidth: 0,
                        borderRadius: 3
                    }
                },

                colors: ['#2eb4dd', '#000000'],
                tooltip: {
                    pointFormat: '<b>{point.y:.1f}</b>'
                },
                series: [{
                        name: 'Time',
                        data: <?php echo $deliverMainArrEn; ?>,

                    }]
            });





            var config = {
                type: 'line',
                data: {
                    labels: <?php echo $bounceDArrEn; ?>,
                    datasets: [{
                            label: false,
                            backgroundColor: window.chartColors.blue,
                            borderColor: window.chartColors.blue,
                            data: <?php echo $bounceDVArrEn; ?>,
                            fill: false,
                        }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: false,
                        //stext: 'Chart.js Line Chart'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: false
                    },
                    scales: {
                        xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Month'
                                }
                            }],
                        yAxes: [{
                                display: false,
                                scaleLabel: {
                                    display: false,
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
        </script>

@endsection