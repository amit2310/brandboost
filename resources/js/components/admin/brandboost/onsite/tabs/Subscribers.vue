<template>

    <div>

        <div class="table_head_action pb0 mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="htxt_medium_14 dark_600">Contacts</h3>
                </div>
                <div class="col-md-6">
                    <ul class="table_filter text-right">
                        <li>
                            <!--<a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a>-->
                            <input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">
                        </li>
                        <li v-show="deletedItems.length>0 && sortBy !='archive'"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                        <li v-if="viewType == 'Grid View'"><a href="javascript:void(0);" :class="{'active': viewType == 'List View'}" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                        <li v-if="viewType == 'List View'"><a href="javascript:void(0);" :class="{'active': viewType == 'Grid View'}" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                        <li><a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i></a>
                            <div class="dropdown-menu p10 mt-1">
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Date Created'}" @click="sortBy='Date Created'">ALL</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">ACTIVE</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a>
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div v-if="subscribers.length > 0">

            <div class="row" v-if="viewType == 'Grid View'">
                <div class="col-md-3 d-flex" v-for="subscriber in subscribers" v-if="subscriber.firstname != null">
                    <div class="card p0 pt30 text-center animate_top col">
                        <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a v-if="subscriber.status == '0' || subscriber.status == '2'" :subscriber_id="subscriber.id" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(subscriber.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                <a v-if="subscriber.status == '1'" :subscriber_id="subscriber.id" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(subscriber.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                <a v-if="subscriber.status != '3'" :subscriber_id="subscriber.id" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(subscriber.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(subscriber.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="circle-icon-64 bkg_reviews_000 m0auto">
                            <img v-if="subscriber.status == 1" src="assets/images/folder-fill.svg">
                            <img v-else src="assets/images/folder-fill.svg">
                        </a>
                        <h3 class="htxt_bold_16 dark_700 mb-2 mt-4" style="cursor: pointer;">
                            <span>{{ capitalizeFirstLetter(subscriber.firstname) }} {{ capitalizeFirstLetter(subscriber.lastname) }}</span>
                        </h3>
                        <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="subscriber.status == 0" >INACTIVE</p>
                        <p class="fsize10 fw500 green_400 text-uppercase mb20" v-if="subscriber.status == 1" >ACTIVE</p>
                        <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="subscriber.status == 2" >PENDING</p>
                        <p class="fsize10 fw500 light_800 text-uppercase mb20" v-if="subscriber.status == 3" >ARCHIVED</p>
                        <div class="p15 pt15 btop">
                            <p v-if="subscriber.updated != null" class="htxt_regular_12 dark_300 mb15"><em> Updated On: {{ displayDateFormat('M d, h:i A', subscriber.updated) }} </em></p>
                            <p v-else class="htxt_regular_12 dark_300 mb15"><em> Updated On: {{ '' }} </em></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="viewType == 'List View'">
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
                            <td><span class="fsize10 fw500">CONTACTS </span></td>
                            <td><span class="fsize10 fw500">EMAIL</span></td>
                            <td><span class="fsize10 fw500">SOURCE</span></td>
                            <td><span class="fsize10 fw500">UPDATE <img src="assets/images/arrow-down-line-14.svg"/> </span></td>
                            <td><span class="fsize10 fw500">STATUS</span></td>
                            <td><span class="fsize10 fw500">&nbsp;</span></td>
                        </tr>
                        <!--<tr v-for="subscriber in subscribers" v-if="subscriber.firstname != null">-->
                        <tr v-for="subscriber in subscribers" v-if="subscriber.firstname != null">
                            <td width="20">
                                <span>
                                    <label class="custmo_checkbox pull-left">
                                        <input type="checkbox" :checked="deletedItems.indexOf(subscriber.id)>-1" @change="addtoDeleteCollection(subscriber.id, $event.target)">
                                        <span class="custmo_checkmark blue"></span>
                                    </label>
                                </span>
                            </td>
                            <td>
                                <span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">{{ subscriber.firstname.charAt(0) }}</span></span>
                                <!--<user-avatar
                                    :avatar="subscriber.avatar"
                                    :firstname="subscriber.firstname"
                                    :lastname="subscriber.lastname"
                                ></user-avatar>-->
                                <span>{{ subscriber.firstname }} {{ subscriber.lastname }}</span>
                            </td>
                            <td>{{ subscriber.email }}</td>
                            <td><span class="mr-3"><span class="status_icon bkg_blue_300"></span></span>{{ subscriber.source!=''?subscriber.source:'People CRM' }}</td>
                            <td>{{ displayDateFormat('M d, Y', subscriber.updated) }}</td>
                            <td>
                                <span v-if="subscriber.status == 1"><span class="mr-3"><span class="status_icon bkg_green_300"></span></span>Active</span>
                                <span v-else-if="subscriber.status == 3"><span class="mr-3"><span class="status_icon bkg_green_300"></span></span>Archived</span>
                                <span v-else><span class="mr-3"><span class="status_icon bkg_dark_100"></span></span>Disable</span>
                            </td>
                            <td>
                                <div class="dot_dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a v-if="subscriber.status == '0' || subscriber.status == '2'" :subscriber_id="subscriber.id" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(subscriber.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                        <a v-if="subscriber.status == '1'" :subscriber_id="subscriber.id" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(subscriber.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                        <a v-if="subscriber.status != '3'" :subscriber_id="subscriber.id" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(subscriber.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(subscriber.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        @paginate_per_page="showPaginationItemsPerPage"
                        :offset="4"
                        class="mt-4">
                    </pagination>
                </div>
            </div>

            <div v-if="viewType == 'Grid View'" class="clearfix"></div>
            <pagination  v-if="viewType == 'Grid View'"
                :pagination="allData"
                @paginate="showPaginationData"
                @paginate_per_page="showPaginationItemsPerPage"
                :offset="4"
                class="mt-4">
            </pagination>

        </div>

        <div v-else class="row">
            <div class="col-md-12">
                <div class="card card_shadow min-h-280">

                    <div class="row mb65">
                        <div class="col-md-12 text-left">
                            <a class="lh_32 blue_400 htxt_bold_14" href="#">
                                <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
                                Import contacts
                            </a>
                        </div>
                    </div>

                    <div class="row mb65">
                        <div class="col-md-12 text-center">
                            <img class="mt40" style="max-width: 225px; " src="assets/images/illustration2.png">
                            <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any List contacts</h3>
                            <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import!</h3>
                            <button class="btn btn-sm bkg_blue_000 pr20 blue_300 slidebox">Add List Contact</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-2">
                <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"/> &nbsp; LEARN MORE ABOUT PEOPLE</a>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Onsite Reviews - Brand Boost',
        name: "OnsiteSubscribersTab",
        props : ['pageColor'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                allData: {},
                subscribers : '',
                campaign: '',
                campaignTitle: '',
                aUserInfo: '',
                current_page: 1,
                items_per_page: 10,
                breadcrumb: '',
                seletedTab: 1,
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: '',
                deletedItems: []
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.campaignId = this.$route.params.id;
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
                this.subscribers.forEach(subs => {
                    let idx = this.deletedItems.indexOf(subs.id);
                    if(idx == -1){
                        notFound = true;
                    }
                });
                return notFound === true ? false : true;
            }
        },
        methods: {
            searchItem: function(){
                this.loadPaginatedData();
            },
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    if(confirm('Are you sure you want to delete selected item(s)?')){
                        this.loading = true;
                        axios.post('/admin/reviews/deleteMultipalReview', {_token:this.csrf_token(), multiReviewid:this.deletedItems})
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
                            this.subscribers.forEach(subs => {
                                let idxx = this.deletedItems.indexOf(subs.id);
                                if(idxx == -1){
                                    this.deletedItems.push(subs.id);
                                }
                            });
                        }
                    }else{
                        this.subscribers.forEach(subs => {
                            let idxx = this.deletedItems.indexOf(subs.id);
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
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/onsiteSetupSubscribers/'+this.campaignId+'?items_per_page='+this.items_per_page+'&page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.allData = response.data.allData;
                        this.subscribers = response.data.subscribers;
                        this.campaign = response.data.brandboostData;
                        this.user = response.data.aUserInfo;
                    });
            },
            showPaginationData: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            showPaginationItemsPerPage: function(p){
                this.loading=true;
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(contactId, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/contacts/update_status', {
                        contactId:contactId,
                        status:status,
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
            deleteList: function(subscriberId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/contacts/delete_contact', {
                        subscriberId:subscriberId,
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
            }
        }
    }
</script>
