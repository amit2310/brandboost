<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\SegmentsModel;
use App\Models\Admin\Modules\NpsModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class Segments extends Controller
{
     public function createSegment(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $segmentName = $request->segmentName;
        $description = $request->segmentDescription;
        $moduleUnitID = $request->moduleUnitID;
        $segmentType = $request->segmentType;
        $campaignType = $request->campaignType;
        $moduleName = $request->moduleName;
        $eventID = $request->eventID;
        $mNPS  = new NpsModel();
        $mSegments = new SegmentsModel();

        //check for already
        $bDuplicate = $mSegments->isDuplicateSegment($segmentName, $userID);
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
                'source_campaign_id' => serialize(array($moduleUnitID)), //main campaign id etc brandboost_id, automation_id etc
                'source_campaign_type' => $campaignType, //email or sms
                'source_segment_type' => $segmentType, // sent, open, click, delivered, total-positive, negative, neutral etc
                'source_module_name' => $moduleName,
                'source_event_id' => $eventID,
                'created' => date("Y-m-d H:i:s")
            );

            $segmentID = $mSegments->createSegment($aData);
            //echo "Segment ID is ". $segmentID;

            if ($segmentID > 0) {
                //Enter list of contacts in the segment
                if ($moduleName == 'brandboost-onsite') {
                    //echo "Yes, I am here";
                    $bInserted = $mSegments->addSegmentSubscribersFromReviews($segmentID, $moduleUnitID, $segmentType, $campaignType, $moduleName);
                } else if ($moduleName == 'brandboost-offsite') {
                    //echo "Yes, I am here";
                    $bInserted = $mSegments->addSegmentSubscribersFromFeedback($segmentID, $moduleUnitID, $segmentType, $campaignType, $moduleName);
                } else if ($moduleName == 'nps-feedback') {
                    //echo "Yes, I am here";
                    $oNPS = $mNPS->getNps($userID, $moduleUnitID);
                    if (!empty($oNPS)) {
                        $hashCode = $oNPS->hashcode;

                    }


                    $bInserted = $mSegments->addSegmentSubscribersFromNPSFeedback($segmentID, $hashCode, $segmentType, $campaignType, $moduleName);
                } else {
                    $bInserted = $mSegments->addSegmentSubscribers($segmentID, $moduleUnitID, $segmentType, $campaignType, $moduleName, $eventID);
                }
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
	* This function is used to sync the segments with the broadcast
Im ty::
	* @return type
	*/

    public function syncSegment(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();

        $mSegments = new SegmentsModel();
        $segmentID = $request->segmentID;
        $mNPS = new NpsModel();
        //Get Segment Info
        $oSegment = $mSegments->getSegments($userID, $segmentID);
        if (!empty($oSegment)) {
            $aCampaignSources = unserialize($oSegment[0]->source_campaign_id);
            $segmentType = $oSegment[0]->source_segment_type;
            $campaignType = $oSegment[0]->source_campaign_type;
            $moduleName = $oSegment[0]->source_module_name;
            $sendingMethod = $oSegment[0]->source_sending_method;
            $eventID = $oSegment[0]->source_event_id;
            if (!empty($aCampaignSources)) {
                foreach ($aCampaignSources as $campaignID) {
                    //$this->mBroadcast->addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType);
                    if ($moduleName == 'brandboost-onsite') {
                        //echo "Yes, I am here";
                        $bInserted = $mSegments->addSegmentSubscribersFromReviews($segmentID, $campaignID, $segmentType, $campaignType, $moduleName);
                    } else if ($moduleName == 'brandboost-offsite') {
                        //echo "Yes, I am here";
                        $bInserted = $mSegments->addSegmentSubscribersFromFeedback($segmentID, $campaignID, $segmentType, $campaignType, $moduleName);
                    } else if ($moduleName == 'nps-feedback') {
                        //echo "Yes, I am here";
                        $oNPS = $mNPS->getNps($userID, $campaignID);
                        if (!empty($oNPS)) {
                            $hashCode = $oNPS->hashcode;
                        }


                        $bInserted = $mSegments->addSegmentSubscribersFromNPSFeedback($segmentID, $hashCode, $segmentType, $campaignType, $moduleName);
                    } else {
                        $bInserted = $mSegments->addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType, $moduleName, $eventID, $sendingMethod);
                    }
                }
            }
            $response = array('status' => 'success');
        }
        echo json_encode($response);
        exit;
    }
}
