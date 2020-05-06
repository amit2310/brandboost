<template>

    <div class="content" id="masterContainer">

        <div class="row">
            <div class="col-md-12">
                <div class="white_box profile_sec mb20">
                    <div class="backbtn">
                        <a href="#/user/profile"><img
                            src="/assets/profile_images/back_40.png"></a>
                    </div>

                    <div class="p25 bbot text-center">
                        <h3>My Reviews ({{myReview.length}})</h3>
                        <p>Basic information that you use in BrandBoost services.</p>
                    </div>

                    <div class="p20">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="tdropdown ml0"><a style="margin:0!important;"
                                                              class ="dropdown-toggle fsize12 txt_grey"
                                                              data-toggle="dropdown" aria-expanded="false"><img
                                    style="float: left; margin: 6px 5px 0 0;" class="small"
                                    src="/assets/images/cd_icon1.png"> &nbsp; All reviews
                                    ( {{ myReview.length }} ) <i class="icon-arrow-down22"></i></a>
                                    <ul style="right: 0px!important; margin-top: 15px; left: 0px;"
                                        class="dropdown-menu dropdown-menu-left chat_dropdown">
                                        <li><strong><a class="active" style="cursor: pointer;"><img class="small"
                                                                                                    src="/assets/images/cd_icon1.png">All
                                            ({{ myReview.length }}) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="/assets/images/cd_icon2.png">Open
                                            (13) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="/assets/images/cd_icon3.png">Resolved
                                            (172) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="/assets/images/cd_icon4.png">Favorite
                                            (5) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="/assets/images/cd_icon5.png">Snoozed
                                            (28)</a></strong></li>
                                    </ul>
                                </div>
                            </div>
                             <div class="col-md-6 col-sm-6 col-xs-6">
                                 <div class="tdropdown ml0 pull-right"><a style="margin:0!important;"
                                                                          class="dropdown-toggle fsize12 txt_grey"
                                                                          data-toggle="dropdown" aria-expanded="false">
                                     Sort by date <i class="icon-arrow-down22"></i></a>
                                     <ul style="right: 0px!important; margin-top: 15px; left: auto;"
                                         class="dropdown-menu dropdown-menu-left chat_dropdown">
                                         <li><strong><a class="active" style="cursor: pointer;"><img class="small"
                                                                                                     src="/assets/images/cd_icon1.png">All
                                             ( {{ myReview.length }} ) </a></strong></li>
                                         <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                      src="/assets/images/cd_icon2.png">Open
                                             (13) </a></strong></li>
                                         <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                      src="/assets/images/cd_icon3.png">Resolved
                                             (172) </a></strong></li>
                                         <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                      src="/assets/images/cd_icon4.png">Favorite
                                             (5) </a></strong></li>
                                         <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                      src="/assets/images/cd_icon5.png">Snoozed
                                             (28)</a></strong></li>
                                     </ul>
                                 </div>
                              </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div v-if="myReview.length > 0" class="row profile_media_outer ">
            <div class="col-md-3">
                <table style="width: 100%;">

                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th class="nosort" style="display: none;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(review, index) in myReview">
                        <td style="display: none;">
                            {{ index }}
                        </td>
                        <td>

                            <!--================Review 1=================-->

                            <div class="white_box p0" :id="`review${review.id}`">
                                <div class="bb_rw01">
                                    <div class="bb_white_box">
                                        <div class="review_edit">
                                            <a :href="`#/user/review/edit/${review.id}`"
                                               style="cursor:pointer;"><img
                                                src="/assets/profile_images/edit_40.png"/></a>
                                        </div>

                                        <div class="bb_comment_header">
                                            <div class="bb_avatar01"><i class="fa bb_check_green">
                                                <!-- fa-check-circle --></i><!--  <img src="{{ $profileImg }}"> -->
                                                <div class="media-left media-middle pr10">
                                                    <user-avatar
                                                        :avatar="review.avatar"
                                                        :firstname="review.firstname"
                                                        :lastname="review.lastname"
                                                        :width="80"
                                                        :height="40"
                                                        :fontsize="12"
                                                    ></user-avatar>
                                                </div>
                                            </div>
                                            <div class="bb_fleft">
                                                <p class="bb_para">
                                                    <strong>{{ review.firstname }} {{ review.lastname }}</strong>
                                                </p>
                                                <p v-if="review.ratings > 0" class="bb_para">

                                                    <i v-for="rating in review.ratings" class="fa fa-star fsize12 txt_yellow"></i>

                                                    <i v-for="rating in (5-review.ratings)" class="fa fa-star fsize12 txt_grey"></i>

                                                    <span class="bb_thingrey">{{ review.ratings }}/5</span>
                                                </p>
                                            </div>

                                           <!-- <div class="bb_fleft">
                                                <p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span>
                                                    <span class="bb_thingrey"> {{ capitalizeFirstLetter(review.review_type) }} -
                                                            <span v-if="review.aReviewData.product_data.product_name !== ''">{{ review.aReviewData.product_data.product_name }}</span>
                                                            <span v-else>{{ review.aReviewData.brand_title }}</span>
                                                        </span>
                                                </p>
                                                <p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span>
                                                    <span
                                                        class="bb_thingrey">{{ displayDateFormat(review.created) }}</span>
                                                </p>
                                            </div>-->
                                            <div class="bb_clear"></div>
                                        </div>

                                        <div class="bb_pad25">
                                            <p class="bb_para heading_txt">{{ review.review_title }}<!-- Widget heading text... --></p>
                                            <p class="bb_para">{{ review.comment_text }}<!-- But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. --></p>
                                        </div>
                                        <div class="bb_comment_area">
                                            <a style="cursor: pointer;" class="comment_show"><i><img
                                                src="/assets/images/widget/comment_icon_grey.png"
                                                width="15"></i>
                                                &nbsp; {{ review.comment_block > 0 ? review.comment_block : '0' }}
                                                Comments</a>

                                            <span class="`review_helpful_${review.id} `">{{ (review.aReviewData.index.total_helpful) ? review.aReviewData.index.total_helpful : 0 }} Found this helpful</span>

                                            <span class="ml-10">
                                                    <a style="cursor: pointer;"
                                                       class="pw_helpful_action bb_show_like_value bb_txt_green bb_like_dislike" action-name="Yes"
                                                       :review-id="review.id"><i class="fa fa-thumbs-up   brand_thumbs br5 mr-5"></i></a>
                                                    <a style="cursor: pointer;"
                                                       class="pw_helpful_action bb_show_dis_like_value bb_txt_red bb_like_dislike" action-name="No"
                                                       :review-id="review.id"><i class="fa fa-thumbs-down   brand_thumbs br5"></i></a>
                                                </span>

                                            <a class="bb_fright" style="cursor: pointer;"><i><img
                                                src="/assets/profile_images/shareicon.png"
                                                width="15"></i> &nbsp; Share</a>
                                        </div>

                                        <!-- **********Comment area********* -->
                                        <div class="p20 pt0 commentarea">
                                            <div v-if="review.reviewCommentsData" class="commentarea_inner p0">
                                                <div v-for="comment in review.reviewCommentsData" class="bbot pb20 mb20" :id="`parComment${comment.id}`">
                                                    <div class="comment_sec">
                                                        <ul>
                                                            <li class="bbot">
                                                                <div
                                                                    class="media-left">
                                                                    <div
                                                                        class="media-left media-middle pr10 commentPar">
                                                                        <user-avatar
                                                                            :avatar="comment.avatar"
                                                                            :firstname="comment.firstname"
                                                                            :lastname="comment.lastname"
                                                                            :width="32"
                                                                            :height="32"
                                                                            :fontsize="12"
                                                                        ></user-avatar>
                                                                    </div>
                                                                </div>
                                                                <div class="media-left pr0">
                                                                    <p class="fsize14 txt_grey2 lh14 mb-15 ">{{ comment.firstname }} {{ comment.lastname }}
                                                                        <span
                                                                            class="dot">.</span> {{ displayDateFormat('M d, h:i A', comment.created) }}
                                                                        <span class="dot">.</span>
                                                                        <span v-if="comment.status == '1'" class="txt_green"><i
                                                                            class="icon-checkmark3 fsize12 txt_green"></i> Approve</span>
                                                                        <span v-else class="txt_yellow"><i
                                                                            class="icon-checkmark3 fsize12 txt_yellow"></i> Pending</span>
                                                                    </p>
                                                                    <p class="fsize13 mb10 lh23 txt_grey2">
                                                                        {{ comment.content != '' ? comment.content : 'N/A' }}
                                                                    </p>

                                                                    <div class="button_sec">
                                                                        <button
                                                                            class="btn btn-link pl0 txt_green">{{ comment.likeData.length }}</button>
                                                                        <a class="btn comment_btn p7"
                                                                           href="javascript:void(0);"
                                                                           @click="saveCommentLikeStatus(comment.id, '1')"><i
                                                                            class="icon-thumbs-up2 txt_green"></i></a>
                                                                        <!--  <button class="btn btn-link pl0 txt_red">{{ count($disLikeData) }}</button> -->
                                                                        <a class="btn comment_btn p7"
                                                                           href="javascript:void(0);"
                                                                           @click="saveCommentLikeStatus(comment.id, '0')"><i
                                                                            class="icon-thumbs-down2 txt_red"></i></a>
                                                                        <a style="cursor: pointer;"
                                                                           class="btn comment_btn txt_purple replyCommentAction">Reply</a>

                                                                        <a v-if="comment.user_id" href="javascript:void(0);"
                                                                           class="btn comment_btn txt_purple editComment"
                                                                           :commentid="comment.id">Edit</a>

                                                                    </div>


                                                                    <div class="replyCommentBox"
                                                                         style="display:none;">
                                                                        <form method="post" class="form-horizontal"
                                                                              action="javascript:void();">
                                                                            <div class="mt10 mb10">
                                                                                    <textarea name="comment_content"
                                                                                              class="form-control comment_content"
                                                                                              style="padding: 15px; height: 75px;"
                                                                                              placeholder="Comment Reply..."
                                                                                              required></textarea>
                                                                            </div>

                                                                            <div class="text-right">
                                                                                <input name="reviweId"
                                                                                       class="reviweId"
                                                                                       :value="comment.review_id"
                                                                                       type="hidden">
                                                                                <input name="parent_comment_id"
                                                                                       class="parent_comment_id"
                                                                                       :value="comment.id"
                                                                                       type="hidden">
                                                                                <button style="width: 128px;"
                                                                                        type="button"
                                                                                        class="btn dark_btn addReplyComment">
                                                                                    Reply
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                    <!-- ******** comment child ********* -->
                                                                    <div v-for="childComment in comment.childComments" class="reply_sec mt30">
                                                                        <div
                                                                            class="media-left">
                                                                            <div
                                                                                class="media-left media-middle pr10 commentPar">
                                                                                <user-avatar
                                                                                    :avatar="childComment.avatar"
                                                                                    :firstname="childComment.firstname"
                                                                                    :lastname="childComment.lastname"
                                                                                    :width="32"
                                                                                    :height="32"
                                                                                    :fontsize="12"
                                                                                ></user-avatar>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-left pr0">
                                                                            <p class="fsize14 txt_grey2 lh14 mb10 ">{{ childComment.firstname }} {{ childComment.lastname }}
                                                                                <span
                                                                                    class="dot">.</span> {{ displayDateFormat('M d, h:i A', childComment.created) }}
                                                                            </p>
                                                                            <p class="fsize13 mb10 lh23 txt_grey2">
                                                                                {{ childComment.content != '' ? childComment.content : 'N/A' }}
                                                                            </p>

                                                                            <div class="button_sec">
                                                                                <button
                                                                                    class="btn btn-link pl0 txt_green">{{ childComment.likeChildData.length }}</button>
                                                                                <a href="javascript:void(0);"
                                                                                   @click="saveCommentLikeStatus(childComment.id, '1')"
                                                                                   class="btn comment_btn p7"><i
                                                                                    class="icon-thumbs-up2 txt_green"></i></a>
                                                                                <!-- <button class="btn btn-link pl0 txt_red">{{ count($disLikeChildData) }}</button> -->
                                                                                <a href="javascript:void(0);"
                                                                                   @click="saveCommentLikeStatus(childComment.id, '0')"
                                                                                   class="btn comment_btn p7"><i
                                                                                    class="icon-thumbs-down2 txt_red"></i></a>

                                                                                <a v-if="childComment.user_id" href="javascript:void(0);"
                                                                                   :commentid="childComment.id"
                                                                                   class="btn comment_btn txt_purple editComment">Edit</a>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <!-- ******** comment child end ********* -->

                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>

                                                <!--=========Add Comment===========-->
                                                <div class="p20">
                                                    <p><strong>Leave a comment</strong></p>
                                                    <form method="post" class="form-horizontal addComment"
                                                          action="#">
                                                        <div class="form-group mb20">
                                                            <label>Your Comment</label>
                                                            <textarea name="comment_content" id="comment_content"
                                                                      required class="form-control addnote"
                                                                      placeholder="Start typing to leave a comment..."></textarea>
                                                        </div>
                                                        <div class="form-group mb0 text-right">
                                                            <input type="hidden" name="reviweId" id="reviweId"
                                                                   :value="review.id">
                                                            <input type="submit" class="btn bkg_sblue txt_white"
                                                                   value="Submit"/>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--=========Add Comment end===========-->

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-else class="row profile_media_outer ">
            <div class="col-md-12 text-center">
                <ul class="nps_feedback">
                    <li>
                        No Review Found
                    </li>
                </ul>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'My Reviews - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {


                loading: true,
                breadcrumb: '',
                myReview: ''
            }
        },
        mounted() {
            this.loadData();

            console.log('Component mounted');
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/user/review')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.myReview = response.data.myReview;
                        console.log("----------"+this.myReview.length)
                    });
            }
        }
    }

    $(document).ready(function () {

        $(".comment_show").click(function () {
            $(this).parent().parent().find('.commentarea').slideToggle();
        });

        $(document).on('click', '.pw_helpful_action', function (e) {
            e.preventDefault();
            var actionName = $(this).attr('action-name');
            var reviewId = $(this).attr('review-id');

            $.ajax({
                url: "company/saveHelpful",
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                method: "POST",
                data: {action: actionName, review_id: reviewId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'ok') {
                        $('.review_helpful_' + reviewId).html(data.yes + ' Found this helpful');
                    }
                }
            });
        });

        $(".addComment").submit(function (e) {
            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: 'admin/comments/add_comment',
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

        $(document).on("click", ".replyCommentAction", function () {
            $(this).parent().next('.replyCommentBox').toggle('slow');
        });

        $(document).on('click', '.addReplyComment', function () {

            var reviewID = $(this).prev().prev().val();
            var parentCommentId = $(this).prev().val();
            var commentContent = $(this).parent().prev().find('.comment_content').val();
            if (commentContent != '') {
                $('.overlaynew').show();
                $.ajax({
                    url: 'admin/comments/add_comment',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    type: "POST",
                    data: {
                        'reviweId': reviewID,
                        'parent_comment_id': parentCommentId,
                        'comment_content': commentContent
                    },
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

        $(document).on('click', '.editComment', function () {
            var commentID = $(this).attr('commentid');
            $.ajax({
                url: 'admin/comments/getCommentById',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
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


        $("#updateComment").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: 'admin/comments/update_comment',
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
                    url: 'admin/comments/deleteComment',
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


    });


    function saveCommentLikeStatus(commentID, statusType) {
        $('.overlaynew').show();
        $.ajax({
            url: 'admin/reviews/saveCommentLikeStatus',
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
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
</script>
<style type="text/css">
    .icons.fl_letters {
        background-image: linear-gradient(259deg, #9b83ff, #6145d4) !important;
    }

    span.icons.fl_letters {
        width: 32px;
        height: 32px;
        box-shadow: none !important;
        background: #7a8dae;
        background-image: none;
        text-align: center;
        text-transform: uppercase;
        line-height: 32px;
        color: #fff;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 500;
        display: block;
    }

    .commentPar span.fl_letters {
        margin-top: 12px;
    }

    .review_edit {
        z-index: 9999
    }


</style>
