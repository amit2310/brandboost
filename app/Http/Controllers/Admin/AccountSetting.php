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
        else {

            $aData = array(
                'title' => 'Brand Boost Profile',
                'pagename' => $breadcrumb,
                'userDetail' => $userDetail,
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

            return view('admin.account_setting', $aData);
        }
        
    }
}
