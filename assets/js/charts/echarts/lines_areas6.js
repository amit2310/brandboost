/* ------------------------------------------------------------------------------
 *
 *  # Echarts - lines and areas
 *
 *  Lines and areas chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function() {


    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: 'assets/js/plugins/visualization/echarts'
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
            var reversed_value = ec.init(document.getElementById('reversed_value'), limitless);



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
                    data: ['Internet Explorer', 'Opera', 'Safari', 'Firefox', 'Chrome']
                },

                // Enable drag recalculate
                calculable: true,

                // Hirozontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [
                        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
                    ]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Internet Explorer',
                        type: 'line',
                        stack: 'Total',
                        data: [120, 132, 101, 134, 90, 230, 210]
                    },
                    {
                        name: 'Opera',
                        type: 'line',
                        stack: 'Total',
                        data: [220, 182, 191, 234, 290, 330, 310]
                    },
                    {
                        name: 'Safari',
                        type: 'line',
                        stack: 'Total',
                        data: [150, 232, 201, 154, 190, 330, 410]
                    },
                    {
                        name: 'Firefox',
                        type: 'line',
                        stack: 'Total',
                        data: [320, 332, 301, 334, 390, 330, 320]
                    },
                    {
                        name: 'Chrome',
                        type: 'line',
                        stack: 'Total',
                        data: [820, 932, 901, 934, 1290, 1330, 1320]
                    }
                ]
            };


         


          


           

			
			//
            // Reversed value axis options
            //

            reversed_value_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    formatter: function(params) {
                        return params[0].name + '<br/>'
                        + params[0].seriesName + ': ' + params[0].value + ' (m^3/s)<br/>'
                        + params[1].seriesName + ': ' + -params[1].value + ' (mm)';
                    }
                },

                // Add legend
                legend: {
                    data: ['Flow', 'Rainfall']
                },

                // Add horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    axisLine: {
                        onZero: false
                    },
                    data: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                }],

                // Add vertical axis
                yAxis: [
                    {
                        name: 'Flow(m^3/s)',
                        type: 'value',
                        max: 500
                    },
                    {
                        name: 'Rainfall(mm)',
                        type: 'value',
                        axisLabel: {
                            formatter: function(v) {
                                return - v;
                            }
                        }
                    }
                ],

                // Add series
                series: [
                    {
                        name: 'Flow',
                        type: 'line',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[100, 200, 240, 180, 90, 200, 130]
                    },
                    {
                        name: 'Rainfall',
                        type: 'line',
                        yAxisIndex: 1,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: (function() {
                            var oriData = [
                                1, 2, 1.5, 7.4, 3.1, 4, 2
                            ];
                            var len = oriData.length;
                            while(len--) {
                                oriData[len] *= -1;
                            }
                            return oriData;
                        })()
                    }
                ]
            };

			

           


            // Apply options
            // ------------------------------

          
            stacked_lines.setOption(stacked_lines_options);
			reversed_value.setOption(reversed_value_options);
           



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function () {
                    stacked_lines.resize();
					reversed_value.resize();
                }, 200);
            }
        }
    );
});





