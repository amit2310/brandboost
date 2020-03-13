<template>

    <div>

        <div class="card p25 pt20 pb10">
            <div class="row">
                <div class="col">
                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">LAST REVIEWS</p>
                </div>
                <div class="col">
                    <div class="float-right">
                        <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical.svg"></span> </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(647px, 102px, 0px);"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr class="mb-0">
                </div>
            </div>


            <div class="row" v-if="oReviews.length > 0">
                <div class="col">
                    <table class="table table-borderless mb-0">
                        <tbody>
                        <tr v-for="oReview in oReviews.slice(0, 5)">
                            <td>
                                <span class="table-img mr15">
                                    <span v-if="oReview.ratings > 3" class="circle_icon_24 bkg_green_200 lh_26">{{ oReview.firstname.charAt(0) }}</span>
                                    <span v-else-if="oReview.ratings == 3" class="circle_icon_24 bkg_yellow_200 lh_26">{{ oReview.firstname.charAt(0) }}</span>
                                    <span v-else class="circle_icon_24 bkg_blue_200 lh_26">{{ oReview.firstname.charAt(0) }}</span>
                                </span>
                                <span>{{ capitalizeFirstLetter(oReview.firstname) }} {{ capitalizeFirstLetter(oReview.lastname) }}</span>
                            </td>
                            <td>
                                <span v-for="num in [1,2,3,4,5]">
                                    <i v-if="num<=oReview.ratings && oReview.ratings > 3" class="ri-star-s-fill fsize18 green_400"></i>
                                    <i v-else-if="num<=oReview.ratings && oReview.ratings == 3" class="ri-star-s-fill fsize18 yellow_400"></i>
                                    <i v-else class="ri-star-s-fill fsize18 light_600"></i>
                                </span>
                            </td>
                            <td><span class="dark_400">{{ number_format(oReview.ratings, 1) }}</span></td>
                            <td class="text-right"><i class="ri-at-line email_400 fsize15"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-else class="row">

                <div class="col-md-12">
                    <div class="card card_shadow min-h-280">
                        <div class="row mb65">
                            <div class="col-md-12 text-center">
                                <img class="mt40" style="max-width: 240px; " src="assets/images/reviews_icon_125.svg">
                                <h3 class="htxt_bold_18 dark_700 mt30">No reviews so far. Connect reviews site!</h3>
                                <h3 class="htxt_regular_14 dark_200 mt15 mb25">Reviews from 50+ review sites, at your fingertips...</h3>
                                <!--<button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Connect</button>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-3">
                    <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT reviews</a>
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
