<template>

    <div>

        <div class="card p25 pt20 pb10">
            <div class="row">
                <div class="col">
                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">CAMPAIGNS</p>
                </div>
                <div class="col">
                    <div class="float-right">
                        <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical.svg"></span> </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(647px, 102px, 0px);"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr class="mb-0">
                </div>
            </div>


            <div class="row" v-if="campaigns.length > 0">
                <div class="col">
                    <table class="table table-borderless mb-0">
                        <tbody>
                        <tr v-for="campaign in campaigns.slice(0,5)" :key="campaign.id">
                            <td>
                                <span class="table-img mr15">
                                    <span v-if="(campaign.revRA != '' && campaign.revRA > '3')" class="circle_icon_24 bkg_green_400"><img src="assets/images/pricetag3-fill.svg" width="13"></span>
                                    <span v-else-if="(campaign.revRA != '' && campaign.revRA == '3')" class="circle_icon_24 bkg_yellow_400"><img src="assets/images/pricetag3-fill.svg" width="13"></span>
                                    <span v-else-if="(campaign.revRA != '' && campaign.revRA < '3')" class="circle_icon_24 bkg_red_400"><img src="assets/images/pricetag3-fill.svg" width="13"></span>
                                    <span v-else class="circle_icon_24 bkg_reviews_400"><img src="assets/images/pricetag3-fill.svg" width="13"></span>
                                </span>
                                <a href="javascript:void(0);" @click="setupBroadcast(campaign.id)">
                                    <span>{{ setStringLimit(capitalizeFirstLetter(campaign.brand_title), 25) }}</span>
                                </a>
                            </td>
                            <td>{{ campaign.reviewRequestsCountK }}k</td>
                            <td>{{ campaign.reviewResponsePercent }}%</td>
                            <td>{{ campaign.reviewResponsePercent }}%</td>
                            <td class="text-right">
                                <span class="dark_400">
                                    <i v-if="(campaign.revRA != '' && campaign.revRA > '3')" class="ri-star-fill green_400"></i>
                                    <i v-else-if="(campaign.revRA != '' && campaign.revRA == '3')" class="ri-star-fill yellow_400"></i>
                                    <i v-else-if="(campaign.revRA != '' && campaign.revRA < '3')" class="ri-star-fill red_400"></i>
                                    <i v-else class=""></i>
                                    &nbsp;
                                    <span v-if="campaign.revRA != ''">{{ number_format(campaign.revRA, 1) }}&nbsp;</span>
                                    <span v-else>&nbsp;</span>
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row" v-else>
                <div class="col-md-12">
                    <div class="card card_shadow min-h-280">
                        <div class="row mb65">
                            <div class="col-md-12 text-center">
                                <img class="mt40" style="max-width: 250px; " src="assets/images/review_Illustration.svg">
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

        </div>

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
                company_name: '',
                count : 0,
                campaigns : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: new Form({
                    campaignName: '',
                    OnsitecampaignDescription: '',
                    campaign_id: ''
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
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            }
        },
        methods: {
            searchItem: function(){
                this.loadPaginatedData();
            },
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
                            //document.querySelector('.js-review-campaign-slidebox-tab').click();
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

    /*$(document).ready(function () {
        $(document).on('click', '.js-review-campaign-slidebox-tab', function(){
            $(".box").animate({
                width: "toggle"
            });
        });
    });*/
</script>
