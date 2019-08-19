<?php
namespace App\Http\Controllers;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

use Illuminate\Http\Request;
use App\Models\Admin\Modules\NpsModel;
use App\Models\Admin\SubscriberModel;
use Session;

class Nps extends Controller {


    public function index() {
        /* $referrerKey = get_cookie("ctrack");
          echo "Referrer Key is " . $referrerKey;
          echo '<b><hr>';
          print_r($_COOKIE);
          die; */
    }

    public function display_widget($widgetName = '', $accountID = '', $subId = '') {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $mNPS = new NpsModel();
        if (!empty($accountID) && !empty($widgetName)) {
            if ($widgetName == 'nps') {
                $oNPS = NpsModel::getSurveyInfoByRef($accountID);
                $oSubscriber = '';
                if ($subId != '') {
                    $oSubscriber = $mNPS->getNPSSubscriberDataBySubId($subId);
                    //pre($oSubscriber);
                }
                $widgetData = array(
                    'accountID' => $accountID,
                    'oNPS' => $oNPS,
                    'oSubscriber' => $oSubscriber
                );
                $content = view("admin.modules.nps.widgets.nps", $widgetData)->render();
            }
            $aData = array('content' => utf8_encode($content));
            echo json_encode($aData);
            exit;
        }
    }

