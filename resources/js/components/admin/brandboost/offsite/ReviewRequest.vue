<template>
    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-3">
                    <h3><img src="/assets/images/offsite_icon_19.png" style="width: 16px;"> {{ title }}</h3>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-9 text-right btn_area">
                    <div class="btn-group">
                        <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Contacts &nbsp; &nbsp; <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                            <div class="dropdown-content-heading"> Filter
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-more"></i></a> </li>
                                </ul>
                            </div>
                            <div class="">
                                <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings active">
                                            <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here... </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here... </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here... </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary" checked="checked">
                                                                Total Reviews
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary" checked="checked">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary" checked="checked">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-content-footer">
                                <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                                &nbsp; &nbsp;
                                <a style="display: inline-block;" href="#">Clear All</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

        <div class="row">
            <div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading" style="box-shadow:none">
                        <h6 class="panel-title">{{count}} Review Requests</h6>

                        <div class="heading-elements">

                            <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm cus_search" tableid="reviewRequestOffsite" placeholder="Search by name" type="text">
                                <div class="form-control-feedback">
                                    <i class=""><img src="/assets/images/icon_search.png" width="14"></i>
                                </div>
                            </div>
                            <div class="table_action_tool">
                                <a href="javascript:void(0);"><i class=""><img src="/assets/images/icon_calender.png"/></i></a>
                                <a href="javascript:void(0);" class="editDataList"><i class=""><img src="/assets/images/icon_edit.png"/></i></a>
                                <a href="javascript:void(0);" id="deleteReviewRequest" class="custom_action_box" style="display:none;"><i class="icon-trash position-left"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table v-if="count>0" class="table" id="reviewRequestOffsite">
                            <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th class="nosort editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                <th><i class="icon-stack-star"></i>Name</th>
                                <th><i class="icon-atom"></i>Campaign</th>
                                <!-- <th><i class="icon-display"></i>Phone</th> -->

                                <th><i class="icon-hash"></i>Source</th>
                                <th><i class="icon-user"></i>Contact Details</th>
                                <th><i class="icon-calendar"></i>Created</th>
                                <th><i class="icon-calendar"></i>Request Sent Date</th>
                                <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="request in requests" :id="`append-${request.trackinglogid}`" class="selectedClass">
                                <td style="display: none;">{{ request.created}}</td>
                                <td style="display: none;">{{ request.trackinglogid }}</td>
                                <td class="editAction" style="display:none;">
                                    <label class="custmo_checkbox pull-left">
                                        <input type="checkbox" name="checkRows[]" class="checkRows" :id="`chk${request.trackinglogid}`" :value="request.trackinglogid" ><span class="custmo_checkmark"></span>
                                    </label>
                                </td>

                                <td>
                                    <div class="media-left media-middle">
                                        <a class="editBrandboost" :brandid="request.brandboost_id" b_title="click to view campaign details" href="javascript:void(0);">
                                            <img v-if="request.brand_img" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${request.brand_img}`" onerror="this.src='/assets/images/default-logo.png'"  class="img-circle img-xs br5" alt="">
                                            <img v-else src="/assets/images/default_table_img2.png" onerror="this.src='/assets/images/default-logo.png'"  class="img-circle img-xs br5" alt="">
                                        </a>
                                    </div>
                                    <div class="media-left">
                                        <div class=""><a href="javascript:void(0);" class="text-default text-semibold" :brandid="request.brandboost_id">{{ request.brand_title }}</a> </div>
                                        <div v-if="request.brand_desc" class="text-muted text-size-small">{{setStringLimit(request.brand_desc, 20)}}</div>
                                        <div v-else class="text-muted text-size-small" v-html="displayNoData()"></div>
                                    </div>
                                </td>

                                <td><div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-display4 txt_purple"></i></a> </div>
                                    <div class="media-left">
                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ capitalizeFirstLetter(request.review_type) }}</a></div>
                                    </div></td>

                                <td><div class="media-left media-middle"> <a class="icons" href="javascript:void(0);">
                                    <i v-if="capitalizeFirstLetter(request.tracksubscribertype) == 'Sms'" class="icon-mobile2 txt_green"></i>
                                    <i v-else class="icon-envelop txt_blue"></i>

                                </a> </div>
                                    <div class="media-left">
                                        <div class="pt-5">
                                            <a href="javascript:void(0);" class="text-default text-semibold">{{ capitalizeFirstLetter(request.tracksubscribertype) }}</a></div>
                                    </div></td>

                                <td>
                                    <div class="media-left media-middle">
                                        <user-avatar
                                            :avatar="request.avatar"
                                            :firstname="request.firstname"
                                            :lastname="request.lastname"
                                        ></user-avatar>
                                    </div>

                                    <div v-if="request.uid" class="media-left">
                                        <div class="pt-5">
                                            <a :href="`/admin/subscriber/activities/${request.uid}`" target="_blank" class="text-default text-semibold bbot">
                                                <span>{{ request.firstname }} {{ request.lastname }}</span>
                                            </a>
                                            <img class="flags" :src="`/assets/images/flags/${request.country.toLowerCase()}.png`" onerror="this.src='/assets/images/flags/us.png'"/></div>
                                        <div class="text-muted text-size-small">{{ request.email }}</div>
                                    </div>
                                    <div v-else class="media-left" v-html="displayNoData()"></div>
                                </td>

                                <td>
                                    <div class="media-left">
                                        <div class="pt-5"><span class="text-default text-semibold">{{request.created}}</span></div>
                                        <div class="text-muted text-size-small">{{request.created}}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left">
                                        <div class="pt-5"><span class="text-default text-semibold">{{ request.requestdate }}</span></div>
                                        <div class="text-muted text-size-small">{{ request.requestdate }}</div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="tdropdown">
                                        <i v-if="request.subscriberstatus == 1" class="icon-primitive-dot txt_green fsize16"></i>
                                        <i v-else class="icon-primitive-dot txt_red fsize16"></i>
                                        <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">{{ request.subscriberstatus == 1 ? ' Active' : ' Inactive' }}</a>
                                        <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">

                                            <li v-if="request.subscriberstatus == 1">
                                                <a :subscriberId="request.subscriberid" change_status = "0" class="chg_status"><i class='icon-primitive-dot txt_red'></i> Inacive</a>
                                            </li>

                                            <li v-else>
                                                <a  :subscriberId="request.subscriberid" change_status = "1" class="chg_status"><i class='icon-primitive-dot txt_green'></i> Active</a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="/assets/images/more.svg"></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li v-if="request.subscriberstatus == 1">
                                                    <a :subscriberId="request.subscriberid" change_status = "0" class="chg_status"><i class='icon-file-locked'></i> Inacive</a>
                                                </li>
                                                <li v-else>
                                                    <a  :subscriberId="request.subscriberid" change_status = "1" class="chg_status"><i class='icon-file-locked'></i> Active</a>
                                                </li>


                                                <li><a class="deleteSubscriber" href="javascript:void(0);" :subscriberId="request.subscriberid" :recordId="request.trackinglogid"><i class="icon-trash"></i> Delete</a></li>

                                            </ul>
                                        </li>
                                    </ul>
                                </td>

                            </tr>
                            </tbody>
                        </table>

                        <table v-else class="table datatable-basic">
                            <thead>
                            <tr>
                                <th><i class="icon-stack-star"></i>Name</th>
                                <th><i class="icon-atom"></i>Campaign</th>
                                <th><i class="icon-hash"></i>Source</th>
                                <th><i class="icon-user"></i>Contact Details</th>
                                <th><i class="icon-calendar"></i>Created</th>
                                <th><i class="icon-calendar"></i>Request Sent Date</th>
                                <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>

                            </tr>
                            </thead>

                            <tbody>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td colspan="10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin: 20px 0px 0;" class="text-center">
                                            <h5 class="mb-20 mt40">
                                                Looks Like You Don’t Have Any Review Request Yet <img src="/assets/images/smiley.png"> <br>
                                                Lets Create Your First Review Request.
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!--<div align="right" id="pagination_link"></div>-->
                <!-- /marketing campaigns -->
            </div>
        </div>
    </div>



</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['title', 'review_type'],
        components: {UserAvatar},
        data(){
            return {
                count : 0,
                requests : {},

            }
        },
        mounted() {
            axios.get('/admin/brandboost/review_request/offsite')
                .then(response => {
                    this.requests = response.data.oFilteredRequests;
                    this.count = response.data.totalCount;
                    let tableId = 'reviewRequestOffsite';
                    this.paginate(tableId);
                });

        },

    }
</script>

<style>
    .createSegment{
        cursor:pointer!important;
    }
</style>
