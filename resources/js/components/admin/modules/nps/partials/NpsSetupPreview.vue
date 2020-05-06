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

                <loading :isLoading="loading"></loading>
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

                    <div v-for="feedback in feedbacks" class="col-md-3 text-center">

                        <div class="card p30 animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Link 1</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Link 2</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Link 3</a>
                                    </div>
                                </div>
                            <div>
                                <img class="mt20" src="assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    <span>{{ capitalizeFirstLetter(setStringLimit(feedback.title, 20)) }} <br /> {{ capitalizeFirstLetter(setStringLimit(feedback.campaignTitle, 20)) }}</span>
                                </h3>
                                <p><em>( Platform / Score : {{ feedback.platform }} / <strong>{{ feedback.score }}</strong> )</em></p>
                                <p><em>[Created On: {{ displayDateFormat("M d, Y h:i A", feedback.created_at) }} ]</em></p>
                            </div>
                        </div>

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


                loading: true,
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
                        this.loading = false;
                        this.feedbacks = response.data.oFeedbacks;
                        this.allData = response.data.allData;
                        this.totalCnt = this.allData.total;
                        console.log(this.feedbacks);
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    };
</script>
