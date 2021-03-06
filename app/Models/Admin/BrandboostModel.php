<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;
use Carbon;
class BrandboostModel extends Model {

    /**
     * This function used to get Brandboost campaign details
     * @param type $userId
     * @param type $type
     * @return type
     */
    public static function getBrandboostByUserId($userId, $type = '', $campaignType='', $searchBy='', $sortBy='', $items_per_page=10, $paginate=true)
    {
        $query = DB::table('tbl_brandboost')
            ->when(($userId > 0), function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when((!empty($type)), function ($query) use ($type) {
                return $query->where('review_type', $type);
            })
            ->where('delete_status', 0);
        if(!empty($campaignType)){
            $query->where('campaign_type', $campaignType);
        }
        if (!empty($searchBy)) {
            $query->where('brand_title', 'LIKE', "%$searchBy%");
            //$query->orWhere('brand_desc', 'LIKE',  "%$searchBy%");
        }
        if (!empty($sortBy)) {
            if ($sortBy == 'Date Created') {
                $query->orderBy('id', 'desc');
            } else if ($sortBy == 'Name') {
                $query->orderBy('brand_title', 'asc');
            } else if ($sortBy == 'Active') {
                $query->where('status', '1');
            } else if ($sortBy == 'Inactive') {
                $query->where('status', '0');
            } else if ($sortBy == 'Pending') {
                $query->where('status', '2');
            } else if ($sortBy == 'Archive') {
                $query->where('status', '3');
            }
        } else {
            $query->orderBy('id', 'desc');
        }
        //->get();
        if ($paginate == true) {
            if ($items_per_page == 'All') {
                $oData = $query->get();
            } else {
                $oData = $query->paginate($items_per_page);
            }
        }else{
            $oData = $query->get();
        }
        return $oData;
    }

    /**
     * This method used to get review campaigns
     * @param $userId
     * @param string $type
     * @return mixed
     */
    public static function getReviewCampaigns($userId, $type = '') {
            $oData = DB::table('tbl_brandboost')
                    ->when(($userId > 0), function($query) use ($userId) {
                        return $query->where('user_id', $userId);
                    })
                    ->when((!empty($type)), function($query) use ($type) {
                        return $query->where('review_type', $type);
                    })
                    ->where('delete_status', 0)
                    ->orderBy('id', 'desc')
                    ->get();

            return $oData;
        }

    /**
     * function is used to fetch the BB campaign information
     * @param type $campaignID
     * @return type
     */
    public static function getBBInfo($bbID) {
        $oData = DB::table('tbl_brandboost')
                        ->where("id", $bbID)->first();
        return $oData;
    }

    /**
     * Get Member's list of all Brandboost widgets
     * @param type $id
     * @param type $userID
     * @param type $type
     * @return type
     */
    public static function getBBWidgets($id = 0, $userID = 0, $type = '', $searchBy='', $sortBy='',$items_per_page =10) {
        $query = DB::table('tbl_brandboost_widgets')
                ->leftJoin('tbl_brandboost', 'tbl_brandboost_widgets.brandboost_id', '=', 'tbl_brandboost.id')
                ->select('tbl_brandboost_widgets.*', 'tbl_brandboost.hashcode as bbHash', 'tbl_brandboost.brand_title AS bbBrandTitle', 'tbl_brandboost.brand_desc AS bbBrandDesc', 'tbl_brandboost.brand_img AS campaignImg')
                ->when(($id > 0), function ($query) use ($id) {
                    return $query->where('tbl_brandboost_widgets.id', $id);
                })
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_brandboost_widgets.user_id', $userID);
                })
                ->when((!empty($type)), function ($query) use ($type) {
                    return $query->where('tbl_brandboost_widgets.review_type', $type);
                })
                ->where('tbl_brandboost_widgets.delete_status', 0);

