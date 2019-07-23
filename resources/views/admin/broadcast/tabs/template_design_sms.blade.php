<?php
$aCampaignTags = $this->config->item('email_tags');
?>
<style>
    #externalSystemContainer {
        background-color: #fff;
        padding: 10px 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
        text-align:right;
    }
    #undoButton, #redoButton {
        display: none;
    }
    #stripoSettingsContainer {
        width: 400px;
        float: left;
    }
    #stripoPreviewContainer {
        width: 100%;
        background: #ffffff;        
    }
    .notification-zone {
        position: fixed;
        width: 400px;
        z-index: 99999;
        right: 20px;
        bottom: 80px;
    }

    #codeEditor{ float:left!important}
    #saveStripoChanges{float: right;margin: 0;}
    #changeHistoryLink {
        cursor: pointer;
    }
    .smsCount{color:#4ebc86; font-weight:bold;}
    .smsCount.active{color:#F00;}
</style>
<?php 
	$smsCharCount = strlen(preg_replace("!<br.*?>!is", "\n", trim(base64_decode($oBroadcast->stripo_compiled_html))));
	$smsPartsCount = $smsCharCount/160;
	
?>
<div id="broadcastDesignTemplate" class="broadcastTab" <?php if ($activeTab != 'Design Template Edit'): ?> style="display:none;"<?php endif; ?>>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-flat">
			  <div class="panel-heading">
				<h6 class="panel-title">SMS Editor</h6>
				<div class="heading-elements"><a href="javascript:void();"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
			  </div>
			  <div class="panel-body p0 bkg_white min_h567">
				<form method="post" class="form-horizontal" id="saveWorkflowSmsTemplate" action="javascript:void();">
				<div class="p30">
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label>SMS Template</label>
					<input class="form-control h52" type="text" value="<?php echo $oBroadcast->name; ?>" placeholder="Brandboost.io" readonly>
					</div>
					</div>
					
					<div class="col-md-12">					
					<div class="form-group position-relative">
					<div class="row">
					<div class="col-md-4"><label>SMS Content</label></div>
					<div class="col-md-8 text-right" style="color:#4ebc86;">Characters: <span class="smsCount <?php echo $smsCharCount == 918 ? 'active' : ''; ?>"><span id="charactersCount"><?php echo $smsCharCount; ?></span>/918</span> &nbsp; &nbsp; &nbsp; Parts: <span class="smsCount <?php echo ceil($smsPartsCount) == 6 ? 'active' : ''; ?>"><span id="smsPartsCount"><?php echo ceil($smsPartsCount); ?></span>/6</span> &nbsp; </div>
					</div>
					<div class="border br5">
					<textarea class="form-control p25 min_h220 fsize12 txt_grey" style="height: 200px; border:none;" created_date="" name="smsWorkflowTemplateBody" id="smsWorkflowTemplateBody" maxlength="918" placeholder="SMS body"><?php echo preg_replace("!<br.*?>!is", "\n", trim(base64_decode($oBroadcast->stripo_compiled_html))); ?></textarea>
					
					<?php if (!empty($aCampaignTags)): ?>
						<div class="p-15 btop smstagbox" style="position: relative!important; overflow-y:scroll; height:110px;">
							<?php foreach ($aCampaignTags as $sTag): ?>
								<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo $sTag; ?>" class="btn btn-xs btn_white_table pr10 draggable insert_tag_button"><?php echo $sTag; ?></button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					</div>				
					</div>
					</div>
					
					<div class="col-md-12 pt-5">
					<button class="btn dark_btn bkg_green h40" id="saveStripoChanges" notification-mod="silent" style="min-width: 92px;float: left;">Save</button>
					<input type="hidden" name="wf_editor_campaign_id" id="wf_sms_editor_template_id" value="">
					<input type="hidden" name="wf_editor_moduleName" id="wf_sms_editor_moduleName" value="<?php echo $moduleName; ?>">
					</div>
				</div>
				</div>
				</form>
			  </div>
			</div>
		</div>
		
		
		<div class="col-md-8">
			<div class="panel panel-flat">
			  <div class="panel-heading">
				<h6 class="panel-title">Preview</h6>
				<div class="heading-elements"><a href="javascript:void();"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
			  </div>
			  <div class="panel-body p20 bkg_white min_h567">
				<div class="sms_preview_new">
				<p class="text-center txt_grey" style="font-size: 7px;"><?php echo date("h:i") . ' ' . dataFormat(); ?></p>
					<div class="sms_text_bubble_grey smsWorkflowTemplatePreview"><?php echo nl2br(base64_decode($oBroadcast->stripo_compiled_html)); ?></div>
					<div class="clearfix"></div>
					<div class="sms_text_bubble_blue">Thanks</div>
				</div>
			  </div>
			</div>
		</div>
	</div>
	
	
	
	<!--
    <div class="row">
        <div class="col-md-12">
            <div class="white_box mb20 p10">
                <div id="externalSystemContainer">
                    <button id="saveStripoChanges" class="btn dark_btn bkg_green">Save SMS</button>
                    <?php if ($moduleName == 'broadcast'): ?>
                        <button id="saveStripoDraft" class="btn dark_btn bkg_green mr10">Save to my templates</button>
                        <input type="hidden" id="draft_id" name="draft_id" value="<?php echo $draftID; ?>" />
                    <?php endif; ?>
                </div>
                <div id="stripoPreviewContainer">
                    <div class="row">
                        <form method="post" class="form-horizontal" id="saveWorkflowSmsTemplate" action="javascript:void();">
                            <div class="col-md-6">
                                <div class="form-group">
									<div class="row">
                                    <div class="col-md-4"><label>Body: </label></div>
                                    <div class="col-md-8 text-right" style="color:#4ebc86;">Characters: <span class="smsCount <?php echo $smsCharCount == 918 ? 'active' : ''; ?>"><span id="charactersCount"><?php echo $smsCharCount; ?></span>/918</span> &nbsp; &nbsp; &nbsp; Parts: <span class="smsCount <?php echo ceil($smsPartsCount) == 6 ? 'active' : ''; ?>"><span id="smsPartsCount"><?php echo ceil($smsPartsCount); ?></span>/6</span> &nbsp; </div>
									</div>
                                    <textarea class="form-control" style="height: 200px;" created_date="" name="smsWorkflowTemplateBody" id="smsWorkflowTemplateBody" maxlength="918" placeholder="SMS body"><?php echo preg_replace("!<br.*?>!is", "\n", trim(base64_decode($oBroadcast->stripo_compiled_html))); ?></textarea>
                                </div>

                                <?php if (!empty($aCampaignTags)): ?>
                                    <div class="form-group">
                                        <div class="note-btn-group btn-group note-view">
                                            <?php foreach ($aCampaignTags as $sTag): ?>
                                                <button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo $sTag; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo $sTag; ?></button>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>


                            <div class="col-md-6">
                                <div class="sms_preview">
                                    <div class="phone_sms">
                                        <div class="inner smsWorkflowTemplatePreview">
                                            <?php echo base64_decode($oBroadcast->stripo_compiled_html); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p><small><?php echo date("h:i") . ' ' . dataFormat(); ?></small></p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 text-right mt-20">
                                <input type="hidden" name="wf_editor_campaign_id" id="wf_sms_editor_template_id" value="">
                                <input type="hidden" name="wf_editor_moduleName" id="wf_sms_editor_moduleName" value="<?php echo $moduleName; ?>">
                                
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div> -->
	
<div id="nameyourtemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="updateDraftTemplateName" id="updateDraftTemplateName" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Sms_Color.svg"/> &nbsp;Name your template <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Please Enter Title For the Template:</label>
                                <input class="form-control" id="templateName" name="templateName" placeholder="Enter Title for the Template" type="text" required>
                                <label style="color:#ff0000;font-size:12px;display:none;" id="templateNameErrorMsg">This template name already exists</label>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="template_draft_id" id="template_draft_id">
                    <input type="hidden" value="<?php echo $moduleName; ?>" name="moduleName">
                    <button type="submit" class="btn dark_btn bkg_green">Save</button>

                </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function () {

        $(document).on('click', '.insert_tag_button', function () {

            var dataTagName = $(this).attr('data-tag-name');
            var campaignTempBody = $('#smsWorkflowTemplateBody').val();
            $('#smsWorkflowTemplateBody').val(campaignTempBody + dataTagName);
            $('#smsWorkflowTemplateBody').focus();
        });

        $(document).on('keyup', '#smsWorkflowTemplateBody', function () {
			var liveContent = $(this).val();
			var charCount = liveContent.length;
			var partsCount = Math.ceil(charCount/160);
			if(partsCount == 6){
				$('#smsPartsCount').parent().addClass('active');
			}else{
				$('#smsPartsCount').parent().removeClass('active');
			}
			
			if(charCount == 918){
				$('#charactersCount').parent().addClass('active');
			}else{
				$('#charactersCount').parent().removeClass('active');
			}
			$('#charactersCount').text(charCount);
			$('#smsPartsCount').text(partsCount);
			
            if ($(this).val() == '') {
                $('.smsWorkflowTemplatePreview').hide();
				$('.smsWorkflowTemplatePreview').html('');
            } else {
                $('.smsWorkflowTemplatePreview').show();
                liveContent = liveContent.replace(/\r\n|\r|\n/g, "<br />");
                $('.smsWorkflowTemplatePreview').html(liveContent);
            }
        });

        $(document).on("click", "#saveStripoChanges", function () {
            var silentMod = $(this).attr('notification-mod');
            var moduleName = '<?php echo $moduleName; ?>';
            var campaignId = '<?php echo $oBroadcast->id; ?>';
            var moduleUnitID = '<?php echo $oBroadcast->broadcast_id; ?>';
            var compliledHtml = $(".smsWorkflowTemplatePreview").html();
			if($('#smsWorkflowTemplateBody').val() == ''){
				displayMessagePopup('error', 'Alert!', 'Please enter sms message content.');
			}else{
				$.ajax({
					url: '/admin/workflow/updateWorkflowCampaign',
					type: "POST",
					data: {moduleName: moduleName, stripo_compiled_html: compliledHtml, campaignId: campaignId, moduleUnitID:moduleUnitID},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
                                                        if(silentMod != 'silent')
							displayMessagePopup('success', 'Success!', 'Sms changes has been updated successfully.');
						} else {
							alertMessage('Error: Some thing wrong!');
						}
					}
				});
			}
        });
		
        $(document).on("click", "#saveStripoDraft", function () {
            var moduleName = '<?php echo $moduleName; ?>';
            var campaignId = '<?php echo $oBroadcast->id; ?>';
            var template_source = '<?php echo $oBroadcast->template_source; ?>';
            var compliledHtml = $(".smsWorkflowTemplatePreview").html();
            var draftID = $("#draft_id").val();
			if($('#smsWorkflowTemplateBody').val() == ''){
				displayMessagePopup('error', 'Alert!', 'Please enter sms message content.');
			}else{
				$.ajax({
					url: '/admin/workflow/saveWorkflowDraft',
					type: "POST",
					data: {moduleName: moduleName, stripo_compiled_html: compliledHtml, campaignId: campaignId, template_source: template_source, draftID: draftID},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							var savedDraftID = $("#draft_id").val();
							if (savedDraftID == '' || savedDraftID == null || savedDraftID == 'undefined') {
								$("#template_draft_id").val(data.draftID);
								$("#draft_id").val(data.draftID);
								$("#nameyourtemplate").modal('show');
								
							} else {
								$("#draft_id").val(data.draftID);
								alert('Saved changes successfully');
							}

						} else {
							alertMessage('Error: Some thing wrong!');
						}
					}
				});
			}
        });
		
        $(document).on("submit", "#updateDraftTemplateName", function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/workflow/updateWorkflowDraft'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        alert('Saved changes successfully');
                        $("#nameyourtemplate").modal('hide');
                    } else if (data.status == 'error' && data.msg == 'duplicate') {
                        $("#templateNameErrorMsg").show();
                        return false;
                    } else {
                        $('.overlaynew').hide();
                        alert('Error: Some thing wrong!');
                    }
                }

            });
        });
        $(document).on("keypress", "#templateName", function () {
            $("#templateNameErrorMsg").hide();
        });
    });
</script>