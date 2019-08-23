@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
	<style>
		.notificatins_box{  min-height: 70px;  border-radius: 4px;  box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);  background-color: #ffffff; margin-bottom: 2px; padding: 16px 28px; line-height: 38px;}
		.notificatins_box .media-right{display: inline-block;}
		.notificatins_box p{margin: 0!important;}
		.notificatins_box .custmo_checkbox{margin-top: 13px; }
		.notificatins_box .custmo_checkmark{border-radius: 50px;}
		.notificatins_box .btn.dark_btn{height: 28px; background: #fff!important; box-shadow: none!important; border: 1px solid #eee!important; margin: 0 10px; padding: 3px 20px!important;}
		.brig2 {border-right: 1px solid #ebeff6;}
		.notify_filter select{border: none; background:url(../../assets/images/select_bkg4.png) right 8px no-repeat #fff; appearance:none; -webkit-appearance: none;   -moz-appearance:none; min-width: 50px; padding-right: 20px;}
		
		.smart_notification{padding-bottom: 20px;}
		.smart_notification p{font-size: 12px!important; margin: 0!important; max-width: 200px; }
		.smart_notification img.notif_icon{margin-top: 5px;}
		.smart_notification .btn.dark_btn{height: 28px; background: #fff!important; box-shadow: none!important; border: 1px solid #eee!important; margin:10px 10px 0 0; padding: 3px 20px!important; font-size: 12px!important}
		.smart_notification .media-left.pr10{padding-right: 17px!important}
		
	</style>
	
	
	
  <!--===============SMART VIEW==================-->
  <!-- <a style="position: fixed; top: 50%; right: 12px;" class="reviews slide-toggle visible" ><i class="icon-arrow-left5"></i></a> -->
<!--===============SMART VIEW==================-->
  
  
<div class="content">
  
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-7">
		  <h3 class="mt30"><i class="icon-bell2 fsize17"></i> &nbsp;   Notifications</h3>
		</div>
		<!--=============Button Area Right Side==============-->
		<div class="col-md-5 text-right btn_area">
		  <a href="<?php echo base_url(); ?>admin/settings/?t=notify" class="btn light_btn ml10"><i class="icon-cog"></i><span> &nbsp;  Settings</span> </a>
		</div>
	  </div>
	</div>
  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
  
	

	<!--&&&&&&&&&&&& CONTENT &&&&&&&&&&-->
	<div class="row">
	  
	  
	  		<div class="col-md-12">
			<div class="panel panel-flat">
			  <div class="panel-heading">
				<h6 class="panel-title">Activity Feed</h6>
				<div class="heading-elements">
					<!-- <a style="cursor: pointer;" class="txt_blue2 brig2 mr20 pr20 custom_action_box" id="deleteButtonNotification"><i class=""></i>Delete</a> -->
					<a style="cursor: pointer; display: inline; display: none;" id="deleteButtonNotification" class="txt_red brig2 mr20 pr20 custom_action_box"><i class="icon-bin txt_red fsize12"></i>&nbsp; Delete</a>

					<a href="javascript:void(0);" class="txt_blue2 brig2 mr20 pr20 viewAllNotification"><i class=""><img width="16" src="<?php echo base_url(); ?>assets/images/icon_check_blue_double.png"/></i>&nbsp;Mark all read</a>
					<a href="#" class="txt_green"><i class=""><img width="16" src="<?php echo base_url(); ?>assets/images/icon_check_green.png"/></i>&nbsp;Resolve Selected</a>
				</div>
				
			  </div>
			  <div class="panel-body p20 bkg_white">
				<div class="row notify_filter">
					<div class="col-md-3">
						<div class="media-left pull-left txt_grey">Event type:</div>
						<div class="media-left pull-right brig2">
							<select name="event_type_filter" id="event_type_filter">
								<option value="">All</option>
								<option value="added_any_comment">Add Comment</option>
								<option value="added_onsite_questions">Add Question</option>
								<option value="added_offsite_brandboost">Offsite</option>
								<option value="added__review">Add Review</option>
								<option value="offsite_happy_feedback">Happy Fedback</option>
								<option value="offsite_resolution_feedback">Fedback</option>
								<option value="added_onsite_answers_subscriber">Add Answer</option>
								<option value="added_any_review">Reviews</option>
								<option value="added_text_review">Text Review</option>
								<option value="upgrade-membership">Upgrade Membership</option>
								<option value="negative_review">Negative Review</option>
								<option value="added_text_comment">Add Text Comment</option>
								<option value="resolution_feedback">Resolution Fedback</option>
								<option value="add_onsite_brandboost">Onsite Campaign</option>
								<option value="add_chat">Add Chat</option>
								<option value="new_sale">New Sale</option>
								<option value="buy-addons-credit-pack">Credit pack</option>
								
							</select>
					</div>
					</div>
					<div class="col-md-3">
						<div class="media-left pull-left txt_grey">Users</div>
						<div class="media-left pull-right brig2"><select><option>All</option></select></div>
					</div>
					<div class="col-md-4">
						<div class="media-left pull-left txt_grey">Date period</div>
						<div class="media-left pull-right brig2"> <div class="daterange-ranges-notification"><span>03 May 2019 - 25 May 2019</span></div> <!-- <select><option>03 May 2019 - 25 May 2019</option><option>None</option></select> --></div>
					</div>
					<div class="col-md-2">
						<div class="media-left pull-left txt_grey">Status:</div>
						<div class="media-left pull-right"><select name='readStatus' id="readStatus">
															<option value="">All</option>
															<option value="read">Read</option>
															<option value="unread">Unread</option>
														   </select></div>
					</div>
				</div>
			  </div>
			</div>
		  </div>
		  						  
		</div>
		
		<div class="row" id="filterNotificationData">

			<?php /*if(!empty($notifications_data_today)) {?>
				<div class="col-md-12">
					<p class="txt_grey txt_upper mt-15 mb-15 fsize10">Today</p>
				</div>
				<?php }*/ ?>

				<!-- <div class="col-md-12"><?php
			 if(!empty($notifications_data_today)) {
			foreach($notifications_data_today as $notification) {

				$icon = showUserIcon($notification->event_type);
				$backgroundColor = notificationBackgroundColor($notification->status);
				?>
				<div class="notificatins_box" style="background-color: <?php echo $backgroundColor; ?>!important">
					<div class="row">
					    <div class="col-md-7">
						<div class="media-left"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
						<div class="media-left"><p class="txt_dark"><?php echo $notification->message; ?></p></div>
						<?php if(!empty($notification->link)) { ?>
						<div class="media-left"><a href="javascript:void(0);" class="txt_blue2 readNotification" data-notifyid="<?php echo $notification->id; ?>" data-redirect="<?php echo $notification->link; ?>">Learn more <i class="icon-arrow-right13"></i></a></div>
						<?php } ?>
						</div>
						<div class="col-md-5 text-right">
						<div class="media-right"><p class="txt_grey"><?php echo $notification->firstname; ?> <?php echo $notification->lastname; ?>, <?php echo timeAgoNotification($notification->created); ?></p></div>
						<div class="media-right">  <img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $notification->avatar; ?>" onerror="this.src='<?php echo base_url(); ?>assets/images/userp.png'" class="user_icon" >  <?php //echo showUserAvtar($notification->avatar, $notification->firstname, $notification->lastname, '16'); ?></div>
						<div class="media-right">
							<label class="custmo_checkbox">
							<input type="checkbox" class="checkRows" name="notification[]" value="<?php echo $notification->id; ?>">
							<span class="custmo_checkmark green"></span>
							</label>
						</div>
						</div>
					</div>
				</div>
				<?php
			}}
			?>
				</div> -->




				<?php /*if(!empty($notifications_data_yesterday)) {?>
				<div class="col-md-12">
					<p class="txt_grey txt_upper mt-15 mb-15 fsize10">Yesterday</p>
				</div>
				<?php }*/ ?>

				<!-- <div class="col-md-12"><?php
			 if(!empty($notifications_data_yesterday)) {
			foreach($notifications_data_yesterday as $notification) {

				$icon = showUserIcon($notification->event_type);
				$backgroundColor = notificationBackgroundColor($notification->status);
				?>
				<div class="notificatins_box" style="background-color: <?php echo $backgroundColor; ?>!important">
					<div class="row">
					    <div class="col-md-7">
						<div class="media-left"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
						<div class="media-left"><p class="txt_dark"><?php echo $notification->message; ?></p></div>
						<?php if(!empty($notification->link)) { ?>
						<div class="media-left"><a href="javascript:void(0);" class="txt_blue2 readNotification" data-notifyid="<?php echo $notification->id; ?>" data-redirect="<?php echo $notification->link; ?>">Learn more <i class="icon-arrow-right13"></i></a></div>
						<?php } ?>
						</div>
						<div class="col-md-5 text-right">
						<div class="media-right"><p class="txt_grey"><?php echo $notification->firstname; ?> <?php echo $notification->lastname; ?>, <?php echo timeAgoNotification($notification->created); ?></p></div>
						<div class="media-right"><img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $notification->avatar; ?>" onerror="this.src='<?php echo base_url(); ?>assets/images/userp.png'" class="user_icon" ><?php //echo showUserAvtar($notification->avatar, $notification->firstname, $notification->lastname, '16'); ?></div>
						<div class="media-right">
							<label class="custmo_checkbox">
							<input type="checkbox" class="checkRows" name="notification[]" value="<?php echo $notification->id; ?>">
							<span class="custmo_checkmark green"></span>
							</label>
						</div>
						</div>
					</div>
				</div>
				<?php
			}}
			?>
				</div> -->



				<?php /*if(!empty($notifications_data_lastweek)) {?>
				<div class="col-md-12">
					<p class="txt_grey txt_upper mt-15 mb-15 fsize10">Last week</p>
				</div>
				<?php }*/ ?>

				<!-- <div class="col-md-12"><?php
			 if(!empty($notifications_data_lastweek)) {
			foreach($notifications_data_lastweek as $notification) {

				$icon = showUserIcon($notification->event_type);
				$backgroundColor = notificationBackgroundColor($notification->status);
				?>
				<div class="notificatins_box" style="background-color: <?php echo $backgroundColor; ?>!important">
					<div class="row">
					    <div class="col-md-7">
						<div class="media-left"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
						<div class="media-left"><p class="txt_dark"><?php echo $notification->message; ?></p></div>
						<?php if(!empty($notification->link)) { ?>
						<div class="media-left"><a href="javascript:void(0);" class="txt_blue2 readNotification" data-notifyid="<?php echo $notification->id; ?>" data-redirect="<?php echo $notification->link; ?>">Learn more <i class="icon-arrow-right13"></i></a></div>
						<?php } ?>
						</div>
						<div class="col-md-5 text-right">
						<div class="media-right"><p class="txt_grey"><?php echo $notification->firstname; ?> <?php echo $notification->lastname; ?>, <?php echo timeAgoNotification($notification->created); ?></p></div>
						<div class="media-right">  <img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $notification->avatar; ?>" onerror="this.src='<?php echo base_url(); ?>assets/images/userp.png'" class="user_icon" >  <?php //echo showUserAvtar($notification->avatar, $notification->firstname, $notification->lastname, '16'); ?></div>
						<div class="media-right">
							<label class="custmo_checkbox">
							<input type="checkbox" class="checkRows" name="notification[]" value="<?php echo $notification->id; ?>">
							<span class="custmo_checkmark green"></span>
							</label>
						</div>
						</div>
					</div>
				</div>
				<?php
			}}
			?>
				</div> -->




				<div class="col-md-12">
					<p class="txt_grey txt_upper mt-15 mb-15 fsize10">All</p>
				</div>

				<div class="col-md-12"><?php
			 if(!empty($notifications_data)) {
			foreach($notifications_data as $notification) {

				$icon = showUserIcon($notification->event_type);
				$backgroundColor = notificationBackgroundColor($notification->status);
				?>
				<div class="notificatins_box" style="background-color: <?php echo $backgroundColor; ?>!important">
					<div class="row">
					    <div class="col-md-7">
						<div class="media-left"><img class="notif_icon" width="36" src="<?php echo base_url(); ?>assets/images/<?php echo $icon; ?>" /></div>
						<div class="media-left"><p class="txt_dark"><?php echo $notification->message; ?></p></div>
						<?php if(!empty($notification->link)) { ?>
						<div class="media-left"><a href="javascript:void(0);" class="txt_blue2 readNotification" data-notifyid="<?php echo $notification->id; ?>" data-redirect="<?php echo $notification->link; ?>">Learn more <i class="icon-arrow-right13"></i></a></div>
						<?php } ?>
						</div>
						<div class="col-md-5 text-right">
						<div class="media-right"><p class="txt_grey"><?php echo $notification->firstname; ?> <?php echo $notification->lastname; ?>, <?php echo timeAgoNotification($notification->created); ?></p></div>
						<div class="media-right"><img width="16" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $notification->avatar; ?>" onerror="this.src='<?php echo base_url(); ?>assets/images/userp.png'" class="user_icon" ><?php //echo showUserAvtar($notification->avatar, $notification->firstname, $notification->lastname, '16'); ?></div>
						<div class="media-right">
							<label class="custmo_checkbox">
							<input type="checkbox" class="checkRows" name="notification[]" value="<?php echo $notification->id; ?>">
							<span class="custmo_checkmark green"></span>
							</label>
						</div>
						</div>
					</div>
				</div>
				<?php
			}}
			?>
				</div>
			</div>
	
	<!--&&&&&&&&&&&& CONTENT  END&&&&&&&&&&-->
	
	
	
  </div>

				

<script>
	
	$(document).ready(function(){
       /* $(".reviews").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });
		
		$("#newcampaign").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });*/
		
    });
	
	
	// top navigation fixed on scroll and side bar collasped
		$( window ).scroll( function () {
			var sc = $( window ).scrollTop();
			if ( sc > 100 ) {
				$( "#header-sroll" ).addClass( "small-header" );
			} else {
				$( "#header-sroll" ).removeClass( "small-header" );
			}
		} );

		function smallMenu() {
			if ( $( window ).width() < 1600 ) {
				$( 'body' ).addClass( 'sidebar-xs' );
			} else {
				$( 'body' ).removeClass( 'sidebar-xs' );
			}
		}

		$( document ).ready( function () {
			smallMenu();

			window.onresize = function () {
				smallMenu();
			};
		} );
	</script>

	<script type="text/javascript">
		$(document).ready(function() {

			$(document).on('click', '#deleteButtonNotification', function (e) {

				e.preventDefault();
	            var val = [];
	            $('.checkRows:checkbox:checked').each(function (i) {
	                val[i] = $(this).val();
	            });
	            if (val.length === 0) {
	                alert('Please select a row.')
	            } else {

	                deleteConfirmationPopup(
	                "This notifications will deleted immediately.<br>You can't undo this action.", 
	                function() {

	                    $('.overlaynew').show();
	                    $.ajax({
	                        url: "<?php echo base_url('admin/notifications/delete_multipal_notification'); ?>",
	                        type: "POST",
	                        data: {multi_notification_id: val},
	                        dataType: "json",
	                        success: function (data) {
	                            if (data.status == 'success') {
	                                location.reload();
	                            } else {
	                                alert("Having some error.");
	                            }
	                        },
	                        error: function (error) {
	                            console.log(error);
	                        }
	                    });
	                });
	                
	            }

	        });


	        $(document).on('click', '.checkRows', function () {
	            var inc = 0;
				
	            var rowId = $(this).val();
				
	            /*if (false == $(this).prop("checked")) {
	                $('#append-' + rowId).removeClass('success');
					} else {
	                $('#append-' + rowId).addClass('success');
				}*/
				
	            $('.checkRows:checkbox:checked').each(function (i) {
	                inc++;
				});
	            if (inc == 0) {
					
	                $('.custom_action_box').hide();
					} else {
	                $('.custom_action_box').show();
				}
				
	            var numberOfChecked = $('.checkRows:checkbox:checked').length;
	            var totalCheckboxes = $('.checkRows:checkbox').length;
	            if (totalCheckboxes > numberOfChecked) {
	                $('#checkAll').prop('checked', false);
				}
				
			});

		});

		// Daterange picker
    // ------------------------------

    $('.daterange-ranges-notification').daterangepicker(
        {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2018',
            maxDate: '<?php echo date('m/d/Y', strtotime("+1 days")); ?>',
            //dateLimit: { days: 60 },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            applyClass: 'btn-small bkg_purple txt_white btn-block',
            cancelClass: 'btn-small btn-default btn-block',
            format: 'MM/DD/YYYY'
        },
        function(start, end) {
        	var readStatus = $('#readStatus').val();
        	var eventTypeFilter = $('#event_type_filter').val();
            $('.daterange-ranges-notification span').html(start.format('D MMM YYYY') + ' - ' + end.format('D MMM YYYY'));
            $.ajax({
                url: "<?php echo base_url('admin/notifications/getNotificationFilterDate'); ?>",
                type: "POST",
                data: {start:start.format('D MMM YYYY'), end:end.format('D MMM YYYY'), readStatus:readStatus, event_type: eventTypeFilter, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('#filterNotificationData').html(data.result);
                    } else {
                        alert("Having some error.");
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });

        }
    );

    $('.daterange-ranges-notification span').html(moment().subtract(29, 'days').format('D MMM YYYY') + ' - ' + moment().format('D MMM YYYY'));

    $.ajax({
        url: "<?php echo base_url('admin/notifications/getNotificationData'); ?>",
        type: "POST",
        data: {start:moment().subtract(29, 'days').format('D MMM YYYY'), end:moment().format('D MMM YYYY'), _token: '{{csrf_token()}}'},
        dataType: "json",
        success: function (data) {
            if (data.status == 'success') {
                $('#filterNotificationData').html(data.result);
            } else {
                alert("Having some error.");
            }
        },
        error: function (error) {
            console.log(error);
        }
    });

    $(document).on('change', '#readStatus', function() {
    	var readStatus = $(this).val();
    	var eventTypeFilter = $('#event_type_filter').val();
    	var dateRange = $('.daterange-ranges-notification span').text();
    	var res = dateRange.split("-");

    	$.ajax({
            url: "<?php echo base_url('admin/notifications/getNotificationFilterDate'); ?>",
            type: "POST",
            data: {start:res[0], end:res[1], readStatus:readStatus, event_type: eventTypeFilter, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('#filterNotificationData').html(data.result);
                } else {
                    alert("Having some error.");
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $(document).on('change', '#event_type_filter', function() {
    	var eventTypeFilter = $(this).val();
    	var readStatus = $('#readStatus').val();
    	var dateRange = $('.daterange-ranges-notification span').text();
    	var res = dateRange.split("-");

    	$.ajax({
            url: "<?php echo base_url('admin/notifications/getNotificationFilterDate'); ?>",
            type: "POST",
            data: {start:res[0], end:res[1], readStatus:readStatus, event_type: eventTypeFilter, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('#filterNotificationData').html(data.result);
                } else {
                    alert("Having some error.");
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

	</script>

@endsection 