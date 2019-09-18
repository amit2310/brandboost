<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\MembershipModel;
use App\Models\Admin\InvoicesModel;
use Illuminate\Support\Facades\Input;
use Session;

class Settings extends Controller {

	/**
     * This is a setting index function
     * @param type
     */
	public function index() {

		$seletedTab = Request::input('t');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $pID =$oUser->plan_id;
        $topupPlanID = isset($oUser->topup_plan_id) ? $oUser->topup_plan_id : '';

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
            'oCurrentTopupPlanData' => isset($oCurrentTopupPlanData) ? $oCurrentTopupPlanData : '',
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
     * System Notification Template
     * @param type
     */
    public function setup_system_notifications(Request $request) {

        $seletedTab = $request->t;
        if(empty($seletedTab)) {
            $seletedTab = 'email';
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $userRole = $oUser->user_role;
        if($userRole != '1'){
            exit('Not Authorise to access this page');
            return;
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="System Notifications" class="sidebar-control active hidden-xs ">System Notifications</a></li>
                </ul>';
        $mSetting = new SettingsModel();
        //$oTemplates = $this->mSetting->getSystemNotificationTemplates();
        $getNotifications = $mSetting->listNotifications($userID,'admin');
        //$oEmailTemplates = $this->mSetting->getEmailNotificationTemplates();
        $aData = array(
            'title' => 'System Notifications',
            'pagename' => $breadcrumb,
            'notifications' => $getNotifications,
            'oUser' => $oUser
        );
        //$this->template->load('admin/admin_template_new', 'admin/settings/system_notifications', $aData);

        return view('admin.settings.general_notifications', $aData);
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
     * Get email notification content
     * @param type
     */
    public function getEmailNotificationContent(Request $request){
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

        $mSetting = new SettingsModel();
        if ($request->templateId) {
            $templateID = $request->templateId;
            $oTemplate = $mSetting->getEmailNotificationContent($templateID);
            //base64_decode
            $oTemplate[0]->email_content_admin = base64_decode($oTemplate[0]->email_content_admin);
            $oTemplate[0]->email_content_client = base64_decode($oTemplate[0]->email_content_client);
            $oTemplate[0]->email_content_user = base64_decode($oTemplate[0]->email_content_user);

            if ($oTemplate) {
                $response['status'] = 'success';
                $response['datarow'] = $oTemplate[0];
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


    /**
    * This function is used for creditvalues
    * @param type
    * @return type
    */
    public function creditValues(){
        $seletedTab = Request::input('t');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $userRole = $oUser->user_role;
        if($userRole != '1'){
            exit('Not Authorise to access this page');
            return;
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Manage Credit Values" class="sidebar-control active hidden-xs ">Manage Credit Values</a></li>
                </ul>';
                $mSetting  = new SettingsModel();

        $oCrValues = $mSetting->getCreditValues();

        $oCrValuesHistory = $mSetting->getCreditValuesHistory();


        $aData = array(
            'title' => 'Credit Values Management',
            'pagename' => $breadcrumb,
            'oCrValues' => $oCrValues,
            'oCrValuesHistory' => $oCrValuesHistory,
            'seletedTab' => $seletedTab,
            'oUser' => $oUser
        );
      return view('admin.settings.credit_management', $aData);

    }


    /**
    * This function is used for credit propertey
    * @param type
    * @return type
    */
      public function getCreditPropery(){

        $post = Input::post();
        $mSetting  = new SettingsModel();
        if ($post) {
            $creditID = base64_url_decode(strip_tags($post['creditID']));
             $oCrValue = $mSetting->getCreditValues($creditID);
             if ($oCrValue) {
                $response['status'] = 'success';
                $response['datarow'] = $oCrValue[0];
             } else {
                $response['status'] = 'error';
             }
         }
         echo json_encode($response);
        exit;
    }



    /**
    * This function is used for update email notification content
    * @param type
    * @return type
    */
    public function updateEmailNotificationContent(Request $request) {
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

        if ($request->template_id) {
            $templateID = strip_tags($request->template_id);
            $email_subject_admin = strip_tags($request->admin_subject);
            $email_subject_client = strip_tags($request->subject);
            $email_subject_user = strip_tags($request->user_subject);

            $email_content_admin = base64_encode($request->admin_text);
            $email_content_user = base64_encode($request->user_text);
            $email_content_client = base64_encode($request->plain_text);



            $aData = array(
                'email_subject_admin' => $email_subject_admin,
                'email_content_admin' => $email_content_admin,
                'email_subject_client' => $email_subject_client,
                'email_content_client' => $email_content_client,
                'email_subject_user' => $email_subject_user,
                'email_content_user' => $email_content_user
            );

            $mSetting  = new SettingsModel();
            $bUpdated = $mSetting->updateNotificationContent($aData, $templateID);
            if ($bUpdated) {
                $response['status'] = 'success';
                $response['msg'] = 'Template save successfully!';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;
    }


    /**
    * This function is used for update sms notification content
    * @param type
    * @return type
    */
    public function updateSMSNotificationContent(Request $request) {
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
        if ($request->template_id) {
            $templateID = strip_tags($request->template_id);
            $admin_sms_content = $request->admin_sms_content;
            $client_sms_content = $request->client_sms_content;
            $user_sms_content = $request->user_sms_content;
            $aData = array(
                'admin_sms_content' => $admin_sms_content,
                'client_sms_content' => $client_sms_content,
                'user_sms_content' => $user_sms_content
            );

            $mSetting  = new SettingsModel();
            $bUpdated = $mSetting->updateNotificationContent($aData, $templateID);
            if ($bUpdated) {
                $response['status'] = 'success';
                $response['msg'] = 'Template save successfully!';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
    * This function is used for update system notification content
    * @param type
    * @return type
    */
    public function updateSystemNotificationContent(Request $request) {
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

        if ($request->template_id) {
            $templateID = strip_tags($request->template_id);
            $admin_system_content = $request->admin_system_content;
            $client_system_content = $request->client_system_content;
            $user_system_content = $request->user_system_content;
            $aData = array(
                'admin_system_content' => $admin_system_content,
                'client_system_content' => $client_system_content,
                'user_system_content' => $user_system_content
            );

            $mSetting  = new SettingsModel();
            $bUpdated = $mSetting->updateNotificationContent($aData, $templateID);
            if ($bUpdated) {
                $response['status'] = 'success';
                $response['msg'] = 'Template save successfully!';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;
    }


    /**
     * This function is used to get the client twilio number details
    * @param id
    * @return type
    */
    public function list_client_details($id)
    {

    $mSetting = new SettingsModel();
    $twilio_number_log = $mSetting->getClientNumberlogs($id);
    $aData = array(
    'twilio_number_log' => $twilio_number_log
    );
    return view('admin.settings.list_details', $aData);

    }


    /**
    * This function is used to get the client twilio logs
    * @param
    * @return type
    */
    public function twillo_log() {
        $mSetting  = new SettingsModel();
        $twillo_account_detail = $mSetting->twillo_account();
        $aData = array(
            'twillo_account_detail' => $twillo_account_detail
        );
      return view('admin.settings.twillo_log', $aData);
    }


    /**
    * This function is used for update notification
    * @param type
    * @return type
    */
    public function updateNotification(Request $request)
    {
        $response = array();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($request->id) {
        $id = strip_tags($request->id);
        $userId = $userID;
        $user_type=$request->user_type;
        $permission_type=$request->permission;
        $permission_value=$request->permission_value;

            $aData = array(
                'id' => $id,
                'userId' => $userId,
                'user_type' => $user_type,
                'permission' => $permission_type,
                'permission_value'=>$permission_value
            );

            $mSetting  = new SettingsModel();
            $bAdded = $mSetting->updateNotificationPermissions($aData);
            if ($bAdded) {
                $response['status'] = 'success';
            } else {
                $response['status'] = 'error';
            }
        }
        echo json_encode($response);
        exit;


    }


    /**
    * This function is used for update credit property
    * @param type
    * @return type
    */
    public function updateCreditPropery(){
       $oUser = getLoggedUser();
       $userID = $oUser->id;
       $response = array();
       $userRole = $oUser->user_role;
       $mSetting  = new SettingsModel();
       if($userRole != '1'){
           $response['status'] = 'error';
           $response['msg'] = 'Not Authorise to access this page';
           echo json_encode($response);
           exit;
       }

       $post = Input::post();
       if ($post) {
           $creditID = base64_url_decode(strip_tags($post['creditID']));
           $propertyName = strip_tags($post['title']);
           $creditValue = strip_tags($post['feature_credits']);
           //Get data for history
           $oCrValue = SettingsModel::getCreditValues($creditID);
           $aData = array(
               'feature_name' => $propertyName,
               'credit_value' => $creditValue,
               'updated' => date("Y-m-d H:i:s")
           );
           $bUpdated = $mSetting->updateCreditValues($aData, $creditID);
           if ($bUpdated) {
               //Log History
               if(!empty($oCrValue)){
                   $aHistoryData = array(
                       /*'id' => $oCrValue[0]->id,*/
                       'feature_key' => $oCrValue[0]->feature_key,
                       'feature_name' => $oCrValue[0]->feature_name,
                       'credit_value' => $oCrValue[0]->credit_value,
                       'status' => $oCrValue[0]->status,
                       'created' => date("Y-m-d H:i:s")
                   );
                   $addUpdateHistory = $mSetting->addCreditHistory($aHistoryData);
               }
               $response['status'] = 'success';
           } else {
               $response['status'] = 'error';
           }
       }
       echo json_encode($response);
       exit;
   }


    /**
    * This function is used to load team accounts
    * @param $userid
    * @return type
    */

    public function team_accounts($userid)
    {

        $mSetting = new SettingsModel();
        $team_account_detail = $mSetting->team_twillo_account($userid);
        $aData = array(
        'twillo_account_detail' => $team_account_detail
        );

        return view('admin.settings.team_accounts', $aData);

    }


     /**
    * This function is used list all team member number usage details
    * @param $userid
    * @return type
    */

      public function list_details($id)
      {
       $mSetting  = new SettingsModel();
        $twilio_number_log = $mSetting->getNumberlogs($id);
        $aData = array(
        'twilio_number_log' => $twilio_number_log
        );
        return view('admin.settings.list_details', $aData);

      }


}
