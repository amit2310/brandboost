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
                        <h3 class="htxt_medium_24 dark_700">Tag Groups</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-tag-group-slidebox">New Tag Group<span><img src="assets/images/blue-plus.svg"/></span></button>
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


                <div v-if="!oTagGroups" class="row">
                        <div class="col-md-12">
                            <div class="card card_shadow min-h-280">

                                <div class="row mb65">
                                    <div class="col-md-6 text-left">
                                        <a class="lh_32 blue_400 htxt_bold_14" href="#">
                                            <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
                                            Import Tag
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="lh_32 htxt_regular_14 dark_200" href="#">
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
                                        <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-tag-group-slidebox">Add New Tag Group</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                <div v-else>
                    <div class="table_head_action">
                    <div class="row">
                    <div class="col-md-6">
                        <h3 class="htxt_medium_16 dark_400">{{ oTagGroups.length }} Tags</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="table_action">
                            <div class="float-right">
                                <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                    <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item" href="#">Link 3</a>
                                </div>
                            </div>
                            <div class="float-right ml10 mr10">
                                <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                    <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item" href="#">Link 3</a>
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
                    <div v-for="oTagGroup in oTagGroups" class="col-md-3 text-center">
                        <div class="card p30 h235 animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteTagGroup(oTagGroup.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <div @click="showTags(oTagGroup.id)" style="cursor:pointer;">
                                <img class="mt20" src="assets/images/tag_icon_circle.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    {{capitalizeFirstLetter(setStringLimit(oTagGroup.group_name, 20))}}
                                </h3>
                                <p class="htxt_regular_12 dark_300 mb15"><em> Created On: {{ displayDateFormat('M d, h:i A', oTagGroup.group_created) }} </em></p>
                                <p class="htxt_regular_12 dark_300 mb15"><em> {{ oTagGroup.status == 1 ? 'Active' : 'Inactive' }} </em></p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 text-center js-tag-group-slidebox" style="cursor: pointer;">
                        <div class="card p30 bkg_none border_dashed shadow_none h235 animate_top">
                            <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>New Tag Group</p>
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
                    <a class="cross_icon js-tag-group-slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="submitAddTagGroup">
                        <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="assets/images/tag.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create New Tag Group</h3>
                                <hr>
                            </div>
                            <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="fname">Tag Group name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter tag name" name="txtGroupName"
                                               v-model="form.txtGroupName">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Tag Group Description"
                                                  name="description"
                                                  v-model="form.description"></textarea>
                                    </div>


                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Create</button>
                                <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a>
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
                    txtGroupName: '',
                    description: ''
                },



                current_page: 1,
                oTagGroups: '',
                allData: ''
            }
        },
        mounted() {
            this.loadPaginatedData();

            console.log('Component mounted.');
        },
        methods: {
            showTags: function(groupId){
                window.location.href='#/tags/'+groupId;
            },
            loadPaginatedData: function () {
                axios.get('/admin/tags/groups?page=' + this.current_page)
                    .then(response => {
                        this.showLoading(false);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        //console.log(response.data);
                        this.allData = response.data.allData;
                        this.oTagGroups = response.data.aTagGroups;
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            navigatePagination: function (p) {
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            submitAddTagGroup: function () {
                this.showLoading(true);
                axios.post('/admin/tags/addgroup', this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            this.displayMessage('success', 'Tag Group Added successfully.');
                            this.form = {};
                            this.showPaginationData(this.current_page);
                        } else if (response.data.status == 'error') {
                            if (response.data.type == 'duplicate_entry') {
                                this.showLoading(false);
                                this.displayMessage('error', 'Group name already exists.');
                            } else {
                                this.showLoading(false);
                                this.displayMessage('error', 'Something went wrong.');
                            }
                        }
                    })
                    .catch(error => {
                        this.showLoading(false);
                        //error.response.data
                        alert('All form fields are required');
                    });
            },
            deleteTagGroup: function(groupId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/tags/deleteTagGroup', {
                        id:groupId,
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
        $(document).on('click', '.js-tag-group-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });
    });


</script>

