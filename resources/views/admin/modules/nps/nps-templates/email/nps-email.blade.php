<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="x-apple-disable-message-reformatting">
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
                            @media only screen and (max-width:480px){.col_t_1 img{width:auto!important;margin:0 auto}
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
                            }
                        </style>
                        </head>
                        <body width="100%" height="100%" bgcolor="#f3f3fa" style="margin: 0; mso-line-height-rule: exactly;">
                            <center class="wrap" style="width: 100%; text-align:left;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:100px auto 0;" class="email-container table_main_mr">
                                    <tr>
                                        <td>
                                            <table style="background:#fff; box-shadow:0px 0px 8px;">
                                                <tr>
                                                    <th style="padding:20px 80px 0px;" class="pb"> 
                                                        <table width="100%" class="table_mr">
                                                            <tbody>
                                                                <tr>
                                                                    <th> 
                                                                        <center><div style="width: 100px;height: 100px;padding: 8px;border-radius: 100px;background-color: #fafafd; box-sizing: border-box; margin: 0 auto;"><img style="width: 100px; height: 100px; border-radius: 100px;<?php if (!$oNPS->display_logo): ?>display:none;<?php endif; ?>" src="@{{BRAND_LOGO}}" class="logo_img" /></div></center>

                                                                        <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0;" class="col_t_3 p15" id="wf_edit_template_greeting">{GREETING}</p>
                                                                        <p style="text-align: center; font-weight: 400; font-size: 20px; color: @{{INTRODUCTION_TEXT_COLOR}}; margin: 0; font-family: arial;"><span class="introductionText" <?php if (!$oNPS->display_intro): ?>style="display:none;"<?php endif; ?> id="wf_edit_template_introduction">@{{INTRODUCTION}} </span></p>
                                                                    </th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="padding:20px 80px 0;" class=""> 
                                                        <table style="margin-top: 20px;">
                                                            <tbody>
                                                                <tr>
                                                                    <div style="width: 485px;height: auto; font-family: arial; margin: 25px auto; border-radius: 5px; border: 1px solid #eee; box-shadow: 0 10px 20px 0 rgba(12, 12, 44, 0.05), 0 2px 2px 0 rgba(0, 0, 0, 0.03); background: #ffffff;">

                                                                        <div style="text-align: center; padding: 20px 50px 20px; margin-bottom: 0px; width: 100%;border-radius: 5px 5px 0 0;background-color: #ffffff;position: relative; box-sizing: border-box;">
                                                                            <p  style="font-weight: bold; font-size: 16px; color: @{{TEXT_COLOR}}; margin-bottom: 15px; font-family: arial;<?php if (!$oNPS->display_additional): ?>display:none;<?php endif; ?>" class="questionEamilText">@{{QUESTION}}</p>

                                                                        </div>
                                                                        <div style="margin: 0px; text-align: center; width: 100%;padding: 20px;border-radius:0 0 5px 5px;background-color: #ffffff;position: relative; box-sizing: border-box; border-top: 1px solid #eee;">
                                                                            <ul style="margin: 0 auto; padding: 0; width: 265px;">
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a  class="buttonStyle"style=" text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=1">1</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=2">2</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style=" text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=3">3</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=4">4</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=5">5</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=6">6</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=7">7</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=8">8</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=9">9</a></li>
                                                                                <li style="margin: 0; padding: 0; display: inline-block; list-style: none; float: left;"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: @{{BUTTON_SHAPE}};background: @{{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: @{{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px; border-radius: 100px;" href="@{{RATE_LINK}}?s=10">10</a></li>
                                                                                <div style="clear: both;"></div>
                                                                            </ul>
                                                                        </div>
                                                                    </div>	
                                                                </tr>
                                                                <tr>
                                                                    <td height="40">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="padding:20px 80px 0; border-top: 1px solid #f3f5fa;" class=""> <table style="margin-top: 20px;">
                                                            <tbody>
                                                                <tr>
                                                                    <th> 
                                                                        <p style="line-height: 20px; padding:0; margin: 0 0 25px 0; font-size: 12px; font-weight: normal; color: #727291; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">If you don’t know why you got this email, please tell us straight away so we can fix this for you.</p>
                                                                        <p style="line-height: 20px; padding:0; margin: 0; font-size: 12px; font-weight: normal; color: #494968; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">Thanks,</p>
                                                                        <p style="line-height: 20px; padding:0; margin: 0; font-size: 12px; font-weight: 600; color: #494968; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;" class="p15">BrandBoost Team</p>
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

                                </table>
                            </center>
                        </body>
                        </html>














