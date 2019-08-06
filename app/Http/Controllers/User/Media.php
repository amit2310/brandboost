<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use Session;

class Media extends Controller {

    public function Index() {

    	$aUser = getLoggedUser();
        $userID = $aUser->id;
        $mReviews = new ReviewsModel();
        $oReviews = $mReviews->getUserReviews($userID);
        $aData = array(
        	'myReview' => $oReviews
        );

    	return view('user.media', $aData);
    }

}
?>