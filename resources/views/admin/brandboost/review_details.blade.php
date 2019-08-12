@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<script type="text/javascript" src="<?php echo base_url('assets/js/viewbox.min.js'); ?>"></script>
<style>
    .viewbox-container{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,.5);
        z-index: 99999;
    }
    .viewbox-body{
        position: absolute;
        top: 50%;
        left: 50%;
        background: #fff;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        overflow: auto;
    }
    .viewbox-header{
        margin: 10px;
    }
    .viewbox-content{
        margin: 10px;
        width: 300px;
        height: 300px;
    }
    .viewbox-footer{
        margin: 10px;
    }
    .viewbox-content .viewbox-image{
        width: 100%;
        height: 100%;
    }

    /* buttons */
    .viewbox-button-default{
        cursor: pointer;
        height: 64px;
        width: 64px;
    }
    .viewbox-button-default > svg{
        width: 100%;
        height: 100%;
        background: inherit;
        fill: inherit;
        pointer-events: none;
        transform: translateX(0px);
    }
    .viewbox-button-default{
        fill: #999;
    }
    .viewbox-button-default:hover{
        fill: #fff;
    }

    .viewbox-button-close{
        position:absolute;
        top:10px;
        right: 10px;
        z-index:9;
    }
    .viewbox-button-next,
    .viewbox-button-prev{
        position:absolute;
        top: 50%;
        height: 128px;
        width: 128px;
        margin: -64px 0 0;
        z-index:9;
    }
    .viewbox-button-next{
        right: 10px;
    }
    .viewbox-button-prev{
        left: 10px;
    }

    /* loader */
    .viewbox-container .loader{
        widows: 100%;
        position: absolute;
        left: 50%;
        top: 50%;
        margin:-25px 0 0 -25px;
    }
    .viewbox-container .loader *{
        margin: 0;
        padding: 0;
    }
    .viewbox-container .loader .spinner{
        width: 50px;
        height: 50px;
        position: relative;
        margin: 0 auto;
    }
    .viewbox-container .loader .double-bounce1,
    .viewbox-container .loader .double-bounce2{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #999;
        opacity: 0.6;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
        animation: sk-bounce 2.0s infinite ease-in-out;
    }
    .viewbox-container .loader .double-bounce2 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }
    @-webkit-keyframes sk-bounce{
        0%, 100% { -webkit-transform: scale(0.0) }
        50% { -webkit-transform: scale(1.0) }
    }

    @keyframes sk-bounce{
        0%, 100% { 
            transform: scale(0.0);
            -webkit-transform: scale(0.0);
        } 50% { 
            transform: scale(1.0);
            -webkit-transform: scale(1.0);
        }
    }

