<script type="text/javascript" src="{{ base_url("assets/js/vega.js") }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

@php
    //pre($aEmailStatsCategorized);
    //pre("============================");
    //pre($aCategorizedEmailStats24Hours);
    $sentCount = $aEmailStatsCategorized['processed']['UniqueCount'];
    $iDeliveredCount = $aEmailStatsCategorized['delivered']['UniqueCount'];
    $iOpenCount = $aEmailStatsCategorized['open']['UniqueCount'];
    $iClickCount = $aEmailStatsCategorized['click']['UniqueCount'];
    $iUnsubscribeCount = $aEmailStatsCategorized['unsubscribe']['UniqueCount'];
    $iBounceCount = $aEmailStatsCategorized['bounce']['UniqueCount'];
    $iDroppedCount = $aEmailStatsCategorized['dropped']['UniqueCount'];
    $iSpamReportCount = $aEmailStatsCategorized['spam_report']['UniqueCount'];

    $iTotalSent = $sentCount == '' ? '0' : $sentCount;
    $iDelivered = $iDeliveredCount == '' ? '0' : $iDeliveredCount;
    $iOpen = $iOpenCount == '' ? '0' : $iOpenCount;
    $iClick = $iClickCount == '' ? '0' : $iClickCount;
    $iUnsubscribe = $iUnsubscribeCount == '' ? '0' : $iUnsubscribeCount;
    $iBounce = $iBounceCount == '' ? '0' : $iBounceCount;
    $iDropped = $iDroppedCount == '' ? '0' : $iDroppedCount;
    $iSpamReport = $iSpamReportCount == '' ? '0' : $iSpamReportCount;


    $iOpenRate = ($iOpen / $iTotalSent) * 100;
    $iOpenRate = ($iTotalSent > 0) ? $iOpenRate : 0;
    $iOpenRate = number_format($iOpenRate, 1);
    $iNotOpenedRate = 100 - $iOpenRate;
    $iNotOpenedRate = number_format($iNotOpenedRate, 1);

    $iClickRate = ($iClick / $iTotalSent) * 100;
    $iClickRate = ($iTotalSent > 0) ? $iClickRate : 0;
    $iClickRate = number_format($iClickRate, 1);
    $iNotClickedRate = 100 - $iClickRate;
    $iNotClickedRate = number_format($iNotClickedRate, 1);
    //echo "Time Now" . date("Y-m-d H:i:s");
    //pre($aCategorizedEmailStats24Hours);
    if (!empty($aCategorizedEmailStats24Hours)) {

        $sentCount24Hours = $aCategorizedEmailStats24Hours['processed']['UniqueCount'];
        $iDeliveredCount24Hours = $aCategorizedEmailStats24Hours['delivered']['UniqueCount'];
        $iOpenCount24Hours = $aCategorizedEmailStats24Hours['open']['UniqueCount'];
        $iClickCount24Hours = $aCategorizedEmailStats24Hours['click']['UniqueCount'];
        $iUnsubscribeCount24Hours = $aCategorizedEmailStats24Hours['unsubscribe']['UniqueCount'];
        $iBounceCount24Hours = $aCategorizedEmailStats24Hours['bounce']['UniqueCount'];
        $iDroppedCount24Hours = $aCategorizedEmailStats24Hours['dropped']['UniqueCount'];
        $iSpamReportCount24Hours = $aCategorizedEmailStats24Hours['spam_report']['UniqueCount'];

        $iTotalSent24Hours = $sentCount24Hours == '' ? '0' : $sentCount24Hours;
        $iDelivered24Hours = $iDeliveredCount24Hours == '' ? '0' : $iDeliveredCount24Hours;
        $iOpen24Hours = $iOpenCount24Hours == '' ? '0' : $iOpenCount24Hours;
        $iClick24Hours = $iClickCount24Hours == '' ? '0' : $iClickCount24Hours;
        $iUnsubscribe24Hours = $iUnsubscribeCount24Hours == '' ? '0' : $iUnsubscribeCount24Hours;
        $iBounce24Hours = $iBounceCount24Hours == '' ? '0' : $iBounceCount24Hours;
        $iDropped24Hours = $iDroppedCount24Hours == '' ? '0' : $iDroppedCount24Hours;
        $iSpamReport24Hours = $iSpamReportCount24Hours == '' ? '0' : $iSpamReportCount24Hours;


        $iOpenRate24Hours = ($iOpen24Hours / $iTotalSent24Hours) * 100;
        $iOpenRate24Hours = ($iTotalSent24Hours > 0) ? $iOpenRate24Hours : 0;
        $iOpenRate24Hours = number_format($iOpenRate24Hours, 1);
        $iNotOpenedRate24Hours = 100 - $iOpenRate24Hours;
        $iNotOpenedRate24Hours = number_format($iNotOpenedRate24Hours, 1);

        $iClickRate24Hours = ($iClick24Hours / $iTotalSent24Hours) * 100;
        $iClickRate24Hours = ($iTotalSent24Hours > 0) ? $iClickRate24Hours : 0;
        $iClickRate24Hours = number_format($iClickRate24Hours, 1);
        $iNotClickedRate24Hours = 100 - $iClickRate24Hours;
        $iNotClickedRate24Hours = number_format($iNotClickedRate24Hours, 1);
    }
