<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<?php
	if (!empty($oStats)) {
		
		$timeNow = date("Y-m-d");
		$yesterdayDate = date('Y-m-d', strtotime("-1 day"));
		$weekDate = date('Y-m-d', strtotime("-7 week"));
		$monthDate = date('Y-m-d', strtotime("-1 month"));
		$threeMonthDate = date('Y-m-d', strtotime("-1 month"));
		
		$yesterdayST = (int)strtotime($yesterdayDate);
		$weekST = (int)strtotime($weekDate);
		$monthST = (int)strtotime($monthDate);
		$threeMonthST = (int)strtotime($threeMonthDate);
		
		foreach ($oStats as $oStat) {
			if($statsType == 'aggregate'){
				
				if(!empty($oStat->widget_id)){
					$aWidgets['widget_id'][$oStat->widget_id]=$oStat;
				}
				
				if(!empty($oStat->brandboost_id)){
					$aWidgets['campaign'][$oStat->brandboost_id]= $oStat;
				}
				
				if(!empty($oStat->widget_type)){
					$aWidgets['widget_type'][$oStat->widget_type][]= $oStat;
				}
				
				if(!empty($oStat->track_type)){
					$aWidgets['track_type'][$oStat->track_type][]= $oStat;
				}
			}
			
			$trackDate = date("Y-m-d", strtotime($oStat->created_at));
			$trackST = (int)strtotime($trackDate);
			
			if ($timeNow == $trackDate) {
				$oStatsToday[] = $oStat;
			} 
			if($yesterdayST <= $trackST) {
				$oStatsYesterday[] = $oStat;
			} 
			if($weekST <= $trackST) {
				$oStatsWeek[] = $oStat;
			} 
			if($monthST <= $trackST) {
				$oStatsMonth[] = $oStat;
			} 
			if($threeMonthST <= $trackST) {
				$oStats3Month[] = $oStat;
			}
			
			if ($oStat->track_type == 'view') {
				$aViews[] = $oStat;
				if ($timeNow == $trackDate) {
					//Today
					$aViewsToday[] = $oStat;
				} 
				if($yesterdayST <= $trackST) {
					//Yesterday
					$aViewsYesterday[] = $oStat;
				} 
				if($weekST <= $trackST) {
					//Week
					$aViewsWeek[] = $oStat;
				} 
				if($monthST <= $trackST) {
					//Month
					$aViewsMonth[] = $oStat;
				} 
				if($threeMonthST <= $trackST) {
					//3 Month
					$aViews3Months[] = $oStat;
				}
				} else if ($oStat->track_type == 'click') {
				$aClicks[] = $oStat;
				if ($timeNow == $trackDate) {
					//Today
					$aClicksToday[] = $oStat;
				} 
				if($yesterdayST <= $trackST) {
					//Yesterday
					$aClicksYesterday[] = $oStat;
				} 
				if($weekST <= $trackST) {
					//Week
					$aClicksWeek[] = $oStat;
				} 
				if($monthST <= $trackST) {
					//Month
					$aClicksMonth[] = $oStat;
				} 
				if($threeMonthST <= $trackST) {
					//3 Month
					$aClicks3Months[] = $oStat;
				}
				} else if ($oStat->track_type == 'comment') {
				$aComments[] = $oStat;
				if ($timeNow == $trackDate) {
					//Today
					$aCommentsToday[] = $oStat;
				} 
				if($yesterdayST <= $trackST) {
					//Yesterday
					$aCommentsYesterday[] = $oStat;
				} 
				if($weekST <= $trackST) {
					//Week
					$aCommentsWeek[] = $oStat;
				} 
				if($monthST <= $trackST) {
					//Month
					$aCommentsMonth[] = $oStat;
				} 
				if($threeMonthST <= $trackST) {
					//3 Month
					$aComments3Months[] = $oStat;
				}
				} else if ($oStat->track_type == 'helpful') {
				$aHelpful[] = $oStat;
				if ($timeNow == $trackDate) {
					//Today
					$aHelpfulToday[] = $oStat;
				} 
				if($yesterdayST <= $trackST) {
					//Yesterday
					$aHelpfulYesterday[] = $oStat;
				} 
				if($weekST <= $trackST) {
					//Week
					$aHelpfulWeek[] = $oStat;
				} 
				if($monthST <= $trackST) {
					//Month
					$aHelpfulMonth[] = $oStat;
				} 
				if($threeMonthST <= $trackST) {
					//3 Month
					$aHelpful3Months[] = $oStat;
				}
			}
		}
		
		//$totalRecords = count($oStats);
		//$totalViews = count($aViews);
		//$totalClicks = count($aClicks);
		//$totalComments = count($aComments);
		//$totalHelpful = count($aHelpful);
		//$totalToday = count($aViewsToday) + count($aClicksToday) + count($aCommentsToday) + count($aHelpfulToday);
		//$totalYesterday = count($aViewsYesterday) + count($aClicksYesterday) + count($aCommentsYesterday) + count($aHelpfulYesterday);
		//$totalWeek = count($aViewsWeek) + count($aClicksWeek) + count($aCommentsWeek) + count($aHelpfulWeek);
		//$totalMonth = count($aViewsMonth) + count($aClicksMonth) + count($aCommentsMonth) + count($aHelpfulMonth);
		//$total3Month = count($aViews3Months) + count($aClicks3Months) + count($aComments3Months) + count($aHelpful3Months);
		
		$totalRecords = 1;
		$totalViews = 1;
		$totalClicks = 1;
		$totalComments = 1;
		$totalHelpful = 1;
		
		$totalToday = 1;
		$totalYesterday = 1;
		$totalWeek = 1;
		$totalMonth = 1;
		$total3Month = 1;
	}
