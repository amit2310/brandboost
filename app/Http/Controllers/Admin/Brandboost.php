<?php

namespace App\Http\Controllers\Admin;
//require 'aws/aws-autoloader.php';
//use Aws\S3\S3Client;
//use Aws\Exception\AwsException;

use App\Models\Admin\TagsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\BrandModel;
use App\Models\Admin\SubscriberModel;
use App\Models\FeedbackModel;
use App\Models\ReviewsModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\TemplatesModel;
use App\Models\Admin\OffsiteModel;
use App\Models\Admin\ReviewlistsModel;
use App\Models\Admin\ListsModel;
use App\Models\Admin\LiveModel;
use App\Models\Admin\Crons\InviterModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Filesystem\Filesystem;

use Session;

class Brandboost extends Controller
{

    var $default_main_email_template_onsite;
    var $default_main_email_template_offsite;
    var $default_main_email_delay_unit;
    var $default_main_email_delay_value;
    var $default_reminder_email_template_onsite;
    var $default_reminder_email_template_offsite;
    var $default_reminder_email_delay_unit;
    var $default_reminder_email_delay_value;

    /**
     * Used to get onsite overview brandboost data
     * @return type
     */
    public function onsiteOverview()
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $company_name = $aUser->company_name;
        $mBrandboost = new BrandboostModel();
        $mUsers = new UsersModel();
        if ($user_role == 1) {
            $aBrandboostList = $mBrandboost->getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = $mBrandboost->getBrandboostByUserId($userID, 'onsite');
            $bbEmailSend = $mBrandboost->getBrandboostEmailSend($userID, 'onsite');
            $bbSmsSend = $mBrandboost->getBrandboostSmsSend($userID, 'onsite');

            $bbEmailSendMonth = $mBrandboost->getBrandboostEmailSendMonth($userID, 'onsite');
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
            <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Overview" class="sidebar-control active hidden-xs ">Overview</a></li>
            </ul>';

        $bActiveSubsription = $mUsers->isActiveSubscription();
        //Session::set("setTab", '');

        $aData = array(
            'title' => 'Onsite overview',
            'pagename' => $breadcrumb,
            'aBrandbosts' => $aBrandboostList,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'company_name' => strtolower(str_replace(' ', '-', $company_name)),
            'bbEmailSend' => $bbEmailSend,
            'bbSmsSend' => $bbSmsSend,
            'bbEmailSendMonth' => $bbEmailSendMonth,
            'viewstats' => true
        );

        $mReviews = new ReviewsModel();

        if (!empty($aBrandboostList)) {
            foreach ($aBrandboostList as $aBrandboostVal) {
                $CampaignAllReviewsArr = $mReviews->getCampaignAllReviews($aBrandboostVal->id);
                $aBrandboostVal->CampaignAllReviews = !empty($CampaignAllReviewsArr) ? count($CampaignAllReviewsArr) : 0;

                $CampReviewsArr = $mReviews->getCampReviews($aBrandboostVal->id);
                $aBrandboostVal->CampReviews = !empty($CampReviewsArr) ? count($CampReviewsArr) : 0;

                $aBrandboostVal->AllSubscribers = ListsModel::getAllSubscribersList($aBrandboostVal->id);

                $aBrandboostVal->revRA = getCampaignReviewRA($aBrandboostVal->id);

                $aBrandboostVal->reviewRequests = $mBrandboost->getReviewRequest($aBrandboostVal->id, '');
                $aBrandboostVal->reviewRequestsSms = $mBrandboost->getSendRequest($aBrandboostVal->id, 'sms');
                $aBrandboostVal->reviewRequestsEmail = $mBrandboost->getSendRequest($aBrandboostVal->id, 'email');

                $aBrandboostVal->reviewResponse = $mBrandboost->getReviewRequestResponse($aBrandboostVal->id);

                if (!empty($aBrandboostVal->reviewResponse)) {
                    $aBrandboostVal->statsVal = $this->statsRatingwise($aBrandboostVal->reviewResponse);
                }
            }
        }

        //return view('admin.brandboost.onsite_overview', $aData);
        echo json_encode($aData);
        exit;
    }


    /**
     * Used to get onsite computational data
     * @return type
     */
    public function statsRatingwise($reviewResponse)
    {

        $positiveRating = 0;
        $neturalRating = 0;
        $negativeRating = 0;

        if (!empty($reviewResponse)) {
            foreach ($reviewResponse as $reviewData) {
                if ($reviewData->ratings != '') {
                    if ($reviewData->ratings == 5) {
                        $positiveRating++;
                    } else if ($reviewData->ratings >= 3 && $reviewData->ratings < 5) {
                        $neturalRating++;
                    } else {
                        $negativeRating++;
                    }
                }
            }
        }

        $getResCount = count($reviewResponse);

        $positiveGraph = 0;
        $neturalGraph = 0;
        $negativeGraph = 0;

        if ($getResCount > 0) {
            $positiveGraph = $positiveRating * 100 / $getResCount;
            $neturalGraph = $neturalRating * 100 / $getResCount;
            $negativeGraph = $negativeRating * 100 / $getResCount;
        }

        return ['positiveRating' => $positiveRating,
            'positiveGraph' => $positiveGraph,
            'neturalRating' => $neturalRating,
            'neturalGraph' => $neturalGraph,
            'negativeRating' => $negativeRating,
            'negativeGraph' => $negativeGraph];

    }


    /**
     * Used to get onsite brandboost data
     * @return type
     */
    public function onsite()
    {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $company_name = $aUser->company_name;
        $companyName = strtolower(str_replace(' ', '-', $company_name));

        $mBrandboost = new BrandboostModel();
        $mUsers = new UsersModel();

        if ($user_role == 1) {
            $aBrandboostList = $mBrandboost->getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = $mBrandboost->getBrandboostByUserId($userID, 'onsite');
        }
        $moduleName = 'brandboost-onsite';

        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Onsite' => ''
        );

        $bActiveSubsription = $mUsers->isActiveSubscription();
        //$this->session->set_userdata('setTab', '');

