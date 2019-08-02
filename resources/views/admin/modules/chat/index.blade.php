@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<!-- Content area -->
<?php //if($oPrograms): ?>
<div class="content">
	<div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img src="/assets/images/chat_icon.png"> &nbsp; Chat Widgets</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Chat Widgets</a></li>
                    <!-- <li><a href="<?php echo base_url('admin/webchat'); ?>" >Live Chat</a></li> -->
                    <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
				</ul>
			</div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Contacts &nbsp; &nbsp; <span class="caret"></span>
					</button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                        <div class="dropdown-content-heading"> Filter
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-more"></i></a> </li>
							</ul>
						</div>
                        <div class="">
                            <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings active">
                                        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
									</div>
                                    <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
												</div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
									</div>
                                    <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
									</div>
                                    <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
									</div>
                                    <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
									</div>
                                    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Total Reviews
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
												</div>
												
											</div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Positive
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
												</div>
												
											</div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary">
                                                            Neutral
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
												</div>
												
											</div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Negative
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="dropdown-content-footer">
                            <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                            &nbsp; &nbsp;
                            <a style="display: inline-block;" href="#">Clear All</a>
						</div>
					</div>
				</div>
                <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn dark_btn ml20 pDisplayNoActiveSubscription" <?php } else { ?> id="addChatSurvery" <?php } ?> type="button" class="btn dark_btn ml20"><i class="icon-plus3"></i> Add Chat</button>
			</div>
		</div>
	</div>
	
    <!-- Dashboard content -->
    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><?php echo count($oPrograms); ?> Chat</h6>
							<div class="heading-elements">
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
									<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
									<div class="form-control-feedback">
										<i class="icon-search4"></i>
									</div>
								</div>&nbsp; &nbsp;
								
								<button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
								<button id="deleteBulkChat" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
								<button id="archiveBulkChat" class="btn btn-xs custom_action_box"><i class="icon-gear position-left"></i> Archive</button>
							</div>
						</div>
						
						<div class="panel-body p0">
							<?php if(!empty($oPrograms)) {?>
                            <table class="table datatable-basic datatable-sorting">
								<thead>
									<tr>
										<th style="display: none;"></th>
										<th style="display: none;"></th>
										<th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
										<th><i class="icon-stack-star"></i> Name</th>
										<th><i class="icon-calendar"></i> Created</th>
										<th class="nosort"><i class="icon-statistics"></i> Statistic</th>
										<th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i> Status</th>
										<th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
									</tr>
								</thead>
								
								<tbody>
									<?php
										foreach ($oPrograms as $oProgram):
										
										if ($oProgram->status != 'archive') {
										?>
										<tr id="append-<?php echo $oProgram->id; ?>" class="selectedClass">
											<td style="display: none;"><?php echo date('m/d/Y', strtotime($oProgram->created)); ?></td>
											<td style="display: none;"><?php echo $oProgram->id; ?></td>
											<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $oProgram->id; ?>" id="chk<?php echo $oProgram->id; ?>"><span class="custmo_checkmark"></span></label></td>
											<td>
												<div class="media-left media-middle"> <a class="icons square" href="javascript:void(0);"><i class="icon-checkmark3 txt_blue"></i></a> </div>
												<div class="media-left">
                                                    <div class="pt-5"><a class="text-default text-semibold" href="<?php echo base_url() ?>admin/modules/chat/setup/<?php echo $oProgram->id; ?>"><?php echo $oProgram->title; ?></a></div>
                                                    <div class="text-muted text-size-small"><?php //echo (ucfirst($oProgram->platform)) ? ucfirst($oProgram->platform) : 'NA'; ?></div>
												</div>
												
											</td>
											
											<td> <div class="media-left">
												<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oProgram->created)); ?></a></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oProgram->created)); ?></div>
											</div></td>
											
										
											<td><img src="<?php echo base_url(); ?>assets/images/table_graph.png" class="" alt=""></td>
											

											<td class="text-center">
												<button class="btn btn-xs btn_white_table pr10">
													
													<?php
														if ($oProgram->status == 'active') {
															echo '<i class="icon-primitive-dot txt_green"></i> Publish';
														} else {
															echo '<i class="icon-primitive-dot txt_red"></i> Inactive';
														}
													?>
												</button>
											</td>

										
											<td class="text-center">
												
												<ul class="icons-list">
													<li class="dropup"><button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
														<ul class="dropdown-menu dropdown-menu-right">
															<?php if ($oProgram->status == 'active') { ?>
																<li><a chat_id="<?php echo $oProgram->id; ?>" change_status = 'draft' class='chg_status'><i class='icon-gear'></i>Inactive</a></li>
																<?php } else { ?>
																<li><a chat_id="<?php echo $oProgram->id; ?>" change_status = 'active' class='chg_status'><i class='icon-gear'></i>Active</a></li>
															<?php } ?>
															<li><a href="javascript:void(0);" chat_id="<?php echo $oProgram->id; ?>" class="editChat"><i class="icon-file-stats"></i> Edit</a></li>
															<li><a href="javascript:void(0);" chat_id="<?php echo $oProgram->id; ?>" class="moveToArchiveChat"><i class="icon-file-stats"></i> Move To Archive</a></li>
															<li><a href="javascript:void(0);" chat_id="<?php echo $oProgram->id; ?>" class="deleteChat"><i class="icon-file-text2"></i> Delete</a></li>
														</ul>
													</li>
												</ul>
												
											</td>
											
											
										</tr>
									<?php } endforeach; ?>
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
                                            <th><i class="icon-stack-star"></i> Name</th>
											<th><i class="icon-calendar"></i> Created</th>
											<th class="nosort"><i class="icon-statistics"></i> Statistic</th>
											<th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i> Status</th>
											<th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td colspan="10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div style="margin: 20px 0px 0;" class="text-center">

                                                    	<h5 class="mb-20">
															Looks Like You Don’t Have Created Any Chat widget Yet <img src="<?php echo base_url('assets/images/smiley.png'); ?>"> <br>
															Lets Create Your First Chat Widget
														</h5>
														<button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription" <?php } else { ?> id="addChatSurveryButtton" <?php } ?> class="btn bl_cust_btn btn-default dark_btn ml20 mb40 addChatSurvery" type="button"><i class="icon-plus3"></i> Add Chat</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                    </tbody>
                                </table>
								<?php
							}?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="right-icon-tab1">
			<div class="row">
				<div class="col-lg-12">
					<!-- Marketing campaigns -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Chat</h6>
							<div class="heading-elements">
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
									<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
									<div class="form-control-feedback">
										<i class="icon-search4"></i>
									</div>
								</div>&nbsp; &nbsp;
								
								<button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
								<button id="deleteContactsBtn" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
							</div>
						</div>
						
						<div class="panel-body p0">
							<table class="table datatable-basic datatable-sorting">
								<thead>
									<tr>
										<th style="display: none;"></th>
										<th style="display: none;"></th>
										<th style="display: none;" class="nosort editArchiveAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAllArchive" ><span class="custmo_checkmark"></span></label></th>
										<th><i class="icon-stack-star"></i> Name</th>
										<th><i class="icon-calendar"></i> Created</th>
										<th class="nosort"><i class="icon-statistics"></i> Statistic</th>
										<th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i> Status</th>
										<th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
									</tr>
								</thead>
								
								<tbody>
									<?php
										foreach ($oPrograms as $oProgram):
										if ($oProgram->status == 'archive') {

										
										?>
										<tr id="append-<?php echo $oProgram->id; ?>" class="selectedClass">
											<td style="display: none;"><?php echo date('m/d/Y', strtotime($oProgram->created)); ?></td>
											<td style="display: none;"><?php echo $oProgram->id; ?></td>
											<td style="display: none;" class="editArchiveAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRowsArchive" value="<?php echo $oProgram->id; ?>" id="chk<?php echo $oProgram->id; ?>"><span class="custmo_checkmark"></span></label></td>
											<td>
												<div class="media-left media-middle"> <a class="icons square" href="javascript:void(0);"><i class="icon-checkmark3 txt_blue"></i></a> </div>
												<div class="media-left">
                                                    <div class="pt-5"><a class="text-default text-semibold" href="<?php echo base_url() ?>admin/modules/chat/setup/<?php echo $oProgram->id; ?>"><?php echo $oProgram->title; ?></a></div>
                                                    <div class="text-muted text-size-small"><?php //echo (ucfirst($oProgram->platform)) ? ucfirst($oProgram->platform) : 'NA'; ?></div>
												</div>
												
											</td>
											
											<td> <div class="media-left">
												<div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oProgram->created)); ?></a></div>
												<div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oProgram->created)); ?></div>
											</div></td>
											
											<td><img src="<?php echo base_url(); ?>assets/images/table_graph.png" class="" alt=""></td>
											
											<td class="text-center">
												<button class="btn btn-xs btn_white_table pr10">
													
													<?php
														if ($oProgram->status == 'active') {
															echo '<i class="icon-primitive-dot txt_green"></i> Publish';
														} else {
															echo '<i class="icon-primitive-dot txt_red"></i> Archive';
														}
													?>
												</button>
											</td>

											
											<td class="text-center">
												
												<ul class="icons-list">
													<li class="dropup"><button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
														<ul class="dropdown-menu dropdown-menu-right">
															<?php if ($oProgram->status == 'active') { ?>
																<li><a chat_id="<?php echo $oProgram->id; ?>" change_status = 'draft' class='chg_status'><i class='icon-gear'></i>Inactive</a></li>
																<?php } else { ?>
																<li><a chat_id="<?php echo $oProgram->id; ?>" change_status = 'active' class='chg_status'><i class='icon-gear'></i>Active</a></li>
															<?php } ?>
															<li><a href="javascript:void(0);" chat_id="<?php echo $oProgram->id; ?>" class="editChat"><i class="icon-file-stats"></i> Edit</a></li>
															<li><a href="javascript:void(0);" chat_id="<?php echo $oProgram->id; ?>" class="deleteChat"><i class="icon-file-text2"></i> Delete</a></li>
														</ul>
													</li>
												</ul>
												
											</td>
											
										</tr>
									<?php } endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /dashboard content -->

