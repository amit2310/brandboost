<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($oCampaign)) {
    //permissions
    $bAllowComments = ($oCampaign->preview_allow_comments == 1) ? true : false;
    $bAllowVideoComments = ($oCampaign->preview_allow_video_reviews == 1) ? true : false;
    $bAllowHelpful = ($oCampaign->preview_allow_helpful_feedback == 1) ? true : false;
    $bAllowLiveReading = ($oCampaign->preview_allow_live_reading_review == 1) ? true : false;
    $bAllowRatings = ($oCampaign->preview_allow_comment_ratings == 1) ? true : false;
    $bAllowCreatedTime = ($oCampaign->preview_allow_review_timestamp == 1) ? true : false;
    $bAllowProsCons = ($oCampaign->preview_allow_pros_cons == 1) ? true : false;

    //get other settings
    $bgColor = $oCampaign->preview_bg_color;
    $txtColor = $oCampaign->preview_text_color;

    //Total Reviews
    $totalReviews = (sizeof($aReviews) > 0) ? sizeof($aReviews) : 0;
	
	$bgColor = $bgColor == '' ? '#000000' : $bgColor;
	$txtColor = $txtColor == '' ? '#FFFFFF' : $txtColor;

    //pre($aReviews);
    if (!empty($aReviews)) {

        foreach ($aReviews as $arr) {
            $aLatestReview = $arr;
            break;
        }
    }

    //pre($aLatestReview);
}

if (empty($totalReviews)) {
    die();
}
?>
<style>
    .bb-center {
        width:100%;
        text-align:center;
    }
    .bb-inline-helpful {
        padding:5px;
    }
	.bb_video_review a, .bb_video_review .txtcolor{color:<?php echo $txtColor; ?>!important;}

