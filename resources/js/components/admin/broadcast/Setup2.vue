<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{this.campaign.title}}</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="saveDraft"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(3)"> Next <span
                            style="opacity: 1"><img src="/assets/images/arrow-right-line-white.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>
            <div class="container-fluid">


                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a class="done" href="#"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Basic
                                    campaign info</a></li>
                                <li><a class="active" href="#"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Content &
                                    Design</a></li>
                                <li><a href="#"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a href="#"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review &
                                    confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div v-show="chooseTemplateSection && !editTemplateSection">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="htxt_bold_20 dark_700 mb20 mt40">Select pre-made email template or create your
                                own</h3>
                            <p class="htxt_normal_14 dark_200 mb40 mt20">It’s very easy to create or import!</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 text-center d-flex animate_top">
                            <div class="card br8 p0" @click="displayTemplateList" style="cursor: pointer;">
                                <div class="p40 pb20 col">
                                    <img src="/assets/images/networkoptimization.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb10 mt20">Select template</h3>
                                    <p class="htxt_normal_14 dark_200 mb20 mt10">This text will be displayed in the
                                        ‘Subject’ field in your recepient’s email client.</p>

                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="javascript:void(0);"
                                       @click="displayTemplateList">View template library</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-flex animate_top">
                            <div class="card br8 p0 ">
                                <div class="p40 pb20 col">
                                    <img src="/assets/images/networkoptimization2.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb10 mt20">Drag & drop editor</h3>
                                    <p class="htxt_normal_14 dark_200 mb20 mt10">This text will be displayed in the
                                        ‘Subject’ field in your recepient’s email client.</p>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="#">Create new email template</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-flex animate_top">
                            <div class="card br8 p0 ">
                                <div class="p40 pb20 col">
                                    <img src="/assets/images/scrollingstatementtext.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb10 mt20">Plain text</h3>
                                    <p class="htxt_normal_14 dark_200 mb20 mt10">This text will be displayed in the
                                        ‘Subject’ field in your recepient’s email client.</p>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="#">Use plain text editor</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt40">
                        <div class="col-md-12">
                            <hr class="mb25">
                        </div>
                        <div class="col-8">
                            <h3 class="htxt_medium_16 dark_700 mb10 mt20">Import custom HTML template</h3>
                            <p class="htxt_normal_14 dark_200 mb20 mt10">Perfect for experts! Write or import your own
                                HTML to build and send custom email.</p>
                        </div>
                        <div class="col-4">
                            <button
                                class="btn btn-md-44 bkg_none border2 dark_200 pl20 pr20 float-right fw500 fsize14 mt20">
                                <span class="ml0 mr10"><img src="/assets/images/download-cloud-line.svg"></span>Import
                                HTML template
                            </button>
                        </div>
                    </div>

                </div>
                <div v-show="listTemplateSection">
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
                                <div class="col-md-4 previewTemplate" v-for="template in templates"
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


                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6" v-show="chooseTemplateSection">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(1)"><span
                            class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6" v-show="chooseTemplateSection == false && !chooseOtherTemplateSection">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"
                                @click="displayChooseTemplateSection"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6" v-show="chooseOtherTemplateSection">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"
                                @click="displayChooseTemplateSection"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Choose Other Template
                        </button>
                    </div>
                    <div class="col-6">
                        <button
                            class="btn btn-sm bkg_email_300 light_000 float-right"
                            v-if="editTemplateSection"
                            @click="saveTemplateContinue(3)"
                        >Save and
                            continue <span><img src="/assets/images/arrow-right-line.svg"></span>
                        </button>
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(3)" v-else>Save and
                            continue <span><img src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>

            </div>
        </div>
        <!--Content Area End-->
        <div class="box previewTemplatePopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon previewTemplate"><i><img
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
                                        class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600 previewTemplate"
                                        @click="saveSelectedTemplate">Select & Continue
                                </button>
                                <a href="#" class="blue_300 fsize16 fw600 ml20 previewTemplate">Close</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import Pagination from '../../helpers/Pagination';
    export default {
        components: {Pagination},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                chooseTemplateSection: false,
                chooseOtherTemplateSection: false,
                listTemplateSection: false,
                editTemplateSection: false,
                templates: {},
                mytemplates: {},
                categories: {},
                current_page: 1,
                allData: '',
                totalTemplates: 0,
                user: {},
                breadcrumb: '',
                activeIndex: '',
                previewTemplate: '',
                selectedTemplate: '',
                stripoEditorSrc: ''
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData: function () {
                axios.get('/admin/broadcast/setupLoadTemplates/'+this.campaignId+'?page=' + this.current_page)
                    .then(response => {
                        this.activeIndex = -2;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.oBroadcast;
                        this.categories = response.data.oCategories;
                        this.templates = response.data.oTemplates;
                        this.mytemplates = response.data.myTemplates;
                        this.user = response.data.userData;
                        this.allData = response.data.allData;
                        this.totalTemplates = this.allData.total;
                        this.stripoEditorSrc= '/admin/workflow/loadStripoCampaign/' + this.moduleName + '/' + this.campaign.id + '/' + this.campaign.broadcast_id;
                        this.loading = false;
                        this.chooseTemplateSection = true;
                        if(this.campaign.template_source>0){
                            this.displayEditTemplateSection();
                        }

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
            displayPreview: function (data) {
                this.selectedTemplate = data.id;
                this.previewTemplate = atob(data.stripo_compiled_html);
            },
            saveSelectedTemplate: function () {
                this.loading = true;
                let templateId = this.selectedTemplate;
                //Save Template into the database
                axios.post('/admin/broadcast/addCampaignToBroadcast', {
                    broadcast_id: this.campaignId,
                    template_id: templateId,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.stripoEditorSrc = '/admin/workflow/loadStripoCampaign/' + this.moduleName + '/' + this.campaign.id + '/' + this.campaign.broadcast_id;
                        this.chooseTemplateSection = false;
                        this.listTemplateSection = false;
                        let elem = this;
                        setTimeout(function () {
                            elem.loading = false;
                            elem.displayEditTemplateSection();
                        }, 2000);
                    });


            },
            loadCategoriedTemplates: function (actionName, ix) {
                this.activeIndex = ix;
                this.loading = true;
                this.current_page = 1;
                axios.post('/admin/templates/getCategorizedTemplates?page=' + this.current_page, {
                    action: actionName,
                    campaign_type: 'email',
                    method: 'manage',
                    _token: this.csrf_token()
                })
                    .then(response => {

                        this.templates = response.data.oTemplates;
                        this.loading = false;
                        this.allData = response.data.allData;
                        this.loading = false;
                    });
            },
            displayTemplateList: function () {
                //document.querySelector('body').classList.remove("enlarge-menu");
                this.chooseTemplateSection = false;
                this.editTemplateSection = false;
                this.listTemplateSection = true;
            },
            displayChooseTemplateSection: function () {
                //document.querySelector('body').classList.remove("enlarge-menu");
                this.chooseTemplateSection = true;
                this.chooseOtherTemplateSection = false;
                this.listTemplateSection = false;
                this.editTemplateSection = false;
            },
            displayEditTemplateSection: function(){
                this.loading = true;
                let elem = this;
                elem.chooseTemplateSection = false;
                elem.listTemplateSection = false;
                setTimeout(function(){
                    elem.chooseOtherTemplateSection = true;
                    elem.editTemplateSection = true;
                    //document.querySelector('body').classList.add("enlarge-menu");
                    elem.loading = false;
                }, 1000);

            },
            displayStep: function (step) {
                let path = '/admin#/modules/emails/broadcast/setup/' + this.campaignId + '/' + step;
                window.location.href = path;
            },
            saveTemplateContinue: function(step){
                this.loading = true;
                document.querySelector('#loadstripotemplate').contentWindow.document.querySelector('.fa-save').click();
                let elem= this;
                setTimeout(function(){
                    elem.loading = false;
                    elem.displayStep(step);
                }, 2000)
                //this.displayStep(step);
            },
            applyDefaultInfo: function (e) {
                if (e.target.checked) {
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname + ' ' + this.user.lastname;
                    this.updatesettings('from_email');
                    this.updatesettings('from_name');
                } else {

                }
            },
            updatesettings: function (fieldName) {
                this.loading = true;
                axios.post('/admin/broadcast/updateBroadcastSettingUnit', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: this.campaign[fieldName],
                    event_id: this.campaign.event_id,
                    campaign_id: this.campaign.id,
                    broadcast_id: this.campaign.broadcast_id
                }).then(response => {
                    this.successMsg = 'Updated the changes successfully!!'
                    this.loading = false;
                });

            },
            saveDraft: function(){
                this.loading = true;
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            this.successMsg = 'Campaign saved as a draft successfully';
                        }else{
                            this.errorMsg = 'Something went wrong';
                        }
                    });
            }
        }

    };

    let tkn = $('meta[name="_token"]').attr('content');
    $(document).ready(function () {
        $(document).on('click', '.previewTemplate', function () {
            $(".previewTemplatePopup").animate({
                width: "toggle"
            });
        });

        $(document).on("click", "#wfBtnPopupSendTestEmail", function () {
            var email = $("#wfTextPopupSendTestEmail").val();
            var campaignId = $("#wf_test_email_campaign_id").val();
            var moduleName = 'broadcast';
            if(email == ''){
                alert('Please enter email address');
                return;
            }
            $.ajax({
                url: '/admin/workflow/sendTestEmailworkflowCampaign',
                type: "POST",
                data: {_token: tkn, 'moduleName': moduleName, campaignId: campaignId, email: email},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        /*displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited)*/
                        alert('Test email sent successfully');
                        $("#wfSendTestEmail").modal("hide");
                    }
                }
            });
        });

    });

</script>



