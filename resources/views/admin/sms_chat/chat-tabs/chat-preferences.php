<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); ?>

<?php 
	$aUserInfo = getLoggedUser();
?>
<div class="tab-pane <?php echo $camp; ?>" id="right-icon-tab1">
    <form method="post" id="addOnsiteStepList" action="javascript:void();" >
		<input name="brandboostId" id="brandboostId" value="<?php echo $aBrandbosts->id; ?>" type="hidden">
		<div class="row">
			<div class="col-md-3">
				<div style="margin: 0;" class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Campaign Type</h6>
						<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
					<div class="panel-body p0">
						<div class="p25 bbot">
							<div class="form-group mb0">
								<label class="custmo_radiobox pull-left mb20">
									<input name="feedback_type" id="feedback_type" value="public" type="radio" <?php echo ($feedbackResponseData->feedback_type == '' || $feedbackResponseData->feedback_type == 'public') ? 'checked' : ''; ?>>
									<span class="custmo_radiomark"></span>
									Public
								</label>
								<label class="custmo_radiobox pull-left mb20 ml10">
									<input  name="feedback_type" id="feedback_type" value="private" type="radio" <?php echo $feedbackResponseData->feedback_type == 'private' ? 'checked' : ''; ?>>
									<span class="custmo_radiomark"></span>
									Private
								</label>
							</div>
						</div>
						
						<div class="configurations bbot p25">
							
							<div class="form-group">
								<label class="control-label">Review Request "Form" Name</label>
								<div class="">
									<input placeholder="Mr Anderson"  value="<?php echo ($feedbackResponseData->from_name) ? $feedbackResponseData->from_name : $aUserInfo->firstname .' '. $aUserInfo->lastname; ?>" name="from_name" id="from_name" class="form-control" required="" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label">Review Request "Form" Email</label>
								<div class="">
									<input placeholder="umair@nethues.com" value="<?php echo ($feedbackResponseData->from_email) ? $feedbackResponseData->from_email : $aUserInfo->email; ?>" name="from_email" id="from_email" class="form-control" required="" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">SMS Sender Name</label>
								<div class="">
									<input value="<?php echo ($feedbackResponseData->sms_sender) ? $feedbackResponseData->sms_sender : $aUserInfo->firstname .' '. $aUserInfo->lastname; ?>" name="sender_name" id="sender_name" placeholder="Mr Anderson" class="form-control" required="" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Review Request Language </label>
								<div class="">
									<select class="form-control">
										<option>English (USA)</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="p25 bbot">
							<div class="form-group mb0">
								<label class="custmo_radiobox pull-left mb20">
									<input name="ratings_type" id="ratings_type" value="happy" <?php echo ($feedbackResponseData->ratings_type == '' || $feedbackResponseData->ratings_type == 'happy') ? 'checked' : ''; ?> type="radio">
									<span class="custmo_radiomark"></span>
									Happy Ratings
								</label>
								<label class="custmo_radiobox pull-left mb20 ml10">
									<input name="ratings_type" id="ratings_type" value="star" <?php echo $feedbackResponseData->ratings_type == 'star' ? 'checked' : ''; ?> type="radio">
									<span class="custmo_radiomark"></span>
									Star Ratings
								</label>
							</div>
						</div>
						
						<div class="p25">
							<a class="mr10" href="#"><img src="<?php echo base_url(); ?>assets/images/yello_smile1.png"></a>
							<a class="mr10" href="#"><img src="<?php echo base_url(); ?>assets/images/yello_smile2.png"></a>
							<a class="mr10" href="#"><img src="<?php echo base_url(); ?>assets/images/yello_smile3.png"></a>
							<a class="mr10" href="#"><img src="<?php echo base_url(); ?>assets/images/yello_smile4.png"></a>
							<a class="mr10" href="#"><img src="<?php echo base_url(); ?>assets/images/yello_smile5.png"></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div style="margin: 0;" class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Thank you message</h6>
						<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
					<div class="panel-body p0">
						<div class="configurations p25">
							<div class="form-group">
								<label class="control-label">Review Request Language  </label>
								<div class="">
									<select class="form-control">
										<option>English (USA)</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="profile_headings big">Positive <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
						<div class="configurations p25">
							<div class="form-group">
								<label class="control-label">Positive Title</label>
								<div class="">
									<input class="form-control thankMsgTitle" name="positive_title" id="positive_title" value="<?php echo ($feedbackResponseData->pos_title) ? $feedbackResponseData->pos_title: 'Thanks for leaving positive review'; ?>" required="" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Positive Subtitle</label>
								<div class="">
									<input  class="form-control thankMsgSubTitle" name="positive_subtitle" id="positive_subtitle" value="<?php echo ($feedbackResponseData->pos_sub_title) ? $feedbackResponseData->pos_sub_title : 'We will revert back to you soon'; ?>" required="" type="text">
								</div>
							</div>
							<div class="alert bkg_green txt_white mt30 mb0 preview">
								<div class="media-left">
									<img src="<?php echo base_url(); ?>assets/images/thankyou_smiley_green.png"/>
								</div>
								<div class="media-left">
									<div class="thanksTitlePreview"><?php echo $feedbackResponseData->pos_title == '' ? 'Thanks for leaving positive review' : $feedbackResponseData->pos_title; ?></div>
									<div><small class="thanksSubTitlePreview"><?php echo $feedbackResponseData->pos_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->pos_sub_title; ?></small></div>
								</div>
							</div>
						</div>
						
						
						<div class="profile_headings big">Neutral <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
						<div class="configurations p25">
							<div class="form-group">
								<label class="control-label">Neutral Title</label>
								<div class="">
									<input class="form-control thankMsgTitle" name="neutral_title" id="neutral_title" value="<?php echo ($feedbackResponseData->neu_title) ? $feedbackResponseData->neu_title : 'Thanks for leaving your review'; ?>" required="" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Neutral Subtitle</label>
								<div class="">
									<input class="form-control thankMsgSubTitle" name="neutral_subtitle"  id="neutral_subtitle" value="<?php echo ($feedbackResponseData->neu_sub_title) ? $feedbackResponseData->neu_sub_title : 'We will revert back to you soon'; ?>" required="" type="text">
								</div>
							</div>
							<div class="alert bkg_grey txt_white mt30 mb0 preview">
								<div class="media-left">
									<img src="<?php echo base_url(); ?>assets/images/thankyou_smiley_grey.png"/>
								</div>
								<div class="media-left">
									<div class="thanksTitlePreview"><?php echo $feedbackResponseData->neu_title == '' ? 'Thanks for leaving positive review' : $feedbackResponseData->neu_title; ?></div>
									<div><small class="thanksSubTitlePreview"><?php echo $feedbackResponseData->neu_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->neu_sub_title; ?></small></div>
								</div>
							</div>
						</div>
						
						<div class="profile_headings big">Negative <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
						<div class="configurations p25">
							<div class="form-group">
								<label class="control-label">Negetive Title</label>
								<div class="">
									<input class="form-control thankMsgTitle" name="negetive_title" id="negetive_title" value="<?php echo ($feedbackResponseData->neg_title) ? $feedbackResponseData->neg_title : 'Thanks for leaving your review'; ?>" required="" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Negetive Subtitle</label>
								<div class="">
									<input class="form-control thankMsgSubTitle" name="negetive_subtitle"  id="negetive_subtitle" value="<?php echo ($feedbackResponseData->neg_sub_title) ? $feedbackResponseData->neg_sub_title : 'We will revert back to you soon'; ?>" required="" type="text">
								</div>
							</div>							
							
							<div class="alert bkg_red txt_white mt30 mb0 preview">
								<div class="media-left">
									<img src="<?php echo base_url(); ?>assets/images/thankyou_smiley_red.png"/>
								</div>
								<div class="media-left">
									<div class="thanksTitlePreview"><?php echo $feedbackResponseData->neg_title == '' ? 'Thanks for leaving positive review' : $feedbackResponseData->neg_title; ?></div>
									<div><small class="thanksSubTitlePreview"><?php echo $feedbackResponseData->neg_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->neg_sub_title; ?></small></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-3">
				<div style="margin: 0;" class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Review Link Expiration Settings</h6>
						<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
					<?php
					$linkExpireReview = $brandboostData->link_expire_review;
					$jsonCustomExpire = $brandboostData->link_expire_custom;
					//pre($jsonCustomExpire);
					$linkExpireCustom = json_decode($jsonCustomExpire); 
					$delayValue = $linkExpireCustom->delay_value;
					$delayUnit = $linkExpireCustom->delay_unit;
					
					if (empty($delayValue)) {
					$delayValue = 'never';
					}
					//pre($linkExpireCustom);
					
					if (empty($linkExpireReview)) {
					$linkExpireReview = 'no';
					}
					?>
					<div class="panel-body p0">
						<div class="p25 configurations  bbot">
							<div class="form-group mb0">
								<label class="control-label mb20">Automatically expire link after user leaves review?</label>
								<div class="clearfix"></div>
								<label class="custmo_radiobox pull-left mb20">
									<input name="review_expire" id="ratings_type" value="yes" <?php echo ( $linkExpireReview == 'yes') ? 'checked' : ''; ?> type="radio">
									<span class="custmo_radiomark"></span>
									Yes
								</label>
								<label class="custmo_radiobox pull-left mb20 ml10">
									<input name="review_expire" id="ratings_type" value="no" <?php echo $linkExpireReview == 'no' ? 'checked' : ''; ?> type="radio">
									<span class="custmo_radiomark"></span>
									No
								</label>
							</div>
						</div>
						
						<div class="p25 configurations ">
							<div class="form-group mb0">
								<label class="control-label mb20">Automatically expire link </label>
								<div class="clearfix"></div>
								<label class="custmo_radiobox pull-left mb20">
									<input name="review_expire_link" id="review_expire_link" value="never" <?php echo $delayValue == "never" ? "checked" : ""; ?> type="radio">
									<span class="custmo_radiomark"></span>
									Never Expire
								</label>
								<div class="clearfix"></div>
								<label class="custmo_radiobox pull-left mb20">
								<input name="review_expire_link" id="review_expire_link" value="custom" <?php echo $delayValue != "never" ? "checked" : ""; ?> type="radio">
									<span class="custmo_radiomark"></span>
									Expire After
								</label>
							</div>
							<div class="clearfix mb-10"></div>
							<div class="expireLinkBox" style="<?php echo $delayValue == "never" ? "display:none;" : "display:block;"; ?>">
								<div class="form-group">
									<input type="text" name="txtInteger" id="txtInteger" size="3" class="numaric_only form-control daysnumber2" value="<?php echo $delayValue > 0 ? $delayValue : '1'; ?>" />
								</div>
								<div class="form-group">
									<select class="form-control" name="exp_duration">
										<option value="day" <?php echo $delayUnit == 'day' ? 'selected="selected"' : ''; ?>>Day</option>
										<option value="week" <?php echo $delayUnit == 'week' ? 'selected="selected"' : ''; ?>>Week</option>
										<option value="month" <?php echo $delayUnit == 'month' ? 'selected="selected"' : ''; ?>>Month</option>
										<option value="year" <?php echo $delayUnit == 'year' ? 'selected="selected"' : ''; ?>>Year</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<div class="col-md-12 text-right">
				<?php if($canWrite == TRUE): ?>
				<button <?php if ($bActiveSubsription == false) { ?> class="btn dark_btn mt20 pDisplayNoActiveSubscription" title="No Active Subscription" type="button" <?php } else { ?> type="submit" class="btn dark_btn mt20" <?php } ?> > Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
				<?php endif; ?>	
			</div>
		</div>
	</form>
</div>

<script>
	$(document).on("keyup", ".thankMsgTitle", function () {
        $(this).closest('.configurations').find('.thanksTitlePreview').html($(this).val());
	});
	
	$(document).on("keyup", ".thankMsgSubTitle", function () {
        $(this).closest('.configurations').find('.thanksSubTitlePreview').html($(this).val());
	});
	
	$('[name=review_expire_link]').change(function(){
		if($(this).val() == 'custom'){
			$('.expireLinkBox').show();
		}else{
			$('.expireLinkBox').hide();
		}
	});
</script>