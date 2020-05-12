<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7 col-7">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Contacts</h3>
                    </div>
                    <div class="col-md-2 col-2 text-left">
                        <!--<a class="lh_32 blue_400 htxt_bold_14" href="#/contacts/import">
                            <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="/assets/images/download-fill.svg"/></span>
                            Import contacts
                        </a>-->
                        &nbsp;
                    </div>
                    <div class="col-md-3 col-3 text-right">
                        <!--<button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>-->
                        <a class="lh_32 blue_400 htxt_bold_14" href="#/contacts/import">
                        <button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"/></button>
                        </a>
                        <button class="btn btn-md bkg_blue_200 light_000" @click="displayForm('Create')">New Contact List <span><img
                            src="/assets/images/blue-plus.svg"/></span></button>
                        <button class="js-contact-slidebox" v-show="false">
                            Display Form
                        </button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="content-area">

            <loading :isLoading="loading"></loading>
            <!--<workflow-subscribers
                :show-archived="true"
                :subscribers-data="subscribers"
                :all-data="allData"
                :active-count="activeCount"
                :archive-count="archiveCount"
                :module-name="moduleName"
                :sortBy="sortBy"
                :searchBy="searchBy"
                :items_per_page="items_per_page"
                :module-unit-id="moduleUnitID"
                @navPage ="navigatePagination"
                @prepareUpdate="getContactInfo"
                :key="current_page"
            ></workflow-subscribers>-->
            <div class="container-fluid">
                <div class="table_head_action" v-if="(subscribers.length > 0 || searchBy.length>0)">
                    <h3 class="htxt_medium_16 dark_400" style="display: none;">{{ allData.total }} Contact Lists</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="table_filter">
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')">ALL</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Active'}" @click="applySort('Active')">ACTIVE</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Pending'}" @click="applySort('Pending')">DRAFT</a></li>
                                <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Archive'}" @click="applySort('Archive')">ARCHIVE</a></li>

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
                                                <input type="checkbox" :checked="allChecked" @change="addtoDeleteCollection('all', $event.target)">
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
                                <tr v-for="contact in subscribers" v-if="subscribers">
                                    <td width="20">
                                        <span>
                                            <label class="custmo_checkbox pull-left">
                                                <input type="checkbox" :checked="deletedItems.indexOf(contact.id)>-1" @change="addtoDeleteCollection(contact.id, $event.target)">
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
                                </tbody>
                            </table>
                            <pagination
                                :pagination="allData"
                                @paginate="showPaginationData"
                                @paginate_per_page="showPaginationItemsPerPage"
                                :offset="4">
                            </pagination>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
                    </div>
                </div>
            </div>

        </div>

        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon js-contact-slidebox"><i
                    class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"><img src="/assets/images/create_cotact_people.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">{{formLabel}} Contact </h3>
                                <hr>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtfirstname">First name</label>
                                        <input type="text" class="form-control h56" id="txtfirstname" v-model="form.firstname" name="firstname" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtlastname">Last name</label>
                                        <input type="text" class="form-control h56" id="txtlastname" v-model="form.lastname" placeholder="Enter last name">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtemail">Email</label>
                                        <input type="email" class="form-control h56" id="txtemail" v-model="form.email" placeholder="Enter email address">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtphone">Phone number</label>
                                        <div class="phonenumber">
                                            <div class="float-left">
                                                <button type="button" class="dropdown-toggle table_action_dropdown p0 mt10" data-toggle="dropdown">
                                                    <span><img src="assets/images/USA.png"/></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
                                                </div>
                                            </div>
                                            <input type="number" class="inputbox" id="txtphone" v-model="form.phone" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <div class="clearfix"></div>
                                        <input type="text" class="form-control h56" id="tags" value='Removeable Tag, Other Tag' name="tags" style="display: none">
                                    </div>
                                </div>
                        </div>
                        <div class="row mb50">
                            <div class="col-md-6">
                                <a class="htxt_medium_14 dark_300" href="javascript:void(0);">
                                    <span class="mr10">
                                        <img src="assets/images/plus_icon.svg"/>
                                    </span>Contact Details
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="htxt_medium_14 dark_300" href="javascript:void(0);">Assign Contact
                                    <span class="ml10"><img src="assets/images/plus_icon.svg"/></span>
                                </a>
                            </div>
                        </div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id" :value="moduleAccountID">
                                <button type="submit" class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Save </button>
                                <a class="blue_300 fsize16 fw600 ml20" href="javascript:void(0);">Close</a></div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import WorkflowSubscribers from '@/components/admin/workflow/WorkflowSubscribersNew.vue';
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import ContactTags from '@/components/admin/contact/ContactTags';

    export default {
        props: ['pageColor'],
        components: {'workflow-subscribers': WorkflowSubscribers, UserAvatar, 'contact-tags': ContactTags, Pagination},
        data() {
            return {
                successMsg : '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                activeCount: 0,
                archiveCount: 0,
                subscribers: {},
                allData: {},
                current_page: 1,
                items_per_page: 10,
                breadcrumb: '',
                form: {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phone: '',
                    id: ''
                },
                formLabel: 'Create',
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: '',
                deletedItems: []
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            },
            'searchBy' : function(){
                this.loadPaginatedData();
            },
            'items_per_page' : function(){
                this.loadPaginatedData();
            }
        },
        computed:{
            'allChecked' : function () {
                let notFound = '';
                this.subscribers.forEach(camp => {
                    let idx = this.deletedItems.indexOf(camp.id);
                    if(idx == -1){
                        notFound = true;
                    }
                });
                return notFound === true ? false : true;
            }
        },
        methods: {
            loadProfile: function(id){
                window.location.href='/admin#/contacts/profile/'+id;
            },
            applySort: function(sortVal){
                this.loading = true;

                this.sortBy = sortVal;
                this.deletedItems = [];
            },
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    if(confirm('Are you sure you want to delete selected item(s)?')){
                        this.loading = true;
                        axios.post('/admin/contacts/deleteBulkContacts', {_token:this.csrf_token(), multipal_record_id:this.deletedItems})
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
                        if(this.subscribers.length>0){
                            this.subscribers.forEach(camp => {
                                let idxx = this.deletedItems.indexOf(camp.id);
                                if(idxx == -1){
                                    this.deletedItems.push(camp.id);
                                }
                            });
                        }
                    }else{
                        this.subscribers.forEach(camp => {
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
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-contact-slidebox').click();
            },
            getContactInfo: function(contactId){
                axios.post('/admin/subscriber/getSubscriberDetail', {
                    module_subscriber_id:contactId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data.result[0];
                            this.form.firstname = formData.firstname;
                            this.form.lastname = formData.lastname;
                            this.form.email = formData.email;
                            this.form.phone = formData.phone;
                            this.form.id = formData.id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }
                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.id>0){
                    formActionSrc = '/admin/subscriber/update_contact';
                }else{
                    formActionSrc = '/admin/subscriber/add_contact';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.loading = false;
                            //this.form = {};
                            this.form.id ='';
                            document.querySelector('.js-contact-slidebox').click();
                            this.displayMessage('success', 'Action completed successfully.');
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);
                            syncContactSelectionSources();
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                        //error.response.data
                        //alert('All form fields are required');
                    });
            },
            loadPaginatedData : function() {
                axios.get('/admin/contacts/mycontacts?page='+this.current_page+'&items_per_page='+this.items_per_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.subscribers = response.data.subscribersData;
                        this.allData = response.data.allData;
                        this.activeCount = response.data.activeCount;
                        this.archiveCount = response.data.archiveCount;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.loading = false;
                    });
            },
            addNewContact : function(e){
                let form = document.getElementById('addNewContactVue');
                let formData = new FormData(form);
                formData.append('_token', this.csrf_token());
                axios.post('/admin/subscriber/add_contact', this)
                    .then(response => {
                        if(response.data.status == 'success'){
                            alert(('form submitted successfully'))
                            /*vm.$forceUpdate();*/
                        }

                    });
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
            changeContactStatus: function(contactId, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
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
                                syncContactSelectionSources();
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
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            showPaginationItemsPerPage: function(p){
                this.loading=true;
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
        }
    };


    $(document).ready(function () {
        $(document).on('click', '.js-contact-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });
</script>
