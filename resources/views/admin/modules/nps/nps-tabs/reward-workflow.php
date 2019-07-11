<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/parsers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/editor_wysihtml5.js"></script>
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
    .viewstats{background: #fff!important; border: 1px solid #333!important; color: #333!important;}
    .viewstats:hover{background: #333!important; color: #fff!important;}
    .endtimeline:before, .endtimeline:after{display: none!important;}
	
    .circle_plus{display: block; border: 2px solid #ccc;color: #ccc; font-size: 16px; text-align: center; width: 40px; height: 40px; line-height: 34px; border-radius: 100px;}
    .circle_plus:hover, .circle_plus:focus{color: #c3dcf1; border-color: #c3dcf1!important; background: #ebf4fb!important;}
    .trigger_btn{display: block; margin: 0 auto; width: 200px; }
    .bl_cust_btn{font-size: 13px!important;}
	.trigger_btn.line{position: relative;}
	
	
	
	.trigger_btn_outer{position: relative;}
	.trigger_btn_outer:before{position: absolute; width: 100%; left: 0%; top: 17px; height: 2px;  z-index:-6; border: 1px solid #ddd; content: '';}
	.trigger_btn_outer:after{position: absolute; width: 230px; left: 50%; margin-left:-115px; z-index:-5; top: -6px; height: 50px; background: #fff;  content: '';}
	
	
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
    .insert_tag_button {margin: 0 10px 10px 0; font-size: 10px; padding: 7px;}
	.panel.showErrorMsg, .panel.showErrorMsg:hover{background:#f2d7d7!important; border:2px solid #F00!important;}
	.modal-lg.big_popup{ width:100%!important; max-width:1300px!important;}
	body{overflow-y:scroll !important;overflow:scroll !important; height:100%!important;}
    /*=======MODAL CSS=======*/	
</style>
<?php $aTags = array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}', '{BRANDNAME}', '{INTRODUCTION}', '{QUESTION}', '{SITEURL}', '{ACCOUNTHASHCODE}', '{UNSUBSCRIBE_LINK}'); ?>


<!--########################TAB 4 ##########################-->
<div class="tab-pane <?php echo ($defalutTab == 'workflow') ? 'active' : ''; ?>" id="right-icon-tab3">
    <?php
		$currentBBUserID = $brandboostData->user_id;
		$userData = $this->mUser->getUserInfo($currentBBUserID);
		$profileImg = $userData->avatar == '' ? base_url('assets/images/userp.png') : base_url('profile_images/' . $userData->avatar);
	?>
    <div class="panel panel-flat edge_panel">
        <div class="panel-heading">
            <h6 class="panel-title text-semibold">Daily statistics</h6>
            <div class="heading-elements"> <span class="heading-text"><i class="icon-history position-left text-success"></i> Updated <?php echo timeAgo($eventsData[0]->created); ?></span>
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
            <div class="timeline-date text-muted">Start this Campaign when one of these actions takes place</div>
            <div class="timeline-date text-muted">
                <button class="btn trigger_btn btn-success mb-20"><i class="fa fa-shield"></i> &nbsp; Invite</button>
			</div>
			
            <!-- Task email 1 -->
            <?php
				$inviteCampaignNo = 0;
				foreach ($eventsData as $key => $eventData) {
					$eventNo = $key + 1;
					$eventDataArray = json_decode($eventData->data);
					
						$campaignArray = $this->mNPS->getCampaignsByEventID($eventData->id);
						if (!empty($campaignArray)) {
						?>
						<div class="timeline-row post-full">
							<div class="timeline-icon"> <a href="#"><img src="<?php echo $profileImg; ?>" alt=""></a> </div>
						</div>
						<div class="timeline-date text-muted">
							<button class="btn bl_cust_btn btn-success waitTime" id="waitTime_<?php echo $eventData->id; ?>" event_id="<?php echo $eventData->id; ?>" delay_value="<?php echo $eventDataArray->delay_value == '' ? '10' : $eventDataArray->delay_value; ?>" delay_unit="<?php echo $eventDataArray->delay_unit == '' ? 'minute' : $eventDataArray->delay_unit; ?>"><i class="fa fa-clock-o"></i> &nbsp; <span class="text-semibold">Wait for <?php echo $eventDataArray->delay_value == '' ? '10' : $eventDataArray->delay_value; ?> <?php echo $eventDataArray->delay_unit == '' ? 'minute' : $eventDataArray->delay_unit; ?>(s)</span></button>
						</div>
						<?php
							foreach ($campaignArray as $campaignData) {
								$inviteCampaignNo++;
								if ($campaignData->campaign_type == 'Email') {
									//pre($campaignData);
									$aStats = $this->mNPS->getNPSSendgridStats('event', $eventData->id);
									$aCategorizedStats = $this->mNPS->getEmailSendgridCategorizedStatsData($aStats);
									
									$processed = $aCategorizedStats['processed']['UniqueCount'];
									$delivered = $aCategorizedStats['delivered']['UniqueCount'];
									$open = $aCategorizedStats['open']['UniqueCount'];
									$click = $aCategorizedStats['click']['UniqueCount'];
									$unsubscribe = $aCategorizedStats['unsubscribe']['UniqueCount'];
									$bounce = $aCategorizedStats['bounce']['UniqueCount'];
									$dropped = $aCategorizedStats['dropped']['UniqueCount'];
									$spamReport = $aCategorizedStats['spam_report']['UniqueCount'];
								?>
								
								<div class="timeline-row post-even">
									<div class="timeline-icon"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" alt=""> </div>
									<div class="timeline-time"> <a href="#" target="_blank"><?php echo $userData->firstname . ' ' . $userData->lastname; ?></a> added a new email campaign <span class="text-muted"><?php echo timeAgo($campaignData->created); ?></span> </div>
									<div class="timeline-content">
										<div class="panel border-left-lg gery_bkg border-left-primary" style="<?php echo $campaignData->status == 'draft' ? 'background:#f2bfbf' : ''; ?>">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-7">
														<h6 class="no-margin-top"><a href="javascript:void(0);"><?php echo $inviteCampaignNo; ?>. <?php echo $campaignData->name; ?> : <?php echo $campaignData->subject; ?></a></h6>
													</div>
													<div class="col-md-5 text-right">
														<a class="btn bl_cust_btn  edit_email_template editEmailTemplate" campaign_id="<?php echo $campaignData->id; ?>" id="editEmailTemplate_<?php echo $campaignData->id; ?>" style="cursor: pointer;" ><i class="fa fa-edit"></i> </a>
														<a class="btn green_cust_btn showContentPreview" href="javascript:void(0);" campaign_type="email" campaign_id="<?php echo $campaignData->id; ?>"><i class="fa fa-eye"></i> </a>
														<button class="btn viewstats" campaign_id="<?php echo $campaignData->id; ?>"><i class="fa fa-pie-chart"></i></button>
														<button class="btn red" onclick="javascript:delete_campaign('<?php echo $campaignData->id; ?>');"><i class="fa fa-trash"></i></button>
														<?php if($eventData->event_type == 'reminder-email') { ?>
															<div class="row" style="margin-top:10px;">
																Reminder Loop: <input type="text" class="form-control saveReminderLoop" event_id="<?php echo $eventData->id; ?>" value="<?php echo $eventData->reminder_loop; ?>" style="width: 40px; display: inline; height: 37px; padding: 5px; text-align:center;font-weight: bold; color: #F00; margin-right: 10px;">
																<!-- <button class="btn red saveReminderCampaign" reminder_loop_status="start" id="reminderCampaignStart_<?php echo $eventData->id; ?>" style="margin-right:10px; <?php echo $eventData->reminder_loop_status  == 'start' ? 'display:none;' : ''; ?>" event_id="<?php echo $eventData->id; ?>"><i class="fa fa-play"></i></button>
																<button class="btn bl_cust_btn saveReminderCampaign" reminder_loop_status="pause" id="reminderCampaignPause_<?php echo $eventData->id; ?>" style="margin-right:10px; <?php echo $eventData->reminder_loop_status  == 'start' ? '' : 'display:none;'; ?>" event_id="<?php echo $eventData->id; ?>"><i class="fa fa-pause"></i></button> -->
															</div>
														<?php } ?>
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
								<!-- /task -->
								
								<?php
									}else {
									
									//Display SMS & Stats
									
									$aStatsSms = $this->mNPS->getEmailTwilioStats('event', $eventData->id);
									$aCategorizedStatsSms = $this->mNPS->getEmailTwilioCategorizedStatsData($aStatsSms);
									
									$sentSms = $aCategorizedStatsSms['sent']['UniqueCount'];
									$deliveredSms = $aCategorizedStatsSms['delivered']['UniqueCount'];
									$acceptedSms = $aCategorizedStatsSms['accepted']['UniqueCount'];
									$failedSms = $aCategorizedStatsSms['failed']['UniqueCount'];
									$queuedSms = $aCategorizedStatsSms['queued']['UniqueCount'];
								?>
								
								<div>
									<div class="timeline-row post-odd">
										<div class="timeline-icon"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" alt=""> </div>
										<div class="timeline-time"> <a href="#"><?php echo $oUser->firstname . ' ' . $oUser->lastname; ?></a> added a new sms campaign <span class="text-muted"><?php echo timeAgo($campaignData->created); ?></span> </div>
										<div class="timeline-content">
											<div class="panel gery_bkg border-right-lg border-right-primary" style="<?php echo $campaignData->status == 'draft' ? 'background:#f2bfbf' : ''; ?>">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-7">
															<h6 class="no-margin-top"><a href="#"><?php echo $inviteCampaignNo; ?>. <?php echo $campaignData->name; ?> : <?php echo $campaignData->subject; ?></a></h6>
															
														</div>
														
														
														<div class="col-md-5 text-right">
															<a class="btn bl_cust_btn  edit_email_template editSmsTemplate" campaign_id="<?php echo $campaignData->id; ?>" id="editEmailTemplate_<?php echo $campaignData->id; ?>" style="cursor: pointer;" ><i class="fa fa-edit"></i> </a>
															<a class="btn green_cust_btn showContentPreview" href="javascript:void(0);" campaign_type="sms" campaign_id="<?php echo $campaignData->id; ?>"><i class="fa fa-eye"></i> </a>
															<button class="btn viewstats" campaign_id="<?php echo $campaignData->id; ?>"><i class="fa fa-pie-chart"></i></button>
															<button class="btn red" onclick="javascript:delete_campaign('<?php echo $campaignData->id; ?>');"><i class="fa fa-trash"></i></button>
															<?php if($eventData->event_type == 'reminder-sms') { ?>
																<div class="row" style="margin-top:10px;">
																	Reminder Loop: <input type="text" class="form-control saveReminderLoop" event_id="<?php echo $eventData->id; ?>" value="<?php echo $eventData->reminder_loop; ?>" style="width: 40px; display: inline; height: 37px; padding: 5px; text-align:center;font-weight: bold; color: #F00; margin-right: 10px;">
																	<!-- <button class="btn red saveReminderCampaign" reminder_loop_status="start" id="reminderCampaignStart_<?php echo $eventData->id; ?>" style="margin-right:10px; <?php echo $eventData->reminder_loop_status  == 'start' ? 'display:none;' : ''; ?>" event_id="<?php echo $eventData->id; ?>"><i class="fa fa-play"></i></button>
																	<button class="btn bl_cust_btn saveReminderCampaign" reminder_loop_status="pause" id="reminderCampaignPause_<?php echo $eventData->id; ?>" style="margin-right:10px; <?php echo $eventData->reminder_loop_status  == 'start' ? '' : 'display:none;'; ?>" event_id="<?php echo $eventData->id; ?>"><i class="fa fa-pause"></i></button> -->
																</div>
															<?php } ?>
														</div>
													</div>
												</div>
											</div>  
											<div class="panel green_bkg border-right-lg border-right-danger" id="statsDetaild_<?php echo $campaignData->id; ?>">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-12">
															<h6 class="no-margin-top"><a href="#">Type: SMS</a></h6>
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
													<div class="heading-elements"> <span class="heading-text">Created: <span class="text-semibold"><?php echo date("M d, Y h:i A", strtotime($campaignData->created)); ?> (<?php echo timeAgo($campaignData->created); ?>)</span></span>
														
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /task -->
									
								</div>
								
								
								<?php
								}
							}
						}
					
				}
			?>
			
			<?php if($inviteCampaignNo < 4){ ?>
				<div class="timeline-row post-full">
					<div class="timeline-icon"> <a class="circle_plus" onclick="openCampaignBox('invite');" href="javascript:void(0);"><i class="icon-plus3"></i></a> </div>
				</div>
			<?php } ?>
			
		</div>
	</div>
	
	<div class="row pull-right">
		<a href="javascript:void(0);" class="btn bl_cust_btn bg-blue-600 updateAllCampaign">Continue</a>
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
				<div class="tabbable">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="active"><a href="#EmailRequest" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> Email Request </a></li>
						<li><a href="#SMSRequest" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> SMS Request </a></li>
					</ul>
					<div class="tab-content">
						<!--########################TAB 0 ##########################-->
						<div class="tab-pane active" id="EmailRequest">
							<div class="row">
								<?php 
									foreach ($campaignTemplates as $emailTemp) { 
										//pre($emailTemp);
										if($emailTemp->campaign_type == 'Email'){  
										?>
										<div class="col-md-6 <?php echo $emailTemp->name.'_campaign'; ?>">
											<div campaign_id="<?php echo $emailTemp->id; ?>" class="panel bg-primary actionpanel <?php echo $emailTemp->delete_status == '0' ? 'showErrorMsg' : 'editEmailTemplate'; ?>">
												<div class="panel-body">
													<div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
													<div class="media-left">
														<h6><?php echo $emailTemp->name; ?></h6>
														<p><?php echo $emailTemp->subject; ?></p>
													</div>
												</div>
											</div>
										</div>
									<?php } } ?>								
							</div>
						</div>
						<!--########################TAB 0 ##########################-->
						<div class="tab-pane" id="SMSRequest">
							<div class="row">
								<?php 
									foreach ($campaignTemplates as $smsTemp) { 
										if($smsTemp->campaign_type == 'Sms'){ 
										?>
										<div class="col-md-6 <?php echo $smsTemp->name.'_campaign'; ?>">
											<div campaign_id="<?php echo $smsTemp->id; ?>" class="panel bg-primary actionpanel <?php echo $smsTemp->delete_status == '0' ? 'showErrorMsg' : 'editSmsTemplate'; ?>">
												<div class="panel-body">
													<div class="media-left"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" style="width: 40px;"> </div>
													<div class="media-left">
														<h6><?php echo $smsTemp->name; ?></h6>
														<p><?php echo $smsTemp->subject; ?></p>
													</div>
												</div>
											</div>
										</div>
									<?php } } ?>
							</div>
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
	<div class="modal-dialog modal-lg big_popup">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Update Email Template</h5>
			</div>
			<div class="modal-body template_edit">
				<form method="post" class="form-horizontal" action="javascript:void();">
					<div class="row">
						<div class="col-md-6">
							<div class="temp_left_option p15" style="margin-top:0;">
								
								<div class="form-group">
									<label>Subject: </label>
									<input class="form-control" id="campaignTempSubject" name="campaignTempSubject"  placeholder="Email Subject" type="text">
								</div>
								
								<div class="form-group">
									<label>Email Content: </label>
									<textarea class="form-control wysihtml5 wysihtml5-default textareabot" id="campaignTempBody" name="campaignTempBody"  placeholder="A collection of textile samples lay spread out on the table.."></textarea>
								</div>
								<div class="form-group">
									<div class="note-btn-group btn-group note-view">
										<?php
											foreach ($aTags as $value) {
												?><button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo $value; ?>" class="btn btn-default add_btn draggable insert_tag_button" campaignid="<?php echo $oCampaign->id;?>"><?php echo $value; ?></button>&nbsp;&nbsp;<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">		
							<div class="temp_left_option right p15" id="emailContentView">
								<div class="clearfix"></div>
							</div>
						</div>
						
						
						<div class="col-md-12 text-right mt-20">
							<input type="hidden" name="editCampaignID" id="editCampaignID" value="">
							<button class="btn pull-right bl_cust_btn btn-success" type="submit" id="updateEmailCampaign"><i class="fa fa-plus"></i> &nbsp; Save</button>
						</div>						
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
			<div class="modal-body">
				<div class="row templatePreview">
					
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
				<h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Update SMS Template</h5>
			</div>
			<div class="modal-body template_edit">
				<div class="row">
					<form method="post" class="form-horizontal" id="saveSmsTemplate" action="javascript:void();">
						<div class="col-md-6">
							<div style="margin-top: 0px;" class="temp_left_option p15">
								
								<div class="form-group">
									<label>Body: </label>
									<textarea style="height: 200px;" name="smsCampaignTempBody" id="smsCampaignTempBody" class="form-control" placeholder="A collection of textile samples lay spread out on the table.."></textarea>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="mobile_sms_bkg">
								<div class="smsbubble" id="smsCampaignTempView">
									
								</div>	
							</div>
						</div>
						
						<div class="col-md-12 text-right mt-20">
							<input type="hidden" name="smsCampaignId" id="smsCampaignId" value="">
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
							<div class="smsbubble" id="smsTemplatePreview">
								Created: May 28, 2018 03:50 PM (1 week ago)<br>A collection of textile samples lay spread out on the table..A collection of textile samples lay spread out on the table..
							</div>	
						</div>
					</div>
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
									<select id="delay_time_unit" name="delay_unit" class="selectbox">
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
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /large modal -->

<script>
	function openCampaignBox(campaignType){
		$('#addnewaction').modal();
	}
	
	function delete_campaign(campaignId){
		swal({
			title: "Are you sure? You want to delete this record!",
			text: "You will not be able to recover this record!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#EF5350",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel pls!",
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function (isConfirm) {
			if (isConfirm) {
				$('.overlaynew').show();
				$.ajax({
					url: '<?php echo base_url('admin/modules/nps/deleteNPSCampaign'); ?>',
					type: "POST",
					data: {campaign_id: campaignId},
					dataType: "json",
					success: function (data) {
						$('.overlaynew').hide();
						if (data.status == 'success') {
							window.location.href = window.location.href;
						} else {
							alertMessage('Error: Some thing wrong!');
						}
					}
				});
			}
		});
	}
	
	$(document).ready(function () {
		$("button.moBile").click(function () {
			$(".temp_left_option.right").addClass("smaller");
			$("button.moBile").removeClass("bl_cust_btn ");
			$("button.deSktop").addClass("bl_cust_btn ");
		});
		
		$("button.deSktop").click(function () {
			$(".temp_left_option.right").removeClass("smaller");
			$("button.moBile").addClass("bl_cust_btn ");
			$("button.deSktop").removeClass("bl_cust_btn ");
		});
		
		$('.viewstats').click(function () {
			var campId = $(this).attr('campaign_id');
			$('#statsDetaild_' + campId).toggle('slow');
		});
		
		$(document).on("click", ".showErrorMsg", function () {
			alertMessage('This campaign has been already added.');
		});
		
		$('.updateAllCampaign').click(function(){
			var npsId = <?php echo $programID; ?>;
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/updateAllCampaign'); ?>',
				type: "POST",
				data: {nps_id: npsId},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						window.location.href = '<?php echo base_url("/admin/modules/nps/setup/{$programID}?t=people") ?>';
					} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
			return false;
		});
		
		$('.saveReminderLoop').keyup(function(){
			var eventId = $(this).attr('event_id');
			var loopValue = $(this).val();
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/updateNPSReminderLoop'); ?>',
				type: "POST",
				data: {event_id: eventId, loop_value: loopValue},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						//window.location.href = window.location.href;
						} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
			return false;
		});
		
		$('.saveReminderCampaign').click(function(){
			var eventId = $(this).attr('event_id');
			var reminderLoopStatus = $(this).attr('reminder_loop_status');
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/updateNPSReminderCampaign'); ?>',
				type: "POST",
				data: {event_id: eventId, reminder_loop_status: reminderLoopStatus},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						if(reminderLoopStatus == 'start'){
							$('#reminderCampaignStart_'+eventId).hide();
							$('#reminderCampaignPause_'+eventId).show();
							}else{
							$('#reminderCampaignStart_'+eventId).show();
							$('#reminderCampaignPause_'+eventId).hide();
						}
						//window.location.href = window.location.href;
						} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
			return false;
		});
		
		$(document).on("click", ".editEmailTemplate", function () {
			$('.overlaynew').show();
			var campaignId = $(this).attr('campaign_id');
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/getNPSCampaign'); ?>',
				type: "POST",
				data: {campaign_id: campaignId, nps_id: '<?php echo $programID; ?>'},
				dataType: "json",
				success: function (data) {
					$('.overlaynew').hide();
					if (data.status == 'success') {
						var dataVal = data.campData;
						$('#editCampaignID').val(campaignId);
						$('#campaignTempSubject').val(dataVal.subject);
						$('#campaignTempBody').val(data.description);
						$('#emailContentView').html(data.content);
						$('#template_modal').modal();
						} else {
						alertMessage('Error: Some thing wrong!');
					}
					}, error() {
					$('.overlaynew').hide();
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$(document).on("click", ".showContentPreview", function () {
			$('.overlaynew').show();
			var campaignId = $(this).attr('campaign_id');
			var campaignType = $(this).attr('campaign_type');
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/getNPSCampaign'); ?>',
				type: "POST",
				data: {campaign_id: campaignId, nps_id: '<?php echo $programID; ?>'},
				dataType: "json",
				success: function (data) {
					$('.overlaynew').hide();
					if (data.status == 'success') {
						if(campaignType == 'sms'){
							$('#smsTemplatePreview').html(data.content);
							$('#sms_preview_modal').modal();
							}else{
							$('.templatePreview').html(data.content);
							$('#preview_modal').modal();
						}
						} else {
						alertMessage('Error: Some thing wrong!');
					}
					}, error() {
					$('.overlaynew').hide();
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$('.editSmsTemplate').click(function () {
			$('.overlaynew').show();
			var campaignId = $(this).attr('campaign_id');
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/getNPSCampaign'); ?>',
				type: "POST",
				data: {campaign_id: campaignId, nps_id: '<?php echo $programID; ?>'},
				dataType: "json",
				success: function (data) {
					$('.overlaynew').hide();
					if (data.status == 'success') {
						var dataVal = data.campData;
						$('#smsCampaignTempBody').val(data.description);
						$('#smsCampaignTempView').html(data.content);
						$('#smsCampaignId').val(campaignId);
						$('#sms_modal').modal();
						} else {
						$('.overlaynew').hide();
						alertMessage('Error: Some thing wrong!');
					}
					}, error() {
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$('.waitTime').click(function () {
			var eventID = $(this).attr('event_id');
			var delayValue = $(this).attr('delay_value');
			var delayUnit = $(this).attr('delay_unit');
			$('#waitTime').modal();
			$('#event_id_val').val(eventID);
			$('#delay_time_value').val(delayValue);
			$('#delay_time_unit').val(delayUnit);
		});
		
		$('.eventTimeUpdate').on('submit', function (e) {
			e.preventDefault();
			var delayValue = $('#delay_time_value').val();
			var delayUnit = $('#delay_time_unit').val();
			var eventID = $('#event_id_val').val();
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/updateNPSEvent'); ?>',
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('#waitTime').modal('hide');
						$('#waitTime_' + eventID).html('Wait for ' + delayValue + ' ' + delayUnit + '(s)');
						$('#waitTime_' + eventID).attr('delay_value', delayValue);
						$('#waitTime_' + eventID).attr('delay_unit', delayUnit);
						} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
			return false;
		});
		
		$('#updateEmailCampaign').on('click', function (e) {
			e.preventDefault();
			var templateSubject = $("#campaignTempSubject").val();
			var templateContent = $("#campaignTempBody").val();
			var campaignId = $("#editCampaignID").val();
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/updateNPSCampaign'); ?>',
				type: "POST",
				data: {subject: templateSubject, template_content: templateContent, campaign_id: campaignId, campaign_type: 'Email'},
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
			var campaignId = $("#smsCampaignId").val();
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/updateNPSCampaign'); ?>',
				type: "POST",
				data: {template_content: templateContent, campaign_id: campaignId, campaign_type: 'Sms'},
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
		
		$('#smsCampaignTempBody').keyup(function () {
			if ($(this).val() == '') {
				$('.smsbubble').hide();
				} else {
				$('.smsbubble').show();
				$('.smsbubble').html($(this).val());
			}
		});
		
	});
</script>
