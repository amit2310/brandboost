<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/touchspin.min.js"></script>
<style>
    .mb55{
        margin-bottom: 55px;
    }
    #chooseEmailTemplate{ display:none;}
    #chooseSMSTemplate{display: none;}
    #templateParentContainer{display:none;}
    .workflow_main_box .input-group.bootstrap-touchspin {bottom: 20px;right: 30px; z-index:99;}
</style>
<?php
list($canReadCon, $canWriteCon) = fetchPermissions('Contacts');
list($canReadAna, $canWriteAna) = fetchPermissions('Analytics');
$bAnyMainEventExist = false;
$oFinal = array();

//In order to maintain order of the events
if (!empty($oEvents)) {
    $oFinal[] = $oEvents[0];
    $eventID = $oEvents[0]->id;
    foreach ($oEvents as $key => $value) {
        foreach ($oEvents as $inner) {
            if ($inner->previous_event_id == $eventID) {
                $oFinal[] = $inner;
                $eventID = $inner->id;
                break;
            }
        }
    }
}

$oEvents = $oFinal;

if (!empty($oEvents)) {
    foreach ($oEvents as $oEvent) {
        if (empty($oEvent->previous_event_id)) {
            $oMainEvent = $oEvent;
            break;
        }
    }
}

if (empty($moduleName)) {
    echo "Module is missing";
    exit;
}

//Get Overall Stats
$aEmailStats = App\Models\Admin\WorkflowModel::getModuleUnitSendgridStats($moduleUnitID, $moduleName);
if (!empty($aEmailStats)) {

    $aCategorizedEmailStats = App\Models\Admin\WorkflowModel::getEventSendgridCategorizedStats($aEmailStats);

    $aCategorizedEmailStats24Hours = App\Models\Admin\WorkflowModel::getEventSendgridCategorizedStats($aEmailStats, true);
}



$aCampaignStats = array(
    'aEmailStats' => $aEmailStats,
    'aEmailStatsCategorized' => $aCategorizedEmailStats,
    'aCategorizedEmailStats24Hours' => $aCategorizedEmailStats24Hours
);

//get Twilio Account Details

$oUser = getLoggedUser();
$userID = $oUser->id;
if ($userID > 0) {
    $oTwilioAc = getClientTwilioAccount($userID);
}

