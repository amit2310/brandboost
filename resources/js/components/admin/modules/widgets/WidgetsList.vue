<template>
    <div class="content">
        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Review Widgets</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/settings-2-line.svg"></button>
                        <button class="btn btn-md bkg_reviews_400 light_000 js-onsite-widget-slidebox2">CREATE WIDGET <span><img src="assets/images/reviews_plus_icon.svg"></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->


            <div class="content-area" v-show="pageRendered==true" >
                <div class="container-fluid" v-if="widgets.length > 0 || searchBy.length > 0">
                    <div class="table_head_action">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="table_filter">
                                    <li><a href="javascript:void(0);" :class="{'active': sortBy == 'all'}" @click="applySort('all')">ALL</a></li>
                                    <li><a href="javascript:void(0);" :class="{'active': sortBy == 'active'}" @click="applySort('active')">ACTIVE</a></li>
                                    <li><a href="javascript:void(0);" :class="{'active': sortBy == 'draft'}" @click="applySort('draft')">DRAFT</a></li>
                                    <li><a href="javascript:void(0);" :class="{'active': sortBy == 'archive'}" @click="applySort('archive')">ARCHIVE</a></li>
                                    <li><a :class="{'active': sortBy == 'Date Created'}" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a>
                                        <div class="dropdown-menu p10 mt-1">
                                           <!--  <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Inactive'}" @click="applySort('Inactive')"><i class="ri-check-double-fill"></i> &nbsp; INACTIVE</a> -->
                                            <a href="javascript:void(0);" class="dropdown-item" :class="{'active': sortBy == 'Date Created'}" @click="applySort('Date Created')"><i class="ri-check-double-fill"></i> &nbsp; CREATED</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="table_filter text-right">
                                    <li><a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                    <li v-show="deletedItems.length>0"><a href="javascript:void(0);" @click="deleteSelectedItems"><i><img width="16" src="assets/images/delete-bin-7-line.svg"></i></a></li>
                                    <li><a href="javascript:void(0);" @click="viewType='List View'"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                    <li><a href="javascript:void(0);" @click="viewType='Grid View'"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
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

                    <div  class="row" v-if="viewType == 'Grid View'">
                        <div v-for="widget in widgets" class="col-md-3 text-center">
                            <div class="card  h235 animate_top" style="padding:0px!important;">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareUpdate(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                        <a v-if="(widget.status == '0' || widget.status == '2') && widget.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Start</a>
                                        <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Pause</a>
                                        <a v-if="widget.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                        <a class="dropdown-item viewECode" href="javascript:void(0);" :widgetID="widget.id"><i class="dripicons-user text-muted mr-2"></i> Get Embedded Code</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="navigateStats(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Statistics</a>
                                    </div>
                                </div>
                                <div>
                                    <img class="mt20" src="assets/images/subs-icon_big.svg">
                                    <h3 class="htxt_bold_16 dark_700" @click="navigateToOnsiteWidgetSetup(widget.id)" style="cursor:pointer;">
                                        <span>{{capitalizeFirstLetter(setStringLimit(widget.widget_title, 20))}}</span>
                                    </h3>
                                    <p v-if="widget.widget_type == 'cpw'"><em>(Center Popup)</em></p>
                                    <p v-else-if="widget.widget_type == 'vpw'"><em>(Vertical Popup)</em></p>
                                    <p v-else-if="widget.widget_type == 'bww'"><em>(Button Widget Popup)</em></p>
                                    <p v-else-if="widget.widget_type == 'bfw'"><em>(Bottom Fixed Popup)</em></p>
                                    <p v-else-if="widget.widget_type == 'rfw'"><em>(Embeded Reviews)</em></p>
                                    <p v-else><em>[No Data]</em></p>

                                    <!--<p v-if="widget.brandboost_id" class="htxt_regular_12">{{ widget.bbBrandTitle != '' ? 'Campaign: ' + setStringLimit(widget.bbBrandTitle, 20) : '[No Data]' }}</p>
                                    <p v-else class="htxt_regular_12">{{ widget.bbBrandTitle }}</p>

                                    <p class="htxt_regular_12">{{ setStringLimit(widget.bbBrandDesc, 40) }}</p>-->

                                    <p class="htxt_regular_12">
                                        <span v-if="widget.status  == '1'">Published</span>
                                        <span v-else-if="widget.status == '2'">Paused</span>
                                        <span v-else-if="widget.status == '3'">Archived</span>
                                        <span v-else>Draft</span>
                                        &nbsp;|&nbsp;
                                        {{ displayDateFormat('M d, h:i A', widget.created) }}
                                    </p>

                                    <p>
                                        Views: {{ widget.totalViews }} |
                                        Clicks: {{ widget.totalClicks }} |
                                        Commented: {{ widget.totalComments }} |
                                        Helpful: {{ widget.totalHelpful }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 text-center js-onsite-widget-slidebox2" style="cursor: pointer;">
                            <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                                <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                                <p class="htxt_regular_16 dark_100 mb15">Create<br>Onsite Widget</p>
                            </div>
                        </div>

                    </div>

                    <pagination v-if="viewType == 'Grid View'"
                        :pagination="allData"
                        @paginate="showPaginationData"
                        @paginate_per_page="showPaginationItemsPerPage"
                        :offset="4">
                    </pagination>

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
                                        <td><span class="fsize10 fw500">REVIEW WIDGET </span></td>
                                        <td><span class="fsize10 fw500">TYPE </span></td>
                                        <td width="55"><span class="fsize10 fw500"><img title="Total Views" src="assets/images/eyeline.svg"></span></td>
                                        <td><span class="fsize10 fw500"><img title="Total Clicks" src="assets/images/cursor-line.svg"></span></td>
                                        <td><span class="fsize10 fw500"><img title="Total Helpful" src="assets/images/star-line.svg"></span></td>
                                        <td><span class="fsize10 fw500">RATING</span></td>
                                        <td><span class="fsize10 fw500">UPDATE <img src="assets/images/arrow-down-line-14.svg"> </span></td>
                                        <td><span class="fsize10 fw500">STATUS</span></td>
                                        <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>
                                    </tr>

                                    <tr v-for="widget in widgets">
                                        <td width="20">
                                            <span>
                                                <label class="custmo_checkbox pull-left">
                                                    <input type="checkbox" :checked="deletedItems.indexOf(widget.id)>-1" @change="addtoDeleteCollection(widget.id, $event.target)">
                                                    <span class="custmo_checkmark blue"></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td @click="navigateToOnsiteWidgetSetup(widget.id)" style="cursor:pointer;">
                                            <span class="table-img mr15">
                                                <span class="circle_icon_24 " :class="widget.status  == '1'? 'bkg_reviews_400' : 'bkg_light_800'">
                                                    <img width="14" src="assets/images/review_arrow.svg">
                                                </span>
                                            </span> {{capitalizeFirstLetter(setStringLimit(widget.widget_title, 20))}}</td>
                                        <td><img src="assets/images/arrow-down-circle-line.svg"/> &nbsp;
                                            <span v-if="widget.widget_type == 'cpw'">Center Popup</span>
                                            <span v-else-if="widget.widget_type == 'vpw'">Vertical Popup</span>
                                            <span v-else-if="widget.widget_type == 'bww'">Button Widget Popup</span>
                                            <span v-else-if="widget.widget_type == 'bfw'">Bottom Fixed Popup</span>
                                            <span v-else-if="widget.widget_type == 'rfw'">Embedded Reviews</span>
                                            <span v-else>Collect Review</span>
                                        </td>
                                        <td>{{ widget.totalViews>0 ?  widget.totalViews : ''}}</td>
                                        <td>{{ widget.totalViews>0 ?  widgetStats(widget).click : ''}}</td>
                                        <td>{{ widget.totalViews>0 ?  widgetStats(widget).helpful : ''}}</td>
                                        <td><template v-if="widget.totalViews>0"><span class="mr-2"><img src="assets/images/emojie-eye-face-l.svg"></span>4.5</template></td>
                                        <td>{{ displayDateFormat('M d, Y', widget.created) }}</td>
                                        <td>
                                            <template v-if="widget.status  == '1'">
                                                <span class="mr-3">
                                                    <span class="status_icon bkg_green_300"></span>
                                                </span>Active
                                            </template>
                                            <template v-else-if="widget.status  == '2'">
                                                <span class="mr-3">
                                                    <span class="status_icon bkg_light_800"></span>
                                                </span>Disable
                                            </template>
                                            <template v-else-if="widget.status  == '3'">
                                                <span class="mr-3">
                                                    <span class="status_icon bkg_light_800"></span>
                                                </span>Archived
                                            </template>
                                            <template v-else>
                                                <span class="mr-3">
                                                    <span class="status_icon bkg_light_800"></span>
                                                </span>Draft
                                            </template>
                                        </td>
                                        <td>
                                            <div class="float-right">
                                                <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
                                                    <span><img src="assets/images/more-2-fill.svg"></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareUpdate(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                                    <a v-if="(widget.status == '0' || widget.status == '2') && widget.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Start</a>
                                                    <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Pause</a>
                                                    <a v-if="widget.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                                    <a class="dropdown-item viewECode" href="javascript:void(0);" :widgetID="widget.id"><i class="dripicons-user text-muted mr-2"></i> Get Embedded Code</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" @click="navigateStats(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Statistics</a>
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
                                    :offset="4">
                                </pagination>

                            </div>
                        </div>

                        <div class="col-md-12 text-center mt-3">
                            <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT WIDGETS</a>
                        </div>
                    </div>

                </div>

                <div v-else class="container-fluid">
                    <div  class="row">
                        <div class="col-md-12">
                            <div class="card card_shadow min-h-280 pt50 pb50">
                                <div class="row mb65">
                                    <div class="col-md-12 text-center">
                                        <img class="mt40" style="max-width: 250px; " src="assets/images/review_widget.svg">
                                        <h3 class="htxt_bold_18 dark_700 mt30">No widget yet. Create a new one!</h3>
                                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import widget!</h3>
                                        <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 js-onsite-widget-slidebox2">Create new widget</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 text-center mt-3">
                            <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT widget</a>
                        </div>

                    </div>
                </div>


            </div>
            <!--******************
              Content Area
             **********************-->

            <!--******************
              Create Sliding Smart Popup
             **********************-->
            <div class="box js-onsite-widget" style="width: 424px;">
                <div style="width: 424px;overflow: hidden; height: 100%;">
                    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-onsite-widget-slidebox2"><i class=""><img src="assets/images/cross.svg"/></i></a>
                        <form method="post" @submit.prevent="processForm">
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Onsite Widget</h3>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="campaignName">Widget name</label>
                                            <input type="text" class="form-control h56" id="campaignName" placeholder="Enter campaign name" name="campaignName"
                                                   v-model="form.campaignName">
                                        </div>
                                    </div>
                                </div>

                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                        <input type="hidden" name="module_account_id" id="module_account_id"
                                               :value="moduleAccountID">
                                        <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                        <a class="blue_300 fsize16 fw600 ml20 js-onsite-widget-slidebox2" href="javascript:void(0);">Close</a> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="viewEModel" class="modal fade in">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Embedded Widget Code</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12" id="embeddedCode" style="border:1px #ccc solid; padding:10px; margin:0 5px 10px;"></div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Onsite Widgets - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                pageRendered: false,
                form: {
                    campaignName: '',
                },
                formLabel: 'Create',



                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                allData: '',
                widgets: '',
                current_page: 1,
                items_per_page:10,
                bActiveSubsription: '',
                oStats: '',
                user_role: '',
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
                this.widgets.forEach(req => {
                    let idx = this.deletedItems.indexOf(req.id);
                    if(idx == -1){
                        notFound = true;
                    }
                });
                return notFound === true ? false : true;
            }
        },
        methods: {
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    let actionName = (this.sortBy == 'archive') ? 'delete' : 'archive';
                    let msg = (this.sortBy == 'archive') ? 'permanently delete' : 'archive';
                    if(confirm('Are you sure you want to '+msg+' selected item(s)?')){
                        this.showLoading(true);
                        axios.post('/admin/brandboost/deleteWidgets', {_token:this.csrf_token(), multipal_id:this.deletedItems, action: actionName})
                            .then(response => {
                                this.showLoading(false);
                                this.deletedItems = [];
                                this.loadPaginatedData();
                            });
                    }
                }
            },
            addtoDeleteCollection: function(itemId, elem){
                if(itemId == 'all') {
                    if(elem.checked){
                        if(this.widgets.length>0){
                            this.widgets.forEach(req => {
                                let idxx = this.deletedItems.indexOf(req.id);
                                if(idxx == -1){
                                    this.deletedItems.push(req.id);
                                }
                            });
                        }
                    }else{
                        this.widgets.forEach(req => {
                            let idxx = this.deletedItems.indexOf(req.id);
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
            applySort: function(sortVal){
                this.sortBy = sortVal;
                this.deletedItems = [];
            },
            widgetStats: function(widget){
                if(widget != ''){
                    let totalViews = widget.totalViews;
                    let totalClicks = widget.totalClicks;
                    let totalHelpful = widget.totalHelpful;
                    let clickRate = (totalClicks/totalViews)*100;
                    let helpRate = (totalHelpful/totalViews)*100;
                    return {
                        click: clickRate>0 ? Math.round(clickRate>99 ? 99 : clickRate)+'%' : '',
                        helpful: helpRate>0 ? Math.round(helpRate>99 ? 99 : helpRate)+'%' : ''
                    };
                }
                return {
                    click: '',
                    helpful: ''
                };
            },
            navigateToOnsiteWidgetSetup(wId) {
                window.location.href = '#/widgets/onsite/setup/'+wId+'/1';
            },
            navigateStats(wId) {
                window.location.href = '#/widgets/onsite/stats/'+wId+'/4';
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                //document.querySelector('.js-onsite-widget-slidebox2').click();
            },
            prepareUpdate: function(wId) {
                this.navigateToOnsiteWidgetSetup(wId);
            },
            getInfo: function(wId){
                axios.post('/admin/lists/getList', {
                    wid:wId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.campaignName = formData.campaignName;
                            this.form.wid = formData.wid;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.showLoading(true);
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.wid>0){
                    formActionSrc = '/admin/lists/updatePeopleList';
                }else{
                    formActionSrc = '/admin/brandboost/addOnsiteWidget';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            this.form.wid ='';
                            document.querySelector('.js-onsite-widget-slidebox2').click();
                            this.displayMessage('success', 'Action completed successfully.');

                            this.navigateToOnsiteWidgetSetup(response.data.widgetID);

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
            loadPaginatedData: function () {
                this.showLoading(true);
                //getData
                axios.get('/admin/brandboost/widgets?items_per_page='+this.items_per_page+ '&page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.allData = response.data.allData;
                        this.widgets = response.data.oWidgetsList;
                        this.oStats = response.data.oStats;
                        this.bActiveSubsription = response.data.bActiveSubsription;
                        this.user_role = response.data.user_role;
                        this.pageRendered = true;
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            showPaginationItemsPerPage: function(p){
                this.showLoading(true);
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function (p) {
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(wID, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/updateOnsiteWidgetStatus', {
                        widgetID:wID,
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
            deleteItem: function(wId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/delete_brandboost_widget', {
                        widget_id:wId,
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

    $(document).ready(function () {
        $(document).on('click', '.js-onsite-widget-slidebox2', function () {
            $(".js-onsite-widget").animate({
                width: "toggle"
            });
        });

        /*$('[name=tags]').tagify();*/

        $(document).on('click', '.viewECode', function () {
            var widgetID = $(this).attr('widgetID');
            $.ajax({
                url: 'admin/brandboost/getOnsiteWidgetEmbedCode',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {widget_id: widgetID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var embeddedCode = data.result;
                        $('#embeddedCode').html(embeddedCode);
                        $("#viewEModel").modal();
                    }
                }
            });
        });

    });
</script>
