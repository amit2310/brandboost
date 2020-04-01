<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewsModel;
use DB;

class ManualRequestModel extends Model
{
    /**
     * This function used to get manual request details from various modules
     * @param $requestId
     * @param $moduleName
     * @return bool
     */
    public function getRequestInfo($requestId, $moduleName){
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_brandboost_request';
                break;
        }
        if(!empty($tableName)){
            $aData = DB::table($tableName)
                ->where('id', $requestId)
                ->first();
            return $aData;
        }
        return false;
    }

    /**
     * Used to get eligible subscribers for selected manual request
     * @param type $bbID
     * @return type
     */
    public function getEligibleSubscribers($requestId, $moduleName) {
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_brandboost_campaign_users';
                break;
        }
        if(!empty($tableName)){
            $sql = "SELECT {$tableName}.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone FROM {$tableName} "
                . "LEFT JOIN tbl_subscribers ON {$tableName}.subscriber_id=tbl_subscribers.id "
                . "WHERE {$tableName}.request_id='$requestId' "
                . "AND {$tableName}.status = '1' "
                . "AND tbl_subscribers.status = '1' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) "
                . "GROUP BY tbl_subscribers.email ORDER BY {$tableName}.id ASC";
            $oData = DB::select(DB::raw($sql));
            return $oData;
        }
        return false;
    }

    /**
     * Used to save Trigger Data
     * @param $aData
     * @param $moduleName
     */
    public function saveTriggerData($aData, $moduleName){
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_brandboost_trigger';
                break;
        }
        if(!empty($tableName)){
            $insertID = DB::table($tableName)->insertGetId($aData);
            return $insertID;
        }
        return false;
    }

    /**
     * Used to save sending log tracking data
     * @param $aData
     * @param $moduleName
     */
    public function saveSendingLog($aData, $moduleName){
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_tracking_log_email_sms';
                break;
        }
        if(!empty($tableName)){
            $insertID = DB::table($tableName)->insertGetId($aData);
            return $insertID;
        }
        return false;
    }

    /**
     * This function used to get main module table
     * @param $id
     * @param $moduleName
     * @return bool
     */
    public function getModuleUnitInfo($id, $moduleName){
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_brandboost';
                break;
        }
        if(!empty($tableName)){
            $aData = DB::table($tableName)
                ->where('id', $id)
                ->first();
            return $aData;
        }
        return false;
    }

    /**
     * This function used to get all queued pending request for cron processing
     * @param $moduleName
     * @return bool
     */
    public function getQueueRequest($moduleName){
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_brandboost_request_queue';
                break;
        }
        if(!empty($tableName)){
            $aData = DB::table($tableName)
                ->where('status', 1)
                ->get();
            return $aData;
        }
        return false;
    }

    /**
     * This function is used to update sthe satatus of queue request
     * @param $aData
     * @param $id
     * @param $moduleName
     * @return bool
     */
    public function updateQueueStatus($aData, $id, $moduleName){
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_brandboost_request_queue';
                break;
        }
        if(!empty($tableName)){
            $aData = DB::table($tableName)
                ->where('id', $id)
                ->update($aData);
            return true;
        }
        return false;
    }

    /**
     * This function is used to update the status of manual request
     * @param $aData
     * @param $id
     * @param $moduleName
     * @return bool
     */
    public function updateRequestStatus($aData, $id, $moduleName){
        switch ($moduleName){
            case "brandboost":
                $tableName = 'tbl_brandboost_request';
                break;
        }
        if(!empty($tableName)){
            $aData = DB::table($tableName)
                ->where('id', $id)
                ->update($aData);
            return true;
        }
        return false;
    }

    /**
     * Used to get products related details associated with the brandboost campaign
     * @param type $brandboostID
     * @return type
     */
    public function getProductInfo($brandboostID) {
        $oData = DB::table('tbl_brandboost_products')
            ->where('brandboost_id', $brandboostID)
            ->orderBy('product_order', 'asc')
            ->get();
        return $oData;
    }

    /**
     * Gets the list of offsite sources website
     * @param type $id
     * @return type
     */
    public function getOffsiteWebsite($id) {
        $oData = DB::table('tbl_offsite_websites')
            ->where('id', $id)
            ->first();
        return $oData;
    }

    /**
     * Used to get sendgrid account related information of a client
     * @param type $clientID
     * @return type
     */
    public function getSendgridAccount($clientID) {
        $oData = DB::table('tbl_sendgrid_accounts')
            ->where('user_id', $clientID)
            ->where('status', 1)
            ->first();
        return $oData;
    }

    /**
     * Used to get Twilio Account related information
     * @param type $clientID
     * @return type
     */
    public function getTwilioAccount($clientID) {
        $oData = DB::table('tbl_twilio_accounts')
            ->where('user_id', $clientID)
            ->where('status', 1)
            ->first();
        return $oData;
    }

    /**
     *
     * @param type $aData
     * @return type
     */
    public function saveShortURL($aData) {
        $insertID = DB::table('tbl_sms_short_url')->insertGetId($aData);
        return $insertID;
    }

    /**
     * This function used to parse template variables
     * @param $sHtml
     * @param string $campaignType
     * @param $subscriberInfo
     * @param $moduleUnitInfo
     * @param $moduleName
     * @return string|string[]
     */
    public function emailTagReplace($sHtml, $campaignType = 'email', $subscriberInfo, $moduleUnitInfo, $moduleName) {
        $mReviews = new ReviewsModel();
        $aTags = config('bbconfig.email_tags');
        $moduleUnitId = $moduleUnitInfo->id;
        if($moduleName == 'brandboost'){
            $bbType = $moduleUnitInfo->review_type;
            if($bbType == 'offsite'){
                $aOffsiteUrls = unserialize($moduleUnitInfo->offsites_links);
                $random_keys = 0;
                if (is_array($aOffsiteUrls)) {
                    $random_keys = array_rand($aOffsiteUrls, 1);
                }
                $offsiteURL = $aOffsiteUrls[$random_keys];
            }
        }
        if (!empty($aTags)) {
            foreach ($aTags AS $sTag) {
                $htmlData = '';
                switch ($sTag) {
                    case '{FIRST_NAME}':
                        $htmlData = $subscriberInfo->firstname;
                        break;

                    case '{LAST_NAME}':
                        $htmlData = $subscriberInfo->lastname;
                        break;

                    case '{EMAIL}':
                        $htmlData = $subscriberInfo->email;
                        break;

                    case '{PHONE}':
                        $htmlData = ($subscriberInfo->phone) ? $subscriberInfo->phone : $subscriberInfo->mobile;
                        break;

                    case '{BRAND_NAME}':
                        $htmlData = $moduleUnitInfo->brand_title;
                        break;

                    case '{PRODUCTS_LIST}':
                        /*$productsDetails = $this->getProductInfo($moduleUnitId);
                        $htmlData = view('admin.workflow2.partials.products_list', ['productsDetails' => $productsDetails])->render();*/
                        break;

                    case '{BRAND_LOGO}':
                        if (!empty($moduleUnitInfo->logo_img)) {
                            $htmlData = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $moduleUnitInfo->logo_img;
                        } else {
                            $htmlData = base_url() . 'assets/images/emailer/emailer-3-walker.png';
                        }

                        break;


                    case '{ONSITE_REVIEW_URL}':
                        $htmlData = base_url() . "reviews/addnew";
                        break;

                    case '{OFFSITE_REVIEW_URL}':
                        $htmlData = !empty($offsiteURL) ? $offsiteURL['shorturl'] : '';
                        break;

                    case '{TEXT_REVIEW_URL}':
                    case '{REVIEW_URL}':
                        if ($bbType == 'offsite') {
                            if (!empty($aOffsiteUrls)) {
                                foreach ($aOffsiteUrls AS $index => $aUrl) {
                                    $aWebsiteInfo = $this->getOffsiteWebsite($index);
                                    if ($campaignType == 'sms') {
                                        $htmlData .= "<a href='" . $aUrl['shorturl'] . "'>" . $aWebsiteInfo->name . "</a><br>";
                                    } else {
                                        $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                                    }
                                }
                            } else {
                                $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                            }
                        } else {
                            $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                        }

                        break;

                    case '{VIDEO_REVIEW_URL}':

                        if ($bbType == 'offsite') {
                            if (!empty($aOffsiteUrls)) {
                                foreach ($aOffsiteUrls AS $index => $aUrl) {
                                    $aWebsiteInfo = $this->getOffsiteWebsite($index);
                                    if ($campaignType == 'sms') {
                                        $htmlData .= "<a href='" . $aUrl['shorturl'] . "'>" . $aWebsiteInfo->name . "</a><br>";
                                    } else {
                                        $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                                    }
                                }
                            } else {
                                $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                            }
                        } else {
                            $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                        }
                        break;
                    case '{FIVE_STARS_RATINGS}':
                        $aData = $mReviews->getCampReviewsWithFiveRatings($moduleUnitId);
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
                            $helpfulCountArray = $mReviews->countHelpful($data->reviewId);
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
                        $aData = $mReviews->getCampReviewsWithFourRatings($moduleUnitId);
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
                            $helpfulCountArray = $mReviews->countHelpful($data->reviewId);
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
                        $aData = $mReviews->getCampReviewsWithTopRatings($moduleUnitId);
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
                            $helpfulCountArray = $mReviews->countHelpful($data->reviewId);
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
                        $aData = $mReviews->getBrandBoostCampaign($moduleUnitId);

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
                    case '{UNSUBSCRIBE_LINK}':
                        $htmlData = "<a href='" . base_url() . "admin/brandboost/unsubscribeUser/" . $moduleUnitId . "/" . $subscriberInfo->id . "'>Click Here</a> to unsubscribe.";

                        break;
                }
                $sHtml = str_replace($sTag, $htmlData, $sHtml);
            }
        }
        return $sHtml;
    }

}
