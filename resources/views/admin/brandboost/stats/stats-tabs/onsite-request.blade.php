<div class="tab-pane <?php echo $requestStatus; ?>" id="right-icon-tab2">
	<!-- Dashboard content -->
	<div class="row">
		<div class="col-lg-12">
			<!-- Marketing campaigns -->
			<div class="panel panel-flat">
				<div class="panel-heading" style="box-shadow:none;">
					<h6 class="panel-title">Review Requests</h6>
					<div class="heading-elements">
						<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
							<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
							<div class="form-control-feedback">
								<i class="icon-search4"></i>
							</div>
						</div>&nbsp; &nbsp;

						<button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
						<button id="deleteCampaignRequest" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
					</div>
				</div>
				
				<div class="table-responsive">
					<table class="table datatable-basic datatable-sorting" id="onsiteRequest">
						<thead>
							<tr>
								<th style="display: none;"></th>
								<th style="display: none;"></th>
								<th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
								<th><i class="icon-display"></i> Campaign Name</th>
								<th><i class="icon-user"></i> Contact Name</th>
								<th><i class="icon-display"></i> Campaign Review</th>
								<th><i class="fa fa-dot-circle-o"></i> Source</th>
								<th><i class="icon-calendar"></i> Created</th>
								<th><i class="icon-calendar"></i> Request Sent Date</th>
							</tr>
						</thead>
						<tbody id="listsubscribers_table">
							
							<?php
								if (count($oRequest) > 0) {
									foreach ($oRequest as $data) {
										
										//pre($data->brandboost_id);
										
										$brandImgArray = unserialize($data->brand_img);
										$brand_img = $brandImgArray[0]['media_url'];
										
										if (empty($brand_img)) {
											$imgSrc = base_url('assets/images/default_table_img2.png');
											} else {
											$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
										}
										//pre($data);
									?>
									<tr id="append-request-<?php echo $data->trackinglogid; ?>" class="selectedClass">
										<td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
										<td style="display: none;"><?php echo $data->trackinglogid; ?></td>
										<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $data->trackinglogid; ?>" id="chk<?php echo $data->trackinglogid; ?>"><span class="custmo_checkmark"></span></label></td>
										<td>
											<div class="media-left media-middle">
												<a href="<?php echo base_url('admin/brandboost/onsite_setup/'.$data->brandboost_id);?>" class="text-default text-semibold">
												<img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
											</div>
											<div class="media-left">
												<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_setup/'.$data->id);?>" class="text-default text-semibold"><?php echo $data->brand_title; ?></a></div>
												<div class="text-muted text-size-small">
													<?php echo setStringLimit($data->brand_desc); ?>
												</div>
											</div>
										</td>
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
										<td>
											<div class="media-left media-middle"> 
												<a class="icons square" href="#"><i class="icon-indent-decrease2 txt_blue"></i></a> 
											</div>
											<div class="media-left">
											  <div><a href="#" class="text-default text-semibold"><?php echo $data->subject == '' ? '<span style="color:#999999">No Data</span>' : setStringLimit($data->subject); ?></a></div>
											  <div class="text-muted text-size-small"><?php echo setStringLimit($data->name); ?></div>
											</div>
										</td>
										<td><?php echo ucfirst($data->tracksubscribertype); ?></td>
										<td>
											<div class="media-left">
												<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($data->created)); ?></a></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)); ?></div>
											</div>
										</td>
										<td>
											<div class="media-left">
												<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($data->requestdate)); ?></a></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->requestdate)); ?></div>
											</div>
										</td>
										
										<?php /* ?><td class="text-center"><?php echo $data->status == 1 ? '<span class="label bg-success">ACTIVE</span>' : '<span class="label bg-danger">INACTIVE</span>'; ?></td>
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
										</td> <?php */ ?>
										
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


<script type="text/javascript">
	
	$(document).on("click", ".editBrandboost", function () {
        var brandboostID = $(this).attr('brandID');
        $.ajax({
            url: '<?php echo base_url('admin/brandboost/editOnsite'); ?>',
            type: "POST",
            data: {'brandboostID': brandboostID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                	window.open('<?php echo base_url('admin/brandboost/setup/onsite'); ?>', '_blank');
                    //window.location.href = '<?php echo base_url('admin/brandboost/setup/onsite'); ?>';
					} else {
                    alertMessage('Error: Some thing wrong!');
				}
			}
		});
	});
	
	</script>	