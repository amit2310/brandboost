<?php
	if (!empty($oCampaign)) {
		//permissions
		$bAllowComments = ($oCampaign->allow_comments == 1) ? true : false;
		$bAllowVideoComments = ($oCampaign->allow_video_reviews == 1) ? true : false;
		$bAllowHelpful = ($oCampaign->allow_helpful_feedback == 1) ? true : false;
		$bAllowLiveReading = ($oCampaign->allow_live_reading_review == 1) ? true : false;
		$bAllowRatings = ($oCampaign->allow_comment_ratings == 1) ? true : false;
		$bAllowCreatedTime = ($oCampaign->allow_review_timestamp == 1) ? true : false;
		$bAllowProsCons = ($oCampaign->allow_pros_cons == 1) ? true : false;
		$bAllowBranding = ($oCampaign->allow_branding == 1) ? true : false;
		$headerFixColor = ($oCampaign->header_color_fix == 1) ? true : false;
		$headerSolidColor = ($oCampaign->header_color_solid == 1) ? true : false;
		$headerCustomColor = ($oCampaign->header_color_custom == 1) ? true : false;
		$bAllowCampaignName = ($oCampaign->allow_campaign_name == 1) ? true : false;
		$alternativeDesign = ($oCampaign->alternative_design == 1) ? true : false;
		
		$bgClassName = '';
		if ($headerFixColor) {
			$bgClassName = $oCampaign->header_color . '_widget_bb';
			$textClassName = $oCampaign->header_color . '_text_color';
		}
		
		//get other settings
		$borderColor = $oCampaign->widget_border_color;
		$txtColor = $oCampaign->widget_font_color;
		$widgetPosition  = $oCampaign->widget_position;
		$iconType  = $oCampaign->icon_type;
		$ratingColor  = $oCampaign->rating_solid_color;
		$reviewsOrder   = $oCampaign->reviews_order;
		$reviewsOrderBy   = $oCampaign->reviews_order_by;
		
		//Total Reviews
		/*$totalRatings = 0;
		if (!empty($allReviews)) {
			foreach ($allReviews as $arr) {
				$arr = (array) $arr;
				$totalRatings = $totalRatings + $arr['ratings'];
			}
		}*/
		
		$totalReviews = (sizeof($allReviews) > 0) ? sizeof($allReviews) : 0;
		$totalRatings = 0;
		$fiveStarRatings = 0;
		$fourStarRatings = 0;
		$threeStarRatings = 0;
		$twoStarRatings = 0;
		$oneStarRatings = 0;
		
		if (!empty($allReviews)) {
			foreach ($allReviews as $arr) {
				$arr = (array) $arr;
				$totalRatings = $totalRatings + $arr['ratings'];
				
				if($arr['ratings'] == 5){ $fiveStarRatings++; }
				if($arr['ratings'] == 4){ $fourStarRatings++; }
				if($arr['ratings'] == 3){ $threeStarRatings++; }
				if($arr['ratings'] == 2){ $twoStarRatings++; }
				if($arr['ratings'] == 1){ $oneStarRatings++; }
				
			}
		}
		$avgRatings = $totalRatings / $totalReviews;
		
		$fiveStarRatingsPer = $fiveStarRatings * 100 / $totalReviews;
		$fourStarRatingsPer = $fourStarRatings * 100 / $totalReviews;
		$threeStarRatingsPer = $threeStarRatings * 100 / $totalReviews;
		$twoStarRatingsPer = $twoStarRatings * 100 / $totalReviews;
		$oneStarRatingsPer = $oneStarRatings * 100 / $totalReviews;
		
		$fiveStarRatingsPer = $fiveStarRatingsPer > 0 ? number_format($fiveStarRatingsPer) : 0;
		$fourStarRatingsPer = $fourStarRatingsPer > 0 ? number_format($fourStarRatingsPer) : 0;
		$threeStarRatingsPer = $threeStarRatingsPer > 0 ? number_format($threeStarRatingsPer) : 0;
		$twoStarRatingsPer = $twoStarRatingsPer > 0 ? number_format($twoStarRatingsPer) : 0;
		$oneStarRatingsPer = $oneStarRatingsPer > 0 ? number_format($oneStarRatingsPer) : 0;
		
		
		///////////////// product review rating ////////////////////////////
		
		$totalProductReviews = (sizeof($allPorductsReviews) > 0) ? sizeof($allPorductsReviews) : 0;
		$totalProductRatings = 0;
		$fiveStarProductRatings = 0;
		$fourStarProductRatings = 0;
		$threeStarProductRatings = 0;
		$twoStarProductRatings = 0;
		$oneStarProductRatings = 0;
		
		if (!empty($allPorductsReviews)) {
			foreach ($allPorductsReviews as $arr) {
				$arr = (array) $arr;
				$totalProductRatings = $totalProductRatings + $arr['ratings'];
				
				if($arr['ratings'] == 5){ $fiveStarProductRatings++; }
				if($arr['ratings'] == 4){ $fourStarProductRatings++; }
				if($arr['ratings'] == 3){ $threeStarProductRatings++; }
				if($arr['ratings'] == 2){ $twoStarProductRatings++; }
				if($arr['ratings'] == 1){ $oneStarProductRatings++; }
				
			}
		}
		$avgProductRatings = $totalProductRatings / $totalProductReviews;
		
		$fiveStarProductRatingsPer = $fiveStarProductRatings * 100 / $totalProductReviews;
		$fourStarProductRatingsPer = $fourStarProductRatings * 100 / $totalProductReviews;
		$threeStarProductRatingsPer = $threeStarProductRatings * 100 / $totalProductReviews;
		$twoStarProductRatingsPer = $twoStarProductRatings * 100 / $totalProductReviews;
		$oneStarProductRatingsPer = $oneStarProductRatings * 100 / $totalProductReviews;
		
		$fiveStarProductRatingsPer = $fiveStarProductRatingsPer > 0 ? number_format($fiveStarProductRatingsPer) : 0;
		$fourStarProductRatingsPer = $fourStarProductRatingsPer > 0 ? number_format($fourStarProductRatingsPer) : 0;
		$threeStarProductRatingsPer = $threeStarProductRatingsPer > 0 ? number_format($threeStarProductRatingsPer) : 0;
		$twoStarProductRatingsPer = $twoStarProductRatingsPer > 0 ? number_format($twoStarProductRatingsPer) : 0;
		$oneStarProductRatingsPer = $oneStarProductRatingsPer > 0 ? number_format($oneStarProductRatingsPer) : 0;
		
		
		/////////////////////// Service review ratings //////////////////////////////////
		
		$totalServiceReviews = (sizeof($allServicesReviews) > 0) ? sizeof($allServicesReviews) : 0;
		$totalServiceRatings = 0;
		$fiveStarServiceRatings = 0;
		$fourStarServiceRatings = 0;
		$threeStarServiceRatings = 0;
		$twoStarServiceRatings = 0;
		$oneStarServiceRatings = 0;
		
		if (!empty($allServicesReviews)) {
			foreach ($allServicesReviews as $arr) {
				$arr = (array) $arr;
				$totalServiceRatings = $totalServiceRatings + $arr['ratings'];
				
				if($arr['ratings'] == 5){ $fiveStarServiceRatings++; }
				if($arr['ratings'] == 4){ $fourStarServiceRatings++; }
				if($arr['ratings'] == 3){ $threeStarServiceRatings++; }
				if($arr['ratings'] == 2){ $twoStarServiceRatings++; }
				if($arr['ratings'] == 1){ $oneStarServiceRatings++; }
				
			}
		}
		$avgServiceRatings = $totalServiceRatings / $totalServiceReviews;
		
		$fiveStarServiceRatingsPer = $fiveStarServiceRatings * 100 / $totalServiceReviews;
		$fourStarServiceRatingsPer = $fourStarServiceRatings * 100 / $totalServiceReviews;
		$threeStarServiceRatingsPer = $threeStarServiceRatings * 100 / $totalServiceReviews;
		$twoStarServiceRatingsPer = $twoStarServiceRatings * 100 / $totalServiceReviews;
		$oneStarServiceRatingsPer = $oneStarServiceRatings * 100 / $totalServiceReviews;
		
		$fiveStarServiceRatingsPer = $fiveStarServiceRatingsPer > 0 ? number_format($fiveStarServiceRatingsPer) : 0;
		$fourStarServiceRatingsPer = $fourStarServiceRatingsPer > 0 ? number_format($fourStarServiceRatingsPer) : 0;
		$threeStarServiceRatingsPer = $threeStarServiceRatingsPer > 0 ? number_format($threeStarServiceRatingsPer) : 0;
		$twoStarServiceRatingsPer = $twoStarServiceRatingsPer > 0 ? number_format($twoStarServiceRatingsPer) : 0;
		$oneStarServiceRatingsPer = $oneStarServiceRatingsPer > 0 ? number_format($oneStarServiceRatingsPer) : 0;
		
		
		///////////////////// Site review ratings //////////////////////////////
		
		$totalSiteReviews = (sizeof($allSiteReviews) > 0) ? sizeof($allSiteReviews) : 0;
		$totalSiteRatings = 0;
		$fiveStarSiteRatings = 0;
		$fourStarSiteRatings = 0;
		$threeStarSiteRatings = 0;
		$twoStarSiteRatings = 0;
		$oneStarSiteRatings = 0;
		
		if (!empty($allSiteReviews)) {
			foreach ($allSiteReviews as $arr) {
				$arr = (array) $arr;
				$totalSiteRatings = $totalSiteRatings + $arr['ratings'];
				
				if($arr['ratings'] == 5){ $fiveStarSiteRatings++; }
				if($arr['ratings'] == 4){ $fourStarSiteRatings++; }
				if($arr['ratings'] == 3){ $threeStarSiteRatings++; }
				if($arr['ratings'] == 2){ $twoStarSiteRatings++; }
				if($arr['ratings'] == 1){ $oneStarSiteRatings++; }
				
			}
		}
		$avgSiteRatings = $totalSiteRatings / $totalSiteReviews;
		$fiveStarSiteRatingsPer = $fiveStarSiteRatings * 100 / $totalSiteReviews;
		$fourStarSiteRatingsPer = $fourStarSiteRatings * 100 / $totalSiteReviews;
		$threeStarSiteRatingsPer = $threeStarSiteRatings * 100 / $totalSiteReviews;
		$twoStarSiteRatingsPer = $twoStarSiteRatings * 100 / $totalSiteReviews;
		$oneStarSiteRatingsPer = $oneStarSiteRatings * 100 / $totalSiteReviews;
		
		$fiveStarSiteRatingsPer = $fiveStarSiteRatingsPer > 0 ? number_format($fiveStarSiteRatingsPer) : 0;
		$fourStarSiteRatingsPer = $fourStarSiteRatingsPer > 0 ? number_format($fourStarSiteRatingsPer) : 0;
		$threeStarSiteRatingsPer = $threeStarSiteRatingsPer > 0 ? number_format($threeStarSiteRatingsPer) : 0;
		$twoStarSiteRatingsPer = $twoStarSiteRatingsPer > 0 ? number_format($twoStarSiteRatingsPer) : 0;
		$oneStarSiteRatingsPer = $oneStarSiteRatingsPer > 0 ? number_format($oneStarSiteRatingsPer) : 0;
		
		
	}
	
	if (empty($totalReviews)) {
		die();
	}
	
	/* if (!empty($aLatestReview['media_url'])) {
		if (strpos($aLatestReview['media_url'], '.mp4') !== false) {
		$mediaType = 'video';
		} else {
		$mediaType = 'image';
		}
		} else {
		$mediaType = '';
	} */
