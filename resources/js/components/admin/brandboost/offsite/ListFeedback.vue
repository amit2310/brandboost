<template>
    <div>
    <div class="row" v-if="allData.total>0">
        <div class="col-md-12">
            <div class="table_head_action mt-2">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="htxt_medium_16 dark_400">{{ allData.total }} &nbsp; Feedback</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="table_action">
                            <div class="float-right">
                                <button type="button" class="dropdown-toggle table_action_dropdown"
                                        data-toggle="dropdown">
                                    <span><img src="assets/images/date_created.svg"></span>&nbsp; Date Created
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item" href="#">Link 3</a>
                                </div>
                            </div>
                            <div class="float-right ml10 mr10">
                                <button type="button" class="dropdown-toggle table_action_dropdown"
                                        data-toggle="dropdown">
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
                                                :width="32"
                                                :height="32"
                                                :fontsize="12"
                                            ></user-avatar>
                                        </span>
                                    <span class="htxt_medium_14 dark_900">{{ capitalizeFirstLetter(feedback.firstname) }} {{ capitalizeFirstLetter(feedback.lastname) }}</span>
                                </td>
                                <td>{{ feedback.email }}</td>
                                <td @click="navigateToCampaignDetails(feedback.brandboost_id)" style="cursor:pointer;">
                                    {{ setStringLimit(capitalizeFirstLetter(feedback.brand_title), 25) }}
                                    <span v-if="feedback.brand_desc != ''"><br /><em>{{ setStringLimit(capitalizeFirstLetter(feedback.brand_desc), 40) }}</em></span>
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
                @paginate="navigatePagination"
                :offset="4">
            </pagination>
        </div>
    </div>
    <div class="row" v-else >
        <div class="col-md-12">
            <div class="card card_shadow min-h-280">

                <div class="row mb65">
                    <div class="col-md-6 text-left">
                        <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                            <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                            Set up reviews monitoring
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="lh_32 htxt_regular_14 dark_200" href="#">
                            <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                            Learn how to use reviews monitoring
                        </a>
                    </div>
                </div>


                <div class="row mb65">
                    <div class="col-md-12 text-center">
                        <img class="mt40" style="max-width: 240px; " src="assets/images/review_feed_illustration.svg">
                        <h3 class="htxt_bold_18 dark_700 mt30">No reviews so far. Connect reviews site!</h3>
                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">Reviews from 50+ review sites, at your fingertips...</h3>
                        <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Monitor reviews site</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div id="FTM" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" name="frmFTM" id="frmFTM" action="javascript:void(0);">
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
    import ContactTags from "../../contact/ContactTags";

    export default {
        props: ['campaignId'],
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                current_page: '1',
                feedbacks: '',
                allData: '',
                feedbackTags: ''

            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData: function () {
                let srcUrl;
                if(this.campaignId){
                    srcUrl = '/admin/feedback/listall/'+this.campaignId+'?page='+this.current_page;
                }else{
                    srcUrl = '/admin/feedback/listall?page='+this.current_page;
                }
                axios.get(srcUrl)
                    .then(response => {
                        this.moduleName = response.data.moduleName;
                        this.allData = response.data.allData;
                        this.feedbacks = response.data.result;
                        this.count = response.data.totalResults;
                        this.feedbackTags = response.data.feedbackTags;
                        this.loading = false;
                    });
            },
            changeStatus: function(fid, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/feedback/updateFeedbackStatus', {
                        fid:fid,
                        status:status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitID,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigateToCampaignDetails: function(campaign_id){
                window.location.href='#/reviews/offsite/setup/'+campaign_id;
            },
            navigateToFeedbackDetails: function(id){
                window.location.href='#/feedback/'+id;
            },
        }

    };
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
                        $("#tag_feedback_id").val(feedback_id);
                        $("#FTM").modal("show");
                    }
                }
            });
        });

        $("#frmFTM").submit(function () {
            var formdata = $("#frmFTM").serialize();
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
