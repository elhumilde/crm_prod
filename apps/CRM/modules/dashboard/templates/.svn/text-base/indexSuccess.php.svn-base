<script type="text/javascript">
/* ------------------------------------------------------------------------------
 *
 *  # Echarts - candlestick and other charts
 *
 *  Candlestick and other chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */
$(document).ready(function() {

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

        // Add necessary charts
        [
          'echarts',
          'echarts/chart/gauge'
        ],


        // Charts setup
        function (ec, limitless) {



            var gauge_basic = ec.init(document.getElementById('gauge_basic'), limitless);


            //
            // Basic gauge
            //

            // Setup chart
            gauge_basic_options = {

                // Add title
                title: {
                    text: 'Pourcentage d’opportunités gagnées',
                    subtext: '',
                    x: 'center'
                },

                // Add tooltip
                tooltip: {
                    formatter: "{a} <br/>{b}: {c}%"
                },

                // Add series
                series: [
                    {
                        name: 'Pourcentage opportunités gagnées',
                        type: 'gauge',
                        center: ['50%', '55%'],
                        detail: {formatter:'{value}%'},
                        data: [{value: <?php echo $nbr_op['all_op'] ? $nbr_op['gagne']/$nbr_op['all_op']*100 : 0; ?>, name: ''}]
                    }
                ]
            };

                    

            gauge_basic.setOption(gauge_basic_options);



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
                    candlestick_basic.resize();
                    candlestick_line.resize();
                    candlestick_scatter.resize();
                    radar_basic.resize();
                    radar_filled.resize();
                    gauge_basic.resize();
                    gauge_styling.resize();
                }, 200);
            }

        }
    );
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
                    data: ['nombre_opp', 'nombre_gagnee']
                },

                // Add custom colors
                color: ['#EF5350', '#66BB6A'],

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: ['Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin','Juil','Août','Sept','Oct','Nov','Déc']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}'
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'nombre_opp',
                        type: 'line',
                        data: [
                                <?php for ($i=1; $i <=12 ; $i++) { echo $all_opp_mois[$i]['all_opp_mois'].","; } ?>
                               ]
                       
                    },
                    {
                        name: 'nombre_gagnee',
                        type: 'line',
                        data: [<?php for ($i=1; $i <=12 ; $i++) { echo $opp_gagne_mois[$i]['opp_gagne_mois'].","; } ?>]

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

    // Animated progress chart
    // ------------------------------

    // Initialize charts
    progressCounter('#hours-available-progress', 38, 2, "#F06292", <?php echo $nbr_visite; ?>, "icon-calendar3 text-pink-400", 'visites réalisées pendant', '<?PHP echo date('Y');?>')
    progressCounter('#goal-progress', 38, 2, "#5C6BC0", <?php echo $montant; ?>, "icon-trophy3 text-indigo-400", ' Montant des opportunités', 'gagnées en <?PHP echo date('Y');?>')

    // Chart setup
    function progressCounter(element, radius, border, color, end, iconClass, textTitle, textAverage) {


        // Basic setup
        // ------------------------------

        // Main variables
        var d3Container = d3.select(element),
            startPercent = 0,
            iconSize = 32,
            endPercent = end,
            twoPi = Math.PI * 2,
            formatPercent = d3.format('.0'),
            boxSize = radius * 2;

        // Values count
        var count = Math.abs((endPercent));

        // Values step
        var step = endPercent < startPercent ? -1 : 1;



        // Create chart
        // ------------------------------

        // Add SVG element
        var container = d3Container.append('svg');

        // Add SVG group
        var svg = container
            .attr('width', boxSize)
            .attr('height', boxSize)
            .append('g')
                .attr('transform', 'translate(' + (boxSize / 2) + ',' + (boxSize / 2) + ')');



        // Construct chart layout
        // ------------------------------

        // Arc
        var arc = d3.svg.arc()
            .startAngle(0)
            .innerRadius(radius)
            .outerRadius(radius - border);



        //
        // Append chart elements
        //

        // Paths
        // ------------------------------

        // Background path
        svg.append('path')
            .attr('class', 'd3-progress-background')
            .attr('d', arc.endAngle(twoPi))
            .style('fill', '#eee');

        // Foreground path
        var foreground = svg.append('path')
            .attr('class', 'd3-progress-foreground')
            .attr('filter', 'url(#blur)')
            .style('fill', color)
            .style('stroke', color);

        // Front path
        var front = svg.append('path')
            .attr('class', 'd3-progress-front')
            .style('fill', color)
            .style('fill-opacity', 1);



        // Text
        // ------------------------------

        // Percentage text value
        var numberText = d3.select(element)
            .append('h2')
                .attr('class', 'mt-15 mb-5')

        // Icon
        d3.select(element)
            .append("i")
                .attr("class", iconClass + " counter-icon")
                .attr('style', 'top: ' + ((boxSize - iconSize) / 2) + 'px');

        // Title
        d3.select(element)
            .append('div')
                .text(textTitle);

        // Subtitle
        d3.select(element)
            .append('div')
                .attr('class', 'text-size-small text-muted')
                .text(textAverage);



        // Animation
        // ------------------------------

        // Animate path
        function updateProgress(progress) {
            foreground.attr('d', arc.endAngle(twoPi * progress));
            front.attr('d', arc.endAngle(twoPi * progress));
            numberText.text(formatPercent(progress));
        }

        // Animate text
        var progress = startPercent;
        (function loops() {
            updateProgress(progress);
            if (count > 0) {
                count--;
                progress += step;
                setTimeout(loops, 10);
            }
        })();
    }



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
            'echarts/chart/pie',
            'echarts/chart/funnel'
        ],


        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------

            var basic_pie = ec.init(document.getElementById('basic_pie'), limitless);

            //
            // Basic pie options
            //

            basic_pie_options = {

                // Add title
                title: {
                    text: 'Répartition des opportunités',
                    subtext: '<?PHP echo date('Y');?>',
                    x: 'center'
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: [
                            <?php foreach ($count_op_type as  $op_type) {?>
                             '<?php echo $op_type["type"]; ?>',
                            <?php }?>
                        ]
                },

                // Display toolbox
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    feature: {
                        mark: {
                            show: true,
                            title: {
                                mark: 'Markline switch',
                                markUndo: 'Undo markline',
                                markClear: 'Clear markline'
                            }
                        },
                        dataView: {
                            show: true,
                            readOnly: false,
                            title: 'View data',
                            lang: ['View chart data', 'Close', 'Update']
                        },
                        magicType: {
                            show: true,
                            title: {
                                pie: 'Switch to pies',
                                funnel: 'Switch to funnel',
                            },
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    y: '20%',
                                    width: '50%',
                                    height: '70%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore: {
                            show: true,
                            title: 'Restore'
                        },
                        saveAsImage: {
                            show: true,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                // Enable drag recalculate
                calculable: true,

                // Add series
                series: [{
                    name: 'Opportunités',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    data: [
                        <?php foreach ($count_op_type as  $op_type) {?>
                           {value: <?php echo $op_type["count_op_type"]; ?>, name: '<?php echo $op_type["type"]; ?>'},
                        <?php }?>
                    ]
                }]
            };

            basic_pie.setOption(basic_pie_options);
            window.onresize = function () {
                setTimeout(function (){
                    basic_pie.resize();
                    basic_donut.resize();
                    nested_pie.resize();
                    infographic_donut.resize();
                    rose_diagram_hidden.resize();
                    rose_diagram_visible.resize();
                    lasagna_donut.resize();
                    pie_timeline.resize();
                    multiple_donuts.resize();
                }, 200);
            }
        }
    );
});

