<template>

    <div v-show="pageRendered==true">

        <div class="table_head_action pb0 mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="htxt_medium_14 dark_600">Reviews</h3>
                </div>
                <div class="col-md-6">
                    <ul class="table_filter text-right">
                        <li>
                            <a class="search_tables_open_close_R" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a>
                            <!--<input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">-->
                        </li>
                        <li v-show="deletedItems.length>0 && sortBy !='archive'"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                        <li v-if="viewType == 'Grid View'"><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                        <li v-if="viewType == 'List View'"><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                        <li><a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i></a>
                            <div class="dropdown-menu p10 mt-1">
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Name'}" @click="sortBy='Name'">ALL</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">ACTIVE</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Pending'}" @click="sortBy='Pending'">PENDING</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Positive'}" @click="sortBy='Positive'">POSITIVE</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Negative'}" @click="sortBy='Negative'">NEGATIVE</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card p20 datasearcharea_R reviewRequestSearch br6 shadow3">
                <div class="form-group m-0 position-relative">
                    <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                    <a class="search_tables_open_close_R searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
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
                                        <input type="checkbox" :checked="allChecked" @change="addtoDeleteCollection('all', $event.target)">
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
                                        <input type="checkbox" :checked="deletedItems.indexOf(oReview.reviewid)>-1" @change="addtoDeleteCollection(oReview.reviewid, $event.target)">
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
                                <!--<span href="javascript:void(0);" @click="showReview(oReview.reviewid)" style="cursor: pointer;"><strong>{{ setStringLimit(capitalizeFirstLetter(oReview.review_title), 30) }}</strong></span>
                                <br />-->
                                <span href="javascript:void(0);" @click="showReview(oReview.reviewid)" style="cursor: pointer;">{{ setStringLimit(oReview.comment_text, 50) }}</span>
                            </td>
                            <td><i class="ri-at-line email_400 fsize15"></i></td>
                            <!--<td>{{ displayDateFormat('M d, Y h:i A', oReview.review_created) }}</td>-->
                            <td>{{ timeAgo(oReview.created) }}</td>
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

                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        @paginate_per_page="showPaginationItemsPerPage"
                        :offset="4"
                        class="mt-4">
                    </pagination>
                </div>
            </div>

            <div v-if="viewType == 'Grid View'" class="clearfix"></div>
            <pagination  v-if="viewType == 'Grid View'"
                :pagination="allData"
                @paginate="showPaginationData"
                @paginate_per_page="showPaginationItemsPerPage"
                :offset="4"
                class="mt-4">
            </pagination>

        </div>

        <div v-else class="row">
            <div class="col-md-12">
                <div class="card card_shadow min_h_280">

                    <!--<div class="row mb65">
                        <div class="col-md-6 text-left">
                            <a class="lh_32 reviews_400 htxt_bold_14 d-none" href="#">
                                <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                                Set up reviews monitoring
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="lh_32 htxt_regular_12 dark_200 " href="#">
                                Learn how use use contacts &nbsp; <img src="assets/images/question-line.svg">
                            </a>
                        </div>
                    </div>-->

                    <div class="row mb65">
                        <div class="col-md-12 text-center">
                            <img class="mt40" style="max-width: 240px; " src="assets/images/reviews_icon_125.svg">
                            <h3 class="htxt_bold_18 dark_700 mt30">No reviews so far. Connect reviews site!</h3>
                            <h3 class="htxt_regular_14 dark_200 mt15 mb25">Reviews from 50+ review sites, at your fingertips...</h3>
                            <!--<button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Connect</button>-->
                            <button class="btn btn-md bkg_reviews_400 light_000" @click="displayAddReviewForm">Add Review <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-center mt-3">
                <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT reviews</a>
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
                pageRendered: false,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                allData: {},
                oReviews : '',
                oCampaign: '',
                reviewTags: '',
                campaignId: '',
                current_page: 1,
                items_per_page: 10,
                breadcrumb: '',
                seletedTab: 1,
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: '',
                deletedItems: []
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.campaignId = this.$route.params.id;
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
        computed:{
            'allChecked' : function () {
                let notFound = '';
                this.oReviews.forEach(rev => {
                    let idx = this.deletedItems.indexOf(rev.reviewid);
                    if(idx == -1){
                        notFound = true;
                    }
                });
                return notFound === true ? false : true;
            }
        },
        methods: {
            searchItem: function(){
                this.loadPaginatedData();
            },
            showReview: function(id){
                window.location.href='#/reviews/onsite/reviews/'+id;
            },
            displayAddReviewForm: function(){
                window.location.href='#/reviews/onsite/add';
            },
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    if(confirm('Are you sure you want to delete selected item(s)?')){
                        this.loading = true;
                        axios.post('/admin/reviews/deleteMultipalReview', {_token:this.csrf_token(), multiReviewid:this.deletedItems})
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
                        if(this.oReviews.length>0){
                            this.oReviews.forEach(rev => {
                                let idxx = this.deletedItems.indexOf(rev.reviewid);
                                if(idxx == -1){
                                    this.deletedItems.push(rev.reviewid);
                                }
                            });
                        }
                    }else{
                        this.oReviews.forEach(rev => {
                            let idxx = this.deletedItems.indexOf(rev.reviewid);
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
                axios.get('/admin/brandboost/reviews?id='+this.$route.params.id+'&items_per_page='+this.items_per_page+'&page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.oCampaign = response.data.oCampaign;
                        this.allData = response.data.allData;
                        this.oReviews = response.data.aReviews;
                        this.reviewTags = response.data.reviewTags;
                        this.reviewTags = response.data.reviewTags;
                        this.pageRendered = true;
                        //console.log(this.oReviews);
                    });
            },
            showPaginationData: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            showPaginationItemsPerPage: function(p){
                this.loading=true;
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    }

    $(document).ready(function(){
        $(document).on("click", ".search_tables_open_close_R", function(){
            $(".datasearcharea_R").animate({
                width: "toggle"
            });
            $('#InputToFocus').focus();
        });
    });

</script>
<style>
    .datasearcharea_R{position:relative;width: 100%;z-index: 1;top: 13px; display: none}
    .datasearcharea_R a.searchcloseicon{ position: absolute; right: 25px;top: 14px;}

    .datasearcharea_R .form-control:focus{box-shadow: none!important}
</style>
