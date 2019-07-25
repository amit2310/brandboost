<style>
    .emailtempsec{width: calc(100% - 190px);}
    .template_row{width: 187px; display: inline-block;}
    .template_row td{padding: 0!important;}
    /*    .datatable-footer{background: none!important; border:none!important; box-shadow: none; padding:10px 0 0 0 !important}
        .dataTables_paginate{margin-bottom: 5px!important}*/
    .heading-elements .form-control.input-sm{background: none!important; padding: 0 60px 0 11px !important;}
    .heading-elements .has-feedback-left .form-control-feedback {right: 30px;}

</style>
<?php
$templateCount = 0;
$tempName = (strtolower($oBroadcast->campaign_type) == 'email') ? 'email' : 'sms';
if (!empty($oDefaultTemplates)) {
    foreach ($oDefaultTemplates as $oTemplate) {
        if (($oTemplate->status == '1') && (strtolower($oTemplate->template_type) == $tempName)) {
            $templateCount++;
        }
    }
}
?>

<div id="broadcastSelectTemplate" class="broadcastTab" <?php if ($activeTab != 'Choose Template'): ?> style="display:none;"<?php endif; ?>>
    <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
        @include('admin.templates.emails.email-template-index', ["campaign_type" => 'email'])
    <?php else: ?>
        @include('admin.templates.sms.sms-template-index', ["campaign_type" => 'sms'])
    <?php endif; ?>
</div>




<script>
    $(document).ready(function () {

        $(document).on('change', '.continueChooseTemplateButton, .continueChooseSMSTemplateButton', function () {
            var broadcast_id = '<?php echo $broadcast_id; ?>';
            var template_id = $(this).attr('template_id');
            var source = $(this).attr('source');

            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addCampaignToBroadcast'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', broadcast_id: broadcast_id, template_id: template_id, source: source},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                            var editorURL = '<?php echo base_url("admin/workflow/loadStripoCampaign/$moduleName/{$oBroadcast->id}/{$oBroadcast->broadcast_id}"); ?>';
                            $("#loadstripotemplate").attr("src", editorURL);
                        <?php endif; ?>
                        <?php if (strtolower($oBroadcast->campaign_type) == 'sms'): ?>
                            //$("a.continueButton:contains('SMS Editor')").trigger("click");
                            //window.location.href = '';
                            $("#broadcastDesignTemplate").html(data.editorData);
                        <?php endif; ?>
                        //window.location.href = '';

                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();

                    }

                }
            });
        });





        $(document).on("click", ".deleteWorflowDraft", function (e) {

            var templateID = $(this).attr('template_id');
            var moduleName = $(this).attr('modulename');

            deleteConfirmationPopup(
                    "This draft will deleted immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();

                        $.ajax({
                            url: "<?php echo base_url('admin/workflow/deleteWorkflowDraft'); ?>",
                            type: "POST",
                            data: {_token: '{{csrf_token()}}', moduleName: moduleName, template_id: templateID},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    displayMessagePopup('success', '', ' Draft has been deleted successfully');
                                    window.location.href = '';
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






    });
</script>
