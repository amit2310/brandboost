<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\FeedbackModel;
use App\Models\Admin\Twillio_model;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\ReviewlistsModel;
use App\Models\Admin\BrandboostModel;
error_reporting(0);

class Feedback extends Controller {


    /**
    * index call 
    * @param type $page
    * @return type
    */

    public function index() {
        $get = array();
        $get = Input::get();
        if (!empty($get)) {
            $subscriberID = $get['subid'];
            $clientID = $get['clid'];
            $bbID = $get['bbid'];
            $redirectURL = $get['redirect'];
            $mFeedback  = new FeedbackModel();
            $mInviter  = new BrandboostModel();
            $mReview  = new ReviewlistsModel();

            if (!empty($bbID)) {
                $aFeedbackResponse = FeedbackModel::getFeedbackResponse($bbID);

                $oBrandboost = BrandboostModel::getBBInfo($bbID);

                pre($oBrandboost);
                die();

                $aSourceLinks = unserialize($oBrandboost->offsites_links);

                if($aFeedbackResponse->count()>0){ $sRatingsType = $aFeedbackResponse->ratings_type; }

                if ($subscriberID > 0) {
                    $oSubscriber = $mReview->getSubscriber($subscriberID);
                }
            }

            $sRatingsType = !(empty($sRatingsType)) ? $sRatingsType : 'happy';

            //get Query string
            $qs = '';
            foreach ($get as $param => $value) {
                $qs = $qs . '&' . $param . '=' . $value;
            }
        }

        //$this->template->load('template', 'feed_back', array('clientId' => $clientID, 'subscriberId' => $subscriberID, 'brandboost_id' => $bbID, 'redirect' => $redirectURL, 'ratingsType' => $sRatingsType, 'aSourceLinks' => $aSourceLinks));
        $aData = array(
            'clientId' => $clientID,
            'subscriberId' => $subscriberID,
            'brandboost_id' => $bbID,
            'oSubscriber' => $oSubscriber,
            'redirect' => $redirectURL,
            'ratingsType' => $sRatingsType,
            'aSourceLinks' => $aSourceLinks,
            'oBrandboost' => $oBrandboost,
            'getParam' => $qs
        );

        if ($page == 'resolution') {
          return view('feedback_collect_resolution', $aData);
        } else if ($page == 'sources' || $page == 'thankyou') {
            return view('feedback_collect_sources', $aData);
        } else {
            return view('feedback_collect', $aData);
        }
    }


    /**
    * function to get resolution values 
    * @param type $page
    * @return type
    */
    public function resolution() {
        $get = array();
        $get = Input::get();
        if (!empty($get)) {
            $subscriberID = $get['subid'];
            $clientID = $get['clid'];
            $bbID = $get['bbid'];
            $redirectURL = $get['redirect'];
            $mFeedback  = FeedbackModel();
            $mInviter = new BrandboostModel();
            $mReview  = new ReviewlistsModel();

            //get more info about the feedback response
            if (!empty($bbID)) {
                $aFeedbackResponse = $mFeedback->getFeedbackResponse($bbID);

                $oBrandboost = $mInviter->getBBInfo($bbID);

                $aSourceLinks = unserialize($oBrandboost->offsites_links);

                $sRatingsType = $aFeedbackResponse->ratings_type;

                if ($subscriberID > 0) {
                    $oSubscriber = $mReview->getSubscriber($subscriberID);
                }
            }

            $sRatingsType = !(empty($sRatingsType)) ? $sRatingsType : 'happy';
        }

        //$this->template->load('template', 'feed_back', array('clientId' => $clientID, 'subscriberId' => $subscriberID, 'brandboost_id' => $bbID, 'redirect' => $redirectURL, 'ratingsType' => $sRatingsType, 'aSourceLinks' => $aSourceLinks));
        $aData = array(
            'clientId' => $clientID,
            'subscriberId' => $subscriberID,
            'brandboost_id' => $bbID,
            'oSubscriber' => $oSubscriber,
            'redirect' => $redirectURL,
            'ratingsType' => $sRatingsType,
            'aSourceLinks' => $aSourceLinks,
            'getParam' => $get
        );
        return view('feedback_collect_resolution', $aData);
    }

    public function thankyou() {
        return view('resolution_thankyou', array('text' => "Thank you for submitting your feedback. We will try to resolve the issue ASAP. We will get back to you soon"));
    }



