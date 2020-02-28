<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\UsersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewsModel;
use App\Models\Admin\MediaModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Filesystem\Filesystem;
use Session;

class Mediagallery extends Controller {

	/**
     * Used to get media gallery data
     * @return type
     */
    public function index() {

        $mUser = new UsersModel();
        $aUser = getLoggedUser();
        $userId = $aUser->id;
        $userRole = $aUser->user_role;
        $bActiveSubsription = $mUser->isActiveSubscription();

		$allGallery = MediaModel::getAllGallerys($userId);

		foreach ($allGallery->items() as $galleryData) {
            if ($galleryData->team_id != '') {
                $galleryData->createdByData = getTeamMemberById($galleryData->team_id);
            } else {
                $galleryData->createdByData = getUserDetailsByUserID($galleryData->user_id);
            }
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Media Gallery" class="sidebar-control active hidden-xs ">Media Gallery</a></li>
			</ul>';

        $aBreadcrumb = array(
            'Home' => '#/',
            'Media Widgets' => '#/modules/mediagallery'
        );

        $aData = array(
            'title' => 'Media Widgets',
            'breadcrumb' => $aBreadcrumb,
            'pagename' => $breadcrumb,
            'allData' => $allGallery,
            'oWidgetsList' => $allGallery->items(),
            'bActiveSubsription' => $bActiveSubsription,
            'user_role' => $userRole
        );

		//return view('admin.media-gallery.index', array('title' => 'Media Gallery', 'pagename' => $breadcrumb, 'allGallery' => $allGallery, 'userId' => $userId));

        return $aData;
    }

	/**
     * Used to update galley status
     * @return type
     */
	public function updateStatus(Request $request) {

        $galleryId = $request->gallery_id;
        $status = $request->status;

        $aUser = getLoggedUser();
        $userID = $aUser->id;

		$aData = array(
            'status' => $status
        );

        $result = MediaModel::updateGallery($galleryId, $aData);

		if($result){
            $response = array('status' => 'success');

			$notificationData = array(
				'event_type' => 'update_gallery_status',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Update gallery status.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_status';

			@add_notifications($notificationData, $eventName, $userID);
		}

        echo json_encode($response);
        exit;
    }
/**
     * Used to update galley status
     * @return type
     */
	public function updateSingleField(Request $request) {

        $galleryId = $request->gallery_id;
        $fieldName = $request->fieldName;
        $fieldVal = $request->fieldVal;

		$aData = array(
            $fieldName => $fieldVal
        );

        $result = MediaModel::updateGallery($galleryId, $aData);

		if($result){
            $response = array('status' => 'success');
		}

        echo json_encode($response);
        exit;
    }

    /**
     * Used to get Media Widget Info
     * @return type
     */
    public function getMediaInfo(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $galleryId = $request->gallery_id;

        $galleryData = MediaModel::getGalleryData($galleryId);

        $response = array('status' => 'success', 'gallery_id' => $galleryId, 'title' => $galleryData->name, 'description' => $galleryData->description);

        return $response;
    }

	/**
     * Used to update galley data
     * @return type
     */
	public function updateGallery(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        $title = $request->title;
        $description = $request->description;

        $galleryId = $request->editGalleryId;
        $galleryName = (!empty($title) ? $title : $request->editGalleryName);
        $description = (!empty($description) ? $description : '');

		$aData = array(
            'name' => $galleryName,
            'description' => $description,
        );

        $result = MediaModel::updateGallery($galleryId, $aData);

		if($result){
            $response = array('gallery_id' => $galleryId, 'status' => 'success');

			$notificationData = array(
				'event_type' => 'update_gallery_data',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Update gallery data.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_update';

			add_notifications($notificationData, $eventName, $userID);
		}

        echo json_encode($response);
        exit;
    }
	/**
     * Used to update galley data
     * @return type
     */
	public function updateMediaWidget(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'name' => ['required'],
//            'description' => ['required']
        ]);

        $title = $request->name;
        $description = $request->description;

        $galleryId = $request->id;
        $galleryName = (!empty($title) ? $title : $request->editGalleryName);
        $description = (!empty($description) ? $description : '');

		$aData = array(
            'name' => $galleryName,
            'description' => $description,
        );

        $result = MediaModel::updateGallery($galleryId, $aData);

		if($result){
            $response = array('gallery_id' => $galleryId, 'status' => 'success');

			$notificationData = array(
				'event_type' => 'update_gallery_data',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Update gallery data.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_update';

			add_notifications($notificationData, $eventName, $userID);
		}

        echo json_encode($response);
        exit;
    }

	/**
     * Used to delete media galley data
     * @return type
     */
	public function deleteGallery(Request $request) {
		$aUser = getLoggedUser();
        $userID = $aUser->id;

        $galleryId = $request->gallery_id;

		$aData = array(
            'deleted' => 1
        );

        $result = MediaModel::updateGallery($galleryId, $aData);

		if($result){
			$notificationData = array(
				'event_type' => 'delete_gallery_status',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Delete gallery.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_delete';

			add_notifications($notificationData, $eventName, $userID);
		}

        if ($result == true) {
            $response = array('status' => 'success');
        }

        echo json_encode($response);
        exit;
    }


	/**
     * Used to add media galley widget
     * @return type
     */
	public function addList(Request $request){

		$response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        $title = $request->title;
        $description = $request->description;
        $dateTime = date("Y-m-d H:i:s");

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$hashcode = '';
		for ($i = 0; $i < 20; $i++) {
			$hashcode .= $characters[rand(0, strlen($characters))];
		}
		$hashcode = $hashcode . date('Ymdhis');

		$isLoggedInTeam = Session::get("team_user_id");

        $aData = array(
            'name' => $title,
            'description' => $description,
            'user_id' => $userID,
            'team_id' => $isLoggedInTeam,
			'hashcode' => md5($hashcode),
            'created' => $dateTime
        );

        $insertID = MediaModel::addGallery($aData);

        if ($insertID > 0) {
            $response = array('status' => 'success', 'gallery_id' => $insertID, 'msg' => "Gallery has been added successfully!");

            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_gallery',
                'action_name' => 'added_gallery',
                'list_id' => $insertID,
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Added a new gallery',
                'activity_created' => date("Y-m-d H:i:s")
            );

            @logUserActivity($aActivityData);

            $notificationData = array(
                'event_type' => 'added_new_gallery',
                'event_id' => 0,
                'link' => base_url() . 'admin/mediagallery/setup/' . $insertID,
                'message' => 'Created new gallery.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );

            $eventName = 'sys_gallery_added';

            @add_notifications($notificationData, $eventName, $userID);
        }

        echo json_encode($response);
        exit;
	}

	/**
     * Used to setup media galley widget
     * @return type
     */
	public function setup($galleryId){
		$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Media Gallery" class="sidebar-control active hidden-xs ">Media Gallery</a></li>
			</ul>';
        $aBreadcrumb = array(
            'Home' => '#/',
            'Media Widgets' => '#/modules/mediagallery',
            'Setup' => ''
        );
        $aUser = getLoggedUser();
        $userId = $aUser->id;
		$galleryData = MediaModel::getGalleryData($galleryId);
		$reviewsData = ReviewsModel::getAllReviewsByUserId($userId);

        //$sliderData = $this->load->view('/admin/media-gallery/preview', array('galleryData' => $galleryData), true);
        $sliderData = view('admin.media-gallery.preview', array('galleryData' => $galleryData))->render();

        $response= array(
            'status' => 'success',
            'title' => 'Media Gallery',
            'breadcrumb' => $aBreadcrumb,
            'galleryData' => $galleryData,
            'reviewsData' => $reviewsData,
            "setupPreview"=> utf8_encode($sliderData),
            "sliderView"=> utf8_encode($sliderData)
        );
        echo json_encode($response);
        exit;
//		return view('admin.media-gallery.setup', array('title' => 'Media Gallery', 'pagename' => $breadcrumb, 'galleryData' => $galleryData, 'reviewsData' => $reviewsData));
	}

	/**
     * Used to save reviews list
     * @return type
     */
	public function saveReviewsList(Request $request){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $reviewsId = serialize($request->reviewsId);
        $galleryId = $request->galleryId;

		$aData = array(
            'reviews_id' => $reviewsId
        );

        $result = MediaModel::updateGallery($galleryId, $aData);

		$galleryData = MediaModel::getGalleryData($galleryId);
		$reviewsIdArray = unserialize($galleryData->reviews_id);
		$reviewsData = ReviewsModel::getAllReviewsByUserId($userID);
		$reviewList = '';
		foreach ($reviewsData as $review) {
			$checked = false;
			if (in_array($review->id, $reviewsIdArray))
			{
				if($review->review_title != ''){
					$reviewList .= '<button class="btn btn-xs btn_white_table pr10">'.$review->review_title.'</button>';
				}
			}
		}

		$reviewCount = '<div class="media-left pl30 blef">
							<div class=""><a href="javascript:void(0);" class="text-default text-semibold bbot">'.count($reviewsIdArray).' Media</a> </div>
						</div>
						<div class="media-left pr30 brig">
							<div class="tdropdown">
								<button class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown" aria-expanded="false"><i class="icon-plus3"></i></button>
								<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
									'.$reviewList.'
									<button class="btn btn-xs plus_icon addMedia" data-id="'.$galleryId.'"><i class="icon-plus3"></i></button>
								</ul>
							</div>
						</div>';

		if($result){
			$notificationData = array(
				'event_type' => 'update_gallery_data',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Update gallery data.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_update';

			add_notifications($notificationData, $eventName, $userID);
		}

		//$sliderData = $this->load->view('/admin/media-gallery/preview', array('galleryData' => $galleryData), true);
		$sliderData = view('admin.media-gallery.preview', array('galleryData' => $galleryData))->render();

        if ($result == true) {
            $response = array('status' => 'success');
			$response['reviewCount'] = $reviewCount;
			$response['sliderView'] = utf8_encode($sliderData);
        }

        echo json_encode($response);
        exit;
	}

	/**
     * Used to update widget type
     * @return type
     */
	public function updateWidgetType(Request $request){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $galleryId = $request->gallery_id;
        $galleryType = $request->gallery_type;

		$aData = array(
            'gallery_design_type' => $galleryType
        );

        $result = MediaModel::updateGallery($galleryId, $aData);

		$galleryData = MediaModel::getGalleryData($galleryId);


		if($result){
			$notificationData = array(
				'event_type' => 'update_gallery_data',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Update gallery data.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_update';

			add_notifications($notificationData, $eventName, $userID);
		}

		$sliderData = view('admin.media-gallery.preview', array('galleryData' => $galleryData))->render();

        if ($result == true) {
            $response = array('status' => 'success');
			$response['sliderView'] = utf8_encode($sliderData);
        }

        echo json_encode($response);
        exit;
	}


	/**
     * Used to get widget review data
     * @return type
     */
	public function getReviewData(Request $request){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;
		$reviewRatings = 0;
        $reviewId = $request->review_id;
		$reviewData = ReviewsModel::getReviewDetailsByReviewID($reviewId);
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

		$reviewPopupData = '<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">'.$reviewData[0]->brand_title.'</h5>
				</div>
				<div class="modal-body">

				<div class="box_inner">
			<div class="left_box showCropImagePopup" data-img-name="'.$imageUrl.'" data-review-id="'.$reviewId.'" data-img="data:image/jpg;base64,'.base64_encode(file_get_contents('https://s3-us-west-2.amazonaws.com/brandboost.io/'.$imageUrl.'')).'" title="Click To Crop Image" style="cursor:pointer;"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/'.$imageUrl.'" ></div><!--left_box--->
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
						<div class="comment_div"><p><img src="'.base_url().'assets/images/widget/comment_icon.jpg">3 Comments <span>'.number_format($reviewData[0]->ratings, 1).' Our of 5 Stars</span></p></div>
						<!-- <div class="liked_icon"><img src="'.base_url().'assets/images/widget/like_icon.jpg"> <img src="'.base_url().'assets/images/widget/dislike_icon.jpg"></div> -->
					</div>
				</div>
			</div>
		</div></div>';
		$response = array('status' => 'success', 'popupData' => $reviewPopupData);
		echo json_encode($response);
        exit;
	}

	public function updateMediaData(Request $request) {



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $galleryId = $request->editGalleryId;
        $galleryType = $request->galleryType;
        $imageSize = $request->imageSize;
        $allowTitle = $request->allowTitle;
        $allowArrows = $request->allowArrows;
        $allowRating = $request->allowRating;
        $galleryName = $request->galleryName;
        $galleryDescription = $request->galleryDescription;

        $aUser = getLoggedUser();
        $userID = $aUser->id;

		$aData = array(
            'allow_title' => $allowTitle,
            'allow_arrow' => $allowArrows,
            'allow_ratings' => $allowRating,
            'gallery_type' => $galleryType,
            'image_size' => $imageSize,
            'name' => $galleryName,
            'description' => $galleryDescription,
        );

        $result = $this->mMedia->updateGallery($galleryId, $aData);

		if($result){
			$notificationData = array(
				'event_type' => 'update_gallery_data',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Update gallery data.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_update';

			add_notifications($notificationData, $eventName, $userID);
		}

		$galleryData = $this->mMedia->getGalleryData($galleryId);
		$sliderData = $this->load->view('/admin/media-gallery/preview', array('galleryData' => $galleryData), true);

		 if ($result == true) {
            $response = array(
				'status' => 'success',
				'sliderView' => utf8_encode($sliderData)
			);
        }

        echo json_encode($response);
        exit;
    }

	public function getGalleryImages(Request $request) {

        $mMedia = new MediaModel();

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $galleryId = $request->gallery_id;

        $aUser = getLoggedUser();
        $userID = $aUser->id;

		$galleryData = $mMedia->getGalleryData($galleryId);
		//$sliderData = $this->load->view('/admin/media-gallery/preview', array('galleryData' => $galleryData), true);

        $reviewIDArray = unserialize($galleryData->reviews_id);
        if(count($reviewIDArray) > 0 && $reviewIDArray[0] > 0) {
            foreach ($reviewIDArray as $reviewId) {
                $reviewData = ReviewsModel::getReviewDetailsByReviewID($reviewId);

                $reviewImageArray = unserialize($reviewData[0]->media_url);
                if(count($reviewImageArray)>0)
                {
                    $imageUrl = $reviewImageArray[0]['media_url'];
                    $cropedImageUrl = $reviewData[0]->croped_image_url;
                }
                else
                {
                    $imageUrl = "";
                    $cropedImageUrl = "";
                }

                if($cropedImageUrl == ''){
                    $imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
                }else{
                    $imagePath = "data:image/jpg;base64,".$cropedImageUrl;
                }
            }
        }
		$response = array(
			'status' => 'success',
			/*'sliderView' => utf8_encode($sliderData)*/
			'sliderView' => $galleryData
		);

        echo json_encode($response);
        exit;
    }

	public function updateMediaDesignData(Request $request) {



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $galleryId = $request->editGalleryId;
        $logoImg = $request->logo_img;
        $mainColorSwitch = $request->main_color_switch;
        $widgetColorAllow = $request->widget_color_allow == 'on' ? '1' : '';
        $mainColors = $request->main_colors;
        $customColors1 = $request->custom_colors1;
        $customColors2 = $request->custom_colors2;
        $colorOrientation = $request->color_orientation;
        $borderThickness = $request->borderThickness;
        $solidColor = $request->solid_color;
        $borderShadow = $request->allow_border_shadow == 'on' ? '1' : '';

        $aUser = getLoggedUser();
        $userID = $aUser->id;

		$aData = array(
            'gallery_logo' => $logoImg,
            'bg_color_type' => $mainColorSwitch,
            'allow_widget_bgcolor' => $widgetColorAllow,
            'gradient_color' => $mainColors,
            'gradient_start_color' => $customColors1,
            'gradient_end_color' => $customColors2,
            'gradient_orientation' => $colorOrientation,
            'allow_border_shadow' => $borderShadow,
            'border_thickness' => $borderThickness,
            'solid_color' => $solidColor
        );

        $result = $this->mMedia->updateGallery($galleryId, $aData);

		if($result){
			$notificationData = array(
				'event_type' => 'update_gallery_data',
				'event_id' => 0,
				'link' => base_url() . 'admin/mediagallery/setup/' . $galleryId,
				'message' => 'Update gallery data.',
				'user_id' => $userID,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);

			$eventName = 'sys_gallery_update';

			add_notifications($notificationData, $eventName, $userID);
		}

        $galleryData = $this->mMedia->getGalleryData($galleryId);
		$sliderData = $this->load->view('/admin/media-gallery/preview', array('galleryData' => $galleryData), true);

		if ($result == true) {
            $response = array(
				'status' => 'success',
				'sliderView' => utf8_encode($sliderData)
			);
        }

        echo json_encode($response);
        exit;
    }

	public function getReviewsList(Request $request){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $galleryId = $request->gallery_id;

		$galleryData = $this->mMedia->getGalleryData($galleryId);
		$reviewsData = $this->mReviews->getAllReviewsByUserId($userID);
		//pre($reviewsData);

		$data = array(
			'reviewsData' => $reviewsData,
			'galleryData' => $galleryData,
			'galleryId' => $galleryId
		);

		$popupContent = $this->load->view('/admin/media-gallery/reviewsList', $data, true);
		$response['status'] = 'success';
		$response['content'] = $popupContent;
		echo json_encode($response);
		exit;
	}

	public function updateMediaImage(Request $request){
		$response = array('status' => 'error', 'msg' => 'Something went wrong');



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $imageName = $request->imageName;
        $mainImageName = $request->mainImageName;
        $reviewId = $request->reviewId;

		$imageName = str_replace('data:image/jpg;base64,', '', $imageName);
		$imageName = str_replace('data:image/jpeg;base64,', '', $imageName);
		$imageName = str_replace('data:image/png;base64,', '', $imageName);
		$imageName = str_replace('data:image/gif;base64,', '', $imageName);

		// Create Image File
		//$cropedImageName = fopen($mainImageName, "w+");

		//Write the new Data
		//fwrite($cropedImageName, base64_decode($imageName));

		// Close the file
		//fclose($cropedImageName);



		$aData = array(
            'croped_image_url' => $imageName
        );

        $result = $this->mMedia->updateGalleryReview($reviewId, $aData);


        if ($result == true) {
            $response = array('status' => 'success');
        }

        echo json_encode($response);
        exit;
	}

}

?>
