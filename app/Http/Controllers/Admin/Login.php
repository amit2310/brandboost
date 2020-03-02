<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LoginModel;
use Cookie;
use Session;
use App\Libraries\Custom\Mobile_Detect;
use App\Models\Admin\WebChatModel;

//require 'aws/aws-autoloader.php';

//use Aws\S3\S3Client;
//use Aws\Exception\AwsException;

class Login extends Controller {

    /**
     * Used to login brandboost user
     *
     * @param Request $request
     * @return display login page and redirect to dashboard page after authorization
     */
    public function index(Request $request) {

        $detect = new Mobile_Detect;
        if ($detect->isMobile()) {
            $platform_device = "Mobile";
        } else {
            $platform_device = "Desktop";
        }

        $b_username = Cookie::get('b_username');
        $b_password = Cookie::get('b_password');
        $b_remember = Cookie::get('b_remember');

        $data = array(
            'b_username' => $b_username,
            'b_password' => $b_password,
            'b_remember' => $b_remember
        );

        $loginType = $request->loginrequest;
        $response = array();
        $loginid = (!empty($request->email)) ? $request->email : '';
        $password = (!empty($request->password)) ? $request->password : '';
        $remember = (!empty($request->remember)) ? $request->remember : '';

        if (!empty($loginid)) {
            //Apply validation
            $mLogin = new LoginModel();
            $checkAdminUser = $mLogin->verifyAdminUser($loginid, $password, $remember);

            if (!empty($checkAdminUser->id) && $checkAdminUser->id > 0) {
                //Save login history
                $mLogin->saveUserHistory($checkAdminUser->id, $platform_device);

                if ($checkAdminUser->user_role == '3') {
                    $loginCounterLU = $checkAdminUser->login_counter_lu + 1;
                    $loginCounterAU = $checkAdminUser->login_counter_au + 1;
                    $dataArray = array('login_counter_lu' => $loginCounterLU, 'login_counter_au' => $loginCounterAU);
                    $bUpdated = $mLogin->updateUserData($checkAdminUser->id, $dataArray);


                    if ($mLogin->checkS3server()) {

                        $s3Client = new S3Client([
                            'region' => 'us-west-2',
                            'version' => '2006-03-01',
                            'credentials' => [
                                'key' => 'AKIARIQCLTJDJHTQQM5Q',
                                'secret' => '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'
                            ],
                            // Set the S3 class to use objects.dreamhost.com/bucket
                            // instead of bucket.objects.dreamhost.com
                            'use_path_style_endpoint' => true
                        ]);

                        $res = $s3Client->putObject(array(
                            'Bucket' => 'brandboost.io', // Defines name of Bucket
                            'Key' => $checkAdminUser->id . "/", //Defines Folder name
                            'Body' => "",
                            'ACL' => 'public-read' // Defines Permission to that folder
                        ));

                        $folderName = ['onsite', 'offsite', 'automation', 'broadcast', 'referral', 'nps', 'webchat', 'smschat', 'reviews', 'questions'];

                        $subfolder = ['images', 'videos', 'files'];

                        foreach ($folderName as $value) {
                            $s3Client->putObject(array(
                                'Bucket' => 'brandboost.io', // Defines name of Bucket
                                'Key' => $checkAdminUser->id . "/" . $value . '/', //Defines Folder name
                                'Body' => "",
                                'ACL' => 'public-read' // Defines Permission to that folder
                            ));

                            foreach ($subfolder as $subvalue) {
                                $s3Client->putObject(array(
                                    'Bucket' => 'brandboost.io', // Defines name of Bucket
                                    'Key' => $checkAdminUser->id . "/" . $value . '/' . $subvalue . '/', //Defines Folder name
                                    'Body' => "",
                                    'ACL' => 'public-read' // Defines Permission to that folder
                                ));
                            }
                        }

                        $mLogin->updateS3server();
                    }
                } else if ($checkAdminUser->user_role == '2') {
                    $loginCounterLU = $checkAdminUser->login_counter_lu + 1;
                    $loginCounterAU = $checkAdminUser->login_counter_au + 1;
                    $dataArray = array('login_counter_lu' => $loginCounterLU, 'login_counter_au' => $loginCounterAU);
                    $mLogin->updateUserData($checkAdminUser->id, $dataArray);
                    return redirect('/user/profile');
                }

                if (Session::get('admin_redirect_url') == '') {
                    if ($loginType == 'ajax') {
                        $response = array('status' => 'success', 'msg' => 'Successfully logged in');
                        echo json_encode($response);
                        exit;
                    } else {
                        return redirect('/admin/');
                    }
                } else {
                    if ($loginType == 'ajax') {
                        $response = array('status' => 'success', 'msg' => 'Successfully logged in');
                        echo json_encode($response);
                        exit;
                    } else {
                        return redirect(Session::get('admin_redirect_url'));
                    }
                }
            } else {

                if ($loginType == 'ajax') {
                    $response = array('status' => 'error', 'msg' => 'You are not authorised user');
                    echo json_encode($response);
                    exit;
                } else {
                    Session::flash('error_message', 'You are not authorised user');
                    return view('admin.login_form');
                }
            }
        } else {
            return view('admin.login_form');
        }
    }

    /**
     * Used to logout brandboost user
     *
     * @param Request $request
     * @return redirect to login page
     */
    public function logout() {

        $webChatModel = new WebChatModel();
        $aUser = getLoggedUser();
        $aData = array('login_status' => '0');
        $webChatModel->lastLoginDetail($aUser->id, $aData);
        Session::flush();
        Session::regenerate(true);
        return redirect('/admin/login');
    }

}