    /**
    * function is used to save the feedback
    * @param type
    * @return type
    */
    public function saveFeedback() {

        $response = array();
        $post = array();
        $allDone = false;
        if (Input::post()) {
            $post = Input::post();
            $category = strip_tags($post['category']);
            $feedback = strip_tags($post['feedback']);
            $clientId = strip_tags($post['clientId']);
            $subscriberId = $post['subscriberId'];
            $ratingValue = $post['ratingValue'];
            $bbID = strip_tags($post['bbID']);
            $happy = strip_tags($post['happy']);
            $bRequireGlobalSubs = false;
            $mFeedback  = FeedbackModel();
            $mInviter = new BrandboostModel();
            $mReview  = new ReviewlistsModel();
            $mSubscriber  = new SubscriberModel();

            if (!empty($bbID)) {
                $oBrandboost = $mInviter->getBBInfo($bbID);
                $ownerID = $oBrandboost->user_id;
                $eventName = 'sys_offsite_review_add';
            }



            if (!empty($subscriberId)) {
                $aSubscriberInfo = $mFeedback->getSubscriberInfo($subscriberId);
                $firstName = $aSubscriberInfo->firstname;
                $lastName = $aSubscriberInfo->lastname;
                $sName = $firstName . ' ' . $lastName;
                $email = $aSubscriberInfo->email;
                $mobile = $aSubscriberInfo->phone;
                $userID = $aSubscriber->user_id;
                $globalSubscriberID = $aSubscriber->id;
                if ($userID > 0) {
                    $bRequireGlobalSubs = true;
                }
            }

            if ($happy == 'yes') {
                $feedback = 'yes, I am happy';
                $category = "Positive";
            }

            if (!empty($happy)) {
                $aData = array(
                    'category' => $category,
                    'feedback' => $feedback,
                    'client_id' => $clientId,
                    'subscriber_id' => $subscriberId,
                    'brandboost_id' => $bbID,
                    'created' => date("Y-m-d H:i:s")
                );

                $result = $this->mFeedback->add($aData);

                $aFeedbackRes = array(
                    'feedback_type' => $category,
                    'client_id' => $clientId,
                    'feedback' => $feedback,
                    'subscriber_id' => $subscriberId,
                    'rating_value' => $ratingValue,
                    'brandboost_id' => $bbID,
                    'subscriber_name' => $sName,
                    'email' => $email
                );
                $this->sendFeedbackThankyouEmail($aFeedbackRes);

                //Add System Notification
                $aNotification = array(
                    'user_id' => $clientId,
                    'event_type' => 'offsite_happy_feedback',
                    'message' => 'User leaved a offsite feedback',
                    'link' => base_url() . 'admin/feedback',
                    'created' => date("Y-m-d H:i:s")
                );
                add_notifications($aNotification, $eventName, $ownerID);

                if ($result) {
                    $allDone = true;
                }
            }

            if ($allDone == true) {
                if ($bRequireGlobalSubs == false) { //This means no user_id attached to subscriber
                    $aRegistrationData = array(
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => $email,
                        'phone' => $mobile
                    );
                    $aRegistrationData['clientID'] = $ownerID;
                    $userID = $mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);
                    //$userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
                }
            }



            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Template has been add successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);