?>
<?php $colorOrientation = $oCampaign->color_orientation == '' ? '45deg' : $oCampaign->color_orientation; ?>

<?php 
	
	$mainWigetClassName = "toBottom";
	if($colorOrientation == 'to right top'){
		$mainWigetClassName = "toRightTop";
		}else if($colorOrientation == 'to right'){
		$mainWigetClassName = "toRight";
		}else if($colorOrientation == 'to right bottom'){
		$mainWigetClassName = "toRightBottom";
		}else if($colorOrientation == 'to left bottom'){
		$mainWigetClassName = "toLeftBottom";
		}else if($colorOrientation == 'to left'){
		$mainWigetClassName = "toLeft";
		}else if($colorOrientation == 'to left top'){
		$mainWigetClassName = "toLeftTop";
		}else if($colorOrientation == 'to top'){
		$mainWigetClassName = "toTop";
		}else if($colorOrientation == 'circle'){
		$mainWigetClassName = "orientationCircle";
	}	
	
?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>new_pages/assets/css/fonts/inter-ui.css" rel="stylesheet" type="text/css">
<style>
	
    <?php
		if ($headerSolidColor) {
			$solidColor = $oCampaign->header_solid_color;
			echo '.bbSolidColor{background: ' . $solidColor . '!important;}';
			echo '.textSolidColor{color: ' . $solidColor . '!important;}';
			$bgClassName = 'bbSolidColor';
			$textClassName = 'textSolidColor';
		}
		
		if ($headerCustomColor) {
			$gradientColor1 = $oCampaign->header_custom_color1;
			$gradientColor2 = $oCampaign->header_custom_color2;
			echo '.bbGradientColor{background-image: linear-gradient(45deg, ' . $gradientColor1 . ' 1%, ' . $gradientColor2 . ')!important;}';
			echo '.textSolidColor{color: ' . $gradientColor2 . '!important;}';
			$bgClassName = 'bbGradientColor';
			$textClassName = 'textSolidColor';
		}
	?>
	
	<?php if($colorOrientation == 'circle'){ ?>
		.white_widget_bb{background-image: radial-gradient(<?php echo $colorOrientation; ?>, #ffffff, #ffffff 98%)!important;}
		.red_widget_bb{background-image: radial-gradient(<?php echo $colorOrientation; ?>, #e93474, #541069 98%)!important;}
		.yellow_widget_bb{background-image: radial-gradient(<?php echo $colorOrientation; ?>, #f9d84a, #f9814a)!important;}
		.orange_widget_bb{background-image: radial-gradient(<?php echo $colorOrientation; ?>, #ef9d39, #d92a3f)!important;}
		.green_widget_bb{background-image: radial-gradient(<?php echo $colorOrientation; ?>, #93cf48, #076768)!important;}
		.blue_widget_bb{background-image: radial-gradient(<?php echo $colorOrientation; ?>, #4194f7 3%, #1b1f97 99%)!important;}
		.purple_widget_bb{background-image: radial-gradient(<?php echo $colorOrientation; ?>, #4d4d7c 1%, #1e1e40)!important;}
	<?php }else{ ?>
		.white_widget_bb{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #ffffff, #ffffff 98%)!important;}
		.red_widget_bb{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #e93474, #541069 98%)!important;}
		.yellow_widget_bb{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #f9d84a, #f9814a)!important;}
		.orange_widget_bb{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #ef9d39, #d92a3f)!important;}
		.green_widget_bb{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #93cf48, #076768)!important;}
		.blue_widget_bb{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #4194f7 3%, #1b1f97 99%)!important;}
		.purple_widget_bb{background-image: linear-gradient(<?php echo $colorOrientation; ?>, #4d4d7c 1%, #1e1e40)!important;}
	<?php } ?>
	
	.bb_custom_rc{color:<?php echo $ratingColor; ?>!important;}
	.bb_custom_bc{border-color:<?php echo $borderColor; ?>!important;}
	.bb_custom_fc{color:<?php echo $txtColor; ?>!important;}
	<?php if($alternativeDesign != 1){ ?>
	.bb_white_box{border-radius:0px!important; margin-bottom:0px!important; border-bottom:1px solid <?php echo $borderColor == '' ? '#f4f6fa' : $borderColor; ?>}
	<?php } ?>
	.bb_type_service, .bb_type_site{display:none;}
</style>
<div class="bb-loaded">&nbsp;</div>
<div class="bb_rw02 <?php echo $mainWigetClassName; ?>" id="bb_cpw_section">

<button style="border-radius: 100px; margin-top: 205px;" type="button" scroll-type="top" click-data="0" class="bb_widget_scroll bb_close bb_custom_fc <?php echo $bgClassName; ?>"><i class="fa fa-angle-up"></i></button>
	<button style="border-radius: 100px; margin-top: 260px;" type="button" scroll-type="bottom" click-data="0" class="bb_widget_scroll bb_close bb_custom_fc <?php echo $bgClassName; ?>"><i class="fa fa-angle-down"></i></button>
	
	
	<button type="button" class="bbcpw_close_btn bb_close bb_custom_fc <?php echo $bgClassName; ?>">x</button>
	<div class="<?php if($alternativeDesign != 1){ echo $bgClassName; } ?>">
	<div class="bb_white_box <?php if($alternativeDesign == 1){ echo $bgClassName; } ?>">
		<!--========RATING & BUTTONS========-->
		<div class="bb_pad30">
			<div id="bb_product_rating_area">
				<div class="bb_rating_sec">
					<h3 class="bb_custom_fc"><?php echo number_format($avgProductRatings, 2); ?><span class="bb_custom_fc">/5</span></h3>
					<p class="bb_para">
						<?php for ($i = 0; $i < number_format($avgProductRatings, 0); $i++) { ?><i class="fa fa-star bb_txt_yellow bb_custom_rc"></i><?php } ?><?php if ($i < 5) { for ($j = $i; $j < 5; $j++) { ?><i class="fa fa-star bb_txt_grey"></i><?php } } ?>
					</p>
					<h4 class="bb_custom_fc">Based on <?php echo $totalProductReviews; ?> reviews</h4>
					<div class="bb_clear"></div>
				</div>
			
				<div class="bb_progress_bar_sec">
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status green width85" style="width:<?php echo $fiveStarProductRatingsPer; ?>%;" title="<?php echo $fiveStarProductRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status green width55" style="width:<?php echo $fourStarProductRatingsPer; ?>%;" title="<?php echo $fourStarProductRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status grey width35" style="width:<?php echo $threeStarProductRatingsPer; ?>%;" title="<?php echo $threeStarProductRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status red width15" style="width:<?php echo $twoStarProductRatingsPer; ?>%;" title="<?php echo $twoStarProductRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status red width5" style="width:<?php echo $oneStarProductRatingsPer; ?>%;" title="<?php echo $oneStarProductRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_clear"></div>
				</div>
				<div class="bb_clear"></div>
			</div>
			
			<div id="bb_service_rating_area" style="display:none;">
				<div class="bb_rating_sec">
					<h3 class="bb_custom_fc"><?php echo number_format($avgServiceRatings, 2); ?><span class="bb_custom_fc">/5</span></h3>
					<p class="bb_para">
						<?php for ($i = 0; $i < number_format($avgServiceRatings, 0); $i++) { ?><i class="fa fa-star bb_txt_yellow bb_custom_rc"></i><?php } ?><?php if ($i < 5) { for ($j = $i; $j < 5; $j++) { ?><i class="fa fa-star bb_txt_grey"></i><?php } } ?>
					</p>
					<h4 class="bb_custom_fc">Based on <?php echo $totalServiceReviews; ?> reviews</h4>
					<div class="bb_clear"></div>
				</div>
			
				<div class="bb_progress_bar_sec">
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status green width85" style="width:<?php echo $fiveStarServiceRatingsPer; ?>%;" title="<?php echo $fiveStarServiceRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status green width55" style="width:<?php echo $fourStarServiceRatingsPer; ?>%;" title="<?php echo $fourStarServiceRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status grey width35" style="width:<?php echo $threeStarServiceRatingsPer; ?>%;" title="<?php echo $threeStarServiceRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status red width15" style="width:<?php echo $twoStarServiceRatingsPer; ?>%;" title="<?php echo $twoStarServiceRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status red width5" style="width:<?php echo $oneStarServiceRatingsPer; ?>%;" title="<?php echo $oneStarServiceRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_clear"></div>
				</div>
				<div class="bb_clear"></div>
			</div>
			
			
			<div id="bb_site_rating_area" style="display:none;">
				<div class="bb_rating_sec">
					<h3 class="bb_custom_fc"><?php echo number_format($avgSiteRatings, 2); ?><span class="bb_custom_fc">/5</span></h3>
					<p class="bb_para">
						<?php for ($i = 0; $i < number_format($avgSiteRatings, 0); $i++) { ?><i class="fa fa-star bb_txt_yellow bb_custom_rc"></i><?php } ?><?php if ($i < 5) { for ($j = $i; $j < 5; $j++) { ?><i class="fa fa-star bb_txt_grey"></i><?php } } ?>
					</p>
					<h4 class="bb_custom_fc">Based on <?php echo $totalSiteReviews; ?> reviews</h4>
					<div class="bb_clear"></div>
				</div>
			
				<div class="bb_progress_bar_sec">
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status green width85" style="width:<?php echo $fiveStarSiteRatingsPer; ?>%;" title="<?php echo $fiveStarSiteRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_green_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status green width55" style="width:<?php echo $fourStarSiteRatingsPer; ?>%;" title="<?php echo $fourStarSiteRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_grey2.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status grey width35" style="width:<?php echo $threeStarSiteRatingsPer; ?>%;" title="<?php echo $threeStarSiteRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status red width15" style="width:<?php echo $twoStarRatingsPer; ?>%;" title="<?php echo $twoStarSiteRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_progress_bar_inner">
						<div class="bb_small_smile"><img src="<?php echo base_url(); ?>assets/images/smiley_red_small.png" width="12"></div>
						<div class="bb_progress">
							<div class="bb_progress_grey">
								<div class="bb_progress_status red width5" style="width:<?php echo $oneStarSiteRatingsPer; ?>%;" title="<?php echo $oneStarSiteRatings; ?>"> </div>
							</div>
						</div>
						<div class="bb_clear"></div>
					</div>
					<div class="bb_clear"></div>
				</div>
				<div class="bb_clear"></div>
			</div>
			<!-- <div class="bb_button_area">
				<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
				<button class="bb_btn bb_fright">? &nbsp;  Ask a Question</button>
			</div> -->
		</div>
		
		<!--========TAB MENU========-->
		<div class="bb_tab_box bb_custom_bc" style="<?php echo $alternativeDesign == 1 ? 'border-radius: 0 0 6px 6px;' : ''; ?>">
			<ul>
				<li><a class="bb_custom_fc active bb_product_reviews" href="javascript:void(0);"><span class="hidden-xs">Product</span> Reviews (<?php echo sizeof($aPorductReviews); ?>)</a></li>
				<li><a class="bb_custom_fc bb_site_reviews" href="javascript:void(0);">Site Reviews (<?php echo sizeof($aSiteReviews); ?>)</a></li>
				<li><a class="bb_custom_fc bb_service_reviews" href="javascript:void(0);">Service <span class="hidden-xs">Reviews</span> (<?php echo sizeof($aServiceReviews); ?>)</a></li>
			</ul>
		</div>
		<!--========COMMENT SEC========-->
	</div>
	
	
	<div class="bb_main_comments_section" id="bb_main_comments_section">
		<?php
			$count = 0;
			foreach ($aReviews as $reviewData) {
				//pre($reviewData);
				$profileImg = $reviewData['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $reviewData['user_data']['avatar'];
				
				$reviewImg = '';
				$videoURL = '';
				
				$brandImgArray = unserialize($reviewData['media_url']);
				
				if (sizeof($brandImgArray) > 0 && $reviewData['media_url'] != '' && $brandImgArray[0]['media_url'] != '' && $brandImgArray[0]['media_type'] == 'image'):
				$reviewImg = '<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] . '" alt="" class="bb_img_enlagre">';
				
				foreach ($brandImgArray as $imageData) {
					if ($imageData['media_type'] == 'video' && ($bAllowVideoComments)) {
						$videoURL = '<video style="width:100%; height:auto; margin-top:15px; border-radius:5px;" controls><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $imageData['media_url'] . '" type="video/mp4">Your browser does not support the video tag.</video>';
						break;
					}
				}
				endif;
			?>
			<div class="bb_white_box <?php if($alternativeDesign == 1){ echo $bgClassName; } ?> bb_type_<?php echo $reviewData['review_type'] == '' ? 'product' : $reviewData['review_type']; ?> bbw_main_loop_cantainer" data-product-type="<?php echo $reviewData['review_type'] == '' ? 'product' : $reviewData['review_type']; ?>">
				
				<!--========COMMENT SEC========-->
				
				<div class="bb_comments_area">
					<div class="bb_pad30 bb_mob_pb30">
						<div class="bb_comment_header bb_custom_bc">
							<div class="bb_avatar01">
								<i class="fa bb_check_green fa-check-circle"></i>
								<?php echo showUserAvtar($reviewData['avatar'], $reviewData['firstname'], $reviewData['lastname']); ?>
							</div>
							<div class="bb_fleft">
								<p class="bb_para bb_custom_fc"><strong><?php echo $reviewData['allow_show_name'] != 1 ? 'Anonymous' : $reviewData['firstname'] . ' ' . $reviewData['lastname']; ?></strong> </p>
								<p class="bb_para">
									<?php if ($bAllowRatings): ?>
									<?php for ($i = 0; $i < $reviewData['ratings']; $i++) { ?><i class="fa fa-star bb_txt_yellow bb_custom_rc"></i><?php } ?><?php if ($i < 5) { for ($j = $i; $j < 5; $j++) { ?><i class="fa fa-star bb_txt_grey"></i><?php } } ?>
									<?php endif; ?>
									<span class="bb_thingrey bb_custom_fc"><?php echo number_format($reviewData['ratings'], 1); ?>/5</span> 
								</p>
							</div>
							<div class="bb_fleft">
								<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_fc">Verified</span></p>
								<?php if ($bAllowCreatedTime): ?>
								<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_fc"><?php echo date('d M. Y', strtotime($reviewData['created'])); ?></span></p>
								<?php endif; ?>
							</div>
							<div class="bb_clear"></div>
							<?php if($bAllowCampaignName): ?>
							<div class="bb_custom_fc" style="margin-left:52px; font-weight:bold;"><?php echo $reviewData['product_data']->product_name == '' ? $bbData->brand_title : $reviewData['product_data']->product_name; ?></div>
							<?php endif; ?>
						</div>
						
						
						
						<div class="text_section">
							<p class="bb_para heading_txt bb_custom_fc"><?php echo $reviewData['review_title']; ?></p>
							<?php echo $videoURL; ?>
							<p class="bb_para bb_custom_fc"><?php echo $reviewData['comment_text']; ?></p>
							<?php if($reviewImg != ''){ ?>
								<div class="bb_comment_image bb_small_image_sec">
								<?php 
									foreach ($brandImgArray as $imageData):
									if ($reviewData['media_url'] != '' && $imageData['media_url'] != '' && $imageData['media_type'] == 'image'):
									echo '<a href="javascript:void(0)"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $imageData['media_url'] . '" alt="" class="bb_img_enlagre bb_normal_image"></a> &nbsp;';
									endif;
									endforeach;											
								?>
								</div>
							<?php } ?>
							<div class="bb_clear"></div>
						</div>
						<div class="bb_comment_area">
							<?php if ($bAllowComments): ?>
							<a href="javascript:void(0);" class="bbpw_comment_counter bb_custom_fc" class-position="<?php echo $count; ?>"><i class="fa fa-comment txt_grey bb_custom_fc" style="font-size:16px;"></i> &nbsp;<?php echo sizeof($reviewData['comment_block']); ?> comments</a> 
							<?php endif; ?>
							
							<?php if ($bAllowHelpful): ?>
							<a href="javascript:void(0);" class="bb_review_helpful bb_custom_fc"><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?> found this helpful</a> 
							<a class="bb_like_dislike bb_txt_green bbpw_helpful_action bb_review_like bb_custom_bc" href="javascript:void(0);" class-position="<?php echo $count; ?>" action-name="Yes" bb-review-id="<?php echo $reviewData['id']; ?>"><i class="fa fa-thumbs-up"></i></a> 
							<a class="bb_like_dislike bb_txt_red bbpw_helpful_action bb_review_dislike bb_custom_bc" href="javascript:void(0);" class-position="<?php echo $count; ?>" action-name="No" bb-review-id="<?php echo $reviewData['id']; ?>"><i class="fa fa-thumbs-down"></i></a> 
							<?php endif; ?>
							
							<span class="bbpw_share_links" style="display:none; float:right; margin:8px -14px 0px 0px;">
								
								<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="facebook" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 230); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Facebook</a>
								
								<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="twitter" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 210); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Twitter</a>
								
								<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="linkedin" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 210); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Linkedin</a>
								
								<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="google" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 210); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Google</a>
								
								<!-- <a class="bb_custom_fc" href="whatsapp://send?text=<?php echo $reviewData['comment_text']; ?> - http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>">Whatsapp</a> -->
								
							</span>
							<a class="bb_fright bb_share_btn bb_custom_fc" href="javascript:void(0);" class-position="<?php echo $count; ?>"><i class="fa fa-share"></i> &nbsp;  Share</a>
						</div>
						
						<div class="bb_comment_reply_sec bbpw_comment_box" style="display:none;">
							<?php if (!empty($reviewData['comment_block'])): ?>
							<?php
								$key = 0;
								foreach ($reviewData['comment_block'] as $aComment):
								$getUserDetail = getUserDetail($aComment['user_id']);
								//pre($aComment);
								$childComments = \App\Models\ReviewsModel::getAllChildComments($aComment['id']);
								//pre($childComments);
								//exit;
								if($key < 3){
								?>
								<div class="bb_inner_reply">
									<div class="bb_comment_header_small">
										<div class="bb_avatar_small">
											<?php echo showUserAvtar($getUserDetail->avatar, $getUserDetail->firstname, $getUserDetail->lastname); ?>
										</div>
										<div class="bb_fleft">
											<p class="bb_para bb_custom_fc"><strong><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></strong> </p>
										</div>
										<div class="bb_fleft">
											<p class="bb_para bb_custom_fc"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_custom_fc bb_thingrey"><?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?></span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="text_section_reply">
										<p class="bb_para bb_custom_fc"><?php echo $aComment['content']; ?></p>
									</div>
									<div class="bb_comment_area_reply" style="padding-bottom:10px;">
										<span class="bbpw_comment_like_<?php echo $aComment['id']; ?> bb_custom_fc"><?php echo $aComment['like']; ?></span>&nbsp;
										<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>" action-value="1" bb-review-id="<?php echo $reviewData['id']; ?>" bb-comment-id="<?php echo $aComment['id']; ?>"><i class="fa fa-thumbs-up"></i></a>
										<span class="bbpw_comment_dislike_<?php echo $aComment['id']; ?> bb_custom_fc"><?php echo $aComment['dislike']; ?></span>&nbsp;
										<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>" action-value="0" bb-review-id="<?php echo $reviewData['id']; ?>" bb-comment-id="<?php echo $aComment['id']; ?>"><i class="fa fa-thumbs-down"></i></a>
										<a href="javascript:void(0);" class="bb_comment_reply bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>">Reply</a> <!-- <a href="#">Share</a> -->
									</div>
									<div class="bb_comment_reply_box" id="bb_comment_reply_box_<?php echo $count; ?>_<?php echo $key; ?>" style="display:none; width:85%; margin-left:45px;">
										
										<div class="bbpw_comment_form bb_add_comment_sec_2">
											<div class="bb_overlay_replay" id="bb_overlay_<?php echo $aComment['id']; ?>"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
											<p style="padding-left: 10px;" class="bb_custom_fc">Replay comment</p>
											<div class="bbpw_success_message" style="padding-left: 10px; padding-bottom: 10px;">
												<div class="bb-success-msg bb-hidden bb_custom_fc" id="bb_success_msg_<?php echo $aComment['id']; ?>">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
												<div class="bb-error-msg bb-hidden" id="bb_error_msg_<?php echo $aComment['id']; ?>">OPPS! Error while posting your comment. Try again!</div>
											</div>										
											<div class="bb_add_ctext" style="margin-bottom:10px;">
												<div class="bb_add_user_icon"><img src="<?php echo base_url(); ?>assets/images/widget/user_img_blank.png" width="28"></div>
												<textarea class="bbpw_form_control addnote bbcmtreply" id="bbcmtreply_<?php echo $aComment['id']; ?>" placeholder="Write Your Comments Here"></textarea>
												<div class="bb_txt_format" style="padding-bottom:15px;">
													<a href="javascript:void(0);">B</a>
													<a href="javascript:void(0);">/</a>
													<a href="javascript:void(0);">U</a>
													<a href="javascript:void(0);">$</a>
												</div>
											</div>
											<div class="bb_signup_sec" style="padding:15px; border-radius:5px;">
												<div class="bb_social bb-hidden" style="float:none; margin:0 auto;">
													<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_google.png"></a>
													<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_facebook.png"></a>
													<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_twitter.png"></a>
												</div>
												<p style="margin:0px 0 20px; float: none;text-align: center; line-height: 10px;"><span class="bb-hidden">OR</span><br>Sign Up With Brand Boost</p>
												<div class="bb_input_sec">
													<input id="bbcmtreplyname_<?php echo $aComment['id']; ?>" placeholder="Your Name" class="bb_signup_input bbcmtreplyname user" type="text">
													<input id="bbcmtreplyemail_<?php echo $aComment['id']; ?>" placeholder="Your Email" class="bb_signup_input bbcmtreplyemail" type="text">
													<input id="bbcmtreplyphone_<?php echo $aComment['id']; ?>" placeholder="Your Phone" class="bb_signup_input bbcmtreplyphone phone" type="text">
													<!-- <input id="bbcmtreplypassword_<?php echo $aComment['id']; ?>" placeholder="Your Phone" class="bb_signup_input bbcmtreplypassword pass" type="password"> -->
													
													<ul class="bb_terms_check">
														<li><span class="bb_cust_checkbox">
															<label class="custmo_checkbox">
																<input type="checkbox" id="bb_comment_terms_<?php echo $aComment['id']; ?>" value="1" checked>
																<span class="custmo_checkmark"></span>
															</label>															
														</span> I agree to Brand Boost <a href="<?php echo base_url(); ?>" target="_blank">Terms of Service</a></li>
														<li><span class="bb_cust_checkbox">
															<label class="custmo_checkbox">
																<input type="checkbox" id="bb_comment_processing_<?php echo $aComment['id']; ?>" value="1" checked>
																<span class="custmo_checkmark"></span>
															</label>
														</span> I agree to Disqus processing of email and IP address, and the use of cookies, to facilitate my authentication and posting of comments, explained further in the <a href="#">Privacy Policy</a>
														</li>
													</ul>
													<input type="hidden" id="bb_review_id_<?php echo $aComment['id']; ?>" value="<?php echo $reviewData['id']; ?>" >
													<input type="hidden" id="bb_comment_id_<?php echo $aComment['id']; ?>" value="<?php echo $aComment['id']; ?>" >
													<button type="submit" class="bb_submit_btn bbcmtreplysubmit <?php echo $bgClassName; ?> bb_custom_fc" comment-id="<?php echo $aComment['id']; ?>" style="cursor:pointer;">Submit</button>
												</div>
												<div class="bb_clear"></div>
											</div>
											
										</div>
									</div>
								</div>
								<?php }else{ ?>
								<?php if($key == 3){ echo '<div class="bbpw_all_comments_box"  style="display:none;">'; } ?>
								<div class="bb_inner_reply">
									<div class="bb_comment_header_small">
										<div class="bb_avatar_small">
											<?php echo showUserAvtar($getUserDetail->avatar, $getUserDetail->firstname, $getUserDetail->lastname); ?>
										</div>
										<div class="bb_fleft">
											<p class="bb_para bb_custom_fc"><strong><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></strong> </p>
										</div>
										<div class="bb_fleft">
											<p class="bb_para bb_custom_fc"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_fc"><?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?></span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="text_section_reply">
										<p class="bb_para bb_custom_fc"><?php echo $aComment['content']; ?></p>
									</div>
									<div class="bb_comment_area_reply">
										<span class="bbpw_comment_like_<?php echo $aComment['id']; ?> bb_custom_fc"><?php echo $aComment['like']; ?></span>&nbsp;
										<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>" action-value="1" bb-review-id="<?php echo $reviewData['id']; ?>" bb-comment-id="<?php echo $aComment['id']; ?>"><i class="fa fa-thumbs-up"></i></a>
										<span class="bbpw_comment_dislike_<?php echo $aComment['id']; ?> bb_custom_fc"><?php echo $aComment['dislike']; ?></span>&nbsp;
										<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>" action-value="0" bb-review-id="<?php echo $reviewData['id']; ?>" bb-comment-id="<?php echo $aComment['id']; ?>"><i class="fa fa-thumbs-down"></i></a>
										<a href="javascript:void(0);" class="bb_comment_reply bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>">Reply</a><!-- <a href="#">Share</a> --> 
									</div>
									<div class="bb_comment_reply_box" id="bb_comment_reply_box_<?php echo $count; ?>_<?php echo $key; ?>" style="display:none; width:85%; margin-left:45px;">
										
										<div class="bbpw_comment_form bb_add_comment_sec_2">
											<div class="bb_overlay_replay" id="bb_overlay_<?php echo $aComment['id']; ?>"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
											<p style="padding-left: 10px;" class="bb_custom_fc">Replay comment</p>
											<div class="bbpw_success_message" style="padding-left: 10px; padding-bottom: 10px;">
												<div class="bb-success-msg bb-hidden bb_custom_fc" id="bb_success_msg_<?php echo $aComment['id']; ?>">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
												<div class="bb-error-msg bb-hidden" id="bb_error_msg_<?php echo $aComment['id']; ?>">OPPS! Error while posting your comment. Try again!</div>
											</div>
											
											<div class="bb_add_ctext" style="margin-bottom:10px;">
												<div class="bb_add_user_icon"><img src="<?php echo base_url(); ?>assets/images/widget/user_img_blank.png" width="28"></div>
												<textarea class="bbpw_form_control addnote bbcmtreply" id="bbcmtreply_<?php echo $aComment['id']; ?>" placeholder="Write Your Comments Here"></textarea>
												<div class="bb_txt_format" style="padding-bottom:15px;">
													<a href="javascript:void(0);">B</a>
													<a href="javascript:void(0);">/</a>
													<a href="javascript:void(0);">U</a>
													<a href="javascript:void(0);">$</a>
												</div>
											</div>
											<div class="bb_signup_sec" style="padding:15px; border-radius:5px;">
												<div class="bb_social bb-hidden" style="float:none; margin:0 auto;">
													<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_google.png"></a>
													<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_facebook.png"></a>
													<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_twitter.png"></a>
												</div>
												<p style="margin:0px 0 20px; float: none;text-align: center; line-height: 10px;"><span class="bb-hidden">OR</span><br>Sign Up With Brand Boost</p>
												<div class="bb_input_sec">
													<input id="bbcmtreplyname_<?php echo $aComment['id']; ?>" placeholder="Your Name" class="bb_signup_input bbcmtreplyname user" type="text">
													<input id="bbcmtreplyemail_<?php echo $aComment['id']; ?>" placeholder="Your Email" class="bb_signup_input bbcmtreplyemail" type="text">
													<input id="bbcmtreplyphone_<?php echo $aComment['id']; ?>" placeholder="Your Phone" class="bb_signup_input bbcmtreplyphone phone" type="text">
													<!-- <input id="bbcmtreplypassword_<?php echo $aComment['id']; ?>" placeholder="Your Phone" class="bb_signup_input bbcmtreplypassword pass" type="password"> -->
													
													<ul class="bb_terms_check">
														<li><span class="bb_cust_checkbox">
															<label class="custmo_checkbox">
																<input type="checkbox" id="bb_comment_terms_<?php echo $aComment['id']; ?>" value="1" checked>
																<span class="custmo_checkmark"></span>
															</label>															
														</span> I agree to Brand Boost <a href="<?php echo base_url(); ?>" target="_blank">Terms of Service</a></li>
														<li><span class="bb_cust_checkbox">
															<label class="custmo_checkbox">
																<input type="checkbox" id="bb_comment_processing_<?php echo $aComment['id']; ?>" value="1" checked>
																<span class="custmo_checkmark"></span>
															</label>
														</span> I agree to Disqus processing of email and IP address, and the use of cookies, to facilitate my authentication and posting of comments, explained further in the <a href="#">Privacy Policy</a>
														</li>
													</ul>
													<input type="hidden" id="bb_review_id_<?php echo $aComment['id']; ?>" value="<?php echo $reviewData['id']; ?>" >
													<input type="hidden" id="bb_comment_id_<?php echo $aComment['id']; ?>" value="<?php echo $aComment['id']; ?>" >
													<button type="submit" class="bb_submit_btn bbcmtreplysubmit  <?php echo $bgClassName; ?> bb_custom_fc" comment-id="<?php echo $aComment['id']; ?>" style="cursor:pointer;">Submit</button>
												</div>
												<div class="bb_clear"></div>
											</div>											
										</div>
									</div>
								</div> 
								<?php $matchSize = sizeof($reviewData['comment_block']) - 1; if($key == $matchSize){ echo '</div>'; } ?>
							<?php } ?>
							<?php
								
								foreach ($childComments as $cComment):
								$cComment = (array) $cComment;
								$getUserDetail = getUserDetail($cComment['user_id']);
								$oCommentLike = \App\Models\ReviewsModel::countCommentLike($cComment['id']);
							?>
							<div class="bb_inner_reply" style="margin-left:40px;">
								<div class="bb_comment_header_small">
									<div class="bb_avatar_small">
										<?php echo showUserAvtar($getUserDetail->avatar, $getUserDetail->firstname, $getUserDetail->lastname); ?>
									</div>
									<div class="bb_fleft">
										<p class="bb_para bb_custom_fc"><strong><?php echo $cComment['firstname'] . ' ' . $cComment['lastname']; ?></strong> </p>
									</div>
									<div class="bb_fleft">
										<p class="bb_para bb_custom_fc"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_fc"><?php echo timeAgo(date('F d, Y', strtotime($cComment['created']))); ?></span></p>
									</div>
									<div class="bb_clear"></div>
								</div>
								<div class="text_section_reply">
									<p class="bb_para bb_custom_fc"><?php echo $cComment['content']; ?></p>
								</div>
								<div class="bb_comment_area_reply">
									<span class="bbpw_comment_like_<?php echo $cComment['id']; ?> bb_custom_fc"><?php echo $oCommentLike['like']; ?></span>&nbsp;
									<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>" action-value="1" bb-review-id="<?php echo $reviewData['id']; ?>" bb-comment-id="<?php echo $cComment['id']; ?>"><i class="fa fa-thumbs-up"></i></a>
									<span class="bbpw_comment_dislike_<?php echo $cComment['id']; ?> bb_custom_fc"><?php echo $oCommentLike['dislike']; ?></span>&nbsp;
									<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="<?php echo $count; ?>" comment-position="<?php echo $key; ?>" action-value="0" bb-review-id="<?php echo $reviewData['id']; ?>" bb-comment-id="<?php echo $cComment['id']; ?>"><i class="fa fa-thumbs-down"></i></a>
									<!-- <a href="#">Share</a> -->
								</div>
							</div>
							<?php endforeach; ?>
							<?php $key++; endforeach; ?>					
							<?php endif; ?>
							<!--==============ADD COMMENT SEC=================-->
							<div class="bb_add_comment_sec_2">
								<div class="bb_overlay"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
								<p style="padding-left: 10px;" class="bb_custom_fc">Add comment</p>
								<div class="bbpw_success_message" style="padding-left: 10px; padding-bottom: 10px;">
									<div class="bb-success-msg bb-hidden bb_custom_fc">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
									<div class="bb-error-msg bb-hidden">OPPS! Error while posting your comment. Try again!</div>
								</div>
								<div class="bb_add_ctext" style="margin-bottom:10px;">
									<div class="bb_add_user_icon"><img src="<?php echo base_url(); ?>assets/images/widget/user_img_blank.png" width="28"></div>
									<textarea class="bbpw_form_control addnote bbcmt" id="bbcmt_<?php echo $cComment['id']; ?>" placeholder="Write Your Comments Here"></textarea>
									<div class="bb_txt_format" style="padding-bottom:15px;">
										<a href="javascript:void(0);">B</a>
										<a href="javascript:void(0);">/</a>
										<a href="javascript:void(0);">U</a>
										<a href="javascript:void(0);">$</a>
									</div>
								</div>
								<div class="bb_signup_sec" style="padding:15px; border-radius:5px;">
									<div class="bb_social bb-hidden" style="float:none; margin:0 auto;">
										<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_google.png"></a>
										<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_facebook.png"></a>
										<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/widget/bb_widget_twitter.png"></a>
									</div>
									<p style="margin:0px 0 20px; float: none;text-align: center; line-height: 10px;"><span class="bb-hidden">OR</span><br>Sign Up With Brand Boost</p>
									<div class="bb_input_sec">
										<input id="bbcmtname_<?php echo $cComment['id']; ?>" placeholder="Your Name" class="bb_signup_input bbcmtname user" type="text">
										<input id="bbcmtemail_<?php echo $cComment['id']; ?>" placeholder="Your Email" class="bb_signup_input bbcmtemail" type="text">
										<input id="bbcmtphone_<?php echo $cComment['id']; ?>" placeholder="Your Phone" class="bb_signup_input bbcmtphone phone" type="text">
										<!-- <input id="bbcmtpassword_<?php echo $cComment['id']; ?>" placeholder="Your Password" class="bb_signup_input bbcmtpassword pass" type="password"> -->
										
										<ul class="bb_terms_check">
											<li><span class="bb_cust_checkbox">
												<label class="custmo_checkbox">
													<input type="checkbox" id="bb_comment_terms_<?php echo $cComment['id']; ?>" value="1" class="bb_comment_terms" checked>
													<span class="custmo_checkmark"></span>
												</label>															
											</span> I agree to Brand Boost <a href="<?php echo base_url(); ?>" target="_blank">Terms of Service</a></li>
											<li><span class="bb_cust_checkbox">
												<label class="custmo_checkbox">
													<input type="checkbox" id="bb_comment_processing_<?php echo $cComment['id']; ?>" value="1" class="bb_comment_processing" checked>
													<span class="custmo_checkmark"></span>
												</label>
											</span> I agree to Disqus processing of email and IP address, and the use of cookies, to facilitate my authentication and posting of comments, explained further in the <a href="#">Privacy Policy</a>
											</li>
										</ul>
										<input type="hidden" name="bb-review-id" class="bb-review-id" value="<?php echo $reviewData['id']; ?>" >
										<button type="submit" class="bb_submit_btn bbcmtsubmit <?php echo $bgClassName; ?> bb_custom_fc" name="bbcmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Submit</button>
									</div>
									<div class="bb_clear"></div>
								</div>
							</div>
							<div class="bb_comment_row" style="border:none; padding-top: 15px; display: inline-block;">
								<p>
									<a href="javascript:void(0);" style="text-decoration:none;" class-position="<?php echo $count; ?>" class="bbpw_comment_counter bbactive bb_custom_fc"><i class="fa fa-angle-up txt_grey bb_custom_fc" style="font-size:16px;"></i>&nbsp;  Hide Comments</a> &nbsp; &nbsp; 
									<?php if(sizeof($reviewData['comment_block']) > 3): ?>
									<span><a style="text-decoration:none;" class-position="<?php echo $count; ?>" class="bbactive bbpw_show_all_comment bb_custom_fc" href="javascript:void(0);"><i class="fa fa-comment txt_grey bb_custom_fc" style="font-size:16px;"></i>&nbsp; View all comments</a></span>
									<?php endif; ?>
								</p>
							</div>
							<!--==============ADD COMMENT SEC=================-->
						</div>
					</div>
				</div>
			</div>
		<?php $count++; } ?>
	</div>
	</div>
	<?php if ($bAllowBranding): ?>
	<div class="bb_top_button_powered <?php echo $bgClassName; ?> bb_custom_bc">
        <a class="bb_custom_fc" href="<?php echo base_url(); ?>"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt">Powered by BrandBoost.io</span></a>
	</div>
	<?php endif; ?>
</div>