<?php 
    if(empty($moduleName)) {
        $moduleName = '';
    }

    if(empty($moduleUnitID)) {
        $moduleUnitID = '';
    }
?>
@extends('layouts.main_template') 

@section('title')
<?php //echo $title;
 ?>
@endsection

@section('contents')
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date.js"></script> -->
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-vcard"></i> &nbsp; Invoice</h3>
                <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Active Contacts</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
                </ul> -->
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">


<!-- <button type="button" class="btn light_btn importModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>" data-redirect="<?php echo base_url(); ?>admin/contacts/mycontacts"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contact</span> </button>
  <a class="btn light_btn ml10" href="<?php echo base_url() ?>admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName; ?>&module_account_id=<?php echo $moduleUnitID; ?>"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contact</span> </a>
  <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>  
  &nbsp; -->


            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content"> 
        <div class="tab-pane active">

            <!-- Dashboard content -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <!-- <h6 class="panel-title"><?php echo $title; ?></h6>
                            <div class="heading-elements">
                                <span class="label bg-success heading-text"><?php echo count($usersdata); ?> <?php echo $title; ?></span>
                                <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                                                                <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                                                        </button>
                                                </div> -->
                            <h6 class="panel-title"><?php echo $title; ?></h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;

                                <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                                <button id="deleteBulkModuleContacts" class="btn btn-xs custom_action_box" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><i class="icon-trash position-left"></i> Delete</button>
                                <button id="archiveBulkModuleContacts" class="btn btn-xs custom_action_box" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><i class="icon-gear position-left"></i> Archive</button>
                            </div>
                        </div>


                        <div class="panel-body p0">
                                <!-- <input name="min" id="min" type="hidden">
                            <input name="max" id="max" type="hidden"> -->
                            <table class="table datatable-basic" id="allContact">
                                <thead>
                                    <tr><!-- sorting sortingAction -->
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-hash"></i>Invoice</th>
                                        <th><i class="icon-user"></i>Name</th>
<!--                                        <th><i class="icon-hash"></i>Title</th>-->
                                        <th><i class="icon-hash"></i>Amount</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                        <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($usersdata)) {
                                        foreach ($usersdata AS $oInvoice) {
                                            ?>
                                            <tr role="row">
                                                <td style="display: none;"><?php echo $oInvoice->id ?></td>
                                                <td style="display: none;"><?php echo date('m/d/Y', strtotime($oInvoice->created)); ?></td>
                                                <td>#<?php echo $oInvoice->id ?></td>

                                                <td><div class="text-default text-semibold"><?php echo $oInvoice->firstname . ' ' . $oInvoice->lastname; ?></div>
                                                    <div class="text-muted text-size-small"><?php echo ($oInvoice->is_recurring) ? 'Recurring' : 'One Time'; ?> </div>
                                                </td>
<!--                                                <td>
                                                    <?php echo $oInvoice->title; ?>
                                                </td>-->

                                                <td>
                                                    <h6 class="text-semibold"><?php echo '$' . number_format($oInvoice->amount_paid*0.01,2); ?></h6>
                                                </td>
                                                <td>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oInvoice->created)); ?></a></div>
                                                        <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oInvoice->created)); ?></div>
                                                    </div>

                                                </td>

                                                <td class="text-center">
                                                    <button class="btn btn-xs btn_white_table pr10"><i class="icon-primitive-dot txt_green"></i> <?php echo ucfirst($oInvoice->invoice_status); ?></button>
                                                </td>
                                                    <!-- <td>
                                                        <ul class="icons-list">
                                                            <li><a style="cursor: pointer;" data-toggle="modal" invoice_id="<?php echo $oInvoice->id; ?>" class="inv_details" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                            <li class="dropdown">
                                                                <a style="cursor: pointer;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="<?php echo base_url('admin/invoices/download_invoice/' . $oInvoice->id); ?>"><i class="icon-file-download"></i> Download</a></li>
                                                                    <li><a style="cursor: pointer;"><i class="icon-printer"></i> Print</a></li>
                                                                                                                            
                                                                                                                    </ul>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </td> -->

                                                <td class="text-center">
                                                    <div class="tdropdown">
                                                        <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-right width-200">
                                                            <li><a style="cursor: pointer;" data-toggle="modal" invoice_id="<?php echo $oInvoice->id; ?>" class="inv_details" data-target="#invoice"><i class="icon-file-eye"></i>View</a></li>
                                                            <li><a href="<?php echo base_url('admin/invoices/download_invoice/' . $oInvoice->id); ?>"><i class="icon-file-download"></i> Download</a></li>
                                                            <li><a style="cursor: pointer;"><i class="icon-printer"></i> Print</a></li>
                                                        </ul>
                                                    </div>


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
                    <!-- <div align="right" id="pagination_link"></div> -->
                </div>
            </div>
        </div>
    </div>


</div>

<div id="invoice_details" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content invc">

        </div>

    </div>
</div>
<!-- /content area -->
<script>
    $(document).ready(function () {
        
        $(document).on("click", ".inv_details", function(){
            $('.overlaynew').show();
            var invoiceid = $(this).attr('invoice_id');
            $.ajax({
                url: '<?php echo base_url('admin/invoices/get'); ?>',
                type: "POST",
                data: {invoice_id: invoiceid, _token:"{{csrf_token()}}"},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        $(".invc").html(data.content);
                        $("#invoice_details").modal("show");
                        $('.overlaynew').hide();

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


