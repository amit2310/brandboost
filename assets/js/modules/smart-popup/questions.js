

var startingLimit = 0;
function loadSmartMoreAnswer(questionID, startinglimitVal) {
    $('.overlaynew').show();
    var tkn = $('meta[name="_token"]').attr('content');
    $.ajax({
        url: '/admin/questions/getAnswer/',
        type: "POST",
        data: {'questionId': questionID, 'startinglimitVal': startinglimitVal, 'source': 'smartpopup',_token: tkn},
        dataType: "json",
        success: function (data) {
            $('.overlaynew').hide();
            if (data.status == 'success') {
                $('#commentDataList').append(data.answerList);
                startingLimit = parseInt(startinglimitVal) + 5;
                if (data.nunOfComment < 5) {
                    $('.loadMoreBtn').html('<a href="javascript:void(0);">No More Answer Found...</a>');
                } else {
                    $('.loadMoreBtn a').attr('onclick', 'loadSmartMoreAnswer(' + questionID + ', ' + startingLimit + ')');
                }

            } else {
                $('.loadMoreBtn').html('<a href="javascript:void(0);">' + data.answerList + '</a>');
            }
        }, error() {
            $('.overlaynew').hide();
        }
    });
    return false;
}



$(document).ready(function () {

    $(document).on("click", ".replySmartCommentAction", function () {
        $(this).parent().next('.replyCommentBox').toggle('slow');
    });



    $(document).on('click', '.chg_smart_status', function () {
        $('.overlaynew').show();
        var tkn = $('meta[name="_token"]').attr('content');
        var status = $(this).attr('change_status');
        var answer_id = $(this).attr('answer_id');
        var questionID = $("#smartpopup_question_id").val();
        $.ajax({
            url: '/admin/questions/update_answer_status',
            type: "POST",
            data: {status: status, answer_id: answer_id, _token:tkn},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    
                    loadQuestionSmartPopup(questionID, 'question');
                    $('.overlaynew').hide();
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
    });


    $(document).on('click', '.editSmartAnswer', function () {
        var answerID = $(this).attr('answer_id');
        $.ajax({
            url: '/admin/questions/getAnswer',
            type: "POST",
            data: {answerID: answerID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('#edit_smart_answer').val(data.answer);
                    $('#edit_smart_answer_id').val(answerID);
                    $("#editSmartAnswer").modal();
                } else {

                }
            }
        });
    });

    $(document).on('click', '.editSmartNote', function () {
        var noteId = $(this).attr('noteid');
        $.ajax({
            url: '/admin/questions/getQuestionNotes',
            type: "POST",
            data: {noteid: noteId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var noteData = data.result;
                    $('#edit_smart_note_content').val(noteData.notes);
                    $('#edit_smart_noteid').val(noteData.id);
                    $("#editSmartNoteSection").modal();
                } else {

                }
            }
        });
    });

    $(document).on('click', '.deleteSmartNote', function () {
        var questionID = $("#smartpopup_question_id").val();
        var noteId = $(this).attr('noteid');
        swal({
            title: "Are you sure? You want to delete this note!",
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
                            url: '/admin/questions/deleteQuestionNote',
                            type: "POST",
                            data: {noteid: noteId},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    //window.location.href = '';
                                    loadQuestionSmartPopup(questionID, 'notes');
                                    $('.overlaynew').hide();
                                } else {
                                    alertMessage('Error: Some thing wrong!');
                                    $('.overlaynew').hide();
                                }
                            }
                        });
                    }
                });
    });

    $("#updateSmartNote").submit(function () {
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        var questionID = $("#smartpopup_question_id").val();
        $.ajax({
            url: '/admin/questions/updateQuestionNote',
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    
                    $("#editSmartNoteSection").modal('hide');
                    //window.location.href = '';
                    loadQuestionSmartPopup(questionID, 'notes');
                    $('.overlaynew').hide();
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
    });


    $(document).on('click', '.addSmartReplyComment', function () {

        var reviewID = $(this).prev().prev().val();
        var parentCommentId = $(this).prev().val();
        var tkn = $('meta[name="_token"]').attr('content');
        var commentContent = $(this).parent().prev().find('.comment_content').val();
        if (commentContent != '') {
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/comments/add_comment',
                type: "POST",
                data: {'reviweId': reviewID, 'parent_comment_id': parentCommentId, 'comment_content': commentContent,_token:tkn},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        //window.location.href = window.location.href;
                        loadSmartPopup(reviewID, 'review');
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');

                    }
                }
            });
        } else {
            alertMessage('Comment not found.');
        }
    });



    $("#updateSmartAnswer").submit(function () {
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        var questionID = $("#smartpopup_question_id").val();
        $.ajax({
            url: '/admin/questions/updateAnswer/',
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    //window.location.href = '';
                    
                    $("#editSmartAnswer").modal('hide');
                    loadQuestionSmartPopup(questionID, 'question');
                    $('.overlaynew').hide();
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
    });

    $(document).on('click', '.deleteSmartAnswer', function () {
        var answerID = $(this).attr("smart_answer_id");
        var questionID = $("#smartpopup_question_id").val();
        swal({
            title: "Are you sure? You want to delete this answer!",
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
                            url: '/admin/questions/delete_answer',
                            type: "POST",
                            data: {answerId: answerID},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {

                                    //window.location.href = '';
                                    loadQuestionSmartPopup(questionID, 'question');
                                    $('.overlaynew').hide();
                                } else {
                                    alertMessage('Error: Some thing wrong!');
                                    $('.overlaynew').hide();
                                }
                            }
                        });
                    }
                });
    });

    $(document).on("click", ".applySmartInsightTags", function () {
        var review_id = $(this).attr("reviewid");
        var feedback_id = $(this).attr("feedback_id");
        var action_name = $(this).attr("action_name");
        $.ajax({
            url: '/admin/tags/listAllTags',
            type: "POST",
            data: {review_id: review_id},
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
                    $("#tag_review_id").val(review_id);
                    $("#tag_feedback_id").val(feedback_id);
                    if (action_name == 'review-tag') {
                        $("#ReviewTagListModal").modal("show");
                    } else if (action_name == 'feedback-tag') {
                        $("#FeedbackTagListModal").modal("show");
                    }
                }
            }
        });
    });

    $("#frmSmartReviewTagListModal").submit(function () {
        var formdata = $("#frmSmartReviewTagListModal").serialize();
        $.ajax({
            url: '/admin/tags/applyReviewTag',
            type: "POST",
            data: formdata,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#ReviewTagListModal").modal("hide");
                    window.location.href = window.location.href;
                }
            }
        });
        return false;
    });

    $(document).on("submit", "#frmSmartSaveNote", function () {
        var formdata = $("#frmSmartSaveNote").serialize();
        $('.overlaynew').show();
        var questionID = $("#smartpopup_question_id").val();
        //$('.overlaynew').show();
        $.ajax({
            url: '/admin/questions/saveQuestionNotes',
            type: "POST",
            data: formdata,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    
                    loadQuestionSmartPopup(questionID, 'notes');
                    $('.overlaynew').hide();
                    //$("#ReviewTagListModal").modal("hide");
                    //window.location.href = window.location.href;
                }
            }
        });
        return false;
    });


    $(document).on('click', '#loadSmartMoreComment', function () {

        var numOfComment = $('#numOfComment').val();
        var revId = $(this).attr('revId');

        $('.loaderImage').removeClass('hidden');
        $.ajax({
            url: '/admin/reviewdetail/loadComment',
            type: "POST",
            data: {'reviewId': revId, 'offset': numOfComment, 'source': 'smartpopup'},
            dataType: "html",
            success: function (data) {

                if (data != '') {
                    $('.addMoreComment').append(data);
                    var offset = Number(numOfComment) + 5;
                    $('#numOfComment').val(offset);
                    $('.loaderImage').addClass('hidden');
                } else {
                    $('.loadMoreRecord').remove();
                }

            }, error() {
                $('.loaderImage').addClass('hidden');
            }
        });
        return false;

    });

});



