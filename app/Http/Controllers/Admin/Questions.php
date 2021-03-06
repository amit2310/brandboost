<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\QuestionModel;
//use App\Models\SignupModel;
use App\Models\Admin\TagsModel;
use Illuminate\Support\Facades\Input;
use Session;

class Questions extends Controller {

	/**
	* Used to get question data
	* @param type $campaignId
	* @return type
	*/
    public function index($campaignId = 0) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

		$mQuestion = new QuestionModel();
		$mBrandboost = new BrandboostModel();
		$mUsers = new UsersModel();

        $oQuestions = $mQuestion->getAllBrandboostQuestions($userID);
        $bActiveSubsription = $mUsers->isActiveSubscription();

        $aBreadcrumb = array(
            'Home' => '#/',
            'Onsite Questions' => '#/brandboost/questions/'
        );

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">On Site </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Questions" class="sidebar-control active hidden-xs ">Questions</a></li>
                    </ul>';

        $aData = array(
            'title' => 'Onsite Questions',
            'breadcrumb' => $aBreadcrumb,
            'pagename' => $breadcrumb,
            'allData' => $oQuestions,
            'oQuestions' => $oQuestions->items(),
            'campaignId' => $campaignId,
            'bActiveSubsription' => $bActiveSubsription
        );

		//return view('admin.question.question_list', $aData);

