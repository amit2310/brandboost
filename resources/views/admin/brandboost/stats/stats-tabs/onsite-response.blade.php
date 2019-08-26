<div class="tab-pane <?php echo $responseStatus; ?>" id="right-icon-tab3">
	<!-- Dashboard content -->
	<div class="row">
		<div class="col-lg-12">
			<!-- Marketing campaigns -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Review Response</h6>
					<div class="heading-elements">
						<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
							<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
							<div class="form-control-feedback">
								<i class="icon-search4"></i>
							</div>
						</div>&nbsp; &nbsp;

						<button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
						<button id="deleteCampaignResponse" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
					</div>
				</div>
				
				<div class="table-responsive">
					<table class="table datatable-basic datatable-sorting" id="onsiteResponse">
						<thead>
							<tr>
								<th style="display: none;"></th>
								<th style="display: none;"></th>
								<th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
								<th><i class="icon-user"></i> Name</th>
								<th><i class="icon-iphone"></i> Phone</th>
								<th><i class="icon-atom"></i> Ratings</th>
								<th><i class="icon-calendar"></i> Created</th>
								<th><i class="icon-calendar"></i> Reviewed Date</th>
							</tr>
						</thead>
						<tbody id="listsubscribers_table">
							
							<?php
								if (count($oResponse) > 0) {
									foreach ($oResponse as $data) { 
									//pre($oResponse);
									?>
									<tr id="append-response-<?php echo $data->id; ?>" class="selectedClass">
										<td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
										<td style="display: none;"><?php echo $data->id; ?></td>
										<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $data->trackinglogid; ?>" id="chk<?php echo $data->trackinglogid; ?>"><span class="custmo_checkmark"></span></label></td>
										<td>			
											<div style="vertical-align: top!important;" class="media-left media-middle">
												<a href="#">
													<img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
												</a>
											</div>
											<div class="media-left">
												<a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
												<div class="text-muted text-size-small"><?php echo $data->email; ?></div>
												
											</div>
										</td>
										<td><div class="text-muted text-size-small"><?php echo $data->phone; ?></div></td>
										<td><?php echo ratingView($data->ratings); ?>
										</td>
										<td>
											<div class="media-left">
												<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($data->created)); ?></a></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)); ?></div>
											</div>
										</td>
										<td>
											<div class="media-left">
												<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($data->reviewdate)); ?></a></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->reviewdate)); ?></div>
											</div>
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
	</div>
	<!-- /dashboard content -->
</div>
