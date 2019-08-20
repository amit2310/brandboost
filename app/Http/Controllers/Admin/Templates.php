<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\TemplatesModel;
use App\Models\Admin\WorkflowModel;
use Cookie;
use Session;

class Templates extends Controller {

    public function index() {
        
    }
    
    
    /**
     * Used to get the list of all email templates
     */
    public function email() {
        $templateLink = base_url('admin/templates/email');
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . $templateLink . '" class="sidebar-control hidden-xs">Templates </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Email Templates" class="sidebar-control active hidden-xs ">Emails</a></li>
                    </ul>';

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $oTemplates = $mTemplates->getCommonTemplates('', '', '', 'email');
        $oCategories = $mTemplates->getCommonTemplateCategories();
        $aData = array(
            'title' => 'Email Templates',
            'pagename' => $breadcrumb,
            'oTemplates' => $oTemplates,
            'oCategories' => $oCategories,
            'templateType' => 'email',
            'method' => 'manage'
        );
        return view('admin.templates.list-templates', $aData);
    }

    
    /**
     * Used to get the list of all sms templates
     */
    public function sms() {
        $templateLink = base_url('admin/templates/sms');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . $templateLink . '" class="sidebar-control hidden-xs">Templates </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="SMS Templates" class="sidebar-control active hidden-xs ">SMS</a></li>
                    </ul>';
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $oTemplates = $mTemplates->getCommonTemplates('', '', '', 'sms');
        $oCategories = $mTemplates->getCommonTemplateCategories();

        $aData = array(
            'title' => 'SMS Templates',
            'pagename' => $breadcrumb,
            'oTemplates' => $oTemplates,
            'oCategories' => $oCategories,
            'templateType' => 'sms',
            'method' => 'manage'
        );
        return view('admin.templates.list-templates', $aData);
    }

    
    /**
     * Used to create user templates
     */
    public function addUserTemplate(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        
        //$userID = ($userID == '1') ? 0 : 1;
        $templateName = strip_tags($request->templateName);
        $category = strip_tags($request->templateCategory);
        $templateType = strip_tags($request->templateType);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'category_id' => $category,
            'template_name' => $templateName,
            'template_type' => $templateType,
            'user_id' => $userID,
            'created' => $dateTime
        );

