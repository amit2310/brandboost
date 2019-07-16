<?php
foreach ($oEvents as $key => $oEvent) {

    $aEventData = json_decode($oEvent->data);


    $previousID = $oEvent->previous_event_id;
    $currentID = $oEvent->id;
    $currentEventType = $oEvent->event_type;
    $currentEventIndex = array_keys($oEventsType, $currentEventType);
    if (array_key_exists($currentEventIndex[0] + 1, $oEventsType)) {
        $nextEventType = $oEventsType[$currentEventIndex[0] + 1];
    } else {
        $nextEventType = $currentEventType;
    }
}
?>
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