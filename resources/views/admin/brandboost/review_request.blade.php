@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')
@php
$oReqOnsite = array();
$oReqOffsite = array();
foreach ($oRequest as $data2) {
    if ($data2->review_type == 'onsite') {
        $oReqOnsite[] = $data2;
    } else if ($data2->review_type == 'offsite') {
        $oReqOffsite[] = $data2;
    } else {
        $oReqOther[] = $data2;
    }
}

if ($param == 'onsite') {
    $oData = $oReqOnsite;
} else if ($param == 'offsite') {
    $oData = $oReqOffsite;
} else {
    $oData = $oRequest;
}

$brandboostID = '';
@endphp
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img src="/assets/images/offsite_icon_19.png" style="width: 16px;"> Review Requests</h3>
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

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading" style="box-shadow:none">
                    <h6 class="panel-title">{{ count($oRequest) }} Review Requests</h6>

                    <div class="heading-elements">

                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" tableid="reviewRequestOnsite" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i>
                            </div>
                        </div>
                        <div class="table_action_tool">
                            <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"/></i></a>
                            <a href="javascript:void(0);" class="editDataList"><i class=""><img src="{{ base_url() }}assets/images/icon_edit.png"/></i></a>
                            <a href="javascript:void(0);" id="deleteReviewRequest" class="custom_action_box" style="display:none;"><i class="icon-trash position-left"></i></a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if (count($oData) > 0)
                        <table class="table" id="reviewRequestOnsite">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
                                    <th class="nosort editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                    <th><i class="icon-stack-star"></i>Name</th>
                                    <th><i class="icon-atom"></i>Campaign</th>
                                    <!-- <th><i class="icon-display"></i>Phone</th> -->

                                    <th><i class="icon-hash"></i>Source</th>
                                    <th><i class="icon-user"></i>Contact Details</th>
                                    <th><i class="icon-calendar"></i>Created</th>
                                    <th><i class="icon-calendar"></i>Request Sent Date</th>
                                    <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                    <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                foreach ($oData as $data) {

                                    $brand_img = $data->brand_img;

                                    if (empty($brand_img)) {
                                        $imgSrc = base_url('assets/images/default_table_img2.png');
                                    } else {
                                        $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                                    }

                                    $aUser = \App\Models\Admin\UsersModel::getUserInfo($data->user_id);
                                    @endphp
                                    <tr id="append-{{ $data->trackinglogid }}" class="selectedClass">
                                        <td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
                                        <td style="display: none;">{{ $data->trackinglogid }}</td>
                                        <td class="editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $data->trackinglogid }}" value="{{ $data->trackinglogid }}" ><span class="custmo_checkmark"></span></label></td>

                                        <td><div class="media-left media-middle"> <a class="editBrandboost" brandid="{{ $data->brandboost_id }}" b_title="click to view campaign details" href="javascript:void(0);"><img onerror="this.src='{{ base_url('assets/images/default-logo.png') }}'" src="{{ $imgSrc }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="javascript:void(0);" class="text-default text-semibold" brandid="{{ $data->brandboost_id }}" class="text-default text-semibold">{{ $data->brand_title }}</a> </div>
                                                <div class="text-muted text-size-small">
                                                    @if (!empty($data->brand_desc))
                                                        {!! setStringLimit($data->brand_desc, 20) !!}
                                                    @else
                                                        {!! displayNoData() !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-display4 txt_purple"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">{{ ucwords($data->review_type) }}</a></div>
                                            </div></td>

                                        <td><div class="media-left media-middle"> <a class="icons" href="javascript:void();">
                                                    @if (ucfirst($data->tracksubscribertype) == 'Sms')
                                                        <i class="icon-mobile2 txt_green"></i>
                                                    @else
                                                        <i class="icon-envelop txt_blue"></i>
                                                    @endif
                                                </a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold">{{ ucfirst($data->tracksubscribertype) }}</a></div>
                                            </div></td>

                                        <td>
                                            <div class="media-left media-middle">
                                                @if (!empty($aUser))
                                                    {!! showUserAvtar($aUser->avatar, $aUser->firstname, $aUser->lastname) !!}
                                                @else
                                                    {!! showUserAvtar('', '', '') !!}
                                                @endif
                                            </div>

                                            <div class="media-left">
                                                @if (!empty($aUser))
                                                    <div class="pt-5">
                                                        <a href="{{ base_url() }}admin/subscriber/activities/{{ $aUser->id }}" target="_blank" class="text-default text-semibold bbot"><span>{{ $aUser->firstname }} {{ $aUser->lastname }}</span></a><img class="flags" src="{{ base_url() }}assets/images/flags/{{ strtolower($aUser->country) }}.png" onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                                                    <div class="text-muted text-size-small">{{ $aUser->email }}</div>
                                                @else
                                                    <span class="text-muted text-size-small">[No Data]</span>
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><span class="text-default text-semibold">{{ dataFormat($data->created) }}</span></div>
                                                <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->created)) }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><span class="text-default text-semibold">{{ dataFormat($data->requestdate) }}</span></div>
                                                <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->requestdate)) }}</div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="tdropdown">
                                                {!! $data->subscriberstatus == 1 ? '<i class="icon-primitive-dot txt_green fsize16"></i>' : '<i class="icon-primitive-dot txt_red fsize16"></i>' !!}
                                                <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">{{ $data->subscriberstatus == 1 ? ' Active' : ' Inactive' }}</a>
                                                <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                    @if ($data->subscriberstatus == 1)
                                                        <li>
                                                            <a subscriberId="{{ $data->subscriberid }}" change_status = "0" class="chg_status"><i class='icon-primitive-dot txt_red'></i> Inacive</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a  subscriberId="{{ $data->subscriberid }}" change_status = "1" class="chg_status"><i class='icon-primitive-dot txt_green'></i> Active</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        @if ($data->subscriberstatus == 1)
                                                            <li>
                                                                <a subscriberId="{{ $data->subscriberid }}" change_status = "0" class="chg_status"><i class='icon-file-locked'></i> Inacive</a>
                                                            </li>
                                                       @else
                                                            <li>
                                                                <a  subscriberId="{{ $data->subscriberid }}" change_status = "1" class="chg_status"><i class='icon-file-locked'></i> Active</a>
                                                            </li>
                                                        @endif

                                                        <li><a class="deleteSubscriber" href="javascript:void(0);" subscriberid="{{ $data->subscriberid }}" recordId="{{ $data->trackinglogid }}"><i class="icon-trash"></i> Delete</a></li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>

                                    </tr>
                                    @php
                                }
                                @endphp

                            </tbody>
                        </table>
                        @else
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th><i class="icon-stack-star"></i>Name</th>
                                    <th><i class="icon-atom"></i>Campaign</th>
                                    <th><i class="icon-hash"></i>Source</th>
                                    <th><i class="icon-user"></i>Contact Details</th>
                                    <th><i class="icon-calendar"></i>Created</th>
                                    <th><i class="icon-calendar"></i>Request Sent Date</th>
                                    <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                    <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td colspan="10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin: 20px 0px 0;" class="text-center">
                                            <h5 class="mb-20 mt40">
                                                Looks Like You Don’t Have Any Review Request Yet <img src="{{ base_url('assets/images/smiley.png') }}"> <br>
                                                Lets Create Your First Review Request.
                                            </h5>
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
                    @endif
                </div>
            </div>
            <div align="right" id="pagination_link"></div>
            <!-- /marketing campaigns -->
        </div>
    </div>
