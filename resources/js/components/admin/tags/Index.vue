<template>
    <div class="content" id="masterContainer">
        <!--******************
        Top Heading area
        **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Tag Reviews</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-tag-slidebox">New Tag <span><img src="assets/images/blue-plus.svg"/></span></button>
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
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                <loading :isLoading="loading"></loading>
                <div v-if="!oTags" class="row">
                        <div class="col-md-12">
                            <div class="card card_shadow min-h-280">
                                <div class="row mb65">
                                    <div class="col-md-6 text-left">
                                        <a class="lh_32 blue_400 htxt_bold_14" href="javascript:void(0);">
                                            <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
                                            Import Tag
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="lh_32 htxt_regular_14 dark_200" href="javascript:void(0);">
                                            <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                            Learn how to use Tag
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb65">
                                    <div class="col-md-12 text-center">
                                        <img class="mt40" style="max-width: 225px; " src="assets/images/tag_Frame.svg">
                                        <h3 class="htxt_bold_18 dark_700 mt30">No tags so far. But you can change it!</h3>
                                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import tags!</h3>
                                        <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-tag-slidebox">Add New Tag</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div v-else>
                    <div class="table_head_action">
                    <div class="row">
                    <div class="col-md-6">
                        <h3 class="htxt_medium_16 dark_400">{{ allData.total }} Tags</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="table_action">
                            <div class="float-right">
                                <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                    <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
                                </div>
                            </div>
                            <div class="float-right ml10 mr10">
                                <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                    <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
                                </div>
                            </div>
                            <div class="float-right">
                                <input class="table_search" type="text" placeholder="Search" />
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div v-for="oTag in oTags" class="col-md-3 text-center">
                        <div class="card p30 h235 animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteTagGroupEntity(oTag.tagid)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <div v-if="oTagSubscribers[oTag.tagid] > 0" @click="showTagSubscribers(oTag.tagid)" style="cursor:pointer;">
                                <img class="mt20" src="assets/images/tag_icon_circle.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    {{capitalizeFirstLetter(setStringLimit(oTag.tag_name, 20))}}
                                </h3>
                                <p class="htxt_regular_12 dark_300 mb15"><i><img src="assets/images/user_16_grey.svg"/></i> {{ oTagSubscribers[oTag.tagid] }}</p>
                            </div>
                            <div v-else>
                                <img class="mt20" src="assets/images/tag_icon_circle.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    {{capitalizeFirstLetter(setStringLimit(oTag.tag_name, 20))}}
                                </h3>
                                <p class="htxt_regular_12 dark_300 mb15"><i><img src="assets/images/user_16_grey.svg"/></i> {{ oTagSubscribers[oTag.tagid] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center js-tag-slidebox" style="cursor: pointer;">
                        <div class="card p30 bkg_none border_dashed shadow_none h235 animate_top">
                            <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>Tag list</p>
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
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
                    <a class="cross_icon js-tag-slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="submitAddTagReview">
                        <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="assets/images/tag.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create Tag </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Tag name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter tag name" name="tagReviewName"
                                               v-model="form.tagReviewName">
                                    </div>
                                    <div class="form-group">
                                        <label for="phonenumber">Tag Group</label>
                                        <select class="form-control" name="tagGroupId" v-model="form.tagGroupId" placeholder="Please Select">
                                           <option value="" disabled hidden>Please Select</option>
                                           <option v-for="oGroupID in oGroupIDs" :value="oGroupID.id">{{ oGroupID.group_name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Tag Review Description"
                                                  name="tagReviewDescription"
                                                  v-model="form.tagReviewDescription"></textarea>
                                    </div>
                            </div>
                        </div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Create</button>
                                <a class="blue_300 fsize16 fw600 ml20" href="javascript:void(0);">Close</a>
                            </div>
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
        title: 'Insight Tags - Brand Boost',
        props: ['pageColor'],
        components: {Pagination},
        data() {
            return {
                form: {
                    tagReviewName: '',
                    tagReviewDescription: ''
                },
                successMsg: '',
                errorMsg: '',
                loading: true,
                current_page: 1,
                oTags: '',
                oGroupIDs : '',
                oTagSubscribers : '',
                allData: ''
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            showTagSubscribers: function(tagId){
                window.location.href='#/contacts/tags/subscribers/'+tagId;
            },
            loadPaginatedData: function () {
                axios.get('/admin/tags/?page=' + this.current_page)
                    .then(response => {
                        this.loading = false;
                        //console.log(response.data);
                        this.allData = response.data.allData;
                        this.oGroupIDs = response.data.aGroupID;
                        this.oTagSubscribers = response.data.aTagSubscribers;
                        this.oTags = response.data.aTag;
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            submitAddTagReview: function () {
                this.loading = true;
                axios.post('/admin/tags/addTagReviews', this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.loading = false;
                            this.successMsg = 'New Tag Added successfully';
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
            deleteTagGroupEntity: function(tagId) {
                if(confirm('Are you sure you want to delete this tag?')){
                    //Do axios
                    axios.post('/admin/tags/deleteTagGroupEntity', {
                        id:tagId,
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
    $(document).ready(function(){
        $(document).on('click', '.js-tag-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });
    });
</script>
