<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="x-apple-disable-message-reformatting">
<title>Thank You For Replay</title>
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

@media screen and (min-device-width:481px) and (max-device-width:767px){.col_t_2{padding-left:20px !important;}
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
<?php 
switch($feedbackType){
	
	case 'Positive':
	?>
		<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:160px auto 0;" class="email-container table_main_mr">
		<tr>
		<td>
		<table style="background:#fff; border-radius: 5px!important;">
		<tr>
		<td style="padding:0 80px 40px; position: relative; border-bottom: 1px solid #f0f2f8;" class="p0">
		<table style="margin-top:-45px; width: 100%;" class="table_mr">
		<tbody>
		<tr>
		<td> 
		<center><img style="margin:5px auto 15px;" src="<?php echo base_url(); ?>assets/images/emailer/email_smiley_green.png" title="" alt="" class="main_img" width="80" height="80"></center>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0;" class="col_t_3"><?php echo $title; ?></p>
		<p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #425784; font-family: 'Open Sans', sans-serif; text-align: center;padding: 0 40px;" class="main_txt pb p15"><?php echo $subTitle; ?></p>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		<tr>
		<td style="padding:30px 10px 35px;" class="p0 p15">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
		<tbody>
		<tr>
		<td class="col_t_1" style="width: 100%;">
		
		<center><img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/email_user_01.png" title="" alt=""></center>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:4px 0 2px; font-size: 14px; color:#0c0c2c; font-weight: 600; padding: 0; color: #09204f;"><?php echo $subscriber_name; ?></p>
		
		<center>
		
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px 5px 0px 0;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0 15px; font-size: 16px; color:#0c0c2c; font-weight: 600; padding: 0; display: inline-block;"><?php echo $rating_value; ?></p>
		
		</center>
		
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0; font-size: 14px; color:#425784; font-weight: 500; padding: 0 95px; display: inline-block; line-height: 1.75;" class="p0 main_txt pb"><?php echo $feedback; ?></p>
		</td>
		</tr>
		</tbody></table></td>
		</tr>
		<tr>
		<th style="padding:20px 80px 0; border-top: 1px solid #f3f5fa;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<th> 
		<p style="line-height: 20px; padding:0; margin: 0 0 25px 0; font-size: 12px; font-weight: normal; color: #98adcf; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">If you don't know why you got this email, please tell us straight away so we can fix this for you.</p>
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
		<th style="padding:0 45px;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<td height="5px">&nbsp;</td>
		</tr>
		<tr>
		<th>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">You can find answers to common questions here. And you can always reach us at <a href="" style="color: #98adcf; text-decoration: none;">support@brandboost.io</a></p>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">BrandBoost Limited is a company registered in England and Wales with registered number 07209813. Our registered office is at 56 Shore ditch High Street, London, E1 6JJ. BrandBoost is an Electronic Money Institution authorized by the Financial Conduct Authority with firm reference 900507.</p>
		</th>
		</tr>
		</tbody>
		</table>
		</th>
		</tr>
		</table>
	<?php
	break;
	
	case 'Neutral':
	?>
		<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:160px auto 0;" class="email-container table_main_mr">
		<tr>
		<td>
		<table style="background:#fff; border-radius: 5px!important;">
		<tr>
		<td style="padding:0 80px 40px; position: relative; border-bottom: 1px solid #f0f2f8;" class="p0">
		<table style="margin-top:-45px; width: 100%;" class="table_mr">
		<tbody>
		<tr>
		<td> 
		<center><img style="margin:5px auto 15px;" src="<?php echo base_url(); ?>assets/images/emailer/email_smiley_yellow.png" title="" alt="" class="main_img" width="80" height="80"></center>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0;" class="col_t_3"><?php echo $title; ?></p>
		<p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #425784; font-family: 'Open Sans', sans-serif; text-align: center;padding: 0 40px;" class="main_txt pb p15"><?php echo $subTitle; ?></p>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		<tr>
		<td style="padding:30px 10px 35px;" class="p0 p15">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
		<tbody>
		<tr>
		<td class="col_t_1" style="width: 100%;">
		<center><img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/email_user_01.png" title="" alt=""></center>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:4px 0 2px; font-size: 14px; color:#0c0c2c; font-weight: 600; padding: 0; color: #09204f;"><?php echo $subscriber_name; ?></p>
		<center>
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
		<img style="margin:10px 5px 0px 0;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
		
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0 15px; font-size: 16px; color:#0c0c2c; font-weight: 600; padding: 0; display: inline-block;"><?php echo $rating_value; ?></p></center>
		
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0; font-size: 14px; color:#425784; font-weight: 500; padding: 0 95px; display: inline-block; line-height: 1.75;" class="p0 main_txt pb"><?php echo $feedback; ?></p>
		</td>
		</tr>
		</tbody></table></td>
		</tr>
		<tr>
		<th style="padding:20px 80px 0; border-top: 1px solid #f3f5fa;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<th> 
		<p style="line-height: 20px; padding:0; margin: 0 0 25px 0; font-size: 12px; font-weight: normal; color: #98adcf; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">If you don't know why you got this email, please tell us straight away so we can fix this for you.</p>
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
		<th style="padding:0 45px;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<td height="5px">&nbsp;</td>
		</tr>
		<tr>
		<th>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">You can find answers to common questions here. And you can always reach us at <a href="" style="color: #98adcf; text-decoration: none;">support@brandboost.io</a></p>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">BrandBoost Limited is a company registered in England and Wales with registered number 07209813. Our registered office is at 56 Shore ditch High Street, London, E1 6JJ. BrandBoost is an Electronic Money Institution authorized by the Financial Conduct Authority with firm reference 900507.</p>
		</th>
		</tr>
		</tbody>
		</table>
		</th>
		</tr>
		</table>
	<?php
	break;
	
	case 'Negative':
	?>
		<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:160px auto 0;" class="email-container table_main_mr">
		<tr>
		<td>
		<table style="background:#fff; border-radius: 5px!important;">
		<tr>
		<td style="padding:0 80px 40px; position: relative; border-bottom: 1px solid #f0f2f8; text-align: center;" class="p0">
		<table style="margin-top:-45px; width: 100%;" class="table_mr">
		<tbody>
		<tr>
		<td> 
		<center><img style="margin:5px auto 15px;" src="<?php echo base_url(); ?>assets/images/emailer/email_smiley_red.png" title="" alt="" class="main_img" width="80" height="80"></center>
		<p style="font-family: 'Open Sans', sans-serif; line-height: 30px; text-align: center; margin:10px 0 15px; font-size: 20px; color:#09204f; font-weight: 600; padding: 0;" class="col_t_3"><?php echo $title; ?></p>
		<p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #425784; font-family: 'Open Sans', sans-serif; text-align: center;padding: 0 40px;" class="main_txt pb p15"><?php echo $subTitle; ?></p>
		<a style="display: inline-block; margin: 20px auto 0;" href="#"><img src="<?php echo base_url(); ?>assets/images/emailer/add_feedback_btn.png"/></a>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		<tr>
		<td style="padding:30px 10px 35px;" class="p0 p15">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
		<tbody>
		<tr>
		<td class="col_t_1" style="width: 100%;">
		<center><img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/email_user_01.png" title="" alt=""></center>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:4px 0 2px; font-size: 14px; color:#0c0c2c; font-weight: 600; padding: 0; color: #09204f;"><?php echo $subscriber_name; ?></p>
		<center>
			<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
			<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
			<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
			<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
			<img style="margin:10px 5px 0px 0;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
			
			<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0 15px; font-size: 16px; color:#0c0c2c; font-weight: 600; padding: 0; display: inline-block;"><?php echo $rating_value; ?></p>
		</center>
		
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0; font-size: 14px; color:#425784; font-weight: 500; padding: 0 95px; display: inline-block; line-height: 1.75;" class="p0 main_txt pb"><?php echo $feedback; ?></p>
		
		</td>
		</tr>
		</tbody></table></td>
		</tr>
		<tr>
		<th style="padding:20px 80px 0; border-top: 1px solid #f3f5fa;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<th>
		<p style="line-height: 20px; padding:0; margin: 0 0 25px 0; font-size: 12px; font-weight: normal; color: #98adcf; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">If you don't know why you got this email, please tell us straight away so we can fix this for you.</p>
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
		<th style="padding:0 45px;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<td height="5px">&nbsp;</td>
		</tr>
		<tr>
		<th>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">You can find answers to common questions here. And you can always reach us at <a href="" style="color: #98adcf; text-decoration: none;">support@brandboost.io</a></p>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">BrandBoost Limited is a company registered in England and Wales with registered number 07209813. Our registered office is at 56 Shore ditch High Street, London, E1 6JJ. BrandBoost is an Electronic Money Institution authorized by the Financial Conduct Authority with firm reference 900507.</p>
		</th>
		</tr>
		</tbody>
		</table>
		</th>
		</tr>
		</table>
	<?php
	break;
	
	case 'default':
	?>
		<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:160px auto 0;" class="email-container table_main_mr">
		<tr>
		<td>
		<table style="background:#fff; border-radius: 5px!important;">
		<tr>
		<td style="padding:0 80px 40px; position: relative; border-bottom: 1px solid #f0f2f8; text-align: center;" class="p0">
		<table style="margin-top:-45px; width: 100%;" class="table_mr">
		<tbody>
		<tr>
		<td> 
		<center><img style="margin:5px auto 15px;" src="<?php echo base_url(); ?>assets/images/emailer/email_smiley_red.png" title="" alt="" class="main_img" width="80" height="80"></center>
		<p style="font-family: 'Open Sans', sans-serif; line-height: 30px; text-align: center; margin:10px 0 15px; font-size: 20px; color:#09204f; font-weight: 600; padding: 0;" class="col_t_3"><?php echo $title; ?></p>
		<p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #425784; font-family: 'Open Sans', sans-serif; text-align: center;padding: 0 40px;" class="main_txt pb p15"><?php echo $subTitle; ?></p>
		<a style="display: inline-block; margin: 20px auto 0;" href="#"><img src="<?php echo base_url(); ?>assets/images/emailer/add_feedback_btn.png"/></a>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		<tr>
		<td style="padding:30px 10px 35px;" class="p0 p15">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
		<tbody>
		<tr>
		<td class="col_t_1" style="width: 100%;">
		<center><img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/email_user_01.png" title="" alt=""></center>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:4px 0 2px; font-size: 14px; color:#0c0c2c; font-weight: 600; padding: 0; color: #09204f;"><?php echo $subscriber_name; ?></p>
		<center>
		
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/yellow-star.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
		<img style="margin:10px auto 0px;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
		<img style="margin:10px 5px 0px 0;" src="<?php echo base_url(); ?>assets/images/emailer/star-xs-grey.png" title="" alt=""> 
		
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0 15px; font-size: 16px; color:#0c0c2c; font-weight: 600; padding: 0; display: inline-block;"><?php echo $rating_value; ?></p></center>
		
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:0px 0; font-size: 14px; color:#425784; font-weight: 500; padding: 0 95px; display: inline-block; line-height: 1.75;" class="p0 main_txt pb"><?php echo $feedback; ?></p>
		</td>
		</tr>
		</tbody></table></td>
		</tr>
		<tr>
		<th style="padding:20px 80px 0; border-top: 1px solid #f3f5fa;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<th>
		<p style="line-height: 20px; padding:0; margin: 0 0 25px 0; font-size: 12px; font-weight: normal; color: #98adcf; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">If you don't know why you got this email, please tell us straight away so we can fix this for you.</p>
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
		<th style="padding:0 45px;" class="p0"> <table style="margin-top: 20px;">
		<tbody>
		<tr>
		<td height="5px">&nbsp;</td>
		</tr>
		<tr>
		<th>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">You can find answers to common questions here. And you can always reach us at <a href="" style="color: #98adcf; text-decoration: none;">support@brandboost.io</a></p>
		<p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 12px; color:#98adcf; font-weight: normal; padding: 0 30px; line-height: 18px;" class="p15">BrandBoost Limited is a company registered in England and Wales with registered number 07209813. Our registered office is at 56 Shore ditch High Street, London, E1 6JJ. BrandBoost is an Electronic Money Institution authorized by the Financial Conduct Authority with firm reference 900507.</p>
		</th>
		</tr>
		</tbody>
		</table>
		</th>
		</tr>
		</table>
	<?php
	break;
}
?>

		</center>
		</body>
		</html>