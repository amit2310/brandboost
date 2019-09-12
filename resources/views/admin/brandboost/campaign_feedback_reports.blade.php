   @extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')

<div class="content">

	<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img style="width: 16px;" src="/assets/images/analysis_icon.png"> Feedback Report</h3>

            </div>
            <!--=============Button Area Right Side==============-->
              <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Reports &nbsp; &nbsp; <span class="caret"></span>
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
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    @php
		$ratingOne = 0;
		$ratingTwo = 0;
		$ratingThree = 0;
		$ratingFour = 0;
		$ratingFive = 0;
		foreach($aData['bbStatsData'] as $statsData){
			if($statsData->ratings == 1){
				$ratingOne = $ratingOne + 1;
			}
			if($statsData->ratings == 2){
				$ratingTwo = $ratingTwo + 1;
			}
			if($statsData->ratings == 3){
				$ratingThree = $ratingThree + 1;
			}
			if($statsData->ratings == 4){
				$ratingFour = $ratingFour + 1;
			}
			if($statsData->ratings == 5){
				$ratingFive = $ratingFive + 1;
			}
		}
		$totalReviews = $ratingOne+$ratingTwo+$ratingThree+$ratingFour+$ratingFive;
		$avgRating = ($ratingOne+($ratingTwo*2)+($ratingThree*3)+($ratingFour*4)+($ratingFive*5))/$totalReviews;

	@endphp
    <div class="tab-content">
        <div class="row">

        	<div class="col-sm-6 col-md-4 result_box">
        	<div class="panel panel-flat review_ratings">
			  <div class="panel-heading">
				<h6 class="panel-title">Review Ratings<a class="heading-elements-toggle"><i class="icon-more"></i></a><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
				<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
			  </div>
			  <div class="panel-body p0">
			  <div class="pt20 pb20 pl40 pr40 bbot">
			  	<h1><i class="icon-star-full2"></i> 4.2 <sup><i class="icon-arrow-up5"></i> &nbsp; +15%</sup></h1>
			  </div>
			  <div class="p40 ratings">
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i>
					</div>
					<div class="col-xs-6 text-right"><p>24% <span>5</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
					</div>
					</div>
				</div>
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i>
					</div>
					<div class="col-xs-6 text-right"><p>61% <span>17</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:70%"></div>
					</div>
					</div>
				</div>
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i>
					</div>
					<div class="col-xs-6 text-right"><p>3% <span>1</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:20%"></div>
					</div>
					</div>
				</div>
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i>
					</div>
					<div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
					</div>
					</div>
				</div>
				<div class="row inner mb0">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i>
					</div>
					<div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
					</div>
					</div>
				</div>


				</div>
			  </div>
			</div>
		    </div>

			<div class="col-sm-6 col-md-4 result_box">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Product Feedback Received<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				  </div>
				  <div class="panel-body p0">
					<div class="image_video">
						<div class="panel panel-body boxshadow">
							<div class="media no-margin">
								<div class="media-body text-left results">
									<h5 class="mb0"><i class="icon-bubbles6"></i> &nbsp;  <span>{{ $totalReviews }}</span></h5>
									<h5 class="mb30">Product Feedback Received</h5>
									<div class="svg-center" id="arc_multi"></div>
								</div>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 result_box">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Product Warnings<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				  </div>
				  <div class="panel-body p0">
					<div class="image_video">
						<div class="panel panel-body boxshadow bkg7">
							<div class="media text-left ">
								<div class="media-body results">
									<h5 class="mb0"><i class="icon-bubble-notification"></i> &nbsp;  <span>5</span></h5>
									<h5 class="mb30">Product Warnings</h5>
									<div class="svg-center" id="arc_single2"></div>
								</div>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>



			<div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Product</h6>
                        <div class="heading-elements">
                            <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                <div class="form-control-feedback">
                                    <i class="icon-search4"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body p0">
                        <table class="table datatable-basic datatable-sorting">
                        	<thead>
								<tr>
									<th style="display: none;"></th>
									<th>Feedback Activity</th>
									<th class="text-center">Feedback Received</th>
									<th class="text-center">5 Star</th>
									<th class="text-center">4 Star</th>
									<th class="text-center">3 Star</th>
									<th class="text-center">2 Star</th>
									<th style="display: none;"></th>
									<th class="text-center">1 Star </th>
								</tr>
							</thead>
							<tbody>
								@php
									foreach($aData['bbStatsData'] as $bbData){
										$ratingOne = 0;
										$ratingTwo = 0;
										$ratingThree = 0;
										$ratingFour = 0;
										$ratingFive = 0;
										$bbReportData = getBBReportStats(date('Y-m-d', strtotime($bbData->created)));
										foreach($bbReportData as $statsData){
											if($statsData->ratings == 1){
												$ratingOne = $ratingOne + 1;
											}
											if($statsData->ratings == 2){
												$ratingTwo = $ratingTwo + 1;
											}
											if($statsData->ratings == 3){
												$ratingThree = $ratingThree + 1;
											}
											if($statsData->ratings == 4){
												$ratingFour = $ratingFour + 1;
											}
											if($statsData->ratings == 5){
												$ratingFive = $ratingFive + 1;
											}
										}
									@endphp
									<tr>
										<td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>

										<td>
                                                                                    <div class="media-left">
                                                                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($bbData->created)) }}</a></div>
                                                                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($bbData->created)) }}</div>
                                                                                    </div>
                                                                                </td>
										<td class="text-center"><a href="#">{{ $bbData->totalNo }}</a></td>
										<td class="text-center"><a href="#">{{ $ratingFive }}</a></td>
										<td class="text-center"><a href="#">{{ $ratingFour }}</a></td>
										<td class="text-center"><a href="#">{{ $ratingThree }}</a></td>
										<td class="text-center"><a href="#">{{ $ratingTwo }}</a></td>
										<td style="display: none;">{{ date('m/d/Y', strtotime($bbData->created)) }}</td>
										<td class="text-center"><a href="#">{{ $ratingOne }}</a></td>

									</tr>
								@php } @endphp

							</tbody>
                       	</table>
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

</script>
@endsection
