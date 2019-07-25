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
<style>
    .form-control::placeholder {color: #011540 !important;}
    .interactions ul li small{color: #09204f;}
    .email_sec.small .form-group{margin-bottom: 28px;}

    .pickadate.bkg_white{background: url(<?php echo base_url(); ?>assets/images/icon_calender3_blue.png) 95% 16px no-repeat #fff!important}
    .picker{top: -339px;}
    .picker--opened .picker__holder{max-height: 580px;}
    .picker__day--selected, .picker__day--selected:hover, .picker--focused .picker__day--selected {	background-color: #34aaff;	color: #fff;	border-radius: 100px;}
    .picker__day--today::before {	display: none;}
    .picker__day--today {	position: relative;	background-color: #80c7fb;border-radius: 100%;color: #fff!important;}
    .picker__day {	padding: 0;width: 30px;height: 30px;line-height: 30px;}
    .picker__table td {	margin: 0;	padding: 4px 5px;}
    .picker__day--infocus:hover, .picker__day--outfocus:hover {	cursor: pointer;	color: #333333;	background-color: #f5f5f5;border-radius: 100%;}

    .picker__month, .picker__year{font-size: 14px!important; color: #425784!important; font-weight: 400!important;}
    .picker__holder{border-radius: 4px!important;  box-shadow: 0 3px 5px 0 rgba(1, 21, 64, 0.04), 0 10px 20px 0 rgba(1, 21, 64, 0.02)!important;  border: solid 1px #ebeff6!important; padding-top: 0px;}
    .picker__box{padding: 5px 10px!important;}
    /*    .picker__header {	text-align: center;	position: relative;	font-size: 15px;line-height: 1;	padding-top: 15px;	padding-bottom: 15px; border-bottom: 1px solid #eee; border-top: 1px solid #eee;  margin: 110px -10px 0; }*/
    .picker__header {	text-align: center;	position: relative;	font-size: 15px;line-height: 1;	padding-top: 15px;	padding-bottom: 15px; border-bottom: 1px solid #eee; border-top: 1px solid #eee;  margin: 10px -10px 0; }
    .picker__footer{border-top: 1px solid #eee; padding-top: 10px; padding-bottom: 5px; margin: 0 -10px; display: none;}
    .picker__table{margin: 10px 0!important;}

    .select_day{position:absolute; width: 100%; padding: 10px 20px; top: 0; left: 0; box-sizing: border-box; }
    .select_day a{display: block; padding: 5px 0; color: #253b6a; font-size: 14px;}
    .select_day a.active{font-weight: 600;}

    .picktime{position:relative; height: 50px; padding: 10px 20px; box-sizing: border-box; border-top: 1px solid #eee; margin: 0 -10px; }
    .picktime a{display: block; padding: 5px 0; color: #253b6a; font-size: 14px;}
    .picktime a.active{font-weight: 600;}
    .ui-timepicker-standard {top:555px!important;border:none!important;}
    .selecttime.bkg_white {
        background: url(http://dev.brandboost.io/assets/images/icon_calender3_blue.png) 95% 16px no-repeat #fff!important;
    }



</style>
<?php
$colorClass = (strtolower($oBroadcast->campaign_type) == 'email') ? 'sblue' : 'green';
if (!empty($oBroadcast)) {
    $aMainTriggerData = json_decode($oBroadcast->data);
}
$aDeliveryParam = json_decode($oBroadcast->data);
$deliveryDate = $aDeliveryParam->delivery_date;
$deliveryTime = $aDeliveryParam->delivery_time;
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>

<script src="<?php echo base_url(); ?>assets/js/plugins/pickers/anytime.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/hr.timePicker.min.js"></script>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hr-timePicker.min.css">-->
<style>
    ul{list-style-type:none;margin:0;padding:0}.main-wrapper{max-width:768px;margin:150px auto}
</style>
<div id="broadcastConfiguration" class="broadcastTab" <?php if ($activeTab != 'Settings'): ?> style="display:none;"<?php endif; ?>>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Broadcast Configuration</h6>
                    <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                </div>
                <div class="panel-body p0 bkg_white">
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb0">
                                    <label>Broadcast name</label>
                                    <input class="form-control h52 updatesettings" type="text" id="edit_campaign_name" name="title" value="<?php echo $oBroadcast->title; ?>" placeholder="Test broadcast" required="required">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p30">

                        <div class="row">
                            <?php if (strtolower($oBroadcast->campaign_type) != 'sms'): ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input class="form-control h52 updatesettings" type="text" value="<?php echo $oBroadcast->subject; ?>" name="subject" id="email_subject" placeholder="Email Broadcast Subject">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From Name</label>
                                        <input class="form-control h52 updatesettings" type="text" value="<?php echo $oBroadcast->from_name == '' ? $userData->firstname . ' ' . $userData->lastname : $oBroadcast->from_name; ?>" name="from_name" id="from_name" placeholder="Mr Anderson">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From Email</label>
                                        <input class="form-control h52 updatesettings" type="text" value="<?php echo $oBroadcast->from_email == '' ? $userData->email : $oBroadcast->from_email; ?>" name="from_email" id="from_email" placeholder="umair@nethues.com">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb0">
                                        <label>Reply to</label>
                                        <input class="form-control h52 updatesettings" type="text"  value="<?php echo $oBroadcast->reply_to == '' ? $userData->email : $oBroadcast->reply_to; ?>" name="reply_to" id="reply_to_email" placeholder="umair@nethues.com">
                                    </div>
                                </div>

                            <?php else: ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>From Number</label>
                                        <input class="form-control h52 updatesettings" type="text" readonly="readonly" value="<?php echo $twillioData->contact_no; ?>" name="from_number" id="from_number" placeholder="Broadcast From Number">
                                    </div>
                                </div>
                            <?php endif; ?>


                        </div>


                    </div>


                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Sending Options</h6>
                    <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                </div>
                <div class="panel-body p0 bkg_white">
                    <div class="p30">
                        <div class="form-group mb0">
                            <label class="custmo_radiobox pull-left mb20">
                                <input name="sending_method" class="updatesettings" value="normal" type="radio" <?php echo ($oBroadcast->sending_method == 'normal') ? 'checked="checked"' : ''; ?>>
                                <span class="custmo_radiomark <?php
                                if (strtolower($oBroadcast->campaign_type) == 'sms') {
                                    echo 'green';
                                }
                                ?>"></span>
                                Normal Sending
                            </label>
                            <label class="custmo_radiobox pull-left mb20 ml10">
                                <input name="sending_method" class="updatesettings" value="split" <?php echo ($oBroadcast->sending_method == 'split') ? 'checked="checked"' : ''; ?> type="radio">
                                <span class="custmo_radiomark <?php
                                if (strtolower($oBroadcast->campaign_type) == 'sms') {
                                    echo 'green';
                                }
                                ?>"></span>
                                Split Testing
                            </label>
                        </div>
                    </div>

                    <div class="bbot p30" id="spt_container" <?php if ($oBroadcast->sending_method == 'normal'): ?> style="display:none;"<?php endif; ?>>

                        <div class="row">


                            <div class="form-group">
                                <label>Test Name</label>
                                <input class="form-control h52 updateSplitTest" st_id="<?php echo $oVariations[0]->splitID; ?>" type="text" value="<?php echo $oVariations[0]->test_name; ?>" name="test_name" placeholder="Split test demo">
                            </div>


                        </div>




                        @include('admin.broadcast.partials.add_split_form')




                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Settings</h6>
                    <div class="heading-elements"><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                </div>
                <div class="panel-body p0 bkg_white">

                    <div class="bbot p20 pl30 pr30">
                        <div class="interactions configurations">
                            <ul>
                                <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                                    <li><small class="wauto">Generate a text version of the email</small> 
                                        <label class="custom-form-switch pull-right">
                                            <input class="field checkedBoxValue updatesettings" value="<?php echo $broadcastSettings->text_version_email != '0' ? '1' : '0'; ?>" <?php echo $broadcastSettings->text_version_email != '0' ? 'checked' : ''; ?> name="text_version_email" id="textVersionEmail" type="checkbox">
                                            <span class="toggle <?php echo $colorClass; ?>"></span>
                                        </label>
                                    </li>
                                    <li><small class="wauto">Enable Mobile Responsiveness</small> 
                                        <label class="custom-form-switch pull-right">
                                            <input class="field checkedBoxValue updatesettings" value="<?php echo $broadcastSettings->enable_mobile_responsiveness != '0' ? '1' : '0'; ?>" <?php echo $broadcastSettings->enable_mobile_responsiveness != '0' ? 'checked' : ''; ?> id="enableMobileResponsiveness" name="enable_mobile_responsiveness" type="checkbox">
                                            <span class="toggle <?php echo $colorClass; ?>"></span>
                                        </label>
                                    </li>

                                    <li><small class="wauto">Open/Read Tracking</small> 
                                        <label class="custom-form-switch pull-right">
                                            <input class="field checkedBoxValue updatesettings"  value="<?php echo $broadcastSettings->read_tracking != '0' ? '1' : '0'; ?>" <?php echo $broadcastSettings->read_tracking != '0' ? 'checked' : ''; ?> name="read_tracking" id="readTracking" type="checkbox" >
                                            <span class="toggle <?php echo $colorClass; ?>"></span>
                                        </label>
                                    </li>
                                <?php endif; ?>
                                <li><small class="wauto">Link Tracking</small> 
                                    <label class="custom-form-switch pull-right">
                                        <input class="field checkedBoxValue updatesettings" value="<?php echo $broadcastSettings->link_tracking != '0' ? '1' : '0'; ?>" <?php echo $broadcastSettings->link_tracking != '0' ? 'checked' : ''; ?> name="link_tracking" id="linkTracking" type="checkbox">
                                        <span class="toggle <?php echo $colorClass; ?>"></span>
                                    </label>
                                </li>
                                <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                                    <li><small class="wauto">Reply Tracking</small> 
                                        <label class="custom-form-switch pull-right">
                                            <input class="field checkedBoxValue updatesettings" value="<?php echo $broadcastSettings->reply_tracking != '0' ? '1' : '0'; ?>" <?php //echo $broadcastSettings->reply_tracking != '0' ? 'checked' : ''; ?> name="reply_tracking" id="replyTracking" type="checkbox" disabled="disabled">
                                            <span class="toggle <?php echo $colorClass; ?>"></span>
                                        </label>
                                    </li>
                                <?php endif; ?>
                                <li><small class="wauto">Google Analytics</small> 
                                    <label class="custom-form-switch pull-right">
                                        <input class="field checkedBoxValue updatesettings" value="<?php echo $broadcastSettings->google_analytics != '0' ? '1' : '0'; ?>" <?php //echo $broadcastSettings->google_analytics != '0' ? 'checked' : ''; ?> name="google_analytics" id="googleAnalytics" type="checkbox" disabled="disabled">
                                        <span class="toggle <?php echo $colorClass; ?>"></span>
                                    </label>
                                </li>
                                <li><small class="wauto">Campaign Archives</small> 
                                    <label class="custom-form-switch pull-right">
                                        <input class="field checkedBoxValue updatesettings" value="<?php echo $broadcastSettings->campaign_archives != '0' ? '1' : '0'; ?>" <?php //echo $broadcastSettings->campaign_archives != '0' ? 'checked' : ''; ?> id="campaignArchives" name="campaign_archives" type="checkbox" disabled="disabled">
                                        <span class="toggle <?php echo $colorClass; ?>"></span>
                                    </label>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Schedule Broadcast (Eastern Time)</h6>
                    <div class="heading-elements"><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/more.svg"/></a></div>
                </div>
                <div class="panel-body p0 bkg_white">
                    <div class="bbot p20 pl30 pr30">
                        <div class="position-relative">
                            Date: <input type="text" name="delivery_date" value="<?php echo (!empty($deliveryDate)) ? $deliveryDate : date("m/d/Y"); ?>" class="form-control h52 pickadate bkg_white updateSchedule" placeholder="Send now" data-value="<?php echo (!empty($deliveryDate)) ? $deliveryDate : date("m/d/Y"); ?>">

                        </div>
                    </div>

                </div>
                <div class="panel-body p0 bkg_white">
                    <div class="bbot p20 pl30 pr30">
                        <label>Time</label>
                        <div class="form-group">
                            <label class="custmo_checkbox">
                                <input type="radio" name="chooseTimeBroadcast" class="form-control chooseTimeBroadcast"  value="now">
                                <span class="custmo_checkmark sblue"></span>
                                &nbsp;Send Now
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="custmo_checkbox">
                                <input type="radio" name="chooseTimeBroadcast" class="form-control chooseTimeBroadcast" value="later" checked="checked">
                                <span class="custmo_checkmark sblue"></span>
                                &nbsp;Send Later
                            </label>
                        </div>    
                        <div class="position-relative displayanytimePicker">
                            <input type="text" id="anytime-time" name="delivery_time" value="<?php echo (!empty($deliveryTime)) ? $deliveryTime : '9 PM'; ?>" class="form-control h52 bkg_white selecttime updateSchedule" placeholder="9 PM">

                        </div>
                        <!--                        <div>
                                                    <div class="hr-time-picker">
                                                        <div class="picked-time-wrapper">
                                                            <input type="text" name="delivery_time" class="form-control h52 updateSchedule picked-time" value="<?php echo (!empty($deliveryTime)) ? $deliveryTime : '9 PM'; ?>" placeholder="9 PM">
                                                        </div>
                                                        <div class="pick-time-now">
                                                            <div class="hours hr-timer">
                                                                <div class="movable-area">
                                                                    <ul></ul>
                                                                </div>
                                                            </div>
                                                            <div class="minutes hr-timer">
                                                                <ul></ul>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>-->
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<div id="subscriberTagListsModal" class="modal fade">
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
</div>

<script src="<?php echo base_url(); ?>assets/js/modules/people/subscribers.js" type="text/javascript"></script>
<script>
    $(".chooseTimeBroadcast").change(function () {
        if ($(this).val() == 'now') {
            $(".displayanytimePicker").hide();
            var date, hours, minutes;
            date = new Date();
            hours = date.getHours();
            minutes = date.getMinutes();
            $(".selecttime").val(hours + ":" + minutes);
        } else if ($(this).val() == 'later') {
            $(".displayanytimePicker").show();
        }
    });

    $(document).on("click", "#settimenow", function () {
        var date, hours, minutes;
        date = new Date();
        hours = date.getHours();
        minutes = date.getMinutes();
        $(".picked-time").val(hours + ":" + minutes);
    });

    /*var tableId = 'broadcastAudience';
    var tableBase = custom_data_table(tableId);

    var tableId2 = 'editBroadcastAudience';
    var tableBase2 = custom_data_table(tableId2);*/

    /*var tableId3 = 'editBroadcastAudience';
     var tableBase3 = custom_data_table(tableId3);*/
    //$('table thead tr:eq(1)').hide();

    $(document).on("change", ".updatesettings", function () {
        var fieldName = $(this).attr('name');
        var fieldVal = $(this).val();
        $('.overlaynew').show();
        $.ajax({
            url: '<?php echo base_url('admin/broadcast/updateBroadcastSettingUnit'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', fieldName: fieldName, fieldVal: fieldVal, 'event_id': '<?php echo $oBroadcast->event_id; ?>', 'campaign_id': '<?php echo $oBroadcast->id; ?>', broadcast_id: '<?php echo $oBroadcast->broadcast_id; ?>'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', '', 'Settings updated successfully!');
                    if (fieldName == 'sending_method' && fieldVal == 'normal') {
                        $("#spt_container").hide();

                    } else if (fieldName == 'sending_method' && fieldVal == 'split') {
                        $("#spt_container").show();
                    }
                    $('.overlaynew').hide();
                }
            }, error: function () {
                $('.overlaynew').hide();
                alertMessage('Error: Some thing wrong!');
            }
        });

    });

    $(document).on("click", ".btnDeleteVariation", function () {

        deleteConfirmationPopup("This variation will deleted immediately.<br>You can't undo this action.",
                () => {
            var variationID = $(this).attr('variation-id');
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/deleteVariation'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', variationID: variationID},
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        displayMessagePopup('success', '', 'Variation has been deleted successfully.');
                        $("#variation_container_" + variationID).remove();
                    } else {
                        displayMessagePopup('error');
                    }
                }
            });
        });


    });

    $(document).on("change", ".updateSplitTest", function () {
        var testid = $(this).attr('st_id');
        var fieldVal = $(this).val();
        $.ajax({
            url: '<?php echo base_url('admin/broadcast/updateSplitTest'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', fieldVal: fieldVal, testid: testid},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    //do nothing for now
                    displayMessagePopup('success', '', 'Variation updated successfully!');
                }
            }, error: function () {
                $('.overlaynew').hide();
                alertMessage('Error: Some thing wrong!');
            }
        });

    });

    $(document).on("change", ".updateVariation", function () {
        var fieldName = $(this).attr('name');
        var fieldVal = $(this).val();
        var variationID = $(this).attr('variation_id');
        if (fieldName == 'variation_load') {
            var elem = $(this);
            var curNum = fieldVal
            var total = 0;
            $("input[name='variation_load']").each(function () {
                total += Number($(this).val());
            });
            var otherTotal = total - curNum;
            var threshold = 100 - otherTotal;
            if (total > 100) {
                $(elem).val(threshold);
                fieldVal = threshold;

            }

        }

        $.ajax({
            url: '<?php echo base_url('admin/broadcast/updateVariation'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', fieldName: fieldName, fieldVal: fieldVal, variationID: variationID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    if (fieldName != 'variation_load') {
                        displayMessagePopup('success', '', 'Variation updated successfully!');
                    }
                }
            }, error: function () {
                $('.overlaynew').hide();
                alertMessage('Error: Some thing wrong!');
            }
        });
    });

    function isValidateVariations() {
        var bValidated = true;
        $("input[name='variation_name']").each(function () {
            if ($(this).val() == '') {
                var elem = $(this);
                $(elem).next(".validation").remove();
                $(elem).after("<div class='validation' style='color:red;margin-bottom: 20px;'>Mandatory Field</div>");
                //alertMessage('Please enter email subject.');
                setTimeout(function () {
                    $(elem).next(".validation").remove();
                }, 5000);
                $(this).focus();
                bValidated = false;
                return false;
            }
        });
        
        $("select[name='variation_template']").each(function () {
            if ($(this).val() == '') {
                var elem = $(this);
                $(elem).next(".validation").remove();
                $(elem).after("<div class='validation' style='color:red;margin-bottom: 20px;'>Mandatory Field</div>");
                //alertMessage('Please enter email subject.');
                setTimeout(function () {
                    $(elem).next(".validation").remove();
                }, 5000);
                $(this).focus();
                bValidated = false;
                return false;
            }
        });
        return bValidated;

    }

    $(document).on("click", "#btnAddMoreVariations", function () {
        //Apply validation on previously opened variations
        var bPreviousValidated = isValidateVariations();
        if (bPreviousValidated == true) {
            $('.overlaynew').show();
            var broadcast_id = $(this).attr('broadcast_id');
            var campaign_type = '<?php echo strtolower($oBroadcast->campaign_type); ?>';
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addVariation'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', broadcast_id: broadcast_id, campaign_type: campaign_type},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#split_container").append(data.content);
                        $('.overlaynew').hide();
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error: function () {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            });
        }



    });

    $(document).on("change", ".updateSchedule", function () {

        var tab = $(this).attr('tab');
        var delivery_date = $('input[name="delivery_date"]').val();
        var delivery_time = $('input[name="delivery_time"]').val();

        $.ajax({
            url: '<?php echo base_url('admin/broadcast/updateBroadcastSettings'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', 'event_id': '<?php echo $oBroadcast->event_id; ?>', 'campaign_id': '<?php echo $oBroadcast->id; ?>', broadcast_id: '<?php echo $oBroadcast->broadcast_id; ?>', delivery_date: delivery_date, delivery_time: delivery_time, 'tab': tab},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    displayMessagePopup('success', '', 'Settings updated successfully!');
                }
            }, error: function () {
                $('.overlaynew').hide();
                alertMessage('Error: Some thing wrong!');
            }
        });
    });

    $(document).on("click", "#updateSettings", function () {
         var bVar = isValidateVariations();
         if(bVar == false)
             return false;
        var emailSubject = $('#email_subject').val();
        var broadcastName = $("#edit_campaign_name").val();
        var fromName = $("#from_name").val();
        var fromEmail = $("#from_email").val();
        var replyEmail = $("#reply_to_email").val();
        var tab = $(this).attr('tab');
        var delivery_date = $('input[name="delivery_date"]').val();
        var delivery_time = $('input[name="delivery_time"]').val();

        if (broadcastName == '') {
            $("#edit_campaign_name").focus();
            $("#edit_campaign_name").next(".validation").remove();
            $("#edit_campaign_name").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Mandatory Field</div>");
            //alertMessage('Please enter email subject.');
            setTimeout(function () {
                $("#edit_campaign_name").next(".validation").remove();
            }, 5000);

            return false;

        }

        if (fromName == '') {
            $("#from_name").focus();
            $("#from_name").next(".validation").remove();
            $("#from_name").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Mandatory Field</div>");
            //alertMessage('Please enter email subject.');
            setTimeout(function () {
                $("#from_name").next(".validation").remove();
            }, 5000);

            return false;

        }

        if (fromEmail == '') {
            $("#from_email").focus();
            $("#from_email").next(".validation").remove();
            $("#from_email").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Mandatory Field</div>");
            //alertMessage('Please enter email subject.');
            setTimeout(function () {
                $("#from_email").next(".validation").remove();
            }, 5000);

            return false;

        }

        if (replyEmail == '') {
            $("#reply_to_email").focus();
            $("#reply_to_email").next(".validation").remove();
            $("#reply_to_email").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Mandatory Field</div>");
            //alertMessage('Please enter email subject.');
            setTimeout(function () {
                $("#reply_to_email").next(".validation").remove();
            }, 5000);

            return false;

        }

<?php if (strtolower($oBroadcast->campaign_type) == 'email') { ?>
            if (emailSubject == '') {
                $('#email_subject').focus();
                $("#email_subject").next(".validation").remove();
                $("#email_subject").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Mandatory Field</div>");
                //alertMessage('Please enter email subject.');
                setTimeout(function () {
                    $("#email_subject").next(".validation").remove();
                }, 5000);

                return false;
            }
<?php } ?>

        $('.overlaynew').show();

        $.ajax({
            url: '<?php echo base_url('admin/broadcast/updateBroadcastSettings'); ?>',
            type: "POST",
            data: {_token: '{{csrf_token()}}', 'event_id': '<?php echo $oBroadcast->event_id; ?>', 'campaign_id': '<?php echo $oBroadcast->id; ?>', broadcast_id: '<?php echo $oBroadcast->broadcast_id; ?>', delivery_date: delivery_date, delivery_time: delivery_time, 'tab': tab},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    window.location.href = window.location.href;
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

    $(document).on('click', '.checkedBoxValue', function () {
        if ($(this).prop('checked'))
        {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $(document).ready(function () {
        $('.pickadate').pickadate({format: 'm/d/yyyy', formatSubmit: 'm/d/yyyy'});


        //        $(".picker__box").append('<div class="select_day"><a class="active" href="">Now</a><a class="" href="">Tomorrow</a><a class="" href="">Next week</a></div>');
        //
        //
        //        $(".picker__box").append('<div class="picktime"><a class="" href="">Add time</a></div>');

    });
    /* ------------------------------------------------------------------------------
     *
     *  # Date and time pickers
     *
     *  Demo JS code for picker_date.html page
     *
     * ---------------------------------------------------------------------------- */


    // Setup module
    // ------------------------------

    var DateTimePickers = function () {


        //
        // Setup module components
        //

        // Anytime picker
        var _componentAnytime = function () {
            if (!$().AnyTime_picker) {
                console.warn('Warning - anytime.min.js is not loaded.');
                return;
            }

            // Time picker
            $('#anytime-time').AnyTime_picker({
                format: '%H:%i'
            });


            //
            // Date range
            //

            // Options
            var oneDay = 24 * 60 * 60 * 1000;
            var rangeDemoFormat = '%e-%b-%Y';
            var rangeDemoConv = new AnyTime.Converter({format: rangeDemoFormat});

            // Set today's date
            $('#rangeDemoToday').on('click', function (e) {
                $('#rangeDemoStart').val(rangeDemoConv.format(new Date())).trigger('change');
            });

            // Clear dates
            $('#rangeDemoClear').on('click', function (e) {
                $('#rangeDemoStart').val('').trigger('change');
            });

            // Start date
            $('#rangeDemoStart').AnyTime_picker({
                format: rangeDemoFormat
            });

            // On value change
            $('#rangeDemoStart').on('change', function (e) {
                try {
                    var fromDay = rangeDemoConv.parse($('#rangeDemoStart').val()).getTime();

                    var dayLater = new Date(fromDay + oneDay);
                    dayLater.setHours(0, 0, 0, 0);

                    var ninetyDaysLater = new Date(fromDay + (90 * oneDay));
                    ninetyDaysLater.setHours(23, 59, 59, 999);

                    // End date
                    $('#rangeDemoFinish')
                            .AnyTime_noPicker()
                            .removeAttr('disabled')
                            .val(rangeDemoConv.format(dayLater))
                            .AnyTime_picker({
                                earliest: dayLater,
                                format: rangeDemoFormat,
                                latest: ninetyDaysLater
                            });
                } catch (e) {

                    // Disable End date field
                    $('#rangeDemoFinish').val('').attr('disabled', 'disabled');
                }
            });
        };


        //
        // Return objects assigned to module
        //

        return {
            init: function () {
                _componentAnytime();
            }
        }
    }();


    // Initialize module
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function () {
        DateTimePickers.init();
    });


</script>