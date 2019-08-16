<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($oCampaign)) {
    //permissions
    $bAllowComments = ($oCampaign->allow_comments == 1) ? true : false;
    $bAllowVideoComments = ($oCampaign->allow_video_reviews == 1) ? true : false;
    $bAllowHelpful = ($oCampaign->allow_helpful_feedback == 1) ? true : false;
    $bAllowLiveReading = ($oCampaign->allow_live_reading_review == 1) ? true : false;
    $bAllowRatings = ($oCampaign->allow_comment_ratings == 1) ? true : false;
    $bAllowCreatedTime = ($oCampaign->allow_review_timestamp == 1) ? true : false;
    
    //get other settings
    $bgColor = $oCampaign->bg_color;
    $txtColor = $oCampaign->text_color;
}
?>
<section class="top_text price">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert-success" style="margin-bottom:10px;">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                </div>
                <div class="alert-danger" style="margin-bottom:10px;">
                    <?php echo $this->session->flashdata('error_msg'); ?>
                </div>
                <h2><strong class="text-center">Manage My Reviews</strong></h2>
                <br>
                <br>
                <table class="table blef0 brig0">
                    <tr>
                        <th style="text-align: center;">Brand</th>
                        <th style="text-align: center;">Review Type</th>
                        <th style="text-align: center;">Date</th>
                        <th style="width:40%;" style="text-align: left;">Review</th>
                        <th style="text-align: center;">Ratings</th>
                        <th style="text-align: center;">Action</th>
                                                
                    </tr>
                    <?php if(!empty($oMyReviews)): ?>
                    <?php foreach($oMyReviews as $oReview): ?>
                    <tr>
                        <td style="text-align: center;"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oReview->brand_img;?>" style="border:1px solid #ccc; padding:2px;" width="50" /></td>
                        <td style="text-align: center;"><?php echo ucfirst($oReview->reviewtype);?></td>
                        <td style="text-align: center;"><?php echo date("M d, Y", strtotime($oReview->review_created));?></td>
                        <td style="text-align: left;"><?php echo ($oReview->reviewtype == 'text') ? $oReview->comment_text : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$oReview->comment_video;?></td>
                        <td style="text-align: center;"><?php for($i=1; $i <= $oReview->ratings; $i++){ echo '<i class="fa fa-star"></i> '; } ?></td></td>
                        <td style="text-align: center;">
							<a class="editReview" reviewid="<?php echo $oReview->reviewid; ?>"><i class="fa fa-edit"></i></a> &nbsp; 
							<a class="deleteReview" reviewid="<?php echo $oReview->reviewid; ?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </table>

            </div>
            <div class="clearfix"></div>

        </div>


    </div>
</section>
<!-- =======================edit users popup========================= -->
<div id="editReview" class="modal modalpopup fade" role="dialog">
	<div class="modal-dialog">
		<form method="post" id="updateReview" action="javascript:void();">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Review</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					
					<div class="col-md-12">
						<div class="input_box" style="height:200px;">
							<label>Comment</label>
							<textarea style="height:150px; width:100%; padding:10px; margin-top:10px;" placeholder="Leave Review" name="edit_content" id="edit_content" required ></textarea>
						</div>
					</div>
					<div class="col-md-12">
						<div class="input_box" style="height:80px;">
							<label>Rating</label>
							<div class="step_star" style="padding: 5px 0;">
	
                            <ul id='stars'>

                                <li class='star' title='Poor' data-value='1'>

                                    <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                </li>

                                <li class='star' title='Fair' data-value='2'>

                                    <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                </li>

                                <li class='star' title='Good' data-value='3'>

                                    <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                </li>

                                <li class='star' title='Excellent' data-value='4'>

                                    <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                </li>

                                <li class='star' title='WOW!!!' data-value='5'>

                                    <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                </li>

                            </ul>

                        </div>

						<input type="hidden" value="0" id="ratingValue" name="ratingValue">
						</div>
					</div>
					<div class="col-md-12">
						<input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
						<input type="submit" class="btn blue" value="Update & Close" />
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function(){

	$(document).on('click' , '.deleteReview', function(){

		var conf = confirm("Are you sure? You want to delete this review!");
		if(conf == true){

			var reviewID = $(this).attr('reviewid');
			$.ajax({
				url: '<?php echo base_url('reviews/deleteReview');?>',
				type: "POST",
				data: { reviewid:reviewID },
				dataType: "json",
				success: function (data) {

					if(data.status == 'success'){

						alert('Your review has been delete successfully.');
						setTimeout(function () {
							window.location.href = window.location.href;
						}, 1000);
					
					}else{
					
					}
				}
			});
		}
		else{
			$('.overlaynew').hide();
		}
	});
	
	$(document).on('click', '.editReview', function(){
		var reviewID = $(this).attr('reviewid');
		$.ajax({
			url: '<?php echo base_url('reviews/getReviewById');?>',
			type: "POST",
			data: { reviewid:reviewID },
			dataType: "json",
			success: function (data) {

				if(data.status == 'success'){
					var reviewData = data.result[0];

					$('#edit_content').val(reviewData.comment_text);
					$('#edit_reviewid').val(reviewData.id);
					$('#stars li').each(function(index, value){
						$('#ratingValue').val(reviewData.ratings);
						if(reviewData.ratings > index){
							$(this).addClass('selected');
						}else{
							$(this).removeClass('selected');
						}
					});
					$("#editReview").modal();
				
				}else{
				
				}
			}
		});
	});
	
	$("#updateReview").submit(function () {
		var formData = new FormData($(this)[0]);
		$.ajax({
			url: '<?php echo base_url('reviews/update_review');?>',
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {

				console.log(data);
				if(data.status == 'success'){
					alert('Review has been update successfully.');
					setTimeout(function () {
						window.location.href = window.location.href;
					}, 1000);
				}else{
					alert('Error: Some thing wrong!');
					setTimeout(function () {
						window.location.href = window.location.href;
					}, 1000);
				}
			}
		});
	});
});
</script>

