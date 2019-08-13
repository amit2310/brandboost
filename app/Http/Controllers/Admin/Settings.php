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


    /**
    * This function is used for amazon storage service
    * @param type 
    * @return type
    */


    public function amazon_s3_storage() {

        $mSetting = new SettingsModel();
        $breadcrumb="";
        $oUser= array();
        $userID="";
        $getNotifications = $mSetting->listNotifications($userID,'admin');
        $aData = array(
            'title' => 'System Notifications',
            'pagename' => $breadcrumb,
            'notifications' => $getNotifications,
            'oUser' => $oUser
        );
        return view('admin.settings.s3_storage', $aData);
    }



 

    /**
    * This function is used to get user setting by user id
    * @param type 
    * @return type
    */

     public function getuserbyid(){

       $post = Input::post();
       $userid = strip_tags($post['userid']);
       $userDetails = getAllUser($userid);
       if ($userDetails[0]->id!="") {
                $response['status'] = 'success';
                $response['datarow'] = $userDetails[0];
            } else {
                $response['status'] = 'error';
            }

            echo json_encode($response);
            exit;


    }
  

   /**
    * This function is used to update the amazon s3 settings 
    * @param type 
    * @return type
    */

    public function updateS3setting() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        $userRole = $oUser->user_role;
        if($userRole != '1'){
            $response['status'] = 'error';
            $response['msg'] = 'Not Authorise to access this page';
            echo json_encode($response);
            exit;
        }
        $post = Input::post();
      
        if ($post) {
            $user_id_input = strip_tags($post['user_id_input']);
            $s3_allow_size = $post['s3_allow_size'];
            $aData = array(
                's3_allow_size' => $s3_allow_size
                
            );
            $mSetting  = new SettingsModel();
            
            $bUpdated = $mSetting->updateS3StorageDetails($aData, $user_id_input);
            if ($bUpdated) {
                $response['status'] = 'success';
                $response['msg'] = 'Settings save successfully!';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;
    }

}