?>
<div class="tab-pane <?php echo $StatsClass; ?>" id="right-icon-tab4">
	<!--===========TAB 1===========-->
	<div class="tab-content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-flat">
					<div class="panel-heading"> 
						<span class="pull-left">
							<h6 class="panel-title" id="totalStatCount"><?php echo ($totalRecords) ? $totalRecords : '0';?> Records</h6>
						</span>
						<div class="heading_links pull-left">
							<a class="top_links btn btn-xs btn_white_table ml20 mvtabs" href="#right-icon-tab15" data-toggle="tab" total-record="<?php echo $totalRecords; ?>">All Time</a>
							<a class="top_links mvtabs" href="#right-icon-tab10" data-toggle="tab" total-record="<?php echo $totalToday; ?>">Today</a> 
							<a class="top_links mvtabs" href="#right-icon-tab11" data-toggle="tab" total-record="<?php echo $totalYesterday; ?>">Yesterday</a> 
							<a class="top_links mvtabs" href="#right-icon-tab12" data-toggle="tab" total-record="<?php echo $totalWeek; ?>">Week</a> 
							<a class="top_links mvtabs" href="#right-icon-tab13" data-toggle="tab" total-record="<?php echo $totalMonth; ?>">Month</a>
							<a class="top_links mvtabs" href="#right-icon-tab14" data-toggle="tab" total-record="<?php echo $total3Month; ?>">3 Month</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php if($statsType == 'aggregate'): ?>
		<div class="row"> 
			<!--------------LEFT----------->
			<div class="col-md-3">
				<div class="panel panel-flat review_ratings">
					<div class="panel-heading">
						<h6 class="panel-title">Total Widgets</h6>
						<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
					<div class="panel-body p0 bkg_white">
						<div class="p20 topchart_value">
							<div class="row">
								<div class="col-xs-12">
									<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_red.png"); ?>"/>
									<h1 class="m0"><?php //echo number_format(count($aWidgets['widget_id'])); ?></h1>                                        
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!------------CENTER------------->
			<div class="col-md-3">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Total Campaigns</h6>
						<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
					<div class="panel-body p0 bkg_white"> 
						<div class="p20 topchart_value">
							<div class="row">
								<div class="col-xs-12">
									<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
									<h1 class="m0"><?php //echo number_format(count($aWidgets['campaign'])); ?></h1>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<!------------RIGHT------------->
			<div class="col-md-3">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Widget Type</h6>
						<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
					<div class="panel-body p0 bkg_white"> 
						<div class="p20 topchart_value">
							<div class="row">
								<div class="col-xs-12">
									<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
									<?php if(!empty($aWidgets['widget_type'])){
										foreach($aWidgets['widget_type'] as $key => $aWT){
										?>
										<h6 class="m0"><?php
											if ($key == 'cpw') {
												echo 'Center Popup';
												} else if ($key == 'vpw') {
												echo 'Vertical Popup';
												} else if ($key == 'bww') {
												echo 'Button Widget Popup';
												} else if ($key == 'bfw') {
												echo 'Bottom Fixed Popup';
												} else {
												echo ucfirst($key);
											}
										?>: <?php echo number_format(count($aWT)); ?></h6>
										<?php
										}
										}else{
										echo '<h1 class="m0">0</h1>';
									}
									?>
									
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<!------------RIGHT------------->
			<div class="col-md-3">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Sources</h6>
						<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
					
					<div class="panel-body p0 bkg_white"> 
						<div class="p20 topchart_value">
							<div class="row">
								<div class="col-xs-3">
									<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_green.png"); ?>"/>
								</div>
								<div class="col-xs-9">
									<?php if(!empty($aWidgets['track_type'])){
										foreach($aWidgets['track_type'] as $key => $aWT){
										?>
										<h6 class="m0"><?php echo ucfirst($key);?>: <?php echo number_format(count($aWT)); ?></h6>
										<?php
										}
										}else{
										echo '<h1 class="m0">0</h1>';
									}
									?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="tab-pane active" id="right-icon-tab15">
			
			<div class="row"> 
				<!--------------LEFT----------->
				<div class="col-md-3">
					<div class="panel panel-flat review_ratings">
						<div class="panel-heading">
							<h6 class="panel-title">Views</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white">
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_red.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aViews)); ?></h1>
										<p class="txt_red"><?php //echo number_format(((count($aViews) / count($oStats)) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							
							
							<div id="linechart_a_all" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------CENTER------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Clicks</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aClicks)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aClicks) / count($oStats)) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_b_all" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Comments</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aComments)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aComments) / count($oStats)) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_c_all" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Helpful</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_green.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aHelpful)); ?></h1>
										<p class="txt_green"><?php //echo number_format(((count($aHelpful) / count($oStats)) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_d_all" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Statistics Details</h6>
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
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Widget Name</th>
										<th>Type</th>
										<th>Campaign Name</th>
										<th>Created</th>
										<th>Action</th>
										<th>Source</th>
										<th>IP</th>
										<th>Platform</th>
										<th>Browser</th>
										<th>City</th>
										<th>Country</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if (!empty($oStats)) {
											foreach ($oStats as $oData) {
												$brandImgArray = unserialize($oData->brand_img);
												//pre($brandImgArray);
												$brand_img = $brandImgArray[0]['media_url'];
												
												if (empty($brand_img)) {
													$imgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
												}
												
												$campaignImgArray = unserialize($oData->brand_img);
												$campaign_img = $campaignImgArray[0]['media_url'];
												
												if (empty($campaign_img)) {
													$campaignImgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
												}
												
												//pre($oData); die;
											?>
											
											<!--================================================-->
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->widget_id); ?>" widgetID="<?php echo $oData->widget_id; ?>" b_title="<?php echo $oData->bbBrandTitle; ?>" class="text-default text-semibold">
														<img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->id); ?>" widgetID="<?php echo $oData->id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold"><?php echo $oData->widget_title; ?></a></div>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->widget_desc); ?>
														</div>
													</div>
												</td>
												
												<td><?php
													if ($oData->widget_type == 'cpw') {
														echo 'Center Popup';
														} else if ($oData->widget_type == 'vpw') {
														echo 'Vertical Popup';
														} else if ($oData->widget_type == 'bww') {
														echo 'Button Widget Popup';
														} else if ($oData->widget_type == 'bfw') {
														echo 'Bottom Fixed Popup';
														} else {
														echo 'No Data';
													};
												?></td>
												<td>
													<?php if (!empty($oData->brandboost_id)): ?>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_setup/' . $oData->brandboost_id); ?>" class="text-default text-semibold">
															<img src="<?php echo $campaignImgSrc; ?>" class="img-circle img-xs br5" alt="Img">
														</a>
													</div>
													<div class="media-left">
														<a href="<?php echo base_url("admin/brandboost/onsite_setup/" . $oData->brandboost_id); ?>" target="_blank">
															<?php endif; ?>
															<?php echo ($oData->bbBrandTitle) ? $oData->bbBrandTitle : 'N/A'; ?>
															<?php if (!empty($oData->brandboost_id)): ?>
														</a>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->bbBrandDesc); ?>
														</div>    
													</div>
													<?php endif; ?>
												</td>
												<td>
													<div class="media-left">
														<div class="pt-5"><span class="text-default text-semibold"><?php echo dataFormat($oData->created_at); ?></span></div>
														<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oData->created_at)); ?></div>
													</div>
												</td>
												<td><?php echo ($oData->track_type) ? $oData->track_type : 'No Data'; ?></td>
												<td><?php echo ($oData->section_type) ? $oData->section_type : 'No Data'; ?></td>
												<td><?php echo ($oData->ip_address) ? $oData->ip_address : 'No Data'; ?></td>
												<td><?php echo ($oData->platform) ? getPlatformImg($oData->platform) : 'No Data'; ?></td>
												<td><?php echo ($oData->browser) ? getBrowserImg($oData->browser) : 'No Data'; ?></td>
												<td><?php echo ($oData->city) ? $oData->city : 'No Data'; ?></td>
												<td><?php echo ($oData->country) ? $oData->country : 'No Data'; ?></td>
											</tr>
											<?php
											}
										}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
		<div class="tab-pane" id="right-icon-tab10">
			
			<div class="row"> 
				<!--------------LEFT----------->
				<div class="col-md-3">
					<div class="panel panel-flat review_ratings">
						<div class="panel-heading">
							<h6 class="panel-title">Views</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white">
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_red.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aViewsToday)); ?></h1>
										<p class="txt_red"><?php //echo number_format(((count($aViewsToday) / $totalToday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							
							
							<div id="linechart_a_today" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------CENTER------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Clicks</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aClicksToday)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aClicksToday) / $totalToday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_b_today" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Comments</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aCommentsToday)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aCommentsToday) / $totalToday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_c_today" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Helpful</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_green.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aHelpfulToday)); ?></h1>
										<p class="txt_green"><?php //echo number_format(((count($aHelpfulToday) / $totalToday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_d_today" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Statistics Details</h6>
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
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Widget Name</th>
										<th>Type</th>
										<th>Campaign Name</th>
										<th>Created</th>
										<th>Action</th>
										<th>Source</th>
										<th>IP</th>
										<th>Platform</th>
										<th>Browser</th>
										<th>City</th>
										<th>Country</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if (!empty($oStatsToday)) {
											foreach ($oStatsToday as $oData) {
												$brandImgArray = unserialize($oData->brand_img);
												//pre($brandImgArray);
												$brand_img = $brandImgArray[0]['media_url'];
												
												if (empty($brand_img)) {
													$imgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
												}
												
												//Attached camapaign brand Image
												$campaignImgArray = unserialize($oData->campaignImg);
												$campaign_img = $campaignImgArray[0]['media_url'];
												
												if (empty($campaign_img)) {
													$campaignImgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
												}
											?>
											
											<!--================================================-->
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->widget_id); ?>" widgetID="<?php echo $oData->widget_id; ?>" b_title="<?php echo $oData->bbCTitle; ?>" class="text-default text-semibold">
														<img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->id); ?>" widgetID="<?php echo $oData->id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold"><?php echo $oData->widget_title; ?></a></div>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->widget_desc); ?>
														</div>
													</div>
												</td>
												
												<td><?php
													if ($oData->widget_type == 'cpw') {
														echo 'Center Popup';
														} else if ($oData->widget_type == 'vpw') {
														echo 'Vertical Popup';
														} else if ($oData->widget_type == 'bww') {
														echo 'Button Widget Popup';
														} else if ($oData->widget_type == 'bfw') {
														echo 'Bottom Fixed Popup';
														} else {
														echo 'No Data';
													};
												?></td>
												<td>
													<?php if (!empty($oData->brandboost_id)): ?>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_setup/' . $oData->brandboost_id); ?>" class="text-default text-semibold">
															<img src="<?php echo $campaignImgSrc; ?>" class="img-circle img-xs br5" alt="Img">
														</a>
													</div>
													<div class="media-left">
														<a href="<?php echo base_url("admin/brandboost/onsite_setup/" . $oData->brandboost_id); ?>" target="_blank">
															<?php endif; ?>
															<?php echo ($oData->bbBrandTitle) ? $oData->bbBrandTitle : 'N/A'; ?>
															<?php if (!empty($oData->brandboost_id)): ?>
														</a>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->bbBrandDesc); ?>
														</div>    
													</div>
													<?php endif; ?>
												</td>
												<td>
													<div class="media-left">
														<div class="pt-5"><span class="text-default text-semibold"><?php echo dataFormat($oData->created_at); ?></span></div>
														<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oData->created_at)); ?></div>
													</div>
												</td>
												<td><?php echo ($oData->track_type) ? $oData->track_type : 'No Data'; ?></td>
												<td><?php echo ($oData->section_type) ? $oData->section_type : 'No Data'; ?></td>
												<td><?php echo ($oData->ip_address) ? $oData->ip_address : 'No Data'; ?></td>
												<td><?php echo ($oData->platform) ? getPlatformImg($oData->platform) : 'No Data'; ?></td>
												<td><?php echo ($oData->browser) ? getBrowserImg($oData->browser) : 'No Data'; ?></td>
												<td><?php echo ($oData->city) ? $oData->city : 'No Data'; ?></td>
												<td><?php echo ($oData->country) ? $oData->country : 'No Data'; ?></td>
												
											</tr>
											<?php
											}
										}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!--===========TAB 2===========-->
		<div class="tab-pane" id="right-icon-tab11">
			<div class="row"> 
				<!--------------LEFT----------->
				<div class="col-md-3">
					<div class="panel panel-flat review_ratings">
						<div class="panel-heading">
							<h6 class="panel-title">Views</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white">
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_red.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aViewsYesterday)); ?></h1>
										<p class="txt_red"><?php //echo number_format(((count($aViewsYesterday) / $totalYesterday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							
							
							<div id="linechart_a_yesterday" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------CENTER------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Clicks</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aClicksYesterday)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aClicksYesterday) / $totalYesterday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_b_yesterday" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Comments</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aCommentsYesterday)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aCommentsYesterday) / $totalYesterday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_c_yesterday" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Helpful</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_green.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aHelpfulYesterday)); ?></h1>
										<p class="txt_green"><?php //echo number_format(((count($aHelpfulYesterday) / $totalYesterday) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_d_yesterday" style="min-width: 300px; height: 250px;"></div>
						</div>
						
						
						
						
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Statistics Details</h6>
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
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Widget Name</th>
										<th>Type</th>
										<th>Campaign Name</th>
										<th>Created</th>
										<th>Action</th>
										<th>Source</th>
										<th>IP</th>
										<th>Platform</th>
										<th>Browser</th>
										<th>City</th>
										<th>Country</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if (!empty($oStatsYesterday)) {
											foreach ($oStatsYesterday as $oData) {
												$brandImgArray = unserialize($oData->brand_img);
												$brand_img = $brandImgArray[0]['media_url'];
												
												if (empty($brand_img)) {
													$imgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
												}
												
												//Attached camapaign brand Image
												$campaignImgArray = unserialize($oData->campaignImg);
												$campaign_img = $campaignImgArray[0]['media_url'];
												
												if (empty($campaign_img)) {
													$campaignImgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
												}
											?>
											
											<!--================================================-->
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->widget_id); ?>" widgetID="<?php echo $oData->widget_id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold">
														<img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->id); ?>" widgetID="<?php echo $oData->id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold"><?php echo $oData->widget_title; ?></a></div>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->widget_desc); ?>
														</div>
													</div>
												</td>
												
												<td><?php
													if ($oData->widget_type == 'cpw') {
														echo 'Center Popup';
														} else if ($oData->widget_type == 'vpw') {
														echo 'Vertical Popup';
														} else if ($oData->widget_type == 'bww') {
														echo 'Button Widget Popup';
														} else if ($oData->widget_type == 'bfw') {
														echo 'Bottom Fixed Popup';
														} else {
														echo 'No Data';
													};
												?></td>
												<td>
													<?php if (!empty($oData->brandboost_id)): ?>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_setup/' . $oData->brandboost_id); ?>" class="text-default text-semibold">
															<img src="<?php echo $campaignImgSrc; ?>" class="img-circle img-xs br5" alt="Img">
														</a>
													</div>
													<div class="media-left">
														<a href="<?php echo base_url("admin/brandboost/onsite_setup/" . $oData->brandboost_id); ?>" target="_blank">
															<?php endif; ?>
															<?php echo ($oData->bbBrandTitle) ? $oData->bbBrandTitle : 'N/A'; ?>
															<?php if (!empty($oData->brandboost_id)): ?>
														</a>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->bbBrandDesc); ?>
														</div>    
													</div>
													<?php endif; ?>
												</td>
												<td>
													<div class="media-left">
														<div class="pt-5"><span class="text-default text-semibold"><?php echo dataFormat($oData->created_at); ?></span></div>
														<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oData->created_at)); ?></div>
													</div>
												</td>
												<td><?php echo ($oData->track_type) ? $oData->track_type : 'No Data'; ?></td>
												<td><?php echo ($oData->section_type) ? $oData->section_type : 'No Data'; ?></td>
												<td><?php echo ($oData->ip_address) ? $oData->ip_address : 'No Data'; ?></td>
												<td><?php echo ($oData->platform) ? getPlatformImg($oData->platform) : 'No Data'; ?></td>
												<td><?php echo ($oData->browser) ? getBrowserImg($oData->browser) : 'No Data'; ?></td>
												<td><?php echo ($oData->city) ? $oData->city : 'No Data'; ?></td>
												<td><?php echo ($oData->country) ? $oData->country : 'No Data'; ?></td>
												
											</tr>
											<?php
											}
										}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!--===========TAB 3====Preferences=======-->
		<div class="tab-pane" id="right-icon-tab12"> 
			
			<div class="row"> 
				<!--------------LEFT----------->
				<div class="col-md-3">
					<div class="panel panel-flat review_ratings">
						<div class="panel-heading">
							<h6 class="panel-title">Views</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white">
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_red.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aViewsWeek)); ?></h1>
										<p class="txt_red"><?php //echo number_format(((count($aViewsWeek) / $totalWeek) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							
							
							<div id="linechart_a_week" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------CENTER------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Clicks</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aClicksWeek)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aClicksWeek) / $totalWeek) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_b_week" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Comments</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aCommentsWeek)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aCommentsWeek) / $totalWeek) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_c_week" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Helpful</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_green.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aHelpfulWeek)); ?></h1>
										<p class="txt_green"><?php //echo number_format(((count($aHelpfulWeek) / $totalWeek) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_d_week" style="min-width: 300px; height: 250px;"></div>
						</div>
						
						
						
						
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Statistics Details</h6>
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
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Widget Name</th>
										<th>Type</th>
										<th>Campaign Name</th>
										<th>Created</th>
										<th>Action</th>
										<th>Source</th>
										<th>IP</th>
										<th>Platform</th>
										<th>Browser</th>
										<th>City</th>
										<th>Country</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if (!empty($oStatsWeek)) {
											foreach ($oStatsWeek as $oData) {
												$brandImgArray = unserialize($oData->brand_img);
												$brand_img = $brandImgArray[0]['media_url'];
												
												if (empty($brand_img)) {
													$imgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
												}
												
												//Attached camapaign brand Image
												$campaignImgArray = unserialize($oData->brand_img);
												$campaign_img = $campaignImgArray[0]['media_url'];
												
												if (empty($campaign_img)) {
													$campaignImgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
												}
											?>
											
											<!--================================================-->
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->widget_id); ?>" widgetID="<?php echo $oData->widget_id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold">
														<img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->id); ?>" widgetID="<?php echo $oData->id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold"><?php echo $oData->widget_title; ?></a></div>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->widget_desc); ?>
														</div>
													</div>
												</td>
												
												<td><?php
													if ($oData->widget_type == 'cpw') {
														echo 'Center Popup';
														} else if ($oData->widget_type == 'vpw') {
														echo 'Vertical Popup';
														} else if ($oData->widget_type == 'bww') {
														echo 'Button Widget Popup';
														} else if ($oData->widget_type == 'bfw') {
														echo 'Bottom Fixed Popup';
														} else {
														echo 'No Data';
													};
												?></td>
												<td>
													<?php if (!empty($oData->brandboost_id)): ?>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_setup/' . $oData->brandboost_id); ?>" class="text-default text-semibold">
															<img src="<?php echo $campaignImgSrc; ?>" class="img-circle img-xs br5" alt="Img">
														</a>
													</div>
													<div class="media-left">
														<a href="<?php echo base_url("admin/brandboost/onsite_setup/" . $oData->brandboost_id); ?>" target="_blank">
															<?php endif; ?>
															<?php echo ($oData->bbBrandTitle) ? $oData->bbBrandTitle : 'N/A'; ?>
															<?php if (!empty($oData->brandboost_id)): ?>
														</a>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->bbBrandDesc); ?>
														</div>    
													</div>
													<?php endif; ?>
												</td>
												<td>
													<div class="media-left">
														<div class="pt-5"><span class="text-default text-semibold"><?php echo dataFormat($oData->created_at); ?></span></div>
														<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oData->created_at)); ?></div>
													</div>
												</td>
												<td><?php echo ($oData->track_type) ? $oData->track_type : 'No Data'; ?></td>
												<td><?php echo ($oData->section_type) ? $oData->section_type : 'No Data'; ?></td>
												<td><?php echo ($oData->ip_address) ? $oData->ip_address : 'No Data'; ?></td>
												<td><?php echo ($oData->platform) ? getPlatformImg($oData->platform) : 'No Data'; ?></td>
												<td><?php echo ($oData->browser) ? getBrowserImg($oData->browser) : 'No Data'; ?></td>
												<td><?php echo ($oData->city) ? $oData->city : 'No Data'; ?></td>
												<td><?php echo ($oData->country) ? $oData->country : 'No Data'; ?></td>
												
											</tr>
											<?php
											}
										}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!--===========TAB 4====Chat Widget=======-->
		<div class="tab-pane" id="right-icon-tab13">
			<div class="row"> 
				<!--------------LEFT----------->
				<div class="col-md-3">
					<div class="panel panel-flat review_ratings">
						<div class="panel-heading">
							<h6 class="panel-title">Views</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white">
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_red.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aViewsMonth)); ?></h1>
										<p class="txt_red"><?php //echo number_format(((count($aViewsMonth) / $totalMonth) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							
							
							<div id="linechart_a_month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------CENTER------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Clicks</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aClicksMonth)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aClicksMonth) / $totalMonth) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_b_month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Comments</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aCommentsMonth)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aCommentsMonth) / $totalMonth) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_c_month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Helpful</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_green.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aHelpfulMonth)); ?></h1>
										<p class="txt_green"><?php //echo number_format(((count($aHelpfulMonth) / $totalMonth) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_d_month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Statistics Details</h6>
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
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Widget Name</th>
										<th>Type</th>
										<th>Campaign Name</th>
										<th>Created</th>
										<th>Action</th>
										<th>Source</th>
										<th>IP</th>
										<th>Platform</th>
										<th>Browser</th>
										<th>City</th>
										<th>Country</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if (!empty($oStatsMonth)) {
											foreach ($oStatsMonth as $oData) {
												$brandImgArray = unserialize($oData->brand_img);
												$brand_img = $brandImgArray[0]['media_url'];
												
												if (empty($brand_img)) {
													$imgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
												}
												
												//Attached camapaign brand Image
												$campaignImgArray = unserialize($oData->campaignImg);
												$campaign_img = $campaignImgArray[0]['media_url'];
												
												if (empty($campaign_img)) {
													$campaignImgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
												}
											?>
											
											<!--================================================-->
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->widget_id); ?>" widgetID="<?php echo $oData->widget_id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold">
														<img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->id); ?>" widgetID="<?php echo $oData->id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold"><?php echo $oData->widget_title; ?></a></div>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->widget_desc); ?>
														</div>
													</div>
												</td>
												
												<td><?php
													if ($oData->widget_type == 'cpw') {
														echo 'Center Popup';
														} else if ($oData->widget_type == 'vpw') {
														echo 'Vertical Popup';
														} else if ($oData->widget_type == 'bww') {
														echo 'Button Widget Popup';
														} else if ($oData->widget_type == 'bfw') {
														echo 'Bottom Fixed Popup';
														} else {
														echo 'No Data';
													};
												?></td>
												<td>
													<?php if (!empty($oData->brandboost_id)): ?>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_setup/' . $oData->brandboost_id); ?>" class="text-default text-semibold">
															<img src="<?php echo $campaignImgSrc; ?>" class="img-circle img-xs br5" alt="Img">
														</a>
													</div>
													<div class="media-left">
														<a href="<?php echo base_url("admin/brandboost/onsite_setup/" . $oData->brandboost_id); ?>" target="_blank">
															<?php endif; ?>
															<?php echo ($oData->bbBrandTitle) ? $oData->bbBrandTitle : 'N/A'; ?>
															<?php if (!empty($oData->brandboost_id)): ?>
														</a>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->bbBrandDesc); ?>
														</div>    
													</div>
													<?php endif; ?>
												</td>
												<td>
													<div class="media-left">
														<div class="pt-5"><span class="text-default text-semibold"><?php echo dataFormat($oData->created_at); ?></span></div>
														<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oData->created_at)); ?></div>
													</div>
												</td>
												<td><?php echo ($oData->track_type) ? $oData->track_type : 'No Data'; ?></td>
												<td><?php echo ($oData->section_type) ? $oData->section_type : 'No Data'; ?></td>
												<td><?php echo ($oData->ip_address) ? $oData->ip_address : 'No Data'; ?></td>
												<td><?php echo ($oData->platform) ? getPlatformImg($oData->platform) : 'No Data'; ?></td>
												<!-- <td><?php echo ($oData->platform_device) ? $oData->platform_device : 'No Data'; ?></td> -->
												<td><?php echo ($oData->browser) ? getBrowserImg($oData->browser) : 'No Data'; ?></td>
												<!-- <td><?php echo ($oData->region) ? $oData->region : 'No Data'; ?></td> -->
												<td><?php echo ($oData->city) ? $oData->city : 'No Data'; ?></td>
												<td><?php echo ($oData->country) ? $oData->country : 'No Data'; ?></td>
												
											</tr>
											<?php
											}
										}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!--===========TAB 5===========-->
		<div class="tab-pane" id="right-icon-tab14"> 
			<div class="row"> 
				<!--------------LEFT----------->
				<div class="col-md-3">
					<div class="panel panel-flat review_ratings">
						<div class="panel-heading">
							<h6 class="panel-title">Views</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white">
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_red.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aViews3Months)); ?></h1>
										<p class="txt_red"><?php //echo number_format(((count($aViews3Months) / $total3Month) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							
							
							<div id="linechart_a_3month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------CENTER------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Clicks</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aClicks3Months)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aClicks3Months) / $total3Month) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_b_3month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Comments</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/timer_icon.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aComments3Months)); ?></h1>
										<p class="txt_teal"><?php //echo number_format(((count($aComments3Months) / $total3Month) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_c_3month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
				<!------------RIGHT------------->
				<div class="col-md-3">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Helpful</h6>
							<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
						</div>
						
						<div class="panel-body p0 bkg_white"> 
							<div class="p20 topchart_value">
								<div class="row">
									<div class="col-xs-12">
										<img class="pull-left mr20" src="<?php echo base_url("assets/images/smiley_green.png"); ?>"/>
										<h1 class="m0"><?php //echo number_format(count($aHelpful3Months)); ?></h1>
										<p class="txt_green"><?php //echo number_format(((count($aHelpful3Months) / $total3Month) * 100), 1) ?>%</p>
									</div>
								</div>
							</div>
							<div id="linechart_d_3month" style="min-width: 300px; height: 250px;"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Statistics Details</h6>
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
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Widget Name</th>
										<th>Type</th>
										<th>Campaign Name</th>
										<th>Created</th>
										<th>Action</th>
										<th>Source</th>
										<th>IP</th>
										<th>Platform</th>
										<th>Browser</th>
										<th>City</th>
										<th>Country</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if (!empty($oStats3Month)) {
											foreach ($oStats3Month as $oData) {
												$brandImgArray = unserialize($oData->brand_img);
												$brand_img = $brandImgArray[0]['media_url'];
												
												if (empty($brand_img)) {
													$imgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
												}
												
												//Attached camapaign brand Image
												$campaignImgArray = unserialize($oData->campaignImg);
												$campaign_img = $campaignImgArray[0]['media_url'];
												
												if (empty($campaign_img)) {
													$campaignImgSrc = base_url('assets/images/default_table_img2.png');
													} else {
													$campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
												}
											?>
											
											<!--================================================-->
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->widget_id); ?>" widgetID="<?php echo $oData->widget_id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold">
														<img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
													</div>
													<div class="media-left">
														<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_widget_setup/' . $oData->id); ?>" widgetID="<?php echo $oData->id; ?>" b_title="<?php echo $oData->widget_title; ?>" class="text-default text-semibold"><?php echo $oData->widget_title; ?></a></div>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->widget_desc); ?>
														</div>
													</div>
												</td>
												
												<td><?php
													if ($oData->widget_type == 'cpw') {
														echo 'Center Popup';
														} else if ($oData->widget_type == 'vpw') {
														echo 'Vertical Popup';
														} else if ($oData->widget_type == 'bww') {
														echo 'Button Widget Popup';
														} else if ($oData->widget_type == 'bfw') {
														echo 'Bottom Fixed Popup';
														} else {
														echo 'No Data';
													};
												?></td>
												<td>
													<?php if (!empty($oData->brandboost_id)): ?>
													<div class="media-left media-middle">
														<a href="<?php echo base_url('admin/brandboost/onsite_setup/' . $oData->brandboost_id); ?>" class="text-default text-semibold">
															<img src="<?php echo $campaignImgSrc; ?>" class="img-circle img-xs br5" alt="Img">
														</a>
													</div>
													<div class="media-left">
														<a href="<?php echo base_url("admin/brandboost/onsite_setup/" . $oData->brandboost_id); ?>" target="_blank">
															<?php endif; ?>
															<?php echo ($oData->bbBrandTitle) ? $oData->bbBrandTitle : 'N/A'; ?>
															<?php if (!empty($oData->brandboost_id)): ?>
														</a>
														<div class="text-muted text-size-small">
															<?php echo setStringLimit($oData->bbBrandDesc); ?>
														</div>    
													</div>
													<?php endif; ?>
												</td>
												<td>
													<div class="media-left">
														<div class="pt-5"><span class="text-default text-semibold"><?php echo dataFormat($oData->created_at); ?></span></div>
														<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oData->created_at)); ?></div>
													</div>
												</td>
												<td><?php echo ($oData->track_type) ? $oData->track_type : 'No Data'; ?></td>
												<td><?php echo ($oData->section_type) ? $oData->section_type : 'No Data'; ?></td>
												<td><?php echo ($oData->ip_address) ? $oData->ip_address : 'No Data'; ?></td>
												<td><?php echo ($oData->platform) ? getPlatformImg($oData->platform) : 'No Data'; ?></td>
												<td><?php echo ($oData->browser) ? getBrowserImg($oData->browser) : 'No Data'; ?></td>
												<td><?php echo ($oData->city) ? $oData->city : 'No Data'; ?></td>
												<td><?php echo ($oData->country) ? $oData->country : 'No Data'; ?></td>
												
											</tr>
											<?php
											}
										}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-right">
				<?php //if ($canWrite == TRUE): ?>
					<button <?php if ($bActiveSubsription == false) { ?> class="btn dark_btn mt20 pDisplayNoActiveSubscription" title="No Active Subscription" type="button" <?php } else { ?> type="submit" class="btn dark_btn mt20" <?php } ?> id="publishWidget"> Publish <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
					<?php //endif; ?>	
			</div>
		</div>
	</div>
