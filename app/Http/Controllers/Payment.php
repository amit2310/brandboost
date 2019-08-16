<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\PaymentModel;
use App\Models\ChargeBeeModel;
use App\Models\SignupModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\LoginModel;
use App\Models\ProductsModel;
use Session;

class Payment extends Controller {
    //var $merchant_id = '14';

    /**
     * 
     * @param type $aData
     * @return string
     */
    public function cbChargeInvoice($aData) {
        $bSuccess = false;
        $response = array();
        $userID = Session::get('customer_user_id');
        $planID = isset($aData['plan_id']) ? $aData['plan_id'] : '';
        $ccID = $aData['cc_id'];
        $ccCustomerID = $aData['cb_customer_id'];
        $quantity = isset($aData['quantity']) ? $aData['quantity'] : 1;

        //Instantiate product model to get its properites and methods
        $mProducts = new ProductsModel();

        //Instantiate product model to get its properites and methods
        $mChargeBee = new ChargeBeeModel();



        $aProduct = $mProducts->getPlanDetails($planID);
        if (!empty($aProduct)) {
            $productName = $aProduct['product_name'];
            $productType = $aProduct['product_type'];
            $duration = $aProduct['subs_cycle'];
            $productPrice = $aProduct['product_price'];
            $trialDays = $aProduct['free_trial_days'];

            //Okay lets begin
            if ($userID > 0 && $ccCustomerID > 0) {
                if ($productType == 'membership' || $productType == 'topup-membership') {
                    $subscriptionID = $mChargeBee->ccCreateSubscription($ccCustomerID, array('planId' => $planID), $productType);
                    if (!empty($subscriptionID)) {
                        $bSuccess = true;
                    }
                } else if ($productType == 'topup') {
                    $aInvoiceInput = array(
                        'customerId' => $ccCustomerID,
                        'addons' => array(array('id' => $planID, 'quantity' => $quantity)),
                            //'charges' => array(array('amount' => $productPrice, 'description' => 'Initial Topup Details goes here'))
                    );
                    $transactionStatus = $mChargeBee->ccChargeInvoice($aInvoiceInput);
                    if ($transactionStatus == 'success' || strtolower($transactionStatus) == 'paid') {
                        $bSuccess = true;
                    }
                }
                if ($bSuccess == true) {
                    $response = array('status' => 'success', 'msg' => 'Transaction completed successfully');
                    //Send notification to user & admin
                    //Send Email
                    //sendEmailTemplate('order-temp', $userID);
                    //Send Notification
                    $aNotificationDataCus = array(
                        'user_id' => $userID,
                        'event_type' => 'new_sale',
                        'message' => 'Your order has been created successfully.',
                        'link' => base_url() . 'admin/invoices/view/' . $userID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $eventName = 'new_sale';
                    @add_notifications($aNotificationDataCus, $eventName, $userID, $notifyAdmin = true);
                }
            } else {
                $response = array('status' => 'error', 'msg' => 'Local userid or chargebee userid is missing');
            }
        } else {
            $response = array('status' => 'error', 'msg' => 'Plan not found');
        }

        return $response;
    }

    /**
     * 
     * @param type $aData
     * @return boolean
     */
    public function userRegistration($aData = array()) {

        //Instantiate Chargebee model to get its properties and methods
        $mChargeBee = new ChargeBeeModel();

        //Instantiate Signup model to get its properties and methods
        $mSignup = new SignupModel();

        $response = array();

        $firstName = $aData['firstname'];
        $lastName = $aData['lastname'];
        $email = $aData['email'];
        //$country = $aData['country'];
        $phone = $aData['phone'];
        $zip = $aData['zip'];
        $password = $aData['password'];
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $pwd = base64_encode($password . $password_hash . $siteSalt);

        $aChargebeeData = array(
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'country' => $country,
            'phone' => $phone,
            'zip' => $zip
        );

        //$infusionUserID = $this->mInfusion->createContact($aInfusionData);
        $chargebeeUserID = $mChargeBee->createContact($aChargebeeData);
        $data = array(
            'cb_contact_id' => $chargebeeUserID,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'mobile' => $phone,
            'user_role' => 3,
            'status' => 1,
            'password' => $pwd,
            'created' => date("Y-m-d H:i:s")
        );

        $userID = $mSignup->addUser($data);

        if ($userID) {
            Session::put("customer_user_id", $userID);
            return $chargebeeUserID;
        } else {
            return false;
        }
    }

    /**
     * This function has deprecated now
     * @param type $aData
     * @return type
     */
    public function saveInfusionCC($aData = array()) {
        $mUser = new UsersModel();
        $creditCardID = 0;
        $response = array();
        $userID = Session::get('customer_user_id');
        $cc = $aData['ccNum'];
        $cctype = $aData['ccType'];
        $expMonth = $aData['expMonth'];
        $expYear = $aData['expYear'];
        $cvvCode = $aData['cvv'];
        $aUser = UsersModel::getUserInfo($userID);

        if (!empty($aUser)) {
            $contactID = $aUser->infusion_user_id;

            if ($contactID > 0) {

                $ccID = $this->mInfusion->AddCreditCart($contactID, $aUser->firstname, $aUser->lastname, $cc, $cvvCode, $cctype, $expMonth, $expYear);

                if ($ccID > 0 && !empty($ccID)) {
                    $validateCC = $this->validateInfusionCC($ccID);
                    if ($validateCC == 'true') {
                        $cardLastNumber = substr($cc, -4);
                        $userData = array(
                            "infusion_cc_id" => $ccID,
                            "cc_last_four" => $cardLastNumber
                        );
                        $bIsUpdated = $mUser->updateUser($userID, $userData);
                        $creditCardID = $ccID;
                    }
                }
            }
        }
        return $creditCardID;
    }

    /**
     * This function used to store CC details
     */
    public function storeCreditCard(Request $request) {
        $response = array();

        $cc = $request->ccNum;
        $expMonth = $request->expMonth;
        $expYear = $request->expYear;
        $cvvCode = $request->cvv;

        $aData = array(
            'ccNum' => $cc,
            'expMonth' => $expMonth,
            'expYear' => $expYear,
            'cvv' => $cvvCode
        );
        $creditCardID = $this->cbStoreCC($aData);
        if (!empty($creditCardID)) {
            $oUser = getLoggedUser();
            $response['status'] = 'success';
            $response['info'] = $oUser;
        } else {
            $response['status'] = 'error';
        }
        echo json_encode($response);
        exit;
    }

    /**
     * 
     * @param type $aData
     * @return int
     */
    public function cbStoreCC($aData = array()) {

        //Instantiate Chargebee model to get its properties and methods
        $mChargeBee = new ChargeBeeModel();

        //Instantiate Users Model to get its properties and methods
        $mUser = new UsersModel();

        try {
            $creditCardID = 0;
            $userID = Session::get('customer_user_id');
            $cc = $aData['ccNum'];
            $cctype = $aData['ccType'];
            $expMonth = $aData['expMonth'];
            $expYear = $aData['expYear'];
            $cvvCode = $aData['cvv'];
            $aUser = UsersModel::getUserInfo($userID);
            if (!empty($aUser)) {
                $contactID = $aUser->cb_contact_id;

                if (!empty($contactID)) {
                    $ccData = array(
                        'firstName' => $aUser->firstname,
                        'lastName' => $aUser->lastname,
                        'number' => $cc,
                        'expiryMonth' => $expMonth,
                        'expiryYear' => $expYear,
                        'cvv' => $cvvCode
                    );

                    $aCCResponse = $mChargeBee->AddCreditCart($contactID, $ccData);

                    if ($aCCResponse['status'] == 'valid') {
                        $paymentSourceID = $aCCResponse['payment_source_id'];
                        $lastFour = $aCCResponse['last4'];
                        $userData = array(
                            "chargebee_cc_id" => $paymentSourceID,
                            "cc_last_four" => $lastFour,
                            "cc_exp_month" => $expMonth,
                            "cc_exp_year" => $expYear
                        );
                        $bIsUpdated = $mUser->updateUser($userID, $userData);
                        $creditCardID = $paymentSourceID;
                    }
                }
            }
            return $creditCardID;
        } catch (Exception $ex) {
            return 0;
        }
    }

    /**
     * This method has deprecated now
     * @param type $ccID
     * @return boolean
     */
    public function validateInfusionCC($ccID) {
        $validateCC = $this->mInfusion->validateCC($ccID);
        if ($validateCC['Valid'] == 'true') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function charging(Request $request) {
        $response = array();


        if (empty($request)) {
            Session::flash('error_msg', "<strong>Unauthorized Access</strong>");
            redirect('price');
        }

        $firstName = (isset($request->firstname) && !empty($request->firstname)) ? $request->firstname : '';
        $lastName = (isset($request->lastname) && !empty($request->lastname)) ? $request->lastname : '';
        $email = (isset($request->email) && !empty($request->email)) ? $request->email : '';
        $country = (isset($request->country) && !empty($request->country)) ? $request->country : '';
        $phone = (isset($request->phone_number) && !empty($request->phone_number)) ? $request->phone_number : '';
        $zip = (isset($request->postal_code) && !empty($request->postal_code)) ? $request->phone_number : '';

        $planID = (isset($request->plan_id) && !empty($request->plan_id)) ? $request->plan_id : '';
        $contactID = (isset($request->contact_id) && !empty($request->contact_id)) ? $request->contact_id : 0;
        $cc = (isset($request->cardNumber) && !empty($request->cardNumber)) ? $request->cardNumber : false;
        $cctype = (isset($request->creditCardType) && !empty($request->creditCardType)) ? $request->creditCardType : false;
        $expMonth = (isset($request->creditCardExpirationMonth) && !empty($request->creditCardExpirationMonth)) ? $request->creditCardExpirationMonth : false;
        $expYear = (isset($request->creditCardExpirationYear) && !empty($request->creditCardExpirationYear)) ? $request->creditCardExpirationYear : false;
        $cvvCode = (isset($request->creditCardVerificationNumber) && !empty($request->creditCardVerificationNumber)) ? $request->creditCardVerificationNumber : false;
        $aOrderFormData = array(
            'orderFormData' => array(
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'country' => $country,
                'phone' => $phone,
                'zip' => $zip,
                'cc' => $cc,
                'cctype' => $cctype,
                'expmonth' => $expMonth,
                'expyear' => $expYear,
                'ccvcode' => $cvvCode,
                'planid' => $planID
            )
        );
        Session::put($aOrderFormData);

        return view('payment_processing', array('haveData' => 'yes'));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function chargedecline(Request $request) {
        $response = array();


        if (empty($request)) {
            Session::flash('error_msg', "<strong>Unauthorized Access</strong>");
            redirect('price');
        }
        $aData = Session::get['orderFormData'];
        if (!empty($aData)) {
            $cbContactID = $aData['cb_contact_id'];
        }

        if (empty($cbContactID)) {

            $firstName = (isset($request->firstname) && !empty($request->firstname)) ? $request->firstname : '';
            $lastName = (isset($request->lastname) && !empty($request->lastname)) ? $request->lastname : '';
            $email = (isset($request->email) && !empty($request->email)) ? $request->email : '';
            $country = (isset($request->country) && !empty($request->country)) ? $request->country : '';
            $phone = (isset($request->phone_number) && !empty($request->phone_number)) ? $request->phone_number : '';
            $zip = (isset($request->postal_code) && !empty($request->postal_code)) ? $request->phone_number : '';
        } else {
            $firstName = $aData['firstname'];
            $lastName = $aData['lastname'];
            $email = $aData['email'];
            $country = $aData['country'];
            $phone = $aData['phone'];
            $zip = $aData['zip'];
        }

        $planID = (isset($request->plan_id) && !empty($request->plan_id)) ? $request->plan_id : '';
        $cc = (isset($request->cardNumber) && !empty($request->cardNumber)) ? $request->cardNumber : false;
        $cctype = (isset($request->creditCardType) && !empty($request->creditCardType)) ? $request->creditCardType : false;
        $expMonth = (isset($request->creditCardExpirationMonth) && !empty($request->creditCardExpirationMonth)) ? $request->creditCardExpirationMonth : false;
        $expYear = (isset($request->creditCardExpirationYear) && !empty($request->creditCardExpirationYear)) ? $request->creditCardExpirationYear : false;
        $cvvCode = (isset($request->creditCardVerificationNumber) && !empty($request->creditCardVerificationNumber)) ? $request->creditCardVerificationNumber : false;


        $aOrderFormData = array(
            'orderFormData' => array(
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'country' => $country,
                'phone' => $phone,
                'zip' => $zip,
                'cc' => $cc,
                'cctype' => $cctype,
                'expmonth' => $expMonth,
                'expyear' => $expYear,
                'ccvcode' => $cvvCode,
                'planid' => $planID,
                'cb_contact_id' => $cbContactID
            )
        );



        Session::put($aOrderFormData);

        return view('payment_processing', array('haveData' => 'yes'));
    }

    /**
     * 
     * @param Request $request
     */
    public function cbCharge(Request $request) {
        try {
            $response = array();

            //Instantiate Users Model to get its properties and methods
            $mUser = new UsersModel();

            //Instantiate Login Model to get its properties and methods
            $mLogin = new LoginModel();


            $aData = Session::get('orderFormData');

            if (empty($request) || empty($request)) {
                //return error
                $response = array('status' => 'error', 'error_type' => 'common', 'msg' => 'Empty request');
                echo json_encode($response);
                exit;
            }


            $firstName = $aData['firstname'];
            $lastName = $aData['lastname'];
            $email = $aData['email'];
            $country = $aData['country'];
            $phone = $aData['phone'];
            $zip = $aData['zip'];

            $cc = $aData['cc'];
            $cctype = $aData['cctype'];
            $expMonth = $aData['expmonth'];
            $expYear = $aData['expyear'];
            $cvvCode = $aData['ccvcode'];
            $planID = $aData['planid'];
            $chargebeeUserID = isset($aData['cb_contact_id']) ? $aData['cb_contact_id'] : '';

            $addCCData = array(
                'ccNum' => $cc,
                'ccType' => $cctype,
                'expMonth' => $expMonth,
                'expYear' => $expYear,
                'cvv' => $cvvCode,
            );

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randstring = '';
            for ($i = 0; $i < 8; $i++) {
                $randstring .= $characters[rand(0, (strlen($characters) - 1))];
            }

            if (empty($chargebeeUserID)) {
                //Lets create user at chargebee + add the same in database locally
                $aUserData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'country' => $country,
                    'phone' => $phone,
                    'zip' => $zip,
                    'password' => $randstring
                );

                //Create registration at chargebee 
                $chargebeeUserID = $this->cbUserRegistration($aUserData);

                if (empty($chargebeeUserID)) {
                    //Account creation failed at first attempt, make second Attempt
                    $chargebeeUserID = $this->cbUserRegistration($aUserData);
                }

                if (empty($chargebeeUserID)) {
                    //Account creation failed at second attempt, make third Attempt
                    $chargebeeUserID = $this->cbUserRegistration($aUserData);
                }


                if (empty($chargebeeUserID)) {
                    //return error
                    $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'Account creation failed');
                    echo json_encode($response);
                    exit;
                }
            }





            if (!empty($chargebeeUserID)) {
                $ccID = $this->cbStoreCC($addCCData);
            }

            if (empty($ccID)) {
                //Add CC is failed and not validated so lets make second attempt
                $ccID = $this->cbStoreCC($addCCData);
            }

            if (empty($ccID)) {
                //return error
                $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'Credit card not validated');
                echo json_encode($response);
                exit;
            }

            if (!empty($ccID)) {
                $aPaymentData = array(
                    'plan_id' => $planID,
                    'cc_id' => $ccID,
                    'cb_customer_id' => $chargebeeUserID
                );

                $result = $this->cbChargeInvoice($aPaymentData);
                if ($result['status'] == 'success') {
                    $response = array('status' => 'success', 'msg' => 'Transaction was successful!!');
                } else if ($result['status'] == 'error') {
                    $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'Transaction failed or declined');
                } else {
                    $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'No Response from chargebee');
                }
            }

