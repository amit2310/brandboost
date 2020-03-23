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
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"></button>
                        <button class="btn btn-md bkg_reviews_400 light_000 ">SEND NEW REQUEST <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div class="container-fluid" v-if="allData.total>0 || true  ">
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                <loading :isLoading="loading"></loading>
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <!--<li><a href="javascript:void(0);" :class="{'active': viewType == 'Name'}" @click="sortBy='Name'">ALL</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">ACTIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Pending'}" @click="sortBy='Pending'">PENDING</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Positive'}" @click="sortBy='Positive'">POSITIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Negative'}" @click="sortBy='Negative'">NEGATIVE</a></li>-->
                            <ul class="table_filter">
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'all'}" @click="applySort('all')">ALL</a></li>
                                <li><a href="javascript:void(0);">SENT</a></li>
                                <li><a href="javascript:void(0);">DRAFT</a></li>
                                <li><a href="javascript:void(0);">SUBMITED</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'archive'}" @click="applySort('archive')">ARCHIVE</a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="table_filter text-right">
                                <li><a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li v-show="deletedItems.length>0 && sortBy !='archive'"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                                <li><a href="javascript:void(0);" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card p20 datasearcharea reviewRequestSearch br6 shadow3">
                        <div class="form-group m-0 position-relative">
                            <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                            <a class="search_tables_open_close searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
                        </div>
                    </div>

                </div>


                <div class="row" v-if="viewType == 'List View'">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr class="headings">
                                    <td width="20">
                                        <span>
                                            <label class="custmo_checkbox pull-left">
                                                <input type="checkbox" :checked="allChecked" @change="addtoDeleteCollection('all', $event.target)">
                                                <span class="custmo_checkmark blue"></span>
                                            </label>
                                        </span>
                                    </td>
                                    <td><span class="fsize10 fw500">NAME </span></td>
                                    <td><span class="fsize10 fw500">EMAIL / PHONE</span></td>
                                    <td><span class="fsize10 fw500">CAMPAIGN</span></td>
                                    <td><span class="fsize10 fw500">SENT <img src="assets/images/arrow-down-line-14.svg"></span></td>
                                    <td><span class="fsize10 fw500">REVIEW  </span></td>
                                    <td><span class="fsize10 fw500"><img src="assets/images/eyeline.svg"></span></td>
                                    <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>
                                </tr>
                                <tr v-for="request in requests">
                                    <td width="20">
                                        <span>
                                            <label class="custmo_checkbox pull-left">
                                                <input type="checkbox" :checked="deletedItems.indexOf(request.trackinglogid)>-1" @change="addtoDeleteCollection(request.trackinglogid, $event.target)">
                                                <span class="custmo_checkmark blue"></span>
                                            </label>
                                        </span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">{{request.firstname.charAt(0)}}</span></span> {{ capitalizeFirstLetter(request.firstname) }} {{ capitalizeFirstLetter(request.lastname) }}</td>
                                    <td v-if="request.tracksubscribertype =='email'"><img src="assets/images/atline.svg"/>&nbsp; {{ request.email}}</td>
                                    <td v-if="request.tracksubscribertype =='sms'"><img src="assets/images/chatline.svg"/>&nbsp; {{ phoneNoFormat(request.phone)}}</td>
                                    <td>{{ request.brand_title ? setStringLimit(capitalizeFirstLetter(request.brand_title), 23) :  'No Data' }}</td>
                                    <td><span class="">{{ displayDateFormat('M d, Y', request.requestdate) }}</span></td>
                                    <td>
                                        <img v-if="request.ratings>0" width="14" src="assets/images/star-fill_yellow_16.svg">
                                        <img v-else src="assets/images/star-line.svg"/>
                                        <span v-if="request.ratings>0" class="dark_400">&nbsp; {{request.ratings}}</span>
                                        <span v-else class="light_400">-</span>
                                    </td>
                                    <td v-if="request.tracksubscribertype =='email'"></td>
                                    <td v-if="request.tracksubscribertype =='sms'"><!--<img src="assets/images/check_double_green.svg">--><img src="assets/images/checklineblack.svg"></td>
                                    <td>
                                        <span class="float-right">
                                            <span v-if="request.subscriberstatus == 1" class="status_icon bkg_blue_300"></span>
                                            <span v-else class="status_icon bkg_light_800"></span>
                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12 text-center mt-3">
                        <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT review requests</a>
                    </div>
                </div>

                <div class="row" v-if="viewType == 'Grid View'">
                    <div class="col-md-3 d-flex" v-for="request in requests">
                        <div class="card p0 pt30 text-center animate_top col">
                            <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Link 1</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="dripicons-exit text-muted mr-2"></i> Link 2</a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="circle-icon-64 bkg_reviews_000 m0auto">
                                <img v-if="request.subscriberstatus == 1" src="assets/images/review_campaign.png">
                                <img v-else src="assets/images/review_campaign.png">
                            </a>
                            <span v-if="request.brand_title != ''">
                                <h3 class="htxt_bold_16 dark_700 mb-2 mt-4">{{ setStringLimit(capitalizeFirstLetter(request.brand_title), 23) }}</h3>
                            </span>
                            <span v-else>No Data</span>
                            <p>{{ setStringLimit(capitalizeFirstLetter(request.brand_desc), 31) }}</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="request.subscriberstatus == 0" >INACTIVE</p>
                            <p class="fsize10 fw500 green_400 text-uppercase mb20" v-if="request.subscriberstatus == 1" >ACTIVE</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="request.subscriberstatus == 2" >PENDING</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="request.subscriberstatus == 3" >ARCHIVED</p>
                            <div class="p15 pt15 btop">
                                <p class="htxt_regular_12 dark_300 mb15"><em> Sent On: {{ displayDateFormat('M d, Y', request.requestdate) }} </em></p>
                                <p class="htxt_regular_12 dark_300">
                                    <span class="table-img mr15">
                                           <user-avatar
                                               :avatar="''"
                                               :firstname="request.firstname"
                                               :lastname="request.lastname"
                                           ></user-avatar>
                                        </span>
                                    <span class="htxt_medium_14 dark_900">{{ capitalizeFirstLetter(request.firstname) }} {{ capitalizeFirstLetter(request.lastname) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="clearfix"></div>
                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>

            </div>

            <div class="container-fluid" v-else>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 250px; " src="assets/images/Review_request_image.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No review request so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import review request!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Create review request</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 text-center mt-3">
                        <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT review requests</a>
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
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                requests : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                viewType: 'List View',
                sortBy: 'all',
                searchBy: '',
                deletedItems: []
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            },
            'searchBy' : function(){
                this.loadPaginatedData();
            }
        },
        computed:{
            'allChecked' : function () {
                let notFound = '';
                this.requests.forEach(req => {
                    let idx = this.deletedItems.indexOf(req.trackinglogid);
                    if(idx == -1){
                        notFound = true;
                    }
                });
                return notFound === true ? false : true;
            }
        },
        methods: {
            applySort: function(sortVal){
                this.sortBy = sortVal;
                this.deletedItems = [];
            },
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    if(confirm('Are you sure you want to delete selected item(s)?')){
                        this.loading = true;
                        axios.post('/admin/brandboost/deleteReviewRequest', {_token:this.csrf_token(), multipal_id:this.deletedItems})
                            .then(response => {
                                this.loading = false;
                                this.loadPaginatedData();
                            });
                    }
                }
            },
            addtoDeleteCollection: function(itemId, elem){
                if(itemId == 'all'){
                    if(elem.checked){
                        if(this.requests.length>0){
                            this.requests.forEach(req => {
                                let idxx = this.deletedItems.indexOf(req.trackinglogid);
                                if(idxx == -1){
                                    this.deletedItems.push(req.trackinglogid);
                                }
                            });
                        }
                    }else{
                        this.requests.forEach(req => {
                            let idxx = this.deletedItems.indexOf(req.trackinglogid);
                            if(idxx > -1){
                                this.deletedItems.splice(idxx, 1);
                            }
                        });

                    }
                    return;
                }

                if(elem.checked){
                    this.deletedItems.push(itemId);
                }else{
                    let idx = this.deletedItems.indexOf(itemId);
                    if (idx > -1) {
                        this.deletedItems.splice(idx, 1);
                    }
                }
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/review_request/onsite?page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.requests = response.data.oRequest;
                        this.allData = response.data.allData;
                        this.loading = false;
                    });
            },
            searchItem: function(){
                this.loadPaginatedData();
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