<!-- /content area -->

<div id="editChatModel" class="modal fade in">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="frmeditChatModel" name="frmeditChatModel">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Chat</h5>
				</div>
				
				<div id="npsTitleEdit">
					<div class="modal-body">
						<p>Chat Name:</p>
						<input class="form-control" id="edit_title" name="title" placeholder="Enter Chat Name" type="text" required="required"><br>
						<div id="editSurveyValidation" style="color:#FF0000;display:none;"></div>
					</div>
					
					<div class="modal-footer">
						<input type="hidden" name="chat_id" id="hidchatid" value="" />
						{{ csrf_field() }}
						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Continue</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- add Chat -->
<div id="addNPSModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" name="frmaddChatModal" id="frmaddChatModal" action="javascript:void();">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Add Chat</h5>
				</div>
				
				<div id="npsTitle">
					<div class="modal-body">
						<p>Chat Name:</p>
						<input class="form-control" id="title" name="title" placeholder="Enter Chat Name" type="text" required="required"><br>
						<div id="addChatValidation" style="color:#FF0000;display:none;"></div>
					</div>
					
					<div class="modal-footer">
						{{ csrf_field() }}
						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Create</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
	
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
		
		$(document).on('click', '#deleteBulkChat', function () {
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
							url: '<?php echo base_url('admin/modules/chat/bulkDeleteChat'); ?>',
							type: "POST",
							data: {bulk_chat_id: val, _token: '{{csrf_token()}}'},
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
		
		$(document).on('click', '#archiveBulkChat', function () {
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
							url: '<?php echo base_url('admin/modules/chat/bulkArchiveChat'); ?>',
							type: "POST",
							data: {bulk_chat_id: val, _token: '{{csrf_token()}}'},
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
		
		$('#addChatSurvery').click(function () {
			$('#addNPSModal').modal();
		});

		$(document).on('click', '#addChatSurveryButtton', function() {
			$('#addChatSurvery').trigger('click');
		});
		
		$('#frmaddChatModal').on('submit', function () {
			
			$('.overlaynew').show();
			var formdata = $("#frmaddChatModal").serialize();
			$.ajax({
				url: '<?php echo base_url('admin/modules/chat/addChat'); ?>',
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						window.location.href = '<?php echo base_url('admin/modules/chat/setup/'); ?>' + data.id;
						} else if (data.status == 'error' && data.type == 'duplicate') {
						$('.overlaynew').hide();
						$("#addChatValidation").html(data.msg).show();
						setTimeout(function () {
							$("#addChatValidation").html("").hide();
						}, 5000);
					}
					
				}
			});
			return false;
		});
		
		$(document).on("click", ".editChat", function () {
			$('.overlaynew').show();
			var chat_id = $(this).attr('chat_id');
			$.ajax({
				url: '<?php echo base_url('admin/modules/chat/getChat'); ?>',
				type: "POST",
				data: {'chat_id': chat_id, _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$("#edit_title").val(data.title);
						$("#hidchatid").val(chat_id);
						$('.overlaynew').hide();
						$("#editChatModel").modal();
						} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		$(document).on("click", ".moveToArchiveChat", function () {
			$('.overlaynew').show();
			var chat_id = $(this).attr('chat_id');
			$.ajax({
				url: '<?php echo base_url('admin/modules/chat/moveToArchiveChat'); ?>',
				type: "POST",
				data: {'chat_id': chat_id, _token: '{{csrf_token()}}'},
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
		
		$('#frmeditChatModel').on('submit', function () {
			$('.overlaynew').show();
			var formdata = $("#frmeditChatModel").serialize();
			$.ajax({
				url: '<?php echo base_url('admin/modules/chat/updateChat'); ?>',
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						window.location.href = '<?php echo base_url('admin/modules/chat/setup/'); ?>' + data.id;
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
		
		   $(document).on('click', '.deleteChat', function () {
                var elem = $(this);

            deleteConfirmationPopup(
            "This record will deleted immediately.<br>You can't undo this action.", 
            function() {
                      $('.overlaynew').show();
					var chat_id = $(elem).attr('chat_id');
					$.ajax({
						url: '<?php echo base_url('admin/modules/chat/deleteChat'); ?>',
						type: "POST",
						data: {chat_id: chat_id, _token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = window.location.href;
							}
						}
					});
            });

        });
		
		$(document).on('click', '.chg_status', function () {
			var chatID = $(this).attr('chat_id');
			var status = $(this).attr('change_status');
			$.ajax({
				url: '<?php echo base_url('admin/modules/chat/changeStatus'); ?>',
				type: "POST",
				data: {'chatID': chatID, 'status': status, _token: '{{csrf_token()}}'},
				dataType: "html",
				success: function (data) {
					window.location.href = '<?php echo base_url("/admin/modules/chat/") ?>';
					}, error: function () {
					alertMessage('Error: Some thing wrong!');
				}
			});
		});
		
		$(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });
		
	});
</script>
@endsection
