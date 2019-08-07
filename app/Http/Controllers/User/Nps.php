<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Modules\NpsModel;
use Session;

class Nps extends Controller {

    /**
     * NPS Index function
     *
     */
    public function Index() {

    	$response = array();
        $aUInfo = getLoggedUser();
        $userID = $aUInfo->id;
        $mNPS = new NpsModel();

    	if (!empty($userID)) {
            $oFeedback = $mNPS->getNPSScoreByUserId($userID);
        }else{
			$oFeedback = $mNPS->getNPSScoreByUserId();
		}

		$aPageData = array(
            'oFeedbacks' => $oFeedback
        );

    	return view('user.nps', $aPageData);
    }
	
	public function reports($npsId) {
		$response = array();
        $aUInfo = getLoggedUser();
        $userID = $aUInfo->id;
		
		$npsReportData = $this->mNPS->getNPSScoreByUserId($npsId);
		
		$aPageData = array(
            'npsReportData' => $npsReportData
        );

    	$this->template->load('user/user_template', 'user/nps_reports', $aPageData);
		
	}

}
?>