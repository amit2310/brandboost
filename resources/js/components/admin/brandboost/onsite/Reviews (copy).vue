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
                        <h3 class="htxt_medium_24 dark_700">Reviews</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="content-area">
            <div class="container-fluid" v-if="oReviews.length > 0 || searchBy.length>0">
                <div class="row">
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
                </div>
                <div class="table_head_action bbot pb30">
                    <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                    <loading :isLoading="loading"></loading>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ oReviews.length }}&nbsp;Reviews</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"></span>&nbsp; {{sortBy}}
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
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"></span>&nbsp; {{viewType}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'">Grid View</a>
                                        <a class="dropdown-item" href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'">List View</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" v-if="viewType == 'Grid View'">
                    <div class="col-md-3 d-flex" v-for="oReview in oReviews">
                        <div class="card p0 pt30 text-center animate_top col">
                            <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(oReview.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a v-if="oReview.rstatus == '0' || oReview.rstatus == '2'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                    <a v-if="oReview.rstatus == '1'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                    <a v-if="oReview.rstatus != '3'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showReview(oReview.id)"><i class="dripicons-user text-muted mr-2"></i> View Review</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(oReview.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" @click="setupBroadcast(oReview.id)" class="circle-icon-64 bkg_reviews_000 m0auto">
                                <img v-if="oReview.rstatus == 1" src="assets/images/review_campaign.png">
                                <img v-else src="assets/images/review_campaign.png">
                            </a>
                            <h3 class="htxt_bold_16 dark_700 mb-2 mt-4" @click="showReview(oReview.id)" style="cursor: pointer;">
                                {{ setStringLimit(capitalizeFirstLetter(oReview.review_title), 23) }}
                            </h3>
                            <p>{{ setStringLimit(capitalizeFirstLetter(oReview.comment_text), 31) }}</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="oReview.rstatus == 0" @click="setupBroadcast(oReview.id)">INACTIVE</p>
                            <p class="fsize10 fw500 green_400 text-uppercase mb20" v-if="oReview.rstatus == 1" @click="setupBroadcast(oReview.id)">ACTIVE</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="oReview.rstatus == 2" @click="setupBroadcast(oReview.id)">PENDING</p>
                            <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="oReview.rstatus == 3" @click="setupBroadcast(oReview.id)">ARCHIVED</p>
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
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td><span class="fsize12 fw300">Review </span></td>
                                    <td><span class="fsize12 fw300">Status</span></td>
                                    <td><span class="fsize12 fw300">Created On</span></td>
                                    <td><span class="fsize12 fw300">Created By</span></td>
                                    <td><span class="fsize12 fw300">&nbsp;</span></td>
                                </tr>
                                <tr v-for="oReview in oReviews">
                                    <td>

                                        <h3 class="htxt_bold_16 dark_700 mb-2 mt-4" @click="showReview(oReview.id)" style="cursor: pointer;">
                                            <img src="assets/images/review_campaign.png" style="width: 30px;"> {{ setStringLimit(capitalizeFirstLetter(oReview.review_title), 23) }}
                                        </h3>
                                        <p class="fsize12 fw500 green_400 ml-4">{{ setStringLimit(capitalizeFirstLetter(oReview.comment_text), 31) }}</p>
                                    </td>
                                    <td>
                                        <span class="text-danger" v-if="oReview.rstatus == 0" @click="setupBroadcast(oReview.id)">INACTIVE</span>
                                        <span class="text-success" v-if="oReview.rstatus == 1" @click="setupBroadcast(oReview.id)">ACTIVE</span>
                                        <span class="text-primary" v-if="oReview.rstatus == 2" @click="setupBroadcast(oReview.id)">PENDING</span>
                                        <span class="text-info" v-if="oReview.rstatus == 3" @click="setupBroadcast(oReview.id)">ARCHIVED</span>
                                    </td>
                                    <td>{{ displayDateFormat('M d, h:i A', oReview.review_created) }}</td>
                                    <td>
                                        <user-avatar
                                            :avatar="oReview.avatar"
                                            :firstname="oReview.firstname"
                                            :lastname="oReview.lastname"
                                        ></user-avatar>
                                        <span>{{ oReview.firstname }} {{ oReview.lastname }}</span>
                                        <span v-if="oReview.email != ''"><br />{{ oReview.email }}</span>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
                                                <span><img src="assets/images/more-vertical.svg"/></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(oReview.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                                <a v-if="oReview.rstatus == '0' || oReview.rstatus == '2'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                                <a v-if="oReview.rstatus == '1'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                                <a v-if="oReview.rstatus != '3'" :review_id="oReview.reviewid" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oReview.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="showReview(oReview.id)"><i class="dripicons-user text-muted mr-2"></i> View Review</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(oReview.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
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
                    class="mt-4">
                </pagination>

            </div>

            <div class="container-fluid" v-else>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    &nbsp;
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="javascript:void(0);">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                                        Learn how to use reviews monitoring
                                    </a>
                                </div>
                            </div>
                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 250px; " src="assets/images/review_campaign.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any reviews</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import reviews!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 js-review-campaign-slidebox">Create review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--================================= CONTENT AFTER TAB===============================-->

        <!--=====================================Create new review================================-->
        <div id="addPeopleList" class="modal fade">
            <div style="max-width: 440px;ss" class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Create new campaign</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Campaign name</label>
                                        <div class="">
                                            <input placeholder="Enter campaign name" name="firstname" id="firstname" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb0">
                                        <label class="control-label">Campaign description</label>
                                        <div class="">
                                            <textarea placeholder="Enter campaign description"  class="form-control" value="" type="text" required> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p40">
                            <input type="hidden" name="listId" id="list_id" value="">
                            <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                            <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--=====================================Add List Modal Popup End================================-->

        <!--=====================================Create new campaign================================-->
        <div id="addPeopleList" class="modal fade">
            <div style="max-width: 440px;ss" class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Create new campaign</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Campaign name</label>
                                        <div class="">
                                            <input placeholder="Enter campaign name" name="firstname" id="firstname" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb0">
                                        <label class="control-label">Campaign description</label>
                                        <div class="">
                                            <textarea placeholder="Enter campaign description"  class="form-control" value="" type="text" required> </textarea>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="modal-footer p40">
                            <input type="hidden" name="listId" id="list_id" value="">
                            <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                            <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--=====================================Add List Modal Popup End================================-->

        <!-- =======================edit users popup========================= -->


        <div id="editReview" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal" id="updateReview" action="javascript:void();">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-lg-3">Title</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="edit_review_title" id="edit_review_title" placeholder="Title" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Comment</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" placeholder="Leave Review" name="edit_content" id="edit_content" required ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Rating</label>
                                <div class="col-lg-9">
                                    <div class="step_star_new" style="padding: 5px 0;">

                                        <ul id='stars'>

                                            <li class='star' title='Poor' data-value='1'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Fair' data-value='2'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Good' data-value='3'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Excellent' data-value='4'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='WOW!!!' data-value='5'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0" id="ratingValue" name="ratingValue">
                            <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- =======================edit video popup========================= -->

        <div id="editVideoReview" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal" id="updateVideoReview" action="javascript:void();">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-lg-3">Title</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="edit_review_title" id="edit_video_review_title" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Rating</label>
                                <div class="col-lg-9">
                                    <div class="step_star_new" style="padding: 5px 0;">
                                        <ul id='stars_video'>

                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0" id="ratingValueVideo" name="ratingValueVideo">
                            <input type="hidden" name="edit_video_reviewid" id="edit_video_reviewid" value="">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="showVideoPopup" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Video</h5>
                    </div>
                    <div class="modal-body">

                        <div id="divVideo" class="form-group">
                            <video width="100%" height="auto" controls>
                                <source src="" type="video/mp4">
                            </video>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        <a id="downloadVideo" class="btn btn-primary" href="" download><i class="icon-download"></i>&nbsp;&nbsp; Download Video</a>
                    </div>

                </div>
            </div>
        </div>


        <div id="reviewPopup" class="modal fade">
            <div class="modal-dialog">
                <div class="">
                    <div class="col-md-12">
                        <div class="panel">
                            <div style="border-top: none; border-bottom: 1px solid #eee!important;" class="panel-footer panel-footer-condensed">
                                <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="reviewTime"></span>
                            </span>
                                    <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                                </div>
                            </div>
                            <div class="panel-body" id="reviewContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="previewReviewReply" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body" id="previewReviewReplyContent"></div>
                            <div class="panel-footer panel-footer-condensed">
                                <div class="heading-elements not-collapsible">
                                    <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="ReviewTagListModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Apply Tags</h5>
                        </div>
                        <div class="modal-body" id="tagEntireList"></div>

                        <div class="modal-footer modalFooterBtn">
                            <input type="hidden" name="review_id" id="tag_review_id" />
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn dark_btn">Apply Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- newreviewpopup -->
        <div id="newreviewpopup" class="modal fade newreviewpopup2">
            <div class="modal-dialog">
                <div class="modal-content" id="reviewPopupBox">

                </div>
            </div>
        </div>
        <!-- /newreviewpopup -->

        <div id="commentpopup" class="modal fade"></div>
    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
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
                allData: {},
                oReviews : '',
                oCampaign: '',
                reviewTags: '',
                campaignId: '',
                current_page: 1,
                breadcrumb: '',
                form: new Form({
                    campaignName: '',
                    OnsitecampaignDescription: '',
                    campaign_id: ''
                }),
                formLabel: 'Create',
                viewType: 'Grid View',
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
                window.location.href='#/brandboost/reviewdetails/'+id;
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
    $(document).ready(function () {
        $(document).on('click', '.js-review-campaign-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });
    });
</script>
