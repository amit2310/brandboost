@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<!-- Content area -->
<div class="content">

    <div class="row mb20">
        <div class="col-lg-12 text-right">

            <button data-toggle="modal" data-target="#userLevelAdd" type="button" class="btn bl_cust_btn btn-default"><i class="icon-make-group position-left"></i> ADD USER </button>

        </div>
    </div>

    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">

            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Users Management</h6>
                    <div class="heading-elements">
                        <span class="label bg-success heading-text"><?php echo count($usersdata); ?> users</span>
                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <div class="custom_action_box">
                        <button id="deleteUsersBtn" class="btn btn-danger btn-xs lgrey">Delete</button>
                    </div>
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table text-nowrap datatable-sorting">
                        <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ></th>
                                <th class="col-md-3">Name</th>
                                <th class="col-md-3">Email</th>
                                <th class="col-md-2">Date Created</th>
                                <th class="col-md-2 text-center">Current Status</th>
                                <th class="text-center" style="width: 20px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $output = '';
                            if (count($usersdata) > 0) {
                                $inc = 1;
                                foreach ($usersdata as $data) {
                                    //pre($data);
                                    if($data->firstname!='' && $data->lastname!='')
                                    {
                                    $profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);

                                    $output .= '<tr id="append-' . $data->id . '" class="selectedClass">
										<td style="display: none;">' . date('m/d/Y', strtotime($data->created)) . '</td>
										<td style="display: none;">' . $data->id . '</td>
										<td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk' . $data->id . '" value="' . $data->id . '" ></td>
										<td>
										<div class="media-left media-middle">
										<a href="#">';
                                    $output .= '<img src="' . $profileImg . '" class="img-circle img-xs" alt=""></a>
										</div>
										<div class="media-left">
										<div class="text-default text-semibold"><a target="_blank" href="' . base_url('admin/profile/' . $data->id) . '" >' . $data->firstname . ' ' . $data->lastname . '</a></div>
										<div class="text-muted text-size-small">';

                                    $userRole = $data->user_role;
                                    if ($userRole == 1) {
                                        $roleType = 'Admin';
                                    } else if ($userRole == 2) {
                                        $roleType = 'User';
                                    } else if ($userRole == 3) {
                                        $roleType = 'Customer';
                                    } else {
                                        $roleType = '';
                                    }
                                    if (!empty($data->description)) {
                                        $output .= $roleType . ' ( ' . $data->description . ' ) ';
                                    } else {
                                        $output .= $roleType;
                                    }


                                    $output .= '</div>
										</div>
										</td>
										<td><a href="mailto:' . $data->email . '">' . $data->email . '</a></td>
										<td><div class="text-semibold">' . date('F d, Y', strtotime($data->created)) . '</div><div class="text-muted text-size-small">' . date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')</div></td>
										<td class="text-center">';

                                    if ($data->status == 0) {
                                        $output .= '<span class="label bg-danger">Inactive</span>';
                                    } else {
                                        $output .= '<span class="label bg-success">Active</span>';
                                    }

                                    $output .= '</td>
										
										<td class="text-center">
										<ul class="icons-list">';
                                    if ($inc > 5) {
                                        $output .= '  <li class="dropup">';
                                    } else {
                                        $output .= '  <li class="dropdown">';
                                    }
                                    $output .= ' 
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">';


                                    if ($data->status == 1) {
                                        $output .= "<li><a userId='" . $data->id . "' change_status = '0' class='chg_status'><i class='icon-gear'></i>Inactive</a></li>";
                                    } else {
                                        $output .= "<li><a userId='" . $data->id . "' change_status = '1' class='chg_status'><i class='icon-gear'></i>Active</a></li>";
                                    }

                                    $output .= '<li><a href="javascript:void(0);" class="userEdit" userID="' . $data->id . '"><i class="icon-gear"></i> Edit</a></li>
                                        <li><a href="javascript:void(0);" class="userDelete" userID="' . $data->id . '" contactID="' . $data->infusion_user_id . '"><i class="icon-cross2"></i> Delete</a></li>';
                                    if ($userRole != 2) {
                                        $output .= '<li><a href="' . base_url('admin/settings/twillo_log/' . $data->id) . '"><i class="icon-file-stats"></i> Twilio Stats</a></li>
											<li><a href="' . base_url('admin/users/sendgriddata/' . $data->id) . '"><i class="icon-file-stats"></i> Send Grid Stats</a></li>';
                                    }
                                    if ($isAdmin) {
                                        $output .= '<li><a href="javascript:void(0);" class="addManualCredit" id="' . base64_url_encode($data->id) . '"><i class="icon-file-stats"></i> Add Credits</a></li>';
                                    }
                                    $output .= '</ul>
										</li>
										</ul>
										</td>';

                                    $output .= '</tr>';
                                    $inc++;
                                }
                            }
                        }
                            echo $output;
                            ?>
                        </tbody>
                    </table>
                </div>


            </div>
            <!-- <div align="right" id="pagination_link"></div> -->
        </div>
    </div>


