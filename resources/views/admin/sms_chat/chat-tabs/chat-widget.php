<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>

<script type="text/javascript" src="/assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
<script type="text/javascript" src="/assets/js/plugins/editors/wysihtml5/parsers.js"></script>
<script type="text/javascript" src="/assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
<script type="text/javascript" src="/assets/js/pages/editor_wysihtml5.js"></script>
<style>
	.panel .timeline-time {	background: none!important;}
	.timeline{z-index: 1;}
	.border-left-primary {	border-left-color: #2196F3!important;}
	.border-left-danger {	border-left-color: #F44336!important;}
	.border-left-success {	border-left-color: #4CAF50!important;}
	.border-right-primary {	border-right-color: #2196F3!important;}
	.border-right-danger {	border-right-color: #F44336!important;}
	.border-right-success {	border-right-color: #4CAF50!important;}
	.timeline .panel{box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055) !important}
	.timeline .list-inline > li a{	color: #1d2129  !important;}
	.task-details {	float: left; padding: 0;}
	.task-details li{list-style: none;}
	.task-details li strong{float: left; width: 120px; font-weight: 500; }
	.task-details li strong .fa {margin: 7px 8px 0 0;font-size: 6px;float: left;}
	.panel-footer{border-top: 1px solid #f5f4f5 }
	.btn.red {	background: #f30000 !important;	color: #fff !important;}
	.timeline hr{border-color: #f5f4f5!important}
	.timeline-icon img {border: 1px solid #eee;}
	.border-right-lg {	border-right: 2px solid;}
	.viewStatsData{background: #fff!important; border: 1px solid #333!important; color: #333!important;}
	.viewStatsData:hover{background: #333!important; color: #fff!important;}
	.endtimeline:before, .endtimeline:after{display: none!important;}
	
	.circle_plus{display: block; border: 2px solid #ccc;color: #ccc; font-size: 16px; text-align: center; width: 40px; height: 40px; line-height: 34px; border-radius: 100px;}
	.circle_plus:hover, .circle_plus:focus{color: #c3dcf1; border-color: #c3dcf1!important; background: #ebf4fb!important;}
	.trigger_btn{display: block; margin: 0 auto; width: 200px;}
	.bl_cust_btn{font-size: 13px!important;}
	
	
	/*=======MODAL CSS=======*/	
	.panel.actionpanel{color: #4261a2!important; border: 1px solid #f5f4f5 !important; border-radius: 5px; background: #fff!important; box-shadow: none!important;}
	.panel.actionpanel:hover{background: #f3f8fc!important; cursor: pointer!important; border: 1px solid #eee !important;}
	.panel.actionpanel h6{margin: 0 0 0px; font-weight: 500;}
	.panel.actionpanel p{margin: 0 0 0px;}
	.panel.actionpanel img {	width: 40px;	border: 1px solid #ddd;	border-radius: 50px;}
	.panel.actionpanel .panel-body {padding: 15px;}
	
	.modal-body.template_edit{background: #f3f8fc!important;}
	.temp_left_option{background: #ffffff; min-height: 500px; border: 1px solid #d1e4f4; border-radius: 3px; margin-top: 56px;}	
	.temp_left_option label {	margin-bottom: 3px;	font-weight: 400;	font-size: 12px;}
	.modal-body.template_edit .p15{padding: 20px!important}
	.modal-body.template_edit p{font-size: 14px;}
	.modal-body.template_edit h6, .modal-body.template_edit h6 strong{font-weight: 500!important; font-size: 17px;}
	.temp_left_option .textareabot{min-height: 200px;}
	
	.temp_left_option.right{background: #fafafa!important;  margin: 0 auto;}	
	.temp_left_option.right .ratings{border-top: 5px solid #fedd37; background: #fff;}
	.temp_left_option.right .ratings h6 strong{color: #1688bf}
	.temp_left_option.right .ratings .fa{font-size: 50px; margin: 5px 5px; }
	.temp_left_option.right .ratings .fa-star{color: #fedd37;}
	.temp_left_option.right .ratings .fa-star-o{color: #ababab;}
	.temp_left_option.right .purchase{background: #fff; background: #f5f5f5; border-top: 1px solid #ececec;}
	
	#template_modal .modal-dialog.modal-lg{width: 100%;  max-width:1100px;}
	
	.grey{color: #888888;}
	.temp_left_option.right .productsec{background: url(<?php echo site_url('assets/images/cover3.jpg'); ?>) center center no-repeat; min-height:auto; text-align: center; background-size: cover; padding-bottom: 20px;}
	.temp_left_option.right .productsec .headings{background: rgba(0,0,0,0.5); padding: 15px 20px; text-align: left; margin-bottom: 20px;}
	.temp_left_option.right .productsec figure {	background: #fff;	width: 130px;	height: auto;	border-radius: 5px;	margin: -45px auto 0;	padding: 20px;}
	.smaller{max-width: 400px;}
	.temp_left_option.right.smaller .productsec figure{margin: 0 auto;}
	
	.mobile_sms_bkg{background: url(<?php echo site_url('assets/images/iphone.png'); ?>) center top no-repeat; width: 357px; height: 716px; margin: 0 auto; padding: 70px 40px;}
	.smsbubble{background: #e5e5ea; color: #333; padding: 15px; width: 75%; border-radius: 10px;}
	
	.txt_inp_grp .input-circle {	border: 1px solid #cccccc;	border-radius: 5px !important;	margin: 0 0 0 0px !important;	width: 60px;	z-index: 0; float: left;}
	.waittimeselect select {	border: 1px solid #cccccc;	border-radius: 5px !important;	margin: 0px !important;	width: 120px;	z-index: 0;	height: 36px;	padding: 0 10px;}
	.edge_panel{margin: 0 -20px 20px; border-left: none; border-right: none; box-shadow: none;}
	.insert_tag_button {margin: 0 10px 10px 0; font-size: 10px; padding: 6px;}
	.dragIcon{position: absolute; top: 4px; left: 50%; font-size: 18px; color:#666; padding-left:35px; box-shadow:none !important;}
	.AnyTime-win, .daterangepicker {z-index: 99999999 !important;}
	/*=======MODAL CSS=======*/	
	
</style>

<?php 
	list($canReadCon, $canWriteCon) = fetchPermissions('Contacts');
	list($canReadAna, $canWriteAna) = fetchPermissions('Analytics');
	$bAnyEventExist = false;
	
	//In order to maintain order of the events
	if (!empty($eventsData)) {
		$oFinal[] = $eventsData[0];
		$eventID = $eventsData[0]->id;
		foreach ($eventsData as $key => $value) {
			foreach ($eventsData as $inner) {
				if ($inner->previous_event_id == $eventID) {
					$oFinal[] = $inner;
					$eventID = $inner->id;
					break;
				}
			}
		}
	}
	//pre($oFinal);
	//die;
	$eventsData = $oFinal;
		
	if (!empty($eventsData)) {
		foreach ($eventsData as $oEvent) {
			if (empty($oEvent->previous_event_id)) {
				$oMainEvent = $oEvent;
				break;
			}
		}
	}
?>


<!--########################TAB 0 ##########################-->
<div class="tab-pane <?php echo $emailWorkflow; ?>" id="right-icon-tab3">
	<?php
		$listID = $brandboostData->list_id;
		$dateData = json_decode($eventsData[0]->data);
		$currentBBUserID = $brandboostData->user_id;
		
		$userData = $this->mUser->getUserInfo($currentBBUserID);
		$profileImg = $userData->avatar == '' ? base_url('assets/images/userp.png') : base_url('profile_images/' . $userData->avatar);
	?>
	<div class="panel panel-flat edge_panel">
		<div class="panel-heading">
			<h6 class="panel-title text-semibold">Daily statistics</h6>
			<div class="heading-elements"> <span class="heading-text"><i class="icon-history position-left text-success"></i> Updated 3 hours ago</span>
				<ul class="icons-list">
					<li><a data-action="reload"></a></li>
				</ul>
			</div>
		</div>
		<div class="panel-body"> <img class="img-responsive" src="<?php echo site_url(); ?>admin_new/images/chart.png"/> 
			<!--<div class="chart-container">
				<div class="chart has-fixed-height" id="daily_stats"></div>
			</div>--> 
		</div>
	</div>
	
	
	<!-- Timeline -->
	<div class="timeline timeline-center">
		<div class="timeline-container"> 
			<div class="timeline-date text-muted">Start this Automation when one of these actions takes place</div>
			<div class="timeline-date text-muted">
				<button class="btn trigger_btn btn-success mb-20">Tag: New Customer</button>
				<button class="btn trigger_btn bl_cust_btn btn-success"><i style="font-size: 12px;" class="icon-plus3"></i>  Add New Trigger</button>
			</div>
			
			<?php
				if (!empty($oMainEvent)):
                $previousID = $oMainEvent->previous_event_id;
                $currentID = $oMainEvent->id;
                $bAnyEventExist = true;
			?>
			
			<div class="timeline-row post-full">
				<div class="timeline-icon start"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="main" class="circle_plus addNewEvent" href="javascript:void(0);"><i class="icon-plus3"></i></a> </div>
			</div>
            <?php endif; ?>
			
			<div class="connected-sortable droppable-area">
				<!-- Task email 1 -->
				<?php
					$isValidated = true;
					$previousEventID = 0;
					$eventNo = 1;
					foreach ($eventsData as $key => $eventData) {
						$eventDataArray = json_decode($eventData->data);
						$previousID = $currentID = '';
						$campaignArray = getCampaignsByEventID($eventData->id);
						$campaignData = $campaignArray[0];
						$isSMSAdded = $isEmailAdded = false;
						$previousID = $eventData->previous_event_id;
						$currentID = $eventData->id;
						if($campaignData->id != ''){
							
							$aStatsSms = $this->mBrandboost->getTwilioStats('campaign', $campaignData->id);
							$aCategorizedStatsSms = $this->mBrandboost->getTwilioCategorizedStatsData($aStatsSms);
							
							$sentSms = $aCategorizedStatsSms['sent']['UniqueCount'];
							$deliveredSms = $aCategorizedStatsSms['delivered']['UniqueCount'];
							$acceptedSms = $aCategorizedStatsSms['accepted']['UniqueCount'];
							$failedSms = $aCategorizedStatsSms['failed']['UniqueCount'];
							$queuedSms = $aCategorizedStatsSms['queued']['UniqueCount'];
							
							$sentSms 		= $sentSms == '' ? '0' : $sentSms;
							$deliveredSms 	= $deliveredSms == '' ? '0' : $deliveredSms;
							$acceptedSms 	= $acceptedSms == '' ? '0' : $acceptedSms;
							$failedSms 		= $failedSms == '' ? '0' : $failedSms;
							$queuedSms 		= $queuedSms == '' ? '0' : $queuedSms;
							
							if ($campaignData->campaign_type == 'Email') {
								$isSMSAdded = true;
								$aStats = $this->mBrandboost->getSendgridStats('campaign', $campaignData->id);
								$aCategorizedStats = $this->mBrandboost->getSendgridCategorizedStatsData($aStats);
								
								$processed 	= $aCategorizedStats['processed']['UniqueCount'];
								$delivered 	= $aCategorizedStats['delivered']['UniqueCount'];
								$open 		= $aCategorizedStats['open']['UniqueCount'];
								$click 		= $aCategorizedStats['click']['UniqueCount'];
								$unsubscribe = $aCategorizedStats['unsubscribe']['UniqueCount'];
								$bounce 	= $aCategorizedStats['bounce']['UniqueCount'];
								$dropped 	= $aCategorizedStats['dropped']['UniqueCount'];
								$spamReport = $aCategorizedStats['spam_report']['UniqueCount'];
								
								$processed 	= $processed == '' ? '0' : $processed;
								$delivered 	= $delivered == '' ? '0' : $delivered;
								$open 		= $open == '' ? '0' : $open;
								$click 		= $click == '' ? '0' : $click;
								$unsubscribe = $unsubscribe == '' ? '0' : $unsubscribe;
								$bounce 	= $bounce == '' ? '0' : $bounce;
								$dropped 	= $dropped == '' ? '0' : $dropped;
								$spamReport = $spamReport == '' ? '0' : $spamReport;
								
							?>
							<div class="draggable-item" event_id="<?php echo $eventData->id; ?>" item_order="<?php echo $eventNo; ?>">
								<!--<div class="timeline-row post-full">
									<div class="timeline-icon"> <a pre_event_id="<?php echo $previousEventID; ?>" current_event_id="<?php echo $eventData->id; ?>" class="circle_plus addNewEvent" href="javascript:void(0);"><i class="icon-plus3"></i></a> </div>
								</div>
								
								<div class="timeline-row post-full">
									<div class="timeline-icon"><a href="javascript:void(0);" class="dragProfileIcon"><img src="<?php echo $profileImg; ?>" alt=""></a> <div class="dragIcon"><i class="fa fa-arrows" style="display:none;"></i></div></div>
								</div> -->
								<div class="timeline-date text-muted">
									<button class="btn bl_cust_btn btn-success waitTime" id="waitTime_<?php echo $eventData->id; ?>" event_id="<?php echo $eventData->id; ?>" delay_value="<?php echo $eventDataArray->delay_value == '' ? '10' : $eventDataArray->delay_value; ?>" delay_unit="<?php echo $eventDataArray->delay_unit == '' ? 'minute' : $eventDataArray->delay_unit; ?>" delay_time="<?php echo!(empty($eventDataArray->delay_time)) ? $eventDataArray->delay_time : '9 PM'; ?>"><i class="fa fa-clock-o"></i> &nbsp; <span class="text-semibold">Wait for <?php echo $eventDataArray->delay_value == '' ? '10' : $eventDataArray->delay_value; ?> <?php echo $eventDataArray->delay_unit == '' ? 'minute' : $eventDataArray->delay_unit; ?>(s)</span></button>
								</div>
								<div class="timeline-row post-even">
									<div class="timeline-icon"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" alt=""> </div>
									<div class="timeline-time"> <a href="#" target="_blank"><?php echo $userData->firstname. ' ' .$userData->lastname; ?></a> added a new email campaign <span class="text-muted"><?php echo timeAgo($campaignData->created); ?></span> </div>
									<div class="timeline-content">
										<div class="panel border-left-lg gery_bkg border-left-primary">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-7">
														<h6 class="no-margin-top"><a href="#"><span class="itemOrder itemOrder_<?php echo $eventNo; ?>"><?php echo $eventNo; ?></span>. <?php echo ($eventNo == 1) ? 'Review Request Email' : 'Review Request Reminder'; ?> : <?php echo $campaignData->subject; ?></a></h6>
														<p class="mb-15"><?php echo count($subscribersData); ?> Contacts Added </p>
														<?php 
															foreach($subscribersData as $key=>$subData){ 
																$userData2 = $this->mUser->getUserInfo($subData->user_id);
																$profileImg2 = $userData2->avatar == '' ? base_url('assets/images/userp.png') : base_url('profile_images/' . $userData2->avatar);
																if($key > (count($subscribersData) - 6)){
																?>
																<a href="#"><img src="<?php echo $profileImg2; ?>" class="img-circle img-xs" alt=""></a> 
															<?php } } ?>
															<?php if($canWriteCon): ?>
															<a data-toggle="modal" data-target="#contact_modal" href="#" class="text-default">&nbsp;<i class="icon-plus22"></i></a> 
															<?php endif; ?>
													</div>
													<div class="col-md-5 text-right">
														<a class="btn bl_cust_btn editEmailTemplate" campaign_id="<?php echo $campaignData->id; ?>" id="editEmailTemplate_<?php echo $campaignData->id; ?>" style="cursor: pointer;" ><i class="fa fa-edit"></i> </a>
														<a data-toggle="modal" data-target="#preview_modal" class="btn green_cust_btn" ><i class="fa fa-eye"></i> </a>
														<?php if($canWriteAna): ?>
														<button class="btn viewStatsData" campaign_id="<?php echo $campaignData->id; ?>"><i class="fa fa-pie-chart"></i></button>
														<?php endif; ?>
														<button class="btn red" onclick="javascript:delete_campaign('<?php echo $eventData->id; ?>');"><i class="fa fa-trash"></i></button>
													</div>
												</div>
											</div>
										</div>
										<div class="panel green_bkg border-left-lg border-left-danger" id="statsDetaild_<?php echo $campaignData->id; ?>">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<h6 class="no-margin-top"><a href="task_manager_detailed.html">Type: Email</a></h6>
														<p class="mb-15">A collection of textile samples lay spread out on the table..</p>
														<hr>
													</div>
													<div class="col-md-4">
														<ul class="list task-details">
															<li><strong><i class="fa fa-circle"></i> Sent:</strong> <a href="#"><?php echo $processed; ?></a></li>
															<li><strong><i class="fa fa-circle"></i> Delivered:</strong> <a href="#"><?php echo $delivered; ?></a></li>
															<li><strong><i class="fa fa-circle"></i> Open:</strong> <a href="#"><?php echo $open; ?></a></li>
														</ul>
													</div>
													<div class="col-md-4">
														<ul class="list task-details">
															<li><strong><i class="fa fa-circle"></i> Click:</strong> <a href="#"><?php echo $click; ?></a></li>
															<li><strong><i class="fa fa-circle"></i> Bounce:</strong> <a href="#"><?php echo $bounce; ?></a></li>
															<li><strong><i class="fa fa-circle"></i> Dropped:</strong> <a href="#"><?php echo $dropped; ?></a></li>
														</ul>
													</div>
													<div class="col-md-4">
														<ul class="list task-details">
															<li><strong><i class="fa fa-circle"></i> Unsubscribe:</strong> <a href="#"><?php echo $unsubscribe; ?></a></li>
															<li><strong><i class="fa fa-circle"></i> Spam Report:</strong> <a href="#"><?php echo $spamReport; ?></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="panel-footer panel-footer-condensed">
												<div class="heading-elements"> 
													<span class="heading-text">Created: <span class="text-semibold"><?php echo date("M d, Y h:i A", strtotime($eventData->created)); ?> (<?php echo timeAgo($campaignData->created); ?>)</span></span>
													<ul class="list-inline list-inline-condensed heading-text pull-right">
														<li class="dropdown"> <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown">On hold <span class="caret"></span></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#">Open</a></li>
																<li class="active"><a href="#">On hold</a></li>
																<li><a href="#">Resolved</a></li>
																<li><a href="#">Closed</a></li>
																<li class="divider"></li>
																<li><a href="#">Dublicate</a></li>
																<li><a href="#">Invalid</a></li>
																<li><a href="#">Wontfix</a></li>
															</ul>
														</li>
														<li class="dropdown"> <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-alarm-add"></i> Check in</a></li>
																<li><a href="#"><i class="icon-attachment"></i> Attach screenshot</a></li>
																<li><a href="#"><i class="icon-rotate-ccw2"></i> Reassign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-pencil7"></i> Edit task</a></li>
																<li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
															</ul>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="timeline-row post-full">
                                    <div class="timeline-icon"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="followup" class="circle_plus addNewEvent" href="javascript:void(0);"><i class="icon-plus3 "></i></a> </div>
								</div>
								<!-- /task -->
							</div>
							<?php } if ($campaignData->campaign_type == 'SMS'){ ?>
							<!-- Task  SMS 1-->
							<div class="draggable-item" event_id="<?php echo $eventData->id; ?>" item_order="<?php echo $eventNo; ?>">
								<!-- <div class="timeline-row post-full">
									<div class="timeline-icon"> <a data-toggle="modal" data-target="#addnewaction" pre_event_id="<?php echo $previousEventID; ?>" current_event_id="<?php echo $eventData->id; ?>" class="circle_plus" href="#"><i class="icon-plus3"></i></a> </div>
								</div>
								<div class="timeline-row post-full">
									<div class="timeline-icon"><a href="javascript:void(0);" class="dragProfileIcon"><img src="<?php echo $profileImg; ?>" alt=""></a> <div class="dragIcon"><i class="fa fa-arrows" style="display:none;"></i></div></div>
								</div> -->
								<div class="timeline-date text-muted">
									<button class="btn bl_cust_btn btn-success waitTime" id="waitTime_<?php echo $eventData->id; ?>" event_id="<?php echo $eventData->id; ?>" delay_value="<?php echo $eventDataArray->delay_value == '' ? '10' : $eventDataArray->delay_value; ?>" delay_unit="<?php echo $eventDataArray->delay_unit == '' ? 'minute' : $eventDataArray->delay_unit; ?>" delay_time="<?php echo!(empty($eventDataArray->delay_time)) ? $eventDataArray->delay_time : '9 PM'; ?>"><i class="fa fa-clock-o"></i> &nbsp; <span class="text-semibold">Wait for <?php echo $eventDataArray->delay_value == '' ? '10' : $eventDataArray->delay_value; ?> <?php echo $eventDataArray->delay_unit == '' ? 'minute' : $eventDataArray->delay_unit; ?>(s)</span></button>
								</div>
								<div class="timeline-row post-odd">
									<div class="timeline-icon"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" alt=""> </div>
									<div class="timeline-time"> <a href="#"><?php echo $userData->firstname. ' ' .$userData->lastname; ?></a> added a new sms campaign <span class="text-muted"><?php echo timeAgo($campaignData->created); ?></span> </div>
									<div class="timeline-content">
										<div class="panel gery_bkg border-right-lg border-right-primary">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-7">
														<h6 class="no-margin-top"><a href="#"><span class="itemOrder itemOrder_<?php echo $eventNo; ?>"><?php echo $eventNo; ?></span>. <?php echo ($eventNo == 1) ? 'Review Request SMS' : 'Review Request Reminder'; ?> : Onsite invitation Sent</a></h6>
														<p class="mb-15"><?php echo count($subscribersData); ?> Contacts Added </p>
														<?php 
															
															foreach($subscribersData as $key=>$subData){ 
																$userData2 = $this->mUser->getUserInfo($subData->user_id);
																$profileImg2 = $userData2->avatar == '' ? base_url('assets/images/userp.png') : base_url('profile_images/' . $userData2->avatar);
																if($key > (count($subscribersData) - 6)){
																?>
																<a href="#"><img src="<?php echo $profileImg2; ?>" class="img-circle img-xs" alt=""></a> &nbsp; 
															<?php } } ?>
															<?php if($canWriteCon): ?>
															<a data-toggle="modal" data-target="#contact_modal" href="#" class="text-default">&nbsp;<i class="icon-plus22"></i></a> 
															<?php endif; ?>
													</div>
													
													<div class="col-md-5 text-right">
														<a data-toggle="modal" data-target="#sms_modal" class="btn bl_cust_btn editSmsTemplate" campaign_id="<?php echo $campaignData->id; ?>" id="editSmsTemplate_<?php echo $campaignData->id; ?>" style="cursor: pointer;" ><i class="fa fa-edit"></i> </a> 
														<a class="btn green_cust_btn smsPreviewModal" sms_preview_data="<?php echo 'Created: '. date("M d, Y h:i A", strtotime($campaignData->created)).' ('. timeAgo($campaignData->created).')<br>'.base64_decode($campaignData->html); ?>" ><i class="fa fa-eye"></i> </a>
														<?php if($canWriteAna): ?>
														<button class="btn viewStatsData" campaign_id="<?php echo $campaignData->id; ?>"><i class="fa fa-pie-chart"></i></button>
														<?php endif; ?>
														<button class="btn red" onclick="javascript:delete_campaign('<?php echo $eventData->id; ?>');"><i class="fa fa-trash"></i></button>
													</div>
												</div>
											</div>
										</div>
										<div class="panel green_bkg border-right-lg border-right-danger" id="statsDetaild_<?php echo $campaignData->id; ?>">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<h6 class="no-margin-top"><a href="task_manager_detailed.html">Type: SMS</a></h6>
														<p class="mb-15">A collection of textile samples lay spread out on the table..</p>
														<hr>
													</div>
													<div class="col-md-4">
														<ul class="list task-details">
															<li><strong><i class="fa fa-circle"></i> Sent:</strong> <a href="#"><?php echo $sentSms; ?></a></li>
															<li><strong><i class="fa fa-circle"></i> Delivered:</strong> <a href="#"><?php echo $deliveredSms; ?></a></li>
														</ul>
													</div>
													<div class="col-md-4">
														<ul class="list task-details">
															<li><strong><i class="fa fa-circle"></i> Failed:</strong> <a href="#"><?php echo $failedSms; ?></a></li>
															<li><strong><i class="fa fa-circle"></i> Queued:</strong> <a href="#"><?php echo $queuedSms; ?></a></li>
														</ul>
													</div>
													<div class="col-md-4">
														<ul class="list task-details">
															<li><strong><i class="fa fa-circle"></i> Accepted:</strong> <a href="#"><?php echo $acceptedSms; ?></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="panel-footer panel-footer-condensed">
												<div class="heading-elements"> 
													<span class="heading-text">Created: <span class="text-semibold"><?php echo date("M d, Y h:i A", strtotime($eventData->created)); ?> (<?php echo timeAgo($campaignData->created); ?>)</span></span>
													<ul class="list-inline list-inline-condensed heading-text pull-right">
														<li class="dropdown"> <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown">On hold <span class="caret"></span></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#">Open</a></li>
																<li class="active"><a href="#">On hold</a></li>
																<li><a href="#">Resolved</a></li>
																<li><a href="#">Closed</a></li>
																<li class="divider"></li>
																<li><a href="#">Dublicate</a></li>
																<li><a href="#">Invalid</a></li>
																<li><a href="#">Wontfix</a></li>
															</ul>
														</li>
														<li class="dropdown"> <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-alarm-add"></i> Check in</a></li>
																<li><a href="#"><i class="icon-attachment"></i> Attach screenshot</a></li>
																<li><a href="#"><i class="icon-rotate-ccw2"></i> Reassign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-pencil7"></i> Edit task</a></li>
																<li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
															</ul>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="timeline-row post-full">
                                    <div class="timeline-icon"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="followup" class="circle_plus addNewEvent" href="javascript:void(0);"><i class="icon-plus3 "></i></a> </div>
								</div>
								<!-- /task -->
							</div>
							<?php 
							} 
							
							$previousEventID = $eventData->id;
							$eventNo++;
						}
					}  
				?>
			</div>
			 <?php if ($bAnyEventExist == false): ?>            
			<div class="timeline-row post-full end">
				<div class="timeline-icon"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="main" class="circle_plus addNewEvent" href="javascript:void(0);"><i class="icon-plus3"></i></a> </div>
			</div>
            <?php endif; ?>   
			
			<div class="timeline-date text-muted">
				<button class="btn btn-success"><i class="fa fa-shield"></i> &nbsp; GOAL: Billing Successful</button>
			</div>
			
		</div>
	</div>
	<div class="timeline-date endtimeline text-muted">
		<button class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp; End this automation </button>
	</div>
	
	<div class="col-md-12 text-right">
		<a href="javascript:void(0);" targetName="Clients" class="btn bl_cust_btn continueStepOnsite">
			Continue
			<i class=" icon-arrow-right13 text-size-base position-right"></i>
		</a>
	</div>
	
	<!-- /timeline --> 
</div>


<!-- addnewaction modal -->
<div id="addnewaction" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add New Action</h5>
			</div>
			<div class="modal-body">
				<input type="hidden" name="action_previous_id" id="action_previous_id" />
                <input type="hidden" name="action_current_id" id="action_current_id" />
                <input type="hidden" name="action_event_type" id="action_event_type" />
                <input type="hidden" name="action_brandboost_id" id="action_brandboost_id" value="<?php echo $brandboostID; ?>" />
                <input type="hidden" name="brandboost_id" value="<?php echo $brandboostID; ?>" />
				<div class="tabbable">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="active"><a href="#EmailRequest" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> Email Request </a></li>
						<li><a href="#SMSRequest" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> SMS Request </a></li>
						<!-- <li><a href="#SendingOptions" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> Sending Options </a></li> -->
						<li><a href="#ConditionsWorkflow" data-toggle="tab"><i class="icon-database-edit2 position-left"></i> Conditions & Workflow </a></li>
						<li><a href="#Contacts" data-toggle="tab"><i class="icon-envelop2 position-left"></i> Contacts </a></li>
					</ul>
					<div class="tab-content">
						<!--########################TAB 0 ##########################-->
						<div class="tab-pane active" id="EmailRequest">
							<div class="row">
								<?php foreach($emailTemplate as $emailTemp){ ?>
									<div class="col-md-6">
										<div template_id="<?php echo $emailTemp->id; ?>" class="panel bg-primary actionpanel openEmailTemplate">
											<div class="panel-body">
												<div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
												<div class="media-left">
													<h6><?php echo $emailTemp->template_name; ?></h6>
													<p><?php echo $emailTemp->template_subject; ?></p>
												</div>
											</div>
										</div>
										<input type="hidden" value="" class="previousEventId" id="previousEventId_<?php echo $emailTemp->id; ?>">
									</div>
								<?php } ?>								
							</div>
						</div>
						<!--########################TAB 0 ##########################-->
						<div class="tab-pane" id="SMSRequest">
							<div class="row">
								<?php foreach($smsTemplate as $smsTemp){ ?>
									<div class="col-md-6">
										<div template_id="<?php echo $smsTemp->id; ?>" class="panel bg-primary actionpanel openSmsTemplate">
											<div class="panel-body">
												<div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
												<div class="media-left">
													<h6><?php echo $smsTemp->template_name; ?></h6>
													<p><?php echo $smsTemp->template_subject; ?></p>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div> 
						<!--########################TAB 0 ##########################-->
						<div class="tab-pane" id="SendingOptions">
							<div class="row">
								<div class="col-md-6">
									<div data-toggle="modal" data-target="#template_modal" class="panel bg-primary actionpanel">
										<div class="panel-body">
											<div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
											<div class="media-left">
												<h6>Add Email Reminder</h6>
												<p>A collection of textile samples lay spread out..</p>
											</div>
										</div>
									</div>
									<div data-toggle="modal" data-target="#template_modal" class="panel bg-danger actionpanel">
										<div class="panel-body">
											<div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
											<div class="media-left">
												<h6>Add Email Reminder</h6>
												<p>A collection of textile samples lay spread out..</p>
											</div>
										</div>
									</div>
									<div data-toggle="modal" data-target="#template_modal" class="panel bg-success actionpanel">
										<div class="panel-body">
											<div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
											<div class="media-left">
												<h6>Add Email Reminder</h6>
												<p>A collection of textile samples lay spread out..</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div data-toggle="modal" data-target="#sms_modal" class="panel bg-warning actionpanel">
										<div class="panel-body">
											<div class="media-left"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" style="width: 40px;"> </div>
											<div class="media-left">
												<h6>Add SMS Reminder</h6>
												<p>A collection of textile samples lay spread out..</p>
											</div>
										</div>
										</div>
									<div data-toggle="modal" data-target="#sms_modal" class="panel bg-info actionpanel">
										<div class="panel-body">
											<div class="media-left"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" style="width: 40px;"> </div>
											<div class="media-left">
												<h6>Add SMS Reminder</h6>
												<p>A collection of textile samples lay spread out..</p>
											</div>
										</div>
									</div>
									<div data-toggle="modal" data-target="#sms_modal" class="panel bg-purple-300 actionpanel">
										<div class="panel-body">
											<div class="media-left"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" style="width: 40px;"> </div>
											<div class="media-left">
												<h6>Add SMS Reminder</h6>
												<p>A collection of textile samples lay spread out..</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--########################TAB 1 ##########################-->
						<div class="tab-pane" id="ConditionsWorkflow">
							<div class="row">
								<div class="col-md-12 txt_inp_grp">
									<form  method="post" name="eventFrmUpdate" class="eventFrmUpdate">
										<div style="float:left; width: 100%;">
											<h6 style="margin:8px 10px 0 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
											<input id="delay_value" name="delay_value" value="10" class="delay_value form-control required mbot25 input-circle ui-wizard-content" type="text">
											<div style="display: inline-block; width: 120px; margin: 0 12px; float: left;" class="form-group waittimeselect">
												<select id="delay_unit" name="delay_unit" class="selectbox">
													<option value="minute" selected="">Minute(s)</option>
													<option value="hour">Hour(s)</option>
													<option value="day">Day(s)</option>
													<option value="week">Week(s)</option>
													<option value="month">Month(s)</option>
													<option value="year">Year(s)</option>
												</select>
											</div>
											<h6 style="margin:8px 0px 0 0!important; font-size: 13px; float: left;  ">
											after the event is triggered                                            </h6>
											<div class="eventDiv" style="float:left;display:none; ">
												<select id="event_type" name="event_type" class="form-control camp" style="width:120px;">
													<option value="sent" selected="">sent</option>
													<option value="opened">opened</option>
													<option value="not opened">not opened</option>
													<option value="clicked">clicked</option>
													<option value="not clicked">not clicked</option>
												</select>
											</div>
											
										</div>
										<div class="col-md-12 text-right mt-20">
											<input type="hidden" name="brandboost_id" value="<?php echo $brandboostID; ?>" />
											<input name="event_id" id="event_id" value="<?php echo $oMainEvent->id; ?>" type="hidden">
											<button type="submit" class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Save</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!--########################TAB 2 ##########################-->
						<div class="tab-pane" id="Contacts">
							<table class="table dtablenew media-library">
								<thead>
									<tr>
										<th style="width: 20px;"><input class=""  type="checkbox"></th>
										<th class="text-center">#No</th>
										<th>From</th>
										<th>Date Created</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($subscribersData as $key=>$subData){ $srNo = $key + 1; ?>
										<tr>
											<td><input class=""  type="checkbox"></td>
											<td class="text-center"><?php echo $srNo; ?></td>
											<td><div class="media-left"> <a href="javascript:void()" class="text-default text-semibold"><?php echo $subData->firstname; ?> <?php echo $subData->lastname; ?></a>
												<div class="text-muted text-size-small"><?php echo $subData->email; ?></div>
												<div class="text-muted text-size-small"><?php echo $subData->phone; ?></div>
											</div></td>
											<td><div class="text-semibold"><?php echo date("M d, Y", strtotime($subData->created)); ?></div>
											<div class="text-muted text-size-small"><?php echo date("h:i A", strtotime($subData->created)); ?> (<?php echo timeAgo($subData->created); ?>)</div></td>
											
										</tr>
									<?php } ?>
									
								</tbody>
							</table>
						</div>
						
						<!--########################TAB end ##########################--> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<!-- Email template_modal modal -->
<div id="template_modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add / Edit Email Template</h5>
			</div>
			<div class="modal-body template_edit">
				<form method="post" class="form-horizontal" action="javascript:void();">
					<div class="row">
						<div class="col-md-5">
							<div class="temp_left_option p15">
								<div class="form-group">
									<label>Email Template: </label>
									<select class="form-control emailTemp" id="emailTempId" name="emailTempId">
										<option value="">Select Email Template</option>
										<?php 
											if(!empty($emailTemplate)) {
												foreach($emailTemplate as $emailTemp){
													?><option value="<?php echo $emailTemp->id; ?>"><?php echo $emailTemp->template_name; ?></option><?php
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Preview Language: </label>
									<select class="form-control"><option>English (USA)</option></select>
								</div>
								
								<h6>Customise Content</h6>
								<div class="form-group">
									<label>Subject: </label>
									<input class="form-control" id="campaignTempSubject" name="campaignTempSubject"  placeholder="Email Subject" type="text">
								</div>
								<div class="form-group">
									<label>Greetings: </label>
									<input class="form-control" id="campaignTempGreeting" name="campaignTempGreeting"  placeholder="Hi {{ Name }}, We'd love your feedback!!!" type="text">
								</div>
								<div class="form-group">
									<label>Introduction: </label>
									<textarea class="form-control" id="campaignTempIntroduction" name="campaignTempIntroduction" placeholder="A collection of textile samples lay spread out on the table.."></textarea>
								</div>
								<div class="form-group">
									<label>Heading: </label>
									<input class="form-control" id="campaignTempHeading" name="campaignTempHeading"  placeholder="Select Email Template" type="text">
								</div>
								<!-- <div class="form-group">
									<label>Transaction Label: </label>
									<input class="form-control"  placeholder="Select Email Template" type="text">
								</div> -->
								<div class="form-group">
									<label>Description: </label>
									<textarea class="form-control wysihtml5 wysihtml5-default" id="campaignTempBody" name="campaignTempBody"  placeholder="A collection of textile samples lay spread out on the table.."></textarea>
								</div>
								<div class="form-group">
									<div class="note-btn-group btn-group note-view">
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button">{FIRST_NAME}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button">{LAST_NAME}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button">{EMAIL}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{WEBSITE}" class="btn btn-default add_btn draggable insert_tag_button">{WEBSITE}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{PASSWORD}" class="btn btn-default add_btn draggable insert_tag_button">{PASSWORD}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{FIVE_STARS_RATINGS}" class="btn btn-default add_btn draggable insert_tag_button">{FIVE_STARS_RATINGS}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{FOUR_STARS_RATINGS}" class="btn btn-default add_btn draggable insert_tag_button">{FOUR_STARS_RATINGS}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{TOP_STAR_RATINGS}" class="btn btn-default add_btn draggable insert_tag_button">{TOP_STAR_RATINGS}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{WRITE_REVIEW_FORM}" class="btn btn-default add_btn draggable insert_tag_button">{WRITE_REVIEW_FORM}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{TEXT_REVIEW_URL}" class="btn btn-default add_btn draggable insert_tag_button">{TEXT_REVIEW_URL}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{VIDEO_REVIEW_URL}" class="btn btn-default add_btn draggable insert_tag_button">{VIDEO_REVIEW_URL}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{UNSUBSCRIBE_LINK}" class="btn btn-default add_btn draggable insert_tag_button">{UNSUBSCRIBE_LINK}</button>
										<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{REVIEW_URL}" class="btn btn-default add_btn draggable insert_tag_button">{REVIEW_URL}</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-7">
							<div class="switchbtn mb-20 text-center">
								<button class="btn btn-success deSktop"><i class="fa fa-desktop"></i> &nbsp; Desktop</button>&nbsp; &nbsp;
								<button class="btn bl_cust_btn btn-success moBile"><i class="fa fa-mobile-phone"></i> &nbsp; Mobile</button>
							</div>
							
							<div class="temp_left_option right" id="emailTemplateSection">
								
							</div>
						</div>
						
						
						<div class="col-md-12 text-right mt-20">
							<input type="hidden" name="campaignIdVal" id="campaignIdVal" value="">
							<button class="btn pull-right bl_cust_btn btn-success" type="submit" id="updateEmailCampaign"><i class="fa fa-plus"></i> &nbsp; Save</button>
						</div>
						
						<?php /* ?>
							
							<div class="col-md-12 text-center">
							<hr>
							2nd Template
							<hr>
							
							</div>
							
							
							<div class="col-md-5">
							&nbsp;
							</div>
							
							
							<div class="col-md-7">
							<div class="switchbtn mb-20 text-center">
							<button class="btn btn-success deSktop"><i class="fa fa-desktop"></i> &nbsp; Desktop</button>&nbsp; &nbsp;
							<button class="btn bl_cust_btn btn-success moBile"><i class="fa fa-mobile-phone"></i> &nbsp; Mobile</button>
							</div>
							
							<div class="temp_left_option right">
							
							
							<div style="background: #ddd;" class="productsec">
							<div class="headings">
							<img style="width: 150px;" src="assets/images/logo_dark3.png"/>
							</div>
							<figure>
							<img class="img-responsive" src="images/watch.jpg"/>
							</figure>
							
							</div>
							
							<div class="p15 text-left">
							<div class="mb-15">
							<h6><strong>Hi Alen, We'd Love your feedback!!!</strong></h6>
							<p>Thanks for buying from Example Retail Merchant. Please review your purchase. It only takes a minute and really helps!</p>
							<p>Whatever you have to say , positive or negative, will help Example Retail Merchant to deliver the best possible service and show other customers how they perform. Allyour responses will be made available publicly on the Brandboost website. You can choose to make this review anonymous so that only Example Retail Merchant will know who are you.</p>
							<p>Whatever you have to say , positive or negative, will help Example Retail Merchant to deliver the best possible service and show other customers how they perform. <br>
							<br>Allyour responses will be made available publicly on the Brandboost website.
							You can choose to make this review anonymous so that only Example Retail Merchant will know who are you.</p>
							<p><strong>The Brandboost Team</strong></p>
							</div>
							
							
							</div>
							
							
							<div class="text-center">
							<div class="pb-20">
							<h6 class="mb-20"><strong>What did you think of Example Retail Merchant ?</strong></h6>	
							<!--<p class="mb-20"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></p>-->
							<button class="btn trigger_btn bl_cust_btn btn-success">Leave your feedback! </button>
							</div>
							</div>
							
							
							
							<div class="ratings p-20">
							<div class="row">
							<div class="col-md-6"><img style="width: 150px;" src="assets/images/logo_dark2_new.png"/></div>
							<div class="col-md-6 text-right">
							<p class="mb0"><strong>Brandboost.io</strong></p>
							</div>
							</div>
							</div>
							
							
							<div class="clearfix"></div>
							</div>
							</div>
							
							<div class="col-md-12 text-right mt-20">
							<button class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-plus"></i> &nbsp; Save</button>
							</div>
							
							
							
							<div class="col-md-12 text-center">
							<hr>
							3rd Template
							<hr>
							</div>
							
							<div class="col-md-5">
							&nbsp;
							</div>
							
							<div class="col-md-7">
							<div class="switchbtn mb-20 text-center">
							<button class="btn btn-success deSktop"><i class="fa fa-desktop"></i> &nbsp; Desktop</button>&nbsp; &nbsp;
							<button class="btn bl_cust_btn btn-success moBile"><i class="fa fa-mobile-phone"></i> &nbsp; Mobile</button>
							</div>
							
							<div class="temp_left_option right">
							<!--<figure><img class="img-responsive" src="images/popupbkg.jpg"/></figure>-->
							
							<div class="productsec">
							<div class="headings">
							<img style="width: 150px;" src="assets/images/logo_dark3.png"/>
							</div>
							<figure>
							<img class="img-responsive" src="images/watch.jpg"/>
							</figure>
							
							</div>
							
							<div class="p15 text-center">
							<div class="mb-15">
							<h6><strong>Hi Alen, We'd Love your feedback!!!</strong></h6>
							<p>Thanks for buying from Example Retail Merchant. Please review your purchase. It only takes a minute and really helps!</p>
							</div>
							
							<div class="ratings pt-10 pb-20">
							<h6 class="mb-20"><strong>Get started by rating your experiance </strong></h6>	
							<p class="mb-20"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></p>
							<button class="btn trigger_btn bl_cust_btn btn-success">Leave your feedback! </button>
							</div>
							
							<div class="purchase pt-10 pb-20">
							<h6><strong>Your purchase on </strong></h6>	
							<p>{{CustomSaleDateFormat}}</p>
							</div>
							
							<div class="pt-20">
							<p class="mb-10">Whatever you have to say , positive or negative, will help Example Retail Merchant to deliver the best possible service and show other customers how they perform. Allyour responses will be made available publicly on the Brandboost website. You can choose to make this review anonymous so that only Example Retail Merchant will know who are you.</p>
							<h6><strong>Many thanks, <br>The Brandboost Team</strong></h6>
							</div>
							</div>
							
							
							
							<div  class="purchase p-20 text-center">
							<h6 class="mb-10 grey"><strong>Important Notice</strong></h6>	
							<p class="grey">Whatever you have to say , positive or negative, will help Example Retail Merchant to deliver the best possible service and show other customers how they perform. <br>
							<br>Allyour responses will be made available publicly on the Brandboost website.
							You can choose to make this review anonymous so that only Example Retail Merchant will know who are you.</p>
							</div>
							
							<div class="ratings p-20">
							<div class="row">
							<div class="col-md-6"><img style="width: 150px;" src="assets/images/logo_dark2_new.png"/></div>
							<div class="col-md-6 text-right">
							<p class="mb0"><strong>Brandboost.io</strong></p>
							</div>
							</div>
							</div>
							
							
							
							<div class="clearfix"></div>
							</div>
							</div>
							
						<?php */ ?>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<!--Email preview_modal modal -->
<div id="preview_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-eye"></i>&nbsp; Preview Email Template</h5>
			</div>
			<div class="modal-body template_edit">
				<div class="row">
					
					
					<div class="col-md-12">
						<div class="switchbtn mb-20 text-center">
							<button class="btn btn-success deSktop"><i class="fa fa-desktop"></i> &nbsp; Desktop</button>&nbsp; &nbsp;
							<button class="btn bl_cust_btn btn-success moBile"><i class="fa fa-mobile-phone"></i> &nbsp; Mobile</button>
						</div>
						
						<div class="temp_left_option right">
							<!--<figure><img class="img-responsive" src="images/popupbkg.jpg"/></figure>-->
							
							<div class="productsec">
								<div class="headings">
									<img style="width: 150px;" src="<?php echo site_url('assets/images/logo_dark3.png'); ?>"/>
								</div>
								<figure>
									<img class="img-responsive" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $brandboostData->brand_img; ?>"/>
								</figure>
								
							</div>
							
							<div class="p15 text-center">
								<div class="mb-15">
									<h6><strong>Hi Alen, We'd Love your feedback!!!</strong></h6>
									<p>Thanks for buying from Example Retail Merchant. Please review your purchase. It only takes a minute and really helps!</p>
								</div>
								
								<div class="ratings pt-10 pb-20">
									<h6 class="mb-20"><strong>Get started by rating your experiance </strong></h6>	
									<p class="mb-20"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></p>
									<button class="btn trigger_btn bl_cust_btn btn-success">Leave your feedback! </button>
								</div>
								
								<div class="purchase pt-10 pb-20">
									<h6><strong>Your purchase on </strong></h6>	
									<p>{{CustomSaleDateFormat}}</p>
								</div>
								
								<div class="pt-20">
									<p class="mb-10">Whatever you have to say , positive or negative, will help Example Retail Merchant to deliver the best possible service and show other customers how they perform. Allyour responses will be made available publicly on the Brandboost website. You can choose to make this review anonymous so that only Example Retail Merchant will know who are you.</p>
									<h6><strong>Many thanks, <br>The Brandboost Team</strong></h6>
								</div>
							</div>
							
							
							
							<div  class="purchase p-20 text-center">
								<h6 class="mb-10 grey"><strong>Important Notice</strong></h6>	
								<p class="grey">Whatever you have to say , positive or negative, will help Example Retail Merchant to deliver the best possible service and show other customers how they perform. <br>
									<br>Allyour responses will be made available publicly on the Brandboost website.
								You can choose to make this review anonymous so that only Example Retail Merchant will know who are you.</p>
							</div>
							
							<div class="ratings p-20">
								<div class="row">
									<div class="col-md-6"><img style="width: 150px;" src="<?php echo site_url('assets/images/logo_dark2_new.png'); ?>"/></div>
									<div class="col-md-6 text-right">
										<p class="mb0"><strong>Brandboost.io</strong></p>
									</div>
								</div>
							</div>
							
							
							
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<!-- sms_modal modal -->
<div id="sms_modal" class="modal fade">
	<div style="max-width: 760px;" class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add / Edit SMS Template</h5>
			</div>
			<div class="modal-body template_edit">
				<div class="row">
					<form method="post" class="form-horizontal" id="saveSmsTemplate" action="javascript:void();">
						<div class="col-md-6">
							<div style="margin-top: 0px;" class="temp_left_option p15">
								<div class="form-group">
									<label>SMS Template: </label>
									<select class="form-control" id="smsTempId" name="smsTempId">
										<option value="">Select SMS Template</option>
										<?php foreach($smsTemplate as $smsTemp){ ?>
											<option value="<?php echo $smsTemp->id; ?>" created_time="<?php echo date("M d, Y h:i A", strtotime($smsTemp->created)); ?> (<?php echo timeAgo($smsTemp->created); ?>)" temp_content="<?php echo base64_decode($smsTemp->template_content); ?>"><?php echo $smsTemp->template_name; ?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="form-group">
									<label>Body: </label>
									<textarea style="height: 200px;" created_date="" name="smsCampaignTempBody" id="smsCampaignTempBody" class="form-control" placeholder="A collection of textile samples lay spread out on the table.."></textarea>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="mobile_sms_bkg">
								<div class="smsbubble smsEditPreviewContent">
									Created: May 28, 2018 03:50 PM (1 week ago)<br>A collection of textile samples lay spread out on the table..A collection of textile samples lay spread out on the table..
								</div>	
							</div>
						</div>
						
						<div class="col-md-12 text-right mt-20">
							<input type="hidden" name="smsCampaignIdVal" id="smsCampaignIdVal" value="">
							<button class="btn pull-right bl_cust_btn btn-success" type="submit" id="updateSmsCampaign"><i class="fa fa-plus"></i> &nbsp; Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<!-- SMS preview_modal modal -->
<div id="sms_preview_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-eye"></i>&nbsp; Preview SMS Template</h5>
			</div>
			<div class="modal-body template_edit">
				<div class="row">
					<div class="col-md-12">
						<div class="mobile_sms_bkg">
							<div class="smsbubble smsPreviewContent">
								Created: May 28, 2018 03:50 PM (1 week ago)<br>A collection of textile samples lay spread out on the table..A collection of textile samples lay spread out on the table..
							</div>	
						</div>
					</div>
					
					<!-- <div class="col-md-12 text-right mt-20">
						<button class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Edit</button>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<!-- WaitTime modal -->
<div id="waitTime" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-clock-o"></i>&nbsp; Wait Time Settings</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 txt_inp_grp">
						<form method="post" name="eventTimeUpdate" class="eventTimeUpdate" action="javascript:void(0);">
							<div style="float:left; width: 100%;">
								<h6 style="margin:8px 10px 0 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
								<input id="delay_time_value" name="delay_value" value="10" class="delay_value form-control mbot25 input-circle ui-wizard-content" type="text">
								<div style="display: inline-block; width: 120px; margin: 0 12px; float: left;" class="form-group waittimeselect">
									<select id="delay_time_unit" name="delay_unit" control_id="pl2" class="selectbox">
										<option value="minute" selected="">Minute(s)</option>
										<option value="hour">Hour(s)</option>
										<option value="day">Day(s)</option>
										<option value="week">Week(s)</option>
										<option value="month">Month(s)</option>
										<option value="year">Year(s)</option>
									</select>
								</div>
								<h6 style="margin:8px 0px 0 0!important; font-size: 13px; float: left;"> after the event is triggered </h6>
								<div class="eventDiv" style="float:left;display:none; ">
									<select id="event_type" name="event_type" class="form-control camp" style="width:120px;">
										<option value="sent" selected="">sent</option>
										<option value="opened">opened</option>
										<option value="not opened">not opened</option>
										<option value="clicked">clicked</option>
										<option value="not clicked">not clicked</option>
									</select>
								</div>
																
								<input name="event_id" id="event_id_val" value="" type="hidden">
								&nbsp; <button class="btn bl_cust_btn ui-wizard-content ui-formwizard-button" type="submit">Update</button>
								
								<h6 id="pl2" style="width:100%; margin-top:20px; display:none;">
                                    <div class="input-group mt-15 timeselector">
                                        <span class="pull-right" style="margin-right:10px;">Select Time of delivery </span><span class="input-group-addon"><i class="icon-watch2"></i></span>
                                        <input type="text" name="delay_time" id="anytime-time-hours2" value="9 PM" style="max-width: 138px;min-height:33px;padding-left:10px;">
                                    </div>
                                </h6>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<!-- contact_modal email modal -->
<div id="contact_modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Contacts</h5>
			</div>
			<div class="modal-body">
				<div class="tabbable">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="active"><a href="#AddContact" data-toggle="tab"><i class="icon-plus3 position-left"></i> Add Contact </a></li>
						<li><a href="#ContactList" data-toggle="tab"><i class="icon-list-unordered position-left"></i> Contact List </a></li>
					</ul>
					<div class="tab-content"> 
						<!--########################TAB 0 ##########################-->
						
						<div class="tab-pane active" id="AddContact">
							<form method="post" class="form-horizontal" id="addSubscriberData" action="javascript:void();">
								<div class="form-group">
									<label>First Name: </label>
									<input class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" type="text" required>
								</div>
								<div class="form-group">
									<label>Last Name: </label>
									<input class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" type="text" required>
								</div>
								<div class="form-group">
									<label>Email: </label>
									<input class="form-control" name="email" id="email" placeholder="Email Address" type="text" required>
								</div>
								<div class="form-group">
									<label>Phone: </label>
									<input class="form-control" name="phone" id="phone" placeholder="Enter Phone" type="text">
								</div>
								<input name="listId" id="listId" value="<?php echo $brandboostID; ?>" type="hidden">
								<button class="btn pull-right bl_cust_btn btn-success" type="submit"><i style="font-size: 12px;" class="icon-plus3"></i>  Save</button>
								<div class="clearfix"></div>
							</form>
						</div>
						
						<!--########################TAB 0 ##########################-->
						<div class="tab-pane" id="ContactList"> 
							<table class="table dtablenew media-library">
								<thead>
									<tr>
										<th style="width: 20px;"><input class=""  type="checkbox"></th>
										<th class="text-center">#No</th>
										<th>From</th>
										<th>Date Created</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($subscribersData as $key=>$subData){ $srNo = $key + 1; ?>
										<tr>
											<td><input class=""  type="checkbox"></td>
											<td class="text-center"><?php echo $srNo; ?></td>
											<td><div class="media-left"> <a href="javascript:void()" class="text-default text-semibold"><?php echo $subData->firstname; ?> <?php echo $subData->lastname; ?></a>
												<div class="text-muted text-size-small"><?php echo $subData->email; ?></div>
												<div class="text-muted text-size-small"><?php echo $subData->phone; ?></div>
											</div></td>
											<td><div class="text-semibold"><?php echo date("M d, Y", strtotime($subData->created)); ?></div>
											<div class="text-muted text-size-small"><?php echo date("h:i A", strtotime($subData->created)); ?> (<?php echo timeAgo($subData->created); ?>)</div></td>
											<td class="text-center">
												<button class="btn btn-success"><i style="font-size: 12px;" class="icon-plus3"></i>&nbsp; Add To Email</button>
											</td>
										</tr>
									<?php } ?>
									
								</tbody>
							</table>
						</div>
						
						<!--########################TAB end ##########################--> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<?php /* ?>
	<!-- contact_modal sms modal -->
	<div id="contact_modal_sms" class="modal fade">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">×</button>
	<h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Contacts</h5>
	</div>
	<div class="modal-body">
	<div class="tabbable">
	<ul class="nav nav-tabs nav-tabs-bottom">
	<li class="active"><a href="#AddContact1" data-toggle="tab"><i class="icon-plus3 position-left"></i> Add Contact </a></li>
	<li><a href="#ContactList2" data-toggle="tab"><i class="icon-list-unordered position-left"></i> Contact List </a></li>
	</ul>
	<div class="tab-content"> 
	<!--########################TAB 0 ##########################-->
	<div class="tab-pane active" id="AddContact">
	<form method="post" class="form-horizontal" id="addSubscriberData1" action="javascript:void();">
	<div class="form-group">
	<label>First Name: </label>
	<input class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" type="text" required>
	</div>
	<div class="form-group">
	<label>Last Name: </label>
	<input class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" type="text" required>
	</div>
	<div class="form-group">
	<label>Email: </label>
	<input class="form-control" name="email" id="email" placeholder="Email Address" type="text" required>
	</div>
	<div class="form-group">
	<label>Phone: </label>
	<input class="form-control" name="phone" id="phone" placeholder="Enter Phone" type="text">
	</div>
	<input name="listId" id="listId" value="<?php echo $currentBBUserID; ?>" type="hidden">
	<button class="btn pull-right bl_cust_btn btn-success" type="submit"><i style="font-size: 12px;" class="icon-plus3"></i>  Save</button>
	<div class="clearfix"></div>
	</form>
	</div>
	
	<!--########################TAB 0 ##########################-->
	<div class="tab-pane" id="ContactList"> 
	<table class="table dtablenew media-library">
	<thead>
	<tr>
	<th style="width: 20px;"><input class=""  type="checkbox"></th>
	<th class="text-center">#No</th>
	<th>From</th>
	<th>Date Created</th>
	<th class="text-center">Action</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($subscribersData as $key=>$subData){ $srNo = $key + 1; ?>
	<tr>
	<td><input class=""  type="checkbox"></td>
	<td class="text-center"><?php echo $srNo; ?></td>
	<td><div class="media-left"> <a href="javascript:void()" class="text-default text-semibold"><?php echo $subData->firstname; ?> <?php echo $subData->lastname; ?></a>
	<div class="text-muted text-size-small"><?php echo $subData->email; ?></div>
	<div class="text-muted text-size-small"><?php echo $subData->phone; ?></div>
	</div></td>
	<td><div class="text-semibold"><?php echo date("M d, Y", strtotime($subData->created)); ?></div>
	<div class="text-muted text-size-small"><?php echo date("h:i A", strtotime($subData->created)); ?> (<?php echo timeAgo($subData->created); ?>)</div></td>
	<td class="text-center">
	<button class="btn btn-success"><i style="font-size: 12px;" class="icon-plus3"></i>&nbsp; Add To Email</button>
	</td>
	</tr>
	<?php } ?>
	
	</tbody>
	</table>
	</div>
	<!--########################TAB end ##########################--> 
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<!-- /large modal -->	
<?php */ ?>
<script>
	function orderAutomationEvent(prevID, currentID, nextID, actionName){
		$.ajax({
			url: '<?php echo base_url('admin/brandboost/updateCampaignOrder'); ?>',
            type: "POST",
            data: {'previous_id':prevID, 'current_id':currentID, 'next_id':nextID, 'action_name': actionName},
            dataType: "json",
            success: function (data) {
				if (data.status == 'success'){
					
					} else{
					alertMessage('Error: Some thing wrong!');
				}
				}, error(){
				alertMessage('Error: Some thing wrong!');
			}
		});
	}
	
	$(document).ready(function(){
	
		$('.insert_tag_button').on('click', function() {
			var tagname = $(this).attr('data-tag-name');
			var wysihtml5Editor = $('#campaignTempBody').data("wysihtml5").editor;
            wysihtml5Editor.composer.commands.exec("insertHTML", tagname);
		});
		
		//$( init );
		
		function init() {
			$( ".droppable-area" ).sortable({
				connectWith: ".connected-sortable",
				containment: ".droppable-area",
				stack: '.connected-sortable div',
				activate: function( event, ui ) {
					$('.draggable-item').css({'box-shadow':'0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055)'});  
					var currentEventID = ui.item.attr('event_id');
					var previousEventID = ui.item.prev().attr('event_id');
					var nextEventID = ui.item.next().next().attr('event_id');
					//orderAutomationEvent(previousEventID, currentEventID, nextEventID, 'detach');
				},
				deactivate: function( event, ui ) {
					$('.draggable-item').css({'box-shadow':'none'}); 
					var currentEventID = ui.item.attr('event_id');
					var previousEventID = ui.item.prev().attr('event_id');
					var nextEventID = ui.item.next().attr('event_id');
					orderAutomationEvent(previousEventID, currentEventID, nextEventID, 'attach');
					
					$('.draggable-item').each(function(index){
						$(this).find('.itemOrder').html(index+1);
					});
				}
			}).disableSelection();
		}
		
		$(".dragProfileIcon").mouseover(function(){
			$(this).next().children().show();
			}).mouseout(function(){
			$(this).next().children().hide(); 
		});
		
		$(".dragIcon").mouseover(function(){
			$(this).children().show();
			}).mouseout(function(){
			$(this).children().hide(); 
		});
		
		$(".dragIcon i").mousedown(function(){
			$(this).show();
			}).mouseout(function(){
			$(this).hide(); 
		});
		
		$("button.moBile").click(function(){
			$(".temp_left_option.right").addClass("smaller");
			$("button.moBile").removeClass("bl_cust_btn ");
			$("button.deSktop").addClass("bl_cust_btn ");
		});
		
		$("button.deSktop").click(function(){
			$(".temp_left_option.right").removeClass("smaller");
			$("button.moBile").addClass("bl_cust_btn ");
			$("button.deSktop").removeClass("bl_cust_btn ");
		});
		
		$('.viewStatsData').click(function(){
			var campId = $(this).attr('campaign_id');
			$('#statsDetaild_'+campId).toggle('slow');
		});
		
		$('.addNewEvent').click(function(){
			
			var actionid = $(this).attr('previous_event_id');
			var currentid = $(this).attr('current_event_id');
			var eventtype = $(this).attr('event_type');
			$("#action_previous_id").val(actionid);
			$("#action_current_id").val(currentid);
			$("#action_event_type").val(eventtype);
			$("#addnewaction").modal();
		});
		
		$('.smsPreviewModal').click(function(){
			var smsData = $(this).attr('sms_preview_data');
			$('.smsPreviewContent').html(smsData);
			$('#sms_preview_modal').modal();
		});
		
		$('.editEmailTemplate').click(function(){
			var campaignId = $(this).attr('campaign_id');
			$.ajax({
				url: '<?php echo base_url('admin/brandboost/getCampaign'); ?>',
				type: "POST",
				data: {campaignId : campaignId},
				dataType: "json",
				success: function (data) {
					if(data.status == 'success'){
						var dataVal = data.campData;
						//console.log(data);
						$('#emailTempId').val(dataVal.template_source);
						$('#campaignTempSubject').val(dataVal.subject);
						$('#campaignTempBody').data("wysihtml5").editor.setValue(data.description);
						$('#emailTemplateSection').html(data.emailContent);
						$('#campaignTempHeading').val(dataVal.heading);
						$('#campaignTempGreeting').val(dataVal.greeting);
						$('#campaignTempIntroduction').val(dataVal.introduction);
						$('#campaignIdVal').val(campaignId);

						$('#template_modal').modal();
						}else{
						alertMessage('Error: Some thing wrong!');
					}
					}, error(){
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$('.editSmsTemplate').click(function(){
			var campaignId = $(this).attr('campaign_id');
			$.ajax({
				url: '<?php echo base_url('admin/brandboost/getCampaign'); ?>',
				type: "POST",
				data: {campaignId : campaignId},
				dataType: "json",
				success: function (data) {
					if(data.status == 'success'){
						var dataVal = data.campData;
						$('#smsTempId').val(dataVal.template_source);
						$('#smsCampaignTempBody').val(data.emailContent);
						$('.smsEditPreviewContent').html(data.createdVal + '<br>' + data.emailContent);
						$('#smsCampaignIdVal').val(campaignId);
						$('#smsCampaignTempBody').attr('created_date', data.createdVal);
						$('#sms_modal').modal();
						}else{
						alertMessage('Error: Some thing wrong!');
					}
					}, error(){
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$('#smsTempId').change(function(){
			var tempId = $(this).val();
			
			var tempContent = $(this).find('option[value="' + tempId + '"]').attr("temp_content");
			var createdDate = $(this).find('option[value="' + tempId + '"]').attr("created_time");
			if(tempContent !== undefined){
				$('.smsEditPreviewContent').html(createdDate + '<br>' + tempContent);
				$('.smsEditPreviewContent').show();
				$('#smsCampaignTempBody').val(tempContent);
				}else{
				$('.smsEditPreviewContent').html('');
				$('.smsEditPreviewContent').hide();
				$('#smsCampaignTempBody').val('');
			}
		});
		
		$('.waitTime').click(function(){
			var eventID = $(this).attr('event_id');
			var delayValue = $(this).attr('delay_value');
			var delayUnit = $(this).attr('delay_unit');
			var delayTime = $(this).attr('delay_time');
			
			$('#waitTime').modal();
			$('#event_id_val').val(eventID);
			$('#delay_time_value').val(delayValue);
			$('#delay_time_unit').val(delayUnit);
			
			if (delayUnit == 'day' || delayUnit == 'week'){
				$("#pl2").show();
				$("#anytime-time-hours2").val(delayTime);
			}
		});
		
		$(document).on("click", ".openEmailTemplate", function () {
			//var templateId = $(this).attr('template_id');
			//var previousEventId = $('#previousEventId_'+templateId).val();
			
			var templateId = $(this).attr('template_id');
			var previousID = $("#action_previous_id").val();
			var currentID = $("#action_current_id").val();
			var event_type = $("#action_event_type").val();
			
			$.ajax({
				url: '<?php echo base_url('admin/brandboost/create_event'); ?>',
				type: "POST",
				data: {previous_event_id : previousID, templateId : templateId, campaign_type : 'Email', 'current_event_id':currentID, 'event_type':event_type},
				dataType: "json",
				success: function (data) {
					if(data.status == 'success'){
						$('#emailTempId').val(templateId);
						$('#campaignTempSubject').val(data.temp_subject);
						//$('#campaignTempBody').val(data.temp_content);
						$('#campaignIdVal').val(data.campaignId);
						$('#template_modal').modal();
						$('#addnewaction').modal('hide');
						}else{
						alertMessage('Error: Some thing wrong!');
					}
					}, error(){
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$('.openSmsTemplate').click(function(){
			//var templateId = $(this).attr('template_id');
			//var previousEventId = $('#previousEventId_'+templateId).val();
			
			var templateId = $(this).attr('template_id');
			var previousID = $("#action_previous_id").val();
			var currentID = $("#action_current_id").val();
			var event_type = $("#action_event_type").val();
			
			$.ajax({
				url: '<?php echo base_url('admin/brandboost/create_event'); ?>',
				type: "POST",
				data: {previous_event_id : previousID, templateId : templateId, campaign_type : 'SMS', 'current_event_id':currentID, 'event_type':event_type},
				dataType: "json",
				success: function (data) {
					if(data.status == 'success'){
						$('#smsTempId').val(templateId);
						$('#smsCampaignTempBody').val(data.temp_content);
						$('#smsCampaignIdVal').val(data.campaignId);
						$('#sms_modal').modal();
						$('#addnewaction').modal('hide');
						}else{
						alertMessage('Error: Some thing wrong!');
					}
					}, error(){
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$('.eventTimeUpdate').on('submit', function (e) {
            e.preventDefault();
			var delayValue = $('#delay_time_value').val();
			var delayUnit = $('#delay_time_unit').val();
			var eventID = $('#event_id_val').val();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_event'); ?>',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
						$('#waitTime').modal('hide');
						$('#waitTime_'+eventID).html('Wait for ' + delayValue + ' ' + delayUnit + '(s)');
						$('#waitTime_'+eventID).attr('delay_value', delayValue);
						$('#waitTime_'+eventID).attr('delay_unit', delayUnit);
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
            return false;
		});

		$('#emailTempId').on('change', function() {
			var emailTempId = $(this).val();
			if(emailTempId > 0){
				$.ajax({
	                url: '<?php echo base_url('admin/brandboost/getEmailTempByID'); ?>',
	                type: "POST",
	                data: {emailTempId: emailTempId},
					dataType: "json",
	                success: function (data) {
	                    if (data.status == 'success') {
	                    	
	                    	$('#campaignTempSubject').val(data.subject);
	                    	$('#emailTemplateSection').html(data.content);
	                    	var campTempGreeting = $('#campaignTempGreeting').val();
	                    	var campTempIntroduction = $('#campaignTempIntroduction').val();
	                    	var campTempHeading = $('#campaignTempHeading').val();
	                    	var getDesc = $("#campaignTempBody").data("wysihtml5").editor.getValue();
	                    	
	                    	if(campTempGreeting != ''){
	                    		showContentInView('campaignTempGreeting', 'tempGreetingView');
	                    	}
	                    	if(campTempIntroduction != '') {
	                    		showContentInView('campaignTempIntroduction', 'tempIntroductionView');
	                    	}
	                    	if(campTempHeading != '') {
	                    		showContentInView('campaignTempHeading', 'tempHeadingView');
	                    	}
	                    	if(getDesc != '') {
	                    		$("#tempBodyView").html(getDesc);
	                    	}

							} else {
	                        alertMessage('Error: Some thing wrong!');
						}
					}
				});
	            return false;
			}
		});
		
		$('#updateEmailCampaign').on('click', function (e) {
            e.preventDefault();
			var templateSubject = $("#campaignTempSubject").val();
			var templateGreeting = $("#campaignTempGreeting").val();
			var templateIntroduction = $("#campaignTempIntroduction").val();
			var templateHeading = $("#campaignTempHeading").val();
			var templateContent = $("#campaignTempBody").val();
			var templateId = $("#emailTempId").val();
			var campaignId = $("#campaignIdVal").val();
			var campaignHtmlTemp = $("#emailTemplateSection").html();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_campaign'); ?>',
                type: "POST",
                data: {template_subject: templateSubject, template_greeting: templateGreeting, template_introduction: templateIntroduction, template_heading: templateHeading, template_content: templateContent, template_id: templateId, campaign_id: campaignId, campaignHtmlTemp: campaignHtmlTemp},
				dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
						window.location.href = window.location.href;
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
            return false;
		});
		
		$('#updateSmsCampaign').on('click', function (e) {
            e.preventDefault();
			var templateContent = $("#smsCampaignTempBody").val();
			var templateId = $("#smsTempId").val();
			var campaignId = $("#smsCampaignIdVal").val();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_campaign'); ?>',
                type: "POST",
                data: {template_content: templateContent, template_id: templateId, campaign_id: campaignId},
				dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
						window.location.href = window.location.href;
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
            return false;
		});
		
		$('#smsCampaignTempBody').keyup(function(){
			var createdDate = $(this).attr('created_date');
			if($(this).val() == ''){
				$('.smsbubble').hide();
				}else{
				$('.smsbubble').show();
				$('.smsbubble').html(createdDate + '<br>' +$(this).val());
			}
		});
				
		$('#campaignTempGreeting').keyup(function(){
			showContentInView('campaignTempGreeting', 'tempGreetingView');
		});
		
		$('#campaignTempIntroduction').keyup(function(){
			showContentInView('campaignTempIntroduction', 'tempIntroductionView');
		});
		
		$('#campaignTempHeading').keyup(function(){
			showContentInView('campaignTempHeading', 'tempHeadingView');
		});

		$('.wysihtml5-sandbox').contents().find('body').on('keyup',function(event){

			var getDesc = $("#campaignTempBody").data("wysihtml5").editor.getValue();
			$("#tempBodyView").html(getDesc);
        });
	});
	
	$(document).ready(function(){
		$("#anytime-time-hours2").AnyTime_picker({
			format: "%l %p"
		});
		
		$(".selectbox").change(function(){
			var ctrID = $(this).attr('control_id');
			if ($(this).val() == 'day' || $(this).val() == 'week'){
				$("#" + ctrID).show();
				} else{
				$("#" + ctrID).hide();
			}
		});
				
	});
	
	function showContentInView(inputFieldID, viewSectionID){
		$('#'+viewSectionID).html($('#'+inputFieldID).val());
	}
</script>
