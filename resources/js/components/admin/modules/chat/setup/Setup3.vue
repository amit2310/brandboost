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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="changeCampaignStatus('draft')"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(4)"> Next <span style="opacity: 1"><img
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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Campaign info</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a></li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                    <contacts-list></contacts-list>
<!--                <onsite-reviews v-if="campaignId" :campaignId="campaignId"></onsite-reviews>-->

                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(2)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(4)">Save and continue <span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>


            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>
<script>
    import ContactsList from '@/components/admin/modules/chat/setup/ContactsList';
    export default {
        components: {ContactsList},
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
            this.getChatWidgetSetup();
            this.loading = false;
        },
        methods: {
            getChatWidgetSetup : function(){
                axios.get('/admin/modules/chat/setup/' + this.campaignId)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.oChat;
                        this.preview = response.data.setupPreview;
                        this.user = response.data.userData;
                        this.loading = false;

                    });
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/chat/';
                }else{
                    path = '/admin#/modules/chat/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },
            changeCampaignStatus: function(status){
                this.loading = true;
                axios.post('/admin/modules/chat/changeStatus', {
                    chatID: this.campaignId,
                    status: status,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            if(status == 'draft'){
                                this.successMsg = 'Campaign saved as a draft successfully';
                            }
                            if(status == 'active'){
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
        width: 24.5% !important;
    }
</style>




