<table class="table datatable-basic-new" id="onsiteReview">
    <thead>
        <tr>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
            <th><i class="icon-user"></i>Name</th>
            <th><i class="icon-star-full2"></i>Review Rating</th>
            <th><i class="icon-paragraph-left3"></i>Site / Product / Service Details</th>
            <th><i class="icon-paragraph-left3"></i>Review</th>
            <th><i class="icon-calendar"></i>Created</th>
            <th><i class="icon-hash"></i>Tags</th>
            <th><i class="icon-folder2"></i>Category</th>
            <th class="text-center"><i class="icon-diff-modified"></i>Status</th>
			<th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
            <th style="display: none;"></th>
		</tr>
	</thead>
    <tbody>
		
        <?php
			if (!empty($aReviews)) {
				$inc = 1;
				foreach ($aReviews as $oReview) {
					
					$getComm = getCampaignCommentCount($oReview->id);
					//$reviewTags = getTagsByReviewID($oReview->id);
					$reviewTags = array();
					//$reviewLikeCount = \App\Models\ReviewsModel::countHelpful($oReview->id);
					$productData = \App\Models\Admin\BrandboostModel::getProductDataById($oReview->product_id);
					if(empty($productData)){
						$productData = new stdClass();
						$productData->product_name = '';                                            
						$productData->product_image = '';                                            
					}
											   
					if (!empty($oReview->avatar)) {
						$avatarImage = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oReview->avatar;
						} else {
						$avatarImage = base_url('profile_images/avatar_image.png');
					}
					
					$smilyImage = ratingView($oReview->ratings);
					
					$reviewCommentsData = \App\Models\ReviewsModel::getReviewAllComments($oReview->id, 0, 100);
					
					$approved = 0;
					$pending = 0;
					$disApproved = 0;
					if (!empty($reviewCommentsData)) {
						
						foreach ($reviewCommentsData as $comm) {
							
							if ($comm->status == 1) {
								$approved = $approved + 1;
								} else if ($comm->status == 2) {
								$pending = $pending + 1;
								} else {
								$disApproved = $disApproved + 1;
							}
						}
					}
					
					if($oReview->avatar == ''){
						$profileImage = '<a class="icons fl_letters s32" href="">'.ucfirst(substr($oReview->firstname, 0 ,1)).''.ucfirst(substr($oReview->lastname, 0, 1)).'</a>';
						}else{
						$profileImage = '<a class="icons s32" href="'.base_url().'admin/contacts/profile/'.$oReview->subscriberId.'" ><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$oReview->avatar.'" onerror="this.src=\'/assets/images/userp.png\'" class="img-circle img-xs" alt=""></a>';
					}
					
				?>
                <!--=======================-->
                <tr id="append-<?php echo $oReview->id; ?>" class="selectedClass">
                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($oReview->created)); ?></td>
                    <td style="display: none;"><?php echo $oReview->id; ?></td>
                    <td style="width: 40px!important; display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $oReview->id; ?>" value="<?php echo $oReview->id; ?>" ><span class="custmo_checkmark"></span></label></td>
					
                    <td class="viewContactSmartPopupReview" data-modulesubscriberid="<?php echo $oReview->subscriberId; ?>" data-modulename="review">
						<div class="media-left media-middle"> <?php echo $profileImage; ?> </div>
                        <div class="media-left">
                            <div class="pt-5">
                                <a href="javascript:void(0);" class="text-default text-semibold bbot"><span><?php echo $oReview->firstname; ?> <?php echo $oReview->lastname; ?></span></a>
                                <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($oReview->country); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/>
							</div>
                            <div class="text-muted text-size-small"><?php echo $oReview->email; ?></div><?php //pre($oReview); ?>
						</div>
					</td>
					
                    <td class="viewSmartPopup" reviewid="<?php echo $oReview->id; ?>"><?php echo $smilyImage; ?></td>
					
					<td class="viewSmartPopup" reviewid="<?php echo $oReview->id; ?>">
						<?php if($productData->product_name != ''){ ?>
							<div class="media-left media-middle"> <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $productData->product_image; ?>" onerror="this.src='/assets/images/userp.png'" class="img-circle img-xs" alt=""> </div>
							<div class="media-left">
								<div class="pt-5">
									<a href="javascript:void(0);" class="text-default text-semibold bbot"><span><?php echo $productData->product_name; ?></span></a>
									
								</div>
								<div class="text-muted text-size-small"><?php echo setStringLimit($productData->product_description, 32); ?></div>
							</div>
							<?php }else{ ?>
							<div class="media-left media-middle"> <span class="icons fl_letters_gray s32">NA</span> </div><div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>
						<?php } ?>
					</td>
					
                    <td><a href="<?php echo base_url('admin/brandboost/reviewdetails/' . $oReview->id); ?>" class="txt_dblack"><div class="text-semibold"><?php echo setStringLimit($oReview->review_title, '23'); ?></div>
						<div class="text-size-small text-muted"><?php echo setStringLimit($oReview->comment_text, '31'); ?>
						<div class="txt_dblack"><?php echo ucfirst($oReview->review_type); ?> Review</div></div></a></td>
						<td><div class="media-left">
                            <div class=""><a href="javascript:void();" class="text-default text-semibold"><?php echo dataFormat($oReview->created); ?></a> </div>
                            <div class="text-muted text-size-small"><?php echo dataFormatHours($oReview->created); ?></div>
						</div></td>
						
						
						<td id="review_tag_<?php echo $oReview->id; ?>">
							<div class="tdropdown">
							  <button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle" data-toggle="dropdown"> <?php echo count($reviewTags); ?> Tags <span class="caret"></span> </button>
							  <ul class="dropdown-menu dropdown-menu-right tagss">
								<?php if (count($reviewTags) > 0) { 
											foreach ($reviewTags as $oTag) {    
											?>
									<button class="btn btn-xs btn_white_table pr10"> <?php echo $oTag->tag_name; ?> </button>                                                            
									<?php 
									}
								} ?>
								<button class="btn btn-xs plus_icon ml10 applyInsightTagsReviews" reviewid="<?php echo base64_url_encode($oReview->id); ?>" action_name="review-tag"><i class="icon-plus3"></i></button>
							  </ul>
							  <button class="btn btn-xs plus_icon ml10 applyInsightTagsReviews" reviewid="<?php echo base64_url_encode($oReview->id); ?>" action_name="review-tag"><i class="icon-plus3"></i></button>
							</div>
						</td>
						
						<td>
							<div class="tdropdown">
								<?php
									if ($oReview->ratings >= 4) {
										?><i class="icon-primitive-dot txt_green fsize16"></i> <?php
										} else if ($oReview->ratings == 3) {
										?><i class="icon-primitive-dot txt_grey fsize16"></i> <?php
										} else {
										?><i class="icon-primitive-dot txt_red fsize16"></i> <?php
									}?>
									
									<a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
										<?php
											if ($oReview->ratings >= 4) {
												echo 'Positive';
												} else if ($oReview->ratings == 3) {
												echo 'Neutral';
												} else {
												echo 'Negative';
											}
										?>
									</a>
									
									<ul class="dropdown-menu dropdown-menu-right status">
										<?php if ($oReview->ratings >= 4) { ?>
											<li><a href="javascript:void(0);" review_id='<?php echo $oReview->id; ?>' change_category = '3' class="update_category"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
											<li><a href="javascript:void(0);" review_id='<?php echo $oReview->id; ?>' change_category = '1' class="update_category"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
											<?php } else if ($oReview->ratings == 3) { ?>
											<li><a href="javascript:void(0);" review_id='<?php echo $oReview->id; ?>' change_category = '5' class="update_category"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
											<li><a href="javascript:void(0);" review_id='<?php echo $oReview->id; ?>' change_category = '1' class="update_category"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
											<?php
												} else {
											?>
											<li><a href="javascript:void(0);" review_id='<?php echo $oReview->id; ?>' change_category = '5' class="update_category"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
											<li><a href="javascript:void(0);" review_id='<?php echo $oReview->id; ?>' change_category = '3' class="update_category"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
											<?php
											}
										?>
									</ul>
							</div>
						</td>
						<td>
							<div class="tdropdown">
								<?php
									if ($oReview->status == 0) {
										echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
										} else if ($oReview->status == 2) {
										echo '<i class="icon-primitive-dot txt_grey fsize16"></i> ';
										} else {
										echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
									}
								?>
								<a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
									<?php
										if ($oReview->status == 0) {
											echo 'Inactive';
											} else if ($oReview->status == 2) {
											echo 'Pending';
											} else {
											echo 'Active';
										}
									?>
									
								</a>
								<ul class="dropdown-menu dropdown-menu-right status">
									<?php
										
										if ($oReview->status == 1) {
											echo "<li><a review_id='" . $oReview->id . "' change_status = '0' class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
											} else if ($oReview->status == 2) {
											echo "<li><a review_id='" . $oReview->id . "' change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
											echo "<li><a review_id='" . $oReview->id . "' change_status = '0' class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
											} else {
											echo "<li><a review_id='" . $oReview->id . "' change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
										}
										
									?>
								</ul>
							</div>
						</td>
						<td class="text-center">
							<div class="tdropdown ml10"> 
								<a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
								<ul class="dropdown-menu dropdown-menu-right more_act">
									<?php //if($access != 'limited'):?>
									<?php
										if ($oReview->status == 1) {
											echo "<li><a review_id='" . $oReview->id . "' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>";
											} else if ($oReview->status == 2) {
											echo "<li><a review_id='" . $oReview->id . "' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
											echo "<li><a review_id='" . $oReview->id . "' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>";
											} else {
											echo "<li><a review_id='" . $oReview->id . "' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
										}
										//echo '<li><a href="javascript:void(0);" class="applyInsightTagsReviews" reviewid="'.base64_url_encode($oReview->id).'" action_name="review-tag"><i class="icon-file-locked"></i> Apply Tags</a></li>';
										echo '<li><a href="javascript:void(0);" class="displayReview" action_name="review-tag" tab_type="note" reviewid="' . $oReview->id . '" review_time="' . date("M d, Y h:i A", strtotime($oReview->created)) . '(' . timeAgo($oReview->created) . ')" ><i class="icon-file-locked"></i> Add Notes</a></li>';
										//}
										// echo '<li><a href="javascript:void(0);" class="showReviewPopup" tab_type="info" reviewid="' . $oReview->id . '" ><i class="icon-file-locked"></i> View Review Popup</a></li>';
										
										echo '<li><a target="_blank" href="' . base_url('admin/brandboost/reviewdetails/' . $oReview->id) . '"><i class="icon-file-locked"></i> View Review</a></li>';
										//if ($canWrite) {
										if ($oReview->review_type == 'text') {
											
											echo '<li><a href="javascript:void(0);" class="editReview" reviewid="' . $oReview->id . '"><i class="icon-gear"></i> Edit</a></li>';
											} else {
											echo '<li><a href="javascript:void(0);" class="editVideoReview" reviewid="' . $oReview->id . '"><i class="icon-pencil"></i> Edit</a></li>';
										}
										echo '<li><a href="javascript:void(0);" class="deleteReview" reviewid="' . $oReview->id . '" ><i class="icon-trash"></i> Delete</a></li>';
										//}
									?>
									<?php // endif; ?>
								</ul>
							</div></td>
							<td style="display: none;">
								<?php
									if ($oReview->status == 0) {
										echo 'Declined';
										} else if ($oReview->status == 2) {
										echo 'Pending';
										} else {
										echo 'Approved';
									}
								?>
							</td>
				</tr>
                <?php
					$inc++;
				}
			}
		?>
		
		
	</tbody>
