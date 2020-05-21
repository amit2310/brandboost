<template>
    <div>



        <div class="container-fluid">
            <div class="table_head_action">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="table_filter new">
                            <li class="mr15 "><!--<a class="dark_200" href="#">Match All</a>-->
                                <select class="match_segment_select dark_200" name="matchType" @change="onMatchTypeChange($event)" v-model="matchSelected">
                                    <option value="MatchAll">Match All</option>
                                    <option value="MatchOne">Match One</option>
                                </select>
                            </li>
                            <!--<li><a class="blef pl15" href="javascript:void(0);"><img src="assets/images/at_blue_13.svg"/> &nbsp; <span class="dark_600">{{fieldSelected}}</span> is max@makers.co</a></li>-->
                            <!--<li><a href="javascript:void(0);"><img src="assets/images/hash_16_blue.svg"/> &nbsp; <span class="dark_600">User ID</span>  starts with 12</a></li>-->
                            <li v-if="filterItemsArr" v-for="(filterItems, index) in filterItemsArr">
                                <a href="javascript:void(0);" style="text-transform: none;"><span class="dark_600">{{ filterItems[0] }}</span></a>
                            </li>
                            <li>
                                <a class="search_tables_open_close_AF" href="javascript:void(0);" @click="AddFilters"><img src="assets/images/plus_green_15.svg"/></a> &nbsp;
                                <a href="javascript:void(0);" @click="RemoveFilters(filterItemsArr, (filterItemsArr.length - 1))"><img src="assets/images/minus_red_15.svg"/></a>
                                <button v-if="filterItemsArr.length > 0" class="btn btn-md bkg_blue_200 light_000 save_filter" @click="addFiltersToSegment">Save Filters</button>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 pl-0">
                        <ul class="table_filter text-right">
                            <li><a href="javascript:void(0);" class="save_segment_btn fsize14 dark_600 fw500 pl15 pr15"><img class="float-left" style="margin-top:2px;" src="assets/images/pi-line-blue.svg"/> &nbsp; Save Segment</a></li>
                            <li><a class="search_tables_open_close_SG" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                            <li v-show="deletedItems.length>0 && sortBy !='archive'"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                            <li><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg" title="List View"></i></a></li>
                            <li><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg" title="Grid View"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card p20 datasearcharea_SG reviewRequestSearch br6 shadow3">
                    <div class="form-group m-0 position-relative">
                        <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search item" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                        <a class="search_tables_open_close_SG searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
                    </div>
                </div>

                <div class="card p20 datasearcharea_AF">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group m-0 position-relative">
                                <select name="fieldSelected" @change="onFieldChange($event)" v-model="fieldSelected"  class="match_segment_select form-control form-control-custom medium h48">
                                    <option value="id">Subscriber Id</option>
                                    <option value="firstname">First Name</option>
                                    <option value="lastname">Last Name</option>
                                    <option value="email">Email</option>
                                    <option value="phone">Phone</option>
                                    <option value="created">Subscribe Date</option>
                                    <option value="country_code">Country</option>
                                    <option value="stateName">State</option>
                                    <option value="cityName">City</option>
                                    <option value="zipCode">Zip</option>
                                    <option value="zipCode">AreaCode</option>
                                    <option value="tagID">Tag</option>
                                    <option value="IPAddress">IP Address</option>
                                    <option value="custom_field_1">Custom Field-1</option>
                                    <option value="custom_field_2">Custom Field-2</option>
                                    <option value="custom_field_3">Custom Field-3</option>
                                    <option value="custom_field_4">Custom Field-4</option>
                                    <option value="custom_field_5">Custom Field-5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group m-0 position-relative">
                                <select name="operator" @change="onOperatorChange($event)" v-model="operatorSelected" class="match_segment_select form-control form-control-custom medium h48" >
                                    <option value="equal">equal</option>
                                    <option value="notequal">not equal</option>
                                    <option value="greaterthan">greater than</option>
                                    <option value="lessthan">less than</option>
                                    <option value="contain">contain</option>
                                    <option value="startwith">start with</option>
                                    <option value="endwith">end with</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group m-0 position-relative">
                                <input id="filterValue" v-model="filterValue" type="text" class="h48 fsize14 dark_200 fw400 br5 form-control" style="height: 48px;">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group m-0 position-relative">
                                <button class="btn btn-md bkg_blue_200 light_000 save_filter mt-1" @click="applyFilters">Apply Filter</button>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" @click="filterValue=''" class="search_tables_open_close_AF searchcloseicon"><img src="assets/images/close-icon-13.svg"></a>
                </div>
            </div>
            <div v-if="(subscribers.length > 0 || searchBy.length>0)">
                <div class="row" v-if="viewType=='List View'">
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
                        <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT PEOPLE</a>
                    </div>
                </div>

                <div class="row" v-if="viewType == 'Grid View'">
                    <div v-for="contact in subscribers" class="col-md-3 d-flex">
                        <div class="card p0 pt40 text-center animate_top col">
                            <span class="status_icon bkg_light_800"></span>

                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/more-2-fill.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="javascript:void(0);"v-if="contact.status != 2" @click="moveToArchive(contact.id)"><i class="dripicons-user text-muted mr-2"></i> Move to Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 0)" v-if="contact.status ==1 && contact.globalStatus == 1"><i class="dripicons-wallet text-muted mr-2"></i> Inactive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="changeContactStatus(contact.id, 1)" v-else><i class="dripicons-gear text-muted mr-2"></i> Active</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="loadProfile(contact.subscriber_id)"><i class="dripicons-lock text-muted mr-2"></i> View Details</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareContactUpdate(contact.subscriber_id)"><i class="dripicons-lock text-muted mr-2"></i> Edit</a>
                                    <a v-if="moduleName == 'people'" class="dropdown-item" href="javascript:void(0);" @click="doSyncContacts(contact.segment_id)"><i class="dripicons-lock text-muted mr-2"></i> Sync</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteContact(contact.subscriber_id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
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
                    <div class="col-md-3 d-flex js-segment-contact-slidebox" style="cursor: pointer;">
                        <div class="card p0 pt40 text-center animate_top col">
                            <a href="javascript:void(0);" class="circle-icon-64 bkg_light_200 m0auto mt-4"><img src="assets/images/plus03.svg"> </a>
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
                                <a class="lh_32 blue_400 htxt_bold_14" href="javascript:void(0);">
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
                                <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-segment-contact-slidebox">Add contact</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-2">
                    <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"/> &nbsp; LEARN MORE ABOUT PEOPLE</a>
                </div>
            </div>
        </div>

        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon js-segment-contact-slidebox"><i
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
                deletedItems: [],
                profileID : this.$route.params.id,
                matchSelected: 'MatchOne',
                fieldSelected: 'email',
                operatorSelected: 'equal',
                filterValue: '',
                filterItems: [],
                filterItemsArr: [],
            }
        },
        mounted() {
            this.profileID = this.$route.params.id;
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
            onMatchTypeChange(event) {
                this.matchSelected = event.target.value;
            },
            onFieldChange(event) {
                this.fieldSelected = event.target.value;
                this.operatorSelected = 'equal';
                this.filterValue = '';
            },
            onOperatorChange(event) {
                this.operatorSelected = event.target.value;
            },
            AddFilters: function() {
                this.filterItems = [];
            },
            applyFilters: function() {
                this.filterItems = [];

                let fieldSymbol = '#', operatorVal, fieldStatement;
                if(this.fieldSelected == 'Email') {
                    fieldSymbol = '@';
                }

                operatorVal = this.operatorSelected;
                if(this.operatorSelected == 'equal') {
                    operatorVal = 'is';
                } else if(this.operatorSelected == 'notequal') {
                    operatorVal = 'is not';
                }

                fieldStatement = fieldSymbol + ' ' + this.fieldSelected + ' ' + operatorVal  + ' ' + this.filterValue;
                this.filterItems.push(fieldStatement);
                /*this.filterItems.push(fieldSymbol, this.fieldSelected, this.operatorSelected, this.filterValue);
                this.filterItems.push(this.matchSelected);
                this.filterItems.push(this.fieldSelected);
                this.filterItems.push(this.operatorSelected);
                this.filterItems.push(this.filterValue);*/
                this.filterItemsArr.push(this.filterItems);
                //console.log(this.filterItemsArr);

                this.loadPaginatedData();
            },
            RemoveFilters: function(arr, index) {
                var i = 0;
                while (i < arr.length) {
                    if(i === index) {
                        arr.splice(i, 1);
                    } else {
                        ++i;
                    }
                }
            },
            addFiltersToSegment: function(){
                if(this.filterItemsArr.length>0){
                    if(confirm('Are you sure you want to a save filter item(s)?')){
                        this.showLoading(true);
                        axios.post('/admin/broadcast/addFiltersToSegment', {_token:this.csrf_token(), segment_id: this.profileID, matchSelected: this.matchSelected, multipleFIlterItems:this.filterItemsArr})
                            .then(response => {
                                this.showLoading(false);
                                this.displayMessage('success', 'Action completed successfully.');

                                this.loadPaginatedData();
                            });
                    }
                }
            },
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
                        axios.post('/admin/broadcast/deleteMultipalSegmentUser', {_token:this.csrf_token(), multiSegmentUserid:this.deletedItems})
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
                document.querySelector('.js-segment-contact-slidebox').click();
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
                            document.querySelector('.js-segment-contact-slidebox').click();
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
                        alert('All form fields are required');
                    });
            },
            loadPaginatedData : function() {
                axios.get('/admin/broadcast/segmentcontacts/'+this.profileID +'?page='+this.current_page+'&items_per_page='+this.items_per_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
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
                this.$emit('prepareUpdate', {contactId});
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
        $(document).on('click', '.js-segment-contact-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".search_tables_open_close_SG", function(){
            $(".datasearcharea_SG").animate({
                width: "toggle"
            });
            $('#InputToFocus').focus();
        });

        $(document).on("click", ".search_tables_open_close_AF", function(){
            $(".datasearcharea_AF").animate({
                width: "toggle"
            });
            $('#filterValue').focus();
        });
    });
</script>
<style>
    .datasearcharea_SG{position:relative;width: 100%;z-index: 1;top: 13px; display: none}
    .datasearcharea_SG a.searchcloseicon{ position: absolute; right: 25px;top: 14px;}

    .datasearcharea_SG .form-control:focus{box-shadow: none!important}

    .datasearcharea_AF{position:relative;width: 100%;z-index: 1;top: 13px; display: none}
    .datasearcharea_AF a.searchcloseicon{ position: absolute; right: 25px;top: 14px;}

    .datasearcharea_AF .form-control:focus{box-shadow: none!important}
</style>
