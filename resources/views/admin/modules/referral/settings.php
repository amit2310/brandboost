<style type="text/css">
    .tab_list{ margin:0px; padding:0px;}
    .tab_list li {
	list-style: none;
	width: 50%;
	float: left;
    }
	
    .tooltip_table {
	position: relative; cursor: pointer;
    }
	
    .tooltip_table .tooltiptext {
	display: none;
	width: 224px;
	background-color: #fff;
	color: #333;
	text-align: left;
	border-radius: 3px;
	padding: 10px 15px;
	position: absolute;
	z-index: 1;
	top: -33px;
	border: 1px solid #cccccc;
	left: 113px;
	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
	
    .tooltiptext::before {
	content: "";
	position: absolute;
	top: 40px;
	left: -9px;
	border-style: solid;
	border-width: 6px 6px 0;
	border-color: #ccc transparent;
	display: block;
	width: 0;
	z-index: 0;
	transform: rotate(90deg);
    }
	
    .tooltiptext::after {
	content: "";
	position: absolute;
	top: 40px;
	left: -7px;
	border-style: solid;
	border-width: 5px 5px 0;
	border-color: #FFFFFF transparent;
	display: block;
	width: 0;
	z-index: 1;
	transform: rotate(90deg);
    }
	
    .tooltip_table .tooltiptext strong {
	text-transform: uppercase;
	margin-bottom: 10px;
	display: block;
    }
	
    .tooltip_table:hover .tooltiptext {
	display: block;
    }
</style>


<!-- Content area -->
<div class="content">
	
	
    <!-- Dashboard content -->
	
    <form name="frmSettings" method="post" id="frmSettings">
        <input type="hidden" name="uid" id="uid" value="<?php echo $userID;?>" />
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<div class="row">
							<div class="col-lg-12">
								<h6 class="panel-title">Referral Store Settings</h6>
								<div class="heading-elements">
									
									<button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
										<i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
									</button>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="row" style="padding:50px;">
						<div class="form-group">
							<label>Store Name</label>
							<input type="text" class="form-control" name="storeName" value="<?php echo ($oSettings->store_name) ? ($oSettings->store_name): '';?>" placeholder="Your store name" required="required" >
						</div>
						
						<div class="form-group">
							<label>Store URL</label>
							<input type="text" class="form-control" name="storeURL" value="<?php echo ($oSettings->store_url) ? ($oSettings->store_url): '';?>" placeholder="Your store url e.g. http://mystorename.com" required="required">
						</div>
						
						<div class="form-group">
							<label>Email Address</label>
							<input type="text" class="form-control" name="storeEmail" value="<?php echo ($oSettings->store_email) ? ($oSettings->store_email): '';?>" placeholder="Your store email address" required="required">
						</div>
						
						<div class="clearfix"></div>
						
						<hr>
						<div class="clearfix"></div>
						<div class="form-group">
							<label>Notify through</label>
							<select class="form-control" name="notification_source" required="required">
								<option value="email" <?php if($oSettings->notification_source == 'email'):?> selected="selected" <?php endif;?>>Email</option>
								<option value="sms" <?php if($oSettings->notification_source == 'sms'):?> selected="selected" <?php endif;?>>Sms</option>
								<option value="both" <?php if($oSettings->notification_source == 'both'):?> selected="selected" <?php endif;?>>Both</option>
							</select>
						</div>
						
						
						<div class="form-group">
							<label>Join Email/Sms</label>
							<select class="form-control" name="invite_delay" required="required">
								<option value="-1" <?php if($oSettings->invite_delay == '-1'):?> selected="selected" <?php endif;?>>Never</option>
								<option value="0" <?php if($oSettings->invite_delay == '0'):?> selected="selected" <?php endif;?>>Immediately(Recommended)</option>
								<?php for($i=1; $i<=24; $i++):?>
								<option value="<?php echo $i;?>" <?php if($oSettings->invite_delay == $i):?> selected="selected" <?php endif;?>><?php echo $i;?> hours after signup</option>
								<?php endfor; ?>
							</select>
						</div>
						
						<div class="form-group">
							<label>Post Purchase Email/Sms</label>
							<select class="form-control" name="sale_delay" required="required">
								<option value="-1" <?php if($oSettings->sale_delay == '-1'):?> selected="selected" <?php endif;?>>Never</option>
								<option value="0" <?php if($oSettings->sale_delay == '0'):?> selected="selected" <?php endif;?>>Immediately(Recommended)</option>
								<?php for($i=1; $i<=100; $i++):?>
								<option value="<?php echo $i;?>" <?php if($oSettings->sale_delay == $i):?> selected="selected" <?php endif;?>><?php echo $i;?> day after purchase</option>
								<?php endfor; ?>
							</select>
						</div>
						
						<div class="form-group">
							<label>Join Reminder Email/Sms</label>
							<select class="form-control" name="reminder_delay_invite" required="required">
								<option value="-1" <?php if($oSettings->reminder_delay_invite == '-1'):?> selected="selected" <?php endif;?>>Never</option>
								<option value="1" <?php if($oSettings->reminder_delay_invite == '1'):?> selected="selected" <?php endif;?>>Every week</option>
								<option value="2" <?php if($oSettings->reminder_delay_invite == '2'):?> selected="selected" <?php endif;?>>Every 2 weeks</option>
								<option value="3"<?php if($oSettings->reminder_delay_invite == '3'):?> selected="selected" <?php endif;?>>Every 3 weeks</option>
								<option value="4" <?php if($oSettings->reminder_delay_invite == '4'):?> selected="selected" <?php endif;?>>Every 4 weeks</option>
								<option value="8" <?php if($oSettings->reminder_delay_invite == '8'):?> selected="selected" <?php endif;?>>Every 8 weeks</option>
								<option value="16" <?php if($oSettings->reminder_delay_invite == '16'):?> selected="selected" <?php endif;?>>Every 16 weeks</option>
							</select>
						</div>
						
						<div class="form-group">
							<label>Post Purchase Reminder Email/Sms</label>
							<select class="form-control" name="reminder_delay" required="required">
								<option value="-1" <?php if($oSettings->reminder_delay == '-1'):?> selected="selected" <?php endif;?>>Never</option>
								<option value="1" <?php if($oSettings->reminder_delay == '1'):?> selected="selected" <?php endif;?>>Every week</option>
								<option value="2" <?php if($oSettings->reminder_delay == '2'):?> selected="selected" <?php endif;?>>Every 2 weeks</option>
								<option value="3"<?php if($oSettings->reminder_delay == '3'):?> selected="selected" <?php endif;?>>Every 3 weeks</option>
								<option value="4" <?php if($oSettings->reminder_delay == '4'):?> selected="selected" <?php endif;?>>Every 4 weeks</option>
								<option value="8" <?php if($oSettings->reminder_delay == '8'):?> selected="selected" <?php endif;?>>Every 8 weeks</option>
								<option value="16" <?php if($oSettings->reminder_delay == '16'):?> selected="selected" <?php endif;?>>Every 16 weeks</option>
							</select>
						</div>
						
						<button type="submit" id="saveSettings" class="btn btn-success" name="submit" value="Save">Save</button>
						
						
						
					</div>
				</div>
			</div>
		</div>
	</form>
    
    
	
    <!-- /dashboard content -->
	
</div>
<!-- /content area -->
<script>
    $(document).ready(function () {
		
        $("#btnReferral").click(function () {
            var copyText = $("#txtReferral").val();
			
            /* Select the text field */
            $("#txtReferral").select();
			
            /* Copy the text inside the text field */
            document.execCommand("copy");
		});
		
        $("#btnPostPurchase").click(function () {
            var copyText = $("#txtPostPurchase").val();
			
            /* Select the text field */
            $("#txtPostPurchase").select();
			
            /* Copy the text inside the text field */
            document.execCommand("copy");
		});
        
        
        $("#btnEmbed").click(function () {
            var copyText = $("#txtEmbed").val();
			
            /* Select the text field */
            $("#txtEmbed").select();
			
            /* Copy the text inside the text field */
            document.execCommand("copy");
		});
        
        
        $("#showPopupAfterSale").change(function(){
            if($(this).is(":checked")){
                var codeContent = $("#dummyPostSaleCodeWithPopup").val();
                
				}else{
                var codeContent = $("#dummyPostSaleCodeWithoutPopup").val();
                
			}
            
            $("#txtPostPurchase").val('');
            $("#txtPostPurchase").val(codeContent);
            
		});
        
        $("#frmSettings").submit(function () {
			
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#saveSettings').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/saveSettings'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
						
                        alertMessageAndRedirect('Setting has been saved successfully.', window.location.href);
						
						} else {
						
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
					}
				}
			});
            return false;
		});
        
        
		
		
	});
</script>