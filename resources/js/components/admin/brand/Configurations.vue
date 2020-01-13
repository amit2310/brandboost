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
                                    <configure v-if="brandData" :brandData="brandData" :brandThemeData="brandThemeData" @syncConfigure="syncConfigure"></configure>
                                    <!--======Tab 2=====-->
                                    <design v-if="brandData" :brandData="brandData" :brandThemeData="brandThemeData"></design>
                                    <!--======Tab 3=====-->
                                    <campaign v-if="brandData" :brandData="brandData" :brandThemeData="brandThemeData" :aBrandbosts="aBrandbosts" :selectedCampaigns="selectedCampaigns"></campaign>

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
                                <div class="brand_page_main">
                                    <div class="brand_page_gr brand_page_pr">

                                        <div class="page_header">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img v-if="brandData.company_logo" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/${brandData.company_logo}`" alt="" class="br5" width="100px" style="max-height:50px">
                                                    <img v-else src="http://brandboost.io/new_pages/assets/images/walker_logo.jpg" alt="" class="br5" width="100px" style="max-height:50px">
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <a href="" class="light_000">FAQ</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card brand_top_sec">
                                                    <div class="row">
                                                        <div class="col-md-2 text-center" v-show="brandData.avatar">
                                                            <img v-if="brandData.company_header_logo" :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/${brandData.company_header_logo}`" class="rounded company_header_avatar bot1"  width="100" />
                                                            <img v-else class="mt-1" width="100" src="assets/images/avatar/02.png"/>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <p class="fsize17 dark_600 mb-1">{{brandData.company_info_name}}</p>
                                                            <p class="mb-1" v-show="brandData.rating">
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize14"></i></a>
                                                                <a href="#"><i class="fa fa-star dark_400 fsize14"></i></a>
                                                                <a href="#" class="fsize14 fw500">4.2</a>
                                                            </p>
                                                            <p class="fsize13 dark_200 mb-3">139 customer reviews<br>   742 questions & answers</p>
                                                            <p class="fsize13 dark_200" v-show="brandData.company_description" style="max-width: 280px;" v-html="brandData.company_info_description"></p>

                                                            <div class="brand_btn_sec" v-show="brandData.services">
                                                                <a href="#" class="customColor" style="color:#AB256F!important">Design Agency</a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important">Design &amp; Development</a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important">User Expirience Design</a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important">Logo</a>
                                                            </div>
                                                            <div class="clearfix"></div>

                                                            <button class="btn btn-md bkg_sms_400 light_000 mt10 br6" v-show="brandData.contact_button"> Contact Us</button>


                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="interactions mb30" v-show="brandData.contact_info">
                                                                <ul>
                                                                    <li><small><i class="icon-location3 mr10"></i>Country</small> <strong><img src="http://brandboost.io/assets/images/un_flag.png" alt=""> United States</strong></li>
                                                                    <li><small><i class="icon-city mr10"></i>City</small> <strong><span class="brig pr10 mr10">San-Francisco</span>  Worlwide</strong></li>
                                                                    <li><small><i class="icon-phone2 mr10"></i>Phone number</small> <strong>+3 8063 612 53 69</strong></li>
                                                                    <li><small><i class="fa fa-globe mr10"></i>Website</small> <strong>www.wakers.co</strong></li>
                                                                    <li><small><i class="icon-mail5 mr10"></i>Email</small> <strong>info@wakers.co</strong></li>
                                                                </ul>
                                                            </div>

                                                            <div class="brand_social" v-show="brandData.socials">
                                                                <a href="#" class="customColor" style="color:#AB256F!important"><i class="fa fa-facebook" style="color:#AB256F!important"></i></a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-bubble" style="color:#AB256F!important"></i></a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-paperplane" style="color:#AB256F!important"></i></a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-youtube" style="color:#AB256F!important"></i></a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-twitter" style="color:#AB256F!important"></i></a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important"><i class="icon-instagram" style="color:#AB256F!important"></i></a>
                                                                <a href="#" class="customColor" style="color:#AB256F!important"><i class="fa fa-google" style="color:#AB256F!important"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card p-0">
                                                    <div class="p20 bbot">
                                                        <p class="m-0 fsize14 fw500 dark_500">Customer Experiance <span class="sms_400">(4.5)</span></p>
                                                    </div>
                                                    <div class="p20">
                                                        <div class="p0">

                                                            <p class="fsize24 fw500 dark_800 mb-1">4.2</p>
                                                            <p class="mb-1">
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize18"></i></a>
                                                            </p>
                                                            <p class="fsize13 fw400 dark_200 mb-3 bbot pb-3">137 reviews - Based On 2,382 Review over the past year.</p>



                                                            <div class="pb-3 pl-3 ratings bbot">
                                                                <div class="row inner">
                                                                    <div class="col-1 pr-0 pl-0">
                                                                        <p>5 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 pr-0 pl-0"><p>37</p></div>
                                                                </div>

                                                                <div class="row inner">
                                                                    <div class="col-1 pr-0 pl-0">
                                                                        <p>4 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:70%"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 pr-0 pl-0"><p>57</p></div>
                                                                </div>

                                                                <div class="row inner">
                                                                    <div class="col-1 pr-0 pl-0">
                                                                        <p>3 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20" style="width:20%"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 pr-0 pl-0"><p>5</p></div>
                                                                </div>

                                                                <div class="row inner">
                                                                    <div class="col-1 pr-0 pl-0">
                                                                        <p>2 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width:80%"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 pr-0 pl-0"><p>7</p></div>
                                                                </div>

                                                                <div class="row inner">
                                                                    <div class="col-1 pr-0 pl-0">
                                                                        <p>1 <i><img src="assets/images/star-fill-12.png"> </i></p>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                                                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20" style="width:20%"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 pr-0 pl-0"><p>125</p></div>
                                                                </div>










                                                            </div>



                                                            <p class="fsize14 dark_600 mt-3 mb-0"><i><img src="assets/images/chat-1-fill.svg"></i> &nbsp;  Powered by BrandBoost  </p>



                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="p-0 brand_reviews">
                                                    <div class="card p-0 mb-1">
                                                        <div class="p15 bbot">
                                                            <figure class="float-left mr-3 mb-0">
                                                                <img width="38" src="assets/images/avatar/02.png"/>
                                                            </figure>

                                                            <p class="fsize12 fw500 dark_400 m-0">Dora Weber &nbsp;  <span class="fw400 dark_200">bought iPhone 8 Plus</span></p>
                                                            <p class="mb-0">
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star dark_400 fsize12"></i></a>
                                                                <a href="#" class="fsize12 fw400 ml-2 dark_200">27 Mar. 2018</a>
                                                            </p>
                                                        </div>
                                                        <div class="p15">
                                                            <p class="fsize13 dark_400 m-0">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
                                                        </div>

                                                        <div class="p15 btop">
                                                            <p class="m-0 fsize12 dark_200">
                                                                <a class="mr-2" href="#"><i class="icon-comment fsize11"></i> 3 Comments</a>
                                                                <a class="mr-2" href="#">4.0 Our of 5 Stars</a>
                                                                <a class="mr-2" href="#"><i class="icon-thumbs-up3 fsize10 green_400"></i></a>
                                                                <a href="#"><i class="icon-thumbs-down3 fsize10 red_400"></i></a>

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="card p-0 mb-1">
                                                        <div class="p15 bbot">
                                                            <figure class="float-left mr-3 mb-0">
                                                                <img width="38" src="assets/images/avatar/06.png"/>
                                                            </figure>

                                                            <p class="fsize12 fw500 dark_400 m-0">Dora Weber &nbsp;  <span class="fw400 dark_200">bought iPhone 8 Plus</span></p>
                                                            <p class="mb-0">
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star dark_400 fsize12"></i></a>
                                                                <a href="#" class="fsize12 fw400 ml-2 dark_200">27 Mar. 2018</a>
                                                            </p>
                                                        </div>
                                                        <div class="p15">
                                                            <p class="fsize13 dark_400 m-0">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
                                                        </div>

                                                        <div class="p15 btop">
                                                            <p class="m-0 fsize12 dark_200">
                                                                <a class="mr-2" href="#"><i class="icon-comment fsize11"></i> 3 Comments</a>
                                                                <a class="mr-2" href="#">4.0 Our of 5 Stars</a>
                                                                <a class="mr-2" href="#"><i class="icon-thumbs-up3 fsize10 green_400"></i></a>
                                                                <a href="#"><i class="icon-thumbs-down3 fsize10 red_400"></i></a>

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="card p-0 mb-1">
                                                        <div class="p15 bbot">
                                                            <figure class="float-left mr-3 mb-0">
                                                                <img width="38" src="assets/images/avatar/04.png"/>
                                                            </figure>

                                                            <p class="fsize12 fw500 dark_400 m-0">Dora Weber &nbsp;  <span class="fw400 dark_200">bought iPhone 8 Plus</span></p>
                                                            <p class="mb-0">
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star yellow_400 fsize12"></i></a>
                                                                <a href="#"><i class="fa fa-star dark_400 fsize12"></i></a>
                                                                <a href="#" class="fsize12 fw400 ml-2 dark_200">27 Mar. 2018</a>
                                                            </p>
                                                        </div>
                                                        <div class="p15">
                                                            <p class="fsize13 dark_400 m-0">Showcase your customer's photos directly on the product page and throughout your site. Social proof is the most powerful trust signal that helps site visitors see how well your customers love your products.</p>
                                                        </div>

                                                        <div class="p15 btop">
                                                            <p class="m-0 fsize12 dark_200">
                                                                <a class="mr-2" href="#"><i class="icon-comment fsize11"></i> 3 Comments</a>
                                                                <a class="mr-2" href="#">4.0 Our of 5 Stars</a>
                                                                <a class="mr-2" href="#"><i class="icon-thumbs-up3 fsize10 green_400"></i></a>
                                                                <a href="#"><i class="icon-thumbs-down3 fsize10 red_400"></i></a>

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-md-8">
                                                <div class="card p-0">
                                                    <div class="p20 bbot">
                                                        <p class="m-0 fsize14 fw500 dark_500">About our company</p>
                                                    </div>
                                                    <div class="p20">
                                                        <p class="fsize13 fw400 dark_400 lh_22">
                                                            Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forward), it was my cheerful duty to attend upon him while taking that hard-scrabble scramble upon the dead whale's back. You have seen Italian organ-boys holding a dancing-ape by a long cord. Just so, from the ship's steep side, did I hold Queequeg down there in the sea, by what is technically called in the fishery a monkey-rope, attached to a strong strip of canvas belted round his waist.
                                                        </p>
                                                        <a class="sms_400" href="#">Learn More</a>
                                                    </div>
                                                </div>

                                                <div class="card p-0">
                                                    <div class="p20 bbot">
                                                        <p class="m-0 fsize14 fw500 dark_500">Media</p>
                                                    </div>
                                                    <div class="p20">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="bkg_light_000 border br5 p-2 mb15">
                                                                    <img class="w-100" src="http://brandboost.io/assets/images/brand_img11.jpg" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="bkg_light_000 border br5 p-2 mb15">
                                                                    <img class="w-100" src="http://brandboost.io/assets/images/brand_img10.jpg" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="bkg_light_000 border br5 p-2 mb15">
                                                                    <img class="w-100" src="http://brandboost.io/assets/images/brand_img9.jpg" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="bkg_light_000 border br5 p-2 mb15">
                                                                    <img class="w-100" src="http://brandboost.io/assets/images/brand_img8.jpg" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="bkg_light_000 border br5 p-2 mb15">
                                                                    <img class="w-100" src="http://brandboost.io/assets/images/brand_img7.jpg" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="bkg_light_000 border br5 p-2 mb15">
                                                                    <img class="w-100" src="http://brandboost.io/assets/images/brand_img12.jpg" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="p20 btop">
                                                        <a class="sms_400 float-left" href="#">View all Review</a>
                                                        <a class="sms_400 float-right" href="#">></a>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>



                                </div>



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
                selectedCampaigns: '',
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
                    this.selectedCampaigns = response.data.selectedCampaigns;
                    this.loading = false;
                    //loadJQScript(this.user.id);

                });
        },
        mounted() {

        },
        methods: {
            syncConfigure: function(param1){
                this.brandData = param1;

            },
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


