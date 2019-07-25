<?php
$aSelectedContacts = array();
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
<div id="broadcastReviewAudience" class="broadcastTab" <?php if ($activeTab != 'Review Contacts' || empty($activeTab)): ?> style="display:none;"<?php endif; ?> >
    <div class="col-md-12 p0">
        <div class="panel panel-flat">
            @include('admin.components.smart-popup.smart-contact-widget')
            <div class="panel-heading">
                <span class="pull-left">
                    <h6 class="panel-title"><span id="totalBroadcastReviewAudience"><?php echo $iActiveCount; ?></span> Contacts</h6>

                </span>
<!--                <div class="heading_links pull-left">
                    <button type="button" class="btn btn-xs btn_white_table bkg_blue ml20" style="background:#4285f4!important;background-color:#4285f4!important;color:#ffffff!important;"><span id="totalContactCount"><?php echo count($aSelectedContacts); ?></span> contact added</button>

                </div>-->


                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" tableID="editBroadcastAudience" placeholder="Search by name" type="text">
                        <div class="form-control-feedback">
                            <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_search.png" width="14"></i>
                        </div>
                    </div>
                    
                    <div class="table_action_tool">
                        <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a>
                        <?php if($bExpired == false): ?>
                        <a href="javascript:void(0);" class="editDataListContact"><i class="icon-pencil"></i></a>
                        <?php endif; ?>
                        <a href="javascript:void(0);" style="display: none;" class="custom_action_box_con deleteBulkBoradcastAudience" broadcast_id="<?php echo $oBroadcast->broadcast_id;?>"><i class="icon-trash position-left"></i></a> 
                        <!-- <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_edit.png"></i></a> -->
                    </div>
                </div>

            </div>
            <div class="panel-body p0 bkg_white">
                <div id="liveReviewAudience">
                @include('admin.broadcast.partials.broadcast_audience', ['recordSource' => 'review-audience'])
                </div>    

                

                <script type="text/javascript">
                    $(document).ready(function() {

                        $(document).on('click', '.editDataListContact', function () {
                            $('.editActionContact').toggle();
                        });

                        $(document).on('change', '#checkAllContact', function (e) {
                           
                            e.stopImmediatePropagation();
                            if (false == $(this).prop("checked")) {

                                $(".addToBroadcast").prop('checked', false);
                                $(".selectedClass").removeClass('success');
                                $('.custom_action_box_con').hide();
                            } else {

                                $(".addToBroadcast").prop('checked', true);
                                $(".selectedClass").addClass('success');
                                $('.custom_action_box_con').show();
                            }

                        });

                        $(document).on('click', '.addToBroadcast', function () {
                            var inc = 0;
                            var rowId = $(this).val();
                            if (false == $(this).prop("checked")) {
                                $('#append-con-ml-'+rowId).removeClass('success');
                                $('#append-con-cl-'+rowId).removeClass('success');
                            } else {
                                $('#append-con-ml-'+rowId).addClass('success');
                                 $('#append-con-cl-'+rowId).addClass('success');
                            }

                            $('.addToBroadcast:checkbox:checked').each(function (i) {
                                inc++;
                            });
                            if (inc == 0) {
                                $('.custom_action_box_con').hide();
                            } else {
                                $('.custom_action_box_con').show();
                            }

                            var numberOfChecked = $('.addToBroadcast:checkbox:checked').length;
                            var totalCheckboxes = $('.addToBroadcast:checkbox').length;
                            if (totalCheckboxes > numberOfChecked) {
                                $('#checkAllContact').prop('checked', false);
                            }

                        });

                    });
                    
                </script>

                <!-- /content area -->
<!--                <script src="<?php echo base_url(); ?>assets/js/modules/people/subscribers.js" type="text/javascript"></script>-->



            </div>
        </div>
    </div>
</div>