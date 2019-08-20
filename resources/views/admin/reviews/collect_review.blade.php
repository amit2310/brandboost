
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BrandBoost::Admin</title>
		
		<!-- Global stylesheets -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/css/theme1.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/css/review_request.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/css/review_request_collect.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
		<!-- /global stylesheets -->
		
		
		<!-- Core JS files -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/pace.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/blockui.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
		<!-- /core JS files -->
		<style type="text/css">
			.selected{
			text-shadow: 0 1px 0 0 rgba(255, 160, 79, 0.15)!important;
			color: #ffcd5e!important;
			font-size: 18px; 
			margin-right: 3px;
			}
			.fav_gry{
			margin-right: 3px;
			}
			.icon_image_check {
			display: none;
			}
			.icon_image_active {
			display: none;
			}
			.icon_image {
			display: none;
			}
			.dropzone {
			border-radius: 5px;
			box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);
			border: solid 1px #f3f4f7;
			background-color: #fff;
			text-align: center;
			padding-top: 30px;
			}
			.dropzone .GIF-JPG-PNG-ASF {
			font-family: 'Inter UI';
			font-size: 11px;
			font-weight: normal;
			font-style: normal;
			font-stretch: normal;
			line-height: 1.09;
			letter-spacing: normal;
			color: #9292b4;
			margin-top: 12px;
			}
			
			.dropzone .Drag-Drop-Your-Fil {
			font-family: 'Inter UI';
			font-size: 12px;
			font-weight: 500;
			font-style: normal;
			font-stretch: normal;
			line-height: 0.92;
			letter-spacing: normal;
			color: #2f3053;
			margin-top: 12px;
			}
			
			.bg-teal-400 {
			background-color: #26A69A;
			border-color: #26A69A;
			color: #fff;
			}
			.btn i {
			font-size: 12px!important;
			}
			
		</style>
		<!-- /theme JS files -->
	</head>
	<?php 
		$userId = $brandboostData->user_id; 
		$userData = getUserDetail($userId);
		$companyName = $userData->company_name;
		$companySlug = strtolower(str_replace(' ', '-', $companyName));
	?>
	<?php //pre($productsData); ?>
	<body>
		
		<header>
			<div class="KickShop">Brand<span>Boost</span></div>
			<a href="#" class="faq">FAQ</a>
		</header>
		
		<?php 
			if(!empty($rRating)) {
				$reviewRating = $rRating;
			}
			else {
				$reviewRating = 3;
			}
		?>
		
		<div class="overlaynew" style="position: fixed;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.4); z-index: 99999;text-align: center; display:none; top: 0">
			<div style="top: 47%;position:relative;">
				<button type="button" class="btn bg-teal-400" id="spinner-dark-6"><i class="icon-spinner9 spinner position-left"></i> Processing</button>
			</div>
		</div>
		
		
		<section class="thanku_purchase">
			<h2>Thanks for your purchase!</h2>
			<p><?php echo $uSubscribers->firstname.' '.$uSubscribers->lastname;?>! Thanks for purchasing from Brandboost.
				<span>Can a Spare a minute of your time to tell us</span>
			<span>What you thought?</span></p>
		</section>
		
		<!----tab_accord---->
		<div class="tab_accord">
			
			<div class="tabContent" id="tabContent1">
				<div class="panel-group" id="accordion">
					
					<form method="post" name="frmSiteReviewSubmit" id="frmSiteReviewSubmit" container_name="sitereview" action="#"  enctype="multipart/form-data">
						<div class="panel panel-default">
							<a data-toggle="collapse" data-parent="#accordion" class="toggleDiv" href="#collapseOne"><div class="panel-heading">
								<h4>
									<img src="<?php echo base_url(); ?>assets/images/review/icon_01_active.png" alt="" class="star_cls_active icon_image_active">
									<img src="<?php echo base_url(); ?>assets/images/review/icon_01.png" alt="" class="star_cls"> 
									Your Customer Experience
									<span>Review your service experience with Brandboost</span>
									<i class="checked"><img class="icon_show icon_image_check" src="<?php echo base_url(); ?>assets/images/review/check-icon.png"></i>
								</h4>
							</div></a>
							
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<h2>Rate Our Service</h2>
									<div class="clearfix"></div>
									<div class="rating_box">
										<div class="rating_txt">Rating</div>
										<div class="star_bx starRate">
											<?php 
												for($inc = 1; $inc <= 5; $inc++) {
												?>
												<i data-value='<?php echo $inc; ?>' containerclass="siteRatingValue" class="fa fa-star fav_gry <?php echo $inc <= $reviewRating?'selected':''; ?>"></i>
												<?php 
												}
											?>
											<div class="rat_num"><?php echo $reviewRating; ?>/5</div>
										</div>
									</div>
									<div class="clearfix"></div>
									
									<h2>review of our service</h2>
									<div class="clearfix"></div>
									<div class="much_bx">
										<div class="review_headline">Review Headline</div>
										<div class="very_much"> <input name="title" id="site-title" class="form-control" placeholder="I like it very much!" type="text" required></div>
										<div class="divider"></div>
										<div class="clearfix"></div>
										<div class="tell_you"><textarea name="description" class="form-control addnote" id="site-description" placeholder="Tell you what you thought of their service..." required></textarea></div>
									</div>
									
									
									<h2>upload photo or video</h2>
									
									<div class="right_max">
										<a href="#">5 media max.</a>
										<a href="#">Video & Images Rules</a>
									</div>
									<div class="clearfix"></div>
									<div class="dropzone" id="myDropzone">
										<span class="drop_rate">
											<img src="<?php echo base_url(); ?>assets/images/review/drag_icon.png">
											<div class="Drag-Drop-Your-Fil">Drag & Drop Your Files</div>
											<div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
										</span>
									</div>
									<div id="uploadedSiteFiles" style="display: none;"></div>
									
									
									
									<h2>Contact Info</h2>
									<div class="clearfix"></div>
									<div class="much_bx name_bx">
										<div class="review_headline full_n_bx">Full name</div>
										<div class="very_much"><input name="fullname" class="form-control subNameAdd" value="<?php echo $uSubscribers->firstname.' '.$uSubscribers->lastname;?>" type="text"></div>
										<div class="divider"></div>
										<div class="clearfix"></div>
										<div class="review_headline full_n_bx">Email</div>
										<div class="very_much"><input name="emailid" class="form-control subEmailAdd" value="<?php echo $uSubscribers->email;?>" type="text"></div>
									</div>
									<div class="clearfix"></div>
									
									<div class="chck_box">
										<label class="container">Don't show my name
											<input name="display_name" value="1" type="checkbox">
											<span class="checkmark"></span>
										</label>
									</div>
									
									
									<div class="ful_divider"></div>
									<div class="bottom_btn_sec">
										<?php if($action !='preview'):?>
										<input type="submit" class="sav_con buttonSiteReview"  value="Next & Continue">
										<?php endif; ?>
										<a style="cursor: pointer;" class="skip skip1">Skip</a>
										
										<div class="right_chck_box">
											<label class="container">Agree to our <a href="#">Terms & Conditions</a>
												<input type="checkbox" checked="checked" name="termAndCondition" class="tacSiteReview" required>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<input type="hidden" name="campaign_id" value="<?php echo $brandboostID; ?>" />
									<input type="hidden" name="subID" value="<?php echo $subscriberID; ?>" />
									<input type="hidden" name="inviterID" value="<?php echo $inviterID; ?>" />
									<input type="hidden" name="reviewUniqueID" value="<?php echo $uniqueID; ?>">
									<input type="hidden" value="<?php echo $reviewRating; ?>" class="siteRatingValue" id="siteRatingValue" name="ratingValue">
									<input type="hidden" value="site" id="reviewType" name="reviewType">
								</div>
							</div>
							
						</div>
					</form>
					
					<?php if(count($productsData) > 0){ ?>
					<form method="post" name="frmProductReviewSubmit" id="frmProductReviewSubmit" container_name="productreview" action="#"  enctype="multipart/form-data"> 
						<div class="panel panel-default">
							<a data-toggle="collapse" data-parent="#accordion" class="toggleDiv collapseTwo" href="#collapseTwo"><div class="panel-heading">
								<h4>
									<img src="<?php echo base_url(); ?>assets/images/review/icon_02_active.png" alt="" class="star_cls_active">
									<img src="<?php echo base_url(); ?>assets/images/review/icon_02.png" alt="" class="star_cls icon_image"> 
									Your Purchases
									<span>Rate your Purchases and tell us what you thought of them</span>
									<i class="checked"><img class="icon_show" src="<?php echo base_url(); ?>assets/images/review/check-icon.png"></i>
								</h4>
							</div></a>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
									
									<?php foreach($productsData as $key=>$productData){ ?>
									<div class="mb20">
										<div class="product_two_bx">
											<div class="auto_message"><?php echo $productData->product_name; ?></div>
											<img src="<?php echo base_url(); ?>assets/images/review/down_arro.png" alt="" class="down_arro">
										</div>
										<div class="ful_divider" style="margin-top:30px;"></div>
										<div class="clearfix"></div>
										<div class="mt20"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $productData->product_image; ?>" class="" style="width:100%;"></div>
										<div class="clearfix"></div>
										<h2>RATE product</h2>
										<div class="clearfix"></div>
										<div class="rating_box">
											<div class="rating_txt">Rating</div>
											<div class="star_bx starRate">
												<?php 
													for($inc = 1; $inc <= 5; $inc++) {
													?>
													<i data-value='<?php echo $inc; ?>' containerclass="productRatingValue_<?php echo $productData->id; ?>" class="fa fa-star fav_gry <?php echo $inc <= $reviewRating?'selected':''; ?>"></i>
													<?php 
													}
												?>
												<div class="rat_num"><?php echo $reviewRating; ?>/5</div>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<h2>REVIEW product</h2>
										<div class="clearfix"></div>
										<div class="much_bx">
											<div class="review_headline">Review Headline</div>
											<div class="very_much"><input name="title[<?php echo $productData->id; ?>]" class="form-control" placeholder="I like it very much!" type="text" required></div>
											<div class="divider"></div>
											<div class="clearfix"></div>
											<div class="tell_you"><textarea name="description[<?php echo $productData->id; ?>]" class="form-control addnote" placeholder="Tell you what you thought of their service..." required></textarea></div>
										</div>
										
										<h2>upload photo or video</h2>
										
										<div class="right_max">
											<a href="#">5 media max.</a>
											<a href="#">Video & Images Rules</a>
										</div>
										<div class="clearfix"></div>
										<div class="dropzone" id="myDropzone<?php echo $productData->id; ?>">
											<span class="drop_rate_review_<?php echo $productData->id; ?>">
												<img src="<?php echo base_url(); ?>assets/images/review/drag_icon.png">
												<div class="Drag-Drop-Your-Fil">Drag & Drop Your Files</div>
												<div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
											</span>
										</div>
										<div style="display: none;" id="uploadedProductFiles_<?php echo $productData->id; ?>"></div>
										<div class="hidden">
											<h2>Contact Info</h2>
											<div class="clearfix"></div>
											<div class="much_bx name_bx">
												<div class="review_headline full_n_bx">Full name</div>
												<div class="very_much"><input name="fullname[<?php echo $productData->id; ?>]" class="form-control autoFillFN" value="<?php echo $uSubscribers->firstname.' '.$uSubscribers->lastname;?>" type="text"></div>
												<div class="divider"></div>
												<div class="clearfix"></div>
												<div class="review_headline full_n_bx">Email</div>
												<div class="very_much"><input name="emailid[<?php echo $productData->id; ?>]" class="form-control autoFillEmail" value="<?php echo $uSubscribers->email;?>" type="text"></div>
												<input type="hidden" value="<?php echo $reviewRating; ?>" id="productRatingValue_<?php echo $productData->id; ?>" name="ratingValue[<?php echo $productData->id; ?>]">
												<input type="hidden" value="<?php echo $productData->id; ?>" name="productId[<?php echo $productData->id; ?>]">
											</div>
											<div class="clearfix"></div>
											
											<div class="chck_box">
												<label class="container">Don't show my name
													<input name="display_name[<?php echo $productData->id; ?>]" value="1" type="checkbox">
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="ful_divider"></div>
									</div>
									<?php } ?>						
									
									<div class="bottom_btn_sec">
										<?php if($action !='preview'):?>
										<input type="submit" class="sav_con buttonCampaignReview" value="Next & Continue">
										<?php endif; ?>
										<a style="cursor: pointer;" class="skip skip2">Skip</a>
										
										<div class="right_chck_box">
											<label class="container">Agree to our <a href="#">Terms & Conditions</a>
												<input type="checkbox" checked="checked" name="termAndCondition" class="tacCampaignReview" required>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<input type="hidden" name="campaign_id" value="<?php echo $brandboostID; ?>" />
									<input type="hidden" name="subID" value="<?php echo $subscriberID; ?>" />
									<input type="hidden" name="inviterID" value="<?php echo $inviterID; ?>" />
									<input type="hidden" name="reviewUniqueID" value="<?php echo $uniqueID; ?>">
									<input type="hidden" value="product" id="reviewType" name="reviewType">
								</div>
							</div>
						</div>
					</form>
					<?php } ?>
					
					<?php if(count($servicesData) > 0){ ?>
					<form method="post" name="frmServiceReviewSubmit" id="frmServiceReviewSubmit" container_name="servicereview" action="#"  enctype="multipart/form-data"> 
						<div class="panel panel-default">
							<a data-toggle="collapse" data-parent="#accordion" class="toggleDiv collapseFive" href="#collapseFive"><div class="panel-heading">
								<h4>
									<img src="<?php echo base_url(); ?>assets/images/service_icon_dark.png" alt="" class="star_cls_active">
									<img src="<?php echo base_url(); ?>assets/images/service_icon_blue.png" alt="" class="star_cls icon_image"> 
									Your Used Services
									<span>Rate your used Services and tell us what you thought of them</span>
									<i class="checked"><img class="icon_show" src="<?php echo base_url(); ?>assets/images/review/check-icon.png"></i>
								</h4>
							</div></a>
							<div id="collapseFive" class="panel-collapse collapse">
								<div class="panel-body">
									
									<?php foreach($servicesData as $key=>$productData){ ?>
									<div class="mb20">
										<div class="product_two_bx">
											<div class="auto_message"><?php echo $productData->product_name; ?></div>
											<img src="<?php echo base_url(); ?>assets/images/review/down_arro.png" alt="" class="down_arro">
										</div>
										<div class="ful_divider" style="margin-top:30px;"></div>
										<div class="clearfix"></div>
										<div class="mt20"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $productData->product_image; ?>" class="" style="width:100%;"></div>
										<div class="clearfix"></div>
										<h2>RATE product</h2>
										<div class="clearfix"></div>
										<div class="rating_box">
											<div class="rating_txt">Rating</div>
											<div class="star_bx starRate">
												<?php 
													for($inc = 1; $inc <= 5; $inc++) {
													?>
													<i data-value='<?php echo $inc; ?>' containerclass="serviceRatingValue_<?php echo $productData->id; ?>" class="fa fa-star fav_gry <?php echo $inc <= $reviewRating?'selected':''; ?>"></i>
													<?php 
													}
												?>
												<div class="rat_num"><?php echo $reviewRating; ?>/5</div>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<h2>REVIEW product</h2>
										<div class="clearfix"></div>
										<div class="much_bx">
											<div class="review_headline">Review Headline</div>
											<div class="very_much"><input name="title[<?php echo $productData->id; ?>]" class="form-control" placeholder="I like it very much!" type="text" required></div>
											<div class="divider"></div>
											<div class="clearfix"></div>
											<div class="tell_you"><textarea name="description[<?php echo $productData->id; ?>]" class="form-control addnote" placeholder="Tell you what you thought of their service..." required></textarea></div>
										</div>
										
										<h2>upload photo or video</h2>
										
										<div class="right_max">
											<a href="#">5 media max.</a>
											<a href="#">Video & Images Rules</a>
										</div>
										<div class="clearfix"></div>
										<div class="dropzone" id="myDropzone<?php echo $productData->id; ?>">
											<span class="drop_rate_review_<?php echo $productData->id; ?>">
												<img src="<?php echo base_url(); ?>assets/images/review/drag_icon.png">
												<div class="Drag-Drop-Your-Fil">Drag & Drop Your Files</div>
												<div class="GIF-JPG-PNG-ASF">GIF, JPG, PNG, ASF, FLV, M4V, MOV, MP4</div>
											</span>
										</div>
										<div style="display: none;" id="uploadedProductFiles_<?php echo $productData->id; ?>"></div>
										<div class="hidden">
											<h2>Contact Info</h2>
											<div class="clearfix"></div>
											<div class="much_bx name_bx">
												<div class="review_headline full_n_bx">Full name</div>
												<div class="very_much"><input name="fullname[<?php echo $productData->id; ?>]" class="form-control autoFillFN" value="<?php echo $uSubscribers->firstname.' '.$uSubscribers->lastname;?>" type="text"></div>
												<div class="divider"></div>
												<div class="clearfix"></div>
												<div class="review_headline full_n_bx">Email</div>
												<div class="very_much"><input name="emailid[<?php echo $productData->id; ?>]" class="form-control autoFillEmail" value="<?php echo $uSubscribers->email;?>" type="text"></div>
												<input type="hidden" value="<?php echo $reviewRating; ?>" id="serviceRatingValue_<?php echo $productData->id; ?>" name="ratingValue[<?php echo $productData->id; ?>]">
												<input type="hidden" value="<?php echo $productData->id; ?>" name="productId[<?php echo $productData->id; ?>]">
											</div>
											<div class="clearfix"></div>
											
											<div class="chck_box">
												<label class="container">Don't show my name
													<input name="display_name[<?php echo $productData->id; ?>]" value="1" type="checkbox">
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="ful_divider"></div>
									</div>
									<?php } ?>						
									
									<div class="bottom_btn_sec">
										<?php if($action !='preview'):?>
										<input type="submit" class="sav_con buttonCampaignReview" value="Next & Continue">
										<?php endif; ?>
										<a style="cursor: pointer;" class="skip skip4">Skip</a>
										
										<div class="right_chck_box">
											<label class="container">Agree to our <a href="#">Terms & Conditions</a>
												<input type="checkbox" checked="checked" name="termAndCondition" class="tacCampaignReview" required>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<input type="hidden" name="campaign_id" value="<?php echo $brandboostID; ?>" />
									<input type="hidden" name="subID" value="<?php echo $subscriberID; ?>" />
									<input type="hidden" name="inviterID" value="<?php echo $inviterID; ?>" />
									<input type="hidden" name="reviewUniqueID" value="<?php echo $uniqueID; ?>">
									<input type="hidden" value="service" id="reviewType" name="reviewType">
								</div>
							</div>
						</div>
					</form>
					<?php } ?>
					
					
					<form method="post" name="frmRecommendationSubmit" id="frmRecommendationSubmit" action="#" container_name="recommendationreview"  enctype="multipart/form-data"> 
						<div class="panel panel-default">
							<a data-toggle="collapse" data-parent="#accordion" class="toggleDiv collapseThree" href="#collapseThree"><div class="panel-heading">
								<h4>
									<img src="<?php echo base_url(); ?>assets/images/review/icon_03_active.png" alt="" class="star_cls_active">
									<img src="<?php echo base_url(); ?>assets/images/review/icon_03.png" alt="" class="star_cls icon_image"> 
									Your Recommendation
									<span>Review your service experience with Brandboost</span>
									<i class="checked"><img class="icon_show" src="<?php echo base_url(); ?>assets/images/review/check-icon.png"></i>
								</h4>
							</div></a>
							<div id="collapseThree" class="panel-collapse collapse">
								<div class="panel-body">
									
									
									
									<h2 class="margin_top5">How Likely are you recommend Brandboost to a friend?</h2>
									<div class="clearfix"></div>
									<div class="rating_box">
										<a href="javascript:void(0);" class="rec" val="1">1</a>
										<a href="javascript:void(0);" class="rec" val="2">2</a>
										<a href="javascript:void(0);" class="rec" val="3">3</a>
										<a href="javascript:void(0);" class="rec" val="4">4</a>
										<a href="javascript:void(0);" class="rec" val="5">5</a>
										<a href="javascript:void(0);" class="rec" val="6">6</a>
										<a href="javascript:void(0);" class="rec" val="7">7</a>
										<a href="javascript:void(0);" class="rec" val="8">8</a>
										<a href="javascript:void(0);" class="rec" val="9">9</a>
										<a href="javascript:void(0);" class="rec" val="10">10</a>
									</div>
									<div class="not_likely">Not Likely At All</div>
									<div class="not_likely extremely_likely">Extremely Likely</div>
									
									
									<div class="clearfix"></div>
									
									<div class="ful_divider"></div>
									<div class="bottom_btn_sec">
										<?php if($action !='preview'):?>
										<input type="submit" class="sav_con buttonReReview" value="Next & Continue">
										<?php endif; ?>
										<a style="cursor: pointer;" class="skip skip3">Skip</a>
										
										<div class="right_chck_box">
											<label class="container">Agree to our <a href="#">Terms & Conditions</a>
												<input type="checkbox" checked="checked" class="tacReReview" name="termAndCondition" required>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<input type="hidden" name="campaign_id" value="<?php echo $brandboostID; ?>" />
						<input type="hidden" name="subID" value="<?php echo $subscriberID; ?>" />
						<input type="hidden" name="inviterID" value="<?php echo $inviterID; ?>" />
						<input type="hidden" name="reviewUniqueID" value="<?php echo $uniqueID; ?>">
						<input type="hidden" value="recomendation" id="reviewType" name="reviewType">
						<input type="hidden" value="0" id="recomendationValue" name="recomendationValue">
					</form>
					
					<form method="post" name="frmRecommendationUrlSubmit" id="frmRecommendationUrlSubmit" action="#" container_name="recommendationreviewurl"  enctype="multipart/form-data"> 
						<div class="panel panel-default">
							<a data-toggle="collapse" data-parent="#accordion" class="toggleDiv collapsefour" href="#collapsefour"><div class="panel-heading">
								<h4>
									<img src="<?php echo base_url(); ?>assets/images/review/icon_04_active.png" alt="" class="star_cls_active">
									<img src="<?php echo base_url(); ?>assets/images/review/icon_04.png" alt="" class="star_cls icon_image"> 
									Share with friends
									<span>Review your service experience with Brandboost</span>
									<i class="checked"><img class="icon_show" src="<?php echo base_url(); ?>assets/images/review/check-icon.png"></i>
								</h4>
							</div></a>
							<div id="collapsefour" class="panel-collapse collapse">
								<div class="panel-body">
									
									<h2 class="margin_top5">Share Product with friends</h2>
									<div class="clearfix"></div>
									<div class="rating_box2">
										<input name="recommendurl" id="recommendurl" class="form-control" value="<?php echo base_url().'for/' . $companySlug . '/' . strtolower(str_replace(" ", "-", $brandboostData->brand_title)) . '-' . $brandboostData->id; ?>" type="text" required="">
										<a style="cursor: pointer;" onclick="copyLink()" class="pull-right">Copy Link</a>
									</div>
									<div class="social_icons"><a class="" href="#"><img src="<?php echo base_url(); ?>assets/images/review/fb.png"></a> <a class="" href="#"><img src="<?php echo base_url(); ?>assets/images/review/twitter.png"></a> <a class="" href="#"><img src="<?php echo base_url(); ?>assets/images/review/google.png"></a> <a class="" href="#"><img src="<?php echo base_url(); ?>assets/images/review/email.png"></a></div>
									<input type="hidden" name="reviewUniqueID" value="<?php echo $uniqueID; ?>">
									<input type="hidden" class="subInviterID" name="subInviterID" value="<?php echo $inviterID; ?>">
									<input type="hidden" name="campaign_id" value="<?php echo $brandboostID; ?>" />
									<div class="clearfix"></div>
									
									<div class="ful_divider"></div>
									<div class="bottom_btn_sec">
										<?php if($action !='preview'):?>
										<input type="submit" class="sav_con buttonShareReview" id="recommendurlbtn" value="Submit">
										<?php endif; ?>
										<div class="right_chck_box">
											<label class="container">Agree to our <a style="cursor: pointer;" >Terms & Conditions</a>
												<input type="checkbox" checked="checked" class="tacShareReview" name="termAndCondition">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!----tab_accord---->
		
		<div id="alertMessagePopup" style="z-index: 99999" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body"><div class="message"></div></div>
					<div class="modal-footer">
						<button data-bb-handler="confirm" type="button" class="btn btn-primary confirmOk">OK</button>
					</div>
				</div>
			</div>
		</div>
		
		
		<script type="text/javascript">
			
			$(document).ready(function() {
				$(document).on('change', '.subNameAdd', function() {
					var name = $(this).val();
					$('.autoFillFN').each(function(){
						$(this).val(name);
					});
				});
				
				$(document).on('change', '.subEmailAdd', function() {
					var emailAddress = $(this).val();
					$('.autoFillEmail').each(function(){
						$(this).val(emailAddress);
					});
				});
				
				$(document).on('click', '.tacSiteReview', function() {
					if($(this).prop('checked') == true){
						$('.buttonSiteReview').show();
					}
					else {
						$('.buttonSiteReview').hide();
					}
				});
				
				$(document).on('click', '.tacCampaignReview', function() {
					if($(this).prop('checked') == true){
						$('.buttonCampaignReview').show();
					}
					else {
						$('.buttonCampaignReview').hide();
					}
				});
				
				$(document).on('click', '.tacReReview', function() {
					if($(this).prop('checked') == true){
						$('.buttonReReview').show();
					}
					else {
						$('.buttonReReview').hide();
					}
				});
				
				$(document).on('click', '.tacShareReview', function() {
					if($(this).prop('checked') == true){
						$('.buttonShareReview').show();
					}
					else {
						$('.buttonShareReview').hide();
					}
				});
				
				$(document).on("click", ".rec", function () {
					var recValue = $(this).attr("val");
					$("#recomendationValue").val(recValue);
					$('.rec').removeClass('bkg_purple txt_white');
					$(this).addClass('bkg_purple txt_white');
				});
				
				$('.nav a').click(function (e) {
					$(this).tab('show');
					
					var tabContent = '#tabContent' + this.id; 
					
					$('#tabContent1').hide();
					$('#tabContent2').hide();
					$('#tabContent3').hide();
					$('#tabContent4').hide();
					$(tabContent).show();
				});  
				
				
				//Display Ratings etc
				var ratingValue = 0;
				$('.starRate i').on('mouseover', function () {
					var onStar = parseInt($(this).data('value'), 10);
					
					
					$(this).parent().children('i').each(function (e) {
						if (e < onStar) {
							$(this).removeClass('fav_gry');
							$(this).addClass('fav_yello');
							} else {
							$(this).addClass('fav_gry');
							$(this).removeClass('fav_yello');
						}
					});
					
					}).on('mouseout', function () {
					$(this).parent().children('i').each(function (e) {
						$(this).removeClass('fav_yello');
						$(this).addClass('fav_gry');
					});
				});
				
				
				$('.starRate i').on('click', function () {
					var valContainer = $(this).attr('containerclass');
					var onStar = parseInt($(this).data('value'), 10);
					$(this).parent().find('div.rat_num').html(onStar+'/5');
					var stars = $(this).parent().children('i');
					for (i = 0; i < stars.length; i++) {
						$(stars[i]).removeClass('selected');
					}
					
					for (i = 0; i < onStar; i++) {
						$(stars[i]).addClass('selected');
					}
					
					ratingValue = $(this).attr("data-value");
					$('#' + valContainer).val(ratingValue);
				});
				
				Dropzone.options.myDropzone = {
					 url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment_review/".$_GET['clid']."/reviews"); ?>',
					uploadMultiple: false,
					maxFiles: 10,
					maxFilesize: 600,
					acceptedFiles: 'image/*,video/mp4',
					addRemoveLinks: true,
					removedfile: function(file) {
						var _ref;
						var xmlString = file.xhr.responseText;
						var totalStr = $('#uploadedSiteFiles').html();
						var res_str = totalStr.replace(xmlString, " ");
						$('#uploadedSiteFiles').html(res_str);
						var res = xmlString.split("||");
						var dropImage = res[0];
						$.ajax({
			                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
			                type: "POST",
			                data: {dropImage: dropImage},
			                dataType: "json",
			                success: function (data) {
			                  
			                }
			            });

			            setTimeout(function() {
			            	return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			            }, 1000);
						
						
					},
					success: function (response) {
					
						$('#uploadedSiteFiles').append(response.xhr.responseText);
					}
					
				}
				
				<?php foreach($productsData as $key=>$productData){ ?>
				Dropzone.options.myDropzone<?php echo $productData->id; ?> = {
					url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment_product_review/".$_GET['clid']."/reviews"); ?>/<?php echo $productData->id; ?>',
					uploadMultiple: false,
					maxFiles: 5,
					maxFilesize: 600,
					acceptedFiles: 'image/*,video/mp4',
					addRemoveLinks: true,
					removedfile: function(file) {
						var _ref;
						var xmlString = file.xhr.responseText;
						var totalStr = $('#uploadedProductFiles_<?php echo $productData->id; ?>').html();
						var res_str = totalStr.replace(xmlString, " ");
						$('#uploadedProductFiles_<?php echo $productData->id; ?>').html(res_str);
						var res = xmlString.split("||");
						var dropImage = res[0];
						$.ajax({
			                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
			                type: "POST",
			                data: {dropImage: dropImage},
			                dataType: "json",
			                success: function (data) {
			                  
			                }
			            });

			            setTimeout(function() {
			            	return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			            }, 1000);
						
						
					},
					success: function (response) {
						
						$('#uploadedProductFiles_<?php echo $productData->id; ?>').append(response.xhr.responseText);
					}
				}
				<?php } ?>
				
				<?php foreach($servicesData as $key=>$productData){ ?>
				Dropzone.options.myDropzone<?php echo $productData->id; ?> = {
					url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment_product_review/".$_GET['clid']."/reviews"); ?>/<?php echo $productData->id; ?>',
					uploadMultiple: false,
					maxFiles: 5,
					maxFilesize: 600,
					acceptedFiles: 'image/*,video/mp4',
					addRemoveLinks: true,
					removedfile: function(file) {
						var _ref;
						var xmlString = file.xhr.responseText;
						var totalStr = $('#uploadedProductFiles_<?php echo $productData->id; ?>').html();
						var res_str = totalStr.replace(xmlString, " ");
						$('#uploadedProductFiles_<?php echo $productData->id; ?>').html(res_str);
						var res = xmlString.split("||");
						var dropImage = res[0];
						$.ajax({
			                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
			                type: "POST",
			                data: {dropImage: dropImage},
			                dataType: "json",
			                success: function (data) {
			                  
			                }
			            });

			            setTimeout(function() {
			            	return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			            }, 1000);
						
						
					},
					success: function (response) {
						
						$('#uploadedProductFiles_<?php echo $productData->id; ?>').append(response.xhr.responseText);
					}
				}
				<?php } ?>
				setTimeout(function(){ $('.dz-default').hide(); }, 10);
				
				
				$("#frmSiteReviewSubmit, #frmProductReviewSubmit, #frmServiceReviewSubmit, #frmRecommendationSubmit").submit(function () {
					var formdata = new FormData(this);
					var containerName = $(this).attr("container_name");
					$('.overlaynew').show();
					$.ajax({
						url: "<?php echo base_url('/reviews/saveNewReview'); ?>",
						type: "POST",
						data: formdata,
						contentType: false,
						cache: false,
						processData: false,
						dataType: "json",
						success: function (response) {
							if (response.status == 'success') {
								$('.overlaynew').hide();
								if (containerName == 'sitereview') {
									
									$('#collapseOne').removeClass("in");
									$('#collapseTwo').addClass("in");
									$('#collapseThree').removeClass("in");
									$('#collapsefour').removeClass("in");
									
								} else if (containerName == 'productreview') {
									
									$('#collapseOne').removeClass("in");
									$('#collapseTwo').removeClass("in");
									$('#collapseFive').addClass("in");
									$('#collapsefour').removeClass("in");
									
								} else if (containerName == 'servicereview') {
									
									$('#collapseOne').removeClass("in");
									$('#collapseTwo').removeClass("in");
									$('#collapseFive').removeClass("in");
									$('#collapseThree').addClass("in");
									$('#collapsefour').removeClass("in");
									
								} else if (containerName == 'recommendationreview') {
									
									$('#collapseOne').removeClass("in");
									$('#collapseTwo').removeClass("in");
									$('#collapseThree').removeClass("in");
									$('#collapsefour').addClass("in");
									/*alertMessage("Review has been added successfully!");
										setTimeout(function () {
										window.location.href = response.redirect_url;
									}, 2000);*/
								}
								
								$('.panel-default').each(function(i){
									if($(this).find('.in').length > 0)
									{
										$(this).find('.icon_show').addClass('icon_image_check');
										$(this).find('.star_cls_active').addClass('icon_image_active');
										$(this).find('.star_cls').removeClass('icon_image');
									}
									else {
										$(this).find('.icon_show').removeClass('icon_image_check');
										$(this).find('.star_cls_active').removeClass('icon_image_active');
										$(this).find('.star_cls').addClass('icon_image');
									}
								});
								
							} else {
								$('.overlaynew').hide();
								alertMessage(response.msg);
							}
						},
						error: function (response) {
							$('.overlaynew').hide();
							alertMessage(response.msg);
						}
					});
					return false;
				});
				
				
				$("#frmRecommendationUrlSubmit").submit(function () {
					var formdata = new FormData(this);
					$('.overlaynew').show();
					var recommendurl = $('#recommendurl').val();
					$.ajax({
						url: "<?php echo base_url('reviews/submitOnsiteReview'); ?>",
						type: "POST",
						data: formdata,
						contentType: false,
						cache: false,
						processData: false,
						dataType: "json",
						success: function (response) {
							if (response.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = recommendurl;															
							} else {
								$('.overlaynew').hide();
								alertMessage(response.msg);
							}
						},
						error: function (response) {
							$('.overlaynew').hide();
							alertMessage(response.msg);
						}
					});
					return false;
				});
				
			});
			
			$(document).on('click', '.skip1', function() {
				$('#collapseOne').removeClass("in");
				$('#collapseTwo').addClass("in");
				$('#collapseThree').removeClass("in");
				$('#collapsefour').removeClass("in");
			
				$(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
				$(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
				$(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');
				
				$('.panel-default').each(function(i){
					if($(this).find('.in').length > 0)
					{
						$(this).find('.icon_show').addClass('icon_image_check');
						$(this).find('.star_cls_active').addClass('icon_image_active');
						$(this).find('.star_cls').removeClass('icon_image');
					}
					else {
						$(this).find('.icon_show').removeClass('icon_image_check');
						$(this).find('.star_cls_active').removeClass('icon_image_active');
						$(this).find('.star_cls').addClass('icon_image');
					}
				});
			});
			
			$(document).on('click', '.skip2', function() {
				$('#collapseOne').removeClass("in");
				$('#collapseTwo').removeClass("in");
				$('#collapseFive').addClass("in");
				$('#collapseThree').removeClass("in");
				$('#collapsefour').removeClass("in");
				
				
				$(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
				$(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
				$(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');
				
				$('.panel-default').each(function(i){
					if($(this).find('.in').length > 0)
					{
						$(this).find('.icon_show').addClass('icon_image_check');
						$(this).find('.star_cls_active').addClass('icon_image_active');
						$(this).find('.star_cls').removeClass('icon_image');
					}
					else {
						$(this).find('.icon_show').removeClass('icon_image_check');
						$(this).find('.star_cls_active').removeClass('icon_image_active');
						$(this).find('.star_cls').addClass('icon_image');
					}
				});
				
			});
			
			$(document).on('click', '.skip3', function() {
				$('#collapseOne').removeClass("in");
				$('#collapseTwo').removeClass("in");
				$('#collapseThree').removeClass("in");
				$('#collapsefour').addClass("in");
				
				$(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
				$(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
				$(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');
				
				$('.panel-default').each(function(i){
					if($(this).find('.in').length > 0)
					{
						$(this).find('.icon_show').addClass('icon_image_check');
						$(this).find('.star_cls_active').addClass('icon_image_active');
						$(this).find('.star_cls').removeClass('icon_image');
					}
					else {
						$(this).find('.icon_show').removeClass('icon_image_check');
						$(this).find('.star_cls_active').removeClass('icon_image_active');
						$(this).find('.star_cls').addClass('icon_image');
					}
				});
				
			});
			
			$(document).on('click', '.skip4', function() {
				$('#collapseOne').removeClass("in");
				$('#collapseTwo').removeClass("in");
				$('#collapseThree').addClass("in");
				$('#collapsefour').removeClass("in");
				$('#collapseFive').removeClass("in");
				
				$(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
				$(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
				$(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');
				
				$('.panel-default').each(function(i){
					if($(this).find('.in').length > 0)
					{
						$(this).find('.icon_show').addClass('icon_image_check');
						$(this).find('.star_cls_active').addClass('icon_image_active');
						$(this).find('.star_cls').removeClass('icon_image');
					}
					else {
						$(this).find('.icon_show').removeClass('icon_image_check');
						$(this).find('.star_cls_active').removeClass('icon_image_active');
						$(this).find('.star_cls').addClass('icon_image');
					}
				});
			});
			
			/*$(document).on('click', '#recommendurlbtn', function() {
				var recommendurl = $('#recommendurl').val();
				window.location.href = recommendurl;
			});*/
			
			function alertMessage(message) {
				$("#alertMessagePopup").modal();
				$('.message').html(message);
			}
			
			/*$(document).on('click', '.toggleDiv', function() {
				
				
				$('#collapseOne').removeClass("in");
				$('#collapseTwo').removeClass("in");
				$('#collapseThree').removeClass("in");
				$('#collapsefour').removeClass("in");
				
				//$(this).next().addClass("in");
				
				//console.log($(this).next().toggleClass('in'));
				
				setTimeout(function() {
				$('.panel-default').each(function(i){
				if($(this).find('.in').length > 0)
				{
                console.log(i+' testing');
                $(this).find('.icon_show').toggleClass('icon_image_check');
                $(this).find('.star_cls_active').toggleClass('icon_image_active');
                $(this).find('.star_cls').toggleClass('icon_image');
				}
				else {
                $(this).find('.icon_show').removeClass('icon_image_check');
                $(this).find('.star_cls_active').removeClass('icon_image_active');
                $(this).find('.star_cls').addClass('icon_image');
				}
				});
				}, 100);
				
			});*/
			
			function copyLink() {
				var copyText = document.getElementById("recommendurl");
				copyText.select();
				document.execCommand("copy");
				//alert("Copied the text: " + copyText.value);
			}
			
			/*$(document).ready(function(){ 
				$('.drop_rate').click(function() {
					$('#myDropzone').trigger('click');
				});
				$('.drop_rate_review').click(function() {
					$('#myDropzone2').trigger('click');
				});
			});*/
		</script>
		
		
		
	</body>
</html>