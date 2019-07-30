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

use Session;
error_reporting(0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
class Company extends Controller {


      /**
	* Controller index function
	* @return type
	*/

		public function index($bussName, $campaign='') {
			
			$mReviews = new ReviewsModel();
			$mBrand = new  BrandModel();
			$mBrandboost = new BrandboostModel();
			$mUser = new UsersModel();
				$questionAndAnsData= array();
				$userDetail= array();
				$aReviews= array();


			if (!empty($campaign)) {
				
				$productName = Request::segment(3);
				$campaignId = explode('-', $productName);
				$campaignId = end($campaignId);
			

				if (!empty($campaignId)) {
					$offset = 0;
				     $limit = 100;
                 	$oCampaign = $mReviews->getBrandBoostCampaign($campaignId, $hash = false);
					$brandData = $mBrand->getBrandConfigurationData($oCampaign->user_id);
					$siteReview = $mBrandboost->campaignSiteReview($campaignId, $limit, $offset);
					$productsData = $mBrandboost->getProductData($campaignId);
					
					$faQData = $mBrand->getFaqDataByUserId($oCampaign->user_id);
					
					//Collect configurations
					$iReviewsPerPage = $oCampaign->num_of_review;
					$minRating = $oCampaign->min_ratings_display;
					
					
					$userDetail = $mUser->getUserByCompanyName($bussName); 
					$userID = $userDetail->id; 
					
					$aReviews = $this->getProductsCampaignReviews($campaignId, $limit, $offset, 'product');
					$servicesReviews = $this->getProductsCampaignReviews($campaignId, $limit, $offset, 'service');
					$aSiteReviews = $this->getProductsCampaignReviews($campaignId, $limit, $offset, 'site');
					//pre($aReviews);
					$questionAndAnsData = $this->getReviewQuestionsAndAnswers($campaignId);
					
					//addPageAndVisitorInfo($userID, 'Brand Page', serialize($campaignId), 'Visit');
					
					return view('store.index', array('oCampaign' => $oCampaign, 'aReviews' => $aReviews, 'servicesReviews' => $servicesReviews, 'questionAndAnsData' => $questionAndAnsData, 'aSiteReviews'=>$aSiteReviews, 'siteReview' => $siteReview, 'productsData' => $productsData, 'brandData' => $brandData[0], 'campaignId' => $campaignId, 'faQData' => $faQData, 'userDetail' => $userDetail));
				}
			}
			else if (empty($campaign)) {
				$userID = 0;
				$offset = 0;
				$limit = 100;
			
				$userDetail = $mUser->getUserByCompanyName($bussName);
				$bussName = ucwords(str_replace('-', ' ', $bussName));
				$userID = $userDetail->id;
				$getBrandboost = $mBrandboost->getBrandboostDetailByUserId($userID, 'onsite');
				$brandData = $mBrand->getBrandConfigurationData($userID);
				$campaign_ids = unserialize($brandData[0]->campaign_ids);
				if(!empty($campaign_ids)) {
					$aReviews = $this->getSelectedCampaignReviews($campaign_ids, $limit, $offset);
				}
				$faQData = $mBrand->getFaqDataByUserId($userID);
				
				/*$this->load->view('company/campany_list', array('getBrandboost' => $getBrandboost, 'aUser' => $userDetail, 'bussName' => $bussName));*/
				
				//addPageAndVisitorInfo($userID, 'Brand Page', $brandData[0]->campaign_ids, 'Visit');
				 $productsData = array();
				return view('store.index', array( 'aReviews' => $aReviews, 'questionAndAnsData' => $questionAndAnsData, 'brandData' => $brandData[0], 'faQData' => $faQData, 'userDetail'=>$userDetail,'productsData' => $productsData));
				
			}
			
		}
		
		
		public function getReviewQuestionsAndAnswers($campaignId){
			$mUser = new UsersModel();
			$oQuestions = $this->mQuestion->getBrandboostQuestions($campaignId);
			if (!empty($oQuestions)) {
				foreach ($oQuestions as $qusetion) {
					$qusetion = (array) $qusetion;
					$questionID = $qusetion['id'];
					$aQAData[$questionID] = $qusetion;
					$userData = $mUser->getUserInfo($qusetion['user_id']);
					$aQAData[$questionID]['user_data'] = $userData;
					
					$oAnswers = $this->mQuestion->getAllAnswer($questionID);
					if (!empty($oAnswers)) {
						foreach ($oAnswers as $answer) {
							$answer = (array) $answer;
							$answerID = $answer['id'];
							$userData = $mUser->getUserInfo($answer['user_id']);
							$helpfulData = $this->mQuestion->getReviewAnswerHelpful($answerID);
							$aQAData[$questionID]['answer'][$answerID] = $answer;
							$aQAData[$questionID]['answer'][$answerID]['user_data'] = $userData;
							$aQAData[$questionID]['answer'][$answerID]['helpful'] = $helpfulData;
						}
					}
				}
				return $aQAData;
			}
		}
		
		public function loadCampaignReview() {
			
			$post = $this->input->post();
			if(!empty($post)) {
				$offsite = $post['offsite'];
				$limit = $post['limit'];
				$campaignId = $post['campaignId'];
				$brandData = $this->mBrand->getBrandConfigurationData($campaignId);
				$oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId, $hash = false);
				
				//Collect configurations
				$iReviewsPerPage = $oCampaign->num_of_review;
				$minRating = $oCampaign->min_ratings_display;
				
				$aReviews = $this->getCampaignReviews($campaignId, $limit, $offsite);
				if(!empty($aReviews)) {
					foreach ($aReviews as $aReview):
					
					$profileImg = $aReview['user_data']['avatar'] == '' ? base_url('/assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$aReview['user_data']['avatar'];
					
					$brandImgArray = unserialize($aReview['media_url']);
					
					
					if (count($brandImgArray) > 0){
						if($brandImgArray[0]['media_type'] == 'image') {
							$reviewImg = '<a style="cursor:pointer;" revId="'.$aReview['id'].'" revAvatar="'.$profileImg.'" class="mediaLargImage"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$brandImgArray[0]['media_url'].'" alt="" class="b_review"></a>';
							$commentWL = '80';
						}
						else {
							$reviewImg = '';
						}
					}
					else {
						$reviewImg = '';
					}
					
					
					
					
					if (!empty($aReview['media_url'])) {
						if (strpos($aReview['media_url'], '.mp4') !== false) {
							$mediaType = 'video';
							} else {
							$mediaType = 'image';
						}
						} else {
						$mediaType = '';
					}
					//if($aReview['status'] == 1 || ($aReview['status'] == 2 && $aReview['user_id'] == $userID)){
					
					//pre($aReview);
				?>
				<input type="hidden" class="fullname<?php echo $aReview['id']?>" value="<?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?>">
				
				<input type="hidden" class="review<?php echo $aReview['id']?>" value="<?php echo $aReview['comment_text'] != ''?$aReview['comment_text']: ''; ?>">
				
				
				
				
				<div class="brand_review mb-20 br5">
					<div class="p20 bbot pl30">
						<div class="media-left media-middle"> <!-- <i class="fa fa-circle circle txt_green"></i> --> <a class="icons" style="cursor: pointer;"><img src="<?php echo $profileImg; ?>" class="img-circle img-xs" alt=""></a> </div>
						<div class="media-left">
							<div class="pt-5 fsize14 fw500"><span><?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?></span><span class="fw400 text-muted fsize14 ml-10">bought <?php echo $oCampaign->brand_title; ?></span></div>
							
							<div class="text-muted startRate<?php echo $aReview['id']; ?> text-size-small hidden">
								<p class="pull-left">
									<?php for ($i = 1; $i <= 5; $i++): ?>
									<i class="fa fa-star fsize13 <?php
										if ($i <= $aReview['ratings']) {
											echo 'txt_yellow';
											}else{
											echo 'txt_grey';
										}
									?>"></i>                                                                      
									<?php endfor; ?>
								</p>
								<span class="ml10"><?php echo timeAgo($aReview['created']); ?></span>
							</div>
							<p class="hidden revComment<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>/assets/images/widget/comment_icon.jpg"><?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : 'N/A'; ?> Comments <span id="revRatingStars"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span></p>
							
							<div class="text-muted  text-size-small"><span>
								<?php for ($i = 1; $i <= 5; $i++): ?>
								<i class="fa fa-star fsize12 <?php
									if ($i <= $aReview['ratings']) {
										echo 'txt_yellow';
										}else{
										echo 'txt_grey';
									}
								?>"></i>                                                                      
								<?php endfor; ?>
							</span>
							<span class="ml10 fw500 text-muted"><?php echo timeAgo($aReview['created']); ?></span></div>
						</div>
					</div>
					<div class="p20 bbot pl30 pr30">
						
						<p><?php echo $reviewImg; ?><span class="smallComment"><?php echo $aReview['comment_text'] != ''?setStringLimit($aReview['comment_text'], 250, $textClassReview): ''; ?></span><span class="moreComment hidden"><?php echo $aReview['comment_text'] != ''? $aReview['comment_text'].'&nbsp;&nbsp;<a style="curser:pointer" class="readLess '. $textClassReview .'">Less...</a>' : ''; ?></span></p>
						<div class="clearfix"></div>
						<div class="pt20">
							<p class="mb0 fsize13">
                                <span style="cursor: pointer;" class="pr10 brig fw500 text-muted commentReview"><i class="fa fa-comment-o fsize11 txt_grey"></i> &nbsp; <?php echo count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : 'N/A'; ?> Comments</span>
                                <span class="pr10 brig ml10 fw500 text-muted"><?php echo number_format($aReview['ratings'], 1); ?> Our of 5 Stars</span>
                                <span class="ml10 fw500 text-muted review_helpful_<?php echo $aReview['id']; ?> "><?php echo ($aReview['total_helpful']) ? $aReview['total_helpful'] : 0; ?> Found this helpful</span> 
                                <span class="ml-10">
                                    <a style="cursor: pointer;" class="pw_helpful_action bb_show_like_value"  action-name="Yes" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-up fsize10 txt_green brand_thumbs br5 mr-5"></i></a> 
                                    <a style="cursor: pointer;" class="pw_helpful_action bb_show_dis_like_value"  action-name="No" review-id="<?php echo $aReview['id']; ?>"><i class="fa fa-thumbs-o-down fsize10 txt_red brand_thumbs br5"></i></a>
									
								</span>
							</p>
						</div>
					</div>
					
					<!--*** comment section ***-->
					<div class="pw_comment_box p30" style="display: none;">
						
						<?php if (!empty($aReview['comment_block'])): ?>
						<?php
							foreach ($aReview['comment_block'] as $aComment):
							//pre($aComment);
							$getUserDetail = getUserDetail($aComment['user_id']);
						?>
						<div class="comment_row">
							<p style="font-weight: 500;"><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
							<p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
						</div>
						<?php endforeach; ?> 
						
						<?php endif; ?>
						<div class="pw_success_message">
							<div class="alert-success popup-cmt-alert-success-msg hidden" id="success-<?php echo $aReview['id']; ?>">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
							<div class="alert-danger popup-cmt-alert-error-msg hidden" id="error-<?php echo $aReview['id']; ?>">OPPS! Error while posting your comment. Try again!</div>
						</div>
						<div class="comment_form">
							
							<form method="POST" class="cmtformsubmit" action="javascript:void(0)" revId="<?php echo $aReview['id']; ?>" style="position:relative;">
								<div class="form-group">
									<div class="">
										<input name="cmtname" placeholder="Your Name" class="form-control cmtname" required="" type="text">
									</div>
								</div>
								<div class="form-group">
									<div class="">
										<input name="cmtemail" placeholder="Your Email" class="form-control cmtemail" required="" type="text">
									</div>
								</div>
								<div class="form-group">
									<textarea class="form-control cmt" name="cmt" placeholder="Write Your Comments Here…" required=""></textarea>
								</div>
								<div class="s_comment">
									<input type="hidden" name="rid" class="review-id" value="<?php echo $aReview['id']; ?>" >
									<button type="submit" class="cmtsubmit btn dark_btn mt30" name="cmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
								</div>
								<div class="overlay hidden" id="overlay-<?php echo $aReview['id']; ?>"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
							</form>
						</div>
						
					</div>
					<!--**** end comment section ****-->
				</div>
				
				
				<?php 
					
					//}
					endforeach;
				}
			}
			exit;
		}
		
		public function loadSiteReview() {
			$post = $this->input->post();
			if(!empty($post)) {
				$offsite = $post['offsite'];
				$limit = $post['limit'];
				$campaignId = $post['campaignId'];
				$brandData = $this->mBrand->getBrandConfigurationData($campaignId);
				$oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId, $hash = false);
				$siteReview = $this->mBrandboost->campaignSiteReview($campaignId, $limit, $offsite);
				
				if(!empty($siteReview)) {
					foreach ($siteReview as $sReview):
					
					
					$profileImg = $sReview['avatar'] == '' ? base_url('/assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$sReview['avatar'];
					
					$brandImgArray = unserialize($sReview['media_url']);
					
					
					
					
					if (count($brandImgArray) > 0){
						if($brandImgArray[0]['media_type'] == 'image') {
							$reviewImg = '<a style="cursor:pointer;" revId="'.$sReview['id'].'" revAvatar="'.$profileImg.'" class="mediaLargImage"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$brandImgArray[0]['media_url'].'" alt="" class="b_review"></a>';
							$commentWL = '80';
						}
						else {
							$reviewImg = '';
						}
					}
					else {
						$reviewImg = '';
					}
					
					
					
				?>
				<input type="hidden" class="fullname<?php echo $sReview['id']?>" value="<?php echo $sReview['firstname'] . ' ' . $sReview['lastname']; ?>">
				
				<input type="hidden" class="review<?php echo $sReview['id']?>" value="<?php echo $sReview['comment_text'] != ''?$sReview['comment_text']: ''; ?>">
				
				<div class="brand_review mb-20 br5">
					<div class="p20 bbot pl30">
						<div class="media-left media-middle"> <!-- <i class="fa fa-circle circle txt_green"></i> --> <a class="icons" style="cursor: pointer;"><img src="<?php echo $profileImg; ?>" class="img-circle img-xs" alt=""></a> </div>
						<div class="media-left">
							<div class="pt-5 fsize14 fw500"><span><?php echo $sReview['firstname'] . ' ' . $sReview['lastname']; ?></span><span class="fw400 text-muted fsize14 ml-10">bought <?php echo $oCampaign->brand_title; ?></span></div>
							
							<div class="text-muted startRate<?php echo $sReview['id']; ?> text-size-small hidden">
								<p class="pull-left">
									<?php for ($i = 1; $i <= 5; $i++): ?>
									<i class="fa fa-star fsize13 <?php
										if ($i <= $sReview['ratings']) {
											echo 'txt_yellow';
											}else{
											echo 'txt_grey';
										}
									?>"></i>                                                                      
									<?php endfor; ?>
								</p>
								<span class="ml10"><?php echo timeAgo($sReview['created']); ?></span>
							</div>
							<p class="hidden revComment<?php echo $sReview['id']; ?>"><img src="<?php echo base_url(); ?>/assets/images/widget/comment_icon.jpg"><?php echo count($sReview['comment_block']) > 0 ? count($sReview['comment_block']) : 'N/A'; ?> Comments <span id="revRatingStars"><?php echo number_format($sReview['ratings'], 1); ?> Our of 5 Stars</span></p>
							
							<div class="text-muted  text-size-small"><span>
								<?php for ($i = 1; $i <= 5; $i++): ?>
								<i class="fa fa-star fsize12 <?php
									if ($i <= $sReview['ratings']) {
										echo 'txt_yellow';
										}else{
										echo 'txt_grey';
									}
								?>"></i>                                                                      
								<?php endfor; ?>
							</span>
							<span class="ml10 fw500 text-muted"><?php echo timeAgo($sReview['created']); ?></span></div>
						</div>
					</div>
					
                    <div class="p20 bbot pl30 pr30">
						
						<p><?php echo $reviewImg; ?><span class="smallComment"><?php echo $sReview['comment_text'] != ''?setStringLimit($sReview['comment_text'], 250, $textClassReview): ''; ?></span><span class="moreComment hidden"><?php echo $sReview['comment_text'] != ''? $sReview['comment_text'].'&nbsp;&nbsp;<a style="curser:pointer" class="readLess '. $textClassReview .'">Less...</a>' : ''; ?></span></p>
						<div class="clearfix"></div>
						<div class="pt20">
							<p class="mb0 fsize13">
                                <span style="cursor: pointer;" class="pr10 brig fw500 text-muted commentReview"><i class="fa fa-comment-o fsize11 txt_grey"></i> &nbsp; <?php echo count($sReview['comment_block']) > 0 ? count($sReview['comment_block']) : 'N/A'; ?> Comments</span>
                                <span class="pr10 brig ml10 fw500 text-muted"><?php echo number_format($sReview['ratings'], 1); ?> Our of 5 Stars</span>
                                <span class="ml10 fw500 text-muted site_review_helpful_<?php echo $aReview['id']; ?>"><?php echo ($sReview['total_helpful']) ? $sReview['total_helpful'] : 0; ?> Found this helpful</span> 
                                <span class="ml-10">
                                    <a style="cursor: pointer;" class="pw_helpful_action_site bb_show_like_value"  action-name="Yes" review-id="<?php echo $sReview['id']; ?>"><i class="fa fa-thumbs-o-up fsize10 txt_green brand_thumbs br5 mr-5"></i></a> 
                                    <a style="cursor: pointer;" class="pw_helpful_action_site bb_show_dis_like_value"  action-name="No" review-id="<?php echo $sReview['id']; ?>"><i class="fa fa-thumbs-o-down fsize10 txt_red brand_thumbs br5"></i></a>
									
								</span>
							</p>
						</div>
					</div>
					
				</div>
				<?php 
					
					
					endforeach;
				}
			}
			
			exit;
		}
		
		public function testReview($campaignId) {
			
			if (!empty($campaignId)) {
				$oCampaign = $this->mReviews->getBrandBoostCampaign($campaignId, $hash = false);
				
				//Collect configurations
				$iReviewsPerPage = $oCampaign->num_of_review;
				$minRating = $oCampaign->min_ratings_display;
				
				$aReviews = $this->getCampaignReviews($campaignId);
				$aSiteReviews = $this->getSiteReviews($campaignId);
				
				$this->load->view('store/index1', array('oCampaign' => $oCampaign, 'aReviews' => $aReviews, 'aSiteReviews'=>$aSiteReviews));
			}
		}
		
		public function explore($campaignId) {
			
			
		}
		
		public function getCampaignSiteReviews($campaignID, $limit, $offset, $aSettings = array()) {
			//$aUser = getLoggedUser();
			$aUser = array();
			$mUser  = new UsersModel();
			if(!empty($aUser)){
				$aSettings['logged'] = true;
				$aSettings['logged_id'] = $aUser->id;
				
			}
			$aSettings['start'] = $offset;
			$aSettings['review_limit'] = $limit;
			
			$oReviews = $this->mReviews->getSiteReviews($campaignID, $aSettings);
			
			if (!empty($oReviews)) {
				foreach ($oReviews as $oReview) {
					$aReview = (array) $oReview;
					$reviewID = $aReview['id'];
					$userID = $aReview['user_id'];
					$aReviewData[$reviewID] = $aReview;
					$userData = $mUser->getUserInfo($userID);
					// Get Helpful
					$aHelpful = $this->mReviews->countSiteReviewHelpful($reviewID);
					$aReviewData[$reviewID]['total_helpful'] = $aHelpful['yes'];
					$aReviewData[$reviewID]['total_helpful_no'] = $aHelpful['no'];
					$aReviewData[$reviewID]['user_data'] = (array) $userData;
					
					//Get Comments Block
					//$oComments = $this->getCommentsBlock($reviewID);
					$oComments = $this->mReviews->getSiteReviewComments($reviewID, $aSettings);
					$aCommentsData = array();
					if (!empty($oComments)) {
						foreach ($oComments as $oComment) {
							$aComment = (array) $oComment;
							$aCommentsData[$aComment['id']] = $aComment;
							unset($aComment);
						}
					}
					$aReviewData[$reviewID]['comment_block'] = $aCommentsData;
					unset($aCommentsData);
				}
				return $aReviewData;
			}
			
		}
		
		public function getCampaignReviews($campaignID, $limit, $offset, $aSettings = array()) {
			//$aUser = getLoggedUser();
			$aUser = array();
			$mUser = new UsersModel();
			$mBrandboost = new BrandboostModel();
			$mReviews = new ReviewsModel();
			if(!empty($aUser)){
				$aSettings['logged'] = true;
				$aSettings['logged_id'] = $aUser->id;
				
			}
			$aSettings['start'] = $offset;
			$aSettings['review_limit'] = $limit;
			
			$oReviews = $this->mReviews->getReviews($campaignID, $aSettings);
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
					//$oComments = $this->getCommentsBlock($reviewID);
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
		
		
		public function getProductsCampaignReviews($campaignID, $limit, $offset, $productType, $aSettings = array()) {
			//$aUser = getLoggedUser();
			$mUser = new UsersModel();
			$mReviews = new ReviewsModel();
			$mBrandboost  = new BrandboostModel();
			$aUser = array();
			if(!empty($aUser)){
				$aSettings['logged'] = true;
				$aSettings['logged_id'] = $aUser->id;
				
			}
			$aSettings['start'] = $offset;
			$aSettings['review_limit'] = $limit;
			
			$oReviews = $this->mReviews->getReviewsByProductType($campaignID, $aSettings, $productType);
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
					//$oComments = $this->getCommentsBlock($reviewID);
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
				
		
		public function getSelectedCampaignReviews($multiCampaignID, $limit, $offset, $aSettings = array()) {
			//$aUser = getLoggedUser();
			$mReviews = new ReviewsModel();
			$mUser  = new UsersModel();
			$aReviewData = array();
			$aUser = array();
			if(!empty($aUser)){
				$aSettings['logged'] = true;
				$aSettings['logged_id'] = $aUser->id;
				
			}
			$aSettings['start'] = $offset;
			$aSettings['review_limit'] = $limit;
			
			$oReviews = $mReviews->getMultiReviews($multiCampaignID, $aSettings);
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
					//$oComments = $this->getCommentsBlock($reviewID);
					$oComments = $mReviews->getComments($reviewID, $aSettings);
					$aCommentsData = array();
					if (!empty($oComments)) {
						foreach ($oComments as $oComment) {
							$aComment = (array) $oComment;
							$aCommentsData[$aComment['id']] = $aComment;
							unset($aComment);
						}
					}
					$aReviewData[$reviewID]['comment_block'] = $aCommentsData;
					unset($aCommentsData);
				}
				return $aReviewData;
			}
			
		}
		
		public function getSiteReviews($campaignID, $aSettings = array()) {
			$aUser = getLoggedUser();
			if(!empty($aUser)){
				$aSettings['logged'] = true;
				$aSetings['logged_id'] = $aUser->id;
			}
			
			$oReviews = $this->mReviews->getSiteReviews($campaignID, $aSettings);
			if (!empty($oReviews)) {
				foreach ($oReviews as $oReview) {
					$aReview = (array) $oReview;
					$reviewID = $aReview['id'];
					$aReviewData[$reviewID] = $aReview;
					
				}
				return $aReviewData;
			}
		}
		
		public function saveComment() {
			$response = array();
			$post = $this->input->post();
			
			$userID = $post['userID'];
			
			if (!empty($post)) {
				$reviewID = strip_tags($post['rid']);
				
				$fullName = strip_tags($post['cmtname']);
				$email = strip_tags($post['cmtemail']);
				$commentText = strip_tags($post['cmt']);
				
				$getReview = $this->mReviews->getReviewByReviewID($reviewID);
				
				$reviewCampaignId = $getReview[0]->campaign_id;
				
				
				$reviewUserID = $getReview[0]->user_id;
				$reviewType = $getReview[0]->review_type;
				
				
				$getBrandboostDetail = $this->mInviter->getBBInfo($reviewCampaignId);
				$brandBoostUserId = $getBrandboostDetail->user_id;
				
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
					$userID = $this->mSubscriber->registerUserAlongWithSubscriber($aRegistrationData);
					//$userID = $this->mSubscriber->addBrandboostUserAccount($aRegistrationData, 2, true);
				}
				
				if (empty($userID)) {
					$response = array('status' => 'error', 'msg' => 'User registration has failed');
					return json_encode($response);
				}
				
				// Collect comment
				$aCommentData = array(
                'review_id' => $reviewID,
                'user_id' => $userID,
                'parent_comment_id' => 0,
                'content' => $commentText,
                'status' => 2,
                'created' => date("Y-m-d H:i:s")
				);
				
				addPageAndVisitorInfo($brandBoostUserId, 'Brand Page Review', serialize($reviewCampaignId), 'Add Comment');
				$bSaved = $this->mReviews->saveComment($aCommentData);
				
				if ($bSaved) {
					// Send Notification
					$aNotificationDataCus = array(
                    'user_id' => $brandBoostUserId,
                    'event_type' => 'added_' . $reviewType . '_comment',
                    'message' => ucfirst($reviewType) . ' Comment has been added successfully',
                    'link' => base_url() . 'admin/brandboost/reviewdetails/' . $reviewID,
                    'created' => date("Y-m-d H:i:s")
					);
					$eventName = "sys_brand_onsite_review_add";
					add_notifications($aNotificationDataCus, $eventName, $brandBoostUserId, $notifyAdmin='1');
					
					$response = array('status' => 'ok', 'msg' => 'Thank you for posting your comment. Your review was sent successfully and is now waiting to publish it.', 'rid'=> $reviewID);
					} else {
					$response = array('status' => 'error', 'msg' => 'Error while posting your comment. Try again', 'rid'=> $reviewID);
				}
				
				echo json_encode($response);
				exit;
			}
			
		}
		
		public function saveHelpful() {
			$response = array();
			$post = $this->input->post();
			if (!empty($post)) {
				$reviewID = strip_tags($post['review_id']);
				$action = strip_tags($post['action']);
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
				
				if ($alreadyVoted == false || $alreadyVoted['action'] == 'h_null') { 
					$reviewData = $this->mReviews->getReviewByReviewID($reviewID);
					
					addPageAndVisitorInfo($reviewData[0]->user_id, 'Brand Page Review', serialize($reviewData[0]->campaign_id), 'Helpful Action');
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
				
				$aHelpful = $this->mReviews->countHelpful($reviewID);
				$response = array('status' => 'ok', 'yes' => $aHelpful['yes'], 'no' => $aHelpful['no']);
			}
			echo json_encode($response);
			exit;
		}
		
		public function saveSiteHelpful() {
			$response = array();
			$post = $this->input->post();
			if (!empty($post)) {
				$reviewID = strip_tags($post['review_id']);
				$action = strip_tags($post['action']);
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
				
				$alreadyVoted = $this->mReviews->checkIfSiteVoted($reviewID, $ip);
				//pre($alreadyVoted);
				
				if ($alreadyVoted == false || $alreadyVoted['action'] == 'h_null') { 
					$reviewData = $this->mReviews->getSiteReviewByReviewID($reviewID);
					
					addPageAndVisitorInfo($reviewData[0]->user_id, 'Brand Page Review', serialize($reviewData[0]->campaign_id), 'Helpful Action');
					$bSaved = $this->mReviews->saveSiteReviewHelpful($aVoteData);
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
					$bUpdated = $this->mReviews->updateSiteReviewHelpful($aVoteData, $alreadyVoted['vote_id']);
					addPageAndVisitorInfo($reviewData[0]->user_id, 'Brand Page Review', serialize($reviewData[0]->campaign_id), 'Helpful Action');
				}
				
				$aHelpful = $this->mReviews->countSiteReviewHelpful($reviewID);
				$response = array('status' => 'ok', 'yes' => $aHelpful['yes'], 'no' => $aHelpful['no']);
			}
			echo json_encode($response);
			exit;
		}
		
		
	}	