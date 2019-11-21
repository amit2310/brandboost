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
        if($oCampaignData->isNotEmpty()){
            foreach($oCampaignData as $oCampaign){
                $oCampaign->stats = $this->getEventCampaignStats($oCampaign, $moduleName);
            }
        }
        echo json_encode(['oCampaigns' => $oCampaignData]);
        exit;
    }


    /**
     * Used to get Event Campaign Stats
     * @param $oCampaign
     * @param $moduleName
     */
    public function getEventCampaignStats($oCampaign, $moduleName){
        if(!empty($oCampaign)){
            $type = strtolower($oCampaign->campaign_type);
            $id = $oCampaign->id;

            if($type == 'email'){
                $oStats = $this->getEventEmailStats($id, $moduleName);
            }

            if($type == 'sms'){
                $oStats = $this->getEventSmsStats($id, $moduleName);
            }
        }

        return $oStats;

    }

    /**
     * Used to get Email stats assoicated with event email campaign
     * @param $id
     * @param $moduleName
     * @return array|bool
     */
    public function getEventEmailStats($id, $moduleName){

        $aStats = WorkflowModel::getEventSendgridStats($id, $moduleName);
        $aCategorizedStats = WorkflowModel::getEventSendgridCategorizedStats($aStats);
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
        $openRate = ($processed>0) ? ($open/$processed)*100 : 0;
        $clickRate = ($processed>0) ? ($click/$processed)*100 : 0;
        $aStats = [
            'processed' => $processed,
            'delivered' => $delivered,
            'open' => $open,
            'click' => $click,
            'bounce' => $bounce,
            'dropped' => $dropped,
            'unsubscribe' => $unsubscribe,
            'spamReport' => $spamReport,
            'openRate' => $openRate,
            'clickRate' => $clickRate
        ];
        return $aStats;

    }

    /**
     * Used to get an SMS stats associated with the event campaign
     * @param $id
     * @param $moduleName
     * @return array|bool
     */
    public function getEventSmsStats($id, $moduleName){
        $aStats = WorkflowModel::getEventTwilioStats($id, $moduleName);
        $aCategorizedStatsSms = WorkflowModel::getEventTwilioCategorizedStats($aStats);
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
        $deliveryRate = ($sentSms>0) ? ($deliveredSms/$sentSms)*100 : 0;
        $failedRate = ($sentSms>0) ? ($failedSms/$sentSms)*100 : 0;


        $aStats = [
            'deliveredSms' => $deliveredSms,
            'failedSms' => $failedSms,
            'queuedSms' => $queuedSms,
            'acceptedSms' => $acceptedSms,
            'sentSms' => $sentSms,
            'deliveryRate' => $deliveryRate,
            'failedRate' => $failedRate
        ];
        return $aStats;

    }

    /**
     * Used to get workflow subscribers
     * @param Request $request
     */
    public function workflowSubscribers(Request $request){
        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitID;
        $subscribersData = WorkflowModel::getWorkflowCampaignSubscribers($moduleName, $moduleUnitID);
        echo json_encode(['subscribersData' => $subscribersData]);
        exit;
    }

}
