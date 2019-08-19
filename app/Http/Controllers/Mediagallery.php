<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use App\Models\Admin\MediaModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Filesystem\Filesystem;
use Session;

class Mediagallery extends Controller {

    public function index($keyCode) {

    	$mMedia  =  new MediaModel();
		$galleryData = $mMedia->getGalleryDataByKey($keyCode);
        $sliderData = view('mediagallery', array('galleryData' => $galleryData))->render();
		$imageSize = $galleryData->image_size;
		$borderThickness = $galleryData->border_thickness;
		$sliderLeftValue = '184';
		
		if($imageSize == 'small'){
			$sliderLeftValue = '160';
		}
		
		if($imageSize == 'large'){
			$sliderLeftValue = '200';
		}
		
		$sliderLeftValue = $sliderLeftValue + ($borderThickness*2);
		
		$aData = array((object) array(
			'method' => 'list',
			'slideNo' => $galleryData->gallery_type,
			'sliderLeftValue' => $sliderLeftValue,
			'sliderData' => utf8_encode($sliderData)
        ));

        echo json_encode($aData);
        exit;
    }
	
	// get review data for media gallery widget
	
	public function getReviewData(){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');
		
        $post = Input::post();
		
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
		
        //$aUser = getLoggedUser();
        //$userID = $aUser->id;
		$mReviews  = new ReviewsModel();
        $reviewId = $post['review_id'];
		$reviewData = $mReviews->getReviewDetailsByReviewID($reviewId);
		$ratingsVal = '';
		for ($i = 1; $i <= 5; $i++) {
			if ($i <= $reviewData[0]->ratings) {
				$ratingsVal .= '<img src="'.base_url().'assets/images/widget/yellow_icon.png"> ';
			} else {
				$ratingsVal .= '<img src="'.base_url().'assets/images/widget/grey_icon.png"> ';
			}
		}
		
		$reviewImageArray = unserialize($reviewData[0]->media_url);
		$reviewRatings = $reviewData[0]->ratings + $reviewRatings;
		$imageUrl = $reviewImageArray[0]['media_url'];
		//<p class="heading_pop2">'.$reviewData[0]->brand_desc.'</p>
		$oComments = $mReviews->getComments($reviewId);
		
		$reviewPopupData = '<div class="box_inner">
		<div class="bbw_modal_header">
			<h5 class="bbw_modal_title">'.$reviewData[0]->brand_title.'</h5>
		</div>
    	<div class="left_box"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/'.$imageUrl.'"></div><!--left_box--->
    	<div class="right_box">
    	<h1 class="heading_pop">'.$reviewData[0]->review_title.'</h1>
    		<div class="box_2">
	<div class="top_div">
		<div class="left"><i class="circle"></i><a class="icons" href="javascript:void(0);">'.showUserAvtar($reviewData[0]->avatar, $reviewData[0]->firstname, $reviewData[0]->lastname).'</a></div>
		<div class="right">
			<div class="client_n"><p>'.$reviewData[0]->firstname . ' ' . $reviewData[0]->lastname.'</p></div>
			<div class="client_review">
			'.$ratingsVal.'
			<span>'.dataFormat($reviewData[0]->created).'</span></div>
		</div>
	</div>
	
	<div class="bottom_div">
		<p>'.$reviewData[0]->comment_text.'</p>
	</div>
	<div class="footer_div2">
		<div class="comment_div"><p><img src="assets/images/widget/comment_icon.jpg">'.count($oComments).' Comments <span>'.number_format($reviewData[0]->ratings, 1).' Our of 5 Stars</span></p></div>
		<!-- <div class="liked_icon"><img src="assets/images/widget/like_icon.jpg"> <img src="assets/images/widget/dislike_icon.jpg"></div> -->
	</div>
</div>
    	</div>
    </div>';
		$response = array('status' => 'success', 'popupData' => $reviewPopupData);
		echo json_encode($response);
        exit;
	}

}
