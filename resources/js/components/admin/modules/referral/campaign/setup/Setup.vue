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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.status !='archive'" @click="saveDraft"> Save as draft</button>
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
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Sources</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Rewards</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(5)"><span class="num_circle"><span class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mb30">
                    <div class="col-md-12 text-center mt30">
                        <h3 class="fsize16 fw400 dark_500">How do you want to create a referral campaign?</h3>
                        <p class="fsize13 dark_200">Choose Template</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <label for="opt1" class="m0 w-100"
                               :class="{active: campaign.source_type=='email'}"
                               @click="setSource('email')"
                        >
                            <div class="broadcast_select_contact">
                                <label class="custmo_checkbox">
                                    <input class="check" id="opt1" type="radio" name="source_type" :checked="campaign.source_type=='email'">
                                    <span class="custmo_checkmark green_tr"></span>
                                </label>
                                <div class="img_box img_active" v-if="campaign.source_type=='email'">
                                    <img class="mt20" src="http://brandboost.io/assets/images/ref_email_act.png"/>
                                </div>
                                <div class="img_box img_inactive" v-else>
                                    <img class="mt20" src="http://brandboost.io/assets/images/ref_email.png"/>
                                </div>
                                <p class="fsize14 txt_dark fw500">Email</p>
                                <p class="fsize12 txt_grey fw300">Refer through Emails</p>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4 text-center">
                        <label for="opt2" class="m0 w-100"
                               :class="{active: campaign.source_type=='sms'}"
                               @click="setSource('sms')"
                        >
                            <div class="broadcast_select_contact">
                                <label class="custmo_checkbox">
                                    <input class="check" id="opt2" type="radio" name="source_type" :checked="campaign.source_type=='sms'">
                                    <span class="custmo_checkmark green_tr"></span>
                                </label>
                                <div class="img_box img_active" v-if="campaign.source_type=='sms'">
                                    <img class="mt20" src="http://brandboost.io/assets/images/ref_social_act.png"/>
                                </div>
                                <div class="img_box img_inactive" v-else>
                                    <img class="mt20" src="http://brandboost.io/assets/images/ref_social.png"/>
                                </div>
                                <p class="fsize14 txt_dark fw500">SMS</p>
                                <p class="fsize12 txt_grey fw300">Refer through SMS</p>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4 text-center">
                        <label for="opt3" class="m0 w-100"
                               :class="{active: campaign.source_type=='widget'}"
                               @click="setSource('widget')"
                        >
                            <div class="broadcast_select_contact">
                                <label class="custmo_checkbox">
                                    <input class="check" id="opt3" type="radio" name="source_type" :checked="campaign.source_type=='widget'">
                                    <span class="custmo_checkmark green_tr"></span>
                                </label>
                                <div class="img_box img_active" v-if="campaign.source_type=='widget'">
                                    <img class="mt20" src="http://brandboost.io/assets/images/ref_widget_act.png"/>
                                </div>
                                <div class="img_box img_inactive" v-else>
                                    <img class="mt20" src="http://brandboost.io/assets/images/ref_widget.png"/>
                                </div>
                                <p class="fsize14 txt_dark fw500">Widgets</p>
                                <p class="fsize12 txt_grey fw300">Refer through Widgets</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
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
            axios.get('/admin/modules/referral/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oReferral;
                    this.loading = false;
                });
        },
        methods: {
            setSource: function(source){
                this.loading = true;
                this.campaign.source_type = source;
                axios.post('/admin/modules/referral/updateSource', {
                    source_type: source,
                    ref_id: this.campaignId,
                    _token: this.csrf_token(),
                })
                    .then(response => {
                        this.displayMessage('success', 'Source has been updated successfully');
                        this.loading = false;
                    });
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/referral/';
                }else{
                    path = '/admin#/modules/referral/setup/'+this.campaignId+'/'+step;
                }
                window.location.href = path;
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

                    this.displayMessage('success', 'Test email sent successfully!');
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
                            this.displayMessage('success', 'Campaign saved as a draft successfully');
                        }else{
                            this.displayMessage('error', 'Something went wrong');
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