</div>

<div id="editSubscriberModal" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateSubscriberData" action="javascript:void(0);">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Subscriber</h5>
                </div>
                <div class="modal-body">

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


<script type="text/javascript">
    function calltoReviewPage(brandboostID)
    {
        window.location.href = '{{ base_url() }}admin/brandboost/addreview/' + brandboostID;
    }

    $(document).ready(function () {


        var tableId = 'reviewRequestOnsite';
        var tableBase = custom_data_table(tableId);

        $(document).on('change', '#checkAll', function () {
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

        $(document).on('click', '#deleteReviewRequest', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                        "This review request will deleted immediately.<br>You can't undo this action.",
                        function () {

                            $('.overlaynew').show();
                            $.ajax({
                                url: "{{ base_url('admin/brandboost/deleteReviewRequest') }}",
                                type: "POST",
                                data: {multipal_id: val, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '.subscriberDelete', function () {

            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this subscriber!");
            if (conf == true) {
                var subscriberID = $(this).attr('subscriberid');
                $.ajax({
                    url: "{{ base_url('admin/brandboost/subscriber_delete') }}",
                    type: "POST",
                    data: {subscriberid: subscriberID, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                        } else {

                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });

        $("#addSubscriberData").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/brandboost/add_subscriber') }}",
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

        $(document).on('click', '.editSubscriber', function () {

            var subscriberID = $(this).attr('subscriberid');
            $.ajax({
                url: "{{ base_url('admin/brandboost/getSubscriberById') }}",
                type: "POST",
                data: {subscriberID: subscriberID, _token: '{{csrf_token()}}'},
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

        $("#updateSubscriberData").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/brandboost/update_subscriber') }}",
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
            var recordId = $(this).attr('recordId');

            deleteConfirmationPopup(
                    "This review request will deleted immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/brandboost/deleteRRrecord') }}",
                            type: "POST",
                            data: {recordId: recordId, _token: '{{csrf_token()}}'},
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

        });

        $(document).on('click', '.unSubscribeUAC', function () {
            $('.overlaynew').show();
            var subscriberEmail = $(this).attr('subscriberemail');
            var subscriberid = $(this).attr('subscriberid');

            $.ajax({
                url: "{{ base_url('admin/brandboost/unsubscriber_user') }}",
                type: "POST",
                data: {subscriber_email: subscriberEmail, subscriberid: subscriberid, _token: '{{csrf_token()}}'},
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
                url: "{{ base_url('admin/brandboost/update_subscriber_status') }}",
                type: "POST",
                data: {status: status, subscriber_id: subscriberId, _token: '{{csrf_token()}}'},
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


    $(document).on('click', '.editDataList', function () {
        $('.editAction').toggle();
    });

    $(document).on('click', '#addOnSiteReview', function () {
        window.location.href = "{{ base_url() }}admin/brandboost/addreview/";
    });

</script>
@endsection
