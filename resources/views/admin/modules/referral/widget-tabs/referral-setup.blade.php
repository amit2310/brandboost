
<div class="row">
	<div class="col-md-3">
		<div style="margin: 0;" class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Referral Widget</h6>
				<div class="heading-elements"><a href="javascript:void(0);"><i class="icon-more2"></i></a></div>
			</div>
			<div class="tab-pane">
				<div class="profile_headings txt_upper p20 fsize11 fw600">Select Referral App <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
				<form method="post" name="frmSubmitReferralWidget" id="frmSubmitReferralWidget" action="javascript:void(0);">
					{{ csrf_field() }}
					<div class="p20">
						<div class="row">
							<div class="col-md-12">
								<?php foreach ($oReferralList as $data) { ?>
									<div class="form-group mb10">
										<p class="pull-left mb0"><a href="<?php echo base_url('admin/modules/referral/'.$data->id); ?>" target="_blank"><?php echo $data->title; ?></a></p>
										<label class="custom-form-switch pull-right">
											<input class="field autoSaveReferralWidget" type="checkbox" data-hashcode="<?php echo $data->hashcode; ?>" id="referral_id_<?php echo $data->id; ?>" name="referral_id" value="<?php echo $data->id; ?>" 
											<?php echo $data->id == $widgetData->referral_id ? 'checked' : ''; ?>>
											<span class="toggle dred"></span> 
										</label>
										<div class="clearfix"></div>
									</div>
								<?php } ?>
							</div>
							<input type="hidden" name="widget_id" id="widget_id" value="<?php echo $widgetData->id; ?>">
							<button class="hidden saveReferralWidget btn dark_btn h52 w100 bkg_purple" type="submit"> Save Referral Widget </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div style="margin: 0;" class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Preview</h6>
				<div class="heading-elements"><a href="javascript:void(0);"><i class="icon-more2"></i></a></div>
			</div>
			<div class="panel-body p20">
				<div class="widget_sec">
					<div id="referralWidgetSection">
						<?php echo ($widgetData->referral_id == '' || $widgetData->referral_id == 0) ? '' : $sEmailPreview; ?>
					</div>
					<img class="w100" src="<?php echo base_url(); ?>assets/images/config_bkg_bk2_overlay.png">
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {	
        var hashcodeVal = '';
		var referralId = '';
		$('.autoSaveReferralWidget').change(function () {
			var referralCheckedVal = $(this).is(":checked");
			referralId = $(this).val();
			hashcodeVal = $(this).attr('data-hashcode');
			$('.autoSaveReferralWidget').each(function(){
				if($(this).val() != referralId){
					$(this).attr('checked', false);
				}
			});
			
			if(referralCheckedVal === true){
				setTimeout(function(){
					$('.saveReferralWidget').trigger('click');
				}, 200);
			}else{
				$('#referralWidgetSection').html('');
			}
		});
		
		$('#frmSubmitReferralWidget').on('submit', function (e) {
            e.preventDefault();
			var widgetId = $('#widget_id').val();
            $.ajax({
                url: "<?php echo base_url(); ?>admin/modules/referral/addReferralWidgetApp",
                method: "POST",
                data: {'hashcode' : hashcodeVal, 'referral_id' : referralId, 'widget_id' : widgetId, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "success")
                    {
						$('#referralWidgetSection').html(data.preview);
						$('#referralScriptCode').html(data.referralScriptCode);
						displayMessagePopup();
					} else {
						displayMessagePopup('error');
					}
				}
			});
		});
	});
</script>					