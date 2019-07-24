<?php list($canRead, $canWrite) = fetchPermissions('Feedbacks'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel-body p0">
			<table class="table datatable-basic datatable-sorting">
				<thead>
					<tr>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
						<th class="nosort editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
						<th><i class="icon-user"></i>Name</th>
						<th><i class="icon-star-full2"></i>Ratings</th>
						<th><i class="icon-star-full2"></i>Campaign Review</th>
						<th><i class="icon-calendar"></i>Created</th>
						<th><i class="icon-price-tag2"></i>Tags</th>
						<th><i class="icon-atom"></i>Category</th>
						<th><i class="icon-atom"></i>Status</th>
						<th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						if (count($result) > 0) {
							foreach ($result as $data) {
								//pre($data);
								$CI = & get_instance();
								$CI->load->model("admin/Tags_model", "mT");
								$feedbackTags = $CI->mT->getTagsDataByFeedbackID($data->id);
								$brandImgArray = unserialize($data->brand_img);
								$brand_img = $brandImgArray[0]['media_url'];
								
								if (empty($brand_img)) {
									$imgSrc = base_url('assets/images/default_table_img2.png');
									} else {
									$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
								}
								
								if(!empty($data->avatar)) {
									$avatarImage = $data->avatar;
								}
								else {
									$avatarImage = 'avatar_image.png';
								}
							?>
							<tr id="append-feedback-<?php echo $data->id; ?>" class="selectedClass">
								<td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
								<td style="display: none;"><?php echo $data->id; ?></td>
								<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows"  value="<?php echo $data->id; ?>" ><span class="custmo_checkmark"></span></label></td>
								
								<td>
									<div class="media-left media-middle"> <a href="#"><img src="<?php echo base_url('profile_images/').$avatarImage; ?>" class="img-circle img-xs" alt=""></a> </div>
									
									<div class="media-left">
										<?php if($data->firstname != '') { ?>
											<div class="pt-5"><a href="<?php echo base_url();?>admin/subscriber/activities/<?php echo $data->id;?>" target="_blank" class="text-default text-semibold"><span><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></span> <img class="flags" src="<?php echo base_url();?>assets/images/flags/us.png"/></a></div>
											<div class="text-muted text-size-small"><?php echo $data->email; ?></div>
										<?php } else{ echo 'NA'; } ?>
									</div>
								</td>
								
								<td>
									<?php if($data->category == 'Positive'){ $ratingValue = 5; }else if($data->category == 'Neutral'){ $ratingValue = 3;}else{$ratingValue = 1; } ?>
									<?php echo $smilyImage = ratingView($ratingValue); ?>
								</td>
								
								<td>
									<div class="text-semibold"><?php echo setStringLimit($data->title); ?></div>
									<div class="text-size-small text-muted"><?php echo setStringLimit($data->feedback); ?></div>
								</td>
								
								<td>
									<div class="media-left">
										<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($data->created)); ?></a></div>
										<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)); ?></div>
									</div>
								</td>
								
								<!-- <td>
									
									<span class="ratingBox" id="ratingBoxStatus<?php echo $data->id; ?>" style="display: block">
										<?php if ($data->category == 'Positive'): ?>
										<i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10 txt_green"></i>
										<?php elseif ($data->category == 'Neutral'): ?>
										<i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10"></i><i class="icon-star-full2 fsize10"></i>
										<?php elseif ($data->category == 'Negative'): ?>
										<i class="icon-star-full2 fsize10 txt_green"></i><i class="icon-star-full2 fsize10"></i><i class="icon-star-full2 fsize10"></i><i class="icon-star-full2 fsize10"></i><i class="icon-star-full2 fsize10"></i>
										<?php endif; ?>
									</span>
									<a href="javascript:void(0);"><span class="text-muted reviewnum">(<?php echo $rc; ?> out of 5 Stars)</span></a>
								</td> -->
								
								<td>
									<div class="tdropdown">
										<button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> <?php echo count($feedbackTags); ?> Tags &nbsp; <span class="caret"></span></button>
										<?php if (count($feedbackTags) > 0) { ?>
											<ul class="dropdown-menu dropdown-menu-right width-200">
												<?php
													foreach ($feedbackTags as $tagsData) {
														
														?><li><a href="#"><i class="icon-screen-full"></i> <?php echo $tagsData->tag_name; ?></a>
														</li><?php
													}
												?>
											</ul>
										<?php } ?>
									</div>
									<?php if($canWrite): ?>
									<a href="javascript:void(0);" class="applyInsightTags btn btn-xs btn_white_table" action_name="feedback-tag" feedback_id="<?php echo $data->id; ?>" > + </a>
									<?php endif; ?>			
								</td>
								
								<td>
									<div class="tdropdown">
										<button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown">
											<?php if ($data->category == 'Positive'): ?>
											<span class="label txt_blue">Positive</span>
											<?php elseif ($data->category == 'Neutral'): ?>
											<span class="label txt_green">Neutral</span>
											<?php elseif ($data->category == 'Negative'): ?>
											<span class="label txt_red">Negative</span>
											<?php endif; ?>
										&nbsp; <span class="caret"></span></button>
										<?php if (count($feedbackTags) > 0) { ?>
											<ul class="dropdown-menu dropdown-menu-right width-100">
												<li><a class="txt_blue updateFeedbackStatusNew" feedback_id="<?php echo $data->id; ?>" fb_status="Positive">Positive</a></li>
												<li><a class="txt_green updateFeedbackStatusNew" feedback_id="<?php echo $data->id; ?>" fb_status="Neutral">Neutral</a></li>
												<li><a class="txt_red updateFeedbackStatusNew" feedback_id="<?php echo $data->id; ?>" fb_status="Negative">Negative</a></li>
											</ul>
										<?php } ?>
									</div>
								</td>
								
								<td>
									<button class="btn btn-xs btn_white_table pr10">
									<?php
									if ($data->status == 0) {
										echo '<i class="icon-primitive-dot txt_red"></i> Disapproved';
									} else if ($data->status == 2) {
										echo '<i class="icon-primitive-dot txt_blue"></i> Pending';
									} else {
										echo '<i class="icon-primitive-dot txt_green"></i> Approved';
									}
									?>
									</button>
								</td>
								
								<td>
									<ul class="icons-list">  
										<li class="dropdown">
											<button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
											<ul class="dropdown-menu dropdown-menu-right">
												
												<li><a href="<?php echo base_url(); ?>admin/feedback/details/<?php echo $data->id; ?>" target="_blank"><i class="icon-file-stats "></i> View Details</a></li>
												
												<?php if ($canWrite): ?>    
												<li><a href="javascript:void(0);" class="applyInsightTags" action_name="feedback-tag" feedback_id="<?php echo $data->id; ?>"><i class="icon-file-stats"></i> Apply Tags</a></li>
												<?php endif; ?>
												<li><a class="displayFeedback" fb_tab_type="feedback" feedback_id="<?php echo $data->id; ?>" fb_time="<?php echo date("M d, Y h:i A", strtotime($data->created)); ?> (<?php echo timeAgo($data->created); ?>)" href="javascript:void(0);" ><i class="icon-file-stats "></i> View</a></li>
												<?php if ($canWrite): ?>
												<li><a class="displayFeedback" fb_tab_type="note" feedback_id="<?php echo $data->id; ?>" href="javascript:void(0);" fb_time="<?php echo date("M d, Y h:i A", strtotime($data->created)); ?> (<?php echo timeAgo($data->created); ?>)"><i class="icon-pencil7"></i> Add Note</a></li>
												<?php endif; ?>
												
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<?php
							}
						}
					?>	
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		$(document).on('change', '#checkAll', function () {
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
			$('#append-feedback-' + rowId).removeClass('success');
			} else {
			$('#append-feedback-' + rowId).addClass('success');
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
		
		if (totalCheckboxes == numberOfChecked) {
			$('#checkAll').prop('checked', true);
		}
	});
	
	$(document).on('click', '#deleteButtonBrandboostFeedbacks', function () {
		
		var val = [];
		$('.checkRows:checkbox:checked').each(function (i) {
			val[i] = $(this).val();
		});
		if (val.length === 0) {
			alert('Please select a row.')
			} else {
			
			var elem = $(this);
			swal({
				title: "Are you sure? You want to delete this record!",
				text: "You will not be able to recover this record!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#EF5350",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel pls!",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function (isConfirm) {
				if (isConfirm) {
					$('.overlaynew').show();
					$.ajax({
						url: '<?php echo base_url('admin/feedback/deleteMultipalFeedbackData'); ?>',
						type: "POST",
						data: {multi_feedback_id: val},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							}
						}
					});
				}
			});
		}
	});
	
	$(document).on('click', '.editDataList', function () {
		$('.editAction').show();
	});
});
</script>					