        if(!empty($searchBy)){
            $query->where('tbl_brandboost_widgets.widget_title', 'LIKE',  "%$searchBy%");
        }
        if(!empty($sortBy)){
            if($sortBy == 'Date Created'){
                $query->orderBy('tbl_brandboost_widgets.created', 'desc');
            }else  if($sortBy == 'Name'){
                $query->orderBy('tbl_brandboost_widgets.widget_title', 'desc');
            }else  if($sortBy == 'draft'){
                $query->where('tbl_brandboost_widgets.status', '0');
            }else  if($sortBy == 'active'){
                $query->where('tbl_brandboost_widgets.status', '1');
            }else  if($sortBy == 'pending'){
                $query->where('tbl_brandboost_widgets.status', '2');
            }else  if($sortBy == 'archive'){
                $query->where('tbl_brandboost_widgets.status', '3');
            }
        }else{
            $query->orderBy('tbl_brandboost_widgets.id', 'desc');
        }
        if($items_per_page =='All'){
            $oData = $query->get();
        }else{
            $oData = $query->paginate($items_per_page);
        }
        return $oData;
    }

    /**
     * Get Onsite/Offsite brandboost stats
     * @param type $userId
     * @param type $bbId
     * @return type
     */
    public function getBBStatsByIdAndUserId($userId, $bbId) {
        $oData = DB::table('tbl_reviews')
			->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
			->leftJoin('tbl_users', 'tbl_users.id', '=', 'tbl_reviews.user_id')
			->select(DB::raw('count(tbl_reviews.id) as totalNo'), 'tbl_reviews.*')
			->where('tbl_brandboost.review_type', 'onsite')
			->when(($userId != ''), function ($query) use ($userId) {
				return $query->where('tbl_brandboost.user_id', $userId);
			})
			->when(($bbId != ''), function ($query) use ($bbId) {
				return $query->where('tbl_reviews.campaign_id', $bbId);
			})
			->groupBy(DB::raw('DATE(tbl_reviews.created)'))
			->orderBy('tbl_reviews.id', 'desc')
			->get();

        return $oData;
    }

    /**
     *
     * @param type $campType
     * @param type $userID
     * @return type
     */
    public function getEmailSms($campType, $userID) {

        $oData = DB::table('tbl_brandboost')
                ->rightJoin('tbl_campaigns', 'tbl_campaigns.event_id', '=', 'tbl_brandboost.id')
                ->select('tbl_campaigns.*', 'tbl_brandboost.user_id')
                ->where('tbl_campaigns.campaign_type', $campType)
                ->where('tbl_brandboost.user_id', $userID)
                ->orderBy('tbl_campaigns.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * get send email tracking data
     * @param type $userId
     * @param type $type
     * @return type
     */
    public static function getBrandboostEmailSend($userId, $type = '') {

        $oData = DB::table('tbl_track_sendgrid')
                ->when(!empty($userId), function ($query) use ($userId) {
                    return $query->where('tbl_brandboost.user_id', $userId);
                })
                ->when(!empty($type), function ($query) use ($type) {
                    return $query->where('tbl_brandboost.review_type', $type);
                })
                ->where('tbl_brandboost.delete_status', 0)
                ->where('tbl_track_sendgrid.event_name', 'delivered')
                ->orderBy('tbl_brandboost.id', 'desc')
                ->join('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_track_sendgrid.brandboost_id')
                ->get();
        return $oData;
    }

    /**
     * get send sms tracking data
     * @param type $userId
     * @param type $type
     * @return type
     */
    public static function getBrandboostSmsSend($userId, $type = '') {
        $oData = DB::table('tbl_track_twillio')
                ->when(!empty($userId), function ($query) use ($userId) {
                    return $query->where('tbl_brandboost.user_id', $userId);
                })
                ->when(!empty($type), function ($query) use ($type) {
                    return $query->where('tbl_brandboost.review_type', $type);
                })
                ->where('tbl_brandboost.delete_status', 0)
                ->where('tbl_track_twillio.event_name', 'delivered')
                ->orderBy('tbl_brandboost.id', 'desc')
                ->join('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_track_twillio.brandboost_id')
                ->get();
        return $oData;
    }

    /**
     * get send email tracking data by month
     * @param type $userId
     * @param type $type
     * @return type
     */
    public static function getBrandboostEmailSendMonth($userId, $type = '') {
        $oData = DB::table('tbl_track_sendgrid')
			->when(!empty($userId), function ($query) use ($userId) {
				return $query->where('tbl_brandboost.user_id', $userId);
			})
			->when(!empty($type), function ($query) use ($type) {
				return $query->where('tbl_brandboost.review_type', $type);
			})
			->where('tbl_brandboost.delete_status', 0)
			->where('tbl_track_sendgrid.event_name', 'delivered')
			->orderBy('tbl_brandboost.id', 'desc')
			->join('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_track_sendgrid.brandboost_id')
			->get();
        return $oData;
    }

    /**
     * This funcion used to get lastest review added by the user
     * @param $brandboostID
     * @param $userId
     */
    public function getUserCampaignReview($brandboostID, $userId){
        if($brandboostID>0 && $userId>0){
            $oData = DB::table('tbl_reviews')
                ->where('campaign_id', $brandboostID)
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->first();
            return $oData;
        }
        return;
    }

    /**
     * get review request data
     * @param type $brandboostId
     * @param type $type
     * @return type
     */
    public static function getReviewRequest($brandboostId = '', $type = '', $reviewType='',  $searchBy='', $sortBy='',$items_per_page =10) {
        // DB::enableQueryLog();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $query = DB::table('tbl_tracking_log_email_sms')
            ->leftJoin('tbl_brandboost_campaign_users', 'tbl_tracking_log_email_sms.subscriber_id', '=', 'tbl_brandboost_campaign_users.id')
            ->leftJoin('tbl_subscribers', 'tbl_brandboost_campaign_users.subscriber_id', '=', 'tbl_subscribers.id')
            ->leftJoin('tbl_users', 'tbl_subscribers.user_id', '=', 'tbl_users.id')
            ->leftJoin('tbl_brandboost', 'tbl_brandboost_campaign_users.brandboost_id', '=', 'tbl_brandboost.id')
            ->select('tbl_users.id AS uid', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_users.avatar', 'tbl_users.country',
                'tbl_brandboost.id AS bbid','tbl_brandboost.review_type', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc', 'tbl_brandboost.brand_img',
                'tbl_brandboost_campaign_users.id as subscriberid','tbl_brandboost_campaign_users.status as subscriberstatus',
                'tbl_tracking_log_email_sms.id as trackinglogid',
                'tbl_tracking_log_email_sms.subscriber_id as tracksubscriberid', 'tbl_tracking_log_email_sms.type as tracksubscribertype',
                'tbl_tracking_log_email_sms.created as requestdate');
            if(!empty($searchBy)){
                $query->where('tbl_subscribers.firstname', 'LIKE',  "%$searchBy%");
                $query->orWhere('tbl_subscribers.lastname', 'LIKE',  "%$searchBy%");
                $query->orWhere('tbl_subscribers.email', 'LIKE',  "%$searchBy%");
                $query->orWhere('tbl_subscribers.phone', 'LIKE',  "%$searchBy%");
                //$query->orWhere('tbl_brandboost.brand_title', 'LIKE',  "%$searchBy%");
            }
            $query->when(($brandboostId > 0), function ($query) use ($brandboostId) {
                return $query->where('tbl_brandboost.id', $brandboostId);
            })
            ->when(($user_role != 1), function ($query) use ($userID) {
                return $query->where('tbl_brandboost.user_id', $userID);
            })
            ->when((!empty($type)), function ($query) use ($type) {
                return $query->where('tbl_tracking_log_email_sms.type', $type);
            })
            ->when((!empty($reviewType)), function ($query) use ($reviewType) {
                return $query->where('tbl_brandboost.review_type', $reviewType);
            });
        $query->where('tbl_subscribers.email', '!=',  '');
        if(!empty($sortBy)){
            if($sortBy == 'archive'){
                $query->where('tbl_tracking_log_email_sms.archived', 1);
            }
            if($sortBy == 'sent'){
                $query->where('tbl_tracking_log_email_sms.status', 'sent');
            }
            if($sortBy == 'draft'){
                $query->where('tbl_tracking_log_email_sms.status', 'draft');
            }
            if($sortBy == 'submited'){
                $query->where('tbl_tracking_log_email_sms.status', 'sent');
            }
            if($sortBy == 'Date Created'){
                $query->orderBy('tbl_tracking_log_email_sms.created', 'desc');
            }
        }else{
            $query->where('tbl_tracking_log_email_sms.archived', 0);
        }
        $query->orderBy('tbl_tracking_log_email_sms.id', 'DESC');
        if($items_per_page =='All'){
            $oData = $query->get();
        }else{
            $oData = $query->paginate($items_per_page);
        }
        // dd(DB::getQueryLog());
        return $oData;
    }

    public static function getReviewRequestOLD2($brandboostId = '', $type = '', $reviewType='') {
        /*Todo: Need to fix this function after the cron script*/
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;

        $query = DB::table('tbl_brandboost_events')
            ->leftJoin('tbl_campaigns', 'tbl_campaigns.event_id', '=', 'tbl_brandboost_events.id')
            ->leftJoin('tbl_tracking_log_email_sms', 'tbl_tracking_log_email_sms.campaign_id', '=', 'tbl_campaigns.id')
            ->leftJoin('tbl_brandboost_campaign_users', 'tbl_brandboost_campaign_users.id', '=', 'tbl_tracking_log_email_sms.subscriber_id')
            ->leftJoin('tbl_subscribers', 'tbl_brandboost_campaign_users.subscriber_id', '=', 'tbl_subscribers.id')
            ->leftJoin('tbl_users', 'tbl_brandboost_campaign_users.user_id', '=', 'tbl_users.id')
            ->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_brandboost_events.brandboost_id')
            ->select('tbl_subscribers.*', 'tbl_brandboost_campaign_users.*', 'tbl_brandboost_campaign_users.id as subscriberid',
                'tbl_brandboost_campaign_users.status as subscriberstatus',
                'tbl_users.id AS uid', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_users.avatar', 'tbl_users.country',
                'tbl_brandboost.review_type', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc', 'tbl_brandboost.brand_img',
                'tbl_brandboost_events.id as beventid', 'tbl_tracking_log_email_sms.id as trackinglogid',
                'tbl_tracking_log_email_sms.subscriber_id as tracksubscriberid', 'tbl_tracking_log_email_sms.type as tracksubscribertype',
                'tbl_tracking_log_email_sms.created as requestdate', 'tbl_campaigns.*')
            ->when(($brandboostId > 0), function ($query) use ($brandboostId) {
                return $query->where('tbl_brandboost_events.brandboost_id', $brandboostId);
            })
            ->when(($user_role != 1), function ($query) use ($userID) {
                return $query->where('tbl_brandboost.user_id', $userID);
            })
            ->when((!empty($type)), function ($query) use ($type) {
                return $query->where('tbl_tracking_log_email_sms.type', $type);
            }, function ($query) {
                //return $query->where('tbl_tracking_log_email_sms.type', 'email')
                //->orWhere('tbl_tracking_log_email_sms.type', 'sms');
            });
        if(!empty($reviewType)){
            $query->where('tbl_brandboost.review_type', $reviewType);
            $query->where('tbl_subscribers.email', '!=',  '');
        }
        //->get();
        $oData = $query->paginate(10);
        return $oData;
    }

    public static function getReviewRequestOLD1($brandboostId = '', $type = '') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;

        $oData = DB::table('tbl_brandboost_events')
			->leftJoin('tbl_campaigns', 'tbl_campaigns.event_id', '=', 'tbl_brandboost_events.id')
			->leftJoin('tbl_tracking_log_email_sms', 'tbl_tracking_log_email_sms.campaign_id', '=', 'tbl_campaigns.id')
			->leftJoin('tbl_brandboost_users', 'tbl_brandboost_users.id', '=', 'tbl_tracking_log_email_sms.subscriber_id')
            ->leftJoin('tbl_users', 'tbl_brandboost_users.user_id', '=', 'tbl_users.id')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=', 'tbl_brandboost_events.brandboost_id')
			->select('tbl_brandboost_users.*', 'tbl_brandboost_users.id as subscriberid',
                'tbl_brandboost_users.status as subscriberstatus',
                 'tbl_users.id AS uid', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.avatar', 'tbl_users.country',
                'tbl_brandboost.review_type', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc', 'tbl_brandboost.brand_img',
                'tbl_brandboost_events.id as beventid', 'tbl_tracking_log_email_sms.id as trackinglogid',
                'tbl_tracking_log_email_sms.subscriber_id as tracksubscriberid', 'tbl_tracking_log_email_sms.type as tracksubscribertype',
                'tbl_tracking_log_email_sms.created as requestdate', 'tbl_campaigns.*')
			->when(($brandboostId > 0), function ($query) use ($brandboostId) {
				return $query->where('tbl_brandboost_events.brandboost_id', $brandboostId);
			})
			->when(($user_role != 1), function ($query) use ($userID) {
				return $query->where('tbl_brandboost.user_id', $userID);
			})
			->when((!empty($type)), function ($query) use ($type) {
				return $query->where('tbl_tracking_log_email_sms.type', $type);
			}, function ($query) {
				//return $query->where('tbl_tracking_log_email_sms.type', 'email')
						//->orWhere('tbl_tracking_log_email_sms.type', 'sms');
			})
			//->get();
            ->paginate(10);

        return $oData;
    }

    /**
     * Used to get review request response
     * @param type $brandboostID
     * @return type
     */
    public static function getReviewRequestResponse($brandboostID) {
        $oData = DB::table('tbl_reviews')
			->select('tbl_brandboost_users.*', 'tbl_reviews.*', 'tbl_reviews.created as reviewdate')
			->where('tbl_reviews.campaign_id', $brandboostID)
			->where('tbl_brandboost_users.brandboost_id', $brandboostID)
			->orderBy('tbl_reviews.id', 'desc')
			->leftJoin('tbl_brandboost_users', 'tbl_brandboost_users.user_id', '=', 'tbl_reviews.user_id')
			->get();
        return $oData;
    }

    /**
     * Used to get onsite campaign products data
     * @param type $brandboostID
     * @return type
     */
    public function getProductData($brandboostID) {
        if (!empty($brandboostID)) {
            $oData = DB::table('tbl_brandboost_products')
				->where('brandboost_id', $brandboostID)
				->orderBy('product_order', 'asc')
				->get();
            return $oData;
        }
    }

    /**
     * Used to get branboost(onsite/offsite) campaign list/details
     * @param type $brandboostID
     * @return type
     */
    public static function getBrandboost($id = 0, $type = '', $campaignType='', $searchBy = '', $sortBy='', $items_per_page=10, $paginate=true) {

        $query = DB::table('tbl_brandboost')
			->when(($id > 0), function ($query) use ($id) {
				return $query->where('id', $id);
			})
			->when((!empty($type)), function ($query) use ($type) {
				return $query->where('review_type', $type);
			})
			->where('delete_status', 0);
        if(!empty($campaignType)){
            $query->where('campaign_type', $campaignType);
        }
        if(!empty($searchBy)){
            $query->where('brand_title', 'LIKE',  "%$searchBy%");
            //$query->orWhere('brand_desc', 'LIKE',  "%$searchBy%");
        }
        if(!empty($sortBy)){
            if($sortBy == 'Date Created'){
                $query->orderBy('created', 'desc');
            }else  if($sortBy == 'Name'){
                $query->orderBy('brand_title', 'desc');
            }else  if($sortBy == 'Active'){
                $query->where('status', '1');
            }else  if($sortBy == 'Inactive'){
                $query->where('status', '0');
            }else  if($sortBy == 'Pending'){
                $query->where('status', '2');
            }else  if($sortBy == 'Archive'){
                $query->where('status', '3');
            }
        }else{
            $query->orderBy('id', 'desc');
        }
        if($paginate == true) {
            if ($items_per_page == 'All') {
                $oData = $query->get();
            } else {
                $oData = $query->paginate($items_per_page);
            }
        }else {
            $oData = $query->get();
        }
        return $oData;
    }

    /**
     * Used to get Review Campaign By id
     * @param type $campaignID
     * @return type
     */
    public function getReviewCampaignBycampID($campaignID) {
        $oData = DB::table('tbl_brandboost')
            ->when(($campaignID > 0), function ($query) use ($campaignID) {
                return $query->where('id', $campaignID);
            })
			->get();

        //print_r($oData); exit;
        if ($oData) {
            $response = $oData;
        }
        return $response;
    }

    /**
     * Used to get onsite brandboost event data
     * @param type $brandboostID
     * @return type
     */
    public static function getBrandboostEvents($brandID) {
        $oData = DB::table('tbl_brandboost_events')
			->where('brandboost_id', $brandID)
			->orderBy('previous_event_id', 'asc')
			->get();
        return $oData;
    }

    /**
     * Used to get user campaign email templates
     * @param type $uersID
     * @param type $bbType
     * @return type
     */
    public static function getAllCampaignTemplatesByUserID($uersID, $bbType = 'onsite') {
        $sql = "SELECT * FROM tbl_campaign_templates WHERE (user_id='" . $uersID . "' OR user_id='0') AND template_type='email' AND brandboost_type='" . $bbType . "' order by id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to get user campaign sms templates
     * @param type $uersID
     * @param type $bbType
     * @return type
     */
    public static function getAllSMSCampaignTemplatesByUserID($uersID, $bbType = 'onsite') {
        $oData = DB::table('tbl_campaign_templates')
			->where('user_id', $uersID)
			->where('template_type', 'sms')
			->where('brandboost_type', $bbType)
			->orderBy('id', 'asc')
			->get();
        return $oData;
    }

    /**
     * Used to get onsite brandboost product data by id
     * @param type $productId
     * @return type
     */
    public static function getProductDataById($productId) {
        if (!empty($productId)) {
            $oData = DB::table('tbl_brandboost_products')
				->where('id', $productId)
				->orderBy('id', 'desc')
				->first();
            return $oData;
        }
    }

    /**
     * Used to get onsite brandboost product data by id
     * @param type $productId
     * @return type
     */
    public static function getBrandboostSmsSendMonth($userId, $type = '') {
        $oData = DB::table('tbl_brandboost')
			->select('tbl_track_twillio.*')
			->when(($userId > 0), function ($query) use ($userId) {
				return $query->where('tbl_brandboost.user_id', $userId);
			})
			->when((!empty($type)), function ($query) use ($type) {
				return $query->where('tbl_brandboost.review_type', $type);
			})
			->where('tbl_track_twillio.event_name', 'delivered')
			->where('tbl_brandboost.delete_status', 0)
			->orderBy('tbl_brandboost.id', 'desc')
			->leftJoin('tbl_track_twillio', 'tbl_brandboost.id', '=', 'tbl_track_twillio.brandboost_id')
			->get();
        return $oData;
    }

    /**
     * Used to get feedback count by brandboost id
     * @param type $brandboostID
     * @return type
     */
    public static function getFeedbackCount($brandboostID) {
        $oData = DB::table('tbl_brandboost_feedback')
			->select(DB::raw('COUNT(id) AS total_count'), 'category')
			->where('brandboost_id', $brandboostID)
			->groupBy('category')
			->get();
        return $oData;
    }

	/**
	* Used to get feedback count by brandboost id
	* @param type $brandboostID
	* @return type
	*/
	public static function updateBrandboost($userID, $aData, $brandboostID) {
		$result = DB::table('tbl_brandboost')
		->where('id', $brandboostID)
		->update($aData);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get all offsite reviews
     * @param type $param
     * @return type
     */
    public static function getAllOffsiteReviews() {
        $oData = DB::table('tbl_reviews_offsite')
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Used to get all offsite reviews
     * @param type $param
     * @return type
     */
    public static function getBBWidgetStats($fieldVal, $filedName = 'widget_id', $type = '',$req='all') {
        DB::enableQueryLog();
          $startDate=Carbon\Carbon::now()->subDays(1)->endOfDay();
          $endDate  =Carbon\Carbon::now()->endOfDay();
        switch ($req){
            case 'all':
                $startDate =Carbon\Carbon::now()->startOfDay();
                break;
            case 'today':
                $startDate =Carbon\Carbon::now()->startOfDay();
                break;
            case 'yest':
                $startDate =Carbon\Carbon::now()->subDays(1)->startOfDay();
                break;
            case 'week':
                $startDate =Carbon\Carbon::now()->startOfWeek();
                break;
            case 'month':
                $startDate =Carbon\Carbon::now()->startOfMonth();
                break;
            case '3month':
                $startDate =Carbon\Carbon::now()->subMonth(3)->endOfDay();
                break;

        }
        $oData = DB::table('tbl_brandboost_widget_tracking_log')
			->select('tbl_brandboost_widget_tracking_log.*', 'tbl_brandboost.brand_title as bbBrandTitle', 'tbl_brandboost.brand_desc as bbBrandDesc', 'tbl_brandboost.brand_img', 'tbl_brandboost_widgets.widget_title', 'tbl_brandboost_widgets.widget_img', 'tbl_brandboost_widgets.widget_desc')
			->when(($filedName == 'widget_id'), function ($query) use ($fieldVal) {
				return $query->where('widget_id', $fieldVal);
			})
			->when(($filedName == 'owner_id'), function ($query) use ($fieldVal) {
				return $query->where('owner_id', $fieldVal);
			})
			->when(($filedName == 'widget_type'), function ($query) use ($fieldVal) {
				return $query->where('widget_type', $fieldVal);
			})
			->when(($filedName == 'brandboost_id'), function ($query) use ($fieldVal) {
				return $query->where('brandboost_id', $fieldVal);
			})
			->when(($type != ''), function ($query) use ($type) {
				return $query->where('track_type', $type);
			})
            ->when(($req != 'all'), function ($query) use ($startDate,$endDate) {
                return $query->whereBetween('created_at', [$startDate,$endDate]);



            })
			->leftJoin('tbl_brandboost', 'tbl_brandboost_widget_tracking_log.brandboost_id', '=', 'tbl_brandboost.id')
			->leftJoin('tbl_brandboost_widgets', 'tbl_brandboost_widget_tracking_log.widget_id', '=', 'tbl_brandboost_widgets.id')
//			->get();
            ->paginate(10);
        //dd(DB::getQueryLog());
        return $oData;
    }

    /**
     * Used to add brandboost feedback response
     * @param type $param
     * @return type
     */
    public static function addBrandboostFeedbackResponse($aData) {
        $insert_id = DB::table('tbl_feedback_response')->insertGetId($aData);
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }

    /**
     * Used to delete review request by request id
     * @param type $recordId
     * @return type
     */
    public static function deleteReviewRequest($recordId) {
        $result = DB::table('tbl_tracking_log_email_sms')
                ->where('id', $recordId)
                ->delete();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to archive review request
     * @param $recordId
     * @return bool
     */
    public static function archiveReviewRequest($recordId) {
        $result = DB::table('tbl_tracking_log_email_sms')
                ->where('id', $recordId)
                ->update(['archived'=>1]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function used to archive/delete one or more widgets
     * @param $recordId
     * @return bool
     */
    public static function deleteWidgets($recordId, $actionName='') {
        $query = DB::table('tbl_brandboost_widgets')
                ->where('id', $recordId);
        if(!empty($actionName)){
            if($actionName == 'delete'){
                $result = $query->update(['delete_status'=>1]);
            }else if($actionName == 'archive'){
                $result = $query->update(['status'=>3]);
            }
        }else{
            $result = $query->update(['status'=>3]);
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Used to update brandboost feedback response by brandboostID
     * @param type $brandboostID
     * @return type
     */
    public static function updateBrandboostFeedbackResponse($aData, $brandboostID) {
        $result = DB::table('tbl_feedback_response')
                ->where('brandboost_id', $brandboostID)
                ->update($aData);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function used to update feedback related info into the end campaigns
     * @param $aData
     * @param $brandboostID
     * @return bool
     */
    public static function updateBrandboostEndCampaigns($aData, $brandboostID) {
        if(!empty($aData)){
            //This array will have only one element
            foreach($aData as $key => $val){
                $fieldName = $key;
                $fieldValue = $val;
            }
            $query = "UPDATE `tbl_campaigns` SET {$fieldName} = '{$fieldValue}' WHERE `event_id` IN(SELECT id FROM `tbl_brandboost_events` WHERE brandboost_id='$brandboostID')";
            //echo $query;
            $result = DB::statement($query);
        }
        return true;
    }


    /**
     * Used to update brandboost feedback response by brandboostID
     * @param type $brandboostID
     * @return type
     */
    public static function getWidgetThemeByUserID($userID = '') {
        $oData = DB::table('tbl_brandboost_widget_theme_settings')
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('user_id', $userID)
                        ->orWhere('user_id', 1);
                })
                ->where('status', 1)
                ->orderBy('id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * Used to update onsite widget by brandboostID
     * @param type $userID
     * @param type $brandboostID
     * @return type
     */
    public static function updateWidget($userID, $aData, $brandboostID) {
        $result = DB::table('tbl_brandboost_widgets')
                ->where('id', $brandboostID)
                ->update($aData);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to add onsite widget
     * @return type
     */
    public static function addWidget($aData) {
        $insert_id = DB::table('tbl_brandboost_widgets')->insertGetId($aData);

        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }

    /**
     * Used to add onsite campaign
     * @return type
     */
    public static function add($aData) {
        $insert_id = DB::table('tbl_brandboost')->insertGetId($aData);
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }

    /**
     * Used to delete onsite campaign by campaign id
     * @param type $id
     * @return type
     */
    public static function deleteBrandboost($id) {
        $result = DB::table('tbl_brandboost')
                ->where('id', $id)
                ->delete();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get campaign product by campaign id
     * @param type $brandboostID
     * @param type $type
     * @return type
     */
    public function getProductDataByType($brandboostID, $type = 'product') {
        if (!empty($brandboostID)) {
            $oData = DB::table('tbl_brandboost_products')
				->where('brandboost_id', $brandboostID)
				->where('product_type', $type)
				->orderBy('product_order', 'asc')
				->get();
            return $oData;
        }
    }

    /**
     * Used to delete campaign product by campaign id
     * @param type $bbId
     * @param type $dataOrder
     * @return type
     */
    public static function deleteProduct($bbId, $dataOrder) {
        $result = DB::table('tbl_brandboost_products')
                ->where('brandboost_id', $bbId)
                ->where('product_order', $dataOrder)
                ->delete();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get campaign product by campaign id and order
     * @param type $brandboostID
     * @param type $order
     * @return type
     */
    public static function getProductDataByOrder($brandboostID, $order) {
        if (!empty($brandboostID)) {
            $oData = DB::table('tbl_brandboost_products')
                    ->where('brandboost_id', $brandboostID)
                    ->where('product_order', $order)
                    ->get();
            return $oData;
        }
    }

    /**
     * Used to add campaign product
     * @param type $brandboostID
     * @param type $order
     * @return type
     */
    public static function insertProductData($aData) {
        $insert_id = DB::table('tbl_brandboost_products')->insertGetId($aData);
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }

    /**
     * Used to update campaign product by brandboost id
     * @param type $brandboostID
     * @param type $order
     * @return type
     */
    public static function updateProductData($aData, $brandboostID, $order) {
        $result = DB::table('tbl_brandboost_products')
			->where('brandboost_id', $brandboostID)
			->where('product_order', $order)
			->update($aData);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to update campaign product by product id
     * @param type $brandboostID
     * @param type $productId
     * @return type
     */
    public static function updateProductByProductId($aData, $brandboostID, $productId) {
        $result = DB::table('tbl_brandboost_products')
			->where('brandboost_id', $brandboostID)
			->where('id', $productId)
			->update($aData);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get widget info by id
     * @param type $id
     * @return type
     */
    public function getWidgetInfo($id, $hash = false) {
        if (!empty($id)) {
            $oData = DB::table('tbl_brandboost_widgets')
				->when(($hash == true), function ($query) use ($id) {
					return $query->where('hashcode', $id);
				}, function ($query) {
					return $query->where('id', $id);
				})
				->first();
            return $oData;
        }
    }


	/**
     *
     * @param type $aData
     * @param type $id
     * @return boolean
     */
    public static function updateCampaing($aData, $id) {
        $oData = DB::table('tbl_campaigns')
                ->where('id', $id)
                ->update($aData);
        return true;
    }

	/**
     *
     * @param type $eventID
     * @return type
     */
    public static function getCampByEventID($eventID) {
        $oData = DB::table('tbl_campaigns')
                ->where('event_id', $eventID)
                ->orderBy('id', 'ASC')
                ->get();
        return $oData;
    }


	public static function getSendRequest($brandboostId, $type = '') {
		$oData = DB::table('tbl_brandboost_events')
			->select('tbl_brandboost_events.id as beventid', 'tbl_tracking_log_email_sms.id as trackinglogid', 'tbl_tracking_log_email_sms.subscriber_id as tracksubscriberid', 'tbl_tracking_log_email_sms.type as tracksubscribertype', 'tbl_campaigns.*')
			->where('tbl_brandboost_events.brandboost_id', $brandboostId)
			->when((!empty($type)), function ($query) use ($type) {
				return $query->where('tbl_tracking_log_email_sms.type', $type);
			}, function ($query) {
				return $query->where('tbl_tracking_log_email_sms.type', 'email')
					->orWhere('tbl_tracking_log_email_sms.type', 'sms');
			})
			->leftJoin('tbl_campaigns', 'tbl_campaigns.event_id', '=', 'tbl_brandboost_events.id')
            ->leftJoin('tbl_tracking_log_email_sms', 'tbl_tracking_log_email_sms.campaign_id', '=', 'tbl_campaigns.id')
			->count();
		return $oData;
	}

























































	public function creatWidgetTheme($aData) {
        $result = $this->db->insert('tbl_brandboost_widget_theme_settings', $aData);
        $inset_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function getWidgetThemeData($themeId = '') {

        if ($themeId > 0) {
            $this->db->where('id', $themeId);
        }

        $result = $this->db->get('tbl_brandboost_widget_theme_settings');
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    /**
     *
     * @param type $campType
     * @param type $userID
     * @return type
     */
    public function getWidgetThemeDetails($themeId) {

        $oData = DB::table('tbl_brandboost_widget_theme_settings')
            ->where('id', $themeId)
            ->get();
        return $oData;
    }

    public function getCampaignBycampID($campaignID) {

        $response = array();
        $this->db->where('id', $campaignID);
        $this->db->from('tbl_campaigns');
        $result = $this->db->get();
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function deleteCampaign($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('tbl_campaigns');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvent($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('tbl_brandboost_events');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCampaignByEventID($eventID) {
        $this->db->where('event_id', $eventID);
        $result = $this->db->delete('tbl_campaigns');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEvent($eData, $id) {
        $this->db->where('id', $id);
        $result = $this->db->update('tbl_brandboost_events', $eData);
        if ($result) {
            return $id;
        } else {
            return false;
        }
    }

    public function updateStep3($id, $limit) {
        $aData = array(
            'min_ratings_display' => $limit
        );

        $this->db->where('id', $id);
        $result = $this->db->update('tbl_brandboost', $aData);
        if ($result) {
            return $id;
        } else {
            return false;
        }
    }

    public function updateStep4($id, $tags_data) {
        $aData = array(
            'exclude_pages' => $tags_data
        );

        $this->db->where('id', $id);
        $result = $this->db->update('tbl_brandboost', $aData);

        if ($result) {
            return $id;
        } else {
            return false;
        }
    }

    public function updateStep5($aData, $id) {

        $this->db->where('id', $id);
        $result = $this->db->update('tbl_brandboost', $aData);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function addEvent($aData) {
        $result = $this->db->insert('tbl_brandboost_events', $aData);
        //echo $this->db->last_query();

        $inset_id = $this->db->insert_id();
        if ($result)
            return $inset_id;
        else
            return false;
    }

    public function addCampaign($aData) {
        $result = $this->db->insert('tbl_campaigns', $aData);
        //echo $this->db->last_query();
        $inset_id = $this->db->insert_id();
        if ($result)
            return $inset_id;
        else
            return false;
    }

    public function addOffsiteReviews($aData) {
        $result = $this->db->insert('tbl_reviews_offsite', $aData);
        //echo $this->db->last_query(); exit;
        $inset_id = $this->db->insert_id();
        if ($result)
            return $inset_id;
        else
            return false;
    }

    public function delOffsiteReview($revId) {

        $this->db->where('id', $revId);
        $result = $this->db->delete('tbl_reviews_offsite');
        if ($result)
            return true;
        else
            return false;
    }

    public function getOffsiteReviewsBYUN($name, $source, $brandboostId) {
        $response = array();
        $this->db->where('name', $name);
        $this->db->where('source', $source);
        $this->db->where('brandboost_id', $brandboostId);
        $this->db->from('tbl_reviews_offsite');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addCampaingTemplate($aData) {
        $result = $this->db->insert('tbl_campaign_templates', $aData);
        //echo $this->db->last_query();
        if ($result)
            return true;
        else
            return false;
    }

    public function getAllCampaignTemplates($id = '') {
        $response = array();
        if ($id > 0) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id', 'DESC');
        }
        $this->db->from('tbl_campaign_templates');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateCampaingTemplate($tempId, $aData) {
        $response = array();
        $this->db->set($aData);
        $this->db->where('id', $tempId);
        $result = $this->db->update('tbl_campaign_templates');
        if ($result)
            return true;
        else
            return false;
    }



    public function unsubscribeUser($brandboostID, $subscriberID) {
        $response = array();
        $this->db->set(array('status' => 0));
        $this->db->where('id', $subscriberID);
        $result = $this->db->update('tbl_brandboost_users');
        //echo $this->db->last_query();;
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteCampaingTemplate($tempId) {
        $this->db->where('id', $tempId);
        $result = $this->db->delete('tbl_campaign_templates');
        if ($result)
            return true;
        else
            return false;
    }

    public function getPrevEventId($brandId) {

        $response = array();
        $this->db->order_by('id', 'DESC');
        $this->db->where('brandboost_id', $brandId);
        $this->db->where('status', 1);
        $this->db->from('tbl_brandboost_events');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response[0];
    }

    public function campaign_count_all() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {

            $this->db->where('review_type', 'onsite');
            $this->db->order_by('id', 'DESC');
            $this->db->where('delete_status', 0);
            $result = $this->db->get('tbl_brandboost');
            return $result->num_rows();
        } else {

            $this->db->where('review_type', 'onsite');
            $this->db->where('user_id', $userID);
            $this->db->where('delete_status', 0);
            $this->db->order_by('id', 'DESC');
            $result = $this->db->get('tbl_brandboost');
            return $result->num_rows();
        }
    }

    public function campaign_offsite_count_all() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {

            $this->db->where('review_type', 'offsite');
            $this->db->order_by('id', 'DESC');
            $this->db->where('delete_status', 0);
            $result = $this->db->get('tbl_brandboost');
            return $result->num_rows();
        } else {

            $this->db->where('review_type', 'offsite');
            $this->db->where('user_id', $userID);
            $this->db->where('delete_status', 0);
            $this->db->order_by('id', 'DESC');
            $result = $this->db->get('tbl_brandboost');
            return $result->num_rows();
        }
    }

    public function campaign_review_count_all($campaignID) {

        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_reviews.campaign_id", $campaignID);
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");
        return $rResponse->num_rows();
    }

    public function user_campaign_review_count_all($userID) {

        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->where("tbl_brandboost.user_id", $userID);
        $this->db->where("tbl_brandboost.delete_status", 0);
        $this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");
        return $rResponse->num_rows();
    }

    public function campaign_site_review_count_all($campaignID) {

        $this->db->select("tbl_reviews_site.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile");
        $this->db->join("tbl_users", "tbl_reviews_site.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_reviews_site.campaign_id", $campaignID);
        $this->db->order_by("tbl_reviews_site.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews_site");
        return $rResponse->num_rows();
    }

    public function camp_review_comment_count_all($reviewId) {

        $this->db->select("tbl_reviews_comments.*, tbl_brandboost.brand_title as brand_title, tbl_brandboost.brand_img as brand_img");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_brandboost.user_id=tbl_users.id");
        $this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.review_id", $reviewId);
        $oResponse = $this->db->get("tbl_reviews_comments");
        //echo $this->db->last_query();exit;
        return $oResponse->num_rows();
    }

    public function camp_list_subscribers_count_all($listId) {
        $response = array();
        $this->db->where('brandboost_id', $listId);
        $this->db->order_by('id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        /* if ($result->num_rows() > 0) {
          $response = $result->result();
          }
          return $response; */
        return $result->num_rows();
    }

    function campaign_fetch_details($limit, $start, $sortBy, $sortType) {
        $this->load->model("admin/Reviewlists_model", "rrLists");
        $aUser = getLoggedUser();
        $currentUserId = $aUser->id;
        $user_role = $aUser->user_role;
        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $output = '';
        if ($user_role == 1) {

            $this->db->where('review_type', 'onsite');
            $this->db->where('delete_status', 0);
            $this->db->order_by($sortBy, $sortType);
            $this->db->limit($limit, $start);
            $result = $this->db->get('tbl_brandboost');
        } else {

            $this->db->where('review_type', 'onsite');
            $this->db->where('user_id', $currentUserId);
            $this->db->where('delete_status', 0);
            $this->db->order_by($sortBy, $sortType);
            $this->db->limit($limit, $start);
            $result = $this->db->get('tbl_brandboost');
        }


        if ($result->num_rows() > 0) {
            $aBrandbosts = $result->result();
        }

        if (count($aBrandbosts) > 0) {
            $inc = 1;
            foreach ($aBrandbosts as $data) {
                $list_id = $data->id;
                $user_id = $data->user_id;
                $revCount = getCampaignReviewCount($data->id);
                $revRA = getCampaignReviewRA($data->id);
                $allSubscribers = $this->rrLists->getAllSubscribersList($data->id);

                $siteRevCount = getCampaignSiteReviewCount($data->id);
                $siteRevRA = getCampaignSiteReviewRA($data->id);
                $brandImgArray = unserialize($data->brand_img);
                $brand_img = $brandImgArray[0]['media_url'];

                if (empty($brand_img)) {
                    $imgSrc = base_url('assets/images/default_table_img2.png');
                } else {
                    $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                }

                $output .= '<tr>
                <td>
                    <div class="media-left media-middle">
                        <a href="' . base_url('admin/brandboost/edit/' . $data->id) . '">
                        <img src="' . $imgSrc . '" class="img-circle img-xs" alt=""></a>
                    </div>
                    <div class="media-left">
                        <div class=""><a href="javascript:void()" brandID="' . $data->id . '" b_title="' . $data->brand_title . '" class="text-default text-semibold editBrandboost">' . $data->brand_title . '</a></div>
                        <div class="text-muted text-size-small">
                            ' . setStringLimit($data->brand_desc) . '
                        </div>
                    </div>
                </td>';
                $output .= '<td><span class="ratingBox" style="display: block">';
                $starInt = 1;
                for ($i = 1; $i <= 5; $i++) {
                    if ($starInt <= $revRA) {
                        $output .= '<i class="fa fa-star"></i> ';
                    } else {
                        $output .= '<i class="fa fastar fa-star"></i> ';
                    }

                    $starInt++;
                }
                $output .= '</span>';

                if ($revCount > 0) {
                    $output .= '<a href="reviews/' . $data->id . '" target="_blank"><span class="text-muted reviewnum">(' . $revCount . ' Reviews)</span></a>';
                } else {
                    $output .= '<span class="text-muted reviewnum">(0 Review)</span>';
                }
                $output .= '</td>';
                $output .= '<td class="text-center"><a href="' . base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=contact') . '" target="_blank">' . sizeof($allSubscribers) . '</a></td>';

                $reviewRequests = $this->getReviewRequest($data->id, '');
                $getSendRequest = count($reviewRequests);
                //$getSendRequest = $this->getSendRequest($data->id, '');
                $getSendRequestSms = getSendRequest($data->id, 'sms');
                $getSendRequestEmail = getSendRequest($data->id, 'email');
                $getSendRequestEmailPersentage = $getSendRequestEmail * 100 / $getSendRequest;
                $getSendRequestSmsPersentage = $getSendRequestSms * 100 / $getSendRequest;

                $reviewResponse = $this->getReviewRequestResponse($data->id);
                //$getResCount = getSendResponseCount($data->id);
                $getResCount = count($reviewResponse);
                $resCountEmail = getSendResponse($data->id, 'Email');
                $resCountSms = getSendResponse($data->id, 'SMS');

                $resCountEmailPersentage = $resCountEmail * 100 / $getResCount;
                $resCountSmsPersentage = $resCountSms * 100 / $getResCount;

                $aBrandSubs = getSubscriberOfBrandboost($data->id);
                $acampDistSub = $this->getDistinctSubs($data->id, 'email');

                if ($aBrandSubs > $acampDistSub) {
                    $tolalPending = $aBrandSubs - $acampDistSub;
                } else {
                    $tolalPending = '0';
                }
                $tolalPendingEmailPersentage = $tolalPending * 100 / $tolalPending;

                if ($getResCount > 0 && $getSendRequest > 0) {
                    $conversionRate = number_format(($getResCount / $getSendRequest) * 100, 2) . '%';
                } else {
                    $conversionRate = '0%';
                }

                if ($resCountEmail > 0) {
                    $resCountEmailCR = number_format(($resCountEmail / $getSendRequest) * 100, 2) . '%';
                } else {
                    $resCountEmailCR = '0%';
                }

                if ($resCountSms > 0) {
                    $resCountSmsCR = number_format(($resCountSms / $getSendRequest) * 100, 2) . '%';
                } else {
                    $resCountSmsCR = '0%';
                }

                $resCountSmsPersentage = 0;
                $tolalPendingSmsPersentage = 0;
                $output .= '<td class="text-center"><a href="' . base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=request') . '" target="_blank">' . $getSendRequest . '</a></td>';
                $output .= '<td class="text-center"><a href="' . base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=response') . '" target="_blank">' . $getResCount . '</a></td>';
                $output .= '<td class="text-center"><a href="' . base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=pending') . '" target="_blank">' . $tolalPending . '</a></td>';

                $output .= '<td>' . $conversionRate . '</td>';

                $output .= '<td class="text-center">';
                if ($data->status == 1) {
                    $output .= '<span class="label bg-success">Publish</span>';
                } else {
                    $output .= '<span class="label bg-danger">Draft</span>';
                }
                $output .= '</td>';


                if ($user_role != '2') {
                    if ($currentUserId == $user_id || $user_role == 1) {

                        $output .= ' <td class="text-center">
                            <ul class="icons-list">';
                        if ($inc > 5) {
                            $output .= '  <li class="dropup">';
                        } else {
                            $output .= '  <li class="dropdown">';
                        }
                        $output .= ' <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="' . base_url('admin/brandboost/edit/' . $data->id) . '"><i class="icon-file-stats"></i> Edit</a></li>
                                        <li><a href="javascript:void(0);" class="deleteCampaign" brandID="' . $data->id . '"><i class="icon-file-text2"></i> Delete</a></li>
                                        <li><a href="javascript:void(0);" class="viewECode" brandID="' . $data->id . '"><i class="icon-file-locked"></i> Get Embedded Code</a></li>
                                        <li><a href="' . base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=contact') . '" target="_blank"><i class="icon-gear"></i> Contacts</a></li>
                                        <li><a href="http://pleasereviewmehere.com/campaign/' . strtolower(str_replace(" ", "-", $data->brand_title)) . '-' . $data->id . '" target="_blank"><i class="icon-menu"></i>Campaign Page</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </td>';
                    } else {

                        $output .= '<td class="text-center"> - </td>';
                    }
                }
                $output .= '</tr>';
                $inc++;
            }
        } else {
            $output .= '<tr><td colspan="6" style="text-align:center;">No any data found.</td></tr>';
        }
        return $output;
    }



    public function user_campaign_review_fetch_details($limit, $start, $sortBy, $sortType, $userID) {

        $sortBy = $sortBy == '' ? 'tbl_brandboost.brand_title' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $output = '';
        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_brandboost.brand_title");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_brandboost.id=tbl_reviews.campaign_id", "LEFT");
        $this->db->where("tbl_brandboost.user_id", $userID);
        $this->db->where("tbl_brandboost.delete_status", 0);
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        //$this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews");

        if ($rResponse->num_rows() > 0) {
            $aReviews = $rResponse->result();
        }

        $output = $this->load->view("admin/brandboost/review_data_list", array('aReviews' => $aReviews, 'userId' => $userID), true);

        return $output;
    }

    public function campaign_site_review_fetch_details($limit, $start, $sortBy, $sortType, $campaignID) {

        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $output = '';
        $this->db->select("tbl_reviews_site.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile");
        $this->db->join("tbl_users", "tbl_reviews_site.user_id=tbl_users.id", "LEFT");
        $this->db->where("tbl_reviews_site.campaign_id", $campaignID);
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        //$this->db->order_by("tbl_reviews.id", "DESC");
        $rResponse = $this->db->get("tbl_reviews_site");

        if ($rResponse->num_rows() > 0) {
            $aReviews = $rResponse->result();
        }

        if (!empty($aReviews)) {
            $inc = 1;
            foreach ($aReviews as $oReview) {

                $getComm = getCampaignCommentCount($oReview->id);

                $output .= '<tr>
                <td>
                    <div class="">
                    <span class="text-default text-semibold">' . setStringLimit($oReview->review_title) . '</span>';
                if ($oReview->review_type == 'text') {
                    $output .= '<div class="text-muted text-size-small">';
                    $output .= setStringLimit($oReview->comment_text);
                    $output .= '</div>';
                } else {
                    /* $output .= '<div class="text-muted text-size-small">
                      <a style="cursor: pointer;" class="showVideo" videoUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'. $oReview->comment_video .'">Video Url</a>
                      </div>'; */
                }
                $output .= '</div>



                </td>

                <td><span class="ratingBox" style="display: block">';
                $starInt = 1;
                for ($i = 1; $i <= 5; $i++) {
                    if ($starInt <= $oReview->ratings) {
                        $output .= '<i class="fa fa-star"></i> ';
                    } else {
                        $output .= '<i class="fa fastar fa-star"></i> ';
                    }

                    $starInt++;
                }
                $output .= '</span>';


                $output .= '</td>

                <td><div class="text-semibold">' . date('F d, Y', strtotime($oReview->created)) . '</div><div class="text-muted text-size-small">' . date('h:i A', strtotime($oReview->created)) . ' (' . timeAgo($oReview->created) . ')</div></td>

                <td style="text-align: center;">';

                if ($oReview->status == 0) {
                    $output .= '<span class="label bg-danger">DISAPPROVED</span>';
                } else if ($oReview->status == 2) {
                    $output .= '<span class="label label-info">PENDING</span>';
                } else {
                    $output .= '<span class="label bg-success">APPROVED</span>';
                }

                $output .= '</td>

                <td class="text-center">
                    <ul class="icons-list">';
                if ($inc > 5) {
                    $output .= '  <li class="dropup">';
                } else {
                    $output .= '  <li class="dropdown">';
                }
                $output .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">';


                if ($oReview->status == 1) {
                    $output .= "<li><a review_id='" . $oReview->id . "' change_status = '0' title='Disapproved this review.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
                } else if ($oReview->status == 2) {
                    $output .= "<li><a review_id='" . $oReview->id . "' change_status = '1' title='Approved this review.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
                    $output .= "<li><a review_id='" . $oReview->id . "' change_status = '0' title='Disapproved this review.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
                } else {
                    $output .= "<li><a review_id='" . $oReview->id . "' change_status = '1' title='Approved this review.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
                }

                if ($oReview->review_type == 'text') {

                    $output .= '<li><a href="javascript:void(0);" class="editReview" reviewid="' . $oReview->id . '"><i class="icon-gear"></i> Edit</a></li>';
                } else {
                    $output .= '<li><a href="javascript:void(0);" class="editVideoReview" reviewid="' . $oReview->id . '"><i class="icon-gear"></i> Edit</a></li>';
                }
                $output .= '<li><a href="javascript:void(0);" class="deleteReview" reviewid="' . $oReview->id . '" ><i class="icon-trash"></i> Delete</a></li>

                            </ul>
                        </li>
                    </ul>
                </td>


            </tr>';
                $inc++;
            }
        } else {
            $output .= '<tr><td colspan="6" style="text-align:center;">No any data found.</td></tr>';
        }

        return $output;
    }

    public function camp_review_comment_fetch_details($limit, $start, $sortBy, $sortType, $reviewId) {

        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $output = '';
        $this->db->select("tbl_reviews_comments.*, tbl_brandboost.brand_title as brand_title, tbl_brandboost.brand_img as brand_img");
        $this->db->join("tbl_reviews", "tbl_reviews_comments.review_id = tbl_reviews.id", "LEFT");
        $this->db->join("tbl_brandboost", "tbl_reviews.campaign_id = tbl_brandboost.id", "LEFT");
        $this->db->join("tbl_users", "tbl_brandboost.user_id=tbl_users.id");
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        //$this->db->order_by("tbl_reviews_comments.id", "DESC");
        $this->db->where("tbl_reviews_comments.review_id", $reviewId);
        $oResponse = $this->db->get("tbl_reviews_comments");
        //echo $this->db->last_query();exit;

        if ($oResponse->num_rows() > 0) {
            $aComments = $oResponse->result();
        }

        if (!empty($aComments)) {
            $inc = 1;
            foreach ($aComments as $oComment) {
                //pre($oComment);
                $getUserDetail = getUserDetail($oComment->user_id);
                $userName = $getUserDetail->firstname . ' ' . $getUserDetail->lastname;

                $output .= '<tr>

            <td style="white-space: normal;"><span class="text-default text-semibold">' . setStringLimit($oComment->content) . '</span>
            <div class="text-muted text-size-small">' . $oComment->brand_title . '</div></td>
            <td >' . $userName . '</td>
            <td><div class="text-semibold">' . date('F d, Y', strtotime($oComment->created)) . '</div><div class="text-muted text-size-small">' . date('h:i A', strtotime($oComment->created)) . ' (' . timeAgo($oComment->created) . ')</div></td>
            <td class="text-center">';

                if ($oComment->status == 0) {
                    $output .= '<span class="label bg-danger">DISAPPROVED</span>';
                } else if ($oComment->status == 2) {
                    $output .= '<span class="label label-info">PENDING</span>';
                } else {
                    $output .= '<span class="label bg-success">APPROVED</span>';
                }

                $output .= '</td>

            <td class="text-center">
                <ul class="icons-list">';
                if ($inc > 5) {
                    $output .= '<li class="dropup">';
                } else {
                    $output .= '<li class="dropdown">';
                }
                $output .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">';

                if ($oComment->status == 1) {
                    $output .= "<li><a comment_id='" . $oComment->id . "' change_status = '0' title='Disapproved this comment.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
                } else if ($oComment->status == 2) {
                    $output .= "<li><a comment_id='" . $oComment->id . "' change_status = '1' title='Approved this comment.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
                    $output .= "<li><a comment_id='" . $oComment->id . "' change_status = '0' title='Disapproved this comment.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
                } else {
                    $output .= "<li><a comment_id='" . $oComment->id . "' change_status = '1' title='Approved this comment.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
                }


                $output .= '<li><a href="javascript:void(0);" class="editComment" commentid="' . $oComment->id . '"><i class="icon-gear"></i> Edit</a></li>

                            <li><a href="javascript:void(0);" class="deleteComment" commentid="' . $oComment->id . '"><i class="icon-trash"></i> Delete</a></li>

                        </ul>
                    </li>
                </ul>
            </td>
        </tr>';
                $inc++;
            }
        } else {
            $output .= '<tr><td colspan="6" style="text-align:center;">No any data found.</td></tr>';
        }

        return $output;
    }

    public function camp_list_subscribers_fetch_details($limit, $start, $sortBy, $sortType, $listId) {
        list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $output = '';
        $response = array();
        $this->db->where('brandboost_id', $listId);
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        //$this->db->order_by('id', 'DESC');
        $this->db->from('tbl_brandboost_users');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $subscribersData = $result->result();
        }

        if (count($subscribersData) > 0) {
            $inc = 1;
            foreach ($subscribersData as $data) {

                $output .= '<tr>
                <td><span class="text-default text-semibold">' . $data->firstname . ' ' . $data->lastname . '</td>
                    <td>' . $data->email . '</td>
                    <td>' . phoneNoFormat($data->phone) . '</td>
                    <td><div class="text-semibold">' . date('F d, Y', strtotime($data->created)) . '</div><div class="text-muted text-size-small">' . date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')</div></td>
                    <td class="text-center">';
                if ($data->status == 1) {

                    $output .= '<span class="label bg-success">ACTIVE</span>';
                } else {

                    $output .= '<span class="label bg-danger">INACTIVE</span>';
                }

                $output .= '</td>';

                $output .= '<td class="text-center">
                        <ul class="icons-list">';

                if ($inc > 5) {
                    $output .= '<li class="dropup">';
                } else {
                    $output .= '<li class="dropdown">';
                }
                $output .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">';
                if ($canWrite) {
                    $output .= '<li><a class="unSubscribeUAC" href="javascript:void(0);" title="Unsubscribe For All Campaigns" subscriberemail="' . $data->email . '" subscriberid="' . $data->id . '"><i class="icon-gear"></i> Inactive For All</a></li>';
                    if ($data->status == 1) {
                        $output .= "<li><a subscriberId='" . $data->id . "' change_status = '0' class='chg_status'><i class='icon-file-locked'></i> Inacive</a></li>";
                    } else {
                        $output .= "<li><a  subscriberId='" . $data->id . "' change_status = '1' class='chg_status'><i class='icon-file-locked'></i> Active</a></li>";
                    }

                    $output .= '<li><a href="javascript:void(0);" class="editSubscriber" subscriberid="' . $data->id . '"><i class="icon-gear"></i> Edit</a></li>

                                    <li><a class="deleteSubscriber" href="javascript:void(0);" subscriberid="' . $data->id . '"><i class="icon-trash"></i> Delete</a></li>';
                }
                $output .= '</ul>
                            </li>
                        </ul>
                    </td>';

                $output .= '</tr>';
                $inc++;
            }
        } else {
            $output .= '<tr><td colspan="6" style="text-align:center;">No any subscribers found.</td></tr>';
        }
        return $output;
    }

    public function getSentEmailCountByUserIdAndBBId($userID, $bbId = '') {

        $result = array();
        $this->db->select("tbl_track_twillio.*, tbl_brandboost.user_id");
        $this->db->where("tbl_brandboost.user_id", $userID);

        if ($bbId != '') {
            $this->db->where("tbl_brandboost.id", $bbId);
        }

        $this->db->join("tbl_track_twillio", "tbl_track_twillio.brandboost_id = tbl_brandboost.id", "LEFT");
        $this->db->order_by("tbl_track_twillio.id", "DESC");
        $this->db->group_by("tbl_track_twillio.id");
        $result = $this->db->get("tbl_brandboost");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getSentSMSCountByUserIdAndBBId($userID, $bbId = '') {

        $result = array();
        $this->db->select("tbl_track_sendgrid.*, tbl_brandboost.user_id");
        $this->db->where("tbl_brandboost.user_id", $userID);

        if ($bbId != '') {
            $this->db->where("tbl_brandboost.id", $bbId);
        }

        $this->db->join("tbl_track_sendgrid", "tbl_track_sendgrid.brandboost_id = tbl_brandboost.id", "LEFT");
        $this->db->order_by("tbl_track_sendgrid.id", "DESC");
        $this->db->group_by("tbl_track_sendgrid.id");
        $result = $this->db->get("tbl_brandboost");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function numOfEmailSms($brandboostId, $type) {

        $response = array();
        $this->db->select('tbl_tracking_log_email_sms.*,tbl_campaigns.event_id as campaign_event_id ');
        $this->db->where('tbl_brandboost_events.brandboost_id', $brandboostId);
        if (!empty($type)) {
            $this->db->where('tbl_tracking_log_email_sms.type', $type);
        }
        $this->db->from('tbl_brandboost_events');
        $this->db->join("tbl_campaigns", "tbl_campaigns.event_id = tbl_brandboost_events.id", "LEFT");
        $this->db->join("tbl_tracking_log_email_sms", "tbl_tracking_log_email_sms.campaign_id = tbl_campaigns.id", "RIGHT");
        //return $this->db->last_query();
        $result = $this->db->get();
        return $result->num_rows();
        /* if ($result->num_rows() > 0) {
          $response = $result->result();
          }
          return $response; */
    }

    public function getBrandboostSubs($brandboostId) {

        $result = array();
        $this->db->select();
        $this->db->where("tbl_brandboost_users.brandboost_id", $brandboostId);
        $this->db->where("tbl_brandboost_users.status", '1');
        $result = $this->db->get("tbl_brandboost_users");
        return $result->num_rows();
        /* if ($result->num_rows() > 0) {
          $aData = $result->result();
          }

          return $aData; */
    }

    public function getDistinctSubs($brandboostId, $type) {

        $response = array();
        $this->db->distinct();
        $this->db->select('tbl_tracking_log_email_sms.subscriber_id');
        //$this->db->select('tbl_tracking_log_email_sms.*,tbl_campaigns.event_id as campaign_event_id ');
        $this->db->where('tbl_brandboost_events.brandboost_id', $brandboostId);
        if (!empty($type)) {
            $this->db->where('tbl_tracking_log_email_sms.type', $type);
        }
        $this->db->from('tbl_brandboost_events');
        $this->db->join("tbl_campaigns", "tbl_campaigns.event_id = tbl_brandboost_events.id", "LEFT");
        $this->db->join("tbl_tracking_log_email_sms", "tbl_tracking_log_email_sms.campaign_id = tbl_campaigns.id", "RIGHT");
        //return $this->db->last_query();
        $result = $this->db->get();
        return $result->num_rows();
        /* if ($result->num_rows() > 0) {
          $response = $result->result();
          }
          return $response; */
    }



    public function unsubscribeUserAC($aData) {
        $result = $this->db->insert('tbl_suppression_list', $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function updateSubscriberStatusByEmail($email) {
        $response = array();
        $this->db->set(array('status' => 0));
        $this->db->where('email', $email);
        $result = $this->db->update('tbl_brandboost_users');
        if ($result)
            return true;
        else
            return false;
    }

    public function getSendgridStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_track_sendgrid.* FROM tbl_track_sendgrid "
                . "LEFT JOIN tbl_brandboost ON tbl_track_sendgrid.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";

        if ($param == 'brandboost') {
            $sql .= "WHERE tbl_track_sendgrid.brandboost_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_track_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_track_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_track_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_track_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_track_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_track_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_track_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_track_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_track_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_track_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_track_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_track_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_track_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_track_sendgrid.event_name='deferred' ";
        }

        $sql .= "ORDER BY tbl_track_sendgrid.id DESC";

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getSendgridTrackingStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_track_sendgrid.*, tbl_brandboost.brand_title as brandboostTittle, tbl_brandboost_events.event_type as brandboostEventType, tbl_campaigns.content_type as contentType, tbl_campaigns.campaign_type as campaignType, tbl_campaigns.name as campaignName, CONCAT(tbl_brandboost_users.firstname,' ',tbl_brandboost_users.lastname) as subscriberName, tbl_brandboost_users.phone as subscriberPhone FROM tbl_track_sendgrid "
                . "LEFT JOIN tbl_brandboost ON tbl_track_sendgrid.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_sendgrid.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_sendgrid.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_sendgrid.subscriber_id = tbl_brandboost_users.id ";

        if ($param == 'brandboost') {
            $sql .= "WHERE tbl_track_sendgrid.brandboost_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_track_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_track_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_track_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_track_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_track_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_track_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_track_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_track_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_track_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_track_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_track_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_track_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_track_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_track_sendgrid.event_name='deferred' ";
        }

        $sql .= "ORDER BY tbl_track_sendgrid.id DESC";

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getTwilioTrackingStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_track_twillio.*, tbl_brandboost.brand_title as brandboostTittle , tbl_brandboost_events.event_type as brandboostEventType, tbl_campaigns.content_type as contentType, tbl_campaigns.campaign_type as campaignType, tbl_campaigns.name as campaignName, CONCAT(tbl_brandboost_users.firstname,' ',tbl_brandboost_users.lastname) as subscriberName, tbl_brandboost_users.phone as subscriberPhone, tbl_brandboost_users.email as subscriberEmail FROM tbl_track_twillio "
                . "LEFT JOIN tbl_brandboost ON tbl_track_twillio.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_twillio.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_twillio.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_twillio.subscriber_id = tbl_brandboost_users.id ";

        if ($param == 'brandboost') {
            $sql .= "WHERE tbl_track_twillio.brandboost_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_track_twillio.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_track_twillio.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_track_twillio.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND tbl_track_twillio.event_name='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND tbl_track_twillio.event_name='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_track_twillio.event_name='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND tbl_track_twillio.event_name='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND tbl_track_twillio.event_name='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND tbl_track_twillio.event_name='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND tbl_track_twillio.event_name='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND tbl_track_twillio.event_name='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND tbl_track_twillio.event_name='sending' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_track_twillio.event_name='click' ";
        }

        $sql .= "ORDER BY tbl_track_twillio.id DESC";

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getSendgridCategorizedStatsData($oData) {

        if (!empty($oData)) {
            $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
            $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'open') {
                    $openTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $openUniqueCount) == true) {
                        $openDuplicateCount[] = $oRow;
                    } else {
                        $openUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'click') {
                    $clickTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $clickUniqueCount) == true) {
                        $clickDuplicateCount[] = $oRow;
                    } else {
                        $clickUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'processed') {
                    $processedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $processedUniqueCount) == true) {
                        $processedDuplicateCount[] = $oRow;
                    } else {
                        $processedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'bounce') {
                    $bounceTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $bounceUniqueCount) == true) {
                        $bounceDuplicateCount[] = $oRow;
                    } else {
                        $bounceUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'unsubscribe') {
                    $unsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $unsubscribeUniqueCount) == true) {
                        $unsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $unsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'dropped') {
                    $droppedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $droppedUniqueCount) == true) {
                        $droppedDuplicateCount[] = $oRow;
                    } else {
                        $droppedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'spam_report') {
                    $spamTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $spamUniqueCount) == true) {
                        $spamDuplicateCount[] = $oRow;
                    } else {
                        $spamUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_resubscribe') {
                    $groupResubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $groupResubscribeUniqueCount) == true) {
                        $groupResubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupResubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_unsubscribe') {
                    $groupUnsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $groupUnsubscribeUniqueCount) == true) {
                        $groupUnsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupUnsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'deferred') {
                    $deferredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deferredUniqueCount) == true) {
                        $deferredDuplicateCount[] = $oRow;
                    } else {
                        $deferredUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
                        $otherDuplicateCount[] = $oRow;
                    } else {
                        $otherUniqueCount[] = $oRow;
                    }
                }
            }
        }
        //Okay Now print result
        $aCatogerizedData = array(
            'open' => array(
                'TotalCount' => count($openTotalCount),
                'UniqueCount' => count($openUniqueCount),
                'DuplicateCount' => count($openDuplicateCount),
                'totalData' => $openTotalCount,
                'UniqueData' => $openUniqueCount,
                'DuplicateData' => $openDuplicateCount
            ),
            'click' => array(
                'TotalCount' => count($clickTotalCount),
                'UniqueCount' => count($clickUniqueCount),
                'DuplicateCount' => count($clickDuplicateCount),
                'totalData' => $clickTotalCount,
                'UniqueData' => $clickUniqueCount,
                'DuplicateData' => $clickDuplicateCount
            ),
            'processed' => array(
                'TotalCount' => count($processedTotalCount),
                'UniqueCount' => count($processedUniqueCount),
                'DuplicateCount' => count($processedDuplicateCount),
                'totalData' => $processedTotalCount,
                'UniqueData' => $processedUniqueCount,
                'DuplicateData' => $processedDuplicateCount
            ),
            'delivered' => array(
                'TotalCount' => count($deliveredTotalCount),
                'UniqueCount' => count($deliveredUniqueCount),
                'DuplicateCount' => count($deliveredDuplicateCount),
                'totalData' => $deliveredTotalCount,
                'UniqueData' => $deliveredUniqueCount,
                'DuplicateData' => $deliveredDuplicateCount
            ),
            'bounce' => array(
                'TotalCount' => count($bounceTotalCount),
                'UniqueCount' => count($bounceUniqueCount),
                'DuplicateCount' => count($bounceDuplicateCount),
                'totalData' => $bounceTotalCount,
                'UniqueData' => $bounceUniqueCount,
                'DuplicateData' => $bounceDuplicateCount
            ),
            'unsubscribe' => array(
                'TotalCount' => count($unsubscribeTotalCount),
                'UniqueCount' => count($unsubscribeUniqueCount),
                'DuplicateCount' => count($unsubscribeDuplicateCount),
                'totalData' => $unsubscribeTotalCount,
                'UniqueData' => $unsubscribeUniqueCount,
                'DuplicateData' => $unsubscribeDuplicateCount
            ),
            'dropped' => array(
                'TotalCount' => count($droppedTotalCount),
                'UniqueCount' => count($droppedUniqueCount),
                'DuplicateCount' => count($droppedDuplicateCount),
                'totalData' => $droppedTotalCount,
                'UniqueData' => $droppedUniqueCount,
                'DuplicateData' => $droppedDuplicateCount
            ),
            'spam_report' => array(
                'TotalCount' => count($spamTotalCount),
                'UniqueCount' => count($spamUniqueCount),
                'DuplicateCount' => count($spamDuplicateCount),
                'totalData' => $spamTotalCount,
                'UniqueData' => $spamUniqueCount,
                'DuplicateData' => $spamDuplicateCount
            ),
            'group_resubscribe' => array(
                'TotalCount' => count($groupResubscribeTotalCount),
                'UniqueCount' => count($groupResubscribeUniqueCount),
                'DuplicateCount' => count($groupResubscribeDuplicateCount),
                'totalData' => $groupResubscribeTotalCount,
                'UniqueData' => $groupResubscribeUniqueCount,
                'DuplicateData' => $groupResubscribeDuplicateCount
            ),
            'group_unsubscribe' => array(
                'TotalCount' => count($groupUnsubscribeTotalCount),
                'UniqueCount' => count($groupUnsubscribeUniqueCount),
                'DuplicateCount' => count($groupUnsubscribeDuplicateCount),
                'totalData' => $groupUnsubscribeTotalCount,
                'UniqueData' => $groupUnsubscribeUniqueCount,
                'DuplicateData' => $groupUnsubscribeDuplicateCount
            ),
            'deferred' => array(
                'TotalCount' => count($deferredTotalCount),
                'UniqueCount' => count($deferredUniqueCount),
                'DuplicateCount' => count($deferredDuplicateCount),
                'totalData' => $deferredTotalCount,
                'UniqueData' => $deferredUniqueCount,
                'DuplicateData' => $deferredDuplicateCount
            ),
            'other' => array(
                'TotalCount' => count($otherTotalCount),
                'UniqueCount' => count($otherUniqueCount),
                'DuplicateCount' => count($otherDuplicateCount),
                'totalData' => $otherTotalCount,
                'UniqueData' => $otherUniqueCount,
                'DuplicateData' => $otherDuplicateCount
            )
        );

        return $aCatogerizedData;
    }

    public function getTwilioStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_track_twillio.* FROM tbl_track_twillio "
                . "LEFT JOIN tbl_brandboost ON tbl_track_twillio.brandboost_id = tbl_brandboost.id "
                . "LEFT JOIN tbl_brandboost_events ON tbl_track_twillio.event_id = tbl_brandboost_events.id "
                . "LEFT JOIN tbl_campaigns ON tbl_track_twillio.campaign_id= tbl_campaigns.id "
                . "LEFT JOIN tbl_brandboost_users ON tbl_track_twillio.subscriber_id = tbl_brandboost_users.id ";

        if ($param == 'brandboost') {
            $sql .= "WHERE tbl_track_twillio.brandboost_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_track_twillio.campaign_id='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE tbl_track_twillio.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_track_twillio.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND tbl_track_twillio.event_name='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND tbl_track_twillio.event_name='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_track_twillio.event_name='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND tbl_track_twillio.event_name='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND tbl_track_twillio.event_name='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND tbl_track_twillio.event_name='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND tbl_track_twillio.event_name='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND tbl_track_twillio.event_name='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND tbl_track_twillio.event_name='sending' ";
        }

        $sql .= "ORDER BY tbl_track_twillio.id DESC";

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        //echo $this->db->last_query();
        return $response;
    }

    public function getTwilioCategorizedStatsData($oData) {
        if (!empty($oData)) {

            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'accepted') {
                    $acceptedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $acceptedUniqueCount) == true) {
                        $acceptedDuplicateCount[] = $oRow;
                    } else {
                        $acceptedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sent') {
                    $sentTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $sentUniqueCount) == true) {
                        $sentDuplicateCount[] = $oRow;
                    } else {
                        $sentUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'undelivered') {
                    $undeliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $undeliveredUniqueCount) == true) {
                        $undeliveredDuplicateCount[] = $oRow;
                    } else {
                        $undeliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'failed') {
                    $failedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $failedUniqueCount) == true) {
                        $failedDuplicateCount[] = $oRow;
                    } else {
                        $failedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'receiving') {
                    $receivingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $receivingUniqueCount) == true) {
                        $receivingDuplicateCount[] = $oRow;
                    } else {
                        $receivingUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'received') {
                    $receivedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $receivedUniqueCount) == true) {
                        $receivedDuplicateCount[] = $oRow;
                    } else {
                        $receivedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'queued') {
                    $queuedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $queuedUniqueCount) == true) {
                        $queuedDuplicateCount[] = $oRow;
                    } else {
                        $queuedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sending') {
                    $sendingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $sendingUniqueCount) == true) {
                        $sendingDuplicateCount[] = $oRow;
                    } else {
                        $sendingUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
                        $otherDuplicateCount[] = $oRow;
                    } else {
                        $otherUniqueCount[] = $oRow;
                    }
                }
            }
        }
        //Okay Now print result
        $aCatogerizedData = array(
            'accepted' => array(
                'TotalCount' => count($acceptedTotalCount),
                'UniqueCount' => count($acceptedUniqueCount),
                'DuplicateCount' => count($acceptedDuplicateCount),
                'totalData' => $acceptedTotalCount,
                'UniqueData' => $acceptedUniqueCount,
                'DuplicateData' => $acceptedDuplicateCount
            ),
            'sent' => array(
                'TotalCount' => count($sentTotalCount),
                'UniqueCount' => count($sentUniqueCount),
                'DuplicateCount' => count($sentDuplicateCount),
                'totalData' => $sentTotalCount,
                'UniqueData' => $sentUniqueCount,
                'DuplicateData' => $sentDuplicateCount
            ),
            'delivered' => array(
                'TotalCount' => count($deliveredTotalCount),
                'UniqueCount' => count($deliveredUniqueCount),
                'DuplicateCount' => count($deliveredDuplicateCount),
                'totalData' => $deliveredTotalCount,
                'UniqueData' => $deliveredUniqueCount,
                'DuplicateData' => $deliveredDuplicateCount
            ),
            'undelivered' => array(
                'TotalCount' => count($undeliveredTotalCount),
                'UniqueCount' => count($undeliveredUniqueCount),
                'DuplicateCount' => count($undeliveredDuplicateCount),
                'totalData' => $undeliveredTotalCount,
                'UniqueData' => $undeliveredUniqueCount,
                'DuplicateData' => $undeliveredDuplicateCount
            ),
            'failed' => array(
                'TotalCount' => count($failedTotalCount),
                'UniqueCount' => count($failedUniqueCount),
                'DuplicateCount' => count($failedDuplicateCount),
                'totalData' => $failedTotalCount,
                'UniqueData' => $failedUniqueCount,
                'DuplicateData' => $failedDuplicateCount
            ),
            'receiving' => array(
                'TotalCount' => count($receivingTotalCount),
                'UniqueCount' => count($receivingUniqueCount),
                'DuplicateCount' => count($receivingDuplicateCount),
                'totalData' => $receivingTotalCount,
                'UniqueData' => $receivingUniqueCount,
                'DuplicateData' => $receivingDuplicateCount
            ),
            'received' => array(
                'TotalCount' => count($receivedTotalCount),
                'UniqueCount' => count($receivedUniqueCount),
                'DuplicateCount' => count($receivedDuplicateCount),
                'totalData' => $receivedTotalCount,
                'UniqueData' => $receivedUniqueCount,
                'DuplicateData' => $receivedDuplicateCount
            ),
            'queued' => array(
                'TotalCount' => count($queuedTotalCount),
                'UniqueCount' => count($queuedUniqueCount),
                'DuplicateCount' => count($queuedDuplicateCount),
                'totalData' => $queuedTotalCount,
                'UniqueData' => $queuedUniqueCount,
                'DuplicateData' => $queuedDuplicateCount
            ),
            'sending' => array(
                'TotalCount' => count($sendingTotalCount),
                'UniqueCount' => count($sendingUniqueCount),
                'DuplicateCount' => count($sendingDuplicateCount),
                'totalData' => $sendingTotalCount,
                'UniqueData' => $sendingUniqueCount,
                'DuplicateData' => $sendingDuplicateCount
            ),
            'other' => array(
                'TotalCount' => count($otherTotalCount),
                'UniqueCount' => count($otherUniqueCount),
                'DuplicateCount' => count($otherDuplicateCount),
                'totalData' => $otherTotalCount,
                'UniqueData' => $otherUniqueCount,
                'DuplicateData' => $otherDuplicateCount
            )
        );

        return $aCatogerizedData;
    }

    public function checkIfDuplicateExistsInSendgridStat($aSearch, $tableData) {
        if (!empty($tableData)) {
            foreach ($tableData as $oData) {
                if ($oData->subscriber_id == $aSearch->subscriber_id && $oData->campaign_id == $aSearch->campaign_id) {
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * This function is used to get the datewise stats
     * @param type $cDate
     * @return type
     */
    public static function getBBStatsByDate($cDate = '') {
        $aData = DB::table('tbl_reviews')
                        ->orderBy('tbl_reviews.id', 'desc')
                        ->where('tbl_brandboost.review_type', 'onsite')
                        ->where('tbl_reviews.created', 'like' . $cDate)
                        ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')->get();
        return $aData;
    }

    public function getBBTotalSendSmsData($userID) {
        $aData = array();
        $this->db->where('tbl_brandboost.user_id', $userID);
        $this->db->join("tbl_brandboost", "tbl_track_twillio.brandboost_id = tbl_brandboost.id", "LEFT");
        $oResponse = $this->db->get("tbl_track_twillio");
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        if ($aData)
            return $aData;
        else
            return false;
    }

    public function getBBTotalSendEmailData($userID) {
        $aData = array();
        $this->db->where('tbl_brandboost.user_id', $userID);
        $this->db->join("tbl_brandboost", "tbl_track_sendgrid.brandboost_id = tbl_brandboost.id", "LEFT");
        $oResponse = $this->db->get("tbl_track_sendgrid");
        if ($oResponse->num_rows() > 0) {
            $aData = $oResponse->result();
        }
        if ($aData)
            return $aData;
        else
            return false;
    }

    /**
     * This function is used to get the recent comments
     * @param type $userID
     * @param type $reviewType
     * @return type
     */
    public function recentComments($userID, $reviewType) {
        $aData = array();
        $aData = DB::table('tbl_reviews')
                        ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.avatar')
                        ->where('tbl_brandboost.user_id', $userID)
                        ->when($reviewType == 'positive', function($query) {
                            return $query->where('tbl_reviews.ratings', 4)->orWhere('tbl_reviews.ratings', 5);
                        })
                        ->when($reviewType != 'positive', function($query) {
                            return $query->where('tbl_reviews.ratings', 1)->orWhere('tbl_reviews.ratings', 2);
                        })
                        ->leftJoin('tbl_brandboost', 'tbl_reviews.campaign_id', '=', 'tbl_brandboost.id')
                        ->leftJoin('tbl_users', 'tbl_reviews.user_id', '=', 'tbl_users.id')
                        ->orderBy('tbl_reviews.id', 'desc')->get();
        return $aData;
    }

    public function isMainEvent($id) {
        $this->db->where("event_type !=", 'followup');
        $this->db->where("previous_event_id", 0);
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_brandboost_events");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEmailAutomationEvent($aData, $eventID) {
        $this->db->where("id", $eventID);
        $result = $this->db->update("tbl_brandboost_events", $aData);
        //echo $this->db->last_query();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmailCampaignInfo($eventID) {
        $this->db->where('event_id', $eventID);
        $result = $this->db->get("tbl_campaigns");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
            return $response;
        }
        return false;
    }

    public function updateEmailAutomationCampaign($aData, $id) {
        if ($id > 0) {
            $this->db->where("id", $id);
            $result = $this->db->update("tbl_campaigns", $aData);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function getEmailAutomationEventByPreviousID($previousID) {
        $this->db->where("previous_event_id", $previousID);
        $result = $this->db->get("tbl_brandboost_events");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getEmailAutomationEvent($id) {
        $this->db->where("id", $id);
        $result = $this->db->get("tbl_brandboost_events");
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function deleteEmailAutomationEvent($id) {
        if ($id > 0) {
            $bCheckIfMainEvent = $this->isMainEvent($id);
            if ($bCheckIfMainEvent == true) {
                //Delete only campaign not the event
                $result = $this->deleteEmailAutomationCampaign($id);
            } else {
                //delete both event + campaign
                $this->db->where('id', $id);
                $response = $this->db->delete("tbl_brandboost_events");
                if ($response) {
                    $result = $this->deleteEmailAutomationCampaign($id);
                }
            }
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteEmailAutomationCampaign($eventID) {
        if ($eventID > 0) {
            $this->db->where('event_id', $eventID);
            $result = $this->db->delete("tbl_campaigns");
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteCampaignResponse($campaignResponseID) {
        if ($campaignResponseID > 0) {
            $this->db->where('id', $campaignResponseID);
            $result = $this->db->delete("tbl_reviews");
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function addEmailAutomationCampaign($aData) {
        $result = $this->db->insert("tbl_campaigns", $aData);
        //echo $this->db->last_query();
        $inset_id = $this->db->insert_id();
        if ($inset_id) {
            return $inset_id;
        } else {
            return false;
        }
    }

    /**
     * function is used to get the campaign site reviews
     * @return type
     */
    public function campaignSiteReview($campaignID, $limit = 5, $offsite = 0) {
        $aData = DB::table('tbl_reviews_site')
                        ->select('tbl_reviews_site.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
                        ->leftJoin('tbl_users', 'tbl_reviews_site.user_id', '=', 'tbl_users.id')
                        ->where('tbl_reviews_site.campaign_id', $campaignID)
                        ->orderBy("tbl_reviews_site.id", "DESC")
                        ->limit($limit, $offsite)->get();
        return $aData;
    }

    /**
     * This function will return User details by the user id
     * @param type $userId
     * @return type
     */
    public function getBrandboostDetailByUserId($userId, $type = '') {

        $aData = DB::table('tbl_brandboost')
                        ->where('review_type', $type)
                        ->where('delete_status', 0)
                        ->orderBy('id', 'DESC')->get();


        return $aData;
    }

    /**
     * Gets the list of offsite sources website
     * @param type $id
     * @return type
     */
    public static function getOffsiteWebsite($id) {
        $oData = DB::table('tbl_offsite_websites')
                ->where('id', $id)
                ->first();
        return $oData;
    }

    /**
     * This function used to update the status of the campaign
     * @param $id
     * @param $status
     * @return bool
     */
    public static function saveCampaignStatus($id, $status){
        $result = DB::table('tbl_brandboost')
            ->where('id', $id)
            ->update(['status'=>$status]);
        if ($result > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to add default event for manual brandboost onsite event
     * @param $aData
     * @return mixed
     */
    public function createBrandboostEvent($aData) {
        $insert_id = DB::table('tbl_brandboost_events')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to store onsite review request
     * @param $aData
     * @return bool
     */
    public function createOnsiteRequest($aData){
        $insert_id = DB::table('tbl_brandboost_request')->insertGetId($aData);
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRequestDetails($id){
        $oData = DB::table('tbl_brandboost_request')
            ->where("id", $id)->first();
        return $oData;
    }

    /**
     * Used to update review request
     * @param $aData
     * @param $id
     * @return bool
     */
    public function updateReviewRequest($aData, $id){
        if($id>0){
            $result = DB::table('tbl_brandboost_request')
                ->where('id', $id)
                ->update($aData);
            if ($result > -1) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Used to add request queue into the database
     * @param $aData
     * @param $id
     * @return bool
     */
    public function addToQueue($aData, $id){
        $oData = DB::table('tbl_brandboost_request_queue')
            ->where("request_id", $id)->first();
        if(empty($oData)){
            // Add to queue
            $insert_id = DB::table('tbl_brandboost_request_queue')->insertGetId($aData);
            return $insert_id;
        }
        return false;
    }

    /**
     * This function used to get review request data along with cron sending status
     * @param $campaingId
     * @param bool $pagination
     * @param int $perPage
     * @return mixed
     */
    public function getManualRequestStatus($campaingId, $searchBy='', $sortBy='', $pagination=false, $perPage=10){
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $query = DB::table('tbl_brandboost_request')
            ->select('tbl_brandboost_request.*', 'tbl_brandboost_request_queue.status as cronStatus', 'tbl_brandboost_request_queue.completed_date', 'tbl_brandboost.brand_title as campaignName')
            ->leftJoin('tbl_brandboost_request_queue','tbl_brandboost_request.id', '=', 'tbl_brandboost_request_queue.request_id')
            ->leftJoin('tbl_brandboost','tbl_brandboost_request.campaign_id', '=', 'tbl_brandboost.id');
        if(!empty($campaingId)){
            $query -> where("tbl_brandboost_request.campaign_id", $campaingId);
        }
        if(!empty($searchBy)){
            $query->where('tbl_brandboost_request.user_id', $userID);
            $query->where('tbl_brandboost_request.name', 'LIKE',  "%$searchBy%");
        }
        if(!empty($sortBy)){
            $query->where('tbl_brandboost_request.user_id', $userID);
            $query->where('tbl_brandboost_request_queue.status', '=',  $sortBy);
        }
        $query->orderBy('tbl_brandboost_request.id', 'DESC');
        if($pagination == true){
            if($perPage == 'all' || $perPage == 'All' || $perPage == 'ALL'){
                $result = $query->get();
            }else{
                $result = $query->paginate($perPage);
            }
        }else{
            $result = $query->get();
        }
        return $result;
    }

}
