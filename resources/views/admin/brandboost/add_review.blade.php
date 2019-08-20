@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<style type="text/css">
	
	.selected{
			text-shadow: 0 1px 0 0 rgba(255, 160, 79, 0.15)!important;
			color: #ffcd5e!important;
			font-size: 18px; 
			margin-right: 3px;
	}

	.dropzone {
		border-radius: 5px;
		box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);
		border: solid 1px #f3f4f7;
		background-color: #fff;
		text-align: center;
		padding-top: 30px;
	}
		
	.dz-default {
		display: none;
	}

	.img_vid_upload_new {
	    width: 100%;
	    min-height: 233px;
	    border-radius: 4px;
	    background: '#fff';
	    border: 1px dashed #dfe5f0;
	}
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/touchspin.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>

	  <div class="content">
	  
	  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
		<div class="page_header">
		  <div class="row">
		  <!--=============Headings & Tabs menu==============-->
			<div class="col-md-5">
			  <h3 class="mt30"><img width="18" src="<?php echo base_url(); ?>assets/images/plus_icon_purple.png"/> Add Review</h3>
			</div>
			<!--=============Button Area Right Side==============-->
			<div class="col-md-7 text-right btn_area">
				<button type="button" class="btn light_btn" id="saveReview" ><i class="icon-plus3"></i><span> &nbsp;  Save Review</span> </button>
			    <button type="button" class="btn dark_btn ml20" id="publishReview" ><i class="icon-plus3"></i><span> &nbsp;  Publish Review</span> </button>
			</div>
		  </div>
		</div>
	  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

		
		
		<!--================================= CONTENT AFTER TAB===============================-->
		<div class="row">
			<div class="col-md-6">

				<form method="post" name="frmSiteReviewSubmit" id="frmSiteReviewSubmit" container_name="sitereview" action="#"  enctype="multipart/form-data">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Service Review</h6>
					<div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
				  </div>
				  <div class="panel-body p25 bkg_white">
				    

				  	   <div class="form-group">
			  		   <label class="fsize14 fw500">Review Headline</label>
			  		   <input type="text" class="h52 form-control"  name="title" id="site-title"placeholder="Review Headline" required>
			  		   </div>
			  		   
			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Review Text</label>
			  		   <textarea rows="5" name="description" id="site-description" class="form-control" placeholder="Tell you what you thought of their service…" required></textarea>
			  		   </div>
			  		   
			  		   <div class="form-group mb0">
			  		   <div class="row">
			  		   <div class="col-md-7">
			  		   <label class="fsize14 fw500">Rating</label>
			  		   
			  		   <?php $reviewRating = 3; ?>
			  		   <div class="review_star_box starRate">
							<?php 
								for($inc = 1; $inc <= 5; $inc++) {
								?>
								<i data-value='<?php echo $inc; ?>' id="siteStarRating<?php echo $inc; ?>" containerclass="siteRatingValue" class="icon-star-full2  <?php echo $inc <= $reviewRating?'selected':''; ?>"></i>
								<?php 
								}
							?>
							<div class="rat_num hidden"><?php echo $reviewRating; ?>/5</div>
						</div>
			  		   

			  		   </div>
			  		   <div class="col-md-5">
			  		   <label class="fsize14 fw500">&nbsp;</label>
			  		   <!--<input type="text" class="h52 form-control" placeholder="4 / 5">-->
					    <input type="text" value="" id="siteReviewRating" class="touchspin-vertical form-control h52" placeholder="4 / 5" readonly>
			  		   </div>
			  		   </div>
			  		   </div>
				   
					
				  </div>
				</div>
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Image &amp; Video</h6>
					<div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
				  </div>
				  <div class="panel-body p25 bkg_white">
				  
				  		<label class="display-block" for="inputfile">
				  		<div class="img_vid_upload dropzone"  id="myDropzone">
				  		<!-- <input class="hidden" type="file" name="" value="" id="inputfile"> -->
				  		</div>
				  		</label>
				  </div>
				</div>
				<div id="uploadedSiteFiles"></div>
				<!-- <input style="display: none;"  name="display_name" value="1" type="checkbox"> -->
				<?php //pre($oCampaign);
				//pre($aBrandboostList[0]->id); ?>
				<input type="hidden" name="campaign_id" class="campaign_id" value="<?php echo $oCampaign->id != ''? $oCampaign->id : $aBrandboostList[0]->id; ?>" />
				<input type="hidden" name="subID" value="" />
				<input type="hidden" name="inviterID" value="<?php echo $aUser->id; ?>" />
				<input type="hidden" name="user_id" value="<?php //echo $aUser->id; ?>" />
				<input type="hidden" value="<?php echo $reviewRating; ?>" class="siteRatingValue" id="siteRatingValue" name="ratingValue">
				<input type="hidden" value="site" id="reviewType" name="reviewType">
				<input type="hidden" name="reviewStatus" class="reviewStatus" value="2">
				<input type="hidden" name="display_name" class="display_name" value="<?php echo $aUser->firstname.' '.$aUser->lastname; ?>">
				<input type="hidden" name="display_email" class="display_email" value="<?php echo $aUser->email; ?>">
				<input type="hidden" name="change_phone" class="change_phone" value="<?php echo $aUser->mobile; ?>">
				
				
				<input type="submit" style="display: none;" class="sav_con buttonSiteReview" id="buttonSiteReview"  value="Save & Continue">

				</form>
				
				<hr>
				
				<form method="post" name="frmProductReviewSubmit" id="frmProductReviewSubmit" container_name="productreview" action="#"  enctype="multipart/form-data">
					<div class="panel panel-flat">
					  <!--<div class="panel-heading">
						<h6 class="panel-title">Product 1 Review</h6>
						<div class="heading-elements"><a href="#"><img src="assets/images/more.svg"></a></div>
					  </div>-->
					  
					  <div class="panel-heading">
							<h6 class="panel-title">Product Review</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
	                	</div>
	                	
	                	
					  <div class="panel-body bkg_white p25">
					  
					  	   <div class="form-group">
				  		   <label class="fsize14 fw500">Review Headline</label>
				  		   <input type="text" name="title" class="h52 form-control" placeholder="Review Headline" required>
				  		   </div>
				  		   
				  		   <div class="form-group">
				  		   <label class="fsize14 fw500">Review Text</label>
				  		   <textarea rows="5" name="description" class="form-control" placeholder="Tell you what you thought of their service…" required></textarea>
				  		   </div>
				  		   
				  		   <div class="form-group mb0">
				  		   <div class="row">
				  		   <div class="col-md-7">
				  		   <label class="fsize14 fw500">Rating</label>

				  		   <?php $reviewRating = 3; ?>
				  		   <div class="review_star_box starRate">
								<?php 
									for($inc = 1; $inc <= 5; $inc++) {
									?>
									<i data-value='<?php echo $inc; ?>' id="productStarRating<?php echo $inc; ?>" containerclass="productRatingValue" class="icon-star-full2  <?php echo $inc <= $reviewRating?'selected':''; ?>"></i>
									<?php 
									}
								?>
								<div class="rat_num hidden"><?php echo $reviewRating; ?>/5</div>
							</div>

				  		   </div>
				  		   <div class="col-md-5">
				  		   <label class="fsize14 fw500">&nbsp;</label>
				  		  <input type="text" value="" id="productReviewRating" class="touchspin-vertical-product form-control h52" placeholder="4 / 5">
				  		   </div>
				  		   </div>
				  		   </div>
					   
						
					  </div>
					</div>
					<div class="panel panel-flat">
					  <!--<div class="panel-heading">
						<h6 class="panel-title">Image &amp; Video</h6>
						<div class="heading-elements"><a href="#"><img src="assets/images/more.svg"></a></div>
					  </div>-->
					  
					  <div class="panel-heading">
							<h6 class="panel-title">Image &amp; Video</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
	                	</div>
	                	
	                	
					  <div class="panel-body p25 bkg_white">
					  
					  		<label class="display-block" for="inputfile">
					  		<div class="img_vid_upload dropzone" id="myDropzone2">
					  		<!-- <input class="hidden" type="file" name="" value="" id="inputfile"> -->
					  		</div>
					  		</label>
					  		
					  		
					  </div>
					</div>

					<div id="uploadedProductFiles"></div>
					<!-- <input style="display: none;"  name="display_name" value="1" type="checkbox"> -->
					<input type="hidden" name="campaign_id" class="campaign_id" value="<?php echo $oCampaign->id != ''? $oCampaign->id : $aBrandboostList[0]->id; ?>" />
					<input type="hidden" name="subID" value="" />
					<input type="hidden" name="inviterID" value="<?php echo $aUser->id; ?>" />
					<input type="hidden" name="user_id" value="<?php //echo $aUser->id; ?>" />
					<input type="hidden" value="<?php echo $reviewRating; ?>" id="productRatingValue" name="ratingValue">
					<input type="hidden" value="product" id="reviewType" name="reviewType">
					<input type="hidden" name="reviewStatus" class="reviewStatus" value="2">
					<input type="hidden" name="display_name" class="display_name" value="<?php echo $aUser->firstname.' '.$aUser->lastname; ?>">
					<input type="hidden" name="display_email" class="display_email" value="<?php echo $aUser->email; ?>">
					<input type="hidden" name="change_phone" class="change_phone" value="<?php echo $aUser->mobile; ?>">

					<input type="submit" style="display: none;" class="sav_con buttonProductReview" id="buttonProductReview"  value="Save & Continue">
				</form>
				
				<hr>
				
				<!-- <div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Add product</h6>
					<div class="heading-elements"><a href="#">+</a></div>
				  </div>
				</div> -->
				
			  </div>
			  
			  
			    <div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Contact Info</h6>
					<div class="heading-elements"><a href="javascript;void();"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
				  </div>
				  <div class="panel-body p25">
				  <div class="form-group">
				 	<label class="fsize14 fw500">Campaign</label>
				 	<?php 
				 	 //pre($oCampaign);
				 	 if(!empty($aBrandboostList)) {
				 	 ?><select class="h52 form-control changeCampaign" disabled=""><?php
					 	foreach($aBrandboostList as $brandboostlist){
					 		
					 		?><option value="<?php echo $brandboostlist->id; ?>" <?php echo $oCampaign->id == $brandboostlist->id?'selected':'';?>><?php echo $brandboostlist->brand_title; ?></option><?php
						 }
						 ?></select><?php
					 }
				 	 ?>
			  		
		  		   </div>
			  		   
			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Fill name</label>
			  		   <input type="text" value="<?php echo $aUser->firstname.' '.$aUser->lastname; ?>" class="h52 form-control changeName" placeholder="Enter contact full name">
			  		   </div>
			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Email</label>
			  		   <input type="text" class="h52 form-control changeEmail" value="<?php echo $aUser->email; ?>" placeholder="Contact email">
			  		   </div>

			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Pnone Number</label>
			  		   <input type="text" class="h52 form-control changePhone" value="<?php echo $aUser->mobile; ?>" placeholder="Contact phone">
			  		   </div>
			  		   
			  		    <label class="custmo_checkbox pull-left mb0 fsize14 fw500">
						<input type="checkbox" checked="checked">
						<span class="custmo_checkmark purple"></span>
						Create new contact from review
						</label>
		  		   
		  		   
			  		   
				  		   
					
				  </div>
				</div>
			  </div>
			  
			  
			  
		</div>
		<!--================================= CONTENT AFTER TAB===============================-->
		
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

	
	
	// Vertical spinners
    $(".touchspin-vertical").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'icon-arrow-up22',
        verticaldownclass: 'icon-arrow-down22',
        min:1,
        max:5
    });

    $(".touchspin-vertical-product").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'icon-arrow-up22',
        verticaldownclass: 'icon-arrow-down22',
        buttondown_class: 'btn btn-default product',
        buttonup_class: 'btn btn-default product',
        min:1,
        max:5
    });

    $(document).ready(function() {

    	$(document).on('click', '#saveReview', function() {
    		$('.reviewStatus').val('2');
    		$('#buttonSiteReview').trigger('click');
    		$('#buttonProductReview').trigger('click');
		});

		$(document).on('click', '#publishReview', function() {
			$('.reviewStatus').val('1');
			$('#buttonSiteReview').trigger('click');
    		$('#buttonProductReview').trigger('click');
		});

    	$("#frmSiteReviewSubmit, #frmProductReviewSubmit").submit(function () {
			var formdata = new FormData(this);
			var containerName = $(this).attr("container_name");
			$('.overlaynew').show();
			$.ajax({
				url: "<?php echo base_url('/reviews/saveManualReview'); ?>",
				type: "POST",
				data: formdata,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					if (response.status == 'success') {
						$('.overlaynew').hide();
						if(response.type === 'product') {
							//window.location.href = "<?php echo base_url(); ?>admin/brandboost/onsite_setup/"+response.brandboostId;

							window.location.href = '';
						}
						
						} else {
						$('.overlaynew').hide();
						alertMessage(response.msg);
					}
				},
				error: function (response) {
					$('.overlaynew').hide();
					alertMessage(response.msg);
				}
			});
			return false;
		});

		

		/*$(document).ready(function(){ 
			$('.drop_rate').click(function() {
				$('#myDropzone').trigger('click');
			});
			$('.drop_rate_review').click(function() {
				$('#myDropzone2').trigger('click');
			});
		});*/

		$(document).on('click', '#myDropzone', function() {
			$(this).removeClass('img_vid_upload');
			$(this).addClass('img_vid_upload_new');
		});
		$(document).on('click', '#myDropzone2', function() {
			$(this).removeClass('img_vid_upload');
			$(this).addClass('img_vid_upload_new');
		});

		var rating = $('#siteRatingValue').val();
		var productRating = $('#productRatingValue').val();

		$('#siteReviewRating').val(rating+' / 5'); 
		$('#productReviewRating').val(productRating+' / 5'); 

		$(document).on('click', '.bootstrap-touchspin-up', function() {
			
			if(!$(this).hasClass('product')) {

				if(rating < 5) {
					rating++;
					$('#siteReviewRating').val(rating+' / 5');
					if(rating == 5) {
						$(this).attr("disabled", "disabled");
					}
					$(this).next().prop("disabled", false);
				} else {
					$('#siteReviewRating').val(rating+' / 5');
	;				$(this).attr("disabled", "disabled");
					$(this).next().prop("disabled", false);
				}

				$('#siteRatingValue').val(rating);
				$('#siteStarRating'+rating).trigger('click');
			}
			else {

				if(productRating < 5) {
					productRating++;
					$('#productReviewRating').val(productRating+' / 5');
					if(productRating == 5) {
						$(this).attr("disabled", "disabled");
					}
					$(this).next().prop("disabled", false);
				} else {
					$('#productReviewRating').val(productRating+' / 5');
	;				$(this).attr("disabled", "disabled");
					$(this).next().prop("disabled", false);
				}

				$('#productRatingValue').val(productRating);
				$('#productStarRating'+productRating).trigger('click');
				
			}
		});


		$(document).on('click', '.bootstrap-touchspin-down', function() {
			
			if(!$(this).hasClass('product')) {

				if(rating > 1) {
					rating--;
					$('#siteReviewRating').val(rating+' / 5');
					if(rating == 1) {
						$(this).attr("disabled", "disabled");
					}
					$(this).prev().prop("disabled", false);
				}
				else {
					$('#siteReviewRating').val(rating+' / 5');
					$(this).attr("disabled", "disabled");
					$(this).prev().prop("disabled", false);
				}

				$('#siteRatingValue').val(rating);
				$('#siteStarRating'+rating).trigger('click');
			}
			else {

				if(productRating > 1) {
					productRating--;
					$('#productReviewRating').val(productRating+' / 5');
					if(productRating == 1) {
						$(this).attr("disabled", "disabled");
					}
					$(this).prev().prop("disabled", false);
				}
				else {
					$('#productReviewRating').val(productRating+' / 5');
					$(this).attr("disabled", "disabled");
					$(this).prev().prop("disabled", false);
				}

				$('#productRatingValue').val(productRating);
				$('#productStarRating'+productRating).trigger('click');
			}
		});


		$('.starRate i').on('click', function () {
			var valContainer = $(this).attr('containerclass');
			var onStar = parseInt($(this).data('value'), 10);
			$(this).parent().find('div.rat_num').html(onStar+'/5');
			var stars = $(this).parent().children('i');
			for (i = 0; i < stars.length; i++) {
				$(stars[i]).removeClass('selected');
			}
			
			for (i = 0; i < onStar; i++) {
				$(stars[i]).addClass('selected');
			}
			
			ratingValue = $(this).attr("data-value");
			$('#' + valContainer).val(ratingValue);


			if(valContainer == 'siteRatingValue') {
				rating = ratingValue;
				$('#siteReviewRating').val(rating+' / 5'); 
			}
			else {
				productRating = ratingValue;
				$('#productReviewRating').val(productRating+' / 5'); 
			}		
		});


		$('.changeCampaign').change(function() {

			var campaignId = $(this).val();
			$('.campaign_id').val(campaignId);
		});

		$('.changeName').keyup(function() {

			var changeName = $(this).val();
			$('.display_name').val(changeName);
		});

		$('.changeEmail').keyup(function() {

			var changeEmail = $(this).val();
			$('.display_email').val(changeEmail);
		});

		$('.changePhone').keyup(function() {

			var changePhone = $(this).val();
			$('.change_phone').val(changePhone);
		});

    });

    Dropzone.options.myDropzone = {
		url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment_review/".$aUser->id."/reviews"); ?>',
		uploadMultiple: false,
		maxFiles: 5,
		maxFilesize: 250,
		acceptedFiles: 'image/*,video/mp4',
		addRemoveLinks: false,
		success: function (response) {
			$('#myDropzone').removeClass('img_vid_upload');
			$('#myDropzone').addClass('img_vid_upload_new');
			$('#uploadedSiteFiles').append(response.xhr.responseText);
		}
		
	}

	Dropzone.options.myDropzone2 = {
		url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment_product_review/".$aUser->id."/reviews"); ?>',
		uploadMultiple: false,
		maxFiles: 5,
		maxFilesize: 250,
		acceptedFiles: 'image/*,video/mp4',
		addRemoveLinks: false,
		success: function (response) {
			$('#myDropzone2').removeClass('img_vid_upload');
			$('#myDropzone2').addClass('img_vid_upload_new');
			$('#uploadedProductFiles').append(response.xhr.responseText);
		}
	}
		
	</script>
	@endsection