<style>
a.filterByColumn.active{
	height: 24px !important;
	border-radius: 50px !important;
	border: solid 1px rgba(210, 210, 232, 0.1) !important;
	background-color: rgba(196, 196, 225, 0.2) !important;
	color: #202040;
	font-size: 12px !important;
	font-weight: 500 !important;
	box-shadow: none !important;
	line-height: 16px;
	padding: 3px 10px !important;
	margin: 0 2px;
}
</style>



<div class="tab-pane <?php echo $defalutTab == 'score' ? 'active' : ''; ?>" id="right-icon-tab5">
    <!-- Dashboard content -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title" style="width: 150px;float: left;"><?php echo count($oFeedbacks); ?> NPS Score</h6>
			
			<div class="heading_links pull-left">				
				<a class="top_links active filterByColumn">All</a>
				<a class="top_links filterByColumn" fil="promoters" style="cursor: pointer;">Promoters</a>
				<a class="top_links filterByColumn" fil="passive" style="cursor: pointer;">Passive</a> 
				<a class="top_links filterByColumn" fil="detractors" style="cursor: pointer;">Detractors</a>
			</div>
			
			<div class="heading-elements">
				<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
					<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
					<div class="form-control-feedback">
						<i class="icon-search4"></i>
					</div>
				</div>&nbsp; &nbsp;
				
			</div>
		</div>
		
		
		<div class="panel-body p0">
			<?php if(!empty($oFeedbacks)) {?>
			<table class="table" id="scorePage">
				<thead>
					<tr>
						<th style="display: none"></th>
                        <th style="display: none"></th>
						<th><i class="icon-user"></i> Name</th>
						<th><i class="icon-display"></i> Phone</th>
						<th><i class="icon-calendar"></i> Created</th>
						<th><i class="icon-hash"></i> Score</th>
						<th><i class="icon-atom"></i> Feedback</th>
						<th data-filter="score" style="display:none;"></th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php
						foreach ($oFeedbacks as $oFeedback) {
							$score = ($oFeedback->score) ? $oFeedback->score : 0;
							$feedback = ($oFeedback->feedback) ? $oFeedback->feedback : 'N/A';
							$oTags = $mNPS->getTagsByScoreID($oFeedback->id);
							
							//$profileImg = $oFeedback->avatar == '' ? base_url('assets/images/userp.png') : base_url('profile_images/' . $oFeedback->avatar);
							
						?>
						<tr>
							<td style="display: none;"><?php echo $oFeedback->id; ?></td>
							<td style="display: none;"><?php echo $oFeedback->id; ?></td>
							<td>
								<div class="media-left media-middle"> <a href="#"><img src="<?php echo base_url(); ?>assets/images/userp.png" class="img-circle img-xs" alt=""></a> </div>
								
								
								<div class="media-left">
									<div class="pt-5"><a href="<?php echo base_url(); ?>admin/subscriber/activities/<?php echo $oFeedback->id; ?>" target="_blank" class="text-default text-semibold"><span><?php echo $oFeedback->firstname; ?> <?php echo $oFeedback->lastname; ?></span> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/us.png"/></a></div>
									<div class="text-muted text-size-small"><?php echo $oFeedback->email; ?></div>
								</div>
							</td>
							<td>
								<div class="media-left">
									<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo $oFeedback->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oFeedback->phone; ?></a></div>
									<div class="text-muted text-size-small">Chat</div>
								</div>
							</td>
							<td>
								<div class="media-left">
									<div class="pt-5"><a class="text-default text-semibold"><?php echo dataFormat($oFeedback->created_at); ?></a></div>
									<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oFeedback->created_at)); ?></div>
								</div>
							</td>
							<td><?php echo $score; ?></td>
							<td>
								<div class="media-left">
									<a target="_blank" href="<?php echo base_url("/admin/modules/nps/feedbackdetails/" . $oFeedback->id); ?>"><span class="text-default text-semibold"><?php echo setStringLimit($oFeedback->title); ?></span></a>
									<div class="text-muted text-size-small">
										<?php echo setStringLimit($feedback); ?>
									</div>
								</div> 
							</td>
							<td style="display:none;"><?php if($score > 8){ echo 'Promoters'; } ?><?php if($score > 6 && $score < 9){ echo 'Passive'; } ?><?php if($score < 7){ echo 'Detractors'; } ?></td>
						</tr>
						<?php
						}
					?>
				</tbody>
			</table>
			<?php }
			else {
				?>
				<table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th style="display: none"></th>
                            <th style="display: none"></th>
                            <th><i class="icon-user"></i> Name</th>
							<th><i class="icon-display"></i> Phone</th>
							<th><i class="icon-calendar"></i> Created</th>
							<th><i class="icon-hash"></i> Score</th>
							<th><i class="icon-atom"></i> Feedback</th>
                        </tr>
                    </thead>

                    <tbody>
                        <td style="display: none"></td>
                        <td style="display: none"></td>
                        <td colspan="10">
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="margin: 20px 0px 0;" class="text-center">
                                        <h5 class="mb-20 mt40">
                                            Looks Like You Don’t Have Any Feedback Score Yet <img src="<?php echo site_url('assets/images/smiley.png'); ?>"> <!-- <br>
                                            Lets Create Your First On Site Review Campaign. -->
                                        </h5>

                                       <!--  <?php if ($canWrite): ?>
                                            <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40" <?php } else { ?> id="addBrandboost" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" <?php } ?> type="button" ><i class="icon-plus3"></i> Add On Site Review Campaign</button>
                                        <?php endif; ?> -->

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="display: none"></td>
                        <td style="display: none"></td>
                        <td style="display: none"></td>
                        <td style="display: none"></td>
                    </tbody>
                </table><?php
			} ?>
		</div>
	</div>
	
	<!-- /dashboard content -->
	<?php if($oNPS->platform == 'web' || $oNPS->platform == 'link'){ ?>
	<div class="row pull-right">
		<div class="col-md-12">
			<a href="<?php echo base_url("/admin/modules/nps/setup/{$programID}?t=widgets") ?>" class="btn dark_btn mt30">Continue</a>
		</div>
	</div>
	<?php }else{ ?>
	<div class="row pull-right">
		<div class="col-md-12">
			<a href="javascript:void(0);" id="publishNPSCampaign" class="btn dark_btn mt30">Publish</a>
		</div>
	</div>
	<?php } ?>
	
	
	<div id="editSurveyModel" class="modal fade in">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" id="frmeditSurveyModel" name="frmeditSurveyModel">
                                    @csrf
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Survey</h5>
					</div>
					
					<div id="npsTitleEdit">
						<div class="modal-body">
							<p>Survey Name:</p>
							<input class="form-control" id="edit_title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
							<div id="editSurveyValidation" style="color:#FF0000;display:none;"></div>
						</div>
						
						<div class="modal-footer">
							<input type="hidden" name="nps_id" id="hidnpsid" value="" />
							<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Continue</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!-- add New Survey -->
	<div id="addNPSModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" name="frmaddNPSModal" id="frmaddNPSModal" action="javascript:void();">
				@csrf	
                                    <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Add New Survey</h5>
					</div>
					
					<div id="npsTitle">
						<div class="modal-body">
							<p>Survey Name:</p>
							<input class="form-control" id="title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
							<div id="addNPSValidation" style="color:#FF0000;display:none;"></div>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<div id="NPSTagListModal" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
                            <form method="post" name="frmNPSTagListModal" id="frmNPSTagListModal" action="javascript:void();">
				@csrf	
                                    <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Apply Tags</h5>
					</div>
					<div class="modal-body" id="tagEntireList"></div>
					<div class="modal-footer modalFooterBtn">
						<input type="hidden" name="score_id" id="tag_score_id" />
						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Apply Tag</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
