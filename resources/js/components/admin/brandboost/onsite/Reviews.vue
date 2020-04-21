<template>

    <div class="content">
        <!--******************
                Top Heading area
                **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Reviews Feed</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img width="16" src="assets/images/setting_3line_grey.svg"></button>
                        <button class="btn btn-md bkg_reviews_400 light_000" @click="displayAddReviewForm">Add Review <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
                        <!--<button class="btn btn-md bkg_reviews_400 light_000 slidebox">ADD New Contact <span><img src="assets/images/reviews_plus_icon.svg"></span></button>-->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
        <loading :isLoading="loading"></loading>
        <div class="content-area" v-show="pageRendered==true">
            <div class="container-fluid">
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="table_filter">
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Date Created'}" @click="sortBy='Date Created'">All</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Active'}" @click="sortBy='Active'">Posted</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Pending'}" @click="sortBy='Pending'">Draft</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Positive'}" @click="sortBy='Positive'">Positive</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Negative'}" @click="sortBy='Negative'">Negative</a></li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="table_filter text-right">
                                <li><a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter_line_18.svg"></i></a>
                                    <div class="dropdown-menu p10 mt-1">
                                        <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Inactive'}" @click="sortBy='Inactive'"><i class="ri-check-double-fill"></i> &nbsp; Inactive</a>
                                        <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Archive'}" @click="sortBy='Archive'"><i class="ri-check-double-fill"></i> &nbsp; Archive</a>
                                    </div>
                                </li>
                                <li><a href="javascript:void(0);" class="search_tables_open_close"><i><img width="16" src="assets/images/search_line_18.svg"></i></a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_line_18.svg"></i></a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_line_18.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card p20 datasearcharea reviewfeedSearch br6 shadow3" style="z-index: 999999!important;">
                        <div class="form-group m-0 position-relative">
                            <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                            <a class="search_tables_open_close searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" v-if="oReviews.length > 0 || searchBy.length>0">
                <div class="row" v-if="viewType == 'Grid View'">
                    <div class="col-md-3 d-flex" v-for="oReview in oReviews">
                        <div class="card p0 pt30 text-center animate_top col">
                            <span v-if="oReview.rstatus == 0" class="status_icon bkg_light_800" title="INACTIVE"></span>
                            <span v-if="oReview.rstatus == 1" class="status_icon bkg_green_400" title="ACTIVE"></span>
                            <span v-if="oReview.rstatus == 2" class="status_icon bkg_reviews_300" title="PENDING"></span>
                            <span v-if="oReview.rstatus == 3" class="status_icon bkg_reviews_300" title="ARCHIVED"></span>
                            <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <!--<a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(oReview.reviewid)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>-->
                                    <a v-if="oReview.rstatus == '0' || oReview.rstatus == '2'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                    <a v-if="oReview.rstatus == '1'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                    <a v-if="oReview.rstatus != '3'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showReview(oReview.reviewid)"><i class="dripicons-user text-muted mr-2"></i> View Review</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(oReview.reviewid)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="circle-icon-36 bkg_blue_300 m0auto lh_34">
                                <span v-if="oReview.domain_name.indexOf('facebook')" class=""><img src="assets/images/google_fill.svg"/></span>
                                <span v-else class=""><img src="assets/images/google_fill.svg"/></span>
                            </a>
                            <h3 class="htxt_medium_14 dark_600 mb-2 mt-3">{{ capitalizeFirstLetter(oReview.firstname) }} {{ capitalizeFirstLetter(oReview.lastname) }}</h3>
                            <p class="fsize13 dark_600 mb-1 pl10 pr10 lh_21 min_h_85" @click="showReview(oReview.reviewid)" style="cursor: pointer;">{{ setStringLimit(capitalizeFirstLetter(oReview.comment_text), 130) }}</p>
                            <div class="p20 pl0 pr0 reply_links">
                                <a href="javascript:void(0);"><img src="assets/images/chat_grey_16.svg" />{{ oReview.getComm }}</a>
                                <a href="javascript:void(0);"><img src="assets/images/thumbs_up_16.svg" />0</a>
                                <a class="js-review-feedback-slidebox" href="javascript:void(0);"><img src="assets/images/reply_grey_16.svg" />Reply</a>
                            </div>

                            <div class="p20 btop">
                                <div class="row">
                                    <div class="col-5 text-left">
                                        <p v-if="oReview.ratings < 3" class="fsize14 dark_400 m-0"><i class="ri-star-fill red_400"></i> {{ number_format(oReview.ratings, 1) }}</p>
                                        <p v-else-if="oReview.ratings == 3" class="fsize14 dark_400 m-0"><i class="ri-star-fill yellow_400"></i> {{ number_format(oReview.ratings, 1) }}</p>
                                        <p v-else class="fsize14 dark_400 m-0"><i class="ri-star-fill green_400"></i> {{ number_format(oReview.ratings, 1) }}</p>
                                    </div>
                                    <div class="col-7 text-right pl0"><p class="fsize14 dark_400 m-0">{{ timeAgo(oReview.review_created) }}</p></div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row" v-if="viewType == 'List View'">
                    <div class="col-md-12">

                        <div class="card p0 mb10" v-for="oReview in oReviews">
                            <div class="p25">
                                <div class="mb-2">
                                    <div class="row" :reviewid="oReview.reviewid">
                                        <div class="col-md-5">
                                            <p class="fsize14 fw400 dark_600 float-left mr-3 lh_26 js-review-feedback-slidebox2"<!-- @click="loadReviewPopup(oReview.reviewid,'')"-->><span class="circle_icon_24 bkg_blue_200 mr-2"><img src="assets/images/google_14_white.svg"></span> &nbsp; {{ oReview.firstname }} {{ oReview.lastname }}</p>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <span v-if="oReview.rstatus == 0" style="right: 15px; top: 0px; left: auto" class="status_icon bkg_light_600" title="INACTIVE"></span>
                                            <span v-if="oReview.rstatus == 1" style="right: 15px; top: 0px; left: auto" class="status_icon bkg_green_300" title="ACTIVE"></span>
                                            <span v-if="oReview.rstatus == 2" style="right: 15px; top: 0px; left: auto" class="status_icon bkg_reviews_300" title="PENDING"></span>
                                            <span v-if="oReview.rstatus == 3" style="right: 15px; top: 0px; left: auto" class="status_icon bkg_reviews_300" title="ARCHIVED"></span>
                                            <div class="dot_dropdown" style="position: absolute; top: 0px; right: -8px;"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <!--<a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(oReview.reviewid)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>-->
                                                <a v-if="oReview.rstatus == '0' || oReview.rstatus == '2'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                                <a v-if="oReview.rstatus == '1'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                                <a v-if="oReview.rstatus != '3'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="showReview(oReview.reviewid)"><i class="dripicons-user text-muted mr-2"></i> View Review</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(oReview.reviewid)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                            </div>
                                        </div>
                                            <div style="position:absolute; top:0; right:180px;">
                                                <p class=" m-0 review_rating_start float-left">
                                                    <template v-for="num in [1,2,3,4,5]">
                                                        <i v-if="num<=oReview.ratings" class="ri-star-fill green_400"></i>
                                                        <i v-else class="ri-star-fill"></i>
                                                    </template>
                                                </p>
                                                <p class="float-left fsize14 ml-2 dark_400 mb-0" style="margin-top:2px;">{{ oReview.ratings }}.0</p>
                                            </div>
                                            <p class="float-right fsize14 dark_400 m-0" style="position:absolute; top:0px; right:60px;">{{timeAgo(oReview.review_created)}} </p>
                                        </div>
                                    </div>
                                </div>

                                <p class="fsize14 fw400 dark_600 lh_22 mb25" @click="showReview(oReview.reviewid)">
                                    {{ oReview.comment_text }}
                                </p>
                                <div class="reply_sec_link">
                                    <a class="dark_400 fsize14" href="javascript:void(0);"><img src="assets/images/comment_grey_16.svg"> &nbsp; {{oReview.getComm}}
                                        <template v-if="oReview.getComm < 2">Comment </template>
                                        <template v-else>Comments</template>
                                    </a>
                                    <a class="dark_400 fsize14" href="javascript:void(0);"><img src="assets/images/thumb-up-grey-16.svg"> &nbsp; 0 Likes</a>
                                    <a class="dark_400 fsize14 js-review-feedback-slidebox" @click="loadReplyPopup(oReview.reviewid)" href="javascript:void(0);"><img src="assets/images/reply_grey_16.svg"> &nbsp; Reply</a>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    @paginate_per_page="showPaginationItemsPerPage"
                    :offset="4"
                    class="mt-4">
                </pagination>

            </div>

            <div class="container-fluid" v-else>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min_h_600">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14 d-none" href="javascript:void(0);">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                                        Set up reviews monitoring
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_12 dark_200 " href="javascript:void(0);">
                                        Learn how use use contacts &nbsp; <img src="assets/images/question-line.svg">
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 240px; " src="assets/images/reviews_icon_125.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No reviews so far. Connect reviews site!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt15 mb25">Reviews from 50+ review sites, at your fingertips...</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Connect</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="col-md-12 text-center mt-3">
                        <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT CAMPAIGN</a>
                    </div>-->

                </div>
            </div>
        </div>

        <!--******************
         Sliding Smart Popup
         **********************-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-review-feedback-slidebox">
                    <i class=""><img src="assets/images/cross.svg"/></i></a>

                        <div class="p40">
                            <div class="row">
                                <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                    <h3 class="htxt_medium_24 dark_800 mt20">Review Reply</h3>
                                    <hr>
                                </div>
                                <system-messages :successMsg="successMsgPopup"></system-messages>

                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Latest Comments {{ reviewdetails.totalComment > 0 ? '(' + reviewdetails.totalComment + ')' : '' }}</h6>
                                    </div>

                                    <div class="panel-body p20">
                                        <div class="comment_sec">
                                            <ul class="addMoreComment">
                                                <li class="bbot" v-for="reviewComment in reviewdetails.reviewCommentsData">

                                                    <!--<div class="media-left">{!! showUserAvtar($commentData->avatar, $commentData->firstname, $commentData->lastname) !!}</div>-->
                                                    <span class="table-img mr15">
                                                        <user-avatar
                                                            :avatar="reviewComment.avatar"
                                                            :firstname="reviewComment.firstname"
                                                            :lastname="reviewComment.lastname"
                                                            :width="32"
                                                            :height="32"
                                                            :fontsize="12"
                                                        ></user-avatar>
                                                    </span>

                                                    <div class="media-left pr0 w100">

                                                        <p class="fsize14 txt_grey2 lh14 mb-15 ">{{ capitalizeFirstLetter(reviewComment.firstname) + ' ' + (reviewComment.lastname!=null?capitalizeFirstLetter(reviewComment.lastname):'') }} <span class="dot">.</span> {{ timeAgo(reviewComment.created) }} <span class="dot">.</span>

                                                            <span v-if="reviewComment.status == 0" class="txt_red"><i class="icon-checkmark3 fsize12 txt_red"></i> Disapproved</span>
                                                            <span v-else-if="reviewComment.status == 2" class="media-annotation">
                                                                <span class="label bkg_grey txt_white br5 chg_status addtag" style="cursor: pointer;" @click="changeCommentStatus(reviewComment.id, '1')" :comment_id="reviewComment.id">
                                                                 Approve
                                                                </span>
                                                            </span>
                                                            <span v-else-if="reviewComment.status == 2" class="media-annotation dotted">
                                                                <span class="label bkg_red txt_white br5 chg_status addtag" @click="changeCommentStatus(reviewComment.id, '0')" :comment_id="reviewComment.id">
                                                                 Disapprove</span>
                                                            </span>
                                                            <span v-else class="txt_red"><i class="icon-checkmark3 fsize12 txt_red"></i> Approved</span>

                                                        </p>

                                                        <p class="fsize13 mb10 lh23 txt_grey2">{{ reviewComment.content }}</p>

                                                        <div class="button_sec">
                                                            <!--<button class="btn btn-link pl0 txt_green">{{ reviewComment.likeData }}</button>-->
                                                            <a class="btn comment_btn p7" href="javascript:void(0);" @click="saveCommentLikeStatus(reviewComment.id, '1')"><i class="icon-thumbs-up2 txt_green"></i></a>{{ reviewComment.likeData.length > 0 ? reviewComment.likeData.length : '0' }}
                                                            <!--<button class="btn btn-link pl0 txt_red">{{ reviewComment.disLikeData }}</button>-->
                                                            <a class="btn comment_btn p7" href="javascript:void(0);" @click="saveCommentLikeStatus(reviewComment.id, '0')"><i class="icon-thumbs-down2 txt_red"></i></a>{{ reviewComment.disLikeData.length > 0 ? reviewComment.disLikeData.length : '0' }}
                                                            <a style="cursor: pointer;" class="btn comment_btn txt_purple replyCommentAction">Reply</a>
                                                            <!--<a  href="javascript:void(0);" class="btn comment_btn txt_purple editComment" :commentid="reviewComment.id">Edit</a>-->
                                                        </div>

                                                        <div class="replyCommentBox" style="display:none;">
                                                            <!--<form method="post" class="form-horizontal" action="javascript:void();">-->
                                                            <form method="post" @submit.prevent="processForm">
                                                                <div class="mt10 mb10">
                                                                    <textarea name="comment_content" v-model="form.comment_content" class="form-control comment_content" style="padding: 15px; height: 75px;" placeholder="Comment Reply..." required></textarea>
                                                                </div>

                                                                <div class="text-right">
                                                                    <input name="reviweId" class="reviweId" :value="reviewComment.review_id" type="hidden">
                                                                    <input name="parent_comment_id" class="parent_comment_id" :value="reviewComment.id" type="hidden">
                                                                    <button style="width: 128px;" type="button" class="btn dark_btn addReplyComment"> Reply</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div v-for="childComment in reviewComment.childComments" class="reply_sec mt30">
                                                            <!--<div class="media-left">
                                                                {!! showUserAvtar($childComment->avatar, $childComment->firstname, $childComment->lastname) !!}
                                                            </div>-->
                                                            <div class="media-left pr0">
                                                                <p class="fsize14 txt_grey2 lh14 mb10 ">{{ childComment.firstname + ' ' + childComment.lastname }} <span class="dot">.</span> {{ timeAgo(childComment.created) }} </p>
                                                                <p class="fsize13 mb10 lh23 txt_grey2">
                                                                    {{ childComment.content }}
                                                                </p>
                                                                <!--<div class="button_sec">
                                                                    <button class="btn btn-link pl0 txt_green">{{ childComment.likeChildData }}</button>
                                                                    <a href="javascript:void(0);" onclick="saveCommentLikeStatus('{{ childComment.id }}', '1')" class="btn comment_btn p7"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                                    <button class="btn btn-link pl0 txt_red">{{ childComment.disLikeChildData }}</button>
                                                                    <a href="javascript:void(0);" onclick="saveCommentLikeStatus('{{ childComment.id }}', '0')" class="btn comment_btn p7"><i class="icon-thumbs-down2 txt_red"></i></a>
                                                                    <a href="javascript:void(0);" commentid="{{ childComment.id }}" class="btn comment_btn txt_purple editComment">Edit</a>
                                                                </div>-->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </li>

                                            </ul>

                                            <input v-if="reviewdetails.totalComment > 5" type="hidden" id="numOfComment" value="5">
                                            <div v-if="reviewdetails.totalComment > 5" class="loadMoreRecord">
                                                <a style="cursor: pointer;" id='loadMoreComment' :revId="reviewdetails.id">Load more</a>
                                                <img class="loaderImage hidden" height="20px" width="20px" src="/assets/images/widget_load.gif">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--<div class="col-md-12">
                                    <div class="replyCommentBox">
                                        <div class="mt10 mb10">
                                            <textarea name="comment_content" class="form-control comment_content" style="padding: 15px; height: 75px; border:1px solid #eee" placeholder="Comment Reply..." required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <input name="reviweId" class="reviweId" value="" type="hidden">
                                            <input name="parent_comment_id" class="parent_comment_id" value="" type="hidden">
                                            <button style="width: 128px;" type="button" class="btn dark_btn addSmartReplyComment"> Reply</button>
                                        </div>
                                    </div>
                                </div>-->

                            </div>
                            <div class="row bottom-position">
                                <div class="col-md-12 mb15">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                    <input type="hidden" name="module_account_id" id="module_account_id"
                                           :value="moduleAccountID">
                                    <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Save</button>
                                    <a class="blue_300 fsize16 fw600 ml20 js-review-feedback-slidebox" href="javascript:void(0);">Close</a> </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>

        <div class="box" style="width:550px;">
            <div style="width: 550px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-review-feedback-slidebox2">
                            <i class=""><img src="assets/images/cross.svg"/></i>
                        </a>

                 <div class="p40">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="assets/images/list-icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Review </h3>
                                <hr>
                        </div>
                    </div>
                    <div id="reviewFeedPopupBox">

                    </div>
                </div>
            </div>
            </div>
        </div>
        <!--================================= CONTENT AFTER TAB===============================-->

        <!--=====================================Create new review================================-->
        <div id="addPeopleList" class="modal fade">
            <div style="max-width: 440px;" class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Create new campaign</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Campaign name</label>
                                        <div class="">
                                            <input placeholder="Enter campaign name" name="firstname" id="firstname" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb0">
                                        <label class="control-label">Campaign description</label>
                                        <div class="">
                                            <textarea placeholder="Enter campaign description"  class="form-control" value="" type="text" required> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p40">
                            <input type="hidden" name="listId" id="list_id" value="">
                            <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                            <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--=====================================Add List Modal Popup End================================-->

        <!--=====================================Create new campaign================================-->
        <div id="addPeopleList" class="modal fade">
            <div style="max-width: 440px;" class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Create new campaign</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Campaign name</label>
                                        <div class="">
                                            <input placeholder="Enter campaign name" name="firstname" id="firstname" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb0">
                                        <label class="control-label">Campaign description</label>
                                        <div class="">
                                            <textarea placeholder="Enter campaign description"  class="form-control" value="" type="text" required> </textarea>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="modal-footer p40">
                            <input type="hidden" name="listId" id="list_id" value="">
                            <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                            <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--=====================================Add List Modal Popup End================================-->

        <!-- =======================edit users popup========================= -->


        <div id="editReview" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal" id="updateReview" action="javascript:void(0);">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-lg-3">Title</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="edit_review_title" id="edit_review_title" placeholder="Title" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Comment</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" placeholder="Leave Review" name="edit_content" id="edit_content" required ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Rating</label>
                                <div class="col-lg-9">
                                    <div class="step_star_new" style="padding: 5px 0;">

                                        <ul id='stars'>

                                            <li class='star' title='Poor' data-value='1'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Fair' data-value='2'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Good' data-value='3'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Excellent' data-value='4'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='WOW!!!' data-value='5'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0" id="ratingValue" name="ratingValue">
                            <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- =======================edit video popup========================= -->

        <div id="editVideoReview" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal" id="updateVideoReview" action="javascript:void(0);">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-lg-3">Title</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="edit_review_title" id="edit_video_review_title" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Rating</label>
                                <div class="col-lg-9">
                                    <div class="step_star_new" style="padding: 5px 0;">
                                        <ul id='stars_video'>

                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0" id="ratingValueVideo" name="ratingValueVideo">
                            <input type="hidden" name="edit_video_reviewid" id="edit_video_reviewid" value="">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="showVideoPopup" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Video</h5>
                    </div>
                    <div class="modal-body">

                        <div id="divVideo" class="form-group">
                            <video width="100%" height="auto" controls>
                                <source src="" type="video/mp4">
                            </video>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        <a id="downloadVideo" class="btn btn-primary" href="" download><i class="icon-download"></i>&nbsp;&nbsp; Download Video</a>
                    </div>

                </div>
            </div>
        </div>


        <div id="reviewPopup" class="modal fade">
            <div class="modal-dialog">
                <div class="">
                    <div class="col-md-12">
                        <div class="panel">
                            <div style="border-top: none; border-bottom: 1px solid #eee!important;" class="panel-footer panel-footer-condensed">
                                <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="reviewTime"></span>
                            </span>
                                    <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                                </div>
                            </div>
                            <div class="panel-body" id="reviewContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="previewReviewReply" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body" id="previewReviewReplyContent"></div>
                            <div class="panel-footer panel-footer-condensed">
                                <div class="heading-elements not-collapsible">
                                    <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="ReviewTagListModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void(0);">

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

        <!-- newreviewpopup -->
        <div id="newreviewpopup" class="modal fade newreviewpopup2">
            <div class="modal-dialog">
                <div class="modal-content" id="reviewPopupBox">

                </div>
            </div>
        </div>
        <!-- /newreviewpopup -->

        <!--******************
         Sliding Smart Popup
         **********************-->


        <div id="commentpopup" class="modal fade"></div>
    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                pageRendered: false,
                successMsg : '',
                successMsgPopup : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                company_name: '',
                count : 0,
                allData: {},
                oReviews : '',
                oCampaign: '',
                reviewTags: '',
                reviewdetails: '',
                campaignId: '',
                current_page: 1,
                items_per_page: 10,
                breadcrumb: '',
                form: new Form({
                    campaignName: '',
                    OnsitecampaignDescription: '',
                    campaign_id: '',
                    comment_content: ''
                }),
                formLabel: 'Create',
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: ''
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            },
            'searchBy' : function(){
                this.loadPaginatedData();
            },
            'items_per_page' : function(){
                this.loadPaginatedData();
            }
        },
        methods: {
            displayAddReviewForm: function(){
                window.location.href='#/reviews/onsite/add';
            },
            searchItem: function(){
                this.loadPaginatedData();
            },
            showReview: function(id){
                window.location.href='#/reviews/onsite/reviews/'+id;
            },
            showQuestions: function(id){
                window.location.href='#/brandboost/questions/'+id;
            },
            loadPaginatedData : function(){
                this.loading = true;
                axios.get('/admin/brandboost/reviews?items_per_page='+this.items_per_page+ '&page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.oCampaign = response.data.oCampaign;
                        this.allData = response.data.allData;
                        this.oReviews = response.data.aReviews;
                        this.reviewTags = response.data.reviewTags;
                        this.reviewTags = response.data.reviewTags;
                        this.loading = false;
                        this.pageRendered = true;
                        //console.log(this.campaigns)
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            showPaginationItemsPerPage: function(p){
                this.loading=true;
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-review-feedback-slidebox').click();
            },
            prepareItemUpdate: function(campaign_id) {
                this.getItemInfo(campaign_id);
            },
            getItemInfo: function(campaign_id){
                axios.post('/admin/brandboost/getReviewCampaign', {
                    campaign_id: campaign_id,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.campaign_id = formData.campaign_id;
                            this.form.campaignName = formData.campaignName;
                            this.form.OnsitecampaignDescription = formData.description;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }
                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                formActionSrc = '/admin/comments/add_comment';
                this.form.module_name = this.moduleName;
                this.form.module_account_id = this.moduleAccountID;
                axios.post(formActionSrc, this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            //this.form = {};
                            //document.querySelector('.js-review-feedback-slidebox').click();
                            this.successMsgPopup = response.data.message;//'Action completed successfully.';
                            window.location.href = window.location.href;
                        }
                        else if (response.data.status == 'error') {
                            if (response.data.type == 'duplicate') {
                                alert('Error: Campaign already exists.');
                            }
                            else {
                                alert('Error: Something went wrong.');
                            }
                        }else{
                            this.loading = false;
                        }
                    })
                    .catch(errors => {
                        this.loading = false;
                    })
            },
            changeStatus: function(review_id, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/reviews/updateReviewStatus', {
                        review_id:review_id,
                        status:status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();

                                this.successMsg = 'Action completed successfully.';
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            },
            changeCommentStatus: function(comment_id, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/comments/update_comment_status', {
                        comment_id:comment_id,
                        status:status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();

                                this.successMsgPopup = 'Action completed successfully.';
                            }

                        });
                }
            },
            loadReviewPopup:function(review_id, tabtype) {
                axios.post('/admin/reviews/getReviewFeedPopupData', {
                        rid: review_id,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if (response.data.status == "success") {
                                $("#reviewFeedPopupBox").html(response.data.popupData);
                                if (tabtype == 'note') {
                                    $('.tabbable a[href="#note-tab"]').trigger('click');
                                } else {
                                    $('.tabbable a[href="#review-tab"]').trigger('click');
                                }
                            }
                        });
            },
            loadReplyPopup:function(review_id) {
                axios.post('/admin/brandboost/reviewdetails/'+review_id, {
                        id: review_id,
                        env: 'vue',
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if (response.data.status == "success") {
                                //console.log(response.data);
                                this.reviewdetails = response.data.content;
                                console.log(this.reviewdetails);
                            }
                        });
            },
            deleteItem: function(reviewID) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/reviews/deleteReview', {
                        reviewid:reviewID,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }
                        });
                }
            },
            saveCommentLikeStatus: function(commentID, statusType) {
                if(confirm('Are you sure you want to like/dislike?')){
                    //Do axios
                    axios.post('/admin/reviews/saveCommentLikeStatus', {
                        commentId:commentID,
                        status:statusType,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                this.successMsgPopup = 'Action completed successfully.';
                            }
                        });
                }
            }
        }
    }

    $(document).ready(function () {

        $(document).on('click', '.js-review-feedback-slidebox', function(){
            $(".box:first").animate({
                width: "toggle"
            });
        });

        $(document).on('click', '.js-review-feedback-slidebox2', function(){
            $(".box:last").animate({
                width: "toggle"
            });
        });

        /*$(document).on('click', '.search_tables_open_close', function(){
            $(".reviewfeedSearch").animate({
                width: "toggle"
            });
            $('#InputToFocus').focus();
        });*/

    });
</script>
