<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.widget_title}} </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.status !='archive'" @click="changeCampaignStatus('0')"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="changeCampaignStatus('1')" >Publish <span><img
                            src="/assets/images/arrow-right-line.svg"></span>  </button>
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
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration
                                </a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>
                                    Integration</a></li>
                                <!--                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span-->
                                <!--                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>-->
                                <!--                                </li>-->
                                <!--                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span-->
                                <!--                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Scores</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="email_review_config p20">
                            <div class="bbot pb10 mb15">
                                <h2 class="fsize11 text-uppercase dark_200 m-0">Referral Widget</h2>
                            </div>
                            <div class="bbot pb10 mb15">
                                <p class="fsize11 text-uppercase dark_200 m-0">SELECT REFERRAL APP</p>
                            </div>

                            <div class="form-group mb10">

                                <div class="p0" v-for="(refAp ,index ) in referralApps">
                                    <h3 class="dark_400 mb0 fsize13 fw300">{{refAp.title}} &nbsp;
                                        <label class="custom-form-switch float-right">
                                            <input class="field"
                                                   type="radio"
                                                   v-bind:value="refAp.id" v-model="campaign.referral_id"
                                                   @change="autoSaveReferralWidget($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="email_review_config p20" style="width: 100%!important;">
                            <div class="bbot pb10 mb15">
                                <h2 class="fsize13 text-uppercase dark_200 m-0">Preview</h2>
                            </div>
                            <div class="card p0 m-auto text-center" v-html="preview">

                            </div>
                        </div>
                    </div>
                </div>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"   @click="displayStep(0)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="changeCampaignStatus('1')" >Publish <span><img
                            src="/assets/images/arrow-right-line.svg"></span>  </button>
                        <button class="btn btn-success btn-sm bkg_green_300 light_000 float-right mr-3" @click="autoSaveReferralWidget">Save Changes <span><img
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
                referralApps: {},
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
            axios.get('/admin/modules/referral/widget/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.campaign;
                    this.preview = response.data.preview;
                    this.referralApps = response.data.referralApps;
                    this.loading = false;
                });
        },
        methods: {
            autoSaveReferralWidget: function(e){
                this.loading = true;
                axios.post('/admin/modules/referral/auto-save-referral-widget',{
                    // params:{
                    referral_widget_id: this.campaignId,
                    referral_app_id: this.campaign.referral_id,
                    // hashcode: this.campaign.hashcode,
                    // }
                })
                    .then(response => {

                        this.refreshMessage = Math.random();
                        this.successMsg = 'Updated the changes successfully!!';
                        this.preview = response.data.preview;
                        this.loading = false;

                    });
            },

            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/referral/widget/';
                }else{
                    path = '/admin#/modules/referral/widget/setup/'+this.campaignId+'/'+step;
                }
                window.location.href = path;
            },

            changeCampaignStatus: function(status){
                this.loading = true;
                axios.post('/admin/modules/referral/updatReferralWidgetStatus', {
                    widgetID: this.campaignId,
                    status: status,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            if(status == '0'){
                                this.successMsg = 'Campaign saved as a draft successfully.';
                            }
                            if(status == '1'){
                                this.successMsg = 'Campaign is active now.';
                            }

                        }else{
                            this.errorMsg = 'Something went wrong';
                        }
                    });
            }
        }
    };
</script>
<style scoped>
    .email_config_list li{
        width: 19.5% !important;
    }
</style>
