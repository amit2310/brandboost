<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\WorkflowModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\TagsModel;

class HelperUtility extends Controller
{
    /**
     * This function is used to get the list of all tags associated with a subscriber
     * @param Request $request
     */
    public function getSubscriberTags(Request $request){
        $subscriberID = $request->subscriber_id;
        $oTags = TagsModel::getSubscriberTags($subscriberID);
        $iTagCount = 0;
        if(!empty($oTags)){
            $iTagCount = count($oTags);
        }
        echo json_encode(['oTags'=> $oTags, 'tagCount'=> $iTagCount]);
        exit;
    }

    /**
     * Used to get Feedback Tags
     * @param Request $request
     */
    public function getFeedbackTags(Request $request){
        $feedbackID = $request->feedbackId;
        $oTags = TagsModel::getTagsDataByFeedbackID($feedbackID);
        $iTagCount = 0;
        if(!empty($oTags)){
            $iTagCount = count($oTags);
        }
        echo json_encode(['oTags'=> $oTags, 'tagCount'=> $iTagCount]);
        exit;
    }

    /**
     * Used to get workflow campaigns based on the event id
     * @param Request $request
     */
    public function eventCampaigns(Request $request){
        $moduleName = $request->moduleName;
        $id = $request->id;
        $oCampaignData = WorkflowModel::getEventCampaign($id, $moduleName);
        echo json_encode(['oCampaigns' => $oCampaignData]);
        exit;
    }

    public function getEventCampaignStats($oCampaign){
        if(!empty($oCampaign){
            $type = strtolower($oCampaign->campaign_type);
            if($type == 'email'){
                $oStats = '';
            }
        }

    }

    public function getEventEmailStats($id, $moduleName){
        $aStats = WorkflowModel::getEventSendgridStats($id, $moduleName);
        $aCategorizedStats = WorkflowModel::getEventSendgridCategorizedStats($aStats);
    }

    public function getEventSmsStats($id, $moduleName){
        $aStats = WorkflowModel::getEventTwilioStats($id, $moduleName);
        $aCategorizedStats = WorkflowModel::getEventTwilioCategorizedStats($aStats);
    }

}
