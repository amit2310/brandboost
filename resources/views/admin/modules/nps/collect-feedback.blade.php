<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BrandBoost::<?php echo (!empty($oNPS->brand_name)) ? $oNPS->brand_name : '{{BRANDNAME}}'; ?></title>
        <link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>
        <!-- Global stylesheets -->
        <link href="<?php echo base_url(); ?>new_pages/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>new_pages/profile_css/profile.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->
    </head>
    <body>
        <div class="profile_main"> 
            <!--======================profile_header=======================-->
            <div class="profile_header_bkg"></div>
            <div class="page_header">
                <div class="row">
                    <div class="col-md-6"><a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('new_pages/profile_images/logo_icon.png'); ?>" alt="">BrandBoost</a> </div>
                </div>
            </div>
            <!--======================profile_header=======================-->

            <div class="content_area">
                <div class="row">
                    <div class="col-md-12">
                        <div class="white_box text-center profile_sec mb25">

                            <div class="p25 bbot">
                                <div class="profile_avatar"> 
                                    <?php if (!empty($oNPS->brand_logo)): ?>
                                        <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/<?php echo $oNPS->brand_logo; ?>"/> 
                                    <?php else: ?>
                                        <img src="<?php echo base_url(); ?>assets/images/face2.jpg"/>
                                    <?php endif; ?>    


                                </div>
                                <h3><?php echo (!empty($oNPS->brand_name)) ? $oNPS->brand_name : '{{BRANDNAME}}'; ?></h3>
                                <p><?php echo (!empty($oNPS->description)) ? $oNPS->description : '{INTRODUCTION}'; ?></p>
                            </div>
                            <div class="p15">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Tell us why do you want to score <?php echo ($score) ? $score : 0; ?> </h3>
                                    </div>
                                </div>
                            </div>

                            <form name="frmSubmitFeedback" method="post" id="frmSubmitFeedback">
                                <div id="sucessMsg" class="txt_green"></div>
                                <div class="user_sections text-left" style="padding-top:15px;">
                                    <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <div class="">
                                            <input name="feedbackTitle" id="feedbackTitle" class="form-control" type="text" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Write brief details here</label>
                                        <div class="">
                                            <textarea class="form-control" name="feedbackDesc" id="feedbackDesc"  placeholder="Write brief details here" required="required"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group mb0">
                                        <div class=" text-right">
                                            <input type="hidden" name="response_id" value="<?php echo $responseID; ?>" />
                                            <button type="submit" name="btnSubmit" class="btn bkg_blue txt_white">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 text-right"><p>Powered by <a href="<?php echo base_url(); ?>">Brandboost</a></p></div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmSubmitFeedback").submit(function () {
                var formData = new FormData($(this)[0]);
                //$('.overlaynew').show();
                $.ajax({
                    url: '<?php echo base_url('nps/saveFeedback'); ?>',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        //$('.overlaynew').hide();
                        if (data.status == 'success') {
                            $('#feedbackTitle').val('');
                            $('#feedbackDesc').val('');
                            $("#sucessMsg").html("Thank you for your feedback!!");
                        } else {
                            //$('.overlaynew').hide();
                            alert("something went wrong");
                        }
                    }
                });
                return false;
            });
        });
    </script>
</html>	