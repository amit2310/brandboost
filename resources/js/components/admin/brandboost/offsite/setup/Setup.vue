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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"
                                v-if="this.campaign.bc_status !='archive'" @click="changeCampaignStatus(2)"> Save as draft
                        </button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(2)"> Next <span
                            style="opacity: 1"><img
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
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span
                                    class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review
                                    Sources</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span
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
                    <div class="col-md-12 filter_campaign_new">
                        <div
                            class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign"
                            id="accordion-control-right">
                            <div v-for="(cat, key) in cateList" class="panel panel-white" :id="`SPanel${key}`">
                                <div class="panel-heading active">
                                    <h6 class="panel-title">
                                        <a class="" data-toggle="collapse" data-parent="#accordion-control-right"
                                           :href="`#accordion-control-right-group${key}`">

                                            <i v-if="cat.cat_img" class=""><img :src="`/assets/images/${cat.cat_img}`"></i>
                                            <i v-else-if="cat.icon_class" :class="cat.icon_class"></i>
                                            <i v-else class="icon-power2"></i>
                                            {{cat.title == 'OtherSources' ? 'Other Sources' : cat.title}}
                                            &nbsp;
                                        </a>
                                    </h6>
                                </div>
                                <div :id="`accordion-control-right-group${key}`"
                                     :class="`panel-collapse collapse ${firstRow(key)}`">
                                    <div class="panel-body">
                                        <div class="row">
                                            <template v-for="reviewSource in offSiteData"
                                                      v-if="reviewSource.site_categories_array.indexOf(cat.title)>-1">
                                                <div
                                                    v-if="reviewSource.site_categories_array.indexOf('OtherSources')>-1"
                                                    data-toggle="modal"
                                                    id="rowDefault"
                                                    data-target="#OtherSourcesId"
                                                    class="col-xs-12 col-md-2 col-sm-2 rev_col">
                                                    <div class="thumbnail">
                                                        <div class="thumb bkg1">
                                                            <a href="javascript:void(0);"><i class="txt_blue"
                                                                                             style="font-style:inherit">M</i></a>
                                                        </div>
                                                        <div class="caption text-center">
                                                            <div class="pull-left">
                                                                <h5 class="no-margin sea">Custom Source</h5>
                                                                <h6 class="text-muted">Use Custom Domain</h6>
                                                            </div>
                                                            <div class="clearfix"></div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    v-else
                                                    @mouseover="displayHoverDelete(reviewSource.id)"
                                                    @mouseleave="hideHoverDelete(reviewSource.id)"
                                                    :class="`col-xs-12 col-md-2 col-sm-2 rev_col ${reviewSource.site_categories_array.indexOf('OtherSources')>-1 ? 'OtMouseover_'+reviewSource.id : ''} ${offsiteIds.indexOf(reviewSource.id)>-1 ? 'selected' : ''}`"
                                                    :offsetId="reviewSource.id"
                                                    :id="`review_steps${reviewSource.id}`"
                                                >
                                                    <a v-if="reviewSource.site_categories_array.indexOf('OtherSources')>-1"
                                                       :id="`tickImg_${reviewSource.id}`" style="display:none"
                                                       :CsourceId="reviewSource.id" href="javascript:void(0);"
                                                       class="deleteCustomSource"><i class="icon-cross2"></i></a>

                                                    <div class="thumbnail">

                                                        <div
                                                            :class="`thumb ${sourceProperties(reviewSource.name).thumbclass}`">
                                                            <a href="javascript:void(0);">
                                                                <i
                                                                    v-if="reviewSource.site_categories_array.indexOf('OtherSources')>-1"
                                                                    :class="`icon-${reviewSource.name.toLowerCase()+ ' ' +sourceProperties(reviewSource.name).sourceClass}`"
                                                                    style="font-style:inherit"
                                                                >M</i>
                                                                <img :src="`/uploads/${reviewSource.image}`">
                                                            </a>
                                                        </div>


                                                        <div class="caption text-center">
                                                            <div class="pull-left">
                                                                <h5 class="no-margin sea">{{reviewSource.name}}</h5>
                                                                <h6 class="text-muted">
                                                                    {{reviewSource.website_url}}
                                                                </h6>
                                                            </div>

                                                            <label class="custom-form-switch pull-right mt10">
                                                                <input
                                                                    class="field offsite_selected"
                                                                    type="checkbox"
                                                                    :checked="offsiteIds.indexOf(reviewSource.id)>-1"
                                                                    @change="updateSelectedSource(reviewSource.id, $event)"
                                                                >
                                                                <span class="toggle green"></span>
                                                            </label>

                                                            <div class="clearfix"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </template>


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
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true"
                                @click="displayStep(0)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(2)">Save and
                            continue <span><img
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
                displayCustomLinkExpiry: false,
                offSiteData: '',
                offsiteIds: '',
                cateList: {
                    'accordion-control-group1': {
                        icon: 'icon-stack2',
                        title: 'Most Popular',
                        cat_img: 'star_purple.png'
                    },
                    'accordion-control-group2': {
                        icon: 'icon-copy',
                        title: 'Automotive',
                        cat_img: 'automative.png'
                    },
                    'accordion-control-group3': {
                        icon: 'icon-droplet2',
                        title: 'Dental',
                        cat_img: 'dental.png'
                    },
                    'accordion-control-group4': {
                        icon: 'icon-cart2',
                        title: 'E-commerce',
                        cat_img: 'ecom.png'
                    },
                    'accordion-control-group5': {
                        icon: 'icon-select2',
                        title: 'Financial services',
                        cat_img: 'finse.png'
                    },
                    'accordion-control-group6': {
                        icon: 'icon-user-plus',
                        title: 'Healthcare',
                        cat_img: '',
                        icon_class: 'icon-user-plus'
                    },
                    'accordion-control-group7': {
                        icon: 'icon-home7',
                        title: 'Home services',
                        cat_img: '',
                        icon_class: 'icon-home2'
                    },
                    'accordion-control-group8': {
                        icon: 'icon-office',
                        title: 'Hotels',
                        cat_img: '',
                        icon_class: 'icon-office'
                    },
                    'accordion-control-group9': {
                        icon: 'icon-design',
                        title: 'Insurance',
                        cat_img: '',
                        icon_class: 'icon-power2'
                    },
                    'accordion-control-group10': {
                        icon: 'icon-stamp',
                        title: 'Legal',
                        cat_img: '',
                        icon_class: 'icon-user-tie'
                    },
                    'accordion-control-group11': {
                        icon: 'icon-stack',
                        title: 'Personal Services',
                        cat_img: '',
                        icon_class: 'icon-hammer-wrenc'
                    },
                    'accordion-control-group12': {
                        icon: 'icon-city',
                        title: 'Real Estate',
                        cat_img: '',
                        icon_class: ''
                    },
                    'accordion-control-group13': {
                        icon: 'icon-home4',
                        title: 'Restaurants',
                        cat_img: '',
                        icon_class: ''
                    },
                    'accordion-control-group14': {
                        icon: 'icon-database-edit2',
                        title: 'Software',
                        cat_img: '',
                        icon_class: ''
                    },
                    'accordion-control-group15': {
                        icon: 'icon-database-edit2',
                        title: 'OtherSources',
                        cat_img: '',
                        icon_class: ''
                    }
                }
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
                    this.user = response.data.aUserInfo;
                    this.loading = false;


                });


        },
        computed: {},
        methods: {
            updateSelectedSource: function (sourceId, elem) {
                this.loading = true;
                var ids = this.offsiteIds.split(",");
                if (elem.target.checked == true) {
                    ids.push(sourceId);
                } else {
                    let index = ids.indexOf(sourceId.toString());
                    if (index > -1) {
                        ids.splice(index, 1);
                    }
                }
                this.offsiteIds = ids.join(",");
                axios.post('/admin/brandboost/add_offsite_edit', {
                    offstepIds: ids,
                    brandboostID: this.campaignId,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                    });
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
            displayHoverDelete: function (sourceId) {
                //document.querySelector("tickImg_" + sourceId).style.display = 'block';
            },
            hideHoverDelete: function (sourceId) {
                //document.querySelector("tickImg_" + sourceId).style.display = 'none';
            },
            firstRow: function (key) {
                return (key == 'accordion-control-group1') ? 'in firstRow show' : '';
            },
            displayStep: function (step) {
                let path = '';
                if (!step) {
                    path = '/admin#/reviews/offsite';
                } else {
                    path = '/admin#/reviews/offsite/setup/' + this.campaignId + '/' + step;
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
            updateSettings: function (fieldName, fieldValue, type) {
                this.loading = true;

                if (type == 'expiry') {
                    this.displayCustomLinkExpiry = fieldValue == 'custom' || fieldName == 'txtInteger' || fieldName == 'exp_duration' ? true : false;
                }
                axios.post('/admin/brandboost/saveOnsiteSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    brandboostId: this.campaignId,
                    linkExpiryData: this.campaign.link_expire_custom,
                    requestType: type

                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.loading = false;
                });

            },
            changeCampaignStatus: function(status){
                this.loading = true;
                axios.post('/admin/brandboost/publishOnsiteStatusBB', {
                    brandboostID: this.campaignId,
                    status: status,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            if(status == 2){
                                this.successMsg = 'Campaign saved as a draft successfully';
                            }
                            if(status == 1){
                                this.successMsg = 'Campaign is active now';
                            }

                        }else{
                            this.errorMsg = 'Something went wrong';
                        }
                    });
            }
        }

    };


