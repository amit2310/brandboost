<?php
error_reporting(0);
$allowTitle = $galleryData->allow_title;
$allowArrows = $galleryData->allow_arrow;
$allowRating = $galleryData->allow_ratings;
$galleryDesign = $galleryData->gallery_design_type;
$imageSize = $galleryData->image_size;
$widgetBgcolor = $galleryData->allow_widget_bgcolor;
$borderThickness = $galleryData->border_thickness;
$colorOrientation = $galleryData->gradient_orientation == '' ? 'to right top' : $galleryData->gradient_orientation;
$gradientClass = str_replace(' ', '', ucwords($colorOrientation));
$gradientClass = lcfirst($gradientClass);
?>
<div class="bb_media_gallery bbw_gallery_slider_widget<?php echo ($galleryData->gallery_type == '' || $galleryData->gallery_type == 6) ? '' : $galleryData->gallery_type; ?> bbw_imgSize<?php echo ($imageSize == '') ? 'Medium' : ucfirst($imageSize); ?> bbw_galleryType<?php if($galleryDesign == 'onerow'){ echo ''; }else{ echo $galleryDesign == 'horizontal' ? 3 : 2; } ?>">
<h2 class="<?php echo $allowTitle != '0' ? '' : 'bb_hidden'; ?>"><?php echo $galleryData->name; ?></h2>

