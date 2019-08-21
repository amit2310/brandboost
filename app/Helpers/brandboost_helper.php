<?php

/**
 * Get Brandboost Campaign Details but return total campaign count
 */
if (!function_exists('getBBCount')) {

    function getBBCount($userid = 0, $bbType) {
        $bbData = \App\Models\Admin\BrandboostModel::getBrandboostByUserId($userid, $bbType);
        if (!empty($bbData)) {
            return count($bbData);
        }
    }

}

/**
 * Get Member's list of all chats
 */
if (!function_exists('getChatCount')) {

    function getChatCount($userid = 0, $userRole = '') {
        $oChats = App\Models\Admin\Modules\ChatsModel::getChatLists($userid, $userRole);
        if (!empty($oChats)) {
            return count($oChats);
        }
    }

}


/**
 * Get Member Brandboost widget count
 */
if (!function_exists('getWidgetCount')) {

    function getWidgetCount($userid = 0) {
        $oWidgets = App\Models\Admin\BrandboostModel::getBBWidgets('', $userid, 'onsite');
        if (!empty($oWidgets)) {
            return count($oWidgets);
        }
    }

}


/**
 * Get Member NPS widgets count
 */
if (!function_exists('getNPSWidgetCount')) {

    function getNPSWidgetCount($userid = 0) {
        $oWidgets = App\Models\Admin\Modules\NpsModel::getNPSWidgets($userid);

        if (!empty($oWidgets)) {
            return count($oWidgets);
        }
    }

}

/**
 * Get Member Referral widgets count
 */
if (!function_exists('referralNPSWidgetCount')) {

    function referralNPSWidgetCount($userid = 0) {
        $oWidgets = App\Models\Admin\Modules\ReferralModel::getReferralWidgets($userid);
        
        if (!empty($oWidgets)) {
            return count($oWidgets);
        }
    }

}


/**
 * Get Member's Bandboost Media Count
 */
if (!function_exists('getMediaCount')) {

    function getMediaCount($userid = 0) {
        $oReviews = App\Models\ReviewsModel::getCampaignReviewsDetail('', $userid);
        $bbData = 0;
        if (!empty($oReviews)) {
            foreach ($oReviews as $oReview) {
                if(!empty($oReview->media_url)){
                    
                    //pre($oReview->media_url);
                    
                    
                   $mediaUrl = @unserialize($oReview->media_url);
                   if(empty($mediaUrl)){
                       $mediaUrl = array($oReview->media_url);
                   }
                    
                }else{
                    $mediaUrl = array();
                }
                
                if (!empty($mediaUrl)) {
                    $totalMedia = count($mediaUrl);
                } else {
                    $totalMedia = 0;
                }
                $bbData = $bbData + $totalMedia;
            }
        }

        return $bbData;
    }

}

/**
 * Get all Country
 */
if (!function_exists('getAllCountries')) {

    function getAllCountries() {

        $oWidgets = App\Models\Admin\UsersModel::getAllCountries();

        if(!empty($oWidgets)) {
            return $oWidgets;
        }
    }

}


if (!function_exists('getBBReportStats')) {

    function getBBReportStats($cDate = '') {
        
        $bbData = \App\Models\Admin\BrandboostModel::getBBStatsByDate($cDate);
        return $bbData;

    }

}

if (!function_exists('getBBCountOnsite')) {

    function getBBCountOnsite() {
        $bbData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Brandboost_model", "mBrandboost");

        $bbData = $CI->mBrandboost->campaign_count_all();

        if (!empty($bbData)) {
            return '(' . $bbData . ')';
        }
    }

}

if (!function_exists('getBBCountOffsite')) {

    function getBBCountOffsite() {
        $bbData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Brandboost_model", "mBrandboost");

        $bbData = $CI->mBrandboost->campaign_offsite_count_all();

        if (!empty($bbData)) {
            return '(' . $bbData . ')';
        }
    }

}


if (!function_exists('time_elapsed_string')) {

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}


if (!function_exists('getCampaignSiteReviewCount')) {

    function getCampaignSiteReviewCount($campaignId) {
        $aUser = array();
        $aUser = \App\Models\SitereviewsModel::getCampSiteReviews($campaignId);

        if (!empty($aUser)) {
            return count($aUser);
        }
    }

}


