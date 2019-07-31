<?php list($canRead, $canWrite) = fetchPermissions('Feedbacks'); ?>
<?php $aTags = array('REVIEW_URL'); ?>
<h5 class="text-semibold no-margin-top row">
    <div class="col-md-6"><a href="javascript:void(0);"><?php echo $oFeedback->brand_title; ?></a></div>
    <div class="col-md-6"><span class="heading-text pull-right label <?php
        if ($oFeedback->category == 'Positive') {
            echo 'bg-success';
        } else if ($oFeedback->category == 'Neutral') {
            echo 'bg-blue';
        } else if ($oFeedback->category == 'Negative') {
            echo 'bg-danger';
        };
        ?>"><?php echo $oFeedback->category; ?></span></div>
</h5>

<div class="row">
    <div class="col-md-3">
        <div style="padding:15px 15px 5px; border:1px solid #dddddd; margin:20px 0;">
            <div><img src="<?php echo base_url(); ?>profile_images/avatar_image.png" style="width:100%"></div>
            <div style="color:#666; text-align:center; margin-top:10px;"><?php echo $oFeedback->firstname . ' ' . $oFeedback->lastname; ?></div>
        </div>
    </div>
    <div class="col-md-9" style="font-size:16px; line-height:35px; padding:15px;">
        <div>Name : <?php echo $oFeedback->firstname . ' ' . $oFeedback->lastname; ?></div>
        <div>Email Address : <?php echo $oFeedback->email; ?></div>
        <div>Phone Number : <?php echo $oFeedback->phone; ?> </div>
        <div>Date Of Feedback : <?php echo date("M d, Y (h:i A)", strtotime($oFeedback->created)); ?></div>
    </div>
</div>
<div class="row">
    <div class="tabbable col-md-12">
        <ul class="nav nav-tabs nav-tabs-bottom text-semibold">
            <li class="active"><a href="#feedback-tab" data-toggle="tab">Feedback</a></li>
            <li><a href="#note-tab" data-toggle="tab">Notes (<?php echo empty(sizeof($oNotes)) ? 0 : sizeof($oNotes); ?>)</a></li>

        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="feedback-tab">
                <?php echo $oFeedback->feedback; ?>
                <br>
                <?php if($canWrite): ?>
                <div class="col-lg-12"><button type="button" class="btn bg-blue-600 displayreplysection pull-right">Respond</button></div>
                <?php endif; ?>
                <br>
                <div class="replysection" style="display:none;">
                <form name="frmSendFeedbackReply" id="frmSendFeedbackReply" method="post">
                    <input type="hidden" name="fbtime" value="<?php echo date("M d, Y h:i A", strtotime($oFeedback->created)); ?> (<?php echo timeAgo($oFeedback->created);?>)" />
                    <input type="hidden" name="fid" value="<?php echo $oFeedback->id; ?>" />
                    <input type="hidden" name="bid" value="<?php echo $oFeedback->brandboost_id; ?>" />
                    <input type="hidden" name="cid" value="<?php echo $oFeedback->client_id; ?>" />
                    <input type="hidden" name="sid" value="<?php echo $oFeedback->subscriber_id; ?>" />
                    <input type="hidden" name="authorname" value="<?php echo $oFeedback->subscriber_id; ?>" />
                    <div class="form-group">
                        <textarea id="feedbackReply" class="form-control summernote" placeholder="Reply Feedback" name="feedbackReply" required></textarea>
                    </div>
                    <div class="text-right col-lg-12">
                        <?php if($canWrite): ?>
                        <button class="btn bg-blue-600" id="sendFeedbackEmail" title="Send SMS" career_medium="sms" type="button" > Send SMS <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                        <button class="btn bg-blue-600" id="sendFeedbackSMS" title="Send Email" career_medium="email"  type="button" > Send Email <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                        <button class="btn btn-warning previewFeedback" brandboost_id="<?php echo $oFeedback->brandboost_id; ?>" title="Preview" type="button" > Preview <i class="icon-grid-alt text-size-base position-right"></i></button>
                        <button class="btn btn-danger cancelFeedbackReply" title="Cancel" type="button" > Cancel <i class="icon-cross text-size-base position-right"></i></button>
                        <?php endif; ?>
                    </div>
                </form>
               </div>
                
            
        </div>

        <div class="tab-pane" id="note-tab">
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <tbody>

                        <?php if (!empty($oNotes)): ?>
                            <?php foreach ($oNotes AS $oNote): ?>
                                <tr>
                                    <td>
                                        <div class=""><a href="#" class="text-default text-semibold"><?php echo $oNote->notes; ?></a></div>
                                        <div class="text-muted text-size-small">
                                            <i><?php echo $oNote->firstname . ' ' . $oNote->lastname; ?> - <?php echo date("M d, Y h:i A", strtotime($oNote->created)); ?> (<?php echo timeAgo($oNote->created);?>)</i>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td><i>No Record(s) Found!</i></td>
                            </tr>

                        <?php endif; ?>


                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <form name="frmSaveNote" id="frmSaveNote" method="post">
                <input type="hidden" name="fbtime" value="<?php echo date("M d, Y h:i A", strtotime($oFeedback->created)); ?> (<?php echo timeAgo($oFeedback->created);?>)" />
                <input type="hidden" name="fid" value="<?php echo $oFeedback->id; ?>" />
                <input type="hidden" name="bid" value="<?php echo $oFeedback->brandboost_id; ?>" />
                <input type="hidden" name="cid" value="<?php echo $oFeedback->client_id; ?>" />
                <input type="hidden" name="sid" value="<?php echo $oFeedback->subscriber_id; ?>" />
                <input type="hidden" name="authorname" value="<?php echo $oFeedback->subscriber_id; ?>" />
                <div class="form-group">
                    <textarea id="add_feedback_popup" class="form-control" placeholder="Add Note" name="notes" required></textarea>
                </div>
                <div class="text-right">
                    <?php if($canWrite): ?>
                    <button class="btn bg-blue-600" id="saveFeedbackNote" title="Add Note" type="button" > Add Note <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    var customTag = '';
<?php foreach ($aTags as $value) { ?>
        customTag += '<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo '{' . $value . '}'; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo '{' . $value . '}'; ?></button>';
<?php }
?>
    var fileGroup = '<div class="note-btn-group btn-group note-view">' + customTag + '</div>';
    $(fileGroup).appendTo($('.note-toolbar'));

    $('.insert_tag_button').on('click', function () {
        var tagname = $(this).attr('data-tag-name');
        $("#feedbackReply").val(tagname);
    });

    $(document).on("click", ".displayreplysection", function () {
        $(this).hide();
        $(".replysection").show();
    });
    
    $(document).on("click", ".cancelFeedbackReply", function(){
        $(".replysection").hide();
        $(".displayreplysection").show();
    });
    
    $(document).on("click", ".previewFeedback", function(){
        var bbid = $(this).attr("brandboost_id");
        var pcontent = $("#feedbackReply").val();
		if(pcontent == ''){
			alertMessage('Please enter reply message to check preview.');
		}else{
			//$('.overlaynew').show();
			$.ajax({
                url: "<?php echo base_url('/admin/feedback/previewLiveContent'); ?>",
                type: "POST",
                data: {bbid: bbid, pcontent:pcontent},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        //$('.overlaynew').hide();
                        $("#previewFeedbackReplyContent").html(response.msg);
                        $("#previewFeedbackReply").modal("show");
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
		}
    });

</script>