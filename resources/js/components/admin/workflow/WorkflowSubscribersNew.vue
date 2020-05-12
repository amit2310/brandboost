<template>
    <div class="container-fluid">
        <div class="table_head_action" v-if="(showHeader !== false || (activeUsers.length > 0 || searchBy.length>0))">
            <h3 class="htxt_medium_16 dark_400" style="display: none;">{{ allData.total }} Contact Lists</h3>
            <div class="row">
                <div class="col-md-6">
                    <ul class="table_filter">
                        <li><a class="active" href="#">ALL</a></li>
                        <li><a href="#">ACTIVE</a></li>
                        <li><a href="#">DRAFT</a></li>
                        <li><a href="#">ARCHIVE</a></li>
                        <li><a href="#"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="table_filter text-right">
                        <li><a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg" title="Search"></i></a></li>
                        <li v-show="deletedItems.length>0 && sortBy !='archive'"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg" title="List View"></i></a></li>
                        <li><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg" title="Grid View"></i></a></li>
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
        <div class="row">
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
                            <td><span class="fsize10 fw500">Email</span></td>
                            <td><span class="fsize10 fw500">Phone</span></td>
                            <td><span class="fsize10 fw500">Tags  </span></td>
                            <td><span class="fsize10 fw500">Update <img src="assets/images/arrow-down-line-14.svg"></span></td>
                            <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>
                        </tr>
                        <tr v-for="contact in activeUsers" v-if="activeUsers">
                            <td width="20">
                                <span>
                                    <label class="custmo_checkbox pull-left">
                                        <input type="checkbox">
                                        <span class="custmo_checkmark blue"></span>
                                    </label>
                                </span>
                            </td>
                            <td>
                                <a href="javascript:void(0);" @click="loadProfile(contact.subscriber_id)">
                                    <user-avatar
                                        :avatar="contact.avatar"
                                        :firstname="contact.firstname"
                                        :lastname="contact.lastname"
                                        :width="32"
                                        :height="32"
                                        :fontsize="12"
                                    ></user-avatar>
                                </a>
                                <span class="htxt_medium_14 dark_900" style="cursor:pointer;" @click="loadProfile(contact.subscriber_id)">{{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }}</span>
                            </td>
                            <td>{{ contact.email }}</td>
                            <td>{{ (contact.phone != '' || contact.phone != null) ? phoneNoFormat(contact.phone) : '' }}</td>
                            <td>
                                <!--<button class="tags_btn blue">customer</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button>-->
                                <contact-tags :subscriber_id="contact.subscriber_id"></contact-tags>
                            </td>
                            <td><span class="">{{ timeAgo(contact.created) }} </span></td>
                            <td>
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
                                        <span><img src="assets/images/more-vertical.svg"/></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"
                                           v-if="contact.status != 2"
                                           @click="moveToArchive(contact.id)"
                                        >Move to Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 0)" v-if="contact.status ==1 && contact.globalStatus == 1">Inactive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 1)" v-else>Active</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="loadProfile(contact.subscriber_id)">View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareContactUpdate(contact.subscriber_id)">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteContact(contact.subscriber_id)">Delete</a>
                                        <a v-if="moduleName == 'people'" class="dropdown-item" href="javascript:void(0);" @click="doSyncContacts(contact.segment_id)">Sync</a>
                                    </div>
                                </div>
                                <div>
                                    <span class="float-right">
                                    <span v-if="contact.status == '1'" class="status_icon bkg_blue_300"></span>
                                    <span v-else class="status_icon bkg_grey"></span>
                                </span>
                                </div>
                            </td>
                        </tr>
                        <!--<tr v-for="contact in activeUsers" v-if="activeUsers">
                            <td>
                                <a href="javascript:void(0);" @click="loadProfile(contact.subscriber_id)">
                                    <user-avatar
                                        :avatar="contact.avatar"
                                        :firstname="contact.firstname"
                                        :lastname="contact.lastname"
                                        :width="32"
                                        :height="32"
                                        :fontsize="12"
                                    ></user-avatar>
                                </a>
                                <span class="htxt_medium_14 dark_900" style="cursor:pointer;" @click="loadProfile(contact.subscriber_id)">{{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }}</span>
                             </td>
                            <td class="text-right">{{ contact.email }}</td>
                            <td>
                                <contact-tags :subscriber_id="contact.subscriber_id"></contact-tags>
                            </td>
                            &lt;!&ndash;<td><span class="badge badge-dark">+4</span></td>&ndash;&gt;
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
                            <td>
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
                                        <span><img src="assets/images/more-vertical.svg"/></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"
                                           v-if="contact.status != 2"
                                           @click="moveToArchive(contact.id)"
                                        >Move to Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 0)" v-if="contact.status ==1 && contact.globalStatus == 1">Inactive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 1)" v-else>Active</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="loadProfile(contact.subscriber_id)">View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareContactUpdate(contact.subscriber_id)">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteContact(contact.subscriber_id)">Delete</a>
                                        <a v-if="moduleName == 'people'" class="dropdown-item" href="javascript:void(0);" @click="doSyncContacts(contact.segment_id)">Sync</a>
                                    </div>
                                </div>
                            </td>
                        </tr>-->
                        </tbody>
                    </table>
                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4">
                    </pagination>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
            </div>
        </div>
    </div>
</template>
<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import ContactTags from '@/components/admin/contact/ContactTags';
    export default {
        props: ['showArchived', 'subscribersData', 'allData', 'activeCount', 'archiveCount', 'showHeader', 'moduleName', 'moduleUnitID'],
        components: {UserAvatar, ContactTags, Pagination},
        data() {
            return {
                current_page: 1,
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: '',
                deletedItems: [],
            }
        },
        computed: {
            activeUsers : function(){
                if(this.subscribersData){
                    return this.subscribersData.filter(function(u){
                        return u.status != 2;
                    })
                }
            },
            archiveUsers: function(){
                if(this.subscribersData){
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
            },
            showPaginationData: function(current_page){
                this.$emit('navPage', current_page);
            },
            loadProfile: function(id){
                window.location.href='/admin#/contacts/profile/'+id;
            },
            moveToArchive: function(contactId){
                if(confirm('Are you sure you want to archive this contact?')){
                    //Do axios
                    axios.post('/admin/subscriber/moveToArchiveModuleContact', {
                        subscriberId:contactId,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showPaginationData(this.current_page);
                        }
                    });
                }
            },
            changeContactStatus: function(contactId, status){
                if(confirm('Are you sure you want to change contact status?')){
                    //Do axios
                    axios.post('/admin/subscriber/changeModuleContactStatus', {
                        subscriberId:contactId,
                        contactStatus: status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showPaginationData(this.current_page);
                        }
                    });
                }
            },
            deleteContact: function(contactId){
                if(confirm('Are you sure you want to delete this contact?')){
                    //Do axios
                    axios.post('/admin/subscriber/deleteModuleSubscriber', {
                        subscriberId:contactId,
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
            prepareContactUpdate: function(contactId) {
                this.$emit('prepareUpdate', {contactId});
            },
            doSyncContacts: function(contactId) {
                this.$emit('syncContacts', {contactId});
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
