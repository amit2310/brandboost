<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BrandBoost::Resolution</title>
        <link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">

        <!-- Global stylesheets -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url("assets/css/icons/icomoon/styles.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/core.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/components.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/colors.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/theme1.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <style>
            .star {cursor: pointer;}
            .dark_btn:hover{
                color: #fff!important;
                text-decoration: none;
            }
        </style>
        <script src="<?php echo base_url("assets/js/core/libraries/jquery.min.js"); ?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/core/libraries/bootstrap.min.js"); ?>"></script>


    </head>


    <body>

        <div class="review_request_sec">

            <div class="review_header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <a class="fsize17 fw500 txt_white" href="<?php echo base_url(); ?>"><img src="<?php echo base_url("assets/images/logo_icon_bb.png"); ?>" width="28" alt=""></a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="fsize12 txt_white">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>


            <?php //if ($ratingsType = 'star') ; ?>
            <div class="container">
                <form method="post" id="resolutionFrm" name="resolutionFrm" class="form-horizontal" action="javascript:void();">
                    <div class="review_main_box_new">
                        <div class="review_top_icon"><img width="74" src="<?php echo base_url("assets/images/review/review_smiley_icon.png"); ?>"/></div>
                        <h2>We're very upset you are unhappy.<br>How we can help you?</h2>
                        <p>Give us feedback how we can improve<br> our product and service.</p>

                        <div class="review_feedback text-left mt30">
                            <p class="txt_dark mb10 fw500">Title</p>
                            <input  type="text" name="resolutionText" id="resolutionText" class="form-control" placeholder="Give title to your feedback" required="required" />
                        </div>

                        <div class="review_feedback text-left mt30">
                            <p class="txt_dark mb10 fw500">Your feedback</p>
                            <textarea name="resolutionText" id="resolutionText" class="form-control" placeholder="Tell you what you thought of their service…" required="required"></textarea>
                        </div>
                        <div class="review_button mt30 text-left">
                            <input type="hidden" name="clientId" id="clientId" value="<?php echo $clientId; ?>">
                            <input type="hidden" name="subscriberId" id="subscriberId" value="<?php echo $subscriberId; ?>">
                            <input type="hidden" name="bbID" id="bbID" value="<?php echo $brandboost_id; ?>">
                            <input type="hidden" name="redirect" id="redirectURL" value="<?php echo $redirect; ?>">
                            <?php if ($ratingsType == 'star'): ?>
                                <input type="hidden" value="4" id="ratingValue" name="ratingValue">
                            <?php endif; ?>
                            <button type="submit" class="btn dark_btn bkg_blue_light h52 mr10 sh_no">Send feedback <i class="icon-paperplane"></i></button>
                            <a href="<?php echo base_url('feedback/thankyou/?'.$getParam);?>" class="btn light_btn bkg_grey_light h52 ml10 txt_dark sh_no pt20" data-dismiss="modal">Skip <i class="icon-arrow-right13"></i></a>
                        </div>
                    </div>

                </form>
            </div>

        </div>

        

        <script>
            $(document).ready(function () {
                
                $("#resolutionFrm").submit(function () {
                    var formdata = $("#resolutionFrm").serialize();
                    <?php if ($ratingsType == "happy"): ?>
                        var cat = 'Negative';

                    <?php elseif ($ratingsType == "star"): ?>
                        var iRatings = $("#ratingValue").val();
                        if (iRatings == '1' || iRatings == '2') {
                            var cat = "Negative";
                        } else if (iRatings == '3') {
                            var cat = "Neutral";
                        } else if (iRatings >= '4') {
                            var cat = "Positive";
                        } else {
                            var cat = "Neutral";
                        }

                    <?php endif; ?>
                    $.ajax({
                        url: "<?php echo base_url('feedback/saveResolution'); ?>",
                        type: "POST",
                        data: formdata + "&category=" + cat+"&_token={{csrf_token()}}",
                        dataType: "json",
                        success: function (response) {
                            if (response.status == "success") {
                                window.location.href = '<?php echo base_url('feedback/thankyou/?'.$getParam);?>';
                            }
                        },
                        error: function (response) {
                            alert(response.message);
                        }
                    });
                    return false;
                });
            });
        </script>



    </body>
</html>