</table>


<div id="ReviewTagListModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
				</div>
                <div class="modal-body" id="tagEntireListReview"></div>
				
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="review_id" id="tag_review_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Apply Tag</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div id="editReview" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateReview" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
				</div>
                <div class="modal-body">
					
                    <div class="form-group">
                        <label class="control-label col-lg-3">Title</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="edit_review_title" id="edit_review_title" placeholder="Title" required>
						</div>
					</div>
					
                    <div class="form-group">
                        <label class="control-label col-lg-3">Comment</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" placeholder="Leave Review" name="edit_content" id="edit_content" required ></textarea>
						</div>
					</div>
					
                    <div class="form-group">
                        <label class="control-label col-lg-3">Rating</label>
                        <div class="col-lg-9">
                            <div class="step_star_new" style="padding: 5px 0;">
								
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
						</div>
					</div>
					
				</div>
                <div class="modal-footer">
                    <input type="hidden" value="0" id="ratingValue" name="ratingValue">
                    <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
				</div>
			</form>
		</div>
	</div>
</div> 

<!-- =======================edit video popup========================= -->

<div id="editVideoReview" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateVideoReview" action="javascript:void();">
            	{{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
				</div>
                <div class="modal-body">
					
                    <div class="form-group">
                        <label class="control-label col-lg-3">Title</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="edit_review_title" id="edit_video_review_title" placeholder="Title" required>
						</div>
					</div>
					
                    <!-- <div class="form-group">
                        <label class="control-label col-lg-3">Video</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="file" name="video"  />
						</div>
					</div> -->
					
					
                    <div class="form-group">
                        <label class="control-label col-lg-3">Rating</label>
                        <div class="col-lg-9">
                            <div class="step_star_new" style="padding: 5px 0;">
                                <ul id='stars_video'>
									
								</ul>
								
							</div>
						</div>
					</div>
					
				</div>
                <div class="modal-footer">
                    <input type="hidden" value="0" id="ratingValueVideo" name="ratingValueVideo">
                    <input type="hidden" name="edit_video_reviewid" id="edit_video_reviewid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
				</div>
			</form>
		</div>
	</div>
</div> 

<script type="text/javascript">
    
    // top navigation fixed on scroll and side bar collasped
	
    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
			} else {
            $("#header-sroll").removeClass("small-header");
		}
	});
	
    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
			} else {
            $('body').removeClass('sidebar-xs');
		}
	}
	
    $(document).ready(function () {
        smallMenu();
		
        window.onresize = function () {
            smallMenu();
		};
	});
	
	
	
	
    function showCommentsPopup(reviewID) {
        $.ajax({
            url: '<?php echo base_url('admin/reviews/getCommentsPopup'); ?>',
            type: "POST",
            data: {review_id: reviewID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    var dataString = data.popupData;
                    $("#commentpopup").html(dataString);
                    $("#commentpopup").modal("show");
				}
			}
		});
	}
	
    function getReviewPopupData(reviewId, tabtype) {
        $('.overlaynew').show();
        $.ajax({
            url: "<?php echo base_url('/admin/reviews/getReviewPopupData'); ?>",
            type: "POST",
            data: {rid: reviewId},
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    $('.overlaynew').hide();
                    $("#newreviewpopup").modal("show");
                    $("#reviewPopupBox").html(response.popupData);
                    if (tabtype == 'note') {
                        $('.tabbable a[href="#note-tab"]').trigger('click');
						} else {
                        $('.tabbable a[href="#review-tab"]').trigger('click');
					}
				}
			},
            error: function (response) {
                alertMessage(response.message);
			}
		});
	}
	
    function displayReviewPopup(reviewid, tabtype, reviewTime) {
        $('.overlaynew').show();
        $.ajax({
            url: "<?php echo base_url('/admin/reviews/displayreview'); ?>",
            type: "POST",
            data: {rid: reviewid},
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    $('.overlaynew').hide();
                    $("#reviewContent").html(response.popup_data);
                    $(".reviewTime").html(reviewTime);
                    $("#reviewPopup").modal("show");
                    if (tabtype == 'note') {
                        $('.tabbable a[href="#note-tab"]').trigger('click');
						} else {
                        $('.tabbable a[href="#review-tab"]').trigger('click');
					}
				}
			},
            error: function (response) {
                alertMessage(response.message);
			}
		});
	}
	
	
	
    $(document).ready(function () {
		
		
        $('#checkAll').change(function () {
			
            if (false == $(this).prop("checked")) {
				
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
				} else {
				
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
			}
			
		});
		
        $(document).on('click', '.checkRows', function () {
            var inc = 0;
			
			
            var rowId = $(this).val();
			
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
				} else {
                $('#append-' + rowId).addClass('success');
			}
			
            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
			});
            if (inc == 0) {
				
                $('.custom_action_box').hide();
				} else {
                $('.custom_action_box').show();
			}
			
            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
			}
			
		});
		
		$(document).on('click', '.update_category', function () {
            $('.overlaynew').show();
            var dataCategory = $(this).attr('change_category');
            var review_id = $(this).attr('review_id');
            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_review_category'); ?>',
                type: "POST",
                data: {dataCategory: dataCategory, review_id: review_id},
                dataType: "json",
                success: function (data) {
					
                    if (data.status == 'success') {
						
                        window.location.href = '';
						
						} else {
						
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
					}
				}
			});
		});
		
        $(document).on('click', '#deleteButtonReviewList', function () {
			
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
			});
            if (val.length === 0) {
                alert('Please select a row.')
				} else {
				
                deleteConfirmationPopup(
                "This review will deleted immediately.<br>You can't undo this action.", 
                function() {
                    $('.overlaynew').show();
                    $.ajax({
                        url: '<?php echo base_url('admin/reviews/deleteMultipalReview'); ?>',
                        type: "POST",
                        data: {multiReviewid: val},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                window.location.href = '';
								} else {
                                alertMessage('Error: Some thing wrong!');
                                $('.overlaynew').hide();
							}
						}
					});
				});
				
			}
			
		});
		
		
        $("#frmReviewTagListModal").submit(function () {
            var formdata = $("#frmReviewTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyReviewTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
						$('.overlaynew').hide();
                        $("#review_tag_" + data.id).html(data.refreshTags);
                        $("#ReviewTagListModal").modal("hide");
                        //window.location.href = '';
					}else{
						$('.overlaynew').hide();
					}
				}
			});
            return false;
		});
		
        $(document).on("click", ".displayReview", function () {
            var elem = $(this);
            var reviewid = $(this).attr("reviewid");
            var tabtype = $(this).attr('tab_type');
            var reviewTime = $(this).attr('review_time');
            displayReviewPopup(reviewid, tabtype, reviewTime);
			
		});
		
        $(document).on("click", ".showReviewPopup", function () {
            var reviewid = $(this).attr("reviewid");
            getReviewPopupData(reviewid, '');
		});
		
        
		
        $(document).on("click", "#saveReviewNotes", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/reviews/saveReviewNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        var reviewid = $("input[name='reviewid']").val();
                        var tabtype = 'note';
                        var reviewtime = $("input[name='reviewtime']").val();
                        displayReviewPopup(reviewid, tabtype, reviewtime);
					}
				},
                error: function (response) {
                    alertMessage(response.message);
				}
			});
		});
		
        $(document).on("click", "#saveReviewNotesPopup", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/reviews/saveReviewNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        var reviewid = $("input[name='reviewid']").val();
                        var tabtype = 'note';
                        getReviewPopupData(reviewid, tabtype);
					}
				},
                error: function (response) {
                    alertMessage(response.message);
				}
			});
		});
		
	});
	
    $(document).ready(function () {
		
        $(document).on('click', '.showVideo', function () {
			
            var videoUrl = $(this).attr('videoUrl');
            $("#showVideoPopup").modal();
            $('#divVideo video source').attr('src', videoUrl);
            $("#divVideo video")[0].load();
            $('#downloadVideo').attr('href', videoUrl);
		});
		
        $(document).on('click', '.deleteReview', function () {
			
            var reviewID = $(this).attr('reviewid');
			
            deleteConfirmationPopup(
            "This review will deleted immediately.<br>You can't undo this action.", 
            function() {
				
                $('.overlaynew').show();
                $.ajax({
                    url: "<?php echo base_url('admin/reviews/deleteReview'); ?>",
                    type: "POST",
                    data: {reviewid: reviewID},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            location.reload();
							} else {
                            alert("Having some error.");
						}
					},
                    error: function (error) {
                        console.log(error);
					}
				});
			});
            
		});
		
        $(document).on('click', '.editReview', function () {
            var reviewID = $(this).attr('reviewid');
            $.ajax({
                url: '<?php echo base_url('admin/reviews/getReviewById'); ?>',
                type: "POST",
                data: {reviewid: reviewID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
					
                    if (data.status == 'success') {
                        var reviewData = data.result[0];
						
                        $('#edit_content').val(reviewData.comment_text);
                        $('#edit_review_title').val(reviewData.review_title);
                        $('#edit_reviewid').val(reviewData.id);
                        $('#stars li').each(function (index, value) {
                            $('#ratingValue').val(reviewData.ratings);
                            if (reviewData.ratings > index) {
                                $(this).addClass('selected');
								} else {
                                $(this).removeClass('selected');
							}
						});
                        $("#editReview").modal();
						
						} else {
						
					}
				}
			});
		});
		
        $(document).on('click', '.editVideoReview', function () {
            var reviewID = $(this).attr('reviewid');
            $.ajax({
                url: '<?php echo base_url('admin/reviews/getReviewById'); ?>',
                type: "POST",
                data: {reviewid: reviewID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
					
                    if (data.status == 'success') {
                        var reviewData = data.result[0];
                        $('#edit_video_content').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + reviewData.comment_video);
                        $('#edit_video_reviewid').val(reviewData.id);
                        $('#edit_video_review_title').val(reviewData.review_title);
                        var start = '';
                        var startName = ['', 'Poor', 'Fair', 'Good', 'Excellent', 'WOW!!!'];
                        for (var inc = 1; inc <= 5; inc++) {
                            if (inc < reviewData.ratings || inc == reviewData.ratings) {
								
                                start += "<li class='star txt_yellow' style='display:inline;' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star fa-fw' style='margin: 0;'></i></li>";
								} else {
                                start += "<li class='star txt_grey' style='display:inline;' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star-o fa-fw' style='margin: 0;'></i></li>";
							}
						}
                        $('#stars_video').html(start);
                        $('#ratingValueVideo').val(reviewData.ratings);
                        $('#stars_video li').each(function (index, value) {
							
                            if (reviewData.ratings > index) {
                                $(this).addClass('selected');
								} else {
                                $(this).removeClass('selected');
							}
						});
                        $("#editVideoReview").modal();
						
						} else {
						
					}
				}
			});
		});
		
        $("#updateReview").submit(function () {
			
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_review'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
					
                    if (data.status == 'success') {
                        window.location.href = '';
						} else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
					}
				}
			});
		});
		
		
        $("#updateVideoReview").submit(function () {
			
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_video_review'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
					
                    if (data.status == 'success') {
						
                        window.location.href = '';
						} else {
						
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
					}
				}
			});
		});
		
		
        $(document).on('click', '.chg_status', function () {
			
            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var review_id = $(this).attr('review_id');
            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_review_status'); ?>',
                type: "POST",
                data: {status: status, review_id: review_id},
                dataType: "json",
                success: function (data) {
					
                    if (data.status == 'success') {
						
                        window.location.href = '';
						
						} else {
						
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
					}
				}
			});
		});
		
        var ratingValueVideo = 0;
		
        $(document).on('click', '#stars_video li', function () {
            var onStar = parseInt($(this).data('value'), 10);
            var stars = $(this).parent().children('li.star');
			
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
                $(stars[i]).children('i').removeClass('fa-star');
                $(stars[i]).children('i').addClass('fa-star-o');
			}
			
            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
                $(stars[i]).children('i').removeClass('fa-star-o');
                $(stars[i]).children('i').addClass('fa-star');
			}
			
            ratingValueVideo = parseInt($('#stars_video li.selected').last().data('value'), 10);
            $('#ratingValueVideo').val(ratingValueVideo);
			
		});
		
        $(document).on("click", ".applyInsightTagsReviews", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/tags/listAllTags'); ?>',
                type: "POST",
                data: {review_id: review_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
							} else {
                            $('.modalFooterBtn').show();
						}
						
						$("#tagEntireListReview").html(dataString);
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
		
        $(document).on('click', '.editDataReview', function () {
            $('.editAction').toggle();
		});
		
		
	});
	
	
