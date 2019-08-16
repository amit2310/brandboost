@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php
$questionTitle = $oQuestion->question_title;
$questionDescription = $oQuestion->question;
?>
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
</style>	

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3 class="mt30"><img style="width: 18px;" src="<?php echo base_url(); ?>assets/images/review_icon.png"/> Question Details</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <button type="button" class="btn dark_btn dropdown-toggle ml10" id="addAnswerFromPopup"><i class="icon-plus3"></i><span> &nbsp;Add Answer</span> </button>
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
                        $mediaArray = unserialize($oQuestion->media_url);
                        if(!empty($mediaArray)) {
                        foreach ($mediaArray as $media) {
                            if ($media['media_type'] == 'image') {
                                $media_url = $media['media_url'];
                                $videoImage = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $media_url;
                                $ext = pathinfo($videoImage, PATHINFO_EXTENSION);
                                $ch = curl_init($videoImage);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($ch, CURLOPT_HEADER, TRUE);
                                curl_setopt($ch, CURLOPT_NOBODY, TRUE);
                                $data = curl_exec($ch);
                                $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
                                curl_close($ch);
                                //$getFileSize = FileSizeConvert($fileSize);
								$getFileSize = '';
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
                                        <div class="text-muted text-size-small"><?php echo '.' . strtoupper($ext); ?></div>
                                    </div>
                                </div>

                                <?php
                            } else {
                                $media_url = $media['media_url'];
                                $videoImage = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $media_url;
                                $ext = pathinfo($videoImage, PATHINFO_EXTENSION);
                                $ch = curl_init($videoImage);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($ch, CURLOPT_HEADER, TRUE);
                                curl_setopt($ch, CURLOPT_NOBODY, TRUE);
                                $data = curl_exec($ch);
                                $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
                                curl_close($ch);
                                //$getFileSize = FileSizeConvert($fileSize);
								$getFileSize = '';
                                ?>


                                <div class="p25 bbot">
                                    <div class="media-left media-middle pr40"> 
                                        <a class="videoQuestion" style="cursor: pointer;" filepath="<?php echo $videoImage; ?>" fileext="<?php echo $ext; ?>">
                                            <img src="<?php echo base_url(); ?>assets/images/media2.jpg"/></a>
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
                                        <div class="text-muted text-size-small"><?php echo '.' . strtoupper($ext); ?></div>
                                    </div>
                                </div> 
                                <?php
                            }
                        }
                    }
                    else 
                    {
                        ?><div class="p25 bbot"><span><i>No Image found</i></span></div><?php
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
                            if (!empty($oTags)) {
                                foreach ($oTags as $oTag) {
                                    ?>
                                    <button class="btn btn-xs btn_white_table"><?php echo $oTag->tag_name; ?></button>
                                    <?php
                                }
                            }
                            ?>
                            <?php if (empty($oTags)): ?><span><i>No Tags found</i></span>&nbsp;<?php endif; ?> <button type="button" class="btn btn-xs plus_icon applyInsightTags" question_id="<?php echo base64_url_encode($oQuestion->id); ?>" action_name="question-tag"><i class="icon-plus3"></i></button>

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
                    <h6 class="panel-title">Question</h6>
                    <div class="heading-elements">
                        <div class="table_action_tool">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p30 br0">
                    <strong><?php echo $questionTitle; ?></strong>
                    <p class="fsize13 mb20 lh25 txt_grey2"><?php echo $questionDescription; ?></p>

                    <?php
                    $defaultAvatar = base_url() . "assets/images/userp.png";
                    if ($oQuestion->avatar) {
                        $avatarImage = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/profile_image_9672_e3abdb9b595bb7fd46f89f7716447f38266ef481.jpg";
                    } else {
                        $avatarImage = $defaultAvatar;
                    }
                    ?> 
                    <div class="media-left media-middle pr10"> <a class="icons" href="#"><img onerror="this.src='<?php echo $defaultAvatar; ?>';" style="width: 18px;" src="<?php echo $avatarImage; ?>" class="img-circle" alt=""></a> </div>
                    <div class="media-left">
                        <div class="text-muted">by <?php echo $oQuestion->firstname . " " . $oQuestion->lastname; ?>   <span class="ml20"><i class="icon-checkmark3 fsize12 txt_green"></i>&nbsp; Verified Purchase</span></div>
                    </div>



                </div>
                <div class="panel-footer p20 pl30 pr30 ">
                    <p class="mb0 fsize13">
                        <span class="ml20"><i class="icon-comment fsize11 txt_purple"></i> &nbsp; <?php echo (count($oAnswers)) > 0 ? count($oAnswers) . ' Answers' : '0 Answers'; ?></span>
                    </p>
                </div>
            </div>
            <!--=========Latest Comments===========-->
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
                    <div class="panel-body p0">
                        <div class="comment_sec">
                            <ul class="addMoreComment">
                                <?php
                                //pre($oAnswers);
                                if (!empty($oAnswers)) {

                                    foreach ($oAnswers as $oAnswer) {
                                        $defaultAvatar = base_url() . "assets/images/userp.png";
                                        $avtarImage = $oAnswer->avatar == 'avatar_image.png' ? $defaultAvatar : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oAnswer->avatar;
										$aHelpful = \App\Models\Admin\QuestionModel::countAnsHelpful($oAnswer->id);
                                        ?>
                                        <li class="bbot">

                                            <div class="media-left"><img onerror="this.src='<?php echo $defaultAvatar; ?>'" width="36" src="<?php echo $avtarImage; ?>"/></div>

                                            <div class="media-left pr0 w100">

                                                <p class="fsize14 txt_grey2 lh14 mb-15 "><?php echo $oAnswer->firstname . ' ' . $oAnswer->lastname; ?> <span class="dot">.</span> <?php echo timeAgo($oAnswer->created); ?> <span class="dot">.</span> 

                                                    <?php if ($oAnswer->status == '1') { ?>
                                                        <span class="txt_green"><i class="icon-checkmark3 fsize12 txt_green" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"></i> Approve</span>
                                                    <?php } ?>
                                                    <?php if ($oAnswer->status == 0) { ?>

                                                        <span class="txt_red"><i class="icon-checkmark3 fsize12 txt_red" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"></i> Disapproved</span>

                                                    <?php } ?>
                                                    <?php if ($oAnswer->status == '2') { ?>
                                                        <span class="media-annotation"> <span class="label bkg_grey txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="1" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"> Approve</span> </span>
                                                        <span class="media-annotation dotted"> <span class="label bkg_red txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="0" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>"> Disapprove</span> </span>
                                                    <?php } ?>
                                                </p>

                                                <p class="fsize13 mb10 lh23 txt_grey2">
                                                    <?php echo ($oAnswer->answer) ? nl2br(base64_decode($oAnswer->answer)) : 'N/A'; ?></p>

                                                <div class="button_sec">
                                                    <!-- <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                    <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-down2 txt_red"></i></a> -->
													<div style="margin-bottom:10px; color:#888;"><?php echo $aHelpful['yes']; ?> Found this helpful</div>
                                                    <a  href="javascript:void(0);" class="btn comment_btn txt_purple editAnswer" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>">Edit</a>
                                                    <a  href="javascript:void(0);" class="btn comment_btn txt_purple deleteAnswer" answer_id="<?php echo base64_url_encode($oAnswer->id); ?>">Delete</a>
                                                </div>



                                            </div>
                                        </li>

                                        <?php
                                    }
                                }
                                ?>

                            </ul>

                            <?php /* if ($totalComment > 5) {
                                ?>
                                <input type="hidden" id="numOfComment" value="5">
                                <div class="loadMoreRecord"><a style="cursor: pointer;" id='loadMoreComment' revId="<?php echo $reviewData->id; ?>">Load more</a><img class="loaderImage hidden" height="20px" width="20px" src="<?php echo base_url(); ?>assets/images/widget_load.gif"></div><?php } */
                            ?>

                        </div>
                    </div>

                </div>
            <?php } ?>
            <!--=========Add Comment===========-->
            <form method="post" class="form-horizontal" id="addAnswer" action="javascript:void();">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Add Answer</h6>
                        <div class="heading-elements">
                            <div class="table_action_tool">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body br0">

                        <textarea name="txtAnswer" id="txtAnswer" required class="form-control addnote" placeholder="Start typing to leave your answer..."></textarea>
                    </div>
                    <div class="panel-footer p20 text-right">
                        <a style="cursor: pointer;"><i class="icon-hash text-muted"></i></a> &nbsp; &nbsp; <a style="cursor: pointer;"><i class="icon-reset text-muted"></i></a>
                        <input type="hidden" id="question_id" name="question_id" value="<?php echo base64_url_encode($oQuestion->id); ?>">
                        <button type="submit" class="btn dark_btn btn-xs ml20">Add Answer</button>
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
                            <li><small>Name</small> <strong><?php echo $oQuestion->firstname . ' ' . $oQuestion->lastname; ?>  </strong></li>
                            <li><small>Email</small> <strong><?php echo $oQuestion->email; ?></strong></li>
                            <li><small>Phone</small> <strong><?php echo ($oQuestion->mobile) ? $oQuestion->mobile : 'N/A'; ?></strong></li>
                            <li><small>Notification</small> <strong><?php echo ($oQuestion->system_notify) ? 'On' : 'Off'; ?></strong></li>
                            <li><small>Id</small> <strong><?php echo $oQuestion->user_id; ?></strong></li>
                            <li><small>Emails</small> <strong><?php echo ($oQuestion->email_notify) ? 'On' : 'Off'; ?></strong></li>
                            <li><small>SMS</small> <strong><?php echo ($oQuestion->email_notify) ? 'On' : 'Off'; ?></strong></li>
                        </ul>
                    </div>
                    <div class="profile_headings">Question Notes <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a></div>
                    <?php
                    if (!empty($oNotes)) {
                        foreach ($oNotes as $oNote) {
                            ?>
                            <div class="p25 bbot">
                                <p class="fsize12"><?php echo $oNote->notes; ?></p>
                                <p><small class="text-muted">On <?php echo date('F d, Y h:i A', strtotime($oNote->created)); ?> <br>by <?php echo $oNote->firstname . ' ' . $oNote->lastname; ?></small></p>
                                <div class="text-right">
                                    <a href="javascript:void(0)" class="editNote" noteid="<?php echo $oNote->id; ?>"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
                                    <a href="javascript:void(0)" class="deleteNote" noteid="<?php echo $oNote->id; ?>"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>
                                </div>
                            </div>
                            <?php
                        }
                    }else{
                        echo '<div class="p25 bbot"><i>No Notes Available</i></div>';
                    }
                    ?>


                    <div class="p25 btop">
                        <button class="btn dark_btn btn-xs mr20" data-toggle="modal" data-target="#addnotes">Add Note</button>	 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================================= CONTENT AFTER TAB===============================-->
