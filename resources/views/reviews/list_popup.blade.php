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
    $bAllowProsCons = ($oCampaign->allow_pros_cons == 1) ? true : false;
    $bAllowBranding = ($oCampaign->allow_branding == 1) ? true : false;
    $headerFixColor = ($oCampaign->header_color_fix == 1) ? true : false;
    $headerSolidColor = ($oCampaign->header_color_solid == 1) ? true : false;
    $headerCustomColor = ($oCampaign->header_color_custom == 1) ? true : false;
    $commentWL = '110';
    $bgClassName = '';
    if ($headerFixColor) {
        $bgClassName = $oCampaign->header_color . '_preview_1';
        $textClassName = $oCampaign->header_color . '_text_color';
    }

    //get other settings
    $bgColor = $oCampaign->bg_color;
    $txtColor = $oCampaign->text_color;

    //Total Reviews
    $totalReviews = (sizeof($allReviews) > 0) ? sizeof($allReviews) : 0;
    $totalRatings = 0;
    if (!empty($allReviews)) {
        foreach ($allReviews as $arr) {
            $arr = (array) $arr;
            $totalRatings = $totalRatings + $arr['ratings'];
        }
    }
    $avgRatings = $totalRatings / $totalReviews;
}

if (empty($totalReviews)) {
    die();
}

/* if (!empty($aLatestReview['media_url'])) {
  if (strpos($aLatestReview['media_url'], '.mp4') !== false) {
  $mediaType = 'video';
  } else {
  $mediaType = 'image';
  }
  } else {
  $mediaType = '';
  } */
?>
<link href="<?php echo base_url(); ?>new_pages/assets/css/fonts/inter-ui.css" rel="stylesheet" type="text/css">
<style>
    <!-- .bbpw_vpw_review_btn{position: fixed!important;left: -58px;width: 125px!important;padding: 0 15px!important;top: 50%!important;margin-top: -20px; text-align:center!important; z-index:9999;} -->

    <?php
    if ($headerSolidColor) {
        $solidColor = $oCampaign->header_solid_color;
        echo '.bbSolidColor{background: ' . $solidColor . '!important;}';
        echo '.textSolidColor{color: ' . $solidColor . '!important;}';
        $bgClassName = 'bbSolidColor';
        $textClassName = 'textSolidColor';
    }

    if ($headerCustomColor) {
        $gradientColor1 = $oCampaign->header_custom_color1;
        $gradientColor2 = $oCampaign->header_custom_color2;
        echo '.bbGradientColor{background-image: linear-gradient(45deg, ' . $gradientColor1 . ' 1%, ' . $gradientColor2 . ')!important;}';
        echo '.textSolidColor{color: ' . $gradientColor2 . '!important;}';
        $bgClassName = 'bbGradientColor';
        $textClassName = 'textSolidColor';
    }
    ?>
