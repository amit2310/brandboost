<?php
$allowTitle = $galleryData->allow_title;
$allowArrows = $galleryData->allow_arrow;
$allowRating = $galleryData->allow_ratings;
$name = $galleryData->name;
$description = $galleryData->description;
$galleryType = $galleryData->gallery_type;
$imageSize = $galleryData->image_size;
$gradientColor = $galleryData->gradient_color;
$widgetBgcolor = $galleryData->allow_widget_bgcolor;
$borderThickness = $galleryData->border_thickness;
$galleryDesign = $galleryData->gallery_design_type;
$galleryId = $galleryData->id;
$colorOrientation = $galleryData->gradient_orientation == '' ? 'to right top' : $galleryData->gradient_orientation;
$reviewIDArray = unserialize($galleryData->reviews_id);
?>
<style type="text/css">
	.previewWidgetBox .bbw_white_color{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #ffffff, #ffffff 98%)!important;}
    .previewWidgetBox .bbw_red_color{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #e93474, #541069 98%)!important;}
    .previewWidgetBox .bbw_yellow_color{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #f9d84a, #f9814a)!important;}
    .previewWidgetBox .bbw_orange_color{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #ef9d39, #d92a3f)!important;}
    .previewWidgetBox .bbw_green_color{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #93cf48, #076768)!important;}
    .previewWidgetBox .bbw_blue_color{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #4194f7 3%, #1b1f97 99%)!important;}
    .previewWidgetBox .bbw_purple_color{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #4d4d7c 1%, #1e1e40)!important;}
</style>

<div class="gallery_slider_widget <?php //echo $mainWigetClassName; ?> slides<?php echo ($galleryType == '') ? '' : $galleryType; ?> imgSize<?php echo ($imageSize == '') ? 'Medium' : ucfirst($imageSize); ?> galleryType<?php if($galleryDesign == 'onerow'){ echo ''; }else{ echo $galleryDesign == 'horizontal' ? 3 : 2; } ?>" id="bbColorOrientationSection">
	<h2 class="reviewTitleBH <?php echo $allowTitle != '0' ? '' : 'hidden'; ?>"><strong class="reviewTitle"><?php echo $name == '' ? 'Gallery' : $name; ?></strong> <span><?php echo count($reviewIDArray); ?> photos</span></h2>
	<?php if($galleryDesign == 'onerow'){ ?>
	<div class="arrow reviewArrowBH <?php echo $allowArrows != '0' ? '' : 'hidden'; ?>">
		<a href="javascript:void(0);" class="left_arrow" bb_direction="left"><img src="<?php echo base_url(); ?>assets/images/widget/arrow-left.png"></a> 
		<a href="javascript:void(0);" class="right_arrow" bb_direction="right"><img src="<?php echo base_url(); ?>assets/images/widget/arrow-right.png"></a>
	</div>
	<div style="overflow:hidden; float:left; width:100%;" class="<?php if($galleryData->allow_border_shadow == 1){ echo 'borderBoxShadow'; } ?>">
	<div class="middle previewWidgetBox" style="width:5000px; float:left;">
		<?php
		if(count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
			foreach($reviewIDArray as $reviewId){
				$reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);

				$reviewImageArray = unserialize($reviewData[0]->media_url);
				if(count($reviewImageArray)>0)
				{
				$imageUrl = $reviewImageArray[0]['media_url'];
				$cropedImageUrl = $reviewData[0]->croped_image_url;
			    }
			    else
			    {
			    	$imageUrl = "";
				    $cropedImageUrl = "";
			    }
				
				if($cropedImageUrl == ''){
					$imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
				}else{
					$imagePath = "data:image/jpg;base64,".$cropedImageUrl;
				}
				
				if($widgetBgcolor == 1){
					if($galleryData->bg_color_type == ''){
						$styleSetting = $galleryData->solid_color == '' ? 'style="background:#FF0000!important"' : 'style="background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;"'; 
					}else{
						$styleSetting = 'style="padding:'.$borderThickness.'px!important;"';
					}
				}else{
					$styleSetting = 'style="background:none!important; padding:0px!important;"';
				}
		?>
				<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
					<div class="top_div">
						<a href="javascript:void(0);" class="showReviewPopup" review-id="<?php echo $reviewId; ?>">
							<img src="<?php echo $imagePath; ?>" class="" alt="">
						</a>
					</div>
					<div class="img_overlay showReviewPopup" review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
				</div>
		<?php
			}
		}
		?>
		<?php  for($i = count($reviewIDArray); $i < $galleryType; $i++){ ?>
		<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="showNotFoundPopup">
					<img src="<?php echo base_url(); ?>/assets/images/temp_prev9.png" class="" alt="">
				</a>
			</div>
			<div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
		</div>
		<?php } ?>
	</div>
	</div>
	<div class="clearfix"></div>
	<div class="footer_div">
		<div class="left"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
		<div class="right reviewRatingsBH <?php echo $allowRating != '0' ? '' : 'hidden'; ?>">
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<span> &nbsp; <?php echo count($reviewIDArray); ?> Reviews</span></div>
	</div>
	<?php }else if($galleryDesign == 'square'){ ?>
	
	<div class="<?php if($galleryData->allow_border_shadow == 1){ echo 'borderBoxShadow'; } ?>">
	<div class="middle previewWidgetBox">
		<?php
		if(count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
			foreach($reviewIDArray as $key=>$reviewId){
				if($key <= 3){
				$reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);
				$reviewImageArray = unserialize($reviewData[0]->media_url);
				$imageUrl = $reviewImageArray[0]['media_url'];
				$cropedImageUrl = $reviewData[0]->croped_image_url;
				
				if($cropedImageUrl == ''){
					$imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
				}else{
					$imagePath = "data:image/jpg;base64,".$cropedImageUrl;
				}
				
				if($widgetBgcolor == 1){
					if($galleryData->bg_color_type == ''){
						$styleSetting = $galleryData->solid_color == '' ? 'style="background:#FF0000!important"' : 'style="background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;"'; 
					}else{
						$styleSetting = 'style="padding:'.$borderThickness.'px!important;"';
					}
				}else{
					$styleSetting = 'style="background:none!important; padding:0px!important;"';
				}
		?>
				<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
					<div class="top_div">
						<a href="javascript:void(0);" class="showReviewPopup" review-id="<?php echo $reviewId; ?>">
							<img src="<?php echo $imagePath; ?>" class="" alt="">
						</a>
					</div>
					<div class="img_overlay showReviewPopup" review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
				</div>
				<?php if($key == 1){ ?>
				<div class="clearfix"></div>
				<?php } ?>
		<?php
				}
			}
		}
		?>
		<?php  for($i = count($reviewIDArray); $i < 4; $i++){ ?>
		<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="showNotFoundPopup">
					<img src="<?php echo base_url(); ?>/assets/images/temp_prev9.png" class="" alt="">
				</a>
			</div>
			<div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
		</div>
		<?php } ?>
	</div>
	</div>
	<div class="clearfix"></div>
	<div class="footer_div">
		<div class="left"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
		<div class="right reviewRatingsBH <?php echo $allowRating != '0' ? '' : 'hidden'; ?>">
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<span> &nbsp; <?php echo count($reviewIDArray); ?> Reviews</span></div>
	</div>
	<?php }else if($galleryDesign == 'horizontal'){ ?>
	<div class="<?php if($galleryData->allow_border_shadow == 1){ echo 'borderBoxShadow'; } ?>">
	<div class="middle previewWidgetBox">
		<?php
		if(count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
			foreach($reviewIDArray as $key=>$reviewId){
				if($key <= 5){
				$reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);
				$reviewImageArray = unserialize($reviewData[0]->media_url);
				$imageUrl = $reviewImageArray[0]['media_url'];
				$cropedImageUrl = $reviewData[0]->croped_image_url;
				
				if($cropedImageUrl == ''){
					$imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
				}else{
					$imagePath = "data:image/jpg;base64,".$cropedImageUrl;
				}
				
				if($widgetBgcolor == 1){
					if($galleryData->bg_color_type == ''){
						$styleSetting = $galleryData->solid_color == '' ? 'style="background:#FF0000!important"' : 'style="background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;"'; 
					}else{
						$styleSetting = 'style="padding:'.$borderThickness.'px!important;"';
					}
				}else{
					$styleSetting = 'style="background:none!important; padding:0px!important;"';
				}
		?>
				<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
					<div class="top_div">
						<a href="javascript:void(0);" class="showReviewPopup" review-id="<?php echo $reviewId; ?>">
							<img src="<?php echo $imagePath; ?>" class="" alt="">
						</a>
					</div>
					<div class="img_overlay showReviewPopup" review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
				</div>
				<?php if($key == 2){ ?>
				<div class="clearfix"></div>
				<?php } ?>
		<?php
				}
			}
		}
		?>
		<?php  for($i = count($reviewIDArray); $i < 6; $i++){ ?>
		<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="showNotFoundPopup">
					<img src="<?php echo base_url(); ?>/assets/images/temp_prev9.png" class="" alt="">
				</a>
			</div>
			<div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
		</div>
		<?php } ?>
	</div>
	</div>
	<div class="clearfix"></div>
	<div class="footer_div">
		<div class="left"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
		<div class="right reviewRatingsBH <?php echo $allowRating != '0' ? '' : 'hidden'; ?>">
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<span> &nbsp; <?php echo count($reviewIDArray); ?> Reviews</span></div>
	</div>
	<?php }else if($galleryDesign == 'vertical'){ ?>
	<div class="<?php if($galleryData->allow_border_shadow == 1){ echo 'borderBoxShadow'; } ?>">
	<div class="middle previewWidgetBox">
		<?php
		if(count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
			foreach($reviewIDArray as $key=>$reviewId){
				if($key <= 5){
				$reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);
				$reviewImageArray = unserialize($reviewData[0]->media_url);
				$imageUrl = $reviewImageArray[0]['media_url'];
				$cropedImageUrl = $reviewData[0]->croped_image_url;
				
				if($cropedImageUrl == ''){
					$imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
				}else{
					$imagePath = "data:image/jpg;base64,".$cropedImageUrl;
				}
				
				if($widgetBgcolor == 1){
					if($galleryData->bg_color_type == ''){
						$styleSetting = $galleryData->solid_color == '' ? 'style="background:#FF0000!important"' : 'style="background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;"'; 
					}else{
						$styleSetting = 'style="padding:'.$borderThickness.'px!important;"';
					}
				}else{
					$styleSetting = 'style="background:none!important; padding:0px!important;"';
				}
		?>
				<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
					<div class="top_div">
						<a href="javascript:void(0);" class="showReviewPopup" review-id="<?php echo $reviewId; ?>">
							<img src="<?php echo $imagePath; ?>" class="" alt="">
						</a>
					</div>
					<div class="img_overlay showReviewPopup" review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
				</div>
				<?php if($key == 1 || $key == 3){ ?>
				<div class="clearfix"></div>
				<?php } ?>
				
		<?php
				}
			}
		}
		?>
		<?php  for($i = count($reviewIDArray); $i < 6; $i++){ ?>
		<div class="box_1 sliderImage <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="showNotFoundPopup">
					<img src="<?php echo base_url(); ?>/assets/images/temp_prev9.png" class="" alt="">
				</a>
			</div>
			<div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
		</div>
		<?php } ?>
	</div>
	</div>
	<div class="clearfix"></div>
	<div class="footer_div">
		<div class="left"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
		<div class="right reviewRatingsBH <?php echo $allowRating != '0' ? '' : 'hidden'; ?>">
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png"> 
		<span> &nbsp; <?php echo count($reviewIDArray); ?> Reviews</span></div>
	</div>
	<?php } ?>

</div>