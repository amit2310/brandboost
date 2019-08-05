<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LoginModel;
use Cookie;
use Session;
use App\Libraries\Custom\Mobile_Detect;


class Login extends Controller {


    /**
     * Authorizing User member login
     *
     * @return user Object
     */
    public function index(Request $request) {

        $detect = new Mobile_Detect;
        $mLogin = new LoginModel();
        if ($detect->isMobile())
        {
            $platform_device = "Mobile";
        }
        else
        {
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
       /* pre($loginType);
        die();*/

         $response = array();
        $loginid = (isset($request->email) && !empty($request->email)) ? $request->email : '';
        $password = (isset($request->password) && !empty($request->password)) ? $request->password : '';
        $remember = (isset($request->remember) && !empty($request->remember)) ? $request->remember : '';
        $checkAdminUser = $mLogin->verifyAdminUser($loginid, $password, $remember);
        
      
        if(!empty($checkAdminUser)) {
            if(!empty($checkAdminUser->id) && $checkAdminUser->id > 0) {
           
                $mLogin->saveUserHistory($checkAdminUser->id, $platform_device);
            }
            if ($checkAdminUser) {
                
                if ($checkAdminUser->user_role == '3') {
                    $loginCounterLU = $checkAdminUser->login_counter_lu + 1;
                    $loginCounterAU = $checkAdminUser->login_counter_au + 1;
                    $dataArray = array('login_counter_lu' => $loginCounterLU, 'login_counter_au' => $loginCounterAU);
                    $mLogin->updateUserData($checkAdminUser->id, $dataArray);
                    return redirect('/admin/dashboard');
                }
                else if ($checkAdminUser->user_role == '2') {
                    $loginCounterLU = $checkAdminUser->login_counter_lu + 1;
                    $loginCounterAU = $checkAdminUser->login_counter_au + 1;
                    $dataArray = array('login_counter_lu' => $loginCounterLU, 'login_counter_au' => $loginCounterAU);
                    $mLogin->updateUserData($checkAdminUser->id, $dataArray);
                    return redirect('/user/profile');
                }

               /* if ($this->session->userdata('admin_redirect_url') == '') {
                    if ($loginType == 'ajax') {
                        $response = array('status' => 'success', 'msg' => 'Successfully logged in');
                        echo json_encode($response);
                        exit;
                    } else {
                        redirect('/user/profile');
                    }
                } else {
                    if ($loginType == 'ajax') {
                        $response = array('status' => 'success', 'msg' => 'Successfully logged in');
                        echo json_encode($response);
                        exit;
                    } else {
                        redirect($this->session->userdata('admin_redirect_url'));
                    }
                }*/
            } else {

                if ($loginType == 'ajax') {
                    $response = array('status' => 'error', 'msg' => 'You are not authorised user');
                    echo json_encode($response);
                    exit;
                } else {
                    //$this->session->set_flashdata('error_message', 'You are not authorised user');
                    return view('user.login_form');
                }
            }
        }
        else {
            return view('user.login_form');
        }
        

        /*if (!empty($loginType)) {

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {

                if ($loginType == 'ajax') {
                    $response = array('status' => 'error', 'msg' => 'Not validated');
                    echo json_encode($response);
                    exit;
                } else {
                    $this->load->view('/user/login_form');
                }
            } else {

               
            }
        } else {

            if ($loginType == 'ajax') {
                $response = array('status' => 'error', 'msg' => 'Invalid access');
                echo json_encode($response);
                exit;
            } else {
                if (Session::get('admin_user_id')) {
                    return redirect('/admin/dashboard');
                } else if (Session::get('customer_user_id')) {
                    return redirect('/admin/dashboard');
                } else if (Session::get('user_user_id')) {
                    return redirect('/user/profile');
                } else {
                    return view('user.login_form', $data);
                }
            }
        }*/
    }

    public function logout() {

        $aUser = getLoggedUser();
        $aData = array('login_status' => '0');
        $this->Adminlogin->lastLoginDetail($aUser->id, $aData);
        $this->session->sess_destroy();
        redirect('../../user/login');
    }

    public function forgot_password() {
        $post = $this->input->post();
        if (!empty($post)) {
            $response = array();
            $email = (isset($post['email']) && !empty($post['email'])) ? $post['email'] : '';
            $checkAdminUser = $this->Adminlogin->ForgotPassword($email);
            if ($checkAdminUser) {
                $aData = array('userDetail'=>$checkAdminUser);
                $body = $this->load->view('admin/email_templates/general/reset_password', $aData, true);
                $subject = 'Forgot Password';
                emailTemplate($subject, $body, $checkAdminUser);

                $this->session->set_flashdata('success_message', 'Reset password link has been sent in your email.');
                //$this->load->view('/admin/login');
                redirect('/admin/login');
            } else {
                $this->session->set_flashdata('error_message', 'Your email address has been not correct. Please try again!');
                $this->load->view('/admin/forgot_password');
            }
        } else {
            $this->load->view('/admin/forgot_password');
        }
    }

    public function reset_password($userId) {
        
        $this->load->view('/admin/reset_password', array('userId'=>$userId));
    }

    public function reset_new_password() {

        $response = array();
        $post = $this->input->post();
        $newPassword = $post['newPassword'];
        $confirmPassword = $post['confirmPassword'];
        $userId = $post['userId'];
        $base_64 = $userId . str_repeat('=', strlen($userId) % 4);
        $userId = base64_url_decode($base_64);
        
        if($userId > 0) {
            $result = $this->Adminlogin->ChangePasswordReset($newPassword, $userId);
        }
     
        if ($result) {
            $response['status'] = 'success';
            $aData = array();
            $body = $this->load->view('admin/email_templates/general/reset_password_success', $aData, true);
            $subject = 'Reset Password Successfully';
            emailTemplate($subject, $body, $result);
        } else {
            $response['status'] = 'error';
            $response['message'] = "Error: Something went wrong, try again";
        }

        echo json_encode($response);
        exit;        
    }

    public function change_password() {
	
        $post = $this->input->post();

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Change Password</li>
                </ul>';
        $aData = array('title' => 'Brand Boost Change Password', 'pagename' => $breadcrumb);

        if (!empty($post)) {
            $response = array();
            $oldPassword = (isset($post['oldPassword']) && !empty($post['oldPassword'])) ? $post['oldPassword'] : '';
            $newPassword = (isset($post['newPassword']) && !empty($post['newPassword'])) ? $post['newPassword'] : '';
            $rePassword = (isset($post['rePassword']) && !empty($post['rePassword'])) ? $post['rePassword'] : '';
            if ($newPassword == $rePassword) {
                $checkPassword = $this->Adminlogin->ChangePassword($oldPassword, $newPassword, $rePassword);
                if ($checkPassword) {
                    //redirect('/admin/login');
                    $aUser = getLoggedUser();
                    $userID = $aUser->id;


                    $aActivityData = array(
                        'user_id' => $userID,
                        'event_type' => 'changed_password',
                        'action_name' => 'reset_passwored',
                        'brandboost_id' => '',
                        'campaign_id' => '',
                        'inviter_id' => '',
                        'subscriber_id' => '',
                        'feedback_id' => '',
                        'activity_message' => 'Password has been changed',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);

                    $this->session->set_flashdata('success_message', '<div class="alert-success text-center" style="margin-bottom:10px;">Your password has been changed successfully.</div>');
                    $this->template->load('admin/admin_template_new', 'admin/change_password', $aData);
                } else {
                    $this->session->set_flashdata('success_message', '<div class="alert-danger text-center" style="margin-bottom:10px;">Please enter correct old password.</div>');
                    $this->template->load('admin/admin_template_new', 'admin/change_password', $aData);
                }
            } else {
                $this->session->set_flashdata('success_message', '<div class="alert-danger text-center" style="margin-bottom:10px;">Your new password and re-enter new password are not matching. Please enter same password.</div>');
                $this->template->load('admin/admin_template_new', 'admin/change_password', $aData);
            }
        } else {
            $this->template->load('admin/admin_template_new', 'admin/change_password', $aData);
        }
    }

}
