<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>


<style>
    .AnyTime-win, .daterangepicker {z-index: 99999999 !important;}
    .panel .timeline-time {	background: none!important;}
    .timeline-date { background: #FFF!important;}
    .timeline{z-index: 1; padding:0 20px;}
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
    .edge_panel{margin: 0 20px; border-left: none; border-right: none; box-shadow: none;}
    .insert_tag_button {margin: 0 10px 10px 0; font-size: 10px; padding: 6px;}

    /*=======MODAL CSS=======*/	
</style>	

<?php
list($canReadCon, $canWriteCon) = fetchPermissions('Contacts');
list($canReadAna, $canWriteAna) = fetchPermissions('Analytics');
$bAnyEventExist = false;
$bListAdded = false;
$bTriggerAdded = false;
//pre($oEvents);
//die;

if (!empty($oEvents)) {
    $oFinal[] = $oEvents[0];
    $eventID = $oEvents[0]->automation_event_id;
    foreach ($oEvents as $key => $value) {
        foreach ($oEvents as $inner) {
            if ($inner->previous_event_id == $eventID) {
                $oFinal[] = $inner;
                $eventID = $inner->automation_event_id;
                break;
            }
        }
    }
}
//pre($oFinal);
//die;
$oEvents = $oFinal;

if (!empty($oEvents)) {
    foreach ($oEvents as $oEvent) {
        if (empty($oEvent->previous_event_id)) {
            $oMainEvent = $oEvent;
            break;
        }
    }
    if (!empty($oMainEvent)) {
        $aMainTriggerData = json_decode($oMainEvent->data);
    }
}
?>

<!--########################TAB 0 ##########################-->
<div class="tab-pane <?php echo $emailWorkflow; ?>" id="right-icon-tab3" style="background:#fff;">
    <?php
    $listID = $brandboostData->list_id;
    $dateData = json_decode($eventsData[0]->data);
    $currentBBUserID = $brandboostData->user_id;
    //$CI = & get_instance();
    //$CI->load->model("admin/Brandboost_model", "mB");
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
                <button class="btn trigger_btn btn-success mb-20 chooselist">Tag: New Customer <?php
                    if (count($oAutomationLists)) {
                        $bListAdded = true;
                        echo '<br>(' . count($oAutomationLists) . ' List added)';
                    }
                    ?></button>
                <button class="btn trigger_btn bl_cust_btn btn-success chooseTrigger"><i style="font-size: 12px;" class="icon-plus3"></i>  Add New Trigger <?php if (!empty($oMainEvent)): ?><br>(<?php echo $oMainEvent->event_type; ?>)<?php endif; ?></button>

            </div>
            <?php
            if (!empty($oMainEvent)):
                $previousID = $oMainEvent->previous_event_id;
                $currentID = $oMainEvent->automation_event_id;
                $bAnyEventExist = true;
                $bTriggerAdded = true;
                ?>

                <div class="timeline-row post-full">
                    <div class="timeline-icon start"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="main" class="circle_plus <?php echo ($bAnyEventExist == false || $bListAdded == false) ? 'validatecustlist' : 'addnewaction'; ?>" href="javascript:void(0);"><i class="icon-plus3"></i></a> </div>
                </div>
            <?php endif; ?>
            <div class="connected-sortable droppable-area">

                <!-- Task email 1 -->
                <?php
                $isValidated = true;

                $eventNo = 0;

                foreach ($oEvents as $oEvent) {
                    //pre($oEvent);
                    $isSMSAdded = $isEmailAdded = false;
                    if (!empty($oEvent->campaign_type)) {

                        $processed = $delivered = $open = $click = $unsubscribe = $bounce = $dropped = $spamReport = $sentSms = $deliveredSms = $acceptedSms = $failedSms = $queuedSms = '';

                        $previousID = $currentID = '';
                        $eventNo++;
                        $previousID = $oEvent->previous_event_id;
                        $currentID = $oEvent->automation_event_id;
                        $aFollowupTriggerData = '';
                        $aFollowupTriggerData = json_decode($oEvent->data);
                        if ($oEvent->campaign_type == 'Email') {
                            $bAnyEventExist = true;
                            //Display Emails & Stats
                            $isSMSAdded = true;

                            $aStats = $this->mEmails->getEmailSendgridStats('campaign', $oEvent->id);
                            $aCategorizedStats = $this->mEmails->getEmailSendgridCategorizedStatsData($aStats);

                            $processed = $aCategorizedStats['processed']['UniqueCount'];
                            $delivered = $aCategorizedStats['delivered']['UniqueCount'];
                            $open = $aCategorizedStats['open']['UniqueCount'];
                            $click = $aCategorizedStats['click']['UniqueCount'];
                            $unsubscribe = $aCategorizedStats['unsubscribe']['UniqueCount'];
                            $bounce = $aCategorizedStats['bounce']['UniqueCount'];
                            $dropped = $aCategorizedStats['dropped']['UniqueCount'];
                            $spamReport = $aCategorizedStats['spam_report']['UniqueCount'];
                            //pre($oEvent);
                            ?>


                            <div class="draggable-item" event_id="<?php echo $oEvent->automation_event_id; ?>" item_order="<?php echo $eventNo; ?>">
                                <div class="timeline-date text-muted">
                                    <button class="btn bl_cust_btn btn-success waitTime" id="waitTime_<?php echo $oEvent->automation_event_id; ?>" event_id="<?php echo $oEvent->automation_event_id; ?>" delay_value="<?php echo $aFollowupTriggerData->delay_value == '' ? '10' : $aFollowupTriggerData->delay_value; ?>" delay_unit="<?php echo $aFollowupTriggerData->delay_unit == '' ? 'minute' : $aFollowupTriggerData->delay_unit; ?>" delay_time="<?php echo!(empty($aFollowupTriggerData->delay_time)) ? $aFollowupTriggerData->delay_time : '9 PM'; ?>"><i class="fa fa-clock-o"></i> &nbsp; <span class="text-semibold">Wait for <?php echo $aFollowupTriggerData->delay_value == '' ? '10' : $aFollowupTriggerData->delay_value; ?> <?php echo $aFollowupTriggerData->delay_unit == '' ? 'minute' : $aFollowupTriggerData->delay_unit; ?>(s)</span></button>
                                </div>
                                <div class="timeline-row post-even">
                                    <div class="timeline-icon"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" alt=""> </div>
                                    <div class="timeline-time"> <a href="#" target="_blank"><?php echo $oUser->firstname . ' ' . $oUser->lastname; ?></a> added a new email campaign <span class="text-muted"><?php echo timeAgo($oEvent->created); ?></span> </div>
                                    <div class="timeline-content">
                                        <div class="panel border-left-lg gery_bkg border-left-primary" style="<?php echo $oEvent->event_status == 'draft' ? 'background:#f2bfbf' : ''; ?>">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <h6 class="no-margin-top"><a href="#"><span class="itemOrder itemOrder_<?php echo $eventNo; ?>"><?php echo $eventNo; ?></span>. <?php echo $oEvent->subject; ?></a></h6>

                                                    </div>
                                                    <div class="col-md-5 text-right">
                                                        <a campaign_id="<?php echo $oEvent->campaign_id; ?>" class="btn bl_cust_btn  editcampaign" style="cursor: pointer;" ><i class="fa fa-edit"></i> </a>
                                                        <a campaign_id="<?php echo $oEvent->campaign_id; ?>" class="btn green_cust_btn previewCampaign" ><i class="fa fa-eye"></i> </a>
                                                        <?php if ($canWriteAna): ?>
                                                            <button class="btn viewstats" campaign_id="<?php echo $oEvent->automation_event_id; ?>"><i class="fa fa-pie-chart"></i></button>
                                                        <?php endif; ?>
                                                        <button class="btn red" onclick="javascript:delete_email_automation_event('<?php echo $oEvent->automation_event_id; ?>');"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel green_bkg border-left-lg border-left-danger" id="statsDetaild_<?php echo $oEvent->automation_event_id; ?>">
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
                                                <div class="heading-elements"> <span class="heading-text">Created: <span class="text-semibold"><?php echo date("M d, Y h:i A", strtotime($oEvent->created)); ?> (<?php echo timeAgo($oEvent->created); ?>)</span></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-row post-full">
                                    <div class="timeline-icon"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="followup" class="circle_plus <?php echo ($bAnyEventExist == false || $bListAdded == false) ? 'validatecustlist' : 'addnewaction'; ?>" href="javascript:void(0);"><i class="icon-plus3 "></i></a> </div>
                                </div>
                            </div>
                            <!-- /task -->

                            <?php
                        }
                        else {
                            $bAnyEventExist = true;
                            //Display SMS & Stats

                            $aStatsSms = $this->mEmails->getEmailTwilioStats('campaign', $oEvent->id);
                            $aCategorizedStatsSms = $this->mEmails->getEmailTwilioCategorizedStatsData($aStatsSms);

                            $sentSms = $aCategorizedStatsSms['sent']['UniqueCount'];
                            $deliveredSms = $aCategorizedStatsSms['delivered']['UniqueCount'];
                            $acceptedSms = $aCategorizedStatsSms['accepted']['UniqueCount'];
                            $failedSms = $aCategorizedStatsSms['failed']['UniqueCount'];
                            $queuedSms = $aCategorizedStatsSms['queued']['UniqueCount'];
                            ?>

                            <div class="draggable-item" event_id="<?php echo $oEvent->automation_event_id; ?>" item_order="<?php echo $eventNo; ?>">
                                <div class="timeline-date text-muted">
                                    <button class="btn bl_cust_btn btn-success waitTime" id="waitTime_<?php echo $oEvent->automation_event_id; ?>" event_id="<?php echo $oEvent->automation_event_id; ?>" delay_value="<?php echo $aFollowupTriggerData->delay_value == '' ? '10' : $aFollowupTriggerData->delay_value; ?>" delay_unit="<?php echo $aFollowupTriggerData->delay_unit == '' ? 'minute' : $aFollowupTriggerData->delay_unit; ?>" delay_time="<?php echo!(empty($aFollowupTriggerData->delay_time)) ? $aFollowupTriggerData->delay_time : '9 PM'; ?>"><i class="fa fa-clock-o"></i> &nbsp; <span class="text-semibold">Wait for <?php echo $aFollowupTriggerData->delay_value == '' ? '10' : $aFollowupTriggerData->delay_value; ?> <?php echo $aFollowupTriggerData->delay_unit == '' ? 'minute' : $aFollowupTriggerData->delay_unit; ?>(s)</span></button>
                                </div>
                                <div class="timeline-row post-odd">
                                    <div class="timeline-icon"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" alt=""> </div>
                                    <div class="timeline-time"> <a href="#"><?php echo $oUser->firstname . ' ' . $oUser->lastname; ?></a> added a new sms campaign <span class="text-muted"><?php echo timeAgo($oEvent->created); ?></span> </div>
                                    <div class="timeline-content">
                                        <div class="panel gery_bkg border-right-lg border-right-primary" style="<?php echo $oEvent->event_status == 'draft' ? 'background:#f2bfbf' : ''; ?>">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <h6 class="no-margin-top"><a href="#"><span class="itemOrder itemOrder_<?php echo $eventNo; ?>"><?php echo $eventNo; ?></span>. <?php echo $oEvent->name; ?></a></h6>

                                                    </div>


                                                    <div class="col-md-5 text-right">
                                                        <a campaign_id="<?php echo $oEvent->campaign_id; ?>" class="btn bl_cust_btn  edit_email_template editSmsCampaign" style="cursor: pointer;" ><i class="fa fa-edit"></i> </a> 
                                                        <a campaign_id="<?php echo $oEvent->campaign_id; ?>" data-toggle="modal" data-target="#sms_preview_modal" class="btn green_cust_btn previewSMSCampaign" ><i class="fa fa-eye"></i> </a>
                                                        <?php if ($canWriteAna): ?>
                                                            <button class="btn viewstats" campaign_id="<?php echo $oEvent->automation_event_id; ?>"><i class="fa fa-pie-chart"></i></button>
                                                        <?php endif; ?>
                                                        <button class="btn red" onclick="javascript:delete_email_automation_event('<?php echo $oEvent->automation_event_id; ?>');"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="panel green_bkg border-right-lg border-right-danger" id="statsDetaild_<?php echo $oEvent->automation_event_id; ?>">
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
                                                <div class="heading-elements"> <span class="heading-text">Created: <span class="text-semibold"><?php echo date("M d, Y h:i A", strtotime($oEvent->created)); ?> (<?php echo timeAgo($oEvent->created); ?>)</span></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /task -->
                                <div class="timeline-row post-full">
                                    <div class="timeline-icon"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="followup" class="circle_plus <?php echo ($bAnyEventExist == false || $bListAdded == false) ? 'validatecustlist' : 'addnewaction'; ?>" href="javascript:void(0);"><i class="icon-plus3 "></i></a> </div>
                                </div>
                            </div>


                            <?php
                        }
                    }
                }
                ?>
            </div>            
            <?php if ($bAnyEventExist == false): ?>            
                <div class="timeline-row post-full end">
                    <div class="timeline-icon"> <a previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="main" class="circle_plus <?php echo ($bAnyEventExist == false || $bListAdded == false) ? 'validatecustlist' : 'addnewaction'; ?>" href="javascript:void(0);"><i class="icon-plus3"></i></a> </div>
                </div>
            <?php endif; ?>            
            <!--            <div class="timeline-row post-full">
                                <div class="timeline-icon"> <a href="#"><img src="<?php echo $profileImg; ?>" alt=""></a> </div>
                        </div>-->
            <div class="timeline-date text-muted">
                <button class="btn btn-success"><i class="fa fa-shield"></i> &nbsp; GOAL: Billing Successful</button>
            </div>
        </div>
    </div>
    <div class="timeline-date endtimeline text-muted">
        <button class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp; End this automation </button>
    </div>

    <!-- /timeline --> 
</div>
<div class="col-md-12 text-right">
    <a href="javascript:void(0);" class="btn bl_cust_btn publishAutoEvent" automation_id="<?php echo $oEvents[0]->automation_id; ?>">
        Publish
        <i class=" icon-arrow-right13 text-size-base position-right"></i>
    </a>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/parsers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/editor_wysihtml5.js"></script>
<?php $this->load->view("/admin/modals/modules/email/workflow"); ?>


<script>
                                                $(document).ready(function () {

                                                    $('.insert_tag_button').on('click', function () {
                                                        var tagname = $(this).attr('data-tag-name');
                                                        var wysihtml5Editor = $('#campaignTempBody').data("wysihtml5").editor;
                                                        wysihtml5Editor.composer.commands.exec("insertHTML", tagname);
                                                        var getDesc = $("#campaignTempBody").data("wysihtml5").editor.getValue();
                                                        $("#tempBodyView").html(getDesc);
                                                    });

                                                    $(".chooselist").click(function () {
                                                        $("#chooselistModal").modal();
                                                    });
                                                    $(".chooseTrigger").click(function () {
                                                        $("#chooseEventModal").modal();
                                                    });
                                                    $('#frmSaveAutomationList').on('submit', function () {
                                                        $('.overlaynew').show();
                                                        var formdata = $("#frmSaveAutomationList").serialize();
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/updateAutomationLists'); ?>',
                                                            type: "POST",
                                                            data: formdata,
                                                            dataType: "json",
                                                            success: function (data) {
                                                                if (data.status == 'success') {
                                                                    $('.overlaynew').hide();
                                                                    window.location.href = window.location.href;
                                                                }

                                                            }
                                                        });
                                                        return false;
                                                    });

                                                    $('.publishAutoEvent').click(function () {
                                                        $('.overlaynew').show();
                                                        var automationID = $(this).attr('automation_id');
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/publishAutomationEvent'); ?>',
                                                            type: "POST",
                                                            data: {'automation_id': automationID},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                if (data.status == 'success') {
                                                                    $('.overlaynew').hide();
                                                                    window.location.href = '<?php echo base_url('admin/modules/emails'); ?>';
                                                                }
                                                            }
                                                        });
                                                    });

                                                    $('#frmSaveAutomationTrigger').on('submit', function () {
                                                        $('.overlaynew').show();
                                                        var formdata = $("#frmSaveAutomationTrigger").serialize();
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/updateAutomationTrigger'); ?>',
                                                            type: "POST",
                                                            data: formdata,
                                                            dataType: "json",
                                                            success: function (data) {
                                                                if (data.status == 'success') {
                                                                    $('.overlaynew').hide();
                                                                    window.location.href = window.location.href;
                                                                }

                                                            }
                                                        });
                                                        return false;
                                                    });

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

                                                    $('.waitTime').click(function () {
                                                        var eventID = $(this).attr('event_id');
                                                        var delayValue = $(this).attr('delay_value');
                                                        var delayUnit = $(this).attr('delay_unit');
                                                        var delayTime = $(this).attr('delay_time');
                                                        $('#waitTime').modal();
                                                        $('#event_id_val').val(eventID);
                                                        $('#delay_time_value').val(delayValue);
                                                        $('#delay_time_unit').val(delayUnit);
                                                        if (delayUnit == 'day' || delayUnit == 'week') {
                                                            $("#pl2").show();
                                                            $("#anytime-time-hours2").val(delayTime);
                                                        }
                                                    });

                                                    $(document).on("click", ".openTemplate", function () {
                                                        $('.overlaynew').show();
                                                        var templateId = $(this).attr('template_id');
                                                        var automationID = $("#action_automation_id").val();
                                                        var previousID = $("#action_previous_id").val();
                                                        var currentID = $("#action_current_id").val();
                                                        var event_type = $("#action_event_type").val();
                                                        var templateType = $(this).attr('template_type');
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/addAutomationFollowup'); ?>',
                                                            type: "POST",
                                                            data: {'template_id': templateId, 'automation_id': automationID, 'previous_event_id': previousID, 'current_event_id': currentID, 'event_type': event_type},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                $('.overlaynew').hide();
                                                                if (data.status == 'success') {
                                                                    $('#emailTempId').val(templateId);
                                                                    $('#campaignTempSubject').val(data.temp_subject);
                                                                    $('#emailTemplateSection').html(data.temp_content);
                                                                    $('#campaignIdVal').val(data.campaignId);
                                                                    if (templateType == 'email') {
                                                                        $('#campaignIdVal').val(data.campaignId);
                                                                        $('#template_modal').modal();
                                                                    } else if (templateType == 'sms') {
                                                                        $("#campaignEventID").val(data.campaignId);
                                                                        $('#sms_modal').modal();
                                                                    }
                                                                } else {
                                                                    alertMessage('Error: Some thing wrong!');
                                                                }
                                                            }
                                                            , error() {
                                                                $('.overlaynew').hide();
                                                                alertMessage('Error: Some thing wrong!');
                                                            }
                                                        });
                                                    });

                                                    $('#campaignTempGreeting').keyup(function () {
                                                        showContentInView('campaignTempGreeting', 'tempGreetingView');
                                                    });
                                                    $('#campaignTempIntroduction').keyup(function () {
                                                        showContentInView('campaignTempIntroduction', 'tempIntroductionView');
                                                    });
                                                    $('#campaignTempHeading').keyup(function () {
                                                        showContentInView('campaignTempHeading', 'tempHeadingView');
                                                    });

                                                    $('.wysihtml5-sandbox').contents().find('body').on('keyup', function (event) {
                                                        var getDesc = $("#campaignTempBody").data("wysihtml5").editor.getValue();
                                                        $("#tempBodyView").html(getDesc);
                                                    });

                                                    $('.openSmsTemplate').click(function () {
                                                        var templateId = $(this).attr('template_id');
                                                        $('#sms_modal').modal();
                                                    });

                                                    $('.eventTimeUpdate').on('submit', function (e) {
                                                        $('.overlaynew').show();
                                                        e.preventDefault();
                                                        var delayValue = $('#delay_time_value').val();
                                                        var delayUnit = $('#delay_time_unit').val();
                                                        var eventID = $('#event_id_val').val();
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/updateEmailAutomationEvent'); ?>',
                                                            type: "POST",
                                                            data: new FormData(this),
                                                            contentType: false,
                                                            cache: false,
                                                            processData: false,
                                                            dataType: "json",
                                                            success: function (data) {
                                                                $('.overlaynew').hide();
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
                                                        $('.overlaynew').show();
                                                        e.preventDefault();
                                                        var templateSubject = $("#campaignTempSubject").val();
                                                        var templateGreeting = $("#campaignTempGreeting").val();
                                                        var templateIntroduction = $("#campaignTempIntroduction").val();
                                                        var templateHeading = $("#campaignTempHeading").val();
                                                        var templateContent = $("#campaignTempBody").val();
                                                        var campaignHtmlTemp = $("#emailTemplateSection").html();
                                                        var templateId = $("#emailTempId").val();
                                                        var campaignId = $("#campaignIdVal").val();
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/updateEmailAutomationCampaign'); ?>',
                                                            type: "POST",
                                                            data: {template_subject: templateSubject, template_greeting: templateGreeting, template_introduction: templateIntroduction, template_heading: templateHeading, template_html_content: campaignHtmlTemp, template_content: templateContent, template_id: templateId, campaign_id: campaignId},
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
                                                        return false;
                                                    });

                                                    $('#updateSmsCampaign').on('click', function (e) {
                                                        $('.overlaynew').show();
                                                        e.preventDefault();
                                                        var templateContent = $("#smsTemplateContent").val();
                                                        var templateId = $("#emailTempId").val();
                                                        var campaignId = $("#campaignEventID").val();
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/updateEmailAutomationCampaign'); ?>',
                                                            type: "POST",
                                                            data: {template_content: templateContent, template_html_content: templateContent, template_id: templateId, campaign_id: campaignId},
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
                                                        return false;
                                                    });

                                                    $('#smsTemplateContent').keyup(function () {
                                                        if ($(this).val() == '') {
                                                            $('.smsbubble').hide();
                                                        } else {
                                                            $('.smsbubble').show();
                                                            $('.smsbubble').html($(this).val());
                                                        }
                                                    });

                                                    $(".addnewaction").click(function () {
                                                        var actionid = $(this).attr('previous_event_id');
                                                        var currentid = $(this).attr('current_event_id');
                                                        var eventtype = $(this).attr('event_type');
                                                        $("#action_previous_id").val(actionid);
                                                        $("#action_current_id").val(currentid);
                                                        $("#action_event_type").val(eventtype);
                                                        $("#addnewaction").modal();
                                                    });

                                                    $(".previewCampaign").click(function () {
                                                        $('.overlaynew').show();
                                                        var campaignId = $(this).attr('campaign_id');
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/getEmailAutmationCampaign'); ?>',
                                                            type: "POST",
                                                            data: {campaignId: campaignId},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                $('.overlaynew').hide();
                                                                if (data.status == 'success') {
                                                                    var dataVal = data.data;
                                                                    $('#previewtempGreetingView').html(dataVal.greeting);
                                                                    $("#previewtempIntroductionView").html(dataVal.introduction);
                                                                    $("#previewtempBodyView").html(data.content);
                                                                    $("#previewtempHeadingView").html(dataVal.heading);
                                                                    $('#preview_modal').modal();
                                                                } else {
                                                                    alertMessage('Error: Some thing wrong!');
                                                                }
                                                            }, error() {
                                                                $('.overlaynew').hide();
                                                                alertMessage('Error: Some thing wrong!');
                                                            }
                                                        });
                                                    });

                                                    $(".previewSMSCampaign").click(function () {
                                                        $('.overlaynew').show();
                                                        var campaignId = $(this).attr('campaign_id');
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/getEmailAutmationCampaign'); ?>',
                                                            type: "POST",
                                                            data: {campaignId: campaignId},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                $('.overlaynew').hide();
                                                                if (data.status == 'success') {
                                                                    var dataVal = data.data;
                                                                    $('#smspreivewcontent').html(data.content);
                                                                    $('#sms_preview_modal').modal();
                                                                } else {
                                                                    alertMessage('Error: Some thing wrong!');
                                                                }
                                                            }, error() {
                                                                $('.overlaynew').hide();
                                                                alertMessage('Error: Some thing wrong!');
                                                            }
                                                        });
                                                    });

                                                    $('.editSmsCampaign').click(function () {
                                                        $('.overlaynew').show();
                                                        var campaignId = $(this).attr('campaign_id');
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/getEmailAutmationCampaign'); ?>',
                                                            type: "POST",
                                                            data: {campaignId: campaignId},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                $('.overlaynew').hide();
                                                                if (data.status == 'success') {
                                                                    var dataVal = data.data;
                                                                    $('#smsTemplateContent').val(data.content);
                                                                    $("#smsTemplateContentPreview").html(data.content);
                                                                    $('#campaignEventID').val(campaignId);
                                                                    $('#sms_modal').modal();
                                                                } else {
                                                                    alertMessage('Error: Some thing wrong!');
                                                                }
                                                            }, error() {
                                                                $('.overlaynew').hide();
                                                                alertMessage('Error: Some thing wrong!');
                                                            }
                                                        });
                                                    });

                                                    $('.editcampaign').click(function () {
                                                        $('.overlaynew').show();
                                                        var campaignId = $(this).attr('campaign_id');
                                                        $.ajax({
                                                            url: '<?php echo base_url('admin/modules/emails/getEmailAutmationCampaign'); ?>',
                                                            type: "POST",
                                                            data: {campaignId: campaignId},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                $('.overlaynew').hide();
                                                                if (data.status == 'success') {
                                                                    var dataVal = data.data;
                                                                    $('#emailTempId').val(dataVal.template_source);
                                                                    $('#campaignTempSubject').val(dataVal.subject);
                                                                    $('#campaignTempBody').data("wysihtml5").editor.setValue(data.description);
                                                                    $("#emailTemplateSection").html(data.content);
                                                                    $('#campaignTempHeading').val(dataVal.heading);
                                                                    $('#campaignTempGreeting').val(dataVal.greeting);
                                                                    $("#campaignTempIntroduction").val(dataVal.introduction);
                                                                    $('#campaignIdVal').val(campaignId);
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
                                                });

                                                function delete_email_automation_event($eventID) {
                                                    swal({
                                                        title: "Are you sure? You want to delete this campaign!",
                                                        text: "You will not be able to recover this campaign!",
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
                                                                    $.ajax({
                                                                        url: '<?php echo base_url('admin/modules/emails/delete_event'); ?>',
                                                                        type: "POST",
                                                                        data: {'event_id': $eventID},
                                                                        dataType: "json",
                                                                        success: function (data) {
                                                                            //console.log(data);
                                                                            if (data.status == 'success') {
                                                                                setTimeout(function () {
                                                                                    window.location.href = window.location.href;
                                                                                }, 1000);
                                                                            } else {
                                                                                alertMessage('Error: Some thing wrong!');
                                                                                setTimeout(function () {
                                                                                    window.location.href = window.location.href;
                                                                                }, 1000);
                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                }

                                                function showContentInView(inputFieldID, viewSectionID) {
                                                    $('#' + viewSectionID).html($('#' + inputFieldID).val());
                                                }


                                                //$(init);
                                                function init() {
                                                    $(".droppable-area").sortable({
                                                        connectWith: ".connected-sortable",
                                                        containment: ".droppable-area",
                                                        stack: '.connected-sortable div',
                                                        activate: function (event, ui) {
                                                            $('.draggable-item').css('box-shadow', '0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055)');
                                                            var currentEventID = ui.item.attr('event_id');
                                                            var previousEventID = ui.item.prev().attr('event_id');
                                                            var nextEventID = ui.item.next().next().attr('event_id');

                                                            var currentItemOrder = ui.item.attr('item_order');
                                                            var previousItemOrder = ui.item.prev().attr('item_order');
                                                            var nextItemOrder = ui.item.next().attr('item_order');

                                                            //alert(currentItemOrder);

                                                            orderAutomationEvent(previousEventID, currentEventID, nextEventID, 'detach');
                                                        },
                                                        deactivate: function (event, ui) {
                                                            $('.draggable-item').css('box-shadow', 'none');
                                                            var currentEventID = ui.item.attr('event_id');
                                                            var previousEventID = ui.item.prev().attr('event_id');
                                                            var nextEventID = ui.item.next().attr('event_id');

                                                            $('.draggable-item').each(function (index) {
                                                                $(this).find('.itemOrder').html(index + 1);
                                                            });

                                                            orderAutomationEvent(previousEventID, currentEventID, nextEventID, 'attach');
                                                        }
                                                    }).disableSelection();
                                                }

                                                function orderAutomationEvent(prevID, currentID, nextID, actionName) {
                                                    $.ajax({
                                                        url: '<?php echo base_url('admin/modules/emails/updateEventOrder'); ?>',
                                                        type: "POST",
                                                        data: {'previous_id': prevID, 'current_id': currentID, 'next_id': nextID, 'action_name': actionName},
                                                        dataType: "json",
                                                        success: function (data) {
                                                            if (data.status == 'success') {

                                                            } else {
                                                                alertMessage('Error: Some thing wrong!');
                                                            }
                                                        }, error() {
                                                            alertMessage('Error: Some thing wrong!');
                                                        }
                                                    });
                                                }


                                                $(document).ready(function () {
                                                    $("#anytime-time-hours1, #anytime-time-hours2, #anytime-time-hours3, #anytime-time-hours4").AnyTime_picker({
                                                        format: "%l %p"
                                                    });
                                                    $(".selectbox").change(function () {

                                                        var ctrID = $(this).attr('control_id');
                                                        if ($(this).val() == 'day' || $(this).val() == 'week') {
                                                            $("#" + ctrID).show();
                                                        } else {
                                                            $("#" + ctrID).hide();
                                                        }
                                                    });
                                                    $('.daterange-single').daterangepicker({
                                                        singleDatePicker: true
                                                    });
                                                    $("input[name='triggerName']").change(function () {
                                                        var selectedOption = $(this).val();
                                                        if (selectedOption == 'specific-datetime') {
                                                            $("#specific-datetime").show();
                                                            $(".ConditionsWorkflow").hide();
                                                        } else {
                                                            $("#specific-datetime").hide();
                                                            $(".ConditionsWorkflow").show();
                                                        }
                                                    });

                                                    $(".validatecustlist").click(function () {
                                                        alertMessage("Please complete above step first");
                                                    });
                                                });





</script>


</body>
</html>

