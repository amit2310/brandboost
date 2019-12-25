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
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Reviews</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(5)"><span class="num_circle"><span class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Media</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="table_head_action mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{allData.total}} subscribers</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/date_created.svg"></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/list_view.svg"></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Serch">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <workflow-subscribers
                    :show-archived="true"
                    :subscribers-data="subscribers"
                    :all-data="allData"
                    :active-count="activeCount"
                    :archive-count="archiveCount"
                    :module-name="moduleName"
                    :module-unit-id="moduleUnitID"
                    :showHeader="false"
                    @navPage ="navigatePagination"
                    :key="subscribers"
                ></workflow-subscribers>


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
    import WorkflowSubscribers from '../../../workflow/WorkflowSubscribers.vue';
    export default {
        components: {WorkflowSubscribers},
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
                activeCount: 0,
                archiveCount: 0

            }
        },
        mounted() {
            this.loadPaginatedData();

        },
        methods: {
            loadPaginatedData: function(){
                axios.get('/admin/brandboost/onsiteSetupSubscribers/' + this.campaignId+'?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.brandboostData;
                        this.subscribers = response.data.subscribers;
                        this.allData = response.data.allData;
                        this.user = response.data.aUserInfo;
                        this.loading = false;
                    });
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/reviews/onsite';
                }else{
                    path = '/admin#/reviews/onsite/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
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
</style>