            exit;
        }
    }

    public function saveFeedback_old() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $category = strip_tags($post['category']);
            $feedback = strip_tags($post['feedback']);
            $clientId = strip_tags($post['clientId']);
            $subscriberId = $post['subscriberId'];
            $bbID = strip_tags($post['bbID']);
            $happy = strip_tags($post['happy']);
            $bRequireGlobalSubs = false;

            if (!empty($bbID)) {
                $oBrandboost = $this->mInviter->getBBInfo($bbID);
                $ownerID = $oBrandboost->user_id;
                $eventName = 'sys_offsite_review_add';
            }




            if (!empty($subscriberId)) {
                $aSubscriberInfo = $this->mFeedback->getSubscriberInfo($subscriberId);
                $firstName = $aSubscriberInfo->firstname;
                $lastName = $aSubscriberInfo->lastname;
                $sName = $firstName . ' ' . $lastName;
                $email = $aSubscriberInfo->email;
                $mobile = $aSubscriberInfo->phone;
                $userID = $aSubscriber->user_id;
                $globalSubscriberID = $aSubscriber->id;
                if ($userID > 0) {
                    $bRequireGlobalSubs = true;
                }
                $aFeedbackRes = array(
                    'feedback_type' => $category,
                    'client_id' => $clientId,
                    'subscriber_id' => $subscriberId,
                    'brandboost_id' => $bbID,
                    'email' => $email
                );
            }

            if ($happy == 'yes') {
                $feedback = 'yes, I am happy';
                $category = "Positive";
            }

            if (!empty($happy)) {
                $aData = array(
                    'category' => $category,
                    'feedback' => $feedback,
                    'client_id' => $clientId,
                    'subscriber_id' => $subscriberId,
                    'brandboost_id' => $bbID,
                    'created' => date("Y-m-d H:i:s")
                );

                $result = $this->mFeedback->add($aData);
                $this->sendFeedbackThankyouEmail($aFeedbackRes);

                //Add System Notification
                $aNotification = array(
                    'user_id' => $clientId,
                    'event_type' => 'offsite_happy_feedback',
                    'message' => 'User leaved a offsite feedback',
                    'link' => base_url() . 'admin/feedback',
                    'created' => date("Y-m-d H:i:s")
                );
                add_notifications($aNotification, $eventName, $ownerID);
            }

            if ($bRequireGlobalSubs == false) { //This means no user_id attached to subscriber
                //My Code
                $aRegistrationData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'mobile' => $mobile
                );
                $userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
                if ($userID > 0) {
                    $bRequireGlobalSubs = true;
                }
            }

            if ($userID > 0 && $bRequireGlobalSubs == true) {
                $aUpdateGlobalSubsData = array(
                    'user_id' => $userID,
                    'updated' => date("Y-m-d H:i:s")
                );

                $bUpdated = $this->mSubscriber->updateGlobalSubscriber($aUpdateGlobalSubsData, $globalSubscriberID);
            }



            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Template has been add successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);

            exit;
        }
    }


    /**
    * function is used for save resolution 
    * @param type
    * @return type
    */

    public function saveResolution() {
        $response = array();
        $post = array();
        $bAllDone = false;
        if (Input::post()) {
            $post = Input::post();
            $clientId = strip_tags($post['clientId']);
            $subscriberId = $post['subscriberId'];
            $bbID = strip_tags($post['bbID']);
            $category = strip_tags($post['category']);
            $title = strip_tags($post['title']);
            $resolutionText = strip_tags($post['resolutionText']);
            $type = strip_tags($post['type']);
            $mFeedback  = FeedbackModel();
            $mInviter = new BrandboostModel();
            $mReview  = new ReviewlistsModel();
            $mSubscriber  = new SubscriberModel();

            if (!empty($bbID)) {
                $oBrandboost = $mInviter->getBBInfo($bbID);
                $ownerID = $oBrandboost->user_id;
                $eventName = 'sys_offsite_review_add';
            }

            $bRequireGlobalSubs = false;


            $aData = array(
                'category' => $category,
                'title' => $title,
                'feedback' => $resolutionText,
                'client_id' => $clientId,
                'subscriber_id' => $subscriberId,
                'brandboost_id' => $bbID,
                'created' => date("Y-m-d H:i:s")
            );

            $result = $mFeedback->add($aData);
            if ($result) {
                $bAllDone = true;
            }

            //Notify Admin about to resolve the issue
            $aNotification = array(
                'user_id' => $clientId,
                'event_type' => 'offsite_resolution_feedback',
                'message' => 'Resolution feedback request',
                'link' => base_url() . 'admin/feedback',
                'created' => date("Y-m-d H:i:s")
            );
            add_notifications($aNotification, $eventName, $ownerID);

            if ($bAllDone == true) {
                if (!empty($subscriberId)) {
                    $aSubscriberInfo = $mFeedback->getSubscriberInfo($subscriberId);
                    if (!empty($aSubscriberInfo)) {
                        $firstName = $aSubscriberInfo->firstname;
                        $lastName = $aSubscriberInfo->lastname;
                        $email = $aSubscriberInfo->email;
                        $mobile = $aSubscriberInfo->phone;
                        $globalSubscriberID = $aSubscriberInfo->id;

                        if ($bRequireGlobalSubs == false) { //This means no user_id attached to subscriber
                            //My Code
                            $aRegistrationData = array(
                                'firstname' => $firstName,
                                'lastname' => $lastName,
                                'email' => $email,
                                'phone' => $mobile
                            );
                            $aRegistrationData['clientID'] = $ownerID;
                            $userID = $mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);
                            //$userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
                        }
                    }
                }
            }

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Resolution feedback accepted";
            } else {
                $response['message'] = "We will revert back to you on this ASAP";
            }

            echo json_encode($response);

            exit;
        }
    }

    public function saveResolution_old() {
        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $clientId = strip_tags($post['clientId']);
            $subscriberId = $post['subscriberId'];
            $bbID = strip_tags($post['bbID']);
            $category = strip_tags($post['category']);
            $title = strip_tags($post['title']);
            $resolutionText = strip_tags($post['resolutionText']);
            $type = strip_tags($post['type']);
            $bRequireGlobalSubs = false;
            if (!empty($subscriberId)) {
                $aSubscriberInfo = $this->mFeedback->getSubscriberInfo($subscriberId);
                if (!empty($aSubscriberInfo)) {
                    if (!empty($bbID)) {
                        $oBrandboost = $this->mInviter->getBBInfo($bbID);
                        $ownerID = $oBrandboost->user_id;
                        $eventName = 'sys_offsite_review_add';
                    }
                    $firstName = $aSubscriberInfo->firstname;
                    $lastName = $aSubscriberInfo->lastname;
                    $email = $aSubscriberInfo->email;
                    $mobile = $aSubscriberInfo->phone;
                    $globalSubscriberID = $aSubscriberInfo->id;

                    if ($bRequireGlobalSubs == false) { //This means no user_id attached to subscriber
                        //My Code
                        $aRegistrationData = array(
                            'firstname' => $firstName,
                            'lastname' => $lastName,
                            'email' => $email,
                            'mobile' => $mobile
                        );
                        $userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
                        if ($userID > 0) {
                            $bRequireGlobalSubs = true;
                        }
                    }

                    if ($userID > 0 && $bRequireGlobalSubs == true) {
                        $aUpdateGlobalSubsData = array(
                            'user_id' => $userID,
                            'updated' => date("Y-m-d H:i:s")
                        );

                        $bUpdated = $this->mSubscriber->updateGlobalSubscriber($aUpdateGlobalSubsData, $globalSubscriberID);
                    }
                }
            }



            $aData = array(
                'category' => $category,
                'title' => $title,
                'feedback' => $resolutionText,
                'client_id' => $clientId,
                'subscriber_id' => $subscriberId,
                'brandboost_id' => $bbID,
                'created' => date("Y-m-d H:i:s")
            );

            $result = $this->mFeedback->add($aData);
            //Notify Admin about to resolve the issue
            $aNotification = array(
                'user_id' => $clientId,
                'event_type' => 'offsite_resolution_feedback',
                'message' => 'Resolution feedback request',
                'link' => base_url() . 'admin/feedback',
                'created' => date("Y-m-d H:i:s")
            );
            add_notifications($aNotification, $eventName, $ownerID);

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Resolution feedback accepted";
            } else {
                $response['message'] = "We will revert back to you on this ASAP";
            }

            echo json_encode($response);

            exit;
        }
    }


    /**
    * This function is used to send feedback thank you email 
    * @param type $clientID
    * @return type
    */

    public function sendFeedbackThankyouEmail($aData) {
        $mFeedback  = FeedbackModel();
        $mInviter = new BrandboostModel();
        $mReview  = new ReviewlistsModel();
        $mSubscriber  = new SubscriberModel();

        if (!empty($aData)) {
            $aFeedbackType = $aData['feedback_type'];
            $aResponse = $mFeedback->getFeedbackResponse($aData['brandboost_id']);
            if (!empty($aResponse)) {
                if ($aFeedbackType == 'Positive') {
                    $sTitle = $aResponse->pos_title;
                    $sSubTitle = $aResponse->pos_sub_title;
                } else if ($aFeedbackType == 'Negative') {
                    $sTitle = $aResponse->neg_title;
                    $sSubTitle = $aResponse->neg_sub_title;
                } else if ($aFeedbackType == 'Neutral') {
                    $sTitle = $aResponse->neu_title;
                    $sSubTitle = $aResponse->neu_sub_title;
                }

                $ratingValue = $aData->rating_value;
                $feedback = $aData->feedback;

                $emailContent = view("feedback_thankyou", array('title' => $sTitle, 'subTitle' => $sSubTitle, 'feedbackType' => $aFeedbackType, 'rating_value' => $ratingValue, 'feedback' => $feedback))->render();
                $subject = "Thank you for submitting your valuable feedback";

                $aSendgridData = $mInviter->getSendgridAccount($aData['client_id']);
                $userName = $aSendgridData->sg_username;
                $password = $aSendgridData->sg_password;

                $aEmailData = array(
                    'username' => $userName,
                    'password' => $password,
                    'email' => $aData['email'],
                    'message' => $emailContent,
                    'subject' => $subject
                );
                $result = sendClientEmail($aEmailData);
                if (empty($result['errors'])) {
                    //Update credits
                    $aUsage = array(
                        'client_id' => $aData['client_id'],
                        'usage_type' => 'email',
                        'content' => $emailContent,
                        'spend_to' => $aData['email'],
                        'spend_from' => '',
                        'module_name' => 'offsite',
                        'module_unit_id' => $aData['brandboost_id']
                    );

                    //$this->mInviter->updateUsage($aUsage);
                    updateCreditUsage($aUsage);
                    //Save Feedback email log
                    $aLog = array(
                        'feedback_type' => $aFeedbackType,
                        'client_id' => $aData['client_id'],
                        'brandboost_id' => $aData['brandboost_id'],
                        'subscriber_id' => $aData['subscriber_id'],
                        'created' => date("Y-m-d H:i:s")
                    );
                    $mFeedback->saveFeedbackLog($aLog);
                }
                return true;
            }
        }
        return true;
    }


     
     /**
    * This function is used for threadreply
    * @param type
    * @return type
    */

    public function threadreply() {

    $mFeedback  = FeedbackModel();
    $mInviter = new BrandboostModel();
    $mReview  = new ReviewlistsModel();
    $mSubscriber  = new SubscriberModel();

        $response = array();
        $post = Input::post();
        if (!empty($post)) {
            $brandboostID = strip_tags($post['bbid']);
            $clientID = strip_tags($post['clid']);
            $subscriberID = strip_tags($post['subsid']);
            $replydata = $post['data'];
            $direction = strip_tags($post['direction']);
            $aUserInfo = $mFeedback->getUserInfoBySubscriberID($subscriberID);
            if (!empty($aUserInfo)) {
                $userID = $aUserInfo->id;
                $email = $aUserInfo->semail;
            }

            $aData = array(
                'client_id' => $clientID,
                'subscriber_id' => $subscriberID,
                'brandboost_id' => $brandboostID,
                'feedback' => $replydata,
                'direction' => $direction,
                'created' => date("Y-m-d H:i:s")
            );
            $bSaved = $mFeedback->saveThreadReply($aData);

            if ($bSaved == true) {
                //Send Notification
                if ($userID > 0) {
                    $aNotification = array(
                        'user_id' => $userID,
                        'event_type' => 'offsite_feedback_reply',
                        'message' => 'you got reply on your feedback',
                        'link' => base_url() . 'feedback',
                        'created' => date("Y-m-d H:i:s")
                    );
                    $eventName = 'sys_offsite_feedback_reply';
                    add_notifications($aNotification, $eventName, $userID);
                }


                //Send Email
                if ($direction == 'client') {
                    //send email from client account
                    $subject = "Thank you for your valuable feedback";
                    $aSendgridData = $this->mInviter->getSendgridAccount($clientID);
                    $userName = $aSendgridData->sg_username;
                    $password = $aSendgridData->sg_password;

                    $aEmailData = array(
                        'username' => $userName,
                        'password' => $password,
                        'email' => $email,
                        'message' => $replydata,
                        'subject' => $subject
                    );
                    $result = sendClientEmail($aEmailData);
                    if (empty($result['errors'])) {

                        if ($direction == 'client') {

                            //Update credits
                            $aUsage = array(
                                'client_id' => $clientID,
                                'usage_type' => 'email',
                                'content' => $replydata,
                                'spend_to' => $email,
                                'spend_from' => '',
                                'module_name' => 'offsite',
                                'module_unit_id' => $brandboostID
                            );
                            //$this->mInviter->updateUsage($aUsage);
                            updateCreditUsage($aUsage);

                            //Save Feedback email log
                            $aLog = array(
                                'feedback_type' => $aFeedbackType,
                                'client_id' => $clientID,
                                'brandboost_id' => $brandboostID,
                                'subscriber_id' => $subscriberID,
                                'created' => date("Y-m-d H:i:s")
                            );
                            $mFeedback->saveFeedbackLog($aLog);
                        }
                    }
                } else {
                    //No need to send email to client, as we are already notifying through brandboost notification system
                    $result = true;
                }




                if ($result) {
                    $response['status'] = 'success';
                    $response['message'] = "Reply sent successfully";
                } else {
                    $response['message'] = "Something went wrong";
                }

                echo json_encode($response);

                exit;
            }
        }
    }

}
