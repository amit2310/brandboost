<template>

    <div>

        <div class="table_head_action pb0 mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="htxt_medium_14 dark_600">Reviews</h3>
                </div>
                <div class="col-md-6">
                    <!--<ul class="table_filter text-right">
                        <li><a href="javascript:void(0);"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                    </ul>-->
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <ul class="table_filter">
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Name'}" @click="sortBy='Name'">ALL</a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">ACTIVE</a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Pending'}" @click="sortBy='Pending'">PENDING</a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Positive'}" @click="sortBy='Positive'">POSITIVE</a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Negative'}" @click="sortBy='Negative'">NEGATIVE</a></li>
                        <li><a href="#"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="table_filter text-right">
                        <li><input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem"></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div v-if="oReviews.length > 0">

            <div class="row" v-if="viewType == 'Grid View'">
                <div class="col-md-3 d-flex" v-for="oReview in oReviews">
                    <div class="card p0 pt30 text-center animate_top col">
                        <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <!--<a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(oReview.reviewid)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>-->
                                <a v-if="oReview.rstatus == '0' || oReview.rstatus == '2'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                <a v-if="oReview.rstatus == '1'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                <a v-if="oReview.rstatus != '3'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.reviewid, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                <a class="dropdown-item" href="javascript:void(0);" @click="showReview(oReview.reviewid)"><i class="dripicons-user text-muted mr-2"></i> View Review</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(oReview.reviewid)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="circle-icon-64 bkg_reviews_000 m0auto">
                            <img v-if="oReview.rstatus == 1" src="assets/images/review_campaign.png">
                            <img v-else src="assets/images/review_campaign.png">
                        </a>
                        <h3 class="htxt_bold_16 dark_700 mb-2 mt-4" @click="showReview(oReview.reviewid)" style="cursor: pointer;">
                            {{ setStringLimit(capitalizeFirstLetter(oReview.review_title), 23) }}
                        </h3>
                        <p>{{ setStringLimit(capitalizeFirstLetter(oReview.comment_text), 31) }}</p>
                        <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="oReview.rstatus == 0" >INACTIVE</p>
                        <p class="fsize10 fw500 green_400 text-uppercase mb20" v-if="oReview.rstatus == 1" >ACTIVE</p>
                        <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="oReview.rstatus == 2" >PENDING</p>
                        <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="oReview.rstatus == 3" >ARCHIVED</p>
                        <div class="p15 pt15 btop">
                            <p class="htxt_regular_12 dark_300 mb15"><em> Created On: {{ displayDateFormat('M d, h:i A', oReview.review_created) }} </em></p>
                            <p class="htxt_regular_12 dark_300">
                                <user-avatar
                                    :avatar="oReview.avatar"
                                    :firstname="oReview.firstname"
                                    :lastname="oReview.lastname"
                                ></user-avatar>
                                <span>{{ oReview.firstname }} {{ oReview.lastname }}</span>
                                <span v-if="oReview.email != ''"><br />{{ oReview.email }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

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
                            <td><span class="fsize10 fw500">CONTACT </span></td>
                            <td><span class="fsize10 fw500">RATING</span></td>
                            <td><span class="fsize10 fw500">REVIEW</span></td>
                            <td><span class="fsize10 fw500"><img src="assets/images/circle_grey_right_arrow.svg"></span></td>
                            <td><span class="fsize10 fw500">SUBMITTED <img src="assets/images/arrow-down-line-14.svg"></span></td>
                            <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>
                        </tr>
                        <tr v-for="oReview in oReviews">
                            <td width="20">
                                    <span>
                                        <label class="custmo_checkbox pull-left">
                                            <input type="checkbox">
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </span>
                            </td>
                            <td class="fw500 dark_600">
                                <span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">{{ oReview.firstname.charAt(0) }}</span></span>
                                <!--<user-avatar
                                    :avatar="oReview.avatar"
                                    :firstname="oReview.firstname"
                                    :lastname="oReview.lastname"
                                ></user-avatar>-->
                                <span>{{ oReview.firstname }} {{ oReview.lastname }}</span>
                            </td>
                            <td>
                                    <span v-for="num in [1,2,3,4,5]">
                                        <!--<i v-if="num<=oReview.ratings" class=""><img width="14" src="/assets/images/star-fill_yellow_18.svg"></i>
                                        <i v-else class=""><img width="14" src="/assets/images/star-fill_grey_18.svg"></i>-->
                                        <i v-if="num<=oReview.ratings && oReview.ratings > 3" class="ri-star-s-fill fsize18 green_400"></i>
                                        <i v-else-if="num<=oReview.ratings && oReview.ratings == 3" class="ri-star-s-fill fsize18 yellow_400"></i>
                                        <i v-else class="ri-star-s-fill fsize18 light_600"></i>
                                    </span>
                                <span>{{ oReview.ratings }}.0</span>
                            </td>
                            <td>
                                <span href="javascript:void(0);" @click="showReview(oReview.reviewid)" style="cursor: pointer;"><strong>{{ setStringLimit(capitalizeFirstLetter(oReview.review_title), 30) }}</strong></span>
                                <br />
                                <span>{{ setStringLimit(oReview.comment_text, 50) }}</span>
                            </td>
                            <td><i class="ri-at-line email_400 fsize15"></i></td>
                            <td>{{ displayDateFormat('M d, Y h:i A', oReview.review_created) }}<!--3 month ago--></td>
                            <td>
                                    <span class="float-right">
                                        <span v-if="oReview.rstatus == 0" class="status_icon bkg_light_600" title="INACTIVE"></span>
                                        <span v-if="oReview.rstatus == 1" class="status_icon bkg_green_400" title="ACTIVE"></span>
                                        <span v-if="oReview.rstatus == 2" class="status_icon bkg_reviews_300" title="PENDING"></span>
                                        <span v-if="oReview.rstatus == 3" class="status_icon bkg_reviews_300" title="ARCHIVED"></span>
                                    </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

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
                            <td><span class="fsize10 fw500">CONTACT </span></td>
                            <td><span class="fsize10 fw500">RATING</span></td>
                            <td><span class="fsize10 fw500">REVIEW</span></td>
                            <td><span class="fsize10 fw500"><img src="assets/images/circle_grey_right_arrow.svg"></span></td>
                            <td><span class="fsize10 fw500">SUBMITTED <img src="assets/images/arrow-down-line-14.svg"></span></td>
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
                allData: {},
                oReviews : '',
                oCampaign: '',
                reviewTags: '',
                campaignId: '',
                current_page: 1,
                breadcrumb: '',
                seletedTab: 1,
                viewType: 'List View',
                sortBy: 'Date Created',
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
            showReview: function(id){
                window.location.href='#/reviews/onsite/reviews/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/reviews?page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.oCampaign = response.data.oCampaign;
                        this.allData = response.data.allData;
                        this.oReviews = response.data.aReviews;
                        this.reviewTags = response.data.reviewTags;
                        this.reviewTags = response.data.reviewTags;
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
