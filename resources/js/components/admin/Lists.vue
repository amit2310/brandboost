<template>

    <div class="content" id="masterContainer">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-5">
                    <h3><img src="/assets/images/email_icon_active.png"> Lists</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn"
                                                  fil="active">Active {{ oData.title }}</a></li>
                        <li><a style="javascript:void(0);" class="filterByColumn" fil="archive">Archive</a></li>
                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-7 text-right btn_area">
                    <div class="btn-group">
                        <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Lists &nbsp; &nbsp; <span
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
                                                    <div class="col-md-12"> Conetent Goes here...</div>
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
                                                    <div class="col-md-12"> Conetent Goes here...</div>
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
                                                    <div class="col-md-12"> Conetent Goes here...</div>
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

                    <button v-if="oData.bActiveSubsription == false" type="button"
                            title="No Active Subscription" class="btn dark_btn ml20 pDisplayNoActiveSubscription"
                            data-toggle="modal" data-target="#addPeopleList"><i
                        class="icon-plus3"></i><span> &nbsp;  New List</span>
                    </button>

                    <button v-else type="button"
                            id="addList"
                            class="btn dark_btn ml20" data-toggle="modal" data-target="#addPeopleList"><i
                        class="icon-plus3"></i><span> &nbsp;  New List</span>
                    </button>

                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div v-if="oLists.length > 0" class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ oData.activeList }} Lists</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableid="automationList"
                                               placeholder="Search by name" type="text">
                                        <div class="form-control-feedback"><i class="icon-search4"></i>
                                        </div>
                                    </div>

                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0);" class="editDataList"><i
                                            class="icon-pencil"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="deleteButtonLists"
                                           class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="archiveButtonLists"
                                           class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table" id="automationList">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction"><label
                                            class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                     name="checkAll[]"
                                                                                     class="control-primary"
                                                                                     id="checkAll"><span
                                            class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-user"></i>Name</th>
                                        <th><i class="icon-user"></i>Contacts</th>
                                        <th><i class="icon-calendar"></i>Created</th>

                                        <th v-if="oData.uRole "><i class="icon-user"></i>Created By</th>
                                        <th v-else style="display: none;"></th>

                                        <th><i class="icon-envelop"></i>Email</th>
                                        <th><i class="icon-iphone"></i>SMS</th>
                                        <!-- <th><i class="icon-warning2"></i>Unsubscribed</th> -->
                                        <th><i class="icon-calendar"></i>Last Incoming Lead</th>
                                        <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                        <th class="text-right"><i class="fa fa-dot-circle-o"></i>Action</th>
                                        <th style="display:none;">status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-for="oList in oLists" :id="`append-${oList.id}`" class="selectedClass">
                                        <td style="display: none;">{{ oList.list_created }} </td>
                                        <td style="display: none;">{{ oList.id }}</td>
                                        <td style="display: none;" class="editAction"><label
                                            class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                     name="checkRows[]"
                                                                                     class="checkRows"
                                                                                     :value="`${oList.id}`"><span
                                            class="custmo_checkmark"></span></label></td>
                                        <td width="22%">
                                            <div class="media-left media-middle"><a class="icons square"
                                                                                    :href="`/admin/lists/getListContacts?list_id=${oList.id}`"><i
                                                class="icon-indent-decrease2 txt_blue"></i></a></div>
                                            <div class="media-left">
                                                <div><a :href="`/admin/lists/getListContacts?list_id=${oList.id}`"
                                                        :list_id="`${oList.id}`"
                                                        class="text-default text-semibold">{{ oList.list_name.substring(0,20) }} </a>
                                                </div>
                                                <div
                                                    class="text-muted text-size-small">{{ oList.description.substring(0,25) }} </div>
                                            </div>
                                        </td>

                                        <td>

                                            <div class="media-left">
                                                <div class="">

                                                    <span v-if="oData.totAll > 0" class="txt_grey">
                                                        <a :href="`/admin/lists/getListContacts?list_id=${oList.id}`"
                                                           class="text-default text-semibold">{{ oData.totAll }}</a>
                                                    </span>

                                                    <span v-else class="text-muted text-size-small">[No Data]</span>

                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#"
                                                                     class="text-default text-semibold"> {{ oList.list_created }}</a>
                                                </div>
                                                <div
                                                    class="text-muted text-size-small">{{ oList.list_created }} </div>
                                            </div>

                                        </td>


                                        <td v-if="oData.uRole">
                                            <div class="media-left media-middle"><a class="icons" href="#"><img
                                                src="/images/cust1.png"
                                                class="img-circle img-xs" alt=""></a></div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" :list_id="`${oList.id}`"
                                                                     class="text-default text-semibold editlist"><span>{{ oList.lCreateUsername }}</span>
                                                    <img class="flags"
                                                         src="/assets/images/flags/ao.png"></a>
                                                </div>
                                                <div class="text-muted text-size-small">{{ oList.cEmai }}</div>
                                                <div class="text-muted text-size-small">{{ oList.cMobile }}</div>
                                            </div>
                                        </td>

                                        <td v-else style="display: none;"></td>


                                        <td>
                                            <div class="media-left">
                                                <div
                                                    :class="`progress-circle ${oData.addPC} green cp${oData.totalEmailGraph}`">
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left">
                                                <div data-toggle="tooltip"
                                                     :title="`${oData.totEmailCount} have email address out of ${oData.totalContacts} contacts`"
                                                     data-placement="top">
                                                    <a href="javascript:void(0);"
                                                       class="text-default text-semibold">{{ oData.totEmailCount }}</a>

                                                    <span v-if="oData.newEmails" style="color:#FF0000;"> ( {{ oData.newEmails }} new)</span>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="media-left">
                                                <div :class="`progress-circle ${oData.addPC} grey cp${oData.totalSMSGraph}`">
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left">
                                                <div data-toggle="tooltip"
                                                     :title="`${oData.totSMSCount} have numbers out of ${oData.totalContacts} contacts`"
                                                     data-placement="top">
                                                    <a href="javascript:void(0);"
                                                       class="text-default text-semibold">{{ oData.totSMSCount }}</a>

                                                    <span v-if="oData.newSMS" style="color:#FF0000;"> ( {{ oData.newSMS }} new)</span>
                                                </div>
                                            </div>

                                        </td>

                                        <td>
                                            <span v-html="oData.lastListTime"></span>
                                        </td>

                                        <td class="text-center">

                                            <i v-if="oList.status == 'active'" class="icon-primitive-dot txt_green fsize16"></i>
                                            <i v-else-if="oList.status == 'archive'" class="icon-primitive-dot txt_red fsize16"></i>
                                            <i v-else class="icon-primitive-dot txt_red fsize16"></i>

                                            <a class="text-default text-semibold bbot dropdown-toggle"
                                               data-toggle="dropdown">
                                                <span v-if="oList.status == 'active'">Active</span>
                                                <span v-else-if="oList.status == 'archive'">Archive</span>
                                                <span v-else>Inactive</span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right status">

                                            </ul>
                                        </td>

                                        <td class="text-right">
                                            <div class="media-left pull-right">
                                                <div class="tdropdown ml10"><a class="table_more dropdown-toggle"
                                                                               data-toggle="dropdown"
                                                                               aria-expanded="false">
                                                    <img src="/assets/images/more.svg"></a>

                                                    <ul class="dropdown-menu dropdown-menu-right more_act width-200">
                                                        <a href="#" class="dropdown_close">X</a>
                                                        <li><a href="javascript:void(0);" :list_id="`${oList.id}`"
                                                               target="_blank" class="viewContact"><i
                                                            class="icon-gear"></i> View Contacts</a></li>
                                                        <li><a href="javascript:void(0);" :list_id="`${oList.id}`"
                                                               class="editlist"><i class="icon-file-stats"></i> Edit</a>
                                                        </li>

                                                        <li v-if="oList.status == 'active'"><a href="javascript:void(0);" status="inactive"
                                                               :list_id="`${oList.id}`" class="changeStatus"><i
                                                            class="icon-file-stats"></i> Inactive</a></li>

                                                        <li v-if="oList.status == 'inactive' && oList.status != 'archive'"><a href="javascript:void(0);" status="active"
                                                               :list_id="`${oList.id}`" class="changeStatus"><i
                                                            class="icon-file-stats"></i> Active</a></li>

                                                        <li v-if="oList.status != 'archive'"><a href="javascript:void(0);" status="archive"
                                                               :list_id="`${oList.id}`" class="changeStatus"><i
                                                            class="icon-file-stats"></i> Move to Archive</a>
                                                        </li>

                                                        <li><a href="javascript:void(0);" :list_id="`${oList.id}`"
                                                               class="deletelist"><i class="icon-file-text2"></i> Delete</a>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="media-left pull-right">
                                                <div class="">
                                                    <a href="javascript:void(0);" :list_id="`${oList.id}`"
                                                       class="addModuleContact text-default text-semibold bbotb"
                                                       data-modulename="list"
                                                       :data-moduleaccountid="`${oList.id}`"><span
                                                        class="txt_blue_sky2">Add Contacts</span></a></div>
                                            </div>
                                        </td>

                                        <td style="display:none;">
                                            <span v-if="oList.status == 'archive'">Archive</span>
                                            <span v-else>Active</span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div v-else class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ oData.activeList }} Lists</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback"><i class="icon-search4"></i>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-xs btn-default editDataList"><i
                                        class="icon-pencil position-left"></i> Edit
                                    </button>
                                    <button id="deleteButtonLists"
                                            class="btn btn-xs btn-danger btn-xs lgrey custom_action_box">Delete
                                    </button>
                                    <button id="archiveButtonLists"
                                            class="btn btn-xs btn-danger btn-xs lgrey custom_action_box">Move To
                                        Archive
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-user"></i>Name</th>
                                        <th><i class="icon-calendar"></i>Created</th>

                                        <th v-if="oData.uRole"><i class="icon-user"></i>Created By</th>

                                        <th v-else style="display: none;"></th>

                                        <th><i class="icon-user"></i></th>
                                        <th><i class="icon-envelop"></i>Email</th>
                                        <th><i class="icon-iphone"></i>SMS</th>
                                        <th><i class="icon-warning2"></i>Unsubscribed</th>
                                        <th class="text-right"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div style="margin: 20px 0px 0;" class="text-center">
                                                        <h5 class="mb-20 mt40">
                                                            Looks Like You Don’t Have Created Any Contact List Yet
                                                            <img src="/assets/images/smiley.png">
                                                            <br>
                                                            Lets Create Contact List.
                                                        </h5>

                                                        <button v-if="oData.bActiveSubsription" type="button"
                                                                id="addListN"
                                                                class="btn dark_btn ml20 mb40" data-toggle="modal"
                                                                data-target="#addPeopleList"><i
                                                            class="icon-plus3"></i><span> &nbsp;  New List</span>
                                                        </button>

                                                        <button v-else type="button"
                                                                title="No Active Subscription"
                                                                class="btn dark_btn ml20 mb40 pDisplayNoActiveSubscription" data-toggle="modal"
                                                                data-target="#addPeopleList"><i
                                                            class="icon-plus3"></i><span> &nbsp;  New List</span>
                                                        </button>
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
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="editlistModel" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frmeditlistModel" name="frmeditlistModel">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h5 class="modal-title"><img src="/assets/images/menu_icons/List_Color.svg"/> Edit Contact List
                                &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>


                        </div>
                        <div class="modal-body" style="padding-bottom:0px;">
                            <p>List Name:</p>
                            <input class="form-control h52" id="edit_title" name="title" placeholder="Enter List Name"
                                   type="text" required><br>
                            <div id="editlistValidation" style="color:#FF0000;display:none;"></div>
                        </div>
                        <div class="modal-body" style="padding-top:0px;">
                            <p>List Description:</p>
                            <textarea class="form-control h52" id="edit_description" name="edit_description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="list_id" id="hidlistid" value=""/>
                            <button type="submit" class="btn btn-primary h52">Update</button>
                            <button type="button" class="btn btn-link h52" data-dismiss="modal">Close</button>


                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- add New List -->
        <div id="Createnewlist" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" name="frmaddListModal" id="frmaddListModal" action="javascript:void();">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h5 class="modal-title"><img src="/assets/css/menu_icons/Email_Color.svg"/>
                                Create a new list &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Please Enter Title below:</label>
                                        <input class="form-control" id="title" name="title" placeholder="Enter Title"
                                               type="text" required>

                                    </div>

                                    <div class="form-group mb0">
                                        <label>Please Enter Description:</label>
                                        <input class="form-control h52" type="text" id="listDescription"
                                               name="listDescription" value="" placeholder="Enter list description"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                            <button data-toggle="modal" data-dismiss="modal" type="button"
                                    class="btn btn-link fsize14 txt_blue h52">Cancel
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /add New List -->

    </div>

