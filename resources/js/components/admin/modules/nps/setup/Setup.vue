<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.brand_title}} </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="saveDraft"> Save as draft</button>
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
                                <p class="fsize11 text-uppercase dark_200 m-0">Component</p>
                            </div>
                            <div class="p0">
                                <h3 v-if="campaign.platform !='sms'" class="dark_400 mb0 fsize13 fw300">Logo &nbsp;
                                    <label class="custom-form-switch float-right">
                                        <input class="field" type="checkbox" :checked="campaign.display_logo">
                                        <span class="toggle email"></span> </label>
                                </h3>
                                <h3 class="dark_400 mb0 fsize13 fw300">Question &nbsp;
                                    <label class="custom-form-switch float-right">
                                        <input class="field" type="checkbox" v-model="campaign.display_additional" :checked="campaign.display_additional">
                                        <span class="toggle email"></span> </label>
                                </h3>
                                <h3 class="dark_400 mb0 fsize13 fw300">Introduction &nbsp;
                                    <label class="custom-form-switch float-right">
                                        <input class="field" type="checkbox" v-model="campaign.display_intro" :checked="campaign.display_intro">
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
                                        class="form-control"
                                        id="Questions"
                                        name="question"
                                        :placeholder="`How likely are you to recommend ${campaign.brand_name ? campaign.brand_name : 'My Store'} to a friend?`"
                                        v-model="campaign.question"
                                        ></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="fsize12" for="Introduction">Introduction:</label>
                                    <textarea
                                        class="form-control"
                                        rows="4"
                                        id="Introduction"
                                        placeholder="Placeholder Text"
                                        name="description"
                                        v-model="campaign.description"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="m0 w-100" for="upload">
                                        <div class="img_vid_upload_medium">
                                            <input class="d-none" type="file" name="brand_logo" id="upload">
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
                                               name="web_text_color111"
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
                                               v-model="campaign.web_button_color"
                                               >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="button" @click="updateConfigurations" class="btn btn-success btn-sm bkg_green_300 light_000 mt-5 ml-3" value="Save Configurations">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card p0 m-auto text-center" style="max-width:500px;">
                            <div class="text-center p30 bbot mb0"> <img width="70" class="mb20" src="assets/images/avatar/02.png"/>
                                <p class="fsize14 fw500 dark_700 mb-2"> Mr. Anderson</p>
                                <p class="fsize14 fw400 dark_300">Test Tester</p>
                                <div class="text-center border shadow br5">
                                    <div class="p20 bbot">
                                        <p class="fsize14 fw500 dark_700 mb-2">How Likely are you to Recommend <br>
                                            My store to a friend ?</p>
                                    </div>
                                    <div class="p20">
                                        <ul class="inline_numbers">
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">6</a></li>
                                            <li><a href="#">7</a></li>
                                            <li><a href="#">8</a></li>
                                            <li><a href="#">9</a></li>
                                            <li><a href="#">10</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="p20">
                                <p class="fsize11 fw400 dark_200 mb-2">If you don't know why you got this email, please tell us straight away so we can fix <br>
                                    this for you. </p>
                                <p class="mb-0">Thanks</p>
                                <p class="fsize14 fw500 m-0"> Brandboost Team</p>
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
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(2)">Save and continue <span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>


            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>
<script>
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
                displayCustomLinkExpiry: false
            }
        },
        created() {
            axios.get('/admin/modules/nps/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oNPS;
                    this.user = response.data.userData;
                    this.loading = false;

                });
        },
        mounted() {
            setTimeout(function(){
                loadJQScript();
            }, 500);

        },
        computed: {

        },
        methods: {
            updateConfigurations: function(){
                this.loading = true;
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

    function loadJQScript(){
        $(".colorpicker-basic1").spectrum();
        $(".colorpicker-basic2").spectrum();
        $(".colorpicker-basic3").spectrum();
        $(".colorpicker-basic4").spectrum();
    }

</script>
<style scoped>
    .email_config_list li{
        width: 24.5% !important;
    }
    .email_review_config{
        width:300px !important;
    }
</style>



