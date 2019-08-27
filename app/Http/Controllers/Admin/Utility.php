<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\Modules\EmailsModel;
use App\Models\Admin\Modules\NpsModel;
use App\Models\Admin\Modules\ReferralModel;
use App\Models\Admin\SubscriberModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Filesystem\Filesystem;
use Session;

class Utility extends Controller {

    public function loadModuleCampaigns(Request $request) {
		$mBrandboost = new BrandboostModel();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
		$moduleName = $request->module_name;
		switch ($moduleName) {
			case "onsite":
				$oData = $mBrandboost->getBrandboostByUserId($userID, 'onsite');
				break;
			case "offsite":
				$oData = $mBrandboost->getBrandboostByUserId($userID, 'offsite');
				break;
			case "broadcast":
				$oData = $mBroadcast->getMyBroadcasts($userID);
				break;
			case "automation":
				$oData = $mEmails->getEmailAutomations($userID);
				break;
			case "nps":
				$oData = $mNPS->getNpsLists($userID);
				break;
			case "referral":
				$oData = $mReferral->getReferralLists($userID);
				break;
		}

		$aData = array(
			'moduleName' => $moduleName,
			'oData' => $oData
		);

		$sCampaignListSource = view('admin.components.campaign-list.list', $aData)->render();
		if ($sCampaignListSource) {
			$response = array('status' => 'success', 'result' => $sCampaignListSource);
		}
		echo json_encode($response);
		exit;
    }

    public function sendReviewRequest(Request $request) {
		$mBrandboost = new BrandboostModel();
		$mSubscriber = new SubscriberModel();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
       
		$subscriberID = $request->subscriber_id;
		$aCampaigns = $request->aCampaign;
		if (!empty($aCampaigns) && !empty($subscriberID)) {
			foreach ($aCampaigns as $modName => $aCampaignIDs) {
				if (!empty($aCampaignIDs)) {
					foreach ($aCampaignIDs as $moduleUnitID) {
						$aData = array(
							'subscriber_id' => $subscriberID,
							'created' => date("Y-m-d H:i:s")
						);
						$moduleName = '';
						$tableName = '';
						if ($modName == 'onsite' || $modName == 'offsite') {
							$moduleName = 'brandboost';
							$aData['brandboost_id'] = $moduleUnitID;
							$tableName = 'tbl_brandboost_users';
						} else if ($modName == 'nps') {
							$moduleName = 'nps';
							$aData['account_id'] = $moduleUnitID;
							$tableName = 'tbl_nps_users';
						} else if ($modName == 'referral') {
							$moduleName = 'referral';
							$aData['account_id'] = $moduleUnitID;
							$tableName = 'tbl_referral_users';
						}
						if (!empty($tableName) && !empty($moduleName)) {
							$result = $mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
							$response = array('status' => 'success');
						}
					}
				}
			}
		}
        
        if ($response['status'] == 'success') {
            //Log Activity
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manual_review_request',
                'action_name' => 'manual_review_request',
                'subscriber_id' => $subscriberID,
                'activity_message' => 'Review request sent to multiple modules',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
        }

        echo json_encode($response);
        exit;
    }

    public function addContactToList(Request $request) {
		$mBrandboost = new BrandboostModel();
		$mSubscriber = new SubscriberModel();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
		$aListIDs = $request->listid;
		$subscriberID = $request->subscriber_id;
		$aListCollection = $request->allList;
		foreach($aListCollection as $iListID){
			if(in_array($iListID, $aListIDs)){
				$aSelectedList[] = $iListID;
			}else{
				$aUnselectedList[] = $iListID;
			}
		}
		
		if (!empty($aSelectedList) && $subscriberID > 0) {
			$oSubscriber = $mSubscriber->getSubscribersById($subscriberID);
			foreach($aSelectedList as $listID) {
				$moduleName = 'list';
				$aData = array(
					'user_id' => $oSubscriber->user_id,
					'subscriber_id' => $subscriberID,
					'list_id' => $listID,
					'created' => date("Y-m-d H:i:s")
				);
				$tableName = 'tbl_automation_users';
				$result = $mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
				$response = array('status' => 'success');
			}
			
			if(!empty($aUnselectedList)){
				foreach($aUnselectedList as $listID){
					
					$mSubscriber->removeContactFromList($subscriberID, $listID);
					$response = array('status' => 'success');
				}
			}
		}

        echo json_encode($response);
        exit;
    }

}
