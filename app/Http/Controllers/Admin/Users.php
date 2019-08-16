<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\UsersModel;
use App\Models\Admin\Twillio_model;


class Users extends Controller
{

    
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
                $Users  = new UsersModel();

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
        $Users  = new UsersModel();
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