    public function recordSurvey(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $mNPS = new NpsModel();
        $mSubscriber = new SubscriberModel();
        if (!empty($request->bbaid)) {
            $accountID = strip_tags($request->bbaid);
            $fullName = strip_tags($request->bbnpsname);
            $aName = explode(' ', $fullName, 2);
            $firstName = $aName[0];
            if(!empty($aName[1])) {
                $lastName = $aName[1];
            }
            else {
                $lastName = '';
            }
            $email = strip_tags($request->bbnpsemail);
            $title = strip_tags($request->bbnpstitle);
            $description = strip_tags($request->bbnpsdesc);
            $score = strip_tags($request->score);
            //$oNPS = $this->mNPS->getSurveyInfoByRef($accountID);
            if (!empty($accountID)) {
                $oNPS = $mNPS->getNPSProgramInfo($accountID);
            }

            
            if (!empty($oNPS)) {
                $clientID = $oNPS->user_id;
                $aRegistrationData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'phone' => ''
                );
                $aRegistrationData['clientID'] = $clientID;
				$userID = '';
				if($email != ''){
					$userID = $mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);
				}

                $aUserData = array(
                    'email' => $email,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'accountID' => $accountID
                );
				
				if($email != ''){
					$userID = $this->registerNow($aUserData);
				}

                //Get Location based data
                $aLocationData = getLocationData();
                $aTrackData = array(
                    'refkey' => $accountID,
                    'subscriber_id' => $userID,
                    'score' => $score,
                    'feedback_fullname' => $fullName,
                    'feedback_email' => $email,
                    'title' => $title,
                    'feedback' => $description,
                    'ip_address' => $aLocationData['ip_address'],
                    'platform' => $aLocationData['platform'],
                    'platform_device' => $aLocationData['platform_device'],
                    'browser' => $aLocationData['name'],
                    'useragent' => $aLocationData['userAgent'],
                    'country' => $aLocationData['country'],
                    'countryCode' => $aLocationData['countryCode'],
                    'region' => $aLocationData['region'],
                    'city' => $aLocationData['city'],
                    'longitude' => $aLocationData['longitude'],
                    'latitude' => $aLocationData['latitude'],
                    'created_at' => date("Y-m-d H:i:s")
                );
                $bResponseID = $mNPS->saveSurveyFeedback($aTrackData);
                if ($bResponseID > 0) {
                    $response = array('status' => 'success', 'msg' => 'Survey submitted successfully!');
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function t($refKey) {
        $bRequireGlobalSubs = false;
        $bAllDone = false;
        if (!empty($refKey)) {
            $get = $this->input->get();
            $score = strip_tags($get['s']);
            $subid = strip_tags($get['subid']);
            $subid = base64_decode($subid);

            if ($subid > 0 && !empty($refKey)) {
                $oNPS = $this->mNPS->getSurveyInfoByRef($refKey);
                if (!empty($oNPS)) {
                    $storeURL = $oStore->store_url;
                    //Track visit
                    $aLocationData = getLocationData();
                    $aTrackData = array(
                        'refkey' => $refKey,
                        'score' => $score,
                        'subscriber_id' => $subid,
                        'ip_address' => $aLocationData['ip_address'],
                        'platform' => $aLocationData['platform'],
                        'platform_device' => $aLocationData['platform_device'],
                        'browser' => $aLocationData['name'],
                        'useragent' => $aLocationData['userAgent'],
                        'country' => $aLocationData['country'],
                        'countryCode' => $aLocationData['countryCode'],
                        'region' => $aLocationData['region'],
                        'city' => $aLocationData['city'],
                        'longitude' => $aLocationData['longitude'],
                        'latitude' => $aLocationData['latitude'],
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    $bResponseID = $this->mNPS->saveSurveyFeedback($aTrackData);
                    if ($bResponseID > 0) {
                        $bAllDone = true;

                        if ($bAllDone == true) {
                            //$oSubscriber = $this->mNPS->getNpsUserById($subid);
                            $oSubscriber = $this->mSubscriber->getSubscribersById($subid);
                            
                            if (!empty($oSubscriber)) {
                                $firstName = $oSubscriber->firstname;
                                $lastName = $oSubscriber->lastname;
                                $email = $oSubscriber->email;
                                $mobile = $oSubscriber->phone;
                                $bbUserID = $oSubscriber->user_id;
                                if ($bbUserID > 0) {
                                    $bRequireGlobalSubs = true;
                                }
                            }

                            //Register as brandboost user if not registered
                            if ($bRequireGlobalSubs == false) { //This means no user_id attached to subscriber
                                //My Code
                                $aRegistrationData = array(
                                    'firstname' => $firstName,
                                    'lastname' => $lastName,
                                    'email' => $email,
                                    'phone' => $mobile
                                );
                                $aRegistrationData['clientID'] = $oNPS->user_id;
                                $userID = $this->mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);
                                //$userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
                            }
                        }
                        //Send out notification
                        $notificationData = array(
                            'event_type' => 'added_nps_score',
                            'event_id' => 0,
                            'link' => base_url() . 'admin/modules/nps/setup/' . $oNPS->id,
                            'message' => 'Added new nps score',
                            'user_id' => $oNPS->user_id,
                            'status' => 1,
                            'created' => date("Y-m-d H:i:s")
                        );
                        $eventName = 'sys_nps_score_add';
                        add_notifications($notificationData, $eventName, $oNPS->user_id);
                        $this->load->view('admin/modules/nps/collect-feedback.php', array('oNPS' => $oNPS, 'score' => $score, 'responseID' => $bResponseID));
                    }
                }
            }
        }
    }

    public function t_old($refKey) {
        $bRequireGlobalSubs = false;
        if (!empty($refKey)) {
            $get = $this->input->get();
            $score = strip_tags($get['s']);
            $subid = strip_tags($get['subid']);
            $subid = base64_decode($subid);
            $oSubscriber = $this->mNPS->getNpsUserById($subid);
            if (!empty($oSubscriber)) {
                $firstName = $oSubscriber->firstname;
                $lastName = $oSubscriber->lastname;
                $email = $oSubscriber->email;
                $mobile = $oSubscriber->phone;
                $bbUserID = $oSubscriber->bb_user_id;
                $globalSubscriberID = $oSubscriber->global_user_id;
                if ($bbUserID > 0) {
                    $bRequireGlobalSubs = true;
                }
            }
            if ($subid > 0 && !empty($refKey)) {
                $oNPS = $this->mNPS->getSurveyInfoByRef($refKey);
                if (!empty($oNPS)) {
                    $storeURL = $oStore->store_url;
                    //Track visit
                    $aLocationData = getLocationData();
                    $aTrackData = array(
                        'refkey' => $refKey,
                        'score' => $score,
                        'subscriber_id' => $subid,
                        'ip_address' => $aLocationData['ip_address'],
                        'platform' => $aLocationData['platform'],
                        'platform_device' => $aLocationData['platform_device'],
                        'browser' => $aLocationData['name'],
                        'useragent' => $aLocationData['userAgent'],
                        'country' => $aLocationData['country'],
                        'countryCode' => $aLocationData['countryCode'],
                        'region' => $aLocationData['region'],
                        'city' => $aLocationData['city'],
                        'longitude' => $aLocationData['longitude'],
                        'latitude' => $aLocationData['latitude'],
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    $bResponseID = $this->mNPS->saveSurveyFeedback($aTrackData);
                    if ($bResponseID > 0) {
                        //Register as brandboost user if not registered
                        if ($bRequireGlobalSubs == false) { //This means no user_id attached to subscriber
                            //My Code
                            $aRegistrationData = array(
                                'firstname' => $firstName,
                                'lastname' => $lastName,
                                'email' => $email,
                                'mobile' => $mobile,
                            );
                            $userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
                            if ($userID > 0) {
                                $bRequireGlobalSubs = true;
                            }
                        }
                        //Send out notification
                        $notificationData = array(
                            'event_type' => 'added_nps_score',
                            'event_id' => 0,
                            'link' => base_url() . 'admin/modules/nps/setup/' . $oNPS->id,
                            'message' => 'Added new nps score',
                            'user_id' => $oNPS->user_id,
                            'status' => 1,
                            'created' => date("Y-m-d H:i:s")
                        );
                        $eventName = 'sys_nps_score_add';
                        add_notifications($notificationData, $eventName, $oNPS->user_id);

                        if ($userID > 0 && $bRequireGlobalSubs == true) {
                            $aUpdateGlobalSubsData = array(
                                'user_id' => $userID,
                                'updated' => date("Y-m-d H:i:s")
                            );

                            $bUpdated = $this->mSubscriber->updateGlobalSubscriber($aUpdateGlobalSubsData, $globalSubscriberID);
                        }
                        $this->load->view('admin/modules/nps/collect-feedback.php', array('oNPS' => $oNPS, 'score' => $score, 'responseID' => $bResponseID));
                    }
                }
            }
        }
    }

    public function saveFeedback() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        //pre($post);
        if (!empty($post)) {
            $responseID = strip_tags($post['response_id']);
            $feedbackTitle = strip_tags($post['feedbackTitle']);
            $feedbackDesc = strip_tags($post['feedbackDesc']);
            if ($responseID > 0) {
                $aData = array(
                    'title' => $feedbackTitle,
                    'feedback' => $feedbackDesc,
                    'updated_at' => date("Y-m-d H:i:s")
                );

                $oResponse = $this->mNPS->updateSurveyFeedback($aData, $responseID);
                if ($oResponse) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function registerNow($aData) {
        $userID = 0;
        $mNPS = new NpsModel();
        $mSubscriber = new SubscriberModel();
        if (!empty($aData)) {
            $email = $aData['email'];
            $firstName = $aData['firstName'];
            $lastName = $aData['lastName'];
            if(!empty($aData['phone'])) {
                $phone = $aData['phone'];
            }
            else {
                $phone = '';
            }
            
            $accountID = $aData['accountID'];
            if (!empty($accountID)) {
                $oNPS = $mNPS->getNPSProgramInfo($accountID);
            }

            if (!empty($oNPS)) {
                $userID = $oNPS->user_id;
            }

            if ($userID > 0) {
                $oGlobalUser = SubscriberModel::checkIfGlobalSubscriberExists($userID, 'email', $email);
                if (!empty($oGlobalUser)) {
                    $iSubscriberID = $oGlobalUser->id;
                } else {
                    //Add global subscriber
                    $aSubscriberData = array(
                        'owner_id' => $userID,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $email,
                        'phone' => $phone,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $iSubscriberID = SubscriberModel::addGlobalSubscriber($aSubscriberData);
                }
            }

            if (!empty($iSubscriberID)) {
                $oExistingUser = $mNPS->checkIfExistingUser($iSubscriberID, $accountID);
                if (!empty($oExistingUser)) {
                    $userID = $oExistingUser->id;
                } else {
                    //Ok we are good now, go ahead and register a new user
                    $aData = array(
                        'subscriber_id' => $iSubscriberID,
                        'account_id' => $accountID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $userID = $mNPS->addNPSUser($aData);
                }
            }
        }
        return $userID;
    }

    public function unsubscribeUser($accountID, $subscriberID) {
        $response = array();
        $result = $this->mNPS->unsubscribeUser($accountID, $subscriberID);
        if ($result) {
            $slug = 'unsubscribe-subscriber';
            sendEmailTemplate($slug, $subscriberID);
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

}
