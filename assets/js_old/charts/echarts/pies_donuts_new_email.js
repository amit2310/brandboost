/* ------------------------------------------------------------------------------
 *
 *  # Echarts - pies and donuts
 *
 *  Pies and donuts chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {

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
            'echarts/chart/pie',
            'echarts/chart/funnel'
        ],


        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------

          
            var multiple_donuts = ec.init(document.getElementById('multiple_donuts'), limitless);


            // Charts setup
            // ------------------------------                    

           




            //
            // Multiple donuts options
            //

            // Top text label
            var labelTop = {
                normal: {
                    label: {
                        show: true,
                        position: 'center',
                        formatter: '{b}\n',
                        textStyle: {
                            baseline: 'middle',
                            fontWeight: 300,
                            fontSize: 15
                        }
                    },
                    labelLine: {
                        show: false
                    }
                }
            };

            // Format bottom label
            var labelFromatter = {
                normal: {
                    label: {
                        formatter: function (params) {
                            return '\n\n' + (100 - params.value) + '%'
                        }
                    }
                }
            }

            // Bottom text label
            var labelBottom = {
                normal: {
                    color: '#2eb4dd',
                    label: {
                        show: true,
                        position: 'center',
                        textStyle: {
                            baseline: 'middle'
                        }
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: '#dddddd'
                }
            };

            // Set inner and outer radius
            var radius = [75, 95];

            // Add options
            multiple_donuts_options = {

                // Add series
                series: [
                    {
                        type: 'pie',
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 30, itemStyle: labelBottom},
                            {name: 'NPS Score', value: 40,itemStyle: labelTop},
							{name: 'Chrome', value: 30,itemStyle: labelBottom}
                        ]
                    }
                ]
            };



            // Apply options
            // ------------------------------

     
            multiple_donuts.setOption(multiple_donuts_options);



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
        
                    multiple_donuts.resize();
                }, 200);
            }
        }
    );
});
