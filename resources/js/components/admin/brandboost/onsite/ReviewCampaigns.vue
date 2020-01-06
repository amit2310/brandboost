<template>

    <div class="content">

        <!--******************
        Top Heading area
        **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Review Campaigns</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40"><img src="assets/images/filter_review.svg"/></button>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div class="container-fluid" v-if="campaigns.length > 0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 pt0 pb0">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="fsize12 fw500 dark_200 mt30 mb30"><i><img src="assets/images/lightbulb-fill.svg"></i> &nbsp; TIPS</p>
                                    <h3 class="htxt_bold_18 dark_800">Automate messages, build engage with chatbots</h3>
                                    <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">Conversational marketing platform that helps companies close more deals by messaging with prospects in real-time &amp; via intelligent chatbots. Qualify leads, book meetings.</p>

                                </div>
                                <div class="col-md-5 text-center mt20">
                                    <img class="mt0" style="max-width: 272px;" src="assets/images/review_campaign.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table_head_action bbot pb30">
                    <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                    <loading :isLoading="loading"></loading>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ campaigns.length }}&nbsp;Campaigns</h3>
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
                                        <span><img src="assets/images/list_view.svg"></span>&nbsp; List View
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
                    <div class="col-md-3 d-flex" v-for="campaign in campaigns" :key="campaign.id">
                        <div class="card p0 pt30 text-center animate_top col">

                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareItemUpdate(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a v-if="campaign.status == '2'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Start</a>
                                    <a v-if="campaign.status == '1'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Pause</a>
                                    <a v-if="campaign.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(campaign.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showContacts(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Contacts</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showCampaignPage(campaign.id,company_name,campaign.brand_title.replace(' ','-'))"><i class="dripicons-user text-muted mr-2"></i> Campaign Page</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showReviews(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Reviews</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showQuestions(campaign.id)"><i class="dripicons-user text-muted mr-2"></i> Questions</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(campaign.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <div @click="setupBroadcast(campaign.id)" style="cursor:pointer;">
                                <a v-if="campaign.status===0" href="javascript:void(0)" class="circle-icon-64 bkg_dark_000 m0auto"><img src="assets/images/star-fill-grey.svg"> </a>
                                <a v-else href="javascript:void(0)" class="circle-icon-64 bkg_reviews_000 m0auto"><img src="assets/images/star-fill-review-24.svg"> </a>
                                <h3 class="htxt_bold_16 dark_700 mb-2 mt-4">{{ setStringLimit(capitalizeFirstLetter(campaign.brand_title), 25) }}</h3>
                                <p class="fsize12 fw500 green_400 mb20">{{ setStringLimit(campaign.brand_desc, 100) }}</p>
                                <div class="p15 pt15 btop text-uppercase">
                                    {{ campaign.status === 0 ? 'COMPLETED' : 'RUNNING' }}
                                    <!--<ul class="workflow_list">
                                        <li><a href="#"><span><img src="assets/images/send-plane-line.svg"></span> 3k</a></li>
                                        <li><a href="#"><span><img src="assets/images/mail-open-line.svg"></span> 28%</a></li>
                                        <li><a href="#"><span><img src="assets/images/cursor-line.svg"></span> 67%</a></li>
                                    </ul>-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex js-review-campaign-slidebox" style="cursor: pointer;">
                        <div class="card p0 pt50 text-center animate_top col">
                            <a href="#" class="circle-icon-64 bkg_dark_000 m0auto"><img src="assets/images/plus_grey_24.svg"> </a>
                            <h3 class="htxt_bold_12 dark_200 mb-0 mt-4 text-uppercase">Create<br>new campaign</h3>
                        </div>
                    </div>

                </div>

                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>

            </div>


            <div class="container-fluid" v-else>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/download-fill-review.svg"></span>
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
                                    <img class="mt40" style="max-width: 250px; " src="assets/images/review_campaign.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any campaigns</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import campaign!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 js-review-campaign-slidebox">Create review campaign</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            <!-- Add Campaign Popup -->
            <div class="box" style="width: 424px;">
                <div style="width: 424px;overflow: hidden; height: 100%;">
                    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-review-campaign-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                        <form method="post" @submit.prevent="processForm">
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="/assets/images/sms_temp_icon.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Review Campaign </h3>
                                        <hr class="mt30 mb30">
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="title">Campaign name</label>
                                            <input type="text" class="form-control h56" id="campaignName" placeholder="Enter campaign name" name="campaignName"
                                                   v-model="form.campaignName">
                                        </div>

                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <textarea class="form-control min_h_185 p20 pt10" id="OnsitecampaignDescription" placeholder="Campaign description"
                                                      name="OnsitecampaignDescription"
                                                      v-model="form.OnsitecampaignDescription"></textarea>
                                        </div>

                                        <hr class="mt30 mb30"/>

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
                                        <button class="btn btn-lg bkg_sms_400 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                        <a class="dark_200 fsize16 fw400 ml20" href="#">Close</a> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Add Campaign -->

        </div>
        <!--******************
          Content Area End
         **********************-->

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                company_name: '',
                count : 0,
                campaigns : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: {
                    campaignName: '',
                    OnsitecampaignDescription: '',
                    campaign_id: ''
                },
                formLabel: 'Create'
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
        },
        methods: {
            setupBroadcast: function(id){
                window.location.href='#/reviews/onsite/setup/'+id+'/1';
            },
            showContacts: function(id){
                window.location.href='#/brandboost/stats/onsite/'+id+'?t=contact';
            },
            showCampaignPage: function(id,companyName,campaignName){
                window.location.href='#/for/'+companyName+'/'+campaignName+'-'+id;
            },
            showReviews: function(id){
                window.location.href='#/brandboost/reviews/'+id;
            },
            showQuestions: function(id){
                window.location.href='#/brandboost/questions/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/onsite?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.company_name = response.data.company_name;
                        this.allData = response.data.allData;
                        this.campaigns = response.data.aBrandbosts;
                        this.loading = false;
                        //console.log(this.campaigns)
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-review-campaign-slidebox').click();
            },
            prepareItemUpdate: function(campaign_id) {
                //window.location.href='#/brandboost/onsite_setup/'+campaign_id;
                this.getItemInfo(campaign_id);
            },
            getItemInfo: function(campaign_id){
                axios.post('/admin/brandboost/getReviewCampaign', {
                    campaign_id: campaign_id,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.campaign_id = formData.campaign_id;
                            this.form.campaignName = formData.campaignName;
                            this.form.OnsitecampaignDescription = formData.description;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.campaign_id>0){
                    formActionSrc = '/admin/brandboost/updateReviewCampaign';
                }else{
                    formActionSrc = '/admin/brandboost/addOnsite';
                    this.form.module_account_id = this.moduleAccountID;
                }

                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            if(response.data.brandboostID>0){
                                window.location.href='#/brandboost/onsite_setup/'+response.data.brandboostID;
                                return false;
                            } else {
                                window.location.href='#/brandboost/onsite_setup/'+response.data.brandboostID;
                                return false;
                            }
                            this.loading = false;
                            //this.form = {};
                            this.form.campaign_id ='';
                            document.querySelector('.js-review-campaign-slidebox').click();
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
            changeStatus: function(campaign_id, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/updateOnsiteStatus', {
                        brandboostID:campaign_id,
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
            deleteItem: function(campaign_id) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/delete_brandboost', {
                        brandboost_id:campaign_id,
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
            }
        }
    }

    $(document).ready(function () {
        $(document).on('click', '.js-review-campaign-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });
    });
</script>

<style>

</style>
