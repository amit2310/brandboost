@php
	if (!empty($oMemberships)) {
		foreach ($oMemberships as $oMembership) {
			if ($oMembership->plan_id == $oUser->plan_id) {
				$oRegularMembership = $oMembership;
			}

			if (@$oMembership->plan_id == @$oUser->topup_plan_id) {
				$oTopupMembership = $oMembership;
			}
		}
	}

	$oCountries = getAllCountries();
@endphp
<script src="{{ base_url() }}assets/dropzone-master/dist/dropzone.js"></script>
<link href="{{ base_url() }}assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{{ base_url() }}/new_pages/assets/js/plugins/forms/tags/tokenfield.min.js"></script>
<style>
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:40px;}
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .dropzone .dz-preview.dz-image-preview { display:none !important;}
	
	.tokenfield.form-control {
	height: 135px;
	padding: 10px;
}
.tokenfield .token:not([class*="bg-"]) {
	background-color: #ebe6ff;
	color: #7f62df;
	border-radius: 5px;
}
</style>
<div class="tab-pane @if(empty($seletedTab)) active @endif " id="right-icon-tab0">
    <div class="row"> 
        <div class="col-md-6">
            <div class="panel panel-flat review_ratings">
                <form id="frmGeneralBusinessInfo" name="frmGeneralBusinessInfo" method="post">
                    <div class="panel-heading">
                        <h6 class="panel-title">Brand Info</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                    </div>
                    <div class="panel-body p0">
                        <div class="bbot p30">
                            <div class="brand_subs">
                                <div class="row">
                                    <div class="col-md-7"><img width="24" class="pull-left mr-20" src="{{ base_url() }}assets/images/company_profile_dark.png"/><p class="mb0"><span class="text-muted">Current plan:</span> {{ !empty($oRegularMembership) ? $oRegularMembership->level_name : '[No Data]' }}</p></div>
                                    <div class="col-md-5 text-right"><a style="text-decoration:underline;" class="txt_purple showSubPage" href="javascript:void(0);">Manage Subscription</a></div>
                                </div>

                            </div>
                        </div>
                        <!--====LOGO SETTINGS====-->
                        
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Logo</p></div>
                                <div class="col-md-2 brig"><img class="img-circle" id="brand_logo_image_preview" width="64" height="64" src=@if (!empty($oUser->company_logo)) https://s3-us-west-2.amazonaws.com/brandboost.io/{{ $oUser->company_logo }} @else {{ base_url() }}assets/images/wakerslogo.png @endif"/></div>

                                <div class="col-md-6 col-md-offset-1">
                                    <div class="form-group mb0">
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                        <div class="dropzone" id="myDropzone"></div>
                                        <div style="display: none;" id="uploadedSiteFiles"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="company_logo" name="company_logo" value="{{ $oUser->company_logo }}">
                        </div>
                        <!--====GENERAL SETTINGS====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">General Info</p></div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label">Business name</label>
                                        <div class="">
                                            <input name="company_name" class="form-control" required="" type="text" value="{{ $oUser->company_name }}" placeholder="Wakers Inc.">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <div class="">
                                            <select name="company_country" class="form-control">
                                                <option value="">Select Country</option>
                                                @if (!empty($oCountries)) 
													@foreach ($oCountries as $oCountry)
														<option value="{{ $oCountry->country_code }}" {!! ($oCountry->country_code == $oUser->company_country) ? 'selected' : '' !!}>
															{{ $oCountry->name }}
														</option>
													@endforeach
												@endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Business address</label>
										<span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp; 
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="business_address_dppa" {!! $oUser->business_address_dppa == 1 ? 'checked' : '' !!}>
												<span class="toggle blue"></span>
											</label>
										</span>
                                        <div class="">
                                            <input name="company_address" class="form-control" type="text" value="{{ $oUser->company_address }}" placeholder="Kiev, Ukraine">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Phone number</label>
										<span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp; 
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="phone_no_dppa" {!! $oUser->phone_no_dppa == 1 ? 'checked' : '' !!}>
												<span class="toggle blue"></span>
											</label>
										</span>
                                        <div class="">
                                            <input name="company_phone" class="form-control" type="text" value="{{ $oUser->company_phone }}" placeholder="+3 8063 612 53 69">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Website</label>
										<span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp; 
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="website_dppa" {!! $oUser->website_dppa == 1 ? 'checked' : '' !!}>
												<span class="toggle blue"></span>
											</label>
										</span>
                                        <div class="">
                                            <input name="company_website" class="form-control" type="text" value="{{ $oUser->company_website }}" placeholder="www.wakers.co">
                                        </div>
                                    </div>
									<input class="field" name="business_address_dppa" type="hidden" value="{{ $oUser->business_address_dppa }}">
									<input class="field" name="phone_no_dppa" type="hidden" value="{{ $oUser->phone_no_dppa }}">
									<input class="field" name="website_dppa" type="hidden" value="{{ $oUser->website_dppa }}">

                                </div>
                            </div>
                        </div>
                        <!--====SOCIAL SETTINGS====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Socials</p></div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label">Facebook</label>
                                        <div class="">
                                            <input name="social_facebook" class="form-control" type="text" value="{{ $oUser->social_facebook }} }}" placeholder="@wakers">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Instagram</label>
                                        <div class="">
                                            <input name="social_instagram" class="form-control" type="text" value="{{ $oUser->social_instagram }}" placeholder="@wakers.agency">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Twitter</label>
                                        <div class="">
                                            <input name="social_twitter" class="form-control" type="text" value="{{ $oUser->social_twitter }}" placeholder="@wakers">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Linkedin</label>
                                        <div class="">
                                            <input name="social_linkedin" class="form-control" type="text" value="{{ $oUser->social_linkedin }}" placeholder="@wakersco">
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                        <!--====SAVE====-->
                        <div class="p30">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <!-- <button type="button" class="btn white_btn ml20 txt_purple" >Preview</span> </button> -->
                                    <button type="submit" class="btn dark_btn ml20 bkg_purple saveUserOtherInfo" >Save</span> </button>

                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <!--====DELETE====-->
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Delete brand account</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0">
                    <div class="p30">
                        <div class="row">
                            <div class="col-md-5">
                                <p>Please note:<br><span class="text-muted">If you delete your account, you won’t be able to reactive it later.</span></p>
                            </div>
                            <div class="col-md-7 text-right mt-20">
                                <button type="button" class="btn white_btn ml20 txt_purple" >Delete "Wakers" brand account</span> </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-flat review_ratings">
                <form id="frmGeneralBusinessInfo2" name="frmGeneralBusinessInfo2" method="post">
                    <div class="panel-heading">
                        <h6 class="panel-title">Public Profile</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                    </div>
                    <div class="panel-body p0">
                        <div class="bbot p30">
                            <div class="brand_subs" style="border-top:2px solid #9b83ff;">
                                <div class="row">
                                    <div class="col-md-2 text-center mt10"><img src="{{ base_url() }}assets/images/public_profile.png"/></div>
                                    <div class="col-md-10">
                                        <p class="mb-20">Public profiles are free and increase your online presence and trust. Show reviews, photos and more on a pixel-prerfect, mobile-friendly brand page.</p>

                                        <a href="http://pleasereviewmehere.com/campaign/raymond-194" target="_blank"><button type="button" class="btn white_btn mr20 txt_purple" >View example</span> </button></a>
                                        <button type="button" class="btn dark_btn mr20 bkg_purple" >Set live now</span> </button>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Public profile link</p></div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label">Shareable link to your public profile</label>
                                       									
										<div class="input-group">
										<input name="public_profile_link" class="form-control txt_purple" type="text" value="{{ $oUser->public_profile_link }}" placeholder="https://zipbooks.com/brand/wakers">
										<span class="input-group-addon"><i class="icon-link txt_grey"></i></span>
										<span class="input-group-addon"><i class="icon-pencil txt_grey"></i></span>
										</div>


                                    </div>

                                    <p class="pull-left">Publish page <span class="text-muted">Last publication {{ date("M d, H:i", strtotime($oUser->updated)) }}</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input class="field" id="public_publish_page" @if ($oUser->public_publish_page) hecked="checked" @endif type="checkbox">
                                        <span class="toggle"></span>
                                    </label>
                                    <input class="field" name="public_publish_page" type="hidden" value="{{ $oUser->public_publish_page }}">

                                </div>
                            </div>
                        </div>

                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Business info</p></div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label">Business types</label>
                                        <div class="form-group-material">
                                            <input name="company_type" class="form-control token-field" type="text" value="{{ $oUser->company_type }}" placeholder="Business types">
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Where you operate</label>
                                        <div class="">
                                            
											<div class="btn-group" data-toggle="buttons">
												<label class="btn white_btn {{ ($oUser->company_operate_scope == 'worldwide' || $oUser->company_operate_scope == '') ? 'txt_purple' : '' }} h40 m0 width_170 changeBA1">
													<input type="radio" name="company_operate_scope" id="company_operate_scope1" value="worldwide" @if ($oUser->company_operate_scope == 'worldwide' || $oUser->company_operate_scope == '') checked @endif ><i class="fa fa-globe"></i> Worldwide
												</label>
												<label class="btn white_btn {{ $oUser->company_operate_scope == 'locally' ? 'txt_purple' : '' }} h40 m0 width_170 changeBA1">
													<input type="radio" name="company_operate_scope" id="company_operate_scope2" value="locally" @if ($oUser->company_operate_scope == 'locally') checked @endif ><i class="icon-location3"></i> Locally
												</label>
											</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
										<label class="control-label">Working hours</label>
										<div class="">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn white_btn {{ ($oUser->company_working_hours == '8' || $oUser->company_working_hours == '') ? 'txt_purple' : '' }} h40 m0 width_170 changeBA2">
													<input type="radio" name="company_working_hours" id="company_working_hours1" value="8" @if ($oUser->company_working_hours == '8' || $oUser->company_working_hours == '') checked @endif >8 AM
												</label>
												<label class="btn white_btn h40 m0 width_170 {{ $oUser->company_working_hours == '6' ? 'txt_purple' : '' }} changeBA2">
													<input type="radio" name="company_working_hours" id="company_working_hours2" value="6" @if ($oUser->company_working_hours == '6') checked @endif >6 PM
												</label>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>

                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Description & SEO</p></div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label">Business description</label>
                                        <div class="">
                                            <textarea name="company_description" style="height:200px; resize:none;" class="form-control" placeholder="So strongly and metaphysically did I conceive of my situation then, that while earnestly watching his motions, I seemed distinctly to perceive that my own individuality was now merged in a joint stock company of two; that my free will had received a mortal wound; and that another's mistake or misfortune might plunge innocent me into unmerited disaster and death.">{{ $oUser->company_description }}</textarea>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">SEO Keywords</label>
                                        <div class="">
                                            <textarea name="company_seo_keywords" style="height:120px; resize:none;" class="form-control" placeholder="e.g. design, agency, studio, website design, web design, designer, logo, branding, ui, ux, webdesign, app design, website templates, user expirience, website dev">{{ $oUser->company_seo_keywords }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p30">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="http://pleasereviewmehere.com/campaign/raymond-194" target="_blank"><button type="button" class="btn white_btn ml20 txt_purple">Preview </button></a>
                                    <button type="submit" class="btn dark_btn ml20 bkg_purple">Save </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function () {
		$(".token-field").on('tokenfield:createdtoken tokenfield:removedtoken change', function (e) {
			if($(this).parent().children().hasClass('token')) {
				$(this).parent().find('.token-input').attr('placeholder', '');
			}
			else {
				$(this).parent().find('.token-input').attr('placeholder', '- Tokenfield');
			}
		}).trigger('change');
		
		$('.showSubPage').click(function(){
			$('.nav-tabs a[href="#right-icon-tab2"]').tab('show');
		});
		
		
		$('.changeBA1').click(function(){
			$('.changeBA1').removeClass('txt_purple');
			$(this).addClass('txt_purple');
		});
		
		$('.changeBA2').click(function(){
			$('.changeBA2').removeClass('txt_purple');
			$(this).addClass('txt_purple');
		});
		
		$('#public_publish_page').change(function () {
            if ($(this).is(":checked") == true) {
                $('input[name="public_publish_page"]').attr("value", 1);
            } else {
                $('input[name="public_publish_page"]').attr("value", 0);
            }
        });
		
		$('#business_address_dppa').change(function () {
			if ($(this).is(":checked") == true) {
				$('input[name="business_address_dppa"]').attr("value", 1);
			} else {
				$('input[name="business_address_dppa"]').attr("value", 0);
			}
		});
	  
        $('#phone_no_dppa').change(function () {
            if ($(this).is(":checked") == true) {
                $('input[name="phone_no_dppa"]').attr("value", 1);
            } else {
                $('input[name="phone_no_dppa"]').attr("value", 0);
            }
        });
		
		$('#website_dppa').change(function () {
            if ($(this).is(":checked") == true) {
                $('input[name="website_dppa"]').attr("value", 1);
            } else {
                $('input[name="website_dppa"]').attr("value", 0);
            }
        });


        Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone(
		'#myDropzone', //id of drop zone element 1
		{
			url: '{{ base_url("webchat/dropzone/upload_s3_attachment") }}/{{ $oUser->id }}/onsite',
			uploadMultiple: false,
			maxFiles: 1,
			maxFilesize: 600,
			acceptedFiles: 'image/*',
			addRemoveLinks: false,
			success: function (response) {
				
				if(response.xhr.responseText != "") {

					$('#brand_logo_image_preview').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
					var dropImage = $('#company_logo').val();
					$.ajax({
						url: "{{ base_url('admin/brandboost/deleteObjectFromS3') }}",
						type: "POST",
						data: {dropImage: dropImage, _token: '{{ csrf_token() }}'},
						dataType: "json",
						success: function (data) {
							console.log(data);
						}
					});
				   
					$('#company_logo').val(response.xhr.responseText);
					$('.saveUserOtherInfo').trigger('click');
				}
			}
		});
		
		myDropzone.on("complete", function(file) {
		  myDropzone.removeFile(file);
		});
    });
</script>