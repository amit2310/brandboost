<template>
    <div class="content">
        <!--****************** Top Heading area  **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">On Site Widget Setup
<!--                            {{campaign.brand_title}} -->
                        </h3>
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

        <!--****************** Content area *********************-->
        <div class="content-area">
            <div class="container-fluid">
                <div class="table_head_action">

                    <loading :isLoading="loading"></loading>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review Widgets</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Statistics</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 review_source_new bwwCWBox reviewWidgetBox">
                        <label for="radiocheck1"  @change="setWidgetType">
                            <div class="inner" :class="{ 'active': campaign.widget_type == 'bww'}" >
                                    <span class="custmo_checkbox checkboxs">
                                        <input :checked="campaign.widget_type == 'bww'" v-model="campaign.widget_type" value="bww"   id="radiocheck1" type="radio" name="widgetList" class="selectwidget" widget-id="bww">
                                        <span class="custmo_checkmark purple"></span>
                                    </span>
                                <figure><img src="assets/images/review_source1_new.png"/></figure>
                                <div class="text_sec">
                                    <p><strong>Small Popup</strong></p>
                                    <h5>Displays reviews in a fixed vertical popup positioned on the left or right side</h5>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-2 review_source_new bfwCWBox reviewWidgetBox">
                        <label for="radiocheck2" @change="setWidgetType">
                            <div class="inner" :class="{ 'active': campaign.widget_type == 'bfw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input  :checked="campaign.widget_type == 'bfw'" value="bfw" v-model="campaign.widget_type"  id="radiocheck2" type="radio" name="widgetList" class="selectwidget" widget-id="bfw">
                                <span class="custmo_checkmark purple"></span>
                            </span>
                                <figure><img src="assets/images/review_source2_new.png"/></figure>
                                <div class="text_sec">
                                    <p><strong>Horizontal Popup</strong></p>
                                    <h5>Displays 4 latest review in a bottom fixed scrollable reviews panel</h5>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-2 review_source_new cpwCWBox reviewWidgetBox">
                        <label for="radiocheck3" @change="setWidgetType">
                            <div class="inner" :class="{ 'active': campaign.widget_type == 'cpw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input :checked="campaign.widget_type == 'cpw'" value="cpw" v-model="campaign.widget_type" id="radiocheck3" type="radio" name="widgetList" class="selectwidget" widget-id="cpw">
                                <span class="custmo_checkmark purple"></span>
                            </span>

                                <figure><img src="assets/images/review_source3_new.png"/></figure>
                                <div class="text_sec">
                                    <p><strong>Center Popup</strong></p>
                                    <h5>Displays reviews in a lightbox slider with full focus on the details</h5>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-2 review_source_new vpwCWBox reviewWidgetBox">
                        <label for="radiocheck4" @change="setWidgetType">
                            <div class="inner" :class="{ 'active': campaign.widget_type == 'vpw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input :checked="campaign.widget_type == 'vpw'" value="vpw" v-model="campaign.widget_type" id="radiocheck4" type="radio" name="widgetList" class="selectwidget" widget-id="vpw">
                                <span class="custmo_checkmark purple"></span>
                            </span>

                                <figure><img src="assets/images/review_source4_new.png"/></figure>
                                <div class="text_sec">
                                    <p><strong>Vertical Popup</strong></p>
                                    <h5>Displays reviews in a scrollable feed component on page</h5>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-2 review_source_new rfwCWBox reviewWidgetBox">
                        <label for="radiocheck5" @change="setWidgetType">
                            <div class="inner"  :class="{ 'active': campaign.widget_type == 'rfw'}">
                                <span class="custmo_checkbox checkboxs">
                                    <input :checked="campaign.widget_type == 'rfw'"  value="rfw" v-model="campaign.widget_type" id="radiocheck5" type="radio" name="widgetList" class="selectwidget" widget-id="rfw">
                                    <span class="custmo_checkmark purple"></span>
                                </span>
                                <figure><img src="assets/images/review_source5_new.png"/></figure>
                                <div class="text_sec">
                                    <p><strong>Embeded Reviews</strong></p>
                                    <h5>Displays reviews in a lightbox slider with full focus on the details</h5>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="card p40 min_h_240">-->