</script>
<style scoped>
    .email_config_list li {
        width: 19.5% !important;
    }

    .bkg_green {
        background: #4ebc86 !important;
        background-color: #4ebc86 !important;
    }

    .alert.preview {
        padding: 20px 25px !important;
        border-radius: 5px;
    }

    .txt_white {
        color: #ffffff !important;
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
        background: #202040 !important;
        background-color: #202040 !important;
    }

    .bkg_red {
        background: #eb4f76 !important;
        background-color: #eb4f76 !important;
    }

    .filter_campaign .thumbnail {
        margin-bottom: 0px;
        border: 1px solid #e5ebe5 !important;
        border-radius: 6px;
        transition: transform .15s ease;
        padding: 0px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .02), 0 6px 18px 0 rgba(0, 0, 0, .055);
    }

    .filter_campaign .thumbnail:hover {
        transform: scale(1.02) translateY(-3px);
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .02), 0 6px 18px 0 rgba(0, 0, 0, .055);
    }

    .filter_campaign .thumbnail .caption {
        padding-top: 15px !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
        position: relative;
    }

    .filter_campaign .thumbnail:hover {
        background: #fff !important;
        cursor: pointer;
    }

    .filter_campaign .thumbnail h5 {
        font-size: 13px;
        text-align: left !important;
        margin-bottom: 0px !important;
        letter-spacing: 0.3px;
        font-weight: 400;
        color: #1d2129
    }

    .filter_campaign .thumbnail h6 {
        margin: 0 0 4px !important;
        font-weight: 400;
        font-size: 12px;
        text-align: left;
        color: #1d2129 !important;
    }

    .filter_campaign .btn.btn-xs.bl_cust_btn {
        padding: 5px 10px !important;
        position: absolute;
        top: 20px;
        right: 15px;
        z-index: 9;
    }

    .filter_campaign .rev_col {
        width: 220px !important;
        max-width: 220px !important;
        margin: 0 0px 20px 0;
    }

    .filter_campaign .thumbnail .thumb {
        padding: 33px 0;
        background: #f1f6ff;
        border-radius: 6px 6px 0 0 !important;
        height: 124px;
        text-align: center;
    }

    .filter_campaign .bkg1 {
        background: #ffeceb !important
    }

    .filter_campaign .bkg2 {
        background: #d8f0e5 !important
    }

    .filter_campaign .bkg3 {
        background: #e7f0ff !important
    }

    .filter_campaign .bkg4 {
        background: #e6e6e6 !important
    }

    .filter_campaign .bkg5 {
        background: #dce9f6 !important
    }

    .filter_campaign .bkg6 {
        background: #daeff8 !important
    }

    .filter_campaign .bkg7 {
        background: #f7e7e9 !important;
    }

    .filter_campaign .rev_col .thumb:not(.thumb-rounded) a {
        height: 62px;
        width: 62px;
        box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .1);
        padding: 1px;
        background: #fff;
        border-radius: 100px !important;
        display: inline-block;
        line-height: 58px;
        font-size: 30px;
    }

    .filter_campaign .rev_col .thumb:not(.thumb-rounded) a i {
        font-size: 30px;
    }


    .filter_campaign_new .thumbnail {
        border: none !important;
        width: 100%;
        border-radius: 6px;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06) !important;
        background: #fff;
        padding: 0 19px !important;
        margin: 7px 0 !important
    }

    .filter_campaign_new .thumbnail:hover {
        transform: scale(1.02) translateY(-3px);
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .02), 0 6px 18px 0 rgba(0, 0, 0, .055);
    }

    .filter_campaign_new .thumbnail .caption {
        position: relative;
        padding: 15px 0 !important;
        border: none !important
    }

    .filter_campaign_new .thumbnail:hover {
        background: #fff !important;
        cursor: pointer;
    }

    .filter_campaign_new .thumbnail h5 {
        font-size: 13px;
        text-align: left !important;
        margin-bottom: 0px !important;
        letter-spacing: 0.3px;
        font-weight: 400;
        color: #09204f
    }

    .filter_campaign_new .thumbnail h6 {
        margin: 0 0 4px !important;
        font-weight: 400;
        font-size: 12px;
        text-align: left;
        color: #7a8dae !important;
    }

    .filter_campaign_new .btn.btn-xs.bl_cust_btn {
        padding: 5px 10px !important;
        position: absolute;
        top: 20px;
        right: 15px;
        z-index: 9;
    }

    .filter_campaign_new .rev_col {
        /*width: 175px !important;
        max-width: 175px !important;*/
        margin: 0px 14px 0 0;
        padding: 0px !important; width: calc(16.66% - 15px);
    }

    .filter_campaign_new .thumbnail .thumb {
        padding: 29px 0;
        background: #ffffff;
        border-radius: 6px 6px 0 0 !important;
        height: 110px;
        text-align: center;
        border-bottom: 1px solid #f4f6fa;
    }

    .filter_campaign_new .bkg1 {
        background: #ffffff !important
    }

    .filter_campaign_new .bkg2 {
        background: #ffffff !important
    }

    .filter_campaign_new .bkg3 {
        background: #ffffff !important
    }

    .filter_campaign_new .bkg4 {
        background: #ffffff !important
    }

    .filter_campaign_new .bkg5 {
        background: #ffffff !important
    }

    .filter_campaign_new .bkg6 {
        background: #ffffff !important
    }

    .filter_campaign_new .bkg7 {
        background: #ffffff !important;
    }

    .filter_campaign_new .rev_col .thumb:not(.thumb-rounded) a {
        height: 45px;
        width: 45px;
        padding: 0px;
        background: #fff;
        display: inline-block;
        line-height: 45px;
        font-size: 30px;
    }

    .filter_campaign_new .rev_col .thumb:not(.thumb-rounded) a i {
        font-size: 30px;
    }

    .filter_campaign_new .rev_col .thumb:not(.thumb-rounded) a img {
        height: 45px !important;
        width: 45px !important;
        border-radius: 6px;
    }

    .filter_campaign_new .custom-form-switch {
        margin: 12px 0 0 0 !important;
    }

    .review_source_search .form-control, .review_source_search .input-group-addon {
        border: none !important;
        box-shadow: none !important;
        background: #fff !important
    }


    .filter_campaign.competitor .thumbnail {
        border: none !important;
        height: 171px;
        border-radius: 5px !important;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06) !important;
        margin-bottom: 13px;
    }

    .filter_campaign.competitor .thumbnail .thumb {
        padding: 15px 0 23px !important;
        height: auto !important;
        background: #fff !important;
        border-bottom: 1px solid #f4f6fa
    }

    .filter_campaign.competitor .thumbnail img {
        width: 45px !important;
        height: 45px;
    }

    .filter_campaign.competitor .thumbnail .caption {
        padding: 3px 20px 0px !important;
        border: none !important;
    }

    .filter_campaign.competitor .thumbnail h6 {
        color: #7a8dae !important
    }

    .filter_campaign.integrations .rev_col {
        width: 270px !important;
        max-width: 270px !important;
        margin: 0 0px 25px 0;
    }

    .filter_campaign.integrations .thumbnail .caption {
        padding: 20px !important
    }

    .filter_campaign.integrations .white_box {
        background: #fff;
        padding: 15px;
        height: 59px;
        border-radius: 3px;
        box-shadow: 0 3px 2px 0 rgba(0, 34, 124, 0.02), 0 1px 1px 0 rgba(0, 19, 151, 0.07);
        margin-bottom: 30px;
        line-height: 30px;
    }

    .filter_campaign.integrations .white_box a {
        text-decoration: underline;
    }

    .custom-form-switch {
        display: inline-block;
        margin-bottom: 8px;
        position: relative;
        align-items: center;
        width: 30px;
        height: 17px;
    }

    .custom-form-switch > .field {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        margin: 0;
    }

    .custom-form-switch > .toggle {
        display: inline-block;
        background-color: #c5d0e5;
        width: 26px;
        height: 13px;
        vertical-align: middle;
        border-radius: 5px;
        border: 2px solid #c5d0e5;
        margin-right: 8px;
        transition: all 0.6s;
        box-sizing: content-box;
    }

    .custom-form-switch > .toggle:before {
        content: '';
        display: block;
        width: 13px;
        height: 13px;
        background-color: white;
        border-radius: 4px;
        transition: margin 0.3s;
        margin-top: -9px;
        margin-left: -2px;
    }

    .custom-form-switch .field:checked + .toggle:before {
        margin-left: 6px;
    }

    .custom-form-switch .field:checked + .toggle {
        border-color: #7f62df;
        background-color: #7f62df;
    }

    .custom-form-switch .field:checked + .toggle.blue {
        border-color: #3680dc;
        background-color: #3680dc;
    }

    .custom-form-switch .field:checked + .toggle.blue2 {
        border-color: #2eb4dd;
        background-color: #2eb4dd;
    }

    .custom-form-switch .field:checked + .toggle.sblue {
        border-color: #2f9eee;
        background-color: #2f9eee;
    }

    .custom-form-switch .field:checked + .toggle.green {
        border-color: #59b06e;
        background-color: #59b06e;
    }

    .custom-form-switch .field:checked + .toggle.green2 {
        border-color: #34a285;
        background-color: #34a285;
    }

    .custom-form-switch .field:checked + .toggle.greend {
        border-color: #36b4a4;
        background-color: #36b4a4;
    }

    .custom-form-switch .field:checked + .toggle.teal {
        border-color: #238398;
        background-color: #238398;
    }

    .custom-form-switch .field:checked + .toggle.dred {
        border-color: #962e6c;
        background-color: #962e6c;
    }

    .custom-form-switch .field:checked + .toggle.grey {
        border-color: #c5d0e5;
        background-color: #c5d0e5;
    }

    .custom-form-switch .field:checked + .toggle.purple {
        border-color: #9559ec;
        background-color: #9559ec;
    }

    .custom-form-switch .field:checked + .toggle.yellow {
        border-color: #ed8e8c;
        background-color: #ed8e8c;
    }

    .custom-form-switch .field:checked + .toggle.greenl {
        border-color: #9ecc78;
        background-color: #9ecc78;
    }

    othersources .rev_col {
        width: 220px !important;
        max-width: 220px !important;
        margin: 0 0px 20px 0;
    }

    .othersources .thumbnail {
        margin-bottom: 0px;
        border: 1px solid #e5ebe5 !important;
        border-radius: 6px;
        transition: transform .15s ease;
        padding: 0px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .02), 0 6px 18px 0 rgba(0, 0, 0, .055);
    }

    .othersources .thumbnail .thumb {
        padding: 33px 0;
        background: #f1f6ff;
        border-radius: 6px 6px 0 0 !important;
        height: 124px;
        text-align: center;
    }

    .othersources .thumbnail .caption {
        padding-top: 15px !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
        position: relative;
    }

    .pull-left {
        float: left !important;
    }

    label {
        font-weight: 400 !important;
        font-size: 12px;
        color: #5e729d !important;
    }

</style>




