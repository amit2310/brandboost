<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.title}} </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.status !='archive'" @click="changeCampaignStatus('draft')"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(2)"> Next <span style="opacity: 1"><img
                            src="/assets/images/arrow-right-line-white.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
            <loading :isLoading="loading"></loading>

            <div class="container-fluid">
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Campaign info</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Scores</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="email_review_config p20">
                            <div class="bbot pb10 mb15">
                                <p class="fsize13 text-uppercase dark_200 m-0">Configurations  Design</p>
                            </div>
                            <div class="bbot pb10 mb15">
                                <p class="fsize11 text-uppercase dark_200 m-0">Component</p>
                            </div>
                            <div class="p0">
                                <h3 v-if="campaign.platform !='sms'" class="dark_400 mb0 fsize13 fw300">Logo / company avatar
                                    <label class="custom-form-switch float-right">
                                        <input class="field" type="checkbox" v-model="campaign.logo_show" :checked="campaign.logo_show" @change="toggleLogoDisplay($event)">
                                        <span class="toggle email"></span> </label>
                                </h3>
                                <h3 class="dark_400 mb0 fsize13 fw300">Title &nbsp;
                                    <label class="custom-form-switch float-right">
                                        <input class=" field" type="checkbox" v-model="campaign.title_show" :checked="campaign.title_show" @change="toggleIntroDisplay($event)">
                                        <span class="toggle email"></span> </label>
                                </h3>
                                <h3 class="dark_400 mb0 fsize13 fw300">Sub Title
                                    <label class="custom-form-switch float-right">
                                        <input class=" field" type="checkbox" v-model="campaign.subtitle_show" :checked="campaign.subtitle_show" @change="toggleIntroDisplay($event)">
                                        <span class="toggle email"></span> </label>
                                </h3>
                                <h3 class="dark_400 mb0 fsize13 fw300">Attachment
                                    <label class="custom-form-switch float-right">
                                        <input class=" field" type="checkbox" v-model="campaign.atttachment_show" :checked="campaign.atttachment_show" @change="toggleIntroDisplay($event)">
                                        <span class="toggle email"></span> </label>
                                </h3>
                                <h3 class="dark_400 mb0 fsize13 fw300">Smily
                                    <label class="custom-form-switch float-right">
                                        <input class=" field" type="checkbox" v-model="campaign.smilie_show" :checked="campaign.smilie_show" @change="toggleIntroDisplay($event)">
                                        <span class="toggle email"></span> </label>
                                </h3>
                            </div>
                            <div>
                                <div class="bbot btop pb10 pt10 mb15 mt15">
                                    <p class="fsize11 text-uppercase dark_200 m-0">Automation</p>
                                </div>
                                <h3 class="dark_400 mb0 fsize13 fw300">Activite automated messages
                                    <label class="custom-form-switch float-right">
                                        <input class=" field" type="checkbox" v-model="campaign.automated_message" :checked="campaign.automated_message" @change="toggleIntroDisplay($event)">
                                        <span class="toggle email"></span> </label>
                                </h3>
                            </div>

                            <div class="bbot btop pb10 pt10 mb15 mt15">
                                <p class="fsize11 text-uppercase dark_200 m-0">Popup Details</p>
                            </div>
                            <div class="p0">
                                <div class="form-group">
                                    <label class="fsize12" for="fname">Brand / Product Name:</label>
                                    <input type="text" v-model="campaign.brand_name" class="form-control h40" id="fname" placeholder="Enter Brand/Product Name" name="brand_name">
                                </div>
                                <div class="form-group">
                                    <label class="fsize12" for="Questions">Questions:</label>
                                    <textarea
                                        rows="4"
                                        class="form-control text"
                                        id="Questions"
                                        name="question"
                                        :placeholder="`How likely are you to recommend ${campaign.brand_name ? campaign.brand_name : 'My Store'} to a friend?`"
                                        v-model="campaign.question"
                                        @keypress="syncQuestion"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="fsize12" for="Introduction">Introduction:</label>
                                    <textarea
                                        class="form-control text"
                                        rows="4"
                                        id="Introduction"
                                        placeholder="Placeholder Text"
                                        name="description"
                                        v-model="campaign.description"
                                        @keypress="syncIntro"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="brand_logo" id="npsBrandLogo" :value="campaign.brand_logo" >
                                    <label class="m0 w-100" for="uploadNPSBrandLogo">
                                        <div class="img_vid_upload_medium">
                                            <input class="d-none" type="file" name="brand_logo" id="uploadNPSBrandLogo">
                                        </div>
                                    </label>

                                </div>
                            </div>
                            <div class="bbot btop pb10 pt10 mb15 mt15">
                                <p class="fsize11 text-uppercase dark_200 m-0">Settings</p>
                            </div>
                            <div class="p0 pb30">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="fsize13 dark_400 mt-2">Question Text Color :</p>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control colorpicker-basic1"
                                               name="web_text_color"
                                               v-model="campaign.web_text_color"

                                        >

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="fsize13 dark_400 mt-2">Introduction Text Color:</p>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control colorpicker-basic2"
                                               name="web_int_text_color"
                                               v-model="campaign.web_int_text_color"
                                        >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="fsize13 dark_400 mt-2">Button Text Color :</p>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control colorpicker-basic3"
                                               name="web_button_text_color"
                                               v-model="campaign.web_button_text_color"
                                        >
                                    </div>
                                </div>

                                <div class="row" v-if="campaign.platform=='web'">
                                    <div class="col-md-8">
                                        <p class="fsize13 dark_400 mt-2">Button Over Text Color :</p>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control colorpicker-basic3"
                                               name="web_button_over_text_color"
                                               v-model="campaign.web_button_over_text_color"
                                        >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="fsize13 dark_400 mt-2">Button Background Color :</p>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control colorpicker-basic4"
                                               name="web_button_color"
                                               v-model="campaign.web_button_color"
                                        >
                                    </div>
                                </div>

                                <!--<div class="row">
                                    <div class="col-md-12">
                                        <input type="button" @click="updateConfigurations" class="btn btn-success btn-sm bkg_green_300 light_000 mt-5 ml-3" value="Save Configurations">
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="email_review_config p20">
                            <div class="bbot pb10 mb15">
                                <p class="fsize13 text-uppercase dark_200 m-0">Preview</p>
                            </div>
                            <div class="card p0 m-auto text-center" v-html="preview">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(0)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(2)">Continue <span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                        <button class="btn btn-success btn-sm bkg_green_300 light_000 float-right mr-3" @click="updateConfigurations">Save Changes <span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>





            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>
