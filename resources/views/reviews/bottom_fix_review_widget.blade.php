@php
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

	$colorOrientation = $oCampaign->color_orientation == '' ? '45deg' : $oCampaign->color_orientation;

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
@endphp

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="{{ base_url() }}new_pages/assets/css/fonts/inter-ui.css" rel="stylesheet" type="text/css">
<style>

    @php
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
	@endphp

	@if($colorOrientation == 'circle')
		.white_widget_bb{background-image: radial-gradient({{ $colorOrientation }}, #ffffff, #ffffff 98%)!important;}
		.red_widget_bb{background-image: radial-gradient({{ $colorOrientation }}, #e93474, #541069 98%)!important;}
		.yellow_widget_bb{background-image: radial-gradient({{ $colorOrientation }}, #f9d84a, #f9814a)!important;}
		.orange_widget_bb{background-image: radial-gradient({{ $colorOrientation }}, #ef9d39, #d92a3f)!important;}
		.green_widget_bb{background-image: radial-gradient({{ $colorOrientation }}, #93cf48, #076768)!important;}
		.blue_widget_bb{background-image: radial-gradient({{ $colorOrientation }}, #4194f7 3%, #1b1f97 99%)!important;}
		.purple_widget_bb{background-image: radial-gradient({{ $colorOrientation }}, #4d4d7c 1%, #1e1e40)!important;}
	@else
		.white_widget_bb{background-image: linear-gradient({{ $colorOrientation }}, #ffffff, #ffffff 98%)!important;}
		.red_widget_bb{background-image: linear-gradient({{ $colorOrientation }}, #e93474, #541069 98%)!important;}
		.yellow_widget_bb{background-image: linear-gradient({{ $colorOrientation }}, #f9d84a, #f9814a)!important;}
		.orange_widget_bb{background-image: linear-gradient({{ $colorOrientation }}, #ef9d39, #d92a3f)!important;}
		.green_widget_bb{background-image: linear-gradient({{ $colorOrientation }}, #93cf48, #076768)!important;}
		.blue_widget_bb{background-image: linear-gradient({{ $colorOrientation }}, #4194f7 3%, #1b1f97 99%)!important;}
		.purple_widget_bb{background-image: linear-gradient({{ $colorOrientation }}, #4d4d7c 1%, #1e1e40)!important;}
	@endif

	.bb_custom_rc{color:{{ $ratingColor }}!important;}
	.bb_custom_bc{border-color:{{ $borderColor }}!important;}
	.bb_custom_fc{color:{{ $txtColor }}!important;}

	@if($alternativeDesign != 1)
		.bb_white_box{border-radius:0px!important; margin-bottom:0px!important; border-bottom:1px solid {{ $borderColor == '' ? '#f4f6fa' : $borderColor }}}
	@endif
</style>
<div class="bb-loaded">&nbsp;</div>
<div class="bbpw_slider_widget {{ ($alternativeDesign) ? 'bb_rw03_1' : 'bb_rw03' }} {{ $mainWigetClassName }}">
	<button type="button" class="bb_close {{ $bgClassName }} bb_custom_fc">x</button>

	@if ($bAllowBranding)
		<div class="bb_top_button_powered {{ $bgClassName }} bb_custom_bc">
			<a class="bb_custom_fc" href="{{ base_url() }}"><img width="10" src="{{ base_url() }}assets/images/bb_icon_logo.png"> <span class="bb_powered_txt">Powered by BrandBoost.io</span></a>
		</div>
	@endif

	<div class="bb_clear"></div>
	<div class="bb_white_box {{ $bgClassName }}" style="margin: 0; border-radius: 0px;">
		<div class="bb_sldebutton">
			<a href="javascript:void(0);" class="bb_slide_btn left_arrow {{ $bgClassName }} bb_custom_fc" bb_direction="left"><i class="fa fa-angle-left" style="margin-top:10px;"></i></a>
			<a href="javascript:void(0);" class="bb_slide_btn right_arrow {{ $bgClassName }} bb_custom_fc" bb_direction="right"><i class="fa fa-angle-right" style="margin-top:10px;"></i></a>
		</div>

		<!--========RATING & BUTTONS========-->
		<div class="bb_top_header_sec bb_custom_bc {{ ($alternativeDesign) ? 'bb-hidden' : '' }}">
			<div class="bb_rating_sec bb_fleft">
				<p class="bb_para">
					@for ($i = 0; $i < number_format($avgRatings, 0); $i++)
						<i class="fa fa-star bb_txt_yellow bb_custom_rc"></i>
					@endfor

					@if ($i < 5)
						@for ($j = $i; $j < 5; $j++)
							<i class="fa fa-star bb_txt_grey"></i>
						@endfor
					@endif
				</p>
				<h3 class="bb_custom_fc">{{ number_format($avgRatings, 2) }}<span class="bb_custom_fc">/5</span></h3>
				<h4 class="bb_custom_bc bb_custom_fc">Based on {{ $totalReviews }} reviews</h4>
				<div class="bb_clear"></div>
			</div>
			<div class="bb_clear"></div>
		</div>

		<!--========COMMENT SEC========-->
		<div class="bb_comments_area" style="width: 100%; height: 335px; overflow:hidden;">
			@php
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
			@endphp
			<div class="bb_small_comment_box bb_custom_bc {{ ($alternativeDesign) ? $bgClassName : '' }}">
				<div class="bb_comment_header bb_custom_bc">
					<div class="bb_avatar01">
						<i class="fa bb_check_green fa-check-circle"></i>
						{!! showUserAvtar($reviewData['avatar'], $reviewData['firstname'], $reviewData['lastname']) !!}
					</div>
					<div class="bb_fleft">
						<p class="bb_para bb_custom_fc"><strong>{{ $reviewData['allow_show_name'] != 1 ? 'Anonymous' : $reviewData['firstname'] . ' ' . $reviewData['lastname'] }}</strong> </p>
						<p class="bb_para">
							@if ($bAllowRatings)
								@for ($i = 0; $i < $reviewData['ratings']; $i++)
									<i class="fa fa-star bb_txt_yellow bb_custom_rc"></i>
								@endfor

								@if ($i < 5)
									@for ($j = $i; $j < 5; $j++)
										<i class="fa fa-star bb_txt_grey"></i>
									@endfor
								@endif
							@endif
							<span class="bb_thingrey bb_custom_fc">{{ number_format($reviewData['ratings'], 1) }}/5</span>
						</p>
					</div>
					<div class="bb_fleft">
						<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_fc">Verified</span></p>
						@if ($bAllowCreatedTime)
							<p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_fc">{{ date('d M. Y', strtotime($reviewData['created'])) }}</span></p>
						@endif
					</div>
					<div class="bb_clear"></div>
					@if($bAllowCampaignName)
						<div class="bb_custom_fc" style="margin-left:52px; font-weight:bold;">{{ $reviewData['product_data']->product_name == '' ? $bbData->brand_title : $reviewData['product_data']->product_name }}</div>
					@endif
				</div>

				<div class="text_section" style="min-height:{{ ($alternativeDesign) ? '175px' : '165px' }};">
					<p class="bb_para heading_txt bb_custom_fc">{{ setStringLimit($reviewData['review_title']) }}</p>
					{{ $videoURL }}

					@if($reviewImg != '')
						<div style="margin-right:0px; margin-bottom: 30px;" class="bb_fleft">
							{{ $reviewImg }}
						</div>
					@endif

					<p class="bb_para bb_custom_fc">
						@php
							$commentLength = $reviewImg == '' ? 210 : 120;
						@endphp

						{{ setStringLimit($reviewData['comment_text'], $commentLength) }}

						@if(strlen($reviewData['comment_text']) > $commentLength)
							<a class="bb_txt_blue bb_custom_bc bbpw_comment_counter" href="javascript:void(0);" class-position="{{ $count }}">Read more...</a>
						@endif
					</p>
					<div class="bb_clear"></div>
				</div>

				<div class="bb_comment_area">
					@if ($bAllowComments)
						<a href="javascript:void(0);" class="bbpw_comment_counter bb_custom_fc" class-position="{{ $count }}"><i class="fa fa-comment txt_grey bb_custom_fc" style="font-size:16px;"></i> &nbsp;{{ sizeof($reviewData['comment_block']) }} comments</a>
					@endif

					@if ($bAllowHelpful)
						<a href="javascript:void(0);" class="bb_review_helpful bb_custom_fc">{{ ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0 }} found this helpful</a>
						<a class="bb_like_dislike bb_txt_green bbpw_helpful_action bb_review_like bb_custom_bc" href="javascript:void(0);" class-position="{{ $count }}" action-name="Yes" bb-review-id="{{ $reviewData['id'] }}"><i class="fa fa-thumbs-up" style="margin-top:5px;"></i></a>
						<a class="bb_like_dislike bb_txt_red bbpw_helpful_action bb_review_dislike bb_custom_bc" href="javascript:void(0);" class-position="{{ $count }}" action-name="No" bb-review-id="{{ $reviewData['id'] }}"><i class="fa fa-thumbs-down" style="margin-top:5px;"></i></a>
					@endif

					<a class="bb_fright bb_share_btn bb_custom_fc" href="javascript:void(0);" class-position="{{ $count }}"><i class="fa fa-share"></i> &nbsp;  Share</a>

					<div class="bbpw_share_links" style="display:none; margin: 5px 0px 0px 0px; position: absolute; right: -100px;">
						<div class="bb_clear"></div>
						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="facebook" site-url="http://pleasereviewmehere.com/campaign/{{ strtolower(str_replace(' ', '-', $reviewData['brandboost_name'])) . '-' . $campaignID }}" review-msg="{{ setStringLimit($reviewData['comment_text'], 230) }}" title-name="{{ $reviewData['review_title'] }}" review-rating="{{ $reviewData['ratings'] }}" product-image="" review-image="{{ 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] }}">Facebook</a>

						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="twitter" site-url="http://pleasereviewmehere.com/campaign/{{ strtolower(str_replace(' ', '-', $reviewData['brandboost_name'])) . '-' . $campaignID }}" review-msg="{{ setStringLimit($reviewData['comment_text'], 210) }}" title-name="{{ $reviewData['review_title'] }}" review-rating="{{ $reviewData['ratings'] }}" product-image="" review-image="{{ 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] }}">Twitter</a>

						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="linkedin" site-url="http://pleasereviewmehere.com/campaign/{{ strtolower(str_replace(' ', '-', $reviewData['brandboost_name'])) . '-' . $campaignID }}" review-msg="{{ setStringLimit($reviewData['comment_text'], 210) }}" title-name="{{ $reviewData['review_title'] }}" review-rating="{{ $reviewData['ratings'] }}" product-image="" review-image="{{ 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] }}">Linkedin</a>

						<a href="javascript:void(0);" class="bbpw_share_ss bb_custom_fc" share-type="google" site-url="http://pleasereviewmehere.com/campaign/{{ strtolower(str_replace(' ', '-', $reviewData['brandboost_name'])) . '-' . $campaignID }}" review-msg="{{ setStringLimit($reviewData['comment_text'], 210) }}" title-name="{{ $reviewData['review_title'] }}" review-rating="{{ $reviewData['ratings'] }}" product-image="" review-image="{{ 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] }}">Google</a>

						<!-- <a class="bb_custom_fc" href="whatsapp://send?text={{ $reviewData['comment_text'] }} - http://pleasereviewmehere.com/campaign/{{ strtolower(str_replace(' ', '-', $reviewData['brandboost_name'])) . '-' . $campaignID }}">Whatsapp</a> -->
					</div>
				</div>
				<div class="bb_comment_reply_sec bbpw_comment_box bb_bfw_section" style="display:none;">
					{{ view('reviews.review_comments_popup', array('oCampaign' => $oCampaign, 'reviewData' => $reviewData, 'classPositon' => $count))->render() }}
				</div>
			</div>
			@php $count++; } @endphp

			<div class="bb_clear"></div>
		</div>
	</div>
</div>
