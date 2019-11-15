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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(2)"> Next <span style="opacity: 1"><img
                            src="/assets/images/arrow-right-line-white.svg"/></span></button>
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
                                <li><a class="active" href="#"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Basic
                                    campaign info</a></li>
                                <li><a class="" href="#"><span class="num_circle"><span class="num">2</span><span
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Subject</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">This text will be displayed in the ‘Subject’
                                        field in your recepient’s email client.</p>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="fname" class="fsize12 fw300">EMAIL SUBJECT</label>
                                        <input type="text" class="form-control emoji h50" placeholder="Default subject"
                                               name="subject" v-model="campaign.subject"
                                               @change="updatesettings('subject')">
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
                                    <h3 class="dark_400 mb0 fsize14 fw300">Use default sender info &nbsp; <label
                                        class="custom-form-switch">
                                        <input class="field" type="checkbox" @click="applyDefaultInfo">
                                        <span class="toggle email"></span>
                                    </label></h3>
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
                                        <label for="Senderemail" class="fsize12 fw300">Sender email</label>
                                        <input type="text" class="form-control form-control-dark h50" id="Senderemail"
                                               placeholder="alen@brandboost.io" name="from_email"
                                               v-model="campaign.from_email" @change="updatesettings('from_email')">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Reply Management</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">Capture &amp; foreward reply from your
                                        customers.</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h3 class="dark_400 mb0 fsize14 fw300">Reply tracking &nbsp; <label
                                        class="custom-form-switch">
                                        <input class="field" type="checkbox" checked="">
                                        <span class="toggle email"></span>
                                    </label></h3>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="replyto" class="fsize12 fw300">Forward-to address</label>
                                        <input type="text" class="form-control form-control-dark h50" id="replyto"
                                               placeholder="alen@brandboost.io" name="reply_to"
                                               v-model="campaign.reply_to"
                                               @change="updatesettings('reply_to')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="fname" class="fsize12 fw300">Personalize “To-adress”</label>
                                        <input type="text" class="form-control form-control-dark h50" id="fname"
                                               placeholder="Include recepient’s name in “To”" name="fname">
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
            }
        },
        mounted() {
            axios.get('/admin/broadcast/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oBroadcast;
                    this.user = response.data.userData;
                    this.loading = false;
                });
        },
        methods: {
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/emails/broadcast';
                }else{
                    path = '/admin#/modules/emails/broadcast/setup/'+this.campaignId+'/'+step;
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

            }
        }

    };

</script>