        echo json_encode($aData);
        exit();
    }

	/**
	* Used to get questions list by campaign id
	* @param type $campaignId
	* @return type
	*/
	public function questionView($campaignId) {
        if (!empty($campaignId)) {

            $oBrandboost = BrandboostModel::getBrandboost($campaignId);
            $oQuestions = QuestionModel::getBrandboostQuestions($campaignId);
            $bActiveSubsription = UsersModel::isActiveSubscription();

            $aBreadcrumb = array(
                'Home' => '#/',
                'Onsite Questions' => '#/brandboost/questions/'
            );

            /*$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/brandboost/onsite_setup/' . $campaignId) . '">' . $oBrandboost[0]->brand_title . '</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Questions" class="sidebar-control active hidden-xs ">Questions</a></li>
                </ul>';*/

            $aData = array(
                'title' => 'Onsite Questions',
                'breadcrumb' => $aBreadcrumb,
                /*'pagename' => $breadcrumb,*/
                'allData' => $oQuestions,
                'oQuestions' => $oQuestions->items(),
                'campaignId' => $campaignId,
                'bActiveSubsription' => $bActiveSubsription
            );

			//return view('admin.question.question_list', $aData);

            echo json_encode($aData);
            exit();
        }
    }

	/**
	* Used to get questions details data by question id
	* @param type $questionID
	* @return type
	*/
	public function questionDetails(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $questionID = $request->id;
        $selectedTab = $request->input('t');
		$quesID = $request->questionID;
		$actionName = $request->action;
        $questionID = ($quesID > 0) ? $quesID : $questionID;
        $oQuestion = QuestionModel::getQuestionDetails($questionID);
        $oAnswers = QuestionModel::getAllAnswer($questionID);
        $oTags = TagsModel::getTagsDataByQuestionID($questionID);
        $oNotes = QuestionModel::getQuestionNotes($questionID);
        $mUser = new UsersModel();
        $mSubscriber = new SubscriberModel();
        $mQuestion = new QuestionModel();

        /*if (!empty($oAnswers)) {
            $brandboostID = $oAnswers[0]->campaign_id;
        }*/

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/questions') . '" class="sidebar-control hidden-xs">Question </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Details" class="sidebar-control active hidden-xs ">Details</a></li>
                    </ul>';

        $aData = array(
            'title' => 'Question Details',
            'pagename' => $breadcrumb,
            'oQuestion' => $oQuestion,
            'oAnswers' => $oAnswers,
            'oTags' => $oTags,
            'oNotes' => $oNotes,
            'selectedTab' => $selectedTab,
            'brandboostID' => '',
            'userID' => $userID
        );

        if ($actionName == 'smart-popup') {
			$popupContent =  view('admin.components.smart-popup.questions', $aData)->with(['mUser'=> $mUser, 'mSubscriber'=>$mSubscriber, 'mQuestion'=>$mQuestion])->render();
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        } else {
			return view('admin.question.question_details', $aData);
        }
    }


	public function deleteMultipalQuestion(Request $request) {
		$mQuestion = new QuestionModel();

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $multiQuestionid = $request->multiQuestionid;
        foreach ($multiQuestionid as $questionid) {

            $result = $mQuestion->deleteQuestion($questionid);
        }
        if ($result) {
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'multipal_question_delete',
                'action_name' => 'question_delete',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Question deleted',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    public function deleteQuestion(Request $request) {
		$mQuestion = new QuestionModel();

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $questionID = $request->questionID;
        $result = $mQuestion->deleteQuestion($questionID);
        if ($result) {
             $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'question_delete',
                'action_name' => 'question_delete',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Question deleted',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

	/**
	* Used to add questions
	* @return type
	*/
    public function add() {
		$mBrandboost = new BrandboostModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/questions/') . '">Questions</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Add Questions" class="sidebar-control active hidden-xs ">Add Questions</a></li>
                </ul>';

        if ($user_role == 1) {
            $aBrandboostList = $mBrandboost->getBrandboost('', 'onsite');
        } else {
            $aBrandboostList = $mBrandboost->getBrandboostByUserId($userID, 'onsite');
        }

        $aData = array(
            'title' => 'Onsite Questions',
            'pagename' => $breadcrumb,
            'aBrandboostList' => $aBrandboostList,
            'aUser' => $aUser
        );

		return view('admin.question.add_question', $aData);
    }


    public function saveManualQuestion(Request $request) {

		$mUser = new UsersModel();
		$mSubscriber = new SubscriberModel();
		$mQuestion  = new QuestionModel();
		$mBrandboost = new BrandboostModel();
        $response = array();

        $oUser = getLoggedUser();
        $currentUserID = $oUser->id;
        if (!empty($request)) {
            $userID = $request->user_id;
            $headLine = $request->title;
            $question = $request->description;
            $campaignID = $request->campaign_id;
            $quesStatus = $request->questionStatus;

            $oBrandboost = $mBrandboost->getBrandboost($campaignID);

            if (!empty($oBrandboost)) {
                $campaignOwnerID = $oBrandboost[0]->user_id;
                $campaignName = $oBrandboost[0]->brand_title;
                if ($campaignOwnerID > 0) {
                    $oOwner = $mUser->getUserInfo($campaignOwnerID);
                    $clientFirstName = $oOwner->firstname;
                    $clientLastName = $oOwner->lastname;
                    $clientEmail = $oOwner->email;
                }
            }

            $fullName = $request->fullname;
            $email = $request->emailid;
            $phone = $request->phone;
            $display_name = $request->display_name;
            if (!empty($display_name)) {
                $showName = 0;
            } else {
                $showName = 1;
            }

            //getLocationInfoByIp
            $getLocationInfoByIp = getLocationInfoByIp();
            $countryCode = $getLocationInfoByIp['countryCode'];
            $city = $getLocationInfoByIp['city'];
            $country = $getLocationInfoByIp['country'];
            $bRequireGlobalSubs = false;
            $aName = explode(' ', $fullName, 2);
            $firstName = $aName[0];
            $lastName = $aName[1];


            //Uploaded Question file
            $questionFile = $request->question_uploaded_name;
            $aQuestionFiles = array();

            foreach ($questionFile['media_url'] as $key => $fileData) {
                $aQuestionFiles[$key]['media_url'] = $fileData;
                $aQuestionFiles[$key]['media_type'] = $questionFile['media_type'][$key];
            }
            if (empty($fullName) || empty($email)) {
                //Display errors, fields should not be blank
                $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                return json_encode($response);
            }

            if (empty($userID)) {

                $moduleName = 'brandboost';
                $moduleAccountID = $campaignID;
                $bAlreadyExists = 0;
                $bUserAlreadyExists = 0;

                $oUserAccount = $mUser->checkEmailExistData($email);

                if (!empty($oUserAccount)) {
                    $emailUserId = $oUserAccount[0]->id;
                    $bUserAlreadyExists = 1;
                }


                $oGlobalUser = $mSubscriber->checkIfGlobalSubscriberExists($currentUserID, 'email', $email);

                if (!empty($oGlobalUser)) {
                    $iSubscriberID = $oGlobalUser->id;
                    $bAlreadyExists = 1;

                    // check brandboost user

                    $getBrandSubs = $mSubscriber->getSubsByBrandboostId($campaignID, $iSubscriberID);

                    if(!empty($getBrandSubs) && $getBrandSubs > 0) {
                        $updateBrandSubs = $mSubscriber->updateSubsByBrandboostId($campaignID, $iSubscriberID, $iUserID);
                    }
                    else {
                        $insertBrandSubs = $mSubscriber->insertSubsByBrandboostId($campaignID, $iSubscriberID, $iUserID);
                    }
                } else {

                    //Add global subscriber
                    $aSubscriberData = array(
                        'owner_id' => $currentUserID,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $email,
                        'phone' => $phone,
                        'country_code' => $countryCode,
                        'cityName' => $city,
                        'created' => date("Y-m-d H:i:s")
                    );
                    if (!empty($emailUserId)) {
                        $aSubscriberData['user_id'] = $emailUserId;
                    }
                    $iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
                }


                if ($bUserAlreadyExists == 0) { //This means no user_id attached to subscriber
                    //My Code
                    $aRegistrationData = array(
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => $email,
                        'mobile' => $phone,
                        'country' => $countryCode,
                        'city' => $city,
                        'ext_country_code' => $countryCode
                    );
                    //pre($aRegistrationData);
                    $emailUserId = $mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);

                    if ($emailUserId > 0) {

                        $bData = array(
                            'subscriber_id' => $iSubscriberID,
                            'user_id' => $emailUserId,
                            'brandboost_id' => $campaignID

                        );
                        //pre($bData);

                        $getBrandSubs = $mSubscriber->getSubsByBrandboostId($campaignID, $iSubscriberID);

                        if(!empty($getBrandSubs) && $getBrandSubs > 0) {
                            $updateBrandSubs = $mSubscriber->updateSubsByBrandboostId($campaignID, $iSubscriberID, $emailUserId);

                        }
                        $bRequireGlobalSubs = true;
                    }

                }


                if ($emailUserId > 0 && $bRequireGlobalSubs == true) {
                    $aUpdateGlobalSubsData = array(
                        'user_id' => $emailUserId,
                        'updated' => date("Y-m-d H:i:s")
                    );
                    $globalSubscriberID = $iSubscriberID;

                    $bUpdated = $mSubscriber->updateGlobalSubscriber($aUpdateGlobalSubsData, $globalSubscriberID);

                }

                if (empty($emailUserId)) {
                    $response = array('status' => 'error', 'msg' => 'User registration has failed');
                    return json_encode($response);
                }

                if ($bAlreadyExists == 0) {
                    if (!empty($moduleName)) {
                        $aData = array(
                            'user_id' => $emailUserId,
                            'subscriber_id' => $iSubscriberID,
                            'created' => date("Y-m-d H:i:s")
                        );

                        if ($moduleName == 'list') {
                            $aData['list_id'] = $moduleAccountID;
                            $tableName = 'tbl_automation_users';
                        } else if ($moduleName == 'brandboost') {
                            $aData['brandboost_id'] = $moduleAccountID;
                            $tableName = 'tbl_brandboost_users';
                        } else if ($moduleName == 'referral') {
                            $aData['account_id'] = $moduleAccountID;
                            $tableName = 'tbl_referral_users';
                        } else if ($moduleName == 'nps') {
                            $aData['account_id'] = $moduleAccountID;
                            $tableName = 'tbl_nps_users';
                        }

                        //pre($aData);

                        if (!empty($tableName)) {
                            $result = $mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
                        }


                        if ($result || $iSubscriberID) {
                            //Add Useractivity log
                            $aActivityData = array(
                                'user_id' => $emailUserId,
                                'module_name' => $moduleName,
                                'module_account_id' => $moduleAccountID,
                                'event_type' => 'add_subscriber',
                                'action_name' => 'added_contact',
                                'list_id' => '',
                                'brandboost_id' => '',
                                'campaign_id' => '',
                                'inviter_id' => '',
                                'subscriber_id' => '',
                                'feedback_id' => '',
                                'activity_message' => 'Added subscriber into the list',
                                'activity_created' => date("Y-m-d H:i:s")
                            );
                            logUserActivity($aActivityData);
                            $response['status'] = 'success';
                            $response['msg'] = 'Contact added successfully.';
                            $response['id'] = $result;
                        } else {
                            $response['status'] = "Error";
                        }
                    }
                }

                $subscriberID = $iSubscriberID;
            }


            // Add Question

            $aData = array(
                'user_id' => $emailUserId,
                'question_title' => $headLine,
                'question' => $question,
                'campaign_id' => $campaignID,
                'media_url' => serialize($aQuestionFiles),
                'allow_show_name' => $showName,
                'status' => $quesStatus,
                'created' => date("Y-m-d H:i:s")
            );

            $questionID = $mQuestion->addQuestion($aData);
            if ($questionID) {

                $aActivityData = array(
                    'user_id' => $emailUserId,
                    'event_type' => 'brandboost_question',
                    'action_name' => 'added_question',
                    'brandboost_id' => '',
                    'campaign_id' => $campaignID,
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'New Question added',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);

                //Get Tracking Data
                //Get Location based data
                $aLocationData = getLocationData();
                $aTrackData = array(
                    'question_id' => $questionID,
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

                $mQuestion->trackQuestionGeo($aTrackData);

                //Notify Campaign Owner
                if ($campaignOwnerID > 0) {
                    //Send Notification
                    $aNotificationData = array(
                        'user_id' => $campaignOwnerID,
                        'event_type' => 'added_onsite_questions',
                        'message' => 'New Onsite Question',
                        'link' => base_url() . 'admin/questions/details/' . $questionID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $eventName = 'added_onsite_questions';
                    add_notifications($aNotificationData, $eventName, $campaignOwnerID);

                    //Send out email to client
                    $aTagsKey = array('{FIRST_NAME}', '{LAST_NAME}', '{CAMPAIGN_NAME_URL}', '{QUESTION}', '{AUTHOR_NAME}', '{CLICK_TO_REPLY_LINK}');
                    $authorName = $firstName . ' '. $lastName;
                    $campaignNameURL = '<a href="' . base_url('admin/brandboost/onsite_setup/' . $campaignID) . '">' . $campaignName . '</a>';
                    $replyLink = '<a href="'.base_url('admin/questions/details/' . $questionID) .'">Click here to answer this question</a>';
                    $aTagsVal = array($clientFirstName, $clientLastName, $campaignNameURL, $question, $authorName, $replyLink);

					$questionNotifyHtml =  view('admin.email_templates.question.question_notification', $aData)->render();
                    $compiledHtml = str_replace($aTagsKey, $aTagsVal, $questionNotifyHtml);
                    $subject = 'You got a question on your bandboost campaign called '.$campaignName;
                    sendEmail($clientEmail, $compiledHtml, $subject);
                }


                //Notify Subscriber
                if ($userID > 0) {
                    //Send Notification
                    $aNotificationDataCust = array(
                        'user_id' => $userID,
                        'event_type' => 'added_onsite_questions_subscriber',
                        'message' => 'Question posted successfully.',
                        'link' => base_url() . 'admin/login',
                        'created' => date("Y-m-d H:i:s")
                    );
                    $eventName2 = 'added_onsite_questions_subscriber';
                    add_notifications($aNotificationDataCust, $eventName2, $userID);
                }

                $response = array('status' => 'ok', 'msg' => 'Thank you for posting your question. Your question was sent successfully and is now waiting to publish it.');
            } else {
                $response = array('status' => 'error', 'msg' => 'Error while posting your question. Try again');
            }

            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to save the question
    * @param type
    * @return type
    */

    public function saveNewQuestion(Request $request) {

        $response = array();

         $mUser = new UsersModel();
         $mSubscriber = new SubscriberModel();
         $mQuestion  = new QuestionModel();
        if (!empty($request)) {
            $headLine = $request->title;
            $question = $request->description;
            $campaignID = $request->campaign_id;

            $fullName = $request->fullname;
            $email = $request->emailid;
            $mobile = $request->phone;
            $display_name = $request->display_name;
            if (!empty($display_name)) {
                $showName = 0;
            } else {
                $showName = 1;
            }


            //Uploaded Question file
            $questionFile = $request->question_uploaded_name;
            $aQuestionFiles = array();

            foreach ($questionFile['media_url'] as $key => $fileData) {
                $aQuestionFiles[$key]['media_url'] = $fileData;
                $aQuestionFiles[$key]['media_type'] = $questionFile['media_type'][$key];
                }
            if (empty($fullName) || empty($email)) {
                //Display errors, fields should not be blank
                $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                return json_encode($response);
            }

            $bRequireGlobalSubs = false;
            //Check if user exist
            $userID = $mUser->checkIfUser(array('email' => $email));

            // User does not exists then registration
            if ($userID == false) {
                //Check if exists in subscriber list

                $subscriberID = $mUser->checkIfSubscriber(array('email' => $email));

                if ($subscriberID > 0) {

                    $aSubscriber = $mUser->getSubscriberInfo($subscriberID);
                    $firstName = $aSubscriber->firstname;
                    $lastName = $aSubscriber->lastname;

                    $fullName = $firstName . ' ' . $lastName;
                    $email = $aSubscriber->email;
                    $mobile = $aSubscriber->mobile;
                    $userID = $aSubscriber->user_id;
                    $globalSubscriberID = $aSubscriber->id;

                    if ($userID > 0) {
                        $bRequireGlobalSubs = true;
                    }
                }


                if (empty($fullName) || empty($email)) {
                    //Display errors, fields should not be blank
                    $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                    return json_encode($response);
                }

                if ($bRequireGlobalSubs == false) { //This means no user_id attached to subscriber
                    //My Code
                    $aNameChunks = explode(" ", $fullName);
                    $firstName = $aNameChunks[0];
                    $lastName = str_replace($firstName, "", $fullName);
                    $aRegistrationData = array(
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => $email,
                        'mobile' => $mobile,
                    );
                    $userID = $mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
                    if ($userID > 0) {
                        $bRequireGlobalSubs = true;
                    }
                }



                if ($userID > 0 && $bRequireGlobalSubs == true) {
                    $aUpdateGlobalSubsData = array(
                        'user_id' => $userID,
                        'updated' => date("Y-m-d H:i:s")
                    );

                    $bUpdated = $mSubscriber->updateGlobalSubscriber($aUpdateGlobalSubsData, $globalSubscriberID);
                }

                if (empty($userID)) {
                    $response = array('status' => 'error', 'msg' => 'User registration has failed');
                    return json_encode($response);
                }
            }

            // Add Question

            $aData = array(
                'user_id' => $userID,
                'question_title' => $headLine,
                'question' => $question,
                'campaign_id' => $campaignID,
                'media_url' => serialize($aQuestionFiles),
                'allow_show_name' => $showName,
                'created' => date("Y-m-d H:i:s")
            );


            $questionID = $mQuestion->addQuestion($aData);
            if ($questionID) {
                //Get Tracking Data
                //Get Location based data
                $aLocationData = getLocationData();
                $aTrackData = array(
                    'question_id' => $questionID,
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

                $mQuestion->trackQuestionGeo($aTrackData);

                // Send Notification
                $aNotificationData = array(
                    'user_id' => $userID,
                    'event_type' => 'added_question',
                    'message' => 'Question has been added successfully',
                    'created' => date("Y-m-d H:i:s")
                );
                add_notifications($aNotificationData); //called from helper function

                $response = array('status' => 'ok', 'msg' => 'Thank you for posting your question. Your question was sent successfully and is now waiting to publish it.');
            } else {
                $response = array('status' => 'error', 'msg' => 'Error while posting your question. Try again');
            }

            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to update answer status
    * @param type
    * @return type
    */
    public function update_answer_status(Request $request) {

        $response = array();

        if ($request->answer_id) {

            $answerID = base64_url_decode(strip_tags($request->answer_id));
            $status = strip_tags($request->status);

            $aData = array(
                'status' => $status,
                'updated' => date("Y-m-d H:i:s")
            );
            $mQuestion = new QuestionModel();
            $result = $mQuestion->updateAnswer($aData, $answerID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Status has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
    * This function is used to update answer status
    * @param type
    * @return type
    */
    public function getAnswer(Request $request) {

        $response = array();

        if ($request->answerID) {
            $mQuestion = new QuestionModel();
            $answerID = base64_url_decode(strip_tags($request->answerID));
            $result = $mQuestion->getAnswerInfo($answerID);

            if ($result) {
                $response['status'] = 'success';
                $response['answer'] = base64_decode($result->answer);
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
    * This function is used to update answer
    * @param type
    * @return type
    */
    public function updateAnswer(Request $request) {

        $response = array();

        if ($request->txtAnswer) {

            $answer = strip_tags($request->txtAnswer);
            $answerID = base64_url_decode(strip_tags($request->answerId));

            $aData = array(
                'answer' => base64_encode($answer),
                'updated' => date("Y-m-d H:i:s")
            );

            $mQuestion = new QuestionModel();
            $result = $mQuestion->updateAnswer($aData, $answerID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Answer has been add successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
    * This function is used to save question notes
    * @param type
    * @return type
    */
    public function saveQuestionNotes(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($request)) {
            $questionID = base64_url_decode($request->question_id);
            $brandboostID = $request->bid;
            $clientID = $request->cid;
            $sNotes = $request->notes;
            $aNotesData = array(
                'question_id' => $questionID,
                'user_id' => $userID, //$clientID,
                'brandboost_id' => $brandboostID,
                'notes' => $sNotes,
                'created' => date("Y-m-d H:i:s")
            );
            $mQuestion = new QuestionModel();
            $bSaved = $mQuestion->saveQuestionNotes($aNotesData);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been added succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to get question notes
    * @param type
    * @return type
    */
    public function getQuestionNotes(Request $request) {

        $response = array();
        $response['status'] = 'error';

        if ($request->noteid) {
            $mQuestion = new QuestionModel();
            $noteData = $mQuestion->getQuestionNoteInfo($request->noteid);
            if ($noteData) {
                $response['status'] = 'success';
                $response['result'] = $noteData;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to update question note
    * @param type
    * @return type
    */
    public function updateQuestionNote(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (!empty($request->edit_noteid)) {
            $noteId = strip_tags($request->edit_noteid);
            $sNotes = $request->edit_note_content;
            $aNotesData = array(
                'notes' => $sNotes,
                'user_id' => $userID,
                'updated' => date("Y-m-d H:i:s")
            );

            $mQuestion = new QuestionModel();
            $bSaved = $mQuestion->updateQuestionNote($aNotesData, $noteId);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been updated succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to delete question note
    * @param type
    * @return type
    */
    public function deleteQuestionNote(Request $request) {
        $response = array();

        $noteid = $request->noteid;
        $mQuestion = new QuestionModel();
        $result = $mQuestion->deleteQuestionNote($noteid);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
    * This function is used to update question status
    * @param type
    * @return type
    */
    public function update_question_status(Request $request) {

        $response = array();


        if ($request) {
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $questionID = $request->question_id;
            $status = $request->status;

            $aData = array(
                'status' => $status
            );
            $mQuestion = new QuestionModel();
            $result = $mQuestion->updateQuestion($aData, $questionID);
            if ($result) {

                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'change_question_status',
                    'action_name' => 'change_question_status',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Change question status',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                //logUserActivity($aActivityData);

                $response['status'] = 'success';
                $response['message'] = "Status has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }


    public function get_question_by_Id(Request $request) {

        $response = array();

        if (!empty($request)) {

            $quesID = $request->quesID;
            $result = $this->mQuestion->getAllQuestion($quesID);

            if ($result) {
                $response['status'] = 'success';
                $response['result'] = $result;
                $response['answer'] = base64_decode($result[0]->answer);
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function update_question(Request $request) {

        $response = array();

        if (!empty($request)) {


            $answer = $request->answer;
            $question = $request->question;
            $quesId = $request->quesId;

            $aData = array(
                'question' => $question,
                'answer' => base64_encode($answer),
                'updated' => date("Y-m-d H:i:s")
            );

            $result = $this->mQuestion->updateQuestion($aData, $quesId);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Answer has been add successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
    * This function is used to delete single question
    * @param type
    * @return type
    */
    public function delete_question(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if ($request) {
            $quesID = $request->questionID;
            $mQuestion = new QuestionModel();
            $result = $mQuestion->deleteQuestion($quesID);
            if ($result) {
                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'question_delete',
                    'action_name' => 'question_delete',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Question deleted',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                //logUserActivity($aActivityData);

                $response['status'] = 'success';
                $response['result'] = "Question has been delete successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to delete multipal question
    * @param type
    * @return type
    */
    public function deleteQuestions(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $mQuestion = new QuestionModel();
        if ($request) {
            $quesIDs = $request->multipal_record_id;
            foreach ($quesIDs as $quesID) {
                $result = $mQuestion->deleteQuestion($quesID);
            }
            if ($result) {
                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'question_delete',
                    'action_name' => 'question_delete',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Question deleted',
                    'activity_created' => date("Y-m-d H:i:s")
                );

                //logUserActivity($aActivityData);
                $response['status'] = 'success';
                $response['result'] = "Question has been delete successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function answers($quesId) {

        $result = $this->mQuestion->getAllQuestion($quesId);
        $answer = $this->mQuestion->getAllAnswer($quesId);

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                    <li><a href="' . base_url('admin/questions') . '"> ' . $result[0]->question . '</a></li>
                    <li class="active">Answers</li>
                </ul>';

        $this->template->load('admin/admin_template_new', 'admin/question/answer_list', array('title' => 'Brand Boost Answers', 'pagename' => $breadcrumb, 'question' => $result[0], 'result' => $answer));
    }

    /**
    * This function is use for add answer
    * @param type
    * @return type
    */
    public function add_answer(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $user_role = $oUser->user_role;
        $clientName = $oUser->firstname. ' '. $oUser->lastname;
        $response = array();

        $mQuestion = new QuestionModel();
        $mUser = new UsersModel();
        if ($request->question_id) {

            $questionID = strip_tags(base64_url_decode($request->question_id));
            //get Question details
            $oQuestion = QuestionModel::getQuestionDetails($questionID);
            if (!empty($oQuestion)) {
                $subscriberID = $oQuestion->user_id;
                $sQuestion = $oQuestion->question;
                $oSubscriber = UsersModel::getUserInfo($subscriberID);
                if(!empty($oSubscriber)){
                    $subsFirstName = $oSubscriber->firstname;
                    $subsLastName = $oSubscriber->lastname;
                    $subsEmail = $oSubscriber->email;
                    $authorName = $subsFirstName . ' ' . $subsLastName;

                }
            }


            $answer = strip_tags($request->txtAnswer);

            $aData = array(
                'user_id' => $userID,
                'answer' => base64_encode($answer),
                'question_id' => $questionID,
                'status' => 2,
                'created' => date("Y-m-d H:i:s")
            );

            $result = $mQuestion->addAnswer($aData);
            if ($result) {
                //Notify only customer
                if ($subscriberID > 0) {
                    //Send Notification
                    /*$aNotificationDataCust = array(
                        'user_id' => $subscriberID,
                        'event_type' => 'added_onsite_answers_subscriber',
                        'message' => 'You got a reply',
                        'link' => base_url() . 'admin/login',
                        'created' => date("Y-m-d H:i:s")
                    );
                    $eventName = 'added_onsite_answers_subscriber';
                    add_notifications($aNotificationDataCust, $eventName, $subscriberID);

                    //Send out email to subscriber
                    $aTagsKey = array('{FIRST_NAME}', '{LAST_NAME}', '{QUESTION}', '{ANSWER}', '{AUTHOR_NAME}', '{CLIENT_NAME}');
                    $replyLink = '<a href="'.base_url('admin/questions/details/' . $questionID) .'">Click here to answer this question</a>';
                    $aTagsVal = array($subsFirstName, $subsLastName, nl2br($sQuestion), nl2br($answer), $authorName, $clientName);
                    $answerNotifyHtml = $this->load->view('admin/email_templates/question/answer_notification', array(), true);
                    $compiledHtml = str_replace($aTagsKey, $aTagsVal, $answerNotifyHtml);
                    $subject = 'You got reply on your question at bandboost campaign';
                    sendEmail($subsEmail, $compiledHtml, $subject);*/
                }

                $response['status'] = 'success';
                $response['message'] = "Answer has been add successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is use for delete answer
    * @param type
    * @return type
    */
    public function delete_answer(Request $request) {

        $response = array();

        $mQuestion = new QuestionModel();
        if ($request->answerId) {

            $answerID = base64_url_decode(strip_tags($request->answerId));
            $result = $mQuestion->deleteAnswer($answerID);

            if ($result) {
                $response['status'] = 'success';
                $response['result'] = "Answer has been delete successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }


        }
        echo json_encode($response);
            exit;
    }

    public function deleteAnswers(Request $request) {

        $response = array();

        if (!empty($request)) {

            $ansIDs = $request->multipal_record_id;

            foreach ($ansIDs as $ansID) {
                $result = $this->mQuestion->deleteAnswer($ansID);
            }

            if ($result) {
                $response['status'] = 'success';
                $response['result'] = "Answer has been delete successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function addquestion(Request $request) {
        $response = array();

        if (!empty($request)) {
            $reviewID = $request->qqrid;
            $fullName = $request->qqname;
            $email = $request->qqemail;
            $question = $request->campaignQues;
            $campId = $request->campaignID;

            if (empty($fullName) || empty($email)) {
                //Display errors, fields should not be blank
                $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                return json_encode($response);
            }


            //Check if user exist
            $userID = $this->mUser->checkIfUser(array('email' => $email));
            //echo "user id is ". $userID;
            // User does not exists then registration
            if ($userID == false) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randstring = '';
                for ($i = 0; $i < 7; $i++) {
                    $randstring .= $characters[rand(0, strlen($characters))];
                }
                $password = strip_tags($randstring);
                //Register User
                $aName = explode(' ', $fullName, 2);
                $firstName = $aName[0];
                $lastName = $aName[1];

                $aInfusionData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email
                );

                $infusionUserID = $this->mInfusion->createContact($aInfusionData);

                $password_hash = $this->config->item('password_hash');
                $siteSalt = $this->config->item('siteSalt');
                $pwd = base64_encode($password . $password_hash . $siteSalt);
                $aUserData = array(
                    'infusion_user_id' => $infusionUserID,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'user_role' => 2,
                    'status' => 1,
                    'password' => $pwd,
                    'created' => date("Y-m-d H:i:s")
                );
                $userID = $this->mSignup->addUser($aUserData);
                //Send Email Notification about registration on brandboost
                sendEmailTemplate('welcome', $userID);
            }

            if (empty($userID)) {
                $response = array('status' => 'error', 'msg' => 'User registration has failed');
                return json_encode($response);
            }


            // Add Question

            $aData = array(
                'review_id' => $reviewID,
                'user_id' => $userID,
                'question' => $question,
                'campaign_id' => $campId,
                'created' => date("Y-m-d H:i:s")
            );

            $bSaved = $this->mQuestion->addQuestion($aData);
            if ($bSaved) {
                // Send Notification
                $aNotificationData = array(
                    'user_id' => $userID,
                    'event_type' => 'added_question',
                    'message' => 'Question has been added successfully',
                    'created' => date("Y-m-d H:i:s")
                );
                add_notifications($aNotificationData); //called from helper function

                $response = array('status' => 'ok', 'msg' => 'Thank you for posting your question. Your question was sent successfully and is now waiting to publish it.');
            } else {
                $response = array('status' => 'error', 'msg' => 'Error while posting your question. Try again');
            }

            echo json_encode($response);
            exit;
        }
    }
}
