

var startingLimit = 0;
function loadSmartMoreComments(reviewID, startinglimitVal) {
    $('.overlaynew').show();
    $.ajax({
        url: '/admin/brandboost/getreviwecomments/',
        type: "POST",
        data: {'reviewId': reviewID, 'startinglimitVal': startinglimitVal, 'source': 'smartpopup'},
        dataType: "json",
        success: function (data) {
            $('.overlaynew').hide();
            if (data.status == 'success') {
                $('#commentDataList').append(data.commentList);
                startingLimit = parseInt(startinglimitVal) + 5;
                if (data.nunOfComment < 5) {
                    $('.loadMoreBtn').html('<a href="javascript:void(0);">No More Comments Found...</a>');
                } else {
                    $('.loadMoreBtn a').attr('onclick', 'loadSmartMoreComments(' + reviewID + ', ' + startingLimit + ')');
                }

            } else {
                $('.loadMoreBtn').html('<a href="javascript:void(0);">' + data.commentList + '</a>');
            }
        }, error() {
            $('.overlaynew').hide();
        }
    });
    return false;
}

function saveSmartCommentLikeStatus(commentID, statusType, reviewID) {
    $('.overlaynew').show();
    $.ajax({
        url: '/admin/reviews/saveCommentLikeStatus/',
        type: "POST",
        data: {'commentId': commentID, 'status': statusType},
        dataType: "json",
        success: function (data) {
            $('.overlaynew').hide();
            if (data.status == 'success') {
                //window.location.href = '';
                loadSmartPopup(reviewID, 'review');
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
        var status = $(this).attr('change_status');
        var comment_id = $(this).attr('comment_id');
        $.ajax({
            url: '/admin/comments/update_comment_status',
            type: "POST",
            data: {status: status, comment_id: comment_id},
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


    $(document).on('click', '.editSmartComment', function () {
        var commentID = $(this).attr('commentid');
        $.ajax({
            url: '/admin/comments/getCommentById',
            type: "POST",
            data: {commentID: commentID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var commentData = data.result[0];
                    $('#edit_smart_content').val(commentData.content);
                    $('#edit_smart_commentid').val(commentData.id);
                    $("#editSmartComment").modal();
                } else {

                }
            }
        });
    });

    $(document).on('click', '.editSmartNote', function () {
        var noteId = $(this).attr('noteid');
        $.ajax({
            url: '/admin/reviews/getReviewNoteById',
            type: "POST",
            data: {noteid: noteId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var noteData = data.result[0];
                    $('#edit_smart_note_content').val(noteData.notes);
                    $('#edit_smart_noteid').val(noteData.id);
                    $("#editSmartNoteSection").modal();
                } else {

                }
            }
        });
    });

    $(document).on('click', '.deleteSmartNote', function () {
        var reviewID = $(this).attr('reviewid');
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
					url: '/admin/reviews/deleteReviewNote',
					type: "POST",
					data: {noteid: noteId},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							//window.location.href = '';
							loadSmartPopup(reviewID, 'notes');
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
        var reviewID = $("#smartpopup_review_id").val();
        $.ajax({
            url: '/admin/reviews/update_note',
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
                    loadSmartPopup(reviewID, 'notes');
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
        var commentContent = $(this).parent().prev().find('.comment_content').val();
        if (commentContent != '') {
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/comments/add_comment',
                type: "POST",
                data: {'reviweId': reviewID, 'parent_comment_id': parentCommentId, 'comment_content': commentContent},
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



    $("#updateSmartComment").submit(function () {
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        var reviewID = $("#smartpopup_review_id").val();
        $.ajax({
            url: '/admin/comments/update_comment/',
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    //window.location.href = '';
                    $('.overlaynew').hide();
                    $("#editSmartComment").modal('hide');
                    loadSmartPopup(reviewID, 'review');
                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
    });

    $(document).on('click', '.deleteSmartComment', function () {
        var reviewID = $("#smartpopup_review_id").val();
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
					url: '/admin/comments/deleteComment',
					type: "POST",
					data: {commentId: commentId},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							
							//window.location.href = '';
							loadSmartPopup(reviewID, 'review');
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
        var reviewID = $("#reviewid").val();
        //$('.overlaynew').show();
        $.ajax({
            url: '/admin/reviews/saveReviewNotes',
            type: "POST",
            data: formdata,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    loadSmartPopup(reviewID, 'notes');
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



