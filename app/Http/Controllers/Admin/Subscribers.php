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

class Subscribers extends Controller
{
    /**
     * Used to export subscribers through csv file
     */
    public function exportSubscriberCSV(Request $request)
    {

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

        $moduleName = $request->input('module_name');
        $moduleAccountID = $request->input('module_account_id');


        if ($userRole != '1') {
            $oSubscribers = $mSubscriber->getModuleSubscribers($userID, $moduleName, $moduleAccountID);
        } else {
            $oSubscribers = $mSubscriber->getModuleSubscribers('', $moduleName, $moduleAccountID);
        }

        //pre($oSubscribers);

        if ($oSubscribers->isNotEmpty()) {
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

    }


    /**
     * Used to move module subscribers into archive list
     */
    public function moveToArchiveModuleContact(Request $request)
    {


        $mSubscriber = new SubscriberModel();

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitId;
        $subscriberID = $request->subscriberId;

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
    public function moveToActiveModuleContact(Request $request)
    {


        $mSubscriber = new SubscriberModel();

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitId;
        $subscriberID = $request->subscriberId;

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
    public function changeModuleContactStatus(Request $request)
    {


        $mSubscriber = new SubscriberModel();

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitId;
        $subscriberID = $request->subscriberId;
        $status = $request->contactStatus;

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
    public function deleteModuleSubscriber(Request $request)
    {

        $mSubscriber = new SubscriberModel();

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitId;
        $subscriberID = $request->subscriberId;

        $bDeleted = $mSubscriber->deleteModuleSubscriber($subscriberID, $moduleName, $moduleUnitID);

        if ($bDeleted == true) {
            $response = array('status' => 'success', 'msg' => "Contact deleted successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete module subscribers in bulk
     */
    public function deleteBulkModuleContacts(Request $request)
    {
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
    public function archiveBulkModuleContacts(Request $request)
    {


        $mSubscriber = new SubscriberModel();

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $multipalSubscriberId = $request->multipalSubscriberId;
        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitId;

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
    public function activeBulkModuleContacts(Request $request)
    {


        $mSubscriber = new SubscriberModel();

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $multipalSubscriberId = $request->multipalSubscriberId;
        $moduleName = $request->moduleName;
        $moduleUnitID = $request->moduleUnitId;

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
    public function index()
    {
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
    public function activities($subscriberID)
    {
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
    public function getSubscriberDetail(Request $request)
    {
        $response = array();
        $mSubscriber = new SubscriberModel();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $moduleName = $request->module_name;
        $moduleSubscriberID = $request->module_subscriber_id;

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
    public function updateSubscriberDetailsByid(Request $request)
    {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;


        $firstName = $request->edit_firstname;
        $lastName = $request->edit_lastname;
        $email = $request->edit_email;
        $phone = $request->edit_phone;
        $gender = $request->edit_gender;
        $countryCode = $request->edit_countryCode;
        $cityName = $request->edit_cityName;
        $stateName = $request->edit_stateName;
        $zipCode = $request->edit_zipCode;
        $facebookProfile = $request->edit_facebook_profile;
        $twitterProfile = $request->edit_twitter_profile;
        $linkedInProfile = $request->edit_linkedin_profile;
        $instagramProfile = $request->edit_instagram_profile;
        $socialProfile = $request->edit_socialProfile;
        //$tagID = $request->edit_tags;
        $moduleName = $request->edit_module_name;
        $subscriberId = $request->edit_module_subscriber_id;
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
    public function updateSubscriberDetails(Request $request)
    {
        $mSubscriber = new SubscriberModel();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;


        $firstName = $request->edit_firstname;
        $lastName = $request->edit_lastname;
        $email = $request->edit_email;
        $phone = $request->edit_phone;
        $gender = $request->edit_gender;
        $countryCode = $request->edit_countryCode;
        $cityName = $request->edit_cityName;
        $stateName = $request->edit_stateName;
        $zipCode = $request->edit_zipCode;
        $facebookProfile = $request->edit_facebook_profile;
        $twitterProfile = $request->edit_twitter_profile;
        $linkedInProfile = $request->edit_linkedin_profile;
        $instagramProfile = $request->edit_instagram_profile;
        $socialProfile = $request->edit_socialProfile;
        //$tagID = $request->edit_tags;
        $moduleName = $request->edit_module_name;
        $subscriberId = $request->edit_module_subscriber_id;
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
    public function add_contact(Request $request)
    {
        //Apply validations
        $validatedData = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email']
        ]);

        $mSubscriber = new SubscriberModel();
        $response = array();
        $result = array();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if (empty($request)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }

        $emailUserId = '';
        $firstName = $request->firstname;
        $lastName = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $gender = $request->gender;
        $countryCode = $request->country_code;
        $cityName = $request->cityName;
        $stateName = $request->stateName;
        $zipCode = $request->zipCode;
        $socialProfile = (!empty($request->socialProfile) ? $request->socialProfile : '');
        $facebookProfile = (!empty($request->facebook_profile) ? $request->facebook_profile : '');
        $twitterProfile = (!empty($request->twitter_profile) ? $request->twitter_profile : '');
        $linkedInProfile = (!empty($request->linkedin_profile) ? $request->linkedin_profile : '');
        $instagramProfile = (!empty($request->instagram_profile) ? $request->instagram_profile : '');
        $list_id = (!empty($request->list_id) ? $request->list_id : '0');
        $moduleName = $request->module_name;
        $moduleAccountID = (!empty($request->module_account_id) ? $request->module_account_id : $list_id);

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
                //'list_id' => $list_id,
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
                $aData['user_id'] = $userID;
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
                $result = $mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
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
     * Used to update subscribers details
     */
    public function update_contact(Request $request)
    {
        $mSubscriber = new SubscriberModel();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;


        $firstName = $request->firstname;
        $lastName = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $gender = $request->gender;
        $countryCode = $request->countryCode;
        $cityName = $request->cityName;
        $stateName = $request->stateName;
        $zipCode = $request->zipCode;
        $facebookProfile = $request->facebook_profile;
        $twitterProfile = $request->twitter_profile;
        $linkedInProfile = $request->linkedin_profile;
        $instagramProfile = $request->instagram_profile;
        $socialProfile = $request->socialProfile;
        //$tagID = $request->edit_tags;
        $moduleName = $request->module_name;
        $subscriberId = $request->id;
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
                    'tagID' => '', //$tagID,
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
     * Used to import subscribers through csv file
     */
    public function importSubscriberCSV(Request $request)
    {

        $csvimport = new Csvimport();
        $mSubscriber = new SubscriberModel();
        $mSettings = new SettingsModel();
        $mWorkflow = new WorkflowModel();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $someoneadded = false;


        if (!empty($request->list_id)) {
            $list_id = $request->list_id;
        }
        $moduleName = $request->module_name;
        $moduleAccountID = $request->module_account_id;
        $redirectURL = $request->redirect_url;

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
                $twitterProfile = $row['TWITTER_PROFILE'] != '' ? $row['TWITTER_PROFILE'] : '';
                $facebookProfile = $row['FACEBOOK_PROFILE'] != '' ? $row['FACEBOOK_PROFILE'] : '';
                //$linkedinProfile = $row['LINKEDIN_PROFILE'];
                $instagramProfile = $row['INSTAGRAM_PROFILE'] != '' ? $row['INSTAGRAM_PROFILE'] : '';
                $socialProfile = $row['OTHER_SOCIAL_PROFILE'] != '' ? $row['OTHER_SOCIAL_PROFILE'] : '';
                $emailUserId = 0;

                if (!in_array(strtolower($email), $aSuppressionList)) {
                    $imported++;
                    $emailUser = UsersModel::checkEmailExist($email);
                    if (!empty($emailUser)) {
                        if (!empty($emailUser[0])) {
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
                            $result = $mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
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


    /**
     * Used to import subscribers through csv file and mapping
     */
    public function readSubscriberCSVToMap(Request $request)
    {
        $csvimport = new Csvimport();
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $dbFieldArr = ["firstname","lastname","email","phone","gender","country_code","cityName","stateName","zipCode"];

        if(!empty($request->fileContent)) {
            $fileContent = $request->fileContent;

            if (!empty($fileContent)) {
                $fileContentArr = explode("\n",$fileContent);

                $headersArr = explode(",",$fileContentArr[0]);
                unset($fileContentArr[0]);
                //pre($headersArr); exit;
                $newArr = [];
                foreach($fileContentArr as $ind => $row) {
                    $rowArr = explode(",",$row);

                    $newArr[] = array_combine($headersArr, $rowArr);
                }

                $csv_array = $newArr;
                $arr = [];
                foreach($csv_array[0] as $k=>$v) {
                    $csv_array_sample['ind'] = $k;
                    $csv_array_sample['val'] = $v;

                    if($k == 'FIRST_NAME') { $csv_array_sample['dbField'] = 'firstname'; }
                    else if($k == 'LAST_NAME') { $csv_array_sample['dbField'] = 'lastname'; }
                    else if($k == 'EMAIL') { $csv_array_sample['dbField'] = 'email'; }
                    else if($k == 'PHONE') { $csv_array_sample['dbField'] = 'phone'; }
                    else if($k == 'GENDER') { $csv_array_sample['dbField'] = 'gender'; }
                    else if($k == 'COUNTRY') { $csv_array_sample['dbField'] = 'country_code'; }
                    else if($k == 'CITY') { $csv_array_sample['dbField'] = 'cityName'; }
                    else if($k == 'STATE') { $csv_array_sample['dbField'] = 'stateName'; }
                    else if($k == 'ZIP') { $csv_array_sample['dbField'] = 'zipCode'; }

                    $arr[] = $csv_array_sample;
                }

                $aData = $arr;
                //pre($aData); exit;
                $response = array('status' => 'success', 'aSubscribers' => $csv_array, 'aSubscribersToMap' => $aData);
            } else {
                $response = array('status' => 'error', 'msg' => 'Not found');
            }
        } else {
            //$allowedFileTypesArr = ["csv",".csv","xls",".xls","xlsx",".xlsx","txt",".txt"];
            $allowedFileTypesArr = ["csv",".csv"];
            $file_path     = $request->file('file');
            $fileName = $file_path->getClientOriginalName();
            $fileExt = $file_path->getClientOriginalExtension();
            //$contents = file_get_contents($file_path);
            //echo $contents;

            if(in_array($fileExt,$allowedFileTypesArr)) {
                if ($csvimport->get_array($file_path)) {
                    $csv_array = $csvimport->get_array($file_path);

                    $arr = [];
                    foreach ($csv_array[0] as $k => $v) {
                        $csv_array_sample['ind'] = $k;
                        $csv_array_sample['val'] = $v;

                        if ($k == 'FIRST_NAME') {
                            $csv_array_sample['dbField'] = 'firstname';
                        } else if ($k == 'LAST_NAME') {
                            $csv_array_sample['dbField'] = 'lastname';
                        } else if ($k == 'EMAIL') {
                            $csv_array_sample['dbField'] = 'email';
                        } else if ($k == 'PHONE') {
                            $csv_array_sample['dbField'] = 'phone';
                        } else if ($k == 'GENDER') {
                            $csv_array_sample['dbField'] = 'gender';
                        } else if ($k == 'COUNTRY') {
                            $csv_array_sample['dbField'] = 'country_code';
                        } else if ($k == 'CITY') {
                            $csv_array_sample['dbField'] = 'cityName';
                        } else if ($k == 'STATE') {
                            $csv_array_sample['dbField'] = 'stateName';
                        } else if ($k == 'ZIP') {
                            $csv_array_sample['dbField'] = 'zipCode';
                        }

                        $arr[] = $csv_array_sample;
                    }

                    $aData = $arr;
                    //pre($aData); exit;

                    $response = array('status' => 'success', 'aSubscribers' => $csv_array, 'aSubscribersToMap' => $aData);
                } else {
                    $response = array('status' => 'error', 'msg' => 'Not found');
                }
            } else {
                $response = array('status' => 'errorFileType', 'msg' => 'Please use file with extension with .csv only');
            }
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to map the file fields with the database
     */
    public function mapSubscriberCSV(Request $request)
    {
        $selectedFields = $request->selectedFields;
        $dataSubscribers     = $request->dataSubscribers;

        $selectedFieldsArr = json_decode($selectedFields, true);
        $dataSubscribersArr = json_decode($dataSubscribers, true);
        $finalMappedSubsArr = [];
        if($selectedFieldsArr) {
            foreach($selectedFieldsArr as $k => $v) {
                foreach($dataSubscribersArr as $k2 => $v2) {
                    $finalMappedSubsArr[$k2][$selectedFieldsArr[$k]['ind']] = $v2[$selectedFieldsArr[$k]['ind']]."====".$selectedFieldsArr[$k]['dbField'];
                }
            }
            //pre($finalMappedSubsArr);
            $newSubsArr = [];
            foreach($finalMappedSubsArr as $k3 => $vArr3) {
                //pre($vArr3);
                foreach($vArr3 as $k4=>$v4) {
                    //echo "<br>".$k4." --------------- ". $v4;
                    $newSubsArr[$k4][] = $v4;
                }
            }

            $response = array('status' => 'success', 'aSubscribers' => $dataSubscribersArr, 'aFinalMappedSubsArr' => $finalMappedSubsArr);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Used to import subscribers through csv file
     */
    public function readSubscriberCSV(Request $request)
    {

        $csvimport = new Csvimport();
        $mSubscriber = new SubscriberModel();
        $mSettings = new SettingsModel();
        $mWorkflow = new WorkflowModel();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $someoneadded = false;

        if(!empty($request->fileContent)) {
            $fileContent = $request->fileContent;

            if (!empty($fileContent)) {
                $fileContentArr = explode("\n",$fileContent);

                $headersArr = explode(",",$fileContentArr[0]);
                unset($fileContentArr[0]);
//pre($headersArr);
                $newArr = [];
                foreach($fileContentArr as $ind => $row) {
                    $rowArr = explode(",",$row);

                    $newArr[] = array_combine($headersArr, $rowArr);
                }

                $aData = $newArr;

                $response = array('status' => 'success', 'aSubscribers' => $aData);
            } else {
                $response = array('status' => 'error', 'msg' => 'Not found');
            }
        } else {
            $file_path     = $request->file('file');
            //$fileName = $file->getClientOriginalName();
            //$contents = file_get_contents($file_path);
            //echo $contents;

            if ($csvimport->get_array($file_path)) {
                $csv_array = $csvimport->get_array($file_path);
                $aData = $csv_array;

                //$response = array('status' => 'success', 'aSubscribers' => $aData, 'file_path' => $file_path->getPathName());
                $response = array('status' => 'success', 'aSubscribers' => $aData);
            } else {
                $response = array('status' => 'error', 'msg' => 'Not found');
            }
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to import subscribers through csv file
     */
    public function importSubscriberList(Request $request)
    {
        $csvimport = new Csvimport();
        $mSubscriber = new SubscriberModel();
        $mSettings = new SettingsModel();
        $mWorkflow = new WorkflowModel();
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $someoneadded = false;


        $moduleName = $request->module_name;
        $moduleAccountID = $request->module_account_id;
        $redirectURL = $request->redirect_url;

        $dataSubscribers     = $request->dataSubscribers;
        $errorMsgStr = '';
        if (!empty($dataSubscribers)) {
            $csv_array = json_decode($dataSubscribers);

            $aSuppressionList = $mSubscriber->getSuppressionList();
            $imported = 0;

            foreach ($csv_array as $row) {
                if(isset($row->FIRST_NAME)) {
                    if (stristr($row->FIRST_NAME, "====")) {
                        $firstName = explode("====", $row->FIRST_NAME)[0];
                        $firstNameDBField = explode("====", $row->FIRST_NAME)[1];
                    } else {
                        $firstName = $row->FIRST_NAME;
                    }
                } else {
                    $errorMsgStr = 'Firstname is required.';
                }

                if(isset($row->LAST_NAME)) {
                    if (stristr($row->LAST_NAME, "====")) {
                        $lastName = explode("====", $row->LAST_NAME)[0];
                        $lastNameDBField = explode("====", $row->LAST_NAME)[1];
                    } else {
                        $lastName = $row->LAST_NAME;
                    }
                } else {
                    $errorMsgStr = '\n Lastname is required.';
                }

                if(isset($row->EMAIL)) {
                    if (stristr($row->EMAIL, "====")) {
                        $email = explode("====", $row->EMAIL)[0];
                        $emailDBField = explode("====", $row->EMAIL)[1];
                    } else {
                        $email = $row->EMAIL;
                    }
                } else {
                    $errorMsgStr = '\n Email address is required.';
                }

                if(isset($row->PHONE)) {
                    if (stristr($row->PHONE, "====")) {
                        $phone = explode("====", $row->PHONE)[0];
                        $phoneDBField = explode("====", $row->PHONE)[1];
                    } else {
                        $phone = $row->PHONE;
                    }
                }  else {
                    //$errorMsgStr = '\n Phone number is required.';
                }

                if(isset($row->GENDER)) {
                    if (stristr($row->GENDER, "====")) {
                        $gender = explode("====", $row->GENDER)[0];
                        $genderDBField = explode("====", $row->GENDER)[1];
                    } else {
                        $gender = $row->GENDER;  //male/female
                    }
                }

                if(isset($row->COUNTRY)) {
                    if (stristr($row->COUNTRY, "====")) {
                        $countryCode = explode("====", $row->COUNTRY)[0];
                        $countryCodeDBField = explode("====", $row->COUNTRY)[1];
                    } else {
                        $countryCode = $row->COUNTRY;  //Contry code
                    }
                } else {
                    $errorMsgStr = '\n Country is required.';
                }

                if(isset($row->CITY)) {
                    if (stristr($row->CITY, "====")) {
                        $cityName = explode("====", $row->CITY)[0];
                        $cityNameDBField = explode("====", $row->CITY)[1];
                    } else {
                        $cityName = $row->CITY;
                    }
                }

                if(isset($row->STATE)) {
                    if (stristr($row->STATE, "====")) {
                        $stateName = explode("====", $row->STATE)[0];
                        $stateNameDBField = explode("====", $row->STATE)[1];
                    } else {
                        $stateName = $row->STATE;
                    }
                }

                if(isset($row->ZIP)) {
                    if (stristr($row->ZIP, "====")) {
                        $zipCode = explode("====", $row->ZIP)[0];
                        $zipCodeDBField = explode("====", $row->ZIP)[1];
                    } else {
                        $zipCode = $row->ZIP;
                    }
                }

                $twitterProfile = $row->TWITTER_PROFILE != '' ? $row->TWITTER_PROFILE : '';
                $facebookProfile = $row->FACEBOOK_PROFILE != '' ? $row->FACEBOOK_PROFILE : '';
                //$linkedinProfile = $row->LINKEDIN_PROFILE'];
                $instagramProfile = $row->INSTAGRAM_PROFILE != '' ? $row->INSTAGRAM_PROFILE : '';
                $socialProfile = $row->OTHER_SOCIAL_PROFILE != '' ? $row->OTHER_SOCIAL_PROFILE : '';
                $emailUserId = 0;

                if (!in_array(strtolower($email), $aSuppressionList) && $errorMsgStr == '') {
                    $imported++;
                    $emailUser = UsersModel::checkEmailExist($email);
                    if (!empty($emailUser)) {
                        if (!empty($emailUser[0])) {
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
                            (!empty($firstNameDBField) ? $firstNameDBField : 'firstName') => (!empty($firstName) ? $firstName : ''),
                            (!empty($lastNameDBField) ? $lastNameDBField : 'lastName') => (!empty($lastName) ? $lastName : ''),
                            (!empty($emailDBField) ? $emailDBField : 'email') => (!empty($email) ? $email : ''),
                            (!empty($phoneDBField) ? $phoneDBField : 'phone') => (!empty($phone) ? $phone : ''),
                            (!empty($genderDBField) ? $genderDBField : 'gender') => (!empty($gender) ? $gender : ''),
                            (!empty($countryCodeDBField) ? $countryCodeDBField : 'country_code') => (!empty($countryCode) ? $countryCode : ''),
                            (!empty($cityNameDBField) ? $cityNameDBField : 'cityName') => (!empty($cityName) ? $cityName : ''),
                            (!empty($stateNameDBField) ? $stateNameDBField : 'stateName') => (!empty($stateName) ? $stateName : ''),
                            (!empty($zipCodeDBField) ? $zipCodeDBField : 'zipCode') => (!empty($zipCode) ? $zipCode : ''),
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
                            $result = $mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
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

            if(empty($errorMsgStr)) {
                $response = array('status' => 'success', 'redirectURL' => $redirectURL);
            } else {
                $response = array('status' => 'errorMsg', 'msg' => $errorMsgStr);
            }
        } else {
            $response = array('status' => 'error', 'msg' => 'Error occured');
        }

        echo json_encode($response);
        exit;
    }


    public function store(Request $request)
    {
        $file     = request()->file('file');
        $fileName = rand(1, 999) . $file->getClientOriginalName();
        $filePath = "/uploads/" . date("Y") . '/' . date("m") . "/" . $fileName;

        $file->storeAs('uploads/'. date("Y") . '/' . date("m") . '/', $fileName, 'uploads');

        return File::create(['file_name' => $fileName, 'path' => $filePath, 'file_extension' => $file->getClientOriginalExtension()]);
    }

}
