<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">SMS Campaigns</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/emailfilter.svg"/></button>
                        <button class="btn btn-md bkg_email_300 light_000 js-sms-campaign-slidebox"> New campaign <span style="opacity: 0.3"><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>
            <div class="container-fluid" v-if="campaigns==''">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 email_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_email_000 mr10"><img src="/assets/images/download-fill-email.svg"/></span>
                                        Import campaign
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="/assets/images/question-line.svg"/></span>
                                        Learn how to use segments
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="/assets/images/email_illustration.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No campaigns yet. Create a first one!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or create sms campaign!</h3>
                                    <button class="btn btn-sm bkg_email_000 pr20 email_400 js-sms-campaign-slidebox">Create sms campaign</button>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" v-else>
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">Sms Campaigns</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"></span>&nbsp; Cards
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


                <div class="row">
                    <div class="col-md-3" v-for="campaign in campaigns" :key="campaign.id" @click="setupBroadcast(campaign.broadcast_id)" style="cursor:pointer;">
                        <div class="card p0 pt30 min_h_275 text-center animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareCampaignUpdate(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a v-if="campaign.status == 'inactive' || campaign.status == 'draft'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, 'active')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                    <a v-if="campaign.status == 'active' && campaign.status != 'draft'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, 'draft')"><i class="dripicons-user text-muted mr-2"></i> Draft</a>
                                    <a v-if="campaign.status == 'active'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, 'inactive')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                    <a v-if="campaign.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, 'archive')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteCampaign(campaign.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>

                            <a href="javascript:void(0);" class="circle-icon-64 bkg_email_000 m0auto" v-if="campaign.bc_status=='active' && campaign.isExpired == false" ><img src="assets/images/send-plane-fill-email_blue.svg"/> </a>
                            <a href="javascript:void(0);" class="circle-icon-64 bkg_dark_000 m0auto" v-else-if="(campaign.bc_status=='active' && campaign.isExpired == true)"><img src="assets/images/send-plane-fill-grey.svg"> </a>
                            <a href="javascript:void(0);" class="circle-icon-64 bkg_dark_000 m0auto" v-else><img src="assets/images/send-plane-fill-grey.svg"> </a>
                            <h3
                                class="htxt_bold_16 dark_700 mb-1 mt-4"
                                :title="capitalizeFirstLetter(campaign.title)"
                            >
                                {{setStringLimit(capitalizeFirstLetter(campaign.title), 15)}}
                            </h3>
                            <!-- <p class="fsize11 fw500 dark_200 text-uppercase">Campaign</p> -->
                            <p
                                class="fsize11 fw500 dark_200"
                                v-if="campaign.bc_status=='active' && campaign.isExpired == true"
                            >
                                <em>(Expired)</em>
                            </p>
                            <p
                                class="fsize11 fw500 dark_200"
                                v-else
                            >
                                <em>({{ capitalizeFirstLetter(campaign.bc_status) }})</em>
                            </p>
                            <div style="min-height: 40px; margin: 4px 0;" class="img_box">
                                <img src="assets/images/email_campaign_graph.png"/>
                            </div>

                            <div class="p15 pt15 btop">
                                <ul class="workflow_list">
                                    <li><a href="javascript:void(0);"><span><img src="assets/images/send-plane-line.svg"></span> {{campaign.totalSent>999 ? (campaign.totalSent/100)+'k' : campaign.totalSent}}</a></li>
                                    <li><a href="#"><span><img src="assets/images/mail-open-line.svg"></span> {{campaign.totalOpenGraph}}%</a></li>
                                    <li><a href="#"><span><img src="assets/images/cursor-line.svg"></span> {{campaign.totalClickGraph}}%</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3 text-center js-sms-campaign-slidebox" style="cursor: pointer;">
                        <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                            <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>Sms Campaign</p>
                        </div>
                    </div>

                </div>

                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>


            </div>

        </div>
        <!--Content Area End-->

        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-sms-campaign-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/email_campaign_icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} SMS Campaign </h3>
                                <hr class="mt30 mb30">
                            </div>
                            <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="title">Campaign name</label>
                                        <input type="text" class="form-control h56" id="title" placeholder="Enter campaign name" name="title"
                                               v-model="form.title">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Campaign description"
                                                  name="description"
                                                  v-model="form.description"></textarea>
                                    </div>

                                    <hr class="mt30 mb30"/>


                                    <div class="form-group">
                                        <label class="mb10">Campaign type</label>
                                        <div class="clearfix"></div>


                                        <label class="w-100 mb0" for="Broadcast_campaign">
                                            <div class="card border active  shadow_none p20">
                                                <div class="row">
                                                    <div class="col-md-3"><img src="/assets/images/campaign1.svg"/></div>
                                                    <div class="col-md-9 pl0">
                                                        <p class="fsize16 fw400 dark_700 m0">Broadcast</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Simple one time sms</p>
                                                    </div>
                                                </div>


                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="Broadcast_campaign" name="campaign_type">
                                                    <label class="custom-control-label" for="customRadio"></label>
                                                </div>



                                            </div>
                                        </label>



                                        <label class="w-100 mb0" for="Emailworkflows">
                                            <div class="card border shadow_none p20">
                                                <div class="row">
                                                    <div class="col-md-3"><img src="/assets/images/campaign2.svg"/></div>
                                                    <div class="col-md-9 pl0">
                                                        <p class="fsize16 fw400 dark_700 m0">SMS workflows</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Simple one time sms</p>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="Emailworkflows" name="campaign_type">
                                                    <label class="custom-control-label" for="customRadio"></label>
                                                </div>
                                            </div>
                                        </label>



                                        <label class="w-100 mb0" for="Transactionalemails">
                                            <div class="card border shadow_none p20">
                                                <div class="row">
                                                    <div class="col-md-3"><img src="/assets/images/campaign3.svg"/></div>
                                                    <div class="col-md-9 pl0">
                                                        <p class="fsize16 fw400 dark_700 m0">Transactional sms</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Send automated transactional sms</p>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="Transactionalemails" name="campaign_type">
                                                    <label class="custom-control-label" for="customRadio"></label>
                                                </div>
                                            </div>
                                        </label>

                                    </div>
                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id"
                                       :value="moduleAccountID">
                                <button class="btn btn-lg bkg_email_400 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                <a class="dark_200 fsize16 fw400 ml20" href="#">Close</a> </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Pagination from '../../../helpers/Pagination';
    export default {
        components: {Pagination},
        data() {
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaigns: '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: {
                    title: '',
                    description: '',
                    campaign_type: '',
                    automation_id: ''
                },
                formLabel: 'Create'
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            setupBroadcast: function(id){
                window.location.href='#/modules/emails/broadcast/setup/'+id+'/1';
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-sms-campaign-slidebox').click();
            },
            prepareCampaignUpdate: function(campaignId) {
                this.getCampaignInfo(campaignId);
            },
            getCampaignInfo: function(campaignId){
                axios.post('/admin/modules/emails/getAutomation', {
                    automation_id:campaignId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.title = formData.title;
                            this.form.description = formData.description;
                            this.form.campaign_type = formData.automation_type;
                            this.form.automation_id = formData.id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.automation_id>0){
                    formActionSrc = '/admin/modules/emails/updateAutomation';
                }else{
                    formActionSrc = '/admin/modules/emails/addAutiomation';
                    this.form.module_account_id = this.moduleAccountID;
                }

                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            if(this.form.automation_id>0){
                                this.setupAutomation(this.form.automation_id);
                                return false;
                            }
                            this.loading = false;
                            //this.form = {};
                            this.form.automation_id ='';
                            document.querySelector('.js-sms-campaign-slidebox').click();
                            this.successMsg = 'Action completed successfully.';
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);

                            syncContactSelectionSources();
                        }
                        else if (response.data.status == 'error') {
                            if (response.data.type == 'duplicate') {
                                alert('Error: Campaign already exists.');
                            }
                            else {
                                alert('Error: Something went wrong.');
                            }
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                        //error.response.data
                        alert('All form fields are required');
                    });
            },
            loadPaginatedData : function(){
                axios.get('/admin/broadcast/sms?page='+this.current_page)
                    .then(response => {
                        console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaigns = response.data.oBroadcast;
                        this.allData = response.data.allData;
                        this.loading = false;
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(campaignID, status) {
                if(confirm('Are you sure you want to change the status of this campaign?')){
                    //Do axios
                    axios.post('/admin/modules/emails/changeAutomationStatus', {
                        automation_id:campaignID,
                        status:status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            },
            deleteCampaign: function(campaignID) {
                if(confirm('Are you sure you want to delete this campaign?')){
                    //Do axios
                    axios.post('/admin/modules/emails/deleteAutomation', {
                        automation_id:campaignID,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }

    };

    $(document).ready(function () {
        $(document).on('click', '.js-sms-campaign-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });
</script>



