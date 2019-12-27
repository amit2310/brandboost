<template>

    <div>

        <!--Top Heading area-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">SMS Templates</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="mr15 btn btn-md bkg_light_000 sms_400">Filters &nbsp; &nbsp; <img src="/assets/images/sms_filter.svg"></button>
                        <button class="btn btn-md bkg_sms_400 light_000 js-sms-templates-slidebox"> New template <span><img src="/assets/images/sms_add.svg"/></span></button>
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
                                    <a class="lh_32 sms_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_sms_000 mr10"><img src="/assets/images/sms-download-fill.svg"></span>
                                        Import template
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="/assets/images/question-line.svg"></span>
                                        Learn how to use sms templates
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 250px; " src="/assets/images/sms_templates.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No templates so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import templates!</h3>
                                    <button class="btn btn-sm bkg_sms_000 pr20 sms_400 js-sms-templates-slidebox">Add template</button>
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
                            <h3 class="htxt_medium_16 dark_400">SMS Templates</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/list_view.svg"/></span>&nbsp; Cards
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
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
                        <div class="card p0 animate_top col">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="cloneTemplate(template.id, 'sms')"><i class="dripicons-user text-muted mr-2"></i> Clone</a>
                                    <a class="dropdown-item wfSmsMyTemplates" href="javascript:void(0);" @click="displaySMSPreview(template)"><i class="dripicons-wallet text-muted mr-2"></i> Preview</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareTemplateUpdate(template.id)"><i class="dripicons-gear text-muted mr-2"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteTemplate(template.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a></div>
                            </div>
                            <div class="p20">
                                <!--<img style="width:256px;height:220px;" :src="template.thumbnail ? template.thumbnail : '/assets/images/temp_prev9.png'"/>-->
                                <p class="htxt_regular_12 dark_600 lh_19 m-0" v-html="setStringLimit(atob(template.stripo_compiled_html), 150)" style="height:152px;">

                                </p>
                            </div>
                            <div class="p20 btop mt-3 text-center">
                                <p class="htxt_regular_14 dark_800 mb-2">{{capitalizeFirstLetter(template.template_name)}}</p>
                                <p class="dark_200 fsize11 fw500 text-uppercase m-0">{{template.category_name ? template.category_name : 'Uncategorized'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center d-flex js-sms-templates-slidebox" style="cursor:pointer;">
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

        <sms-template-popups></sms-template-popups>

        <!--Smart Popup-->
        <div class="box js-sms-templates-slidebox-Popup" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-sms-templates-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/sms_temp_icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} SMS Template </h3>
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
                                <button class="btn btn-lg bkg_sms_400 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                <a class="dark_300 fsize16 fw400 ml20 js-sms-templates-slidebox" href="javascript:void(0);">Close</a> </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Preview SMS Popup-->
        <div class="box wfSmsMyTemplatesPopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon wfSmsMyTemplates"><i><img
                    src="/assets/images/cross.svg"></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="sms_preview">
                                <div class="phone_sms">
                                    <div class="inner">
                                        <p v-html="previewTemplate.replace(/\n/g, '<br/>')"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20 wfSmsMyTemplates">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>


<script>
    import SmsPopup from '@/components/admin/modals/templates/SmsTemplatesPopup.vue';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        props: ['title', 'type'],
        components: {Pagination, 'sms-template-popups': SmsPopup},
        data(){
            return {
                form: {
                    templateName: '',
                    templateCategory: '',
                    templateType: 'sms',
                    templateDescription: '',
                    templateId: ''
                },
                formLabel: 'Create',
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                hasData : false,
                templates: {},
                categories: {},
                method: '',
                selected_template: '',
                userid: '',
                source: '',
                current_page: 1,
                allData: '',
                moduleName: '',
                moduleAccountID: '',
                previewTemplate: ''
            }
        },
        mounted() {
            document.querySelector("body").id="SMSSection";
            this.makeBreadcrumb(this.breadcrumb);
            this.loadPaginatedData();
        },
        methods: {
            displaySMSPreview: function (data) {
                this.previewTemplate = atob(data.stripo_compiled_html);
            },
            atob: function(str){
              return atob(str);
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-sms-templates-slidebox').click();
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
                this.loading = true;
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
                            this.loading = false;

                            //window.location.href='#/templates/edit/'+this.form.templateId;

                            //this.form = {};
                            this.form.templateId ='';
                            document.querySelector('.js-sms-templates-slidebox').click();
                            this.successMsg = 'Action completed successfully.';
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
                        this.loading = false;
                        console.log(error);
                        //error.response.data
                        alert('All form fields are required');
                    });
            },
            loadPaginatedData: function () {
                axios.post('/admin/templates/getCategorizedTemplates?page=' + this.current_page, {'action':'my', 'campaign_type':'sms', 'method': 'manage'})
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.templates = response.data.oTemplates;
                        this.categories = response.data.oCategories;
                        this.method = response.data.method;
                        this.userid = response.data.userID;
                        this.allData = response.data.allData;
                        this.loading = false;
                        this.hasData = true;
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
                    this.loading = true;
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
                                this.loading = false;
                                this.successMsg = 'Template cloned and saved into your templates!';
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            }
        }
    };

    $(document).ready(function () {
        $(document).on('click', '.js-sms-templates-slidebox', function(){
            $(".js-sms-templates-slidebox-Popup").animate({
                width: "toggle"
            });
        });

        $(document).on('click', '.wfSmsMyTemplates', function () {
            $(".wfSmsMyTemplatesPopup").animate({
                width: "toggle"
            });
        });
    });

</script>

