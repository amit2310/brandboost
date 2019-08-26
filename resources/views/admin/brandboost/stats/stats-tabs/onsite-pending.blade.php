<div class="tab-pane <?php echo $pendinngStatus; ?>" id="right-icon-tab4">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Pending Request</h6>
					<div class="heading-elements">
						<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
							<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
							<div class="form-control-feedback">
								<i class="icon-search4"></i>
							</div>
						</div>&nbsp; &nbsp;

						<button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
						<button id="deleteCampaignPending" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table datatable-basic datatable-sorting">
						<thead>
							<tr>
								<th style="display: none;"></th>
								<th style="display: none;"></th>
								<th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
								<th><i class="icon-user"></i> Name</th>
								<th><i class="icon-iphone"></i> Phone</th>
								<th><i class="icon-calendar"></i> Created</th>
								<th><i class="icon-atom"></i> Status</th>
								<th class="text-center"><i class="icon-atom"></i> Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (count($oPending) > 0) {
								foreach ($oPending as $data) {
									?>
									<tr id="append-pending-<?php echo $data->id; ?>" class="selectedClass">
										<td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
										<td style="display: none;"><?php echo $data->id; ?></td>
										<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $data->id; ?>" id="chk<?php echo $data->id; ?>"><span class="custmo_checkmark"></span></label></td>
										<td>			
											<div style="vertical-align: top!important;" class="media-left media-middle">
												<a href="#">
													<img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
												</a>
											</div>
											<div class="media-left">
												<a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
												<div class="text-muted text-size-small"><?php echo $data->email; ?></div>
												<div class="text-muted text-size-small"><?php echo $data->phone; ?></div>
											</div>
										</td>
										<td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
										<?php /* ?>
										<td class="text-center"><?php echo $data->status == 1 ? '<span class="label bg-success">ACTIVE</span>' : '<span class="label bg-danger">INACTIVE</span>'; ?></td>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<?php
														if ($data->status == 1) {
															echo "<li><a subscriberId='" . $data->id . "' change_status = '0' class='chg_status'><i class='icon-file-locked'></i> Inacive</a></li>";
														} else {
															echo "<li><a  subscriberId='" . $data->id . "' change_status = '1' class='chg_status'><i class='icon-file-locked'></i> Active</a></li>";
														}
														?>
														<li><a href="javascript:void(0);" class="editSubscriber" subscriberid="<?php echo $data->id; ?>"><i class="icon-gear"></i> Edit</a></li>

														<li><a class="deleteSubscriber" href="javascript:void(0);" subscriberid="<?php echo $data->id; ?>"><i class="icon-trash"></i> Delete</a></li>

													</ul>
												</li>
											</ul>
										</td>
										<?php */ ?>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div align="right" id="pagination_link"></div>
			<!-- /marketing campaigns -->
		</div>
	</div>    
</div>
<script>
	$(document).on('click', '.editDataList', function () {
		$('.editAction').toggle();
	});
</script>
