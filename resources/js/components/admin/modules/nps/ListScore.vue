<template>
    <div class="row" v-if="feedbacks.length>0">
        <div class="col-md-12">
            <div class="table_head_action mt-2">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="htxt_medium_16 dark_400">{{ allData.total }} &nbsp; NPS Score</h3>
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
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Feedback</th>
                                <th>Score</th>
                                <th>Date</th>
                            </tr>
                            </thead>
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
                                    <span class="htxt_medium_14 dark_900" v-html="(feedback.firstname  || feedback.lastname) ? capitalizeFirstLetter(feedback.firstname) + ' ' + capitalizeFirstLetter(feedback.lastname) : displayNoData()"></span>
                                </td>
                                <td v-html="feedback.email ? feedback.email : displayNoData()"></td>
                                <td><a href="javascript:void(0);" target="_blank" @click="displayNPSFeedback(feedback.title, feedback.feedback)">{{ setStringLimit(feedback.feedback, 40) }}</a></td>
                                <td>{{ feedback.score }}</td>
                                <td>{{ displayDateFormat('M d, h:i A', feedback.created_at) }}</td>
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
        <modal-popup v-if="showModal" @close="showModal = false" width="md">
            <h3 slot="header">Feedback Details</h3>
            <div slot="body" class="pt0 pb0">
                <h4 v-html="feedbackTitle"></h4>
                <p class="text mt-3" v-html="feedbackDesc"></p>
                <div class="clearfix"></div>
            </div>
            <div slot="footer">
                <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20" @click="showModal = false">Close</a>
            </div>
        </modal-popup>
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
                        <h3 class="htxt_bold_18 dark_700 mt30">No score given so far. Connect nps score site!</h3>
                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">NPS from 50+ review sites, at your fingertips...</h3>
                        <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Monitor reviews site</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import modalPopup from "@/components/helpers/Common/ModalPopup";


    export default {
        props: ['campaignId'],
        components: {UserAvatar, Pagination, modalPopup},
        data() {
            return {
                showModal: false,
                feedbackTitle: '',
                feedbackDesc: '',


                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaign: {},
                user: {},
                breadcrumb: '',
                current_page: '1',
                feedbacks: '',
                allData: ''

            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData: function () {
                axios.get('/admin/modules/nps/setup/' + this.campaignId + '?page=' + this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.oNPS;
                        this.feedbacks = response.data.oFeedbacks;
                        this.allData = response.data.oFeedbackAllData;
                        this.user = response.data.userData;
                        this.loading = false;
                    });
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            displayNPSFeedback: function(title, description){
                this.feedbackTitle = title;
                this.feedbackDesc = description;
                this.showModal = true;
            }
        }

    };

</script>
