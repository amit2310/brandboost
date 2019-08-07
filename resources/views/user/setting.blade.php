@extends('layouts.user_template') 

@section('title')
<?php //echo $title; ?>
@endsection

@section('contents')
  <style type="text/css">
    .icons.fl_letters { background-image: linear-gradient(259deg, #9b83ff, #6145d4) !important; }
    span.icons.fl_letters { width: 32px; height: 32px; box-shadow: none !important; background: #7a8dae; 
      background-image: none; text-align: center; text-transform: uppercase; line-height: 32px; color: #fff; 
      border-radius: 100px; font-size: 12px; font-weight: 500; display: block; }
  </style>
  <!-- <link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" /> -->
  <script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
  <div class="content_area">
    <div class="row">
      <div class="col-md-12">
        <div class="white_box text-center profile_sec mb25">
          <div class="p25">
            <h3>Personal Data</h3>
            <p>Basic information that you use in BrandBoost services.</p>
          </div>
          
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="white_box">
         <div class="p20 bbot">
         	<p class="mb-5"><strong>Profile</strong></p>
         	<p class="fsize12 txt_grey m0">Some information may be visible to other users.</p>
         </div>
         <?php //pre($aUInfo); ?>
         <div class="pl20 pr20">
         	<div class="user_form_details">
         		<ul>
         			<li><span>User avatar</span><strong class="txt_grey fw400 uploadAvatar" style="cursor: pointer;">Photography helps to personalize your account.</strong>
       			      <div class="user_avatar uploadAvatar" style="cursor: pointer;">
                      <div class="media-left media-middle pr10"> 
                      <?php echo showUserAvtar($aUInfo->avatar, $aUInfo->firstname, $aUInfo->lastname, '40', '40', '14'); ?>
                      </div>
                  </div>
                  <div class="input-group dropzone hidden" id="myDropzone_avatar">
                      <span class="input-group-addon"><i class="icon-upload7"></i></span>
                      <div class=""></div> 
                  </div>
         			</li>
         			<li><span>Name</span><strong class="usernameShow"><?php echo $aUInfo->firstname.' '.$aUInfo->lastname; ?></strong><input class="userEditShow" style="display: none;" type="text" value="<?php echo $aUInfo->firstname.' '.$aUInfo->lastname; ?>"><a style="cursor: pointer;" class="username_edit email_edit"><img src="<?php echo base_url(); ?>assets/profile_images/edit_icon.png"/></a><button style="display: none;" class="usernameSave">Save</button></li>

         			<li><span>Email address</span><strong><?php echo $aUInfo->email; ?></strong></li>
         			<li><span>Sex</span><strong>Male</strong></li>
         			<li><span>Birth day</span><strong>13 May 1974</strong></li>
         			
         		</ul>
         	</div>
         </div>
         
         
        </div>
      </div>

      <div class="col-md-12">
        <div class="white_box">
         <div class="p20 bbot">
            <p class="mb-5"><strong>Change password</strong></p>
            <p class="fsize12 txt_grey m0">Change your password.</p>
          </div>
          <div class="pl20 pr20">
            <div class="user_form_details">
                <div class="errMsg" style="color: red; display: none;"></div>
                <div class="succMsg" style="color: green; display: none;"></div>
                <form method="POST" name="frmChangePasswordN" id="frmChangePasswordN" action="#" >
                    <ul>
                        <li><label>Old Password</label><input type="password" name="oldPassword" id="oldPassword" class="form-control passCh" value="" required></li>
                        <li><label>New Password</label><input type="password" name="newPassword" id="newPassword" class="form-control passCh" value="" required></li>
                        <li></label>Reenter New Password</label><input type="password" name="rePassword" id="rePassword" class="form-control passCh" value="" required></li>
                        <li><button type="submit" class="btn dark_btn  bkg_purple" >Save</span> </button></li>
                    </ul>
                </form>
            </div>
          </div>
        </div>
     </div>

      <div class="col-md-12">
        <div class="white_box">
         <div class="p20 bbot">
         	<p class="mb-5"><strong>Contact info</strong></p>
         	<p class="fsize12 txt_grey m0">Some information may be visible to other users.</p>
         </div>
         
         <div class="pl20 pr20">
         	<div class="user_form_details">
         		<ul>
         			<li><span>Email address</span><strong><?php echo $aUInfo->email; ?></strong></li>

         			<li><span>Phone</span><strong class="userphoneShow"><?php echo $aUInfo->mobile != ''?$aUInfo->mobile:'N/A'; ?></strong><input class="userPhoneEditShow" style="display: none;" type="text" value="<?php echo $aUInfo->mobile; ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><span id="error" style="color: #FF0000; display: none">* Input digits (0 - 9)</span> <a style="cursor: pointer;" class="userphone_edit email_edit"><img src="<?php echo base_url(); ?>assets/profile_images/edit_icon.png"/></a><button style="display: none;" class="userphoneSave">Save</button> </li>

         			<li><span>Country</span><strong><img style="margin-top: 4px;" class="valign-top" src="<?php echo base_url(); ?>assets/profile_images/us_icon.png"/> &nbsp; United States</strong></li>
         		</ul>
         	</div>
         </div>
         
         
        </div>
      </div>
    </div>
    
  </div>

  <script type="text/javascript">

      $(document).ready(function() {

        $('#myDropzone_avatar').hide();

        $(document).on('click', '.uploadAvatar', function() {
            $('#myDropzone_avatar').trigger('click');
        });

        $(document).on('click', '.userphone_edit', function() {
            $('.userphoneShow').hide();
            $('.userPhoneEditShow').show();
            $(this).hide();
            $('.userphoneSave').show();
        });

        $(document).on('click', '.userphoneSave', function(){

            var userphone = $('.userPhoneEditShow').val();
            $.ajax({
                url: "<?php echo base_url('/admin/profile/changeUserphone'); ?>",
                type: "POST",
                data: {'userphone':userphone},
                dataType: "json",
                success: (response) => {
                   
                    if (response.status == 'success') {
                        $('.userPhoneEditShow').hide();
                        $('.userphoneShow').text(userphone);
                        $('.userphoneShow').show();
                        $(this).hide();
                        $('.userphone_edit').show();

                    } else {
                       
                    }

                },
                error: function (response) {

                }
            });
            return false;
        });

        $(document).on('click', '.username_edit', function() {

            $('.usernameShow').hide();
            $('.userEditShow').show();
            $(this).hide();
            $('.usernameSave').show();
        });

        $(document).on('click', '.usernameSave', function(){

            var username = $('.userEditShow').val();
            $.ajax({
                url: "<?php echo base_url('/admin/profile/changeUsername'); ?>",
                type: "POST",
                data: {'username':username},
                dataType: "json",
                success: (response) => {
                   
                    if (response.status == 'success') {
                        $('.userEditShow').hide();
                        $('.usernameShow').text(username);
                        $('.usernameShow').show();
                        $(this).hide();
                        $('.username_edit').show();

                    } else {
                       
                    }

                },
                error: function (response) {

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
                    $('.errMsg').html('');
                    $('.succMsg').html('');
                    $('.errMsg').show();
                    $('.succMsg').show();
                    if (response.status == 'success') {
                        
                        $('.succMsg').html(response.msg);
                        $('.passCh').val('');
                        setTimeout(function() {
                            $('.succMsg').hide();
                        }, 3000);
                    } else {
                        $('.errMsg').html(response.msg);
                        setTimeout(function() {
                            $('.errMsg').hide();
                        }, 3000);
                    }
                    
                },
                error: function (response) {
                    $('.errMsg').html(response.msg);


                }
            });
            return false;
        });

      });

      Dropzone.autoDiscover = false;

      var myDropzoneLogoImg = new Dropzone(
        '#myDropzone_avatar', //id of drop zone element 1
        {
            url: '<?php echo base_url("/dropzone/upload_profile_image"); ?>',
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 60000,
            acceptedFiles: 'image/*',
            addRemoveLinks: false,
            success: function(response) {
                $('.media-left .icons').removeClass('fl_letters');
                $('.media-left .icons').html('<img class="img-circle" src="" >');
                $('.img-circle').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+response.xhr.responseText);
                var logoImage = response.xhr.responseText;
                $.ajax({
                    url: "<?php echo base_url('/user/setting/updateProfile'); ?>",
                    type: "POST",
                    data: {avatar: logoImage},
                    dataType: "json", 
                    success: function (response) {
                         
                        if (response.status == 'ok') {

                        } else {
                            
                        }
                    },
                    error: function (response) {
                        /*alertMessage(response.msg);
                        $('.overlaynew').hide();*/
                    }
                });
                
               /* setTimeout(function(){
                    $('#myDropzone_avatar .dz-preview').hide();
                }, 3500);*/
            }
        });

      myDropzoneLogoImg.on("complete", function(file) {
        myDropzoneLogoImg.removeFile(file);
      });
        
        
  </script>

  @endsection