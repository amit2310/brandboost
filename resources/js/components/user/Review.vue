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
                        <h3>My Reviews</h3>
                        <p>Basic information that you use in BrandBoost services.</p>
                    </div>

                    <div class="p20">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="tdropdown ml0"><a style="margin:0!important;"
                                                              class="dropdown-toggle fsize12 txt_grey"
                                                              data-toggle="dropdown" aria-expanded="false"><img
                                    style="float: left; margin: 6px 5px 0 0;" class="small"
                                    src="/assets/images/cd_icon1.png"> &nbsp; All reviews
                                    ( {{ myReview.length }}) <i class="icon-arrow-down22"></i></a>
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
                                             (39) </a></strong></li>
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
<div>
    <div class="col-md-12 text-center">
        <ul class="nps_feedback">
            <li>
                No Review Found
            </li>
        </ul>
    </div>
</div>
        <div v-if="myReview" class="row profile_media_outer hidden">
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

                            <!--<div class="white_box p0" :id="review{ $aReview['id'] }}">
                                <div class="bb_rw01">
                                    <div class="bb_white_box">
                                        <div class="review_edit">
                                            <a href="{{ base_url().'user/review/edit/'.$aReview['id'] }}"
                                               style="cursor:pointer;"><img
                                                src="{{ base_url() }}assets/profile_images/edit_40.png"/></a>
                                        </div>

                                        <div class="bb_comment_header">
                                            <div class="bb_avatar01"><i class="fa bb_check_green">
                                                &lt;!&ndash; fa-check-circle &ndash;&gt;</i>&lt;!&ndash;  <img src="{{ $profileImg }}"> &ndash;&gt;
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
                                            <p class="bb_para heading_txt">{{ $aReview['review_title'] }}&lt;!&ndash; Widget heading text... &ndash;&gt;</p>
                                            <p class="bb_para">{{ nl2br($aReview['comment_text']) }}&lt;!&ndash; But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. &ndash;&gt;</p>
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

                                        &lt;!&ndash; **********Comment area********* &ndash;&gt;
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
                                                                    class="media-left"> &lt;!&ndash; <img src="{{ base_url() }}assets/images/user-06-a.png" width="36"> &ndash;&gt;
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
                                                                        @elseif($commentData->status == '2')
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
                                                                        &lt;!&ndash;  <button class="btn btn-link pl0 txt_red">{{ count($disLikeData) }}</button> &ndash;&gt;
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


                                                                    &lt;!&ndash; ******** comment child ********* &ndash;&gt;

                                                                    @php
                                                                    if (!empty($childComments)) {
                                                                    foreach ($childComments as $childComment) {

                                                                    $avtarImageChild = $childComment->avatar == 'avatar_image.png' ? base_url('assets/images/userp.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $childComment->avatar;

                                                                    $likeChildData = App\Models\ReviewsModel::getCommentLSByCommentID($childComment->id, 1);
                                                                    $disLikeChildData = App\Models\ReviewsModel::getCommentLSByCommentID($childComment->id, 0);
                                                                    @endphp
                                                                    <div class="reply_sec mt30">
                                                                        <div
                                                                            class="media-left">&lt;!&ndash; <img src="{{ base_url() }}assets/images/cust2.png" width="36"> &ndash;&gt;
                                                                            <div
                                                                                class="media-left media-middle pr10 commentPar">
                                                                                {!! showUserAvtar($childComment->avatar, $childComment->firstname, $childComment->lastname) !!}</div>
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
                                                                                &lt;!&ndash; <button class="btn btn-link pl0 txt_red">{{ count($disLikeChildData) }}</button> &ndash;&gt;
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
                                                                    &lt;!&ndash; ******** comment child end ********* &ndash;&gt;

                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                @php
                                                }
                                                }
                                                @endphp

                                                &lt;!&ndash;=========Add Comment===========&ndash;&gt;
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
                                                &lt;!&ndash;=========Add Comment end===========&ndash;&gt;

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-else class="row profile_media_outer hidden">
            <div class="col-md-12 text-center">
                <ul class="nps_feedback">
                    <li>
                        No Referral Found
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
                successMsg: '',
                errorMsg: '',
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
                        console.log("----------"+this.myReview)
                    });
            }
        }
    }

    $(document).ready(function () {

    });
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
