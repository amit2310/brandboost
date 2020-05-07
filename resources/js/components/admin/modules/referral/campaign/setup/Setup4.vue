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

            <loading :isLoading="loading"></loading>

            <div class="container-fluid">
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Sources</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Rewards</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a>
                                </li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(5)"><span class="num_circle"><span class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">General Configuration</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">Your Campaign details</p>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="frm_ref_title" class="fsize12 fw300">Campaign Name </label>
                                        <input type="text"
                                               class="form-control emoji h50"
                                               id="frm_ref_title"
                                               placeholder="Referral Title"
                                               v-model="form.referral_title"
                                               @change="updateSettings">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <h3 class="dark_400 mb0 fsize13 fw300 mt-4 pt-2">Active Campaign &nbsp;
                                        <label class="custom-form-switch float-right">
                                            <input
                                                class="field"
                                                type="checkbox"
                                                v-model="form.referralStatus"
                                                :checked="form.referralStatus == 'active' || form.referralStatus == true"
                                                @change="updateSettings"
                                            >
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Store Configuration</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">Your store related information</p>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_ref_store_name" class="fsize12 fw300">Store Name </label>
                                        <input type="text"
                                               class="form-control h50"
                                               id="frm_ref_store_name"
                                               placeholder="Your store name"
                                               v-model="form.storeName"
                                               @change="updateSettings">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_ref_store_url" class="fsize12 fw300">Store Url</label>
                                        <input
                                            type="text"
                                            class="form-control h50"
                                            id="frm_ref_store_url"
                                            placeholder="Your store url e.g. http://mystorename.com"
                                            v-model="form.storeURL"
                                            @change="updateSettings">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_ref_store_email" class="fsize12 fw300">Email Address</label>
                                        <input
                                            type="text"
                                            class="form-control h50"
                                            id="frm_ref_store_email"
                                            placeholder="Your store email address"
                                            v-model="form.storeEmail"
                                            @change="updateSettings">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Sharing Content </h3>
                                    <p class="fsize12 fw300 dark_300 mb20">Most Popular Social Network</p>
                                </div>

                                <div class="col-md-6">
                                    <h4 class="mt-3 mb-3">Facebook</h4>
                                    <div class="form-group">
                                        <label for="frm_ref_social_fbTitle" class="fsize12 fw300">Facebook Title </label>
                                        <input
                                            type="text"
                                            class="form-control h50"
                                            id="frm_ref_social_fbTitle"
                                            placeholder="Apple iPhone XR"
                                            v-model="form.facebook_title"
                                            @change="updateSettings">
                                    </div>
                                    <div class="form-group">
                                        <label for="frm_ref_social_fbDesc" class="fsize12 fw300">Facebook Description </label>
                                        <textarea
                                            class="form-control"
                                            rows="4"
                                            id="frm_ref_social_fbDesc"
                                            placeholder="The iPhone XR display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 5.85 inches diagonally (actual viewable area is less)."
                                            v-model="form.facebook_desc"
                                            @change="updateSettings"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mt-3 mb-3">Twitter</h4>
                                    <div class="form-group">
                                        <label for="frm_ref_social_TwtTitle" class="fsize12 fw300">Twitter Title </label>
                                        <input
                                            type="text"
                                            class="form-control h50"
                                            id="frm_ref_social_TwtTitle"
                                            rows="4"
                                            placeholder="Apple iPhone XR"
                                            v-model="form.twitter_title"
                                            @change="updateSettings"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="frm_ref_social_twtDesc" class="fsize12 fw300">Twitter Description </label>
                                        <textarea
                                            class="form-control"
                                            id="frm_ref_social_twtDesc"
                                            rows="4"
                                            placeholder="The iPhone XR display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 5.85 inches diagonally (actual viewable area is less)."
                                            v-model="form.twitter_desc"
                                            @change="updateSettings"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h4 class="mt-3 mb-3">Email/Link</h4>
                                    <div class="form-group">
                                        <label for="frm_ref_social_link" class="fsize12 fw300">Email Id/Link </label>
                                        <input
                                            type="text"
                                            class="form-control h50"
                                            id="frm_ref_social_link"
                                            placeholder=""
                                            v-model="form.site_link"
                                            @change="updateSettings">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(3)"><span
                            class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(5)">Save and continue <span><img
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
                settings: '',
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false,
                form: {
                    refid: this.$route.params.id,
                    referral_title: '',
                    storeName: '',
                    storeURL: '',
                    storeEmail: '',
                    referralStatus: 'draft',
                    facebook_title: '',
                    facebook_desc: '',
                    twitter_title: '',
                    twitter_desc: '',
                    site_link: ''
                }
            }
        },
        created() {
            axios.get('/admin/modules/referral/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oReferral;
                    this.settings = response.data.oAccountSettings;
                    this.loading = false;
                    //Setting up the form fields
                    this.form.referral_title = this.campaign.title;
                    this.form.referralStatus = this.campaign.status;
                    this.form.storeName = this.settings.store_name;
                    this.form.storeURL = this.settings.store_url;
                    this.form.storeEmail= this.settings.store_email;
                    this.form.facebook_title = this.settings.facebook_title;
                    this.form.facebook_desc = this.settings.facebook_desc;
                    this.form.twitter_title = this.settings.twitter_title;
                    this.form.twitter_desc = this.settings.twitter_desc;
                    this.form.site_link = this.settings.site_link;


                });
        },
        mounted() {

        },
        methods: {
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/referral/';
                }else{
                    path = '/admin#/modules/referral/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },
            updateSettings: function () {
                this.loading = true;
                axios.post('/admin/modules/referral/saveSettings', this.form).then(response => {
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



