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

            var stacked_area = ec.init(document.getElementById('stacked_area'), limitless);
           



            // Charts setup
            // ------------------------------

          


          


         


          


            //
            // Stacked area options
            //

            stacked_area_options = {

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
                    data: ['Sales', 'Emails', 'SMS', 'Reviews']
                },

                // Enable drag recalculate
                calculable: true,

                // Add horizontal axis 
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                }],

                // Add vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Sales',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [120, 132, 101, 134, 490, 230, 210]
                    },
                    {
                        name: 'Emails',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [150, 1232, 901, 154, 190, 330, 810]
                    },
                    {
                        name: 'SMS',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [320, 1332, 1801, 1334, 590, 830, 1220]
                    },
                    {
                        name: 'Reviews',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [820, 1632, 1901, 2234, 1290, 1330, 1320]
                    }
                ]
            };

			
			

			

           


            // Apply options
            // ------------------------------

          
            stacked_area.setOption(stacked_area_options);
			
           



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function () {
                    stacked_area.resize();
					
                }, 200);
            }
        }
    );
});





