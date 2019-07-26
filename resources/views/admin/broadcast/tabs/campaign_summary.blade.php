<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<style>
    .input90{width: calc(100% - 65px); float: left; margin-right: 10px;}
    .interactions.configurations ul li{line-height: 35px!important;}
    .interactions.configurations ul li small{font-weight: 300!important;color: #09204f!important;}
</style>
<?php
if(empty($broadcastSettings)){
    $broadcastSettings = new stdClass();
    $broadcastSettings->text_version_email= 0;
    $broadcastSettings->enable_mobile_responsiveness= 0;
    $broadcastSettings->read_tracking= 0;
    $broadcastSettings->link_tracking = 0;
    $broadcastSettings->reply_tracking = 0;
    $broadcastSettings->google_analytics= 0;
    $broadcastSettings->campaign_archives= 0;    
}



?>
<?php
if (!empty($oBroadcast)) {
    $aMainTriggerData = json_decode($oBroadcast->data);
}

if (!empty($oAutomationLists)) {
    $aListIDs = array();
    foreach ($oAutomationLists as $oAutomationList) {
        $aListIDs[] = $oAutomationList->list_id;
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

if ($oBroadcast->sending_method == 'split') {
    $totalVariations = 0;
    $oVariations = $mBroadcast->getBroadcastVariations($oBroadcast->broadcast_id);
    $totalVariations = count($oVariations);
}

$aDeliveryParam = json_decode($oBroadcast->data);
$deliveryDate = $aDeliveryParam->delivery_date;
$deliveryTime = $aDeliveryParam->delivery_time;
$timeString = $deliveryDate . ' ' . $deliveryTime;
$deliverAt = strtotime($timeString);
?>

<div id="broadcastSummary" class="broadcastTab" <?php if ($activeTab != 'Campaign Summary'): ?> style="display:none;"<?php endif; ?>>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-heading pl25">
                    <h6 class="panel-title">Summary</h6>
                    <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                </div>
                <div class="panel-body p25 bkg_white min_h534">
                    <div class="bbot pb20">
                        <label>Broadcast name</label>
                        <p class="fw500 txt_dark m0"><?php echo $oBroadcast->title; ?></p>
                    </div>
                    <div class="bbot pb20 pt20">
                        <label>Sending Method</label>
                        <p class="fw500 txt_dark m0">
                            <a href="<?php echo base_url(); ?>admin/broadcast/report/<?php echo $oBroadcast->broadcast_id; ?>">
                                <?php echo ($oBroadcast->sending_method == 'split') ? 'Split(' . $totalVariations . ' Variations)' : 'Normal'; ?>
                            </a> 
                        </p>
                    </div>
                    <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                        <div class="bbot pb20 pt20">
                            <label>Subject</label>
                            <p class="fw500 txt_dark m0"><?php echo $oBroadcast->subject; ?></p>
                        </div>
                        <div class="bbot pb20 pt20">
                            <label>From</label>
                            <p class="fw500 txt_dark m0"><?php echo $oBroadcast->from_name == '' ? $userData->firstname . ' ' . $userData->lastname : $oBroadcast->from_name; ?></p>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="bbot pb20 pt20">
                                    <label>From Email</label>
                                    <p class="fw500 txt_dark m0"><?php echo $oBroadcast->from_email == '' ? $userData->email : $oBroadcast->from_email; ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="bbot pb20 pt20">
                                    <label>Reply to Email</label>
                                    <p class="fw500 txt_dark m0"><?php echo $oBroadcast->reply_to == '' ? $userData->email : $oBroadcast->reply_to; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>

                        <div class="bbot pb20 pt20">
                            <label>From Number</label>
                            <p class="fw500 txt_dark m0"><?php echo $twillioData->contact_no; ?></p>
                        </div>

                    <?php endif; ?>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="pb0 pt20">
                                <label>Delivery</label>
<!--                                <p class="fw500 txt_dark m0">Immediately</p>-->
                                <p class="fw500 txt_dark m0"><?php echo dataFormat(date("Y-m-d H:i:s",$deliverAt)). ' <span class="txt_grey">' . date("H:i A", $deliverAt). '</span>'; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pb0 pt20">
                                <label>Spam Check</label>
                                <p class="fw500 m0 txt_green"><i class=""><img src="<?php echo base_url(); ?>assets/images/green_check_12.png"></i> Verified</p>
                            </div>
                        </div>
                    </div>





                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-heading pl25">
                    <h6 class="panel-title"><?php echo $iActiveCount; ?> Contacts</h6>
                    <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                </div>
                <div class="panel-body p25 bkg_white min_h534" style="min-height:597px !important;">

                    <h6 class="panel-title"><img class="hicon" src="<?php echo base_url(); ?>assets/images/icon_import.png"> <span class="txt_grey">Imported</span> <?php echo $importedCount; ?></h6>


                    <div class="p20 pl0 pr0 btop  bbot mt-15 mb-15 taggroup">
                        <?php echo $sImportButtonsSummary; ?>
                    </div>


                    <h6 class="panel-title"><img class="hicon" src="<?php echo base_url(); ?>assets/images/icon_import.png"> <span class="txt_grey">Excluded</span> <?php echo $exportedCount; ?></h6>

                    <div class="p20 pl0 pr0 btop mt-15 mb-15 taggroup">
                        <?php echo $sExcludButtonsSummary; ?>
                    </div>



                </div>
            </div>
        </div>

        <div class="col-md-4">
            <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                <div class="panel panel-flat">
                    <div class="panel-heading pl25">
                        <h6 class="panel-title">Test Email</h6>
                        <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                    </div>
                    <div class="panel-body p0 bkg_white">
                        <div class="p25">
                            <div class="form-group mb0">
                                <label class="display-block">Test Email</label>
                                <input class="form-control h52 input90" type="text" name="testCampaignEmail" id="testCampaignEmail" value="<?php echo $oBroadcast->from_email; ?>" placeholder="Enter test email">
                                <button class="btn dark_btn bkg_sblue2 h52" id="sendTestEmailPreview" style="padding:7px 18px!important"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (strtolower($oBroadcast->campaign_type) == 'sms'): ?>
                <div class="panel panel-flat">
                    <div class="panel-heading pl25">
                        <h6 class="panel-title">Test SMS</h6>
                        <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                    </div>
                    <div class="panel-body p0 bkg_white">
                        <div class="p25">
                            <div class="form-group mb0">
                                <label class="display-block">Test SMS</label>
                                <input class="form-control h52 input90" type="text" name="testCampaignSMS" id="testCampaignSMS" value="<?php echo $userData->mobile; ?>" placeholder="Enter phone number">
                                <button class="btn dark_btn bkg_green h52" id="sendTestSMSPreview" style="padding:7px 18px!important"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="panel panel-flat">
                <div class="panel-heading pl25">
                    <h6 class="panel-title">Settings</h6>
                    <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                </div>
                <div class="panel-body p0 bkg_white min_h330" style="min-height:394px !important;">
                    <div class="p25 pt10 pb20">
                        <div class="interactions configurations">
                            <ul>
                                <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                                    <li><small class="wauto pull-left">Generate a text version of the email</small><a class="pull-right text-right <?php echo $broadcastSettings->text_version_email != '0' ? 'txt_blue_sky' : 'txt_grey'; ?>"><?php echo $broadcastSettings->text_version_email != '0' ? 'On' : 'Off'; ?></a></li>
                                    <li><small class="wauto pull-left">Enable Mobile Responsiveness</small> <a class="pull-right text-right <?php echo $broadcastSettings->enable_mobile_responsiveness != '0' ? 'txt_blue_sky' : 'txt_grey'; ?>"><?php echo $broadcastSettings->enable_mobile_responsiveness != '0' ? 'On' : 'Off'; ?></a></li>
                                    <li><small class="wauto pull-left">Open/Read Tracking</small> <a class="pull-right text-right <?php echo $broadcastSettings->read_tracking != '0' ? 'txt_blue_sky' : 'txt_grey'; ?>"><?php echo $broadcastSettings->read_tracking != '0' ? 'On' : 'Off'; ?></a></li>
                                <?php endif; ?>
                                <li><small class="wauto pull-left">Link Tracking</small> <a class="pull-right text-right <?php echo $broadcastSettings->link_tracking != '0' ? 'txt_blue_sky' : 'txt_grey'; ?>"><?php echo $broadcastSettings->link_tracking != '0' ? 'On' : 'Off'; ?></a></li>
                                <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                                    <li><small class="wauto pull-left">Reply Tracking</small> <a class="pull-right text-right <?php echo $broadcastSettings->reply_tracking != '0' ? 'txt_blue_sky' : 'txt_grey'; ?>"><?php echo $broadcastSettings->reply_tracking != '0' ? 'On' : 'Off'; ?></a></li>
                                <?php endif; ?>
                                <li><small class="wauto pull-left">Google Analytics</small> <a class="pull-right text-right <?php echo $broadcastSettings->google_analytics != '0' ? 'txt_blue_sky' : 'txt_grey'; ?>"><?php echo $broadcastSettings->google_analytics != '0' ? 'On' : 'Off'; ?></a></li>
                                <li><small class="wauto pull-left">Campaign Archives</small> <a class="pull-right text-right <?php echo $broadcastSettings->campaign_archives != '0' ? 'txt_blue_sky' : 'txt_grey'; ?>"><?php echo $broadcastSettings->campaign_archives != '0' ? 'On' : 'Off'; ?></a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


<div id="editBroadcastEmailSubject" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmBroadcastEmailSubject" name="frmBroadcastEmailSubject">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Broadcast Email Subject</h5>
                </div>
                <div class="modal-body">
                    <p>Email Subject:</p>
                    <input class="form-control" value="<?php echo $oBroadcast->subject; ?>" id="edit_email_subject" name="edit_email_subject" placeholder="Enter Email Subject" type="text" required><br>
                </div>
                <hr>
                <div class="modal-footer">
                    <input type="hidden" name="broadcast_event_id" id="broadcast_event_id" value="<?php echo $oBroadcast->event_id; ?>" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editBroadcastEmailFrom" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmBroadcastEmailFrom" name="frmBroadcastEmailFrom">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Broadcast From Email</h5>
                </div>
                <div class="modal-body">
                    <p>From Email:</p>
                    <input class="form-control" value="<?php echo $oBroadcast->from_email; ?>" id="edit_from_email" name="edit_from_email" placeholder="Enter From Email" type="text" required><br>
                </div>
                <hr>
                <div class="modal-footer">
                    <input type="hidden" name="broadcast_event_id" id="broadcast_event_id" value="<?php echo $oBroadcast->event_id; ?>" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                                <?php if (!empty($oLists)): ?>
                                    <?php
                                    
                                    $newolists = array();

                                    foreach ($oLists as $key => $value) {
                                        $newolists[$value->id][] = $value;
                                    }
                                    foreach ($newolists as $oList):
                                        $oList = $oList[0];
                                        if(!isset($oList->total_contacts)){
                                            $oList->total_contacts = 0;
                                        }
                                        
                                        ?>
                                        <option value="<?php echo $oList->id; ?>" <?php if (in_array($oList->id, $aListIDs)): ?> selected="selected"<?php endif; ?>><?php echo $oList->list_name . ' (' . $oList->total_contacts . ' Contacts)'; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="automation_id" value="<?php echo $oBroadcast->broadcast_id; ?>" />
                            <button type="submit" class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Save</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="chooseScheduleDate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-eye"></i>&nbsp; Choose Schedule Date</h5>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" id="frmSaveAutomationScheduleDate" action="javascript:void();">
                    <div class="row">
                        <div class="col-md-12 txt_inp_grp">

                            <div class="col-md-12">
                                <p class="mbot15"><strong> Schedule Date * </strong></p>
                            </div>                       
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" id="datepicker" name="delivery_date" class="form-control daterange-single" value="<?php echo (!empty($aMainTriggerData->delivery_date)) ? $aMainTriggerData->delivery_date : date("m/d/Y"); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                    <input type="text" id="timepicker" class="form-control" id="anytime-time-hours4" name="delivery_time" value="<?php echo (!empty($aMainTriggerData->delivery_time)) ? $aMainTriggerData->delivery_time : '9 PM'; ?>" style="min-height:33px;padding-left:10px;">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="automation_id" value="<?php echo $oBroadcast->broadcast_id; ?>" />
                            <button type="submit" class="btn pull-right bl_cust_btn btn-success"><i class="fa fa-edit"></i> &nbsp; Save</button>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div id="emailPreviewPopup" class="modal fade in">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><?php echo strtolower($oBroadcast->campaign_type) == 'email' ? 'Email' : 'SMS'; ?> Preview</h5>
            </div>
            <div class="modal-body">
                <div class="form-group" style="margin:0px;">
                    <?php echo base64_decode($oBroadcast->stripo_compiled_html); ?> 
                </div>
            </div>
        </div>
    </div>
</div>

<!--<script>
    $(document).ready(function () {
        $(".hr-time-picker").hrTimePicker({
            disableColor: "#989c9c", // red, green, #000
            enableColor: "#ff5722", // red, green, #000
            arrowTopSymbol: "&#9650;", // ▲ -- Enter html entity code
            arrowBottomSymbol: "&#9660;" // ▼ -- Enter html entity code
        });
    });
</script>-->

<!--<script>
    $(function () {
        $("#datepicker").datepicker();
        $('#timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>-->

<script>
    $(document).ready(function () {
        $(".emailPreview").click(function () {
            $("#emailPreviewPopup").modal();
        });

        $(".chooselist").click(function () {
            $("#chooselistModal").modal();
        });

        $(".chooseSchedule").click(function () {
            $("#chooseScheduleDate").modal();
        });

        $('#sendTestEmailPreview').on('click', function () {
            $('.overlaynew').show();
            var emailAddress = $('#testCampaignEmail').val();

            $.ajax({
                url: '<?php echo base_url('admin/workflow/sendTestEmailworkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'moduleName': '<?php echo $moduleName;?>', 'email': emailAddress, campaignId: '<?php echo $oCampaign[0]->id; ?>'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup('success', '', 'Test Email has been sent successfully. Please check in your email.');

                    }
                }
            });
            return false;
        });
        
        $('#sendTestSMSPreview').on('click', function () {
            $('.overlaynew').show();
            var phone = $('#testCampaignSMS').val();

            $.ajax({
                url: '<?php echo base_url('admin/workflow/sendTestSMSworkflowCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'moduleName': '<?php echo $moduleName;?>', 'number': phone, campaignId: '<?php echo $oCampaign[0]->id; ?>'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup('success', '', 'Test Sms has been sent successfully');

                    }
                }
            });
            return false;
        });

        $('#frmSaveAutomationList').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmSaveAutomationList").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/emails/updateAutomationLists'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        //alertMessageAndRedirect(data.msg, window.location.href);
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.launchCampaign', function () {
            var broadcastId = $(this).attr('broadcastId');
            var status = $(this).attr('status');
            var current_state = $(this).attr('current_state');
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/updateBroadcast'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', broadcastId: broadcastId, status: status, current_state: current_state},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup('success', '', 'Campaign changes has been saved sucessfully!'); //javascript notification msg
                        //alertMessageAndRedirect(data.msg, '<?php echo base_url('admin/broadcast'); ?>');
                        if (status != 'draft') {
                            $("#processingBroadcast").modal("show");
                            /*setTimeout(function () {
                                window.location.href = '<?php echo base_url('admin/broadcast/'); ?><?php echo (strtolower($oBroadcast->campaign_type) == 'email') ? 'email' : 'sms'; ?>';
                            }, 3000);*/
                        }


                    }
                }
            });
            return false;
        });

        $('#frmSaveAutomationScheduleDate').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmSaveAutomationScheduleDate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/updateAutomationScheduleDate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });

        $('#frmBroadcastEmailFrom').on('submit', function (e) {
            e.preventDefault();
            $('.overlaynew').show();
            var formdata = $("#frmBroadcastEmailFrom").serialize();

            $.ajax({
                url: '<?php echo base_url('admin/broadcast/updateBroadcastFromEmail'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $('#editBroadcastEmailFrom').modal('hide');
                        $('.bcfromemail').html($('#edit_from_email').val());
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error: function () {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });

        $('#frmBroadcastEmailSubject').on('submit', function (e) {
            e.preventDefault();
            $('.overlaynew').show();
            var formdata = $("#frmBroadcastEmailSubject").serialize();

            $.ajax({
                url: '<?php echo base_url('admin/broadcast/updateBroadcastSubject'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $('#editBroadcastEmailSubject').modal('hide');
                        $('.bcemailsubject').html($('#edit_email_subject').val());
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error: function () {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });


    });

    /* $(document).ready(function () {
     $("#anytime-time-hours4").AnyTime_picker({
     format: "%l %p"
     });
     
     
     $('.daterange-single').daterangepicker({
     singleDatePicker: true
     });
     
     });*/
</script>
