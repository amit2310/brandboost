<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\ReviewsModel;
use App\Models\SignupModel;
use App\Models\InfusionModel;
use App\Models\Admin\Crons\InviterModel;
use Illuminate\Support\Facades\Input;
use Session;

class Reviews extends Controller {
	
	/**
     * Used to update review status
     * @param type
     */
	public function updateReviewStatus() {
        $response = array();
		
		$reviewID = Input::post("review_id");
		$status = Input::post("status");

		$aData = array(
			'status' => $status
		);

		$result = ReviewsModel::updateReview($aData, $reviewID);
		if ($result) {

			$aUser = getLoggedUser();
			$userID = $aUser->id;

			$aActivityData = array(
				'user_id' => $userID,
				'event_type' => 'review_status',
				'action_name' => 'change_review_status',
				'brandboost_id' => '',
				'campaign_id' => '',
				'inviter_id' => '',
				'subscriber_id' => '',
				'feedback_id' => '',
				'activity_message' => 'Change review status',
				'activity_created' => date("Y-m-d H:i:s")
			);
			logUserActivity($aActivityData);

			$response['status'] = 'success';
			$response['message'] = "Status has been updated successfully.";
		} else {
			$response['message'] = "Error: Something went wrong, try again";
		}

		echo json_encode($response);
		exit;
    }
	
	/**
     * Used to update review category
     * @param type
     */
	public function updateReviewCategory() {
        $response = array();
		
		$reviewID = Input::post("review_id");
		$dataCategory = Input::post("dataCategory");

		$aData = array(
			'ratings' => $dataCategory
		);

		$result = ReviewsModel::updateReview($aData, $reviewID);
		if ($result) {

			$aUser = getLoggedUser();
			$userID = $aUser->id;

			$aActivityData = array(
				'user_id' => $userID,
				'event_type' => 'review_rating',
				'action_name' => 'change_review_rating',
				'brandboost_id' => '',
				'campaign_id' => '',
				'inviter_id' => '',
				'subscriber_id' => '',
				'feedback_id' => '',
				'activity_message' => 'Change review rating',
				'activity_created' => date("Y-m-d H:i:s")
			);
			logUserActivity($aActivityData);

			$response['status'] = 'success';
			$response['message'] = "Category has been updated successfully.";
		} else {
			$response['message'] = "Error: Something went wrong, try again";
		}

		echo json_encode($response);
		exit;
    }
	
	/**
     * Used to update review delete status
     * @param type
     */
	public function deleteReview() {
        $response = array();
		$reviewID = Input::post("reviewid");
        $result = ReviewsModel::deleteReviewByID($reviewID);
        if ($result) {
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'delete_review',
                'action_name' => 'delete_review',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Delete Onsite Review',
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
     * Used to add review note
     * @param type
     */
	public function saveReviewNotes() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;
		
		$reviewID = Input::post("reviewid");
		$brandboostID = Input::post("bid");
		$clientID = Input::post("cid");
		$sNotes = Input::post("notes");
		
		$aNotesData = array(
			'review_id' => $reviewID,
			'user_id' => $userID,//$clientID,
			'brandboost_id' => $brandboostID,
			'notes' => $sNotes,
			'created' => date("Y-m-d H:i:s")
		);
		$bSaved = ReviewsModel::saveReviewNotes($aNotesData);
		if ($bSaved) {
			$response = array('status' => 'success', 'message' => 'Note has been added succesfully.');
		}
		echo json_encode($response);
		exit;
    }
	
	/**
     * Used to delete review note
     * @param type
     */
	public function deleteReviewNote() {
        $response = array();
		
		$noteid = Input::post("noteid");
        $result = ReviewsModel::deleteReviewNoteByID($noteid);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }
	
	
    /**
     * Used to get review media images and videos
     * @param type
     */
	public function getReviewMedia() {
		$brandboostID = Input::post("brandboostID");
        $aReviews = ReviewsModel::getCampaignReviews($brandboostID);
		return view('admin.brandboost.listReviewMedia', array('aReviews'=>$aReviews))->render();
    }
	
	
	public function index($campaignId) {
        if (empty($campaignId)) {
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $oMyReviews = $this->mReviews->getMyReviews($userID);
            $this->template->load('admin/admin_template_new', 'admin/reviews/mylist', array('oMyReviews' => $oMyReviews));
        } else {
            $oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId);
            $aReviews = $this->getCampaignReviews($campaignId);
            $this->template->load('admin/admin_template_new', 'admin/reviews/list', array('oCampaign' => $oCampaign, 'aReviews' => $aReviews));
        }
    }
	
