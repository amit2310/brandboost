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
	public function index(Request $request)
    {

        $seletedTab = 1;//$request->input('t');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $pID = $oUser->plan_id;
        $topupPlanID = isset($oUser->topup_plan_id) ? $oUser->topup_plan_id : '';

        /* Country List */
        $countries = getAllCountries();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Brand Settings" class="sidebar-control active hidden-xs ">Brand Settings</a></li>
                    </ul>';
        $aBreadcrumb = array(
            'Home' => '#/',
            'Brand Setting' => '#/settings/'
        );

        $oSettings = SettingsModel::getNotificationSettings($userID);
        $eventsSettings = SettingsModel::getNotificationEventsSettings($userID);
        $notificationlisting = SettingsModel::getallowNotification();

        if (empty($oSettings)) {
            SettingsModel::addNotificationSettings($userID);
            $oSettings = SettingsModel::getNotificationSettings($userID);
        }

        $oImportHistory = SettingsModel::getImportHistory($userID);

        $oExportHistory = SettingsModel::getExportHistory($userID);

        $oRegularMembership = '';
        $oTopupMembership = '';
        $oMemberships = MembershipModel::getActiveMembership();
        if (!empty($oMemberships)) {
            $isMembershipActive = false;
            foreach ($oMemberships as $oPlan) {
                $planID = $oPlan->plan_id;
                if ($planID == $pID) {
                    $oCurrentPlanData = $oPlan;
                }

                if ($planID == $topupPlanID) {
                    $oCurrentTopupPlanData = $oPlan;
                }

                if ($oUser->plan_id == $oPlan->plan_id) {
                    $oPlan->isMembershipActive = true;
                } else {
                    $oPlan->isMembershipActive = false;
                }

                if ($oUser->topup_plan_id == $oPlan->plan_id) {
                    $oPlan->isTopupMembershipActive = true;
                }

                /*if ($oPlan->plan_id == $oUser->topup_plan_id) {
                    $oPlan->oCurrentTopupMembership = $oPlan;
                }*/
            }
        }
        $oInvoices = InvoicesModel::getInvoices($userID);
//        foreach ($oInvoices as $oInvoice){
//            $invoiceData[$oInvoice->id] = InvoicesModel::getInvoiceDetails($oInvoice->id);
//        }
        $aData = array(
            'title' => 'Brand Settings',
            'pagename' => $breadcrumb,
            'breadcrumb' => $aBreadcrumb,
            'countries' => $countries,
            'settingsData' => SettingsModel::getSettingsData(),
            'notificationData' => $oSettings,
            'notificationEventData' => $eventsSettings,
            'oImportHistory' => $oImportHistory,
            'oExportHistory' => $oExportHistory,
            'oMemberships' => $oMemberships,
            'oCurrentPlanData' => $oCurrentPlanData,
            'oCurrentTopupPlanData' => isset($oCurrentTopupPlanData) ? $oCurrentTopupPlanData : '',
            'oInvoices' => $oInvoices,
//            'invoiceData' => $invoiceData,
            'seletedTab' => $seletedTab,
            'notificationlisting'=>$notificationlisting,
            'oUser' => $oUser
        );

        //return view('admin.settings.brand', $data);
        echo json_encode($aData);
        exit();

	}

	/**
     * Update company form data
     * @param type
     */
	public function updateCompanyFormData() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        $request = Request::input();
        if (!empty($request)) {

            foreach ($request as $field => $value) {
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
    public function updateCompanyProfile(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        if (!empty($request)) {
            $fieldName = $request->fieldname;
            $fieldValue = $request->fieldval;

            $aData = array(
                $fieldName => $fieldValue
            );

            $aData['updated'] = date("Y-m-d H:i:s");
//    print_r($request->all());
//    print_r($aData);
//    exit;
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
     * Update company profile
     * @param type
     */
    public function saveGeneralInfo_Need_to_remove(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        if (!empty($request)) {
            $aData = array(
                'company_name' => request('company_name'),
                'company_address' => request('company_address'),
                'business_address_dppa' => request('business_address_dppa'),
                'phone_no_dppa' => request('phone_no_dppa'),
                'company_phone' => request('company_phone'),
                'website_dppa' => request('website_dppa'),
                'company_website' => request('company_website'),
                'country' => request('country'),
                'social_facebook' => request('social_facebook'),
                'social_instagram' => request('social_instagram'),
                'social_twitter' => request('social_twitter'),
                'social_linkedin' => request('social_linkedin'),
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
    public function savePublicProfile_Need_to_remove(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        if (!empty($request)) {
            $aData = array(
                'company_description' => request('company_description'),
                'company_working_hours' => request('company_working_hours'),
                'company_operate_scope' => request('company_operate_scope'),
                'company_type' => request('company_type'),
                'public_profile_link' => request('public_profile_link'),
                'company_seo_keywords' => request('company_seo_keywords'),

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
    public function saveGeneralPreferences_Need_to_remove(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        if (!empty($request)) {
            $aData = array(
                'language' => request('language'),
                'currency' => request('currency'),
                'timezone' => request('timezone'),
                'date_format' => request('date_format'),
                'time_format' => request('time_format'),
                'wh_start_week' => request('wh_start_week'),
                'wh_start_day' => request('wh_start_day'),
                'wh_start_day_minutes' => request('wh_start_day_minutes'),
                'wh_end_day' => request('wh_end_day'),
                'wh_end_day_minutes' => request('wh_end_day_minutes'),

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

    public function saveUserSettings(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        if (!empty($request)) {
            $aData=(array)$request->all();
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
    public function updateNotificationPermisson(Request $request) {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        if (!empty($request)) {
            $fieldName = $request->notification_slug;

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
    public function updateNotificationSettings(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();

        if (!empty($request)) {
            $fieldName = $request->fieldname;
            $fieldValue = $request->fieldval;

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
     public function getuserbyid(Request $request){


       $userid = $request->userid;
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
    public function updateS3setting(Request $request) {
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


        if (!empty($request)) {
            $user_id_input = $request->user_id_input;
            $s3_allow_size = $request->s3_allow_size;
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
      public function getCreditPropery(Request $request){


        $mSetting  = new SettingsModel();
        if (!empty($request)) {
            $creditID = base64_url_decode($request->creditID);
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
    public function updateCreditPropery(Request $request){
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


       if (!empty($request)) {
           $creditID = base64_url_decode($request->creditID);
           $propertyName = $request->title;
           $creditValue = $request->feature_credits;
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
