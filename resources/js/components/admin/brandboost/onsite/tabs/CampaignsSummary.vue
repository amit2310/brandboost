<template>

    <div>
        <a class="close_sidebar" href="javascript:void(0);">OPEN MENU &nbsp; <img src="assets/images/menu-2-line.svg"></a>
        <div class="page_sidebar bkg_light_000 fixed">
            <div style="width: 279px;">
                <div class="p20 bbot top_headings">
                    <div class="row">
                        <div class="col"><p>REVIEWS</p></div>
                        <!--<div class="col text-right"><p><a class="close_sidebar" href="#">OPEN MENU &nbsp; <img src="assets/images/menu-2-line.svg"></a></p></div>-->
                    </div>
                </div>

                <div class="p20 pt30 pb10">
                    <div class="row">
                        <div class="col"><h3 class="htxt_medium_24 dark_800">Campaigns</h3></div>
                        <!--<div class="col text-right"><button class="circle-icon-32 shadow3 js-review-campaign-slidebox-tab"><img src="assets/images/add-fill-review.svg"></button></div>-->
                        <div class="col text-right"><button class="circle-icon-32 shadow3 js-review-campaign-slidebox-tab" id="displayAddCampaignForm" @click="displayAddCampaignForm"><img src="assets/images/add-fill-review.svg"></button></div>
                    </div>
                </div>

                <div v-if="campaigns.length > 0 || searchBy.length>0">
                    <div class="p20 top_headings">
                        <div class="row">
                            <div class="col-md-5">
                                <!--<p>
                                    <a href="#"><img src="assets/images/filter-line.svg"> &nbsp; Filter</a>
                                </p>-->
                                <a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i> &nbsp;Filter</a>
                                <div class="dropdown-menu p10 mt-1">
                                    <a href="javascript:void(0);" :class="{'active': viewType == 'Date Created'}" @click="sortBy='Date Created'">ALL</a><br />
                                    <a href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">ACTIVE</a><br />
                                    <a href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a><br />
                                    <a href="javascript:void(0);" :class="{'active': viewType == 'Pending'}" @click="sortBy='Pending'">DRAFT</a><br />
                                    <a href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a><br />
                                    <a href="javascript:void(0);" :class="{'active': viewType == 'Positive'}" @click="sortBy='Positive'">POSITIVE</a><br />
                                    <a href="javascript:void(0);" :class="{'active': viewType == 'Negative'}" @click="sortBy='Negative'">NEGATIVE</a>
                                </div>
                            </div>
                            <div class="col-md-7 text-right">
                                <a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a>
                                <!--<input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">-->
                                <a href="javascript:void(0);" title="List View"><i><img src="assets/images/sort_16_grey.svg"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class=" datasearcharea shadow3">
                        <div class="row form-group m-0 position-relative">
                            <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search contacts" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                            <a class="search_tables_open_close searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
                        </div>
                    </div>

                    <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons3">
                        <!--<li v-for="campaign in campaigns" :key="campaign.id" v-if="campaign.id == campaignId" class="d-flex active">-->
                        <li v-for="campaign in campaigns" :key="campaign.id" class="d-flex" :class="{ active : campaignId == campaign.id }">
                            <span><!--{{campaignId }} {{ campaign.id}}-->
                                <span v-if="(campaign.revRA != '' && campaign.revRA > '3')" class="circle_icon_24 bkg_green_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <span v-else-if="(campaign.revRA != '' && campaign.revRA == '3')" class="circle_icon_24 bkg_yellow_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <span v-else-if="(campaign.revRA != '' && campaign.revRA < '3')" class="circle_icon_24 bkg_red_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <span v-else class="circle_icon_24 bkg_blue_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <!--<a href="javascript:void(0);" @click="setupBroadcast(campaign.id)">
                                    <span>{{ setStringLimit(capitalizeFirstLetter(campaign.brand_title), 25) }}</span>
                                </a>-->
                                <a href="javascript:void(0);" @click="$emit('chooseCampaign', campaign)">
                                    <span>{{ setStringLimit(capitalizeFirstLetter(campaign.brand_title), 25) }}</span>
                                </a>
                            </span>
                            <strong>
                                <span v-if="campaign.revRA != ''">{{ number_format(campaign.revRA, 1) }}&nbsp;</span>
                                <span v-else>&nbsp;</span>
                                <i v-if="(campaign.revRA != '' && campaign.revRA > '3')" class="ri-star-fill green_400"></i>
                                <i v-else-if="(campaign.revRA != '' && campaign.revRA == '3')" class="ri-star-fill yellow_400"></i>
                                <i v-else-if="(campaign.revRA != '' && campaign.revRA < '3')" class="ri-star-fill red_400"></i>
                                <i v-else class=""></i>
                            </strong>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4"
                        :noItemPerPage="true"
                        class="mt-4">
                    </pagination>
                </div>
                </div>

                <div v-else>
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" src="assets/images/review_Illustration.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any campaigns</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import campaign!</h3>
                                    <!--<button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 js-review-campaign-slidebox">Create review campaign</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <a href="#" class="text-uppercase htxt_medium_10 light_800 ls_4"><img src="assets/images/information-fill.svg"> &nbsp; LEARN MORE ABOUT CAMPAIGN</a>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Add Campaign Popup -->
        <div class="modal fade show" id="CREATEFORM">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content review">
                    <a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
                    <form method="post" @submit.prevent="processForm" @keydown="form.errors.clear($event.target.name)">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="htxt_medium_24 dark_800 mb-3">Review Campaign</h3>
                                <p class="htxt_regular_14 dark_200 m-0">Select a type of campaign you would like to create and give it a title.</p>
                                <hr/>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN NAME</label>
                                    <!--<input type="text" class="form-control h48 fsize14 dark_200 br4" id="fname" placeholder="Enter new campaign name" name="fname">-->

                                    <div class="campaign_name_sec border br4 p10 pl20 pr20 fsize14 dark_200">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" v-model="form.campaignName" class="textfield fsize14 dark_200" id="fname" placeholder="Enter new campaign name" name="campaignName">
                                            </div>
                                            <div class="col-2">
                                                <div class="dropdown campaign_forms">
                                                    <button class="btn dropdown-toggle bkg_light_000 w-100 p-1 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="assets/images/circle-dot.svg"/>
                                                    </button>
                                                    <div class="dropdown-menu w-100 dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"/> Option 1 </a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"/> Option 2 </a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"/> Option 3 </a>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <span class="help alert-danger" v-if="form.errors.has('campaignName')" v-text="form.errors.get('campaignName')"></span>

                                </div>

                            </div>


                            <div class="col">
                                <div class="form-group m-0">
                                    <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN TYPE</label>
                                    <div class="card border text-center shadow-none m-0" :class="{'reviews': form.campaignType =='manual'}" @click="form.campaignType='manual'" style="cursor: pointer;">
                                        <img class="mb-3" src="assets/images/review_icon1.svg"/>
                                        <p class="htxt_medium_14 dark_600 mb-3">Manual Campaign</p>
                                        <p class="htxt_regular_12 dark_300 m-0 lh_17">Send review requests emails <br>& sms instantly to all or part <br>of your customers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group m-0">
                                    <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                                    <div class="card border text-center shadow-none m-0" :class="{'reviews': form.campaignType =='automated'}" @click="form.campaignType='automated'" style="cursor: pointer;">
                                        <img class="mb-3" src="assets/images/review_icon2.svg"/>
                                        <p class="htxt_medium_14 dark_600 mb-3">Automated Campaign</p>
                                        <p class="htxt_regular_12 dark_300 m-0 lh_17">Automaticaly send email or sms<br> every time a new purchase or<br> contact is added</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr/>
                            </div>

                            <div class="col-6">
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id" :value="moduleAccountID">
                                <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" :disabled="form.errors.any()">CONTINUE</button>
                                <a class="dark_200 fsize12 fw500 ml20 text-uppercase" data-dismiss="modal" href="javascript:void(0);">Close</a>
                            </div>

                            <div class="col-6 text-right mt-2">
                                <a class="lh_32 htxt_regular_12 dark_200 ls_4" href="javascript:void(0);">
                                    <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                    LEARN MORE ABOUT CAMPAIGNS
                                </a>
                            </div>




                        </div>
                    </form>


                </div>
            </div>
        </div>


        <!-- Add Campaign Popup -->
        <!--<div class="box" style="width: 724px;">
            <div style="width: 724px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-review-campaign-slidebox-tab"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm" @keydown="form.errors.clear($event.target.name)">
                        <div class="p40">
                            <div class="row">
                                <div class="col-12">
                                    &lt;!&ndash;<img src="/assets/images/sms_temp_icon.svg"/>&ndash;&gt;
                                    <h3 class="htxt_medium_24 dark_800 mb-3">Review Campaign</h3>
                                    <p class="htxt_regular_14 dark_200 m-0">Select a type of campaign you would like to create and give it a title.</p>
                                    <hr/>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="campaignName" class="fsize11 fw500 dark_600">CAMPAIGN NAME</label>
                                        <input type="text" class="form-control h56" id="name" placeholder="Enter new campaign name" name="campaignName"
                                               v-model="form.campaignName">
                                        <span class="help alert-danger" v-if="form.errors.has('campaignName')" v-text="form.errors.get('campaignName')"></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description" class="fsize11 fw500 dark_600">DESCRIPTION</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Enter campaign description" name="OnsitecampaignDescription"
                                                  v-model="form.OnsitecampaignDescription"></textarea>
                                        <span class="help alert-danger" v-if="form.errors.has('OnsitecampaignDescription')" v-text="form.errors.get('OnsitecampaignDescription')"></span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group m-0">
                                        <label for="fname" class="fsize11 fw500 dark_600">CAMPAIGN TYPE</label>
                                        <div class="card border text-center shadow-none m-0 reviews">
                                            <img class="mb-3" src="assets/images/review_icon1.svg"/>
                                            <p class="htxt_medium_14 dark_600 mb-3">Manual Campaign</p>
                                            <p class="htxt_regular_12 dark_300 m-0 lh_17">Send review requests emails <br>& sms instantly to all or part <br>of your customers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-0">
                                        <label for="fname" class="fsize11 fw500 dark_600">&nbsp;</label>
                                        <div class="card border text-center shadow-none m-0">
                                            <img class="mb-3" src="assets/images/review_icon2.svg"/>
                                            <p class="htxt_medium_14 dark_600 mb-3">Automated Campaign</p>
                                            <p class="htxt_regular_12 dark_300 m-0 lh_17">Automaticaly send email or sms<br> every time a new purchase or<br> contact is added</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr/>
                                </div>

                                <div class="col-6">
                                    <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                    <input type="hidden" name="module_account_id" id="module_account_id" :value="moduleAccountID">
                                    <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" :disabled="form.errors.any()">{{ formLabel }}</button>
                                    <a class="dark_200 fsize12 fw500 ml20 text-uppercase js-review-campaign-slidebox-tab" href="javascript:void(0);">Close</a>
                                </div>

                                <div class="col-6 text-right mt-2">
                                    <a class="lh_32 htxt_regular_12 dark_200 ls_4" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                        LEARN MORE ABOUT CAMPAIGNS
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>-->
        <!-- /Add Campaign -->

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Onsite Reviews - Brand Boost',
        name: "OnsiteCampaignsTab",
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
                campaignId: this.$route.params.id,
                company_name: '',
                count : 0,
                campaigns : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: new Form({
                    campaignName: '',
                    OnsitecampaignDescription: '',
                    campaign_id: '',
                    campaignType: 'manual'
                }),
                formLabel: 'Create',
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: ''
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.campaignId = this.$route.params.id;
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            },
            'searchBy' : function(){
                this.loadPaginatedData();
            }
        },
        methods: {
            searchItem: function(){
                this.loadPaginatedData();
            },
            setupBroadcast: function(id){ return false;
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
                axios.get('/admin/brandboost/onsite?page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
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
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                //document.querySelector('.js-review-campaign-slidebox-tab').click();
                document.querySelector('#displayAddCampaignForm').click();
            },
            displayAddCampaignForm: function(){
                document.querySelector('#displayAddCampaignForm').click();
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
                this.form.post(formActionSrc, this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            if(response.data.brandboostID>0){
                                this.successMsg = "Campaign added successfully! Redirecting to the setup page...";
                                window.location.href='#/reviews/onsite/setup/'+response.data.brandboostID+'/1';
                                return false;
                            }

                            //this.form = {};
                            document.querySelector('.js-review-campaign-slidebox-tab').click();
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
                        }else{
                            this.loading = false;
                        }
                    })
                    .catch(errors => {
                        this.loading = false;
                    })
            }
        }
    }

    $(document).ready(function () {
        $(document).on('click', '.js-review-campaign-slidebox-tab', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", "#displayAddCampaignForm", function(){
            $("#CREATEFORM").modal('show');
        })
    });
</script>
