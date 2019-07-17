<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date_new.js"></script>
<!-- Content area -->
<div class="content">

    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Brand Boost Questions</h6>
                    <div class="heading-elements">
                        <span class="label bg-success heading-text"><?php echo count($result); ?> Brand Boost Questions</span>
                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <div class="custom_action_box">
                        <button id="deleteQuestionBtn" class="btn btn-danger btn-xs lgrey">Delete</button>
                    </div>
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table datatable-sorting text-nowrap blef0 brig0">
                        <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ></th>
                                <th class="col-md-4">Question</th>
                                <th class="col-md-2 text-center">Num Of Answer</th>
                                <th class="col-md-2">Date Created</th>
                                <th class="col-md-2 text-center">Current Status</th>
                                <th class="text-center" style="width: 20px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (count($result) > 0) {
                                
                                foreach ($result as $data) {

                                    $getAnswerCount = getAnswerCount($data->id);
                                    
                                    if (empty($getAnswerCount)) {
                                        $getAnswerCount = 0;
                                    }
                                    ?>


                                    <tr id="append-<?php echo $data->id; ?>" class="selectedClass">
                                        <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
                                        <td style="display: none;"><?php echo $data->id; ?></td>
                                        <td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" ></td>
                                        <td><span class="text-default text-semibold"><?php echo $data->question; ?></span></td>
                                        <td class="text-center"><a href="<?php echo base_url('admin/questions/answers/' . $data->id); ?>"><span class="badge bg-success" style="background:#6598C7; border:2px solid #6598C7"><?php echo $getAnswerCount; ?></span></a></td>
                                        <td><div class="text-semibold">
                                                <?php echo date('F d, Y', strtotime($data->created)); ?> 
                                            </div>
                                            <div class="text-muted text-size-small">
                                                <?php echo date('h:i A', strtotime($data->created)); ?> (<?php echo timeAgo($data->created); ?>)
                                            </div></td>
                                        <td class="text-center">
                                            <?php
                                            if ($data->status == 1) {
                                                ?><span class="label bg-success">ACTIVE</span><?php
                                            } else if ($data->status == 2) {
                                                ?><span class="label bg-blue">PENDING</span><?php
                                            } else {
                                                ?><span class="label bg-danger">INACTIVE</span><?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <?php
                                                        if ($data->status == 1) {
                                                            echo "<li><a question_id='" . $data->id . "' change_status = '0' title='Disapproved this question.' class='chg_status'><i class='icon-gear'></i> Disapproved</a></li>";
                                                        } else if ($data->status == 2) {
                                                            echo "<li><a question_id='" . $data->id . "' change_status = '1' title='Approved this question.' class='chg_status'><i class='icon-gear'></i> Approved</a></li>";
                                                            echo "<li><a question_id='" . $data->id . "' change_status = '0' title='Disapproved this question.' class='chg_status'><i class='icon-gear'></i> Disapproved</a></li>";
                                                        } else {
                                                            echo "<li><a question_id='" . $data->id . "' change_status = '1' title='Approved this question.' class='chg_status'><i class='icon-gear'></i> Approved</a></li>";
                                                        }
                                                        ?>														
                                                        <li><a href="javascript:void(0);" class="questionDelete" quesID="<?php echo $data->id; ?>"><i class="icon-trash"></i> Delete</a></li>

                                                    </ul>
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
    </div>
    <!-- /dashboard content -->

</div>
<!-- /content area -->


<!-- =======================edit template popup========================= -->
<div id="questionTemplate" class="modal modalpopup fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="updateQuestionTemplate" action="javascript:void();">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Question/Answer</h4>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-md-12">
                            <div class="input_box">
                                <label>Question</label>
                                <input name="eQuestion" id="eQuestion" value="" type="text" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="">
                                <label>Answer</label>
                                <textarea name="eAnswer" id="eAnswer" placeholder="Please type here reply." required></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <?php
                            foreach ($aTags as $value) {
                                ?><button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo '{' . $value . '}'; ?>" class="btn btn-default add_btn draggable insert_tag_button_edit"><?php echo '{' . $value . '}'; ?></button>&nbsp;&nbsp;<?php
                            }
                            ?>
                        </div>


                        <div class="col-md-12">
                            <input type="hidden" name="eQuesId" id="eQuesId" value="">
                            <input type="submit" class="btn blue" value="Save & Close" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

        $(document).on('click', '#deleteQuestionBtn', function () {
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
                                    url: '<?php echo base_url('admin/questions/deleteQuestions'); ?>',
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

        $(document).on('click', '.questionEdit', function () {
            var quesID = $(this).attr('quesID');
            $.ajax({
                url: '<?php echo base_url('admin/questions/get_question_by_Id'); ?>',
                type: "POST",
                data: {quesID: quesID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var temp = data.result[0];
                        var answer = data.answer;
                        $('#eQuestion').val(temp.question);
                        $('#eAnswer').summernote("code", answer);
                        //$('#eAnswer').summernote({"height": 300});
                        $('#eQuesId').val(temp.id);
                        $("#questionTemplate").modal();

                    } else {

                    }
                }
            });
        });


        $("#updateQuestionTemplate").submit(function () {
            $('.overlaynew').show();
            var question = $("#eQuestion").val();
            var answer = $("#eAnswer").val();
            var quesId = $("#eQuesId").val();

            $.ajax({
                url: '<?php echo base_url('admin/questions/update_question'); ?>',
                type: "POST",
                data: {answer: answer, question: question, quesId: quesId},
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


        $(document).on('click', '.questionDelete', function () {
            var quesID = $(this).attr('quesID');
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
                                url: '<?php echo base_url('admin/questions/delete_question'); ?>',
                                type: "POST",
                                data: {quesID: quesID},
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
            var question_id = $(this).attr('question_id');

            $.ajax({
                url: '<?php echo base_url('admin/questions/update_question_status'); ?>',
                type: "POST",
                data: {status: status, question_id: question_id},
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

