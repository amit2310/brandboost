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
                        <h3 class="htxt_medium_24 dark_700"> Campaigns </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <!--<button class="circle-icon-40 mr15"><img src="assets/images/filter_review.svg"/></button>-->
                        <button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"></button>
                        <button class="btn btn-md bkg_reviews_400 light_000" id="displayAddCampaignForm" @click="displayAddCampaignForm"> Create campaign <span><img src="/assets/images/reviews_plus_icon.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div class="container-fluid" v-if="campaigns.length > 0 || searchBy.length>0">
                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="card p40 pt0 pb0">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="fsize12 fw500 dark_200 mt30 mb30"><i><img src="assets/images/lightbulb-fill.svg"></i> &nbsp; TIPS</p>
                                    <h3 class="htxt_bold_18 dark_800">Automate messages, build engage with chatbots</h3>
                                    <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">Conversational marketing platform that helps companies close more deals by messaging with prospects in real-time &amp; via intelligent chatbots. Qualify leads, book meetings.</p>
                                </div>
                                <div class="col-md-5 text-center mt20">
                                    <img class="mt0" style="max-width: 272px;" src="assets/images/review_campaign.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="table_head_action">

                    <div class="row" v-if="viewType == 'Grid View'">
                        <div class="col-md-6">
                            <!--<ul class="table_filter">
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Name'}" @click="sortBy='Name'">ALL</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">ACTIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Pending'}" @click="sortBy='Pending'">PENDING</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Date Created'}" @click="sortBy='Date Created'">CREATED</a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>
                            </ul>-->
                            <h3 class="htxt_medium_16 dark_400">Campaigns</h3>
                        </div>
                        <div class="col-md-6">
                            <!--<ul class="table_filter text-right">
                                <li><input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem"></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                            </ul>-->
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': sortBy == 'Name'}" @click="applySort('Name')">Name</a>
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': sortBy == 'Active'}" @click="applySort('Active')">ACTIVE</a>
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': sortBy == 'Inactive'}" @click="applySort('Inactive')">INACTIVE</a>
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': sortBy == 'Pending'}" @click="applySort('Pending')">PENDING</a>
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': sortBy == 'Archive'}" @click="applySort('Archive')">ARCHIVE</a>
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')">CREATED</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button v-if="viewType='Grid View'" type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/cards_16_grey.svg"></span>&nbsp; Grid View
                                    </button>
                                    <button v-else type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/sort_16_grey.svg"></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'">List View</a>
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'">Grid View</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <!--<input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">-->
                                    <a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-else>
                        <div class="col-md-6">
                            <ul class="table_filter">
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Name'}" @click="applySort('Name')">ALL</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Active'}" @click="applySort('Active')">ACTIVE</a></li>
                                <!--<li><a href="javascript:void(0);" :class="{'active': sortBy == 'Inactive'}" @click="applySort('Inactive')">INACTIVE</a></li>-->
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Pending'}" @click="applySort('Pending')">DRAFT</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Archive'}" @click="applySort('Archive')">ARCHIVE</a></li>
                                <!--<li><a href="javascript:void(0);" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')">CREATED</a></li>-->

                                <li><a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a>
                                    <div class="dropdown-menu p10 mt-1">
                                        <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Inactive'}" @click="applySort('Inactive')"><i class="ri-check-double-fill"></i> &nbsp; INACTIVE</a>
                                        <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')"><i class="ri-check-double-fill"></i> &nbsp; CREATED</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="table_filter text-right">
                                <!--<li><input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem"></li>-->
                                <li><a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li v-show="deletedItems.length>0 && sortBy !='archive'"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card p20 datasearcharea reviewRequestSearch br6 shadow3">
                        <div class="form-group m-0 position-relative">
                            <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                            <a class="search_tables_open_close searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
                        </div>
                    </div>

                </div>

                <div class="row" v-if="viewType == 'Grid View'">
                    <div class="col-md-3 d-flex" v-for="campaign in campaigns" :key="campaign.id">
                        <div class="card p0 pt30 text-center animate_top col">
                            <span v-if="campaign.status == '1'" class="status_icon bkg_green_400"></span>
                            <span v-else class="status_icon bkg_light_800"></span>
                            <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a v-if="campaign.status == '2'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Start</a>
                                    <a v-if="campaign.status == '1'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Pause</a>
                                    <a v-if="campaign.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showContacts(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Contacts</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showCampaignPage(campaign.id,company_name,campaign.brand_title.replace(' ','-'))"><i class="dripicons-user text-muted mr-2"></i> Campaign Page</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showReviews(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Reviews</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showQuestions(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Questions</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(campaign.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <!--<a href="javascript:void(0);" @click="setupBroadcast(campaign.id)" class="circle-icon-64 bkg_reviews_000 m0auto">
                                <img v-if="campaign.status == 1" src="assets/images/star-fill-review-24.svg">
                                <img v-else src="assets/images/star-fill-grey.svg">
                            </a>-->

                            <a v-if="campaign.status == 1" href="javascript:void(0);" @click="setupBroadcast(campaign.id)" class="circle-icon-64 bkg_reviews_300 m0auto">
                                <img src="assets/images/star_fill_white_25.svg">
                            </a>
                            <a v-else href="javascript:void(0);" @click="setupBroadcast(campaign.id)" class="circle-icon-64 bkg_light_800 m0auto">
                                <img src="assets/images/star_fill_white_25.svg">
                            </a>

                            <h3 class="htxt_bold_16 dark_700 mb-2 mt-4" @click="setupBroadcast(campaign.id)">{{ setStringLimit(capitalizeFirstLetter(campaign.brand_title), 25) }}</h3>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="campaign.status == 0" @click="setupBroadcast(campaign.id)">INACTIVE</p>
                            <p class="fsize10 fw500 green_400 text-uppercase mb20" v-if="campaign.status == 1" @click="setupBroadcast(campaign.id)">RUNNING</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="campaign.status == 2" @click="setupBroadcast(campaign.id)">PENDING</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="campaign.status == 3" @click="setupBroadcast(campaign.id)">ARCHIVE</p>
                            <div class="p15 pt15 btop" @click="setupBroadcast(campaign.id)">
                                <ul class="workflow_list">
                                    <li><a href="javascript:void(0);"><span><img src="assets/images/send-plane-grey.svg"></span> {{ campaign.reviewRequestsCountK }}k</a></li>
                                    <li><a href="javascript:void(0);"><span><img src="assets/images/mail_open_fill_grey.svg"></span> {{ campaign.reviewResponsePercent }}%</a></li>
                                    <li><a href="javascript:void(0);"><span><img src="assets/images/cursorline-fill-grey.svg"></span> {{ campaign.reviewResponsePercent }}%</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex" @click="displayAddCampaignForm" style="cursor: pointer;">
                        <div class="card p0 pt50 text-center animate_top col">
                            <a href="javascript:void(0);" class="circle-icon-64 bkg_light_200 m0auto"><img src="assets/images/plus_grey_24.svg"> </a>
                            <h3 class="htxt_bold_12 dark_200 mb-0 mt-4 text-uppercase">Create<br>new campaign</h3>
                        </div>
                    </div>
                </div>

                <div class="row" v-if="viewType == 'List View'">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
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
                                    <td><span class="fsize10 fw500">CAMPAIGN </span></td>
                                    <td><span class="fsize10 fw500">TYPE </span></td>
                                    <td><span class="fsize10 fw500"><img src="assets/images/send-plain-line.svg"></span></td>
                                    <td><span class="fsize10 fw500"><img src="assets/images/eyeline.svg"></span></td>
                                    <td><span class="fsize10 fw500"><img src="assets/images/cursor-line.svg"></span></td>
                                    <td><span class="fsize10 fw500">RATING</span></td>
                                    <td><span class="fsize10 fw500">SENT <img src="assets/images/arrow-down-line-14.svg"> </span></td>
                                    <td><span class="fsize10 fw500">STATUS</span></td>
                                    <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>
                                </tr>

                                <tr v-for="campaign in campaigns" :key="campaign.id">
                                    <td width="20">
                                        <span>
                                            <label class="custmo_checkbox pull-left">
                                                <input type="checkbox" :checked="deletedItems.indexOf(campaign.id)>-1" @change="addtoDeleteCollection(campaign.id, $event.target)">
                                                <span class="custmo_checkmark blue"></span>
                                            </label>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="table-img mr15">
                                            <span v-if="campaign.status == 1" class="circle_icon_24 bkg_reviews_400">
                                                <img src="assets/images/pricetag3-fill.svg" width="14">
                                            </span>
                                            <span v-else class="circle_icon_24 bkg_light_800">
                                                <img src="assets/images/pricetag3-fill.svg" width="14">
                                            </span>
                                        </span>
                                        <a href="javascript:void(0);" @click="setupBroadcast(campaign.id)">
                                            <span>{{ setStringLimit(capitalizeFirstLetter(campaign.brand_title), 25) }}</span>
                                        </a>
                                        <!--<a href="javascript:void(0);" @click="setupBroadcast(campaign.id)">
                                            <p class="fsize12 green_400 ml-4">{{ setStringLimit(campaign.brand_desc, 100) }}</p>
                                        </a>-->
                                    </td>
                                    <td>
                                        <span v-if="campaign.review_type == 'onsite'"><img src="assets/images/window-fill.svg"> {{ capitalizeFirstLetter(campaign.review_type) }} Review Requests</span>
                                        <span v-else><img src="assets/images/share-circle-line.svg"> {{ capitalizeFirstLetter(campaign.review_type) }} Review Requests</span>
                                    </td>
                                    <td>{{ campaign.reviewRequestsCountFormat }}</td>
                                    <td>{{ campaign.reviewResponsePercent }}%</td>
                                    <td>{{ campaign.reviewResponsePercent }}%</td>
                                    <td>
                                        <span v-if="campaign.revRA != ''" class="mr-2">
                                            <img v-if="campaign.revRA > '3'" src="assets/images/emojie-eye-face-l.svg">
                                            <img v-if="campaign.revRA == '3'" src="assets/images/emojie-face-smile.svg">
                                        </span>
                                        <span v-if="campaign.revRA != ''">{{ campaign.revRA }}/5</span>
                                        <span v-else>&nbsp;</span>
                                    </td>
                                    <td>{{ displayDateFormat("M d, Y", campaign.created) }}</td>
                                    <td>
                                        <span v-if="campaign.status == 0" class="mr-3"><span class="status_icon bkg_light_600"></span> &nbsp;Inactive</span>
                                        <span v-if="campaign.status == 1" class="mr-3"><span class="status_icon bkg_green_300"></span> &nbsp;Active</span>
                                        <span v-if="campaign.status == 2" class="mr-3"><span class="status_icon bkg_reviews_300"></span> &nbsp;Pending</span>
                                        <span v-if="campaign.status == 3" class="mr-3"><span class="status_icon bkg_reviews_300"></span> &nbsp;Archive</span>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
                                                <span><img src="assets/images/more-2-fill.svg"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                                <a v-if="campaign.status == '2'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Start</a>
                                                <a v-if="campaign.status == '1'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Pause</a>
                                                <a v-if="campaign.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="showContacts(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Contacts</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="showCampaignPage(campaign.id,company_name,campaign.brand_title.replace(' ','-'))"><i class="dripicons-user text-muted mr-2"></i> Campaign Page</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="showReviews(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Reviews</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="showQuestions(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Questions</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(campaign.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
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
                    :offset="4"
                >
                </pagination>
            </div>

            <div class="container-fluid" v-else>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 250px; " src="assets/images/review_Illustration.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any campaigns</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import campaign!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400" @click="displayAddCampaignForm">Create review campaign</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT CAMPAIGN</a>
                    </div>
                </div>
            </div>


            <!-- Add Campaign Popup -->
            <div class="modal fade show" id="CREATEFORM">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content review">
                        <a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
                        <form method="post" @submit.prevent="processForm" @keydown="form.errors.clear($event.target.name)">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="htxt_medium_24 dark_800 mb-3">Review Campaign</h3>
                                <p class="htxt_regular_14 dark_200 m-0">Select a type of campaign you would like to create and give it a title.</p>
                                <hr/>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN NAME</label>
                                    <!--<input type="text" class="form-control h48 fsize14 dark_200 br4" id="fname" placeholder="Enter new campaign name" name="fname">-->

                                    <div class="campaign_name_sec border br4 p10 pl20 pr20 fsize14 dark_200">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" v-model="form.campaignName" class="textfield fsize14 dark_200" id="fname" placeholder="Enter new campaign name" name="campaignName">
                                            </div>
                                            <div class="col-2">
                                                <div class="dropdown campaign_forms">
                                                    <button class="btn dropdown-toggle bkg_light_000 w-100 p-1 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="assets/images/circle-dot.svg"/>
                                                    </button>
                                                    <div class="dropdown-menu w-100 dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"/> Option 1 </a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"/> Option 2 </a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"/> Option 3 </a>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <span class="help alert-danger" v-if="form.errors.has('campaignName')" v-text="form.errors.get('campaignName')"></span>

                                </div>

                            </div>


                            <div class="col">
                                <div class="form-group m-0">
                                    <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN TYPE</label>
                                    <div class="card border text-center shadow-none m-0" :class="{'reviews': form.campaignType =='manual'}" @click="form.campaignType='manual'" style="cursor: pointer;">
                                        <img class="mb-3" src="assets/images/review_icon1.svg"/>
                                        <p class="htxt_medium_14 dark_600 mb-3">Manual Campaign</p>
                                        <p class="htxt_regular_12 dark_300 m-0 lh_17">Send review requests emails <br>& sms instantly to all or part <br>of your customers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group m-0">
                                    <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                                    <div class="card border text-center shadow-none m-0" :class="{'reviews': form.campaignType =='automated'}" @click="form.campaignType='automated'" style="cursor: pointer;">
                                        <img class="mb-3" src="assets/images/review_icon2.svg"/>
                                        <p class="htxt_medium_14 dark_600 mb-3">Automated Campaign</p>
                                        <p class="htxt_regular_12 dark_300 m-0 lh_17">Automaticaly send email or sms<br> every time a new purchase or<br> contact is added</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr/>
                            </div>

                            <div class="col-6">
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id" :value="moduleAccountID">
                                <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" :disabled="form.errors.any()">CONTINUE</button>
                                <a class="dark_200 fsize12 fw500 ml20 text-uppercase" data-dismiss="modal" href="javascript:void(0);">Close</a>
                            </div>

                            <div class="col-6 text-right mt-2">
                                <a class="lh_32 htxt_regular_12 dark_200 ls_4" href="javascript:void(0);">
                                    <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                    LEARN MORE ABOUT CAMPAIGNS
                                </a>
                            </div>




                        </div>
                        </form>


                    </div>
                </div>
            </div>




            <!--<div class="box" style="width: 724px;">
                <div style="width: 724px;overflow: hidden; height: 100%;">
                    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-review-campaign-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                        <form method="post" @submit.prevent="processForm" @keydown="form.errors.clear($event.target.name)">
                            <div class="p40">
                                <div class="row">
                                    <div class="col-12">
                                        &lt;!&ndash;<img src="/assets/images/sms_temp_icon.svg"/>&ndash;&gt;
                                        <h3 class="htxt_medium_24 dark_800 mb-3">Review Campaign</h3>
                                        <p class="htxt_regular_14 dark_200 m-0">Select a type of campaign you would like to create and give it a title.</p>
                                        <hr/>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="campaignName" class="fsize11 fw500 dark_600">CAMPAIGN NAME</label>
                                            <input type="text" class="form-control h56" id="name" placeholder="Enter new campaign name" name="campaignName"
                                                   v-model="form.campaignName">
                                            <span class="help alert-danger" v-if="form.errors.has('campaignName')" v-text="form.errors.get('campaignName')"></span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description" class="fsize11 fw500 dark_600">DESCRIPTION</label>
                                            <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Enter campaign description" name="OnsitecampaignDescription"
                                                      v-model="form.OnsitecampaignDescription"></textarea>
                                            <span class="help alert-danger" v-if="form.errors.has('OnsitecampaignDescription')" v-text="form.errors.get('OnsitecampaignDescription')"></span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group m-0">
                                            <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN TYPE</label>
                                            <div class="card border text-center shadow-none m-0 reviews">
                                                <img class="mb-3" src="assets/images/review_icon1.svg"/>
                                                <p class="htxt_medium_14 dark_600 mb-3">Manual Campaign</p>
                                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Send review requests emails <br>& sms instantly to all or part <br>of your customers</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-0">
                                            <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                                            <div class="card border text-center shadow-none m-0">
                                                <img class="mb-3" src="assets/images/review_icon2.svg"/>
                                                <p class="htxt_medium_14 dark_600 mb-3">Automated Campaign</p>
                                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Automaticaly send email or sms<br> every time a new purchase or<br> contact is added</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr/>
                                    </div>

                                    <div class="col-6">
                                        <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                        <input type="hidden" name="module_account_id" id="module_account_id" :value="moduleAccountID">
                                        <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" :disabled="form.errors.any()">{{ formLabel }}</button>
                                        <a class="dark_200 fsize12 fw500 ml20 text-uppercase js-review-campaign-slidebox" href="javascript:void(0);">Close</a>
                                    </div>

                                    <div class="col-6 text-right mt-2">
                                        <a class="lh_32 htxt_regular_12 dark_200 ls_4" href="javascript:void(0);">
                                            <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                            LEARN MORE ABOUT CAMPAIGNS
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>-->
            <!-- /Add Campaign -->
        </div>
        <!--******************
          Content Area End
         **********************-->
    </div>
</template>
<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import jq from 'jquery';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
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
                campaigns : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: new Form({
                    campaignName: '',
                    OnsitecampaignDescription: '',
                    campaign_id: '',
                    campaignType: 'manual'
                }),
                formLabel: 'Create',
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
        },
        watch: {
          'sortBy' : function(){
              this.loadPaginatedData();
          },
            'searchBy' : function(){
                this.loadPaginatedData();
            }
        },
        computed:{
            'allChecked' : function () {
                let notFound = '';
                this.campaigns.forEach(camp => {
                    let idx = this.deletedItems.indexOf(camp.id);
                    if(idx == -1){
                        notFound = true;
                    }
                });
                return notFound === true ? false : true;
            }
        },
        methods: {
            applySort: function(sortVal){
                this.sortBy = sortVal;
                this.deletedItems = [];
            },
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    if(confirm('Are you sure you want to delete selected item(s)?')){
                        this.loading = true;
                        axios.post('/admin/brandboost/delete_multipal_brandboost', {_token:this.csrf_token(), multi_brandboost_id:this.deletedItems})
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
                        if(this.campaigns.length>0){
                            this.campaigns.forEach(camp => {
                                let idxx = this.deletedItems.indexOf(camp.id);
                                if(idxx == -1){
                                    this.deletedItems.push(camp.id);
                                }
                            });
                        }
                    }else{
                        this.campaigns.forEach(camp => {
                            let idxx = this.deletedItems.indexOf(camp.id);
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
            searchItem: function(){
                this.loadPaginatedData();
            },
            setupBroadcast: function(id){
                window.location.href='#/reviews/onsite/setup/'+id+'/1';
            },
            showContacts: function(id){
                window.location.href='#/brandboost/stats/onsite/'+id+'?t=contact';
            },
            showCampaignPage: function(id,companyName,campaignName){
                window.location.href='#/for/'+companyName+'/'+campaignName+'-'+id;
            },
            showReviews: function(id){
                window.location.href='#/brandboost/reviews/'+id;
            },
            showQuestions: function(id){
                window.location.href='#/brandboost/questions/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/onsite?page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.company_name = response.data.company_name;
                        this.allData = response.data.allData;
                        this.campaigns = response.data.aBrandbosts;
                        this.loading = false;
                        //console.log(this.campaigns)
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
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-review-campaign-slidebox').click();
            },
            displayAddCampaignForm: function(){
                document.querySelector('#displayAddCampaignForm').click();
            },
            prepareItemUpdate: function(campaign_id) {
                this.getItemInfo(campaign_id);
            },
            getItemInfo: function(campaign_id){
                axios.post('/admin/brandboost/getReviewCampaign', {
                    campaign_id: campaign_id,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.campaign_id = formData.campaign_id;
                            this.form.campaignName = formData.campaignName;
                            this.form.OnsitecampaignDescription = formData.description;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }
                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.campaign_id>0){
                    formActionSrc = '/admin/brandboost/updateReviewCampaign';
                }else{
                    formActionSrc = '/admin/brandboost/addOnsite';
                    this.form.module_account_id = this.moduleAccountID;
                }
                this.form.post(formActionSrc, this.form)
                .then(response => {
                    if (response.data.status == 'success') {
                        if(response.data.brandboostID>0){
                            this.successMsg = "Campaign added successfully! Redirecting to the setup page...";
                            window.location.href='#/reviews/onsite/setup/'+response.data.brandboostID+'/1';
                            return false;
                        }

                        //this.form = {};
                        document.querySelector('.js-review-campaign-slidebox').click();
                        this.successMsg = 'Action completed successfully.';
                        var elem = this;
                        setTimeout(function () {
                            elem.loadPaginatedData();
                        }, 500);
                        syncContactSelectionSources();
                    }
                    else if (response.data.status == 'error') {
                        if (response.data.type == 'duplicate') {
                            alert('Error: Campaign already exists.');
                        }
                        else {
                            alert('Error: Something went wrong.');
                        }
                    }else{
                        this.loading = false;
                    }
                })
                .catch(errors => {
                    this.loading = false;
                })
            },
            changeStatus: function(campaign_id, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/updateOnsiteStatus', {
                        brandboostID:campaign_id,
                        status:status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            },
            deleteItem: function(campaign_id) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/delete_brandboost', {
                        brandboost_id:campaign_id,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }
                        });
                }
            }
        }
    }
    $(document).ready(function(){
        $(document).on("click", "#displayAddCampaignForm", function(){
            $("#CREATEFORM").modal('show');
        })

    });
</script>
