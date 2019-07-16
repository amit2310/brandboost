<?php

?>
<div class="col-md-6 <?php if($bMulitpleBranches == false):?>col-md-offset-3<?php endif;?>">
    <div class="timeline-content inner">
        <div class="panel top_box">
            <a class="icons iconsab green" href="#"><i class="icon-iphone"></i></a>
            <div class="panel-heading">
                <p class="mb0 ">SMS #<?php echo $eventNo; ?>: <?php echo $oCampaign->subject; ?></p>
                <div class="heading-elements" data-event-id="<?php echo $oEvent->id;?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right width-200">
                        <?php if($moduleName == 'broadcast' || $moduleName == 'automation' || $moduleName == 'email'):?>
                        <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" class="text-default text-semibold wf_editSMSCampaign"><i class="icon-pencil"></i>  Edit</a></li>
                        <?php endif; ?>
                        <li><a href="javascript:void(0);" event_id="<?php echo $oEvent->id; ?>" moduleName="<?php echo $moduleName; ?>" class="wf_deleteCampaign" ><i class="icon-trash"></i> Delete</a></li>
                        <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" class="wf_previewCampaign" campaignType="sms"><i class="icon-file-text2"></i> Preview</a></li>
                        <li><a href="javascript:void(0);" campaign_id="<?php echo $oCampaign->id; ?>" moduleName="<?php echo $moduleName; ?>" class="wf_viewCampaignStats"><i class="icon-file-text2"></i> View Stats</a></li>

                    </ul>

                </div>
            </div>
            <div class="panel-body bkg_white">
                <p class="m0 txt_green"><?php echo count($subscribersData); ?> Contacts Added</p>
            </div>
        </div>

        <div class="panel mb20" id="wf_campaign_stats_<?php echo $oCampaign->id; ?>" style="display:block;">
            <div class="panel-heading">
                <p class="txt_black mb0">Type: SMS</p>
                <p class="mb0 text-muted">A collection of textile samples lay spread out on the table</p>
                <div class="heading-elements"><a href="javascript:void(0);" class="wf_hideCampaignStats" campaign_id="<?php echo $oCampaign->id; ?>"><i class="icon-more2"></i></a></div>
            </div>
            <div class="panel-body bkg_white">
                <div class="row">
                    <div class="col-md-4">
                        <ul>
                            <li><span>Sent</span><?php echo $sentSms; ?></li>
                            <li><span>Delivered</span><?php echo $deliveredSms; ?></li>
                            <li><span>&nbsp;</li>

                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li><span>Failed</span><?php echo $failedSms; ?></li>
                            <li><span>Queued</span><?php echo $queuedSms; ?></li>
                            <li><span>&nbsp;</li>

                        </ul>
                    </div>
                    <div class="col-md-4 pr0">
                        <ul>
                            <li><span>Accepted</span><?php echo $acceptedSms; ?></li>
                            <li><span>Spam report</span><?php echo $sentSms; ?></li>
                            <li><span>&nbsp;</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel-footer panel-footer-condensed bkg_white">
                <p class="mb0 "><span class="text-muted">Created</span> <?php echo dataFormat($oCampaign->created); ?> ( <?php echo timeAgo($oCampaign->created); ?> )</p>
            </div>
        </div>
    </div>
</div>