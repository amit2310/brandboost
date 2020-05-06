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
                        <h3 class="htxt_medium_24 dark_700">Tags Feedback</h3>
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

                <loading :isLoading="loading"></loading>
                <div v-if="!otagData" class="row">{{otagData.length}}
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 blue_400 htxt_bold_14" href="#">
                                        &nbsp;
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                        Learn how to use Tag Reviews
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="assets/images/tag_Frame.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No tag reviews so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import tag reviews!</h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div v-else>
                    <div class="table_head_action">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="htxt_medium_16 dark_400">{{ otagData.length }} Tags</h3>
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
                        <div v-for="oTag in otagData" class="col-md-3 text-center">
                            <div class="card p30 h235 animate_top">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(oTag.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                    </div>
                                </div>
                                <div>
                                    <img class="mt20" src="assets/images/tag_icon_circle.svg">
                                    <h3 class="htxt_bold_16 dark_700 ">
                                        {{ capitalizeFirstLetter(setStringLimit(oTag.tag_name, 20)) }}
                                    </h3>
                                    <p class="htxt_regular_12 dark_300 mt25 mb15" @click="showTags(oTag.group_id)" style="cursor:pointer;">
                                        <em> Tag Group: <strong>{{ capitalizeFirstLetter(setStringLimit(oTag.group_name, 20)) }}</strong> </em>
                                    </p>
                                    <p class="htxt_regular_12 dark_300 mb15"><em> Created On: {{ displayDateFormat('M d, h:i A', oTag.tag_created) }} </em></p>
                                    <p class="htxt_regular_12 dark_300 mb15"><em> Feedbacks: {{ oTag.TagDataById }} </em></p>
                                </div>
                            </div>
                        </div>


                        <!--<div class="col-md-3 text-center js-tag-group-slidebox" style="cursor: pointer;">
                            <div class="card p30 bkg_none border_dashed shadow_none h235 animate_top">
                                <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                                <p class="htxt_regular_16 dark_100 mb15">Create<br>New Tag Review</p>
                            </div>
                        </div>-->

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

    </div>

</template>

<script>

    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Insight Tags Reviews - Brand Boost',
        props: ['pageColor'],
        components: {Pagination},
        data() {
            return {


                loading: true,
                current_page: 1,
                otagData: '',
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
                axios.get('/admin/tags/tagsfeedback?page=' + this.current_page)
                    .then(response => {
                        this.loading = false;
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.allData = response.data.allData;
                        this.otagData = response.data.atagData;
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
            deleteItem: function(groupId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/tags/deleteTagGroupEntity', {
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

