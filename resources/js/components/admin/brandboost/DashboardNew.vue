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
                            <ul class="table_filter text-right">
                                <li><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li><a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="#"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div v-if="(seletedTab === '' || seletedTab === 1)">
                <div class="table_head_action pb0 mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_14 dark_600">Review Requests</h3>
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
                                    <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Name'}" @click="sortByRR='all'">ALL</a>
                                    <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortByRR='archive'">ARCHIVE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="requests.length > 0" class="row">
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

                            <pagination
                                :pagination="allDataRR"
                                @paginate="showPaginationDataRR"
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

                <div v-if="(seletedTab == 2)">
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

                <div v-if="(seletedTab == 4)">
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
                </div>

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

    export default {
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
                searchBy: '',

                moduleNameRR: '',
                requests : '',
                allDataRR: {},
                current_pageRR: 1,
                breadcrumbRR: '',
                viewTypeRR: 'List View',
                sortByRR: 'all',
                searchByRR: '',
            }
        },
        created() {
            this.loadPaginatedDataRR();
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
        },
        watch: {
            'sortByRR' : function(){
                this.loadPaginatedDataRR();
            },
            'sortBy' : function(){
                this.loadPaginatedData();
            }
        },
        methods: {
            showReview: function(id){
                window.location.href='#/reviews/onsite/reviews/'+id;
            },
            loadPaginatedDataRR : function(){
                axios.get('/admin/brandboost/review_request/onsite?page='+this.current_pageRR+'&search='+this.searchByRR+'&sortBy='+this.sortByRR)
                    .then(response => {
                        this.breadcrumbRR = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumbRR);
                        this.moduleNameRR = response.data.moduleName;
                        this.requests = response.data.oRequest;
                        this.allDataRR = response.data.allData;
                    });
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
            showPaginationDataRR: function(p){
                this.current_pageRR = p;
                this.loadPaginatedDataRR();
            },
            navigatePaginationRR: function(p){
                this.current_pageRR = p;
                this.loadPaginatedDataRR();
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
