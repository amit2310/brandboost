@php
    if(empty($moduleName)) {
        $moduleName = '';
    }

    if(empty($moduleUnitID)) {
        $moduleUnitID = '';
    }
@endphp
@extends('layouts.main_template')

@section('title')

@endsection

@section('contents')
    <!-- Content area -->
    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-3">
                    <h3><i class="icon-vcard"></i> &nbsp; Invoice</h3>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-9 text-right btn_area">


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
                                <h6 class="panel-title">{{ $title }}</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                    <button type="button" class="btn btn-xs btn-default editDataList"><i
                                            class="icon-pencil position-left"></i> Edit
                                    </button>
                                    <button id="deleteBulkModuleContacts" class="btn btn-xs custom_action_box"
                                            data-modulename="{{ $moduleName }}"
                                            data-moduleaccountid="{{ $moduleUnitID }}"><i
                                            class="icon-trash position-left"></i> Delete
                                    </button>
                                    <button id="archiveBulkModuleContacts" class="btn btn-xs custom_action_box"
                                            data-modulename="{{ $moduleName }}"
                                            data-moduleaccountid="{{ $moduleUnitID }}"><i
                                            class="icon-gear position-left"></i> Archive
                                    </button>
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
                                    @if (!empty($usersdata))
                                        @foreach ($usersdata AS $oInvoice)
                                            <tr role="row">
                                                <td style="display: none;">{{ $oInvoice->id }}</td>
                                                <td style="display: none;">{{ date('m/d/Y', strtotime($oInvoice->created)) }}</td>
                                                <td>#{{ $oInvoice->id }}</td>

                                                <td>
                                                    <div
                                                        class="text-default text-semibold">{{ $oInvoice->firstname . ' ' . $oInvoice->lastname }}</div>
                                                    <div
                                                        class="text-muted text-size-small">{{ ($oInvoice->is_recurring) ? 'Recurring' : 'One Time' }} </div>
                                                </td>

                                                <td>
                                                    <h6 class="text-semibold">{{ '$' . number_format($oInvoice->amount_paid*0.01,2) }}</h6>
                                                </td>
                                                <td>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="javascript:void(0);"
                                                                             class="text-default text-semibold">{{ date('d M Y', strtotime($oInvoice->created)) }}</a>
                                                        </div>
                                                        <div
                                                            class="text-muted text-size-small">{{ date('h:i A', strtotime($oInvoice->created)) }}</div>
                                                    </div>

                                                </td>

                                                <td class="text-center">
                                                    <button class="btn btn-xs btn_white_table pr10"><i
                                                            class="icon-primitive-dot txt_green"></i> {{ ucfirst($oInvoice->invoice_status) }}
                                                    </button>
                                                </td>

                                                <td class="text-center">
                                                    <div class="tdropdown">
                                                        <button type="button"
                                                                class="btn btn-xs btn_white_table ml20 dropdown-toggle"
                                                                data-toggle="dropdown"><i
                                                                class="icon-more2 txt_blue"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-right width-200">
                                                            <li><a style="cursor: pointer;" data-toggle="modal"
                                                                   invoice_id="{{ $oInvoice->id }}" class="inv_details"
                                                                   data-target="#invoice"><i class="icon-file-eye"></i>View</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ base_url('admin/invoices/download_invoice/' . $oInvoice->id) }}"><i
                                                                        class="icon-file-download"></i> Download</a>
                                                            </li>
                                                            <li><a style="cursor: pointer;"><i class="icon-printer"></i>
                                                                    Print</a></li>
                                                        </ul>
                                                    </div>


                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

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

            $(document).on("click", ".inv_details", function () {
                $('.overlaynew').show();
                var invoiceid = $(this).attr('invoice_id');
                $.ajax({
                    url: "{{ base_url('admin/invoices/get') }}",
                    type: "POST",
                    data: {invoice_id: invoiceid, _token: "{{csrf_token()}}"},
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


