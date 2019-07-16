<?php
$templatesourceId = $oCampaign->template_source;
if ($templatesourceId > 0) {
    $oTemplateInfo = $this->mWorkflow->getCommonTemplateInfo($templatesourceId);
    if (!empty($oTemplateInfo)) {
        $categoryStatus = $oTemplateInfo->category_status;
    }
}
?>
<div class="col-md-6 <?php if ($bMulitpleBranches == false): ?>col-md-offset-3<?php endif; ?>">
    <div class="timeline-content inner">
        <div class="panel top_box mb0" style="cursor:pointer;">
            <a class="icons iconsab green" href="#"><img style="width: 12px;" src="<?php echo base_url(); ?>assets/images/menu_icons/BrandPage_Light.svg"></a>
            <div class="heading-elements" data-event-id="<?php echo $oEvent->id; ?>" style="z-index:9999;margin-top:-35px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
                <ul class="dropdown-menu dropdown-menu-right width-200">
                    <?php //if ($moduleName == 'broadcast' || $moduleName == 'automation' || $moduleName == 'email'): ?>
                    <?php if($categoryStatus != 2):?>
                        <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" class="text-default text-semibold wf_editSMSCampaign"><i class="icon-pencil"></i>  Edit</a></li>
                    <?php endif; ?>
                    <li><a href="javascript:void(0);" event_id="<?php echo $oEvent->id; ?>" moduleName="<?php echo $moduleName; ?>" class="wf_deleteCampaign" ><i class="icon-trash"></i> Delete</a></li>
                    <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" class="<?php echo ($categoryStatus == 2) ? 'wf_previewEditCampaign' : 'wf_previewCampaign';?>" campaignType="sms"><i class="icon-file-text2"></i> <?php echo ($categoryStatus == 2) ? 'Edit & Preview' : 'Preview';?></a></li>
                </ul>

            </div>
            <span class="wfLoadSMSNodeProperty" style="cursor:pointer;" event_id="<?php echo $oEvent->id; ?>" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" template_id="<?php echo $oCampaign->template_source;?>">
                <div class="panel-heading">
                    <p class="mt0 mb0"><span class="txt_grey">SMS #<?php echo $eventNo; ?>:</span> <?php echo $oCampaign->name; ?></p>


                </div>
                <div class="panel-body bkg_white">
                    <p class="m0"><i style="margin-top: -1px;" class="pull-left valign-top mr-5"><img width="13" src="<?php echo base_url(); ?>assets/images/user_icon_white.png"/></i><a href="javascript:void(0);" class="viewCampaignContacts" style="z-index:99;"><span class="txt_grey totalselcontacts"><?php echo empty($iActiveSelectedCount) ? 0 : $iActiveSelectedCount; ?> Contacts Added</span></a></p>
                </div>
            </span>    
        </div>


    </div>
</div>