</style>
<div class="bb-loaded">&nbsp;</div>
<?php if ($displayType == 'popup'): ?>
    <!--================review video popup==============-->

    <div class="bb_video_review bkgcolor txtcolor" style="background:<?php echo $bgColor; ?>;">
        <div class="shortreview">
            <div class="top_logo text-center"> <img style="width:125px;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oCampaign->logo_img; ?>">
                <hr>
            </div>
        </div>
        <div style="cursor:pointer;" title="Click To Expand" class="shortreview">
            <div class="w25 text-center"> 
                <?php if (empty($oCampaign->avatar)): ?>
                    <img class="round" src="http://brandboost.io/1/images/v_user.jpg">
                <?php else: ?>
                    <img class="round" src="http://brandboost.io/profile_images/<?php echo $oCampaign->avatar; ?>">
                <?php endif; ?>

            </div>
            <div class="w75 user_details_box pl0 pr0">
                <h5 class="txtcolor"><strong>Verified Buyer</strong></h5>
                <h4 class="txtcolor"><?php echo $oCampaign->firstname . ' ' . $oCampaign->lastname; ?> just left a review for brandboost.io…</h4>
            </div>
        </div>


        <div class="fullreview shortreview" >
            <div class="row ">
                <div class="w100">
                    <hr>
                </div>
                <div class="w25 text-center"> <img style="height:85px;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oCampaign->brand_img; ?>"> </div>
                <div class="w75 user_details_box pl0 pr0">
                    <p class="date txtcolor"><?php echo date('F d, Y', strtotime($aLatestReview['created'])); ?></p>
                    <p class="txtcolor"><strong class="txtcolor">Product: <?php echo $oCampaign->brand_title; ?></strong></p>
                    <p><span>
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
                        </span><br>
                        <?php echo $totalReviews; ?> Customer Reviews</p>
                </div>
            </div>
            <div class="row">
                <div class="w100 <?php if ($aLatestReview['review_type'] == 'video'): ?>text-center<?php endif; ?>">
    <!--                <iframe src="https://www.youtube-nocookie.com/embed/_BOdEeZmns0" allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"></iframe>-->
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
                    <div class="w100 mtop10 text-center">
                        <h4 class="review"> <span id="bbhelpfulcount"><?php echo ($aLatestReview['total_helpful']) ? $aLatestReview['total_helpful'] : 0; ?></span> people found this helpful. Was this review helpful to you?</h4>
                        <div>
                            <button class="grey_btn helpful-action" action-name="Yes" bb-review-id="<?php echo $aLatestReview['id']; ?>">Yes</button>
                            <button class="grey_btn helpful-action" action-name="No" bb-review-id="<?php echo $aLatestReview['id']; ?>">No</button> 
                        </div>
                        <a class="blue_link txtcolor" href="#">See All <?php echo $totalReviews; ?> Customer Reviews</a> </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php if (!empty($aLatestReview['comment_block'])): ?>
                    <?php foreach ($aLatestReview['comment_block'] as $aComment):
                        $getUserDetail = getUserDetail($aComment['user_id']);
                        ?>
                        <div class="w100 mtop10">
                            <div class="cust_review">
                                <figure><img src="<?php echo 'http://brandboost.io/profile_images/' . $getUserDetail->avatar; ?>"></figure>
                                <p><strong><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?> : <i><?php echo date('F d, Y', strtotime($aComment['created'])); ?></strong><br>
            <?php echo $aComment['content']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
    <?php endif; ?>       

            </div>
    <?php if ($bAllowComments): ?>

                <div class="row">
                    <input type="hidden" name="bb-review-id" id="bb-review-id" value="<?php echo $aLatestReview['id']; ?>" >
                    <div class="w100 mbot20 mtop10">
                        <input name="bbcmt" class="bbcmt" id="bbcmt" placeholder="Write Your Comments Here…" type="text">
                    </div>
                    <div class="w100 mbot20 mtop10 cmt-ctr bb-hidden">
                        <input name="bbcmtname" id="bbcmtname" placeholder="Your Name" type="text" required="">
                    </div>
                    <div class="w100 mbot20 mtop10 cmt-ctr bb-hidden">
                        <input name="bbcmtemail" id="bbcmtemail" placeholder="Your Email" type="text" required="">
                    </div>
                    <div class="w100 mbot20 mtop10 cmt-ctr text-center bb-hidden">
                        <input class="bbcmtsubmit" name="bbcmtsubmit" id="bbcmtsubmit" value="Post your comment" type="button">
                    </div>
                    <div class="w100 mbot20 mtop10 cmt-alert">
                        <div class="w100 alert alert-success bb-popup-cmt-alert-success-msg bb-hidden">Thank you for posting your comment. Your review was sent successfully and is now waiting to publish it.</div>
                        <div class="w100 alert alert-danger bb-popup-cmt-alert-error-msg bb-hidden">Error while posting your comment. Try again</div>
                    </div>
                </div>
    <?php endif; ?>
        </div>


        <div class="row shortreview">
            <div class="">
                <hr>
            </div>
            <div class="w50">
                <p class="foot_txt"> 
                    <?php if ($bAllowLiveReading): ?>
                        17 People Currently Watching This Review
    <?php endif; ?>
                </p>
            </div>
            <div class="w50 text-right mtop10"> <a target="_blank" href="http://brandboost.io"><img  style="width: 150px;" src="http://brandboost.io/1/images/small_logo.png"></a> </div>
        </div>
        <div class="clearfix"></div>
    </div>
<?php endif; ?>