$aContactSelectionData = App\Models\Admin\WorkflowModel::getWorkflowContactSelectionInterfaceData($moduleName, $moduleUnitID);
$iActiveCount = $iArchiveCount = 0;
$aSelectedContacts = $aContactSelectionData['oCampaignSubscribers'];
$iActiveSelectedCount = 0;
if (!empty($aSelectedContacts)) {
    foreach ($aSelectedContacts as $oCount) {
        if ($oCount->status == 2) {
            $iArchiveSelectedCount++;
        } else {
            $iActiveSelectedCount++;
        }
    }
}
$aSelectedContacts = array();
?>
<div class="">
    <div class="row">
        <!-- Draw graph  -->
        <?php //$this->load->view("admin/workflow/partials/workflow-graph.php", $aCampaignStats);    ?>
    </div>

    <div class="row" id="superContainer">
        <div class="col-md-9">
            <div class="panel panel-flat workflow_main_box">
                <div style="border-bottom: 1px solid #eee!important;" class="panel-heading bkg_grey_light">
                    <h6 class="panel-title">Workflow</h6>

                </div>
                <div class="panel-body p40 pb20 min_h290 email_workflow_sec new" style="height:1000px;overflow:auto;" >
                    <a id="wf_fs" class="workflow_fs_icon"><img src="<?php echo base_url(); ?>assets/images/fs_icon.png"/></a>


                    <!-- Timeline -->
                    <div class="timeline timeline-center">
                        <div class="timeline-container">
                            <div class="timeline-zoomable">

                                <!-- Sales stats -->
                                <div class="timeline-row post-full">




                                    <div class="timeline-date button">

                                        <button type="button" class="btn white_btn chooseContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><span class="txt_grey"></span> New Contact 

                                        </button>
                                        <a class="icons iconsab blue br8 t30 chooseContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" href="javascript:void(0);" ><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"></a>
                                    </div>


                                    <?php
                                    if (!empty($oMainEvent)):
                                        $previousID = $oMainEvent->previous_event_id;
                                        $currentID = $oMainEvent->id;
                                        $bAnyMainEventExist = true;
                                        ?>

                                        <div class="timeline-date button mt20 mb40">
                                            <button class="btn btn-xs btn_white_table smallbtn rounded dropdown-toggle" data-toggle="dropdown"><i class="icon-plus3"></i></button>
                                            @include('admin.workflow2.partials.action-dropdown', ['previousID' => $previousID, 'currentID' => $currentID, 'oEventsType' => $oEventsType, 'nodeType' => 'main', 'eventType' => $oEventsType[0]])
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $previousEventID = 0;
                                    $eventNo = 1;
                                    $subscribersData = App\Models\Admin\WorkflowModel::getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
                                    $bBranchDrawn = false;
                                    if (!empty($oEvents)) {
                                        foreach ($oEvents as $key => $oEvent) {
                                            $bMulitpleBranches = false;
                                            $finishBranch = false;
                                            if ($bBranchDrawn == true) {
                                                $finishBranch = true;
                                            }

                                            $aEventData = json_decode($oEvent->data);
                                            if (isset($oEvents[$key + 1])) {
                                                $oEventDataNext = json_decode($oEvents[$key + 1]->data);
                                            }


                                            if (!empty($oEventDataNext)) {
                                                if ($oEventDataNext->delay_value == 0 && $oEventDataNext->delay_unit == 'minute') {
                                                    $bMulitpleBranches = true;
                                                }
                                            }

                                            $oCampaignData = App\Models\Admin\WorkflowModel::getEventCampaign($oEvent->id, $moduleName);
                                            $oCampaign = !empty($oCampaignData[0]) ?  $oCampaignData[0] : '';
                                            
                                            if(empty($oCampaign)){
                                                $oCampaign = new stdClass();
                                                $oCampaign->id = '';
                                                
                                            }

                                            //$oCampaign = $oCampaignData[0];
                                            //pre($oCampaign);
                                           
                                            $isSMSAdded = $isEmailAdded = false;
                                            $previousID = $oEvent->previous_event_id;
                                            $currentID = $oEvent->id;
                                            $currentEventType = $oEvent->event_type;
                                            $currentEventIndex = array_keys($oEventsType, $currentEventType);
                                            if (array_key_exists($currentEventIndex[0] + 1, $oEventsType)) {
                                                $nextEventType = $oEventsType[$currentEventIndex[0] + 1];
                                            } else {
                                                $nextEventType = $currentEventType;
                                            }

                                            if ($oCampaign->id != '') {

                                                $aStatsSms = App\Models\Admin\WorkflowModel::getEventTwilioStats($oCampaign->id, $moduleName);
                                                $aCategorizedStatsSms = App\Models\Admin\WorkflowModel::getEventTwilioCategorizedStats($aStatsSms);

                                                $sentSmsCount = $aCategorizedStatsSms['sent']['UniqueCount'];
                                                $deliveredSmsCount = $aCategorizedStatsSms['delivered']['UniqueCount'];
                                                $acceptedSmsCount = $aCategorizedStatsSms['accepted']['UniqueCount'];
                                                $failedSmsCount = $aCategorizedStatsSms['failed']['UniqueCount'];
                                                $queuedSmsCount = $aCategorizedStatsSms['queued']['UniqueCount'];

                                                $sentSms = $sentSmsCount == '' ? '0' : $sentSmsCount;
                                                $deliveredSms = $deliveredSmsCount == '' ? '0' : $deliveredSmsCount;
                                                $acceptedSms = $acceptedSmsCount == '' ? '0' : $acceptedSmsCount;
                                                $failedSms = $failedSmsCount == '' ? '0' : $failedSmsCount;
                                                $queuedSms = $queuedSmsCount == '' ? '0' : $queuedSmsCount;

                                                if (strtolower($oCampaign->campaign_type) == 'email') {
                                                    $sNodeType = 'email';
                                                    $isSMSAdded = true;
                                                    $aStats = App\Models\Admin\WorkflowModel::getEventSendgridStats($oCampaign->id, $moduleName);
                                                    $aCategorizedStats = App\Models\Admin\WorkflowModel::getEventSendgridCategorizedStats($aStats);

                                                    $processedCount = $aCategorizedStats['processed']['UniqueCount'];
                                                    $deliveredCount = $aCategorizedStats['delivered']['UniqueCount'];
                                                    $openCount = $aCategorizedStats['open']['UniqueCount'];
                                                    $clickCount = $aCategorizedStats['click']['UniqueCount'];
                                                    $unsubscribeCount = $aCategorizedStats['unsubscribe']['UniqueCount'];
                                                    $bounceCount = $aCategorizedStats['bounce']['UniqueCount'];
                                                    $droppedCount = $aCategorizedStats['dropped']['UniqueCount'];
                                                    $spamReportCount = $aCategorizedStats['spam_report']['UniqueCount'];

                                                    $processed = $processedCount == '' ? '0' : $processedCount;
                                                    $delivered = $deliveredCount == '' ? '0' : $deliveredCount;
                                                    $open = $openCount == '' ? '0' : $openCount;
                                                    $click = $clickCount == '' ? '0' : $clickCount;
                                                    $unsubscribe = $unsubscribeCount == '' ? '0' : $unsubscribeCount;
                                                    $bounce = $bounceCount == '' ? '0' : $bounceCount;
                                                    $dropped = $droppedCount == '' ? '0' : $droppedCount;
                                                    $spamReport = $spamReportCount == '' ? '0' : $spamReportCount;

                                                    $aNodeData = array(
                                                        'oEvent' => $oEvent,
                                                        'oCampaign' => $oCampaign,
                                                        'moduleName' => $moduleName,
                                                        'subscribersData' => $subscribersData,
                                                        'eventNo' => $eventNo,
                                                        'oTwilioAc' => $oTwilioAc,
                                                        'processed' => $processed,
                                                        'delivered' => $delivered,
                                                        'bMulitpleBranches' => $bMulitpleBranches,
                                                        'bBranchDrawn' => $bBranchDrawn,
                                                        'open' => $open,
                                                        'click' => $click,
                                                        'bounce' => $bounce,
                                                        'dropped' => $dropped,
                                                        'unsubscribe' => $unsubscribe,
                                                        'spamReport' => $spamReport,
                                                        'iActiveSelectedCount' => $iActiveSelectedCount
                                                    );
                                                } else if (strtolower($oCampaign->campaign_type) == 'sms') {
                                                    $sNodeType = 'sms';
                                                    $aNodeData = array(
                                                        'oEvent' => $oEvent,
                                                        'oCampaign' => $oCampaign,
                                                        'moduleName' => $moduleName,
                                                        'subscribersData' => $subscribersData,
                                                        'bMulitpleBranches' => $bMulitpleBranches,
                                                        'bBranchDrawn' => $bBranchDrawn,
                                                        'eventNo' => $eventNo,
                                                        'oTwilioAc' => $oTwilioAc,
                                                        'sentSms' => $sentSms,
                                                        'deliveredSms' => $deliveredSms,
                                                        'failedSms' => $failedSms,
                                                        'queuedSms' => $queuedSms,
                                                        'acceptedSms' => $acceptedSms,
                                                        'sentSms' => $sentSms,
                                                        'iActiveSelectedCount' => $iActiveSelectedCount
                                                    );
                                                }
                                                ?>

                                                <?php if ($bBranchDrawn == false) { ?>
                                                    <div class="timeline-date button">
                                                        <button type="button" class="btn white_btn wf_timer" id="wf_waitTime_<?php echo $oEvent->id; ?>" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>"><span class="txt_grey">Wait for</span> <?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?> <?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?></button>
                                                        <a class="icons iconsab br8 dark t30 wf_timer" id="wf_waitTime_<?php echo $oEvent->id; ?>" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>"  href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/clock_white14.png"></a>
                                                    </div>

                                                    <?php if ($bMulitpleBranches == true): ?>
                                                        <div class="timeline-date button mb0">
                                                            <img src="<?php echo base_url(); ?>assets/images/timeline_top_border_grey.jpg"/>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php } ?>


                                                <?php if ($bBranchDrawn == false): ?>
                                                    <div class="timeline-content mb0">
                                                        <div class="<?php if ($bMulitpleBranches == true): ?>bkg_image<?php endif; ?> pt0 pb0">
                                                            <div class="row">
                                                            <?php endif; ?>
                                                            <?php if ($sNodeType == 'sms'): ?>
                                                                <!-- Draw Tree Node -->
                                                                @include('admin.workflow2.partials.sms_node', $aNodeData)

                                                            <?php elseif ($sNodeType == 'email'): ?>
                                                                <!-- Draw Tree Node -->
                                                                @include('admin.workflow2.partials.email_node', $aNodeData)
                                                            <?php endif; ?>
                                                            <?php if ($bMulitpleBranches == false): ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>


                                                <?php if ($finishBranch == true): ?>
                                                    <div class="timeline-date button mb0">
                                                        <img src="<?php echo base_url(); ?>assets/images/timeline_bot_border_grey.png"/>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($bMulitpleBranches == false): ?>
                                                    <div class="timeline-date button mt20 mb40">
                                                        <button class="btn btn-xs btn_white_table smallbtn rounded dropdown-toggle" data-toggle="dropdown" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" data-node-type="followup"><i class="icon-plus3"></i></button>
                                                        @include('admin.workflow2.partials.action-dropdown', ['previousID' => $previousID, 'currentID' => $currentID, 'oEventsType' => $oEventsType, 'nodeType' => 'followup', 'eventType' => $nextEventType])
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                $previousEventID = $oEvent->id;
                                                $eventNo++;

                                                if ($bMulitpleBranches == true) {
                                                    $bBranchDrawn = true;
                                                } else {
                                                    $bBranchDrawn = false;
                                                }
                                            }
                                        }
                                    }

                                    $previousID = (!empty($previousID)) ? $previousID : '';
                                    $currentID = (!empty($currentID)) ? $currentID : '';
                                    $nextEventType = (!empty($nextEventType)) ? $nextEventType : '';
                                    if (empty($oEvent)) {
                                        $oEvent = new stdClass();
                                        $oEvent->id = '';
                                    }
                                    if(empty($aEventData)){
                                        $aEventData = new stdClass();
                                        $aEventData->delay_value = '';
                                        $aEventData->delay_unit = '';
                                        $aEventData->delay_unit = '';
                                    }
                                    ?>

                                    <?php if ($bAnyMainEventExist == false): ?> 
                                        <div class="timeline-date button mt0 mb20">
                                            <button class="btn btn-xs btn_white_table smallbtn rounded dropdown-toggle" data-toggle="dropdown"><i class="icon-plus3"></i></button>
                                            @include('admin.workflow2.partials.action-dropdown', ['previousID' => $previousID, 'currentID' => $currentID, 'oEventsType' => $oEventsType, 'nodeType' => 'main', 'eventType' => $oEventsType[0]])
                                        </div>
                                    <?php endif; ?>

                                    <div  class="timeline-date button mt30 mb0">
                                        <button type="button" class="btn white_btn"><span class="txt_grey"></span>&nbsp;Success </button>
                                        <a class="icons iconsab green2 br8 t30" href="#"><img src="<?php echo base_url(); ?>assets/images/green_check_round.png"></a>
                                    </div>



                                </div>
                                <!-- /sales stats -->
                            </div>


                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix text-right">

                            <!--------Back ------>        
                            <!--                            <div class="workflow_back">
                                                            <div class="input-group">
                                                                <span class="input-group-btn">	
                                                                    <button class="btn btn-default btn-icon" type="button"><i class=""><img src="<?php echo base_url(); ?>assets/images/back_tek_icon_grey.png"/></i></button>
                                                                </span>
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default btn-icon" type="button"><i class=""><img src="<?php echo base_url(); ?>assets/images/back_icon_grey.png"/></i></button>
                                                                </span>
                                                            </div>
                                                        </div>-->
                        </div>



                        <!--------Back ------>  


                    </div>
                    <!-- /timeline -->

                    <div id="templateParentContainer">
                        @include('admin.templates.emails.email-template-index', ["campaign_type" => 'email'])
                        @include('admin.templates.sms.sms-template-index', ["campaign_type" => 'sms'])
                        <div class="text-right" style="margin:0 50px 50px 50px;padding-bottom:100px;">
                            <input type="hidden" name="action_email_template_id" id="wf_act_email_template_id" />
                            <input type="hidden" name="action_sms_template_id" id="wf_act_sms_template_id" />
                            <input type="hidden" name="action_template_type" id="wf_act_template_type" />
                            <input type="hidden" name="action_previous_id" id="wf_act_prev_id" />
                            <input type="hidden" name="action_current_id" id="wf_act_curr_id" />
                            <input type="hidden" name="action_event_type" id="wf_act_event_type" />
                            <input type="hidden" name="action_node_type" id="wf_act_node_type" />
                            <input type="hidden" name="moduleName" id="wf_act_moduleName" value="<?php echo $moduleName; ?>" />
                            <input type="hidden" name="moduleUnitID" id="wf_act_module_unit_id" value="<?php echo $moduleUnitID; ?>" />
                            <a href="javascript:void(0);" class="btn btn-info mt10" id="cancelAddNewEvent">
                                Cancel
                                <i class=" icon-arrow-right13 text-size-base position-right"></i>
                            </a>

                            <a href="javascript:void(0);" class="btn dark_btn mt10 ml10" id="createNewWorkflowEventNode">
                                Save
                                <i class=" icon-arrow-right13 text-size-base position-right"></i>
                            </a>
                        </div>
                    </div>    
                    <div class="workflow_option hide" id="wfMainRightMenuZoomContainer">
                        <ul>
                            <li><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/wf_opt_icon1.png"/></a>
                                <ul class="dropdown-menu dropdown-menu-right wf_dropdown action_box_new nodes">
                                    <div class="profile_headings m0 mb10">TRIGGERS </div>
                                    <li><a href="javascript:void(0);" class="chooseContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><span class="icons br8 grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"></span>New Contacts </a></li>
                                    <li><a href="#"><span class="icons br8 grd_bkg_green2"><img src="<?php echo base_url(); ?>assets/images/menu_icons/List_Light.svg"></span>Form Submitted </a></li>
                                    <li><a href="javascript:void(0);" <?php if ($oEvent->id > 0): ?>class="wf_timer"<?php endif; ?> style="cursor:pointer;" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>"><span class="icons br8 grd_bkg_purple"><img src="<?php echo base_url(); ?>assets/images/clock_white14.png"></span>Time Trigger </a></li>
                                    <div class="clearfix"></div>
                                </ul>

                            </li>
                            <li><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/wf_opt_icon2.png"/></a>
                                <ul class="dropdown-menu dropdown-menu-right wf_dropdown action_box_new nodes">
                                    <div class="profile_headings m0 mb10">ACTIONS </div>
                                    <li><a href="#"><span class="icons grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"></span>Add to list </a></li>
                                    <li><a href="#accordion-control-group2" data-toggle="collapse" data-parent="#accordion-control" data-tab-type="email" class="addWorkflowNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" <?php if ($oEvent->id > 0): ?>data-node-type="followup"<?php else: ?>data-node-type="main"<?php endif; ?>><span class="icons grd_bkg_green2"><img src="<?php echo base_url(); ?>assets/images/menu_icons/Email_Light.svg"></span>Send email </a></li>
                                    <li><a href="#accordion-control-group3" data-toggle="collapse" data-parent="#accordion-control" data-tab-type="sms" class="addWorkflowNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" <?php if ($oEvent->id > 0): ?>data-node-type="followup"<?php else: ?>data-node-type="main"<?php endif; ?>><span class="icons grd_bkg_green"><img style="width: 12px;" src="<?php echo base_url(); ?>assets/images/menu_icons/BrandPage_Light.svg"></span>Send sms </a></li>
                                    <li><a href="#"><span class="icons grd_bkg_green2"><i class="icon-bell2"></i></span>Send notification </a></li>
                                    <li><a href="#"><span class="icons grd_bkg_red"><img src="<?php echo base_url(); ?>assets/images/menu_icons/Website_Light.svg"></span>Show site widget </a></li>
                                    <div class="clearfix"></div>
                                </ul>
                            </li>
                            <li><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/wf_opt_icon3.png"/></a>
                                <ul class="dropdown-menu dropdown-menu-right wf_dropdown action_box_new nodes">
                                    <div class="profile_headings m0 mb10">RULES </div>
                                    <li><a href="#"><span class="icons grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/List_Light.svg"></span>Field </a></li>
                                    <li><a href="#"><span class="icons grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/Tags_Light.svg"></span>Tag </a></li>
                                    <div class="clearfix"></div>
                                </ul>
                            </li>
                            <li><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/wf_opt_icon4.png"/></a>
                                <ul class="dropdown-menu dropdown-menu-right wf_dropdown action_box_new nodes">
                                    <div class="profile_headings m0 mb10">FLOW </div>
                                    <li><a href="#"><span class="icons grd_bkg_purple"><img src="<?php echo base_url(); ?>assets/images/split_icon.png"></span>Split </a></li>
                                    <div class="clearfix"></div>
                                </ul>
                            </li>
                            <li><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/wf_opt_icon5.png"/></a>
                                <ul class="dropdown-menu dropdown-menu-right wf_dropdown action_box_new nodes">
                                    <div class="profile_headings m0 mb10">FLOW </div>
                                    <li><a href="#"><span class="icons br8 grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"></span>Contacts 2 </a></li>
                                    <li><a href="#"><span class="icons br8 grd_bkg_green2"><img src="<?php echo base_url(); ?>assets/images/menu_icons/List_Light.svg"></span>Form 2</a></li>
                                    <li><a href="#"><span class="icons br8 grd_bkg_purple"><img src="<?php echo base_url(); ?>assets/images/clock_white14.png"></span>Time 2</a></li>
                                    <div class="clearfix"></div>
                                </ul>
                            </li>
                        </ul>
                    </div>


                </div>

                <!--------zoom ------>
                <input type="text" value="100" readonly="readonly" class="touchspin-postfix" style="min-width:50px!important;"> 



            </div>

        </div>
        <div class="col-md-3" id="sidebar_statc">

            @include('admin.workflow2.partials.main-right-menu', ['aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType])

            @include('admin.workflow2.partials.email-menu', ['aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType])

            @include('admin.workflow2.partials.sms-menu', ['aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType])

            @include('admin.workflow2.partials.timer-menu', ['aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType])

            <!-- choose contact -->
            @include('admin.workflow2.partials.choose-contacts', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.import-options', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.exclude-options', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.filtered-contacts', ['aContactSelectionData' => $aContactSelectionData])


            @include('admin.workflow2.partials.import/im-contacts', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.import/im-lists', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.import/im-tags', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.import/im-segments', ['aContactSelectionData' => $aContactSelectionData])


            @include('admin.workflow2.partials.exclude/ex-contacts', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.exclude/ex-lists', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.exclude/ex-tags', ['aContactSelectionData' => $aContactSelectionData])

            @include('admin.workflow2.partials.exclude/ex-segments', ['aContactSelectionData' => $aContactSelectionData])








        </div>

    </div>


    <div class="row" id="editTemplateContainer" style="display:none;">
        <div class="col-md-12">
            <div class="white_box mb20 p10">
                <iframe src="" id="loadstripotemplateInline" width="100%" height="1800" scrolling="no" style="border:none !important;overflow:hidden;"></iframe>
            </div>
        </div>

    </div>



</div>

<div id="nameyourtemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="updateDraftTemplateName" id="updateDraftTemplateName" action="javascript:void();">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;Name your template <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Please Enter Title For the Template:</label>
                                <input class="form-control" id="templateName" name="templateName" placeholder="Enter Title for the Template" type="text" required>
                                <label style="color:#ff0000;font-size:12px;display:none;" id="templateNameErrorMsg">This template name already exists</label>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="template_draft_id" id="template_draft_id">
                    <input type="hidden" value="<?php echo $moduleName; ?>" name="moduleName">
                    <button type="submit" class="btn dark_btn bkg_sblue fsize14">Save</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div id="wfSendTestEmail" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;Send Test Email <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="form-control" id="wfTextPopupSendTestEmail" placeholder="Email" type="text" required>                          

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="wf_test_email_campaign_id" />
                <button type="button" id="wfBtnPopupSendTestEmail" class="btn dark_btn bkg_sblue fsize14">Send Email</button>
            </div>

        </div>
    </div>
</div>


<div id="wfSendTestSMS" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Sms_Color.svg"/> &nbsp;Send Test SMS <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" id="wfTextPopupSendTestSMS" placeholder="Phone Number" type="text" value="<?php echo $oUser->mobile; ?>" required>                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="wf_test_sms_campaign_id" />
                <button type="button" id="wfBtnPopupSendTestSMS" class="btn dark_btn bkg_sblue fsize14">Send SMS</button>
            </div>

        </div>
    </div>
</div>

<div id="emaileditorinfo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;How to use this editor <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <b>Brandboost Email Builder</b> We will revert back to you very soon with detailed document and help videos
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark_btn bkg_sblue fsize14">Close</button>
            </div>

        </div>
    </div>
</div>

<div id="smseditorinfo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Sms_Color.svg"/> &nbsp;How to use this sms editor <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <b>Brandboost SMS Editor</b> We will revert back to you very soon with detailed document and help videos
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark_btn bkg_sblue fsize14">Close</button>
            </div>

        </div>
    </div>
</div>



@include('admin.modals.segments.segments-popup')
<script src="<?php echo base_url(); ?>assets/js/modules/segments/segments.js" type="text/javascript"></script>
<script>
var site_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/modules/workflow2/workflow.js" type="text/javascript"></script>
<script type="text/javascript" >
history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};
</script>

<script>



    function loadImportedProperties() {
        $('.overlaynew').show();
        var moduleName = '<?php echo $moduleName; ?>';
        var moduleUnitID = '<?php echo $moduleUnitID; ?>';
        $.ajax({
            url: '<?php echo base_url('admin/workflow/getWorkflowImportedProperties'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    $("#importPropertyButtons").html(data.content);
                }
            }
        });
    }

    function loadExcludedProperties() {
        $('.overlaynew').show();
        var moduleName = '<?php echo $moduleName; ?>';
        var moduleUnitID = '<?php echo $moduleUnitID; ?>';
        $.ajax({
            url: '<?php echo base_url('admin/workflow/getWorkflowExportedProperties'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    $("#excludePropertyButtons").html(data.content);
                }
            }
        });
    }

    function syncAudience() {
        var moduleName = '<?php echo $moduleName; ?>';
        var moduleUnitID = '<?php echo $moduleUnitID; ?>';
        $.ajax({
            url: '<?php echo base_url('admin/workflow/syncWorkflowAudience'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#liveWorkflowAudience").html(data.content);
                    $("#totalLiveWorkflowAudience").text(data.total_audience + ' Contacts');
                    $(".totalselcontacts").text(data.total_audience + ' Contacts Added');
                    //$("#tblBroadcastTemplate").dataTable().destroy();
                    var tableId = 'workflowFilteredAudience';
                    custom_data_table(tableId);
                }
            }
        });
    }
    $(document).ready(function () {
        $(document).on('change', ".addToCampaign", function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            var contactId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }

            $.ajax({
                url: '<?php echo base_url('admin/workflow/addContactToWorkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, contactId: contactId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalContactCount").text(data.total_contacts);
                        $('.overlaynew').hide();
                        loadImportedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });


        $(document).on('change', '.addListToCampaign', function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            var listID = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/workflow/addListToWorkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, selectedLists: listID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalListCount").text(data.total_lists);
                        $("#totalListContactCount").text(data.total_contacts);
                        $("#totalListDuplicateCount").text(data.duplicate_contacts);
                        $('.overlaynew').hide();
                        loadImportedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;
        });


        $(document).on('change', ".addSegmentToCampaign", function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';

            var segmentId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/workflow/addSegmentToWorkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, segmentId: segmentId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalSegmentCount").text(data.total_segments);
                        $('.overlaynew').hide();
                        loadImportedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });


        $(document).on('change', ".addTagToCampaign", function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            var tagId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/workflow/addTagToWorkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, tagId: tagId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalTagCount").text(data.total_tags);
                        $('.overlaynew').hide();
                        loadImportedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });

        $(document).on('change', ".addToExcludeCampaign", function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            var contactId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            var listID = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/workflow/addContactToExcludeWorkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, contactId: contactId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalExcludeContactCount").text(data.total_contacts);
                        $('.overlaynew').hide();
                        loadExcludedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });

        $(document).on('change', '.addListToExcludeCampaign', function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            var listID = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/workflow/updateAutomationListsExcludedRecord'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, selectedLists: listID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalExcludeListCount").text(data.total_lists);
                        $("#totalExcludeListContactCount").text(data.total_contacts);
                        $("#totalListDuplicateCount").text(data.duplicate_contacts);
                        $('.overlaynew').hide();
                        loadExcludedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;
        });

        $(document).on('change', ".addExcludeSegmentToCampaign", function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            var segmentId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/workflow/addExcludeSegmentToWorkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, segmentId: segmentId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalExcludeSegmentCount").text(data.total_segments);
                        $('.overlaynew').hide();
                        loadExcludedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });

        $(document).on('change', ".addExcludedTagToCampaign", function () {
            $('.overlaynew').show();
            var moduleName = '<?php echo $moduleName; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            var tagId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/workflow/addExcludedTagToWorkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, actionValue: actionValue, tagId: tagId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalExcludeTagCount").text(data.total_tags);
                        $('.overlaynew').hide();
                        loadExcludedProperties();
                        syncAudience();
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });

        $(document).on("click", ".rmtag", function () {
            alert('clicked');
        });


        $(document).on("submit", "#updateDraftTemplateName", function () {
            var formData = new FormData($(this)[0]);
            window.parent.$('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/workflow/updateWorkflowDraft'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        //alert('Saved changes successfully');
                        displayMessagePopup("success", "Success", "Draft saved successfully!");
                        $("#nameyourtemplate").modal('hide');
                    } else if (data.status == 'error' && data.msg == 'duplicate') {
                        $("#templateNameErrorMsg").show();
                        return false;
                    } else {
                        $('.overlaynew').hide();
                        alert('Error: Some thing wrong!');
                    }
                }

            });
        });
    });