</div>

<div id="videoQuestionModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Video question</h5>
            </div>
            <div class="modal-body" id="vQuestion">
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

<div id="addAnswerPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addAnswerPopup" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Answer</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <strong>Question: <?php echo $questionTitle; ?></strong>
                        <p class="fsize13 mb20 lh25 txt_grey2"><?php echo $questionDescription; ?>
                        </p>
                        <label class="control-label col-lg-3">Answer</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="6"  placeholder="Leave Answer" name="txtAnswer" required ></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="question_id" name="question_id" value="<?php echo base64_url_encode($oQuestion->id); ?>">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn dark_btn"><i class="icon-check"></i> Add Answer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editAnswer" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateAnswer" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Answer</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Answer</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="8"  placeholder="Leave Answer" name="txtAnswer" id="edit_answer" required ></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="answerId" id="edit_answer_id" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn dark_btn"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editNoteSection" class="modal fade" style="z-index:99999;">
    {{ csrf_field() }}
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
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add Question Notes</h5>
            </div>
            <div class="modal-body">
                <div class="row">

                    <form method="post" class="form-horizontal" id="frmSaveNote" action="javascript:void();">
                        <div class="col-md-12 mb-15">
                            <textarea class="form-control" name="notes" style="padding: 20px; height: 75px;" placeholder="Add Note"></textarea>
                        </div>
                        <div class="col-md-12 text-right ">
                            <input type="hidden" name="question_id" id="notes_question_id" value="<?php echo base64_url_encode($oQuestion->id); ?>">
                            <input type="hidden" name="cid" id="cid" value="<?php echo $userID; ?>">
                            <input type="hidden" name="bid" id="bid" value="<?php echo $brandboostID; ?>">
                            <button data-toggle="modal" data-target="#addnotes" type="button" id="saveQuestionNotes" class="btn dark_btn"> Add Notes &nbsp; <i class="fa fa-angle-double-right"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="editNoteSection" class="modal fade" style="z-index:99999;">
    {{ csrf_field() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateNote" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Notes</h5>
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

<div id="QuestionTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmQuestionTagListModal" id="frmQuestionTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireList"></div>
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="question_id" id="tag_question_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>

    $(document).ready(function () {

        $(function () {
            $('.thumbnail2').viewbox();
        });

        $(document).on('click', '.videoQuestion', function () {
            var filepath = $(this).attr('filepath');
            var fileext = $(this).attr('fileext');
            $('#vQuestion video source').attr('src', filepath);
            $('#vQuestion video source').attr('type', 'video/' + fileext);
            $("#vQuestion video")[0].load();
            $('#videoQuestionModal').modal();

        });


        $("#addAnswerFromPopup").click(function () {
            $("#addAnswerPopup").modal();
        });
        $("#addAnswer, #addAnswerPopup").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/questions/add_answer'); ?>',
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

        $(document).on('click', '.editAnswer', function () {
            var answerID = $(this).attr('answer_id');
            $.ajax({
                url: '<?php echo base_url('admin/questions/getAnswer'); ?>',
                type: "POST",
                data: {answerID: answerID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('#edit_answer').val(data.answer);
                        $('#edit_answer_id').val(answerID);
                        $("#editAnswer").modal();
                    } else {

                    }
                }
            });
        });

        $("#updateAnswer").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '<?php echo base_url('admin/questions/updateAnswer'); ?>',
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


        $(document).on('click', '.deleteAnswer', function () {
            var answerId = $(this).attr('answer_id');
            swal({
                title: "Are you sure? You want to delete this record!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
			function (isConfirm) {
				if (isConfirm) {
					$('.overlaynew').show();
					$.ajax({
						url: '<?php echo base_url('admin/questions/delete_answer'); ?>',
						type: "POST",
						data: {answerId: answerId, _token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = window.location.href;
							} else {
								$('.overlaynew').hide();
								alertMessage('Error: Some thing wrong!');
							}
						},
						error: function () {
							$('.overlaynew').hide();
							alertMessage('Error: Some thing wrong!');
						}
					});
				}
			});
        });
        
        $(document).on('click', '.chg_status', function () {
            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var answer_id = $(this).attr('answer_id');

            $.ajax({
                url: '<?php echo base_url('admin/questions/update_answer_status'); ?>',
                type: "POST",
                data: {status: status, answer_id: answer_id, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on("click", ".applyInsightTags", function () {
            var question_id = $(this).attr("question_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/tags/listAllTags'); ?>',
                type: "POST",
                data: {question_id: question_id, _token: '{{csrf_token()}}'},
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
                        $("#tag_question_id").val(question_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModal").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModal").modal("show");
                        } else if (action_name == 'question-tag') {
                            $("#QuestionTagListModal").modal("show");
                        }
                    }
                }
            });
        });

        $("#frmQuestionTagListModal").submit(function () {
            var formdata = $("#frmQuestionTagListModal").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyQuestionTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#frmQuestionTagListModal").modal("hide");
                        $('.overlaynew').hide();
                        window.location.href = '';
                    }
                }
            });
            return false;
        });


        $(document).on("click", "#saveQuestionNotes", function () {
            var formdata = $("#frmSaveNote").serialize();
            formdata += '&_token={{csrf_token()}}';
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('admin/questions/saveQuestionNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        $('.overlaynew').hide();
                        window.location.href = '';
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });
        
        $(document).on('click', '.editNote', function () {
            $('.overlaynew').show();
            var noteId = $(this).attr('noteid');
            $.ajax({
                url: '<?php echo base_url('admin/questions/getQuestionNotes'); ?>',
                type: "POST",
                data: {noteid: noteId, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var noteData = data.result;
                        $('#edit_note_content').val(noteData.notes);
                        $('#edit_noteid').val(noteData.id);
                        $("#editNoteSection").modal();
                        $('.overlaynew').hide();
                    } else {

                    }
                }
            });
        });
        
        
        $("#updateNote").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            formData.append('_token','{{csrf_token()}}');
            $.ajax({
                url: '<?php echo base_url('admin/questions/updateQuestionNote'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#editNoteSection").modal('hide');
                        $('.overlaynew').hide();
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
        
        $(document).on('click', '.deleteNote', function () {
            var noteId = $(this).attr('noteid');
            swal({
                title: "Are you sure? You want to delete this record!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
			function (isConfirm) {
				if (isConfirm) {
					$('.overlaynew').show();
					$.ajax({
						url: '<?php echo base_url('admin/questions/deleteQuestionNote'); ?>',
						type: "POST",
						data: {noteid: noteId, _token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							} else {
								$('.overlaynew').hide();
								alertMessage('Error: Some thing wrong!');
							}
						},
						error: function () {
							$('.overlaynew').hide();
							alertMessage('Error: Some thing wrong!');
						}
					});
				}
			});
        });
    });
</script>

@endsection