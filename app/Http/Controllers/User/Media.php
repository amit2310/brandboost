<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use Session;

class Media extends Controller {

    /**
     * Media Index function
     *
     */
    public function Index() {

    	$aUser = getLoggedUser();
        $userID = $aUser->id;
        $mReviews = new ReviewsModel();
        $oReviews = $mReviews->getUserReviews($userID);

        $aBreadcrumb = array(
            'Home' => '#/',
            'My Media' => '#/user/media'
        );

        foreach ($oReviews as $key => $value) {
            $media_url = $value->media_url;
            if (!empty($media_url)) {
                $value->media_url = unserialize($media_url);
            }
        }

        $aData = array(
            'title' => 'My Media',
            'breadcrumb' => $aBreadcrumb,
        	'myReview' => $oReviews
        );

    	//return view('user.media', $aData);
        echo json_encode($aData);
        exit();
    }

}
?>