</script>


<script>
	
	
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#onsiteReview thead tr').clone(true).appendTo('#onsiteReview thead');
		
        $('#onsiteReview thead tr:eq(1) th').each(function (i) {
			
            if (i === 10) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterBy" placeholder="Search ' + title + '" />');
				
                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
						.column(i)
						.search(this.value)
						.draw();
					}
				});
			}
            if (i === 4) {
                var title = $(this).text();
                $(this).html('<input type="text" id="startRate" placeholder="Search ' + title + '" />');
				
                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
						.column(i)
						.search(this.value)
						.draw();
					}
				});
			}
			
			
		});
		
        $(document).on('click', '.filterByColumn', function () {
			
            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
			});
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterBy').val(fil);
            $('#filterBy').keyup();
			
            if (fil.length == 0) {
                $('.heading_links').each(function (i) {
                    $(this).children('a').removeClass('btn btn-xs btn_white_table');
				});
                $('#startRate').val('');
                $('#startRate').keyup();
                $('.heading_links a:eq(0)').addClass('btn btn-xs btn_white_table');
                tableBase.draw();
			}
		});
		
        $(document).on('click', '.top_links_clk', function () {
			
            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs btn_white_table');
			});
            $(this).addClass('btn btn-xs btn_white_table');
            var typ = $(this).attr('startRate');
			
            if (typ != 'commentLink') {
                $('#startRate').val(typ);
                $('#startRate').keyup();
				
                if (typ.length == 0) {
                    $('.nav-tabs').each(function (i) {
                        $(this).children().removeClass('active');
					});
                    $('#filterBy').val('');
                    $('#filterBy').keyup();
                    $('ul.nav-tabs li.all').addClass('active');
                    tableBase.draw();
				}
				} else {
                $('#startRate').val('');
                $('#startRate').keyup();
                tableBase.draw();
			}
			
		});
		
		var tableId = 'onsiteReview';
        var tableBase = custom_data_table(tableId);
		
	});
	
	
</script>
