<?php 
$aUser = getLoggedUser();
$userID = $aUser->id;

?>
<div class="panel panel-flat" id="wfEmailMenu" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="backtoMenu" href="javascript:void(0);"> <i class=""><img width="20" src="<?php echo base_url(); ?>assets/images/back_icon.png"/></i> &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Send email</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body p20 pt0 bkg_white">
        <div class="profile_headings m0 mb10 txt_blue_sky">CONFIGURATION </div>

        <div class="bbot pb20">
            <label class="custmo_checkbox pull-left mb-15">
                <input type="checkbox" checked="checked">
                <span class="custmo_checkmark blue_sky"></span>
                &nbsp;Track replies
            </label>
            <div class="clearfix"></div>
            <label class="custmo_checkbox pull-left">
                <input type="checkbox" checked="checked">
                <span class="custmo_checkmark blue_sky"></span>
                &nbsp;Send more then 1 email
            </label>
            <div class="clearfix"></div>
        </div>

        <div class="pt20 pb20">
            <p><i class=""><img src="<?php echo base_url(); ?>assets/images/plus_icon_grey.png"/></i> &nbsp;  Create new email</p>
            <p><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Manage existing email</p>
            <?php if ($moduleName == 'broadcast' || $moduleName == 'automation' || $moduleName == 'email'): ?>
            <p><a href="javascript:void(0);" id="wf_email_menu_edit" class="wf_editCampaign" campaign_id="<?php echo (!empty($oCampaign)) ? $oCampaign->id : 0; ?>" moduleName="<?php echo $moduleName; ?>" moduleUnitId='<?php echo $moduleUnitID; ?>' campaignType="email"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Edit Email</a></p>
            <?php endif; ?>
            <p><a href="javascript:void(0);" id="wf_email_preview" class="wf_previewCampaign" campaignType="email" data-moduleaccountid ="<?php echo $moduleUnitID;?>"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Preview Email</a></p>
            <p><a href="javascript:void(0);" id="wf_email_testEmailCtr"  campaignType="email"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Send Test Email</a>
            <div class="form-group hidden" id="wfPreviewTestCtr">
                <input type="text" class="form-control h52" id="wfPreviewTestCtr_text_email" placeholder="Email Address" value="<?php echo $aUser->email; ?>" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" /> 
                <button type="button" id="wfPreviewTestCtr_send_email" class="btn dark_btn bkg_sblue fsize14 mt10">Send</button>
                <button type="button" id="wfPreviewTestCtrCancel" class="btn dark_btn bkg_red fsize14 mt10">Cancel</button>
            </div>
            </p>
            <p><a href="javascript:void(0);" id="wf_delete_event" class="wf_deleteCampaign" campaignType="email"><i class=""><img src="<?php echo base_url(); ?>assets/images/list_icon_grey.png"/></i> &nbsp;  Delete Email</a></p>
            <div class="clearfix"></div>
        </div>





        <div class="profile_headings m0 mb10 txt_blue_sky">STATS </div>

        <div id="wfEmailStats">
            <div class="wfconfig bbot mb-15 pb-15">
                <ul>
                    <li><small>Sent</small> <strong>0</strong></li>
                    <li><small>Delivered</small> <strong>0</strong></li>
                    <li><small>Open</small> <strong>0</strong></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="wfconfig">
                <ul>
                    <li><small>Click</small> <strong>0</strong></li>
                    <li><small>Bounce</small> <strong>0</strong></li>
                    <li><small>Dropped</small> <strong>0</strong></li>
                    <li><small>Unsubscribe</small> <strong>0</strong></li>
                    <li><small>Spam report</small> <strong>0</strong></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>    



    </div>
</div> 