        $aData = array(
            'title' => 'Onsite Brand Boost Campaigns',
            'breadcrumb' => $aBreadcrumb,
            'allData' => $aBrandboostList,
            'aBrandbosts' => $aBrandboostList->items(),
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'company_name' => $companyName,
            'moduleName' => $moduleName,
            'viewstats' => true
        );

//		return view('admin.brandboost.onsite_list', $aData);
        echo json_encode($aData);
        exit;
    }


    /**
     * Used to update in the review campaign
     */
    public function updateReviewCampaign(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'campaignName' => ['required'],
            'campaignDescription' => ['required']
        ]);

        //Instantiate Brandboost model to get its methods and properties
        $mBrandboost = new BrandboostModel();

        $response = array();

        $campaign_id = $request->campaign_id;

        $campaignName = $request->campaignName;
        $description = $request->campaignDescription;
        $cData = array(
            'brand_title' => $campaignName,
            'brand_desc' => $description
        );
        $result = $mBrandboost->updateBrandboost($userID, $cData, $campaign_id);

        if ($result) {
            $response = array('status' => 'success', 'brandboostID' => $campaign_id, 'msg' => 'Edit Review Campaign successfully.');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to get onsite configuration related values
     * @param type $request
     * @return type
     */
    public function onsiteSetup(Request $request)
    {
        $brandboostID = $request->id;
        $selectedTab = $request->input("t");
        $selectedCategory = $request->input("cate");
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $mBrandboost = new BrandboostModel();
        $mUsers = new UsersModel();
        $mFeedback = new FeedbackModel();
        $mWorkflow = new WorkflowModel();
        $mReviews = new ReviewsModel();
        $mTemplates = new TemplatesModel();
        //$mInviter = new InviterModel();

        if (!empty($selectedTab)) {
            if (in_array($selectedTab, ['Campaign Preferences', 'Review Sources', 'Rewards & Gifts', 'Configure Widgets', 'Email Workflow', 'Campaign Clients', 'Reviews', 'Integration', 'Image', 'Video'])) {
                //set required session
                Session::put("setTab", $selectedTab);
            }
        } else {
            $setTab = Session::get("setTab");
            if ($setTab == '') {
                Session::put("setTab", 'Campaign Preferences');
            }
        }

        Session::put("setTab", 'Campaign Preferences');

        if (empty($brandboostID)) {
            redirect("admin/brandboost/onsite");
            exit;
        }

        $bbProductsData = $mBrandboost->getProductData($brandboostID);
        $getBrandboost = $mBrandboost->getBrandboost($brandboostID);

        $getBrandboostFR = $mFeedback->getFeedbackResponse($brandboostID);
        $moduleName = 'brandboost';
        $moduleUnitID = '';
        $oCampaignSubscribers = $mWorkflow->getWorkflowCampaignSubscribers($moduleName, $brandboostID);

        $bActiveSubsription = $mUsers->isActiveSubscription();
        $eventsdata = $mBrandboost->getBrandboostEvents($brandboostID);
        $aReviews = $mReviews->getCampaignAllReviews($brandboostID);
        $revCount = getCampaignReviewCount($brandboostID);
        $revRA = getCampaignReviewRA($brandboostID);

        $emailTemplate = $mBrandboost->getAllCampaignTemplatesByUserID($userID, 'onsite');
        $smsTemplate = $mBrandboost->getAllSMSCampaignTemplatesByUserID($userID, 'onsite');

        $oEvents = $mWorkflow->getWorkflowEvents($brandboostID, $moduleName);

        $oEventsType = array('send-invite', 'followup');
        $oCampaignTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = $mWorkflow->getWorkflowDefaultTemplates($moduleName, 'onsite');
        $setTab = Session::get("setTab");
        $oTemplates = $mTemplates->getCommonTemplates();
        $oCategories = $mTemplates->getCommonTemplateCategories();

        /*if ($this->use_default_accounts == true) {
            $aTwilioData = $this->defaultTwilioDetails;
            $fromNumber = $aData['from_entity'];
        } else {
            $aTwilioAc = $mInviter->getTwilioAccount($userID);
            if (!empty($aTwilioAc)) {
                $fromNumber = $aTwilioAc->contact_no;
            }
        }*/

        $fromNumber = '';

        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Onsite' => '#/reviews/onsite',
            'Setup' => '',
        );

        $aData = array(
            'title' => 'Onsite Brand Boost Campaign',
            'breadcrumb' => $aBreadcrumb,
            'getOnsite' => $getBrandboost,
            'bActiveSubsription' => $bActiveSubsription,
            'feedbackResponse' => $getBrandboostFR,
            'brandboostData' => $getBrandboost[0],
            'campaignTitle' => $getBrandboost[0]->brand_title,
            'eventsData' => $eventsdata,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $brandboostID,
            'oEventsType' => $oEventsType,
            'oTemplates' => $oTemplates,
            'oCategories' => $oCategories,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'subscribersData' => $oCampaignSubscribers, // $allSubscribers,
            //'result' => $feedbackData,
            'setTab' => $setTab,
            'brandboostID' => $brandboostID,
            'bbProductsData' => $bbProductsData,
            'aReviews' => $aReviews,
            'revCount' => $revCount,
            'revRA' => $revRA,
            'selectedTab' => $selectedTab,
            'emailTemplate' => $emailTemplate,
            'smsTemplate' => $smsTemplate,
            'selectedCategory' => $selectedCategory,
            'fromNumber' => $fromNumber,
            'aUserInfo' => $oUser
        );

        //return view('admin.brandboost.onsite_setup', $aData);
        echo json_encode($aData);
        exit;
    }

    /**
     * This function is used to get onsite campaign subscribers
     * @param Request $request
     */
    public function onsiteSetupSubscribers(Request $request)
    {
        $brandboostID = $request->id;
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $mBrandboost = new BrandboostModel();
        $mUsers = new UsersModel();
        $mWorkflow = new WorkflowModel();

        if (empty($brandboostID)) {
            redirect("#admin/reviews/onsite");
            exit;
        }


        $getBrandboost = $mBrandboost->getBrandboost($brandboostID);
        $moduleName = 'brandboost';
        $moduleUnitID = '';
        $oCampaignSubscribers = $mWorkflow->getWorkflowCampaignSubscribers($moduleName, $brandboostID, 10);
        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Onsite' => '#/reviews/onsite',
            'Setup' => '',
        );

        $aData = array(

            'breadcrumb' => $aBreadcrumb,
            'brandboostData' => $getBrandboost[0],
            'campaignTitle' => $getBrandboost[0]->brand_title,
            'moduleName' => $moduleName,
            'moduleUnitID' => $brandboostID,
            'allData' => $oCampaignSubscribers, // $allSubscribers,
            'subscribers' => $oCampaignSubscribers->items(),
            'aUserInfo' => $oUser
        );

        //return view('admin.brandboost.onsite_setup', $aData);
        echo json_encode($aData);
        exit;
    }

    /**
     * This function is used to get onsite reviews data
     * @param Request $request
     */
    public function onsiteSetupReview(Request $request)
    {
        $brandboostID = $request->id;
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $mBrandboost = new BrandboostModel();
        $mUsers = new UsersModel();
        $mWorkflow = new WorkflowModel();

        if (empty($brandboostID)) {
            redirect("#admin/reviews/onsite");
            exit;
        }

        $mReviews = new ReviewsModel();
        $getBrandboost = $mBrandboost->getBrandboost($brandboostID);
        $aReviews = $mReviews->getCampaignAllReviews($brandboostID);
        $moduleName = 'brandboost';
        $moduleUnitID = '';
        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Onsite' => '#/reviews/onsite',
            'Setup' => '',
        );

        if (!empty($aReviews)) {
            foreach ($aReviews->items() as $aReview) {
                $aReview->getComm = getCampaignCommentCount($aReview->id);
                $aReview->reviewTags = getTagsByReviewID($aReview->id);
                $aReview->smilyImage = ratingView($aReview->ratings);

                $aReview->reviewCommentsData = $mReviews->getReviewAllComments($aReview->id, 0, 100);

                if(!empty($getBrandboost[0]->reviewResponse)) {
                    $aReview->status = $this->getCommStatus($aReview->reviewCommentsData);
                }
            }
        }

        $aData = array(
            'breadcrumb' => $aBreadcrumb,
            'brandboostData' => $getBrandboost[0],
            'campaignTitle' => $getBrandboost[0]->brand_title,
            'moduleName' => $moduleName,
            'moduleUnitID' => $brandboostID,
            'allData' => $aReviews, // $allSubscribers,
            'reviews' => $aReviews->items(),
            'aUserInfo' => $oUser
        );

        //return view('admin.brandboost.onsite_setup', $aData);
        echo json_encode($aData);
        exit;
    }

    public function OnsiteReviewStats(Request $request)
    {
        $brandboostID = $request->id;
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $mBrandboost = new BrandboostModel();

        if (empty($brandboostID)) {
            redirect("#admin/reviews/onsite");
            exit;
        }

        $mReviews = new ReviewsModel();
        $aReviews = $mReviews->getCampaignAllReviews($brandboostID);
        $moduleName = 'brandboost';


        if (!empty($aReviews)) {
            foreach ($aReviews->items() as $aReview) {
                $aReview->getComm = getCampaignCommentCount($aReview->id);
                $aReview->reviewTags = getTagsByReviewID($aReview->id);
                $aReview->smilyImage = ratingView($aReview->ratings);

                $aReview->reviewCommentsData = $mReviews->getReviewAllComments($aReview->id, 0, 100);

                if(!empty($getBrandboost[0]->reviewResponse)) {
                    $aReview->status = $this->getCommStatus($aReview->reviewCommentsData);
                }
            }
        }

        $aData = array(

            'allData' => $aReviews, // $allSubscribers,
            'reviews' => $aReviews->items(),
            'aUserInfo' => $oUser
        );

        //return view('admin.brandboost.onsite_setup', $aData);
        echo json_encode($aData);
        exit;
    }


    /**
     * Used to get campaign review request data
     * @param type $request
     * @return type
     */
    public function reviewRequest(Request $request)
    {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $param = $request->type;
        $moduleName = 'brandboost';

        //Instantiate Brandboost model to get its methods and properties
        $mBrandboost = new BrandboostModel();
        $mUsers = new UsersModel();
        $bActiveSubsription = $mUsers->isActiveSubscription();

        $aBreadcrumb = array(
            'Home' => '#/',
            ucwords($param).' Review Requests' => '#/brandboost/review_request/'.$param
        );

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Review Requests" class="sidebar-control active hidden-xs ">Review Requests</a></li>
			</ul>';

        $oRequests = $mBrandboost->getReviewRequest();
        //pre($oRequests);die;

        $count = 0;
        if (!empty($oRequests->items())) {
            $oReqOnsite = array();
            $oReqOffsite = array();
            foreach ($oRequests->items() as $data2) {
                if ($data2->review_type == 'onsite') {
                    $oReqOnsite[] = $data2;
                } else if ($data2->review_type == 'offsite') {
                    $oReqOffsite[] = $data2;
                } else {
                    $oReqOther[] = $data2;
                }
            }

            if ($param == 'onsite') {
                $oData = $oReqOnsite;
            } else if ($param == 'offsite') {
                $oData = $oReqOffsite;
            } else {
                $oData = $oRequests->items();
            }

            $count = count($oData);
        }


        $aData = array(
            'title' => 'Brand Boost Review Requests',
            'breadcrumb' => $aBreadcrumb,
            'bActiveSubsription' => $bActiveSubsription,
            'param' => $param,
            'allData' => $oRequests,
            'oRequest' => $oRequests->items(),
            'totalCount' => $count,
            'oFilteredRequests' => $oData,
            'moduleName' => $moduleName
        );


        //return view('admin.brandboost.review_request', $aData);
        echo json_encode($aData);
        exit;
    }


    /**
     * Used to get all reviews of campaign
     * @param type $request
     * @return type
     */
    public function reviews(Request $request)
    {
        $mBrandboost = new BrandboostModel();
        $mUsers = new UsersModel();
        $mReviews = new ReviewsModel();
        $mTags = new TagsModel();
        $campaignId = $request->id;
        if (!empty($campaignId)) {

            $oCampaign = $mReviews->getBrandBoostCampaign($campaignId);
            $aReviews = $mReviews->getCampaignReviews($campaignId);
            $bActiveSubsription = $mUsers->isActiveSubscription();

            $aBreadcrumb = array(
                'Home' => '#/',
                $oCampaign->brand_title => '#/brandboost/onsite',
                'Reviews' => ''
            );

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/onsite') . '">' . $oCampaign->brand_title . '</a></li>
				<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
				<li><a class="sidebar-control hidden-xs">Reviews</a></li>
                </ul>';

            $reviewTags = array();
            if(!empty($aReviews->items())) {
                foreach($aReviews->items() as $kRev => $vRev) {
                    //$vRev->id = 108;
                    $reviewTags[$vRev->id] = getTagsByReviewID($vRev->id);
                }
            }

            $aData = array(
                'title' => 'Brand Boost Reviews',
                'pagename' => $breadcrumb,
                'breadcrumb' => $aBreadcrumb,
                'oCampaign' => $oCampaign,
                'allData' => $aReviews,
                'aReviews' => $aReviews->items(),
                'reviewTags' => $reviewTags,
                'campaignId' => $campaignId,
                'bActiveSubsription' => $bActiveSubsription
            );

            //return view('admin.brandboost.review_list_camp', $aData);

            echo json_encode($aData);
            exit;

        } else {
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $aReviews = $mReviews->getMyBranboostReviews($userID);
            $bActiveSubsription = $mUsers->isActiveSubscription();

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
				<li><a data-toggle="tooltip" data-placement="bottom" title="Reviews" class="sidebar-control active hidden-xs ">Reviews</a></li>
				</ul>';

            $aData = array(
                'title' => 'Brand Boost Reviews',
                'pagename' => $breadcrumb,
                'oCampaign' => '',
                'aReviews' => $aReviews,
                'campaignId' => '',
                'userId' => $userID,
                'bActiveSubsription' => $bActiveSubsription
            );


            $mReviews = new ReviewsModel();

            if (!empty($aReviews)) {
                foreach ($aReviews as $aReview) {
                    $aReview->getComm = getCampaignCommentCount($aReview->reviewid);
                    $aReview->reviewTags = getTagsByReviewID($aReview->reviewid);
                    $aReview->smilyImage = ratingView($aReview->ratings);

                    $aReview->reviewCommentsData = $mReviews->getReviewAllComments($aReview->reviewid, 0, 100);

                    if(!empty($aReview->reviewResponse)) {
                        $aReview->status = $this->getCommStatus($aReview->reviewCommentsData);
                    }
                }
            }

			//return view('admin.brandboost.review_list', $aData);

            echo json_encode($aData);
            exit;
        }
    }

    /**
     * Used to get onsite computational data
     * @return type
     */
    public function getCommStatus($reviewCommentsData) {

        $approved = 0;
        $pending = 0;
        $disApproved = 0;

        if(!empty($reviewCommentsData)) {
            foreach ($reviewCommentsData as $comm) {
                if ($comm->status == 1) {
                    $approved = $approved + 1;
                } else if ($comm->status == 2) {
                    $pending = $pending + 1;
                } else {
                    $disApproved = $disApproved + 1;
                }
            }
        }

        $getResCount = count($reviewCommentsData);

        return ['approved'=>$approved,
            'pending'=>$pending,
            'disApproved'=>$disApproved];

    }


    /**
     * Used to get show media page
     * @param type $param
     * @return type
     */
    public function media()
    {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $mUsers = new UsersModel();
        $mReviews = new ReviewsModel();

        $aReviews = $mReviews->getCampaignReviewsDetail('', $userID, true);
        $allMediaImagesShow = array();
        $hasImages = $hasVideos = false;

        if (!empty($aReviews)) {
            foreach ($aReviews->items() as $review) {
                $mediaUrl = [];
                $mediaUrl = @(unserialize($review->media_url));
                if(empty($mediaUrl) && !empty($review->media_url)){
                    $getFileSize = '512KB';
                    $smilyImage = smilyRating($review->ratings);
                    $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $review->media_url;
                    $fileExt = pathinfo($review->media_url, PATHINFO_EXTENSION);
                    $mediaUrl[0] = [
                        'smily' => $smilyImage,
                        'filePath' => $filePath,
                        'fileExt' => $fileExt,
                        'allowfilesize' => $getFileSize,
                        'media_type' => ($fileExt == 'mp4') ? 'video' : 'image'
                    ];
                }else{
                    if (!empty($mediaUrl)) {
                        foreach ($mediaUrl as $key => $value) {

                            if (!in_array($value['media_url'], $allMediaImagesShow)) {
                                if($value['media_type'] == 'image'){
                                    $hasImages = true;
                                }else{
                                    $hasVideos = true;
                                }
                                $allMediaImagesShow[] = $value['media_url'];

                                $smilyImage = smilyRating($review->ratings);

                                $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $value['media_url'];

                                $fileExt = pathinfo($value['media_url'], PATHINFO_EXTENSION);

                                if ($fileExt == 'mp4') {
                                    $extFileImage = base_url('assets/images/mp4.png');
                                } else if ($fileExt == 'png') {
                                    $extFileImage = base_url('assets/images/png.png');
                                } else if ($fileExt == 'jpg' || $fileExt == 'jpeg') {
                                    $extFileImage = base_url('assets/images/jpg.png');
                                } else {
                                    $extFileImage = base_url('assets/images/file_blank.png');
                                }

                                $getFileSize = '512KB';
                                $value['smily'] = $smilyImage;
                                $value['filePath'] = $filePath;
                                $value['fileExt'] = $fileExt;
                                $value['allowfilesize'] = $getFileSize;
                                $mediaUrl[$key] = $value;

                            }
                            /*pre($mediaUrl);
                            die;*/
                        }

                    }
                }



                $review->fileCollection = $mediaUrl;
            }
        }

        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Onsite' => '#/reviews/onsite',
            'Media' => '',
        );

        $aData = [
            'title' => 'On Site Brand Boost Media',
            'breadcrumb' => $aBreadcrumb,
            'allData' => $aReviews,
            'aReviews' => $aReviews->items(),
            'hasImages' => $hasImages,
            'hasVideos'=> $hasVideos
        ];

        //return view('admin.brandboost.media', $aData);
        echo json_encode($aData);
        exit;
    }


    /**
     * Used to get show media page
     * @param type $reviewID
     * @return type
     */
    public
    function reviewDetails(Request $request)
    {
        $response = array();
        $response['status'] = 'error';

        $reviewID = $request->id;
        $selectedTab = $request->input('t');

        $revID = $request->reviewid;
        $actionName = $request->action;
        $mUser = new UsersModel();
        $product_id = "";
        $product_name = "";
        $brand_title = "";
        $productName = "";
        $bbId = "";


        $reviewID = ($revID > 0) ? $revID : $reviewID;
        $mSubscriber = new SubscriberModel();
        $mReviews = new ReviewsModel();
        $productData = array();
        $reviewCommentCount = getCampaignCommentCount($reviewID);
        $reviewNotesData = ReviewsModel::listReviewNotes($reviewID);
        $reviewCommentsData = ReviewsModel::getReviewAllParentsComments($reviewID, $start = 0);
        $reviewData = ReviewsModel::getReviewInfo($reviewID);
        if($reviewData->isNotEmpty()){
            $bbID = $reviewData->bbId;
        }
        $reviewTags = getTagsByReviewID($reviewID);
        $totalComment = ReviewsModel::parentsCommentsCount($reviewID);
        if (!empty($reviewData->product_id)) {
            $productData = BrandboostModel::getProductDataById($reviewData->product_id);
            $product_id = $reviewData->product_id;
            $product_name = $productData->product_name;
            $brand_title = $reviewData->brand_title;
            $bbId = $reviewData->bbId;

        }

        $productName = $product_id > 0 ? $product_name : $brand_title;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/brandboost/onsite') . '" class="sidebar-control hidden-xs">On site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/brandboost/reviews/') . $bbId . '" data-toggle="tooltip" data-placement="bottom" title="' . $productName . ' Review" class="sidebar-control active hidden-xs ">' . $productName . ' Review</a></li>
			</ul>';

        $aData = array(
            'title' => 'Brand Boost Review Details',
            'pagename' => $breadcrumb,
            'reviewData' => $reviewData,
            'productData' => $productData,
            'reviewCommentCount' => $reviewCommentCount,
            'reviewNotesData' => $reviewNotesData,
            'reviewCommentsData' => $reviewCommentsData,
            'reviewTags' => $reviewTags,
            'reviewID' => $reviewID,
            'totalComment' => $totalComment,
            'productName' => $productName,
            'selectedTab' => $selectedTab
        );

        if ($actionName == 'smart-popup') {
            $popupContent = view('admin.components.smart-popup.reviews', $aData)->with(['mUser' => $mUser, 'mSubscriber' => $mSubscriber, 'mReviews' => $mReviews])->render();
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        } else {
            return view('admin.brandboost.review_details', $aData);

        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public
    function reviewInfo(Request $request)
    {
        $response = array();
        $response['status'] = 'error';

        $reviewID = $request->id;
        $revID = $request->reviewid;
        $product_id = "";
        $product_name = "";
        $brand_title = "";
        $mReviews = new ReviewsModel();

        $reviewID = ($revID > 0) ? $revID : $reviewID;
        $productData = array();
        $reviewCommentCount = getCampaignCommentCount($reviewID);
        $reviewNotesData = ReviewsModel::listReviewNotes($reviewID);
        $reviewCommentsData = ReviewsModel::getReviewAllParentsComments($reviewID, $start = 0);
        $reviewData = ReviewsModel::getReviewInfo($reviewID);
        $reviewTags = getTagsByReviewID($reviewID);
        $totalComment = ReviewsModel::parentsCommentsCount($reviewID);
        if(!empty($reviewData)){
            $bbID = $reviewData->bbId;
            $aAllReviews = $mReviews->getCampaignAllReviews($bbID, true);
            if(!empty($aAllReviews)){
                $oneStar = $twoStar = $threeStar = $fourStar = $fiveStar = $otherStar = $totalReviews = 0;
                foreach ($aAllReviews as $aReview){
                    $totalReviews++;
                    $rating = $aReview->ratings;
                    if($rating == 1){
                        $oneStar++;
                    }else if($rating == 2){
                        $twoStar++;
                    }else if($rating == 3){
                        $threeStar++;
                    }else if($rating == 4){
                        $fourStar++;
                    }else if($rating == 5){
                        $fiveStar++;
                    }
                }
            }
            $aReviewStats = [
                'totalReviews' => $totalReviews,
                'oneStar' => $oneStar,
                'oneStarPercent' => number_format((($oneStar*100)/$totalReviews),2),
                'twoStar' => $twoStar,
                'twoStarPercent' => number_format((($twoStar*100)/$totalReviews),2),
                'threeStar' => $threeStar,
                'threeStarPercent' => number_format((($threeStar*100)/$totalReviews),2),
                'fourStar' => $fourStar,
                'fourStarPercent' => number_format((($fourStar*100)/$totalReviews),2),
                'fiveStar' => $fiveStar,
                'fiveStarPercent' => number_format((($fiveStar*100)/$totalReviews),2)
            ];
        }
        if (!empty($reviewData->product_id)) {
            $productData = BrandboostModel::getProductDataById($reviewData->product_id);
            $product_id = $reviewData->product_id;
            $product_name = $productData->product_name;
            $brand_title = $reviewData->brand_title;
        }

        $productName = $product_id > 0 ? $product_name : $brand_title;
        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Onsite' => '#/reviews/onsite',
            'Review' => '',
        );


        $aData = [
            'title' => 'Brand Boost Review Details',
            'breadcrumb' => $aBreadcrumb,
            'reviewData' => $reviewData,
            'productData' => $productData,
            'reviewCommentCount' => $reviewCommentCount,
            'reviewNotesData' => $reviewNotesData,
            'reviewCommentsData' => $reviewCommentsData,
            'reviewTags' => $reviewTags,
            'reviewID' => $reviewID,
            'totalComment' => $totalComment,
            'productName' => $productName,
            'reviewStats' => $aReviewStats
        ];

        echo json_encode($aData);
        exit;

    }


    /**
     * Used to get show media page
     * @param type $param
     * @return type
     */
    public
    function setTab(Request $request)
    {

        $response = array();
        $getActiveText = $request->getActiveText;
        Session::put("setTab", trim($getActiveText));
        $response['status'] = 'success';

        echo json_encode($response);
        exit;
    }


    /**
     * Used to get show offsite overview
     * @param type $param
     * @return type
     */
    public function offsiteOverview()
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        Session::put("setTab", '');
        if ($user_role == 1) {
            $aBrandboostList = BrandboostModel::getBrandboost('', 'offsite');
        } else {
            $aBrandboostList = BrandboostModel::getBrandboostByUserId($userID, 'offsite');
            $bbEmailSend = BrandboostModel::getBrandboostEmailSend($userID, 'offsite');
            $bbSmsSend = BrandboostModel::getBrandboostSmsSend($userID, 'offsite');

            $bbEmailSendMonth = BrandboostModel::getBrandboostEmailSendMonth($userID, 'offsite');
            $bbSMSSendMonth = BrandboostModel::getBrandboostSmsSendMonth($userID, 'offsite');
        }

        //Do some calculations
        list($canRead, $canWrite) = fetchPermissions('Offsite Campaign');
        $iArchiveCount = $iActiveCount = 0;
        if (!empty($aBrandboostList)) {
            foreach ($aBrandboostList as $oRec) {
                if ($oRec->status == 3) {
                    $iArchiveCount++;
                } else {
                    $iActiveCount++;
                }
            }
        }

        $aBradboosts = $this->processOffsiteOverview($aBrandboostList);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
            <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs">Off Site </a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Overview" class="sidebar-control active hidden-xs ">Overview</a></li>
            </ul>';

        $bActiveSubsription = UsersModel::isActiveSubscription();

        $aData = array(
            'title' => 'Offsite overview',
            'pagename' => $breadcrumb,
            'aBrandbosts' => $aBradboosts,
            'bActiveSubsription' => $bActiveSubsription,
            'currentUserId' => $userID,
            'user_role' => $user_role,
            'viewstats' => true,
            'bbEmailSend' => $bbEmailSend,
            'bbEmailSendMonth' => $bbEmailSendMonth,
            'bbSMSSendMonth' => $bbSMSSendMonth,
            'bbSmsSend' => $bbSmsSend,
            'iActiveCount' => $iActiveCount,
            'iArchiveCount' => $iArchiveCount,
            'canRead' => $canRead,
            'canWrite' => $canWrite
        );

        //return view('admin.brandboost.offsite_list', $aData);
        echo json_encode($aData);
        exit;
    }

    public function processOffsiteOverview($aBrandboosts)
    {
        $recent = strtotime('-24 hours');
        $positiveRating = $neturalRating = $negativeRating = 0;
        foreach ($aBrandboosts as $key => $data) {
            $offsite_ids = $data->offsite_ids;
            $offsite_ids = @unserialize($offsite_ids);
            $user_id = $data->user_id;
            $allSubscribers = ListsModel::getAllSubscribersList($data->id);
            $subs = '';
            $newContacts = 0;
            if ($allSubscribers->isNotEmpty()) {


                $subs = $allSubscribers[0];
                foreach ($allSubscribers as $oSubs) {
                    if (strtotime($oSubs->created) > $recent) {
                        $newContacts++;
                    }
                    /*if ($oSubs->status == 2) {
                        $iArchiveCount++;
                    } else {
                        $iActiveCount++;
                    }*/
                }
            }

            if (!empty($subs->s_created)) {
                $lastListTime = timeAgo($subs->s_created);
            } else {
                $lastListTime = '<div class="media-left">
                                   <div class="">
                                      <span class="text-muted text-size-small">[No Data]</span>
                                   </div>
                                 </div>';
            }
            $positive = $neutral = $negative = 0;
            $revCount = getCampaignFeedbackCount($data->id);
            $revCount = 1;
            $revCount = !empty($revCount) ? $revCount : 0;
            $feedbackCount = BrandboostModel::getFeedbackCount($data->id);
            $positive = $negative = $neutral = $positivePercentage = $neutralPercentage = $negativePercentage = 0;
            if (isset($feedbackCount) && !empty($feedbackCount)) {
                foreach ($feedbackCount as $countUnit) {
                    if ($countUnit->category == 'Positive') {
                        $positive = $countUnit->total_count;
                    } else if ($countUnit->category == 'Neutral') {
                        $neutral = $countUnit->total_count;
                    } else if ($countUnit->category == 'Negative') {
                        $negative = $countUnit->total_count;
                    }
                }

                $positiveRating = $positive;
                $neturalRating = $neutral;
                $negativeRating = $negative;

                $totalFeedback = $positive + $neutral + $negative;
                if($totalFeedback>0){
                    $positivePercentage = number_format(($positive * 100) / $totalFeedback, 2);
                    $neutralPercentage = number_format(($neutral * 100) / $totalFeedback, 2);
                    $negativePercentage = number_format(($negative * 100) / $totalFeedback, 2);
                }

            }

            if($revCount>0){
                $positiveGraph = $positive * 100 / $revCount;
                $neturalGraph = $neutral * 100 / $revCount;
                $negativeGraph = $negative * 100 / $revCount;
            }



            $offsiteTitle = $data->brand_title;
            $offsiteTitle = (!empty($offsiteTitle)) ? $offsiteTitle : 'NA';

            if (strlen($offsiteTitle) > 30) {
                $offsiteTitle = substr($offsiteTitle, 0, 29) . '...';
            }
            $newPositive = $newNegative = $newNeutral = 0;

            $aPositiveSubscribers = $aNeutralSubscribers = $aNegativeSubscribers = array();
            $feedbackData = FeedbackModel::getCampFeedbackData($data->id);
            $subscriberData = '';
            if(isset($feedbackData)){
                $subscriberData = FeedbackModel::getSubscriberInfo($feedbackData->subscriber_id);

                if (isset($feedbackData)) {
                    foreach ($feedbackData as $oFeedback) {

                        if (isset($oFeedback->category)){
                            if ($oFeedback->category == 'Positive' && !in_array($oFeedback->subscriber_id, $aPositiveSubscribers)) {
                                if (strtotime($oFeedback->created) > $recent) {
                                    $newPositive++;
                                }
                                $positiveRating++;
                                $aPositiveSubscribers[] = $oFeedback->subscriber_id;
                            } else if ($oFeedback->category == 'Neutral' && !in_array($oFeedback->subscriber_id, $aNeutralSubscribers)) {
                                if (strtotime($oFeedback->created) > $recent) {
                                    $newNeutral++;
                                }
                                $neturalRating++;
                                $aNeutralSubscribers[] = $oFeedback->subscriber_id;
                            } else {
                                if (!in_array($oFeedback->subscriber_id, $aNegativeSubscribers))
                                    if (strtotime($oFeedback->created) > $recent) {
                                        $newNegative++;
                                    }
                                $negativeRating++;
                                $aNegativeSubscribers[] = $oFeedback->subscriber_id;
                            }
                        }
                    }
                }
            }

            $getData = '';
            if (isset($offsite_ids) && !empty($offsite_ids)) {

                foreach ($offsite_ids as $value) {
                    if ($value > 0) {
                        $getData = getOffsite($value);

                    }
                }
            }

            $sourceName = isset($getData->name) ? strtolower($getData->name) : '';
            //$sourceName = 'yelp';

            if ($sourceName == 'yelp') {
                $sourceClass = 'txt_red';
            } else if ($sourceName == 'yahoo') {
                $sourceClass = 'txt_purple';
            } else if ($sourceName == 'facebook') {
                $sourceClass = 'txt_dblue';
            } else {
                $sourceClass = 'txt_blue';
            }

            $sourceName = !empty($sourceName) ? $sourceName : 'NA';

            $ratingValue = 'N/A';
            if(isset($feedbackData)){
                if ($feedbackData->category == 'Positive') {
                    $ratingValue = '5.0';
                } else if ($feedbackData->category == 'Neutral') {
                    $ratingValue = '3.0';
                } else if ($feedbackData->category == 'Negative') {
                    $ratingValue = '1.0';
                } else {
                    $ratingValue = 'N/A';
                }
            }
            $ratingSrc = smilyRating($ratingValue);

            $data->metaObj = array(
                'positive' => $positive,
                'negative' => $negative,
                'neutral' => $neutral,
                'revCount' => $revCount,
                'positiveGraph' => $positiveGraph,
                'negativeGraph' => $negativeGraph,
                'neutralGraph' => $neturalGraph,
                'positivePercentage' => $positivePercentage,
                'negativePercentage' => $negativePercentage,
                'neutralPercentage' => $neutralPercentage,
                'positiveRating' => $positiveRating,
                'negativeRating' => $negativeRating,
                'neutralRating' => $neturalRating,
                'newContacts' => $newContacts,
                'newPositive' => $newPositive,
                'newNegative' => $newNegative,
                'newNeutral' => $newNeutral,
                'offsite_ids' => $offsite_ids,
                'lastListTime' => $lastListTime,
                'aPositiveSubscribers' => $aPositiveSubscribers,
                'aNegativeSubscribers' => $aNegativeSubscribers,
                'aNeutralSubscribers' => $aNeutralSubscribers,
                'allSubscribers' => $allSubscribers,
                'offsiteTitle' => $offsiteTitle,
                'sourceName' => $sourceName,
                'sourceClass' => $sourceClass,
                'ratingValue' => @number_format($ratingValue, 1),
                'ratingSrc' => $ratingSrc,
                'subscriberData' => $subscriberData
            );

            $aBrandboosts[$key] = $data;

        }

        return $aBrandboosts;

    }


    /**
     * Used to get show offsite listing page
.     * @param type $param
     * @return type
     */
    public function offsite()
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        Session::put("setTab", '');
        if ($user_role == 1) {
            $aBrandboostList = BrandboostModel::getBrandboost('', 'offsite');
        } else {
            $aBrandboostList = BrandboostModel::getBrandboostByUserId($userID, 'offsite');
        }

        $moduleName = 'brandboost-offsite';

        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Offsite' => ''
        );

        $bActiveSubsription = UsersModel::isActiveSubscription();

        //Do some calculations
        list($canRead, $canWrite) = fetchPermissions('Offsite Campaign');
        $iArchiveCount = $iActiveCount = 0;
        if (!empty($aBrandboostList)) {
            foreach ($aBrandboostList as $oRec) {
                if ($oRec->status == 3) {
                    $iArchiveCount++;
                } else {
                    $iActiveCount++;
                }
            }
        }

        $aBradboosts = $this->processOffsiteOverview($aBrandboostList->items());

        $aData = array(
            'title' => 'Offsite Brand Boost Campaigns',
            'breadcrumb' => $aBreadcrumb,
            'aBrandbosts' => $aBradboosts,
            'allData' => $aBrandboostList,
            'bActiveSubsription' => $bActiveSubsription,
            'currentUserId' => $userID,
            'user_role' => $user_role,
            'moduleName' => $moduleName,
            'viewstats' => false,
            'iActiveCount' => $iActiveCount,
            'iArchiveCount' => $iArchiveCount,
            'canRead' => $canRead,
            'canWrite' => $canWrite
        );

        //return view('admin.brandboost.offsite_list', $aData);
        echo json_encode($aData);
        exit;
    }


    /**
     * Used to update onsite brandboost campaing status
     * @param type $param
     * @return type
     */
    public
    function updateOnsiteStatus(Request $request)
    {

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandboostID = $request->brandboostID;
        $status = $request->status;
        $aBrandboostData = array(
            'status' => $status,
        );
        $result = BrandboostModel::updateBrandboost($userID, $aBrandboostData, $brandboostID);

        //Add User Activity log data
        $aActivityData = array(
            'user_id' => $userID,
            'event_type' => 'brandboost_onsite_status',
            'action_name' => 'change_status_brandboost',
            'brandboost_id' => $brandboostID,
            'campaign_id' => '',
            'inviter_id' => '',
            'subscriber_id' => '',
            'feedback_id' => '',
            'activity_message' => 'New On Site Brandboost status changed',
            'activity_created' => date("Y-m-d H:i:s")
        );
        logUserActivity($aActivityData);

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to update campaign as a archive
     * @param type $param
     * @return type
     */
    public
    static function archiveMultipalBrandboost(Request $request)
    {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $multi_brandboost_id = $request->multi_brandboost_id;

        $aData = array(
            'status' => '3'
        );

        foreach ($multi_brandboost_id as $brandboostID) {

            $result = BrandboostModel::updateBrandboost($userID, $aData, $brandboostID);

            if ($result) {
                //Add User Activity log data
                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_offsite',
                    'action_name' => 'archive_brandboost',
                    'brandboost_id' => $brandboostID,
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Brandboost Archive',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to update campaign as a archive
     * @param type $param
     * @return type
     */
    public
    function deleteBrandboost(Request $request)
    {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $brandboostID = $request->brandboost_id;

        $aData = array(
            'delete_status' => '1'
        );

        $result = BrandboostModel::updateBrandboost($userID, $aData, $brandboostID);

        if ($result) {
            //Add User Activity log data
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'brandboost_onsite_offsite',
                'action_name' => 'deleted_brandboost',
                'brandboost_id' => $brandboostID,
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Brandboost Deleted',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to get branboost embedded code
     * @param type $param
     * @return type
     */
    public
    function getBBECode(Request $request)
    {

        $response = array();

        $brandboostID = $request->brandboost_id;

        $result = BrandboostModel::getBrandboost($brandboostID);

        if ($result) {
            $response['status'] = 'success';
            $campaign_key = $result[0]->hashcode;
            $sWidget = $result[0]->widget_type;
            $response['result'] = htmlentities('<script type="text/javascript" id="bbscriptloader" data-key="' . $campaign_key . '" data-widgets="' . $sWidget . '" async="" src="' . base_url('assets/js/widgets.js') . '"></script>');
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to get offsite config data by brandboost id
     * @param type $brandboostID
     * @return type
     */
    public
    function offsiteSetup(Request $request, $brandboostID)
    {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (empty($brandboostID)) {
            redirect("admin/brandboost/offsite");
            exit;
        }

        $selectedTab = $request->input('t');
        $oBrandboost = BrandboostModel::getBrandboost($brandboostID);
        if (empty($oBrandboost) || $oBrandboost[0]->user_id != $userID) {
            redirect("admin/brandboost/offsite");
            exit;
        }

        $moduleName = 'brandboost';
        $moduleUnitID = $brandboostID;


        $oFeedbackResponse = FeedbackModel::getFeedbackResponse($brandboostID);

        $oCampaignSubscribers = WorkflowModel::getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $eventsdata = BrandboostModel::getBrandboostEvents($brandboostID);
        $offSiteReviews = BrandboostModel::getAllOffsiteReviews($brandboostID);

        $offsite_ids = $oBrandboost[0]->offsite_ids;
        $offsite_ids = unserialize($offsite_ids);
        $offsiteGlue = $offsite_ids = @implode(",", $offsite_ids);
        $slinks = $oBrandboost[0]->offsites_links;
        $offsites_links = unserialize($slinks);
        //$totalSocialIcon = OffsiteModel::offsite_count_all_edit('', $offsite_ids);
        $totalSocialIcon = 5;
        $offstepdata = OffsiteModel::getOffsite();
        $feedbackData = FeedbackModel::getFeedbackByBrandboostID($brandboostID);
        $emailTemplate = BrandboostModel::getAllCampaignTemplatesByUserID($userID, 'offsite');
        $smsTemplate = BrandboostModel::getAllSMSCampaignTemplatesByUserID($userID, 'offsite');
        $oTemplates = TemplatesModel::getCommonTemplates();
        $oCategories = TemplatesModel::getCommonTemplateCategories();


        $oEvents = WorkflowModel::getWorkflowEvents($brandboostID, $moduleName);
        $oEventsType = array('send-invite', 'followup');
        $oCampaignTags = WorkflowModel::getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = WorkflowModel::getWorkflowDefaultTemplates($moduleName, 'offsite');

        $setTab = Session::get("setTab");
        $offsiteIds = explode(',', $offsite_ids);



        if($offstepdata->isNotEmpty()){
            foreach($offstepdata as $data){
                $aSource = @unserialize($data->site_categories);
                $data->site_categories_array = $aSource;
            }
        }
        if (!empty($offsiteIds)) {
            foreach ($offsiteIds as $value) {
                if (!empty($value) && $value > 0) {
                    $getData = getOffsite($value);
                    if (!empty($getData)) {
                        $setTab = 'Review Sources';
                    }
                }
            }
        } else {
            $setTab = 'Review Sources';
        }


        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Offsite' => '#/reviews/offsite',
            'Setup' => '',
        );



        $aData = array(
            'title' => 'Offsite Brand Boost Campaign',
            'breadcrumb' => $aBreadcrumb,
            'getOffsite' => $oBrandboost,
            'bActiveSubsription' => $bActiveSubsription,
            'feedbackResponse' => $oFeedbackResponse,
            'brandboostData' => $oBrandboost[0],
            'eventsData' => $eventsdata,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $brandboostID,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'oTemplates' => $oTemplates,
            'oCategories' => $oCategories,
            'subscribersData' => $oCampaignSubscribers,// $allSubscribers,
            'totalSocialIcon' => $totalSocialIcon,
            'result' => $feedbackData,
            'setTab' => $setTab,
            'selectedTab' => $selectedTab,
            'brandboostID' => $brandboostID,
            'offSiteData' => $offstepdata,
            'offsiteIds' => $offsiteGlue,
            'offSiteReviews' => $offSiteReviews,
            'emailTemplate' => $emailTemplate,
            'smsTemplate' => $smsTemplate,
            'offsites_links'=> $offsites_links,
            'aUserInfo' => $aUser
        );
        echo json_encode($aData);
        die;
        //return view('admin.brandboost.offsite_setup', $aData);
    }


    /**
     * Used to get widget overview related data
     * @return type
     */
    public
    function widgetOverview()
    {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
            <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Onsite Widgets" class="sidebar-control active hidden-xs ">Overview</a></li>
            </ul>';

        $aUser = getLoggedUser();
        $clientID = $aUser->id;
        $oLiveData = LiveModel::getLiveData($clientID);
        $oCurrentLiveData = LiveModel::getCurrentLiveData($clientID);
        $chatWidget = LiveModel::chatWidget($clientID);
        $brandboostOnsiteWidget = LiveModel::brandboostWidget($clientID, 'onsite');
        $brandboostOffsiteWidget = LiveModel::brandboostWidget($clientID, 'offsite');

        $aData = array(
            'title' => 'Widgets Overview',
            'pagename' => $breadcrumb,
            'oLiveData' => $oLiveData,
            'oCurrentLiveData' => $oCurrentLiveData,
            'chatWidget' => $chatWidget,
            'bOnsiteWidget' => $brandboostOnsiteWidget,
            'bOffsiteWidget' => $brandboostOffsiteWidget
        );

        //$this->template->load('admin/admin_template_new', 'admin/brandboost/widget_overview', $aData);
        return view('admin.brandboost.widget_overview', $aData);
    }


    /**
     * Used to get onsite widget data list
     * @return type
     */
    public
    function widgets()
    {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;
        if ($user_role == 1) {
            $oWidgetsList = BrandboostModel::getBBWidgets('', '', 'onsite');
        } else {
            $oWidgetsList = BrandboostModel::getBBWidgets('', $userID, 'onsite');
        }

        $oStats = BrandboostModel::getBBWidgetStats($userID, 'owner_id');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Onsite Widgets" class="sidebar-control active hidden-xs ">Onsite Widgets</a></li>
			</ul>';

        $bActiveSubsription = UsersModel::isActiveSubscription();
        Session::put("setTab", '');

        $aData = array(
            'title' => 'Onsite Widgets',
            'pagename' => $breadcrumb,
            'oWidgetsList' => $oWidgetsList,
            'bActiveSubsription' => $bActiveSubsription,
            'oStats' => $oStats,
            'user_role' => $user_role
        );

        return view('admin.brandboost.widget_list', $aData);
    }


    /**
     * Used to get offsite campaign preference
     * @return type
     */
    public
    function campaignPreferences(Request $request)
    {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandboostID = $request->brandboostID;
        $oBrandboost = BrandboostModel::getBrandboost($brandboostID);
        $brandboostData = $oBrandboost[0];

        $offsites_links = $brandboostData->offsites_links;
        $offsites_links = unserialize($offsites_links);

        $offsite_ids = $brandboostData->offsite_ids;
        $offsite_ids = unserialize($offsite_ids);
        if (!empty($offsite_ids)) {
            $selected_list = implode(",", $offsite_ids);
        } else {
            $selected_list = 0;
        }
        $socialsList = '';
        if (!empty($offsite_ids)) {
            $thumbColor = array('bkg1', 'bkg2', 'bkg3', 'bkg4', 'bkg5', 'bkg6');

            foreach ($offsite_ids as $value) {
                if (!empty($value) && $value > 0) {
                    $getData = getOffsite($value);
                    if (!empty($getData)) {
                        $inc = rand(0, 5);
                        $getLinksSocial = $offsites_links[$getData->id]['link'];

                        $sourceName = strtolower($getData->name);
                        if ($sourceName == 'yelp') {
                            $sourceClass = 'txt_red';
                            $thumbclass = 'bkg2';
                        } else if ($sourceName == 'google') {
                            $sourceClass = 'txt_blue';
                            $thumbclass = 'bkg1';
                        } else if ($sourceName == 'yahoo') {
                            $sourceClass = 'txt_purple';
                            $thumbclass = 'bkg5';
                        } else if ($sourceName == 'facebook') {
                            $sourceClass = 'txt_dblue';
                            $thumbclass = 'bkg3';
                        } else {
                            $sourceClass = 'txt_blue';
                            $thumbclass = 'bkg1';
                        }
                        $sourceName = !empty($sourceName) ? $sourceName : 'NA';


                        $socialsList .= '<li class="media panel-body stack-media-on-mobile" id="socialIcon' . $value . '">
                            <div class="media-left"> <a class="' . $thumbclass . '" href="javascript:void(0);">';

                        if (in_array('OtherSources', unserialize($getData->site_categories))) {
                            $socialsList .= '<i class="icon-' . $sourceName . ' ' . $sourceClass . ' socialIcon" style="font-style:inherit">M</i>';
                        } else {

                            //$socialsList .= '<i class="icon-' . $sourceName . ' ' . $sourceClass . ' socialIcon"></i>';

                            $socialsList .= '<img src="/uploads/' . $getData->image . '" height="45" width="45">';
                        }

                        $socialsList .= '</a> </div>
                            <div class="media-body">
							<div class="col-md-12 mb-10 pl0 pr0">
							<h5>' . $getData->name . '</h5>
							<h6>';
                        if (in_array('OtherSources', unserialize($getData->site_categories))) {
                            $getLinksSocial = $getLinksSocial != '' ? $getLinksSocial : $getData->website_url;
                            $socialsList .= str_replace("www.", "", preg_replace('#^https?://#', '', $getLinksSocial));
                        } else {

                            $socialsList .= preg_replace('#^https?://#', '', $getData->website_url);
                        }


                        $socialsList .= '</h6>';
                        $socialsList .= '</div>
							<div class="col-md-12 pl0 pr0">
							<div class="input-group">';
                        if (in_array('OtherSources', unserialize($getData->site_categories))) {

                            $socialsList .= '<input style="text-align:left;" class="form-control autoSave siteURLId_' . $getData->id . '" autocomplete="off" linkid="' . $getData->id . '" id="linkUrl' . $getData->id . '" name="offsite_url[]" value="' . ($getLinksSocial != '' ? $getLinksSocial : $getData->website_url) . '" placeholder="Enter Web Address" type="text" required="required">';
                        } else {
                            $socialsList .= '<span class="input-group-addon" style="padding-right: 0;">' . $getData->website_url . '</span>';

                            $socialsList .= '<input class="form-control autoSave siteURLId_' . $getData->id . '" autocomplete="off" linkid="' . $getData->id . '" id="linkUrl' . $getData->id . '" name="offsite_url[]" value="' . ($getLinksSocial != '' ? $getLinksSocial : '') . '" placeholder="Enter Web Address" type="text" required="required">';
                        }

                        $socialsList .= '<input type="hidden" name="offsite_id[]" value="' . $getData->id . '">
							</div>
							</div>
                            </div>
                            <div class="media-right text-nowrap">
							<button type="button" class="btn save white_btn previewButton" siteUrl="' . $getData->website_url . '" siteId="' . $getData->id . '">Preview </button> &nbsp;
							<button type="button" style="padding: 4px 20px!important" class="btn save dark_btn getReview linkurlC"  bbID="' . $brandboostID . '" linkid="' . $getData->id . '">Save </button>
							<button type="submit" class="offsite_selected_r cancle" offsiteSelected="1" offsiteId="' . $getData->id . '"><i class="fa fa-close"></i></button>
                            </div>
							</li>';
                    }
                }
            }
        }

        $response = array('status' => 'success', 'socialList' => $socialsList, 'selectedList' => $selected_list);
        echo json_encode($response);
        exit;
    }


    /**
     * Used to add and edit offsite campaign preference
     * @return type
     */
    public
    function addOffsiteEdit(Request $request)
    {

        $response = array();
        $userID = Session::get("current_user_id");
        $offset_id = $request->offstepIds;

        $offstepIds = serialize($offset_id);
        $brandboostID = $request->brandboostID;
        $aData = array(
            'offsite_ids' => $offstepIds
        );

        $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID);

        if ($result) {
            Session::put("setTab", 'Campaign Preferences');
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to add offsite resources
     * @return type
     */
    public
    function addOffsiteResources(Request $request)
    {

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $brandboostID = $request->brandboostID;
        $selected_list = $request->selected_list;
        $socialId = $request->offsiteId;

        $getBrandboost = BrandboostModel::getBrandboost($brandboostID);
        $getBrand = unserialize($getBrandboost[0]->offsites_links);
        unset($getBrand[$socialId]);
        $selected_list = explode(",", $selected_list);

        $aData = array(
            'offsite_ids' => serialize($selected_list),
            'offsites_links' => serialize($getBrand)
        );

        $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to add offsite url link
     * @return type
     */
    public
    function addOffsiteUrl(Request $request)
    {

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandboostID = $request->brandboostID;

        $review_expire = $request->review_expire;
        $review_expire_link = $request->review_expire_link;
        $revExpireLink = array();
        if ($review_expire_link == 'custom') {
            $txtInteger = $request->txtInteger;
            $exp_duration = $request->exp_duration;
            $revExpireLink['delay_value'] = $txtInteger;
            $revExpireLink['delay_unit'] = $exp_duration;
        } else {
            $revExpireLink['delay_value'] = 'never';
            $revExpireLink['delay_unit'] = 'never';
        }


        $offsite_id = $request->offsite_id;
        $offsite_url = $request->offsite_url;
        $edit_campaignName = $request->edit_campaignName;
        $selected_list = $request->selected_list;
        $selected_list = explode(",", $selected_list);

        $newOffsiteUrl = array();
        $oReviewSources = OffsiteModel::getOffsite();
        if (!empty($oReviewSources)) {
            foreach ($oReviewSources as $oWebsite) {
                $oSources[$oWebsite->id] = $oWebsite;
            }
        }
        $inc = 0;
        foreach ($offsite_id as $val) {
            //get source info
            $oSourceInfo = $oSources[$val];
            $newOffsiteUrl[$val]['source'] = $oSourceInfo->name;
            $newOffsiteUrl[$val]['link'] = $offsite_url[$inc];
            $newOffsiteUrl[$val]['longurl'] = $oSourceInfo->website_url . $offsite_url[$inc];
            $newOffsiteUrl[$val]['shorturl'] = base_url('r/' . $brandboostID . '/' . $val);
            $inc++;
        }
        $offsiteUrl = serialize($newOffsiteUrl);
        $storeURL = $request->store_url;
        $aData = array(
            'offsites_links' => $offsiteUrl,
            'brand_title' => $edit_campaignName,
            'offsite_ids' => serialize($selected_list),
            'link_expire_review' => $review_expire,
            'link_expire_custom' => json_encode($revExpireLink),
            'store_url' => $storeURL
        );

        $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID);

        $feedback_type = $request->feedback_type;
        $ratings_type = $request->ratings_type;
        $from_name = $request->from_name;
        $from_email = $request->from_email;
        $sender_name = $request->sender_name;
        $offsite_url = $request->offsite_url;
        $positive_title = $request->positive_title;
        $positive_subtitle = $request->positive_subtitle;
        $negetive_title = $request->negetive_title;
        $negetive_subtitle = $request->negetive_subtitle;
        $neutral_title = $request->neutral_title;
        $neutral_subtitle = $request->neutral_subtitle;


        $feedbackData = array(
            'brandboost_id' => $brandboostID,
            'feedback_type' => $feedback_type,
            'ratings_type' => $ratings_type,
            'from_name' => $from_name,
            'from_email' => $from_email,
            'sms_sender' => $sender_name,
            'pos_title' => $positive_title,
            'pos_sub_title' => $positive_subtitle,
            'neg_title' => $negetive_title,
            'neg_sub_title' => $negetive_subtitle,
            'neu_title' => $neutral_title,
            'neu_sub_title' => $neutral_subtitle,
            'created' => date("Y-m-d H:i:s")
        );
        $aResponse = FeedbackModel::getFeedbackResponse($brandboostID);
        if (!empty($aResponse)) {
            $result = BrandboostModel::updateBrandboostFeedbackResponse($feedbackData, $brandboostID);
        } else {
            $result = BrandboostModel::addBrandboostFeedbackResponse($feedbackData);
        }

        if ($result) {
            //Okay We also need to update "From" info into the campaigns
            $this->updateWorkflowFromInfo($feedbackData, $brandboostID);

            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to continue offsite steps
     * @return type
     */
    public
    function continueStepOffsite(Request $request)
    {

        $response = array();

        $targetName = $request->targetName;
        $brandboostID = $request->brandboostID;
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($targetName == '' && $brandboostID > 0) {
            $aData = array(
                'status' => 1
            );

            $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID);
            $response['public'] = 1;
        } else {
            Session::put("setTab", $targetName);
            $response['public'] = 0;
        }
        $response['status'] = 'success';
        echo json_encode($response);
        exit;
    }


    /**
     * Used to update subscriber status
     * @return type
     */
    public
    function updateSubscriberStatus(Request $request)
    {

        $response = array();
        $status = $request->status;
        $subscriberId = $request->subscriber_id;

        $aData = array(
            'status' => $status
        );

        $result = ReviewlistsModel::updateSubscriber($aData, $subscriberId);
        if ($result) {
            //Add Useractivity log
            $actionName = ($status == 1) ? 'user_active' : 'user_inactive';
            $aUser = getLoggedUser();
            $userID = $aUser->id;

            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'brandboost_onsite_offsite',
                'action_name' => $actionName,
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => $subscriberId,
                'feedback_id' => '',
                'activity_message' => 'Brandboost user was made ' . ($status == 1) ? 'active' : 'inactive',
                'activity_created' => date("Y-m-d H:i:s")
            );

            logUserActivity($aActivityData);

            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete review request
     * @return type
     */
    public
    function deleteRRrecord(Request $request)
    {
        $response = array();
        $recordId = $request->recordId;
        $result = BrandboostModel::deleteReviewRequest($recordId);
        if ($result) {
            //Add  log
            $aUser = getLoggedUser();
            $userID = $aUser->id;

            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'request_review_deleted',
                'action_name' => 'request_review_deleted',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Review request deleted',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to update offsite workflow from info by brandboost id
     * $param type $brandboostID
     * @return type
     */
    public
    function updateWorkflowFromInfo($aData, $brandboostID)
    {
        if (!empty($brandboostID)) {
            $eventsdata = BrandboostModel::getBrandboostEvents($brandboostID);
            if (!empty($eventsdata)) {
                foreach ($eventsdata as $aEvent) {
                    $eventID = $aEvent->id;
                    if (!empty($eventID)) {
                        $aCampaigns = getCampaignsByEventID($eventID);
                        if (!empty($aCampaigns)) {
                            foreach ($aCampaigns as $aCampaign) {
                                $aUpdateData = array();
                                $campaignID = $aCampaign->id;
                                if (!empty($aData['from_name'])) {
                                    $aUpdateData['from_name'] = $aData['from_name'];
                                }

                                if (!empty($aData['from_email'])) {
                                    $aUpdateData['from_email'] = $aData['from_email'];
                                }
                                if (!empty($aUpdateData)) {
                                    $bUpdated = BrandboostModel::updateCampaing($aUpdateData, $campaignID);
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    /**
     * Used to get onsite widget configuration settings by widget id
     * $param type $widgetID
     * @return type
     */
    public
    function onsiteWidgetSetup($widgetID)
    {
        $selectedTab = Request::input("t");
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (!empty($selectedTab)) {
            if (in_array($selectedTab, array('Review Sources', 'Configure Widgets', 'Integration'))) {
                //set required session
                Session::put("setTab", $selectedTab);
            }
        } else {
            $setTab = Session::get('setTab');
            if ($setTab == '') {
                Session::put("setTab", 'Review Sources');
            }
        }

        if (empty($widgetID)) {
            redirect("admin/brandboost/widgets");
            exit;
        }

        $oBrandboostList = BrandboostModel::getBrandboostByUserId($userID, 'onsite');
        $oWidgets = BrandboostModel::getBBWidgets($widgetID);
        $oStats = BrandboostModel::getBBWidgetStats($widgetID);
        $widgetThemeData = BrandboostModel::getWidgetThemeByUserID($userID);
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $setTab = Session::get("setTab");

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/brandboost/widgets') . '" class="sidebar-control hidden-xs">Onsite Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="' . $oWidgets[0]->widget_title . '" class="sidebar-control active hidden-xs ">' . $oWidgets[0]->widget_title . '</a></li>
			</ul>';

        $aData = array(
            'title' => 'Onsite Widget',
            'pagename' => $breadcrumb,
            'oWidgets' => $oWidgets,
            'bActiveSubsription' => $bActiveSubsription,
            'widgetData' => $oWidgets[0],
            'oBrandboostList' => $oBrandboostList,
            'oStats' => $oStats,
            'setTab' => $setTab,
            'widgetID' => $widgetID,
            'widgetThemeData' => $widgetThemeData,
            'selectedTab' => $selectedTab
        );

        return view('admin.brandboost.onsite_widget_setup', $aData);
    }


    /**
     * Used to set onsite widget
     * @return type
     */
    public
    function setOnsiteWidget(Request $request)
    {
        $response = array("status" => "error", "msg" => "Something went wrong");

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $widgetTypeID = $request->widgetTypeID;
        $widgetID = $request->widgetID;
        $aData = array(
            'widget_type' => $widgetTypeID
        );

        if (!empty($widgetID)) {
            Session::put("selectedOnsiteWidget", $widgetID);
            $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);
            $response = array("status" => "success", "msg" => "Okay");
            echo json_encode($response);
            exit;
        }
    }

    /**
     * Used to add onsite brandboost widget data
     * @return type
     */
    public
    function addBrandBoostWidgetData(Request $request)
    {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        $brandboostID = $request->campaign_id;
        $title = $request->title;
        $desc = $request->desc;
        $bAllowComment = $request->allow_comment;
        $bAllowVideoReview = $request->allow_video_reviews;
        $bAllowHelpful = $request->allow_helpful;
        $bAllowLiveReading = $request->allow_live_reading;
        $bAllowRatings = $request->allow_ratings;
        $bAllowTimestamp = $request->allow_timestamp;
        $bAllowProsCons = $request->allow_pros_cons;
        $bgColor = $request->bg_color;
        $textColor = $request->text_color;
        $pro_cons = $request->pro_cons;
        $domainName = $request->domain_name;
        $ratingValue = $request->ratingValue;
        $bbDisplay = $request->bbDisplay;
        $widgetID = $request->edit_widgetId;
        $alternativeDesign = $request->alternative_design;
        $allowCampaignName = $request->allow_campaign_name;
        $reviewsOrderBy = $request->reviews_order_by;
        $reviewsOrder = $request->reviews_order;
        $numofrev = $request->numofrev;
        $logoImageFileName = $request->logo_img == '' ? $request->edit_logo_img : $request->logo_img;
        $review_expire = $request->review_expire;
        $review_expire_link = $request->review_expire_link;
        $revExpireLink = array();
        if ($review_expire_link == 'custom') {

            $txtInteger = $request->txtInteger;
            $exp_duration = $request->exp_duration;
            $revExpireLink['delay_value'] = $txtInteger;
            $revExpireLink['delay_unit'] = $exp_duration;
        } else {

            $revExpireLink['delay_value'] = 'never';
            $revExpireLink['delay_unit'] = 'never';
        }


        $aData = array(
            'user_id' => $userID,
            //'brandboost_id' => $brandboostID,
            'brand_title' => $title,
            'brand_desc' => $desc,
            //'widget_img' => $brandImageFileName,
            'logo_img' => $logoImageFileName,
            'allow_comments' => $bAllowComment,
            'allow_video_reviews' => $bAllowVideoReview,
            'allow_helpful_feedback' => $bAllowHelpful,
            'allow_live_reading_review' => $bAllowLiveReading,
            'allow_comment_ratings' => $bAllowRatings,
            'allow_review_timestamp' => $bAllowTimestamp,
            'allow_pros_cons' => $bAllowProsCons,
            'alternative_design' => $alternativeDesign,
            'allow_campaign_name' => $allowCampaignName,
            'bg_color' => $bgColor,
            'text_color' => $textColor,
            'num_of_review' => $numofrev,
            'domain_name' => $domainName,
            'pro_cons' => $pro_cons,
            'often_bb_display' => $bbDisplay,
            'min_ratings_display' => $ratingValue,
            'link_expire_review' => $review_expire,
            'reviews_order' => $reviewsOrder,
            'reviews_order_by' => $reviewsOrderBy,
            'link_expire_custom' => json_encode($revExpireLink)
        );


        $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to save preview data
     * @return type
     */
    public
    function savePreviewData(Request $request)
    {

        $response = array();
        $brandboostID = Session::get('brandboostID');
        $userID = Session::get("current_user_id");

        $fieldName = $request->field_name;
        $fieldValue = $request->field_value;

        $aData = array(
            $fieldName => $fieldValue
        );

        $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to add brandboost widget design
     * @return type
     */
    public
    function addBrandBoostWidgetDesign(Request $request)
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();

        $company_logo = $request->company_logo;
        $allow_branding = $request->allow_branding != '' ? '1' : '0';
        $notification = $request->notification != '' ? '1' : '0';
        $company_info_switch = $request->company_info_switch != '' ? '1' : '0';
        $widgetID = $request->edit_widgetId;
        $solid_color = $request->solid_color;
        $main_colors = $request->main_colors;
        $custom_colors1 = $request->custom_colors1;
        $custom_colors2 = $request->custom_colors2;
        $main_color_switch = $request->widget_bgcolor_switch == 1 ? '1' : '0';
        $custom_color_switch = $request->widget_bgcolor_switch == 2 ? '1' : '0';
        $solid_color_switch = $request->widget_bgcolor_switch == 3 ? '1' : '0';
        $custom_company_name = $request->custom_company_name;
        $custom_company_description = $request->custom_company_description;

        $widget_font_color = $request->widget_font_color;
        $widget_border_color = $request->widget_border_color;
        $widget_position = $request->widget_position;
        $widget_themes = $request->widget_themes;
        $icon_type = $request->icon_type;
        $color_orientation = $request->color_orientation;

        $solid_color_rating = $request->solid_color_rating;
        $main_colors_rating = $request->main_colors_rating;
        $custom_colors_rating1 = $request->custom_colors_rating1;
        $custom_colors_rating2 = $request->custom_colors_rating2;
        $main_color_switch_rating = $request->main_color_switch_rating != '' ? '1' : '0';

        $aData = array(
            'user_id' => $userID,
            'widget_font_color' => $widget_font_color,
            'widget_border_color' => $widget_border_color,
            'widget_position' => $widget_position,
            'widget_themes' => $widget_themes,
            'icon_type' => $icon_type,
            'color_orientation' => $color_orientation,
            'header_color' => $main_colors,
            'header_solid_color' => $solid_color,
            'header_custom_color1' => $custom_colors1,
            'header_custom_color2' => $custom_colors2,
            'header_color_solid' => $solid_color_switch,
            'header_color_fix' => $main_color_switch,
            'header_color_custom' => $custom_color_switch,
            'company_logo' => $company_logo,
            'allow_branding' => $allow_branding,
            'notification' => $notification,
            'company_info' => $company_info_switch,
            'company_info_name' => $custom_company_name,
            'company_info_description' => $custom_company_description,
            'rating_color' => $main_colors_rating,
            'rating_solid_color' => $solid_color_rating,
            'rating_custom_color1' => $custom_colors_rating1,
            'rating_custom_color2' => $custom_colors_rating2,
            'rating_color_fix' => $main_color_switch_rating
        );


        $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update brandboost widget campaign
     * @return type
     */
    public
    function addBrandBoostWidgetCampaign(Request $request)
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();

        $widgetID = $request->campaign_widget_id;
        $campaignId = $request->campaign_id;

        $aData = array(
            'brandboost_id' => $campaignId
        );


        $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to publish onsite brandboost status
     * @return type
     */
    public
    function publishOnsiteStatusBB(Request $request)
    {

        $response = array();
        $brandboostID = $request->brandboostID;
        $status = $request->status;

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($brandboostID)) {

            $mWorkflow = new WorkflowModel();
            $moduleName = 'brandboost';
            $moduleUnitID = $brandboostID;

            /**
             * $aData = array(
             * 'status' => $status,
             * );
             *
             * $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID); */

            $result = $mWorkflow->launchWorkflowCampaign($moduleName, $moduleUnitID);

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }

        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to save onsite preference
     * @return type
     */
    public
    function saveOnsitePreferences(Request $request)
    {

        $response = array();
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $brandboostID = $request->brandboostId;
        $review_expire = $request->review_expire;
        $review_expire_link = $request->review_expire_link;

        $productName = $request->brand_product_name;
        $productDesc = $request->brand_product_desc;
        $productImg = $request->product_img;
        $productType = $request->product_type;
        $productId = $request->product_id;

        $pData = array();

        if (!empty($productName)) {
            $pData['brandboost_id'] = $brandboostID;
            $pData['user_id'] = $userID;
            foreach ($productName as $key => $productData) {
                if ($productData != '') {
                    $bbProductsData = BrandboostModel::getProductDataByOrder($brandboostID, $key);
                    $pData['product_name'] = $productData;
                    $pData['product_description'] = $productDesc[$key];
                    $pData['product_image'] = $productImg[$key];
                    $pData['product_type'] = $productType[$key];
                    $pData['product_order'] = $key;
                    if ($productName[$key] != '') {
                        if ((!empty($bbProductsData)) && (count($bbProductsData) > 0)) {
                            BrandboostModel::updateProductData($pData, $brandboostID, $key);
                        } else {
                            BrandboostModel::insertProductData($pData);
                        }
                    } else {
                        BrandboostModel::updateProductByProductId($pData, $brandboostID, $productId[$key]);
                    }
                }
            }
        }


        $revExpireLink = array();
        if ($review_expire_link == 'custom') {

            $txtInteger = $request->txtInteger;
            $exp_duration = $request->exp_duration;
            $revExpireLink['delay_value'] = $txtInteger;
            $revExpireLink['delay_unit'] = $exp_duration;
        } else {

            $revExpireLink['delay_value'] = 'never';
            $revExpireLink['delay_unit'] = 'never';
        }
        $aData = array(
            'link_expire_review' => $review_expire,
            'link_expire_custom' => json_encode($revExpireLink)
        );

        $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID);

        // Update a image

        $title = $request->title;
        $desc = $request->desc;
        $domainName = $request->domain_name;
        /*$barndFileData = $request->brand_img;
		$brandFileArray = array();

		foreach ($barndFileData['media_url'] as $key => $fileData) {
			$brandFileArray[$key]['media_url'] = $fileData;
			$brandFileArray[$key]['media_type'] = $barndFileData['media_type'][$key];
		}*/

        $logoImageFileName = $request->logo_img == '' ? $request->edit_logo_img : $request->logo_img;
        //$brandImageFileName = empty($request->brand_img) ? $request->edit_brand_img : serialize($brandFileArray);
        $brandImageFileName = '';

        $aDataBrandboost = array(
            'user_id' => $userID,
            'brand_title' => $title,
            'brand_desc' => $desc,
            'domain_name' => $domainName,
            'brand_img' => $brandImageFileName,
            'logo_img' => $logoImageFileName
        );
        $result = BrandboostModel::updateBrandBoost($userID, $aDataBrandboost, $brandboostID);

        // Update image


        $feedback_type = $request->feedback_type;
        $ratings_type = $request->ratings_type;
        $from_name = $request->from_name;
        $from_email = $request->from_email;
        $sender_name = $request->sender_name;
        $offsite_url = $request->offsite_url;
        $positive_title = $request->positive_title;
        $positive_subtitle = $request->positive_subtitle;
        $negetive_title = $request->negetive_title;
        $negetive_subtitle = $request->negetive_subtitle;
        $neutral_title = $request->neutral_title;
        $neutral_subtitle = $request->neutral_subtitle;

        $feedbackData = array(
            'brandboost_id' => $brandboostID,
            'feedback_type' => $feedback_type,
            'ratings_type' => $ratings_type,
            'from_name' => $from_name,
            'from_email' => $from_email,
            'sms_sender' => $sender_name,
            'pos_title' => $positive_title,
            'pos_sub_title' => $positive_subtitle,
            'neg_title' => $negetive_title,
            'neg_sub_title' => $negetive_subtitle,
            'neu_title' => $neutral_title,
            'neu_sub_title' => $neutral_subtitle,
            'created' => date("Y-m-d H:i:s")
        );
        $aResponse = FeedbackModel::getFeedbackResponse($brandboostID);
        if (isset($aResponse->id)) {
            $result = BrandboostModel::updateBrandboostFeedbackResponse($feedbackData, $brandboostID);
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'brandboost_onsite',
                'action_name' => 'updated_preferrences',
                'brandboost_id' => $brandboostID,
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Updated On site Brandboost Preferrences',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
        } else {
            $result = BrandboostModel::addBrandboostFeedbackResponse($feedbackData);
        }

        if ($result) {
            //Okay We also need to update "From" info into the campaigns

            $this->updateWorkflowFromInfo($feedbackData, $brandboostID);

            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }
    function saveOnsiteSettings(Request $request)
    {

        $response = array();
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $brandboostID = $request->brandboostId;
        $fieldName = $request->fieldName;
        $fieldValue = $request->fieldVal;
        $type = $request->requestType;

        $aProductData = [];
        $aBrandboostData = [];
        $aFeedbackData = [];
        $aExpiryData = [];
        if (!empty($fieldName) && $brandboostID > 0) {
            if ($type == 'product') {
                $aProductData[$fieldName] = $fieldValue;
            } else if ($type == 'brandboost') {
                $aBrandboostData[$fieldName] = $fieldValue;
                $result = BrandboostModel::updateBrandBoost($userID, $aBrandboostData, $brandboostID);
            } else if ($type == 'feedback') {
                $aFeedbackData[$fieldName] = $fieldValue;
                $aResponse = FeedbackModel::getFeedbackResponse($brandboostID);
                if (isset($aResponse->id)) {
                    $result = BrandboostModel::updateBrandboostFeedbackResponse($aFeedbackData, $brandboostID);
                } else {
                    $aFeedbackData['brandboost_id'] = $brandboostID;
                    $aFeedbackData['created'] = date("Y-m-d H:i:s");
                    $result = BrandboostModel::addBrandboostFeedbackResponse($aFeedbackData);
                }
            }else if($type == 'expiry'){
                $aLinkExpiryData = [];
                $txtInteger = $exp_duration = '';
                if ($fieldValue == 'custom' || $fieldName == 'txtInteger'  || $fieldName == 'exp_duration') {
                    $aExpiry = $request->linkExpiryData;
                    $aExpData = json_decode($aExpiry);
                    if($fieldValue == 'txtInteger'){
                        $txtInteger = $fieldValue;
                        $exp_duration = $aExpData['delay_unit'];
                    }

                    if($fieldValue == 'exp_duration'){
                        $exp_duration = $fieldValue;
                        $txtInteger = $aExpData['delay_unit'];
                    }

                    $aLinkExpiryData['delay_value'] = $txtInteger;
                    $aLinkExpiryData['delay_unit'] = $exp_duration;
                } else {

                    $aLinkExpiryData['delay_value'] = 'never';
                    $aLinkExpiryData['delay_unit'] = 'never';
                }

                if($fieldValue == 'never'){
                    $aExpiryData[$fieldName] = $fieldValue;
                }else{
                    $aExpiryData['link_expire_custom'] = json_encode($aLinkExpiryData);
                }

                $result = BrandboostModel::updateBrandBoost($userID, $aExpiryData, $brandboostID);

            }
        }


        if ($result) {
            //Okay We also need to update "From" info into the campaigns

            //$this->updateWorkflowFromInfo($feedbackData, $brandboostID);

            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }
    /**
     * Used to save onsite widget
     * @return type
     */
    public
    function addOnsiteWidget(Request $request)
    {

        $response = array();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;

        $campaignName = $request->campaignName;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hashcode = '';
        for ($i = 0; $i < 20; $i++) {
            $hashcode .= $characters[rand(0, strlen($characters))];
        }
        $hashcode = $hashcode . date('Ymdhis');
        $aData = array(
            'review_type' => 'onsite',
            'user_id' => $userID,
            'widget_title' => $campaignName,
            'status' => 0,
            'hashcode' => md5($hashcode),
            'created' => date("Y-m-d H:i:s")
        );

        $widgetID = BrandboostModel::addWidget($aData);

        if ($widgetID) {

            Session::put('widgetID', $widgetID);
            $response['status'] = 'success';
            $response['widgetID'] = $widgetID;

            //Add userActivity
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'brandboost_onsite_widget',
                'action_name' => 'added_brandboost_widget',
                'widget_id' => $widgetID,
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'New On Site Widget added',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            //Notify about this to admin
            $notificationData = array(
                'event_type' => 'added_onsite_widget',
                'event_id' => 0,
                'link' => base_url() . 'admin/brandboost/onsite_widget_setup/' . $widgetID,
                'message' => 'Created new on site widget.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'added_onsite_widget';
            add_notifications($notificationData, $eventName, $userID);
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete onsite widget
     * @return type
     */
    public
    function deleteBrandboostWidget(Request $request)
    {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $widgetID = $request->widget_id;

        $aData = array(
            'delete_status' => '1'
        );

        $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);

        if ($result) {
            //Add Useractivity log

            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'brandboost_onsite_offsite',
                'action_name' => 'deleted_widget',
                'widget_id' => $widgetID,
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Brandboost Widget Deleted',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get onsite widget embedded code
     * @return type
     */
    public
    function getOnsiteWidgetEmbedCode(Request $request)
    {

        $response = array();

        $widgetID = $request->widget_id;

        $result = BrandboostModel::getBBWidgets($widgetID);

        if ($result) {
            $response['status'] = 'success';
            $campaign_key = $result[0]->hashcode;
            $sWidget = $result[0]->widget_type;
            $response['result'] = htmlentities('<script type="text/javascript" id="bbscriptloader" data-key="' . $campaign_key . '" data-widgets="' . $sWidget . '" async="" src="' . base_url('assets/js/widgets.js') . '"></script>');
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update onsite widget status
     * @return type
     */
    public
    function updateOnsiteWidgetStatus(Request $request)
    {

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $widgetID = $request->widgetID;
        $status = $request->status;
        $aData = array(
            'status' => $status,
        );
        $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update onsite widget as a archive
     * @return type
     */
    public
    function archiveMultipalBrandboostWidget(Request $request)
    {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $multi_widget_id = $request->multi_brandboost_widget_id;

        $aData = array(
            'status' => '3'
        );

        foreach ($multi_widget_id as $widgetID) {

            $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);

            if ($result) {
                //Add Useractivity log

                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_offsite',
                    'action_name' => 'archive_brandboost_widget',
                    'widget_id' => $widgetID,
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Brandboost Widget Archive',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete multiple onsite widget
     * @return type
     */
    public
    function deleteMultipalBrandboostWidget(Request $request)
    {

        $response = array();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $multi_widget_id = $request->multi_widget_id;

        $aData = array(
            'delete_status' => '1'
        );

        foreach ($multi_widget_id as $widgetID) {

            $result = BrandboostModel::updateWidget($userID, $aData, $widgetID);

            if ($result) {
                //Add User activity log

                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_widget',
                    'action_name' => 'deleted_brandboost_widget',
                    'widget_id' => $widgetID,
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Brandboost Widget Deleted',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to add onsite campaign
     * @return type
     */
    public
    function addOnsite(Request $request)
    {
        $response = array();

        $validatedData = $request->validate([
            'campaignName' => ['required'],
            'OnsitecampaignDescription' => ['required']
        ]);

        $userID = Session::get("current_user_id");
        $campaignName = $request->campaignName;
        $OnsitecampaignDescription = $request->OnsitecampaignDescription;

        $str = rand();
        $hashcode = sha1($str);
        $hashcode = $hashcode . date('Ymdhis');

        $aData = array(
            'review_type' => 'onsite',
            'user_id' => $userID,
            'brand_title' => $campaignName,
            'brand_desc' => $OnsitecampaignDescription,
            'status' => 1,
            'hashcode' => md5($hashcode),
            'created' => date("Y-m-d H:i:s")
        );

        //Instantiate Brandboost model to get its methods and properties
        $mBrandboost = new BrandboostModel();

        $brandboostID = $mBrandboost->add($aData);

        if ($brandboostID) {
            $aBrandboostData = array(
                'brandboost_id' => $brandboostID
            );
            $bData = BrandModel::getBrandConfigurationData($brandboostID);
            if ((count($bData) > 0) && $bData != '') {

            } else {
                $result = BrandModel::addBrandConfiguration($aBrandboostData);
            }

            //$this->addDefaultFollowupCampaigns($brandboostID);
            Session::put("setTab", 'Campaign Preferences');
            Session::put('brandboostID', $brandboostID);
            $response['status'] = 'success';
            $response['brandboostID'] = $brandboostID;

            //Add userActivity
            /*$aActivityData = array(
				'user_id' => $userID,
				'event_type' => 'brandboost_onsite',
				'action_name' => 'added_brandboost',
				'brandboost_id' => $brandboostID,
				'campaign_id' => '',
				'inviter_id' => '',
				'subscriber_id' => '',
				'feedback_id' => '',
				'activity_message' => 'New On Site Brandboost added',
				'activity_created' => date("Y-m-d H:i:s")
			);*/
            //logUserActivity($aActivityData);

            $eventName = 'sys_onsite_added';

            //Notify about this to admin
            $notificationData = array(
                'event_type' => $eventName,
                'event_id' => 0,
                'link' => base_url() . 'admin/brandboost/onsite_setup/' . $brandboostID,
                'message' => '',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );

            @add_notifications($notificationData, $eventName, $userID);
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to add offsite campaign
     * @return type
     */
    public
    function addOffsite(Request $request)
    {

        $response = array();

        $userID = Session::get("current_user_id");

        $campaignName = $request->campaignName;
        $brand_desc = $request->campaignDescription;

        /*$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$hashcode = '';
		for ($i = 0; $i < 20; $i++) {
			$hashcode .= $characters[rand(0, strlen($characters))];
		}
		$hashcode = $hashcode . date('Ymdhis');*/

        $str = rand();
        $hashcode = sha1($str);
        $hashcode = $hashcode . date('Ymdhis');

        $aData = array(
            'review_type' => 'offsite',
            'user_id' => $userID,
            'brand_title' => $campaignName,
            'status' => 0,
            'brand_desc' => $brand_desc,
            'hashcode' => md5($hashcode),
            'created' => date("Y-m-d H:i:s")
        );

        $brandboostID = BrandboostModel::add($aData);

        if ($brandboostID) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'brandboost_offsite',
                'action_name' => 'added_brandboost',
                'brandboost_id' => $brandboostID,
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'New Offsite Brandboost added',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);


            //$this->addDefaultFollowupCampaigns($brandboostID);
            $response['status'] = 'success';
            $response['brandboostID'] = $brandboostID;

            $notificationData = array(
                'event_type' => 'added_offsite_brandboost',
                'event_id' => 0,
                'link' => base_url() . 'admin/brandboost/offsite_setup/' . $brandboostID,
                'message' => 'Created new offsite brandboost.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_offsite_added';
            add_notifications($notificationData, $eventName, $userID);
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to add default followup campaign
     * @return type
     */
    public
    function addDefaultFollowupCampaigns($brandboostID)
    {
        $eventID = 0;
        if (!empty($brandboostID)) {
            // Generate main event
            $eventID = $this->addDefaultFollowupEvent($brandboostID, 'main', 0, true, 'Email');
        }
        return $eventID;
    }

    /**
     * Used to delete product
     * @return type
     */
    public
    function deleteProduct(Request $request)
    {

        $response = array();


        $dataOrder = $request->dataOrder;
        $bbId = $request->bb_id;
        $result = BrandboostModel::deleteProduct($bbId, $dataOrder);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to add custom review by client product
     * @return type
     */
    public
    function addReview($campaignId = 0)
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $aBrandboostList = BrandboostModel::getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = BrandboostModel::getBrandboostByUserId($userID, 'onsite');
        }

        if (!empty($campaignId)) {

            $oCampaign = ReviewsModel::getBrandBoostCampaign($campaignId);

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
				<li><a href="' . base_url('admin/brandboost/onsite_setup/' . $campaignId) . '" class="sidebar-control hidden-xs">' . $oCampaign->brand_title . '</a></li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
				<li><a data-toggle="tooltip" data-placement="bottom" title="Add Reviews" class="sidebar-control active hidden-xs ">Add Reviews</a></li>
				</ul>';

            $aData = array(
                'title' => 'Brand Boost add Review',
                'pagename' => $breadcrumb,
                'aBrandboostList' => $aBrandboostList,
                'oCampaign' => $oCampaign,
                'aUser' => $aUser
            );
        } else {

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
				<li><a data-toggle="tooltip" data-placement="bottom" title="Add Reviews" class="sidebar-control active hidden-xs ">Add Reviews</a></li>
				</ul>';

            $aData = array(
                'title' => 'Brand Boost add Review',
                'pagename' => $breadcrumb,
                'aBrandboostList' => $aBrandboostList,
                'aUser' => $aUser
            );
        }

        return view('admin.brandboost.add_review', $aData);
    }

    /**
     * Used to delete multiple brandboost data list
     * @return type
     */
    public
    function deleteMultipalBrandboost(Request $request)
    {

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $multi_brandboost_id = $request->multi_brandboost_id;

        $aData = array(
            'delete_status' => '1'
        );

        foreach ($multi_brandboost_id as $brandboostID) {

            $result = BrandboostModel::updateBrandBoost($userID, $aData, $brandboostID);

            if ($result) {
                //Add Useractivity log

                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_offsite',
                    'action_name' => 'deleted_brandboost',
                    'brandboost_id' => $brandboostID,
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Brandboost Deleted',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }


    public
    function publishOnsiteWidget(Request $request)
    {
        $mBrandboost = new BrandboostModel();
        $response = array();
        $widgetID = $request->widgetID;
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (!empty($widgetID)) {
            $aData = array(
                'status' => 1,
            );

            $result = $mBrandboost->updateWidget($userID, $aData, $widgetID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }


    public
    function publishOnsiteBB(Request $request)
    {
        $mBrandboost = new BrandboostModel();
        $response = array();

        $brandboostID = $request->brandboostID;
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($brandboostID)) {
            $aData = array(
                'status' => 1,
            );

            $result = $mBrandboost->updateBrandBoost($userID, $aData, $brandboostID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }

    public
    function deleteReviewRequest(Request $request)
    {
        $mBrandboost = new BrandboostModel();
        $response = array();

        $multipalIds = $request->multipal_id;
        foreach ($multipalIds as $recordId) {
            $result = $mBrandboost->deleteReviewRequest($recordId);
        }
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }
        echo json_encode($response);
        exit;
    }


    public
    function index()
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $aBrandboostList = $this->mBrandboost->getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = $this->mBrandboost->getBrandboostByUserId($userID, 'onsite');
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Onsite" class="sidebar-control active hidden-xs ">Onsite</a></li>
			</ul>';

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->session->set_userdata('setTab', '');
        $aData = array(
            'title' => 'Onsite Brand Boost Campaigns',
            'pagename' => $breadcrumb,
            'aBrandbosts' => $aBrandboostList,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role
        );
        $this->template->load('admin/admin_template_new', 'admin/brandboost/onsite_list', $aData);
    }

    /*
        Delete the file from the s3 server
    */
    public
    function deleteObjectFromS3(Request $request)
    {


        if (!empty($request->dropImage)) {
            $dropImage = $request->dropImage;
            $s3 = \Storage::disk('s3');
            $resPonse = $s3->delete($dropImage);
            echo $resPonse;
        }
    }

    public
    function onsite_widget_stats($widgetID)
    {
        if (empty($widgetID)) {
            redirect("admin/brandboost/widgets");
            exit;
        }
        $oWidgets = $this->mBrandboost->getBBWidgets($widgetID);
        $oStats = $this->mBrandboost->getBBWidgetStats($widgetID);
        //pre($oStats);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/widgets') . '">Onsite Widgets</a></li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/widgets/' . $widgetID) . '">' . $oWidgets[0]->widget_title . '</a></li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a class="sidebar-control hidden-xs">Statistics</a></li>
			</ul>';

        $aData = array(
            'title' => 'Widget Statistics',
            'pagename' => $breadcrumb,
            'oWidget' => $oWidgets[0],
            'oStats' => $oStats
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/onsite_widget_stats', $aData);
    }


    public
    function brand_configuration()
    {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $BrandObj = new BrandModel();
        $mBrandboostObj = new BrandboostModel();
        $mReviewsObj = new ReviewsModel();

        $brandData = $BrandObj->getBrandConfigurationData($userID);
        $brandThemeData = $BrandObj->getBrandThemesData($userID);
        $aBrandboostList = $mBrandboostObj->getBrandboostByUserId($userID, 'onsite');
        $faQData = $BrandObj->getFaqData();
        $aReviews = $mReviewsObj->getCampaignReviewsByUserId($userID);
        $aBreadcrumb = array(
            'Home' => '#/',
            'Brand' => '#/brand/configuration',
            'Configurations' => '',
        );
        //pre($aReviews);
        $aData = [
            'title' => 'Brand Configuration',
            'breadcrumb' => $aBreadcrumb,
            'brandData' => $brandData[0],
            'aBrandbosts' => $aBrandboostList->items(),
            'brandThemeData' => $brandThemeData,
            'faQData' => $faQData,
            'aReviews' => $aReviews,
            'userData' => $oUser
        ];


        //return view('admin.brandboost.brand_configuration', $aData);
        return $aData;

    }

    public
    function campaignSpecific()
    {
        $mBrandboostObj = new BrandboostModel();
        $mUserObj = new UsersModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $company_name = $aUser->company_name;
        if ($user_role == 1) {
            $aBrandboostList = $mBrandboostObj->getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = $mBrandboostObj->getBrandboostByUserId($userID, 'onsite');
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
            <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Campaigns" class="sidebar-control active hidden-xs ">Campaigns</a></li>
            </ul>';

        $bActiveSubsription = $mUserObj->isActiveSubscription();
        Session::put('setTab', '');

        $aData = array(
            'title' => 'Onsite Brand Boost Campaigns',
            'pagename' => $breadcrumb,
            'aBrandbosts' => $aBrandboostList,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'company_name' => $company_name
        );

        return view('admin.brandboost.campaign_specific', $aData);
    }


    public
    function email_tracking($param, $campId)
    {


        if ($param == 'brand_boost') {
            $type2 = 'brandboost';
        } else if ($param == 'campaign') {
            $type2 = 'campaign';
        } else {
            $type2 = 'campaign';
        }

        //$aStatsBrandboostId = $this->mBrandboost->getSendgridTrackingStats($type, $brandboostID);
        $aStatsAll = $this->mBrandboost->getSendgridTrackingStats($type2, $campId);
        $aStatsOpen = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'open');
        $aStatsClick = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'click');
        $aStatsProcessed = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'processed');
        $aStatsDelivered = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'delivered');
        $aStatsBounce = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'bounce');
        $aStatsUnsubscribe = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'unsubscribe');
        $aStatsDropped = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'dropped');
        $aStatsSpamReport = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'spam_report');
        $aStatsResubscribe = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'group_resubscribe');
        $aStatsUnsubscribe = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'group_unsubscribe');
        $aStatsDeferred = $this->mBrandboost->getSendgridTrackingStats($type2, $campId, 'deferred');


        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">On Site Brand Boost Email Tracking</li>
			</ul>';

        $this->template->load('admin/admin_campaign_template', 'admin/brandboost/onsite_tracking',
            array('title' => 'On Site Review Campaign Tracking',
                'pagename' => $breadcrumb,
                'aStatsBrandboostId' => isset($aStatsBrandboostId) ? $aStatsBrandboostId : '',
                'aStatsAll' => $aStatsAll,
                'aStatsOpen' => $aStatsOpen,
                'aStatsClick' => $aStatsClick,
                'aStatsProcessed' => $aStatsProcessed,
                'aStatsDelivered' => $aStatsDelivered,
                'aStatsBounce' => $aStatsBounce,
                'aStatsUnsubscribe' => $aStatsUnsubscribe,
                'aStatsDropped' => $aStatsDropped,
                'aStatsSpamReport' => $aStatsSpamReport,
                'aStatsResubscribe' => $aStatsResubscribe,
                'aStatsUnsubscribe' => $aStatsUnsubscribe,
                'aStatsDeferred' => $aStatsDeferred
            ));
    }

    public
    function sms_tracking($param, $campId)
    {

        if ($param == 'brand_boost') {

            $type2 = 'brandboost';
        } else if ($param == 'campaign') {

            $type2 = 'campaign';
        } else {

            $type2 = 'campaign';
        }

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">On Site Review Campaign SMS Tracking</li>
			</ul>';

        $aStatsAll = $this->mBrandboost->getTwilioTrackingStats($type2, $campId);
        $aStatsAccepted = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'accepted');
        $aStatsSent = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'sent');
        $aStatsDelivered = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'delivered');
        $aStatsUndelivered = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'undelivered');
        $aStatsFailed = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'failed');
        $aStatsReceiving = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'receiving');
        $aStatsReceived = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'received');
        $aStatsQueued = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'queued');
        $aStatsSending = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'sending');
        $aStatsClick = $this->mBrandboost->getTwilioTrackingStats($type2, $campId, 'click');

        $aData = array(
            'title' => 'On Site Review Campaign Tracking',
            'pagename' => $breadcrumb,
            'aStatsAll' => $aStatsAll,
            'aStatsAccepted' => $aStatsAccepted,
            'aStatsSent' => $aStatsSent,
            'aStatsDelivered' => $aStatsDelivered,
            'aStatsUndelivered' => $aStatsUndelivered,
            'aStatsFailed' => $aStatsFailed,
            'aStatsReceiving' => $aStatsReceiving,
            'aStatsReceived' => $aStatsReceived,
            'aStatsQueued' => $aStatsQueued,
            'aStatsSending' => $aStatsSending,
            'aStatsClick' => $aStatsClick
        );

        $this->template->load('admin/admin_campaign_template', 'admin/brandboost/onsite_sms_tracking', $aData);
    }

    public
    function addBrandCampaign(Request $request)
    {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        $campaign = $request->campaign;

        $aBrandboostData = array(
            'user_id' => $userID,
            'campaign_ids' => serialize($campaign)
        );
        $mBrand = new BrandModel();

        $bData = $mBrand->getBrandConfigurationData($userID);
        if ($bData->count() > 0) {
            $result = $mBrand->updateBrandConfiguration($userID, $aBrandboostData);
        } else {
            $result = $mBrand->addBrandConfiguration($aBrandboostData);
        }

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public
    function getBrandThemeData(Request $request)
    {

        $BrandthemeId = $request->BrandthemeId;
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $mBrand = new BrandModel();
        $result = $mBrand->getBrandThemeConfigData($BrandthemeId);


        if ($result) {
            $response = array('status' => 'ok');
            $response['brand_theme_title'] = $result[0]->brand_theme_title;
            $response['header_color'] = $result[0]->header_color;
            $response['header_custom_color1'] = $result[0]->header_custom_color1;
            $response['header_custom_color2'] = $result[0]->header_custom_color2;
            $response['header_solid_color'] = $result[0]->header_solid_color;
            $response['header_color_fix'] = $result[0]->header_color_fix;
            $response['header_color_custom'] = $result[0]->header_color_custom;
            $response['header_color_solid'] = $result[0]->header_color_solid;
            $response['company_logo'] = $result[0]->company_logo;
            $response['company_header_logo'] = $result[0]->company_header_logo;
            $response['area_type'] = $result[0]->area_type;
            $response['default_logo'] = $result[0]->default_logo;
            $response['default_header_logo'] = $result[0]->default_header_logo;
            $response['color_orientation_top'] = $result[0]->color_orientation_top;
            $response['color_orientation_full'] = $result[0]->color_orientation_full;
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public
    function addBrandConfigurationData(Request $request)
    {

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();
        $BrandModelObj = new BrandModel();
        $aData = $request->formData;
        if($userID>0){
            $aData['user_id'] = $userID;
        }

        $bData = $BrandModelObj->getBrandConfigurationData($userID);
        if ($bData->count() > 0) {
            $result = $BrandModelObj->updateBrandConfiguration($userID, $aData);
        } else {
            $result = $BrandModelObj->addBrandConfiguration($aData);
        }
        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'ok');
        }

        echo json_encode($response);
        exit;
    }

    public
    function addBrandConfigurationDataOld(Request $request)
    {

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();
        $BrandModelObj = new BrandModel();
        //$brandboostId = $request->brandboost_id;
        $avatar = $request->avatar_switch != '' ? '1' : '0';
        $company_des = $request->company_des_switch != '' ? '1' : '0';
        $services = $request->services_switch != '' ? '1' : '0';
        $contact_btn = $request->contact_btn_switch != '' ? '1' : '0';
        $contact_info = $request->contact_info_switch != '' ? '1' : '0';
        $socials = $request->socials_switch != '' ? '1' : '0';
        $customer_experiance = $request->customer_experiance_switch != '' ? '1' : '0';
        $about_company = $request->about_company_position;
        $reviews_list = $request->reviews_list_position;
        $show_rating = $request->show_rating;
        $chat_widget = $request->chat_widget_switch != '' ? '1' : '0';
        $referral_widgets = $request->referral_widgets_switch != '' ? '1' : '0';

        $aBrandboostData = array(
            'user_id' => $userID,
            'avatar' => $avatar,
            'company_description' => $company_des,
            'services' => $services,
            'contact_button' => $contact_btn,
            'contact_info' => $contact_info,
            'socials' => $socials,
            'customer_experiance' => $customer_experiance,
            'about_company_position' => $about_company,
            'review_list_position' => $reviews_list,
            'rating' => $show_rating,
            'chat_widget' => $chat_widget,
            'referral_widget' => $referral_widgets
        );


        $bData = $BrandModelObj->getBrandConfigurationData($userID);
        if ($bData->count() > 0) {
            $result = $BrandModelObj->updateBrandConfiguration($userID, $aBrandboostData);
        } else {
            $result = $BrandModelObj->addBrandConfiguration($aBrandboostData);
        }
        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'ok');
        }

        echo json_encode($response);
        exit;
    }

    public
    function addFaqData(Request $request)
    {

        $response = array();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $faq_question = $request->question;
        $faq_answer = $request->answer;
        $mBrand = new BrandModel();

        // $referral_widgets = $request->referral_widgets_switch'] != '' ? '1' : '0';

        $addFaqData = array(
            'user_id' => $userID,
            'question' => $faq_question,
            'answer' => $faq_answer
        );


        $result = $mBrand->addFaqData($addFaqData);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public
    function update_faq_status(Request $request)
    {

        $response = array();

        $mBrand = new  BrandModel();


        $faqId = $request->faq_id;
        $status = $request->status;

        $aData = array(
            'status' => $status
        );

        $result = $mBrand->updateFaQStatus($aData, $faqId);
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = "Status has been updated successfully.";
        } else {
            $response['message'] = "Error: Something went wrong, try again";
        }

        echo json_encode($response);
        exit;

    }

    public
    function delete_faq(Request $request)
    {

        $response = array();

        if (!empty($request)) {


            $faqId = $request->faq_id;
            $result = $this->mBrand->DeleteFaQ($faqId);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Status has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function UpdateFaqData(Request $request)
    {

        $response = array();

        $mBrand = new BrandModel();


        $faqId = $request->faq_id;
        $faq_question = $request->question;
        $faq_answer = $request->answer;


        $aData = array(
            'question' => $faq_question,
            'answer' => $faq_answer
        );


        $result = $mBrand->UpdateFaqData($aData, $faqId);
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = "Status has been updated successfully.";
        } else {
            $response['message'] = "Error: Something went wrong, try again";
        }

        echo json_encode($response);
        exit;

    }

    public
    function getFaqdetails(Request $request)
    {
        $faQListid = $request->faqId;
        $oUser = getLoggedUser();
        $mBrand = new BrandModel();

        $userID = $oUser->id;

        $selectedTab = $request->t;
        if (!empty(!empty($request))) {
            $faQListid = $request->faQListid;
            $actionName = $request->action;
        }


        $oFdetails = $mBrand->getFAQSingleDetails($faQListid);


        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/questions') . '" class="sidebar-control hidden-xs">Question </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Details" class="sidebar-control active hidden-xs ">Details</a></li>
			</ul>';

        $aData = array(
            'selectedTab' => $selectedTab,
            'oFdetails' => $oFdetails[0]
        );

        if ($actionName == 'smart-popup') {
            $popupContent = view('admin.components.smart-popup.faqs', $aData)->render();
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        } else {
            return view('admin.question.question_details', $aData);
        }
    }

    public
    function switchTemplate(Request $request)
    {

        $oUser = getLoggedUser();
        $mBrand = new BrandModel();
        $userID = $oUser->id;

        $template_style = $request->template_style;
        $aThemeData = "";
        $theme_title = "";
        $aBrandboostData = array(
            'user_id' => $userID,
            'template_style' => $template_style,
        );
        $bData = $mBrand->getBrandConfigurationData($userID);
        if ((count($bData) > 0) && $bData != '') {
            $result = $mBrand->saveTheme($userID, $aBrandboostData, $aThemeData = "", $theme_title);
        } else {
            $result = $mBrand->addBrandConfiguration($aBrandboostData, $aThemeData = "", $theme_title);
        }

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public
    function updateBrandConfigurationData(Request $request)
    {

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();

        $area_type = $request->area_type;
        $theme_title = $request->brand_theme_title;
        $BrandModelObj = new BrandModel();

        $company_logo = $request->company_logo;
        $company_header_logo = $request->company_header_logo;
        $solid_color = $request->area_type == '1' ? $request->solid_color : $request->solid_color_full;
        $main_colors = $request->area_type == '1' ? $request->main_colors : $request->main_colors_full;
        $custom_colors1 = $request->area_type == '1' ? $request->custom_colors1 : $request->custom_colors1_full;
        $custom_colors2 = $request->area_type == '1' ? $request->custom_colors2 : $request->custom_colors2_full;
        $color_orientation_top = $request->color_orientation_top_value;
        $color_orientation_full = $request->color_orientation_full_value;
        $custom_company_name = $request->custom_company_name;
        $custom_company_description = $request->custom_company_description;
        $company_info_switch = $request->company_info_switch != '' ? '1' : '0';
        if ($request->area_type == '1') {
            $main_color_switch = $request->main_color_switch != '' ? '1' : '0';
        } else {
            $main_color_switch = $request->main_color_switch_full != '' ? '1' : '0';
        }
        if ($request->area_type == '1') {
            $custom_color_switch = $request->custom_color_switch != '' ? '1' : '0';
        } else {
            $custom_color_switch = $request->custom_color_switch_full != '' ? '1' : '0';
        }
        if ($request->area_type == '1') {
            $solid_color_switch = $request->solid_color_switch != '' ? '1' : '0';
        } else {
            $solid_color_switch = $request->solid_color_switch_full != '' ? '1' : '0';
        }


        $aBrandboostData = array(
            'user_id' => $userID,
            'area_type' => $area_type,
            'company_info' => $company_info_switch,
            'header_color' => $main_colors,
            'header_solid_color' => $solid_color,
            'header_custom_color1' => $custom_colors1,
            'header_custom_color2' => $custom_colors2,
            'header_color_solid' => $solid_color_switch,
            'header_color_fix' => $main_color_switch,
            'header_color_custom' => $custom_color_switch,
            'company_logo' => $company_logo,
            'company_info_name' => $custom_company_name,
            'company_info_description' => $custom_company_description,
            'company_header_logo' => $company_header_logo,
            'color_orientation_top' => $color_orientation_top,
            'color_orientation_full' => $color_orientation_full
        );


        $aThemeData = array(
            'user_id' => $userID,
            'area_type' => $area_type,
            'header_color' => $main_colors,
            'brand_theme_title' => $theme_title,
            'header_solid_color' => $solid_color,
            'header_custom_color1' => $custom_colors1,
            'header_custom_color2' => $custom_colors2,
            'header_color_solid' => $solid_color_switch,
            'header_color_fix' => $main_color_switch,
            'header_color_custom' => $custom_color_switch,
            'color_orientation_top' => $color_orientation_top,
            'color_orientation_full' => $color_orientation_full
        );

        $bData = $BrandModelObj->getBrandConfigurationData($userID);
        if ($bData->count() > 0) {
            $result = $BrandModelObj->saveTheme($userID, $aBrandboostData, $aThemeData, $theme_title);
            if ($result) {
                $response = array('status' => 'ok');
            } else {
                $response = array('status' => 'ok');
            }
        } else {
            $result = $BrandModelObj->addBrandConfiguration($aBrandboostData, $aThemeData, $theme_title);
            if ($result) {
                $response = array('status' => 'ok');
            } else {
                $response = array('status' => 'error');
            }
        }


        echo json_encode($response);
        exit;
    }

    public
    function getWidgetThemeData($themeId)
    {
        $result = $this->mBrandboost->getWidgetThemeData($themeId);

        if ($result) {
            $response = array('status' => 'ok', 'themeData' => $result[0]);
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }


    public
    function addBrandBoostData(Request $request)
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();

        //$brandboostID = $this->session->userdata('brandboostID');
        $title = $request->title;
        $desc = $request->desc;
        $bAllowComment = $request->allow_comment;
        $bAllowVideoReview = $request->allow_video_reviews;
        $bAllowHelpful = $request->allow_helpful;
        $bAllowLiveReading = $request->allow_live_reading;
        $bAllowRatings = $request->allow_ratings;
        $bAllowTimestamp = $request->allow_timestamp;
        $bAllowProsCons = $request->allow_pros_cons;
        $bgColor = $request->bg_color;
        $textColor = $request->text_color;
        $pro_cons = $request->pro_cons;
        $domainName = $request->domain_name;
        $ratingValue = $request->ratingValue;
        $bbDisplay = $request->bbDisplay;
        $brandboostID = $request->edit_brandboostId;

        //$widgettype = $this->session->userdata('selectedOnsiteWidget');
        $numofrev = $request->numofrev;

        $barndFileData = $request->brand_img;
        $brandFileArray = array();

        foreach ($barndFileData['media_url'] as $key => $fileData) {
            $brandFileArray[$key]['media_url'] = $fileData;
            $brandFileArray[$key]['media_type'] = $barndFileData['media_type'][$key];
        }

        $logoImageFileName = $request->logo_img == '' ? $request->edit_logo_img : $request->logo_img;
        $brandImageFileName = empty($request->brand_img) ? $request->edit_brand_img : serialize($brandFileArray);

        $review_expire = $request->review_expire;
        $review_expire_link = $request->review_expire_link;
        $revExpireLink = array();
        if ($review_expire_link == 'custom') {

            $txtInteger = $request->txtInteger;
            $exp_duration = $request->exp_duration;
            $revExpireLink['delay_value'] = $txtInteger;
            $revExpireLink['delay_unit'] = $exp_duration;
        } else {

            $revExpireLink['delay_value'] = 'never';
            $revExpireLink['delay_unit'] = 'never';
        }


        $aBrandboostData = array(
            'user_id' => $userID,
            'brand_title' => $title,
            'brand_desc' => $desc,
            'brand_img' => $brandImageFileName,
            'logo_img' => $logoImageFileName,
            'allow_comments' => $bAllowComment,
            'allow_video_reviews' => $bAllowVideoReview,
            'allow_helpful_feedback' => $bAllowHelpful,
            'allow_live_reading_review' => $bAllowLiveReading,
            'allow_comment_ratings' => $bAllowRatings,
            'allow_review_timestamp' => $bAllowTimestamp,
            'allow_pros_cons' => $bAllowProsCons,
            'bg_color' => $bgColor,
            'text_color' => $textColor,
            'num_of_review' => $numofrev,
            'domain_name' => $domainName,
            'pro_cons' => $pro_cons,
            'often_bb_display' => $bbDisplay,
            'min_ratings_display' => $ratingValue,
            'link_expire_review' => $review_expire,
            'link_expire_custom' => json_encode($revExpireLink)
        );


        $result = $this->mBrandboost->update($userID, $aBrandboostData, $brandboostID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }


    public
    function createBrandBoostWidgetTheme(Request $request)
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();


        $widgetID = $request->theme_widget_id;
        $theme_widget_title = $request->widget_theme_title;
        $theme_fix_color_switch = $request->theme_bg_color_switch == 1 ? 1 : 0;
        $theme_custom_color_switch = $request->theme_bg_color_switch == 2 ? 1 : 0;
        $theme_solid_color_switch = $request->theme_bg_color_switch == 3 ? 1 : 0;
        $theme_main_colors = $request->theme_main_colors;
        $theme_custom_colors1 = $request->theme_custom_colors1;
        $theme_custom_colors2 = $request->theme_custom_colors2;
        $theme_solid_color = $request->theme_solid_color;
        $theme_main_colors_rating = $request->theme_main_colors_rating;
        $theme_rating_custom_color1 = $request->theme_rating_custom_color1;
        $theme_rating_custom_colors2 = $request->theme_rating_custom_colors2;
        $theme_rating_solid_color = $request->theme_rating_solid_color;
        $theme_fix_rating_color = $request->theme_fix_rating_color;
        $theme_widget_font_color = $request->theme_widget_font_color;
        $theme_widget_border_color = $request->theme_widget_border_color;
        $theme_widget_position = $request->theme_widget_position;
        $theme_color_orientation = $request->theme_color_orientation;


        $aData = array(
            'user_id' => $userID,
            'brandboost_widget_id' => $widgetID,
            'widget_theme_title' => $theme_widget_title,
            'header_color' => $theme_main_colors,
            'header_custom_color1' => $theme_custom_colors1,
            'header_custom_color2' => $theme_custom_colors2,
            'header_solid_color' => $theme_solid_color,
            'header_color_fix' => $theme_fix_color_switch,
            'header_color_custom' => $theme_custom_color_switch,
            'header_color_solid' => $theme_solid_color_switch,
            'rating_color' => $theme_main_colors_rating,
            'rating_custom_color1' => $theme_rating_custom_color1,
            'rating_custom_color2' => $theme_rating_custom_colors2,
            'rating_solid_color' => $theme_rating_solid_color,
            'rating_color_fix' => $theme_fix_rating_color,
            'widget_font_color' => $theme_widget_font_color,
            'widget_border_color' => $theme_widget_border_color,
            'widget_position' => $theme_widget_position,
            'color_orientation' => $theme_color_orientation,
            'created' => date("Y-m-d H:i:s")
        );


        $result = $this->mBrandboost->creatWidgetTheme($aData);

        if ($result) {
            $response = array('status' => 'ok', 'current_widget_id' => $result);
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public
    function addBrandBoostDesign(Request $request)
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();


        $company_logo = $request->company_logo;
        $allow_branding = $request->allow_branding != '' ? '1' : '0';
        $notification = $request->notification != '' ? '1' : '0';
        $company_info_switch = $request->company_info_switch != '' ? '1' : '0';
        $brandboostID = $request->edit_brandboostId;
        $solid_color = $request->solid_color;
        $main_colors = $request->main_colors;
        $custom_colors1 = $request->custom_colors1;
        $custom_colors2 = $request->custom_colors2;
        $main_color_switch = $request->main_color_switch != '' ? '1' : '0';
        $custom_color_switch = $request->custom_color_switch != '' ? '1' : '0';
        $solid_color_switch = $request->solid_color_switch != '' ? '1' : '0';
        $custom_company_name = $request->custom_company_name;
        $custom_company_description = $request->custom_company_description;

        $aBrandboostData = array(
            'user_id' => $userID,
            'header_color' => $main_colors,
            'header_solid_color' => $solid_color,
            'header_custom_color1' => $custom_colors1,
            'header_custom_color2' => $custom_colors2,
            'header_color_solid' => $solid_color_switch,
            'header_color_fix' => $main_color_switch,
            'header_color_custom' => $custom_color_switch,
            'company_logo' => $company_logo,
            'allow_branding' => $allow_branding,
            'notification' => $notification,
            'company_info' => $company_info_switch,
            'company_info_name' => $custom_company_name,
            'company_info_description' => $custom_company_description
        );


        $result = $this->mBrandboost->update($userID, $aBrandboostData, $brandboostID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public
    function delete(Request $request)
    {
        $response = array();

        $id = $request->brandboost_id;
        if ($id > 0) {
            $result = $this->mBrandboost->delete($id);
            if ($result) {
                $response = array('status' => 'ok');
            } else {
                $response = array('status' => 'error');
            }
            echo json_encode($response);
            exit;
        }
    }

    public
    function deleteCampaignResponse(Request $request)
    {
        $response = array();

        $ids = $request->multipal_id;

        foreach ($ids as $id) {
            $result = $this->mBrandboost->deleteCampaignResponse($id);
        }

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public
    function campaignResponseDel(Request $request)
    {
        $response = array();

        $id = $request->campaign_response_id;

        $result = $this->mBrandboost->deleteCampaignResponse($id);

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public
    function add_onsite_campaign()
    {
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_campaign_template', 'admin/brandboost/add_onsite_campaign', array('bActiveSubsription' => $bActiveSubsription));
    }

    public
    function add()
    {
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/add_onsite', array('bActiveSubsription' => $bActiveSubsription));
    }

    public
    function edit()
    {

        $brandId = $this->uri->segment(4);
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);

        $this->template->load('admin/admin_template', 'admin/brandboost/edit_onsite', array('aBrandbosts' => $getBrandboost[0], 'brandId' => $brandId));
    }

    public
    function onsite_allset()
    {
        $brandId = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $next_page_url = $getBrandboost[0]->review_type;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/onsite_allset', array('campaign_key' => $getBrandboost[0]->hashcode, 'sWidget' => $getBrandboost[0]->widget_type, 'next_page_url' => $next_page_url, 'bActiveSubsription' => $bActiveSubsription));
    }

    public
    function rewards()
    {

        $rewardsData = $this->mRewards->getAllRewards();
        $brandId = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/reward_step_5a', array('rewardsData' => $rewardsData, 'brandboostData' => $getBrandboost[0], 'bActiveSubsription' => $bActiveSubsription));
    }

    public
    function addDefaultFollowupEvent($brandboostID, $type = 'main', $previousEventID = '', $addDefaultContent = true, $campaignType = 'Email')
    {
        if (!empty($brandboostID)) {
            $brandBoostData = $this->mBrandboost->getBrandboost($brandboostID);
            $aData = $brandBoostData[0];
            $brandboostType = $aData->review_type;

            if ($campaignType == 'Email') {
                if ($brandboostType == 'onsite' && $type == 'main') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'onsite_review_email');
                } else if ($brandboostType == 'onsite' && $type == 'reminder') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'onsite_review_reminder_email');
                } else if ($brandboostType == 'offsite' && $type == 'main') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'offsite_review_email');
                } else if ($brandboostType == 'offsite' && $type == 'reminder') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'offsite_review_reminder_email');
                }
                if ($type == 'main') {
                    $emailTempalteID = ($brandboostType == 'onsite') ? $this->default_main_email_template_onsite : $this->default_main_email_template_offsite;
                    $smsTempalteID = ($brandboostType == 'onsite') ? $this->default_main_sms_template_onsite : $this->default_main_sms_template_offsite;
                    $dateTimeData = array("delay_type" => 'after', "delay_value" => $this->default_main_email_delay_value, "delay_unit" => $this->default_main_email_delay_unit);
                } else if ($type == 'reminder') {
                    $emailTempalteID = ($brandboostType == 'onsite') ? $this->default_reminder_email_template_onsite : $this->default_reminder_email_template_offsite;
                    $smsTempalteID = ($brandboostType == 'onsite') ? $this->default_reminder_sms_template_onsite : $this->default_reminder_sms_template_onffsite;
                    $dateTimeData = array("delay_type" => 'after', "delay_value" => $this->default_reminder_email_delay_value, "delay_unit" => $this->default_reminder_email_delay_unit);
                } else {
                    return 0;
                }
            } else {
                if ($brandboostType == 'onsite' && $type == 'main') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'onsite_review_sms');
                } else if ($brandboostType == 'onsite' && $type == 'reminder') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'onsite_review_reminder_sms');
                } else if ($brandboostType == 'offsite' && $type == 'main') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'offsite_review_sms');
                } else if ($brandboostType == 'offsite' && $type == 'reminder') {
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo('', 'offsite_review_reminder_sms');
                }
                if ($type == 'main') {
                    $emailTempalteID = ($brandboostType == 'onsite') ? $this->default_main_email_template_onsite : $this->default_main_email_template_offsite;
                    $smsTempalteID = ($brandboostType == 'onsite') ? $this->default_main_sms_template_onsite : $this->default_main_sms_template_offsite;
                    $dateTimeData = array("delay_type" => 'after', "delay_value" => $this->default_main_email_delay_value, "delay_unit" => $this->default_main_email_delay_unit);
                } else if ($type == 'reminder') {
                    $emailTempalteID = ($brandboostType == 'onsite') ? $this->default_reminder_email_template_onsite : $this->default_reminder_email_template_offsite;
                    $smsTempalteID = ($brandboostType == 'onsite') ? $this->default_reminder_sms_template_onsite : $this->default_reminder_sms_template_onffsite;
                    $dateTimeData = array("delay_type" => 'after', "delay_value" => $this->default_reminder_email_delay_value, "delay_unit" => $this->default_reminder_email_delay_unit);
                } else {
                    return 0;
                }
            }

            $dateTimeData = json_encode($dateTimeData);
            $aEventData = array(
                'brandboost_id' => $brandboostID,
                'event_type' => ($type == 'main') ? 'send-invite' : 'followup',
                'data' => $dateTimeData,
                'previous_event_id' => $previousEventID,
                'created' => date("Y-m-d H:i:s"),
                'updated' => date("Y-m-d H:i:s")
            );
            $eventID = $this->mBrandboost->addEvent($aEventData);
            $aUser = getLoggedUser();
            if ($eventID && $addDefaultContent) {
                if ($campaignType == 'Email') {
                    //$resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempalteID);
                    //$resultData = $resultData[0];
                    $resultData = $oTemplate;

                    //add Email Template
                    if ($brandboostType == 'onsite') {
                        $templateCode = $this->load->view("admin/brandboost/brand-templates/onsite/email/templates", array('template_slug' => $resultData->template_slug), true);
                    }

                    if ($brandboostType == 'offsite') {
                        $templateCode = $this->load->view("admin/brandboost/brand-templates/offsite/email/templates", array('template_slug' => $resultData->template_slug), true);
                    }

                    $content = base64_encode($templateCode);
                    $cEmailData = array(
                        'event_id' => $eventID,
                        'content_type' => 'Regular',
                        'campaign_type' => 'Email',
                        'name' => $resultData->template_name,
                        'subject' => $resultData->template_subject,
                        'greeting' => $resultData->greeting,
                        'introduction' => $resultData->introduction,
                        'html' => (!empty($content)) ? $content : $resultData->template_content,
                        'stripo_compiled_html' => (!empty($content)) ? $content : $resultData->template_content,
                        'template_source' => $oTemplate->id,
                        'status' => 1,
                        'from_email' => $aUser->email,
                        'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
                        'reply_to' => $aUser->email,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $campaignId = $this->mBrandboost->addCampaign($cEmailData);
                } else {
                    //add Sms Template
                    $resultData = $this->mBrandboost->getAllCampaignTemplates($smsTempalteID);
                    $resultData = $resultData[0];
                    $cSMSData = array(
                        'event_id' => $eventID,
                        'content_type' => 'Plain Text',
                        'campaign_type' => 'SMS',
                        'name' => $resultData->template_name,
                        'subject' => $resultData->template_subject,
                        'greeting' => $resultData->greeting,
                        'introduction' => $resultData->introduction,
                        'html' => $resultData->template_content,
                        'template_source' => $oTemplate->id,
                        'status' => 1,
                        'from_email' => $aUser->email,
                        'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
                        'reply_to' => $aUser->email,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $campaignId = $this->mBrandboost->addCampaign($cSMSData);
                }
            }
            return $eventID;
        }
    }

    public
    function addDefaultFollowupCampaigns_old($brandboostID)
    {
        $eventID = 0;
        if (!empty($brandboostID)) {
            // Generate main event
            $eventID = $this->addDefaultFollowupEvent($brandboostID, 'main', 0, true, 'Email');

            $eventSmsID = $this->addDefaultFollowupEvent($brandboostID, 'main', 0, true, 'SMS');

            // Generate reminder event
            if ($eventID > 0) {
                $eventID = $this->addDefaultFollowupEvent($brandboostID, 'reminder', $eventID, true, 'Email');
            }

            // Generate reminder event
            if ($eventSmsID > 0) {
                $eventSmsID = $this->addDefaultFollowupEvent($brandboostID, 'reminder', $eventSmsID, true, 'SMS');
            }
        }
        return $eventID;
    }


    public
    function addDefaultFollowupCampaigns_old_new($brandboostID)
    {
        $eventID = 0;
        if (!empty($brandboostID)) {
            // Generate main event
            $eventID = $this->addDefaultFollowupEvent($brandboostID, 'main', 0, true, 'Email');


            //$eventSmsID = $this->addDefaultFollowupEvent($brandboostID, 'main', 0, true, 'SMS');
            // Generate reminder event
            if ($eventID > 0) {
                $eventSmsID = $this->addDefaultFollowupEvent($brandboostID, 'reminder', $eventID, true, 'SMS');
            }

            // Generate reminder event
            if ($eventSmsID > 0) {
                $eventEmailID = $this->addDefaultFollowupEvent($brandboostID, 'reminder', $eventSmsID, true, 'Email');
            }

            // Generate reminder event
            if ($eventEmailID > 0) {
                $eventEmailID = $this->addDefaultFollowupEvent($brandboostID, 'reminder', $eventEmailID, true, 'SMS');
            }
        }
        return $eventID;
    }

    public
    function addReminder()
    {
        $brandboostID = $this->session->userdata('brandboostID');
        $aPreviousData = $this->mBrandboost->getPrevEventId($brandboostID);
        $previousEventID = $aPreviousData->id;
        if ($previousEventID > 0) {
            $eventID = $this->addDefaultFollowupEvent($brandboostID, 'reminder', $previousEventID, false);
        }
        if ($eventID) {
            $response['status'] = 'success';
            $response['eventId'] = $eventID;
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    public
    function create_event(Request $request)
    {
        $response = array();

        $userID = $this->session->userdata("current_user_id");
        $brandId = $this->session->userdata('brandboostID');
        $getPrevEventId = $this->mBrandboost->getPrevEventId($brandId);
        $emailTempalteID = $request->templateId;
        $campaignType = $request->campaign_type;
        $previousEventId = $request->previous_event_id;
        $currentEventID = $request->current_event_id;
        $eventType = $request->event_type;
        $aResponse = $this->mFeedback->getFeedbackResponse($brandId);
        if (!empty($aResponse)) {
            $fromName = $aResponse->from_name;
            $fromEmail = $aResponse->from_email;
        } else {
            $fromName = $aUser->firstname . ' ' . $aUser->lastname;
            $fromEmail = $aUser->email;
        }

        $dateTimeData = array("delay_type" => 'after', "delay_value" => '10', "delay_unit" => 'minute');
        $dateTimeData = json_encode($dateTimeData);
        if (!empty($brandId)) {
            $brandBoostData = $this->mBrandboost->getBrandboost($brandId);
            $brandBoostData = $brandBoostData[0];

            if ($brandBoostData->review_type == 'onsite') {

                $eData = array(
                    'brandboost_id' => $brandId,
                    'event_type' => $eventType == 'main' ? 'send-invite' : 'followup',
                    'data' => $dateTimeData,
                    'previous_event_id' => $currentEventID,
                    'created' => date("Y-m-d H:i:s")
                );

                //$eventId = $this->mBrandboost->addEvent($eData);
                $resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempalteID);
                $resultData = $resultData[0];

                $aUser = getLoggedUser();

                if ($campaignType == 'Email') {
                    $cData = array(
                        'content_type' => 'Regular',
                        'campaign_type' => 'Email',
                        'name' => $resultData->template_name,
                        'subject' => $resultData->template_subject,
                        'html' => $resultData->template_content,
                        'template_source' => $emailTempalteID,
                        'from_email' => $fromEmail,
                        'from_name' => $fromName,
                        'reply_to' => $fromEmail,
                        'status' => 1,
                        'created' => date("Y-m-d H:i:s")
                    );
                } else {
                    $cData = array(
                        'content_type' => 'Plain Text',
                        'campaign_type' => 'SMS',
                        'name' => $resultData->template_name,
                        'subject' => $resultData->template_subject,
                        'html' => $resultData->template_content,
                        'template_source' => $emailTempalteID,
                        'status' => 1,
                        'created' => date("Y-m-d H:i:s")
                    );
                }

                if ($eventType == 'main') {
                    if ($currentEventID > 0) {
                        //Event already exists lets check if main campaign exists
                        $oMainCampaign = $this->mBrandboost->getEmailCampaignInfo($currentEventID);
                        if (!empty($oMainCampaign)) {
                            //This is just the concept of Linked list
                            //Main campaign exisits
                            //now we turn this main campaign to new followup campaign because we are going to add a new main campaign
                            //get Main Campaign ID
                            //
                            //Step-1 Get Followup Node Info(header of the linked node)
                            $oFollowupEvent = $this->mBrandboost->getEmailAutomationEventByPreviousID($currentEventID);
                            $followupEventID = $oFollowupEvent->id;
                            $mainCampaignID = $oMainCampaign->id;
                            $cData['event_id'] = $currentEventID;
                            $campaignID = $this->mBrandboost->addCampaign($cData);
                            //Step-2 Add Followup (new linked node)
                            $eData['previous_event_id'] = $currentEventID;
                            $eventID = $this->mBrandboost->addEvent($eData);
                            //Step-3 Update old Main Campaign
                            $aUpdateData = array(
                                'event_id' => $eventID
                            );
                            $bUpdated = $this->mBrandboost->updateEmailAutomationCampaign($aUpdateData, $mainCampaignID);

                            //Step-4 Update new followup address into the next followup header
                            $aLinkedData = array(
                                'previous_event_id' => $eventID
                            );

                            $bLinked = $this->mBrandboost->updateEmailAutomationEvent($aLinkedData, $followupEventID);

                            $response = array('status' => 'success', 'msg' => "Added successfully");
                            if ($campaignID) {
                                $response['campaignId'] = $campaignID;
                                $response['temp_subject'] = $subject;
                                $response['temp_content'] = base64_decode($content);
                            }
                        } else {
                            //Main campaign do not existis
                            //Add a new campaign with main event id
                            $cData['event_id'] = $currentEventID;
                            $campaignID = $this->mBrandboost->addCampaign($cData);
                            $response = array('status' => 'success', 'msg' => "Added successfully");
                            if ($campaignID) {
                                $response['campaignId'] = $campaignID;
                                $response['temp_subject'] = $subject;
                                $response['temp_content'] = base64_decode($content);
                            }
                        }
                    } else {
                        $eData['previous_event_id'] = 0;
                        $eventID = $this->mBrandboost->addEvent($eData);

                        $cData['event_id'] = $eventID;
                        $campaignID = $this->mBrandboost->addCampaign($cData);
                        $response = array('status' => 'success', 'msg' => "Added successfully");
                        if ($campaignID) {
                            $response['campaignId'] = $campaignID;
                            $response['temp_subject'] = $subject;
                            $response['temp_content'] = base64_decode($content);
                        }
                    }
                } else {
                    //Step-1 Get Next Node information
                    $oFollowupEvent = $this->mBrandboost->getEmailAutomationEventByPreviousID($currentEventID);
                    $followupEventID = $oFollowupEvent->id;
                    //Step-2 Create New Node followup
                    $eData['previous_event_id'] = $currentEventID;
                    $eventID = $this->mBrandboost->addEvent($eData);
                    //Step-3 Create New followup Campaign
                    $cData['event_id'] = $eventID;
                    $campaignID = $this->mBrandboost->addCampaign($cData);
                    //Step-4 Update new followup address into the next followup header
                    if (!empty($oFollowupEvent)) {
                        $aLinkedData = array(
                            'previous_event_id' => $eventID
                        );

                        $bLinked = $this->mBrandboost->updateEmailAutomationEvent($aLinkedData, $followupEventID);
                    }
                    $response = array('status' => 'success', 'msg' => "Added successfully");
                    if ($campaignID) {
                        $response['campaignId'] = $campaignID;
                        $response['temp_subject'] = $subject;
                        $response['temp_content'] = base64_decode($content);
                    }
                }

                if ($campaignID) {
                    //Add Useractivity log
                    $aActivityData = array(
                        'user_id' => $userID,
                        'event_type' => 'brandboost_onsite',
                        'action_name' => 'added_campaign',
                        'brandboost_id' => $brandboostID,
                        'campaign_id' => $campaignID,
                        'inviter_id' => $eventID,
                        'subscriber_id' => '',
                        'feedback_id' => '',
                        'activity_message' => $campaignType . ' added into On Site Brandboost Campaign',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);
                }
            }
        }

        echo json_encode($response);
        exit;
    }


    public
    function create_campaign(Request $request)
    {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $campaignType = $request->campaign_type;
        $eventID = $request->event_id;
        $type = $request->event_type;
        $brandboostType = $request->brandboost_type;
        $brandboostID = $this->session->userdata('brandboostID');
        $aResponse = $this->mFeedback->getFeedbackResponse($brandboostID);
        if (!empty($aResponse)) {
            $fromName = $aResponse->from_name;
            $fromEmail = $aResponse->from_email;
        } else {
            $fromName = $aUser->firstname . ' ' . $aUser->lastname;
            $fromEmail = $aUser->email;
        }

        if ($type == 'main') {
            $emailTempalteID = ($brandboostType == 'onsite') ? $this->default_main_email_template_onsite : $this->default_main_email_template_offsite;
            $smsTempalteID = ($brandboostType == 'onsite') ? $this->default_main_sms_template_onsite : $this->default_main_sms_template_offsite;
            $dateTimeData = array("delay_type" => 'after', "delay_value" => $this->default_main_email_delay_value, "delay_unit" => $this->default_main_email_delay_unit);
        } else if ($type == 'reminder') {
            $emailTempalteID = ($brandboostType == 'onsite') ? $this->default_reminder_email_template_onsite : $this->default_reminder_email_template_offsite;
            $smsTempalteID = ($brandboostType == 'onsite') ? $this->default_reminder_sms_template_onsite : $this->default_reminder_sms_template_onffsite;
            $dateTimeData = array("delay_type" => 'after', "delay_value" => $this->default_reminder_email_delay_value, "delay_unit" => $this->default_reminder_email_delay_unit);
        } else {
            return 0;
        }
        if (!empty($request)) {
            if ($eventID) {
                $resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempalteID);
                $resultData = $resultData[0];
                if ($campaignType == 'Email') {

                    $cData = array(
                        'event_id' => $eventID,
                        'content_type' => 'Regular',
                        'campaign_type' => 'Email',
                        'name' => $resultData->template_name,
                        'subject' => $resultData->template_subject,
                        'html' => $resultData->template_content,
                        'template_source' => $emailTempalteID,
                        'from_email' => $fromEmail,
                        'from_name' => $fromName,
                        'reply_to' => $fromEmail,
                        'status' => 1,
                        'created' => date("Y-m-d H:i:s")
                    );
                } else {
                    $cData = array(
                        'event_id' => $eventID,
                        'content_type' => 'Plain Text',
                        'campaign_type' => 'SMS',
                        'name' => $resultData->template_name,
                        'subject' => $resultData->template_subject,
                        'html' => $resultData->template_content,
                        'template_source' => $emailTempalteID,
                        'status' => 1,
                        'created' => date("Y-m-d H:i:s")
                    );
                }
                $campaignId = $this->mBrandboost->addCampaign($cData);
                if ($campaignId) {
                    //Add Useractivity log
                    $aActivityData = array(
                        'user_id' => $userID,
                        'event_type' => 'brandboost_onsite',
                        'action_name' => 'added_campaign',
                        'brandboost_id' => $brandboostID,
                        'campaign_id' => $campaignId,
                        'inviter_id' => $eventID,
                        'subscriber_id' => '',
                        'feedback_id' => '',
                        'activity_message' => $campaignType . ' added into On Site Brandboost Campaign',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);

                    $response['status'] = 'success';
                } else {
                    $response['status'] = "Error";
                }

                echo json_encode($response);
                exit;
            }
        }
    }

    public
    function update_event(Request $request)
    {
        $response = array();


        $eventID = $request->event_id;
        $delayValue = $request->delay_value;
        $delayUnit = $request->delay_unit;
        $eventType = $request->event_type;
        $nodeType = $request->node_type;

        if ($eventID) {
            $eventData = array("delay_type" => "after", "delay_value" => $delayValue, "delay_unit" => $delayUnit, "event_type" => $eventType, "node_type" => $nodeType);
            $eventData = json_encode($eventData);
            $eData = array(
                //'event_type' => 'follow-up',
                'data' => $eventData,
                'updated' => date("Y-m-d H:i:s")
            );

            $campaignId = $this->mBrandboost->updateEvent($eData, $eventID);
            if ($campaignId) {
                //Add Useractivity log
                $aUser = getLoggedUser();
                $userID = $aUser->id;


                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_offsite',
                    'action_name' => 'updated_trigger_time',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => $eventID,
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Trigger Time Updated of a Brandboost Campaign',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function delete_campaign(Request $request)
    {
        $response = array();

        $campaignID = $request->campaign_id;
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($campaignID > 0) {
            $campaign = $this->mBrandboost->deleteCampaign($campaignID);
            if ($campaign) {
                //Add Useractivity log
                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_offsite',
                    'action_name' => 'deleted_campaign',
                    'brandboost_id' => '',
                    'campaign_id' => $campaignID,
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Email/Sms Campaign deleted',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);

                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function delete_event(Request $request)
    {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty(!empty($request))) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $eventID = $request->event_id;
        if ($eventID > 0) {
            //Get Current Node
            $currentNode = $this->mBrandboost->getEmailAutomationEvent($eventID);
            $currentNodePreviousID = $currentNode->previous_event_id;
            //Get Previous Node
            $previousNode = $this->mBrandboost->getEmailAutomationEvent($currentNodePreviousID);
            //Get Next Node
            $nextNode = $this->mBrandboost->getEmailAutomationEventByPreviousID($eventID);

            $bDeleted = $this->mBrandboost->deleteEmailAutomationEvent($eventID);
        }


        if ($bDeleted == true) {
            $aLinkedData = array('previous_event_id' => $previousNode->id);
            $bLinked = $this->mBrandboost->updateEmailAutomationEvent($aLinkedData, $nextNode->id);
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_email_automation',
                'action_name' => 'deleted_campaign',
                'list_id' => '',
                'brandboost_id' => '',
                'campaign_id' => $campaignID,
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Campaign deleted successfully',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'msg' => "campaign deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }

    public
    function updateStatus(Request $request)
    {
        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandboostID = $this->session->userdata('brandboostID');
        $aBrandboostData = array(
            'status' => 1,
        );
        $result = $this->mBrandboost->update($userID, $aBrandboostData, $brandboostID);
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public
    function updateBrandBoost(Request $request)
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();


        $actionName = $request->action_name; //add or edit
        $title = $request->title;
        $desc = $request->desc;
        $bAllowComment = $request->allow_comment;
        $bAllowVideoReview = $request->allow_video_reviews;
        $bAllowHelpful = $request->allow_helpful;
        $bAllowLiveReading = $request->allow_live_reading;
        $bAllowRatings = $request->allow_ratings;
        $bAllowTimestamp = $request->allow_timestamp;
        $bAllowProsCons = $request->allow_pros_cons;
        $bgColor = $request->bg_color;
        $textColor = $request->text_color;
        $bStatus = $request->status;
        $brandboostID = $request->brandId;
        $widgettype = $this->session->userdata('selectedOnsiteWidget');
        $numofrev = $request->numofrev;
        $domainName = $request->domain_name;
        $pro_cons = $request->pro_cons;
        $logoImageFileName = $request->logo_img;
        $brandImageFileName = $request->brand_img;

        $review_expire = $request->review_expire;
        $review_expire_link = $request->review_expire_link;
        $revExpireLink = array();
        if ($review_expire_link == 'custom') {

            $txtInteger = $request->txtInteger;
            $exp_duration = $request->exp_duration;
            $revExpireLink['delay_value'] = $txtInteger;
            $revExpireLink['delay_unit'] = $exp_duration;
        } else {

            $revExpireLink['delay_value'] = 'never';
            $revExpireLink['delay_unit'] = 'never';
        }


        $aBrandboostData = array(
            'brand_title' => $title,
            'brand_desc' => $desc,
            'brand_img' => $brandImageFileName,
            'logo_img' => $logoImageFileName,
            'allow_comments' => $bAllowComment,
            'allow_video_reviews' => $bAllowVideoReview,
            'allow_helpful_feedback' => $bAllowHelpful,
            'allow_live_reading_review' => $bAllowLiveReading,
            'allow_comment_ratings' => $bAllowRatings,
            'allow_review_timestamp' => $bAllowTimestamp,
            'allow_pros_cons' => $bAllowProsCons,
            'bg_color' => $bgColor,
            'text_color' => $textColor,
            'widget_type' => $widgettype,
            'domain_name' => $domainName,
            'pro_cons' => $pro_cons,
            'link_expire_review' => $review_expire,
            'link_expire_custom' => json_encode($revExpireLink),
            'num_of_review' => $numofrev
        );


        if ($actionName == 'update') {
            $result = $this->mBrandboost->update($userID, $aBrandboostData, $brandboostID);
            $this->session->set_userdata('brandboostID', $brandboostID);
        }

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public
    function reviewsbeta()
    {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $aReviews = $this->mReviews->getMyBranboostReviews($userID);
        $bActiveSubsription = $this->mUser->isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Reviews" class="sidebar-control active hidden-xs ">Reviews</a></li>
			</ul>';

        $aData = array(
            'title' => 'Brand Boost Reviews',
            'pagename' => $breadcrumb,
            'oCampaign' => '',
            'aReviews' => $aReviews,
            'campaignId' => '',
            'userId' => $userID,
            'bActiveSubsription' => $bActiveSubsription
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/review_list_adt_beta', $aData);
    }

    public
    function getReviewData(Request $request)
    {
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();


        if (!empty($request)) {
            $draw = $request->draw;
            $start = $request->start;
            $rowperpage = $request->length;
            $columnIndex = $request->order[0]['column'];
            $columnName = $request->columns[$columnIndex]['data'];
            $columnSortOrder = $request->order[0]['dir'];
            $searchValue = $request->search['value'];
            $reviewstatus = $request->columns[7]['search']['value'];
            $reviewcategory = $request->columns[6]['search']['value'];


            $totalData = $this->mReviews->getMyBranboostReviews($userID, $searchValue, $reviewstatus, $reviewcategory);
            $totalRecords = count($totalData);

            $searchRecord = $this->mReviews->getMyBranboostReviewsFilter($userID, $searchValue, $reviewstatus, $reviewcategory);
            $totalRecordwithFilter = count($searchRecord);

            $reviewsData = $this->mReviews->getMyBranboostReviewsFilter($userID, $searchValue, $reviewstatus, $reviewcategory, $columnName, $columnSortOrder, $start, $rowperpage);

            $data = array();

            list($canRead, $canWrite) = fetchPermissions('Reviews');

            foreach ($reviewsData as $oReview) {

                $data[] = array(
                    "sortById" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'sortById'), true),
                    "checkbox" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'checkbox'), true),

                    "firstname" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'name'), true),
                    "ratings" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'ratings'), true),
                    "review_title" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'review_title'), true),
                    "created" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'created'), true),
                    "tags" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'tags'), true),
                    "category" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'category'), true),
                    "status" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'canWrite' => $canWrite, 'fieldType' => 'status'), true),
                    "action" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'canWrite' => $canWrite, 'fieldType' => 'action'), true),
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => count($searchRecord),
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => $data
            );

            echo json_encode($response);
            exit;
        }
    }


    public
    function getMediaData(Request $request)
    {
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();


        if (!empty($request)) {
            $draw = $request->draw;
            $start = $request->start;
            $rowperpage = $request->length;
            $columnIndex = $request->order[0]['column'];
            $columnName = $request->columns[$columnIndex]['data'];
            $columnSortOrder = $request->order[0]['dir'];
            $searchValue = $request->search['value'];
            $reviewstatus = $request->columns[7]['search']['value'];
            $reviewcategory = $request->columns[6]['search']['value'];

            $totalData = $this->mReviews->getCampaignReviewsList($userID, $searchValue, $reviewstatus);
            $totalRecords = count($totalData);

            $searchRecord = $this->mReviews->getCampaignReviewsListFilter($userID, $searchValue, $reviewstatus);
            $totalRecordwithFilter = count($searchRecord);

            $reviewsData = $this->mReviews->getCampaignReviewsListFilter($userID, $searchValue, $reviewstatus, $columnName, $columnSortOrder, $start, $rowperpage);

            $data = array();

            list($canRead, $canWrite) = fetchPermissions('Reviews');

            foreach ($reviewsData as $oReview) {

                $data[] = array(
                    "media" => $this->load->view('/admin/brandboost/dataview/media', array('oReview' => $oReview, 'fieldType' => 'media'), true),
                    "rating" => $this->load->view('/admin/brandboost/dataview/media', array('oReview' => $oReview, 'fieldType' => 'rating'), true),
                    "campaign" => $this->load->view('/admin/brandboost/dataview/media', array('oReview' => $oReview, 'fieldType' => 'campaign'), true),
                    "contact" => $this->load->view('/admin/brandboost/dataview/media', array('oReview' => $oReview, 'fieldType' => 'contact'), true),
                    "created" => $this->load->view('/admin/brandboost/dataview/media', array('oReview' => $oReview, 'fieldType' => 'created'), true),
                    "file" => $this->load->view('/admin/brandboost/dataview/media', array('oReview' => $oReview, 'fieldType' => 'file'), true),
                    "action" => $this->load->view('/admin/brandboost/dataview/media', array('oReview' => $oReview, 'canWrite' => $canWrite, 'fieldType' => 'action'), true),
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => count($searchRecord),
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => $data
            );

            echo json_encode($response);
            exit;
        }
    }

    public
    function sitereviews($campaignId)
    {

        if (!empty($campaignId)) {

            $oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId);
            $aReviews = $this->mReviews->getCampaignReviews($campaignId);
            $bActiveSubsription = $this->mUser->isActiveSubscription();

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a class="sidebar-control hidden-xs slace">/</a></li>
				<li><a data-toggle="tooltip" data-placement="bottom" title="Site Reviews" class="sidebar-control active hidden-xs ">Site Reviews</a></li>
				</ul>';

            $this->template->load('admin/admin_template_new', 'admin/brandboost/site_review_list', array('title' => 'Brand Boost Site Reviews', 'pagename' => $breadcrumb, 'oCampaign' => $oCampaign, 'aReviews' => $aReviews, 'campaignId' => $campaignId, 'bActiveSubsription' => $bActiveSubsription));
        }
    }

    public
    function review_comment($reviewId = 0)
    {

        $aComments = $this->mComment->getCampReviewComment($reviewId);
        $oCampaign = $aComments[0];

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active"><a href="' . base_url('admin/brandboost/onsite') . '">' . $oCampaign->brand_title . '</a></li>
			<li class="active"><a href="' . base_url('admin/brandboost/reviews/' . $oCampaign->bb_id) . '">Reviews</a></li>
			<li class="active">Comments</li>
			</ul>';

        $this->template->load('admin/admin_template_new', 'admin/brandboost/review_comments_list', array('title' => 'Brand Boost Comments', 'pagename' => $breadcrumb, 'aComments' => $aComments, 'reviewId' => $reviewId));
    }

    public
    function email_templates($campaignID)
    {
        $userID = $this->session->userdata("current_user_id");

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active"><a href="' . base_url('admin/brandboost/email_followup') . '">Follow Up</a></li>
			<li class="active">Email</li>
			</ul>';

        $data = array(
            'title' => 'Brand Boost Email Template',
            'pagename' => $breadcrumb,
            'templatedata' => $this->mBrandboost->getAllCampaignTemplatesByUserID($userID),
            'campaign_id' => $campaignID
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/email_template', $data);
    }

    public
    function sms_templates($campaignID)
    {
        $userID = $this->session->userdata("current_user_id");

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active"><a href="' . base_url('admin/brandboost/email_followup') . '">Follow Up</a></li>
			<li class="active">SMS</li>
			</ul>';

        $data = array(
            'title' => 'Brand Boost Sms Template',
            'pagename' => $breadcrumb,
            'templatedata' => $this->mBrandboost->getAllSMSCampaignTemplatesByUserID($userID),
            'campaign_id' => $campaignID
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/sms_templates', $data);
    }

    public
    function campaign_email_template($campaignID, $templateID)
    {
        $userID = $this->session->userdata("current_user_id");
        $campaignDetail = $this->mBrandboost->getCampaignBycampID($campaignID);
        $templateDetail = $this->mBrandboost->getAllCampaignTemplates($templateID);

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li><a href="' . base_url('admin/brandboost/email_templates/' . $campaignID) . '">Email Template</a></li>
			<li class="active">' . $templateDetail[0]->template_name . '</li>
            </ul>';

        $data = array(
            'title' => 'Brand Boost Email Template',
            'pagename' => $breadcrumb,
            'templateData' => $templateDetail,
            'campaign_id' => $campaignID,
            'campaignData' => $campaignDetail
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/campaign_email_template', $data);
    }

    public
    function campaign_sms_template($campaignID, $templateID)
    {
        $userID = $this->session->userdata("current_user_id");
        $campaignDetail = $this->mBrandboost->getCampaignBycampID($campaignID);
        $templateDetail = $this->mBrandboost->getAllCampaignTemplates($templateID);

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li><a href="' . base_url('admin/brandboost/sms_templates/' . $campaignID) . '">SMS Template</a></li>
			<li class="active">' . $templateDetail[0]->template_name . '</li>
            </ul>';

        $data = array(
            'title' => 'Brand Boost SMS Template',
            'pagename' => $breadcrumb,
            'templateData' => $templateDetail,
            'campaign_id' => $campaignID,
            'campaignData' => $campaignDetail
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/campaign_sms_template', $data);
    }

    public
    function update_campaign(Request $request)
    {

        $response = array();

        if (!empty($request)) {
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            //$templateName = $request->template_name;
            $templateSubject = $request->template_subject;
            $heading = $request->template_heading;
            $introduction = $request->template_introduction;
            $greeting = $request->template_greeting;
            $templateContent = $request->template_content;
            $templateId = $request->template_id;
            $campaignId = $request->campaign_id;
            $campaignHtmlTemp = $request->campaignHtmlTemp;

            $aData = array(
                'name' => $templateName,
                'subject' => $templateSubject,
                'heading' => $heading,
                'introduction' => $introduction,
                'greeting' => $greeting,
                'template_source' => $templateId,
                'status' => 1,
                'description' => base64_encode($templateContent),
                'html' => base64_encode($campaignHtmlTemp)
            );

            $result = $this->mBrandboost->updateCampaing($aData, $campaignId);
            if ($result) {
                //Add Useractivity log
                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_offsite',
                    'action_name' => 'updated_campaign_content',
                    'brandboost_id' => '',
                    'campaign_id' => $campaignId,
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Campaign content template updated',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);

                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }


    public
    function publish_campaign(Request $request)
    {

        $response = array();

        if (!empty($request)) {
            $country_code = '';
            $country_ext = '';
            $brandboostID = $request->brandboost_id;
            $rewardValue = $request->reward_value;
            $rewardTypeId = $request->reward_type_id;
            $receiveRewardType = $request->receive_reward_type;
            $userID = $this->session->userdata("current_user_id");
            $country_code = $request->country_code;
            $country_ext = $request->country_ext;

            $aData = array(
                'reward_value' => $rewardValue,
                'receive_reward_type' => $receiveRewardType,
                'reward_type_id' => $rewardTypeId,
                'country_code' => $country_code,
                'country_ext' => $country_ext,
                'status' => 1,
            );

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function template_add(Request $request)
    {

        $response = array();

        if (!empty($request)) {
            $userID = $this->session->userdata("current_user_id");
            $title = $request->title;
            $subject = $request->subject;
            $emailtemplate = $request->emailtemplate;
            $templatetype = $request->template_type;

            $aData = array(
                'user_id' => $userID,
                'template_name' => $title,
                'template_subject' => $subject,
                'template_content' => base64_encode($emailtemplate),
                'created' => date("Y-m-d H:i:s"),
                'template_type' => $templatetype,
                'status' => 1
            );

            $result = $this->mBrandboost->addCampaingTemplate($aData);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function get_template_by_Id(Request $request)
    {

        $response = array();

        if (!empty($request)) {

            $tempID = $request->tempID;
            $result = $this->mBrandboost->getAllCampaignTemplates($tempID);

            if ($result) {
                $response['status'] = 'success';
                $response['result'] = $result;
                $response['email_template'] = base64_decode($result[0]->template_content);
            } else {
                $response['message'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function getCampaign(Request $request)
    {
        $mBrandboost = new BrandboostModel();

        $campaignId = $request->campaignId;
        //$result = $this->mBrandboost->getCampaignBycampID($campaignId);
        $result = $mBrandboost->getCampaignBycampID($campaignId);
        if ($result) {
            //pre($result);
            $response['status'] = 'success';
            $response['campData'] = $result[0];
            $response['emailContent'] = base64_decode($result[0]->html);
            $response['description'] = base64_decode($result[0]->description);
            $response['createdVal'] = 'Created: ' . date("M d, Y h:i A", strtotime($result[0]->created)) . ' (' . timeAgo($result[0]->created) . ')';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /*
     * Function to get information of the selected review campaign
     */

    public
    function getReviewCampaign(Request $request)
    {
        $mBrandboost = new BrandboostModel();

        $campaign_id = $request->campaign_id;

        $result = $mBrandboost->getReviewCampaignBycampID($campaign_id);

        if ($result) {
            //pre($result);
            $response['status'] = 'success';
            $response['campData'] = $result[0];
            $response['campaign_id'] = $result[0]->id;
            $response['campaignName'] = $result[0]->brand_title;
            $response['description'] = $result[0]->brand_desc;
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    public
    function update_template(Request $request)
    {

        $response = array();

        if (!empty($request)) {
            $title = $request->title;
            $subject = $request->subject;
            $emailtemplate = $request->emailtemplate;
            $tempId = $request->tempId;

            $aData = array(
                'template_name' => $title,
                'template_subject' => $subject,
                'template_content' => base64_encode($emailtemplate),
                'updated' => date("Y-m-d H:i:s")
            );

            $result = $this->mBrandboost->updateCampaingTemplate($tempId, $aData);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function delete_template(Request $request)
    {

        $response = array();

        if (!empty($request)) {

            $tempID = $request->tempID;
            $result = $this->mBrandboost->deleteCampaingTemplate($tempID);

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function offsite_step_1()
    {
        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li><a href="' . base_url('admin/brandboost/email_templates/' . $campaignID) . '">Email Template</a></li>
			<li class="active">Brand Boost Offsite Steps</li>
            </ul>';
        $brandboostID = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandboostID);
        $offstepdata = $this->rOffsites->getOffsite();
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template_new', 'admin/brandboost/offsite_step_1', array('title' => 'Brand Boost Offsite Steps', 'pagename' => $breadcrumb, 'bActiveSubsription' => $bActiveSubsription, 'offstep' => $offstepdata, 'aBrandbosts' => $getBrandboost[0]));
    }

    public
    function test()
    {
        $this->template->load('admin/admin_template_new', 'admin/brandboost/testing');
    }

    public
    function delete_multipal_offsite_brandboost_review(Request $request)
    {
        $response = array();

        if (!empty($request)) {

            $multiReviewsId = $request->multi_reviews_id;
            foreach ($multiReviewsId as $revId) {
                $result = $this->mBrandboost->delOffsiteReview($revId);
            }
        }
        $response['status'] = 'success';
        echo json_encode($response);
        exit;
    }

    public
    function offsite_step_3()
    {

        $brandboostID = $this->session->userdata('brandboostID');
        $result = $this->mBrandboost->getBrandboost($brandboostID);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/offsite_step_3', array('getOffsite' => $result, 'bActiveSubsription' => $bActiveSubsription));
    }


    // This method is deprecated now
    public
    function update_offsite_step1(Request $request)
    {

        $response = array();

        if (!empty($request)) {

            $brandboostID = $request->brandboostID;
            $this->session->set_userdata('brandboostID', $brandboostID);

            $response['status'] = 'success';
            echo json_encode($response);
            exit;
        }
    }

    //This method is deprecated now
    public
    function editOnsite(Request $request)
    {

        $response = array();

        if (!empty($request)) {
            $brandboostID = $request->brandboostID;
            $this->session->set_userdata('brandboostID', $brandboostID);
            $this->session->set_userdata("setTab", 'Reviews');
            $response['status'] = 'success';
            echo json_encode($response);
            exit;
        }
    }

    public
    function add_offsite(Request $request)
    {

        $response = array();

        $userID = $this->session->userdata("current_user_id");
        $brandboostID = $this->session->userdata('brandboostID');
        if (!empty($request)) {

            $offset_id = $request->offstepIds;
            $offstepIds = serialize($offset_id);
            $newOffsiteUrl = array();
            foreach ($offset_id as $val) {
                if ($val > 0) {
                    $newOffsiteUrl[$val] = '';
                }
            }
            $offsiteUrl = serialize($newOffsiteUrl);

            $aData = array(
                'offsite_ids' => $offstepIds,
                'offsites_links' => $offsiteUrl
            );


            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }


    public
    function edit_offsite()
    {

        $brandId = $this->uri->segment(4);
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $offstepdata = $this->rOffsites->getOffsite();
        $this->template->load('admin/admin_template', 'admin/brandboost/edit_offsite', array('aBrandbosts' => $getBrandboost[0], 'brandId' => $brandId, 'offstep' => $offstepdata));
    }

    public
    function edit_offsite_step1(Request $request)
    {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if (!empty($request)) {

            $campaignName = $request->campaignName;
            $brandboostID = $request->brandboostId;

            $aData = array(
                'brand_title' => $campaignName
            );

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);

            if ($result) {
                $this->session->set_userdata('brandboostID', $brandboostID);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }


    public
    function subscribers($listId)
    {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $rLists = new ReviewlistsModel();
        $mBrandboost = new BrandboostModel();
        $allSubscribers = $rLists->getAllSubscribersList($listId);
        $getBrandboost = $mBrandboost->getBrandboost($listId);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
            <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
            <li><a href="' . base_url('admin/brandboost/onsite') . '">' . $getBrandboost[0]->brand_title . '</a></li>
            </ul>';

        $aData = array(
            'title' => 'Brand Boost Subscribers',
            'pagename' => $breadcrumb,
            'subscribersData' => $allSubscribers,
            'list_id' => $listId
        );

        return view('admin.brandboost.list_subscribers_page', $aData);
    }

    public
    function add_subscriber(Request $request)
    {
        $response = array();

        //pre(!empty($request));
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if (empty(!empty($request))) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }


        $brandboostID = $request->listId;

        if (empty($brandboostID)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }
        $emailUserId = '';
        $firstName = $request->firstname;
        $lastName = $request->lastname;
        $email = $request->email;
        //$emailUser = getUserDetailByEmailId($email);
        $oUserAccount = $this->mUser->checkEmailExist($email);
        if (!empty($oUserAccount)) {
            $emailUserId = $oUserAccount[0]->id;
        }

        $phone = $request->phone;

        $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
        if (!empty($oGlobalUser)) {
            $iSubscriberID = $oGlobalUser->id;
        } else {
            //Add global subscriber
            $aSubscriberData = array(
                'owner_id' => $userID,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'created' => date("Y-m-d H:i:s")
            );
            if (!empty($emailUserId)) {
                $aSubscriberData['user_id'] = $emailUserId;
            }
            $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
        }

        //$userID = $this->session->userdata("current_user_id");


        $aData = array(
            'user_id' => $emailUserId,
            'brandboost_id' => $brandboostID,
            'subscriber_id' => $iSubscriberID,
            'created' => date("Y-m-d H:i:s")
        );

        $result = $this->rLists->addSubscriber($aData);
        if ($result) {

            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'brandboost_onsite_offsite',
                'action_name' => 'added_user',
                'brandboost_id' => $brandboostID,
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Added subscriber into the brandboost',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response['status'] = 'success';
            $response['id'] = $result;
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    public
    function getSubscriberById(Request $request)
    {

        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $aSubscriber = $this->rLists->getSubscriber($request->subscriberID);
            if ($aSubscriber) {
                $response['status'] = 'success';
                $response['result'] = $aSubscriber;
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function update_subscriber(Request $request)
    {

        $response = array();
        $response['status'] = 'error';
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($request)) {
            $firstname = $request->edit_firstname;
            $lastname = $request->edit_lastname;
            $email = $request->edit_email;
            $phone = $request->edit_phone;
            $subscriberID = $request->edit_subscriberID;
            $bInsertedNewGlobalSubscriber = false;

            if (!empty($email)) {

                $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
                if (!empty($oGlobalUser)) {
                    $iSubscriberID = $oGlobalUser->id;
                    $aGlobalUserData = array(
                        'email' => $email,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'phone' => $phone,
                        'updated' => date("Y-m-d H:i:s")
                    );
                    $this->mSubscriber->updateGlobalSubscriber($aGlobalUserData, $iSubscriberID);
                    $response = array('status' => 'success', 'msg' => "Subscriber updated successfully!");
                } else {
                    //Add global subscriber
                    $oUserAccount = $this->mUser->checkEmailExist($email);
                    if (!empty($oUserAccount)) {
                        $emailUserId = $oUserAccount[0]->id;
                    }
                    $aSubscriberData = array(
                        'owner_id' => $userID,
                        'firstName' => $firstname,
                        'lastName' => $lastname,
                        'email' => $email,
                        'phone' => $phone,
                        'created' => date("Y-m-d H:i:s")
                    );
                    if (!empty($emailUserId)) {
                        $aSubscriberData['user_id'] = $emailUserId;
                    }
                    $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                    $bInsertedNewGlobalSubscriber = true;
                }
            }

            if ($bInsertedNewGlobalSubscriber == true) {
                $aData = array(
                    'subscriber_id' => $iSubscriberID
                );

                $result = $this->rLists->updateSubscriber($aData, $subscriberID);

                if ($result) {
                    $aUser = getLoggedUser();
                    $userID = $aUser->id;
                    $aActivityData = array(
                        'user_id' => $userID,
                        'event_type' => 'brandboost_onsite_offsite',
                        'action_name' => 'updated_subscriber',
                        'brandboost_id' => '',
                        'campaign_id' => '',
                        'inviter_id' => '',
                        'subscriber_id' => $subscriberID,
                        'feedback_id' => '',
                        'activity_message' => 'Subscriber was updated of brandboost',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);

                    $response['status'] = 'success';
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public
    function delete_multipal_subscriber(Request $request)
    {

        $response = array();

        if (!empty($request)) {

            $multiSubscriberId = $request->multiSubscriberId;

            foreach ($multiSubscriberId as $subscriberID) {
                $result = $this->rLists->deleteSubscriber($subscriberID);
                if ($result) {
                    //Add Useractivity log
                    $aUser = getLoggedUser();
                    $userID = $aUser->id;


                    $aActivityData = array(
                        'user_id' => $userID,
                        'event_type' => 'brandboost_onsite_offsite',
                        'action_name' => 'deleted_susbcriber',
                        'brandboost_id' => '',
                        'campaign_id' => '',
                        'inviter_id' => '',
                        'subscriber_id' => $subscriberID,
                        'feedback_id' => '',
                        'activity_message' => 'Subscriber deleted from Brandboost',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);
                    $response['status'] = 'success';
                } else {
                    $response['status'] = "Error";
                }
            }

            echo json_encode($response);
            exit;
        }
    }


    public
    function delete_subscriber(Request $request)
    {

        $response = array();

        if (!empty($request)) {

            $subscriberID = $request->subscriberId;

            $result = $this->rLists->deleteSubscriber($subscriberID);
            if ($result) {
                //Add Useractivity log
                $aUser = getLoggedUser();
                $userID = $aUser->id;


                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'brandboost_onsite_offsite',
                    'action_name' => 'deleted_susbcriber',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => $subscriberID,
                    'feedback_id' => '',
                    'activity_message' => 'Subscriber deleted from Brandboost',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function importcsv(Request $request)
    {
        $someoneadded = false;

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $list_site = $request->list_site;
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        //$userID = $this->session->userdata("current_user_id");
        $brandboostID = $request->list_id;

        $this->load->library('upload', $config);

        // If upload failed, display error
        if (!$this->upload->do_upload()) {

        } else {

            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                $emailUserId = '';
                foreach ($csv_array as $row) {

                    $firstName = $row['FIRST_NAME'];
                    $lastName = $row['LAST_NAME'];
                    $email = $row['EMAIL'];
                    $phone = $row['PHONE'];

                    $oUserAccount = $this->mUser->checkEmailExist($email);
                    if (!empty($oUserAccount)) {
                        $emailUserId = $oUserAccount[0]->id;
                    }

                    $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
                    if (!empty($oGlobalUser)) {
                        $iSubscriberID = $oGlobalUser->id;
                    } else {
                        //Add global subscriber
                        $aSubscriberData = array(
                            'owner_id' => $userID,
                            'firstName' => $firstName,
                            'lastName' => $lastName,
                            'email' => $email,
                            'phone' => $phone,
                            'created' => date("Y-m-d H:i:s")
                        );
                        if (!empty($emailUserId)) {
                            $aSubscriberData['user_id'] = $emailUserId;
                        }
                        $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                    }


                    $aData = array(
                        'brandboost_id' => $brandboostID,
                        'user_id' => $emailUserId,
                        'subscriber_id' => $iSubscriberID,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $result = $this->rLists->addSubscriber($aData);
                    $someoneadded = true;
                }
                if ($someoneadded == true) {
                    //Add Useractivity log

                    $aActivityData = array(
                        'user_id' => $userID,
                        'event_type' => 'brandboost_onsite_offsite',
                        'action_name' => 'added_user_import',
                        'brandboost_id' => $brandboostID,
                        'campaign_id' => '',
                        'inviter_id' => '',
                        'subscriber_id' => '',
                        'feedback_id' => '',
                        'activity_message' => 'Users imported into the brandboost',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);
                }

                if (!empty($result)) {

                    //redirect('admin/brandboost/subscribers/'.$brandboostID);
                    if ($list_site == 'onsite') {
                        redirect('admin/brandboost/setup/onsite');
                    } else {
                        redirect('admin/brandboost/offsite_setup/' . $brandboostID);
                    }
                }
            } else {
                $data['error'] = "Error occured";
            }
        }
    }

    // Export data in CSV format
    public
    function exportCSV(Request $request)
    {
        // file name
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");


        $brandboostID = $request->list_id;
        $userID = $this->session->userdata("current_user_id");
        $allSubscribers = $this->rLists->getSubscribers($userID, $brandboostID);

        // file creation
        $file = fopen('php://output', 'w');

        $header = array("EMAIL", "FIRST_NAME", "LAST_NAME", "PHONE");
        fputcsv($file, $header);
        foreach ($allSubscribers as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        //Add Useractivity log

        $aActivityData = array(
            'user_id' => $userID,
            'event_type' => 'brandboost_onsite_offsite',
            'action_name' => 'downloaded_user_export',
            'brandboost_id' => $brandboostID,
            'campaign_id' => '',
            'inviter_id' => '',
            'subscriber_id' => '',
            'feedback_id' => '',
            'activity_message' => 'Users exported from brandboost',
            'activity_created' => date("Y-m-d H:i:s")
        );
        logUserActivity($aActivityData);
        exit;
    }

    public
    function email_template_popup(Request $request)
    {

        $response = array();

        if (!empty($request)) {
            $camp_id = $request->camp_id;
            $camp_temp_src = $request->camp_temp_src;

            $data = array(
                'templateData' => $this->mBrandboost->getAllCampaignTemplates($camp_temp_src),
                'campaign_id' => $camp_id,
                'campaignData' => $this->mBrandboost->getCampaignBycampID($camp_id)
            );

            $this->load->view('/admin/brandboost/email_template_popup', $data);
        }
    }

    public
    function sms_template_popup(Request $request)
    {

        $response = array();

        if (!empty($request)) {
            $camp_id = $request->camp_id;
            $camp_temp_src = $request->camp_temp_src;

            $data = array(
                'templateData' => $this->mBrandboost->getAllCampaignTemplates($camp_temp_src),
                'campaign_id' => $camp_id,
                'campaignData' => $this->mBrandboost->getCampaignBycampID($camp_id)
            );

            $this->load->view('/admin/brandboost/sms_template_popup', $data);
        }
    }

    public
    function unsubscribeUser($brandboostID, $subscriberID)
    {
        $response = array();
        $result = $this->mBrandboost->unsubscribeUser($brandboostID, $subscriberID);
        if ($result) {
            $slug = 'unsubscribe-subscriber';
            sendEmailTemplate($slug, $subscriberID);
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    public
    function unsubscriber_user(Request $request)
    {
        $response = array();

        if (!empty($request)) {
            $email = $request->subscriber_email;
            $subscriberID = $request->subscriberid;
            $aData = array(
                'email' => $email,
                'created' => date("Y-m-d H:i:s")
            );

            $result = $this->mBrandboost->updateSubscriberStatusByEmail($email);
            $result = $this->mBrandboost->unsubscribeUserAC($aData);

            if ($result) {
                $slug = 'unsubscribe-subscriber';
                sendEmailTemplate($slug, $subscriberID);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public
    function showPWPreview(Request $request)
    {


        if (!empty($request)) {
            $hashcode = $request->hashcode;
            $widgetType = $request->widget_type;
            $showPreview = '<script type="text/javascript" id="bbscriptloader" data-key="' . $hashcode . '" data-widgets="' . $widgetType . '" async="" src="' . base_url('/assets/js/preview_widgets.js') . '"></script>';
            echo $showPreview;
        }
    }

    public
    function addOffsiteReviews(Request $request)
    {


        if (!empty($request)) {
            $siteId = $request->site_id;
            $siteApiId = $request->site_api_id;
            $api_key = "AIzaSyDcZmZhZlXUYzXmziPN1mM8YtrXx4W4OSs";
            $placeid = $siteApiId;
            $parameters = "key=$api_key&placeid=$placeid";
            $url = "https://maps.googleapis.com/maps/api/place/details/json?$parameters";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
            $result = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($result, true);

            $reviewData = $res['result']['reviews'];
            $brandboostID = $this->session->userdata('brandboostID');
            $result = '';

            foreach ($reviewData as $rData) {
                $reviewData = $this->mBrandboost->getOffsiteReviewsBYUN($rData['author_name'], 'google', $brandboostID);
                if ($brandboostID != '' && $reviewData[0]->name != $rData['author_name']) {
                    $aData = array(
                        'name' => $rData['author_name'],
                        'brandboost_id' => $brandboostID,
                        'review_content' => $rData['text'],
                        'ratings' => $rData['rating'],
                        'source' => 'google',
                        'author_url' => $rData['author_url'],
                        'profile_photo_url' => $rData['profile_photo_url'],
                        'created' => $rData['time']
                    );

                    $result = $this->mBrandboost->addOffsiteReviews($aData);
                }
            }

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
            echo json_encode($response);
            exit;
        }
    }


    public
    function setWidget(Request $request)
    {
        $response = array("status" => "error", "msg" => "Something went wrong");

        if (empty(!empty($request))) {
            $response = array("status" => "error", "msg" => "Empty request header");
            echo json_encode($response);
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $widgetID = $request->widgetID;
        $brandboostId = $request->brandboostId;
        $aData = array(
            'widget_type' => $widgetID
        );

        if (!empty($widgetID)) {
            $this->session->set_userdata("selectedOnsiteWidget", $widgetID);
            $result = $this->mBrandboost->update($userID, $aData, $brandboostId);
            $response = array("status" => "success", "msg" => "Okay");
            echo json_encode($response);
            exit;
        }
    }

    public
    function getreviwecomments(Request $request)
    {

        $response = array("status" => "error", "commentList" => '');
        if (!empty($request)) {
            $reviewID = $request->reviewId;
            $startLimit = $request->startinglimitVal;
            $actionType = $request->actionType;
            $source = $request->source;
            $limitVal = 5;
            if ($actionType == 'reply') {
                $limitVal = $startLimit + 1;
                $startLimit = 0;
            }
            $reviewCommentsData = $this->mReviews->getReviewAllComments($reviewID, $startLimit, $limitVal);
            if (count($reviewCommentsData) > 0) {
                $output = $this->load->view("admin/brandboost/comment_more_list", array('reviewCommentsData' => $reviewCommentsData, 'source' => $source), true);
                $response = array("status" => "success", "commentList" => $output, 'nunOfComment' => count($reviewCommentsData));
            } else {
                $response = array("status" => "noData", "commentList" => 'No More Comments Found...');
            }
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to get stats
     * @param type $type , $id
     * @return type
     */
    public
    function stats($type, $id)
    {
        if (empty($id)) {
            //Handle empty id error
        }
        $oBrandboost = BrandboostModel::getBrandboost($id);
        $oAllSubscribers = ListsModel::getAllSubscribersList($id);

        if ($type == 'onsite') {
            $selectedTab = Request::input('t');
            $oRequests = BrandboostModel::getReviewRequest($id);
            $oResponse = BrandboostModel::getReviewRequestResponse($id);
            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/onsite/') . '">Onsite</a></li>
				<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
				<li><a class="sidebar-control hidden-xs">' . $oBrandboost[0]->brand_title . '</a></li>
                </ul>';

            $aData = array(
                'aData' => array(
                    'oBrandboost' => $oBrandboost,
                    'oSubscriber' => $oAllSubscribers,
                    'subscribersData' => $oAllSubscribers,
                    'oRequest' => $oRequests,
                    'oResponse' => $oResponse
                ),
                'moduleName' => 'brandboost',
                'moduleUnitID' => $id,
                'title' => 'Campaign Stats',
                'pagename' => $breadcrumb,
                'selected_tab' => $selectedTab
            );

            return view('admin.brandboost.stats.onsite', $aData);
        } else if ($type == 'offsite') {

        }
    }


    public
    function getSendgridStats(Request $request)
    {

        $response = array("status" => "error", "msg" => 'Something went wrong');

        if (empty(!empty($request))) {
            $response = array("status" => "error", "msg" => 'Request object is empty');
            echo json_encode($response);
            exit;
        }

        $type = $request->type;
        $id = $request->id;
        $aStats = $this->mBrandboost->getSendgridStats($type, $id);
        if (!empty($aStats)) {
            $aCategorizedStats = $this->mBrandboost->getSendgridCategorizedStatsData($aStats);
        }

        $content = $this->load->view('admin/brandboost/stats/sendgrid-stats', array('aData' => $aCategorizedStats), TRUE);
        $response = array('status' => 'success', 'content' => $content, 'msg' => 'Request object is empty');
        echo json_encode($response);
        exit;
    }

    public
    function getTwilioStats(Request $request)
    {

        $response = array("status" => "error", "msg" => 'Something went wrong');

        if (empty(!empty($request))) {
            $response = array("status" => "error", "msg" => 'Request object is empty');
            echo json_encode($response);
            exit;
        }

        $type = $request->type;
        $id = $request->id;
        $aStats = $this->mBrandboost->getTwilioStats($type, $id);
        if (!empty($aStats)) {
            $aCategorizedStats = $this->mBrandboost->getTwilioCategorizedStatsData($aStats);
        }

        $content = $this->load->view('admin/brandboost/stats/sendgrid-stats', array('aData' => $aCategorizedStats), TRUE);
        $response = array('status' => 'success', 'content' => $content, 'msg' => 'Request object is empty');
        echo json_encode($response);
        exit;
    }

    public
    function campaigns()
    {
        $aUser = getLoggedUser();
        $currentUserId = $aUser->id;
        $oBrandboost = $this->mBrandboost->getBrandboostByUserId($currentUserId, 'onsite');
        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">Brand Boost Entire Campaign</li>
			</ul>';
        $aData = array(
            'aData' => array(
                'oBrandboost' => $oBrandboost
            ),
            'title' => 'Brand Boost Entire Campaign Data',
            'pagename' => $breadcrumb
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/campaigns', $aData);
    }

    /**
     * This function is used to get the reports
     * @param type $clientID
     * @return type
     */

    public
    function reports($bbId = '')
    {
        $aUser = getLoggedUser();
        $currentUserId = $aUser->id;
        $mBrandboost = new BrandboostModel();
        $bbStatsData = $mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId = '');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Analytics </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Reports" class="sidebar-control active hidden-xs ">Reports</a></li>
			</ul>';


        $aData = array(
            'aData' => array(
                'bbStatsData' => $bbStatsData
            ),
            'title' => 'Brand Boost Reports',
            'pagename' => $breadcrumb
        );

        return view('admin.brandboost.campaign_reports', $aData);
    }


    /**
     * This function is used to get the feedback reports
     * @param type $clientID
     * @return type
     */

    public
    function feedbackreports($bbId = '')
    {
        $aUser = getLoggedUser();
        $currentUserId = $aUser->id;
        $mBrandboost = new BrandboostModel();
        $bbStatsData = $mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId = '');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Analytics </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Feedback Reports" class="sidebar-control active hidden-xs ">Feedback Reports</a></li>
			</ul>';

        $aData = array(
            'aData' => array(
                'bbStatsData' => $bbStatsData
            ),
            'title' => 'Brand Boost Feedback Reports',
            'pagename' => $breadcrumb
        );

        return view('admin.brandboost.campaign_feedback_reports', $aData);
    }


    public
    function servicereports($bbId = '')
    {
        $currentUserId = Session::get('current_user_id');
        $mBrandboost = new BrandboostModel();
        $bbStatsData = $mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId = '');
        $positiveComments = $mBrandboost->recentComments($currentUserId, 'positive');
        $nagetiveComments = $mBrandboost->recentComments($currentUserId, 'nagetive');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Analytics </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Service Reports" class="sidebar-control active hidden-xs ">Service Reports</a></li>
			</ul>';

        $aData = array(
            'aData' => array(
                'bbStatsData' => $bbStatsData,
                'positiveComments' => $positiveComments,
                'nagetiveComments' => $nagetiveComments
            ),
            'title' => 'Brand Boost Service Reports',
            'pagename' => $breadcrumb
        );

        return view('admin.brandboost.campaign_service_reports', $aData);
    }

    public
    function reportsOptOut()
    {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Analytics </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Report Opt Out" class="sidebar-control active hidden-xs ">Report Opt Out</a></li>
                    </ul>';
        $oBrandboost = array();
        $aData = array(
            'aData' => array(
                'oBrandboost' => $oBrandboost
            ),
            'title' => 'Brand Boost Report Opt Out',
            'pagename' => $breadcrumb
        );

        return view('admin.brandboost.reportoptout', $aData);
    }

    public
    function insightTags()
    {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Analytics </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Report Insight Tags" class="sidebar-control active hidden-xs ">Report Insight Tags</a></li>
                    </ul>';
        $oBrandboost = array();
        $aData = array(
            'aData' => array(
                'oBrandboost' => $oBrandboost
            ),
            'title' => 'Brand Boost Report Insight Tags',
            'pagename' => $breadcrumb
        );

        return view('admin.brandboost.insighttags', $aData);
    }

    public
    function responseperformance()
    {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Analytics </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Response Performance" class="sidebar-control active hidden-xs ">Response Performance</a></li>
                    </ul>';
        $oBrandboost = array();
        $aData = array(
            'aData' => array(
                'oBrandboost' => $oBrandboost
            ),
            'title' => 'Brand Boost Report Response Performance',
            'pagename' => $breadcrumb
        );

        return view('admin.brandboost.reportresponse', $aData);
    }

    public
    function repResTimeTrends()
    {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Analytics </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Report Time Trends" class="sidebar-control active hidden-xs ">Report Time Trends</a></li>
                    </ul>';
        $oBrandboost = array();
        $aData = array(
            'aData' => array(
                'oBrandboost' => $oBrandboost
            ),
            'title' => 'Brand Boost Report Response Time Trends',
            'pagename' => $breadcrumb
        );

        return view('admin.brandboost.reportsresponsetimetrends', $aData);
    }


    public
    function getEmailTempByID(Request $request)
    {

        $emailTempId = $request->emailTempId;
        $resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempId);
        $resultData = $resultData[0];
        if (!empty($resultData)) {
            $template_name = $resultData->template_name;
            $template_subject = $resultData->template_subject;
            $template_content = base64_decode($resultData->template_content);
            $response = array('status' => 'success', 'name' => $template_name, 'subject' => $template_subject, 'content' => $template_content);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public
    function updateCampaignOrder(Request $request)
    {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty(!empty($request))) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $previousEventID = $request->previous_id;
        $currentEventID = $request->current_id;
        $nextEventID = $request->next_id;
        $actionName = $request->action_name;


        if ($actionName == 'attach') {
            //Step-1
            if ($previousEventID > 0) {
                $bIsMainEvent = $this->mBrandboost->isMainEvent($currentEventID);

                if ($bIsMainEvent == false) {
                    $aLinkedData = array(
                        'previous_event_id' => $previousEventID
                    );
                    $bLinked = $this->mBrandboost->updateEmailAutomationEvent($aLinkedData, $currentEventID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }
            } else {
                //Main event, so no need to touch event. here we will shuffle in campaign records
                //Current Event
                //Next Event
                $oMainCampaign = $this->mBrandboost->getEmailCampaignInfo($nextEventID);
                $oCurrentCampaign = $this->mBrandboost->getEmailCampaignInfo($currentEventID);
                //Now we will interchange event ids between these two campaigns
                if (!empty($oMainCampaign)) {
                    $mainCampaignID = $oMainCampaign->id;
                    $aCampaignData = array(
                        'event_id' => $currentEventID
                    );
                    $bUpdated = $this->mBrandboost->updateEmailAutomationCampaign($aCampaignData, $mainCampaignID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }

                if (!empty($oCurrentCampaign)) {
                    $currentCampaignID = $oCurrentCampaign->id;
                    $aCampaignData = array(
                        'event_id' => $nextEventID
                    );
                    $bUpdated = $this->mBrandboost->updateEmailAutomationCampaign($aCampaignData, $currentCampaignID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }
            }

            //Step-2
            if ($nextEventID > 0 && $previousEventID > 0) {
                //Check if current node is the main event
                $bIsMainEvent = $this->mBrandboost->isMainEvent($currentEventID);
                if ($bIsMainEvent) {
                    //As main event, so we have to shuffle only in campaigns
                    //Current Event
                    //Next Event
                    $oMainCampaign = $this->mBrandboost->getEmailCampaignInfo($currentEventID);
                    $oPreviousCampaign = $this->mBrandboost->getEmailCampaignInfo($previousEventID);

                    //Now we will interchange event ids between these two campaigns
                    if (!empty($oMainCampaign)) {
                        $mainCampaignID = $oMainCampaign->id;
                        $aCampaignData = array(
                            'event_id' => $previousEventID
                        );
                        $bUpdated = $this->mBrandboost->updateEmailAutomationCampaign($aCampaignData, $mainCampaignID);
                        $response = array('status' => 'success', 'msg' => "updated successfully!");
                    }

                    if (!empty($oPreviousCampaign)) {
                        $previousCampaignID = $oPreviousCampaign->id;
                        $aCampaignData = array(
                            'event_id' => $currentEventID
                        );
                        $bUpdated = $this->mBrandboost->updateEmailAutomationCampaign($aCampaignData, $previousCampaignID);
                        $response = array('status' => 'success', 'msg' => "updated successfully!");
                    }
                } else {
                    $aLinkedData = array(
                        'previous_event_id' => $currentEventID
                    );
                    $bLinked = $this->mBrandboost->updateEmailAutomationEvent($aLinkedData, $nextEventID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }
            }
        } else if ($actionName == 'detach') {
            if ($previousEventID > 0 && $nextEventID > 0) {
                $bIsMainEvent = $this->mBrandboost->isMainEvent($previousEventID);
                if ($bIsMainEvent == false) {
                    $aLinkedData = array(
                        'previous_event_id' => $previousEventID
                    );
                    $bLinked = $this->mBrandboost->updateEmailAutomationEvent($aLinkedData, $nextEventID);
                }
            }
            $response = array('status' => 'success', 'msg' => "updated successfully!");
        }
        echo json_encode($response);
        exit;
    }

    public
    function statistics($brandboostID)
    {
        if (empty($brandboostID)) {
            redirect("admin/");
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $bActiveSubsription = UsersModel::isActiveSubscription();
        //get Automation Info
        $oBrandData = BrandboostModel::getBrandboost($brandboostID);
        $oBrandboost = $oBrandData[0];
        //pre($oBrandboost);
        //get Brandboost Events
        $oEvents = BrandboostModel::getBrandboostEvents($brandboostID);


        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">';
        $breadcrumb .= '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>';
        if ($oBrandboost->review_type == 'onsite') {
            $breadcrumb .= '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
            $breadcrumb .= '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/onsite') . '">Onsite</a></li>';
        } else if ($oBrandboost->review_type == 'offsite') {
            $breadcrumb .= '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
            $breadcrumb .= '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/offsite') . '">Offsite</a></li>';
        }

        $breadcrumb .= '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
        $breadcrumb .= '<li><a class="sidebar-control hidden-xs">Stats</a></li>';
        $breadcrumb .= '</ul>';


        $aData = array(
            'title' => $oBrandboost->brand_title,
            'pagename' => $breadcrumb,
            'bActiveSubsription' => $bActiveSubsription,
            'oBrandboost' => $oBrandboost,
            'oEvents' => $oEvents,
            'oUser' => $oUser
        );

        return view('admin.brandboost.brandboost-stats', $aData);
    }

    public
    function exportReviews()
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oReviews = $this->mReviews->getMyBranboostReviews($userID);


        $filename = 'reviews_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        //echo "Hello";
        //die;
        // file creation
        $file = fopen('php://output', 'w');

        $header = array("CAMPAIGN_ID", "CAMPAIGN_NAME", "TYPE", "AUTHOR", "EMAIL", "PHONE", "REVIEW_TITLE", "REVIEW_DESCRIPTION", "REVIEW_DATE");
        fputcsv($file, $header);
        foreach ($oReviews as $key => $line) {
            fputcsv($file, array($line->id, $line->brand_title, $line->review_type, $line->firstname . ' ' . $line->lastname, $line->email, $line->mobile, $line->review_title, $line->comment_text, $line->review_created));
        }
        fclose($file);
        //Log Export History
        if (!empty($oReviews)) {
            $aHistoryData = array(
                'user_id' => $userID,
                'export_name' => 'Reviews',
                'item_count' => count($oReviews),
                'created' => date("Y-m-d H:i:s")
            );
            $this->mSettings->logExportHistory($aHistoryData);
        }
        exit;
    }

    public
    function exportMedia()
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oReviews = $this->mReviews->getMyBranboostReviews($userID);

        $filename = 'reviews_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        //echo "Hello";
        //die;
        // file creation
        $file = fopen('php://output', 'w');

        $header = array("MEDIA_URL", "CAMPAIGN_ID", "CAMPAIGN_NAME", "TYPE", "AUTHOR", "EMAIL", "PHONE", "REVIEW_TITLE", "REVIEW_DESCRIPTION", "REVIEW_DATE");
        fputcsv($file, $header);
        $count = 0;
        $mediaHostUrl = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/';
        foreach ($oReviews as $key => $line) {
            if (!empty($line->media_url)) {
                $count++;
                fputcsv($file, array($mediaHostUrl . $line->media_url, $line->id, $line->brand_title, $line->review_type, $line->firstname . ' ' . $line->lastname, $line->email, $line->mobile, $line->review_title, $line->comment_text, $line->review_created));
            }
        }
        fclose($file);
        //Log Export History
        if (!empty($oReviews)) {
            $aHistoryData = array(
                'user_id' => $userID,
                'export_name' => 'Media',
                'item_count' => $count,
                'created' => date("Y-m-d H:i:s")
            );
            $this->mSettings->logExportHistory($aHistoryData);
        }
        exit;
    }

    public
    function all_campaign()
    {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $aBrandboostList = $this->mBrandboost->getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = $this->mBrandboost->getBrandboostByUserId($userID, 'onsite');
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Campaigns" class="sidebar-control active hidden-xs ">Campaigns</a></li>
			</ul>';

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->session->set_userdata('setTab', '');

        $aData = array(
            'title' => 'Onsite Brand Boost Campaigns',
            'pagename' => $breadcrumb,
            'aBrandbosts' => $aBrandboostList,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/onsite_campaign', $aData);
    }

    public
    function details($id)
    {
        $oBrandboost = $this->mBrandboost->getBrandboost($id);
        if (!empty($oBrandboost)) {
            $sType = $oBrandboost[0]->review_type;
            if ($sType == 'onsite') {
                redirect("admin/brandboost/onsite_setup/" . $id);
            } else if ($sType == 'offsite') {
                redirect("admin/brandboost/offsite_setup/" . $id);
            }
            exit;
        }
    }

}
