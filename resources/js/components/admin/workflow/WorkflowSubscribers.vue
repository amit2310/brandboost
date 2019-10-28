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

                        <tr>
                            <td><span class="table-img mr15"><img src="/assets/images/table_user.png"/></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
                            <td class="text-right">nina.hernandez@example.com</td>
                            <td># lead, subscriber <span style="margin-left:15px;" class="badge badge-dark">+4</span></td>
                            <td>Customer</td>
                            <td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
                            <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                            </td>
                            <td>
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
                                        <span><img src="assets/images/more-vertical.svg"/></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr v-for="contact in activeUsers" v-if="activeUsers.length>0">
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
                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteContact(contact.subscriber_id)">Delete</a>
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
            },
            loadProfile: function(id){
                window.location.href='/admin#/contacts/profile/'+id;
                /*alert('Load Profile for '+id);*/
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
        },

        mounted() {

            let tableId = 'mySubsContact';
            this.paginate(tableId);

            let tableId2 = 'mySubsContact2';
            this.paginate(tableId2);

        }

    }
</script>


