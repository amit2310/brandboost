<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{this.campaign.title}}</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="saveDraft"> Save as draft </button>
                        <button class="btn btn-md bkg_email_300 light_000 slidebox"> Next <span style="opacity: 1"><img src="/assets/images/arrow-right-line-white.svg"/></span></button>
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
                                <li><a class="done" href="#"><span class="num_circle"><span class="num">1</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Basic campaign info</a></li>
                                <li><a class="done" href="#"><span class="num_circle"><span class="num">2</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Content & Design</a></li>
                                <li><a class="done" href="#"><span class="num_circle"><span class="num">3</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a></li>
                                <li><a class="done" href="#"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review & confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="htxt_bold_20 dark_700 mb20 mt40">Are you ready to send this email to 1,389 subscribers?</h3>
                        <p class="htxt_normal_14 dark_200 mb40 mt20">It’s very easy to create or import!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 text-center animate_top">
                        <label for="opt1" class="d-block mylablel">
                            <div class="card br8 p0 m-0">

                                <label class="custmo_checkbox email_config">
                                    <input id="opt1" type="checkbox">
                                    <span class="custmo_checkmark"></span>

                                </label>


                                <div class="p40 pb20">
                                    <img class="mt20" src="/assets/images/send-right-now.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb30 mt30">Send right now</h3>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="#">Send email immediately</a>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-6 text-center animate_top">
                        <label for="opt2" class="d-block mylablel active">
                            <div class="card br8 p0 m-0">
                                <label class="custmo_checkbox email_config">
                                    <input id="opt2" type="checkbox" checked>
                                    <span class="custmo_checkmark"></span>
                                </label>
                                <div class="p40 pb20">
                                    <img class="mt20" src="/assets/images/schedule.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb30 mt30">Send specific time</h3>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="#">Schedule email on time or date</a>
                                </div>
                            </div>
                        </label>


                    </div>

                </div>

                <div class="row mt40">
                    <div class="col-md-12"><hr class="mb25"></div>
                    <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(4)"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6"><button class="btn btn-sm bkg_email_300 light_000 float-right" @click="launchCampaign">Launch Campaign <span><img src="/assets/images/arrow-right-line.svg"></span></button></div>
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
                let path = '/admin#/modules/emails/broadcast/setup/'+this.campaignId+'/'+step;
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
            },
            launchCampaign: function(){
                if(confirm('Are you sure? This will make your campaign active')){
                    this.loading = true;
                    axios.post('/admin/broadcast/updateBroadcast', {
                        broadcastId: this.campaignId,
                        status: 'active',
                        current_state: '',
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            this.loading = false;
                            if(response.data.status == 'success'){
                                this.successMsg = 'Campaign has been launched successfully';
                            }else{
                                this.errorMsg = 'Something went wrong';
                            }
                        });
                }

            }
        }

    };

</script>



