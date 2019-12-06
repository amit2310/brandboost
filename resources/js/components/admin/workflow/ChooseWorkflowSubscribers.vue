<template>
    <div>
        <loading :isLoading="loading"></loading>
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
                    <div class="p20" v-html="excludeButtons"></div>
                </div>
            </div>


        </div>

        <div class="table_head_action mt-2">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="htxt_medium_16 dark_400">{{allData.total}} Subscribers</h3>
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
            :module-unit-id="moduleUnitId"
            :showHeader="false"
            @navPage ="navigatePagination"
            :key="refreshKey"
        ></workflow-subscribers>

        <div class="row mt20">
            <!--<div class="col-md-12"><hr class="mb25"></div>-->
            <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" id="backtoworkflowgridbutton" @click="backToWorkflowGrid"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button></div>
            <div class="col-6"></div>
        </div>


        <!--Include Popup-->
        <div class="box includeWorkflowAudiencePopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon includeWorkflowAudience" @click="refreshalllists"><i><img
                    src="/assets/images/cross.svg"></i></a>
                    <workflow-audience-include
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        @loadFreshSelectionData="refreshSelectionData"
                        @syncWorkflowAudience="syncWorkflowAudience"
                    ></workflow-audience-include>
                </div>
            </div>
        </div>

        <!--Exclude Popup-->
        <div class="box excludeWorkflowAudiencePopup" style="width: 80%; display: none;">
            <div style="width: 80%;overflow: hidden;height: 100%;">
                <div style="height: 100%; overflow: hidden auto;"><a class="cross_icon excludeWorkflowAudience" @click="refreshalllists"><i><img
                    src="/assets/images/cross.svg"></i></a>
                    <workflow-audience-exclude
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        @loadFreshSelectionData="refreshSelectionData"
                        @syncWorkflowAudience="syncWorkflowAudience"
                    ></workflow-audience-exclude>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import workflowSubscribers from './WorkflowSubscribers';
    import workflowAudienceInclude from './workflowAudience/includeOptionList';
    import workflowAudienceExclude from './workflowAudience/excludeOptionList';

    export default {
        props: ['moduleName', 'moduleUnitId'],
        components: {workflowSubscribers, workflowAudienceInclude, workflowAudienceExclude},
        data() {
            return {
                current_page: 1,
                contactSelectionData: '',
                subscribersData: '',
                importButtons: '',
                excludeButtons: '',
                subscribers: '',
                allData: '',
                activeCount: 0,
                archiveCount: 0,
                loading: true,
                refreshKey: '1'
                //alert(subscribersData)
            }
        },

        methods: {
            loadPaginatedData: function(){
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowContactSelectionInterfaceData?page='+this.current_page, {moduleName: this.moduleName, moduleUnitID:this.moduleUnitId})
                    .then(response => {
                        this.contactSelectionData = response.data.contactSelectionData;
                        this.importButtons = this.contactSelectionData.sImportButtons;
                        this.excludeButtons = this.contactSelectionData.sExcludButtons;
                        this.subscribers = this.contactSelectionData.oCampaignSubscribers;
                        this.allData = this.contactSelectionData.oCampaignSubscribersAll;
                        this.loading = false;
                        this.refreshalllists();

                    });
            },
            refreshSelectionData: function(){
                this.loadPaginatedData();

            },
            getWorkflowSubscribers: function(){
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/workflowSubscribers', {moduleName: this.moduleName, moduleUnitID:this.moduleUnitId})
                    .then(response => {
                        this.subscribersData = response.data.subscribersData;
                    });

            },
            syncWorkflowAudience : function(){
                axios.post('/admin/workflow/syncWorkflowAudience', {
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    _token: this.csrf_token()
                }).then(response => {

                });
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            backToWorkflowGrid: function(){
                this.$emit("displayTreeInterface")
            },
            refreshalllists: function(){
                let randomNo = new Date().getTime() + Math.random();
                this.refreshKey = randomNo;
            }
        },

        mounted() {
            this.getWorkflowSubscribers();
            this.loadPaginatedData();


        }

    }

    $(document).ready(function(){
        $(document).on('click', '.viewWorkflowImportOptionSmartPopup, .includeWorkflowAudience', function () {
            $(".includeWorkflowAudiencePopup").animate({
                width: "toggle"
            });
        });

        $(document).on('click', '.viewWorkflowExcludeOptionSmartPopup, .excludeWorkflowAudience', function () {
            $(".excludeWorkflowAudiencePopup").animate({
                width: "toggle"
            });
        });
    });
</script>