</div>



<script>
	
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        var widgetScript = String($(element).text());
        //alert(widgetScript);
        $temp.val(widgetScript).select();
        document.execCommand("copy");
        $temp.remove();
        
	}
</script>

<script>
    $(".mvtabs").click(function () {
        var totalRecords = $(this).attr('total-record');
        if(totalRecords =='' || totalRecords == undefined || totalRecords ==null){
            totalRecords = '0';
		}
        $(".mvtabs").each(function () {
            $(this).removeClass("btn_white_table");
            $(this).removeClass("btn");
            $(this).removeClass("btn-xs");
		});
		
        $(this).addClass("btn");
        $(this).addClass("btn-xs");
        $(this).addClass("btn_white_table");
        $("#totalStatCount").html(totalRecords + ' Records');
		});
	//Semi Circle chart js -- Highcharts js plugins
	
    Highcharts.chart('linechart_a_today', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#fd6c81', '#fbcfd7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 5.2],
			['2', 4.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 28.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 3.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_b_today', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#2694b8', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_c_today', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#066172', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 3.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 20.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_d_today', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#5ad491', '#cbf0dd', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
    
    
    
    
    Highcharts.chart('linechart_a_yesterday', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#fd6c81', '#fbcfd7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_b_yesterday', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#2694b8', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_c_yesterday', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#066172', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_d_yesterday', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#5ad491', '#cbf0dd', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
    
    
    
    Highcharts.chart('linechart_a_week', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#fd6c81', '#fbcfd7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_b_week', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#2694b8', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_c_week', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#066172', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_d_week', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#5ad491', '#cbf0dd', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
    
    
    
    Highcharts.chart('linechart_a_month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#fd6c81', '#fbcfd7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_b_month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#2694b8', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_c_month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#066172', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_d_month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#5ad491', '#cbf0dd', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
    
    
    Highcharts.chart('linechart_a_3month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#fd6c81', '#fbcfd7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_b_3month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#2694b8', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_c_3month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#066172', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_d_3month', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#5ad491', '#cbf0dd', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
    
    
    
	Highcharts.chart('linechart_a_all', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#fd6c81', '#fbcfd7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_b_all', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#2694b8', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_c_all', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#066172', '#badbe7', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
	
    Highcharts.chart('linechart_d_all', {
        chart: {
            type: 'column'
		},
        title: {
            text: null
		},
        subtitle: {
            text: null
		},
        xAxis: {
            type: 'category',
            labels: {
				
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif'
				}
			}
		},
        yAxis: {
            min: 0,
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
			}
		},
		
        colors: ['#5ad491', '#cbf0dd', '#8bbc21', '#910000'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
		},
        series: [{
			name: 'Time',
			data: [
			['1', 4.2],
			['2', 3.8],
			['3', 2.9],
			['4', 6.7],
			['5', 9.1],
			['6', 18.7],
			['7', 15.4],
			['8', 12.2],
			['9', 10.0],
			['10', 8.7],
			['11', 4.5],
			['12', 2.2]
			],
			
		}]
	});
    
</script>


<script>
	
    Highcharts.chart('linechart_bot', {
        title: {
            text: null
		},
		
        subtitle: {
            text: null
		},
		
        yAxis: {
            title: {
                text: null
			}
		},
        legend: {
            enabled: false
		},
		
        colors: ['#acba14', '#fd6c81', '#9292b4', '#4ebc86', '#2694b8'],
		
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
				},
                pointStart: 1
			}
		},
		
        series: [{
			name: 'Installation',
			data: [100, 150, 200, 150, 300, 350, 200, 450]
            }, {
			name: 'Manufacturing',
			data: [105, 200, 250, 200, 350, 400, 300, 500]
            }, {
			name: 'Sales & Distribution',
			data: [110, 250, 300, 250, 400, 450, 400, 550]
            }, {
			name: 'Project Development',
			data: [115, 300, 350, 300, 450, 500, 500, 600]
            }, {
			name: 'Other',
			data: [120, 350, 400, 350, 500, 550, 600, 650]
		}],
		
        responsive: {
            rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}
	});
</script>