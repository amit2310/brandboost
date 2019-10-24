<template>
    <div class="container-fluid">

        <div class="table_head_action">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="htxt_medium_16 dark_400">Contact Lists</h3>
                </div>
                <div class="col-md-6">
                    <div class="table_action">
                        <div class="float-right">
                            <button type="button" class="dropdown-toggle table_action_dropdown"
                                    data-toggle="dropdown">
                                <span><img src="/assets/images/date_created.svg"/></span>&nbsp; Date Created
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
                                <span><img src="/assets/images/list_view.svg"/></span>&nbsp; List View
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Link 1</a>
                                <a class="dropdown-item" href="#">Link 2</a>
                                <a class="dropdown-item" href="#">Link 3</a>
                            </div>
                        </div>
                        <div class="float-right">
                            <input class="table_search" type="text" placeholder="Search"/>
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

                        <tr>
                            <td colspan="1"><span class="fsize12 fw300">Visitor name </span></td>
                            <td colspan="3"><span class="fsize12 fw300">Preview data</span></td>
                            <td colspan="3"><span class="fsize12 fw300">List fields</span></td>
                        </tr>

                        <!--<tr>
                            <td><span class="table-img mr15"><img src="/assets/images/table_user.png"/></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
                            <td class="text-right">nina.hernandez@example.com</td>
                            <td># lead, subscriber <span style="margin-left:15px;" class="badge badge-dark">+4</span></td>
                            <td>Customer</td>
                            <td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
                            <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                            </td>
                        </tr>-->
                        <tr v-for="contact in activeUsers" v-if="activeUsers.length>0">
                            <td>
                                <user-avatar
                                    :avatar="contact.avatar"
                                    :firstname="contact.firstname"
                                    :lastname="contact.lastname"
                                    :width="32"
                                    :height="32"
                                    :fontsize="12"
                                ></user-avatar>
                                <span class="htxt_medium_14 dark_900">{{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }}</span>
                             </td>

                            <td class="text-right">{{ contact.email }}</td>
                            <td>
                                <contact-tags :subscriber_id="contact.subscriber_id"></contact-tags>
                            </td>
                            <!--<td><span class="badge badge-dark">+4</span></td>-->
                            <td>Customer</td>
                            <td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
                            <td class="text-right">
                                <span class="icons">
                                    <img src="/assets/images/message-2-line.svg"/>
                                </span>
                                <span class="icons">
                                    <a :href="`mailto:${contact.email}`"><img src="/assets/images/mail-open-line-16.svg"/></a>
                                </span>
                                <span class="icons">
                                    <img src="assets/images/message-3-line-16.svg"/>
                                </span>
                                <span class="icons">
                                    <img src="assets/images/star-line.svg"/>
                                </span>
                            </td>
                        </tr>




                        </tbody>
                    </table>
                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4">
                    </pagination>

                </div>
            </div>
        </div>
    </div>
    <!--<div class="tab-content">
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-lg-12">
                    &lt;!&ndash; Marketing campaigns &ndash;&gt;
                    <div class="panel panel-flat">
                        &lt;!&ndash;@include('admin.components.smart-popup.smart-contact-widget')&ndash;&gt;
                        <div class="panel-heading">
                            <span class="pull-left">
                                <h6 class="panel-title">{{ activeCount }} Contacts</h6>
                            </span>
                            <div class="heading_links pull-left">
                                <button type="button" class="btn btn-xs btn_white_table ml20">All</button>
                                <a class="top_links txt_blue" href="#">Customers USA</a>
                                <a class="top_links" href="#">Added reviews</a>
                                <a class="top_links" href="#">Age 25-40</a>
                                <a class="top_links" href="#">Negative review</a>
                            </div>

                            <div class="heading-elements">

                                <div style="display: inline-block; margin: 0;"
                                     class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableID="mySubsContact"
                                           placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class=""><img src="/assets/images/icon_search.png" width="14"></i>
                                    </div>
                                </div>
                                <div class="table_action_tool">
                                    <a href="javascript:void(0);"><i class=""><img
                                        src="/assets/images/icon_calender.png"/></i></a>
                                    <a href="javascript:void(0);" class="editDataList"><i class=""><img
                                        src="/assets/images/icon_edit.png"/></i></a>
                                    <a href="javascript:void(0);" id="deleteBulkModuleContacts"
                                       class="custom_action_box"
                                       style="display:none;" :data-modulename="moduleName"
                                       :data-moduleaccountid="moduleUnitID"><i
                                        class="icon-trash position-left"></i></a>
                                    <button id="archiveBulkModuleContacts" class="btn btn-xs custom_action_box"
                                            :data-modulename="moduleName"
                                            :data-moduleaccountid="moduleUnitID"><i
                                        class="icon-gear position-left"></i> Archive
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body p0">
                            <table class="table" id="mySubsContact">
                                <thead>

                                <tr>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
                                    <th style="display: none;width:30px;" class="nosort editAction"><label
                                        class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]"
                                                                                 class="control-primary"
                                                                                 id="checkAll"><span
                                        class="custmo_checkmark"></span></label></th>

                                    <th><i class=""><img src="/assets/images/icon_name.png"></i>Name</th>
                                    <th><i class=""><img src="/assets/images/icon_device.png"></i>Phone
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_clock.png"></i>Created
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_source.png"></i>Source
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_social.png"></i>Social
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_id.png"></i>Tags</th>
                                    <th><i class=""><img src="/assets/images/icon_status.png"></i>Status
                                    </th>
                                    <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="contact in activeUsers" v-if="activeUsers.length>0" :id="`append-${contact.subscriber_id}`" class="selectedClass">
                                    <td style="display: none;">{{contact.created}}</td>
                                    <td style="display: none;">{{contact.subscriber_id}}</td>
                                    <td style="display: none;" class="editAction">
                                        <label class="custmo_checkbox pull-left">
                                        <input type="checkbox" name="checkRows[]" class="checkRows" value="contact.subscriber_id">
                                        <span class="custmo_checkmark"></span>
                                        </label>
                                    </td>


                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left media-middle">
                                            <user-avatar
                                                :avatar="contact.avatar"
                                                :firstname="contact.firstname"
                                                :lastname="contact.lastname"
                                            ></user-avatar>
                                        </div>
                                        <div class="media-left">
                                            <div class="pt-5">
                                                <a href="javascript:void(0);" class="text-default text-semibold bbot">
                                                    {{ contact.firstname }} {{ contact.lastname }}</a>
                                                <img class="flags"
                                                     src="`/assets/images/flags/${(contact.country_code).toLowerCase()}.png`"
                                                     onerror="this.src='/assets/images/flags/us.png'"/>
                                            </div>
                                            <div class="text-muted text-size-small">{{ contact.email }}</div>
                                        </div>
                                    </td>

                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left">
                                            <div class="pt-5">
                                                <span class="text-default text-semibold dark" v-if="contact.phone">
                                                    {{mobileNoFormat(contact.phone)}}
                                                </span>
                                                <span style="color:#999999" v-else>Phone Unavailable</span>
                                            </div>

                                            <div class="text-muted text-size-small" v-show="contact.phone">Chat</div>
                                        </div>
                                    </td>
                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left">
                                            <div class="pt-5"><span
                                                class="text-default text-semibold dark">{{ contact.created }}</span>
                                            </div>
                                            <div
                                                class="text-muted text-size-small">{{ contact.created }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left text-right">
                                            <div class="pt-5"><span class="text-default text-semibold dark">Email</span>
                                            </div>
                                            <div class="text-muted text-size-small">Form #183</div>
                                        </div>
                                        <div class="media-left media-middle brig pr10"><span class="icons s28"><img
                                            src="/assets/images/icon_round_email.png"
                                            class="img-circle img-xs" alt=""></span></div>
                                    </td>
                                    <td>
                                        <a class="icons social"
                                           :href="contact.twitter_profile"
                                           target="_blank" title="View twitter profile"
                                           v-if="contact.twitter_profile"
                                        >
                                            <img src="/assets/images/icons/twitter.svg"/>
                                        </a>
                                        <a class="icons social"
                                           href="javascript:void(0);"
                                           title="This profile not found"
                                           v-else
                                        >
                                            <img src="/assets/images/icons/twitter.svg"/></a>

                                        <a class="icons social"
                                            href="contact.facebook_profile"
                                            target="_blank" title="View facebook profile"
                                            v-if="contact.facebook_profile"
                                        >
                                            <img src="/assets/images/icons/facebook.svg"/>
                                        </a>

                                        <a class="icons social"
                                           href="javascript:void(0);"
                                           title="This profile not found"
                                           v-else
                                        >
                                            <img src="/assets/images/icons/facebook.svg"/>
                                        </a>

                                        <a class="icons social" href="contact.socialProfile">
                                            <img src="/assets/images/icons/google.svg"/>
                                        </a>

                                        <a class="icons social" href="`mailto:${contact.email}`">
                                            <img src="/assets/images/icons/mail.svg"/>
                                        </a>
                                    </td>

                                    <td :id="`tag_container_${contact.subscriber_id}`" :class="`tag_container_${contact.subscriber_id}`">
                                        <contact-tags :subscriber_id="contact.subscriber_id"></contact-tags>
                                    </td>

                                    <td>
                                        <div class="tdropdown">
                                            <i class="icon-primitive-dot txt_green fsize16" v-if="(contact.status == 1 && contact.globalStatus == 1)"></i>
                                            <i class="icon-primitive-dot txt_red fsize16" v-else></i>

                                            <a class="text-default text-semibold bbot dropdown-toggle"
                                               data-toggle="dropdown">{{ (contact.status == 1 && contact.globalStatus == 1) ? ' Active' : ' Inactive' }}</a>
                                            <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                <li v-if="(contact.status == 1 && contact.globalStatus == 1)">
                                                    <a class='changeModuleContactStatus'
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       data_status='0'
                                                       csrf_token="csrf_token()"><i
                                                    class="icon-primitive-dot txt_grey"></i> Inactive
                                                    </a>
                                                </li>

                                                <li v-else>
                                                    <a class="{(contact.globalStatus == 1) ? 'changeModuleContactStatus' : 'changeModuleContactStatusDisabled'}"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       data_status='1'
                                                       csrf_token="csrf_token()"><i
                                                        class="icon-primitive-dot txt_green"></i> Active</a></li>

                                                <li><a class="moveToArchiveModuleContact" href="javascript:void(0);"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       csrf_token="csrf_token()"><i
                                                    class="icon-primitive-dot txt_red"></i> Archive</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="tdropdown ml10"><a class="table_more dropdown-toggle"
                                                                       data-toggle="dropdown"><img
                                            src="/assets/images/more.svg"></a>
                                            <ul style="right: 0; width:150px;"
                                                class="dropdown-menu dropdown-menu-right status">
                                                <li v-show="showArchived == true">
                                                    <a class="moveToArchiveModuleContact" href="javascript:void(0);"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       csrf_token="csrf_token()">
                                                        <i class="icon-trash"></i> Move To Archive
                                                    </a>
                                                </li>


                                                <li v-if="(contact.status == 1 && contact.globalStatus == 1)">
                                                    <a class='changeModuleContactStatus'
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID" data_status='0'
                                                       csrf_token="csrf_token()"><i class='icon-file-locked'></i>
                                                    Inactive</a>
                                                </li>

                                                <li v-else>
                                                    <a class="{(contact.globalStatus == 1) ? 'changeModuleContactStatus' : 'changeModuleContactStatusDisabled'}"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID" data_status='1'
                                                       csrf_token="csrf_token()"><i class='icon-file-locked'></i>
                                                        Active</a></li>

                                                <li>
                                                    <a href="`/admin/contacts/profile/${contact.subscriber_id}`"><i
                                                        class="icon-eye"></i> View Details</a></li>

                                                <li v-show="showArchived == true">
                                                    <a href="javascript:void(0);" class="editModuleSubscriber"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       data-redirect="admin/lists/getListContacts?list_id="><i
                                                    class="icon-pencil"></i> Edit</a></li>

                                                <li><a class="deleteModuleSubscriber"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       csrf_token="csrf_token()" href="javascript:void(0);"><i
                                                    class="icon-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-else>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td colspan="10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="margin: 20px 0px 0;" class="text-center">
                                                    <h5 class="mb-20 mt40">
                                                        Looks Like You Don’t Have Any Contact Yet <img
                                                        src="/assets/images/smiley.png"> <br>
                                                        Lets Create Your First Contact.
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
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-show="showArchived == true" class="tab-pane" id="right-icon-tab1">
            <div class="row">
                <div class="col-lg-12">
                    &lt;!&ndash; Marketing campaigns &ndash;&gt;
                    <div class="panel panel-flat">
                        &lt;!&ndash;@include('admin.components.smart-popup.smart-contact-widget')&ndash;&gt;
                        <div class="panel-heading">
                            <span class="pull-left">
                                <h6 class="panel-title">{{ archiveCount }} Contacts</h6>
                            </span>
                            <div class="heading_links pull-left">
                                <button type="button" class="btn btn-xs btn_white_table ml20">All</button>
                                <a class="top_links txt_blue" href="#">Customers USA</a>
                                <a class="top_links" href="#">Added reviews</a>
                                <a class="top_links" href="#">Age 25-40</a>
                                <a class="top_links" href="#">Negative review</a>
                            </div>

                            <div class="heading-elements">

                                <div style="display: inline-block; margin: 0;"
                                     class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableID="mySubsContact"
                                           placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class=""><img src="/assets/images/icon_search.png" width="14"></i>
                                    </div>
                                </div>
                                <div class="table_action_tool">
                                    <a href="javascript:void(0);"><i class=""><img
                                        src="/assets/images/icon_calender.png"/></i></a>
                                    <a href="javascript:void(0);" class="editArchiveDataList"><i class=""><img
                                        src="/assets/images/icon_edit.png"/></i></a>
                                    <a href="javascript:void(0);" id="deleteBulkArchiveModuleContacts"
                                       class="custom_action_box"
                                       style="display:none;" :data-modulename="moduleName"
                                       :data-moduleaccountid="moduleUnitID"><i
                                        class="icon-trash position-left"></i></a>
                                    <button id="activeBulkModuleContacts" class="btn btn-xs custom_action_box"
                                            :data-modulename="moduleName"
                                            :data-moduleaccountid="moduleUnitID"><i
                                        class="icon-gear position-left"></i> Archive
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body p0">
                            <table class="table" id="mySubsContact2">
                                <thead>

                                <tr>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
                                    <th style="display: none;width:30px;" class="nosort editArchiveAction"><label
                                        class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                 name="checkArchiveAll[]"
                                                                                 class="control-primary"
                                                                                 id="checkArchiveAll"><span
                                        class="custmo_checkmark"></span></label></th>

                                    <th><i class=""><img src="/assets/images/icon_name.png"></i>Name</th>
                                    <th><i class=""><img src="/assets/images/icon_device.png"></i>Phone
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_clock.png"></i>Created
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_source.png"></i>Source
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_social.png"></i>Social
                                    </th>
                                    <th><i class=""><img src="/assets/images/icon_id.png"></i>Tags</th>
                                    <th><i class=""><img src="/assets/images/icon_status.png"></i>Status
                                    </th>
                                    <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="contact in archiveUsers" v-if="archiveUsers.length>0"  :id="`append-${contact.subscriber_id}`" class="selectedClass">
                                    <td style="display: none;">{{contact.created}}</td>
                                    <td style="display: none;">{{contact.subscriber_id}}</td>
                                    <td style="display: none;" class="editArchiveAction">
                                        <label class="custmo_checkbox pull-left">
                                            <input type="checkbox" name="checkRows[]" class="checkArchiveRows" value="contact.id">
                                            <span class="custmo_checkmark"></span>
                                        </label>
                                    </td>


                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left media-middle">
                                            <user-avatar
                                                :avatar="contact.avatar"
                                                :firstname="contact.firstname"
                                                :lastname="contact.lastname"
                                            ></user-avatar>
                                        </div>
                                        <div class="media-left">
                                            <div class="pt-5">
                                                <a href="javascript:void(0);" class="text-default text-semibold bbot">
                                                    {{ contact.firstname }} {{ contact.lastname }}</a>
                                                <img class="flags"
                                                     src="`/assets/images/flags/${(contact.country_code).toLowerCase()}.png`"
                                                     onerror="this.src='/assets/images/flags/us.png'"/>
                                            </div>
                                            <div class="text-muted text-size-small">{{ contact.email }}</div>
                                        </div>
                                    </td>

                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left">
                                            <div class="pt-5">
                                                <span class="text-default text-semibold dark" v-if="contact.phone">
                                                    {{mobileNoFormat(contact.phone)}}
                                                </span>
                                                <span style="color:#999999" v-else>Phone Unavailable</span>
                                            </div>

                                            <div class="text-muted text-size-small" v-show="contact.phone">Chat</div>
                                        </div>
                                    </td>
                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left">
                                            <div class="pt-5"><span
                                                class="text-default text-semibold dark">{{ contact.created }}</span>
                                            </div>
                                            <div
                                                class="text-muted text-size-small">{{ contact.created }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="viewContactSmartPopup" :data-modulesubscriberid="contact.id"
                                        :data-modulename="moduleName">
                                        <div class="media-left text-right">
                                            <div class="pt-5"><span class="text-default text-semibold dark">Email</span>
                                            </div>
                                            <div class="text-muted text-size-small">Form #183</div>
                                        </div>
                                        <div class="media-left media-middle brig pr10"><span class="icons s28"><img
                                            src="/assets/images/icon_round_email.png"
                                            class="img-circle img-xs" alt=""></span></div>
                                    </td>
                                    <td>
                                        <a class="icons social"
                                           :href="contact.twitter_profile"
                                           target="_blank" title="View twitter profile"
                                           v-if="contact.twitter_profile"
                                        >
                                            <img src="/assets/images/icons/twitter.svg"/>
                                        </a>
                                        <a class="icons social"
                                           href="javascript:void(0);"
                                           title="This profile not found"
                                           v-else
                                        >
                                            <img src="/assets/images/icons/twitter.svg"/></a>

                                        <a class="icons social"
                                           href="contact.facebook_profile"
                                           target="_blank" title="View facebook profile"
                                           v-if="contact.facebook_profile"
                                        >
                                            <img src="/assets/images/icons/facebook.svg"/>
                                        </a>

                                        <a class="icons social"
                                           href="javascript:void(0);"
                                           title="This profile not found"
                                           v-else
                                        >
                                            <img src="/assets/images/icons/facebook.svg"/>
                                        </a>

                                        <a class="icons social" href="contact.socialProfile">
                                            <img src="/assets/images/icons/google.svg"/>
                                        </a>

                                        <a class="icons social" href="`mailto:${contact.email}`">
                                            <img src="/assets/images/icons/mail.svg"/>
                                        </a>
                                    </td>

                                    <td :id="`tag_container_${contact.subscriber_id}`" :class="`tag_container_${contact.subscriber_id}`">
                                        <contact-tags :subscriber_id="contact.subscriber_id"></contact-tags>
                                    </td>

                                    <td>
                                        <div class="tdropdown">
                                            <i class="icon-primitive-dot txt_green fsize16"
                                               v-if="(contact.status == 1 && contact.globalStatus == 1)"></i>
                                            <i class="icon-primitive-dot txt_red fsize16" v-else></i>

                                            <a class="text-default text-semibold bbot dropdown-toggle"
                                               data-toggle="dropdown">{{ (contact.status == 1 &&
                                                contact.globalStatus == 1) ? ' Active' : ' Inactive' }}</a>
                                            <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                <li v-if="(contact.status == 1 && contact.globalStatus == 1)">
                                                    <a class='changeModuleContactStatus'
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       data_status='0'
                                                       csrf_token="csrf_token()"><i
                                                        class="icon-primitive-dot txt_grey"></i> Inactive
                                                    </a>
                                                </li>

                                                <li v-else>
                                                    <a class="{(contact.globalStatus == 1) ? 'changeModuleContactStatus' : 'changeModuleContactStatusDisabled'}"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       data_status='1'
                                                       csrf_token="csrf_token()"><i
                                                        class="icon-primitive-dot txt_green"></i> Active</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="tdropdown ml10"><a class="table_more dropdown-toggle"
                                                                       data-toggle="dropdown"><img
                                            src="/assets/images/more.svg"></a>
                                            <ul style="right: 0; width:150px;"
                                                class="dropdown-menu dropdown-menu-right status">
                                                <li v-show="showArchived == true">
                                                    <a class="moveToArchiveModuleContact" href="javascript:void(0);"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       csrf_token="csrf_token()">
                                                        <i class="icon-trash"></i> Move To Archive
                                                    </a>
                                                </li>


                                                <li v-if="(contact.status == 1 && contact.globalStatus == 1)">
                                                    <a class='changeModuleContactStatus'
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID" data_status='0'
                                                       csrf_token="csrf_token()"><i class='icon-file-locked'></i>
                                                        Inactive</a>
                                                </li>

                                                <li v-else>
                                                    <a class="{(contact.globalStatus == 1) ? 'changeModuleContactStatus' : 'changeModuleContactStatusDisabled'}"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID" data_status='1'
                                                       csrf_token="csrf_token()"><i class='icon-file-locked'></i>
                                                        Active</a></li>

                                                <li>
                                                    <a href="`/admin/contacts/profile/${contact.subscriber_id}`"><i
                                                        class="icon-eye"></i> View Details</a></li>

                                                <li v-show="showArchived == true">
                                                    <a href="javascript:void(0);" class="editModuleSubscriber"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       data-redirect="admin/lists/getListContacts?list_id="><i
                                                        class="icon-pencil"></i> Edit</a></li>

                                                <li><a class="deleteModuleSubscriber"
                                                       :data-modulesubscriberid="contact.id"
                                                       :data-modulename="moduleName"
                                                       :data-moduleaccountid="moduleUnitID"
                                                       csrf_token="csrf_token()" href="javascript:void(0);"><i
                                                    class="icon-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-else>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td colspan="10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="margin: 20px 0px 0;" class="text-center">
                                                    <h5 class="mb-20 mt40">
                                                        Looks Like You Don’t Have Any Contact Yet <img
                                                        src="/assets/images/smiley.png"> <br>
                                                        Lets Create Your First Contact.
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
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>-->

</template>

<script>

    import UserAvatar from '../../helpers/UserAvatar';
    import Pagination from '../../helpers/Pagination';
    import ContactTags from '../contact/ContactTags';

    export default {
        props: ['showArchived', 'subscribersData', 'allData', 'activeCount', 'archiveCount', 'moduleName', 'moduleUnitID'],
        components: {UserAvatar, ContactTags, Pagination},
        data() {
            return {
                current_page: 1
                //alert(subscribersData)
            }
        },

        computed: {

            activeUsers : function(){
                //alert('size of dataset '+ this.subscribersData.length);
                if(this.subscribersData.length>0){
                    return this.subscribersData.filter(function(u){
                        return u.status != 2;
                    })
                }
                //return this.subscribersData;
                //alert(this.activeCount);
                /*return this.subscribersData.filter(function(u){
                    return u.active != 2;
                })*/
            },
            archiveUsers: function(){
                if(this.subscribersData.length>0){
                    return this.subscribersData.filter(function(u){
                        return u.status == 2;
                    })
                }
            }
        },
        watch: {
            subscribersData: [{
                handler: 'setOptimizer'
            }]
        },

        methods: {
            setOptimizer(){

                //alert(this.activeCount);
            },
            showPaginationData: function(current_page){
                /*alert('current Page is '+ t);*/
                this.$emit('navPage', current_page);
            }
        },

        mounted() {

            let tableId = 'mySubsContact';
            this.paginate(tableId);

            let tableId2 = 'mySubsContact2';
            this.paginate(tableId2);

        }

    }
</script>


