<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{this.campaign.title}} </h3>
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



            <div class="container-fluid">
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a class="active" href="javascript:void(0)"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Basic
                                    campaign info</a></li>
                                <li><a class="" href="javascript:void(0)" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Content &
                                    Design</a></li>
                                <li><a href="javascript:void(0)" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a href="javascript:void(0)" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review &
                                    confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Sms Campaign Name</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">This is nothing but just the name of this campaign for your record.</p>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="fsize12 fw300">Name</label>
                                        <input type="text" class="form-control emoji h50" placeholder="Default subject"
                                                v-model="campaign.title"
                                               @change="updatesettings('title')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="PERSONALIZATION" class="fsize12 fw300">PERSONALIZATION</label>

                                        <select class="form-control h50" id="PERSONALIZATION">
                                            <option>Personalize</option>
                                            <option>Personalize</option>
                                            <option>Personalize</option>
                                            <option>Personalize</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="card p40 min_h_240">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Sender info</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">This will be displayed in the ‘From’
                                        field.</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <!--<h3 class="dark_400 mb0 fsize14 fw300">Use default sender info &nbsp; <label
                                        class="custom-form-switch">
                                        <input class="field" type="checkbox" @click="applyDefaultInfo">
                                        <span class="toggle email"></span>
                                    </label></h3>-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Sendername" class="fsize12 fw300">Sender name</label>
                                        <input type="text" class="form-control form-control-dark h50" id="Sendername"
                                               placeholder="Alen Sultanic" name="from_name" v-model="campaign.from_name"
                                               @change="updatesettings('from_name')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Senderemail" class="fsize12 fw300">Sender phone number</label>
                                        <input type="text" class="form-control form-control-dark h50" id="Senderemail" readonly
                                               placeholder="alen@brandboost.io" name="from_number"
                                               :value="twilioData.contact_no">
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



                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                twilioData: ''
            }
        },
        mounted() {
            axios.get('/admin/broadcast/smsSetup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oBroadcast;
                    this.twilioData = response.data.twillioData;
                    this.user = response.data.userData;
                    this.showLoading(false);
                });
        },
        methods: {
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/sms/broadcast';
                }else{
                    path = '/admin#/modules/sms/broadcast/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
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
                this.showLoading(true);
                axios.post('/admin/broadcast/updateBroadcastSettingUnit', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: this.campaign[fieldName],
                    event_id: this.campaign.event_id,
                    campaign_id: this.campaign.id,
                    broadcast_id: this.campaign.broadcast_id
                }).then(response => {
                    this.displayMessage('success', 'Test email sent successfully!');
                    this.showLoading(false);
                });

            },
            saveDraft: function(){
                this.showLoading(true);
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.showLoading(false);
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