</div>
<!-- /content area -->
<script type="text/javascript">
	
	$(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#scorePage thead tr').clone(true).appendTo('#scorePage thead');
		
        $('#scorePage thead tr:eq(1) th').each(function (i) {
			var dataFilter = $(this).attr('data-filter');
            if (dataFilter === 'score') {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');
				
                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
						.column(i)
						.search(this.value, $('#colStatus').prop('checked', true))
						.draw();
					}
				});
			}
		});
		
        $(document).on('click', '.filterByColumn', function () {
            $('.nav-tabs').each(function (i) {
                $('.filterByColumn').removeClass('active');
			});
            $(this).addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();
		});
		
        var tableId = 'scorePage';
        var tableBase = custom_data_table(tableId);
		
        $('table#scorePage thead tr:eq(1)').hide();
	});
	
	
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
		
		$(document).on('click', '#deleteBulkNPS', function () {
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
							url: '<?php echo base_url('admin/modules/nps/bulkDeleteNPS'); ?>',
							type: "POST",
							data: {_token: '{{csrf_token()}}', bulk_nps_id: val},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = window.location.href;
								}
							}
						});
					}
				});
			}
		});
		
		$(document).on('click', '#archiveBulkNPS', function () {
			var val = [];
			$('.checkRows:checkbox:checked').each(function (i) {
				val[i] = $(this).val();
			});
			if (val.length === 0) {
				alert('Please select a row.')
				} else {
				
				var elem = $(this);
				swal({
					title: "Are you sure? You want to move to archive this record!",
					text: "",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "Yes, move to archive it!",
					cancelButtonText: "No, cancel pls!",
					closeOnConfirm: true,
					closeOnCancel: true
				},
				function (isConfirm) {
					if (isConfirm) {
						$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/modules/nps/bulkArchiveNPS'); ?>',
							type: "POST",
							data: {_token: '{{csrf_token()}}', bulk_nps_id: val},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = window.location.href;
								}
							}
						});
					}
				});
			}
		});
		
		$('#addNpsSurvery').click(function () {
			$('#addNPSModal').modal();
		});
		
		$('#frmaddNPSModal').on('submit', function () {
			
			$('.overlaynew').show();
			var formdata = $("#frmaddNPSModal").serialize();
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/addNPS'); ?>',
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						window.location.href = '<?php echo base_url('admin/modules/nps/setup/'); ?>' + data.id;
						} else if (data.status == 'error' && data.type == 'duplicate') {
						$('.overlaynew').hide();
						$("#addNPSValidation").html(data.msg).show();
						setTimeout(function () {
							$("#addNPSValidation").html("").hide();
						}, 5000);
					}
					
				}
			});
			return false;
		});
		
		$(document).on("click", ".editSurvey", function () {
			$('.overlaynew').show();
			var nps_id = $(this).attr('nps_id');
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/getNPS'); ?>',
				type: "POST",
				data: {_token: '{{csrf_token()}}', 'nps_id': nps_id},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$("#edit_title").val(data.title);
						$("#hidnpsid").val(nps_id);
						$('.overlaynew').hide();
						$("#editSurveyModel").modal();
						} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		$(document).on("click", ".moveToArchiveNPS", function () {
			$('.overlaynew').show();
			var nps_id = $(this).attr('nps_id');
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/moveToArchiveNPS'); ?>',
				type: "POST",
				data: {_token: '{{csrf_token()}}', 'nps_id': nps_id},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						window.location.href = window.location.href;
						} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		$('#frmeditSurveyModel').on('submit', function () {
			$('.overlaynew').show();
			var formdata = $("#frmeditSurveyModel").serialize();
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/updateNPS'); ?>',
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						window.location.href = '<?php echo base_url('admin/modules/nps/setup/'); ?>' + data.id;
						} else if (data.status == 'error' && data.type == 'duplicate') {
						$('.overlaynew').hide();
						$("#editSurveyValidation").html(data.msg).show();
						setTimeout(function () {
							$("#editSurveyValidation").html("").hide();
						}, 5000);
					}
				}
			});
			return false;
		});
		
		$(document).on('click', '.deleteNPS', function () {
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
					var nps_id = $(elem).attr('nps_id');
					$.ajax({
						url: '<?php echo base_url('admin/modules/nps/deleteNPS'); ?>',
						type: "POST",
						data: {_token: '{{csrf_token()}}', nps_id: nps_id},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = window.location.href;
							}
						}
					});
				}
			});
		});
		
		
		$(document).on("click", ".applyInsightTags", function () {
			var score_id = $(this).attr("scoreid");
			var action_name = $(this).attr("action_name");
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/listAllTags'); ?>',
				type: "POST",
				data: {_token: '{{csrf_token()}}', score_id: score_id},
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
						$("#tagEntireList").html(dataString);
						$("#tag_score_id").val(score_id);
						if (action_name == 'nps-tag') {
							$("#NPSTagListModal").modal("show");
						}
					}
				}
			});
		});
		
		$("#frmNPSTagListModal").submit(function () {
			var formdata = $("#frmNPSTagListModal").serialize();
			$.ajax({
				url: '<?php echo base_url('admin/modules/nps/applyNPSTag'); ?>',
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$("#NPSTagListModal").modal("hide");
						window.location.href = window.location.href;
					}
				}
			});
			return false;
		});
	
	});
	
</script>				