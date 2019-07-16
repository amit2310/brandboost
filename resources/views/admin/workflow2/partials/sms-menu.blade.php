<?php
$aUser = getLoggedUser();
$userID = $aUser->id;
?>
<div class="panel panel-flat" id="wfSMSMenu" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="backtoMenu" href="javascript:void(0);"> <i class=""><img width="20" src="<?php echo base_url(); ?>assets/images/back_icon.png"/></i> &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Send SMS</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body p20 pt0 bkg_white">
        <div class="profile_headings m0 mb10 txt_green">CONFIGURATION </div>

        <div class="bbot pb20">
            <label class="custmo_checkbox pull-left">
                <input type="checkbox" checked="checked">
                <span class="custmo_checkmark green"></span>
                Track replies
            </label>
            <div class="clearfix"></div>
        </div>

        <div class="pt20 pb20">
            <p><i class=""><img src="<?php echo base_url(); ?>assets/images/plus_icon_grey.png"/></i> &nbsp;  Create new sms</p>
            <p><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Manage existing sms</p> 
            <?php if ($moduleName == 'broadcast' || $moduleName == 'automation' || $moduleName == 'email'): ?>
            <p><a href="javascript:void(0);" id="wf_sms_menu_edit" class="wf_editSMSCampaign" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" campaignType="sms"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Edit SMS</a></p>
            <?php endif; ?>
            <p><a href="javascript:void(0);" id="wf_sms_preview" class="wf_previewCampaign" campaignType="sms" data-moduleaccountid ="<?php echo $moduleUnitID;?>"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Preview SMS</a></p>
            <p><a href="javascript:void(0);" id="wf_sms_testSMSCtr"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Send Test SMS</a>
            <div class="form-group hidden" id="wfPreviewTestSMSCtr">
                <input type="text" class="form-control h52" id="wfPreviewTestCtr_text_number" placeholder="Phone Number" value="<?php echo $aUser->mobile; ?>" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" /> 
                <button type="button" id="wfPreviewTestCtr_send_sms" class="btn dark_btn bkg_sblue fsize14 mt10">Send</button>
                <button type="button" id="wfPreviewTestCtrSMSCancel" class="btn dark_btn bkg_red fsize14 mt10">Cancel</button>
            </div>
            </p>
            <p><a href="javascript:void(0);" id="wf_delete_sms_event" class="wf_deleteCampaign" campaignType="sms"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Delete SMS</a></p>
            <div class="clearfix"></div>
        </div>





        <div class="profile_headings m0 mb10 txt_green">STATS </div>

        <div id="wfSMSStats">
            <div class="wfconfig">
                <ul>
                    <li><small>Sent</small> <strong>0</strong></li>
                    <li><small>Click</small> <strong>0</strong></li>

                </ul>
                <div class="clearfix"></div>
            </div>
        </div>    




    </div>
</div>