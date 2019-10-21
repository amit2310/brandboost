$(document).ready(function () {

    $('.addWorkflowEvent').click(function () {

        var actionid = $(this).attr('previous_event_id');
        var currentid = $(this).attr('current_event_id');
        var eventtype = $(this).attr('event_type');
        var nodetype = $(this).attr('data-node-type');
        var tabtype = $(this).attr('data-tab-type');
        $("#wf_action_previous_id").val(actionid);
        $("#wf_action_current_id").val(currentid);
        $("#wf_action_event_type").val(eventtype);
        $("#wf_action_node_type").val(nodetype);
        resetAddWorkFlowNodePopup();
        $("#wf_addnewaction").modal();
        if(tabtype == 'email'){
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').tab('show');
//            $('.nav-tabs a[href="#chooseWorkflowSMS"]').tab('hide');
            $('.nav-tabs a[href="#chooseWorkflowSMS"]').hide();
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').show();
        }else if(tabtype == 'sms'){
            
            $('.nav-tabs a[href="#chooseWorkflowSMS"]').tab('show');
//            $('.nav-tabs a[href="#chooseWorkflowEmail"]').tab('hide');
            $('.nav-tabs a[href="#chooseWorkflowSMS"]').show();
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').hide();
        }else{
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').tab('show');
            $('.nav-tabs a[href="#chooseWorkflowEmail"]').show();
            $('.nav-tabs a[href="#chooseWorkflowSMS"]').show();
        }
        
    });
    $('.wf_viewCampaignStats, .wf_hideCampaignStats').click(function () {

        var campId = $(this).attr('campaign_id');
        $("#wf_campaign_stats_" + campId).toggle('slow');
    });
    $('.wf_waitTime').click(function () {
        var eventID = $(this).attr('event_id');
        var delayValue = $(this).attr('delay_value');
        var delayUnit = $(this).attr('delay_unit');
        var delayTime = $(this).attr('delay_time');
        $('#wf_waitTime').modal();
        $('#wf_event_id_val').val(eventID);
        $('#wf_delay_time_value').val(delayValue);
        $('#wf_delay_time_unit').val(delayUnit);
        if (delayUnit == 'day' || delayUnit == 'week') {
            $("#pl2").show();
            $("#anytime-time-hours2").val(delayTime);
        }
    });
    $('.wf_eventTimeUpdate').on('submit', function (e) {
        e.preventDefault();
        var delayValue = $('#wf_delay_time_value').val();
        var delayUnit = $('#wf_delay_time_unit').val();
        var eventID = $('#wf_event_id_val').val();
        $.ajax({
            url: '/admin/workflow/updateEventTime',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('#wf_waitTime').modal('hide');
                    $('#wf_waitTime_' + eventID).html('Wait for ' + delayValue + ' ' + delayUnit + '(s)');
                    $('#wf_waitTime_' + eventID).attr('delay_value', delayValue);
                    $('#wf_waitTime_' + eventID).attr('delay_unit', delayUnit);
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
        return false;
    });
    $(document).on("click", ".selectWorkflowTemplate", function (e) {
        e.preventDefault();
        var templateId = $(this).attr('template_id');
        var previousID = $("#wf_action_previous_id").val();
        var currentID = $("#wf_action_current_id").val();
        var event_type = $("#wf_action_event_type").val();
        var node_type = $("#wf_action_node_type").val();
        var moduleName = $("#wf_action_moduleName").val();
        var moduleUnitId = $("#wf_action_module_unit_id").val();
        $.ajax({
            url: '/admin/workflow/addWorkflowEventToTree',
            type: "POST",
            data: {moduleName: moduleName, moduleUnitId: moduleUnitId, previous_event_id: previousID, templateId: templateId, campaign_type: 'Email', 'current_event_id': currentID, 'event_type': event_type, node_type: node_type},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('#wf_campaign_subject').val(data.subject);
                    $("#wf_campaign_content").html(data.content);
                    $("#wf_editor_campaign_content").data("wysihtml5").editor.setValue(data.content);
                    $('#wf_editor_campaign_id').val(data.campaign_id);
                    $('#workflow_template_modal').modal();
                    $('#wf_addnewaction').modal('hide');
                    //window.location.href = window.location.href;

                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }, error() {
                alertMessage('Error: Some thing wrong!');
            }
        });
    });
    $('.insert_tag_button').on('click', function () {
        var tagname = $(this).attr('data-tag-name');
        var wysihtml5Editor = $('#wf_editor_campaign_content').data("wysihtml5").editor;
        wysihtml5Editor.composer.commands.exec("insertHTML", tagname);
    });
    $('.wysihtml5-sandbox').contents().find('body').on('keyup', function (event) {

        var editor_desc = $("#wf_editor_campaign_content").data("wysihtml5").editor.getValue();
        $("#wf_campaign_content").html(editor_desc);
    });
    $('#wf_update_editor_campaign').on('click', function (e) {
        e.preventDefault();
        var moduleName = $("#wf_editor_moduleName").val();
        var subject = $("#wf_campaign_subject").val();
        var content = $('#wf_editor_campaign_content').val();
        var campaignId = $("#wf_editor_campaign_id").val();
        $.ajax({
            url: '/admin/workflow/updateWorkflowCampaign',
            type: "POST",
            data: {moduleName: moduleName, subject: subject, content: content, campaignId: campaignId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    alertMessage('Saved successfully!');
                    $('#workflow_template_modal').modal('hide');
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
        return false;
    });
    $(document).on("click", ".wf_editCampaign", function (e) {
        var campaignId = $(this).attr('campaign_id');
        var moduleName = $(this).attr('moduleName');
        if (campaignId != '' && moduleName != '') {
            $("#loadstripotemplate").attr("src", site_url + 'admin/workflow/loadStripoCampaign/' + moduleName + '/' + campaignId);
            $("#workflow_template_stripo_modal").modal();
        }

        return false;

    });

    $(document).on("click", ".wf_editSMSCampaign", function (e) {
        var campaignId = $(this).attr('campaign_id');
        var moduleName = $(this).attr('moduleName');

        $.ajax({
            url: '/admin/workflow/getWorkflowCampaign',
            type: "POST",
            data: {campaignId: campaignId, moduleName: moduleName},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.smsWorkflowCampaignPreview').html(data.createdVal + '<br>' + data.compiled_content.replace(/\r\n|\r|\n/g, "<br />"));
                    $('#wf_sms_editor_campaign_id').val(campaignId);
                    $('#smsWorkflowCampaignBody').attr('created_date', data.createdVal);
                    $('#smsWorkflowCampaignBody').val(data.compiled_content);
                    $('#workflow_sms_template_stripo_modal').modal();
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }, error() {
                alertMessage('Error: Some thing wrong!');
            }
        });

        return false;

    });

    $(document).on("keyup", '#smsWorkflowCampaignBody', function () {
        var createdDate = $(this).attr('created_date');
        var liveContent = $(this).val();
        liveContent = liveContent.replace(/\r\n|\r|\n/g, "<br />");

        if (liveContent == '') {
            $('.smsbubble').hide();
        } else {
            $('.smsbubble').show();
            $('.smsbubble').html(createdDate + '<br>' + liveContent);
        }
    });

    $('#updateWorkflowSmsCampaign').on('click', function (e) {
        e.preventDefault();
        var templateContent = $("#smsWorkflowCampaignBody").val();
        var campaignId = $("#wf_sms_editor_campaign_id").val();
        var moduleName = $('#wf_sms_editor_moduleName').val();
        $.ajax({
            url: '/admin/workflow/updateWorkflowCampaign',
            type: "POST",
            data: {stripo_compiled_html: templateContent, campaignId: campaignId, moduleName: moduleName},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = window.location.href;
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
        return false;
    });


    $(document).on("click", ".wf_previewCampaign", function (e) {
        var campaignId = $(this).attr('campaign_id');
        var moduleName = $(this).attr('moduleName');
        var moduleUnitId = $(this).attr('data-moduleaccountid')
        var campaignType = $(this).attr('campaignType');
        if (campaignId != '' && moduleName != '') {
            $.ajax({
                url: '/admin/workflow/previewWorkflowCampaign',
                type: "POST",
                data: {moduleName: moduleName, campaignId: campaignId, moduleUnitId: moduleUnitId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (campaignType == 'email') {
                            $("#wf_email_campaign_preview").html(data.content);
                            $('#workflow_email_campaign_preview').modal();
                        } else if (campaignType == 'sms') {
                            $("#wf_sms_campaign_preview").html(data.content.replace(/\r\n|\r|\n/g, "<br />"));
                            $('#workflow_sms_campaign_preview').modal();
                        }

                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });

        }

        return false;

    });


    $(".wf_deleteCampaign").click(function (e) {
        e.preventDefault();
        var event_id = $(this).attr('event_id');
        var moduleName = $(this).attr('moduleName');
        swal({
            title: "Are you sure? You want to delete this campaign!",
            text: "You will not be able to recover this campaign!",
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
                        $.ajax({
                            url: '/admin/workflow/deleteWorkflowEvent',
                            type: "POST",
                            data: {moduleName: moduleName, event_id: event_id},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    window.location.href = window.location.href;
                                } else {
                                    alertMessage('Error: Some thing wrong!');
                                }
                            }, error() {
                                alertMessage('Error: Some thing wrong!');
                            }
                        });
                    }
                });
    });



    $(document).on("click", "#createNewWorkflowEvent", function (e) {
        e.preventDefault();
        //check which email template selected
        var emailTemplateId = $("input[name='selectWorkflowEmailTemplate']:checked").val();

        var smsTemplateId = $("input[name='selectWorkflowSMSTemplate']:checked").val();

        var delayVal = $("#wf_delay_time_value_2").val();
        var delayUnit = $("#wf_delay_time_unit_2").val();

        //alert('Email Template Id ' + emailTemplateId + ' Sms Template Id '+ smsTemplateId + ' Delay Val ' + delayVal + ' Delay Unit ' + delayUnit);
        //return false;
        //var templateId = $(this).attr('template_id');
        var previousID = $("#wf_action_previous_id").val();
        var currentID = $("#wf_action_current_id").val();
        var event_type = $("#wf_action_event_type").val();
        var node_type = $("#wf_action_node_type").val();
        var moduleName = $("#wf_action_moduleName").val();
        var moduleUnitId = $("#wf_action_module_unit_id").val();
        $.ajax({
            url: '/admin/workflow/addWorkflowEventToTreeNew',
            type: "POST",
            data: {moduleName: moduleName, moduleUnitId: moduleUnitId, previous_event_id: previousID, emailTemplateId: emailTemplateId, smsTemplateId: smsTemplateId, delayVal: delayVal, delayUnit: delayUnit, 'current_event_id': currentID, 'event_type': event_type, node_type: node_type},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    /*$('#wf_campaign_subject').val(data.subject);
                     $("#wf_campaign_content").html(data.content);
                     $("#wf_editor_campaign_content").data("wysihtml5").editor.setValue(data.content);
                     $('#wf_editor_campaign_id').val(data.campaign_id);
                     $('#workflow_template_modal').modal();
                     $('#wf_addnewaction').modal('hide');*/
                    window.location.href = window.location.href;

                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }, error() {
                alertMessage('Error: Some thing wrong!');
            }
        });
    });

    $("#btnWfEmailNext").click(function () {
        if ($('.selectWorkflowEmailTemplate:checked').length > 0) {
            $('.nav-tabs a[href="#delayIntervalWorkflow"]').tab('show');
        } else {
            alertMessage('Please choose template');
        }


    });

    $("#btnWfSmsNext").click(function () {
        if ($('.selectWorkflowSMSTemplate:checked').length > 0) {
            $('.nav-tabs a[href="#delayIntervalWorkflow"]').tab('show');
        } else {
            alertMessage('Please choose template');
        }

        

    });

    $("#btnWfEmailClear").click(function () {
        $(".selectWorkflowEmailTemplate").each(function () {
            $(this).prop('checked', false);
        });
    });

    $("#btnWfSmsClear").click(function () {
        $(".selectWorkflowSMSTemplate").each(function () {
            $(this).prop('checked', false);
        });
    });

    $("#clearWFEventPopup").click(function () {
        resetAddWorkFlowNodePopup();
    });
});


function resetAddWorkFlowNodePopup() {
    $(".selectWorkflowEmailTemplate, .selectWorkflowSMSTemplate").each(function () {
        $(this).prop('checked', false);
    });


}