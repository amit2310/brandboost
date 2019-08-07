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

    public function edit($reviewId) {

        $aReviewData = $this->mReviews->getReviewByReviewID($reviewId);
        if(empty($aReviewData)) {
            redirect('user/review');
        }
        $aData = array(
            'myReview' => $aReviewData[0]
        );
        $this->template->load('user/user_template', 'user/review_edit', $aData);
    }

}
?>