<!--                            <div class="row">-->
<!--                                <div class="col-md-12">-->
<!--                                    <h3 class="htxt_bold_16 dark_700 mb10">Basic Info</h3>-->
<!--                                    <p class="fsize12 fw300 dark_300 mb20">Name of the campaign and logo for the same</p>-->
<!--                                </div>-->

<!--                                <div class="col-md-4">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="frm_bb_title" class="fsize12 fw300">Brand Boost Name</label>-->
<!--                                        <input type="text" class="form-control emoji h50" placeholder="New Product on Site Boost"-->
<!--                                               name="title" v-model="campaign.brand_title"-->
<!--                                               @change="updateSettings('brand_title', $event.target.value, 'brandboost')">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="frm_bb_title" class="fsize12 fw300">Domain</label>-->
<!--                                        <input type="text" class="form-control emoji h50" placeholder="www.google.com"-->
<!--                                               name="domain_name" v-model="campaign.domain_name"-->
<!--                                               @change="updateSettings('domain_name', $event.target.value, 'brandboost')">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-3">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="logo_img" class="fsize12 fw300">Add/Change Brand Logo</label>-->

<!--                                        <input type="hidden" id="logo_img" name="logo_img" @click="updateSettings('logo_img', $event.target.value, 'brandboost')">-->
<!--                                        <div class="img_vid_upload_small">-->
<!--                                            <div class="dropzone" id="myDropzone_logo_img"></div>-->
<!--                                        </div>-->

