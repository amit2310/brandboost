<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.title}} </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"
                                v-if="this.campaign.status !='archive'" @click="saveDraft"> Save as draft
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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span
                                    class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Sources</a></li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span
                                    class="num">2</span><span
                                    class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Rewards</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span
                                    class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span
                                    class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(5)"><span class="num_circle"><span
                                    class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li :class="{'active' : activeTab == 'advocate'}"><a data-toggle="tab" href="#advocateTabSetup" @click="activeTab='advocate'" style="display:block;width:100%;"><strong>Advocates
                            Reward</strong></a></li>
                        <li :class="{'active' : activeTab == 'referred'}"><a data-toggle="tab" href="#friendTabSetup" @click="activeTab='referred'" style="display:block;width:100%;"><strong>Friends Reward</strong></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="advocateTabSetup" class="select_section tab-pane fade in active show mt-10 mb-10">
                            <advocate-rewards></advocate-rewards>
                        </div>
                        <div id="friendTabSetup" class="tab-pane fade">
                            <friend-rewards></friend-rewards>
                        </div>
                    </div>
                </div>
                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(1)"><span
                            class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(3)">Save and
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
    import AdvocateRewards from "./partials/AdvocateRewards";
    import FriendRewards from "./partials/FriendRewards";
    export default {
        components: {AdvocateRewards, FriendRewards},
        data() {
            return {
                refreshMessage: 1,


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
        methods: {
            displayStep: function (step) {
                let path = '';
                if (!step) {
                    path = '/admin#/referral/';
                } else {
                    path = '/admin#/referral/setup/' + this.campaignId + '/' + step;
                }

                window.location.href = path;
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

                    this.displayMessage('success', 'Test email sent successfully!');
                    this.loading = false;
                });

            },
            saveDraft: function () {
                this.loading = true;
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if (response.data.status == 'success') {
                            this.displayMessage('success', 'Campaign saved as a draft successfully');
                        } else {
                            this.displayMessage('error', 'Something went wrong');
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



