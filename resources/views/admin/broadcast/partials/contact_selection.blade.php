<?php
if (!empty($oCampaignContacts)) {
    foreach ($oCampaignContacts as $oRec) {
        $aSelectedContacts[] = $oRec->subscriber_id;
    }
}
?>
<?php
$iActiveCount = $iArchiveCount = 0;
if (!empty($oBroadcastSubscriber)) {
    foreach ($oBroadcastSubscriber as $oCount) {
        if ($oCount->status == 2) {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
?>
<div class="row contactSection" <?php if (empty($activeTab) && empty($oBroadcast->audience_type)): ?>style="display:none;"<?php endif; ?>>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading pt0 pb0"> 
                <div class="row">
                    <div class="col-md-6 brig h56"><h6 class="panel-title mt17"><img class="hicon" src="<?php echo base_url(); ?>assets/images/icon_import.png"/> Add Contacts</h6></div>
                    <div class="col-md-6 pl20 h56"><h6 class="panel-title mt17"><img class="hicon" src="<?php echo base_url(); ?>assets/images/icon_cross.png"/> Exclude Contacts</h6></div>
                </div>
            </div>


            <div class="panel-body p0 bkg_white">
                <div class="row">
                    <div class="col-md-6 brig"><div class="p20 taggroup" id="importPropertyButtons">
                            <?php echo $sImportButtons; ?>
                        </div></div>
                    <div class="col-md-6"><div class="p20 pl10 taggroup" id="excludePropertyButtons">
                            <?php echo $sExcludButtons; ?>

                        </div></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row contactSection" id="contactSection" <?php if (empty($activeTab) && empty($oBroadcast->audience_type)): ?>style="display:none;"<?php endif; ?>>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <span class="pull-left">
                    <h6 class="panel-title"><span id="totalBroadcastAudience"><?php echo $iActiveCount; ?></span> Contacts</h6>

                </span>
                <!--                <div class="heading_links pull-left">
                                    <button type="button" class="btn btn-xs btn_white_table bkg_blue ml20" style="background:#4285f4!important;background-color:#4285f4!important;color:#ffffff!important;"><span id="totalContactCount"><?php echo count($aSelectedContacts); ?></span> contact added</button>
                
                                </div>-->

                <div class="heading-elements">

                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" tableID="broadcastAudience"  placeholder="Search by name" type="text">
                        <div class="form-control-feedback">
                            <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_search.png" width="14"></i>
                        </div>

                    </div>
                    <div class="table_action_tool">
                        <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a>
                        <a href="javascript:void(0);" class="editDataListContact"><i class="icon-pencil"></i></a>
                        <a href="javascript:void(0);" style="display: none;" class="custom_action_box_con deleteBulkBoradcastAudience" broadcast_id="<?php echo $oBroadcast->broadcast_id;?>"><i class="icon-trash position-left"></i></a> 
                    </div>
                    <!--                    <a href="javascript:void(0);" class="btn dark_btn bkg_blue selectAudience" style="margin-top:-8px;">Change Selection</a>-->

                </div>
            </div>

            <div class="panel-body p0 bkg_white">
                <div id="liveBroadcastAudience">
                <?php  $this->load->view('admin/broadcast/partials/broadcast_audience', array('recordSource' => 'contact-selection')); ?>
                </div>    


<!--                <div id="subscriberTagListsModal" class="modal fade">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="post" name="frmSubscriberApplyTag" id="frmSubscriberApplyTag" action="javascript:void();">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title">Apply Tags</h5>
                                </div>
                                <div class="modal-body" id="tagEntireList"></div>
                                <div class="modal-footer modalFooterBtn">
                                    <input type="hidden" name="tag_subscriber_id" id="tag_subscriber_id" />
                                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>-->


                <!-- /content area -->
<!--                <script src="<?php echo base_url(); ?>assets/js/modules/people/subscribers.js" type="text/javascript"></script>-->

            </div>
        </div>
    </div>
</div>