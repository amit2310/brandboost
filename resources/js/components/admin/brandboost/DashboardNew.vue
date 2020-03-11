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
                        <h3 class="htxt_medium_24 dark_700">Review General</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/settings-2-line-reviews.svg"></button>
                        <!--<button class="btn btn-md bkg_reviews_400 light_000" data-toggle="modal" data-target="#CREATEFORM">CREATE CAMPAIGN <span><img src="assets/images/reviews_plus_icon.svg"></span></button>-->
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
                <div class="page_sidebar bkg_light_000 fixed">
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
                </div>
                <!--******************
                  PAGE LEFT SIDEBAR END
                 **********************-->

                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="table_filter">
                                <li :class="[ seletedTab === 1 ? 'active' : '' ]"><a v-on:click="seletedTab=1" data-toggle="tab" style="cursor:pointer; padding: 5px;">Overview&nbsp;</a></li>&nbsp;&nbsp;
                                <li :class="[ seletedTab === 1 ? 'active' : '' ]"><a v-on:click="seletedTab=1" data-toggle="tab" style="cursor:pointer; padding: 5px;">Requests&nbsp;</a></li>&nbsp;&nbsp;
                                <li :class="[ seletedTab === 2 ? 'active' : '' ]"><a v-on:click="seletedTab=2" data-toggle="tab" style="cursor:pointer; padding: 5px;">Reviews </a></li>&nbsp;&nbsp;
                                <li :class="[ seletedTab === 3 ? 'active' : '' ]"><a v-on:click="seletedTab=3" data-toggle="tab" style="cursor:pointer; padding: 5px;">Contacts&nbsp;</a></li>&nbsp;&nbsp;
                                <li :class="[ seletedTab === 4 ? 'active' : '' ]"><a v-on:click="seletedTab=4" data-toggle="tab" style="cursor:pointer; padding: 5px;">Stats&nbsp;</a></li>&nbsp;&nbsp;
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

                <OnsiteReviewRequestsTab v-if="(seletedTab === '' || seletedTab === 1)"></OnsiteReviewRequestsTab>

                <OnsiteReviewsTab v-if="(seletedTab == 2)"></OnsiteReviewsTab>

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

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import OnsiteReviewsTab from '@/components/admin/brandboost/onsite/tabs/Reviews';
    import OnsiteReviewRequestsTab from '@/components/admin/brandboost/onsite/tabs/ReviewRequest';

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination, OnsiteReviewsTab, OnsiteReviewRequestsTab},
        data(){
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
                searchBy: ''
            }
        }
    }
</script>
