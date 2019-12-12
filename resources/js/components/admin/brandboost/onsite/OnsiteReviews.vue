<template>
    <div class="row" v-if="reviews.length>0">
        <div class="col-md-12">
            <div class="table_head_action mt-2">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="htxt_medium_16 dark_400">{{ allData.total }} &nbsp; Reviews</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="table_action">
                            <div class="float-right">
                                <button type="button" class="dropdown-toggle table_action_dropdown"
                                        data-toggle="dropdown">
                                    <span><img src="assets/images/date_created.svg"></span>&nbsp; Date Created
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item" href="#">Link 3</a>
                                </div>
                            </div>
                            <div class="float-right ml10 mr10">
                                <button type="button" class="dropdown-toggle table_action_dropdown"
                                        data-toggle="dropdown">
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
                                                :width="32"
                                                :height="32"
                                                :fontsize="12"
                                            ></user-avatar>
                                        </span>
                                    <span class="htxt_medium_14 dark_900">{{ capitalizeFirstLetter(review.firstname) }} {{ capitalizeFirstLetter(review.lastname) }}</span>
                                </td>
                                <td><span><img src="/assets/images/mail-line.svg"/></span>&nbsp; Email
                                </td>
                                <td>{{ review.email }}</td>
                                <td>{{ displayDateFormat('M d, h:i A', review.created) }}</td>
                                <td class="text-right">
                                <span class="icons" v-for="num in [1,2,3,4,5]">

                                    <img v-if="num<=review.ratings" src="/assets/images/star-fill_yellow_16.svg">
                                    <img v-else src="/assets/images/star-line.svg">
                                </span>
                                    <span class="dark_400 fsize14">{{review.ratings}}/5</span>
                                </td>
                                <td>
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_dots_dd"
                                                data-toggle="dropdown"
                                                aria-expanded="false">
                                            <span><img src="assets/images/more-vertical.svg"></span>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                             style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a v-if="review.subscriberstatus == 'active'" class="dropdown-item"
                                               href="javascript:void(0);"
                                               @click="changeStatus(review.subscriberid, '0')"><i
                                                class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                            <a v-else class="dropdown-item" href="javascript:void(0);"
                                               @click="changeStatus(review.subscriberid, '1')"><i
                                                class="dripicons-user text-muted mr-2"></i> Active</a>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                               @click="deleteItem(review.subscriberid,review.trackinglogid)"><i
                                                class="dripicons-exit text-muted mr-2"></i> Delete</a>
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
                @paginate="navigatePagination"
                :offset="4">
            </pagination>
        </div>
    </div>
    <div class="row" v-else >
        <div class="col-md-12">
            <div class="card card_shadow min-h-280">

                <div class="row mb65">
                    <div class="col-md-6 text-left">
                        <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                            <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                            Set up reviews monitoring
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
                        <img class="mt40" style="max-width: 240px; " src="assets/images/review_feed_illustration.svg">
                        <h3 class="htxt_bold_18 dark_700 mt30">No reviews so far. Connect reviews site!</h3>
                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">Reviews from 50+ review sites, at your fingertips...</h3>
                        <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Monitor reviews site</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import Pagination from '../../../helpers/Pagination';
    import ContactTags from "../../contact/ContactTags";

    export default {
        props: ['campaignId'],
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaign: {},
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                current_page: '1',
                reviews: '',
                allData: ''

            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData: function () {
                axios.get('/admin/brandboost/onsiteSetupReview/' + this.campaignId + '?page=' + this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.brandboostData;
                        this.reviews = response.data.reviews;
                        this.allData = response.data.allData;
                        this.user = response.data.aUserInfo;
                        this.loading = false;
                    });
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }

    };

</script>
