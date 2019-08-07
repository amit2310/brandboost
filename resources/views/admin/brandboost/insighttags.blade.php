@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php /* ?>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/plugins/formOpenCount/echarts/echarts.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/plugins/visualization/d3/d3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date.js"></script>
	
	
	<!-- /theme JS files -->

		
<style>
.reports_sec h4 {margin: 0 0 10px;font-size: 17px;font-weight: 500;}
.reports_sec h5{font-size: 14px; font-weight: 600; color: #000; margin: 0 0 10px; padding-left: 0px;}
.reports_sec h5 span{ color: #4caf50!important; font-weight: 500; font-size: 24px;}
.reports_sec h5:first-child{padding-left: 0px}
	
.panel.no-boxshadow {	box-shadow: none !important; border: 1px solid #eee;}
.table-responsive{border-bottom: 1px solid #eee;}
.media-body.results hr{margin: 10px 0; border-color: #f5f4f5 ;}
.media-body.results h3{color: #4caf50!important}
.media-body.results i{color: #4caf50!important; float: left; margin: 7px 4px 0 0; font-size: 24px;}	
	
.media-body.results i.fa{float: none; margin-right: 0px; color: #ffd301!important; font-size: 20px!important;}
.btn.filter{display: block; width: 100%;}


	
.panel.boxshadow {	box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); border: 1px solid #eee; min-height: 250px; transition: transform .15s ease;}
.panel.boxshadow:hover {transform: scale(1.02) translateY(-3px); box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); cursor: pointer}

.panel.shadow {	box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055); border: 1px solid #eee; min-height: 250px; transition: transform .15s ease;}
.panel.shadow:hover{transform: scale(1.01) translateY(-1px);}

	
.result_box{}
.bkg1{background: #fef6f2!important}
.bkg2{background: #f3fbf3!important}
.bkg3{background: #fbf1f1!important}
.bkg4{background: #eff2f5!important}
.bkg5{background: #f1f7fd!important}
.bkg6{background: #edf6ff!important}
.bkg7{background: #faf3ff!important;}
	.rating_progress {	margin-bottom: 5px;}
	.rating_progress p{font-size: 11px; margin: 0;}
	.progress-bar-warning{background: #ffd301;}
	.progress{height: 6px; margin-top: 0spx;}
	
	.chart-widget-legend li {margin: 5px 5px 0!important;padding: 0!important;}
	.pl0{padding-left: 0px!important;}
	.pr0{padding-right: 0px!important;}
	.text-left.starts{width: 57px;}
	
	.table > tbody > tr > td{padding: 0 20px!important;}
</style>	


				

<!-- Content area -->
<div class="content reports_sec">
<div class="panel panel-flat">
<div class="panel-heading">
        <h6 class="panel-title"> Home - Brand Boost Insight Tags Reports</h6>
        <div class="heading-elements"> <span class="label bg-success lgraybtn heading-text"> Brand Boost Campaign Report</span>
          <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold"> <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b> </button>
        </div>
      </div>
<div class="panel-body">
         <div class="tabbable">
           <?php 
           $topThreeGroupTag = topThreeTagGroup(); 
           //pre($topThreeGroupTag);
           $topGroup = array();
           $totalTagG = 0;
           foreach ($topThreeGroupTag as $value) {
               if($value->tagid > 0){
                    $topGroup[$value->group_name] = $value->total_group;
                    $totalTagG += $value->total_group;
               }
               else{
                    $topGroup[$value->group_name] = 0;
               }
               
           }
           arsort($topGroup);
         
           ?>
           <div class="tab-content"> 
            <!--########################TAB 1 ##########################-->
            <div class="tab-pane active" id="right-icon-tab0">
			<!--#################################Top 3 Boxes###########################-->
			<div class="row">
			  
              <?php if(!empty($topGroup)) {
                 $inc = 1;
                 foreach ($topGroup as $key => $value) {
                 
                ?>
                <div class="col-sm-6 col-md-4 result_box">
                    <div class="panel panel-body boxshadow bkg2">
                      <div class="media no-margin">
                        <div class="media-body text-left results">
                        <?php 
                        if($value > 0 && $totalTagG > 0) {
                            $getPer = round(($value/$totalTagG)*100);
                        }
                        else {
                            $getPer = 0;
                        }
                        
                        ?>
                      <h5 class="mb0"><i class="icon-price-tags"></i> &nbsp; <span><?php echo $getPer; ?>%</span></h5>
                          <h5><?php echo $key; ?> </h5>
                          <?php if($inc == 1) {?>
                         <div class="svg-center" id="pie_progress_bar"></div>
                         <?php }
                         else if($inc == 2) {
                            ?><div class="svg-center" id="arc_multi"></div><?php
                         }
                         else if($inc == 3) {
                            ?><div class="svg-center" id="arc_single2"></div><?php
                         }
                         else{

                         }
                         ?>
                          </div>
                      </div>
                    </div>
                  </div>
                <?php
                if($inc == 3){
                    break;
                }
                $inc++;
                }
              }?>
			  
			  
			  <!-- <div class="col-sm-6 col-md-4 result_box">
				<div class="panel panel-body boxshadow bkg4">
				  <div class="media no-margin">
					<div class="media-body text-left results">
				      <h5 class="mb0"><i class="icon-price-tag3"></i> &nbsp;  <span>0.9%</span></h5>
					  <h5 class="mb30">Delivery Experiance : Never Arrived </h5>
					 <div class="svg-center" id="arc_multi"></div>
					 </div>
				  </div>
				</div>
			  </div> -->

			 <!--  <div class="col-sm-6 col-md-4 result_box">
				<div class="panel panel-body boxshadow bkg7">
				  <div class="media text-left ">
					<div class="media-body results">
				  	  <h5 class="mb0"><i class="icon-price-tags2"></i> &nbsp;  <span>100%</span></h5>
					  <h5 class="mb30">Reviews Tags</h5>
					  <div class="svg-center" id="arc_single2"></div>
					  </div>
				  </div>
				</div>
			  </div> -->
			</div>
			
			 <!--#################################Map###########################-->
			<!-- <div class="row mb-20">
			  <div class="col-md-12">
				
					<div class="panel panel-flat shadow boxshadowbig ">
						<div class="panel-heading">
							<h5 class="panel-title">Stacked area</h5>
						</div>
						<div class="panel-body">
							<div class="chart-container">
								
								<div class="chart has-fixed-height" id="basic_columns"></div>
							</div>
						</div>
					</div>
					
			  </div>
			</div>  -->

            <?php $getUserTag = getUserTag();
                //pre($getUserTag);
            ?>
			
			<!--#################################Table###########################-->
			<div class="row">
			  <div class="col-md-12">
				<div style="border: none; margin: 0 -20px;" class="panel panel-flat no-boxshadow">
				  <div class="panel-heading">
					<h6 class="panel-title">Insight Tag Acticity</h6>
				  </div>
				  <div style="padding: 0px!important;" class="panel-body reports_sec">
					<div class="row">
					  <div class="col-md-12">
				
			  <div class="table-responsive">
                <input name="min" id="min" type="hidden">
                <input name="max" id="max" type="hidden">
				<table class="table datatable-sorting text-nowrap">
				  <thead>
					<tr>
                      <th class="">Group</th>
					  <th class="">Tag</th>
					  <th class="text-center">Total Feedback</th>
					  <th class="">Tagged Percentage</th>
                      <th class="">Tag Created</th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>

					</tr>
				  </thead>
				  <tbody>
                    <?php if(!empty($getUserTag)) {
                        $totalTagCount = count(getTags());
                        //pre($getUserTag);
                        foreach ($getUserTag as $value) {
                            if(!empty($value->tag_name)) {

                                $numberOfTagInGroup = numberOfTagInGroup($value->id);
                                $totalTagInGroup = count($numberOfTagInGroup);
                                $getTagFeedback = getTagFeedback($value->tagid);
                                //pre($numberOfTagInGroup);
                                if(!empty($getTagFeedback)) {

                                    $tagCount = count($getTagFeedback);
                                }
                                else {

                                    $tagCount = '<span style="color:#999999">No Data</span>';
                                }

                                if($tagCount > 0 && $totalTagCount > 0) {

                                    $getPercentage = round(($tagCount/$totalTagInGroup)*100).'%';
                                }
                                else {

                                    $getPercentage = '<span style="color:#999999">No Data</span>';
                                }
                                
                                ?>
                                    <tr>
                                      <td><h6 class="text-semibold"><?php echo $value->group_name; ?></h6></td>
                                      <td class=""><?php echo $value->tag_name; ?></td>
                                      <td class="text-center"><?php echo $tagCount; ?></td>
                                      <td class=""><?php echo $getPercentage; ?></td>
                                      <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($value->tag_created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($value->tag_created)) . ' (' . timeAgo($value->tag_created) . ')'; ?></div></h6></td>
                                      <td style="display: none;"></td>
                                      <td style="display: none;"></td>
                                      <td style="display: none;"><?php echo date('m/d/Y', strtotime($value->tag_created)); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
				  </tbody>
				</table>
			  </div>

					
					<div class="clearfix"></div>


					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>	
           
          
            </div>
            <!--########################TAB 2 ##########################-->
            
            <!--########################TAB end ##########################--> 
          </div>
        </div>
</div>	
</div>	
					
				
</div>
			

<script>			
// Daterange picker
// ------------------------------
$('.daterange-ranges').daterangepicker(
        {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2016',
            dateLimit: { days: 60 },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            applyClass: 'btn-small bg-slate-600 btn-block',
            cancelClass: 'btn-small btn-default btn-block',
            format: 'MM/DD/YYYY'
        },
        function(start, end) {
            $('.daterange-ranges span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
        }
    );

$('.daterange-ranges span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));
	

	
	
	
	
 // Initialize chart
    progressArcMulti("#arc_multi", 78, 700);
	progressArcMulti("#arc_multi2", 78, 700);

    // Chart setup
    function progressArcMulti(element, size, goal) {

        // Main variables
        var d3Container = d3.select(element),
            radius = size,
            thickness = 20,
            startColor = '#66BB6A',
            midColor = '#FFA726',
            endColor = '#EF5350';

        // Colors
        var color = d3.scale.linear()
            .domain([0, 70, 100])
            .range([startColor, midColor, endColor]);


        // Create chart
        // ------------------------------

        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
            .attr('width', radius * 2)
            .attr('height', radius + 20);


        // Construct chart layout
        // ------------------------------

        // Pie
        var arc = d3.svg.arc()
            .innerRadius(radius - thickness)
            .outerRadius(radius)
            .startAngle(-Math.PI / 2);


        // Append chart elements
        // ------------------------------

        //
        // Group arc elements
        //

        // Group
        var chart = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + radius + ')');

        // Background
        var background = chart.append('path')
            .datum({
                endAngle: Math.PI / 2
            })
            .attr({
                'd': arc,
                'fill': '#eee'
            });

        // Foreground
        var foreground = chart.append('path')
            .datum({
                endAngle: -Math.PI / 2
            })
            .style('fill', startColor)
            .attr('d', arc);

        // Counter value
        var value = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius * 0.9) + ')')
            .append('text')
            .text(0 + '%')
            .attr({
                'text-anchor': 'middle',
                'fill': '#555'
            })
            .style({
                'font-size': 19,
                'font-weight': 400
            });


        //
        // Min and max text
        //

        // Group
        var scale = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius + 15) + ')')
            .style({
                'font-size': 12,
                'fill': '#999'
            });

        // Max
        scale.append('text')
            .text(100)
            .attr({
                'text-anchor': 'middle',
                'x': (radius - thickness / 2)
            });

        // Min
        scale.append('text')
            .text(0)
            .attr({
                'text-anchor': 'middle',
                'x': -(radius - thickness / 2)
            });


        //
        // Animation
        //

        // Interval
        setInterval(function() {
            update(Math.random() * 100);
        }, 1500);

        // Update
        function update(v) {
            v = d3.format('.0f')(v);
            foreground.transition()
                .duration(750)
                .style('fill', function() {
                    return color(v);
                })
                .call(arcTween, v);

            value.transition()
                .duration(750)
                .call(textTween, v);
        }

        // Arc
        function arcTween(transition, v) {
            var newAngle = v / 100 * Math.PI - Math.PI / 2;
            transition.attrTween('d', function(d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);
                };
            });
        }

        // Text
        function textTween(transition, v) {
            transition.tween('text', function() {
                var interpolate = d3.interpolate(this.innerHTML, v),
                    split = (v + '').split('.'),
                    round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
                return function(t) {
                    this.innerHTML = d3.format('.0f')(Math.round(interpolate(t) * round) / round) + '<tspan>%</tspan>';
                };
            });
        }
    }
	

	
	
	  // Progress arc - single color
    // ------------------------------

    // Initialize chart
    progressArcSingle("#arc_single", 78);
	progressArcSingle("#arc_single2", 78);

    // Chart setup
    function progressArcSingle(element, size) {

        // Main variables
        var d3Container = d3.select(element),
            radius = size,
            thickness = 20,
            color = '#29B6F6';


        // Create chart
        // ------------------------------

        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
            .attr('width', radius * 2)
            .attr('height', radius + 20)
            .attr('class', 'gauge');


        // Construct chart layout
        // ------------------------------

        // Pie
        var arc = d3.svg.arc()
            .innerRadius(radius - thickness)
            .outerRadius(radius)
            .startAngle(-Math.PI / 2);


        // Append chart elements
        // ------------------------------

        //
        // Group arc elements
        //

        // Group
        var chart = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + radius + ')');

        // Background
        var background = chart.append('path')
            .datum({
                endAngle: Math.PI / 2
            })
            .attr({
                'd': arc,
                'fill': '#eee'
            });

        // Foreground
        var foreground = chart.append('path')
            .datum({
                endAngle: -Math.PI / 2
            })
            .style('fill', color)
            .attr('d', arc);

        // Counter value
        var value = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius * 0.9) + ')')
            .append('text')
            .text(0 + '%')
            .attr({
                'text-anchor': 'middle',
                'fill': '#555'
            })
            .style({
                'font-size': 19,
                'font-weight': 400
            });


        //
        // Min and max text
        //

        // Group
        var scale = svg.append('g')
            .attr('transform', 'translate(' + radius + ',' + (radius + 15) + ')')
            .style({
                'font-size': 12,
                'fill': '#999'
            });

        // Max
        scale.append('text')
            .text(100)
            .attr({
                'text-anchor': 'middle',
                'x': (radius - thickness / 2)
            });

        // Min
        scale.append('text')
            .text(0)
            .attr({
                'text-anchor': 'middle',
                'x': -(radius - thickness / 2)
            });


        //
        // Animation
        //

        // Interval
        setInterval(function() {
            update(Math.random() * 100);
        }, 1500);

        // Update
        function update(v) {
            v = d3.format('.0f')(v);
            foreground.transition()
                .duration(750)
                .call(arcTween, v);

            value.transition()
                .duration(750)
                .call(textTween, v);
        }

        // Arc
        function arcTween(transition, v) {
            var newAngle = v / 100 * Math.PI - Math.PI / 2;
            transition.attrTween('d', function(d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);
                };
            });
        }

        // Text
        function textTween(transition, v) {
            transition.tween('text', function() {
                var interpolate = d3.interpolate(this.innerHTML, v),
                    split = (v + '').split('.'),
                    round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
                return function(t) {
                    this.innerHTML = d3.format('.0f')(Math.round(interpolate(t) * round) / round) + '<tspan>%</tspan>';
                };
            });
        }
    }

  
	 // Pie with progress bar
    // ------------------------------

    // Initialize chart
    pieWithProgress("#pie_progress_bar", 100);
	pieWithProgress("#pie_progress_bar2", 100);

    // Chart setup
    function pieWithProgress(element, size) {

        // Demo dataset
        var dataset = [
                { name: 'New', count: 639 },
                { name: 'Pending', count: 255 },
                { name: 'Shipped', count: 215 }
            ];

        // Main variables
        var d3Container = d3.select(element),
            total = 0,
            width = size,
            height = size,
            progressSpacing = 6,
            progressSize = (progressSpacing + 2),
            arcSize = 20,
            outerRadius = (width / 2),
            innerRadius = (outerRadius - arcSize);

        // Colors
        var color = d3.scale.ordinal()
            .range(['#EF5350', '#29b6f6', '#66BB6A']);


        // Create chart
        // ------------------------------

        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
            .attr("width", width)
            .attr("height", height)
            .append("g")
                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");


        // Construct chart layout
        // ------------------------------

        // Add dataset
        dataset.forEach(function(d){
            total+= d.count;
        });

        // Pie layout
        var pie = d3.layout.pie()
            .value(function(d){ return d.count; })
            .sort(null);

        // Inner arc
        var arc = d3.svg.arc()
            .innerRadius(innerRadius)
            .outerRadius(outerRadius);

        // Line arc
        var arcLine = d3.svg.arc()
            .innerRadius(innerRadius - progressSize)
            .outerRadius(innerRadius - progressSpacing)
            .startAngle(0);


        // Append chart elements
        // ------------------------------

        //
        // Animations
        //
        var arcTween = function(transition, newAngle) {
            transition.attrTween("d", function (d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                var interpolateCount = d3.interpolate(0, dataset[0].count);
                return function (t) {
                    d.endAngle = interpolate(t);
                    middleCount.text(d3.format(",d")(Math.floor(interpolateCount(t))));
                    return arcLine(d);
                };
            });
        };


        //
        // Donut paths
        //

        // Donut
        var path = svg.selectAll('path')
            .data(pie(dataset))
            .enter()
            .append('path')
            .attr('d', arc)
            .attr('fill', function(d, i) {
                return color(d.data.name);
            })
            .style({
                'stroke': '#fff',
                'stroke-width': 2,
                'cursor': 'pointer'
            });

        // Animate donut
        path
            .transition()
            .delay(function(d, i) { return i; })
            .duration(600)
            .attrTween("d", function(d) {
                var interpolate = d3.interpolate(d.startAngle, d.endAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);  
                }; 
            });


        //
        // Line path 
        //

        // Line
        var pathLine = svg.append('path')
            .datum({endAngle: 0})
            .attr('d', arcLine)
            .style({
                fill: color('New')
            });

        // Line animation
        pathLine.transition()
            .duration(600)
            .delay(300)
            .call(arcTween, (2 * Math.PI) * (dataset[0].count / total));


        //
        // Add count text
        //

        var middleCount = svg.append('text')
            .datum(0)
            .attr('dy', 6)
            .style({
                'font-size': '14px',
                'font-weight': 500,
                'text-anchor': 'middle'
            })
            .text(function(d){
                return d;
            });            


        //
        // Add interactions
        //

        // Mouse
        path
            .on('mouseover', function(d, i) {
                $(element + ' [data-slice]').css({
                    'opacity': 0.3,
                    'transition': 'all ease-in-out 0.15s'
                });
                $(element + ' [data-slice=' + i + ']').css({'opacity': 1});
            })
            .on('mouseout', function(d, i) {
                $(element + ' [data-slice]').css('opacity', 1);
            });


        //
        // Add legend
        //

        // Append list
        var legend = d3.select(element)
            .append('ul')
            .attr('class', 'chart-widget-legend')
            .selectAll('li')
            .data(pie(dataset))
            .enter()
            .append('li')
            .attr('data-slice', function(d, i) {
                return i;
            })
            .attr('style', function(d, i) {
                return 'border-bottom: solid 2px ' + color(d.data.name);
            })
            .text(function(d, i) {
                return d.data.name + ': ';
            });

        // Append legend text
        legend.append('span')
            .text(function(d, i) {
                return d.data.count;
            });
    }

</script>	<?php */ ?>
  
  <script src = "https://code.highcharts.com/highcharts.js"></script>
  <style>
  .highcharts-tick{stroke:none!important}
  .highcharts-legend, .highcharts-credits{display: none!important;}
  .highcharts-container, .highcharts-container svg {width: 100% !important;}
  </style>
 
      <div class="content">
      
      <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
      <div class="page_header">
        <div class="row">
        <!--=============Headings & Tabs menu==============-->
        <div class="col-md-7">
          <h3><img style="width: 16px;" src="/assets/images/analysis_icon.png"> Insight Tags</h3>
          <ul class="nav nav-tabs nav-tabs-bottom">
          <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Today</a></li>
          <li><a href="#right-icon-tab1" data-toggle="tab">Yesterday</a></li>
          <li><a href="#right-icon-tab2" data-toggle="tab">Week</a></li>
          <li><a href="#right-icon-tab3" data-toggle="tab">Month</a></li>
          <li><a href="#right-icon-tab4" data-toggle="tab">3 Month</a></li>
          </ul>
          
        </div>
        <!--=============Button Area Right Side==============-->
        <div class="col-md-5 text-right btn_area">
         <div class="btn-group">
                        <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reports &nbsp; &nbsp; <span class="caret"></span>
                        </button>
              <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                <div class="dropdown-content-heading"> Filter
                <ul class="icons-list">
                  <li><a href="#"><i class="icon-more"></i></a> </li>
                </ul>
                </div>
                <div class="">
                <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                  <div class="panel panel-white">
                  <div class="panel-heading sidebarheadings active">
                    <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                  </div>
                  <div id="accordion-control-right-group1" class="panel-collapse collapse">
                    <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12"> 
                Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                 </div>
                    </div>
                    </div>
                  </div>
                  </div>
                  <div class="panel panel-white">
                  <div class="panel-heading sidebarheadings">
                    <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                  </div>
                  <div id="accordion-control-right-group2" class="panel-collapse collapse">
                    <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12"> Conetent Goes here... </div>
                    </div>
                    </div>
                  </div>
                  </div>
                  <div class="panel panel-white">
                  <div class="panel-heading sidebarheadings">
                    <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                  </div>
                  <div id="accordion-control-right-group73" class="panel-collapse collapse">
                    <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12"> Conetent Goes here... </div>
                    </div>
                    </div>
                  </div>
                  </div>
                  <div class="panel panel-white">
                  <div class="panel-heading sidebarheadings">
                    <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                  </div>
                  <div id="accordion-control-right-group74" class="panel-collapse collapse">
                    <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12"> Conetent Goes here... </div>
                    </div>
                    </div>
                  </div>
                  </div>
                  <div class="panel panel-white">
                  <div class="panel-heading sidebarheadings">
                    <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                  </div>
                  <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                    <div class="panel-body">
                    <div class="row mb20">
                      <div class="col-xs-6">
                      <div class="checkbox">
                      <label>
                      <input type="checkbox"  class="control-primary" checked="checked">
                      Total Reviews
                      </label>
                      </div>
                      </div>
                      <div class="col-xs-6">
                      <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                      </div>

                    </div>
                    <div class="row mb20">
                      <div class="col-xs-6">
                      <div class="checkbox">
                      <label>
                      <input type="checkbox"  class="control-primary" checked="checked">
                      Positive
                      </label>
                      </div>
                      </div>
                      <div class="col-xs-6">
                      <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                      </div>

                    </div>
                    <div class="row mb20">
                      <div class="col-xs-6">
                      <div class="checkbox">
                      <label>
                      <input type="checkbox"  class="control-primary">
                      Neutral
                      </label>
                      </div>
                      </div>
                      <div class="col-xs-6">
                      <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                      <div class="checkbox">
                      <label>
                      <input type="checkbox"  class="control-primary" checked="checked">
                      Negative
                      </label>
                      </div>
                      </div>
                      <div class="col-xs-6">
                      <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                      </div>

                    </div>
                    </div>
                  </div>
                  </div>
                </div>
                </div>
                <div class="dropdown-content-footer">
                  <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                  &nbsp; &nbsp;
                  <a style="display: inline-block;" href="#">Clear All</a>
                </div>
              </div>
            </div>
         </div>
        </div>
      </div>
      <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
      
      
        <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
       <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <div class="panel panel-flat">
                  <div class="panel-heading">
                  <h6 class="panel-title">Services</h6>
                  <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
                  </div>
                  <div class="panel-body p0 pb10 min_h270" >
                  <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/service_icon.png"/></div>
                  <div id = "semi_circle_chart" class="br5" style = "width: 100%; height: 240px; "></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                
                
                <div class="panel panel-flat">
                  <div class="panel-heading">
                  <h6 class="panel-title">Resolution</h6>
                  <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
                  </div>
                  <div class="panel-body p0 pb10 min_h270" >
                  <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/resolution_icon.png"/></div>
                  <div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 240px;"></div>
                  </div>
                </div>
                
                
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              
              <div class="col-md-12">
              <div class="panel panel-flat">
            <div class="panel-heading">
            <h6 class="panel-title">Queries</h6>
            <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
            </div>
            <div class="panel-body p0 pl20 pr20 min_h270 bkg_white">
            <div class="p20 pl0 topchart_value">
              <div class="row">
                <div class="col-xs-4 brig">
                <h1 class="m0">1.320</h1>
                <p>Services <span style="border: none;" class="label ">5.9%</span></p>
                </div>
                <div class="col-xs-4">
                <h1 class="m0">967</h1>
                <p>Queries <span style="border: none;" class="label bkg_green">5.9%</span></p>
                </div>
                
              </div>
            </div>
            
            
            <div id="column_graph" style="height: 185px;"></div>
            </div>
          </div>
              
              
              
              
                
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
          <div class="panel panel-flat">
            <div class="panel-heading">
            <h6 class="panel-title">Insight Tag Acticity</h6>
            <div class="heading-elements">
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
														<input class="form-control input-sm" placeholder="Search by name" type="text">
														<div class="form-control-feedback">
															<i class="icon-search4"></i>
														</div>
													</div>
													<div class="table_action_tool">
														<a href="#"><i class="icon-calendar52"></i></a>
														<a href="#"><i class="icon-arrow-down16"></i></a>
														<a href="#"><i class="icon-arrow-up16"></i></a>
														<a href="#"><i class="icon-pencil"></i></a>
													</div>
													
								</div>
            </div>
            <div class="panel-body p0">
            <?php $getUserTag = getUserTag();
                //pre($getUserTag);
            ?>
