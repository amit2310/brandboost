<?php
list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
?>

<!-- Dashboard content -->
<div class="row">
    <div class="col-md-12">
        <div style="margin: 0;" class="panel panel-flat">
            <div class="panel-heading"> <span class="pull-left">
                    <h6 class="panel-title"><?php echo count($subscribersData); ?> Contacts</h6>
                </span>
                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                        <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                    </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $inc = 1;
                        foreach ($subscribersData as $oContact) {
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
                                        <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo $oContact->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oContact->mobile; ?></a></div>
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


<?php /* ?><div class="row">
  <div class="col-lg-12">
  <!-- Marketing campaigns -->
  <div class="panel panel-flat" style="border: none; box-shadow: none!important; margin: 0 -20px;">
  <div class="panel-heading">
  <h6 class="panel-title">Subscriber Management</h6>
  <div class="heading-elements">
  <span class="label bg-success heading-text"><?php echo count($subscribersData); ?> Subscriber</span>
  <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
  <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
  </button>
  </div>
  </div>

  <div style="padding: 0 20px;" class="table-responsive">
  <div class="custom_action_box-list">
  <button id="deleteButtonBrandboostOnlineSub" class="btn btn-danger btn-xs lgrey">Delete</button> &nbsp;
  <!-- <button id="archiveButtonBrandboostOnline" class="btn btn-danger btn-xs lgrey">Move To Archive</button> -->
  </div>
  <table class="table text-nowrap datatable-sorting">
  <thead>
  <tr>
  <th style="display: none;"></th>
  <th style="display: none;"></th>
  <th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkSub-list" ></th>
  <th class="col-md-4">Contact Detail</th>
  <th class="col-md-4">Date Created</th>
  <th class="col-md-4 text-center">Status</th>
  <th class="text-center" style="width: 20px;">Action </th>

  </tr>
  </thead>
  <tbody>

  <?php
  $output = '';
  if (count($subscribersData) > 0) {

  foreach ($subscribersData as $data) {
  ?>
  <tr id="append-sub-<?php echo $data->id; ?>" class="selectedClass-list">
  <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
  <td style="display: none;"><?php echo $data->id; ?></td>
  <td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows-list"  value="<?php echo $data->id; ?>" ></td>

  <td>
  <div style="vertical-align: top!important;" class="media-left media-middle">

  <img src="<?php echo base_url(); ?>/admin_new/images/userp.png" class="img-circle img-xs" alt="">

  </div>
  <div class="media-left">
  <a href="javascript:void(0)" class="text-default text-semibold editSubscriber" subscriberid="<?php echo $data->id; ?>"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
  <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
  <div class="text-muted text-size-small"><?php echo ($data->phone) ? $data->phone : 'NA'; ?></div>
  </div>
  </td>

  <!-- <td><span class="text-default text-semibold"><?php echo $data->firstname . ' ' . $data->lastname; ?></td> -->
  <!-- <td><?php echo $data->email; ?></td> -->
  <!-- <td><?php echo phoneNoFormat($data->phone); ?></td> -->
  <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($data->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?> </div></td>
  <td class="text-center">
  <?php if ($data->status == 1) { ?><span class="label bg-success">ACTIVE</span> <?php } else {
  ?><span class="label bg-danger">INACTIVE</span><?php } ?>
  </td>
  <td class="text-center">
  <ul class="icons-list">';
  <li>
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
  <ul class="dropdown-menu dropdown-menu-right">
  <?php
  if ($canWrite) {
  ?>
  <!--                                                            <li><a class="unSubscribeUAC" href="javascript:void(0);" title="Unsubscribe For All Campaigns" subscriberemail="<?php echo $data->email; ?>" subscriberid="<?php echo $data->id; ?>"><i class="icon-gear"></i> Inactive For All</a></li>-->
  <?php
  if ($data->status == 1) {
  ?><li><a subscriberId='<?php echo $data->id; ?>' change_status = '0' class='chg_status'><i class='icon-file-locked'></i> Inacive</a></li>
  <?php
  } else {
  ?>
  <li><a  subscriberId='<?php echo $data->id; ?>' change_status = '1' class='chg_status'><i class='icon-file-locked'></i> Active</a></li>
  <?php
  }
  ?>
  <li><a href="javascript:void(0);" class="editSubscriber" subscriberid="<?php echo $data->id; ?>"><i class="icon-gear"></i> Edit</a></li>

  <li><a class="deleteSubscriber" href="javascript:void(0);" subscriberid="<?php echo $data->id; ?>"><i class="icon-trash"></i> Delete</a></li>
  <?php
  }
  ?></ul>
  </li>
  </ul>
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

  <!-- /marketing campaigns -->
  </div>
  </div> <?php */ ?>
<!-- /dashboard content -->


<?php /* if ($display != 'popup'): ?>
  <div id="addSubscriber" class="modal fade">
  <div class="modal-dialog">

  <div class="modal-content">
  <form method="post" class="form-horizontal" id="addSubscriberDataForm" >
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Subscriber</h5>
  </div>
  <div class="modal-body">

  <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
  <?php echo validation_errors(); ?></div>

  <div class="col-md-12">

  <div class="form-group">
  <label class="control-label">First Name</label>
  <div class="">
  <input name="firstname" id="firstname" class="form-control" type="text" required>
  </div>
  </div>

  <div class="form-group">
  <label class="control-label">Last Name</label>
  <div class="">
  <input name="lastname" id="lastname" class="form-control" value="" type="text" required>
  </div>
  </div>


  <div class="form-group">
  <label class="control-label">Email</label>
  <div class="">
  <input name="email" id="email" value="" class="form-control" type="text" required>
  </div>
  </div>

  <div class="form-group">
  <label class="control-label">Phone</label>
  <div class="">
  <input name="phone" id="phone" value="" class="form-control" type="text">
  </div>
  </div>

  </div>
  </div>
  <div class="modal-footer">
  <input type="hidden" name="listId" id="listId" value="<?php echo $list_id; ?>">
  <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
  <button type="submit" id="addButton" class="btn btn-primary"><i class="icon-check"></i> Add</button>
  </div>
  </form>
  </div>
  </div>
  </div>

  <div id="editSubscriberModal" class="modal fade">
  <div class="modal-dialog">

  <div class="modal-content">
  <form method="post" class="form-horizontal" id="updateSubscriberDataForm" >
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Subscriber</h5>
  </div>
  <div class="modal-body">

  <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
  <?php echo validation_errors(); ?></div>

  <div class="col-md-12">

  <div class="form-group">
  <label class="control-label">First Name</label>
  <div>
  <input name="edit_firstname" id="edit_firstname" class="form-control" type="text" required>
  </div>
  </div>

  <div class="form-group">
  <label class="control-label">Last Name</label>
  <div>
  <input name="edit_lastname" id="edit_lastname" class="form-control" value="" type="text" required>
  </div>
  </div>


  <div class="form-group">
  <label class="control-label">Email</label>
  <div>
  <input name="edit_email" id="edit_email" value="" class="form-control" type="text" required>
  </div>
  </div>

  <div class="form-group">
  <label class="control-label">Phone</label>
  <div>
  <input name="edit_phone" id="edit_phone" value="" class="form-control" type="text" required>
  </div>
  </div>

  </div>

  </div>
  <div class="modal-footer">
  <input type="hidden" name="edit_subscriberID" id="edit_subscriberID" value="">
  <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
  <button type="submit" id="updateButton" class="btn btn-primary"><i class="icon-check"></i> Update</button>
  </div>
  </form>
  </div>
  </div>
  </div>


  <div id="importCSV" class="modal modalpopup fade" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
  <form method="post" class="form-horizontal" action="{{ base_url() }}admin/brandboost/importcsv" enctype="multipart/form-data">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Import Subscriber CSV</h5>
  </div>
  <div class="modal-body">

  <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
  <?php echo validation_errors(); ?></div>

  <div class="form-group">
  <label class="control-label col-lg-3">Import CSV</label>
  <div class="col-lg-9">
  <input type="file" name="userfile" style="margin-top:3px;" accept=".csv, application/vnd.ms-excel" required>
  </div>
  </div>
  </div>
  <div class="modal-footer">
  <input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id; ?>">
  <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
  <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Import</button>
  </div>
  </form>
  </div>
  </div>
  </div>

  <?php endif; */ ?>

<script type="text/javascript">



    $(document).ready(function () {


        $('#checkSub-list').change(function () {

            if (false == $(this).prop("checked")) {

                $(".checkRows-list").prop('checked', false);
                $(".selectedClass-list").removeClass('success');
                $('.custom_action_box-list').hide();
            } else {

                $(".checkRows-list").prop('checked', true);
                $(".selectedClass-list").addClass('success');
                $('.custom_action_box-list').show();
            }

        });

        $(document).on('click', '.checkRows-list', function () {
            var inc = 0;


            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-sub-' + rowId).removeClass('success');
            } else {
                $('#append-sub-' + rowId).addClass('success');
            }

            $('.checkRows-list:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {

                $('.custom_action_box-list').hide();
            } else {
                $('.custom_action_box-list').show();
            }

            var numberOfChecked = $('.checkRows-list:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows-list:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('.checkSub-list').prop('checked', false);
            }

        });

        $(document).on('click', '#deleteButtonBrandboostOnlineSub', function () {

            var val = [];
            $('.checkRows-list:checkbox:checked').each(function (i) {
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
                                    url: '<?php echo base_url('admin/brandboost/delete_multipal_subscriber'); ?>',
                                    type: "POST",
                                    data: {multiSubscriberId: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = '';
                                        }
                                    }
                                });
                            }
                        });
            }

        });



        $("#addSubscriberData").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/add_subscriber'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }, error() {
                    $('.overlaynew').hide();
                }
            });
        });

        $("#addSubscriberDataForm, #addSubscriberDataPop").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/add_subscriber'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }, error() {
                    $('.overlaynew').hide();
                }
            });
        });

        $(document).on('click', '.editSubscriber', function () {
            var subscriberID = $(this).attr('subscriberid');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/getSubscriberById'); ?>',
                type: "POST",
                data: {subscriberID: subscriberID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var subData = data.result[0];
                        $('#edit_firstname').val(subData.firstname);
                        $('#edit_lastname').val(subData.lastname);
                        $('#edit_email').val(subData.email);
                        $('#edit_phone').val(subData.phone);
                        $('#edit_subscriberID').val(subData.id);
                        $("#editSubscriberModal").modal();
                    }
                }
            });
        });

        $("#updateSubscriberData").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_subscriber'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $("#updateSubscriberDataPop").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_subscriber'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.deleteSubscriber', function () {
            var subscriberID = $(this).attr('subscriberid');
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
                            $.ajax({
                                url: '<?php echo base_url('admin/brandboost/delete_subscriber'); ?>',
                                type: "POST",
                                data: {subscriberId: subscriberID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        window.location.href = '';
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

        });

        $(document).on('click', '.unSubscribeUAC', function () {
            $('.overlaynew').show();
            var subscriberEmail = $(this).attr('subscriberemail');
            var subscriberid = $(this).attr('subscriberid');

            $.ajax({
                url: '<?php echo base_url('admin/brandboost/unsubscriber_user'); ?>',
                type: "POST",
                data: {subscriber_email: subscriberEmail, subscriberid: subscriberid},
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.chg_status', function () {

            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var subscriberId = $(this).attr('subscriberId');

            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_subscriber_status'); ?>',
                type: "POST",
                data: {status: status, subscriber_id: subscriberId},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
    });
</script>

