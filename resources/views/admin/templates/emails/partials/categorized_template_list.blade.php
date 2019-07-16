<?php
$templateCount = 0;
$tempName = $campaignType;
$aUser = getLoggedUser();
$userID = $aUser->id;

?>

<style>
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
<div class="top"></div>
<table class="table" id="tblEmailTemplate" style="background: none!important; width: 100%!important;">
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
        //pre($oCategorizedTemplates);
        if (!empty($selected_template) && ($selected_template > 0)) {
            foreach ($oCategorizedTemplates as $oTemplate) {
                if ($oTemplate->id == $selected_template) {
                    $bStaticTemplate = ($oTemplate->category_status == '2') ? true : false;
                    //$bStaticTemplate = false;
                    if (($oTemplate->status == '1') && (strtolower($oTemplate->template_type) == 'email')):
                        ?>
                        <tr class="template_row">
                            <td style="display: none;"></td>
                            <td style="display: none;"><?php echo $oTemplate->id; ?>99999999</td>

                            <td>
                                <div class="white_box template_preview ">
                                    <label class="custmo_checkbox">
                                        <input type="radio" class="continueChooseTemplateButton" template_id="<?php echo $oTemplate->id; ?>" name="selectedTemplate"  value="<?php echo $oTemplate->id; ?>" id="templateID_<?php echo $oTemplate->id; ?>" <?php if ($oTemplate->id == $selected_template): ?>checked="checked"<?php endif; ?>>
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                    <label for="templateID_<?php echo $oTemplate->id; ?>" class="m0">
                                        <?php if ($method == 'manage' && $bStaticTemplate == false): ?>
                                           
                                        <div class="temp_more_opt"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="http://brandboost.io/assets/images/more.svg" style="width: 12px;height: 12px;"></a>
                                                
                                                <ul class="dropdown-menu dropdown-menu-right more_act" style="width: 146px; min-width: 146px;">
                                                    <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="cloneTemplate" template_type="email"><i class="icon-pencil"></i> Clone</a></li>
                                                    <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="previewEmailTemplate"><i class="icon-file-locked"></i> Preview</a></li>
                                                    <?php if ($oTemplate->user_id == $userID): ?>
                                                        <li><a href="<?php echo base_url(); ?>admin/templates/edit/<?php echo $oTemplate->id; ?>"><i class="icon-pencil"></i> Edit</a></li>
                                                        <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="deleteTemplate" source="<?php echo $source; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                    <?php endif; ?>

                                                </ul>
                                               
                                            </div>
                                         
                                        <?php endif; ?>
                                        <div style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                            <?php if (!empty($oTemplate->thumbnail)): ?>
                                                <img style="height:auto!important;" src="<?php echo $oTemplate->thumbnail ?>"/>
                                            <?php else: ?>
                                                <img src="<?php echo base_url(); ?>assets/images/temp_prev9.png"/>
                                            <?php endif; ?>
                                        </div>
                                        <a class="email_preview_button previewEmailTemplate small" href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>"><i class="icon-eye8"></i></a>
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
        //pre($oCategorizedTemplates);
        if (!empty($oCategorizedTemplates)) {
            foreach ($oCategorizedTemplates as $oTemplate) {
                //echo $selected_template;
                //pre($oTemplate);
               
                if (($oTemplate->id != $selected_template) && ($oTemplate->status == '1') && (strtolower($oTemplate->template_type) == $tempName)):
                    $bYesSelected = false;
                    if ($selected_template == $oTemplate->id && $source != 'draft') {
                        $bYesSelected = true;
                    }
                    
                    $bStaticTemplate = ($oTemplate->category_status == '2') ? true : false;
                    //$bStaticTemplate = false;
                   
                    ?>


                    <tr class="template_row">
                        <td style="display: none;"></td>
                        <td style="display: none;"><?php echo $oTemplate->id; ?></td>
                        <td>
                            <div class="white_box template_preview ">
                                <label class="custmo_checkbox">
                                    <input type="radio" class="continueChooseTemplateButton" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>" name="selectedTemplate" value="<?php echo $oTemplate->id; ?>" id="templateID_<?php echo $oTemplate->id; ?>" <?php if ($bYesSelected || ($oTemplate->id == $selected_template)): ?>checked="checked"<?php endif; ?>>
                                    <span class="custmo_checkmark sblue"></span>
                                </label>
                                <label for="templateID_<?php echo $oTemplate->id; ?>" class="m0">
                                    <?php if ($method == 'manage' && $bStaticTemplate == false): ?>
                                    
                                        <div class="temp_more_opt"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="http://brandboost.io/assets/images/more.svg" style="width: 12px;height: 12px;"></a>
                                            <ul class="dropdown-menu dropdown-menu-right more_act" style="width: 146px; min-width: 146px;">
                                                <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="cloneTemplate" template_type="email"><i class="icon-pencil"></i> Clone</a></li>
                                                <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" source="my" class="previewEmailTemplate"><i class="icon-file-locked"></i> Preview</a></li>
                                                <?php if ($oTemplate->user_id == $userID): ?>
                                                    <li><a href="<?php echo base_url(); ?>admin/templates/edit/<?php echo $oTemplate->id; ?>"><i class="icon-pencil"></i> Edit</a></li>
                                                    <li><a href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" class="deleteTemplate" source="<?php echo $source; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                <?php endif; ?>

                                            </ul>
                                        </div>
                                    
                                    <?php endif; ?>

                                    <div style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                        <?php if (!empty($oTemplate->thumbnail)): ?>
                                            <img style="height:auto!important;" src="<?php echo $oTemplate->thumbnail ?>"/>
                                        <?php else: ?>
                                            <img src="<?php echo base_url(); ?>assets/images/temp_prev9.png"/>
                                        <?php endif; ?>
                                    </div>
                                    <a class="email_preview_button previewEmailTemplate small" href="javascript:void(0);" template_id="<?php echo $oTemplate->id; ?>" source="<?php echo $source; ?>"><i class="icon-eye8"></i></a>
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
        }else {
            ?>
            <tr class="mt20"><td style="display: none;"></td><td style="display: none;"></td><td class="text-center">No Template Found</td></tr>
                <?php } ?>

    </tbody>
</table>

