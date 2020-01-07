<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\DashboardModel;
use App\Models\Admin\MembershipModel;
use App\Models\Admin\TagsModel;
use App\Models\Admin\ListsModel;
use App\Models\Admin\TeamModel;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\UsersModel;
use App\Models\Admin\LoginModel;
use App\Models\Admin\AccountsModel;
use App\Models\Admin\WorkflowModel;
use Session;


class AccountSetting extends Controller
{
    /**
     * Profile index function
     * @param type $userID
     * @return type object
     */

    public function index($userID = '') {

        $mBrandboost = new BrandboostModel();
        $dashboard = new DashboardModel();
        $membership = new MembershipModel();
        $mTags = new TagsModel();
        $mLists = new ListsModel();

        /* Country List */
        $countries = getAllCountries();

        $aTeamInfo = '';
        if (empty($userID)) {
            $aUser = getLoggedUser();
            $userID = $aUser->id;

            $isLoggedInTeam = Session::get('team_user_id');
            if ($isLoggedInTeam) {
                $aTeamInfo = TeamModel::getTeamMember($isLoggedInTeam, $aUser->id);
            }

        }
        $currentUserId = $userID;
        $bbStatsData = $mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId='');

        $userDetail = getUserDetail($userID);
        //pre($userDetail);
        //die();

        $campType = 'Email';
        $getCampEmail = $mBrandboost->getEmailSms($campType, $userID);
        $campType = 'SMS';
        $getCampSms = $mBrandboost->getEmailSms($campType, $userID);

        $userData = $dashboard->getUserData($userID);
        $membershipData = $membership->getMembershipInfo($userData[0]->subscription_plan_id);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Profile </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="' . $userDetail->firstname . ' ' . $userDetail->lastname . '" class="sidebar-control active hidden-xs ">' . $userDetail->firstname . ' ' . $userDetail->lastname . '</a></li>
                    </ul>';

        $aBreadcrumb = array(
            'Home' => '#/',
            'Profile' => '#/profile/',
            $userDetail->firstname . ' ' . $userDetail->lastname => ''
        );

        $aBrandboostList = BrandboostModel::getBrandboostByUserId($userID, 'onsite');
        $aBrandboostOffsiteList = BrandboostModel::getBrandboostByUserId($userID, 'offsite');
        $emailFooterData = $dashboard->getEmailFooterData($userID);
        if(!empty($emailFooterData[0]->footer_content)) {
            $emailFooterData = base64_decode($emailFooterData[0]->footer_content);
        }

