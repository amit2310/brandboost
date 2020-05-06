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
                        <h3 class="htxt_medium_24 dark_700">Review Requests</h3>
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
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/download-fill-review.svg"></span>
                                        Import review requests
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
                                    <img class="mt40" style="max-width: 250px; " src="assets/images/review_request.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No review request so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import review request!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Create review request</button>
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
                            <h3 class="htxt_medium_16 dark_400">{{ count }} &nbsp; Review requests</h3>
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
                                <tr v-for="request in requests">
                                    <td>
                                        <span class="table-img mr15">
                                           <!-- <span class="fl_name bkg_red_light red_300">vw</span>-->
                                            <user-avatar
                                                :avatar="request.avatar"
                                                :firstname="request.firstname"
                                                :lastname="request.lastname"
                                            ></user-avatar>
                                        </span>
                                        <span class="htxt_medium_14 dark_900">{{ capitalizeFirstLetter(request.firstname) }} {{ capitalizeFirstLetter(request.lastname) }}</span>
                                    </td>
                                    <td><span><img src="assets/images/mail-line.svg"/></span>&nbsp; {{ capitalizeFirstLetter(request.tracksubscribertype) }} </td>
                                    <td>{{ request.email }}</td>
                                    <td>{{ displayDateFormat('M d, h:i A', request.created) }}</td>
                                    <td class="text-right">

                                        <span v-for="rating in request.ratings" class="icons">
                                            <img src="assets/images/star-fill_yellow_16.svg">
                                        </span>

                                        <span v-for="rating in (5 - request.ratings)" class="icons">
                                            <img src="assets/images/star-line.svg">
                                        </span>

                                        <span class="dark_400 fsize14">{{ request.ratings }}/5</span>

                                        <br />

                                        <span v-if="request.ratings >= 4" class="dark_400 fsize14">Positive</span>
                                        <span v-else-if="request.ratings == 3" class="dark_400 fsize14">Neutral</span>
                                        <span v-else-if="request.ratings < 3 && request.ratings >= 1" class="dark_400 fsize14">Negative</span>
                                        <span v-else class="dark_400 fsize14">&nbsp;</span>
                                    </td>
                                    <td>
                                        <div class="float-right">

                                            <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
                                                <span><img src="assets/images/more-vertical.svg"></span>
                                            </button>

                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a v-if="request.subscriberstatus == '1'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(request.subscriberid, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                                <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(request.subscriberid, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(request.subscriberid,request.trackinglogid)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
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

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar},
        data(){
            return {
                successMsg : '',

                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                count : 0,
                requests : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/review_request/offsite')
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.requests = response.data.oFilteredRequests;
                        this.count = response.data.totalCount;
                        this.allData = response.data.allData;
                        this.loading = false;
                        console.log(this.requests)
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
            changeStatus: function(subscriberId, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/update_subscriber_status', {
                        subscriber_id:subscriberId,
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
</script>
