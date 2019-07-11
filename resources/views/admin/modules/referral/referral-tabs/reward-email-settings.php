
<!--########################TAB 4 ##########################-->
<div class="tab-pane <?php echo ($defalutTab == 'workflow') ? 'active' : ''; ?>" id="right-icon-tab4">
	<?php // pre($oAccountSettings); ?>
	<form name="frmEmailSettings" method="post" id="frmEmailSettings">
		<div class="clearfix"></div>
		<div class="form-group">
			<label>Notify through</label>
			<select class="form-control" name="notification_source" required="required">
				<option value="email" <?php if($oAccountSettings->notification_source == 'email'):?> selected="selected" <?php endif;?>>Email</option>
				<option value="sms" <?php if($oAccountSettings->notification_source == 'sms'):?> selected="selected" <?php endif;?>>Sms</option>
				<option value="both" <?php if($oAccountSettings->notification_source == 'both'):?> selected="selected" <?php endif;?>>Both</option>
			</select>
		</div>
		
		
		<div class="form-group">
			<label>Join Email/Sms</label>
			<select class="form-control" name="invite_delay" required="required">
				<option value="-1" <?php if($oAccountSettings->invite_delay == '-1'):?> selected="selected" <?php endif;?>>Never</option>
				<option value="0" <?php if($oAccountSettings->invite_delay == '0'):?> selected="selected" <?php endif;?>>Immediately(Recommended)</option>
				<?php for($i=1; $i<=24; $i++):?>
				<option value="<?php echo $i;?>" <?php if($oAccountSettings->invite_delay == $i):?> selected="selected" <?php endif;?>><?php echo $i;?> hours after signup</option>
				<?php endfor; ?>
			</select>
		</div>
		
		<div class="form-group">
			<label>Post Purchase Email/Sms</label>
			<select class="form-control" name="sale_delay" required="required">
				<option value="-1" <?php if($oAccountSettings->sale_delay == '-1'):?> selected="selected" <?php endif;?>>Never</option>
				<option value="0" <?php if($oAccountSettings->sale_delay == '0'):?> selected="selected" <?php endif;?>>Immediately(Recommended)</option>
				<?php for($i=1; $i<=100; $i++):?>
				<option value="<?php echo $i;?>" <?php if($oAccountSettings->sale_delay == $i):?> selected="selected" <?php endif;?>><?php echo $i;?> day after purchase</option>
				<?php endfor; ?>
			</select>
		</div>
	
	<div class="form-group">
		<label>Reminder Email/Sms</label>
		<select class="form-control" name="reminder_delay" required="required">
			<option value="-1" <?php if($oAccountSettings->reminder_delay == '-1'):?> selected="selected" <?php endif;?>>Never</option>
			<option value="1" <?php if($oAccountSettings->reminder_delay == '1'):?> selected="selected" <?php endif;?>>Every week</option>
			<option value="2" <?php if($oAccountSettings->reminder_delay == '2'):?> selected="selected" <?php endif;?>>Every 2 weeks</option>
			<option value="3"<?php if($oAccountSettings->reminder_delay == '3'):?> selected="selected" <?php endif;?>>Every 3 weeks</option>
			<option value="4" <?php if($oAccountSettings->reminder_delay == '4'):?> selected="selected" <?php endif;?>>Every 4 weeks</option>
			<option value="8" <?php if($oAccountSettings->reminder_delay == '8'):?> selected="selected" <?php endif;?>>Every 8 weeks</option>
			<option value="16" <?php if($oAccountSettings->reminder_delay == '16'):?> selected="selected" <?php endif;?>>Every 16 weeks</option>
		</select>
	</div>
	<input type="hidden" name="uid" id="uid" value="<?php echo $userID;?>" />
	<div style="text-align:right;"><button type="submit" id="saveEmailSettings" class="btn bl_cust_btn bg-blue-600" name="submit" value="Continue">Continue</button></div>
</form>
</div>

<script>
	$("#frmEmailSettings").submit(function () {
		$('.overlaynew').show();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url: '<?php echo base_url('admin/modules/referral/saveEmailWorkflow'); ?>',
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				$('.overlaynew').hide();
				if (data.status == 'success') {
					window.location.href = '<?php echo base_url("/admin/modules/referral/setup/{$programID}?t=advocates") ?>';
				} else {
					alertMessage('Error: Some thing wrong!');
					$('.overlaynew').hide();
				}
			}
		});
		return false;
	});
</script>

