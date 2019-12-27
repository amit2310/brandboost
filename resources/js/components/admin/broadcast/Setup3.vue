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
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>

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

                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card col animate_top p0">
                            <div class="p20 bbot">
                                <h3 class="htxt_medium_16 dark_700 m0"><i><img src="/assets/images/add-circle-fill.svg"/></i> &nbsp; Include contacts</h3>
                            </div>
                            <div class="p20" v-html="importButtons"></div>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex">
                        <div class="card col animate_top p0">
                            <div class="p20 bbot">
                                <h3 class="htxt_medium_16 dark_700 m0"><i><img src="/assets/images/indeterminate-circle-fill.svg"/></i> &nbsp; Exclude contacts</h3>
                            </div>
                            <div class="p20" v-html="exportButtons"></div>
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


                <div class="row mt20">
                    <!--<div class="col-md-12"><hr class="mb25"></div>-->
                    <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(2)"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6"><button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(4)">Save and continue <span><img src="/assets/images/arrow-right-line.svg"></span></button></div>
                </div>


            </div>
        </div>
        <!--Content Area End-->
        <!--Include Popup-->
        <div class="box includeAudiencePopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon includeAudience"><i><img
                    src="/assets/images/cross.svg"></i></a>
                    <target-audience-include :campaignId="campaignId" @loadFreshData="refreshBroadcastData"></target-audience-include>
                </div>
            </div>
        </div>

        <!--Exclude Popup-->
        <div class="box excludeAudiencePopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon excludeAudience"><i><img
                    src="/assets/images/cross.svg"></i></a>
                    <target-audience-exclude :campaignId="campaignId" @loadFreshData="refreshBroadcastData"></target-audience-exclude>
                </div>
            </div>
        </div>


    </div>
</template>
<script>
    import WorkflowSubscribers from '@/components/admin/workflow/WorkflowSubscribers.vue';
    import TargetAudienceInclude from '@/components/admin/workflow/targetAudience/includeOptionList';
    import TargetAudienceExclude from '@/components/admin/workflow/targetAudience/excludeOptionList';
    export default {
        components: {'workflow-subscribers':WorkflowSubscribers, 'target-audience-include': TargetAudienceInclude, 'target-audience-exclude': TargetAudienceExclude},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                current_page: 1,
                moduleName: '',
                moduleUnitID: '',
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
                        this.loading = false;
                    });
            },
            displayStep: function(step){
                let path = '/admin#/modules/emails/broadcast/setup/'+this.campaignId+'/'+step;
                window.location.href = path;
            },
            applyDefaultInfo: function (e) {
                if (e.target.checked) {
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname + ' ' + this.user.lastname;
                    this.updatesettings('from_email');
                    this.updatesettings('from_name');
                } else {

                }
            },
            updatesettings: function (fieldName) {
                this.loading = true;
                axios.post('/admin/broadcast/updateBroadcastSettingUnit', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: this.campaign[fieldName],
                    event_id: this.campaign.event_id,
                    campaign_id: this.campaign.id,
                    broadcast_id: this.campaign.broadcast_id
                }).then(response => {
                    this.successMsg = 'Updated the changes successfully!!'
                    this.loading = false;
                });

            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            refreshBroadcastData: function(){
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

    $(document).ready(function(){
        $(document).on('click', '.viewBroadcastImportOptionSmartPopup, .includeAudience', function () {
            $(".includeAudiencePopup").animate({
                width: "toggle"
            });
        });

        $(document).on('click', '.viewBroadcastExcludeOptionSmartPopup, .excludeAudience', function () {
            $(".excludeAudiencePopup").animate({
                width: "toggle"
            });
        });
    });

</script>



