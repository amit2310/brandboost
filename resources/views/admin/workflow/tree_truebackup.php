<style>
    .email_workflow_sec .smallbtn.rounded{
        margin-top:-25px !important;
    }
    .mb55{
        margin-bottom: 55px;
    }
</style>
<?php
list($canReadCon, $canWriteCon) = fetchPermissions('Contacts');
list($canReadAna, $canWriteAna) = fetchPermissions('Analytics');
$bAnyMainEventExist = false;

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
$aEmailStats = $this->mWorkflow->getModuleUnitSendgridStats($moduleUnitID, $moduleName);
$aCategorizedEmailStats = $this->mWorkflow->getEventSendgridCategorizedStats($aEmailStats);
$aCategorizedEmailStats24Hours = $this->mWorkflow->getEventSendgridCategorizedStats($aEmailStats, true);

$aCampaignStats = array(
    'aEmailStats' => $aEmailStats,
    'aEmailStatsCategorized' => $aCategorizedEmailStats,
    'aCategorizedEmailStats24Hours' => $aCategorizedEmailStats24Hours
);
?>
<div class="">
    <div class="row">
        <!-- Draw graph -->
        <?php $this->load->view("admin/workflow/partials/workflow-graph.php", $aCampaignStats); ?>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Workflow</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p40 min_h290 email_workflow_sec">
                    <!-- Timeline -->
                    <div class="timeline timeline-center">
                        <div class="timeline-container">

                            <!-- Sales stats -->
                            <div class="timeline-row post-full">
                                <div class="timeline-date button">
                                    <button class="btn white_btn bigbtn rounded"><i class="icon-play4 txt_grey fsize16"></i></button>
                                </div>

                                <div class="timeline-date button">
                                    <button type="button" class="btn white_btn <?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>">Add New Contact 
                                        <?php
                                        if (count($oAutomationLists)) {
                                            $bListAdded = true;
                                            echo '<br>(' . count($oAutomationLists) . ' List added)';
                                        }
                                        ?>
                                    </button>
                                    <a class="icons iconsab blue t30 <?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" href="javascript:void(0);" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><i class="icon-user"></i></a>
                                </div>

                                <?php
                                if (!empty($oMainEvent)):
                                    $previousID = $oMainEvent->previous_event_id;
                                    $currentID = $oMainEvent->id;
                                    $bAnyMainEventExist = true;
                                    ?>

                                    <div class="timeline-date button">
                                        <button class="btn btn-xs btn_white_table smallbtn rounded addWorkflowEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $oEventsType[0]; ?>" data-node-type="main"><i class="icon-plus3"></i></button>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $previousEventID = 0;
                                $eventNo = 1;
                                $subscribersData = $this->mWorkflow->getWorkflowSubscribers($moduleUnitID, $moduleName);
                                $bBranchDrawn = false;
                                foreach ($oEvents as $key => $oEvent) {
                                    $bMulitpleBranches = false;
                                    $finishBranch = false;
                                    if ($bBranchDrawn == true) {
                                        $finishBranch = true;
                                    }
                                    $aEventData = json_decode($oEvent->data);
                                    $oEventDataNext = json_decode($oEvents[$key + 1]->data);

                                    if (!empty($oEventDataNext)) {
                                        if ($oEventDataNext->delay_value == 0 && $oEventDataNext->delay_unit == 'minute') {
                                            $bMulitpleBranches = true;
                                        }
                                    }

                                    $oCampaignData = $this->mWorkflow->getEventCampaign($oEvent->id, $moduleName);
                                    $oCampaign = $oCampaignData[0];
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

                                        $aStatsSms = $this->mWorkflow->getEventTwilioStats($oCampaign->id, $moduleName);
                                        $aCategorizedStatsSms = $this->mWorkflow->getEventTwilioCategorizedStats($aStatsSms);

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
                                            $aStats = $this->mWorkflow->getEventSendgridStats($oCampaign->id, $moduleName);
                                            $aCategorizedStats = $this->mWorkflow->getEventSendgridCategorizedStats($aStats);

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
                                                'processed' => $processed,
                                                'delivered' => $delivered,
                                                'bMulitpleBranches' => $bMulitpleBranches,
                                                'bBranchDrawn' => $bBranchDrawn,
                                                'open' => $open,
                                                'click' => $click,
                                                'bounce' => $bounce,
                                                'dropped' => $dropped,
                                                'unsubscribe' => $unsubscribe,
                                                'spamReport' => $spamReport
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
                                                'sentSms' => $sentSms,
                                                'deliveredSms' => $deliveredSms,
                                                'failedSms' => $failedSms,
                                                'queuedSms' => $queuedSms,
                                                'acceptedSms' => $acceptedSms,
                                                'sentSms' => $sentSms
                                            );
                                        }
                                        ?>
                                        <?php if ($bBranchDrawn == false) { ?>
                                            <div class="timeline-date button">
                                                <button type="button" class="btn white_btn wf_waitTime" id="wf_waitTime_<?php echo $oEvent->id; ?>" data-toggle="dropdown" aria-expanded="false" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>">&nbsp; <i class="icon-alarm txt_purple"></i> &nbsp; <span class="text-muted">Wait for</span> <?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?> <?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?> </button>
                                                <a class="icons iconsab red t30 wf_waitTime" id="wf_waitTime_<?php echo $oEvent->id; ?>" data-toggle="dropdown" aria-expanded="false" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>"><i class="fa fa-clock-o"></i></a>
                                            </div>

                                            <?php if ($bMulitpleBranches == true): ?>
                                                <div class="timeline-date button mb0">
                                                    <img src="<?php echo base_url(); ?>assets/images/timeline_top_border1.jpg"/>
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
                                                        <?php $this->load->view("admin/workflow/partials/sms_node.php", $aNodeData); ?>

                                                    <?php elseif ($sNodeType == 'email'): ?>
                                                        <!-- Draw Tree Node -->
                                                        <?php $this->load->view("admin/workflow/partials/email_node.php", $aNodeData); ?>
                                                    <?php endif; ?>
                                                    <?php if ($bMulitpleBranches == false): ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($finishBranch == true): ?>
                                            <div class="timeline-date button" style="margin-top:-20px;">
                                                <img src="<?php echo base_url(); ?>assets/images/timeline_bot_border1.png"/>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($bMulitpleBranches == false): ?>
                                            <div class="timeline-date button">
                                                <button class="btn btn-xs btn_white_table smallbtn rounded addWorkflowEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" data-node-type="followup"><i class="icon-plus3"></i></button>
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
                                ?>



                                <?php if ($bAnyMainEventExist == false): ?> 
                                    <div class="timeline-date button">
                                        <button class="btn btn-xs btn_white_table smallbtn rounded addWorkflowEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $oEventsType[0]; ?>" data-node-type="main"><i class="icon-plus3"></i></button>
                                    </div>
                                <?php endif; ?>

                                <div class="timeline-date button">
                                    <button type="button" class="btn white_btn">Success</button>
                                    <a class="icons iconsab red t30" href="#"><i class="icon-flag3"></i></a>
                                </div>


                                <div class="timeline-date button mb0">
                                    <button class="btn white_btn bigbtn rounded"><i class="icon-checkmark txt_grey fsize16"></i></button>
                                </div>           

                            </div>
                            <!-- /sales stats -->



                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- /timeline -->
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Actions</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p20 min_h290">
                    <ul class="action_box_new">
                        <li><a style="color:#38435b;" href="javascript:void(0);" class="<?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><span class="icons grd_bkg_blue"><i class="icon-user"></i></span>Contacts</a></li>
                        <li><a style="color:#38435b;" href="javascript:void(0);" data-tab-type="email" class="addWorkflowEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" <?php if ($oEvent->id > 0): ?>data-node-type="followup"<?php else: ?>data-node-type="main"<?php endif; ?>><span class="icons grd_bkg_green2"><i class="icon-envelop"></i></span>Email Request</a></li>
                        <li><a style="color:#38435b;" href="javascript:void(0);" data-tab-type="sms" class="addWorkflowEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" <?php if ($oEvent->id > 0): ?>data-node-type="followup"<?php else: ?>data-node-type="main"<?php endif; ?>><span class="icons grd_bkg_green"><i class="icon-iphone"></i></span>SMS Request</a></li>
                        <li><a style="color:#38435b;" href="javascript:void(0);" <?php if ($oEvent->id > 0): ?>class="wf_waitTime"<?php endif; ?> style="cursor:pointer;" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>" ><span class="icons grd_bkg_red"><i class="fa fa-clock-o"></i></span>Timer</a></li>
                        <li><span class="icons grd_bkg_red"><i class="icon-flag3"></i></span>Goal</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>


<?php //$this->load->view("admin/modals/workflow/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates));        ?>
<script>
    var site_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/modules/workflow/workflow.js" type="text/javascript"></script>


