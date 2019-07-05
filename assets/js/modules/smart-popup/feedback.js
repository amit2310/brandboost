

var startingLimit = 0;

$(document).ready(function () {


    $(document).on('click', '.editSmartNote', function () {
        var noteId = $(this).attr('noteid');
        $.ajax({
            url: '/admin/feedback/getFeedbackNotes',
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
        var feedbackID = $("#smartpopup_feedback_id").val();
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
                            url: '/admin/feedback/deleteFeedbackNote',
                            type: "POST",
                            data: {noteid: noteId},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    //window.location.href = '';
                                    loadSmartPopup(feedbackID, 'notes');
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
        var feedbackID = $("#smartpopup_feedback_id").val();
        $.ajax({
            url: '/admin/feedback/updateFeedbackNote',
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    $("#editSmartNoteSection").modal('hide');
                    //window.location.href = '';
                    loadSmartPopup(feedbackID, 'notes');
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
    });
    
    $(document).on('click', '.deleteSmartComment', function () {
        var feedbackID = $("#smartpopup_feedback_id").val();
        var commentId = $(this).attr('commentid');
        swal({
            title: "Are you sure? You want to delete this comment!",
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
                            url: '/admin/feedback/deleteFeedbackComment',
                            type: "POST",
                            data: {commentId: commentId},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    
                                    //window.location.href = '';
                                    loadSmartPopup(feedbackID, 'feedback');
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
    
    $(document).on('click', '#loadSmartMoreComment', function () {

        var numOfComment = $('#numOfComment').val();
        var feedbackID = $("#smartpopup_feedback_id").val();

        $('.loaderImage').removeClass('hidden');
        $.ajax({
            url: '/admin/feedback/loadFeedbackComment',
            type: "POST",
            data: {'fid': feedbackID, 'offset': numOfComment, 'source': 'smartpopup'},
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

    $(document).on("submit", "#frmSmartSaveNote", function () {
        var formdata = $("#frmSmartSaveNote").serialize();
        var feedbackID = $("#smartpopup_feedback_id").val();
        //$('.overlaynew').show();
        $.ajax({
            url: '/admin/feedback/saveFeedbackNotes',
            type: "POST",
            data: formdata,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    loadSmartPopup(feedbackID, 'notes');
                    //$("#ReviewTagListModal").modal("hide");
                    //window.location.href = window.location.href;
                }
            }
        });
        return false;
    });    

});



