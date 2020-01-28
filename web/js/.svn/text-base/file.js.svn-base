
$(function() {


    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: '/js/theme_limitless/plugins/visualization/echarts'
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

            var basic_lines = ec.init(document.getElementById('basic_lines'), limitless);



            // Charts setup
            // ------------------------------

            //
            // Basic lines options
            //

            basic_lines_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Maximum', 'Minimum']
                },

                // Add custom colors
                color: ['#EF5350', '#66BB6A'],

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}km'
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Maximum',
                        type: 'line',
                        data: [0, 110, 1000, 400, 200, 0]
                       
                    },
                    {
                        name: 'Minimum',
                        type: 'line',
                        data: [0, 100, 250, 400, 200, 0]

                    }
                ]
				
            };

            // Apply options
            // ------------------------------

            basic_lines.setOption(basic_lines_options);

            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function () {
                    basic_lines.resize();
                }, 200);
            }
        }
    );
});
