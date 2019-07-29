<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\MembershipModel;
use App\Models\Admin\InvoicesModel;
/*use App\Models\Admin\UsersModel;
use App\Models\ReviewsModel;
use App\Models\SignupModel;
use App\Models\InfusionModel;
use App\Models\Admin\Crons\InviterModel;*/
use Illuminate\Support\Facades\Input;
use Session;

class Settings extends Controller {
	
	/**
     * This is a setting index function
     * @param type
     */
	public function index() {

		$seletedTab = Input::get('t');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $pID =$oUser->plan_id;
        $topupPlanID = $oUser->topup_plan_id;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Brand Settings" class="sidebar-control active hidden-xs ">Brand Settings</a></li>
                    </ul>';

        $oSettings = SettingsModel::getNotificationSettings($userID);
        $notificationlisting = SettingsModel::getallowNotification();

        if(empty($oSettings)){
            SettingsModel::addNotificationSettings($userID);
            $oSettings = SettingsModel::getNotificationSettings($userID);
        }
        
        $oImportHistory = SettingsModel::getImportHistory($userID);
        
        $oExportHistory = SettingsModel::getExportHistory($userID);
        
        $oMemberships = MembershipModel::getActiveMembership();
        if (!empty($oMemberships)) {
            
            foreach ($oMemberships as $oPlan) {
                $planID = $oPlan->plan_id;
                if ($planID == $pID) {
                    $oCurrentPlanData = $oPlan;
                }
                
                if($planID == $topupPlanID){
                    $oCurrentTopupPlanData = $oPlan;
                }
            }
        }
        
        $data = array(
            'title' => 'Brand Settings',
            'pagename' => $breadcrumb,
            'settingsData' => SettingsModel::getSettingsData(),
            'notificationData' => $oSettings,
            'oImportHistory' => $oImportHistory,
            'oExportHistory' => $oExportHistory,
            'oMemberships' => $oMemberships,
            'oCurrentPlanData' => $oCurrentPlanData,
            'oCurrentTopupPlanData' => $oCurrentTopupPlanData,
            'oInvoices' => InvoicesModel::getInvoices($userID),
            'seletedTab' => $seletedTab,
            'notificationlisting'=>$notificationlisting,
            'oUser' => $oUser
        );

        return view('admin.settings.brand', $data);

	}

	/**
     * Update company form data
     * @param type
     */
	public function updateCompanyFormData() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        $post = Input::post();

        if (!empty($post)) {
            foreach ($post as $field => $value) {
                $aData[$field] = $value;
            }

            if (!empty($aData)) {
                $aData['updated'] = date("Y-m-d H:i:s");
                $bUpdated = SettingsModel::updateCompanyProfile($aData, $userID);
                if ($bUpdated) {
                    $response['status'] = 'success';
                } else {
                    $response['status'] = 'error';
                }
            }
        }

        echo json_encode($response);
        exit;
        
    }

    /**
     * Update company profile
     * @param type
     */
    public function updateCompanyProfile() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        $post = Input::post();
        if ($post) {
            $fieldName = strip_tags($post['fieldname']);
            $fieldValue = strip_tags($post['fieldval']);

            $aData = array(
                $fieldName => $fieldValue
            );
            
            $aData['updated'] = date("Y-m-d H:i:s");

            $bUpdated = SettingsModel::updateCompanyProfile($aData, $userID);
            if ($bUpdated) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Update notification permission
     * @param type
     */
    public function updateNotificationPermisson() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        $post = Input::post();
        if ($post) {
            $fieldName = strip_tags($post['notification_slug']);

            $aData = array(
               'notification_slug' => $fieldName
            );
            
            $aData['updated'] = date("Y-m-d H:i:s");

            $bUpdated = SettingsModel::updateNotificationPermissonData($aData, $userID);
            if ($bUpdated) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Update notification setting
     * @param type
     */
    public function updateNotificationSettings() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        $post = Input::post();
        if ($post) {
            $fieldName = strip_tags($post['fieldname']);
            $fieldValue = strip_tags($post['fieldval']);

            $aData = array(
                $fieldName => $fieldValue
            );
            
            $aData['updated'] = date("Y-m-d H:i:s");
          
            $bUpdated = SettingsModel::updateNotificationSettings($aData, $userID);
            if ($bUpdated) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;
    }

}