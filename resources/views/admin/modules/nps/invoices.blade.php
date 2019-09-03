<script type="text/javascript" src="{{ base_url() }}assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/datatables_sorting_date.js"></script>
<!-- Content area -->
<div class="content">
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Referral Invoice History</h6>
                    <div class="heading-elements">
                        <span class="label bg-success lgraybtn heading-text">{{ count($oInvoices) }} Records</span>
                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table text-nowrap datatable-sorting" id="allContact">
                        <thead>
                            <tr>
                                <th class="col-md-3">Contact Details</th>
                                <th class="col-md-3">Sale Count</th>
                                <th class="col-md-2">Total Sales</th>
                                <th class="col-md-2">Currency</th>
                                <th class="col-md-2">Created</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $inc = 1;
                            foreach ($oInvoices as $oInvoice) {
                                @endphp
                                <tr>
                                    <td>			
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold">{{ $oInvoice->firstname }} {{ $oInvoice->lastname }}</a>
                                            <div class="text-muted text-size-small">{{ $oInvoice->email }}</div>
                                            <div class="text-muted text-size-small">{!! $oInvoice->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oInvoice->mobile !!}</div>
                                        </div>
                                    </td>
                                    
                                    <td class="">{{ $oInvoice->sale_count }}</td>
                                    <td class="">{{ ($oInvoice->currency == 'USD')? '$':'' }} {{ $oInvoice->total_sale }}</td>
                                    <td class="">{{ $oInvoice->currency }}</td>
                                    <td class="">{{ date('m/d/Y', strtotime($oInvoice->created)) }}</td>
                                </tr>
                                @php $inc++;
                            } @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>