        $bAlreadyExists = $mTemplates->checkIfTemplateNameExists($templateName, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'Template name already exists');
            echo json_encode($response);
            exit;
        }

        $insertID = $mTemplates->addUserTemplate($aData);
        if ($insertID > 0) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'template_added',
                'action_name' => 'template_added',
                'automation_id' => $insertID,
                'list_id' => '',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Added a new template',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'id' => $insertID, 'msg' => "Template added successfully!");

            $notificationData = array(
                'event_type' => 'added_user_template',
                'event_id' => 0,
                'link' => base_url() . 'admin/templates/edit/' . $insertID,
                'message' => 'Added a new template',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_template_added';
            add_notifications($notificationData, $eventName, $userID);
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * 
     * @param type $idUsed to edit email/sms template
     */
    public function edit(Request $request) {
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        $id=$request->id;
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $oTemplate = $mTemplates->getCommonTemplates($userID, '', $id, '');
        $templateType = $oTemplate[0]->template_type;
        if ($templateType == 'email') {
            $activeTitle = 'Email';
            $templateLink = base_url('admin/templates/email');
        } else {
            $activeTitle = 'SMS';
            $templateLink = base_url('admin/templates/sms');
            
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . $templateLink . '" class="sidebar-control hidden-xs">Templates </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Edit Template" class="sidebar-control active hidden-xs ">'.$activeTitle.'</a></li>
                    </ul>';
        $aData = array(
            'title' => 'Edit Template',
            'pagename' => $breadcrumb,
            'templateID' => $id,
            'oTemplate' => $oTemplate,
            'templateType' => $templateType,
            'oUser' => $aUser
        );
        return view('admin.templates.edit', $aData);
    }

    
    /**
     * Used to update User's Email/Sms templates
     */
    public function updateUserTemplate(Request $request) {
        $response = array();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();

        $compiledHtml = $request->compiled_html;
        $templateID = strip_tags($request->templateId);

        $aData = array();



        if (!empty($compiledHtml)) {
            $aData['stripo_compiled_html'] = base64_encode($compiledHtml);
        }

        $bUpdated = $mTemplates->updateCommonTemplate($aData, $templateID, $userID);

        if ($bUpdated) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'Error';
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to update user template name
     */
    public function updateUserTemplateName(Request $request) {
        $response = array();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();

        $compiledHtml = $request->compiled_html;
        $templateID = strip_tags($request->templateId);
        $templateName = strip_tags($request->templateName);

        $aData = array();



        if (!empty($templateName)) {
            $aData['template_name'] = $templateName;
        }

        $bAlreadyExists = $mTemplates->checkIfTemplateNameExists($templateName, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'Template name already exists');
            echo json_encode($response);
            exit;
        }

        $bUpdated = $mTemplates->updateCommonTemplate($aData, $templateID, $userID);

        if ($bUpdated) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'Error';
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * This function used to load the content of selected email template
     */
    public function loadEmailTemplate(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $id = $request->id;
        $oTemplate = $mTemplates->getCommonTemplates($userID, '', $id, '');
        $compiledSource = $oTemplate[0]->stripo_compiled_html;
        $aData = array(
            'templateID' => $oTemplate[0]->id,
            'compiledSource' => $compiledSource
        );
        return view('admin.templates.email-editor', $aData);
    }

    
    /**
     * This function used to load the content of selected sms template
     * @param type $id
     */
    public function loadSMSTemplate(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $id = $request->id;
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $oTemplate = $mTemplates->getCommonTemplates($userID, '', $id, '');
        $compiledSource = $oTemplate[0]->stripo_compiled_html;
        $aData = array(
            'templateID' => $oTemplate[0]->id,
            'compiledSource' => $compiledSource
        );
        return view('admin.templates.sms-editor', $aData);
    }

    
    /**
     * Used to get the list of categorized templates
     */
    public function getCategorizedTemplates(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $userID = $aUser->id;
        
        $actionName = strip_tags($request->action);
        $categoryID = strip_tags($request->categoryid);
        $selected_template = strip_tags($request->selected_template);
        $campaignType = strip_tags($request->campaign_type);
        $method = strip_tags($request->method);

        if (empty($campaignType)) {
            $campaignType = 'email';
        }

        $moduleName = 'broadcast';
        $source = '';

        if ($actionName == 'category') {
            $oCategorizedTemplates = $mTemplates->getCommonTemplates('', $categoryID, '', $campaignType);
        } else if ($actionName == 'my') {
            $oCategorizedTemplates = $mTemplates->getCommonTemplates($userID, '', '', $campaignType);
            $source = 'my';
        } else if ($actionName == 'draft') {
            $oCategorizedTemplates = $mTemplates->getCommonDraftTemplates($userID, '', $campaignType);
            $source = 'draft';
        } else if ($actionName == 'all') {
            //echo "Campaign Type is". $campaignType;
            $oCategorizedTemplates = $mTemplates->getCommonTemplates('', '', '', $campaignType, $bHideStaticTemplate = true);
        }

        //pre($oCategorizedTemplates);

        if ($campaignType == 'email') {
            $templateList = view('admin.templates.emails.partials.categorized_template_list', array('oCategorizedTemplates' => $oCategorizedTemplates, 'selected_template' => $selected_template, 'source' => $source, 'campaignType' => $campaignType, 'aUser' => $aUser, 'method' => $method))->render();
        }

        if ($campaignType == 'sms') {
            $templateList = view('admin.templates.sms.partials.categorized_template_list', array('oCategorizedTemplates' => $oCategorizedTemplates, 'selected_template' => $selected_template, 'source' => $source, 'campaignType' => $campaignType, 'aUser' => $aUser, 'method' => $method))->render();
        }



        if (!empty($templateList)) {
            $response = array('status' => 'success', 'actionName' => $actionName, 'content' => $templateList);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    
    /**
     * 
     * @param type $tempID
     * @param type $draft
     * @param type $uidUsed to load preview content of the selected template
     */
    public function loadTemplatePreview(Request $request, $tempID = '', $draft = '', $uid = '') {
        $bURLPreview = false;
        
        $aUser = getLoggedUser();
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $userID = $aUser->id;
        $templateID = ($request->template_id);
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitId);
        //echo "template ID is ". $templateID;
        $source = strip_tags($request->source);
        $isDraft = ($source == 'draft') ? true : false;
        $templateTags = $mTemplates->getTemplateTags();
        if (!empty($tempID)) {
            $bURLPreview = true;
            $templateID = $tempID;
            $userID = $uid;
            if (!empty($draft)) {
                $isDraft = true;
            }
        }

        if ($isDraft == true) {
            //$moduleName, $templateID, $userID
            $oResponse = $mTemplates->getCommonDraftTemplates($userID, $templateID);
        } elseif ($source == 'my') {
            $oResponse = $mTemplates->getCommonTemplates($userID, '', $templateID);
        } else {
            $oResponse = $mTemplates->getCommonTemplates('', '', $templateID);
        }

        $subject = $oResponse[0]->template_subject;

        $aData = array(
            'templateID' => $templateID,
            'subject' => $subject,
            'greeting' => $oResponse[0]->greeting,
            'introduction' => $oResponse[0]->introduction,
            'tags' => $templateTags,
            'campaign_type' => isset($oResponse[0]->campaign_type) ? $oResponse[0]->campaign_type : ''
        );
        $sHtml = $this->loadStripoResources('', $templateID, true, $isDraft, $source, $moduleName, $moduleUnitID);
        if ($bURLPreview == true) {
            echo $sHtml;
            exit;
        } else {
            //return view('admin.templates.stripo_template', $aData);
        }

        $response['status'] = 'success';
        $response['content'] = $sHtml;
        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to load Strip Resources(This will be deprecated soon)
     */
    public function loadStripoResources($type, $templateID, $returnType = false, $isDraft = false, $source = '', $modName = '', $moduleUnitID = '') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $mWorkflow = new WorkflowModel();
        
        if ($isDraft == true) {
            $oResponse = $mTemplates->getCommonDraftTemplates($userID, $templateID);
        } else if ($source == 'my') {
            $oResponse = $mTemplates->getCommonTemplates($userID, '', $templateID);
        } else {
            $oResponse = $mTemplates->getCommonTemplates('', '', $templateID);
        }

        if (!empty($modName) && $moduleUnitID) {
            $oUnitData = $mWorkflow->getModuleUnitInfo($modName, $moduleUnitID);
        }

        if (!empty($oResponse)) {
            $categoryStatus = $oResponse[0]->category_status;
            $moduleName = $oResponse[0]->module_name;
            $subject = $oResponse[0]->template_subject;
            $html = base64_decode($oResponse[0]->stripo_html);
            $css = base64_decode($oResponse[0]->stripo_css);
            $compiled = base64_decode($oResponse[0]->stripo_compiled_html);
            $templateTags = $mTemplates->getTemplateTags();
            $campaignType = $oResponse[0]->template_type;

            $blankStripoContent = $this->getStripoBlankTemplateContent();

            $blankHtml = base64_decode($blankStripoContent['html']);
            $blankCss = base64_decode($blankStripoContent['css']);
            $blankCompiled = base64_decode($blankStripoContent['compiled']);

            if ($categoryStatus == 2) {
                //Static Template
                if ($moduleName == 'nps') {
                    if (strtolower($oResponse[0]->template_type) == 'email') {
                        $sEmailPreview = view('admin.modules.nps.nps-templates.email.templates', array('template_slug' => $oResponse[0]->template_slug, 'oNPS' => $oUnitData))->render();
                        $compiled = $this->parseModuleStatictemplate($moduleName, $sEmailPreview, 'email', $oUnitData);
                    } else if (strtolower($oResponse[0]->template_type) == 'sms') {
                        $sSMSPreview = view('admin.modules.nps.nps-templates.sms.templates', array('template_slug' => $oResponse[0]->template_slug, 'oNPS' => $oUnitData))->render();
                        $compiled = $this->parseModuleStatictemplate($moduleName, $sSMSPreview, 'sms', $oUnitData);
                    }
                } else if ($moduleName == 'referral') {
                    if (strtolower($oResponse[0]->template_type) == 'email') {
                        $compiled = view('admin.modules.referral.referral-templates.email.templates', array('template_slug' => $oResponse[0]->template_slug))->render();
                    } else if (strtolower($oResponse[0]->template_type) == 'sms') {
                        $compiled = view('admin.modules.referral.referral-templates.sms.templates', array('template_slug' => $oResponse[0]->template_slug))->render();
                    }
                } else if ($moduleName == 'onsite' || $moduleName == 'offsite' || $moduleName == 'brandboost') {
                    if ($moduleName == 'onsite') {
                        if (strtolower($oResponse[0]->template_type) == 'email') {
                            $compiled = view('admin.brandboost.brand-templates.onsite.email.templates', array('template_slug' => $oResponse[0]->template_slug))->render();
                        } else if (strtolower($oResponse[0]->template_type) == 'sms') {
                            $compiled = view('admin.brandboost.brand-templates.onsite.sms.templates', array('template_slug' => $oResponse[0]->template_slug))->render();
                        }
                    }

                    if ($moduleName == 'offsite') {
                        if (strtolower($oResponse[0]->template_type) == 'email') {
                            $compiled = view('admin.brandboost.brand-templates.offsite.email.templates', array('template_slug' => $oResponse[0]->template_slug))->render();
                            //echo "compiled Slug is ". $oResponse[0]->template_slug;
                        } else if (strtolower($oResponse[0]->template_type) == 'sms') {
                            $compiled = view('admin.brandboost.brand-templates.offsite.sms.templates', array('template_slug' => $oResponse[0]->template_slug))->render();
                        }
                    }

                    if (!empty($compiled)) {
                        $compiled = $this->brandboostEmailTagReplace($moduleUnitID, $compiled, strtolower($oResponse[0]->template_type), $aUser);
                        
                    }
                }
            }



            $stripo_html = (!empty($html)) ? $html : $blankHtml;

            $stripo_css = (!empty($css)) ? $css : $blankCss;

            $stripo_compiled = (!empty($compiled)) ? $compiled : $blankCompiled;

            if (strtolower($campaignType) == 'sms') {
                $stripo_compiled = '<div class="sms_preview">' . $stripo_compiled . '</div>';
            }

            if ($returnType == true) {
                return $stripo_compiled;
                exit;
            }

            $aData = array(
                'templateID' => $templateID,
                'html' => $stripo_html,
                'css' => $stripo_css,
                'compiled_source' => $stripo_compiled,
                'tags' => $templateTags
            );

            if ($type == 'html') {
                echo $stripo_html;
            } else if ($type == 'css') {
                echo $stripo_css;
            }
        }
    }

    
    /**
     * Used to parse the template tags for selected module
     */
    public function parseModuleStatictemplate($moduleName, $sCode, $type, $oUnitData) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($oUnitData)) {
            $hashCode = $oUnitData->hashcode;
            $ownerID = $oUnitData->user_id;
            $title = $oUnitData->title;
            $platform = $oUnitData->platform;
            $brandName = $oUnitData->brand_name;
            $brandLogoURL = $oUnitData->brand_logo;
            $btnColor = $oUnitData->web_button_color;
            $txtColor = $oUnitData->web_text_color;
            $btnShape = $oUnitData->web_button_shape;
            $desc = $oUnitData->description;
            $ques = $oUnitData->question;
            $btnTxtColor = $oUnitData->web_button_text_color;
        } else {
            $hashCode = $oUnitData->hashcode;
            $ownerID = $userID;
            $title = 'Title goes here';
            $platform = 'Platform goes here';
            $brandName = 'Brand Name';
            $brandLogoURL = $oUnitData->brand_logo;
            $btnColor = '';
            $txtColor = '';
            $btnShape = '';
            $desc = 'Description goes here';
            $ques = 'Question goes here';
        }
        $greetings = 'Hi, ' . $aUser->firstname . ' ' . $aUser->lastname . '!';
        $description = (!empty($desc)) != '' ? $desc : '{{INTRODUCTION}}';
        $question = (!empty($ques)) ? $ques : 'How likely are you to recommend My Store to a friend?';
        if ($type == 'email') {
            $aTemplateTags = array(
                '{{BRAND_LOGO}}',
                '{{INTRODUCTION}}',
                '{INTRODUCTION}',
                '{{TEXT_COLOR}}',
                '{{BUTTON_COLOR}}',
                '{{BUTTON_TEXT_COLOR}}',
                '{{BUTTON_SHAPE}}',
                '{{QUESTION}}',
                '{{RATE_LINK}}',
                '{{SURVEYURL}}',
                '{GREETING}',
                '{{INTRODUCTION_TEXT_COLOR}}'
            );

            $brandLogo = !(empty($brandLogoURL)) ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandLogoURL : base_url() . 'assets/images/face2.jpg';
            $textColor = !(empty($txtColor)) ? $txtColor : '#111111';
            $introTextColor = !(empty($introTxtColor)) ? $introTxtColor : '#000000';
            $buttonColor = (!empty($btnColor)) ? $btnColor : '#FFFFFF';
            $buttonShape = (!empty($oUnitData->web_button_shape)) ? $btnShape == 'circle' ? '50%' : '0px' : '100px';
            $buttonTextColor = !(empty($btnTxtColor)) ? $btnTxtColor : '#000000';
            $rateLink = base_url() . "nps/t/{$hashCode}";
            $surveyLink = base_url() . "survey/{$hashCode}?securityToken=" . date('Ymdhis');

            $aSource = array(
                $brandLogo,
                $description,
                $description,
                $textColor,
                $buttonColor,
                $buttonTextColor,
                $buttonShape,
                $question,
                $rateLink,
                $surveyLink,
                $greetings,
                $introTextColor
            );
        }

        if ($type == 'sms') {

            $question = (!empty($ques)) ? $ques : 'How likely are you to recommend My Store to a friend?';
            $surveyLink = base_url() . "survey/{$hashCode}";
            $aTemplateTags = array(
                '{{INTRODUCTION}}',
                '{INTRODUCTION}',
                '{{QUESTION}}',
                '{GREETING}'
            );
            $aSource = array(
                $description,
                $description,
                $question,
                $greetings
            );
        }
        //pre($aTemplateTags);
        //pre($aSource);

        $compiledCode = str_replace($aTemplateTags, $aSource, $sCode);
        return $compiledCode;
    }

    
    /**
     * This function retrun the blank template html content
     */
    public function getStripoBlankTemplateContent() {
        $html = 'PCFET0NUWVBFIGh0bWwgUFVCTElDICItLy9XM0MvL0RURCBYSFRNTCAxLjAgVHJhbnNpdGlvbmFsLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL1RSL3hodG1sMS9EVEQveGh0bWwxLXRyYW5zaXRpb25hbC5kdGQiPjxodG1sPjxoZWFkPiAKICA8bWV0YSBjaGFyc2V0PSJVVEYtOCI+IAogIDxtZXRhIGNvbnRlbnQ9IndpZHRoPWRldmljZS13aWR0aCwgaW5pdGlhbC1zY2FsZT0xIiBuYW1lPSJ2aWV3cG9ydCI+IAogIDxtZXRhIG5hbWU9IngtYXBwbGUtZGlzYWJsZS1tZXNzYWdlLXJlZm9ybWF0dGluZyI+IAogIDxtZXRhIGh0dHAtZXF1aXY9IlgtVUEtQ29tcGF0aWJsZSIgY29udGVudD0iSUU9ZWRnZSI+IAogIDxtZXRhIGNvbnRlbnQ9InRlbGVwaG9uZT1ubyIgbmFtZT0iZm9ybWF0LWRldGVjdGlvbiI+IAogIDx0aXRsZT48L3RpdGxlPiAKICA8IS0tW2lmIChtc28gMTYpXT4KICAgIDxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+CiAgICBhIHt0ZXh0LWRlY29yYXRpb246IG5vbmU7fQogICAgPC9zdHlsZT4KICAgIDwhW2VuZGlmXS0tPiAKICA8IS0tW2lmIGd0ZSBtc28gOV0+PHN0eWxlPnN1cCB7IGZvbnQtc2l6ZTogMTAwJSAhaW1wb3J0YW50OyB9PC9zdHlsZT48IVtlbmRpZl0tLT4gCiA8L2hlYWQ+PGJvZHkgc3R5bGU9ImRpc3BsYXk6IGJsb2NrOyI+IAogIDxkaXYgY2xhc3M9ImVzLXdyYXBwZXItY29sb3IiPiAKICAgPCEtLVtpZiBndGUgbXNvIDldPgoJCQk8djpiYWNrZ3JvdW5kIHhtbG5zOnY9InVybjpzY2hlbWFzLW1pY3Jvc29mdC1jb206dm1sIiBmaWxsPSJ0Ij4KCQkJCTx2OmZpbGwgdHlwZT0idGlsZSIgc3JjPSIiIGNvbG9yPSIjZjZmNmY2Ij48L3Y6ZmlsbD4KCQkJPC92OmJhY2tncm91bmQ+CgkJPCFbZW5kaWZdLS0+IAogICA8dGFibGUgY2xhc3M9ImVzLXdyYXBwZXIiIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgIDx0Ym9keT4gCiAgICAgPHRyPiAKICAgICAgPHRkIGNsYXNzPSJlc2QtZW1haWwtcGFkZGluZ3MiIHZhbGlnbj0idG9wIj4gCiAgICAgICA8dGFibGUgY2xhc3M9ImVzZC1oZWFkZXItcG9wb3ZlciBlcy1jb250ZW50IiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJjZW50ZXIiPiAKICAgICAgICA8dGJvZHk+IAogICAgICAgICA8dHI+IAogICAgICAgICAgPHRkIGNsYXNzPSJlc2Qtc3RyaXBlIiBhbGlnbj0iY2VudGVyIj4KICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAKICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgICAKICAgICAgICAgICA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQtYm9keSIgc3R5bGU9ImJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OyIgd2lkdGg9IjYwMCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0iY2VudGVyIiBlc2QtaW1nLXByZXYtc3JjPSIiPiAKICAgICAgICAgICAgPHRib2R5PiAKICAgICAgICAgICAgIDx0cj4gCiAgICAgICAgICAgICAgPHRkIGNsYXNzPSJlc2Qtc3RydWN0dXJlIGVzLXAyMHQgZXMtcDIwYiBlcy1wMjByIGVzLXAyMGwiIGFsaWduPSJsZWZ0Ij4KICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgIDwhLS1baWYgbXNvXT48dGFibGUgd2lkdGg9IjU2MCIgY2VsbHBhZGRpbmc9IjAiIGNlbGxzcGFjaW5nPSIwIj48dHI+PHRkIHdpZHRoPSIzNTYiIHZhbGlnbj0idG9wIj48IVtlbmRpZl0tLT4gCiAgICAgICAgICAgICAgIDx0YWJsZSBjbGFzcz0iZXMtbGVmdCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0ibGVmdCI+IAogICAgICAgICAgICAgICAgPHRib2R5PiAKICAgICAgICAgICAgICAgICA8dHI+IAogICAgICAgICAgICAgICAgICA8dGQgY2xhc3M9ImVzLW0tcDByIGVzLW0tcDIwYiBlc2QtY29udGFpbmVyLWZyYW1lIiB3aWR0aD0iMzU2IiB2YWxpZ249InRvcCIgYWxpZ249ImNlbnRlciI+CiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgICAgICAgICAgICAgICAgICA8dGJvZHk+IAogICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgPHRyPjx0ZCBhbGlnbj0iY2VudGVyIiBjbGFzcz0iZXNkLWVtcHR5LWNvbnRhaW5lciIgc3R5bGU9ImRpc3BsYXk6IG5vbmU7Ij48L3RkPjwvdHI+PC90Ym9keT4gCiAgICAgICAgICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgICAgICAgICA8L3RyPiAKICAgICAgICAgICAgICAgIDwvdGJvZHk+IAogICAgICAgICAgICAgICA8L3RhYmxlPiAKICAgICAgICAgICAgICAgPCEtLVtpZiBtc29dPjwvdGQ+PHRkIHdpZHRoPSIyMCI+PC90ZD48dGQgd2lkdGg9IjE4NCIgdmFsaWduPSJ0b3AiPjwhW2VuZGlmXS0tPiAKICAgICAgICAgICAgICAgPHRhYmxlIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgYWxpZ249InJpZ2h0Ij4gCiAgICAgICAgICAgICAgICA8dGJvZHk+IAogICAgICAgICAgICAgICAgIDx0cj4gCiAgICAgICAgICAgICAgICAgIDx0ZCBjbGFzcz0iZXNkLWNvbnRhaW5lci1mcmFtZSIgd2lkdGg9IjE4NCIgYWxpZ249ImxlZnQiPgogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgIDx0YWJsZSB3aWR0aD0iMTAwJSIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIj4gCiAgICAgICAgICAgICAgICAgICAgPHRib2R5PiAKICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgIDx0cj48dGQgYWxpZ249ImNlbnRlciIgY2xhc3M9ImVzZC1lbXB0eS1jb250YWluZXIiIHN0eWxlPSJkaXNwbGF5OiBub25lOyI+PC90ZD48L3RyPjwvdGJvZHk+IAogICAgICAgICAgICAgICAgICAgPC90YWJsZT4gPC90ZD4gCiAgICAgICAgICAgICAgICAgPC90cj4gCiAgICAgICAgICAgICAgICA8L3Rib2R5PiAKICAgICAgICAgICAgICAgPC90YWJsZT4gCiAgICAgICAgICAgICAgIDwhLS1baWYgbXNvXT48L3RkPjwvdHI+PC90YWJsZT48IVtlbmRpZl0tLT4gPC90ZD4gCiAgICAgICAgICAgICA8L3RyPiAKICAgICAgICAgICAgPC90Ym9keT4gCiAgICAgICAgICAgPC90YWJsZT4gPC90ZD4gCiAgICAgICAgIDwvdHI+IAogICAgICAgIDwvdGJvZHk+IAogICAgICAgPC90YWJsZT4gCiAgICAgICAgCiAgICAgICAgCiAgICAgICA8dGFibGUgY2xhc3M9ImVzZC1mb290ZXItcG9wb3ZlciBlcy1jb250ZW50IiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJjZW50ZXIiPiAKICAgICAgICA8dGJvZHk+IAogICAgICAgICA8dHI+IAogICAgICAgICAgPHRkIGNsYXNzPSJlc2Qtc3RyaXBlIiBhbGlnbj0iY2VudGVyIj4KICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAKICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgICAKICAgICAgICAgICA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQtYm9keSIgc3R5bGU9ImJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OyIgd2lkdGg9IjYwMCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0iY2VudGVyIj4gCiAgICAgICAgICAgIDx0Ym9keT4gCiAgICAgICAgICAgICA8dHI+IAogICAgICAgICAgICAgIDx0ZCBjbGFzcz0iZXNkLXN0cnVjdHVyZSBlcy1wMzBiIGVzLXAyMHIgZXMtcDIwbCIgYWxpZ249ImxlZnQiPgogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgICAgICAgICAgICAgIDx0Ym9keT4gCiAgICAgICAgICAgICAgICAgPHRyPiAKICAgICAgICAgICAgICAgICAgPHRkIGNsYXNzPSJlc2QtY29udGFpbmVyLWZyYW1lIiB3aWR0aD0iNTYwIiB2YWxpZ249InRvcCIgYWxpZ249ImNlbnRlciI+CiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgICAgICAgICAgICAgICAgICA8dGJvZHk+IAogICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgPHRyPjx0ZCBhbGlnbj0iY2VudGVyIiBjbGFzcz0iZXNkLWVtcHR5LWNvbnRhaW5lciIgc3R5bGU9ImRpc3BsYXk6IG5vbmU7Ij48L3RkPjwvdHI+PC90Ym9keT4gCiAgICAgICAgICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgICAgICAgICA8L3RyPiAKICAgICAgICAgICAgICAgIDwvdGJvZHk+IAogICAgICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgICAgIDwvdHI+IAogICAgICAgICAgICA8L3Rib2R5PiAKICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgPC90cj4gCiAgICAgICAgPC90Ym9keT4gCiAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICA8L3RyPiAKICAgIDwvdGJvZHk+IAogICA8L3RhYmxlPiAKICA8L2Rpdj4gCiA8L2JvZHk+PC9odG1sPg==';

        $css = 'LyoKQ09ORklHIFNUWUxFUwpQbGVhc2UgZG8gbm90IGRlbGV0ZSBhbmQgZWRpdCBDU1Mgc3R5bGVzIGJlbG93CiovCi8qIElNUE9SVEFOVCBUSElTIFNUWUxFUyBNVVNUIEJFIE9OIEZJTkFMIEVNQUlMICovCgojb3V0bG9vayBhIHsKCXBhZGRpbmc6IDA7Cn0KLkV4dGVybmFsQ2xhc3MgewoJd2lkdGg6IDEwMCU7Cn0KLkV4dGVybmFsQ2xhc3MsCi5FeHRlcm5hbENsYXNzIHAsCi5FeHRlcm5hbENsYXNzIHNwYW4sCi5FeHRlcm5hbENsYXNzIGZvbnQsCi5FeHRlcm5hbENsYXNzIHRkLAouRXh0ZXJuYWxDbGFzcyBkaXYgewoJbGluZS1oZWlnaHQ6IDEwMCU7Cn0KLmVzLWJ1dHRvbiB7Cgltc28tc3R5bGUtcHJpb3JpdHk6IDEwMCAhaW1wb3J0YW50OwoJdGV4dC1kZWNvcmF0aW9uOiBub25lICFpbXBvcnRhbnQ7Cn0KYVt4LWFwcGxlLWRhdGEtZGV0ZWN0b3JzXSB7Cgljb2xvcjogaW5oZXJpdCAhaW1wb3J0YW50OwoJdGV4dC1kZWNvcmF0aW9uOiBub25lICFpbXBvcnRhbnQ7Cglmb250LXNpemU6IGluaGVyaXQgIWltcG9ydGFudDsKCWZvbnQtZmFtaWx5OiBpbmhlcml0ICFpbXBvcnRhbnQ7Cglmb250LXdlaWdodDogaW5oZXJpdCAhaW1wb3J0YW50OwoJbGluZS1oZWlnaHQ6IGluaGVyaXQgIWltcG9ydGFudDsKfQouZXMtZGVzay1oaWRkZW4gewogICAgZGlzcGxheTogbm9uZTsKICAgIGZsb2F0OiBsZWZ0OwogICAgb3ZlcmZsb3c6IGhpZGRlbjsKICAgIHdpZHRoOiAwOwogICAgbWF4LWhlaWdodDogMDsKICAgIGxpbmUtaGVpZ2h0OiAwOwogICAgbXNvLWhpZGU6IGFsbDsKfQovKgpFTkQgT0YgSU1QT1JUQU5UCiovCmh0bWwsCmJvZHkgewoJd2lkdGg6IDEwMCU7Cglmb250LWZhbWlseTogYXJpYWwsICdoZWx2ZXRpY2EgbmV1ZScsIGhlbHZldGljYSwgc2Fucy1zZXJpZjsKCS13ZWJraXQtdGV4dC1zaXplLWFkanVzdDogMTAwJTsKCS1tcy10ZXh0LXNpemUtYWRqdXN0OiAxMDAlOwp9CnRhYmxlIHsKCW1zby10YWJsZS1sc3BhY2U6IDBwdDsKCW1zby10YWJsZS1yc3BhY2U6IDBwdDsKCWJvcmRlci1jb2xsYXBzZTogY29sbGFwc2U7Cglib3JkZXItc3BhY2luZzogMHB4Owp9CnRhYmxlIHRkLApodG1sLApib2R5LAouZXMtd3JhcHBlciB7CglwYWRkaW5nOiAwOwoJTWFyZ2luOiAwOwp9Ci5lcy1jb250ZW50LAouZXMtaGVhZGVyLAouZXMtZm9vdGVyIHsKCXRhYmxlLWxheW91dDogZml4ZWQgIWltcG9ydGFudDsKCXdpZHRoOiAxMDAlOwp9CmltZyB7CglkaXNwbGF5OiBibG9jazsKCWJvcmRlcjogMDsKCW91dGxpbmU6IG5vbmU7Cgl0ZXh0LWRlY29yYXRpb246IG5vbmU7CgktbXMtaW50ZXJwb2xhdGlvbi1tb2RlOiBiaWN1YmljOwp9CnRhYmxlIHRyIHsKCWJvcmRlci1jb2xsYXBzZTogY29sbGFwc2U7Cn0KcCwKaHIgewoJTWFyZ2luOiAwOwp9CmgxLApoMiwKaDMsCmg0LApoNSB7CglNYXJnaW46IDA7CglsaW5lLWhlaWdodDogMTIwJTsKCW1zby1saW5lLWhlaWdodC1ydWxlOiBleGFjdGx5OwoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7Cn0KcCwKdWwgbGksCm9sIGxpLAphIHsKCS13ZWJraXQtdGV4dC1zaXplLWFkanVzdDogbm9uZTsKCS1tcy10ZXh0LXNpemUtYWRqdXN0OiBub25lOwoJbXNvLWxpbmUtaGVpZ2h0LXJ1bGU6IGV4YWN0bHk7Cn0KLmVzLWxlZnQgewoJZmxvYXQ6IGxlZnQ7Cn0KLmVzLXJpZ2h0IHsKCWZsb2F0OiByaWdodDsKfQouZXMtcDUgewoJcGFkZGluZzogNXB4Owp9Ci5lcy1wNXQgewoJcGFkZGluZy10b3A6IDVweDsKfQouZXMtcDViIHsKCXBhZGRpbmctYm90dG9tOiA1cHg7Cn0KLmVzLXA1bCB7CglwYWRkaW5nLWxlZnQ6IDVweDsKfQouZXMtcDVyIHsKCXBhZGRpbmctcmlnaHQ6IDVweDsKfQouZXMtcDEwIHsKCXBhZGRpbmc6IDEwcHg7Cn0KLmVzLXAxMHQgewoJcGFkZGluZy10b3A6IDEwcHg7Cn0KLmVzLXAxMGIgewoJcGFkZGluZy1ib3R0b206IDEwcHg7Cn0KLmVzLXAxMGwgewoJcGFkZGluZy1sZWZ0OiAxMHB4Owp9Ci5lcy1wMTByIHsKCXBhZGRpbmctcmlnaHQ6IDEwcHg7Cn0KLmVzLXAxNSB7CglwYWRkaW5nOiAxNXB4Owp9Ci5lcy1wMTV0IHsKCXBhZGRpbmctdG9wOiAxNXB4Owp9Ci5lcy1wMTViIHsKCXBhZGRpbmctYm90dG9tOiAxNXB4Owp9Ci5lcy1wMTVsIHsKCXBhZGRpbmctbGVmdDogMTVweDsKfQouZXMtcDE1ciB7CglwYWRkaW5nLXJpZ2h0OiAxNXB4Owp9Ci5lcy1wMjAgewoJcGFkZGluZzogMjBweDsKfQouZXMtcDIwdCB7CglwYWRkaW5nLXRvcDogMjBweDsKfQouZXMtcDIwYiB7CglwYWRkaW5nLWJvdHRvbTogMjBweDsKfQouZXMtcDIwbCB7CglwYWRkaW5nLWxlZnQ6IDIwcHg7Cn0KLmVzLXAyMHIgewoJcGFkZGluZy1yaWdodDogMjBweDsKfQouZXMtcDI1IHsKCXBhZGRpbmc6IDI1cHg7Cn0KLmVzLXAyNXQgewoJcGFkZGluZy10b3A6IDI1cHg7Cn0KLmVzLXAyNWIgewoJcGFkZGluZy1ib3R0b206IDI1cHg7Cn0KLmVzLXAyNWwgewoJcGFkZGluZy1sZWZ0OiAyNXB4Owp9Ci5lcy1wMjVyIHsKCXBhZGRpbmctcmlnaHQ6IDI1cHg7Cn0KLmVzLXAzMCB7CglwYWRkaW5nOiAzMHB4Owp9Ci5lcy1wMzB0IHsKCXBhZGRpbmctdG9wOiAzMHB4Owp9Ci5lcy1wMzBiIHsKCXBhZGRpbmctYm90dG9tOiAzMHB4Owp9Ci5lcy1wMzBsIHsKCXBhZGRpbmctbGVmdDogMzBweDsKfQouZXMtcDMwciB7CglwYWRkaW5nLXJpZ2h0OiAzMHB4Owp9Ci5lcy1wMzUgewoJcGFkZGluZzogMzVweDsKfQouZXMtcDM1dCB7CglwYWRkaW5nLXRvcDogMzVweDsKfQouZXMtcDM1YiB7CglwYWRkaW5nLWJvdHRvbTogMzVweDsKfQouZXMtcDM1bCB7CglwYWRkaW5nLWxlZnQ6IDM1cHg7Cn0KLmVzLXAzNXIgewoJcGFkZGluZy1yaWdodDogMzVweDsKfQouZXMtcDQwIHsKCXBhZGRpbmc6IDQwcHg7Cn0KLmVzLXA0MHQgewoJcGFkZGluZy10b3A6IDQwcHg7Cn0KLmVzLXA0MGIgewoJcGFkZGluZy1ib3R0b206IDQwcHg7Cn0KLmVzLXA0MGwgewoJcGFkZGluZy1sZWZ0OiA0MHB4Owp9Ci5lcy1wNDByIHsKCXBhZGRpbmctcmlnaHQ6IDQwcHg7Cn0KLmVzLW1lbnUgdGQgewoJYm9yZGVyOiAwOwp9Ci5lcy1tZW51IHRkIGEgaW1nIHsKCWRpc3BsYXk6IGlubGluZSAhaW1wb3J0YW50Owp9Ci8qCkVORCBDT05GSUcgU1RZTEVTCiovCmEgewoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7Cglmb250LXNpemU6IDE0cHg7Cgl0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTsKfQpoMSB7Cglmb250LXNpemU6IDMwcHg7Cglmb250LXN0eWxlOiBub3JtYWw7Cglmb250LXdlaWdodDogbm9ybWFsOwoJY29sb3I6ICMzMzMzMzM7Cn0KaDEgYSB7Cglmb250LXNpemU6IDMwcHg7Cn0KaDIgewoJZm9udC1zaXplOiAyNHB4OwoJZm9udC1zdHlsZTogbm9ybWFsOwoJZm9udC13ZWlnaHQ6IG5vcm1hbDsKCWNvbG9yOiAjMzMzMzMzOwp9CmgyIGEgewoJZm9udC1zaXplOiAyNHB4Owp9CmgzIHsKCWZvbnQtc2l6ZTogMjBweDsKCWZvbnQtc3R5bGU6IG5vcm1hbDsKCWZvbnQtd2VpZ2h0OiBub3JtYWw7Cgljb2xvcjogIzMzMzMzMzsKfQpoMyBhIHsKCWZvbnQtc2l6ZTogMjBweDsKfQpwLAp1bCBsaSwKb2wgbGkgewoJZm9udC1zaXplOiAxNHB4OwoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7CglsaW5lLWhlaWdodDogMTUwJTsKfQp1bCBsaSwKb2wgbGkgewoJTWFyZ2luLWJvdHRvbTogMTVweDsKfQouZXMtbWVudSB0ZCBhIHsKCXRleHQtZGVjb3JhdGlvbjogbm9uZTsKCWRpc3BsYXk6IGJsb2NrOwp9Ci5lcy13cmFwcGVyIHsKCXdpZHRoOiAxMDAlOwoJaGVpZ2h0OiAxMDAlOwoJYmFja2dyb3VuZC1pbWFnZTogOwoJYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdDsKCWJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlciB0b3A7Cn0KLmVzLXdyYXBwZXItY29sb3IgewoJYmFja2dyb3VuZC1jb2xvcjogI2Y2ZjZmNjsKfQouZXMtY29udGVudC1ib2R5IHsKCWJhY2tncm91bmQtY29sb3I6ICNmZmZmZmY7Cn0KLmVzLWNvbnRlbnQtYm9keSBwLAouZXMtY29udGVudC1ib2R5IHVsIGxpLAouZXMtY29udGVudC1ib2R5IG9sIGxpIHsKCWNvbG9yOiAjMzMzMzMzOwp9Ci5lcy1jb250ZW50LWJvZHkgYSB7Cgljb2xvcjogIzEzNzZjODsKfQouZXMtaGVhZGVyIHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OwoJYmFja2dyb3VuZC1pbWFnZTogOwoJYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdDsKCWJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlciB0b3A7Cn0KLmVzLWhlYWRlci1ib2R5IHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50Owp9Ci5lcy1oZWFkZXItYm9keSBwLAouZXMtaGVhZGVyLWJvZHkgdWwgbGksCi5lcy1oZWFkZXItYm9keSBvbCBsaSB7Cgljb2xvcjogIzMzMzMzMzsKCWZvbnQtc2l6ZTogMTRweDsKfQouZXMtaGVhZGVyLWJvZHkgYSB7Cgljb2xvcjogIzEzNzZjODsKCWZvbnQtc2l6ZTogMTRweDsKfQouZXMtZm9vdGVyIHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OwoJYmFja2dyb3VuZC1pbWFnZTogOwoJYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdDsKCWJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlciB0b3A7Cn0KLmVzLWZvb3Rlci1ib2R5IHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50Owp9Ci5lcy1mb290ZXItYm9keSBwLAouZXMtZm9vdGVyLWJvZHkgdWwgbGksCi5lcy1mb290ZXItYm9keSBvbCBsaSB7Cgljb2xvcjogIzMzMzMzMzsKCWZvbnQtc2l6ZTogMTFweDsKfQouZXMtZm9vdGVyLWJvZHkgYSB7Cgljb2xvcjogIzEzNzZjODsKCWZvbnQtc2l6ZTogMTFweDsKfQouZXMtaW5mb2Jsb2NrLAouZXMtaW5mb2Jsb2NrIHAsCi5lcy1pbmZvYmxvY2sgdWwgbGksCi5lcy1pbmZvYmxvY2sgb2wgbGkgewoJbGluZS1oZWlnaHQ6IDEyMCU7Cglmb250LXNpemU6IDEycHg7Cgljb2xvcjogI2NjY2NjYzsKfQouZXMtaW5mb2Jsb2NrIGEgewoJZm9udC1zaXplOiAxMnB4OwoJY29sb3I6ICMyY2I1NDM7Cn0KYS5lcy1idXR0b24gewoJYm9yZGVyLXN0eWxlOiBzb2xpZDsKCWJvcmRlci1jb2xvcjogIzMxY2I0YjsKCWJvcmRlci13aWR0aDogMTBweCAyMHB4IDEwcHggMjBweDsKCWRpc3BsYXk6IGlubGluZS1ibG9jazsKCWJhY2tncm91bmQ6ICMzMWNiNGI7Cglib3JkZXItcmFkaXVzOiAzMHB4OwoJZm9udC1zaXplOiAxOHB4OwoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7Cglmb250LXdlaWdodDogbm9ybWFsOwoJZm9udC1zdHlsZTogbm9ybWFsOwoJbGluZS1oZWlnaHQ6IDEyMCU7Cgljb2xvcjogI2ZmZmZmZjsKCXRleHQtZGVjb3JhdGlvbjogbm9uZSAhaW1wb3J0YW50OwoJd2lkdGg6IGF1dG87Cgl0ZXh0LWFsaWduOiBjZW50ZXI7Cn0KLmVzLWJ1dHRvbi1ib3JkZXIgewoJYm9yZGVyLXN0eWxlOiBzb2xpZCBzb2xpZCBzb2xpZCBzb2xpZDsKCWJvcmRlci1jb2xvcjogIzJjYjU0MyAjMmNiNTQzICMyY2I1NDMgIzJjYjU0MzsKCWJhY2tncm91bmQ6ICMyY2I1NDM7Cglib3JkZXItd2lkdGg6IDBweCAwcHggMnB4IDBweDsKCWRpc3BsYXk6IGlubGluZS1ibG9jazsKCWJvcmRlci1yYWRpdXM6IDMwcHg7Cgl3aWR0aDogYXV0bzsKfQovKgpSRVNQT05TSVZFIFNUWUxFUwpQbGVhc2UgZG8gbm90IGRlbGV0ZSBhbmQgZWRpdCBDU1Mgc3R5bGVzIGJlbG93LgogCklmIHlvdSBkb24ndCBuZWVkIHJlc3BvbnNpdmUgbGF5b3V0LCBwbGVhc2UgZGVsZXRlIHRoaXMgc2VjdGlvbi4KKi8KQG1lZGlhIG9ubHkgc2NyZWVuIGFuZCAobWF4LXdpZHRoOiA2MDBweCkgewoJcCwKICAgIHVsIGxpLAogICAgb2wgbGksCiAgICBhIHsKCQlmb250LXNpemU6IDE2cHggIWltcG9ydGFudDsKCX0KCWgxIHsKCQlmb250LXNpemU6IDMwcHggIWltcG9ydGFudDsKCQl0ZXh0LWFsaWduOiBjZW50ZXI7Cgl9CgloMiB7CgkJZm9udC1zaXplOiAyNnB4ICFpbXBvcnRhbnQ7CgkJdGV4dC1hbGlnbjogY2VudGVyOwoJfQoJaDMgewoJCWZvbnQtc2l6ZTogMjBweCAhaW1wb3J0YW50OwoJCXRleHQtYWxpZ246IGNlbnRlcjsKCX0KCWgxIGEgewoJCWZvbnQtc2l6ZTogMzBweCAhaW1wb3J0YW50OwoJfQoJaDIgYSB7CgkJZm9udC1zaXplOiAyNnB4ICFpbXBvcnRhbnQ7Cgl9CgloMyBhIHsKCQlmb250LXNpemU6IDIwcHggIWltcG9ydGFudDsKCX0KCS5lcy1tZW51IHRkIGEgewoJCWZvbnQtc2l6ZTogMTZweCAhaW1wb3J0YW50OwoJfQoJLmVzLWhlYWRlci1ib2R5IHAsCiAgICAuZXMtaGVhZGVyLWJvZHkgdWwgbGksCiAgICAuZXMtaGVhZGVyLWJvZHkgb2wgbGksCiAgICAuZXMtaGVhZGVyLWJvZHkgYSB7CgkJZm9udC1zaXplOiAxNnB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtZm9vdGVyLWJvZHkgcCwKICAgIC5lcy1mb290ZXItYm9keSB1bCBsaSwKICAgIC5lcy1mb290ZXItYm9keSBvbCBsaSwKICAgIC5lcy1mb290ZXItYm9keSBhIHsKCQlmb250LXNpemU6IDE2cHggIWltcG9ydGFudDsKCX0KCS5lcy1pbmZvYmxvY2sgcCwKICAgIC5lcy1pbmZvYmxvY2sgdWwgbGksCiAgICAuZXMtaW5mb2Jsb2NrIG9sIGxpLAogICAgLmVzLWluZm9ibG9jayBhIHsKCQlmb250LXNpemU6IDEycHggIWltcG9ydGFudDsKCX0KCSpbY2xhc3M9ImdtYWlsLWZpeCJdIHsKCQlkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS10eHQtYywKICAgIC5lcy1tLXR4dC1jIGgxLAogICAgLmVzLW0tdHh0LWMgaDIsCiAgICAuZXMtbS10eHQtYyBoMyB7CgkJdGV4dC1hbGlnbjogY2VudGVyICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS10eHQtciwKICAgIC5lcy1tLXR4dC1yIGgxLAogICAgLmVzLW0tdHh0LXIgaDIsCiAgICAuZXMtbS10eHQtciBoMyB7CgkJdGV4dC1hbGlnbjogcmlnaHQgIWltcG9ydGFudDsKCX0KCS5lcy1tLXR4dC1sLAogICAgLmVzLW0tdHh0LWwgaDEsCiAgICAuZXMtbS10eHQtbCBoMiwKICAgIC5lcy1tLXR4dC1sIGgzIHsKCQl0ZXh0LWFsaWduOiBsZWZ0ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS10eHQtciBhIGltZywKICAgIC5lcy1tLXR4dC1jIGEgaW1nLAogICAgLmVzLW0tdHh0LWwgYSBpbWcgewoJCWRpc3BsYXk6IGlubGluZSAhaW1wb3J0YW50OwoJfQoJLmVzLWJ1dHRvbi1ib3JkZXIgewoJCWRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7Cgl9CgkuZXMtYnV0dG9uIHsKCQlmb250LXNpemU6IDIwcHggIWltcG9ydGFudDsKCQlkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50OwoJCWJvcmRlci13aWR0aDogMTBweCAwcHggMTBweCAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1idG4tZncgewoJCWJvcmRlci13aWR0aDogMTBweCAwcHggIWltcG9ydGFudDsKCQl0ZXh0LWFsaWduOiBjZW50ZXIgIWltcG9ydGFudDsKCX0KCS5lcy1hZGFwdGl2ZSB0YWJsZSwKICAgIC5lcy1idG4tZncsCiAgICAuZXMtYnRuLWZ3LWJyZHIsCiAgICAuZXMtbGVmdCwKICAgIC5lcy1yaWdodCB7CgkJd2lkdGg6IDEwMCUgIWltcG9ydGFudDsKCX0KCS5lcy1jb250ZW50IHRhYmxlLAogICAgLmVzLWhlYWRlciB0YWJsZSwKICAgIC5lcy1mb290ZXIgdGFibGUsCiAgICAuZXMtY29udGVudCwKICAgIC5lcy1mb290ZXIsCiAgICAuZXMtaGVhZGVyIHsKCQl3aWR0aDogMTAwJSAhaW1wb3J0YW50OwoJCW1heC13aWR0aDogNjAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1hZGFwdC10ZCB7CgkJZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDsKCQl3aWR0aDogMTAwJSAhaW1wb3J0YW50OwoJfQoJLmFkYXB0LWltZyB7CgkJd2lkdGg6IDEwMCUgIWltcG9ydGFudDsKCQloZWlnaHQ6IGF1dG8gIWltcG9ydGFudDsKCX0KCS5lcy1tLXAwIHsKCQlwYWRkaW5nOiAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1tLXAwciB7CgkJcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS1wMGwgewoJCXBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS1wMHQgewoJCXBhZGRpbmctdG9wOiAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1tLXAwYiB7CgkJcGFkZGluZy1ib3R0b206IDAgIWltcG9ydGFudDsKCX0KCS5lcy1tLXAyMGIgewoJCXBhZGRpbmctYm90dG9tOiAyMHB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbW9iaWxlLWhpZGRlbiwKICAgIAkuZXMtaGlkZGVuIHsKICAgICAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7CiAgICAJfQogICAgCS5lcy1kZXNrLWhpZGRlbiB7CiAgICAgICAgZGlzcGxheTogdGFibGUtcm93IWltcG9ydGFudDsKICAgICAgICB3aWR0aDogYXV0byFpbXBvcnRhbnQ7CiAgICAgICAgb3ZlcmZsb3c6IHZpc2libGUhaW1wb3J0YW50OwogICAgICAgIGZsb2F0OiBub25lIWltcG9ydGFudDsKICAgICAgICBtYXgtaGVpZ2h0OiBpbmhlcml0IWltcG9ydGFudDsKICAgICAgICBsaW5lLWhlaWdodDogaW5oZXJpdCFpbXBvcnRhbnQ7CiAgICAJfQogICAgCS5lcy1kZXNrLW1lbnUtaGlkZGVuIHsKICAgICAgICBkaXNwbGF5OiB0YWJsZS1jZWxsIWltcG9ydGFudDsKICAgIAl9Cgl0YWJsZS5lcy10YWJsZS1ub3QtYWRhcHQsCiAgICAJLmVzZC1ibG9jay1odG1sIHRhYmxlIHsKCQl3aWR0aDogYXV0byAhaW1wb3J0YW50OwoJfQoJdGFibGUuZXMtc29jaWFsIHsKCQlkaXNwbGF5OiBpbmxpbmUtYmxvY2sgIWltcG9ydGFudDsKCX0KCXRhYmxlLmVzLXNvY2lhbCB0ZCB7CgkJZGlzcGxheTogaW5saW5lLWJsb2NrICFpbXBvcnRhbnQ7Cgl9Cn0KLyoKRU5EIFJFU1BPTlNJVkUgU1RZTEVTCiovCgo=';

        $compliled = 'PCFET0NUWVBFIGh0bWwgUFVCTElDICItLy9XM0MvL0RURCBYSFRNTCAxLjAgVHJhbnNpdGlvbmFsLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL1RSL3hodG1sMS9EVEQveGh0bWwxLXRyYW5zaXRpb25hbC5kdGQiPjxodG1sIHN0eWxlPSJ3aWR0aDoxMDAlO2ZvbnQtZmFtaWx5OmFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7LXdlYmtpdC10ZXh0LXNpemUtYWRqdXN0OjEwMCU7LW1zLXRleHQtc2l6ZS1hZGp1c3Q6MTAwJTtwYWRkaW5nOjA7TWFyZ2luOjA7Ij4gPGhlYWQ+IDxtZXRhIGNoYXJzZXQ9IlVURi04Ij4gPG1ldGEgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEiIG5hbWU9InZpZXdwb3J0Ij4gPG1ldGEgbmFtZT0ieC1hcHBsZS1kaXNhYmxlLW1lc3NhZ2UtcmVmb3JtYXR0aW5nIj4gPG1ldGEgaHR0cC1lcXVpdj0iWC1VQS1Db21wYXRpYmxlIiBjb250ZW50PSJJRT1lZGdlIj4gPG1ldGEgY29udGVudD0idGVsZXBob25lPW5vIiBuYW1lPSJmb3JtYXQtZGV0ZWN0aW9uIj4gPHRpdGxlPjwvdGl0bGU+IDwhLS1baWYgKG1zbyAxNildPiA8c3R5bGUgdHlwZT0idGV4dC9jc3MiPiBhIHt0ZXh0LWRlY29yYXRpb246IG5vbmU7fSA8L3N0eWxlPiA8IVtlbmRpZl0tLT4gPCEtLVtpZiBndGUgbXNvIDldPjxzdHlsZT5zdXAgeyBmb250LXNpemU6IDEwMCUgIWltcG9ydGFudDsgfTwvc3R5bGU+PCFbZW5kaWZdLS0+IDxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+QG1lZGlhIG9ubHkgc2NyZWVuIGFuZCAobWF4LXdpZHRoOjYwMHB4KSB7cCwgdWwgbGksIG9sIGxpLCBhIHsgZm9udC1zaXplOjE2cHghaW1wb3J0YW50IH0gaDEgeyBmb250LXNpemU6MzBweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIH0gaDIgeyBmb250LXNpemU6MjZweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIH0gaDMgeyBmb250LXNpemU6MjBweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIH0gaDEgYSB7IGZvbnQtc2l6ZTozMHB4IWltcG9ydGFudCB9IGgyIGEgeyBmb250LXNpemU6MjZweCFpbXBvcnRhbnQgfSBoMyBhIHsgZm9udC1zaXplOjIwcHghaW1wb3J0YW50IH0gLmVzLW1lbnUgdGQgYSB7IGZvbnQtc2l6ZToxNnB4IWltcG9ydGFudCB9IC5lcy1oZWFkZXItYm9keSBwLCAuZXMtaGVhZGVyLWJvZHkgdWwgbGksIC5lcy1oZWFkZXItYm9keSBvbCBsaSwgLmVzLWhlYWRlci1ib2R5IGEgeyBmb250LXNpemU6MTZweCFpbXBvcnRhbnQgfSAuZXMtZm9vdGVyLWJvZHkgcCwgLmVzLWZvb3Rlci1ib2R5IHVsIGxpLCAuZXMtZm9vdGVyLWJvZHkgb2wgbGksIC5lcy1mb290ZXItYm9keSBhIHsgZm9udC1zaXplOjE2cHghaW1wb3J0YW50IH0gLmVzLWluZm9ibG9jayBwLCAuZXMtaW5mb2Jsb2NrIHVsIGxpLCAuZXMtaW5mb2Jsb2NrIG9sIGxpLCAuZXMtaW5mb2Jsb2NrIGEgeyBmb250LXNpemU6MTJweCFpbXBvcnRhbnQgfSAqW2NsYXNzPSJnbWFpbC1maXgiXSB7IGRpc3BsYXk6bm9uZSFpbXBvcnRhbnQgfSAuZXMtbS10eHQtYywgLmVzLW0tdHh0LWMgaDEsIC5lcy1tLXR4dC1jIGgyLCAuZXMtbS10eHQtYyBoMyB7IHRleHQtYWxpZ246Y2VudGVyIWltcG9ydGFudCB9IC5lcy1tLXR4dC1yLCAuZXMtbS10eHQtciBoMSwgLmVzLW0tdHh0LXIgaDIsIC5lcy1tLXR4dC1yIGgzIHsgdGV4dC1hbGlnbjpyaWdodCFpbXBvcnRhbnQgfSAuZXMtbS10eHQtbCwgLmVzLW0tdHh0LWwgaDEsIC5lcy1tLXR4dC1sIGgyLCAuZXMtbS10eHQtbCBoMyB7IHRleHQtYWxpZ246bGVmdCFpbXBvcnRhbnQgfSAuZXMtbS10eHQtciBhIGltZywgLmVzLW0tdHh0LWMgYSBpbWcsIC5lcy1tLXR4dC1sIGEgaW1nIHsgZGlzcGxheTppbmxpbmUhaW1wb3J0YW50IH0gLmVzLWJ1dHRvbi1ib3JkZXIgeyBkaXNwbGF5OmJsb2NrIWltcG9ydGFudCB9IC5lcy1idXR0b24geyBmb250LXNpemU6MjBweCFpbXBvcnRhbnQ7IGRpc3BsYXk6YmxvY2shaW1wb3J0YW50OyBib3JkZXItd2lkdGg6MTBweCAwcHggMTBweCAwcHghaW1wb3J0YW50IH0gLmVzLWJ0bi1mdyB7IGJvcmRlci13aWR0aDoxMHB4IDBweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIWltcG9ydGFudCB9IC5lcy1hZGFwdGl2ZSB0YWJsZSwgLmVzLWJ0bi1mdywgLmVzLWJ0bi1mdy1icmRyLCAuZXMtbGVmdCwgLmVzLXJpZ2h0IHsgd2lkdGg6MTAwJSFpbXBvcnRhbnQgfSAuZXMtY29udGVudCB0YWJsZSwgLmVzLWhlYWRlciB0YWJsZSwgLmVzLWZvb3RlciB0YWJsZSwgLmVzLWNvbnRlbnQsIC5lcy1mb290ZXIsIC5lcy1oZWFkZXIgeyB3aWR0aDoxMDAlIWltcG9ydGFudDsgbWF4LXdpZHRoOjYwMHB4IWltcG9ydGFudCB9IC5lcy1hZGFwdC10ZCB7IGRpc3BsYXk6YmxvY2shaW1wb3J0YW50OyB3aWR0aDoxMDAlIWltcG9ydGFudCB9IC5hZGFwdC1pbWcgeyB3aWR0aDoxMDAlIWltcG9ydGFudDsgaGVpZ2h0OmF1dG8haW1wb3J0YW50IH0gLmVzLW0tcDAgeyBwYWRkaW5nOjBweCFpbXBvcnRhbnQgfSAuZXMtbS1wMHIgeyBwYWRkaW5nLXJpZ2h0OjBweCFpbXBvcnRhbnQgfSAuZXMtbS1wMGwgeyBwYWRkaW5nLWxlZnQ6MHB4IWltcG9ydGFudCB9IC5lcy1tLXAwdCB7IHBhZGRpbmctdG9wOjBweCFpbXBvcnRhbnQgfSAuZXMtbS1wMGIgeyBwYWRkaW5nLWJvdHRvbTowIWltcG9ydGFudCB9IC5lcy1tLXAyMGIgeyBwYWRkaW5nLWJvdHRvbToyMHB4IWltcG9ydGFudCB9IC5lcy1tb2JpbGUtaGlkZGVuLCAuZXMtaGlkZGVuIHsgZGlzcGxheTpub25lIWltcG9ydGFudCB9IC5lcy1kZXNrLWhpZGRlbiB7IGRpc3BsYXk6dGFibGUtcm93IWltcG9ydGFudDsgd2lkdGg6YXV0byFpbXBvcnRhbnQ7IG92ZXJmbG93OnZpc2libGUhaW1wb3J0YW50OyBmbG9hdDpub25lIWltcG9ydGFudDsgbWF4LWhlaWdodDppbmhlcml0IWltcG9ydGFudDsgbGluZS1oZWlnaHQ6aW5oZXJpdCFpbXBvcnRhbnQgfSAuZXMtZGVzay1tZW51LWhpZGRlbiB7IGRpc3BsYXk6dGFibGUtY2VsbCFpbXBvcnRhbnQgfSB0YWJsZS5lcy10YWJsZS1ub3QtYWRhcHQsIC5lc2QtYmxvY2staHRtbCB0YWJsZSB7IHdpZHRoOmF1dG8haW1wb3J0YW50IH0gdGFibGUuZXMtc29jaWFsIHsgZGlzcGxheTppbmxpbmUtYmxvY2shaW1wb3J0YW50IH0gdGFibGUuZXMtc29jaWFsIHRkIHsgZGlzcGxheTppbmxpbmUtYmxvY2shaW1wb3J0YW50IH0gfSNvdXRsb29rIGEgewlwYWRkaW5nOjA7fS5FeHRlcm5hbENsYXNzIHsJd2lkdGg6MTAwJTt9LkV4dGVybmFsQ2xhc3MsLkV4dGVybmFsQ2xhc3MgcCwuRXh0ZXJuYWxDbGFzcyBzcGFuLC5FeHRlcm5hbENsYXNzIGZvbnQsLkV4dGVybmFsQ2xhc3MgdGQsLkV4dGVybmFsQ2xhc3MgZGl2IHsJbGluZS1oZWlnaHQ6MTAwJTt9LmVzLWJ1dHRvbiB7CW1zby1zdHlsZS1wcmlvcml0eToxMDAhaW1wb3J0YW50Owl0ZXh0LWRlY29yYXRpb246bm9uZSFpbXBvcnRhbnQ7fWFbeC1hcHBsZS1kYXRhLWRldGVjdG9yc10gewljb2xvcjppbmhlcml0IWltcG9ydGFudDsJdGV4dC1kZWNvcmF0aW9uOm5vbmUhaW1wb3J0YW50Owlmb250LXNpemU6aW5oZXJpdCFpbXBvcnRhbnQ7CWZvbnQtZmFtaWx5OmluaGVyaXQhaW1wb3J0YW50Owlmb250LXdlaWdodDppbmhlcml0IWltcG9ydGFudDsJbGluZS1oZWlnaHQ6aW5oZXJpdCFpbXBvcnRhbnQ7fS5lcy1kZXNrLWhpZGRlbiB7IGRpc3BsYXk6bm9uZTsgZmxvYXQ6bGVmdDsgb3ZlcmZsb3c6aGlkZGVuOyB3aWR0aDowOyBtYXgtaGVpZ2h0OjA7IGxpbmUtaGVpZ2h0OjA7IG1zby1oaWRlOmFsbDt9PC9zdHlsZT4gPC9oZWFkPiA8Ym9keSBzdHlsZT0id2lkdGg6MTAwJTtmb250LWZhbWlseTphcmlhbCwgJ2hlbHZldGljYSBuZXVlJywgaGVsdmV0aWNhLCBzYW5zLXNlcmlmOy13ZWJraXQtdGV4dC1zaXplLWFkanVzdDoxMDAlOy1tcy10ZXh0LXNpemUtYWRqdXN0OjEwMCU7cGFkZGluZzowO01hcmdpbjowO2Rpc3BsYXk6YmxvY2s7Ij4gPGRpdiBjbGFzcz0iZXMtd3JhcHBlci1jb2xvciIgc3R5bGU9ImJhY2tncm91bmQtY29sb3I6I0Y2RjZGNjsiPiA8IS0tW2lmIGd0ZSBtc28gOV0+CQkJPHY6YmFja2dyb3VuZCB4bWxuczp2PSJ1cm46c2NoZW1hcy1taWNyb3NvZnQtY29tOnZtbCIgZmlsbD0idCI+CQkJCTx2OmZpbGwgdHlwZT0idGlsZSIgc3JjPSIiIGNvbG9yPSIjZjZmNmY2Ij48L3Y6ZmlsbD4JCQk8L3Y6YmFja2dyb3VuZD4JCTwhW2VuZGlmXS0tPiA8dGFibGUgY2xhc3M9ImVzLXdyYXBwZXIiIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4O3BhZGRpbmc6MDtNYXJnaW46MDt3aWR0aDoxMDAlO2hlaWdodDoxMDAlO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdDtiYWNrZ3JvdW5kLXBvc2l0aW9uOmNlbnRlciB0b3A7Ij4gIDx0ciBzdHlsZT0iYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlOyI+IDx0ZCB2YWxpZ249InRvcCIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDsiPiA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgYWxpZ249ImNlbnRlciIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7dGFibGUtbGF5b3V0OmZpeGVkICFpbXBvcnRhbnQ7d2lkdGg6MTAwJTsiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7Ij4gPHRhYmxlIGNsYXNzPSJlcy1jb250ZW50LWJvZHkiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4O2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7IiB3aWR0aD0iNjAwIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJjZW50ZXIiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGFsaWduPSJsZWZ0IiBzdHlsZT0iTWFyZ2luOjA7cGFkZGluZy10b3A6MjBweDtwYWRkaW5nLWJvdHRvbToyMHB4O3BhZGRpbmctbGVmdDoyMHB4O3BhZGRpbmctcmlnaHQ6MjBweDsiPiA8IS0tW2lmIG1zb10+PHRhYmxlIHdpZHRoPSI1NjAiIGNlbGxwYWRkaW5nPSIwIiBjZWxsc3BhY2luZz0iMCI+PHRyPjx0ZCB3aWR0aD0iMzU2IiB2YWxpZ249InRvcCI+PCFbZW5kaWZdLS0+IDx0YWJsZSBjbGFzcz0iZXMtbGVmdCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0ibGVmdCIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7ZmxvYXQ6bGVmdDsiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGNsYXNzPSJlcy1tLXAwciBlcy1tLXAyMGIiIHdpZHRoPSIzNTYiIHZhbGlnbj0idG9wIiBhbGlnbj0iY2VudGVyIiBzdHlsZT0icGFkZGluZzowO01hcmdpbjowOyI+IDx0YWJsZSB3aWR0aD0iMTAwJSIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBzdHlsZT0ibXNvLXRhYmxlLWxzcGFjZTowcHQ7bXNvLXRhYmxlLXJzcGFjZTowcHQ7Ym9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO2JvcmRlci1zcGFjaW5nOjBweDsiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7ZGlzcGxheTpub25lOyI+PC90ZD4gPC90cj4gIDwvdGFibGU+IDwvdGQ+IDwvdHI+ICA8L3RhYmxlPiA8IS0tW2lmIG1zb10+PC90ZD48dGQgd2lkdGg9IjIwIj48L3RkPjx0ZCB3aWR0aD0iMTg0IiB2YWxpZ249InRvcCI+PCFbZW5kaWZdLS0+IDx0YWJsZSBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJyaWdodCIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7Ij4gIDx0ciBzdHlsZT0iYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlOyI+IDx0ZCB3aWR0aD0iMTg0IiBhbGlnbj0ibGVmdCIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDsiPiA8dGFibGUgd2lkdGg9IjEwMCUiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7Ij4gIDx0ciBzdHlsZT0iYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlOyI+IDx0ZCBhbGlnbj0iY2VudGVyIiBzdHlsZT0icGFkZGluZzowO01hcmdpbjowO2Rpc3BsYXk6bm9uZTsiPjwvdGQ+IDwvdHI+ICA8L3RhYmxlPiA8L3RkPiA8L3RyPiAgPC90YWJsZT4gPCEtLVtpZiBtc29dPjwvdGQ+PC90cj48L3RhYmxlPjwhW2VuZGlmXS0tPiA8L3RkPiA8L3RyPiAgPC90YWJsZT4gPC90ZD4gPC90cj4gIDwvdGFibGU+IDx0YWJsZSBjbGFzcz0iZXMtY29udGVudCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0iY2VudGVyIiBzdHlsZT0ibXNvLXRhYmxlLWxzcGFjZTowcHQ7bXNvLXRhYmxlLXJzcGFjZTowcHQ7Ym9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO2JvcmRlci1zcGFjaW5nOjBweDt0YWJsZS1sYXlvdXQ6Zml4ZWQgIWltcG9ydGFudDt3aWR0aDoxMDAlOyI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgYWxpZ249ImNlbnRlciIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDsiPiA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQtYm9keSIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDsiIHdpZHRoPSI2MDAiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgYWxpZ249ImNlbnRlciI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgYWxpZ249ImxlZnQiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7cGFkZGluZy1sZWZ0OjIwcHg7cGFkZGluZy1yaWdodDoyMHB4O3BhZGRpbmctYm90dG9tOjMwcHg7Ij4gPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4OyI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgd2lkdGg9IjU2MCIgdmFsaWduPSJ0b3AiIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7Ij4gPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4OyI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgYWxpZ249ImNlbnRlciIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDtkaXNwbGF5Om5vbmU7Ij48L3RkPiA8L3RyPiAgPC90YWJsZT4gPC90ZD4gPC90cj4gIDwvdGFibGU+IDwvdGQ+IDwvdHI+ICA8L3RhYmxlPiA8L3RkPiA8L3RyPiAgPC90YWJsZT4gPC90ZD4gPC90cj4gIDwvdGFibGU+IDwvZGl2PiA8L2JvZHk+PC9odG1sPg==';

        return array('html' => $html, 'css' => $css, 'compiled' => $compliled);
    }

    
    /**
     * Used to send test email
     */
    public function sendTestEmail(Request $request) {
        $response = array();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $templateID = strip_tags($request->templateId);
        $emailAddress = strip_tags($request->email);

        $oTemplate = $mTemplates->getCommonTemplates($userID, '', $templateID, '');
        if (!empty($oTemplate)) {

            $greeting = $oTemplate[0]->greeting;
            $introduction = $oTemplate[0]->introduction;

            $cont = base64_decode($oTemplate[0]->stripo_compiled_html);
            $content = str_replace('\n', "<br>", $cont);

            $content = str_replace(array('{GREETING}', '{INTRODUCTION}'), array($greeting, $introduction), $content);

            //Get Sendgrid Info for client
            $aSendgridData = getSendgridAccount($userID);
            if (!empty($aSendgridData)) {
                $userName = $aSendgridData->sg_username;
                $password = $aSendgridData->sg_password;

                $aEmailData = array(
                    'username' => $userName,
                    'password' => $password,
                    'email' => $emailAddress,
                    'message' => $content,
                    'subject' => 'Preview email template'
                );
                $result = sendClientEmail($aEmailData);
                if (empty($result['errors'])) {
                    //Update credits
                    $aUsage = array(
                        'client_id' => $userID,
                        'usage_type' => 'email',
                        'content' => $content,
                        'spend_to' => $emailAddress,
                        'spend_from' => '',
                        'module_name' => 'test email',
                        'module_unit_id' => ''
                    );
                    //$this->mInviter->updateUsage($aUsage);
                    updateCreditUsage($aUsage);
                    $response = array('status' => 'success', 'msg' => 'Email sent successfully');
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to send test sms
     */
    public function sendTestSMS(Request $request) {
        $response = array();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();

        $templateID = strip_tags($request->templateId);
        $number = strip_tags($request->number);

        $oTemplate = $mTemplates->getCommonTemplates($userID, '', $templateID, '');
        if (!empty($oTemplate)) {
            $templateSource = $oTemplate[0]->template_source;

            $greeting = $oTemplate[0]->greeting;
            $introduction = $oTemplate[0]->introduction;

            $content = base64_decode($oTemplate[0]->stripo_compiled_html);

            $content = str_replace(array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}', '{GREETING}', '{INTRODUCTION}'), array($aUser->firstname, $aUser->lastname, $aUser->email, $greeting, $introduction), $content);

            $content = str_replace('<br>', "\n", $content);
            $content = str_replace('<br/>', "\n", $content);
            $content = str_replace('<br />', "\n", $content);
            $content = strip_tags(nl2br($content));



            //Get Twilio Info of client
            $aTwilioAc = $this->mInviter->getTwilioAccount($userID);
            if (!empty($aTwilioAc)) {
                $sid = $aTwilioAc->account_sid;
                $token = $aTwilioAc->account_token;
                $from = $aTwilioAc->contact_no;
                $aSmsData = array(
                    'sid' => $sid,
                    'token' => $token,
                    'to' => $number,
                    'from' => $from,
                    'msg' => $content
                );
                //pre($aSmsData);
                //Send Sms now
                $response = sendClinetSMS($aSmsData);


                $aUsage = array(
                    'client_id' => $userID,
                    'usage_type' => 'sms',
                    'direction' => 'outbound',
                    'content' => $content,
                    'spend_to' => $number,
                    'spend_from' => $from,
                    'module_name' => 'test sms',
                    'module_unit_id' => ''
                );
                //$this->mInviter->updateUsage($aUsage);
                $charCount = strlen($content);
                $totatMessageCount = ceil($charCount / 160);
                if ($totatMessageCount > 1) {
                    for ($i = 0; $i < $totatMessageCount; $i++) {
                        $aUsage['segment'] = $i + 1;
                        updateCreditUsage($aUsage);
                    }
                } else {
                    $aUsage['segment'] = 1;
                    updateCreditUsage($aUsage);
                }

                $response = array('status' => 'success', 'msg' => 'SMS sent successfully');
            }
        }
        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to clone selected template
     */
    public function cloneTemplate(Request $request) {
        $response = array();
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();

        $templateID = strip_tags($request->templateId);
        $templateType = strip_tags($request->templateType);
        $oTemplate = $mTemplates->getCommonTemplateInfo($templateID);
        if (!empty($oTemplate)) {
            $aData = (array) $oTemplate;
            unset($aData['id']);
            unset($aData['created']);
            unset($aData['updated']);
            $aData['user_id'] = $userID;
            $aData['template_name'] = $aData['template_name'] . '_copy';
            $aData['template_type'] = $templateType;
            $insertID = $mTemplates->addUserTemplate($aData);
            $response['status'] = 'success';
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete template
     */
    public function deleteTemplate(Request $request) {
        $response = array();
        $response['status'] = 'error';
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();

        $templateID = strip_tags($request->templateId);
        $oTemplate = $mTemplates->getCommonTemplateInfo($templateID);
        if (!empty($oTemplate)) {
            if ($oTemplate->user_id == $userID) {
                $bDeleted = $mTemplates->deleteUserTemplate($templateID, $userID);
                if ($bDeleted) {
                    $response['status'] = 'success';
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to create and store thumbnail for selected template
     * @param type $templateID
     */
    public function saveThumbnail(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $templateID = $request->id;
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();
        
        $oTemplate = $mTemplates->getCommonTemplates($userID, '', $templateID, '');
        if (!empty($oTemplate)) {
            $templateType = $oTemplate[0]->template_type;
            if ($templateType == 'sms') {
                $content = nl2br(base64_decode($oTemplate[0]->stripo_compiled_html));
            } else {
                $content = base64_decode($oTemplate[0]->stripo_compiled_html);
            }

            $aData = array(
                'content' => $content,
                'templateID' => $templateID,
                'templateType' => $templateType
            );

            return view('admin.templates.thumbnail_creator', $aData);
        }
    }

    
    /**
     * Used to update thumbnail of selected template
     */
    public function updateThumbnail(Request $request) {
        $response = array();
        $response['status'] = 'error';
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instantiate Templates model to get its methods and properties
        $mTemplates = new TemplatesModel();

        $templateID = strip_tags($request->templateId);
        $sThumbnail = strip_tags($request->imgsrc);
        if ($templateID > 0) {
            $aData = array(
                'thumbnail' => $sThumbnail,
                'updated' => date("Y-m-d H:i:s")
            );
        }
        $bUpdated = $mTemplates->updateCommonTemplate($aData, $templateID, $userID);
        if ($bUpdated) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'Error';
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to update all the template tags in brandboost module
     * @param type $brandboostID
     * @param type $sHtml
     * @param type $campaignType
     * @param type $subscriberInfo
     * @return type
     */
    public function brandboostEmailTagReplace($brandboostID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        //Instantiate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();
        
        $oBrandboost = $mWorkflow->getModuleUnitInfo('brandboost', $brandboostID);
        $productsDetails = $mWorkflow->getProductDataByBBID($brandboostID);
        $greeting = 'Hi, ' . $subscriberInfo->firstname . ' ' . $subscriberInfo->lastname . '! We’d love your feedback!';
        $introduction = 'Thanks for buying from Oreo. Please review your purchase. It only takes a minute and really helps!';
        $sHtml = str_replace(array('{GREETING}', '{INTRODUCTION}'), array($greeting, $introduction), $sHtml);
        if ($oBrandboost->review_type == 'offsite') {
            $aOffsiteUrls = unserialize($oBrandboost->offsites_links);
            if(!empty($aOffsiteUrls)){
                $random_keys = array_rand($aOffsiteUrls, 1);
            }else{
                $random_keys = $aOffsiteUrls[0];
            }
            
            $offsiteURL = $aOffsiteUrls[$random_keys];
        }


        $aTags = config('bbconfig.email_tags');
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


                    case '{ONSITE_REVIEW_URL}':
                        $htmlData = base_url() . "reviews/addnew";
                        break;

                    case '{OFFSITE_REVIEW_URL}':
                        $htmlData = isset($offsiteURL) ? $offsiteURL['shorturl'] : '';
                        break;

                    case '{BRAND_NAME}':
                        $htmlData = $oBrandboost->brand_title;
                        break;

                    case '{PRODUCTS_LIST}':
                        $htmlData = view('admin.workflow2.partials.products_list', ['productsDetails'=> $productsDetails])->render();
                        break;

                    case '{BRAND_LOGO}':
                        if (!empty($oBrandboost->logo_img)) {
                            $htmlData = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oBrandboost->logo_img;
                        } else {
                            $htmlData = base_url() . 'assets/images/emailer/emailer-3-walker.png';
                        }
                        break;
                }
                $sHtml = str_replace($sTag, $htmlData, $sHtml);
            }
        }
        return $sHtml;
    }

}
