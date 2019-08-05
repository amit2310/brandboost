<style>
    .panel-body p{ font-size: 16px;}

    .highlighted { color:#008000;font-size:15px !important;}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date.js"></script>
<!-- Content area -->

<?php
$totalEmailSent = $totalSmsSent = 0;
if (!empty($oTotalReferralSent)) {

    foreach ($oTotalReferralSent as $sentCount) {

        if ($sentCount->campaign_type == 'email') {
            $totalEmailSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
        }

        if ($sentCount->campaign_type == 'sms') {
            $totalSmsSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
        }
    }
}
$totalDelivered = $totalOpened = $totalProcessed = $totalClicked = 0;
if (!empty($oTotalReferralTwillio)) {
    foreach ($oTotalReferralTwillio as $twilliRec) {
        if ($twilliRec->event_name == 'delivered') {
            $totalDelivered = $twilliRec->totalCount;
        } else if ($twilliRec->event_name == 'open') {
            $totalOpened = $twilliRec->totalCount;
        } else if ($twilliRec->event_name == 'processed') {
            $totalProcessed = $twilliRec->totalCount;
        } else if ($twilliRec->event_name == 'clicked') {
            $totalClicked = $twilliRec->totalCount;
        }
    }
}
?>
<div class="content">

    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Referral Report</h6>
                    <div class="heading-elements">
                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="panel-body">
                    <p><strong>Referral email sent: </strong><?php echo $totalEmailSent; ?></p>
                    <p><strong>Referral sms sent: </strong><?php echo $totalSmsSent; ?></p>
                    <p><strong>Opens :</strong> <?php echo $totalOpened; ?></p>
                    <p><strong>Clicks :</strong> <?php echo $totalClicked; ?></p>
                    <p><strong>Referral Link(Landing Page) Visits: </strong><?php echo (count($oRefVisits)) ? count($oRefVisits) : 0; ?></p>
                    <p><strong>Purchases by referred customer: </strong>$<?php echo ($referredAmount) ? $referredAmount : 0; ?></p>
                    <p><strong>Total Untracked Sales: </strong><?php echo (count($oUntrackedPurchased)) ? count($oUntrackedPurchased) : 0; ?></p>
                    <p><strong>Total Untracked Sales Amount: </strong>$<?php echo ($untrackedAmount) ? $untrackedAmount : 0; ?></p>

                </div>

                <div class="table-responsive">
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table text-nowrap datatable-sorting" id="allContact">
                        <thead>
                            <tr>
                                <th class="col-md-3">Referred Friend</th>
                                <th class="col-md-3">Referrer</th>
                                <th class="col-md-3">Amount</th>
                                <th class="col-md-3">Currency</th>
                                <th class="col-md-2">Date</th>
                                <th class="text-center" style="width: 20px;">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $inc = 1;
                            foreach ($oRefPurchased as $data) {
                                //pre($data);
                                //$profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);
                                ?>
                                <tr>
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

                                    <td>
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->aff_firstname; ?> <?php echo $data->aff_lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->aff_mobile; ?></div>
                                        </div>
                                    </td>

                                    <td><?php echo $data->currency; ?><?php echo $data->amount; ?></td>
                                    <td><?php echo $data->currency; ?></td>
                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                    <td class="text-center">

                                    </td>


                                </tr>
                                <?php $inc++;
                            }
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

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

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

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

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
    /*$(document).ready(function(){
     
     var sort_type_element = 'DESC';
     var sort_by_element = 'id';
     
     $(document).on("click", ".sortingAction", function(event){
     
     $('.sortingAction').removeClass('sorting');
     $('.sortingAction').removeClass('sorting_desc');
     $('.sortingAction').removeClass('sorting_asc');
     sort_by_element = $(this).attr('sort_by_element');
     sort_type_element = $(this).attr('sort_type_element');
     
     load_user_data(1, sort_by_element, sort_type_element);
     
     var newClass = sort_type_element == 'ASC' ? 'sorting_desc' : 'sorting_asc';
     var newSort = sort_type_element == 'ASC' ? 'DESC' : 'ASC';
     $('.sortingAction').addClass('sorting');
     $(this).removeClass('sorting');
     $(this).addClass(newClass);
     $(this).attr('sort_type_element', newSort);
     
     });
     
     function load_user_data(page, sortby, sort_type)
     {
     $.ajax({
     url:"<?php echo base_url(); ?>ajax_pagination/user_pagination/"+page,
     data: {sortby: sortby, sort_type: sort_type},
     method:"GET",
     dataType:"json",
     success:function(data)
     {
     $('#user_table').html(data.user_table);
     $('#pagination_link').html(data.pagination_link);
     }
     });
     }
     
     load_user_data(1, 'id', 'DESC');
     
     $(document).on("click", ".pagination li a", function(event){
     event.preventDefault();
     var page = $(this).data("ci-pagination-page");
     load_user_data(page, sort_by_element, sort_type_element);
     });
     
     });*/


    $(document).ready(function () {

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

            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this user!");
            if (conf == true) {

                var userID = $(this).attr('userID');
                var contactID = $(this).attr('contactID');
                $.ajax({
                    url: '<?php echo base_url('admin/users/user_delete'); ?>',
                    type: "POST",
                    data: {userID: userID, contactID: contactID},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect('User has been delete successfully.', window.location.href);

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

        $(document).on('click', '.userEdit', function () {

            var userID = $(this).attr('userID');
            $.ajax({
                url: '<?php echo base_url('admin/users/getUserById'); ?>',
                type: "POST",
                data: {userID: userID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var mem = data.result[0];

                        $('#e_firstname').val(mem.firstname);
                        $('#e_lastname').val(mem.lastname);
                        $('#e_phone').val(mem.mobile);
                        $('#e_zip').val(mem.zip_code);
                        $('#e_userID').val(mem.id);
                        $('#e_twilio_status').val(mem.twilio_subaccount_status);
                        $('#e_infusion_user_id').val(mem.infusion_user_id);

                        $("#userLevelEdit").modal();

                    } else {

                    }
                }
            });
        });

        $("#updateUsers").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
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
                data: {status: status, user_id: userId},
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
