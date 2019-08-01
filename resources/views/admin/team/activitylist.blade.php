@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<style type="text/css">
    .tab_list{ margin:0px; padding:0px;}
    .tab_list li {
        list-style: none;
        width: 50%;
        float: left;
    }

    .tooltip_table {
        position: relative; cursor: pointer;
    }

    .tooltip_table .tooltiptext {
        display: none;
        width: 224px;
        background-color: #fff;
        color: #333;
        text-align: left;
        border-radius: 3px;
        padding: 10px 15px;
        position: absolute;
        z-index: 1;
        top: -33px;
        border: 1px solid #cccccc;
        left: 113px;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .tooltiptext::before {
        content: "";
        position: absolute;
        top: 40px;
        left: -9px;
        border-style: solid;
        border-width: 6px 6px 0;
        border-color: #ccc transparent;
        display: block;
        width: 0;
        z-index: 0;
        transform: rotate(90deg);
    }

    .tooltiptext::after {
        content: "";
        position: absolute;
        top: 40px;
        left: -7px;
        border-style: solid;
        border-width: 5px 5px 0;
        border-color: #FFFFFF transparent;
        display: block;
        width: 0;
        z-index: 1;
        transform: rotate(90deg);
    }

    .tooltip_table .tooltiptext strong {
        text-transform: uppercase;
        margin-bottom: 10px;
        display: block;
    }

    .tooltip_table:hover .tooltiptext {
        display: block;
    }
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date.js"></script>

<!-- Content area -->
<div class="content">
    <?php if (!empty($oRoles)): ?>
        <div class="row mb20">
            <div class="col-lg-12 text-right">

                <button id="addTeamMember" type="button" class="btn bl_cust_btn btn-default addTeamMember"><i class="icon-make-group position-left"></i> Add Team Members</button>

            </div>
        </div>
    <?php endif; ?>

    <!-- Dashboard content -->
    <?php if (!empty($oData)): ?>
        <div class="row">
            <div class="col-lg-12">

                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Team Members</h6>
                        <div class="heading-elements">
                            <span class="label bg-success lgraybtn heading-text"><?php echo count($oData); ?> Total Activities</span>
                            <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                                <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                            </button>

                        </div>
                    </div>


                    <div class="table-responsive">
                        <input name="min" id="min" type="hidden">
                        <input name="max" id="max" type="hidden">
                        <table class="table datatable-sorting text-nowrap">
                            <thead>
                                <tr>
                                    <th style="padding-left: 73px!important;" class="col-md-3">Member Details</th>
                                    <th class="col-md-3">Activity Date</th>
                                    <th class="col-md-3">Module Name</th>
                                    <th class="col-md-3">Message</th>
                                    <th class="col-md-3">Details</th>
                                    <th class="col-md-3 text-center" style="width: 20px;">Action</th>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($oData as $oRow){
                                    
                                    if($oRow->event_type == 'brandboost_offsite'){
                                        $eventType = 'Off Site Brandboost';
                                    }else if($oRow->event_type == 'brandboost_onsite'){
                                        $eventType = 'On Site Brandboost';
                                    }else{
                                        $eventType = ucwords(str_replace("_", " ", $oRow->event_type));
                                    }
                                    
                                    
                                    if($oRow->action_name == 'added_brandboost'){
                                        $actionName = 'New Brandboost Added';
                                    }else if($oRow->action_name == 'deleted_brandboost'){
                                        $actionName = 'Brandboost Deleted';
                                    }else if($oRow->action_name == 'added_user'){
                                        $actionName = 'New Subscriber Added to Brandboost';
                                    }else if($oRow->action_name == 'updated_preferrences'){
                                        $actionName = 'Brandboost Preferrences Updated';
                                    }else if($oRow->action_name == 'added_campaign'){
                                        $actionName = 'New Email/SMS added to the Brandboost';
                                    }else if($oRow->action_name == 'deleted_campaign'){
                                        $actionName = 'Email/SMS campaign Deleted From Brandboost';
                                    }else if($oRow->action_name == 'updated_campaign_content'){
                                        $actionName = 'Email/SMS Content Updated of a Brandboost';
                                    }else if($oRow->action_name == 'added_user_import'){
                                        $actionName = 'New Subscriber Imported to a Brandboost';
                                    }else if($oRow->action_name == 'downloaded_user_export'){
                                        $actionName = 'Subscribers was exported from brandboost';
                                    }else if($oRow->action_name == 'user_active'){
                                        $actionName = 'Subscriber was made active of brandboost campaign';
                                    }else if($oRow->action_name == 'user_inactive'){
                                        $actionName = 'Subscriber was made inactive of brandboost campaign';
                                    }else if($oRow->action_name == 'updated_subscriber'){
                                        $actionName = 'Subscriber details was updated of brandboost campaign';
                                    }else if($oRow->action_name == 'deleted_susbcriber'){
                                        $actionName = 'Subscriber was deleted from brandboost campaign';
                                    }else if($oRow->action_name == 'trigger_time_updated'){
                                        $actionName = 'Email/Sms trigger time updated of a brandboost campaign';
                                    }else if($oRow->action_name == 'upgraded_membership'){
                                        $actionName =  'Admin account upgraded';
                                    }else if($oRow->action_name == 'reset_passwored'){
                                        $actionName = 'Admin password changed';
                                    }else if($oRow->action_name == 'profile_updated'){
                                        $actionName = 'Admin profile updated';
                                    }else{
                                        $actionName = $oRow->action_name;
                                    }
                                    
                                    ?>
                                    <tr>
                                        <td>
                                            <div style="vertical-align: top!important;" class="media-left media-middle">
                                                <a href="#">
                                                    <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <?php echo $oRow->firstname . ' ' . $oRow->lastname; ?>
                                                <div class="text-muted text-size-small"><?php echo $oRow->email; ?></div>
                                                <div class="text-muted text-size-small"><?php echo $oRow->mobile; ?></div>
                                                
                                            </div>

                                        </td>
                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oRow->activityTime)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oRow->activityTime)) . ' (' . timeAgo($oRow->activityTime) . ')'; ?></div></td>
                                        <td><?php echo $eventType ?></td>
                                        <td><?php echo ucwords($actionName); ?></td>
                                        <td><a href="javascript:void(0);">Details</a></td>
                                        <td class="text-center">

                                            <ul class="icons-list">
                                                <li class="dropup"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="javascript:void(0);" member_id="<?php echo $oRow->activityID; ?>" class="deleteActivity" brandID="<?php echo $oRow->activityID; ?>"><i class="icon-file-text2"></i> Delete</a></li>
                                                    </ul>
                                                </li>
                                            </ul>

                                        </td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"><?php echo date('m/d/Y', strtotime($oRow->activityTime)); ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div style="margin: 200px 0px 0;" class="text-center">
                    <!--<h5 class="mb-20" >Create Your First Offsite Brand Boost.</h5>-->

                    <h5 class="mb-20">
                        No Activity Found.
                    </h5>
                    

                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- /dashboard content -->

