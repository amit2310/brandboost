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
		$commentWL = '110';
		$bgClassName = '';
		if ($headerFixColor) {
			$bgClassName = $oCampaign->header_color . '_widget_bb';
			$textClassName = $oCampaign->header_color . '_text_color';
		}

		//get other settings
		$txtColor = $oCampaign->widget_font_color;
		$ratingColor  = $oCampaign->rating_solid_color;

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
@endphp

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
	.clearfix {}
	.clearfix::after {content: "";clear: both;display: table;}
	.review_chat48{max-width: 520px; width: 100%;font-family: 'Inter UI';font-style: normal; position: fixed;left: 50%;z-index: 9999999999; margin-left: -260px; top: 50%; margin-top: -330px; border-radius:5px;}
	.review_chat48 .second_box{box-shadow: 0 14px 14px 0 rgba(0, 27, 96, 0.1), 0 0 1px 0 rgba(0, 0, 0, 0.03); width: 100%; float: left; height:auto; max-height: 600px; background: #fff; overflow-y: hidden;}
	.review_chat48 .second_box:hover{overflow-y: auto;}

	.review_chat48 .head{box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.13);background-image: linear-gradient(95deg, #5c37f2, #aa7bff);border-radius: 5px 5px 0px 0px;width: 100%; float: left;}
	.review_chat48 .box_left {width: 110px; float: left;}
	.review_chat48 .box_left img{border-radius: 5px 0px 0px 5px;}
	.review_chat48 .box_right {float: left;width: 100%;}
	.review_chat48 .box_right .client_n p {margin: 0;margin-bottom: 0px;color: #fff;font-size: 16px;font-weight: 500;margin-bottom: 5px;}
	.review_chat48 .box_right .client_n p span {display: block;}
	.review_chat48 .box_right .client_n {padding: 14px 20px 10px;}
	.review_chat48 .box_right .client_review{/*background-color:rgba(7, 0, 44, 0.2);*/padding: 20px 35px; text-align: left;}
	.review_chat48 .box_right .client_review span {color: #fff;font-size: 16px;font-weight: 500;}
	.review_chat48 .box_right .re_client{ float: right;}

	.review_chat48 .middle {width: 100%;background: #fff;display: inline-block;float: left;}
	.review_chat48 .middle .box_1 {width: 100%;float: left;padding: 20px 0px 25px 0px; border-bottom: 1px solid #f3f3fa}
	.review_chat48 .middle .box_1 .top_div {padding: 0 35px 20px 35px;    border-bottom: 1px solid #f3f3fa;}
	.review_chat48 .middle  .box_1 .top_div .left {    position: relative;    width: 45px;    display: inline-block;    margin-right: 12px; top:-30px;}
	.review_chat48 .middle .box_1 .top_div .left .circle {position: absolute;width: 10px;height: 10px;background: #69d641;border-radius: 100%;right: 0;border: 3px solid #fff;bottom: 4px;right: 2px; text-align: center;}
	.review_chat48 .middle .box_1 .top_div .right {    display: inline-block;}
	.review_chat48 .middle .box_1 .top_div .right p{color: #364d79;font-size: 14px;font-weight: 500; margin: 0 0 8px 0; padding: 0}
	.review_chat48 .middle .box_1 .top_div .right .client_review span {color: #526b9b;font-size: 12px;margin-left: 10px;}
	.review_chat48 .middle .box_1 .top_div .right p span{font-size: 12px; color: #5e5e89; font-weight: normal; margin-left: 10px;}
	.review_chat48 .middle .box_1 .top_div .right p span em {padding-right: 10px; color: #dfdfef;position: relative;top: -3px;}
	.review_chat48 .middle .box_1 .top_div .right .client_review .date em{padding: 0 10px;color: #dfdfef;position: relative;top: -3px;}

	.review_chat48 .middle .box_1 .top_div .right .fa.fa-star{color: #ffc065;}
	.review_chat48 .middle .box_1 .top_div .right .fa.fa-star.grey{color: #e6e6f3}
	.review_chat48 .middle .box_1 .top_div .left .circle .fa.fa-check{font-size: 6px;color: #fff;position: relative;top: -6px;}

	.review_chat48 .middle .box_1 .bottom_div {padding: 0 35px;}
	.review_chat48 .middle .box_1 .bottom_div img{float: left; margin-right: 15px;}
	.review_chat48 .middle .box_1 .bottom_div p {color: #22375e;font-size: 14px;font-weight: normal;line-height: 1.57; margin-bottom: 10px;}
	.review_chat48 .middle .box_1 .bottom_div p img{float: left; margin-right: 15px;}
	.review_chat48 .middle .box_1 .bottom_div a {    color: #216cd0;    font-size: 14px;    text-decoration: none;}
	.review_chat48 .middle .box_1:last-child{border-bottom: 0;}
	.review_chat48 .middle .footer_div .comment_div {display: inline-block;}
	.review_chat48 .middle .footer_div .comment_div p {color: #5e5e89;font-size: 12px !important;font-weight: normal; margin: 0;}

	.review_chat48 .middle .footer_div .comment_div p img {margin-right: 8px;float: left;margin-top: 2px;}
	.review_chat48 .middle .footer_div .comment_div p span {margin-left: 0px;padding-left: 10px;margin-right: 8px;}
	.review_chat48 .middle .footer_div .comment_div p span em{margin-right: 10px;color: #dfdfef;}
	.review_chat48 .middle .footer_div .comment_div .fa.fa-comment{margin-right: 8px;}
	.review_chat48 .middle .footer_div .comment_div .comment_a .active{color: #875df9 !important;}
	.review_chat48 .middle .footer_div .comment_div .comment_a{color: #875df9;font-size: 12px !important;font-weight: normal;margin: 0; padding: 0; font-weight: 500;}
	.review_chat48 .reply_comment .reply_comment_inner .footer_div p span em{margin-right: 0}

	.review_chat48 .middle .footer_div .liked_icon {    display: inline-block;position: relative; top: 0px;}
	.review_chat48 .middle .footer_div .liked_icon img {background: #fff;padding: 4px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);border-radius: 5px;}
	.review_chat48 .middle .footer_div {padding: 0px 40px 0;}

	.review_chat48 .bottom_sec {background: #f5f8fc;padding: 25px 0;float: left;width: 100%;border-radius:0 0px 5px 0px; }
	.review_chat48 .bottom_sec span{color: #768fbf; font-size: 14px; padding-left: 20px;}
	.review_chat48 .bottom_sec img{float: right; padding-right: 20px; margin-top: 3px;}

	.review_chat48 .star_div {position: relative;float: left;width: 100%;}
	.review_chat48 .star_bottom {position: absolute;right: -60px;top: 0px;height: 42px; width: 42px; text-align: center;background: #fff; border-radius: 100%;box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);}
	.review_chat48 .star_bottom  p{color: #fff; font-size: 14px; font-weight: 500; line-height: normal; float: left; margin-right: 10px;}
	.review_chat48 .star_bottom img{margin-top:14px;}

	.review_chat48 .top_header {border-bottom: 1px solid #f3f3fa;padding: 0 35px;position: relative; background: #fff;}
	.review_chat48 .top_header .rating {padding: 27px 0;width: 100%;display: inline-block;}
	.review_chat48 .top_header .rating .left {float: left;    width: 50%; border-right: 1px solid #f3f3fa;}
	.review_chat48 .top_header .rating .left img {/*float: left;    margin-right: 5px;*/}
	.review_chat48 .top_header .rating p span {font-size: 20px;color: #080d2e;font-weight: bold;margin-right: 3px;}
	.review_chat48 .top_header .rating .left p{color: #72739c; font-size: 14px; margin-bottom: 5px;}
	.review_chat48 .top_header .rating p {margin: 0;    padding: 0;}
	.review_chat48 .top_header .rating p a {color: #080d2e;text-decoration: none;font-size: 14px;font-weight: 500; border-bottom: 1px solid #e6e6f3}
	.review_chat48 .top_header .rating .right {float: left;margin-top: 23px; width: 100%;}
	.review_chat48 .top_header .rating .right a {border-radius: 5px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border: solid 1px #d5e0f2;padding: 14px 18px;text-decoration: none;font-size: 14px;font-weight: 500;color: #102243;margin-right: 2%; width: 40%; float: left; text-align: center;}
	.review_chat48 .top_header .rating .right img {margin-right: 8px;}
	.review_chat48 .review_all{background: #fff; padding:18px 35px;border-bottom: 1px solid #f3f3fa;}
	.review_chat48 .review_all a{color: #5e5e7c; text-decoration: none;margin-right: 20px; font-weight: 500; font-size: 13px;}
	.review_chat48 .review_all a:last-child{margin-right: 0;}
	.review_chat48 .review_all a.active{color: #6145d4;}
	.review_chat48 .based_25{margin-top: 5px !important;}
	.review_chat48 .top_header .rating .left_right {float: left; margin-top: 0px; width: 49%; padding-left: 24px; box-sizing: border-box;}
	.review_chat48 .mr{margin-right:  0 !important}

	.review_chat48 .progress {height: 6px;box-shadow: none;background: #d9e0ee;border-radius: 1.5px;max-width: 100%;margin:0 0 12px 0;cursor: pointer; margin-left: 23px;}

	.review_chat48 .progress-bar-violet {background-color: #7f62df !important;border-radius: 1.5px;height: 6px;}
	.review_chat48 .progress-bar-green {background-color: #29c178 !important;border-radius: 1.5px;height: 6px;}
	.review_chat48 .progress-bar-green2 {background-color: #5ad491 !important;border-radius: 1.5px;height: 6px;}
	.review_chat48 .progress-bar-grey {background-color: #9b9dc0 !important;border-radius: 1.5px;height: 6px;}
	.review_chat48 .progress-bar-red {background-color: #e44f64 !important;border-radius: 1.5px;height: 6px;}
	.review_chat48 .smile_1 img{float: left; margin-right: 10px; margin-top:-3px;}
	.review_chat48 .date{margin-left: 0px !important;}
	.review_chat48 .fa.fa-thumbs-up {font-size: 10px;padding: 7px;background: #effbf4;border-radius: 5px;color: #29c178;margin-right: 6px;}
	.review_chat48 .fa.fa-thumbs-down{font-size: 10px;padding: 7px;background: #fff1f3;border-radius: 5px;color: #e44f64;}
	.review_chat48 .share_icon {float: right; color: #5e5e89; font-size: 12px;margin-top: -7px;}
	.review_chat48 .share_icon .fa.fa-share{color: #c4c7e4; font-size: 12px; margin-top: 15px;}
	.review_chat48 .middle .footer_div .comment_div p span em {margin-right: 10px;position: relative;top: -3px; color: #dfdfef;}



	.review_chat48 .box_right .client_review .fa.fa-angle-left {width: 16px;height: 16px;background-color: rgba(0, 0, 0, 0.2);border-radius: 100%;text-align: center;font-size: 14px;position: relative;    top: -2px;    margin-right: 8px;}
	.review_chat48 .middle .box_1 .reply_comment .right {display: inline-block;}
	.review_chat48 .middle .box_1 .reply_comment p {color: #22375e;font-size: 14px;font-weight: normal;line-height: 1.57;margin-bottom: 10px;}
	.review_chat48 .reply_comment .right {width: 90%;float: right;}
	.review_chat48 .reply_comment .client_n p{font-size: 12px !important; color: #080d2e; font-weight: 500; margin: 0;}
	.review_chat48 .reply_comment .client_review p{font-size: 14px !important; line-height: 1.57 !important; color: #353965;font-weight: normal !important;}

	.review_chat48 .reply_comment {float: left;width: 100%;padding:0px 35px;box-sizing: border-box;}
	.review_chat48 .reply_comment .footer_div{float: left; width: 100%;}
	.review_chat48 .reply_comment .left {width: 28px;float: left;margin-right: 12px;}
	.review_chat48 .reply_comment .right p span {    font-size: 12px;    color: #5e5e89;    font-weight: normal;    margin-left: 10px;}
	.review_chat48 .reply_comment p span em {    padding-right: 10px;    color: #dfdfef;    position: relative;    top: -3px;}
	.review_chat48 .reply_comment .footer_div{box-sizing: border-box;}
	.review_chat48 .reply_comment .comment_div {float: left;margin-top: 4px;}
	.review_chat48 .reply_comment .liked_icon {    float: left;}
	.review_chat48 .reply_comment .share_icon{float: left;}
	.review_chat48 .reply_comment .share_icon .fa.fa-share{margin-top: 10px;}
	.review_chat48 .reply_comment .fa.fa-thumbs-up{color: #b0b0cd;background: none;border-right: none;border-radius: 0;padding: 0 7px;margin-top: 7px;}
	.review_chat48 .reply_comment .fa.fa-thumbs-down{color: #b0b0cd;background: none;border-radius: 0;padding: 0;}
	.review_chat48 .reply_comment .footer_div .comment_div p span {margin-left: 0px !important;padding-left: 10px !important;margin-right: 0px !important;}
	.review_chat48 .reply_comment .liked_icon p{margin: 0; float: left; padding-top: 5px;color: #5e5e89;font-size: 12px;  font-weight: 500; margin-right: 10px}
	.review_chat48 .reply_comment .reply_comment_inner {float: left;width: 100%;border-bottom: 1px solid #f3f3fa;padding: 20px 0; box-sizing: border-box;}
	.review_chat48 .reply_comment .comment_div a{color: #5e5e89; font-size: 12px; text-decoration: none;}
	.review_chat48 .reply_comment .reply_comment_inner2{padding: 20px 35px;}
	.review_chat48 .reply_comment .reply_comment_inner2 .right{max-width: 318px; width: 100%;}

	.review_chat48  .reply_comment .s_name{font-size: 12px !important;color: #080d2e !important;font-weight: 500 !important;}
	.review_chat48  .reply_comment span .fa.fa-share{color: #c4c7e4;}
	.review_chat48 .bottom_footer {padding: 3px 35px;float: left;width: 100%;box-sizing: border-box;background: #fff;}
	.review_chat48 .sign_div {float: left;font-size: 14px;  font-weight: normal;  font-style: normal;  font-stretch: normal;  line-height: 1.57;  letter-spacing: normal;  color: #353965;padding: 10px 0px 10px 0; position: relative; width: 100%;}
	.review_chat48::before { width: 100%; height: 100%; top: 0; left: 0; position: fixed; content: ''; background: rgba(0, 0, 0, 0.5); z-index: -1;}


	.review_chat48 .social_footer {float: right;padding: 18px 0px 18px 18px;border-left: 1px solid #f3f3fa;}
	.review_chat48 .bottom_footer .sign_div .fa.fa-envelope-o {color: #2b97dd;font-size: 11px;background: #e9f4fb;border-radius: 100%; width: 24px; height: 24px;text-align: center;line-height: 24px;}
	.review_chat48 .bottom_footer .social_footer .fa.fa-facebook {color: #2b97dd;font-size: 12px;background: #eaeff7;border-radius: 100%;width: 24px; height: 24px;text-align: center;line-height: 24px;margin-right: 8px;}
	.review_chat48 .bottom_footer .social_footer .fa.fa-google {color: #4285f4;font-size: 12px;background: #ecf2fd;border-radius: 100%;width: 24px; height: 24px;text-align: center;line-height: 24px;margin-right: 8px;}
	.review_chat48 .bottom_footer .social_footer .fa.fa-twitter {color: #55acee;font-size: 12px;background: #eef6fd;border-radius: 100%;width: 24px; height: 24px;text-align: center;line-height: 24px;}
	.review_chat48 .bottom_footer .social_footer span {    font-size: 14px;    font-weight: normal;    font-style: normal;    font-stretch: normal;    line-height: 1.57;    letter-spacing: normal;    color: #9b9dc0;    padding-right: 30px;    padding: 5px 0px 9px 0;    position: relative;    right: 24px;    background: #fff;}

	.review_chat48  .msg_att {    position: absolute;    top: 17px;    right: 5px;    width: 50px;    height: 30px;text-align: right;color: #d2d2e8;font-size: 15px;}
	.review_chat48  .msg_att .fa.fa-smile-o {    margin-right: 4px;}
	.review_chat48  .msg_att_icon {position: absolute;    top: 13px;    left: 0px;    width: 50px;    height: 30px;	}
	.review_chat48 .msg_input {width: 100%;height: 35px;border: none;box-sizing: border-box;border-radius: 0px;padding: 6px 50px 6px 10px;font-size: 12px;background: none;font-size: 13px;font-weight: 300 !important;resize: none;padding-left: 40px;}
	.bb_avatar_image img{width: 36px; height: 36px; border-radius: 50%;}
	.bb_avatar_image.img32 img{width: 32px; height: 32px;}
</style>
	<div class="review_chat48">
		<div class="head {{ $bgClassName }}">
			<div class="box_right">
				<div class="client_review"> <span class="text-left"><i class="fa fa-angle-left"></i> Comments</span> </div>
			</div>
		</div>
		<div class="second_box">
			<div class="middle {{ $bgClassName }}">
				<div class="main_comment">
					<div class="box_1 bb_custom_bc">
						<div class="top_div bb_custom_bc">
							<div class="left bb_avatar_image"><span class="circle"><i class="fa fa-check"></i></span>{!! showUserAvtar($reviewData['user_data']['avatar'], $reviewData['user_data']['firstname'], $reviewData['user_data']['lastname']) !!}</div>
							<div class="right">
								<div class="client_n"><p class="bb_custom_fc">{{ $reviewData['allow_show_name'] != 1 ? 'Anonymous' : $reviewData['user_data']['firstname'] . ' ' . $reviewData['user_data']['lastname'] }} <span class="bb_custom_fc"><em>.</em>Verified Buyer - {{ $reviewData['brandboost_name'] }}</span></p></div>

								<div class="client_review">

									@if ($bAllowRatings)
										@for ($i = 0; $i < $reviewData['ratings']; $i++)
											<i class="fa fa-star bb_txt_yellow bb_custom_rc"></i>
										@endfor

										@if ($i < 5)
											@for ($j = $i; $j < 5; $j++)
												<i class="fa fa-star bb_txt_grey"></i>
											@endfor
										@endfor

										<span class="bb_thingrey bb_custom_fc">{{ number_format($reviewData['ratings'], 1) }}/5</span>
									@endif

									@if ($bAllowCreatedTime)
										<span class="date bb_custom_fc"><em>.</em>{{ dataFormat($reviewData['created']) }}</span>
									@endif

									<div class="bb_clear"></div>
									@if($bAllowCampaignName)
										<div class="bb_custom_fc" style="margin-top:10px; font-weight:bold;">{{ $bbData->brand_title }}</div>
									@endif
								</div>
							</div>
						</div>

						<div class="bottom_div">
							<p class="bb_custom_fc">{{ $reviewData['comment_text'] }}</p>
						</div>
						<div class="footer_div">
							<div class="comment_div"><p>
							@if ($bAllowComments)
								<span class="comment_a bb_custom_fc"><i class="fa fa-comment"></i> {{ sizeof($reviewData['comment_block']) }} Comments</span>
							@endif

							@if ($bAllowHelpful)
								<span class="bb_custom_fc"><em>.</em><span id="bb_review_helpful_cp_{{ $classPositon }}">{{ ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0 }} found this helpful</span></span>
							@endif

							</p></div>
							<div class="liked_icon">
								<a class="bb_like_dislike bbpw_helpful_action" id="bb_review_like_cp_{{ $classPositon }}" href="javascript:void(0);" class-position="{{ $classPositon }}" action-name="Yes" bb-review-id="{{ $reviewData['id'] }}"><i class="fa fa-thumbs-up"></i></a>
								<a class="bb_like_dislike bbpw_helpful_action" id="bb_review_dislike_cp_{{ $classPositon }}" href="javascript:void(0);" class-position="{{ $classPositon }}" action-name="No" bb-review-id="{{ $reviewData['id'] }}"><i class="fa fa-thumbs-down"></i></a>
							</div>
							<!-- <div class="share_icon"><i class="fa fa-share"></i> Share</div> -->
						</div>
					</div><!--box_1  reply_comment_inner2 --->

					@if ($bAllowComments)
						@php
						if (!empty($reviewData['comment_block'])):
							$key = 0;
							foreach ($reviewData['comment_block'] as $aComment):
							$getUserDetail = getUserDetail($aComment['user_id']);

						@endphp
							<div class="reply_comment">
								<div class="reply_comment_inner bb_custom_bc">
									<div class="top_div">
										<div class="left bb_avatar_image img32">{!! showUserAvtar($getUserDetail->avatar, $getUserDetail->firstname, $getUserDetail->lastname) !!}</div>

										<div class="right">
											<div class="client_n"><p class="bb_custom_fc">{{ $aComment['firstname'] . ' ' . $aComment['lastname'] }} <span class="bb_custom_fc"><em>.</em>{{ timeAgo(date('F d, Y', strtotime($aComment['created']))) }}</span></p></div>
											<div class="client_review"><p class="bb_custom_fc">{{ $aComment['content'] }}</p></div>
										</div>
									</div>
									<div class="footer_div">
										<div class="liked_icon">
											<span class="bbpw_comment_like_{{ $aComment['id'] }} bb_custom_fc">{{ $aComment['like'] }}</span>&nbsp;
											<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="{{ $classPositon }}" comment-position="{{ $key }}" action-value="1" bb-review-id="{{ $reviewData['id'] }}" bb-comment-id="{{ $aComment['id'] }}"><i class="fa fa-thumbs-up bb_custom_fc"></i></a>
											<span class="bbpw_comment_dislike_{{ $aComment['id'] }} bb_custom_fc">{{ $aComment['dislike'] }}</span>&nbsp;
											<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="{{ $classPositon }}" comment-position="{{ $key }}" action-value="0" bb-review-id="{{ $reviewData['id'] }}" bb-comment-id="{{ $aComment['id'] }}"><i class="fa fa-thumbs-down bb_custom_fc"></i></a> &nbsp;
											<a href="javascript:void(0);" class="bb_comment_reply bb_custom_fc" review-position="{{ $classPositon }}" comment-position="{{ $key }}" style="text-decoration: none;">Reply</a>
										</div>
										<div class="bb_comment_reply_box" id="bb_comment_reply_box_{{ $classPositon }}_{{ $key }}" style="display:none; width:110%; margin-top:20px; margin-left:0px;">
											<div class="bbpw_comment_form bb_add_comment_sec_2 bb_custom_bc" style="padding:0px;">
												<div class="bb_overlay_replay" id="bb_overlay_{{ $aComment['id'] }}"><img src="{{ base_url() }}/assets/images/widget_load.gif" width="60" height="60"></div>
												<p style="padding-left: 40px;" class="bb_custom_fc">Replay comment</p>
												<div class="bbpw_success_message" style="padding-left: 40px; padding-bottom: 10px;">
													<div class="bb-success-msg1 bb-hidden bb_custom_fc" id="bb_success_msg_{{ $aComment['id'] }}">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
													<div class="bb-error-msg1 bb-hidden" id="bb_error_msg_{{ $aComment['id'] }}">OPPS! Error while posting your comment. Try again!</div>
												</div>
												<div class="bb_add_ctext" style="margin-bottom:10px; margin-left:40px;">
													<div class="bb_add_user_icon"><img src="{{ base_url() }}assets/images/widget/user_img_blank.png" width="28"></div>
													<textarea class="bbpw_form_control addnote bbcmtreply" id="bbcmtreply_{{ $aComment['id'] }}" placeholder="Write Your Comments Here"></textarea>
													<div class="bb_txt_format" style="padding-bottom:15px;">
														<a href="javascript:void(0);">B</a>
														<a href="javascript:void(0);">/</a>
														<a href="javascript:void(0);">U</a>
														<a href="javascript:void(0);">$</a>
													</div>
												</div>
												<div class="bb_signup_sec" style="padding:15px; border-radius:5px; margin-left:40px;">
													<div class="bb_social bb-hidden" style="float:none; margin:0 auto;">
														<a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/widget/bb_widget_google.png"></a>
														<a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/widget/bb_widget_facebook.png"></a>
														<a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/widget/bb_widget_twitter.png"></a>
													</div>
													<p style="margin:0px 0 20px; float: none;text-align: center; line-height: 10px;"><span class="bb-hidden">OR</span><br>Sign Up With Brand Boost</p>
													<div class="bb_input_sec">
														<input id="bbcmtreplyname_{{ $aComment['id'] }}" placeholder="Your Name" class="bb_signup_input bbcmtreplyname user" type="text">
														<input id="bbcmtreplyemail_{{ $aComment['id'] }}" placeholder="Your Email" class="bb_signup_input bbcmtreplyemail" type="text">
														<input id="bbcmtreplyphone_{{ $aComment['id'] }}" placeholder="Your Phone" class="bb_signup_input bbcmtreplyphone phone" type="text">

														<ul class="bb_terms_check">
															<li><span class="bb_cust_checkbox">
																<label class="custmo_checkbox">
																	<input type="checkbox" id="bb_comment_terms_{{ $aComment['id'] }}" value="1" checked>
																	<span class="custmo_checkmark"></span>
																</label>
															</span> I agree to Brand Boost <a href="{{ base_url() }}" target="_blank">Terms of Service</a></li>
															<li><span class="bb_cust_checkbox">
																<label class="custmo_checkbox">
																	<input type="checkbox" id="bb_comment_processing_{{ $aComment['id'] }}" value="1" checked>
																	<span class="custmo_checkmark"></span>
																</label>
															</span> I agree to Disqus processing of email and IP address, and the use of cookies, to facilitate my authentication and posting of comments, explained further in the <a href="#">Privacy Policy</a>
															</li>
														</ul>
														<input type="hidden" id="bb_review_id_{{ $aComment['id'] }}" value="{{ $reviewData['id'] }}" >
														<input type="hidden" id="bb_comment_id_{{ $aComment['id'] }}" value="{{ $aComment['id'] }}" >
														<button type="submit" class="bb_submit_btn bbcmtreplysubmit {{ $bgClassName }} bb_custom_fc" comment-id="{{ $aComment['id'] }}" style="cursor:pointer;">Submit</button>
													</div>
													<div class="bb_clear"></div>
												</div>

											</div>
										</div>

									</div>
								</div>
							</div><!--reply_comment--->
							@php

							foreach ($childComments as $cComment):
								$cComment = (array) $cComment;
								$getUserDetail = getUserDetail($cComment['user_id']);
								$oCommentLike = $this->mReviews->countCommentLike($cComment['id']);
							@endphp
								<div class="bb_inner_reply" style="margin-left:40px;">
									<div class="bb_comment_header_small">
										<div class="bb_avatar_small">
											{!! showUserAvtar($getUserDetail->avatar, $getUserDetail->firstname, $getUserDetail->lastname) !!}
										</div>
										<div class="bb_fleft">
											<p class="bb_para bb_custom_fc"><strong>{{ $cComment['firstname'] . ' ' . $cComment['lastname'] }}</strong> </p>
										</div>
										<div class="bb_fleft">
											<p class="bb_para bb_custom_fc"><span class="bb_dot"><i class="fa fa-circle"></i></span> <span class="bb_thingrey bb_custom_fc">{{ timeAgo(date('F d, Y', strtotime($cComment['created']))) }}</span></p>
										</div>
										<div class="bb_clear"></div>
									</div>
									<div class="text_section_reply">
										<p class="bb_para bb_custom_fc">{{ $cComment['content'] }}</p>
									</div>
									<div class="bb_comment_area_reply">
										<span class="bbpw_comment_like_{{ $cComment['id'] }} bb_custom_fc">{{ $oCommentLike['like'] }}</span>&nbsp;
										<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="{{ $classPositon }}" comment-position="{{ $key }}" action-value="1" bb-review-id="{{ $reviewData['id'] }}" bb-comment-id="{{ $cComment['id'] }}"><i class="fa fa-thumbs-up"></i></a>
										<span class="bbpw_comment_dislike_{{ $cComment['id'] }} bb_custom_fc">{{ $oCommentLike['dislike'] }}</span>&nbsp;
										<a href="javascript:void(0);" class="bbpw_comment_like_action bb_custom_fc" review-position="{{ $classPositon }}" comment-position="{{ $key }}" action-value="0" bb-review-id="{{ $reviewData['id'] }}" bb-comment-id="{{ $cComment['id'] }}"><i class="fa fa-thumbs-down"></i></a>
										<!-- <a href="#">Share</a> -->
									</div>
								</div>
							@endforeach
					@php $key++; endforeach @endphp
						@endif
					@endif
					<div class="bb_add_comment_sec_2 bb_custom_bc" style="float:left; margin-top:-2px;">
						<div class="bb_overlay"><img src="{{ base_url() }}/assets/images/widget_load.gif" width="60" height="60"></div>
						<p style="margin-left: 55px; margin-top:-30px;" class="bb_custom_fc"><strong><br /><br />Add comment</strong></p>
						<div class="bbpw_success_message" style="margin-left: 50px; padding-bottom: 10px;">
							<div class="bb-success-msg bb-hidden bb_custom_fc">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
							<div class="bb-error-msg bb-hidden">OPPS! Error while posting your comment. Try again!</div>
						</div>
						<div class="bb_add_ctext" style="margin-bottom:10px; margin-left: 48px;">
							<div class="bb_add_user_icon"><img src="{{ base_url() }}assets/images/widget/user_img_blank.png" width="28"></div>
							<textarea class="bbpw_form_control addnote bbcmt" id="bbcmt_{{ $cComment['id'] }}" placeholder="Write Your Comments Here"></textarea>
							<div class="bb_txt_format" style="padding-bottom:15px;">
								<a href="javascript:void(0);">B</a>
								<a href="javascript:void(0);">/</a>
								<a href="javascript:void(0);">U</a>
								<a href="javascript:void(0);">$</a>
							</div>
						</div>
						<div class="bb_signup_sec" style="padding:15px; border-radius:5px; margin-left: 48px;">
							<div class="bb_social bb-hidden" style="float:none; margin:0 auto;">
								<a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/widget/bb_widget_google.png"></a>
								<a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/widget/bb_widget_facebook.png"></a>
								<a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/widget/bb_widget_twitter.png"></a>
							</div>
							<p style="margin:0px 0 20px; float: none;text-align: center; line-height: 10px;"><span class="bb-hidden">OR</span><br>Sign Up With Brand Boost</p>
							<div class="bb_input_sec">
								<input id="bbcmtname_{{ $cComment['id'] }}" placeholder="Your Name" class="bb_signup_input bbcmtname user" type="text">
								<input id="bbcmtemail_{{ $cComment['id'] }}" placeholder="Your Email" class="bb_signup_input bbcmtemail" type="text">
								<input id="bbcmtphone_{{ $cComment['id'] }}" placeholder="Your Phone" class="bb_signup_input bbcmtphone phone" type="text">

								<ul class="bb_terms_check">
									<li><span class="bb_cust_checkbox">
										<label class="custmo_checkbox">
											<input type="checkbox" id="bb_comment_terms_{{ $cComment['id'] }}" value="1" class="bb_comment_terms" checked>
											<span class="custmo_checkmark"></span>
										</label>
									</span> I agree to Brand Boost <a href="{{ base_url() }}" target="_blank">Terms of Service</a></li>
									<li><span class="bb_cust_checkbox">
										<label class="custmo_checkbox">
											<input type="checkbox" id="bb_comment_processing_{{ $cComment['id'] }}" value="1" class="bb_comment_processing" checked>
											<span class="custmo_checkmark"></span>
										</label>
									</span> I agree to Disqus processing of email and IP address, and the use of cookies, to facilitate my authentication and posting of comments, explained further in the <a href="#">Privacy Policy</a>
									</li>
								</ul>
								<input type="hidden" name="bb-review-id" class="bb-review-id" value="{{ $reviewData['id'] }}" >
								<button type="submit" class="bb_submit_btn bbcmtsubmit {{ $bgClassName }} bb_custom_fc" name="bbcmtsubmit" class-position="{{ $classPositon }}" style="cursor:pointer;">Submit</button>
							</div>
							<div class="bb_clear"></div>
						</div>
					</div>
				</div><!------>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="star_bottom bbpw_close_bfpw {{ $bgClassName }} bb_custom_fc" class-position="{{ $classPositon }}" style="line-height: 39px; font-size: 16px;">x</div>
	</div>
