<template>
    <div>
        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">SMS Campaign</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="mr15 btn btn-md bkg_light_000 sms_400">Filters &nbsp; &nbsp; <img src="assets/images/sms_filter.svg"/></button>
                        <button class="btn btn-md light_000 bkg_sms_400 js-sms-campaign-slidebox" >New Campaign &nbsp; &nbsp; <span><img src="assets/images/sms_add.svg"/></span></button>
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
                                    <a class="lh_32 sms_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_sms_000 mr10"><img src="assets/images/sms-download-fill.svg"></span>
                                        Import campaign
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                                        Learn how to use reviews monitoring
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 240px; " src="assets/images/review_feed_illustration.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No campaigns yet. Create a first one!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or create SMS campaign!</h3>
                                    <button class="btn btn-sm bkg_sms_000 pr20 sms_400 js-sms-campaign-slidebox">Create SMS Campaign</button>
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
                            <h3 class="htxt_medium_16 dark_400">SMS Campaigns</h3>
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
                                    <input class="table_search" type="text" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3" v-for="campaign in campaigns" :key="campaign.broadcast_id" style="cursor:pointer;">
                        <div class="card p0 pt30 min_h_275 text-center animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareCampaignUpdate(campaign.broadcast_id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a class="dropdown-item clonBroadcastCampaign" href="javascript:void(0);" :broadcast_id="`${campaign.broadcast_id}`"><i class="dripicons-user text-muted mr-2"></i> Duplicate</a>
                                    <a v-if="campaign.status == 'inactive' || campaign.status == 'draft'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.broadcast_id, 'active')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                    <a v-if="campaign.status == 'active' && campaign.status != 'draft'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.broadcast_id, 'draft')"><i class="dripicons-user text-muted mr-2"></i> Draft</a>
                                    <a v-if="campaign.status == 'active'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.broadcast_id, 'inactive')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                    <a v-if="campaign.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.broadcast_id, 'archive')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteCampaign(campaign.broadcast_id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <div @click="setupBroadcast(campaign.broadcast_id)">
                                <a href="javascript:void(0);" class="circle-icon-64 bkg_sms_000 m0auto" v-if="campaign.bc_status=='active' && campaign.isExpired == false" ><img src="assets/images/sms-chat-4-line.svg"/> </a>
                                <a href="javascript:void(0);" class="circle-icon-64 bkg_sms_000 m0auto" v-else-if="(campaign.bc_status=='active' && campaign.isExpired == true)"><img src="assets/images/sms-chat-4-line.svg"> </a>
                                <a href="javascript:void(0);" class="circle-icon-64 bkg_sms_000 m0auto" v-else><img src="assets/images/sms-chat-4-line.svg"> </a>
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
                                        <li><a href="javascript:void(0);"><span><img src="assets/images/send-plane-line.svg"></span> {{campaign.totalSent > 999 ? (campaign.totalSent/100)+'k' : campaign.totalSent}}</a></li>
                                        <li><a href="#"><span><img src="assets/images/mail-open-line.svg"></span> {{campaign.totalOpenGraph}}%</a></li>
                                        <li><a href="#"><span><img src="assets/images/cursor-line.svg"></span> {{campaign.totalClickGraph}}%</a></li>
                                    </ul>
                                </div>
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

        <!-- Add Broadcast Popup -->
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
                                        <input type="text" class="form-control h56" id="campaign_name" placeholder="Enter campaign name" name="campaign_name"
                                               v-model="form.campaign_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Campaign description"
                                                  name="description"
                                                  v-model="form.description"></textarea>
                                    </div>

                                    <hr class="mt30 mb30"/>

                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" value="" name="template_name" id="template_name">
                                <textarea name="template_content" id="template_content" style="display:none;"></textarea>
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id"
                                       :value="moduleAccountID">
                                <button class="btn btn-lg bkg_sms_400 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                <a class="dark_200 fsize16 fw400 ml20" href="#">Close</a> </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Broadcast -->

        <!-- Update Broadcast Modal-->
        <div id="updateBroadcast" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" name="updateBroadcastData" class="form-horizontal" id="updateBroadcastData" action="javascript:void();">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Brand Boost Broadcast</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mt0">Campaign Name</h3>
                                    <p>Enter a name to help you remember what this campaign is all about. Only you will see this.</p>
                                    <input class="form-control" type="text" name="edit_broadcast" id="edit_broadcast" value="" placeholder="Campaign Name" />

                                    <h3 class="mt10">Description</h3>
                                    <textarea class="form-control" id="edit_description" name="edit_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p40">
                            <input type="hidden" value="" name="edit_broadcastId" id="edit_broadcastId">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn dark_btn">Continue</button>
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
                    campaign_name: '',
                    description: '',
                    broadcast_type: 'SMS',
                    template_name: '',
                    template_content: '',
                    automation_id: ''
                },
                formLabel: 'Create'
            }
        },
        mounted() {
            document.querySelector("body").id="SMSSection";
            this.loadPaginatedData();
        },
        methods: {
            setupBroadcast: function(id){
                window.location.href='#/modules/sms/broadcast/setup/'+id+'/1';
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-sms-campaign-slidebox').click();
            },
            prepareCampaignUpdate: function(campaignId) {
                //window.location.href='#/broadcast/edit/'+campaignId;
                this.getCampaignInfo(campaignId);
            },
            getCampaignInfo: function(campaignId){
                axios.post('/admin/modules/emails/getAutomation', {
                    automation_id:campaignId,
                    moduleName: this.moduleName,
                    email_type: 'broadcast',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.campaign_name = formData.title;
                            this.form.description = formData.description;
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
                    formActionSrc = '/admin/broadcast/updateBroadcastClone';
                }else{
                    formActionSrc = '/admin/broadcast/createBroadcast';
                    this.form.module_account_id = this.moduleAccountID;
                }

                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            if(this.form.automation_id>0){
                                window.location.href='#/broadcast/edit/'+this.form.automation_id;
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
                        //console.log(response.data);
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

        $(document).on('click', '.clonBroadcastCampaign', function () {
            var automationID = $(this).attr('broadcast_id');
            $.ajax({
                url: "/admin/broadcast/clonBroadcastCampaign",
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {automation_id: automationID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = window.location.href;
                        $('#edit_broadcast').val(data.broadcastName);
                        $('#edit_description').val(data.description);
                        $('#edit_broadcastId').val(data.broadcastId);
                        $("#updateBroadcast").modal();
                    }
                }
            });
        });

        $('#updateBroadcastData').submit(function () {
            var campaignName = $('#edit_broadcast').val();
            var description = $('#edit_description').val();
            var broadcastId = $('#edit_broadcastId').val();
            if (campaignName == '') {
                alertMessage('Please enter campaign name.');
            } else {
                $('.overlaynew').show();
                $.ajax({
                    url: "/admin/broadcast/updateBroadcastClone",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    type: "POST",
                    data: {edit_broadcastId: broadcastId, campaign_name: campaignName, description: description, broadcast_type: 'SMS'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            window.location.href = "#/broadcast/edit/" + broadcastId;
                            return false;
                        } else {
                            $('.overlaynew').hide();
                            alertMessage('Error: Some thing wrong!');
                            return false;
                        }
                    }, error: function (xhr, status, error) {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                });
            }
            return false;
        });

    });
</script>



