<?php

namespace App\Models\Admin\Crons;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewsModel;
use DB;

class BrandboostModel extends Model { 
    

    /**
     * Checks if a review submitted by a subscribers
     * @param type $inviterID
     * @param type $userID
     * @return boolean
     */
    public function checkIfSubmittedReview($inviterID, $userID) {
        $oData = DB::table('tbl_reviews')
                ->where('user_id', $userID)
                ->where('inviter_campaign_id', $inviterID)
                ->exists();
        return $oData;
    }

    /**
     * Gets Inviter events for brandboost module
     * @return type
     */
    public function getInviterEvents() {
        $oData = DB::table('tbl_brandboost_events')
                ->join('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_brandboost_events.brandboost_id')
                ->leftJoin('tbl_users', 'tbl_brandboost.user_id', '=', 'tbl_users.id')
                ->select('tbl_brandboost_events.*', 'tbl_brandboost.user_id AS client_id', 'tbl_users.firstname AS client_first_name', 'tbl_users.lastname AS client_last_name', 'tbl_users.email AS client_email', 'tbl_users.mobile AS client_phone')
                ->where('tbl_brandboost.status', 1)
                ->where('tbl_brandboost_events.status', 1)
                ->get();
        return $oData;
    }

    /**
     * Get the list of subscribers of a brandboost campaign
     * @param type $bbID
     * @return type
     */
    public function getInviteSubscribers($bbID) {
        $oData = DB::table('tbl_brandboost_users')
                ->where('brandboost_id', $bbID)
                ->where('status', 1)
                ->get();
        return $oData;
    }

    /**
     * Get Trigger subscribers
     * @param type $inviterID
     * @return type
     */
    public function getTriggeredSubscribers($inviterID) {
        $response = array();
        $oData = DB::table('tbl_brandboost_trigger')
                ->select('subscriber_id')
                ->where('inviter_id', $inviterID)
                ->get();
        if ($oData->count() > 0) {
            foreach ($oData as $oSubs) {
                $response[] = $oSubs->subscriber_id;
            }
        }
        return $response;
    }

