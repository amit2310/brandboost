<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.widget_title}} </h3>
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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration
                                </a></li>
                                <!--                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span-->
                                <!--                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a></li>-->
                                <!--                                <li><a class="" href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span-->
                                <!--                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>-->
                                <!--                                </li>-->
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading p15">
                                <h6 class="panel-title">How to add widget</h6>
                            </div>
                            <div class="panel-body p15">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item br0"  src="https://www.youtube.com/embed/2H_Jsgh2Z3Y?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div style="margin: 0;" class="panel panel-flat ">
                            <div class="panel-heading p15">
                                <h6 class="panel-title">You’re All Set!</h6>
                            </div>
                            <div class="panel-body min_h270 p20">
                                <p><span class="txt_dark">Descriptions List</span><br><small class="text-muted text-size-small">So strongly and metaphysically did I conceive of my situati.</small></p>
                                <p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In the tumultuous business of cutting-in and attending to a whale, there.</small></p>
                                <p><span class="txt_dark">Descriptions List</span><br><small class="text-muted text-size-small">So strongly and metaphysically did I conceive of my situati.</small></p>
                                <p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In the tumultuous business of cutting-in and attending to a whale, there.</small></p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading p15">
                                <h6 class="panel-title">Embedded Code</h6>
                            </div>
                            <div class="panel-body min_h270 p15">
                                <div class="bbot">
                                 <pre class="prettyprint p0">
     &lt;script
        type='text/javascript'
        id='bbscriptloader' data-key='{{campaign.hashcode}}'
        data-widgets='chat'
        async=''
        src='http://brandboost.io/assets/js/ref_widgets.js' &gt;
    &lt;/script&gt;
                                        </pre>
                                    <div style="display: none;" class="prettyprintDiv">&lt;script type='text/javascript' id='bbscriptloader' data-key='{{campaign.hashcode}}; ?>' data-widgets='chat' async='' src='http://brandboostx.com/assets/js/nps_widgets.js' &gt; &lt;/script&gt;</div>
                                </div>
                                <div class="p20 text-right">
                                    <button class="btn btn-xs btn_white_table pl10 pr10" id="btnCopyWidget" onclick="copyToClipboard('.prettyprintDiv')">Copy Code</button>
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
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(1)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
<!--                    <div class="col-6">-->
<!--                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="changeCampaignStatus('1')">Publish<span><img-->
<!--                            src="/assets/images/arrow-right-line.svg"></span></button>-->
<!--                    </div>-->
                </div>


            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>
<script>
    import AdvocateRewards from "./partials/AdvocateRewards";
    import FriendRewards from "./partials/FriendRewards";
    export default {
        components: {AdvocateRewards, FriendRewards},
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: false,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                settings: '',
                advocateCouponsCollection: '',
                advocateGiftType:'',
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false,
                activeTab: 'advocate'
            }
        },
        created() {
            axios.get('/admin/modules/referral/widget/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.campaign;
                    this.preview = response.data.preview;
                    this.referralApps = response.data.referralApps;
                    this.loading = false;
                });
        },
        methods: {
            displayStep: function (step) {
                let path = '';
                if(!step){
                    path = '/admin#/modules/referral/widget/';
                }else{
                    path = '/admin#/modules/referral/widget/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },

        }

    };

</script>
<style scoped>
    .email_config_list li {
        width: 19.5% !important;
    }
    .tab-content {
        width: 100%;
        padding: 50px 0 !important;
    }
    .nav-tabs > li {
        float: left;
        margin-bottom: -1px;
        width: 50%;
        padding: 1rem !important
    }
    .nav-tabs {
        border-bottom: 1px solid #ddd;
        width: 100%;
    }
    .nav-tabs > li.active {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
</style>



