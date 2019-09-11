<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Emailer</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i');

        html, body {
            padding: 0;
        }

        table, td, th {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            font-weight: normal;
            vertical-align: top;
        }

        table {
            border-collapse: collapse;
        }

        td.large-12.first, th.large-12.first {
            padding-left: 30px;
        }

        td.large-12.last, th.large-12.last {
            padding-right: 30px;
        }

        .video {
            width: 191px;
        }

        @media screen and (max-width: 767px) {
            .email-container {
                width: 100% !important;
            }

            .fluid {
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .stack-column, .stack-column-center {
                direction: ltr !important;
                display: block !important;
                margin-bottom: 10px;
                padding: 0 !important;
                text-align: center !important;
                width: 100% !important;
            }

            .stack-column-center {
                text-align: center !important;
            }

            .wrap {
                margin-top: 0 !important;
            }

            img {
                width: 100%;
                height: auto;
            }

            .blank_td {
                display: none;
            }
        }

        @media screen and (min-device-width: 481px) and (max-device-width: 767px) {
            .col_t_2 {
                padding-left: 20px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            .col_t_1 img {
                width: auto !important;
                margin: 0 auto
            }

            .col_t_1 {
                direction: ltr !important;
                display: block !important;
                margin-bottom: 10px;
                padding: 0 !important;
                text-align: center !important;
                width: 100% !important;
            }

            .col_t_2 {
                direction: ltr !important;
                display: block !important;
                margin-bottom: 10px;
                padding: 0 !important;
                text-align: center !important;
                width: 100% !important;
            }

            .heading {
                text-align: center !important;
            }

            .col_t_2 p {
                text-align: center !important;
            }
        }
    </style>
</head>
<body width="100%" height="100%" bgcolor="#f3f3fa" style="margin: 0; mso-line-height-rule: exactly;">
<center class="wrap" style="width: 100%; text-align:left;">

    <!-- Email Body : BEGIN -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600"
           style="margin:160px auto 0;" class="email-container">
        <tr>
            <td>
                <table style="background:#ffff">
                    <!---second box--->
                    <tr>
                        <th style="padding:0 80px 40px;">
                            <table style="margin-top:-60px;">
                                <tbody>
                                <tr>
                                    <th>
                                        <center><img style="margin:5px auto 15px;"
                                                     src="{{ base_url() }}assets/images/emailer/password.png" title=""
                                                     alt=""></center>
                                        <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0 50px;">
                                            Reset your password</p>
                                        <p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #494968; font-family: 'Open Sans', sans-serif; text-align: center;padding: 0 20px;">
                                            You're receiving this e-mail because you requested a password reset for your
                                            BrandBoost account. Please tap the button below to choose a new
                                            password.</p>
                                        @php
                                        $base_64 = base64_url_encode($userDetail->id);
                                        $url_param = rtrim($base_64, '=');
                                        @endphp
                                        <center><a href="{{ base_url('admin/reset_password/'.$url_param) }}"
                                                   title="RE-SUBSCRIBE NOW"
                                                   style="margin: 20px 0 0; text-decoration: none; font-family: 'Open Sans', sans-serif; background-color: #6d41f2; display: inline-block; padding:16px 30px; border-radius: 4px; font-size: 14px; color: #FFFFFF; text-align: center;">Reset
                                                password</a></center>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </th>
                    </tr>
                    <!---second box--->


                    <!---fifth box-->
                    <tr>
                        <th style="padding:20px 80px 0; border-top: 1px solid #f3f5fa;">
                            <table style="margin-top: 20px;">
                                <tbody>
                                <tr>
                                    <th>

                                        <p style="line-height: 20px; padding:0; margin: 0 0 25px 0; font-size: 12px; font-weight: normal; color: #727291; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;">
                                            If you don’t know why you got this email, please tell us straight away so we
                                            can fix this for you.</p>

                                        <p style="line-height: 20px; padding:0; margin: 0; font-size: 12px; font-weight: normal; color: #494968; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;">
                                            Thanks,</p>

                                        <p style="line-height: 20px; padding:0; margin: 0; font-size: 12px; font-weight: 600; color: #494968; font-family: 'Open Sans', sans-serif; text-align: center; padding: 0 60px;">
                                            BrandBoost Team</p>

                                    </th>
                                </tr>

                                <tr>
                                    <td height="40">&nbsp;</td>
                                </tr>
                                </tbody>
                            </table>
                        </th>
                    </tr>
                    <!---fifth box-->
                </table>
            </td>
        </tr>


        <!-----footer------->

        <tr>
            <th style="padding:0 80px;">
                <table style="margin-top: 20px;">
                    <tbody>
                    <tr>
                        <td height="5px">&nbsp;</td>
                    </tr>
                    <tr>
                        <th>

                            <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 10px; color:#8787a5; font-weight: normal; padding: 0 30px; line-height: 16px;">
                                You can find answers to common questions here. And you can always reach us at <a href=""
                                                                                                                 style="color: #8787a5; text-decoration: none;">support@brandboost.io</a>
                            </p>
                            <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 10px; color:#8787a5; font-weight: normal; padding: 0 30px; line-height: 16px;">
                                BrandBoost Limited is a company registered in England and Wales with registered number
                                07209813. Our registered office is at 56 Shoreditch High Street, London, E1 6JJ.
                                BrandBoost is an Electronic Money Institution authorised by the Financial Conduct
                                Authority with firm reference 900507.</p>


                        </th>
                    </tr>


                    </tbody>
                </table>
            </th>
        </tr>

        <!-----footer----->


    </table>
    <!-- Email Body : END -->

</center>

</body>
</html>
