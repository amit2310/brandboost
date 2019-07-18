		
				<div class="panel-body p0 bkg_white sms_header SmallSmschat">
						<div class="p20 pt10 pb10 bbot">
							<!--<span class="fsize12 txt_grey pull-left">All <span class="txt_grey">(39)</span> &nbsp;  <i class="icon-arrow-down5 txt_grey"></i></span>-->
						
							<div class="tdropdown ml0">
								<a  style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span class="t_sms_small" id="toogleDivName">All (<?php echo $activeChatSmsCount; ?>) </span><i class="icon-arrow-down22"></i></a>
								<ul style="right: 0px!important; margin-top: 10px; left: -10px;" class="dropdown-menu dropdown-menu-left chat_dropdown">
									<li><strong><a  class="active" href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon1.png"/> <b class="smallbr">All (<?php echo $activeChatSmsCount; ?>)</b> </a></strong></li>
									<li style="display: none;"><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/>Open (13) </a></strong></li>
									<li style="display: none"><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon3.png"/>Resolved (172) </a></strong></li>
									<li style="display: block;"><strong><a  href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon4.png"/><span class="f_link">Favorite (<?php echo $fUserCount; ?>)</span> </a></strong></li>
									<li><strong><a  href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon4.png"/><span class="c_link">Contacts(<?php echo count($totalSubscriber_schat); ?>)</span></a></strong></li>
									
									<li style="display: none;"><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon5.png"/>Snoozed (28)</a></strong></li>
								</ul>
							</div>
							
							
							<div class="tdropdown ml0 pull-right">
								<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span class="f_sms_small" id="filterTitle">Newest</span> <i class="icon-arrow-down22"></i></a>
								<ul style="margin-top: 10px; right: -10px;" class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
									<li class="f_new"><strong><a class="active" href="javascript:void(0)">Newest </a></strong></li>
									<li style="display: none;" class="f_wait"><strong><a href="javascript:void(0)">Waiting longest </a></strong></li>
									<li class="f_old"><strong><a href="javascript:void(0)">Oldest </a></strong></li>
								</ul>
								
							</div>
					
							<div class="clearfix"></div>
						</div>
						
						
						
					</div>


<script>
		$( document ).ready(function() {
		
		
		$('body').on('keyup', '.sms_msg_input_notes', function(e){
			
			if (e.which == 13) {
				var SubscriberPhone = $(this).attr('SubscriberPhone'); 
			var NotesTo="";
		     NotesTo = $(this).attr('user_id');
			var NotesContent = $(this).val();
			$(this).val('');
			var source='Sms chat notes';
		       if($.trim(NotesContent) == ''){
				// $('#Webonly .NotesContent').addClass('borderClass');	
				
				}else{
			            $.ajax({
							url: "<?php echo base_url('/admin/contacts/add_contact_notes'); ?>",
							type: "POST",
							data: {notes: NotesContent, NotesTo: NotesTo,source:source,notes_from:'web'},
							dataType: "json",
							success: function (response) {
								if (response.status == "success") {
									SmsNoteslisting(SubscriberPhone,NotesTo);
								}
							},
							error: function (response) {
								// error
							}
						});
			}
			
		}
		});
		
		//  ######### media  file upload ############ //
		$(document).on('click', '.preview_image_button_cl_sms_notes', function() {
		
		$('#preview_image_sms_notes').attr('user_id',$(this).attr('user_id'));	
		 $('#preview_image_sms_notes').trigger('click');
		});
		//  ######### media  file upload ############ //

	});
	
	$(document).on('change', '#preview_image_sms_notes', function(e) {
		$('.overlaynew').show();
		var NotesTo  = $('#preview_image_sms_notes').attr('user_id');
			const files = document.querySelector('[id=preview_image_sms_notes]').files;
			var currentUser = '<?php echo $loginUserData->id; ?>';
			const formData = new FormData();
			
			for (let i = 0; i < files.length; i++) {
				let file = files[i];
				formData.append('files[]', file);
			}
			
			fetch('<?php echo base_url("/dropzone/upload_chat_attachment"); ?>', { 
				method: 'POST',
				body: formData // This is your file object
			}).then(
			response => response.json() // if the response is a JSON object
			).then(
			success => {
				if(success.error == '') {
					var filename = success.result;
					var fileext = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
					var msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+filename;
					
					if(fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') 
					{
						msg = "<a href='"+msg+"' target='_blank'><img src='"+msg+"' height='100' width='100' /></a>";
					}
					else if(fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
						msg = "<a href='"+msg+"' target='_blank'>Download '"+fileext[0].toUpperCase()+"' File</a>";
					}
					
					var messageText ='<li class="media reversed"> <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><span class="icons s32"><img src="<?php echo $currentUserImg; ?>" class="img-circle" alt="" width="150" height="auto"></span></span><div class="media-content">'+msg+'</div></div></li>';
					
					msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+filename;
				    var source='Sms chat notes';
					$.ajax({
							url: "<?php echo base_url('/admin/contacts/add_contact_notes'); ?>",
							type: "POST",
							data: {notes: msg, NotesTo: NotesTo,source:source,notes_from:'web'},
							dataType: "json",
							success: function (response) {
								if (response.status == "success") {
									SmsNoteslisting(NotesTo);
									$('.overlaynew').hide();
								}
							},
							error: function (response) {
								// error
							}
						});
					
				}
				else {
					// error
				}
			} 
			).catch(
			error => console.log(error) // Handle the error response object
			);
			
		});
	
	$(document).on('click', '.SmscreateNotes', function(e) {
		e.preventDefault();
		var dyId = $(this).attr('SubscriberPhone');
		var msgHeight = document.getElementById("Smsnotes_box_listing_"+dyId).scrollHeight;
		$("#Smsnotes_box_listing_"+dyId).scrollTop(msgHeight);
	});
	
	function SmsNoteslisting(NotesTo){
			
			$.ajax({
				url: '<?php echo base_url('admin/smschat/listingSmsNotes'); ?>',
				type: "POST",
				data: {'NotesTo' : NotesTo,notes_from:'web',_token: '{{csrf_token()}}'},
				dataType: "html",
				success: function (data) {
					$('#Smsnotes_box_listing_'+NotesTo).html(data);
					    var msgHeight = document.getElementById("Smsnotes_box_listing_"+NotesTo).scrollHeight;
						$("#Smsnotes_box_listing_"+NotesTo).scrollTop(msgHeight);
					
					},error: function(){
					alertMessage('Error: Some thing wrong!');
				}
			});
		}
	
	
</script>