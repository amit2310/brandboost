<?php
$aUser = getLoggedUser();
$userID = $aUser->id;
$bHaveStaticTemplates = '';
$broadcast_id = (isset($broadcast_id)) ? $broadcast_id : '';
$selected_template = (isset($selected_template)) ? $selected_template : '';
$source = (isset($source)) ? $source : '';
$bYesSelected = (isset($bYesSelected)) ? $bYesSelected : '';
$method = (isset($method)) ? $method : '';
 



?>
<style>
    .emailtempsec{width: calc(100% - 190px);}
    .template_row{width: 187px; display: inline-block;}
    .template_row td{padding: 0!important;}
    /*    .datatable-footer{background: none!important; border:none!important; box-shadow: none; padding:10px 0 0 0 !important}
        .dataTables_paginate{margin-bottom: 5px!important}*/
    .heading-elements .form-control.input-sm{background: none!important; padding: 0 60px 0 11px !important;}
    .heading-elements .has-feedback-left .form-control-feedback {right: 30px;}
    .content-wrapper::before {height: 210px!important;}
    .temp_more_opt{
        position: absolute;
        width: 24px;
        height: 24px;
        right: 0px;
        top: 0;
        border-radius: 0 5px 0;
        background: #fff;
        box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.20);
        z-index:99;
    }

