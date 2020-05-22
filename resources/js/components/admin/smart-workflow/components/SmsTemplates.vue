<template>
    <div>
        <!---->

        <div class="table_head_action pb0 mb25">
            <div class="row">
                <div class="col">
                    <h3 class="htxt_medium_14 dark_600">Latest templates</h3>
                    <button id="displayPreviewForm" type="button" style="display:none;">Display Edit & Preview</button>
                    <button id="hidePreviewForm" type="button" style="display:none;">Hide</button>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-3 d-flex">
                <div class="card p0 pt30 text-center animate_top col">
                    <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                    <p class="htxt_regular_16 dark_100 mb15">Create<br>blank template</p>
                </div>
            </div>


            <div class="col-md-3 d-flex" v-for="template in templates">
                <div class="card p-1 pb0 animate_top col">
                    <div class="dot_dropdown" v-if="template.user_id==user.id">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                            <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0);" @click="cloneTemplate(template.id, 'sms')"><i class="dripicons-user text-muted mr-2"></i> Clone</a>
                            <a class="dropdown-item wfEmailMyTemplates" href="javascript:void(0);" @click="displayTemplatePreview(template)"><i class="dripicons-wallet text-muted mr-2"></i> Preview</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0);" @click="deleteTemplate(template.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a></div>
                    </div>
                    <div class="dot_dropdown" v-else>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                            <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item wfEmailMyTemplates" href="javascript:void(0);" @click="displayTemplatePreview(template)"><i class="dripicons-wallet text-muted mr-2"></i> Preview</a>
                        </div>
                    </div>
                    <div class="sms_template_outer">
                        <div class="sms_box" v-html="getDecodeContent(template.stripo_compiled_html)">
                            <img :src="template.thumbnail" style="transform: scale(2.5);margin-top:35%;">
                        </div>
                    </div>
                    <div class="email_temp_txt p25 text-center">
                        <p class="htxt_regular_12 dark_600 mb-0">{{template.template_name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="card p-1 pb0 animate_top col">
                    <div class="sms_template_outer">
                        <div class="sms_box">
                            Hello [First Name],<br><br>
                            It was a pleasure doing business with you. Thank you for [being a loyal customer, giving us a try, etc.].<br><br>
                            As you may know, many people like you rely on online reviews to make sure they get the best service possible. With that said, we would love if you could leave us a testimonial on our Google page.<br><br>
                            You can click this link to leave your feedback and help other people like you get the help they need in [primary customer pain point].<br><br>
                            Thank you for taking time out of your day. We greatly appreciate it!<br><br>
                            Best,<br>
                            [Your Name]
                        </div>
                    </div>
                    <div class="email_temp_txt p25 text-center">
                        <p class="htxt_regular_12 dark_600 mb-0">eBay</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt40">
            <div class="col-md-12"><hr class="mb25"></div>
            <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="backToConfiguration"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button></div>
            <div class="col-6">
                <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="backToConfiguration">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button>
                <a
                    class="dark_200 fw500 d-inline-block mt10 pull-right mr20"
                    href="javascript:void(0);"
                    @click="deleteNode"
                >Delete &nbsp; <i class="ri-delete-bin-6-line"></i></a>
            </div>
        </div>

        <div class="modal fade show" id="EditPreview">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 1200px;">
                <div class="modal-content review" style="width: 1200px;">
                    <div class="modal-body p0 mt0 br5" style="width: 1200px;">


                        <div class="row">
                            <div class="col-md-4 pr0">
                                <div class="email_editor_left">
                                    <div class="p10 bbot"><p class="m0 txt_dark fw500">SMS Configuration</p></div>
                                    <div class="p20">
                                        <div class="form-group">
                                            <label class="">Greetings</label>
                                            <input v-model="greetings" class="form-control h52" required="" placeholder="Hi, We’d love your feeed..." type="text">
                                        </div>

                                        <div class="form-group mb0">
                                            <label class="">Content</label>
                                            <a class="fsize14 open_editor" href="#"><i class=""><img src="/assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                            <textarea v-model="introduction" style="min-height: 238px; resize: none;" class="form-control p20 fsize12" v-html="introduction">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both.

										But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                        </div>
                                    </div>
                                    <div class="p20 pt0" v-if="sendTestBox==false">
                                        <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="saveEditChanges">Save</button>
                                        <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="javascript:void(0);" @click="sendTestBox=true">Send test email</a>
                                        <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="javascript:void(0);" @click="backToConfiguration">Back</a>

                                    </div>
                                    <div class="p20 pt0" id="wfTestCtr" v-if="sendTestBox">
                                        <input type="text" class="mr20" placeholder="Email Address" v-model="user.phone" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                        <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestSMS">Send</button>
                                        <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestBox=false">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 pl3">
                                <div class="email_editor_right preview" style="max-height:800px;overflow:auto;border-left:5px solid;">
                                    <div class="p10 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                    </div>
                                    <div class="sms_preview">
                                        <div class="phone_sms">
                                            <div class="inner">
                                                <p v-html="content"></p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <p><small>{{ timestampToDateFormat(Math.floor(Date.now() / 1000)) }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import jq from 'jquery';
    export default {
        props: ['categories','templates', 'templatesAllData', 'user', 'event_id', 'moduleName', 'moduleUnitId', 'isDecisionNode', 'isSplitNode'],
        data() {
            return {
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                greetings: '',
                introduction: '',
                content: '',
                selected_campaignId: '',
                sendTestBox: false,
                selectedTemplateName: '',
                current_page: 1,
                form: {
                    templateName: '',
                    templateCategory: '',
                    templateType: 'sms',
                    templateDescription: '',
                    templateId: ''
                },
                searchBy: '',
            }
        },
        created() {
            this.loadEmailReviewTemplates();
        },
        watch: {
            'greetings': function(){
                jq("#wf_edit_sms_template_greeting_EDITOR").text(this.greetings);
            },
            'introduction': function(){
                jq("#wf_edit_sms_template_introduction_EDITOR").text(this.introduction);
            },
            'searchBy': function(){
                this.loadCategoriedTemplates(this.activeClass);
            }
        },
        methods: {
            deleteNode: function(){
                if(confirm("Are you sure you want to delete this node?")){
                    this.$emit("deleteWorkflowEvent", {id:this.event_id});
                    this.backToConfiguration();
                }
            },
            backToConfiguration: function(){
                document.querySelector('#hidePreviewForm').click();
                this.$emit("hideSMSTemplate")
            },
            saveEditChanges: function(){
                this.showLoading(true);
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/admin/workflow/updateWorkflowDecisionCampaign';
                }else{
                    url = '/admin/workflow/updateWorkflowCampaign';
                }
                axios.post(url, {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    greeting: this.greetings,
                    introduction: this.introduction,
                    campaignId: this.selected_campaignId,
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);

                            this.displayMessage('success', 'Saved changes successfully!');
                            this.$emit("updateSMSCampaignId", this.selected_campaignId, this.selectedTemplateName, response.data.campaignInfo);
                        }
                    });
            },
            sendTestSMS: function(){
                this.showLoading(true);
                let url = '';
                if(this.isDecisionNode == ture){
                    url = '/admin/workflow/sendTestSMSworkflowDecisionCampaign';
                }else{
                    url = '/admin/workflow/sendTestSMSworkflowCampaign';
                }
                axios.post(url, {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    campaignId: this.selected_campaignId,
                    number: this.user.phone
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);

                            this.displayMessage('success', 'Test email sent successfully!');
                        }
                    });
            },
            getDecodeContent: function(content){
                return atob(content).replace("<br>", "<br><br>");
            },
            loadPreview: function(){
                this.showLoading(true);
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/admin/workflow/previewWorkflowDecisionCampaign';
                }else{
                    url = '/admin/workflow/previewWorkflowCampaign';
                }
                axios.post(url, {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    campaignId: this.selected_campaignId,
                    moduleUnitId: this.moduleUnitId
                })
                    .then(response => {
                        this.showLoading(false);
                        this.content = response.data.content.replace(/\r\n|\r|\n/g, "<br />").replace('wf_edit_sms_template_greeting', 'wf_edit_sms_template_greeting_EDITOR');
                        this.introduction = response.data.introduction;
                        this.greetings = response.data.greeting;
                    });
                document.querySelector('#displayPreviewForm').click();
            },
            addTemplateToCampaign: function(templateId){
                this.showLoading(true);
                //Save Template into the database
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/addDecisionEndCampaignToEvent';
                }else if(this.isSplitNode == true){
                    url = '';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/addEndCampaignToEvent';
                }
                axios.post(url, {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    template_id: templateId,
                    template_type: 'sms',
                    event_id: this.event_id,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.showLoading(false);
                        this.selected_campaignId = response.data.campaignId;
                        this.loadPreview();
                        this.selectedTemplateName = response.data.templateName;
                        this.$emit("updateSMSCampaignId", this.selected_campaignId, response.data.templateName, response.data.campaignInfo);
                    });
            },
            loadEmailReviewTemplates: function(){
                this.showLoading(false);
            },
            loadCategoriedTemplates: function(action){
                this.activeClass = action;
                this.$emit("loadCategoriedTemplates", {actionName: action, campaign_type: 'sms', currentPage: this.current_page, searchBy:this.searchBy});
            },
            displayTemplatePreview: function (data) {
                this.selectedTemplate = data.id;
                this.previewTemplate = this.getDecodeContent(data.stripo_compiled_html);
                document.querySelector("#emailTemplatePreview").click();
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
                                this.loadCategoriedTemplates('my');
                                document.querySelector(".hideEmailTemplatePreview").click();
                            }

                        });
                }
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
                                this.loadCategoriedTemplates('my');
                            }

                        });
                }
            },
        }
    }
    $(document).ready(function(){
        $(document).on("click", "#displayPreviewForm", function(){
            $("#EditPreview").modal('show');
        })
        $(document).on("click", "#hidePreviewForm", function(){
            $("#EditPreview").modal('hide');
        })
    });
</script>
<style>
    .sms_preview{width: 276px; height: 553px; background: url(/assets/images/iphone.png) center top no-repeat; margin: 100px auto; padding: 100px 30px}
    .sms_preview .inner {background: #e5e5ea;padding: 10px;	font-size: 11px;border-radius: 15px;margin-bottom: 10px;float: left; max-width: 100%;width: 100%;max-height:300px;overflow-y:auto;word-wrap: break-word;}
</style>