<script>
    import jq from 'jquery';
    export default {
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false,
                preview: ''
            }
        },
        created() {
            axios.get('/admin/modules/chat/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oChat;
                    this.preview = response.data.setupPreview;
                    this.user = response.data.userData;
                    this.loading = false;

                });
        },
        mounted() {
            setTimeout(function(){
                loadNPSJQScript(35);
            }, 500);

        },
        computed: {

        },
        methods: {
            toggleLogoDisplay: function(e){
                if(e.target.checked){
                    jq(".logo_img").parent().show();
                    jq(".product_icon").show();
                }else{
                    jq(".product_icon").hide();
                    jq(".logo_img").parent().hide();
                }
            },
            toggleQuestionDisplay: function(e){
                if(e.target.checked){
                    jq(".questionText").show();
                    jq(".questionEamilText").show();
                }else{
                    jq(".questionText").hide();
                    jq(".questionEamilText").hide();
                }
            },
            toggleIntroDisplay: function(e){
                if(e.target.checked){
                    jq(".introductionText").show();
                }else{
                    jq(".introductionText").hide();
                }
            },
            syncQuestion: function(){
                document.querySelector('.questionEamilText').innerHTML=this.campaign.question;
                document.querySelector('.questionText').innerHTML=this.campaign.question;
                document.querySelector('.questionSMSText').innerHTML=this.campaign.question + '<br><br>Please Reply with a number from "0" (not likely) to "10" (very likely)';
            },
            syncIntro: function(){
                document.querySelector('.introductionText').innerHTML=this.campaign.description;

            },
            updateConfigurations: function(){
                this.loading = true;
                //Grab color related values
                let elem1 = document.querySelector('input[name="web_text_color"]');
                let elem2 = document.querySelector('input[name="web_int_text_color"]');
                let elem3 = document.querySelector('input[name="web_button_text_color"]');
                let elem4 = document.querySelector('input[name="web_button_over_text_color"]');
                let elem5 = document.querySelector('input[name="web_button_color"]');
                let web_text_color = (elem1 != null) ? elem1.value : null;
                let web_int_text_color = (elem2 != null) ? elem2.value : null;
                let web_button_text_color = (elem3 != null) ? elem3.value : null;
                let web_button_over_text_color = (elem4 != null) ? elem4.value : null;
                let web_button_color = (elem5 != null) ? elem5.value : null;
                this.campaign.web_text_color = web_text_color ? web_text_color : this.campaign.web_text_color;
                this.campaign.web_int_text_color = web_int_text_color ? web_int_text_color : this.campaign.web_int_text_color;
                this.campaign.web_button_text_color = web_button_text_color ? web_button_text_color : this.campaign.web_button_text_color;
                this.campaign.web_button_over_text_color = web_button_over_text_color ? web_button_over_text_color : this.campaign.web_button_over_text_color;
                this.campaign.web_button_color = web_button_color ? web_button_color : this.campaign.web_button_color;

                //Brand logo
                let brandlogo = document.querySelector('input[name="brand_logo"]');
                this.campaign.brand_logo = (brandlogo != null) ? brandlogo.value : this.campaign.brand_logo;

                axios.post('/admin/modules/nps/updateNPSCustomize', this.campaign)
                    .then(response => {
                        this.loading = false;
                    });

            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/nps/';
                }else{
                    path = '/admin#/nps/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },
            applyDefaultInfo: function (e) {
                if (e.target.checked) {
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname + ' ' + this.user.lastname;
                    this.updateSettings('from_email');
                    this.updateSettings('from_name');
                } else {

                }
            },
            updateSettings: function (fieldName, fieldValue,  type) {
                this.loading = true;

                if(type =='expiry'){
                    this.displayCustomLinkExpiry = fieldValue == 'custom' || fieldName =='txtInteger' || fieldName =='exp_duration' ? true : false;
                }
                axios.post('/admin/brandboost/saveOnsiteSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    brandboostId: this.campaignId,
                    linkExpiryData : this.campaign.link_expire_custom,
                    requestType: type

                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.loading = false;
                });

            },
            changeCampaignStatus: function(status){
                this.loading = true;
                axios.post('/admin/modules/nps/changeStatus', {
                    npsId: this.campaignId,
                    status: status,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            if(status == 'draft'){
                                this.successMsg = 'Campaign saved as a draft successfully';
                            }
                            if(status == 'active'){
                                this.successMsg = 'Campaign is active now';
                            }

                        }else{
                            this.errorMsg = 'Something went wrong';
                        }
                    });
            }
        }

    };

    function loadNPSJQScript(userid){
        var tkn = $('meta[name="_token"]').attr('content');
        /*$(".colorpicker-basic1").spectrum();
        $(".colorpicker-basic2").spectrum();
        $(".colorpicker-basic3").spectrum();
        $(".colorpicker-basic4").spectrum();*/

        $(".colorpicker-basic1").spectrum({
            change: function (color) {
                $('.colorpicker-basic1').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic1').val(color.toHexString());
            }
        });
        $(".colorpicker-basic2").spectrum({
            change: function (color) {
                $('.colorpicker-basic2').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic2').val(color.toHexString());
            }
        });
        $(".colorpicker-basic3").spectrum({
            change: function (color) {
                $('.colorpicker-basic3').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic3').val(color.toHexString());
            }
        });
        $(".colorpicker-basic4").spectrum({
            change: function (color) {
                $('.colorpicker-basic4').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic4').val(color.toHexString());
            }
        });



        var myDropzoneLogoImg = new Dropzone(
            '#uploadNPSBrandLogo', //id of drop zone element 1
            {
                url: 'dropzone/upload_s3_attachment/'+userid+'/nps',
                params: {
                    _token: tkn
                },
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {
                    if(response.xhr.responseText != "") {
                        $('.logo_img').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
                        var dropImage = $('#npsBrandLogo').val();
                        $.ajax({
                            url: '/admin/brandboost/DeleteObjectFromS3',
                            type: "POST",
                            data: {_token: tkn, dropImage: dropImage},
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                            }
                        });
                        $('#npsBrandLogo').val(response.xhr.responseText);
                    }
                }
            });
        myDropzoneLogoImg.on("complete", function(file) {
            myDropzoneLogoImg.removeFile(file);
        });
    }

</script>
<style scoped>
    .email_config_list li{
        width: 24.5% !important;
    }
    .email_review_config{
        width: 100%;
        position: relative !important;
    }
</style>



