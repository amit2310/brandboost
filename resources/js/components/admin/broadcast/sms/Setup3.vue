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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="saveDraft"> Save as draft </button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(4)"> Next <span style="opacity: 1"><img src="/assets/images/arrow-right-line-white.svg"/></span></button>
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
                                <li><a class="done" href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span class="num">1</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Basic campaign info</a></li>
                                <li><a class="done" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Content & Design</a></li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">3</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review & confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <choose-workflow-subscribers
                    v-if="moduleName == 'broadcast'"
                    :moduleName="moduleName"
                    :moduleUnitId="moduleUnitID"
                    @displayTreeInterface="displayStep(2)"
                ></choose-workflow-subscribers>

                <div class="row mt20">
                    <!--<div class="col-md-12"><hr class="mb25"></div>-->
                    <div class="col-6"><!--<button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(2)"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button>--></div>
                    <div class="col-6"><button class="btn btn-sm bkg_email_300 light_000 float-right" style="margin-top:-50px;" @click="displayStep(4)">Save and continue <span><img src="/assets/images/arrow-right-line.svg"></span></button></div>
                </div>


            </div>
        </div>
        <!--Content Area End-->

    </div>
</template>
<script>
    import chooseWorkflowSubscribers from '@/components/admin/workflow/ChooseWorkflowSubscribers.vue';
    export default {
        components: {chooseWorkflowSubscribers},
        data() {
            return {


                loading: true,
                current_page: 1,
                moduleName: '',
                moduleUnitID: this.$route.params.id,
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                importButtons: '',
                exportButtons: '',
                subscribers: '',
                allData: '',
                activeCount: '',
                archiveCount: '',
                breadcrumb: '',

            }
        },
        mounted() {
            this.loadPaginatedData();

        },
        methods: {
            loadPaginatedData: function(){
                axios.get('/admin/broadcast/setupTargetAudience/' + this.campaignId+'?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.oBroadcast;
                        this.importButtons = response.data.sImportButtons;
                        this.exportButtons = response.data.sExcludButtons;
                        this.subscribers = response.data.oBroadcastSubscriber;
                        this.allData = response.data.allDataSubscribers;
                        this.user = response.data.userData;
                        this.showLoading(false);
                    });
            },
            displayStep: function(step){
                let path = '/admin#/modules/sms/broadcast/setup/'+this.campaignId+'/'+step;
                window.location.href = path;
            },
            saveDraft: function(){
                this.showLoading(true);
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                .then(response => {
                    this.showLoading(false);
                    if(response.data.status == 'success'){
                        this.displayMessage('success', 'Campaign saved as a draft successfully');
                    }else{
                        this.displayMessage('error', 'Something went wrong');
                    }
                });
            }

        }

    };
</script>




