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

          
            
			var multiple_donuts2 = ec.init(document.getElementById('multiple_donuts2'), limitless);




           

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
       
			var labelBottom_a = {
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
                    color: 'rgba(0,0,0,0)'
                }
            };
			
			
		 // Top text label
      
			var labelTop_a = {
                normal: {
					color: '#0a5d8c',
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
			
			var labelBottom2_a = {
                normal: {
                    color: '#2694b8',
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
                    color: 'rgba(0,0,0,0)'
                }
            };
			
			

            // Set inner and outer radius
            var radius = [80, 95];

			
			
			// Add options
            multiple_donuts_options2 = {

                // Add series
                series: [
                    {
                        type: 'pie',
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 20, itemStyle: labelBottom_a},
                            {name: 'NPS Score', value: 20,itemStyle: labelTop_a},
							{name: 'Chrome', value: 60,itemStyle: labelBottom2_a}
                        ]
                    }
                ]
            };
			
			



            // Apply options
            // ------------------------------
            
			multiple_donuts2.setOption(multiple_donuts_options2);



            // Resize charts
            // ------------------------------
            window.onresize = function () {
                setTimeout(function (){
					multiple_donuts2.resize();
                }, 200);
            }
			
			
        }
    );
});
