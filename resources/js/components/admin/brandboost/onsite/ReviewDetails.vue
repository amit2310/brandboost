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
                        <button class="btn btn-md bkg_light_000 reviews_400 fw500" data-toggle="modal" data-target="#CREATEFORM">Approve <span><img src="assets/images/arrow-down-s-line-review.svg"></span></button>
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

                <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                <loading :isLoading="loading"></loading>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p0">
                            <div class="p30 bbot pt20 pb20">
                                <div class="bbot mb30">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="circle_icon_24 bkg_reviews_400 mr-3">{{ review.firstname.charAt(0) }}</span>
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
                                    <a class="htxt_bold_14" data-toggle="pill" href="#AddNote" @click="displayActivity='notesSection'"><i class="ri-edit-box-line"></i> &nbsp; New note</a>
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
                                        <div class="col-md-11"><textarea class="border-0 w-100 fsize14 dark_200" style="resize: none" placeholder="Start writing your note here. Use @ to mention your teammates."></textarea></div>
                                        <div class="col-md-1 text-right"><button style="width: 36px!important;" class="border-0 bkg_none p-0" type="submit"><img src="assets/images/review_send_btn_36.svg"></button></div>
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
                                    <h3 class="htxt_medium_14 dark_600">Activity</h3>
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
                            <div class="col-md-12">

                                <div v-if="commentData.length > 0" v-for="comment in commentData" class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_light_800 mb-0"><i class="ri-price-tag-3-line light_000 fsize18"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">{{ capitalizeFirstLetter(comment.firstname) + ' ' + capitalizeFirstLetter(comment.lastname) }} added a comment</p>
                                            <p class="htxt_regular_14 dark_400 mb0 lh_22">{{ comment.content }}.</p>
                                        </div>
                                        <div class="time"><p class="htxt_regular_13 dark_200 ls_4">{{ displayDateFormat('M d, Y H:i A', comment.created) }}</p></div>
                                    </div>
                                </div>

                                <div v-else class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            No Record Found.
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row" v-if="displayActivity=='notesSection'">
                            <div class="col-md-12">
                                <div v-if="notesData.length > 0" v-for="note in notesData" class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_blue_200 mb-0"><i><img src="assets/images/message-3-line.svg"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">{{ capitalizeFirstLetter(note.firstname) + ' ' + capitalizeFirstLetter(note.lastname) }} added a note</p>
                                            <p class="htxt_regular_14 dark_400 mb0">{{ note.notes }}</p>
                                        </div>
                                        <div class="time"><p class="htxt_regular_14 dark_200">{{ displayDateFormat('M d, Y H:i A', note.created) }}</p></div>
                                    </div>
                                </div>

                                <div v-else class="activity_date_small">
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
                                                <h3 class="htxt_medium_16 dark_800 mt-1">Nintendo</h3>
                                                <p class="fsize14 dark_200 m-0">Website Product</p>
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
                                <h3 class="lh_120 dark_700 htxt_regular_36">4.1</h3>
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
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                    <div class="progress-bar progress-bar-info bkg_green_400" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>37</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">4 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                    <div class="progress-bar progress-bar-info bkg_green_400" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:70%"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>57</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">3 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                    <div class="progress-bar progress-bar-info bkg_yellow_400" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20" style="width:20%"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>5</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">2 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                    <div class="progress-bar progress-bar-info bkg_red_400" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width:80%"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>7</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row inner">
                                            <div class="star_sec">
                                                <p class="dark_500">1 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                            </div>
                                            <div class="progress_sec">
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                    <div class="progress-bar progress-bar-info bkg_red_400" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20" style="width:20%"></div>
                                                </div>
                                            </div>
                                            <div class="star_sec text-right">
                                                <p>125</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Media</h3>
                            <hr>


                            <div class="row">
                                <div class="col-6"><img width="100%" class="br5 mb25" src="assets/images/media1.svg"/></div>
                                <div class="col-6"><img width="100%" class="br5 mb25" src="assets/images/media2.svg"/></div>
                                <div class="col-6"><img width="100%" class="br5 mb25" src="assets/images/media3.svg"/></div>
                                <div class="col-6"><img width="100%" class="br5 mb25" src="assets/images/media4.svg"/></div>



                            </div>

                        </div>



                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Tags</h3>
                            <hr>
                            <div>
                                <button class="tags_btn mb-3">customer</button>
                                <button class="tags_btn mb-3">email</button>
                                <button class="tags_btn mb-3">4 star</button>
                                <button class="tags_btn mb-3">website about</button>
                                <button class="tags_btn mb-3">positive</button>
                                <button class="tags_btn mb-3">4 star</button>
                                <button class="tags_btn mb-3">male</button>
                                <button class="tags_btn mb-3">user</button>
                                <button class="tags_btn mb-3">+</button>
                            </div>
                        </div>



                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Details</h3>
                            <hr>
                            <ul class="info_list">
                                <li><span>ID</span><strong>2423423</strong></li>
                                <li><span>Order ID</span><strong>3332</strong></li>
                                <li><span>Product ID</span><strong>20</strong></li>
                                <li><span>Source</span><strong>email</strong></li>
                            </ul>
                        </div>







                    </div>

                </div>
            </div>
        </div>

    </div>

</template>
<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    export default {
        components: {UserAvatar},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
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
                displayActivity: 'commentSection'
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
                        this.loading = false;
                    });
            },
            addComment: function () {
                this.loading = true;
                axios.post('/admin/comments/add_comment',  {
                    comment_content: this.comment_content,
                    reviweId: this.review.id,

                })
                    .then(response => {
                        if(response.data.status =='success'){
                            this.comment_content = '';
                            this.successMsg = response.data.message;
                            this.loadReviewData();
                            this.loading = false;
                        }

                    });
            },
            addNotes: function () {
                this.loading = true;
                axios.post('/admin/reviews/saveReviewNotes',  {
                    notes: this.notes,
                    reviewid: this.review.id,
                    cid: this.review.user_id,
                    bid: this.review.bbId
                })
                    .then(response => {
                        if(response.data.status =='success'){
                            this.notes = '';
                            this.successMsg = response.data.message;
                            this.loadReviewData();
                            this.loading = false;
                        }

                    });
            },

        }
    }
</script>
