<!DOCTYPE html>
<html>
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
            @media screen and (max-width:767px){.email-container{width:100%!important;}
                                                .fluid{margin-left:auto!important;margin-right:auto!important;}
                                                .stack-column, .stack-column-center{direction:ltr !important;display:block !important;margin-bottom:10px;padding:0 !important;text-align:center !important;width:100% !important;}
                                                .stack-column-center{text-align:center !important;}
                                                .wrap{margin-top:0 !important;}
                                                img{width:100%;height:auto;}
                                                .blank_td { display: none;}
            }

            @media screen and (min-device-width:481px) and (max-device-width:767px){.col_t_2{padding-left:20px !important;}
            }
            @media only screen and (max-width:480px){.col_t_1 img{width:auto!important;margin:0 auto}
                                                     .col_t_1{direction:ltr !important;display:block !important;margin-bottom:10px;padding:0 !important;text-align:center !important;width:100% !important;}
                                                     .col_t_2{direction:ltr !important;display:block !important;margin-bottom:10px;padding:0 !important;text-align:center !important;width:100% !important;}
                                                     .heading { text-align:center!important;}
                                                     .col_t_2 p { text-align:center!important;}
            }
        </style>
    </head>
    <body width="100%" height="100%" bgcolor="#f3f3fa" style="margin: 0; mso-line-height-rule: exactly;">
    <center class="wrap" style="width: 100%; text-align:left;">

        <!-- Email Body : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td>
                    <table style="background:#ffff;border-radius: 5px;">
                        <!--header---->
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <img style="margin: 0; padding: 0; width:100%;" alt="" title="" src="{{ base_url() }}assets/images/emailer/emailer-3-header.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!--header---->

                        <!---second box--->
                        <tr>
                            <th style="padding:0 80px;"> <table style="margin-top: -60px;">
                                    <tbody>
                                        <tr>
                                            <th> 
                                    <center>
                                        <img style="margin:5px auto 15px;width:100px;height:105px;" src="{BRAND_LOGO}" title="" alt="">
                                    </center>
                                    <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0px;min-width:450px;" id="wf_edit_template_greeting">
                                        {GREETING}
                                    </p>
                                    <p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #494968; font-family: 'Open Sans', sans-serif; text-align: center;" id="wf_edit_template_introduction">
                                        {INTRODUCTION}
                                    </p>
                                    <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin: 50px 0 30px; font-size: 12px; color: #9b9bb9; font-weight: 600; text-transform: uppercase;">
                                        Rating you experience
                                    </p>  
                                    <center>

                                        <a href="{OFFSITE_REVIEW_URL}&r=1"><img style="margin:0 20px 0 0;" src="{{ base_url() }}assets/images/emailer/star.png" title="" alt=""> </a>
                                        <a href="{OFFSITE_REVIEW_URL}&r=2"><img style="margin:0 20px 0 0;" src="{{ base_url() }}assets/images/emailer/star.png" title="" alt=""> </a>
                                        <a href="{OFFSITE_REVIEW_URL}&r=3"><img style="margin:0 20px 0 0;" src="{{ base_url() }}assets/images/emailer/star.png" title="" alt=""> </a>
                                        <a href="{OFFSITE_REVIEW_URL}&r=4"><img style="margin:0 20px 0 0;" src="{{ base_url() }}assets/images/emailer/star.png" title="" alt=""> </a> 
                                        <a href="{OFFSITE_REVIEW_URL}&r=5"><img style="margin:0 0 0 0;" src="{{ base_url() }}assets/images/emailer/star.png" title="" alt=""> </a>
                                    </center> 
                                    <center>
                                        <a href="{OFFSITE_REVIEW_URL}" title="Leave your feedback" style="margin:35px 0 0; text-decoration: none; font-family: 'Open Sans', sans-serif; background-color: #6d41f2; display: inline-block; padding:16px 20px; border-radius: 4px; font-size: 14px; color: #FFFFFF; text-align: center;"><img src="{{ base_url() }}assets/images/emailer/feedback-icon.png" style="margin-right: 8px; float: left;margin-top: 2px;">
                                            Leave your feedback
                                        </a>
                                    </center>
                            </th>
                        </tr>
                        <tr>
                            <td height="45">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    </th>
            </tr>
            <!---second box--->
        </table>
    </td>
</tr>





<tr>
    <td>
        <table style="background:#ffff; margin-top: 10px; border-radius: 5px;">
            <!---first box--->
            <tr>
                <th style="padding:20px 100px;"> <table style="margin-top: 20px;">
                        <tbody>
                            <tr>
                                <td> 

                                    <p style="line-height: 25px; padding:0; margin: 0; font-size: 12px; font-weight: normal; color: #5e5e7c; font-family: 'Open Sans', sans-serif; text-align: center;">
                                        Whatever you have to say, positive or negative, will help Brandboost to deliver the best possible service and show other customers how they perform. All your responses will be made available publicly on the {BRAND_NAME} website. You can choose to make this review anonymous so that only {BRAND_NAME} will know who you are.
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <table width="100%;">
                                        <tbody>
                                            <tr>
                                                <td style="padding:0 105px 32px 105px;"> 
                                                    <table style="margin-top: 20px; width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td> 
                                                                    <p style="font-family: 'Open Sans', sans-serif; text-align: left; margin:0px 0 10px; font-size: 12px; color:#494968; font-weight: normal; padding: 0 10px;"><img style="margin: 5px 15px 0px 0; float: left" src="{{ base_url() }}assets/images/emailer/emailer-1-signature.jpg" title="" alt="">Many thanks,<br><span style="font-family: 'Open Sans', sans-serif; text-align: left; margin:30px 0 0px; font-size: 12px; color:#494968; font-weight: 600; padding:0px;">{BRAND_NAME}</span></p>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </th>
            </tr>
            <!---first box--->
        </table>
    </td>
</tr>

<tr>
    <td>
        <table width="100%;">
            <tbody>
                <tr>
                    <td> 
                        <table style="margin-top: -14px; width: 100%;">
                            <tbody>
                                <tr>
                                    <td> 
                                        <img src="{{ base_url() }}assets/images/emailer/border-btm.jpg">    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody></table>
    </td>
</tr>


<tr>
    <td height="50px">&nbsp;</td>
</tr>

<!-----footer----->


</table>
<!-- Email Body : END -->

</center>

</body>
</html>