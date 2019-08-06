@extends('layouts.user_template') 

@section('title')
<?php //echo $title; ?>
@endsection

@section('contents')
  <style type="text/css">
    /*.icons.fl_letters { background-image: linear-gradient(79deg, #5869eb, #6190fa)!important; }*/

    .icons.fl_letters { background-image: linear-gradient(259deg, #9b83ff, #6145d4) !important; }
    span.icons.fl_letters { width: 32px; height: 32px; box-shadow: none !important; background: #7a8dae; background-image: none; text-align: center; text-transform: uppercase; line-height: 32px; color: #fff; border-radius: 100px; font-size: 12px; font-weight: 500; display: block; }
  </style>
   <script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
  <div class="content_area">
    <div class="row">
      <div class="col-md-12">
        <div class="white_box text-center profile_sec mb25">
         <div class="review_edit">
			  	<a href="<?php echo base_url(); ?>user/setting"><img src="<?php echo base_url(); ?>assets/profile_images/settings_40.png"></a>
			  </div>
         <?php //pre($aUInfo->avatar); 
           ?>
          <div class="p25 bbot">
            <div class="profile_avatar">
              <div style="cursor:pointer;" class="media-left media-middle pr10 uploadAvatar"> 
              <?php echo showUserAvtar($aUInfo->avatar, $aUInfo->firstname, $aUInfo->lastname, '80', '80', '25'); ?>
              </div> 
              <div class="input-group dropzone hidden" id="myDropzone_avatar">
                  <span class="input-group-addon"><i class="icon-upload7"></i></span>
                  <div class=""></div> 
              </div>
              <!-- <img src="<?php echo base_url(); ?>assets/profile_images/profile_img.png"/> --> </div>
            <h3>Hello, <?php echo $aUInfo->firstname.' '.$aUInfo->lastname; ?>!</h3>
            <p><?php echo $aUInfo->email; ?></p>
          </div>

          <div class="p40 text-center profile_user_data">
            <div class="row">
              <div class="col-md-4">
                <p><strong class="txt_dark"><?php echo number_format(count($oReviews)); ?></strong><br>
                  <span>Reviews Added</span></p>
              </div>
              <div class="col-md-4">
                <p><strong class="txt_dark">1,489</strong><br>
                  <span>Reviews Views</span></p>
              </div>
              <div class="col-md-4">
                <p><strong class="txt_dark">251</strong><br>
                  <span>Likes / Dislikes</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="white_box user_sections">
          <div class="media-left"><img src="<?php echo base_url(); ?>assets/profile_images/user_review_icon.png"/></div>
          <div class="media-left">
            <h3>My reviews</h3>
            <p>On BrandBoost, you can write reviews about companies, product or services you used and purchased . </p>
            <a href="<?php echo base_url(); ?>user/review">View all reviews <i class="icon-arrow-right13"></i></a> </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="white_box user_sections">
          <div class="media-left"><img src="<?php echo base_url(); ?>assets/profile_images/user_profile_icon.png"/></div>
          <div class="media-left">
            <h3>Profile</h3>
            <p>On BrandBoost, you can write reviews about companies, product or services you used and purchased . </p>
            <a href="<?php echo base_url(); ?>user/setting">Account settings <i class="icon-arrow-right13"></i></a> </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="white_box user_sections">
          <div class="media-left"><img src="<?php echo base_url(); ?>assets/profile_images/user_pw_icon.png"/></div>
          <div class="media-left">
            <h3>Personal Website</h3>
            <p>On BrandBoost, you can write reviews about companies, product or services you used and purchased . </p>
            <a style="cursor: pointer;">Account settings <i class="icon-arrow-right13"></i></a> </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="white_box user_sections">
          <div class="media-left"><img src="<?php echo base_url(); ?>assets/profile_images/user_discover_icon.png"/></div>
          <div class="media-left">
            <h3>Discover Businesses</h3>
            <p>On BrandBoost, you can write reviews about companies, product or services you used and purchased . </p>
            <a style="cursor: pointer;">View all businesses <i class="icon-arrow-right13"></i></a> </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    
    $(document).ready(function() {

      $(document).on('click', '.uploadAvatar', function() {

          $('#myDropzone_avatar').trigger('click');
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
      
      //Dropzone.autoDiscover = false;
    
  </script>

  @endsection