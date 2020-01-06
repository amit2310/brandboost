<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BroadcastModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\TemplatesModel;
use App\Models\Admin\ListsModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\TagsModel;
use App\Models\Admin\Modules\EmailsModel;
use Cookie;
use Session;

class Broadcast extends Controller {

    /**
     * Default controller which will list all the broadcast campaigns
     */
    public function index() {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Broadcast" class="sidebar-control active hidden-xs ">Broadcast</a></li>
                    </ul>';

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        $activeTab = Session::put("setTab", "");
        $campaignType = '';
        $moduleName = 'broadcast';
        //$oBroadcast = $mBroadcast->getMyBroadcasts($userID);

        $oBroadcast = $mBroadcast->getMyBroadcastsByTypes($userID, $campaignType);
        $campaignTemplates = $mBroadcast->getMyCampaignTemplate($userID);
        return view('admin.broadcast.index', ['title' => 'Brand Boost Broadcast', 'oBroadcast' => $oBroadcast, 'campaignTemplates' => $campaignTemplates, 'campaignType' => $campaignType, 'moduleName' => $moduleName, 'pagename' => $breadcrumb])->with(['mBroadcast' => $mBroadcast]);
    }

    /**
     * Used to display all email broadcast campaigns
     */
    public function email() {
        $campaignType = 'Email';
        /*$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Email </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Broadcast" class="sidebar-control active hidden-xs ">Broadcast</a></li>
                    </ul>';*/

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $aBreadcrumb = array(
            'Home' => '#/',
            'Email' => '#/modules/emails/dashboard',
            'Campaigns' => ''
        );


        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        /*$activeTab = Session::put("setTab", "");*/
        $oBroadcast = $mBroadcast->getMyBroadcastsByTypes($userID, $campaignType);
        /*$campaignTemplates = $mBroadcast->getMyCampaignTemplate($userID);*/
        $moduleName = 'broadcast';
        /*Session::put("setTab", '');*/

        /* Calculation to render HTML in view template */

        if(count($oBroadcast) > 0) {
            foreach ($oBroadcast as $broadCastData) {
                $aDeliveryParam = json_decode($broadCastData->data);
                $deliveryDate = $aDeliveryParam->delivery_date;
                $deliveryTime = $aDeliveryParam->delivery_time;
                $timeString = $deliveryDate . ' ' . $deliveryTime;
                $deliverAt = strtotime($timeString);

                $gmt_date = strtotime(gmdate('Y-m-d H:i:s', time()));
                $estTime = date("Y-m-d H:i:s", ($gmt_date - 14400));
                $timeNow = strtotime($estTime);
                $bExpired = false;
                if ($timeNow > $deliverAt) {
                    $bExpired = true;
                }
                $broadCastData->isExpired = $bExpired;
                $totalSentGraph = 0;
                $totalOpenGraph = 0;
                $totalClickGraph = 0;
                $totalQueuedGraph = 0;
                $totalDeliveredGraph = 0;
                $queued = $open = $click = 0;
                $newQueue = $newSent = $newDelivered = 0;
                $iActiveCount = $iArchiveCount = 0;

                if ($broadCastData->bc_status == 'archive') {
                    $iArchiveCount++;
                } else {
                    $iActiveCount++;
                }

                if (strtolower($broadCastData->campaign_type) == 'email') {
                    if ($broadCastData->sending_method == 'split') {
                        $aStats = $mBroadcast->getBroadcastSendgridStats('broadcast', $broadCastData->broadcast_id, '', 'split');
                        //pre($aStats);
                    } else {
                        $aStats = $mBroadcast->getBroadcastSendgridStats('broadcast', $broadCastData->broadcast_id);
                    }

                    $aCategorizedStats = $mBroadcast->getBroadcastSendgridCategorizedStatsData($aStats);
                    //pre($aCategorizedStats);

                    $totalSent = $aCategorizedStats['processed']['UniqueCount'];
                    $delivered = $aCategorizedStats['delivered']['UniqueCount'];
                    $open = $aCategorizedStats['open']['UniqueCount'];
                    $click = $aCategorizedStats['click']['UniqueCount'];

                    if ($totalSent > 0) {
                        $totalSentGraph = $delivered * 100 / $totalSent;
                        $totalSentGraph = ceil($totalSentGraph);
                    }
                } else {

                    if ($broadCastData->sending_method == 'split') {
                        $aStatsSms = $mBroadcast->getBroadcasstTwilioStats('broadcast', $broadCastData->broadcast_id, '', 'split');
                    } else {
                        $aStatsSms = $mBroadcast->getBroadcasstTwilioStats('broadcast', $broadCastData->broadcast_id);
                    }

                    $aCategorizedStatsSms = $mBroadcast->getBroadcastTwilioCategorizedStatsData($aStatsSms);

                    $totalSent = $aCategorizedStatsSms['sent']['UniqueCount'];
                    $delivered = $aCategorizedStatsSms['delivered']['UniqueCount'];
                    $queued = $aCategorizedStatsSms['queued']['UniqueCount'];
                    $open = $aCategorizedStatsSms['accepted']['UniqueCount'];

                    if ($totalSent > 0) {
                        $totalDeliveredGraph = $delivered * 100 / $totalSent;
                        $totalDeliveredGraph = ceil($totalDeliveredGraph);

                        $totalSentGraph = $totalSent * 100 / $totalSent;
                        $totalSentGraph = ceil($totalSentGraph);

                        $totalQueuedGraph = $queued * 100 / $totalSent;
                        $totalQueuedGraph = ceil($totalQueuedGraph);
                    }
                }
                $totalVariations = 0;
                if ($broadCastData->sending_method == 'split') {
                    $oVariations = $mBroadcast->getBroadcastVariations($broadCastData->broadcast_id);
                    $totalVariations = count($oVariations);
                }


                if ($totalSent > 0) {
                    $totalOpenGraph = $open * 100 / $totalSent;
                    $totalOpenGraph = ceil($totalOpenGraph);

                    $totalClickGraph = $click * 100 / $totalSent;
                    $totalClickGraph = ceil($totalClickGraph);
                }

                $addPC = '';
                if ($totalSentGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalOpenGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalDeliveredGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalClickGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalQueuedGraph > 50) {
                    $addPC = 'over50';
                }

                $clsCreateSegment = '';
                if($delivered > 0) {
                    $clsCreateSegment = 'createSegment';
                } else if($open > 0) {
                    $clsCreateSegment = 'createSegment';
                } else if($click > 0) {
                    $clsCreateSegment = 'createSegment';
                } else if($queued > 0) {
                    $clsCreateSegment = 'createSegment';
                }

                $broadCastData->totalSent = $totalSent;
                $broadCastData->delivered = $delivered;
                $broadCastData->queued = $queued;
                $broadCastData->open = $open;
                $broadCastData->click = $click;
                $broadCastData->clsCreateSegment = $clsCreateSegment;
                $broadCastData->totalDeliveredGraph = $totalDeliveredGraph;
                $broadCastData->totalSentGraph = $totalSentGraph;
                $broadCastData->totalQueuedGraph = $totalQueuedGraph;
                $broadCastData->totalVariations = $totalVariations;
                $broadCastData->totalOpenGraph = $totalOpenGraph;
                $broadCastData->totalClickGraph = $totalClickGraph;
                $broadCastData->addPC = $addPC;
                $broadCastData->iActiveCount = $iActiveCount;
                $broadCastData->iArchiveCount = $iArchiveCount;
            }
        }

        $aData = array(
            'title' => 'Brand Boost Broadcast',
            'oBroadcast' => $oBroadcast->items(),
            'allData' => $oBroadcast,
            'breadcrumb' => $aBreadcrumb,
            /*'campaignTemplates' => $campaignTemplates,
            'pagename' => $breadcrumb,*/
            'campaignType' => $campaignType,
            'moduleName' => $moduleName
        );

        /* Calculation to render HTML in view template */

        //return view('admin.broadcast.index', array('title' => 'Brand Boost Broadcast', 'oBroadcast' => $oBroadcast, 'campaignTemplates' => $campaignTemplates, 'pagename' => $breadcrumb, 'campaignType' => $campaignType, 'moduleName' => $moduleName))->with('mBroadcast', $mBroadcast);

        echo json_encode($aData);
        exit();
    }

    /**
     * Used to display all sms broadcast campaigns
     */
    public function sms() {
        $campaignType = 'SMS';
        /*$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">SMS </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Broadcast" class="sidebar-control active hidden-xs ">Broadcast</a></li>
                    </ul>';*/
        $aBreadcrumb = array(
            'Home' => '#/',
            'Email' => '#/modules/sms/dashboard',
            'Campaigns' => ''
        );

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        /*$activeTab = Session::put("setTab", "");*/
        $oBroadcast = $mBroadcast->getMyBroadcastsByTypes($userID, $campaignType);
        /*$campaignTemplates = $mBroadcast->getMyCampaignTemplate($userID);*/
        $moduleName = 'broadcast';
        Session::put("setTab", '');

        /* Calculation to render HTML in view template */

        if(count($oBroadcast) > 0) {
            foreach ($oBroadcast as $broadCastData) {
                $aDeliveryParam = json_decode($broadCastData->data);
                $deliveryDate = $aDeliveryParam->delivery_date;
                $deliveryTime = $aDeliveryParam->delivery_time;
                $timeString = $deliveryDate . ' ' . $deliveryTime;
                $deliverAt = strtotime($timeString);

                $gmt_date = strtotime(gmdate('Y-m-d H:i:s', time()));
                $estTime = date("Y-m-d H:i:s", ($gmt_date - 14400));
                $timeNow = strtotime($estTime);
                $bExpired = false;
                if ($timeNow > $deliverAt) {
                    $bExpired = true;
                }
                $broadCastData->isExpired = $bExpired;
                $totalSentGraph = 0;
                $totalOpenGraph = 0;
                $totalClickGraph = 0;
                $totalQueuedGraph = 0;
                $totalDeliveredGraph = 0;
                $queued = $open = $click = 0;
                $newQueue = $newSent = $newDelivered = 0;
                $iActiveCount = $iArchiveCount = 0;

                if ($broadCastData->bc_status == 'archive') {
                    $iArchiveCount++;
                } else {
                    $iActiveCount++;
                }

                if (strtolower($broadCastData->campaign_type) == 'email') {
                    if ($broadCastData->sending_method == 'split') {
                        $aStats = $mBroadcast->getBroadcastSendgridStats('broadcast', $broadCastData->broadcast_id, '', 'split');
                        //pre($aStats);
                    } else {
                        $aStats = $mBroadcast->getBroadcastSendgridStats('broadcast', $broadCastData->broadcast_id);
                    }

                    $aCategorizedStats = $mBroadcast->getBroadcastSendgridCategorizedStatsData($aStats);
                    //pre($aCategorizedStats);

                    $totalSent = $aCategorizedStats['processed']['UniqueCount'];
                    $delivered = $aCategorizedStats['delivered']['UniqueCount'];
                    $open = $aCategorizedStats['open']['UniqueCount'];
                    $click = $aCategorizedStats['click']['UniqueCount'];

                    if ($totalSent > 0) {
                        $totalSentGraph = $delivered * 100 / $totalSent;
                        $totalSentGraph = ceil($totalSentGraph);
                    }
                } else {

                    if ($broadCastData->sending_method == 'split') {
                        $aStatsSms = $mBroadcast->getBroadcasstTwilioStats('broadcast', $broadCastData->broadcast_id, '', 'split');
                    } else {
                        $aStatsSms = $mBroadcast->getBroadcasstTwilioStats('broadcast', $broadCastData->broadcast_id);
                    }

                    $aCategorizedStatsSms = $mBroadcast->getBroadcastTwilioCategorizedStatsData($aStatsSms);

                    $totalSent = $aCategorizedStatsSms['sent']['UniqueCount'];
                    $delivered = $aCategorizedStatsSms['delivered']['UniqueCount'];
                    $queued = $aCategorizedStatsSms['queued']['UniqueCount'];
                    $open = $aCategorizedStatsSms['accepted']['UniqueCount'];

                    if ($totalSent > 0) {
                        $totalDeliveredGraph = $delivered * 100 / $totalSent;
                        $totalDeliveredGraph = ceil($totalDeliveredGraph);

                        $totalSentGraph = $totalSent * 100 / $totalSent;
                        $totalSentGraph = ceil($totalSentGraph);

                        $totalQueuedGraph = $queued * 100 / $totalSent;
                        $totalQueuedGraph = ceil($totalQueuedGraph);
                    }
                }

                $totalVariations = 0;
                if ($broadCastData->sending_method == 'split') {
                    $oVariations = $mBroadcast->getBroadcastVariations($broadCastData->broadcast_id);
                    $totalVariations = count($oVariations);
                }


                if ($totalSent > 0) {
                    $totalOpenGraph = $open * 100 / $totalSent;
                    $totalOpenGraph = ceil($totalOpenGraph);

                    $totalClickGraph = $click * 100 / $totalSent;
                    $totalClickGraph = ceil($totalClickGraph);
                }

                $addPC = '';
                if ($totalSentGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalOpenGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalDeliveredGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalClickGraph > 50) {
                    $addPC = 'over50';
                } else if ($totalQueuedGraph > 50) {
                    $addPC = 'over50';
                }

                $clsCreateSegment = '';
                if($delivered > 0) {
                    $clsCreateSegment = 'createSegment';
                } else if($open > 0) {
                    $clsCreateSegment = 'createSegment';
                } else if($click > 0) {
                    $clsCreateSegment = 'createSegment';
                } else if($queued > 0) {
                    $clsCreateSegment = 'createSegment';
                }

                $broadCastData->totalSent = $totalSent;
                $broadCastData->delivered = $delivered;
                $broadCastData->queued = $queued;
                $broadCastData->open = $open;
                $broadCastData->click = $click;
                $broadCastData->clsCreateSegment = $clsCreateSegment;
                $broadCastData->totalDeliveredGraph = $totalDeliveredGraph;
                $broadCastData->totalSentGraph = $totalSentGraph;
                $broadCastData->totalQueuedGraph = $totalQueuedGraph;
                $broadCastData->totalVariations = $totalVariations;
                $broadCastData->totalOpenGraph = $totalOpenGraph;
                $broadCastData->totalClickGraph = $totalClickGraph;
                $broadCastData->addPC = $addPC;
                $broadCastData->iActiveCount = $iActiveCount;
                $broadCastData->iArchiveCount = $iArchiveCount;
            }
        }

        $aData = array(
            'title' => 'Brand Boost Broadcast',
            'oBroadcast' => $oBroadcast->items(),
            'allData' => $oBroadcast,
            'breadcrumb' => $aBreadcrumb,
            /*'campaignTemplates' => $campaignTemplates,
            'pagename' => $breadcrumb,*/
            'campaignType' => $campaignType,
            'moduleName' => $moduleName
        );

        //return view('admin.broadcast.index', array('title' => 'Brand Boost Broadcast', 'oBroadcast' => $oBroadcast, 'campaignTemplates' => $campaignTemplates, 'pagename' => $breadcrumb, 'campaignType' => $campaignType, 'moduleName' => $moduleName))->with('mBroadcast', $mBroadcast);

        echo json_encode($aData);
        exit();
    }

