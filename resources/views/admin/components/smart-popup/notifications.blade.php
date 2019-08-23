<!--===========TODAY============-->
    <div class="col-md-12">
    
    <?php 
    /*$inc = 0;
    if(!empty($notifications_data_today)) { ?>
    <div style="border-top: none!important;" class="profile_headings">TODAY<a class="pull-right txt_blue2 viewAllNotification" style="text-transform: none; cursor: pointer;"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_check_blue_double.png" width="16"></i>&nbsp;Mark all read</a></div>
    <?php  $inc++; 
	} ?>  
    
    
    <?php
	 if(!empty($notifications_data_today)) {
	 	?><div class="p20 pb0"><?php
		foreach($notifications_data_today as $notification) {
		$icon = showUserIcon($notification->event_type);
		?>
		<div class="media bbot smart_notification">
			<div class="media-left pr10"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
			<div class="media-left p0"><a href="<?php echo $notification->link; ?>"><p class="txt_dark"><?php echo $notification->message; ?></p></a>
			<p class="txt_grey"><?php echo $notification->firstname; ?>, <?php echo timeAgoNotification($notification->created); ?></p>
			</div>
		</div>
		<?php
		}
		?></div><?php
	}*/
	?>
    
	</div>


<!--===========YESTERDAY============-->
	<div class="col-md-12">

    <?php /*if(!empty($notifications_data_yesterday)) {?>
    <div style="border-top: none!important;" class="profile_headings">YESTERDAY <?php if($inc == 0) { ?><a class="pull-right txt_blue2 viewAllNotification" style="text-transform: none; cursor: pointer;"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_check_blue_double.png" width="16"></i>&nbsp;Mark all read</a><?php $inc++; } ?></div><?php } ?>

    <?php
	if(!empty($notifications_data_yesterday)) {
		?>
        <div class="p20 pb0">
        	<?php
        	foreach($notifications_data_yesterday as $notification) {

			$icon = showUserIcon($notification->event_type);

	
	?>
	<div class="media bbot smart_notification">
		<div class="media-left pr10"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
		<div class="media-left p0"><a href="<?php echo $notification->link; ?>"><p class="txt_dark"><?php echo $notification->message; ?></p></a>
		<p class="txt_grey"><?php echo $notification->firstname; ?>, <?php echo timeAgoNotification($notification->created); ?></p>
		</div>
	</div>  

	<?php } ?>
        </div>
    <?php }*/ ?>
	</div>


<!--===========LAST WEEK============-->


	<div class="col-md-12">

    <?php /*if(!empty($notifications_data_lastweek)) {?>
    <div style="border-top: none!important;" class="profile_headings">LAST WEEK <?php if($inc == 0) { ?><a class="pull-right txt_blue2 viewAllNotification" style="text-transform: none; cursor: pointer;"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_check_blue_double.png" width="16"></i>&nbsp;Mark all read</a><?php $inc++; } ?></div><?php } ?>

    <?php
	if(!empty($notifications_data_lastweek)) {
		?>
        <div class="p20 pb0">
        	<?php
        	foreach($notifications_data_lastweek as $notification) {

			$icon = showUserIcon($notification->event_type);

	
	?>
	<div class="media bbot smart_notification">
		<div class="media-left pr10"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
		<div class="media-left p0"><a href="<?php echo $notification->link; ?>"><p class="txt_dark"><?php echo $notification->message; ?></p></a>
		<p class="txt_grey"><?php echo $notification->firstname; ?>, <?php echo timeAgoNotification($notification->created); ?></p>
		</div>
	</div>  

	<?php } ?>
        </div>
    <?php }*/ ?>
	</div>


<!--===========LAST WEEK============-->
    <div class="col-md-12">

    <?php 
    $inc = 0;
    if(!empty($notifications_data)) {?>
    <div style="border-top: none!important;" class="profile_headings">ALL <?php if($inc == 0) { ?><a class="pull-right txt_blue2 viewAllNotification" style="text-transform: none; cursor: pointer;"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_check_blue_double.png" width="16"></i>&nbsp;Mark all read</a><?php $inc++; } ?></div><?php } ?>

    <?php if(!empty($notifications_data)) { ?>
        <div class="p20 pb0">
        <?php 
        $inc = 1;
        foreach($notifications_data as $notification) { 

        	$icon = showUserIcon($notification->event_type);

        	?>
			<div class="media bbot smart_notification">
				<div class="media-left pr10"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
				<div class="media-left p0"><a href="<?php echo $notification->link; ?>"><p class="txt_dark"><?php echo $notification->message; ?></p></a>
				<p class="txt_grey"><?php echo $notification->firstname; ?>, <?php echo timeAgoNotification($notification->created); ?></p>
				<a class="txt_blue2 fsize12" href="<?php echo $notification->link; ?>">Learn more <i class="icon-arrow-right13 txt_blue2"></i></a>
				</div>
			</div>
		<?php 
		if($inc == 2) {
			break;
		}
		$inc++;
		} ?>
        </div>
    <?php } ?>

	</div>