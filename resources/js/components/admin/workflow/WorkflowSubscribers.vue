<template>
    <div class="container-fluid">
        <div class="table_head_action" v-if="showHeader !== false">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="htxt_medium_16 dark_400">{{ allData.total }} Contact Lists</h3>
                </div>
                <div class="col-md-6">
                    <div class="table_action">
                        <div class="float-right">
                            <button type="button" class="dropdown-toggle table_action_dropdown"
                                    data-toggle="dropdown">
                                <span><img src="/assets/images/date_created.svg"/></span>&nbsp; Date Created
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
                            </div>
                        </div>
                        <div class="float-right ml10 mr10">
                            <button type="button" class="dropdown-toggle table_action_dropdown"
                                    data-toggle="dropdown">
                                <span><img src="/assets/images/list_view.svg"/></span>&nbsp; List View
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
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
                        <tr v-for="contact in activeUsers" v-if="activeUsers">
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
                //handler: 'setOptimizer'
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
