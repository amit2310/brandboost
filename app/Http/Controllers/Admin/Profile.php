<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\DashboardModel;
use App\Models\Admin\MembershipModel;
use App\Models\Admin\TagsModel;
use App\Models\Admin\ListsModel;


class Profile extends Controller
{
    /**
     * Profile index function
     * @param type $userID
     * @return type object
     */
    public function index($userID='') {

        $aUser = getLoggedUser();
        $user_role = $aUser->user_role;

        if (empty($userID)) {
            
            $userID = $aUser->id;
        }
        $currentUserId = $userID;

        $mBrandboost = new BrandboostModel();
        $dashboard = new DashboardModel();
        $membership = new MembershipModel();
        $mTags = new TagsModel();
        $mLists = new ListsModel();

        $bbStatsData = $mBrandboost->getBBStatsByIdAndUserId($currentUserId, $bbId='');
        
        $userDetail = getUserDetail($userID);
    
        $campType = 'Email';
        $getCampEmail = $mBrandboost->getEmailSms($campType, $userID);
       
        $campType = 'SMS';
        $getCampSms = $mBrandboost->getEmailSms($campType, $userID);

        $userData = $dashboard->getUserData($userID);

        $membershipData = $membership->getMembershipInfo($userData[0]->subscription_plan_id);


        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Profile" class="sidebar-control active hidden-xs ">Profile</a></li>
                    </ul>';



        $aBrandboostList = BrandboostModel::getBrandboostByUserId($userID, 'onsite');
        $aBrandboostOffsiteList = BrandboostModel::getBrandboostByUserId($userID, 'offsite');
        $emailFooterData = $dashboard->getEmailFooterData($userID);
        if(!empty($emailFooterData[0]->footer_content)) {
            $emailFooterData = base64_decode($emailFooterData[0]->footer_content);
        }
        
        $getClientTags = $mTags->getClientTags($userID);
       
        $getMyLists = $mLists->getLists($userID);
        
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
            'bbStatsData'=> $bbStatsData, 
            'getClientTags' => $getClientTags, 
            'getMyLists' => $getMyLists,
            'oUser' => $aUser
                );

        return view('admin.profile', $aData);

        
    }
}
