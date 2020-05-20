<template>

    <div v-show="pageRendered==true">
        <a class="close_sidebar" href="javascript:void(0);"><!--OPEN MENU &nbsp;--> <img src="assets/images/menu-2-line.svg"></a>
        <div class="page_sidebar bkg_light_000 fixed">
            <div style="width: 279px;">
                <div class="p20 bbot top_headings">
                    <div class="row">
                        <div class="col"><p>PEOPLE</p></div>
                    </div>
                </div>

                <div class="p20 pt30 pb10">
                    <div class="row">
                        <div class="col"><h3 class="htxt_medium_24 dark_800">Segment</h3></div>
                        <div class="col text-right"><button class="circle-icon-32 shadow3 js-segment-slidebox-tab"><img src="assets/images/add-fill-review.svg"></button></div>
                    </div>
                </div>
                <div>
                    <div class="p20 top_headings">
                        <div class="row">
                            <div class="col-md-5">
                                <!--<p>
                                    <a href="#"><img src="assets/images/filter-line.svg"> &nbsp; Filter</a>
                                </p>-->
                                <a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i> &nbsp;Filter</a>
                                <div class="dropdown-menu p10 mt-1">
                                    <a href="javascript:void(0);" :class="{'active': sortBy == 'Date Created'}" @click="sortBy='Date Created'">ALL</a><br />
                                    <a href="javascript:void(0);" :class="{'active': sortBy == 'Active'}" @click="sortBy='Active'">ACTIVE</a><br />
                                    <a href="javascript:void(0);" :class="{'active': sortBy == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a><br />
                                    <a href="javascript:void(0);" :class="{'active': sortBy == 'Pending'}" @click="sortBy='Pending'">DRAFT</a><br />
                                    <a href="javascript:void(0);" :class="{'active': sortBy == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a><br />
                                </div>
                            </div>
                            <div class="col-md-7 text-right">
                                <a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a>
                                <!--<input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">-->
                                <a href="javascript:void(0);" title="List View"><i><img src="assets/images/sort_16_grey.svg"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class=" datasearcharea shadow3">
                        <div class="row form-group m-0 position-relative">
                            <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                            <a class="search_tables_open_close searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
                        </div>
                    </div>
                </div>
                <div v-if="segments.length > 0 || searchBy.length>0">
                    <div class="p20 pt0 pb0 bkg_light_050">
                        <div v-if="(items_per_page > 10 || items_per_page == 'All')" style="overflow:auto; height:700px">
                            <ul class="list_with_icons3">
                                <li v-for="segment in segments" :key="segment.id" class="d-flex" :class="{ active : profileID == segment.id }">
                                    <span>
                                        <span v-if="segment.segmentSubscribers.data.length > 0" class="circle_icon_24 bkg_blue_200"><img src="assets/images/folder_white_12.svg"></span>
                                        <span v-else class="circle_icon_24 bkg_review_200"><img src="assets/images/folder_white_12.svg"></span>
                                        {{capitalizeFirstLetter(setStringLimit(segment.segment_name, 20))}}
                                    </span>
                                    <strong v-if="segment.segmentSubscribers.data.length > 0" @click="showSegmentSubscribers(segment.id)" title="Subscribers" style="cursor:pointer;">{{segment.segmentSubscribers.data.length}}</strong>
                                    <strong v-else title="Subscribers">{{segment.segmentSubscribers.data.length}}</strong>
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            <ul class="list_with_icons3">
                                <li v-for="segment in segments" :key="segment.id" class="d-flex" :class="{ active : profileID == segment.id }">
                                    <span>
                                        <span v-if="segment.segmentSubscribers.data.length > 0" class="circle_icon_24 bkg_blue_200"><img src="assets/images/folder_white_12.svg"></span>
                                        <span v-else class="circle_icon_24 bkg_blue_200 <!--bkg_review_200-->"><img src="assets/images/folder_white_12.svg"></span>
                                        {{capitalizeFirstLetter(setStringLimit(segment.segment_name, 20))}}
                                    </span>
                                    <strong v-if="segment.segmentSubscribers.data.length > 0" @click="showSegmentSubscribers(segment.id)" title="Subscribers" style="cursor:pointer;">{{segment.segmentSubscribers.data.length}}</strong>
                                    <strong v-else title="Subscribers">{{segment.segmentSubscribers.data.length}}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <pagination v-if="(allData.total > 10 || items_per_page == 'All')"
                        :pagination="allData"
                        @paginate="showPaginationData"
                        @paginate_per_page="showPaginationItemsPerPage"
                        :offset="2"
                        :lessSpace="true"
                        class="mt-4">
                    </pagination>
                </div>

                <div v-else>
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" src="assets/images/segment_bkg.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any segments</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import segment!</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT SEGMENT</a>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>


        <!-- Smart Slide Popup -->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon js-segment-slidebox-tab"><i
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
                                    <a class="blue_300 fsize16 fw600 ml20 js-segment-slidebox-tab" href="javascript:void(0);">Close</a></div>
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
    import Pagination from '@/components/helpers/PaginationLessSpace';

    export default {
        title: 'Onsite Reviews - Brand Boost',
        name: "OnsiteCampaignsTab",
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                pageRendered: false,
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                profileID: this.$route.params.id,
                company_name: '',
                count : 0,
                segments : '',
                allData: {},
                current_page: 1,
                items_per_page: 10,
                breadcrumb: '',
                form: new Form({
                    segmentName: '',
                    segmentDescription: '',
                    segment_id: ''
                }),
                formLabel: 'Create',
                sortBy: 'Date Created',
                searchBy: ''
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.profileID = this.$route.params.id;
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
        methods: {
            loadSegmentData: function(data){
                this.$emit('chooseSegment', data);
                this.profileID = data.id;
            },
            searchItem: function(){
                this.loadPaginatedData();
            },
            loadPaginatedData : function(){
                axios.get('/admin/broadcast/mysegments?items_per_page='+this.items_per_page+'&page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.company_name = response.data.company_name;
                        this.allData = response.data.allData;
                        this.segments = response.data.oSegments;
                        this.showLoading(false);
                        this.pageRendered = true;
                        //console.log(this.segments)
                    });
            },
            showPaginationData: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            showPaginationItemsPerPage: function(p){
                this.showLoading(true);
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-segment-slidebox-tab').click();
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
                this.form.post(formActionSrc, this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            //this.form = {};
                            this.form.segment_id ='';
                            document.querySelector('.js-segment-slidebox-tab').click();
                            this.displayMessage('success', 'Action completed successfully.');
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);
                            syncContactSelectionSources();
                        }
                        else if (response.data.status == 'error') {
                            if (response.data.type == 'duplicate') {
                                alert('Error: Segment already exists.');
                            }
                            else {
                                alert('Error: Something went wrong.');
                            }
                        }else{
                            this.showLoading(false);
                        }
                    })
                    .catch(error => {
                        this.showLoading(false);
                        console.log(error);
                        //error.response.data
                        alert('All form fields are required');
                    });
            }
        }
    }

    $(document).ready(function () {
        $(document).on('click', '.js-segment-slidebox-tab', function(){
            $(".box").animate({
                width: "toggle"
            });
        });
    });
</script>
