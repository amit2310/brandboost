<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use Session;

class Setting extends Controller {

    /**
     * Setting Index function
     *
     */
    public function Index() {

    	$aUInfo = getLoggedUser();
        $userID = $aUInfo->id;

        $aData = array(
        	'aUInfo' => $aUInfo
        );

    	return view('user.setting', $aData);
    }

    public function updateProfile() {

        $response = array();
        $aUInfo = getLoggedUser();
        $userID = $aUInfo->id;
        $post = $this->input->post();
        $avatar = $post['avatar'];
      
        if(!empty($avatar)) {
            $aData = array(
                'avatar' => $avatar
            );
        }

        $result = $this->mUsers->updateUsers($aData, $userID);
        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

}
?>