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
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(3)"> Next <span style="opacity: 1"><img src="/assets/images/arrow-right-line-white.svg"/></span></button>
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
                                <li><a class="active" href="#"><span class="num_circle"><span class="num">2</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Content & Design</a></li>
                                <li><a href="#"><span class="num_circle"><span class="num">3</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a></li>
                                <li><a href="#"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review & confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div v-show="chooseTemplateSection">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="htxt_bold_20 dark_700 mb20 mt40">Select pre-made email template or create your own</h3>
                            <p class="htxt_normal_14 dark_200 mb40 mt20">It’s very easy to create or import!</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 text-center d-flex animate_top">
                            <div class="card br8 p0" @click="displayTemplateList" style="cursor: pointer;">
                                <div class="p40 pb20 col">
                                    <img src="/assets/images/networkoptimization.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb10 mt20">Select template</h3>
                                    <p class="htxt_normal_14 dark_200 mb20 mt10">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</p>

                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="javascript:void(0);" @click="displayTemplateList">View template library</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-flex animate_top">
                            <div class="card br8 p0 ">
                                <div class="p40 pb20 col">
                                    <img src="/assets/images/networkoptimization2.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb10 mt20">Drag & drop editor</h3>
                                    <p class="htxt_normal_14 dark_200 mb20 mt10">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</p>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="#">Create new email template</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-flex animate_top">
                            <div class="card br8 p0 ">
                                <div class="p40 pb20 col">
                                    <img src="/assets/images/scrollingstatementtext.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb10 mt20">Plain text</h3>
                                    <p class="htxt_normal_14 dark_200 mb20 mt10">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</p>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="#">Use plain text editor</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt40">
                        <div class="col-md-12"><hr class="mb25"></div>
                        <div class="col-8">
                            <h3 class="htxt_medium_16 dark_700 mb10 mt20">Import custom HTML template</h3>
                            <p class="htxt_normal_14 dark_200 mb20 mt10">Perfect for experts! Write or import your own HTML to build and send custom email.</p>
                        </div>
                        <div class="col-4"><button class="btn btn-md-44 bkg_none border2 dark_200 pl20 pr20 float-right fw500 fsize14 mt20"> <span class="ml0 mr10"><img src="/assets/images/download-cloud-line.svg"></span>Import HTML template</button></div>
                    </div>

                </div>
                <div v-show="listTemplateSection">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="fsize12 fw500 dark_200 ls4 mb20">TEMPLATES</h4>
                            <ul class="templates_list">
                                <li><a href="#"><strong><img src="/assets/images/menu-2-line.svg"/> All</strong> <span>345</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/heart-line.svg"/> My Templates</strong> <span>128</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> Events</strong> <span>62</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> General</strong> <span>26</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> Holiday</strong> <span>98</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> Layouts</strong> <span>38</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> Newsletter</strong> <span>56</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> Non-profit</strong> <span>13</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> Photography</strong> <span>86</span></a></li>
                                <li><a href="#"><strong><img src="/assets/images/folder-3-line.svg"/> Product / Service</strong> <span>31</span></a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box bkg_light_000">
                                            <img class="mt-5" src="/assets/images/circle-plus-90.png"/>
                                        </div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">Create new</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">3 column</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">Masongry Grid</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">Create new</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">3 column</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">Masongry Grid</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">Create new</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">3 column</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p12 text-center">
                                        <div class="temp_design_box"></div>
                                        <h3 class="htxt_bold_16 dark_700 mb10">Masongry Grid</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt40">
                    <div class="col-md-12"><hr class="mb25"></div>
                    <div class="col-6" v-show="chooseTemplateSection"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(1)"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6" v-show="chooseTemplateSection == false"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayChooseTemplateSection"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6"><button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(3)">Save and continue <span><img src="/assets/images/arrow-right-line.svg"></span></button></div>
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
                chooseTemplateSection: true,
                listTemplateSection: false,
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
            displayTemplateList: function(){
                this.chooseTemplateSection = false;
                this.listTemplateSection = true;
            },
            displayChooseTemplateSection: function(){
                this.chooseTemplateSection = true;
                this.listTemplateSection = false;
            },
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



