<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BrandboostModel;
use Session;
use App\Libraries\Custom\Mobile_Detect;

class Review extends Controller {

    /**
     * Review Index function
     *
     */
    public function Index() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mReviews = new ReviewsModel();
        $mUser = new UsersModel();
        $aSettings = array();
        $oReviews = $mReviews->getUserReviews($userID);

        if (!empty($oReviews)) {
            foreach ($oReviews as $oReview) {
                $aReview = (array) $oReview;
                $reviewID = $aReview['id'];
                $userID = $aReview['user_id'];
                $aReviewData[$reviewID] = $aReview;
                $userData = $mUser->getUserInfo($userID);

                // Get Helpful
                $aHelpful = ReviewsModel::countHelpful($reviewID);
                $aReviewData['total_helpful'] = $aHelpful['yes'];
                $aReviewData['total_helpful_no'] = $aHelpful['no'];
                $aReviewData['user_data'] = (array) $userData;

                //Get Comments Block
                $oComments = $mReviews->getComments($reviewID, $aSettings);

                $oReview->reviewCommentsData = $mReviews->getReviewAllParentsComments($reviewID, $start = 0);
                if(!empty($oReview->reviewCommentsData)) {
                    foreach ($oReview->reviewCommentsData as $commentData) {
                        $commentData->likeData = $mReviews->getCommentLSByCommentID($commentData->id, 1);
                        $commentData->disLikeData = $mReviews->getCommentLSByCommentID($commentData->id, 0);
                        $commentData->childComments = $mReviews->getReviewAllChildComments($aReview['id'], $commentData->id);

                        if (!empty($oReview->childComments)) {
                            foreach ($oReview->childComments as $childComment) {
                                $childComment->avtarImageChild = $childComment->avatar == 'avatar_image.png' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $childComment->avatar;

                                $childComment->likeChildData = $mReviews->getCommentLSByCommentID($childComment->id, 1);
                                $childComment->disLikeChildData = $mReviews->getCommentLSByCommentID($childComment->id, 0);
                            }
                        }
                    }
                }

                $aProductData = BrandboostModel::getProductDataById($oReview->product_id);
                $aCommentsData = array();
                if (!empty($oComments)) {
                    foreach ($oComments as $oComment) {
                        $aComment = (array) $oComment;
                        $aCommentsData[$aComment['id']] = $aComment;
                        unset($aComment);
                    }
                }
                $aReviewData['comment_block'] = $aCommentsData;
                $aReviewData['product_data'] = $aProductData;
                unset($aCommentsData);

                $oReview->aReviewData = $aReviewData;
            }
        }

        $aBreadcrumb = array(
            'Home' => '#/',
            'My Reviews' => '#/user/review'
        );

        $aData = array(
            'title' => 'My Reviews',
            'breadcrumb' => $aBreadcrumb,
            'myReview' => $oReviews
        );
        //return view('user.review', $aData);
        echo json_encode($aData);
        exit();
    }

    /**
     * Review Index function - Old function for the reference
     *
     */
    public function IndexOld() {

    	$aUser = getLoggedUser();
        $userID = $aUser->id;
        $mReviews = new ReviewsModel();
        $mUser = new UsersModel();
        $aSettings = array();
        $oReviews = $mReviews->getUserReviews($userID);
        if (!empty($oReviews)) {
            foreach ($oReviews as $oReview) {
                $aReview = (array) $oReview;
                $reviewID = $aReview['id'];
                $userID = $aReview['user_id'];
                $aReviewData[$reviewID] = $aReview;
                $userData = $mUser->getUserInfo($userID);

                // Get Helpful
                $aHelpful = ReviewsModel::countHelpful($reviewID);
                $aReviewData[$reviewID]['total_helpful'] = $aHelpful['yes'];
                $aReviewData[$reviewID]['total_helpful_no'] = $aHelpful['no'];
                $aReviewData[$reviewID]['user_data'] = (array) $userData;

                //Get Comments Block
                $oComments = $mReviews->getComments($reviewID, $aSettings);

                $aProductData = BrandboostModel::getProductDataById($oReview->product_id);
                $aCommentsData = array();
                if (!empty($oComments)) {
                    foreach ($oComments as $oComment) {
                        $aComment = (array) $oComment;
                        $aCommentsData[$aComment['id']] = $aComment;
                        unset($aComment);
                    }
                }
                $aReviewData[$reviewID]['comment_block'] = $aCommentsData;
                $aReviewData[$reviewID]['product_data'] = $aProductData;
                unset($aCommentsData);
            }
        }

        $aData = array(
        	'myReview' => $aReviewData
        );
    	return view('user.review', $aData);
    }

    public function Edit($reviewId) {

        $aReviewData = ReviewsModel::getReviewByReviewID($reviewId);
        if($aReviewData->count() == 0) {
            return redirect('user/review');
        }

        $starRating = array(1=>'Poor', 2=>'Fair', 3=>'Good', 4=>'Excellent', 5=>'WOW!!!');

        $aBreadcrumb = array(
            'Home' => '#/',
            'Edit Review' => '#/user/review/edit/'.$reviewId
        );

        $aData = array(
            'title' => 'Edit Review',
            'breadcrumb' => $aBreadcrumb,
            'myReview' => $aReviewData[0],
            'starRating' => $starRating
        );
        //return view('user.review_edit', $aData);

        return $aData;
    }

}
?>
