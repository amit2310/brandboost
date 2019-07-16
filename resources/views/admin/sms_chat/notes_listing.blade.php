<div class="panel-body p0 bkg_white minh_880">
		
			
				<div class="p20 pr0 pt0 mainchatsvroll2">

				<ul class="media-list chat-list content-group NotesThreadsBox" style="display:block; margin-top:10px; height: 505px!important; max-height: 505px!important;">

				</ul>

				</div>
			
			<!-- <div class="p20 pt0">
				<p class="fsize10 txt_grey txt_upper">Suggested:</p>
				<button class="btn suggested">How to import a teammate</button>
				<button class="btn suggested">Inviting a teammate</button>
				<button class="btn suggested">How can I add a teammate?</button>
			</div> -->
			
			<!-- SMS CHAT FOOTER BOX -->
			<div class="panel-footer p0 bkg_white no_shadow smschat_footer addSubscriberNotes" >
				<div class="p20">
                    
					<textarea class="form-control addnote mb0 NotesContent" placeholder="Shift + Enter to add a new line ,  Start with ‘/’ to select a  Saved Message"></textarea>
			
					
				</div>
				
				<div class="p20 btop" style="padding: 12px 20px!important">
					<div class="pull-left ">
						
					<a class="mr20 txt_grey msg active common_msg"  href="#massage_tab" data-toggle="tab">Message</a>
						<a class="common_note" href="#Notes_tabs" data-toggle="tab">Note</a>
						
					</div>
					<div class="pull-right">
						<input style="display:none;" id="mmsFile_notes" type="file">
			
						<div class="panel panel-default smilie_emoji supported_smilies_smschat hide" style="position:absolute; top:-194px; left:2px; background:#F0F0F0;"><div class="panel-heading"><span><strong>Supported Smilies</strong></span></div><div class="panel-body smiley_grid_smschat"></div></div>
						
						<a style="display:none" class="mr-15 smilieSmsIconMessage" href="javascript:void(0)"><img src="/assets/images/chat_grey_smiley.png"/> </a>
						<a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_grey_image.png"/> </a>
						<a class="mr-15 notesFileAttechment" href="javascript:void(0)"><img src="/assets/images/chat_grey_attach.png"/> </a>
						<a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_gray_calendar.png"/> </a>
						
						<button id="sms_but" class="btn dark_btn btn-xs send_btn notes_but">Send <img class="ml10" src="/assets/images/icon_send_arrow.png"></button>
						
					</div>
					<div class="clearfix"></div>
				</div>
				
			</div>
			<!-- SMS CHAT FOOTER BOX -->

			
		</div>
<script>
	$( document ).ready(function() {
		
		//$('.NotesThreadsBox').html('');
		$('body').on('keyup', '.NotesContent', function(e){
			if (e.which == 13) {
				$(".notes_but").click();
			}
		});
		
		$('body').on('click', '.notes_but', function(){
			var NotesTo="";
		     NotesTo = $('.smsContainer #em_phone').val();
			var NotesContent = $('.NotesContent').val();
			 $('.NotesContent').val('');
			var source='Sms chat notes';
		       if($.trim(NotesContent) == ''){
				 $('.NotesContent').addClass('borderClass');	
				
				}else{
			            $.ajax({
							url: "<?php echo base_url('/admin/smschat/addSmsNotes'); ?>",
							type: "POST",
							data: {notes: NotesContent, NotesTo: NotesTo,_token: '{{csrf_token()}}'},
							dataType: "json",
							success: function (response) {
								if (response.status == "success") {
									showNoteslisting(NotesTo);
								}
							},
							error: function (response) {
								// error
							}
						});
			}
		});
		
		//  ######### media  file upload ############ //
		$(document).on('click', '.notesFileAttechment', function() {
		$('#mmsFile_notes').trigger('click');
		});
		//  ######### media  file upload ############ //

	});
	
	$(document).on('change', '#mmsFile_notes', function(e) {
			const files = document.querySelector('[id=mmsFile_notes]').files;
			var NotesTo = $('.smsContainer #em_sub_id').val();
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
							data: {notes: msg, NotesTo: NotesTo,source:source,notes_from:'sms'},
							dataType: "json",
							success: function (response) {
								if (response.status == "success") {
									showNoteslisting(NotesTo);
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
	
	function showNoteslisting(NotesTo){
			$.ajax({
				url: '<?php echo base_url('admin/smschat/listingSmsNotes'); ?>',
				type: "POST",
				data: {'NotesTo' : NotesTo,notes_from:'sms',_token: '{{csrf_token()}}'},
				dataType: "html",
				success: function (data) {
					$('.NotesThreadsBox').html(data);
					},error: function(){
					alertMessage('Error: Some thing wrong!');
				}
			});
		}
	
</script>