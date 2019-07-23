<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BroadcasatModel;
use App\Models\Admin\TemplatesModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\TagsModel;
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        $activeTab = Session::put("setTab", "");
        $campaignType = '';
        //$oBroadcast = $mBroadcast->getMyBroadcasts($userID);

        $oBroadcast = $mBroadcast->getMyBroadcastsByTypes($userID, $campaignType);
        $campaignTemplates = $mBroadcast->getMyCampaignTemplate($userID);
        return view('admin.broadcast.index', array('title' => 'Brand Boost Broadcast', 'oBroadcast' => $oBroadcast, 'campaignTemplates' => $campaignTemplates, 'pagename' => $breadcrumb));
    }

    
    /**
     * Used to display all email broadcast campaigns
     */
    public function email() {
        $campaignType = 'Email';
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Email </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Broadcast" class="sidebar-control active hidden-xs ">Broadcast</a></li>
                    </ul>';

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        $activeTab = Session::put("setTab", "");
        $oBroadcast = $mBroadcast->getMyBroadcastsByTypes($userID, $campaignType);
        $campaignTemplates = $mBroadcast->getMyCampaignTemplate($userID);
        $moduleName = 'broadcast';
        Session::put("setTab", '');
        return view('admin.broadcast.index', array('title' => 'Brand Boost Broadcast', 'oBroadcast' => $oBroadcast, 'campaignTemplates' => $campaignTemplates, 'pagename' => $breadcrumb, 'campaignType' => $campaignType, 'moduleName' => $moduleName));
    }

    /**
     * Used to display all sms broadcast campaigns
     */
    public function sms() {
        $campaignType = 'SMS';
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">SMS </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Broadcast" class="sidebar-control active hidden-xs ">Broadcast</a></li>
                    </ul>';
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        $activeTab = Session::put("setTab", "");
        $oBroadcast = $mBroadcast->getMyBroadcastsByTypes($userID, $campaignType);
        $campaignTemplates = $mBroadcast->getMyCampaignTemplate($userID);
        $moduleName = 'broadcast';
        Session::put("setTab", '');
        return view('admin.broadcast.index', array('title' => 'Brand Boost Broadcast', 'oBroadcast' => $oBroadcast, 'campaignTemplates' => $campaignTemplates, 'pagename' => $breadcrumb, 'campaignType' => $campaignType, 'moduleName' => $moduleName));
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
        $oAutomations = $this->mEmails->getEmailAutomations($userID);
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/sms/') . '" class="sidebar-control hidden-xs">SMS</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="SMS Overview" class="sidebar-control active hidden-xs ">Overview</a></li>
                    </ul>';
        $smsDetailSubs = $this->mSubscriber->smsDetailSubs($userID);
        $smsDetailAutomation = $this->mSubscriber->smsDetailAutomation($userID);
        $smsDetailNPS = $this->mSubscriber->smsDetailNPS($userID);
        $smsDetailReferral = $this->mSubscriber->smsDetailReferral($userID);
        $smsDetailOnsite = $this->mSubscriber->smsDetailOnsite($userID);
        $smsDetailChat = $this->mSubscriber->smsDetailChat($userMobile);
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
     * Used to edit email/sms broadcast campaign
     * @param type $id
     */
    public function edit(Request $request, $id = 0) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        $oLists = $mBroadcast->getMyLists($userID);
        $twillioData = $mBroadcast->getTwillioData($userID);
        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $id);
        if (empty($oBroadcast)) {
            redirect("admin/broadcast/email");
            exit;
        }

        $moduleName = 'broadcast';
        if ($id > 0) {
            $oEvents = $this->mWorkflow->getWorkflowEvents($id, $moduleName);
            if (!empty($oEvents)) {
                $eventID = $oEvents[0]->id;
                if ($eventID > 0) {
                    $oCampaign = $this->mWorkflow->getEventCampaign($eventID, $moduleName);
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
        $oAutomationLists = $this->mLists->getAutomationLists($id);
        $oCampaignContacts = $mBroadcast->getBroadcastContacts($id);
        $oCampaignTags = $mBroadcast->getBroadcastTags($id);
        $broadcastSettings = $mBroadcast->getBroadcastSettings($oBroadcast[0]->id);
        $subscribersData = $this->mSubscriber->getGlobalSubscribers($userID);
        $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($id);
        $aTags = $this->mTag->getClientTags($userID);
        //pre($broadcastSettings);
        //die;
        $activeTab = $this->session->userdata("setTab");
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

        //$oDefaultTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName);
        $oDefaultTemplates = $this->mTemplates->getCommonTemplates('', '', '', strtolower($oBroadcast[0]->campaign_type));
        $oTemplates = $oDefaultTemplates;
        $oUserTemplates = $this->mTemplates->getCommonTemplates($userID, '', '', strtolower($oBroadcast[0]->campaign_type));
        $oDraftTemplates = $this->mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID);
        $oCategories = $this->mWorkflow->getWorkflowTemplateCategories($moduleName);

        //Get Campaign list subscribers
        $oTotalSubscribers = $mBroadcast->getBroadcastListSubscribers($id);


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

        $oCampaignExcludedLists = $this->mLists->getAutomationExcludedLists($id);
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




        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/') . '" class="sidebar-control hidden-xs">Broadcast </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="' . $oBroadcast[0]->title . '" class="sidebar-control active hidden-xs ">' . $oBroadcast[0]->title . '</a></li>
                    </ul>';

        //pre($oCampaign);


        $aData = array(
            'title' => 'Brand Boost Broadcast',
            'oBroadcast' => $oBroadcast[0],
            'oVariations' => $oVariations,
            'campaignTemplates' => $campaignTemplates,
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
            'sImportButtons' => $sImportButtons,
            'sImportButtonsSummary' => $sImportButtonsSummary,
            'sExcludButtons' => $sExcludButtons,
            'sExcludButtonsSummary' => $sExcludButtonsSummary,
            'importedCount' => $importedCount,
            'exportedCount' => $exportedCount,
            'moduleName' => 'broadcast',
            'broadcastSettings' => $broadcastSettings[0],
            'userData' => $aUser,
            'twillioData' => $twillioData[0],
            'pagename' => $breadcrumb,
            'oCampaign' => $oCampaign,
            'campaignType' => $campaignType,
            'bExpired' => $bExpired
        );

        return view('admin.broadcast.setup', $aData);
    }

    
    /**
     * Used to add Variations in broadcast campaign
     */
    public function addVariation(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
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
                $oDraftTemplates = $this->mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID);
                $aData = array(
                    'oDraftTemplates' => $oDraftTemplates,
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $userID = $aUser->id;
        
        if (!empty($request)) {
            $fieldName = strip_tags($request->fieldName);
            $fieldValue = strip_tags($request->fieldVal);
            $eventId = strip_tags($request->event_id);
            $campaignId = strip_tags($request->campaign_id);
            $broadcastID = strip_tags($request->broadcast_id);
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

                        $oVariations = $this->mWorkflow->getWorkflowSplitVariations($moduleName, $broadcastID);
                        if (!empty($oVariations)) {
                            $campaignID = $oVariations[0]->id;
                        }
                        $aData = array(
                            'subject' => $fieldValue
                        );
                        $this->mWorkflow->updateWorkflowSplitCampaign($aData, $campaignID, $moduleName);
                    } else {
                        $aData = array(
                            $fieldName => $fieldValue
                        );
                        $this->mWorkflow->updateWorkflowSplitCampaign($aData, '', $moduleName, $broadcastID);
                    }
                }
            }

            if ($campaignId > 0) {

                if (in_array($fieldName, array('text_version_email', 'enable_mobile_responsiveness', 'read_tracking', 'link_tracking', 'reply_tracking', 'google_analytics', 'campaign_archives'))) {
                    $aBroadcastSettingsData[$fieldName] = $fieldValue;
                }

                if (!empty($aBroadcastSettingsData)) {
                    $broadcastSettings = $mBroadcast->getBroadcastSettings($campaignId);
                    if ($broadcastSettings[0]->id > 0) {
                        $bUpdated = $mBroadcast->updateBroadcastSettings($aBroadcastSettingsData, $campaignId);
                    } else {
                        $aBroadcastSettingsData['campaign_id'] = $campaignId;
                        $bUpdated = $mBroadcast->addBroadcastSettings($aBroadcastSettingsData);
                    }
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
                    $oTemplate = $this->mTemplates->getCommonTemplateInfo($templateID);
                    //pre($oDraft);
                    //die;
                    $aData['template_source'] = $fieldValue;
                    $aData['subject'] = $oTemplate->template_subject;
                    $aData['stripo_compiled_html'] = $oTemplate->stripo_compiled_html;
                    $aData['stripo_html'] = $oTemplate->stripo_html;
                    $aData['stripo_css'] = $oTemplate->stripo_css;
                    $aData['html'] = $oTemplate->html;
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        if (!empty($request)) {
            $broadcastID = strip_tags($request->broadcastId);
            //Sync Import/Exclude Properties

            if ($broadcastID > 0) {
                $this->syncBroadcastAudience($broadcastID);
                $oBroadcastSubscriber = $mBroadcast->getBroadcastSubscribers($broadcastID);
                $aData = array('oBroadcastSubscriber' => $oBroadcastSubscriber);

                $content = view('admin.broadcast.partials.broadcast_audience', $aData)->render();
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
            $oCategorizedTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName, $campaignType, '', $categoryID);
        } else if ($actionName == 'draft') {
            $oCategorizedTemplates = $this->mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID, $campaignType);
            $source = 'draft';
        } else if ($actionName == 'all') {
            $oCategorizedTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName, $campaignType);
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $response = array();
        

        $subscriberID = strip_tags($request->subscriber_id);
        $broadcastId = strip_tags($request->broadcast_id);

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
        
        //Instanciate Broadcast model to get its methods and properties
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
        $oAutomations = $this->mEmails->getEmailAutomations($userID, $id);


        //get Lists
        $oLists = $this->mLists->getLists($userID);

        //get Automation Events
        $oEvents = $this->mEmails->getAutomationEvents($id);

        //get Automation Lists
        $oAutomationLists = $this->mLists->getAutomationLists($id);

        //get Default Email Templates
        $oDefaultTemplates = $this->mEmails->getEmailMoudleTemplates(0, 'email'); //empty or 0 for default templates
        //get Default Other Email Templates
        $oUsedOtherTemplates = $this->mEmails->getEmailMoudleTemplates($userID, 'email'); // for own other templates
        //get Default Sms Templates
        $oDefaultSMSTemplates = $this->mEmails->getEmailMoudleTemplates(0, 'sms'); //empty or 0 for default templates
        //get Default Other Sms Templates
        $oUsedOtherSMSTemplates = $this->mEmails->getEmailMoudleTemplates($userID, 'sms'); // for own other templates


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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        //Imported Properites
        //Lists
        $aBroadcastSubscribers = array();
        $oAutomationLists = $this->mLists->getAutomationLists($broadcastID);
        if (!empty($oAutomationLists)) {

            foreach ($oAutomationLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $this->mLists->getListContacts($userID, $iListID);
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
                $oTagSubscribers = $this->mSubscriber->getTagSubscribers($tagId);
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
        $oCampaignExcludedLists = $this->mLists->getAutomationExcludedLists($broadcastID);
        if (!empty($oCampaignExcludedLists)) {
            $aListIDs = array();
            foreach ($oCampaignExcludedLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $this->mLists->getListContacts($userID, $iListID);
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
                $oTagSubscribers = $this->mSubscriber->getTagSubscribers($tagId);
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        //Imported Properites
        //Lists
        $aBroadcastSubscribers = array();
        $oAutomationLists = $this->mLists->getAutomationLists($broadcastID);
        if (!empty($oAutomationLists)) {

            foreach ($oAutomationLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $this->mLists->getListContacts($userID, $iListID);
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
                $oTagSubscribers = $this->mSubscriber->getTagSubscribers($tagId);
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
        $oCampaignExcludedLists = $this->mLists->getAutomationExcludedLists($broadcastID);
        if (!empty($oCampaignExcludedLists)) {
            $aListIDs = array();
            foreach ($oCampaignExcludedLists as $oAutomationList) {
                $aListIDs[] = $oAutomationList->list_id;
            }


            //Get Unique Subscribers from each lists
            if (!empty($aListIDs)) {
                foreach ($aListIDs as $iListID) {
                    $oListSubscribers = $this->mLists->getListContacts($userID, $iListID);
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
                $oTagSubscribers = $this->mSubscriber->getTagSubscribers($tagId);
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
            $mBroadcast->addTagToCampaign($aData);
            //Get Tag Subscribers
            /* $oTagSubscribers = $this->mSubscriber->getTagSubscribers($tagId);
              if (!empty($oTagSubscribers)) {
              foreach ($oTagSubscribers as $oSubscriber) {
              $subscriberID = $oSubscriber->id;
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
            $mBroadcast->deleteTagToCampaign($automationID, $tagId);
            $oTagSubscribers = $this->mSubscriber->getTagSubscribers($tagId);
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $aSelectedLists = $request->selectedLists;
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $this->mEmails->updateAutomationList($automationID, $aSelectedLists);
            /* $oListSubscribers = $this->mLists->getListContacts($userID, $aSelectedLists);
              if (!empty($oListSubscribers)) {
              foreach ($oListSubscribers as $oSubscriber) {
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
            $this->mEmails->deleteAutomationLists($automationID, $aSelectedLists);
            $oListSubscribers = $this->mLists->getListContacts($userID, $aSelectedLists);
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        $aSelectedLists = $request->selectedLists;
        $actionValue = $request->actionValue;
        $automationID = $request->automation_id;
        if ($actionValue == 'addRecord') {
            $this->mEmails->updateAutomationExcludedList($automationID, $aSelectedLists);
            /* $oListSubscribers = $this->mLists->getListContacts($userID, $aSelectedLists);
              if (!empty($oListSubscribers)) {
              foreach ($oListSubscribers as $oSubscriber) {
              $subscriberID = $oSubscriber->subscriber_id;
              $mBroadcast->deleteAudienceToBraodcast($automationID, $subscriberID);
              }
              } */
        } else {
            $this->mEmails->deleteAutomationExcludedLists($automationID, $aSelectedLists);
            //$this->syncBroadcastAudience($automationID);
        }

        //Get Campaign list subscribers
        $oTotalSubscribers = $mBroadcast->getBroadcastExcludedListSubscribers($automationID);


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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        $response = array();
        
        $broadcastId = $request->edit_broadcastId;
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $response = array();
        
        $eventId = strip_tags($request->event_id);
        $campaignId = strip_tags($request->campaign_id);
        $broadcastID = strip_tags($request->broadcast_id);
        Session::put("setTab", trim($request->tab));

        $deliveryDate = strip_tags($request->delivery_date);
        $deliveryTime = strip_tags($request->delivery_time);

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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $response = array();
        
        $broadcastId = $request->automation_id;

        $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastId);
        $oBroadcast = $oBroadcast[0];
        $oldEventID = $oBroadcast->evtid;

        $broadcastSettings = $mBroadcast->getBroadcastSettings($oBroadcast->id);
        $broadcastSettings = $broadcastSettings[0];


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
                $oCampaigns = $this->mWorkflow->getEventCampaign($oldEventID, $moduleName);
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
        $textVersionEmail = $broadcastSettings->text_version_email;
        $enableMobileResponsiveness = $broadcastSettings->enable_mobile_responsiveness;
        $readTracking = $broadcastSettings->read_tracking;
        $linkTracking = $broadcastSettings->link_tracking;
        $replyTracking = $broadcastSettings->reply_tracking;
        $googleAnalytics = $broadcastSettings->google_analytics;
        $campaignArchives = $broadcastSettings->campaign_archives;

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

        /* $oAutomationLists = $this->mLists->getAutomationLists($broadcastId);
          foreach ($oAutomationLists as $listData) {
          $this->mEmails->updateAutomationList($broadcastID, $listData->list_id);
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
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

    public function mysegments() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $oSegments = $mBroadcast->getSegments($userID);
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/broadcast/emails') . '" class="sidebar-control hidden-xs">Broadcast </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="My Segments" class="sidebar-control active hidden-xs ">My Segments</a></li>
                    </ul>';

        $aData = array(
            'title' => 'My Segments',
            'oSegments' => $oSegments,
            'pagename' => $breadcrumb
        );

        return view('admin.broadcast.segments', $aData);
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $segment_id = $request->segment_id;
        $oSegments = $mBroadcast->getSegmentById($userID, $segment_id);

        if (!empty($oSegments)) {
            $response = array('status' => 'success', 'title' => $oSegments[0]->segment_name, 'description' => $oSegments[0]->segment_desc);
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
        
        //Instanciate Broadcast model to get its methods and properties
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

        /* $bAlreadyExists = $this->mLists->checkIfListExists($title, $userID, $listID);
          if ($bAlreadyExists == true) {
          $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'List name already exists');
          echo json_encode($response);
          exit;
          } */

        $userDetail = $this->mUser->getAllUsers($userID);
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
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
            'title' => 'Segment Contacts',
            'oSubscribers' => $oSubscribers,
            'moduleName' => 'people',
            'pagename' => $breadcrumb
        );

        return view('admin.broadcast.segment_subscribers', $aData);
    }

    
    /**
     * Used to delete segments in bulk
     */
    public function deleteMultipalSegment(Request $request) {
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        //$userID = $this->session->userdata("current_user_id");
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
     * Used to create segments
     */
    public function createSegment(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
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
            $oEvents = $this->mWorkflow->getWorkflowEvents($broadcastID, 'broadcast');
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
                        $oTemplate = $this->mTemplates->getCommonTemplateInfo($templateID);
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
                        $bUpdated = $this->mWorkflow->updateWorkflowCampaign($aUpdateData, $campaignID, $moduleName);
                        if ($bUpdated) {

                            if ($bHaveVariations == true) {
                                //Update Default Variation too
                                $aData = array(
                                    'subject' => $oTemplate->subject,
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
                        $bAdded = $this->mWorkflow->addWorkflowCampaign($eventID, $templateID, $broadcastID, 'broadcast', $isDraft);
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
                $sEditorContent = view('admin.broadcast.partials.template_design_sms_ajax.php', $aEditorData)->render();
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        
        if (!empty($request)) {
            $campaignID = strip_tags($request->campaign_id);
            $moduleName = 'broadcast';
            $oResponse = $this->mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
                    <li><a class="sidebar-control hidden-xs"">Broadcast</a></li>
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        
        $response = array();
        
        if (!empty($request)) {
            
            $broadcastID = strip_tags($request->broadcastId);
            $oCampaignLists = $this->mLists->getAutomationLists($broadcastID);
            $oCampaignContacts = $mBroadcast->getBroadcastContacts($broadcastID);
            $oCampaignTags = $mBroadcast->getBroadcastTags($broadcastID);
            $aTags = $this->mTag->getClientTags($userID);
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
        
        //Instanciate Broadcast model to get its methods and properties
        $mBroadcast = new BroadcastModel();
        
        $response = array();
        
        if (!empty($request)) {
            
            $broadcastID = strip_tags($request->broadcastId);
            $oCampaignLists = $this->mLists->getAutomationExcludedLists($broadcastID);
            $oCampaignContacts = $mBroadcast->getBroadcastExcludedContacts($broadcastID);
            $oCampaignTags = $mBroadcast->getBroadcastExcludedTags($broadcastID);
            $aTags = $this->mTag->getClientTags($userID);
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
                
                //Instanciate Broadcast model to get its methods and properties
                $mBroadcast = new BroadcastModel();
        
        
                $oLists = $mBroadcast->getMyLists($userID);
                $twillioData = $mBroadcast->getTwillioData($userID);
                $oBroadcast = $mBroadcast->getMyBroadcasts($userID, $broadcastID);
                $oSegments = $mBroadcast->getSegments($userID);
                $broadcastSettings = $mBroadcast->getBroadcastSettings($oBroadcast[0]->id);
                $subscribersData = $this->mSubscriber->getGlobalSubscribers($userID);
                $aTags = $this->mTag->getClientTags($userID);
                $moduleName = 'broadcast';
                $oDefaultTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName);
                $oDraftTemplates = $this->mWorkflow->getWorkflowDraftTemplates($moduleName, '', $userID);
                $oCategories = $this->mWorkflow->getWorkflowTemplateCategories($moduleName);



                if ($broadcastID > 0) {
                    $oEvents = $this->mWorkflow->getWorkflowEvents($broadcastID, $moduleName);
                    if (!empty($oEvents)) {
                        $eventID = $oEvents[0]->id;
                        if ($eventID > 0) {
                            $oCampaign = $this->mWorkflow->getEventCampaign($eventID, $moduleName);
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

                    $oAutomationLists = $this->mLists->getAutomationLists($broadcastID);
                    $oCampaignContacts = $mBroadcast->getBroadcastContacts($broadcastID);
                    $oCampaignTags = $mBroadcast->getBroadcastTags($broadcastID);
                    $oCampaignSegments = $mBroadcast->getBroadcastSegments($broadcastID);
                }

                if ($actionType == 'exclude') {
                    //Get Campaign list subscribers
                    $oTotalSubscribers = $mBroadcast->getBroadcastExcludedListSubscribers($broadcastID);


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

                    $oAutomationLists = $this->mLists->getAutomationExcludedLists($broadcastID);
                    $oCampaignContacts = $mBroadcast->getBroadcastExcludedContacts($broadcastID);
                    $oCampaignTags = $mBroadcast->getBroadcastExcludedTags($broadcastID);
                    $oCampaignSegments = $mBroadcast->getBroadcastExcludedSegments($broadcastID);
                }

                $aData = array(
                    'oBroadcast' => $oBroadcast[0],
                    'campaignTemplates' => $campaignTemplates,
                    'oDefaultTemplates' => $oDefaultTemplates,
                    'oDraftTemplates' => $oDraftTemplates,
                    'oCategories' => $oCategories,
                    'oLists' => $oLists,
                    'subscribersData' => $subscribersData,
                    'oCampaignContacts' => $oCampaignContacts,
                    'oCampaignTags' => $oCampaignTags,
                    'oCampaignSegments' => $oCampaignSegments,
                    'totalSubscribers' => $totalSubscribers,
                    'duplicateSubscriber' => $duplicateCount,
                    'aTags' => $aTags,
                    'oSegments' => $oSegments,
                    'oAutomationLists' => $oAutomationLists,
                    'activeTab' => $activeTab,
                    'broadcast_id' => $id,
                    'moduleName' => 'broadcast',
                    'broadcastSettings' => $broadcastSettings[0],
                    'userData' => $aUser,
                    'twillioData' => $twillioData[0],
                    'oCampaign' => $oCampaign
                );
            }

            if ($actionType == 'import' && $audienceType == 'lists') {

                $content = view('admin.components.smart-popup.broadcast-import-lists', $aData)->render();
            } else if ($actionType == 'import' && $audienceType == 'contacts') {
                $content = view("admin/components/smart-popup/broadcast-import-contacts", $aData)->render();
            } else if ($actionType == 'import' && $audienceType == 'segments') {
                $content = view("admin/components/smart-popup/broadcast-import-segments", $aData)->render();
            } else if ($actionType == 'import' && $audienceType == 'tags') {
                $content = view("admin/components/smart-popup/broadcast-import-tags", $aData)->render();
            } else if ($actionType == 'exclude' && $audienceType == 'lists') {
                $content = view("admin/components/smart-popup/broadcast-exclude-lists", $aData)->render();
            } else if ($actionType == 'exclude' && $audienceType == 'contacts') {
                $content = view("admin/components/smart-popup/broadcast-exclude-contacts", $aData)->render();
            } else if ($actionType == 'exclude' && $audienceType == 'segments') {
                $content = view("admin/components/smart-popup/broadcast-exclude-segments", $aData)->render();
            } else if ($actionType == 'exclude' && $audienceType == 'tags') {
                $content = view("admin/components/smart-popup/broadcast-exclude-tags", $aData)->render();
            }

            $response['status'] = 'success';
            $response['content'] = $content;
        }
        echo json_encode($response);
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
        
        //Instanciate Broadcast model to get its methods and properties
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
        
        //Instanciate Broadcast model to get its methods and properties
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
