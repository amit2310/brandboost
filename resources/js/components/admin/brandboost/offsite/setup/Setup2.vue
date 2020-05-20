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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="changeCampaignStatus(2)"> Save as draft</button>
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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span
                                    class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review
                                    Sources</a></li>
                                <li><a class="active" href="javascript:void(0);"><span
                                    class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Preferences</a>
                                </li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(3)"><span
                                    class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span
                                    class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(5)"><span class="num_circle"><span
                                    class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Require
                                    Attention</a>
                                </li>
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_bb_title" class="fsize12 fw300">Brand Boost Name</label>
                                        <input type="text" class="form-control emoji h50" placeholder="New Product on Site Boost"
                                               name="title" v-model="campaign.brand_title"
                                               @change="updateSettings('brand_title', $event.target.value, 'brandboost')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_bb_title" class="fsize12 fw300">Domain</label>
                                        <input type="text" class="form-control emoji h50" placeholder="www.google.com"
                                               name="domain_name" v-model="campaign.domain_name"
                                               @change="updateSettings('domain_name', $event.target.value, 'brandboost')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="logo_img" class="fsize12 fw300">Add/Change Brand Logo</label>

                                        <input type="hidden" id="logo_img" name="logo_img" @click="updateSettings('logo_img', $event.target.value, 'brandboost')">
                                        <div class="img_vid_upload_small">
                                            <div class="dropzone" id="myDropzone_logo_img"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="logo_img" class="fsize12 fw300">Brand Logo</label>
                                        <div class="clearfix"></div>
                                        <img width="64" height="65" class="rounded" id="showLogoImage" onerror="this.src='assets/images/default-logo.png'" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/${campaign.logo_img}`">
                                    </div>
                                </div>



                            </div>

                        </div>

                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Sources Configuration</h3>
                                    <p class="fsize12 fw300 dark_300 mb20">Setup offsite review sources information</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="card p20">
                                        <div class="row">
                                <template v-for="reviewSource in offSiteData">
                                    <div class="col-md-6 mb-4" v-if="offsiteIds.indexOf(reviewSource.id)>-1" >
                                        <div class="border p0 br4">
                                            <div class="row">
                                                <div class="col-md-3 pr0 text-center">
                                                    <div class="p15">
                                                        <i
                                                            v-if="reviewSource.site_categories_array.indexOf('OtherSources')>-1"
                                                            :class="`icon-${reviewSource.name.toLowerCase()+ ' ' +sourceProperties(reviewSource.name).sourceClass}`"
                                                            style="font-style:inherit">M</i>

                                                        <img v-else class="mt-1" :src="`/uploads/${reviewSource.image}`" height="50" width="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-9 blef">
                                                    <div class="p15 pl5">
                                                        <p class="fsize15 fw500 dark_600 mb-0">{{ reviewSource.name }}</p>
                                                        <p class="fsize14 fw400 dark_200 mb-1">{{reviewSource.website_url}}</p>
                                                        <div class="form-group offsiteUriGroup">
                                                            <template v-if="reviewSource.site_categories_array.indexOf('OtherSources')>-1">
                                                                <input
                                                                    style="text-align:left;"
                                                                    :class="`form-control fsize13 h36 siteURLId_${reviewSource.id}`"
                                                                    autocomplete="off"
                                                                    :linkid="reviewSource.id"
                                                                    :id="`linkUrl${reviewSource.id}`"
                                                                    name="offsite_url[]"
                                                                    :value="reviewSource.website_url"
                                                                    placeholder="Enter Web Address"
                                                                    type="text"
                                                                    required="required">
                                                            </template>
                                                            <template v-else>
                                                                <span class="fixedURL">{{reviewSource.website_url}}</span>
                                                                <input
                                                                    :class="`form-control fsize13 h36 offsiteUri siteURLId_${reviewSource.id}`"
                                                                    autocomplete="off"
                                                                    :linkid="reviewSource.id"
                                                                    :id="`linkUrl${reviewSource.id}`"
                                                                    name="offsite_url[]"
                                                                    :value="offsites_links[reviewSource.id].link ? offsites_links[reviewSource.id].link : reviewSource.website_url"
                                                                    placeholder="Enter Web Address"
                                                                    type="text"
                                                                    required="required"
                                                                    @change="updateSettings('from_name', $event.target.value, 'feedback')"
                                                                >
                                                            </template>

                                                        </div>
                                                        <button class="btn btn-sm-32 bkg_blue_200 light_000 pr20 fsize13 fw400" @click="previewResource(reviewSource.website_url, reviewSource.id)">Preview</button>
                                                        <button class="btn btn-sm-32 bkg_red_200 light_000 pr20 fsize13 fw400">Delete</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </template>
                                        </div>
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
                                               @change="updateSettings('from_name', $event.target.value, 'feedback')" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_from_email" class="fsize12 fw300">Review Request "Form" Email</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_from_email"
                                               placeholder="alen@brandboost.io" name="from_email"
                                               v-model="feedbackResponse.from_email" @change="updateSettings('from_email', $event.target.value, 'feedback')" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frm_sender_phone" class="fsize12 fw300">Review Request SMS "Form" Number</label>
                                        <input type="text" name="sender_phone" class="form-control form-control-dark h50" id="frm_sender_phone" readonly="readonly"
                                               v-model="fromNumber ? fromNumber : user.mobile"  required>
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
                                            <input name="link_expire_review" value="yes" type="radio" :checked="campaign.link_expire_review == 'yes'" @change="updateSettings('link_expire_review', $event.target.value, 'brandboost')">
                                            <span class="custmo_radiomark"></span>
                                            Yes
                                        </label>
                                        <div class="clearfix"></div>
                                        <label class="custmo_radiobox pull-left mb10">

                                            <input name="link_expire_review" value="no" :checked="campaign.link_expire_review == 'no'" type="radio" @change="updateSettings('link_expire_review', $event.target.value, 'brandboost')">
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
                                            <input name="link_expire_custom" value="never" :checked="checkLinkExpiry.delay_value == 'never'" type="radio" @change="updateSettings('link_expire_custom', $event.target.value, 'expiry')">
                                            <span class="custmo_radiomark"></span>
                                            Never Expire
                                        </label>
                                        <div class="clearfix"></div>
                                        <label class="custmo_radiobox pull-left mb10">

                                            <input name="link_expire_custom" value="custom" type="radio" :checked="checkLinkExpiry.delay_value != 'never'" @change="updateSettings('link_expire_custom', $event.target.value, 'expiry')">
                                            <span class="custmo_radiomark"></span>
                                            Expire After
                                        </label>
                                        <div class="expireLinkBox" v-show="displayCustomLinkExpiry">
                                            <div class="form-group">
                                                <input type="number" name="txtInteger"  v-model="checkLinkExpiry.delay_value" size="3" class="numaric_only form-control daysnumber2" @change="updateSettings('txtInteger', $event.target.value, 'expiry')">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" v-model="checkLinkExpiry.delay_unit" name="exp_duration" @change="updateSettings('exp_duration', $event.target.value, 'expiry')">
                                                    <option value="day">Day</option>
                                                    <option value="week">Week</option>
                                                    <option value="month">Month</option>
                                                    <option value="year">Year</option>
                                                </select>
                                            </div>
                                        </div>
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
                                               @change="updateSettings('pos_title', $event.target.value, 'feedback')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_positive_subtitle" class="fsize12 fw300">Positive Sub Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_positive_subtitle"
                                               name="positive_subtitle"
                                               v-model="feedbackResponse.pos_sub_title"
                                               @change="updateSettings('pos_sub_title', $event.target.value,'feedback')" required>
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
                                               @change="updateSettings('neu_title', $event.target.value, 'feedback')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_neutral_subtitle" class="fsize12 fw300">Neutral Sub Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_neutral_subtitle"
                                               name="neutral_subtitle"
                                               v-model="feedbackResponse.neu_sub_title"
                                               @change="updateSettings('neu_sub_title', $event.target.value, 'feedback')" required>
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
                                               @change="updateSettings('neg_title', $event.target.value,'feedback')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="frm_negetive_subtitle" class="fsize12 fw300">Negative Sub Title</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frm_negetive_subtitle"
                                               name="negetive_subtitle"
                                               v-model="feedbackResponse.neg_sub_title"
                                               @change="updateSettings('neg_sub_title', $event.target.value,'feedback')" required>
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
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(3)">Save and continue <span><img
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



                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},

                user: {},
                breadcrumb: '',
                feedbackResponse: {
                    from_name: '',
                    from_email: ''
                },
                offSiteData: '',
                offsiteIds: '',
                offsites_links:'',
                fromNumber: '',
                displayCustomLinkExpiry: false
            }
        },
        mounted() {
            axios.get('/admin/brandboost/offsite_setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.brandboostData;
                    this.offSiteData = response.data.offSiteData;
                    this.offsiteIds = response.data.offsiteIds;
                    this.offsites_links = response.data.offsites_links;
                    this.feedbackResponse = response.data.feedbackResponse !=null ? response.data.feedbackResponse : this.feedbackResponse;
                    this.user = response.data.aUserInfo;
                    this.showLoading(false);
                    //loadJQScript(this.user.id);

                });
            loadJQScript(35);

        },
        computed: {
            checkLinkExpiry: function(){
                let linkExpiry = this.campaign.link_expire_custom;
                let delayValue = 'never';
                let delayUnit = '';
                if(linkExpiry){
                    if(linkExpiry != 'never'){
                        let aExpiryData = JSON.parse(linkExpiry);
                        let delayValue = aExpiryData.delay_value;
                        let delayUnit = aExpiryData.delay_unit;
                    }

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
            previewResource: function(url, id){
                let uri = document.querySelector('#linkUrl'+id).value;
                window.open(url + uri, '_blank');
            },
            sourceProperties: function (sName) {
                let sourceClass = '';
                let thumbclass = '';
                let sourceImg = '';
                let sourceName = sName.toLowerCase();
                if (sourceName == 'yelp') {
                    sourceClass = 'txt_red';
                    thumbclass = 'bkg2';
                    sourceImg = 'yelp_logo.png';
                } else if (sourceName == 'google') {
                    sourceClass = 'txt_blue';
                    thumbclass = 'bkg1';
                    sourceImg = 'google_add_co.png';
                } else if (sourceName == 'yahoo') {
                    sourceClass = 'txt_purple';
                    thumbclass = 'bkg5';
                    sourceImg = 'yahoo_logo.png';
                } else if (sourceName == 'facebook') {
                    sourceClass = 'txt_dblue';
                    thumbclass = 'bkg3';
                    sourceImg = 'facebook_icon.png';
                } else {
                    sourceClass = 'txt_blue';
                    thumbclass = 'bkg1';
                    sourceImg = 'lawyers_logo.png';
                }
                return {
                    sourceClass: sourceClass,
                    thumbclass: thumbclass,
                    sourceImg: sourceImg
                }
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/reviews/offsite';
                }else{
                    path = '/admin#/reviews/offsite/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
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
                this.showLoading(true);

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

                    this.displayMessage('success', 'Updated the changes successfully!!');
                    this.showLoading(false);
                });

            },
            changeCampaignStatus: function(status){
                this.showLoading(true);
                axios.post('/admin/brandboost/publishOnsiteStatusBB', {
                    brandboostID: this.campaignId,
                    status: status,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.showLoading(false);
                        if(response.data.status == 'success'){
                            if(status == 2){
                                this.displayMessage('success', 'Campaign saved as a draft successfully');
                            }
                            if(status == 1){
                                this.displayMessage('success', 'Campaign is active now');
                            }

                        }else{
                            this.displayMessage('error', 'Something went wrong');
                        }
                    });
            }
        }

    };

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
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:32px !important; opacity:0;height:32px; }
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .img_vid_upload_small{width: 100%; min-height: 50px; border-radius: 5px; background:url('/assets/images/upload_bkg2.png') 25px 8px no-repeat #fff; border: 1px solid #dfe5f0;box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.04);}
    .fixedURL {
        padding-right: 0px;
        height: 36px;
        border: 1px solid #E1E9F6;
        display: block;
        float: left;
        position: relative;
        padding-top: 7px;
        padding-left: 8px;
        border-right: none;
    }
    .offsiteUri {
        width: 65%;
        display: block;
        position: relative;
        float: left;
        padding-left: 2px;
        border-left: none;
    }
    .offsiteUriGroup{
        width: 100%;
        display: block;
        position: relative;
        float: left;
    }
</style>



