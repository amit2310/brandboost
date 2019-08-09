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
	
    
     /**
     * get Nps reports
     * @param type $npsId
     */
	public function Reports($npsId) {
		$response = array();
        $aUInfo = getLoggedUser();
        $userID = $aUInfo->id;
        $mNPS = new NpsModel();

		$npsReportData = $mNPS->getNPSScoreByUserId($npsId);
        $totalEmailSent = '';
        $totalSmsSent = '';

		$aPageData = array(
            'totalEmailSent' => $totalEmailSent,
            'npsReportData' => $npsReportData,
            'totalSmsSent' => $totalSmsSent
        );

    	return view('user.nps_reports', $aPageData);
		
	}

}
?>