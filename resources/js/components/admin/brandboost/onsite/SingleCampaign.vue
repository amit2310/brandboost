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
                        <h3 class="htxt_medium_24 dark_700">{{ oCampaign.brand_title }}</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/settings-2-line-reviews.svg"></button>
                        <!--<button class="btn btn-md bkg_reviews_400 light_000" data-toggle="modal" data-target="#CREATEFORM">CREATE CAMPAIGN <span><img src="assets/images/reviews_plus_icon.svg"></span></button>-->
                        <button class="btn btn-md bkg_reviews_400 light_000 mr15" @click="setupBroadcast(selected_campaign)"> Edit Campaign <span><img src="/assets/images/reviews_plus_icon.svg"/></span></button>
                        <button class="btn btn-md bkg_reviews_400 light_000" v-if="selected_campaign>0" data-toggle="modal" data-target="#CREATE_REQUEST_FORM">Send new request <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
                        <button id="hideOverviewPreviewForm" style="display:none;"></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
        Content Area
        **********************-->
        <div class="content-area">
            <div class="container-fluid">

                <!--******************
                 PAGE LEFT SIDEBAR
                **********************-->`
                <!--<div class="page_sidebar bkg_light_000 fixed">
                    <div style="width: 279px;">
                        <div class="p20 bbot top_headings">
                            <div class="row">
                                <div class="col"><p>ReviewS</p></div>
                                <div class="col text-right"><p><a class="close_sidebar" href="#">OPEN MENU &nbsp; <img src="assets/images/menu-2-line.svg"></a></p></div>
                            </div>
                        </div>

                        <div class="p20 pt30 pb10">
                            <div class="row">
                                <div class="col"><h3 class="htxt_medium_24 dark_800">Campaigns</h3></div>
                                <div class="col text-right"><button class="circle-icon-32 shadow3"><img src="assets/images/add-fill-review.svg"></button></div>
                            </div>
                        </div>

                        <div class="p20 top_headings">
                            <div class="row">
                                <div class="col"><p><a href="#"><img src="assets/images/filter-line.svg"> &nbsp; Filter</a></p></div>
                                <div class="col text-right"><p><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a> &nbsp; <a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></p></div>
                            </div>
                        </div>
                        <div class="p20 pt0 pb0 bkg_light_050">
                            <ul class="list_with_icons3">
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>IBM</span>
                                    <strong>4.5 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_green_200"><img src="assets/images/start-fill-white.svg"></span>General Electric</span>
                                    <strong>4.8 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_review_200"><img src="assets/images/start-fill-white.svg"></span>Louis Vuitton</span>
                                    <strong>3.2 <i class="ri-star-fill yellow_400"></i></strong>
                                </li>
                                <li class="d-flex active">
                                    <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>Apple</span>
                                    <strong>4.3 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_red_200"><img src="assets/images/start-fill-white.svg"></span>IBM</span>
                                    <strong>2.7 <i class="ri-star-fill red_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>General Electric</span>
                                    <strong>4.8 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_yellow_200"><img src="assets/images/start-fill-white.svg"></span>Louis Vuitton</span>
                                    <strong>4.5 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>-->

                <OnsiteCampaignsTab @chooseCampaign="selectCampaign"></OnsiteCampaignsTab>

                <!--******************
                  PAGE LEFT SIDEBAR END
                 **********************-->

                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="table_filter">
                                <li><a :class="{ active : seletedTab === 1 }" v-on:click="seletedTab=1" data-toggle="tab" style="cursor:pointer; padding: 5px;">Overview&nbsp;</a></li>&nbsp;&nbsp;
                                <li><a :class="{ active : seletedTab === 2 }" v-on:click="seletedTab=2" data-toggle="tab" style="cursor:pointer; padding: 5px;">Requests&nbsp;</a></li>&nbsp;&nbsp;
                                <li><a :class="{ active : seletedTab === 3 }" v-on:click="seletedTab=3" data-toggle="tab" style="cursor:pointer; padding: 5px;">Reviews </a></li>&nbsp;&nbsp;
                                <li><a :class="{ active : seletedTab === 4 }" v-on:click="seletedTab=4" data-toggle="tab" style="cursor:pointer; padding: 5px;">Contacts&nbsp;</a></li>&nbsp;&nbsp;
                                <li><a :class="{ active : seletedTab === 5 }" v-on:click="seletedTab=5" data-toggle="tab" style="cursor:pointer; padding: 5px;">Stats&nbsp;</a></li>&nbsp;&nbsp;
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <!--<ul class="table_filter text-right">
                                <li><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li><a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="#"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                            </ul>-->
                        </div>
                    </div>
                </div>

                <div v-if="(seletedTab === 1 || seletedTab === 5)" class="row">
                    <div class="col-md-4 d-flex">


                        <div class="card p25 pt20 animate_top col">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REVIEW REQUESTS</p>
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
                                    <hr>
                                </div>
                            </div>
                            <div class="p0 pt20 pb0">
                                <div class="row">
                                    <div class="col-md-7 pr-0">
                                        <h3 class="htxt_regular_28 dark_700 mt-0 mb-1">284</h3>
                                        <p class="m-0 fsize14"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"></i>15%</span>last week</p>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="float-right"><img height="96" src="assets/images/review_request_chart1.svg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card p25 pt20 animate_top col">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REQUEST CLICK RATE</p>
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
                                    <hr>
                                </div>
                            </div>
                            <div class="p0 pt20 pb0">
                                <div class="row">
                                    <div class="col-md-7 pr-0">
                                        <h3 class="htxt_regular_28 dark_700 mt-0 mb-1">46%</h3>
                                        <p class="m-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>/ last week</p>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="float-right"><img height="96" src="assets/images/review_chart_02.svg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card p25 pt20 animate_top col">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REVIEWS SUMMARY</p>
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
                                    <hr>
                                </div>
                            </div>
                            <div class="p0 pt0 pb0">
                                <div class="row">
                                    <div class="col-md-5 pr-0">
                                        <div class="mt20"><img height="96" src="assets/images/review_chart_03.svg"></div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="list2">
                                            <li><span><i class="ri-star-s-fill fsize18 green_400"></i> 4-5</span>  <strong>129</strong></li>
                                            <li><span><i class="ri-star-s-fill fsize18 yellow_400"></i> 3</span>  <strong>74</strong></li>
                                            <li><span><i class="ri-star-s-fill fsize18 red_400"></i> 1-2</span>  <strong>13</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <OnsiteReviewRequestsTab v-if="(seletedTab === '' || seletedTab === 1 || seletedTab === 2)" :key="componentKey"></OnsiteReviewRequestsTab>

                <OnsiteReviewsTab v-if="(seletedTab === '' || seletedTab === 1 || seletedTab === 3)" :key="componentKey"></OnsiteReviewsTab>

                <OnsiteSubscribersTab v-if="seletedTab === 4" :key="componentKey"></OnsiteSubscribersTab>

                <!--<div v-if="(seletedTab == 4)">
                    <div class="row">
                        <div class="col-md-4 d-flex">


                            <div class="card p25 pt20 animate_top col">
                                <div class="row">
                                    <div class="col-9">
                                        <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REVIEW REQUESTS</p>
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
                                        <hr>
                                    </div>
                                </div>
                                <div class="p0 pt20 pb0">
                                    <div class="row">
                                        <div class="col-md-7 pr-0">
                                            <h3 class="htxt_regular_28 dark_700 mt-0 mb-1">284</h3>
                                            <p class="m-0 fsize14"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"></i>15%</span>last week</p>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="float-right"><img height="96" src="assets/images/review_request_chart1.svg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="col-md-4 d-flex">
                            <div class="card p25 pt20 animate_top col">
                                <div class="row">
                                    <div class="col-9">
                                        <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REQUEST CLICK RATE</p>
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
                                        <hr>
                                    </div>
                                </div>
                                <div class="p0 pt20 pb0">
                                    <div class="row">
                                        <div class="col-md-7 pr-0">
                                            <h3 class="htxt_regular_28 dark_700 mt-0 mb-1">46%</h3>
                                            <p class="m-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>/ last week</p>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="float-right"><img height="96" src="assets/images/review_chart_02.svg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex">
                            <div class="card p25 pt20 animate_top col">
                                <div class="row">
                                    <div class="col-9">
                                        <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REVIEWS SUMMARY</p>
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
                                        <hr>
                                    </div>
                                </div>
                                <div class="p0 pt0 pb0">
                                    <div class="row">
                                        <div class="col-md-5 pr-0">
                                            <div class="mt20"><img height="96" src="assets/images/review_chart_03.svg"></div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="list2">
                                                <li><span><i class="ri-star-s-fill fsize18 green_400"></i> 4-5</span>  <strong>129</strong></li>
                                                <li><span><i class="ri-star-s-fill fsize18 yellow_400"></i> 3</span>  <strong>74</strong></li>
                                                <li><span><i class="ri-star-s-fill fsize18 red_400"></i> 1-2</span>  <strong>13</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>
        </div>
        <!--******************
        Content Area End
        **********************-->
        <div class="modal fade" id="CREATE_REQUEST_FORM" v-if="selected_campaign>0">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content review">
                    <a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
                    <div class="row">
                        <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
                        <loading :isLoading="loading"></loading>
                        <div class="col-12">
                            <h3 class="htxt_medium_24 dark_800 mb-3">Review Request</h3>
                            <p class="htxt_regular_14 dark_200 m-0">Select a type of campaign you would like to create and give it a title.</p>
                            <hr/>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="fname" class="fsize11 fw500 dark_600">REQUEST NAME</label>
                                <!--<input type="text" class="form-control h48 fsize14 dark_200 br4" id="fname" placeholder="Enter new campaign name" name="fname">-->

                                <div class="campaign_name_sec border br4 p10 pl20 pr20 fsize14 dark_200">
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" class="textfield fsize14 dark_200" v-model="requestFrom.name" id="fname" placeholder="Enter new request name" name="fname"></div>
                                        <div class="col-2">
                                            <div class="dropdown campaign_forms">
                                                <button class="btn dropdown-toggle bkg_light_000 w-100 p-1 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="assets/images/circle-dot.svg"/>
                                                </button>
                                                <div class="dropdown-menu w-100 dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><img src="assets/images/circle-dot.svg"/> Option 1 </a>
                                                    <a class="dropdown-item" href="#"><img src="assets/images/circle-dot.svg"/> Option 2 </a>
                                                    <a class="dropdown-item" href="#"><img src="assets/images/circle-dot.svg"/> Option 3 </a>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group m-0">
                                <label for="fname" class="fsize11 fw500 dark_600">REQUEST TYPE</label>
                                <div class="card border text-center shadow-none m-0" :class="{'reviews': requestFrom.type=='email'}" @click="requestFrom.type='email'" style="cursor:pointer;">
                                    <img class="mb-3" src="assets/images/email_blue+44.svg"/>
                                    <p class="htxt_medium_14 dark_600 mb-3">Email Request</p>
                                    <p class="htxt_regular_12 dark_300 m-0 lh_17">Send review requests emails <br>& sms instantly to all or part <br>of your customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group m-0">
                                <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                                <div class="card border text-center shadow-none m-0" :class="{'reviews': requestFrom.type=='sms'}" @click="requestFrom.type='sms'" style="cursor:pointer;">
                                    <img class="mb-3" src="assets/images/sms_blue_44.svg"/>
                                    <p class="htxt_medium_14 dark_600 mb-3">SMS Request</p>
                                    <p class="htxt_regular_12 dark_300 m-0 lh_17">Automaticaly send email or sms<br> every time a new purchase or<br> contact is added</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr/>
                        </div>

                        <div class="col-6">
                            <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click.prevent="addRequest">CONTINUE</button>
                            <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="#">Close</a>
                        </div>

                        <div class="col-6 text-right mt-2">
                            <a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">
                                <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                LEARN MORE ABOUT REQUESTS
                            </a>
                        </div>




                    </div>


                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import OnsiteCampaignsTab from '@/components/admin/brandboost/onsite/tabs/CampaignsSummary';
    import OnsiteReviewsTab from '@/components/admin/brandboost/onsite/tabs/Reviews';
    import OnsiteSubscribersTab from '@/components/admin/brandboost/onsite/tabs/Subscribers';
    import OnsiteReviewRequestsTab from '@/components/admin/brandboost/onsite/tabs/ReviewRequest';

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination, OnsiteCampaignsTab, OnsiteReviewsTab, OnsiteReviewRequestsTab, OnsiteSubscribersTab},
        data() {
            return {
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                allData: {},
                requests : '',
                oReviews : '',
                oCampaign: '',
                reviewTags: '',
                campaignId: '',
                current_page: 1,
                breadcrumb: '',
                seletedTab: 1,
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: '',
                selected_campaign: '',
                componentKey: 0,
                requestFrom: {
                    name: '',
                    type: '',
                    campaign_id: this.$route.params.id
                },
                selected_campaign: this.$route.params.id
            }
        },
        created() {
            this.loadData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.selected_campaign = this.$route.params.id;
        },
        methods: {
            addRequest: function(){
                this.loading = true;
                axios.post('/admin/brandboost/addOnsiteRequest', this.requestFrom)
                    .then(response => {
                        if(response.data.status =='success'){
                            this.refreshMessage = Math.random();
                            this.successMsg = 'Review request created successfully!!';
                            this.loading = false;
                            document.querySelector('#hideOverviewPreviewForm').click();
                            window.location.href='#/reviews/onsite/request/prepare/'+response.data.requestId;
                        }
                    });
            },
            setupBroadcast: function(id){
                window.location.href='#/reviews/onsite/setup/'+id;
            },
            selectCampaign: function(data){
                this.selected_campaign = data.id;
                //this.requestFrom.campaign_id = data.id;
                window.location.href = '#/reviews/campaign/'+this.selected_campaign;
                this.$forceUpdate();
                this.componentKey += 1;
                //location.reload();
                this.loadData();
            },
            loadData: function(){
                axios.get('/admin/brandboost/info?id='+this.$route.params.id)
                    .then(response => {
                        this.campaignId = response.data.campaignId;
                        this.oCampaign = response.data.oCampaign;
                    });
            }
        }
    }
    $(document).ready(function(){
        $(document).on("click", "#hideOverviewPreviewForm", function(){
            $("#CREATE_REQUEST_FORM").modal('hide');
        })
    });
</script>
