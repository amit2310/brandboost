<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class UsersModel extends Model {

    /**
     * 
     * get complete user information
     * @param type $id
     * @return type
     */
    public static function getUserInfo($id) {

        $oUser = DB::table('tbl_users')
                ->where('id', $id)
                ->first();
        if (!empty($oUser)) {
            $subscriptionID = $oUser->subscription_id;
            $subscriptionTopupID = $oUser->topup_subscription_id;

            $oSubscriptions = DB::table('tbl_cc_subscriptions')
                    ->where('subscription_id', $subscriptionID)
                    ->orWhere('subscription_id', $subscriptionTopupID)
                    ->get();

            if (!empty($oSubscriptions)) {
                foreach ($oSubscriptions as $oSubscription) {
                    if ($oSubscription->subscription_id == $subscriptionID) {
                        $planID = $oSubscription->plan_id;
                        $regularSubscription = $oSubscription;
                    }

                    if ($oSubscription->subscription_id == $subscriptionTopupID) {
                        $topupPlanID = $oSubscription->plan_id;
                        $topupSubscription = $oSubscription;
                    }
                }
            }

            if (!empty($planID)) {
                $oUser->plan_id = $planID;
                $oUser->regular_subscription_info = $regularSubscription;
            }

            if (!empty($topupPlanID)) {
                $oUser->topup_plan_id = $topupPlanID;
                $oUser->topup_subscription_info = $topupSubscription;
            }

            //Fetch Credit info
            $oCredits = DB::table('tbl_account_usage')
                    ->where('user_id', $id)
                    ->first();
            if (!empty($oCredits)) {
                $membershipCredits = $oCredits->credits;
                $topupCredits = $oCredits->credits_topup;
                $totalCredits = $membershipCredits + $topupCredits;
                $oCredits->total_credits = $totalCredits;
                $oUser->credits = $oCredits;
            }
        }

        return $oUser;
    }

    public function basicSignup($aData) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/chargebee-php/lib/ChargeBee.php';
        $cbSite = $this->config->item('cb_site_name');
        $cbSiteToken = $this->config->item('cb_access_token');
        ChargeBee_Environment::configure($cbSite, $cbSiteToken);
        $this->load->model("CBee_model", "ModelChargeBee");
        $this->load->model("Signup_model", "ModelSignup");
        $firstName = $aData['firstname'];
        $lastName = $aData['lastname'];
        $email = $aData['email'];
        $mobile = $aData['mobile'];
        $telExt = $aData['telExt'];
        $countryExt = $aData['countryExt'];

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 7; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        $password = strip_tags($randstring);

        $userID = $this->checkIfUser(array('email' => $email));
        if ($userID == false) {
            $aChargebeeData = array(
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email
            );
            $chargebeeUserID = $this->ModelChargeBee->createContact($aChargebeeData);

            $password_hash = $this->config->item('password_hash');
            $siteSalt = $this->config->item('siteSalt');
            $pwd = base64_encode($password . $password_hash . $siteSalt);
            $aUserData = array(
                'cb_contact_id' => $chargebeeUserID,
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'ext_code' => $telExt,
                'ext_country_code' => $countryExt,
                'mobile' => $mobile,
                'user_role' => 2,
                'status' => 1,
                'password' => $pwd,
                'created' => date("Y-m-d H:i:s")
            );
            $userID = $this->ModelSignup->addUser($aUserData);
            //Send Email Notification about registration on brandboost
            sendEmailTemplate('welcome', $userID);

            if (!empty($userID))
                return $userID;
            else
                return false;
        }
    }

    public function getAllUsers($id = '') {

        $response = array();
        if ($id > 0) {

            $this->db->where('id', $id);
        }
        $this->db->order_by('id', 'ASC');
        $this->db->where('deleted_status', 0);
        $this->db->from('tbl_users');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getCharUserList($userID, $char) {

        $response = array();
        $this->db->select("tbl_users.*");
        $this->db->join("tbl_users", "tbl_subscribers.user_id=tbl_users.id", "INNER");
        $this->db->where("tbl_subscribers.owner_id", $userID);
        $this->db->like('tbl_users.firstname', $char, 'after');
        //$this->db->where('deleted_status', 0);
        $this->db->from('tbl_subscribers');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function updateUsers($aData, $userId) {

        $this->db->where('id', $userId);
        $result = $this->db->update('tbl_users', $aData);
        //echo $this->db->last_query();exit;
        if ($result)
            return true;
        else
            return false;
    }

    public function updateTwilioUserData($aData, $userId) {

        $this->db->where('user_id', $userId);
        $result = $this->db->update('tbl_twilio_accounts', $aData);
        //echo $this->db->last_query();exit;
        if ($result)
            return true;
        else
            return false;
    }

    public function addUsers($aData) {

        $result = $this->db->insert('tbl_users', $aData);
        $userID = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        //Add entry in notification table
        $this->db->insert("tbl_users_notification_settings", array('user_id' => $userID, 'notify_email' => $aData['email']));
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteUsers($userId) {

        $this->db->where('id', $userId);
        $aData = array('deleted_status' => 1);
        $result = $this->db->update('tbl_users', $aData);

        return true;
    }

    public function checkIfUser($aParam) {
        if (!empty($aParam)) {
            $key = array_keys($aParam);
            $val = array_values($aParam);
            $this->db->where($key[0], $val[0]);
            $this->db->limit(1);
            $result = $this->db->get("tbl_users");
            //echo $this->db->last_query();
            if ($result->num_rows() > 0) {
                return $result->row()->id;
            }
        }
        return false;
    }

    public function checkIfSubscriber($aParam) {
        if (!empty($aParam)) {
            $key = array_keys($aParam);
            $val = array_values($aParam);
            $this->db->where($key[0], $val[0]);
            $this->db->limit(1);
            $result = $this->db->get("tbl_subscribers");
            //echo $this->db->last_query();
            if ($result->num_rows() > 0) {
                return $result->row()->id;
            }
        }
        return false;
    }

    public function checkIfClientSubscriber($email, $clientID) {
        $this->db->where("email", $email);
        $this->db->where("owner_id", $clientID);
        $this->db->limit(1);
        $result = $this->db->get("tbl_subscribers");
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return $result->row()->id;
        }
        return false;
    }

    public function getUserAllData($userID) {
        $response = array();
        $this->db->from('tbl_users');
        $this->db->where('tbl_users.id', $userID);
        $this->db->join('tbl_twilio_accounts', 'tbl_users.id = tbl_twilio_accounts.user_id', 'left');
        $this->db->join('tbl_sendgrid_accounts', 'tbl_users.id = tbl_sendgrid_accounts.user_id', 'left');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response[0];
    }

    public function getUserTwilioDataByPhoneNo($phoneNo) {
        $response = array();
        $this->db->from('tbl_twilio_accounts');
        $this->db->like('contact_no', $phoneNo);
        $result = $this->db->get();
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response[0];
    }

    public function checkEmailExist($emailID) {

        $response = array();
        $this->db->where('email', $emailID);
        $result = $this->db->get("tbl_users");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function user_count_all() {
        $query = $this->db->get("tbl_users");
        return $query->num_rows();
    }

    public function getAllCountries() {

        $response = array();
        $result = $this->db->get("tbl_countries");
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    function user_fetch_details($limit, $start, $sortBy, $sortType) {
        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $output = '';
        $this->db->select("tbl_users.*, tbl_invoices.subscription_plan_id, tbl_invoices.description");
        $this->db->from("tbl_users");
        $this->db->join('tbl_invoices', 'tbl_users.infusion_user_id = tbl_invoices.infusion_user_id', 'left');
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $usersdata = $result->result();
        }

        if (count($usersdata) > 0) {
            $inc = 1;
            foreach ($usersdata as $data) {
                //pre($data);
                $profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);

                $output .= '<tr>
                        <td>
                            <div class="media-left media-middle">
                                <a href="#">';
                $output .= '<img src="' . $profileImg . '" class="img-circle img-xs" alt=""></a>
                            </div>
                            <div class="media-left">
                                <div class="text-default text-semibold"><a target="_blank" href="' . base_url('admin/profile/' . $data->id) . '" >' . $data->firstname . ' ' . $data->lastname . '</a></div>
                                <div class="text-muted text-size-small">';

                $userRole = $data->user_role;
                if ($userRole == 1) {
                    $roleType = 'Admin';
                } else if ($userRole == 2) {
                    $roleType = 'User';
                } else if ($userRole == 3) {
                    $roleType = 'Customer';
                } else {
                    $roleType = '';
                }
                if (!empty($data->description)) {
                    $output .= $roleType . ' ( ' . $data->description . ' ) ';
                } else {
                    $output .= $roleType;
                }


                $output .= '</div>
                            </div>
                        </td>
                        <td>' . $data->email . '</td>
                        <td><div class="text-semibold">' . date('F d, Y', strtotime($data->created)) . '</div><div class="text-muted text-size-small">' . date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')</div></td>
                        <td class="text-center">';

                if ($data->status == 0) {
                    $output .= '<span class="label bg-danger">Inactive</span>';
                } else {
                    $output .= '<span class="label bg-success">Active</span>';
                }

                $output .= '</td>
                        
                        <td class="text-center">
                            <ul class="icons-list">';
                if ($inc > 5) {
                    $output .= '  <li class="dropup">';
                } else {
                    $output .= '  <li class="dropdown">';
                }
                $output .= ' 
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right">';

                if ($data->status == 1) {
                    $output .= "<li><a userId='" . $data->id . "' change_status = '0' class='chg_status'><i class='icon-gear'></i>Inactive</a></li>";
                } else {
                    $output .= "<li><a userId='" . $data->id . "' change_status = '1' class='chg_status'><i class='icon-gear'></i>Active</a></li>";
                }

                $output .= '<li><a href="javascript:void(0);" class="userEdit" userID="' . $data->id . '"><i class="icon-gear"></i> Edit</a></li>
                                        <li><a href="javascript:void(0);" class="userDelete" userID="' . $data->id . '" contactID="' . $data->infusion_user_id . '"><i class="icon-cross2"></i> Delete</a></li>';
                if ($userRole != 2) {
                    $output .= '<li><a href="' . base_url('admin/users/twiliomessage/' . $data->id) . '"><i class="icon-file-stats"></i> Twilio Stats</a></li>
                                        <li><a href="' . base_url('admin/users/sendgriddata/' . $data->id) . '"><i class="icon-file-stats"></i> Send Grid Stats</a></li>';
                }
                $output .= '</ul>
                                </li>
                            </ul>
                        </td>
                    </tr>';
                $inc++;
            }
        } else {
            $output .= '<tr><td colspan="6" style="text-align:center;">No any data found.</td></tr>';
        }
        return $output;
    }

    public function getUserInfo_old($id) {
        $this->db->select("tbl_users.*, tbl_cc_subscriptions.plan_id");
        $this->db->join("tbl_cc_subscriptions", "tbl_users.subscription_id=tbl_cc_subscriptions.subscription_id", "LEFT");
        $this->db->where('tbl_users.id', $id);
        $this->db->limit(1);
        $result = $this->db->get('tbl_users');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getSupportChatinfo($id) {
        $this->db->select("tbl_chat_supportuser.*");
        $this->db->where('tbl_chat_supportuser.user', $id);
        $result = $this->db->get('tbl_chat_supportuser');
        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $oUser = $result->row();
        }
        return $oUser;
    }

    public function getUserInfo_old_5Dec_2018($id) {

        $this->db->select("tbl_users.*");
        $this->db->where('tbl_users.id', $id);
        $result = $this->db->get('tbl_users');
        if ($result->num_rows() > 0) {
            $oUser = $result->row();
            if (!empty($oUser)) {
                $subscriptionID = $oUser->subscription_id;
                $subscriptionTopupID = $oUser->topup_subscription_id;

                $sql = "SELECT * FROM tbl_cc_subscriptions "
                        . "WHERE subscription_id = '{$subscriptionID}' OR subscription_id = '{$subscriptionTopupID}'";
                $result2 = $this->db->query($sql);
                if ($result2->num_rows() > 0) {
                    $oSubscriptions = $result2->result();
                    foreach ($oSubscriptions as $oSubscription) {
                        if ($oSubscription->subscription_id == $subscriptionID) {
                            $planID = $oSubscription->plan_id;
                            $regularSubscription = $oSubscription;
                        }

                        if ($oSubscription->subscription_id == $subscriptionTopupID) {
                            $topupPlanID = $oSubscription->plan_id;
                            $topupSubscription = $oSubscription;
                        }
                    }
                }

                if (!empty($planID)) {
                    $oUser->plan_id = $planID;
                    $oUser->regular_subscription_info = $regularSubscription;
                }

                if (!empty($topupPlanID)) {
                    $oUser->topup_plan_id = $topupPlanID;
                    $oUser->topup_subscription_info = $topupSubscription;
                }

                //Fetch Credit info
                $sql = "SELECT  * FROM tbl_account_usage WHERE user_id='{$id}'";
                $result3 = $this->db->query($sql);
                if ($result3->num_rows() > 0) {
                    $oCredits = $result3->row();
                    if (!empty($oCredits)) {
                        $EmailCredits = $oCredits->email_balance;
                        $SMSCredits = $oCredits->sms_balance;
                        $MMSCredits = $oCredits->mms_balance;
                        $EmailCreditsTopup = $oCredits->email_balance_topup;
                        $SMSCreditsTopup = $oCredits->sms_balance_topup;
                        $MMSCreditsTopup = $oCredits->mms_balance_topup;

                        $totalCredits = ($EmailCredits + $SMSCredits + $MMSCredits + $EmailCreditsTopup + $SMSCreditsTopup + $MMSCreditsTopup);
                        $totalEmailCredits = ($EmailCredits + $EmailCreditsTopup);
                        $totalSMSCredits = ($SMSCredits + $SMSCreditsTopup);
                        $totalMMSCredits = ($MMSCredits + $MMSCreditsTopup);
                        $oCredits->total_credits = $totalCredits;
                        $oCredits->total_email_credits = $totalEmailCredits;
                        $oCredits->total_sms_credits = $totalSMSCredits;
                        $oCredits->total_mms_credits = $totalMMSCredits;
                        $oUser->credits = $oCredits;
                    }
                }
            }
        }
        return $oUser;
    }

    public function getUserInfoByInfusionID($id) {
        $this->db->where('infusionid', $id);
        $result = $this->db->get('tbl_users');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getUserByCompanyName($companyName) {

        $companyName = str_replace("-", " ", $companyName);
        $this->db->like('tbl_users.company_name', $companyName);
        $result = $this->db->get('tbl_users');
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function updateUser($userID, $data) {
        $this->db->where('id', $userID);
        $this->db->update('tbl_users', $data);
        return true;
    }

    public function addUserSendGridData($data) {
        $bResult = $this->db->insert('tbl_sendgrid_accounts', $data);
        if ($bResult) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserSendGridData($userID) {
        $this->db->where('user_id', $userID);
        $result = $this->db->get('tbl_sendgrid_accounts');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function addUserTwilioData($data) {
        $result = $this->db->insert('tbl_twilio_accounts', $data);
        if ($result)
            return true;
        else
            return false;
    }

    public function getUserTwilioData($userID) {
        $this->db->where('user_id', $userID);
        $result = $this->db->get('tbl_twilio_accounts');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getSubscriberInfo($id) {
        $this->db->select("tbl_subscribers.*");
        $this->db->join("tbl_subscribers", "tbl_brandboost_users.subscriber_id=tbl_subscribers.id", "LEFT");
        $this->db->where('tbl_brandboost_users.id', $id);
        $result = $this->db->get('tbl_brandboost_users');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function checkUserProduct($userID, $productID) {
        $response = 0;
        $this->db->select('tbl_users.*, tbl_invoices_details.subscription_plan_id');
        $this->db->join('tbl_users', 'tbl_users.infusion_user_id = tbl_invoices_details.infusion_user_id', 'LEFT');
        $this->db->where('tbl_invoices_details.infusion_product_id', $productID);
        $this->db->where('tbl_users.id', $userID);
        $this->db->limit(1);
        $result = $this->db->get('tbl_invoices_details');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function getCurrentAccountUsage($userID) {
        $this->db->where("user_id", $userID);
        $result = $this->db->get('tbl_account_usage');
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }

    public function isActiveSubscription($userID = 0) {
        if (empty($userID)) {
            $userID = $this->session->userdata('admin_user_id');
            if ($userID > 0) {
                return true;
            }
        }

        if (empty($userID)) {
            $userID = $this->session->userdata('customer_user_id');
        }

        if (!empty($userID)) {
            $aUser = $this->getUserInfo($userID);
            $subscriptionID = $aUser->subscription_id;
            if (!empty($subscriptionID)) {
                $this->db->select("tbl_cc_subscriptions.subscription_status");
                $this->db->join("tbl_cc_subscriptions", "tbl_users.subscription_id = tbl_cc_subscriptions.subscription_id", "LEFT");
                $this->db->where("tbl_users.id", $userID);
                $this->db->where("tbl_cc_subscriptions.subscription_status", "active");
                $this->db->or_where("tbl_cc_subscriptions.subscription_status", "in_trial");
                $this->db->order_by('tbl_cc_subscriptions.id', 'DESC');
                $this->db->limit(1);
                $result = $this->db->get("tbl_users");
                if ($result->num_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
