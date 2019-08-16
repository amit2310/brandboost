<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\UsersModel;
use App\Models\Admin\Twillio_model;

class Users extends Controller {

    /**
     * controller index call 
     * @return type 
     */
    public function index() {
        $isAdmin = false;
        $oUser = getLoggedUser();
        $user_role = $oUser->user_role;
        if (!empty($user_role) && $user_role == 1) {
            $isAdmin = true;
        } else {
            redirect('/admin');
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Admin</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/users') . '">Users</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                </ul>';
        $Users = new UsersModel();

        $data = array(
            'title' => 'Brand Boost Users',
            'pagename' => $breadcrumb,
            'usersdata' => $Users->getAllUsers(),
            'isAdmin' => $isAdmin
        );

        return view('admin.users.index', $data);
    }

    /**
     * Update user record
     * @return type 
     */
    public function updateUserData() {

        $fieldName = Input::post("fieldName");
        $userId = Input::post("userId");
        $aData = array(
            $fieldName => 0
        );
        $mUser = new UsersModel();
        $result = $mUser->updateUsers($aData, $userId);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * This function is used to Update the status of the user active/deactive
     * @return type 
     */
    public function update_status() {

        $response = array();
        $post = Input::post();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($post) {

            $status = strip_tags($post['status']);
            $userId = strip_tags($post['user_id']);
            $Users = new UsersModel();

            $aData = array(
                'status' => $status
            );
            if (!empty($user_role) && $user_role == 1) {
                $result = $Users->updateUsers($aData, $userId);
            }

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
     * This function is used to delete the user from the system 
     * @return type 
     */
    public function user_delete() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if (Input::post()) {
            $post = Input::post();
            $Users = new UsersModel();

            $userID = strip_tags($post['userID']);
            /* $contactID = strip_tags($post['contactID']);
              if($contactID != ''){
              $this->mInfusion->deleteContact($contactID);
              } */
            if (!empty($user_role) && $user_role == 1) {
                $result = $Users->deleteUsers($userID);
            }

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "User has been deleted successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
     * This function is used to fetch the userdetails on the behalf of user id
     * @return type 
     */
    public function getUserById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        $Users = new UsersModel();
        if (Input::post()) {
            $post = Input::post();
            $aUsers = $Users->getAllUsers($post['userID']);
            if ($aUsers) {
                $response['status'] = 'success';
                $response['result'] = $aUsers;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    
    /**
     * Check if email already exists
     */
    public function checkEmailExist(Request $request) {
        $mUsers = new UsersModel();

        $response = array();
        
        if (!empty($request)) {
            
            $result = $mUsers->checkEmailExist($request->emailID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = $result;
            } else {
                $response['status'] = 'error';
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }
    
    public function twiliomessage($userID) {

        $mTwillio = new Twillio_model();
        $getTwillioByUser = $mTwillio->getTwillioByUser($userID);
        $result = $getTwillioByUser[0];
        $sid = $result->account_sid;
        $token = $result->account_token;
        $contact_sid = $result->contact_sid;
        $contact_no = $result->contact_no;

        $client = new Client($sid, $token);

        return view('admin.users.twilio.index', array('result' => $result, 'client' => $client));
    }

    public function getUserInfo() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $userID = strip_tags($post['uid']);
            $oUsers = $this->Users->getUserInfo(base64_url_decode($userID));

            if ($oUsers) {
                $response['status'] = 'success';
                $response['datarow'] = $oUsers;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function contacts() {
        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                    <li class="active">Contacts</li>
                </ul>';

        $data = array(
            'title' => 'Contacts',
            'pagename' => $breadcrumb,
            'usersdata' => $this->Users->getAllUsers()
        );

        $this->template->load('admin/admin_template_new', 'admin/users/index', $data);
    }

    public function userduplicate() {
        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                    <li class="active">Users</li>
                </ul>';

        $data = array(
            'title' => 'Brand Boost Users',
            'pagename' => $breadcrumb,
            'usersdata' => $this->Users->getAllUsers()
        );

        $this->template->load('admin/admin_template_new', 'admin/users/userduplicate', $data);
    }

    public function user_update() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($this->input->post()) {
            $post = $this->input->post();

            $firstname = strip_tags($post['firstname']);
            $lastname = strip_tags($post['lastname']);
            $phone = strip_tags($post['phone']);
            $zip = strip_tags($post['zip']);
            $userID = strip_tags($post['userID']);
            $twilioStatus = strip_tags($post['e_twilio_status']);
            $contactId = strip_tags($post['e_infusion_user_id']);

            $userData = $this->Users->getAllUsers($userID);
            $accountSid = $userData[0]->twilio_subaccount_sid;
            $aData = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $phone,
                'zip_code' => $zip,
                    //'twilio_subaccount_status'  => $twilioStatus
            );

            /* if($accountSid != ''){
              $twilioResult = updateTwilioStatus($accountSid, $twilioStatus);
              } */
            //pre($twilioResult);

            if (!empty($user_role) && $user_role == 1) {
                $result = $this->Users->updateUsers($aData, $userID);
            }

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "User has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function deleteUsers() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($this->input->post()) {
            $post = $this->input->post();

            $userIDs = $post['multipal_record_id'];
            if (!empty($user_role) && $user_role == 1) {
                foreach ($userIDs as $userID) {
                    $result = $this->Users->deleteUsers($userID);
                }
            }
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function deleteUsersContact() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $userIDs = $post['multipal_record_id'];

            foreach ($userIDs as $userID) {
                $result = $this->Users->deleteUsers($userID);
            }

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function user_add() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($this->input->post()) {
            $post = $this->input->post();

            $firstname = strip_tags($post['firstname']);
            $lastname = strip_tags($post['lastname']);
            $email = strip_tags($post['email']);
            $phone = strip_tags($post['phone']);
            $zip = strip_tags($post['zip']);

            $aInfusionData = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                //'country' => $country,
                'phone' => $phone,
                'zip' => $zip
            );

            $infusionUserID = $this->mInfusion->createContact($aInfusionData);

            $aData = array(
                'infusion_user_id' => $infusionUserID,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'created' => date("Y-m-d H:i:s"),
                'user_role' => '2',
                'mobile' => $phone,
                'zip_code' => $zip,
                'status' => 1
            );

            if (!empty($user_role) && $user_role == 1) {
                $result = $this->Users->addUsers($aData);
            }
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "User has been add successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function Sendgriddata($userID) {
        $userData = $this->Users->getUserAllData($userID);
        $sendGridData = $this->mSendgrid->getSendGridData($userData->sg_username, $userData->sg_password, date('Y-m-d', strtotime($userData->created)));
        $sendGridULD = $this->mSendgrid->getSGLoginDetails($userID);
        $this->template->load('admin/admin_template', 'admin/users/sendgrid/index', array('sendGridULD' => $sendGridULD, 'sendGridData' => $sendGridData));
    }

    

    public function createSendGridSA() {
        $response = array();
        $post = $this->input->post();
        if ($post) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randstring = '';
            for ($i = 0; $i < 8; $i++) {
                $randstring .= $characters[rand(0, strlen($characters))];
            }
            $userID = strip_tags($post['user_id']);
            $username = 1000000 + $userID . '@brandboost.io';
            $ip = "168.245.71.20";
            $password = $randstring;
            createSendGridSubAccount($username, $email, $password, $ip);

            $response['status'] = 'success';
        }
        echo json_encode($response);
        exit;
    }

    public function createTwilioAccount() {
        $response = array();
        $post = $this->input->post();
        if ($post) {
            $userID = strip_tags($post['user_id']);
            $username = 1000000 + $userID . '@brandboost.io';
            $userData = $this->Users->getUserTwilioData($userID);
            if ($userData->user_id == '') {
                $twilioSubAccountData = createTwilioSA($userID, $username);
                $twilioData = json_decode($twilioSubAccountData);

                if ($twilioData->sid != '') {
                    $data = array('account_sid' => $twilioData->sid, 'account_token' => $twilioData->authToken, 'user_id' => $userID, 'account_status' => 'active', 'created' => date("Y-m-d H:i:s"));
                    $this->Users->addUserTwilioData($data);

                    $response['status'] = 'success';
                }
            }
        }
        echo json_encode($response);
        exit;
    }


     
        /**
        * This function is used to fetch the userdetails on the behalf of user id
        * @return type 
        */

        public function getUserInfo() {
        
        $response = array();
        $response['status'] = 'error';
        $post = array();
        if (Input::post()) {
            $post = Input::post();
            $userID = strip_tags($post['uid']);
            $Users = new UsersModel();
            $oUsers = $Users->getUserInfo(base64_url_decode($userID));
           
            
            if ($oUsers) {
                $response['status'] = 'success';
                $response['datarow'] = $oUsers;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }


}