</style>
<style type="text/css">
    .loadMoreRecord {text-align: center; padding: 20px; margin: 0; border-top: 1px solid #eee;}
    .applyInsightTags.btn.btn-xs.plus_icon { position: relative; top: -8px;}
</style>	

<div class="content">
    <?php
    $reviewTags = getTagsByReviewID($reviewData->id);
    ?>
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3 class="mt30">
					<?php
					if ($reviewData->ratings >= 4) {
						?><img style="width:18px;" src="<?php echo base_url(); ?>assets/images/smiley_green.png"><?php
					} else if ($reviewData->ratings >= 2) {
						?><img style="width:18px;" src="<?php echo base_url(); ?>assets/images/smiley_grey2.png"><?php
					} else {
						?><img style="width:18px;" src="<?php echo base_url(); ?>assets/images/smiley_red.png"><?php
					}
					?>
					<?php echo $productName; ?> Review
				</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <button type="button" class="btn light_btn"><i class="icon-bin"></i><span> &nbsp;  Delete</span> </button>
                <button type="button" class="btn dark_btn ml10"><i class="icon-check2 txt_purple"></i><span> &nbsp;  Resolve</span> </button>

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


    <!--================================= CONTENT AFTER TAB===============================-->
    <div class="row">
        <!--------------LEFT----------->
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Image & Video</h6>
                    <div class="heading-elements">
                        <div class="table_action_tool">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p0" >
                    <div class="image_video">

                        <?php
                        $mediaArray = unserialize($reviewData->media_url);
                        if (!empty($mediaArray)) {
                            foreach ($mediaArray as $media) {
                                if ($media['media_type'] == 'image') {
                                    
                                    $media_url = $media['media_url'];
                                    $ext = pathinfo($media_url, PATHINFO_EXTENSION);

                                    $videoImage = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $media_url;
                                    $getFileSize = getRemoteFileSize($videoImage);
                                    ?>

                                    <div class="p25 bbot">
                                        <div class="media-left media-middle pr40"> 
                                            <a class="thumbnail2" href="<?php echo $videoImage; ?>"><img src="<?php echo $videoImage; ?>" class="br5" height="45px" width="60px"/></a>
                                        </div>
                                        <div class="media-left media-middle pr10"> 
                                            <a class="icons" href="javascript:void(0)">
                                                <?php
                                                if ($ext == 'png') {
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/png.png" class="img-xs file" alt="">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/jpg.png" class="img-xs file" alt="">
                                                <?php }
                                                ?>

                                            </a> 
                                        </div>
                                        <div class="media-left">
                                            <div class="pt-5">
                                                <a href="javascript:void(0)" class="text-default text-semibold"><?php echo $getFileSize; ?></a>
                                            </div>
                                            <div class="text-muted text-size-small" style="word-break: break-all;"><?php //echo $media['media_name']; ?></div>
                                        </div>
                                    </div>

                                    <?php
                                } else {
                                    $media_url = $media['media_url'];
                                    $ext = pathinfo($media_url, PATHINFO_EXTENSION);
                                    
                                    $videoImage = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $media_url;
                                    $getFileSize = getRemoteFileSize($videoImage);
                                    ?>


                                    <div class="p25 bbot">
                                        <div class="media-left media-middle pr40"> 
                                            <a class="videoReview" style="cursor: pointer;" filepath="<?php echo $videoImage; ?>" fileext="<?php echo $ext; ?>">
                                                <!-- <img src="<?php echo base_url(); ?>assets/images/media2.jpg"/> -->
                                                <video class="media br5" height="50px" width="60px">
                                                  <source src="<?php echo $videoImage; ?>" type="video/<?php echo $ext; ?>">
                                                </video>
                                            </a>
                                        </div>
                                        <div class="media-left media-middle pr10"> 
                                            <a class="icons" href="javascript:void(0)">
                                                <img src="<?php echo base_url(); ?>assets/images/mp4.png" class="img-xs file" alt="">
                                            </a> 
                                        </div>
                                        <div class="media-left">
                                            <div class="pt-5">
                                                <a href="javascript:void(0)" class="text-default text-semibold"><?php echo $getFileSize; ?></a> 
                                            </div>
                                            <div class="text-muted text-size-small" style="word-break: break-all;"><?php echo $media['media_name']; ?></div>
                                        </div>
                                    </div> 




                                    <?php
                                }
                            }
                        } else {
                            ?><div class="p25 bbot text-center"><span>No Image Found</span></div><?php
                        }
                        ?>

                    </div>
                </div>
            </div>
			
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Tags</h6>
                    <div class="heading-elements">
                        <div class="table_action_tool">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p0" >
                    <div class="profile_sec">
                        <div class="p25">
                            <?php
                            if (!empty($reviewTags)) {
                                foreach ($reviewTags as $tag) {
                                    ?><button class="btn btn-xs btn_white_table"><?php echo $tag->tag_name; ?></button><?php
                                }
                            }
                            ?>
                            <?php if (empty($reviewTags)): ?><div class="text-center">No Tag Found</div><?php endif; ?>
                            <button class="btn btn-xs plus_icon applyInsightTags" reviewid="<?php echo base64_url_encode($reviewData->id); ?>" action_name="review-tag"><i class="icon-plus3"></i></button>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!------------CENTER------------->
        <div class="col-md-6">
            <!--=========Top Comments===========-->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title"><?php echo $productName; ?> Review</h6>
                    <div class="heading-elements">
                        <div class="table_action_tool">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p30 br0">
					<p class="fsize16 mb10"><?php echo $reviewData->review_title; ?></p>
                    <p class="fsize13 mb20 lh25 txt_grey2"><?php echo $reviewData->comment_text != '' ? $reviewData->comment_text : 'N/A'; ?></p>


                    <div class="media-left media-middle pr10"> <span class="icons"><?php echo showUserAvtar($reviewData->avatar, $reviewData->firstname, $reviewData->lastname); ?></span> </div>
                    <div class="media-left">
                        <div class="text-muted">by <?php echo $reviewData->firstname . " " . $reviewData->lastname; ?>   <span class="ml20"><i class="icon-checkmark3 fsize12 txt_green"></i>&nbsp; Verified Purchase</span></div>
                    </div>



                </div>
                <div class="panel-footer p20 pl30 pr30 ">
                    <p class="mb0 fsize13">
                        <?php
                        if ($reviewData->ratings >= 4) {
                            ?><img width="26" class="mr10" src="<?php echo base_url(); ?>assets/images/smiley_green.png"><?php
                        } else if ($reviewData->ratings >= 2) {
                            ?><img width="26" class="mr10" src="<?php echo base_url(); ?>assets/images/smiley_grey2.png"><?php
                        } else {
                            ?><img width="26" class="mr10" src="<?php echo base_url(); ?>assets/images/smiley_red.png"><?php
                        }
                        ?>

                        <span>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $reviewData->ratings) {
                                    echo '<i class="icon-star-full2 fsize11 txt_yellow"></i> ';
                                } else {
                                    echo '<i class="icon-star-full2 fsize11 txt_grey"></i> ';
                                }
                            }
                            ?>
                        </span>  <span class="ml20"><?php echo $reviewData->ratings > 0 ? number_format($reviewData->ratings, 1) : 'N/A'; ?> Out of 5 Stars</span> <span class="ml20"><i class="icon-comment fsize11 txt_purple"></i> &nbsp; <?php echo $reviewCommentCount > 0 ? $reviewCommentCount . ' Comments' : '0 Comment'; ?></span></p>
                </div>
            </div>
            <!--=========Latest Comments===========-->
            <?php if ($totalComment > 0) { ?>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Latest Comments <?php echo $totalComment > 0 ? '(' . $totalComment . ')' : ''; ?></h6>
                        <div class="heading-elements">
                            <div class="table_action_tool">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body p0">
                        <div class="comment_sec">
                            <ul class="addMoreComment">



                                <?php
                                //pre($reviewID);
                                if (!empty($reviewCommentsData)) {

                                    foreach ($reviewCommentsData as $commentData) {
                                        $likeData = App\Models\ReviewsModel::getCommentLSByCommentID($commentData->id, 1);
                                        $disLikeData = App\Models\ReviewsModel::getCommentLSByCommentID($commentData->id, 0);

                                        $childComments = App\Models\ReviewsModel::getReviewAllChildComments($reviewID, $commentData->id);
                                        //$avtarImage = $commentData->avatar == 'avatar_image.png' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $commentData->avatar;
                                        ?>
                                        <li class="bbot">

                                            <div class="media-left"><?php echo showUserAvtar($commentData->avatar, $commentData->firstname, $commentData->lastname); ?></div>

                                            <div class="media-left pr0 w100">

                                                <p class="fsize14 txt_grey2 lh14 mb-15 "><?php echo $commentData->firstname . ' ' . $commentData->lastname; ?> <span class="dot">.</span> <?php echo timeAgo($commentData->created); ?> <span class="dot">.</span> 

                                                    <?php if ($commentData->status == '1') { ?>
                                                        <span class="txt_green"><i class="icon-checkmark3 fsize12 txt_green"></i> Approve</span>
                                                    <?php } ?>
                                                    <?php if ($commentData->status == 0) { ?>

                                                        <span class="txt_red"><i class="icon-checkmark3 fsize12 txt_red"></i> Disapproved</span>

                                                    <?php } ?>
                                                    <?php if ($commentData->status == '2') { ?>
                                                        <span class="media-annotation"> <span class="label bkg_grey txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="1" comment_id="<?php echo $commentData->id; ?>"> Approve</span> </span>
                                                        <span class="media-annotation dotted"> <span class="label bkg_red txt_white br5 chg_status addtag" change_status="0" comment_id="<?php echo $commentData->id; ?>"> Disapprove</span> </span>
                                                    <?php } ?>
                                                </p>

                                                <p class="fsize13 mb10 lh23 txt_grey2">
                                                    <?php echo $commentData->content != '' ? $commentData->content : 'N/A'; ?></p>

                                                <div class="button_sec">
                                                    <button class="btn btn-link pl0 txt_green"><?php echo count($likeData); ?></button>
                                                    <a class="btn comment_btn p7" href="javascript:void(0);" onclick="saveCommentLikeStatus('<?php echo $commentData->id; ?>', '1')"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                    <button class="btn btn-link pl0 txt_red"><?php echo count($disLikeData); ?></button>
                                                    <a class="btn comment_btn p7" href="javascript:void(0);" onclick="saveCommentLikeStatus('<?php echo $commentData->id; ?>', '0')"><i class="icon-thumbs-down2 txt_red"></i></a>
                                                    <a style="cursor: pointer;" class="btn comment_btn txt_purple replyCommentAction">Reply</a> 
                                                    <a  href="javascript:void(0);" class="btn comment_btn txt_purple editComment" commentid="<?php echo $commentData->id; ?>">Edit</a>
                                                </div>

                                                <div class="replyCommentBox" style="display:none;">
                                                    <form method="post" class="form-horizontal" action="javascript:void();">
                                                        <div class="mt10 mb10">
                                                            <textarea name="comment_content" class="form-control comment_content" style="padding: 15px; height: 75px;" placeholder="Comment Reply..." required></textarea>
                                                        </div>

                                                        <div class="text-right">
                                                            <input name="reviweId" class="reviweId" value="<?php echo $commentData->review_id; ?>" type="hidden">
                                                            <input name="parent_comment_id" class="parent_comment_id" value="<?php echo $commentData->id; ?>" type="hidden">
                                                            <button style="width: 128px;" type="button" class="btn dark_btn addReplyComment"> Reply</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <?php
                                                if (!empty($childComments)) {
                                                    foreach ($childComments as $childComment) {

                                                        $avtarImageChild = $childComment->avatar == 'avatar_image.png' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $childComment->avatar;

                                                        $likeChildData = App\Models\ReviewsModel::getCommentLSByCommentID($childComment->id, 1);
                                                        $disLikeChildData = App\Models\ReviewsModel::getCommentLSByCommentID($childComment->id, 0);
                                                        ?>

                                                        <div class="reply_sec mt30">
                                                            <div class="media-left">
                                                                <?php echo showUserAvtar($childComment->avatar, $childComment->firstname, $childComment->lastname); ?>
                                                            </div>
                                                            <div class="media-left pr0">
                                                                <p class="fsize14 txt_grey2 lh14 mb10 "><?php echo $childComment->firstname . ' ' . $childComment->lastname; ?> <span class="dot">.</span> <?php echo timeAgo($childComment->created); ?> </p>
                                                                <p class="fsize13 mb10 lh23 txt_grey2">
                                                                    <?php echo $childComment->content != '' ? $childComment->content : 'N/A'; ?>
                                                                </p>
                                                                <div class="button_sec">
                                                                    <button class="btn btn-link pl0 txt_green"><?php echo count($likeChildData); ?></button>
                                                                    <a href="javascript:void(0);" onclick="saveCommentLikeStatus('<?php echo $childComment->id; ?>', '1')" class="btn comment_btn p7"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                                    <button class="btn btn-link pl0 txt_red"><?php echo count($disLikeChildData); ?></button>
                                                                    <a href="javascript:void(0);" onclick="saveCommentLikeStatus('<?php echo $childComment->id; ?>', '0')" class="btn comment_btn p7"><i class="icon-thumbs-down2 txt_red"></i></a>
                                                                    <a href="javascript:void(0);" commentid="<?php echo $childComment->id; ?>" class="btn comment_btn txt_purple editComment">Edit</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </div>
                                        </li>

                                    <?php }
                                }
                                ?>

                            </ul>

                            <?php if ($totalComment > 5) {
                                ?>
                                <input type="hidden" id="numOfComment" value="5">
                                <div class="loadMoreRecord"><a style="cursor: pointer;" id='loadMoreComment' revId="<?php echo $reviewData->id; ?>">Load more</a><img class="loaderImage hidden" height="20px" width="20px" src="<?php echo base_url(); ?>assets/images/widget_load.gif"></div><?php }
                    ?>

                        </div>
                    </div>

                </div>
<?php } ?>
            <!--=========Add Comment===========-->
            <form method="post" class="form-horizontal" id="addComment" action="javascript:void();">
                {{ csrf_field() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Add Comment</h6>
                        <div class="heading-elements">
                            <div class="table_action_tool">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body br0">

                        <textarea name="comment_content" id="comment_content" required class="form-control addnote" placeholder="Start typing to leave a note..."></textarea>
                    </div>
                    <div class="panel-footer p20 text-right">
                        <a style="cursor: pointer;"><i class="icon-hash text-muted"></i></a> &nbsp; &nbsp; <a style="cursor: pointer;"><i class="icon-reset text-muted"></i></a>
                        <input type="hidden" name="reviweId" id="reviweId" value="<?php echo $reviewData->id; ?>">
                        <button type="submit" class="btn dark_btn btn-xs ml20">Add Comment</button>
                    </div>
                </div>
            </form>
        </div>

        <!------------RIGHT------------->
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Info</h6>
                    <div class="heading-elements">
                        <div class="table_action_tool">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p0" >
                    <div class="interactions p25">
                        <ul>
                            <li><small>Ref</small> <strong>N/A</strong></li>
                            <li><small>Name</small> <strong><?php echo $reviewData->firstname . ' ' . $reviewData->lastname; ?></strong></li>
                            <li><small>Email</small> <strong><?php echo $reviewData->email; ?></strong></li>
                            <li><small>Phone</small> <strong><?php echo $reviewData->mobile == '' ? 'N/A' : $reviewData->mobile; ?></strong></li>
                            <!-- <li><small>Reviews</small> <strong>3</strong></li>
                            <li><small>Notification</small> <strong>On</strong></li>
                            <li><small>Id</small> <strong>310282</strong></li>
                            <li><small>SMS</small> <strong>On</strong></li>
                            <li><small>Emails</small> <strong>Off</strong></li> -->
                        </ul>
                    </div>
                    <div class="profile_headings">Review Notes <a class="pull-right plus_icon" href="javascript:void();"><i class="icon-plus3"></i></a></div>

                    <?php
                    if (!empty($reviewNotesData)) {
                        foreach ($reviewNotesData as $key => $noteData) {
                            ?>
                            <div class="p25 bbot">
                                <p class="fsize12"><?php echo $noteData->notes; ?></p>
                                    <p><small class="text-muted">On <?php echo date('F d, Y h:i A', strtotime($noteData->created)); ?> <?php //echo '( '.timeAgo($noteData->created).' )';   ?><br>by <?php echo $noteData->firstname . ' ' . $noteData->lastname; ?></small></p>

                                <div class="text-right">
                                    <a href="javascript:void(0)" class="editNote" noteid="<?php echo $noteData->id; ?>"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
                                    <a href="javascript:void(0)" class="deleteNote" noteid="<?php echo $noteData->id; ?>"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>

                                    <!-- <ul class="list-inline list-inline-separate text-size-small text-right mt-5">
                                        <li> </li>
                                        <li> </li>
                                    </ul> -->
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="p25 bbot text-center">No Note Found</div>';
                    }
                    ?>

                    <!-- <div class="p25 bbot">
                            <p class="fsize12">So strongly and metaphysically did.</p>
                            <p><small class="text-muted">On August 09, 2018 09:51 ( 1 week ago )<br>by Dheeraj Maulekhi</small></p>
                    </div>
                    
                    <div class="p25">
                            <p class="fsize12">So strongly and metaphysically did.</p>
                            <p><small class="text-muted">On August 09, 2018 09:51 ( 1 week ago )<br>by Dheeraj Maulekhi</small></p>
                    </div> -->

                    <div class="p25 btop">
                        <button data-toggle="modal" data-target="#addnotes" type="button" class="btn dark_btn btn-xs mr20">Add Note</button>	 <!-- <button class="btn btn-link btn-xs mr20">View All Notes</button> -->
                    </div>





                </div>
            </div>




        </div>

    </div>


    <!--================================= CONTENT AFTER TAB===============================-->



</div>

<div id="editComment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateComment" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Comment</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Comment</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  placeholder="Leave Comment" name="edit_content" id="edit_content" required ></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="edit_commentid" id="edit_commentid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn dark_btn"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editNoteSection" class="modal fade" style="z-index:99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateNote" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Comment</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Note</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  placeholder="Note" name="edit_note_content" id="edit_note_content" required ></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="edit_noteid" id="edit_noteid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn dark_btn"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="addnotes" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Review Notes</h5>
            </div>
            <div class="modal-body">
                <div class="row">

                    <form method="post" class="form-horizontal" id="frmSaveNote" action="javascript:void();">
                        {{ csrf_field() }}
                        <div class="col-md-12 mb-15">
                            <textarea class="form-control" name="notes" style="padding: 20px; height: 75px;" placeholder="Add Note"></textarea>
                        </div>
                        <div class="col-md-12 text-right ">
                            <input type="hidden" name="reviewid" id="reviewid" value="<?php echo $reviewData->id; ?>">
                            <input type="hidden" name="cid" id="cid" value="<?php echo $reviewData->user_id; ?>">
                            <input type="hidden" name="bid" id="bid" value="<?php echo $reviewData->bbId; ?>">
                            <button data-toggle="modal" data-target="#addnotes" type="button" id="saveReviewNotes" class="btn dark_btn"> Add Notes &nbsp; <i class="fa fa-angle-double-right"></i> </button>
							{{ csrf_field() }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ReviewTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireList"></div>
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="review_id" id="tag_review_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="ReviewTagListModal" class="modal fade" style="z-index:9999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="border-top: none; border-bottom: 1px solid #eee!important;" class="panel-footer panel-footer-condensed">
                <div class="heading-elements not-collapsible">
                    <span class="heading-text text-semibold">
                        <i class="fa fa-tag position-left"></i>
                        <span class="reviewTime">Apply Tags</span>
                    </span>
                    <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                </div>
            </div>


            <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">

                <!--   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h5 class="modal-title">Apply Tags</h5>
                   </div>-->

                <div class="modal-body" id="tagEntireList">

                </div>

                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="review_id" id="tag_review_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="videoReviewModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Video review</h5>
            </div>
            <div class="modal-body" id="vReview">
                <video width="100%" controls>
                    <source src="" type="">
                </video>
            </div>
            <!-- <div class="modal-footer modalFooterBtn">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>



<script>

    /*$(document).ready(function(){
     $(".reviews").click(function(){
     $(".box").animate({
     width: "toggle"
     });
     });
     
     $("#newcampaign").click(function(){
     $(".box").animate({
     width: "toggle"
     });
     });
     
     });*/


    // top navigation fixed on scroll and side bar collasped

    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });

    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    });



</script>

<script>

    $(function () {
        $('.thumbnail2').viewbox();
    });

    var startingLimit = 0;
    function loadMoreComments(reviewID, startinglimitVal) {
        $('.overlaynew').show();
        $.ajax({
            url: '<?php echo base_url('admin/brandboost/getreviwecomments/'); ?>',
            type: "POST",
            data: {'reviewId': reviewID, 'startinglimitVal': startinglimitVal},
            dataType: "json",
            success: function (data) {
                $('.overlaynew').hide();
                if (data.status == 'success') {
                    $('#commentDataList').append(data.commentList);
                    startingLimit = parseInt(startinglimitVal) + 5;
                    if (data.nunOfComment < 5) {
                        $('.loadMoreBtn').html('<a href="javascript:void(0);">No More Comments Found...</a>');
                    } else {
                        $('.loadMoreBtn a').attr('onclick', 'loadMoreComments(' + reviewID + ', ' + startingLimit + ')');
                    }

                } else {
                    $('.loadMoreBtn').html('<a href="javascript:void(0);">' + data.commentList + '</a>');
                }
            }, error() {
                $('.overlaynew').hide();
            }
        });
        return false;
    }

    function saveCommentLikeStatus(commentID, statusType) {
        $('.overlaynew').show();
        $.ajax({
            url: '<?php echo base_url("admin/reviews/saveCommentLikeStatus/"); ?>',
            type: "POST",
            data: {'commentId': commentID, 'status': statusType},
            dataType: "json",
            success: function (data) {
                $('.overlaynew').hide();
                if (data.status == 'success') {
                    window.location.href = '';
                }
            }, error() {
                $('.overlaynew').hide();
            }
        });
        return false;
    }

    $(document).ready(function () {

        $(document).on('click', '.videoReview', function () {
            var filepath = $(this).attr('filepath');
            var fileext = $(this).attr('fileext');
            $('#vReview video source').attr('src', filepath);
            $('#vReview video source').attr('type', 'video/' + fileext);
            $("#vReview video")[0].load();
            $('#videoReviewModal').modal();

        });

        $(document).on("click", ".replyCommentAction", function () {
            $(this).parent().next('.replyCommentBox').toggle('slow');
        });

        $(document).on("click", ".removetxt", function () {
            var reviewID = $(this).attr("review_id");
            var tagID = $(this).attr("tag_id");
            var elem = $(this);
            $.ajax({
                url: '<?php echo base_url('admin/tags/removeTag'); ?>',
                type: "POST",
                data: {review_id: reviewID, tag_id: tagID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $(elem).parent().remove();
                    }
                }
            });
        });

        $(document).on('click', '.chg_status', function () {
            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var comment_id = $(this).attr('comment_id');
            $.ajax({
                url: '<?php echo base_url('admin/comments/update_comment_status'); ?>',
                type: "POST",
                data: {status: status, comment_id: comment_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.editComment', function () {
            var commentID = $(this).attr('commentid');
            $.ajax({
                url: '<?php echo base_url('admin/comments/getCommentById'); ?>',
                type: "POST",
                data: {commentID: commentID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var commentData = data.result[0];
                        $('#edit_content').val(commentData.content);
                        $('#edit_commentid').val(commentData.id);
                        $("#editComment").modal();
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.editNote', function () {
            var noteId = $(this).attr('noteid');
            $.ajax({
                url: '<?php echo base_url('reviews/getReviewNoteById'); ?>',
                type: "POST",
                data: {noteid: noteId,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var noteData = data.result[0];
                        $('#edit_note_content').val(noteData.notes);
                        $('#edit_noteid').val(noteData.id);
                        $("#editNoteSection").modal();
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.deleteNote', function () {
            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this note!");
            if (conf == true) {
                var noteId = $(this).attr('noteid');
                $.ajax({
                    url: '<?php echo base_url('admin/reviews/deleteReviewNote'); ?>',
                    type: "POST",
                    data: {noteid: noteId, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });

        $("#updateNote").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_note'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#editNoteSection").modal('hide');
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.addReplyComment', function () {

            var reviewID = $(this).prev().prev().val();
            var parentCommentId = $(this).prev().val();
            var commentContent = $(this).parent().prev().find('.comment_content').val();
            if (commentContent != '') {
                $('.overlaynew').show();
                $.ajax({
                    url: '<?php echo base_url("admin/comments/add_comment"); ?>',
                    type: "POST",
                    data: {'reviweId': reviewID, 'parent_comment_id': parentCommentId, 'comment_content': commentContent,_token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            window.location.href = window.location.href;
                        } else {
                            $('.overlaynew').hide();
                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                alertMessage('Comment not found.');
            }
        });

        $("#addComment").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/comments/add_comment'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $("#updateComment").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/comments/update_comment'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.deleteComment', function () {
            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this comment!");
            if (conf == true) {
                var commentId = $(this).attr('commentid');
                $.ajax({
                    url: '<?php echo base_url('admin/comments/deleteComment'); ?>',
                    type: "POST",
                    data: {commentId: commentId},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });

        $(document).on("click", ".applyInsightTags", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/tags/listAllTags'); ?>',
                type: "POST",
                data: {review_id: review_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
                        } else {
                            $('.modalFooterBtn').show();
                        }
                        $("#tagEntireList").html(dataString);
                        $("#tag_review_id").val(review_id);
                        $("#tag_feedback_id").val(feedback_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModal").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModal").modal("show");
                        }
                    }
                }
            });
        });

        $("#frmReviewTagListModal").submit(function () {
            var formdata = $("#frmReviewTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyReviewTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#ReviewTagListModal").modal("hide");
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });

        $(document).on("click", "#saveReviewNotes", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/reviews/saveReviewNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        window.location.href = window.location.href;
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });


        $(document).on('click', '#loadMoreComment', function () {

            var numOfComment = $('#numOfComment').val();
            var revId = $(this).attr('revId');

            $('.loaderImage').removeClass('hidden');
            $.ajax({
                url: '<?php echo base_url("admin/reviewdetail/loadComment"); ?>',
                type: "POST",
                data: {'reviewId': revId, 'offset': numOfComment},
                dataType: "html",
                success: function (data) {

                    if (data != '') {
                        $('.addMoreComment').append(data);
                        var offset = Number(numOfComment) + 5;
                        $('#numOfComment').val(offset);
                        $('.loaderImage').addClass('hidden');
                    } else {
                        $('.loadMoreRecord').remove();
                    }

                }, error() {
                    $('.loaderImage').addClass('hidden');
                }
            });
            return false;

        });


    });
</script>
@endsection