<?php if($galleryDesign == 'onerow'){ ?>
<div class="arrow <?php echo $allowArrows != '0' ? '' : 'bb_hidden'; ?>">
	<a href="javascript:void(0);" class="left_arrow bb_slide_btn" bb_direction="left"><img src="<?php echo base_url(); ?>assets/images/widget/arrow-left.png" /></a> 
	<a href="javascript:void(0);" class="right_arrow bb_slide_btn" bb_direction="right"><img src="<?php echo base_url(); ?>assets/images/widget/arrow-right.png" /></a>
</div>
<div style="overflow:hidden; float:left; width:100%;" class="<?php echo $gradientClass; ?> <?php if($galleryData->allow_border_shadow == 1){ echo 'bb_borderBoxShadow'; } ?>">
	<div style="width:5000px; float:left;" class="bbw_middle">
	<?php 
	$reviewsIdArray = unserialize($galleryData->reviews_id);
	$reviewRatings = 0;
	$gradientColor = $galleryData->gradient_color;
	foreach($reviewsIdArray as $reviewId){
		$reviewData = \App\Models\Admin\ReviewsModel::getReviewByReviewID($reviewId);
		$reviewImageArray = unserialize($reviewData[0]->media_url);
		$reviewRatings = $reviewData[0]->ratings + $reviewRatings;
		//pre($reviewImageArray);
		$imageUrl = $reviewImageArray[0]['media_url'];
		
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
		<div class="bbw_box_1 bb_small_comment_box <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $imageUrl; ?>" alt="">
				</a>
			</div>
			<div class="bb_img_overlay bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
		</div>
		<?php
	}
	?>
</div>
</div>
<!--middle End--->
<div class="bbw_clearfix"></div>
<div class="bbw_footer_div">
	<div class="left <?php echo $allowRating != '0' ? '' : 'bb_hidden'; ?>">
		<?php
		for ($i = 1; $i <= 5; $i++) {
			if ($i <= round($reviewRatings/count($reviewsIdArray))) {
				echo '<img src="'.base_url().'assets/images/widget/yellow_icon.png"> ';
			} else {
				echo '<img src="'.base_url().'assets/images/widget/grey_icon.png"> ';
			}
		}
		?>
		<p><?php echo number_format($reviewRatings/count($reviewsIdArray), 1); ?></p><span><?php echo count($reviewsIdArray); ?> customer reviews</span></div>
	<div class="right"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
</div>

<?php }else if($galleryDesign == 'square'){ ?>

<div style="overflow:hidden; float:left; width:100%;" class="<?php echo $gradientClass; ?> <?php if($galleryData->allow_border_shadow == 1){ echo 'bb_borderBoxShadow'; } ?>">
	<div style="width:5000px; float:left;" class="bbw_middle">
	<?php 
	$reviewsIdArray = unserialize($galleryData->reviews_id);
	$reviewRatings = 0;
	$gradientColor = $galleryData->gradient_color;
	foreach($reviewsIdArray as $key=>$reviewId){
		$reviewData = \App\Models\Admin\ReviewsModel::getReviewByReviewID($reviewId);
		$reviewImageArray = unserialize($reviewData[0]->media_url);
		$reviewRatings = $reviewData[0]->ratings + $reviewRatings;
		//pre($reviewImageArray);
		$imageUrl = $reviewImageArray[0]['media_url'];
		if($key <= 3){
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
		<div class="bbw_box_1 bb_small_comment_box <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $imageUrl; ?>" alt="">
				</a>
			</div>
			<div class="bb_img_overlay bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
		</div>
		<?php if($key == 1){ ?>
		<div class="bbw_clearfix" style="height:4px;"></div>
		<?php } ?>
		<?php
		}
	}
	?>
</div>
</div>
<!--middle End--->
<div class="bbw_clearfix"></div>
<div class="bbw_footer_div">
	<div class="left <?php echo $allowRating != '0' ? '' : 'bb_hidden'; ?>">
		<?php
		for ($i = 1; $i <= 5; $i++) {
			if ($i <= round($reviewRatings/count($reviewsIdArray))) {
				echo '<img src="'.base_url().'assets/images/widget/yellow_icon.png"> ';
			} else {
				echo '<img src="'.base_url().'assets/images/widget/grey_icon.png"> ';
			}
		}
		?>
		<p><?php echo number_format($reviewRatings/count($reviewsIdArray), 1); ?></p><span><?php echo count($reviewsIdArray); ?> customer reviews</span></div>
	<div class="right"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
</div>

<?php }else if($galleryDesign == 'horizontal'){ ?>

<div style="overflow:hidden; float:left; width:100%;" class="<?php echo $gradientClass; ?> <?php if($galleryData->allow_border_shadow == 1){ echo 'bb_borderBoxShadow'; } ?>">
	<div style="width:5000px; float:left;" class="bbw_middle">
	<?php 
	$reviewsIdArray = unserialize($galleryData->reviews_id);
	$reviewRatings = 0;
	$gradientColor = $galleryData->gradient_color;
	foreach($reviewsIdArray as $key=>$reviewId){
		$reviewData = \App\Models\Admin\ReviewsModel::getReviewByReviewID($reviewId);
		$reviewImageArray = unserialize($reviewData[0]->media_url);
		$reviewRatings = $reviewData[0]->ratings + $reviewRatings;
		//pre($reviewImageArray);
		$imageUrl = $reviewImageArray[0]['media_url'];
		if($key <= 5){
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
		<div class="bbw_box_1 bb_small_comment_box <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $imageUrl; ?>" alt="">
				</a>
			</div>
			<div class="bb_img_overlay bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
		</div>
		<?php if($key == 2){ ?>
		<div class="bbw_clearfix" style="height:4px;"></div>
		<?php } ?>
		<?php
		}
	}
	?>
</div>
</div>
<!--middle End--->
<div class="bbw_clearfix"></div>
<div class="bbw_footer_div">
	<div class="left <?php echo $allowRating != '0' ? '' : 'bb_hidden'; ?>">
		<?php
		for ($i = 1; $i <= 5; $i++) {
			if ($i <= round($reviewRatings/count($reviewsIdArray))) {
				echo '<img src="'.base_url().'assets/images/widget/yellow_icon.png"> ';
			} else {
				echo '<img src="'.base_url().'assets/images/widget/grey_icon.png"> ';
			}
		}
		?>
		<p><?php echo number_format($reviewRatings/count($reviewsIdArray), 1); ?></p><span><?php echo count($reviewsIdArray); ?> customer reviews</span></div>
	<div class="right"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
</div>

<?php }else if($galleryDesign == 'vertical'){ ?>

<div style="overflow:hidden; float:left; width:100%;" class="<?php echo $gradientClass; ?> <?php if($galleryData->allow_border_shadow == 1){ echo 'bb_borderBoxShadow'; } ?>">
	<div style="width:5000px; float:left;" class="bbw_middle">
	<?php 
	$reviewsIdArray = unserialize($galleryData->reviews_id);
	$reviewRatings = 0;
	$gradientColor = $galleryData->gradient_color;
	foreach($reviewsIdArray as $key=>$reviewId){
		$reviewData = \App\Models\Admin\ReviewsModel::getReviewByReviewID($reviewId);
		$reviewImageArray = unserialize($reviewData[0]->media_url);
		$reviewRatings = $reviewData[0]->ratings + $reviewRatings;
		//pre($reviewImageArray);
		$imageUrl = $reviewImageArray[0]['media_url'];
		if($key <= 5){
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
		<div class="bbw_box_1 bb_small_comment_box <?php echo 'bbw_'.$gradientColor.'_color'; ?>" <?php echo $styleSetting; ?>>
			<div class="top_div">
				<a href="javascript:void(0);" class="bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $imageUrl; ?>" alt="">
				</a>
			</div>
			<div class="bb_img_overlay bb_review_gallerymedia" data-review-id="<?php echo $reviewId; ?>">SHOP THE LOOK</div>
		</div>
		<?php if($key == 1 || $key == 3){ ?>
		<div class="bbw_clearfix" style="height:4px;"></div>
		<?php } ?>
		<?php
		}
	}
	?>
</div>
</div>
<!--middle End--->
<div class="bbw_clearfix"></div>
<div class="bbw_footer_div">
	<div class="left <?php echo $allowRating != '0' ? '' : 'bb_hidden'; ?>">
		<?php
		for ($i = 1; $i <= 5; $i++) {
			if ($i <= round($reviewRatings/count($reviewsIdArray))) {
				echo '<img src="'.base_url().'assets/images/widget/yellow_icon.png"> ';
			} else {
				echo '<img src="'.base_url().'assets/images/widget/grey_icon.png"> ';
			}
		}
		?>
		<p><?php echo number_format($reviewRatings/count($reviewsIdArray), 1); ?></p><span><?php echo count($reviewsIdArray); ?> customer reviews</span></div>
	<div class="right"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
</div>

<?php } ?>

<div class="bbw_modal_box" style="display:none;">
<div class="bbw_modal_box-content">
<div class="close bbw_close_media_gallery" style="font-size:12px; font-family:arial;">X</div>
<div id="bbw_reviewPopupData"></div>
</div>
</div>
</div>