<table class="table datatable-basic">
  <thead>
    <tr>
      <th style="display: none;"></th>
      <th style="display: none;"></th>
      <th>Name</th>
      <th>Tag</th>
      <th>Total Feedback</th>
      <th>Tagged Percentage</th>
      <th>Created</th>
     <!--  <th>Mentions</th>
      <th>Coverage %</th>
      <th>Average Rating</th>
      <th>Sentiment %</th>
      <th>Snippets</th> -->
      
    
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($getUserTag)) {
                        $totalTagCount = count(getTags());
                        //pre($getUserTag);
                        foreach ($getUserTag as $value) {
                            if(!empty($value->tag_name)) {

                                $numberOfTagInGroup = numberOfTagInGroup($value->id);
                                $totalTagInGroup = count($numberOfTagInGroup);
                                $getTagFeedback = getTagFeedback($value->tagid);
                                //pre($numberOfTagInGroup);
                                if(!empty($getTagFeedback)) {

                                    $tagCount = count($getTagFeedback);
                                }
                                else {

                                    $tagCount = '<span style="color:#999999">No Data</span>';
                                }

                                if($tagCount > 0 && $totalTagCount > 0) {

                                    $getPercentage = round(($tagCount/$totalTagInGroup)*100).'%';
                                }
                                else {

                                    $getPercentage = '<span style="color:#999999">No Data</span>';
                                }
                                /*
                                ?>
                                    <tr>
                                      <td><h6 class="text-semibold"><?php echo $value->group_name; ?></h6></td>
                                      <td class=""><?php echo $value->tag_name; ?></td>
                                      <td class="text-center"><?php echo $tagCount; ?></td>
                                      <td class=""><?php echo $getPercentage; ?></td>
                                      <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($value->tag_created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($value->tag_created)) . ' (' . timeAgo($value->tag_created) . ')'; ?></div></h6></td>
                                      <td style="display: none;"></td>
                                      <td style="display: none;"></td>
                                      <td style="display: none;"><?php echo date('m/d/Y', strtotime($value->tag_created)); ?></td>
                                    </tr>
                                    <?php
                                    */
                                }
                            }
                        }
                    ?>
    <!--================================================-->
    <?php 

    if(!empty($getUserTag)) {
      $totalTagCount = count(getTags());
      //pre($getUserTag);
      foreach ($getUserTag as $value) {
          if(!empty($value->tag_name)) {

                    $numberOfTagInGroup = numberOfTagInGroup($value->id);
                    $totalTagInGroup = count($numberOfTagInGroup);
                    $getTagFeedback = getTagFeedback($value->tagid);
                    //pre($numberOfTagInGroup);
                    if(!empty($getTagFeedback)) {

                        $tagCount = count($getTagFeedback);
                    }
                    else {

                        $tagCount = '<span style="color:#999999">No Data</span>';
                    }

                    if($tagCount > 0 && $totalTagCount > 0) {

                        $getPercentage = round(($tagCount/$totalTagInGroup)*100).'%';
                    }
                    else {

                        $getPercentage = '<span style="color:#999999">No Data</span>';
                    }
                    
                    ?>
                    <tr>
                      <td style="display: none;"></td>
                      <td style="display: none;"><?php echo date('m/d/Y', strtotime($value->tag_created)); ?></td>
                      <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                        <div class="media-left">
                          <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold"><?php echo $value->group_name; ?></a> </div>
                        </div></td>
                      <td><span class="txt_dgrey"><?php echo $value->tag_name; ?></span></td>
                      <td><span class="txt_dgrey"><?php echo $tagCount; ?></span></td>
                      <td><span class="txt_dgrey"><?php echo $getPercentage; ?></span></td>
                      <td>
                        <div class="media-left">
                          <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date(' d M, Y', strtotime($value->tag_created)); ?></a></div>
                          <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($value->tag_created)) . ' (' . timeAgo($value->tag_created) . ')'; ?></div>
                        </div>
                      </td>
                      <!-- <td><span class="txt_dgrey">13.5%</span></td>
                      <td><span class="txt_dgrey">3.9</span></td>
                      <td><span class="txt_dgrey">100%</span></td>
                      <td><span class="txt_dgrey">Most Recent Positive Comments</span></td> -->
                    </tr>
                    <?php
                }
            }
        }
    ?>
    <!--================================================-->
  
    
  </tbody>