</style>
<div id="chooseSMSTemplate">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading br5"> 
                    <span class="pull-left">
                        <h6 class="panel-title">Select SMS Template</h6>
                    </span>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_search.png" width="14"></i>
                            </div>
                        </div>
                        <div class="table_action_tool">
                            <a href="#" class="brig pr-15">Filter &nbsp; <i class=""><img style="width: 11px!important; height: 10px!important" src="assets/images/icon_filter.png"></i></a>
                            <a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"></i></a>
                            <a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a>
                            <a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a>
                            <a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_edit.png"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2" style="max-width: 187px!important;">
            <div class="white_box p25 mb20 pt-15 pb-15">
                <ul class="select_template">
                    <li><a href="javascript:void(0);">Recent Email</a></li>
                    <li><a href="javascript:void(0);">My Email</a></li>
                    <li><a class="displaySMSTemplates" selected_template="" action="my" href="javascript:void(0);">My Templates</a></li>
                    <hr>
                    <?php if (in_array($moduleName, array('brandboost', 'onsite', 'offsite', 'nps', 'referral'))): ?>
                        <?php foreach ($oCategories as $oCategory): ?>
                            <?php if ($oCategory->status == '2'): $bHaveStaticTemplates = true; ?>
                                <?php if ($moduleName == 'brandboost' && $brandboostData->review_type == 'onsite' && $oCategory->module_name == 'onsite'): ?>
                                    <li><a class="displaySMSTemplates" selected_template="" action="category" category_id="<?php echo $oCategory->id; ?>" href="javascript:void(0);"><?php echo $oCategory->category_name; ?></a></li>
                                <?php elseif ($moduleName == 'brandboost' && $brandboostData->review_type == 'offsite' && $oCategory->module_name == 'offsite'): ?>
                                    <li><a class="displaySMSTemplates" selected_template="" action="category" category_id="<?php echo $oCategory->id; ?>" href="javascript:void(0);"><?php echo $oCategory->category_name; ?></a></li>
                                <?php elseif ($oCategory->module_name == $moduleName): ?>
                                    <li><a class="displaySMSTemplates" selected_template="" action="category" category_id="<?php echo $oCategory->id; ?>" href="javascript:void(0);"><?php echo $oCategory->category_name; ?></a></li>
                                <?php endif; ?>
                            <?php endif; ?>    
                        <?php endforeach; ?>
                    <?php endif; ?>    
                    <?php if ($bHaveStaticTemplates == true): ?>
                        <hr>    
                    <?php endif; ?> 
                    <hr>
                    <li><a class="active displaySMSTemplates" selected_template="" action="all" href="javascript:void(0);">All Templates</a></li>
                    <?php foreach ($oCategories as $oCategory): ?>
                        <li><a class="displaySMSTemplates" selected_template="" action="category" category_id="<?php echo $oCategory->id; ?>" href="javascript:void(0);"><?php echo $oCategory->category_name; ?></a></li>

                    <?php endforeach; ?>

                    <hr>
                    <li><a class="displaySMSTemplates" selected_template="" action="category" category_id="5" href="javascript:void(0);">Plain Text</a></li>

                </ul>
            </div>
        </div>
        <input type="hidden" id="hidBroadcastID" name="broadcast_id" value="<?php echo $broadcast_id; ?>" />
        <div class="col-md-10 mb20 emailtempsec" id="categorized_sms_template_list">
            <div class="top"></div>
            <table class="table" id="tblSMSTemplate" style="background: none!important; width: 100%!important;">
                <thead class="hidden">
                    <tr style="display: none;">
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>

                        <th><i class="icon-image2"></i>Template Name</th>
                        <th style="display: none;"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($selected_template) && ($selected_template > 0)) {
                        foreach ($oTemplates as $oTemplate) {
                            if ($oTemplate->id == $selected_template) {
                                if (($oTemplate->status == '1') && (strtolower($oTemplate->template_type) == 'sms')):
                                    ?>
                                    <tr class="template_row">
                                        <td style="display: none;"></td>
                                        <td style="display: none;"><?php echo $oTemplate->id; ?>99999999</td>
                                        <td>
                                            <div class="white_box template_preview sms">
                                                <label class="custmo_checkbox">
                                                    <input type="radio" class="continueChooseSMSTemplateButton" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>" name="selectedTemplate" value="<?php echo $oTemplate->id; ?>" id="templateID_<?php echo $oTemplate->id; ?>" <?php if ($bYesSelected || ($oTemplate->id == $selected_template)): ?>checked="checked"<?php endif; ?>>
                                                    <span class="custmo_checkmark sblue"></span>
                                                </label>
                                                <label for="templateID_<?php echo $oTemplate->id; ?>" class="m0">
                                                    <?php if ($method == 'manage'): ?>
                                                        <div class="temp_more_opt"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="http://brandboost.io/assets/images/more.svg" style="width: 12px;height: 12px;"></a>
                                                            <ul class="dropdown-menu dropdown-menu-right more_act" style="width: 146px; min-width: 146px;">
                                                                <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="cloneTemplate" template_type="sms"><i class="icon-pencil"></i> Clone</a></li>
                                                                <li><a href="javascript:void(0);" class="previewSMSTemplate" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>"><i class="icon-file-locked"></i> Preview</a></li>
                                                                <?php if ($oTemplate->user_id == $userID): ?>
                                                                    <li><a href="<?php echo base_url(); ?>admin/templates/edit/<?php echo $oTemplate->id; ?>"><i class="icon-pencil"></i> Edit</a></li>
                                                                    <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="deleteTemplate" source="<?php echo $source; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                                <?php endif; ?>

                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                                        <?php if (!empty($oTemplate->thumbnail)): ?>
                                                            <img style="height:auto!important;min-height:155px!important;" src="<?php echo $oTemplate->thumbnail ?>"/>
                                                        <?php else: ?>
                                                            <img src="<?php echo base_url(); ?>assets/images/temp_prev9.png"/>
                                                        <?php endif; ?>
                                                    </div>
                                                    <a class="sms_preview_button previewSMSTemplate small" href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>"><i class="icon-eye8"></i></a>
                                                    <div class="content_bx">
                                                        <?php if ($oTemplate->user_id == $aUser->id): ?>
                                                            <p><a href="javascript:void(0);" class="editName" id="editName_<?php echo $oTemplate->id; ?>" template_id="<?php echo $oTemplate->id; ?>" title="click to edit template name"><?php echo $oTemplate->template_name; ?></a></p>
                                                            <input type="text" id="editNameTxt_<?php echo $oTemplate->id; ?>" class="form-control editNameTxt" value="<?php echo $oTemplate->template_name; ?>" template_id="<?php echo $oTemplate->id; ?>" style="margin-top:-9px;display:none;" />

                                                        <?php else: ?>
                                                            <p><?php echo $oTemplate->template_name; ?></p>
                                                        <?php endif; ?>

                                                    </div>
                                                </label>
                                            </div>
                                        </td>
                                        <td style="display: none;">&nbsp;

                                        </td>
                                    </tr>



                                    <?php
                                endif;
                            }
                        }
                    }
                    $imgArr = array('template_prev1.png', 'template_prev2.png', 'template_prev3.png', 'template_prev4.png', 'template_prev5.png', 'template_prev6.png', 'template_prev7.png', 'template_prev8.png');
                    foreach ($oTemplates as $oTemplate) {
                        //pre($oTemplate);
                        if (($oTemplate->id != $selected_template) && ($oTemplate->status == '1') && ($oTemplate->category_status != '2') && (strtolower($oTemplate->template_type) == 'sms')):
                            ?>
                            <tr class="template_row">
                                <td style="display: none;"></td>
                                <td style="display: none;"><?php echo $oTemplate->id; ?></td>
                                <td>
                                    <div class="white_box template_preview sms">
                                        <label class="custmo_checkbox">
                                            <input type="radio" class="continueChooseSMSTemplateButton" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>" name="selectedTemplate" value="<?php echo $oTemplate->id; ?>" id="templateID_<?php echo $oTemplate->id; ?>" <?php if ($bYesSelected || ($oTemplate->id == $selected_template)): ?>checked="checked"<?php endif; ?>>
                                            <span class="custmo_checkmark sblue"></span>
                                        </label>
                                        <label for="templateID_<?php echo $oTemplate->id; ?>" class="m0">
                                            <?php if ($method == 'manage'): ?>
                                                <div class="temp_more_opt"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="http://brandboost.io/assets/images/more.svg" style="width: 12px;height: 12px;"></a>
                                                    <ul class="dropdown-menu dropdown-menu-right more_act" style="width: 146px; min-width: 146px;">
                                                        <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="cloneTemplate" template_type="sms"><i class="icon-pencil"></i> Clone</a></li>
                                                        <li><a href="javascript:void(0);" class="previewSMSTemplate" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>"><i class="icon-file-locked"></i> Preview</a></li>
                                                        <?php if ($oTemplate->user_id == $userID): ?>
                                                            <li><a href="<?php echo base_url(); ?>admin/templates/edit/<?php echo $oTemplate->id; ?>"><i class="icon-pencil"></i> Edit</a></li>
                                                            <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="deleteTemplate" source="<?php echo $source; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                        <?php endif; ?>

                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                            <div style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                                <?php if (!empty($oTemplate->thumbnail)): ?>
                                                    <img style="height:auto!important;min-height:155px!important;" src="<?php echo $oTemplate->thumbnail ?>"/>
                                                <?php else: ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/temp_prev9.png"/>
                                                <?php endif; ?>
                                            </div>
                                            <a class="sms_preview_button previewSMSTemplate small" href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>"><i class="icon-eye8"></i></a>
                                            <div class="content_bx">
                                                <?php if ($oTemplate->user_id == $aUser->id): ?>
                                                    <p><a href="javascript:void(0);" class="editName" id="editName_<?php echo $oTemplate->id; ?>" template_id="<?php echo $oTemplate->id; ?>" title="click to edit template name"><?php echo $oTemplate->template_name; ?></a></p>
                                                    <input type="text" id="editNameTxt_<?php echo $oTemplate->id; ?>" class="form-control editNameTxt" value="<?php echo $oTemplate->template_name; ?>" template_id="<?php echo $oTemplate->id; ?>" style="margin-top:-9px;display:none;" />

                                                <?php else: ?>
                                                    <p><?php echo $oTemplate->template_name; ?></p>
                                                <?php endif; ?>

                                            </div>
                                        </label>
                                    </div>
                                </td>
                                <td style="display: none;">&nbsp;

                                </td>
                            </tr>



                            <?php
                        endif;
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </div>

</div>
@include('admin.modals.templates.sms-templates-popup')

<script>
    $(document).ready(function () {
        // Setup - add a text input to each footer cell

        var tableId2 = 'tblSMSTemplate';
        custom_data_table(tableId2);

    });


    $(document).ready(function () {
        $(document).on("click", ".previewSMSTemplate", function (e) {
            var templateID = $(this).attr('template_id');
            var source = $(this).attr('source');
            var moduleName = '<?php echo $moduleName;?>';
            var moduleUnitId = '<?php echo $moduleUnitID;?>';
            if (templateID != '') {
                $('.overlaynew').show();
                $.ajax({
                    url: '<?php echo base_url('admin/templates/loadTemplatePreview'); ?>',
                    type: "POST",
                    data: {template_id: templateID, source: source, moduleName:moduleName, moduleUnitId:moduleUnitId},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $("#smsPreviewContainer").html(data.content.replace(/\r\n|\r|\n/g, "<br />"));

                            $("#sms_template_preview_modal").modal();
                        } else if (data.status == 'error') {
                            $('.overlaynew').hide();

                        }

                    }
                });

            }
        });

        $(document).on('click', '.displaySMSTemplates', function () {
            var categoryid = $(this).attr('category_id');
            var action = $(this).attr('action');
            var campaign_type = 'sms';
            $(".select_template li a").removeClass('active');
            $(this).addClass('active');
            var selected_template = '<?php echo $selected_template; ?>';
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/templates/getCategorizedTemplates'); ?>',
                type: "POST",
                data: {categoryid: categoryid, action: action, campaign_type: campaign_type, method: '<?php echo $method; ?>', selected_template: selected_template},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#categorized_sms_template_list").html(data.content);
                        var tableId = 'tblSMSTemplate';
                        custom_data_table(tableId);


                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();

                    }

                }
            });
        });



    });
</script>
