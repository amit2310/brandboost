<link href="/assets/css/summernote.css" rel="stylesheet">
<script src="/assets/js/summernote.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/datatables_sorting_date_new.js"></script>
<!--=====================body=========================-->


<!-- Content area -->
<div class="content">
    <div class="row mb20">
        <div class="col-lg-12 text-right">
            <button data-toggle="modal" data-target="#addAnswer" type="button" class="btn bl_cust_btn btn-default"><i class="icon-make-group position-left"></i> ADD ANSWER </button>
        </div>
    </div>

    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ 'Question : ' . $question->question }}</h6>
                    <div class="heading-elements">
                        <span class="label bg-success heading-text">{{ count($result) }} Answers</span>
                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <div class="custom_action_box">
                        <button id="deleteAnswersBtn" class="btn btn-danger btn-xs lgrey">Delete</button>
                    </div>
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table datatable-sorting text-nowrap blef0 brig0 membershipTable">
                        <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ></th>
                                <th>Answer</th>
                                <th>Date Created</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $inc = 1;
                            foreach ($result as $data) {
                                @endphp
                                <tr id="append-{{ $data->id }}" class="selectedClass">
                                    <td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
                                    <td style="display: none;">{{ $data->id }}</td>
                                    <td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $data->id }}" value="{{ $data->id }}" ></td>
                                    <td>{{ base64_decode($data->answer) }}</td>
                                    <td><div class="text-semibold">
										{{ date('F d, Y', strtotime($data->created)) }}
                                        </div>
                                        <div class="text-muted text-size-small">
											{{ date('h:i A', strtotime($data->created)) }} ({{ timeAgo($data->created) }})
                                        </div></td>

                                    <td class="text-center">
                                        @if ($data->status == 1)
											<span class="label bg-success">ACTIVE</span>
										@elseif ($data->status == 2)
											<span class="label bg-blue">PENDING</span>
										@else
											<span class="label bg-danger">INACTIVE</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
													@if ($data->status == 1)
														<li><a style='cursor:pointer' answer_id='{{ $data->id }}' change_status = '0' title='Disapproved this answer.' class='chg_status'><i class='icon-gear'></i>Disapproved</a></li>
													@elseif ($data->status == 2)
														<li><a style='cursor:pointer' answer_id='{{ $data->id }}' change_status = '1' title='Approved this answer.' class='chg_status'><i class='icon-gear'></i>Approved</a>&nbsp; / &nbsp;
														<li><a style='cursor:pointer' answer_id='{{ $data->id }}' change_status = '0' title='Disapproved this answer.' class='chg_status'><i class='icon-gear'></i>Disapproved</a></li>
													@else
														<li><a style='cursor:pointer' answer_id='{{ $data->id }}' change_status = '1' title='Approved this answer.' class='chg_status'><i class='icon-gear'></i>Approved</a></li>
													@endif
                                                    <li><a href="javascript:void(0);" class="answerEdit" quesID="{{ $question->id }}" ansID="{{ $data->id }}" ><i class="icon-gear"></i> Edit</a></li>

                                                    <li><a href="javascript:void(0);" class="answerDelete" quesID="{{ $question->id }}" ansID="{{ $data->id }}" ><i class="icon-trash"></i> Delete</a></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
    @php
    $inc++;
}
@endphp

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /marketing campaigns -->
        </div>
    </div>
    <!-- /dashboard content -->

</div>
<!-- /content area -->



<!-- ============================== Add Answer ================================= -->


<div id="addAnswer" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addQuestionTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Answer</h5>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Answer</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="answer" id="answer" placeholder="Please type here reply." required></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="question_id" name="question_id" value="<?php echo $question->id; ?>">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="addButton" class="btn btn-primary"><i class="icon-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- =======================edit answer========================= -->

<div id="updateAnswerTemp" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateAnswerTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Answer</h5>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Answer</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="eAnswer" id="eAnswer" placeholder="Please type here reply." required></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="eAnsId" id="eAnsId" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="addButton" class="btn btn-primary"><i class="icon-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
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

	$(document).on('click', '#deleteAnswersBtn', function () {
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
						url: "{{ base_url('admin/questions/deleteAnswers') }}",
						type: "POST",
						data: {multipal_record_id: val},
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

	$('#answer').summernote({"height": 300});

	$("#addQuestionTemplate").submit(function () {
		$('.overlaynew').show();
		var answer = $("#answer").val();
		var question_id = $("#question_id").val();
		$.ajax({
			url: "{{ base_url('admin/questions/add_answer') }}",
			type: "POST",
			data: {question_id: question_id, answer: answer, _token: '{{csrf_token()}}'},
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					window.location.href = window.location.href;
				} else {
					alertMessage('Error: Some thing wrong!');
					$('.overlaynew').hide();
				}
			}
		});
	});

	$(document).on('click', '.answerEdit', function () {
		var quesID = $(this).attr('quesID');
		var ansID = $(this).attr('ansID');
		$.ajax({
			url: "{{ base_url('admin/questions/get_answer_by_Id') }}",
			type: "POST",
			data: {ansID: ansID, quesID: quesID},
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					var temp = data.result[0];
					var answer = data.answer;
					$('#eAnswer').summernote("code", answer);
					$('#eAnsId').val(temp.id);

					$("#updateAnswerTemp").modal();
				} else {

				}
			}
		});
	});


	$("#updateAnswerTemplate").submit(function () {
		$('.overlaynew').show();
		var answer = $("#eAnswer").val();
		var eAnsId = $("#eAnsId").val();
		$.ajax({
			url: "{{ base_url('admin/questions/update_answer') }}",
			type: "POST",
			data: {answer: answer, ansId: eAnsId},
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					$('.overlaynew').hide();
					window.location.href = window.location.href;
				} else {
					alertMessage('Error: Some thing wrong!');
					$('.overlaynew').hide();
				}
			}
		});
	});


	$(document).on('click', '.answerDelete', function () {
		var ansID = $(this).attr('ansID');
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
					url: "{{ base_url('admin/questions/delete_answer') }}",
					type: "POST",
					data: {ansID: ansID, _token, '{{csrf_token()}}'},
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

	$(document).on('click', '.chg_status', function () {
		$('.overlaynew').show();
		var status = $(this).attr('change_status');
		var answer_id = $(this).attr('answer_id');
		$.ajax({
			url: "{{ base_url('admin/questions/update_answer_status') }}",
			type: "POST",
			data: {status: status, answer_id: answer_id, _token: '{{csrf_token()}}'},
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					$('.overlaynew').hide();
					window.location.href = window.location.href;
				} else {
					alertMessage('Error: Some thing wrong!');
					$('.overlaynew').hide();
				}
			}
		});
	});
});
</script>

