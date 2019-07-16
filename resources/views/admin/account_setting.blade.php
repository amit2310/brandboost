@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>

<style type="text/css">
	.dropzone .dz-default.dz-message:before { content: ''!important; }
	.dropzone {min-height:40px; padding:4px!important;}
	.dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
	.dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
	.product_icon img{ width: 50px; height: 50px; border-radius: 100px;}
	.input-group-addon{border:none!important;}
	.panel .dropzone{border-color: #ddd!important;}
</style>

<?php
	$countries = getAllCountries();
	$aUInfo = $userDetail;
	$cb_contact_id = $aUInfo->cb_contact_id;
	$userId = $aUInfo->id; 
	$user_role = $aUInfo->user_role;
	$avatar = $aUInfo->avatar; 
	if(!empty($avatar)){
		$srcUserImg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$avatar;
	}
	else{
		$srcUserImg = '/profile_images/avatar_image.png';
	}
	
	$phone_display = $aUInfo->phone_display;
	$website_display = $aUInfo->website_display;
	$email_noti = $aUInfo->email_noti;
	$pass_ex_noti = $aUInfo->pass_ex_noti;
	$new_msg_noti = $aUInfo->new_msg_noti;
	$new_task_noti = $aUInfo->new_task_noti;
	$new_contact_req_noti = $aUInfo->new_contact_req_noti;

?>
<div class="content">
	
	<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header pt20">
		<div class="row">
			<!--=============Headings & Tabs menu==============-->
			<div class="col-md-12">
				<h3><img style="width: 18px;" src="/assets/images/user_settings_icon.png"> Account Settings</h3>
			</div>
		</div>
	</div>
	<!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
	
	
	<!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
	<div class="row"> 
		<div class="col-md-6">
			<div class="panel panel-flat review_ratings">
				<div class="panel-heading">
					<h6 class="panel-title">Account Info</h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				</div>
				<div class="panel-body p0">
					
					<!--====LOGO SETTINGS====-->
					<form method="POST" name="frmSubmit" id="frmSubmit" action="#"  enctype="multipart/form-data">
						<div class="bbot p30 profile_photo_settings">
							<div class="row">
								<div class="col-md-3"><p class="text-muted">Avatar</p></div>
								<div class="col-md-2 brig"><img class="avatar userAvatar" src="<?php echo $srcUserImg; ?>"/></div>
								<div class="col-md-6 col-md-offset-1">
									<div class="form-group mb0">
										<label class="control-label">Photo</label>
										<div class="input-group dropzone" id="myDropzone_avatar">
											<span class="input-group-addon"><i class="icon-upload7"></i></span>
											<div class=""></div>
											<input style="display: none;" type="text" name="avatar" id="avatar" value="<?php echo (!empty($aUInfo->avatar)) ? $aUInfo->avatar : ''; ?>" >
										</div>
										
										
										
									</div>
								</div>
							</div>
						</div>
						<!--====GENERAL SETTINGS====-->
						<div class="bbot p30">
							<div class="row">
								<div class="col-md-3"><p class="text-muted">General Info</p></div>
								<div class="col-md-9">
									<div class="form-group">
										<label class="control-label">Firstname</label>
										<div class="">
											<input name="firstname" id="firstname" class="form-control" required="" type="text" placeholder="maxive" value="<?php echo (!empty($aUInfo->firstname)) ? $aUInfo->firstname : ''; ?>">
										</div>
										
										
									</div>
									
									<div class="form-group">
										<label class="control-label">Lastname</label>
										<div class="">
											<input name="lastname" id="lastname" class="form-control" required="" type="text" placeholder="maxive" value="<?php echo (!empty($aUInfo->lastname)) ? $aUInfo->lastname : ''; ?>">
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label">Country</label>
										<div class="">
											<select class="form-control"  name="country">
												<?php if(!empty($countries)) foreach($countries as $country): ?>
												<option value="<?php echo $country->country_code; ?>" <?php echo ($country->country_code == $aUInfo->country) ? 'selected': ''?>>
													<?php echo $country->name; ?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label w100">Phone number <span class="pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field chk_change" name="phone_display" chkName="phone_display" value="<?php echo $phone_display; ?>" type="checkbox" <?php echo $phone_display == 1?'checked':'';?>>
												<span class="toggle"></span>
											</label>
										</span>
										</label>
										<div class="">
											<input name="mobile" id="mobile" class="form-control" required="" type="text" placeholder="+3 8063 612 53 69" value="<?php echo (!empty($aUInfo->mobile)) ? $aUInfo->mobile : ''; ?>">
										</div>
									</div>
									
									
									
									<div class="form-group">
										<label class="control-label w100">Website <span class="pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field chk_change" name="website_display" chkName="website_display" value="<?php echo $website_display; ?>" type="checkbox" <?php echo $website_display == 1?'checked':'';?>>
												<span class="toggle"></span>
											</label>
										</span>
										</label>
										
										<div class="">
											<input name="website" id="website" class="form-control"  type="text" placeholder="www.wakers.co" value="<?php echo (!empty($aUInfo->website)) ? $aUInfo->website : ''; ?>">
										</div>
									</div>
									
									<input type="hidden" name="userId" id="userId" value="<?php echo $userId; ?>">
									
									<!--====SAVE====-->
									
								<button type="submit" style="float: right;" class="btn dark_btn ml20 bkg_purple" >Save</span> </button>
								
							</div>
							
						</div>
						
						
					</div>
					
					
					
					
				</form>
				<!--====SOCIAL SETTINGS====-->


				
				<form method="POST" name="frmChangePasswordN" id="frmChangePasswordN" action="#" >
					<div class="bbot p30">
						<div class="row">
							<div class="col-md-3"><p class="text-muted">Password</p></div>
							<div class="col-md-9">
								<div class="form-group">
									<label class="control-label">Current password</label>
									<div class="">
										<input type="password" name="oldPassword" id="oldPassword" placeholder="Enter current password" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">New password</label>
									<div class="">
										<input type="password" name="newPassword" id="newPassword" placeholder="Enter new password" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Repeat new password</label>
									<div class="">
										<input type="password" name="rePassword" id="rePassword" placeholder="Repeat new password" class="form-control" required>
									</div>
								</div>
								
								
							</div>
						</div>
					</div>
					<!--====SAVE====-->
					<div class="p30">
						<div class="row">
							<div class="col-md-12 text-right">
							<button type="button" class="btn white_btn ml20 txt_purple" >Cancel</span> </button>
						<button type="submit" class="btn dark_btn ml20 bkg_purple" >Save</span> </button>
						
					</div>
				</div>
			</div>
		</form>
		
	</div>
</div>
<!--====DELETE====-->
<div class="panel panel-flat review_ratings">
	<div class="panel-heading">
		<h6 class="panel-title">Delete user account</h6>
		<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
	</div>
	<div class="panel-body p0">
		<div class="p30">
			<div class="row">
				<div class="col-md-5">
					<p>Please note:<br><span class="text-muted">If you delete your account, you won’t be able to reactive it later.</span></p>
				</div>
				<div class="col-md-7 text-right mt-20">
				<button type="button" class="btn white_btn ml20 txt_purple delete_account" >Delete  account</span> </button>
			</div>
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
								<input class="field chk_change" name="email_noti" chkName="email_noti" value="<?php echo $email_noti; ?>" type="checkbox" <?php echo $email_noti == 1?'checked':'';?>>
							<span class="toggle"></span> </label>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-group">
							<label class="control-label">Email</label>
							<div class="">
								<input name="user_email" class="form-control" value="<?php echo $aUInfo->email; ?>" type="text" placeholder="max@wakers.co" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="p30">
				<div class="row">
					<div class="col-md-3">
						<p class="text-muted">Events</p>
					</div>
					<div class="col-md-9"> 
						<div class="form-group mb10">
							<p class="pull-left mb0">Password expiaration notification</p>
							<label class="custom-form-switch pull-right">
								<input class="field chk_change" name="pass_ex_noti" chkName="pass_ex_noti" value="<?php echo $pass_ex_noti; ?>" type="checkbox" <?php echo $pass_ex_noti == 1?'checked':'';?>>
							<span class="toggle"></span> </label>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-group mb10">
							<p class="pull-left mb0">New message notification</p>
							<label class="custom-form-switch pull-right">
								<input class="field chk_change" name="new_msg_noti" chkName="new_msg_noti" value="<?php echo $new_msg_noti; ?>" type="checkbox" <?php echo $new_msg_noti == 1?'checked':'';?>>
							<span class="toggle"></span> </label>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-group mb10">
							<p class="pull-left mb0">New task notifitcation</p>
							<label class="custom-form-switch pull-right">
								<input class="field chk_change" name="new_task_noti" chkName="new_task_noti" value="<?php echo $new_task_noti; ?>" type="checkbox" <?php echo $new_task_noti == 1?'checked':'';?>>
							<span class="toggle"></span> </label>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-group mb0">
							<p class="pull-left mb0">New contact request notification</p>
							<label class="custom-form-switch pull-right">
								<input class="field chk_change" name="new_contact_req_noti" chkName="new_contact_req_noti" value="<?php echo $new_contact_req_noti; ?>" type="checkbox" <?php echo $new_contact_req_noti == 1?'checked':'';?>>
							<span class="toggle"></span> </label>
							<div class="clearfix"></div>
						</div>
						
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->




</div>





<script>
	
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
	
	
	var myDropzoneLogoImg = new Dropzone(
	'#myDropzone_avatar', //id of drop zone element 1
	{
		url: '<?php echo base_url("/dropzone/upload_profile_image"); ?>',
		uploadMultiple: false,
		maxFiles: 1,
		maxFilesize: 600,
		acceptedFiles: 'image/*',
		addRemoveLinks: false,
		success: function(response) {
			$('#avatar').val(response.xhr.responseText);
			$('.userAvatar').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+response.xhr.responseText);
			setTimeout(function(){
				$('#myDropzone_avatar .dz-preview').hide();
			}, 3500);
		}
	});

	myDropzoneLogoImg.on("complete", function(file) {
	  myDropzoneLogoImg.removeFile(file);
	});
	
	Dropzone.autoDiscover = false;
	
	
	$(document).ready(function() {
		
		$("#frmSubmit").submit(function (e) {
			
			e.preventDefault();
			
			$('.overlaynew').show();
			
			var formdata = new FormData(this);
			
			$.ajax({
				url: "<?php echo base_url('/admin/account_setting/saveProfileDetail'); ?>",
				type: "POST",
				data: formdata,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					
					if (response.status == 'success') {
						
						if(response.userId != 1){
							window.location.href = '';
						}
						else{
							window.location.href = '';
						}
						
						} else {
						
						alertMessage(response.msg);
						$('.overlaynew').hide();
						
					}
					
				},
				error: function (response) {
					alertMessage(response.msg);
					$('.overlaynew').hide();
				}
			});
			return false;
		});
		
		$("#frmChangePasswordN").submit(function (e) {
			
			e.preventDefault();
			$('.overlaynew').show();
			var formdata = new FormData(this);
			$.ajax({
				url: "<?php echo base_url('/admin/profile/changePassword'); ?>",
				type: "POST",
				data: formdata,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					
					if (response.status == 'success') {
						
						window.location.href = '';
						} else {
						alertMessage(response.msg);
						$('.overlaynew').hide();
					}
					
				},
				error: function (response) {
					alertMessage(response.msg);
					$('.overlaynew').hide();
				}
			});
			return false;
		});
		
		$(document).on('click', '.delete_account', function() {
			
			var elem = $(this);
			swal({
				title: "Are you sure? You want to delete the account!",
				text: "You will not be able to recover this account!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#EF5350",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel pls!",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function (isConfirm) {
				if (isConfirm) {
					$('.overlaynew').show();
					
					$.ajax({
						url: '<?php echo base_url('admin/account_setting/account_deleted'); ?>',
						type: "POST",
						data: {},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							}
						}
					});
				}
			});
		});
		
		
		$(document).on('change', '.chk_change', function() {
			
			var getCheckVal;
			var chkName = $(this).attr('chkName');
			if($(this).prop('checked') == true)
			{
				getCheckVal = 1;
			}
			else {
				getCheckVal = 0;
			}
			$.ajax({
				url: '<?php echo base_url('admin/account_setting/account_detail_check'); ?>',
				type: "POST",
				data: {getCheckVal:getCheckVal, chkName:chkName},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						
					}
				}
			});
		});
		
	});
	
</script>

@endsection