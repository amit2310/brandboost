@extends('layouts.main_template') 

@section('title')
<?php //echo $title; ?>
@endsection

@section('contents')

<div class="content">
	<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
		<div class="row">
			<!--=============Headings & Tabs menu==============-->
			<div class="col-md-5">
				<h3><img style="width: 16px;" src="<?php echo base_url(); ?>assets/images/live_icon2.png"> Live Details</h3>
			</div>
		</div>
	</div>
	
	<!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
	<div class="tab-content"> 
		<!--===========TAB 1===========-->
		<div class="tab-pane active" id="right-icon-tab0">
			<div class="row">
				<div class="col-md-12">
					<div style="margin: 0;" class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><?php echo count($oLiveData); ?> Live Visitors</h6>
							<div class="heading-elements">
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
									<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
									<div class="form-control-feedback">
										<i class=""><img src="<?php echo base_url(); ?>assets/images/icon_search.png" width="14"></i>
									</div>
								</div>
								<div class="table_action_tool">
									<a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh.png"/></i></a>
									<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"/></i></a>
									<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"/></i></a>
									<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"/></i></a>
									<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_edit.png"/></i></a>
								</div>
							</div>
						</div>
						<div class="panel-body p0">
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Name</th>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_id.png"></i>IP Address</th>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_device.png"></i>Device</th>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_device.png"></i>Browser</th>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_clock.png"></i>Online</th>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_source.png"></i>Source</th>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_source.png"></i>Action Parform</th>
										<th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_source.png"></i>Country</th>
										<!-- <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_clock.png"></i>Created By</th> -->
									</tr>
								</thead>
								<tbody>
									
									<?php 
										foreach($oLiveData as $data): 
										$userData = getUserDetail($data->user_id)
									?>
									<tr>
										<td>
											<?php if($data->user_id > 0){ ?>
											<div class="media-left media-middle"> <a class="icons"><?php echo showUserAvtar($userData->avatar, $userData->firstname, $userData->lastname, 28, 28, 11); ?></a> </div>
											<div class="media-left">
												<div class=""><a class="text-default text-semibold bbot"><?php echo $userData->id > 0 ? $userData->firstname .' ' .$userData->lastname : 'Annoymous'; ?></a> </div>
											</div>
											<?php }else{ ?>
											<div class="media-left media-middle"><?php echo showUserAvtar('', '', '', 28, 28, 11); ?></div>
											<div class="media-left">
												<div class=""><a class="text-default text-semibold bbot">Annoymous</a> </div>
											</div>
											<?php } ?>
										</td>
										<td><?php echo $data->ip_address; ?></td>
										<td>
											<div class="media-left media-middle brig pr30"> 
												<a class="icons"><?php echo getPlatformImg($data->platform); ?></a>
											</div>
										</td>
										<td>
											<div class="media-left media-middle brig pr30"> 
												<a class="icons"><?php echo getBrowserImg($data->browser); ?></a>
											</div>
										</td>
										<td><strong class="text-default text-semibold"><?php echo timeAgo($data->created); ?></strong></td>
										<td><div class="text-muted"><?php echo $data->source_page; ?></div></td>
										<td><div class="text-muted"><?php echo $data->source_type; ?></div></td>
										<td><div class="text-muted"><?php echo $data->city; ?> (<?php echo $data->countryCode; ?>)</div></td>
										<!-- <td>
											<div class="media-left">
												<div class="pt-5"><a class="text-default text-semibold">
												<?php echo dataFormat($data->created); ?></a></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)); ?></div>
											</div>
										</td> -->
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--===========TAB 2===========-->
		<div class="tab-pane" id="right-icon-tab1">
			Statistic
		</div>
	</div>
</div>

@endsection