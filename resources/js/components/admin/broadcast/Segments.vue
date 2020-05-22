<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">People Segment</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-segment-slidebox"> New Segment<span><img
                            src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--******************
         Content Area
        **********************-->
        <div class="content-area">


            <div class="container-fluid">
                <div class="table_head_action">
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
                <div v-if="(segments.length > 0 || searchBy.length > 0)">

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
                                        <td><span class="fsize10 fw500">SEGMENTS </span></td>
                                        <td><span class="fsize10 fw500">CONTACTS</span></td>
                                        <td><span class="fsize10 fw500">FILTERS</span></td>
                                        <td><span class="fsize10 fw500">UPDATE <img src="assets/images/arrow-down-line-14.svg"/> </span></td>
                                        <td><span class="fsize10 fw500">STATUS</span></td>
                                        <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"/></span></td>
                                    </tr>



                                    <tr v-for="segment in segments">
                                        <td width="20">
                                            <span>
                                            <label class="custmo_checkbox pull-left">
                                                <input type="checkbox" :checked="deletedItems.indexOf(segment.id)>-1" @change="addtoDeleteCollection(segment.id, $event.target)">
                                                <span class="custmo_checkmark blue"></span>
                                            </label>
                                        </span>
                                        </td>
                                        <td @click="showSegmentSubscribers(segment.id)" style="cursor:pointer;">
                                            <span class="table-img mr15">
                                                <span class="circle_icon_24 bkg_blue_200"><img src="assets/images/pie_chart_fill_12.svg"/></span>
                                            </span> {{capitalizeFirstLetter(setStringLimit(segment.segment_name, 20))}}
                                        </td>
                                        <td>
                                            <span v-if="segment.segmentSubscribers.data.length > 0" @click="showSegmentSubscribers(segment.id)" style="cursor:pointer;">
                                                {{segment.segmentSubscribers.data.length}}
                                            </span>
                                            <span v-else>{{segment.segmentSubscribers.data.length}}</span>
                                        </td>
                                        <td>
                                            <span>6</span>
                                            <span class="ml-3">
                                                <a href="#"><img src="assets/images/settings-2-line.svg"/></a>
                                                <a href="#"><img src="assets/images/settings-2-line.svg"/></a>
                                                <a href="#"><img src="assets/images/settings-2-line.svg"/></a>
                                                <a href="#"><img src="assets/images/settings-2-line.svg"/></a>
                                            </span>
                                        </td>
                                        <td>{{ displayDateFormat('M d, Y',segment.created) }}</td>
                                        <td>
                                            <span v-if="segment.status == '1'"><span class="mr-3"><span class="status_icon bkg_green_300"></span></span>Active</span>
                                            <span v-else-if="segment.status == '2'"><span class="mr-3"><span class="status_icon bkg_blue_300"></span></span>Archive</span>
                                            <span v-else-if="segment.status == '3'"><span class="mr-3"><span class="status_icon bkg_blue_300"></span></span>Draft</span>
                                            <span v-else><span class="mr-3"><span class="status_icon bkg_grey_light"></span></span>Inactive</span>
                                        </td>
                                        <td>
                                            <div class="float-right">
                                                <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown">
                                                    <span><img src="assets/images/more-2-fill.svg"/></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a v-if="segment.status != '2'" class="dropdown-item" href="javascript:void(0);" @click="moveArchive(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareSegmentUpdate(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" @click="syncContacts(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Sync</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteSegment(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
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
                            <a href="javascript:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"/> &nbsp; LEARN MORE ABOUT PEOPLE</a>
                        </div>
                    </div>

                    <div class="row" v-if="viewType == 'Grid View'">
                        <div v-for="segment in segments" class="col-md-3 d-flex">
                            <div class="card p0 pt40 text-center animate_top col">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/more-2-fill.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a v-if="segment.status != '2'" class="dropdown-item" href="javascript:void(0);" @click="moveArchive(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareSegmentUpdate(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="syncContacts(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Sync</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteSegment(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                    </div>
                                </div>
                                <!--<a v-if="segment.segmentSubscribers.data.length > 0" @click="showSegmentSubscribers(segment.id)" href="javascript:void(0);" class="circle-icon-64 bkg_brand_000 m0auto"><img src="assets/images/filter-3-f.svg"> </a>
                                <a v-else href="javascript:void(0);" class="circle-icon-64 bkg_light_600 m0auto"><img src="assets/images/filter-3-f.svg"> </a>-->
                                <a @click="showSegmentSubscribers(segment.id)" href="javascript:void(0);" class="circle-icon-64 bkg_brand_000 m0auto"><img src="assets/images/filter-3-f.svg"> </a>
                                <div v-if="segment.segmentSubscribers.data.length > 0" @click="showSegmentSubscribers(segment.id)" style="cursor:pointer;">
                                    <h3 class="htxt_bold_16 dark_700 mb-1 mt-4">{{capitalizeFirstLetter(setStringLimit(segment.segment_name, 20))}}, USA, 25+</h3>
                                    <p class="fsize11 fw500 dark_200 text-uppercase mb30 ls_4">
                                        {{capitalizeFirstLetter(segment.source_module_name)}}
                                    </p>
                                </div>
                                <div v-else @click="showSegmentSubscribers(segment.id)" style="cursor:pointer;">
                                    <h3 class="htxt_bold_16 dark_700 mb-1 mt-4">{{capitalizeFirstLetter(setStringLimit(segment.segment_name, 20))}}, USA, 25+</h3>
                                    <p class="fsize11 fw500 dark_200 text-uppercase mb30 ls_4">
                                        {{capitalizeFirstLetter(segment.source_module_name)}}
                                    </p>
                                </div>
                                <!--<p v-if="segment.campaignCollection" v-for="campaign in segment.campaignCollection" v-html="campaign">{{ campaign }}</p>-->
                                <div class="p20 btop">
                                    <ul class="workflow_list">
                                        <li v-if="segment.segmentSubscribers.data.length > 0" @click="showSegmentSubscribers(segment.id)" style="cursor:pointer;">
                                            <a href="javascript:void(0);"><span><img src="assets/images/account-circle-fill-grey.svg" title="Subscribers"></span> {{segment.segmentSubscribers.data.length}}</a>
                                        </li>
                                        <li v-else>
                                            <a href="javascript:void(0);"><span><img src="assets/images/account-circle-fill-grey.svg" title="Subscribers"></span> {{segment.segmentSubscribers.data.length}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--<div v-for="segment in segments" class="col-md-3 text-center">
                            <div class="card p30 h235 animate_top">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a v-if="segment.status != '2'" class="dropdown-item" href="javascript:void(0);" @click="moveArchive(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareSegmentUpdate(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteSegment(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="syncContacts(segment.id)"><i class="dripicons-user text-muted mr-2"></i> Sync</a>
                                    </div>
                                </div>
                                <div>
                                    <div v-if="segment.segmentSubscribers.data.length > 0" @click="showSegmentSubscribers(segment.id)" style="cursor:pointer;">
                                        <img src="/assets/images/subs-icon_big.svg">
                                        <h3 class="htxt_bold_16 dark_700 mt25 ">
                                            {{capitalizeFirstLetter(setStringLimit(segment.segment_name, 20))}}
                                        </h3>
                                        <p v-if="segment.status == '2'"><em>(Archived)</em></p>
                                        <p v-else><em>(Active)</em></p>
                                    </div>
                                    <div v-else>
                                        <img src="/assets/images/subs-icon_big.svg">
                                        <h3 class="htxt_bold_16 dark_700 mt25 ">
                                            {{capitalizeFirstLetter(setStringLimit(segment.segment_name, 20))}}
                                        </h3>
                                        <p v-if="segment.status == '2'"><em>(Archived)</em></p>
                                        <p v-else><em>(Active)</em></p>
                                    </div>
                                    <p v-if="segment.campaignCollection" v-for="campaign in segment.campaignCollection" v-html="campaign">{{ campaign }}</p>
                                    <p v-if="segment.segmentSubscribers.data.length > 0" class="htxt_regular_12 dark_300 mb15" @click="showSegmentSubscribers(segment.id)" style="cursor:pointer;">
                                        <i><img src="/assets/images/user_16_grey.svg" title="Subscribers"/></i>
                                        {{segment.segmentSubscribers.data.length}}
                                    </p>
                                    <p v-else class="htxt_regular_12 dark_300 mb15">
                                        <i><img src="/assets/images/user_16_grey.svg" title="Subscribers"/></i>
                                        {{segment.segmentSubscribers.data.length}}
                                    </p>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-3 d-flex js-segment-slidebox" style="cursor: pointer;">
                            <div class="card p0 pt40 text-center animate_top col">

                                <a href="#" class="circle-icon-64 bkg_light_200 m0auto mt-4"><img src="assets/images/plus03.svg"> </a>
                                <p class="fsize11 fw500 dark_200 text-uppercase mb30 ls_4 mt-4">CREATE new <br> SEGMENT</p>

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

                <div class="row" v-else>
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-12 text-left">
                                    <a class="lh_32 blue_400 htxt_bold_14" href="javascript:void(0);">
                                        <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
                                        Import segment
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="assets/images/segment_bkg.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No segments yet. Create a new one!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import segment!</h3>
                                    <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-segment-slidebox">Add segment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <a href="javascropt:void(0);" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"/> &nbsp; LEARN MORE ABOUT PEOPLE</a>
                    </div>
                </div>
            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->

        <!-- Smart Slide Popup -->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon js-segment-slidebox"><i
                    class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                        <div class="p40">
                            <div class="row">
                                <div class="col-md-12"><img src="assets/images/tag.svg"/>
                                    <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Segment </h3>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Segment name</label>
                                        <input type="text" class="form-control h56" id="fname"
                                               placeholder="Enter segment name" name="segmentName"
                                               v-model="form.segmentName">
                                    </div>
                                    <div class="form-group">
                                        <label for="phonenumber">Color</label>
                                        <div class="phonenumber">
                                            <div class="colorbox">
                                                <div class="colorpickerplus-dropdown" id="color_picker">
                                                    <button type="button" class="dropdown-toggle pickerbutton"
                                                            data-toggle="dropdown">
                                                        <span class="color-fill-icon dropdown-color-fill-icon"></span>
                                                        &nbsp; Pick a Color &nbsp; <b class="caret"></b></button>
                                                    <ul class="dropdown-menu">
                                                        <li class="disabled">
                                                            <div class="colorpickerplus-container"></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc"
                                                  placeholder="List description" name="segmentDescription"
                                                  v-model="form.segmentDescription"></textarea>
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
                                    <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">
                                        {{ formLabel }}
                                    </button>
                                    <a class="blue_300 fsize16 fw600 ml20 js-segment-slidebox" href="javascript:void(0);">Close</a></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import Pagination from '@/components/helpers/Pagination';
    export default {
        props: ['pageColor'],
        components: {Pagination},
        data() {
            return {
                form: {
                    segmentName: '',
                    segmentDescription: '',
                    segment_id: ''
                },
                formLabel: 'Create',

                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                current_page: 1,
                items_per_page: 10,
                allData: '',
                segments: '',
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
                this.segments.forEach(camp => {
                    let idx = this.deletedItems.indexOf(camp.id);
                    if(idx == -1){
                        notFound = true;
                    }
                });
                return notFound === true ? false : true;
            }
        },
        methods: {
            applySort: function(sortVal){
                this.showLoading(true);

                this.sortBy = sortVal;
                this.deletedItems = [];
            },
            deleteSelectedItems: function(){
                if(this.deletedItems.length>0){
                    if(confirm('Are you sure you want to delete selected item(s)?')){
                        this.showLoading(true);
                        axios.post('/admin/broadcast/deleteMultipalSegment', {_token:this.csrf_token(), multiSegmentid:this.deletedItems})
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
                        if(this.segments.length>0){
                            this.segments.forEach(camp => {
                                let idxx = this.deletedItems.indexOf(camp.id);
                                if(idxx == -1){
                                    this.deletedItems.push(camp.id);
                                }
                            });
                        }
                    }else{
                        this.segments.forEach(camp => {
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
                document.querySelector('.js-segment-slidebox').click();
            },
            prepareSegmentUpdate: function(segmentId) {
                this.getSegmentInfo(segmentId);
            },
            getSegmentInfo: function(segmentID){
                axios.post('/admin/broadcast/getSegment', {
                    segment_id:segmentID,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.segmentName = formData.title;
                            this.form.segmentDescription = formData.description;
                            this.form.segment_id = formData.segment_id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }
                    });
            },
            processForm : function(){
                this.showLoading(true);
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.segment_id>0){
                    formActionSrc = '/admin/broadcast/updatePeopleSegment';
                }else{
                    formActionSrc = '/admin/broadcast/makeSegment';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            //this.form = {};
                            this.form.segment_id ='';
                            document.querySelector('.js-segment-slidebox').click();
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
            loadPaginatedData: function () {
                axios.get('/admin/broadcast/mysegments?page=' + this.current_page + '&items_per_page='+this.items_per_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.segments = response.data.oSegments;
                        this.allData = response.data.allData;
                    });
            },
            showSegmentSubscribers: function(segmentId){
                window.location.href='#/contacts/segments/subscribers/'+segmentId;
            },
            submitAddSegment: function () {
                this.showLoading(true);
                axios.post('/admin/broadcast/makeSegment', this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            this.displayMessage('success', 'Segment Added successfully');
                            this.form = {};
                            this.showPaginationData(this.current_page);
                        }
                    })
                    .catch(error => {
                        this.showLoading(false);
                        //error.response.data
                        alert('All form fields are required');
                    });
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
            navigatePagination: function (p) {
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            deleteSegment: function(segmentID) {
                if(confirm('Are you sure you want to delete this segment?')){
                    //Do axios
                    axios.post('/admin/broadcast/deleteSegment', {
                        segmentID:segmentID,
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
            moveArchive: function(segmentID) {
                if(confirm('Are you sure you want to move this segment to archive?')){
                    //Do axios
                    axios.post('/admin/broadcast/archive_multipal_segment', {
                        multi_segment_id:segmentID,
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
            syncContacts: function(segmentID) {
                if(confirm('Are you sure you want to perform this action?')){
                    this.showLoading(true);
                    //Do axios
                    axios.post('/admin/segments/syncSegment', {
                        segmentID:segmentID,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showLoading(false);
                                this.displayMessage('success', 'Segment contacts have been synced successfully!');
                            }

                        })
                        .catch(error => {
                            this.showLoading(false);
                            //error.response.data
                            alert('Something went wrong.');
                        });
                }
            }
        }
    };


    $(document).ready(function () {
        $(document).on('click', '.js-segment-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });
    });
</script>
