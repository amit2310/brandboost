<style>
    .mobile_sms_bkg {
        background: url(<?php echo base_url(); ?>assets/images/iphone.png) center top no-repeat;
        width: 357px;
        height: 716px;
        margin: 0 auto;
        padding: 70px 40px;
    }
</style>
<?php
foreach ($aData as $aRec) {
    if ($aRec['moduleName'] == 'broadcast'):
        if ($aRec['moduleName'] == 'onsite') {
            $tabNumber = 1;
            $status = 'active';
        } else if ($aRec['moduleName'] == 'offsite') {
            $tabNumber = 2;
            $status = '';
        } else if ($aRec['moduleName'] == 'broadcast') {
            $tabNumber = 3;
            $status = '';
        } else if ($aRec['moduleName'] == 'referral') {
            $tabNumber = 4;
            $status = '';
        } else if ($aRec['moduleName'] == 'nps') {
            $tabNumber = 5;
            $status = '';
        }
        $iActiveRecord = 0;
        foreach ($aRec['templates'] as $oTemplate) {
            if ($oTemplate->status == '1') {
                $iActiveRecord++;
            }
        }
        ?>


                <!--    <div class="tab-pane <?php echo $status; ?>" id="right-icon-tab<?php echo $tabNumber; ?>">-->
        <div class="tab-pane active" id="right-icon-tab3">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 0;" class="panel panel-flat">
                        <div class="panel-heading"> <span class="pull-left">
                                <h6 class="panel-title"><?php echo $iActiveRecord; ?> Templates</h6>
                            </span>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body p0">
                            <table class="table datatable-basic datatable-sorting">
                                <thead>
                                    <tr>
                                        <th><i class="icon-user"></i> Template Name</th>
                                        <th><i class="icon-iphone"></i> Type</th>
                                        <th><i class="icon-iphone"></i> App Name</th>
                                        <th><i class="icon-iphone"></i> Subject</th>
                                        <th><i class="icon-calendar"></i> Created</th>
                                        <th class="text-center"><i class="fa fa-dot-circle-o"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--=======================-->
                                    <?php foreach ($aRec['templates'] as $oTemplate) { ?>
                                        <?php if ($oTemplate->status == '1' || $oTemplate->status == 'active'): ?>
                                            <tr>
                                                <td>
                                                    <?php echo ucfirst($oTemplate->template_name); ?>
                                                </td>

                                                <td>
                                                    <?php echo ucfirst($oTemplate->template_type); ?>
                                                </td>

                                                <td>
                                                    <?php echo ucfirst($aRec['moduleName']); ?>
                                                </td>

                                                <td>
                                                    <?php echo $oTemplate->template_subject; ?>
                                                </td>

                                                <td>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oTemplate->created)); ?></a></div>
                                                        <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oTemplate->created)); ?></div>
                                                    </div>

                                                </td>





                                                <td style="text-align: center;">
                                                    <a class="btn green_cust_btn <?php if (strtolower($oTemplate->template_type) == 'sms'): ?>wf_editSMSTemplate<?php else: ?>editDefaultTemplate<?php endif; ?>" template_id="<?php echo $oTemplate->id; ?>" moduleName="<?php echo $aRec['moduleName']; ?>"><i class="fa fa-eye"></i></a>
                                                    <?php if ($oTemplate->write_permission): ?>
                                                        <a class="btn red deleteDefaultTemplate" template_id="<?php echo $oTemplate->id; ?>" moduleName="<?php echo $aRec['moduleName']; ?>"><i class="fa fa-trash"></i></a>
                                                    <?php else: ?>
                                                        <a class="btn red"><i class="fa fa-trash" style="color:#ccc;"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
    endif;
}
?>
<div id="workflow_template_stripo_modal" class="modal fade">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add / Edit Email Template</h5>
            </div>
            <div class="modal-body template_edit">
                <form method="post" class="form-horizontal" action="javascript:void();">
                    <div class="row">
                        <div class="col-md-12">
                            <iframe src="" id="loadstripotemplate" width="100%" height="800"></iframe>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="workflow_sms_template_stripo_modal" class="modal fade">
    <div style="max-width: 760px;" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Edit SMS Template</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" class="form-horizontal" id="saveWorkflowSmsTemplate" action="javascript:void();">
                        <div class="col-md-6">
                            <div id="partEditable" style="display:none;">
                                <!--                            <div class="form-group">
                                                                <label>Greetings: </label>
                                                                <input type="text" required="required" name="greeting" id="wfSMSTemplateGreetings" class="form-control" placeholder="Greetings" />
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label>Introduction: </label>
                                                                <textarea style="height: 100px;" name="introduction" id="wfSMSTemplateIntroduction" class="form-control" placeholder="Introduction"></textarea>
                                                            </div>-->
                            </div>

                            <div class="form-group">
                                <label>Body: </label>
                                <textarea style="height: 200px;" created_date="" name="smsWorkflowTemplateBody" id="smsWorkflowTemplateBody" class="form-control" placeholder="SMS body"></textarea>
                            </div>

                            <?php if (!empty($aData['oCampaignTags'])): ?>
                                <div class="form-group">
                                    <div class="note-btn-group btn-group note-view">
                                        <?php foreach ($aData['oCampaignTags'] as $oTags): ?>
                                            <button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo $oTags; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo $oTags; ?></button>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>


                        <div class="col-md-6">
                            <div class="sms_preview">
                                <div class="phone_sms">
                                    <div class="inner smsWorkflowTemplatePreview">

                                    </div>
                                    <div class="clearfix"></div>
                                    <p><small><?php echo date("h:i") . ' ' . dataFormat(); ?></small></p>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12 text-right mt-20">
                            <input type="hidden" name="wf_editor_campaign_id" id="wf_sms_editor_template_id" value="">
                            <input type="hidden" name="wf_editor_moduleName" id="wf_sms_editor_moduleName" value="<?php echo $moduleName; ?>">
                            <button class="btn pull-right bl_cust_btn btn-success" type="submit" id="updateWorkflowSmsCampaign"><i class="fa fa-plus"></i> &nbsp; Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $('.insert_tag_button').on('click', function () {

        var dataTagName = $(this).attr('data-tag-name');
        var campaignTempBody = $('#smsWorkflowTemplateBody').val();
        $('#smsWorkflowTemplateBody').val(campaignTempBody + dataTagName);
        $('#smsWorkflowTemplateBody').focus();
    });

    $(document).on("click", ".wf_editSMSTemplate", function (e) {
        var templateId = $(this).attr('template_id');
        var moduleName = $(this).attr('moduleName');
        if (moduleName == 'automation') {
            $("#partEditable").hide();
        } else {
            $("#partEditable").show();
        }

        $.ajax({
            url: '/admin/workflow/getWorkflowTemplate',
            type: "POST",
            data: {templateId: templateId, moduleName: moduleName,_token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.smsWorkflowTemplatePreview').html(data.compiled_content);
                    $('#wf_sms_editor_template_id').val(templateId);
                    //$('#smsWorkflowTemplateBody').attr('created_date', data.createdVal);
                    $('#smsWorkflowTemplateBody').val(data.compiled_content.replace(/<br *\/?>/gi, '\n'));
                    $("#wf_sms_editor_moduleName").val(moduleName);
                    $("#wfSMSTemplateGreetings").val(data.greeting);
                    $("#wfSMSTemplateIntroduction").html(data.introduction);

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

    $('#smsWorkflowTemplateBody').keyup(function () {

        if ($(this).val() == '') {
            $('.smsWorkflowTemplatePreview').hide();
        } else {
            $('.smsWorkflowTemplatePreview').show();
            liveContent = $(this).val();
            liveContent = liveContent.replace(/\r\n|\r|\n/g, "<br />");
            $('.smsWorkflowTemplatePreview').html(liveContent);
        }
    });

    $('#updateWorkflowSmsCampaign').on('click', function (e) {
        e.preventDefault();
        var templateContent = $(".smsWorkflowTemplatePreview").html();
        var templateId = $("#wf_sms_editor_template_id").val();
        var moduleName = $('#wf_sms_editor_moduleName').val();
        var greeting = $('#wfSMSTemplateGreetings').val();
        var introduction = $('#wfSMSTemplateIntroduction').val();
        $.ajax({
            url: '/admin/workflow/updateWorkflowTemplate',
            type: "POST",
            data: {stripo_compiled_html: templateContent, templateId: templateId, moduleName: moduleName, greeting: greeting, introduction: introduction},
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

    $(document).on("click", ".editDefaultTemplate", function (e) {
        var templateID = $(this).attr('template_id');
        var moduleName = $(this).attr('moduleName');
        if (templateID != '' && moduleName != '') {
            $("#loadstripotemplate").attr("src", '<?php echo base_url(); ?>admin/workflow/loadStripoTemplate/' + moduleName + '/' + templateID);
            $("#workflow_template_stripo_modal").modal();

        }
    });

    $(document).on('click', '.deleteDefaultTemplate', function () {
        var elem = $(this);
        swal({
            title: "Are you sure? You want to delete this template!",
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
                        var templateID = $(elem).attr('template_id');
                        var moduleName = $(elem).attr('moduleName');
                        $.ajax({
                            url: '<?php echo base_url('admin/workflow/deleteWorkflowTemplate'); ?>',
                            type: "POST",
                            data: {moduleName: moduleName, templateID: templateID, _token: '{{csrf_token()}}'},
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
    });
</script>    