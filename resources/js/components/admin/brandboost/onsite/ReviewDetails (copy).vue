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
                        <h3 class="htxt_medium_24 dark_700">Review Page</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="mr15 btn btn-md bkg_light_000 reviews_400">Filters &nbsp; &nbsp; <img src="assets/images/filter_review.svg"></button>
                        <button class="btn btn-md bkg_reviews_300 light_000 slidebox"> Edit review &nbsp; &nbsp; <span><img src="assets/images/review_add.svg"></span></button>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 pt0 pb0">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="fsize12 fw500 dark_200 mt30 mb30"><i><img src="assets/images/lightbulb-fill.svg"></i> &nbsp; TIPS</p>
                                    <h3 class="htxt_bold_18 dark_800">Automate messages, build engage with chatbots</h3>
                                    <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">Conversational marketing platform that helps companies close more deals by messaging with prospects in real-time & via intelligent chatbots. Qualify leads, book meetings.</p>
                                </div>
                                <div class="col-md-5 text-center mt0">
                                    <img class="mt0" style="max-width: 240px;" src="assets/images/review_feed_illustration.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="card p0">
                            <div class="p30 bbot pt20 pb20">
                                <div class="bbot mb30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="fsize16 fw500 dark_700 float-left mr-3"><user-avatar
                                                :avatar="review.avatar"
                                                :firstname="review.firstname"
                                                :lastname="review.lastname"
                                                :width="33"
                                                :height="33"
                                                :fontsize="33"
                                            ></user-avatar> &nbsp;{{review.firstname+ ' ' +review.lastname}}</p>
                                            <p class="mt-1 review_rating_start">
                                                <i class="" v-for="num in [1,2,3,4,5]">
                                                <img v-if="num<=review.ratings" src="assets/images/star-fill_yellow_18.svg">
                                                <img v-else src="assets/images/star-fill_grey_18.svg">
                                                </i>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
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
                                        </div>
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
                        <div class="card p20 pl30 pr30 min_h_240">
                            <ul class="nav nav-pills review_sec_tab mt-0 mb20 bbot pb20" role="tablist">
                                <li class="mr30">
                                    <a class="htxt_bold_14 active" data-toggle="pill" href="#AddComment" @click="displayActivity='commentSection'"><img src="assets/images/reply-fill.svg" /> &nbsp; Add a comment</a>
                                </li>
                                <li class="mr30">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#jsAddNote" @click="displayActivity='notesSection'"><img src="assets/images/edit-box-line.svg" /> &nbsp; New note</a>
                                </li>
                                <li class="mr30">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#Email"><img src="assets/images/mail-open-line.svg" /> &nbsp; Email</a>
                                </li>
                                <li class="mr30">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#TextMessage"><img src="assets/images/message-3-line-16.svg" /> &nbsp; SMS</a>
                                </li>
                                <li class="">
                                    <a class="htxt_bold_14" data-toggle="pill" href="#Review"><img src="assets/images/add-line.svg" /> &nbsp; Log activity</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!--======Tab 1====-->
                                <div id="AddComment" class="tab-pane active">
                                    <div class="p-0 mb20">
                                        <textarea class="border-0 w-100 fsize15 dark_200" v-model="comment_content" style="resize: none" placeholder="Leave your comment here..." ></textarea>
                                    </div>
                                    <div class="p-0 text-right">
                                        <button class="border-0 bkg_none p-0" type="button" @click="addComment" ><img src="assets/images/review_48_send_circle.svg"/></button>
                                    </div>
                                </div>
                                <!--======Tab 2=====-->
                                <div id="jsAddNote" class="tab-pane fade">
                                    <div class="p-0 mb20">
                                        <textarea class="border-0 w-100 fsize15 dark_200" v-model="notes" style="resize: none" placeholder="Leave your note here..." ></textarea>
                                    </div>
                                    <div class="p-0 text-right">
                                        <button class="border-0 bkg_none p-0" type="button" @click="addNotes" ><img src="assets/images/review_48_send_circle.svg"/></button>
                                    </div>
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
                            </div>
                        </div>

                        <div class="table_head_action mt-1 mb25">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_20 dark_700">Activity</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="table_action">
                                        <div class="float-right">
                                            <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                                Last week
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
                                <div v-for="comment in commentData" class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_green_400 mb-0"><i><img src="assets/images/message-3-line.svg"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">{{comment.firstname + ' ' + comment.lastname}} added a comment</p>
                                            <p class="htxt_regular_14 dark_400 mb0">{{comment.content}}</p>
                                        </div>
                                        <div class="time"><p class="htxt_regular_14 dark_200">{{displayDateFormat('M d, Y H:i A', comment.created)}}</p></div>
                                    </div>
                                </div>

                                <!--<div class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_blue_200"><i><img src="assets/images/message-3-line.svg"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">Received SMS</p>
                                            <p class="htxt_regular_14 dark_400 mb0">Hey Alex, do you have few minutes for a quick call at 11:30 AM?</p>
                                            <button class="activity_button"><i><img src="assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
                                        </div>
                                        <div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
                                    </div>
                                </div>

                                <div class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_yellow_400"><i><img src="assets/images/message-3-line.svg"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">Received SMS</p>
                                            <p class="htxt_regular_14 dark_400 mb0">Hey Alex, do you have few minutes for a quick call at 11:30 AM?</p>
                                            <button class="activity_button"><i><img src="assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
                                        </div>
                                        <div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
                                    </div>
                                </div>

                                <div class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_green_400"><i><img src="assets/images/message-3-line.svg"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">Received SMS</p>
                                            <p class="htxt_regular_14 dark_400 mb0">Hey Alex, do you have few minutes for a quick call at 11:30 AM?</p>
                                            <button class="activity_button"><i><img src="assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
                                        </div>
                                        <div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
                                    </div>
                                </div>-->

                            </div>
                        </div>
                        <div class="row" v-if="displayActivity=='notesSection'">
                            <div class="col-md-12">
                                <div v-for="note in notesData" class="activity_date_small">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icons bkg_blue_200 mb-0"><i><img src="assets/images/message-3-line.svg"></i></div>
                                            <p class="htxt_bold_16 dark_800 mb-2">{{note.firstname + ' ' + note.lastname}} added a note</p>
                                            <p class="htxt_regular_14 dark_400 mb0">{{note.notes}}</p>
                                        </div>
                                        <div class="time"><p class="htxt_regular_14 dark_200">{{displayDateFormat('M d, Y H:i A', note.created)}}</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p25 animate_top">
                            <img v-if="review.logo_img" class="float-left mb-3" width="70" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/${review.logo_img}`"/>
                            <img v-else class="float-left mb-3" width="70" src="assets/images/plane_work.svg"/>

                            <p class="fsize16 fw500 dark_800 mb-1">{{review.brand_title}}</p>
                            <p class="fsize14 fw400 dark_500 mb-3 bbot pb-3">{{reviewStats.totalReviews}} reviews</p>

                            <div class="pb-3 pl-3 ratings bbot">
                                <div class="row inner">
                                    <div class="col-1 pr-0 pl-0">
                                        <p>5 <i><img src="assets/images/star-fill-12.png"/> </i></p>
                                    </div>
                                    <div class="col-10">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.fiveStar}`">
                                            <div class="progress-bar progress-bar-info" role="progressbar" :aria-valuenow="reviewStats.fiveStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.fiveStarPercent" :style="`width:${reviewStats.fiveStarPercent}%`"></div>
                                        </div>
                                    </div>
                                    <div class="col-1 pr-0 pl-0"><p>{{reviewStats.fiveStar}}</p></div>
                                </div>

                                <div class="row inner">
                                    <div class="col-1 pr-0 pl-0">
                                        <p>4 <i><img src="assets/images/star-fill-12.png"/> </i></p>
                                    </div>
                                    <div class="col-10">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.fourStar}`">
                                            <div class="progress-bar progress-bar-info" role="progressbar" :aria-valuenow="reviewStats.fourStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.fourStarPercent" :style="`width:${reviewStats.fourStarPercent}%`"></div>
                                        </div>
                                    </div>
                                    <div class="col-1 pr-0 pl-0"><p>{{reviewStats.fourStar}}</p></div>
                                </div>

                                <div class="row inner">
                                    <div class="col-1 pr-0 pl-0">
                                        <p>3 <i><img src="assets/images/star-fill-12.png"/> </i></p>
                                    </div>
                                    <div class="col-10">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.threeStar}`">
                                            <div class="progress-bar progress-bar-info" role="progressbar" :aria-valuenow="reviewStats.threeStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.threeStarPercent" :style="`width:${reviewStats.threeStarPercent}%`"></div>
                                        </div>
                                    </div>
                                    <div class="col-1 pr-0 pl-0"><p>{{reviewStats.threeStar}}</p></div>
                                </div>

                                <div class="row inner">
                                    <div class="col-1 pr-0 pl-0">
                                        <p>2 <i><img src="assets/images/star-fill-12.png"/> </i></p>
                                    </div>
                                    <div class="col-10">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.twoStar}`">
                                            <div class="progress-bar progress-bar-info" role="progressbar" :aria-valuenow="reviewStats.twoStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.twoStarPercent" :style="`width:${reviewStats.twoStarPercent}%`"></div>
                                        </div>
                                    </div>
                                    <div class="col-1 pr-0 pl-0"><p>{{reviewStats.twoStar}}</p></div>
                                </div>

                                <div class="row inner">
                                    <div class="col-1 pr-0 pl-0">
                                        <p>1 <i><img src="assets/images/star-fill-12.png"/> </i></p>
                                    </div>
                                    <div class="col-10">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" :data-original-title="`Total Reviews ${reviewStats.oneStar}`">
                                            <div class="progress-bar progress-bar-info" role="progressbar" :aria-valuenow="reviewStats.oneStarPercent" aria-valuemin="0" :aria-valuemax="reviewStats.oneStarPercent" :style="`width:${reviewStats.oneStarPercent}%`"></div>
                                        </div>
                                    </div>
                                    <div class="col-1 pr-0 pl-0"><p>{{reviewStats.oneStar}}</p></div>
                                </div>
                            </div>

                            <p class="fsize14 dark_600 mt-3 mb-0"><i><img src="assets/images/chat-1-fill.svg"/></i> &nbsp; 13 questions / 10 answers </p>

                        </div>

                        <div class="card p0 animate_top col text-center d-none">
                            <div class="p15 pt15 bbot">
                                <ul class="workflow_list">
                                    <li><a class="text-uppercase fw500 dark_600" href="#">FOLLOWERS</a></li>
                                </ul>
                            </div>
                            <div class="p30">
                                <ul class="templates_list">
                                    <li><a class="active" href="#"><strong><img src="assets/images/menu-2-line.svg"> All</strong> <span>345</span></a></li>
                                    <li><a href="#"><strong><img src="assets/images/heart-line.svg"> My Templates</strong> <span>128</span></a></li>
                                    <li><a href="#"><strong><img src="assets/images/folder-3-line.svg"> Non-profit</strong> <span>13</span></a></li>
                                    <li><a href="#"><strong><img src="assets/images/folder-3-line.svg"> Photography</strong> <span>86</span></a></li>
                                    <li><a href="#"><strong><img src="assets/images/folder-3-line.svg"> Product / Service</strong> <span>31</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card p20 min_h_240 d-none ">
                            <h3 class="htxt_medium_16 dark_800">Info</h3>
                            <hr/>
                            <ul class="info_list">
                                <li><span>Source</span><strong>Email</strong></li>
                                <li><span>First Seen</span><strong>17 Jan 2018</strong></li>
                                <li><span>Lase Seen</span><strong>22 Apr 2018</strong></li>
                                <li><span>Page views</span><strong>139</strong></li>
                                <li><span>Reviews</span><strong>3</strong></li>
                                <li><span>Notification</span><strong>On</strong></li>
                                <li><span>Id</span><strong>310282</strong></li>
                                <li><span>SMS</span><strong>On</strong></li>
                            </ul>
                        </div>

                        <div class="card p20 min_h_240 profile_form">
                            <h3 class="htxt_medium_16 dark_800">Media</h3>
                            <hr>
                            <div class="form-group">
                                <label class="fsize12 fw400 dark_100" for="Leadsource">Lead source</label>
                                <select class="form-control h36">
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label class="fsize12 fw400 dark_100" for="Stage">Stage</label>
                                <select class="form-control h36">
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                    <option>Email Campaign</option>
                                </select>
                            </div>
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
                        this.showLoading(false);
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

        }
    }
</script>
