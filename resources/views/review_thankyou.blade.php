<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="x-apple-disable-message-reformatting">
		<title>Thank You For Reply</title>
		<style>
		@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i');html, body{padding:0;}
		table, td, th{mso-table-lspace:0pt;mso-table-rspace:0pt;font-weight:normal;vertical-align:top;}
		table{border-collapse:collapse;}
		td.large-12.first, th.large-12.first {
		padding-left: 30px;
		}
		td.large-12.last, th.large-12.last {
		padding-right: 30px;
		}
		.img-circle{border-radius:50px;}
		.video {width: 191px;}
		@media screen and (max-width:767px){
			.email-container{width:90%!important;}
			.fluid{margin-left:auto!important;margin-right:auto!important;}
			.stack-column, .stack-column-center{direction:ltr !important;display:block !important;margin-bottom:10px;padding:0 !important;text-align:center !important;width:100% !important;}
			.stack-column-center{text-align:center !important;}
			.wrap{margin-top:0 !important;}
			img{width: auto;height:auto;}
			.blank_td { display: none;}
			.p0{padding: 0 !important;}
			.p15{padding:0 15px !important;}
			.pb{padding-bottom:20px !important}
			.pt{padding-top:20px !important}
		}

		@media screen and (min-device-width:481px) and (max-device-width:767px){
			.col_t_2{padding-left:20px !important;}
		}
		@media only screen and (max-width:480px){
			.col_t_1 img{width:auto!important;margin:0 auto}
			.col_t_1{direction:ltr !important;display:block !important;margin-bottom:10px;padding:0 !important;text-align:center !important;width:100% !important;}
			.col_t_2{direction:ltr !important;display:block !important;margin-bottom:10px;padding:0 !important;text-align:center !important;width:100% !important;}
			.heading { text-align:center!important;}
			.col_t_2 p { text-align:center!important;}
			.main_img{width: 60px;}
			.table_mr{margin-top: -40px !important;}
			.table_main_mr{margin: 100px auto 0 !important;}
			.btn_pd{padding: 10px 15px !important;font-size: 12px !important;}
			.main_txt{font-size: 12px !important; line-height: normal !important;}
			.col_t_3 {font-size: 16px !important;margin: 10px 0 10px !important;}
			.col_t_4 {font-size: 16px !important;margin: 10px 0 10px !important;}
			.p15{padding:0 15px !important;}
			.pb{padding-bottom:20px !important}
			.star{float: none !important;}
			.graph{width: 70% !important;}
		}
		</style>
	</head>
	<body width="100%" height="100%" bgcolor="#f3f3fa" style="margin: 0; mso-line-height-rule: exactly;">
		<center class="wrap" style="width: 100%; text-align:left;">
			<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:20px auto 0;" class="email-container table_main_mr">
				<tr>
					<td>
						<table style="background:#ffffff; border-radius: 5px!important;" bgcolor="#ffffff">
							<tr>
								<td style="padding:0 80px 40px; position: relative; border-bottom: 1px solid #f0f2f8;" class="p0">
									<table style="margin-top:-45px; width: 100%;" class="table_mr">
										<tbody>
											<tr>
												<td>
													<div style="height:100px">&nbsp;</div>
													<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0;" class="col_t_3"><?php echo $title; ?></p>
													<p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #425784; font-family: 'Open Sans', sans-serif; text-align: center;padding: 0 40px;" class="main_txt pb p15"><?php echo $subTitle; ?></p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td style="padding:30px 10px 15px;" class="p0 p15">
									<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
										<tbody>
											<tr>
												<td class="col_t_1" style="width: 100%; padding-bottom:50px;">
													<center><?php echo showUserAvtar($siteReviewDetails->avatar, $siteReviewDetails->firstname, $siteReviewDetails->lastname, 60, 60); ?></center>
													<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:4px 0 2px; font-size: 18px; color:#0c0c2c; font-weight: 600; padding:0px; color: #09204f;"><?php echo $siteReviewDetails->firstname; ?> <?php echo $siteReviewDetails->lastname; ?></p>
													<center>

													<?php for($i = 1; $i <= $siteReviewDetails->ratings; $i++){ ?>
													<img style="margin:4px 4px 0 0;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt="" class="star">
													<?php } ?>

													<?php for($i = 5; $i > $siteReviewDetails->ratings; $i--){ ?>
													<img style="margin:4px 4px 0 0;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt="" class="star">
													<?php } ?>

													<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0 15px; font-size: 16px; color:#0c0c2c; font-weight: 600; padding: 0; display: inline-block;"><?php echo number_format($siteReviewDetails->ratings, 1); ?></p></center>

													<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0; font-size: 14px; color:#425784; font-weight: 500; padding: 0 95px; display: inline-block; line-height: 1.75;" class="p0 main_txt pb"><?php echo $siteReviewDetails->comment_text; ?></p>
												</td>
											</tr>

											<?php
											if(count($reviewDetails) > 0){
												$media_url = '';
												$productImageUrl = displayNoData();
												$reviewimageUrl = '';
												foreach($reviewDetails as $reviewData){
													$mediaArray = unserialize($reviewData->media_url);
													if (!empty($mediaArray)) {
														foreach ($mediaArray as $media) {
															if ($media['media_type'] == 'image') {
																$media_url = $media['media_url'];
																$reviewimageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/".$media_url;
															}
														}
													}

													if($reviewData->product_image != ''){
														$productImageUrl = '<img style="border:0px; margin:0px; border-radius:50px; width:36px; height:36px;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$reviewData->product_image.'" class="box_img pt" width="36px" height="36px" border="0">';
													}
											?>
											<tr>
												<td class="col_t_1" style="width: 100%; padding-bottom:20px;">
													<table width="100%" cellspacing="0" cellpadding="0" border="0">
														<tbody>
															<tr>
																<td class="col_t_1 p15" style="width: 100%;border: 1px solid #f3f3fa; padding:15px; margin:0; box-sizing:border-box;">
																	<table width="100%">
																		<tbody><tr>
																			<td class="col_t_1" style="width:60px;"><?php echo $productImageUrl; ?></td>
																			<td class="col_t_2">
																				<h4 style="line-height: 15px; font-weight: 600; margin: 0px 0 6px 0px; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #353554;"><?php echo $reviewData->product_name; ?></h4>

																				<?php for($i = 1; $i <= $reviewData->ratings; $i++){ ?>
																				<img style="margin:4px 4px 0 0; float: left;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs.png" title="" alt="" class="star">
																				<?php } ?>

																				<?php for($i = 5; $i > $reviewData->ratings; $i--){ ?>
																				<img style="margin:4px 4px 0 0; float: left;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt="" class="star">
																				<?php } ?>

																				<p style="margin: 0; font-family: 'Open Sans', sans-serif; color:#494968; font-size: 12px; font-weight: 600; line-height: 20px; text-align: justify; color: #8787a5;"><?php echo $reviewData->product_created; ?></p>
																			</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
															<tr>
																<td class="col_t_1" style="width: 100%;border: 1px solid #f3f3fa; padding:15px; margin:0;">
																	<table>
																		<tbody>
																			<tr>
																				<?php if($reviewimageUrl != ''){ ?>
																				<td class="col_t_1">
																				<img style="border:0px; margin:0px 0 0" src="<?php echo $reviewimageUrl; ?>" quality="50" crop="yes" alt="" title="" class="box_img pt" width="96px" height="80px" border="0">
																				</td>
																				<td class="blank_td" style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																				<?php } ?>
																				<td class="col_t_2"><p style="line-height: 20px; padding:0; margin: 0; font-size: 13px; font-weight: normal; color: #202040; font-family: 'Open Sans', sans-serif; text-align: left;padding: 0 0px;" class="p15"><?php echo $reviewData->comment_text; ?></p></td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<?php } } ?>

										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<th style="padding:20px 80px 0; border-top: 1px solid #f3f5fa;" class="p0">
									<table style="margin-top: 20px;">
										<tbody>
											<tr>
												<th>
													<p style="line-height: 20px; padding:0; margin: 0 0 25px 0; font-size: 12px; font-weight: normal; color: #98adcf; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">If you don’t know why you got this email, please tell us straight away so we can fix this for you.</p>
													<p style="line-height: 20px; padding:0; margin: 0; font-size: 12px; font-weight: 500; color: #5e729d; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15"> Thanks, Brand Boost Team</p>
												</th>
											</tr>
											<tr>
												<td height="40">&nbsp;</td>
											</tr>
										</tbody>
									</table>
								</th>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th style="padding:0 45px;" class="p0">
						<table style="margin-top: 20px;">
							<tbody>
								<tr>
									<td height="5px">&nbsp;</td>
								</tr>
								<tr>
									<th>
										<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">You can find answers to common questions here. And you can always reach us at <a href="" style="color: #98adcf; text-decoration: none;">support@brandboost.io</a></p>
										<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">BrandBoost Limited is a company registered in England and Wales with registered number 07209813. Our registered office is at 56 Shoreditch High Street, London, E1 6JJ. BrandBoost is an Electronic Money Institution authorised by the Financial Conduct Authority with firm reference 900507.</p>
									</th>
								</tr>
							</tbody>
						</table>
					</th>
				</tr>
			</table>
		</center>
	</body>
</html>
