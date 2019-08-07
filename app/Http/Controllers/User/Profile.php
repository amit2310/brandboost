<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use Session;
use App\Libraries\Custom\Mobile_Detect;

class Profile extends Controller {

    /**
     * Profile Index function
     *
     */
    public function Index() {

    	$aUInfo = getLoggedUser();
        $userID = $aUInfo->id;

        $mReviews = new ReviewsModel();
        $oReviews = $mReviews->getUserReviews($userID);

        $aData = array(
        	'aUInfo' => $aUInfo,
        	'oReviews' => $oReviews
        );

    	return view('user.profile', $aData);
    }

}
?>