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
	public function updateReviewStatus(Request $request) {
        $response = array();

		$reviewID = $request->review_id;
		$status = $request->status;

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
	public function updateReviewCategory(Request $request) {
        $response = array();

		$reviewID = $request->review_id;
		$dataCategory = $request->dataCategory;

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
	public function deleteReview(Request $request) {
        $response = array();
		$reviewID = $request->reviewid;
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
	public function saveReviewNotes(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;

		$reviewID = $request->reviewid;
		$brandboostID = $request->bid;
		$clientID = $request->cid;
		$sNotes = $request->notes;

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
	public function deleteReviewNote(Request $request) {
        $response = array();

		$noteid = $request->noteid;
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
	public function getReviewMedia(Request $request) {
		$brandboostID = $request->brandboostID;
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


    /**
     * Used to delete multipal review
     * @param type
     */
    public function deleteMultipalReview(Request $request) {
        $response = array();

        $multiReviewid = $request->multiReviewid;
        foreach ($multiReviewid as $reviewid) {

            $result = ReviewsModel::deleteReviewByID($reviewid);
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

    public function getReviewById(Request $request) {

        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $aUsers = ReviewsModel::getReviewByReviewID($request->reviewid);
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

            $reviewID = $request->edit_reviewid;
            $ratingValue = $request->ratingValue;
            $edit_content = $request->edit_content;
            $reviewTitle = $request->edit_review_title;

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

    public function update_video_review(Request $request) {


        $aUser = getLoggedUser();
        $userID = $aUser->id;

            $reviewID = $request->edit_video_reviewid;
            $ratingValue = $request->ratingValueVideo;
            $reviewTitle = $request->edit_review_title;

            $mReviews  = new ReviewsModel();
            $aData = array(
                    'ratings' => $ratingValue,
                    'review_title' => $reviewTitle
                );
            $result = $mReviews->updateReview($aData, $reviewID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Review has been updated successfully.";

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
                @logUserActivity($aActivityData);
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;

    }


    /**
    * This function is used to display the reivew popup
    * @param type $clientID
    * @return type
    */

    public function displayreview(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $reviewID = 80;//$request->rid;
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

	public function getReviewPopupData(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $reviewID = $request->rid;
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



    public function getReviewNoteById(Request $request) {

        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $noteData = $this->mReviews->getReviewNoteByID($request->noteid);
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

            $commentId = $request->commentId;
            $status = $request->status;
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


	public function saveReviewTitle(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $reviewID = $request->review_id;
            $reviewTitle = $request->review_title;
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
	public function update_note(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mReviews = new ReviewsModel();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (!empty($request)) {
            $noteId = $request->edit_noteid;
            $sNotes = $request->edit_note_content;
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


    public function previewLiveContentReview(Request $request) {
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

    public function getCommentsPopup(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        if (!empty($request)) {
            $reviewId = $request->review_id;
            $reviewCommentsData = $this->mReviews->getReviewAllComments($reviewId, 0, 5);
			$popupContent = $this->load->view("admin/comments/comments_popup", array('reviewCommentsData' => $reviewCommentsData, 'reviewId' => $reviewId, 'nunOfComment'=>count($reviewCommentsData)), true);
            $response = array('status' => 'success', 'popupData' => $popupContent);
            echo json_encode($response);
            exit;
        }
    }

	public function getCommentLikeStatus(Request $request){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
		if (!empty($request)) {
            $commentId = $request->commentId;
            $likeData = $this->mReviews->getCommentLSByCommentID($commentId, 1);
			$disLikeData = $this->mReviews->getCommentLSByCommentID($commentId, 0);
		}
		$response = array('status' => 'success', 'likeData' => count($likeData), 'disLikeData' => count($disLikeData));
		echo json_encode($response);
		exit;
	}


     public function addnew(Request $request) {
        $aData = $request;
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
