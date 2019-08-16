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
		$totalReviews = (sizeof($allReviews) > 0) ? sizeof($allReviews) : 0;
		$totalRatings = 0;
		if (!empty($allReviews)) {
			foreach ($allReviews as $arr) {
				$arr = (array) $arr;
				$totalRatings = $totalRatings + $arr['ratings'];
			}
		}
		
		//Total Reviews
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
</style>
<div class="bb-loaded">&nbsp;</div>
<div class="bbpw_slider_widget <?php echo ($alternativeDesign) ? 'bb_rw03_1' : 'bb_rw03'; ?> <?php echo $mainWigetClassName; ?>">
	<button type="button" class="bb_close <?php echo $bgClassName; ?> bb_custom_fc">x</button>
	
	<?php if ($bAllowBranding): ?>
	<div class="bb_top_button_powered <?php echo $bgClassName; ?> bb_custom_bc">
        <a class="bb_custom_fc" href="<?php echo base_url(); ?>"><img width="10" src="<?php echo base_url(); ?>assets/images/bb_icon_logo.png"> <span class="bb_powered_txt">Powered by BrandBoost.io</span></a>
	</div>
	<?php endif; ?>
	
	<div class="bb_clear"></div>
	<div class="bb_white_box <?php echo $bgClassName; ?>" style="margin: 0; border-radius: 0px;">
		
		<div class="bb_sldebutton">
			<a href="javascript:void(0);" class="bb_slide_btn left_arrow <?php echo $bgClassName; ?> bb_custom_fc" bb_direction="left"><i class="fa fa-angle-left" style="margin-top:10px;"></i></a>
			<a href="javascript:void(0);" class="bb_slide_btn right_arrow <?php echo $bgClassName; ?> bb_custom_fc" bb_direction="right"><i class="fa fa-angle-right" style="margin-top:10px;"></i></a>
		</div>
		
		
		<!--========RATING & BUTTONS========-->
		<div class="bb_top_header_sec bb_custom_bc <?php echo ($alternativeDesign) ? 'bb-hidden' : ''; ?>">
			<div class="bb_rating_sec bb_fleft">
				<p class="bb_para"><?php for ($i = 0; $i < number_format($avgRatings, 0); $i++) { ?><i class="fa fa-star bb_txt_yellow bb_custom_rc"></i><?php } ?><?php if ($i < 5) { for ($j = $i; $j < 5; $j++) { ?><i class="fa fa-star bb_txt_grey"></i><?php } } ?></p>
				<h3 class="bb_custom_fc"><?php echo number_format($avgRatings, 2); ?><span class="bb_custom_fc">/5</span></h3>
				<h4 class="bb_custom_bc bb_custom_fc">Based on <?php echo $totalReviews; ?> reviews</h4>
				<div class="bb_clear"></div>
			</div>
			<!-- <div class="bb_button_area bb_fright">
				<button class="bb_btn"><img src="<?php echo base_url(); ?>assets/images/green_smiley.png"> &nbsp; Add review</button>
				<button class="bb_btn bb_fright"><span class="bb_txt_grey">?</span> &nbsp;  Ask a Question</button>
			</div> -->
			<div class="bb_clear"></div>
		</div>
		
		
		<!--========COMMENT SEC========-->
		<div class="bb_comments_area" style="width: 100%; height: 335px; overflow:hidden;">
			<?php
			$count = 0;
			foreach ($aReviews as $reviewData) {
				$profileImg = $reviewData['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $reviewData['user_data']['avatar'];
				
				$reviewImg = '';
				$videoURL = '';
				
				$brandImgArray = unserialize($reviewData['media_url']);
				
				if (sizeof($brandImgArray) > 0 && $reviewData['media_url'] != '' && $brandImgArray[0]['media_url'] != '' && $brandImgArray[0]['media_type'] == 'image'):
				$reviewImg = '<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] . '" alt="" class="bb_img_enlagre bb_br5">';
				
				foreach ($brandImgArray as $imageData) {
					if ($imageData['media_type'] == 'video' && ($bAllowVideoComments)) {
						$videoURL = '<video style="width:100%; height:auto; margin-top:15px; border-radius:5px;" controls><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $imageData['media_url'] . '" type="video/mp4">Your browser does not support the video tag.</video>';
						break;
					}
				}
				endif;
			?>
			<div class="bb_small_comment_box bb_custom_bc <?php echo ($alternativeDesign) ? $bgClassName : ''; ?>">
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
				
				<div class="text_section" style="min-height:<?php echo ($alternativeDesign) ? '175px' : '165px'; ?>;">
					<p class="bb_para heading_txt bb_custom_fc"><?php echo setStringLimit($reviewData['review_title']); ?></p>
					<?php echo $videoURL; ?>
					<?php if($reviewImg != ''){ ?>
					<div style="margin-right:0px; margin-bottom: 30px;" class="bb_fleft">
						<?php echo $reviewImg; ?>
					</div>
					<?php } ?>
					<p class="bb_para bb_custom_fc">
						<?php $commentLength = $reviewImg == '' ? 210 : 120; echo setStringLimit($reviewData['comment_text'], $commentLength); ?>
						<?php if(strlen($reviewData['comment_text']) > $commentLength){ ?>
						<a class="bb_txt_blue bb_custom_bc bbpw_comment_counter" href="javascript:void(0);" class-position="<?php echo $count; ?>">Read more...</a>
						<?php } ?>
					</p>
					<div class="bb_clear"></div>
				</div>
				
				<div class="bb_comment_area">
					<?php if ($bAllowComments): ?>
					<a href="javascript:void(0);" class="bbpw_comment_counter bb_custom_fc" class-position="<?php echo $count; ?>"><i class="fa fa-comment txt_grey bb_custom_fc" style="font-size:16px;"></i> &nbsp;<?php echo sizeof($reviewData['comment_block']); ?> comments</a> 
					<?php endif; ?>
					
					<?php if ($bAllowHelpful): ?>
					<a href="javascript:void(0);" class="bb_review_helpful bb_custom_fc"><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?> found this helpful</a> 
					<a class="bb_like_dislike bb_txt_green bbpw_helpful_action bb_review_like bb_custom_bc" href="javascript:void(0);" class-position="<?php echo $count; ?>" action-name="Yes" bb-review-id="<?php echo $reviewData['id']; ?>"><i class="fa fa-thumbs-up" style="margin-top:5px;"></i></a> 
					<a class="bb_like_dislike bb_txt_red bbpw_helpful_action bb_review_dislike bb_custom_bc" href="javascript:void(0);" class-position="<?php echo $count; ?>" action-name="No" bb-review-id="<?php echo $reviewData['id']; ?>"><i class="fa fa-thumbs-down" style="margin-top:5px;"></i></a> 
					<?php endif; ?>
					<a class="bb_fright bb_share_btn bb_custom_fc" href="javascript:void(0);" class-position="<?php echo $count; ?>"><i class="fa fa-share"></i> &nbsp;  Share</a>
					
					<div class="bbpw_share_links" style="display:none; margin: 5px 0px 0px 0px; position: absolute; right: -100px;">
						<div class="bb_clear"></div>
						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="facebook" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 230); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Facebook</a>
						
						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="twitter" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 210); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Twitter</a>
						
						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="linkedin" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 210); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Linkedin</a>
						
						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="google" site-url="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>" review-msg="<?php echo setStringLimit($reviewData['comment_text'], 210); ?>" title-name="<?php echo $reviewData['review_title']; ?>" review-rating="<?php echo $reviewData['ratings']; ?>" product-image="" review-image="<?php echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] ;?>">Google</a>
						
						<!-- <a class="bb_custom_fc" href="whatsapp://send?text=<?php echo $reviewData['comment_text']; ?> - http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $reviewData['brandboost_name'])) . '-' . $campaignID; ?>">Whatsapp</a> -->
						
					</div>
				</div>
				<div class="bb_comment_reply_sec bbpw_comment_box bb_bfw_section" style="display:none;">
					<?php //echo $this->load->view('reviews/review_comments_popup', array('oCampaign' => $oCampaign, 'reviewData' => $reviewData, 'classPositon' => $count), true); ?>
					view('reviews.center_review_widget', array('oCampaign' => $oCampaign, 'reviewData' => $reviewData, 'classPositon' => $count));
				</div>
			</div>
			<?php $count++; } ?>
			
			<div class="bb_clear"></div>
		</div>
	</div>
</div>