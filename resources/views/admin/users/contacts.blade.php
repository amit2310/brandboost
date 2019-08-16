@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date_new.js"></script>
<!-- Content area -->
<div class="content">
	
	<!-- Dashboard content -->
	<div class="row">
		<div class="col-lg-12">
			<!-- Marketing campaigns -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Contacts Management</h6>
					<div class="heading-elements">
						<span class="label bg-success lgraybtn heading-text"><?php echo count($usersdata); ?> users</span>
						<button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
							<i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
						</button>
					</div>
				</div>
				
				<div class="table-responsive">
					<input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
					<div class="custom_action_box">
						<button id="deleteContactsBtn" class="btn btn-danger btn-xs lgrey">Delete</button>
					</div>
					<table class="table text-nowrap datatable-sorting" id="allContact">
						<thead>
							<tr>
								<th style="display: none;"></th>
								<th style="display: none;"></th>
								<th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ></th>
								<th class="col-md-2">Contact Details</th>
								<th class="col-md-2">Date Created</th>
								<th class="col-md-2">Last Contacted</th>
								<th class="col-md-1 text-center">Source</th>
								<th class="col-md-2 text-center">Added From</th>
								<th class="col-md-2">Current Status</th>
								<th class="text-center" style="width: 20px;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								
								$inc = 1;
								foreach ($usersdata as $data) {
									//pre($data);
									//$profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);
								?>
								<tr id="append-<?php echo $data->id; ?>" class="selectedClass">
									<td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
									<td style="display: none;"><?php echo $data->id; ?></td>
									<td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows"  value="<?php echo $data->id; ?>" ></td>
									<td>			
										<div style="vertical-align: top!important;" class="media-left media-middle">
											<a href="#">
												<img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
											</a>
										</div>
										<div class="media-left">
											<a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
											<div class="text-muted text-size-small"><?php echo $data->email; ?></div>
											<div class="text-muted text-size-small"><?php echo $data->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->mobile; ?></div>
										</div>
									</td>
									
									<td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
									
									<td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
									<td> 
										<div style="padding-right: 10px!important;" class="media-left media-middle">
											
											<img src="<?php echo base_url(); ?>/assets/images/email_icon2.png" class="img-circle img-xs" alt="">
											
										</div>
										<div class="media-left media-middle">
											<?php echo 'Email'; ?>
										</div>
									</td>
									<td class="text-center"><span style="color:#999999">No Data</span></td>
									<td><?php echo $data->status == 1 ? '<span class="label bg-success">ACTIVE</span>' : '<span class="label bg-danger">INACTIVE</span>'; ?></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													
													<li><a style="cursor: pointer;" class="deleteContact" delId="<?php echo $data->id; ?>" ><i class="icon-gear"></i> Delete</a></li>
													
												</ul>
											</li>
										</ul>
									</td>
								</tr>
							<?php $inc++; } ?>
						</tbody>
					</table>
				</div>
				
				
			</div>
			<!-- <div align="right" id="pagination_link"></div> -->
		</div>
	</div>
	
	
</div>
<!-- /content area -->



<!-- =======================add users popup========================= -->

<div id="userLevelAdd" class="modal fade">
	<div class="modal-dialog">
		
		<div class="modal-content">
			<form method="post" class="form-horizontal" id="addUsers" action="javascript:void();">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Users</h5>
				</div>
				
				<div class="modal-body">
					
					
					
					<div class="form-group">
						<label class="control-label col-lg-3">First Name</label>
						<div class="col-lg-9">
							<input name="firstname" id="firstname" class="form-control" type="text" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-lg-3">Last Name</label>
						<div class="col-lg-9">
							<input name="lastname" id="lastname" class="form-control" value="" type="text" required>
						</div>
					</div>
					
					<div class="form-group" id="emailDiv">
						<label class="control-label  col-lg-3">Email</label>
						<div class="col-lg-9">
							<input name="email" id="email" class="form-control" value="" type="text" required>
							<div id="msgEmail"></div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-lg-3">Phone</label>
						<div class="col-lg-9">
							<input name="phone" id="phone" class="form-control" value="" type="text" required>
						</div>
					</div>
					
					<div class="form-group mb0">
						<label class="control-label col-lg-3">Zip Code</label>
						<div class="col-lg-9">
							<input name="zip" id="zip" class="form-control" value="" type="text" required>
						</div>
					</div>
					
					
				</div>
				
				<div class="modal-footer">
					<input type="hidden" name="userID" id="userID" value="">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
					<button type="submit" id="addButton" class="btn btn-primary"><i class="icon-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- =======================edit users popup========================= -->

