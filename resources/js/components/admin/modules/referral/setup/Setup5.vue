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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Sources</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Rewards</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a>
                                </li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a></li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card p40 min_h_240">

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="htxt_bold_16 dark_700 mb10">Invite Code</h3>
                            <p class="fsize12 fw300 dark_300 mb20">Embed code into your website</p>
                        </div>

                        <div class="col-md-8">
                            <code>
                            <pre class="prettyprint invite_code_copy">
&lt;script
    type="text/javascript"
    id="bbscriptloader"
    data-key="{{campaign.hashcode}}"
    data-widgets="referral"
    async="true"
    src="http://brandboostx.com/assets/js/ref_widgets.js"&gt;
&lt;/script&gt;</pre></code>
                            <button class="btn btn-sm bkg_green_300 light_000 float-left" type="button" onclick="copyToClipboard('.invite_code_copy')">Copy Code
                                <span>&nbsp;</span>
                            </button>
                        </div>

                        <div class="col-md-4">
                            <div style="margin-top:-35px;">
                                <h6 class="pb-3">How to add widget</h6>
                                <div>
                                    <iframe class="embed-responsive-item br0"  src="https://www.youtube.com/embed/2H_Jsgh2Z3Y?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="card p40 min_h_240">

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="htxt_bold_16 dark_700 mb10">Post Purchase Code</h3>
                            <p class="fsize12 fw300 dark_300 mb20">Embed code into your website</p>
                        </div>

                        <div class="col-md-8">
                            <code>
                            <pre class="prettyprint copySaleWithoutPopup">
&lt;div id="bb-invoice_details"
        data-bb-firstname="Alen"
        data-bb-lastname="Sultanic"
        data-bb-email="umair.products@gmail.com"
        data-bb-invoice-id="12345"
        data-bb-amount="10"
        data-bb-currency="USD"
        data-bb-timestamp={{new Date().getTime()}}&gt;
&lt;/div&gt;
&lt;script type="text/javascript"
         id="bbscriptloader"
         data-key="{{campaign.hashcode}}"
         data-widgets="referral-sale"
         async="true"
         src="http://brandboostx.com/assets/js/ref_widgets.js"&gt;
&lt;/script&gt;
                            </pre></code>
                            <button class="btn btn-sm bkg_green_300 light_000 float-left" type="button" onclick="copyToClipboard('.copySaleWithoutPopup')">Copy Code
                                <span>&nbsp;</span>
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div style="margin-top:-50px;">
                                <h6 class="pb-3">You’re All Set!</h6>
                                <div>
                                    <div class="m0">
                                        <p>Visit your store's dashboard and find your purchase completed page.Paste this code just before the closing body tag on your purchase completed page after replacing these dynamic variables: You must replace the following dummy fields in the code snippet with dynamic checkout data from your store platform:
                                        </p>
                                    </div>
                                    <div class="">
                                        <p class="fsize11 text-muted m0">
                                            data-bb-firstname: Customer First Name<br><br>

                                            data-bb-lastname: Customer Last Name<br><br>

                                            data-bb-email: Customer Email Address<br><br>

                                            data-bb-invoice-id: Invoice Number<br><br>

                                            data-bb-amount: Invoice Amount<br><br>

                                            data-bb-currency: Invoice Currency (3 letter code)<br><br>

                                            data-bb-timestamp: Purchase Timestamp (UNIX time)<br><br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="card p40 min_h_240">

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="htxt_bold_16 dark_700 mb10">Post Purchase Code with Referral Popup</h3>
                            <p class="fsize12 fw300 dark_300 mb20">Display Referral popup after successful purchase</p>
                        </div>

                        <div class="col-md-8">
                            <code>
                            <pre class="prettyprint copySalePopup">
&lt;div id="bb-invoice_details"
        data-bb-firstname="Alen"
        data-bb-lastname="Sultanic"
        data-bb-email="umair.products@gmail.com"
        data-bb-invoice-id="12345"
        data-bb-amount="10"
        data-bb-currency="USD"
        data-bb-timestamp="{{new Date().getTime()}}"
        data-bb-showwidget="true"&gt;
&lt;/div&gt;
&lt;script type="text/javascript"
         id="bbscriptloader"
         data-key="{{campaign.hashcode}}"
         data-widgets="referral-sale"
         async="true"
         src="http://brandboostx.com/assets/js/ref_widgets.js"&gt;
&lt;/script&gt;
                            </pre></code>
                            <button class="btn btn-sm bkg_green_300 light_000 float-left" type="button" onclick="copyToClipboard('.copySalePopup')">Copy Code
                                <span>&nbsp;</span>
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div style="margin-top:-50px;">
                                <h6 class="pb-3">You’re All Set!</h6>
                                <div>
                                    <div class="m0">
                                        <p>Visit your store's dashboard and find your purchase completed page.Paste this code just before the closing body tag on your purchase completed page after replacing these dynamic variables: You must replace the following dummy fields in the code snippet with dynamic checkout data from your store platform:
                                        </p>
                                    </div>
                                    <div class="">
                                        <p class="fsize11 text-muted m0">
                                            data-bb-firstname: Customer First Name<br><br>

                                            data-bb-lastname: Customer Last Name<br><br>

                                            data-bb-email: Customer Email Address<br><br>

                                            data-bb-invoice-id: Invoice Number<br><br>

                                            data-bb-amount: Invoice Amount<br><br>

                                            data-bb-currency: Invoice Currency (3 letter code)<br><br>

                                            data-bb-timestamp: Purchase Timestamp (UNIX time)<br><br>
                                        </p>
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
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(4)"><span
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
            axios.get('/admin/modules/referral/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oReferral;
                    this.loading = false;
                });
        },
        mounted() {

        },
        methods: {
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/referral/';
                }else{
                    path = '/admin#/referral/setup/'+this.campaignId+'/'+step;
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



</script>
<style scoped>
    .email_config_list li{
        width: 19.5% !important;
    }
</style>



