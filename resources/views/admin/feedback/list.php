<style>
    .ratingBox .fa{font-size: 20px; color: #f8e71c; margin: 0 2px;}
    .ratingBox .fastar{color: #ddd!important;}
    .panel-heading {border-bottom: 1px solid #f5f4f5 !important;}

    .media_review .img-cust{width: 64px!important; height: 64px!important}
    .media_review .media-heading{margin-bottom: 20px;}
    .media_review .media-heading a.text-semibold{ color: #231f20!important; font-size: 14px; font-weight: 400;}
    .media_review .media-heading a.text-semibold strong{  font-weight: 500;}
    .media_review .mediastar .fa{font-size: 17px; margin: 0 2px; color: #fc9951;}
    .media_review .label.bg-success {	padding: 1px 5px 2px 5px !important;	margin: 0 5px; color: #333; background: #fadeb8!important; border-color: #f3d1a2!important;}
    .media_review p{font-size: 14px!important; color: #231f20; margin-bottom: 20px; font-size: 14px; font-weight: 400; line-height: 24px;}
    .media_review a.readmore{ color: #6598c7; font-weight: 300; font-size: 14px; text-decoration:underline; margin-bottom: 15px; display: inline-block;}
    .media_review span.date{ float: right; font-weight: 300; font-size: 14px; color: #777274;}
    .media_review .media {	margin-top: 25px;	border-bottom: 1px solid #f5f4f5;	padding-bottom: 25px;}
    .media_review .media:first-child {	margin-top: 0!important;}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/summernote/summernote.min.js"></script>
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Feedback list<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements"> <span class="label bg-success heading-text"><?php echo sizeof($result);?> Feedback</span>
                        <ul class="icons-list">
                            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                    <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                    <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="media-list media_review stack-media-on-mobile">
                                <?php
                            if (count($result) > 0) {
                                foreach ($result as $data) {
                                    
                                    ?>
                                <li class="media">
                                    <div class="media-left"> <a href="#"><img src="<?php echo (!empty($data->avatar)) ? base_url().'/profile_images/'.$data->avatar : base_url().'/profile_images/avatar_image.png'; ?>" class="img-circle img-cust" alt=""></a> </div>
                                    <div class="media-body">
                                        <div class="media-heading"> <a href="#" class="text-semibold"><strong><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></strong> rated <a href="javascript:void(0);" class="editBrandboost" brandid="<?php echo $data->brandboost_id;?>" b_title="click to view campaign details"><?php echo ($data->brand_title) ? $data->brand_title : 'it' ; ?></a> &nbsp; &nbsp; <span class="mediastar">
                                                <?php if ($data->category == 'Positive'): ?>
                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <?php elseif ($data->category == 'Neutral'): ?>
                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                                                <?php elseif ($data->category == 'Negative'): ?>
                                                    <i class="fa fa-star"></i><i class="fa fa-star fastar"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                                                <?php endif; ?></span> <span>&nbsp; &nbsp; &nbsp; &nbsp;</span> <span><a class="displayFeedback" style="text-decoration: 'none;'" fb_tab_type="note" feedback_id="<?php echo $data->id; ?>" href="javascript:void(0);" fb_time="<?php echo date("M d, Y h:i A", strtotime($data->created)); ?> (<?php echo timeAgo($data->created);?>)"><span class="label bg-success heading-text">+ Add Notes</span></a> 
                                                    <span class="label bg-success heading-text" ><ul class="icons-list">  
                                                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="displayFeedback" fb_tab_type="feedback" feedback_id="<?php echo $data->id; ?>" fb_time="<?php echo date("M d, Y h:i A", strtotime($data->created)); ?> (<?php echo timeAgo($data->created);?>)" href="javascript:void(0);" ><i class="icon-file-stats "></i> View</a></li>
                                                        <li><a class="displayFeedback" fb_tab_type="note" feedback_id="<?php echo $data->id; ?>" href="javascript:void(0);" fb_time="<?php echo date("M d, Y h:i A", strtotime($data->created)); ?> (<?php echo timeAgo($data->created);?>)"><i class="icon-pencil7"></i> Add Note</a></li>

                                                    </ul>
                                                </li>
                                            </ul></span>
                                                </span> <span class="date"><?php echo date('F d, Y h:i A', strtotime($data->created)); ?></span> </div>
                                        <p><?php echo strlen($data->feedback)>200 ? substr($data->feedback, 0, 200). '...' : $data->feedback;?></p>
                                        <a class="readmore displayFeedback" fb_tab_type="feedback" feedback_id="<?php echo $data->id; ?>" fb_time="<?php echo date("M d, Y h:i A", strtotime($data->created)); ?> (<?php echo timeAgo($data->created);?>)" href="javascript:void(0);">Read more</a>
<!--                                        <ul class="list-inline list-inline-separate text-size-small">
                                            <li>57 Likes </li>
                                            <li>8 Comments</li>
                                            <li>1574 Views</li>
                                        </ul>-->
                                    </div>
                                </li>
                                <?php
                                }
                            }else {
                                echo '<li class="text-center">No any feedback found.</li>';
                            }
                            ?>	
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="col-md-12 text-right"> <a href="#" class="btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i> </a> </div>-->
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
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li class="text-semibold" style="border-bottom:1px solid #ddd; padding:5px 15px 10px;">Change Status</li>
                                        <li class="bg-danger updateFeedbackStatus" fb_status="Negative" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Negative</li>
                                        <li class="bg-blue updateFeedbackStatus" fb_status="Neutral" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Neutral</li>
                                        <li class="bg-success updateFeedbackStatus" fb_status="Positive" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Positive</li>
                                    </ul>
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




<script>
    $(document).ready(function () {

        $(document).on("click", ".editBrandboost", function () {

            var brandboostID = $(this).attr('brandID');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_offsite_step1'); ?>',
                type: "POST",
                data: {'brandboostID': brandboostID},
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
                data: {fid: feedbackid},
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

        $(document).on("click", ".updateFeedbackStatus", function () {
            $('.overlaynew').show();
            var feedbackid = $("input[name='fid']").val();
            var fbtime = $("input[name='fbtime']").val();
            var statusVal = $(this).attr('fb_status');
            $.ajax({
                url: "<?php echo base_url('/admin/feedback/updateFeedbackRatings'); ?>",
                type: "POST",
                data: {fid: feedbackid, status: statusVal},
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
                data: {fid: feedbackid, status: statusVal},
                dataType: "json",
                success: function (response) {
                    $('.overlaynew').hide();
                    if (response.status == "success") {
                        alertMessageAndRedirect(response.message, window.location.href);
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


