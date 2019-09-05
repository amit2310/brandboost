
@extends('layouts.main_template') 

@section('title')
{{ $title }}
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

<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/forms/inputs/touchspin.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/dropzone-master/dist/dropzone.js"></script>

	  <div class="content">
	  
	  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
		<div class="page_header">
		  <div class="row">
		  <!--=============Headings & Tabs menu==============-->
			<div class="col-md-5">
			  <h3 class="mt30"><img width="18" src="{{ base_url() }}assets/images/plus_icon_purple.png"/> Add Question</h3>
			</div>
			<!--=============Button Area Right Side==============-->
			<div class="col-md-7 text-right btn_area">
				<button type="button" class="btn light_btn" id="saveQuestion" ><i class="icon-plus3"></i><span> &nbsp;  Save Question</span> </button>
			    <button type="button" class="btn dark_btn ml20" id="publishQuestion" ><i class="icon-plus3"></i><span> &nbsp;  Publish Question</span> </button>
			</div>
		  </div>
		</div>
	  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
	  
		<!--================================= CONTENT AFTER TAB===============================-->
		<div class="row">
			<div class="col-md-6">

				<form method="post" name="frmQuestionSubmit" id="frmQuestionSubmit" container_name="sitereview" action="#"  enctype="multipart/form-data">
				@csrf
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Add Question</h6>
					<div class="heading-elements"><a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a></div>
				  </div>
				  <div class="panel-body p25 bkg_white">
				    
				  	   <div class="form-group">
			  		   <label class="fsize14 fw500">Question Headline</label>
			  		   <input type="text" class="h52 form-control"  name="title" id="site-title"placeholder="Question Headline" required>
			  		   </div>
			  		   
			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Question Text</label>
			  		   <textarea rows="5" name="description" id="site-description" class="form-control" placeholder="Tell you what you thought of their service…" required></textarea>
			  		   </div>
					
				  </div>
				</div>
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Image &amp; Video</h6>
					<div class="heading-elements"><a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a></div>
				  </div>
				  <div class="panel-body p25 bkg_white">
				  
				  		<label class="display-block" for="inputfile">
				  		<div class="img_vid_upload dropzone"  id="myDropzone">
				  		</div>
				  		</label>
				  </div>
				</div>
				<!-- <div id="uploadedQuestionFiles"></div> -->
				<input type="hidden" name="campaign_id" class="campaign_id" value="{{ $oCampaign->id != ''? $oCampaign->id : $aBrandboostList[0]->id }}" />
				<input type="hidden" name="subID" value="" />
				<input type="hidden" name="inviterID" value="{{ $aUser->id }}" />
				<input type="hidden" name="user_id" value="" />
				<input type="hidden" name="questionStatus" class="questionStatus" value="2">
				<input type="hidden" name="display_name" value="1" >
				<input type="hidden" name="fullname" class="display_name" value="{{ $aUser->firstname.' '.$aUser->lastname }}">
				<input type="hidden" name="emailid" class="display_email" value="{{ $aUser->email }}">
				<input type="hidden" name="phone" class="change_phone" value="{{ $aUser->mobile }}">
				<input type="submit" style="display: none;" class="sav_con buttonQuestion" id="buttonQuestion"  value="Save & Continue">

				</form>
			  </div>
			    <div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Contact Info</h6>
					<div class="heading-elements"><a href="javascript;void();"><img src="{{ base_url() }}assets/images/more.svg"></a></div>
				  </div>
				  <div class="panel-body p25">
				  <div class="form-group">
				 	<label class="fsize14 fw500">Campaign</label>
				 	@if(!empty($aBrandboostList))
						<select class="h52 form-control changeCampaign">
						@foreach($aBrandboostList as $brandboostlist)
							<option value="{{ $brandboostlist->id }}" {!! $oCampaign->id == $brandboostlist->id ? 'selected':'' !!} >
								{{ $brandboostlist->brand_title }}
							</option>						
						@endforeach
						</select>
					@endif
			  		
		  		   </div>
			  		   
			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Fill name</label>
			  		   <input type="text" value="{{ $aUser->firstname.' '.$aUser->lastname }}" class="h52 form-control changeName" placeholder="Enter contact full name">
			  		   </div>
			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Email</label>
			  		   <input type="text" class="h52 form-control changeEmail" value="{{ $aUser->email }}" placeholder="Contact email">
			  		   </div>

			  		   <div class="form-group">
			  		   <label class="fsize14 fw500">Pnone Number</label>
			  		   <input type="text" class="h52 form-control changePhone" value="{{ $aUser->mobile }}" placeholder="Contact phone">
			  		   </div>
			  		   
			  		    <label class="custmo_checkbox pull-left mb0 fsize14 fw500">
						<input type="checkbox" checked="checked">
						<span class="custmo_checkmark purple"></span>
						Create new contact from question
						</label>
				  </div>
				</div>
			  </div>
		</div>
		<!--================================= CONTENT AFTER TAB===============================-->
	  </div>
<script>

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

    	$(document).on('click', '#saveQuestion', function() {
    		$('.questionStatus').val('2');
    		$('#buttonQuestion').trigger('click');
		});

		$(document).on('click', '#publishQuestion', function() {
			$('.questionStatus').val('1');
			$('#buttonQuestion').trigger('click');
		});

		
		$("#frmQuestionSubmit").submit(function () {
			var formdata = new FormData(this);
			$('.overlaynew').show();
			$.ajax({
				url: "{{ base_url('/admin/questions/saveManualQuestion') }}",
				type: "POST",
				data: formdata,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					if (response.status == 'ok') {
						$('.overlaynew').hide();
						window.location.href = '';
						
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

		

		$(document).on('click', '#myDropzone', function() {
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
					$(this).attr("disabled", "disabled");
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
					$(this).attr("disabled", "disabled");
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

	var myDropzone_ = new Dropzone(	
		"#myDropzone",
		{
			url: '{{ base_url("dropzone/upload_s3_attachment_question_review/".$aUser->id."/reviews") }}',
			uploadMultiple: false,
			maxFiles: 10,
			maxFilesize: 600,
			acceptedFiles: 'image/*,video/mp4',
			addRemoveLinks: false,
			success: function (response) {
				$('#uploadedQuestionFiles').append(response.xhr.responseText);
			}
		});
		
	</script>
	@endsection