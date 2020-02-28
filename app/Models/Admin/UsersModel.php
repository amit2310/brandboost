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

    /**
     * Used to get one or multiple users based on the userid
     * @param type $id
     * @return type
     */
    public static function getAllUsers($id = '') {
        $oData = DB::table('tbl_users')
                ->where('deleted_status', 0)
                ->when(($id > 0), function($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->orderBy('id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * This method check if user has an active subscription
     * @param type $userID
     * @return boolean
     */
    public static function isActiveSubscription($userID = 0) {
        if (empty($userID)) {
            $userID = Session::get('admin_user_id');
            if ($userID > 0) {
                return true;
            }
        }

        if (empty($userID)) {
            $userID = Session::get('customer_user_id');
        }

        if (!empty($userID)) {
            $aUser = self::getUserInfo($userID);
            $subscriptionID = $aUser->subscription_id;
            if (!empty($subscriptionID)) {

                $bData = DB::table('tbl_users')
                        ->leftJoin('tbl_cc_subscriptions', 'tbl_users.subscription_id', '=', 'tbl_cc_subscriptions.subscription_id')
                        ->select('tbl_cc_subscriptions.subscription_status')
                        ->where('tbl_users.id', $userID)
                        ->where('tbl_cc_subscriptions.subscription_status', 'active')
                        ->orWhere('tbl_cc_subscriptions.subscription_status', 'in_trial')
                        ->orderBy('tbl_cc_subscriptions.id', 'desc')
                        ->limit(1)
                        ->exists();

                if ($bData)
                    return true;
                else
                    return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * This method is for get all country
     * @return object
     */
    public static function getAllCountries() {

        $oData = DB::table('tbl_countries')
                ->get();
        return $oData;
    }

    /**
     * This function used to get Sendgrid Account info
     * @param type $clientID
     * @return type
     */
    public static function getSendgridAccount($clientID) {
        $oData = DB::table('tbl_sendgrid_accounts')
                ->where('user_id', $clientID)
                ->where('status', 1)
                ->first();

        return $oData;
    }

    /**
     * This function used to check email exist
     * @param type $emailID
     * @return type object
     */
    public static function checkEmailExist($emailID) {

        $oData = DB::table('tbl_users')
                ->where('email', $emailID)
                ->exists();

        return $oData;
    }

	/**
     * This function used to check email exist
     * @param type $emailID
     * @return type object
     */
    public static function checkEmailExistData($emailID) {

        $oData = DB::table('tbl_users')
                ->where('email', $emailID)
                ->get();

        return $oData;
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

    /**
     * Update user record
     * @param type $aData
     * @param type $userId
     * @return type
     */
    public function updateUsers($aData, $userId) {

        $result = DB::table('tbl_users')
                ->where('id', $userId)
                ->update($aData);

        return true;
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

    /**
     * This function is used to delete the user from the system
     * @return type
     */
    public function deleteUsers($userId) {
        $aData = array('deleted_status' => 1);

        $oData = DB::table('tbl_users')
                ->where('id', $userId)
                ->update($aData);

        return true;
    }

    /**
     * This function is used to check the user found or not in the bb system
     * @param type $clientID
     * @return type
     */
    public function checkIfUser($aParam) {
        if (!empty($aParam)) {
            $key = array_keys($aParam);
            $val = array_values($aParam);
            $oData = DB::table('tbl_users')
                            ->where($key[0], $val[0])
                            ->limit(1)->first();
            return $oData->id;
        }
        return false;
    }

    /**
     * This function is used to check the subscriber exists or not
     * @param type $clientID
     * @return type
     */
    public function checkIfSubscriber($aParam) {
        if (!empty($aParam)) {
            $key = array_keys($aParam);
            $val = array_values($aParam);
            $aData = DB::table('tbl_subscribers')
                            ->where($key[0], $val[0])
                            ->limit(1)->first();
            return $aData;
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

    public function user_count_all() {
        $query = $this->db->get("tbl_users");
        return $query->num_rows();
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

    /**
     * Used to get the username on the behalf of the company name
     * @param type $companyName
     * @return username
     */
    public function getUserByCompanyName($companyName) {

        $companyName = str_replace("-", " ", $companyName);
        $oData = DB::table('tbl_users')
                        ->where('tbl_users.company_name', 'like', '%' . $companyName . '%')->first();

        return $oData;
    }

    /**
     * Update user data
     * @param type $userID
     * @param type $aData
     * @return boolean
     */
    public function updateUser($userID, $aData) {
        $result = DB::table('tbl_users')
                ->where('id', $userID)
                ->update($aData);
        return true;
    }

    /**
     * Add User sendgrid data
     * @param type $aData
     * @return boolean
     */
    public function addUserSendGridData($aData) {
        $bResult = DB::table('tbl_sendgrid_accounts')->insert($aData);
        if ($bResult) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get user sendgrid data
     * @param type $userID
     * @return type
     */
    public function getUserSendGridData($userID) {
        $oData = DB::table('tbl_sendgrid_accounts')
                ->where('user_id', $userID)
                ->first();
        return $oData;
    }

    /**
     * Add user Twilio data
     * @param type $aData
     * @return boolean
     */
    public function addUserTwilioData($aData) {
        $result = DB::table('tbl_twilio_accounts')->insert($aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function getUserTwilioData($userID) {
        $oData = DB::table('tbl_twilio_accounts')
                ->where('user_id', $userID)
                ->first();
        return $oData;
    }

    /**
     * This function will return subscriber information on the behalf of the subscriber id
     * @param type $id
     * @return type
     */
    public static function getSubscriberInfo($id) {
        $aData = DB::table('tbl_brandboost_campaign_users')
                        ->select('tbl_subscribers.*')
                        ->leftJoin('tbl_subscribers', 'tbl_brandboost_campaign_users.subscriber_id', '=', 'tbl_subscribers.id')
                        ->where('tbl_brandboost_campaign_users.id', $id)->get();
        return $aData;
    }

    public static function getSubscriberInfoOLD($id) {
        $aData = DB::table('tbl_brandboost_users')
                        ->select('tbl_subscribers.*')
                        ->leftJoin('tbl_subscribers', 'tbl_brandboost_users.subscriber_id', '=', 'tbl_subscribers.id')
                        ->where('tbl_brandboost_users.id', $id)->get();
        return $aData;
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

    /**
     *
     * @param type $userID
     * @return type
     */
    public static function getCurrentAccountUsage($userID) {
        $oData = DB::table('tbl_account_usage')
                ->where('user_id', $userID)
                ->first();
        return $oData;
    }

}
