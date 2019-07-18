		
				<div class="panel-body p0 bkg_white web_header SmallWebchat">
						<div class="p20 bbot pt10 pb10">

							<?php
							   
                               $FavoritesCount  = count($Favorites_list);

							if(!empty($unassignedChat)) {
								$unassignedCount = count($unassignedChat);
							}
							else {
								$unassignedCount = 0;
							}

							if(!empty($assignedChat)) {
								$assignedCount = count($assignedChat);
							}
							else {
								$assignedCount = 0;
							}
							?>

							<div class="tdropdown ml0">
								<a  style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span class="t_web_main allChatShow" id="toogleDivName">All </span><i class="icon-arrow-down22"></i></a>
								<ul style="right: 0px!important; margin-top: 25px; left: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown">
									<li><strong><a  class="active" href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon1.png"/> <b class="smallbr allChatShow">All (<?php echo $activeChatCount; ?>)</b> </a></strong></li>
									<li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/><b class="unTab unassigned_show">Unassigned (<?php echo $unassignedCount; ?>) </b></a></strong></li>
									<li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/><b class="YouTab assigned_show_<?php echo $loggedYou; ?>">You (<?php echo $assignedCount; ?>) </b></a></strong></li>

									<li><strong><a href="javascript:void(0)"><img class="small" src="/assets/images/cd_icon2.png"/><b class=" Smallwebfavtab">Favorites (<?php echo $FavoritesCount; ?>) </b></a></strong>
									</li>

									
								</ul>
							</div>
							
							
							<div class="tdropdown ml0 pull-right">
								<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"><span class="f_web_small" id="filterTitle">Newest</span> <i class="icon-arrow-down22"></i></a>
								<ul style="margin-top: 10px; right: -10px;" class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
									<li class="f_new"><strong><a class="active" href="javascript:void(0)">Newest </a></strong></li>
									<li class="f_old"><strong><a href="javascript:void(0)">Oldest </a></strong></li>
								</ul>
								
								
								
							</div>
					
							<div class="clearfix"></div>
						</div>
						
						
						
					</div>
<script>
		$( document ).ready(function() {
		
		
		$('body').on('keyup', '.msg_input_notes', function(e){
			
			if (e.which == 13) {
				
			var newToken = $(this).attr('newtoken');
						var chatTo = $(this).attr('user_id');
						var  currentUser  =   $(this).attr('currentUser');


			var NotesContent = $(this).val();
			$(this).val('');
		       if($.trim(NotesContent) == ''){
				// $('#Webonly .NotesContent').addClass('borderClass');	
				
				}else{
			            $.ajax({
							url: "<?php echo base_url('admin/webchat/addWebNotes'); ?>",
							type: "POST",
							data: {room:newToken, msg:NotesContent, chatTo:chatTo, currentUser:currentUser,notes:'1',_token:'{{csrf_token()}}'},
							dataType: "json",
							success: function (response) {
								if (response.status == "success") {

									webNoteslisting(chatTo);
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
		$(document).on('click', '.preview_image_button_cl_notes', function() {
		$('#preview_image_notes').attr('user_id',$(this).attr('user_id'));
		$('#preview_image_notes').attr('newToken',$(this).attr('newToken'));
			
		 $('#preview_image_notes').trigger('click');
		});
		//  ######### media  file upload ############ //

	});
	
	$('#preview_image_notes').change(function() {
		
		$('.overlaynew').show();
		var NotesTo  = $('#preview_image_notes').attr('user_id');
		var newToken =  $('#preview_image_notes').attr('newToken');
			const files = document.querySelector('[id=preview_image_notes]').files;
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
							url: "<?php echo base_url('admin/Chat/addChatNotes'); ?>",
							type: "POST",
							data: {room:newToken, msg:msg, chatTo:NotesTo, currentUser:currentUser,notes:'1'},
							dataType: "json",
							success: function (response) {
								if (response.status == "ok") {
									webNoteslisting(NotesTo);
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
	
	$(document).on('click', '.WebcreateNotes', function(e) {
		e.preventDefault();
		var dyId = $(this).attr('user_id');
		var msgHeight = document.getElementById("notes_box_listing_"+dyId).scrollHeight;
		$("#notes_box_listing_"+dyId).scrollTop(msgHeight);
	});
	
	function webNoteslisting(NotesTo){
			$.ajax({
				url: '<?php echo base_url('admin/webchat/listingNotes'); ?>',
				type: "POST",
				data: {'NotesTo' : NotesTo,notes_from:'web',_token:'{{csrf_token()}}'},
				dataType: "html",
				success: function (data) {
					$('#notes_box_listing_'+NotesTo).html(data);
					    var msgHeight = document.getElementById("notes_box_listing_"+NotesTo).scrollHeight;
						$("#notes_box_listing_"+NotesTo).scrollTop(msgHeight);
					
					},error: function(){
					alertMessage('Error: Some thing wrong!');
				}
			});
		}
	
	
</script>