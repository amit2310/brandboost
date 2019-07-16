<div class="panel panel-flat wfSwitchMenu" id="wfMainRightMenu">
    <div class="panel-heading">
        <h6 class="panel-title">Nodes</h6>

    </div>
    <div class="panel-body p20 pt0 bkg_white">
        <div class="profile_headings m0 mb10">TRIGGER  <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
        <ul class="action_box_new nodes">
            <li><a href="javascript:void(0);" class="<?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" ><span class="icons br8 grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"/></span>New Contacts </a></li>
            <li><a href="#"><span class="icons br8 grd_bkg_green2"><img src="<?php echo base_url(); ?>assets/images/menu_icons/List_Light.svg"/></span>Form Submitted </a></li>
            <li><a href="javascript:void(0);" <?php if ($oEvent->id > 0): ?>class="wf_timer"<?php endif; ?> style="cursor:pointer;" event_id="<?php echo $oEvent->id; ?>" delay_value="<?php echo $aEventData->delay_value == '' ? '10' : $aEventData->delay_value; ?>" delay_unit="<?php echo $aEventData->delay_unit == '' ? 'minute' : $aEventData->delay_unit; ?>" delay_time="<?php echo!empty($aEventData->delay_time) ? $aEventData->delay_time : '9 PM'; ?>"><span class="icons br8 grd_bkg_purple"><img src="<?php echo base_url(); ?>assets/images/clock_white14.png"></span>Time Trigger </a></li>
        </ul>

        <div class="profile_headings m0 mb10">ACTIONS  <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
        <ul class="action_box_new nodes">
            <li><a href="#"><span class="icons grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"/></span>Add to list </a></li>
            <li><a href="#accordion-control-group2" data-toggle="collapse" data-parent="#accordion-control" data-tab-type="email" class="addWorkflowNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" <?php if ($oEvent->id > 0): ?>data-node-type="followup"<?php else: ?>data-node-type="main"<?php endif; ?>><span class="icons grd_bkg_green2"><img src="<?php echo base_url(); ?>assets/images/menu_icons/Email_Light.svg"/></span>Send email </a></li>
            <li><a href="#accordion-control-group3" data-toggle="collapse" data-parent="#accordion-control" data-tab-type="sms" class="addWorkflowNewEvent" previous_event_id="<?php echo $previousID; ?>" current_event_id="<?php echo $currentID; ?>" event_type="<?php echo $nextEventType; ?>" <?php if ($oEvent->id > 0): ?>data-node-type="followup"<?php else: ?>data-node-type="main"<?php endif; ?>><span class="icons grd_bkg_green"><img style="width: 12px;" src="<?php echo base_url(); ?>assets/images/menu_icons/BrandPage_Light.svg"/></span>Send sms </a></li>
            <li><a href="#"><span class="icons grd_bkg_green2"><i class="icon-bell2"></i></span>Send notification </a></li>
            <li><a href="#"><span class="icons grd_bkg_red"><img src="<?php echo base_url(); ?>assets/images/menu_icons/Website_Light.svg"/></span>Show site widget </a></li>
        </ul>

        <div class="profile_headings m0 mb10">RULES  <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
        <ul class="action_box_new nodes">
            <li><a href="#"><span class="icons grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/List_Light.svg"/></span>Field </a></li>
            <li><a href="#"><span class="icons grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/Tags_Light.svg"/></span>Tag </a></li>
        </ul>

        <div class="profile_headings m0 mb10">FLOW  <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
        <ul class="action_box_new nodes mb0">
            <li class="mb0"><a href="#"><span class="icons grd_bkg_purple"><img src="<?php echo base_url(); ?>assets/images/split_icon.png"/></span>Split </a></li>
        </ul>




    </div>
</div>