if (!function_exists('getCampaignSiteReviewRA')) {

    function getCampaignSiteReviewRA($campaignId) {
        $reviewRA = array();
        
        $reviewRA = \App\Models\SitereviewsModel::getCampSiteReviewsRA($campaignId);
        $totalRA = 0;
        if ($reviewRA->count() > 0) {
            foreach ($reviewRA as $data) {
                $totalRA = $data->ratings + $totalRA;
            }
            $totalRA = number_format($totalRA / count($reviewRA));
        }
        if (!empty($totalRA)) {
            return $totalRA;
        }
    }

}

if (!function_exists('getCampaignReviewCount')) {

    function getCampaignReviewCount($campaignId) {
        $aUser = \App\Models\ReviewsModel::getCampReviews($campaignId);
        return $aUser->count();
    }

}

if (!function_exists('getCampaignReviewRA')) {

    function getCampaignReviewRA($campaignId) {
        $reviewRA = \App\Models\ReviewsModel::getCampReviewsRA($campaignId);
        $totalRA = 0;
        if ($reviewRA->count()>0) {
            foreach ($reviewRA as $data) {
                $totalRA = $data->ratings + $totalRA;
            }
            $totalRA = number_format($totalRA / count($reviewRA));
        }
        if (!empty($totalRA)) {
            return $totalRA;
        }
    }

}

if (!function_exists('getCampaignFeedbackCount')) {

    function getCampaignFeedbackCount($campaignId) {       
        $aFeedback = \App\Models\FeedbackModel::getCampFeedback($campaignId);
		$aFeedback = $aFeedback->count();
        if (!empty($aFeedback)) {
            return $aFeedback;
        }
    }

}

if (!function_exists('getCampaignCommentCount')) {

    function getCampaignCommentCount($reviewId) {
        $aUser = array();
		$aComment = App\Models\CommentModel::getCampReviewComment($reviewId);
       
        if (!empty($aComment)) {
            return count($aComment);
        }
    }

}


 /**
 * This function is used to get tags by the user id
 * @return type
 */

if (!function_exists('getTagsByReviewID')) {

    function getTagsByReviewID($reviewId) {
        $tagsData =  App\Models\Admin\TagsModel::getTagsDataByReviewID($reviewId);
        return $tagsData;

    }

}

if (!function_exists('getCampaignsByEventID')) {

    function getCampaignsByEventID($eventID) {
        $aData = \App\Models\Admin\BrandboostModel::getCampByEventID($eventID);
        return $aData;
    }

}

if (!function_exists('getOffsite')) {

    function getOffsite($offsiteId) {
        $aOffsiteDetail = App\Models\Admin\OffsiteModel::getOffsite($offsiteId);

        if (!empty($aOffsiteDetail[0])) {
            return $aOffsiteDetail[0];
        }
    }

}

if (!function_exists('getReviewStarShow')) {

    function getReviewStarShow($reviewStars) {
        $reviewStar = '';
        for ($i = 1; $i <= $reviewStars; $i++) {
            $reviewStar .= '<i class="fa green fa-star"></i>';
        }
        for ($i = 5; $i > $reviewStars; $i--) {
            $reviewStar .= '<i class="fa green fa-star-o"></i>';
        }
        return $reviewStar;
    }

}

