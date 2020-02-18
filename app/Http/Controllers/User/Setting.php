<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use App\Models\Admin\UsersModel;
use Session;

class Setting extends Controller {

    /**
     * Setting Index function
     *
     */
    public function Index() {

    	$aUInfo = getLoggedUser();
        $userID = $aUInfo->id;

        $aBreadcrumb = array(
            'Home' => '#/',
            'My Setting' => '#/user/setting'
        );

        $aData = array(
            'title' => 'My Setting',
            'breadcrumb' => $aBreadcrumb,
        	'aUInfo' => $aUInfo
        );

    	//return view('user.setting', $aData);
        return $aData;
    }


    /**
     * This function is use for update profile
     *
     */
    public function updateProfile(Request $request) {

        $response = array();
        $aUInfo = getLoggedUser();
        $userID = $aUInfo->id;
        $avatar = $request->avatar;

        if(!empty($avatar)) {
            $aData = array(
                'avatar' => $avatar
            );
        }
        $mUsers = new UsersModel();
        $result = $mUsers->updateUsers($aData, $userID);
        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }


    /**
     * This function is use for update user name
     *
     */
    public function changeUsername(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($request->username)) {


            $userName = explode(" ",$request->username);

            if(!empty($userName[0])) {
                $firstname = $userName[0];
            }

            $lastname = '';
            if(!empty($userName[1])) {
                $lastname = $userName[1];
            }

            $aData = array(
                'firstname' => $firstname,
                'lastname' => $lastname
            );
            $mUsers = new UsersModel();
            $updateUsername = $mUsers->updateUsers($aData, $userID);

            if($updateUsername) {
                $response['status'] = 'success';
                $response['msg'] = 'Username has been changed successfully.';
            }
            else {
                $response['status'] = 'error';
                $response['msg'] = 'Error: Something went wrong, try again';
            }


            echo json_encode($response);
            exit;
        }

    }


    /**
     * This function is use for update user phone
     *
     */
    public function changeUserphone(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($request->userphone)) {

            $userphone = $request->userphone;

            $aData = array(
                'mobile' => $userphone
            );

            $mUsers = new UsersModel();
            $updateUserphone = $mUsers->updateUsers($aData, $userID);

            if($updateUserphone) {
                $response['status'] = 'success';
                $response['msg'] = 'Phone number has been changed successfully.';
            }
            else {
                $response['status'] = 'error';
                $response['msg'] = 'Error: Something went wrong, try again';
            }

            echo json_encode($response);
            exit;
        }
    }

}
?>
