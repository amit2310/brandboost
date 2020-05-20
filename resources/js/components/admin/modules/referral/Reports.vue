<template>

    <div class="content" id="masterContainer">

        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{ oSettings.title }} Report</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">

            <!--====Top Section Graph====-->
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon1.png"/>
                                <h1 class="txt_dark fsize28 fw700">{{ oTotalReferralSent.totalEmailSent > 0 ? oTotalReferralSent.totalEmailSent : 0 }}</h1>
                                <p class="fsize14 txt_dgrey mb0">Referral email sent</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon1.png"/>
                                <h1 class="txt_dark fsize28 fw700">{{ oTotalReferralSent.totalSmsSent > 0 ? oTotalReferralSent.totalSmsSent : 0 }}</h1>
                                <p class="fsize14 txt_dgrey mb0">Referral sms sent</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon2.png"/>
                                <h1 class="txt_dark fsize28 fw700">{{ oTotalReferralTwillio.totalOpened > 0 ? oTotalReferralTwillio.totalOpened : 0 }}</h1>
                                <p class="fsize14 txt_dgrey mb0">Opens</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon2.png"/>
                                <h1 class="txt_dark fsize28 fw700">{{ oTotalReferralTwillio.totalClicked > 0 ? oTotalReferralTwillio.totalClicked : 0 }}</h1>
                                <p class="fsize14 txt_dgrey mb0">Clicks</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====Stats====-->


            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon3.png"/>
                                <h1 class="txt_dark fsize28 fw700">{{ oRefVisits.length > 0 ? oRefVisits.length : 0 }}</h1>
                                <p class="fsize14 txt_dgrey mb0">Referral Link(Landing Page) Visits</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon4.png"/>
                                <h1 class="txt_dark fsize28 fw700">${{(referredAmount) ? referredAmount : 0}}</h1>
                                <p class="fsize14 txt_dgrey mb0">Purchases by referred customer</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon3.png"/>
                                <h1 class="txt_dark fsize28 fw700">{{ oUntrackedPurchased.length > 0 ? oUntrackedPurchased.length : 0 }}</h1>
                                <p class="fsize14 txt_dgrey mb0">Total Untracked Sales</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="assets/images/ro_icon4.png"/>
                                <h1 class="txt_dark fsize28 fw700">${{ (untrackedAmount) ? untrackedAmount : 0 }}</h1>
                                <p class="fsize14 txt_dgrey mb0">Total Untracked Sales Amount</p>
                            </div>
                            <div class="btop p20">
                                <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====Table====-->

            <div class="clearfix"><br /></div>

            <div v-if="oRefPurchased.length > 0" class="container-fluid">


                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">Referral Sales Report</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th><i class="icon-display"></i>Referred Friend</th>
                                <th><i class="icon-display"></i>Email Address</th>
                                <th><i class="icon-calendar"></i>Referrer</th>
                                <th><i class="icon-atom"></i>Amount</th>
                                <th><i class="icon-atom"></i>Invoice ID</th>
                                <th><i class="icon-atom"></i>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="purchase in oRefPurchased">
                                <td>
                                    <span class="table-img mr15">
                                        <user-avatar
                                            :avatar="purchase.avatar"
                                            :firstname="purchase.firstname"
                                            :lastname="purchase.lastname"
                                        ></user-avatar>
                                    </span>
                                    <span class="htxt_medium_14 dark_900">
                                        {{ capitalizeFirstLetter(purchase.firstname) }} {{ capitalizeFirstLetter(purchase.lastname) }}
                                    </span>
                                </td>
                                <td>
                                    {{ purchase.email }}
                                </td>
                                <td>
                                   <span v-if="purchase.aff_firstname"> {{ capitalizeFirstLetter(purchase.aff_firstname) }} {{ capitalizeFirstLetter(purchase.aff_lastname) }}
                                    <br />{{ purchase.aff_email }} </span>
                                    <span v-else>[No Data]</span>
                                </td>
                                <td>
                                    {{ purchase.currency }} {{ purchase.amount }}
                                </td>
                                <td>
                                    {{ purchase.invoice_id }}
                                </td>
                                <td>
                                    {{ displayDateFormat('d M Y, h:i A', purchase.created) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>
            </div>

            <div v-else class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">

                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="assets/images/illustration2.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any Referral stats</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create!</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    &nbsp;
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                        Learn how to use Referral stats
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->

        <!--******************
          Create New Sliding Smart Popup
         **********************-->
        <div class="box smart-advocate-box" style="width: 680px;z-index:9999999999;">
            <div style="width: 680px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
                    <div class="row" style="height: 100%;">
                        <div class="col-md-12">
                            <a style="left: 35px; top: 15px;" class="reviews smart-contact slide-toggle bkg_grey_light" ><i class=""><img src="/assets/images/icon_arrow_left.png"/></i></a>
                            <h5 style="padding-left: 75px;" class="panel-title">Advocate Report</h5>
                        </div>
                        <div id="advocateSmartPopupNew"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'Referral Module - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    source_type: '',
                    description: '',
                    ref_id: ''
                },
                formLabel: 'Create',
                bActiveSubsription: '',
                programId: this.$route.params.id,


                loading: true,
                breadcrumb: '',
                moduleName: 'referral',
                moduleUnitID: '',
                moduleAccountID: '',
                current_page: 1,
                oRefPurchased: '',
                allData: '',
                oSettings: '',
                oRefVisits: '',
                referredAmount: '',
                untrackedAmount: '',
                oUntrackedPurchased: '',
                oTotalReferralSent: '',
                oTotalReferralTwillio: ''
            }
        },
        mounted() {
            this.loadPaginatedData();
            console.log("Component Mounted");
        },
        methods: {
            showReferralSetup: function(programId){
                window.location.href='#/modules/referral/setup/'+programId;
            },
            loadPaginatedData: function () {
                //getData
                axios.get('/admin/modules/referral/reports/'+this.programId+'?page='+this.current_page)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.allData = response.data.allData;
                        this.oRefPurchased = response.data.oRefPurchased;
                        this.oSettings = response.data.oSettings;
                        this.oRefVisits = response.data.oRefVisits;
                        this.referredAmount = response.data.referredAmount;
                        this.untrackedAmount = response.data.untrackedAmount;
                        this.oUntrackedPurchased = response.data.oUntrackedPurchased;
                        this.oTotalReferralSent = response.data.oTotalReferralSent;
                        this.oTotalReferralTwillio = response.data.oTotalReferralTwillio;
                        //console.log(this.oRefPurchased);
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            navigatePagination: function (p) {
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(programId, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/subscriber/changeModuleContactStatus', {
                        subscriberId:programId,
                        contactStatus:status,
                        moduleName: this.moduleName.toLowerCase(),
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
            deleteItem: function(programId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/subscriber/deleteModuleSubscriber', {
                        subscriberId:programId,
                        moduleName: this.moduleName.toLowerCase(),
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

    };

    $(document).ready(function () {


    });
</script>
