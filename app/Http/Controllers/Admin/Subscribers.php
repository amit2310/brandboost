<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\SubscriberActivityModel;
use Illuminate\Support\Facades\Input;
use Cookie;
use Session;
use App\Libraries\Custom\Csvimport;

class Subscribers extends Controller {
	/**
     * Used to export subscribers through csv file
     */
    public function exportSubscriberCSV() {

        // file name 
        $mSubscriber = new SubscriberModel();
        $mSettings = new SettingsModel();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $userRole = $oUser->user_role;
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $post = Input::get();

        $moduleName = strip_tags($post['module_name']);
        $moduleAccountID = strip_tags($post['module_account_id']);


        if ($userRole != '1') {
            $oSubscribers = $mSubscriber->getModuleSubscribers($userID, $moduleName, $moduleAccountID);
        } else {
            //$userID = '';
            $oSubscribers = $mSubscriber->getModuleSubscribers('', $moduleName, $moduleAccountID);
        }

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("EMAIL", "FIRST_NAME", "LAST_NAME", "PHONE", "GENDER", "COUNTRY", "CITY", "STATE", "ZIP", "TWITTER_PROFILE", "FACEBOOK_PROFILE", "INSTAGRAM_PROFILE", "OTHER_SOCIAL_PROFILE", "OTHER_SOCIAL_PROFILE");
        fputcsv($file, $header);
        foreach ($oSubscribers as $key => $line) {
            fputcsv($file, array($line->email, $line->firstname, $line->lastname, $line->phone, $line->gender, $line->country_code, $line->cityName, $line->stateName, $line->zipCode, $line->twitter_profile, $line->facebook_profile, $line->linkedin_profile, $line->instagram_profile, $line->socialProfile));
        }
        fclose($file);

        //Log Export History
        if (!empty($oSubscribers)) {
            $aHistoryData = array(
                'user_id' => $userID,
                'export_name' => 'Contacts',
                'item_count' => count($oSubscribers),
                'created' => date("Y-m-d H:i:s")
            );
            $mSettings->logExportHistory($aHistoryData);
        }
        //Add Useractivity log

        $aActivityData = array(
            'user_id' => $userID,
            'module_name' => $moduleName,
            'module_account_id' => $moduleAccountID,
            'event_type' => 'export_subscribers',
            'action_name' => 'exported_contact',
            'brandboost_id' => '',
            'campaign_id' => '',
            'inviter_id' => '',
            'subscriber_id' => '',
            'feedback_id' => '',
            'activity_message' => 'Exported Subscribers',
            'activity_created' => date("Y-m-d H:i:s")
        );
        logUserActivity($aActivityData);
        exit;
    }

    
    /**
     * Used to move module subscribers into archive list
     */
    public function moveToArchiveModuleContact() {

        $post = Input::post();
        $mSubscriber = new SubscriberModel();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = strip_tags($post['moduleName']);
        $moduleUnitID = strip_tags($post['moduleUnitId']);
        $subscriberID = strip_tags($post['subscriberId']);

        $aData = array(
            'status' => 2
        );

        $bUpdated = $mSubscriber->updateModuleSubscriber($moduleName, $aData, $subscriberID);

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Contact archived successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to move module subscribers into the active list
     */
    public function moveToActiveModuleContact() {

        $post = Input::post();
        $mSubscriber = new SubscriberModel();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = strip_tags($post['moduleName']);
        $moduleUnitID = strip_tags($post['moduleUnitId']);
        $subscriberID = strip_tags($post['subscriberId']);

        $aData = array(
            'status' => 1
        );

        $bUpdated = $mSubscriber->updateModuleSubscriber($moduleName, $aData, $subscriberID);

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Contact made active successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to update module subscribers status
     */
    public function changeModuleContactStatus() {

        $post = Input::post();
        $mSubscriber = new SubscriberModel();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = strip_tags($post['moduleName']);
        $moduleUnitID = strip_tags($post['moduleUnitId']);
        $subscriberID = strip_tags($post['subscriberId']);
        $status = strip_tags($post['contactStatus']);

        $aData = array(
            'status' => $status
        );

        $bUpdated = $mSubscriber->updateModuleSubscriber($moduleName, $aData, $subscriberID);

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Status updated successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to delete module subscirbers
     */
    public function deleteModuleSubscriber() {
        $post = Input::post();
        $mSubscriber = new SubscriberModel();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = strip_tags($post['moduleName']);
        $moduleUnitID = strip_tags($post['moduleUnitId']);
        $subscriberID = strip_tags($post['subscriberId']);

        $bDeleted = $mSubscriber->deleteModuleSubscriber($subscriberID, $moduleName, $moduleUnitID);
		exit;
        if ($bDeleted == true) {
            $response = array('status' => 'success', 'msg' => "Contact deleted successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to delete module subscribers in bulk
     */
    public function deleteBulkModuleContacts(Request $request) {
		$mSubscriber = new SubscriberModel();

        $multipalSubscriberId = $request->multipalSubscriberId;
        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitId;

        foreach ($multipalSubscriberId as $subscriberID) {
            $bDeleted = $mSubscriber->deleteModuleSubscriber($subscriberID, $moduleName, $moduleUnitID);
        }

        if ($bDeleted == true) {
            $response = array('status' => 'success', 'msg' => "Selected contacts deleted successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to archive module subscribers in bulk
     */
    public function archiveBulkModuleContacts() {

        $post = Input::post();
        $mSubscriber = new SubscriberModel();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $multipalSubscriberId = $post['multipalSubscriberId'];
        $moduleName = strip_tags($post['moduleName']);
        $moduleUnitID = strip_tags($post['moduleUnitId']);

        foreach ($multipalSubscriberId as $subscriberID) {
            $aData = array(
                'status' => 2
            );

            $bUpdated = $mSubscriber->updateModuleSubscriber($moduleName, $aData, $subscriberID);
        }

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Selected contacts archived successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * used to make active module subscribers into the contacts
     */
    public function activeBulkModuleContacts() {

        $post = Input::post();
        $mSubscriber = new SubscriberModel();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $multipalSubscriberId = $post['multipalSubscriberId'];
        $moduleName = strip_tags($post['moduleName']);
        $moduleUnitID = strip_tags($post['moduleUnitId']);

        foreach ($multipalSubscriberId as $subscriberID) {
            $aData = array(
                'status' => 1
            );
            $bUpdated = $mSubscriber->updateModuleSubscriber($moduleName, $aData, $subscriberID);
        }

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Selected contacts archived successfully!");
        }

        echo json_encode($response);
        exit;
    }
	
	
	
	
	
	
	
	
	
	
	
    
    /**
     * Default Controller
     */
    public function index() {
        $aUser = getLoggedUser();
        $user_role = $aUser->user_role;
        if (!empty($user_role) && $user_role == 1) {
            
        } else {
            redirect('/admin');
        }

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                    <li class="active">Users</li>
                </ul>';

        $data = array(
            'title' => 'Brand Boost Users',
            'pagename' => $breadcrumb,
            'usersdata' => $this->mUser->getAllUsers()
        );

        $this->template->load('admin/admin_template_new', 'admin/users/index', $data);
    }

    
    /**
     * Used to get subscriber's activities
     * @param type $subscriberID
     */
    public function activities($subscriberID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (empty($subscriberID)) {
            redirect("admin/contacts/mycontacts");
            exit;
        }

        $oSubscriber = $this->mSubscriber->checkIfMySubscriber($userID, $subscriberID);
        if ($oSubscriber == false) {
            redirect("admin/contacts/mycontacts");
            exit;
        }

        //Okay All good now
        //get Onsite & offsite Brandboost
        $oBrandboosts = $this->mActivity->brandboostCampaigns($subscriberID);

        //get Automation/Braoadcast Module Activity
        $oAutomations = $this->mActivity->automationCampaigns($subscriberID);

        //get NPS Module Activity
        $oNPSs = $this->mActivity->npsCampaigns($subscriberID);

        //get Referral Module Activity
        $oReferrals = $this->mActivity->referralCampaigns($subscriberID);

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class=""><a href="' . base_url('admin/contacts/mycontacts') . '">Contacts</a></li>
                    <li class="active">Activities</li>
                </ul>';

        $aData = array(
            'title' => 'Subscriber Details',
            'pagename' => $breadcrumb,
            'oSubscriber' => $oSubscriber,
            'oBrandboosts' => $oBrandboost,
            'oAutomations' => $oAutomations,
            'oNPSs' => $oNPSs,
            'oReferrals' => $oReferrals
        );

        $this->template->load('admin/admin_campaign_template', 'admin/subscriber/activities', $aData);
    }

    
    /**
     * Used to get Subscriber Details
     */
    public function getSubscriberDetail() {
        $response = array();
        $mSubscriber = new SubscriberModel();
        $post = Input::post();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $moduleName = strip_tags($post['module_name']);
        $moduleSubscriberID = strip_tags($post['module_subscriber_id']);

        $oContactsDetail = $mSubscriber->getModuleSubscriberInfo($moduleName, $moduleSubscriberID);


        if (!empty($oContactsDetail)) {
            $response = array('status' => 'success', 'result' => $oContactsDetail);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to update subscirber details by id
     */
    public function updateSubscriberDetailsByid() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();

        $firstName = strip_tags($post['edit_firstname']);
        $lastName = strip_tags($post['edit_lastname']);
        $email = strip_tags($post['edit_email']);
        $phone = strip_tags($post['edit_phone']);
        $gender = strip_tags($post['edit_gender']);
        $countryCode = strip_tags($post['edit_countryCode']);
        $cityName = strip_tags($post['edit_cityName']);
        $stateName = strip_tags($post['edit_stateName']);
        $zipCode = strip_tags($post['edit_zipCode']);
        $facebookProfile = strip_tags($post['edit_facebook_profile']);
        $twitterProfile = strip_tags($post['edit_twitter_profile']);
        $linkedInProfile = strip_tags($post['edit_linkedin_profile']);
        $instagramProfile = strip_tags($post['edit_instagram_profile']);
        $socialProfile = strip_tags($post['edit_socialProfile']);
        //$tagID = strip_tags($post['edit_tags']);
        $moduleName = strip_tags($post['edit_module_name']);
        $subscriberId = strip_tags($post['edit_module_subscriber_id']);
        $bInsertedNewGlobalSubscriber = false;

        $aData = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'country_code' => $countryCode,
            'cityName' => $cityName,
            'stateName' => $stateName,
            'zipCode' => $zipCode,
            'facebook_profile' => $facebookProfile,
            'twitter_profile' => $twitterProfile,
            'linkedin_profile' => $linkedInProfile,
            'instagram_profile' => $instagramProfile,
            'socialProfile' => $socialProfile,
            //'tagID' => $tagID,
            'updated' => date("Y-m-d H:i:s")
        );

        $res = $this->mSubscriber->updateModuleSubscriberByid($aData, $subscriberId);

        if ($res) {
            $response = array('status' => 'success', 'msg' => "Subscriber updated successfully!");
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to update subscribers details
     */
    public function updateSubscriberDetails() {
        $mSubscriber = new SubscriberModel();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = Input::post();

        $firstName = strip_tags($post['edit_firstname']);
        $lastName = strip_tags($post['edit_lastname']);
        $email = strip_tags($post['edit_email']);
        $phone = strip_tags($post['edit_phone']);
        $gender = strip_tags($post['edit_gender']);
        $countryCode = strip_tags($post['edit_countryCode']);
        $cityName = strip_tags($post['edit_cityName']);
        $stateName = strip_tags($post['edit_stateName']);
        $zipCode = strip_tags($post['edit_zipCode']);
        $facebookProfile = strip_tags($post['edit_facebook_profile']);
        $twitterProfile = strip_tags($post['edit_twitter_profile']);
        $linkedInProfile = strip_tags($post['edit_linkedin_profile']);
        $instagramProfile = strip_tags($post['edit_instagram_profile']);
        $socialProfile = strip_tags($post['edit_socialProfile']);
        //$tagID = strip_tags($post['edit_tags']);
        $moduleName = strip_tags($post['edit_module_name']);
        $subscriberId = strip_tags($post['edit_module_subscriber_id']);
        $bInsertedNewGlobalSubscriber = false;

        if (!empty($email)) {
            $oGlobalUser = SubscriberModel::checkIfGlobalSubscriberExists($userID, 'email', $email);
            if (!empty($oGlobalUser)) {
                $iSubscriberID = $oGlobalUser->id;
                $aGlobalUserData = array(
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                    'gender' => $gender,
                    'country_code' => $countryCode,
                    'cityName' => $cityName,
                    'stateName' => $stateName,
                    'zipCode' => $zipCode,
                    'facebook_profile' => $facebookProfile,
                    'twitter_profile' => $twitterProfile,
                    'linkedin_profile' => $linkedInProfile,
                    'instagram_profile' => $instagramProfile,
                    'socialProfile' => $socialProfile,
                    //'tagID' => $tagID,
                    'updated' => date("Y-m-d H:i:s")
                );

                $mSubscriber->updateGlobalSubscriber($aGlobalUserData, $iSubscriberID);
                $response = array('status' => 'success', 'msg' => "Subscriber updated successfully!");
            } else {
                //Add global subscriber
                $emailUser = $this->mUser->checkEmailExist($email);
                if (!empty($emailUser)) {
                    $emailUserId = $emailUser[0]->id;
                }

                $aSubscriberData = array(
                    'owner_id' => $userID,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                    'gender' => $gender,
                    'country_code' => $countryCode,
                    'cityName' => $cityName,
                    'stateName' => $stateName,
                    'zipCode' => $zipCode,
                    'socialProfile' => $socialProfile,
                    'tagID' => $tagID,
                    'created' => date("Y-m-d H:i:s")
                );


                if (!empty($emailUserId)) {
                    $aSubscriberData['user_id'] = $emailUserId;
                }
                $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                $bInsertedNewGlobalSubscriber = true;
            }
        }

        if ($bInsertedNewGlobalSubscriber == true) {
            $aData = array(
                'subscriber_id' => $iSubscriberID
            );

            $res = $mSubscriber->updateModuleSubscriber($moduleName, $aData, $subscriberId);

            if ($res) {
                $response = array('status' => 'success', 'msg' => "Subscriber updated successfully!");
            }
        }
        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to add a new subscriber
     */
    public function add_contact() {

        $response = array();
        $result = array();
        $post = Input::post();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if (empty($post)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }

        $emailUserId = '';
        $firstName = strip_tags($post['firstname']);
        $lastName = strip_tags($post['lastname']);
        $email = strip_tags($post['email']);
        $phone = strip_tags($post['phone']);
        $gender = strip_tags($post['gender']);
        $countryCode = strip_tags($post['country_code']);
        $cityName = strip_tags($post['cityName']);
        $stateName = strip_tags($post['stateName']);
        $zipCode = strip_tags($post['zipCode']);
        $socialProfile = strip_tags($post['socialProfile']);
        $facebookProfile = strip_tags($post['facebook_profile']);
        $twitterProfile = strip_tags($post['twitter_profile']);
        $linkedInProfile = strip_tags($post['linkedin_profile']);
        $instagramProfile = strip_tags($post['instagram_profile']);
        //$tagID = strip_tags($post['tagID']);
        $moduleName = strip_tags($post['module_name']);
        $moduleAccountID = strip_tags($post['module_account_id']);
        //$emailUser = getUserDetailByEmailId($email);
        $oUserAccount = UsersModel::checkEmailExist($email);

        if (!empty($oUserAccount[0])) {
            $emailUserId = $oUserAccount[0]->id;
        }


        $bAlreadyExists = 0;
        $oGlobalUser = "";
        if (!empty($email)) {
            $oGlobalUser = SubscriberModel::checkIfGlobalSubscriberExists($userID, 'email', $email);
        }
        if (!empty($oGlobalUser)) {
            $iSubscriberID = $oGlobalUser->id;
            $bAlreadyExists = 1;
        } else {
            //Add global subscriber
            $aSubscriberData = array(
                'owner_id' => $userID,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'country_code' => $countryCode,
                'cityName' => $cityName,
                'stateName' => $stateName,
                'zipCode' => $zipCode,
                'facebook_profile' => $facebookProfile,
                'twitter_profile' => $twitterProfile,
                'linkedin_profile' => $linkedInProfile,
                'instagram_profile' => $instagramProfile,
                'socialProfile' => $socialProfile,
                //'tagID' => $tagID,
                'created' => date("Y-m-d H:i:s")
            );
            if (!empty($emailUserId)) {
                $aSubscriberData['user_id'] = $emailUserId;
            }
            $iSubscriberID = SubscriberModel::addGlobalSubscriber($aSubscriberData);
        }

        if (!empty($moduleName)) {
            $aData = array(
                'user_id' => $emailUserId,
                'subscriber_id' => $iSubscriberID,
                'created' => date("Y-m-d H:i:s")
            );

            if ($moduleName == 'list') {
                $aData['list_id'] = $moduleAccountID;
                $tableName = 'tbl_automation_users';
            } else if ($moduleName == 'brandboost') {
                $aData['brandboost_id'] = $moduleAccountID;
                $tableName = 'tbl_brandboost_users';
            } else if ($moduleName == 'referral') {
                $aData['account_id'] = $moduleAccountID;
                $tableName = 'tbl_referral_users';
            } else if ($moduleName == 'nps') {
                $aData['account_id'] = $moduleAccountID;
                $tableName = 'tbl_nps_users';
            }

            if (!empty($tableName)) {
                $result = $this->mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
            }

            //Add Entry into the campaign contact list
            $bAddingCampaignUser = false;
            if ($moduleName == 'brandboost') {
                $aData['brandboost_id'] = $moduleAccountID;
                $tableName = 'tbl_brandboost_campaign_users';
                $bAddingCampaignUser = true;
            } else if ($moduleName == 'referral') {
                //For referral not required
            } else if ($moduleName == 'nps') {
                unset($aData['account_id']);
                $aData['nps_id'] = $moduleAccountID;
                $tableName = 'tbl_nps_campaign_users';
                $bAddingCampaignUser = true;
            }
            if (!empty($tableName) && $bAddingCampaignUser == true) {
                $result = $this->mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
            }

            if ($result || $iSubscriberID) {
                //Add Useractivity log
                $aActivityData = array(
                    'user_id' => $userID,
                    'module_name' => $moduleName,
                    'module_account_id' => $moduleAccountID,
                    'event_type' => 'add_subscriber',
                    'action_name' => 'added_contact',
                    'list_id' => '',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Added subscriber into the list',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
                $response['msg'] = 'Contact added successfully.';
                $response['id'] = $result;
            } else {
                $response['status'] = "Error";
            }
        }

        if ($iSubscriberID > 0) {
            $response['status'] = 'success';
            $response['pre-exists'] = $bAlreadyExists;
            $response['iSubscriberID'] = $iSubscriberID;
        }

        echo json_encode($response);
        exit;
    }

    
    /**
     * Used to import subscribers through csv file
     */
    public function importSubscriberCSV(Request $request) {

        $csvimport = new Csvimport();
        $mSubscriber = new SubscriberModel();
        $mSettings = new SettingsModel();
        $mWorkflow = new WorkflowModel();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $someoneadded = false;
        $post = Input::post();
      
        if(!empty($post['list_id'])) {
            $list_id = $post['list_id'];
        }
        $moduleName = strip_tags($post['module_name']);
        $moduleAccountID = strip_tags($post['module_account_id']);
        $redirectURL = $post['redirect_url'];

        $file_path = $request->file('userfile')->getRealPath();
        
        if ($csvimport->get_array($file_path)) {
            $csv_array = $csvimport->get_array($file_path);

            $aSuppressionList = $mSubscriber->getSuppressionList();
            $imported = 0;

            

            foreach ($csv_array as $row) {
                
                $firstName = $row['FIRST_NAME'];
                $lastName = $row['LAST_NAME'];
                $email = $row['EMAIL'];
                $phone = $row['PHONE'];
                $gender = $row['GENDER']; //male/female
                $countryCode = $row['COUNTRY']; //Contry code
                $cityName = $row['CITY'];
                $stateName = $row['STATE'];
                $zipCode = $row['ZIP'];
                $twitterProfile = $row['TWITTER_PROFILE'] != ''?$row['TWITTER_PROFILE']:'';
                $facebookProfile = $row['FACEBOOK_PROFILE'] != ''?$row['FACEBOOK_PROFILE']:'';
                //$linkedinProfile = $row['LINKEDIN_PROFILE'];
                $instagramProfile = $row['INSTAGRAM_PROFILE'] != ''?$row['INSTAGRAM_PROFILE']:'';
                $socialProfile = $row['OTHER_SOCIAL_PROFILE'] != ''?$row['OTHER_SOCIAL_PROFILE']:'';
                $emailUserId = 0;

                if (!in_array(strtolower($email), $aSuppressionList)) {
                    $imported++;
                    $emailUser = UsersModel::checkEmailExist($email);
                    if (!empty($emailUser)) {
                        if(!empty($emailUser[0])) {
                            $emailUserId = $emailUser[0]->id;
                        }
                        
                    }

                    $oGlobalUser = SubscriberModel::checkIfGlobalSubscriberExists($userID, 'email', $email);
                    if (!empty($oGlobalUser)) {
                        $iSubscriberID = $oGlobalUser->id;
                    } else {
                        //Add global subscriber
                        $aSubscriberData = array(
                            'owner_id' => $userID,
                            'firstName' => $firstName,
                            'lastName' => $lastName,
                            'email' => $email,
                            'phone' => $phone,
                            'gender' => $gender,
                            'country_code' => $countryCode,
                            'cityName' => $cityName,
                            'stateName' => $stateName,
                            'zipCode' => $zipCode,
                            'facebook_profile' => $facebookProfile,
                            'twitter_profile' => $twitterProfile,
                            //'linkedin_profile' => $linkedinProfile,
                            'instagram_profile' => $instagramProfile,
                            'socialProfile' => $socialProfile,
                            'created' => date("Y-m-d H:i:s")
                        );
                        if (!empty($emailUserId)) {
                            $aSubscriberData['user_id'] = $emailUserId;
                        }

                        $iSubscriberID = SubscriberModel::addGlobalSubscriber($aSubscriberData);
                    }

                    if (!empty($moduleName)) {
                        $aData = array(
                            'user_id' => $emailUserId,
                            'subscriber_id' => $iSubscriberID,
                            'created' => date("Y-m-d H:i:s")
                        );

                        if ($moduleName == 'list') {
                            $aData['list_id'] = $moduleAccountID;
                            $tableName = 'tbl_automation_users';
                        } else if ($moduleName == 'brandboost') {
                            $aData['brandboost_id'] = $moduleAccountID;
                            $tableName = 'tbl_brandboost_users';
                        } else if ($moduleName == 'referral') {
                            $aData['account_id'] = $moduleAccountID;
                            $tableName = 'tbl_referral_users';
                        } else if ($moduleName == 'nps') {
                            $aData['account_id'] = $moduleAccountID;
                            $tableName = 'tbl_nps_users';
                        }

                        if (!empty($tableName)) {
                            $result = $this->mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
                            $someoneadded = true;
                        }
                    }
                }
            }


            //Log Import History
            if ($imported > 0) {
                $aHistoryData = array(
                    'user_id' => $userID,
                    'import_name' => 'Contacts',
                    'item_count' => $imported,
                    'created' => date("Y-m-d H:i:s")
                );
                $mSettings->logImportHistory($aHistoryData);
            }



            if ($someoneadded == true) {
                //Add Useractivity log
                $aActivityData = array(
                    'user_id' => $userID,
                    'module_name' => $moduleName,
                    'module_account_id' => $moduleAccountID,
                    'event_type' => 'import_subscribers',
                    'action_name' => 'imported_contact',
                    'list_id' => '',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Imported subscribers',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
            }
            $mWorkflow->syncWorkflowAudienceGlobalModel();
            return redirect($redirectURL);
        } else {
            $data['error'] = "Error occured";
        }
    }

}
