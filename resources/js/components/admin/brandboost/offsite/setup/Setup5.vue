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
                        <button class="btn btn-md bkg_email_300 light_000" @click="changeCampaignStatus(1)" >Publish <span><img
                            src="/assets/images/arrow-right-line.svg"></span>  </button>
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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span
                                    class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review
                                    Sources</a></li>
                                <li><a class="" href="javascript:void(0);"><span
                                    class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Preferences</a>
                                </li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(3)"><span
                                    class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a>
                                </li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span
                                    class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span
                                    class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Require
                                    Attention</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <list-feedback v-if="campaignId" :campaignId="campaignId"></list-feedback>

                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(3)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="changeCampaignStatus(1)">Publish<span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>


            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>
<script>
    import ListFeedback from '@/components/admin/brandboost/offsite/ListFeedback';
    export default {
        components: {ListFeedback},
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
                current_page: '1',
                reviews: ''

            }
        },
        mounted() {

            axios.get('/admin/brandboost/offsite_setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.brandboostData;
                    this.loading = false;
                    //loadJQScript(this.user.id);

                });
        },
        methods: {
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/reviews/offsite';
                }else{
                    path = '/admin#/reviews/offsite/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
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
    .email_config_list li{
        width: 19.5% !important;
    }
</style>




