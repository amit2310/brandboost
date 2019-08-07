<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Modules\ReferralModel;
use Session;

class Referral extends Controller {

    /**
     * Referral Index function
     *
     */
    public function Index() {
		
		$response = array();
        $aUInfo = getLoggedUser();
        $userID = $aUInfo->id;
        $mReferral = new ReferralModel();
        
    	$referralData = $mReferral->getReferralDataBySId($userID);

		$aPageData = array(
            'referralData' => $referralData
        );

    	return view('user.referral', $aPageData);
    }
	
	public function updateReferralUser() {
		$aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $status = $post['status'];
        $referralId = $post['referral_id'];

        if ($referralId != '') {
            $aData = array(
                'status' => $status
            );

            $bResponse = $this->mReferral->updateReferralUser($aData, $referralId);
			$response = array('status' => 'success');
        }else{
			$response = array('status' => 'error');
		}
		
        echo json_encode($response);
        exit;
    }
	
	public function reports($referralID) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($referralID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($referralID);
            if (!empty($oSettings)) {
                $accountID = $oSettings->hashcode;
                $oRefPurchased = $this->mReferral->referredSales($accountID);
                //pre($oRefPurchased);
                //die;
                $oUntrackedPurchased = $this->mReferral->untrackedSales($accountID);

                if (!empty($oRefPurchased)) {
                    foreach ($oRefPurchased as $row) {
                        $referredAmount = $referredAmount + $row->amount;
                    }
                }

                if (!empty($oUntrackedPurchased)) {
                    foreach ($oUntrackedPurchased as $row2) {
                        $untrackedAmount = $untrackedAmount + $row2->amount;
                    }
                }

                $oRefVisits = $this->mReferral->getReferralLinkVisits($accountID);
                $oTotalReferralSent = $this->mReferral->getStatsTotalSent($referralID);
                $oTotalReferralTwillio = $this->mReferral->getStatsTotalTwillio($referralID);
            }

           
            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral') . '" data-toggle="tooltip" data-placement="bottom" title="Referral Module" class="sidebar-control hidden-xs ">Referral Modules</a></li>
						<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" title="'.$oSettings->title.' Report" class="sidebar-control active hidden-xs ">'.$oSettings->title.' Report</a></li>
                    </ul>';

            $data = array(
                'title' => 'Referral Report',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings,
                'oRefPurchased' => $oRefPurchased,
                'referredAmount' => $referredAmount,
                'oRefVisits' => $oRefVisits,
                'untrackedAmount' => $untrackedAmount,
                'oUntrackedPurchased' => $oUntrackedPurchased,
                'oTotalReferralSent' => $oTotalReferralSent,
                'oTotalReferralTwillio' => $oTotalReferralTwillio
            );

            $this->template->load('user/user_template', 'user/reports', $data);
        }
    }

}
?>