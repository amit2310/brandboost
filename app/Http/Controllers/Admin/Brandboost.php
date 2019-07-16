<?php

namespace App\Http\Controllers\Admin;
require 'aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\SubscriberModel;
use Session;

class Brandboost extends Controller {

    var $default_main_email_template_onsite;
    var $default_main_email_template_offsite;
    var $default_main_email_delay_unit;
    var $default_main_email_delay_value;
    var $default_reminder_email_template_onsite;
    var $default_reminder_email_template_offsite;
    var $default_reminder_email_delay_unit;
    var $default_reminder_email_delay_value;

    /*public function __construct() {
        parent::__construct();

        $this->load->model("admin/Users_model", "mUser");
        $this->load->model("admin/Subscriber_model", "mSubscriber");
        $this->load->model("admin/Brandboost_model", "mBrandboost");
        $this->load->model("admin/Brand_model", "mBrand");
        $this->load->model("admin/Workflow_model", "mWorkflow");
        $this->load->model("Reviews_model", "mReviews");
        $this->load->model("Comment_model", "mComment");
        $this->load->model("admin/Offsite_model", "rOffsites");
        $this->load->model("admin/Rewards_model", "mRewards");
        $this->load->model("admin/Reviewlists_model", "rLists");
        $this->load->model("Feedback_model", "mFeedback");
        $this->load->model("admin/Settings_model", "mSettings");
        $this->load->model("admin/crons/Inviter_model", "mInviter");
        $this->load->model("admin/Live_model", "mLive");
        $this->load->model("admin/Templates_model", "mTemplates");
        $this->load->library('csvimport');
        $this->load->library('S3');

        $this->default_main_email_template_onsite = 6;
        $this->default_main_email_template_offsite = 7;
        $this->default_main_sms_template_onsite = 22;
        $this->default_main_sms_template_offsite = 22;
        $this->default_main_email_delay_unit = 'minute';
        $this->default_main_email_delay_value = 5;

        $this->default_reminder_email_template_onsite = 6;
        $this->default_reminder_email_template_offsite = 7;
        $this->default_reminder_sms_template_onsite = 22;
        $this->default_reminder_sms_template_onffsite = 22;
        $this->default_reminder_email_delay_unit = 'day';
        $this->default_reminder_email_delay_value = 1;
    }*/
	
	
	/**
	*
	* onsite template controller 
	*/
	
    public function onsiteOverview() {

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
            'company_name' => $company_name,
            'bbEmailSend' => $bbEmailSend,
            'bbSmsSend' => $bbSmsSend,
            'bbEmailSendMonth' => $bbEmailSendMonth,
            'viewstats' => true
        );

