<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\PaymentModel;
use App\Models\Admin\UsersModel;
use App\Models\ReviewsModel;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\BrandModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\QuestionModel;
use App\Models\Admin\ReviewlistsModel;
use Session;
error_reporting(0);

class Reviews extends Controller {
	
	public function displayReview($widgetHash) {
		$mBrandboost = new BrandboostModel();
		$mReviews = new ReviewsModel();
		$mUser = new UsersModel();
        if (!empty($widgetHash)) {
            $oCampaign = $mBrandboost->getWidgetInfo($widgetHash, $hash = true);
			
            $userID = $oCampaign->user_id;
            $widgetID = $oCampaign->id;
            if ($userID > 0) {
                $bActionSubsription = $mUser->isActiveSubscription($userID);
            } else {
                echo "No Active subscription";
                return;
            }

            if ($bActionSubsription == false) {
                echo "No Active subscription";
                return;
            }

            //Collect configurations
            $oftenBBWD = $oCampaign->often_bb_display;
            $iReviewsPerPage = $oCampaign->num_of_review;
            $minRating = $oCampaign->min_ratings_display;
            $widgetType = $oCampaign->widget_type;
            $aSettings = array(
                'review_limit' => $iReviewsPerPage,
                'min_ratings' => $minRating
            );

            $center_popup_widget = '';
            $bottom_fixed_widget = '';
            $vertical_popup_widget = '';
            $button_widget = '';
            $reviews_feed_widget = '';

            $campaignId = $oCampaign->brandboost_id;

            if (!empty($campaignId)) {
                $this->addWidgetTrackData($widgetID, $userID, '', $widgetType, $campaignId, 'view', 'review');
		
                $aReviews = $this->getCampaignReviews($campaignId, $aSettings);
				
                $aPorductReviews = $this->getProductsCampaignReviews($campaignId, 'product', $aSettings);
				
                $aServiceReviews = $this->getProductsCampaignReviews($campaignId, 'service', $aSettings);
                $aSiteReviews = $this->getProductsCampaignReviews($campaignId, 'site', $aSettings);
               
                $allPorductsReviews = $mReviews->getActiveCampaignReviewsByType($campaignId, 'product');
                $allServicesReviews = $mReviews->getActiveCampaignReviewsByType($campaignId, 'service');
                $allSiteReviews = $mReviews->getActiveCampaignReviewsByType($campaignId, 'site');
				
                $allReviews = $mReviews->getReviews($campaignId, $aSettings);
                $bbData = $mReviews->getBrandBoostCampaign($campaignId, $hash = false);
				
                $widgetData = $mReviews->getWidgetData($campaignId);
                if ((sizeof($widgetData) + 1) % $oftenBBWD == 0) {
                    $aWidgetData = array(
                        'campaign_id' => $campaignId,
                        'user_ip' => $_SERVER['REMOTE_ADDR'],
                        'often_user' => 1,
                        'widget_type' => $widgetType,
                        'created_date' => date("Y-m-d H:i:s")
                    );
                } else {
                    $aWidgetData = array(
                        'campaign_id' => $campaignId,
                        'user_ip' => $_SERVER['REMOTE_ADDR'],
                        'widget_type' => $widgetType,
                        'created_date' => date("Y-m-d H:i:s")
                    );
                }

                $mReviews->addWidgetData($aWidgetData);
                addPageAndVisitorInfo($userID, 'Widget', $campaignId, 'Visit');
				
                $crWidgetData = $mReviews->getWidgetCRU($campaignId);
				
                if ((sizeof($widgetData) + 1) % $oftenBBWD == 0) {
					$center_popup_widget = view('reviews.center_review_widget', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'allReviews' => $allReviews, 'allPorductsReviews' => $allPorductsReviews, 'allServicesReviews' => $allServicesReviews, 'allSiteReviews' => $allSiteReviews, 'aReviews' => $aReviews, 'iReviewsPerPage' => $iReviewsPerPage, 'aPorductReviews' => $aPorductReviews, 'aServiceReviews' => $aServiceReviews, 'aSiteReviews' => $aSiteReviews, 'displayType' => 'center_popup_widget', 'bbData' => $bbData, 'widgetCRU' => sizeof($crWidgetData)))->render();

					$bottom_fixed_widget = view('reviews.bottom_fix_review_widget', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'allReviews' => $allReviews, 'allPorductsReviews' => $allPorductsReviews, 'allServicesReviews' => $allServicesReviews, 'allSiteReviews' => $allSiteReviews, 'aReviews' => $aReviews, 'iReviewsPerPage' => $iReviewsPerPage, 'aPorductReviews' => $aPorductReviews, 'aServiceReviews' => $aServiceReviews, 'aSiteReviews' => $aSiteReviews, 'displayType' => 'bottom_fixed_widget', 'bbData' => $bbData, 'widgetCRU' => sizeof($crWidgetData)))->render();

					$vertical_popup_widget = view('reviews.vertical_review_widget', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'allReviews' => $allReviews, 'aReviews' => $aReviews, 'allPorductsReviews' => $allPorductsReviews, 'allServicesReviews' => $allServicesReviews, 'allSiteReviews' => $allSiteReviews, 'aReviews' => $aReviews, 'iReviewsPerPage' => $iReviewsPerPage, 'aPorductReviews' => $aPorductReviews, 'aServiceReviews' => $aServiceReviews, 'aSiteReviews' => $aSiteReviews, 'displayType' => 'vertical_popup_widget', 'bbData' => $bbData, 'widgetCRU' => sizeof($crWidgetData)))->render();

					$button_widget = view('reviews.button_review_widget', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'allReviews' => $allReviews, 'aReviews' => $aReviews, 'allPorductsReviews' => $allPorductsReviews, 'allServicesReviews' => $allServicesReviews, 'allSiteReviews' => $allSiteReviews, 'aReviews' => $aReviews, 'iReviewsPerPage' => $iReviewsPerPage, 'aPorductReviews' => $aPorductReviews, 'aServiceReviews' => $aServiceReviews, 'aSiteReviews' => $aSiteReviews, 'displayType' => 'button_widget', 'bbData' => $bbData, 'widgetCRU' => sizeof($crWidgetData)))->render();

