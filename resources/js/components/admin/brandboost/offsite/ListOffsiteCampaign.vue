<template>

    <div class="content">
        <!-- Dashboard content -->


        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-5">
                    <h3><img src="/assets/images/offsite_icon_19.png" style="width: 16px;"> &nbsp; Off Site Review  Campaigns</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active all"><a style="javascript:void();" id="activeCampaign"
                                                  class="filterByColumn" fil="1|0|2">Active Campaigns</a></li>
                        <li><a style="javascript:void();" class="filterByColumn" fil="3">Archive</a></li>
                    </ul>
                </div>



                <!--=============Button Area Right Side==============-->
                <div class="col-md-7 text-right btn_area">
                    <div class="btn-group">
                        <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter campaign&nbsp; &nbsp; <span
                            class="caret"></span>
                        </button>
                        <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                            <div class="dropdown-content-heading"> Filter
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-more"></i></a></li>
                                </ul>
                            </div>
                            <div class="">
                                <div
                                    class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign"
                                    id="accordion-control-right">
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings active">
                                            <h6 class="panel-title"><a data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group1"><i
                                                class="icon-star-empty3"></i>&nbsp;Campaign Type</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Most startups fail. But many of those failures are preventable.
                                                        The Lean Startup is a new approach being adopted across the
                                                        globe, changing the way companies are built and new products are
                                                        launched.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group2"><i
                                                class="icon-arrow-up-left2"></i>&nbsp; Source</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Content Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group73"><i
                                                class="icon-star-full2"></i>&nbsp; Rating</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Content Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group74"><i
                                                class="icon-calendar"></i>&nbsp; Date Created</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Content Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group83"><i
                                                class="icon-thumbs-up2"></i>&nbsp; Reviews</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Total Reviews
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20"/> <span class="dash">-</span> <input
                                                        class="form-control input-sm" type="text" name=""
                                                        value="100"/>
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20"/> <span class="dash">-</span> <input
                                                        class="form-control input-sm" type="text" name=""
                                                        value="100"/>
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20" disabled/> <span class="dash">-</span> <input
                                                        class="form-control input-sm" type="text" name=""
                                                        value="100" disabled/>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="0"/> <span class="dash">-</span> <input
                                                        class="form-control input-sm" type="text" name=""
                                                        value="10"/>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-content-footer">
                                <button type="button" class="btn dark_btn dropdown-toggle"
                                        style="display: inline-block;"><i
                                    class="icon-filter4"></i><span> &nbsp;  Filter</span></button>
                                &nbsp; &nbsp;
                                <a style="display: inline-block;" href="#">Clear All</a>
                            </div>
                        </div>
                    </div>
                    &nbsp; &nbsp; &nbsp;
                    <button v-if="user_role != 1 && canWrite == true && bActiveSubsription == false" type="button"  title="No Active Subscription"
                            class="btn dark_btn pDisplayNoActiveSubscription" data-toggle="modal"><i class="icon-plus3"></i><span> &nbsp;  Add Off Site Review Campaign</span>
                    </button>

                    <button v-if="user_role != 1 && canWrite == true && bActiveSubsription == true" type="button" id="addBrandboost"
                            class="btn dark_btn addBrandboost" data-toggle="modal"><i class="icon-plus3"></i><span> &nbsp;  Add Off Site Review Campaign</span>
                    </button>


                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="tab-content" v-if="oBrandboosts">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <span class="pull-left">
                                    <h6 class="panel-title">{{ iActiveCount }} Off Site Review Campaigns</h6>
                                </span>
                                <div class="heading_links pull-left">
                                    <a class="top_links btn btn-xs btn_white_table ml20 top_links_all">All</a>
                                    <a class="top_links top_links_Status" getValue="1" style="cursor: pointer;">Active</a>
                                    <a class="top_links top_links_Status" getValue="0" style="cursor: pointer;">Inactive</a>
                                    <a class="top_links top_links_positive" getValue="positive"
                                       style="cursor: pointer;">Positive</a>
                                    <a class="top_links top_links_neutral" getValue="neutral"
                                       style="cursor: pointer;">Neutral</a>
                                    <a class="top_links top_links_negative" getValue="negative"
                                       style="cursor: pointer;">Negative</a>
                                    <a class="top_links top_links_added_today" getValue="today"
                                       style="cursor: pointer;">Added Today</a>
                                </div>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search"
                                               tableID="offsiteBrandboostCampaign" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0);" class="editDataList"><i
                                            class="icon-pencil"></i></a>
                                        <a href="javascript:void(0);" style="display: none;"
                                           id="deleteMultipleOffsiteBB" class="custom_action_box"><i
                                            class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;"
                                           id="archiveMultipleOffsiteBB" class="custom_action_box"><i
                                            class="icon-gear position-left"></i></a>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-body p0">
                                <campaign-list
                                :oBrandboosts="oBrandboosts"
                                :bActiveSubsription="bActiveSubsription"
                                :currentUserId="currentUserId"
                                :iActiveCount="iActiveCount"
                                :iArchiveCount="iArchiveCount"
                                :user_role="user_role"
                                :canRead="canRead"
                                :canWrite="canWrite"
                                ></campaign-list>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--===========TAB 3===========-->

        <div class="tab-content" v-else>
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Off Site Review Campaigns</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback"><i class="icon-search4"></i></div>
                                    </div>
                                       
                                    <button type="button" class="btn btn-xs btn-default editDataList"><i
                                        class="icon-pencil position-left"></i> Edit
                                    </button>
                                    <button id="deleteMultipleOffsiteBB" class="btn btn-xs custom_action_box"><i
                                        class="icon-trash position-left"></i> Delete
                                    </button>
                                    <button id="archiveMultipleOffsiteBB" class="btn btn-xs custom_action_box"><i
                                        class="icon-gear position-left"></i> Archive
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-stack-star"></i>Name</th>
                                        <th><i class="icon-star-full2"></i>Source</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-graph"></i>Total</th>
                                        <th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
                                        <th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
                                        <th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
                                        <th><i class="icon-alarm-check"></i>Last review</th>
                                        <th><i class="icon-statistics"></i>Statistic</th>
                                        <th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i>Status
                                        </th>
                                        <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="13">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div style="margin: 20px 0px 0;" class="text-center">

                                                        <h5 class="mb-20 mt40">
                                                            Looks Like You Don’t Have Any Off Site Review Campaign
                                                            Yet <img
                                                            src="/assets/images/smiley.png">
                                                            <br>
                                                            Lets Create Your First Off Site Review Campaign.
                                                        </h5>
                                                        <template v-if="canWrite">
                                                            <button v-if="bActiveSubsription == false" type="button"
                                                                    title="No Active Subscription"
                                                                    class="btn dark_btn pDisplayNoActiveSubscription mb40"
                                                                    data-toggle="modal"><i
                                                                class="icon-plus3"></i><span> &nbsp; Add Off Site Review Campaign</span>
                                                            </button>

                                                            <button v-else type="button" id="addBrandboost" class="btn dark_btn addBrandboost mb40"
                                                                    data-toggle="modal"><i
                                                                class="icon-plus3"></i><span> &nbsp;  Add Off Site Review Campaign</span>
                                                            </button>
                                                        </template>



                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import CampaignList from './CampaignList';

    export default {
        props : ['title'],
        components: { UserAvatar, CampaignList },
        /*components: { UserAvatar, OverviewStats },*/
        data() {
            return {
                oBrandboosts: {},
                viewstats : '',
                bActiveSubsription: '',
                currentUserId : '',
                iActiveCount : 0,
                iArchiveCount : 0,
                user_role: '',
                canRead: '',
                canWrite: ''
            }
        },

        mounted() {
             axios.get('/admin/brandboost/offsite')
                .then(response => {
                    this.oBrandboosts = response.data.aBrandbosts;
                    this.viewstats = response.data.viewstats;
                    this.bActiveSubsription = response.data.bActiveSubsription;
                    this.iActiveCount = response.data.iActiveCount;
                    this.iArchiveCount = response.data.iArchiveCount;
                    this.user_role = response.data.user_role;
                    this.canRead = response.data.canRead;
                    this.canWrite = response.data.canWrite;
                    this.currentUserId = response.data.currentUserId;
                    /*let tableId = 'offsiteBrandboostCampaign';
                    this.paginate(tableId);*/

                });
        }

    }

</script>
