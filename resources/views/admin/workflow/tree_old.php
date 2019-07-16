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

//echo $Res = $this->mWorkflow->displaywelcome();
?>
<div class="content">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Daily statistics</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0 text-center min_h270">
                    <img class="radius5" src="<?php echo base_url(); ?>assets/images/email_graph4.png">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Credits</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body min_h270 p0   text-center"> <img src="<?php echo base_url(); ?>assets/images/email_graph3.png"> </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Workflow</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p40 min_h290">
                    <!-- Timeline -->
                    <div class="timeline timeline-center">
                        <div class="timeline-container">

                            <!-- Sales stats -->
                            <div class="timeline-row post-full">
                                <!--<div class="timeline-icon">
                                        <a href="#"><img src="assets/images/placeholder.jpg" alt=""></a>
                                </div>-->

                                <div class="timeline-date button">
                                    <button class="btn white_btn bigbtn rounded"><i class="icon-play4 txt_purple"></i></button>
                                </div>

                                <div class="timeline-date button">
                                    <button type="button" class="btn btn-xs btn_white_table " data-toggle="dropdown" aria-expanded="false">&nbsp; <i class="icon-user txt_purple"></i> &nbsp;  Tags <i class="icon-hash"></i>  New Customer &nbsp; </button>
                                    <button class="btn btn-xs btn_white_table"><i class="icon-plus3"></i></button>
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
                                $moduleCatName = $brandboostData->review_type;
                                $subscribersData = $this->mWorkflow->getWorkflowSubscribers($moduleUnitID, $moduleName);
                                $oDefaultTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName, $moduleCatName);




                                foreach ($oEvents as $oEvent) {
                                    $aEventData = json_decode($oEvent->data);
                                    $oCampaignData = $this->mWorkflow->getEventCampaign($oEvent->id, $moduleName);
                                    $oCampaign = $oCampaignData[0];
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

                                        if ($oCampaign->campaign_type == 'Email') {
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
                                            ?>

                                            <div class="timeline-date button">
                                                <button type="button" class="btn btn-xs btn_white_table wf_waitTime" id="wf_waitTime_<?php echo $oEvent->id; ?>" data-toggle="dropdown" aria-expanded="false" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>">&nbsp; <i class="icon-alarm txt_purple"></i> &nbsp; <span class="text-muted">Wait for </span>  <?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?> <?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?> </button>
                                                <button class="btn btn-xs btn_white_table wf_waitTime" id="wf_waitTime_<?php echo $oEvent->id; ?>" data-toggle="dropdown" aria-expanded="false" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>"><i class="icon-plus3"></i></button>
                                            </div>

                                            <!-- Email -->
                                            <div class="timeline-content mb30">
                                                <div class="pt0 pb0">

                                                    <div class="row">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <div class="timeline-content inner">
                                                                <div class="panel border-left-lg border-left-primary top_box">
                                                                    <a class="icons iconsab" href="#"><i class="icon-envelop txt_blue"></i></a>
                                                                    <div class="panel-heading">
                                                                        <p class="mb0 itemOrder_<?php echo $eventNo; ?>"><?php echo $eventNo; ?>- <?php echo ($eventNo == 1) ? 'Primary Email' : 'Reminder Email'; ?> : <?php echo $oCampaign->subject; ?></p>
                                                                        <div class="heading-elements"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" campaign_id="<?php echo $oCampaign->id; ?>"><i class="icon-more2"></i></a>
                                                                            <ul class="dropdown-menu dropdown-menu-right width-200">

                                                                                <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" class="text-default text-semibold wf_editCampaign"><i class="icon-pencil"></i>  Edit</a></li>
                                                                                <li><a href="javascript:void(0);" event_id="<?php echo $oEvent->id; ?>" moduleName="<?php echo $moduleName; ?>" class="wf_deleteCampaign" ><i class="icon-trash"></i> Delete</a></li>
                                                                                <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" class="wf_viewCampaignStats"><i class="icon-file-text2"></i> View Stats</a></li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body bkg_white">
                                                                        <p class="m0 text-muted"><?php echo count($subscribersData); ?> Contacts Added</p>
                                                                    </div>
                                                                </div>

                                                                <div class="panel border-left-lg border-left-primary mb0" id="wf_campaign_stats_<?php echo $oCampaign->id; ?>" style="display:none;">
                                                                    <div class="panel-heading">
                                                                        <p class="txt_black mb0">Type: Email</p>
                                                                        <p class="mb0 text-muted">A collection of textile samples lay spread out on the table</p>
                                                                        <div class="heading-elements"><a href="javascript:void(0);" class="wf_hideCampaignStats" campaign_id="<?php echo $oCampaign->id; ?>"><i class="icon-more2"></i></a></div>
                                                                    </div>
                                                                    <div class="panel-body bkg_white">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <ul>
                                                                                    <li><span>Sent</span><?php echo $processed; ?></li>
                                                                                    <li><span>Delivered</span><?php echo $delivered; ?></li>
                                                                                    <li><span>Open</span><?php echo $open; ?></li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <ul>
                                                                                    <li><span>Click</span><?php echo $click; ?></li>
                                                                                    <li><span>Bounce</span><?php echo $bounce; ?></li>
                                                                                    <li><span>Dropped</span><?php echo $dropped; ?></li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="col-md-4 pr0">
                                                                                <ul>
                                                                                    <li><span>Unsubscribe</span><?php echo $unsubscribe; ?></li>
                                                                                    <li><span>Spam report</span><?php echo $spamReport; ?></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="panel-footer panel-footer-condensed bkg_white">
                                                                        <p class="mb0 "><span class="mr20 text-muted">Created</span> <?php echo date("M d, Y h:i A", strtotime($oEvent->created)); ?> (<?php echo timeAgo($oCampaign->created); ?>)</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="timeline-date button">
                                                <button class="btn btn-xs btn_white_table smallbtn rounded addWorkflowEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" data-node-type="followup"><i class="icon-plus3"></i></button>
                                            </div>

                                        <?php } if ($oCampaign->campaign_type == 'SMS') { ?>
                                            <!--Sms --> 

                                            <div class="timeline-date button">
                                                <button type="button" class="btn btn-xs btn_white_table wf_waitTime" id="wf_waitTime_<?php echo $oEvent->id; ?>" data-toggle="dropdown" aria-expanded="false" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!(empty($aEventData->delay_time)) ? $aEventData->delay_time : '9 PM'; ?>">&nbsp; <i class="icon-alarm txt_purple"></i> &nbsp; <span class="text-muted">Wait for </span>  <?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?> <?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?> </button>
                                                <button class="btn btn-xs btn_white_table wf_waitTime" id="wf_waitTime_<?php echo $oEvent->id; ?>" data-toggle="dropdown" aria-expanded="false" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!(empty($aEventData->delay_time)) ? $aEventData->delay_time : '9 PM'; ?>"><i class="icon-plus3"></i></button>
                                            </div>


                                            <div class="timeline-content mb30">
                                                <div class="pt0 pb0">
                                                    <div class="row">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <div class="timeline-content inner">
                                                                <div class="panel border-left-lg border-left-danger top_box">
                                                                    <a class="icons iconsab" href="#"><i class="icon-iphone txt_green"></i></a>
                                                                    <div class="panel-heading">
                                                                        <p class="mb0 "><?php echo $eventNo; ?>- <?php echo ($eventNo == 1) ? 'Primary SMS' : 'Reminder SMS'; ?> : <?php echo $oCampaign->subject; ?></p>
                                                                        <div class="heading-elements"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
                                                                            <ul class="dropdown-menu dropdown-menu-right width-200">

                                                                                <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" class="text-default text-semibold wf_editCampaign"><i class="icon-pencil"></i>  Edit</a></li>
                                                                                <li><a href="javascript:void(0);" event_id="<?php echo $oEvent->id; ?>" moduleName="<?php echo $moduleName; ?>" class="wf_deleteCampaign" ><i class="icon-trash"></i> Delete</a></li>
                                                                                <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" class="wf_viewCampaignStats"><i class="icon-file-text2"></i> View Stats</a></li>

                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body bkg_white">
                                                                        <p class="m0 text-muted"><?php echo count($subscribersData); ?> Contacts Added</p>
                                                                    </div>
                                                                </div>

                                                                <div class="panel border-left-lg border-left-danger mb30" id="wf_campaign_stats_<?php echo $oCampaign->id; ?>" style="display:none;">
                                                                    <div class="panel-heading">
                                                                        <p class="txt_black mb0">Type: Email</p>
                                                                        <p class="mb0 text-muted">A collection of textile samples lay spread out on the table</p>
                                                                        <div class="heading-elements"><a href="javascript:void(0);" class="wf_hideCampaignStats" campaign_id="<?php echo $oCampaign->id; ?>"><i class="icon-more2"></i></a></div>
                                                                    </div>
                                                                    <div class="panel-body bkg_white">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <ul>
                                                                                    <li><span>Sent</span><?php echo $sentSms; ?></li>
                                                                                    <li><span>Delivered</span><?php echo $deliveredSms; ?></li>

                                                                                </ul>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <ul>
                                                                                    <li><span>Failed</span><?php echo $failedSms; ?></li>
                                                                                    <li><span>Queued</span><?php echo $queuedSms; ?></li>

                                                                                </ul>
                                                                            </div>
                                                                            <div class="col-md-4 pr0">
                                                                                <ul>
                                                                                    <li><span>Accepted</span><?php echo $acceptedSms; ?></li>
                                                                                    <li><span>Spam report</span><?php echo $sentSms; ?></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="panel-footer panel-footer-condensed bkg_white">
                                                                        <p class="mb0 "><span class="mr20 text-muted">Created</span> <?php echo date("M d, Y h:i A", strtotime($eventData->created)); ?> ( <?php echo timeAgo($oCampaign->created); ?> )</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>


                                            <div class="timeline-date button">
                                                <button class="btn btn-xs btn_white_table smallbtn rounded addNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" data-node-type="followup"><i class="icon-plus3"></i></button>
                                            </div>

                                            <?php
                                        }

                                        $previousEventID = $oEvent->id;
                                        $eventNo++;
                                    }
                                }
                                ?>



                                <?php if ($bAnyMainEventExist == false): ?> 
                                    <div class="timeline-date button">
                                        <button class="btn btn-xs btn_white_table smallbtn rounded addNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $oEventsType[0]; ?>" data-node-type="main"><i class="icon-plus3"></i></button>
                                    </div>
                                <?php endif; ?>

                                <div class="timeline-date button">
                                    <button type="button" class="btn btn-xs btn_white_table " data-toggle="dropdown" aria-expanded="false">&nbsp; <i class="icon-flag3 txt_purple"></i> &nbsp; <span class="text-muted">Goal </span>  Billing Success </button>
                                    <button class="btn btn-xs btn_white_table"><i class="icon-plus3"></i></button>
                                </div>


                                <div class="timeline-date button mb0">
                                    <button class="btn white_btn bigbtn rounded"><i class="icon-checkmark5 txt_purple"></i></button>
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
                    <ul class="action_box">
                        <li><span class="icons txt_blue"><i class="icon-user"></i></span>Contacts</li>
                        <li><span class="icons txt_dblue"><i class="icon-envelop"></i></span>Email Request</li>
                        <li><span class="icons txt_green"><i class="icon-iphone"></i></span>SMS Request</li>
                        <li><span class="icons txt_purple"><i class="icon-watch2"></i></span>Timer</li>
                        <li><span class="icons txt_purple"><i class="icon-flag3"></i></span>Goal</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

<?php //$this->load->view("admin/modals/workflow/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates)); ?>
<script src="<?php echo base_url(); ?>assets/js/modules/workflow/workflow.js" type="text/javascript"></script>