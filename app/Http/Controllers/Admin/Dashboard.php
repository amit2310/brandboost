<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\DashboardModel;
use Cookie;
use Session;

class Dashboard extends Controller {

    //
    /**
     * Used to display client's dashboard data
     */
    public function index($userID = '') {
        if (empty($userID)) {
            $oUser = getLoggedUser();
            $userID = $oUser->id;
        }
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="" class="sidebar-control active hidden-xs " data-original-title="Dashboard">Dashboard</a></li>
                    </ul>';
        $aData = array(
            'title' => 'Brand Boost Profile',
            'pagename' => $breadcrumb,
            'userDetail' => $oUser
            
        );
        return view('admin.dashboard');
        //redirect('admin.dashboard', $aData);
        die;

        $bbStatsData = $this->mmBrandboost->getBBStatsByIdAndUserId($userID, $bbId = '');

        //$userDetail = getUserDetail($userID);
        //pre($userDetail);
        //die();

        $subscriptionID = $oUser->plan_id;
        $topupSubscriptionID = $oUser->topup_plan_id;

        if (!empty($subscriptionID)) {
            $oMembershipData = $this->mMembership->getMembershipInfo($subscriptionID);
        }

        if (!empty($topupSubscriptionID)) {
            $oMembershipTopupData = $this->mMembership->getMembershipInfo($topupSubscriptionID);
        }

        $oCurrentUsage = $this->mDashboard->getUserData($userID);

        $campType = 'Email';
        $getCampEmail = $this->mmBrandboost->getEmailSms($campType, $userID);
        $campType = 'SMS';
        $getCampSms = $this->mmBrandboost->getEmailSms($campType, $userID);

        //$userData = $this->mDashboard->getUserData($userID);
        //$membershipData = $this->mMembership->getMembershipInfo($userData[0]->subscription_plan_id);



        $aBrandboostList = $this->mmBrandboost->getBrandboostByUserId($userID, 'onsite');
        $aBrandboostOffsiteList = $this->mmBrandboost->getBrandboostByUserId($userID, 'offsite');
        $emailFooterData = $this->mDashboard->getEmailFooterData($userID);
        $emailFooterData = base64_decode($emailFooterData[0]->footer_content);
        $aData = array(
            'title' => 'Brand Boost Profile',
            'pagename' => $breadcrumb,
            'userDetail' => $oUser,
            'onsiteList' => $aBrandboostList,
            'offsiteList' => $aBrandboostOffsiteList,
            'getCampEmail' => $getCampEmail,
            'getCampSms' => $getCampSms,
            'membershipData' => $oMembershipData,
            'oMembershipTopupData' => $oMembershipTopupData,
            'emailFooterData' => $emailFooterData,
            'bbStatsData' => $bbStatsData,
            'userData' => $oCurrentUsage[0]
        );

        $this->template->load('admin/admin_template_new', 'admin/dashboard', $aData);
    }

}
