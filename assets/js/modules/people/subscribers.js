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

    $(document).on("click", ".moveToArchiveModuleContact", function () {
        var subscriberId = $(this).attr('data-modulesubscriberid');
        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');
        var csrf_token = $(this).attr('csrf_token');
        $.ajax({
            url: '/admin/subscriber/moveToArchiveModuleContact',
            type: "POST",
            data: {
                    subscriberId: subscriberId, 
                    moduleName: moduleName, 
                    moduleUnitId: moduleUnitId, 
                    _token: csrf_token
                },
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

    $(document).on('click', '.changeModuleContactStatus', function () {
        var contactStatus = $(this).attr('data_status');
        var subscriberId = $(this).attr('data-modulesubscriberid');
        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');
        var csrf_token = $(this).attr('csrf_token');

        $.ajax({
            url: '/admin/subscriber/changeModuleContactStatus',
            type: "POST",
            data: {
                    contactStatus: contactStatus, 
                    subscriberId: subscriberId, 
                    moduleName: moduleName, 
                    moduleUnitId: moduleUnitId,
                    _token: csrf_token
                },
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    //alertMessageAndRedirect(data.msg, window.location.href);
                    window.location.href = window.location.href;
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
    });

    $(document).on('click', '.deleteModuleSubscriber', function () {
        var subscriberId = $(this).attr('data-modulesubscriberid');
        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');


        deleteConfirmationPopup(
        "This contact will deleted immediately.<br>You can't undo this action.", 
        function() {

            $('.overlaynew').show();
            $.ajax({
                url: "/admin/subscriber/deleteModuleSubscriber",
                type: "POST",
                data: {subscriberId: subscriberId, moduleName: moduleName, moduleUnitId: moduleUnitId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        syncContactSelectionSources();
                        setTimeout(function(){
                            location.reload();
                        }, 1500);
                        
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

    $(document).on('click', '.editDataList', function () {
        $('.editAction').toggle();
        if ($("#checkAll").is(":visible") == false) {
            $("#deleteBulkModuleContacts").hide();
            $("#archiveBulkModuleContacts").hide();
            $(".checkRows").prop('checked', false);
            $("#checkAll").prop('checked', false);
            $("[id^=append]").each(function () {
                $(this).removeClass('success');
            });

        }

    });




    $(document).on('click', '#deleteBulkModuleContacts', function () {

        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');

        var val = [];
        $('.checkRows:checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });
        if (val.length === 0) {
            alert('Please select a row.')
        } else {

            deleteConfirmationPopup(
            "This contact will deleted immediately.<br>You can't undo this action.", 
            function() {

                $('.overlaynew').show();
                $.ajax({
                    url: "/admin/subscriber/deleteBulkModuleContacts",
                    type: "POST",
                    data: {multipalSubscriberId: val, moduleName: moduleName, moduleUnitId: moduleUnitId},
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


    $(document).on('click', '#archiveBulkModuleContacts', function () {
		
        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');

        var val = [];
        $('.checkRows:checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });
        if (val.length === 0) {
            alert('Please select a row.')
        } else {

            archiveConfirmationPopup(
            "This contact will move to archive immediately.<br>You can't undo this action.", 
            function() {

                $('.overlaynew').show();
                $.ajax({
                    url: "/admin/subscriber/archiveBulkModuleContacts",
                    type: "POST",
                    data: {multipalSubscriberId: val, moduleName: moduleName, moduleUnitId: moduleUnitId},
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




    $(document).on("click", ".applyInsightTags", function () {
        var subscriberId = $(this).attr("data-subscriber-id");
        var tkn = $('meta[name="_token"]').attr('content');
        $.ajax({
            url: '/admin/tags/getSubscriberTags',
            type: "POST",
            data: {_token: tkn,subscriberId: subscriberId},
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
                    $("#tag_subscriber_id").val(subscriberId);
                    $("#subscriberTagListsModal").modal("show");
                }else{
					$('.overlaynew').hide();
				}
            }
        });
    });

    $("#frmSubscriberApplyTag").submit(function () {
        var formdata = $("#frmSubscriberApplyTag").serialize();
        var subscriberID = $("#tag_subscriber_id").val();
        var tkn = $('meta[name="_token"]').attr('content');
        $.ajax({
            url: '/admin/tags/applySubscriberTag',
            type: "POST",
            data: formdata + '&_token=' + tkn,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    
                    $("#subscriberTagListsModal").modal("hide");
                    $("#tag_container_" + subscriberID).html(data.refreshTags);
                    syncContactSelectionSources();
                    //window.location.href = window.location.href;
                }
            }
        });
        return false;
    });



    $(document).on('click', '.editArchiveDataList', function () {
        $('.editArchiveAction').toggle();
        if ($("#checkArchiveAll").is(":visible") == false) {
            $("#deleteBulkArchiveModuleContacts").hide();
            $("#activeBulkModuleContacts").hide();
            $(".checkArchiveRows").prop('checked', false);
            $("#checkArchiveAll").prop('checked', false);
            $("[id^=append]").each(function () {
                $(this).removeClass('success');
            });

        }

    });

    $('#checkArchiveAll').change(function () {
        if (false == $(this).prop("checked")) {
            $(".checkArchiveRows").prop('checked', false);
            $(".selectedClass").removeClass('success');
            $('.custom_archive_action_box').hide();
        } else {

            $(".checkArchiveRows").prop('checked', true);
            $(".selectedClass").addClass('success');
            $('.custom_archive_action_box').show();
        }
    });

    $(document).on('click', '.checkArchiveRows', function () {
        var inc = 0;
        var rowId = $(this).val();

        if (false == $(this).prop("checked")) {
            $('#append-' + rowId).removeClass('success');
        } else {
            $('#append-' + rowId).addClass('success');
        }

        $('.checkArchiveRows:checkbox:checked').each(function (i) {
            inc++;
        });

        if (inc == 0) {
            $('.custom_archive_action_box').hide();
        } else {
            $('.custom_archive_action_box').show();
        }

        var numberOfChecked = $('.checkArchiveRows:checkbox:checked').length;
        var totalCheckboxes = $('.checkArchiveRows:checkbox').length;
        if (totalCheckboxes > numberOfChecked) {
            $('#checkArchiveAll').prop('checked', false);
        }
    });


    $(document).on('click', '#deleteBulkArchiveModuleContacts', function () {

        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');

        var val = [];
        $('.checkArchiveRows:checkbox:checked').each(function (i) {
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
                                url: '/admin/subscriber/deleteBulkModuleContacts',
                                type: "POST",
                                data: {multipalSubscriberId: val, moduleName: moduleName, moduleUnitId: moduleUnitId},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        window.location.href = window.location.href
                                    } else {
                                        alertMessage('Error: Some thing wrong!');
                                        $('.overlaynew').hide();
                                    }
                                }
                            });
                        }
                    });
        }
    });


    $(document).on('click', '#activeBulkModuleContacts', function () {

        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');

        var val = [];
        $('.checkArchiveRows:checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });
        if (val.length === 0) {
            alert('Please select a row.')
        } else {

            var elem = $(this);
            swal({
                title: "Are you sure? You want to make this record active!",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, make active!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.overlaynew').show();
                            $.ajax({
                                url: '/admin/subscriber/activeBulkModuleContacts',
                                type: "POST",
                                data: {multipalSubscriberId: val, moduleName: moduleName, moduleUnitId: moduleUnitId},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        window.location.href = window.location.href
                                    } else {
                                        alertMessage('Error: Some thing wrong!');
                                        $('.overlaynew').hide();
                                    }
                                }
                            });
                        }
                    });
        }
    });

    $(document).on("click", ".moveToActiveModuleContact", function () {
        var subscriberId = $(this).attr('data-modulesubscriberid');
        var moduleName = $(this).attr('data-modulename');
        var moduleUnitId = $(this).attr('data-moduleaccountid');
        $.ajax({
            url: '/admin/subscriber/moveToActiveModuleContact',
            type: "POST",
            data: {subscriberId: subscriberId, moduleName: moduleName, moduleUnitId: moduleUnitId},
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





});