    /**
     * Used to get eligible subscribers for selected campaign
     * @param type $bbID
     * @return type
     */
    public function getInviterEligibleSubscribers($bbID) {
        $sql = "SELECT tbl_brandboost_campaign_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone FROM tbl_brandboost_campaign_users "
                . "LEFT JOIN tbl_subscribers ON tbl_brandboost_campaign_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_brandboost_campaign_users.brandboost_id='$bbID' "
                . "AND tbl_brandboost_campaign_users.status = '1' "
                . "AND tbl_subscribers.status = '1' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) "
                . "GROUP BY tbl_subscribers.email ORDER BY tbl_brandboost_campaign_users.id ASC";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get eligible list of subscribers for selected followup campaign
     * @param type $currentInviterID
     * @param type $previousID
     * @return type
     */
    public function getInviterFollowupSubscribers($currentInviterID, $previousID) {
        $sql = "SELECT tbl_brandboost_campaign_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_subscribers.user_id AS bb_user_id, "
                . "tbl_brandboost_trigger.inviter_id, tbl_brandboost_trigger.subscriber_id, tbl_brandboost_trigger.preceded_by, tbl_brandboost_trigger.start_at "
                . "FROM tbl_brandboost_events "
                . "LEFT JOIN tbl_brandboost_trigger ON tbl_brandboost_events.id = tbl_brandboost_trigger.inviter_id "
                . "LEFT JOIN tbl_brandboost_campaign_users ON tbl_brandboost_trigger.subscriber_id=tbl_brandboost_campaign_users.id "
                . "LEFT JOIN tbl_subscribers ON tbl_brandboost_campaign_users.subscriber_id=tbl_subscribers.id "
                . "WHERE tbl_brandboost_trigger.inviter_id='{$previousID}' AND tbl_brandboost_campaign_users.status = '1' AND tbl_subscribers.status = '1' "
                . "AND tbl_brandboost_trigger.subscriber_id NOT IN(SELECT subscriber_id FROM tbl_brandboost_trigger "
                . "WHERE inviter_id='{$currentInviterID}')";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get eligible list of subscribers for Reminder campaign
     * @param type $bbID
     * @param type $inviterID
     * @param type $previousInviterID
     * @return type
     */
    public function getReminderEligibleSubscribers($bbID, $inviterID, $previousInviterID) {
        $sql = "SELECT tbl_brandboost_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_subscribers.user_id AS bb_user_id, tbl_brandboost_trigger.inviter_id, tbl_brandboost_trigger.start_at, tbl_brandboost_trigger.created_at "
                . "FROM tbl_brandboost_trigger "
                . "LEFT JOIN tbl_brandboost_events ON tbl_brandboost_trigger.inviter_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_brandboost_users.id = tbl_brandboost_trigger.subscriber_id "
                . "LEFT JOIN tbl_subscribers ON tbl_brandboost_users.subscriber_id=tbl_subscribers.id "
                . "WHERE  tbl_brandboost_events.brandboost_id = '{$bbID}' "
                . "AND tbl_brandboost_trigger.inviter_id = '{$previousInviterID}' "
                . "AND tbl_brandboost_users.status='1' "
                . "AND tbl_subscribers.status='1' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list)";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get thank you eligible subscribers
     * @param type $bbID
     * @param type $inviterID
     * @return type
     */
    public function getThankYouEligibleSubscribers($bbID, $inviterID) {
        $sql = "SELECT tbl_brandboost_users.*, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_reviews.created AS review_date "
                . "FROM tbl_reviews "
                . "INNER JOIN tbl_brandboost_users ON tbl_reviews.user_id = tbl_brandboost_users.user_id "
                . "LEFT JOIN tbl_subscribers ON tbl_brandboost_users.subscriber_id=tbl_subscribers.id "
                . "WHERE  tbl_reviews.campaign_id = '{$bbID}'";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to check if a review is given by a subscriber for a specific campaign
     * @param type $bbID
     * @param type $userID
     * @return boolean
     */
    public function checkIfReviewGiven($bbID, $userID = '') {
        $oData = DB::table('tbl_reviews')
                ->where('campaign_id', $bbID)
                ->where('user_id', $userID)
                ->exists();
        return $oData;
    }

    /**
     * 
     * @param type $bbID
     * @param type $subsID
     * @return boolean
     */
    public function checkIfFeedbackGiven($bbID, $subsID) {
        $oData = DB::table('tbl_brandboost_feedback')
                ->where('brandboost_id', $bbID)
                ->where('subscriber_id', $subsID)
                ->exists();
        return $oData;
    }

    /**
     * Checks if email/sms sent to a subscriber
     * @param type $inviterID
     * @param type $subscriberID
     * @return type
     */
    public function checkIfSent($inviterID, $subscriberID) {
        $oData = DB::table('tbl_brandboost_trigger')
                ->where('inviter_id', $inviterID)
                ->where('subscriber_id', $subscriberID)
                ->exists();
        return $oData;
    }

    /**
     * Used to get Automation campaign
     * @param type $inviterID
     * @return type
     */
    public function getAutomationCampaign($inviterID) {
        $sql = "SELECT * FROM tbl_campaigns WHERE event_id='$inviterID' AND (status ='active' OR status='1')";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to save email lists in the queue if enabled
     * @param type $aData
     * @return type
     */
    public function saveInviterQueue($aData) {
        $insertID = DB::table('tbl_inviter_queue')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to save trigger data of a broadcast campaign
     * @param type $aData
     * @return type
     */
    public function saveTriggerData($aData) {
        $insertID = DB::table('tbl_brandboost_trigger')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to save sending logs
     * @param type $aData
     * @return type
     */
    public function saveSendingLog($aData) {
        $insertID = DB::table('tbl_tracking_log_email_sms')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to save sms tracking log
     * @param type $aData
     * @return type
     */
    public function saveSMSTrackLog($aData) {
        $insertID = DB::table('tbl_track_twillio')->insertGetId($aData);
        return $insertID;
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
     * 
     * @param type $id
     * @return type
     */
    public function getCreditValues($id = '') {
        $oData = DB::table('tbl_credit_values')
                ->when(($id > 0), function($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->get();
        return $oData;
    }

    /**
     * Used to update user credits(Not in use)
     * @param type $aData
     * @return boolean
     */
    public function updateUsage($aData = array()) {
        if (!empty($aData['client_id'])) {
            $aCurrentUsage = $this->getCurrentUsage($aData['client_id']);
            if (!empty($aCurrentUsage)) {
                $aEmailBalance = $aCurrentUsage->email_balance;
                $aEmailTopupBalance = $aCurrentUsage->email_balance_topup;

                $aSmsBalanace = $aCurrentUsage->sms_balance;
                $aSmsTopupBalance = $aCurrentUsage->sms_balance_topup;

                if ($aData['usage_type'] == 'email') {
                    if ($aEmailBalance < 1 && $aEmailTopupBalance < 1) {
                        return false;
                    }

                    if ($aEmailBalance > 0) {
                        $sFieldName = '`email_balance`';
                    } else if ($aEmailTopupBalance > 0) {
                        $sFieldName = '`email_balance_topup`';
                    }

                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} -1 WHERE user_id='" . $aData['client_id'] . "'";
                } else if ($aData['usage_type'] == 'sms') {
                    if ($aSmsBalanace < 1 && $aSmsTopupBalance < 1) {
                        return false;
                    }

                    if ($aSmsBalanace > 0) {
                        $sFieldName = '`sms_balance`';
                    } else if ($aSmsTopupBalance > 0) {
                        $sFieldName = '`sms_balance_topup`';
                    }
                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} -1 WHERE user_id='" . $aData['client_id'] . "'";
                }
                $result = $this->db->query($sql);
                if ($result)
                    return true;
                else
                    return false;
            }
            return false;
        }
        return false;
    }

    /**
     * Used to get current usage of client
     * @param type $clientID
     * @return type
     */
    public function getCurrentUsage($clientID) {
        $oData = DB::table('tbl_account_usage')
                ->where('user_id', $clientID)
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
     * Used to get brandboost campaign details
     * @param type $bbID
     * @return type
     */
    public function getBBInfo($bbID) {
        $oData = DB::table('tbl_brandboost')
                ->where('id', $bbID)
                ->first();
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
     * Used to get products related details associated with the brandboost campaign
     * @param type $brandboostID
     * @return type
     */
    public function getProductDataByBBID($brandboostID) {
        $oData = DB::table('tbl_brandboost_products')
                ->where('brandboost_id', $brandboostID)
                ->orderBy('product_order', 'asc')
                ->get();
        return $oData;
    }

    public function emailTagReplace($bbID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        $mmReviews = new ReviewsModel();
        $aTags = config('bbconfig.email_tags');
        $aBrandboost = $this->getBBInfo($bbID);
        $productsDetails = $this->getProductDataByBBID($bbID);
        if (!empty($aBrandboost)) {
            $bbType = $aBrandboost->review_type;
            $aOffsiteUrls = unserialize($aBrandboost->offsites_links);
            $random_keys = 0;
            if (is_array($aOffsiteUrls)) {
                $random_keys = array_rand($aOffsiteUrls, 1);
            }
            $offsiteURL = $aOffsiteUrls[$random_keys];
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
                        $htmlData = $aBrandboost->brand_title;
                        break;

                    case '{PRODUCTS_LIST}':
                        $htmlData = view('admin.workflow2.partials.products_list', ['productsDetails' => $productsDetails])->render();
                        break;

                    case '{BRAND_LOGO}':
                        if (!empty($aBrandboost->logo_img)) {
                            $htmlData = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aBrandboost->logo_img;
                        } else {
                            $htmlData = base_url() . 'assets/images/emailer/emailer-3-walker.png';
                        }

                        break;


                    case '{ONSITE_REVIEW_URL}':
                        $htmlData = base_url() . "reviews/addnew";
                        break;

                    case '{OFFSITE_REVIEW_URL}':
                        $htmlData = $offsiteURL['shorturl'];
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
                        $aData = $mmReviews->getCampReviewsWithFiveRatings($bbID);
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
                            $helpfulCountArray = $mmReviews->countHelpful($data->reviewId);
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
                        $aData = $mmReviews->getCampReviewsWithFourRatings($bbID);
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
                            $helpfulCountArray = $mmReviews->countHelpful($data->reviewId);
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
                        $aData = $mmReviews->getCampReviewsWithTopRatings($bbID);
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
                            $helpfulCountArray = $mmReviews->countHelpful($data->reviewId);
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
                        $aData = $mmReviews->getBrandBoostCampaign($bbID);

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
                        $htmlData = "<a href='" . base_url() . "admin/brandboost/unsubscribeUser/" . $bbID . "/" . $subscriberInfo->id . "'>Click Here</a> to unsubscribe.";

                        break;
                }
                $sHtml = str_replace($sTag, $htmlData, $sHtml);
            }
        }
        return $sHtml;
    }

    /**
     * Checks if a campaign sent or not
     * @param type $campaignID
     * @param type $subscriberID
     * @param type $fieldName
     * @param type $fieldValue
     * @return type
     */
    public function checkIfCampaignSent($campaignID, $subscriberID, $fieldName = '', $fieldValue = '') {
        $oData = DB::table('tbl_tracking_log_email_sms')
                ->where('campaign_id', $campaignID)
                ->when((!empty($fieldName) && !empty($fieldValue)), function ($query) use ($fieldName, $fieldValue) {
                    return $query->where($fieldName, $fieldValue);
                }, function ($query) use ($subscriberID) {
                    return $query->where('subscriber_id', $subscriberID);
                })
                ->exists();
        return $oData;
    }

}
