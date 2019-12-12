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
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
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
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Reviews</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(5)"><span class="num_circle"><span class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Media</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Basic Info</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">Name of the campaign and logo for the same</p>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="frm_bb_title" class="fsize12 fw300">Brand Boost Name</label>
                                        <input type="text" class="form-control emoji h50" placeholder="New Product on Site Boost" id="frm_bb_title"
                                               name="title" v-model="campaign.brand_title"
                                               @change="updatesettings('subject')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_logo_img" class="fsize12 fw300">Brand Logo</label>

                                        <input type="file" id="frm_logo_img" name="logo_img" class="form-control">
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="card p40 min_h_240">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Review Request info</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">This will be displayed in the ‘From’
                                        field.</p>
                                </div>
                                <div class="col-md-6 text-right">

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_from_name" class="fsize12 fw300">Review Request "Form" Name</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_from_name"
                                               placeholder="Alen Sultanic" name="from_name" v-model="feedbackResponse.from_name"
                                               @change="updatesettings('from_name')" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_from_email" class="fsize12 fw300">Review Request "Form" Email</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_from_email"
                                               placeholder="alen@brandboost.io" name="from_email"
                                               v-model="feedbackResponse.from_email" @change="updatesettings('from_email')" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_sender_phone" class="fsize12 fw300">Review Request SMS "Form" Number</label>
                                        <input type="text" name="sender_phone" class="form-control form-control-dark h50" id="frm_sender_phone" readonly="readonly"
                                               v-model="fromNumber ? fromNumber : user.mobile"  @change="updatesettings('from_email')" required>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card p40 min_h_240">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Review Link Expiry Settings</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">This ensure the expiry of the review links</p>
                                </div>
                                <div class="col-md-6 text-right">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb20">Automatically expire link after user leaves review?</label>
                                        <div class="clearfix"></div>
                                        <label class="custmo_radiobox pull-left mb10">
                                            <input name="review_expire" value="yes" type="radio">
                                            <span class="custmo_radiomark"></span>
                                            Yes
                                        </label>
                                        <div class="clearfix"></div>
                                        <label class="custmo_radiobox pull-left mb10">

                                            <input name="review_expire" value="no" checked="" type="radio">
                                            <span class="custmo_radiomark"></span>
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb20">Automatically expire link</label>
                                        <div class="clearfix"></div>
                                        <label class="custmo_radiobox pull-left mb10">
                                            <input name="review_expire_link" value="never" type="radio">
                                            <span class="custmo_radiomark"></span>
                                            Never Expire
                                        </label>
                                        <div class="clearfix"></div>
                                        <label class="custmo_radiobox pull-left mb10">

                                            <input name="review_expire_link" value="custom" checked="" type="radio">
                                            <span class="custmo_radiomark"></span>
                                            Expire After
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Thank you messages</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">Capture &amp; foreward reply from your
                                        customers.</p>
                                </div>
                                <div class="col-md-6 text-right">

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_positive_title" class="fsize12 fw300">Positive Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_positive_title"
                                               name="positive_title"
                                               v-model="feedbackResponse.pos_title"
                                               @change="updatesettings('reply_to')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_positive_subtitle" class="fsize12 fw300">Positive Sub Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_positive_subtitle"
                                               name="positive_subtitle"
                                               v-model="feedbackResponse.pos_sub_title"
                                               @change="updatesettings('reply_to')" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert bkg_green txt_white mt30 mb50 preview">
                                        <div class="media-left">
                                            <img src="/assets/images/thankyou_smiley_green.png">
                                        </div>
                                        <div class="media-left">
                                            <div class="thanksTitlePreview">
                                                {{feedbackResponse.pos_title}}
                                            </div>
                                            <div>
                                                <small class="thanksSubTitlePreview">
                                                    {{feedbackResponse.pos_sub_title}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_neutral_title" class="fsize12 fw300">Neutral Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_neutral_title"
                                               name="neutral_title"
                                               v-model="feedbackResponse.neu_title"
                                               @change="updatesettings('reply_to')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_neutral_subtitle" class="fsize12 fw300">Neutral Sub Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_neutral_subtitle"
                                               name="neutral_subtitle"
                                               v-model="feedbackResponse.neu_sub_title"
                                               @change="updatesettings('reply_to')" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert bkg_dark txt_white mt30 mb50 preview">
                                        <div class="media-left">
                                            <img src="/assets/images/thankyou_smiley_grey.png">
                                        </div>
                                        <div class="media-left">
                                            <div class="thanksTitlePreview">
                                                {{feedbackResponse.neu_title}}
                                            </div>
                                            <div>
                                                <small class="thanksSubTitlePreview">
                                                    {{feedbackResponse.neu_sub_title}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_negetive_title" class="fsize12 fw300">Negative Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_negetive_title"
                                               name="negetive_title"
                                               v-model="feedbackResponse.neg_title"
                                               @change="updatesettings('reply_to')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_negetive_subtitle" class="fsize12 fw300">Negative Sub Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_negetive_subtitle"
                                               name="negetive_subtitle"
                                               v-model="feedbackResponse.neg_sub_title"
                                               @change="updatesettings('reply_to')" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert bkg_red txt_white mt30 mb0 preview">
                                        <div class="media-left">
                                            <img src="/assets/images/thankyou_smiley_red.png">
                                        </div>
                                        <div class="media-left">
                                            <div class="thanksTitlePreview">
                                                {{feedbackResponse.neg_title}}
                                            </div>
                                            <div>
                                                <small class="thanksSubTitlePreview">
                                                    {{feedbackResponse.neg_sub_title}}
                                                </small>
                                            </div>
                                        </div>
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
                feedbackResponse: '',
                fromNumber: ''
            }
        },
        mounted() {
            axios.get('/admin/brandboost/onsite_setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.brandboostData;
                    this.feedbackResponse = response.data.feedbackResponse;
                    this.fromNumber = this.mobileNoFormat(response.data.fromNumber);
                    this.user = response.data.aUserInfo;
                    this.loading = false;
                });
        },
        methods: {
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/reviews/onsite';
                }else{
                    path = '/admin#/reviews/onsite/setup/'+this.campaignId+'/'+step;
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
    .bkg_green {
        background: #4ebc86!important;
        background-color: #4ebc86!important;
    }
    .alert.preview {
        padding: 20px 25px!important;
        border-radius: 5px;
    }
    .txt_white {
        color: #ffffff!important;
    }
    .media-left, .media > .pull-left {
        padding-right: 20px;
        position: relative;
        display: table-cell;
    }
    .alert.preview img {
        margin-top: 8px;
        opacity: 0.5;
    }
    .bkg_dark {
        background: #202040!important;
        background-color: #202040!important;
    }
    .bkg_red {
        background: #eb4f76!important;
        background-color: #eb4f76!important;
    }
</style>



