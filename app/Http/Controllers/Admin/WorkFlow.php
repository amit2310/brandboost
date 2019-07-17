<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\TagsModel;
use Cookie;
use Session;

class WorkFlow extends Controller {

    public function index() {
        
    }

    /**
     * This function is used to update Event time related changes 
     * @param Request $request
     */
    public function updateEventTime(Request $request) {
        $response = array();
        $mWorkflow = new WorkflowModel();

        $eventID = strip_tags($request->event_id);
        $delayValue = strip_tags($request->delay_value);
        $delayUnit = strip_tags($request->delay_unit);
        $eventType = strip_tags($request->event_type);
        $nodeType = strip_tags($request->node_type);
        $moduleName = strip_tags($request->moduleName);

        if ($eventID) {
            $eventDataArr = array("delay_type" => "after", "delay_value" => $delayValue, "delay_unit" => $delayUnit, "event_type" => $eventType, "node_type" => $nodeType);
            $eventData = json_encode($eventDataArr);
            $aData = array(
                'data' => $eventData,
                'updated' => date("Y-m-d H:i:s")
            );

            $campaignID = $mWorkflow->updateWorkflowEvent($aData, $eventID, $moduleName);
            //$campaignId = $this->mBrandboost->updateEvent($eData, $eventID);
            if ($campaignID) {
                //Add Useractivity log
                $aUser = getLoggedUser();
                $userID = $aUser->id;


                $aActivityData = array(
                    'user_id' => $userID,
                    'module_name' => $moduleName,
                    'event_type' => '',
                    'action_name' => 'updated_workflow_event',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => $eventID,
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Workflow event trigger time updated',
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
     * Add Email or Sms node into the workflow tree
     * @param Request $request
     */
    public function addWorkflowEventToTree(Request $request) {
        $response = array();

        $moduleName = strip_tags($request->moduleName);
        $templateID = strip_tags($request->templateId);
        $campaignType = strip_tags($request->campaign_type);
        $previousEventId = strip_tags($request->previous_event_id);
        $currentEventID = strip_tags($request->current_event_id);
        $eventType = strip_tags($request->event_type);
        $nodeType = strip_tags($request->node_type);
        $id = strip_tags($request->moduleUnitId);
        if (!empty($moduleName) && $id > 0) {
            $aResponse = $this->createWorkflowEventNode($id, $moduleName, $eventType, $previousEventId, $templateID);

            if (!empty($aResponse)) {
                $newEventID = $aResponse['eventID'];
                $newCampaignID = $aResponse['campaignID'];
                $subject = $aResponse['subject'];
                $content = $aResponse['content'];
                $this->connectWorkflowNode($currentEventID, $newEventID, $nodeType, $moduleName);

                $response['status'] = 'success';
                $response['campaign_id'] = $newCampaignID;
                $response['subject'] = $subject;
                $response['content'] = $content;
            } else {
                $response['status'] = "Error";
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Add Email or Sms node into the workflow tree new method
     * @param Request $request
     */
    public function addWorkflowEventToTreeNew(Request $request) {
        $response = array();
        $moduleName = strip_tags($request->moduleName);
        $emailTemplateID = strip_tags($request->emailTemplateId);
        $smsTemplateID = strip_tags($request->smsTemplateId);
        $delayValue = strip_tags($request->delayVal);
        $delayUnit = strip_tags($request->delayUnit);
        $previousEventId = strip_tags($request->previous_event_id);
        $currentEventID = strip_tags($request->current_event_id);
        $eventType = strip_tags($request->event_type);
        $nodeType = strip_tags($request->node_type);
        $id = strip_tags($request->moduleUnitId);

        $oNextNode = $mWorkflow->getNextNodeInfo($currentEventID, $moduleName);

        if (!empty($delayUnit) || !empty($delayValue)) {
            $delayVal = (!empty($delayValue)) ? $delayValue : 0;
            $unitVal = (!empty($delayUnit)) ? $delayUnit : "minute";
            $triggerParams = array('delay_type' => "after", 'delay_value' => $delayVal, 'delay_unit' => $unitVal);
        }
        if (!empty($moduleName) && $id > 0) {

            if ($smsTemplateID > 0) {
                if ($moduleName == 'nps') {
                    $oTemplate = $mWorkflow->getWorkflowDefaultTemplates('nps', '', $smsTemplateID);
                    $triggerParams['template_name'] = $oTemplate[0]->template_name;
                }

                $aResponse = $this->createWorkflowEventNode($id, $moduleName, $eventType, $previousEventId, $smsTemplateID, $triggerParams);

                if (!empty($aResponse)) {
                    $newEventID = $aResponse['eventID'];
                    //Connect Node
                    $this->connectWorkflowNode($currentEventID, $newEventID, $nodeType, $moduleName);
                    $response['status'] = 'success';
                }
            }

            if ($emailTemplateID > 0) {
                if ($newEventID > 0) {
                    $previousEventId = '';
                    $triggerParams['delay_value'] = 0;
                    $triggerParams['delay_unit'] = 'minute';
                    $nodeType = 'followup';
                    $currentEventID = $newEventID;
                }

                if ($moduleName == 'nps') {
                    $oTemplate = $mWorkflow->getWorkflowDefaultTemplates('nps', '', $emailTemplateID);
                    $triggerParams['template_name'] = $oTemplate[0]->template_name;
                }

                $aResponse = $this->createWorkflowEventNode($id, $moduleName, $eventType, $previousEventId, $emailTemplateID, $triggerParams);
                if (!empty($aResponse)) {
                    $newEventID = $aResponse['eventID'];
                    //Connect Node
                    //echo "Current Event Id is ". $currentEventID. " New Event ID is ". $newEventID;
                    $this->connectWorkflowNode($currentEventID, $newEventID, $nodeType, $moduleName);
                    $response['status'] = 'success';
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Add Workflow Node
     * @param Request $request
     */
    public function addWorkflowNode(Request $request) {
        $response = array();
        $moduleName = strip_tags($request->moduleName);
        $emailTemplateID = strip_tags($request->emailTemplateId);
        $smsTemplateID = strip_tags($request->smsTemplateId);
        $source = strip_tags($request->source);

        $isDraft = ($source == 'draft') ? true : false;

        if ($emailTemplateID > 0) {
            $oTemplateInfo = $mWorkflow->getCommonTemplateInfo($emailTemplateID);
            if (!empty($oTemplateInfo)) {
                $categoryStatus = $oTemplateInfo->category_status;
                $templateSlug = $oTemplateInfo->template_slug;
            }
        }

        if ($smsTemplateID > 0) {
            $oTemplateInfo = $mWorkflow->getCommonTemplateInfo($smsTemplateID);
            if (!empty($oTemplateInfo)) {
                $categoryStatus = $oTemplateInfo->category_status;
                $templateSlug = $oTemplateInfo->template_slug;
            }
        }

        $delayValue = strip_tags($request->delayVal);
        $delayUnit = strip_tags($request->delayUnit);
        $previousEventId = strip_tags($request->previous_event_id);
        $currentEventID = strip_tags($request->current_event_id);
        $eventType = strip_tags($request->event_type);
        $nodeType = strip_tags($request->node_type);
        $id = strip_tags($request->moduleUnitId);

        $oNextNode = $mWorkflow->getNextNodeInfo($currentEventID, $moduleName);

        if (!empty($delayUnit) || !empty($delayValue)) {
            $delayVal = (!empty($delayValue)) ? $delayValue : 0;
            $unitVal = (!empty($delayUnit)) ? $delayUnit : "minute";
            $triggerParams = array('delay_type' => "after", 'delay_value' => $delayVal, 'delay_unit' => $unitVal);
        }
        if (!empty($moduleName) && $id > 0) {

            if ($smsTemplateID > 0) {
                if ($moduleName == 'nps') {
                    $triggerParams['template_slug'] = $templateSlug;
                }

                $aResponse = $this->createEventNode($id, $moduleName, $eventType, $previousEventId, $smsTemplateID, $triggerParams, $isDraft);

                if (!empty($aResponse)) {
                    $newEventID = $aResponse['eventID'];
                    //Connect Node
                    $this->connectWorkflowNode($currentEventID, $newEventID, $nodeType, $moduleName);
                    $response['status'] = 'success';
                    $response['campaign_id'] = $aResponse['campaignID'];
                    $response['categoryStatus'] = $categoryStatus;
                }
            }

            if ($emailTemplateID > 0) {
                if ($newEventID > 0) {
                    $previousEventId = '';
                    $triggerParams['delay_value'] = 0;
                    $triggerParams['delay_unit'] = 'minute';
                    $nodeType = 'followup';
                    $currentEventID = $newEventID;
                }

                if ($moduleName == 'nps') {
                    $triggerParams['template_slug'] = $templateSlug;
                }

                $aResponse = $this->createEventNode($id, $moduleName, $eventType, $previousEventId, $emailTemplateID, $triggerParams, $isDraft);
                if (!empty($aResponse)) {

                    $newEventID = $aResponse['eventID'];
                    //Connect Node
                    //echo "Current Event Id is ". $currentEventID. " New Event ID is ". $newEventID;
                    $this->connectWorkflowNode($currentEventID, $newEventID, $nodeType, $moduleName);
                    $response['status'] = 'success';
                    $response['campaign_id'] = $aResponse['campaignID'];
                    $response['categoryStatus'] = $categoryStatus;
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * This function connects workflow node to each after after change in the order the workflow events
     * @param type $currentEventID
     * @param type $newEventID
     * @param type $nodeType
     * @param type $moduleName
     * @return boolean
     */
    public function connectWorkflowNode($currentEventID, $newEventID, $nodeType, $moduleName) {

        if ($nodeType == 'main' && $currentEventID > 0 && $newEventID > 0) {
            //Update Current node
            $aEventDataCurrent = array(
                'event_type' => 'followup',
                'previous_event_id' => $newEventID,
                'updated' => date("Y-m-d H:i:s")
            );
            $bUpdated = $mWorkflow->updateWorkflowEvent($aEventDataCurrent, $currentEventID, $moduleName);
            if ($bUpdated) {
                return true;
            } else {
                return false;
            }
        } else if ($nodeType == 'followup') {
            if ($currentEventID > 0 && $newEventID > 0) {
                //Get Next Node info from Current Node, so that we could update new node id into the next node's previous_event_id
                //echo " Okay, currID is ". $currentEventID;
                $oNextNode = $mWorkflow->getNextNodeInfo($currentEventID, $moduleName);
                //pre($oNextNode);
                if (!empty($oNextNode)) {
                    $nextEventID = $oNextNode->id;
                }
                //echo "Next Event ID is ". $nextEventID;
                //UPdate New Node
                $aEventDataNew = array(
                    'event_type' => 'followup',
                    'previous_event_id' => $currentEventID,
                    'updated' => date("Y-m-d H:i:s")
                );
                $bUpdated = $mWorkflow->updateWorkflowEvent($aEventDataNew, $newEventID, $moduleName);

                if ($nextEventID > 0) {
                    //Update Next Node
                    $aEventDataNext = array(
                        'event_type' => 'followup',
                        'previous_event_id' => $newEventID,
                        'updated' => date("Y-m-d H:i:s")
                    );
                    //pre($aEventDataNext);
                    $bUpdated = $mWorkflow->updateWorkflowEvent($aEventDataNext, $nextEventID, $moduleName);
                }

                if ($bUpdated) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Add Email/SMS event node into the workflow tree
     * @param type $id
     * @param type $moduleName
     * @param type $eventType
     * @param type $previousID
     * @param type $templateID
     * @param type $triggerParam
     * @param type $isDraft
     * @return type
     */
    public function createEventNode($id, $moduleName, $eventType, $previousID, $templateID = '', $triggerParam = '', $isDraft = false) {
        $response = array();
        $eventID = $mWorkflow->createWorkflowEvent($id, $eventType, $previousID, $triggerParam, $moduleName);

        if ($eventID > 0 && $templateID > 0) {
            $aResponse = $mWorkflow->addEndCampaign($eventID, $templateID, $id, $moduleName, $isDraft);
            $campaignID = $aResponse['id'];
            $subject = $aResponse['subject'];
            $content = $aResponse['content'];


            $response = array(
                'eventID' => $eventID,
                'campaignID' => $campaignID,
                'subject' => $subject,
                'content' => $content
            );
        }
        return $response;
    }

    /**
     * Creates Workflow Event Node
     * @param type $id
     * @param type $moduleName
     * @param type $eventType
     * @param type $previousID
     * @param type $templateID
     * @param type $triggerParam
     * @return type
     */
    public function createWorkflowEventNode($id, $moduleName, $eventType, $previousID, $templateID = '', $triggerParam = '') {
        $response = array();
        $eventID = $mWorkflow->createWorkflowEvent($id, $eventType, $previousID, $triggerParam, $moduleName);

        if ($eventID > 0 && $templateID > 0) {
            $aResponse = $mWorkflow->addWorkflowCampaign($eventID, $templateID, $id, $moduleName);
            $campaignID = $aResponse['id'];
            $subject = $aResponse['subject'];
            $content = $aResponse['content'];

            $response = array(
                'eventID' => $eventID,
                'campaignID' => $campaignID,
                'subject' => $subject,
                'content' => $content
            );
        }
        return $response;
    }

    /**
     * Updates workflow campaigns
     * @param Request $request
     */
    public function updateWorkflowCampaign(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $subject = strip_tags($request->subject);
        $preheader = strip_tags($request->preheader);
        $content = db_in($request->content);
        $stripoHtml = $request->stripo_html;
        $stripoCss = $request->stripo_css;
        $stripoCompiledHtml = $request->stripo_compiled_html;
        $campaignID = strip_tags($request->campaignId);
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);

        $greeting = db_in($request->greeting);
        $introduction = db_in($request->introduction);
        $template_source = strip_tags($request->template_source);

        $aData = array();

        if (!empty($subject)) {
            $aData['subject'] = $subject;
        }

        if (!empty($preheader)) {
            $aData['preheader'] = $preheader;
        }

        if (!empty($content)) {
            $aData['html'] = base64_encode($content);
        }

        if (!empty($stripoHtml)) {
            $aData['stripo_html'] = base64_encode($stripoHtml);
        }

        if (!empty($stripoCss)) {
            $aData['stripo_css'] = base64_encode($stripoCss);
        }

        if (!empty($stripoCompiledHtml)) {
            $aData['stripo_compiled_html'] = base64_encode($stripoCompiledHtml);
            /* $html = new html2text($stripoCompiledHtml);
              $plainText = $html->getText();
              echo "Plain text is ". strip_tags($stripoCompiledHtml);
              $aData['html'] = base64_encode($html->getText()); */
            $plainText = strip_tags($stripoCompiledHtml);
            $aData['html'] = base64_encode($plainText);
        }



        if (!empty($greeting)) {
            $aData['greeting'] = $greeting;
        }

        if (!empty($introduction)) {
            $aData['introduction'] = $introduction;
        }

        if (!empty($template_source)) {
            $aData['template_source'] = $template_source;
        }

        //pre($aData);

        $bUpdated = $mWorkflow->updateWorkflowCampaign($aData, $campaignID, $moduleName);

        if ($moduleName == 'broadcast') {
            //Update in the default variation too
            $oVariations = $mWorkflow->getWorkflowSplitVariations($moduleName, $moduleUnitID);
            if (!empty($oVariations)) {
                $campaignID = $oVariations[0]->id;
            }
            $bUpdated = $mWorkflow->updateWorkflowSplitCampaign($aData, $campaignID, $moduleName);
        }

        if ($bUpdated) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'Error';
        }

        echo json_encode($response);
        exit;
    }

    /**
     * 
     * @param Request $request
     * @param Request $requestUsed to save workflow drafts
     * 
     */
    public function saveWorkflowDraft(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $subject = strip_tags($request->subject);
        $stripoHtml = $request->stripo_html;
        $stripoCss = $request->stripo_css;
        $stripoCompiledHtml = $request->stripo_compiled_html;
        $campaignID = strip_tags($request->campaignId);
        $moduleName = strip_tags($request->moduleName);

        $greeting = db_in($request->greeting);
        $introduction = db_in($request->introduction);
        $draftID = strip_tags($request->draftID);
        $template_source = strip_tags($request->template_source);
        $templateType = 'sms';
        if ($template_source > 0) {
            //get template info
            $oTemplate = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $template_source);
            //pre($oTemplate);
            if (!empty($oTemplate)) {
                $templateName = $oTemplate[0]->template_name;
                $templateName = (!empty($templateName)) ? $templateName . '_draft' : 'draft';
                for ($i = 1; $i++; $i <= 20) {
                    $checkDraft = $mWorkflow->getWorkflowDraftByName($moduleName, $templateName, $userID);
                    if (empty($checkDraft)) {
                        break;
                    } else {
                        $templateName = $templateName . ' ' . $i;
                    }
                }
                $templateType = $oTemplate[0]->template_type;
                $previewIcon = $oTemplate[0]->preview_icon;
            }
        }

        $aData = array(
            'user_id' => $userID,
            'template_name' => $templateName,
            'created' => date("Y-m-d H:i:s")
        );



        if (!empty($subject)) {
            $aData['template_subject'] = $subject;
        }

        if (!empty($stripoHtml)) {
            $aData['stripo_html'] = base64_encode($stripoHtml);
        }

        if (!empty($stripoCss)) {
            $aData['stripo_css'] = base64_encode($stripoCss);
        }

        if (!empty($stripoCompiledHtml)) {
            $aData['stripo_compiled_html'] = base64_encode($stripoCompiledHtml);
        }

        if (!empty($greeting)) {
            $aData['greeting'] = $greeting;
        }

        if (!empty($introduction)) {
            $aData['introduction'] = $introduction;
        }

        if (!empty($template_source)) {
            $aData['template_source'] = $template_source;
        }

        if (!empty($templateType)) {
            $aData['template_type'] = $templateType;
        }

        if (!empty($previewIcon)) {
            $aData['preview_icon'] = $previewIcon;
        }

        if (empty($draftID)) {
            //Insert new draft

            $templateID = $mWorkflow->addWorkflowDraft($aData, $moduleName);

            if ($templateID > 0) {
                $response['status'] = 'success';
                $response['draftID'] = $templateID;
            } else {
                $response['status'] = 'error';
            }
        } else {
            //update existing draft
            $bUpdated = $mWorkflow->updateWorkflowDraft($aData, $draftID, $moduleName);
            if ($bUpdated) {
                $response['status'] = 'success';
                $response['draftID'] = $draftID;
            } else {
                $response['status'] = 'error';
            }
        }





        echo json_encode($response);
        exit;
    }

    /**
     * Used to save campaign into the my templates
     */
    public function savetoMyTemplates(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $subject = strip_tags($request->subject);
        $stripoHtml = $request->stripo_html;
        $stripoCss = $request->stripo_css;
        $stripoCompiledHtml = $request->stripo_compiled_html;
        $campaignID = strip_tags($request->campaignId);
        $moduleName = strip_tags($request->moduleName);

        $greeting = db_in($request->greeting);
        $introduction = db_in($request->introduction);
        $myTemplateID = strip_tags($request->myTemplateId);


        if (!empty($campaignID)) {
            $oCampaign = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
            $myTemplateID = $oCampaign->mytemplateId;
            $templateType = strtolower($oCampaign->campaign_type);
            $templateSource = $oCampaign->template_source;
            if ($templateSource > 0) {
                $oTemplate = $mWorkflow->getCommonTemplateInfo($templateSource);
                if (!empty($oTemplate)) {
                    $templateName = $oTemplate->template_name;
                    for ($i = 1; $i++; $i <= 20) {
                        $isExists = $mWorkflow->getCommonTemplateByName($templateName, $userID);
                        if ($isExists == false) {
                            break;
                        } else {
                            $templateName = $templateName . ' ' . $i;
                        }
                    }
                }
            }
        }



        $aData = array(
            'user_id' => $userID,
            'template_name' => ($templateName) ? $templateName : 'My Template' . time()
        );



        if (!empty($subject)) {
            $aData['template_subject'] = $subject;
        }

        if (!empty($stripoHtml)) {
            $aData['stripo_html'] = base64_encode($stripoHtml);
        }

        if (!empty($stripoCss)) {
            $aData['stripo_css'] = base64_encode($stripoCss);
        }

        if (!empty($stripoCompiledHtml)) {
            $aData['stripo_compiled_html'] = base64_encode($stripoCompiledHtml);
        }

        if (!empty($greeting)) {
            $aData['greeting'] = $greeting;
        }

        if (!empty($introduction)) {
            $aData['introduction'] = $introduction;
        }

        if (!empty($template_source)) {
            $aData['template_source'] = $template_source;
        }

        if (!empty($templateType)) {
            $aData['template_type'] = $templateType;
        }

        if (!empty($previewIcon)) {
            $aData['preview_icon'] = $previewIcon;
        }


        if (empty($myTemplateID)) {
            //insert new user template
            $aData['created'] = date("Y-m-d H:i:s");
            $myTemplateID = $mWorkflow->addWorkflowMyTemplate($aData, $moduleName);
            if ($myTemplateID > 0) {
                //Update the same info into the target workflow campaign  
                $aCampaignData = array('mytemplateId' => $myTemplateID);

                $mWorkflow->updateWorkflowCampaign($aCampaignData, $campaignID, $moduleName);
                $response['status'] = 'success';
                $response['mytemplateid'] = $myTemplateID;
            } else {
                $response['status'] = 'error';
            }
        } else {
            //update user template
            $aData['updated'] = date("Y-m-d H:i:s");
            unset($aData['template_name']);
            $bUpdated = $mWorkflow->updateWorkflowMyTemplate($aData, $myTemplateID, $userID);
            if ($bUpdated) {
                $response['status'] = 'success';
                $response['mytemplateid'] = $myTemplateID;
            } else {
                $response['status'] = 'error';
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * used to update workflow draft
     */
    public function updateWorkflowDraft(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $moduleName = strip_tags($request->moduleName);
        $templateName = strip_tags($request->templateName);
        $draftID = strip_tags($request->template_draft_id);

        $bDuplicate = $mWorkflow->isDuplicateWorkflowDraft($templateName, $moduleName, $userID);
        //echo "Duplicate ID is ". $bDuplicate;
        //die;
        if ($bDuplicate == true) {
            //Display Error and ask to enter template name something else
            $response['status'] = 'error';
            $response['msg'] = 'duplicate';
        } else {
            $aData = array(
                'template_name' => $templateName
            );
            $bUpdated = $mWorkflow->updateWorkflowDraft($aData, $draftID, $moduleName);
            if ($bUpdated) {
                $response['status'] = 'success';
                $response['draftID'] = $draftID;
            } else {
                $response['status'] = 'error';
            }
        }



//        $templateID = $mWorkflow->addWorkflowDraft($aData, $moduleName);
//
//        if ($templateID > 0) {
//            $response['status'] = 'success';
//            $response['draftID'] = $templateID;
//        } else {
//            $response['status'] = 'error';
//        }






        echo json_encode($response);
        exit;
    }

    /**
     * Used to update in the workflow template
     */
    public function updateWorkflowTemplate(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $subject = strip_tags($request->subject);
        $content = db_in($request->content);
        $stripoHtml = $request->stripo_html;
        $stripoCss = $request->stripo_css;
        $stripoCompiledHtml = $request->stripo_compiled_html;
        $templateID = strip_tags($request->templateId);
        $moduleName = strip_tags($request->moduleName);

        $greeting = db_in($request->greeting);
        $introduction = db_in($request->introduction);

        $aData = array();

        if (!empty($subject)) {
            $aData['template_subject'] = $subject;
        }

        if (!empty($content)) {
            $aData['html'] = base64_encode($content);
        }

        if (!empty($stripoHtml)) {
            $aData['stripo_html'] = base64_encode($stripoHtml);
        }

        if (!empty($stripoCss)) {
            $aData['stripo_css'] = base64_encode($stripoCss);
        }

        if (!empty($stripoCompiledHtml)) {
            $aData['stripo_compiled_html'] = base64_encode($stripoCompiledHtml);
        }

        if (!empty($greeting)) {
            $aData['greeting'] = $greeting;
        }

        if (!empty($introduction)) {
            $aData['introduction'] = $introduction;
        }

        $bUpdated = $mWorkflow->updateWorkflowTemplate($aData, $templateID, $moduleName);

        if ($bUpdated) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'Error';
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to send Test Emails from the workflow campaign
     */
    public function sendTestEmailworkflowCampaign(Request $request) {
        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;


        $campaignID = strip_tags($request->campaignId);
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);
        $emailAddress = strip_tags($request->email);

        $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
        if (!empty($oResponse)) {
            $templateSource = $oResponse->template_source;
            if ($templateSource > 0) {
                //$oDefaultTemplate = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $templateSource);
                $oDefaultTemplate = $mWorkflow->getCommonTemplateInfo($templateSource);
                $defaultGreeting = $oDefaultTemplate->greeting;
                $defaultIntroduction = $oDefaultTemplate->introduction;
            }

            $greeting = (!empty($oResponse->greeting)) ? $oResponse->greeting : $defaultGreeting;
            $introduction = (!empty($oResponse->introduction)) ? $oResponse->introduction : $defaultIntroduction;

            $cont = base64_decode($oResponse->stripo_compiled_html);
            $content = str_replace('\n', "<br>", $cont);

//            $content = str_replace(array('{GREETING}', '{INTRODUCTION}'), array($greeting, $introduction), $content);
//            $content = str_replace(array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}'), array($aUser->firstname, $aUser->lastname, $aUser->email), $content);


            $oUnitData = $mWorkflow->getModuleUnitInfo($moduleName, $moduleUnitID);

            $content = str_replace(array('{{GREETING}}', '{GREETING}', '{{INTRODUCTION}}', '{INTRODUCTION}', 'wf_edit_template_introduction', 'wf_edit_sms_template_introduction'), array($greeting, $greeting, $introduction, $introduction, 'wf_edit_template_introduction_EDITOR', 'wf_edit_sms_template_introduction_EDITOR'), $content);
            $content = str_replace(array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}'), array($aUser->firstname, $aUser->lastname, $aUser->email), $content);


            if ($moduleName == 'nps') {
                $content = $mWorkflow->parseModuleStatictemplate($moduleName, $content, strtolower($oResponse->campaign_type), $oUnitData);
            }

            if ($moduleName == 'referral') {
                //Parse templates

                $content = $this->referralEmailTagReplace($moduleUnitID, $content, $oResponse->content_type, $aUser);
            }

            if ($moduleName == 'onsite' || $moduleName == 'offsite' || $moduleName == 'brandboost') {
                //Parse few more template tags if have any
                $content = $this->brandboostEmailTagReplace($moduleUnitID, $content, $oResponse->content_type, $aUser);
            }

            $subject = $oResponse->subject;

            $preheader = $oResponse->preheader;

            if (!empty($preheader)) {
                $sPreheaderText = '<span class="c3896 c5535" style="box-sizing: border-box;display:none;visibility:hidden;mso-hide:all;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">' . $preheader . '</span>';
            }

            //Get Sendgrid Info for client
            $aSendgridData = $this->mInviter->getSendgridAccount($userID);
            if (!empty($aSendgridData)) {
                $userName = $aSendgridData->sg_username;
                $password = $aSendgridData->sg_password;

                $aEmailData = array(
                    'username' => $userName,
                    'password' => $password,
                    'from_email' => $aUser->email,
                    'from_name' => $aUser->firstname . ' ' . $aUser->lastname,
                    'email' => $emailAddress,
                    'message' => $sPreheaderText . $content,
                    'subject' => $subject
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
                        'module_name' => $moduleName,
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
     * Used to send Test SMS from the workflow campaign
     */
    public function sendTestSMSworkflowCampaign(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $campaignID = strip_tags($request->campaignId);
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);
        $number = strip_tags($request->number);

        $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
        if (!empty($oResponse)) {
            $templateSource = $oResponse->template_source;
            if ($templateSource > 0) {
                $oDefaultTemplate = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $templateSource);
                $defaultGreeting = $oDefaultTemplate[0]->greeting;
                $defaultIntroduction = $oDefaultTemplate[0]->introduction;
            }

            $oUnitData = $mWorkflow->getModuleUnitInfo($moduleName, $moduleUnitID);

            $greeting = (!empty($oResponse->greeting)) ? $oResponse->greeting : $defaultGreeting;
            $introduction = (!empty($oResponse->introduction)) ? $oResponse->introduction : $defaultIntroduction;

            $content = base64_decode($oResponse->stripo_compiled_html);

            $content = str_replace(array('{{GREETING}}', '{GREETING}', '{{INTRODUCTION}}', '{INTRODUCTION}', 'wf_edit_template_introduction', 'wf_edit_sms_template_introduction'), array($greeting, $greeting, $introduction, $introduction, 'wf_edit_template_introduction_EDITOR', 'wf_edit_sms_template_introduction_EDITOR'), $content);
            $content = str_replace(array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}'), array($aUser->firstname, $aUser->lastname, $aUser->email), $content);

            if ($moduleName == 'nps') {
                $content = $mWorkflow->parseModuleStatictemplate($moduleName, $content, strtolower($oResponse->campaign_type), $oUnitData);
            }

            if ($moduleName == 'referral') {
                //Parse templates

                $content = $this->referralEmailTagReplace($moduleUnitID, $content, $oResponse->content_type, $aUser);
            }

            if ($moduleName == 'onsite' || $moduleName == 'offsite' || $moduleName == 'brandboost') {
                //Parse few more template tags if have any
                $content = $this->brandboostEmailTagReplace($moduleUnitID, $content, $oResponse->content_type, $aUser);
            }

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
                    'module_name' => $moduleName,
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
     * Display campaign preview
     */
    public function previewWorkflowCampaign(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $campaignID = strip_tags($request->campaignId);
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitId);
        $outputType = strip_tags($request->returnMethod);
        $previewType = strip_tags($request->previewType);
        
        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        $previewPrefix = ($previewType == 'onlyPreview') ? 'PREVIEW' : 'EDITOR';

        $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);

        if (!empty($oResponse)) {
            $templateSource = $oResponse->template_source;
            if ($templateSource > 0) {
                $oDefaultTemplate = $mWorkflow->getCommonTemplateInfo($templateSource);
                $defaultGreeting = $oDefaultTemplate->greeting;
                $defaultIntroduction = $oDefaultTemplate->introduction;
            }
            $oUnitData = $mWorkflow->getModuleUnitInfo($moduleName, $moduleUnitID);
            //pre($oUnitData);
            $cont = base64_decode($oResponse->stripo_compiled_html);
            $content = str_replace('\n', "<br>", $cont);

            $greeting = (!empty($oResponse->greeting)) ? $oResponse->greeting : $defaultGreeting;
            $introduction = (!empty($oResponse->introduction)) ? $oResponse->introduction : $defaultIntroduction;

            $content = str_replace(array('{{GREETING}}', '{GREETING}', '{{INTRODUCTION}}', '{INTRODUCTION}', 'wf_edit_template_introduction', 'wf_edit_sms_template_introduction', 'wf_edit_template_greeting'), array($greeting, $greeting, $introduction, $introduction, 'wf_edit_template_introduction_' . $previewPrefix, 'wf_edit_sms_template_introduction_' . $previewPrefix, 'wf_edit_template_greeting_' . $previewPrefix), $content);
            $content = str_replace(array('{FIRST_NAME}', '{LAST_NAME}', '{EMAIL}'), array($aUser->firstname, $aUser->lastname, $aUser->email), $content);


            if ($moduleName == 'nps') {
                $content = $mWorkflow->parseModuleStatictemplate($moduleName, $content, strtolower($oResponse->campaign_type), $oUnitData);
            }

            if ($moduleName == 'referral') {
                //Parse templates

                $content = $this->referralEmailTagReplace($moduleUnitID, $content, $oResponse->content_type, $aUser);
            }

            if ($moduleName == 'onsite' || $moduleName == 'offsite' || $moduleName == 'brandboost') {
                //Parse few more template tags if have any
                $content = $this->brandboostEmailTagReplace($moduleUnitID, $content, $oResponse->content_type, $aUser);
            }
            $response['status'] = 'success';
            $response['content'] = stripslashes($content);
            $response['template_source'] = $oResponse->template_source;
            $response['subject'] = $oResponse->subject;
            $response['greeting'] = str_replace(array('\n', '<br>'), array('', ''), $greeting);
            $response['introduction'] = str_replace(array('\n', '<br>'), array('', ''), $introduction);
        } else {
            $response['status'] = 'error';
        }

        if ($outputType == 'return') {
            $response['content'] = str_replace(array("wf_edit_sms_template_greeting", "wf_edit_sms_template_introduction"), array("wf_edit_sms_template_greeting_PREVIEW", "wf_edit_sms_template_introduction_PREVIEW"), stripslashes($content));
            return $response;
        } else {
            echo json_encode($response);
            exit;
        }
    }

    /**
     * Used to get workflow campaign details
     */
    public function getWorkflowCampaign(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $campaignID = strip_tags($request->campaignId);
        $moduleName = strip_tags($request->moduleName);

        $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
        if (!empty($campaignID)) {
            $subject = $oResponse->subject;
            $content = base64_decode($oResponse->html);
            $compliedHtml = base64_decode($oResponse->stripo_compiled_html);
            $response['status'] = 'success';
            $response['campaign_id'] = $campaignID;
            $response['subject'] = $subject;
            $response['content'] = $content;
            $response['compiled_content'] = $compliedHtml;
            $response['createdVal'] = date("M d, Y H:i A", strtotime($oResponse->created));
        } else {
            $response['status'] = 'error';
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Workflow template
     * @param Request $request
     */
    public function getWorkflowTemplate(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $templateID = strip_tags($request->templateId);
        $moduleName = strip_tags($request->moduleName);

        $oResponseRow = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $templateID);
        $oResponse = $oResponseRow[0];
        //echo "Template ID is ". $templateID;
        //pre($oResponse);
        if (!empty($templateID)) {
            //echo "I am in now";

            $subject = $oResponse->subject;
            $content = base64_decode($oResponse->html);
            $compliedHtml = base64_decode($oResponse->stripo_compiled_html);
            $response['status'] = 'success';
            $response['template_id'] = $templateID;
            $response['subject'] = $subject;
            $response['greeting'] = $oResponse->greeting;
            $response['introduction'] = $oResponse->introduction;
            $response['content'] = $content;
            $response['compiled_content'] = $compliedHtml;
            $response['createdVal'] = date("M d, Y H:i A", strtotime($oResponse->created));
        } else {
            $response['status'] = 'error';
        }

        echo json_encode($response);
        exit;
    }

    /**
     * 
     * @param Request $requestUsed to delete workflow Event node
     */
    public function deleteWorkflowEvent(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $eventID = strip_tags($request->event_id);
        $moduleName = strip_tags($request->moduleName);

        if ($eventID > 0) {
            //Get Current Node
            $oCurrentNode = $mWorkflow->getNodeInfo($eventID, $moduleName);
            if (!empty($oCurrentNode)) {
                $previousID = $oCurrentNode->previous_event_id;
            }


            //Get Previous Node
            $oPreviousNode = $mWorkflow->getNodeInfo($previousID, $moduleName);

            //Get Next Node
            $oNextNode = $mWorkflow->getNextNodeInfo($eventID, $moduleName);

            //Delete Node Now
            $bDeleted = $mWorkflow->deleteNode($eventID, $moduleName);

            if ($bDeleted) {
                //Connect adjacent nodes
                if (!empty($oNextNode)) {

                    $aData = array(
                        'previous_event_id' => $oPreviousNode->id
                    );

                    if ($oCurrentNode->event_type != 'followup') {
                        $aData['event_type'] = $oCurrentNode->event_type;
                    }



                    if (empty($oPreviousNode)) {
                        //We deleted main event so now assign next node as a main event
                        $aData['event_type'] = $oCurrentNode->event_type;
                    }

                    $nextNodeTriggerData = json_decode($oNextNode->data);
                    $currentNodeTriggerData = json_decode($oCurrentNode->data);
                    if ($nextNodeTriggerData->delay_value == 0 && $nextNodeTriggerData->delay_unit == 'minute') {
                        if (!empty($currentNodeTriggerData)) {
                            $eventDataArr = array("delay_type" => "after", "delay_value" => $currentNodeTriggerData->delay_value, "delay_unit" => $currentNodeTriggerData->delay_unit, "event_type" => 'followup');
                            $aData['data'] = json_encode($eventDataArr);
                        }
                    }
                    $bUpdated = $mWorkflow->updateNode($aData, $oNextNode->id, $moduleName);
                }

                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        } else {
            $response['status'] = 'error';
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete workflow Draft
     */
    public function deleteWorkflowDraft(Request $request) {
        $response = array();
        $response['status'] = 'something went wrong';
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $templateID = strip_tags($request->template_id);
        $moduleName = strip_tags($request->moduleName);
        if (!empty($moduleName) && $templateID > 0) {
            $bDeleted = $mWorkflow->deleteWorkflowDraft($moduleName, $templateID);
            if ($bDeleted) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to load Stripo campaign
     */
    public function loadStripoCampaign($moduleName, $campaignID, $moduleUnitID = '') {
        $templateTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
        $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
        $subject = $oResponse->subject;
        $preheader = $oResponse->preheader;
        $template_source = $oResponse->template_source;
        $compiledSource = $oResponse->stripo_compiled_html;
        $aData = array(
            'campaignID' => $campaignID,
            'moduleUnitID' => $moduleUnitID,
            'moduleName' => $moduleName,
            'subject' => $subject,
            'preheader' => $preheader,
            'tags' => $templateTags,
            'template_source' => $template_source,
            'compiledSource' => $compiledSource
        );
        $this->load->view("admin/workflow/stripo.php", $aData);
    }

    /**
     * Used to load Stripo SMS campaign
     */
    public function loadStripoSMSCampaign($moduleName, $campaignID, $moduleUnitID = '') {
        $templateTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
        $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);
        $subject = $oResponse->subject;
        $template_source = $oResponse->template_source;
        $compiledSource = $oResponse->stripo_compiled_html;
        $aData = array(
            'campaignID' => $campaignID,
            'moduleUnitID' => $moduleUnitID,
            'moduleName' => $moduleName,
            'subject' => $subject,
            'tags' => $templateTags,
            'template_source' => $template_source,
            'compiledSource' => $compiledSource
        );
        $this->load->view("admin/workflow2/smsStripo.php", $aData);
    }

    /**
     * Used to load Stripo template
     */
    public function loadStripoTemplate($moduleName, $templateID) {
        $templateTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
        $oResponse = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $templateID);
        $subject = $oResponse[0]->template_subject;
        $aData = array(
            'templateID' => $templateID,
            'moduleName' => $moduleName,
            'subject' => $subject,
            'greeting' => $oResponse[0]->greeting,
            'introduction' => $oResponse[0]->introduction,
            'tags' => $templateTags
        );
        $this->load->view("admin/workflow/stripo_template.php", $aData);
    }

    /**
     * Used to see Stripo template preview
     */
    public function loadStripoTemplatePreview(Request $request, $modName = '', $tempID = '', $draft = '', $uid = '') {
        $bURLPreview = false;
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $moduleName = strip_tags($request->moduleName);
        $templateID = strip_tags($request->template_id);
        $source = strip_tags($request->source);
        $isDraft = ($source == 'draft') ? true : false;
        $templateTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
        if (!empty($modName) && !empty($tempID)) {
            $bURLPreview = true;
            $moduleName = $modName;
            $templateID = $tempID;
            $userID = $uid;
            if (!empty($draft)) {
                $isDraft = true;
            }
        }

        if ($isDraft == true) {
            //$moduleName, $templateID, $userID
            $oResponse = $mWorkflow->getWorkflowDraftTemplates($moduleName, $templateID, $userID);
        } else {
            $oResponse = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $templateID);
        }

        $subject = $oResponse[0]->template_subject;
        $aData = array(
            'templateID' => $templateID,
            'moduleName' => $moduleName,
            'subject' => $subject,
            'greeting' => $oResponse[0]->greeting,
            'introduction' => $oResponse[0]->introduction,
            'tags' => $templateTags,
            'campaign_type' => $oResponse[0]->campaign_type
        );
        $sHtml = $this->loadStripoTemplateResources('', 'broadcast', $templateID, true, $isDraft);
        if ($bURLPreview == true) {
            echo $sHtml;
            exit;
        } else {
            $this->load->view("admin/workflow/stripo_template.php", $aData);
        }

        $response['status'] = 'success';
        $response['content'] = $sHtml;
        echo json_encode($response);
        exit;
    }

    /**
     * Used to load Stripo Campaign Resources
     */
    public function loadStripoCampaignResources($type, $moduleName, $campaignID, $returnType = false) {
        //$campaignID = '457';
        //$moduleName = 'brandboost';
        $oResponse = $mWorkflow->getWorkflowCampaign($campaignID, $moduleName);

        if (!empty($oResponse)) {


            $subject = $oResponse->subject;
            $html = base64_decode($oResponse->stripo_html);
            $css = base64_decode($oResponse->stripo_css);
            $compiled = base64_decode($oResponse->stripo_compiled_html);
            $templateTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
            $blankStripoContent = $this->getStripoBlankContent();

            $blankHtml = base64_decode($blankStripoContent['html']);
            $blankCss = base64_decode($blankStripoContent['css']);
            $blankCompiled = base64_decode($blankStripoContent['compiled']);

            $stripo_html = (!empty($html)) ? $html : $blankHtml;

            $stripo_css = (!empty($css)) ? $css : $blankCss;

            $stripo_compiled = (!empty($compiled)) ? $compiled : $blankCompiled;

            if ($returnType == true) {
                return $stripo_compiled;
                exit;
            }


            $aData = array(
                'campaignID' => $campaignID,
                'html' => $stripo_html,
                'css' => $stripo_css,
                'compiled_source' => $stripo_compiled,
                'tags' => $templateTags
            );

            if ($type == 'html') {
                echo $stripo_html;
            } else if ($type == 'css') {
                echo $stripo_css;
            } else if ($type == 'compliled') {
                echo $stripo_compiled;
            }

            //$this->load->view("admin/workflow/stripo.php", $aData);
        }
    }

    /**
     * Used to load Stripo template Resources
     */
    public function loadStripoTemplateResources($type, $moduleName, $templateID, $returnType = false, $isDraft = false) {
        //$campaignID = '457';
        //$moduleName = 'brandboost';
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$oResponse = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $templateID);
        if ($isDraft == true) {
            //$moduleName, $templateID, $userID
            $oResponse = $mWorkflow->getWorkflowDraftTemplates($moduleName, $templateID, $userID);
        } else {
            $oResponse = $mWorkflow->getWorkflowDefaultTemplates($moduleName, '', $templateID);
        }

        if (!empty($oResponse)) {


            $subject = $oResponse[0]->template_subject;
            $html = base64_decode($oResponse[0]->stripo_html);
            $css = base64_decode($oResponse[0]->stripo_css);
            $compiled = base64_decode($oResponse[0]->stripo_compiled_html);
            $templateTags = $mWorkflow->getWorkflowCampaignTags($moduleName);
            $campaignType = $oResponse[0]->template_type;

            $blankStripoContent = $this->getStripoBlankContent();

            $blankHtml = base64_decode($blankStripoContent['html']);
            $blankCss = base64_decode($blankStripoContent['css']);
            $blankCompiled = base64_decode($blankStripoContent['compiled']);

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
     * 
     * @param type $moduleNameUsed to get all the templates
     */
    public function templates($moduleName = '') {
        //brandboost Templates
        //Onsite Templates
        $oOnsiteTemplates = $mWorkflow->getWorkflowDefaultTemplates('brandboost', 'onsite');

        //Offsite Templates
        $oOffsiteTemplates = $mWorkflow->getWorkflowDefaultTemplates('brandboost', 'offsite');

        //Automation Template
        $oAutomationTemplates = $mWorkflow->getWorkflowDefaultTemplates('automation');

        //Broadcast Template
        $oBroadcastTemplates = $mWorkflow->getWorkflowDefaultTemplates('broadcast');

        //Referral Templates
        $oReferralTemplates = $mWorkflow->getWorkflowDefaultTemplates('referral');

        //NPS Templates
        $oNPSTemplates = $mWorkflow->getWorkflowDefaultTemplates('nps');


        $oCampaignTags = $this->config->item('email_tags');

        $oCategories = $mWorkflow->getWorkflowTemplateCategories('automation');


        //pre($oCampaignTags);

        $aData = array(
            'aData' => array(
                array('moduleName' => 'onsite', 'templates' => $oOnsiteTemplates),
                array('moduleName' => 'offsite', 'templates' => $oOffsiteTemplates),
                array('moduleName' => 'automation', 'templates' => $oAutomationTemplates),
                array('moduleName' => 'broadcast', 'templates' => $oBroadcastTemplates),
                array('moduleName' => 'referral', 'templates' => $oReferralTemplates),
                array('moduleName' => 'nps', 'templates' => $oNPSTemplates),
                'oCampaignTags' => $oCampaignTags,
                'oCategories' => $oCategories
            )
        );

        if ($moduleName == 'automation') {
            $this->template->load('admin/admin_template_new', 'admin/workflow/manage_default_automation_templates', $aData);
        } else if ($moduleName == 'broadcast') {
            $this->template->load('admin/admin_template_new', 'admin/workflow/manage_default_broadcast_templates', $aData);
        } else {
            $this->template->load('admin/admin_template_new', 'admin/workflow/manage_default_templates', $aData);
        }
    }

    /**
     * Used to add new template
     */
    public function addWorkflowTemplate(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $userRole = $aUser->user_role;
        if (empty($request)) {
            $response['status'] = 'error';
            echo json_encode($response);
            exit;
        }



        if ($userRole == 1) {
            $moduleName = strip_tags($request->moduleName);
            $title = strip_tags($request->template_name);
            $categoryID = strip_tags($request->categoryName);
            $subject = strip_tags($request->template_subject);
            $type = strip_tags($request->template_type);

            $stripoHtml = ($request->stripo_html);
            $stripoCSS = ($request->stripo_css);

            $blankStripoContent = $this->getStripoBlankContent();

            $blankHtml = $blankStripoContent['html'];
            $blankCss = $blankStripoContent['css'];

            $stripoHtml = (!empty($stripoHtml)) ? base64_encode($stripoHtml) : $blankHtml;
            $stripoCSS = (!empty($stripoCSS)) ? base64_encode($stripoCSS) : $blankCss;
            $blankCompiled = (strtolower($type) == 'sms') ? base64_encode('Blank SMS') : $blankStripoContent['compiled'];

            $aData = array(
                'user_id' => 0,
                'template_name' => $title,
                'template_subject' => $subject,
                'template_content' => $blankCompiled,
                'stripo_html' => $stripoHtml,
                'stripo_css' => $stripoCSS,
                'stripo_compiled_html' => $blankCompiled,
                'template_type' => $type,
                'created' => date("Y-m-d H:i:s")
            );

            if (in_array($moduleName, array('brandboost', 'onsite', 'offsite'))) {
                $aData['brandboost_type'] = $moduleName;
            }

            if (in_array($moduleName, array('automation', 'broadcast'))) {
                $aData['category_id'] = $categoryID;
            }

            $templateID = $mWorkflow->addWorkflowTemplate($aData, $moduleName);

            if ($templateID > 0) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        } else {
            $response['status'] = 'error';
            $response['msg'] = 'Not authorized to access this page';
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to delete workflow template
     */
    public function deleteWorkflowTemplate(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $userRole = $aUser->user_role;
        if (empty($request)) {
            $response['status'] = 'error';
            echo json_encode($response);
            exit;
        }

        if ($userRole == 1) {

            $moduleName = strip_tags($request->moduleName);
            $templateID = strip_tags($request->templateID);

            if (!empty($moduleName) && $templateID > 0) {
                $bDeleted = $mWorkflow->deleteWorkflowTemplate($moduleName, $templateID);
                if ($bDeleted) {
                    $response['status'] = 'success';
                } else {
                    $response['status'] = 'error';
                }
            }
        } else {
            $response['status'] = 'error';
            $response['msg'] = 'Not authorized to access this page';
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Stripo blank Contents
     */
    public function getStripoBlankContent() {
        $html = 'PCFET0NUWVBFIGh0bWwgUFVCTElDICItLy9XM0MvL0RURCBYSFRNTCAxLjAgVHJhbnNpdGlvbmFsLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL1RSL3hodG1sMS9EVEQveGh0bWwxLXRyYW5zaXRpb25hbC5kdGQiPjxodG1sPjxoZWFkPiAKICA8bWV0YSBjaGFyc2V0PSJVVEYtOCI+IAogIDxtZXRhIGNvbnRlbnQ9IndpZHRoPWRldmljZS13aWR0aCwgaW5pdGlhbC1zY2FsZT0xIiBuYW1lPSJ2aWV3cG9ydCI+IAogIDxtZXRhIG5hbWU9IngtYXBwbGUtZGlzYWJsZS1tZXNzYWdlLXJlZm9ybWF0dGluZyI+IAogIDxtZXRhIGh0dHAtZXF1aXY9IlgtVUEtQ29tcGF0aWJsZSIgY29udGVudD0iSUU9ZWRnZSI+IAogIDxtZXRhIGNvbnRlbnQ9InRlbGVwaG9uZT1ubyIgbmFtZT0iZm9ybWF0LWRldGVjdGlvbiI+IAogIDx0aXRsZT48L3RpdGxlPiAKICA8IS0tW2lmIChtc28gMTYpXT4KICAgIDxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+CiAgICBhIHt0ZXh0LWRlY29yYXRpb246IG5vbmU7fQogICAgPC9zdHlsZT4KICAgIDwhW2VuZGlmXS0tPiAKICA8IS0tW2lmIGd0ZSBtc28gOV0+PHN0eWxlPnN1cCB7IGZvbnQtc2l6ZTogMTAwJSAhaW1wb3J0YW50OyB9PC9zdHlsZT48IVtlbmRpZl0tLT4gCiA8L2hlYWQ+PGJvZHkgc3R5bGU9ImRpc3BsYXk6IGJsb2NrOyI+IAogIDxkaXYgY2xhc3M9ImVzLXdyYXBwZXItY29sb3IiPiAKICAgPCEtLVtpZiBndGUgbXNvIDldPgoJCQk8djpiYWNrZ3JvdW5kIHhtbG5zOnY9InVybjpzY2hlbWFzLW1pY3Jvc29mdC1jb206dm1sIiBmaWxsPSJ0Ij4KCQkJCTx2OmZpbGwgdHlwZT0idGlsZSIgc3JjPSIiIGNvbG9yPSIjZjZmNmY2Ij48L3Y6ZmlsbD4KCQkJPC92OmJhY2tncm91bmQ+CgkJPCFbZW5kaWZdLS0+IAogICA8dGFibGUgY2xhc3M9ImVzLXdyYXBwZXIiIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgIDx0Ym9keT4gCiAgICAgPHRyPiAKICAgICAgPHRkIGNsYXNzPSJlc2QtZW1haWwtcGFkZGluZ3MiIHZhbGlnbj0idG9wIj4gCiAgICAgICA8dGFibGUgY2xhc3M9ImVzZC1oZWFkZXItcG9wb3ZlciBlcy1jb250ZW50IiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJjZW50ZXIiPiAKICAgICAgICA8dGJvZHk+IAogICAgICAgICA8dHI+IAogICAgICAgICAgPHRkIGNsYXNzPSJlc2Qtc3RyaXBlIiBhbGlnbj0iY2VudGVyIj4KICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAKICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgICAKICAgICAgICAgICA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQtYm9keSIgc3R5bGU9ImJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OyIgd2lkdGg9IjYwMCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0iY2VudGVyIiBlc2QtaW1nLXByZXYtc3JjPSIiPiAKICAgICAgICAgICAgPHRib2R5PiAKICAgICAgICAgICAgIDx0cj4gCiAgICAgICAgICAgICAgPHRkIGNsYXNzPSJlc2Qtc3RydWN0dXJlIGVzLXAyMHQgZXMtcDIwYiBlcy1wMjByIGVzLXAyMGwiIGFsaWduPSJsZWZ0Ij4KICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgIDwhLS1baWYgbXNvXT48dGFibGUgd2lkdGg9IjU2MCIgY2VsbHBhZGRpbmc9IjAiIGNlbGxzcGFjaW5nPSIwIj48dHI+PHRkIHdpZHRoPSIzNTYiIHZhbGlnbj0idG9wIj48IVtlbmRpZl0tLT4gCiAgICAgICAgICAgICAgIDx0YWJsZSBjbGFzcz0iZXMtbGVmdCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0ibGVmdCI+IAogICAgICAgICAgICAgICAgPHRib2R5PiAKICAgICAgICAgICAgICAgICA8dHI+IAogICAgICAgICAgICAgICAgICA8dGQgY2xhc3M9ImVzLW0tcDByIGVzLW0tcDIwYiBlc2QtY29udGFpbmVyLWZyYW1lIiB3aWR0aD0iMzU2IiB2YWxpZ249InRvcCIgYWxpZ249ImNlbnRlciI+CiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgICAgICAgICAgICAgICAgICA8dGJvZHk+IAogICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgPHRyPjx0ZCBhbGlnbj0iY2VudGVyIiBjbGFzcz0iZXNkLWVtcHR5LWNvbnRhaW5lciIgc3R5bGU9ImRpc3BsYXk6IG5vbmU7Ij48L3RkPjwvdHI+PC90Ym9keT4gCiAgICAgICAgICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgICAgICAgICA8L3RyPiAKICAgICAgICAgICAgICAgIDwvdGJvZHk+IAogICAgICAgICAgICAgICA8L3RhYmxlPiAKICAgICAgICAgICAgICAgPCEtLVtpZiBtc29dPjwvdGQ+PHRkIHdpZHRoPSIyMCI+PC90ZD48dGQgd2lkdGg9IjE4NCIgdmFsaWduPSJ0b3AiPjwhW2VuZGlmXS0tPiAKICAgICAgICAgICAgICAgPHRhYmxlIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgYWxpZ249InJpZ2h0Ij4gCiAgICAgICAgICAgICAgICA8dGJvZHk+IAogICAgICAgICAgICAgICAgIDx0cj4gCiAgICAgICAgICAgICAgICAgIDx0ZCBjbGFzcz0iZXNkLWNvbnRhaW5lci1mcmFtZSIgd2lkdGg9IjE4NCIgYWxpZ249ImxlZnQiPgogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgIDx0YWJsZSB3aWR0aD0iMTAwJSIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIj4gCiAgICAgICAgICAgICAgICAgICAgPHRib2R5PiAKICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgIDx0cj48dGQgYWxpZ249ImNlbnRlciIgY2xhc3M9ImVzZC1lbXB0eS1jb250YWluZXIiIHN0eWxlPSJkaXNwbGF5OiBub25lOyI+PC90ZD48L3RyPjwvdGJvZHk+IAogICAgICAgICAgICAgICAgICAgPC90YWJsZT4gPC90ZD4gCiAgICAgICAgICAgICAgICAgPC90cj4gCiAgICAgICAgICAgICAgICA8L3Rib2R5PiAKICAgICAgICAgICAgICAgPC90YWJsZT4gCiAgICAgICAgICAgICAgIDwhLS1baWYgbXNvXT48L3RkPjwvdHI+PC90YWJsZT48IVtlbmRpZl0tLT4gPC90ZD4gCiAgICAgICAgICAgICA8L3RyPiAKICAgICAgICAgICAgPC90Ym9keT4gCiAgICAgICAgICAgPC90YWJsZT4gPC90ZD4gCiAgICAgICAgIDwvdHI+IAogICAgICAgIDwvdGJvZHk+IAogICAgICAgPC90YWJsZT4gCiAgICAgICAgCiAgICAgICAgCiAgICAgICA8dGFibGUgY2xhc3M9ImVzZC1mb290ZXItcG9wb3ZlciBlcy1jb250ZW50IiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJjZW50ZXIiPiAKICAgICAgICA8dGJvZHk+IAogICAgICAgICA8dHI+IAogICAgICAgICAgPHRkIGNsYXNzPSJlc2Qtc3RyaXBlIiBhbGlnbj0iY2VudGVyIj4KICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAKICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgCiAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgIAogICAgICAgICAKICAgICAgICAgICA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQtYm9keSIgc3R5bGU9ImJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OyIgd2lkdGg9IjYwMCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0iY2VudGVyIj4gCiAgICAgICAgICAgIDx0Ym9keT4gCiAgICAgICAgICAgICA8dHI+IAogICAgICAgICAgICAgIDx0ZCBjbGFzcz0iZXNkLXN0cnVjdHVyZSBlcy1wMzBiIGVzLXAyMHIgZXMtcDIwbCIgYWxpZ249ImxlZnQiPgogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgICAgICAgICAgICAgIDx0Ym9keT4gCiAgICAgICAgICAgICAgICAgPHRyPiAKICAgICAgICAgICAgICAgICAgPHRkIGNsYXNzPSJlc2QtY29udGFpbmVyLWZyYW1lIiB3aWR0aD0iNTYwIiB2YWxpZ249InRvcCIgYWxpZ249ImNlbnRlciI+CiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiPiAKICAgICAgICAgICAgICAgICAgICA8dGJvZHk+IAogICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgPHRyPjx0ZCBhbGlnbj0iY2VudGVyIiBjbGFzcz0iZXNkLWVtcHR5LWNvbnRhaW5lciIgc3R5bGU9ImRpc3BsYXk6IG5vbmU7Ij48L3RkPjwvdHI+PC90Ym9keT4gCiAgICAgICAgICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgICAgICAgICA8L3RyPiAKICAgICAgICAgICAgICAgIDwvdGJvZHk+IAogICAgICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgICAgIDwvdHI+IAogICAgICAgICAgICA8L3Rib2R5PiAKICAgICAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICAgICAgPC90cj4gCiAgICAgICAgPC90Ym9keT4gCiAgICAgICA8L3RhYmxlPiA8L3RkPiAKICAgICA8L3RyPiAKICAgIDwvdGJvZHk+IAogICA8L3RhYmxlPiAKICA8L2Rpdj4gCiA8L2JvZHk+PC9odG1sPg==';

        $css = 'LyoKQ09ORklHIFNUWUxFUwpQbGVhc2UgZG8gbm90IGRlbGV0ZSBhbmQgZWRpdCBDU1Mgc3R5bGVzIGJlbG93CiovCi8qIElNUE9SVEFOVCBUSElTIFNUWUxFUyBNVVNUIEJFIE9OIEZJTkFMIEVNQUlMICovCgojb3V0bG9vayBhIHsKCXBhZGRpbmc6IDA7Cn0KLkV4dGVybmFsQ2xhc3MgewoJd2lkdGg6IDEwMCU7Cn0KLkV4dGVybmFsQ2xhc3MsCi5FeHRlcm5hbENsYXNzIHAsCi5FeHRlcm5hbENsYXNzIHNwYW4sCi5FeHRlcm5hbENsYXNzIGZvbnQsCi5FeHRlcm5hbENsYXNzIHRkLAouRXh0ZXJuYWxDbGFzcyBkaXYgewoJbGluZS1oZWlnaHQ6IDEwMCU7Cn0KLmVzLWJ1dHRvbiB7Cgltc28tc3R5bGUtcHJpb3JpdHk6IDEwMCAhaW1wb3J0YW50OwoJdGV4dC1kZWNvcmF0aW9uOiBub25lICFpbXBvcnRhbnQ7Cn0KYVt4LWFwcGxlLWRhdGEtZGV0ZWN0b3JzXSB7Cgljb2xvcjogaW5oZXJpdCAhaW1wb3J0YW50OwoJdGV4dC1kZWNvcmF0aW9uOiBub25lICFpbXBvcnRhbnQ7Cglmb250LXNpemU6IGluaGVyaXQgIWltcG9ydGFudDsKCWZvbnQtZmFtaWx5OiBpbmhlcml0ICFpbXBvcnRhbnQ7Cglmb250LXdlaWdodDogaW5oZXJpdCAhaW1wb3J0YW50OwoJbGluZS1oZWlnaHQ6IGluaGVyaXQgIWltcG9ydGFudDsKfQouZXMtZGVzay1oaWRkZW4gewogICAgZGlzcGxheTogbm9uZTsKICAgIGZsb2F0OiBsZWZ0OwogICAgb3ZlcmZsb3c6IGhpZGRlbjsKICAgIHdpZHRoOiAwOwogICAgbWF4LWhlaWdodDogMDsKICAgIGxpbmUtaGVpZ2h0OiAwOwogICAgbXNvLWhpZGU6IGFsbDsKfQovKgpFTkQgT0YgSU1QT1JUQU5UCiovCmh0bWwsCmJvZHkgewoJd2lkdGg6IDEwMCU7Cglmb250LWZhbWlseTogYXJpYWwsICdoZWx2ZXRpY2EgbmV1ZScsIGhlbHZldGljYSwgc2Fucy1zZXJpZjsKCS13ZWJraXQtdGV4dC1zaXplLWFkanVzdDogMTAwJTsKCS1tcy10ZXh0LXNpemUtYWRqdXN0OiAxMDAlOwp9CnRhYmxlIHsKCW1zby10YWJsZS1sc3BhY2U6IDBwdDsKCW1zby10YWJsZS1yc3BhY2U6IDBwdDsKCWJvcmRlci1jb2xsYXBzZTogY29sbGFwc2U7Cglib3JkZXItc3BhY2luZzogMHB4Owp9CnRhYmxlIHRkLApodG1sLApib2R5LAouZXMtd3JhcHBlciB7CglwYWRkaW5nOiAwOwoJTWFyZ2luOiAwOwp9Ci5lcy1jb250ZW50LAouZXMtaGVhZGVyLAouZXMtZm9vdGVyIHsKCXRhYmxlLWxheW91dDogZml4ZWQgIWltcG9ydGFudDsKCXdpZHRoOiAxMDAlOwp9CmltZyB7CglkaXNwbGF5OiBibG9jazsKCWJvcmRlcjogMDsKCW91dGxpbmU6IG5vbmU7Cgl0ZXh0LWRlY29yYXRpb246IG5vbmU7CgktbXMtaW50ZXJwb2xhdGlvbi1tb2RlOiBiaWN1YmljOwp9CnRhYmxlIHRyIHsKCWJvcmRlci1jb2xsYXBzZTogY29sbGFwc2U7Cn0KcCwKaHIgewoJTWFyZ2luOiAwOwp9CmgxLApoMiwKaDMsCmg0LApoNSB7CglNYXJnaW46IDA7CglsaW5lLWhlaWdodDogMTIwJTsKCW1zby1saW5lLWhlaWdodC1ydWxlOiBleGFjdGx5OwoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7Cn0KcCwKdWwgbGksCm9sIGxpLAphIHsKCS13ZWJraXQtdGV4dC1zaXplLWFkanVzdDogbm9uZTsKCS1tcy10ZXh0LXNpemUtYWRqdXN0OiBub25lOwoJbXNvLWxpbmUtaGVpZ2h0LXJ1bGU6IGV4YWN0bHk7Cn0KLmVzLWxlZnQgewoJZmxvYXQ6IGxlZnQ7Cn0KLmVzLXJpZ2h0IHsKCWZsb2F0OiByaWdodDsKfQouZXMtcDUgewoJcGFkZGluZzogNXB4Owp9Ci5lcy1wNXQgewoJcGFkZGluZy10b3A6IDVweDsKfQouZXMtcDViIHsKCXBhZGRpbmctYm90dG9tOiA1cHg7Cn0KLmVzLXA1bCB7CglwYWRkaW5nLWxlZnQ6IDVweDsKfQouZXMtcDVyIHsKCXBhZGRpbmctcmlnaHQ6IDVweDsKfQouZXMtcDEwIHsKCXBhZGRpbmc6IDEwcHg7Cn0KLmVzLXAxMHQgewoJcGFkZGluZy10b3A6IDEwcHg7Cn0KLmVzLXAxMGIgewoJcGFkZGluZy1ib3R0b206IDEwcHg7Cn0KLmVzLXAxMGwgewoJcGFkZGluZy1sZWZ0OiAxMHB4Owp9Ci5lcy1wMTByIHsKCXBhZGRpbmctcmlnaHQ6IDEwcHg7Cn0KLmVzLXAxNSB7CglwYWRkaW5nOiAxNXB4Owp9Ci5lcy1wMTV0IHsKCXBhZGRpbmctdG9wOiAxNXB4Owp9Ci5lcy1wMTViIHsKCXBhZGRpbmctYm90dG9tOiAxNXB4Owp9Ci5lcy1wMTVsIHsKCXBhZGRpbmctbGVmdDogMTVweDsKfQouZXMtcDE1ciB7CglwYWRkaW5nLXJpZ2h0OiAxNXB4Owp9Ci5lcy1wMjAgewoJcGFkZGluZzogMjBweDsKfQouZXMtcDIwdCB7CglwYWRkaW5nLXRvcDogMjBweDsKfQouZXMtcDIwYiB7CglwYWRkaW5nLWJvdHRvbTogMjBweDsKfQouZXMtcDIwbCB7CglwYWRkaW5nLWxlZnQ6IDIwcHg7Cn0KLmVzLXAyMHIgewoJcGFkZGluZy1yaWdodDogMjBweDsKfQouZXMtcDI1IHsKCXBhZGRpbmc6IDI1cHg7Cn0KLmVzLXAyNXQgewoJcGFkZGluZy10b3A6IDI1cHg7Cn0KLmVzLXAyNWIgewoJcGFkZGluZy1ib3R0b206IDI1cHg7Cn0KLmVzLXAyNWwgewoJcGFkZGluZy1sZWZ0OiAyNXB4Owp9Ci5lcy1wMjVyIHsKCXBhZGRpbmctcmlnaHQ6IDI1cHg7Cn0KLmVzLXAzMCB7CglwYWRkaW5nOiAzMHB4Owp9Ci5lcy1wMzB0IHsKCXBhZGRpbmctdG9wOiAzMHB4Owp9Ci5lcy1wMzBiIHsKCXBhZGRpbmctYm90dG9tOiAzMHB4Owp9Ci5lcy1wMzBsIHsKCXBhZGRpbmctbGVmdDogMzBweDsKfQouZXMtcDMwciB7CglwYWRkaW5nLXJpZ2h0OiAzMHB4Owp9Ci5lcy1wMzUgewoJcGFkZGluZzogMzVweDsKfQouZXMtcDM1dCB7CglwYWRkaW5nLXRvcDogMzVweDsKfQouZXMtcDM1YiB7CglwYWRkaW5nLWJvdHRvbTogMzVweDsKfQouZXMtcDM1bCB7CglwYWRkaW5nLWxlZnQ6IDM1cHg7Cn0KLmVzLXAzNXIgewoJcGFkZGluZy1yaWdodDogMzVweDsKfQouZXMtcDQwIHsKCXBhZGRpbmc6IDQwcHg7Cn0KLmVzLXA0MHQgewoJcGFkZGluZy10b3A6IDQwcHg7Cn0KLmVzLXA0MGIgewoJcGFkZGluZy1ib3R0b206IDQwcHg7Cn0KLmVzLXA0MGwgewoJcGFkZGluZy1sZWZ0OiA0MHB4Owp9Ci5lcy1wNDByIHsKCXBhZGRpbmctcmlnaHQ6IDQwcHg7Cn0KLmVzLW1lbnUgdGQgewoJYm9yZGVyOiAwOwp9Ci5lcy1tZW51IHRkIGEgaW1nIHsKCWRpc3BsYXk6IGlubGluZSAhaW1wb3J0YW50Owp9Ci8qCkVORCBDT05GSUcgU1RZTEVTCiovCmEgewoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7Cglmb250LXNpemU6IDE0cHg7Cgl0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTsKfQpoMSB7Cglmb250LXNpemU6IDMwcHg7Cglmb250LXN0eWxlOiBub3JtYWw7Cglmb250LXdlaWdodDogbm9ybWFsOwoJY29sb3I6ICMzMzMzMzM7Cn0KaDEgYSB7Cglmb250LXNpemU6IDMwcHg7Cn0KaDIgewoJZm9udC1zaXplOiAyNHB4OwoJZm9udC1zdHlsZTogbm9ybWFsOwoJZm9udC13ZWlnaHQ6IG5vcm1hbDsKCWNvbG9yOiAjMzMzMzMzOwp9CmgyIGEgewoJZm9udC1zaXplOiAyNHB4Owp9CmgzIHsKCWZvbnQtc2l6ZTogMjBweDsKCWZvbnQtc3R5bGU6IG5vcm1hbDsKCWZvbnQtd2VpZ2h0OiBub3JtYWw7Cgljb2xvcjogIzMzMzMzMzsKfQpoMyBhIHsKCWZvbnQtc2l6ZTogMjBweDsKfQpwLAp1bCBsaSwKb2wgbGkgewoJZm9udC1zaXplOiAxNHB4OwoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7CglsaW5lLWhlaWdodDogMTUwJTsKfQp1bCBsaSwKb2wgbGkgewoJTWFyZ2luLWJvdHRvbTogMTVweDsKfQouZXMtbWVudSB0ZCBhIHsKCXRleHQtZGVjb3JhdGlvbjogbm9uZTsKCWRpc3BsYXk6IGJsb2NrOwp9Ci5lcy13cmFwcGVyIHsKCXdpZHRoOiAxMDAlOwoJaGVpZ2h0OiAxMDAlOwoJYmFja2dyb3VuZC1pbWFnZTogOwoJYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdDsKCWJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlciB0b3A7Cn0KLmVzLXdyYXBwZXItY29sb3IgewoJYmFja2dyb3VuZC1jb2xvcjogI2Y2ZjZmNjsKfQouZXMtY29udGVudC1ib2R5IHsKCWJhY2tncm91bmQtY29sb3I6ICNmZmZmZmY7Cn0KLmVzLWNvbnRlbnQtYm9keSBwLAouZXMtY29udGVudC1ib2R5IHVsIGxpLAouZXMtY29udGVudC1ib2R5IG9sIGxpIHsKCWNvbG9yOiAjMzMzMzMzOwp9Ci5lcy1jb250ZW50LWJvZHkgYSB7Cgljb2xvcjogIzEzNzZjODsKfQouZXMtaGVhZGVyIHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OwoJYmFja2dyb3VuZC1pbWFnZTogOwoJYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdDsKCWJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlciB0b3A7Cn0KLmVzLWhlYWRlci1ib2R5IHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50Owp9Ci5lcy1oZWFkZXItYm9keSBwLAouZXMtaGVhZGVyLWJvZHkgdWwgbGksCi5lcy1oZWFkZXItYm9keSBvbCBsaSB7Cgljb2xvcjogIzMzMzMzMzsKCWZvbnQtc2l6ZTogMTRweDsKfQouZXMtaGVhZGVyLWJvZHkgYSB7Cgljb2xvcjogIzEzNzZjODsKCWZvbnQtc2l6ZTogMTRweDsKfQouZXMtZm9vdGVyIHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50OwoJYmFja2dyb3VuZC1pbWFnZTogOwoJYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdDsKCWJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlciB0b3A7Cn0KLmVzLWZvb3Rlci1ib2R5IHsKCWJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50Owp9Ci5lcy1mb290ZXItYm9keSBwLAouZXMtZm9vdGVyLWJvZHkgdWwgbGksCi5lcy1mb290ZXItYm9keSBvbCBsaSB7Cgljb2xvcjogIzMzMzMzMzsKCWZvbnQtc2l6ZTogMTFweDsKfQouZXMtZm9vdGVyLWJvZHkgYSB7Cgljb2xvcjogIzEzNzZjODsKCWZvbnQtc2l6ZTogMTFweDsKfQouZXMtaW5mb2Jsb2NrLAouZXMtaW5mb2Jsb2NrIHAsCi5lcy1pbmZvYmxvY2sgdWwgbGksCi5lcy1pbmZvYmxvY2sgb2wgbGkgewoJbGluZS1oZWlnaHQ6IDEyMCU7Cglmb250LXNpemU6IDEycHg7Cgljb2xvcjogI2NjY2NjYzsKfQouZXMtaW5mb2Jsb2NrIGEgewoJZm9udC1zaXplOiAxMnB4OwoJY29sb3I6ICMyY2I1NDM7Cn0KYS5lcy1idXR0b24gewoJYm9yZGVyLXN0eWxlOiBzb2xpZDsKCWJvcmRlci1jb2xvcjogIzMxY2I0YjsKCWJvcmRlci13aWR0aDogMTBweCAyMHB4IDEwcHggMjBweDsKCWRpc3BsYXk6IGlubGluZS1ibG9jazsKCWJhY2tncm91bmQ6ICMzMWNiNGI7Cglib3JkZXItcmFkaXVzOiAzMHB4OwoJZm9udC1zaXplOiAxOHB4OwoJZm9udC1mYW1pbHk6IGFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7Cglmb250LXdlaWdodDogbm9ybWFsOwoJZm9udC1zdHlsZTogbm9ybWFsOwoJbGluZS1oZWlnaHQ6IDEyMCU7Cgljb2xvcjogI2ZmZmZmZjsKCXRleHQtZGVjb3JhdGlvbjogbm9uZSAhaW1wb3J0YW50OwoJd2lkdGg6IGF1dG87Cgl0ZXh0LWFsaWduOiBjZW50ZXI7Cn0KLmVzLWJ1dHRvbi1ib3JkZXIgewoJYm9yZGVyLXN0eWxlOiBzb2xpZCBzb2xpZCBzb2xpZCBzb2xpZDsKCWJvcmRlci1jb2xvcjogIzJjYjU0MyAjMmNiNTQzICMyY2I1NDMgIzJjYjU0MzsKCWJhY2tncm91bmQ6ICMyY2I1NDM7Cglib3JkZXItd2lkdGg6IDBweCAwcHggMnB4IDBweDsKCWRpc3BsYXk6IGlubGluZS1ibG9jazsKCWJvcmRlci1yYWRpdXM6IDMwcHg7Cgl3aWR0aDogYXV0bzsKfQovKgpSRVNQT05TSVZFIFNUWUxFUwpQbGVhc2UgZG8gbm90IGRlbGV0ZSBhbmQgZWRpdCBDU1Mgc3R5bGVzIGJlbG93LgogCklmIHlvdSBkb24ndCBuZWVkIHJlc3BvbnNpdmUgbGF5b3V0LCBwbGVhc2UgZGVsZXRlIHRoaXMgc2VjdGlvbi4KKi8KQG1lZGlhIG9ubHkgc2NyZWVuIGFuZCAobWF4LXdpZHRoOiA2MDBweCkgewoJcCwKICAgIHVsIGxpLAogICAgb2wgbGksCiAgICBhIHsKCQlmb250LXNpemU6IDE2cHggIWltcG9ydGFudDsKCX0KCWgxIHsKCQlmb250LXNpemU6IDMwcHggIWltcG9ydGFudDsKCQl0ZXh0LWFsaWduOiBjZW50ZXI7Cgl9CgloMiB7CgkJZm9udC1zaXplOiAyNnB4ICFpbXBvcnRhbnQ7CgkJdGV4dC1hbGlnbjogY2VudGVyOwoJfQoJaDMgewoJCWZvbnQtc2l6ZTogMjBweCAhaW1wb3J0YW50OwoJCXRleHQtYWxpZ246IGNlbnRlcjsKCX0KCWgxIGEgewoJCWZvbnQtc2l6ZTogMzBweCAhaW1wb3J0YW50OwoJfQoJaDIgYSB7CgkJZm9udC1zaXplOiAyNnB4ICFpbXBvcnRhbnQ7Cgl9CgloMyBhIHsKCQlmb250LXNpemU6IDIwcHggIWltcG9ydGFudDsKCX0KCS5lcy1tZW51IHRkIGEgewoJCWZvbnQtc2l6ZTogMTZweCAhaW1wb3J0YW50OwoJfQoJLmVzLWhlYWRlci1ib2R5IHAsCiAgICAuZXMtaGVhZGVyLWJvZHkgdWwgbGksCiAgICAuZXMtaGVhZGVyLWJvZHkgb2wgbGksCiAgICAuZXMtaGVhZGVyLWJvZHkgYSB7CgkJZm9udC1zaXplOiAxNnB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtZm9vdGVyLWJvZHkgcCwKICAgIC5lcy1mb290ZXItYm9keSB1bCBsaSwKICAgIC5lcy1mb290ZXItYm9keSBvbCBsaSwKICAgIC5lcy1mb290ZXItYm9keSBhIHsKCQlmb250LXNpemU6IDE2cHggIWltcG9ydGFudDsKCX0KCS5lcy1pbmZvYmxvY2sgcCwKICAgIC5lcy1pbmZvYmxvY2sgdWwgbGksCiAgICAuZXMtaW5mb2Jsb2NrIG9sIGxpLAogICAgLmVzLWluZm9ibG9jayBhIHsKCQlmb250LXNpemU6IDEycHggIWltcG9ydGFudDsKCX0KCSpbY2xhc3M9ImdtYWlsLWZpeCJdIHsKCQlkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS10eHQtYywKICAgIC5lcy1tLXR4dC1jIGgxLAogICAgLmVzLW0tdHh0LWMgaDIsCiAgICAuZXMtbS10eHQtYyBoMyB7CgkJdGV4dC1hbGlnbjogY2VudGVyICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS10eHQtciwKICAgIC5lcy1tLXR4dC1yIGgxLAogICAgLmVzLW0tdHh0LXIgaDIsCiAgICAuZXMtbS10eHQtciBoMyB7CgkJdGV4dC1hbGlnbjogcmlnaHQgIWltcG9ydGFudDsKCX0KCS5lcy1tLXR4dC1sLAogICAgLmVzLW0tdHh0LWwgaDEsCiAgICAuZXMtbS10eHQtbCBoMiwKICAgIC5lcy1tLXR4dC1sIGgzIHsKCQl0ZXh0LWFsaWduOiBsZWZ0ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS10eHQtciBhIGltZywKICAgIC5lcy1tLXR4dC1jIGEgaW1nLAogICAgLmVzLW0tdHh0LWwgYSBpbWcgewoJCWRpc3BsYXk6IGlubGluZSAhaW1wb3J0YW50OwoJfQoJLmVzLWJ1dHRvbi1ib3JkZXIgewoJCWRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7Cgl9CgkuZXMtYnV0dG9uIHsKCQlmb250LXNpemU6IDIwcHggIWltcG9ydGFudDsKCQlkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50OwoJCWJvcmRlci13aWR0aDogMTBweCAwcHggMTBweCAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1idG4tZncgewoJCWJvcmRlci13aWR0aDogMTBweCAwcHggIWltcG9ydGFudDsKCQl0ZXh0LWFsaWduOiBjZW50ZXIgIWltcG9ydGFudDsKCX0KCS5lcy1hZGFwdGl2ZSB0YWJsZSwKICAgIC5lcy1idG4tZncsCiAgICAuZXMtYnRuLWZ3LWJyZHIsCiAgICAuZXMtbGVmdCwKICAgIC5lcy1yaWdodCB7CgkJd2lkdGg6IDEwMCUgIWltcG9ydGFudDsKCX0KCS5lcy1jb250ZW50IHRhYmxlLAogICAgLmVzLWhlYWRlciB0YWJsZSwKICAgIC5lcy1mb290ZXIgdGFibGUsCiAgICAuZXMtY29udGVudCwKICAgIC5lcy1mb290ZXIsCiAgICAuZXMtaGVhZGVyIHsKCQl3aWR0aDogMTAwJSAhaW1wb3J0YW50OwoJCW1heC13aWR0aDogNjAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1hZGFwdC10ZCB7CgkJZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDsKCQl3aWR0aDogMTAwJSAhaW1wb3J0YW50OwoJfQoJLmFkYXB0LWltZyB7CgkJd2lkdGg6IDEwMCUgIWltcG9ydGFudDsKCQloZWlnaHQ6IGF1dG8gIWltcG9ydGFudDsKCX0KCS5lcy1tLXAwIHsKCQlwYWRkaW5nOiAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1tLXAwciB7CgkJcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS1wMGwgewoJCXBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbS1wMHQgewoJCXBhZGRpbmctdG9wOiAwcHggIWltcG9ydGFudDsKCX0KCS5lcy1tLXAwYiB7CgkJcGFkZGluZy1ib3R0b206IDAgIWltcG9ydGFudDsKCX0KCS5lcy1tLXAyMGIgewoJCXBhZGRpbmctYm90dG9tOiAyMHB4ICFpbXBvcnRhbnQ7Cgl9CgkuZXMtbW9iaWxlLWhpZGRlbiwKICAgIAkuZXMtaGlkZGVuIHsKICAgICAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7CiAgICAJfQogICAgCS5lcy1kZXNrLWhpZGRlbiB7CiAgICAgICAgZGlzcGxheTogdGFibGUtcm93IWltcG9ydGFudDsKICAgICAgICB3aWR0aDogYXV0byFpbXBvcnRhbnQ7CiAgICAgICAgb3ZlcmZsb3c6IHZpc2libGUhaW1wb3J0YW50OwogICAgICAgIGZsb2F0OiBub25lIWltcG9ydGFudDsKICAgICAgICBtYXgtaGVpZ2h0OiBpbmhlcml0IWltcG9ydGFudDsKICAgICAgICBsaW5lLWhlaWdodDogaW5oZXJpdCFpbXBvcnRhbnQ7CiAgICAJfQogICAgCS5lcy1kZXNrLW1lbnUtaGlkZGVuIHsKICAgICAgICBkaXNwbGF5OiB0YWJsZS1jZWxsIWltcG9ydGFudDsKICAgIAl9Cgl0YWJsZS5lcy10YWJsZS1ub3QtYWRhcHQsCiAgICAJLmVzZC1ibG9jay1odG1sIHRhYmxlIHsKCQl3aWR0aDogYXV0byAhaW1wb3J0YW50OwoJfQoJdGFibGUuZXMtc29jaWFsIHsKCQlkaXNwbGF5OiBpbmxpbmUtYmxvY2sgIWltcG9ydGFudDsKCX0KCXRhYmxlLmVzLXNvY2lhbCB0ZCB7CgkJZGlzcGxheTogaW5saW5lLWJsb2NrICFpbXBvcnRhbnQ7Cgl9Cn0KLyoKRU5EIFJFU1BPTlNJVkUgU1RZTEVTCiovCgo=';

        $compliled = 'PCFET0NUWVBFIGh0bWwgUFVCTElDICItLy9XM0MvL0RURCBYSFRNTCAxLjAgVHJhbnNpdGlvbmFsLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL1RSL3hodG1sMS9EVEQveGh0bWwxLXRyYW5zaXRpb25hbC5kdGQiPjxodG1sIHN0eWxlPSJ3aWR0aDoxMDAlO2ZvbnQtZmFtaWx5OmFyaWFsLCAnaGVsdmV0aWNhIG5ldWUnLCBoZWx2ZXRpY2EsIHNhbnMtc2VyaWY7LXdlYmtpdC10ZXh0LXNpemUtYWRqdXN0OjEwMCU7LW1zLXRleHQtc2l6ZS1hZGp1c3Q6MTAwJTtwYWRkaW5nOjA7TWFyZ2luOjA7Ij4gPGhlYWQ+IDxtZXRhIGNoYXJzZXQ9IlVURi04Ij4gPG1ldGEgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEiIG5hbWU9InZpZXdwb3J0Ij4gPG1ldGEgbmFtZT0ieC1hcHBsZS1kaXNhYmxlLW1lc3NhZ2UtcmVmb3JtYXR0aW5nIj4gPG1ldGEgaHR0cC1lcXVpdj0iWC1VQS1Db21wYXRpYmxlIiBjb250ZW50PSJJRT1lZGdlIj4gPG1ldGEgY29udGVudD0idGVsZXBob25lPW5vIiBuYW1lPSJmb3JtYXQtZGV0ZWN0aW9uIj4gPHRpdGxlPjwvdGl0bGU+IDwhLS1baWYgKG1zbyAxNildPiA8c3R5bGUgdHlwZT0idGV4dC9jc3MiPiBhIHt0ZXh0LWRlY29yYXRpb246IG5vbmU7fSA8L3N0eWxlPiA8IVtlbmRpZl0tLT4gPCEtLVtpZiBndGUgbXNvIDldPjxzdHlsZT5zdXAgeyBmb250LXNpemU6IDEwMCUgIWltcG9ydGFudDsgfTwvc3R5bGU+PCFbZW5kaWZdLS0+IDxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+QG1lZGlhIG9ubHkgc2NyZWVuIGFuZCAobWF4LXdpZHRoOjYwMHB4KSB7cCwgdWwgbGksIG9sIGxpLCBhIHsgZm9udC1zaXplOjE2cHghaW1wb3J0YW50IH0gaDEgeyBmb250LXNpemU6MzBweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIH0gaDIgeyBmb250LXNpemU6MjZweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIH0gaDMgeyBmb250LXNpemU6MjBweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIH0gaDEgYSB7IGZvbnQtc2l6ZTozMHB4IWltcG9ydGFudCB9IGgyIGEgeyBmb250LXNpemU6MjZweCFpbXBvcnRhbnQgfSBoMyBhIHsgZm9udC1zaXplOjIwcHghaW1wb3J0YW50IH0gLmVzLW1lbnUgdGQgYSB7IGZvbnQtc2l6ZToxNnB4IWltcG9ydGFudCB9IC5lcy1oZWFkZXItYm9keSBwLCAuZXMtaGVhZGVyLWJvZHkgdWwgbGksIC5lcy1oZWFkZXItYm9keSBvbCBsaSwgLmVzLWhlYWRlci1ib2R5IGEgeyBmb250LXNpemU6MTZweCFpbXBvcnRhbnQgfSAuZXMtZm9vdGVyLWJvZHkgcCwgLmVzLWZvb3Rlci1ib2R5IHVsIGxpLCAuZXMtZm9vdGVyLWJvZHkgb2wgbGksIC5lcy1mb290ZXItYm9keSBhIHsgZm9udC1zaXplOjE2cHghaW1wb3J0YW50IH0gLmVzLWluZm9ibG9jayBwLCAuZXMtaW5mb2Jsb2NrIHVsIGxpLCAuZXMtaW5mb2Jsb2NrIG9sIGxpLCAuZXMtaW5mb2Jsb2NrIGEgeyBmb250LXNpemU6MTJweCFpbXBvcnRhbnQgfSAqW2NsYXNzPSJnbWFpbC1maXgiXSB7IGRpc3BsYXk6bm9uZSFpbXBvcnRhbnQgfSAuZXMtbS10eHQtYywgLmVzLW0tdHh0LWMgaDEsIC5lcy1tLXR4dC1jIGgyLCAuZXMtbS10eHQtYyBoMyB7IHRleHQtYWxpZ246Y2VudGVyIWltcG9ydGFudCB9IC5lcy1tLXR4dC1yLCAuZXMtbS10eHQtciBoMSwgLmVzLW0tdHh0LXIgaDIsIC5lcy1tLXR4dC1yIGgzIHsgdGV4dC1hbGlnbjpyaWdodCFpbXBvcnRhbnQgfSAuZXMtbS10eHQtbCwgLmVzLW0tdHh0LWwgaDEsIC5lcy1tLXR4dC1sIGgyLCAuZXMtbS10eHQtbCBoMyB7IHRleHQtYWxpZ246bGVmdCFpbXBvcnRhbnQgfSAuZXMtbS10eHQtciBhIGltZywgLmVzLW0tdHh0LWMgYSBpbWcsIC5lcy1tLXR4dC1sIGEgaW1nIHsgZGlzcGxheTppbmxpbmUhaW1wb3J0YW50IH0gLmVzLWJ1dHRvbi1ib3JkZXIgeyBkaXNwbGF5OmJsb2NrIWltcG9ydGFudCB9IC5lcy1idXR0b24geyBmb250LXNpemU6MjBweCFpbXBvcnRhbnQ7IGRpc3BsYXk6YmxvY2shaW1wb3J0YW50OyBib3JkZXItd2lkdGg6MTBweCAwcHggMTBweCAwcHghaW1wb3J0YW50IH0gLmVzLWJ0bi1mdyB7IGJvcmRlci13aWR0aDoxMHB4IDBweCFpbXBvcnRhbnQ7IHRleHQtYWxpZ246Y2VudGVyIWltcG9ydGFudCB9IC5lcy1hZGFwdGl2ZSB0YWJsZSwgLmVzLWJ0bi1mdywgLmVzLWJ0bi1mdy1icmRyLCAuZXMtbGVmdCwgLmVzLXJpZ2h0IHsgd2lkdGg6MTAwJSFpbXBvcnRhbnQgfSAuZXMtY29udGVudCB0YWJsZSwgLmVzLWhlYWRlciB0YWJsZSwgLmVzLWZvb3RlciB0YWJsZSwgLmVzLWNvbnRlbnQsIC5lcy1mb290ZXIsIC5lcy1oZWFkZXIgeyB3aWR0aDoxMDAlIWltcG9ydGFudDsgbWF4LXdpZHRoOjYwMHB4IWltcG9ydGFudCB9IC5lcy1hZGFwdC10ZCB7IGRpc3BsYXk6YmxvY2shaW1wb3J0YW50OyB3aWR0aDoxMDAlIWltcG9ydGFudCB9IC5hZGFwdC1pbWcgeyB3aWR0aDoxMDAlIWltcG9ydGFudDsgaGVpZ2h0OmF1dG8haW1wb3J0YW50IH0gLmVzLW0tcDAgeyBwYWRkaW5nOjBweCFpbXBvcnRhbnQgfSAuZXMtbS1wMHIgeyBwYWRkaW5nLXJpZ2h0OjBweCFpbXBvcnRhbnQgfSAuZXMtbS1wMGwgeyBwYWRkaW5nLWxlZnQ6MHB4IWltcG9ydGFudCB9IC5lcy1tLXAwdCB7IHBhZGRpbmctdG9wOjBweCFpbXBvcnRhbnQgfSAuZXMtbS1wMGIgeyBwYWRkaW5nLWJvdHRvbTowIWltcG9ydGFudCB9IC5lcy1tLXAyMGIgeyBwYWRkaW5nLWJvdHRvbToyMHB4IWltcG9ydGFudCB9IC5lcy1tb2JpbGUtaGlkZGVuLCAuZXMtaGlkZGVuIHsgZGlzcGxheTpub25lIWltcG9ydGFudCB9IC5lcy1kZXNrLWhpZGRlbiB7IGRpc3BsYXk6dGFibGUtcm93IWltcG9ydGFudDsgd2lkdGg6YXV0byFpbXBvcnRhbnQ7IG92ZXJmbG93OnZpc2libGUhaW1wb3J0YW50OyBmbG9hdDpub25lIWltcG9ydGFudDsgbWF4LWhlaWdodDppbmhlcml0IWltcG9ydGFudDsgbGluZS1oZWlnaHQ6aW5oZXJpdCFpbXBvcnRhbnQgfSAuZXMtZGVzay1tZW51LWhpZGRlbiB7IGRpc3BsYXk6dGFibGUtY2VsbCFpbXBvcnRhbnQgfSB0YWJsZS5lcy10YWJsZS1ub3QtYWRhcHQsIC5lc2QtYmxvY2staHRtbCB0YWJsZSB7IHdpZHRoOmF1dG8haW1wb3J0YW50IH0gdGFibGUuZXMtc29jaWFsIHsgZGlzcGxheTppbmxpbmUtYmxvY2shaW1wb3J0YW50IH0gdGFibGUuZXMtc29jaWFsIHRkIHsgZGlzcGxheTppbmxpbmUtYmxvY2shaW1wb3J0YW50IH0gfSNvdXRsb29rIGEgewlwYWRkaW5nOjA7fS5FeHRlcm5hbENsYXNzIHsJd2lkdGg6MTAwJTt9LkV4dGVybmFsQ2xhc3MsLkV4dGVybmFsQ2xhc3MgcCwuRXh0ZXJuYWxDbGFzcyBzcGFuLC5FeHRlcm5hbENsYXNzIGZvbnQsLkV4dGVybmFsQ2xhc3MgdGQsLkV4dGVybmFsQ2xhc3MgZGl2IHsJbGluZS1oZWlnaHQ6MTAwJTt9LmVzLWJ1dHRvbiB7CW1zby1zdHlsZS1wcmlvcml0eToxMDAhaW1wb3J0YW50Owl0ZXh0LWRlY29yYXRpb246bm9uZSFpbXBvcnRhbnQ7fWFbeC1hcHBsZS1kYXRhLWRldGVjdG9yc10gewljb2xvcjppbmhlcml0IWltcG9ydGFudDsJdGV4dC1kZWNvcmF0aW9uOm5vbmUhaW1wb3J0YW50Owlmb250LXNpemU6aW5oZXJpdCFpbXBvcnRhbnQ7CWZvbnQtZmFtaWx5OmluaGVyaXQhaW1wb3J0YW50Owlmb250LXdlaWdodDppbmhlcml0IWltcG9ydGFudDsJbGluZS1oZWlnaHQ6aW5oZXJpdCFpbXBvcnRhbnQ7fS5lcy1kZXNrLWhpZGRlbiB7IGRpc3BsYXk6bm9uZTsgZmxvYXQ6bGVmdDsgb3ZlcmZsb3c6aGlkZGVuOyB3aWR0aDowOyBtYXgtaGVpZ2h0OjA7IGxpbmUtaGVpZ2h0OjA7IG1zby1oaWRlOmFsbDt9PC9zdHlsZT4gPC9oZWFkPiA8Ym9keSBzdHlsZT0id2lkdGg6MTAwJTtmb250LWZhbWlseTphcmlhbCwgJ2hlbHZldGljYSBuZXVlJywgaGVsdmV0aWNhLCBzYW5zLXNlcmlmOy13ZWJraXQtdGV4dC1zaXplLWFkanVzdDoxMDAlOy1tcy10ZXh0LXNpemUtYWRqdXN0OjEwMCU7cGFkZGluZzowO01hcmdpbjowO2Rpc3BsYXk6YmxvY2s7Ij4gPGRpdiBjbGFzcz0iZXMtd3JhcHBlci1jb2xvciIgc3R5bGU9ImJhY2tncm91bmQtY29sb3I6I0Y2RjZGNjsiPiA8IS0tW2lmIGd0ZSBtc28gOV0+CQkJPHY6YmFja2dyb3VuZCB4bWxuczp2PSJ1cm46c2NoZW1hcy1taWNyb3NvZnQtY29tOnZtbCIgZmlsbD0idCI+CQkJCTx2OmZpbGwgdHlwZT0idGlsZSIgc3JjPSIiIGNvbG9yPSIjZjZmNmY2Ij48L3Y6ZmlsbD4JCQk8L3Y6YmFja2dyb3VuZD4JCTwhW2VuZGlmXS0tPiA8dGFibGUgY2xhc3M9ImVzLXdyYXBwZXIiIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4O3BhZGRpbmc6MDtNYXJnaW46MDt3aWR0aDoxMDAlO2hlaWdodDoxMDAlO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdDtiYWNrZ3JvdW5kLXBvc2l0aW9uOmNlbnRlciB0b3A7Ij4gIDx0ciBzdHlsZT0iYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlOyI+IDx0ZCB2YWxpZ249InRvcCIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDsiPiA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgYWxpZ249ImNlbnRlciIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7dGFibGUtbGF5b3V0OmZpeGVkICFpbXBvcnRhbnQ7d2lkdGg6MTAwJTsiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7Ij4gPHRhYmxlIGNsYXNzPSJlcy1jb250ZW50LWJvZHkiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4O2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7IiB3aWR0aD0iNjAwIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJjZW50ZXIiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGFsaWduPSJsZWZ0IiBzdHlsZT0iTWFyZ2luOjA7cGFkZGluZy10b3A6MjBweDtwYWRkaW5nLWJvdHRvbToyMHB4O3BhZGRpbmctbGVmdDoyMHB4O3BhZGRpbmctcmlnaHQ6MjBweDsiPiA8IS0tW2lmIG1zb10+PHRhYmxlIHdpZHRoPSI1NjAiIGNlbGxwYWRkaW5nPSIwIiBjZWxsc3BhY2luZz0iMCI+PHRyPjx0ZCB3aWR0aD0iMzU2IiB2YWxpZ249InRvcCI+PCFbZW5kaWZdLS0+IDx0YWJsZSBjbGFzcz0iZXMtbGVmdCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0ibGVmdCIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7ZmxvYXQ6bGVmdDsiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGNsYXNzPSJlcy1tLXAwciBlcy1tLXAyMGIiIHdpZHRoPSIzNTYiIHZhbGlnbj0idG9wIiBhbGlnbj0iY2VudGVyIiBzdHlsZT0icGFkZGluZzowO01hcmdpbjowOyI+IDx0YWJsZSB3aWR0aD0iMTAwJSIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBzdHlsZT0ibXNvLXRhYmxlLWxzcGFjZTowcHQ7bXNvLXRhYmxlLXJzcGFjZTowcHQ7Ym9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO2JvcmRlci1zcGFjaW5nOjBweDsiPiAgPHRyIHN0eWxlPSJib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ij4gPHRkIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7ZGlzcGxheTpub25lOyI+PC90ZD4gPC90cj4gIDwvdGFibGU+IDwvdGQ+IDwvdHI+ICA8L3RhYmxlPiA8IS0tW2lmIG1zb10+PC90ZD48dGQgd2lkdGg9IjIwIj48L3RkPjx0ZCB3aWR0aD0iMTg0IiB2YWxpZ249InRvcCI+PCFbZW5kaWZdLS0+IDx0YWJsZSBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIGFsaWduPSJyaWdodCIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7Ij4gIDx0ciBzdHlsZT0iYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlOyI+IDx0ZCB3aWR0aD0iMTg0IiBhbGlnbj0ibGVmdCIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDsiPiA8dGFibGUgd2lkdGg9IjEwMCUiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7Ij4gIDx0ciBzdHlsZT0iYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlOyI+IDx0ZCBhbGlnbj0iY2VudGVyIiBzdHlsZT0icGFkZGluZzowO01hcmdpbjowO2Rpc3BsYXk6bm9uZTsiPjwvdGQ+IDwvdHI+ICA8L3RhYmxlPiA8L3RkPiA8L3RyPiAgPC90YWJsZT4gPCEtLVtpZiBtc29dPjwvdGQ+PC90cj48L3RhYmxlPjwhW2VuZGlmXS0tPiA8L3RkPiA8L3RyPiAgPC90YWJsZT4gPC90ZD4gPC90cj4gIDwvdGFibGU+IDx0YWJsZSBjbGFzcz0iZXMtY29udGVudCIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIwIiBhbGlnbj0iY2VudGVyIiBzdHlsZT0ibXNvLXRhYmxlLWxzcGFjZTowcHQ7bXNvLXRhYmxlLXJzcGFjZTowcHQ7Ym9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO2JvcmRlci1zcGFjaW5nOjBweDt0YWJsZS1sYXlvdXQ6Zml4ZWQgIWltcG9ydGFudDt3aWR0aDoxMDAlOyI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgYWxpZ249ImNlbnRlciIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDsiPiA8dGFibGUgY2xhc3M9ImVzLWNvbnRlbnQtYm9keSIgc3R5bGU9Im1zby10YWJsZS1sc3BhY2U6MHB0O21zby10YWJsZS1yc3BhY2U6MHB0O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowcHg7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDsiIHdpZHRoPSI2MDAiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgYWxpZ249ImNlbnRlciI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgYWxpZ249ImxlZnQiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7cGFkZGluZy1sZWZ0OjIwcHg7cGFkZGluZy1yaWdodDoyMHB4O3BhZGRpbmctYm90dG9tOjMwcHg7Ij4gPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4OyI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgd2lkdGg9IjU2MCIgdmFsaWduPSJ0b3AiIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nOjA7TWFyZ2luOjA7Ij4gPHRhYmxlIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjAiIHN0eWxlPSJtc28tdGFibGUtbHNwYWNlOjBwdDttc28tdGFibGUtcnNwYWNlOjBwdDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MHB4OyI+ICA8dHIgc3R5bGU9ImJvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTsiPiA8dGQgYWxpZ249ImNlbnRlciIgc3R5bGU9InBhZGRpbmc6MDtNYXJnaW46MDtkaXNwbGF5Om5vbmU7Ij48L3RkPiA8L3RyPiAgPC90YWJsZT4gPC90ZD4gPC90cj4gIDwvdGFibGU+IDwvdGQ+IDwvdHI+ICA8L3RhYmxlPiA8L3RkPiA8L3RyPiAgPC90YWJsZT4gPC90ZD4gPC90cj4gIDwvdGFibGU+IDwvZGl2PiA8L2JvZHk+PC9odG1sPg==';

        return array('html' => $html, 'css' => $css, 'compiled' => $compliled);
    }

    /**
     * Used to get Referral Campaign Info
     */
    public function getReferralUnitInfo($id, $hash = false) {

        $this->db->select("tbl_referral_rewards.*, tbl_referral_rewards.id AS rewardID, tbl_referral_rewards.created AS rewardCreated,"
                . "tbl_referral_rewards_adv_coupons.*, tbl_referral_rewards_adv_coupons.id AS advCouponID, tbl_referral_rewards_adv_coupons.created AS advCouponCreated,"
                . "tbl_referral_rewards_ref_coupons.*, tbl_referral_rewards_ref_coupons.id AS refCouponID, tbl_referral_rewards_ref_coupons.created AS refCouponCreated,"
                . "tbl_referral_rewards_cash.*, tbl_referral_rewards_cash.id AS cashID, tbl_referral_rewards_cash.created AS cashCreated,"
                . "tbl_referral_rewards_custom.*, tbl_referral_rewards_custom.id AS customID, tbl_referral_rewards_custom.created AS customCreated,"
                . "tbl_referral_rewards_promo_links.*, tbl_referral_rewards_promo_links.id AS promoID, tbl_referral_rewards_promo_links.created AS promoCreated");
        $this->db->join("tbl_referral_rewards_adv_coupons", "tbl_referral_rewards_adv_coupons.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_ref_coupons", "tbl_referral_rewards_ref_coupons.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_cash", "tbl_referral_rewards_cash.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_custom", "tbl_referral_rewards_custom.reward_id = tbl_referral_rewards.id", "LEFT");
        $this->db->join("tbl_referral_rewards_promo_links", "tbl_referral_rewards_promo_links.reward_id = tbl_referral_rewards.id", "LEFT");
        if ($hash == true) {
            $this->db->where("tbl_referral_rewards.hashcode", $id);
        } else {
            $this->db->where("tbl_referral_rewards.id", $id);
        }


        $result = $this->db->get("tbl_referral_rewards");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    /**
     * Replaces all the tags of the referral module
     */
    public function referralEmailTagReplace($referralID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        $aTags = $this->config->item('email_tags');

        $oReferral = $oRewardSettings = $this->getReferralUnitInfo($referralID);


        $accountID = $oReferral->hashcode;

        if (!empty($referralID)) {
            $aSettings = $mWorkflow->getReferralSettingsInfo($referralID);
        }

        if (!empty($subscriberInfo)) {
            $advocateID = $subscriberInfo->advocateID;
            if ($advocateID > 0) {
                $oRefLink = $mWorkflow->getReferralLink($advocateID);
                $refKey = $oRefLink->refkey;
                $refLink = site_url() . 'ref/t/' . $refKey;
            }

            $refLink = (!empty($refKey)) ? $refKey : '{Referral_Link}';
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
                    case '{ADVOCATE_REWARD}':
                        if (!empty($accountID)) {
                            //Get Advocate related reward details
                            if (!empty($oRewardSettings->cash_id)) {
                                $advTagline = 'get ' . $oRewardSettings->display_msg;
                            } else if (!empty($oRewardSettings->custom_id)) {
                                $advTagline = 'get ' . $oRewardSettings->reward_title;
                            } else if (!empty($oRewardSettings->adv_coupon_id)) {
                                $advTagline = 'get ' . $oRewardSettings->advocate_display_msg;
                            }

                            if (!empty($advTagline)) {
                                $htmlData = 'Refer your friends and ' . $advTagline;
                            }
                        }


                        break;
                    case '{FRIEND_REWARD}':
                        if (!empty($accountID)) {

                            //Get Referred friend related reward details
                            if (!empty($oRewardSettings->promo_id)) {
                                $refTagline = 'Give your friend ' . $oRewardSettings->link_desc;
                            } else if (!empty($oRewardSettings->ref_coupon_id)) {
                                $refTagline = 'Give your friend ' . $oRewardSettings->referred_display_msg;
                            }
                            if (!empty($refTagline)) {
                                $htmlData = $refTagline;
                            }
                        }

                        break;

                    case '{REFERRAL_LINK}':
                        if (strtolower($campaignType) == 'email') {
                            $htmlData = "<a href='" . $refLink . "'>" . $refLink . "</a>";
                        } else {
                            $htmlData = $refLink;
                        }
                        break;

                    case '{STORE_NAME}':
                        $htmlData = $aSettings->store_name;
                        break;

                    case '{STORE_URL}':
                        $htmlData = $aSettings->store_url;
                        break;

                    case '{STORE_EMAIL}':
                        $htmlData = $aSettings->store_email;
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
     * Replaces all the tags of the brandboost campaigns
     */
    public function brandboostEmailTagReplace($brandboostID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        $oBrandboost = $mWorkflow->getModuleUnitInfo('brandboost', $brandboostID);
        $productsDetails = $mWorkflow->getProductDataByBBID($brandboostID);
        if ($oBrandboost->review_type == 'offsite') {
            $aOffsiteUrls = unserialize($oBrandboost->offsites_links);
            $random_keys = array_rand($aOffsiteUrls, 1);
            $offsiteURL = $aOffsiteUrls[$random_keys];
        }


        $aTags = $this->config->item('email_tags');
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
                        $htmlData = $offsiteURL['shorturl'];
                        break;

                    case '{BRAND_NAME}':
                        $htmlData = $oBrandboost->brand_title;
                        break;

                    case '{PRODUCTS_LIST}':
                        $htmlData = $this->load->view("admin/workflow/partials/products_list", $productsDetails, true);
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

    /**
     * Used to load Workflow Email Stats
     * @param Request $request
     */
    public function loadWorkflowEmailStats(Request $request) {
        $response = array();
        $response['status'] = "Error";
        $campaignID = strip_tags($request->campaign_id);
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitId);
        $eventId = strip_tags($request->eventId);
        $request->campaignId = $campaignID;
        $request->moduleName = $moduleName;
        $request->moduleUnitId = $moduleUnitID;
        $request->returnMethod = 'return';
        
        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();
        
        if ($campaignID > 0 && !empty($moduleName)) {
            $oPreview = $this->previewWorkflowCampaign($request);
            $aStats = $mWorkflow->getEventSendgridStats($campaignID, $moduleName);
            $aCategorizedStats = $mWorkflow->getEventSendgridCategorizedStats($aStats);

            $processedCount = $aCategorizedStats['processed']['UniqueCount'];
            $deliveredCount = $aCategorizedStats['delivered']['UniqueCount'];
            $openCount = $aCategorizedStats['open']['UniqueCount'];
            $clickCount = $aCategorizedStats['click']['UniqueCount'];
            $unsubscribeCount = $aCategorizedStats['unsubscribe']['UniqueCount'];
            $bounceCount = $aCategorizedStats['bounce']['UniqueCount'];
            $droppedCount = $aCategorizedStats['dropped']['UniqueCount'];
            $spamReportCount = $aCategorizedStats['spam_report']['UniqueCount'];

            $processed = $processedCount == '' ? '0' : $processedCount;
            $delivered = $deliveredCount == '' ? '0' : $deliveredCount;
            $open = $openCount == '' ? '0' : $openCount;
            $click = $clickCount == '' ? '0' : $clickCount;
            $unsubscribe = $unsubscribeCount == '' ? '0' : $unsubscribeCount;
            $bounce = $bounceCount == '' ? '0' : $bounceCount;
            $dropped = $droppedCount == '' ? '0' : $droppedCount;
            $spamReport = $spamReportCount == '' ? '0' : $spamReportCount;

            $oData = array(
                'processed' => $processed,
                'delivered' => $delivered,
                'open' => $open,
                'click' => $click,
                'bounce' => $bounce,
                'dropped' => $dropped,
                'unsubscribe' => $unsubscribe,
                'spamReport' => $spamReport,
                'moduleName' => $moduleName,
                'moduleUnitID' => $moduleUnitID,
                'eventID' => $eventId
            );

            $htmlStats = view('admin.workflow.partials.email_stats', $oData)->render();
            $response['status'] = 'success';
            $response['stats'] = $htmlStats;
            $response['oPreview'] = $oPreview;
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to load Workflow Sms Stats
     * @param Request $request
     */
    public function loadWorkflowSMSStats(Request $request) {
        $response = array();
        $response['status'] = "Error";
        $campaignID = strip_tags($request->campaign_id);
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitId);
        $eventId = strip_tags($request->eventId);
        $_POST['campaignId'] = $campaignID;
        $_POST['moduleName'] = $moduleName;
        $_POST['moduleUnitId'] = $moduleUnitID;
        $_POST['returnMethod'] = 'return';
        if ($campaignID > 0 && !empty($moduleName)) {
            $oPreview = $this->previewWorkflowCampaign($_POST);
            $aStatsSms = $mWorkflow->getEventTwilioStats($oCampaign->id, $moduleName);
            $aCategorizedStatsSms = $mWorkflow->getEventTwilioCategorizedStats($aStatsSms);

            $sentSmsCount = $aCategorizedStatsSms['sent']['UniqueCount'];
            $deliveredSmsCount = $aCategorizedStatsSms['delivered']['UniqueCount'];
            $acceptedSmsCount = $aCategorizedStatsSms['accepted']['UniqueCount'];
            $failedSmsCount = $aCategorizedStatsSms['failed']['UniqueCount'];
            $queuedSmsCount = $aCategorizedStatsSms['queued']['UniqueCount'];

            $sentSms = $sentSmsCount == '' ? '0' : $sentSmsCount;
            $deliveredSms = $deliveredSmsCount == '' ? '0' : $deliveredSmsCount;
            $acceptedSms = $acceptedSmsCount == '' ? '0' : $acceptedSmsCount;
            $failedSms = $failedSmsCount == '' ? '0' : $failedSmsCount;
            $queuedSms = $queuedSmsCount == '' ? '0' : $queuedSmsCount;

            $oData = array(
                'sentSms' => $sentSms,
                'deliveredSms' => $deliveredSms,
                'failedSms' => $failedSms,
                'queuedSms' => $queuedSms,
                'acceptedSms' => $acceptedSms,
                'sentSms' => $sentSms,
                'moduleName' => $moduleName,
                'moduleUnitID' => $moduleUnitID,
                'eventID' => $eventId
            );

            $htmlStats = $this->load->view("admin/workflow/partials/sms_stats", $oData, true);
            $response['status'] = 'success';
            $response['oPreview'] = $oPreview;
            $response['stats'] = $htmlStats;
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Used to load workflow Tree
     * @param Request $request
     */
    public function loadWorkflowTree(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleUnitID = strip_tags($request->moduleUnitId);
        $moduleName = strip_tags($request->moduleName);
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if ($moduleName == 'automation') {
            $this->load->model("admin/Lists_model", "mLists");
            //get Lists
            $oLists = $this->mLists->getLists($userID, '', 'active');
            //get Automation Lists
            $oAutomationLists = $this->mLists->getAutomationLists($moduleUnitID);
            $oEventsType = array('main', 'followup');
        } else if (in_array($moduleName, array('brandboost', 'onsite', 'offsite'))) {
            $oEventsType = array('send-invite', 'followup');
        } else if (in_array($moduleName, array('nps', 'referral'))) {
            $oEventsType = array('main', 'followup');
        }




        $oEvents = $mWorkflow->getWorkflowEvents($moduleUnitID, $moduleName);
        $oCampaignTags = $mWorkflow->getWorkflowCampaignTags($moduleName);

        $pageData = array(
            'oAutomationLists' => $oAutomationLists,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $moduleUnitID,
            'oEventsType' => $oEventsType,
            'oUser' => $oUser
        );

        $treeHtml = $this->load->view('admin/workflow2/loadAjaxTree', $pageData, true);
        $rightMenuHtml = $this->load->view('admin/workflow2/partials/loadAjaxMainRightMenu', $pageData, true);
        $zoomRightMenuHtml = $this->load->view('admin/workflow2/partials/loadAjaxZoomMainRightMenu', $pageData, true);
        $response = array('status' => 'success', 'content' => $treeHtml, 'menu_content' => $rightMenuHtml, 'zoom_menu_content' => $zoomRightMenuHtml, 'msg' => "Success");
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add contanct into the workflow campaign
     * @param Request $request
     */
    public function addContactToWorkflowCampaign(Request $request) {
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
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);
        
        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
//                'automation_id' => $automationID,
                'subscriber_id' => $contactId,
                'created' => date("Y-m-d H:i:s")
            );
            $mWorkflow->addContactToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteContactFromWorkflowCampaign($moduleName, $moduleUnitID, $contactId);
            $mWorkflow->deleteAudienceFromWorkflowCampaign($moduleName, $moduleUnitID, $contactId);
        }

        $oCampaignContacts = $mWorkflow->getWorkflowImportContacts($moduleName, $moduleUnitID);
        $totalContacts = count($oCampaignContacts);
        $response = array('status' => 'success', 'msg' => "Success", 'total_contacts' => $totalContacts);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add List into the workflow campaign
     * @param Request $request
     */
    public function addListToWorkflowCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $aSelectedLists = $request->selectedLists;
        $actionValue = $request->actionValue;
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);

        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        if ($actionValue == 'addRecord') {
            $mWorkflow->updateWorkflowList($moduleName, $moduleUnitID, $aSelectedLists);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteWorkflowList($moduleName, $moduleUnitID, $aSelectedLists);
            $oListSubscribers = $mWorkflow->getWorkflowCommonListContacts($userID, $aSelectedLists);
            if (!empty($oListSubscribers)) {
                foreach ($oListSubscribers as $oSubscriber) {
                    $subscriberID = $oSubscriber->subscriber_id;
                    $mWorkflow->deleteAudienceFromWorkflowCampaign($moduleName, $moduleUnitID, $subscriberID);
                }
            }
        }

        //Get Campaign list subscribers
        $oTotalSubscribers = $mWorkflow->getWorkflowImportListSubscribers($moduleName, $moduleUnitID);


        $totalSubscribers = count($oTotalSubscribers);

        //Check for duplicate records
        $duplicateCount = 0;
        $aEmails = array();
        if (!empty($oTotalSubscribers)) {
            foreach ($oTotalSubscribers as $oRec) {
                if (in_array($oRec->subscriber_email, $aEmails)) {
                    $duplicateCount++;
                }
                $aEmails[] = $oRec->subscriber_email;
            }
        }

        //Get selected lists        
        $oImportLists = $mWorkflow->getWorkflowImportLists($moduleName, $moduleUnitID);

        $response = array('status' => 'success', 'msg' => "List Added successfully!", 'total_lists' => count($oImportLists), 'total_contacts' => $totalSubscribers, 'duplicate_contacts' => $duplicateCount);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add Segment into the workflow campaign
     * @param Request $request
     */
    public function addSegmentToWorkflowCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $segmentId = strip_tags($request->segmentId);
        $actionValue = $request->actionValue;
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);

        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'segment_id' => $segmentId,
                'created' => date("Y-m-d H:i:s")
            );
            $mWorkflow->addSegmentToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteSegmentFromWorkflowCampaign($moduleName, $moduleUnitID, $segmentId);
            $oSubscribers = WorkflowModel::getWorkflowSegmentSubscribers($segmentId, $userID);
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $subscriberID = $oSubscriber->subscriber_id;
                    $mWorkflow->deleteAudienceFromWorkflowCampaign($moduleName, $moduleUnitID, $subscriberID);
                }
            }
        }
        $oCampaignSegments = $mWorkflow->getWorkflowImportSegments($moduleName, $moduleUnitID);
        $totalSegments = count($oCampaignSegments);
        $response = array('status' => 'success', 'msg' => "Success", 'total_segments' => $totalSegments);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add Tags into the workflow campaign
     * @param Request $request
     */
    public function addTagToWorkflowCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $tagId = strip_tags($request->tagId);
        $actionValue = $request->actionValue;
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);

        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();


        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'tag_id' => $tagId,
                'created' => date("Y-m-d H:i:s")
            );
            $mWorkflow->addTagToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteTagFromWorkflowCampaign($moduleName, $moduleUnitID, $tagId);
            $oTagSubscribers = WorkflowModel::getWorkflowTagSubscribers($tagId);
            if (!empty($oTagSubscribers)) {
                foreach ($oTagSubscribers as $oSubscriber) {
                    $subscriberID = $oSubscriber->id;
                    $mWorkflow->deleteAudienceFromWorkflowCampaign($moduleName, $moduleUnitID, $subscriberID);
                }
            }
        }
        $oCampaignTags = $mWorkflow->getWorkflowImportTags($moduleName, $moduleUnitID);
        $totalTags = count($oCampaignTags);
        $response = array('status' => 'success', 'msg' => "Success", 'total_tags' => $totalTags);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to exclude contact into the workflow campaign
     * @param Request $request
     */
    public function addContactToExcludeWorkflowCampaign(Request $request) {
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
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);

        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'subscriber_id' => $contactId,
                'created' => date("Y-m-d H:i:s")
            );
            $mWorkflow->addContactToExcludeCampaign($aData, $moduleName, $moduleUnitID);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteContactToExcludeCampaign($moduleName, $moduleUnitID, $contactId);
        }

        $oCampaignContacts = $mWorkflow->getWorkflowExcludeContacts($moduleName, $moduleUnitID);
        $totalContacts = count($oCampaignContacts);
        $response = array('status' => 'success', 'msg' => "Success", 'total_contacts' => $totalContacts);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to exclude list into the workflow campaign
     * @param Request $request
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
        $aSelectedLists = $request->selectedLists;
        $actionValue = $request->actionValue;
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);

        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        if ($actionValue == 'addRecord') {
            $mWorkflow->updateWorkflowExcludedList($moduleName, $moduleUnitID, $aSelectedLists);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteWorkflowExcludedLists($moduleName, $moduleUnitID, $aSelectedLists);
        }

        //Get Campaign list subscribers
        $oTotalSubscribers = $mWorkflow->getWorkflowExcludeListSubscribers($moduleName, $moduleUnitID);


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

        $oLists = $mWorkflow->getWorkflowExcludeLists($moduleName, $moduleUnitID);


        $response = array('status' => 'success', 'msg' => "List Added successfully!", 'total_lists' => count($oLists), 'total_contacts' => $totalSubscribers, 'duplicate_contacts' => $duplicateCount);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to exclude segments into the workflow campaign
     * @param Request $request
     */
    public function addExcludeSegmentToWorkflowCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $segmentId = strip_tags($request->segmentId);
        $actionValue = $request->actionValue;
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);
        
        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();
        
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'segment_id' => $segmentId,
                'created' => date("Y-m-d H:i:s")
            );
            $mWorkflow->addExcludedSegmentToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteExcludedSegmentToWorkflowCampaign($moduleName, $moduleUnitID, $segmentId);
        }

        $oCampaignSegments = $mWorkflow->getWorkflowExcludeSegments($moduleName, $moduleUnitID);
        $totalSegments = count($oCampaignSegments);
        $response = array('status' => 'success', 'msg' => "Success", 'total_segments' => $totalSegments);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to exclude tags into the workflow campaign
     * @param Request $request
     */
    public function addExcludedTagToWorkflowCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $tagId = strip_tags($request->tagId);
        $actionValue = $request->actionValue;
        $moduleName = strip_tags($request->moduleName);
        $moduleUnitID = strip_tags($request->moduleUnitID);
        
        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();
        
        if ($actionValue == 'addRecord') {
            $aData = array(
                'user_id' => $userID,
                'tag_id' => $tagId,
                'created' => date("Y-m-d H:i:s")
            );
            $mWorkflow->addExcludedTagToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
        } else if ($actionValue == 'deleteRecord') {
            $mWorkflow->deleteExcludedTagToWorkflowCampaign($moduleName, $moduleUnitID, $tagId);
        }
        $oCampaignTags = $mWorkflow->getWorkflowExcludeTags($moduleName, $moduleUnitID);
        $totalTags = count($oCampaignTags);
        $response = array('status' => 'success', 'msg' => "Success", 'total_tags' => $totalTags);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Imported Properties for a workflow campaign
     * @param Request $request
     */
    public function getWorkflowImportedProperties(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($request) {
            $mWorkflow = new WorkflowModel();
            $moduleName = strip_tags($request->moduleName);
            $moduleUnitID = strip_tags($request->moduleUnitID);


            $aTags = TagsModel::getClientTags($userID);

            $oImportLists = $mWorkflow->getWorkflowImportLists($moduleName, $moduleUnitID);

            $oCampaignImportContacts = $mWorkflow->getWorkflowImportContacts($moduleName, $moduleUnitID);

            $oCampaignImportTags = $mWorkflow->getWorkflowImportTags($moduleName, $moduleUnitID);

            $oCampaignImportSegments = $mWorkflow->getWorkflowImportSegments($moduleName, $moduleUnitID);

            $aDataImportButtons = array(
                'moduleUnitID' => $moduleUnitID,
                'oCampaignLists' => $oImportLists,
                'oCampaignContacts' => $oCampaignImportContacts,
                'aTags' => $aTags,
                'oCampaignTags' => $oCampaignImportTags,
                'oCampaignSegments' => $oCampaignImportSegments
            );
            $sImportButtons = view('admin.workflow2.partials.importButtonTags', $aDataImportButtons)->render();
        }
        $response['status'] = 'success';
        $response['content'] = $sImportButtons;
        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Excluded Properties for a workflow campaign
     * @param Request $request
     */
    public function getWorkflowExportedProperties(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instanciate workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        if ($request) {
            $moduleName = strip_tags($request->moduleName);
            $moduleUnitID = strip_tags($request->moduleUnitID);
            //Exclude Specific Data
            $aTags = TagsModel::getClientTags($userID);

            $oTotalExcludeSubscribers = $mWorkflow->getWorkflowExcludeListSubscribers($moduleName, $moduleUnitID);

            $oExcludeLists = $mWorkflow->getWorkflowExcludeLists($moduleName, $moduleUnitID);

            $oCampaignExcludeContacts = $mWorkflow->getWorkflowExcludeContacts($moduleName, $moduleUnitID);

            $oCampaignExcludeTags = $mWorkflow->getWorkflowExcludeTags($moduleName, $moduleUnitID);

            $oCampaignExcludeSegments = $mWorkflow->getWorkflowExcludeSegments($moduleName, $moduleUnitID);

            $aDataExportButtons = array(
                'moduleUnitID' => $moduleUnitID,
                'oCampaignLists' => $oExcludeLists,
                'oCampaignContacts' => $oCampaignExcludeContacts,
                'aTags' => $aTags,
                'oCampaignTags' => $oCampaignExcludeTags,
                'oCampaignSegments' => $oCampaignExcludeSegments
            );
            $sExcludButtons = view('admin.workflow2.partials.excludeButtonTags', $aDataExportButtons)->render();
        }
        $response['status'] = 'success';
        $response['content'] = $sExcludButtons;
        echo json_encode($response);
        exit;
    }

    /**
     * Used to sync Audience after change in any import or exclude properties
     * @param Request $request
     */
    public function syncWorkflowAudience(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($request) {
            $moduleName = strip_tags($request->moduleName);
            $moduleUnitID = strip_tags($request->moduleUnitID);
            $preSyncSubscribers = array();
            $mWorkflow = new WorkflowModel();

            if (!empty($moduleName) && !empty($moduleUnitID)) {
                //Fliter subscibers to be used after excluding filters at the end of the function
                $oPreSyncCampaignSubscribers = $mWorkflow->getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
                //pre($oPreSyncCampaignSubscribers);
                if (!empty($oPreSyncCampaignSubscribers)) {
                    foreach ($oPreSyncCampaignSubscribers as $row) {
                        $preSyncSubscribers[] = $row->subscriber_id;
                    }
                }
                //Imported Properites
                //Lists
                $aWorkflowSubscribers = array();
                $oImportLists = $mWorkflow->getWorkflowImportLists($moduleName, $moduleUnitID);
                if (!empty($oImportLists)) {

                    foreach ($oImportLists as $oList) {
                        $aListIDs[] = $oList->list_id;
                    }


                    //Get Unique Subscribers from each lists
                    if (!empty($aListIDs)) {
                        foreach ($aListIDs as $iListID) {
                            $oListSubscribers = $mWorkflow->getWorkflowCommonListContacts($userID, $iListID);
                            if (!empty($oListSubscribers)) {
                                foreach ($oListSubscribers as $oSubscriber) {
                                    if (!in_array($oSubscriber->subscriber_id, $aWorkflowSubscribers)) {
                                        $aWorkflowSubscribers[] = $oSubscriber->subscriber_id;
                                    }
                                }
                            }
                        }
                    }
                }

                //Imported Contacts
                $oCampaignImportContacts = $mWorkflow->getWorkflowImportContacts($moduleName, $moduleUnitID);
                if (!empty($oCampaignImportContacts)) {
                    foreach ($oCampaignImportContacts as $oRec) {
                        if (!in_array($oRec->subscriber_id, $aWorkflowSubscribers)) {
                            $aWorkflowSubscribers[] = $oRec->subscriber_id;
                        }
                    }
                }

                //Imported Tags
                $oCampaignImportTags = $mWorkflow->getWorkflowImportTags($moduleName, $moduleUnitID);
                if (!empty($oCampaignImportTags)) {
                    foreach ($oCampaignImportTags as $oRec) {
                        $tagId = $oRec->tag_id;
                        $oTagSubscribers = WorkflowModel::getWorkflowTagSubscribers($tagId);
                        if (!empty($oTagSubscribers)) {
                            foreach ($oTagSubscribers as $oSubscriber) {
                                if (!in_array($oSubscriber->id, $aWorkflowSubscribers)) {
                                    $aWorkflowSubscribers[] = $oSubscriber->id;
                                }
                            }
                        }
                    }
                }

                //Imported Segments
                $oCampaignImportSegments = $mWorkflow->getWorkflowImportSegments($moduleName, $moduleUnitID);
                if (!empty($oCampaignImportSegments)) {
                    foreach ($oCampaignImportSegments as $oRec) {
                        $segmentId = $oRec->segment_id;
                        $oSubscribers = WorkflowModel::getWorkflowSegmentSubscribers($segmentId, $userID);
                        if (!empty($oSubscribers)) {
                            foreach ($oSubscribers as $oSubscriber) {
                                if (!in_array($oSubscriber->subscriber_id, $aWorkflowSubscribers)) {
                                    $aWorkflowSubscribers[] = $oSubscriber->subscriber_id;
                                }
                            }
                        }
                    }
                }

                //Excluded Properites
                $aWorkflowExcludedSubscribers = $aEligibleSubscribers = array();
                //Excluded Lists
                $oExcludeLists = $mWorkflow->getWorkflowExcludeLists($moduleName, $moduleUnitID);
                if (!empty($oExcludeLists)) {
                    $aListIDs = array();
                    foreach ($oExcludeLists as $oList) {
                        $aListIDs[] = $oList->list_id;
                    }


                    //Get Unique Subscribers from each lists
                    if (!empty($aListIDs)) {
                        foreach ($aListIDs as $iListID) {
                            $oListSubscribers = $mWorkflow->getWorkflowCommonListContacts($userID, $iListID);
                            if (!empty($oListSubscribers)) {
                                foreach ($oListSubscribers as $oSubscriber) {
                                    if (!in_array($oSubscriber->subscriber_id, $aWorkflowExcludedSubscribers)) {
                                        $aWorkflowExcludedSubscribers[] = $oSubscriber->subscriber_id;
                                    }
                                }
                            }
                        }
                    }
                }

                //Excluded Contacts
                $oCampaignExcludeContacts = $mWorkflow->getWorkflowExcludeContacts($moduleName, $moduleUnitID);
                if (!empty($oCampaignExcludeContacts)) {
                    foreach ($oCampaignExcludeContacts as $oRec) {
                        if (!in_array($oRec->subscriber_id, $aWorkflowExcludedSubscribers)) {
                            $aWorkflowExcludedSubscribers[] = $oRec->subscriber_id;
                        }
                    }
                }



                //Excluded Tags
                $oCampaignExcludeTags = $mWorkflow->getWorkflowExcludeTags($moduleName, $moduleUnitID);
                if (!empty($oCampaignExcludeTags)) {
                    foreach ($oCampaignExcludeTags as $oRec) {
                        $tagId = $oRec->tag_id;
                        $oTagSubscribers = WorkflowModel::getWorkflowTagSubscribers($tagId);
                        if (!empty($oTagSubscribers)) {
                            foreach ($oTagSubscribers as $oSubscriber) {
                                if (!in_array($oSubscriber->id, $aWorkflowExcludedSubscribers)) {
                                    $aWorkflowExcludedSubscribers[] = $oSubscriber->id;
                                }
                            }
                        }
                    }
                }

                //Excluded Segments
                $oCampaignExcludeSegments = $mWorkflow->getWorkflowExcludeSegments($moduleName, $moduleUnitID);
                if (!empty($oCampaignExcludeSegments)) {
                    foreach ($oCampaignExcludeSegments as $oRec) {
                        $segmentId = $oRec->segment_id;
                        $oSubscribers = WorkflowModel::getWorkflowSegmentSubscribers($segmentId, $userID);
                        if (!empty($oSubscribers)) {
                            foreach ($oSubscribers as $oSubscriber) {
                                if (!in_array($oSubscriber->subscriber_id, $aWorkflowExcludedSubscribers)) {
                                    $aWorkflowExcludedSubscribers[] = $oSubscriber->subscriber_id;
                                }
                            }
                        }
                    }
                }
                
                //For Extra cleanup
                if (!empty($aWorkflowSubscribers)) {
                    foreach ($aWorkflowSubscribers as $subscriberID) {
                        if (!in_array($subscriberID, $aWorkflowExcludedSubscribers)) {
                            $aEligibleSubscribers[] = $subscriberID;
                        }
                    }
                }
                //Step-1: Delete all workflow subscribers from excluded  subscriber
                //Step-2: Add workflow Subscribers only those which are not in excluded subscribers
                //Step-1 Excecution

                if (!empty($aWorkflowExcludedSubscribers)) {
                    foreach ($aWorkflowExcludedSubscribers as $subscriberID) {
                        $mWorkflow->deleteAudienceFromWorkflowCampaign($moduleName, $moduleUnitID, $subscriberID);
                    }
                }

                //Step-2 Execution
                if (!empty($aWorkflowSubscribers)) {
                    foreach ($aWorkflowSubscribers as $subscriberID) {
                        if (!in_array($subscriberID, $aWorkflowExcludedSubscribers)) {
                            $aData = array(
                                'user_id' => $userID,
                                'subscriber_id' => $subscriberID,
                                'created' => date("Y-m-d H:i:s")
                            );
                            $this->addAudienceToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
                        }
                    }
                }

                //Get supecious subscribers
                foreach ($preSyncSubscribers as $subscriberID) {
                    if (!in_array($subscriberID, $aEligibleSubscribers)) {
                        $suspciousSubscribers[] = $subscriberID;
                    }
                }

                //pre($suspciousSubscribers);

                if (!empty($suspciousSubscribers)) {
                    $mWorkflow->deleteSuspeciousWorkflowCampaignSubscribers($moduleName, $moduleUnitID, $suspciousSubscribers);
                }
            }
        }

        $oCampaignSubscribers = $mWorkflow->getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
        $content = view('admin.workflow2.partials.filtered-contacts-ajax', array('oCampaignSubscribers' => $oCampaignSubscribers))->render();
        $response['status'] = 'success';
        $response['content'] = $content;
        $response['total_audience'] = count($oCampaignSubscribers);
        echo json_encode($response);
        exit;
    }

    /**
     * Used to add Audience into the workflow campaign
     * @param type $aData
     * @param type $moduleName
     * @param type $moduleUnitID
     */
    public function addAudienceToWorkflowCampaign($aData, $moduleName, $moduleUnitID) {
        $mWorkflow = new WorkflowModel();
        $subscriberID = $aData['subscriber_id'];
        //Do some necessary check if any
        //Check-1 -Duplicate Entry  
        $bDuplicate = $mWorkflow->isDuplicateWorkflowAudience($moduleName, $moduleUnitID, $subscriberID);
        if ($bDuplicate == false) {
            $mWorkflow->addAudienceToWorkflowCampaign($aData, $moduleName, $moduleUnitID);
        }
    }

    /**
     * Used to sync audience aggregates to all properties
     */
    public function syncWorkflowAudienceGlobal() {
        $mWorkflow->syncWorkflowAudienceGlobalModel();
    }

}
