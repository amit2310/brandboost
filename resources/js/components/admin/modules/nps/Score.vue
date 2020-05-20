<template>

    <div class="content" id="masterContainer">

        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">NPS Score</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">

            <div v-if="feedbacks.length > 0" class="container-fluid">


                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ feedbacks.length }} NPS Survey Score</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th><i class="icon-user"></i> Contact</th>
                                <th><i class="icon-stack-star"></i> Program</th>
                                <th><i class="icon-display"></i> Phone</th>
                                <th><i class="icon-calendar"></i> Created</th>
                                <th><i class="icon-hash"></i> Score</th>
                                <th><i class="icon-atom"></i> Feedback</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="feedback in feedbacks">
                                <td>
                                    <span class="table-img mr15">
                                        <user-avatar
                                            :avatar="feedback.avatar"
                                            :firstname="feedback.firstname"
                                            :lastname="feedback.lastname"
                                        ></user-avatar>
                                    </span>
                                    <span v-if="feedback.firstname != ''">
                                        <span class="htxt_medium_14 dark_900">
                                            {{ capitalizeFirstLetter(feedback.firstname) }} {{ capitalizeFirstLetter(feedback.lastname) }}
                                        </span>
                                        <br />
                                        <span style="padding-left: 50px;">
                                        {{ (feedback.email != '' ? feedback.email : '') }}
                                        </span>
                                    </span>
                                    <span v-else>
                                        <span class="htxt_medium_14 dark_900">
                                            {{ capitalizeFirstLetter(feedback.feedback_fullname) }}
                                        </span>
                                        <br />
                                        <span style="padding-left: 50px;">
                                        {{ (feedback.feedback_email != '' ? feedback.feedback_email : '') }}
                                        </span>
                                    </span>
                                </td>
                                <td @click="navigateToSetup(feedback.npsID)" style="cursor: pointer;">
                                    {{ feedback.campaignTitle }}
                                    <br />
                                    {{ capitalizeFirstLetter(feedback.platform) }}
                                </td>
                                <td>
                                   <span v-if="feedback.phone">
                                        {{ feedback.phone }}
                                        <br />{{ 'Chat' }}
                                   </span>
                                    <span v-else>[No Data]</span>
                                </td>
                                <td>
                                    {{ displayDateFormat('d M Y, h:i A', feedback.created_at) }}
                                </td>
                                <td align="center">
                                    {{ feedback.score > 0 ? feedback.score : 0 }}
                                </td>
                                <td>
                                    <div class="media-left">
                                        <a style="cursor: pointer;" class="showFeedbackData">
                                            <span class="text-default"><strong>{{ setStringLimit(feedback.title, 40) }}</strong></span>
                                        </a>
                                        <div style="display: none;">{{ setStringLimit(feedback.title, 40) }}</div>
                                        <div style="display: none;">{{ feedback.feedback != '' ? feedback.feedback : '[No Data]' }}</div>
                                        <div class="text-muted text-size-small">
                                            {{ feedback.feedback != '' ? setStringLimit(feedback.feedback, 60) : '' }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>
            </div>

            <div v-else class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">

                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="assets/images/illustration2.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any NPS Survey Score</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create!</h3>
                                    <button class="btn btn-sm bkg_blue_000 pr20 blue_300">Add NPS Survey Score</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    &nbsp;
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                        Learn how to use NPS Survey Score
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->


        <!-- showFeedback -->
        <div id="showFeedbackModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header purple_preview_2 purple_preview_2">
                        <h5 class="modal-title"><img src="assets/images/customer_profile_icon.png"> NPS Score Feedback</h5>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body p30 minh180">
                        <label class="fsize11 m0">Heading :</label>
                        <p class="feedbackHeading fw600 fsize14 text-dark mb10"></p>

                        <label class="fsize11 m0">Description :</label>
                        <p class="feedbackContent fsize13"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'NPS Survey Score - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {



                breadcrumb: '',
                moduleName: 'nps',
                moduleUnitID: '',
                moduleAccountID: '',
                hashKey: '',
                current_page: 1,
                allData: '',
                feedbacks: '',
                totalCnt: 0
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            navigateToSetup: function(id){
                window.location.href='#/modules/nps/setup/'+id;
            },
            loadPaginatedData: function () {
                //getData
                axios.get('/admin/modules/nps/score/'+this.$route.params.hashKey)
                    .then(response => {
                        //console.log(response.data); return false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.feedbacks = response.data.oFeedbacks;
                        this.allData = response.data.allData;
                        this.totalCnt = this.allData.total;
                        //console.log(this.feedbacks);
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            navigatePagination: function (p) {
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    };

    $(document).ready(function () {

        $(document).on('click', '.showFeedbackData', function () {
            $('.feedbackHeading').html($(this).next().text());
            $('.feedbackContent').html($(this).next().next().text());
            $('#showFeedbackModal').modal();
        });

    });
</script>
