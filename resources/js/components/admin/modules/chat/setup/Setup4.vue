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
                        <button class="btn btn-md bkg_email_300 light_000" @click="changeCampaignStatus('active')" >Publish <span><img
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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Campaign info</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">4</span><span
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
                                 <pre class="prettyprint p0">&lt;script
        type='text/javascript'
        id='bbscriptloader' data-key='{{campaign.hashcode}} q  '
        data-widgets='chat'
        async=''
        src='http://brandboostx.com/assets/js/chat_widgets.js' &gt;
    &lt;/script&gt;
                                        </pre>
                                    <div style="display: none;" class="prettyprintDiv">&lt;script type='text/javascript' id='bbscriptloader' data-key='{{campaign.hashcode}}; ?>' data-widgets='chat' async='' src='http://brandboost.io/assets/js/chat_widgets.js' &gt; &lt;/script&gt;</div>
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
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(3)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="changeCampaignStatus('active')">Publish<span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>


            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>
<script>
    import ListScore from '@/components/admin/modules/nps/ListScore';
    export default {
        components: {ListScore},
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