</script>
<!-- Content area -->
      <div class="content">
                      
        <div class="row">       
          <!-- Basic markers -->
            <div class="col-md-10">
              <div class="panel panel-flat">

                <div class="panel-body">
                  <div class="chart-container">
                    <div class="chart has-fixed-height" id="basic_lines"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-2">

                  <!-- Available hours -->
                  <div class="panel text-center">
                    <div class="panel-body">


                              <!-- Progress counter -->
                      <div class="content-group svg-center position-relative" id="hours-available-progress"></div>
                      <!-- /progress counter -->


                      <!-- Bars -->
                      <!-- /bars -->

                    </div>
                  </div>
                  <!-- /available hours -->

                </div>

                <div class="col-md-2">

                  <!-- Productivity goal -->
                  <div class="panel text-center">
                    <div class="panel-body">

                      <!-- Progress counter -->
                      <div class="content-group svg-center position-relative" id="goal-progress"></div>
                      <!-- /progress counter -->

                      <!-- Bars -->
                      <!-- /bars -->

                    </div>
                  </div>
                  <!-- /productivity goal -->

                </div>
          </div>
          <!-- /basic markers -->
          <div class="row">
              <div class="col-md-6">
            <!-- Basic gauge chart -->
                <div class="panel panel-flat">

                  <div class="panel-body">
                    <div class="chart-container">
                      <div class="chart has-fixed-height" id="gauge_basic"></div>
                    </div>
                  </div>
                </div>
                <!-- /basic gauge chart -->
            </div>

            <?php if(count($count_op_type) != '0'): ?>
            <div class="col-md-6">

              <!-- Basic pie chart -->
              <div class="panel panel-flat">

                <div class="panel-body">
                  <div class="chart-container has-scroll">
                    <div class="chart has-fixed-height " id="basic_pie"></div>
                  </div>
                </div>
              </div>
              <!-- /bacis pie chart -->
            </div>
            <?php endif;?>
          </div>
          <!-- Basic line chart -->
          
          <!-- /basic line chart -->
          </div>

      </div>
        <!-- /content area -->