<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-1">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="logo_img" class="fsize12 fw300">Brand Logo</label>-->
<!--                                        <div class="clearfix"></div>-->
<!--                                        <img width="64" height="65" class="rounded" id="showLogoImage" onerror="this.src='assets/images/default-logo.png'" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/${campaign.logo_img}`">-->
<!--                                    </div>-->
<!--                                </div>-->



<!--                            </div>-->

<!--                        </div>-->


<!--                        <div class="card p40 min_h_240">-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <h3 class="htxt_bold_16 dark_700 mb10">Review Request info</h3>-->
<!--                                    <p class="fsize12 fw300 dark_300 mb20">This will be displayed in the ‘From’-->
<!--                                        field.</p>-->
<!--                                </div>-->
<!--                                <div class="col-md-6 text-right">-->

<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="frm_from_name" class="fsize12 fw300">Review Request "Form" Name</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_from_name"-->
<!--                                               placeholder="Alen Sultanic" name="from_name" v-model="feedbackResponse.from_name"-->
<!--                                               @change="updateSettings('from_name', $event.target.value, 'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="frm_from_email" class="fsize12 fw300">Review Request "Form" Email</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_from_email"-->
<!--                                               placeholder="alen@brandboost.io" name="from_email"-->
<!--                                               v-model="feedbackResponse.from_email" @change="updateSettings('from_email', $event.target.value, 'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                                <div class="col-md-4">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="frm_sender_phone" class="fsize12 fw300">Review Request SMS "Form" Number</label>-->
<!--                                        <input type="text" name="sender_phone" class="form-control form-control-dark h50" id="frm_sender_phone" readonly="readonly"-->
<!--                                               v-model="fromNumber ? fromNumber : user.mobile"  required>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                            </div>-->

<!--                        </div>-->

<!--                        <div class="card p40 min_h_240">-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <h3 class="htxt_bold_16 dark_700 mb10">Review Link Expiry Settings</h3>-->
<!--                                    <p class="fsize12 fw300 dark_300 mb20">This ensure the expiry of the review links</p>-->
<!--                                </div>-->
<!--                                <div class="col-md-6 text-right">-->

<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="control-label mb20">Automatically expire link after user leaves review?</label>-->
<!--                                        <div class="clearfix"></div>-->
<!--                                        <label class="custmo_radiobox pull-left mb10">-->
<!--                                            <input name="link_expire_review" value="yes" type="radio" :checked="campaign.link_expire_review == 'yes'" @change="updateSettings('link_expire_review', $event.target.value, 'brandboost')">-->
<!--                                            <span class="custmo_radiomark"></span>-->
<!--                                            Yes-->
<!--                                        </label>-->
<!--                                        <div class="clearfix"></div>-->
<!--                                        <label class="custmo_radiobox pull-left mb10">-->

<!--                                            <input name="link_expire_review" value="no" :checked="campaign.link_expire_review == 'no'" type="radio" @change="updateSettings('link_expire_review', $event.target.value, 'brandboost')">-->
<!--                                            <span class="custmo_radiomark"></span>-->
<!--                                            No-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="control-label mb20">Automatically expire link</label>-->
<!--                                        <div class="clearfix"></div>-->
<!--                                        <label class="custmo_radiobox pull-left mb10">-->
<!--                                            <input name="link_expire_custom" value="never" :checked="checkLinkExpiry.delay_value == 'never'" type="radio" @change="updateSettings('link_expire_custom', $event.target.value, 'expiry')">-->
<!--                                            <span class="custmo_radiomark"></span>-->
<!--                                            Never Expire-->
<!--                                        </label>-->
<!--                                        <div class="clearfix"></div>-->
<!--                                        <label class="custmo_radiobox pull-left mb10">-->

<!--                                            <input name="link_expire_custom" value="custom" type="radio" :checked="checkLinkExpiry.delay_value != 'never'" @change="updateSettings('link_expire_custom', $event.target.value, 'expiry')">-->
<!--                                            <span class="custmo_radiomark"></span>-->
<!--                                            Expire After-->
<!--                                        </label>-->
<!--                                        <div class="expireLinkBox" v-show="displayCustomLinkExpiry">-->
<!--                                            <div class="form-group">-->
<!--                                                <input type="number" name="txtInteger"  v-model="checkLinkExpiry.delay_value" size="3" class="numaric_only form-control daysnumber2" @change="updateSettings('txtInteger', $event.target.value, 'expiry')">-->
<!--                                            </div>-->
<!--                                            <div class="form-group">-->
<!--                                                <select class="form-control" v-model="checkLinkExpiry.delay_unit" name="exp_duration" @change="updateSettings('exp_duration', $event.target.value, 'expiry')">-->
<!--                                                    <option value="day">Day</option>-->
<!--                                                    <option value="week">Week</option>-->
<!--                                                    <option value="month">Month</option>-->
<!--                                                    <option value="year">Year</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                        </div>-->

<!--                        <div class="card p40 min_h_240">-->

<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <h3 class="htxt_bold_16 dark_700 mb10">Thank you messages</h3>-->
<!--                                    <p class="fsize12 fw300 dark_300 mb20">Capture &amp; foreward reply from your-->
<!--                                        customers.</p>-->
<!--                                </div>-->
<!--                                <div class="col-md-6 text-right">-->

<!--                                </div>-->

<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group mb0">-->
<!--                                        <label for="frm_positive_title" class="fsize12 fw300">Positive Title</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_positive_title"-->
<!--                                               name="positive_title"-->
<!--                                               v-model="feedbackResponse.pos_title"-->
<!--                                               @change="updateSettings('pos_title', $event.target.value, 'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group mb0">-->
<!--                                        <label for="frm_positive_subtitle" class="fsize12 fw300">Positive Sub Title</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_positive_subtitle"-->
<!--                                               name="positive_subtitle"-->
<!--                                               v-model="feedbackResponse.pos_sub_title"-->
<!--                                               @change="updateSettings('pos_sub_title', $event.target.value,'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-12">-->
<!--                                    <div class="alert bkg_green txt_white mt30 mb50 preview">-->
<!--                                        <div class="media-left">-->
<!--                                            <img src="/assets/images/thankyou_smiley_green.png">-->
<!--                                        </div>-->
<!--                                        <div class="media-left">-->
<!--                                            <div class="thanksTitlePreview">-->
<!--                                                {{feedbackResponse.pos_title}}-->
<!--                                            </div>-->
<!--                                            <div>-->
<!--                                                <small class="thanksSubTitlePreview">-->
<!--                                                    {{feedbackResponse.pos_sub_title}}-->
<!--                                                </small>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->



<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group mb0">-->
<!--                                        <label for="frm_neutral_title" class="fsize12 fw300">Neutral Title</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_neutral_title"-->
<!--                                               name="neutral_title"-->
<!--                                               v-model="feedbackResponse.neu_title"-->
<!--                                               @change="updateSettings('neu_title', $event.target.value, 'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group mb0">-->
<!--                                        <label for="frm_neutral_subtitle" class="fsize12 fw300">Neutral Sub Title</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_neutral_subtitle"-->
<!--                                               name="neutral_subtitle"-->
<!--                                               v-model="feedbackResponse.neu_sub_title"-->
<!--                                               @change="updateSettings('neu_sub_title', $event.target.value, 'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-12">-->
<!--                                    <div class="alert bkg_dark txt_white mt30 mb50 preview">-->
<!--                                        <div class="media-left">-->
<!--                                            <img src="/assets/images/thankyou_smiley_grey.png">-->
<!--                                        </div>-->
<!--                                        <div class="media-left">-->
<!--                                            <div class="thanksTitlePreview">-->
<!--                                                {{feedbackResponse.neu_title}}-->
<!--                                            </div>-->
<!--                                            <div>-->
<!--                                                <small class="thanksSubTitlePreview">-->
<!--                                                    {{feedbackResponse.neu_sub_title}}-->
<!--                                                </small>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->



<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group mb0">-->
<!--                                        <label for="frm_negetive_title" class="fsize12 fw300">Negative Title</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_negetive_title"-->
<!--                                               name="negetive_title"-->
<!--                                               v-model="feedbackResponse.neg_title"-->
<!--                                               @change="updateSettings('neg_title', $event.target.value,'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group mb0">-->
<!--                                        <label for="frm_negetive_subtitle" class="fsize12 fw300">Negative Sub Title</label>-->
<!--                                        <input type="text" class="form-control form-control-dark h50" id="frm_negetive_subtitle"-->
<!--                                               name="negetive_subtitle"-->
<!--                                               v-model="feedbackResponse.neg_sub_title"-->
<!--                                               @change="updateSettings('neg_sub_title', $event.target.value,'feedback')" required>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-12">-->
<!--                                    <div class="alert bkg_red txt_white mt30 mb0 preview">-->
<!--                                        <div class="media-left">-->
<!--                                            <img src="/assets/images/thankyou_smiley_red.png">-->
<!--                                        </div>-->
<!--                                        <div class="media-left">-->
<!--                                            <div class="thanksTitlePreview">-->
<!--                                                {{feedbackResponse.neg_title}}-->
<!--                                            </div>-->
<!--                                            <div>-->
<!--                                                <small class="thanksSubTitlePreview">-->
<!--                                                    {{feedbackResponse.neg_sub_title}}-->
<!--                                                </small>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row mt40">-->
<!--                    <div class="col-md-12">-->
<!--                        <hr class="mb25">-->
<!--                    </div>-->
<!--                    <div class="col-6">-->
<!--                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(0)"><span class="ml0 mr10"><img-->
<!--                            src="/assets/images/arrow-left-line.svg"></span>Back-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <div class="col-6">-->
<!--                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(2)">Save and continue <span><img-->
<!--                            src="/assets/images/arrow-right-line.svg"></span></button>-->
<!--                    </div>-->
<!--                </div>-->


            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>

<script>

    export default {
        title: 'Onsite Widgets - Brand Boost',
        // data() {
        //     return {
        //         form: {
        //             campaignName: '',
        //         },
        //
        //
        //         loading: true,
        //         widget_type: '',
        //         widget:{
        //             widgetData:{widget_type:''}
        //         },
        //         widgetID:''
        //     }
        // },
        data() {
            return {
                refreshMessage: 1,


                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                widget_type: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false
            }
        },

        mounted() {
            this.widgetID = this.$route.params.id;
            this.widget_type = this.$route.params.id;
            this.getWidgetDetails()
            // loadJQScript(35);
        },
        computed: {
            checkLinkExpiry: function(){
                let linkExpiry = this.campaign.link_expire_custom;
                if(linkExpiry){
                    let aExpiryData = JSON.parse(linkExpiry);
                    let delayValue = aExpiryData.delay_value;
                    let delayUnit = aExpiryData.delay_unit;
                    if(delayValue != 'never'){
                        this.displayCustomLinkExpiry = true;
                    }else{
                        this.displayCustomLinkExpiry = false;
                    }
                    return {
                        delay_unit: delayUnit,
                        delay_value: delayValue != 'never' ? delayValue : 'never'
                    };
                }else{
                    return {
                        delay_unit: '',
                        delay_value: 'never'
                    };
                }

            }
        },
        methods: {
            setWidgetType:function(){
                this.loading =true;
                axios.post('/admin/brandboost/set-widget-type',{
                    widgetID: this.$route.params.id,
                    widgetTypeID: this.campaign.widget_type,
                }).then(response => {
                    // console.log(response.data.status);
                    this.getWidgetDetails();
                    if(response.data.status =='success'){
                        this.displayMessage('success', 'Setting has beeb saved successfully.');
                    }
                    this.loading =false;
                });
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/widgets/onsite';
                }else{
                    if(step == 4){
                        path = '/admin#/widgets/onsite/stats/'+this.campaignId+'/'+step;
                    }else{
                        path = '/admin#/widgets/onsite/setup/'+this.campaignId+'/'+step;
                    }
                }

                window.location.href = path;
            },
            getWidgetDetails: function () {

                axios.get('/admin/brandboost/onsite-widget-setup/' + this.campaignId)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.oWidgets = response.data.oWidgets;
                        this.bActiveSubsription = response.data.bActiveSubsription;
                        this.campaign = response.data.widgetData;
                        this.oBrandboostList = response.data.oBrandboostList;
                        this.oStats = response.data.oStats;
                        this.setTab = response.data.setTab;
                        this.widgetID = response.data.widgetID;
                        this.widgetThemeData = response.data.widgetThemeData;
                        this.selectedTab = response.data.selectedTab;
                        this.loading = false;
                        //loadJQScript(this.user.id);

               });
            },
            applyDefaultInfo: function (e) {
                if (e.target.checked) {
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname + ' ' + this.user.lastname;
                    this.updateSettings('from_email');
                    this.updateSettings('from_name');
                } else {

                }
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
                axios.post('/admin/brandboost/updateOnsiteWidgetStatus', {
                    widgetID: this.campaignId,
                    status: '3',
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
    }
    function loadJQScript(userid){
        var tkn = $('meta[name="_token"]').attr('content');
        Dropzone.autoDiscover = false;
        var myDropzoneLogoImg = new Dropzone(
            '#myDropzone_logo_img', //id of drop zone element 1
            {
                url: '/dropzone/upload_s3_attachment/'+userid+'/onsite',
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {

                    if (response.xhr.responseText != "") {

                        $('#showLogoImage').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/' + response.xhr.responseText).show();
                        var dropImage = $('#logo_img').val();
                        $.ajax({
                            url: "/admin/brandboost/DeleteObjectFromS3",
                            type: "POST",
                            data: {dropImage: dropImage, _token: tkn},
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                            }
                        });
                        $('#logo_img').val(response.xhr.responseText);
                        $('#logo_img').click();

                    }

                }
            });
        myDropzoneLogoImg.on("complete", function (file) {
            myDropzoneLogoImg.removeFile(file);
        });
    }
</script>

<style scoped>
    .review_source_new .inner {
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
        background-color: #ffffff;
        /* border: solid 1px #e3e9f3; */
        min-height: 248px;
        position: relative;
        padding: 15px;
    }
    .review_source_new .custmo_checkbox.checkboxs {
        position: absolute;
        width: 17px;
        right: 5px!important;
        top: 11px;
        z-index: 9;
        display: inline-block;
    }
    .custmo_checkbox {
        display: block;
        position: relative;
        padding-left: 18px;
        margin-bottom: 0px;
        cursor: pointer;
        font-size: 13px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        line-height: 17px;
        height: 17px;

    }
    .custmo_checkmark{
        border-radius: 10px;
        border: 1px solid #FFF !important;
    }
    .col-md-2.review_source_new .inner {
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
        background-color: #ffffff;
        /* border: solid 1px #e3e9f3; */
        min-height: 200px;
        position: relative;
        padding: 15px;
    }
    .col-md-2.review_source_new .inner.active {
        border: 1px solid #9986e4!important;
    }
    .col-md-2.review_source_new .inner .text_sec p {
        margin-bottom: 5px;
    }
    .col-md-2.review_source_new .inner .text_sec h5 {
        font-size: 12px;
        font-weight: 300 !important;
        color: #5e729d;
        line-height: 1.33;
        margin: 0;
    }
</style>




