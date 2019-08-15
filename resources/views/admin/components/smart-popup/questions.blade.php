
<style>
    .enlarge {
        cursor: pointer;
    }
    .media-expand{
        display:block;
        margin-bottom: 15px;
        width:100%;
        padding-right:0px;

    }

    .media-expand img{
        width:100% !important;
        height: auto !important;

    }

    .smartStickyFooter{
        position: absolute;
        bottom: 72px;
        width: 100%;
        background: #fff;
        border-top: 1px solid #eee;
        padding: 0px;
        left:10px;
    } 
    .smartStickyFooter textarea {
        height: 50px!important;
    }

    .thumbnail .thumb img {border-radius: 5px 5px 0 0; height: 220px;}
    .caption-overflow.smallovfl {
        color: #333;
        width: 135px;
        line-height: 95px;
        margin-left: 10px;
    }
    .caption-overflow.smallovfl a {    display: block;    height: 44px;    text-align: center; color: #fff; }
    .caption-overflow.smallovfl a i{font-size: 18px;}
    .small_media_icon:hover .caption-overflow.smallovfl{ visibility: visible!important; opacity: 1!important; background: rgba(0,0,0,0.4); border-radius: 5px;}
    .smart_img_gallery .image_pagination li a video {
        width: 33.6px!important;
        height: 27.8px!important;
        border-radius: 4px;
        opacity: 0.7;
    }


</style>

<?php
$questionTitle = $oQuestion->question_title;
$questionDescription = $oQuestion->question;
$mediaArray = unserialize($oQuestion->media_url);
?>
<input type="hidden" name="smartpopup_question_id" id="smartpopup_question_id" value="<?php echo $oQuestion->id; ?>" />
<div class="smartpopup-container">
    <div class="p20 pl30">
        <div class="col-md-12">
            <div class="smart_img_gallery p20">

                <?php
                $subscriberID = $mUser->checkIfSubscriber(array('email' => $oQuestion->email));
                if ($subscriberID > 0) {
                    $oSubscriber = $mSubscriber->getGlobalSubscriberInfo($subscriberID);
                }

                $mediaArray = unserialize($oQuestion->media_url);
                $totalMedia = count($mediaArray);
                if (!empty($mediaArray)) {
                    if ($mediaArray[0]['media_type'] == 'image') {
                        $mediaSource = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $mediaArray[0]['media_url'];
                        $primaryMedia = '<img class="bb_img_enlagre" src="' . $mediaSource . '"><div class="caption-overflow smallovfl"><a class="preview_img_src" href="' . $mediaSource . '" data-popup="lightbox"><i class="icon-eye"></i></a></div>';
                    } else if ($mediaArray[0]['media_type'] == 'video') {
                        $mediaSource = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $mediaArray[0]['media_url'];
                        $primaryMedia = '<video class="media br5 " height="100%" width="100%"><source id="bb_video_enlarge" src="' . $mediaSource . '" type="video/mp4"></video><div class="caption-overflow smallovfl"><a class="preview_video_src" style="cursor: pointer;" filepath="' . $mediaSource . '" fileext="mp4"><i class="icon-eye"></i></a></div>';
                    }
                }
                ?>

                <div class="big_img <?php if ($totalMedia <= 1): ?>mr20<?php endif; ?> small_media_icon">
                    <?php if ($primaryMedia): ?>
                        <?php echo $primaryMedia; ?>
                    <?php else: ?>
                        <?php echo showUserAvtar($oQuestion->avatar, $oQuestion->firstname, $oQuestion->lastname, 95, 95, 22); ?>
                    <?php endif; ?>
                </div>

                <?php if ($totalMedia > 1): ?>
                    <ul class="image_pagination">
                        <?php
                        $i = 0;
                        foreach ($mediaArray as $media) {
                            $i++;
                            if ($i <= 3) {
                                $media_url = $media['media_url'];
                                $mediaSrc = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $media_url;
                                $ext = pathinfo($mediaSrc, PATHINFO_EXTENSION);
                                if ($media['media_type'] == 'image') {
                                    ?>

                                    <li><a class="bb_active" href="javascript:void(0);"><img class="loadMainImageMedia" src="<?php echo $mediaSrc; ?>" width="37" height="29"></a></li>
                                <?php } else if ($media['media_type'] == 'video') {
                                    ?>
                                    <li><a class="bb_active loadMainVideoMedia" data-ext="<?php echo $ext; ?>" data-src="<?php echo $mediaSrc; ?>" href="javascript:void(0);"><video class="media br5" height="29" width="37"><source src="<?php echo $mediaSrc; ?>" type="video/<?php echo $ext; ?>"></video></a></li>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </ul>
                <?php else: ?>

                    <!--<ul class="image_pagination">
                        <li><a class="bb_active" href="#"><img src="<?php echo base_url("assets/images/media_img4.jpg"); ?>" width="37" height="29"></a></li>
                        <li><a href="#"><img src="<?php echo base_url("assets/images/media_img5.jpg"); ?>" width="37" height="29"></a></li>
                        <li><a href="#"><img src="<?php echo base_url("assets/images/media_img6.jpg"); ?>" width="37" height="29"></a></li>
                    </ul> -->
                <?php endif; ?>
                <div class="interactions p0 pull-left">
                    <ul>
                        <li><i class="icon-user"></i><strong><?php echo $oQuestion->firstname . " " . $oQuestion->lastname; ?></strong></li>
                        <li><i class="icon-envelop2"></i><strong><?php echo $oQuestion->email; ?></strong></li>
                        <li><i class="icon-iphone"></i><strong><?php echo $oQuestion->phone == '' ? displayNoData() : mobileNoFormat($oSubscriber->phone); ?></strong></li>
                        <li><i class="icon-calendar"></i><strong><?php echo dataFormat($oQuestion->created); ?></strong></li>
                    </ul>
                </div>

                <?php if ($totalMedia > 3) {
                    ?>
                    <div class="clearfix"></div>
                    <div class="pull-left">
                        <a href="<?php echo base_url("admin/questions/details/{$oQuestion->id}"); ?>"> <span class="label bkg_grey txt_white br5"> View more</span></a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>     
    </div>    

    <ul class="nav nav-tabs nav-tabs-bottom">
        <li class="<?php if (empty($selectedTab) || $selectedTab == 'undefined' || $selectedTab == 'question'): ?>active<?php endif; ?>"><a href="#smartQuestionTab" data-toggle="tab">Question</a></li>
        <li class="<?php if ($selectedTab == 'notes'): ?>active<?php endif; ?>"><a href="#smartNotesTab" data-toggle="tab">Notes</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane <?php if (empty($selectedTab) || $selectedTab == 'undefined' || $selectedTab == 'question'): ?>active<?php endif; ?>" id="smartQuestionTab">
            <div>
                <div class="bbot p30">
                    <p class="mb20 txt_grey2 fsize13 lh24"><?php echo $questionTitle != '' ? $questionTitle : displayNoData(); ?></p>
                    <?php if (!empty($questionDescription)): ?>
                        <p class="mb0 fsize13">
                            <?php echo $questionDescription; ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($oAnswers)) { ?>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Latest Answers <?php echo count($oAnswers) > 0 ? '(' . count($oAnswers) . ')' : 0; ?></h6>
                            <div class="heading-elements">
                                <div class="table_action_tool">
                                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body p0" style="box-shadow:none !important;">
                            <div class="comment_sec">
                                <ul class="addMoreComment">
                                    <?php
                                    //pre($oAnswers);
                                    if (!empty($oAnswers)) {

                                        foreach ($oAnswers as $oAnswer) {
                                            $defaultAvatar = base_url() . "assets/images/userp.png";
                                            $avtarImage = $oAnswer->avatar == 'avatar_image.png' ? $defaultAvatar : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oAnswer->avatar;
                                            $aHelpful = $this->mQuestion->countAnsHelpful($oAnswer->id);
                                            ?>
                                            <li class="bbot">

                                                <div class="media-left"><?php echo showUserAvtar($oAnswer->avatar, $oAnswer->firstname, $oAnswer->lastname); ?></div>

                                                <div class="media-left pr0 w100">

                                                    <p class="fsize14 txt_grey2 lh14 mb-15 "><?php echo $oAnswer->firstname . ' ' . $oAnswer->lastname; ?> <span class="dot">.</span> <?php echo timeAgo($oAnswer->created); ?> <span class="dot">.</span> 

                                                        <?php if ($oAnswer->status == '1') { ?>
                                                            <span class="txt_green"><i class="icon-checkmark3 fsize12 txt_green" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"></i> Approve</span>
                                                        <?php } ?>
                                                        <?php if ($oAnswer->status == 0) { ?>

                                                            <span class="txt_red"><i class="icon-checkmark3 fsize12 txt_red" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"></i> Disapproved</span>

                                                        <?php } ?>
                                                        <?php if ($oAnswer->status == '2') { ?>
                                                            <span class="media-annotation"> <span class="label bkg_grey txt_white br5 chg_smart_status addtag" style="cursor: pointer;" change_status="1" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"> Approve</span> </span>
                                                            <span class="media-annotation dotted"> <span class="label bkg_red txt_white br5 chg_smart_status addtag" style="cursor: pointer;" change_status="0" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"> Disapprove</span> </span>
                                                        <?php } ?>
                                                    </p>

                                                    <p class="fsize13 mb10 lh23 txt_grey2">
                                                        <?php echo ($oAnswer->answer) ? nl2br(base64_decode($oAnswer->answer)) : 'N/A'; ?></p>

                                                    <div class="button_sec">
                                                        <!-- <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                        <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-down2 txt_red"></i></a> -->
                                                        <a  href="javascript:void(0);" class="btn comment_btn txt_purple editSmartAnswer" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>">Edit</a>
                                                        <a  href="javascript:void(0);" class="btn comment_btn txt_purple deleteSmartAnswer" smart_answer_id="<?php echo base64_url_encode($oAnswer->id); ?>">Delete</a>
                                                    </div>



                                                </div>
                                            </li>

                                            <?php
                                        }
                                    }
                                    ?>

                                </ul>

                                <?php if ($totalComment > 5) {
                                    ?>
                                    <input type="hidden" id="numOfComment" value="5">
                                    <div class="loadMoreRecord text-center"><a style="cursor: pointer;" id='loadSmartMoreComment' revId="<?php echo $reviewData->id; ?>">Load more</a><img class="loaderImage hidden" height="20px" width="20px" src="<?php echo base_url(); ?>assets/images/widget_load.gif"></div><?php }
                                ?>

                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>

            <form method="post" class="form-horizontal" id="addSmartAnswer" action="javascript:void();">
                <div class="smartStickyFooter">
                    <div class="box_heading bbot ">
                        <p class="fsize14 fw500 m0">Add Answer</p>
                    </div>
                    <div class="p20">
                        <textarea name="txtAnswer" id="txtAnswer" required class="form-control addnote" placeholder="Start typing to leave your answer..."></textarea>
                    </div>
                </div>

                <div class="box_footer_btn">
                    <div class="p30">
                    <input type="hidden" id="smartpopup_question_id" name="question_id" value="<?php echo base64_url_encode($oQuestion->id); ?>">
                    <button type="submit" class="btn dark_btn mr20 bkg_purple">Add Answer</button>
                    <a href="mailto:<?php echo $oQuestion->email; ?>" class="btn dark_btn mr20 bkg_purple">Send Email</a>
                    <?php if (!empty($oSubscriber->phone)): ?>
                        <button type="button" class="btn dark_btn mr20 bkg_purple open-smart-sms-chat" <?php if ($subscriberID > 0): ?> smart-subs-id="<?php echo $subscriberID; ?>" <?php endif; ?>>Send SMS</button>
                    <?php endif; ?>
                    </div>    
                </div>
            </form>


        </div>
        <div class="tab-pane <?php if ($selectedTab == 'notes'): ?>active<?php endif; ?>" id="smartNotesTab">
            <div class="p30">
                <?php
                if (!empty($oNotes)) {
                    foreach ($oNotes as $key => $noteData) {
                        ?>
                        <p class="mb20 pb20 txt_grey2 fsize13 lh24 bbot">
                            <?php echo $noteData->notes; ?>
                            <span class="pull-right">
                                <a href="javascript:void(0)" class="editSmartNote" noteid="<?php echo $noteData->id; ?>" questionid="<?php echo $oQuestion->id; ?>"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
                                <a href="javascript:void(0)" class="deleteSmartNote" noteid="<?php echo $noteData->id; ?>" questionid="<?php echo $oQuestion->id; ?>"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>
                            </span>
                            <br>
                            <small class="text-muted">On <?php echo date('F d, Y h:i A', strtotime($noteData->created)); ?> by <?php echo $noteData->firstname . ' ' . $noteData->lastname; ?></small>
                        </p>    

                        <?php
                    }
                } else {
                    echo '<p class="mb20 txt_grey2 fsize13 lh24">' . displayNoData() . '</p>';
                }
                ?>

            </div>


            <form method="post" class="form-horizontal" id="frmSmartSaveNote">
                <div class="smartStickyFooter">
                    <div class="box_heading bbot ">
                        <p class="fsize14 fw500 m0">Add Notes</p>
                    </div>
                    <div class="p20">
                        <textarea name="notes" id="notes" required class="form-control p0 addnote" placeholder="Start typing to add note..."></textarea>
                    </div>
                </div>

                <div class="box_footer_btn">
                    <div class="p30">
                    <input type="hidden" name="question_id" id="questionid" value="<?php echo base64_url_encode($oQuestion->id); ?>">
                    <input type="hidden" name="cid" id="cid" value="<?php echo $userID; ?>">
                    <input type="hidden" name="bid" id="bid" value="<?php echo $brandboostID; ?>">
                    <button type="submit" class="btn dark_btn mr20 bkg_purple">Save Note </button>
                    <a href="mailto:<?php echo $oQuestion->email; ?>" class="btn dark_btn mr20 bkg_purple">Send Email</a>
                    <?php if (!empty($oSubscriber->phone)): ?>
                        <button type="button" class="btn dark_btn mr20 bkg_purple open-smart-sms-chat" <?php if ($subscriberID > 0): ?> smart-subs-id="<?php echo $subscriberID; ?>" <?php endif; ?>>Send SMS</button>
                            <?php endif; ?>
                    </div>    
                </div>
            </form>


        </div>

    </div> 
</div>    


<script>

    $(document).ready(function () {
        $(".open-smart-sms-chat").click(function () {
            var subsID = $(this).attr("smart-subs-id");
            if (subsID > 0) {
                $("#sidebar-user-box-sms-" + subsID).trigger("click");
            }

        });

        //        $(".enlarge").hover(function () {
        //            $(this).addClass('media-expand')
        //        }, function () {
        //            $(this).removeClass('media-expand');
        //        });

        $(".enlarge").click(function () {
            $(this).toggleClass('media-expand');
        });

        $("#addSmartAnswer").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            formData.append('_token', '{{csrf_token()}}');
            var questionID = $("#smartpopup_question_id").val();
            $.ajax({
                url: '<?php echo base_url("admin/questions/add_answer"); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = '';
                        $('.overlaynew').hide();
                        loadQuestionSmartPopup(questionID, 'question');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(".loadMainImageMedia").click(function () {
            var mediasource = $(this).attr('src');
            $('.big_img').empty();
            $('.big_img').html('<img class="bb_img_enlagre" src="' + mediasource + '"><div class="caption-overflow smallovfl"><a class="preview_img_src" href="' + mediasource + '" data-popup="lightbox"><i class="icon-eye"></i></a></div>');

        });

        $(".loadMainVideoMedia").click(function () {
            var mediasource = $(this).attr('data-src');
            var mediaExtension = $(this).attr('data-ext');
            $('.big_img').empty();
            $('.big_img').html('<video class="media br5 " height="100%" width="100%"><source id="bb_video_enlarge" src="' + mediasource + '" type="video/mp4"></video><div class="caption-overflow smallovfl"><a class="preview_video_src" style="cursor: pointer;" filepath="' + mediasource + '" fileext="' + mediaExtension + '"><i class="icon-eye"></i></a></div>');

        });



    });





</script>