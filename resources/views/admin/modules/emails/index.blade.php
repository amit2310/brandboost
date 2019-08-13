@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

<?php
$iActiveCount = $iArchiveCount = 0;

if (!empty($oAutomations)) {
    foreach ($oAutomations as $oCount) {
        if ($oCount->status == 'archive') {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
?>
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img src="/assets/images/email_icon_active.png"> <?php echo $title; ?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
<!--                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab"><?php echo $title; ?></a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>-->
                    <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="active"><?php echo $title; ?></a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="archive">Archive</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Automations &nbsp; &nbsp; <span class="caret"></span>
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

                <?php if (!empty($oAutomations) && $user_role != 1): ?>
                    <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn bl_cust_btn btn-default pDisplayNoActiveSubscription dark_btn ml20" <?php } else { ?> id="addEmailAutiomation" class="btn bl_cust_btn btn-default dark_btn ml20" <?php } ?> type="button" ><i class="icon-plus3"></i><span> &nbsp; <?php echo $title;?> </span></button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->



    <!-- Dashboard content -->
    <?php if (!empty($oAutomations)): ?>

        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.modules.emails.email-table')
                    </div>
                </div>
            </div>

        </div>

    <?php else: ?>
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title"><?php echo $iActiveCount; ?> <?php echo $title; ?></h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="deleteButtonEmailAutomation" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="archiveButtonEmailAutomation" class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic">
                                    <thead>
                                   
                                    <th ><i class="icon-stack-star"></i>Automation Name</th>
                                    <th ><i class="icon-calendar"></i>Created</th>
                                    <th><i class="icon-envelop2"></i>Email</th>
                                    <th><i class="icon-envelop2"></i>Open</th>
                                    <th><i class="icon-envelop2"></i>Click</th>
                                    <th><i class="icon-envelop2"></i>Bounce</th>
                                    <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                    <th class="col-md-1 text-center"><i class="fa fa-dot-circle-o"></i>Action</th>
                                  
                                    </thead>

                                    <tbody>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td colspan="10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="margin: 20px 0px 0;" class="text-center">
                                                    <h5 class="mb-20 mt40">
                                                        Looks Like You Don’t Have Created Any <?php echo ucfirst($automation_type);?> Automation Yet <img src="<?php echo site_url('assets/images/smiley.png'); ?>"> <br>
                                                        Lets Create <?php echo ucfirst($automation_type);?> Automation.
                                                    </h5>
                                                    <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn bl_cust_btn btn-default pDisplayNoActiveSubscription dark_btn ml20 mb40" <?php } else { ?> id="addEmailAutiomation" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" <?php } ?> type="button" ><i class="icon-plus3"></i><span> &nbsp; <?php echo $title; ?> </span></button>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

    <?php endif; ?>

    <!-- /dashboard content -->

</div>
<!-- /content area -->

<div id="editAutomationModel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditAutomationModel" class="form-horizontal" name="frmeditAutomationModel">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Automation</h5>
                </div>

                <div id="automationTitleEdit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Automation Name</label>
                                    <div class="">
                                        <input class="form-control" id="edit_title" name="title" placeholder="Enter Automation Name" type="text"><br>
                                        <div id="editAutomationValidation" style="color:#FF0000;display:none;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer p40">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn dark_btn nextButtonEdit">Next</button>
                    </div>
                </div>

                <div id="automationDescEdit" style="display: none;">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Automation Description</label>
                                    <div class="">
                                        <textarea class="form-control" id="edit_description" name="description" placeholder="Enter Automation Decription"></textarea><br/>
                                        <div id="editDescAutomationValidation" style="color:#FF0000;display:none;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer p40">
                        <input type="hidden" name="automation_id" id="hidautomationid" value="" />
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn dark_btn previousButtonEdit">Previous</button>
                        <button type="submit" class="btn dark_btn">Continue</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- addAutomation -->

<div id="addEmailAutiomationModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddEmailAutiomationModal" id="frmaddEmailAutiomationModal" action="javascript:void();">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> Add <?php echo $title; ?> &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Please Enter Title below:</label>
                                <input class="form-control" id="title" name="title" placeholder="Enter Title" type="text" required>

                            </div>

                            <div class="form-group mb0">
                                <label>Please Enter Description:</label>
                                <input class="form-control h52" type="text" id="description" name="description" value="" placeholder="Enter automation description"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="automation_type" value="<?php echo $automation_type;?>" />
                    <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Automation -->

<div id="addSubscriber" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addSubscriberData" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Subscriber</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo Session::get('error_message'); ?>
                        <?php //echo validation_errors(); ?></div>

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
                                <input name="phone" id="phone" value="" class="form-control" type="text" required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="listId" id="list_id" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="updateButton" class="btn btn-primary"><i class="icon-check"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="importCSV" class="modal modalpopup fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="<?php echo base_url() ?>admin/lists/importListCSV" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Import Contacts CSV</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo Session::get('error_message'); ?>
                        <?php //echo validation_errors(); ?></div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Import CSV</label>
                        <div class="col-lg-9">
                            <input type="file" name="userfile" style="margin-top:3px;" accept=".csv, application/vnd.ms-excel" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="list_id" id="import_list_id" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.modals.segments.segments-popup')
<script src="<?php echo base_url(); ?>assets/js/modules/segments/segments.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('#emailsmsautomation thead tr').clone(true).appendTo('#emailsmsautomation thead');

        $('#emailsmsautomation thead tr:eq(1) th').each(function (i) {


            if (i === 11) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value, $('#colStatus').prop('checked', true))
                                .draw();
                    }
                });
            }

        });



        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();

        });


        var tableId = 'emailsmsautomation';
        var tableBase = custom_data_table(tableId);

        $('table thead tr:eq(1)').hide();

        $('#activeCampaign').trigger('click');


    });

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

        $(document).on('click', '#deleteButtonEmailAutomation', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                 deleteConfirmationPopup(
                "This record will deleted immediately.<br>You can't undo this action.", 
                function() {

                    $('.overlaynew').show();
                    $.ajax({
                        url: "<?php echo base_url('admin/modules/emails/multipalDeleteAutomation'); ?>",
                        type: "POST",
                        data: {"_token": "{{ csrf_token() }}", multipal_automation_id: val},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                location.reload();
                            } else {
                                alert("Having some error.");
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            }
        });


        $('#checkAllA').change(function () {
            if (false == $(this).prop("checked")) {
                $(".checkRowsA").prop('checked', false);
                $(".selectedClassA").removeClass('success');
                $('.custom_action_boxA').hide();
            } else {
                $(".checkRowsA").prop('checked', true);
                $(".selectedClassA").addClass('success');
                $('.custom_action_boxA').show();
            }
        });

        $(document).on('click', '.checkRowsA', function () {
            var inc = 0;
            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRowsA:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {
                $('.custom_action_boxA').hide();
            } else {
                $('.custom_action_boxA').show();
            }

            var numberOfChecked = $('.checkRowsA:checkbox:checked').length;
            var totalCheckboxes = $('.checkRowsA:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAllA').prop('checked', false);
            }

        });

        $(document).on('click', '#deleteButtonEmailAutomationA', function () {
            var val = [];
            $('.checkRowsA:checkbox:checked').each(function (i) {
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
                                    url: '<?php echo base_url('admin/modules/emails/multipalDeleteAutomation'); ?>',
                                    type: "POST",
                                    data: {"_token": "{{ csrf_token() }}",multipal_automation_id: val},
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


        $(document).on('click', '#archiveButtonEmailAutomation', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
                "This record will move to archive immediately.<br>You can't undo this action.", 
                function() {

                    $('.overlaynew').show();
                    $.ajax({
                        url: "<?php echo base_url('admin/modules/emails/multipalArchiveAutomation'); ?>",
                        type: "POST",
                        data: {"_token": "{{ csrf_token() }}", multipal_automation_id: val},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                location.reload();
                            } else {
                                alert("Having some error.");
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

            }
        });

        $(document).on("click", ".nextButton", function () {
            var title = $('#title').val();
            if (title == '') {
                $('#addEmailAutiomationValidation').html("Title should not be blank.");
                $('#addEmailAutiomationValidation').show();
                $('#addEmailTitAutiomationValidation').html("Title should not be blank.");
                $('#addEmailTitAutiomationValidation').show();

                return false;
            }
            $('#addEmailAutiomationValidation').html("");
            $('#addEmailAutiomationValidation').hide();
            $('#addEmailTitAutiomationValidation').html("");
            $('#addEmailTitAutiomationValidation').hide();
            $('#automationTitle').hide();
            $('#automationDesc').show();

        });

        $(document).on("click", ".nextButtonEdit", function () {
            var title = $('#edit_title').val();
            if (title == '') {
                $('#editAutomationValidation').html("Title should not be blank.");
                $('#editAutomationValidation').show();
                return false;
            }
            $('#editAutomationValidation').html("");
            $('#editAutomationValidation').hide();
            $('#automationTitleEdit').hide();
            $('#automationDescEdit').show();

        });

        $(document).on("click", ".previousButton", function () {
            $('#automationDesc').hide();
            $('#automationTitle').show();
        });

        $(document).on("click", ".previousButtonEdit", function () {
            $('#automationDescEdit').hide();
            $('#automationTitleEdit').show();
        });

        $(".importContact").click(function () {
            var listID = $(this).attr("list_id");
            $("#import_list_id").val(listID);
            $("#importCSV").modal();
        });

        $(".addContact").click(function () {
            var listID = $(this).attr("list_id");
            $("#list_id").val(listID);
            $("#addSubscriber").modal();
        });

        $(document).on('click', '#addEmailAutiomation', function () {
            $('#addEmailAutiomationModal').modal();
        });

        $('#frmaddEmailAutiomationModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddEmailAutiomationModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/emails/addAutiomation'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        //alertMessageAndRedirect("Automation created successfully!", '<?php echo base_url('admin/modules/emails/setupAutiomation/'); ?>'+data.id);
                        window.location.href = '<?php echo base_url('admin/modules/emails/setupAutomation/'); ?>' + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        displayMessagePopup('error', '', data.msg);
                    }

                }
            });
            return false;
        });

        $(document).on("click", ".editAutomation", function () {
            $('.overlaynew').show();
            var automationID = $(this).attr('automation_id');
            $.ajax({
                url: '<?php echo base_url('admin/modules/emails/getAutomation'); ?>',
                type: "POST",
                data: {"_token": "{{ csrf_token() }}",'automation_id': automationID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_title").val(data.title);
                        $("#edit_description").val(data.description);
                        $("#hidautomationid").val(automationID);
                        $('.overlaynew').hide();
                        $("#editAutomationModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on("click", ".change_staus", function () {
            $('.overlaynew').show();
            var automationID = $(this).attr('automation_id');
            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/modules/emails/changeAutomationStatus'); ?>',
                type: "POST",
                data: {"_token": "{{ csrf_token() }}",'automation_id': automationID, status:status},
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

        $('#frmeditAutomationModel').on('submit', function () {
            var description = $('#edit_description').val();
            if (description == '') {
                $('#editDescAutomationValidation').html("Description should not be blank.");
                $('#editDescAutomationValidation').show();
                return false;
            }
            $('#editDescAutomationValidation').html("");
            $('#editDescAutomationValidation').hide();

            $('.overlaynew').show();
            var formdata = $("#frmeditAutomationModel").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/emails/updateAutomation'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '<?php echo base_url('admin/modules/emails/setupAutomation/'); ?>' + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editAutomationValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editAutomationValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.deleteAutomation', function () {
            var elem = $(this);

            deleteConfirmationPopup(
                    "This record will deleted immediately.<br>You can't undo this action.",
                    function () {
                        $('.overlaynew').show();
                        var automationID = $(elem).attr('automation_id');
                        $.ajax({
                            url: '<?php echo base_url('admin/modules/emails/deleteAutomation'); ?>',
                            type: "POST",
                            data: {"_token": "{{ csrf_token() }}", automation_id: automationID},
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
                data: {"_token": "{{ csrf_token() }}", brandboost_id: brandID},
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

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });


    });




</script>


@endsection