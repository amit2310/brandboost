<template>
    <div>
        <!--<system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>-->
        <loading :isLoading="loading"></loading>
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


            <div class="col-md-3 d-flex" v-for="template in templates" @click="addTemplateToCampaign(template.id)" style="cursor:pointer;">
                <div class="card p-1 pb0 animate_top col">
                    <div class="sms_template_outer">
                        <div class="sms_box">
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
            <div class="col-6"><button class="btn btn-sm bkg_email_300 light_000 float-right" @click="backToConfiguration">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
        </div>

        <div class="modal fade show" id="EditPreview">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 1200px;">
                <div class="modal-content review" style="width: 1200px;">
                    <div class="modal-body p0 mt0 br5" style="width: 1200px;">
                        <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
                        <loading :isLoading="loading"></loading>
                        <div class="row">
                            <div class="col-md-4 pr0">
                                <div class="email_editor_left">
                                    <div class="p10 bbot"><p class="m0 txt_dark fw500">Email Configuration</p></div>
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
                                        <input type="text" class="mr20" placeholder="Email Address" v-model="user.email" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                        <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestEmail">Send</button>
                                        <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestBox=false">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 pl3">
                                <div class="email_editor_right preview" style="max-height:800px;overflow:auto;border-left:5px solid;">
                                    <div class="p10 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                    </div>
                                    <div class="p30" id="wf_preview_edit_template_content">
                                        <div class="email_preview_sec br5 pb20" style="min-height: 500px;" v-html="content">
                                            Content goes here
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
        props: ['templates', 'user'],
        data() {
            return {
                refreshMessage: 2,
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                greetings: '',
                introduction: '',
                content: '',
                selected_campaignId: '',
                sendTestBox: false
            }
        },
        created() {
            this.loadEmailReviewTemplates();
        },
        watch: {
            'greetings': function(){
              jq("#wf_edit_template_greeting_EDITOR").text(this.greetings);
             },
            'introduction': function(){
                jq("#wf_edit_template_introduction_EDITOR").text(this.introduction);
          },

        },
        methods: {
            backToConfiguration: function(){
                document.querySelector('#hidePreviewForm').click();
                this.$emit("hideEmailTemplate")
            },
            saveEditChanges: function(){
                this.loading = true;
                axios.post('/admin/workflow/updateWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    greeting: this.greetings,
                    introduction: this.introduction,
                    campaignId: this.selected_campaignId,
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;
                            this.refreshMessage = Math.random();
                            this.successMsg = "Saved changes successfully!";
                        }
                    });
            },
            sendTestEmail: function(){
                this.loading = true;
                axios.post('/admin/workflow/sendTestEmailworkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    moduleUnitID: this.$route.params.id,
                    campaignId: this.selected_campaignId,
                    email: this.user.email
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;
                            this.refreshMessage = Math.random();
                            this.successMsg = "Test email sent successfully!";
                        }
                    });
            },
            getDecodeContent: function(content){
                return atob(content);
            },
            loadPreview: function(){
                this.loading = true;
                axios.post('/admin/workflow/previewWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    campaignId: this.selected_campaignId,
                    moduleUnitId: this.$route.params.id,
                })
                    .then(response => {
                        this.loading = false;
                        this.content = response.data.content.replace('<?php echo base_url();?>', '/');
                        this.introduction = response.data.introduction;
                        this.greetings = response.data.greeting;
                    });
                document.querySelector('#displayPreviewForm').click();
            },
            addTemplateToCampaign: function(templateId){
                this.loading = true;
                //Save Template into the database
                axios.post('/admin/brandboost/addCampaignToOnsite', {
                    brandboost_id: this.$route.params.id,
                    template_id: templateId,
                    template_type: 'email',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        this.selected_campaignId = response.data.campaignId;
                        this.loadPreview();
                        this.$emit("updateEmailCampaignId", this.selected_campaignId, response.data.templateName);
                    });

            },
            loadEmailReviewTemplates: function(){
                this.loading = false;
            }
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

