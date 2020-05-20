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
                                    <a class="dropdown-item" href="javascript:void(0);" @click="cloneTemplate(template.id, 'email')"><i class="dripicons-user text-muted mr-2"></i> Clone</a>
                                    <a class="dropdown-item wfEmailMyTemplates" href="javascript:void(0);" @click="displayEmailPreview(template)"><i class="dripicons-wallet text-muted mr-2"></i> Preview</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareTemplateUpdate(template.id)"><i class="dripicons-gear text-muted mr-2"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteTemplate(template.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a></div>
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

                    <div class="col-md-3 text-center d-flex js-email-templates-slidebox" style="cursor:pointer;">
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

        <email-template-popups></email-template-popups>

        <!--Smart Popup-->
        <div class="box js-email-templates-slidebox-popup" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-email-templates-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/email_temp_icons.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Email Template </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="fname">Template name</label>
                                    <input type="text" class="form-control h56" id="fname" placeholder="Enter name" name="templateName"
                                           v-model="form.templateName">
                                </div>

                                <div class="form-group">
                                    <label for="desc">Categories</label>
                                    <select class="form-control h56" name="templateCategory" v-model="form.templateCategory">
                                        <option>--Select--</option>
                                        <template v-for="category in categories">
                                            <option v-if="category.status=1"  :value="category.id"> {{category.category_name}}</option>
                                        </template>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Template description" name="templateDescription"
                                        v-model="form.templateDescription"></textarea>
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
                                <button class="btn btn-lg bkg_email_400 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                <a class="dark_300 fsize16 fw400 ml20" href="#">Close</a> </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Preview Popup-->
        <div class="box wfEmailMyTemplatesPopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon wfEmailMyTemplates"><i><img
                    src="/assets/images/cross.svg"></i></a>
                    <div class="p40">
                        <div class="row" v-html="previewTemplate"></div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20 wfEmailMyTemplates">Close</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>


<script>
    import EmailPopup from '@/components/admin/modals/templates/EmailTemplatesPopup.vue';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        props: ['title', 'type'],
        components: {Pagination, 'email-template-popups': EmailPopup},
        data(){
            return {
                form: {
                    templateName: '',
                    templateCategory: '',
                    templateType: 'email',
                    templateDescription: '',
                    templateId: ''
                },
                formLabel: 'Create',



                breadcrumb: '',
                hasData : true,
                templates: {},
                categories: {},
                method: '',
                selected_template: '',
                userid: '',
                source: '',
                current_page: 1,
                allData: '',
                previewTemplate: ''
            }
        },
        mounted() {
            this.makeBreadcrumb(this.breadcrumb);
            this.loadPaginatedData();
        },
        methods: {
            displayEmailPreview: function (data) {
                this.previewTemplate = atob(data.stripo_compiled_html);
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-email-templates-slidebox').click();
            },
            prepareTemplateUpdate: function(templateId) {
                this.getTemplateInfo(templateId);
            },
            getTemplateInfo: function(templateId){
                axios.post('/admin/templates/getTemplateInfo', {
                    templateId:templateId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.templateName = formData.templateName;
                            this.form.templateCategory = formData.templateCategory;
                            this.form.templateDescription = formData.templateDescription;
                            this.form.templateId = formData.templateId;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.showLoading(true);
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.templateId>0){
                    formActionSrc = '/admin/templates/editUserTemplate';
                }else{
                    formActionSrc = '/admin/templates/addUserTemplate';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);

                            //window.location.href='#/templates/edit/'+this.form.templateId;

                            //this.form = {};
                            this.form.templateId ='';
                            document.querySelector('.js-email-templates-slidebox').click();
                            this.displayMessage('success', 'Action completed successfully.');
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);

                            syncContactSelectionSources();
                        }
                        else if (response.data.status == 'error') {
                            if (response.data.type == 'duplicate') {
                                alert('Error: Template already exists.');
                            }
                            else {
                                alert('Error: Something went wrong.');
                            }
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
                axios.post('/admin/templates/getCategorizedTemplates?page=' + this.current_page, {'action':'my', 'campaign_type':'email', 'method': 'manage'})
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.templates = response.data.oTemplates;
                        this.categories = response.data.oCategories;
                        this.method = response.data.method;
                        this.userid = response.data.userID;
                        this.allData = response.data.allData;
                        this.showLoading(false);
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
            deleteTemplate: function(templateId) {
                if(confirm('Are you sure you want to delete this template?')){
                    //Do axios
                    axios.post('/admin/templates/deleteTemplate', {
                        templateId:templateId,
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
            cloneTemplate: function(templateId,templateType) {
                if(confirm('Are you sure you want to clone this template?')){
                    this.showLoading(true);
                    //Do axios
                    axios.post('/admin/templates/cloneTemplate', {
                        templateId:templateId,
                        templateType:templateType,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                this.showLoading(false);
                                this.displayMessage('success', 'Template cloned and saved into your templates!');
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            }
        }
    };

    $(document).ready(function () {
        $(document).on('click', '.js-email-templates-slidebox', function(){
            $(".js-email-templates-slidebox-popup").animate({
                width: "toggle"
            });
        });

        $(document).on('click', '.wfEmailMyTemplates', function () {
            $(".wfEmailMyTemplatesPopup").animate({
                width: "toggle"
            });
        });

    });

</script>

