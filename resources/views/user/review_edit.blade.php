@extends('layouts.user_template') 

@section('title')
<?php //echo $title; ?>
@endsection

@section('contents')

  <script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>

  <style type="text/css">
  	.step_star ul > li.star.hover > i.fa { color:#FFCC36; }
	.step_star ul > li.star.selected > i.fa { color:#FFCC36; }
	.dropzone .dz-default.dz-message:before { content: '';!important }
	/*.dz-default .dz-message { display: none; }*/
  </style>
  <div class="content_area">
    <div class="row">
      <div class="col-md-12">
        <div class="white_box profile_sec mb20">
         <div style="top: 35px;" class="backbtn">
			  	<a href="<?php echo base_url(); ?>user/review"><img src="<?php echo base_url(); ?>assets/profile_images/back_40.png"></a>
			  </div>
         <div style="top: 35px;" class="review_edit">
			  	<a style="cursor: pointer;"><img src="<?php echo base_url(); ?>assets/profile_images/edit_40.png"></a>
			  </div>
          <div class="p25 bbot text-center">
            <h3>Edit Review</h3>
            <p>Basic information that you use in BrandBoost services.</p>
          </div>
          
          
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      		<?php //pre($myReview); ?>
       	   <!--================Review 1=================-->
        	<div class="white_box p0">
			  <div class="p25 pl30 pr30 bb_bbot">
			  	<p class="fsize14 txt_dark m0">Product Review</p>
			  	<p class="fsize12 txt_grey m0">Rate your Purchases and tell us what you thought of them</p>
			  </div>
			  
			  <div class="p30 pt40">
			  
				<form method="post" id="updateReview" action="javascript:void();">

				<?php 
					$starRating = array(1=>'Poor', 2=>'Fair', 3=>'Good', 4=>'Excellent', 5=>'WOW!!!');
				?>
				<div class="form-group">
					<label class="control-label">Star rating</label>
					<div class="step_star" style="padding: 5px 0;">
                        <ul id='stars'>
                        	<?php foreach($starRating as $key => $sRate) {
                        		$selected = '';
                        		if($key <= $myReview->ratings) {
                        			$selected = 'selected';
	                        	}
                        		?>
                        		<li class='star <?php echo $selected; ?>' title='<?php echo $sRate; ?>' data-value='<?php echo $key; ?>'>
	                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>
	                            </li>
                        		<?php
	                        } ?>
                        </ul>
                    </div>
                    <input type="hidden" value="<?php echo $myReview->ratings; ?>" id="ratingValue" name="ratingValue">
                </div>

				
				<div class="form-group">
				  <label class="control-label">Review Headline</label>
				  <input name="edit_review_title" id="edit_review_title" class="form-control h52" value="<?php echo $myReview->review_title; ?>" required="" placeholder="Review Title" type="text">
				</div>					
									
				<div class="form-group">
				  <label class="control-label">Review Headline</label>
				  <textarea style="min-height: 294px; resize: none;" name="edit_content" class="form-control p20"><?php echo $myReview->comment_text; ?></textarea>
				</div>
									
				<div class="form-group bbot pb20 mb30">
				  <label class="control-label">Upload photo or video</label>
				  <label class="pull-right">5 media max. &nbsp; <a href="#">Video & Images Rules</a></label>
				 <!--  <label class="display-block" for="companylogo">
				  <div class="img_vid_upload">
				   
				  </div>
				  </label> -->


					<div class="clearfix"></div>
					<div class="dropzone img_vid_upload drag_bx" id="myDropzone">
						<!-- <span class="drop_rate">
							<img src="<?php echo base_url(); ?>/assets/images/review/drag_icon.png">
							<div class="Drag-Drop-Your-Fil">Drag &amp; Drop Your Files</div>
							<div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
						</span> -->
						<div class="dz-message" data-dz-message><span></span></div>
					</div>
					<div id="uploadedReviewFiles"></div>
				</div>
								
										
				<div class="form-group m0">
				  <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="<?php echo $myReview->id; ?>">
				  <button type="submit" class="btn btn_dark bkg_blue h52 txt_white" style="min-width: 140px;">Primary</button>
				  <button class="btn btn-link txt_blue">Cancel</button>
				</div>					
				</form>																							
																																													

			  </div>
			  
			  
			</div>
     
    
     
     
     
      </div>
    </div>
    
  </div>

  <script type="text/javascript">
  	
  	$(document).ready(function() {

  		$("#updateReview").submit(function () {
            var formData = new FormData($(this)[0]);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '<?php echo base_url("admin/reviews/update_review"); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    console.log(data);
                    if (data.status == 'success') {
                        //alert('Review has been update successfully.');
                        setTimeout(function () {
                            window.location.href = '';
                        }, 1000);
                    } else {
                        alert('Error: Some thing wrong!');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                }
            });
        });

  		var ratingValue = 0;
        $('#stars li').on('mouseover', function () {
            var onStar = parseInt($(this).data('value'), 10);
            $(this).parent().children('li.star').each(function (e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('li.star').each(function (e) {
                $(this).removeClass('hover');
            });
        });

        $('#stars li').on('click', function () {
            var onStar = parseInt($(this).data('value'), 10);
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            $('#ratingValue').val(ratingValue);

        });

        Dropzone.autoDiscover = false;
		var myDropzone_ = new Dropzone(	
			'#myDropzone', //id of drop zone element 1
			{
				url: '<?php echo base_url("dropzone/uploadQuestionFiles"); ?>',
				uploadMultiple: false,
				maxFiles: 5,
				maxFilesize: 6000,
				acceptedFiles: 'image/*,video/mp4',
				addRemoveLinks: false,
				success: function (response) {
					$('#uploadedReviewFiles').append(response.xhr.responseText);
				}
			});

  	});
  </script>

  @endsection