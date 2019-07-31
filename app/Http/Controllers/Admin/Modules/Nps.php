<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nps extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("admin/modules/Nps_model", "mNPS");
        $this->load->model("admin/Workflow_model", "mWorkflow");
        $this->load->model("admin/Users_model", "mUser");
        $this->load->model("admin/Subscriber_model", "mSubscriber");
        $this->load->library('csvimport');
        $this->load->model("admin/crons/Nps_inviter_model", "mInviter");
        $this->load->model("admin/Templates_model", "mTemplates");
    }

    public function index() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $oPrograms = $this->mNPS->getNpsLists($userID);


        if (!empty($oPrograms)) {
            foreach ($oPrograms as $oProgram) {
                $hashCode = $oProgram->hashcode;
                $aScore = $this->mNPS->getNPSScore($hashCode);
                $oProgram->NPS = $aScore;
                //pre($aScore);
            }
        }

        //pre($oPrograms);

        $moduleName = 'nps-feedback';

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="NPS Surveys" class="sidebar-control active hidden-xs ">NPS Surveys</a></li>
                    </ul>';


        $aPageData = array(
            'title' => 'NPS Module',
            'pagename' => $breadcrumb,
            'oPrograms' => $oPrograms,
            'bActiveSubsription' => $bActiveSubsription,
            'moduleName' => $moduleName
        );
        $this->template->load('admin/admin_template_new', 'admin/modules/nps/index', $aPageData);
    }

    public function overview() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $oPrograms = $this->mNPS->getNpsLists($userID);
        $oProgramsDate = $this->mNPS->getNpsListsByDate($userID);

        if (!empty($oPrograms)) {
            foreach ($oPrograms as $oProgram) {
                $hashCode = $oProgram->hashcode;
                $aScore = $this->mNPS->getNPSScore($hashCode);
                $oProgram->NPS = $aScore;
                //pre($aScore);
            }
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="NPS Overview" class="sidebar-control active hidden-xs ">NPS Overview</a></li>
                    </ul>';


        $aPageData = array(
            'title' => 'NPS Overview',
            'pagename' => $breadcrumb,
            'oPrograms' => $oPrograms,
            'oProgramsDate' => $oProgramsDate,
            'bActiveSubsription' => $bActiveSubsription,
            'oProgramsDate' => $oProgramsDate
        );
        $this->template->load('admin/admin_template_new', 'admin/modules/nps/overview', $aPageData);
    }

    public function setup($npsID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $selectedTab = $this->input->get('t');



        //NPS related account details
        $oNPS = $this->mNPS->getNps($userID, $npsID);
        $moduleUnitID = $npsID;
        if ($oNPS->user_id != $userID) {
            redirect('admin/modules/nps');
            exit;
        }
        if (!empty($oNPS)) {
            // Do nothing for now
            $programID = $oNPS->id;
            //$defaultTab = !empty($selectedTab) ? $selectedTab : 'platform';
            $oContacts = $this->mNPS->getMyUsers($oNPS->hashcode);
        }
        if (empty($oNPS->platform)) {
            $defaultTab = !empty($selectedTab) ? $selectedTab : 'platform';
        } else {
            $defaultTab = !empty($selectedTab) ? $selectedTab : 'customize';
        }

        //$defaultTab = $selectedTab;
        //List of Advocates related data 
        $hashCode = $oNPS->hashcode;
        if (!empty($hashCode)) {
            //$oContacts = $this->mNPS->getMyAdvocates($hashCode);
        }
        $moduleName = 'nps';
        $eventsData = $this->mNPS->getNPSEvents($oNPS->id);
        $campaignTemplates = $this->mNPS->getNPSCampaignTemplates($oNPS->id);
        $userTwilioData = $this->mUser->getUserTwilioData($userID);

        
        $oEvents = $this->mWorkflow->getWorkflowEvents($npsID, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = $this->mWorkflow->getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = $this->mWorkflow->getWorkflowDefaultTemplates($moduleName); 
        //pre($oDefaultTemplates);
        //exit;
        $surveyType = $oNPS->platform;
        if(!empty($surveyType)){
            $sSurveyTypeTitle = ucfirst($surveyType). ' Survey';
            
        }
        $sEmailPreview = $this->load->view("admin/modules/nps/nps-templates/email/templates", array('template_slug' => 'nps_email_invite', 'oNPS' => $oNPS), true);
        $compiledEmailPriviewCode = $this->parseNPStemplate($sEmailPreview, 'email', $oNPS);
        $compiledEmailPriviewCode = str_replace(array('wf_edit_template_greeting'), array('wf_edit_template_greeting_preview'), $compiledEmailPriviewCode);

        $sSmsPreview = $this->load->view("admin/modules/nps/nps-templates/sms/templates", array('template_slug' => 'nps_sms_invite', 'oNPS' => $oNPS), true);
        $compiledSmsPriviewCode = $this->parseNPStemplate($sSmsPreview, 'sms', $oNPS);
        $compiledSmsPriviewCode = str_replace(array('wf_edit_sms_template_greeting', 'wf_edit_sms_template_introduction'), array('wf_edit_sms_template_greeting_preview', 'wf_edit_sms_template_introduction_preview'), $compiledSmsPriviewCode);
        $oFeedbacks = $this->mNPS->getNPSScore($hashCode);

        $oTemplates = $this->mTemplates->getCommonTemplates();
        $oCategories = $this->mTemplates->getCommonTemplateCategories();
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/nps/') . '" class="sidebar-control hidden-xs">NPS </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';
        //$oCampaignSubscribers = $this->mWorkflow->getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
        //pre($oFeedback);
        //pre($campaignTemplates);
        $aData = array(
            'bActiveSubsription' => $bActiveSubsription,
            'title' => $sSurveyTypeTitle,
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'campaignTemplates' => $campaignTemplates,
            'oNPS' => $oNPS,
            'userTwilioData' => $userTwilioData,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $moduleUnitID,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'oTemplates' => $oTemplates,
            'oCategories' => $oCategories,
            'eventsData' => $eventsData,
            'oContacts' => $oContacts,
            'userID' => $userID,
            'userData' => $aUser,
            'user_role' => $user_role,
            'oFeedbacks' => $oFeedbacks,
            'emailPreview' => $compiledEmailPriviewCode,
            'smsPreview' => $compiledSmsPriviewCode
        );

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template_new', 'admin/modules/nps/setup-beta', $aData);
    }

    public function updateNPSCustomize() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //pre($post);
        $npsID = strip_tags($post['nps_id']);
        $title = strip_tags($post['title']);
        $platform = strip_tags($post['platform']);
        $brand = strip_tags($post['brand_name']);
        $logo = strip_tags($post['brand_logo']);
        $from = strip_tags($post['email_from']);
        $replyto = strip_tags($post['email_replyto']);
        $subject = strip_tags($post['email_subject']);
        $btnColor = strip_tags($post['web_button_color']);
        $btnTextColor = strip_tags($post['web_text_color']);

        $intTextColor = strip_tags($post['web_int_text_color']);
        $buttonTextColor = strip_tags($post['web_button_text_color']);
        $buttonOverTextColor = strip_tags($post['web_button_over_text_color']);
        $buttonOverColor = strip_tags($post['web_button_over_color']);

        $btnStyle = strip_tags($post['web_button_style']);
        $btnShape = strip_tags($post['web_button_shape']);
        $description = $post['description'];
        $question = $post['question'];
        $emailPreviewData = $post['emailPreviewData'];

        $displayLogo = strip_tags($post['display_logo']);
        $displayIntro = strip_tags($post['display_intro']);
        
        $displayName = strip_tags($post['display_name']);
        $displayEmail = strip_tags($post['display_email']);
        $displayAdditional = strip_tags($post['display_additional']);



        $aData = array(
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($title)) {
            $aData['title'] = $title;
        }
        if (!empty($platform)) {
            $aData['platform'] = $platform;
        }
        if (!empty($brand)) {
            $aData['brand_name'] = $brand;
        }
        $aData['brand_logo'] = $logo;
//        if (!empty($logo)) {
//            $aData['brand_logo'] = $logo;
//        }
        if (!empty($from)) {
            $aData['email_from'] = $from;
        }
        if (!empty($replyto)) {
            $aData['email_replyto'] = $replyto;
        }
        if (!empty($subject)) {
            $aData['email_subject'] = $subject;
        }
        if (!empty($btnColor)) {
            $aData['web_button_color'] = $btnColor;
        }
        if (!empty($btnTextColor)) {
            $aData['web_text_color'] = $btnTextColor;
        }
        if (!empty($btnStyle)) {
            $aData['web_button_style'] = $btnStyle;
        }
        if (!empty($btnShape)) {
            $aData['web_button_shape'] = $btnShape;
        }
        if (!empty($description)) {
            $aData['description'] = $description;
        }
        if (!empty($question)) {
            $aData['question'] = $question;
        }
        if (!empty($intTextColor)) {
            $aData['web_int_text_color'] = $intTextColor;
        }
        if (!empty($buttonTextColor)) {
            $aData['web_button_text_color'] = $buttonTextColor;
        }
        if (!empty($buttonOverTextColor)) {
            $aData['web_button_over_text_color'] = $buttonOverTextColor;
        }
        if (!empty($buttonOverColor)) {
            $aData['web_button_over_color'] = $buttonOverColor;
        }
        if (!empty($emailPreviewData)) {
            $cData['html'] = base64_encode($emailPreviewData);
        }

        if ($platform != 'sms') {
            $aData['display_logo'] = ($displayLogo == 'on') ? 1 : 0;
        }

        $aData['display_intro'] = ($displayIntro == 'on') ? 1 : 0;

        $aData['display_name'] = ($displayName == 'on') ? 1 : 0;
        
        $aData['display_email'] = ($displayEmail == 'on') ? 1 : 0;
        
        $aData['display_intro'] = ($displayIntro == 'on') ? 1 : 0;


        if ($npsID > 0) {


            $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }

            $oNPS = $this->mNPS->getNps($userID, $npsID);
            if (!empty($oNPS)) {
                $eventData = $this->mNPS->getNPSEventsByNPSIdEventType($npsID);
                $oEndCampaigns = $this->mNPS->getNPSEndCampaigns($npsID);
                //pre($oEndCampaigns);
                //die;
                if (empty($eventData) || empty($oEndCampaigns)) {
                    //Add new event
                    $moduleName = 'nps';
                    $moduleUnitID = $npsID;
                    $eventType = 'main';
                    $previousEventId = '';
                    $templateID = '';
                    $isDraft = false;
                    $templateSlug = '';

                    if ($oNPS->platform == 'email') {
                        $templateSlug = 'nps_email_invite';
                    } else if ($oNPS->platform == 'sms') {
                        $templateSlug = 'nps_sms_invite';
                    } else if ($oNPS->platform == 'link') {
                        $templateSlug = 'nps_email_link_invite';
                    }


                    if (!empty($templateSlug)) {
                        $oTemplate = $this->mTemplates->getCommonTemplateInfo('', $templateSlug);
                        $templateID = $oTemplate->id;
                        if ($templateID > 0) {
                            $triggerParams = array('delay_type' => "after", 'delay_value' => '10', 'delay_unit' => 'minute', 'template_slug' => $templateSlug);
                            $eventID = $this->mWorkflow->createWorkflowEvent($moduleUnitID, $eventType, $previousEventId, $triggerParams, $moduleName);

                            if ($eventID > 0) {
                                $aResponse = $this->mWorkflow->addEndCampaign($eventID, $templateID, $moduleUnitID, $moduleName, $isDraft);
                            }
                            if (!empty($aResponse)) {
                                $eventData = $this->mNPS->getNPSEventsByNPSIdEventType($npsID);
                            }
                        }
                    }
                }

                //Process Preview for Email
                $sEmailPreview = $this->load->view("admin/modules/nps/nps-templates/email/templates", array('template_slug' => 'nps_email_invite', 'oNPS' => $oNPS), true);
                $compiledEmailPriviewCode = $this->parseNPStemplate($sEmailPreview, 'email', $oNPS);

                //Process Preview for SMS
                $sSmsPreview = $this->load->view("admin/modules/nps/nps-templates/sms/templates", array('template_slug' => 'nps_sms_invite', 'oNPS' => $oNPS), true);

                $question = (!empty($oNPS->question)) ? $oNPS->question : 'How likely are you to recommend My Store to a friend?';
                $aTemplateTags = array(
                    '{{QUESTION}}',
                    '\n'
                );
                $aSource = array(
                    $question,
                    '<br>'
                );

                $compiledSmsPriviewCode = str_replace($aTemplateTags, $aSource, $sSmsPreview);

                if (!empty($eventData)) {
                    foreach ($eventData as $oEvent) {
                        $eventID = $oEvent->id;
                        $eveData = json_decode($oEvent->data);

                        $eventSlug = $eveData->template_slug;
                        if (!empty($eventSlug)) {
                            $oTemplateInfo = $this->mTemplates->getCommonTemplateInfo('', $eventSlug);
                            $templateID = $oTemplateInfo->id;
                        }
                        //pre($eveData);
                        if ($eventSlug != 'nps_email_link_invite' && $eventSlug != 'nps_sms_link_invite') {
                            //$this->mNPS->updateCampaignByEventId(array('stripo_compiled_html' => base64_encode($compiledEmailPriviewCode), 'introduction'=> $description), $eventID, 'Email', $templateID);
                            //$this->mNPS->updateCampaignByEventId(array('stripo_compiled_html' => base64_encode($compiledSmsPriviewCode), 'introduction'=> $description), $eventID, 'Sms', $templateID);
                            $this->mNPS->updateCampaignByEventId(array('introduction' => $description), $eventID, 'Email', $templateID);
                            $this->mNPS->updateCampaignByEventId(array('introduction' => $description), $eventID, 'Sms', $templateID);
                        }
                    }
                }
            }
        }

        echo json_encode($response);
        exit;
    }

    public function widgets() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;
        $oWidgetsList = $this->mNPS->getNPSWidgets($userID);
        //$oStats = $this->mNPS->getNPSWidgetStats($userID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="NPS Widgets" class="sidebar-control active hidden-xs ">NPS Widgets</a></li>
			</ul>';

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->session->set_userdata('setTab', '');
        $aData = array(
            'title' => 'NPS Widgets',
            'pagename' => $breadcrumb,
            'oWidgetsList' => $oWidgetsList,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role
        );
        $this->template->load('admin/admin_template_new', 'admin/modules/nps/widget_list', $aData);
    }

    public function addNPSWidget() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $npsTitle = $post['npsTitle'];
        $aData = array(
            'widget_title' => $npsTitle,
            'user_id' => $userID,
            'created' => date("Y-m-d H:i:s")
        );

        $response = $this->mNPS->createNPSWidget($aData);

        if ($response) {
            $response = array('status' => 'success', 'widgetId' => $response);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function updatNPSWidgetStatus() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $widgetID = $post['widgetID'];
        $status = $post['status'];
        $aData = array(
            'status' => $status
        );

        $response = $this->mNPS->updateNPSWidget($aData, $widgetID);

        if ($response) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function delete_nps_widget() {

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

            $result = $this->mNPS->updateNPSWidget($aData, $widgetID);

            if ($result) {

                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'nps_widget',
                    'action_name' => 'deleted_nps_widget',
                    'widget_id' => $widgetID,
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'NPS Widget Deleted',
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

    public function getNPSWidgetEmbedCode() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $widgetID = $post['widget_id'];

            $result = $this->mNPS->getNPSWidgets($userID, $widgetID);
            $campaign_key = $result[0]->hashcode;
            if (!empty($result)) {
                $response['status'] = 'success';
                if ($campaign_key != '') {
                    $sWidget = 'nps';
                    $response['result'] = htmlentities('<script type="text/javascript" id="bbscriptloader" data-key="' . $campaign_key . '" data-widgets="' . $sWidget . '" async="" src="' . base_url('assets/js/widgets.js') . '"></script>');
                } else {
                    $response['status'] = "Error";
                }
            } else {
                $response['status'] = "Errors";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function nps_widget_setup($widgetID) {
        $selectedTab = $this->input->get('t');
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (empty($widgetID)) {
            redirect("admin/modules/nps/widgets");
            exit;
        }

        $oNPSList = $this->mNPS->getNpsLists($userID);
        $widgetData = $this->mNPS->getNPSWidgets($userID, $widgetID);
        $npsData = $this->mNPS->getNps($userID, $widgetData[0]->nps_id);
        //$sEmailPreview = $this->load->view("admin/modules/nps/nps-templates/email/widget_preview", array('oNPS' => $npsData), true);
        $sEmailPreview = $this->load->view("admin/modules/nps/nps-tabs/partials/web-customization", array('oNPS' => $npsData), true);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/modules/nps/widgets') . '" class="sidebar-control hidden-xs">NPS Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="' . $oWidgets[0]->widget_title . '" class="sidebar-control active hidden-xs ">' . $oWidgets[0]->widget_title . '</a></li>
			</ul>';

        $aData = array(
            'title' => 'Onsite Widget',
            'pagename' => $breadcrumb,
            'widgetID' => $widgetID,
            'oNPSList' => $oNPSList,
            'widgetData' => $widgetData[0],
            'sEmailPreview' => $sEmailPreview
        );

        $this->template->load('admin/admin_template_new', 'admin/modules/nps/nps_widget_setup', $aData);
    }

    public function addNPSWidgetSurvey() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();

        $widgetID = $post['widget_id'];
        $npsId = $post['nps_id'];
        $hashcode = $post['hashcode'];

        $aData = array(
            'nps_id' => $npsId,
            'hashcode' => $hashcode
        );


        $result = $this->mNPS->updateNPSWidget($aData, $widgetID);
        $npsData = $this->mNPS->getNps($userID, $npsId);
        //pre($npsData);
        $sEmailPreview = $this->load->view("admin/modules/nps/nps-templates/email/widget_preview", array('oNPS' => $npsData), true);
        $npsScriptCode = '<pre class="prettyprint" id="prettyprint">
							&lt;script 
							type="text/javascript" 
							id="bbscriptloader" 
							data-key="' . $npsData->hashcode . '" 
							data-widgets="nps" 
							async="" 
							src="' . base_url('assets/js/nps_widgets.js') . '"&gt;
							&lt;/script&gt;
						</pre>
                        <div style="display: none;" class="prettyprintDiv">&lt;script type="text/javascript" id="bbscriptloader" data-key="' . $npsData->hashcode . '" data-widgets="nps" async="" src="' . base_url('assets/js/nps_widgets.js') . '"&gt; &lt;/script&gt;</div>';
        if ($result) {
            $response = array('status' => 'success', 'preview' => $sEmailPreview, 'npsScriptCode' => $npsScriptCode);
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function deleteBulkNPSWidgets() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $post['multi_widget_id'];
        $aData = array(
            'delete_status' => 1
        );
        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bDeleted = $this->mNPS->updateNPSWidget($aData, $npsID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function archiveBulkNPSWidgets() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $post['multi_widget_id'];
        $aData = array(
            'status' => 3
        );
        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bDeleted = $this->mNPS->updateNPSWidget($aData, $npsID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function bulkArchiveNPSWidgets() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $post['bulk_nps_id'];
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            }
        }

        if ($bUpdateID) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function publishNPSWidgetSurvey() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = $this->input->post();

        $widgetID = $post['widget_id'];

        $aData = array(
            'status' => '1'
        );


        $result = $this->mNPS->updateNPSWidget($aData, $widgetID);

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function setup_old($npsID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $selectedTab = $this->input->get('t');
        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class=""><a href="' . base_url('admin/modules/nps') . '">NPS Module</a></li>
                        <li class="">Setup</li>
            </ul>';

        //NPS related account details
        $oNPS = $this->mNPS->getNps($userID, $npsID);
//        pre($oSettings);
//        die;
        if (!empty($oNPS)) {
            // Do nothing for now
            $programID = $oNPS->id;
            $defaultTab = !empty($selectedTab) ? $selectedTab : 'platform';
            $oContacts = $this->mNPS->getMyUsers($oNPS->hashcode);
        }
        $defaultTab = !empty($selectedTab) ? $selectedTab : 'platform';
        //List of Advocates related data 
        $hashCode = $oNPS->hashcode;
        if (!empty($hashCode)) {
            //$oContacts = $this->mNPS->getMyAdvocates($hashCode);
        }
        $eventsData = $this->mNPS->getNPSEvents($oNPS->id);
        $campaignTemplates = $this->mNPS->getNPSCampaignTemplates($oNPS->id);
        $userTwilioData = $this->mUser->getUserTwilioData($userID);
        //pre($campaignTemplates);
        $aData = array(
            'bActiveSubsription' => $bActiveSubsription,
            'title' => 'Survery Setup',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'campaignTemplates' => $campaignTemplates,
            'oNPS' => $oNPS,
            'userTwilioData' => $userTwilioData,
            'eventsData' => $eventsData,
            'oContacts' => $oContacts,
            'userID' => $userID,
            'userData' => $aUser,
            'user_role' => $user_role
        );

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template_new', 'admin/modules/nps/setup', $aData);
    }

    public function getNpsUserById() {

        $post = $this->input->post();
        $subscriberID = $post['subscriberID'];
        $bResponse = $this->mNPS->getNpsUserById($subscriberID);

        if ($bResponse) {
            $response = array('status' => 'success', 'result' => $bResponse);
        }
        echo json_encode($response);
        exit;
    }

    public function updateNpsSubscriber() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $email = $post['edit_email'];
        $firstName = $post['edit_firstname'];
        $lastName = $post['edit_lastname'];
        $phone = $post['edit_phone'];
        $subscriberID = $post['edit_subscriberID'];
        $bInsertedNewGlobalSubscriber = false;

        if (!empty($email)) {
            $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
            if (!empty($oGlobalUser)) {
                $iSubscriberID = $oGlobalUser->id;
                $aGlobalUserData = array(
                    'email' => $email,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'phone' => $phone,
                    'updated' => date("Y-m-d H:i:s")
                );
                $this->mSubscriber->updateGlobalSubscriber($aGlobalUserData, $iSubscriberID);
            } else {
                //Add global subscriber
                $aSubscriberData = array(
                    'owner_id' => $userID,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                    'created' => date("Y-m-d H:i:s")
                );
                $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                $bInsertedNewGlobalSubscriber = true;
            }
        }

        if ($bInsertedNewGlobalSubscriber == true) {
            $aData = array(
                'subscriber_id' => $iSubscriberID
            );

            $bResponse = $this->mNPS->updateNpsUser($aData, $subscriberID);
        }

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    public function bulkDeleteNpsUser() {

        $post = $this->input->post();
        $bulk_nps_id = $post['bulk_nps_id'];
        foreach ($bulk_nps_id as $subscriberID) {
            $bResponse = $this->mNPS->deleteNpsUser($subscriberID);
        }

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    public function deleteNpsUser() {

        $post = $this->input->post();
        $subscriberID = $post['subscriberId'];
        $bResponse = $this->mNPS->deleteNpsUser($subscriberID);

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    public function addNPS() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $title = strip_tags($post['title']);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hashcode = '';
        for ($i = 0; $i < 20; $i++) {
            $hashcode .= $characters[rand(0, strlen($characters))];
        }
        $hashcode = $hashcode . date('Ymdhis');
        $aData = array(
            'hashcode' => $hashcode,
            'user_id' => $userID,
            'title' => $title,
            'status' => 'draft',
            'created' => date("Y-m-d H:i:s")
        );
        $insertID = $this->mNPS->addNPS($aData);

        if ($insertID) {
            //Update in automation table to take effect in email/sms settings
            $aEvent = array(
                'invite-email' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minute')),
                'invite-sms' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minute')),
                'reminder-email' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'day')),
                'reminder-sms' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'day'))
            );
            //$bSavedEvent = $this->mNPS->saveNPSEvents($aEvent, $insertID);

            $response = array('status' => 'success', 'id' => $insertID, 'msg' => "Success");

            $notificationData = array(
                'event_type' => 'added_nps_program',
                'event_id' => 0,
                'link' => base_url() . 'admin/modules/nps/setup/' . $insertID,
                'message' => 'Created new NPS.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_nps_added';
            add_notifications($notificationData, $eventName, $userID);
        }
        echo json_encode($response);
        exit;
    }

    public function updateAllCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();

        if (!empty($post)) {
            $npsId = strip_tags($post['nps_id']);

            if (!empty($npsId)) {
                $aData = array(
                    'status' => 'active'
                );
                $eventsData = $this->mNPS->getNPSEvents($npsId);
                foreach ($eventsData as $eventData) {
                    $bSaved = $this->mNPS->updataCampaignByEventID($aData, $eventData->id);
                }
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateUserCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();

        if (!empty($post)) {
            $campaignID = strip_tags($post['campaignId']);
            $campaingType = strip_tags($post['campaignType']);
            if ($campaingType == 'Email') {
                $content = $post['emailtemplate'];
            } else {
                $content = $post['smstemplate'];
            }

            if (!empty($campaignID)) {
                $aData = array(
                    'html' => base64_encode($content)
                );
                $bSaved = $this->mNPS->updateUserCampaign($aData, $campaignID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateNPSEvent() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $eventID = strip_tags($post['event_id']);
            $timeValue = strip_tags($post['delay_value']);
            $timeUnit = strip_tags($post['delay_unit']);

            if (!empty($eventID)) {
                $timeData = json_encode(array('delay_type' => 'after', 'delay_value' => $timeValue, 'delay_unit' => $timeUnit));
                $aData = array(
                    'data' => $timeData
                );

                $bSaved = $this->mNPS->updateAutoEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function deleteNPSCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $campaignID = strip_tags($post['campaign_id']);

            if (!empty($campaignID)) {
                $aData = array(
                    'delete_status' => 1
                );
                $bSaved = $this->mNPS->updateUserCampaign($aData, $campaignID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateNPSReminderCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $eventID = strip_tags($post['event_id']);
            $reminderLoopStatus = strip_tags($post['reminder_loop_status']);

            if (!empty($eventID)) {
                $aData = array(
                    'reminder_loop_status' => $reminderLoopStatus
                );

                $bSaved = $this->mNPS->updateEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateNPSReminderLoop() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $eventID = strip_tags($post['event_id']);
            $loopValue = strip_tags($post['loop_value']);

            if (!empty($eventID)) {
                $aData = array(
                    'reminder_loop' => $loopValue,
                    'total_reminder_loop' => $loopValue
                );

                $bSaved = $this->mNPS->updateEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateNPSCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();

        if (!empty($post)) {
            $campaignID = strip_tags($post['campaign_id']);
            $subject = strip_tags($post['subject']);
            $content = $post['template_content'];
            $campaignType = $post['campaign_type'];

            if (!empty($campaignID)) {
                if ($campaignType == 'Email') {
                    $aData = array(
                        'subject' => $subject,
                        'delete_status' => 0,
                        'status' => 1,
                        'html' => base64_encode($content)
                    );
                } else {
                    $aData = array(
                        'delete_status' => 0,
                        'status' => 1,
                        'html' => base64_encode($content)
                    );
                }

                $bSaved = $this->mNPS->updateUserCampaign($aData, $campaignID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function getNPSCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $oUser = getLoggedUser();
        //pre($oUser);
        $campaignID = $post['campaign_id'];
        $npsID = $post['nps_id'];
        if ($campaignID > 0) {
            $oCampaign = $this->mNPS->getNPSCampaign($campaignID);
            if (!empty($oCampaign)) {
                $content = $this->mInviter->emailTagReplace($npsID, '', base64_decode($oCampaign[0]->html), 'email', $oUser);
                $response = array('status' => 'success', 'campData' => $oCampaign[0], 'description' => base64_decode($oCampaign[0]->html), 'content' => $content);
            } else {
                $response = array('status' => 'error', 'msg' => 'Campaign not found');
            }
        } else {
            $response = array('status' => 'error', 'msg' => 'Campaign id is missing');
        }
        echo json_encode($response);
        exit;
    }

    public function getNPS() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['nps_id']);
        $oNPS = $this->mNPS->getNps($userID, $npsID);
        if (!empty($oNPS)) {
            $response = array('status' => 'success', 'id' => $oNPS->id, 'title' => $oNPS->title);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }

    public function changeStatus() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['npsId']);
        $status = strip_tags($post['status']);
        $aData = array(
            'status' => $status,
        );
        if ($npsID > 0) {
            $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function publishNPSCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['npsId']);
        $aData = array(
            'status' => 'active',
        );
        if ($npsID > 0) {
            $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function publishNPSCampaignStatus() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['npsId']);
        $status = $post['status'];
        $aData = array(
            'status' => $status,
        );
        if ($npsID > 0) {
            $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function updateNPS() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['nps_id']);
        $title = strip_tags($post['title']);
        $aData = array(
            'title' => $title,
            'updated' => date("Y-m-d H:i:s")
        );
        if ($npsID > 0) {
            $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function deleteNPS() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['nps_id']);
        if ($npsID > 0) {
            $bDeleted = $this->mNPS->deleteNPS($userID, $npsID);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function moveToArchiveNPS() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['nps_id']);
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if ($npsID > 0) {
            $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function bulkDeleteNPS() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $post['bulk_nps_id'];
        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bDeleted = $this->mNPS->deleteNPS($userID, $npsID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function bulkArchiveNPS() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $post['bulk_nps_id'];
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            }
        }

        if ($bUpdateID) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function choosePlatform() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($post['nps_id']);
        if ($npsID > 0) {
            $platform = strip_tags($post['platform']);
            $aData = array(
                'platform' => $platform,
                'updated' => date("Y-m-d H:i:s")
            );
            $bUpdateID = $this->mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function template($platform, $hashKey) {
        if (!empty($platform)) {
            if (!empty($hashKey)) {
                $oNPS = $this->mNPS->getSurveyInfoByRef($hashKey);
            }
        }

        $this->load->view('admin/modules/nps/email-content-survey.php', array('oNPS' => $oNPS));
    }

    public function score($hashKey = '') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($hashKey)) {
            $oFeedback = $this->mNPS->getNPSScore($hashKey);
            $aScoreSummery = $this->mNPS->getNPSScoreSummery($hashKey);
        } else {
            $oFeedback = $this->mNPS->getNPSScore('', $userID);
            $aScoreSummery = $this->mNPS->getNPSScoreSummery($userID);
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/nps/') . '">NPS</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="NPS Score" class="sidebar-control active hidden-xs ">NPS Score</a></li>
                </ul>';

        $aPageData = array(
            'title' => 'NPS Score',
            'pagename' => $breadcrumb,
            'oFeedbacks' => $oFeedback,
            'aSummary' => $aScoreSummery
        );

        $this->template->load('admin/admin_template_new', 'admin/modules/nps/list-scores', $aPageData);
    }

    public function feedbackdetails($scoreID = 0) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oNotes = $this->mNPS->getNPSNotes($scoreID);
        $oScore = $this->mNPS->getScoreDetails($scoreID);
        $oTags = $this->mNPS->getTagsByScoreID($scoreID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/nps/') . '">NPS</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Feedback Details" class="sidebar-control active hidden-xs ">Feedback Details</a></li>
                </ul>';

        $this->template->load('admin/admin_template_new', 'admin/modules/nps/feedback_details', array(
            'title' => 'Feedback Details',
            'userID' => $userID,
            'pagename' => $breadcrumb,
            'oScore' => $oScore,
            'oNotes' => $oNotes,
            'oTags' => $oTags,
            'scoreID' => $scoreID
        ));
    }

    public function feedbackdetails_old($scoreID = 0) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oNotes = $this->mNPS->getNPSNotes($scoreID);
        $oScore = $this->mNPS->getScoreDetails($scoreID);
        $oTags = $this->mNPS->getTagsByScoreID($scoreID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/nps/') . '">NPS</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Feedback Details" class="sidebar-control active hidden-xs ">Feedback Details</a></li>
                </ul>';

        $this->template->load('admin/admin_template_new', 'admin/modules/nps/feedback_details_old', array(
            'title' => 'Feedback Details',
            'userID' => $userID,
            'pagename' => $breadcrumb,
            'oScore' => $oScore,
            'oNotes' => $oNotes,
            'oTags' => $oTags,
            'scoreID' => $scoreID
        ));
    }

    public function saveNPSNotes() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (!empty($post)) {
            $scoreID = strip_tags($post['scoreid']);
            $npsID = strip_tags($post['npsid']);
            $userID = strip_tags($post['uid']);
            $sNotes = $post['notes'];
            $aNotesData = array(
                'score_id' => $scoreID,
                'user_id' => $userID,
                'nps_id' => $npsID,
                'notes' => $sNotes,
                'created' => date("Y-m-d H:i:s")
            );

            $bSaved = $this->mNPS->saveNPSNotes($aNotesData);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been added succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }

    public function applyNPSTag() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $scoreID = strip_tags($post['score_id']);
        $aTagID = $post['applytag'];
        $aInput = array(
            'aTagIDs' => $aTagID,
            'score_id' => $scoreID
        );

        $bAdded = $this->mNPS->addNPSTag($aInput);

        if ($bAdded) {
            $response = array('status' => 'success', 'msg' => 'Tag added successfully!');
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function removeNPSTag() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $scoreID = strip_tags($post['score_id']);
        $npsID = strip_tags($post['nps_id']);
        $tagID = strip_tags($post['tag_id']);

        if (!empty($scoreID) && $scoreID > 0) {
            $bDeleted = $this->mNPS->removeNPSTag($tagID, $scoreID);
        }


        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => 'Tag has been removed successfully!');
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function getNPSNoteById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $noteID = strip_tags($post['noteid']);
            $noteData = $this->mNPS->getNPSNoteByID($noteID);
            if ($noteData) {
                $response['status'] = 'success';
                $response['result'] = $noteData;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function deleteNPSNote() {
        $response = array();
        $post = $this->input->post();
        $noteid = strip_tags($post['noteid']);
        $result = $this->mNPS->deleteNPSNoteByID($noteid);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    public function updatNotes() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (!empty($post)) {
            $noteId = strip_tags($post['edit_noteid']);
            $sNotes = $post['edit_note_content'];
            $aNotesData = array(
                'notes' => $sNotes
            );

            $bSaved = $this->mNPS->updateNPSNote($aNotesData, $noteId);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been updated succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }

    public function listAllTags() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $scoreID = $post['score_id'];
        if ($scoreID > 0) {
            $aAppliedTags = $this->mNPS->getTagsByScoreID($scoreID);
        }

        $aTag = $this->mNPS->getClientTags($userID);
        $sTags = $this->load->view('admin/tags/mytags', array('oTags' => $aTag, 'aAppliedTags' => $aAppliedTags), true);
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;
    }

    public function registerInvite() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();
        if (!empty($post)) {
            $accountID = strip_tags($post['bbaid']);
            $firstName = strip_tags($post['firstname']);
            $lastName = strip_tags($post['lastname']);
            $email = strip_tags($post['email']);
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
                $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
            }
            $aData = array(
                'subscriber_id' => $iSubscriberID,
                'account_id' => $accountID,
                'created' => date("Y-m-d H:i:s")
            );
            $invitedUserID = $this->registerNow($aData);
            if ($invitedUserID > 0) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }
        echo json_encode($response);
        exit;
    }

    public function registerNow($aData) {
        $userID = 0;
        if (!empty($aData)) {
            $subscriberID = $aData['subscriber_id'];
            $accountID = $aData['account_id'];
            if (!empty($subscriberID)) {
                $oExistingUser = $this->mNPS->checkIfExistingUser($subscriberID, $accountID);
                if (!empty($oExistingUser)) {
                    $userID = $oExistingUser->id;
                } else {
                    //Ok we are good now, go ahead and register a new user
                    $userID = $this->mNPS->addNPSUser($aData);
                }
            }
        }
        return $userID;
    }

    // Export data in CSV format 
    public function exportCSV() {
        // file name 
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $post = $this->input->post();
        $npsHashId = $post['nps_hash_id'];
        $userID = $this->session->userdata("current_user_id");
        $allSubscribers = $this->mNPS->getNPSSubscribers($npsHashId);

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
            'event_type' => 'nps_module',
            'action_name' => 'nps_module_export_people',
            'brandboost_id' => $listId,
            'campaign_id' => '',
            'inviter_id' => '',
            'subscriber_id' => '',
            'feedback_id' => '',
            'activity_message' => 'Users exported from nps module',
            'activity_created' => date("Y-m-d H:i:s")
        );
        logUserActivity($aActivityData);
        exit;
    }

    public function importInviteCSV() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $accountID = strip_tags($post['bbaid']);



        $this->load->library('upload', $config);

        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $response = array('status' => 'error', 'msg' => 'Fileupload failed');
        } else {

            $aFile = $this->upload->data();
            $sPath = './uploads/' . $aFile['file_name'];
            if ($this->csvimport->get_array($sPath)) {
                $aUsers = $this->csvimport->get_array($sPath);
                $emailUserId = '';
                foreach ($aUsers as $row) {
                    $firstName = $row['FIRST_NAME'];
                    $lastName = $row['LAST_NAME'];
                    $email = $row['EMAIL'];
                    $phone = $row['PHONE'];

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
                        $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                    }

                    $aData = array(
                        'subscriber_id' => $iSubscriberID,
                        'account_id' => $accountID,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $invitedUserID = $this->registerNow($aData);
                }
            } else {
                $data['error'] = "Error occured";
            }
        }
        $response = array('status' => 'success', 'msg' => "Success");
        echo json_encode($response);
        exit;
    }

    public function stats($npsID) {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
      
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="NPS Stats" class="sidebar-control active hidden-xs ">NPS Stats</a></li>
                    </ul>';

        $oNPSEvents = $this->mNPS->getNPSEvents($npsID);

        $data = array(
            'title' => 'NPS Stats',
            'pagename' => $breadcrumb,
            'userID' => $userID,
            'oNPSEvents' => $oNPSEvents,
            'type' => 'email'
        );

        $this->template->load('admin/admin_template_new', 'admin/modules/nps/nps-stats', $data);
    }

    public function parseNPStemplate($sCode, $type, $oNPS) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($oNPS)) {
            $hashCode = $oNPS->hashcode;
            $ownerID = $oNPS->user_id;
            $title = $oNPS->title;
            $platform = $oNPS->platform;
            $brandName = $oNPS->brand_name;
            $brandLogoURL = $oNPS->brand_logo;
            $btnColor = $oNPS->web_button_color;
            $btnTextColor = $oNPS->web_button_text_color;
            $txtColor = $oNPS->web_text_color;
            $introTxtColor = $oNPS->web_int_text_color;
            $btnShape = $oNPS->web_button_shape;
            $desc = $oNPS->description;
            $ques = $oNPS->question;
        }
        if ($type == 'email') {
            $aTemplateTags = array(
                '{GREETING}',
                '{{BRAND_LOGO}}',
                '{{INTRODUCTION}}',
                '{{TEXT_COLOR}}',
                '{{BUTTON_COLOR}}',
                '{{BUTTON_TEXT_COLOR}}',
                '{{BUTTON_SHAPE}}',
                '{{QUESTION}}',
                '{{RATE_LINK}}',
                '{{INTRODUCTION_TEXT_COLOR}}'
            );
            $greeting = "Hi, ". $aUser->firstname. ' ' . $aUser->lastname;
            $brandLogo = !(empty($brandLogoURL)) ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $brandLogoURL : base_url() . 'assets/images/face2.jpg';
            $description = (!empty($desc)) != '' ? $desc : '{{INTRODUCTION}}';
            $textColor = !(empty($txtColor)) ? $txtColor : '#000000';
            $introTextColor = !(empty($introTxtColor)) ? $introTxtColor : '#000000';
            $question = (!empty($ques)) ? $ques : 'How likely are you to recommend My Store to a friend?';
            $buttonColor = (!empty($btnColor)) ? $btnColor : '#FFFFFF';
            $buttonShape = (!empty($oNPS->web_button_shape)) ? $btnShape == 'circle' ? '100px' : '0px' : '100px';
            $buttonTextColor = !(empty($btnTextColor)) ? $btnTextColor : '#000000';
            $rateLink = base_url() . "nps/t/{$hashCode}";

            $aSource = array(
                $greeting,
                $brandLogo,
                $description,
                $textColor,
                $buttonColor,
                $buttonTextColor,
                $buttonShape,
                $question,
                $rateLink,
                $introTextColor
            );
        }

        if ($type == 'sms') {
            $question = (!empty($ques)) ? $ques : 'How likely are you to recommend My Store to a friend?';
            $description = (!empty($desc)) != '' ? $desc : '{{INTRODUCTION}}';
            $aTemplateTags = array(
                '{{QUESTION}}',
                '{{INTRODUCTION}}',
                '{QUESTION}',
                '{INTRODUCTION}',
                '{GREETING}',
                '\n'
            );
            $aSource = array(
                $question,
                $description,
                $question,
                $description,
                'Hi, ' . $aUser->firstname . ' ' . $aUser->lastname,
                '<br>'
            );
        }

        $compiledCode = str_replace($aTemplateTags, $aSource, $sCode);
        return $compiledCode;
    }

}
