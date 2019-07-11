<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- Copyright © 2013-2018 Delighted, LLC All rights reserved. -->
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="address=no" name="format-detection" />
        <title><?php echo (!empty($oNPS->brand_name)) ? $oNPS->brand_name : '{{BRANDNAME}}'; ?></title>
        <script type="text/javascript" src="<?php echo site_url("assets/js/core/libraries/jquery.min.js"); ?>"></script>

        <style type="text/css">* {
                text-rendering: optimizelegibility;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale
            }

            .b-nps .b1-nps td:active {
                background: #e3e3e3 !important;
                border-top-width: 3px !important;
                border-bottom-width: 1px !important;
                border-bottom-color: #cccccc !important;
                border-top-color: #cccccc !important;
                box-shadow: rgba(255, 255, 255, 0.9) 0 1px 0 0 !important
            } 

            .b-stars-five .b1-stars-five td:active {
                background: #e3e3e3 !important;
                border-top-width: 3px !important;
                border-bottom-width: 1px !important;
                border-bottom-color: #cccccc !important;
                border-top-color: #cccccc !important;
                box-shadow: rgba(255, 255, 255, 0.9) 0 1px 0 0 !important
            }

            .b-ces .b1-ces td:active {
                background: #e3e3e3 !important;
                border-top-width: 3px !important;
                border-bottom-width: 1px !important;
                border-bottom-color: #cccccc !important;
                border-top-color: #cccccc !important;
                box-shadow: rgba(255, 255, 255, 0.9) 0 1px 0 0 !important
            }

            .b-csat .b1-csat td:active {
                background: #e3e3e3 !important;
                border-top-width: 3px !important;
                border-bottom-width: 1px !important;
                border-bottom-color: #cccccc !important;
                border-top-color: #cccccc !important;
                box-shadow: rgba(255, 255, 255, 0.9) 0 1px 0 0 !important
            }

            #outlook a {
                padding: 0
            }

            .ExternalClass {
                width: 100%
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 24px
            }

            @media screen and (max-width:480px) {
                .i-nps {
                    width: 100% !important;
                    min-width: 0 !important;
                    margin: 0 !important
                }
                .i-stars-five {
                    width: 100% !important;
                    min-width: 0 !important;
                    margin: 0 !important
                }
                .i-ces {
                    width: 100% !important;
                    min-width: 0 !important;
                    margin: 0 !important
                }
                .i-csat {
                    width: 100% !important;
                    min-width: 0 !important;
                    margin: 0 !important
                }
                .l12 {
                    width: 70px !important;
                    height: 70px !important
                }
                .q {
                    padding-left: 10px !important;
                    padding-right: 10px !important
                }
                .n1 {
                    padding-left: 20px !important;
                    padding-right: 20px !important
                }
                .n2 {
                    font-size: 16px !important
                }
                .q1 {
                    width: 100% !important
                }
                .q11 {
                    font-size: 18px !important;
                    line-height: 26px !important;
                    font-weight: bold !important
                }
                .h {
                    display: none !important
                }
                .b-nps {
                    padding-left: 10px !important;
                    padding-bottom: 4px !important;
                    padding-right: 10px !important
                }
                .b1-nps {
                    width: 100% !important;
                    padding-bottom: 6px !important
                }
                .b-stars-five {
                    padding-left: 10px !important;
                    padding-bottom: 4px !important;
                    padding-right: 10px !important
                }
                .b1-stars-five {
                    width: 100% !important;
                    padding-bottom: 6px !important
                }
                .b-ces {
                    padding-left: 10px !important;
                    padding-bottom: 4px !important;
                    padding-right: 10px !important
                }
                .b1-ces {
                    width: 100% !important;
                    padding-bottom: 6px !important
                }
                .b-csat {
                    padding-left: 10px !important;
                    padding-bottom: 4px !important;
                    padding-right: 10px !important
                }
                .b1-csat {
                    width: 100% !important;
                    padding-bottom: 6px !important
                }
                .b2 {
                    display: none !important;
                    height: 0 !important;
                    position: absolute !important;
                    left: -9999px !important
                }
                .bl {
                    display: inherit !important;
                    visibility: inherit !important;
                    overflow: inherit !important;
                    line-height: inherit !important;
                    font-size: inherit !important
                }
                .f1 {
                    padding-left: 10px !important
                }
                .f2 {
                    padding-right: 10px !important
                }
                .b-nps .b1-nps td:active {
                    background-color: #ffffff !important;
                    border-top-width: 1px !important;
                    border-bottom-width: 3px !important;
                    box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px 0 !important
                }
                .b-stars-five .b1-stars-five td:active {
                    background-color: #ffffff !important;
                    border-top-width: 1px !important;
                    border-bottom-width: 3px !important;
                    box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px 0 !important
                }
                .b-ces .b1-ces td:active {
                    background-color: #ffffff !important;
                    border-top-width: 1px !important;
                    border-bottom-width: 3px !important;
                    box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px 0 !important
                }
                .b-csat .b1-csat td:active {
                    background-color: #ffffff !important;
                    border-top-width: 1px !important;
                    border-bottom-width: 3px !important;
                    box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px 0 !important
                }
                #wrapper,
                .w {
                    min-width: 100vw !important
                }
                .y {
                    font-size: 0 !important;
                    width: 0 !important;
                    overflow: hidden !important;
                    white-space: normal !important
                }
            }

        </style>
        <!--[if gte mso 9]>
        <style type='text/css'>table,
  tbody,
  tr,
  td {
          border-collapse: collapse !important;
          mso-table-lspace: 0 !important;
          mso-table-rspace: 0 !important
  }

  .b2 {
          width: 3px !important
  }

  .b1-nps {
          width: 43px !important
  }

  .b2 {
          width: 3px !important
  }

  .b1-stars-five {
          width: 43px !important
  }

  .b2 {
          width: 3px !important
  }

  .b1-ces {
          width: 43px !important
  }

  .b2 {
          width: 3px !important
  }

  .b1-csat {
          width: 43px !important
  }

  </style>
        <![endif]-->
        <style>
            html, body {
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
        </style>
    </head>
    <body style="width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0">
        <table border="0" cellpadding="0" cellspacing="0" class="w" style="width:100% !important;line-height:24px !important;margin:0;padding:0" width="100%">
            <tr>
                <td align="center" class="l1" dir="ltr" valign="middle" style="border-bottom-width:1px;border-bottom-style:none;border-bottom-color:#e3e3e3;border-top-width:6px;border-top-style:solid;border-top-color:#F40460;background-color:#ffffff;height:46px;padding:29px 0" bgcolor="#ffffff" height="46"><img alt="" class="l12" height="80" src="https://dcx14qs33eg2z.cloudfront.net/uploads/production/logos/8f7065a8-637b-43bb-853c-2444d5266bf6/resized_066ef83.jpg" width="80" style="outline:0;text-decoration:none;-ms-interpolation-mode:bicubic;display:block;line-height:40px;font-size:24px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold;color:#0F0F0D;text-align:center" />
                </td>
            </tr>
            <tr>
                <td align="center" class="n1" style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#e3e3e3;padding-bottom:29px">
                    <table border="0" cellpadding="0" cellspacing="0" class="i-nps" style="width:534px;min-width:534px;margin:0 23px" width="534">
                        <tr>
                            <td align="center" class="n11" dir="ltr" style="font-size:18px;line-height:26px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;color:#777777;text-align:center">
                                <?php echo (!empty($oNPS->description)) ? $oNPS->description : '{INTRODUCTION}'; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" class="l2" style="background-color:#f6f6f6" bgcolor="#f6f6f6" id="feedbackContainer">
                    <form name="frmSubmitFeedback" method="post" id="frmSubmitFeedback">
                        <input type="hidden" name="response_id" value="<?php echo $responseID; ?>" />
                        <table border="0" cellpadding="0" cellspacing="0" class="i-nps" style="width:534px;min-width:534px;margin:0 23px" width="534">
                            <tr>
                                <td align="center" class="b-nps">
                                    <h2 style="color:#777777;">Tell us why do you want to score <?php echo ($score) ? $score : 0; ?> </h2>
                                    
                                    <p>
                                    <input type="text" style="width:300px;" name="feedbackTitle" id="feedbackTitle" placeholder="Title" required="required" />
                                    </p>
                                    <p>
                                        <textarea style="width:300px;"  name="feedbackDesc" rows="10" cols="50" placeholder="Write brief details here" required="required"></textarea>
                                    </p>
                                    <p>
                                        <button type="submit" name="btnSubmit">Submit</button> 
                                    </p>


                                </td>
                            </tr>



                        </table>
                    </form>
                </td>
            </tr>
            <tr>
                <td align="center" class="f" style="border-top-width:1px;border-top-style:solid;border-top-color:#e3e3e3;height:46px;background-color:#ffffff" bgcolor="#ffffff" height="46">
                    <table border="0" cellpadding="0" cellspacing="0" class="i-nps" style="width:534px;min-width:534px;margin:0 23px" width="534">
                        <tr>
                            <td align="right" class="f2" dir="ltr" valign="middle" style="height:48px;font-size:14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;color:#cccccc;width:60%;text-align:right" width="60%" height="48">Powered by&nbsp;<a href="http://brandboost.io" style="color:#cccccc">Brandboost</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="display:none;white-space:nowrap;font:15px courier;line-height:0" class="y">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
    </body>
    <script>
        $(document).ready(function () {
            $("#frmSubmitFeedback").submit(function () {
                var formData = new FormData($(this)[0]);
                $('.overlaynew').show();
                $.ajax({
                    url: '<?php echo base_url('nps/saveFeedback'); ?>',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        $('.overlaynew').hide();
                        if (data.status == 'success') {
                            $("#feedbackContainer").html("<h3>Thank you for your feedback!!</h3>");
                            
                            
                        } else {
                            $('.overlaynew').hide();
                            alert("something went wrong");
                        }
                    }
                });
                return false;
            });



        });
    </script>
</html>
