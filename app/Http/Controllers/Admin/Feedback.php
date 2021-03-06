<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\SubscriberModel;
use App\Models\FeedbackModel;
use App\Models\Admin\TagsModel;
use App\Models\Admin\Crons\InviterModel;
use Illuminate\Support\Facades\Input;
use Session;

class Feedback extends Controller {

	/**
	* Used to get feedback data list by brandboost id;
	* @param type $request
	* @return type
	*/
	public function getAllListingData($brandboostID = 0,Request $request) {
        $mFeedback  =  new FeedbackModel();
        $items_per_page = $request->get('items_per_page');
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $selectedTab = 'all';
        $getBrandboost = '';
        if ($brandboostID > 0) {
            $getBrandboost = BrandboostModel::getBrandboost($brandboostID);
            $result = $mFeedback->getFeedbackByBrandboostID($brandboostID,$items_per_page);
        } else {
            $result = $mFeedback->getFeedback($userID, $user_role,$items_per_page);
        }
        $resultData =($items_per_page =='All')? $result : $result->items();
        if(!empty($resultData)){
            foreach ($resultData as $key => $data){
                if ($data->category == 'Positive') {
                    $ratingValue = 5;
                } else if ($data->category == 'Neutral') {
                    $ratingValue = 3;
                } else {
                    $ratingValue = 1;
                }
                $smily = ratingView($ratingValue);
                $data->ratings = $ratingValue;
                $data->smily = $smily;
                $resultData[$key] = $data;
            }
        }
        list($canRead, $canWrite) = fetchPermissions('Feedbacks');

        $aBreadcrumb = array(
            'Home' => '#/',
            'Reviews' => '#/reviews/dashboard',
            'Offsite' => '#/reviews/offsite',
            'Feedback' => '#/brandboost/offsite/feedbacks'
        );

        //$feedbackTags = TagsModel::getTagsDataByFeedbackID($feedbackID);
        $feedbackTags = array();
        if(!empty($resultData)) {
            foreach($resultData as $kRev => $vRev) {
                $feedbackTags[$vRev->id] = TagsModel::getTagsDataByFeedbackID($vRev->id);
            }
        }

        $aData = array(
            'title' => 'Requires Attention',
            'breadcrumb' => $aBreadcrumb,
            'brandboostDetail' => $getBrandboost,
            'allData' => $result,
            'result' => $resultData,
            'totalResults' => count($resultData),
            'feedbackTags' => $feedbackTags,
            'canRead' => $canRead,
            'canWrite' => $canWrite
        );

		//return view('admin.feedback.feedback', $aData);

        echo json_encode($aData);
        exit;
    }

	/**
	* Used to get feedback details by feedback id
	* @param type $request
	* @return type
	*/
	public function feedbackDetails(Request $request) {
        $response = array();
        $response['status'] = 'error';
        $feedbackID = $request->id;
        $selectedTab = $request->t;
        $feedID = $request->feedbackid;
        $actionName = $request->action;

        $feedbackID = ($feedID > 0) ? $feedID : $feedbackID;

        if (!empty($feedbackID) && $feedbackID > 0) {
            $oFeedbackData = FeedbackModel::getFeedbackInfo($feedbackID);
            $oFeedbackNotes = FeedbackModel::listFeedbackNotes($feedbackID);
            $oCommentsData = FeedbackModel::getFeedbackParentsComments($feedbackID, false, $start = 0);
            $feedbackTags = TagsModel::getTagsDataByFeedbackID($feedbackID);

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/brandboost/offsite') . '" class="sidebar-control hidden-xs">Off Site </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/feedback/listall/') . '" data-toggle="tooltip" data-placement="bottom" title="Feedback" class="sidebar-control active hidden-xs ">Feedback</a></li>
                    </ul>';
            $aBreadcrumb = array(
                'Home' => '#/',
                'Offsite' => '#/brandboost/review_request/offsite',
                'Review Feedback' => '#/brandboost/offsite/feedbacks',
                'Details' => '#/feedback/'.$feedbackID
            );

            $aData = array(
                'title' => 'Feedback Details',
                'breadcrumb' => $aBreadcrumb,
                'result' => $oFeedbackData,
                'oCommentsData' => $oCommentsData,
                'oNotes' => $oFeedbackNotes,
                'feedbackTags' => $feedbackTags,
                'selectedTab' => $selectedTab
            );


            if ($actionName == 'smart-popup') {
                $popupContent = view('admin.components.smart-popup.feedback', $aData)->render();
                $response['status'] = 'success';
                $response['content'] = $popupContent;
                echo json_encode($response);
                exit;
            } else {
				//return view('admin.feedback.feedback_details', $aData);

                echo json_encode($aData);
                exit;
            }
        }
    }