if (!function_exists('replaceEmailTags')) {

    function replaceEmailTags($brandboostID, $emailTag, $campaignType = 'email') {
        $aData = array();
        $htmlData = '';
        $aBrandboost = \App\Models\Admin\BrandboostModel::getBBInfo($brandboostID);
        if (!empty($aBrandboost)) {
            $bbType = $aBrandboost->review_type;
            $aOffsiteUrls = unserialize($aBrandboost->offsites_links);
            $random_keys = 0;
            if(!empty($aOffsiteUrls)){
                $random_keys = array_rand($aOffsiteUrls, 1);
            }
            
            $offsiteURL = $aOffsiteUrls[$random_keys];
        }

        switch ($emailTag) {
            case '{FIVE_STARS_RATINGS}':
                $aData = \App\Models\ReviewsModel::getCampReviewsWithFiveRatings($brandboostID);
                $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
				.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
				.bb_txt_user.last{margin: 0;}
				.bb_txt_user p strong{ color: #3b9200;}
				.bb_txt_user p span{ font-size: 12px;}
				.bb_txt_user p .fa{font-size: 15px!important;}
				.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
				.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
				.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
				.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
				.bb_date_help p{text-align: right; color: #666}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				</style>
				</head>
				<body>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($aData[0]->logo_img) . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($aData[0]->brand_img) . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . @($aData[0]->brand_title) . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . @($aData[0]->brand_desc) . '</span></p>
				<p><a class="green" href="#">' . @($aData[0]->bb_u_firstname) . ' ' . @($aData[0]->bb_u_lastname) . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div>';
                foreach ($aData as $data) {
                    $helpfulCountArray = \App\Models\ReviewsModel::countHelpful($data->reviewId);
                    $starValue = getReviewStarShow($data->ratings);
                    $htmlData .= '<div class="bb_txt_user">
					<p><strong>' . @($data->firstname) . ' ' . @($data->lastname) . '</strong> <span>Verified Buyer</span></p>
					<p>' . $starValue . '</p>
					<div class="bb_txt_user_rev"><p><span>' . @($data->comment_text) . '</span></p></div>
					<div class="bb_date_help">
					<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
					<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
					</div>
					</div>';
                }
                $htmlData .= '<div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                break;

            case '{FOUR_STARS_RATINGS}':
                $aData = \App\Models\ReviewsModel::getCampReviewsWithFourRatings($brandboostID);
                $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
				.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
				.bb_txt_user.last{margin: 0;}
				.bb_txt_user p strong{ color: #3b9200;}
				.bb_txt_user p span{ font-size: 12px;}
				.bb_txt_user p .fa{font-size: 15px!important;}
				.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
				.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
				.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
				.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
				.bb_date_help p{text-align: right; color: #666}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				</style>
				</head>
				<body>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($aData[0]->logo_img) . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($aData[0]->brand_img) . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . @($aData[0]->brand_title) . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . @($aData[0]->brand_desc) . '</span></p>
				<p><a class="green" href="#">' . @($aData[0]->bb_u_firstname) . ' ' . @($aData[0]->bb_u_lastname) . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div>';
                foreach ($aData as $data) {
                    $helpfulCountArray = \App\Models\ReviewsModel::countHelpful($data->reviewId);
                    $starValue = getReviewStarShow($data->ratings);
                    $htmlData .= '<div class="bb_txt_user">
					<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
					<p>' . $starValue . '</p>
					<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
					<div class="bb_date_help">
					<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
					<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
					</div>
					</div>';
                }
                $htmlData .= '<div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                break;

            case '{TOP_STAR_RATINGS}':
                $aData = \App\Models\ReviewsModel::getCampReviewsWithTopRatings($brandboostID);
                $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				</head>
				<body>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
				.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
				.bb_txt_user.last{margin: 0;}
				.bb_txt_user p strong{ color: #3b9200;}
				.bb_txt_user p span{ font-size: 12px;}
				.bb_txt_user p .fa{font-size: 15px!important;}
				.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
				.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
				.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
				.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
				.bb_date_help p{text-align: right; color: #666}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				</style>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($aData[0]->logo_img) . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . @($aData[0]->brand_img) . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . @($aData[0]->brand_title) . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . @($aData[0]->brand_desc) . '</span></p>
				<p><a class="green" href="#">' . @($aData[0]->bb_u_firstname) . ' ' . @($aData[0]->bb_u_lastname) . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div>';
                foreach ($aData as $data) {
                    $helpfulCountArray = \App\Models\ReviewsModel::countHelpful($data->reviewId);
                    $starValue = getReviewStarShow($data->ratings);
                    $htmlData .= '<div class="bb_txt_user">
					<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
					<p>' . $starValue . '</p>
					<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
					<div class="bb_date_help">
					<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
					<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
					</div>
					</div>';
                }
                $htmlData .= '<div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                break;

            case '{WRITE_REVIEW_FORM}':
                $aData = \App\Models\ReviewsModel::getBrandBoostCampaign($brandboostID);

                $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 18px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 20px; font-weight:bold;}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				.bb_txt_write{padding: 15px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 3px; margin: 15px 0;}
				.bb_txt_write input[type=text], .bb_txt_write textarea, .bb_txt_write select{border: 1px solid #ddd; height: 30px; display: block;width: 100%; margin-bottom: 15px; box-sizing: border-box; font-family: "Open Sans", sans-serif;background: #fff; border-radius: 3px;}
				.bb_txt_write textarea{ height: 85px;  padding: 15px; }
				.bb_txt_write input[type=submit]{background: #3b9200; color: #3b9200; height: 30px; width: 100px; border: none; color: #fff; float: right; border-radius: 3px;}
				.bb_write_review{display: inline-block; width: 150px; text-align: center; height: 30px; color: #fff; background: #3b9200; line-height: 30px; margin: 0 0 20px; text-decoration: none; text-transform: uppercase; border-radius: 3px;}";
				</style>
				</head>
				<body>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData->logo_img . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData->brand_img . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . $aData->brand_title . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . $aData->brand_desc . '</span></p>
				<p><a class="green">' . $aData->firstname . ' ' . $aData->lastname . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div><div class="bb_txt_write">
				<form name="writeReview" id="writeReview" method="POST" action="' . base_url("/reviews/saveReviewByEmailTemplate") . '">
				<p class="green">WRITE A REVIEW</p>
				<p>Score:</p>
				<select name="ratingValue" id="ratingValue" required>
				<option value="">Select Star Ratings</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
				<p>Name:</p>
				<input type="text" value="" name="fullname" required>
				<p>Email:</p>
				<input type="text" value="" name="email" required >
				<p>Review: </p>
				<textarea name="content" id="content" required></textarea>
				<input type="hidden" value="text" name="type" >
				<input type="hidden" value="' . $aData->id . '" name="campaign_id" >
				<input type="submit" value="POST" name="post"/>
				</form>
				<div class="clearfix"></div>
				</div><div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                break;

            case '{TEXT_REVIEW_URL}':
            case '{REVIEW_URL}':
                if ($bbType == 'offsite') {
                    foreach ($aOffsiteUrls AS $index => $aUrl) {
                        $aWebsiteInfo = \App\Models\Admin\BrandboostModel::getOffsiteWebsite($index);
                        if ($campaignType == 'sms') {
                            $htmlData .= $aUrl['shorturl'] . "<br>";
                        } else {
                            $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                        }
                    }
                } else {
                    if ($campaignType == 'sms') {
                        $htmlData = base_url("reviews/addnew");
                    } else {
                        $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                    }
                }

                break;

            case '{VIDEO_REVIEW_URL}':

                if ($bbType == 'offsite') {
                    foreach ($aOffsiteUrls AS $index => $aUrl) {
                        $aWebsiteInfo = \App\Models\Admin\BrandboostModel::getOffsiteWebsite($index);
                        if ($campaignType == 'sms') {
                            $htmlData .= $aUrl['shorturl'] . "<br>";
                        } else {
                            $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                        }
                    }
                } else {
                    if ($campaignType == 'sms') {
                        $htmlData = base_url("reviews/addnew");
                    } else {
                        $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                    }
                }
                break;
        }


        return $htmlData;
    }

}


if (!function_exists('getAnswerCount')) {

    function getAnswerCount($quesId) {

        $CI = & get_instance();
        $CI->load->model("admin/Question_model", "mQuestion");

        $aAns = $CI->mQuestion->getAllAnswer($quesId);

        if (!empty($aAns)) {
            return count($aAns);
        }
    }

}

if (!function_exists('getBrandboostDetail')) {

    function getBrandboostDetail($brandboostID) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Brandboost_model", "rBrandboost");

        $aData = $CI->rBrandboost->getBrandboost($brandboostID);
        return $aData[0];
    }

}


 /**
     * This function will return Userdetails by user id
     * @param type $userID
     * @return type
     */

if (!function_exists('getUserDetail')) {

    function getUserDetail($userID) {
       $oData = \App\Models\Admin\UsersModel::getUserInfo($userID);
        return $oData;
    }

}

if (!function_exists('getSupportChatDetail')) {

    function getSupportChatDetail($userID) {
        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "rUsers");
        $oUser = $CI->rUsers->getSupportChatinfo($userID);
        return $oUser;
    }

}



if (!function_exists('getUserDetailByEmailId')) {

    function getUserDetailByEmailId($emailID) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "rUsers");
        $aData = $CI->rUsers->checkEmailExist($emailID);
        return $aData[0];
    }

}


if (!function_exists('showEmailSmsCount')) {

    function showEmailSmsCount($brandboostId, $type) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Brandboost_model", "rBrandboost");
        $aData = $CI->rBrandboost->numOfEmailSms($brandboostId, $type);
        return $aData;
    }

}

if (!function_exists('getSubscriberOfBrandboost')) {

    function getSubscriberOfBrandboost($brandboostId) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Brandboost_model", "rBrandboost");
        $aData = $CI->rBrandboost->getBrandboostSubs($brandboostId);
        return $aData;
    }

}

if (!function_exists('getDistinctSubs')) {

    function getDistinctSubs($brandboostId, $type) {

        $aData = array();
        $CI = & get_instance();
        $CI->load->model("admin/Brandboost_model", "rBrandboost");
        $aData = $CI->rBrandboost->getDistinctSubs($brandboostId, $type);
        return $aData;
    }

}

if (!function_exists('getSendRequest')) {

    function getSendRequest($brandboostId, $type) {

        $aData = array();
        $aData = \App\Models\Admin\BrandboostModel::getSendRequest($brandboostId, $type);
        return $aData;
    }

}

if (!function_exists('getSendResponseCount')) {

    function getSendResponseCount($brandboostId) {
        $aData = \App\Models\ReviewsModel::getCampReviewsCount($brandboostId);
        return $aData;
    }

}

if (!function_exists('getSendResponse')) {

    function getSendResponse($brandboostId, $type) {
       $aData = \App\Models\ReviewsModel::getCampReviewsResponse($brandboostId, $type);
       return $aData;
    }

}

function emailPreviewTagReplace($bbID, $sHtml, $campaignType, $userID) {

    $CI = & get_instance();
    $CI->load->model("admin/Users_model", "mmUser");
    
    $aUser = $CI->mmUser->getUserInfo($userID);

    $aTags = $CI->config->item('email_tags');
    $aBrandboost = \App\Models\Admin\BrandboostModel::getBBInfo($bbID);

    if (!empty($aBrandboost)) {
        $bbType = $aBrandboost->review_type;
        $aOffsiteUrls = unserialize($aBrandboost->offsites_links);
        $random_keys = array_rand($aOffsiteUrls, 1);
        $offsiteURL = $aOffsiteUrls[$random_keys];
    }
    if (!empty($aTags)) {
        foreach ($aTags AS $sTag) {
            $htmlData = '';

            switch ($sTag) {
                case '{FIRST_NAME}':
                    $htmlData = $aUser->firstname;
                    break;

                case '{LAST_NAME}':
                    $htmlData = $aUser->lastname;
                    break;

                case '{EMAIL}':
                    $htmlData = $aUser->email;
                    break;

                case '{PHONE}':
                    $htmlData = ($aUser->phone) ? $aUser->phone : $aUser->mobile;
                    break;

                case '{FIVE_STARS_RATINGS}':
                    $aData = \App\Models\ReviewsModel::getCampReviewsWithFiveRatings($bbID);
                    $htmlData = '<html>
					<head>
					<meta charset="utf-8">
					<title>Brandboost Email Template</title>
					<style>
					@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
					@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
					body{margin: 0;}
					.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
					.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
					.bb_txt_review .clearfix{clear: both;}
					.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
					.bb_txt_head img{width: 120px; height: auto;}
					.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
					.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
					.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
					.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
					.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
					.bb_txt_user.last{margin: 0;}
					.bb_txt_user p strong{ color: #3b9200;}
					.bb_txt_user p span{ font-size: 12px;}
					.bb_txt_user p .fa{font-size: 15px!important;}
					.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
					.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
					.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
					.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
					.bb_date_help p{text-align: right; color: #666}
					.product_details_sec{margin-bottom: 15px;}
					.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
					.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
					.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
					.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
					.bb_slides_text p .fa.green{ color: #3b9200;}
					.fa.red{ color: red!important;}
					.bb_slides_text p span{font-style: italic;}
					.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
					.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
					</style>
					</head>
					<body>
					<div class="bb_txt_review">
					<div class="bb_txt_inner">
					<div class="bb_txt_head">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->logo_img . '"/>
					</div>
					<div class="product_details_sec">
					<div class="bb_product_img">
					<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->brand_img . '"/>
					</div>
					<div class="bb_slides_text">
					<h4>' . $aData[0]->brand_title . '</h4>
					<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
					<p><span>' . $aData[0]->brand_desc . '</span></p>
					<p><a class="green" href="#">' . $aData[0]->bb_u_firstname . ' ' . $aData[0]->bb_u_lastname . '</a></p>
					</div>
					<div class="clearfix"></div>
					</div>';
                    foreach ($aData as $data) {
                        $helpfulCountArray = \App\Models\ReviewsModel::countHelpful($data->reviewId);
                        $starValue = getReviewStarShow($data->ratings);
                        $htmlData .= '<div class="bb_txt_user">
						<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
						<p>' . $starValue . '</p>
						<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
						<div class="bb_date_help">
						<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
						<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
						</div>
						</div>';
                    }
                    $htmlData .= '<div class="clearfix"></div>
					</div>
					</div>
					</body>
					</html>';
                    break;

                case '{FOUR_STARS_RATINGS}':
                    $aData = \App\Models\ReviewsModel::getCampReviewsWithFourRatings($bbID);
                    $htmlData = '<html>
					<head>
					<meta charset="utf-8">
					<title>Brandboost Email Template</title>
					<style>
					@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
					@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
					body{margin: 0;}
					.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
					.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
					.bb_txt_review .clearfix{clear: both;}
					.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
					.bb_txt_head img{width: 120px; height: auto;}
					.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
					.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
					.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
					.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
					.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
					.bb_txt_user.last{margin: 0;}
					.bb_txt_user p strong{ color: #3b9200;}
					.bb_txt_user p span{ font-size: 12px;}
					.bb_txt_user p .fa{font-size: 15px!important;}
					.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
					.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
					.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
					.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
					.bb_date_help p{text-align: right; color: #666}
					.product_details_sec{margin-bottom: 15px;}
					.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
					.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
					.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
					.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
					.bb_slides_text p .fa.green{ color: #3b9200;}
					.fa.red{ color: red!important;}
					.bb_slides_text p span{font-style: italic;}
					.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
					.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
					</style>
					</head>
					<body>
					<div class="bb_txt_review">
					<div class="bb_txt_inner">
					<div class="bb_txt_head">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->logo_img . '"/>
					</div>
					<div class="product_details_sec">
					<div class="bb_product_img">
					<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->brand_img . '"/>
					</div>
					<div class="bb_slides_text">
					<h4>' . $aData[0]->brand_title . '</h4>
					<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
					<p><span>' . $aData[0]->brand_desc . '</span></p>
					<p><a class="green" href="#">' . $aData[0]->bb_u_firstname . ' ' . $aData[0]->bb_u_lastname . '</a></p>
					</div>
					<div class="clearfix"></div>
					</div>';
                    foreach ($aData as $data) {
                        $helpfulCountArray = \App\Models\ReviewsModel::countHelpful($data->reviewId);
                        $starValue = getReviewStarShow($data->ratings);
                        $htmlData .= '<div class="bb_txt_user">
						<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
						<p>' . $starValue . '</p>
						<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
						<div class="bb_date_help">
						<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
						<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
						</div>
						</div>';
                    }
                    $htmlData .= '<div class="clearfix"></div>
					</div>
					</div>
					</body>
					</html>';
                    break;

                case '{TOP_STAR_RATINGS}':
                    $aData = \App\Models\ReviewsModel::getCampReviewsWithTopRatings($bbID);
                    $htmlData = '<html>
					<head>
					<meta charset="utf-8">
					<title>Brandboost Email Template</title>
					</head>
					<body>
					<style>
					@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
					@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
					body{margin: 0;}
					.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
					.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
					.bb_txt_review .clearfix{clear: both;}
					.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
					.bb_txt_head img{width: 120px; height: auto;}
					.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
					.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
					.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
					.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
					.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
					.bb_txt_user.last{margin: 0;}
					.bb_txt_user p strong{ color: #3b9200;}
					.bb_txt_user p span{ font-size: 12px;}
					.bb_txt_user p .fa{font-size: 15px!important;}
					.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
					.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
					.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
					.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
					.bb_date_help p{text-align: right; color: #666}
					.product_details_sec{margin-bottom: 15px;}
					.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
					.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
					.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
					.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
					.bb_slides_text p .fa.green{ color: #3b9200;}
					.fa.red{ color: red!important;}
					.bb_slides_text p span{font-style: italic;}
					.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
					.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
					</style>
					<div class="bb_txt_review">
					<div class="bb_txt_inner">
					<div class="bb_txt_head">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->logo_img . '"/>
					</div>
					<div class="product_details_sec">
					<div class="bb_product_img">
					<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->brand_img . '"/>
					</div>
					<div class="bb_slides_text">
					<h4>' . $aData[0]->brand_title . '</h4>
					<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
					<p><span>' . $aData[0]->brand_desc . '</span></p>
					<p><a class="green" href="#">' . $aData[0]->bb_u_firstname . ' ' . $aData[0]->bb_u_lastname . '</a></p>
					</div>
					<div class="clearfix"></div>
					</div>';
                    foreach ($aData as $data) {
                        $helpfulCountArray = \App\Models\ReviewsModel::countHelpful($data->reviewId);
                        $starValue = getReviewStarShow($data->ratings);
                        $htmlData .= '<div class="bb_txt_user">
						<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
						<p>' . $starValue . '</p>
						<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
						<div class="bb_date_help">
						<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
						<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
						</div>
						</div>';
                    }
                    $htmlData .= '<div class="clearfix"></div>
					</div>
					</div>
					</body>
					</html>';
                    break;

                case '{WRITE_REVIEW_FORM}':
                    $aData = \App\Models\ReviewsModel::getBrandBoostCampaign($bbID);

                    $htmlData = '<html>
					<head>
					<meta charset="utf-8">
					<title>Brandboost Email Template</title>
					<style>
					@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
					@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
					body{margin: 0;}
					.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
					.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
					.bb_txt_review .clearfix{clear: both;}
					.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
					.bb_txt_head img{width: 120px; height: auto;}
					.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
					.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
					.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
					.bb_txt_review p.green{font-size: 18px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 20px; font-weight:bold;}
					.product_details_sec{margin-bottom: 15px;}
					.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
					.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
					.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
					.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
					.bb_slides_text p .fa.green{ color: #3b9200;}
					.fa.red{ color: red!important;}
					.bb_slides_text p span{font-style: italic;}
					.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
					.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
					.bb_txt_write{padding: 15px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 3px; margin: 15px 0;}
					.bb_txt_write input[type=text], .bb_txt_write textarea, .bb_txt_write select{border: 1px solid #ddd; height: 30px; display: block;width: 100%; margin-bottom: 15px; box-sizing: border-box; font-family: "Open Sans", sans-serif;background: #fff; border-radius: 3px;}
					.bb_txt_write textarea{ height: 85px;  padding: 15px; }
					.bb_txt_write input[type=submit]{background: #3b9200; color: #3b9200; height: 30px; width: 100px; border: none; color: #fff; float: right; border-radius: 3px;}
					.bb_write_review{display: inline-block; width: 150px; text-align: center; height: 30px; color: #fff; background: #3b9200; line-height: 30px; margin: 0 0 20px; text-decoration: none; text-transform: uppercase; border-radius: 3px;}";
					</style>
					</head>
					<body>
					<div class="bb_txt_review">
					<div class="bb_txt_inner">
					<div class="bb_txt_head">
					<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData->logo_img . '"/>
					</div>
					<div class="product_details_sec">
					<div class="bb_product_img">
					<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData->brand_img . '"/>
					</div>
					<div class="bb_slides_text">
					<h4>' . $aData->brand_title . '</h4>
					<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
					<p><span>' . $aData->brand_desc . '</span></p>
					<p><a class="green">' . $aData->firstname . ' ' . $aData->lastname . '</a></p>
					</div>
					<div class="clearfix"></div>
					</div><div class="bb_txt_write">
					<form name="writeReview" id="writeReview" method="POST" action="' . base_url("/reviews/saveReviewByEmailTemplate") . '">
					<p class="green">WRITE A REVIEW</p>
					<p>Score:</p>
					<select name="ratingValue" id="ratingValue" required>
					<option value="">Select Star Ratings</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					</select>
					<p>Name:</p>
					<input type="text" value="" name="fullname" required>
					<p>Email:</p>
					<input type="text" value="" name="email" required >
					<p>Review: </p>
					<textarea name="content" id="content" required></textarea>
					<input type="hidden" value="text" name="type" >
					<input type="hidden" value="' . $aData->id . '" name="campaign_id" >
					<input type="submit" value="POST" name="post"/>
					</form>
					<div class="clearfix"></div>
					</div><div class="clearfix"></div>
					</div>
					</div>
					</body>
					</html>';
                    break;

                case '{TEXT_REVIEW_URL}':
                    if ($bbType == 'offsite') {
                        foreach ($aOffsiteUrls AS $index => $aUrl) {
                            $aWebsiteInfo = \App\Models\Admin\BrandboostModel::getOffsiteWebsite($index);
                            if ($campaignType == 'sms') {
                                $htmlData .= "<a href='" . $aUrl['shorturl'] . "'>" . $aWebsiteInfo->name . "</a><br>";
                            } else {
                                $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                            }
                        }
                    } else {
                        $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                    }

                    break;

                case '{VIDEO_REVIEW_URL}':

                    if ($bbType == 'offsite') {
                        foreach ($aOffsiteUrls AS $index => $aUrl) {
                            $aWebsiteInfo = \App\Models\Admin\BrandboostModel::getOffsiteWebsite($index);
                            if ($campaignType == 'sms') {
                                $htmlData .= "<a href='" . $aUrl['shorturl'] . "'>" . $aWebsiteInfo->name . "</a><br>";
                            } else {
                                $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                            }
                        }
                    } else {
                        $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                    }
                    break;
                case '{REVIEW_URL}':
                    if ($bbType == 'offsite') {
                        foreach ($aOffsiteUrls AS $index => $aUrl) {
                            $aWebsiteInfo = \App\Models\Admin\BrandboostModel::getOffsiteWebsite($index);
                            if ($campaignType == 'sms') {
                                $htmlData .= "<a href='" . $aUrl['shorturl'] . "'>" . $aWebsiteInfo->name . "</a><br>";
                            } else {
                                $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                            }
                        }
                    } else {
                        $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                    }

                    break;
                case '{UNSUBSCRIBE_LINK}':
                    $htmlData = "<a href='" . base_url() . "admin/brandboost/unsubscribeUser/" . $bbID . "/" . $subscriberInfo->id . "'>Click Here</a> to unsubscribe.";

                    break;
            }
            $sHtml = str_replace($sTag, $htmlData, $sHtml);
        }
    }
    return $sHtml;
    exit;
}



    function search_in_array($srchvalue, $array) {

    foreach ($array as $key => $value)
     {
         
        if($value->tag_name == $srchvalue )
        {
           return true;
        }


    }
}

function getColorName($colorName) {
    if ($colorName == 'red') {
        $colorName = '#AB256F';
    }
    if ($colorName == 'yellow') {
        $colorName = '#F9A34A';
    }
    if ($colorName == 'orange') {
        $colorName = '#E2583D';
    }
    if ($colorName == 'green') {
        $colorName = '#368A5D';
    }
    if ($colorName == 'blue') {
        $colorName = '#2A4CBC';
    }
    if ($colorName == 'purple') {
        $colorName = '#33335B';
    }

    return $colorName;
}

?>