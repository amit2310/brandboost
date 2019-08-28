<?php
$aTags = array('REVIEW_URL');
$brandboost_id="";
$oid = "";
$client_id = "";
$subscriber_id="";
$firstname = "";
$lastname="";
$email="";
$created="";
$review_title="";
$media_url="";
$mobile="";
if(!empty($oReview->brandboost_id)) 
{
    $brandboost_id  = $oReview->brandboost_id;
}
if(!empty($oReview->id)) 
{
    $oid  = $oReview->id;
}
if(!empty($oReview->client_id)) 
{
    $client_id  = $oReview->client_id;
}
if(!empty($oReview->subscriber_id)) 
{
    $subscriber_id  = $oReview->subscriber_id;
}
if(!empty($oReview->firstname)) 
{
    $firstname  = $oReview->firstname;
}
if(!empty($oReview->lastname)) 
{
    $lastname  = $oReview->lastname;
}
if(!empty($oReview->email)) 
{
    $email  = $oReview->email;
}
if(!empty($oReview->created)) 
{
    $created  = $oReview->created;
}
if(!empty($oReview->review_title)) 
{
    $review_title  = $oReview->review_title;
}
if(!empty($oReview->media_url)) 
{
    $media_url  = $oReview->media_url;
}
if(!empty($oReview->mobile)) 
{
    $mobile  = $oReview->mobile;
}





if (!empty($media_url)) {
    if (strpos($media_url, '.mp4') !== false) {
        $mediaType = 'video';
    } else {
        $mediaType = 'image';
    }
} else {
    $mediaType = '';
}
?>

<div class="row">
    <div class="col-md-3">
        <div style="padding:15px 15px 5px;  margin:20px 0;">
            <div><img src="<?php echo base_url(); ?>profile_images/avatar_image.png" style="width:100%"></div>
            <div style="color:#666; text-align:center; margin-top:10px;"><?php echo $firstname . ' ' . $lastname; ?></div>
        </div>
    </div>
    <div class="col-md-9 htext" style="font-size:16px; line-height:35px; padding:15px;">
        <div><strong>Name :</strong> <?php echo $firstname . ' ' . $lastname; ?></div>
        <div><strong>Email Address :</strong> <?php echo $email; ?></div>
        <div><strong>Phone Number :</strong> <?php echo $mobile; ?> </div>
        <div><strong>Date Of Review :</strong> <?php echo date("M d, Y (h:i A)", strtotime($created)); ?></div>
    </div>
