<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UsersModel;
use App\Models\Admin\ListsModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\TemplatesModel;
use App\Models\Admin\Modules\EmailsModel;
use Cookie;
use Session;

class Emails extends Controller {

    /**
     * Get overview of Email module
     */
    public function overview() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $mEmails = new EmailsModel();
        $oAutomations = $mEmails->getEmailAutomations($userID);
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $oEvents = $mEmails->getAllAutomationEvents($userID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/emails/') . '" class="sidebar-control hidden-xs">Email</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Email Overview" class="sidebar-control active hidden-xs ">Overview</a></li>
                    </ul>';
        $aData = array(
            'title' => 'Email Overview',
            'pagename' => $breadcrumb,
            'oAutomations' => $oAutomations,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'oEvents' => $oEvents,
            'moduleName' => 'automation'
        );

        return view('admin.modules.emails.overview', $aData);
    }

    /**
     * Basic default page for the email module
     */
    public function index() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $mEmails = new EmailsModel();
        $oAutomations = $mEmails->getEmailAutomations($userID, '', 'email');
        $bActiveSubsription = UsersModel::isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Email </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Automations" class="sidebar-control active hidden-xs ">Automations</a></li>
                    </ul>';
        $aData = array(
            'title' => 'Email Automations',
            'pagename' => $breadcrumb,
            'oAutomations' => $oAutomations,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'moduleName' => 'automation',
            'automation_type' => 'email'
        );

