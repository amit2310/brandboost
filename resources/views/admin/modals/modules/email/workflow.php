<?php

if (!empty($oAutomationLists)) {
    foreach ($oAutomationLists as $oAutomationList) {
        $aListIDs[] = $oAutomationList->list_id;
    }
}

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
                <input type="hidden" name="action_automation_id" id="action_automation_id" value="<?php echo $oAutomations[0]->id; ?>" />
                <input type="hidden" name="automation_id" value="<?php echo $oAutomations[0]->id; ?>" />
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#EmailRequest" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> Email Request </a></li>
                        <li><a href="#SMSRequest" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> SMS Request </a></li>
                        <li><a href="#ConditionsWorkflow" data-toggle="tab"><i class="icon-database-edit2 position-left"></i> Conditions & Workflow </a></li>
                    </ul>
                    <div class="tab-content">
                        <!--########################TAB 0 ##########################-->
                        <div class="tab-pane active" id="EmailRequest">
                            <div class="row">
                                <?php foreach ($oDefaultTemplates as $oDefaultTemplate) { ?>
                                    <div class="col-md-6">
                                        <div template_id="<?php echo $oDefaultTemplate->id; ?>" template_type='email' class="panel bg-primary actionpanel openTemplate">
                                            <div class="panel-body">
                                                <div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
                                                <div class="media-left">
                                                    <h6><?php echo $oDefaultTemplate->template_name; ?></h6>
                                                    <p><?php echo $oDefaultTemplate->template_subject; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>								
                            </div>
                        </div>
                        <!--########################TAB 0 ##########################-->
                        <div class="tab-pane" id="SMSRequest">
                            <div class="row">
                                <?php foreach ($oDefaultSMSTemplates as $oDefaultSMSTemplate) { ?>
                                    <div class="col-md-6">
                                        <div template_id="<?php echo $oDefaultSMSTemplate->id; ?>" template_type='sms' class="panel bg-primary actionpanel openTemplate">
                                            <div class="panel-body">
                                                <div class="media-left"> <img src="<?php echo site_url('assets/images/smsicon.png'); ?>" style="width: 40px;"> </div>
                                                <div class="media-left">
                                                    <h6><?php echo $oDefaultSMSTemplate->template_name; ?></h6>
                                                    <p><?php echo $oDefaultSMSTemplate->template_subject; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div> 
                        <!--########################TAB 0 ##########################-->

                        <!--########################TAB 1 ##########################-->
                        <div class="tab-pane" id="ConditionsWorkflow">
                            <div class="row">
                                <div class="col-md-12 txt_inp_grp">
                                    <form  method="post" name="eventFrmUpdate" class="eventFrmUpdate">
                                        <div style="float:left; width: 100%;">
                                            <h6 style="margin:8px 10px 0 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
                                            <input id="delay_value" name="delay_value" value="10" class="delay_value form-control required mbot25 input-circle ui-wizard-content" type="text">
                                            <div style="display: inline-block; width: 120px; margin: 0 12px; float: left;" class="form-group waittimeselect">
                                                <select id="delay_unit" name="delay_unit" control_id="pl3" class="selectbox">
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

                                            <h6 id="pl3" style="margin:8px 0px 0 0!important; font-size: 13px; float: left; display:none;">
                                                <div class="input-group mt-15 timeselector">
                                                    <span class="pull-right" style="margin-right:10px;">Select Time of delivery </span><span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                    <input type="text" name="delay_time" id="anytime-time-hours1" value="9 PM" style="max-width: 138px;min-height:33px;padding-left:10px;">
                                                </div>
                                            </h6>
                                            <!--<button class="btn bl_cust_btn updateevent ui-wizard-content ui-formwizard-button"  type="submit" value="Next">Update</button>-->
                                        </div>

                                </div>
                                <div class="col-md-12 text-right mt-20">
                                    <input type="hidden" name="automation_id" value="<?php echo $oAutomations[0]->id; ?>" />
                                    <input name="event_id" id="event_id" value="<?php echo $oMainEvent->automation_event_id; ?>" type="hidden">
                                    <button type="submit" class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Save</button>
                                </div>
                                </form>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add / Edit Email Template</h5>
            </div>
            <div class="modal-body template_edit">
                <form method="post" class="form-horizontal"  action="javascript:void();">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="temp_left_option p15">

                                <div class="form-group">
                                    <label>Preview Language: </label>
                                    <select class="form-control"><option>English (USA)</option></select>
                                </div>

                                <h6>Customize Content</h6>
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
                            <button class="btn pull-right bl_cust_btn btn-success" id="updateEmailCampaign" type="submit"><i class="fa fa-plus"></i> &nbsp; Save</button>
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
    <div class="modal-dialog modal-lg" style="max-width: 760px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-eye"></i>&nbsp; Preview Email Template</h5>
            </div>
            <div class="modal-body template_edit" id="previewtempBodyView">

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
                                    <label>Body: </label>
                                    <textarea style="height: 200px;" name="smsTemplateContent" id="smsTemplateContent" class="form-control" placeholder="A collection of textile samples lay spread out on the table.."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mobile_sms_bkg">
                                <div class="smsbubble" id="smsTemplateContentPreview">
                                    Created: May 28, 2018 03:50 PM (1 week ago)<br>A collection of textile samples lay spread out on the table..A collection of textile samples lay spread out on the table..
                                </div>	
                            </div>
                        </div>

                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="campaignEventID" id="campaignEventID" value="">
                            <button class="btn pull-right bl_cust_btn btn-success" id="updateSmsCampaign" type="submit"><i class="fa fa-plus"></i> &nbsp; Save</button>
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
                            <div class="smsbubble" id="smspreivewcontent">
                                Created: May 28, 2018 03:50 PM (1 week ago)<br>A collection of textile samples lay spread out on the table..A collection of textile samples lay spread out on the table..
                            </div>	
                        </div>
                    </div>

                    <div class="col-md-12 text-right mt-20">
                        <button class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Edit</button>
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

                                <h6 id="pl2" style="margin:8px 0px 0 0!important; font-size: 13px; float: left; display:none;">
                                    <div class="input-group mt-15 timeselector">
                                        <span class="pull-right" style="margin-right:10px;">Select Time of delivery </span><span class="input-group-addon"><i class="icon-watch2"></i></span>
                                        <input type="text" name="delay_time" id="anytime-time-hours2" value="9 PM" style="max-width: 138px;min-height:33px;padding-left:10px;">
                                    </div>
                                </h6>
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
                                    <?php
                                    foreach ($subscribersData as $key => $subData) {
                                        $srNo = $key + 1;
                                        ?>
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
                                    <?php
                                    foreach ($subscribersData as $key => $subData) {
                                        $srNo = $key + 1;
                                        ?>
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

<div id="chooselistModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-eye"></i>&nbsp; Contact List</h5>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" id="frmSaveAutomationList" action="javascript:void();">
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control" name="selectedLists[]" multiple="multiple" required="required">
                                <option>Choose Lists</option>
                                <?php
                                if (!empty($oLists)):
                                    $newolists = array();

                                    foreach ($oLists as $key => $value) {
                                        $newolists[$value->id][] = $value;
                                    }
                                    
                                    foreach ($newolists as $oList):
                                        $totalElement = count($oList);
                                        $oList = $oList[0];
                                        if (!empty($oList->l_list_id)) {
                                            $totAll = $totalElement;
                                        } else {
                                            $totAll = 0;
                                        }
                                        ?>
                                        <option value="<?php echo $oList->id; ?>" <?php if (in_array($oList->id, $aListIDs)): ?> selected="selected"<?php endif; ?>><?php echo $oList->list_name . ' (' . $totAll . ' Contacts)'; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="automation_id" value="<?php echo $oAutomations[0]->id; ?>" />
                            <button type="submit" class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Save</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<div id="chooseEventModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-eye"></i>&nbsp; Add New Trigger</h5>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" id="frmSaveAutomationTrigger" action="javascript:void();">
                    <div class="row">
                        <div class="wrapper_outer" style="position:relative; clear:both; padding:30px 10px">

                            <div class="col-md-6">
                                <div class="mt-radio-inline ">
                                    <label class="mt-radio">
                                        <input type="radio" name="triggerName" id="optionsRadios1" value="specific-datetime" <?php if ($oMainEvent->event_type == 'specific-datetime'): ?> checked="checked" <?php endif; ?>>
                                        <strong>Immediately or on a specific date </strong> <span></span> </label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mt-radio-inline ">
                                    <label class="mt-radio">
                                        <input type="radio" name="triggerName" id="optionsRadios4" value="list-subscription" <?php if ($oMainEvent->event_type == 'list-subscription'): ?> checked="checked" <?php endif; ?>>
                                        <strong>Event based: list subscription   </strong> <span></span> </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-radio-inline ">
                                    <label class="mt-radio">
                                        <input type="radio" name="triggerName" id="optionsRadios5" value="list-unsubscription" <?php if ($oMainEvent->event_type == 'list-unsubscription'): ?> checked="checked" <?php endif; ?>>
                                        <strong>Event based: list unsubscription    </strong> <span></span> </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mt-radio-inline activeTrigger">
                                    <label class="mt-radio">
                                        <input type="radio" name="triggerName" id="optionsRadios14" value="tag-detected" <?php if ($oMainEvent->event_type == 'tag-detected'): ?> checked="checked" <?php endif; ?>>
                                        <strong>Tag Detected</strong> <span></span> </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="clearfix"></div>

                            <div class="tab-pane active" id="specific-datetime" <?php if ($oMainEvent->event_type == 'specific-datetime'): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?> >
                                <div class="row">
                                    <div class="col-md-12 txt_inp_grp">

                                        <div class="col-md-12">
                                            <p class="mbot15"><strong> Send on * </strong></p>
                                        </div>                       
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" name="delivery_date" class="form-control daterange-single" value="<?php echo (!empty($aMainTriggerData->delivery_date)) ? $aMainTriggerData->delivery_date : date("m/d/Y"); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                <input type="text" class="form-control" id="anytime-time-hours4" name="delivery_time" value="<?php echo (!empty($aMainTriggerData->delivery_time)) ? $aMainTriggerData->delivery_time : '9 PM'; ?>" style="min-height:33px;padding-left:10px;">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="clearfix"></div>

                            </div>


                            <div class="tab-pane active ConditionsWorkflow" id="ConditionsWorkflow" <?php if ($oMainEvent->event_type == 'specific-datetime'): ?> style="display:none;" <?php else: ?> style="display:block;" <?php endif; ?>>
                                <div class="row">
                                    <div class="col-md-12 txt_inp_grp">

                                        <div style="float:left; width: 100%;">
                                            <h6 style="margin:8px 10px 0 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
                                            <input id="delay_value" name="delay_value" value="<?php echo ($aMainTriggerData->delay_value) ? $aMainTriggerData->delay_value : '10'; ?>" class="delay_value form-control required mbot25 input-circle ui-wizard-content" type="text" required="required">
                                            <div style="display: inline-block; width: 120px; margin: 0 12px; float: left;" class="form-group waittimeselect">
                                                <select id="delay_unit" name="delay_unit" control_id="pl1" class="selectbox">
                                                    <option value="minute" <?php if ($aMainTriggerData->delay_unit == 'minute'): ?> selected="selected" <?php endif; ?>>Minute(s)</option>
                                                    <option value="hour" <?php if ($aMainTriggerData->delay_unit == 'hour'): ?> selected="selected" <?php endif; ?>>Hour(s)</option>
                                                    <option value="day" <?php if ($aMainTriggerData->delay_unit == 'day'): ?> selected="selected" <?php endif; ?>>Day(s)</option>
                                                    <option value="week" <?php if ($aMainTriggerData->delay_unit == 'week'): ?> selected="selected" <?php endif; ?>>Week(s)</option>
                                                    <option value="month" <?php if ($aMainTriggerData->delay_unit == 'month'): ?> selected="selected" <?php endif; ?>>Month(s)</option>
                                                    <option value="year" <?php if ($aMainTriggerData->delay_unit == 'year'): ?> selected="selected" <?php endif; ?>>Year(s)</option>
                                                </select>
                                            </div>
                                            <h6 style="margin:8px 0px 0 0!important; font-size: 13px; float: left;  ">
                                                after the event is triggered                                            </h6>


                                            <div class="eventDiv" style="float:left;display:none; ">
                                                <select id="event_type" name="event_type" class="form-control camp" style="width:120px;">
                                                    <option value="sent" <?php if ($aMainTriggerData->delay_type == 'sent'): ?> selected="selected" <?php endif; ?>>sent</option>
                                                    <option value="opened" <?php if ($aMainTriggerData->delay_type == 'opened'): ?> selected="selected" <?php endif; ?>>opened</option>
                                                    <option value="not opened" <?php if ($aMainTriggerData->delay_type == 'not opened'): ?> selected="selected" <?php endif; ?>>not opened</option>
                                                    <option value="clicked" <?php if ($aMainTriggerData->delay_type == 'clicked'): ?> selected="selected" <?php endif; ?>>clicked</option>
                                                    <option value="not clicked" <?php if ($aMainTriggerData->delay_type == 'not clicked'): ?> selected="selected" <?php endif; ?>>not clicked</option>
                                                </select>
                                            </div>
                                            <h6 id="pl1" style="margin:8px 0px 0 0!important; font-size: 13px; float: left; <?php echo $aMainTriggerData->delay_unit == 'day' || $aMainTriggerData->delay_unit == 'week' ? 'display:block' : 'display:none'; ?>;">
                                                <div class="input-group mt-15 timeselector">
                                                    <span class="pull-right" style="margin-right:10px;">Select Time of delivery </span><span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                    <input type="text" id="anytime-time-hours3" name="delay_time" value="<?php echo (!empty($aMainTriggerData->delay_time)) ? $aMainTriggerData->delay_time : '9 PM'; ?>" style="max-width: 138px;min-height:33px;padding-left:10px;">
                                                </div>
                                            </h6>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="automation_id" value="<?php echo $oAutomations[0]->id; ?>" />
                            <input name="event_id" id="event_id" value="<?php echo $oMainEvent->automation_event_id; ?>" type="hidden">
                            <button type="submit" class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Save</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>
</div>