	/**
	* Used to update feedback status
	* @return type
	*/
	public function updateFeedbackStatus(Request $request) {
        $response = array('status' => 'error', 'message' => 'Something went wrong');
		$feedbackID = $request->fid;
		$status = $request->status;
		$aData = array(
			'status' => $status
		);

		$result = FeedbackModel::updateFeedbackStatus($aData, $feedbackID);
		if ($result) {
			$response = array('status' => 'success', 'message' => 'Feedback status have been changed successfully.');
		}
		echo json_encode($response);
		exit;
    }

	/**
	* Used to update feedback ratings
	* @return type
	*/
	public function updateFeedbackRatings(Request $request) {
        $response = array('status' => 'error', 'message' => 'Something went wrong');
		$feedbackID = $request->fid;
		$status = $request->status;
		$aData = array(
			'category' => $status
		);

		$result = FeedbackModel::updateFeedbackStatus($aData, $feedbackID);
		if ($result) {
			$response = array('status' => 'success', 'message' => 'Feedback status have been changed succesfully.');
		}
		echo json_encode($response);
		exit;
    }





    public function index($brandboostID = '') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $selectedTab = 'all';
        $getBrandboost = '';
        $mBrandboost  = new BrandboostModel();
        $mFeedback  =  new FeedbackModel();
        if ($brandboostID > 0) {
            $getBrandboost = $mBrandboost->getBrandboost($brandboostID);
            $result = $mFeedback->getFeedbackByBrandboostID($brandboostID);
            $selectedTab = Request::input('t');
        } else {
            $result = $mFeedback->getFeedback($userID, $user_role);
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Off Site </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Feedback" class="sidebar-control active hidden-xs ">Feedback</a></li>
                    </ul>';

        $data = array(
            'title' => 'Offsite Brand Boost Feedback',
            'pagename' => $breadcrumb,
            'selected_tab' => $selectedTab,
            'brandboostDetail' => $getBrandboost,
            'result' => $result
        );

        return view('admin.feedback.feedback', $data);
    }

    public function my() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $result = $this->mFeedback->getMyFeedback($userID);

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                    <li class="active">My Feedback</li>
                </ul>';

        $data = array(
            'title' => 'Offsite Brand Boost Feedback',
            'pagename' => $breadcrumb,
            'result' => $result
        );

