    @extends('layouts.main_template') 

	@section('title')
	<?php echo $title; ?>
	@endsection

	@section('contents')
	<script type="text/javascript" src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
	
	<style>
	#canvas3{height: 230px !important;}
	</style>
	
	  <div class="content">
	  
	  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
		<div class="page_header">
		  <div class="row">
		  <!--=============Headings & Tabs menu==============-->
			<div class="col-md-7">
			  <h3 class="mt20"><img style="width: 18px;" src="<?php echo base_url(); ?>assets/images/refferal_icon.png"> Referral Overview</h3>
			</div>
		  </div>
		</div>
	  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
	  
	  
	    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
		 <div class="tab-content"> 
		  <!--===========TAB 1===========-->
		  <div class="tab-pane active" id="right-icon-tab0">
		  
		  	<!--====Top Section Graph====-->
			<div class="row">
			<div class="col-md-6">
					<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Revenue</h6>
					<div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
				  </div>
				 
				  <div class="panel-body p20 min_h300 bkg_white">
				  	<div class="row">
				  	<div class="col-xs-6"><h1 class="m0 fsize20 fw700"><img src="<?php echo base_url(); ?>assets/images/green_dollar_icon.png"/> &nbsp; $0</h1></div>
				  	<div class="col-xs-6 text-right"><p class="fsize12"><span class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</span>&nbsp; &nbsp; <span class="txt_grey">from last month</span></p></div>
				  	</div>
				  	
				  	<div class="row">
				  	<div class="col-xs-12"><canvas id="canvas3"></canvas></div>
				  	</div>
					
				  </div>
				</div>
				</div>
			
			
			<div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Referrals<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				  </div>
				  <div class="panel-body min_h300 p0 bkg_white text-center">
				  <div class="p20">
				  	<img class="mt20" src="<?php echo base_url(); ?>assets/images/referal_rate_icon.png"/ width="96">
				  </div>
				  <div class="p20">
				  
				  	<h1 class="txt_dark fsize28 mt0 mb10 fw700"><?php echo count($oPrograms); ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Rate <span class="txt_green fsize12"><i class="fa fa-arrow-up"></i> 33,87%</span></p>
				  </div>
				  </div>
				  
				  
				</div>
			  </div>
			  
			  
			  <div class="col-md-3">
			<div class="panel panel-flat">
			  <div class="panel-heading">
				<h6 class="panel-title">Info Card<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
				<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
			  </div>
			  <div class="panel-body min_h300 p30 info_card text-center bkg_white">
				<div class="mb20"><img src="<?php echo base_url(); ?>assets/images/refferal_icon_big.png" width="62"></div>
				<p class="mb10"><strong>Ideas to improve your referral rate</strong></p>
				<p class="mb20"><span>Check out our epic list of 74 referral<br> program examples for businesses<br> of all types</span></p>
				<a class="txt_green" href="#">Learn More</a>
			  </div>
			</div>
			</div>	
				
			</div>
			<!--====Stats====-->
			<div class="row">
				<div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon1.png"/>
				  	<h1 class="txt_dark fsize28 fw700"><?php echo count($oEmail); ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Emails</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon2.png"/>
				  	<h1 class="txt_dark fsize28 fw700"><?php echo count($oClick); ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Clicks</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon3.png"/>
				  	<h1 class="txt_dark fsize28 fw700"><?php echo count($oVisite); ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Visits</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon4.png"/>
				  	<h1 class="txt_dark fsize28 fw700">0</h1>
				  	<p class="fsize14 txt_dgrey mb0">Sales</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			</div>
			<!--====Table====-->
			<div class="row">
			  <div class="col-md-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Live Visitors</h6>
						<div class="heading-elements">
							<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
								<input class="form-control input-sm cus_search" tableId="referralList" placeholder="Search by name" type="text">
								<div class="form-control-feedback">
									<i class="icon-search4"></i>
								</div>
							</div>
							<div class="table_action_tool">
								<a href="#"><i class="icon-calendar52"></i></a>
								<a style="cursor: pointer; display: none;" id="deleteBulkReferral" class="custom_action_box"><i class="icon-trash position-left"></i></a>
								<a style="cursor: pointer; display: none;" id="archiveBulkReferral" class="custom_action_box"><i class="icon-gear position-left"></i> </a>
							</div>

						</div>
					</div>
					<div class="panel-body p0">
						<table class="table datatable-basic-new" id="referralList">
							<thead>
								<tr>
									<th style="display: none;"></th>
									<th style="display: none;"></th>
									<th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
									<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_date.png"/></i> Programs</th>
									<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_people.png"/></i> Advocated</th>
									<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_click.png"/></i> </th>
									<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_display.png"/></i> </th>
									<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh2.png"/></i> </th>
									<th><i class="icon-calendar"></i>Last Incoming Lead</th>
									<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_date.png"/></i> Created</th>
									<th><i class="icon-diff-modified"></i>Status</th>
									<th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
									<th style="display: none;"></th>
								</tr>
							</thead>
							<tbody>

								<!--================================================-->
								<?php
								
								foreach ($oPrograms as $oProgram):
									$oContacts = \App\Models\Admin\Modules\ReferralModel::getMyAdvocates($oProgram->hashcode);
									$lastContactList = end($oContacts);

									if (!empty($lastContactList->created)) {
										$lastListTime = timeAgo($lastContactList->created);
									} else {
										$lastListTime = '<div class="media-left">
												  <div class="">
													<span class="text-muted text-size-small">[No Data]</span>                                                          </div>
												</div>';
									}

									$oTotalReferralSent = \App\Models\Admin\Modules\ReferralModel::getStatsTotalSent($oProgram->id);
									$oTotalReferralTwillio = \App\Models\Admin\Modules\ReferralModel::getStatsTotalTwillio($oProgram->id);

									$totalEmailSent = $totalSmsSent = 0;
									if (!empty($oTotalReferralSent)) {

										foreach ($oTotalReferralSent as $sentCount) {

											if ($sentCount->campaign_type == 'email') {
												$totalEmailSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
											}

											if ($sentCount->campaign_type == 'sms') {
												$totalSmsSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
											}
										}
									}
									$totalDelivered = $totalOpened = $totalProcessed = $totalClicked = 1;
									if (!empty($oTotalReferralTwillio)) {
										foreach ($oTotalReferralTwillio as $twilliRec) {
											//pre($twilliRec);
											if ($twilliRec->event_name == 'delivered') {
												$totalDelivered = $twilliRec->totalCount;
											} else if ($twilliRec->event_name == 'open') {
												$totalOpened = $twilliRec->totalCount;
											} else if ($twilliRec->event_name == 'processed') {
												$totalProcessed = $twilliRec->totalCount;
											} else if ($twilliRec->event_name == 'click') {
												$totalClicked = $twilliRec->totalCount;
											}
										}
									}
									?>
									<tr id="append-<?php echo $oProgram->id; ?>" class="selectedClass">
										<td style="display: none;"><?php echo date('m/d/Y', strtotime($oProgram->created)); ?></td>
										<td style="display: none;"><?php echo $oProgram->id; ?></td>
										<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]"  id="chk<?php echo $oProgram->id; ?>" class="checkRows" value="<?php echo $oProgram->id; ?>" ><span class="custmo_checkmark"></span></label></td>

										<td><div class="media-left media-middle"> <img width="24" src="<?php echo base_url(); ?>assets/images/referal_ov_icon.png"/> </div>
											<div class="media-left">
												<div class=""><a href="<?php echo base_url() ?>admin/modules/referral/setup/<?php echo $oProgram->id; ?>" class="text-default text-semibold bbot"><?php echo $oProgram->title; ?></a></div>
											</div></td>


										<td><div style="width: 117px;" class="media-left text-right pr40 brig"><a href="<?php echo base_url(); ?>admin/modules/referral/advocates/<?php echo $oProgram->id; ?>" class="text-default text-semibold"><?php echo count($oContacts) > 0 ? count($oContacts) : 0; ?></a></div></td>
										<td>
											<?php
											if ($totalEmailSent > 0) {
												$positiveGraph = 100;
												$positiveRating = $totalEmailSent;
											} else {
												$positiveGraph = 0;
												$positiveRating = 0;
											}

											$addPC = '';
											if ($positiveGraph > 50) {
												$addPC = 'over50';
											}
											?>
											<div class="media-left">
												<div class="progress-circle <?php echo $addPC; ?> teal cp<?php echo $positiveGraph; ?> <?php if ($positiveGraph > 0): ?>createSegment<?php endif; ?>" segment-type="total-sent" campaign-id="<?php echo $oProgram->id; ?>" campaign-type="email" title="click to create segment">
													<div class="left-half-clipper">
														<div class="first50-bar"></div>
														<div class="value-bar"></div>
													</div>
												</div>
											</div>
											<div class="media-left">
												<div data-toggle="tooltip" title="<?php echo $positiveRating; ?> email send" data-placement="top">
													<?php
													if ($positiveRating > 0) {
														?>
														<a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
														<?php
													} else {
														?>
														<a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
													<?php }
													?>  

												</div>
											</div>

										</td>
										<td>
											<?php
											if ($totalOpened > 0) {
												$positiveGraph = 100;
												$positiveRating = $totalOpened;
											} else {
												$positiveGraph = 0;
												$positiveRating = 0;
											}

											$addPC = '';
											if ($positiveGraph > 50) {
												$addPC = 'over50';
											}
											?>
											<div class="media-left">
												<div class="progress-circle <?php echo $addPC; ?> dark_green cp<?php echo $positiveGraph; ?> <?php if ($positiveGraph > 0): ?>createSegment<?php endif; ?>" segment-type="total-open" campaign-id="<?php echo $oProgram->id; ?>" campaign-type="email" title="click to create segment">
													<div class="left-half-clipper">
														<div class="first50-bar"></div>
														<div class="value-bar"></div>
													</div>
												</div>
											</div>
											<div class="media-left">
												<div data-toggle="tooltip" title="<?php echo $positiveRating; ?> email open" data-placement="top">
													<?php
													if ($positiveRating > 0) {
														?>
														<a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
														<?php
													} else {
														?>
														<a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
													<?php }
													?>   

												</div>
											</div>


										</td>
										<td>
											<?php
											$totPerClick = ceil($totalClicked * 100 / $totalOpened);

											$addPC = '';
											if ($totPerClick > 50) {
												$addPC = 'over50';
											}
											?>
											<div class="media-left">
												<div class="progress-circle <?php echo $addPC; ?> green cp<?php echo $totPerClick; ?> <?php if ($totPerClick > 0): ?>createSegment<?php endif; ?>" segment-type="total-click" campaign-id="<?php echo $oProgram->id; ?>" campaign-type="email" title="click to create segment">
													<div class="left-half-clipper">
														<div class="first50-bar"></div>
														<div class="value-bar"></div>
													</div>
												</div>
											</div>
											<div class="media-left">
												<div data-toggle="tooltip" title="<?php echo $totalClicked; ?> email clicked" data-placement="top">
													<?php
													if ($totalClicked > 0) {
														?>
														<a href="javascript:void(0);" class="text-default text-semibold"><?php echo $totalClicked; ?></a>
														<?php
													} else {
														?>
														<a href="javascript:void(0);" class="text-default text-semibold"><?php echo $totalClicked; ?></a>
													<?php }
													?>
												</div>
											</div>

										</td>
										<td><?php echo $lastListTime; ?> </td>
										<td>														
											<div class="media-left">
												<div class=""><span class="text-default text-semibold"><?php echo dataFormat($oProgram->created); ?></span></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oProgram->created)); ?></div>
											</div>
										</td>
										<td>

											<div class="tdropdown">
												<?php
												if ($oProgram->status == "draft") {
													echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
												} else if ($oProgram->status == 'archive') {
													echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
												} else {
													echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
												}
												?>
												<a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
													<?php
													if ($oProgram->status == "draft") {
														echo 'Inactive';
													} else if ($oProgram->status == "archive") {
														echo 'Archive';
													} else {
														echo 'Active';
													}
													?>

												</a>
												<ul class="dropdown-menu dropdown-menu-right status">

												</ul>
											</div>
										</td>

										<td class="text-center">
											<div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
												<ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
													<li><a target="_blank" href="<?php echo base_url('admin/modules/referral/reports/' . $oProgram->id); ?>"><i class="icon-file-stats"></i> Reports</a></li>
													
													<li><a target="_blank" href="<?php echo base_url('admin/modules/referral/stats/' . $oProgram->id); ?>"><i class="icon-file-stats"></i>Stats</a></li>
												</ul>
											</div>
										</td>
										<td style="display: none;"><?php
											if ($oProgram->status == 'archive') {
												echo 'archive';
											} else {
												echo 'active';
											}
											?></td>
									</tr>
									<?php
									//}
								endforeach;
								?>

							</tbody>
						</table>
					</div>
				</div>
			  </div>
			</div>
			
		  </div>
		  
		 </div>
		 <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->

	  </div>

<script type="text/javascript">
$(document).ready(function () {
	var tableId = 'referralList';
	var tableBase = custom_data_table(tableId); 
});
</script>
	
	<script>

		window.chartColors2 = {
			skyblue: 'rgb(35, 131, 152)'
		};
		
		var config = {
			type: 'line',
			data: {
				labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
				datasets: [{
					label: 'On Site Reviews Report',
					backgroundColor: window.chartColors2.skyblue,
					borderColor: window.chartColors2.skyblue,
					data: [0, 0, 0, 0, 0, 0, 0, 0],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					//stext: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: false,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: false,
						scaleLabel: {
							display: false,
							labelString: 'Value'
						}
					}]
				}
			}
		};
		


		window.onload = function() {
			var ctx = document.getElementById('canvas3').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
		

	</script>
	@endsection