</table>
            </div>
          </div>
          </div>
        </div>
        
        </div>
        <!--===========TAB 2===========-->
        <div class="tab-pane" id="right-icon-tab1"> </div>
        <!--===========TAB 3====Preferences=======-->
        <div class="tab-pane" id="right-icon-tab2"> </div>
        <!--===========TAB 4====Chat Widget=======-->
        <div class="tab-pane" id="right-icon-tab3"> </div>
        <!--===========TAB 5===========-->
        <div class="tab-pane" id="right-icon-tab4"> </div>
       </div>
       <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
    
    
    
      
    
      
      
      </div>

<script>

  // top navigation fixed on scroll and side bar collasped
  
    $( window ).scroll( function () {
      var sc = $( window ).scrollTop();
      if ( sc > 100 ) {
        $( "#header-sroll" ).addClass( "small-header" );
      } else {
        $( "#header-sroll" ).removeClass( "small-header" );
      }
    } );

    function smallMenu() {
      if ( $( window ).width() < 1600 ) {
        $( 'body' ).addClass( 'sidebar-xs' );
      } else {
        $( 'body' ).removeClass( 'sidebar-xs' );
      }
    }

    $( document ).ready( function () {
      smallMenu();

      window.onresize = function () {
        smallMenu();
      };
    } );
  

  
  
  

  
  </script>
  
  
  
  <script>
  //Semi Circle chart js -- Highcharts js plugins
  
  
         $(document).ready(function() {
            var chart = {
               plotBackgroundColor: false,
               plotBorderWidth: 0,
               plotShadow: false
            };
            var title = {
               text: '83% <br> <span style="border: none;" class="label bkg_green ml0 ">15.9%</span>',
               align: 'center',
               verticalAlign: 'middle',
               y: 60    
            };   
       
       var title2 = {
               text: '52% <br> <span style="border: none;" class="label bkg_green ml0 ">22.9%</span>',
               align: 'center',
               verticalAlign: 'middle',
               y: 60    
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
         colors: ['#28adc5', '#bae2ea', '#8bbc21', '#910000'],
               innerSize: '85%',
               data: [
                  ['A',   52],
                  ['B',    48],
                
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
         colors: ['#28adc5', '#bae2ea', '#8bbc21', '#910000'],
               innerSize: '85%',
               data: [
                  ['A',   19],
                  ['B',    81],
                
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
      </script>
  
  
  
<script>
  Highcharts.chart('column_graph', {
    chart: {
        type: 'column'
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
  
  colors: ['#238398', '#36b5a4', '#8bbc21', '#910000'],
    
    credits: {
    enabled: false
    },
    
  backgroundColor: null,  
  
    xAxis: {
        categories: [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            '11',
            '12'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
    uniqueNames: false,
        title: {
            text: null
        }
    },
  

    plotOptions: {
        column: {
            pointPadding: 0.25,
            borderWidth: 0,
      borderRadius: 5
        }
    },
    

    
    
    series: [{
    showInLegend: false,   
        name: 'A',
        data: [39.9, 31.5, 26.4, 19.2, 24.0, 36.0, 35.6, 38.5, 16.4, 14.1, 35.6, 24.4]

    }, {
    showInLegend: false,   
        name: 'B',
        data: [33.6, 38.8, 38.5, 23.4, 26.0, 34.5, 35.0, 14.3, 21.2, 33.5, 36.6, 12.3]

    }]
});
    


  </script>
  @endsection