    public function deleteMultipalReview() {
        $response = array();
        $post = $this->input->post();
        $multiReviewid = $post['multiReviewid'];
        foreach ($multiReviewid as $reviewid) {

            $result = $this->mReviews->deleteReviewByID($reviewid);
        }
        if ($result) {

            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'delete_multipal_review',
                'action_name' => 'delete_multipal_review',
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Delete Onsite multipal Review',
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
    * This function is used to get the reviews on the behalf of id
    * @param type $clientID
    * @return type
    */

    public function getReviewById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if (Input::post()) {
            $post = Input::post();
            $aUsers = ReviewsModel::getReviewByReviewID($post['reviewid']);
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


    /**
    * This function is used to update review
    * @param type $clientID
    * @return type
    */
    public function updateReview(Request $request) {

        $response = array();
        if ($request->edit_reviewid) {
           
            $reviewID = strip_tags($request->edit_reviewid);
            $ratingValue = strip_tags($request->ratingValue);
            $edit_content = strip_tags($request->edit_content);
            $reviewTitle = strip_tags($request->edit_review_title);

            $siteReviewFile = $request->question_uploaded_name;
            $siteReviewFileArray = array();

            if(!empty($siteReviewFile)) {
                foreach ($siteReviewFile['media_url'] as $key => $fileData) {
                    $siteReviewFileArray[$key]['media_url'] = $fileData;
                    $siteReviewFileArray[$key]['media_type'] = $siteReviewFile['media_type'][$key];
                }
            }

            if(!empty($siteReviewFileArray)) {
                $aData = array(
                    'comment_text' => $edit_content,
                    'ratings' => $ratingValue,
                    'review_title' => $reviewTitle,
                    'media_url' => serialize($siteReviewFileArray),
                );
            } else {
                $aData = array(
                    'comment_text' => $edit_content,
                    'ratings' => $ratingValue,
                    'review_title' => $reviewTitle
                );
            }
            

            $result = ReviewsModel::updateReview($aData, $reviewID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Review has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function update_video_review() {

        $this->load->library('S3');
        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if ($this->input->post()) {

            $post = $this->input->post();

            $reviewID = strip_tags($post['edit_video_reviewid']);
            $ratingValue = strip_tags($post['ratingValueVideo']);
            $reviewTitle = strip_tags($post['edit_review_title']);

            // brand image
            $fileLogo = isset($_FILES['video']) ? $_FILES['video'] : false;
            $ext = pathinfo($fileLogo['name'], PATHINFO_EXTENSION);
            $allowed_types = array("avi", "asf", "mov", "qt", "avchd", "flv", "swf", "mpg", "mp4", "wmv", "h.264", "divx");

            $error = "";
            $brandImageFileName = '';
            if ($fileLogo !== false AND ! empty($_FILES['video']['name'])) {

                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid file type.";

                if (empty($error) && (!isset($fileLogo['size']) || $fileLogo['size'] > 6291456))
                    $error = "Maximum filesize limit is 6MB only.";

                if (empty($error)) {
                    try {
                        // Put file to AWS S3
                        $brandImageFileName = $userID . "_brand_" . sha1(time()) . "." . $ext;
                        $filekey = "campaigns/" . $brandImageFileName;
                        $filename = $fileLogo['name'];
                        $input = file_get_contents($fileLogo['tmp_name']);
                        $this->s3->putObject($input, AWS_BUCKET, $filekey);
                    } catch (Exception $e) {
                        $response['status'] = "error";
                        $response['msg'] = "Something went wrong. gdfg2";
                    }
                } else {
                    $response['status'] = "error";
                    $response['msg'] = $error;
                }
            } else {
                $response['status'] = "error";
                $response['msg'] = 'Please select brandboost logo.';
            }

            if (!empty($brandImageFileName)) {
                $aData = array(
                    'comment_video' => $brandImageFileName,
                    'ratings' => $ratingValue,
                    'review_title' => $reviewTitle
                );
            } else {
                $aData = array(
                    'ratings' => $ratingValue,
                    'review_title' => $reviewTitle
                );
            }

            $result = $this->mReviews->updateReview($aData, $reviewID);
            if ($result) {

                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'update_review',
                    'action_name' => 'update_review',
                    'brandboost_id' => '',
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Update Onsite Review',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);

                $response['status'] = 'success';
                $response['message'] = "Review has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }
    

    /**
    * This function is used to display the reivew popup
    * @param type $clientID
    * @return type
    */

    public function displayreview() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if (!empty($post)) {
            $reviewID = strip_tags($post['rid']);
            $campaginTitle = "";
            if ($reviewID > 0) {
                $oReviewData = ReviewsModel::getReviewInfo($reviewID);
                //pre($oReviewData);
                $oReviewNotes = ReviewsModel::listReviewNotes($reviewID);
                //pre($oReviewNotes);
                $popupContent = view("admin.reviews.review_popup", array('oReview' => $oReviewData, 'oNotes' => $oReviewNotes, 'campaignTitle' => $campaginTitle))->render();
                $response = array('status' => 'success', 'popup_data' => $popupContent);
            }
        }
        echo json_encode($response);
        exit;
    }
	

     /**
    * This function is used to get review data
    * @param type $clientID
    * @return type
    */

	public function getReviewPopupData() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if (!empty($post)) {
            $reviewID = strip_tags($post['rid']);
            if ($reviewID > 0) {
                $oReviewData = ReviewsModel::getReviewInfo($reviewID);
                $oReviewNotes = ReviewsModel::listReviewNotes($reviewID);
				$reviewCommentCount = getCampaignCommentCount($reviewID);
				$reviewTags = getTagsByReviewID($reviewID);
				
                $popupContent = view("admin.brandboost.review_details_popup", array('reviewData' => $oReviewData, 'reviewCommentCount' => $reviewCommentCount, 'reviewNotesData' => $oReviewNotes, 'reviewTags' => $reviewTags))->render();
                $response = array('status' => 'success', 'popupData' => $popupContent);
            }
        }
        echo json_encode($response);
        exit;
    }
	
	

    public function getReviewNoteById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $noteData = $this->mReviews->getReviewNoteByID($post['noteid']);
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
    * save comment like status
    * @return type json
    */
    public function saveCommentLikeStatus(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
		$aUser = getLoggedUser();
        $userID = $aUser->id;
        
            $commentId = strip_tags($request->commentId);
            $status = strip_tags($request->status);
            $aData = array(
                'comment_id' => $commentId,
                'user_id' => $userID,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'status' => $status,
                'created' => date("Y-m-d H:i:s")
            );
            $mReviews = new ReviewsModel();
            $dataLS = $mReviews->getCommentLSByUserIDAndCommentID($userID, $commentId);
			if($dataLS->count() > 0){
				$bSaved = $mReviews->updateCommentLS($aData, $userID, $commentId);
			}else{
				$bSaved = $mReviews->saveCommentLikeStatus($aData);
			}
			
            if ($bSaved) {
                $response = array('status' => 'success');
            }
            echo json_encode($response);
            exit;
        
    }

	
	public function saveReviewTitle() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (!empty($post)) {
            $reviewID = strip_tags($post['review_id']);
            $reviewTitle = $post['review_title'];
            $aData = array(
                'review_title' => $reviewTitle
            );

            $bSaved = $this->mReviews->updateReview($aData, $reviewID);
            if ($bSaved) {
                $response = array('status' => 'success');
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
	public function update_note() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;  
        $mReviews = new ReviewsModel();  
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if (!empty($post)) {
            $noteId = strip_tags($post['edit_noteid']);
            $sNotes = $post['edit_note_content'];
            $aNotesData = array(
                'notes' => $sNotes,
                'user_id' => $userID,
                'updated' => date("Y-m-d H:i:s")
            );

            $bSaved = $mReviews->updateReviewNote($aNotesData, $noteId);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been updated succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }
    
    
    public function previewLiveContentReview() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        $aUser = getLoggedUser();
        if (!empty($post)) {
            $brandboostID = strip_tags($post['bbid']);
            $content = $post['pcontent'];
            $parsedContent = $this->mInviter->emailTagReplace($brandboostID, $content, 'email', $aUser);
            $response = array('status' => 'success', 'msg' => $parsedContent);
            echo json_encode($response);
            exit;
        }
    }
	
    public function getCommentsPopup() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        $aUser = getLoggedUser();
        if (!empty($post)) {
            $reviewId = strip_tags($post['review_id']);
            $reviewCommentsData = $this->mReviews->getReviewAllComments($reviewId, 0, 5);
			$popupContent = $this->load->view("admin/comments/comments_popup", array('reviewCommentsData' => $reviewCommentsData, 'reviewId' => $reviewId, 'nunOfComment'=>count($reviewCommentsData)), true);
            $response = array('status' => 'success', 'popupData' => $popupContent);
            echo json_encode($response);
            exit;
        }
    }
	
	public function getCommentLikeStatus(){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        $aUser = getLoggedUser();
		if (!empty($post)) {
            $commentId = strip_tags($post['commentId']);
            $likeData = $this->mReviews->getCommentLSByCommentID($commentId, 1);
			$disLikeData = $this->mReviews->getCommentLSByCommentID($commentId, 0);
		}
		$response = array('status' => 'success', 'likeData' => count($likeData), 'disLikeData' => count($disLikeData));
		echo json_encode($response);
		exit;
	}


     public function addnew() {
        $aData = $this->input->get();
        if (!empty($aData)) {
            $action = $aData['action'];
            $rRating = $aData['r']; // Review Rating
            $campaignID = $aData['bbid']; //Campaign ID
            $subscriberID = $aData['subid']; //Subscriber ID
            $inviterID = $aData['invid']; // Inviter ID
            $aBrandboost = $this->mInviter->getBBInfo($campaignID);
            $aSubscriber = $this->mUser->getSubscriberInfo($subscriberID);
            $uSubscribers = $this->rLists->getSubscribersListUser($subscriberID);
            $getBrandboost = $this->mBrandboost->getBrandboost($campaignID);
            $productsData = $this->mBrandboost->getProductDataByType($campaignID, 'product');
            $servicesData = $this->mBrandboost->getProductDataByType($campaignID, 'service');
            $uniqueID = uniqid() . date('Ymdhis');
            $aViewData = array(
                'subscriberID' => $subscriberID,
                'inviterID' => $inviterID,
                'uniqueID' => $uniqueID,
                'brandboostID' => $campaignID,
                'subscriberData' => $aSubscriber,
                'brandboostData' => $aBrandboost,
                'productsData' => $productsData,
                'servicesData' => $servicesData,
                'uSubscribers' => $uSubscribers[0],
                'brandboostdetail' => $getBrandboost[0],
                'rRating' => $rRating,
                'action' => $action
            );
        }

        $this->load->view('reviews/collect_review', $aViewData);
    }

    

}
