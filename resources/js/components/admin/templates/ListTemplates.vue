<template>

    <div>

        <!--Top Heading area-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Email Templates</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/emailfilter.svg"/></button>
                        <button class="btn btn-md bkg_email_300 light_000 js-email-templates-slidebox"> Create new <span style="opacity: 0.3"><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--Content Area-->
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>

            <div class="container-fluid" v-if="!hasData">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 email_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_email_000 mr10"><img src="/assets/images/download-fill-email.svg"/></span>
                                        Import template
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="/assets/images/question-line.svg"/></span>
                                        Learn how to use email templates
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="/assets/images/email-template.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No templates so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import templates!</h3>
                                    <button class="btn btn-sm bkg_email_000 pr20 email_400 js-email-templates-slidebox">Add template</button>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>


            </div>

            <div class="container-fluid" v-else>
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">Email Templates</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/list_view.svg"/></span>&nbsp; Cards
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Serch" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-3 d-flex" v-for="template in templates">
                        <div class="card p-1 text-center pb0 animate_top col">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Clone</a>
                                    <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> Preview</a>
                                    <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Delete</a></div>
                            </div>
                            <div class="email_temp_img_box">
                                <img style="width:256px;height:220px;" :src="template.thumbnail ? template.thumbnail : '/assets/images/temp_prev9.png'"/>
                            </div>
                            <div class="email_temp_txt p-3">
                                <p class="htxt_regular_14 dark_800 mb-2">{{capitalizeFirstLetter(template.template_name)}}</p>
                                <p class="dark_200 fsize11 fw500 text-uppercase m-0">{{template.category_name ? template.category_name : 'Uncategorized'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center d-flex">
                        <div class="card p30 animate_top col">
                            <img class="mt20 mb30" src="/assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>new template</p>
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



        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-email-templates-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/email_temp_icons.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create Email Template </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form action="/action_page.php">
                                    <div class="form-group">
                                        <label for="fname">Form name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter name" name="fname">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Categories</label>
                                        <select class="form-control h56">
                                            <option>--Select--</option>
                                            <template v-for="category in categories">
                                                <option v-if="category.status=1"  :value="category.id"> {{category.category_name}}</option>
                                            </template>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Template description"></textarea>
                                    </div>



                                </form>
                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_email_400 light_000 pr20 min_w_160 fsize16 fw600">Create</button>
                                <a class="dark_300 fsize16 fw400 ml20" href="#">Close</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<!--<template>
        <div class="content">

            &lt;!&ndash;&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&&ndash;&gt;
            <div class="page_header">
                <div class="row">
                    &lt;!&ndash;=============Headings & Tabs menu==============&ndash;&gt;
                    <div class="col-md-3 mt20">
                        <h3><img src="/assets/images/people_sec_icon.png"> {{ title }}</h3>

                    </div>
                    &lt;!&ndash;=============Button Area Right Side==============&ndash;&gt;
                    <div class="col-md-9 text-right btn_area">
                        <button type="button" class="btn dark_btn dropdown-toggle ml10 addUserTemplate"
                                :template-type="type"><i class="icon-plus3"></i><span> &nbsp;  Add Template</span>
                        </button>

                    </div>
                </div>
            </div>
            &lt;!&ndash;&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&&ndash;&gt;

            <div class="tab-content">
                <email-templates :pageColor="pageColor" v-if="type == 'email'"></email-templates>
                <sms-templates :pageColor="pageColor" v-if="type == 'sms'"></sms-templates>
            </div>
        </div>


</template>-->

<script>
    import Pagination from '../../helpers/Pagination';

    export default {
        props: ['title', 'type'],
        components: {Pagination},
        data(){
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                hasData : true,
                templates: {},
                categories: {},
                method: '',
                selected_template: '',
                userid: '',
                source: '',
                current_page: 1,
                allData: ''
            }
        },
        mounted() {
            this.makeBreadcrumb(this.breadcrumb);
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData: function () {
                axios.post('/admin/templates/getCategorizedTemplates?page=' + this.current_page, {'action':'my', 'campaign_type':'email', 'method': 'manage'})
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.templates = response.data.oTemplates;
                        this.categories = response.data.oCategories;
                        this.method = response.data.method;
                        this.userid = response.data.userID;
                        this.allData = response.data.allData;
                        this.loading = false;
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
        }
    };

    $(document).ready(function () {
        $(document).on('click', '.js-email-templates-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });

</script>

