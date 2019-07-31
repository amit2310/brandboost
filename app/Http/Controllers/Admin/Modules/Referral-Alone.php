<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("admin/modules/Referral_model", "mReferral");
        $this->load->model("admin/Users_model", "mUser");
        $this->load->library('csvimport');
    }

    public function index() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oSettings = $this->mReferral->getReferralSettings($userID);
        if (!empty($oSettings)) {
            $advCouponID = $oSettings->advCouponID;
            $refCouponID = $oSettings->refCouponID;
            if ($advCouponID > 0) {
                $oAdvCouponCodes = $this->mReferral->getAdvocateCouponCodes($advCouponID);
            }
            if ($refCouponID > 0) {
                $oRefCouponCodes = $this->mReferral->getReferralCouponCodes($refCouponID);
            }
        }
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="">Referral Module</li>
                        <li class="">Reward</li>
            </ul>';
        $aPageData = array(
            'title' => 'Referral Module',
            'pagename' => $breadcrumb,
            'oSettings' => $oSettings,
            'oAdvCouponCodes' => $oAdvCouponCodes,
            'oRefCouponCodes' => $oRefCouponCodes,
            'bActiveSubsription' => $bActiveSubsription
        );
        $this->template->load('admin/admin_template_new', 'admin/modules/referral/index.php', $aPageData);
    }

    public function addReferral() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $actionName = strip_tags($post['doaction']);
        if ($actionName == 'setupDefault') {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $hashcode = '';
            for ($i = 0; $i < 20; $i++) {
                $hashcode .= $characters[rand(0, strlen($characters))];
            }
            $hashcode = $hashcode . date('Ymdhis');
            if ($userID > 0) {
                $aData = array(
                    'user_id' => $userID,
                    'hashcode' => md5($hashcode),
                    'updated' => date("Y-m-d H:i:s"),
                    'created' => date("Y-m-d H:i:s")
                );
                $bResponse = $this->mReferral->setupDefaultReferral($aData);
                if ($bResponse) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function saveCoupons() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $couponType = strip_tags($post['couponType']);
        $couponID = strip_tags($post['couponID']);
        $singleCouponCodes = strip_tags($post['singleCouponCodes']);
        $multipleCouponCodes = strip_tags($post['multipleCouponCodes']);
        $couponExpiry = strip_tags($post['coupon_expiry']);
        $specificExpiryTime = strip_tags($post['specific_expiry_picker']);

        $aData = array(
            'coupon_id' => $couponID,
            'updated' => date("Y-m-d H:i:s")
        );
        if ($couponType == 'advocate_single_coupons') {
            if (!empty($singleCouponCodes)) {
                $aData['coupon_code'] = str_replace(" ", "", $singleCouponCodes);
                $aData['usage_type'] = 'single';
                $aData['created'] = date("Y-m-d H:i:s");
                $aData['coupon_status'] = 1;
                $bSaved = $this->mReferral->addAdvocateCoupon($aData);
                if ($bSaved) {
                    $aUpdateData = array(
                        'advocate_coupon_type' => 'single',
                        'updated' => date("Y-m-d H:i:s")
                    );
                    $this->mReferral->updateAdvocateCouponCode($aUpdateData, $couponID);
                }
                $response = array('status' => 'success', 'msg' => "Success");
            }
        } else if ($couponType == 'advocate_multiple_coupons') {

            $aData['coupon_code'] = str_replace(" ", "", $multipleCouponCodes);
            $aData['usage_type'] = 'multiple';
            $aData['expiry'] = $couponExpiry;
            $aData['expiry_specific_date'] = $specificExpiryTime;
            $aData['created'] = date("Y-m-d H:i:s");
            $aData['coupon_status'] = 1;
            $bSaved = $this->mReferral->addAdvocateCoupon($aData);
            if ($bSaved) {
                $aUpdateData = array(
                    'advocate_coupon_type' => 'multiple',
                    'updated' => date("Y-m-d H:i:s")
                );
                $this->mReferral->updateAdvocateCouponCode($aUpdateData, $couponID);
            }
            $response = array('status' => 'success', 'msg' => "Success");
        } else if ($couponType == 'referred_single_coupons') {
            if (!empty($singleCouponCodes)) {
                $aData['coupon_code'] = str_replace(" ", "", $singleCouponCodes);
                $aData['usage_type'] = 'single';
                $aData['created'] = date("Y-m-d H:i:s");
                $aData['coupon_status'] = 1;
                $bSaved = $this->mReferral->addReferredCoupon($aData);
                if ($bSaved) {
                    $aUpdateData = array(
                        'referred_coupon_type' => 'single',
                        'updated' => date("Y-m-d H:i:s")
                    );
                    $this->mReferral->updateReferredCouponCode($aUpdateData, $couponID);
                }
                $response = array('status' => 'success', 'msg' => "Success");
            }
        } else if ($couponType == 'referred_multiple_coupons') {

            $aData['coupon_code'] = str_replace(" ", "", $multipleCouponCodes);
            $aData['usage_type'] = 'multiple';
            $aData['expiry'] = $couponExpiry;
            $aData['expiry_specific_date'] = $specificExpiryTime;
            $aData['created'] = date("Y-m-d H:i:s");
            $aData['coupon_status'] = 1;
            $bSaved = $this->mReferral->addReferredCoupon($aData);
            if ($bSaved) {
                $aUpdateData = array(
                    'referred_coupon_type' => 'multiple',
                    'updated' => date("Y-m-d H:i:s")
                );
                $this->mReferral->updateReferredCouponCode($aUpdateData, $couponID);
            }
            $response = array('status' => 'success', 'msg' => "Success");
        }



        echo json_encode($response);
        exit;
    }

    public function saveRewards() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $rewardType = strip_tags($post['rewardType']);
        $rewardID = strip_tags($post['rewardID']);
        $advocateCouponDiscount = strip_tags($post['advocate_discount']);
        $advocateCash = strip_tags($post['advocate_cash']);
        $advocateCustom = strip_tags($post['advocate_custom']);
        $referredCouponDiscount = strip_tags($post['referred_discount']);
        $promoLink = strip_tags($post['referred_promo_link']);
        $promoDescription = strip_tags($post['referred_promo_desc']);
        $promoLinkExpiry = strip_tags($post['promo_expiry']);
        $promoLinkExpirySpecific = strip_tags($post['specific_expiry_picker']);

        $aData = array(
            'reward_id' => $rewardID,
            'updated' => date("Y-m-d H:i:s")
        );

        if ($rewardType == 'advocate_discount') {

            $aData['advocate_display_msg'] = $advocateCouponDiscount;
            $aData['advocate_coupon_type'] = 'single';
            $iPrimaryID = $this->mReferral->saveAdvCouponDiscount($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'adv_coupon_id' => $iPrimaryID,
                    'cash_id' => '',
                    'custom_id' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'advocate_cash') {
            $aData['display_msg'] = $advocateCash;
            $iPrimaryID = $this->mReferral->saveCashReward($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'adv_coupon_id' => '',
                    'cash_id' => $iPrimaryID,
                    'custom_id' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'advocate_custom') {
            $aData['reward_title'] = $advocateCustom;
            $iPrimaryID = $this->mReferral->saveCustomReward($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'adv_coupon_id' => '',
                    'cash_id' => '',
                    'custom_id' => $iPrimaryID,
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'referred_discount') {
            $aData['referred_display_msg'] = $referredCouponDiscount;
            $aData['referred_coupon_type'] = 'single';
            $iPrimaryID = $this->mReferral->saveRefCouponDiscount($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'ref_coupon_id' => $iPrimaryID,
                    'promo_id' => '',
                    'no_discount' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'referred_promo') {
            $aData['link_url'] = $promoLink;
            $aData['link_desc'] = $promoDescription;
            $aData['expiry'] = $promoLinkExpiry;
            $aData['expiry_specific_date'] = $promoLinkExpirySpecific;

            $iPrimaryID = $this->mReferral->savePromoLink($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'ref_coupon_id' => '',
                    'promo_id' => $iPrimaryID,
                    'no_discount' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'referred_no_discount') {
            $iPrimaryID = 1;  //Just to set any numeric number to make condition true below in order to updte in the main table
            $aUpdateData = array(
                'ref_coupon_id' => '',
                'promo_id' => '',
                'no_discount' => 'yes',
                'updated' => date("Y-m-d H:i:s")
            );
        }




        if ($iPrimaryID > 0) {
            if (!empty($aUpdateData)) {
                $bSaved = $this->mReferral->updateReferralSettings($aUpdateData, $rewardID);
            }

            $response = array('status' => 'success', 'msg' => "Success");
        }

        echo json_encode($response);
        exit;
    }

    public function contacts() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($userID)) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $hashCode = $oSettings->hashcode;
            if (!empty($hashCode)) {
                $oContacts = $this->mReferral->getMyAdvocates($hashCode);
            }
        }

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Contacts</li>
                </ul>';

        $data = array(
            'title' => 'My Advocates',
            'pagename' => $breadcrumb,
            'oContacts' => $oContacts
        );

        $this->template->load('admin/admin_template_new', 'admin/modules/referral/contacts', $data);
    }

    public function widgets() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Widgets</li>
                </ul>';

            $data = array(
                'title' => 'Widgets',
                'pagename' => $breadcrumb,
                'oSettings' => $oSettings
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/widget_code', $data);
        }
    }

    public function configuration() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getAccountSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Settings</li>
                </ul>';

            $data = array(
                'title' => 'Referral Settings',
                'pagename' => $breadcrumb,
                'oSettings' => $oSettings,
                'userID' => $userID
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/settings', $data);
        }
    }

    public function saveSettings() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $storeName = strip_tags($post['storeName']);
        $storeURL = strip_tags($post['storeURL']);
        $storeEmail = strip_tags($post['storeEmail']);
        $source = strip_tags($post['notification_source']);
        $inviteDelay = strip_tags($post['invite_delay']);
        $salesDelay = strip_tags($post['sale_delay']);
        $reminderDelay = strip_tags($post['reminder_delay']);
        $userID = strip_tags($post['uid']);
        if ($userID > 0) {
            $aData = array(
                'user_id' => $userID,
                'store_name' => $storeName,
                'store_url' => $storeURL,
                'store_email' => $storeEmail,
                'notification_source' => $source,
                'invite_delay' => $inviteDelay,
                'sale_delay' => $salesDelay,
                'reminder_delay' => $reminderDelay
            );

            $bUpdated = $this->mReferral->updateStoreSettings($aData, $userID);
            //{"delay_type":"after","delay_value":"10","delay_unit":"minute"}


            if ($bUpdated) {
                //Update in automation table to take effect in email/sms settings
                $aEvent = array(
                    'invite' => json_encode(array('delay_type' => 'after', 'delay_value' => $inviteDelay, 'delay_unit' => 'hours')),
                    'sale' => json_encode(array('delay_type' => 'after', 'delay_value' => $salesDelay, 'delay_unit' => 'days')),
                    'reminder' => json_encode(array('delay_type' => 'after', 'delay_value' => $reminderDelay, 'delay_unit' => 'weeks'))
                );
                $bSavedEvent = $this->mReferral->saveAutoEvents($aEvent, $source, $userID);
            }

            $response = array('status' => 'success', 'msg' => "Success");
        }

        echo json_encode($response);
        exit;
    }

    public function templates() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getAccountSettings($userID);
            if (!empty($oSettings)) {
                $settingsID = $oSettings->id;
                $oCampaigns = $this->mReferral->getUserReferralTemplates($settingsID);
            }

            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Email/Sms Templates</li>
                </ul>';

            $data = array(
                'title' => 'Email/Sms Templates',
                'pagename' => $breadcrumb,
                'oSettings' => $oSettings,
                'oCampaigns' => $oCampaigns,
                'userID' => $userID
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/templates', $data);
        }
    }

    public function updateUserCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();
        
        if (!empty($post)) {
            $campaignID = strip_tags($post['campaignId']);
            $campaingType = strip_tags($post['campaignType']);
            if ($campaingType == 'Email') {
                $content = $post['emailtemplate'];
            } else {
                $content = $post['smstemplate'];
            }

            if (!empty($campaignID)) {
                $aData = array(
                    'html' => base64_encode($content)
                );
                $bSaved = $this->mReferral->updateUserCampaign($aData, $campaignID);
                if($bSaved){
                    $response = array('status' => 'success', 'msg' => "Success");
                }
                        
            }
        }
        echo json_encode($response);
        exit;
    }

    public function invites() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Invite Advocates</li>
                </ul>';

            $data = array(
                'title' => 'Invite Advocates',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/invite', $data);
        }
    }

    public function registerInvite() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (!empty($post)) {
            $accountID = strip_tags($post['bbaid']);
            $firstName = strip_tags($post['firstname']);
            $lastName = strip_tags($post['lastname']);
            $email = strip_tags($post['email']);
            $phone = strip_tags($post['phone']);
            $affiliateID = strip_tags($post['userid']);
            $aData = array(
                'email' => $email,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => $phone,
                'accountID' => $accountID,
                'affiliateID' => $affiliateID
            );
            $refLink = $this->registerNow($aData);
            if (!empty($refLink)) {
                $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
            }
        }
        echo json_encode($response);
        exit;
    }

    public function registerNow($aData) {
        if (!empty($aData)) {
            $email = $aData['email'];
            $firstName = $aData['firstName'];
            $lastName = $aData['lastName'];
            $phone = $aData['phone'];
            $accountID = $aData['accountID'];
            $affiliateID = $aData['affiliateID'];
            if (!empty($email)) {
                $oExistingUser = $this->mReferral->checkIfExistingAdvocate($email);
                if (!empty($oExistingUser)) {
                    $existingUserID = $oExistingUser->id;
                    $refLink = site_url() . 'ref/t/' . $oExistingUser->refkey;
                    $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
                } else {
                    //Ok we are good now, go ahead and register a new user
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randstring = '';
                    for ($i = 0; $i < 8; $i++) {
                        $randstring .= $characters[rand(0, strlen($characters))];
                    }
                    $password_hash = 'Umair';
                    $siteSalt = 'Rahul';
                    $pwd = base64_encode($password . $password_hash . $siteSalt);
                    $data = array(
                        'account_id' => $accountID,
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => $email,
                        'status' => 1,
                        'password' => $pwd,
                        'mobile' => $phone,
                        'affiliateid' => $affiliateID,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $referredUserID = $this->mReferral->addReferredUser($data);

                    if (!empty($referredUserID)) {
                        //Generate Referral Link
                        $oSettings = $this->mReferral->getReferralSettings($accountID, $hash = true);
                        $storeID = $oSettings->id;
                        if ($storeID > 0) {
                            $timeNow = time();
                            $refKey = $referredUserID . '-' . $timeNow;
                            $aRefData = array(
                                'settings_id' => $storeID,
                                'advocate_id' => $referredUserID,
                                'refkey' => $refKey,
                                'created' => date("Y-m-d H:i:s")
                            );
                            $bAdded = $this->mReferral->createReferralLink($aRefData);
                            if ($bAdded) {
                                $refLink = site_url() . 'ref/t/' . $refKey;
                                $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
                            }
                        }
                    }
                }
            }

            if (!empty($refLink)) {
                return $refLink;
            }
        }
        return false;
    }

    public function importInviteCSV() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $accountID = strip_tags($post['bbaid']);
        $affiliateID = strip_tags($post['userid']);


        $this->load->library('upload', $config);

        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $response = array('status' => 'error', 'msg' => 'Fileupload failed');
        } else {

            $aFile = $this->upload->data();
            $sPath = './uploads/' . $aFile['file_name'];
            if ($this->csvimport->get_array($sPath)) {
                $aUsers = $this->csvimport->get_array($sPath);
                $emailUserId = '';
                foreach ($aUsers as $row) {
                    $aData = array(
                        'email' => $row['EMAIL'],
                        'firstName' => $row['FIRST_NAME'],
                        'lastName' => $row['LAST_NAME'],
                        'phone' => $row['PHONE'],
                        'accountID' => $accountID,
                        'affiliateID' => $affiliateID
                    );
                    $refLink = $this->registerNow($aData);
                }
            } else {
                $data['error'] = "Error occured";
            }
        }
        $response = array('status' => 'success', 'msg' => "Success");
        echo json_encode($response);
        exit;
    }

    public function invoices() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            if (!empty($oSettings)) {
                $accountID = $oSettings->hashcode;
                $oInvoices = $this->mReferral->getReferralInvoices($accountID);
            }
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Invoice History</li>
                </ul>';

            $data = array(
                'title' => 'Invite Advocates',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings,
                'oInvoices' => $oInvoices
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/invoices', $data);
        }
    }

    public function integration() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Integration</li>
                </ul>';

            $data = array(
                'title' => 'Integration',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/integration', $data);
        }
    }

    public function reports() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            if (!empty($oSettings)) {
                $accountID = $oSettings->hashcode;
                $oRefPurchased = $this->mReferral->referredSales($accountID);
                $oUntrackedPurchased = $this->mReferral->untrackedSales($accountID);

                if (!empty($oRefPurchased)) {
                    foreach ($oRefPurchased as $row) {
                        $referredAmount = $referredAmount + $row->amount;
                    }
                }

                if (!empty($oUntrackedPurchased)) {
                    foreach ($oUntrackedPurchased as $row2) {
                        $untrackedAmount = $untrackedAmount + $row2->amount;
                    }
                }

                $oRefVisits = $this->mReferral->getReferralLinkVisits($accountID);
                $oTotalReferralSent = $this->mReferral->getStatsTotalSent($userID);
                $oTotalReferralTwillio = $this->mReferral->getStatsTotalTwillio($userID);
                
            }

            //pre($oRefPurchased);

            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li>Referral Module</li>
                    <li class="active">Referral Report</li>
                </ul>';

            $data = array(
                'title' => 'Referral Report',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings,
                'oRefPurchased' => $oRefPurchased,
                'referredAmount' => $referredAmount,
                'oRefVisits' => $oRefVisits,
                'untrackedAmount' => $untrackedAmount,
                'oUntrackedPurchased' => $oUntrackedPurchased,
                'oTotalReferralSent' => $oTotalReferralSent,
                'oTotalReferralTwillio' => $oTotalReferralTwillio
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/reports', $data);
        }
    }

}
