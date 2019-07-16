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

$oUser = getLoggedUser();
$userID = $oUser->id;
if ($userID > 0) {
    $oTwilioAc = $this->mInviter->getTwilioAccount($userID);
}


$aContactSelectionData = $this->mWorkflow->getWorkflowContactSelectionInterfaceData($moduleName, $moduleUnitID);
$iActiveCount = $iArchiveCount = 0;
$aSelectedContacts = $aContactSelectionData['oCampaignSubscribers'];
if (!empty($aSelectedContacts)) {
    foreach ($aSelectedContacts as $oCount) {
        if ($oCount->status == 2) {
            $iArchiveSelectedCount++;
        } else {
            $iActiveSelectedCount++;
        }
    }
}
?>
<div class="timeline-zoomable">
    <div class="timeline-row post-full">




        <div class="timeline-date button">

            <button type="button" class="btn white_btn chooseContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><span class="txt_grey"></span> New Contact 

            </button>
            <a class="icons iconsab blue br8 t30 <?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" href="javascript:void(0);" ><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"></a>
        </div>


        <?php
        if (!empty($oMainEvent)):
            $previousID = $oMainEvent->previous_event_id;
            $currentID = $oMainEvent->id;
            $bAnyMainEventExist = true;
            ?>

            <div class="timeline-date button mt20 mb40">
                <button class="btn btn-xs btn_white_table smallbtn rounded dropdown-toggle" data-toggle="dropdown"><i class="icon-plus3"></i></button>
                <?php $this->load->view("/admin/workflow2/partials/action-dropdown", array('previousID' => $previousID, 'currentID' => $currentID, 'oEventsType' => $oEventsType, 'nodeType' => 'main', 'eventType' => $oEventsType[0])); ?>
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
                                <?php $this->load->view("admin/workflow2/partials/sms_node.php", $aNodeData); ?>

                            <?php elseif ($sNodeType == 'email'): ?>
                                <!-- Draw Tree Node -->
                                <?php $this->load->view("admin/workflow2/partials/email_node.php", $aNodeData); ?>
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
                        <?php $this->load->view("/admin/workflow2/partials/action-dropdown", array('previousID' => $previousID, 'currentID' => $currentID, 'oEventsType' => $oEventsType, 'nodeType' => 'followup', 'eventType' => $nextEventType)); ?>
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
            <div class="timeline-date button mt0 mb20">
                <button class="btn btn-xs btn_white_table smallbtn rounded dropdown-toggle" data-toggle="dropdown"><i class="icon-plus3"></i></button>
                <?php $this->load->view("/admin/workflow2/partials/action-dropdown", array('previousID' => $previousID, 'currentID' => $currentID, 'oEventsType' => $oEventsType, 'nodeType' => 'main', 'eventType' => $oEventsType[0])); ?>
            </div>
        <?php endif; ?>

        <div  class="timeline-date button mt30 mb0">
            <button type="button" class="btn white_btn"><span class="txt_grey"></span>&nbsp;Success </button>
            <a class="icons iconsab green2 br8 t30" href="#"><img src="<?php echo base_url(); ?>assets/images/green_check_round.png"></a>
        </div>



    </div>
</div>