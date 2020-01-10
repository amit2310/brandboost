<template>

    <div class="content">
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Brand Page</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="card p-0 brand_sidebar">
                            <div class="p20 bbot">
                                <ul class="nav nav-pills profile_tab" role="tablist">
                                    <li class="mr20"><a class="htxt_bold_14 active" data-toggle="pill" href="#Configurations">Configurations</a></li>
                                    <li class="mr20"><a class="htxt_bold_14" data-toggle="pill" href="#Design">Design</a></li>
                                    <li class="mr20"><a class="htxt_bold_14" data-toggle="pill" href="#Campaign">Campaign</a></li>
                                </ul>
                            </div>
                            <div class="p0">
                                <div class="tab-content">
                                    <!--======Tab 1====-->
                                    <configure v-if="brandData" :brandData="brandData" :brandThemeData="brandThemeData"></configure>
                                    <!--======Tab 2=====-->
                                    <design v-if="brandData" :brandData="brandData" :brandThemeData="brandThemeData"></design>
                                    <!--======Tab 3=====-->
                                    <campaign v-if="brandData" :brandData="brandData" :brandThemeData="brandThemeData" :aBrandbosts="aBrandbosts"></campaign>

                                </div>
                            </div>
                        </div>

                        <div class="card p0 animate_top">
                            <div class="p20 bbot">
                                <span class="fsize14 fw400 dark_600">Help</span>
                            </div>
                            <div class="p30 text-center">
                                <div class="max_w_225 m-auto">
                                    <img class="mb-3" src="assets/images/smiley_optimization.svg">
                                    <h3 class="htxt_medium_16 dark_700 mb-3">Company info</h3>
                                    <p class="htxt_regular_14 dark_400 lh_20">Your can change your company
                                        description, services and contact info
                                        on Brand Settings page</p>
                                    <a class="htxt_medium_12 email_500" href="javascript:void(0);">Change company info</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-9 col-lg-8">
                        <div class="card p-0">
                            <div class="p20 bbot">
                                <span class="fsize14 fw400 dark_600">Statistic</span>
                            </div>
                            <div class="p20">
                                <img src="http://brandboost.io/new_pages/assets/images/browser_top.png"/>
                                <img src="http://brandboost.io/new_pages/assets/images/brand_page2.jpg"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Campaign from "./partials/Campaign";
    import Configure from "./partials/Configure";
    import Design from "./partials/Design";
    export default {
        components: {Design, Configure, Campaign},
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: true,
                brandData: '',
                brandThemeData: '',
                aBrandbosts: '',
                user: {},
                breadcrumb: ''

            }
        },
        created() {
            axios.get('/admin/brandboost/brand_configuration')
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.brandData = response.data.brandData;
                    this.brandThemeData = response.data.brandThemeData;
                    this.aBrandbosts = response.data.aBrandbosts;
                    this.loading = false;
                    //loadJQScript(this.user.id);

                });
        },
        mounted() {

        },
        methods: {
            setSource: function(source){
                this.loading = true;
                this.campaign.source_type = source;
                axios.post('/admin/modules/referral/updateSource', {
                    source_type: source,
                    ref_id: this.campaignId,
                    _token: this.csrf_token(),
                })
                    .then(response => {
                        this.successMsg = 'Source has been updated successfully';
                        this.loading = false;
                    });


            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/referral/';
                }else{
                    path = '/admin#/referral/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },
            updateSettings: function (fieldName, fieldValue,  type) {
                this.loading = true;

                if(type =='expiry'){
                    this.displayCustomLinkExpiry = fieldValue == 'custom' || fieldName =='txtInteger' || fieldName =='exp_duration' ? true : false;
                }
                axios.post('/admin/brandboost/saveOnsiteSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    brandboostId: this.campaignId,
                    linkExpiryData : this.campaign.link_expire_custom,
                    requestType: type

                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.loading = false;
                });

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


