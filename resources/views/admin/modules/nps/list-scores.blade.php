@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')
<!-- Content area -->
<div class="content">

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img style="width: 19px;" src="{{ base_url() }}assets/images/nps_icon.png"> &nbsp; NPS Score</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="allS active"><a style="javascript:void();" class="filterByColumn" fil="">All</a></li>
                    <li class="proS"><a style="javascript:void();" class="filterByColumn" fil="1">Promoters</a></li>
                    <li class="pasS"><a style="javascript:void();" class="filterByColumn" fil="2">Passive</a></li>
                    <li class="detS"><a style="javascript:void();" class="filterByColumn" fil="3">Detractors</a></li>
                </ul>
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
    <!-- Dashboard content -->
    @if (!empty($oFeedbacks))
        <div class="tab-content">
            <div class="tab-pane active" id="right-icon-tab1">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ count($oFeedbacks) }} NPS Score</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableid="listScoresTable" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;
                            </div>
                        </div>


                        <div class="panel-body p0">
                            <table class="table" id="listScoresTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-user"></i> Contact</th>
                                        <th><i class="icon-stack-star"></i> Program</th>
                                        <th><i class="icon-display"></i> Phone</th>
                                        <th><i class="icon-calendar"></i> Created</th>
                                        <th><i class="icon-hash"></i> Score</th>
                                        <th><i class="icon-atom"></i> Feedback</th>
                                        <th style="display: none;">Score</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @php
                                    foreach ($oFeedbacks as $oFeedback) {
                                        $score = ($oFeedback->score) ? $oFeedback->score : 0;
                                        $feedback = ($oFeedback->feedback) ? $oFeedback->feedback : 'N/A';
                                        $oTags = $mNPS->getTagsByScoreID($oFeedback->id);

                                        $aName = explode(' ', $oFeedback->feedback_fullname, 2);
                                        $firstName = isset($aName[0]) ? $aName[0] : '';
                                        $lastName = isset($aName[1]) ? $aName[1] : '';

                                        $oFeedback->country_code = isset($oFeedback->country_code) ? $oFeedback->country_code : 'us';
                                    @endphp
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td>
                                                @if ($oFeedback->subscriber_id > 0)
                                                    <div class="media-left media-middle"> {!! @showUserAvtar($oFeedback->avatar, $oFeedback->firstname, $oFeedback->lastname) !!} </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold bbot">{{ $oFeedback->firstname }} {{ $oFeedback->lastname }}</a> <img class="flags" src="{{ base_url() }}assets/images/flags/{{ strtolower($oFeedback->country_code) }}.png" onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                                                        <div class="text-muted text-size-small">{{ $oFeedback->email }}</div>
                                                    </div>
                                                @else
                                                    <div class="media-left media-middle"> {!! $oFeedback->feedback_fullname == '' ? showUserAvtar('', '', '') : @showUserAvtar($oFeedback->avatar, $firstName, $lastName) !!} </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold bbot">{{ $oFeedback->feedback_fullname == '' ? 'User_' . $oFeedback->id : $firstName . ' ' . $lastName }}</a> <img class="flags" src="{{ base_url() }}assets/images/flags/{{ strtolower($oFeedback->country_code) }}.png" onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                                                        <div class="text-muted text-size-small">{{ $oFeedback->feedback_email == '' ? $oFeedback->email : $oFeedback->feedback_email }}</div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="media-left media-middle"> <a class="icons square" href="javascript:void(0);"><i class="icon-checkmark3 txt_blue"></i></a> </div>
                                                <div class="media-left">
                                                    <div class="pt-5"><a class="text-default text-semibold" href="{{ base_url() }}admin/modules/nps/setup/{{ $oFeedback->npsID }}"> {{ $oFeedback->campaignTitle }}</a></div>
                                                    <div class="text-muted text-size-small">{{ ucfirst($oFeedback->platform) }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="#" class="text-default text-semibold">{!! $oFeedback->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($oFeedback->phone) !!}</a></div>
                                                    <div class="text-muted text-size-small">Chat</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media-left">
                                                    <div class="pt-5"><a class="text-default text-semibold">{{ dataFormat($oFeedback->created_at) }}</a></div>
                                                    <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oFeedback->created_at)) }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $score }}</td>
                                            <td>
                                                <div class="media-left">
                                                    <a style="cursor: pointer;" class="showFeedbackData"><span class="text-default text-semibold">{{ setStringLimit($oFeedback->title) }}</span></a>
                                                    <div style="display: none;">{{ $oFeedback->title }}</div>
                                                    <div style="display: none;">{{ $feedback }}</div>
                                                    <div class="text-muted text-size-small">
													{{ setStringLimit($feedback) }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: none;">
												@if ($score > 8)
													1
                                                @elseif ($score <= 8 && $score > 6)
													2
                                                @else
													3
                                                @endif
											</td>
                                        </tr>
                                        @php
                                    }
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @php $tab = isset($_GET['tab']) ? $_GET['tab'] : '' @endphp

            @if ($tab == 'promoters')
                <script>
                    $(document).ready(function () {
                        $(".allS").removeClass('active');
                        $(".proS").addClass('active');
                        setTimeout(function () {
                            $(".proS").children().trigger('click');
                        }, 50);
                    });
                </script>
            @elseif ($tab == 'passive')
                <script>
                    $(document).ready(function () {
                        $(".allS").removeClass('active');
                        $(".pasS").addClass('active');
                        setTimeout(function () {
                            $(".pasS").children().trigger('click');
                        }, 50);
                    });
                </script>
            @elseif ($tab == 'detractors')
                <script>
                    $(document).ready(function () {
                        $(".allS").removeClass('active');
                        $(".detS").addClass('active');
                        setTimeout(function () {
                            $(".detS").children().trigger('click');
                        }, 50);
                    });
                </script>
            @endif
        </div>
    @endif
    <!-- /dashboard content -->

