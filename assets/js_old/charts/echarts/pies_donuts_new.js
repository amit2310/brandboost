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
			var multiple_donuts2 = ec.init(document.getElementById('multiple_donuts2'), limitless);




            // Top text label
            var labelTop = {
                normal: {
					color: '#ffb665',
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
			var labelTop_a = {
                normal: {
					color: '#2779dc',
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
                    color: '#5ad491',
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
			
			
			  var labelBottom2 = {
                normal: {
                    color: '#fd6c81',
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
			
			var labelBottom2_a = {
                normal: {
                    color: '#a1daeb',
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
            var radius = [60, 75];

            // Add options
            multiple_donuts_options = {

                // Add series
                series: [
                    {
                        type: 'pie',
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 70, itemStyle: labelBottom},
                            {name: 'NPS Score', value: 10,itemStyle: labelTop},
							{name: 'Chrome', value: 20,itemStyle: labelBottom2}
                        ]
                    }
                ]
            };
			
			
			// Add options
            multiple_donuts_options2 = {

                // Add series
                series: [
                    {
                        type: 'pie',
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 65, itemStyle: labelBottom_a},
                            {name: 'NPS Score', value: 20,itemStyle: labelTop_a},
							{name: 'Chrome', value: 15,itemStyle: labelBottom2_a}
                        ]
                    }
                ]
            };
			
			



            // Apply options
            // ------------------------------
            multiple_donuts.setOption(multiple_donuts_options);
			multiple_donuts2.setOption(multiple_donuts_options2);



            // Resize charts
            // ------------------------------
            window.onresize = function () {
                setTimeout(function (){
                    multiple_donuts.resize();
					multiple_donuts2.resize();
                }, 200);
            }
			
			
        }
    );
});
