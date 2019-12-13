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
                        <h3 class="htxt_medium_24 dark_700">Campaign Reviews</h3>
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
            <div class="container-fluid" v-if="reviews.length <= 0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/download-fill-review.svg"></span>
                                        Import campaign reviews
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
                                    <h3 class="htxt_bold_18 dark_700 mt30">No campaign review so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import campaign review!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Create campaign review</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid" v-else>

                <div class="table_head_action mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ reviews.length }} &nbsp; Campaign Reviews</h3>
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
                                <tr v-for="review in reviews">
                                    <td>
                                        <span class="table-img mr15">
                                           <!-- <span class="fl_name bkg_red_light red_300">vw</span>-->
                                            <user-avatar
                                                :avatar="review.avatar"
                                                :firstname="review.firstname"
                                                :lastname="review.lastname"
                                            ></user-avatar>
                                        </span>
                                        <span class="htxt_medium_14 dark_900">{{ capitalizeFirstLetter(review.firstname) }} {{ capitalizeFirstLetter(review.lastname) }}</span>
                                    </td>
                                    <td><span><img src="assets/images/mail-line.svg"/></span>&nbsp; {{ capitalizeFirstLetter(review.tracksubscribertype) }} </td>
                                    <td>{{ review.email }}</td>
                                    <td>{{ displayDateFormat('M d, h:i A', review.created) }}</td>
                                    <td class="text-right">
                                        <span v-for="rating in review.ratings" class="icons">
                                            <img src="assets/images/star-fill_yellow_16.svg">
                                        </span>
                                        <span v-for="rating in (5 - review.ratings)" class="icons">
                                            <img src="assets/images/star-line.svg">
                                        </span>
                                        <span class="dark_400 fsize14">{{ review.ratings }}/5</span>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
                                                <span><img src="assets/images/more-vertical.svg"></span>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a v-if="review.subscriberstatus == 'active'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(review.subscriberid, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                                <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(review.subscriberid, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(review.subscriberid,review.trackinglogid)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
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
    import UserAvatar from '../../../helpers/UserAvatar';
    import Pagination from '../../../helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                reviews : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                campaigns: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
            //console.log("Component mounted "+this.$route.params.id)
        },
        methods: {
            loadPaginatedData: function () {
                axios.get('/admin/brandboost/reviews/' + this.$route.params.id+'/?page='+this.current_page)
                    .then(response => {
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaigns = response.data.oCampaign;
                        this.allData = response.data.allData;
                        this.reviews = response.data.aReviews;
                        console.log(this.reviews);
                    });
            },
            showPaginationData: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    }
</script>
