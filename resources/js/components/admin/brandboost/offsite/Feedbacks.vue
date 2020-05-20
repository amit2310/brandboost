
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
                        <h3 class="htxt_medium_24 dark_700">Offsite Brand Boost Feedback</h3>
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
            <div class="container-fluid" v-if="count <= 0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                                        Set up feedback monitoring
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                                        Learn how to use feedback monitoring
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 240px; " src="assets/images/review_feed_illustration.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No feedback so far. Connect feedback site!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">Feedback from 50+ review sites, at your fingertips...</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 ">Monitor feedback site</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid" v-else>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 pt0 pb0">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="fsize12 fw500 yellow_500 mt30 mb30"><i><img src="assets/images/lightbulb-fill1_yellow.svg"></i> &nbsp; TIPS</p>
                                    <h3 class="htxt_bold_18 dark_800">Automate messages, build engage with chatbots</h3>
                                    <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">Conversational marketing platform that helps companies close more deals by messaging with prospects in real-time &amp; via intelligent chatbots. Qualify leads, book meetings.</p>

                                </div>
                                <div class="col-md-5 text-center mt20">
                                    <img class="mt0" style="max-width: 272px;" src="assets/images/review_request.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <list-feedback></list-feedback>

            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->
    </div>

</template>

<script>
    import ListFeedback from './ListFeedback';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title'],
        components: {ListFeedback},
        data(){
            return {
                successMsg : '',

                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                count : 0,
                feedbacks : '',
                allData: {},
                current_page: 1,
                items_per_page:10,
                breadcrumb: '',
                feedbackTags: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
        },
        methods: {
            navigateToCampaignDetails: function(campaign_id){
                window.location.href='#/reviews/offsite/setup/'+campaign_id;
            },
            navigateToFeedbackDetails: function(id){
                window.location.href='#/feedback/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/feedback/listall?items_per_page='+this.items_per_page+ '&page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.allData = response.data.allData;
                        this.feedbacks = response.data.result;
                        this.count = response.data.totalResults;
                        this.feedbackTags = response.data.feedbackTags;
                        this.showLoading(false);
                        console.log(this.feedbacks)
                    });
            },
            changeStatus: function(fid, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/feedback/updateFeedbackStatus', {
                        fid:fid,
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
            deleteItem: function(subscriberid,trackinglogid) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/deleteRRrecord', {
                        subscriberId:subscriberid,
                        recordId:trackinglogid,
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
</script>

