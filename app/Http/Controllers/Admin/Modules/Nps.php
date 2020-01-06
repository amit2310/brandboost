<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Modules\NpsModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\ListsModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\TemplatesModel;
use Session;

class Nps extends Controller {

    /**
     * Default NPS controller
     */
    public function index() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $userRole = $aUser->user_role;
        $bActiveSubsription = UsersModel::isActiveSubscription();

        $aBreadcrumb = array(
            'Home' => '#/',
            'NPS Surveys' => '#/modules/nps/',
            'Dashboard' => ''
        );

        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $oPrograms = $mNPS->getNpsLists($userID);

        if (!empty($oPrograms)) {
            foreach ($oPrograms as $oProgram) {
                $hashCode = $oProgram->hashcode;
                $aScore = $mNPS->getNPSScore($hashCode);
                $oProgram->NPS = $aScore;
                //pre($aScore);
            }
        }

        //pre($oPrograms);

        $moduleName = 'nps-feedback';

        $aPageData = array(
            'title' => 'NPS Module',
            'uRole' => $userRole,
            'breadcrumb' => $aBreadcrumb,
            'allData' => $oPrograms,
            'oPrograms' => $oPrograms->items(),
            'bActiveSubsription' => $bActiveSubsription,
            'moduleName' => $moduleName
        );