</style>
<div class="bb-loaded">&nbsp;</div>
<div class="bbw_section_007">
    <!-- ================ start center popup widget area ============== -->
    <?php if ($oCampaign->widget_type == 'cpw'): ?>
        <div class="review_sec" id="bb_cpw_section">
            <div class="review_chat4">
                <div class="head <?php echo $bgClassName; ?>">
                    <div class="box_right">
                        <div class="client_review"> <span>Real Reviews from Real Customers that we Love</span> </div>
                    </div>
                </div>
                <div class="second_box">
                    <div class="top_header">
                        <div class="rating">
                            <div class="left">
                                <span><?php echo number_format($avgRatings, 2); ?></span>
                                <?php for ($i = 0; $i < number_format($avgRatings, 0); $i++) { ?>
                                    <img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png">
                                <?php } ?>
                                <?php
                                if ($i < 5) {
                                    for ($j = $i; $j < 5; $j++) {
                                        ?>
                                        <img src="<?php echo base_url(); ?>assets/images/widget/dgrey_white_icon.png">
                                        <?php
                                    }
                                }
                                ?>
                                <p><a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">View all <?php echo $totalReviews; ?> reviews</a></p></div><!--left--->

                            <div class="right"><a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png">Ask a Question</a> <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/widget/smile-icon.png">Add review</a></div>
                        </div>
                    </div><!---top_header--->

                    <div class="review_all">
                        <a href="javascript:void(0);">Product Reviews (<?php echo $totalReviews; ?>)</a>
                        <a href="javascript:void(0);">Site Reviews (0)</a>
                        <a href="javascript:void(0);">Service Reviews (0)</a>
                    </div>


                    <div class="middle">
                        <?php
                        $count = 0;
                        foreach ($aReviews as $reviewData) {
                            $profileImg = $reviewData['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $reviewData['user_data']['avatar'];

                            $reviewImg = '';
                            $videoURL = '';
                            $commentWL = '180';

                            $brandImgArray = unserialize($reviewData['media_url']);

                            if (sizeof($brandImgArray) > 0 && $reviewData['media_url'] != '' && $brandImgArray[0]['media_url'] != '' && $brandImgArray[0]['media_type'] == 'image'):
                                $reviewImg = '<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] . '" alt="">';

                                foreach ($brandImgArray as $imageData) {
                                    if ($imageData['media_type'] == 'video' && ($bAllowVideoComments)) {
                                        $videoURL = '<video style="width:100%; height:auto; margin-top:15px; border-radius:5px;" controls><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $imageData['media_url'] . '" type="video/mp4">Your browser does not support the video tag.</video>';
                                        break;
                                    }
                                }
                            endif;
                            ?>

                            <div class="box_1">
                                <div class="top_div">
                                    <div class="left"><a class="icons" href="javascript:void(0);"><img src="<?php echo $profileImg; ?>" onerror="this.src='<?php echo base_url('assets/images/userp.png'); ?>'" class="img-circle img-xs" alt=""></a></div>
                                    <div class="right">
                                        <div class="client_n"><p><?php echo $reviewData['allow_show_name'] != 1 ? 'Anonymous' : $reviewData['firstname'] . ' ' . $reviewData['lastname']; ?> <span><?php echo $oCampaign->brand_title; ?></span></p></div>

                                        <div class="client_review">
                                            <?php if ($bAllowRatings): ?>
                                                <?php for ($i = 0; $i < $reviewData['ratings']; $i++) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/widget/dgrey_icon.png">
                                                <?php } ?>
                                                <?php
                                                if ($i < 5) {
                                                    for ($j = $i; $j < 5; $j++) {
                                                        ?>
                                                        <img src="<?php echo base_url(); ?>assets/images/widget/dgrey_white_icon.png">
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <?php endif; ?>
                                            <?php if ($bAllowCreatedTime): ?>
                                                <span><?php echo date('d M. Y', strtotime($reviewData['created'])); ?></span>
                                            <?php endif; ?>
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>

                                <div class="bottom_div">
                                    <?php echo $videoURL; ?>
                                    <div <?php echo $reviewImg != '' ? 'style="float:left; width:125px;"' : ''; ?> class="bbpw_review_img_box"><?php echo $reviewImg; ?></div>
                                    <div <?php echo $reviewImg != '' ? 'style="float:left; width:350px;"' : ''; ?> class="bbpw_review_msg_box"><p><?php echo setStringLimit($reviewData['comment_text'], $commentWL); ?></p>
                                        <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">Read more</a></div>
                                    <div class="bbpw_clear"></div>
                                </div>

                                <div class="footer_div">
                                    <div class="comment_div">
                                        <p>
                                            <?php if ($bAllowComments): ?>
                                                <img src="<?php echo base_url(); ?>assets/images/widget/comment_icon.jpg">
                                                <a class="bbpw_comment_counter" class-position="<?php echo $count; ?>" style="cursor:pointer;"><?php echo sizeof($reviewData['comment_block']); ?> Comments </a>
                                            <?php endif; ?>
                                <!-- <span><?php echo number_format($reviewData['ratings'], 1); ?> Out of 5 Stars</span> -->
                                            <?php if ($bAllowHelpful): ?><span class="bb_review_helpful" <?php if (!$bAllowComments): ?>style="margin-left: 0px; padding-left: 0px; border-left:none;"<?php endif; ?>><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?> Found this helpful</span><?php endif; ?>
                                        </p>
                                    </div>
                                    <?php if ($bAllowHelpful): ?>
                                        <div class="liked_icon">
                                                <!-- <div class="likes_val_box"><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?></div> -->
                                            <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/like_icon.jpg" class="bbpw_helpful_action bb_show_like_value" class-position="<?php echo $count; ?>" action-name="Yes" bb-review-id="<?php echo $reviewData['id']; ?>"> 
                                            <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/dislike_icon.jpg" class="bbpw_helpful_action bb_show_dis_like_value" class-position="<?php echo $count; ?>" action-name="No" bb-review-id="<?php echo $reviewData['id']; ?>">
                                            <!-- <div class="dislikes_val_box"><?php echo ($reviewData['total_helpful_no']) ? $reviewData['total_helpful_no'] : 0; ?></div> -->
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="bbpw_comment_box">
                                    <?php if ($bAllowComments): ?>
                                        <?php if (!empty($reviewData['comment_block'])): ?>
                                            <?php
                                            foreach ($reviewData['comment_block'] as $aComment):
                                                $getUserDetail = getUserDetail($aComment['user_id']);
                                                ?>
                                                <div class="bb_comment_row">
                                                    <p><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
                                                    <p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="bb_comment_row" style="border:none;">
                                                <p><span><a style="text-decoration:none;" href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">View all comments</a></span></p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="bbpw_success_message">
                                            <div class="alert-success bb-popup-cmt-alert-success-msg bb-hidden">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
                                            <div class="alert-danger bb-popup-cmt-alert-error-msg bb-hidden">OPPS! Error while posting your comment. Try again!</div>
                                        </div>
                                        <div class="comment_form">
                                            <div class="bb_overlay"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
                                            <div class="form-group">
                                                <div class="">
                                                    <input name="bbcmtname" placeholder="Your Name" class="form-control bbcmtname" required="" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="">
                                                    <input name="bbcmtemail" placeholder="Your Email" class="form-control bbcmtemail" required="" type="text">
                                                </div>
                                            </div>
                                            <div class="panel-body br0">
                                                <textarea class="form-control addnote bbcmt" name="bbcmt" placeholder="Write Your Comments Here…"></textarea>
                                            </div>
                                            <div class="s_comment">
                                                <input type="hidden" name="bb-review-id" class="bb-review-id" value="<?php echo $reviewData['id']; ?>" >
                                                <button type="submit" class="bbcmtsubmit" name="bbcmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div><!--box_1--->
                            <?php
                            $count++;
                        }
                        ?>
                        <?php if ($bAllowLiveReading): ?>
                            <div style="background:#fbfdfe; padding:15px; float:left; width: 100%; box-sizing: border-box; text-align: center; color: #494968"><strong><?php echo $widgetCRU; ?> </strong> people<?php echo $widgetCRU > 1 ? 's' : ''; ?> currently reading.</div>
                        <?php endif; ?>
                    </div>

                    <?php if ($bAllowBranding): ?>
                        <div style="background:#eee; padding:15px;float: left;width: 100%;box-sizing: border-box;text-align: right; color: #494968; border-top:1px solid #ccc;">Powered by: <strong><a href="<?php echo base_url(); ?>" target="_blank" style="color: #494968; text-decoration:none;">Brandboost.io</a> </strong></div>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div>
                <div class="star_bottom bbcpw_close_btn" style="cursor:pointer;"><img src="<?php echo base_url(); ?>assets/images/widget/cross-icon.png"></div>
            </div>
        </div>
    <?php endif; ?>
    <!-- ================ end center popup widget area ============== -->


    <!-- ================ start vertical popup widget area ============== -->
    <?php if ($oCampaign->widget_type == 'vpw'): ?>
        <div class="review_chat3">
            <div id="bbpw_vpwSection">
                <div class="head <?php echo $bgClassName; ?>">
                    <div class="box_right">
                        <div class="client_review">
                            <?php for ($i = 0; $i < number_format($avgRatings, 0); $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                            <?php
                            if ($i < 5) {
                                for ($j = $i; $j < 5; $j++) {
                                    ?>
                                    <i class="fa fa-star <?php echo $textClassName; ?>"></i>
                                    <?php
                                }
                            }
                            ?>
                            <span><?php echo number_format($avgRatings, 2); ?></span> <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank"><span class="re_client">View all <?php echo $totalReviews; ?> reviews</span></a>
                        </div>
                    </div>
                </div>
                <div class="second_box">
                    <div class="middle">
                        <?php
                        $count = 0;
                        foreach ($aReviews as $reviewData) {
                            $profileImg = $reviewData['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $reviewData['user_data']['avatar'];

                            $reviewImg = '';
                            $videoURL = '';

                            $brandImgArray = unserialize($reviewData['media_url']);
                            $commentWL = '170';

                            if (sizeof($brandImgArray) > 0 && $reviewData['media_url'] != '' && $brandImgArray[0]['media_url'] != '' && $brandImgArray[0]['media_type'] == 'image'):
                                $reviewImg = '<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] . '" alt="">';
                                $commentWL = '100';

                                foreach ($brandImgArray as $imageData) {
                                    if ($imageData['media_type'] == 'video' && ($bAllowVideoComments)) {
                                        $videoURL = '<video style="width:100%; height:auto; margin-top:15px; border-radius:5px;" controls><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $imageData['media_url'] . '" type="video/mp4">Your browser does not support the video tag.</video>';
                                        break;
                                    }
                                }
                            endif;
                            ?>
                            <div class="box_1">
                                <div class="top_div">
                                    <div class="left"><a class="icons" href="javascript:void(0);"><img src="<?php echo $profileImg; ?>" onerror="this.src='<?php echo base_url('assets/images/userp.png'); ?>'" class="img-circle img-xs" alt=""></a></div>
                                    <div class="right">
                                        <div class="client_n"><p><?php echo $reviewData['allow_show_name'] != 1 ? 'Anonymous' : $reviewData['firstname'] . ' ' . $reviewData['lastname']; ?> <span><?php echo $oCampaign->brand_title; ?></span></p></div>

                                        <div class="client_review">
                                            <?php if ($bAllowRatings): ?>
                                                <?php for ($i = 0; $i < $reviewData['ratings']; $i++) { ?>
                                                    <i class="fa fa-star <?php echo $textClassName; ?>"></i>
                                                <?php } ?>
                                                <?php
                                                if ($i < 5) {
                                                    for ($j = $i; $j < 5; $j++) {
                                                        ?>
                                                        <i class="fa fa-star gray_star"></i>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <?php endif; ?>
                                            <?php if ($bAllowCreatedTime): ?>
                                                <span><?php echo date('d M. Y', strtotime($reviewData['created'])); ?></span>
                                            <?php endif; ?>
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>

                                <div class="bottom_div">
                                    <?php echo $videoURL; ?>
                                    <div <?php echo $reviewImg != '' ? 'style="float:left; width:90px;"' : ''; ?> class="bbpw_review_img_box"><?php echo $reviewImg; ?></div>
                                    <div <?php echo $reviewImg != '' ? 'style="float:left; width:205px;"' : ''; ?>><p><?php echo setStringLimit($reviewData['comment_text'], $commentWL); ?></p>
                                        <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">Read more</a></div>
                                    <div class="bbpw_clear"></div>
                                </div>
                                <div class="footer_div">
                                    <div class="comment_div">
                                        <p>
                                            <?php if ($bAllowComments): ?>
                                                <img src="<?php echo base_url(); ?>assets/images/widget/comment_icon.jpg">
                                                <a class="bbpw_comment_counter" class-position="<?php echo $count; ?>" style="cursor:pointer;"><?php echo sizeof($reviewData['comment_block']); ?> Comments </a>
                                            <?php endif; ?>
                                <!-- <span><?php echo number_format($reviewData['ratings'], 1); ?> Out of 5 Stars</span> -->
                                            <?php if ($bAllowHelpful): ?><span class="bb_review_helpful" <?php if (!$bAllowComments): ?>style="margin-left: 0px; padding-left: 0px; border-left:none;"<?php endif; ?>><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?> Found this helpful</span><?php endif; ?>
                                        </p>
                                    </div>
                                    <?php if ($bAllowHelpful): ?>
                                        <div class="liked_icon">
                                                <!-- <div class="likes_val_box"><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?></div> -->
                                            <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/like_icon.jpg" class="bbpw_helpful_action bb_show_like_value" class-position="<?php echo $count; ?>" action-name="Yes" bb-review-id="<?php echo $reviewData['id']; ?>"> 
                                            <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/dislike_icon.jpg" class="bbpw_helpful_action bb_show_dis_like_value" class-position="<?php echo $count; ?>" action-name="No" bb-review-id="<?php echo $reviewData['id']; ?>">
                                            <!-- <div class="dislikes_val_box"><?php echo ($reviewData['total_helpful_no']) ? $reviewData['total_helpful_no'] : 0; ?></div> -->
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="bbpw_comment_box">
                                    <?php if (!empty($reviewData['comment_block'])): ?>
                                        <?php
                                        $commentKey = 0;
                                        foreach ($reviewData['comment_block'] as $aComment):
                                            if ($commentKey < 3):
                                                $getUserDetail = getUserDetail($aComment['user_id']);
                                                ?>
                                                <div class="bb_comment_row">
                                                    <p><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
                                                    <p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
                                                </div>
                                                <?php
                                                $commentKey++;
                                            endif;
                                        endforeach;
                                        ?>
                                        <div class="bb_comment_row" style="border:none;">
                                            <p><span><a style="text-decoration:none;" href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">View all comments</a></span></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="bbpw_success_message">
                                        <div class="alert-success bb-popup-cmt-alert-success-msg bb-hidden">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
                                        <div class="alert-danger bb-popup-cmt-alert-error-msg bb-hidden">OPPS! Error while posting your comment. Try again!</div>
                                    </div>
                                    <div class="comment_form">
                                        <div class="bb_overlay"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
                                        <div class="form-group">
                                            <div class="">
                                                <input name="bbcmtname" placeholder="Your Name" class="form-control bbcmtname" required="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="">
                                                <input name="bbcmtemail" placeholder="Your Email" class="form-control bbcmtemail" required="" type="text">
                                            </div>
                                        </div>
                                        <div class="panel-body br0">
                                            <textarea class="form-control addnote bbcmt" name="bbcmt" placeholder="Write Your Comments Here…"></textarea>
                                        </div>
                                        <div class="s_comment">
                                            <input type="hidden" name="bb-review-id" class="bb-review-id" value="<?php echo $reviewData['id']; ?>" >
                                            <button type="submit" class="bbcmtsubmit" name="bbcmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--box_1--->
                            <?php
                            $count++;
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>

                    <?php if ($bAllowLiveReading): ?>
                        <div style="background:#fbfdfe; padding:15px; float:left; width: 100%; box-sizing: border-box; text-align: center; color: #494968; border-bottom: 1px solid #d5e0f2; border-top: 1px solid #d5e0f2;"><strong><?php echo $widgetCRU; ?> </strong> people<?php echo $widgetCRU > 1 ? 's' : ''; ?> currently reading.</div>
                    <?php endif; ?>

                    <div class="bottom_sec"><a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank" style="text-decoration:none;"><span>Add your own review</span> <img src="<?php echo base_url(); ?>assets/images/widget/arrow.png"></a></div>
                </div>
                <?php if ($bAllowBranding): ?>
                    <div style="background:#eee; padding:20px; float: left; width: 100%; box-sizing: border-box; text-align: right; color: #494968; border-top:1px solid #ccc;">Powered by: <strong><a href="<?php echo base_url(); ?>" target="_blank" style="color: #494968; text-decoration:none;">Brandboost.io</a> </strong></div>
                <?php endif; ?>
            </div>
            <div class="star_bottom <?php echo $bgClassName; ?> bbpw_vpw_review_btn">
                <p><i class="fa fa-star"></i> <?php echo $totalReviews; ?> Reviews</p>
            </div>
        </div>
    <?php endif; ?>
    <!-- ================ end vertical popup widget area ============== -->


    <!-- ================ start button widget popup widget area ============== -->

    <?php if ($oCampaign->widget_type == 'bww'): ?>
        <div class="review_chat" style="margin-bottom:100px;">
            <div id="bbpwButtonWidget" style="display:none;">
                <div class="head <?php echo $bgClassName; ?>">
                    <div class="box_left"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oCampaign->logo_img; ?>" onerror="this.src='<?php echo base_url('assets/images/default_table_img2.png'); ?>'"></div>
                    <div class="box_right">
                        <div class="client_n"><p><?php echo $oCampaign->brand_title; ?> <span><?php echo $oCampaign->brand_desc; ?></span></p></div>
                        <div class="client_review">
                            <?php for ($i = 0; $i < number_format($avgRatings, 0); $i++) { ?>
                                <img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png">
                            <?php } ?>
                            <?php
                            if ($i < 5) {
                                for ($j = $i; $j < 5; $j++) {
                                    ?>
                                    <img src="<?php echo base_url(); ?>assets/images/widget/dgrey_white_icon.png">
                                    <?php
                                }
                            }
                            ?> 
                            <span><?php echo number_format($avgRatings, 2); ?></span> <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank"><span class="re_client"><?php echo $totalReviews; ?> Reviews</span></a>
                        </div>
                    </div>
                </div>
                <div class="second_box">
                    <div class="middle">
                        <?php
                        $count = 0;
                        foreach ($aReviews as $reviewData) {
                            $profileImg = $reviewData['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $reviewData['user_data']['avatar'];
                            //pre($reviewData);

                            $reviewImg = '';
                            $videoURL = '';
                            $commentWL = '120';

                            $brandImgArray = unserialize($reviewData['media_url']);

                            if (sizeof($brandImgArray) > 0 && $reviewData['media_url'] != '' && $brandImgArray[0]['media_url'] != '' && $brandImgArray[0]['media_type'] == 'image'):
                                $reviewImg = '<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] . '" alt="">';
                                //$commentWL = '80';

                                foreach ($brandImgArray as $imageData) {
                                    if ($imageData['media_type'] == 'video' && ($bAllowVideoComments)) {
                                        $videoURL = '<video style="width:100%; height:auto; margin-top:15px; border-radius:5px;" controls><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $imageData['media_url'] . '" type="video/mp4">Your browser does not support the video tag.</video>';
                                        break;
                                    }
                                }
                            endif;
                            ?>
                            <div class="box_1">
                                <div class="top_div">
                                    <div class="left"><a class="icons" href="javascript:void(0);"><img src="<?php echo $profileImg; ?>" onerror="this.src='<?php echo base_url('assets/images/userp.png'); ?>'" class="img-circle img-xs" alt=""></a></div>
                                    <div class="right">
                                        <div class="client_n"><p><?php echo $reviewData['allow_show_name'] != 1 ? 'Anonymous' : $reviewData['firstname'] . ' ' . $reviewData['lastname']; ?></p></div>

                                        <div class="client_review">
                                            <?php if ($bAllowRatings): ?>
                                                <?php for ($i = 0; $i < $reviewData['ratings']; $i++) { ?>
                                                    <i class="fa fa-star <?php echo $textClassName; ?>"></i>
                                                <?php } ?>
                                                <?php
                                                if ($i < 5) {
                                                    for ($j = $i; $j < 5; $j++) {
                                                        ?>
                                                        <i class="fa fa-star gray_star"></i>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <?php endif; ?>
                                            <?php if ($bAllowCreatedTime): ?>
                                                <span><?php echo date('d M. Y', strtotime($reviewData['created'])); ?></span>
                                            <?php endif; ?>
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>

                                <div class="bottom_div">
                                    <?php echo $videoURL; ?>
                                    <div <?php echo $reviewImg != '' ? 'style="float:left; width:90px;"' : ''; ?> class="bbpw_review_img_box"><?php echo $reviewImg; ?></div>
                                    <div <?php echo $reviewImg != '' ? 'style="float:left; width:205px;"' : ''; ?>><p><?php echo setStringLimit($reviewData['comment_text'], $commentWL); ?></p>
                                        <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">Read more</a></div>
                                    <div class="bbpw_clear"></div>
                                </div>
                                <div class="footer_div">
                                    <div class="comment_div">
                                        <p>
                                            <?php if ($bAllowComments): ?>
                                                <img src="<?php echo base_url(); ?>assets/images/widget/comment_icon.jpg">
                                                <a class="bbpw_comment_counter" class-position="<?php echo $count; ?>" style="cursor:pointer;"><?php echo sizeof($reviewData['comment_block']); ?> Comments </a>
                                            <?php endif; ?>
                                <!-- <span><?php echo number_format($reviewData['ratings'], 1); ?> Out of 5 Stars</span> -->
                                            <?php if ($bAllowHelpful): ?><span class="bb_review_helpful" <?php if (!$bAllowComments): ?>style="margin-left: 0px; padding-left: 0px; border-left:none;"<?php endif; ?>><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?> Found this helpful</span><?php endif; ?>
                                        </p>
                                    </div>
                                    <?php if ($bAllowHelpful): ?>
                                        <div class="liked_icon">
                                                <!-- <div class="likes_val_box"><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?></div> -->
                                            <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/like_icon.jpg" class="bbpw_helpful_action bb_show_like_value" class-position="<?php echo $count; ?>" action-name="Yes" bb-review-id="<?php echo $reviewData['id']; ?>"> 
                                            <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/dislike_icon.jpg" class="bbpw_helpful_action bb_show_dis_like_value" class-position="<?php echo $count; ?>" action-name="No" bb-review-id="<?php echo $reviewData['id']; ?>">
                                            <!-- <div class="dislikes_val_box"><?php echo ($reviewData['total_helpful_no']) ? $reviewData['total_helpful_no'] : 0; ?></div> -->
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="bbpw_comment_box">
                                    <?php if ($bAllowComments): ?>
                                        <?php if (!empty($reviewData['comment_block'])): ?>
                                            <?php
                                            $commentKey = 0;
                                            foreach ($reviewData['comment_block'] as $aComment):
                                                if ($commentKey < 3):
                                                    $getUserDetail = getUserDetail($aComment['user_id']);
                                                    ?>
                                                    <div class="bb_comment_row">
                                                        <p><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
                                                        <p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
                                                    </div>
                                                    <?php
                                                    $commentKey++;
                                                endif;
                                            endforeach;
                                            ?>
                                            <div class="bb_comment_row" style="border:none;">
                                                <p><span><a style="text-decoration:none;" href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">View all comments</a></span></p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="bbpw_success_message">
                                            <div class="alert-success bb-popup-cmt-alert-success-msg bb-hidden">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
                                            <div class="alert-danger bb-popup-cmt-alert-error-msg bb-hidden">OPPS! Error while posting your comment. Try again!</div>
                                        </div>
                                        <div class="comment_form">
                                            <div class="bb_overlay"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
                                            <div class="form-group">
                                                <div class="">
                                                    <input name="bbcmtname" placeholder="Your Name" class="form-control bbcmtname" required="" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="">
                                                    <input name="bbcmtemail" placeholder="Your Email" class="form-control bbcmtemail" required="" type="text">
                                                </div>
                                            </div>
                                            <div class="panel-body br0">
                                                <textarea class="form-control addnote bbcmt" name="bbcmt" placeholder="Write Your Comments Here…"></textarea>
                                            </div>
                                            <div class="s_comment">
                                                <input type="hidden" name="bb-review-id" class="bb-review-id" value="<?php echo $reviewData['id']; ?>" >
                                                <button type="submit" class="bbcmtsubmit" name="bbcmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div><!--box_1--->
                            <?php
                            $count++;
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>

                    <?php if ($bAllowLiveReading): ?>
                        <div style="background:#fbfdfe; padding:15px; float:left; width: 100%; box-sizing: border-box; text-align: center; color: #494968; border-top: 1px solid #d5e0f2;"><strong><?php echo $widgetCRU; ?> </strong> people<?php echo $widgetCRU > 1 ? 's' : ''; ?> currently reading.</div>
                    <?php endif; ?>
                    <div class="bottom_sec"><span>Add your own review</span> <img src="<?php echo base_url(); ?>assets/images/widget/arrow.png"></div>
                    <?php if ($bAllowBranding): ?>
                        <div style="background:#eee; padding:20px; float: left; width: 100%; box-sizing: border-box; text-align: right; color: #494968; border-top:1px solid #ccc;">Powered by: 
                            <strong><a href="<?php echo base_url(); ?>" target="_blank" style="color: #494968; text-decoration:none;">Brandboost.io</a></strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="star_bottom <?php echo $bgClassName; ?> bbpw_bw_review_btn">
                <img style="margin-top:13px;" src="<?php echo base_url(); ?>assets/images/widget/white-star.png">
            </div>
        </div>
    <?php endif; ?>
    <!-- ================ end button popup widget area ============== -->


    <!-- ================ start Bottom Fixed widget area ============== -->
    <?php if ($oCampaign->widget_type == 'bfw'): ?>
        <div class="client_widget">
            <div class="main">
                <div class="bbpw_slider_widget" bb_total_slides="<?php echo sizeof($aReviews); ?>">
                    <div class="top_header">
                        <div class="rating">
                            <div class="arrow">
                                <a href="javascript:void(0);" class="left_arrow bb_slides_btn" bb_direction="left"><img src="<?php echo base_url(); ?>assets/images/widget/arrow-left.png"></a> 
                                <a href="javascript:void(0);" class="right_arrow bb_slides_btn" bb_direction="right"><img src="<?php echo base_url(); ?>assets/images/widget/arrow-right.png"></a>
                            </div>
                            <div class="left">
                                <?php for ($i = 0; $i < number_format($avgRatings, 0); $i++) { ?>
                                    <img src="<?php echo base_url(); ?>assets/images/widget/yellow_icon.png">
                                <?php } ?>
                                <?php
                                if ($i < 5) {
                                    for ($j = $i; $j < 5; $j++) {
                                        ?>
                                        <img src="<?php echo base_url(); ?>assets/images/widget/dgrey_white_icon.png">
                                        <?php
                                    }
                                }
                                ?>
                                <span><?php echo number_format($avgRatings, 2); ?></span> 
                                <p><span class="re_client"><a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">View all <?php echo $totalReviews; ?> reviews</a></span></p>
                            </div><!--left--->

                            <div class="right">
                                <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/widget/ask-icon.png">Ask a Question</a> 
                                <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/widget/smile-icon.png">Add review</a>
                            </div>
                        </div>
                    </div><!---top_header--->
                    <?php
                    $count = 0;
                    foreach ($aReviews as $reviewData) {
                        $profileImg = $reviewData['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $reviewData['user_data']['avatar'];

                        $reviewImg = '';
                        $videoURL = '';
                        $commentWL = '120';
                        $brandImgArray = unserialize($reviewData['media_url']);

                        if (sizeof($brandImgArray) > 0 && $reviewData['media_url'] != '' && $brandImgArray[0]['media_url'] != '' && $brandImgArray[0]['media_type'] == 'image'):
                            $reviewImg = '<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandImgArray[0]['media_url'] . '" alt="">';
                            $commentWL = '80';

                            foreach ($brandImgArray as $imageData) {
                                if ($imageData['media_type'] == 'video' && ($bAllowVideoComments)) {
                                    $videoURL = '<video style="width:100%; height:auto; margin-top:15px; border-radius:5px;" controls><source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $imageData['media_url'] . '" type="video/mp4">Your browser does not support the video tag.</video>';
                                    break;
                                }
                            }
                        endif;
                        ?>

                        <div class="box_1 bb_slides_box" style="display:<?php echo $count > 3 ? 'none' : 'block'; ?>">
                            <div class="top_div">
                                <div class="left"><a class="icons" href="javascript:void(0);"><img src="<?php echo $profileImg; ?>" onerror="this.src='<?php echo base_url('assets/images/userp.png'); ?>'" class="img-circle img-xs" alt=""></a></div>
                                <div class="right">
                                    <div class="client_n"><p><?php echo $reviewData['allow_show_name'] != 1 ? 'Anonymous' : $reviewData['firstname'] . ' ' . $reviewData['lastname']; ?> <span><?php echo $oCampaign->brand_title; ?></span></p></div>

                                    <div class="client_review">
                                        <?php if ($bAllowRatings): ?>
                                            <?php for ($i = 0; $i < $reviewData['ratings']; $i++) { ?>
                                                <i class="fa fa-star <?php echo $textClassName; ?>"></i>
                                            <?php } ?>
                                            <?php
                                            if ($i < 5) {
                                                for ($j = $i; $j < 5; $j++) {
                                                    ?>
                                                    <i class="fa fa-star gray_star"></i>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        <?php endif; ?>
                                        <?php if ($bAllowCreatedTime): ?>
                                            <span><?php echo date('d M. Y', strtotime($reviewData['created'])); ?></span>
                                        <?php endif; ?>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>

                            <div class="bottom_div">
                                <?php //echo $videoURL;    ?>
                                <div <?php echo $reviewImg != '' ? 'style="float:left; width:90px;"' : ''; ?> class="bbpw_review_img_box"><?php echo $reviewImg; ?></div>
                                <div <?php echo $reviewImg != '' ? 'style="float:left; width:225px;"' : ''; ?>><p><?php echo setStringLimit($reviewData['comment_text'], $commentWL); ?></p>
                                    <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">Read more</a></div>
                                <div class="bbpw_clear"></div>
                            </div>
                            <div class="footer_div">						
                                <div class="comment_div">
                                    <p>
                                        <?php if ($bAllowComments): ?>
                                            <img src="<?php echo base_url(); ?>assets/images/widget/comment_icon.jpg">
                                            <a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank" style="cursor:pointer; color:#768fbf;"><?php echo sizeof($reviewData['comment_block']); ?> Comments </a>
                                        <?php endif; ?>
                            <!-- <span><?php echo number_format($reviewData['ratings'], 1); ?> Out of 5 Stars</span> -->
                                        <?php if ($bAllowHelpful): ?><span class="bb_review_helpful" <?php if (!$bAllowComments): ?>style="margin-left: 0px; padding-left: 0px; border-left:none;"<?php endif; ?>><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?> Found this helpful</span><?php endif; ?>
                                    </p>
                                </div>
                                <?php if ($bAllowHelpful): ?>
                                    <div class="liked_icon">
                                            <!-- <div class="likes_val_box"><?php echo ($reviewData['total_helpful']) ? $reviewData['total_helpful'] : 0; ?></div> -->
                                        <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/like_icon.jpg" class="bbpw_helpful_action bb_show_like_value" class-position="<?php echo $count; ?>" action-name="Yes" bb-review-id="<?php echo $reviewData['id']; ?>"> 
                                        <img style="cursor:pointer;" src="<?php echo base_url(); ?>assets/images/widget/dislike_icon.jpg" class="bbpw_helpful_action bb_show_dis_like_value" class-position="<?php echo $count; ?>" action-name="No" bb-review-id="<?php echo $reviewData['id']; ?>">
                                        <!-- <div class="dislikes_val_box"><?php echo ($reviewData['total_helpful_no']) ? $reviewData['total_helpful_no'] : 0; ?></div> -->
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="bbpw_comment_box">
                                <?php if ($bAllowComments): ?>
                                    <?php if (!empty($reviewData['comment_block'])): ?>
                                        <?php
                                        foreach ($reviewData['comment_block'] as $aComment):
                                            $getUserDetail = getUserDetail($aComment['user_id']);
                                            ?>
                                            <div class="bb_comment_row">
                                                <p><span><?php echo $aComment['firstname'] . ' ' . $aComment['lastname']; ?></span> <?php echo timeAgo(date('F d, Y', strtotime($aComment['created']))); ?> </p>
                                                <p style="color:#888; margin-top:5px;"><?php echo $aComment['content']; ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="bb_comment_row" style="border:none;">
                                            <p><span><a style="text-decoration:none;" href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $oCampaign->brand_title)) . '-' . $campaignID; ?>" target="_blank">View all comments</a></span></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="bbpw_success_message">
                                        <div class="alert-success bb-popup-cmt-alert-success-msg bb-hidden">Thank you for posting your comment. Your comment has been sent successfully and please waiting for publish it.</div>
                                        <div class="alert-danger bb-popup-cmt-alert-error-msg bb-hidden">OPPS! Error while posting your comment. Try again!</div>
                                    </div>
                                    <div class="comment_form">
                                        <div class="bb_overlay"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
                                        <div class="form-group">
                                            <div class="">
                                                <input name="bbcmtname" placeholder="Your Name" class="form-control bbcmtname" required="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="">
                                                <input name="bbcmtemail" placeholder="Your Email" class="form-control bbcmtemail" required="" type="text">
                                            </div>
                                        </div>
                                        <div class="panel-body br0">
                                            <textarea class="form-control addnote bbcmt" name="bbcmt" placeholder="Write Your Comments Here…"></textarea>
                                        </div>
                                        <div class="s_comment">
                                            <input type="hidden" name="bb-review-id" class="bb-review-id" value="<?php echo $reviewData['id']; ?>" >
                                            <button type="submit" class="bbcmtsubmit" name="bbcmtsubmit" class-position="<?php echo $count; ?>" style="cursor:pointer;">Comment</button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                        $count++;
                    }
                    ?>								
                </div>
            </div><!---main--->
        </div><!---client_widget---->
    <?php endif; ?>

    <!-- =================== end Bottom Fixed widget area ======================= -->
</div>