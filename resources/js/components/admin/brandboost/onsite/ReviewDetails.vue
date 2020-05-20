<template>

    <div>
        <!--******************
        Top Heading area
        **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <!--<h3 class="htxt_medium_24 dark_700">{{ capitalizeFirstLetter(review.brand_title) }}</h3>-->
                        <h3 class="htxt_medium_24 dark_700">{{ capitalizeFirstLetter(review.firstname) + ' ' + capitalizeFirstLetter(review.lastname) }}</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/settings-2-line-reviews.svg"></button>
                        <button v-if="review.status == '0'" @click="changeStatus(reviewId, '1')" class="btn btn-md bkg_light_000 reviews_400 fw500" data-toggle="modal">Approve <span><img src="assets/images/arrow-down-s-line-review.svg"></span></button>
                        <button v-else @click="changeStatus(reviewId, '0')" class="btn btn-md bkg_light_000 reviews_400 fw500" data-toggle="modal">Dispprove <span><img src="assets/images/arrow-down-s-line-review.svg"></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>


        <!--******************
         Content Area
        **********************-->
        <div class="content-area">
            <div class="container-fluid">

                <!--******************
                 PAGE LEFT SIDEBAR
                **********************-->
                <OnsiteReviewsSummary></OnsiteReviewsSummary>
                <!--******************
                  PAGE LEFT SIDEBAR END
                 **********************-->



                <div class="row">
                    <div class="col-md-12">
                        <div class="card p0">
                            <div class="p30 bbot pt20 pb20">
                                <div class="bbot mb30">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="circle_icon_24 bkg_reviews_400 mr-3">{{ review.firstname != '' ? review.firstname.charAt(0) : review.lastname.charAt(0) }}</span>
                                            <p class="fsize14 fw500 dark_600 float-left mr-3 lh_24">{{ capitalizeFirstLetter(review.firstname) + ' ' + capitalizeFirstLetter(review.lastname) }}</p>

                                        </div>
                                        <div class="col-md-6">
                                            <ul class="review_header_section">
                                                <li>
                                                    <span v-for="num in [1,2,3,4,5]">
                                                        <i v-if="num<=review.ratings && review.ratings > 3" class="ri-star-s-fill fsize18 green_400"></i>
                                                        <i v-else-if="num<=review.ratings && review.ratings == 3" class="ri-star-s-fill fsize18 yellow_400"></i>
                                                        <i v-else class="ri-star-s-fill fsize18 light_600"></i>
                                                    </span>
                                                </li>

                                                <li class="ml-1"><span>{{ number_format(review.ratings, 1) }}</span></li>
                                                <li><span><i class="ri-at-line email_400 fsize15"></i></span></li>
                                                <li><span>{{ timeAgo(review.created) }}</span></li>
                                                <li>
                                                    <span v-if="review.status == 0" style="left:auto; right:auto; top: auto" class="status_icon bkg_light_600 position-relative" title="INACTIVE"></span>
                                                    <span v-if="review.status == 1" style="left:auto; right:auto; top: auto" class="status_icon bkg_green_400 position-relative" title="ACTIVE"></span>
                                                    <span v-if="review.status == 2" style="left:auto; right:auto; top: auto" class="status_icon bkg_reviews_300 position-relative" title="PENDING"></span>
                                                    <span v-if="review.status == 3" style="left:auto; right:auto; top: auto" class="status_icon bkg_reviews_300 position-relative" title="ARCHIVED"></span>
                                                </li>
                                            </ul>

                                        </div>
                                        <!--<div class="col-md-4">
                                            <div class="float-right mt-1 ml-2">
                                                <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
                                                    <span><img src="assets/images/more-vertical.svg"></span>
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(1585px, 43px, 0px);">
                                                    <a class="dropdown-item" href="#">Link 1</a>
                                                    <a class="dropdown-item" href="#">Link 2</a>
                                                    <a class="dropdown-item" href="#">Link 3</a>
                                                </div>
                                            </div>
                                            <p class="float-right fsize14 dark_200 mt-1 mb-0 ml-5">{{displayDateFormat('M d, Y', review.created)}}</p>
                                            <button class="btn btn-sm-24 bkg_blue_000 pr10 pl10 blue_300 fsize12 fw500 mt-1 float-right">Published</button>
                                        </div>-->
                                    </div>
                                </div>
                                <p class="fsize14 fw500 dark_800 lh_22 mb-2">{{review.review_title}}</p>
                                <p class="fsize14 fw400 dark_600 lh_22" v-html="review.comment_text"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card p20 pl30 pr30 " style="min-height: 165px;">
                            <ul class="nav nav-pills review_sec_tab2 mt-0 mb20 bbot pb20" role="tablist">
                                <!--<li class="mr20">
                                    <a class="htxt_bold_14 active" data-toggle="pill" href="#AddComment" @click="displayActivity='commentSection'"><i class="ri-edit-box-line"></i>&nbsp; Add a comment</a>
                                </li>-->
                                <li class="mr20">
                                    <a class="htxt_bold_14 active" data-toggle="pill" href="#AddNote" @click="displayActivity='notesSection'"><i class="ri-edit-box-line"></i> &nbsp; New note</a>
                                </li>
                                <li class="mr20">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#Chat"><i class="ri-chat-1-line"></i> &nbsp; Chat</a>
                                </li>
                                <li class="mr20">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#Email"><i class="ri-mail-line"></i> &nbsp; Email</a>
                                </li>
                                <li class="mr20">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#TextMessage"><i class="ri-chat-4-line"></i> &nbsp; SMS</a>
                                </li>
                                <li class="mr20">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#Review"><i class="ri-star-line"></i> &nbsp; Review</a>
                                </li>
                                <li class="">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#Logactivity" @click="displayActivity='commentSection'"><i class="ri-add-line"></i> &nbsp; Log activity</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!--<div id="AddComment" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-11"><textarea class="border-0 w-100 fsize14 dark_200" v-model="comment_content" style="resize: none" placeholder="Start writing your comment here."></textarea></div>
                                        <div class="col-md-1 text-right"><button style="width: 36px!important;" class="border-0 bkg_none p-0" type="submit" @click="addComment"><img src="assets/images/review_send_btn_36.svg"></button></div>
                                    </div>
                                </div>-->
                                <!--======Tab 1====-->
                                <div id="AddNote" class="tab-pane ">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <textarea class="border-0 w-100 fsize14 dark_200" v-model="notes" style="resize: none" placeholder="Start writing your note here. Use @ to mention your teammates."></textarea>
                                        </div>
                                        <div class="col-md-1 text-right"><button style="width: 36px!important;" class="border-0 bkg_none p-0" type="submit" @click="addNotes"><img src="assets/images/review_send_btn_36.svg"></button></div>
                                    </div>
                                </div>
                                <!--======Tab 2=====-->
                                <div id="Chat" class="tab-pane fade">
                                    Chat
                                </div>
                                <!--======Tab 3=====-->
                                <div id="Email" class="tab-pane fade">
                                    Email
                                </div>
                                <!--======Tab 4=====-->
                                <div id="TextMessage" class="tab-pane fade">
                                    Text Message
                                </div>
                                <!--======Tab 5=====-->
                                <div id="Review" class="tab-pane fade">
                                    Review
                                </div>
                                <!--======Tab 5=====-->
                                <div id="Logactivity" class="tab-pane fade">
                                    Log activity
                                </div>
                            </div>

                        </div>

                        <div class="table_head_action mt-1 mb20">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 v-if="displayActivity=='notesSection'" class="htxt_medium_14 dark_600">Notes</h3>
                                    <h3 v-else class="htxt_medium_14 dark_600">Activity</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="table_action">
                                        <div class="float-right">
                                            <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                                Sort by Date
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Link 1</a>
                                                <a class="dropdown-item" href="#">Link 2</a>
                                                <a class="dropdown-item" href="#">Link 3</a>
                                            </div>
                                        </div>
                                        <div class="float-right ml10 mr10">
                                            <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                                All types
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Link 1</a>
                                                <a class="dropdown-item" href="#">Link 2</a>
                                                <a class="dropdown-item" href="#">Link 3</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-if="displayActivity=='commentSection'">
                            <div v-if="commentData && commentData.length > 0" class="col-md-12">
                                <div v-for="comment in commentData" class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_light_800 mb-0"><i class="ri-price-tag-3-line light_000 fsize18"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">{{ capitalizeFirstLetter(comment.firstname) + ' ' + capitalizeFirstLetter(comment.lastname) }} added a comment</p>
                                            <p class="htxt_regular_14 dark_400 mb0 lh_22">{{ comment.content }}.</p>
                                        </div>
                                        <div class="time"><p class="htxt_regular_13 dark_200 ls_4">{{ displayDateFormat('M d, Y H:i A', comment.created) }}</p></div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="col-md-12">
                                <div class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            No Record Found.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-if="displayActivity=='notesSection'">
                            <div v-if="notesData && notesData.length > 0"  class="col-md-12">
                                <div v-for="note in notesData" class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_blue_200 mb-0"><i><img src="assets/images/message-3-line.svg"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">{{ capitalizeFirstLetter(note.firstname) + ' ' + capitalizeFirstLetter(note.lastname) }} added a note</p>
                                            <p class="htxt_regular_14 dark_400 mb0">{{ note.notes }}</p>
                                        </div>
                                        <div class="time"><p class="htxt_regular_14 dark_200">{{ displayDateFormat('M d, Y H:i A', note.created) }}</p></div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="col-md-12">
                                <div class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            No Record Found.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p25 pt20 animate_top">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_600 m-0 float-left">PRODUCT</p>
                                </div>
                                <div class="col">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical.svg"></span> </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(647px, 102px, 0px);"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                            <div class="pt10 pb0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="media">
                                            <div class="media_left">
                                                <img width="56" style="max-width: 56px!important" src="assets/images/product_info.svg"/>
                                            </div>
                                            <div class="media_left">
                                                <h3 class="htxt_medium_16 dark_800 mt-1">{{ capitalizeFirstLetter(productData.product_name) }}</h3>
                                                <p class="fsize14 dark_200 m-0">{{ capitalizeFirstLetter(productData.product_type) }} Product</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="card p25 pt20 animate_top">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_600 m-0 float-left ">PRODUCT SUMMARY</p>
                                </div>
                                <div class="col">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical.svg"></span> </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(647px, 102px, 0px);"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                            <div class="text-center p20 pt10">
                                <!--<h3 class="lh_120 dark_700 htxt_regular_36">{{ number_format(reviewStats.totalReviews, 1) }}</h3>-->
                                <h3 class="lh_120 dark_700 htxt_regular_36">{{ number_format(review.ratings, 1) }}</h3>
                                <p class="m-0 fsize13"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i> &nbsp; 33,87%</span>last month</p>
                            </div>
                            <div class="ratings">
                                <ul class="ratinglist">
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">5 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.fiveStar}`">
                                                    <div class="progress-bar progress-bar-info bkg_green_400" role="progressbar" :aria-valuenow="reviewStats.fiveStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.fiveStarPercent" :style="`width:${reviewStats.fiveStarPercent}%`"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>{{ reviewStats.fiveStar }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">4 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.fourStar}`">
                                                    <div class="progress-bar progress-bar-info bkg_green_400" role="progressbar" :aria-valuenow="reviewStats.fourStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.fourStarPercent" :style="`width:${reviewStats.fourStarPercent}%`"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>{{ reviewStats.fourStar }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">3 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.threeStar}`">
                                                    <div class="progress-bar progress-bar-info bkg_yellow_400" role="progressbar" :aria-valuenow="reviewStats.threeStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.threeStarPercent" :style="`width:${reviewStats.threeStarPercent}%`"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>{{ reviewStats.threeStar }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">2 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.twoStar}`">
                                                    <div class="progress-bar progress-bar-info bkg_red_400" role="progressbar" :aria-valuenow="reviewStats.twoStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.twoStarPercent" :style="`width:${reviewStats.twoStarPercent}%`"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>{{ reviewStats.twoStar }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">1 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.oneStar}`">
                                                    <div class="progress-bar progress-bar-info bkg_red_400" role="progressbar" :aria-valuenow="reviewStats.oneStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.oneStarPercent" :style="`width:${reviewStats.oneStarPercent}%`"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>{{ reviewStats.oneStar }}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Media</h3>
                            <hr>

                            <div v-if="review.mediaArr.image && review.mediaArr.image.length > 0" class="row">
                                <div v-for="media in review.mediaArr.image" class="col-6">
                                    <img width="100%" class="br5 mb25" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/${media}`"/>
                                </div>
                            </div>

                            <div v-if="review.mediaArr.video && review.mediaArr.video.length > 0" class="row">
                                <div v-for="video in review.mediaArr.video" class="col-6">
                                    <video class="media br5 " height="100%" width="100%" controls><source id="bb_video_enlarge" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/${video}`" type="video/mp4"></video>
                                    <div class="caption-overflow smallovfl"><a class="preview_video_src" style="cursor: pointer;" :filepath="`https://s3-us-west-2.amazonaws.com/brandboost.io/${video}`" fileext="mp4"><i class="icon-eye"></i></a></div>
                                </div>
                            </div>

                        </div>

                        <div v-if="tagsData && tagsData.length > 0" class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Tags</h3>
                            <hr>
                            <div>
                                <button v-for="tags in tagsData" class="tags_btn mb-3">{{ tags.tag_name }}</button>
                                <button class="tags_btn mb-3 applyInsightTagsReviewsNew" :reviewid="review.id" action_name="review-tag">+</button>
                            </div>
                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Details</h3>
                            <hr>
                            <ul class="info_list">
                                <li><span>ID</span><strong>{{ reviewId }}</strong></li>
                                <li><span>Order ID</span><strong>{{ productData.brandboost_id }}</strong></li>
                                <li><span>Product ID</span><strong>{{ productData.id }}</strong></li>
                                <li><span>Source</span><strong>email</strong></li>
                            </ul>
                        </div>
                    </div>

                    </div>

                </div>
            </div>

        <div id="ReviewTagListModalNew" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" name="frmReviewTagListModalNew" id="frmReviewTagListModalNew" action="javascript:void();">
                        <div class="modal-header">
                            <h5 class="modal-title">Apply Tags</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="tagEntireListReview"></div>

                        <div class="modal-footer modalFooterBtn">
                            <input type="hidden" name="review_id" id="tag_review_id" />
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn dark_btn frmReviewTagListModalBtn">Apply Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>
<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import OnsiteReviewsSummary from '@/components/admin/brandboost/onsite/tabs/ReviewsSummary';

    export default {
        components: {UserAvatar, OnsiteReviewsSummary},
        data() {
            return {



                reviewId: this.$route.params.id,
                review: '',
                productData: '',
                notesData: '',
                tagsData: '',
                breadcrumb: '',
                reviewStats: '',
                comment_content: '',
                notes: '',
                commentData: '',
                displayActivity: 'notesSection'
            }
        },
        mounted() {
            this.loadReviewData();
        },
        methods:{
            loadReviewData: function(){
                axios.get('/admin/brandboost/reviewInfo/' + this.reviewId)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.review = response.data.reviewData;
                        this.productData = response.data.productData;
                        this.notesData = response.data.reviewNotesData;
                        this.tagsData = response.data.reviewTags;
                        this.reviewStats = response.data.reviewStats;
                        this.commentData = response.data.reviewCommentsData;
                        this.notesData = response.data.reviewNotesData;
                        this.showLoading(false);
                        console.log((this.review.mediaArr));
                    });
            },
            addComment: function () {
                this.showLoading(true);
                axios.post('/admin/comments/add_comment',  {
                    comment_content: this.comment_content,
                    reviweId: this.review.id,

                })
                    .then(response => {
                        if(response.data.status =='success'){
                            this.comment_content = '';
                            this.displayMessage('success', response.data.message);
                            this.loadReviewData();
                            this.showLoading(false);
                        }

                    });
            },
            addNotes: function () {
                this.showLoading(true);
                axios.post('/admin/reviews/saveReviewNotes',  {
                    notes: this.notes,
                    reviewid: this.review.id,
                    cid: this.review.user_id,
                    bid: this.review.bbId
                })
                    .then(response => {
                        if(response.data.status =='success'){
                            this.notes = '';
                            this.displayMessage('success', response.data.message);
                            this.loadReviewData();
                            this.showLoading(false);
                        }

                    });
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

                                this.displayMessage('success', 'Action completed successfully.');
                                setTimeout(function () {
                                    location.reload(true);
                                }, 5000);
                            }

                        });
                }
            }

        }
    }

    $(document).ready(function () {

        $(document).on("click", ".applyInsightTagsReviewsNew", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");

            $.ajax({
                url: '/admin/tags/listAllTags',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
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

                        $("#tagEntireListReview").html(dataString);
                        $("#tag_review_id").val(review_id);
                        $("#tag_feedback_id").val(feedback_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModalNew").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModalNew").modal("show");
                        }
                    }
                }
            });
        });

        //$("#frmReviewTagListModalNew").submit(function () { alert("here")
        $(document).on("click", ".frmReviewTagListModalBtn", function () {
            var formdata = $("#frmReviewTagListModalNew").serialize();
            $.ajax({
                url: '/admin/tags/applyReviewTag',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#review_tag_" + data.id).html(data.refreshTags);
                        $("#ReviewTagListModalNew").modal("hide");
                        //window.location.href = '';
                    } else {
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

    });
</script>
