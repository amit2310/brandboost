<script type="text/javascript" src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
<script type="text/javascript" src="http://www.chartjs.org/samples/latest/utils.js"></script>


<!-- /theme JS files -->
<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    #canvas2{height: 132px!important;}
    .dboard_wiz {padding: 15px 25px 24px;}
    .progress-bar-blue{background-color: #3680dc !important;}
    .progress-bar-purple3{background-color: #7774f1 !important;}
    .dboard_wiz img{margin-top: -8px;}

    @media only screen and (min-width:768px) and (max-width:1750px){
        #canvas2 {height: 112px !important;}
    }
</style>


@php
$positive = $negative = $neutral = $positivePercentage = $neutralPercentage = $negativePercentage = 0;
$positiveRating = $neturalRating = $negativeRating = $positiveGraph = $neturalGraph = $negativeGraph = 0;
$totalFeedback = 1;

$postivePercentage = $neturalPercentage = $negativePercentage = 0;

if ($positiveGraph > 0) {
    $postivePercentage = round(($positiveGraph / $totalFeedback) * 100);
}
if ($neturalGraph > 0) {
    $neturalPercentage = round(($neturalGraph / $totalFeedback) * 100);
}
if ($negativeGraph > 0) {
    $negativePercentage = round(($negativeGraph / $totalFeedback) * 100);
}

$postiveT = $neturalT = $negativeT = $startRating = 0;

if ($totalFeedback > 0) {

    if ($positiveGraph > 0) {
        $postiveT = $positiveGraph * 5;
    }
    if ($neturalGraph > 0) {
        $neturalT = $neturalGraph * 3;
    }
    if ($negativeGraph > 0) {
        $negativeT = $negativeGraph * 1;
    }

    $totalT = $postiveT + $neturalT + $negativeT;
    $startRating = $totalT / $totalFeedback;
}


$emailMonth = array();
$smsMonth = array();

if (!empty($bbEmailSendMonth)) {

    foreach ($bbEmailSendMonth as $data) {

        $month = substr($data->created, 0, 7);
        $emailMonth[$month][] = $data;
    }
}

$monthlyEmailSend = array();
if (!empty($emailMonth)) {
    foreach ($emailMonth as $key => $value) {
        $monthlyEmailSend[$key] = count($value);
    }
}

if (!empty($bbSMSSendMonth)) {

    foreach ($bbSMSSendMonth as $data) {

        $month = substr($data->created, 0, 7);
        $smsMonth[$month][] = $data;
    }
}

$monthlySMSSend = array();
if (!empty($smsMonth)) {
    foreach ($smsMonth as $key => $value) {
        $monthlySMSSend[$key] = count($value);
    }
}

$monthlyEmailSend = array_reverse($monthlyEmailSend);


$seMonth = array();
$emailM = array();
$smsM = array();
foreach ($monthlyEmailSend as $key => $value) {

    array_push($seMonth, date('M Y', strtotime($key)));
    array_push($emailM, $value);

    if (!empty($monthlySMSSend[$key])) {
        array_push($smsM, $monthlySMSSend[$key]);
    } else {
        array_push($smsM, 0);
    }
}


$seMonth = implode("','", $seMonth);
$emailM = implode(',', $emailM);
$smsM = implode(",", $smsM);

@endphp


<div class="row">
    <div class="col-md-3">


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Off Site Boost Report</h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
            </div>
            <div class="panel-body p0" >

                <div class="p20 pb0 topchart_value">
                    <div class="row">

                        <div class="col-xs-4 brig">
                            <h1 class="m0 lh25"></h1>
                            <p>Emails &nbsp; <span style="border: none;" class="label bkg_blue ml0 ">5.9%</span></p>
                        </div>


                        <div class="col-xs-4">
                            <h1 class="m0 lh25"></h1>
                            <p>SMS &nbsp; <span style="border: none;" class="label bkg_green ml0 ">5.9%</span></p>
                        </div>


                    </div>
                </div>

                <div class="p20 pt0">
                    <canvas id="canvas2"></canvas>
                </div>
            </div>
        </div>

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Positive Reviews<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
            </div>
            <div class="panel-body p30">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="topchart_value">
                            <div class="row">
                                <div class="col-xs-5">
                                    <img class="" src="/assets/images/smiley_green.png" width="43">
                                </div>
                                <div class="col-xs-6">
                                    <h1 class="m0 lh25">{{ $positiveGraph }}</h1>
                                    <p><span style="border: none;" class="label bkg_green ml0 ">75.9%</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <img src="/assets/images/green_small_graph.png">
                    </div>
                </div>

            </div>
        </div>


    </div>
    <div class="col-md-6">
        <div class="panel panel-flat review_ratings">
            <div class="panel-heading">
                <h6 class="panel-title">Review Ratings</h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
            </div>
            <div class="panel-body p0">
                <div class="pt30 pb30 pl40 pr40 bbot">
                    <h1><i style="color: #7f62df !important;" class="icon-star-full2 txt_purple"></i> {{ number_format($startRating, 1, '.', '') }} <sup><i class="icon-arrow-up5"></i> &nbsp; +15%</sup></h1>
                </div>
                <div class="p40 ratings">

                    <div class="row inner">
                        <div class="col-xs-6"> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> </div>
                        <div class="col-xs-6 text-right">
                            <p>{{ $postivePercentage }}% <span>{{ $positiveGraph }}</span></p>
                        </div>
                        <div class="col-xs-12">
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Percentage {{ $postivePercentage }}">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $postivePercentage }}" aria-valuemin="0" aria-valuemax="{{ $postivePercentage }}" style="width:{{ $postivePercentage }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row inner">
                        <div class="col-xs-6"> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> </div>
                        <div class="col-xs-6 text-right">
                            <p>0% <span>0</span></p>
                        </div>
                        <div class="col-xs-12">
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Percentage 0">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width:0%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row inner">
                        <div class="col-xs-6"> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> </div>
                        <div class="col-xs-6 text-right">
                            <p>{{ $neturalPercentage }}% <span>{{ $neturalGraph }}</span></p>
                        </div>
                        <div class="col-xs-12">
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Percentage {{ $neturalPercentage }}">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $neturalPercentage }}" aria-valuemin="0" aria-valuemax="{{ $neturalPercentage }}" style="width:{{ $neturalPercentage }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row inner">
                        <div class="col-xs-6"> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> </div>
                        <div class="col-xs-6 text-right">
                            <p>0% <span>0</span></p>
                        </div>
                        <div class="col-xs-12">
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Percentage 0">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width:0%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row inner mb0">
                        <div class="col-xs-6"> <i class="icon-star-full2"></i> </div>
                        <div class="col-xs-6 text-right">
                            <p>{{ $negativePercentage }}% <span>{{ $negativeGraph }}</span></p>
                        </div>
                        <div class="col-xs-12">
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Percentage {{ $negativePercentage }}">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $negativePercentage }}" aria-valuemin="0" aria-valuemax="{{ $negativePercentage }}" style="width:{{ $negativePercentage }}%"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Negative Reviews<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
            </div>
            <div class="panel-body p30">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="topchart_value">
                            <div class="row">
                                <div class="col-xs-5">
                                    <img class="" src="/assets/images/smiley_red.png" width="43">
                                </div>
                                <div class="col-xs-7">
                                    <h1 class="m0 lh25">{{ $negativeGraph }}</h1>
                                    <p><span style="border: none;" class="label bkg_red ml0 ">15.9%</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <img src="/assets/images/graph5_1.png">
                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Widgets</h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
            </div>
            <div class="panel-body p0">
                <div class="row">
                    <div class="col-xs-6 pr0">
                        <div class="dboard_wiz bbot brig">
                            <h1 class="fw500">49 <img src="/assets/images/msg_icon2.png"></h1>
                            <p>Chat Actions</p>
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                <div class="progress-bar progress-bar-info progress-bar-blue" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="50" style="width:50%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 pl0">
                        <div class="dboard_wiz bbot ">
                            <h1 class="fw500">12 <img src="/assets/images/star_icon.png"></h1>
                            <p>Review Popup</p>
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                <div class="progress-bar progress-bar-info progress-bar-purple3" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="15" style="width:15%"></div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-xs-12"><hr class="mt0 mb0"></div>-->
                    <div class="col-xs-6 pr0">
                        <div class="dboard_wiz brig">
                            <h1 class="fw500">72 <img src="/assets/images/active_icon.png"></h1>
                            <p>Product Mini</p>
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="72" style="width:72%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 pl0">
                        <div class="dboard_wiz">
                            <h1 class="fw500">37 <img src="/assets/images/msg_icon3.png"></h1>
                            <p>Email Popup</p>
                            <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                <div class="progress-bar progress-bar-info progress-bar-green" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="72" style="width:72%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

    var config2 = {
        type: 'line',
        data: {
            labels: [{{ "'" . $seMonth . "'" }}],
            datasets: [{
                    label: '',
                    backgroundColor: window.chartColors.purple,
                    borderColor: window.chartColors.purple,
                    data: [{{ $emailM }}],
                    fill: false,
                },

                {
                    label: '',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [{{ $smsM }}],
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
                intersect: true
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

        var ctx2 = document.getElementById('canvas2').getContext('2d');
        window.myLine = new Chart(ctx2, config2);

    };

</script>