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
                        <h3 class="htxt_medium_24 dark_700">Manual Review Requests</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img width="16" src="assets/images/settings-2-line.svg"></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
        Content Area
        **********************-->
        <div class="content-area">
            <div class="container-fluid" v-if="requests.length>0 || searchBy || sortBy">
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
                <loading :isLoading="loading"></loading>
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="table_filter">
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == ''}" @click="sortBy=''">ALL</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == '1'}" @click="sortBy='1'">Pending</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == '2'}" @click="sortBy='2'">Sending</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == '3'}" @click="sortBy='3'">Completed</a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="table_filter text-right">
                                <li><a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card p20 datasearcharea br6 shadow3" style="z-index: 999999!important;">
                        <div class="form-group m-0 position-relative">
                            <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                            <a class="search_tables_open_close searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
                        </div>
                    </div>


                </div>




                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr class="headings">
                                    <td><span class="fsize10 fw500">REQUEST </span></td>
                                    <td><span class="fsize10 fw500">TYPE </span></td>
                                    <td><span class="fsize10 fw500">CAMPAIGN</span></td>
                                    <td><span class="fsize10 fw500">CREATED DATE <img src="assets/images/arrow-down-line-14.svg"></span></td>
                                    <td><span class="fsize10 fw500">COMPLETED DATE <img src="assets/images/arrow-down-line-14.svg"></span></td>
                                    <td><span class="fsize10 fw500">SENDING STATUS <img src="assets/images/arrow-down-line-14.svg"></span></td>
                                    <!--<td><span class="fsize10 fw500">REVIEW  </span></td>
                                    <td><span class="fsize10 fw500"><img src="assets/images/eyeline.svg"></span></td>
                                    <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>-->

                                </tr>
                                <tr v-for="request in requests">
                                    <td>{{capitalizeFirstLetter(request.name)}}</td>
                                    <td>{{capitalizeFirstLetter(request.type)}}</td>
                                    <td>{{capitalizeFirstLetter(request.campaignName)}}</td>
                                    <td><span class="">{{displayDateFormat('M d, Y h:i A', request.created)}}</span></td>
                                    <td><span class="">{{request.completed_date ? displayDateFormat('M d, Y h:i A', request.completed_date) : '-'}}</span></td>
                                    <td>
                                        <span v-if="request.cronStatus == 1">Pending</span>
                                        <span v-else-if="request.cronStatus== 2">Sending</span>
                                        <span v-else-if="request.cronStatus == 3">Completed</span>
                                    </td>

                                </tr>
                                </tbody>
                            </table>

                            <pagination
                                :pagination="allData"
                                @paginate="showPaginationData"
                                @paginate_per_page="showPerPageData"
                                :offset="4"
                                class="mt-4">
                            </pagination>

                        </div>
                    </div>

                    <div class="col-md-12 text-center mt-3">
                        <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT review requests</a>
                    </div>
                </div>


            </div>
            <div class="container-fluid" v-else>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min_h_600">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14 d-none" href="javascript:void(0);">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                                        No Request Found
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_12 dark_200 " href="javascript:void(0);">
                                        Learn how use review request &nbsp; <img src="assets/images/question-line.svg">
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 240px; " src="assets/images/reviews_icon_125.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No review request so far!</h3>
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
    import Pagination from '@/components/helpers/Pagination';
    export default {
        components: {Pagination},
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: true,
                allData: '',
                requests: '',
                current_page: 1,
                items_per_page: 10,
                searchBy: '',
                sortBy: ''
            }
        },
        created() {
            this.loadPaginatedData();
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
            loadPaginatedData: function(){
                this.loading = true;
                axios.post('/admin/brandboost/getManualRequests?items_per_page='+this.items_per_page+'&page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy, {campaign_id:this.$route.params.id, _token: this.csrf_token()})
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.requests = response.data.requests;
                        this.allData = response.data.allData;
                        this.loading = false;
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            showPerPageData: function(p){
                this.loading=true;
                this.items_per_page = p;
                this.loadPaginatedData();
            },
        }
    }
</script>
