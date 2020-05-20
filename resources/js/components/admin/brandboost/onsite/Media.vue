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
                        <h3 class="htxt_medium_24 dark_700">Onsite Media</h3>
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
            <div class="container-fluid" v-if="reviews.length > 0">

                <div class="table_head_action bbot pb30">


                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ allData.total }}&nbsp;Media</h3>
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
                    <template v-for="review in reviews">
                        <div class="col-md-3 d-flex" v-if="review.fileCollection" v-for="media in review.fileCollection">
                            <div class="card p0 pt30 text-center animate_top col">
                                <div v-if="media.media_type == 'image'" :style="`background-image: url(${media.filePath});background-size:cover;min-height:300px;cursor:pointer;`" @click="zoomMedia(media)">

                                </div>
                                <div v-else style="min-height:300px;cursor:pointer;" @click="zoomMedia(media)">
                                    <video height="300px" width="100%">
                                        <source :src="media.filePath" :type="`video/${media.fileExt}`">
                                    </video>
                                </div>
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false" style="z-index:100;"> <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);" @click="zoomMedia(media)"><i class="dripicons-user text-muted mr-2"></i> View</a>
                                        <a class="dropdown-item" :href="media.filePath"><i class="dripicons-user text-muted mr-2"></i> Download</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(review.id, media.media_url)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                    </div>
                                </div>
                                <div style="cursor:pointer;">
                                    <h3 class="htxt_bold_16 dark_700 mb-2 mt-2">{{ setStringLimit(capitalizeFirstLetter(review.brand_title), 25) }}</h3>
                                    <p class="fsize12 fw500 green_400 mb-2">{{ setStringLimit(review.brand_desc, 100) }}</p>
                                    <div class="p15 pt15 btop text-uppercase">
                                        {{ media.media_type == 'video' ? 'Video' : 'Image' }}
                                    </div>

                                </div>
                            </div>


                        </div>
                    </template>


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
                                        Import media
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                                        Learn how to use onsite media
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 250px; " src="assets/images/review_campaign.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any media</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import media!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 js-review-media-slidebox">Add new media</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!--Image Modal Popup-->
            <modal-popup v-if="showImageModal" @close="showImageModal = false" width="md">
                <div slot="header">
                    <button type="button" class="close pull-right" data-dismiss="modal" @click="showImageModal = false">&times;</button>
                </div>
                <div slot="body" class="pt0 pb0">
                    <div class="text-center">
                        <img :src="zoomImgUrl" align="center" style="max-width: 100%;max-height:100%" />
                    </div>

                </div>
                <div slot="footer">
                    <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20" @click="showImageModal = false">Close</a>
                </div>
            </modal-popup>

            <!--Video Modal Popup-->
            <modal-popup v-if="showVideoModal" @close="showVideoModal = false" width="lg">
                <h3 slot="header"><a href="javascript:void(0);" @click="showVideoModal = false"><i class="close">x</i></a></h3>
                <div slot="body" class="pt0 pb0">
                    <video width="100%" controls>
                        <source :src="zoomVideoUrl" :type="`video/${fileExt}`">
                    </video>
                </div>
                <div slot="footer">
                    <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20" @click="showVideoModal = false">Close</a>
                </div>
            </modal-popup>
            <!-- Add Campaign Popup -->
            <div class="box js-review-media-slidebox-popup" style="width: 424px;">
                <div style="width: 424px;overflow: hidden; height: 100%;">
                    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-review-media-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                        <form method="post" @submit.prevent="processForm">
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="/assets/images/sms_temp_icon.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Review Media </h3>
                                        <hr class="mt30 mb30">
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="title">Media name</label>
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
                                        <button type="button" class="btn btn-lg bkg_sms_400 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                        <a class="dark_200 fsize16 fw400 ml20" href="javascript:void(0);">Close</a> </div>
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
    import Pagination from '@/components/helpers/Pagination';
    import modalPopup from "@/components/helpers/Common/ModalPopup";
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {Pagination, modalPopup},
        data(){
            return {
                successMsg : '',


                count : 0,
                reviews: '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: {
                    campaignName: '',
                    OnsitecampaignDescription: '',
                    campaign_id: ''
                },
                formLabel: 'Create',
                zoomImgUrl: '',
                zoomVideoUrl: '',
                fileExt: '',
                showImageModal: false,
                showVideoModal: false
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
        },
        methods: {
            zoomMedia: function(data){
                if(data.media_type == 'video'){
                    this.zoomVideoUrl = data.filePath;
                    this.fileExt = data.fileExt;
                    this.showVideoModal = true;
                }

                if(data.media_type == 'image'){
                    this.zoomImgUrl = data.filePath;
                    this.showImageModal = true;
                }
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/media?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.allData = response.data.allData;
                        this.reviews = response.data.aReviews;
                        this.showLoading(false);
                        //console.log(this.reviews)
                    });
            },
            showPaginationData: function(p){
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-review-media-slidebox').click();
            },
            prepareItemUpdate: function(campaign_id) {
                //window.location.href='#/brandboost/onsite_setup/'+campaign_id;
                this.getItemInfo(campaign_id);
            },
            getItemInfo: function(campaign_id){
                axios.post('/admin/brandboost/getReviewCampaign', {
                    campaign_id: campaign_id,
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
                return false;
            },
            deleteItem: function(reviewID, mediaUrl) {
                let val = [];
                let mediaName = [];

                val[0] = reviewID;
                mediaName[0] = mediaUrl;
                if(confirm('Are you sure you want to delete this media?')){
                    //Do axios
                    axios.post('/reviews/deleteReviewMultipal', {
                        reviewid:val,
                        mediaName: mediaName,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                this.loadPaginatedData();
                            }

                        });
                }
            }
        }
    }

    $(document).ready(function () {
        $(document).on('click', '.js-review-media-slidebox', function(){
            $(".js-review-media-slidebox-popup").animate({
                width: "toggle"
            });
        });
    });
</script>