        return view('admin.brandboost.onsite_overview', $aData);
    }
	
	/**
	*
	* call on site data listing page 
	*/
	public function onsite() {
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
        }
        $moduleName = 'brandboost-onsite';

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Campaigns" class="sidebar-control active hidden-xs ">Campaigns</a></li>
			</ul>';

        $bActiveSubsription = $mUsers->isActiveSubscription();
        //$this->session->set_userdata('setTab', '');

        $aData = array(
            'title' => 'Onsite Brand Boost Campaigns',
            'pagename' => $breadcrumb,
            'aBrandbosts' => $aBrandboostList,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'company_name' => $company_name,
            'moduleName' => $moduleName,
			'viewstats' => true
        );
		
		return view('admin.brandboost.onsite_list', $aData);
    }
	

    public function index() {

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


    public function DeleteObjectFromS3() {
        $post = $this->input->post();
        if(!empty($post['dropImage']))
        {
            $dropImage = $post['dropImage'];

            $bucketName = 'brandboost.io';
            $s3Client = new S3Client([
                  'region' => 'us-west-2',
                  'version' => '2006-03-01',
                  'credentials' => [
                      'key' => 'AKIAJ52XK7ZH7VCR7XHQ',
                      'secret' => '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'
                  ],
                  // Set the S3 class to use objects.dreamhost.com/bucket
                  // instead of bucket.objects.dreamhost.com
                  'use_path_style_endpoint' => true
               ]);


            $resPonse = $s3Client->deleteObject(array(
               'Bucket' => $bucketName,
               'Key'    => $dropImage
            ));

            echo $resPonse;
        }
   }


    

    //** offsite template controller 

    public function offsite_overview() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $this->session->unset_userdata('setTab');
        if ($user_role == 1) {
            $aBrandboostList = $this->mBrandboost->getBrandboost('', 'offsite');
        } else {
            $aBrandboostList = $this->mBrandboost->getBrandboostByUserId($userID, 'offsite');
            $bbEmailSend = $this->mBrandboost->getBrandboostEmailSend($userID, 'offsite');
            $bbSmsSend = $this->mBrandboost->getBrandboostSmsSend($userID, 'offsite');

            $bbEmailSendMonth = $this->mBrandboost->getBrandboostEmailSendMonth($userID, 'offsite');
            $bbSMSSendMonth = $this->mBrandboost->getBrandboostSmsSendMonth($userID, 'offsite');
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
            <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs">Off Site </a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Overview" class="sidebar-control active hidden-xs ">Overview</a></li>
            </ul>';

        $bActiveSubsription = $this->mUser->isActiveSubscription();

        $aData = array(
            'title' => 'Offsite overview',
            'pagename' => $breadcrumb,
            'aBrandbosts' => $aBrandboostList,
            'bActiveSubsription' => $bActiveSubsription,
            'currentUserId' => $userID,
            'user_role' => $user_role,
            'viewstats' => true,
            'bbEmailSend' => $bbEmailSend,
            'bbEmailSendMonth' => $bbEmailSendMonth,
            'bbSMSSendMonth' => $bbSMSSendMonth,
            'bbSmsSend' => $bbSmsSend
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/offsite_list', $aData);
    }

    public function onsite_bk() {
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
			<li><a class="sidebar-control hidden-xs slace">/</a></li>
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
        //$this->template->load('admin/admin_template_new', 'admin/brandboost/onsite_list_bk_2_1_2019', $aData);
        $this->template->load('admin/admin_template_new', 'admin/brandboost/onsite_list_datatable', $aData);
    }

    public function widget_overview() {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
            <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
            <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Onsite Widgets" class="sidebar-control active hidden-xs ">Overview</a></li>
            </ul>';

        $aUser = getLoggedUser();
        $clientID = $aUser->id;
        $oLiveData = $this->mLive->getLiveData($clientID);
        $oCurrentLiveData = $this->mLive->getCurrentLiveData($clientID);
        $chatWidget = $this->mLive->chatWidget($clientID);
        $brandboostOnsiteWidget = $this->mLive->brandboostWidget($clientID, 'onsite');
        $brandboostOffsiteWidget = $this->mLive->brandboostWidget($clientID, 'offsite');

        $aData = array(
            'title' => 'Widgets Overview',
            'pagename' => $breadcrumb,
            'oLiveData' => $oLiveData,
            'oCurrentLiveData' => $oCurrentLiveData,
            'chatWidget' => $chatWidget,
            'bOnsiteWidget' => $brandboostOnsiteWidget,
            'bOffsiteWidget' => $brandboostOffsiteWidget
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/widget_overview', $aData);
    }

    public function widgets() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;
        if ($user_role == 1) {
            $oWidgetsList = $this->mBrandboost->getBBWidgets('', '', 'onsite');
        } else {
            $oWidgetsList = $this->mBrandboost->getBBWidgets('', $userID, 'onsite');
        }

        $oStats = $this->mBrandboost->getBBWidgetStats($userID, 'owner_id');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Onsite Widgets" class="sidebar-control active hidden-xs ">Onsite Widgets</a></li>
			</ul>';

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->session->set_userdata('setTab', '');
        $aData = array(
            'title' => 'Onsite Widgets',
            'pagename' => $breadcrumb,
            'oWidgetsList' => $oWidgetsList,
            'bActiveSubsription' => $bActiveSubsription,
            'oStats' => $oStats,
            'user_role' => $user_role
        );
        $this->template->load('admin/admin_template_new', 'admin/brandboost/widget_list', $aData);
    }

    public function onsite_widget_setup($widgetID) {
        $selectedTab = $this->input->get('t');
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (!empty($selectedTab)) {
            if (in_array($selectedTab, array('Review Sources', 'Configure Widgets', 'Integration'))) {
                //set required session
                $this->session->set_userdata("setTab", $selectedTab);
            }
        } else {
            $setTab = $this->session->userdata('setTab');
            if ($setTab == '') {
                $this->session->set_userdata("setTab", 'Review Sources');
            }
        }

        if (empty($widgetID)) {
            redirect("admin/brandboost/widgets");
            exit;
        }

        $oBrandboostList = $this->mBrandboost->getBrandboostByUserId($userID, 'onsite');
        $oWidgets = $this->mBrandboost->getBBWidgets($widgetID);
        $oStats = $this->mBrandboost->getBBWidgetStats($widgetID);
        $widgetThemeData = $this->mBrandboost->getWidgetThemeByUserID($userID);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $setTab = $this->session->userdata("setTab");

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

        $this->template->load('admin/admin_template_new', 'admin/brandboost/onsite_widget_setup', $aData);
    }

    public function onsite_widget_stats($widgetID) {
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

    public function onsite_setup($brandboostID) {
        $selectedTab = $this->input->get('t');
        $selectedCategory = $this->input->get('cate');
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (!empty($selectedTab)) {
            if (in_array($selectedTab, array('Review Sources', 'Campaign Preferences', 'Rewards & Gifts', 'Configure Widgets', 'Email Workflow', 'Campaign Clients', 'Reviews', 'Integration', 'Image', 'Video'))) {
                //set required session
                $this->session->set_userdata("setTab", $selectedTab);
            }
        } else {
            $setTab = $this->session->userdata('setTab');
            if ($setTab == '') {
                $this->session->set_userdata("setTab", 'Campaign Preferences');
                //$this->session->set_userdata("setTab", 'Reviews');
            }
        }



        //$brandboostID = $this->session->userdata('brandboostID');

        if (empty($brandboostID)) {
            redirect("admin/brandboost/onsite");
            exit;
        }

        $bbProductsData = $this->mBrandboost->getProductData($brandboostID);
        $getBrandboost = $this->mBrandboost->getBrandboost($brandboostID);

        if (empty($getBrandboost) || $getBrandboost[0]->user_id != $userID) {
            redirect("admin/brandboost/onsite");
            exit;
        }
        $getBrandboostFR = $this->mFeedback->getFeedbackResponse($brandboostID);
        $moduleName = 'brandboost';
        $moduleUnitID = $moduleUnitID;
        //$allSubscribers = $this->rLists->getAllSubscribersList($brandboostID);
        $oCampaignSubscribers = $this->mWorkflow->getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $eventsdata = $this->mBrandboost->getBrandboostEvents($brandboostID);
        $aReviews = $this->mReviews->getCampaignAllReviews($brandboostID);
        $revCount = getCampaignReviewCount($brandboostID);
        $revRA = getCampaignReviewRA($brandboostID);
        $emailTemplate = $this->mBrandboost->getAllCampaignTemplatesByUserID($userID, 'onsite');
        $smsTemplate = $this->mBrandboost->getAllSMSCampaignTemplatesByUserID($userID, 'onsite');
        
        $oEvents = $this->mWorkflow->getWorkflowEvents($brandboostID, $moduleName);
        $oEventsType = array('send-invite', 'followup');
        $oCampaignTags = $this->mWorkflow->getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName, 'onsite');
        $setTab = $this->session->userdata("setTab");
        $oTemplates = $this->mTemplates->getCommonTemplates();
        $oCategories = $this->mTemplates->getCommonTemplateCategories();

        if ($this->use_default_accounts == true) {
            $aTwilioData = $this->defaultTwilioDetails;
            $fromNumber = $aData['from_entity'];
        } else {
            $aTwilioAc = $this->mInviter->getTwilioAccount($userID);
            if (!empty($aTwilioAc)) {
                $fromNumber = $aTwilioAc->contact_no;
            }
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a  href="' . base_url('admin/brandboost/onsite') . '" class="sidebar-control hidden-xs">On site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="' . $getBrandboost[0]->brand_title . '" class="sidebar-control active hidden-xs ">' . $getBrandboost[0]->brand_title . '</a></li>
			</ul>';
        //pre($getBrandboost[0]);

        $aData = array(
            'title' => 'Onsite Brand Boost Campaign',
            'pagename' => $breadcrumb,
            'getOnsite' => $getBrandboost,
            'bActiveSubsription' => $bActiveSubsription,
            'feedbackResponse' => $getBrandboostFR,
            'brandboostData' => $getBrandboost[0],
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
            'result' => $feedbackData,
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

        $this->template->load('admin/admin_template_new', 'admin/brandboost/onsite_setup', $aData);
    }


    public function brand_configuration() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $brandData = $this->mBrand->getBrandConfigurationData($userID);
        // pre($brandData);
        $brandThemeData = $this->mBrand->getBrandThemesData($userID);
        $aBrandboostList = $this->mBrandboost->getBrandboostByUserId($userID, 'onsite');
        $faQData = $this->mBrand->getFaqData();
        $aReviews = $this->mReviews->getCampaignReviewsByUserId($userID);
        //pre($aReviews);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-control hidden-xs slace">/</a></li>
			<li><a class="sidebar-control hidden-xs">Brand Configuration</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Brand Configuration" class="sidebar-control active hidden-xs ">Brand Configuration</a></li>
			</ul>';

        $this->template->load('admin/admin_template_new', 'admin/brandboost/brand_configuration', array('title' => 'Brand Configuration', 'pagename' => $breadcrumb, 'brandData' => $brandData[0], 'aBrandbosts' => $aBrandboostList, 'brandThemeData' => $brandThemeData, 'faQData' => $faQData, 'aReviews' => $aReviews, 'userData' => $oUser));

        /* $brandData = $this->mBrand->getBrandConfigurationData($this->uri->segment(4));
          $faQData = $this->mBrand->getFaqData();
          $getBrandboost = $this->mBrandboost->getBrandboost($this->uri->segment(4));
          $aReviews = $this->mReviews->getCampaignReviews($this->uri->segment(4));


          $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
          <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
          <li><a class="sidebar-control hidden-xs slace">/</a></li>
          <li><a class="sidebar-control hidden-xs">Brand Configuration</a></li>
          <li><a data-toggle="tooltip" data-placement="bottom" title="Brand Configuration" class="sidebar-control active hidden-xs ">Brand Configuration</a></li>
          </ul>';

          $this->template->load('admin/admin_template_new', 'admin/brandboost/brand_configuration', array('title' => 'Brand Configuration', 'pagename' => $breadcrumb, 'brandData' => $brandData[0], 'brandboostData' => $getBrandboost[0], 'aReviews' => $aReviews, 'faQData' => $faQData, 'aBrandbosts' => $aBrandboostList)); */
    }

    public function campaign_specific() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $company_name = $aUser->company_name;
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
            'user_role' => $user_role,
            'company_name' => $company_name
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/campaign_specific', $aData);
    }

    public function media() {

        $aReviews = $this->mReviews->getCampaignReviewsDetail();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/onsite') . '">On site</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Media" class="sidebar-control active hidden-xs ">Media</a></li>
			</ul>';

        $this->template->load('admin/admin_template_new', 'admin/brandboost/media_beta', array('title' => 'On Site Brand Boost Media', 'pagename' => $breadcrumb, 'aReviews' => $aReviews));
    }

    public function email_tracking($param, $campId) {


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

        $this->template->load('admin/admin_campaign_template', 'admin/brandboost/onsite_tracking', array('title' => 'On Site Review Campaign Tracking',
            'pagename' => $breadcrumb,
            'aStatsBrandboostId' => $aStatsBrandboostId,
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

    public function sms_tracking($param, $campId) {

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

    public function addBrandCampaign() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        $post = $this->input->post();
        $campaign = $post['campaign'];
        $brandboostId = $post['brandboost_id'];

        $aBrandboostData = array(
            'user_id' => $userID,
            'campaign_ids' => serialize($campaign)
        );

        $bData = $this->mBrand->getBrandConfigurationData($userID);
        if ((count($bData) > 0) && $bData != '') {
            $result = $this->mBrand->updateBrandConfiguration($userID, $aBrandboostData);
        } else {
            $result = $this->mBrand->addBrandConfiguration($aBrandboostData);
        }

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function getBrandThemeData() {
        $post = $this->input->post();
        $BrandthemeId = $post['BrandthemeId'];
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $result = $this->mBrand->getBrandThemeConfigData($BrandthemeId);

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

    public function addBrandConfigurationData() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();
        $post = $this->input->post();
        //$brandboostId = $post['brandboost_id'];
        $avatar = $post['avatar_switch'] != '' ? '1' : '0';
        $company_des = $post['company_des_switch'] != '' ? '1' : '0';
        $services = $post['services_switch'] != '' ? '1' : '0';
        $contact_btn = $post['contact_btn_switch'] != '' ? '1' : '0';
        $contact_info = $post['contact_info_switch'] != '' ? '1' : '0';
        $socials = $post['socials_switch'] != '' ? '1' : '0';
        $customer_experiance = $post['customer_experiance_switch'] != '' ? '1' : '0';
        $about_company = $post['about_company_position'];
        $reviews_list = $post['reviews_list_position'];
        $show_rating = $post['show_rating'];
        $chat_widget = $post['chat_widget_switch'] != '' ? '1' : '0';
        $referral_widgets = $post['referral_widgets_switch'] != '' ? '1' : '0';

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


        $bData = $this->mBrand->getBrandConfigurationData($userID);
        if ((count($bData) > 0) && $bData != '') {
            $result = $this->mBrand->updateBrandConfiguration($userID, $aBrandboostData);
        } else {
            $result = $this->mBrand->addBrandConfiguration($aBrandboostData);
        }

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function addFaqData() {

        $response = array();
        $post = $this->input->post();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $faq_question = $post['question'];
        $faq_answer = $post['answer'];


        // $referral_widgets = $post['referral_widgets_switch'] != '' ? '1' : '0';

        $addFaqData = array(
            'user_id' => $userID,
            'question' => $faq_question,
            'answer' => $faq_answer
        );


        $result = $this->mBrand->addFaqData($addFaqData);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function update_faq_status() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $faqId = strip_tags($post['faq_id']);
            $status = strip_tags($post['status']);

            $aData = array(
                'status' => $status
            );

            $result = $this->mBrand->updateFaQStatus($aData, $faqId);
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

    public function delete_faq() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $faqId = strip_tags($post['faq_id']);
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

    public function deleteProduct() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $dataOrder = strip_tags($post['dataOrder']);
            $bbId = strip_tags($post['bb_id']);
            $result = $this->mBrandboost->deleteProduct($bbId, $dataOrder);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function UpdateFaqData() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $faqId = strip_tags($post['faq_id']);
            $faq_question = $post['question'];
            $faq_answer = $post['answer'];


            $aData = array(
                'question' => $faq_question,
                'answer' => $faq_answer
            );


            $result = $this->mBrand->UpdateFaqData($aData, $faqId);
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

    public function getFaqdetails($faQListid) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();
        $get = $this->input->get();
        $selectedTab = $get['t'];
        if (!empty($post)) {
            $faQListid = strip_tags($post['faQListid']);
            $actionName = strip_tags($post['action']);
        }


        $oFdetails = $this->mBrand->getFAQSingleDetails($faQListid);



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
            $popupContent = $this->load->view('admin/components/smart-popup/faqs', $aData, true);
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        } else {
            $this->template->load('admin/admin_template_new', 'admin/question/question_details', $aData);
        }
    }

    public function switchTemplate() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();
        $template_style = $post['template_style'];
        $aBrandboostData = array(
            'user_id' => $userID,
            'template_style' => $template_style,
        );
        $bData = $this->mBrand->getBrandConfigurationData($userID);
        if ((count($bData) > 0) && $bData != '') {
            $result = $this->mBrand->updateBrandConfiguration($userID, $aBrandboostData, $aThemeData, $theme_title);
        } else {
            $result = $this->mBrand->addBrandConfiguration($aBrandboostData, $aThemeData, $theme_title);
        }

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function updateBrandConfigurationData() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();
        $post = $this->input->post();
        $area_type = $post['area_type'];
        $theme_title = $post['brand_theme_title'];

        $company_logo = $post['company_logo'];
        $company_header_logo = $post['company_header_logo'];
        $solid_color = $post['area_type'] == '1' ? $post['solid_color'] : $post['solid_color_full'];
        $main_colors = $post['area_type'] == '1' ? $post['main_colors'] : $post['main_colors_full'];
        $custom_colors1 = $post['area_type'] == '1' ? $post['custom_colors1'] : $post['custom_colors1_full'];
        $custom_colors2 = $post['area_type'] == '1' ? $post['custom_colors2'] : $post['custom_colors2_full'];
        $color_orientation_top = $post['color_orientation_top_value'];
        $color_orientation_full = $post['color_orientation_full_value'];
        $custom_company_name = $post['custom_company_name'];
        $custom_company_description = $post['custom_company_description'];
        $company_info_switch = $post['company_info_switch'] != '' ? '1' : '0';
        if ($post['area_type'] == '1') {
            $main_color_switch = $post['main_color_switch'] != '' ? '1' : '0';
        } else {
            $main_color_switch = $post['main_color_switch_full'] != '' ? '1' : '0';
        }
        if ($post['area_type'] == '1') {
            $custom_color_switch = $post['custom_color_switch'] != '' ? '1' : '0';
        } else {
            $custom_color_switch = $post['custom_color_switch_full'] != '' ? '1' : '0';
        }
        if ($post['area_type'] == '1') {
            $solid_color_switch = $post['solid_color_switch'] != '' ? '1' : '0';
        } else {
            $solid_color_switch = $post['solid_color_switch_full'] != '' ? '1' : '0';
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

        $bData = $this->mBrand->getBrandConfigurationData($userID);
        if ((count($bData) > 0) && $bData != '') {
            $result = $this->mBrand->updateBrandConfiguration($userID, $aBrandboostData, $aThemeData, $theme_title);
        } else {
            $result = $this->mBrand->addBrandConfiguration($aBrandboostData, $aThemeData, $theme_title);
        }

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function getWidgetThemeData($themeId) {
        $result = $this->mBrandboost->getWidgetThemeData($themeId);

        if ($result) {
            $response = array('status' => 'ok', 'themeData' => $result[0]);
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function addBrandBoostWidgetData() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        $post = $this->input->post();
        $brandboostID = strip_tags($post['campaign_id']);
        $title = strip_tags($post['title']);
        $desc = strip_tags($post['desc']);
        $bAllowComment = strip_tags($post['allow_comment']);
        $bAllowVideoReview = strip_tags($post['allow_video_reviews']);
        $bAllowHelpful = strip_tags($post['allow_helpful']);
        $bAllowLiveReading = strip_tags($post['allow_live_reading']);
        $bAllowRatings = strip_tags($post['allow_ratings']);
        $bAllowTimestamp = strip_tags($post['allow_timestamp']);
        $bAllowProsCons = strip_tags($post['allow_pros_cons']);
        $bgColor = strip_tags($post['bg_color']);
        $textColor = strip_tags($post['text_color']);
        $pro_cons = strip_tags($post['pro_cons']);
        $domainName = strip_tags($post['domain_name']);
        $ratingValue = strip_tags($post['ratingValue']);
        $bbDisplay = strip_tags($post['bbDisplay']);
        $widgetID = strip_tags($post['edit_widgetId']);
        $alternativeDesign = strip_tags($post['alternative_design']);
        $allowCampaignName = strip_tags($post['allow_campaign_name']);
        $reviewsOrderBy = strip_tags($post['reviews_order_by']);
        $reviewsOrder = strip_tags($post['reviews_order']);

        //$widgettype = $this->session->userdata('selectedOnsiteWidget');
        $numofrev = strip_tags($post['numofrev']);

        $barndFileData = $post['brand_img'];
        $brandFileArray = array();

        foreach ($barndFileData['media_url'] as $key => $fileData) {
            $brandFileArray[$key]['media_url'] = $fileData;
            $brandFileArray[$key]['media_type'] = $barndFileData['media_type'][$key];
        }

        $logoImageFileName = $post['logo_img'] == '' ? $post['edit_logo_img'] : $post['logo_img'];
        $brandImageFileName = empty($post['brand_img']) ? $post['edit_brand_img'] : serialize($brandFileArray);

        $review_expire = $post['review_expire'];
        $review_expire_link = $post['review_expire_link'];
        $revExpireLink = array();
        if ($review_expire_link == 'custom') {

            $txtInteger = $post['txtInteger'];
            $exp_duration = $post['exp_duration'];
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
            'widget_img' => $brandImageFileName,
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


        $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function addBrandBoostData() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();
        //$brandboostID = $this->session->userdata('brandboostID');
        $title = strip_tags($post['title']);
        $desc = strip_tags($post['desc']);
        $bAllowComment = strip_tags($post['allow_comment']);
        $bAllowVideoReview = strip_tags($post['allow_video_reviews']);
        $bAllowHelpful = strip_tags($post['allow_helpful']);
        $bAllowLiveReading = strip_tags($post['allow_live_reading']);
        $bAllowRatings = strip_tags($post['allow_ratings']);
        $bAllowTimestamp = strip_tags($post['allow_timestamp']);
        $bAllowProsCons = strip_tags($post['allow_pros_cons']);
        $bgColor = strip_tags($post['bg_color']);
        $textColor = strip_tags($post['text_color']);
        $pro_cons = strip_tags($post['pro_cons']);
        $domainName = strip_tags($post['domain_name']);
        $ratingValue = strip_tags($post['ratingValue']);
        $bbDisplay = strip_tags($post['bbDisplay']);
        $brandboostID = strip_tags($post['edit_brandboostId']);

        //$widgettype = $this->session->userdata('selectedOnsiteWidget');
        $numofrev = strip_tags($post['numofrev']);

        $barndFileData = $post['brand_img'];
        $brandFileArray = array();

        foreach ($barndFileData['media_url'] as $key => $fileData) {
            $brandFileArray[$key]['media_url'] = $fileData;
            $brandFileArray[$key]['media_type'] = $barndFileData['media_type'][$key];
        }

        $logoImageFileName = $post['logo_img'] == '' ? $post['edit_logo_img'] : $post['logo_img'];
        $brandImageFileName = empty($post['brand_img']) ? $post['edit_brand_img'] : serialize($brandFileArray);

        $review_expire = $post['review_expire'];
        $review_expire_link = $post['review_expire_link'];
        $revExpireLink = array();
        if ($review_expire_link == 'custom') {

            $txtInteger = $post['txtInteger'];
            $exp_duration = $post['exp_duration'];
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

    public function addBrandBoostWidgetCampaign() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();

        $widgetID = $post['campaign_widget_id'];
        $campaignId = $post['campaign_id'];

        $aData = array(
            'brandboost_id' => $campaignId
        );


        $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function addBrandBoostWidgetDesign() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();

        $company_logo = $post['company_logo'];
        $allow_branding = $post['allow_branding'] != '' ? '1' : '0';
        $notification = $post['notification'] != '' ? '1' : '0';
        $company_info_switch = $post['company_info_switch'] != '' ? '1' : '0';
        $widgetID = $post['edit_widgetId'];
        $solid_color = $post['solid_color'];
        $main_colors = $post['main_colors'];
        $custom_colors1 = $post['custom_colors1'];
        $custom_colors2 = $post['custom_colors2'];
        $main_color_switch = $post['widget_bgcolor_switch'] == 1 ? '1' : '0';
        $custom_color_switch = $post['widget_bgcolor_switch'] == 2 ? '1' : '0';
        $solid_color_switch = $post['widget_bgcolor_switch'] == 3 ? '1' : '0';
        $custom_company_name = $post['custom_company_name'];
        $custom_company_description = $post['custom_company_description'];

        $widget_font_color = $post['widget_font_color'];
        $widget_border_color = $post['widget_border_color'];
        $widget_position = $post['widget_position'];
        $widget_themes = $post['widget_themes'];
        $icon_type = $post['icon_type'];
        $color_orientation = $post['color_orientation'];

        $solid_color_rating = $post['solid_color_rating'];
        $main_colors_rating = $post['main_colors_rating'];
        $custom_colors_rating1 = $post['custom_colors_rating1'];
        $custom_colors_rating2 = $post['custom_colors_rating2'];
        $main_color_switch_rating = $post['main_color_switch_rating'] != '' ? '1' : '0';

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


        $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function createBrandBoostWidgetTheme() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();

        $widgetID = $post['theme_widget_id'];
        $theme_widget_title = $post['widget_theme_title'];
        $theme_fix_color_switch = $post['theme_bg_color_switch'] == 1 ? 1 : 0;
        $theme_custom_color_switch = $post['theme_bg_color_switch'] == 2 ? 1 : 0;
        $theme_solid_color_switch = $post['theme_bg_color_switch'] == 3 ? 1 : 0;
        $theme_main_colors = $post['theme_main_colors'];
        $theme_custom_colors1 = $post['theme_custom_colors1'];
        $theme_custom_colors2 = $post['theme_custom_colors2'];
        $theme_solid_color = $post['theme_solid_color'];
        $theme_main_colors_rating = $post['theme_main_colors_rating'];
        $theme_rating_custom_color1 = $post['theme_rating_custom_color1'];
        $theme_rating_custom_colors2 = $post['theme_rating_custom_colors2'];
        $theme_rating_solid_color = $post['theme_rating_solid_color'];
        $theme_fix_rating_color = $post['theme_fix_rating_color'];
        $theme_widget_font_color = $post['theme_widget_font_color'];
        $theme_widget_border_color = $post['theme_widget_border_color'];
        $theme_widget_position = $post['theme_widget_position'];
        $theme_color_orientation = $post['theme_color_orientation'];


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

    public function addBrandBoostDesign() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();

        $company_logo = $post['company_logo'];
        $allow_branding = $post['allow_branding'] != '' ? '1' : '0';
        $notification = $post['notification'] != '' ? '1' : '0';
        $company_info_switch = $post['company_info_switch'] != '' ? '1' : '0';
        $brandboostID = $post['edit_brandboostId'];
        $solid_color = $post['solid_color'];
        $main_colors = $post['main_colors'];
        $custom_colors1 = $post['custom_colors1'];
        $custom_colors2 = $post['custom_colors2'];
        $main_color_switch = $post['main_color_switch'] != '' ? '1' : '0';
        $custom_color_switch = $post['custom_color_switch'] != '' ? '1' : '0';
        $solid_color_switch = $post['solid_color_switch'] != '' ? '1' : '0';
        $custom_company_name = $post['custom_company_name'];
        $custom_company_description = $post['custom_company_description'];

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

    public function delete() {
        $response = array();
        $post = $this->input->post();
        $id = strip_tags($post['brandboost_id']);
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

    public function deleteCampaignResponse() {
        $response = array();
        $post = $this->input->post();
        $ids = $post['multipal_id'];

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

    public function campaignResponseDel() {
        $response = array();
        $post = $this->input->post();
        $id = $post['campaign_response_id'];

        $result = $this->mBrandboost->deleteCampaignResponse($id);

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function add_onsite_campaign() {
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_campaign_template', 'admin/brandboost/add_onsite_campaign', array('bActiveSubsription' => $bActiveSubsription));
    }

    public function add() {
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/add_onsite', array('bActiveSubsription' => $bActiveSubsription));
    }

    public function edit() {

        $brandId = $this->uri->segment(4);
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);

        $this->template->load('admin/admin_template', 'admin/brandboost/edit_onsite', array('aBrandbosts' => $getBrandboost[0], 'brandId' => $brandId));
    }

    public function onsite_step_2() {
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">On Site Review Campaigns</li>
            </ul>';
        $this->template->load('admin/admin_template', 'admin/brandboost/onsite_step_2', array('title' => 'On Site Review Campaigns', 'pagename' => $breadcrumb, 'bActiveSubsription' => $bActiveSubsription));
    }

    public function onsite_step_3() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandId = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $rating = $getBrandboost[0]->min_ratings_display;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/onsite_step_3', array('rating' => $rating, 'bActiveSubsription' => $bActiveSubsription));
    }

    public function onsite_step_4() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandId = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $bActiveSubsription = $this->mUser->isActiveSubscription();

        $this->template->load('admin/admin_template', 'admin/brandboost/onsite_step_4', array('getBrandboost' => $getBrandboost[0], 'userID' => $userID, 'bActiveSubsription' => $bActiveSubsription));
    }

    public function onsite_step_5() {
        $response = array();
        $post = $this->input->post();
        $userID = $this->session->userdata("current_user_id");
        $brandId = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $eventsdata = $this->mBrandboost->getBrandboostEvents($brandId);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/onsite_step_5', array('brandboostData' => $getBrandboost[0], 'eventsData' => $eventsdata, 'bActiveSubsription' => $bActiveSubsription));
    }

    public function onsite_allset() {
        $brandId = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $next_page_url = $getBrandboost[0]->review_type;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/onsite_allset', array('campaign_key' => $getBrandboost[0]->hashcode, 'sWidget' => $getBrandboost[0]->widget_type, 'next_page_url' => $next_page_url, 'bActiveSubsription' => $bActiveSubsription));
    }

    public function rewards() {

        $rewardsData = $this->mRewards->getAllRewards();
        $brandId = $this->session->userdata('brandboostID');
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/reward_step_5a', array('rewardsData' => $rewardsData, 'brandboostData' => $getBrandboost[0], 'bActiveSubsription' => $bActiveSubsription));
    }

    public function add_step_3() {

        $response = array();
        $post = $this->input->post();
        $brandboost_id = strip_tags($post['brandboost_id']);
        $rating_limit = strip_tags($post['rating_limit']);
        if ($brandboost_id > 0 && $rating_limit > 0) {
            $result = $this->mBrandboost->updateStep3($brandboost_id, $rating_limit);
            if ($result) {
                $response = array('status' => 'ok');
            } else {
                $response = array('status' => 'error');
            }
            echo json_encode($response);
            exit;
        }
    }

    public function add_step_4() {

        $response = array();
        $post = $this->input->post();
        $brandboost_id = strip_tags($post['brandboost_id']);
        $tags_data = strip_tags($post['tags_data']);
        if ($brandboost_id > 0) {
            $result = $this->mBrandboost->updateStep4($brandboost_id, $tags_data);
            if ($result) {
                $response = array('status' => 'ok');
            } else {
                $response = array('status' => 'error');
            }
            echo json_encode($response);
            exit;
        }
    }

    public function add_step_5() {
        $response = array();
        $post = $this->input->post();
        $userID = $this->session->userdata("current_user_id");
        $brandId = $this->session->userdata('brandboostID');
        if ($post) {

            $delay_value = strip_tags($post['delay_value']);
            $delay_unit = strip_tags($post['delay_unit']);
            $welcome_event_id = strip_tags($post['welcome_event_id']);
            if ($brandId) {

                $dateTimeData = array("delay_type" => 'after', "delay_value" => $delay_value, "delay_unit" => $delay_unit);
                $dateTimeData = json_encode($dateTimeData);
                if ($welcome_event_id > 0) {
                    $eData = array(
                        'data' => $dateTimeData,
                        'updated' => date("Y-m-d H:i:s")
                    );
                    $this->mBrandboost->updateEvent($eData, $welcome_event_id);
                    $eventId = $welcome_event_id;
                } else {
                    $brandBoostData = $this->mBrandboost->getBrandboost($brandId);
                    $brandBoostData = $brandBoostData[0];

                    if ($brandBoostData->review_type == 'onsite') {
                        /// create first email template Onsite invitation Email /////
                        $eData = array(
                            'brandboost_id' => $brandId,
                            'event_type' => 'send-invite',
                            'data' => $dateTimeData,
                            'created' => date("Y-m-d H:i:s")
                        );
                        $emailTempalteID = 6;
                        $eventId = $this->mBrandboost->addEvent($eData);
                        $resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempalteID);
                        $resultData = $resultData[0];
                        $aUser = getLoggedUser();
                        if ($eventId) {
                            $cData = array(
                                'event_id' => $eventId,
                                'content_type' => 'Regular',
                                'campaign_type' => 'Email',
                                'name' => $resultData->template_name,
                                'subject' => $resultData->template_subject,
                                'html' => $resultData->template_content,
                                'template_source' => $emailTempalteID,
                                'status' => 1,
                                'from_email' => $aUser->email,
                                'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
                                'reply_to' => $aUser->email,
                                'created' => date("Y-m-d H:i:s")
                            );
                            $campaignId = $this->mBrandboost->addCampaign($cData);
                        }
                    } else {
                        /// create first email template Onsite invitation Email /////
                        $eData = array(
                            'brandboost_id' => $brandId,
                            'event_type' => 'send-invite',
                            'data' => $dateTimeData,
                            'created' => date("Y-m-d H:i:s")
                        );
                        $emailTempalteID = 7;
                        $eventId = $this->mBrandboost->addEvent($eData);
                        $resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempalteID);
                        $resultData = $resultData[0];
                        $aUser = getLoggedUser();
                        if ($eventId) {
                            $cData = array(
                                'event_id' => $eventId,
                                'content_type' => 'Regular',
                                'campaign_type' => 'Email',
                                'name' => $resultData->template_name,
                                'subject' => $resultData->template_subject,
                                'html' => $resultData->template_content,
                                'template_source' => $emailTempalteID,
                                'status' => 1,
                                'from_email' => $aUser->email,
                                'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
                                'reply_to' => $aUser->email,
                                'created' => date("Y-m-d H:i:s")
                            );
                            $campaignId = $this->mBrandboost->addCampaign($cData);
                        }
                    }
                }
                if ($eventId) {
                    $response['status'] = 'success';
                } else {
                    $response['status'] = "Error";
                }
            }
            echo json_encode($response);
            exit;
        }
    }

    public function addDefaultFollowupEvent($brandboostID, $type = 'main', $previousEventID = '', $addDefaultContent = true, $campaignType = 'Email') {
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

    public function addDefaultFollowupCampaigns_old($brandboostID) {
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

    public function addDefaultFollowupCampaigns($brandboostID) {
        $eventID = 0;
        if (!empty($brandboostID)) {
            // Generate main event 
            $eventID = $this->addDefaultFollowupEvent($brandboostID, 'main', 0, true, 'Email');
        }
        return $eventID;
    }

    public function addDefaultFollowupCampaigns_old_new($brandboostID) {
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

    public function addReminder() {
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

    public function create_event() {
        $response = array();
        $post = $this->input->post();
        $userID = $this->session->userdata("current_user_id");
        $brandId = $this->session->userdata('brandboostID');
        $getPrevEventId = $this->mBrandboost->getPrevEventId($brandId);
        $emailTempalteID = $post['templateId'];
        $campaignType = $post['campaign_type'];
        $previousEventId = $post['previous_event_id'];
        $currentEventID = $post['current_event_id'];
        $eventType = $post['event_type'];
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

        /* if ($campaignId) {
          $response['status'] = 'success';
          $response['campaignId'] = $campaignId;
          $response['temp_subject'] = $resultData->template_subject;
          $response['temp_content'] = base64_decode($resultData->template_content);
          } else {
          $response['status'] = "Error";
          } */

        echo json_encode($response);
        exit;
    }

    /* public function create_event_thankyou() {
      $response = array();
      $userID = $this->session->userdata("current_user_id");
      $brandId = $this->session->userdata('brandboostID');
      $getPrevEventId = $this->mBrandboost->getPrevEventId($brandId);

      $dateTimeData = array("delay_type" => 'after', "delay_value" => '10', "delay_unit" => 'minute');
      $dateTimeData = json_encode($dateTimeData);
      if (!empty($brandId)) {
      $brandBoostData = $this->mBrandboost->getBrandboost($brandId);
      $brandBoostData = $brandBoostData[0];

      if ($brandBoostData->review_type == 'onsite') {

      $eData = array(
      'brandboost_id' => $brandId,
      'event_type' => 'thank-you',
      'data' => $dateTimeData,
      'previous_event_id' => $getPrevEventId->id,
      'created' => date("Y-m-d H:i:s")
      );
      $emailTempalteID = 10;
      $eventId = $this->mBrandboost->addEvent($eData);
      $resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempalteID);
      $resultData = $resultData[0];
      $aUser = getLoggedUser();
      if ($eventId) {
      $cData = array(
      'event_id' => $eventId,
      'content_type' => 'Regular',
      'campaign_type' => 'Email',
      'name' => $resultData->template_name,
      'subject' => $resultData->template_subject,
      'html' => $resultData->template_content,
      'template_source' => $emailTempalteID,
      'status' => 1,
      'from_email' => $aUser->email,
      'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
      'reply_to' => $aUser->email,
      'created' => date("Y-m-d H:i:s")
      );
      $campaignId = $this->mBrandboost->addCampaign($cData);
      }
      } else {

      $eData = array(
      'brandboost_id' => $brandId,
      'event_type' => 'thank-you',
      'data' => $dateTimeData,
      'previous_event_id' => $getPrevEventId->id,
      'created' => date("Y-m-d H:i:s")
      );
      $emailTempalteID = 11;
      $eventId = $this->mBrandboost->addEvent($eData);
      $resultData = $this->mBrandboost->getAllCampaignTemplates($emailTempalteID);
      $resultData = $resultData[0];
      $aUser = getLoggedUser();
      if ($eventId) {
      $cData = array(
      'event_id' => $eventId,
      'content_type' => 'Regular',
      'campaign_type' => 'Email',
      'name' => $resultData->template_name,
      'subject' => $resultData->template_subject,
      'html' => $resultData->template_content,
      'template_source' => $emailTempalteID,
      'status' => 1,
      'from_email' => $aUser->email,
      'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
      'reply_to' => $aUser->email,
      'created' => date("Y-m-d H:i:s")
      );
      $campaignId = $this->mBrandboost->addCampaign($cData);
      }
      }
      }

      if ($campaignId) {
      $response['status'] = 'success';
      } else {
      $response['status'] = "Error";
      }

      echo json_encode($response);
      exit;
      } */

    public function create_campaign() {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $campaignType = strip_tags($post['campaign_type']);
        $eventID = strip_tags($post['event_id']);
        $type = strip_tags($post['event_type']);
        $brandboostType = strip_tags($post['brandboost_type']);
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
        if ($post) {
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

    public function update_event() {
        $response = array();
        $post = $this->input->post();

        $eventID = strip_tags($post['event_id']);
        $delayValue = strip_tags($post['delay_value']);
        $delayUnit = strip_tags($post['delay_unit']);
        $eventType = strip_tags($post['event_type']);
        $nodeType = strip_tags($post['node_type']);

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

    public function delete_campaign() {
        $response = array();
        $post = $this->input->post();
        $campaignID = strip_tags($post['campaign_id']);
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

    public function delete_event() {
        /* $response = array();
          $post = $this->input->post();
          $eventID = strip_tags($post['event_id']);
          if ($eventID > 0) {
          $event = $this->mBrandboost->deleteEvent($eventID);
          if ($event) {
          $this->mBrandboost->deleteCampaignByEventID($eventID);
          $response['status'] = 'success';
          } else {
          $response['status'] = "Error";
          }

          echo json_encode($response);
          exit;
          } */

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $eventID = strip_tags($post['event_id']);
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

    public function updateStatus() {
        $response = array();
        $post = $this->input->post();
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

    public function updateOnsiteWidgetStatus() {

        $response = array();
        $post = $this->input->post();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $widgetID = $post['widgetID'];
        $status = $post['status'];
        $aData = array(
            'status' => $status,
        );
        $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function updateOnsiteStatus() {

        $response = array();
        $post = $this->input->post();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandboostID = $post['brandboostID'];
        $status = $post['status'];
        $aBrandboostData = array(
            'status' => $status,
        );
        $result = $this->mBrandboost->update($userID, $aBrandboostData, $brandboostID);

        //Add userActivity
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

    public function updateBrandBoost() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();


        $actionName = $post['action_name']; //add or edit
        $title = strip_tags($post['title']);
        $desc = strip_tags($post['desc']);
        $bAllowComment = strip_tags($post['allow_comment']);
        $bAllowVideoReview = strip_tags($post['allow_video_reviews']);
        $bAllowHelpful = strip_tags($post['allow_helpful']);
        $bAllowLiveReading = strip_tags($post['allow_live_reading']);
        $bAllowRatings = strip_tags($post['allow_ratings']);
        $bAllowTimestamp = strip_tags($post['allow_timestamp']);
        $bAllowProsCons = strip_tags($post['allow_pros_cons']);
        $bgColor = strip_tags($post['bg_color']);
        $textColor = strip_tags($post['text_color']);
        $bStatus = strip_tags($post['status']);
        $brandboostID = strip_tags($post['brandId']);
        $widgettype = $this->session->userdata('selectedOnsiteWidget');
        $numofrev = strip_tags($post['numofrev']);
        $domainName = strip_tags($post['domain_name']);
        $pro_cons = strip_tags($post['pro_cons']);
        $logoImageFileName = strip_tags($post['logo_img']);
        $brandImageFileName = strip_tags($post['brand_img']);

        $review_expire = $post['review_expire'];
        $review_expire_link = $post['review_expire_link'];
        $revExpireLink = array();
        if ($review_expire_link == 'custom') {

            $txtInteger = $post['txtInteger'];
            $exp_duration = $post['exp_duration'];
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

    public function reviews($campaignId = 0) {

        if (!empty($campaignId)) {

            $oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId);
            $aReviews = $this->mReviews->getCampaignReviews($campaignId);
            $bActiveSubsription = $this->mUser->isActiveSubscription();

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/onsite') . '">' . $oCampaign->brand_title . '</a></li>
				<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
				<li><a class="sidebar-control hidden-xs">Reviews</a></li>
                </ul>';

            $aData = array(
                'title' => 'Brand Boost Reviews',
                'pagename' => $breadcrumb,
                'oCampaign' => $oCampaign,
                'aReviews' => $aReviews,
                'campaignId' => $campaignId,
                'bActiveSubsription' => $bActiveSubsription
            );

            $this->template->load('admin/admin_template_new', 'admin/brandboost/review_list_camp', $aData);
        } else {
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


            $this->template->load('admin/admin_template_new', 'admin/brandboost/review_list', $aData);
        }
    }

    public function reviewsbeta() {
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

    public function getReviewData() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();
        $post = $this->input->post();

        if ($post) {
            $draw = $post['draw'];
            $start = $post['start'];
            $rowperpage = $post['length'];
            $columnIndex = $post['order'][0]['column'];
            $columnName = $post['columns'][$columnIndex]['data'];
            $columnSortOrder = $post['order'][0]['dir'];
            $searchValue = $post['search']['value'];
            $reviewstatus = $post['columns'][7]['search']['value'];
            $reviewcategory = $post['columns'][6]['search']['value'];


            $totalData = $this->mReviews->getMyBranboostReviews($userID, $searchValue, $reviewstatus, $reviewcategory);
            $totalRecords = count($totalData);

            $searchRecord = $this->mReviews->getMyBranboostReviewsFilter($userID, $searchValue, $reviewstatus, $reviewcategory);
            $totalRecordwithFilter = count($searchRecord);

            $reviewsData = $this->mReviews->getMyBranboostReviewsFilter($userID, $searchValue, $reviewstatus, $reviewcategory, $columnName, $columnSortOrder, $start, $rowperpage);

            $data = array();

            list($canRead, $canWrite) = fetchPermissions('Reviews');

            foreach ($reviewsData as $oReview) {

                $data[] = array(
                    "sortById" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'sortById' ), true),
                    "checkbox" => $this->load->view('/admin/brandboost/dataview/reviews', array('oReview' => $oReview, 'fieldType' => 'checkbox' ), true),

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
	
	
	public function getMediaData() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $response = array();
        $post = $this->input->post();

        if ($post) {
            $draw = $post['draw'];
            $start = $post['start'];
            $rowperpage = $post['length'];
            $columnIndex = $post['order'][0]['column'];
            $columnName = $post['columns'][$columnIndex]['data'];
            $columnSortOrder = $post['order'][0]['dir'];
            $searchValue = $post['search']['value'];
            $reviewstatus = $post['columns'][7]['search']['value'];
            $reviewcategory = $post['columns'][6]['search']['value'];

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

    public function addreview($campaignId = 0) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $aBrandboostList = $this->mBrandboost->getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = $this->mBrandboost->getBrandboostByUserId($userID, 'onsite');
        }

        if (!empty($campaignId)) {

            $oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId);

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
                //'oCampaign' => $oCampaign,
                'aUser' => $aUser
            );
        }

        $this->template->load('admin/admin_template_new', 'admin/brandboost/add_review', $aData);
    }

    public function sitereviews($campaignId) {

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

    public function review_comment($reviewId = 0) {

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

    public function email_templates($campaignID) {
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

    public function sms_templates($campaignID) {
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

    public function campaign_email_template($campaignID, $templateID) {
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

    public function campaign_sms_template($campaignID, $templateID) {
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

    public function update_campaign() {

        $response = array();
        $post = $this->input->post();
        if ($post) {
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            //$templateName = strip_tags($post['template_name']);
            $templateSubject = strip_tags($post['template_subject']);
            $heading = strip_tags($post['template_heading']);
            $introduction = strip_tags($post['template_introduction']);
            $greeting = strip_tags($post['template_greeting']);
            $templateContent = $post['template_content'];
            $templateId = strip_tags($post['template_id']);
            $campaignId = strip_tags($post['campaign_id']);
            $campaignHtmlTemp = $post['campaignHtmlTemp'];

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

    public function publishOnsiteWidget() {

        $response = array();

        $post = $this->input->post();

        $widgetID = strip_tags($post['widgetID']);
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (!empty($widgetID)) {
            $aData = array(
                'status' => 1,
            );

            $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }

    public function publishOnsiteBB() {

        $response = array();

        $post = $this->input->post();

        //$brandboostID = $this->session->userdata('brandboostID');
        $brandboostID = strip_tags($post['brandboostID']);
        //$userID = $this->session->userdata("current_user_id");
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($brandboostID)) {
            $aData = array(
                'status' => 1,
            );

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }

    public function publishOnsiteStatusBB() {

        $response = array();

        $post = $this->input->post();

        //$brandboostID = $this->session->userdata('brandboostID');
        $brandboostID = strip_tags($post['brandboostID']);
        $status = $post['status'];
        //$userID = $this->session->userdata("current_user_id");
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($brandboostID)) {
            $aData = array(
                'status' => $status,
            );

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }

        echo json_encode($response);
        exit;
    }

    public function savePreviewData() {

        $response = array();
        $brandboostID = $this->session->userdata('brandboostID');
        $userID = $this->session->userdata("current_user_id");
        $post = $this->input->post();
        if ($post) {
            $fieldName = strip_tags($post['field_name']);
            $fieldValue = strip_tags($post['field_value']);

            $aData = array(
                $fieldName => $fieldValue
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

    public function publish_campaign() {

        $response = array();
        $post = $this->input->post();
        if ($post) {
            $country_code = '';
            $country_ext = '';
            $brandboostID = strip_tags($post['brandboost_id']);
            $rewardValue = strip_tags($post['reward_value']);
            $rewardTypeId = strip_tags($post['reward_type_id']);
            $receiveRewardType = strip_tags($post['receive_reward_type']);
            $userID = $this->session->userdata("current_user_id");
            $country_code = strip_tags($post['country_code']);
            $country_ext = strip_tags($post['country_ext']);

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

    public function template_add() {

        $response = array();
        $post = $this->input->post();
        if ($post) {
            $userID = $this->session->userdata("current_user_id");
            $title = strip_tags($post['title']);
            $subject = strip_tags($post['subject']);
            $emailtemplate = $post['emailtemplate'];
            $templatetype = $post['template_type'];

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

    public function get_template_by_Id() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $tempID = strip_tags($post['tempID']);
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

    public function getCampaign() {
        $post = $this->input->post();
        $campaignId = $post['campaignId'];
        $result = $this->mBrandboost->getCampaignBycampID($campaignId);
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

    public function update_template() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $title = strip_tags($post['title']);
            $subject = strip_tags($post['subject']);
            $emailtemplate = $post['emailtemplate'];
            $tempId = strip_tags($post['tempId']);

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

    public function delete_template() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $tempID = strip_tags($post['tempID']);
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

    public function offsite_step_1() {
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

    public function test() {
        $this->template->load('admin/admin_template_new', 'admin/brandboost/testing');
    }

    public function setTab() {

        $response = array();
        $post = array();
        $post = $this->input->post();
        if (!empty($post)) {
            $getActiveText = $post['getActiveText'];
            $this->session->set_userdata("setTab", trim($getActiveText));
            $response['status'] = 'success';
        }

        echo json_encode($response);
        exit;
    }

    public function offsite_setup($brandboostID) {
        //$brandboostID = $this->session->userdata('brandboostID');
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (empty($brandboostID)) {
            redirect("admin/brandboost/offsite");
            exit;
        }
        $selectedTab = $this->input->get('t');
        $oBrandboost = $this->mBrandboost->getBrandboost($brandboostID);
        if (empty($oBrandboost) || $oBrandboost[0]->user_id != $userID) {
            redirect("admin/brandboost/offsite");
            exit;
        }
        
        $moduleName = 'brandboost';
        $moduleUnitID = $brandboostID;
        

        $oFeedbackResponse = $this->mFeedback->getFeedbackResponse($brandboostID);
        //$allSubscribers = $this->rLists->getAllSubscribersList($brandboostID);
        
        $oCampaignSubscribers = $this->mWorkflow->getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $eventsdata = $this->mBrandboost->getBrandboostEvents($brandboostID);
        $offSiteReviews = $this->mBrandboost->getAllOffsiteReviews($brandboostID);

        $offsite_ids = $getBrandboost[0]->offsite_ids;
        $offsite_ids = unserialize($offsite_ids);
        $offsite_ids = implode(",", $offsite_ids);
        $totalSocialIcon = $this->rOffsites->offsite_count_all_edit('', $offsite_ids);
        $offstepdata = $this->rOffsites->getOffsite();
        $feedbackData = $this->mFeedback->getFeedbackByBrandboostID($brandboostID);
        $emailTemplate = $this->mBrandboost->getAllCampaignTemplatesByUserID($userID, 'offsite');
        $smsTemplate = $this->mBrandboost->getAllSMSCampaignTemplatesByUserID($userID, 'offsite');
        $oTemplates = $this->mTemplates->getCommonTemplates();
        $oCategories = $this->mTemplates->getCommonTemplateCategories();

        
        $oEvents = $this->mWorkflow->getWorkflowEvents($brandboostID, $moduleName);
        $oEventsType = array('send-invite', 'followup');
        $oCampaignTags = $this->mWorkflow->getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName, 'offsite');


        $setTab = $this->session->userdata("setTab");

        $offsite_ids = $oBrandboost[0]->offsite_ids;
        $offsite_ids = unserialize($offsite_ids);
        foreach ($offsite_ids as $value) {
            if (!empty($value) && $value > 0) {
                $getData = getOffsite($value);
                if (!empty($getData)) {
                    $setTab = 'Campaign Preferences';
                }
            }
        }


        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/brandboost/offsite') . '" class="sidebar-control hidden-xs">Off site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="' . $oBrandboost[0]->brand_title . '" class="sidebar-control active hidden-xs ">' . $oBrandboost[0]->brand_title . '</a></li>
			</ul>';


        $aData = array(
            'title' => 'Offsite Brand Boost Campaign',
            'pagename' => $breadcrumb,
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
            'offSiteReviews' => $offSiteReviews,
            'emailTemplate' => $emailTemplate,
            'smsTemplate' => $smsTemplate
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/offsite_setup', $aData);
    }

    public function delete_multipal_offsite_brandboost_review() {
        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $multiReviewsId = $post['multi_reviews_id'];
            foreach ($multiReviewsId as $revId) {
                $result = $this->mBrandboost->delOffsiteReview($revId);
            }
        }
        $response['status'] = 'success';
        echo json_encode($response);
        exit;
    }

    public function offsite_step_3() {

        $brandboostID = $this->session->userdata('brandboostID');
        $result = $this->mBrandboost->getBrandboost($brandboostID);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template', 'admin/brandboost/offsite_step_3', array('getOffsite' => $result, 'bActiveSubsription' => $bActiveSubsription));
    }

    public function addOnsiteWidget() {

        $response = array();
        $post = array();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;
        if ($this->input->post()) {
            $post = $this->input->post();
            $campaignName = $post['campaignName'];
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

            $widgetID = $this->mBrandboost->addWidget($aData);

            if ($widgetID) {

                $this->session->set_userdata('widgetID', $widgetID);
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
    }

    public function addOnsite() {

        $response = array();
        $post = array();
        $userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $campaignName = $post['campaignName'];
            $OnsitecampaignDescription = $post['OnsitecampaignDescription'];

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $hashcode = '';
            for ($i = 0; $i < 20; $i++) {
                $hashcode .= $characters[rand(0, strlen($characters))];
            }
            $hashcode = $hashcode . date('Ymdhis');
            $aData = array(
                'review_type' => 'onsite',
                'user_id' => $userID,
                'brand_title' => $campaignName,
                'brand_desc' => $OnsitecampaignDescription,
                'status' => 0,
                'hashcode' => md5($hashcode),
                'created' => date("Y-m-d H:i:s")
            );

            $brandboostID = $this->mBrandboost->add($aData);

            if ($brandboostID) {
                $aBrandboostData = array(
                    'brandboost_id ' => $brandboostID
                );
                $bData = $this->mBrand->getBrandConfigurationData($brandboostID);
                if ((count($bData) > 0) && $bData != '') {
                    
                } else {
                    $result = $this->mBrand->addBrandConfiguration($aBrandboostData);
                }

                $this->addDefaultFollowupCampaigns($brandboostID);
                $this->session->set_userdata("setTab", 'Campaign Preferences');
                $this->session->set_userdata('brandboostID', $brandboostID);
                $response['status'] = 'success';
                $response['brandboostID'] = $brandboostID;

                //Add userActivity
                $aActivityData = array(
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
                );
                logUserActivity($aActivityData);
                //Notify about this to admin
                $notificationData = array(
                    'event_type' => 'added_onsite_brandboost',
                    'event_id' => 0,
                    'link' => base_url() . 'admin/brandboost/onsite_setup/' . $brandboostID,
                    'message' => 'Created new onsite brandboost.',
                    'user_id' => $userID,
                    'status' => 1,
                    'created' => date("Y-m-d H:i:s")
                );
                $eventName = 'sys_onsite_added';
                add_notifications($notificationData, $eventName, $userID);
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function addOffsite() {

        $response = array();
        $post = array();
        $userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $campaignName = $post['campaignName'];
            $brand_desc = $post['campaignDescription'];
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $hashcode = '';
            for ($i = 0; $i < 20; $i++) {
                $hashcode .= $characters[rand(0, strlen($characters))];
            }
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

            $brandboostID = $this->mBrandboost->add($aData);

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


                $this->addDefaultFollowupCampaigns($brandboostID);
                //$this->session->set_userdata('brandboostID', $brandboostID);
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
    }

    // This method is deprecated now
    public function update_offsite_step1() {

        $response = array();
        $post = $this->input->post();
        if ($post) {

            $brandboostID = $post['brandboostID'];
            $this->session->set_userdata('brandboostID', $brandboostID);

            $response['status'] = 'success';
            echo json_encode($response);
            exit;
        }
    }

    //This method is deprecated now
    public function editOnsite() {

        $response = array();
        $post = $this->input->post();
        if ($post) {
            $brandboostID = $post['brandboostID'];
            $this->session->set_userdata('brandboostID', $brandboostID);
            $this->session->set_userdata("setTab", 'Reviews');
            $response['status'] = 'success';
            echo json_encode($response);
            exit;
        }
    }

    public function add_offsite() {

        $response = array();
        $post = array();
        $userID = $this->session->userdata("current_user_id");
        $brandboostID = $this->session->userdata('brandboostID');
        if ($this->input->post()) {
            $post = $this->input->post();
            $offset_id = $post['offstepIds'];
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

    public function add_offsite_edit() {

        $response = array();
        $post = array();
        $userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $offset_id = $post['offstepIds'];

            $offstepIds = serialize($offset_id);
            $brandboostID = strip_tags($post['brandboostID']);
            $aData = array(
                'offsite_ids' => $offstepIds
            );

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);

            if ($result) {
                $this->session->set_userdata("setTab", 'Campaign Preferences');
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function continueStepOffsite() {

        $response = array();
        $post = array();
        $post = $this->input->post();
        if ($post) {
            $targetName = $post['targetName'];
            $brandboostID = $post['brandboostID'];
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            if ($targetName == '' && $brandboostID > 0) {
                $aData = array(
                    'status' => 1
                );

                $result = $this->mBrandboost->update($userID, $aData, $brandboostID);
                $response['public'] = 1;
            } else {
                $this->session->set_userdata("setTab", $targetName);
                $response['public'] = 0;
            }
            $response['status'] = 'success';
            echo json_encode($response);
            exit;
        }
    }

    public function add_offsite_resources() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if ($this->input->post()) {
            $post = $this->input->post();
            $brandboostID = $post['brandboostID'];
            $selected_list = $post['selected_list'];
            $socialId = $post['offsiteId'];

            $getBrandboost = $this->mBrandboost->getBrandboost($brandboostID);
            $getBrand = unserialize($getBrandboost[0]->offsites_links);
            unset($getBrand[$socialId]);
            $selected_list = explode(",", $selected_list);

            $aData = array(
                'offsite_ids' => serialize($selected_list),
                'offsites_links' => serialize($getBrand)
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

    public function add_offsite_url() {

        $response = array();
        $post = array();
        $post = $this->input->post();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        $brandboostID = strip_tags($post['brandboostID']);

        if (!empty($post)) {


            $review_expire = $post['review_expire'];
            $review_expire_link = $post['review_expire_link'];
            $revExpireLink = array();
            if ($review_expire_link == 'custom') {

                $txtInteger = $post['txtInteger'];
                $exp_duration = $post['exp_duration'];
                $revExpireLink['delay_value'] = $txtInteger;
                $revExpireLink['delay_unit'] = $exp_duration;
            } else {

                $revExpireLink['delay_value'] = 'never';
                $revExpireLink['delay_unit'] = 'never';
            }


            $offsite_id = $post['offsite_id'];
            $offsite_url = $post['offsite_url'];
            $edit_campaignName = $post['edit_campaignName'];
            $selected_list = $post['selected_list'];
            $selected_list = explode(",", $selected_list);

            $newOffsiteUrl = array();
            $oReviewSources = $this->rOffsites->getOffsite();
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
            $storeURL = strip_tags($post['store_url']);
            $aData = array(
                'offsites_links' => $offsiteUrl,
                'brand_title' => $edit_campaignName,
                'offsite_ids' => serialize($selected_list),
                'link_expire_review' => $review_expire,
                'link_expire_custom' => json_encode($revExpireLink),
                'store_url' => $storeURL
            );

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);
            //  echo $this->db->last_query();



            $feedback_type = $post['feedback_type'];
            $ratings_type = $post['ratings_type'];
            $from_name = $post['from_name'];
            $from_email = $post['from_email'];
            $sender_name = $post['sender_name'];
            $offsite_url = $post['offsite_url'];
            $positive_title = $post['positive_title'];
            $positive_subtitle = $post['positive_subtitle'];
            $negetive_title = $post['negetive_title'];
            $negetive_subtitle = $post['negetive_subtitle'];
            $neutral_title = $post['neutral_title'];
            $neutral_subtitle = $post['neutral_subtitle'];


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
            $aResponse = $this->mFeedback->getFeedbackResponse($brandboostID);
            if (count($aResponse) > 0) {
                $result = $this->mBrandboost->updateBrandboostFeedbackResponse($feedbackData, $brandboostID);
            } else {
                $result = $this->mBrandboost->addBrandboostFeedbackResponse($feedbackData);
            }

            if ($result) {
                //Okay We also need to update "From" info into the campaigns

                $this->updateWorkflowFromInfo($feedbackData, $brandboostID);
                //Set Tab session
                //$this->session->set_userdata("setTab", 'Email Workflow');

                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function updateWorkflowFromInfo($aData, $brandboostID) {
        if (!empty($brandboostID)) {
            $eventsdata = $this->mBrandboost->getBrandboostEvents($brandboostID);
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
                                    $bUpdated = $this->mBrandboost->updateCampaing($aUpdateData, $campaignID);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function addOffsiteUrl() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $brandboostID = $post['bbID'];
        $result = $this->mBrandboost->getBrandboost($brandboostID);
        if ($post) {

            $getSocialId = $post['getSocialId'];
            $getUrl = $post['getUrl'];
            $offsites_links = unserialize($result[0]->offsites_links);
            $offsites_links[$getSocialId]['link'] = $getUrl;
            $offsites_links[$getSocialId]['longurl'] = $getUrl;
            $offsites_links[$getSocialId]['shorturl'] = base_url('r/' . $brandboostID . '/' . $getSocialId);

            $offsiteUrl = serialize($offsites_links);
            $aData = array(
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

    public function offsite() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $this->session->unset_userdata('setTab');
        if ($user_role == 1) {
            $aBrandboostList = $this->mBrandboost->getBrandboost('', 'offsite');
        } else {
            $aBrandboostList = $this->mBrandboost->getBrandboostByUserId($userID, 'offsite');
        }

        $moduleName = 'brandboost-offsite';

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Off Site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Campaigns" class="sidebar-control active hidden-xs ">Campaigns</a></li>
			</ul>';

        $bActiveSubsription = $this->mUser->isActiveSubscription();

        $this->template->load('admin/admin_template_new', 'admin/brandboost/offsite_list', array('title' => 'Offsite Brand Boost Campaigns', 'pagename' => $breadcrumb, 'aBrandbosts' => $aBrandboostList, 'bActiveSubsription' => $bActiveSubsription, 'currentUserId' => $userID, 'user_role' => $user_role, 'moduleName' => $moduleName));
        //$this->load->view('admin/brandboost/offsite_list_testtemp');
    }

    public function edit_offsite() {

        $brandId = $this->uri->segment(4);
        $getBrandboost = $this->mBrandboost->getBrandboost($brandId);
        $offstepdata = $this->rOffsites->getOffsite();
        $this->template->load('admin/admin_template', 'admin/brandboost/edit_offsite', array('aBrandbosts' => $getBrandboost[0], 'brandId' => $brandId, 'offstep' => $offstepdata));
    }

    public function edit_offsite_step1() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $campaignName = $post['campaignName'];
            $brandboostID = $post['brandboostId'];

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

    public function delete_multipal_brandboost_widget() {

        $response = array();
        $post = array();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $multi_widget_id = $post['multi_widget_id'];

            $aData = array(
                'delete_status' => '1'
            );

            foreach ($multi_widget_id as $widgetID) {

                $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);

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
        }
        echo json_encode($response);
        exit;
    }

    public function archive_multipal_brandboost_widget() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($this->input->post()) {
            $post = $this->input->post();
            $multi_widget_id = $post['multi_brandboost_widget_id'];

            $aData = array(
                'status' => '3'
            );

            foreach ($multi_widget_id as $widgetID) {

                $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);

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
        }
        echo json_encode($response);
        exit;
    }

    public function delete_brandboost_widget() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $widgetID = $post['widget_id'];

            $aData = array(
                'delete_status' => '1'
            );

            $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);

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
    }

    public function getOnsiteWidgetEmbedCode() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $widgetID = $post['widget_id'];

            $result = $this->mBrandboost->getBBWidgets($widgetID);

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
    }

    public function delete_multipal_brandboost() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $multi_brandboost_id = $post['multi_brandboost_id'];

            $aData = array(
                'delete_status' => '1'
            );

            foreach ($multi_brandboost_id as $brandboostID) {

                $result = $this->mBrandboost->update($userID, $aData, $brandboostID);

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
        }
        echo json_encode($response);
        exit;
    }

    public function archive_multipal_brandboost() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $multi_brandboost_id = $post['multi_brandboost_id'];

            $aData = array(
                'status' => '3'
            );

            foreach ($multi_brandboost_id as $brandboostID) {

                $result = $this->mBrandboost->update($userID, $aData, $brandboostID);

                if ($result) {
                    //Add Useractivity log

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
        }
        echo json_encode($response);
        exit;
    }

    public function delete_brandboost() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $brandboostID = $post['brandboost_id'];

            $aData = array(
                'delete_status' => '1'
            );

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);

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

            echo json_encode($response);
            exit;
        }
    }

    public function getBBECode() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $brandboostID = $post['brandboost_id'];

            $result = $this->mBrandboost->getBrandboost($brandboostID);

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
    }

    public function subscribers($listId) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        $allSubscribers = $this->rLists->getAllSubscribersList($listId);
        $getBrandboost = $this->mBrandboost->getBrandboost($listId);

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li><a href="' . base_url('admin/brandboost/onsite') . '">' . $getBrandboost[0]->brand_title . '</a></li>
			<li class="active">Subscribers</li>
			</ul>';

        $aData = array(
            'title' => 'Brand Boost Subscribers',
            'pagename' => $breadcrumb,
            'subscribersData' => $allSubscribers,
            'list_id' => $listId
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/list_subscribers_page', $aData);
    }

    public function add_subscriber() {
        $response = array();
        $post = $this->input->post();
        //pre($post);
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if (empty($post)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }


        $brandboostID = strip_tags($post['listId']);

        if (empty($brandboostID)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }
        $emailUserId = '';
        $firstName = strip_tags($post['firstname']);
        $lastName = strip_tags($post['lastname']);
        $email = strip_tags($post['email']);
        //$emailUser = getUserDetailByEmailId($email);
        $oUserAccount = $this->mUser->checkEmailExist($email);
        if (!empty($oUserAccount)) {
            $emailUserId = $oUserAccount[0]->id;
        }

        $phone = strip_tags($post['phone']);

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

    public function getSubscriberById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $aSubscriber = $this->rLists->getSubscriber($post['subscriberID']);
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

    public function update_subscriber() {

        $response = array();
        $response['status'] = 'error';
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        if ($post) {
            $firstname = strip_tags($post['edit_firstname']);
            $lastname = strip_tags($post['edit_lastname']);
            $email = strip_tags($post['edit_email']);
            $phone = strip_tags($post['edit_phone']);
            $subscriberID = strip_tags($post['edit_subscriberID']);
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

    public function update_subscriber_status() {

        $response = array();
        $post = $this->input->post();
        if ($post) {

            $status = strip_tags($post['status']);
            $subscriberId = strip_tags($post['subscriber_id']);

            $aData = array(
                'status' => $status
            );

            $result = $this->rLists->updateSubscriber($aData, $subscriberId);
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
    }

    public function delete_multipal_subscriber() {

        $response = array();
        $post = $this->input->post();
        if ($post) {

            $multiSubscriberId = $post['multiSubscriberId'];

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

    public function deleteReviewRequest() {
        $response = array();
        $post = $this->input->post();
        if ($post) {
            $multipalIds = $post['multipal_id'];
            foreach ($multipalIds as $recordId) {
                $result = $this->mBrandboost->deleteReviewRequest($recordId);
            }
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
        }
        echo json_encode($response);
        exit;
    }

    public function deleteRRrecord() {
        $response = array();
        $post = $this->input->post();
        if ($post) {
            $recordId = $post['recordId'];
            $result = $this->mBrandboost->deleteReviewRequest($recordId);
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
        }
        echo json_encode($response);
        exit;
    }

    public function delete_subscriber() {

        $response = array();
        $post = $this->input->post();
        if ($post) {

            $subscriberID = strip_tags($post['subscriberId']);

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

    public function importcsv() {
        $someoneadded = false;
        $post = $this->input->post();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $list_site = $post['list_site'];
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        //$userID = $this->session->userdata("current_user_id");
        $brandboostID = $post['list_id'];

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
    public function exportCSV() {
        // file name 
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $post = $this->input->post();
        $brandboostID = $post['list_id'];
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

    public function email_template_popup() {

        $response = array();
        $post = $this->input->post();
        if ($post) {
            $camp_id = $post['camp_id'];
            $camp_temp_src = $post['camp_temp_src'];

            $data = array(
                'templateData' => $this->mBrandboost->getAllCampaignTemplates($camp_temp_src),
                'campaign_id' => $camp_id,
                'campaignData' => $this->mBrandboost->getCampaignBycampID($camp_id)
            );

            $this->load->view('/admin/brandboost/email_template_popup', $data);
        }
    }

    public function sms_template_popup() {

        $response = array();
        $post = $this->input->post();
        if ($post) {
            $camp_id = $post['camp_id'];
            $camp_temp_src = $post['camp_temp_src'];

            $data = array(
                'templateData' => $this->mBrandboost->getAllCampaignTemplates($camp_temp_src),
                'campaign_id' => $camp_id,
                'campaignData' => $this->mBrandboost->getCampaignBycampID($camp_id)
            );

            $this->load->view('/admin/brandboost/sms_template_popup', $data);
        }
    }

    public function unsubscribeUser($brandboostID, $subscriberID) {
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

    public function unsubscriber_user() {
        $response = array();
        $post = $this->input->post();
        if ($post) {
            $email = $post['subscriber_email'];
            $subscriberID = $post['subscriberid'];
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

    public function showPWPreview() {

        $post = $this->input->post();

        if ($post) {
            $hashcode = $post['hashcode'];
            $widgetType = $post['widget_type'];
            $showPreview = '<script type="text/javascript" id="bbscriptloader" data-key="' . $hashcode . '" data-widgets="' . $widgetType . '" async="" src="' . base_url('/assets/js/preview_widgets.js') . '"></script>';
            echo $showPreview;
        }
    }

    public function addOffsiteReviews() {

        $post = $this->input->post();
        if ($post) {
            $siteId = $post['site_id'];
            $siteApiId = $post['site_api_id'];
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

    public function saveOnsitePreferences() {

        $response = array();
        $post = array();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($this->input->post()) {
            $post = $this->input->post();

            $brandboostID = $post['brandboostId'];
            $review_expire = $post['review_expire'];
            $review_expire_link = $post['review_expire_link'];

            $productName = $post['brand_product_name'];
            $productDesc = $post['brand_product_desc'];
            $productImg = $post['product_img'];
            $productType = $post['product_type'];
            $productId = $post['product_id'];
            $pData = array();

            if (!empty($productName)) {
                $pData['brandboost_id'] = $brandboostID;
                $pData['user_id'] = $userID;
                foreach ($productName as $key => $productData) {
                    if ($productData != '') {
                        $bbProductsData = $this->mBrandboost->getProductDataByOrder($brandboostID, $key);
                        $pData['product_name'] = $productData;
                        $pData['product_description'] = $productDesc[$key];
                        $pData['product_image'] = $productImg[$key];
                        $pData['product_type'] = $productType[$key];
                        $pData['product_order'] = $key;
                        if ($productId[$key] == '') {
                            if (!empty($bbProductsData)) {
                                $this->mBrandboost->updateProductData($pData, $brandboostID, $key);
                            } else {
                                $this->mBrandboost->insertProductData($pData);
                            }
                        } else {
                            $this->mBrandboost->updateProductByProductId($pData, $brandboostID, $productId[$key]);
                        }
                    }
                }
            }


            $revExpireLink = array();
            if ($review_expire_link == 'custom') {

                $txtInteger = $post['txtInteger'];
                $exp_duration = $post['exp_duration'];
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

            $result = $this->mBrandboost->update($userID, $aData, $brandboostID);

            // Update a image

            $title = strip_tags($post['title']);
            $desc = strip_tags($post['desc']);
            $domainName = strip_tags($post['domain_name']);
            $barndFileData = $post['brand_img'];
            $brandFileArray = array();

            foreach ($barndFileData['media_url'] as $key => $fileData) {
                $brandFileArray[$key]['media_url'] = $fileData;
                $brandFileArray[$key]['media_type'] = $barndFileData['media_type'][$key];
            }

            $logoImageFileName = $post['logo_img'] == '' ? $post['edit_logo_img'] : $post['logo_img'];
            $brandImageFileName = empty($post['brand_img']) ? $post['edit_brand_img'] : serialize($brandFileArray);

            $aDataBrandboost = array(
                'user_id' => $userID,
                'brand_title' => $title,
                'brand_desc' => $desc,
                'domain_name' => $domainName,
                'brand_img' => $brandImageFileName,
                'logo_img' => $logoImageFileName
            );
            $result = $this->mBrandboost->update($userID, $aDataBrandboost, $brandboostID);

            // Update image


            $feedback_type = $post['feedback_type'];
            $ratings_type = $post['ratings_type'];
            $from_name = $post['from_name'];
            $from_email = $post['from_email'];
            $sender_name = $post['sender_name'];
            $offsite_url = $post['offsite_url'];
            $positive_title = $post['positive_title'];
            $positive_subtitle = $post['positive_subtitle'];
            $negetive_title = $post['negetive_title'];
            $negetive_subtitle = $post['negetive_subtitle'];
            $neutral_title = $post['neutral_title'];
            $neutral_subtitle = $post['neutral_subtitle'];

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
            $aResponse = $this->mFeedback->getFeedbackResponse($brandboostID);
            if (count($aResponse) > 0) {
                $result = $this->mBrandboost->updateBrandboostFeedbackResponse($feedbackData, $brandboostID);
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
                $result = $this->mBrandboost->addBrandboostFeedbackResponse($feedbackData);
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
    }

    /* public function addBrandBoostWidgetData() {

      $oUser = getLoggedUser();
      $userID = $oUser->id;
      $response = array();
      $post = $this->input->post();
      $brandboostID = strip_tags($post['campaign_id']);
      $title = strip_tags($post['title']);
      $desc = strip_tags($post['desc']);
      $bAllowComment = strip_tags($post['allow_comment']);
      $bAllowVideoReview = strip_tags($post['allow_video_reviews']);
      $bAllowHelpful = strip_tags($post['allow_helpful']);
      $bAllowLiveReading = strip_tags($post['allow_live_reading']);
      $bAllowRatings = strip_tags($post['allow_ratings']);
      $bAllowTimestamp = strip_tags($post['allow_timestamp']);
      $bAllowProsCons = strip_tags($post['allow_pros_cons']);
      $bgColor = strip_tags($post['bg_color']);
      $textColor = strip_tags($post['text_color']);
      $pro_cons = strip_tags($post['pro_cons']);
      $domainName = strip_tags($post['domain_name']);
      $ratingValue = strip_tags($post['ratingValue']);
      $bbDisplay = strip_tags($post['bbDisplay']);
      $widgetID = strip_tags($post['edit_widgetId']);

      //$widgettype = $this->session->userdata('selectedOnsiteWidget');
      $numofrev = strip_tags($post['numofrev']);

      $barndFileData = $post['brand_img'];
      $brandFileArray = array();

      foreach ($barndFileData['media_url'] as $key => $fileData) {
      $brandFileArray[$key]['media_url'] = $fileData;
      $brandFileArray[$key]['media_type'] = $barndFileData['media_type'][$key];
      }

      $logoImageFileName = $post['logo_img'] == '' ? $post['edit_logo_img'] : $post['logo_img'];
      $brandImageFileName = empty($post['brand_img']) ? $post['edit_brand_img'] : serialize($brandFileArray);

      $review_expire = $post['review_expire'];
      $review_expire_link = $post['review_expire_link'];
      $revExpireLink = array();
      if ($review_expire_link == 'custom') {

      $txtInteger = $post['txtInteger'];
      $exp_duration = $post['exp_duration'];
      $revExpireLink['delay_value'] = $txtInteger;
      $revExpireLink['delay_unit'] = $exp_duration;
      } else {

      $revExpireLink['delay_value'] = 'never';
      $revExpireLink['delay_unit'] = 'never';
      }


      $aData = array(
      'user_id' => $userID,
      'brandboost_id' => $brandboostID,
      'brand_title' => $title,
      'brand_desc' => $desc,
      'widget_img' => $brandImageFileName,
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


      $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);

      if ($result) {
      $response = array('status' => 'ok');
      } else {
      $response = array('status' => 'error');
      }

      echo json_encode($response);
      exit;
      } */

    public function setOnsiteWidget() {
        $response = array("status" => "error", "msg" => "Something went wrong");
        $post = $this->input->post();
        if (empty($post)) {
            $response = array("status" => "error", "msg" => "Empty request header");
            echo json_encode($response);
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $widgetTypeID = $post['widgetTypeID'];
        $widgetID = $post['widgetID'];
        $aData = array(
            'widget_type' => $widgetTypeID
        );

        if (!empty($widgetID)) {
            $this->session->set_userdata("selectedOnsiteWidget", $widgetID);
            $result = $this->mBrandboost->updateWidget($userID, $aData, $widgetID);
            $response = array("status" => "success", "msg" => "Okay");
            echo json_encode($response);
            exit;
        }
    }

    public function setWidget() {
        $response = array("status" => "error", "msg" => "Something went wrong");
        $post = $this->input->post();
        if (empty($post)) {
            $response = array("status" => "error", "msg" => "Empty request header");
            echo json_encode($response);
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $widgetID = $post['widgetID'];
        $brandboostId = $post['brandboostId'];
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

    public function reviewdetails($reviewID = 0) {
        $response = array();
        $response['status'] = 'error';
        $post = $this->input->post();
        $get = $this->input->get();
        $selectedTab = $get['t'];
        if (!empty($post)) {
            $revID = strip_tags($post['reviewid']);
            $actionName = strip_tags($post['action']);
        }

        $reviewID = ($revID > 0) ? $revID : $reviewID;
        $reviewCommentCount = getCampaignCommentCount($reviewID);
        $reviewNotesData = $this->mReviews->listReviewNotes($reviewID);
        $reviewCommentsData = $this->mReviews->getReviewAllParentsComments($reviewID, $start = 0);
        $reviewData = $this->mReviews->getReviewInfo($reviewID);
        $reviewTags = getTagsByReviewID($reviewID);
        $totalComment = $this->mReviews->parentsCommentsCount($reviewID);
        $productData = $this->mBrandboost->getProductDataById($reviewData->product_id);
        $productName = $reviewData->product_id > 0 ? $productData->product_name : $reviewData->brand_title;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/brandboost/onsite') . '" class="sidebar-control hidden-xs">On site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/brandboost/reviews/') . $reviewData->bbId . '" data-toggle="tooltip" data-placement="bottom" title="' . $productName . ' Review" class="sidebar-control active hidden-xs ">' . $productName . ' Review</a></li>
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
            $popupContent = $this->load->view('admin/components/smart-popup/reviews', $aData, true);
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        } else {
            $this->template->load('admin/admin_template_new', 'admin/brandboost/review_details', $aData);
        }
    }

    public function getreviwecomments() {
        $post = $this->input->post();
        $response = array("status" => "error", "commentList" => '');
        if ($post) {
            $reviewID = $post['reviewId'];
            $startLimit = $post['startinglimitVal'];
            $actionType = $post['actionType'];
            $source = strip_tags($post['source']);
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

    public function stats($type, $id) {
        if (empty($id)) {
            //Handle empty id error
        }
        $oBrandboost = $this->mBrandboost->getBrandboost($id);
        $oAllSubscribers = $this->rLists->getAllSubscribersList($id);


        if ($type == 'onsite') {
            $selectedTab = $this->input->get('t');
            $oRequests = $this->mBrandboost->getReviewRequest($id);
            $oResponse = $this->mBrandboost->getReviewRequestResponse($id);

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

            $this->template->load('admin/admin_template_new', 'admin/brandboost/stats/onsite', $aData);
        } else if ($type == 'offsite') {
            
        }
    }

    public function review_request($param) {
        $oRequests = $this->mBrandboost->getReviewRequest($id);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Review Requests" class="sidebar-control active hidden-xs ">Review Requests</a></li>
			</ul>';
        $bActiveSubsription = $this->mUser->isActiveSubscription();

        $aData = array(
            'oRequest' => $oRequests,
            'title' => 'Review Requests',
            'pagename' => $breadcrumb,
            'bActiveSubsription' => $bActiveSubsription,
            'param' => $param
        );

        $this->template->load('admin/admin_template_new', 'admin/brandboost/review_request', $aData);
    }

    public function getSendgridStats() {
        $post = $this->input->post();
        $response = array("status" => "error", "msg" => 'Something went wrong');

        if (empty($post)) {
            $response = array("status" => "error", "msg" => 'Request object is empty');
            echo json_encode($response);
            exit;
        }

        $type = $post['type'];
        $id = $post['id'];
        $aStats = $this->mBrandboost->getSendgridStats($type, $id);
        if (!empty($aStats)) {
            $aCategorizedStats = $this->mBrandboost->getSendgridCategorizedStatsData($aStats);
        }

        $content = $this->load->view('admin/brandboost/stats/sendgrid-stats', array('aData' => $aCategorizedStats), TRUE);
        $response = array('status' => 'success', 'content' => $content, 'msg' => 'Request object is empty');
        echo json_encode($response);
        exit;
    }

    public function getTwilioStats() {
        $post = $this->input->post();
        $response = array("status" => "error", "msg" => 'Something went wrong');

        if (empty($post)) {
            $response = array("status" => "error", "msg" => 'Request object is empty');
            echo json_encode($response);
            exit;
        }

        $type = $post['type'];
        $id = $post['id'];
        $aStats = $this->mBrandboost->getTwilioStats($type, $id);
        if (!empty($aStats)) {
            $aCategorizedStats = $this->mBrandboost->getTwilioCategorizedStatsData($aStats);
        }

        $content = $this->load->view('admin/brandboost/stats/sendgrid-stats', array('aData' => $aCategorizedStats), TRUE);
        $response = array('status' => 'success', 'content' => $content, 'msg' => 'Request object is empty');
        echo json_encode($response);
        exit;
    }

    public function campaigns() {
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

    public function reports($bbId = '') {
        $aUser = getLoggedUser();
        $currentUserId = $aUser->id;
        $bbStatsData = $this->mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId = '');

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

        $this->template->load('admin/admin_template_new', 'admin/brandboost/campaign_reports', $aData);
    }

    public function feedbackreports($bbId = '') {
        $aUser = getLoggedUser();
        $currentUserId = $aUser->id;
        $bbStatsData = $this->mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId = '');

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

        $this->template->load('admin/admin_template_new', 'admin/brandboost/campaign_feedback_reports', $aData);
    }

    /* public function reportsResponsePerformance() {

      $breadcrumb = '<ul class="breadcrumb">
      <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
      <li class="active">Brand Boost Report Response Performance</li>
      </ul>';
      $aData = array(
      'aData' => array(
      'oBrandboost' => $oBrandboost
      ),
      'title' => 'Brand Boost Report Response Performance',
      'pagename' => $breadcrumb
      );

      $this->template->load('admin/admin_campaign_template', 'admin/brandboost/reportresponse', $aData);
      } */

    public function servicereports($bbId = '') {
        $currentUserId = $this->session->userdata("current_user_id");
        $bbStatsData = $this->mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId = '');
        $positiveComments = $this->mBrandboost->recentComments($currentUserId, 'positive');
        $nagetiveComments = $this->mBrandboost->recentComments($currentUserId, 'nagetive');

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

        $this->template->load('admin/admin_template_new', 'admin/brandboost/campaign_service_reports', $aData);
    }

    public function getEmailTempByID() {
        $post = $this->input->post();
        $emailTempId = $post['emailTempId'];
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

    public function updateCampaignOrder() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $previousEventID = $post['previous_id'];
        $currentEventID = $post['current_id'];
        $nextEventID = $post['next_id'];
        $actionName = $post['action_name'];


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

    public function statistics($brandboostID) {
        if (empty($brandboostID)) {
            redirect("admin/");
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;



        $bActiveSubsription = $this->mUser->isActiveSubscription();
        //get Automation Info
        $oBrandData = $this->mBrandboost->getBrandboost($brandboostID);
        $oBrandboost = $oBrandData[0];
        //pre($oBrandboost);
        //get Brandboost Events
        $oEvents = $this->mBrandboost->getBrandboostEvents($brandboostID);


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

        $this->template->load('admin/admin_template_new', 'admin/brandboost/brandboost-stats', $aData);
    }

    public function exportReviews() {

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

    public function exportMedia() {

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

    public function campaignPreferences() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $brandboostID = $post['brandboostID'];
        $oBrandboost = $this->mBrandboost->getBrandboost($brandboostID);
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

    public function all_campaign() {

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

    public function details($id) {
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