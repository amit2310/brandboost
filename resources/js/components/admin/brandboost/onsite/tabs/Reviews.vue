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
                    <div class="float-right">
                        <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                            <span><img src="assets/images/sort_16_grey.svg"></span>&nbsp;
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Name'}" @click="sortBy='Name'">Name</a>
                            <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">Active</a>
                            <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">Inactive</a>
                            <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Pending'}" @click="sortBy='Pending'">Pending</a>
                            <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">Archive</a>
                            <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Date Created'}" @click="sortBy='Date Created'">Date Created</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="oReviews.length > 0" class="row">
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

                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4"
                        class="mt-4">
                    </pagination>

                </div>
            </div>


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
