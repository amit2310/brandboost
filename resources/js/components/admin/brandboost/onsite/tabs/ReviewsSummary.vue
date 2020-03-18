<template>

    <div>
        <a class="close_sidebar" href="javascript:void(0);">OPEN MENU &nbsp; <img src="assets/images/menu-2-line.svg"></a>
        <div class="page_sidebar bkg_light_000 fixed">
            <div style="width: 279px;">
                <div class="p20 bbot top_headings">
                    <div class="row">
                        <div class="col"><p>REVIEWS</p></div>
                        <!--<div class="col text-right"><p><a class="close_sidebar" href="#">OPEN MENU &nbsp; <img src="assets/images/menu-2-line.svg"></a></p></div>-->
                    </div>
                </div>

                <div class="p20 pt30 pb10">
                    <div class="row">
                        <div class="col"><h3 class="htxt_medium_24 dark_800">Reviews</h3></div>
                        <div class="col text-right"><button class="circle-icon-32 shadow3 " @click="displayAddReviewForm"><img src="assets/images/add-fill-review.svg"></button></div>
                    </div>
                </div>

                <div v-if="oReviews.length > 0 || searchBy.length>0">
                    <div class="p20 top_headings">
                    <div class="row">
                        <div class="col-md-5">
                            <!--<p>
                                <a href="#"><img src="assets/images/filter-line.svg"> &nbsp; Filter</a>
                            </p>-->
                            <a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i> &nbsp;Filter</a>
                            <div class="dropdown-menu p10 mt-1">
                                <a href="javascript:void(0);" :class="{'active': sortBy == 'Name'}" @click="sortBy='Date Created'">ALL</a><br />
                                <a href="javascript:void(0);" :class="{'active': sortBy == 'Active'}" @click="sortBy='Active'">POSTED</a><br />
                                <a href="javascript:void(0);" :class="{'active': sortBy == 'Pending'}" @click="sortBy='Pending'">DRAFT</a><br />
                                <a href="javascript:void(0);" :class="{'active': sortBy == 'Positive'}" @click="sortBy='Positive'">POSITIVE</a><br />
                                <a href="javascript:void(0);" :class="{'active': sortBy == 'Negative'}" @click="sortBy='Negative'">NEGATIVE</a><br />
                            </div>
                        </div>
                        <div class="col-md-7 text-right">
                            <!--<a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a>-->
                            <input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">
                            <a href="javascript:void(0);" title="List View"><i><img src="assets/images/sort_16_grey.svg"></i></a>
                        </div>
                    </div>
                </div>
                    <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons3">
                        <li v-for="oReview in oReviews" :key="oReview.reviewid" class="d-flex" :class="{ active : active_el == oReview.reviewid }">
                            <span @click="showReview(oReview.reviewid)" style="cursor: pointer;">

                                <span v-if="oReview.ratings > 3" class="circle_icon_24 bkg_green_200">{{ oReview.firstname.charAt(0) }}</span>
                                <span v-else-if="oReview.ratings == 3" class="circle_icon_24 bkg_yellow_200">{{ oReview.firstname.charAt(0) }}</span>
                                <span v-else class="circle_icon_24 bkg_reviews_400">{{ oReview.firstname.charAt(0) }}</span>

                                <span>{{ capitalizeFirstLetter(oReview.firstname) }} {{ capitalizeFirstLetter(oReview.lastname) }}</span>

                            </span>
                            <strong>
                                <span v-if="oReview.ratings != ''">{{ number_format(oReview.ratings, 1) }}&nbsp;</span>
                                <span v-else>&nbsp;</span>
                                <i v-if="(oReview.ratings != '' && oReview.ratings > '3')" class="ri-star-fill green_400"></i>
                                <i v-else-if="(oReview.ratings != '' && oReview.ratings == '3')" class="ri-star-fill yellow_400"></i>
                                <i v-else-if="(oReview.ratings != '' && oReview.ratings < '3')" class="ri-star-fill red_400"></i>
                                <i v-else class=""></i>
                            </strong>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4"
                        :noItemPerPage="true"
                        class="mt-4">
                    </pagination>
                </div>
                </div>

                <div v-else>
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" src="assets/images/review_Illustration.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any reviews</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import review!</h3>
                                    <!--<button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 js-review-campaign-slidebox">Create review</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT REVIEW</a>
                    </div>
                </div>

                <div class="clearfix"></div>
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
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                company_name: '',
                count : 0,
                allData: {},
                oReviews : '',
                oCampaign: '',
                reviewTags: '',
                campaignId: '',
                current_page: 1,
                breadcrumb: '',
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: '',
                active_el: false
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
            displayAddReviewForm: function(){
                window.location.href='#/reviews/onsite/add';
            },
            searchItem: function(){
                this.loadPaginatedData();
            },
            showReview: function(id){
                window.location.href='#/reviews/onsite/reviews/'+id;
                this.active_el = id;
            },
            showQuestions: function(id){
                window.location.href='#/brandboost/questions/'+id;
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
                        this.loading = false;
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
            }
        }
    }

    $(document).ready(function () {

    });
</script>