</div>
<div class="row">
    <div class="tabbable col-md-12">
        <ul class="nav nav-tabs nav-tabs-bottom text-semibold">
            <li class="active"><a href="#review-tab" data-toggle="tab"><i class="icon-file-text position-left"></i> Review</a></li>
            <li><a href="#note-tab" data-toggle="tab"><i class="icon-price-tag2 position-left"></i> Notes (<?php echo empty(sizeof($oNotes)) ? 0 : sizeof($oNotes); ?>)</a></li>

        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="review-tab">
                <div class="w100 <?php if ($oReview->review_type == 'video'): ?>text-center<?php endif; ?>">
                    <?php echo (!empty($oReview->comment_text) ? $oReview->comment_text : ($review_title)); ?>
                    <?php if (!empty($aReview->media_url)) { ?>
                        <?php if ($mediaType == 'video'): ?>
                            <video controls class="bb_media_container">
                                <source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oReview->media_url; ?>" type="video/mp4">
                            </video>
                        <?php endif; ?>
                        <?php if ($mediaType == 'image'): ?>
                            <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oReview->media_url; ?>" class="bb_media_container" />
                        <?php endif; ?>

                    <?php } ?> 
                </div>

                <br>
                <div class="col-lg-12"><button type="button" class="btn bg-blue-600 displayreplysection pull-right">Respond</button><button type="button" class="btn bg-green-600 pull-right btnapplytag applyInsightTags" action_name="review-tag" reviewid="<?php echo $oReview->id; ?>" style="margin: 0 10px;">Add Insight Tags</button></div>
                <br>
                <div class="replysection" style="display:none;">
                    <form name="frmSendFeedbackReply" id="frmSendFeedbackReply" method="post">
                        <input type="hidden" name="fbtime" value="<?php echo date("M d, Y h:i A", strtotime($oReview->created)); ?> (<?php echo timeAgo($oReview->created); ?>)" />
                        <input type="hidden" name="fid" value="<?php echo $oid; ?>" />
                        <input type="hidden" name="bid" value="<?php echo $brandboost_id; ?>" />
                        <input type="hidden" name="cid" value="<?php echo $client_id; ?>" />
                        <input type="hidden" name="sid" value="<?php echo $subscriber_id; ?>" />
                        <input type="hidden" name="authorname" value="<?php echo $subscriber_id; ?>" />
                        <div class="form-group">
                            <textarea id="previewReviewReply" class="form-control" placeholder="Reply Feedback" name="previewReply" required></textarea>
                        </div>
                        <div class="text-right col-lg-12">
                            <button class="btn bg-blue-600" id="sendFeedbackEmail" title="Send SMS" career_medium="sms" type="button" > Send SMS <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                            <button class="btn bg-blue-600" id="sendFeedbackSMS" title="Send Email" career_medium="email"  type="button" > Send Email <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                            <button class="btn btn-warning previewReview" brandboost_id="<?php echo $oReview->campaign_id; ?>" title="Preview" type="button" > Preview <i class="icon-grid-alt text-size-base position-right"></i></button>
                            <button class="btn bg-green-600 btnApplyTag applyInsightTags" action_name="review-tag" reviewid="<?php echo $oReview->id; ?>" type="button">+Tags <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                            <button class="btn btn-danger cancelReviewReply" title="Cancel" type="button" > Cancel <i class="icon-cross text-size-base position-right"></i></button>
                        </div>
                    </form>
                </div>


            </div>

            <div class="tab-pane" id="note-tab">
                <div style="margin: 20px 0!important;" class="table-responsive">
                    <table class="table text-nowrap">
                        <tbody>

                            <?php if (!empty($oNotes)): ?>
                                <?php foreach ($oNotes AS $oNote): ?>
                                    <tr>
                                        <td>
                                            <div class=""><a href="#" class="text-default text-semibold"><?php echo $oNote->notes; ?></a></div>
                                            <div class="text-muted text-size-small">
                                                <i><?php echo $oNote->firstname . ' ' . $oNote->lastname; ?> - <?php echo date("M d, Y h:i A", strtotime($oNote->created)); ?> (<?php echo timeAgo($oNote->created); ?>)</i>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td style="border: none!important; text-align: center;">No Record(s) Found!</td>
                                </tr>

                            <?php endif; ?>


                        </tbody>
                    </table>
                </div>
               
                <form name="frmSaveNote" id="frmSaveNote" method="post">
                    @csrf
                    <input type="hidden" name="reviewtime" value="<?php echo date("M d, Y h:i A", strtotime($oReview->created)); ?> (<?php echo timeAgo($oReview->created); ?>)" />
                    <input type="hidden" name="reviewid" value="<?php echo $oReview->id; ?>" />
                    <input type="hidden" name="bid" value="<?php echo $oReview->campaign_id; ?>" />
                    <input type="hidden" name="cid" value="<?php echo $oReview->user_id; ?>" />
                    <div class="form-group">
                        <textarea id="add_feedback_popup" class="form-control" placeholder="Add Note" name="notes" required></textarea>
                    </div>
                    <div class="text-right">
                        <button class="btn bg-blue-600" id="saveReviewNotes" title="Add Note" type="button" > Add Note <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    /*$('.summernote').summernote({
        height: 200
    });*/

    var customTag = '';
<?php foreach ($aTags as $value) { ?>
        customTag += '<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo '{' . $value . '}'; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo '{' . $value . '}'; ?></button>';
<?php }
?>
    var fileGroup = '<div class="note-btn-group btn-group note-view">' + customTag + '</div>';
    $(fileGroup).appendTo($('.note-toolbar'));

    $('.insert_tag_button').on('click', function () {
        var tagname = $(this).attr('data-tag-name');
        //$("#feedbackReply").summernote('editor.pasteHTML', tagname);
    });

    $(document).on("click", ".displayreplysection", function () {
        $(this).hide();
        $(".btnapplytag").hide();
        $(".replysection").show();
    });

    $(document).on("click", ".cancelReviewReply", function () {
        $(".replysection").hide();
        $(".displayreplysection").show();
        $(".btnapplytag").show();
    });

    $(document).on("click", ".previewReview", function () {
        var bbid = $(this).attr("brandboost_id");
        var pcontent = $("#previewReviewReply").val();
        if (pcontent == '') {
            alertMessage('Please enter reply message to check preview.');
        } else {
            //$('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/reviews/previewLiveContentReview'); ?>",
                type: "POST",
                data: {bbid: bbid, pcontent: pcontent},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        //$('.overlaynew').hide();
                        $("#previewReviewReplyContent").html(response.msg);
                        $("#previewReviewReply").modal("show");
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        }
    });

</script>