        if(!empty($aTeamInfo)) {

            $getTeamMember = TeamModel::getTeamMember($aTeamInfo->id, $aTeamInfo->parent_user_id);
            $aData = array(
                'title' => 'Brand Boost Profile',
                'pagename' => $breadcrumb,
                'getTeamMember' => $getTeamMember
            );

            $this->template->load('admin/admin_template_new', 'admin/account_team_setting', $aData);
        }
        else
        {
            $aData = array(
                'title' => 'Brand Boost Profile',
                'pagename' => $breadcrumb,
                'breadcrumb' => $aBreadcrumb,
                'userDetail' => $userDetail,
                'countries' => $countries,
                'onsiteList' => $aBrandboostList,
                'offsiteList' => $aBrandboostOffsiteList,
                'getCampEmail' => $getCampEmail,
                'getCampSms' => $getCampSms,
                'membershipData' => $membershipData,
                'emailFooterData' => $emailFooterData,
                'bbStatsData' => $bbStatsData,
                'userData' => $userData[0],
                'aTeamInfo' => $aTeamInfo
            );

            //return view('admin.account_setting', $aData);
            echo json_encode($aData);
            exit();
        }

    }


    /**
     * This function is use for save profile detail
     * @param type $userID
     * @return type object
     */
    public function saveProfileDetail(Request $request) {

        $response = array();
        $aUser = getLoggedUser();

        $curruserID = $aUser->id;
        $user_role = $aUser->user_role;

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $mobile = $request->mobile;
        $avatar = $request->avatar;
        $website = $request->website;
        $country = $request->country;
        $userId = $request->userId;

        if(!empty($user_role) && $user_role == 1) {

        }
        else {
            if($userId == $curruserID) {

            }
            else{
                $response['msg'] = "Error: Something went wrong, try again";
                echo json_encode($response);
                exit;
            }
        }

        $aData = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'mobile' => $mobile,
            'avatar' => $avatar,
            'website' => $website,
            'country' => $country
        );

        $mUser = new UsersModel();
        $result = $mUser->updateUsers($aData, $userId);
        if ($result) {
            $response['status'] = 'success';
            $response['userId'] = $userId;
            $response['msg'] = "Profile has been updated successfully.";
        } else {
            $response['msg'] = "Error: Something went wrong, try again";
        }

        echo json_encode($response);
        exit;

    }


    /**
     * This function is use for change the password
     * @return type object
     */
    public function changePassword(Request $request) {

        $mLogin = new LoginModel();
        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $oldPassword = '';
        $newPassword = '';
        $rePassword = '';

        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $rePassword = $request->rePassword;

        if ($newPassword == $rePassword) {
            $checkPassword = $mLogin->ChangePassword($oldPassword, $newPassword, $rePassword);
            if ($checkPassword) {

                // Send notification
                $response['status'] = 'success';
                $response['msg'] = 'Your password has been changed successfully.';
            } else {

                $response['status'] = 'error';
                $response['msg'] = 'Please enter correct old password.';
            }
        } else {

            $response['status'] = 'error';
            $response['msg'] = 'Your new password and re-enter new password are not matching. Please enter same password.';
        }

        echo json_encode($response);
        exit;

    }

    /**
     * This function is use for delete the account
     * @return type object
     */
    public function account_deleted() {

        $aUser = getLoggedUser();
        $userId = $aUser->id;
        $aData = array(
            'deleted_status' => '1'
        );

        $mUser = new UsersModel();
        $result = $mUser->updateUsers($aData, $userId);
        if ($result) {
            $response['status'] = 'success';
            $response['msg'] = "Account has been deleted successfully.";
        } else {
            $response['msg'] = "Error: Something went wrong, try again";
        }

        echo json_encode($response);
        exit;

    }

    /**
     * This function usage
     * @return type object
     */
    public function usage() {
        $mAccounts = new AccountsModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $oUsages = $mAccounts->getUsage($userID);
        $oTeam = $mAccounts->getAllTeamMembers($userID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Accounts </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Account Usages" class="sidebar-control active hidden-xs ">Credit Usages</a></li>
                    </ul>';

        $aData = array(
            'title' => 'Account Usage Report',
            'pagename' => $breadcrumb,
            'oUsages' => $oUsages,
            'oUser' => $aUser,
            'oTeam' => $oTeam
        );

        return view('admin.accounts.index', $aData);
    }

    /**
     * This function usage info
     * @return type object
     */
    public function usageInfo(Request $request) {

        $mAccounts = new AccountsModel();
        $mWorkflow = new WorkflowModel();

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $usageID = strip_tags($request->id);
        if (empty($usageID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $oUsage = $mAccounts->getUsageDetails($usageID, $userID);
        $mediaType = '';
        $mediaExt = '';
        $encodedContent = base64_decode($oUsage->content);
        $msgExplode = explode('/', $encodedContent);
        if(count($msgExplode) > 6 && count($msgExplode) == 10) {
            $mm_id = $msgExplode[7];
            $msg_sid = $msgExplode[9];
            $oTwilioDetails = getTwilioAccount($oUsage->spend_to);

            $sid = $oTwilioDetails->account_sid;
            $token = $oTwilioDetails->account_token;
            $client = new Client($sid, $token);
            $media = $client->messages($mm_id)
                    ->media($msg_sid)
                    ->fetch();
            $contentExplode = explode('/', $media->contentType);
            $mediaType = $contentExplode[0];
            $mediaExt = $contentExplode[1];
        }


        $usagetype = ucfirst($oUsage->usage_type);
        $spentto = (strtolower($usagetype) == 'sms' || strtolower($usagetype) == 'mms') ? phoneNoFormat($oUsage->spend_to) : $oUsage->spend_to;
        $chargedcredits = $oUsage->balance_deducted;
        $chargedate = dataFormat($oUsage->created);
        $moduleName = $oUsage->module_name;
        $moduleUnitID = $oUsage->module_unit_id;
        $campaignTitle = '';
        $campaignLink = '';
        if(!empty($moduleName) && !empty($moduleUnitID)){
            $oCampaign = $mWorkflow->getModuleUnitInfo($moduleName, $moduleUnitID);
            if($moduleName == 'onsite' || $moduleName == 'offsite' || $moduleName == 'brandboost'){
                $campaignTitle = $oCampaign->brand_title;
                $campaignLink = base_url()."admin/brandboost/details/".$moduleUnitID;

            }else if($moduleName == 'autoamtion' || $moduleName == 'broadcast' || $moduleName == 'nps' || $moduleName == 'referral'){
                $campaignTitle = $oCampaign->title;
                if($moduleName == 'automation'){
                    $campaignLink = base_url()."admin/modules/emails/setupAutomation/".$moduleUnitID;
                }else if($moduleName == 'broadcast'){
                    $campaignLink = base_url()."admin/broadcast/edit/".$moduleUnitID;
                }else if($moduleName == 'nps'){
                    $campaignLink = base_url()."admin/modules/nps/setup/".$moduleUnitID;
                }else if($moduleName == 'referral'){
                    $campaignLink = base_url()."admin/modules/referral/setup/".$moduleUnitID;
                }


            }
        }

        $preparedCampaignLink = (!empty($campaignLink)) ? '<a href="'.$campaignLink.'" target="_blank">'.$campaignTitle.'</a>' : $campaignTitle;

        $response = array('status' => 'success', 'content'=> $encodedContent,  'usagetype'=> $usagetype, 'spentto'=>$spentto,  'chargedate' => $chargedate, 'chargedcredits'=>$chargedcredits, 'usagemodulename'=> $moduleName, 'usagecampaignLink' => $preparedCampaignLink, 'msg' => "Record deleted successfully!","mediaType" => $mediaType, 'mediaExt'=>$mediaExt);

        echo json_encode($response);
        exit;
    }

}
