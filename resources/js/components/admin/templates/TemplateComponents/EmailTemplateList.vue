<template>
    <div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9"></div>
        </div>
        <div v-show="listEmailTemplateSection">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="fsize12 fw500 dark_200 ls4 mb20">TEMPLATES</h4>
                    <ul class="templates_list">

                        <li>
                            <a href="javascript:void(0);" :class="{ 'active': activeIndex === -2 }" :key="-2"
                               @click="loadCategoriedTemplates('all', -2)">
                                <strong><img src="/assets/images/menu-2-line.svg"/> All</strong>
                                <span>{{totalTemplates}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" :class="{ 'active': activeIndex === -1 }" :key="-1"
                               @click="loadCategoriedTemplates('my', -1)">
                                <strong><img src="/assets/images/heart-line.svg"/> My Templates</strong>
                                <span>{{mytemplates.total}}</span>
                            </a>
                        </li>
                        <li v-for="(category, index) in categories">
                            <a href="javascript:void(0);" :class="{ 'active': activeIndex === index }"
                               @click="loadCategoriedTemplates(category.id, index)">
                                <strong><img src="/assets/images/folder-3-line.svg"/>
                                    {{capitalizeFirstLetter(category.category_name)}}</strong>
                                <span>{{category.totalCount}}</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-md-9">

                    <div class="row">
                        <!--<div class="col-md-4">
                            <div class="card p12 text-center">
                                <div class="temp_design_box bkg_light_000">
                                    <img class="mt-5" src="/assets/images/circle-plus-90.png"/>
                                </div>
                                <h3 class="htxt_bold_16 dark_700 mb10">Create New</h3>
                            </div>
                        </div>-->
                        <div class="col-md-4 wfEmailPreviewTemplate" v-for="template in templates"
                             style="cursor:pointer;"
                             @click="displayPreview(template)">
                            <div class="card p12 text-center">
                                <div class="temp_design_box"><img style="width:240px;height:172px;"
                                                                  :src="template.thumbnail ? template.thumbnail : `/assets/images/temp_prev9.png`"/>
                                </div>
                                <h3 class="htxt_bold_16 dark_700 mb10" :title="capitalizeFirstLetter(template.template_name)">
                                    {{setStringLimit(capitalizeFirstLetter(template.template_name), 15)}}</h3>
                            </div>
                        </div>
                        <div class="col-md-12 text-center wfEmailPreviewTemplate" v-if="!templates.length && loading == false">
                            <div class="col-md-12">
                                <div class="card card_shadow min-h-280">
                                    <div class="row mb65">
                                        <div class="col-md-12 text-center">
                                            <img class="mt40" style="max-width: 225px; " src="/assets/images/email-template.svg">
                                            <h3 class="htxt_bold_18 dark_700 mt30">No templates so far under this category</h3>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
        <div v-show="editTemplateSection">
            <div class="row">
                <iframe id="loadstripotemplate" scrolling="no" :src="stripoEditorSrc" width="100%" height="1500"
                        style="overflow:hidden; border:none!important;"></iframe>
            </div>
        </div>

        <!--Preview Popup-->
        <div class="box wfEmailPreviewTemplatePopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon wfEmailPreviewTemplate"><i><img
                    src="/assets/images/cross.svg"></i></a>
                    <div class="p40">
                        <div class="row" v-html="previewTemplate"></div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12"><input type="hidden" name="module_name" id="active_module_name"
                                                          value="people"> <input type="hidden"
                                                                                 name="module_account_id"
                                                                                 id="module_account_id" :value="user.id">
                                <button type="submit"
                                        class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600 wfEmailPreviewTemplate"
                                        @click="saveWfSelectedTemplate('use')">Use Template
                                </button>
                                <button type="submit"
                                        class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600 wfEmailPreviewTemplate"
                                        @click="saveWfSelectedTemplate('edit')">Use & Edit Template
                                </button>
                                <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20 wfEmailPreviewTemplate">Close</a></div>
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

                listEmailTemplateSection: true,
                editTemplateSection: false,
                hasData : true,
                templates: {},
                mytemplates: {},
                categories: {},
                method: '',
                selected_template: '',
                userid: '',
                source: '',
                current_page: 1,
                allData: '',
                activeIndex: -2,
                totalTemplates: '',
                previewTemplate: '',
                selectedTemplate: '',
                stripoEditorSrc:'',
                actionName: 'all',
                user: {},
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
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
                        }

                    });
            },
            loadPaginatedData: function () {
                this.showLoading(true);
                axios.post('/admin/templates/getCategorizedTemplates?page=' + this.current_page, {'action':this.actionName, 'campaign_type':'email', 'method': 'manage'})
                    .then(response => {
                        this.templates = response.data.oTemplates;
                        this.method = response.data.method;
                        this.userid = response.data.userID;
                        this.allData = response.data.allData;
                        if(this.actionName == 'all'){
                            this.categories = response.data.oCategories;
                            this.mytemplates = response.data.myTemplates;
                            this.totalTemplates = this.allData.total;
                        }

                        //this.stripoEditorSrc= '/admin/workflow/loadStripoCampaign/' + this.moduleName + '/' + this.campaign.id + '/' + this.campaign.broadcast_id;
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
            loadCategoriedTemplates:function(actionName, ix){
                this.activeIndex = ix;
                this.actionName = actionName;
                this.loadPaginatedData();
            },
            displayPreview: function (data) {
                this.selectedTemplate = data.id;
                this.previewTemplate = atob(data.stripo_compiled_html);
            },
            saveWfSelectedTemplate: function (mode) {
                this.showLoading(true);
                this.$emit('addWorkflowNode', this.selectedTemplate, mode);
            }
        }
    };

    $(document).ready(function () {
        $(document).on('click', '.wfEmailPreviewTemplate', function () {
            $(".wfEmailPreviewTemplatePopup").animate({
                width: "toggle"
            });
        });

    });

</script>
<style scoped>
    .emailtempsec {
        width: calc(100% - 190px);
    }

    .template_row {
        width: 187px;
        display: inline-block;
    }

    .template_row td {
        padding: 0 !important;
    }

    .heading-elements .form-control.input-sm {
        background: none !important;
        padding: 0 60px 0 11px !important;
    }

    .heading-elements .has-feedback-left .form-control-feedback {
        right: 30px;
    }

    .content-wrapper::before {
        height: 210px !important;
    }

    .temp_more_opt {
        position: absolute;
        width: 24px;
        height: 24px;
        right: 0px;
        top: 0;
        border-radius: 0 5px 0;
        background: #fff;
        box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.20);
        z-index: 99;
    }

</style>
