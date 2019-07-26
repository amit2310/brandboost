<div class="tab-pane <?php if($seletedTab=='notify'):?>active<?php endif;?>" id="right-icon-tab4">
    <form id="notificationcenterform">
    <div class="row"> 
        <div class="col-md-6">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Notification Center</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0">
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted">General</p>
                            </div>
                            <div class="col-md-9">
                                
                                <div class="form-group">
                                    <p class="pull-left mb0">System Notification<br>
                                        <span class="text-muted fsize11">Receive system notification every time you get new event</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input name="system_notify" class="field updatenotification" type="checkbox" <?php if($notificationData->system_notify):?>checked<?php endif;?>>
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="form-group">
                                    <p class="pull-left mb0">Floating notification sound<br>
                                        <span class="text-muted fsize11">Play sound when a visitor sends a new message.</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input name="notify_sound" class="field updatenotification" type="checkbox" <?php if($notificationData->notify_sound):?>checked<?php endif;?>>
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <p style="max-width: 285px;" class="pull-left mb0">New unread notifications icon in browser tab<br>
                                        <span class="text-muted fsize11">Show that you have new unread notifications in your notification center by displaying a red dot on the Brand Boost icon in your browser tab.</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input name="browser_notify" class="field updatenotification" type="checkbox" <?php if($notificationData->browser_notify):?>checked<?php endif;?>>
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>


                            </div>
                        </div>
                    </div>
					
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted">Events</p>
                            </div>
                            <div class="col-md-9"> 
                            <!-- notification loop start -->
                            <?php foreach($notificationlisting as $key=>$value){ 
                                 $checkflag = checkPermissionentry($value->notification_slug);
                                ?>
                                <div class="form-group mb10">
                                    <p class="pull-left mb0"><?php echo $value->notification_name; ?></p>
                                    <label class="custom-form-switch pull-right">
                                        <input style="cursor: pointer!important;" notification_slug="<?php echo $value->notification_slug; ?>" name="sys_assign_chat" class="field updatePermissionDetails" type="checkbox" <?php if($checkflag):?>checked<?php endif;?>>
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- notification loop end  -->
                                <?php } ?>

                            </div>
                        </div>
                    </div>
					
					<div class="p30">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted">Inactivity Length</p>
                            </div>
                            <div class="col-md-2" style="margin-top:-10px;">
                                <div class="form-group">
                                    <input name="inactivity_length" class="form-control updatePermission" value="<?php echo $notificationData->inactivity_length == '' ? 10 : $notificationData->inactivity_length; ?>" type="number" placeholder="">
									<?php //pre($oUser); ?>
                                </div>
                            </div>
							<div class="col-md-2">Minutes</div>
                        </div>
                    </div>
					
                </div>
            </div>
        </div>					

        <div class="col-md-6">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Email Notifications</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0">
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted">Email</p>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <p class="pull-left mb0">Email notification<br>
                                        <span class="text-muted fsize11">Receive an email every time you get new event</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input name="email_notify" class="field updatenotification" type="checkbox" <?php if($notificationData->email_notify):?>checked<?php endif;?>>
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <div class="">
                                        <input name="notify_email" class="form-control updatenotification" value="<?php echo ($notificationData->notify_email) ? $notificationData->notify_email: $oUser->email;?>" type="text" placeholder="max@wakers.co">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>


             <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Sms Notifications</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0">
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted">Sms</p>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <p class="pull-left mb0">Sms notification<br>
                                        <span class="text-muted fsize11">Receive an Sms every time you get new event</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input name="sms_notify" class="field updatenotification" type="checkbox" <?php if($notificationData->sms_notify):?>checked<?php endif;?>>
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <div class="">
                                        <input name="notify_phone" class="form-control updatenotification" value="<?php echo ($notificationData->notify_phone) ? $notificationData->notify_phone: $oUser->mobile;?>" type="text" placeholder="xx-xx-xx-xx">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>

        </div>
    </div>
    </form>
</div> 
<script>

    $(document).ready(function () {
        
		$(document).on("change blur",".updatenotification",function () {
            var fieldname = $(this).attr('name');
            var fieldval = $(this).val();
            
            $.ajax({
                url: "<?php echo base_url('admin/settings/updateNotificationSettings'); ?>",
                type: "POST",
                data: {
                    fieldname: fieldname,
                    fieldval: fieldval
                },
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        //display success message if required
                    } else {
                        //display error message if required
                    }
                }
            });
        });

		$(".updatePermissionDetails").change(function () {
            var notification_slug = $(this).attr('notification_slug');
            $.ajax({
				url: "<?php echo base_url('admin/settings/updateNotificationPermisson'); ?>",
				type: "POST",
				data: {
					notification_slug: notification_slug
				},
				dataType: "json",
				success: function (data) {

					if (data.status == 'success') {
						//display success message if required
					} else {
						//display error message if required
					}
				}
			});
        });
		
       
        $('input[type="checkbox"]').change(function(){
            if($(this).is(":checked") == true){
                $(this).attr("value", 1);
            }else{
                $(this).attr("value", 0);
            }
        })
    });


</script>