<!--===================slide reviews=======================-->
<?php if ($displayType == 'testimonial' && $totalReviews>=3): ?>
    <div class="bb_slides">
        <div class="bb_slides_inner y-slide-left-animations" bb_total_slides="<?php echo sizeof($aReviews);?>">
            <!--inner slide box-->
            <?php
            if (!empty($aReviews)) {
                $z = 0;
                foreach ($aReviews as $aReview) {
                    $z++;
                    ?>
            <div class="bb_slides_box" >
                <div class="bb_slides_image"><img src="square.png"></div>
                <div class="bb_slides_text">
                    <p>
                        <?php for ($i = 0; $i < $aReview['ratings']; $i++) { ?>
                                    <i class="fa green fa-star"></i>
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

                        <span><?php echo date('F d, Y', strtotime($aReview['created'])); ?></span></p>
                    <h4><?php echo $aReview['review_title']; ?></h4>
                    <p><span><?php
                                    if ($aReview['review_type'] == 'text') {
                                        echo $aReview['comment_text'];
                                    } else if ($aReview['review_type'] == 'video') {
                                        ?>
                                        <video width="250" controls style="width:100%">
                                            <source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $aReview['comment_video']; ?>" type="video/mp4">
                                        </video>

                <?php
            }
            ?></span></p>
                    <p><a class="green" href="#">Read More...</a></p>
                    <p><strong><?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?></strong></p>
                </div>
            </div>
            
            <?php }
    }
    ?>
            
            
            <div class="bb_slides_arrow"><a class="bb_slides_btn" bb_direction="left" href="#"><i class="fa fa-angle-left"></i></a> <a class="bb_slides_btn" bb_direction="right" href="#"><i class="fa fa-angle-right"></i></a><a class="bb_slides_review_count" href="#"><?php echo $totalReviews . " Reviews"; ?></a></div>

            <div class="clearfix"></div>
        </div>


    </div>
<?php endif; ?>

<!-- Inline Reviews -->

<?php if ($displayType == 'inline'): ?>

    <div class="bb_txt_inner">
        <div class="bb_txt_head">
            <h3>Reviews</h3>
            <p><i class="fa green fa-star"></i> <i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i> &nbsp; &nbsp; <span><?php echo $totalReviews; ?> Reviews</span> </p>
        </div>

        <p class="green"><strong>Reviews (<?php echo $totalReviews; ?>)</strong></p>

        <?php
        if (!empty($aReviews)) {
            $z = 0;
            foreach ($aReviews as $aReview) {
                $z++;
                $viewAllReviewsLink = ($totalReviews > 10) ? "<a href='http://brandboost.io/reviews/lists/'" . $campaignID . " target='_blank'>View All Reviews</a>" : '';
                if ($z < 11) {
                    ?>

                    <div class="bb_txt_user">
                        <p><strong><?php echo $aReview['firstname'] . ' ' . $aReview['lastname']; ?></strong> <span>Verified Buyer</span></p>
                        <p>
                            <?php for ($i = 0; $i < $aReview['ratings']; $i++) { ?>
                                <i class="fa green fa-star"></i>
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
                        </p>

                        <div class="bb_txt_user_rev">
                            <p class=""><strong> <?php echo $aReview['review_title']; ?> </strong><br>
                            <div class="clearfix"></div>
                            <span> 
                                <?php
                                if ($aReview['review_type'] == 'text') {
                                    echo $aReview['comment_text'];
                                } else if ($aReview['review_type'] == 'video') {
                                    ?>
                                    <video width="350" class="bb_inline_vid" controls style="max-width:350px;">
                                        <source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $aReview['comment_video']; ?>" type="video/mp4">
                                    </video>

                                    <?php
                                }
                                ?>
                            </span>
                            </p>
                        </div>

                <?php if (!empty($bAllowProsCons)) { ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6"><strong>Pros</strong>
                                        <?php
                                        $pros = explode(',', $aReview['pro_review']);
                                        foreach ($pros as $value) {
                                            echo "<p>" . $value . "</p>";
                                        }
                                        ?></div>
                                    <div class="col-md-6" ><strong>Cons</strong>
                                        <?php
                                        $cons = explode(',', $aReview['cons_review']);
                                        foreach ($cons as $value) {
                                            echo "<p>" . $value . "</p>";
                                        }
                                        ?></div>
                                </div>
                            </div>
                <?php } ?>

                        <div class="bb_date_help bb_inline_helpfull_yesno">
                            <p><?php echo date('F d, Y', strtotime($aReview['created'])); ?></p>
                            <p>Was this review helpful?  
                                <span class="fa fa-hand-o-up bb-inline-helpful" action-name="Yes" bb-review-id="<?php echo $aReview['id']; ?>"> <?php echo ($aReview['total_helpful']) ? $aReview['total_helpful'] : 0; ?> </span>

                                <span class="fa fa-hand-o-down bb-inline-helpful" action-name="No" bb-review-id="<?php echo $aReview['id']; ?>"> 0 </span>
                            </p>
                        </div>
                    </div>

                    <?php
                }
            }
        }

        if (!empty($viewAllReviewsLink)) {
            echo '<p class="bb-center"><strong>' . $viewAllReviewsLink . '</strong></p> ';
        }
        ?>



        <div class="clearfix"></div>
    </div>

<?php endif; ?>






