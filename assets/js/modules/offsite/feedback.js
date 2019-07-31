
$(document).ready(function () {

    // Setup - add a text input to each footer cell
    $('#offsiteFeedback thead tr').clone(true).appendTo('#offsiteFeedback thead');

    $('#offsiteFeedback thead tr:eq(1) th').each(function (i) {


        if (i === 12) {
            var title = $(this).text();
            $(this).html('<input type="text" id="filterBy" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function () {
                if (tableBase.column(i).search() !== this.value) {
                    tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                }
            });
        }
        if (i === 4) {
            var title = $(this).text();
            $(this).html('<input type="text" id="startRate" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function () {
                if (tableBase.column(i).search() !== this.value) {
                    tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                }
            });
        }


    });

    $(document).on('click', '.filterByColumn', function () {

        $('.nav-tabs').each(function (i) {
            $(this).children().removeClass('active');
        });
        $(this).parent().addClass('active');
        var fil = $(this).attr('fil');
        $('#filterBy').val(fil);
        $('#filterBy').keyup();

        if (fil.length == 0) {
            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs ml20 btn_white_table');
            });
            $('#startRate').val('');
            $('#startRate').keyup();
            $('.heading_links a:eq(0)').addClass('btn btn-xs ml20 btn_white_table');
            tableBase.draw();
        }
    });


    // Basic datatable
    var tableIdF = 'offsiteFeedback';
    var tableBase = custom_data_table(tableIdF);



    $("#frmFeedbackTagListModal").submit(function () {
        var formdata = $("#frmFeedbackTagListModal").serialize();
        $.ajax({
            url: '/admin/tags/applyFeedbackTag',
            type: "POST",
            data: formdata,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#feedback_tag_" + data.id).html(data.refreshTags);
                    $("#FeedbackTagListModal").modal("hide");
                    //window.location.href = '';
                }
            }
        });
        return false;
    });

    

    $(document).on("click", ".editBrandboost", function () {
        var brandboostID = $(this).attr('brandID');
        $.ajax({
            url: '/admin/brandboost/update_offsite_step1',
            type: "POST",
            data: {'brandboostID': brandboostID, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {

                if (data.status == 'success') {
                    window.location.href = '/admin/brandboost/offsite_step_2';
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
    });

    $(document).on("click", ".displayFeedback", function () {
        var elem = $(this);
        var fid = $(this).attr("feedback_id");
        var tabtype = $(this).attr('fb_tab_type');
        var fbtime = $(this).attr('fb_time');
        displayFeedbackPopup(fid, tabtype, fbtime);

    });

    function displayFeedbackPopup(feedbackid, tabtype, fbtime) {
        //$('.overlaynew').show();
        $.ajax({
            url: "/admin/feedback/displayfeedback",
            type: "POST",
            data: {fid: feedbackid, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    $('.overlaynew').hide();
                    $("#feedbackContent").html(response.popup_data);
                    $(".feedbackTime").html(fbtime);
                    $("#feedbackPopup").modal("show");
                    if (tabtype == 'note') {
                        $('.tabbable a[href="#note-tab"]').trigger('click');
                    } else {
                        $('.tabbable a[href="#feedback-tab"]').trigger('click');
                    }
                }
            },
            error: function (response) {
                alertMessage(response.message);
            }
        });
    }

    $(document).on("click", "#sendFeedbackEmail, #sendFeedbackSMS", function () {
        var career = $(this).attr("career_medium");
        var alertMsg = 'One credit will be deducted for sending this email/sms!';
        if (career == 'sms') {
            alertMsg = 'One credit will be deducted for sending this sms!';
        } else {
            alertMsg = 'One credit will be deducted for sending this email!';
        }

        swal({
            title: "Are you sure?",
            text: alertMsg,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, send it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
		function (isConfirm) {
			if (isConfirm) {
				var formdata = $("#frmSendFeedbackReply").serialize();
				$('.overlaynew').show();
				$.ajax({
					url: "/admin/feedback/replyFeedback",
					type: "POST",
					data: formdata + "&career=" + career,
					dataType: "json",
					success: function (response) {
						$('.overlaynew').hide();
						if (response.status == "success") {
							swal({
								title: "Success!",
								text: response.message,
								confirmButtonColor: "#66BB6A",
								type: "success"
							});
						} else {
							swal({
								title: "ERROR!",
								text: response.message,
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					},
					error: function (response) {
						$('.overlaynew').hide();
						swal({
							title: "ERROR!",
							text: response.message,
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			} else {
				swal({
					title: "Cancelled",
					text: "",
					confirmButtonColor: "#2196F3",
					type: "error"
				});
			}
		});
    });

    $(document).on("click", "#saveFeedbackNote", function () {
        var formdata = $("#frmSaveNote").serialize();
        $('.overlaynew').show();
        $.ajax({
            url: "/admin/feedback/saveFeedbackNotes",
            type: "POST",
            data: formdata,
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    var fid = $("input[name='fid']").val();
                    var fbtime = $("input[name='fbtime']").val();
                    var tabtype = 'note';
                    displayFeedbackPopup(fid, tabtype, fbtime);
                }
            },
            error: function (response) {
                alertMessage(response.message);
            }
        });
    });

    $(document).on("click", ".updateFeedbackStatus", function () {
		alert(1);
        /*$('.overlaynew').show();
        var feedbackid = $("input[name='fid']").val();
        var fbtime = $("input[name='fbtime']").val();
        var statusVal = $(this).attr('fb_status');
        $.ajax({
            url: "/admin/feedback/updateFeedbackRatings",
            type: "POST",
            data: {fid: feedbackid, status: statusVal, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    displayFeedbackPopup(feedbackid, 'feedback', fbtime);
                    alertMessage(response.message);
                    $('.reiewStatus' + feedbackid).html(statusVal);
                    var statusCls = '';
                    if (statusVal == 'Neutral') {
                        statusCls = 'bg-blue';
                    } else if (statusVal == 'Negative') {
                        statusCls = 'bg-danger';
                    } else {
                        statusCls = 'bg-success';
                    }
                    $('.reiewStatus' + feedbackid).removeClass('bg-success');
                    $('.reiewStatus' + feedbackid).removeClass('bg-danger');
                    $('.reiewStatus' + feedbackid).removeClass('bg-blue');
                    $('.reiewStatus' + feedbackid).addClass(statusCls);
                    var statusStarVal = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                    if (statusVal == 'Neutral') {
                        statusStarVal = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i>';
                    } else if (statusVal == 'Negative') {
                        statusStarVal = '<i class="fa fa-star"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i><i class="fa fa-star fastar"></i>';
                    }
                    $('#ratingBoxStatus' + feedbackid).html(statusStarVal);
                }
            },
            error: function (response) {
                alertMessage(response.message);
            }
        });*/
    });


    $(document).on("click", ".updateFeedbackStatus2", function () {
		alert(3);
        /*$('.overlaynew').show();
        var feedbackid = $(this).attr('feedback_id');
        var statusVal = $(this).attr('fb_status');
        $.ajax({
            url: "/admin/feedback/updateFeedbackRatings",
            type: "POST",
            data: {fid: feedbackid, status: statusVal, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (response) {
                $('.overlaynew').hide();
                if (response.status == "success") {
                    window.location.href = '';
                }
            },
            error: function (response) {
                $('.overlaynew').hide();
                alertMessage(response.message);
            }
        });*/
    });


    

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
            $('#append-feedback-' + rowId).removeClass('success');
        } else {
            $('#append-feedback-' + rowId).addClass('success');
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

        if (totalCheckboxes == numberOfChecked) {
            $('#checkAll').prop('checked', true);
        }
    });

    $(document).on('click', '#deleteButtonBrandboostFeedbacks', function () {

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
						url: 'admin/feedback/deleteMultipalFeedbackData',
						type: "POST",
						data: {multi_feedback_id: val, _token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							}
						}
					});
				}
			});
        }
    });

    $(document).on('click', '.editDataList', function () {
        $('.editAction').toggle();
    });
});


