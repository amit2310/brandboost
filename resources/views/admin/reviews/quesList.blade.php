<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($oCampaign)) {
    //permissions
    $bAllowComments = ($oCampaign->allow_comments == 1) ? true : false;
    $bAllowVideoComments = ($oCampaign->allow_video_reviews == 1) ? true : false;
    $bAllowHelpful = ($oCampaign->allow_helpful_feedback == 1) ? true : false;
    $bAllowLiveReading = ($oCampaign->allow_live_reading_review == 1) ? true : false;
    $bAllowRatings = ($oCampaign->allow_comment_ratings == 1) ? true : false;
    $bAllowCreatedTime = ($oCampaign->allow_review_timestamp == 1) ? true : false;

    //get other settings
    $bgColor = $oCampaign->bg_color;
    $txtColor = $oCampaign->text_color;

    //Total Reviews
    $totalReviews = sizeof($aReviews);

    //pre($aReviews);
    if (!empty($aReviews)) {

        foreach ($aReviews as $arr) {
            $aLatestReview = $arr;
            break;
        }
    }

    //pre($aLatestReview);
}
?>
<style>
    .grey{ color:#ccc!important;}
    .externalpopup_vid{ position:absolute; margin:0;  /*top:30px;*/ bottom:30px;  left:30px; width:400px;}
    .externalpopup_txt{ position:absolute; margin:0; top:30px; bottom:30px;   right:30px; width:400px;}

    .modal-body{ padding:0px;}
    .modal-content{box-shadow:none!important; border:none;}

    /*============video text review=========*/
    .video_review{ width: 100%; margin-bottom: 0px;  border-radius: 6px;  background-color: #ffffff;  /*box-shadow: 0 5px 30px 0 rgba(144, 144, 144, 0.25);*/ padding:10px 15px; min-height:auto; box-shadow:none!important; 	-webkit-box-shadow: 0 5px 40px rgba(0,0,0,.16) !important;
                   box-shadow: 0 5px 40px rgba(0,0,0,.16) !important;
                   border-radius: 8px !important; border:none;}
    .video_review hr{ border-top: 1px solid #e3e3e3; margin:10px 0px;}
    .user_details_box{text-align: left;}
    .user_details_box h5{ font-size: 14px; font-weight: 600; color: #4a90e2; margin:0;}
    .user_details_box h4{ font-size: 15px; font-weight: 600; color: #575757; margin: 0 0 5px;; line-height: 25px;}
    .user_details_box p{margin: 0;}
    .user_details_box p.date{ color: #575757; font-size: 14px; font-weight: 300;}
    .user_details_box p strong{ color: #575757; font-size: 11px; font-weight: 600;}
    .user_details_box hr{margin: 10px 0;}
    .user_details_box .fa{font-size: 19px; color: #cccccc; margin: 0 5px;}
    .user_details_box .fa.yellow{font-size: 19px; color: #f8e71c; margin: 0 5px;}
    .video_review iframe {	height: 165px!important; width:95%; margin-top:20px;}
    .video_review h4.review{margin: 0; font-size: 13px; font-weight: 500;}
    .video_review figure img{ width:100%; max-width:100%;}

    .grey_btn{width: 70px; height: 30px; font-size: 14px; color: #393f54; margin: 10px 5px;}
    .blue_link{margin: 0px 0; display: block; font-size: 15px; font-weight: 500; color: #4a90e2;}

    .cust_review{ width: 100%;  height: 82px;  border-radius: 4px; padding: 10px; font-size: 19px; font-weight: 400; color: #575757;  background-color: #f5f5f5; text-align: left;}
    .cust_review figure{display: inline-block; margin-right: 3%; float: left; width:15%;}
    .cust_review p{display: inline-block; margin: 5px 0 0 0; line-height: 19px; color: #575757; font-size:13px; width:80%; float:left}
    .cust_review p strong{font-size: 12px; font-weight: 400; }

    .video_review input[type=text]{width: 100%;  height: 44px; border: none; color: #0077e6;  border-radius: 4px;  background-color: #f3f9ff; text-align: center; font-size: 14px; font-weight: 200;}

    .text_box{ width:100%;  border-radius: 4px; text-align: left; line-height: 30px;  background-color: #fafcff; padding: 20px; color: #000000; font-size: 20px; font-weight: 200;}

    .review_options{text-align: left; padding-left: 50px;}
    .review_options p{text-align: left; font-size: 14px; color: #494949; font-family: 'Lato', sans-serif; font-weight: 400; margin-bottom: 3px!important}
    .review_options .btn-orange {	border: none !important; width: 100%; max-width: 360px; margin: 0 auto!important; height: 53px;	border-radius: 6px !important;	background: #0077e6 !important;	font-weight: 400; display: block; font-size: 20px;}
    .review_options .btn-orange strong:after{content:"\f067"!important; }
    .review_options .btn-orange span:after{top: 0;}
    .review_options input[type=text]{width: 300px;  height: 32px;  border-radius: 4px; border: 1px solid #359be0; padding: 0 0 0 10px; font-size: 14px; background-color: #ffffff;}
    .review_options textarea{width: 300px;  height: 100px;  border-radius: 4px; border: 1px solid #359be0; padding: 10px; font-size: 14px; background-color: #ffffff;}

    .review_options .switcher{background: #b2b2b2; width: 45px; margin: 5px 0 0; display: block;}
    .review_options .switcher.act{background: #2fd475; width: 45px; margin: 5px 0 0;}
    .review_options .switcher.act .circle{float: right;}

    .disable_txt{ color: #b2b2b2; font-size: 12px; font-weight: bold; font-family: 'Lato', sans-serif;}
    .disable_txt.act{ color: #2fd475;}

    .bkg_y{width: 74px;  height: 36px; display: block;  border-radius: 4px;  background-color: #f5a623;}
    .bkg_g {width: 74px;  height: 36px;display: block;  border-radius: 4px;  background-color: #b8e986;}
    .pl0{ padding-left:0px;}
    .pr0{ padding-right:0px;}
    .mtop10{ margin-top:10px;}
    .mbot10 { margin-bottom:10px;}
    .mbot20 { margin-bottom:20px;}
    .modal-backdrop.in {
        opacity: 0.05 !important;
    }


    .modal.fade .modal-dialog {
        transform: translate3d(0, 100vh, 0)!important;
        transition-duration: 0.5s!important;
    }

    .modal.in .modal-dialog {
        transform: translate3d(0, 0, 0)!important;
        transition-duration: 0.5s !important;
    }

    @media only screen and (max-width:1380px){
        .video_review{ height:550px; overflow:auto;}
    }

</style>  
<?php if ($display == 'true'): ?>
    <section class="top_text price">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert-success" style="margin-bottom:10px;">
                        <?php echo $this->session->flashdata('success_msg'); ?>
                    </div>
                    <div class="alert-danger" style="margin-bottom:10px;">
                        <?php echo $this->session->flashdata('error_msg'); ?>
                    </div>
                    <?php if (!empty($aReviews)): ?>
                        <?php foreach ($aReviews as $aReview): ?>
                                    <div class="video_review" <!--style="background-color: <?php echo $bgColor; ?> !important; color: <?php echo $txtColor; ?> !important;" -->>
                                 <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oCampaign->logo_img; ?>" width="164"/>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <figure><img src="<?php echo base_url(); ?>assets/images/v_user.jpg"/></figure>	
                                    </div>

                                    <div class="col-md-7 user_details_box pl0">
                                        <h5><strong>Verified Buyer</strong></h5>
                                        <h4><?php echo $oCampaign->firstname . ' ' . $oCampaign->lastname; ?></h4>
                                        <?php if ($bAllowCreatedTime): ?>
                                            <p class="date allow_timestamp"><?php echo date('F d, Y', strtotime($aReview['created'])); ?></p>
                                        <?php endif; ?>
                                        <p><strong>Product: <span class="brand_title"><?php echo $oCampaign->brand_title; ?></span></strong></p>
                                        <hr>
                                        <p>
                                            <span class="allow_ratings">
                                                <ul id="stars">
                                                    <?php for ($i = 0; $i < $aReview['ratings']; $i++) { ?>
                                                        <i class="fa fa-star"></i>
                                                    <?php } ?>
                                                    <?php
                                                    if ($i < 5) {
                                                        for ($j = $i; $j < 5; $j++) {
                                                            ?>
                                                            <i class="fa fa-star grey"></i>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </span><?php echo $totalReviews; ?> Customer Reviews</p>
                                    </div>


                                    <div class="col-md-2 text-center">
                                        <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oCampaign->brand_img; ?>" width="65" />
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 mtop30 text-center">
                                        <div class="text_box brand_desc">
                                            <?php
                                            if ($aReview['review_type'] == 'text') {
                                                echo $aReview['comment_text'];
                                            } else if ($aReview['review_type'] == 'video') {
                                                ?>
                                                <video width="400" controls>
                                                    <source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $aReview['comment_video']; ?>" type="video/mp4">
                                                </video>

                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row allow_helpful">
                                    <div class="col-md-12 mtop10 text-center">
                                        <?php if ($bAllowHelpful): ?>
                                            <h4 class="review"><?php echo $aReview['total_helpful']; ?> people found this helpful. Was this review helpful to you?</h4>
                                            <div><button class="btn grey_btn btn-sm">Yes</button> <button class="btn grey_btn btn-sm">No</button></div>
                                        <?php endif; ?>
                                        <a class="blue_link" href="#">See All <?php echo $totalReviews; ?> Customer Reviews</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php if (!empty($aReview['comment_block'])): ?>
                                        <?php foreach ($aReview['comment_block'] as $aComment): ?>
                                            <div class="col-md-12 mtop20">
                                                <div class="cust_review">
                                                    <figure><img src="http://www.freeiconspng.com/uploads/male-icon-19.png" style="width:67px !important;"/></figure>
                                                    <p><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?><br><strong><?php echo $aComment['content']; ?></strong></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>

                                <?php if ($bAllowComments): ?>
                                    <div class="row allow_comment">
                                        <div class="col-md-12 mbot40 mtop20">
                                            <input type="text" name="" placeholder="Write Your Comments Here…" />
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="row">
                                    <?php if ($bAllowLiveReading): ?>
                                        <div class="col-md-6 allow_live_reading">
                                            <p>17 People Currently Watching This Review</p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-6 text-right">
                                        <img src="<?php echo base_url(); ?>assets/images/small_logo.png"/>
                                    </div>
                                </div>



                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                <div class="clearfix"></div>

            </div>


        </div>
    </section>
<?php endif; ?>
<!--================review video popup==============-->
<div id="reviewvidPopup" class="modal fade" role="dialog">
    <div class="modal-dialog externalpopup_vid">
        <div class="modal-content">
            <div class="modal-body">
                <div class="video_review">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img style="width:125px;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oCampaign->logo_img; ?>">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 text-center">
                            <figure><img src="http://www.brandboost.io/1/images/v_user.jpg"></figure>	
                        </div>

                        <div class="col-md-6 user_details_box pl0 pr0">
                            <h5><strong>Verified Buyer</strong></h5>
                            <h4><?php echo $oCampaign->firstname . ' ' . $oCampaign->lastname; ?></h4>
                            <?php if ($bAllowCreatedTime): ?>
                                <p class="date"><?php echo date('F d, Y', strtotime($aLatestReview['created'])); ?></p>
                            <?php endif; ?>
                            <p><strong>Product: <?php echo $oCampaign->brand_title; ?></strong></p>
                            <hr>
                            <p>
                                <span>

                                    <?php for ($i = 0; $i < $aLatestReview['ratings']; $i++) { ?>
                                        <i class="fa yellow fa-star"></i>
                                    <?php } ?>
                                    <?php
                                    if ($i < 5) {
                                        for ($j = $i; $j < 5; $j++) {
                                            ?>
                                            <i class="fa fa-star"></i>
                                            <?php
                                        }
                                    }
                                    ?>

                                </span><br><?php echo $totalReviews; ?> Customer Reviews</p>
                        </div>


                        <div class="col-md-3 text-center">
                            <img style="height:85px;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oCampaign->brand_img; ?>">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 <?php if ($aLatestReview['review_type'] == 'video'): ?>text-center<?php endif; ?>">
                                <!--<iframe src="https://www.youtube-nocookie.com/embed/_BOdEeZmns0" allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"></iframe>-->
                            <?php
                            if ($aLatestReview['review_type'] == 'text') {
                                echo $aLatestReview['comment_text'];
                            } else if ($aLatestReview['review_type'] == 'video') {
                                ?>
                                <video width="400" controls style="width:100%">
                                    <source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $aLatestReview['comment_video']; ?>" type="video/mp4">
                                </video>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php if ($bAllowHelpful): ?>
                        <div class="row">
                            <div class="col-md-12 mtop10 text-center">
                                <h4 class="review"><span id="bbhelpfulcount"><?php echo ($aLatestReview['total_helpful']) ? $aLatestReview['total_helpful'] : 0; ?></span> people found this helpful. Was this review helpful to you?</h4>
                                <div><button class="btn grey_btn btn-sm bbhelpful">Yes</button> <button class="btn grey_btn btn-sm bbhelpful">No</button></div>
                                <a class="blue_link" href="#">See All <?php echo $totalReviews; ?> Customer Reviews</a>
                            </div>
                        </div>
                    <?php endif; ?>


                    <!--************ Ask question ************-->

                    <div class="col-md-12 mtop10 text-center">
                        <a class="blue_link ask_question" style="cursor: pointer;">Ask Question</a>

                        <div class="row" id="askQuesDet" style="display: none;">
                            <form method="post" name="frmques" id="frmques">
                                <div class="col-md-12 mbot20 mtop10">
                                    <input type="hidden" name="campaignID" value="<?php echo $oCampaign->id; ?>" >
                                    <input type="hidden" name="qqrid" id="qqrid" value="<?php echo $aLatestReview['id']; ?>" />
                                    <input type="text" name="campaignQues" placeholder="Write Your Question Here…" required="">
                                </div>
                                <div class="col-md-12 mbot20 mtop10">
                                    <input name="qqname" id="qqname" placeholder="Your Name" type="text" required="">
                                </div>
                                <div class="col-md-12 mbot20 mtop10">
                                    <input name="qqemail" id="qqemail" placeholder="Your Email" type="text" required="">
                                </div>
                                <div class="col-md-12 mbot20 mtop10">
                                    <input type="submit" class="btn grey_btn btn-sm" name="subQues" value="Submit">
                                </div> 
                            </form>    
                        </div>

                    </div>

                    <?php
                    $campId = $oCampaign->id;
                    $revId = $aLatestReview['id'];
                    ?>

                    <!--************** End question *************-->


                    <div class="row">
                        <?php if (!empty($aLatestReview['comment_block'])): ?>
                            <?php foreach ($aLatestReview['comment_block'] as $aComment): ?>
                                <div class="col-md-12 mtop10">
                                    <div class="cust_review">
                                        <figure><img src="http://www.freeiconspng.com/uploads/male-icon-19.png"></figure> 
                                        <p><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?> : <i><?php echo date('F d, Y', strtotime($aComment['created'])); ?></i> <br><strong><?php echo $aComment['content']; ?></strong></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>


                    </div>

                    <?php if ($bAllowComments): ?>
                        <form method="post" name="frmbbcmt" id="frmbbcmt">
                            <input type="hidden" name="bbrid" id="bbrid" value="<?php echo $aLatestReview['id']; ?>" />
                            <div class="row">
                                <div class="col-md-12 mbot20 mtop10">
                                    <input name="bbcmt" id="bbcmt" placeholder="Write Your Comments Here…" type="text">
                                </div>
                                <div class="col-md-12 mbot20 mtop10 cmt-ctr" style="display:none;">
                                    <input name="bbcmtname" id="bbcmtname" placeholder="Your Name" type="text" required="">
                                </div>
                                <div class="col-md-12 mbot20 mtop10 cmt-ctr" style="display:none;">
                                    <input name="bbcmtemail" id="bbcmtemail" placeholder="Your Email" type="text" required="">
                                </div>
                                <div class="col-md-12 mbot20 mtop10 cmt-ctr text-center" style="display:none;">
                                    <input name="bbcmtsubmit" id="bbcmtsubmit" value="Post your comment" type="button">
                                </div>
                                <div class="col-md-12 mbot20 mtop10 cmt-alert" style="display:none;">
                                    <div class="alert alert-success cmt-alert-success-msg"></div>
                                    <div class="alert alert-danger cmt-alert-error-msg"></div>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <p> <?php if ($bAllowLiveReading): ?>
                                    17 People Currently Watching This Review
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <img src="http://www.brandboost.io/1/images/small_logo.png">
                        </div>
                    </div>











                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(window).load(function () {

        $('#reviewvidPopup').modal('show');
        //$('#reviewtxtPopup').modal('show');
    });

    $(".ask_question").click(function () {
        $("#askQuesDet").slideToggle("slow");
    });

    $(document).ready(function () {
        $(".bbhelpful").click(function () {
            var bbhaction = $(this).text();
            var bbrid = $("#bbrid").val();
            $.ajax({
                url: "http://brandboost.io/reviews/saveHelpful/",
                type: "POST",
                data: {bbrid: bbrid, ha: bbhaction},
                dataType: "json",
                success: function (response) {
                    if (response.status == 'ok') {
                        $("#bbhelpfulcount").text(response.yes);
                    }
                },
                error: function (response) {
                    alert(response.msg);
                }
            });

        });


        $("#bbcmt").blur(function () {
            $(".cmt-ctr").show();


        });

        $("#bbcmtsubmit").click(function () {
            $(this).attr("disabled", "disabled");

            var formdata = $("#frmbbcmt").serialize();
            //e.preventDefault();
            // var formdata = $('#logo_img').prop('files')[0];
            //var formdata = new FormData();
            //formdata.append('logo_img', formdata);
            $.ajax({
                url: "<?php echo base_url('reviews/addcomment'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == 'ok') {
                        $(".cmt-alert-success-msg").text(response.msg);
                        $(".cmt-alert, .cmt-alert-success-msg").show();
                        $(".cmt-ctr, .cmt-alert-error-msg").hide();
                    } else {
                        $(".cmt-alert-success-msg").text('');
                        $(".cmt-alert-error-msg").text(response.msg);
                        $(".cmt-alert, .cmt-alert-error-msg").show();
                        $(".cmt-alert-success-msg").hide();
                    }

                },
                error: function (response) {
                    alert(response.msg);
                }
            });

        });


        // -------submit question 

        $("#frmques").submit(function () {

            var formdata = $("#frmques").serialize();

            $.ajax({
                url: "<?php echo base_url('admin/questions/addquestion'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == 'ok') {
                        $(".cmt-alert-success-msg").text(response.msg);
                        $(".cmt-alert, .cmt-alert-success-msg").show();
                        $(".cmt-ctr, .cmt-alert-error-msg").hide();
                    } else {
                        $(".cmt-alert-success-msg").text('');
                        $(".cmt-alert-error-msg").text(response.msg);
                        $(".cmt-alert, .cmt-alert-error-msg").show();
                        $(".cmt-alert-success-msg").hide();
                    }


                },
                error: function (response) {
                    alert(response.msg);
                }
            });
            return false;

        });
    });



</script>

