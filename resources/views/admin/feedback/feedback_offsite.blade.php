<?php list($canRead, $canWrite) = fetchPermissions('Feedbacks'); ?>
<?php
$aData['allTab'] = '';
$aData['postiveTab'] = '';
$aData['neutralTab'] = '';
$aData['negativeTag'] = '';


if ($selected_tab == 'all') {
    $allTab = 'active';
    $aData['allTab'] = $allTab;
} else if ($selected_tab == 'positive') {
    $postiveTab = 'active';
    $aData['postiveTab'] = $postiveTab;
} else if ($selected_tab == 'neutral') {
    $neutralTab = 'active';
    $aData['neutralTab'] = $neutralTab;
} else if ($selected_tab == 'negative') {
    $negativeTag = 'active';
    $aData['negativeTag'] = $negativeTag;
} else {
    $allTab = 'active';
    $aData['allTab'] = $allTab;
}


if (!empty($result)) {
    foreach ($result as $record) {
        if ($record->category == 'Positive') {
            $oPositive[] = $record;
        } else if ($record->category == 'Neutral') {
            $oNuetral[] = $record;
        } else if ($record->category == 'Negative') {
            $oNegative[] = $record;
        }
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">

                <h6 class="panel-title">Requires Attention</h6>

                <?php
                $titleName = '';
                $revType = "Offsite";
                if (!empty($brandboostDetail[0]->review_type)) {
                    $revType = $brandboostDetail[0]->review_type;
                }
                if (!empty($brandboostDetail[0]->brand_title)) {

                    $titleName = ': ' . ucfirst($brandboostDetail[0]->brand_title);
                }
                ?>

                <!--<h6 class="panel-title">New Note</h6>-->
                <ul class="nav nav-tabs nav-tabs-bottom" id="nav-tabs-bottom" style="position: absolute; top: 20px; left: 15%;">
                    <li class="<?php echo $allTab; ?>"><a href="#right-icon-tab11" data-toggle="tab"> All (<?php echo count($result); ?>)</a></li>
                    <li class="<?php echo $postiveTab; ?>"><a id="positive_tag" href="#right-icon-tab12" data-toggle="tab"> Positive (<?php echo count($oPositive); ?>)</a></li>
                    <li class="<?php echo $neutralTab; ?>"><a href="#right-icon-tab13" data-toggle="tab"> Neutral (<?php echo count($oNuetral); ?>)</a></li>
                    <li class="<?php echo $negativeTag; ?>"><a href="#right-icon-tab14" data-toggle="tab"> Negative (<?php echo count($oNegative); ?>)</a></li>
                </ul>
                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                        <div class="form-control-feedback">
                            <i class="icon-search4"></i>
                        </div>
                    </div>&nbsp; &nbsp;

                    <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                    <button id="deleteButtonBrandboostFeedbacks" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                </div>

            </div>

            <div class="tab-content">

                <!--########################TAB 1 ##########################-->
                <?php $this->load->view("admin/feedback/feedback-tab/feeback-all", array('aData' => $result, 'allTab' => $allTab)) ?>
                <!--########################TAB 2 ##########################-->
                <?php $this->load->view("admin/feedback/feedback-tab/feedback-positive", array('aData' => $oPositive, 'postiveTab' => $postiveTab)); ?>
                <!--########################TAB 3 ##########################-->
                <?php $this->load->view("admin/feedback/feedback-tab/feedback-nuetral", array('aData' => $oNuetral, 'neutralTab' => $neutralTab)); ?>
                <!--########################TAB 4 ##########################-->
                <?php $this->load->view("admin/feedback/feedback-tab/feedback-negative", array('aData' => $oNegative, 'negativeTag' => $negativeTag)); ?>


            </div>
        </div>
    </div>
</div>

<!-- /content area -->
<div id="feedbackPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body" id="feedbackContent"></div>
                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="feedbackTime"></span>
                            </span>

                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>

                            <ul class="icons-list" style="float:right;">  
                                <li class="dropup"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <?php if ($canWrite): ?>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="text-semibold" style="border-bottom:1px solid #ddd; padding:5px 15px 10px;">Change Status</li>
                                            <li class="bg-danger updateFeedbackStatus" fb_status="Negative" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Negative</li>
                                            <li class="bg-blue updateFeedbackStatus" fb_status="Neutral" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Neutral</li>
                                            <li class="bg-success updateFeedbackStatus" fb_status="Positive" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Positive</li>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="previewFeedbackReply" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body" id="previewFeedbackReplyContent"></div>
                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="FeedbackTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmFeedbackTagListModal" id="frmFeedbackTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>

                <div class="modal-body" id="tagEntireList">

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="feedback_id" id="tag_feedback_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $("#frmFeedbackTagListModal").submit(function () {
            var formdata = $("#frmFeedbackTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyFeedbackTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#FeedbackTagListModal").modal("hide");
                        //alertMessageAndRedirect('Tags applied successfully!', window.location.href);
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });

        $(document).on("click", ".applyInsightTags", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/tags/listAllTags'); ?>',
                type: "POST",
                data: {review_id: review_id, feedback_id: feedback_id, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#tagEntireList").html(data.list_tags);
                        $("#tag_review_id").val(review_id);
                        $("#tag_feedback_id").val(feedback_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModal").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModal").modal("show");
                        }
                    }
                }
            });
        });

        $(document).on("click", ".editBrandboost", function () {

            var brandboostID = $(this).attr('brandID');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_offsite_step1'); ?>',
                type: "POST",
                data: {'brandboostID': brandboostID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('admin/brandboost/offsite_step_2'); ?>';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on("click", ".displayFeedback", function () {
            var elem = $(this);
            var fid = $(this).attr("feedback_id");
            var tabtype = $(this).attr('fb_tab_type');
            var fbtime = $(this).attr('fb_time');
            displayFeedbackPopup(fid, tabtype, fbtime);

        });

        function displayFeedbackPopup(feedbackid, tabtype, fbtime) {
            //$('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/feedback/displayfeedback'); ?>",
                type: "POST",
                data: {fid: feedbackid, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        $('.overlaynew').hide();
                        $("#feedbackContent").html(response.popup_data);
                        $(".feedbackTime").html(fbtime);
                        $("#feedbackPopup").modal("show");
                        if (tabtype == 'note') {
                            $('.tabbable a[href="#note-tab"]').trigger('click');
                        } else {
                            $('.tabbable a[href="#feedback-tab"]').trigger('click');
                        }
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        }

        $(document).on("click", "#sendFeedbackEmail, #sendFeedbackSMS", function () {
            var career = $(this).attr("career_medium");
            var alertMsg = 'One credit will be deducted for sending this email/sms!';
            if (career == 'sms') {
                alertMsg = 'One credit will be deducted for sending this sms!';
            } else {
                alertMsg = 'One credit will be deducted for sending this email!';
            }

            swal({
                title: "Are you sure?",
                text: alertMsg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, send it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            var formdata = $("#frmSendFeedbackReply").serialize();
                            $('.overlaynew').show();
                            $.ajax({
                                url: "<?php echo base_url('/admin/feedback/replyFeedback'); ?>",
                                type: "POST",
                                data: formdata + "&career=" + career,
                                dataType: "json",
                                success: function (response) {
                                    $('.overlaynew').hide();
                                    if (response.status == "success") {
                                        swal({
                                            title: "Success!",
                                            text: response.message,
                                            confirmButtonColor: "#66BB6A",
                                            type: "success"
                                        });
                                    } else {
                                        swal({
                                            title: "ERROR!",
                                            text: response.message,
                                            confirmButtonColor: "#2196F3",
                                            type: "error"
                                        });
                                    }
                                },
                                error: function (response) {
                                    $('.overlaynew').hide();
                                    swal({
                                        title: "ERROR!",
                                        text: response.message,
                                        confirmButtonColor: "#2196F3",
                                        type: "error"
                                    });
                                }
                            });
                        } else {
                            swal({
                                title: "Cancelled",
                                text: "",
                                confirmButtonColor: "#2196F3",
                                type: "error"
                            });
                        }
                    });
        });

        $(document).on("click", "#saveFeedbackNote", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/feedback/saveFeedbackNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        var fid = $("input[name='fid']").val();
                        var fbtime = $("input[name='fbtime']").val();
                        var tabtype = 'note';
                        displayFeedbackPopup(fid, tabtype, fbtime);
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });




        $(document).on("click", ".updateFeedbackStatusNew", function () {
            $('.overlaynew').show();
            var feedbackid = $(this).attr('feedback_id');
            var statusVal = $(this).attr('fb_status');
            $.ajax({
                url: "<?php echo base_url('/admin/feedback/updateFeedbackRatings'); ?>",
                type: "POST",
                data: {fid: feedbackid, status: statusVal, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        $('.overlaynew').hide();
                        //alertMessageAndRedirect(response.message, window.location.href);
                        window.location.href = window.location.href;
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });

        $(document).on("click", ".updateFeedbackStatus", function () {
            $('.overlaynew').show();
            var feedbackid = $("input[name='fid']").val();
            var fbtime = $("input[name='fbtime']").val();
            var statusVal = $(this).attr('fb_status');
            $.ajax({
                url: "<?php echo base_url('/admin/feedback/updateFeedbackRatings'); ?>",
                type: "POST",
                data: {fid: feedbackid, status: statusVal, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        displayFeedbackPopup(feedbackid, 'feedback', fbtime);
                        alertMessage(response.message);
                        $('.reiewStatus' + feedbackid).html(statusVal);
                        var statusCls = '';
                        if (statusVal == 'Neutral') {
                            statusCls = 'bg-blue';
                        } else if (statusVal == 'Negative') {
                            statusCls = 'bg-danger';
                        } else {
                            statusCls = 'bg-success';
                        }
                        $('.reiewStatus' + feedbackid).removeClass('bg-success');
                        $('.reiewStatus' + feedbackid).removeClass('bg-danger');
                        $('.reiewStatus' + feedbackid).removeClass('bg-blue');
                        $('.reiewStatus' + feedbackid).addClass(statusCls);
                        var statusStarVal = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                        if (statusVal == 'Neutral') {
                            statusStarVal = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i>';
                        } else if (statusVal == 'Negative') {
                            statusStarVal = '<i class="fa fa-star"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i>';
                        }
                        $('#ratingBoxStatus' + feedbackid).html(statusStarVal);
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });


        $(document).on("click", ".updateFeedbackStatus2", function () {
            $('.overlaynew').show();
            var feedbackid = $(this).attr('feedback_id');
            var statusVal = $(this).attr('fb_status');
            $.ajax({
                url: "<?php echo base_url('/admin/feedback/updateFeedbackRatings'); ?>",
                type: "POST",
                data: {fid: feedbackid, status: statusVal, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    $('.overlaynew').hide();
                    if (response.status == "success") {
                        //alertMessageAndRedirect(response.message, window.location.href);
                        window.location.href = window.location.href;
                    }
                },
                error: function (response) {
                    $('.overlaynew').hide();
                    alertMessage(response.message);
                }
            });
        });
    });

</script>

