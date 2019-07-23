<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/parsers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/editor_wysihtml5.js"></script>
<?php  $aTags = array('FIRST_NAME', 'LAST_NAME', 'EMAIL', 'WEBSITE');?>
<div class="tab-pane <?php echo $activeDesign != ''?$activeDesign:''; ?>" id="right-icon-tab2">
	<form method="post" name="updateEmailTempaltes" id="updateEmailTempaltes" action="javascript:void();" novalidate>
	<div class="snoteeditoe">
		<textarea rows="15" name="emailtemplate" id="emailtemplate" class="wysihtml5 wysihtml5-default form-control" required><?php echo base64_decode($oBroadcast->html); ?></textarea>

		<div class="col-lg-12" style="margin-top:10px;">
			<?php 
				foreach ($aTags as $value) {
					?><button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo '{'.$value.'}'; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo '{'.$value.'}'; ?></button>&nbsp;&nbsp;<?php
				}
			?>
		</div>
	</div>
	<div class="col-lg-12 text-right" style="margin-top:30px;">
		<input name="campaignId" id="campaignId" value="<?php echo $oBroadcast->id; ?>" type="hidden">
		<input type="hidden" name="tab" value="Settings">
		<button type="button" class="btn bl_cust_btn new btn-default broadcastBackButton" tab="Select List">Back</button>
		<button type="submit"  class="btn bl_cust_btn new btn-default">Continue</button>
	</div>
	</form>
</div>

<script>
$(document).ready(function () {
	
	$('#updateEmailTempaltes').on('submit', function () {
		var emailtemplate = $('#emailtemplate').val();
		if(emailtemplate == ''){
			alertMessage('Please enter email content.');
		}else{
			$('.overlaynew').show();
			var formdata = $("#updateEmailTempaltes").serialize();
			$.ajax({
				url: '<?php echo base_url('admin/broadcast/updateBroadcastTempalte'); ?>',
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						 window.location.href = '';
					} else {
						$('.overlaynew').hide();
						alertMessage('Error: Some thing wrong!');
					}
				}, error : function(){
					$('.overlaynew').hide();
					alertMessage('Error: Some thing wrong!');
				}
			});
		}
		return false;
	});
	
	$('.insert_tag_button').on('click', function() {
		var tagname = $(this).attr('data-tag-name');
		var wysihtml5Editor = $('#emailtemplate').data("wysihtml5").editor;
		wysihtml5Editor.composer.commands.exec("insertHTML", tagname);
	});
});
</script>
