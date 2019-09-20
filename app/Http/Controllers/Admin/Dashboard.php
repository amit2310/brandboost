<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\DashboardModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\MembershipModel;
use App\Models\ReviewsModel;
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
        $oMembershipData = array();
        $oMembershipTopupData  = array();
        $mBrandboost = new BrandboostModel();
        $mMembership = new MembershipModel();
        $mDashboard = new DashboardModel();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="" class="sidebar-control active hidden-xs " data-original-title="Dashboard">Dashboard</a></li>
                    </ul>';

        $bbStatsData = $mBrandboost->getBBStatsByIdAndUserId($userID, $bbId = '');

        if(isset($oUser->plan_id))
        {
            $subscriptionID = $oUser->plan_id;
        }
        else
        {
            $subscriptionID='';
        }

        if(isset($oUser->topup_plan_id))
        {
            $topupSubscriptionID = $oUser->topup_plan_id;
        }
        else
        {
            $topupSubscriptionID ='';
        }




        if (isset($subscriptionID)) {
            $oMembershipData = $mMembership->getMembershipInfo($subscriptionID);
        }

        if (isset($topupSubscriptionID)) {
            $oMembershipTopupData = $mMembership->getMembershipInfo($topupSubscriptionID);
        }

        $oCurrentUsage = $mDashboard->getUserData($userID);

        $campType = 'Email';
        $getCampEmail = $mBrandboost->getEmailSms($campType, $userID);
        $campType = 'SMS';
        $getCampSms = $mBrandboost->getEmailSms($campType, $userID);

        $aBrandboostList = BrandboostModel::getBrandboostByUserId($userID, 'onsite');

        $aBrandboostOffsiteList = BrandboostModel::getBrandboostByUserId($userID, 'offsite');


        $emailFooterData = $mDashboard->getEmailFooterData($userID);
        if (!empty($emailFooterData[0])) {
            $emailFooterData = base64_decode($emailFooterData[0]->footer_content);
        }

        $aData = array(
            'title' => 'Dashboard',
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
        return view('admin.dashboard', $aData);
    }


    /**
     * Gets filtered Reviews of a member
     * @param Request $request
     */
    public function getReviewData(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $response = array();
        if (!empty($request)) {
            $draw = $request->draw;
            $start = $request->start;
            $rowperpage = $request->length;
            $columnIndex = $request->order[0]['column'];
            $columnName = $request->columns[$columnIndex]['data'];
            $columnSortOrder = $request->order[0]['dir'];
            $searchValue = $request->search['value'];
            $mReviews = new ReviewsModel();
            $totalData = $mReviews->getMyReviews($userID);
            $totalRecords = count($totalData);

            $searchRecord = $mReviews->getMyReviewsByFilter($userID, $searchValue);
            $totalRecordwithFilter = count($searchRecord);

            $reviewsData = $mReviews->getMyReviewsByFilter($userID, $searchValue, $columnName, $columnSortOrder, $start, $rowperpage);

            $data = array();

            foreach ($reviewsData as $row) {
                $data[] = array(
                    "review_title" => $row->review_title,
                    "ratings" => $row->ratings,
                    "brand_title" => $row->brand_title,
                    "created" => $row->created,
                    "action" => ''
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => count($reviewsData),
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => $data
            );

            echo json_encode($response);
        }
    }

}