@endphp
<div class="col-md-3">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Email Open Rate</h6>
            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
        </div>
        <div class="panel-body min_h270 p0 text-center">

            <!--<img src="assets/images/email_graph5.png">-->

            <div class="semi_circle_smiley"><img src="{{ base_url("assets/images/blue_envalope.png") }}"/></div>
            <div id="semi_circle_chart_open" class="br5 bkg_gradient" style="width: 100%; height: 270px;"></div>


        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Email Click Rate</h6>
            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
        </div>
        <div class="panel-body min_h270 p0 text-center">
            <div class="semi_circle_smiley"><img src="{{ base_url("assets/images/curser.png") }}"/></div>
            <div id="semi_circle_chart_click" class="br5 bkg_gradient" style="width: 100%; height: 270px;"></div>

        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Campaign Report</h6>
            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
        </div>
        <div class="panel-body p0 min_h270">
            <div class="p20 pb0 topchart_value" style="max-width:575px !important;">
                <div class="row">
                    <div class="col-xs-4 brig">
                        <h1 class="m0">{{ $iTotalSent }}</h1>
                        <p>Sent <span class="label ">100%</span></p>
                    </div>
                    <div class="col-xs-4 brig">
                        <h1 class="m0">{{ $iOpen }}</h1>
                        <p>Opened <span class="label ">{{ $iOpenRate }}%</span></p>
                    </div>
                    <div class="col-xs-4">
                        <h1 class="m0">{{ $iClick }}</h1>
                        <p>Clicked <span class="label ">{{ $iClickRate }}%</span></p>
                    </div>
                </div>
            </div>
            <div class="text-center p20 pt0" id="stacked-area-chart"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var chart = {
            plotBackgroundColor: false,
            plotBorderWidth: 0,
            plotShadow: false
        };

        var titleOpen = {
            text: '{{ $iOpenRate }}% <br> <span style="border: none;" class="label">Last 24 Hours: {{ $iOpenRate24Hours }}%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 65
        };

        var tooltipOpen = {
            pointFormat: '{seriesOpen.name}: <b>{point.percentage:.1f}%</b>'
        };

        var seriesOpen = [{
            type: 'pie',
            name: 'Open',
            colors: ['#2eb4dd', '#d3eefa', '#8bbc21', '#910000'],
            innerSize: '90%',
            data: [
                ['Opened Rate', {{ $iOpenRate }}],
                ['Not Opened Rate', {{ $iNotOpenedRate }}],

                {
                    name: 'Others',
                    y: 0,
                    dataLabels: {
                        enabled: false
                    }
                }
            ]
        }];

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


        var jsonOpen = {};
        jsonOpen.chart = chart;
        jsonOpen.title = titleOpen;
        jsonOpen.tooltip = tooltipOpen;
        jsonOpen.series = seriesOpen;
        jsonOpen.plotOptions = plotOptions;


        var titleClick = {
            text: '{{ $iClickRate }}% <br> <span style="border: none;" class="label">Last 24 Hours: {{ $iClickRate24Hours }}%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 65
        };

        var tooltipClick = {
            pointFormat: '{seriesOpen.name}: <b>{point.percentage:.1f}%</b>'
        };

        var seriesClick = [{
            type: 'pie',
            name: 'Click',
            colors: ['#2eb4dd', '#d3eefa', '#8bbc21', '#910000'],
            innerSize: '90%',
            data: [
                ['Clicked Rate', {{ $iClickRate }}],
                ['Not Clicked Rate', {{ $iNotClickedRate }}],

                {
                    name: 'Others',
                    y: 0,
                    dataLabels: {
                        enabled: false
                    }
                }
            ]
        }];


        var jsonClick = {};
        jsonClick.chart = chart;
        jsonClick.title = titleClick;
        jsonClick.tooltip = tooltipClick;
        jsonClick.series = seriesClick;
        jsonClick.plotOptions = plotOptions;

        //draw graph now
        $('#semi_circle_chart_open').highcharts(jsonOpen);
        $('#semi_circle_chart_click').highcharts(jsonClick);
    });

</script>
<script>
    //Area Graph start vega.js
    $(document).ready(function () {
        var spec = {
                "width": 600,
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
    });


</script>