</div>
<!-- /content area -->

<div id="editTeamMemberModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmEditTeamMember" name="frmEditTeamMember">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Team Member</h5>
                </div>
                <div class="modal-body">
					<div class="form-group">
						<label class="control-label col-lg-3">First Name</label>
						<div class="col-lg-9">
							<input class="form-control" id="edit_firstname" name="edit_firstname" placeholder="Enter First Name" type="text" required>
						</div>
					</div>
					<br>
					<br>
					<div class="form-group">
						<label class="control-label col-lg-3">Last Name</label>
						<div class="col-lg-9">
							<input class="form-control" id="edit_lastname" name="edit_lastname" placeholder="Enter Last Name" type="text" required>
						</div>
					</div>
					<br>
					<br>
					<div class="form-group">
						<label class="control-label col-lg-3">Email</label>
						<div class="col-lg-9">
							<input class="form-control" id="edit_email" name="edit_email" placeholder="Enter Email" type="text" required>
						</div>
					</div>
					<br>
					<br>
					<div class="form-group">
						<label class="control-label col-lg-3">Phone</label>
						<div class="col-lg-9">
							<input class="form-control" id="edit_phone" name="edit_phone" placeholder="Enter Phone#" type="text">
						</div>
					</div>
					<br>
					<br>
					<div class="form-group">
						<label class="control-label col-lg-3">Select Role</label>
						<div class="col-lg-9">
							<select name="edit_memberRole" id="edit_memberRole" class="form-control">
								<option>Select Role</option>
								<?php
								if (!empty($oRoles)) {
									foreach ($oRoles as $oRole) {
										?>
										<option value="<?php echo $oRole->id; ?>"><?php echo $oRole->role_name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
					</div>
                </div>
                <hr>
                <div class="modal-footer">
                    <input type="hidden" name="edit_member_id" id="edit_member_id" value="" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- addBrandboost -->
<div id="addTeamMemberModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddTeamMemberModal" id="frmaddTeamMemberModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Team Member</h5>
                </div>

                <div class="modal-body">
										
                    <p>First Name:</p>
                    <input class="form-control" id="title" name="firstname" placeholder="Enter First Name" type="text" required>

                    <p>Last Name:</p>
                    <input class="form-control" id="title" name="lastname" placeholder="Enter Last Name" type="text" required>

                    <p>Email:</p>
                    <input class="form-control" id="title" name="email" placeholder="Enter Email" type="text" required>

                    <p>Phone:</p>
                    <input class="form-control" id="title" name="phone" placeholder="Enter Phone#" type="text">

                    <p>Select Role:</p>
                    <select name="memberRole">
                        <option>Select Role</option>
                        <?php
                        if (!empty($oRoles)) {
                            foreach ($oRoles as $oRole) {
                                ?>
                                <option value="<?php echo $oRole->id; ?>"><?php echo $oRole->role_name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /addBrandboost -->

<script type="text/javascript">

    $(document).ready(function () {
        $('.addTeamMember').click(function () {
            $('#addTeamMemberModal').modal();
        });

        $('#frmaddTeamMemberModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddTeamMemberModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/team/addTeamMember'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        alertMessageAndRedirect("Member created successfully!", window.location.href);
                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();
                        $("#addMemberValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addMemberValidation").html("").hide();
                        }, 5000);
                    }

                }
            });
            return false;
        });

        $(document).on("click", ".editTeamMember", function () {
            $('.overlaynew').show();
            var memberID = $(this).attr('member_id');
            $.ajax({
                url: '<?php echo base_url('admin/team/getTeamMember'); ?>',
                type: "POST",
                data: {'member_id': memberID},
                dataType: "json",
                success: function (data) {
					$('.overlaynew').hide();
                    if (data.status == 'success') {
						var resultData = data.result;
                        $("#edit_firstname").val(resultData.firstname);
                        $("#edit_lastname").val(resultData.lastname);
                        $("#edit_email").val(resultData.email);
                        $("#edit_mobile").val(resultData.mobile);
                        $("#edit_memberRole").val(resultData.team_role_id);
                        $("#edit_member_id").val(resultData.id);
                        $("#editTeamMemberModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error(){
					$('.overlaynew').hide();
				}
            });
        });



        $('#frmEditTeamMember').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmEditTeamMember").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/team/updateTeamMember'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
					$('.overlaynew').hide();
                    if (data.status == 'success') {
                        alertMessageAndRedirect("Team member has been updated successfully!", window.location.href);
                    } else {
						alertMessage('Error: Some thing wrong!');
                    }
                }
            });
            return false;
        });


        $(document).on('click', '.deleteTeamMember', function () {
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
					var memberID = $(elem).attr('member_id');
					$.ajax({
						url: '<?php echo base_url('admin/team/deleteTeamMember'); ?>',
						type: "POST",
						data: {member_id: memberID},
						dataType: "json",
						success: function (data) {
							$('.overlaynew').hide();
							if (data.status == 'success') {
								window.location.href = window.location.href;
							} else {
								alertMessage('Error: Some thing wrong!');
							}
						}
					});
				}
			});
        });

    });

</script>
@endsection  
