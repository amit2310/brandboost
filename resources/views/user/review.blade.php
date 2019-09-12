@extends('layouts.user_template')

@section('title')

@endsection

@section('contents')
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
    <div class="content_area">
        <div class="row">
            <div class="col-md-12">
                <div class="white_box profile_sec mb20">
                    <div class="p25 bbot text-center">
                        <h3>My Reviews</h3>
                        <p>Basic information that you use in BrandBoost services.</p>
                    </div>

                    <div class="p20">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="tdropdown ml0"><a style="margin:0!important;"
                                                              class="dropdown-toggle fsize12 txt_grey"
                                                              data-toggle="dropdown" aria-expanded="false"><img
                                            style="float: left; margin: 6px 5px 0 0;" class="small"
                                            src="{{ base_url() }}assets/images/cd_icon1.png"> &nbsp; All reviews
                                        ({{ count($myReview) }}) <i class="icon-arrow-down22"></i></a>
                                    <ul style="right: 0px!important; margin-top: 15px; left: 0px;"
                                        class="dropdown-menu dropdown-menu-left chat_dropdown">
                                        <li><strong><a class="active" style="cursor: pointer;"><img class="small"
                                                                                                    src="{{ base_url() }}assets/images/cd_icon1.png">All
                                                    ({{ count($myReview) }}) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon2.png">Open
                                                    (13) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon3.png">Resolved
                                                    (172) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon4.png">Favorite
                                                    (5) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon5.png">Snoozed
                                                    (28)</a></strong></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="tdropdown ml0 pull-right"><a style="margin:0!important;"
                                                                         class="dropdown-toggle fsize12 txt_grey"
                                                                         data-toggle="dropdown" aria-expanded="false">
                                        Sort by date <i class="icon-arrow-down22"></i></a>
                                    <ul style="right: 0px!important; margin-top: 15px; left: auto;"
                                        class="dropdown-menu dropdown-menu-left chat_dropdown">
                                        <li><strong><a class="active" style="cursor: pointer;"><img class="small"
                                                                                                    src="{{ base_url() }}assets/images/cd_icon1.png">All
                                                    (39) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon2.png">Open
                                                    (13) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon3.png">Resolved
                                                    (172) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon4.png">Favorite
                                                    (5) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="{{ base_url() }}assets/images/cd_icon5.png">Snoozed
                                                    (28)</a></strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                @if(!empty($myReview))
                    <table id="reviewTable">

                        <thead>
                        <tr>
                            <th style="display: none;">iid</th>
                            <th class="nosort" style="display: none;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $inc = 0;
                            foreach ($myReview as $key => $aReview) {

                                 $profileImg = $aReview['user_data']['avatar'] == '' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$aReview['user_data']['avatar'];



                              $brandImgArray = unserialize($aReview['media_url']);


                              if (count($brandImgArray) > 0){
                                  if($brandImgArray[0]['media_type'] == 'image') {
                                      $reviewImg = '<a style="cursor:pointer;" revId="'.$aReview['id'].'" revAvatar="'.$profileImg.'" class="mediaLargImage"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$brandImgArray[0]['media_url'].'" alt="" class="b_review"></a>';
                                      $commentWL = '80';
                                  }
                                  else {
                                      $reviewImg = '';
                                  }
                              }
                              else {
                                  $reviewImg = '';
                              }



                              if (!empty($aReview['media_url'])) {
                                  if (strpos($aReview['media_url'], '.mp4') !== false) {
                                      $mediaType = 'video';
                                      } else {
                                      $mediaType = 'image';
                                  }
                              } else {
                                  $mediaType = '';
                              }


                              $aUser = getLoggedUser();
                              $userID = $aUser->id;

                        @endphp

                        <tr>
                            <td style="display: none;">
                                {{ $key }}
                            </td>
                            <td>

                                <!--================Review 1=================-->

                                <div class="white_box p0" id="review{{ $aReview['id'] }}">
                                    <div class="bb_rw01">
                                        <div class="bb_white_box">
                                            <div class="review_edit">
                                                <a href="{{ base_url().'user/review/edit/'.$aReview['id'] }}"
                                                   style="cursor:pointer;"><img
                                                        src="{{ base_url() }}assets/profile_images/edit_40.png"/></a>
                                            </div>

                                            <div class="bb_comment_header">
                                                <div class="bb_avatar01"><i class="fa bb_check_green">
                                                        <!-- fa-check-circle --></i><!--  <img src="{{ $profileImg }}"> -->
                                                    <div class="media-left media-middle pr10">

                                                        {!! showUserAvtar($aReview['user_data']['avatar'], $aReview['user_data']['firstname'], $aReview['user_data']['lastname']) !!}</div>
                                                </div>
                                                <div class="bb_fleft">
                                                    <p class="bb_para">
                                                        <strong>{{ $aReview['user_data']['firstname'] . ' ' . $aReview['user_data']['lastname'] }}</strong>
                                                    </p>
                                                    <p class="bb_para">

                                                        @php
                                                            for ($i = 1; $i <= 5; $i++):
                                                        @endphp
                                                        <i class="fa fa-star fsize12
						                                @if ($i <= $aReview['ratings'])
                                                        {{ 'txt_yellow' }}
                                                        @else
                                                        {{ 'txt_grey' }}
                                                        @endif
                                                            ">
                                                        </i>
                                                        @php
                                                            endfor
                                                        @endphp

                                                        <span class="bb_thingrey">{{ $aReview['ratings'] }}/5</span>
                                                    </p>
                                                </div>

                                                <div class="bb_fleft">
                                                    <p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span>
                                                        <span class="bb_thingrey"> {{ ucwords($aReview['review_type']) }} -
                                                            @if(!empty($aReview['product_data']))
                                                                {{ $aReview['product_data']->product_name == '' ? $aReview['brand_title'] : $aReview['product_data']->product_name }}
                                                            @endif
                                                        </span>
                                                    </p>
                                                    <p class="bb_para"><span class="bb_dot"><i class="fa fa-circle"></i></span>
                                                        <span
                                                            class="bb_thingrey">{{ timeAgo($aReview['created']) }}</span>
                                                    </p>
                                                </div>
                                                <div class="bb_clear"></div>
                                            </div>

                                            <div class="bb_pad25">
                                                <p class="bb_para heading_txt">{{ $aReview['review_title'] }}<!-- Widget heading text... --></p>
                                                <p class="bb_para">{{ nl2br($aReview['comment_text']) }}<!-- But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. --></p>
                                            </div>
                                            <div class="bb_comment_area">
                                                <a style="cursor: pointer;" class="comment_show"><i><img
                                                            src="{{ base_url() }}assets/images/widget/comment_icon_grey.png"
                                                            width="15"></i>
                                                    &nbsp; {{ count($aReview['comment_block']) > 0 ? count($aReview['comment_block']) : '0' }}
                                                    Comments</a>

                                                <span class="review_helpful_{{ $aReview['id'] }} ">{{ ($aReview['total_helpful']) ? $aReview['total_helpful'] : 0 }} Found this helpful</span>

                                                <span class="ml-10">
                                                    <a style="cursor: pointer;"
                                                       class="pw_helpful_action bb_show_like_value bb_txt_green bb_like_dislike" action-name="Yes"
                                                       review-id="{{ $aReview['id'] }}"><i class="fa fa-thumbs-up   brand_thumbs br5 mr-5"></i></a>
                                                    <a style="cursor: pointer;"
                                                       class="pw_helpful_action bb_show_dis_like_value bb_txt_red bb_like_dislike" action-name="No"
                                                       review-id="{{ $aReview['id'] }}"><i class="fa fa-thumbs-down   brand_thumbs br5"></i></a>
                                                </span>

                                                <a class="bb_fright" style="cursor: pointer;"><i><img
                                                            src="{{ base_url() }}assets/profile_images/shareicon.png"
                                                            width="15"></i> &nbsp; Share</a>
                                            </div>

                                            <!-- **********Comment area********* -->
                                            @php
                                                $reviewCommentsData = App\Models\ReviewsModel::getReviewAllParentsComments($aReview['id'], $start = 0);
                                            @endphp
                                            <div class="p20 pt0 commentarea">
                                                <div class="commentarea_inner p0">


                                                    @php
                                                        if(!empty($reviewCommentsData)) {

                                                            foreach ($reviewCommentsData as $commentData) {

                                                                $likeData = App\Models\ReviewsModel::getCommentLSByCommentID($commentData->id, 1);
                                                                $disLikeData = App\Models\ReviewsModel::getCommentLSByCommentID($commentData->id, 0);
                                                                $childComments = App\Models\ReviewsModel::getReviewAllChildComments($aReview['id'], $commentData->id);

                                                    @endphp
                                                    <div class="bbot pb20 mb20" id="parComment{{ $commentData->id }}">
                                                        <div class="comment_sec">
                                                            <ul>
                                                                <li class="bbot">
                                                                    <div
                                                                        class="media-left"> <!-- <img src="{{ base_url() }}assets/images/user-06-a.png" width="36"> -->
                                                                        <div
                                                                            class="media-left media-middle pr10 commentPar">
                                                                            {!! showUserAvtar($commentData->avatar, $commentData->firstname, $commentData->lastname) !!}</div>
                                                                    </div>
                                                                    <div class="media-left pr0">
                                                                        <p class="fsize14 txt_grey2 lh14 mb-15 ">{{ $commentData->firstname . ' ' . $commentData->lastname }}
                                                                            <span
                                                                                class="dot">.</span> {{ timeAgo($commentData->created) }}
                                                                            <span class="dot">.</span>
                                                                            @if($commentData->status == '1')
                                                                                <span class="txt_green"><i
                                                                                        class="icon-checkmark3 fsize12 txt_green"></i> Approve</span>
                                                                            @else if($commentData->status == '2')
                                                                            <span class="txt_yellow"><i
                                                                                    class="icon-checkmark3 fsize12 txt_yellow"></i> Pending</span>
                                                                            @endif

                                                                        </p>
                                                                        <p class="fsize13 mb10 lh23 txt_grey2">
                                                                            {{ $commentData->content != '' ? $commentData->content : 'N/A' }}
                                                                        </p>

                                                                        <div class="button_sec">
                                                                            <button
                                                                                class="btn btn-link pl0 txt_green">{{ count($likeData) }}</button>
                                                                            <a class="btn comment_btn p7"
                                                                               href="javascript:void(0);"
                                                                               onclick="saveCommentLikeStatus('{{ $commentData->id }}', '1')"><i
                                                                                    class="icon-thumbs-up2 txt_green"></i></a>
                                                                        <!--  <button class="btn btn-link pl0 txt_red">{{ count($disLikeData) }}</button> -->
                                                                            <a class="btn comment_btn p7"
                                                                               href="javascript:void(0);"
                                                                               onclick="saveCommentLikeStatus('{{ $commentData->id }}', '0')"><i
                                                                                    class="icon-thumbs-down2 txt_red"></i></a>
                                                                            <a style="cursor: pointer;"
                                                                               class="btn comment_btn txt_purple replyCommentAction">Reply</a>
                                                                            @if($commentData->user_id == $userID)
                                                                                <a href="javascript:void(0);"
                                                                                   class="btn comment_btn txt_purple editComment"
                                                                                   commentid="{{ $commentData->id }}">Edit</a>
                                                                            @endif
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
                                                                                           value="{{ $commentData->review_id }}"
                                                                                           type="hidden">
                                                                                    <input name="parent_comment_id"
                                                                                           class="parent_comment_id"
                                                                                           value="{{ $commentData->id }}"
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

                                                                        @php
                                                                            if (!empty($childComments)) {
                                                                            foreach ($childComments as $childComment) {

                                                                                $avtarImageChild = $childComment->avatar == 'avatar_image.png' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $childComment->avatar;

                                                                                $likeChildData = App\Models\ReviewsModel::getCommentLSByCommentID($childComment->id, 1);
                                                                                $disLikeChildData = App\Models\ReviewsModel::getCommentLSByCommentID($childComment->id, 0);
                                                                        @endphp
                                                                        <div class="reply_sec mt30">
                                                                            <div
                                                                                class="media-left"><!-- <img src="{{ base_url() }}assets/images/cust2.png" width="36"> -->
                                                                                <div
                                                                                    class="media-left media-middle pr10 commentPar">
                                                                                    {{ showUserAvtar($childComment->avatar, $childComment->firstname, $childComment->lastname) }}</div>
                                                                            </div>
                                                                            <div class="media-left pr0">
                                                                                <p class="fsize14 txt_grey2 lh14 mb10 ">{{ $childComment->firstname . ' ' . $childComment->lastname }}
                                                                                    <span
                                                                                        class="dot">.</span> {{ timeAgo($childComment->created) }}
                                                                                </p>
                                                                                <p class="fsize13 mb10 lh23 txt_grey2">
                                                                                    {{ $childComment->content != '' ? $childComment->content : 'N/A' }}
                                                                                </p>

                                                                                <div class="button_sec">
                                                                                    <button
                                                                                        class="btn btn-link pl0 txt_green">{{ count($likeChildData) }}</button>
                                                                                    <a href="javascript:void(0);"
                                                                                       onclick="saveCommentLikeStatus('{{ $childComment->id }}', '1')"
                                                                                       class="btn comment_btn p7"><i
                                                                                            class="icon-thumbs-up2 txt_green"></i></a>
                                                                                <!-- <button class="btn btn-link pl0 txt_red">{{ count($disLikeChildData) }}</button> -->
                                                                                    <a href="javascript:void(0);"
                                                                                       onclick="saveCommentLikeStatus('{{ $childComment->id }}', '0')"
                                                                                       class="btn comment_btn p7"><i
                                                                                            class="icon-thumbs-down2 txt_red"></i></a>

                                                                                    @if($childComment->user_id == $userID)
                                                                                        <a href="javascript:void(0);"
                                                                                           commentid="{{ $childComment->id }}"
                                                                                           class="btn comment_btn txt_purple editComment">Edit</a>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    @php
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <!-- ******** comment child end ********* -->

                                                                    </div>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                @php
                                                    }
                                                }
                                                @endphp

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
                                                                       value="{{ $aReview['id'] }}">
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
                        @php
                            }
                        @endphp
                        <tbody>
                    </table>
                @else
                    <ul class="nps_feedback">
                        <li>
                            <center>No Review Found</center>
                        </li>
                    </ul>
                @endif

            </div>
        </div>

    </div>

    <div id="editComment" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal" id="updateComment" action="javascript:void();">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Comment</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-lg-3">Comment</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" placeholder="Leave Comment" name="edit_content"
                                          id="edit_content" required></textarea>
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


    <script>

        $(document).ready(function () {

            var tableId = 'reviewTable';
            var tableBase = custom_user_data_table(tableId, 0, 'desc');

            $(".comment_show").click(function () {
                $(this).parent().parent().find('.commentarea').slideToggle();
            });

            $(document).on('click', '.pw_helpful_action', function (e) {
                e.preventDefault();
                var actionName = $(this).attr('action-name');
                var reviewId = $(this).attr('review-id');

                $.ajax({
                    url: "{{ base_url() }}company/saveHelpful",
                    method: "POST",
                    data: {action: actionName, review_id: reviewId, _token: '{{csrf_token()}}'},
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
                    url: "{{ base_url('admin/comments/add_comment') }}",
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
                        url: '{{ base_url("admin/comments/add_comment") }}',
                        type: "POST",
                        data: {
                            'reviweId': reviewID,
                            'parent_comment_id': parentCommentId,
                            'comment_content': commentContent,
                            '_token': '{{csrf_token()}}'
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
                    url: "{{ base_url('admin/comments/getCommentById') }}",
                    type: "POST",
                    data: {commentID: commentID, '_token': '{{csrf_token()}}'},
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
                    url: "{{ base_url('admin/comments/update_comment') }}",
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
                        url: "{{ base_url('admin/comments/deleteComment') }}",
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
                url: '{{ base_url("admin/reviews/saveCommentLikeStatus") }}',
                type: "POST",
                data: {'commentId': commentID, 'status': statusType, '_token': '{{csrf_token()}}'},
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

@endsection
