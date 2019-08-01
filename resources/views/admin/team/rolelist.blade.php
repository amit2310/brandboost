
@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<!-- Content area -->
<div class="content">

	<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3>Team Roles</h3>
               
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

                <?php if (!empty($oRoles)): ?>
				
					<button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn dark_btn ml20 bl_cust_btn btn-default pDisplayNoActiveSubscription" <?php } else { ?> id="addTeamRole" <?php } ?> type="button" class="btn dark_btn ml20 bl_cust_btn btn-default"><i class="icon-plus3"></i> Add New Role</button>
			    <?php endif; ?>

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

	
    <!-- Dashboard content -->
    
	<div class="row">
		<div class="col-lg-12">
			
			<!-- Marketing campaigns -->
			<div class="panel panel-flat">

				<div class="panel-heading">
                    <h6 class="panel-title"><?php echo count($oRoles) > 0? count($oRoles):''; ?>&nbsp;Team Roles</h6>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>&nbsp; &nbsp;

                        <button type="button" class="btn btn-xs btn-default editRoleList"><i class="icon-pencil position-left"></i> Edit</button>
                        <button id="deleteTeamRoles" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                    </div>
                </div>
				
				
				<div class="panel-body p0">
                <?php if (!empty($oRoles)): ?>
					<table class="table datatable-basic datatable-sorting">
						<thead>
							<tr>
								<th style="display: none;"></th>
								<th style="display: none;"></th>
								<th style="width: 10px!important; display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
								<th class="col-md-6"><i class="icon-atom"></i>Role Name</th>
								<th class="col-md-5"><i class="icon-calendar"></i>Created</th>
								<th class="col-md-1 text-center"><i class="fa fa-dot-circle-o"></i>Action</th>
							</tr>
						</thead>
						
						<tbody>
							<?php foreach ($oRoles as $oRole): ?>
							<tr id="append-<?php echo $oRole->id; ?>" class="selectedClass">
								<td style="display: none;"><?php echo date('m/d/Y', strtotime($oRole->role_created)); ?></td>
								<td style="display: none;"><?php echo $oRole->id; ?></td>
								<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $oRole->id; ?>" ><span class="custmo_checkmark"></span></label></td>
								<td>
									<div style="vertical-align: top!important;" class="media-left media-middle">
										<a href="#">
										<img src="<?php echo base_url(); ?>/admin_new/images/userp.png" class="img-circle img-xs" alt=""></a>
									</div>
									<div class="media-left">
										<?php echo setStringLimit($oRole->role_name); ?>
									</div>
									
								</td>

								<td>
                                    <div class="media-left">
                                        <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oRole->role_created)); ?></a></div>
                                        <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oRole->role_created)); ?></div>
                                    </div>
                                </td>

								<td >
                                    <div class="tdropdown">
                                        <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right width-200">
                                            <li><a href="javascript:void(0);" role_id="<?php echo $oRole->id; ?>" class="managerole"><i class="icon-gear"></i> Manage Permission</a></li>
											<li><a href="javascript:void(0);" role_id="<?php echo $oRole->id; ?>" class="editrole"><i class="icon-pencil"></i> Edit</a></li>
											<li><a href="javascript:void(0);" role_id="<?php echo $oRole->id; ?>" class="deleterole" brandID="<?php //echo $data->id; ?>"><i class="icon-trash"></i> Delete</a></li>
                                        </ul>
                                    </div>


                                </td>

								
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
                        <?php else: ?>
                             <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th class="col-md-6"><i class="icon-atom"></i>Role Name</th>
                                        <th class="col-md-5"><i class="icon-calendar"></i>Created</th>
                                        <th class="col-md-1 text-center"><i class="fa fa-dot-circle-o"></i>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">
                                                           <h5 class="mb-20">
                    Looks Like You Don’t Have Created Any Team Role Yet <img src="<?php echo site_url('assets/images/smiley.png'); ?>"> <br>
                    Lets Create Team Role.
                </h5>
                <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" <?php } else { ?> id="addTeamRole" <?php } ?> class="btn bl_cust_btn btn-default dark_btn ml20 mb40" type="button"><i class="icon-plus3"></i> Add Team Role</button>

                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </td>

                                             <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                           
                                        </tr>
                                    </tbody>
                                </table>

                                 <?php endif; ?>

				</div>
			</div>
		</div>
	</div>
 
	
   
    <!-- /dashboard content -->
	
</div>
<!-- /content area -->

<div id="editRoleModel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditRoleModel" class="form-horizontal" name="frmeditRoleModel">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Team Role</h5>
				</div>
                <div class="modal-body" id="editRoleContent">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label">Role Title</label>
                            <div class="">
                                <input class="form-control" id="edit_title" name="title" placeholder="Enter Role Title" type="text" required><br>
                                <div id="editRoleValidation" style="color:#FF0000;display:none;"></div>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="modal-footer p40">
                    <input type="hidden" name="role_id" id="hidroleid" value="" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="editRolePermissionModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditRolePermissionModel" class="form-horizontal" name="frmeditRolePermissionModel">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Manage Role Permission</h5>
				</div>
                <div class="modal-body" id="display_permission_form">
					
				</div>
                <hr>
                <div class="modal-footer p40">
                    <input type="hidden" name="role_id" id="hidRoleID" value="" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Update</button>
					
				</div>
			</form>
		</div>
	</div>