        $this->template->load('admin/admin_template_new', 'admin/feedback/myfeedback', $data);
    }



    public function thread($brandboostID, $subscriberID = '') {
        //because its not necessary to have an account to leave feedback on the website. So users will have subscriber id
        $clientID = $this->session->userdata['customer_user_id'];
        if (!empty($clientID)) {
            if (!empty($subscriberID))
                $aUserInfo = $this->mFeedback->getUserInfoBySubscriberID($subscriberID);

            $threadData = $this->mFeedback->getThread($clientID, $subscriberID, $brandboostID);

            $aData = array(
                'thread_data' => $threadData,
                'user_data' => $aUserInfo
            );
            $this->template->load('admin/admin_template_main', 'admin/feedback/thread', $aData);
        }
    }

    public function view($brandboostID, $clientID, $subscriberID) {
        //because its not necessary to have an account to leave feedback on the website. So users will have subscriber id
        if (!empty($clientID)) {

            $threadData = $this->mFeedback->getThreadDetails($clientID, $subscriberID, $brandboostID);

            $aData = array(
                'thread_details_data' => $threadData
            );
            $this->template->load('admin/admin_template_new', 'admin/feedback/thread_details', $aData);
        }
    }

    public function displayfeedback(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $feedbackID = $request->fid;
            $campaginTitle = $request->cTitle;
            if ($feedbackID > 0) {
                $oFeedbackData = $this->mFeedback->getFeedbackInfo($feedbackID);
                $oFeedbackNotes = $this->mFeedback->listFeedbackNotes($feedbackID);
                $popupContent = $this->load->view("admin/feedback/feedback_popup", array('oFeedback' => $oFeedbackData, 'oNotes' => $oFeedbackNotes, 'campaignTitle' => $campaginTitle), true);
                $response = array('status' => 'success', 'popup_data' => $popupContent);
            }
        }
        echo json_encode($response);
        exit;
    }

    public function deleteMultipalFeedbackData(Request $request) {


        $mFeedback  = new FeedbackModel();
        if (!empty($request)) {
            $multiFeedbackId = $request->multi_feedback_id;
            //$dataArray = array('status' => '2');
            foreach ($multiFeedbackId as $feedbackId) {
                $mFeedback->deleteFeedbackRecord($feedbackId);
            }
        }

        $response['status'] = 'success';
        echo json_encode($response);
        exit;
    }

    public function deleteFeedback(Request $request) {

        if (!empty($request)) {
            $emailFeedbackID = $request->email_feedback_id;
            $dataArray = array('status' => '2');
            if ($emailFeedbackID) {
                if (count($emailFeedbackID) > 1) {
                    foreach ($emailFeedbackID as $id) {
                        $this->mFeedback->deleteFeedbackData($dataArray, $id);
                    }
                } else {
                    $this->mFeedback->deleteFeedbackData($dataArray, $emailFeedbackID[0]);
                }
            }

            $response['status'] = 'success';
            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to add the feedback notes
    * @param type
    * @return type
    */

    public function saveFeedbackNotes(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $feedbackID = $request->fid;
            $brandboostID = $request->bid;
            $clientID = $request->cid;
            $subscriberID = $request->sid;
            $sNotes = $request->notes;
            $aNotesData = array(
                'feedback_id' => $feedbackID,
                'client_id' => $clientID,
                'subscriber_id' => $subscriberID,
                'brandboost_id' => $brandboostID,
                'notes' => $sNotes,
                'created' => date("Y-m-d H:i:s")
            );
            $mFeedback = new FeedbackModel();

            $bSaved = $mFeedback->saveFeedbackNotes($aNotesData);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been added succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }

    public function previewLiveContent(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        if (!empty($request)) {
            $brandboostID = $request->bbid;
            $content = $request->pcontent;
            $parsedContent = $this->mInviter->emailTagReplace($brandboostID, $content, 'email', $aUser);
            $response = array('status' => 'success', 'msg' => $parsedContent);
            echo json_encode($response);
            exit;
        }
    }

    public function replyFeedback(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $clientID = $request->cid;
            $subscriberID = $request->sid;
            $brandboostID = $request->bid;
            $subject = $request->subject;
            $replydata = $request->feedbackReply;
            $medium = $request->career;
            //pre(!empty($request));
            $aBrandboost = $this->mFeedback->getBrandboostInfo($brandboostID);
            if (!empty($aBrandboost)) {
                $type = $aBrandboost->review_type;
                if ($type == 'offsite') {
                    $aReviewLinks = unserialize($aBrandboost->offsites_links);
                    if (!empty($aReviewLinks)) {
                        $sLinks = explode(",", $aReviewLinks);
                    }
                } else if ($type == 'onsite') {
                    $sLinks = base_url() . "reviews/add/text/" . $brandboostID;
                } else {
                    $sLinks = '';
                }
            }

            $replydata = str_replace('{REVIEW_URL}', $sLinks, $replydata); //Replace Tags

            $subject = (empty($subject)) ? "Thanks for your feedback" : $subject;


            $aUserInfo = $this->mFeedback->getUserInfoBySubscriberID($subscriberID);
            if (!empty($aUserInfo)) {
                $userID = $aUserInfo->id;
                $email = $aUserInfo->semail;
                $phone = $aUserInfo->sphone;
            }

            if ($medium == 'email') {
                //Send Email

                $aSendgridData = $this->mInviter->getSendgridAccount($clientID);
                if (!empty($aSendgridData)) {
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
                        //Update credits
                        $aUsage = array(
                            'client_id' => $clientID,
                            'usage_type' => 'email',
                            'content' => $replydata,
                            'spend_to' => $email,
                            'spend_from' => '',
                            'module_name' => $type,
                            'module_unit_id' => $brandboostID
                        );
                        //$this->mInviter->updateUsage($aUsage);
                        updateCreditUsage($aUsage);
                        $response = array('status' => 'success', 'msg' => 'Email sent successfully');
                    }
                }
            } else if ($medium == 'sms') {
                $replydata = strip_tags($replydata);
                $aTwilioAc = $this->mInviter->getTwilioAccount($clientID);
                if (!empty($aTwilioAc)) {
                    $sid = $aTwilioAc->account_sid;
                    $token = $aTwilioAc->account_token;
                    $from = $aTwilioAc->contact_no;
                    $aSmsData = array(
                        'sid' => $sid,
                        'token' => $token,
                        'to' => $phone,
                        'from' => $from,
                        'msg' => $replydata
                    );
                    //Send Sms now
                    $result = sendClinetSMS($aSmsData);
                    if ($result) {
                        $response = array('status' => 'success', 'msg' => 'Sms sent successfully');
                    }
                }
            }
        }
        echo json_encode($response);
        exit;
    }


    /**
    * This function will return feedback notes details
    * @param type
    * @return type
    */

    public function getFeedbackNotes(Request $request) {
        $response = array();
        $response['status'] = 'error';
        $mFeedback  = new FeedbackModel();
        if (!empty($request)) {

            $noteData = $mFeedback->getFeedbackNoteInfo($request->noteid);
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
    * This function is used to update the notes
    * @param type
    * @return type
    */

    public function updateFeedbackNote(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $noteId = $request->edit_noteid;
            $sNotes = $request->edit_note_content;
            $aNotesData = array(
                'notes' => $sNotes,
                'client_id' => $userID,
                'updated' => date("Y-m-d H:i:s")
            );
            $mFeedback  = new FeedbackModel();
            $bSaved = $mFeedback->updateFeedbackNote($aNotesData, $noteId);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been updated succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to delete the feedback notes
    * @param $noteid
    * @return type
    */

    public function deleteFeedbackNote(Request $request) {
        $response = array();

        $noteid = $request->noteid;
        $mFeedback  = new FeedbackModel();
        $result = $mFeedback->deleteFeedbackNote($noteid);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    /**
     * This function used to add feedback comment
     * @param Request $request
     */
    public function addFeedbackcomment(Request $request) {

        $response = array();

        if (!empty($request)) {

            $feedbackID = $request ->fid;
            $parentCommentId = $request->parent_comment_id;
            $comment_content = $request->comment_content;
            //$userID = $this->session->userdata("current_user_id");
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $parentCommentId = $parentCommentId == '' ? '0' : $parentCommentId;

            if (!empty($feedbackID)) {
                $oFeedback = FeedbackModel::getFeedbackInfo($feedbackID);
            }

            $aData = array(
                'feedback_id' => $feedbackID,
                'user_id' => $userID,
                'content' => $comment_content,
                'parent_comment_id' => $parentCommentId,
                'created' => date("Y-m-d H:i:s")
            );

            if ($oFeedback->ownerID == $userID) {
                $aData['status'] = 1;
            }
            $mFeedback = new FeedbackModel();
            $result = $mFeedback->addFeedbackComment($aData);
            if ($result) {
                $subscriberEmail = $oFeedback->email;
                $subject = 'Hello, you got reply on your feedback';
                $content = 'Hello,<br><br> We want to inform you that you got reply on your feedback <br><br><i>' . $comment_content . '</i><br><br><strong>Your Feedback</strong><p>' . $oFeedback->feedback . '</p>';
                //Send out Email or SMS
                $this->sendFeedbackReply($subscriberEmail, $subject, $content, 'email');
                $response['status'] = 'success';
                $response['message'] = "Comment has been added successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
     * Used to delete feedback comment
     * @param Request $request
     */
    public function deleteFeedbackComment(Request $request) {
        $response = array();
        $commentId = $request->commentId;
        $mFeedback = new FeedbackModel();
        $result = $mFeedback->deleteFeedbackComment($commentId);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    function loadFeedbackComment(Request $request) {


        $feedbackID = $request->fid;
        $offset = $request->offset;
        $source = $request->source;
        if (!empty($feedbackID) && !empty($offset)) {

            $oCommentsData = $this->mFeedback->getFeedbackParentsComments($feedbackID, true, $offset);

            if (!empty($oCommentsData)) {

                foreach ($oCommentsData as $commentData) {
                    ?>
                    <li class="bbot">

                        <div class="media-left">
                            <?php echo showUserAvtar($commentData->avatar, $commentData->firstname, $commentData->lastname); ?>
                        </div>

                        <div class="media-left pr0 w100">

                            <p class="fsize14 txt_grey2 lh14 mb-15 "><?php echo $commentData->firstname . ' ' . $commentData->lastname; ?> <span class="dot">.</span> <?php echo timeAgo($commentData->created); ?> <span class="dot">.</span>

                                <?php if ($commentData->status == '1') { ?>
                                    <span class="txt_green"><i class="icon-checkmark3 fsize12 txt_green"></i> Approve</span>
                                <?php } ?>
                                <?php if ($commentData->status == 0) { ?>

                                    <span class="txt_red"><i class="icon-checkmark3 fsize12 txt_red"></i> Disapproved</span>

                                <?php } ?>
                                <?php if ($commentData->status == '2') { ?>
                                    <span class="media-annotation"> <span class="label bkg_grey txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="1" comment_id="<?php echo $commentData->id; ?>"> Approve</span> </span>
                                    <span class="media-annotation dotted"> <span class="label bkg_red txt_white br5 chg_status addtag" change_status="0" comment_id="<?php echo $commentData->id; ?>"> Disapprove</span> </span>
                                <?php } ?>
                            </p>

                            <p class="fsize13 mb10 lh23 txt_grey2">
                                <?php echo $commentData->content != '' ? $commentData->content : 'N/A'; ?></p>

                            <div class="button_sec text-right">
                                <a  href="javascript:void(0);" class="btn comment_btn txt_purple <?php if ($source == 'smartpopup'): ?>deleteSmartComment<?php else: ?>deleteComment<?php endif; ?>" commentid="<?php echo $commentData->id; ?>">Delete</a>
                            </div>

                        </div>
                    </li>

                    <?php
                }
            }
        }
        exit;
    }

    public function sendFeedbackReply($to, $subject, $message, $medium = 'email') {
        $aUser = getLoggedUser();
        $clientID = $aUser->id;

        if ($clientID > 0) {
            $aSendgridData = getSendgridAccount($clientID);
            if (!empty($aSendgridData)) {
                $userName = $aSendgridData->sg_username;
                $password = $aSendgridData->sg_password;

                if ($medium == 'email') {
                    $aEmailData = array(
                        'username' => $userName,
                        'password' => $password,
                        'email' => $to,
                        'message' => $message,
                        'subject' => $subject
                    );
                    $result = sendClientEmail($aEmailData);
                    if (empty($result['errors'])) {
                        //Update credits
                        $aUsage = array(
                            'client_id' => $clientID,
                            'usage_type' => 'email',
                            'content' => $message,
                            'spend_to' => $to,
                            'spend_from' => '',
                            'module_name' => 'offsite',
                            'module_unit_id' => ''
                        );
                        //$this->mInviter->updateUsage($aUsage);
                        updateCreditUsage($aUsage);
                    }
                } else if ($medium == 'sms') {
                    $aTwilioAc = getTwilioAccountCustom($clientID);
                    if (!empty($aTwilioAc)) {
                        $sid = $aTwilioAc->account_sid;
                        $token = $aTwilioAc->account_token;
                        $from = $aTwilioAc->contact_no;
                        $aSmsData = array(
                            'sid' => $sid,
                            'token' => $token,
                            'to' => $to,
                            'from' => $from,
                            'msg' => strip_tags($message)
                        );
                        //Send Sms now
                        $result = sendClinetSMS($aSmsData);
                        if ($result) {
                            //Update credits
                            $aUsage = array(
                                'client_id' => $clientID,
                                'usage_type' => 'sms',
                                'direction' => 'outbound',
                                'content' => strip_tags($message),
                                'spend_to' => $to,
                                'spend_from' => $from,
                                'module_name' => 'offsite',
                                'module_unit_id' => ''
                            );
                            //$this->mInviter->updateUsage($aUsage);
                            $charCount = strlen(strip_tags($message));
                            $totatMessageCount = ceil($charCount / 160);
                            if ($totatMessageCount > 1) {
                                for ($i = 0; $i < $totatMessageCount; $i++) {
                                    $aUsage['segment'] = $i + 1;
                                    updateCreditUsage($aUsage);
                                }
                            } else {
                                $aUsage['segment'] = 1;
                                updateCreditUsage($aUsage);
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

}
?>
