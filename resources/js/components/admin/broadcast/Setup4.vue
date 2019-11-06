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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"> Save as draft </button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(5)"> Next <span style="opacity: 1"><img src="/assets/images/arrow-right-line-white.svg"/></span></button>
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
                                <li><a class="active" href="#"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review & confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card col">
                            <div class="row mb10">
                                <div class="col-md-6">
                                    <div class="p0">
                                        <h3 class="htxt_medium_16 dark_700">Email details</h3>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p0">
                                        <button class="btn btn-sm-32 bkg_email_000 email_400 float-right pr20 pl10 shadow-none fw500" @click="displayStep(1)"><i class=""><img class="btn_pencil" src="/assets/images/pencil-fill.svg"/></i> &nbsp; Edit</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <p class="fsize14 fw500 dark_700 mb-2">{{this.campaign.subject}}</p>
                                    <p class="fsize14 fw400 dark_400 mb0">With our partnership with Google we have been tasked to help businesses.</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="fsize14 fw500 dark_700 mb-2">{{this.campaign.from_name}}</p>
                                    <p class="fsize14 fw400 dark_400 mb0">{{this.campaign.from_email}}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card col">
                            <div class="row mb10">
                                <div class="col-md-6">
                                    <div class="p0">
                                        <h3 class="htxt_medium_16 dark_700">Content and design</h3>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p0">
                                        <button class="btn btn-sm-32 bkg_email_000 email_400 float-right pr20 pl10 shadow-none fw500" @click="displayStep(2)"><i class=""><img class="btn_pencil" src="/assets/images/pencil-fill.svg"/></i> &nbsp; Edit</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="p-2 border br4 d-inline-block">
                                        <img src="/assets/images/preview_design.png" width="160" height="113">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <p class="fsize14 fw500 dark_700 mb-3">Preview:</p>
                                    <button class="btn btn-sm-32 bkg_email_000 email_400 pr20 pl10 shadow-none fw500"><i class=""><img class="btn_pencil" src="/assets/images/pencil-fill.svg"/></i> &nbsp; Preview</button><br>
                                    <button class="btn btn-sm-32 bkg_email_000 email_400 pr20 pl10 shadow-none mt10 fw500"><i class=""><img class="btn_pencil" src="/assets/images/pencil-fill.svg"/></i> &nbsp; Send test email</button>
                                </div>
                                <div class="col-md-5">
                                    <p class="fsize14 fw500 dark_700 mb-3">Content details:</p>
                                    <p class="fsize14 fw400 dark_400 mb0">Email type: Drag & Drop Editor</p>
                                    <p class="fsize14 fw400 dark_400 mb0">Plain text version: Preview or Edit</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card col">
                            <div class="row mb20">
                                <div class="col-md-6">
                                    <div class="p0">
                                        <h3 class="htxt_medium_16 dark_700">{{subscribers.total}} subscribers</h3>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p0">
                                        <button class="btn btn-sm-32 bkg_email_000 email_400 float-right pr20 pl10 shadow-none fw500" @click="displayStep(3)"><i class=""><img class="btn_pencil" src="/assets/images/pencil-fill.svg"/></i> &nbsp; Edit</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex">
                                <div class="col-md-6">
                                    <div class="p0">
                                        <h3 class="htxt_medium_16 dark_700 m0"><i><img src="/assets/images/add-circle-fill.svg"/></i> &nbsp; Include contacts</h3>
                                    </div>
                                    <div class="p20 pb0 pl0" v-html="importButtons"></div>
                                </div>



                                <div class="col-md-6">
                                    <div class="p0">
                                        <h3 class="htxt_medium_16 dark_700 m0"><i><img src="/assets/images/indeterminate-circle-fill.svg"/></i> &nbsp; Exclude contacts</h3>
                                    </div>
                                    <div class="p20 pb0 pl0" v-html="exportButtons"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row mt40">
                    <div class="col-md-12"><hr class="mb25"></div>
                    <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(3)"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6"><button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(5)">Save and continue <span><img src="/assets/images/arrow-right-line.svg"></span></button></div>
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
                importButtons: '',
                exportButtons: '',
                subscribers: '',
                user: {},
                breadcrumb: '',
            }
        },
        mounted() {
            axios.get('/admin/broadcast/setupViewSummary/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oBroadcast;
                    this.importButtons = response.data.sImportButtonsSummary;
                    this.exportButtons = response.data.sExcludButtonsSummary;
                    this.subscribers = response.data.allDataSubscribers;
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

            }
        }

    };

</script>