</div>
<!-- /content area -->

<div id="editSurveyModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditSurveyModel" name="frmeditSurveyModel">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Survey</h5>
                </div>

                <div id="npsTitleEdit">
                    <div class="modal-body">
                        <p>Survey Name:</p>
                        <input class="form-control" id="edit_title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
                        <div id="editSurveyValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="nps_id" id="hidnpsid" value="" />
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add New Survey -->
<div id="addNPSModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddNPSModal" id="frmaddNPSModal" action="#">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add New Survey</h5>
                </div>

                <div id="npsTitle">
                    <div class="modal-body">
                        <p>Survey Name:</p>
                        <input class="form-control" id="title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
                        <div id="addNPSValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="NPSTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmNPSTagListModal" id="frmNPSTagListModal" action="#">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireList"></div>
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="score_id" id="tag_score_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- showFeedback -->
<div id="showFeedbackModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                @csrf
                <div class="modal-header purple_preview_2 purple_preview_2">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ base_url() }}assets/images/customer_profile_icon.png"> NPS Score Feedback</h5>
                </div>
                <div class="modal-body p30 minh180">
                    <label class="fsize11 m0">Heading :</label>
                    <p class="feedbackHeading fw600 fsize14 text-dark mb10"></p>

                    <label class="fsize11 m0">Description :</label>
                    <p class="feedbackContent fsize13"></p>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {
        $('#listScoresTable thead tr').clone(true).appendTo('#listScoresTable thead');
        $('#listScoresTable thead tr:eq(1) th').each(function (i) {

            if (i === 8) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');

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

        var tableId = 'listScoresTable';
        var tableBase = custom_data_table(tableId);

        $(document).on('click', '.filterByColumn', function () {
            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();
        });


        $(document).on('click', '.showFeedbackData', function () {
            $('.feedbackHeading').html($(this).next().text());
            $('.feedbackContent').html($(this).next().next().text());
            $('#showFeedbackModal').modal();
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


        $(document).on('click', '#deleteBulkNPS', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
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
							url: "{{ base_url('admin/modules/nps/bulkDeleteNPS') }}",
							type: "POST",
							data: {_token: '{{csrf_token()}}', bulk_nps_id: val},
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


        $(document).on('click', '#archiveBulkNPS', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
				function (isConfirm) {
					if (isConfirm) {
						$('.overlaynew').show();
						$.ajax({
							url: "{{ base_url('admin/modules/nps/bulkArchiveNPS') }}",
							type: "POST",
							data: {_token: '{{csrf_token()}}', bulk_nps_id: val},
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



        $('#addNpsSurvery').click(function () {
            $('#addNPSModal').modal();
        });

        $('#frmaddNPSModal').on('submit', function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formdata = $("#frmaddNPSModal").serialize();
            $.ajax({
                url: "{{ base_url('admin/modules/nps/addNPS') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = "{{ base_url('admin/modules/nps/setup/') }}" + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addNPSValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addNPSValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on("click", ".editSurvey", function () {
            $('.overlaynew').show();
            var nps_id = $(this).attr('nps_id');
            $.ajax({
                url: "{{ base_url('admin/modules/nps/getNPS') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'nps_id': nps_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_title").val(data.title);
                        $("#hidnpsid").val(nps_id);
                        $('.overlaynew').hide();
                        $("#editSurveyModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });


        $(document).on("click", ".moveToArchiveNPS", function () {
            $('.overlaynew').show();
            var nps_id = $(this).attr('nps_id');
            $.ajax({
                url: "{{ base_url('admin/modules/nps/moveToArchiveNPS') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'nps_id': nps_id},
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


        $('#frmeditSurveyModel').on('submit', function (e) {
            e.preventDefault();
            $('.overlaynew').show();
            var formdata = $("#frmeditSurveyModel").serialize();
            $.ajax({
                url: "{{ base_url('admin/modules/nps/updateNPS') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = "{{ base_url('admin/modules/nps/setup/') }}" + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editSurveyValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editSurveyValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on('click', '.deleteNPS', function () {
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
					var nps_id = $(elem).attr('nps_id');
					$.ajax({
						url: "{{ base_url('admin/modules/nps/deleteNPS') }}",
						type: "POST",
						data: {_token: '{{csrf_token()}}', nps_id: nps_id},
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
        });


        $(document).on("click", ".applyInsightTags", function () {
            var score_id = $(this).attr("scoreid");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: "{{ base_url('admin/modules/nps/listAllTags') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', score_id: score_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
                        } else {
                            $('.modalFooterBtn').show();
                        }
                        $("#tagEntireList").html(dataString);
                        $("#tag_score_id").val(score_id);
                        if (action_name == 'nps-tag') {
                            $("#NPSTagListModal").modal("show");
                        }
                    }
                }
            });
        });


        $("#frmNPSTagListModal").submit(function (e) {
            e.preventDefault();
            var formdata = $("#frmNPSTagListModal").serialize();
            $.ajax({
                url: "{{ base_url('admin/modules/nps/applyNPSTag') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#NPSTagListModal").modal("hide");
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });
    });
</script>
@endsection
