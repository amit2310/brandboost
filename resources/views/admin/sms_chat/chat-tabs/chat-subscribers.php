<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); ?>
<div class="tab-pane <?php echo $campaign; ?>" id="right-icon-tab1">
	<div class="row">
		<div class="col-lg-12">
			<!-- Marketing campaigns -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title"><?php echo count($oContacts); ?> Contacts</h6>
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
					<table class="table datatable-basic datatable-sorting">
						<thead>
							<tr>
								<th style="display: none;"></th>
								<th style="display: none;"></th>
								<th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
								<th><i class="icon-user"></i> Name</th>
								<th><i class="icon-iphone"></i> Phone</th>
								<th><i class="icon-calendar"></i> Created</th>
								<th><i class="icon-hash"></i> Source</th>
								<th><i class="icon-atom"></i> Social</th>
								<th><i class="icon-price-tag2"></i> Tags</th>
								<th class="text-center"><i class="fa fa-dot-circle-o"></i> Status</th>
								<!-- <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$inc = 1;
								foreach ($oContacts as $oContact) {
								?>
								<tr id="append-<?php echo $oContact->id; ?>" class="selectedClass">
									<td style="display: none;"><?php echo date('m/d/Y', strtotime($oContact->created)); ?></td>
									<td style="display: none;"><?php echo $oContact->id; ?></td>
									<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $oContact->id; ?>" id="chk<?php echo $oContact->id; ?>"><span class="custmo_checkmark"></span></label></td>
									<td>
										<div class="media-left media-middle"> <a href="#"><img src="<?php echo base_url(); ?>assets/images/userp.png" class="img-circle img-xs" alt=""></a> </div>
										<div class="media-left">
											<div class="pt-5"><a href="<?php echo base_url(); ?>admin/subscriber/activities/<?php echo $oContact->id; ?>" target="_blank" class="text-default text-semibold"><span><?php echo $oContact->firstname; ?> <?php echo $oContact->lastname; ?></span> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/us.png"/></a></div>
											<div class="text-muted text-size-small"><?php echo $oContact->email; ?></div>
											
										</div>
									</td>
									
									<td>
										<div class="media-left">
											<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oContact->phone; ?></a></div>
											<div class="text-muted text-size-small">Chat</div>
										</div>
									</td>
									<td>
										<div class="media-left">
											<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oContact->created)); ?></a></div>
											<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oContact->created)); ?></div>
										</div>
									</td>
									<td>
										<div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-envelop txt_blue"></i></a> </div>
										<div class="media-left">
											<div class="pt-5"><a href="#" class="text-default text-semibold">Email</a></div>
											<div class="text-muted text-size-small">Form #183</div>
										</div>	
									</td>
									<td>
										<a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-twitter txt_lblue"></i></button></a>
										<a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-facebook txt_dblue"></i></button></a>
										<a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-phone2 txt_green"></i></button></a>
										<a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-envelop txt_blue"></i></button></a>
									</td>
									<td>
										<div class="tdropdown">
											<button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> 4 Tags &nbsp; <span class="caret"></span></button>
											<ul class="dropdown-menu dropdown-menu-right width-200">
												<li><a href="#"><i class="icon-menu7"></i> Action</a>
												</li>
												<li><a href="#"><i class="icon-screen-full"></i> Another action</a>
												</li>
												<li><a href="#"><i class="icon-mail5"></i> One more action</a>
												</li>
												<li class="divider"></li>
												<li><a href="#"><i class="icon-gear"></i> Separated line</a> </li>
											</ul>
										</div>
										<button class="btn btn-xs btn_white_table"><i class="icon-plus3"></i></button>
									</td>
									
									<td class="text-center">
										<button class="btn btn-xs btn_white_table pr10"><?php echo $oContact->status == 1 ? '<i class="icon-primitive-dot txt_green"></i> Active' : '<i class="icon-primitive-dot txt_red"></i> Inactive'; ?></button>
									</td>
									
									
									<!-- <td class="text-center">
										<div class="tdropdown">
											<button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
											<ul class="dropdown-menu dropdown-menu-right width-200">
												<li><a subscriberId='<?php echo $oContact->id; ?>' change_status = '2' class='chg_status'><i class='icon-file-locked'></i> Move To Archive</a></li>
												<?php
													if ($oContact->status == 1) {
													?><li><a subscriberId='<?php echo $oContact->id; ?>' change_status = '0' class='chg_status'><i class='icon-file-locked'></i> Inacive</a></li>
													<?php
                                                        } else {
													?>
													<li><a  subscriberId='<?php echo $oContact->id; ?>' change_status = '1' class='chg_status'><i class='icon-file-locked'></i> Active</a></li>
													<?php
													}
												?>
												<li><a href="javascript:void(0);" class="editSubscriber" subscriberid="<?php echo $oContact->id; ?>"><i class="icon-pencil"></i> Edit</a></li>
												
												<li><a class="deleteSubscriber" href="javascript:void(0);" subscriberid="<?php echo $oContact->id; ?>"><i class="icon-trash"></i> Delete</a></li>
											</ul>
										</div>
									</td> -->
								</tr>
								<?php
									$inc++;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
