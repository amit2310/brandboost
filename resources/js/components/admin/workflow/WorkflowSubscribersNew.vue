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
                    <!--<button class="btn btn-md bkg_blue_200 light_000" @click="displayForm('Create')">Add New Contact <span><img
                        src="/assets/images/blue-plus.svg"/></span></button>
                        <button class="js-contact-slidebox" v-show="false">
                        Display Form
                    </button>-->
                    <button class="btn btn-md bkg_blue_200 light_000 js-contact-slidebox">Add New Contact <span><img
                        src="/assets/images/blue-plus.svg"/></span></button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

        <div class="content-area">

            <div class="container-fluid">
            <div class="table_head_action">
                <h3 class="htxt_medium_16 dark_400" style="display: none;">{{ allData.total }} Contact Lists</h3>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="table_filter">
                            <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')">All</a></li>
                            <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Active'}" @click="applySort('Active')">Active</a></li>
                            <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Pending'}" @click="applySort('Pending')">Draft</a></li>
                            <li><a href="javascript:void(0);" :class="{'active': sortBy == 'Archive'}" @click="applySort('Archive')">Archive</a></li>

                            <!--<li><a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a>
                                <div class="dropdown-menu p10 mt-1">
                                    <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Inactive'}" @click="applySort('Inactive')"><i class="ri-check-double-fill"></i> &nbsp; Inactive</a>
                                    <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')"><i class="ri-check-double-fill"></i> &nbsp; Created</a>
                                </div>
                            </li>-->
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="table_filter text-right">
                            <li>
                                <a class="" data-toggle="dropdown" aria-expanded="false"  href="javascript:void(0);"><i><img src="assets/images/filter_line_18.svg"></i></a>
                                <div class="dropdown-menu p10 mt-1">
                                    <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Inactive'}" @click="applySort('Inactive')"><i class="ri-check-double-fill"></i> &nbsp; Inactive</a>
                                    <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')"><i class="ri-check-double-fill"></i> &nbsp; Created</a>
                                </div>
                            </li>
                            <li><a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg" title="Search"></i></a></li>
                            <li v-show="deletedItems.length>0 && sortBy !='archive'"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                            <li><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg" title="List View"></i></a></li>
                            <li><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_line_18.svg" title="Grid View"></i></a></li>
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
            <div v-if="(subscribers.length > 0 || searchBy.length > 0)">
                <div class="row" v-if="viewType == 'List View'">

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
                                    &nbsp;&nbsp;
                                    <span class="htxt_medium_14 dark_900" style="cursor:pointer;" @click="loadProfile(contact.subscriber_id)">{{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }}</span>
                                </td>
                                <td>{{ contact.email }}</td>
                                <td>{{ (contact.phone != '' || contact.phone != null) ? phoneNoFormat(contact.phone) : '-' }}</td>
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
                    <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
                </div>
            </div>

            <div class="row" v-if="viewType == 'Grid View'">
                <div class="col">
                    <div class="custom_pagination grey mb30">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="mr-4">{{ allData.total }} CONTACTS</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <select style="width:55px;"><option>SORT</option><option>SORT</option><option>15</option><option>20</option></select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="viewType == 'Grid View'">
                <div v-for="contact in subscribers" v-if="subscribers" class="col-md-3 d-flex">
                    <div class="card p0 pt40 text-center animate_top col">
                        <span v-if="contact.status == '1'" class="status_icon bkg_blue_300"></span>
                        <span v-else class="status_icon bkg_light_800"></span>

                        <div class="dot_dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/more-2-fill.svg" alt="profile-user"> </a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" href="javascript:void(0);" v-if="contact.status != 2" @click="moveToArchive(contact.id)"><i class="dripicons-user text-muted mr-2"></i> Move to Archive</a>
                                <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 0)" v-if="contact.status ==1 && contact.globalStatus == 1"><i class="dripicons-wallet text-muted mr-2"></i> Inactive</a>
                                <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 1)" v-else><i class="dripicons-gear text-muted mr-2"></i> Active</a>
                                <a class="dropdown-item" href="javascript:void(0);" @click="prepareContactUpdate(contact.subscriber_id)"><i class="dripicons-lock text-muted mr-2"></i> Edit</a>
                                <a class="dropdown-item" v-if="moduleName == 'people'" href="javascript:void(0);" @click="doSyncContacts(contact.segment_id)"><i class="dripicons-lock text-muted mr-2"></i> Sync</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteContact(contact.subscriber_id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                            </div>
                        </div>
                        <!--<a href="#" class="circle-icon-56 bkg_brand_000 m0auto"><span class="fsize14 fw500 text-uppercase light_000">am</span></a>-->
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
                        <h3 class="htxt_medium_14 dark_600 mb-1 mt-4" style="cursor:pointer;" @click="loadProfile(contact.subscriber_id)">{{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }}</h3>
                        <p class="fsize14 fw400 dark_400 mb-1 ls_4">{{ contact.email }}</p>
                        <p class="fsize14 fw400 dark_400 mb30 ls_4">{{ timeAgo(contact.created) }}</p>
                        <div class="p20 btop">
                            <!--<button class="tags_btn blue">tags</button> <button class="tags_btn">user</button> <button class="tags_btn">+2 </button>-->
                            <contact-tags :subscriber_id="contact.subscriber_id"></contact-tags>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card p0 pt40 text-center animate_top col js-contact-slidebox">
                        <a href="#" class="circle-icon-64 bkg_light_200 m0auto mt-4"><img src="assets/images/plus03.svg"> </a>
                        <p class="fsize11 fw500 dark_200 text-uppercase mb30 ls_4 mt-4">Create<br>new contact</p>
                    </div>
                </div>
            </div>

            <pagination v-if="viewType == 'Grid View'"
                :pagination="allData"
                @paginate="showPaginationData"
                @paginate_per_page="showPaginationItemsPerPage"
                :offset="4">
            </pagination>
        </div>
        <div v-else class="row">
            <div class="col-md-12">
                <div class="card card_shadow min-h-280">

                    <div class="row mb65">
                        <div class="col-md-12 text-left">
                            <a class="lh_32 blue_400 htxt_bold_14" href="#/contacts/import">
                                <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
                                Import contacts
                            </a>
                        </div>
                    </div>
                    <div class="row mb65">
                        <div class="col-md-12 text-center">
                            <img class="mt40" style="max-width: 250px; " src="assets/images/people_contact_image.svg">
                            <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any contacts</h3>
                            <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import contacts!</h3>
                            <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-contact-slidebox">Add contact</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-2">
                <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
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
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import ContactTags from '@/components/admin/contact/ContactTags';
    export default {
        props: [],
        components: {UserAvatar, ContactTags, Pagination},
        data() {
            return {

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
                this.showLoading(true);

                this.sortBy = sortVal;
                this.deletedItems = [];
            },
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    if(confirm('Are you sure you want to delete selected item(s)?')){
                        this.showLoading(true);
                        axios.post('/admin/contacts/deleteBulkContacts', {_token:this.csrf_token(), multipal_record_id:this.deletedItems})
                            .then(response => {
                                this.showLoading(false);
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
                this.showLoading(true);
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
                            this.showLoading(false);
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
                        this.showLoading(false);
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
                        this.showLoading(false);
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
                //this.$emit('prepareUpdate', {contactId});
                this.getContactInfo(contactId);
            },
            doSyncContacts: function(contactId) {
                this.$emit('syncContacts', {contactId});
            },
            showPaginationData: function(p){
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            showPaginationItemsPerPage: function(p){
                this.showLoading(true);
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
        }
    }

    $(document).ready(function () {
        $(document).on('click', '.js-contact-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });
</script>
