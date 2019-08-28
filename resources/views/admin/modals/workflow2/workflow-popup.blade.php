<style>
    .mobile_sms_bkg {
        background: url(<?php echo base_url(); ?>assets/images/iphone.png) center top no-repeat;
        width: 357px;
        height: 716px;
        margin: 0 auto;
        padding: 70px 40px;
    }
    .btn.dark_btn{
        color:#fff !important;
    }
</style>
<style>
    .email_editor_left, .email_editor_right{ background: #fff; padding: 0; border-radius: 5px!important; min-height: 800px;}

    .email_editor_left .form-group{margin-bottom: 8px}
    .email_editor_left .open_editor {color: #2b97dd;position: absolute;	top: 43px;	z-index: 9;	left: 20px; border-bottom: 1px solid #ebeff6; padding-bottom: 10px; display: block; min-width: 277px;}
    .email_preview_sec{background: #f4f6fa; padding: 30px; min-height: 677px;}
    .email_preview_sec .email_content{  width: 100%;   box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);  background-color: #fff;  margin-bottom: 10px; border-radius: 4px; text-align: center; padding-bottom: 30px;}
    .email_preview_sec .email_content .blue_header{  width: 100%; border-radius: 4px 4px 0 0;  height: 74px;  box-shadow: 0 1px 1px 0 rgba(43, 151, 221, 0.2), 0 2px 4px 0 rgba(43, 151, 221, 0.04), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 0.1);  background-image: linear-gradient(to bottom, #2eb4dd, #2779dc);}
    .email_preview_sec .email_content img.company{  width: 66.7px;  height: 66.7px;  box-shadow: 0 3px 0 0 rgba(0, 0, 0, 0.09); border-radius: 100px; margin-top: -33px; }
    .email_preview_sec .email_content h2{margin: 20px 0 13px 0; font-size: 14px; font-weight: 500;}
    .email_preview_sec .email_content .fa.fa-star{font-size: 40px; color: #f4f6fa; margin: 0 8px;}
    .email_preview_sec .email_content .fa.fa-star.active{color: #46a9f6}
    .email_preview_sec .email_foot p{ font-size: 7px; color: #79828b; font-family: arial; text-align: center;}

    .email_editor .inner_sec_email_edit{ background: #fff; padding: 0; border-radius: 5px!important;}
    .modal-body .editor_btn .btn.btn-xs.btn_white_table {	margin: 0 10px 0px 0 !important;}
    .preview_switch{position: absolute; right: 20px; top: 21px;}
    .preview_switch_icon{background: #fff; border-radius: 4px; width: 22px; height: 22px; display: inline-block; text-align: center; line-height: 23px; color: #ddd; font-size: 11px;}
    .preview_switch_icon i{font-size: 11px;}
    .preview_switch_icon.active{color: #96ccee; background: #eef7fd}

    ul.editor_text_option{margin: 0; padding: 0; }
    ul.editor_text_option li{list-style: none;margin: 0 17px 0 0; padding: 0 17px 0 0; display: inline-block; font-size: 14px; color: #202040; border-right: 1px solid #eee;}
    ul.editor_text_option li a{color: #7a8dae!important; font-size: 14px; font-weight: 600; padding: 0 7px;}
    ul.editor_text_option li a i{font-size: 13px!important}
    ul.editor_text_option li select{border: none; -webkit-appearance: none;   -moz-appearance:none;   appearance:none; width: 75px; background: url(assets/images/select_bkg.png) right 10px no-repeat #fff; }
    ul.editor_text_option li:last-child{border: none!important; margin: 0; padding: 0;}
</style>

<?php
$aUser = getLoggedUser();
$userID = $aUser->id;
$aListIDs = array();
if (!empty($oAutomationLists)) {
    foreach ($oAutomationLists as $oAutomationList) {
        $aListIDs[] = $oAutomationList->list_id;
    }
}
?>

<div id="chooselistModal" class="modal fade">
    <div class="modal-dialog modal-lg">
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
						
                            <input type="hidden" name="automation_id" value="<?php echo (!empty($oAutomations)) ? $oAutomations[0]->id : 0; ?>" />
                            <button type="submit" class="btn dark_btn"><i class="fa fa-edit"></i> &nbsp; Save</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="workflow_sms_template_stripo_modal" class="modal fade">
    <div style="width:65%;" class="modal-dialog modal-lg">
        <div class="email_preview_modal">
            <div class="modal-body p0 mt0 br5">
                <div class="row">
                    <div class="col-md-4 pr0">
                        <div class="email_editor_left" style="max-height:800px;overflow:auto;">
                            <div class="p20 bbot"><p class="m0 txt_dark fw500">SMS Configuration</p></div>
                            <div class="p20">
                                <div class="form-group">
                                    <label class="">SMS template</label>
                                    <select name="template_source" id="wf_preview_edit_sms_template_source" class="form-control h52" disabled="disabled">

                                        <?php
                                        foreach ($oDefaultTemplates as $oTemplate) {
                                            if (($oTemplate->status == '1') && ($oTemplate->template_type == 'sms' || $oTemplate->template_type == 'Sms')):
                                                ?>
                                                <option value="<?php echo $oTemplate->id; ?>"><?php echo $oTemplate->template_name; ?></option>
                                                <?php
                                            endif;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group bbot pb20">
                                    <label class="">Language</label>
                                    <select class="form-control h52">
                                        <option>English USA</option>

                                    </select>
                                </div>

                                <div class="form-group mb0">
                                    <label class="">Content</label>
                                    <a class="fsize14 open_editor" href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                    <textarea name="smsWorkflowCampaignBody" id="smsWorkflowCampaignBody" style="min-height: 370px; resize: none; padding-top: 58px!important;" class="form-control p20 fsize12">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both. 

    But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                </div>
                                <?php if (!empty($oCampaignTags)): ?>
                                    <div class="form-group" style="display:none;">
                                        <div class="note-btn-group btn-group note-view">
                                            <?php foreach ($oCampaignTags as $oTags): ?>
                                                <button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo $oTags; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo $oTags; ?></button>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="p20 pt0" id="wfSMSActiveCtrEdit">

                                <input type="hidden" name="wf_editor_campaign_id" id="wf_sms_editor_campaign_id" value="">
                                <input type="hidden" name="wf_editor_moduleName" id="wf_sms_editor_moduleName" value="<?php echo $moduleName; ?>">
                                <button type="button" id="updateWorkflowSmsCampaign" class="btn dark_btn h40 bkg_bl_gr">Save</button>
                                <a href="javascript:void(0);" id="wfOpenSMSTestCtrEdit" class="btn btn-link fsize14">Send test sms</a>

                            </div>
                            <div class="p20 pt0" id="wfSMSTestCtrEdit" style="display:none;">
                                <input type="text" class="mr20" id="wf_preview_edit_sms_template_text_number_Edit" placeholder="Phone Number" value="<?php echo $aUser->mobile; ?>" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" /> 
                                <button type="button" id="wf_preview_edit_sms_template_send_sms_Edit" class="btn dark_btn h40 bkg_bl_gr">Send</button>
                                <a href="javascript:void(0);" id="wfCloseSMSTestCtrEdit" class="btn btn-link fsize14">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 pl3">
                        <div class="email_editor_right preview" style="max-height:800px;overflow:auto;">
                            <div class="p20 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                <div class="preview_switch"><a href="#" class="preview_switch_icon active"><i class="icon-display"></i></a> <a href="#" class="preview_switch_icon"><i class="icon-iphone"></i></a></div>
                            </div>

                            <div class="panel panel-flat mb30">
                                <div class="sms_preview">
                                    <div class="phone_sms">
                                        <div class="inner">
                                            <p id="smsWorkflowCampaignPreview"></p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p><small><?php echo date("h:i") . ' ' . dataFormat(); ?></small></p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>    
    </div>
</div>


<div id="workflow_template_stripo_modal" class="modal fade">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Edit Email Template</h5>
            </div>
            <div class="modal-body template_edit">
                <form method="post" class="form-horizontal" action="javascript:void();">
                    <div class="row">
                        <div class="col-md-12">
                            <iframe src="" id="loadstripotemplate" width="100%" height="800"></iframe>
                        </div>

                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="wf_editor_campaign_id" id="wf_editor_campaign_id" value="">
                            <input type="hidden" name="wf_editor_moduleName" id="wf_editor_moduleName" value="<?php echo $moduleName; ?>">
<!--                            <button class="btn pull-right bl_cust_btn btn-success" type="submit" id="wf_update_editor_campaign" name="wf_update_editor_campaign"><i class="fa fa-plus"></i> &nbsp; Save</button>-->
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Workflow Email template_modal modal -->
<div id="workflow_template_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add / Edit Email Template</h5>
            </div>
            <div class="modal-body template_edit">
                <form method="post" class="form-horizontal" action="javascript:void();">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="temp_left_option p15">
                                <h6>Customize Content</h6>
                                <div class="form-group">
                                    <label>Subject: </label>
                                    <input class="form-control" id="wf_campaign_subject" name="wf_campaign_subject"  placeholder="Email Subject" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Content: </label>
                                    <textarea class="form-control wysihtml5 wysihtml5-default" id="wf_editor_campaign_content" name="wf_editor_campaign_content"  placeholder="A collection of textile samples lay spread out on the table.."></textarea>
                                </div>
                                <?php if (!empty($oCampaignTags)): ?>
                                    <div class="form-group">
                                        <div class="note-btn-group btn-group note-view">
                                            <?php foreach ($oCampaignTags as $oTags): ?>
                                                <button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo $oTags; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo $oTags; ?></button>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="switchbtn mb-20 text-center">
                                <button class="btn btn-success deSktop"><i class="fa fa-desktop"></i> &nbsp; Desktop Preview</button>&nbsp; &nbsp;
                                <button class="btn bl_cust_btn btn-success moBile"><i class="fa fa-mobile-phone"></i> &nbsp; Mobile Preview</button>
                            </div>

                            <div class="temp_left_option right" id="wf_campaign_content">

                            </div>
                        </div>


                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="wf_editor_campaign_id" id="wf_editor_campaign_id" value="">
                            <input type="hidden" name="wf_editor_moduleName" id="wf_editor_moduleName" value="<?php echo $moduleName; ?>">
                            <button class="btn pull-right bl_cust_btn btn-success" type="submit" id="wf_update_editor_campaign" name="wf_update_editor_campaign"><i class="fa fa-plus"></i> &nbsp; Save</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /large modal -->

<!-- WaitTime modal -->
<div id="wf_waitTime" class="modal fade" style="z-index:999999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-clock-o"></i>&nbsp; Wait Time Settings</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 txt_inp_grp">
                        <form method="post" name="wf_eventTimeUpdate" class="wf_eventTimeUpdate" action="javascript:void(0);">
                            @csrf
                            <div class="actionpanel mt20" style="float:left; width: 100%;">
                                <div class="panel-body">
                                    <h6 style="margin:8px 0px 20px 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
                                    <div class="clearfix"></div>
                                    <input style="display: inline-block; margin: 0 0px; float: left; width: 100px;" id="wf_delay_time_value" name="delay_value" value="10" class="delay_value form-control mbot25 input-circle ui-wizard-content" type="text">





                                    <div style="display: inline-block; width: 135px; margin: 0 20px; float: left;" class="form-group waittimeselect">
                                        <select id="wf_delay_time_unit" name="delay_unit" control_id="pl2" class="selectbox form-control">
                                            <option value="minute" selected="">Minute(s)</option>
                                            <option value="hour">Hour(s)</option>
                                            <option value="day">Day(s)</option>
                                            <option value="week">Week(s)</option>
                                            <option value="month">Month(s)</option>
                                            <option value="year">Year(s)</option>
                                        </select>
                                    </div>
                                    <h6 style="margin:8px 0px 0 0!important; font-size: 13px; float: left;  ">
                                        after the event is triggered                                            
                                    </h6>
                                    <div class="eventDiv" style="float:left;display:none; ">
                                        <select id="event_type" name="event_type" class="form-control camp" style="width:120px;">
                                            <option value="sent" selected="">sent</option>
                                            <option value="opened">opened</option>
                                            <option value="not opened">not opened</option>
                                            <option value="clicked">clicked</option>
                                            <option value="not clicked">not clicked</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 text-right mt-20">
                                <input name="event_id" id="wf_event_id_val" value="" type="hidden">
                                <input name="moduleName" id="moduleName" value="<?php echo $moduleName; ?>" type="hidden">
                                <button class="btn dark_btn ui-wizard-content ui-formwizard-button" type="submit">Update</button>

                                <h6 id="pl2" style="width:100%; margin-top:20px; display:none;">
                                    <div class="input-group mt-15 timeselector">
                                        <span class="pull-right" style="margin-right:10px;">Select Time of delivery </span><span class="input-group-addon"><i class="icon-watch2"></i></span>
                                        <input type="text" name="delay_time" id="anytime-time-hours2" value="9 PM" style="max-width: 138px;min-height:33px;padding-left:10px;">
                                    </div>
                                </h6>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /large modal -->


<!-- addnewaction modal -->
<div id="wf_addnewaction" class="modal fade" style="z-index:999999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add New Action</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="action_previous_id" id="wf_action_previous_id" />
                <input type="hidden" name="action_current_id" id="wf_action_current_id" />
                <input type="hidden" name="action_event_type" id="wf_action_event_type" />
                <input type="hidden" name="action_node_type" id="wf_action_node_type" />
                <input type="hidden" name="moduleName" id="wf_action_moduleName" value="<?php echo $moduleName; ?>" />
                <input type="hidden" name="moduleUnitID" id="wf_action_module_unit_id" value="<?php echo $moduleUnitID; ?>" />


                <div class="tabbable workflow-action-popup">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#chooseWorkflowEmail" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> Email Request </a></li>
                        <li><a href="#chooseWorkflowSMS" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> SMS Request </a></li>
                        <!-- <li><a href="#SendingOptions" data-toggle="tab"><i class="icon-rotate-cw position-left"></i> Sending Options </a></li> -->
                        <li><a href="#delayIntervalWorkflow" data-toggle="tab"><i class="icon-database-edit2 position-left"></i> Delay Interval </a></li>
                        <!--<li><a href="#Contacts" data-toggle="tab"><i class="icon-envelop2 position-left"></i> Contacts </a></li>-->
                    </ul>
                    <div class="tab-content">
                        <!--########################TAB 0 ##########################-->
                        <div class="tab-pane active" id="chooseWorkflowEmail">
                            <div class="row">
                                <br>
                                <?php
                                foreach ($oDefaultTemplates as $oTemplate) {
                                    if (($oTemplate->status == '1') && ($oTemplate->template_type == 'email' || $oTemplate->template_type == 'Email')):
                                        ?>
                                        <div class="col-md-6">
                                            <div template_id="<?php echo $oTemplate->id; ?>" class="primary actionpanel selectWorkflowTemplateTEMP">
                                                <label for="wf_action_email_<?php echo $oTemplate->id; ?>">
                                                    <div class="panel-body">
                                                        <input type="radio" name="selectWorkflowEmailTemplate" class="selectWorkflowEmailTemplate" id="wf_action_email_<?php echo $oTemplate->id; ?>" value="<?php echo $oTemplate->id; ?>" />
                                                        <div class="media-left"> <img src="<?php echo base_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
                                                        <div class="media-left">
                                                            <h6><?php echo $oTemplate->template_name; ?></h6>
                                                            <p><?php echo $oTemplate->template_subject; ?></p>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>
                                            <input type="hidden" value="" class="previousEventId" id="previousEventId_<?php echo $oTemplate->id; ?>">
                                        </div>
                                        <?php
                                    endif;
                                }
                                ?>
                                <div class="col-md-12 text-right mt20">
                                    <button class="btn btn-link mr20" id="btnWfEmailClear"><i class="icon-cross"></i> Clear</button>
                                    <a type="submit" class="btn dark_btn" id="btnWfEmailNext"><i class="fa fa-edit"></i><span>&nbsp; Next &nbsp;</span></a>
                                </div>
                            </div>

                        </div>
                        <!--########################TAB 1 ##########################-->
                        <div class="tab-pane" id="chooseWorkflowSMS">
                            <div class="row">
                                <br>
                                <?php
                                foreach ($oDefaultTemplates as $oTemplate) {
                                    if (($oTemplate->status == '1') && ($oTemplate->template_type == 'sms' || $oTemplate->template_type == 'Sms')):
                                        ?>
                                        <div class="col-md-6">
                                            <div template_id="<?php echo $oTemplate->id; ?>" class="primary actionpanel selectWorkflowTemplateTEMP">
                                                <label for="wf_action_sms_<?php echo $oTemplate->id; ?>">
                                                    <div class="panel-body">
                                                        <input type="radio" name="selectWorkflowSMSTemplate" class="selectWorkflowSMSTemplate" id="wf_action_sms_<?php echo $oTemplate->id; ?>"  value="<?php echo $oTemplate->id; ?>" />
                                                        <div class="media-left"> <img src="<?php echo base_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
                                                        <div class="media-left">
                                                            <h6><?php echo $oTemplate->template_name; ?></h6>
                                                            <p><?php echo $oTemplate->template_subject; ?></p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <input type="hidden" value="" class="previousEventId" id="previousEventId_<?php echo $oTemplate->id; ?>">
                                        </div>
                                        <?php
                                    endif;
                                }
                                ?>
                                <div class="col-md-12 text-right mt-20">
                                    <button class="btn btn-link mr20" id="btnWfSmsClear"><i class="icon-cross"></i> Clear</button>
                                    <a type="submit" class="btn dark_btn" id="btnWfSmsNext"><i class="fa fa-edit"></i> <span>&nbsp; Next &nbsp;</span></a>
                                </div>
                            </div>
                        </div> 
                        <!--########################TAB 2 ##########################-->
                        <div class="tab-pane" id="delayIntervalWorkflow">
                            <div class="row">
                                <div class="col-md-12 txt_inp_grp">
                                    <form  method="post" name="eventFrmUpdate" class="eventFrmUpdate">
                                        <div class="actionpanel mt20" style="float:left; width: 100%;">
                                            <div class="panel-body">
                                                <h6 style="margin:8px 0px 20px 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
                                                <div class="clearfix"></div>

                                                <input style="display: inline-block; margin: 0 0px; float: left; width: 100px;" id="wf_delay_time_value_2" name="delay_value" value="10" class="delay_value form-control required mbot25 input-circle ui-wizard-content" type="text">
                                                <div style="display: inline-block; width: 135px; margin: 0 20px; float: left;" class="form-group waittimeselect">
                                                    <select id="wf_delay_time_unit_2" name="delay_unit" class="selectbox form-control">
                                                        <option value="minute" selected="">Minute(s)</option>
                                                        <option value="hour">Hour(s)</option>
                                                        <option value="day">Day(s)</option>
                                                        <option value="week">Week(s)</option>
                                                        <option value="month">Month(s)</option>
                                                        <option value="year">Year(s)</option>
                                                    </select>
                                                </div>
                                                <h6 style="margin:8px 0px 0 0!important; font-size: 13px; float: left;  ">
                                                    after the event is triggered                                            
                                                </h6>



                                                <div class="eventDiv" style="float:left;display:none; ">
                                                    <select id="event_type" name="event_type" class="form-control camp" style="width:120px;">
                                                        <option value="sent" selected="">sent</option>
                                                        <option value="opened">opened</option>
                                                        <option value="not opened">not opened</option>
                                                        <option value="clicked">clicked</option>
                                                        <option value="not clicked">not clicked</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right mt-20">
                                            <input type="hidden" name="brandboost_id" value="<?php echo!empty($brandboostID) ? $brandboostID : ''; ?>" />
                                            <input name="event_id" id="event_id" value="<?php echo!empty($oMainEvent->id) ? $oMainEvent->id : ''; ?>" type="hidden">
                                            <button type="button" class="btn dark_btn" id="createNewWorkflowEvent"><i class="fa fa-edit"></i><span> &nbsp; Save</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--########################TAB 2 ##########################-->
                        <div class="tab-pane" id="Contacts">
                            <table class="table dtablenew media-library">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;"><input class=""  type="checkbox"></th>
                                        <th class="text-center">#No</th>
                                        <th>From</th>
                                        <th>Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($subscribersData)) {
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

                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>

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

<!-- preview static old email modal -->
<div id="workflow_email_campaign_preview" class="modal fade" style="z-index:999999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Preview</h5>
            </div>
            <div class="modal-body" style="min-height:500px;" id="wf_email_campaign_preview">

            </div>
        </div>
    </div>
</div>

<!-- preview static old sms modal -->
<div id="workflow_sms_campaign_preview" class="modal fade" style="z-index:999999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Preview</h5>
            </div>

            <div class="panel panel-flat mb30">
                <div class="sms_preview">
                    <div class="phone_sms">
                        <div class="inner">
                            <p id="wf_sms_campaign_preview"></p>
                        </div>
                        <div class="clearfix"></div>
                        <p><small><?php echo date("h:i") . ' ' . dataFormat(); ?></small></p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- preview email new modal -->
<div id="workflow_edit_email_campaign_preview" class="modal fade">
    <div class="modal-dialog modal-lg" style="width:65%;">
        <div class="email_preview_modal">
            <div class="modal-body p0 mt0 br5 ">
                <div class="row">
                    <div class="col-md-4 pr0">
                        <div class="email_editor_left">
                            <div class="p20 bbot"><p class="m0 txt_dark fw500">Email Configuration</p></div>
                            <div class="p20">
                                <!--                                <div class="form-group">
                                                                    <label class="">Email template</label>
                                                                    <select name="template_source" id="wf_preview_edit_template_source" class="form-control h52" disabled="disabled">
                                
                                <?php
                                foreach ($oDefaultTemplates as $oTemplate) {
                                    if (($oTemplate->status == '1') && ($oTemplate->template_type == 'email' || $oTemplate->template_type == 'Email')):
                                        ?>
                                                                                        <option value="<?php echo $oTemplate->id; ?>"><?php echo $oTemplate->template_name; ?></option>
                                        <?php
                                    endif;
                                }
                                ?>
                                                                    </select>
                                                                </div>-->

                                <div class="form-group bbot pb20">
                                    <label class="">Language</label>
                                    <select class="form-control h52">
                                        <option>English USA</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="">Subject</label>
                                    <input name="subject" id="wf_preview_edit_template_subject" class="form-control h52" required="" placeholder="Onsite Invitation Email" type="text">
                                </div>

<?php if ($moduleName != 'automation'): ?>
                                    <div class="form-group">
                                        <label class="">Greetings</label>
                                        <input name="greeting" id="wf_preview_edit_template_greeting" class="form-control h52" required="" placeholder="Hi, We’d love your feeed..." type="text">
                                    </div>

                                    <div class="form-group mb0">
                                        <label class="">Content</label>
                                        <a class="fsize14 open_editor" href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                        <textarea name="introduction" id="wf_preview_edit_template_introduction" style="min-height: 238px; resize: none; padding-top: 58px!important;" class="form-control p20 fsize12">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both. 

        But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                    </div>
<?php endif; ?>
                            </div>
                            <div class="p20 pt0" id="wfActiveCtr">
                                <input type="hidden" name="moduleName" id="wf_preview_edit_template_moduleName" value="<?php echo $moduleName; ?>" />
                                <input type="hidden" name="moduleUnitID" id="wf_preview_edit_template_module_unit_id" value="<?php echo $moduleUnitID; ?>" />
                                <input type="hidden" name="campaign_id" id="wf_preview_edit_template_campaign_id" value="" />

                                <button type="button" id="wf_preview_edit_template_save_campaign" class="btn dark_btn h40 bkg_bl_gr">Save</button>
                                <a href="javascript:void(0);" id="wfOpenTestCtr" class="btn btn-link fsize14">Send test email</a>
                            </div>
                            <div class="p20 pt0" id="wfTestCtr" style="display:none;">
                                <input type="text" class="mr20" id="wf_preview_edit_template_text_email" placeholder="Email Address" value="<?php echo $aUser->email; ?>" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" /> 
                                <button type="button" id="wf_preview_edit_template_send_email" class="btn dark_btn h40 bkg_bl_gr">Send</button>
                                <a href="javascript:void(0);" id="wfCloseTestCtr" class="btn btn-link fsize14">Cancel</a>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-8 pl3">
                        <div class="email_editor_right preview" style="max-height:800px;overflow:auto;">
                            <div class="p20 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                <div class="preview_switch"><button type="button" class="close" data-dismiss="modal">×</button></div>
                            </div>
                            <div class="p30" id="wf_preview_edit_template_content">
                                <div class="email_preview_sec br5 pb20">
                                    <div class="email_content">
                                        <div class="blue_header">&nbsp;</div>
                                        <img class="company" src="<?php echo base_url(); ?>assets/images/walker_img.png"/>
                                        <h2 class="txt_dark">Hi, Alen Sultanic! We’d love your feedback!</h2>
                                        <p class="fsize10 txt_grey pl50 pr50">Thanks for buying from Wakers. Please review your purchase. It only takes a minut and relly helps!</p>
                                        <p class="fsize10 txt_grey text-uppercase mt20 mb20">Rating you experience</p>
                                        <p><i class="fa fa-star active"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                                        <button type="button" class="btn dark_btn h40 bkg_blue_light mt10" style="font-size: 10px!important;"><img width="10" src="<?php echo base_url(); ?>assets/images/menu_icons/OffSiteBoost_Light.svg"/> &nbsp; Leave your feedback</button>
                                    </div>
                                    <div class="email_content p25 pl50 pr50">
                                        <p class="fsize10 txt_grey mb20">Whatever you have to say, positive or negative, will help Bondara to deliver the best possible service and show other customers how they perform. All your responses will be made available publicly on the Feefo website. You can choose to make this review anonymous so that only Bondara will know who you are.</p>
                                        <img src="<?php echo base_url(); ?>assets/images/email_sign.png"/>
                                    </div>
                                    <div class="email_foot mt30">
                                        <p style="margin: 0;">Contact: info@binpress.com</p>
                                        <p style="font-size: 6px; margin: 0;">Binpress Inc., The Marketplace For Free and Commercial Code  2483 Old Middlefield Way #209, Mountain View, CA 94043-2330</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- preview sms new modal -->
<div id="workflow_edit_sms_campaign_preview" class="modal fade">
    <div class="modal-dialog modal-lg" style="width:65%;">
        <div class="email_preview_modal">
            <div class="modal-body p0 mt0 br5 ">
                <div class="row">
                    <div class="col-md-4 pr0">
                        <div class="email_editor_left">
                            <div class="p20 bbot"><p class="m0 txt_dark fw500">SMS Configuration</p></div>
                            <div class="p20">
                                <!--                                <div class="form-group">
                                                                    <label class="">SMS template</label>
                                                                    <select name="template_source" id="wf_preview_edit_sms_template_source" class="form-control h52" disabled="disabled">
                                
                                <?php
                                foreach ($oDefaultTemplates as $oTemplate) {
                                    if (($oTemplate->status == '1') && ($oTemplate->template_type == 'sms' || $oTemplate->template_type == 'Sms')):
                                        ?>
                                                                                        <option value="<?php echo $oTemplate->id; ?>"><?php echo $oTemplate->template_name; ?></option>
                                        <?php
                                    endif;
                                }
                                ?>
                                                                    </select>
                                                                </div>-->

                                <div class="form-group bbot pb20">
                                    <label class="">Language</label>
                                    <select class="form-control h52">
                                        <option>English USA</option>

                                    </select>
                                </div>
<?php if ($moduleName != 'automation'): ?>
                                    <div class="form-group">
                                        <label class="">Greetings</label>
                                        <input name="greeting" id="wf_preview_edit_sms_template_greeting" class="form-control h52" required="" placeholder="Hi, We’d love your feeed..." type="text">
                                    </div>

                                    <div class="form-group mb0">
                                        <label class="">Content</label>
                                        <a class="fsize14 open_editor" href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                        <textarea name="introduction" id="wf_preview_edit_sms_template_introduction" style="min-height: 238px; resize: none; padding-top: 58px!important;" class="form-control p20 fsize12">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both. 

        But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                    </div>

<?php endif; ?>

                            </div>
                            <div class="p20 pt0" id="wfSMSActiveCtr">
                                <input type="hidden" name="moduleName" id="wf_preview_edit_sms_template_moduleName" value="<?php echo $moduleName; ?>" />
                                <input type="hidden" name="moduleUnitID" id="wf_preview_edit_sms_template_module_unit_id" value="<?php echo $moduleUnitID; ?>" />
                                <input type="hidden" name="campaign_id" id="wf_preview_edit_sms_template_campaign_id" value="" />

                                <button type="button" id="wf_preview_edit_sms_template_save_campaign" class="btn dark_btn h40 bkg_bl_gr">Save</button>
                                <a href="javascript:void(0);" id="wfOpenSMSTestCtr" class="btn btn-link fsize14">Send test sms</a>
                            </div>
                            <div class="p20 pt0" id="wfSMSTestCtr" style="display:none;">
                                <input type="text" class="mr20" id="wf_preview_edit_sms_template_text_number" placeholder="Phone Number" value="<?php echo $aUser->mobile; ?>" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" /> 
                                <button type="button" id="wf_preview_edit_sms_template_send_sms" class="btn dark_btn h40 bkg_bl_gr">Send</button>
                                <a href="javascript:void(0);" id="wfCloseSMSTestCtr" class="btn btn-link fsize14">Cancel</a>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-8 pl3">
                        <div class="email_editor_right preview" style="max-height:800px;overflow:auto;">
                            <div class="p20 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                <div class="preview_switch"><a href="#" class="preview_switch_icon active"><i class="icon-display"></i></a> <a href="#" class="preview_switch_icon"><i class="icon-iphone"></i></a></div>
                            </div>

                            <div class="panel panel-flat mb30">
                                <div class="sms_preview">
                                    <div class="phone_sms">
                                        <div class="inner">
                                            <p id="wf_preview_edit_sms_template_content_popup"></p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p><small><?php echo date("h:i") . ' ' . dataFormat(); ?></small></p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div id="wf_NewAddaction" class="modal fade" style="z-index:999999;">
    <div class="modal-dialog modal-md">
        <div class="email_preview_modal">
            <div class="modal-body p0 mt0 br5 ">
                <div class="row">
                    <div class="col-md-5 pr0">
                        <div class="email_editor_left">
                            <div class="p20 bbot"><p class="m0 txt_dark fw500">Nodes</p></div>
                            <div class="p20 pt0">
                                <div class=" bkg_white">
                                    <ul class="action_box_new nodes">
                                        <li><a href="javascript:void(0);" class="<?php if ($moduleName == 'automation'): ?>chooseListModule<?php else: ?>addModuleContact<?php endif; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" ><span class="icons br8 grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"/></span>New Contacts </a></li>
                                        <li><a href="#"><span class="icons br8 grd_bkg_green2"><img src="<?php echo base_url(); ?>assets/images/menu_icons/List_Light.svg"/></span>Form Submitted </a></li>
                                        <li><a href="#accordion-control-group1" data-toggle="collapse" data-parent="#accordion-control"><span class="icons br8 grd_bkg_purple"><img src="<?php echo base_url(); ?>assets/images/clock_white14.png"></span>Time Trigger </a></li>
                                    </ul>

                                    <div class="profile_headings m0 mb10">ACTIONS  <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
                                    <ul class="action_box_new nodes">
                                        <li><a href="#"><span class="icons grd_bkg_blue"><img src="<?php echo base_url(); ?>assets/images/menu_icons/People_Light.svg"/></span>Add to list </a></li>
                                        <li><a href="#accordion-control-group2" data-toggle="collapse" data-parent="#accordion-control"><span class="icons grd_bkg_green2"><img src="<?php echo base_url(); ?>assets/images/menu_icons/Email_Light.svg"/></span>Send email </a></li>
                                        <li><a href="#accordion-control-group3" data-toggle="collapse" data-parent="#accordion-control"><span class="icons grd_bkg_green"><img style="width: 12px;" src="<?php echo base_url(); ?>assets/images/menu_icons/BrandPage_Light.svg"/></span>Send sms </a></li>
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



                        </div>
                    </div>
                    <div class="col-md-7 pl3">
                        <div style="padding-bottom:82px;max-height:800px;overflow:auto;" class="email_editor_right bp_faq">
                            <div class="p20 bbot position-relative"><p class="m0 txt_dark fw500">Configuration</p></div>


                            <div class="panel-group panel-group-control content-group-lg mb0" id="accordion-control">
                                <div class="panel panel-white">
                                    <div class="panel-heading sh_no">
                                        <h6 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-control" href="#accordion-control-group1">Timer</a>
                                        </h6>
                                    </div>
                                    <div id="accordion-control-group1" class="panel-collapse collapse in">
                                        <div class="panel-body bkg_white bbot">
                                            <div class="">
                                                <!-- <div class="profile_headings m0 mb10">CONFIGURATION </div>-->

                                                <div class="row">
                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <label class="control-label">Time</label>
                                                            <input type="number" name="new_delay_value" value="10" class="form-control h52" />
                                                        </div>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label">&nbsp;</label>
                                                            <select name="new_delay_unit" class="form-control h52">
                                                                <option value="minute" selected="">Minute(s)</option>
                                                                <option value="hour">Hour(s)</option>
                                                                <option value="day">Day(s)</option>
                                                                <option value="week">Week(s)</option>
                                                                <option value="month">Month(s)</option>
                                                                <option value="year">Year(s)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="p10">
                                                    <label class="custmo_checkbox pull-left mb0">
                                                        <input type="checkbox" checked="checked">
                                                        <span class="custmo_checkmark"></span>
                                                        &nbsp;&nbsp;Enable time and day window
                                                    </label>
                                                    <div class="clearfix"></div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-white">
                                    <div class="panel-heading sh_no">
                                        <h6 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control" href="#accordion-control-group2">Send Email</a>
                                        </h6>
                                    </div>
                                    <div id="accordion-control-group2" class="panel-collapse collapse">
                                        <div class="panel-body bkg_white bbot">
                                            <div class="">
                                                <!-- <div class="profile_headings m0 mb10 txt_blue_sky">CONFIGURATION </div>-->

                                                <div class="form-group">
                                                    <label class="control-label">Email template</label>
                                                    <select name="selectNewWorkflowEmailTemplate" class="form-control h52">
                                                        <option value="">Choose Template</option>
                                                        <?php
                                                        foreach ($oDefaultTemplates as $oTemplate) {
                                                            if (($oTemplate->status == '1' || $oTemplate->status == 'active') && ($oTemplate->template_type == 'email' || $oTemplate->template_type == 'Email')):
                                                                ?>
                                                                <option value="<?php echo $oTemplate->id; ?>"><?php echo $oTemplate->template_name; ?></option>
                                                                <?php
                                                            endif;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>


                                                <div class="bbot pb20">
                                                    <label class="custmo_checkbox pull-left mb-15">
                                                        <input type="checkbox" checked="checked">
                                                        <span class="custmo_checkmark blue_sky"></span>
                                                        &nbsp;&nbsp;Track replies
                                                    </label>
                                                    <div class="clearfix"></div>
                                                    <label class="custmo_checkbox pull-left">
                                                        <input type="checkbox" checked="checked">
                                                        <span class="custmo_checkmark blue_sky"></span>
                                                        &nbsp;&nbsp;Send more then 1 email
                                                    </label>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="pt20 pb20">
                                                    <p><i class=""><img src="<?php echo base_url(); ?>assets/images/plus_icon_grey.png"></i> &nbsp;  Create new email</p>
                                                    <p><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"></i> &nbsp;  Manage existing email</p>
                                                    <div class="clearfix"></div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-white">
                                    <div class="panel-heading sh_no">
                                        <h6 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control" href="#accordion-control-group3">Send SMS</a>
                                        </h6>
                                    </div>
                                    <div id="accordion-control-group3" class="panel-collapse collapse">
                                        <div class="panel-body bkg_white bbot">
                                            <div class="">
                                                <div class="form-group">
                                                    <label class="control-label">SMS Template</label>
                                                    <select name="selectNewWorkflowSMSTemplate" class="form-control h52">
                                                        <option value="">Choose Template</option>
                                                        <?php
                                                        foreach ($oDefaultTemplates as $oTemplate) {
                                                            //pre($oTemplate);
                                                            if (($oTemplate->status == '1') && ($oTemplate->template_type == 'sms' || $oTemplate->template_type == 'Sms')):
                                                                ?>
                                                                <option value="<?php echo $oTemplate->id; ?>"><?php echo $oTemplate->template_name; ?></option>
                                                                <?php
                                                            endif;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="bbot pb20">
                                                    <label class="custmo_checkbox pull-left mb-15">
                                                        <input type="checkbox" checked="checked">
                                                        <span class="custmo_checkmark green"></span>
                                                        &nbsp;&nbsp;Track replies
                                                    </label>
                                                    <div class="clearfix"></div>
                                                    <label class="custmo_checkbox pull-left">
                                                        <input type="checkbox" checked="checked">
                                                        <span class="custmo_checkmark green"></span>
                                                        &nbsp;&nbsp;Send more then 1 sms
                                                    </label>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="pt20 pb20">
                                                    <p><i class=""><img src="<?php echo base_url(); ?>assets/images/plus_icon_grey.png"></i> &nbsp;  Create new sms</p>
                                                    <p><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"></i> &nbsp;  Manage existing sms</p>
                                                    <div class="clearfix"></div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div style="position: absolute;box-sizing: border-box;bottom: 0; z-index:9; background:#fff; border-radius:0 0 5px 5px !important; right: 10px;left: 3px;" class="p20 btop text-right">
                                <input type="hidden" name="action_previous_id" id="wf_new_action_previous_id" />
                                <input type="hidden" name="action_current_id" id="wf_new_action_current_id" />
                                <input type="hidden" name="action_event_type" id="wf_new_action_event_type" />
                                <input type="hidden" name="action_node_type" id="wf_new_action_node_type" />
                                <input type="hidden" name="moduleName" id="wf_new_action_moduleName" value="<?php echo $moduleName; ?>" />
                                <input type="hidden" name="moduleUnitID" id="wf_new_action_module_unit_id" value="<?php echo $moduleUnitID; ?>" />
                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-link fsize14">Cancel</a>
                                <button type="button" id="createNewWorkflowEventNode" class="btn dark_btn h40 bkg_bl_gr">Save & Close</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>