</div>
<!-- /content area -->



<div id="userLevelEdit" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="EditUsers" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit User</h5>
                </div>

                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo Session::get('error_message'); ?>
                        <?php //echo validation_errors(); ?></div>

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

                    <div class="form-group" id="emailDiv">
                        <label class="control-label  col-lg-3">Email</label>
                        <div class="col-lg-9">
                            <input name="email" id="e_email" class="form-control" value="" type="text" required>
                            <div id="msgEmail"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Phone</label>
                        <div class="col-lg-9">
                            <input name="phone" id="e_phone" class="form-control" value="" type="text" required>
                        </div>
                    </div>

                    <div class="form-group mb0">
                        <label class="control-label col-lg-3">Zip Code</label>
                        <div class="col-lg-9">
                            <input name="zip" id="e_zip" class="form-control" value="" type="text" required>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <input type="hidden" name="userID" id="e_userID" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="addButton" class="btn btn-primary"><i class="icon-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


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

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo Session::get('error_message'); ?>
                        <?php //echo validation_errors(); ?></div>

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

@include("admin.modals.credits.add_credits")
<script>

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

        $(document).on('click', '#deleteUsersBtn', function () {
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
                                    url: '<?php echo base_url('admin/users/deleteUsers'); ?>',
                                    type: "POST",
                                    data: {multipal_record_id: val,_token: '{{csrf_token()}}'},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = window.location.href;
                                        } else {
                                            $('.overlaynew').hide();
                                            alertMessage('Error: Some thing wrong!');
                                        }
                                    },
                                    error: function () {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                });
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
                    data: {emailID: sEmail,_token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            $('#emailDiv').addClass('has-error has-feedback');
                            $("#msgEmail").show();
                            $("#msgEmail").html('Email already exist.');
                            $('#addButton').prop("disabled", true);
                        } else {

                            $('#emailDiv').removeClass('has-error has-feedback');
                            $("#msgEmail").hide();
                            $("#msgEmail").html('');
                            $('#addButton').prop("disabled", false);
                        }
                    }
                });
            }
        });

        $(document).on('click', '.userDelete', function () {
            var userID = $(this).attr('userID');
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
                                url: '<?php echo base_url('admin/users/user_delete'); ?>',
                                type: "POST",
                                data: {userID: userID,_token: '{{csrf_token()}}'},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    } else {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                },
                                error: function () {
                                    $('.overlaynew').hide();
                                    alertMessage('Error: Some thing wrong!');
                                }
                            });
                        }
                    });
        });

        $(document).on('click', '.userEdit', function () {

            var userID = $(this).attr('userID');
            $.ajax({
                url: '<?php echo base_url('admin/users/getUserById'); ?>',
                type: "POST",
                data: {userID: userID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {

                        var mem = data.result[0];

                        $('#e_firstname').val(mem.firstname);
                        $('#e_email').val(mem.email);
                        $('#e_lastname').val(mem.lastname);
                        $('#e_phone').val(mem.mobile);
                        $('#e_zip').val(mem.zip_code);
                        $('#e_userID').val(mem.id);
                        //$('#twilio_status').val(mem.twilio_subaccount_status);
                        //$('#infusion_user_id').val(mem.infusion_user_id);

                        $("#userLevelEdit").modal();

                }
            });
        });

        $("#updateUsers").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            formData.append('_token','{{csrf_token()}}');
            var twilioStatus = $('#e_twilio_status').val();
            if (twilioStatus == 'suspended' || twilioStatus == 'closed') {
                var conf = confirm("Do you want to delete long form SMS number?");
            } else {
                var conf = true;
            }
            if (conf == true) {
                $.ajax({
                    url: '<?php echo base_url('admin/users/user_update'); ?>',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect('User has been update successfully.', window.location.href);
                        } else {

                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });


        $("#addUsers").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#addButton').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/users/user_add'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        alertMessageAndRedirect('User has been add successfully.', window.location.href);

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
        
        

        $(document).on('click', '.chg_status', function () {

            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var userId = $(this).attr('userId');

            $.ajax({
                url: '<?php echo base_url('admin/users/update_status'); ?>',
                type: "POST",
                data: {status: status, user_id: userId,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        alertMessageAndRedirect('User has been update successfully.', window.location.href);

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

    });
</script>	
@endsection	

