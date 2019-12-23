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
                        <h3 class="htxt_medium_24 dark_700">Offsite Brand Boost Feedback</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40"><img src="assets/images/filter_review.svg"/></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div class="container-fluid" v-if="count <= 0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                                        Set up feedback monitoring
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                                        Learn how to use feedback monitoring
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 240px; " src="assets/images/review_feed_illustration.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No feedback so far. Connect feedback site!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">Feedback from 50+ review sites, at your fingertips...</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 ">Monitor feedback site</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid" v-else>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 pt0 pb0">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="fsize12 fw500 yellow_500 mt30 mb30"><i><img src="assets/images/lightbulb-fill1_yellow.svg"></i> &nbsp; TIPS</p>
                                    <h3 class="htxt_bold_18 dark_800">Automate messages, build engage with chatbots</h3>
                                    <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">Conversational marketing platform that helps companies close more deals by messaging with prospects in real-time &amp; via intelligent chatbots. Qualify leads, book meetings.</p>

                                </div>
                                <div class="col-md-5 text-center mt20">
                                    <img class="mt0" style="max-width: 272px;" src="assets/images/review_request.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table_head_action mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ count }} Off Site Brand Boost Feedback</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr v-for="feedback in feedbacks">
                                    <td>
                                        <span class="table-img mr15">
                                           <!-- <span class="fl_name bkg_red_light red_300">vw</span>-->
                                            <user-avatar
                                                :avatar="feedback.avatar"
                                                :firstname="feedback.firstname"
                                                :lastname="feedback.lastname"
                                            ></user-avatar>
                                        </span>
                                        <span class="htxt_medium_14 dark_900">{{ capitalizeFirstLetter(feedback.firstname) }} {{ capitalizeFirstLetter(feedback.lastname) }}</span>
                                    </td>
                                    <td>{{ feedback.email }}</td>
                                    <td @click="navigateToCampaignDetails(feedback.brandboost_id)" style="cursor:pointer;">
                                        {{ setStringLimit(capitalizeFirstLetter(feedback.brand_title), 25) }}
                                        <span v-if="feedback.brand_desc != ''"><br /><em>( {{ setStringLimit(capitalizeFirstLetter(feedback.brand_desc), 40) }} )</em></span>
                                    </td>
                                    <td @click="navigateToFeedbackDetails(feedback.id)" style="cursor:pointer;">
                                        {{ setStringLimit(capitalizeFirstLetter(feedback.feedback), 25) }}
                                    </td>
                                    <td>{{ displayDateFormat('M d, h:i A', feedback.created) }}</td>
                                    <td :id="'feedback_tag_' + feedback.id">
                                        <button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle" data-toggle="dropdown"> {{ feedbackTags[feedback.id].length }} Tags <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right tagss">
                                            <span v-if="feedbackTags[feedback.id].length" v-for="feedbackTag in feedbackTags[feedback.id]">
                                                <button class="btn btn-xs btn_white_table pr10"> {{ feedbackTag.tag_name }} </button>
                                            </span>
                                            <button class="btn btn-xs plus_icon ml10 applyInsightTagsReviewsNew" :feedback_id="feedback.id" action_name="feedback-tag"><i class="icon-plus3"></i></button>
                                        </ul>
                                        <button class="btn btn-xs plus_icon ml10 applyInsightTagsFeedbackNew" :feedback_id="feedback.id" action_name="feedback-tag"><i class="icon-plus3"></i></button>
                                    </td>
                                    <td class="text-right">
                                        <span v-for="rating in feedback.ratings" class="icons">
                                            <img src="assets/images/star-fill_yellow_16.svg">
                                        </span>

                                        <span v-for="rating in (5 - feedback.ratings)" class="icons">
                                            <img src="assets/images/star-line.svg">
                                        </span>

                                        <span class="dark_400 fsize14">{{ feedback.ratings }}/5</span>

                                        <br />

                                        <span v-if="feedback.ratings >= 4" class="dark_400 fsize14">Positive</span>
                                        <span v-else-if="feedback.ratings == 3" class="dark_400 fsize14">Neutral</span>
                                        <span v-else-if="feedback.ratings < 3 && feedback.ratings >= 1" class="dark_400 fsize14">Negative</span>
                                        <span v-else class="dark_400 fsize14">&nbsp;</span>
                                    </td>
                                    <td>
                                        <div class="float-right">

                                            <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
                                                <span><img src="assets/images/more-vertical.svg"></span>
                                            </button>

                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a v-if="feedback.status == '1'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(feedback.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                                <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(feedback.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="navigateToFeedbackDetails(feedback.id)"><i class="dripicons-exit text-muted mr-2"></i> View Details</a>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>

            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->

        <div id="FeedbackTagListModalNew" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" name="frmFeedbackTagListModalNew" id="frmFeedbackTagListModalNew" action="javascript:void();">
                        <div class="modal-header">
                            <h5 class="modal-title">Apply Tags</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body" id="tagEntireListFeedback"></div>

                        <div class="modal-footer">
                            <input type="hidden" name="feedback_id" id="tag_feedback_id" />
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Apply Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import Pagination from '../../../helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                count : 0,
                feedbacks : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                feedbackTags: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
        },
        methods: {
            navigateToCampaignDetails: function(campaign_id){
                window.location.href='#/reviews/offsite/setup/'+campaign_id;
            },
            navigateToFeedbackDetails: function(id){
                window.location.href='#/feedback/details/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/feedback/listall?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.allData = response.data.allData;
                        this.feedbacks = response.data.result;
                        this.count = response.data.totalResults;
                        this.feedbackTags = response.data.feedbackTags;
                        this.loading = false;
                        console.log(this.feedbacks)
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(fid, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/feedback/updateFeedbackStatus', {
                        fid:fid,
                        status:status,
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
            deleteItem: function(subscriberid,trackinglogid) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/deleteRRrecord', {
                        subscriberId:subscriberid,
                        recordId:trackinglogid,
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
            }
        }
    }

    $(document).ready(function () {

        $(document).on("click", ".applyInsightTagsFeedbackNew", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '/admin/tags/listAllTags',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {feedback_id: feedback_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#tagEntireListFeedback").html(data.list_tags);

                        if (action_name == 'review-tag') {
                            $("#tag_review_id").val(review_id);
                            $("#ReviewTagListModalNew").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#tag_feedback_id").val(feedback_id);
                            $("#FeedbackTagListModalNew").modal("show");
                        }
                    }
                }
            });
        });

        $("#frmFeedbackTagListModalNew").submit(function () {
            var formdata = $("#frmFeedbackTagListModalNew").serialize();
            $.ajax({
                url: 'admin/tags/applyFeedbackTag',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                       // $("#FeedbackTagListModalNew").modal("hide");
                       // window.location.href = window.location.href;
                        $("#feedback_tag_" + data.id).html(data.refreshTags);
                        $("#FeedbackTagListModalNew").modal("hide");
                        //window.location.href = '';
                    }
                }
            });
            return false;
        });

    });
</script>

<style>

</style>