    /**
     * Used to display sms campaign overview
     */
    public function smsoverview() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $userMobile = $aUser->mobile;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }

        //Instantiate Email model to get its methods and properties
        $mEmails = new EmailsModel();

        //Instantiate User model to get its methods and properties
        $mUsers = new UsersModel();

        //Instantiate subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();


        $oAutomations = $mEmails->getEmailAutomations($userID);
        $bActiveSubsription = $mUsers->isActiveSubscription();
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/sms/') . '" class="sidebar-control hidden-xs">SMS</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="SMS Overview" class="sidebar-control active hidden-xs ">Overview</a></li>
                    </ul>';
        $smsDetailSubs = $mSubscriber->smsDetailSubs($userID);
        $smsDetailAutomation = $mSubscriber->smsDetailAutomation($userID);
        $smsDetailNPS = $mSubscriber->smsDetailNPS($userID);
        $smsDetailReferral = $mSubscriber->smsDetailReferral($userID);
        $smsDetailOnsite = $mSubscriber->smsDetailOnsite($userID);
        $smsDetailChat = $mSubscriber->smsDetailChat($userMobile);
        $pageData = array(
            'title' => 'SMS Overview',
            'pagename' => $breadcrumb,
            'smsDetailNPS' => $smsDetailNPS,
            'smsDetailAutomation' => $smsDetailAutomation,
            'smsDetailSubs' => $smsDetailSubs,
            'smsDetailReferral' => $smsDetailReferral,
            'smsDetailOnsite' => $smsDetailOnsite,
            'smsDetailChat' => $smsDetailChat,
            'oAutomations' => $oAutomations,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'type' => 'sms'
        );
        return view('admin.broadcast.smsoverview', $pageData);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function setup(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $id = $request->id;
        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        $twillioData = $mBroadcast->getTwillioData($userID);
        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $id);
        $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($id);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/email");
            exit;
        }

        $moduleName = 'broadcast';
        if ($id > 0) {
            $oEvents = $mWorkflow->getWorkflowEvents($id, $moduleName);
            if (!empty($oEvents)) {
                $eventID = $oEvents[0]->id;
                if ($eventID > 0) {
                    $oCampaign = $mWorkflow->getEventCampaign($eventID, $moduleName);
                }
            }
        }
        $campaignType = $oCampaign[0]->campaign_type;

        $aBreadcrumb = array(
            'Home' => '#/',
            'Email' => '#/modules/email/dashboard',
            'Email Campaigns' => '#/modules/emails/broadcast',
            'Setup' => '',
        );

        $aData = array(
            'title' => 'Email Broadcast',
            'breadcrumb' => $aBreadcrumb,
            'oBroadcast' => $oBroadcast[0],
            'moduleName' => $moduleName,
            'userData' => $aUser,
            'twillioData' => $twillioData[0],
            'campaignType' => $campaignType,
            'subscribers' => $oBroadcastSubscriber
        );
        echo json_encode($aData);
        exit;
        //return view('admin.broadcast.setup', $aData)->with(['mBroadcast' => $mBroadcast, 'mTags' => $mTag]);
    }

    public function smsSetup(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $id = $request->id;
        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        $twillioData = $mBroadcast->getTwillioData($userID);
        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $id);
        $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($id);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/sms");
            exit;
        }

        $moduleName = 'broadcast';
        if ($id > 0) {
            $oEvents = $mWorkflow->getWorkflowEvents($id, $moduleName);
            if (!empty($oEvents)) {
                $eventID = $oEvents[0]->id;
                if ($eventID > 0) {
                    $oCampaign = $mWorkflow->getEventCampaign($eventID, $moduleName);
                }
            }
        }
        $campaignType = $oCampaign[0]->campaign_type;

        $aBreadcrumb = array(
            'Home' => '#/',
            'Sms' => '#/modules/sms/dashboard',
            'Sms Campaigns' => '#/modules/sms/broadcast',
            'Setup' => '',
        );

        $aData = array(
            'title' => 'Sms Broadcast',
            'breadcrumb' => $aBreadcrumb,
            'oBroadcast' => $oBroadcast[0],
            'moduleName' => $moduleName,
            'userData' => $aUser,
            'twillioData' => $twillioData[0],
            'campaignType' => $campaignType,
            'subscribers' => $oBroadcastSubscriber
        );
        echo json_encode($aData);
        exit;
        //return view('admin.broadcast.setup', $aData)->with(['mBroadcast' => $mBroadcast, 'mTags' => $mTag]);
    }

    public function setupTargetAudience(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $id = $request->id;
        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Tags model to get its methods and properties
        $mTag = new TagsModel();

        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $id);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/email");
            exit;
        }

        $moduleName = 'broadcast';
        if ($id > 0) {
            $oEvents = $mWorkflow->getWorkflowEvents($id, $moduleName);
            if (!empty($oEvents)) {
                $eventID = $oEvents[0]->id;
                if ($eventID > 0) {
                    $oCampaign = $mWorkflow->getEventCampaign($eventID, $moduleName);
                }
            }
        }
        $campaignType = $oCampaign[0]->campaign_type;
        $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($id);


        //loaded broadcast properties tags
        $broadcastID = strip_tags($request->broadcastId);
        $oAutomationLists = $mLists->getAutomationLists($id);
        $oCampaignContacts = $mBroadcast->getBroadcastContacts($id);
        $aTags = $mTag->getClientTags($userID);
        $oCampaignTags = $mBroadcast->getBroadcastTags($id);
        $oCampaignLists = $oAutomationLists;
        $oCampaignSegments = $mBroadcast->getBroadcastSegments($id);
        $aDataImportButtons = array(
            'broadcastID' => $id,
            'oCampaignLists' => $oCampaignLists,
            'oCampaignContacts' => $oCampaignContacts,
            'aTags' => $aTags,
            'oCampaignTags' => $oCampaignTags,
            'oCampaignSegments' => $oCampaignSegments
        );
        $sImportButtons = view('admin.broadcast.partials.importButtonTags', $aDataImportButtons)->render();
        $aDataImportButtons['bSummary'] = true;
        $sImportButtonsSummary = view('admin.broadcast.partials.importButtonTags', $aDataImportButtons)->render();



        //loaded broadcast properties tags

        $oCampaignExcludedLists = $mLists->getAutomationExcludedLists($id);
        $oCampaignExcludedContacts = $mBroadcast->getBroadcastExcludedContacts($id);
        $oCampaignExcludedTags = $mBroadcast->getBroadcastExcludedTags($id);
        $oCampaignExcludedSegments = $mBroadcast->getBroadcastExcludedSegments($id);
        $aDataExportButtons = array(
            'broadcastID' => $id,
            'oCampaignLists' => $oCampaignExcludedLists,
            'oCampaignContacts' => $oCampaignExcludedContacts,
            'aTags' => $aTags,
            'oCampaignTags' => $oCampaignExcludedTags,
            'oCampaignSegments' => $oCampaignExcludedSegments
        );
        $sExcludButtons = view('admin.broadcast.partials.excludeButtonTags', $aDataExportButtons)->render();
        $aDataExportButtons['bSummaryExclude'] = true;
        $sExcludButtonsSummary = view('admin.broadcast.partials.excludeButtonTags', $aDataExportButtons)->render();
        $aAudienceCount = $this->importExcludeAudienceCount($id);
        $importedCount = count($aAudienceCount['imported']);
        $exportedCount = count($aAudienceCount['excluded']);


        if(strtolower($campaignType) == 'email'){
            $aBreadcrumb = array(
                'Home' => '#/',
                'Email' => '#/modules/email/dashboard',
                'Email Campaigns' => '#/modules/emails/broadcast',
                'Setup' => '',
            );
        }

        if(strtolower($campaignType) == 'sms'){
            $aBreadcrumb = array(
                'Home' => '#/',
                'Sms' => '#/modules/sms/dashboard',
                'Sms Campaigns' => '#/modules/sms/broadcast',
                'Setup' => '',
            );
        }


        $aData = array(
            'title' => 'Email Broadcast',
            'breadcrumb' => $aBreadcrumb,
            'oBroadcast' => $oBroadcast[0],
            'moduleName' => $moduleName,
            'userData' => $aUser,
            'campaignType' => $campaignType,
            'sImportButtons' => $sImportButtons,
            'sImportButtonsSummary' => $sImportButtonsSummary,
            'sExcludButtons' => $sExcludButtons,
            'sExcludButtonsSummary' => $sExcludButtonsSummary,
            'importedCount' => $importedCount,
            'exportedCount' => $exportedCount,
            'oBroadcastSubscriber' => $oBroadcastSubscriber->items(),
            'allDataSubscribers' => $oBroadcastSubscriber
        );
        echo json_encode($aData);
        exit;
        //return view('admin.broadcast.setup', $aData)->with(['mBroadcast' => $mBroadcast, 'mTags' => $mTag]);
    }

    public function setupLoadTemplates(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $id = $request->id;
        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();

        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $id);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/email");
            exit;
        }

        $moduleName = 'broadcast';
        $campaignType = strtolower($oBroadcast[0]->campaign_type);

        $oDefaultTemplates = $mTemplates->getCommonTemplates('', '', '', $campaignType, true);
        $oTemplates = $oDefaultTemplates;
        $oUserTemplates = $mTemplates->getCommonTemplates($userID, '', '', $campaignType);
        $oDraftTemplates = $mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID);
        $oCategories = $mWorkflow->getWorkflowTemplateCategories($moduleName);

        if(!empty($oCategories)){
            foreach($oCategories as $oCategory){
                $categoryID = $oCategory->id;
                $totalTemplates = $mTemplates->countCategoryTemplates($categoryID);
                $oCategory->totalCount = $totalTemplates;
            }
        }


        $aBreadcrumb = array(
            'Home' => '#/',
            ucfirst($campaignType) => '#/modules/'.$campaignType.'/dashboard',
            ucfirst($campaignType).' Campaigns' => '#/modules/'.$campaignType.'/broadcast',
            'Setup' => '',
        );

        $aData = array(
            'title' => ucfirst($campaignType).' Broadcast',
            'breadcrumb' => $aBreadcrumb,
            'oBroadcast' => $oBroadcast[0],
            'moduleName' => $moduleName,
            'userData' => $aUser,
            'oTemplates' => $oTemplates->items(),
            'myTemplates' => $oUserTemplates,
            'allData' => $oTemplates,
            'draftTemplates' => $oDraftTemplates,
            'oCategories' => $oCategories

        );
        echo json_encode($aData);
        exit;
        //return view('admin.broadcast.setup', $aData)->with(['mBroadcast' => $mBroadcast, 'mTags' => $mTag]);
    }

    public function setupViewSummary(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $id = $request->id;
        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Tags model to get its methods and properties
        $mTag = new TagsModel();

        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $id);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/email");
            exit;
        }

        $moduleName = 'broadcast';
        if ($id > 0) {
            $oEvents = $mWorkflow->getWorkflowEvents($id, $moduleName);
            if (!empty($oEvents)) {
                $eventID = $oEvents[0]->id;
                if ($eventID > 0) {
                    $oCampaign = $mWorkflow->getEventCampaign($eventID, $moduleName);
                }
            }
        }
        $campaignType = $oCampaign[0]->campaign_type;
        $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($id);


        //loaded broadcast properties tags
        $broadcastID = strip_tags($request->broadcastId);
        $oAutomationLists = $mLists->getAutomationLists($id);
        $oCampaignContacts = $mBroadcast->getBroadcastContacts($id);
        $aTags = $mTag->getClientTags($userID);
        $oCampaignTags = $mBroadcast->getBroadcastTags($id);
        $oCampaignLists = $oAutomationLists;
        $oCampaignSegments = $mBroadcast->getBroadcastSegments($id);
        $aDataImportButtons = array(
            'broadcastID' => $id,
            'oCampaignLists' => $oCampaignLists,
            'oCampaignContacts' => $oCampaignContacts,
            'aTags' => $aTags,
            'oCampaignTags' => $oCampaignTags,
            'oCampaignSegments' => $oCampaignSegments
        );
        $sImportButtons = view('admin.broadcast.partials.importButtonTags', $aDataImportButtons)->render();
        $aDataImportButtons['bSummary'] = true;
        $sImportButtonsSummary = view('admin.broadcast.partials.importButtonTags', $aDataImportButtons)->render();



        //loaded broadcast properties tags

        $oCampaignExcludedLists = $mLists->getAutomationExcludedLists($id);
        $oCampaignExcludedContacts = $mBroadcast->getBroadcastExcludedContacts($id);
        $oCampaignExcludedTags = $mBroadcast->getBroadcastExcludedTags($id);
        $oCampaignExcludedSegments = $mBroadcast->getBroadcastExcludedSegments($id);
        $aDataExportButtons = array(
            'broadcastID' => $id,
            'oCampaignLists' => $oCampaignExcludedLists,
            'oCampaignContacts' => $oCampaignExcludedContacts,
            'aTags' => $aTags,
            'oCampaignTags' => $oCampaignExcludedTags,
            'oCampaignSegments' => $oCampaignExcludedSegments
        );
        $sExcludButtons = view('admin.broadcast.partials.excludeButtonTags', $aDataExportButtons)->render();
        $aDataExportButtons['bSummaryExclude'] = true;
        $sExcludButtonsSummary = view('admin.broadcast.partials.excludeButtonTags', $aDataExportButtons)->render();
        $aAudienceCount = $this->importExcludeAudienceCount($id);
        $importedCount = count($aAudienceCount['imported']);
        $exportedCount = count($aAudienceCount['excluded']);


        if(strtolower($campaignType) == 'email'){
            $aBreadcrumb = array(
                'Home' => '#/',
                'Email' => '#/modules/email/dashboard',
                'Email Campaigns' => '#/modules/emails/broadcast',
                'Setup' => '',
            );
        }

        if(strtolower($campaignType) == 'sms'){
            $aBreadcrumb = array(
                'Home' => '#/',
                'Sms' => '#/modules/sms/dashboard',
                'Sms Campaigns' => '#/modules/sms/broadcast',
                'Setup' => '',
            );
        }

        $aData = array(
            'title' => 'Email Broadcast',
            'breadcrumb' => $aBreadcrumb,
            'oBroadcast' => $oBroadcast[0],
            'moduleName' => $moduleName,
            'userData' => $aUser,
            'campaignType' => $campaignType,
            'sImportButtons' => $sImportButtons,
            'sImportButtonsSummary' => $sImportButtonsSummary,
            'sExcludButtons' => $sExcludButtons,
            'sExcludButtonsSummary' => $sExcludButtonsSummary,
            'importedCount' => $importedCount,
            'exportedCount' => $exportedCount,
            'oBroadcastSubscriber' => $oBroadcastSubscriber->items(),
            'allDataSubscribers' => $oBroadcastSubscriber
        );
        echo json_encode($aData);
        exit;
        //return view('admin.broadcast.setup', $aData)->with(['mBroadcast' => $mBroadcast, 'mTags' => $mTag]);
    }


    /**
     * Used to edit email/sms broadcast campaign
     * @param type $id
     */
    public function edit(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $id = $request->id;
        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();

        //Instantiate Tags model to get its methods and properties
        $mTag = new TagsModel();

        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();



        $oLists = $mBroadcast->getMyLists($userID);
        $twillioData = $mBroadcast->getTwillioData($userID);
        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $id);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/email");
            exit;
        }

        $moduleName = 'broadcast';
        if ($id > 0) {
            $oEvents = $mWorkflow->getWorkflowEvents($id, $moduleName);
            if (!empty($oEvents)) {
                $eventID = $oEvents[0]->id;
                if ($eventID > 0) {
                    $oCampaign = $mWorkflow->getEventCampaign($eventID, $moduleName);
                }
            }
        }
        $campaignType = $oCampaign[0]->campaign_type;

        //Check if campaign expired or not
        $aDeliveryParam = json_decode($oBroadcast[0]->data);
        $deliveryDate = $aDeliveryParam->delivery_date;
        $deliveryTime = $aDeliveryParam->delivery_time;
        $timeString = $deliveryDate . ' ' . $deliveryTime;
        $deliverAt = strtotime($timeString);

        $gmt_date = strtotime(gmdate('Y-m-d H:i:s', time()));
        $estTime = date("Y-m-d H:i:s", ($gmt_date - 14400));
        $timeNow = strtotime($estTime);
        $bExpired = false;
        if ($timeNow > $deliverAt && $oBroadcast[0]->bc_status != 'draft') {
            $bExpired = true;

            //$moduleType = strtolower($campaignType)=='email' ? 'email' : 'sms';
            //redirect("admin/broadcast/{$moduleType}");
            //exit;
        }


        $oVariations = $mBroadcast->getBroadcastVariations($id);
        //pre($oVariations);
        $oAutomationLists = $mLists->getAutomationLists($id);
        $oCampaignContacts = $mBroadcast->getBroadcastContacts($id);
        $oCampaignTags = $mBroadcast->getBroadcastTags($id);
        $broadcastSettings = $mBroadcast->getBroadcastSettings($oBroadcast[0]->id);
        $subscribersData = $mSubscriber->getGlobalSubscribers($userID);
        $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($id);
        $aTags = $mTag->getClientTags($userID);
        //pre($broadcastSettings);
        //die;
        $activeTab = Session::get("setTab");
        if (empty($activeTab)) {

            $currentState = $oBroadcast[0]->current_state;

            if (!empty($currentState)) {
                if ($bExpired == true) {
                    $selectedTab = 'Review Contacts';
                    $activeTab = 'Review Contacts';
                } else {
                    $selectedTab = $currentState;
                    $activeTab = $currentState;
                }
            } else {
                if ($bExpired == true) {
                    $selectedTab = 'Review Contacts';
                    $activeTab = 'Review Contacts';
                } else {
                    $selectedTab = 'Select List';
                    $activeTab = 'Select List';
                }
            }

            Session::put("setTab", $selectedTab);
        }

        //$oDefaultTemplates = $mWorkflow->getWorkflowDefaultTemplates($moduleName);
        $oDefaultTemplates = $mTemplates->getCommonTemplates('', '', '', strtolower($oBroadcast[0]->campaign_type));
        $oTemplates = $oDefaultTemplates;
        $oUserTemplates = $mTemplates->getCommonTemplates($userID, '', '', strtolower($oBroadcast[0]->campaign_type));
        //pre($oUserTemplates);
        //die;
        $oDraftTemplates = $mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID);
        $oCategories = $mWorkflow->getWorkflowTemplateCategories($moduleName);

        //Get Campaign list subscribers
        $oTotalSubscribers = $mBroadcast->getBroadcastListSubscribers($id);


        $totalSubscribers = count($oTotalSubscribers);

        //Check for duplicate records
        $aEmails = array();
        $duplicateCount = 0;
        if (!empty($oTotalSubscribers)) {

            foreach ($oTotalSubscribers as $oRec) {
                if (in_array($oRec->subscriber_email, $aEmails)) {
                    $duplicateCount++;
                }
                $aEmails[] = $oRec->subscriber_email;
            }
        }

        //loaded broadcast properties tags
        $broadcastID = strip_tags($request->broadcastId);
        $oCampaignLists = $oAutomationLists;
        $oCampaignSegments = $mBroadcast->getBroadcastSegments($id);
        $aDataImportButtons = array(
            'broadcastID' => $id,
            'oCampaignLists' => $oCampaignLists,
            'oCampaignContacts' => $oCampaignContacts,
            'aTags' => $aTags,
            'oCampaignTags' => $oCampaignTags,
            'oCampaignSegments' => $oCampaignSegments
        );
        $sImportButtons = view('admin.broadcast.partials.importButtonTags', $aDataImportButtons)->render();
        $aDataImportButtons['bSummary'] = true;
        $sImportButtonsSummary = view('admin.broadcast.partials.importButtonTags', $aDataImportButtons)->render();



        //loaded broadcast properties tags

        $oCampaignExcludedLists = $mLists->getAutomationExcludedLists($id);
        $oCampaignExcludedContacts = $mBroadcast->getBroadcastExcludedContacts($id);
        $oCampaignExcludedTags = $mBroadcast->getBroadcastExcludedTags($id);
        $oCampaignExcludedSegments = $mBroadcast->getBroadcastExcludedSegments($id);
        $aDataExportButtons = array(
            'broadcastID' => $id,
            'oCampaignLists' => $oCampaignExcludedLists,
            'oCampaignContacts' => $oCampaignExcludedContacts,
            'aTags' => $aTags,
            'oCampaignTags' => $oCampaignExcludedTags,
            'oCampaignSegments' => $oCampaignExcludedSegments
        );
        $sExcludButtons = view('admin.broadcast.partials.excludeButtonTags', $aDataExportButtons)->render();
        $aDataExportButtons['bSummaryExclude'] = true;
        $sExcludButtonsSummary = view('admin.broadcast.partials.excludeButtonTags', $aDataExportButtons)->render();
        $aAudienceCount = $this->importExcludeAudienceCount($id);
        $importedCount = count($aAudienceCount['imported']);
        $exportedCount = count($aAudienceCount['excluded']);

        if(!empty($campaignType)){
            $breadModuleName = (strtolower($campaignType) =='email' ) ? 'email' : 'sms';
        }else{
            $breadModuleName = '';
        }





        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/'.$breadModuleName) . '" class="sidebar-control hidden-xs">Broadcast </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="' . $oBroadcast[0]->title . '" class="sidebar-control active hidden-xs ">' . $oBroadcast[0]->title . '</a></li>
                    </ul>';

        //pre($oCampaign);


        $aData = array(
            'title' => 'Brand Boost Broadcast',
            'oBroadcast' => $oBroadcast[0],
            'oVariations' => $oVariations,
            'oDefaultTemplates' => $oDefaultTemplates,
            'oDraftTemplates' => $oDraftTemplates,
            'oTemplates' => $oTemplates,
            'oUserTemplates' => $oUserTemplates,
            'selected_template' => $oBroadcast[0]->template_source,
            'oCategories' => $oCategories,
            'oLists' => $oLists,
            'oBroadcastSubscriber' => $oBroadcastSubscriber,
            'subscribersData' => $subscribersData,
            'oCampaignContacts' => $oCampaignContacts,
            'oCampaignTags' => $oCampaignTags,
            'totalSubscribers' => $totalSubscribers,
            'duplicateSubscriber' => $duplicateCount,
            'aTags' => $aTags,
            'oAutomationLists' => $oAutomationLists,
            'activeTab' => $activeTab,
            'broadcast_id' => $id,
            'broadcastID' => $id,
            'sImportButtons' => $sImportButtons,
            'sImportButtonsSummary' => $sImportButtonsSummary,
            'sExcludButtons' => $sExcludButtons,
            'sExcludButtonsSummary' => $sExcludButtonsSummary,
            'importedCount' => $importedCount,
            'exportedCount' => $exportedCount,
            'moduleName' => 'broadcast',
            'moduleUnitID' => $broadcastID,
            'broadcastSettings' => ($broadcastSettings->isNotEmpty()) ? $broadcastSettings[0] : array(),
            'userData' => $aUser,
            'twillioData' => $twillioData[0],
            'pagename' => $breadcrumb,
            'oCampaign' => $oCampaign,
            'campaignType' => $campaignType,
            'bExpired' => $bExpired,
            'oUser' => $aUser
        );

        return view('admin.broadcast.setup', $aData)->with(['mBroadcast' => $mBroadcast, 'mTags' => $mTag]);
    }

    /**
     * Used to add Variations in broadcast campaign
     */
    public function addVariation(Request $request) {
        $response = array();
        $aUser = getLoggedUser();

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Subscriber model to get its methods and properties
        $mTemplates = new TemplatesModel();


        $userID = $aUser->id;

        $moduleName = 'broadcast';

        if (!empty($request)) {
            $broadcastID = strip_tags($request->broadcast_id);
            $campaignType = strip_tags($request->campaign_type);
            //Get main campaign info
            $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
            if (!empty($oBroadcast)) {
                $fromName = $oBroadcast[0]->from_name;
                $fromEmail = $oBroadcast[0]->from_email;
                $replyEmail = $oBroadcast[0]->reply_to;
            }
            $oVariations = $mBroadcast->getBroadcastVariations($broadcastID);
            $oVariation = $oVariations[0];
            if (!empty($oVariation)) {
                $aSplitData = array(
                    'split_test_id' => $oVariation->split_test_id,
                    'broadcast_id' => $oVariation->broadcast_id,
                    'event_id' => $oVariation->event_id,
                    'campaign_type' => $campaignType,
                    'from_name' => $fromName,
                    'from_email' => $fromEmail,
                    'reply_to' => $replyEmail,
                    'status' => 'active',
                    'created' => date("Y-m-d H:i:s")
                );
                $iVariationID = $mBroadcast->addBroadcastVariation($aSplitData);
            }

            //Sync Import/Exclude Properties

            if ($broadcastID > 0) {
                $oDraftTemplates = $mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID);
                $oUserTemplates = $mTemplates->getCommonTemplates($userID, '', '', strtolower($campaignType));
                $aData = array(
                    'oUserTemplates' => $oUserTemplates,
                    'variationID' => $iVariationID,
                    'campaignType' => $campaignType
                );
                $content = view('admin.broadcast.partials.add_split_form_single', $aData)->render();
            }
        }
        if (!empty($content)) {
            $response = array('status' => 'success', 'content' => $content);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update Split Test campaign
     */
    public function updateSplitTest(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        if (!empty($request)) {
            $fieldValue = strip_tags($request->fieldVal);
            $splitTestID = strip_tags($request->testid);


            if ($splitTestID > 0) {
                $aData = array(
                    'test_name' => $fieldValue
                );
                $bUpdated = $mBroadcast->updateSplitTest($aData, $splitTestID);
            }
        }
        if (!empty($bUpdated)) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update various properties of broadcast campaigns
     */
    public function updateBroadcastSettingUnit(Request $request) {

        $response = array();
        $aUser = getLoggedUser();

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        $userID = $aUser->id;

		$fieldName = $request->fieldName;
		$fieldValue = $request->fieldVal;
		$eventId = $request->event_id;
		$campaignId = $request->campaign_id;
		$broadcastID = $request->broadcast_id;
		$aBroadcastData = array();
		$aBroadcastCampaignData = array();
		$aBroadcastSettingsData = array();

		if ($broadcastID > 0) {
			if (in_array($fieldName, array('title', 'sending_method'))) {
				$aBroadcastData[$fieldName] = $fieldValue;
			}

			if (!empty($aBroadcastData)) {
				$bUpdated = $mBroadcast->updateBroadcast($aBroadcastData, $broadcastID);
			}
		}

		if ($eventId > 0) {
			if (in_array($fieldName, array('subject', 'from_name', 'from_email', 'reply_to', 'from_number'))) {
				$aBroadcastCampaignData[$fieldName] = $fieldValue;
			}

			if (!empty($aBroadcastCampaignData)) {
				$bUpdated = $mBroadcast->updateBroadcastCampaign($aBroadcastCampaignData, $eventId);
				$moduleName = 'broadcast';
				if ($fieldName == 'subject') {


					$oVariations = $mWorkflow->getWorkflowSplitVariations($moduleName, $broadcastID);
					if (!empty($oVariations)) {
						$campaignID = $oVariations[0]->id;
					}
					$aData = array(
						'subject' => $fieldValue
					);
					$mWorkflow->updateWorkflowSplitCampaign($aData, $campaignID, $moduleName);
				} else {
					$aData = array(
						$fieldName => $fieldValue
					);
					$mWorkflow->updateWorkflowSplitCampaign($aData, '', $moduleName, $broadcastID);
				}
			}
		}

		if ($campaignId > 0) {

			if (in_array($fieldName, array('text_version_email', 'enable_mobile_responsiveness', 'read_tracking', 'link_tracking', 'reply_tracking', 'google_analytics', 'campaign_archives'))) {
				$aBroadcastSettingsData[$fieldName] = $fieldValue;
			}

			if (!empty($aBroadcastSettingsData)) {
				$broadcastSettings = $mBroadcast->getBroadcastSettings($campaignId);
				if ($broadcastSettings->isNotEmpty()) {
					$bUpdated = $mBroadcast->updateBroadcastSettings($aBroadcastSettingsData, $campaignId);
				} else {
					$aBroadcastSettingsData['campaign_id'] = $campaignId;
					$bUpdated = $mBroadcast->addBroadcastSettings($aBroadcastSettingsData);
				}
			}
		}

        if (!empty($bUpdated)) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update variations of broadcast campaigns
     */
    public function updateVariation(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Subscriber model to get its methods and properties
        $mTemplates = new TemplatesModel();

        if (!empty($request)) {
            $fieldName = strip_tags($request->fieldName);
            $fieldValue = strip_tags($request->fieldVal);
            $variationID = strip_tags($request->variationID);


            if ($variationID > 0) {
                $aData = array();
                if ($fieldName == 'variation_name') {
                    $aData['variation_name'] = $fieldValue;
                } else if ($fieldName == 'variation_template') {
                    $templateID = $fieldValue;
                    //echo "Template ID is ". $templateID;
                    $oTemplate = $mTemplates->getCommonTemplateInfo($templateID);
                    //pre($oDraft);
                    //die;
                    $aData['template_source'] = $fieldValue;
                    if (!empty($oTemplate)) {
                        $aData['subject'] = $oTemplate->template_subject;
                        $aData['stripo_compiled_html'] = $oTemplate->stripo_compiled_html;
                        $aData['stripo_html'] = $oTemplate->stripo_html;
                        $aData['stripo_css'] = $oTemplate->stripo_css;
                        $aData['html'] = (isset($oTemplate->html)) ? $oTemplate->html : '';
                    }
                } else if ($fieldName == 'variation_load') {
                    $aData['split_load'] = $fieldValue;
                }

                if (!empty($aData)) {
                    $bUpdated = $mBroadcast->updateVariation($aData, $variationID);
                }
            }
        }
        if (!empty($bUpdated)) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete broadcast variations
     */
    public function deleteVariation(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        if (!empty($request)) {
            $variationID = strip_tags($request->variationID);
            if ($variationID > 0) {
                $bDeleted = $mBroadcast->deleteVariation($variationID);
            }
        }
        if (!empty($bDeleted)) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to get all broadcast campaign users
     */
    public function getBroadcastAudience(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Tag model to get its methods and properties
        $mTag = new TagsModel();


        if (!empty($request)) {
            $broadcastID = strip_tags($request->broadcastId);
            //Sync Import/Exclude Properties

            if ($broadcastID > 0) {
                $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
                $this->syncBroadcastAudience($broadcastID);
                $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($broadcastID);
                $aData = array('oBroadcastSubscriber' => $oBroadcastSubscriber, 'oBroadcast' => $oBroadcast[0]);

                $content = view('admin.broadcast.partials.broadcast_audience', $aData)->with(['mTags' => $mTag])->render();
            }
        }
        if (!empty($content)) {
            $response = array('status' => 'success', 'content' => $content, 'total_audience' => count($oBroadcastSubscriber));
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to get categorized template
     */
    public function getCategorizedTemplates(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $actionName = strip_tags($request->action);
        $categoryID = strip_tags($request->categoryid);
        $selected_template = strip_tags($request->selected_template);
        $campaignType = strip_tags($request->campaign_type);

        if (empty($campaignType)) {
            $campaignType = 'email';
        }

        $moduleName = 'broadcast';
        $source = '';

        if ($actionName == 'category') {
            $oCategorizedTemplates = $mWorkflow->getWorkflowDefaultTemplates($moduleName, $campaignType, '', $categoryID);
        } else if ($actionName == 'draft') {
            $oCategorizedTemplates = $mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID, $campaignType);
            $source = 'draft';
        } else if ($actionName == 'all') {
            $oCategorizedTemplates = $mWorkflow->getWorkflowDefaultTemplates($moduleName, $campaignType);
        }

        $templateList = view('admin.broadcast.partials.categorized_template_list', array('oCategorizedTemplates' => $oCategorizedTemplates, 'selected_template' => $selected_template, 'source' => $source, 'campaignType' => $campaignType))->render();

        if (!empty($templateList)) {
            $response = array('status' => 'success', 'content' => $templateList);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete users from broadcast campaign
     */
    public function deleteBroadcastAudience(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        $response = array();

        $subscriberID = $request->subscriber_id;
        $broadcastId = $request->broadcast_id;

        $bDeleted = $mBroadcast->deleteAudienceToBraodcast($broadcastId, $subscriberID);

        if ($bDeleted) {
            $mBroadcast->deleteBraodcastContacts($broadcastId, $subscriberID);
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete users in bulk from broadcast campaign
     */
    public function deleteBroadcastBulkAudience(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();


        $audienceArray = $request->audience_array;
        $broadcastId = strip_tags($request->broadcast_id);

        $aSubscribers = array_unique($audienceArray);

        if (!empty($aSubscribers)) {
            foreach ($aSubscribers as $subscriberID) {
                $bDeleted = $mBroadcast->deleteAudienceToBraodcast($broadcastId, $subscriberID);
                if ($bDeleted) {
                    $mBroadcast->deleteBraodcastContacts($broadcastId, $subscriberID);
                }
            }
        }

        if ($bDeleted) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Automation stats
     * @param type $id
     */
    public function automationStats($id = '') {
        if (empty($id)) {
            redirect("admin/modules/emails");
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $type = $_GET['type'];

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        //get Automation Info
        $oAutomations = $mEmails->getEmailAutomations($userID, $id);


        //get Lists
        $oLists = $mLists->getLists($userID);

        //get Automation Events
        $oEvents = $mEmails->getAutomationEvents($id);

        //get Automation Lists
        $oAutomationLists = $mLists->getAutomationLists($id);

        //get Default Email Templates
        $oDefaultTemplates = $mEmails->getEmailMoudleTemplates(0, 'email'); //empty or 0 for default templates
        //get Default Other Email Templates
        $oUsedOtherTemplates = $mEmails->getEmailMoudleTemplates($userID, 'email'); // for own other templates
        //get Default Sms Templates
        $oDefaultSMSTemplates = $mEmails->getEmailMoudleTemplates(0, 'sms'); //empty or 0 for default templates
        //get Default Other Sms Templates
        $oUsedOtherSMSTemplates = $mEmails->getEmailMoudleTemplates($userID, 'sms'); // for own other templates


        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">';
        $breadcrumb = '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>';
        if (!empty($type)) {
            $breadcrumb = '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
            $breadcrumb = '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/broadcast') . '">Email Broadcast </a></li>';
        } else {
            $breadcrumb = '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
            $breadcrumb = '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/emails/') . '">Email Automations</a></li>';
        }

        $breadcrumb = '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
        $breadcrumb = '<li><a class="sidebar-control hidden-xs">Stats</a></li>';
        $breadcrumb = '</ul>';


        $pageData = array(
            'title' => 'Setup Email Automation',
            'pagename' => $breadcrumb,
            'bActiveSubsription' => $bActiveSubsription,
            'oAutomations' => $oAutomations,
            'oLists' => $oLists,
            'oAutomationLists' => $oAutomationLists,
            'oEvents' => $oEvents,
            'oDefaultTemplates' => $oDefaultTemplates,
            'oUsedOtherTemplates' => $oUsedOtherTemplates,
            'oDefaultSMSTemplates' => $oDefaultSMSTemplates,
            'oUsedOtherSMSTemplates' => $oUsedOtherSMSTemplates,
            'oUser' => $oUser,
            'type' => $type
        );

        return view('admin.modules.emails.email-stats', $pageData);
    }

    /**
     * Used to make a broadcast campaign archive
     */
    public function moveArchive(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $response = array();

        $broadcastId = $request->automation_id;

        $cData = array(
            'status' => 'archive'
        );

        $mBroadcast->updateBroadcast($cData, $broadcastId);

        if ($broadcastId) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to make a broadcast campaign archive  in bulk
     */
    public function multipalArchiveAutomation(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $response = array();

        $broadcastIds = $request->multipal_automation_id;

        $cData = array(
            'status' => 'archive'
        );

        foreach ($broadcastIds as $broadcastId) {
            $mBroadcast->updateBroadcast($cData, $broadcastId);
        }

        if ($broadcastIds) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add user from contact list into the broadcast
     */
    public function addContactToCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();

        //Instantiate Tag model to get its methods and properties
        $mTag = new TagsModel();

        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        $contactId = strip_tags($request->contactId);
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'automation_id' => $automationID,
                'subscriber_id' => $contactId,
                'created' => date("Y-m-d H:i:s")
            );
            $mBroadcast->addContactToCampaign($aData);

            /* $aBroadcastData = array(
              'user_id' => $userID,
              'broadcast_id' => $automationID,
              'subscriber_id' => $contactId,
              'created' => date("Y-m-d H:i:s")
              );
              $this->addAudienceToBraodcast($aBroadcastData); */
        } else {
            $mBroadcast->deleteContactToCampaign($automationID, $contactId);
            $mBroadcast->deleteAudienceToBraodcast($automationID, $contactId);
        }

        $oCampaignContacts = $mBroadcast->getBroadcastContacts($automationID);
        $totalContacts = count($oCampaignContacts);
        $response = array('status' => 'success', 'msg' => "Success", 'total_contacts' => $totalContacts);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add Audience to broadcast campaign
     * @param type $aData
     */
    public function addAudienceToBraodcast($aData) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $broadcastID = $aData['broadcast_id'];
        $subscriberID = $aData['subscriber_id'];
        //Do some necessary check if any
        //Check-1 -Duplicate Entry
        $bDuplicate = $mBroadcast->isDuplicateBroadcastAudience($broadcastID, $subscriberID);
        if ($bDuplicate == false) {
            $mBroadcast->addBroadcastAudience($aData);
        }
    }

    /**
     * Used to get users count of imported and excluded users of a broadcast campaign
     * @param type $broadcastID
     * @return type
     */
    public function importExcludeAudienceCount($broadcastID) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate List model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();

        //Instantiate Subscriber model to get its methods and properties
        $mTemplates = new TemplatesModel();

        //Imported Properites
        //Lists



        $aBroadcastSubscribers = array();
        $oAutomationLists = $mLists->getAutomationLists($broadcastID);
        if (!empty($oAutomationLists)) {

            foreach ($oAutomationLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $mLists->getListContacts($userID, $iListID);
                    if (!empty($oListSubscribers)) {
                        foreach ($oListSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->subscriber_id, $aBroadcastSubscribers)) {
                                $aBroadcastSubscribers[] = $oSubscriber->subscriber_id;
                            }
                        }
                    }
                }
            }
        }

        //Imported Contacts
        $oCampaignContacts = $mBroadcast->getBroadcastContacts($broadcastID);
        if (!empty($oCampaignContacts)) {
            foreach ($oCampaignContacts as $oRec) {
                if (!in_array($oRec->subscriber_id, $aBroadcastSubscribers)) {
                    $aBroadcastSubscribers[] = $oRec->subscriber_id;
                }
            }
        }

        //Imported Tags
        $oCampaignTags = $mBroadcast->getBroadcastTags($broadcastID);
        if (!empty($oCampaignTags)) {
            foreach ($oCampaignTags as $oRec) {
                $tagId = $oRec->tag_id;
                $oTagSubscribers = $mSubscriber->getTagSubscribers($tagId);
                if (!empty($oTagSubscribers)) {
                    foreach ($oTagSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->id, $aBroadcastSubscribers)) {
                            $aBroadcastSubscribers[] = $oSubscriber->id;
                        }
                    }
                }
            }
        }

        //Imported Segments
        $oCampaignSegments = $mBroadcast->getBroadcastSegments($broadcastID);
        if (!empty($oCampaignSegments)) {
            foreach ($oCampaignSegments as $oRec) {
                $segmentId = $oRec->segment_id;
                $oSubscribers = $mBroadcast->getSegmentSubscribers($segmentId, $userID);
                if (!empty($oSubscribers)) {
                    foreach ($oSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->subscriber_id, $aBroadcastSubscribers)) {
                            $aBroadcastSubscribers[] = $oSubscriber->subscriber_id;
                        }
                    }
                }
            }
        }

        $importedAudience = array_unique($aBroadcastSubscribers);

        //Excluded Properites


        $aBroadcastExcludedSubscribers = array();
        //Excluded Lists
        $oCampaignExcludedLists = $mLists->getAutomationExcludedLists($broadcastID);
        if (!empty($oCampaignExcludedLists)) {
            $aListIDs = array();
            foreach ($oCampaignExcludedLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $mLists->getListContacts($userID, $iListID);
                    if (!empty($oListSubscribers)) {
                        foreach ($oListSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->subscriber_id, $aBroadcastExcludedSubscribers)) {
                                $aBroadcastExcludedSubscribers[] = $oSubscriber->subscriber_id;
                            }
                        }
                    }
                }
            }
        }

        //Excluded Contacts
        $oCampaignExcludedContacts = $mBroadcast->getBroadcastExcludedContacts($broadcastID);
        if (!empty($oCampaignExcludedContacts)) {
            foreach ($oCampaignExcludedContacts as $oRec) {
                if (!in_array($oRec->subscriber_id, $aBroadcastExcludedSubscribers)) {
                    $aBroadcastExcludedSubscribers[] = $oRec->subscriber_id;
                }
            }
        }



        //Excluded Tags
        $oCampaignExcludedTags = $mBroadcast->getBroadcastExcludedTags($broadcastID);
        if (!empty($oCampaignExcludedTags)) {
            foreach ($oCampaignExcludedTags as $oRec) {
                $tagId = $oRec->tag_id;
                $oTagSubscribers = $mSubscriber->getTagSubscribers($tagId);
                if (!empty($oTagSubscribers)) {
                    foreach ($oTagSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->id, $aBroadcastExcludedSubscribers)) {
                            $aBroadcastExcludedSubscribers[] = $oSubscriber->id;
                        }
                    }
                }
            }
        }

        //Excluded Segments
        $oCampaignExcludedSegments = $mBroadcast->getBroadcastExcludedSegments($broadcastID);
        if (!empty($oCampaignExcludedSegments)) {
            foreach ($oCampaignExcludedSegments as $oRec) {
                $segmentId = $oRec->segment_id;
                $oSubscribers = $mBroadcast->getSegmentSubscribers($segmentId, $userID);
                if (!empty($oSubscribers)) {
                    foreach ($oSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->subscriber_id, $aBroadcastExcludedSubscribers)) {
                            $aBroadcastExcludedSubscribers[] = $oSubscriber->subscriber_id;
                        }
                    }
                }
            }
        }

        $excludedAudience = array_unique($aBroadcastExcludedSubscribers);

        $aData = array(
            'imported' => $importedAudience,
            'excluded' => $excludedAudience
        );

        return $aData;
    }

    /**
     * Used to sync users of a broadcast campaign when making change in various broadcast users selection properties
     * @param type $broadcastID
     * @return boolean
     */
    public function syncBroadcastAudience($broadcastID) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();

        //Imported Properites
        //Lists
        $aBroadcastSubscribers = array();
        $oAutomationLists = $mLists->getAutomationLists($broadcastID);
        if (!empty($oAutomationLists)) {

            foreach ($oAutomationLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $mLists->getListContacts($userID, $iListID);
                    if (!empty($oListSubscribers)) {
                        foreach ($oListSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->subscriber_id, $aBroadcastSubscribers)) {
                                $aBroadcastSubscribers[] = $oSubscriber->subscriber_id;
                            }
                        }
                    }
                }
            }
        }

        //Imported Contacts
        $oCampaignContacts = $mBroadcast->getBroadcastContacts($broadcastID);
        if (!empty($oCampaignContacts)) {
            foreach ($oCampaignContacts as $oRec) {
                if (!in_array($oRec->subscriber_id, $aBroadcastSubscribers)) {
                    $aBroadcastSubscribers[] = $oRec->subscriber_id;
                }
            }
        }

        //Imported Tags
        $oCampaignTags = $mBroadcast->getBroadcastTags($broadcastID);
        if (!empty($oCampaignTags)) {
            foreach ($oCampaignTags as $oRec) {
                $tagId = $oRec->tag_id;
                $oTagSubscribers = $mSubscriber->getTagSubscribers($tagId);
                if (!empty($oTagSubscribers)) {
                    foreach ($oTagSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->id, $aBroadcastSubscribers)) {
                            $aBroadcastSubscribers[] = $oSubscriber->id;
                        }
                    }
                }
            }
        }

        //Imported Segments
        $oCampaignSegments = $mBroadcast->getBroadcastSegments($broadcastID);
        if (!empty($oCampaignSegments)) {
            foreach ($oCampaignSegments as $oRec) {
                $segmentId = $oRec->segment_id;
                $oSubscribers = $mBroadcast->getSegmentSubscribers($segmentId, $userID);
                if (!empty($oSubscribers)) {
                    foreach ($oSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->subscriber_id, $aBroadcastSubscribers)) {
                            $aBroadcastSubscribers[] = $oSubscriber->subscriber_id;
                        }
                    }
                }
            }
        }

        //Excluded Properites


        $aBroadcastExcludedSubscribers = array();
        //Excluded Lists
        $oCampaignExcludedLists = $mLists->getAutomationExcludedLists($broadcastID);
        if (!empty($oCampaignExcludedLists)) {
            $aListIDs = array();
            foreach ($oCampaignExcludedLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $mLists->getListContacts($userID, $iListID);
                    if (!empty($oListSubscribers)) {
                        foreach ($oListSubscribers as $oSubscriber) {
                            if (!in_array($oSubscriber->subscriber_id, $aBroadcastExcludedSubscribers)) {
                                $aBroadcastExcludedSubscribers[] = $oSubscriber->subscriber_id;
                            }
                        }
                    }
                }
            }
        }

        //Excluded Contacts
        $oCampaignExcludedContacts = $mBroadcast->getBroadcastExcludedContacts($broadcastID);
        if (!empty($oCampaignExcludedContacts)) {
            foreach ($oCampaignExcludedContacts as $oRec) {
                if (!in_array($oRec->subscriber_id, $aBroadcastExcludedSubscribers)) {
                    $aBroadcastExcludedSubscribers[] = $oRec->subscriber_id;
                }
            }
        }



        //Excluded Tags
        $oCampaignExcludedTags = $mBroadcast->getBroadcastExcludedTags($broadcastID);
        if (!empty($oCampaignExcludedTags)) {
            foreach ($oCampaignExcludedTags as $oRec) {
                $tagId = $oRec->tag_id;
                $oTagSubscribers = $mSubscriber->getTagSubscribers($tagId);
                if (!empty($oTagSubscribers)) {
                    foreach ($oTagSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->id, $aBroadcastExcludedSubscribers)) {
                            $aBroadcastExcludedSubscribers[] = $oSubscriber->id;
                        }
                    }
                }
            }
        }

        //Excluded Segments
        $oCampaignExcludedSegments = $mBroadcast->getBroadcastExcludedSegments($broadcastID);
        if (!empty($oCampaignExcludedSegments)) {
            foreach ($oCampaignExcludedSegments as $oRec) {
                $segmentId = $oRec->segment_id;
                $oSubscribers = $mBroadcast->getSegmentSubscribers($segmentId, $userID);
                if (!empty($oSubscribers)) {
                    foreach ($oSubscribers as $oSubscriber) {
                        if (!in_array($oSubscriber->subscriber_id, $aBroadcastExcludedSubscribers)) {
                            $aBroadcastExcludedSubscribers[] = $oSubscriber->subscriber_id;
                        }
                    }
                }
            }
        }


        //Step-1: Delete all broadcast subscribers from excluded  subscriber
        //Step-2: Add broadcast Subscribers only those which are not in excluded subscribers
        //Step-1 Excecution

        if (!empty($aBroadcastExcludedSubscribers)) {
            foreach ($aBroadcastExcludedSubscribers as $subscriberID) {
                $mBroadcast->deleteAudienceToBraodcast($broadcastID, $subscriberID);
            }
        }

        //Step-2 Execution
        if (!empty($aBroadcastSubscribers)) {
            foreach ($aBroadcastSubscribers as $subscriberID) {
                if (!in_array($subscriberID, $aBroadcastExcludedSubscribers)) {
                    $aBroadcastData = array(
                        'user_id' => $userID,
                        'broadcast_id' => $broadcastID,
                        'subscriber_id' => $subscriberID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $this->addAudienceToBraodcast($aBroadcastData);
                }
            }
        }

        //Step-3 Extra Cleanup


        return true;
    }

    /**
     * Used to add users into the exclude list of broadcast campaign
     */
    public function addContactToExcludeCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $contactId = strip_tags($request->contactId);
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'automation_id' => $automationID,
                'subscriber_id' => $contactId,
                'created' => date("Y-m-d H:i:s")
            );
            $mBroadcast->addContactToExcludeCampaign($aData);
            //$mBroadcast->deleteAudienceToBraodcast($automationID, $contactId);
        } else {
            $mBroadcast->deleteContactToExcludeCampaign($automationID, $contactId);
            //$this->syncBroadcastAudience($automationID);
        }

        $oCampaignContacts = $mBroadcast->getBroadcastExcludedContacts($automationID);
        $totalContacts = count($oCampaignContacts);
        $response = array('status' => 'success', 'msg' => "Success", 'total_contacts' => $totalContacts);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add tags into the import list of broadcast campaign
     */
    public function addTagToCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();


        $tagId = strip_tags($request->tagId);
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'automation_id' => $automationID,
                'tag_id' => $tagId,
                'created' => date("Y-m-d H:i:s")
            );
            $mBroadcast->addTagToCampaign($aData);
        } else {
            $mBroadcast->deleteTagToCampaign($automationID, $tagId);
            $oTagSubscribers = $mSubscriber->getTagSubscribers($tagId);
            if (!empty($oTagSubscribers)) {
                foreach ($oTagSubscribers as $oSubscriber) {
                    $subscriberID = $oSubscriber->id;
                    $mBroadcast->deleteAudienceToBraodcast($automationID, $subscriberID);
                }
            }
        }
        $oCampaignTags = $mBroadcast->getBroadcastTags($automationID);
        $totalTags = count($oCampaignTags);
        $response = array('status' => 'success', 'msg' => "Success", 'total_tags' => $totalTags);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add users into the exclude tag list of broadcast campaign
     */
    public function addExcludedTagToCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $tagId = strip_tags($request->tagId);
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'automation_id' => $automationID,
                'tag_id' => $tagId,
                'created' => date("Y-m-d H:i:s")
            );
            $mBroadcast->addExcludedTagToCampaign($aData);
        } else {
            $mBroadcast->deleteExcludedTagToCampaign($automationID, $tagId);
        }
        $oCampaignTags = $mBroadcast->getBroadcastExcludedTags($automationID);
        $totalTags = count($oCampaignTags);
        $response = array('status' => 'success', 'msg' => "Success", 'total_tags' => $totalTags);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add users into the imported segment list of broadcast campaign
     */
    public function addSegmentToCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $segmentId = strip_tags($request->segmentId);
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'automation_id' => $automationID,
                'segment_id' => $segmentId,
                'created' => date("Y-m-d H:i:s")
            );
            $mBroadcast->addSegmentToCampaign($aData);
            /* $oSubscribers = $mBroadcast->getSegmentSubscribers($segmentId, $userID);
              if (!empty($oSubscribers)) {
              foreach ($oSubscribers as $oSubscriber) {
              $subscriberID = $oSubscriber->subscriber_id;
              $aBroadcastData = array(
              'user_id' => $userID,
              'broadcast_id' => $automationID,
              'subscriber_id' => $subscriberID,
              'created' => date("Y-m-d H:i:s")
              );
              $this->addAudienceToBraodcast($aBroadcastData);
              }
              } */
        } else {
            $mBroadcast->deleteSegmentToCampaign($automationID, $segmentId);
            $oSubscribers = $mBroadcast->getSegmentSubscribers($segmentId, $userID);
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $subscriberID = $oSubscriber->subscriber_id;
                    $mBroadcast->deleteAudienceToBraodcast($automationID, $subscriberID);
                }
            }
        }
        $oCampaignSegments = $mBroadcast->getBroadcastSegments($automationID);
        $totalSegments = count($oCampaignSegments);
        $response = array('status' => 'success', 'msg' => "Success", 'total_segments' => $totalSegments);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add users into the exclude segment list of broadcast campaign
     */
    public function addExcludeSegmentToCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $segmentId = strip_tags($request->segmentId);
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'automation_id' => $automationID,
                'segment_id' => $segmentId,
                'created' => date("Y-m-d H:i:s")
            );
            $mBroadcast->addExcludedSegmentToCampaign($aData);
        } else {
            $mBroadcast->deleteExcludedSegmentToCampaign($automationID, $segmentId);
        }
        $oCampaignSegments = $mBroadcast->getBroadcastExcludedSegments($automationID);
        $totalSegments = count($oCampaignSegments);
        $response = array('status' => 'success', 'msg' => "Success", 'total_segments' => $totalSegments);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update automation lists records- Deprecated
     */
    public function updateAutomationListsRecord(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Email model to get its methods and properties
        $mEmails = new EmailsModel();


        $aSelectedLists = $request->selectedLists;
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $mEmails->updateAutomationList($automationID, $aSelectedLists);
        } else {
            $mEmails->deleteAutomationLists($automationID, $aSelectedLists);
            $oListSubscribers = $mLists->getListContacts($userID, $aSelectedLists);
            if (!empty($oListSubscribers)) {
                foreach ($oListSubscribers as $oSubscriber) {
                    $subscriberID = $oSubscriber->subscriber_id;
                    $mBroadcast->deleteAudienceToBraodcast($automationID, $subscriberID);
                }
            }
        }

        //Get Campaign list subscribers
        $oTotalSubscribers = $mBroadcast->getBroadcastListSubscribers($automationID);


        $totalSubscribers = count($oTotalSubscribers);

        //Check for duplicate records
        $aEmails = array();
        $duplicateCount = 0;
        if (!empty($oTotalSubscribers)) {

            foreach ($oTotalSubscribers as $oRec) {
                if (in_array($oRec->subscriber_email, $aEmails)) {
                    $duplicateCount++;
                }
                $aEmails[] = $oRec->subscriber_email;
            }
        }

        //Get selected lists

        $oLists = $mBroadcast->getAutomationLists($automationID);


        $response = array('status' => 'success', 'msg' => "List Added successfully!", 'total_lists' => count($oLists), 'total_contacts' => $totalSubscribers, 'duplicate_contacts' => $duplicateCount);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update automation excluded lists
     */
    public function updateAutomationListsExcludedRecord(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Email model to get its methods and properties
        $mEmails = new EmailsModel();

        $aSelectedLists = $request->selectedLists;
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $mEmails->updateAutomationExcludedList($automationID, $aSelectedLists);
        } else {
            $mEmails->deleteAutomationExcludedLists($automationID, $aSelectedLists);
            //$this->syncBroadcastAudience($automationID);
        }

        //Get Campaign list subscribers
        $oTotalSubscribers = $mBroadcast->getBroadcastExcludedListSubscribers($automationID);


        $totalSubscribers = count($oTotalSubscribers);

        //Check for duplicate records
        $aEmails = array();
        $duplicateCount = 0;
        if (!empty($oTotalSubscribers)) {
            foreach ($oTotalSubscribers as $oRec) {
                if (in_array($oRec->subscriber_email, $aEmails)) {
                    $duplicateCount++;
                }
                $aEmails[] = $oRec->subscriber_email;
            }
        }

        //Get selected lists

        $oLists = $mBroadcast->getAutomationExcludedLists($automationID);


        $response = array('status' => 'success', 'msg' => "List Added successfully!", 'total_lists' => count($oLists), 'total_contacts' => $totalSubscribers, 'duplicate_contacts' => $duplicateCount);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to updates broadcast templates used in the broadcast campaign
     */
    public function updateBroadcastTempalte(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();


        $emailContent = $request->emailtemplate;
        $campaignId = strip_tags($request->campaignId);
        Session::put("setTab", trim($request->tab));

        $cData = array(
            'html' => base64_encode($emailContent)
        );

        $mBroadcast->updateBroadcastCampaignTemplate($cData, $campaignId);

        if ($campaignId) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update end campaign stripo
     */
    public function updateStripoCampaign(Request $request) {
        $response = array();

        Session::put("setTab", trim($request->tab));
        $response = array('status' => 'success');
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update broadcast campaign from field-Deprecated
     */
    public function updateBroadcastFromEmail(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $response = array();


        $editFromEmail = strip_tags($request->edit_from_email);
        $eventId = strip_tags($request->broadcast_event_id);

        $cData = array(
            'from_email' => $editFromEmail
        );

        $mBroadcast->updateBroadcastCampaign($cData, $eventId);

        if ($eventId) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update in the clonned broadcast campaign
     */
    public function updateBroadcastClone(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'campaign_name' => ['required'],
            'description' => ['required'],
            'broadcast_type' => ['required']
        ]);

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $response = array();

        $automation_id = $request->automation_id;
        $broadcastId = $request->edit_broadcastId;
        $broadcastId = (!empty($automation_id) ? $automation_id : $broadcastId);

        $campaignName = $request->campaign_name;
        $description = $request->description;
        $cData = array(
            'title' => $campaignName,
            'description' => $description
        );
        $result = $mBroadcast->updateBroadcast($cData, $broadcastId);

        if ($result) {
            $response = array('status' => 'success', 'msg' => 'Edit broadcast successfully.');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update email/sms broadcast campaign
     */
    public function updateBroadcast(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        $status = strip_tags($request->status);
        $currentState = strip_tags($request->current_state);

        $status = (!empty($status)) ? $status : 'active';

        $broadcastId = $request->broadcastId;
        $cData = array(
            // 'status' => 'active'
            'status' => $status
        );
        if (!empty($currentState)) {
            $cData['current_state'] = $currentState;
        }
        $result = $mBroadcast->updateBroadcast($cData, $broadcastId);

        if ($result) {
            $response = array('status' => 'success', 'msg' => 'Edit broadcast successfully.');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update broadcast campaign data from various part of the broadcast campaign
     */
    public function updateBroadcastData(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        $broadcastId = strip_tags($request->broadcast_id);
        $audienceType = strip_tags($request->audience_type);
        $aData = array();
        if ($broadcastId > 0) {
            if (!empty($audienceType)) {
                $aData['audience_type'] = $audienceType;
            }

            if (!empty($aData)) {
                $result = $mBroadcast->updateBroadcast($aData, $broadcastId);
            }
        }

        if ($result) {
            $response = array('status' => 'success', 'msg' => 'Updated successfully!');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update schedule date of email/sms broadcast campaign
     */
    public function updateAutomationScheduleDate(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();


        $automationId = $request->automation_id;

        $deliveryDate = $request->delivery_date;
        $deliveryTime = $request->delivery_time;
        $triggerTime = array(
            'delivery_date' => $deliveryDate,
            'delivery_time' => $deliveryTime
        );

        $cData = array(
            'data' => json_encode($triggerTime)
        );

        $result = $mBroadcast->updateAutomationScheduleDate($cData, $automationId);

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update subject line of a email broadcast campaign
     */
    public function updateBroadcastSubject(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();


        $editFromSubject = strip_tags($request->edit_email_subject);
        $eventId = strip_tags($request->broadcast_event_id);

        $cData = array(
            'subject' => $editFromSubject
        );

        $mBroadcast->updateBroadcastCampaign($cData, $eventId);

        if ($eventId) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update Broadcast Settings
     */
    public function updateBroadcastSettings(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        $eventId = strip_tags($request->event_id);
        $campaignId = strip_tags($request->campaign_id);
        $broadcastID = strip_tags($request->broadcast_id);
        Session::put("setTab", trim($request->tab));

        $deliveryDate = $request->delivery_date;
        $deliveryTime = $request->delivery_time;

        $triggerTime = array(
            'delivery_date' => $deliveryDate,
            'delivery_time' => $deliveryTime
        );

        $cData = array(
            'data' => json_encode($triggerTime)
        );

        $result = $mBroadcast->updateAutomationScheduleDate($cData, $broadcastID);

        if ($eventId) {
            $response = array('status' => 'success', 'msg' => "Broadcast has been updated successfully.");
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to make a  clone of a broadcast campaign
     */
    public function clonBroadcastCampaign(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();


        $response = array();

        $broadcastId = $request->automation_id;


        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastId);
        $oBroadcast = $oBroadcast[0];
        $oldEventID = $oBroadcast->evtid;

        $broadcastSettings = $mBroadcast->getBroadcastSettings($oBroadcast->id);

        $broadcastSettings =($broadcastSettings->isNotEmpty()) ?  $broadcastSettings[0] : 0;


        $oLists = $mBroadcast->getMyLists($userID);

        $campaignName = $oBroadcast->title;
        for ($i = 1; $i++; $i <= 20) {
            $newBroadcastName = $campaignName . ' ' . $i;
            $checkTitle = $mBroadcast->checkBroadcastTitle($newBroadcastName, $userID);
            if ($checkTitle === false) {
                break;
            }
        }
        $templateContent = $oBroadcast->html;
        $templateName = $oBroadcast->template_source;
        $broadcastType = $oBroadcast->campaign_type;
        $description = $oBroadcast->description;
        $status = $oBroadcast->bc_status;
        $schduleData = $oBroadcast->data;
        $sendingMethod = $oBroadcast->sending_method;

        $bData = array(
            'user_id' => $userID,
            'title' => $newBroadcastName,
            'description' => $description,
            'email_type' => 'broadcast',
            'sending_method' => $sendingMethod,
            'status' => 'draft',
            'created' => date("Y-m-d H:i:s")
        );

        $broadcastID = $mBroadcast->createBroadcast($bData);

        if ($broadcastID != '') {
            //Create default split test
            $splitData = array(
                'test_name' => $newBroadcastName . '-Split',
                'broadcast_id' => $broadcastID,
                'created' => date("Y-m-d H:i:s")
            );
            $splitTestId = $mBroadcast->createSplitTest($splitData);
            $deliveryDate = date("m/d/Y", strtotime('+7 day'));
            $deliveryTime = "01:00 AM";
            $triggerTime = array(
                'delivery_date' => $deliveryDate,
                'delivery_time' => $deliveryTime
            );

            $schduleData = json_encode($triggerTime);
            $eData = array(
                'automation_id' => $broadcastID,
                'event_type' => 'broadcast',
                'status' => 'active',
                'data' => $schduleData,
                'created' => date("Y-m-d H:i:s")
            );
            $broadcastEventID = $mBroadcast->createBroadcastEvent($eData);

            //Copy entire normal/split campaigns
            if ($oldEventID > 0) {
                $moduleName = 'broadcast';
                $oCampaigns = $mWorkflow->getEventCampaign($oldEventID, $moduleName);
                if (!empty($oCampaigns)) {
                    foreach ($oCampaigns as $oCampaign) {
                        $aCampaignData = (array) $oCampaign;
                        unset($aCampaignData['id']);
                        $aCampaignData['created'] = date("Y-m-d H:i:s");
                        $aCampaignData['event_id'] = $broadcastEventID;
                        $campaignId = $mBroadcast->addBroadcastCampaign($aCampaignData);
                    }
                }

                if ($sendingMethod == 'split') {
                    //clone variations also
                    $oCampaigns = $mBroadcast->getBroadcastVariationCampaigns($broadcastId);
                    if (!empty($oCampaigns)) {
                        foreach ($oCampaigns as $oCampaign) {
                            $aCampaignData = (array) $oCampaign;
                            unset($aCampaignData['id']);
                            $aCampaignData['created'] = date("Y-m-d H:i:s");
                            $aCampaignData['event_id'] = $broadcastEventID;
                            $aCampaignData['split_test_id'] = $splitTestId;
                            $aCampaignData['broadcast_id'] = $broadcastID;
                            $mBroadcast->addBroadcastCampaign($aCampaignData, 'split');
                        }
                    }
                }
            }
        }

        $emailSubject = $oBroadcast->subject;
        $fromName = $oBroadcast->from_name;
        $fromEmail = $oBroadcast->from_email;
        $replyToEmail = $oBroadcast->reply_to;
        $textVersionEmail = (!empty($broadcastSettings)) ? $broadcastSettings->text_version_email : '';
        $enableMobileResponsiveness = (!empty($broadcastSettings)) ?  $broadcastSettings->enable_mobile_responsiveness : '';
        $readTracking = (!empty($broadcastSettings)) ? $broadcastSettings->read_tracking : '';
        $linkTracking = (!empty($broadcastSettings)) ? $broadcastSettings->link_tracking : '';
        $replyTracking = (!empty($broadcastSettings)) ? $broadcastSettings->reply_tracking : '';
        $googleAnalytics = (!empty($broadcastSettings)) ? $broadcastSettings->google_analytics : '';
        $campaignArchives = (!empty($broadcastSettings)) ?  $broadcastSettings->campaign_archives : '';

        $cData = array(
            'subject' => $emailSubject,
            'from_name' => $fromName,
            'from_email' => $fromEmail,
            'reply_to' => $replyToEmail
        );

        $mBroadcast->updateBroadcastCampaign($cData, $broadcastEventID);


        $sData = array(
            'campaign_id' => $campaignId,
            'text_version_email' => $textVersionEmail,
            'enable_mobile_responsiveness' => $enableMobileResponsiveness,
            'read_tracking' => $readTracking,
            'link_tracking' => $linkTracking,
            'reply_tracking' => $replyTracking,
            'google_analytics' => $googleAnalytics,
            'campaign_archives' => $campaignArchives
        );
        $mBroadcast->addBroadcastSettings($sData);

        /* $oAutomationLists = $mLists->getAutomationLists($broadcastId);
          foreach ($oAutomationLists as $listData) {
          $mEmails->updateAutomationList($broadcastID, $listData->list_id);
          } */

        if ($broadcastID) {
            $response = array('status' => 'success', 'broadcastId' => $broadcastID, 'broadcastName' => $newBroadcastName, 'description' => $description);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to create a broadcast campaign
     */
    public function createBroadcast(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $validatedData = $request->validate([
            'campaign_name' => ['required'],
            'description' => ['required'],
            'broadcast_type' => ['required']
        ]);

        $response = array();

        $campaignName = strip_tags($request->campaign_name);
        $templateContent = strip_tags($request->template_content);
        $templateName = strip_tags($request->template_name);
        $broadcastType = strip_tags($request->broadcast_type);
        $description = strip_tags($request->description);

        $bData = array(
            'user_id' => $userID,
            'title' => $campaignName,
            'description' => $description,
            'email_type' => 'broadcast',
            'status' => 'draft',
            'created' => date("Y-m-d H:i:s")
        );

        $broadcastID = $mBroadcast->createBroadcast($bData);

        if ($broadcastID != '') {
            //Create default split test
            $splitData = array(
                'test_name' => $campaignName . '-Split',
                'broadcast_id' => $broadcastID,
                'created' => date("Y-m-d H:i:s")
            );
            $splitTestId = $mBroadcast->createSplitTest($splitData);
            $eData = array(
                'automation_id' => $broadcastID,
                'event_type' => 'broadcast',
                'status' => 'active',
                'created' => date("Y-m-d H:i:s")
            );
            $broadcastEventID = $mBroadcast->createBroadcastEvent($eData);
            //Notify only admin
            /* $notificationData = array(
              'event_type' => 'added_new_broadcast',
              'event_id' => 0,
              'link' => base_url() . 'admin/broadcast/edit/' . $broadcastID,
              'message' => 'Created new  broadcast.',
              'user_id' => '1',
              'status' => 1,
              'created' => date("Y-m-d H:i:s")
              );
              $eventName = 'sys_broadcast_added';
              add_notifications($notificationData, $eventName, 1, true); */

            $notificationData = array(
                'event_type' => 'added_new_broadcast',
                'event_id' => 0,
                'link' => base_url() . 'admin/broadcast/edit/' . $broadcastID,
                'message' => 'Created new  broadcast.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_broadcast_added';
            add_notifications($notificationData, $eventName, $userID);

            $contentType = $broadcastType == 'Email' ? 'Regular' : 'Plain Text';
            $cData = array(
                'event_id' => $broadcastEventID,
                'content_type' => $contentType,
                'campaign_type' => $broadcastType,
                'html' => $templateContent,
                'template_source' => $templateName,
                'status' => 'active',
                'created' => date("Y-m-d H:i:s")
            );
            $mBroadcast->createBroadcastCampaign($cData);

            if (!empty($splitTestId)) {
                $cData['split_test_id'] = $splitTestId;
                $cData['broadcast_id'] = $broadcastID;
                $mBroadcast->createBroadcastDefaultVariationCampaign($cData);
            }



            $deliveryDate = date("m/d/Y");
            $deliveryTime = "01:00 AM";
            $triggerTime = array(
                'delivery_date' => $deliveryDate,
                'delivery_time' => $deliveryTime
            );

            $schduleData = array(
                'data' => json_encode($triggerTime)
            );

            $mBroadcast->updateAutomationScheduleDate($schduleData, $broadcastID);
        }

        if ($broadcastID) {
            $response = array('status' => 'success', 'broadcastId' => $broadcastID);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     *
     */
    public function updateAutomation(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        if (empty($request->automation_id)) {
            $response = array('status' => 'error','type' => 'emptyid',  'msg' => 'Something went wrong, please refresh the page and try again.');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }

        $validatedData = $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        $automationID = $request->automation_id;
        $title = !empty($request->title) ? $request->title : '';
        $description = !empty($request->description) ? $request->description : '';
        $automation_type = !empty($request->automation_type) ? $request->automation_type : 'email';
        $dateTime = date("Y-m-d H:i:s");

        $aData = array(
            'title' => $title,
            'description' => $description
        );

        //Instantiate Email model to get its methods and properties
        $mEmails = new EmailsModel();

        $bAlreadyExists = $mEmails->checkIfEmailAutomationExists($title, $userID, $automationID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'Automation title already exists');
            echo json_encode($response);
            exit;
        }

        $bUpdated = $mEmails->updateEmailAutomation($aData, $automationID, $userID);
        if ($bUpdated) {
            $setupUrl = base_url() . 'admin#/modules/emails/workflow/setup/' . $automationID;
            $response = array('status' => 'success', 'id' => $automationID, 'actionUrl' =>  $setupUrl, 'msg' => "Automation updated successfully!");

            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'module_'.$automation_type,
                'action_name' => 'automation_updated',
                'automation_id' => $automationID,
                'list_id' => '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Updated '.$automation_type.' automation',
                'activity_created' => $dateTime
            );
            @logUserActivity($aActivityData);
        }

        echo json_encode($response);
        exit;
    }

    public function mysegments() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        $mWorkflow = new WorkflowModel();

        $aBreadcrumb = array(
            'Home' => '#/',
            'People' => '#/contacts/dashboard',
            'Segments' => '#/contacts/segments'
        );


        $oSegments = $mBroadcast->getSegments($userID);
        foreach ($oSegments->items() as $key => $oSegment) {
            $oSubscribers = [];
            $oSubscribers = $mBroadcast->getSegmentSubscribers($oSegment->id, $userID);
            $aCampaignIDs = @unserialize($oSegment->source_campaign_id);
            $moduleName = $oSegment->source_module_name;
            $modName = '';
            $campaignCollection = [];
            if (!empty($aCampaignIDs)) {
                //$campaignCollection = array();
                foreach ($aCampaignIDs as $campaignId) {
                    $modName = $moduleName;
                    if (in_array($moduleName, array('brandboost-onsite', 'brandboost-offsite'))) {
                        $modName = 'brandboost';
                    }

                    if (in_array($moduleName, array('nps-feedback'))) {
                        $modName = 'nps';
                    }
                    $oCampaign = $mWorkflow->getModuleUnitInfo($modName, $campaignId);

                    if (!empty($oCampaign)) {
                        //$campaignCollection[] = "<a target='_blank' href='" . base_url("admin/broadcast/edit/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                        if ($moduleName == 'brandboost') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/brandboost/details/{$oCampaign->id}") . "'>{$oCampaign->brand_title}</a>";
                        } else if ($moduleName == 'brandboost-onsite') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/brandboost/onsite_setup/{$oCampaign->id}") . "'>{$oCampaign->brand_title}</a>";
                        } else if ($moduleName == 'brandboost-offsite') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/brandboost/offsite_setup/{$oCampaign->id}") . "'>{$oCampaign->brand_title}</a>";
                        } else if ($moduleName == 'broadcast') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin#/broadcast/edit/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                        } else if ($moduleName == 'automation') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/emails/setupAutomation/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                        } else if ($moduleName == 'nps') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/nps/setup/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                        } else if ($moduleName == 'nps-feedback') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/nps/setup/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                        } else if ($moduleName == 'referral') {
                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/referral/setup/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                        }
                    }



                }
            }

            $oSegment->segmentSubscribers = $oSubscribers;
            $oSegment->moduleName = $modName;
            $oSegment->campaignCollection = $campaignCollection;
            //$oSegments[$key]->data = $oSegment;
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/emails') . '" class="sidebar-control hidden-xs">Broadcast </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="My Segments" class="sidebar-control active hidden-xs ">My Segments</a></li>
                    </ul>';

        $aData = array(
            'title' => 'My Segments',
            'allData' => $oSegments,
            'oSegments' => $oSegments->items(),
            'pagename' => $breadcrumb,
            'breadcrumb' => $aBreadcrumb,
            'moduleName' => '',
            'moduleUnitID' => '',
            'moduleAccountID' => ''
        );

        //return view('admin.broadcast.segments', $aData)->with(['mWorkflow'=> $mWorkflow]);
        echo json_encode($aData);
        exit;
    }

    /**
     * Used to get segments for a broadcast campaign
     */
    public function getSegment(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $segment_id = $request->segment_id;
        $oSegments = $mBroadcast->getSegmentById($userID, $segment_id);

        if (!empty($oSegments)) {
            $response = array('status' => 'success', 'segment_id' => $segment_id, 'title' => $oSegments[0]->segment_name, 'description' => $oSegments[0]->segment_desc);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update broadcast segments
     */
    public function updateSegment(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $segmentID = strip_tags($request->segment_id);
        $title = strip_tags($request->title);
        $description = strip_tags($request->edit_description);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'segment_name' => $title,
            'segment_desc' => $description,
            'status' => 1
        );

        /* $bAlreadyExists = $mLists->checkIfListExists($title, $userID, $listID);
          if ($bAlreadyExists == true) {
          $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'List name already exists');
          echo json_encode($response);
          exit;
          } */

        $mUser  =  new UsersModel();
        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if ($userRole != '1') {
            $bUpdated = $mBroadcast->updateSegment($aData, $segmentID, $userID);
        } else {
            $userID = '';
            $bUpdated = $mBroadcast->updateSegment($aData, $segmentID, $userID);
        }

        if ($bUpdated) {
            //Add Useractivity log

            $response = array('status' => 'success', 'msg' => "List updated successfully!");
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get contacts associated with the segments
     * @param type $segmentID
     */
    public function segmentcontacts($segmentID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $aBreadcrumb = array(
            'Home' => '#/',
            'People' => '#/contacts/dashboard',
            'Segments' => '#/contacts/segments',
            'Subscribers' => ''
        );
        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Get Segment Info
        $oSegment = $mBroadcast->getSegmentInfo($segmentID);


        $oSubscribers = $mBroadcast->getSegmentSubscribers($segmentID, $userID);
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/emails') . '" class="sidebar-control hidden-xs">Broadcast </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/mysegments') . '" class="sidebar-control hidden-xs">Segments </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="My Segments" class="sidebar-control active hidden-xs ">Segment Contacts</a></li>
                    </ul>';

        $aData = array(
            'title' => 'Segment Subscribers',
            'subscribersData' => $oSubscribers->items(),
            'allData' => $oSubscribers,
            'segmentInfo' => $oSegment,
            'moduleName' => 'people',
            'moduleUnitID' => '',
            'moduleAccountID' => '',
            'activeCount' => '',
            'archiveCount' => '',
            'pagename' => $breadcrumb,
            'breadcrumb' => $aBreadcrumb
        );

        echo json_encode($aData);
        exit;
        //return view('admin.broadcast.segment_subscribers', $aData);
    }

    /**
     * Used to delete segments in bulk
     */
    public function deleteMultipalSegment(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        $multiSegmentid = $request->multiSegmentid;
        foreach ($multiSegmentid as $segmentid) {

            $result = $mBroadcast->deleteSegmentByID($segmentid);
        }
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete segment users in bulk
     */
    public function deleteMultipalSegmentUser(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        $multiSegmentUserid = $request->multiSegmentUserid;
        foreach ($multiSegmentUserid as $segmentUserid) {

            $result = $mBroadcast->deleteSegmentUser($segmentUserid);
        }
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete broadcast segment
     */
    public function deleteSegment(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $response = array();

        $segmentID = strip_tags($request->segmentID);
        $result = $mBroadcast->deleteSegmentByID($segmentID);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to archive segments in bulk-Deprecated
     */
    public function archive_multipal_segment(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //$userID = Session::get("current_user_id");
        if (!empty($request)) {

            $multi_segment_id = $request->multi_segment_id;

            $aData = array(
                'status' => '2'
            );

            foreach ($multi_segment_id as $segmentID) {

                $result = $mBroadcast->updateSegment($aData, $segmentID, $userID);
            }
        }
        $response['status'] = 'success';
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update broadcast segments
     */
    public function updatePeopleSegment(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $userRole = $aUser->user_role;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $segmentID = strip_tags($request->segment_id);
        $title = strip_tags($request->segmentName);
        $description = strip_tags($request->segmentDescription);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'segment_name' => $title,
            'segment_desc' => $description,
            'status' => 1
        );

        if ($userRole != '1') {
            $bUpdated = $mBroadcast->updateSegment($aData, $segmentID, $userID);
        } else {
            $userID = '';
            $bUpdated = $mBroadcast->updateSegment($aData, $segmentID, $userID);
        }

        if ($bUpdated) {
            $response = array('status' => 'success', 'msg' => "Segment updated successfully!");
        }

        echo json_encode($response);
        exit;
    }

    public function makeSegment(Request $request){
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'segmentName' => ['required'],
            'segmentDescription' => ['required']
        ]);

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $segmentName = $request->segmentName;
        $description = $request->segmentDescription;
        //check for already
        $bDuplicate = $mBroadcast->isDuplicateSegment($segmentName, $userID);
        if ($bDuplicate == true) {
            //Display Error and ask to enter template name something else
            $response['status'] = 'error';
            $response['msg'] = 'duplicate';
        } else {
            //Insert Segment
            $aData = array(
                'user_id' => $userID,
                'segment_name' => $segmentName,
                'segment_desc' => $description,
                'created' => date("Y-m-d H:i:s")
            );

            $segmentID = $mBroadcast->createSegment($aData);

            if ($segmentID) {
                $response = array('status' => 'success');
            } else {
                $response = array('status' => 'error');
            }
        }



        echo json_encode($response);
        exit;


    }


    /**
     * Used to create segments
     */
    public function createSegment(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        $segmentName = strip_tags($request->segmentName);
        $description = strip_tags($request->segmentDescription);
        $campaignID = strip_tags($request->broadcastID);
        $segmentType = strip_tags($request->segmentType);
        $campaignType = strip_tags($request->campaignType);
        $sendingMethod = strip_tags($request->sendingMethod);
        $moduleName = strip_tags($request->moduleName);


        //check for already
        $bDuplicate = $mBroadcast->isDuplicateSegment($segmentName, $userID);
        if ($bDuplicate == true) {
            //Display Error and ask to enter template name something else
            $response['status'] = 'error';
            $response['msg'] = 'duplicate';
        } else {
            //Insert Segment
            $aData = array(
                'user_id' => $userID,
                'segment_name' => $segmentName,
                'segment_desc' => $description,
                'source_campaign_id' => serialize(array($campaignID)),
                'source_campaign_type' => $campaignType,
                'source_segment_type' => $segmentType,
                'source_sending_method' => $sendingMethod,
                'source_module_name' => $moduleName,
                'created' => date("Y-m-d H:i:s")
            );

            $segmentID = $mBroadcast->createSegment($aData);

            if ($segmentID > 0) {
                //Enter list of contacts in the segment
                $bInserted = $mBroadcast->addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType, $moduleName, $sendingMethod);
            }
            if ($segmentID) {
                $response = array('status' => 'success', 'segmentId' => $segmentNameID);
            } else {
                $response = array('status' => 'error');
            }
        }



        echo json_encode($response);
        exit;
    }

    /**
     * Used to sync contacts inside the created segments
     */
    public function syncSegment(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        $segmentID = strip_tags($request->segmentID);
        //Get Segment Info
        $oSegment = $mBroadcast->getSegments($userID, $segmentID);
        if (!empty($oSegment)) {
            $aCampaignSources = unserialize($oSegment[0]->source_campaign_id);
            $segmentType = $oSegment[0]->source_segment_type;
            $campaignType = $oSegment[0]->source_campaign_type;
            $moduleName = $oSegment[0]->source_module_name;
            $eventID = $oSegment[0]->source_event_id;
            if (!empty($aCampaignSources)) {
                foreach ($aCampaignSources as $campaignID) {
                    //$mBroadcast->addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType);
                    if ($moduleName == 'brandboost-onsite') {
                        //echo "Yes, I am here";
                        $bInserted = $this->mSegments->addSegmentSubscribersFromReviews($segmentID, $campaignID, $segmentType, $campaignType, $moduleName);
                    } else if ($moduleName == 'brandboost-offsite') {
                        //echo "Yes, I am here";
                        $bInserted = $this->mSegments->addSegmentSubscribersFromFeedback($segmentID, $campaignID, $segmentType, $campaignType, $moduleName);
                    } else if ($moduleName == 'nps-feedback') {
                        //echo "Yes, I am here";
                        $oNPS = $this->mNPS->getNps($userID, $campaignID);
                        if (!empty($oNPS)) {
                            $hashCode = $oNPS->hashcode;
                        }


                        $bInserted = $this->mSegments->addSegmentSubscribersFromNPSFeedback($segmentID, $hashCode, $segmentType, $campaignType, $moduleName);
                    } else {
                        $bInserted = $this->mSegments->addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType, $moduleName, $eventID);
                    }
                }
            }
            $response = array('status' => 'success');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to sync segment in bulk
     */
    public function syncSegmentMultiple(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $response = array();

        $aSegments = $request->segmentCollection;
        if (!empty($aSegments)) {
            foreach ($aSegments as $segmentID) {
                //Get Segment Info
                $oSegment = $mBroadcast->getSegments($userID, $segmentID);
                if (!empty($oSegment)) {
                    $aCampaignSources = unserialize($oSegment[0]->source_campaign_id);
                    $segmentType = $oSegment[0]->source_segment_type;
                    $campaignType = $oSegment[0]->source_campaign_type;
                    if (!empty($aCampaignSources)) {
                        foreach ($aCampaignSources as $campaignID) {
                            $mBroadcast->addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType);
                        }
                    }
                    $response = array('status' => 'success');
                }
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to add end campaign to the broadcast campaign
     */
    public function addCampaignToBroadcast(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Subscriber model to get its methods and properties
        $mTemplates = new TemplatesModel();


        $source = strip_tags($request->source);
        $broadcastID = strip_tags($request->broadcast_id);
        $templateID = strip_tags($request->template_id);
        $moduleName = 'broadcast';
        $isDraft = ($source == 'draft') ? true : false;



        //$tab = strip_tags($request->tab']);
        $response = array();
        $response['status'] = 'error';
        if ($broadcastID > 0) {
            $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
            $campaignID = $oBroadcast[0]->id;
            $campaignType = strtolower($oBroadcast[0]->campaign_type);
            $oEvents = $mWorkflow->getWorkflowEvents($broadcastID, 'broadcast');
            $bHaveVariations = false;
            $oVariations = $mBroadcast->getBroadcastVariations($broadcastID);
            if (!empty($oVariations)) {
                $bHaveVariations = true;
                $variationID = $oVariations[0]->id;
            } else {
                //Add Default Variation
                $splitData = array(
                    'test_name' => $oBroadcast[0]->title . '-Split',
                    'broadcast_id' => $broadcastID,
                    'created' => date("Y-m-d H:i:s")
                );
                $splitTestId = $mBroadcast->createSplitTest($splitData);
            }

            if (!empty($oEvents)) {
                $eventID = $oEvents[0]->id;
                if ($eventID > 0) {
                    if ($campaignID > 0) {
                        //Update existing campaign
                        $oTemplate = $mTemplates->getCommonTemplateInfo($templateID);
                        $templateSID = $templateID;
                        $aUpdateData = array(
                            'name' => $oTemplate->template_name,
                            'introduction' => $oTemplate->introduction,
                            'greeting' => $oTemplate->greeting,
                            'html' => $oTemplate->template_content,
                            'stripo_html' => $oTemplate->stripo_html,
                            'stripo_css' => $oTemplate->stripo_css,
                            'stripo_compiled_html' => $oTemplate->stripo_compiled_html,
                            'template_source' => $templateSID,
                            'campaign_type' => $oTemplate->template_type
                        );
                        $bUpdated = $mWorkflow->updateWorkflowCampaign($aUpdateData, $campaignID, $moduleName);
                        if ($bUpdated) {

                            if ($bHaveVariations == true) {
                                //Update Default Variation too
                                $aData = array(
                                    'subject' => isset($oTemplate->subject) ? $oTemplate->subject : '',
                                    'html' => $oTemplate->template_content,
                                    'stripo_html' => $oTemplate->stripo_html,
                                    'stripo_css' => $oTemplate->stripo_css,
                                    'stripo_compiled_html' => $oTemplate->stripo_compiled_html,
                                    'template_source' => ($isDraft) ? $draftTemplateID : $templateSID,
                                    'campaign_type' => $oTemplate->template_type
                                );
                                if (!empty($aData) && $variationID > 0) {
                                    $bUpdated = $mBroadcast->updateVariation($aData, $variationID);
                                }
                            } else {
                                //Insert Default Variation
                                if (!empty($splitTestId)) {
                                    $cData = array(
                                        'event_id' => $eventID,
                                        'split_test_id' => $splitTestId,
                                        'broadcast_id' => $broadcastID,
                                        'html' => $oTemplates->template_content,
                                        'template_source' => $templateSID,
                                        'status' => 'active',
                                        'created' => date("Y-m-d H:i:s")
                                    );
                                    $mBroadcast->createBroadcastDefaultVariationCampaign($cData);
                                }
                            }


                            $response = array('status' => 'success');
                        }
                    } else {
                        $bAdded = $mWorkflow->addWorkflowCampaign($eventID, $templateID, $broadcastID, 'broadcast', $isDraft);
                        if ($bAdded) {
                            //Session::put("setTab", trim($tab));
                            $response = array('status' => 'success');
                        }
                    }
                }
            }

            if ($campaignType == 'sms') {
                $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
                $aEditorData = array(
                    'oBroadcast' => $oBroadcast[0],
                    'moduleName' => 'broadcast'
                );
                $sEditorContent = view('admin.broadcast.partials.template_design_sms_ajax', $aEditorData)->render();
                $response['editorData'] = $sEditorContent;
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to see preview of a broadcast campaign
     */
    public function previewBroadcastCampaign(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();



        if (!empty($request)) {
            $campaignID = strip_tags($request->campaign_id);
            $moduleName = 'broadcast';
            $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
            $campaignType = strtolower($oResponse->campaign_type);
            if ($campaignType == 'email') {
                $sHtml = base64_decode($oResponse->stripo_compiled_html);
            } else {
                $sHtml = '<div class="sms_preview">' . base64_decode($oResponse->stripo_compiled_html) . '</div>';
            }
        }
        $response['status'] = 'success';
        $response['content'] = $sHtml;
        echo json_encode($response);
        exit;
    }

    /**
     * Used to send preview email of a broadcast campaign
     */
    public function sendPreviewBroadcastEmail(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();



        $emailAddress = strip_tags($request->email_address);
        $messageSubject = base64_decode(strip_tags($request->email_subject));
        $messageBody = base64_decode($request->email_body);
        $campaignID = strip_tags($request->campaign_id);
        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $campaignID);
        if (!empty($oBroadcast)) {
            $oBroadcast = $oBroadcast[0];
            $subject = $oBroadcast->subject;
            $fromEmail = $oBroadcast->from_email;
            $fromName = $oBroadcast->from_name;
            $replyTo = $oBroadcast->reply_to;

            $aAdditionalParams = array(
                'fromEmail' => $fromEmail,
                'fromName' => $fromName,
                'replyEmail' => $replyTo
            );
        }
        sendEmailPreview($emailAddress, $messageBody, $messageSubject, $aAdditionalParams);
        $response = array('status' => 'success');
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update session for the tabs
     */
    public function setTab(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        if (!empty($request)) {

            $tab = $request->tab;
            if (!empty($tab)) {
                if ($tab == 'Review Contacts') {
                    $broadcastID = strip_tags($request->bid);
                    if ($broadcastID > 0) {
                        $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($broadcastID);
                        $iTotal = count($oBroadcastSubscriber);
                        if ($iTotal > 0) {
                            Session::put("setTab", trim($tab));
                        }
                        $response['totalContacts'] = $iTotal;
                    }
                } else {
                    Session::put("setTab", trim($tab));
                }

                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get records- Add more info later
     * @param type $email_sms
     * @param type $broadcast_id
     */
    public function records($email_sms, $broadcast_id) {


        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        if (empty($broadcast_id)) {
            //Handle empty id error
        }

        $selectedTab = $_GET['type'];
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcast_id);
        $oBroadcastdelivered = $mBroadcast->getMyBroadcastSubscribers($oBroadcast[0]->event_id, 'delivered');
        $oBroadcastopen = $mBroadcast->getMyBroadcastSubscribers($oBroadcast[0]->event_id, 'open');
        $oBroadcastclick = $mBroadcast->getMyBroadcastSubscribers($oBroadcast[0]->event_id, 'click');

        $oBroadcastSmsSent = $mBroadcast->getMyBroadcastSubscribersSMS($oBroadcast[0]->event_id, 'sent');
        $oBroadcastSmsOpen = $mBroadcast->getMyBroadcastSubscribersSMS($oBroadcast[0]->event_id, 'open');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs"" href="'.base_url('admin/broadcast/'.$email_sms).'">Broadcast</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Records" class="sidebar-control active hidden-xs ">Records</a></li>
                </ul>';

        $aData = array(
            'title' => 'Broadcast Report',
            'pagename' => $breadcrumb,
            'selected_tab' => $selectedTab,
            'oBroadcast' => $oBroadcast[0],
            'broadcast_id' => $broadcast_id,
            'oBroadcastSub' => array(
                'delivered' => $oBroadcastdelivered,
                'open' => $oBroadcastopen,
                'click' => $oBroadcastclick,
                'smsSent' => $oBroadcastSmsSent,
                'smsOpen' => $oBroadcastSmsOpen
            )
        );

        if ($email_sms == 'sms') {
            return view('admin.broadcast.smsreports', $aData);
        } else {
            return view('admin.broadcast.reports', $aData);
        }
    }

    /**
     * Used to get email report
     */
    public function getEmailReport(Request $request) {


        $report = $request->report;
        $broadcast_id = $request->broadcastId;

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcast_id);
        $oBroadcastReord = $mBroadcast->getMyBroadcastSubscribers($oBroadcast[0]->event_id, $report);


        echo view('admin.broadcast.reports.subscriber-data', array('delivered' => $oBroadcastReord))->render();
    }

    /**
     * Used to load Improted properties of audience selection
     */
    public function loadImportOption(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();


        $response = array();

        if (!empty($request)) {

            $broadcastID = strip_tags($request->broadcastId);
            $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
            $content = view('admin.components.smart-popup.import-options', array('broadcastID' => $broadcastID, 'oBroadcast' => $oBroadcast[0]))->render();
            $response['status'] = 'success';
            $response['content'] = $content;
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to load excluded properties of audience selection
     */
    public function loadExcludeOption(Request $request) {

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $response = array();

        if (!empty($request)) {

            $broadcastID = strip_tags($request->broadcastId);
            $content = view('admin.components.smart-popup.exclude-options', array('broadcastID' => $broadcastID))->render();
            $response['status'] = 'success';
            $response['content'] = $content;
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Imported properties
     */
    public function getImportedProperties(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();

        //Instantiate Tag model to get its methods and properties
        $mTag = new TagsModel();

        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();



        $response = array();

        if (!empty($request)) {

            $broadcastID = strip_tags($request->broadcastId);
            $oCampaignLists = $mLists->getAutomationLists($broadcastID);
            $oCampaignContacts = $mBroadcast->getBroadcastContacts($broadcastID);
            $oCampaignTags = $mBroadcast->getBroadcastTags($broadcastID);
            $aTags = $mTag->getClientTags($userID);
            $oCampaignSegments = $mBroadcast->getBroadcastSegments($broadcastID);
            $aData = array(
                'broadcastID' => $broadcastID,
                'oCampaignLists' => $oCampaignLists,
                'oCampaignContacts' => $oCampaignContacts,
                'aTags' => $aTags,
                'oCampaignTags' => $oCampaignTags,
                'oCampaignSegments' => $oCampaignSegments
            );
            $content = view('admin.broadcast.partials.importButtonTags', $aData)->render();
        }
        $response['status'] = 'success';
        $response['content'] = $content;
        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Excluded properties
     */
    public function getExportedProperties(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Tags model to get its methods and properties
        $mTag = new TagsModel();

        $response = array();

        if (!empty($request)) {

            $broadcastID = strip_tags($request->broadcastId);
            $oCampaignLists = $mLists->getAutomationExcludedLists($broadcastID);
            $oCampaignContacts = $mBroadcast->getBroadcastExcludedContacts($broadcastID);
            $oCampaignTags = $mBroadcast->getBroadcastExcludedTags($broadcastID);
            $aTags = $mTag->getClientTags($userID);
            $oCampaignSegments = $mBroadcast->getBroadcastExcludedSegments($broadcastID);
            $aData = array(
                'broadcastID' => $broadcastID,
                'oCampaignLists' => $oCampaignLists,
                'oCampaignContacts' => $oCampaignContacts,
                'aTags' => $aTags,
                'oCampaignTags' => $oCampaignTags,
                'oCampaignSegments' => $oCampaignSegments
            );
            $content = view('admin.broadcast.partials.excludeButtonTags', $aData)->render();
        }
        $response['status'] = 'success';
        $response['content'] = $content;
        echo json_encode($response);
        exit;
    }

    /**
     * Used to load Broadcast users added to the campaign
     */
    public function loadBroadcastAudience(Request $request) {
        $response = array();

        if (!empty($request)) {

            $broadcastID = strip_tags($request->broadcastId);
            $audienceType = strip_tags($request->audienceType);
            $actionType = strip_tags($request->actionType);
            if ($broadcastID > 0) {

                $aUser = getLoggedUser();
                $userID = $aUser->id;

                //Instantiate Broadcast model to get its methods and properties
                $mBroadcast = new BroadcastModel();

                //Instantiate Subscriber model to get its methods and properties
                $mSubscriber = new SubscriberModel();

                //Instantiate Tag model to get its methods and properties
                $mTag = new TagsModel();

                //Instantiate workflow model to get its methods and properties
                $mWorkflow = new WorkflowModel();

                //Instantiate Lists model to get its methods and properties
                $mLists = new ListsModel();

                $duplicateCount = 0;

                $oLists = $mBroadcast->getMyLists($userID);
                $twillioData = $mBroadcast->getTwillioData($userID);
                $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
                $oSegments = $mBroadcast->getSegments($userID);
                $broadcastSettings = $mBroadcast->getBroadcastSettings($oBroadcast[0]->id);
                $subscribersData = $mSubscriber->getGlobalSubscribers($userID);
                $aTags = $mTag->getClientTags($userID);
                $moduleName = 'broadcast';
                $oDefaultTemplates = $mWorkflow->getWorkflowDefaultTemplates($moduleName);
                $oDraftTemplates = $mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID);
                $oCategories = $mWorkflow->getWorkflowTemplateCategories($moduleName);



                if ($broadcastID > 0) {
                    $oEvents = $mWorkflow->getWorkflowEvents($broadcastID, $moduleName);
                    if (!empty($oEvents)) {
                        $eventID = $oEvents[0]->id;
                        if ($eventID > 0) {
                            $oCampaign = $mWorkflow->getEventCampaign($eventID, $moduleName);
                        }
                    }
                }



                if ($actionType == 'import') {
                    //Get Campaign list subscribers
                    $oTotalSubscribers = $mBroadcast->getBroadcastListSubscribers($broadcastID);


                    $totalSubscribers = count($oTotalSubscribers);


                    //Check for duplicate records

                    if (!empty($oTotalSubscribers)) {
                        $aEmails = array();
                        $duplicateCount = 0;
                        foreach ($oTotalSubscribers as $oRec) {
                            if (in_array($oRec->subscriber_email, $aEmails)) {
                                $duplicateCount++;
                            }
                            $aEmails[] = $oRec->subscriber_email;
                        }
                    }

                    $oAutomationLists = $mLists->getAutomationLists($broadcastID);
                    $oCampaignContacts = $mBroadcast->getBroadcastContacts($broadcastID);
                    $oCampaignTags = $mBroadcast->getBroadcastTags($broadcastID);
                    $oCampaignSegments = $mBroadcast->getBroadcastSegments($broadcastID);
                }

                if ($actionType == 'exclude') {
                    //Get Campaign list subscribers
                    $oTotalSubscribers = $mBroadcast->getBroadcastExcludedListSubscribers($broadcastID);


                    $totalSubscribers = count($oTotalSubscribers);


                    //Check for duplicate records
                    $aEmails = array();
                    $duplicateCount = 0;
                    if (!empty($oTotalSubscribers)) {

                        foreach ($oTotalSubscribers as $oRec) {
                            if (in_array($oRec->subscriber_email, $aEmails)) {
                                $duplicateCount++;
                            }
                            $aEmails[] = $oRec->subscriber_email;
                        }
                    }

                    $oAutomationLists = $mLists->getAutomationExcludedLists($broadcastID);
                    $oCampaignContacts = $mBroadcast->getBroadcastExcludedContacts($broadcastID);
                    $oCampaignTags = $mBroadcast->getBroadcastExcludedTags($broadcastID);
                    $oCampaignSegments = $mBroadcast->getBroadcastExcludedSegments($broadcastID);
                }

                //Do some more calculations for vue
                //For Contacts
                if($oCampaignContacts->isNotEmpty()){
                    $aSelectedContacts = array();
                    foreach ($oCampaignContacts as $oRec) {
                        $aSelectedContacts[] = $oRec->subscriber_id;
                    }
                }

                //For Lists
                $aSelectedListIDs = array();
                if($oAutomationLists->isNotEmpty()){
                    foreach ($oAutomationLists as $oAutomationList) {
                        $aSelectedListIDs[] = $oAutomationList->list_id;
                    }
                }

                $newolists = array();

                foreach ($oLists as $key => $value) {
                    $newolists[$value->id][] = $value;
                }

                //For Segments
                $aSelectedSegments = array();
                if ($oCampaignSegments->isNotEmpty()) {
                    foreach ($oCampaignSegments as $oRec) {
                        $aSelectedSegments[] = $oRec->segment_id;
                    }
                }

                if($oSegments->isNotEmpty()){
                    foreach($oSegments->items() as $oSegment){
                        $oSubscribers = $mBroadcast->getSegmentSubscribers($oSegment->id, $userID);
                        $oSegment->subscribersData = $oSubscribers;
                    }
                }

                //For Tags
                $aSelectedTags = array();
                if ($oCampaignTags->isNotEmpty()) {
                    foreach ($oCampaignTags as $oRec) {
                        $aSelectedTags[] = $oRec->tag_id;
                    }
                }

                if($aTags->isNotEmpty()){
                    foreach ($aTags->items() as $aTag){
                        $tagID = $aTag->tagid;
                        $oTagSubscribers = SubscriberModel::getTagSubscribers($tagID);
                        $aTag->subscribersData = $oTagSubscribers;
                    }

                }

                $aData = array(
                    'oBroadcast' => $oBroadcast[0],
                    'oDefaultTemplates' => $oDefaultTemplates,
                    'oDraftTemplates' => $oDraftTemplates,
                    'oCategories' => $oCategories,
                    'oAutomationLists' => $oAutomationLists,
                    'oLists' => $oLists,
                    'newolists' => $newolists,
                    'aSelectedListIDs' => $aSelectedListIDs,
                    'subscribersData' => $subscribersData->items(),
                    'allDataContacts' => $subscribersData,
                    'aSelectedContacts' => $aSelectedContacts,
                    'oCampaignContacts' => $oCampaignContacts,
                    'oCampaignTags' => $oCampaignTags,
                    'oSegments' => $oSegments->items(),
                    'allDataSegments' => $oSegments,
                    'oCampaignSegments' => $oCampaignSegments,
                    'aSelectedSegments' => $aSelectedSegments,
                    'totalSubscribers' => $totalSubscribers,
                    'duplicateSubscriber' => $duplicateCount,
                    'aTags' => $aTags->items(),
                    'allDataTags' => $aTags,
                    'aSelectedTags' => $aSelectedTags,
                    'broadcast_id' => $broadcastID,
                    'moduleName' => 'broadcast',
                    'moduleUnitID' => $broadcastID,
                    'broadcastSettings' => !empty($broadcastSettings[0]) ? $broadcastSettings[0] : array(),
                    'userData' => $aUser,
                    'twillioData' => $twillioData[0],
                    'oCampaign' => $oCampaign,

                );
            }

            /*if ($actionType == 'import' && $audienceType == 'lists') {

                $content = view('admin.components.smart-popup.broadcast-import-lists', $aData)->with(['mBroadcast' => $mBroadcast])->render();
            } else if ($actionType == 'import' && $audienceType == 'contacts') {
                $content = view("admin/components/smart-popup/broadcast-import-contacts", $aData)->with(['mBroadcast' => $mBroadcast])->render();
            } else if ($actionType == 'import' && $audienceType == 'segments') {
                $content = view("admin/components/smart-popup/broadcast-import-segments", $aData)->with(['mBroadcast' => $mBroadcast])->render();
            } else if ($actionType == 'import' && $audienceType == 'tags') {
                $content = view("admin/components/smart-popup/broadcast-import-tags", $aData)->with(['mBroadcast' => $mBroadcast])->render();
            } else if ($actionType == 'exclude' && $audienceType == 'lists') {
                $content = view("admin/components/smart-popup/broadcast-exclude-lists", $aData)->with(['mBroadcast' => $mBroadcast])->render();
            } else if ($actionType == 'exclude' && $audienceType == 'contacts') {
                $content = view("admin/components/smart-popup/broadcast-exclude-contacts", $aData)->with(['mBroadcast' => $mBroadcast])->render();
            } else if ($actionType == 'exclude' && $audienceType == 'segments') {
                $content = view("admin/components/smart-popup/broadcast-exclude-segments", $aData)->with(['mBroadcast' => $mBroadcast])->render();
            } else if ($actionType == 'exclude' && $audienceType == 'tags') {
                $content = view("admin/components/smart-popup/broadcast-exclude-tags", $aData)->with(['mBroadcast' => $mBroadcast])->render();
            }

            $response['status'] = 'success';
            $response['content'] = $content;*/
        }
        echo json_encode($aData);
        exit;
    }

    /**
     * Used to delete campaigns in bulk
     */
    public function multipalDeleteRecord(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }

        $multiRecordID = $request->multi_record_id;
        foreach ($multiRecordID as $recordID) {

            $bDeleted = $mBroadcast->deleteEmailRecordByID($recordID);
            if ($bDeleted == true) {
                //Add Useractivity log
                /* $aActivityData = array(
                  'user_id' => $aUser->id,
                  'event_type' => 'manage_automation_lists',
                  'action_name' => 'deleted_automation_list',
                  'list_id' => $listID,
                  'brandboost_id' => '',
                  'campaign_id' => '',
                  'inviter_id' => '',
                  'subscriber_id' => '',
                  'feedback_id' => '',
                  'activity_message' => 'Deleted automation list',
                  'activity_created' => date("Y-m-d H:i:s")
                  );
                  logUserActivity($aActivityData); */
                $response = array('status' => 'success', 'msg' => "Record deleted successfully!");
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to get reports associated with the campaigns
     * @param type $broadcastID
     */
    public function report($broadcastID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();

        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/email");
            exit;
        }

        //pre($oBroadcast);
        $sendingMethod = $oBroadcast[0]->sending_method;
        $broadcastType = $oBroadcast[0]->campaign_type;

        if ($sendingMethod == 'split') {
            $oVariations = $mBroadcast->getBroadcastVariations($broadcastID);
            //pre($oVariations);
            //die;
            if (!empty($oVariations)) {
                foreach ($oVariations as $oVariation) {
                    $campaignID = $oVariation->id;
                    $bIterated = false;
                    if (strtolower($broadcastType) == 'email') {
                        $aStats = $mBroadcast->getBroadcastSendgridStats('campaign', $campaignID, '', 'split');
                        $aCategorizedStats = $mBroadcast->getBroadcastSendgridCategorizedStatsData($aStats);
                        $bIterated = true;
                    } else if (strtolower($broadcastType) == 'sms') {
                        $aStats = $mBroadcast->getBroadcasstTwilioStats('campaign', $campaignID, '', 'split');
                        $aCategorizedStats = $mBroadcast->getBroadcastTwilioCategorizedStatsData($aStats);
                        $bIterated = true;
                    }
                    if ($bIterated == true) {
                        $aBroadcastStats[] = array(
                            'campaign_type' => strtolower($broadcastType),
                            'variationData' => $oVariation,
                            'statsData' => $aCategorizedStats
                        );
                    }
                }
            }
        } else {
            $bIterated = false;
            $campaignID = $oBroadcast[0]->id;
            if (strtolower($broadcastType) == 'email') {
                $aStats = $mBroadcast->getBroadcastSendgridStats('campaign', $campaignID);
                $aCategorizedStats = $mBroadcast->getBroadcastSendgridCategorizedStatsData($aStats);
                $bIterated = true;
            } else if (strtolower($broadcastType) == 'sms') {
                $aStats = $mBroadcast->getBroadcasstTwilioStats('campaign', $campaignID);
                $aCategorizedStats = $mBroadcast->getBroadcastTwilioCategorizedStatsData($aStats);
                $bIterated = true;
            }
            if ($bIterated == true) {
                $aBroadcastStats[] = array(
                    'campaign_type' => strtolower($broadcastType),
                    'statsData' => $aCategorizedStats
                );
            }
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/' . strtolower($broadcastType)) . '" class="sidebar-control hidden-xs">Broadcast </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/' . strtolower($broadcastType)) . '" class="sidebar-control hidden-xs">Reports </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="' . $oBroadcast[0]->title . '" class="sidebar-control active hidden-xs ">' . $oBroadcast[0]->title . '</a></li>
                    </ul>';

        //pre($oBroadcast);

        $aData = array(
            'title' => 'Brand Boost Broadcast',
            'pagename' => $breadcrumb,
            'aBroadcastStats' => $aBroadcastStats,
            'oBroadcast' => $oBroadcast[0],
            'sendingMethod' => $sendingMethod
        );

        if ($broadcastType == 'email') {
            return view('admin.broadcast.reports.email-broadcast', $aData);
        } else {
            return view('admin.broadcast.reports.sms-broadcast', $aData);
        }
    }

}
