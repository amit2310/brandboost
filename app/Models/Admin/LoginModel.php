<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class LoginModel extends Model {

    //
    /**
     * Authorizing Login
     *
     * @param type $loginid
     * @param type $password
     * @param type $remember
     * @return User object
     */
    public function verifyAdminUser($loginid, $password, $remember) {

        $response = false;
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $pwd = base64_encode($password . $password_hash . $siteSalt);

        if ($remember == '1') {
            $brand_loginid = array(
                'name' => 'b_username',
                'value' => $loginid,
                'expire' => '86500',
            );

            $brand_loginpwd = array(
                'name' => 'b_password',
                'value' => $password,
                'expire' => '86500',
            );

            $brand_loginrem = array(
                'name' => 'b_remember',
                'value' => $remember,
                'expire' => '86500',
            );
        } else {
            $brand_loginid = array(
                'name' => 'b_username',
                'value' => '',
                'expire' => '-86500',
            );

            $brand_loginpwd = array(
                'name' => 'b_password',
                'value' => '',
                'expire' => '-86500',
            );

            $brand_loginrem = array(
                'name' => 'b_remember',
                'value' => $remember,
                'expire' => '-86500',
            );
        }

        Cookie::make($brand_loginid['name'], $brand_loginid['value'], $brand_loginid['expire']);
        Cookie::make($brand_loginpwd['name'], $brand_loginpwd['value'], $brand_loginpwd['expire']);
        Cookie::make($brand_loginrem['name'], $brand_loginrem['value'], $brand_loginrem['expire']);

        $user = DB::table('tbl_users')
                ->where('email', $loginid)
                ->where('password', $pwd)
                ->where('deleted_status', 0)
                ->first();

        if (!empty($user)) {

            if ($user->user_role == 1) {
                Session::put('admin_user_id', $user->id);
                Session::put('current_user_id', $user->id);
                Session::put('current_user_role', 1);
            } else if ($user->user_role == 2) {
                Session::put('user_user_id', $user->id);
                Session::put('current_user_id', $user->id);
                Session::put('current_user_role', 2);
            } else if ($user->user_role == 3) {
                Session::put('customer_user_id', $user->id);
                Session::put('current_user_id', $user->id);
                Session::put('current_user_role', 3);
            } else {
                //do nothing
            }
        } else {
            //Check for the team member login
            $user = $this->validateTeamMember($loginid, $pwd);
        }

        return $user;
    }

    /**
     * Authorizing Team member login
     *
     * @param type $email
     * @param type $password
     * @return user Object
     */
    public function validateTeamMember($email, $password) {
        $client = '';
        if (!empty($email) && !empty($password)) {
            $user = DB::table('tbl_users_team')
                    ->where('email', $email)
                    ->where('password', $password)
                    ->first();

            if (!empty($user)) {
                $parentUserID = $user->parent_user_id;
                if ($parentUserID > 0) {
                    $client = DB::table('tbl_users')
                            ->where('id', $parentUserID)
                            ->first();
                    if (!empty($client)) {
                        Session::put('admin_user_id', $client->id);
                        Session::put('current_user_id', $client->id);
                        if ($client->user_role == 1) {
                            Session::put('current_user_role', 1);
                        } else if ($client->user_role == 2) {
                            Session::put('current_user_role', 2);
                        } else if ($client->user_role == 3) {
                            Session::put('current_user_role', 3);
                        } else {
                            //nothing
                        }
                    }
                    //All Set. Now set the session for team member
                    Session::put('team_user_id', $user->id);
                    return $client;
                }
            }
        }
        return $client;
    }

    /**
     * Stores login history of users
     *
     * @param type $userId
     * @param type $platform_device
     * @return boolean
     */
    public function saveUserHistory($userId, $platform_device) {

        $getBrowserN = getBrowserN();

        $aData = array(
            'user_id' => $userId,
            'ip_address' => getIP(),
            'platform' => $getBrowserN['platform'],
            'browser' => $getBrowserN['name'],
            'device' => $platform_device,
            'created' => date("Y-m-d H:i:s")
        );
        $result = DB::table('tbl_login_history')->insert($aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * update increase counter each time when user login, used for determining whether or not display upgrade popup
     *
     * @param type $userID
     * @param type $dataArray
     * @return boolean
     */
    public function updateUserData($userID, $dataArray) {
        $result = DB::table('tbl_users')
                ->where('id', $userID)
                ->update($dataArray);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Check whether user has S3 bucket or not
     *
     * @return boolean
     */
    public function checkS3server() {

        $userid = Session::get('customer_user_id');
        if (!empty($userid)) {
            $user = DB::table('tbl_users')
                    ->where('id', $userid)
                    ->where('s3_bucket', '0')
                    ->first();
            if ($user) {
                return true;
            }
        }
        return false;
    }

    /**
     * Update to ensure user folder created in the S3 bucket
     *
     * @return boolean
     */

    public function updateS3server() {

        $userid = Session::get('customer_user_id');
        if (!empty($userid)) {
            $data = [
                's3_bucket' => '1',
            ];
            $result = DB::table('tbl_users')
                    ->where('id', $userid)
                    ->update($data);
        }
        return true;
    }

    /**
     * This function is use for update password
     *
     * @return boolean
     */
    public function ChangePassword($oldPassword, $newPassword, $rePassword) {
        $response = false;
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $oldPassword = base64_encode($oldPassword . $password_hash . $siteSalt);
        $newPassword = base64_encode($newPassword . $password_hash . $siteSalt);
        $userID = '';
        if (Session::get('admin_user_id')) {
            $userID = Session::get('admin_user_id');
        } else if (Session::get('customer_user_id')) {
            $userID = Session::get('customer_user_id');
        } else if (Session::get('user_user_id')) {
            $userID = Session::get('user_user_id');
        } else {
            redirect('/admin/login');
        }

        $user = DB::table('tbl_users')
                    ->where('password', $oldPassword)
                    ->where('id', $userID)
                    ->first();

        if(!empty($user)) {
            $aData = array(
                'password' => $newPassword
            );

            $result = DB::table('tbl_users')
                    ->where('id', $userID)
                    ->update($aData);
            $response = true;
        }

        return $response;
    }

    public function lastLoginDetail($userId, $aData) {
        $response = false;
        $this->db->where('id', $userId);
        $result = $this->db->update('tbl_users', $aData);
        //echo $this->db->last_query(); exit;

        if ($result) {
            $response = true;
        }

        return $response;
    }

    public function checkAdminUser() {
        $response = false;
        $userid = $this->session->userdata('admin_user_id');
        if (!empty($userid)) {
            $result = $this->db->get_where("tbl_users", array('id' => $userid));
            $response = $result->row();
        }
        return $response;
    }

    /* public function ForgotPassword($emailAddress) {
      $response = false;
      $this->db->from('tbl_users');
      $this->db->where('email', $emailAddress);
      $this->db->limit(1);
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
      $user = $query->row();
      sendEmailTemplate('forgot-password', $user->id);
      $response = true;
      }
      return $response;
      } */

    /*public function ForgotPassword($emailAddress) {
        $user = false;
        $this->db->from('tbl_users');
        $this->db->where('email', $emailAddress);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $user = $query->row();
        }
        return $user;
    }*/

    public function ForgotPassword($emailAddress) {
        $user = false;
        $user = DB::table('tbl_users')
            ->where('email', $emailAddress)
            ->first();
        if (!empty($user)) {
            $user = true;
        }
        return $user;
    }



    public function ChangePasswordAdmin($oldPassword, $newPassword, $rePassword, $userID) {
        $response = false;
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $oldPassword = base64_encode($oldPassword . $password_hash . $siteSalt);
        $newPassword = base64_encode($newPassword . $password_hash . $siteSalt);

        if (empty($userID)) {
            redirect('/admin/login');
        }

        $aData = array(
            'password' => $newPassword
        );
        $this->db->where('id', $userID);
        $result = $this->db->update('tbl_users', $aData);
        //echo $this->db->last_query(); exit;

        $response = true;
        sendEmailTemplate('reset-password', $userID);
        return $response;
    }

    public function ChangePasswordReset($newPassword, $userID) {
        $response = false;
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $newPassword = base64_encode($newPassword . $password_hash . $siteSalt);

        if (empty($userID)) {
            redirect('/admin/login');
        }

        $aData = array(
            'password' => $newPassword
        );
        $this->db->where('id', $userID);
        $result = $this->db->update('tbl_users', $aData);
        //echo $this->db->last_query(); exit;

        $this->db->from('tbl_users');
        $this->db->where('id', $userID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $user = $query->row();
        }
        return $user;
    }

}