<div id="userLevelEdit" class="modal fade">
	<div class="modal-dialog">
		
		<div class="modal-content">
			<form method="post" class="form-horizontal" id="updateUsers" action="javascript:void();">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Users</h5>
				</div>
				<div class="modal-body">
					
					
					
					<div class="form-group">
						<label class="control-label col-lg-3">First Name</label>
						<div class="col-lg-9">
							<input name="firstname" id="e_firstname" class="form-control" type="text" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-lg-3">Last Name</label>
						<div class="col-lg-9">
							<input name="lastname" id="e_lastname" class="form-control" value="" type="text" required>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-lg-3">Phone</label>
						<div class="col-lg-9">
							<input name="phone" id="e_phone" class="form-control" value="" type="text" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-lg-3">Zip Code</label>
						<div class="col-lg-9">
							<input name="zip" id="e_zip" class="form-control" value="" type="text" required>
						</div>
					</div>
					
					<div class="form-group mb0">
						<label class="control-label col-lg-3">Twilio Status</label>
						<div class="col-lg-9">
							<select name="e_twilio_status" id="e_twilio_status" class="form-control">
								<option value="">Select Twilio Status Type</option>
								<option value="active">Active</option>
								<option value="suspended">Suspend</option>
								<option value="closed">Disable</option>
							</select>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<input type="hidden" name="userID" id="e_userID" value="">
					<input type="hidden" name="e_infusion_user_id" id="e_infusion_user_id" value="">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
					<button type="submit" id="updateButton" class="btn btn-primary"><i class="icon-check"></i> Update</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
		
	$(document).ready(function(){
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

        $(document).on('click', '#deleteContactsBtn', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {
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
						/*$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/users/deleteUsersContact'); ?>',
							type: "POST",
							data: {multipal_record_id: val},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = window.location.href;
								}else{
									$('.overlaynew').hide();
									alertMessage('Error: Some thing wrong!');
								}
							}
						});*/
					}
				});
            }
        });

        $(document).on('click',".deleteContact", function() {
        	var delId = $(this).attr('delId');
        	var val = [delId];
        	if (val.length === 0) {
                alert('Please select a row.')
            } else {
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
						/*$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/users/deleteUsersContact'); ?>',
							type: "POST",
							data: {multipal_record_id: val},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = window.location.href;
								}else{
									$('.overlaynew').hide();
									alertMessage('Error: Some thing wrong!');
								}
							}
						});*/
					}
				});
            }
        	
        });
		
		$("#email").on("keyup", function () {
			var sEmail = $("#email").val();
			if (sEmail != '') {
				$.ajax({
					url: "<?php echo base_url('admin/users/checkEmailExist'); ?>",
					type: "POST",
					data: {emailID: sEmail},
					dataType: "json",
					success: function (data) {
						
						if (data.status == 'success') {
							
							$('#emailDiv').addClass('has-error has-feedback');
							$("#msgEmail").show();
							$("#msgEmail").html('Email already exist.');
							$('#addButton').prop( "disabled", true );
							} else {
							
							$('#emailDiv').removeClass('has-error has-feedback');
							$("#msgEmail").hide();
							$("#msgEmail").html('');
							$('#addButton').prop( "disabled", false );
						}
					}
				});
			}
		});
		
		$(document).on('click' , '.userDelete', function(){
			
			$('.overlaynew').show();
			var conf = confirm("Are you sure? You want to delete this user!");
			if(conf == true){
				
				var userID = $(this).attr('userID');
				var contactID = $(this).attr('contactID');
				$.ajax({
					url: '<?php echo base_url('admin/users/user_delete');?>',
					type: "POST",
					data: { userID:userID, contactID:contactID },
					dataType: "json",
					success: function (data) {
						
						if(data.status == 'success'){
							
							alertMessageAndRedirect('User has been delete successfully.', window.location.href);
							
							}else{
							
							alertMessage('Error: Some thing wrong!');
							$('.overlaynew').hide();
						}
					}
				});
			}
			else{
				$('.overlaynew').hide();
			}
			
		});
		
		$(document).on('click', '.userEdit', function(){
			
			var userID = $(this).attr('userID');
			$.ajax({
				url: '<?php echo base_url('admin/users/getUserById');?>',
				type: "POST",
				data: { userID:userID },
				dataType: "json",
				success: function (data) {
					
					if(data.status == 'success'){
						var mem = data.result[0];
						
						$('#e_firstname').val(mem.firstname);
						$('#e_lastname').val(mem.lastname);
						$('#e_phone').val(mem.mobile);
						$('#e_zip').val(mem.zip_code);
						$('#e_userID').val(mem.id);
						$('#e_twilio_status').val(mem.twilio_subaccount_status);
						$('#e_infusion_user_id').val(mem.infusion_user_id);
						
						$("#userLevelEdit").modal();
						
						}else{
						
					}
				}
			});
		});
		
		$("#updateUsers").submit(function () {
			
			$('.overlaynew').show();
			var formData = new FormData($(this)[0]);
			var twilioStatus = $('#e_twilio_status').val();
			if(twilioStatus == 'suspended' || twilioStatus == 'closed'){
				var conf = confirm("Do you want to delete long form SMS number?");
				}else{
				var conf = true;
			}
			if(conf == true){
				$.ajax({
					url: '<?php echo base_url('admin/users/user_update');?>',
					type: "POST",
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					success: function (data) {
						
						if(data.status == 'success'){
							
							alertMessageAndRedirect('User has been update successfully.', window.location.href);
							}else{
							
							alertMessage('Error: Some thing wrong!');
							$('.overlaynew').hide();
						}
					}
				});
			}
			else{
				$('.overlaynew').hide();
			}
		});
		
		
		$("#addUsers").submit(function () {
			
			$('.overlaynew').show();
			var formData = new FormData($(this)[0]);
			$('#addButton').prop( "disabled", true );
			$.ajax({
				url: '<?php echo base_url('admin/users/user_add'); ?>',
				type: "POST",
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (data) {
					
					if(data.status == 'success'){
						
						alertMessageAndRedirect('User has been add successfully.', window.location.href);
						
						}else{
						
						alertMessage('Error: Some thing wrong!');
						$('.overlaynew').hide();
					}
				}
			});
		});
		
		$(document).on('click', '.chg_status', function(){
			
			$('.overlaynew').show();
			var status = $(this).attr('change_status');
			var userId = $(this).attr('userId');
			
			$.ajax({
				url: '<?php echo base_url('admin/users/update_status');?>',
				type: "POST",
				data: {status:status, user_id:userId},
				dataType: "json",
				success: function (data) {
					
					if(data.status == 'success'){
						
						alertMessageAndRedirect('User has been update successfully.', window.location.href);
						
						}else{
						
						alertMessage('Error: Some thing wrong!');
						$('.overlaynew').hide();
					}
				}
			});
		});
		
	});
</script>	
@endsection	