</template>

<script>
    import UserAvatar from '../helpers/UserAvatar';

    export default {
        title: 'Email Lists - Brand Boost',
        components: {UserAvatar},
        data() {
            return {
                oData: {},
                oLists: {},
                newoLists: {}
            }
        },
        mounted() {
            //getData
            axios.get('/admin/lists/')
                .then(response => {
                    console.log(response.data);

                    this.oData = response.data;
                    this.oLists = response.data.oLists;
                    this.newoLists = response.data.newoLists;
                    //console.log(this.newoLists);
                });
            console.log('Component mounted')
        }
    }


    $(document).ready(function () {

        $('#automationList thead tr').clone(true).appendTo('#automationList thead');

        $('#automationList thead tr:eq(1) th').each(function (i) {

            if (i === 12) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {

                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }


        });


        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();

        });

        var tableId = 'automationList';
        var tableBase = custom_data_table(tableId);
        $('#activeCampaign').trigger('click');


    });

    $(document).ready(function () {

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $(document).on('click', '.editDataListArchive', function () {
            $('.editActionArchive').toggle();
        });

        $(document).on('change', '#checkAllArchive', function () {
            if (false == $(this).prop("checked")) {
                $(".checkRowsArchive").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box_archive').hide();
            } else {
                $(".checkRowsArchive").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box_archive').show();
            }
        });

        $(document).on('change', '#checkAll', function () {
            if (false == $(this).prop("checked")) {
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
            } else {
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
            }
        });

        $(document).on('click', '.checkRows', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
            }

            if (totalCheckboxes == numberOfChecked) {
                $('#checkAll').prop('checked', true);
            }
        });

        $(document).on('click', '.checkRowsArchive', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRowsArchive:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box_archive').hide();
            } else {
                $('.custom_action_box_archive').show();
            }

            var numberOfChecked = $('.checkRowsArchive:checkbox:checked').length;
            var totalCheckboxes = $('.checkRowsArchive:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAllArchive').prop('checked', false);
            }

            if (totalCheckboxes == numberOfChecked) {
                $('#checkAllArchive').prop('checked', true);
            }
        });

        $(document).on('click', '#deleteButtonLists', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });

            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                var elem = $(this);
                swal({
                        title: "Are you sure? You want to delete this record!",
                        text: "You will not be able to recover this record!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.overlaynew').show();
                            $.ajax({
                                url: "/admin/lists/deleteMultipalLists",
                                type: "POST",
                                data: {_token: '{{csrf_token()}}', multi_list_id: val},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    }
                                }
                            });
                        }
                    });
            }
        });

        $(document).on('click', '#deleteButtonListsArchive', function () {
            var val = [];
            $('.checkRowsArchive:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });

            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                var elem = $(this);
                swal({
                        title: "Are you sure? You want to delete this record!",
                        text: "You will not be able to recover this record!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.overlaynew').show();
                            $.ajax({
                                url: "/admin/lists/deleteMultipalLists",
                                type: "POST",
                                data: {_token: '{{csrf_token()}}', multi_list_id: val},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    }
                                }
                            });
                        }
                    });
            }
        });

        $(document).on('click', '#archiveButtonLists', function () {
            var val = [];

            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });

            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                var elem = $(this);
                swal({
                        title: "Are you sure? You want to move to archive this record!",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "Yes, move to archive it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.overlaynew').show();
                            $.ajax({
                                url: "/admin/lists/archiveMultipalLists",
                                type: "POST",
                                data: {_token: '{{csrf_token()}}', multi_list_id: val},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    }
                                }
                            });
                        }
                    });
            }
        });


        $('#addList').click(function () {
            $('#Createnewlist').modal();
        });

        $(document).on('click', '#addListN', function () {
            $('#addList').trigger('click');
        });

        $(document).on('click', '.viewContact', function () {

            var list_id = $(this).attr('list_id');
            window.location.href = '/admin/lists/getListContacts?list_id=' + list_id;
        });

        $('#frmaddListModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddListModal").serialize();
            var tkn = $('meta[name="_token"]').attr('content');
            $.ajax({
                url: "admin/lists/addList",
                type: "POST",
                data: formdata + '&_token=' + tkn,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $('#Createnewlist').modal('hide');
                        //alertMessageAndRedirect(data.msg, window.location.href);
                        window.location.href = '{{ $editListPath }}' + data.list_id;

                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addListValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addListValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on("click", ".editlist", function () {
            var listID = $(this).attr('list_id');
            $.ajax({
                url: "admin/lists/getList",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'list_id': listID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_title").val(data.title);
                        $("#edit_description").val(data.description);
                        $("#hidlistid").val(listID);
                        $("#editlistModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on("click", ".changeStatus", function () {
            var listID = $(this).attr('list_id');
            var status = $(this).attr('status');
            $(".overlaynew").show();
            $.ajax({
                url: "/admin/lists/changeListStatus",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'list_id': listID, status: status},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $(".overlaynew").hide();
                        displayMessagePopup('success', '', data.msg);
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $('#frmeditlistModel').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmeditlistModel").serialize();
            var listID = $("#hidlistid").val();
            $.ajax({
                url: "/admin/lists/updateList",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#editlistModel").modal('hide');
                        //alertMessageAndRedirect(data.msg, window.location.href);
                        //displayMessagePopup('success', '', data.msg);
                        window.location.href = '{{ $editListPath }}' + listID;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editlistValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editlistValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.deletelist', function () {
            var elem = $(this);

            deleteConfirmationPopup(
                "This record will deleted immediately.<br>You can't undo this action.",
                function () {
                    $('.overlaynew').show();
                    var listID = $(elem).attr('list_id');
                    $.ajax({
                        url: "/admin/lists/deleteLists",
                        type: "POST",
                        data: {_token: '{{ csrf_token() }}', list_id: listID},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                $('.overlaynew').hide();
                                //alertMessageAndRedirect(data.msg, window.location.href);
                                window.location.href = window.location.href;
                            }
                        }
                    });
                });

        });
    });


    $('.daterange-ranges').daterangepicker(
        {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2016',
            dateLimit: {days: 60},
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            applyClass: 'btn-small bg-slate-600 btn-block',
            cancelClass: 'btn-small btn-default btn-block',
            format: 'MM/DD/YYYY'
        },
        function (start, end) {
            $('.daterange-ranges span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
        }
    );

    $('.daterange-ranges span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));


</script>
