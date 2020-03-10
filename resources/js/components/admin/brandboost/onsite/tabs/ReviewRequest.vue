<template>

    <div>
        <div class="table_head_action pb0 mt-3">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="htxt_medium_14 dark_600">Review Requests</h3>
                </div>
                <div class="col-md-6">
                    <!--<ul class="table_filter text-right">
                        <li><a href="javascript:void(0);"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                    </ul>-->
                    <ul class="table_filter text-right">
                        <li>
                            <!--<a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a>-->
                            <input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">
                        </li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                        <li><a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i></a>
                            <div class="dropdown-menu p10 mt-1">
                                <a href="javascript:void(0);" :class="{'active': viewType == 'all'}" @click="sortBy='all'">ALL</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'sent'}" @click="sortBy='sent'">SENT</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'draft'}" @click="sortBy='draft'">DRAFT</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'submitted'}" @click="sortBy='submitted'">SUBMITED</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'archive'}" @click="sortBy='archive'">ARCHIVE</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div v-if="requests.length > 0">
            <div class="row" v-if="viewType == 'List View'">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                        <tr class="headings">
                            <td width="20">
                                <span>
                                    <label class="custmo_checkbox pull-left">
                                        <input type="checkbox">
                                        <span class="custmo_checkmark blue"></span>
                                    </label>
                                </span>
                            </td>
                            <td><span class="fsize10 fw500">name </span></td>
                            <td><span class="fsize10 fw500">EMAIL / phone</span></td>
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
                                        <input type="checkbox">
                                        <span class="custmo_checkmark blue"></span>
                                    </label>
                                </span>
                            </td>
                            <td>
                                <span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">{{ request.firstname.charAt(0) }}</span></span>
                                <!--<user-avatar
                                    :avatar="request.avatar"
                                    :firstname="request.firstname"
                                    :lastname="request.lastname"
                                ></user-avatar>-->
                                <span>{{ request.firstname }} {{ request.lastname }}</span>
                            </td>
                            <td>
                                <!--<span v-if="request.tracksubscribertype =='sms' && (request.phone != '' && request.phone != null)"><img src="assets/images/chatline.svg"> {{ phoneNoFormat(request.phone) }}</span>-->
                                <span v-if="(request.phone != '' && request.phone != null)"><img src="assets/images/chatline.svg"> &nbsp;{{ phoneNoFormat(request.phone) }}</span>
                                <span v-else><img src="assets/images/atline.svg"> {{ request.email }}</span>
                            </td>
                            <td>{{ request.brand_title ? setStringLimit(capitalizeFirstLetter(request.brand_title), 23) :  'No Data' }}</td>
                            <td><span class="">{{ displayDateFormat('M d, Y', request.requestdate) }}</span></td>
                            <td>
                                <img v-if="request.ratings>0" width="14" src="assets/images/star-fill_yellow_16.svg">
                                <img v-else src="assets/images/star-line.svg"/>
                                <span v-if="request.ratings>0" class="dark_400">&nbsp; {{ request.ratings }}</span>
                                <span v-else class="light_400">-</span>
                            </td>
                            <td>
                                <span v-if="request.tracksubscribertype =='email'"></span>
                                <span v-if="request.tracksubscribertype =='sms'"><!--<img src="assets/images/check_double_green.svg">--><img src="assets/images/checklineblack.svg"></span>
                            </td>
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
                :offset="4"
                class="mt-4">
            </pagination>
        </div>
        <div v-else class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                        <tr class="headings">
                            <td width="20">
                                        <span>
                                            <label class="custmo_checkbox pull-left">
                                                <input type="checkbox">
                                                <span class="custmo_checkmark blue"></span>
                                            </label>
                                        </span>
                            </td>
                            <td><span class="fsize10 fw500">NAME </span></td>
                            <td><span class="fsize10 fw500">EMAIL / phone</span></td>
                            <td><span class="fsize10 fw500">CAMPAIGN</span></td>
                            <td><span class="fsize10 fw500">SENT <img src="assets/images/arrow-down-line-14.svg"></span></td>
                            <td><span class="fsize10 fw500">REVIEW  </span></td>
                            <td><span class="fsize10 fw500"><img src="assets/images/eyeline.svg"></span></td>
                            <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>
                        </tr>

                        <tr>
                            <td colspan="8" align="center"><span style="font-weight: bold; color: #FF0000;">No Record Found.</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

</template>

<script>

    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Onsite Reviews - Brand Boost',
        name: "OnsiteReviewsTab",
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                requests : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                viewType: 'List View',
                sortBy: 'all',
                searchBy: ''
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
            }
        },
        methods: {
            searchItem: function(){
                this.loadPaginatedData();
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/review_request/onsite?page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.requests = response.data.oRequest;
                        this.allData = response.data.allData;
                    });
            },
            showPaginationData: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    }

</script>
