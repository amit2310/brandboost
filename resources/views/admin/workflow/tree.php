<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/touchspin.min.js"></script>
<style>
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

//get Twilio Account Details

$oUser = getLoggedUser();
$userID = $oUser->id;
if($userID>0){
    $oTwilioAc = $this->mInviter->getTwilioAccount($userID);
    
}

?>
<div class="">
    <div class="row">
        <!-- Draw graph  -->
        <?php //$this->load->view("admin/workflow/partials/workflow-graph.php", $aCampaignStats); ?>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat workflow_main_box">
                <div style="border-bottom: 1px solid #eee!important;" class="panel-heading bkg_grey_light">
                    <h6 class="panel-title">Workflow</h6>

                </div>
                <div class="panel-body p40 pb20 min_h290 email_workflow_sec new">
                    <a id="wf_fs" class="workflow_fs_icon"><img src="<?php echo base_url(); ?>assets/images/fs_icon.png"/></a>


                    <!-- Timeline -->
                    <div class="timeline timeline-center">
                        <div class="timeline-container">

                            <!-- Sales stats -->
                            <div class="timeline-row post-full">




                                <div class="timeline-date button">

                                    <button type="button" class="btn white_btn <?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><span class="txt_grey"></span> New Contact 
                                        <?php
                                        if (count($oAutomationLists)) {
                                            $bListAdded = true;
                                            echo '<br>(' . count($oAutomationLists) . ' List added)';
                                        }
                                        ?>
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
                                        <button class="btn btn-xs btn_white_table smallbtn rounded addWorkflowNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $oEventsType[0]; ?>" data-node-type="main"><i class="icon-plus3"></i></button>
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
                                                'oTwilioAc' => $oTwilioAc,
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
                                            <div class="timeline-date button mb0">
                                                <img src="<?php echo base_url(); ?>assets/images/timeline_bot_border_grey.png"/>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($bMulitpleBranches == false): ?>
                                            <div class="timeline-date button mt20 mb40">
                                                <button class="btn btn-xs btn_white_table smallbtn rounded addWorkflowNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" data-node-type="followup"><i class="icon-plus3"></i></button>
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
                                        <button class="btn btn-xs btn_white_table smallbtn rounded addWorkflowNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $oEventsType[0]; ?>" data-node-type="main"><i class="icon-plus3"></i></button>
                                    </div>
                                <?php endif; ?>

                                <div  class="timeline-date button mt30 mb0">
                                    <button type="button" class="btn white_btn"><span class="txt_grey"></span>&nbsp;Success </button>
                                    <a class="icons iconsab green2 br8 t30" href="#"><img src="<?php echo base_url(); ?>assets/images/green_check_round.png"></a>
                                </div>



                            </div>
                            <!-- /sales stats -->



                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix text-right">
                            <!--------zoom ------>
                            <input type="text" value="55" class="touchspin-postfix">  
                            <!--------Back ------>        
                            <div class="workflow_back">
                                <div class="input-group">
                                    <span class="input-group-btn">	
                                        <button class="btn btn-default btn-icon" type="button"><i class=""><img src="<?php echo base_url(); ?>assets/images/back_tek_icon_grey.png"/></i></button>
                                    </span>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-icon" type="button"><i class=""><img src="<?php echo base_url(); ?>assets/images/back_icon_grey.png"/></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>



                        <!--------Back ------>  


                    </div>
                    <!-- /timeline -->
                    <div class="workflow_option hide">
                        <ul>
                            <li><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/wf_opt_icon1.png"/></a>
                                <ul class="dropdown-menu dropdown-menu-right wf_dropdown action_box_new nodes">
                                    <div class="profile_headings m0 mb10">TRIGGERS </div>
                                    <li><a href="javascript:void(0);" class="<?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><span class="icons br8 grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"></span>New Contacts </a></li>
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

            </div>

        </div>
        <div class="col-md-3" id="sidebar_statc">

            <?php $this->load->view('admin/workflow/partials/main-right-menu', array('aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType)); ?>

            <?php $this->load->view('admin/workflow/partials/email-menu', array('aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType)); ?>

            <?php $this->load->view('admin/workflow/partials/sms-menu', array('aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType)); ?>

            <?php $this->load->view('admin/workflow/partials/timer-menu', array('aEventData' => $aEventData, 'previousID' => $previousID, 'currentID' => $currentID, 'nextEventType' => $nextEventType)); ?>


        </div>

    </div>



</div>
<?php $this->load->view("admin/modals/segments/segments-popup");?>
<script src="<?php echo base_url(); ?>assets/js/modules/segments/segments.js" type="text/javascript"></script>

<?php //$this->load->view("admin/modals/workflow/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates));        ?>
<script>
    var site_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/modules/workflow/workflow.js" type="text/javascript"></script>
<script>
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

	
	
	$( window ).scroll( function () {
			var sc22 = $( window ).scrollTop();
			if ( sc22 > 100 ) {
				$( "#sidebar_statc" ).addClass( "sidebarstatictop" );
			} else {
				$( "#sidebar_statc" ).removeClass( "sidebarstatictop" );
			}
		} );
	




    // Postfix
    $(".touchspin-postfix").TouchSpin({
        min: 0,
        max: 100,
        step: 10,
        decimals: 0,
        postfix: '%'
    });



    $(document).ready(function () {
        $("#wf_fs").click(function () {
            $(".workflow_main_box").toggleClass("workflow_fs");
            //$("body").css("overflow", "hidden");
            $("body").toggleClass("ovf_hide");

            $(".workflow_option").toggleClass('hide');
        });
    });




    $(".wfLoadEmailNodeProperty").click(function () {
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
            data: {moduleName: moduleName, moduleUnitId:moduleUnitId, eventId:eventId, campaign_id: campaign_id},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wfEmailStats").html(data.stats);
                    $("#wf_delete_event").attr('event_id', eventId);
                    $("#wf_delete_event").attr('modulename', moduleName);
                    $("#wf_email_preview").attr('campaign_id', campaign_id);
                    $("#wf_email_preview").attr('event_id', eventId);
                    $("#wf_email_preview").attr('modulename', moduleName);
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

    $(".wfLoadSMSNodeProperty").click(function () {
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
            data: {moduleName: moduleName, campaign_id: campaign_id, moduleUnitId:moduleUnitId, eventId:eventId,},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wfSMSStats").html(data.stats);
                    $("#wf_delete_sms_event").attr('event_id', eventId);
                    $("#wf_delete_sms_event").attr('modulename', moduleName);

                    $("#wf_sms_preview").attr('event_id', eventId);
                    $("#wf_sms_preview").attr('modulename', moduleName);
                    $("#wf_sms_preview").attr('campaign_id', campaign_id);
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
                data: {moduleName: moduleName, campaignId: campaignId, moduleUnitId: moduleUnitId},
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
                            $("#wf_preview_edit_sms_template_content_popup").html(data.content);
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
            data: {moduleName: moduleName, subject: subject, greeting: greeting, introduction: introduction, template_source: template_source, campaignId: campaignId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('#workflow_edit_email_campaign_preview').modal('hide');
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
            data: {moduleName: moduleName, greeting: greeting, introduction: introduction, template_source: template_source, campaignId: campaignId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('#workflow_edit_sms_campaign_preview').modal('hide');
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
    });
    $(document).on("keyup", "#wf_preview_edit_template_introduction", function () {
        var introText = $(this).val();
        $("#wf_edit_template_introduction").text(introText);
    });

    $(document).on("keyup", "#wf_preview_edit_sms_template_greeting", function () {
        var greetText = $(this).val();
        $("#wf_edit_sms_template_greeting").text(greetText);
    });
    $(document).on("keyup", "#wf_preview_edit_sms_template_introduction", function () {
        var introText = $(this).val();
        $("#wf_edit_sms_template_introduction").text(introText);
    });


    $(".wf_timer").click(function () {
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

    $(document).on('blur', '#wf_timer_event_value', function () {
        var timerValue = $(this).val();
        var timerUnit = $("#wf_timer_event_unit").val();
        var eventID = $("#wf_timer_event_id").val();
        var moduleName = $("#wf_timer_moduleName").val();
        $.ajax({
            url: '/admin/workflow/updateEventTime',
            type: "POST",
            data: {event_id: eventID, delay_value: timerValue, delay_unit: timerUnit, event_type: 'sent', 'moduleName': moduleName},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wf_waitTime_" + eventID).html('<span class="txt_grey">Wait for</span> ' + timerValue + ' ' + timerUnit);
                    $("#wf_waitTime_" + eventID).attr('delay_value', timerValue);
                    $("#wf_waitTime_" + eventID).attr('delay_unit', timerUnit);
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
            data: {event_id: eventID, delay_value: timerValue, delay_unit: timerUnit, event_type: 'sent', 'moduleName': moduleName},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#wf_waitTime_" + eventID).html('<span class="txt_grey">Wait for</span> ' + timerValue + ' ' + timerUnit);
                    $("#wf_waitTime_" + eventID).attr('delay_value', timerValue);
                    $("#wf_waitTime_" + eventID).attr('delay_unit', timerUnit);

                }
            }
        });
    });

    $(document).on("click", "#wf_preview_edit_template_send_email", function () {
        var email = $("#wf_preview_edit_template_text_email").val();
        var campaignId = $("#wf_preview_edit_template_campaign_id").val();
        var moduleName = $("#wf_preview_edit_template_moduleName").val();
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestEmailworkflowCampaign',
            type: "POST",
            data: {'moduleName': moduleName, campaignId: campaignId, email: email},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });


    });
    
    $(document).on("click", "#wf_email_testEmailCtr,#wfPreviewTestCtrCancel", function(){
        $("#wfPreviewTestCtr").toggleClass('hidden');
    });
    
    $(document).on("click", "#wf_sms_testSMSCtr,#wfPreviewTestCtrSMSCancel", function(){
        $("#wfPreviewTestSMSCtr").toggleClass('hidden');
    });
    
    
    
    $(document).on("click", "#wfPreviewTestCtr_send_email", function () {
        var email = $("#wfPreviewTestCtr_text_email").val();
        var campaignId = $("#wf_email_preview").attr('campaign_id');
        var moduleName = $("#wf_email_preview").attr('modulename');
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestEmailworkflowCampaign',
            type: "POST",
            data: {'moduleName': moduleName, campaignId: campaignId, email: email},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited) 
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
            data: {'moduleName': moduleName, campaignId: campaignId, number: number},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test SMS sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });


    });
    
    
    $(document).on("click", "#wfPreviewTestCtr_send_sms", function () {
        var number = $("#wfPreviewTestCtr_text_number").val();
        var campaignId = $("#wf_sms_preview").attr('campaign_id');
        var moduleName = $("#wf_sms_preview").attr('modulename');
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/sendTestSMSworkflowCampaign',
            type: "POST",
            data: {'moduleName': moduleName, campaignId: campaignId, number: number},
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
            data: {'moduleName': moduleName, campaignId: campaignId, number: number},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', 'Success', 'Test SMS sent successfully'); //javascript notification msg (edited) 
                    $('.overlaynew').hide();
                }
            }
        });


    });


    $('.addWorkflowNewEvent').click(function () {

        var actionid = $(this).attr('previous_event_id');
        var currentid = $(this).attr('current_event_id');
        var eventtype = $(this).attr('event_type');
        var nodetype = $(this).attr('data-node-type');
        var tabtype = $(this).attr('data-tab-type');
        $("#wf_new_action_previous_id").val(actionid);
        $("#wf_new_action_current_id").val(currentid);
        $("#wf_new_action_event_type").val(eventtype);
        $("#wf_new_action_node_type").val(nodetype);
        resetAddNewWorkFlowNodePopup();
        $("#wf_NewAddaction").modal();
        if (tabtype == 'email') {
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').tab('show');
//            $('.nav-tabs a[href="#chooseWorkflowSMS"]').tab('hide');
            $('.nav-tabs a[href="#chooseWorkflowSMS"]').hide();
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').show();
        } else if (tabtype == 'sms') {

            $('.nav-tabs a[href="#chooseWorkflowSMS"]').tab('show');
//            $('.nav-tabs a[href="#chooseWorkflowEmail"]').tab('hide');
            $('.nav-tabs a[href="#chooseWorkflowSMS"]').show();
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').hide();
        } else {
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').tab('show');
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').show();
            $('.nav-tabs a[href="#chooseWorkflowSMS"]').show();
        }

    });

    $(document).on("click", "#createNewWorkflowEventNode", function (e) {
        e.preventDefault();
        //check which email template selected
        var emailTemplateId = $("select[name='selectNewWorkflowEmailTemplate']").val();

        var smsTemplateId = $("select[name='selectNewWorkflowSMSTemplate']").val();

        var delayVal = $("input[name='new_delay_value']").val();
        var delayUnit = $("select[name='new_delay_unit']").val();

        //alert('Email Template Id ' + emailTemplateId + ' Sms Template Id '+ smsTemplateId + ' Delay Val ' + delayVal + ' Delay Unit ' + delayUnit);
        //return false;
        //var templateId = $(this).attr('template_id');
        var previousID = $("#wf_new_action_previous_id").val();
        var currentID = $("#wf_new_action_current_id").val();
        var event_type = $("#wf_new_action_event_type").val();
        var node_type = $("#wf_new_action_node_type").val();
        var moduleName = $("#wf_new_action_moduleName").val();
        var moduleUnitId = $("#wf_new_action_module_unit_id").val();
        $('.overlaynew').show();
        $.ajax({
            url: '/admin/workflow/addWorkflowEventToTreeNew',
            type: "POST",
            data: {moduleName: moduleName, moduleUnitId: moduleUnitId, previous_event_id: previousID, emailTemplateId: emailTemplateId, smsTemplateId: smsTemplateId, delayVal: delayVal, delayUnit: delayUnit, 'current_event_id': currentID, 'event_type': event_type, node_type: node_type},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {

                    window.location.href = window.location.href;
                    $('.overlaynew').hide();

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

    function resetAddNewWorkFlowNodePopup() {
        $("select[name='selectNewWorkflowEmailTemplate']").val('');
        $("select[name='selectNewWorkflowSMSTemplate']").val('');

    }




    $(".backtoMenu").click(function () {
        clearAllActive();
        clearAllMenu();
        $(".wfSwitchMenu").hide();
        $("#wfMainRightMenu").show();
    });

    function clearAllActive() {
        $(".wf_timer").removeClass('active_btn');
        $(".top_box").removeClass('active_sms');
        $(".top_box").removeClass('active_state');
        $("#wfMainRightMenu").show();

    }

    function clearAllMenu() {
        $("#wfMainRightMenu").show();
        $("#wfEmailMenu").hide();
        $("#wfSMSMenu").hide();
        $("#wfTimerMenu").hide();
        $("select[name='wfEmailMenuCampaign']").val('');
        $("select[name='wfSMSMenuCampaign']").val('');
    }



</script>

