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
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>
            <div class="container-fluid">
                <div class="row" v-if="!segments">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 blue_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img
                                            src="/assets/images/download-fill.svg"/></span>
                                        Import segment
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img
                                            src="/assets/images/question-line.svg"/></span>
                                        Learn how to use segments
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="/assets/images/segment_bkg.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No segments yet. Create a new one!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import
                                        segment!</h3>
                                    <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-segment-slidebox">Add segment</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div v-else>
                    <div class="table_head_action">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="htxt_medium_16 dark_400">{{ segments.length }} Contact lists</h3>
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
                        <!--<div class="col-md-3 text-center">
                            <div class="card p30 h235 animate_top">
                                <img class="mt20" src="/assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">Subscribers List</h3>
                                <p class="htxt_regular_12 dark_300 mb15"><i><img src="/assets/images/user_16_grey.svg"/></i> 1,356</p>
                            </div>
                        </div>-->
                        <div v-for="segment in segments" class="col-md-3 text-center">
                            <div class="card p30 h235 animate_top">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
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
                        </div>

                        <div class="col-md-3 text-center js-segment-slidebox" style="cursor: pointer;">
                            <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                                <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                                <p class="htxt_regular_16 dark_100 mb15">Create<br>Segment</p>
                            </div>
                        </div>

                    </div>
                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4">
                    </pagination>


                </div>


            </div>

        </div>

        <!--******************
          Content Area End
         **********************-->

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
                                    <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a></div>
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
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                segments: '',
                current_page: 1,
                allData: ''
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
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
                this.loading = true;
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
                            this.loading = false;
                            //this.form = {};
                            this.form.segment_id ='';
                            document.querySelector('.js-segment-slidebox').click();
                            this.successMsg = 'Action completed successfully.';
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
                        alert('All form fields are required');
                    });
            },
            loadPaginatedData: function () {
                axios.get('/admin/broadcast/mysegments?page=' + this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.loading = false;
                        this.segments = response.data.oSegments;
                        this.allData = response.data.allData;

                    });
            },
            showSegmentSubscribers: function(segmentId){
                window.location.href='#/broadcast/segmentContacts/'+segmentId;
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            submitAddSegment: function () {
                this.loading = true;
                axios.post('/admin/broadcast/makeSegment', this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.loading = false;
                            this.successMsg = 'Segment Added successfully';
                            this.form = {};
                            this.showPaginationData(this.current_page);
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        //error.response.data
                        alert('All form fields are required');
                    });
            },
            navigatePagination: function (p) {
                this.loading = true;
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
                    this.loading = true;
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
                                this.loading = false;
                                this.successMsg = 'Segment contacts have been synced successfully!';
                            }

                        })
                        .catch(error => {
                            this.loading = false;
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


    /*$(document).on('click', '#addContactForm', function () {
        $('.addModuleContact').trigger('click');
    });*/

</script>