        echo json_encode($aPageData);
        exit();
    }

    /*
     * Function to have the reference for the old functionalities
     */
    public function indexOld() {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $oPrograms = $mNPS->getNpsLists($userID);


        if (!empty($oPrograms)) {
            foreach ($oPrograms as $oProgram) {
                $hashCode = $oProgram->hashcode;
                $aScore = $mNPS->getNPSScore($hashCode);
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
        return view('admin.modules.nps.index', $aPageData)->with(['mNPS' => $mNPS]);
    }

    /**
     * Overview of NPS campaigns
     *
     */
    public function overview() {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $oPrograms = $mNPS->getNpsLists($userID);
        $oProgramsDate = $mNPS->getNpsListsByDate($userID);

        if (!empty($oPrograms)) {
            foreach ($oPrograms as $oProgram) {
                $hashCode = $oProgram->hashcode;
                $aScore = $mNPS->getNPSScore($hashCode);
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
        return view('admin.modules.nps.overview', $aPageData)->with(['mNPS' => $mNPS]);
    }

    /**
     *
     * @param type $npsIDUsed to setup nps campaign
     */
    public function setup(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        // Instantiate workflow model to get its properties and methods
        $mWorkflow = new WorkflowModel();

        // Instantiate Templates model to get its properties and methods
        $mTemplates = new TemplatesModel();

        // Instantiate Users model to get its properties and methods
        $mUser = new UsersModel();

        $npsID = $request->npsID;


        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $selectedTab = $request->t;




        //NPS related account details
        $oNPS = $mNPS->getNps($userID, $npsID);

        $moduleUnitID = $npsID;
        if ($oNPS->user_id != $userID) {
            redirect('admin/modules/nps');
            exit;
        }
        if (!empty($oNPS)) {
            // Do nothing for now
            $programID = $oNPS->id;
            $oContacts = $mNPS->getMyUsers($oNPS->hashcode);
        }

        //List of Advocates related data
        $hashCode = $oNPS->hashcode;
        if (!empty($hashCode)) {
            //$oContacts = $mNPS->getMyAdvocates($hashCode);
        }
        $moduleName = 'nps';
        $eventsData = $mNPS->getNPSEvents($oNPS->id);
        $campaignTemplates = $mNPS->getNPSCampaignTemplates($oNPS->id);
        $userTwilioData = $mUser->getUserTwilioData($userID);


        $oEvents = $mWorkflow->getWorkflowEvents($npsID, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = $mWorkflow->getWorkflowDefaultTemplates($moduleName);
        //pre($oDefaultTemplates);
        //exit;
        $surveyType = $oNPS->platform;
        $sSurveyTypeTitle = '';
        if (!empty($surveyType)) {
            $sSurveyTypeTitle = ucfirst($surveyType) . ' Survey';
        }
        $sEmailPreview = view('admin.modules.nps.nps-templates.email.templates', array('template_slug' => 'nps_email_invite', 'oNPS' => $oNPS))->render();
        $compiledEmailPriviewCode = $this->parseNPStemplate($sEmailPreview, 'email', $oNPS);
        $compiledEmailPriviewCode = str_replace(array('wf_edit_template_greeting'), array('wf_edit_template_greeting_preview'), $compiledEmailPriviewCode);

        $sSmsPreview = view('admin.modules.nps.nps-templates.sms.templates', array('template_slug' => 'nps_sms_invite', 'oNPS' => $oNPS))->render();
        $compiledSmsPriviewCode = $this->parseNPStemplate($sSmsPreview, 'sms', $oNPS);
        $compiledSmsPriviewCode = str_replace(array('wf_edit_sms_template_greeting', 'wf_edit_sms_template_introduction'), array('wf_edit_sms_template_greeting_preview', 'wf_edit_sms_template_introduction_preview'), $compiledSmsPriviewCode);
        $oFeedbacks = $mNPS->getNPSScore($hashCode);

        $oTemplates = $mTemplates->getCommonTemplates();
        $oCategories = $mTemplates->getCommonTemplateCategories();
        if($surveyType == 'web' || $surveyType =='link'){
            $setupPreview = view('admin.modules.nps.nps-tabs.partials.web-widget-only', array('template_slug' => 'nps_email_invite', 'oNPS' => $oNPS))->render();
        }else{
            $setupPreview = $surveyType == 'email' ? $compiledEmailPriviewCode : $compiledSmsPriviewCode;
        }

        $aBreadcrumb = array(
            'Home' => '#/',
            'Nps' => '#/nps/dashboard',
            'Campaigns' => '#/nps/',
            'Setup' => '',
        );
        $aData = array(
            'bActiveSubsription' => $bActiveSubsription,
            'title' => $sSurveyTypeTitle,
            'breadcrumb' => $aBreadcrumb,
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
            'oFeedbacks' => $oFeedbacks->items(),
            'oFeedbackAllData' => $oFeedbacks,
            'emailPreview' => $compiledEmailPriviewCode,
            'smsPreview' => $compiledSmsPriviewCode,
            'setupPreview' => $setupPreview,
            'campaignTitle' => $oNPS->title
        );

        $bActiveSubsription = UsersModel::isActiveSubscription();
        return $aData;
        //return view('admin.modules.nps.setup-beta', $aData)->with(['mNPS' => $mNPS]);
    }

    /**
     * Update NPS campaign customization
     */
    public function updateNPSCustomize(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        // Instantiate workflow model to get its properties and methods
        $mWorkflow = new WorkflowModel();

        // Instantiate Templates model to get its properties and methods
        $mTemplates = new TemplatesModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //$npsID = strip_tags($request->nps_id);
        $npsID = strip_tags($request->id);
        $title = strip_tags($request->title);
        $platform = strip_tags($request->platform);
        $brand = strip_tags($request->brand_name);
        $logo = strip_tags($request->brand_logo);
        $from = strip_tags($request->email_from);
        $replyto = strip_tags($request->email_replyto);
        $subject = strip_tags($request->email_subject);
        $btnColor = strip_tags($request->web_button_color);
        $btnTextColor = strip_tags($request->web_text_color);

        $intTextColor = strip_tags($request->web_int_text_color);
        $buttonTextColor = strip_tags($request->web_button_text_color);
        $buttonOverTextColor = strip_tags($request->web_button_over_text_color);
        $buttonOverColor = strip_tags($request->web_button_over_color);

        $btnStyle = strip_tags($request->web_button_style);
        $btnShape = strip_tags($request->web_button_shape);
        $description = $request->description;
        $question = $request->question;
        $emailPreviewData = $request->emailPreviewData;

        $displayLogo = strip_tags($request->display_logo);
        $displayQuestion = strip_tags($request->display_additional);
        $displayIntro = strip_tags($request->display_intro);

        $displayName = strip_tags($request->display_name);
        $displayEmail = strip_tags($request->display_email);
        $displayAdditional = strip_tags($request->display_additional);



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
            $aData['display_logo'] = ($displayLogo) ? 1 : 0;
        }

        $aData['display_intro'] = ($displayIntro) ? 1 : 0;

        $aData['display_name'] = ($displayName) ? 1 : 0;

        $aData['display_email'] = ($displayEmail) ? 1 : 0;

        $aData['display_additional'] = ($displayQuestion) ? 1 : 0;


        if ($npsID > 0) {


            $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }

            $oNPS = $mNPS->getNps($userID, $npsID);
            if (!empty($oNPS)) {
                $eventData = $mNPS->getNPSEventsByNPSIdEventType($npsID);
                $oEndCampaigns = $mNPS->getNPSEndCampaigns($npsID);
                //pre($oEndCampaigns);
                //die;
                $moduleName = 'nps';
                $moduleUnitID = $npsID;
                $eventType = 'main';
                $previousEventId = '';
                $templateID = '';
                $isDraft = false;
                $templateSlug = '';
                if (empty($eventData) || empty($oEndCampaigns)) {
                    //Add new event

                    if ($oNPS->platform == 'email') {
                        $templateSlug = 'nps_email_invite';
                    } else if ($oNPS->platform == 'sms') {
                        $templateSlug = 'nps_sms_invite';
                    } else if ($oNPS->platform == 'link') {
                        $templateSlug = 'nps_email_link_invite';
                    }


                    if (!empty($templateSlug)) {
                        $oTemplate = $mTemplates->getCommonTemplateInfo('', $templateSlug);
                        $templateID = $oTemplate->id;
                        if ($templateID > 0) {
                            $triggerParams = array('delay_type' => "after", 'delay_value' => '10', 'delay_unit' => 'minute', 'template_slug' => $templateSlug);
                            $eventID = $mWorkflow->createWorkflowEvent($moduleUnitID, $eventType, $previousEventId, $triggerParams, $moduleName);

                            if ($eventID > 0) {
                                $aResponse = $mWorkflow->addEndCampaign($eventID, $templateID, $moduleUnitID, $moduleName, $isDraft);
                            }
                            if (!empty($aResponse)) {
                                $eventData = $mNPS->getNPSEventsByNPSIdEventType($npsID);
                            }
                        }
                    }
                }

                //Process Preview for Email
                $sEmailPreview = view('admin.modules.nps.nps-templates.email.templates', array('template_slug' => 'nps_email_invite', 'oNPS' => $oNPS))->render();
                $compiledEmailPriviewCode = $this->parseNPStemplate($sEmailPreview, 'email', $oNPS);

                //Process Preview for SMS
                $sSmsPreview = view('admin.modules.nps.nps-templates.sms.templates', array('template_slug' => 'nps_sms_invite', 'oNPS' => $oNPS))->render();

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

                        $eventSlug = isset($eveData->template_slug) ? $eveData->template_slug : '';
                        if (!empty($eventSlug)) {
                            $oTemplateInfo = $mTemplates->getCommonTemplateInfo('', $eventSlug);
                            $templateID = $oTemplateInfo->id;
                        }
                        //pre($eveData);
                        if ($eventSlug != 'nps_email_link_invite' && $eventSlug != 'nps_sms_link_invite') {
                            //$mNPS->updateCampaignByEventId(array('stripo_compiled_html' => base64_encode($compiledEmailPriviewCode), 'introduction'=> $description), $eventID, 'Email', $templateID);
                            //$mNPS->updateCampaignByEventId(array('stripo_compiled_html' => base64_encode($compiledSmsPriviewCode), 'introduction'=> $description), $eventID, 'Sms', $templateID);
                            $mNPS->updateCampaignByEventId(array('introduction' => $description), $eventID, 'Email', $templateID);
                            $mNPS->updateCampaignByEventId(array('introduction' => $description), $eventID, 'Sms', $templateID);
                        }
                    }
                }
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get NPS widgets
     */
    public function widgets() {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;
        $oWidgetsList = $mNPS->getNPSWidgets($userID);
        //$oStats = $mNPS->getNPSWidgetStats($userID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="NPS Widgets" class="sidebar-control active hidden-xs ">NPS Widgets</a></li>
			</ul>';

        $bActiveSubsription = UsersModel::isActiveSubscription();
        Session::put('setTab', '');
        $aData = array(
            'title' => 'NPS Widgets',
            'pagename' => $breadcrumb,
            'oWidgetsList' => $oWidgetsList,
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $user_role
        );
        return view('admin.modules.nps.widget_list', $aData)->with(['mNPS'=>$mNPS]);
    }

    /**
     * Used to add new nps campaign
     */
    public function addNPSWidget(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $npsTitle = $request->npsTitle;
        $aData = array(
            'widget_title' => $npsTitle,
            'user_id' => $userID,
            'created' => date("Y-m-d H:i:s")
        );

        $response = $mNPS->createNPSWidget($aData);

        if ($response) {
            $response = array('status' => 'success', 'widgetId' => $response);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS widget status
     */
    public function updatNPSWidgetStatus(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $widgetID = $request->widgetID;
        $status = $request->status;
        $aData = array(
            'status' => $status
        );

        $response = $mNPS->updateNPSWidget($aData, $widgetID);

        if ($response) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete a nps widget
     */
    public function delete_nps_widget(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($request)) {

            $widgetID = $request->widget_id;

            $aData = array(
                'delete_status' => '1'
            );

            $result = $mNPS->updateNPSWidget($aData, $widgetID);

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

    /**
     * USed to get nps widget embed code
     */
    public function getNPSWidgetEmbedCode(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();

        if (!empty($request)) {

            $widgetID = $request->widget_id;

            $result = $mNPS->getNPSWidgets($userID, $widgetID);
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

    /**
     *
     * @param type $widgetIDSetup NPS widget
     */
    public function nps_widget_setup(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $widgetID = $request->widgetID;

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (empty($widgetID)) {
            redirect("admin/modules/nps/widgets");
            exit;
        }

        $oNPSList = $mNPS->getNpsLists($userID);
        $widgetData = $mNPS->getNPSWidgets($userID, $widgetID);
        $npsData = $mNPS->getNps($userID, $widgetData[0]->nps_id);
        $sEmailPreview = view('admin.modules.nps.nps-tabs.partials.web-customization', array('oNPS' => $npsData))->render();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/modules/nps/widgets') . '" class="sidebar-control hidden-xs">NPS Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="' . $widgetData[0]->widget_title . '" class="sidebar-control active hidden-xs ">' . $widgetData[0]->widget_title . '</a></li>
			</ul>';

        $aData = array(
            'title' => 'NPS Widget',
            'pagename' => $breadcrumb,
            'widgetID' => $widgetID,
            'oNPSList' => $oNPSList,
            'widgetData' => $widgetData[0],
            'sEmailPreview' => $sEmailPreview
        );

        return view('admin.modules.nps.nps_widget_setup', $aData);
    }

    /**
     * Used to add NPS widget survey
     */
    public function addNPSWidgetSurvey(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();


        $widgetID = $request->widget_id;
        $npsId = $request->nps_id;
        $hashcode = $request->hashcode;

        $aData = array(
            'nps_id' => $npsId,
            'hashcode' => $hashcode
        );


        $result = $mNPS->updateNPSWidget($aData, $widgetID);
        $npsData = $mNPS->getNps($userID, $npsId);
        //pre($npsData);
        $sEmailPreview = view('admin.modules.nps.nps-templates.email.widget_preview', array('oNPS' => $npsData))->render();
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

    /**
     * Used to delete nps widgets in bulk
     */
    public function deleteBulkNPSWidgets(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $request->multi_widget_id;
        $aData = array(
            'delete_status' => 1
        );
        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bDeleted = $mNPS->updateNPSWidget($aData, $npsID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to archive NPS widgets in bulk
     */
    public function archiveBulkNPSWidgets(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $request->multi_widget_id;
        $aData = array(
            'status' => 3
        );
        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bDeleted = $mNPS->updateNPSWidget($aData, $npsID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to archive NPS widgets in bulk
     */
    public function bulkArchiveNPSWidgets(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $request->bulk_nps_id;
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            }
        }

        if ($bUpdateID) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to publish NPS survey
     */
    public function publishNPSWidgetSurvey(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();


        $widgetID = $request->widget_id;

        $aData = array(
            'status' => '1'
        );


        $result = $mNPS->updateNPSWidget($aData, $widgetID);

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get NPS contacts by id
     */
    public function getNpsUserById(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();


        $subscriberID = $request->subscriberID;
        $bResponse = $mNPS->getNpsUserById($subscriberID);

        if ($bResponse) {
            $response = array('status' => 'success', 'result' => $bResponse);
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS subscribers
     */
    public function updateNpsSubscriber(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $email = $request->edit_email;
        $firstName = $request->edit_firstname;
        $lastName = $request->edit_lastname;
        $phone = $request->edit_phone;
        $subscriberID = $request->edit_subscriberID;
        $bInsertedNewGlobalSubscriber = false;

        if (!empty($email)) {
            $oGlobalUser = $mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
            if (!empty($oGlobalUser)) {
                $iSubscriberID = $oGlobalUser->id;
                $aGlobalUserData = array(
                    'email' => $email,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'phone' => $phone,
                    'updated' => date("Y-m-d H:i:s")
                );
                $mSubscriber->updateGlobalSubscriber($aGlobalUserData, $iSubscriberID);
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
                $iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
                $bInsertedNewGlobalSubscriber = true;
            }
        }

        if ($bInsertedNewGlobalSubscriber == true) {
            $aData = array(
                'subscriber_id' => $iSubscriberID
            );

            $bResponse = $mNPS->updateNpsUser($aData, $subscriberID);
        }

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete NPS subsribers in bulk
     */
    public function bulkDeleteNpsUser(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();



        $bulk_nps_id = $request->bulk_nps_id;
        foreach ($bulk_nps_id as $subscriberID) {
            $bResponse = $mNPS->deleteNpsUser($subscriberID);
        }

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete NPS subscriber
     */
    public function deleteNpsUser(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();


        $subscriberID = $request->subscriberId;
        $bResponse = $mNPS->deleteNpsUser($subscriberID);

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add a new nps campaign
     */
    public function addNPS(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'title' => ['required'],
            'platform' => ['required'],
            'description' => ['required']
        ]);

        $title = strip_tags($request->title);
        $platform = strip_tags($request->platform);
        $description = strip_tags($request->description);

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
            'platform' => $platform,
            'description' => $description,
            'status' => 'draft',
            'created' => date("Y-m-d H:i:s")
        );

        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $insertID = $mNPS->addNPS($aData);

        if ($insertID) {
            //Update in automation table to take effect in email/sms settings
            $aEvent = array(
                'invite-email' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minute')),
                'invite-sms' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minute')),
                'reminder-email' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'day')),
                'reminder-sms' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'day'))
            );
            //$bSavedEvent = $mNPS->saveNPSEvents($aEvent, $insertID);

            $response = array('status' => 'success', 'id' => $insertID, 'msg' => "NPS Survey added successfully!");

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
            @add_notifications($notificationData, $eventName, $userID);
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS campaigns in bulk
     */
    public function updateAllCampaign(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();


        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;


        if (!empty($request)) {
            $npsId = strip_tags($request->nps_id);

            if (!empty($npsId)) {
                $aData = array(
                    'status' => 'active'
                );
                $eventsData = $mNPS->getNPSEvents($npsId);
                foreach ($eventsData as $eventData) {
                    $bSaved = $mNPS->updataCampaignByEventID($aData, $eventData->id);
                }
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS campaign
     */
    public function updateUserCampaign(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;


        if (!empty($request)) {
            $campaignID = strip_tags($request->campaignId);
            $campaingType = strip_tags($request->campaignType);
            if ($campaingType == 'Email') {
                $content = $request->emailtemplate;
            } else {
                $content = $request->smstemplate;
            }

            if (!empty($campaignID)) {
                $aData = array(
                    'html' => base64_encode($content)
                );
                $bSaved = $mNPS->updateUserCampaign($aData, $campaignID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS event
     */
    public function updateNPSEvent(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');



        if (!empty($request)) {
            $eventID = strip_tags($request->event_id);
            $timeValue = strip_tags($request->delay_value);
            $timeUnit = strip_tags($request->delay_unit);

            if (!empty($eventID)) {
                $timeData = json_encode(array('delay_type' => 'after', 'delay_value' => $timeValue, 'delay_unit' => $timeUnit));
                $aData = array(
                    'data' => $timeData
                );

                $bSaved = $mNPS->updateAutoEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete NPS campaign
     */
    public function deleteNPSCampaign(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');



        if (!empty($request)) {
            $campaignID = strip_tags($request->campaign_id);

            if (!empty($campaignID)) {
                $aData = array(
                    'delete_status' => 1
                );
                $bSaved = $mNPS->updateUserCampaign($aData, $campaignID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS reminder campaign
     */
    public function updateNPSReminderCampaign(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');



        if (!empty($request)) {
            $eventID = strip_tags($request->event_id);
            $reminderLoopStatus = strip_tags($request->reminder_loop_status);

            if (!empty($eventID)) {
                $aData = array(
                    'reminder_loop_status' => $reminderLoopStatus
                );

                $bSaved = $mNPS->updateEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Updated to update NPS reminder loop
     */
    public function updateNPSReminderLoop(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');



        if (!empty($request)) {
            $eventID = strip_tags($request->event_id);
            $loopValue = strip_tags($request->loop_value);

            if (!empty($eventID)) {
                $aData = array(
                    'reminder_loop' => $loopValue,
                    'total_reminder_loop' => $loopValue
                );

                $bSaved = $mNPS->updateEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS campaign
     */
    public function updateNPSCampaign(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;


        if (!empty($request)) {
            $campaignID = strip_tags($request->campaign_id);
            $subject = strip_tags($request->subject);
            $content = $request->template_content;
            $campaignType = $request->campaign_type;

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

                $bSaved = $mNPS->updateUserCampaign($aData, $campaignID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to get NPS campaign
     */
    public function getNPSCampaign(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $oUser = getLoggedUser();
        //pre($oUser);
        $campaignID = $request->campaign_id;
        $npsID = $request->nps_id;
        if ($campaignID > 0) {
            $oCampaign = $mNPS->getNPSCampaign($campaignID);
            if (!empty($oCampaign)) {
                $content = $mInviter->emailTagReplace($npsID, '', base64_decode($oCampaign[0]->html), 'email', $oUser);
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

    /**
     * Used to get NPS campaign Info
     */
    public function getNPS(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $npsID = strip_tags($request->nps_id);

        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $oNPS = $mNPS->getNps($userID, $npsID);

        if (!empty($oNPS)) {
            $response = array('status' => 'success', 'id' => $oNPS->id, 'title' => $oNPS->title, 'platform' => $oNPS->platform, 'description' => $oNPS->description);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update nps campaign status
     */
    public function changeStatus(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($request->npsId);
        $status = strip_tags($request->status);
        $aData = array(
            'status' => $status,
        );
        if ($npsID > 0) {
            $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to publish NPS campaign
     */
    public function publishNPSCampaign(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($request->npsId);
        $aData = array(
            'status' => 'active',
        );
        if ($npsID > 0) {
            $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to publish NPS campaign status
     */
    public function publishNPSCampaignStatus(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($request->npsId);
        $status = $request->status;
        $aData = array(
            'status' => $status,
        );
        if ($npsID > 0) {
            $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS campaign
     */
    public function updateNPS(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'title' => ['required'],
            'platform' => ['required'],
            'description' => ['required']
        ]);

        $npsID = strip_tags($request->nps_id);
        $title = strip_tags($request->title);
        $platform = strip_tags($request->platform);
        $description = strip_tags($request->description);

        $aData = array(
            'title' => $title,
            'platform' => $platform,
            'description' => $description,
            'updated' => date("Y-m-d H:i:s")
        );

        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        if ($npsID > 0) {
            $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete NPS campaign
     */
    public function deleteNPS(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($request->nps_id);
        if ($npsID > 0) {
            $bDeleted = $mNPS->deleteNPS($userID, $npsID);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to archive NPS campaigns
     */
    public function moveToArchiveNPS(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($request->nps_id);
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if ($npsID > 0) {
            $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete NPS in bulk
     */
    public function bulkDeleteNPS(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $request->bulk_nps_id;
        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bDeleted = $mNPS->deleteNPS($userID, $npsID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to archive NPS campaigns in bulk
     */
    public function bulkArchiveNPS(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsIDs = $request->bulk_nps_id;
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($npsIDs)) {
            foreach ($npsIDs as $npsID) {
                $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            }
        }

        if ($bUpdateID) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to save choosing platform related changes
     */
    public function choosePlatform(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $npsID = strip_tags($request->nps_id);
        if ($npsID > 0) {
            $platform = strip_tags($request->platform);
            $aData = array(
                'platform' => $platform,
                'updated' => date("Y-m-d H:i:s")
            );
            $bUpdateID = $mNPS->updateNPS($aData, $userID, $npsID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Get the list of NPS templates
     * @param type $platform
     * @param type $hashKey
     */
    public function template(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $platform = $request->platform;

        $hashKey = $request->hashKey;

        if (!empty($platform)) {
            if (!empty($hashKey)) {
                $oNPS = $mNPS->getSurveyInfoByRef($hashKey);
            }
        }

        return view('admin.modules.nps.email-content-survey', array('oNPS' => $oNPS));
    }

    /**
     * Used to get the score of NPS campaign
     */
    public function score(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $hashKey = $request->hashKey;

        $aBreadcrumb = array(
            'Home' => '#/',
            'NPS Surveys' => '#/modules/nps/overview',
            'Score' => '#/modules/nps/score/'.$hashKey
        );

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($hashKey)) {
            $oFeedback = $mNPS->getNPSScore($hashKey);
            $aScoreSummery = $mNPS->getNPSScoreSummery($hashKey);
        } else {
            $oFeedback = $mNPS->getNPSScore('', $userID);
            $aScoreSummery = $mNPS->getNPSScoreSummery($userID);
        }

        $aPageData = array(
            'title' => 'NPS Score',
            'breadcrumb' => $aBreadcrumb,
            'allData' => $oFeedback,
            'oFeedbacks' => $oFeedback->items(),
            'aSummary' => $aScoreSummery,
            'mNPS'=>$mNPS
        );

        //return view('admin.modules.nps.list-scores', $aPageData)->with(['mNPS'=>$mNPS]);

        return $aPageData;
    }

    /**
     * Used to get Feedback details
     * @param type $scoreID
     */
    public function feedbackdetails(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $scoreID = $request->scoreID;

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oNotes = $mNPS->getNPSNotes($scoreID);
        $oScore = $mNPS->getScoreDetails($scoreID);
        $oTags = $mNPS->getTagsByScoreID($scoreID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/nps/') . '">NPS</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Feedback Details" class="sidebar-control active hidden-xs ">Feedback Details</a></li>
                </ul>';

        return view('admin.modules.nps.feedback_details', array(
            'title' => 'Feedback Details',
            'userID' => $userID,
            'pagename' => $breadcrumb,
            'oScore' => $oScore,
            'oNotes' => $oNotes,
            'oTags' => $oTags,
            'scoreID' => $scoreID
        ));
    }

    /**
     * Used to update NPS notes
     */
    public function saveNPSNotes(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $scoreID = strip_tags($request->scoreid);
            $npsID = strip_tags($request->npsid);
            $userID = strip_tags($request->uid);
            $sNotes = $request->notes;
            $aNotesData = array(
                'score_id' => $scoreID,
                'user_id' => $userID,
                'nps_id' => $npsID,
                'notes' => $sNotes,
                'created' => date("Y-m-d H:i:s")
            );

            $bSaved = $mNPS->saveNPSNotes($aNotesData);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been added succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }

    /**
     * Used to apply NPS tags
     */
    public function applyNPSTag(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $scoreID = strip_tags($request->score_id);
        $aTagID = $request->applytag;
        $aInput = array(
            'aTagIDs' => $aTagID,
            'score_id' => $scoreID
        );

        $bAdded = $mNPS->addNPSTag($aInput);

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

    /**
     * Used to remove nps tags
     */
    public function removeNPSTag(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $scoreID = strip_tags($request->score_id);
        $npsID = strip_tags($request->nps_id);
        $tagID = strip_tags($request->tag_id);

        if (!empty($scoreID) && $scoreID > 0) {
            $bDeleted = $mNPS->removeNPSTag($tagID, $scoreID);
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

    /**
     * Used to get NPS notes by id
     */
    public function getNPSNoteById(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $noteID = strip_tags($request->noteid);
            $noteData = $mNPS->getNPSNoteByID($noteID);
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

    /**
     * Used to delete NPS notes
     */
    public function deleteNPSNote(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array();

        $noteid = strip_tags($request->noteid);
        $result = $mNPS->deleteNPSNoteByID($noteid);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to update NPS notes
     */
    public function updatNotes(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $noteId = strip_tags($request->edit_noteid);
            $sNotes = $request->edit_note_content;
            $aNotesData = array(
                'notes' => $sNotes
            );

            $bSaved = $mNPS->updateNPSNote($aNotesData, $noteId);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been updated succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }

    /**
     * Used to get the list of all nps tags
     */
    public function listAllTags(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $scoreID = $request->score_id;
        if ($scoreID > 0) {
            $aAppliedTags = $mNPS->getTagsByScoreID($scoreID);
        }

        $aTag = $mNPS->getClientTags($userID);
        $sTags = view('admin.tags.mytags', array('oTags' => $aTag, 'aAppliedTags' => $aAppliedTags))->render();
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to register NPS invites
     */
    public function registerInvite(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (!empty($request)) {
            $accountID = strip_tags($request->bbaid);
            $firstName = strip_tags($request->firstname);
            $lastName = strip_tags($request->lastname);
            $email = strip_tags($request->email);
            $phone = strip_tags($request->phone);
            $oGlobalUser = $mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
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
                $iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
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

    /**
     *
     * @param type $aData
     * @return type
     */
    public function registerNow($aData) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $userID = 0;
        if (!empty($aData)) {
            $subscriberID = $aData['subscriber_id'];
            $accountID = $aData['account_id'];
            if (!empty($subscriberID)) {
                $oExistingUser = $mNPS->checkIfExistingUser($subscriberID, $accountID);
                if (!empty($oExistingUser)) {
                    $userID = $oExistingUser->id;
                } else {
                    //Ok we are good now, go ahead and register a new user
                    $userID = $mNPS->addNPSUser($aData);
                }
            }
        }
        return $userID;
    }

    /**
     * Used to export NPS subscribers
     */
    public function exportCSV(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        // file name
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");


        $npsHashId = $request->nps_hash_id;
        $userID = Session::get("current_user_id");
        $allSubscribers = $mNPS->getNPSSubscribers($npsHashId);

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

    /**
     * Used to import NPS subscribers
     */
    public function importInviteCSV(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $accountID = strip_tags($request->bbaid);



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

                    $oGlobalUser = $mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
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
                        $iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
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

    /**
     *
     * @param type $npsID
     */
    public function stats(Request $request) {
        // Instantiate NPS model to get its properties and methods
        $mNPS = new NpsModel();

        $npsID = $request->npsID;

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/nps/') . '">NPS</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Feedback Details" class="sidebar-control active hidden-xs ">NPS Stats</a></li>
                </ul>';

        $oNPSEvents = $mNPS->getNPSEvents($npsID);

        $data = array(
            'title' => 'NPS Stats',
            'pagename' => $breadcrumb,
            'userID' => $userID,
            'oNPSEvents' => $oNPSEvents,
            'type' => 'email'
        );

        return view('admin.modules.nps.nps-stats', $data)->with(['mNPS' => $mNPS]);
    }

    /**
     * Used to parse template tags of a nps template
     * @param type $sCode
     * @param type $type
     * @param type $oNPS
     * @return type
     */
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
            $greeting = "Hi, " . $aUser->firstname . ' ' . $aUser->lastname;
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