        return view('admin.modules.emails.index', $aData);
    }

    /**
     * This method is used to setup or configure an Email automation
     * @param Request $request
     */
    public function setupAutomation(Request $request) {
        $id = $request->id;
        if (empty($id)) {
            redirect("/admin/modules/emails");
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $mEmails = new EmailsModel();
        $mLists = new ListsModel();
        $mWorkflow = new WorkflowModel();
        $mTemplates = new TemplatesModel();
        $bActiveSubsription = UsersModel::isActiveSubscription();
        //get Automation Info
        $oAutomations = $mEmails->getEmailAutomations($userID, $id);
        if (empty($oAutomations)) {
            redirect("/admin/modules/emails");
            exit;
        }

        $automationType = $oAutomations[0]->automation_type;
        //get Lists
        $oLists = $mLists->getLists($userID, '', 'active');

        //get Automation Events
        $oEvents = $mEmails->getAutomationEvents($id);

        //get Automation Lists
        $oAutomationLists = $mLists->getAutomationLists($id);

        $moduleName = 'automation';
        $oEvents = $mWorkflow->getWorkflowEvents($id, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
        $oTemplates = $mTemplates->getCommonTemplates();
        $oDraftTemplates = $mTemplates->getCommonDraftTemplates($userID, '');
        $oCategories = $mTemplates->getCommonTemplateCategories();


        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>';
        if ($automationType == 'email') {
            $breadcrumb .= '<li><a href="' . base_url('admin/modules/emails/') . '" class="sidebar-control hidden-xs">Email Automations </a></li><li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>';
        }

        if ($automationType == 'sms') {
            $breadcrumb .= '<li><a href="' . base_url('admin/modules/emails/sms') . '" class="sidebar-control hidden-xs">Sms Automations </a></li><li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>';
        }
        $breadcrumb .= '<li><a data-toggle="tooltip" data-placement="bottom" title="Setup Automation" class="sidebar-control active hidden-xs ">Setup Automation</a></li>
                    </ul>';

        $pageData = array(
            'title' => 'Setup Email Automation',
            'pagename' => $breadcrumb,
            'bActiveSubsription' => $bActiveSubsription,
            'oAutomations' => $oAutomations,
            'oLists' => $oLists,
            'oAutomationLists' => $oAutomationLists,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $id,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oTemplates' => $oTemplates,
            'oDraftTemplates' => $oDraftTemplates,
            'oCategories' => $oCategories,
            'oUser' => $oUser,
            'automation_type' => $automationType
        );
        
        return view('admin.modules.emails.email-workflow-beta', $pageData);
        
    }

    /**
     * 
     * @return type
     */
    public function sms() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        $mEmails = new EmailsModel();
        
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $oAutomations = $mEmails->getEmailAutomations($userID, '', 'sms');
        $bActiveSubsription = UsersModel::isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">SMS </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Automations" class="sidebar-control active hidden-xs ">Automations</a></li>
                    </ul>';
        $aData = array(
            'title' => 'SMS Automations',
            'pagename' => $breadcrumb,
            'oAutomations' => $oAutomations,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role,
            'moduleName' => 'automation',
            'type' => 'sms',
            'automation_type' => 'sms'
        );

        return view('admin.modules.emails.index', $aData);
    }

    
    /**
     * 
     * @param type $id
     */
    public function setupSMSAutomation($id = '') {
        if (empty($id)) {
            redirect("admin/modules/emails/sms");
            exit;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $bActiveSubsription = UsersModel::isActiveSubscription();
        //get Automation Info
        $oAutomations = $mEmails->getEmailAutomations($userID, $id);

        //get Lists
        $oLists = $mLists->getLists($userID, '', 'active');

        //get Automation Events
        $oEvents = $mEmails->getAutomationEvents($id);

        //get Automation Lists
        $oAutomationLists = $mLists->getAutomationLists($id);


        $moduleName = 'automation';
        $oEvents = $this->mWorkflow->getWorkflowEvents($id, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = $this->mWorkflow->getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/emails/') . '" class="sidebar-control hidden-xs">Email Automations </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup Automation" class="sidebar-control active hidden-xs ">Setup Automation</a></li>
                    </ul>';

        $pageData = array(
            'title' => 'Setup SMS Automation',
            'pagename' => $breadcrumb,
            'bActiveSubsription' => $bActiveSubsription,
            'oAutomations' => $oAutomations,
            'oLists' => $oLists,
            'oAutomationLists' => $oAutomationLists,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $id,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'type' => 'sms',
            'oUser' => $oUser
        );

        return view('admin.modules.emails.email-workflow-beta', $pageData);
    }

    
    /**
     * 
     */
    public function automationStats(Request $request) {
        $id = $request->id;
        if (empty($id)) {
            redirect("admin/modules/emails");
            exit;
        }
        
        $mLists = new ListsModel();
        
        //Instanciate Email model to get its methods and properties
        $mEmails = new EmailsModel();
        
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $type = $request->type;

        $bActiveSubsription = UsersModel::isActiveSubscription();
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
        $breadcrumb .= '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>';
        $breadcrumb .= '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
        if (!empty($type)) {
            $breadcrumb .= '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/broadcast') . '">Email Broadcast</a></li>';
            $breadcrumb .= '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
        } else {
            $breadcrumb .= '<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/emails/') . '">>Email Automations</a></li>';
            $breadcrumb .= '<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>';
        }
        $breadcrumb .= '<li><a class="sidebar-control hidden-xs">Automation Stats</a></li>';
        $breadcrumb .= '</ul>';

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

        return view('admin.modules.emails.email-stats', $pageData)->with(['mEmails' => $mEmails]);
    }

    /**
     * 
     * @param Request $request
     */
    public function addAutiomation(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        
        //Instanciate Email model to get its methods and properties
        $mEmails = new EmailsModel();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $title = $request->title;
        $description = $request->description;
        $automation_type = $request->automation_type;
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'title' => !empty($title) ? $title : '',
            'description' => !empty($description) ? $description : '',
            'email_type' => 'automation',
            'automation_type' => $automation_type,
            'user_id' => $userID,
            'created' => $dateTime
        );

        $bAlreadyExists = $mEmails->checkIfEmailAutomationExists($title, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'Automation name already exists');
            echo json_encode($response);
            exit;
        }

        $insertID = $mEmails->addEmailAutomation($aData);
        if ($insertID > 0) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'module_email',
                'action_name' => 'automation_added',
                'automation_id' => $insertID,
                'list_id' => '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Added a new email automation',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'id' => $insertID, 'msg' => "Email Automation added successfully!");

            $notificationData = array(
                'event_type' => 'added_email_automation',
                'event_id' => 0,
                'link' => base_url() . 'admin/modules/emails/setupAutiomation/' . $insertID,
                'message' => 'Created new email automation.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_automation_added';
            @add_notifications($notificationData, $eventName, $userID);
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * 
     */
    public function getAutomation(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        //Instanciate Email model to get its methods and properties
        $mEmails = new EmailsModel();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $automationID = $request->automation_id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $oAutomation = $mEmails->getEmailAutomations($userID, $automationID);
        if (!empty($oAutomation)) {
            $response = array('status' => 'success', 'id' => $oAutomation[0]->id, 'title' => $oAutomation[0]->title, 'description' => $oAutomation[0]->description);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
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
        //Instanciate Email model to get its methods and properties
        $mEmails = new EmailsModel();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $automationID = $request->automation_id;
        $title = $request->title;
        $description = $request->description;
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'title' => $title,
            'description' => $description
        );

        $bAlreadyExists = $mEmails->checkIfEmailAutomationExists($title, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'Automation title already exists');
            echo json_encode($response);
            exit;
        }

        $bUpdated = $mEmails->updateEmailAutomation($aData, $automationID, $userID);
        if ($bUpdated) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'module_email',
                'action_name' => 'automation_updated',
                'automation_id' => $automationID,
                'list_id' => '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Updated email automation',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'id' => $automationID, 'msg' => "Automation updated successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * 
     */
    public function publishAutomationEvent(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Email model to get its methods and properties
        $mEmails = new EmailsModel();
        
        $automationID = $request->automation_id;
        $aData = array(
            'status' => 'active'
        );

        $bUpdated = $mEmails->publishAutomationEvent($aData, $automationID, $userID);


        if ($bUpdated) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'module_email',
                'action_name' => 'automation_updated',
                'automation_id' => $automationID,
                'list_id' => '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Publish email automation event',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'id' => $automationID, 'msg' => "Automation updated successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * 
     */
    public function publishAsDraft(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Email model to get its methods and properties
        $mEmails = new EmailsModel();
        
        $automationID = strip_tags($request->automation_id);
        $aData = array(
            'status' => 'draft'
        );

        $bUpdated = $mEmails->publishAutomationEvent($aData, $automationID, $userID);


        if ($bUpdated) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'module_email',
                'action_name' => 'automation_updated',
                'automation_id' => $automationID,
                'list_id' => '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Saved automation campaign as a draft',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'id' => $automationID, 'msg' => "Automation updated successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * 
     */
    public function addAutomationFollowup() {
        //This would work just like linked list
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $bCampaignExists = true;
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $templateID = strip_tags($post['template_id']);
        $automationID = strip_tags($post['automation_id']);
        $previousEventID = strip_tags($post['previous_event_id']);
        $currentEventID = strip_tags($post['current_event_id']);
        $eventType = strip_tags($post['event_type']);

        if ($templateID > 0) {
            $oTemplate = $mEmails->getEmailMoudleTemplateInfo($templateID);
            if (!empty($oTemplate)) {
                $templateName = $oTemplate->template_name;
                $campaignType = ucfirst($oTemplate->template_type);
                $subject = $oTemplate->template_subject;
                $content = $oTemplate->template_content;
                $from = $aUser->email;
                $fromName = $aUser->firstname . ' ' . $aUser->lastname;
                $replyTo = $from;

                $aCampaignData = array(
                    'event_id' => $eventID,
                    'content_type' => ($campaignType == 'Email') ? 'Regular' : 'Plain Text',
                    'campaign_type' => $campaignType,
                    'name' => $templateName,
                    'subject' => $subject,
                    'html' => $content,
                    'template_source' => $templateID,
                    'from_email' => $from,
                    'from_name' => $fromName,
                    'reply_to' => $replyTo,
                    'status' => 'draft',
                    'created' => date("Y-m-d H:i:s")
                );
            }
        }

        $aEventData = array(
            'automation_id' => $automationID,
            'event_type' => 'followup',
            'data' => json_encode(array("delay_type" => 'after', "delay_value" => '10', "delay_unit" => 'minute')),
            'previous_event_id' => $currentEventID,
            'status' => 'active',
            'created' => date("Y-m-d H:i:s")
        );


        if ($eventType == 'main') {
            if ($currentEventID > 0) {
                //Event already exists lets check if main campaign exists
                $oMainCampaign = $mEmails->getEmailCampaignInfo($currentEventID);
                if (!empty($oMainCampaign)) {
                    //This is just the concept of Linked list
                    //Main campaign exisits
                    //now we turn this main campaign to new followup campaign because we are going to add a new main campaign
                    //get Main Campaign ID
                    //
                    //Step-1 Get Followup Node Info(header of the linked node)
                    $oFollowupEvent = $mEmails->getEmailAutomationEventByPreviousID($currentEventID);
                    $followupEventID = $oFollowupEvent->id;
                    $mainCampaignID = $oMainCampaign->id;
                    $aCampaignData['event_id'] = $currentEventID;
                    $campaignID = $mEmails->addEmailAutomationCampaign($aCampaignData);
                    //Step-2 Add Followup (new linked node)
                    $aEventData['previous_event_id'] = $currentEventID;
                    $eventID = $mEmails->addEmailAutomationEvent($aEventData);
                    //Step-3 Update old Main Campaign
                    $aUpdateData = array(
                        'event_id' => $eventID
                    );
                    $bUpdated = $mEmails->updateEmailAutomationCampaign($aUpdateData, $mainCampaignID);

                    //Step-4 Update new followup address into the next followup header
                    $aLinkedData = array(
                        'previous_event_id' => $eventID
                    );

                    $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $followupEventID);

                    $aLinkedData = array(
                        'status' => 'draft'
                    );
                    $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $currentEventID);

                    $response = array('status' => 'success', 'msg' => "Added successfully");
                    if ($campaignID) {
                        $response['campaignId'] = $campaignID;
                        $response['temp_subject'] = $subject;
                        $response['temp_content'] = base64_decode($content);
                    }
                } else {
                    //Main campaign do not existis
                    //Add a new campaign with main event id
                    $aCampaignData['event_id'] = $currentEventID;
                    $campaignID = $mEmails->addEmailAutomationCampaign($aCampaignData);
                    $response = array('status' => 'success', 'msg' => "Added successfully");
                    if ($campaignID) {
                        $response['campaignId'] = $campaignID;
                        $response['temp_subject'] = $subject;
                        $response['temp_content'] = base64_decode($content);
                    }
                }
            }
        } else if ($eventType == 'followup') {
            //Step-1 Get Next Node information
            $oFollowupEvent = $mEmails->getEmailAutomationEventByPreviousID($currentEventID);
            $followupEventID = $oFollowupEvent->id;
            //Step-2 Create New Node followup
            $aEventData['previous_event_id'] = $currentEventID;
            $eventID = $mEmails->addEmailAutomationEvent($aEventData);
            //Step-3 Create New followup Campaign
            $aCampaignData['event_id'] = $eventID;
            $campaignID = $mEmails->addEmailAutomationCampaign($aCampaignData);
            //Step-4 Update new followup address into the next followup header
            if (!empty($oFollowupEvent)) {
                $aLinkedData = array(
                    'previous_event_id' => $eventID
                );

                $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $followupEventID);
            }
            $aLinkedData = array(
                'status' => 'draft'
            );
            $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $eventID);
            $response = array('status' => 'success', 'msg' => "Added successfully");
            if ($campaignID) {
                $response['campaignId'] = $campaignID;
                $response['temp_subject'] = $subject;
                $response['temp_content'] = base64_decode($content);
            }
        }

        echo json_encode($response);
        exit;


        if (empty($previousEventID) || ($previousEventID == 0)) {
            //check if campaing added
            $bCampaignExists = $mEmails->getEmailCampaignInfo($currentEventID);
        }

        if ($templateID > 0) {
            $oTemplate = $mEmails->getEmailMoudleTemplateInfo($templateID);
            //pre($oTemplate);
            //die;
            if (!empty($oTemplate)) {
                $templateName = $oTemplate->template_name;
                $campaignType = ucfirst($oTemplate->template_type);
                $subject = $oTemplate->template_subject;
                $content = $oTemplate->template_content;
                $from = $aUser->email;
                $fromName = $aUser->firstname . ' ' . $aUser->lastname;
                $replyTo = $from;

                $aEventData = array(
                    'automation_id' => $automationID,
                    'event_type' => 'followup',
                    'data' => json_encode(array("delay_type" => 'after', "delay_value" => '10', "delay_unit" => 'minute')),
                    'previous_event_id' => $currentEventID,
                    'status' => 'draft',
                    'created' => date("Y-m-d H:i:s")
                );
                if ($bCampaignExists == true) {
                    $eventID = $mEmails->addEmailAutomationEvent($aEventData);
                } else {
                    $eventID = $currentEventID;
                }

                if ($eventID > 0) {
                    $aManageOrderData = array(
                        'previous_event_id' => $eventID
                    );
                    if ($bCampaignExists == true) {
                        //$mEmails->manageEmailAutomationEventOrder($aManageOrderData, $previousEventID, $eventID);
                    }

                    $aCampaignData = array(
                        'event_id' => $eventID,
                        'content_type' => ($campaignType == 'Email') ? 'Regular' : 'Plain Text',
                        'campaign_type' => $campaignType,
                        'name' => $templateName,
                        'subject' => $subject,
                        'html' => $content,
                        'template_source' => $templateID,
                        'from_email' => $from,
                        'from_name' => $fromName,
                        'reply_to' => $replyTo,
                        'status' => 1,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $campaignID = $mEmails->addEmailAutomationCampaign($aCampaignData);
                    //Add Segment Data 

                    $aSegmentData = array(
                        'auto_event_id' => $eventID,
                        'campaign_id' => $campaignID,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $mEmails->addEmailAutomationSegment($aSegmentData);

                    $response = array('status' => 'success', 'msg' => "Added successfully");
                    if ($campaignID) {
                        $response['campaignId'] = $campaignID;
                        $response['temp_subject'] = $subject;
                        $response['temp_content'] = base64_decode($content);
                    }
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * 
     */
    public function manageOrder($automationID, $firstEventID, $secondEventID) {
        
    }

    public function updateEmailAutomationEvent() {
        $response = array();
        $post = $this->input->post();

        $eventID = $post['event_id'];
        $delayValue = $post['delay_value'];
        $delayUnit = $post['delay_unit'];
        $eventType = $post['event_type'];
        $delayTime = $post['delay_time'];


        if ($eventID) {
            $eventData = array("delay_type" => "after", "delay_value" => $delayValue, "delay_unit" => $delayUnit, "event_type" => $eventType, "delay_time" => $delayTime);
            $eventData = json_encode($eventData);
            $eData = array(
                //'event_type' => 'follow-up',
                'data' => $eventData
            );

            $campaignId = $mEmails->updateEmailAutomationEvent($eData, $eventID);
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

    public function updateAutomationTrigger() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $selectedTrigger = $post['triggerName'];
        $automationID = strip_tags($post['automation_id']);
        $eventID = strip_tags($post['event_id']);
        $previousEventID = strip_tags($post['previous_event_id']);


        //Trigger Time

        $delayUnit = strip_tags($post['delay_unit']);
        $delayValue = strip_tags($post['delay_value']);
        $delayType = 'after';
        $delayTime = strip_tags($post['delay_time']);

        $triggerTime = array(
            'delay_type' => $delayType,
            'delay_value' => $delayValue,
            'delay_unit' => $delayUnit,
            'delay_time' => $delayTime
        );

        //For specific-datetime
        if ($selectedTrigger == 'specific-datetime') {
            $deliveryDate = $post['delivery_date'];
            $deliveryTime = $post['delivery_time'];
            $triggerTime = array(
                'delivery_date' => $deliveryDate,
                'delivery_time' => $deliveryTime
            );
        }

        $aData = array(
            'automation_id' => $automationID,
            'event_type' => $selectedTrigger,
            'data' => json_encode($triggerTime),
            'previous_event_id' => $previousEventID,
            'status' => 'draft'
        );

        if ($eventID > 0) {
            //Update
            $result = $mEmails->updateEmailAutomationEvent($aData, $eventID);
            $response = array('status' => 'success', 'msg' => "Trigger updated successfully!");
        } else {
            //Insert New Event
            $aData['created'] = date("Y-m-d H:i:s");
            $result = $mEmails->addEmailAutomationEvent($aData);
            $response = array('status' => 'success', 'msg' => "Trigger Added successfully!");
        }
        echo json_encode($response);
        exit;
    }

    public function updateAutomationLists() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $aSelectedLists = $post['selectedLists'];
        $automationID = strip_tags($post['automation_id']);
        if (!empty($aSelectedLists)) {
            $bDeleted = $mEmails->deleteAllAutomationLists($automationID);
            if ($bDeleted) {
                foreach ($aSelectedLists as $iListID) {
                    $mEmails->updateAutomationList($automationID, $iListID);
                }
            }
        }
        $response = array('status' => 'success', 'msg' => "List Added successfully!");
        echo json_encode($response);
        exit;
    }

    public function delete_event() {
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
            $currentNode = $mEmails->getEmailAutomationEvent($eventID);
            $currentNodePreviousID = $currentNode->previous_event_id;
            //Get Previous Node
            $previousNode = $mEmails->getEmailAutomationEvent($currentNodePreviousID);
            //Get Next Node
            $nextNode = $mEmails->getEmailAutomationEventByPreviousID($eventID);

            $bDeleted = $mEmails->deleteEmailAutomationEvent($eventID);
        }



        if ($bDeleted == true) {
            $aLinkedData = array('previous_event_id' => $previousNode->id);
            $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $nextNode->id);
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

    public function updateEventOrder() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $previousEventID = strip_tags($post['previous_id']);
        $currentEventID = strip_tags($post['current_id']);
        $nextEventID = strip_tags($post['next_id']);
        $actionName = strip_tags($post['action_name']);


        if ($actionName == 'attach') {

            //Step-1 
            if ($previousEventID > 0) {
                $bIsMainEvent = $mEmails->isMainEvent($currentEventID);
                if ($bIsMainEvent == false) {
                    $aLinkedData = array(
                        'previous_event_id' => $previousEventID
                    );
                    $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $currentEventID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }
            } else {
                //Main event, so no need to touch event. here we will shuffle in campaign records
                //Current Event
                //Next Event
                $oMainCampaign = $mEmails->getEmailCampaignInfo($nextEventID);
                $oCurrentCampaign = $mEmails->getEmailCampaignInfo($currentEventID);
                //Now we will interchange event ids between these two campaigns
                if (!empty($oMainCampaign)) {
                    $mainCampaignID = $oMainCampaign->id;
                    $aCampaignData = array(
                        'event_id' => $currentEventID
                    );
                    $bUpdated = $mEmails->updateEmailAutomationCampaign($aCampaignData, $mainCampaignID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }

                if (!empty($oCurrentCampaign)) {
                    $currentCampaignID = $oCurrentCampaign->id;
                    $aCampaignData = array(
                        'event_id' => $nextEventID
                    );
                    $bUpdated = $mEmails->updateEmailAutomationCampaign($aCampaignData, $currentCampaignID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }
            }


            //Step-2
            if ($nextEventID > 0 && $previousEventID > 0) {
                //Check if current node is the main event

                $bIsMainEvent = $mEmails->isMainEvent($currentEventID);
                if ($bIsMainEvent) {
                    //As main event, so we have to shuffle only in campaigns
                    //Current Event
                    //Next Event
                    $oMainCampaign = $mEmails->getEmailCampaignInfo($currentEventID);
                    $oPreviousCampaign = $mEmails->getEmailCampaignInfo($previousEventID);

                    //Now we will interchange event ids between these two campaigns
                    if (!empty($oMainCampaign)) {
                        $mainCampaignID = $oMainCampaign->id;
                        $aCampaignData = array(
                            'event_id' => $previousEventID
                        );
                        $bUpdated = $mEmails->updateEmailAutomationCampaign($aCampaignData, $mainCampaignID);
                        $response = array('status' => 'success', 'msg' => "updated successfully!");
                    }

                    if (!empty($oPreviousCampaign)) {
                        $previousCampaignID = $oPreviousCampaign->id;
                        $aCampaignData = array(
                            'event_id' => $currentEventID
                        );
                        $bUpdated = $mEmails->updateEmailAutomationCampaign($aCampaignData, $previousCampaignID);
                        $response = array('status' => 'success', 'msg' => "updated successfully!");
                    }
                } else {
                    $aLinkedData = array(
                        'previous_event_id' => $currentEventID
                    );
                    $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $nextEventID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }
            }
        } else if ($actionName == 'detach') {

            if ($previousEventID > 0 && $nextEventID > 0) {
                $bIsMainEvent = $mEmails->isMainEvent($previousEventID);
                if ($bIsMainEvent == false) {
                    $aLinkedData = array(
                        'previous_event_id' => $previousEventID
                    );
                    $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $nextEventID);
                }
            }
            $response = array('status' => 'success', 'msg' => "updated successfully!");
        }
        echo json_encode($response);
        exit;
    }

    public function updateEventOrderNew() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $previousEventID = strip_tags($post['previous_id']);
        $currentEventID = strip_tags($post['current_id']);
        $nextEventID = strip_tags($post['next_id']);
        $actionName = strip_tags($post['action_name']);


        if ($actionName == 'attach') {
            if (empty($previousEventID)) {
                //Main Node
                //Main event, so no need to touch event. here we will shuffle in campaign records
                $oMainCampaign = $mEmails->getEmailCampaignInfo($nextEventID);
                $oCurrentCampaign = $mEmails->getEmailCampaignInfo($currentEventID);
                //Now we will interchange event ids between these two campaigns
                if (!empty($oMainCampaign)) {
                    $mainCampaignID = $oMainCampaign->id;
                    $aCampaignData = array(
                        'event_id' => $currentEventID
                    );
                    $bUpdated = $mEmails->updateEmailAutomationCampaign($aCampaignData, $mainCampaignID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }

                if (!empty($oCurrentCampaign)) {
                    $currentCampaignID = $oCurrentCampaign->id;
                    $aCampaignData = array(
                        'event_id' => $nextEventID
                    );
                    $bUpdated = $mEmails->updateEmailAutomationCampaign($aCampaignData, $currentCampaignID);
                    $response = array('status' => 'success', 'msg' => "updated successfully!");
                }
            }

            if (empty($nextEventID)) {
                //Last Node
                //CurrentID And PreviousID is available
                //Update Current Node
                $aLinkedDataCurrent = array(
                    'previous_event_id' => $previousEventID
                );
                $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedDataCurrent, $currentEventID);

                $response = array('status' => 'success', 'msg' => "updated successfully!");
            }

            if ($nextEventID > 0 && $previousEventID > 0) {
                //middle Node
                //Update Next Node
                $aLinkedData = array(
                    'previous_event_id' => $currentEventID
                );
                $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $nextEventID);

                //Update Current Node
                $aLinkedDataCurrent = array(
                    'previous_event_id' => $previousEventID
                );
                $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedDataCurrent, $currentEventID);

                $response = array('status' => 'success', 'msg' => "updated successfully!");
            }
        } else if ($actionName == 'detach') {
            if ($previousEventID > 0 && $nextEventID > 0) {
                $bIsMainEvent = $mEmails->isMainEvent($previousEventID);
                if ($bIsMainEvent == false) {
                    $aLinkedData = array(
                        'previous_event_id' => $previousEventID
                    );
                    $bLinked = $mEmails->updateEmailAutomationEvent($aLinkedData, $nextEventID);
                }
            }
            $response = array('status' => 'success', 'msg' => "updated successfully!");
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete Automation campaigns in bulk
     * @param Request $request
     */
    public function multipalDeleteAutomation(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        
        $mEmails = new EmailsModel();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }

        $multiAutomationID = $request->multipal_automation_id;
        foreach ($multiAutomationID as $automationID) {
            $bDeleted = $mEmails->deleteEmailAutomation($automationID, $userID);
            if ($bDeleted == true) {
                //Add Useractivity log
                $aActivityData = array(
                    'user_id' => $aUser->id,
                    'event_type' => 'manage_automation_lists',
                    'action_name' => 'deleted_automation_list',
                    'list_id' => !empty($listID) ? $listID : '',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Deleted automation list',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response = array('status' => 'success', 'msg' => "List deleted successfully!");
            }
        }
        echo json_encode($response);
        exit;
    }

    public function moveToArchiveAutomation() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }

        $aData = array(
            'status' => 'archive'
        );

        $automationID = $post['automation_id'];

        $bArchive = $mEmails->updateEmailAutomation($aData, $automationID, $userID);
        if ($bArchive == true) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $aUser->id,
                'event_type' => 'manage_automation_lists',
                'action_name' => 'archive_automation_list',
                'list_id' => $listID,
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Archive automation list',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'msg' => "List deleted successfully!");
        }

        echo json_encode($response);
        exit;
    }

    public function changeAutomationStatus(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mEmails = new EmailsModel();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }



        $automationID = $request->automation_id;
        $status = $request->status;

        $aData = array(
            'status' => $status
        );

        $bArchive = $mEmails->updateEmailAutomation($aData, $automationID, $userID);
        if ($bArchive == true) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $aUser->id,
                'event_type' => 'manage_automation_lists',
                'action_name' => 'update_automation_status',
                'list_id' => !empty($listID) ?  $listID : '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Archive automation list',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'msg' => "List deleted successfully!");
        }

        echo json_encode($response);
        exit;
    }

    public function multipalArchiveAutomation() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }

        $aData = array(
            'status' => 'archive'
        );

        $multiAutomationID = $post['multipal_automation_id'];
        foreach ($multiAutomationID as $automationID) {
            $bArchive = $mEmails->updateEmailAutomation($aData, $automationID, $userID);
            if ($bArchive == true) {
                //Add Useractivity log
                $aActivityData = array(
                    'user_id' => $aUser->id,
                    'event_type' => 'manage_automation_lists',
                    'action_name' => 'archive_automation_list',
                    'list_id' => $listID,
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Archive automation list',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response = array('status' => 'success', 'msg' => "List deleted successfully!");
            }
        }
        echo json_encode($response);
        exit;
    }

    public function deleteAutomation(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mEmails = new EmailsModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $automationID = $request->automation_id;
        $bDeleted = $mEmails->deleteEmailAutomation($automationID, $userID);
        if ($bDeleted == true) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_lists',
                'action_name' => 'deleted_list',
                'list_id' => !empty($listID) ? $listID : '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Deleted contact list',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'msg' => "List deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }

    public function getEmailAutmationCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $campaignID = strip_tags($post['campaignId']);
        if ($campaignID > 0) {
            $oCampaign = $mEmails->getEmailAutomationCampaign($campaignID);
            if (!empty($oCampaign)) {
                $response = array('status' => 'success', 'data' => $oCampaign, 'description' => base64_decode($oCampaign->description), 'content' => base64_decode($oCampaign->html), 'createdVal' => 'Created: ' . date("M d, Y h:i A", strtotime($oCampaign->created)) . ' (' . timeAgo($oCampaign->created) . ')', 'msg' => "List deleted successfully!");
            } else {
                $response = array('status' => 'error', 'msg' => 'Campaign not found');
            }
        } else {
            $response = array('status' => 'error', 'msg' => 'Campaign id is missing');
        }
        echo json_encode($response);
        exit;
    }

    public function updateEmailAutomationCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $templateSubject = strip_tags($post['template_subject']);
        $heading = strip_tags($post['template_heading']);
        $introduction = strip_tags($post['template_introduction']);
        $greeting = strip_tags($post['template_greeting']);
        $templateHtmlContent = $post['template_html_content'];
        $templateContent = $post['template_content'];
        $templateId = strip_tags($post['template_id']);
        $campaignId = strip_tags($post['campaign_id']);

        $aData = array(
            //'name' => $templateName,
            'subject' => $templateSubject,
            'heading' => $heading,
            'introduction' => $introduction,
            'greeting' => $greeting,
            //'template_source' => $templateId,
            'status' => 'active',
            'description' => base64_encode($templateContent),
            'html' => base64_encode($templateHtmlContent)
        );

        $bUpdated = $mEmails->updateEmailAutomationCampaign($aData, $campaignId);

        if ($bUpdated) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_email_automation',
                'action_name' => 'updated campaign',
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