</script>
<script>






    function zoom_page(step)
    {
        var zoomscale = $(".touchspin-postfix").val();
//        $(".email_workflow_sec").css('height', '1000px');
//        $(".email_workflow_sec").css('overflow', 'auto');
        $('.timeline-zoomable').css('-moz-transform', 'scale(' + zoomscale / 10 + ',' + zoomscale / 10 + ')');
        $('.timeline-zoomable').css('zoom', zoomscale / 10);
        $('.timeline-zoomable').css('zoom', zoomscale + '%');

    }

// top navigation fixed on scroll and side bar collasped
    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });
    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();
        window.onresize = function () {
            smallMenu();
        };
    });
    $(window).scroll(function () {
        var sc22 = $(window).scrollTop();
        if (sc22 > 100) {
            $("#sidebar_statc").addClass("sidebarstatictop");
        } else {
            $("#sidebar_statc").removeClass("sidebarstatictop");
        }
    });
    // Postfix
    $(".touchspin-postfix").TouchSpin({
        min: 1,
        max: 500,
        step: 5,
        decimals: 0,
        postfix: '%'
    });
    $(document).ready(function () {
        $(document).on("click", ".bootstrap-touchspin-up", function () {
            zoom_page(10, $(this));
        });
        $(document).on("click", ".bootstrap-touchspin-down", function () {
            zoom_page(-10, $(this));
        });
        $(document).on("click", "#wf_fs", function () {
            $(".workflow_main_box").toggleClass("workflow_fs");
            //$("body").css("overflow", "hidden");
            $("body").toggleClass("ovf_hide");
            $(".workflow_option").toggleClass('hide');
        });
    });


    $(document).on("click", ".chooseContact", function () {
        clearAllActive();
        clearAllMenu();
        $(".wfSwitchMenu").hide();
        $("#wfChooseContactMenu").show();
        $(this).addClass('active_btn');
        if ($(".workflow_main_box").hasClass("workflow_fs")) {
            $("#wf_fs").trigger("click");
        }


    });
    $(document).on("click", ".viewImportOptions", function () {
        clearAllMenu();
        $(".wfSwitchMenu").hide();
        $("#wfImportOptionMenu").show();
        $(this).addClass('active_btn');
        if ($(".workflow_main_box").hasClass("workflow_fs")) {
            $("#wf_fs").trigger("click");
        }


    });

    $(document).on("click", ".viewExcludeOptions", function () {
        clearAllMenu();
        $(".wfSwitchMenu").hide();
        $("#wfExcludeOptionMenu").show();
        $(this).addClass('active_btn');
        if ($(".workflow_main_box").hasClass("workflow_fs")) {
            $("#wf_fs").trigger("click");
        }


    });


    $(document).on("click", ".viewCampaignContacts", function () {
        clearAllMenu();
        $(".wfSwitchMenu").hide();
        $("#wfCampaignContactList").show();
        $(this).addClass('active_btn');
        if ($(".workflow_main_box").hasClass("workflow_fs")) {
            $("#wf_fs").trigger("click");
        }


    });



    $(".wfBacktoChooseMenu").click(function () {
        $(".wfSwitchMenu").hide();
        setTimeout(function () {
            $("#wfChooseContactMenu").show();
        }, 50);
    });

    $(".backtoImportOptionMenu").click(function () {
        $(".wfSwitchMenu").hide();
        setTimeout(function () {
            $("#wfImportOptionMenu").show();
        }, 50);
    });

    $(".backtoExcludeOptionMenu").click(function () {
        $(".wfSwitchMenu").hide();
        setTimeout(function () {
            $("#wfExcludeOptionMenu").show();
        }, 50);
    });



    $(document).on("click", ".loadAudience", function () {
        var audienceType = $(this).attr('audience-type');
        var actionType = $(this).attr('action-type');
        $(".wfSwitchMenu").hide();
        if (audienceType == 'contacts' && actionType == 'import') {
            $("#wfImportFromContactList").show();

        } else if (audienceType == 'lists' && actionType == 'import') {
            $("#wfImportFromList").show();

        } else if (audienceType == 'segments' && actionType == 'import') {
            $("#wfImportFromSegments").show();

        } else if (audienceType == 'tags' && actionType == 'import') {
            $("#wfImportFromTags").show();

        } else if (audienceType == 'contacts' && actionType == 'exclude') {
            $("#wfExcludeFromContactList").show();

        } else if (audienceType == 'lists' && actionType == 'exclude') {
            $("#wfExcludeFromList").show();

        } else if (audienceType == 'segments' && actionType == 'exclude') {
            $("#wfExcludeFromSegments").show();

        } else if (audienceType == 'tags' && actionType == 'exclude') {
            $("#wfExcludeFromTags").show();

        }

    });





    $(document).on("click", ".wfLoadEmailNodeProperty", function () {
        if ($(".workflow_main_box").hasClass("workflow_fs")) {
            $("#wf_fs").trigger("click");
        }
        $('.overlaynew').show();
        clearAllActive();
        clearAllMenu();
        $(this).parent().addClass('active_state');
        var campaign_id = $(this).attr('campaign_id');
        var moduleName = $(this).attr('moduleName');
        var eventId = $(this).attr('event_id');
        var templateSource = $(this).attr('template_id');
        var moduleUnitId = $(this).attr('data-moduleaccountid');
        $.ajax({
            url: '/admin/workflow/loadWorkflowEmailStats',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitId: moduleUnitId, eventId: eventId, campaign_id: campaign_id},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wfEmailStats").html(data.stats);
                    $("#wf_delete_event").attr('event_id', eventId);
                    $("#wf_delete_event").attr('modulename', moduleName);
                    $("#wf_email_preview").attr('campaign_id', campaign_id);
                    $("#wf_email_preview").attr('event_id', eventId);
                    $("#wf_email_preview").attr('modulename', moduleName);
                    $("#wf_email_menu_edit").attr('campaign_id', campaign_id);
                    $("#wf_email_menu_edit").attr('modulename', moduleName);
                    $("select[name='wfEmailMenuCampaign']").val(templateSource);
                    $("#wfMainRightMenu").hide();
                    $("#wfEmailMenu").show();
                    $('.overlaynew').hide();
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }, error() {
                alertMessage('Error: Some thing wrong!');
                $('.overlaynew').hide();
            }
        });
    });
    $(document).on("click", ".wfLoadSMSNodeProperty", function () {
        if ($(".workflow_main_box").hasClass("workflow_fs")) {
            $("#wf_fs").trigger("click");
        }
        $('.overlaynew').show();
        clearAllActive();
        clearAllMenu();
        $(this).parent().addClass('active_sms');
        var campaign_id = $(this).attr('campaign_id');
        var moduleName = $(this).attr('moduleName');
        var eventId = $(this).attr('event_id');
        var moduleUnitId = $(this).attr('data-moduleaccountid');
        var templateSource = $(this).attr('template_id');
        var eventId = $(this).attr('event_id');
        $.ajax({
            url: '/admin/workflow/loadWorkflowSMSStats',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, campaign_id: campaign_id, moduleUnitId: moduleUnitId, eventId: eventId, },
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wfSMSStats").html(data.stats);
                    $("#wf_delete_sms_event").attr('event_id', eventId);
                    $("#wf_delete_sms_event").attr('modulename', moduleName);
                    $("#wf_sms_preview").attr('event_id', eventId);
                    $("#wf_sms_preview").attr('modulename', moduleName);
                    $("#wf_sms_preview").attr('campaign_id', campaign_id);
                    $("#wf_sms_menu_edit").attr('modulename', moduleName);
                    $("#wf_sms_menu_edit").attr('campaign_id', campaign_id);


                    $("select[name='wfSMSMenuCampaign']").val(templateSource);
                    $("#wfSMSMenuContent").html(data.oPreview.content.replace(/\r\n|\r|\n/g, "<br />"));
                    $("#wfMainRightMenu").hide();
                    $("#wfSMSMenu").show();
                    $('.overlaynew').hide();
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }, error() {
                alertMessage('Error: Some thing wrong!');
                $('.overlaynew').hide();
            }
        });
    });
    $(document).on("click", ".wf_previewEditCampaign", function (e) {
        var campaignId = $(this).attr('campaign_id');
        var moduleName = $(this).attr('moduleName');
        var moduleUnitId = $(this).attr('data-moduleaccountid')
        var campaignType = $(this).attr('campaignType');
        if (campaignId != '' && moduleName != '') {
            $.ajax({
                url: '/admin/workflow/previewWorkflowCampaign',
                type: "POST",
                data: {_token: '{{csrf_token()}}', moduleName: moduleName, campaignId: campaignId, moduleUnitId: moduleUnitId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (campaignType == 'email') {
                            $("#wf_preview_edit_template_content").html(data.content);
                            $("#wf_preview_edit_template_campaign_id").val(campaignId);
                            $("#wf_preview_edit_template_source").val(data.template_source);
                            $("#wf_preview_edit_template_subject").val(data.subject);
                            $("#wf_preview_edit_template_greeting").val(data.greeting);
                            $("#wf_preview_edit_template_introduction").val(data.introduction);
                            $('#workflow_edit_email_campaign_preview').modal();
                        } else if (campaignType == 'sms') {
                            $("#wf_preview_edit_sms_template_content").html(data.content);
                            $("#wf_preview_edit_sms_template_content_popup").html(data.content.replace(/\r\n|\r|\n/g, "<br />"));
                            $("#wf_preview_edit_sms_template_campaign_id").val(campaignId);
                            $("#wf_preview_edit_sms_template_source").val(data.template_source);
                            $("#wf_preview_edit_sms_template_subject").val(data.subject);
                            $("#wf_preview_edit_sms_template_greeting").val(data.greeting);
                            $("#wf_preview_edit_sms_template_introduction").val(data.introduction);
                            $('#workflow_edit_sms_campaign_preview').modal();
                        }

                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        }

        return false;
    });
    $(document).on('click', '#wf_preview_edit_template_save_campaign', function (e) {
        e.preventDefault();
        var moduleName = $("#wf_preview_edit_template_moduleName").val();
        var subject = $("#wf_preview_edit_template_subject").val();
        var greeting = $('#wf_preview_edit_template_greeting').val();
        var introduction = $('#wf_preview_edit_template_introduction').val();
        var campaignId = $("#wf_preview_edit_template_campaign_id").val();
        var template_source = $("#wf_preview_edit_template_source").val();
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/updateWorkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, subject: subject, greeting: greeting, introduction: introduction, template_source: template_source, campaignId: campaignId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', '', 'Saved changes successful!');
                    //$('#workflow_edit_email_campaign_preview').modal('hide');
                    $('.overlaynew').hide();
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
        return false;
    });
    $(document).on('click', '#wf_preview_edit_sms_template_save_campaign', function (e) {
        e.preventDefault();
        var moduleName = $("#wf_preview_edit_sms_template_moduleName").val();
        var subject = $("#wf_preview_edit_sms_template_subject").val();
        var greeting = $('#wf_preview_edit_sms_template_greeting').val();
        var introduction = $('#wf_preview_edit_sms_template_introduction').val();
        var campaignId = $("#wf_preview_edit_sms_template_campaign_id").val();
        var template_source = $("#wf_preview_edit_sms_template_source").val();
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/updateWorkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, greeting: greeting, introduction: introduction, template_source: template_source, campaignId: campaignId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', '', 'Saved changes successful!');
                    //$('#workflow_edit_sms_campaign_preview').modal('hide');
                    $('.overlaynew').hide();
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
        return false;
    });
    $(document).on("keyup", "#wf_preview_edit_template_greeting", function () {
        var greetText = $(this).val();
        $("#wf_edit_template_greeting").text(greetText);
        $("#wf_edit_template_greeting_EDITOR").text(greetText);
        $("#wf_edit_template_greeting_PREVIEW").text(greetText);
    });

    $(document).on("keyup", "#wf_preview_edit_template_introduction", function () {
        var introText = $(this).val();
        $("#wf_edit_template_introduction_EDITOR").text(introText);
    });

    $(document).on("keyup", "#wf_preview_edit_sms_template_greeting", function () {
        var greetText = $(this).val();
        $("#wf_edit_sms_template_greeting_EDITOR").text(greetText);
        $("#wf_edit_sms_template_greeting_PREVIEW").text(greetText);
    });

    $(document).on("keyup", "#wf_preview_edit_sms_template_introduction", function () {
        var introText = $(this).val();
        introText = introText.replace(/\r\n|\r|\n/g, "<br />");
        $("#wf_edit_sms_template_introduction_EDITOR").html(introText);
        $("#wf_edit_sms_template_introduction_PREVIEW").html(introText);
    });

    $(document).on("click", ".wf_timer", function () {
        var eventID = $(this).attr('event_id');
        var delayValue = $(this).attr('delay_value');
        var delayUnit = $(this).attr('delay_unit');
        $("#wf_timer_event_value").val(delayValue);
        $("#wf_timer_event_unit").val(delayUnit);
        $("#wf_timer_event_id").val(eventID);
        clearAllActive();
        clearAllMenu();
        $(".wfSwitchMenu").hide();
        $("#wfTimerMenu").show();
        $(this).addClass('active_btn');
        if ($(".workflow_main_box").hasClass("workflow_fs")) {
            $("#wf_fs").trigger("click");
        }


    });
    $(document).on('change', '#wf_timer_event_value', function () {
        var timerValue = $(this).val();
        var timerUnit = $("#wf_timer_event_unit").val();
        var eventID = $("#wf_timer_event_id").val();
        var moduleName = $("#wf_timer_moduleName").val();
        $.ajax({
            url: '/admin/workflow/updateEventTime',
            type: "POST",
            data: {_token: '{{csrf_token()}}', event_id: eventID, delay_value: timerValue, delay_unit: timerUnit, event_type: 'sent', 'moduleName': moduleName},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wf_waitTime_" + eventID).html('<span class="txt_grey">Wait for</span> ' + timerValue + ' ' + timerUnit);
                    $("#wf_waitTime_" + eventID).attr('delay_value', timerValue);
                    $("#wf_waitTime_" + eventID).attr('delay_unit', timerUnit);
                    displayMessagePopup('success', '', 'Saved changes successful!');
                }
            }
        });
    });
    $(document).on('change', '#wf_timer_event_unit', function () {
        var timerUnit = $(this).val();
        var timerValue = $("#wf_timer_event_value").val();
        var eventID = $("#wf_timer_event_id").val();
        var moduleName = $("#wf_timer_moduleName").val();
        $.ajax({
            url: '/admin/workflow/updateEventTime',
            type: "POST",
            data: {_token: '{{csrf_token()}}', event_id: eventID, delay_value: timerValue, delay_unit: timerUnit, event_type: 'sent', 'moduleName': moduleName},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wf_waitTime_" + eventID).html('<span class="txt_grey">Wait for</span> ' + timerValue + ' ' + timerUnit);
                    $("#wf_waitTime_" + eventID).attr('delay_value', timerValue);
                    $("#wf_waitTime_" + eventID).attr('delay_unit', timerUnit);
                    displayMessagePopup('success', '', 'Saved changes successful!');
                }
            }
        });
    });
    $(document).on("click", "#wf_preview_edit_template_send_email", function () {
        var email = $("#wf_preview_edit_template_text_email").val();
        var campaignId = $("#wf_preview_edit_template_campaign_id").val();
        //var moduleName = $("#wf_preview_edit_template_moduleName").val();
        var moduleName = '<?php echo $moduleName; ?>';
        var moduleUnitID = '<?php echo $moduleUnitID; ?>';
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestEmailworkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, campaignId: campaignId, email: email},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });
    });
    $(document).on("click", "#wf_email_testEmailCtr,#wfPreviewTestCtrCancel", function () {
        $("#wfPreviewTestCtr").toggleClass('hidden');
    });
    $(document).on("click", "#wf_sms_testSMSCtr,#wfPreviewTestCtrSMSCancel", function () {
        $("#wfPreviewTestSMSCtr").toggleClass('hidden');
    });
    $(document).on("click", "#wfPreviewTestCtr_send_email", function () {
        var email = $("#wfPreviewTestCtr_text_email").val();
        var campaignId = $("#wf_email_preview").attr('campaign_id');
        //var moduleName = $("#wf_email_preview").attr('modulename');
        var moduleName = '<?php echo $moduleName; ?>';
        var moduleUnitID = '<?php echo $moduleUnitID; ?>';
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestEmailworkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, campaignId: campaignId, email: email},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });
    });
    $(document).on("click", "#wfBtnPopupSendTestEmail", function () {
        var email = $("#wfTextPopupSendTestEmail").val();
        var campaignId = $("#wf_test_email_campaign_id").val();
        //var moduleName = '<?php echo $moduleName; ?>';
        var moduleName = '<?php echo $moduleName; ?>';
        var moduleUnitID = '<?php echo $moduleUnitID; ?>';
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestEmailworkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, campaignId: campaignId, email: email},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited) 
                    $("#wfSendTestEmail").modal("hide");
                    $('.overlaynew').hide();
                }
            }
        });
    });
    $(document).on("click", "#wf_preview_edit_sms_template_send_sms", function () {
        var number = $("#wf_preview_edit_sms_template_text_number").val();
        var campaignId = $("#wf_preview_edit_sms_template_campaign_id").val();
        var moduleName = $("#wf_preview_edit_sms_template_moduleName").val();
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestSMSworkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', 'moduleName': moduleName, campaignId: campaignId, number: number},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test SMS sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });
    });
    $(document).on("click", "#wfBtnPopupSendTestSMS", function () {
        var number = $("#wfTextPopupSendTestSMS").val();
        var campaignId = $("#wf_test_sms_campaign_id").val();
        var moduleName = '<?php echo $moduleName; ?>';
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestSMSworkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', 'moduleName': moduleName, campaignId: campaignId, number: number},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup("success", "Success", "Test SMS sent successfully!");
                    $("#wfSendTestSMS").modal("hide");
                    $('.overlaynew').hide();
                }
            }
        });
    });



    $(document).on("click", "#wfPreviewTestCtr_send_sms", function () {
        var number = $("#wfPreviewTestCtr_text_number").val();
        var campaignId = $("#wf_sms_preview").attr('campaign_id');
        var moduleName = '<?php echo $moduleName; ?>';
        var moduleUnitID = '<?php echo $moduleUnitID; ?>';
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestSMSworkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitID: moduleUnitID, campaignId: campaignId, number: number},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test SMS sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });
    });
    $(document).on("click", "#wfOpenTestCtr", function () {
        $("#wfActiveCtr").hide();
        $("#wfTestCtr").show();
    });
    $(document).on("click", "#wfCloseTestCtr", function () {
        $("#wfActiveCtr").show();
        $("#wfTestCtr").hide();
    });
    $(document).on("click", "#wfOpenSMSTestCtr", function () {
        $("#wfSMSActiveCtr").hide();
        $("#wfSMSTestCtr").show();
    });
    $(document).on("click", "#wfCloseSMSTestCtr", function () {
        $("#wfSMSActiveCtr").show();
        $("#wfSMSTestCtr").hide();
    });
    $(document).on("click", "#wfOpenSMSTestCtrEdit", function () {
        $("#wfSMSActiveCtrEdit").hide();
        $("#wfSMSTestCtrEdit").show();
    });
    $(document).on("click", "#wfCloseSMSTestCtrEdit", function () {
        $("#wfSMSActiveCtrEdit").show();
        $("#wfSMSTestCtrEdit").hide();
    });
    $(document).on("click", "#wf_preview_edit_sms_template_send_sms_Edit", function () {
        var number = $("#wf_preview_edit_sms_template_text_number_Edit").val();
        var campaignId = $("#wf_sms_editor_campaign_id").val();
        var moduleName = $("#wf_sms_editor_moduleName").val();
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestSMSworkflowCampaign',
            type: "POST",
            data: {_token: '{{csrf_token()}}', 'moduleName': moduleName, campaignId: campaignId, number: number},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test SMS sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });
    });
    $(document).on('change', '.continueChooseTemplateButton', function () {
        var template_id = $(this).attr('template_id');
        var source = $(this).attr('source');
        $("#wf_act_email_template_id").val(template_id);
        $("#wf_act_template_type").val(source);
    });
    $(document).on('change', '.continueChooseSMSTemplateButton', function () {
        var template_id = $(this).attr('template_id');
        var source = $(this).attr('source');
        $("#wf_act_sms_template_id").val(template_id);
        $("#wf_act_template_type").val(source);
    });
    $(document).on('click', '.addWorkflowNewEvent', function () {
        //$(".timeline").hide();
        //$("#chooseTemplate").show();
        var actionid = $(this).attr('previous_event_id');
        var currentid = $(this).attr('current_event_id');
        var eventtype = $(this).attr('event_type');
        var nodetype = $(this).attr('data-node-type');
        var tabtype = $(this).attr('data-tab-type');
        $("#wf_act_prev_id").val(actionid);
        $("#wf_act_curr_id").val(currentid);
        $("#wf_act_node_type").val(nodetype);
        $("#wf_act_event_type").val(eventtype);
        initShowAddEventContainers();
        if (tabtype == 'email') {
            $("#templateParentContainer").show();
            $("#chooseEmailTemplate").show();
        }

        if (tabtype == 'sms') {
            $("#templateParentContainer").show();
            $("#chooseSMSTemplate").show();
        }


    });
    function initShowAddEventContainers() {
        $(".timeline").hide();
        $(".bootstrap-touchspin").hide();
        $(".continueChooseSMSTemplateButton").removeAttr("checked");
        $(".continueChooseTemplateButton").removeAttr("checked");
        $("#chooseEmailTemplate").hide();
        $("#chooseSMSTemplate").hide();
    }

    function endShowAddEventContainers(bclearAll) {
        $(".timeline").show();
        $(".bootstrap-touchspin").show();
        $("#wf_act_email_template_id").val('');
        $("#action_sms_template_id").val('');
        $("#wf_act_sms_template_id").val('');
        $("#templateParentContainer").hide();
        $("#chooseEmailTemplate").hide();
        $("#chooseSMSTemplate").hide();
    }

    $(document).on("click", "#cancelAddNewEvent", function () {
        endShowAddEventContainers();
    });
    $(document).on("click", "#createNewWorkflowEventNode", function (e) {
        e.preventDefault();
        //check which email template selected   

        var emailTemplateId = $("#wf_act_email_template_id").val();
        var smsTemplateId = $("#wf_act_sms_template_id").val();
        var source = $("#wf_act_template_type").val();
        var delayVal = '10';
        var delayUnit = 'minute';
        var previousID = $("#wf_act_prev_id").val();
        var currentID = $("#wf_act_curr_id").val();
        var event_type = $("#wf_act_event_type").val();
        var node_type = $("#wf_act_node_type").val();
        var moduleName = $("#wf_act_moduleName").val();
        var moduleUnitId = $("#wf_act_module_unit_id").val();
        if ((emailTemplateId == '' || emailTemplateId == undefined) && (smsTemplateId == '' || smsTemplateId == undefined)) {
            displayMessagePopup('error', 'Template required', 'Please choose any template');
            return false;
        }

        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/addWorkflowNode',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitId: moduleUnitId, previous_event_id: previousID, emailTemplateId: emailTemplateId, smsTemplateId: smsTemplateId, source: source, delayVal: delayVal, delayUnit: delayUnit, 'current_event_id': currentID, 'event_type': event_type, node_type: node_type},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {

                    //window.location.href = window.location.href;
                    //$('.overlaynew').hide();
                    loadAjaxTree(moduleName, moduleUnitId);
                    //Open Editor
                    if (emailTemplateId > 0) {
                        if (data.categoryStatus != '2') {
                            $("#loadstripotemplateInline").attr("src", '<?php echo base_url(); ?>admin/workflow/loadStripoCampaign/' + moduleName + '/' + data.campaign_id + '/' + '<?php echo $moduleUnitID; ?>');
                            //$("#workflow_template_stripo_modal").modal();
                            $("#superContainer").hide();
                            $("#editTemplateContainer").show();
                        }


                    }

                    if (smsTemplateId > 0) {
                        if (data.categoryStatus != '2') {
                            $("#loadstripotemplateInline").attr("src", '<?php echo base_url(); ?>admin/workflow/loadStripoSMSCampaign/' + moduleName + '/' + data.campaign_id + '/' + '<?php echo $moduleUnitID; ?>');
                            //$("#workflow_template_stripo_modal").modal();
                            $("#superContainer").hide();
                            $("#editTemplateContainer").show();
                        }

                    }


                } else {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            }, error() {
                $('.overlaynew').hide();
                alertMessage('Error: Some thing wrong!');
            }
        });
    });
    function loadAjaxTree(moduleName, moduleUnitId) {
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/loadWorkflowTree',
            type: "POST",
            data: {_token: '{{csrf_token()}}', moduleName: moduleName, moduleUnitId: moduleUnitId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $(".timeline-container").html(data.content);
                    $("#wfMainRightMenuContainer").html(data.menu_content);
                    $("#wfMainRightMenuZoomContainer").html(data.zoom_menu_content)
                    $('.overlaynew').hide();
                    endShowAddEventContainers();
                    displayMessagePopup('success', '', 'Action was Successful!');
                } else {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            }, error() {
                $('.overlaynew').hide();
                alertMessage('Error: Some thing wrong!');
            }
        });
    }

    function resetAddNewWorkFlowNodePopup() {
        $("select[name='selectNewWorkflowEmailTemplate']").val('');
        $("select[name='selectNewWorkflowSMSTemplate']").val('');
    }




    $(document).on("click", ".backtoMenu", function () {
        clearAllActive();
        clearAllMenu();
        $(".wfSwitchMenu").hide();
        $("#wfMainRightMenu").show();
    });
    function clearAllActive() {
        $(".wf_timer").removeClass('active_btn');
        $(".top_box").removeClass('active_sms');
        $(".top_box").removeClass('active_state');
        $(".chooseContact").removeClass('active_btn');
        $("#wfMainRightMenu").show();
    }

    function clearAllMenu() {
        $("#wfMainRightMenu").show();
        $("#wfEmailMenu").hide();
        $("#wfSMSMenu").hide();
        $("#wfTimerMenu").hide();
        $("#wfChooseContactMenu").hide();
        $("#wfImportOptionMenu").hide();
        $("#wfExcludeOptionMenu").hide();
        $("select[name='wfEmailMenuCampaign']").val('');
        $("select[name='wfSMSMenuCampaign']").val('');
    }



</script>