					$reviews_feed_widget = view('reviews.feed_review_widget', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'allReviews' => $allReviews, 'aReviews' => $aReviews, 'allPorductsReviews' => $allPorductsReviews, 'allServicesReviews' => $allServicesReviews, 'allSiteReviews' => $allSiteReviews, 'aReviews' => $aReviews, 'iReviewsPerPage' => $iReviewsPerPage, 'aPorductReviews' => $aPorductReviews, 'aServiceReviews' => $aServiceReviews, 'aSiteReviews' => $aSiteReviews, 'displayType' => 'reviews_feed_widget', 'bbData' => $bbData, 'widgetCRU' => sizeof($crWidgetData)))->render();
                }
            }
        }
        $aData = array((object) array(
			'method' => 'list',
			'center_popup_widget_result' => utf8_encode($center_popup_widget),
			'bottom_fixed_widget_result' => utf8_encode($bottom_fixed_widget),
			'vertical_popup_widget_result' => utf8_encode($vertical_popup_widget),
			'button_widget_result' => utf8_encode($button_widget),
			'reviews_feed_widget_result' => utf8_encode($reviews_feed_widget),
        ));

        echo json_encode($aData);
        exit;
    }
	
	
	public function addWidgetTrackData($widgetID, $ownerID, $reviewID, $widgetType, $brandboostID, $trackType, $sectionType) {
		$mReviews = new ReviewsModel();
        //Get Tracking Data
        //Get Location based data
        $aLocationData = getLocationData();
        $widgetTrackData = $mReviews->getWidgetTrackData($widgetID, $aLocationData['ip_address'], $trackType, $reviewID);
        if (sizeof($widgetTrackData) < 1) {
            $aTrackData = array(
                'widget_id' => $widgetID,
                'owner_id' => $ownerID,
                'review_id' => $reviewID,
                'widget_type' => $widgetType,
                'brandboost_id' => $brandboostID,
                'track_type' => $trackType,
                'section_type' => $sectionType,
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
            $mReviews->addWidgetTrackData($aTrackData);
        }
    }

    public function getCampaignReviews($campaignID, $aSettings = array()) {
		$mBrandboost = new BrandboostModel();
		$mReviews = new ReviewsModel();
		$mUser = new UsersModel();
		
        $oReviews = $mReviews->getAllActiveReviews($campaignID, $aSettings);

        if (!empty($oReviews)) {
            foreach ($oReviews as $oReview) {
                $aReview = (array) $oReview;
                $reviewID = $aReview['id'];
                $userID = $aReview['user_id'];
                $aReviewData[$reviewID] = $aReview;
                $userData = $mUser->getUserInfo($userID);
                $oCampaign = $mReviews->getBrandBoostCampaign($oReview->campaign_id);

                // Get Helpful
                $aHelpful = $mReviews->countHelpful($reviewID);
                $aReviewData[$reviewID]['brandboost_name'] = $oCampaign->brand_title;
                $aReviewData[$reviewID]['total_helpful'] = $aHelpful['yes'];
                $aReviewData[$reviewID]['total_helpful_no'] = $aHelpful['no'];
                $aReviewData[$reviewID]['user_data'] = (array) $userData;

                //Get Comments Block
                $oComments = $mReviews->getAllMainComments($reviewID, 0, 1000);
                $aProductData = $mBrandboost->getProductDataById($oReview->product_id);

                $aCommentsData = array();
                if (!empty($oComments)) {
                    foreach ($oComments as $oComment) {
                        $oCommentLike = $mReviews->countCommentLike($oComment->id);
                        $aComment = (array) $oComment;
                        $aCommentsData[$aComment['id']] = $aComment;
                        $aCommentsData[$aComment['id']]['like'] = $oCommentLike['like'];
                        $aCommentsData[$aComment['id']]['dislike'] = $oCommentLike['dislike'];
                        unset($aComment);
                    }
                }
                $aReviewData[$reviewID]['comment_block'] = $aCommentsData;
                $aReviewData[$reviewID]['product_data'] = $aProductData;
                unset($aCommentsData);
            }
            return $aReviewData;
        }
    }
	
	
	public function getProductsCampaignReviews($campaignID, $productType, $aSettings = array()) {
		$mBrandboost = new BrandboostModel();
		$mReviews = new ReviewsModel();
		$mUser = new UsersModel();
		
        $aSettings['start'] = $offset;
        $aSettings['review_limit'] = $limit;

        $oReviews = $mReviews->getReviewsByProductType($campaignID, $aSettings, $productType);
        //pre($oReviews);
        if (!empty($oReviews)) {
            foreach ($oReviews as $oReview) {
                $aReview = (array) $oReview;
                $reviewID = $aReview['id'];
                $userID = $aReview['user_id'];
                $aReviewData[$reviewID] = $aReview;
                $userData = $mUser->getUserInfo($userID);
                // Get Helpful
                $aHelpful = $mReviews->countHelpful($reviewID);
                $aReviewData[$reviewID]['total_helpful'] = $aHelpful['yes'];
                $aReviewData[$reviewID]['total_helpful_no'] = $aHelpful['no'];
                $aReviewData[$reviewID]['user_data'] = (array) $userData;

                //Get Comments Block
                $oComments = $mReviews->getComments($reviewID, $aSettings);
                $aProductData = $mBrandboost->getProductDataById($oReview->product_id);
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
            return $aReviewData;
        }
    }
	
	
	public function addComment(Request $request) {
        $mBrandboost = new BrandboostModel();
		$mReviews = new ReviewsModel();
		$mUser = new UsersModel();
		$mSubscriber = new SubscriberModel();

		$reviewID = $request->bbrid;
		$pCommentID = $request->bbpcid;
		$fullName = $request->bbcmtname;
		$email = $request->bbcmtemail;
		$password = $request->bbcmtpassword;
		$phone = $request->bbcmtphone;
		$commentText = $request->bbcmt;
		
		$parentCID = $pCommentID == '' ? 0 : $pCommentID;

		$getReview = $mReviews->getReviewByReviewID($reviewID);

		$reviewCampaignId = $getReview[0]->campaign_id;


		$reviewUserID = $getReview[0]->user_id;
		$reviewType = $getReview[0]->review_type;
		$getBrandboostDetail = $mBrandboost->getBBInfo($reviewCampaignId);
		$brandBoostUserId = $getBrandboostDetail->user_id;
		
		$reviewUD = $mReviews->getBBWidgetUserData($reviewID);
		$this->addWidgetTrackData($reviewUD[0]->widget_id, $reviewUD[0]->user_id, $reviewID, $reviewUD[0]->widget_type, $reviewUD[0]->campaign_id, 'click', 'review');
		$this->addWidgetTrackData($reviewUD[0]->widget_id, $reviewUD[0]->user_id, $reviewID, $reviewUD[0]->widget_type, $reviewUD[0]->campaign_id, 'comment', 'review');

		if (empty($userID) && (empty($fullName) || empty($email))) {
			//Display errors, fields should not be blank
			$response = array('status' => 'error', 'msg' => 'form fields are not validated!');
			return json_encode($response);
		}

		if (empty($userID)) {
			$aName = explode(' ', $fullName, 2);
			$firstName = $aName[0];
			$lastName = $aName[1];
			$aRegistrationData = array(
				'firstname' => $firstName,
				'lastname' => $lastName,
				'email' => $email,
				'phone' => $phone
			);
			$aRegistrationData['clientID'] = $brandBoostUserId;
			$userID = $mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);
		}
		
		
		if (empty($userID)) {
			$response = array('status' => 'error', 'msg' => 'User registration has failed');
			return json_encode($response);
		}

		// Collect comment
		$aCommentData = array(
			'review_id' => $reviewID,
			'user_id' => $userID,
			'parent_comment_id' => $parentCID,
			'content' => $commentText,
			'status' => 2,
			'created' => date("Y-m-d H:i:s")
		);

		$bSaved = $mReviews->saveComment($aCommentData);
		addPageAndVisitorInfo($brandBoostUserId, 'Widget Review', serialize($reviewCampaignId), 'Add Comment');
		if ($bSaved) {
			// Send Notification
			$aNotificationDataCus = array(
				'user_id' => $brandBoostUserId,
				'event_type' => 'added_' . $reviewType . '_comment',
				'message' => ucfirst($reviewType) . ' Comment has been added successfully',
				'link' => base_url() . 'admin/brandboost/reviewdetails/' . $reviewID,
				'created' => date("Y-m-d H:i:s")
			);
			$eventName = "sys_onsite_review_add";
			add_notifications($aNotificationDataCus, $eventName, $brandBoostUserId, $notifyAdmin = '1');

			$response = array('status' => 'ok', 'msg' => 'Thank you for posting your comment. Your review was sent successfully and is now waiting to publish it.');
		} else {
			$response = array('status' => 'error', 'msg' => 'Error while posting your comment. Try again');
		}

		echo json_encode($response);
		exit;
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    public function lists($campaignId) {
        if (empty($campaignId)) {
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $oMyReviews = $this->mReviews->getMyReviews($userID);
            $this->template->load('template', 'admin/reviews/mylist', array('oMyReviews' => $oMyReviews));
        } else {
            $oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId);
            $aReviews = $this->getCampaignReviews($campaignId);
            $this->template->load('template', 'admin/reviews/list', array('oCampaign' => $oCampaign, 'aReviews' => $aReviews));
        }
    }


    /**
    * This function is used to get the review notes by the notes id
    * @param type 
    * @return type
    */

     public function getReviewNoteById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if (Input::post()) {
            $post = Input::post();
            $mReviews = new ReviewsModel();
            $noteData = $mReviews->getReviewNoteByID($post['noteid']);
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

    public function queslists($campaignId) {

        $oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId);
        $aReviews = $this->getCampaignReviews($campaignId);
        $this->template->load('template', 'admin/reviews/quesList', array('oCampaign' => $oCampaign, 'aReviews' => $aReviews));
    }

    

    public function getCommonCommentPopup($widgetHash) {
        $response = array();
        $post = $this->input->post();

        if (!empty($post)) {
            $bbrID = $post['bbrid'];
            $aData = '';
            if (!empty($widgetHash)) {
                $reviewData = $this->mReviews->getReviewByReviewID($bbrID);
                foreach ($reviewData as $oReview) {
                    $aReview = (array) $oReview;
                    $reviewID = $aReview['id'];
                    $userID = $aReview['user_id'];
                    $aReviewData[$reviewID] = $aReview;
                    $userData = $this->mUser->getUserInfo($userID);
                    $oCampaign = $this->mReviews->getBrandBoostCampaign($oReview->campaign_id);
                    // Get Helpful
                    $aHelpful = $this->mReviews->countHelpful($reviewID);
                    $aReviewData[$reviewID]['brandboost_name'] = $oCampaign->brand_title;
                    $aReviewData[$reviewID]['total_helpful'] = $aHelpful['yes'];
                    $aReviewData[$reviewID]['total_helpful_no'] = $aHelpful['no'];
                    $aReviewData[$reviewID]['user_data'] = (array) $userData;

                    //Get Comments Block
                    //$oComments = $this->getCommentsBlock($reviewID);
                    $oComments = $this->mReviews->getComments($reviewID);

                    $aCommentsData = array();
                    if (!empty($oComments)) {
                        foreach ($oComments as $oComment) {
                            $oCommentLike = $this->mReviews->countCommentLike($oComment->id);
                            $aComment = (array) $oComment;
                            $aCommentsData[$aComment['id']] = $aComment;
                            $aCommentsData[$aComment['id']]['like'] = $oCommentLike['like'];
                            $aCommentsData[$aComment['id']]['dislike'] = $oCommentLike['dislike'];
                            unset($aComment);
                        }
                    }
                    $aReviewData[$reviewID]['comment_block'] = $aCommentsData;
                }
                $oCampaign = $this->mBrandboost->getWidgetInfo($widgetHash, $hash = true);

                $commentsData = $this->load->view('reviews/review_comments_popup', array('reviewsData' => $aReviewData, 'oCampaign' => $oCampaign), true);

                $aData = array((object) array(
                        'method' => 'common_comments',
                        'commentsData' => utf8_encode($commentsData)
                ));
            }
        }
        //pre($aData);
        echo json_encode($aData);
        exit;
    }

    

    public function displaypreviewreivew($widgetHash) {
        if (!empty($widgetHash)) {
            //$oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId, $hash = true);
            $oCampaign = $this->mBrandboost->getWidgetInfo($widgetHash, $hash = true);

            //Collect configurations
            $iReviewsPerPage = $oCampaign->num_of_review;
            $minRating = $oCampaign->min_ratings_display;
            $aSettings = array(
                'review_limit' => $iReviewsPerPage,
                'min_ratings' => $minRating
            );

            /* if ($hash == true) {
              $campaignId = $oCampaign->id;
              } */

            $campaignId = $oCampaign->brandboost_id;
            if (!empty($campaignId)) {
                $aReviews = $this->getCampaignReviews($campaignId, $aSettings);
                $popup_content = $this->load->view('reviews/list_preview_popup', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'aReviews' => $aReviews, 'displayType' => 'popup'), true);
                $testimonial_content = $this->load->view('reviews/list_preview_popup', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'aReviews' => $aReviews, 'displayType' => 'testimonial'), true);
                $inline_content = $this->load->view('reviews/list_preview_popup', array('campaignID' => $campaignId, 'oCampaign' => $oCampaign, 'aReviews' => $aReviews, 'displayType' => 'inline'), true);
            }
        }

        $aData = array((object) array(
                'method' => 'list',
                'popup_result' => utf8_encode($popup_content),
                'testimonial_result' => utf8_encode($testimonial_content),
                'inline_result' => utf8_encode($inline_content),
        ));


        echo json_encode($aData);
        exit;
    }

    public function add($type = 'text', $campaignId, $subscriberID = 0, $inviterID = 0) {
        if (empty($campaignId))
            exit("Not a cup of your tea");
        $mReviews = new ReviewsModel();

        $oCampaign = $mReviews->getBrandBoostCampaign($campaignId);

        if ($type == 'text') {
            return view('reviews.review_text', array('oCampaign' => $oCampaign, 'subscriberID' => $subscriberID, 'inviterID' => $inviterID));
        } else if ($type == 'video') {
            return view('reviews.review_video', array('oCampaign' => $oCampaign, 'subscriberID' => $subscriberID, 'inviterID' => $inviterID));
        } else {
            exit("Unauthorized Access");
        }
    }


    /**
    * This function is used to add new reviews
    * @param type
    * @return type
    */

    public function addnew() {
        $aData = Input::get();
        if (!empty($aData)) {
            $action = $aData['action'];
            $rRating = $aData['r']; // Review Rating
            $campaignID = $aData['bbid']; //Campaign ID
            $subscriberID = $aData['subid']; //Subscriber ID
            $inviterID = $aData['invid']; // Inviter ID
            $mBrandboost  = new BrandboostModel();
            $mUser = new UsersModel();
            $rLists = new ReviewlistsModel();
            $aBrandboost = $mBrandboost->getBBInfo($campaignID);
            $aSubscriber = $mUser->getSubscriberInfo($subscriberID);
            $uSubscribers = $rLists->getSubscribersListUser($subscriberID);
            $getBrandboost = $mBrandboost->getBrandboost($campaignID);
            $productsData = $mBrandboost->getProductDataByType($campaignID, 'product');
            $servicesData = $mBrandboost->getProductDataByType($campaignID, 'service');
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

        return view('admin.reviews.collect_review', $aViewData);
    }

    public function submitOnsiteReview() {
        $response = array();
        $post = $this->input->post();

        $reviewUniqueID = $post['reviewUniqueID'];
        $campaignID = $post['campaign_id'];
        if ($reviewUniqueID != '') {
            $reviewDetails = $this->mReviews->getOnsiteReviewDetailsByUID($reviewUniqueID);
            $siteReviewDetails = $this->mReviews->getOnsiteSiteReviewDetailsByUID($reviewUniqueID);
            $aBrandboost = $this->mInviter->getBBInfo($campaignID);
            $clientID = $aBrandboost->user_id;
            //Send Thank you email
            $aReviewRes = array(
                'client_id' => $clientID,
                'brandboost_id' => $campaignID,
                'email' => $reviewDetails[0]->email,
                'siteReviewDetails' => $siteReviewDetails,
                'reviewDetails' => $reviewDetails
            );

            //pre($aReviewRes);

            $this->sendReviewThankyouEmail($aReviewRes);
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function sendReviewThankyouEmail($aData) {
        if (!empty($aData)) {
            $aResponse = $this->mFeedback->getFeedbackResponse($aData['brandboost_id']);
            //pre($aData);
            $ratingValue = $aData['siteReviewDetails'][0]->ratings;
            if (!empty($aResponse)) {
                $fromEmail = $aResponse->from_email;
                $fromName = $aResponse->from_name;

                if (!empty($ratingValue)) {
                    if ($ratingValue <= 2) {
                        $feedType = 'Negative';
                    } else if ($ratingValue == 3) {
                        $feedType = 'Neutral';
                    } else if ($ratingValue >= 4) {
                        $feedType = 'Positive';
                    }

                    if ($feedType == 'Positive') {
                        $sTitle = $aResponse->pos_title;
                        $sSubTitle = $aResponse->pos_sub_title;
                    } else if ($feedType == 'Negative') {
                        $sTitle = $aResponse->neg_title;
                        $sSubTitle = $aResponse->neg_sub_title;
                    } else if ($feedType == 'Neutral') {
                        $sTitle = $aResponse->neu_title;
                        $sSubTitle = $aResponse->neu_sub_title;
                    }
                }

                $emailContent = $this->load->view("review_thankyou", array('title' => $sTitle, 'subTitle' => $sSubTitle, 'siteReviewDetails' => $aData['siteReviewDetails'][0], 'reviewDetails' => $aData['reviewDetails']), true);
                $subject = "Thank you for submitting your review";

                //echo $emailContent;

                $aSendgridData = $this->mInviter->getSendgridAccount($aData['client_id']);
                $userName = $aSendgridData->sg_username;
                $password = $aSendgridData->sg_password;
                $sendgridFrom = $aSendgridData->sg_email;

                $fromEmail = (empty($fromEmail)) ? $sendgridFrom : $fromEmail;

                $aEmailData = array(
                    'username' => $userName,
                    'password' => $password,
                    'email' => $aData['email'],
                    'message' => $emailContent,
                    'subject' => $subject,
                    'from_email' => $fromEmail,
                    'from_name' => $fromName
                );

                //pre($aEmailData);

                $result = sendClientEmail($aEmailData);
                if (empty($result['errors'])) {
                    //Update credits
                    $aUsage = array(
                        'client_id' => $aData['client_id'],
                        'usage_type' => 'email',
                        'content' => $emailContent,
                        'spend_to' => $aData['email'],
                        'spend_from' => '',
                        'module_name' => 'onsite',
                        'module_unit_id' => $aData['brandboost_id']
                    );
                    //$bUpdated = $this->mInviter->updateUsage($aUsage);
                    $bUpdated = updateCreditUsage($aUsage);
                }
                return true;
            }
        }
        return true;
    }

    public function saveNewReview() {
        $response = array();
        $post = Input::post();
         $mInviter = new BrandboostModel();
         $mSubscriber = new SubscriberModel();
         $mReviews = new ReviewsModel();
        $bAllDone = false;

        if (!empty($post)) {
            //pre($post);
            $reviewTitle = $post['title'];
            $description = $post['description'];
            $campaignID = $post['campaign_id'];
            $reviewType = $type = $post['reviewType'];
            $ratingVal = $post['ratingValue'];
            $productId = $post['productId'];
            $reviewUniqueID = $post['reviewUniqueID'];
            $recommendedValue = $post['recomendationValue'];


            $email = $post['emailid'];
            $mobile = $post['phone'];
            $display_name = $post['display_name'];
            if (!empty($display_name)) {
                $showName = 0;
            } else {
                $showName = 1;
            }

            $aBrandboost = $mInviter->getBBInfo($campaignID);
             $clientID = $aBrandboost->user_id;

            //Collect Review

            if ($type == 'site') {
                $fullName = $post['fullname'];
                $aNameChunks = explode(" ", $fullName);
                $firstName = $aNameChunks[0];
                $lastName = str_replace($firstName, "", $fullName);

                $aRegistrationData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'phone' => $mobile
                );
                $aRegistrationData['clientID'] = $clientID;
                $userID = $mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);

                $siteReviewFile = $post['site_uploaded_name'];
                $siteReviewFileArray = array();

                foreach ($siteReviewFile['media_url'] as $key => $fileData) {
                    $siteReviewFileArray[$key]['media_url'] = $fileData;
                    $siteReviewFileArray[$key]['media_type'] = $siteReviewFile['media_type'][$key];
                }

                $aReviewData = array(
                    'user_id' => $userID,
                    'review_type' => $reviewType,
                    'campaign_id' => $campaignID,
                    'review_title' => $reviewTitle,
                    'comment_text' => $description,
                    'unique_review_key' => $reviewUniqueID,
                    'media_url' => serialize($siteReviewFileArray),
                    'ratings' => $ratingVal,
                    'created' => date("Y-m-d H:i:s")
                );
                //Save Site Reviews
                $bSaved = $mReviews->saveReview($aReviewData);
            } else if ($type == 'product' || $type == 'service') {

                if(!empty($productId)) {

                    foreach ($productId as $key => $productData) {
                        $fullName = $post['fullname'][$productData];
                        $aNameChunks = explode(" ", $fullName);
                        $firstName = $aNameChunks[0];
                        $lastName = str_replace($firstName, "", $fullName);

                        if ($post['newReviewPage'] == 'brandPage') {
                            $reviewType = $post['reviewTypeNew'][$productData];
                        }

                        $aRegistrationData = array(
                            'firstname' => $firstName,
                            'lastname' => $lastName,
                            'email' => $email[$productData],
                            'phone' => $mobile[$productData]
                        );
                        $aRegistrationData['clientID'] = $clientID;

                        $userID = $mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);

                        $productReviewFile = $post['uploaded_name_' . $productData];
                        $productReviewFileArray = array();

                        foreach ($productReviewFile['media_url'] as $key => $fileData) {
                            $productReviewFileArray[$key]['media_url'] = $fileData;
                            $productReviewFileArray[$key]['media_type'] = $productReviewFile['media_type'][$key];
                        }
                        $aReviewData = array(
                            'user_id' => $userID,
                            'review_type' => $reviewType,
                            'campaign_id' => $campaignID,
                            'product_id' => $productId[$productData],
                            'review_title' => $reviewTitle[$productData],
                            'comment_text' => $description[$productData],
                            'unique_review_key' => $reviewUniqueID,
                            'media_url' => serialize($productReviewFileArray),
                            'ratings' => $ratingVal[$productData],
                            'created' => date("Y-m-d H:i:s")
                        );
                        //Save Brandboost Reviews 
                        $reviewID = $mReviews->saveReview($aReviewData);
                    }
                }
                else {
                    $fullName = $post['fullname'];
                    $aNameChunks = explode(" ", $fullName);
                    $firstName = $aNameChunks[0];
                    $lastName = $aNameChunks[1];
                    
                    if ($post['newReviewPage'] == 'brandPage') {
                        $reviewType = $post['reviewType'];
                    }

                    $aRegistrationData = array(
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => $email,
                        'phone' => $mobile
                    );

                    $aRegistrationData['clientID'] = $clientID;
                    
                    $userID = $mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);

                    $productReviewFile = $post['uploaded_name'];
                    $productReviewFileArray = array();

                    foreach ($productReviewFile['media_url'] as $key => $fileData) {
                        $productReviewFileArray[$key]['media_url'] = $fileData;
                        $productReviewFileArray[$key]['media_type'] = $productReviewFile['media_type'][$key];
                    }
                    $aReviewData = array(
                        'user_id' => $userID,
                        'review_type' => $reviewType,
                        'campaign_id' => $campaignID,
                        'product_id' => $productId,
                        'review_title' => $reviewTitle,
                        'comment_text' => $description,
                        'unique_review_key' => $reviewUniqueID,
                        'media_url' => serialize($productReviewFileArray),
                        'ratings' => $ratingVal,
                        'created' => date("Y-m-d H:i:s")
                    );

                    //Save Brandboost Reviews 
                    $reviewID = $mReviews->saveReview($aReviewData);
                    
                }
                if ($reviewID > 0) {
                    $bSaved = true;
                }
                Session::put('review_id', $reviewID);

            } else if ($type == 'recomendation') {
                //Update Recommmendations into brandboost reviews
                $bSaved = $mReviews->updateReview(array('recvalue' => $recommendedValue), $reviewID);
            }

            if ($bSaved) {

                //Send notification only for brandboost reivews not for the site view

                if ($type == 'product') {
                    $aNotificationDataCus = array(
                        'user_id' => $clientID,
                        'event_type' => 'added_' . $reviewType . '_review',
                        'message' => 'A review has been added successfully',
                        'link' => base_url() . 'admin/brandboost/reviews/' . $campaignID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    add_notifications($aNotificationDataCus);

                    $aNotificationDataAd = array(
                        'user_id' => 1,
                        'event_type' => 'added_' . $reviewType . '_review',
                        'message' => 'A review has been added successfully',
                        'link' => base_url() . 'admin/brandboost/reviews/' . $campaignID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    add_notifications($aNotificationDataAd);

                    if (!empty($ratingVal)) {
                        if ($ratingVal <= 2) {
                            $feedType = 'Negative';
                        } else if ($ratingVal == 3) {
                            $feedType = 'Neutral';
                        } else if ($ratingVal >= 4) {
                            $feedType = 'Positive';
                        }
                    }

                    //Send Thank you email
                    $aFeedbackRes = array(
                        'feedback_type' => $feedType,
                        'client_id' => $clientID,
                        'subscriber_id' => $subscriberID,
                        'brandboost_id' => $campaignID,
                        'email' => $email
                    );

                    //$this->sendFeedbackThankyouEmail($aFeedbackRes);
                }

                //Update userid of the subscriber in subscriber list

                if ($subscriberID > 0) {
                    $mReviews->updateSubscriber(array('user_id' => $userID), $subscriberID);
                }
            }

            // Take them to the next step page in the flow
            $response = array('status' => 'success', 'redirect_url' => base_url('/store/explore/' . $aBrandboost->hashcode));
        } else {
            $response = array('status' => 'error', 'msg' => 'Unauthorized Access!');
        }

        echo json_encode($response);
        exit;
    }

    public function saveReviewByEmailTemplate() {

        $response = array();
        $post = $this->input->post();

        if (!empty($post)) {
            $fullName = strip_tags($post['fullname']);
            $aName = explode(' ', $fullName, 2);
            $firstName = $aName[0];
            $lastName = $aName[1];
            $email = strip_tags($post['email']);
            $mobile = strip_tags($post['mobile']);
            $reviewType = strip_tags($post['type']);
            $campaignID = strip_tags($post['campaign_id']);
            $ratingVal = strip_tags($post['ratingValue']);
            $image_name = strip_tags($post['image_name']);
            $reviewTitle = strip_tags($post['review_title']);


            $telExt = strip_tags($post['telExt']);
            $countryExt = strip_tags($post['countryExt']);

            if (!empty($campaignID)) {
                $aBrandboost = $this->mInviter->getBBInfo($campaignID);
                $clientID = $aBrandboost->user_id;
            }


            if (empty($fullName) || empty($email)) {
                //Display errors, fields should not be blank
                $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                return json_encode($response);
            }
            //echo "user id is ". $userID;

            $aRegistrationData = array(
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'phone' => $mobile
            );
            $aRegistrationData['clientID'] = $clientID;
            $userID = $this->mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);

            if (empty($userID)) {
                $response = array('status' => 'error', 'msg' => 'User registration has failed');
                return json_encode($response);
            }

            //Collect Review

            $aReviewData = array(
                'user_id' => $userID,
                'review_type' => $reviewType,
                'campaign_id' => $campaignID,
                'review_title' => $reviewTitle,
                'ratings' => $ratingVal
            );

            if ($reviewType == 'text') {
                //Collect Text Review
                $reviewContent = strip_tags($post['content']);
                $aReviewData['comment_text'] = $reviewContent;
                $aReviewData['comment_video'] = $image_name;
            }

            if ($reviewType == 'video') {

                $aReviewData['comment_video'] = $image_name;
            }
            $aReviewData['created'] = date("Y-m-d H:i:s");

            $bSaved = $this->mReviews->saveReview($aReviewData);


            // Send Notification
            $aNotificationData = array(
                'user_id' => $userID,
                'event_type' => 'added_' . $reviewType . '_review',
                'message' => ucfirst($reviewType) . ' Reviews has been added succesfully',
                'created' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('success_msg', "<strong>Review has been submitted successfully</strong>");
        }
        redirect(site_url("/reviews/thankyou"), 'refresh');
    }

    public function saveReviewByEmailTemplate_old() {

        $response = array();
        $post = $this->input->post();

        if (!empty($post)) {
            $fullName = strip_tags($post['fullname']);
            $email = strip_tags($post['email']);
            $mobile = strip_tags($post['mobile']);
            $reviewType = strip_tags($post['type']);
            $campaignID = strip_tags($post['campaign_id']);
            $ratingVal = strip_tags($post['ratingValue']);
            $image_name = strip_tags($post['image_name']);
            $reviewTitle = strip_tags($post['review_title']);


            $telExt = strip_tags($post['telExt']);
            $countryExt = strip_tags($post['countryExt']);

            if (empty($fullName) || empty($email)) {
                //Display errors, fields should not be blank
                $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                return json_encode($response);
            }
            //echo "user id is ". $userID;

            if ($userID == false) {
                //Register User
                $aName = explode(' ', $fullName, 2);
                $firstName = $aName[0];
                $lastName = $aName[1];

                //My Code
                $aRegistrationData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'mobile' => $mobile,
                );
                $userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
            }

            if (empty($userID)) {
                $response = array('status' => 'error', 'msg' => 'User registration has failed');
                return json_encode($response);
            }

            //Collect Review

            $aReviewData = array(
                'user_id' => $userID,
                'review_type' => $reviewType,
                'campaign_id' => $campaignID,
                'review_title' => $reviewTitle,
                'ratings' => $ratingVal
            );

            if ($reviewType == 'text') {
                //Collect Text Review
                $reviewContent = strip_tags($post['content']);
                $aReviewData['comment_text'] = $reviewContent;
                $aReviewData['comment_video'] = $image_name;
            }

            if ($reviewType == 'video') {

                $aReviewData['comment_video'] = $image_name;
            }
            $aReviewData['created'] = date("Y-m-d H:i:s");

            $bSaved = $this->mReviews->saveReview($aReviewData);


            // Send Notification
            $aNotificationData = array(
                'user_id' => $userID,
                'event_type' => 'added_' . $reviewType . '_review',
                'message' => ucfirst($reviewType) . ' Reviews has been added succesfully',
                'created' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('success_msg', "<strong>Review has been submitted successfully</strong>");
        }
        redirect(site_url("/reviews/thankyou"), 'refresh');
    }

    public function thankyou() {
        $this->template->load('template', 'reviews/thankyou');
    }

    public function saveReviewText() {

        $response = array();
        $post = $this->input->post();

        if (!empty($post)) {
            $subscriberID = strip_tags($post['subID']);
            $inviterID = strip_tags($post['inviterID']);
            $fullName = strip_tags($post['fullname']);
            $aName = explode(' ', $fullName, 2);
            $firstName = $aName[0];
            $lastName = $aName[1];
            $email = strip_tags($post['email']);
            $mobile = strip_tags($post['mobile']);
            $reviewType = strip_tags($post['type']);
            $campaignID = strip_tags($post['campaign_id']);
            $ratingVal = strip_tags($post['ratingValue']);
            $reviewTitle = strip_tags($post['review_title']);
            $image_name = strip_tags($post['image_name']);
            $proReview = strip_tags($post['pro']);
            $consReview = strip_tags($post['cons']);

            $telExt = strip_tags($post['telExt']);
            $countryExt = strip_tags($post['countryExt']);

            $getBrandboostDetail = getBrandboostDetail($campaignID);
            $brandboostUserId = $getBrandboostDetail->user_id;


            if (empty($fullName) || empty($email)) {
                //Display errors, fields should not be blank
                $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                return json_encode($response);
            }


            $aRegistrationData = array(
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'phone' => $mobile
            );
            $aRegistrationData['clientID'] = $brandBoostUserId;
            $userID = $this->mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);


            if (empty($userID)) {
                $response = array('status' => 'error', 'msg' => 'User registration has failed');
                return json_encode($response);
            }

            //Collect Review

            $aReviewData = array(
                'user_id' => $userID,
                'review_type' => $reviewType,
                'campaign_id' => $campaignID,
                'review_title' => $reviewTitle,
                'ratings' => $ratingVal,
                'pro_review' => $proReview,
                'inviter_id' => $inviterID,
                'cons_review' => $consReview
            );

            if ($reviewType == 'text') {
                //Collect Text Review
                $reviewContent = strip_tags($post['content']);
                $aReviewData['comment_text'] = $reviewContent;
                $aReviewData['comment_video'] = $image_name;
            }

            if ($reviewType == 'video') {

                $aReviewData['comment_video'] = $image_name;
            }
            $aReviewData['created'] = date("Y-m-d H:i:s");

            $bSaved = $this->mReviews->saveReview($aReviewData);
            if ($bSaved) {

                // Send Notification

                $aNotificationDataCus = array(
                    'user_id' => $brandboostUserId,
                    'event_type' => 'added_' . $reviewType . '_review',
                    'message' => ucfirst($reviewType) . ' review has been added successfully',
                    'link' => base_url() . 'admin/brandboost/reviews/' . $campaignID,
                    'created' => date("Y-m-d H:i:s")
                );
                $eventName = 'sys_onsite_review_add';
                add_notifications($aNotificationDataCus, $eventName, $brandboostUserId, $notifyAdmin = '1');

                //Update userid of the subscriber in subscriber list

                if ($subscriberID > 0) {
                    $this->mReviews->updateSubscriber(array('user_id' => $userID), $subscriberID);
                }

                if (!empty($ratingVal)) {
                    if ($ratingVal <= 2) {
                        $feedType = 'Negative';
                    } else if ($ratingVal == 3) {
                        $feedType = 'Neutral';
                    } else if ($ratingVal >= 4) {
                        $feedType = 'Positive';
                    }
                }

                //Send Thank you email
                $aFeedbackRes = array(
                    'feedback_type' => $feedType,
                    'client_id' => $brandboostUserId,
                    'subscriber_id' => $subscriberID,
                    'brandboost_id' => $campaignID,
                    'email' => $email
                );

                $this->sendFeedbackThankyouEmail($aFeedbackRes);
            }

            // Take them to the next step page in the flow
            $this->session->set_flashdata('success_msg', "<strong>Review has been submitted successfully</strong>");
            $response = array('status' => 'ok', 'redirect_url' => base_url('/admin/login'));
        } else {
            $response = array('status' => 'error', 'msg' => 'Unauthorized Access!');
        }

        echo json_encode($response);
        exit;
    }

    public function saveReview() {
        $this->load->library('S3');
        $response = array();
        $post = $this->input->post();

        if (!empty($post)) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $fullName = strip_tags($post['fullname']);
            $aName = explode(' ', $fullName, 2);
            $firstName = $aName[0];
            $lastName = $aName[1];
            $email = strip_tags($post['email']);
            $mobile = strip_tags($post['mobile']);
            $reviewType = strip_tags($post['type']);
            $campaignID = strip_tags($post['campaign_id']);
            $ratingVal = strip_tags($post['ratingValue']);
            $reviewTitle = strip_tags($post['review_title']);

            $telExt = strip_tags($post['telExt']);
            $countryExt = strip_tags($post['countryExt']);

            if (empty($fullName) || empty($email)) {
                //Display errors, fields should not be blank
                $response = array('status' => 'error', 'msg' => 'form fields are not validated!');
                return json_encode($response);
            }

            if ($campaignID) {

                $getBrandboostDetail = getBrandboostDetail($campaignID);
                $brandboostUserId = $getBrandboostDetail->user_id;

                $aRegistrationData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'phone' => $mobile
                );
                $aRegistrationData['clientID'] = $brandBoostUserId;
                $userID = $this->mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);

                if (empty($userID)) {
                    $response = array('status' => 'error', 'msg' => 'User registration has failed');
                    return json_encode($response);
                }
            }

            //Collect Review

            $aReviewData = array(
                'user_id' => $userID,
                'review_type' => $reviewType,
                'review_title' => $reviewTitle,
                'campaign_id' => $campaignID,
                'ratings' => $ratingVal
            );

            if ($reviewType == 'text') {
                //Collect Text Review
                $reviewContent = strip_tags($post['content']);
                $aReviewData['comment_text'] = $reviewContent;


                //Collect Text Review(Save Video into S3)
                $videoReview = isset($_FILES['video']) ? $_FILES['video'] : false;
                $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
                $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", "pdf", "PDF", "JPG", "JPEG", "PNG", "GIF", "DOC", "DOCX", "ODT");
                $error = "";
                if ($videoReview !== false) {
                    if (empty($error) && !in_array($ext, $allowed_types))
                        $error = "Invalid video file format";

                    if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                        $error = "Maximum filesize limit is 600MB only.";

                    if (empty($error)) {
                        // Put file to AWS S3
                        $videoReviewFile = $userID . "_review_" . sha1(time()) . "." . $ext;
                        $filekey = "campaigns/" . $videoReviewFile;
                        $filename = $videoReview['name'];
                        $input = file_get_contents($videoReview['tmp_name']);
                        $this->s3->putObject($input, AWS_BUCKET, $filekey);
                    }
                    $aReviewData['comment_video'] = $videoReviewFile;
                }
            }

            if ($reviewType == 'video') {
                //Collect Video Review(Save Video into S3)
                $videoReview = isset($_FILES['video']) ? $_FILES['video'] : false;
                $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
                $allowed_types = array("avi", "asf", "mov", "qt", "avchd", "flv", "swf", "mpg", "mp4", "wmv", "h.264", "divx");
                $error = "";
                if ($videoReview !== false) {
                    if (empty($error) && !in_array($ext, $allowed_types))
                        $error = "Invalid video file format";

                    if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                        $error = "Maximum filesize limit is 600MB only.";

                    if (empty($error)) {
                        // Put file to AWS S3
                        $videoReviewFile = $userID . "_review_" . sha1(time()) . "." . $ext;
                        $filekey = "campaigns/" . $videoReviewFile;
                        $filename = $videoReview['name'];
                        $input = file_get_contents($videoReview['tmp_name']);
                        $this->s3->putObject($input, AWS_BUCKET, $filekey);
                    }
                    $aReviewData['comment_video'] = $videoReviewFile;
                }
            }
            $aReviewData['created'] = date("Y-m-d H:i:s");

            $bSaved = $this->mReviews->saveReview($aReviewData);
            if ($bSaved) {
                //Autologin into user account
                //$this->session->set_userdata("user_user_id", $userID);
            }

            // Send Notification
            $aNotificationData = array(
                'user_id' => $userID,
                'event_type' => 'added_' . $reviewType . '_review',
                'message' => ucfirst($reviewType) . ' Reviews has been added succesfully',
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_onsite_review_add';
            add_notifications($aNotificationData, $eventName, $userID); //called from helper function
            // Take them to the next step page in the flow
            $this->session->set_flashdata('success_msg', "<strong>Review has been submitted successfully</strong>");
            $response = array('status' => 'ok', 'redirect_url' => base_url('/admin/login'));
        } else {
            $response = array('status' => 'error', 'msg' => 'Unauthorized Access!');
        }

        echo json_encode($response);
        exit;
    }

    

    

    public function saveCommentLike() {
        $response = array();
        $post = $this->input->post();
        if (!empty($post)) {
            $reviewID = strip_tags($post['bbrid']);
            $commentID = strip_tags($post['bbcid']);
            $action = strip_tags($post['av']);
            $ip = $this->input->ip_address();

            $aVoteData = array(
                'comment_id' => $commentID,
                'ip' => $ip,
                'status' => $action,
                'created' => date("Y-m-d H:i:s")
            );

            $alreadyVoted = $this->mReviews->checkIfCommentVoted($commentID, $ip);

            if ($alreadyVoted == false || $alreadyVoted['action'] == 'h_null') {
                $bSaved = $this->mReviews->saveCommentLike($aVoteData);
            } else {
                $bUpdated = $this->mReviews->updateCommentLike($aVoteData, $alreadyVoted['vote_id']);
            }

            $reviewUD = $this->mReviews->getBBWidgetUserData($reviewID);
            if ($reviewUD) {
                $this->addWidgetTrackData($reviewUD[0]->widget_id, $reviewUD[0]->user_id, $reviewID, $reviewUD[0]->widget_type, $reviewUD[0]->campaign_id, 'click', 'comment');
                $this->addWidgetTrackData($reviewUD[0]->widget_id, $reviewUD[0]->user_id, $reviewID, $reviewUD[0]->widget_type, $reviewUD[0]->campaign_id, 'helpful', 'comment');
            }

            $aCLike = $this->mReviews->countCommentLike($commentID);
            $response = array('status' => 'ok', 'like' => $aCLike['like'], 'dislike' => $aCLike['dislike']);
        }
        echo json_encode($response);
        exit;
    }

    public function saveHelpful() {
        $response = array();
        $post = $this->input->post();
        if (!empty($post)) {
            $reviewID = strip_tags($post['bbrid']);
            $action = strip_tags($post['ha']);
            $ip = $this->input->ip_address();

            $aVoteData = array(
                'review_id' => $reviewID,
                'ip' => $ip,
                'created' => date("Y-m-d H:i:s")
            );

            if ($action == 'Yes') {
                $aVoteData['helpful_yes'] = 1;
                $aVoteData['helpful_no'] = 0;
            }

            if ($action == 'No') {
                $aVoteData['helpful_yes'] = 0;
                $aVoteData['helpful_no'] = 1;
            }

            $alreadyVoted = $this->mReviews->checkIfVoted($reviewID, $ip);
            //pre($alreadyVoted);
            //$reviewData = $this->mReviews->getReviewByReviewID($reviewID);

            if ($alreadyVoted == false || $alreadyVoted['action'] == 'h_null') {
                $bSaved = $this->mReviews->saveHelpful($aVoteData);
            } else {
                //Already voted for the same review
                if ($alreadyVoted['action'] == 'helpful_yes') {
                    if ($action == 'Yes') {
                        $aVoteData['helpful_yes'] = `tbl_reviews_helpful` . `helpful_yes` - 1;
                    } else {
                        $aVoteData['helpful_yes'] = `tbl_reviews_helpful` . `helpful_yes` + 1;
                    }
                } else if ($alreadyVoted['action'] == 'helpful_no') {
                    if ($action == 'No') {
                        $aVoteData['helpful_no'] = `tbl_reviews_helpful` . `helpful_no` - 1;
                    } else {
                        $aVoteData['helpful_no'] = `tbl_reviews_helpful` . `helpful_no` + 1;
                    }
                } else if ($alreadyVoted['action'] == 'helpful_null') {
                    //Do nothing
                }
                $bUpdated = $this->mReviews->updateHelpful($aVoteData, $alreadyVoted['vote_id']);
            }

            $reviewUD = $this->mReviews->getBBWidgetUserData($reviewID);
            addPageAndVisitorInfo($reviewUD[0]->user_id, 'Widget Review', serialize($reviewUD[0]->campaign_id), 'Helpful Action');

            if ($reviewUD) {
                $this->addWidgetTrackData($reviewUD[0]->widget_id, $reviewUD[0]->user_id, $reviewID, $reviewUD[0]->widget_type, $reviewUD[0]->campaign_id, 'click', 'review');
                $this->addWidgetTrackData($reviewUD[0]->widget_id, $reviewUD[0]->user_id, $reviewID, $reviewUD[0]->widget_type, $reviewUD[0]->campaign_id, 'helpful', 'review');
            }

            $aHelpful = $this->mReviews->countHelpful($reviewID);
            $response = array('status' => 'ok', 'yes' => $aHelpful['yes'], 'no' => $aHelpful['no']);
        }
        echo json_encode($response);
        exit;
    }

    public function getCommentsBlock($reviewID) {
        $oComments = $this->mReviews->getComments($reviewID);
        if (!empty($oComments)) {
            foreach ($oComments as $oComment) {
                $aComment = (array) $oComment;
                $aCommentData[$aComments['id']] = $aComment;
            }

            foreach ($aCommentData as $k => &$v) {
                if ($v['parent_comment_id'] != 0) {
                    $aCommentData[$v['parent']]['childs'][] = & $v;
                }
            }
            unset($v);

            foreach ($aCommentData as $k => $v) {
                if ($v['parent_comment_id'] != 0) {
                    unset($aCommentData[$k]);
                }
            }
        }

        return $aCommentData;
    }

    public function deleteReview() {
        $response = array();
        $post = $this->input->post();
        $reviewid = strip_tags($post['reviewid']);
        $result = $this->mReviews->deleteReviewByID($reviewid);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    
    public function deleteReviewMultipal() {
        $response = array();
        $post = Input::post();
        //pre($post);
        $reviewids = $post['reviewid'];
        $mediaName = $post['mediaName'];
        $mReviews = new ReviewsModel();
        $inc = 0;
        foreach ($reviewids as $reviewid) {

            $getRes = $mReviews->getReviewByReviewID($reviewid);
            $mUrlArray = unserialize($getRes[0]->media_url);
            $newUrlArray = array();
            foreach ($mUrlArray as $mvalue) {

                if ($mvalue['media_url'] == $mediaName[$inc]) {
                    $mvalue['media_url'] = ' ';
                } else {
                    $newUrlArray[] = $mvalue;
                }
            }
            $newUrlUn = serialize($newUrlArray);
            $aData = array('media_url' => $newUrlUn);
            $result = $mReviews->updateReview($aData, $reviewid);
            $inc++;
        }

        /* if ($result) {
          $response['status'] = 'success';
          } else {
          $response['status'] = "Error";
          } */
        $response['status'] = 'success';

        echo json_encode($response);
        exit;
    }

    public function getReviewById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $aUsers = $this->mReviews->getReviewByReviewID($post['reviewid']);
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

    public function update_review() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $reviewID = strip_tags($post['edit_reviewid']);
            $ratingValue = strip_tags($post['ratingValue']);
            $edit_content = strip_tags($post['edit_content']);
            $reviewTitle = strip_tags($post['edit_review_title']);

            $aData = array(
                'comment_text' => $edit_content,
                'ratings' => $ratingValue,
                'review_title' => $reviewTitle
            );

            $result = $this->mReviews->updateReview($aData, $reviewID);
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

    

    public function sendFeedbackThankyouEmail($aData) {
        if (!empty($aData)) {
            $aFeedbackType = $aData['feedback_type'];
            $aResponse = $this->mFeedback->getFeedbackResponse($aData['brandboost_id']);

            if (!empty($aResponse)) {
                $fromEmail = $aResponse->from_email;
                $fromName = $aResponse->from_name;
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

                $emailContent = $this->load->view("review_thankyou", array('title' => $sTitle, 'subTitle' => $sSubTitle, 'rating_value' => $ratingValue, 'feedback' => $feedback), true);
                $subject = "Thank you for submitting your review";

                $aSendgridData = $this->mInviter->getSendgridAccount($aData['client_id']);
                $userName = $aSendgridData->sg_username;
                $password = $aSendgridData->sg_password;
                $sendgridFrom = $aSendgridData->sg_email;

                $fromEmail = (empty($fromEmail)) ? $sendgridFrom : $fromEmail;


                $aEmailData = array(
                    'username' => $userName,
                    'password' => $password,
                    'email' => $aData['email'],
                    'message' => $emailContent,
                    'subject' => $subject,
                    'from_email' => $fromEmail,
                    'from_name' => $fromName
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
                        'module_name' => 'onsite',
                        'module_unit_id' => $aData['brandboost_id']
                    );
                    //$bUpdated = $this->mInviter->updateUsage($aUsage);
                    $bUpdated = updateCreditUsage($aUsage);
                }
                return true;
            }
        }
        return true;
    }

    public function saveManualReview() {
        $response = array();
        $post = $this->input->post();
        $oUser = getLoggedUser();
        $currentUserID = $oUser->id;

        if (!empty($post)) {
            $userID = $post['user_id'];
            $reviewType = 'any';
            $type = $post['reviewType'];
            $campaignID = strip_tags($post['campaign_id']);
            $subscriberID = strip_tags($post['subID']);
            $inviterID = strip_tags($post['inviterID']);
            $ratingVal = strip_tags($post['ratingValue']);
            $reviewTitle = strip_tags($post['title']);
            $description = strip_tags($post['description']);
            $display_name = $post['display_name'];
            $email = $post['display_email'];
            $phone = $post['change_phone'];
            $mobile = '';

            //getLocationInfoByIp
            $getLocationInfoByIp = getLocationInfoByIp();
            $countryCode = $getLocationInfoByIp['countryCode'];
            $city = $getLocationInfoByIp['city'];
            $country = $getLocationInfoByIp['country'];

            $reviewStatus = 2;
            if (!empty($post['reviewStatus'])) {
                $reviewStatus = $post['reviewStatus'];
            }

            if (!empty($display_name)) {
                $showName = 0;
            } else {
                $showName = 1;
            }

            $productReviewFile = $post['uploaded_name'];
            $siteReviewFile = $post['site_uploaded_name'];
            
            $productReviewFileArray = array();

            foreach ($productReviewFile['media_url'] as $key => $fileData) {
                $productReviewFileArray[$key]['media_url'] = $fileData;
                $productReviewFileArray[$key]['media_type'] = $productReviewFile['media_type'][$key];
                $productReviewFileArray[$key]['media_name'] = $productReviewFile['media_name'][$key];
            }

            
            $siteReviewFileArray = array();

            foreach ($siteReviewFile['media_url'] as $key => $fileData) {
                $siteReviewFileArray[$key]['media_url'] = $fileData;
                $siteReviewFileArray[$key]['media_type'] = $siteReviewFile['media_type'][$key];
                $siteReviewFileArray[$key]['media_name'] = $siteReviewFile['media_name'][$key];
            }

            $proReview = strip_tags($post['pro']);
            $consReview = strip_tags($post['cons']);
            $recommendedValue = strip_tags($post['recomendationValue']);
            $reviewID = (strip_tags($post['review_id'])) ? strip_tags($post['review_id']) : $this->session->userdata('review_id');

            //$telExt = strip_tags($post['telExt']);
            //$countryExt = strip_tags($post['countryExt']);

            $aBrandboost = $this->mInviter->getBBInfo($campaignID);
            $brandboostUserId = $aBrandboost->user_id;
            $bRequireGlobalSubs = false;

            $aName = explode(' ', $display_name, 2);
            $firstName = $aName[0];
            $lastName = $aName[1];

            $moduleName = 'brandboost';
            $moduleAccountID = $campaignID;

            if (empty($userID)) {

                $aRegistrationData = array(
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                    'country_code' => $countryCode,
                    'cityName' => $city
                );
                $aRegistrationData['clientID'] = $currentUserID;
                $emailUserId = $this->mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);

                if (empty($emailUserId)) {
                    $response = array('status' => 'error', 'msg' => 'User registration has failed');
                    return json_encode($response);
                }

                $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($currentUserID, 'email', $email);
                if (!empty($oGlobalUser)) {
                    $iSubscriberID = $oGlobalUser->id;
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


                        if (!empty($tableName)) {
                            $result = $this->mSubscriber->addModuleSubscriber($aData, $moduleName, $tableName);
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

            //Collect Review

            $aReviewData = array(
                'user_id' => $emailUserId,
                'review_type' => $reviewType,
                'campaign_id' => $campaignID,
                'review_title' => $reviewTitle,
                'comment_text' => $description,
                'media_url' => serialize($productReviewFileArray),
                'ratings' => $ratingVal,
                'pro_review' => $proReview,
                'allow_show_name' => $showName,
                'inviter_id' => $inviterID,
                'cons_review' => $consReview,
                'status' => $reviewStatus,
                'created' => date("Y-m-d H:i:s")
            );

            $aSiteReviewData = array(
                'user_id' => $emailUserId,
                'review_type' => $reviewType,
                'campaign_id' => $campaignID,
                'review_title' => $reviewTitle,
                'comment_text' => $description,
                'media_url' => serialize($siteReviewFileArray),
                'ratings' => $ratingVal,
                'pro_review' => $proReview,
                'allow_show_name' => $showName,
                'inviter_id' => $inviterID,
                'cons_review' => $consReview,
                'status' => $reviewStatus,
                'created' => date("Y-m-d H:i:s")
            );
            if ($type == 'site') {
                //Save Site Reviews
                $bSaved = $this->mReviews->saveSiteReview($aSiteReviewData);
            } else if ($type == 'product') {
                //Save Brandboost Reviews
                $reviewID = $this->mReviews->saveReview($aReviewData);
                $bSaved = true;
                $this->session->set_userdata('review_id', $reviewID);
            } else if ($type == 'recomendation') {
                //Update Recommmendations into brandboost reviews
                $bSaved = $this->mReviews->updateReview(array('recvalue' => $recommendedValue), $reviewID);
            }

            if ($bSaved) {

                //Send notification only for brandboost reivews not for the site view
                if ($type == 'product') {
                    $aNotificationDataCus = array(
                        'user_id' => $brandboostUserId,
                        'event_type' => 'added_' . $reviewType . '_review',
                        'message' => 'A review has been added successfully',
                        'link' => base_url() . 'admin/brandboost/reviews/' . $campaignID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $eventName = 'sys_onsite_review_add';
                    add_notifications($aNotificationDataCus, $eventName, $brandboostUserId, $notifyAdmin = '1');

                    if (!empty($ratingVal)) {
                        if ($ratingVal <= 2) {
                            $feedType = 'Negative';
                        } else if ($ratingVal == 3) {
                            $feedType = 'Neutral';
                        } else if ($ratingVal >= 4) {
                            $feedType = 'Positive';
                        }
                    }

                    //Send Thank you email
                    $aFeedbackRes = array(
                        'feedback_type' => $feedType,
                        'client_id' => $brandboostUserId,
                        'subscriber_id' => $subscriberID,
                        'brandboost_id' => $campaignID,
                        'email' => $email
                    );

                    $this->sendFeedbackThankyouEmail($aFeedbackRes);
                }
            }

            // Take them to the next step page in the flow
            $response = array('status' => 'success', 'redirect_url' => 'http://pleasereviewmehere.com/campaign/' . strtolower(str_replace(" ", "-", $aBrandboost->brand_title)) . '-' . $aBrandboost->id, 'brandboostId' => $aBrandboost->id, 'type' => $type);
        } else {
            $response = array('status' => 'error', 'msg' => 'Unauthorized Access!');
        }

        echo json_encode($response);
        exit;
    }

}
