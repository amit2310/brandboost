<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); ?>

<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/color/spectrum.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/picker_color.js"></script>

<style type="text/css">
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:80px; opacity:0;height:80px; }
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
	.productSectionNew{margin-top: 30px; border-top: 3px solid #ECECEC; padding-top: 20px;}
</style>

<div class="tab-pane <?php echo $camp; ?>" id="right-icon-tab11">
    <form method="post" id="addOnsiteStepList" action="#" >
        <input name="brandboostId" id="brandboostId" value="<?php echo $brandboostData->id; ?>" type="hidden">
        <div class="row">
            <div class="col-md-3">
                <div style="margin: 0;" class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Campaign Settings</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
                    <div class="panel-body p0">
                        <div class="p25 bbot">
                            <div class="form-group mb0">
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="feedback_type" class="autoSave" value="public" type="radio" <?php echo ($feedbackResponseData->feedback_type == '' || $feedbackResponseData->feedback_type == 'public') ? 'checked' : ''; ?>>
                                    <span class="custmo_radiomark"></span>
                                    Public
								</label>
                                <label class="custmo_radiobox pull-left mb20 ml10">
                                    <input  name="feedback_type" class="autoSave" value="private" type="radio" <?php echo $feedbackResponseData->feedback_type == 'private' ? 'checked' : ''; ?>>
                                    <span class="custmo_radiomark"></span>
                                    Private
								</label>
							</div>
						</div>
						
                        <div class="p25 bbot">
                            <div class="form-group mb0">
                                <?php if ($canWrite == TRUE): ?>
								<span class="display-inline-block pull-left fsize13">Activate Campaign</span>
								<span class="display-inline-block pull-right fsize13">
									<label class="custom-form-switch pull-left">
										<input class="field autoSave" type="checkbox" id="publishOnsiteCampaign" <?php echo $brandboostData->status == 1 ? 'checked' : ''; ?>>
										<span class="toggle blue"></span>
									</label>
								</span>
								
                                <?php endif; ?> 
								
							</div> 
						</div>
						
						
                        <div class="configurations bbot p25">
							
                            <div class="form-group">
                                <label class="control-label">Review Request "Form" Name</label>
                                <div class="">
                                    <input  value="<?php echo ($feedbackResponseData->from_name) ? $feedbackResponseData->from_name : $aUserInfo->firstname . ' ' . $aUserInfo->lastname; ?>" name="from_name" id="from_name" class="form-control autoSave" type="text" onkeypress="return IsAlphabet(event);">
                                    <div class="errorMsg"></div>
								</div>
							</div>
							
                            <div class="form-group">
                                <label class="control-label">Review Request "Form" Email</label>
                                <div class="">
                                    <input value="<?php echo ($feedbackResponseData->from_email) ? $feedbackResponseData->from_email : $aUserInfo->email; ?>" name="from_email" id="from_email" class="form-control autoSave" required="" type="text">
                                    <div class="errorMsg"></div>
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label">SMS Sender Phone</label>
                                <div class="">
                                    <input value="<?php echo ($fromNumber) ? mobileNoFormat($fromNumber) : mobileNoFormat($aUserInfo->mobile); ?>" name="sender_name" id="sender_name" placeholder="Mr Anderson" class="form-control autoSave" type="text" readonly="readonly">
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label">Review Request Language </label>
                                <div class="">
                                    <select class="form-control">
                                        <option>English (USA)</option>
									</select>
								</div>
							</div>
						</div>
						
						<!--  *** add detail *** -->
                        <div class="profile_headings">Brand Boost Details <!-- <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a> --></div>
						
                        <div class="configurations p25">
                            <?php 
								$domain_name = $brandboostData->domain_name;
								$brand_title = $brandboostData->brand_title;
								$brand_desc = $brandboostData->brand_desc; 
								$logo_img = $brandboostData->logo_img;
								$brandImgArray = unserialize($brandboostData->brand_img);
								if (!empty($brandImgArray[0]['media_url'])) {
									$brand_img = $brandImgArray[0]['media_url'];
								}
								
							?>
							
                            <input type="hidden" name="edit_logo_img" id="edit_logo_img" value="<?php echo $logo_img; ?>" />
                            <input type="hidden" name="edit_brand_img" id="edit_brand_img" value=<?php echo serialize($brandImgArray); ?> />
							
                            <div class="barand_avatar mb20">
                                <img width="64" height="65" class="rounded" id="showLogoImage" onerror="this.src='<?php echo base_url('assets/images/default-logo.png'); ?>'" src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $logo_img; ?>">
							</div>
							
                            <div class="form-group">
                                <label class="control-label">Brand Boost Name</label>
                                <div class="">
                                    <input  name="title" id="brand_title" value="<?php echo $brand_title != '' ? $brand_title : ''; ?>" placeholder="New Product on Site Boost" class="form-control autoSave" required="" type="text">
								</div>
							</div>
							<div class="form-group">
                                <label class="control-label">Domain</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input  name="domain_name" id="domain_name" value="<?php echo $domain_name != '' ? $domain_name : ''; ?>" class="form-control autoSave" placeholder="www.google.com" type="text">
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label">Brand Boost Description</label>
                                <div class="">
                                    <textarea class="form-control autoSave" id="brand_desc" placeholder="Brand Boost Description" name="desc"><?php echo $brand_desc != '' ? trim($brand_desc) : ''; ?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label">Brand Logo</label>
								<label class="display-block">
									<input type="hidden" name="logo_img" id="logo_img" value="<?php echo $logo_img; ?>">
									<div class="img_vid_upload_small">
										<div class="dropzone" id="myDropzone_logo_img"></div>
									</div>
								</label>
							</div>
							
							
							<div class="profile_headings" style="margin:40px 0 20px;">Product Details</div>
							
							<div id="productMainContainer">
								<?php if(count($bbProductsData) < 1){ ?>
									<div class="barand_avatar mb20 productPreviewImg">
										<?php 
											echo '<img width="65" height="65" id="showBrandImage1" class="rounded company_avatar" onerror="this.src=\'http://brandboost.io/assets/images/default_table_img2.png\'" src="https://s3-us-west-2.amazonaws.com/brandboost.io/'. $bbProductsData[0]->product_image.'">';
										?>
									</div>
									<div class="productSection">
										<div class="form-group">
											<label class="control-label">Product Name</label>
											<div class="">
												<input name="brand_product_name[]" value="<?php echo $bbProductsData[0]->product_name != '' ? trim($bbProductsData[0]->product_name) : ''; ?>" placeholder="Product Name" class="form-control autoSave" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label">Product Description</label>
											<div class="">
												<textarea class="form-control autoSave" placeholder="Product Description" name="brand_product_desc[]"><?php echo $bbProductsData[0]->product_description != '' ? trim($bbProductsData[0]->product_description) : ''; ?></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label">Product image</label>
											<label class="display-block">
												<input type="hidden" name="product_type[${newProdCount}]" value="product">
												<input type="hidden" name="product_img[]" id="product_img_1" value="<?php echo $bbProductsData[0]->product_image != '' ? trim($bbProductsData[0]->product_image) : ''; ?>">
												<div class="img_vid_upload_small">
													<div class="dropzone myDropzone_product_img_1"></div>
												</div>
											</label>
										</div>
									</div>
								<?php 
								}else{
									$productCount = 1;
									foreach($bbProductsData as $key=>$productData){ 
										if($productData->product_type != 'service'){
								?>
										<div class="productSectionNew productBoxSection<?php echo $key; ?>" style="<?php echo $key == 0 ? 'border-top:none;' : ''; ?>">
											<div class="barand_avatar mb20 productPreviewImg">
												<?php 
													echo '<img width="65" height="65" id="showBrandImage'.$productCount.'" class="rounded company_avatar" onerror="this.src=\'http://brandboost.io/assets/images/default_table_img2.png\'" src="https://s3-us-west-2.amazonaws.com/brandboost.io/'. $productData->product_image.'">';
												?>											
											</div>
											<div class="form-group">
												<label class="control-label">Product Name</label>
												<?php if($key != 0){ ?>
												<a class="deleteProductItem" data-order="<?php echo $key; ?>"><div class="text-center" style="float: right; height: 25px; width: 25px; border-radius: 25px; background: #D7D7E8; margin-top:-5px;">x</div></a>
												<?php } ?>
												<div class="">
													<input name="brand_product_name[<?php echo $key; ?>]" value="<?php echo $productData->product_name != '' ? trim($productData->product_name) : ''; ?>" placeholder="Product Name" class="form-control autoSave" type="text">
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label">Product Description</label>
												<div class="">
													<textarea class="form-control autoSave" placeholder="Product Description" name="brand_product_desc[<?php echo $key; ?>]"><?php echo $productData->product_description != '' ? trim($productData->product_description) : ''; ?></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label">Product image</label>
												<label class="display-block">
													<input type="hidden" name="product_id[<?php echo $key; ?>]" value="<?php echo $productData->id; ?>">
													<input type="hidden" name="product_type[<?php echo $key; ?>]" value="product">
													<input type="hidden" name="product_img[<?php echo $key; ?>]" id="product_img_<?php echo $productCount; ?>" value="<?php echo $productData->product_image != '' ? trim($productData->product_image) : ''; ?>">
													<div class="img_vid_upload_small">
														<div class="dropzone productDropzoneImg myDropzone_product_img_<?php echo $productCount; ?>" data-count="<?php echo $productCount; ?>"></div>
													</div>
												</label>
											</div>
										</div>
										<?php }else{ ?>
										
										<div class="productSectionNew productBoxSection<?php echo $key; ?>" style="<?php echo $key == 0 ? 'border-top:none;' : ''; ?>">
											<div class="barand_avatar mb20 productPreviewImg">
												<?php 
													echo '<img width="65" height="65" id="showBrandImage'.$productCount.'" class="rounded company_avatar" onerror="this.src=\'http://brandboost.io/assets/images/default_table_img2.png\'" src="https://s3-us-west-2.amazonaws.com/brandboost.io/'. $productData->product_image.'">';
												?>											
											</div>
											<div class="form-group">
												<label class="control-label">Service Name</label>
												<?php if($key != 0){ ?>
												<a class="deleteProductItem" data-order="<?php echo $key; ?>"><div class="text-center" style="float: right; height: 25px; width: 25px; border-radius: 25px; background: #D7D7E8; margin-top:-5px;">x</div></a>
												<?php } ?>
												<div class="">
													<input name="brand_product_name[<?php echo $key; ?>]" value="<?php echo $productData->product_name != '' ? trim($productData->product_name) : ''; ?>" placeholder="Service Name" class="form-control autoSave" type="text">
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label">Service Description</label>
												<div class="">
													<textarea class="form-control autoSave" placeholder="Service Description" name="brand_product_desc[<?php echo $key; ?>]"><?php echo $productData->product_description != '' ? trim($productData->product_description) : ''; ?></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label">Service image</label>
												<label class="display-block">
													<input type="hidden" name="product_id[<?php echo $key; ?>]" value="<?php echo $productData->id; ?>">
													<input type="hidden" name="product_type[<?php echo $key; ?>]" value="service">
													<input type="hidden" name="product_img[<?php echo $key; ?>]" id="product_img_<?php echo $productCount; ?>" value="<?php echo $productData->product_image != '' ? trim($productData->product_image) : ''; ?>">
													<div class="img_vid_upload_small">
														<div class="dropzone productDropzoneImg myDropzone_product_img_<?php echo $productCount; ?>" data-count="<?php echo $productCount; ?>"></div>
													</div>
												</label>
											</div>
										</div>
									<?php
										}
										$productCount++;
									} 
								}
								?>
								
							</div>
							
							<div class="form-group text-right mt20">
								<button type="button" class="btn dark_btn ml10 addMoreProduct" data-type="product" data-bbid="<?php echo $brandboostData->id; ?>"><i class="icon-plus3"></i><span> &nbsp;  Add product</span> </button>
								<button type="button" class="btn dark_btn ml10 addMoreService" data-type="service" data-bbid="<?php echo $brandboostData->id; ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Service</span> </button>
							</div>
						</div>
						
                        <div class="p25 text-center btop hidden">
							<button class="btn dark_btn w100 bkg_purple saveOnsiteButton" type="submit"> Save </button>
						</div>
						
                        <!-- ***** detail ***** -->
						
						
					</div>
				</div>
				
			</div>
			
            <div class="col-md-6">
                <div style="margin: 0;" class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Thank you message</h6>
                        <div class="heading-elements"><a href="javascript:void(0);"><i class="icon-more2"></i></a></div>
					</div>
                    <div class="panel-body p0">
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Review Request Language  </label>
                                <div class="">
                                    <select class="form-control">
                                        <option>English (USA)</option>
									</select>
								</div>
							</div>
						</div>
						
                        <div class="profile_headings big">Positive <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Positive Title</label>
                                <div class="">
                                    <input class="form-control thankMsgTitle autoSave" name="positive_title" id="positive_title" value="<?php echo ($feedbackResponseData->pos_title) ? $feedbackResponseData->pos_title : 'Thanks for leaving positive review'; ?>" required="" type="text">
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label">Positive Subtitle</label>
                                <div class="">
                                    <input  class="form-control thankMsgSubTitle autoSave" name="positive_subtitle" id="positive_subtitle" value="<?php echo ($feedbackResponseData->pos_sub_title) ? $feedbackResponseData->pos_sub_title : 'We will revert back to you soon'; ?>" required="" type="text">
								</div>
							</div>
                            <div class="alert bkg_green txt_white mt30 mb0 preview">
                                <div class="media-left">
                                    <img src="<?php echo base_url(); ?>assets/images/thankyou_smiley_green.png"/>
								</div>
                                <div class="media-left">
                                    <div class="thanksTitlePreview"><?php echo $feedbackResponseData->pos_title == '' ? 'Thanks for leaving positive review' : $feedbackResponseData->pos_title; ?></div>
                                    <div><small class="thanksSubTitlePreview"><?php echo $feedbackResponseData->pos_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->pos_sub_title; ?></small></div>
								</div>
							</div>
						</div>
						
						
                        <div class="profile_headings big">Neutral <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Neutral Title</label>
                                <div class="">
                                    <input class="form-control thankMsgTitle autoSave" name="neutral_title" id="neutral_title" value="<?php echo ($feedbackResponseData->neu_title) ? $feedbackResponseData->neu_title : 'Thanks for leaving your review'; ?>" required="" type="text">
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label">Neutral Subtitle</label>
                                <div class="">
                                    <input class="form-control thankMsgSubTitle autoSave" name="neutral_subtitle"  id="neutral_subtitle" value="<?php echo ($feedbackResponseData->neu_sub_title) ? $feedbackResponseData->neu_sub_title : 'We will revert back to you soon'; ?>" required="" type="text">
								</div>
							</div>
                            <div class="alert bkg_dark txt_white mt30 mb0 preview">
                                <div class="media-left">
                                    <img src="<?php echo base_url(); ?>assets/images/thankyou_smiley_grey.png"/>
								</div>
                                <div class="media-left">
                                    <div class="thanksTitlePreview"><?php echo $feedbackResponseData->neu_title == '' ? 'Thanks for leaving positive review' : $feedbackResponseData->neu_title; ?></div>
                                    <div><small class="thanksSubTitlePreview"><?php echo $feedbackResponseData->neu_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->neu_sub_title; ?></small></div>
								</div>
							</div>
						</div>
						
                        <div class="profile_headings big">Negative <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Negative Title</label>
                                <div class="">
                                    <input class="form-control thankMsgTitle autoSave" name="negetive_title" id="negetive_title" value="<?php echo ($feedbackResponseData->neg_title) ? $feedbackResponseData->neg_title : 'Thanks for leaving your review'; ?>" required="" type="text">
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label">Negative Subtitle</label>
                                <div class="">
                                    <input class="form-control thankMsgSubTitle autoSave" name="negetive_subtitle"  id="negetive_subtitle" value="<?php echo ($feedbackResponseData->neg_sub_title) ? $feedbackResponseData->neg_sub_title : 'We will revert back to you soon'; ?>" required="" type="text">
								</div>
							</div>                          
							
                            <div class="alert bkg_red txt_white mt30 mb0 preview">
                                <div class="media-left">
                                    <img src="<?php echo base_url(); ?>assets/images/thankyou_smiley_red.png"/>
								</div>
                                <div class="media-left">
                                    <div class="thanksTitlePreview"><?php echo $feedbackResponseData->neg_title == '' ? 'Thanks for leaving positive review' : $feedbackResponseData->neg_title; ?></div>
                                    <div><small class="thanksSubTitlePreview"><?php echo $feedbackResponseData->neg_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->neg_sub_title; ?></small></div>
								</div>
							</div>
						</div>
						
                        <div class="profile_headings big">Add Review Page URL <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
                        <div class="configurations p25">
                            <div class="form-group">
                                <div class="">
                                    <label class="control-label">Review URL</label>
                                    <a href="<?php echo base_url("reviews/addnew"); ?>?bbid=<?php echo $brandboostData->id; ?>&action=preview" target="_blank"> <?php echo base_url("reviews/addnew"); ?>?bbid=<?php echo $brandboostData->id; ?>&action=preview</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
            <div class="col-md-3">
                <div style="margin: 0;" class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Review Link Expiration Settings</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
					</div>
                    <?php
						$linkExpireReview = $brandboostData->link_expire_review;
						$jsonCustomExpire = $brandboostData->link_expire_custom;
						//pre($jsonCustomExpire);
						$linkExpireCustom = json_decode($jsonCustomExpire);
						$delayValue = $linkExpireCustom->delay_value;
						$delayUnit = $linkExpireCustom->delay_unit;
						if (empty($delayValue)) {
							$delayValue = 'never';
						}
						//pre($linkExpireCustom);
						if (empty($linkExpireReview)) {
							$linkExpireReview = 'no';
						}
					?>
                    <div class="panel-body p0">
                        <div class="p25 configurations  bbot">
                            <div class="form-group mb0">
                                <label class="control-label mb20">Automatically expire link after user leaves review?</label>
                                <div class="clearfix"></div>
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="review_expire" class="autoSave" id="ratings_type" value="yes" <?php echo ( $linkExpireReview == 'yes') ? 'checked' : ''; ?> type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Yes
								</label>
                                <label class="custmo_radiobox pull-left mb20 ml10">
                                    <input name="review_expire" class="autoSave" id="ratings_type" value="no" <?php echo $linkExpireReview == 'no' ? 'checked' : ''; ?> type="radio">
                                    <span class="custmo_radiomark"></span>
                                    No
								</label>
							</div>
						</div>
						
                        <div class="p25 configurations ">
                            <div class="form-group mb0">
                                <label class="control-label mb20">Automatically expire link </label>
                                <div class="clearfix"></div>
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="review_expire_link" class="autoSave" id="review_expire_link" value="never" <?php echo $delayValue == "never" ? "checked" : ""; ?> type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Never Expire
								</label>
                                <div class="clearfix"></div>
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="review_expire_link" class="autoSave" id="review_expire_link" value="custom" <?php echo $delayValue != "never" ? "checked" : ""; ?> type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Expire After
								</label>
							</div>
                            <div class="clearfix mb-10"></div>
                            <div class="expireLinkBox" style="<?php echo $delayValue == "never" ? "display:none;" : "display:block;"; ?>">
                                <div class="form-group">
                                    <input type="number" name="txtInteger" id="txtInteger" size="3" class="numaric_only form-control daysnumber2 autoSave" value="<?php echo $delayValue > 0 ? $delayValue : '1'; ?>" />
								</div>
                                <div class="form-group">
                                    <select class="form-control autoSave" name="exp_duration">
                                        <option value="day" <?php echo $delayUnit == 'day' ? 'selected="selected"' : ''; ?>>Day</option>
                                        <option value="week" <?php echo $delayUnit == 'week' ? 'selected="selected"' : ''; ?>>Week</option>
                                        <option value="month" <?php echo $delayUnit == 'month' ? 'selected="selected"' : ''; ?>>Month</option>
                                        <option value="year" <?php echo $delayUnit == 'year' ? 'selected="selected"' : ''; ?>>Year</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	var productCount = <?php echo count($bbProductsData) < 1 ? 1 : count($bbProductsData); ?>;
    $(document).on("keyup", ".thankMsgTitle", function () {
        $(this).closest('.configurations').find('.thanksTitlePreview').html($(this).val());
	});
    $(document).on("keyup", ".thankMsgSubTitle", function () {
        $(this).closest('.configurations').find('.thanksSubTitlePreview').html($(this).val());
	});
    $('[name=review_expire_link]').change(function () {
        if ($(this).val() == 'custom') {
            $('.expireLinkBox').show();
			} else {
            $('.expireLinkBox').hide();
		}
	});
	
	$(document).ready(function(){
		/*$(document).on('click', '.addMoreProduct', function() {
			++productCount;
			$('.productSection'+productCount).show();
			if(productCount > 4){
				$('.addMoreProduct').hide();
			}
		});*/
		
		
		$(document).on('click', '.deleteProductItem', function() {
			var dataOrder = '';
			dataOrder = $(this).attr('data-order');
			var newCount = parseInt(dataOrder) + 1;
			deleteConfirmationPopup("This product will deleted immediately.<br>You can't undo this action.",
			function () {
				$.ajax({
					url: '<?php echo base_url('admin/brandboost/deleteProduct'); ?>',
					type: "POST",
					data: {dataOrder: dataOrder, bb_id: '<?php echo $brandboostData->id; ?>'},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							displayMessagePopup('success', 'Delete!', 'This product has been deleted successfully.');
							$('#showBrandImage'+newCount).remove();
							$('.productBoxSection'+dataOrder).remove();
							window.location.href=window.location.href;
						} else {
							displayMessagePopup('error');
						}
					}
				});
			});
		});
		
		
		$(document).on('click', '.addMoreProduct', function() {
			++productCount;
			var newProdCount = productCount - 1;
			var htmlView = `<div class="productSectionNew productBoxSection${productCount}">
									<div class="form-group">
										<label class="control-label">Product Name</label>
										<a class="deleteProductItem" data-order="${productCount}"><div class="text-center" style="float: right; height: 25px; width: 25px; border-radius: 25px; background: #D7D7E8; margin-top:-5px;">x</div></a>
										<div class="">
											<input name="brand_product_name[${newProdCount}]" value="" placeholder="Product Name" class="form-control autoSave" type="text">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label">Product Description</label>
										<div class="">
											<textarea class="form-control autoSave" placeholder="Product Description" name="brand_product_desc[${newProdCount}]"></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label">Product image</label>
										<label class="display-block">
											<input type="hidden" name="product_img[${newProdCount}]" id="product_img_${productCount}" value="">
											<input type="hidden" name="product_type[${newProdCount}]" value="product">
											<div class="img_vid_upload_small">
												<div class="dropzone myDropzone_product_img_${productCount}"></div>
											</div>
										</label>
									</div>
								</div>`;
			
			$('#productMainContainer').append(htmlView);
			setTimeout(function(){


				var myDropzoneBrandImgproductCount = new Dropzone(
				".myDropzone_product_img_"+productCount, 

				{
					url: '<?php echo base_url("/dropzone/upload_s3_attachment"); ?>/<?php echo $aUserInfo->id; ?>/onsite',
					uploadMultiple: false,
					maxFiles: 1,
					maxFilesize: 600,
					acceptedFiles: 'image/*',
					addRemoveLinks: false,
					success: function (response) {

						if(response.xhr.responseText != "") {

							$('.productPreviewImg').append('<img width="65" height="65" id="showBrandImage'+productCount+'" class="rounded company_avatar" onerror="this.src=\'http://brandboost.io/assets/images/default_table_img2.png\'" src="https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText+'">');
							var dropImage = $('#product_img_'+productCount).val();
							$.ajax({
				                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
				                type: "POST",
				                data: {dropImage: dropImage},
				                dataType: "json",
				                success: function (data) {
				                  
				                }
				            });
							$('#product_img_'+productCount).val(response.xhr.responseText);
							$('.saveOnsiteButton').trigger('click');
						}
						
					}
				});

				myDropzoneBrandImgproductCount.on("complete", function(file) {
				  myDropzoneBrandImgproductCount.removeFile(file);
				});

			}, 500);
		});
		
		$(document).on('click', '.addMoreService', function() {
			++productCount;
			var newProdCount = productCount - 1;
			var htmlView = `<div class="productSectionNew productBoxSection${productCount}">
									<div class="form-group">
										<label class="control-label">Service Name</label>
										<a class="deleteProductItem" data-order="${productCount}"><div class="text-center" style="float: right; height: 25px; width: 25px; border-radius: 25px; background: #D7D7E8; margin-top:-5px;">x</div></a>
										<div class="">
											<input name="brand_product_name[${newProdCount}]" value="" placeholder="Service Name" class="form-control autoSave" type="text">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label">Service Description</label>
										<div class="">
											<textarea class="form-control autoSave" placeholder="Service Description" name="brand_product_desc[${newProdCount}]"></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label">Service image</label>
										<label class="display-block">
											<input type="hidden" name="product_type[${newProdCount}]" value="service">
											<input type="hidden" name="product_img[${newProdCount}]" id="product_img_${productCount}" value="">
											<div class="img_vid_upload_small">
												<div class="dropzone myDropzone_product_img_${productCount}"></div>
											</div>
										</label>
									</div>
								</div>`;
			
			$('#productMainContainer').append(htmlView);
			setTimeout(function(){
				
				var myDropzoneBrandImgproductCount = new Dropzone(
				".myDropzone_product_img_"+productCount, 

				{
					url: '<?php echo base_url("/dropzone/upload_s3_attachment"); ?>/<?php echo $aUserInfo->id; ?>/onsite',
					uploadMultiple: false,
					maxFiles: 1,
					maxFilesize: 600,
					acceptedFiles: 'image/*',
					addRemoveLinks: false,
					success: function (response) {

						if(response.xhr.responseText != "") {
							$('.productPreviewImg').append('<img width="65" height="65" id="showBrandImage'+productCount+'" class="rounded company_avatar" onerror="this.src=\'http://brandboost.io/assets/images/default_table_img2.png\'" src="https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText+'">');
							var dropImage = $('#product_img_'+productCount).val();
							$.ajax({
				                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
				                type: "POST",
				                data: {dropImage: dropImage},
				                dataType: "json",
				                success: function (data) {
				                  
				                }
				            });
							$('#product_img_'+productCount).val(response.xhr.responseText);
							$('.saveOnsiteButton').trigger('click');
						}
						
					}
				});

				myDropzoneBrandImgproductCount.on("complete", function(file) {
				  myDropzoneBrandImgproductCount.removeFile(file);
				});

			}, 500);
		});
	});
</script>

<script type="text/javascript">
    Dropzone.autoDiscover = false;
    var myDropzoneLogoImg = new Dropzone(
	'#myDropzone_logo_img', //id of drop zone element 1
	{
		url: '<?php echo base_url("/dropzone/upload_s3_attachment"); ?>/<?php echo $aUserInfo->id; ?>/onsite',
		uploadMultiple: false,
		maxFiles: 1,
		maxFilesize: 600,
		acceptedFiles: 'image/*',
		addRemoveLinks: false,
		success: function (response) {
			
			if(response.xhr.responseText != "") {

				$('#showLogoImage').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
				var dropImage = $('#logo_img').val();
				$.ajax({
	                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
	                type: "POST",
	                data: {dropImage: dropImage},
	                dataType: "json",
	                success: function (data) {
	                    console.log(data);
	                }
	            });
				$('#logo_img').val(response.xhr.responseText);
				$('.saveOnsiteButton').trigger('click');

			}
			
		}
	});
	myDropzoneLogoImg.on("complete", function(file) {
	  myDropzoneLogoImg.removeFile(file);
	});
	
	<?php $count = 1; if(count($bbProductsData) > 0){ foreach($bbProductsData as $productData){ ?>
	Dropzone.autoDiscover = false;
	var myDropzoneBrandImg<?php echo $count; ?> = new Dropzone(
	'.myDropzone_product_img_<?php echo $count; ?>', //id of drop zone element 1
	{
		url: '<?php echo base_url("/dropzone/upload_s3_attachment"); ?>/<?php echo $aUserInfo->id; ?>/onsite',
		uploadMultiple: false,
		maxFiles: 1,
		maxFilesize: 600,
		acceptedFiles: 'image/*',
		addRemoveLinks: false,
		success: function (response) {

			if(response.xhr.responseText != "") {

				$('#showBrandImage<?php echo $count; ?>').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
				var dropImage = $('#product_img_<?php echo $count; ?>').val();
				$.ajax({
	                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
	                type: "POST",
	                data: {dropImage: dropImage},
	                dataType: "json",
	                success: function (data) {
	                    console.log(data);
	                }
	            });
				$('#product_img_<?php echo $count; ?>').val(response.xhr.responseText);
				$('.saveOnsiteButton').trigger('click');

			}
			
		}
	});
	myDropzoneBrandImg<?php echo $count; ?>.on("complete", function(file) {
	  myDropzoneBrandImg<?php echo $count; ?>.removeFile(file);
	});

	<?php $count++; } }else{ ?>
	Dropzone.autoDiscover = false;
	var myDropzoneBrandImg1 = new Dropzone(
	'.myDropzone_product_img_1', //id of drop zone element 1
	{
		url: '<?php echo site_url("/dropzone/upload_s3_attachment"); ?>/<?php echo $aUserInfo->id; ?>/onsite',
		uploadMultiple: false,
		maxFiles: 1,
		maxFilesize: 600,
		acceptedFiles: 'image/*',
		addRemoveLinks: false,
		success: function (response) {

			if(response.xhr.responseText != "") {
				
				$('#showBrandImage1').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
				var dropImage = $('#product_img_1').val();
				$.ajax({
	                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
	                type: "POST",
	                data: {dropImage: dropImage},
	                dataType: "json",
	                success: function (data) {
	                    console.log(data);
	                }
	            });
				$('#product_img_1').val(response.xhr.responseText);
				$('.saveOnsiteButton').trigger('click');
			}
			
		}
	});
	myDropzoneBrandImg1.on("complete", function(file) {
	  myDropzoneBrandImg1.removeFile(file);
	});

	<?php } ?>
	</script>		