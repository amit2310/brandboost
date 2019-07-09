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
                                <?php if(!empty($oCampaignTags)): ?>
                                <div class="form-group">
                                    <div class="note-btn-group btn-group note-view">
                                        <?php foreach($oCampaignTags as $oTags): ?>
                                        <button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo $oTags;?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo $oTags;?></button>
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
                            <input type="hidden" name="wf_editor_moduleName" id="wf_editor_moduleName" value="<?php echo $moduleName;?>">
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
<div id="wf_waitTime" class="modal fade">
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
                            <div style="float:left; width: 100%;">
                                <h6 style="margin:8px 10px 0 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
                                <input id="wf_delay_time_value" name="delay_value" value="10" class="delay_value form-control mbot25 input-circle ui-wizard-content" type="text">
                                <div style="display: inline-block; width: 120px; margin: 0 12px; float: left;" class="form-group waittimeselect">
                                    <select id="wf_delay_time_unit" name="delay_unit" control_id="pl2" class="selectbox">
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

                                <input name="event_id" id="wf_event_id_val" value="" type="hidden">
                                <input name="moduleName" id="moduleName" value="<?php echo $moduleName; ?>" type="hidden">
                                &nbsp; <button class="btn bl_cust_btn ui-wizard-content ui-formwizard-button" type="submit">Update</button>

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
<div id="wf_addnewaction" class="modal fade">
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


                <div class="tabbable">
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
                                    if ($oTemplate->template_type == 'email' || $oTemplate->template_type == 'Email'):
                                        ?>
                                        <div class="col-md-6">
                                            <div template_id="<?php echo $oTemplate->id; ?>" class="panel bg-primary actionpanel selectWorkflowTemplate">
                                                <div class="panel-body">
                                                    <div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
                                                    <div class="media-left">
                                                        <h6><?php echo $oTemplate->template_name; ?></h6>
                                                        <p><?php echo $oTemplate->template_subject; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="" class="previousEventId" id="previousEventId_<?php echo $oTemplate->id; ?>">
                                        </div>
                                        <?php
                                    endif;
                                }
                                ?>								
                            </div>
                        </div>
                        <!--########################TAB 1 ##########################-->
                        <div class="tab-pane" id="chooseWorkflowSMS">
                            <div class="row">
                                <br>
                                <?php
                                foreach ($oDefaultTemplates as $oTemplate) {
                                    if ($oTemplate->template_type == 'sms' || $oTemplate->template_type == 'Sms'):
                                        ?>
                                        <div class="col-md-6">
                                            <div template_id="<?php echo $oTemplate->id; ?>" class="panel bg-primary actionpanel selectWorkflowTemplate">
                                                <div class="panel-body">
                                                    <div class="media-left"> <img src="<?php echo site_url('assets/images/email_icon2.png'); ?>" style="width: 40px;"> </div>
                                                    <div class="media-left">
                                                        <h6><?php echo $oTemplate->template_name; ?></h6>
                                                        <p><?php echo $oTemplate->template_subject; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="" class="previousEventId" id="previousEventId_<?php echo $oTemplate->id; ?>">
                                        </div>
                                        <?php
                                    endif;
                                }
                                ?>
                            </div>
                        </div> 
                        <!--########################TAB 2 ##########################-->
                        <div class="tab-pane" id="delayIntervalWorkflow">
                            <div class="row">
                                <div class="col-md-12 txt_inp_grp">
                                    <form  method="post" name="eventFrmUpdate" class="eventFrmUpdate">
                                        <div style="float:left; width: 100%;">
                                            <h6 style="margin:8px 10px 0 0!important; font-size: 13px; float: left; text-align: right;"> Trigger workflow when the following conditions are met:  </h6>
                                            <input id="delay_value" name="delay_value" value="10" class="delay_value form-control required mbot25 input-circle ui-wizard-content" type="text">
                                            <div style="display: inline-block; width: 120px; margin: 0 12px; float: left;" class="form-group waittimeselect">
                                                <select id="delay_unit" name="delay_unit" class="selectbox">
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

                                        </div>
                                        <div class="col-md-12 text-right mt-20">
                                            <input type="hidden" name="brandboost_id" value="<?php echo $brandboostID; ?>" />
                                            <input name="event_id" id="event_id" value="<?php echo $oMainEvent->id; ?>" type="hidden">
                                            <button type="submit" class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Save</button>
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
<?php foreach ($subscribersData as $key => $subData) {
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