</div>

<!-- addBrandboost -->
<div id="addTeamRoleModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" name="frmaddTeamRoleModal" id="frmaddTeamRoleModal" action="javascript:void();">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Team Role</h5>
				</div>
				
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Role Title</label>
                                <div class="">
                                    <input class="form-control" id="title" name="title" placeholder="Enter Role Title" type="text" required><br>
                                    <div id="addRoleValidation" style="color:#FF0000;display:none;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				
                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /addBrandboost -->

<script type="text/javascript">
	
    $(document).ready(function () {
        $('#addTeamRole').click(function () {
            $('#addTeamRoleModal').modal();
		});
		
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
		
		$(document).on('click', '#deleteTeamRoles', function () {
			
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
						$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/team/deleteTeamRoles');?>',
							type: "POST",
							data: {multipal_id:val},
							dataType: "json",
							success: function (data) {
								if(data.status == 'success') {
									window.location.href = window.location.href
								}else {
									alertMessage('Error: Some thing wrong!');
									$('.overlaynew').hide();
								}
							}
						});
					}
				});
			}
		});
		
        $('#frmaddTeamRoleModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddTeamRoleModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/team/addRole'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
						} else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addRoleValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addRoleValidation").html("").hide();
						}, 5000);
					}
					
				}
			});
            return false;
		});
		
        $(document).on("click", ".editrole", function () {
            //$('.overlaynew').show();
            var roleID = $(this).attr('role_id');
            $.ajax({
                url: '<?php echo base_url('admin/team/getRole'); ?>',
                type: "POST",
                data: {'role_id': roleID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_title").val(data.title);
                        $("#hidroleid").val(roleID);
                        $('.overlaynew').hide();
                        $("#editRoleModel").modal();
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		
		
        $('#frmeditRoleModel').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmeditRoleModel").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/team/updateRole'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
						} else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editRoleValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editRoleValidation").html("").hide();
						}, 5000);
					}
				}
			});
            return false;
		});
		
		
		
        $(document).on("click", ".managerole", function () {
            $('.overlaynew').show();
            var roleID = $(this).attr('role_id');
            $.ajax({
                url: '<?php echo base_url('admin/team/manageRolePermission'); ?>',
                type: "POST",
                data: {'role_id': roleID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#display_permission_form").html(data.permission_form);
                        $("#hidRoleID").val(roleID);
                        $('.overlaynew').hide();
                        $("#editRolePermissionModel").modal();
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		
        $(document).on("submit", "#frmeditRolePermissionModel", function () {
            $('.overlaynew').show();
            var formdata = $("#frmeditRolePermissionModel").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/team/updateRolePermission'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
						} else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editRoleValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editRoleValidation").html("").hide();
						}, 5000);
					}
				}
			});
            return false;
		});
		
       $(document).on('click', '.deleterole', function () {
             var elem = $(this);

            deleteConfirmationPopup(
            "This record will deleted immediately.<br>You can't undo this action.", 
            function() {
                    $('.overlaynew').show();
					var roleID = $(elem).attr('role_id');
					$.ajax({
						url: '<?php echo base_url('admin/team/deleteRole'); ?>',
						type: "POST",
						data: {role_id: roleID,_token: '{{csrf_token()}}'},
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
		
        $(document).on('click', '.viewECode', function () {
            var brandID = $(this).attr('brandID');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/getBBECode'); ?>',
                type: "POST",
                data: {brandboost_id: brandID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var embeddedCode = data.result;
                        $('#embeddedCode').html(embeddedCode);
                        $("#viewEModel").modal();
					}
				}
			});
		});
		
        $(document).on('change', '.choosePermission', function () {
            var selectedText = $(this).attr('chkText');
            if (selectedText == 'All Access') {
                var selectedVal = $(this).val();
                var selectedPerm = $("select[name='permission_val_" + selectedVal + "']").val();
				
                if (this.checked) {
                    $('.choosePermissionVal').each(function () {
                        $(this).val(selectedPerm);
					});
                    $('.choosePermission').each(function () {
                        this.checked = true;
					});
					} else {
                    $('.choosePermission').each(function () {
                        this.checked = false;
					});
				}
				
				
			}
		});
		
		
        $(document).on('change', '.choosePermissionVal', function () {
            var selectedText = $(this).attr('chkText');
            if (selectedText == 'All Access') {
                var selectedVal = $(this).val();
                permID = $(this).attr("name");
                permID = permID.replace('permission_val_', '');
                $(".choosePermission").each(function () {
                    if (($(this).prop("checked") == true) && ($(this).val() == permID)) {
                        $('.choosePermissionVal').each(function () {
                            $(this).val(selectedVal);
						});
					}
				});
				
			}
		});
		
		$(document).on('click', '.editRoleList', function () {
            $('.editAction').toggle();
        });
		
		
	});
	
	
	
	
</script>

@endsection  