            if ($response['status'] == 'success') {

                $userID = Session::get('customer_user_id');
                //Create a amazon s3 folder
                if ($mLogin->checkS3server()) {

                    $s3Client = new S3Client([
                        'region' => 'us-west-2',
                        'version' => '2006-03-01',
                        'credentials' => [
                            'key' => 'AKIAJ52XK7ZH7VCR7XHQ',
                            'secret' => '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'
                        ],
                        // Set the S3 class to use objects.dreamhost.com/bucket
                        // instead of bucket.objects.dreamhost.com
                        'use_path_style_endpoint' => true
                    ]);

                    $res = $s3Client->putObject(array(
                        'Bucket' => 'brandboost.io', // Defines name of Bucket
                        'Key' => $userID . "/", //Defines Folder name
                        'Body' => "",
                        'ACL' => 'public-read' // Defines Permission to that folder
                    ));

                    $folderName = ['onsite', 'offsite', 'automation', 'broadcast', 'referral', 'nps', 'webchat', 'smschat', 'reviews', 'questions'];

                    $subfolder = ['images', 'videos', 'files'];

                    foreach ($folderName as $value) {
                        $s3Client->putObject(array(
                            'Bucket' => 'brandboost.io', // Defines name of Bucket
                            'Key' => $userID . "/" . $value . '/', //Defines Folder name
                            'Body' => "",
                            'ACL' => 'public-read' // Defines Permission to that folder
                        ));

                        foreach ($subfolder as $subvalue) {
                            $s3Client->putObject(array(
                                'Bucket' => 'brandboost.io', // Defines name of Bucket
                                'Key' => $userID . "/" . $value . '/' . $subvalue . '/', //Defines Folder name
                                'Body' => "",
                                'ACL' => 'public-read' // Defines Permission to that folder
                            ));
                        }
                    }

                    $mLogin->updateS3server();
                }
                //End a amazon s3 folder



                $localErrors = array();
                //Credit account usage limit as per the plan or other operation
                //Create subaccount on Twilio

                $newUserName = 1000000 + $userID . '@brandboost.io';
                $userData = $mUser->getUserTwilioData($userID);
                if (empty($userData)) {
                    //Create Twilio sub account
                    $twilioSubAccountData = createTwilioSA($userID, $newUserName);
                    $twilioData = json_decode($twilioSubAccountData);

                    if (!empty($twilioData->sid)) {
                        $data = array('account_sid' => $twilioData->sid, 'account_token' => $twilioData->authToken, 'user_id' => $userID, 'account_status' => 'active', 'created' => date("Y-m-d H:i:s"));
                        $bAdded = $mUser->addUserTwilioData($data);
                        if (!$bAdded) {
                            $localErrors[] = 'Twilio sub account created successfully but failed to store into the database locally';
                        }
                    } else {
                        $localErrors[] = 'Twilio sub account creation failed';
                    }
                }

                //Create subaccount at sendgrid
                $addUserData = $mUser->getUserSendGridData($userID);

                if (empty($addUserData)) {
                    $ip = "168.245.71.20";
                    $password = $randstring;
                    $sdResult = createSendGridSubAccount($newUserName, $newUserName, $password, $ip);

                    $sgResponse = json_decode($sdResult);
                    $sendgridUserID = isset($sgResponse->user_id) ? $sgResponse->user_id : '';

                    if (empty($sendgridUserID)) {
                        $localErrors[] = 'Sendgrid sub account creation failed';
                    }

                    //Update Webhook notification settings
                    $bUpdated = updateSendgridNotificationSettings($newUserName);

                    $sdData = array(
                        'user_id' => $userID,
                        'sg_username' => $newUserName,
                        'sg_email' => $newUserName,
                        'sg_password' => $password,
                        'sg_ip' => $ip,
                        'status' => 1,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $bAdded = $mUser->addUserSendGridData($sdData);
                    if (!$bAdded) {
                        $localErrors[] = 'Sendgrid sub account created successfully but failed to store into the database locally';
                    }
                }

                //Send Email
                sendEmailTemplate('welcome', $userID);

                //Send Notification
                $aNotificationDataCus = array(
                    'user_id' => $userID,
                    'event_type' => 'user_registration',
                    'message' => 'Welcome to brandboost',
                    'link' => base_url() . 'admin/profile/',
                    'created' => date("Y-m-d H:i:s")
                );
                $eventName = "sys_new_user_registration";
                @add_notifications($aNotificationDataCus, $eventName, $userID, $notifyAdmin = true);

                //$bRefilled = $this->refillAccount($userID, $planID);
                $bRefilled = refillPlanBenefits($userID, $planID);

                if (!$bRefilled) {
                    $localErrors[] = 'Account refilling failed for the purchased product';
                }

                //Send Notification to admin in case of any failure occured even after successful charge
                if (!empty($localErrors)) {
                    //Send notification now
                    $aNotificationAdmin = array(
                        'user_id' => 1,
                        'event_type' => 'post_payment_account_setup_errors',
                        'message' => "Client with id {$userID} needs to setup these errors manaually: " . implode("<br>", $localErrors),
                        'link' => base_url() . 'admin/notifications',
                        'meta_data' => json_encode(array('failed_user_id' => isset($userIDs) ? $userID : '', 'errors' => $localErrors)),
                        'created' => date("Y-m-d H:i:s")
                    );
                    $eventName = 'error';
                    @add_notifications($aNotificationAdmin, $eventName, 1);
                }
                //Clear order form session data
                Session::put('orderFormData', '');
            }

            echo json_encode($response);
            exit;
        } catch (Exception $ex) {
            echo 'Error Message: ' .$ex->getMessage();
        }
    }

    // cb charge end

    public function cbUserRegistration($aData = array()) {
        //Instantiate Chargebee model to get its properties and methods
        $mChargeBee = new ChargeBeeModel();

        //Instantiate Signup model to get its properties and methods
        $mSignup = new SignupModel();

        $response = array();
        $firstName = $aData['firstname'];
        $lastName = $aData['lastname'];
        $email = $aData['email'];
        //$country = $aData['country'];
        $phone = $aData['phone'];
        $zip = $aData['zip'];
        $password = $aData['password'];
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $pwd = base64_encode($password . $password_hash . $siteSalt);

        $aChargebeeData = array(
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            //'country' => $country,
            'phone' => $phone,
            'zip' => $zip
        );

        $chargebeeUserID = $mChargeBee->createContact($aChargebeeData);

        if ($chargebeeUserID > 0) {
            //Add the same in orderFormData session
            $aData = Session::get('orderFormData');
            $aData['cb_contact_id'] = $chargebeeUserID;
            $aOrderFormData = array(
                'orderFormData' => $aData,
            );
            Session::put($aOrderFormData);
            $data = array(
                'cb_contact_id' => $chargebeeUserID,
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'mobile' => $phone,
                'user_role' => 3,
                'status' => 1,
                'password' => $pwd,
                'created' => date("Y-m-d H:i:s")
            );

            //Add User locally in BB database
            $userID = $mSignup->addUser($data);

            if ($userID > 0) {

                Session::put("customer_user_id", $userID);
                return $chargebeeUserID;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $planID
     * @return type
     */
    public function getAccountUsageforRecharge($planID) {
        //Instantiate product model to get its properites and methods
        $mProducts = new ProductsModel();

        $aProduct = $mProducts->getCBPlanInfo($planID);
        if (!empty($aProduct)) {
            $productName = $aProduct['product_name'];
            $productType = $aProduct['data']->type;
            $duration = $aProduct['data']->subs_cycle;
            $aUsage = array(
                'credits' => ($aProduct['data']->credits) ? $aProduct['data']->credits : 0,
                'contact_limit' => ($aProduct['data']->contact_limit) ? $aProduct['data']->contact_limit : 0,
                'email_limit' => ($aProduct['data']->email_limit) ? $aProduct['data']->email_limit : 0,
                'sms_limit' => ($aProduct['data']->sms_limit) ? $aProduct['data']->sms_limit : 0,
                'mms_limit' => ($aProduct['data']->mms_limit) ? $aProduct['data']->mms_limit : 0,
                'text_review_limit' => ($aProduct['data']->text_review_limit) ? $aProduct['data']->text_review_limit : 0,
                'video_review_limit' => ($aProduct['data']->video_review_limit) ? $aProduct['data']->video_review_limit : 0,
                'topup_email_limit' => ($aProduct['data']->topup_email_limit) ? $aProduct['data']->topup_email_limit : 0,
                'topup_sms_limit' => ($aProduct['data']->topup_sms_limit) ? $aProduct['data']->topup_sms_limit : 0,
                'subscription_plan_id' => $planID,
                'product_type' => $productType,
                'billing_cycle' => $duration
            );

            return $aUsage;
        }
    }

    public function refillAccount($userID, $planID, $quantity = 0) {
        //Instantiate Users Model to get its properties and methods
        $mUser = new UsersModel();

        //Check if member purchased the product
        $bDone = false;
        $aUser = $mUser->getCurrentAccountUsage($userID);

        if (!empty($aUser)) {
            //Available Credits
            $credits = $aUser->credits;
            $contactLimit = $aUser->contact_limit;
            $emailLimit = $aUser->email_balance;
            $smsLimit = $aUser->sms_balance;
            $mmsLimit = $aUser->mms_balance;
            $reviewLimit = $aUser->text_review_balance;
            $videoLimit = $aUser->video_review_balance;
            $creditsTopup = $aUser->credits_topup;
            $contactLimitTopup = $aUser->contact_limit_topup;
            $emailTopupLimit = $aUser->topup_email_limit;
            $smsTopupLimit = $aUser->sms_balance_topup;
            $mmsTopupLimit = $aUser->mms_balance_topup;
            $subscriptionPlanID = $aUser->subscription_plan_id;
        }
        //pre($aUser);
        //Get Account Usage for Refill
        $aUsage = $this->getAccountUsageforRecharge($planID);
        //pre($aUsage);
        if (!empty($aUsage)) {
            $productType = $aUsage['product_type'];
            $rCredits = ($productType == 'membership') ? $aUsage['credits'] : $credits;
            $rContactLimit = ($productType == 'membership') ? $aUsage['contact_limit'] : $contactLimit;
            $rEmailLimit = $aUsage['email_limit'];
            $rSMSlLimit = $aUsage['sms_limit'];
            $rMMSLimit = $aUsage['mms_limit'];
            $rTextReviewLimit = $aUsage['text_review_limit'];
            $rVideoReviewLimit = $aUsage['video_review_limit'];
            $rCreditsTopup = ($productType == 'membership') ? $creditsTopup : ($creditsTopup + $aUsage['credits']);
            $rContactLimitTopup = ($productType == 'membership') ? $contactLimitTopup : ($contactLimitTopup + $aUsage['contact_limit']);
            $rTopEmailLimit = $aUsage['topup_email_limit'];
            $rTopupSmsLimit = $aUsage['topup_sms_limit'];
            $rTopupMMSLimit = $aUsage['topup_mms_limit'];
            $qty = ($quantity > 0) ? $quantity : 1;
            $aHistory = array(
                'user_id' => $userID,
                'refill_type' => $productType,
                'credits' => ($productType == 'membership') ? $aUsage['credits'] : 0,
                'contact_limit' => ($productType == 'membership') ? $aUsage['contact_limit'] : 0,
                'email_limit' => $rEmailLimit,
                'sms_limit' => $rSMSlLimit,
                'mms_limit' => $rMMSLimit,
                'text_review_limit' => $rTextReviewLimit,
                'video_review_limit' => $rVideoReviewLimit,
                'credits_topup' => ($productType == 'membership') ? 0 : $aUsage['credits'] * $qty,
                'contact_limit_topup' => ($productType == 'membership') ? 0 : $aUsage['contact_limit'],
                'email_topup' => $rTopEmailLimit,
                'sms_topup' => $rTopupSmsLimit,
                'mms_topup' => $rTopupMMSLimit,
                'last_unused_credits' => ($credits) ? $credits : 0,
                'last_unused_contact' => $contactLimit ? $contactLimit : 0,
                'last_unused_email' => ($emailLimit) ? $emailLimit : 0,
                'last_unused_sms' => ($smsLimit) ? $smsLimit : 0,
                'last_unused_mms' => ($mmsLimit) ? $mmsLimit : 0,
                'last_unused_text_review' => ($reviewLimit) ? $reviewLimit : 0,
                'last_unused_video_review' => ($videoLimit) ? $videoLimit : 0,
                'last_unused_credits_topup' => ($creditsTopup) ? $creditsTopup : 0,
                'last_unused_contact_limit_topup' => ($contactLimitTopup) ? $contactLimitTopup : 0,
                'last_unused_email_topup' => ($emailTopupLimit) ? $emailTopupLimit : 0,
                'last_unused_sms_topup' => ($smsTopupLimit) ? $smsTopupLimit : 0,
                'last_unused_mms_topup' => ($mmsTopupLimit) ? $mmsTopupLimit : 0,
                'plan_id' => $planID,
                'created' => date("Y-m-d H:i:s")
            );

            if ($productType == 'membership') {
                $aRefill = array(
                    'user_id' => $userID,
                    'credits' => $rCredits,
                    'contact_limit' => $rContactLimit,
                    'email_balance' => $rEmailLimit,
                    'sms_balance' => $rSMSlLimit,
                    'text_review_balance' => $rTextReviewLimit,
                    'video_review_balance' => $rVideoReviewLimit,
                    'subscription_plan_id' => ($planID) ? $planID : $subscriptionPlanID,
                    'last_updated' => date("Y-m-d H:i:s")
                );
            } else if ($productType == 'topup' || $productType == 'topup-membership') {
                $qty = ($quantity > 0) ? $quantity : 1;
                $aRefill = array(
                    'user_id' => $userID,
                    'credits_topup' => $rCreditsTopup * $qty,
                    'contact_limit_topup' => $rContactLimitTopup,
                    'email_balance_topup' => ($rTopEmailLimit + $emailTopupLimit),
                    'sms_balance_topup' => ($rTopupSmsLimit + $smsTopupLimit),
                    'last_updated' => date("Y-m-d H:i:s")
                );
            }

            if (!empty($aRefill)) {
                //Refill Now
                $bRefillResult = $this->mPayment->refillAccount($userID, $aRefill);
                //Log History
                if ($bRefillResult) {
                    $bDone = true;
                    $bLogResult = $this->mPayment->logRefillHistory($aHistory);
                }
            }
        }

        return $bDone;
    }

    public function processdecline(Request $request) {
        $response = array();

        $firstName = (isset($request->firstname) && !empty($request->firstname)) ? $request->firstname : '';
        $lastName = (isset($request->lastname) && !empty($request->lastname)) ? $request->lastname : '';
        $email = (isset($request->email) && !empty($request->email)) ? $request->email : '';
        $country = (isset($request->country) && !empty($request->country)) ? $request->country : '';
        $phone = (isset($request->phone_number) && !empty($request->phone_number)) ? $request->phone_number : '';
        $zip = (isset($request->postal_code) && !empty($request->postal_code)) ? $request->phone_number : '';

        $cc = (isset($request->cardNumber) && !empty($request->cardNumber)) ? $request->cardNumber : false;
        $cctype = (isset($request->creditCardType) && !empty($request->creditCardType)) ? $request->creditCardType : false;
        $expMonth = (isset($request->creditCardExpirationMonth) && !empty($request->creditCardExpirationMonth)) ? $request->creditCardExpirationMonth : false;
        $expYear = (isset($request->creditCardExpirationYear) && !empty($request->creditCardExpirationYear)) ? $request->creditCardExpirationYear : false;
        $cvvCode = (isset($request->creditCardVerificationNumber) && !empty($request->creditCardVerificationNumber)) ? $request->creditCardVerificationNumber : false;

        $invoiceID = (isset($request->invoice_id) && !empty($request->invoice_id)) ? $request->invoice_id : 0;
        $subscriptionID = (isset($request->subscription_id) && !empty($request->subscription_id)) ? $request->subscription_id : 0;
        $paymentType = (isset($request->payment_type) && !empty($request->payment_type)) ? $request->payment_type : 0;

        if ($invoiceID > 0) {

            $addCCData = array(
                'ccNum' => $cc,
                'ccType' => $cctype,
                'expMonth' => $expMonth,
                'expYear' => $expYear,
                'cvv' => $cvvCode
            );

            $ccID = $this->saveInfusionCC($addCCData);

            if ($ccID > 0) {
                $aPaymentData = array(
                    'invoice_id' => $invoiceID,
                    'cc_id' => $ccID,
                    'subscription_id' => $subscriptionID
                );
                $response = $this->chargeDeclinedInvoice($aPaymentData);

                if ($response['status'] == 'success') {
                    $invoiceID = $response['infusion_invoice_id'];
                    $planID = $response['plan_id'];
                    $subscriptionID = $response['subscription_id'];
                    //Credit account usage limit as per the plan or other operation
                    $userID = Session::get('customer_user_id');
                    $this->refillAccount($userID, $planID, $subscriptionID);
                    Session::flash('success_msg', "<strong>" . $response['msg'] . "</strong>");
                    redirect('thankyou');
                } else {
                    if ($response['status'] == 'error' && $response['invoice_id'] > 0) {
                        $queryString = '?inv_id=' . $response['invoice_id'] . '&pid=' . $response['product_id'] . '&sid=' . $response['subscription_id'];
                    }
                    $q = (!empty($queryString)) ? $queryString : '';
                    Session::flash('error_msg', "<strong>" . $response['msg'] . "</strong>");
                    redirect('decline' . $q);
                }
            }
        }
    }

    public function chargeDeclinedInvoice($aData) {

        $response = array();
        $userID = Session::get('customer_user_id');
        $invoiceID = $aData['invoice_id'];
        $subscriptionId = $aData['subscription_id'];
        $ccID = $aData['cc_id'];
        //First validate CC
        $validateCC = $this->validateInfusionCC($ccID);
        if ($validateCC == true) {
            //Get Invoice Details by Invoice ID
            $aInvoiceDetails = $this->mInfusion->getInvoiceDetail($invoiceID);
            if (!empty($aInvoice)) {
                $productID = $aInvoiceDetails->ProductId;
                $itemName = $aInvoiceDetails->ItemName;
                $qty = $aInvoiceDetails->Qty;
                $planID = $aInvoiceDetails->SubscriptionPlanId;
                $ppu = $aInvoiceDetails->PPU;

                $productType = ($planID > 0) ? 'membership' : 'topup';
                //This will deal with both Recurring and one time orders 
                $tranResponse = Infusionsoft_InvoiceService::chargeInvoice($invoiceID, $itemName, $ccID, $this->merchant_id, false);
                if ($tranResponse['Successful'] == 1 && $tranResponse['Code'] == 'Approved') {
                    //Okay Payment Successful, Save invoice related details locally.
                    $aInvoice = $this->mInfusion->getInvoicesForContact($invoiceID);
                    $dataSaveInvoice = array(
                        'infusion_invoice_id' => $aInvoice[0]->Id,
                        'infusion_user_id' => $aInvoice[0]->ContactId,
                        'infusion_job_id' => $aInvoice[0]->JobId,
                        'invoice_total' => $aInvoice[0]->InvoiceTotal,
                        'total_paid' => $aInvoice[0]->TotalPaid,
                        'total_due' => $aInvoice[0]->TotalDue,
                        'pay_status' => $aInvoice[0]->PayStatus,
                        'description' => $aInvoice[0]->Description,
                        'subscription_plan_id' => ($planID) ? $planID : 0,
                        'mid' => $this->merchant_id,
                        'created' => date("Y-m-d H:i:s", strtotime($aInvoice[0]->DateCreated))
                    );

                    $saveInvoiceID = $this->mPayment->saveInvoice($dataSaveInvoice);
                    $jobID = $aInvoice[0]->JobId;

                    $aInvoiceDetails = $this->mInfusion->getInvoiceDetail($invoiceID);
                    if (!empty($aInvoiceDetails)) {
                        foreach ($aInvoiceDetails as $dInvoice) {

                            $invoiceDetailData = array(
                                "infusion_user_id" => $contactID,
                                "infusion_invoice_id" => $dInvoice->OrderId,
                                "infusion_product_id" => $dInvoice->ProductId,
                                "item_name" => $dInvoice->ItemName,
                                "item_description" => $dInvoice->ItemDescription,
                                "item_quantity" => $dInvoice->Qty,
                                "price_per_unit" => $dInvoice->PPU,
                                "notes" => $dInvoice->Notes,
                                "product_type" => $productType,
                                "subscription_plan_id" => $dInvoice->SubscriptionPlanId,
                                "subscription_id" => $subscriptionId,
                                "card_type" => $cctype,
                                "created" => date("Y-m-d H:i:s")
                            );
                            $saveInvoiceDetails = $this->mPayment->saveInvoiceDetails($invoiceDetailData);

                            if ($saveInvoiceID) {
                                if ($jobID > 0) {
                                    $aJob = $this->mInfusion->getJob($jobID);
                                    $dataSaveJob = array(
                                        'infusion_job_id' => $aJob[0]->Id,
                                        'infusion_user_id' => $aJob[0]->ContactId,
                                        'job_title' => $aJob[0]->JobTitle,
                                        'due_date' => $aJob[0]->DueDate,
                                        'created' => $aJob[0]->DateCreated,
                                    );
                                    $saveJobID = $this->mPayment->saveJob($dataSaveJob);
                                    $response = array('status' => 'success', 'msg' => 'Congratulation, Your payment was successful!');
                                } else {
                                    $response = array('status' => 'success', 'msg' => 'Congratulation, Your payment was successful, but Could not get JobID. Contact to our support');
                                    echo "";
                                }
                            } else {
                                $response = array('status' => 'success', 'msg' => 'Congratulation, Your payment was successful, but could not get Invoice details. Contact to our support');
                            }
                        }
                    }
                    $response = array('status' => 'success', 'msg' => 'Congratulation, Your payment was successful!', 'infusion_invoice_id' => $invoiceID, 'product_id' => $productID, 'subscription_id' => $subscriptionId);
                } else {
                    $response = array('status' => 'error', 'msg' => 'Payment declined', 'product_id' => $productID, 'invoice_id' => $invoiceID, 'subscription_id' => $subscriptionId);
                }
            } else {
                $response = array('status' => 'error', 'msg' => 'Decline Invoice Id is missing');
            }
        }

        return $response;
    }

    /*
      // This function is use for upgrade membership
     */

    public function upgradeMembership(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        //Instantiate Chargebee model to get its properties and methods
        $mChargeBee = new ChargeBeeModel();


        $subscriptionID = $oUser->subscription_id;
        $post = Input::post();
        if (!empty($request)) {
            $planID = $request->plan_id;
            $userID = Session::get('customer_user_id');
            $mPayment = new PaymentModel();
            $aUserSubscription = $mPayment->getCurrentUserSubscription($userID, $subscriptionID);
            //echo "Subscription ID is ". $subscriptionID;
            //pre($aUserSubscription);
            //die;
            if (!empty($aUserSubscription)) {

                if (!empty($aUserSubscription[0])) {
                    $aUserSubscription = $aUserSubscription[0];
                }
                $subscriptionID = $aUserSubscription->subscription_id;
                //echo "Subscription id is ". $subscriptionID;
                if (!empty($subscriptionID)) {
                    $userID = Session::get('customer_user_id');
                    $cbContactID = $oUser->cb_contact_id;
                    $cbPaymentSourceID = $oUser->chargebee_cc_id;
                    //echo "Payment Source ID is ". $cbPaymentSourceID;
                    if (!empty($cbPaymentSourceID)) {
                        if (!empty($planID)) {
                            //Upgrade Membership now
                            $aInput = array(
                                "planId" => $planID,
                                "trialEnd" => 0
                            );
                            list($invoice, $oRes) = cbHelperUpdateSubscription($subscriptionID, $aInput);
                            //pre($oRes);
                            //die;
                            if (!empty($oRes)) {
                                $subsID = $oRes->id;
                                $updatedTime = $oRes->updatedAt;
                                if ($subscriptionID == $subsID) {
                                    //End subscription locally
                                    $bEnded = $mChargeBee->endSubscription($subscriptionID, $updatedTime);
                                    if ($bEnded) {
                                        //Save subscription locally
                                        $bSaveSubscription = $mChargeBee->saveCBSubscription($oRes, 'membership');
                                        if ($bSaveSubscription) {
                                            //update previous membership status
                                            //$bRefilled = $this->refillAccount($userID, $planID);
                                            $bRefilled = refillPlanBenefits($userID, $planID);
                                            if ($bRefilled) {
                                                //Add Useractivity log
                                                $aActivityData = array(
                                                    'user_id' => $userID,
                                                    'event_type' => 'upgraded_membership',
                                                    'action_name' => 'upgraded',
                                                    'brandboost_id' => '',
                                                    'campaign_id' => '',
                                                    'inviter_id' => '',
                                                    'subscriber_id' => '',
                                                    'feedback_id' => '',
                                                    'activity_message' => 'Membership Upgraded',
                                                    'activity_created' => date("Y-m-d H:i:s")
                                                );
                                                logUserActivity($aActivityData);


                                                $response = array('status' => 'success', 'msg' => 'Membership upgraded succesfully');
                                                //Send Notication to Admin + member
                                                //Send Email
                                                sendEmailTemplate('upgrade-membership', $userID);
                                                //Send Notification
                                                $aNotificationDataCus = array(
                                                    'user_id' => $userID,
                                                    'event_type' => 'upgrade-membership',
                                                    'message' => 'Your membership have been upgraded successfully',
                                                    'link' => base_url() . 'admin/profile/',
                                                    'created' => date("Y-m-d H:i:s")
                                                );
                                                $eventName = 'sys_upgraded_membership';
                                                add_notifications($aNotificationDataCus, $eventName, $userID, $notifyAdmin = 1);
                                            } else {
                                                $response = array('status' => 'error', 'msg' => 'Account upgraded successfully, but credtis could not updated');
                                            }
                                        } else {
                                            $response = array('status' => 'error', 'msg' => 'Could not updated new subscription plan, please contact to support to resolve this error');
                                        }
                                    } else {
                                        $response = array('status' => 'error', 'msg' => 'Failed to updated current susbcription');
                                    }
                                } else {
                                    $response = array('status' => 'error', 'msg' => 'Unknown Error');
                                }
                            } else {
                                $response = array('status' => 'error', 'msg' => 'No response from merchant, please contact to support');
                            }
                        } else {
                            $response = array('status' => 'error', 'msg' => 'Plan id is missing');
                        }
                    } else {
                        $response = array('status' => 'error', 'msg' => 'Payment source id is missing');
                    }
                } else {
                    $response = array('status' => 'error', 'msg' => 'Current subscription id is missing');
                }
            } else {
                $response = array('status' => 'error', 'msg' => 'No user subscription found');
            }
        } else {
            $response = array('status' => 'error', 'msg' => 'Invalid post request');
        }

        echo json_encode($response);
        exit;
    }

    public function upgradeTopupMembership(Request $request) {


        if (!empty($request)) {
            $planID = $request->toup_plan_id;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;

        //Instantiate Chargebee model to get its properties and methods
        $mChargeBee = new ChargeBeeModel();

        if ($user_role != 1 && !empty($planID)) {
            //Do not do anything if admin logged in
            $topupSubscriptionID = $oUser->topup_subscription_id;
            $cbUserID = $oUser->cb_contact_id;
            $ccID = $oUser->chargebee_cc_id;
            if (empty($topupSubscriptionID) && !empty($cbUserID) && !empty($ccID)) {
                //Buy topup subscription plan
                $aPaymentData = array(
                    'plan_id' => $planID,
                    'cc_id' => $ccID,
                    'cb_customer_id' => $cbUserID
                );
                $result = $this->cbChargeInvoice($aPaymentData);
                if ($result['status'] == 'success') {
                    //$bRefilled = $this->refillAccount($userID, $planID);
                    $bRefilled = refillPlanBenefits($userID, $planID);

                    if ($bRefilled) {
                        //Add Useractivity log
                        $aActivityData = array(
                            'user_id' => $userID,
                            'event_type' => 'upgraded_topup_membership',
                            'action_name' => 'upgraded',
                            'brandboost_id' => '',
                            'campaign_id' => '',
                            'inviter_id' => '',
                            'subscriber_id' => '',
                            'feedback_id' => '',
                            'activity_message' => 'TopupMembership Upgraded',
                            'activity_created' => date("Y-m-d H:i:s")
                        );
                        logUserActivity($aActivityData);


                        $response = array('status' => 'success', 'msg' => 'Topup Membership upgraded succesfully');
                        //Send Notication to Admin + member
                        //Send Email
                        sendEmailTemplate('upgrade-membership', $userID);
                        //Send Notification
                        $aNotificationDataCus = array(
                            'user_id' => $userID,
                            'event_type' => 'upgrade-topup-membership',
                            'message' => 'Your topup membership have been upgraded successfully',
                            'link' => base_url() . 'admin/profile/',
                            'created' => date("Y-m-d H:i:s")
                        );
                        $eventName = 'sys_upgraded_topup_membership';
                        add_notifications($aNotificationDataCus, $eventName, $userID, $notifyAdmin = 1);
                    } else {
                        $response = array('status' => 'error', 'msg' => 'Account upgraded successfully, but credtis could not updated');
                    }
                } else if ($result['status'] == 'error') {
                    $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'Transaction failed or declined');
                } else {
                    $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'No Response from chargebee');
                }
            } else {
                //upgrade topup subscription plan
                if (!empty($cbUserID) && !empty($ccID)) {
                    $aInput = array(
                        "planId" => $planID,
                        "trialEnd" => 0
                    );

                    list($invoice, $oRes) = cbHelperUpdateSubscription($topupSubscriptionID, $aInput);

                    if (!empty($oRes)) {
                        $subsID = $oRes->id;
                        $updatedTime = $oRes->updatedAt;
                        if ($topupSubscriptionID == $subsID) {
                            $bEnded = $mChargeBee->endSubscription($topupSubscriptionID, $updatedTime);
                            if ($bEnded) {
                                $bSaveSubscription = $mChargeBee->saveCBSubscription($oRes, 'topup-membership');
                                if ($bSaveSubscription) {
                                    //update previous membership status
                                    //$bRefilled = $this->refillAccount($userID, $planID);
                                    $bRefilled = refillPlanBenefits($userID, $planID);

                                    if ($bRefilled) {
                                        //Add Useractivity log
                                        $aActivityData = array(
                                            'user_id' => $userID,
                                            'event_type' => 'upgraded_topup_membership',
                                            'action_name' => 'upgraded',
                                            'brandboost_id' => '',
                                            'campaign_id' => '',
                                            'inviter_id' => '',
                                            'subscriber_id' => '',
                                            'feedback_id' => '',
                                            'activity_message' => 'Membership Upgraded',
                                            'activity_created' => date("Y-m-d H:i:s")
                                        );
                                        logUserActivity($aActivityData);


                                        $response = array('status' => 'success', 'msg' => 'Membership upgraded succesfully');
                                        //Send Notication to Admin + member
                                        //Send Email
                                        sendEmailTemplate('upgrade-membership', $userID);
                                        //Send Notification
                                        $aNotificationDataCus = array(
                                            'user_id' => $userID,
                                            'event_type' => 'upgrade-topup-membership',
                                            'message' => 'Your topup membership have been upgraded successfully',
                                            'link' => base_url() . 'admin/profile/',
                                            'created' => date("Y-m-d H:i:s")
                                        );
                                        $eventName = 'sys_upgraded_topup_membership';
                                        add_notifications($aNotificationDataCus, $eventName, $userID, $notifyAdmin = "1");
                                    } else {
                                        $response = array('status' => 'error', 'msg' => 'Account upgraded successfully, but credtis could not updated');
                                    }
                                } else {
                                    $response = array('status' => 'error', 'msg' => 'Could not updated new subscription plan, please contact to support to resolve this error');
                                }
                            } else {
                                $response = array('status' => 'error', 'msg' => 'Failed to updated current susbcription');
                            }
                        } else {
                            $response = array('status' => 'error', 'msg' => 'Unknown Error');
                        }
                    } else {
                        $response = array('status' => 'error', 'msg' => 'No response from merchant, please contact to support');
                    }
                }
            }
        }

        echo json_encode($response);
        exit;
    }

    public function buyCreditAddons(Request $request) {


        if (!empty($request)) {
            $planID = $request->toup_plan_id;
            $quantity = $request->quantity;
        }
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;

        if ($user_role != 1 && !empty($planID)) {
            //Do not do anything if admin logged in
            $cbUserID = $oUser->cb_contact_id;
            $ccID = $oUser->chargebee_cc_id;
            if (!empty($cbUserID) && !empty($ccID)) {
                //Buy topup subscription plan
                $aPaymentData = array(
                    'plan_id' => $planID,
                    'cc_id' => $ccID,
                    'cb_customer_id' => $cbUserID,
                    'quantity' => ($quantity > 0) ? $quantity : 1
                );
                $result = $this->cbChargeInvoice($aPaymentData);
                if ($result['status'] == 'success') {
                    //$bRefilled = $this->refillAccount($userID, $planID, $quantity);
                    $bRefilled = refillPlanBenefits($userID, $planID, $quantity);

                    if ($bRefilled) {
                        //Add Useractivity log
                        $aActivityData = array(
                            'user_id' => $userID,
                            'event_type' => 'buy-addons-credit-pack',
                            'action_name' => 'Bought addons credit pack',
                            'brandboost_id' => '',
                            'campaign_id' => '',
                            'inviter_id' => '',
                            'subscriber_id' => '',
                            'feedback_id' => '',
                            'activity_message' => 'Bought addons credit pack',
                            'activity_created' => date("Y-m-d H:i:s")
                        );
                        logUserActivity($aActivityData);


                        $response = array('status' => 'success', 'msg' => 'Addons pack purchased succesfully');
                        //Send Notication to Admin + member
                        //Send Email
                        //sendEmailTemplate('upgrade-membership', $userID);
                        //Send Notification
                        $aNotificationDataCus = array(
                            'user_id' => $userID,
                            'event_type' => 'buy-addons-credit-pack',
                            'message' => 'You have purchased addons pack successfully',
                            'link' => base_url() . 'admin/profile/',
                            'created' => date("Y-m-d H:i:s")
                        );
                        $eventName = 'sys_upgraded_topup_membership';
                        add_notifications($aNotificationDataCus, $eventName, $userID, $notifyAdmin = 1);
                    } else {
                        $response = array('status' => 'error', 'msg' => 'Addon Pack purchased successfully, but credtis could not updated');
                    }
                } else if ($result['status'] == 'error') {
                    $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'Transaction failed or declined');
                } else {
                    $response = array('status' => 'error', 'error_type' => 'decline', 'msg' => 'No Response from chargebee');
                }
            }
        }

        echo json_encode($response);
        exit;
    }

    public function changeSubscription(Request $request) {
        try {

            //Instantiate Chargebee model to get its properties and methods
            $mChargeBee = new ChargeBeeModel();

            $response = array();

            if (!empty($request)) {
                $subscriptionID = $request->subid;
                $actionName = $request->action;
                $adminID = Session::get('admin_user_id');
                if ($adminID > 0) {
                    if ($actionName == 'cancel') {
                        $oRes = cbHelperCancelSubscription($subscriptionID);
                        if (!empty($oRes)) {
                            $changedStatus = $oRes->status;
                            $updatedTime = $oRes->updatedAt;
                        } else {
                            $response = array('status' => 'error', 'msg' => 'No response from merchant');
                        }
                    } else if ($actionName == 'reactivate') {
                        $oRes = cbHelperCancelSubscription($subscriptionID);
                        if (!empty($oRes)) {
                            $changedStatus = $oRes->status;
                            $updatedTime = $oRes->updatedAt;
                            if (!empty($changedStatus)) {
                                $bUpdated = $mChargeBee->updateSubscription($subscriptionID, $changedStatus);
                                if ($bUpdated) {
                                    $response = array('status' => 'success', 'msg' => 'Membership cancelled succesfully');
                                }
                            }
                        } else {
                            $response = array('status' => 'error', 'msg' => 'No response from merchant');
                        }
                    } else if ($actionName == 'pause') {
                        $oRes = cbHelperPauseSubscription($subscriptionID);
                        //pre($oRes);
                        if (!empty($oRes)) {
                            $changedStatus = $oRes->status;
                            $updatedTime = $oRes->updatedAt;
                        } else {
                            $response = array('status' => 'error', 'msg' => 'No response from merchant');
                        }
                    } else if ($actionName == 'resume') {
                        $oRes = cbHelperResumeSubscription($subscriptionID);
                        //pre($oRes);
                        if (!empty($oRes)) {
                            $changedStatus = $oRes->status;
                            $updatedTime = $oRes->updatedAt;
                        } else {
                            $response = array('status' => 'error', 'msg' => 'No response from merchant');
                        }
                    } else if ($actionName == 'delete') {
                        $oRes = cbHelperDeleteSubscription($subscriptionID);
                        if (!empty($oRes)) {
                            $changedStatus = (!empty($oRes->status)) ? 'deleted' : $oRes->status;
                            $updatedTime = $oRes->updatedAt;
                        } else {
                            $response = array('status' => 'error', 'msg' => 'No response from merchant');
                        }
                    }

                    if (!empty($changedStatus)) {
                        $bUpdated = $mChargeBee->updateSubscription($subscriptionID, $changedStatus, $updatedTime);
                        if ($bUpdated) {
                            $response = array('status' => 'success', 'msg' => 'Membership updated succesfully. Current status: ' . $changedStatus);
                        }
                    } else {
                        $response = array('status' => 'error', 'msg' => 'Unknown error: No Status found');
                    }
                } else {
                    $response = array('status' => 'error', 'msg' => 'This action is valid only for admin');
                }
            }
            echo json_encode($response);
            exit;
        } catch (Exception $ex) {
            $response = array('status' => 'error', 'msg' => 'Critical unknown error found' . $ex);
            echo json_encode($response);
            exit;
        }
    }

}
